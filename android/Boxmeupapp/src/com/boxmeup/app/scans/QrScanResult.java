package com.boxmeup.app.scans;

import android.R;
import android.app.Activity;
import android.content.Context;
import android.webkit.WebView;
import android.widget.Toast;
import com.boxmeup.app.MainActivity;
import com.google.zxing.integration.android.IntentResult;
import java.net.MalformedURLException;
import java.net.URL;
import java.util.logging.Level;
import java.util.logging.Logger;

public class QrScanResult implements ScanResult {
	private MainActivity activity;

	public QrScanResult(MainActivity activity) {
		this.activity = activity;
	}

	public boolean processResult(IntentResult scanResult) {
		String url = scanResult.getContents();
		if(isValidUrl(url)) {
			activity.getWebView().loadUrl(url);
		} else {
			Toast.makeText(activity, "Not a valid Boxmeup QR code.", Toast.LENGTH_SHORT).show();
		}

		return true;
	}

	protected boolean isValidUrl(String requestUrl) {
		try {
			URL url = new URL(requestUrl);
			return url.getHost().equals(activity.getValidUrlHost());
		} catch (MalformedURLException ex) {
			Logger.getLogger(QrScanResult.class.getName()).log(Level.SEVERE, null, ex);
		}
		return false;
	}
}
