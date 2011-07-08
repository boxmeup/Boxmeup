package com.boxmeup.app;

import android.app.Activity;
import android.net.http.SslError;
import android.os.Bundle;
import android.view.KeyEvent;
import android.view.View;
import android.webkit.SslErrorHandler;
import android.webkit.WebView;
import android.webkit.WebViewClient;
import android.widget.ImageView;

public class MainActivity extends Activity {
	
	WebView mWebView;
	ImageView mImageView;
	
	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.main);
		
		mWebView = (WebView) findViewById(R.id.webview);
		mImageView = (ImageView) findViewById(R.id.imageview);

		mWebView.getSettings().setJavaScriptEnabled(true);
		mWebView.loadUrl(getString(R.string.url_source));
		mWebView.setWebViewClient(new BoxmeupWebViewClient());
	}
	
	@Override
	public boolean onKeyDown(int keyCode, KeyEvent event) {
		if ((keyCode == KeyEvent.KEYCODE_BACK) && mWebView.canGoBack()) {
			mWebView.goBack();
			return true;
		}
		return super.onKeyDown(keyCode, event);
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
}
