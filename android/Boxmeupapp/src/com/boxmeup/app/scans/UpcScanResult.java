
package com.boxmeup.app.scans;

import android.widget.Toast;
import com.boxmeup.app.MainActivity;
import com.google.zxing.integration.android.IntentResult;
import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.net.URI;
import java.net.URISyntaxException;
import java.util.logging.Level;
import java.util.logging.Logger;
import java.util.regex.Matcher;
import java.util.regex.Pattern;
import org.apache.http.HttpResponse;
import org.apache.http.client.HttpClient;
import org.apache.http.client.methods.HttpGet;
import org.apache.http.impl.client.DefaultHttpClient;

public class UpcScanResult implements ScanResult {
	private MainActivity activity;
	private static final Pattern productPattern = Pattern.compile("owb63p\">([^<]+).+zdi3pb\">([^<]+)");

	public UpcScanResult(MainActivity activity) {
		this.activity = activity;
	}

	public boolean processResult(IntentResult scanResult) {
		String title = getTitleFromUpc(scanResult.getContents());
		if(title != null) {
			String uri = activity.getUrlSource() + "/container_items/add_item/body:" + title;
			String slug = activity.getCurrentContainerSlug();
			if(slug != null) {
				uri += "/slug:" + slug;
			}
			activity.getWebView().loadUrl(uri);
		} else {
			Toast.makeText(activity, "Unable to find product UPC.", Toast.LENGTH_SHORT).show();
		}

		return true;
	}

	private String getTitleFromUpc(String upc) {
		String title = null;
		HttpClient client = new DefaultHttpClient();
		HttpGet request = new HttpGet();
		BufferedReader in;
		try {
			request.setURI(new URI("http://www.google.com/m/products?ie=utf8&oe=utf8&scoring=p&q=" + upc));
			request.setHeader("User-Agent", "Android (Boxmeup)");
			HttpResponse response = client.execute(request);
			in = new BufferedReader(new InputStreamReader(response.getEntity().getContent()));
            StringBuilder sb = new StringBuilder("");
            String line = "";
            String NL = System.getProperty("line.separator");
            while ((line = in.readLine()) != null) {
                sb.append(line).append(NL);
            }
            in.close();
            title = parseResponseString(sb.toString());

		} catch (IOException ex) {
			Logger.getLogger(UpcScanResult.class.getName()).log(Level.SEVERE, null, ex);
		} catch (URISyntaxException ex) {
			Logger.getLogger(UpcScanResult.class.getName()).log(Level.SEVERE, null, ex);
		}
		return title;
	}

	private String parseResponseString(String response) {
		Matcher matcher = productPattern.matcher(response);
		return matcher.find() ?
			matcher.group(1) :
			null;
	}
	
}
