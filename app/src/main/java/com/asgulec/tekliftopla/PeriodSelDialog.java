package com.asgulec.tekliftopla;

import android.annotation.SuppressLint;
import android.app.AlertDialog;
import android.app.Dialog;
import android.content.Context;
import android.graphics.Color;
import android.graphics.drawable.ColorDrawable;
import android.os.Bundle;
import android.view.View;
import android.view.Window;
import android.widget.TextView;


public class PeriodSelDialog extends Dialog {

	final Context mContext;

	public String sPUnit;
	public int nPValue;
	TextView txtPUnit;
	TextView txtPValue;


	public PeriodSelDialog(Context context, String strPUnit, int nVal) {
		super(context);
		// TODO Auto-generated constructor stub
		mContext = context;

		sPUnit = strPUnit;
		nPValue = nVal;
	}

	private String[] getValArray(String sVal){
		int nLastVal = 0;

		if (sVal.equals(mContext.getResources().getStringArray(R.array.periodu)[0])) nLastVal = 30;
		else if (sVal.equals(mContext.getResources().getStringArray(R.array.periodu)[1])) nLastVal = 6;
		else if (sVal.equals(mContext.getResources().getStringArray(R.array.periodu)[2])) nLastVal = 11;
		else if (sVal.equals(mContext.getResources().getStringArray(R.array.periodu)[3])) nLastVal = 4;

//		if (sVal.equals(GlobalConstant.PERIOD_UNIT[0])) nLastVal = 30;
//		else if (sVal.equals(GlobalConstant.PERIOD_UNIT[1])) nLastVal = 6;
//		else if (sVal.equals(GlobalConstant.PERIOD_UNIT[2])) nLastVal = 11;
//		else if (sVal.equals(GlobalConstant.PERIOD_UNIT[3])) nLastVal = 4;

		String[] sPValArray = new String[nLastVal];
		for (int i = 1; i <= nLastVal; i++) sPValArray[i - 1] = Integer.toString(i);

		return sPValArray;
	}

	@SuppressLint("SetTextI18n")
	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		requestWindowFeature(Window.FEATURE_NO_TITLE);
		getWindow().setBackgroundDrawable(new ColorDrawable(Color.TRANSPARENT));

		setContentView(R.layout.pseldlg);

		txtPUnit = findViewById(R.id.txtPeriodUnit);
		txtPValue = findViewById(R.id.txtPeriodVal);
		txtPUnit.setOnClickListener(mClickListener);
		txtPValue.setOnClickListener(mClickListener);
		findViewById(R.id.btnOK).setOnClickListener(mClickListener);

		txtPUnit.setText(sPUnit);
		txtPValue.setText(Integer.toString(nPValue));
	}

	final View.OnClickListener mClickListener = new View.OnClickListener() {

		@SuppressLint({"NonConstantResourceId", "SetTextI18n"})
		@Override
		public void onClick(View v) {
			// TODO Auto-generated method stub
			switch(v.getId()){
				case R.id.txtPeriodUnit:
					AlertDialog.Builder dlg = new AlertDialog.Builder(mContext);

					dlg.setItems(mContext.getResources().getStringArray(R.array.periodu), (dialog, which) -> {
						dialog.dismiss();
						txtPUnit.setText(mContext.getResources().getStringArray(R.array.periodu)[which]);
						sPUnit = (mContext.getResources().getStringArray(R.array.periodu)[which]);
						int nDefValue;
						if (which == 0){
							nDefValue = 4;
						}else{
							nDefValue = 1;
						}

						txtPValue.setText(Integer.toString(nDefValue));
						nPValue = nDefValue;
					});
					dlg.show();
					break;
				case R.id.txtPeriodVal:
					AlertDialog.Builder dlg1 = new AlertDialog.Builder(mContext);
					final String[] sArray = getValArray(sPUnit);
					dlg1.setItems(sArray, (dialog, which) -> {
						dialog.dismiss();
						txtPValue.setText(sArray[which]);
						nPValue = Integer.parseInt(sArray[which]);
					});
					dlg1.show();
					break;
				case R.id.btnOK:
					dismiss();
					break;
			}
		}
	};
}
