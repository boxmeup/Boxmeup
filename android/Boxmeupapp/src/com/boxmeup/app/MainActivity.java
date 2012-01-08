package com.boxmeup.app;

import android.app.Activity;
import android.content.Context;
import android.content.Intent;
import android.net.http.SslError;
import android.os.Bundle;
import android.view.KeyEvent;
import android.view.Menu;
import android.view.MenuInflater;
import android.view.MenuItem;
import android.view.View;
import android.webkit.SslErrorHandler;
import android.webkit.WebView;
import android.webkit.WebViewClient;
import android.widget.ImageView;
import android.widget.Toast;
import com.boxmeup.app.scans.QrScanResult;
import com.boxmeup.app.scans.ScanResult;
import com.boxmeup.app.scans.UpcScanResult;
import com.google.zxing.integration.android.IntentIntegrator;
import com.google.zxing.integration.android.IntentResult;
import java.util.logging.Level;
import java.util.logging.Logger;

public class MainActivity extends Activity {
	
	WebView mWebView;
	ImageView mImageView;
	boolean loggedIn = false;
	private String currentContainerSlug;
	
	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.main);
		
		mWebView = (WebView) findViewById(R.id.webview);
		mImageView = (ImageView) findViewById(R.id.imageview);

		mWebView.getSettings().setJavaScriptEnabled(true);
		mWebView.loadUrl(getString(R.string.url_source));
		mWebView.setWebViewClient(new BoxmeupWebViewClient());
		
		// Initialize the javascript interface
		mWebView.addJavascriptInterface(new BoxmeupJavascriptInterface(this), getString(R.string.javascript_interface));
	}
	
	@Override
	public boolean onKeyDown(int keyCode, KeyEvent event) {
		if ((keyCode == KeyEvent.KEYCODE_BACK) && mWebView.canGoBack()) {
			mWebView.goBack();
			return true;
		}
		return super.onKeyDown(keyCode, event);
	}
	
	@Override
	public void onActivityResult(int requestCode, int resultCode, Intent intent) {
		IntentResult scanResult = IntentIntegrator.parseActivityResult(requestCode, resultCode, intent);
		String contents = null, scanFormat = null;
		ScanResult result = null;

		if (scanResult != null) {
			scanFormat = scanResult.getFormatName();
			contents = scanResult.getContents();
			if("UPC_A".equals(scanFormat)) {
				result = new UpcScanResult(this);
				result.processResult(scanResult);
			} else {
				result = new QrScanResult(this);
				result.processResult(scanResult);
			}
		}
	}

	@Override
	public boolean onCreateOptionsMenu(Menu menu) {
		MenuInflater inflater = getMenuInflater();
		inflater.inflate(R.menu.scan_menu, menu);
		return true;
	}

	@Override
	public boolean onMenuOpened(int featureId, Menu menu) {
		return loggedIn;
	}

	@Override
	public boolean onOptionsItemSelected(MenuItem item) {
		// Handle item selection
		switch (item.getItemId()) {
			case R.id.qr_scan:
				IntentIntegrator.initiateScan(this,
					IntentIntegrator.DEFAULT_TITLE,
					IntentIntegrator.DEFAULT_MESSAGE,
					IntentIntegrator.DEFAULT_YES,
					IntentIntegrator.DEFAULT_NO,
					"QR_CODE"
				);
				return true;
			case R.id.upc_scan:
				IntentIntegrator.initiateScan(this,
					IntentIntegrator.DEFAULT_TITLE,
					IntentIntegrator.DEFAULT_MESSAGE,
					IntentIntegrator.DEFAULT_YES,
					IntentIntegrator.DEFAULT_NO,
					"UPC_A"
				);
				return true;
			default:
				return super.onOptionsItemSelected(item);
		}
	}

	public WebView getWebView() {
		return this.mWebView;
	}

	public String getValidUrlHost() {
		return getString(R.string.valid_host);
	}

	public String getUrlSource() {
		return getString(R.string.url_source);
	}

	public String getCurrentContainerSlug() {
		return currentContainerSlug;
	}
	
	/**
	 * Nested class that controls webview specific events
	 */
	private class BoxmeupWebViewClient extends WebViewClient {
		/**
		 * Keeps clicked links and submitted forms from opening the default browser app.
		 *
		 * @param view
		 * @param url
		 * @return true
		 */
		@Override
		public boolean shouldOverrideUrlLoading(WebView view, String url) {
			view.loadUrl(url);
			return true;
		}

		/**
		 * Since this is mostly an internal app, a verified cert isn't available, therefore
		 * ignore SSL warnings and errors.
		 *
		 * @param view
		 * @param handler
		 * @param error
		 */
		@Override
		public void onReceivedSslError (WebView view, SslErrorHandler handler, SslError error) {
			handler.proceed() ;
		}

		/**
		 * Responsible for hiding the splash screen and making the main browser view visible.
		 *
		 * @param view
		 * @param url
		 */
		@Override
		public void onPageFinished(WebView view, String url) {
			mImageView.setVisibility(View.GONE);
			view.setVisibility(View.VISIBLE);
		}
	}
	
	/**
	 * Javascript interface that allows the web application to talk to the
	 * android app.
	 */
	private class BoxmeupJavascriptInterface {
		Context mContext;
		
		BoxmeupJavascriptInterface(Context c) {
			mContext = c;
		}
		
		/** Show a toast from the web page */
		public void showToast(String toast) {
			Toast.makeText(mContext, toast, Toast.LENGTH_SHORT).show();
		}
		
		public void qrScan() {
			IntentIntegrator.initiateScan((Activity) mContext);
		}

		public void setCurrentContainerSlug(String slug) {
			currentContainerSlug = slug;
		}

		public void clearHistory() {
			mWebView.clearHistory();
			loggedIn = false;
		}

		public void loggedIn() {
			loggedIn = true;
		}
	}
}
