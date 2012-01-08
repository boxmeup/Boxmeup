package com.boxmeup.app.scans;

import android.content.Context;
import com.google.zxing.integration.android.IntentResult;

public interface ScanResult {
	public boolean processResult(IntentResult scanResult);
}
