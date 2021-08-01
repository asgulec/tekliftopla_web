package com.asgulec.tekliftopla;

import android.app.Dialog;
import android.content.Context;
import android.graphics.Color;
import android.graphics.drawable.ColorDrawable;
import android.os.Bundle;

import android.view.Window;


public class HelpDialog extends Dialog {
	
	final Context mContext;
	
	public HelpDialog(Context context) {
		super(context);
		// TODO Auto-generated constructor stub
		mContext = context;
	}

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        requestWindowFeature(Window.FEATURE_NO_TITLE);
	    getWindow().setBackgroundDrawable(new ColorDrawable(Color.TRANSPARENT));
	    
        setContentView(R.layout.helpdlg);
        
        findViewById(R.id.btnOK).setOnClickListener(v -> {
			// TODO Auto-generated method stub
			dismiss();
		});
    }
}
