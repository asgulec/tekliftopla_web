package com.asgulec.tekliftopla;

import android.annotation.SuppressLint;
import android.app.AlertDialog;
import android.app.ProgressDialog;
import android.content.Context;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.TextView;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;


public class ConfirmActivity extends BaseActivity implements OnClickListener{

	int nSelectCountry;
	int nSelectCity;
	String sSelectDates;
	String sSelectPUnit;
	int nSelectPValue;
	String sSelectRecipe;
	boolean isTR;
	ProgressDialog dialog;

	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.confirm);

		findViewById(R.id.btnCancel).setOnClickListener(this);
		findViewById(R.id.btnChange).setOnClickListener(this);
		findViewById(R.id.btnSubmit).setOnClickListener(this);
		Init();
	}

	@SuppressLint("SetTextI18n")
	private void Init(){
		nSelectCountry=getIntent().getExtras().getInt("countryindex");
		nSelectCity = getIntent().getExtras().getInt("cityindex");
		sSelectDates = getIntent().getExtras().getString("seldate");
		sSelectPUnit = getIntent().getExtras().getString("selpunit");
		nSelectPValue = getIntent().getExtras().getInt("selpval");
		sSelectRecipe = getIntent().getExtras().getString("recdesc");

		isTR = getResources().getString(R.string.locale).equals("tr");

		((TextView)findViewById(R.id.txtWaitOffer)).setText(sUserName);
		((TextView)findViewById(R.id.txtEmailaddr)).setText(sUserEmail);
		if(isTR)
		{
			findViewById(R.id.txtDestinationCountry).setVisibility(View.GONE);
			findViewById(R.id.txtCountry).setVisibility(View.GONE);
		}
		else
			((TextView)findViewById(R.id.txtCountry)).setText(GlobalConstant.COUNTRY_LIST[nSelectCountry - 1]);
		if(isTR || nSelectCountry == GlobalConstant.TURKEY_IND)
			((TextView)findViewById(R.id.txtLocation)).setText(GlobalConstant.CITY_LIST[nSelectCity - 1]);
		else
		{
			findViewById(R.id.txtPlaceDelivery).setVisibility(View.GONE);
			findViewById(R.id.txtLocation).setVisibility(View.GONE);
		}
		((TextView)findViewById(R.id.txtDateOffer)).setText(sSelectDates);
		((TextView)findViewById(R.id.txtDelivtime)).setText(nSelectPValue + " " + sSelectPUnit);
		((TextView)findViewById(R.id.txtRecipeDesc)).setText(sSelectRecipe);

	}

	@SuppressLint("NonConstantResourceId")
	@Override
	public void onClick(View v) {
		// TODO Auto-generated method stub
		switch(v.getId()){
			case R.id.btnCancel:
				doBackInit();
				break;
			case R.id.btnChange:
				finish();
				break;
			case R.id.btnSubmit:
				if (!isNetworkConnected()){
					AlertDialog.Builder alert = new AlertDialog.Builder(this);
					alert.setPositiveButton(R.string.ok, (dialog, which) -> dialog.dismiss());
					alert.setMessage(R.string.checkinternet);
					alert.show();
				}else{
					//new ProfileAsync().execute();
					PostDatafun();
				}
				break;
		}
	}

	private boolean isNetworkConnected() {
		ConnectivityManager cm = (ConnectivityManager) getSystemService(Context.CONNECTIVITY_SERVICE);
		NetworkInfo ni = cm.getActiveNetworkInfo();
		// There are no active networks.
		return ni != null;
	}

	public void Finish(int nResCode){
		setResult(nResCode);
		finish();
	}


	private void doBackInit(){
		AlertDialog.Builder builder = new AlertDialog.Builder(this);
		builder.setMessage(R.string.initalert)
				.setTitle(R.string.corresponding)
				.setCancelable(false)
				.setPositiveButton(R.string.yes,
						(dialog, id) -> {
							Finish(GlobalConstant.RESULT_INIT);
							dialog.cancel();
						})
				.setNegativeButton(R.string.no,
						(dialog, id) -> dialog.cancel());
		AlertDialog alert = builder.create();
		alert.show();
	}

	@Override
	public void onBackPressed() {
		// TODO Auto-generated method stub
		doBackInit();
	}

	private void PostDatafun()
    {
		dialog = new ProgressDialog(ConfirmActivity.this);
		dialog.setMessage("Please wait...");
		dialog.show();
    	String newurl = GlobalConstant.URL_DATASEND+"?key="+GlobalConstant.URL_KEY+"&xe="+GlobalConstant.URL_KEY+"&";
    	String newurl2 = newurl+"vuser="+sUserName+"&vemail="+sUserEmail+"&vcountryid="+ nSelectCountry +"&vcityid="+ nSelectCity +"&vdate="+sSelectDates+"&dsure="+nSelectPValue + " " + sSelectPUnit+"&dtext="+sSelectRecipe;
		newurl2 = newurl2.replaceAll(" ", "%20");

		RequestQueue queue = Volley.newRequestQueue(this);

// Request a string response from the provided URL.
		StringRequest stringRequest = new StringRequest(Request.Method.GET, newurl2,
				response -> {

					String wversion = response.substring(0,14);
					Log.d("ddddddddddd", "onResponse: "+response.substring(0,14));

					if (wversion.equals("{'suncces':'1'")) {

							Finish(GlobalConstant.RESULT_SUCCESS);
							dialog.dismiss();
					}
					else if(response.equals("{'suncces':'2'")) {
						dialog.dismiss();
						AlertDialog.Builder alert;
						alert = new AlertDialog.Builder(ConfirmActivity.this);
						alert.setPositiveButton(R.string.ok, (dialog, which) -> dialog.dismiss());
						alert.setMessage(R.string.serverfail);
						alert.show();
					}

					else {
						dialog.dismiss();
						AlertDialog.Builder alert;
						alert = new AlertDialog.Builder(ConfirmActivity.this);
						alert.setPositiveButton(R.string.ok, (dialog, which) -> dialog.dismiss());
						alert.setMessage(R.string.serverfail);
						alert.show();

					}

				}, error -> {
					//textView.setText("That didn't work!");
					Log.d("ddddddddddddddddddd", "onErrorResponse: "+error);
					dialog.dismiss();
					AlertDialog.Builder alert;
					alert = new AlertDialog.Builder(ConfirmActivity.this);
					alert.setPositiveButton(R.string.ok, (dialog, which) -> dialog.dismiss());
					alert.setMessage(R.string.serverfail);
					alert.show();
				});

// Add the request to the RequestQueue.
		queue.add(stringRequest);
    }

}
