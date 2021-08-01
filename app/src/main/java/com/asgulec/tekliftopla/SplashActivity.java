package com.asgulec.tekliftopla;

import android.annotation.SuppressLint;
import android.content.Intent;
import android.os.Bundle;
import android.os.Handler;
import android.os.Message;


public class SplashActivity extends BaseActivity {

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
       	setContentView(R.layout.splash);
        mhandler.sendEmptyMessageDelayed(1, 1500);
    }
    
    @SuppressLint("HandlerLeak")
	public final Handler mhandler = new Handler() {
		@Override
		public void handleMessage(Message msg) {
			int nMsg = msg.what;
			if (nMsg == 1){
				Intent intent;
				if (!sUserEmail.equals("") && !sUserName.equals("")){
					intent = new Intent(SplashActivity.this, MainActivity.class);
				}else{
					intent = new Intent(SplashActivity.this, LoginActivity.class);
				}
				startActivity(intent);
				finish();
			}
		}
    };
}
