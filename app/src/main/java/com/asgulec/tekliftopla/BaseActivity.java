package com.asgulec.tekliftopla;

import android.annotation.SuppressLint;
import android.app.Activity;
import android.content.SharedPreferences;
import android.content.pm.PackageInfo;
import android.content.pm.PackageManager;
import android.content.pm.Signature;
import android.os.Bundle;
import android.util.Base64;
import android.util.Log;

import androidx.fragment.app.FragmentActivity;

import java.security.MessageDigest;
import java.security.NoSuchAlgorithmException;
import java.text.SimpleDateFormat;
import java.util.Calendar;


public class BaseActivity extends FragmentActivity {

	SharedPreferences pref = null;
	public String sUserName, sUserEmail;
	public int nCountryIndex;
	public int nCityIndex;
	public String sSelDate;
	public String sPeriodUnit;
	public int nPeriodVal;
	public String sRecipe;
	 @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);    
        
        pref = getSharedPreferences(GlobalConstant.PREFERENCE_NAME, Activity.MODE_PRIVATE);
        doInitStore();
		 try {
			 @SuppressLint("PackageManagerGetSignatures") PackageInfo info = getPackageManager().getPackageInfo(getPackageName(), PackageManager.GET_SIGNATURES);
			 for (Signature signature : info.signatures) {
				 MessageDigest md = MessageDigest.getInstance("SHA");
				 md.update(signature.toByteArray());
				 Log.e("MY KEY HASH:", Base64.encodeToString(md.digest(), Base64.DEFAULT));
			 }
		 } catch (PackageManager.NameNotFoundException e) {
			 Log.d("TAG", "onCreate: "+e);

		 } catch (NoSuchAlgorithmException e) {
			 Log.d("TAG", "onCreate: "+e);
		 }
	}
	
	@SuppressLint("ApplySharedPref")
	public void setUserInfo(String strName, String strEmail){
		SharedPreferences.Editor editor= pref.edit();
		editor.putString("name", strName);
		editor.putString("email", strEmail);
		editor.commit();
	}

	
	public void doInitStore(){
		Calendar today = Calendar.getInstance();
	        today.add(Calendar.DATE, 5);
	        @SuppressLint("SimpleDateFormat") String strDate = new SimpleDateFormat(GlobalConstant.DATE_FORMAT).format(today.getTime());
	        
		sUserName = pref.getString("name", "");
        sUserEmail = pref.getString("email", "");
		nCountryIndex = pref.getInt("countryindex", 0);
        nCityIndex = pref.getInt("cindex", 0);
        sSelDate = pref.getString("seldt", strDate);
		sPeriodUnit = pref.getString("punit", getResources().getStringArray(R.array.periodu)[0]);
		//sPeriodUnit = pref.getString("punit", GlobalConstant.PERIOD_UNIT[0]);
        nPeriodVal = pref.getInt("pval", 4);
        sRecipe = pref.getString("recipe", "");
	}
}
