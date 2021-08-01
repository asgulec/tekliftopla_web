package com.asgulec.tekliftopla;

import android.annotation.SuppressLint;
import android.app.AlertDialog;
import android.app.DatePickerDialog;
import android.content.Intent;
import android.content.SharedPreferences;
import android.graphics.Color;
import android.graphics.drawable.ColorDrawable;
import android.os.Bundle;
import android.text.Html;
import android.util.Log;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.DatePicker;
import android.widget.EditText;
import android.widget.TextView;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.Calendar;
import java.util.Objects;

public class MainActivity extends BaseActivity implements OnClickListener{

    TextView txtTopDesc;
    TextView txtCityText;
    TextView txtCitySel;
    TextView txtCountryText;
    TextView txtCountrySel;
    TextView txtDateSel;
    TextView txtPeriodSel;
    EditText edtRecipe;

    int nSelCountry;
    int nSelCity;
    Calendar calendar;
    String sSelPUnit;
    int nSelPValue;
    boolean isTR;
    private DatePickerDialog.OnDateSetListener mDateSetListener;

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.main);

        txtTopDesc = (TextView)findViewById(R.id.txtTopDesc);
        txtCountryText = (TextView) findViewById(R.id.txtCountryText);
        txtCountrySel = (TextView) findViewById(R.id.txtCountrySel);
        txtCityText = (TextView)findViewById(R.id.txtCityText);
        txtCitySel = (TextView)findViewById(R.id.txtCitySel);
        txtDateSel = (TextView)findViewById(R.id.txtDateSel);
        txtPeriodSel = (TextView)findViewById(R.id.txtPeriodSel);
        edtRecipe = (EditText)findViewById(R.id.edtRecipe);

        txtTopDesc.setText(Html.fromHtml(getResources().getString(R.string.topdesc1) + "<font color='#0a4702'><b>" + sUserName + "</b></font>" + getResources().getString(R.string.topdesc2)));
        txtCountrySel.setOnClickListener(this);
        txtCitySel.setOnClickListener(this);

        txtPeriodSel.setOnClickListener(this);

      //  txtCountryText.setText(nCountryIndex);
        findViewById(R.id.btnCancel).setOnClickListener(this);
        findViewById(R.id.btnForward).setOnClickListener(this);
        findViewById(R.id.btnHelp).setOnClickListener(this);


        Init();

    }

    @SuppressLint("SetTextI18n")
    private void Init(){

        nSelCountry = nCountryIndex;
        nSelCity = nCityIndex;
        sSelPUnit = sPeriodUnit;
        nSelPValue = nPeriodVal;

        isTR = getResources().getString(R.string.locale).equals("tr");
        if(isTR)
        {
            nSelCountry = GlobalConstant.TURKEY_IND;
            txtCountryText.setVisibility(View.GONE);
            txtCountrySel.setVisibility(View.GONE);
        }
        else
        {
            if(nCountryIndex == 0) {
                txtCountrySel.setText(R.string.select);
            }
            else {
                txtCountrySel.setText(GlobalConstant.COUNTRY_LIST[nCountryIndex - 1]);
            }
        }

        if(isTR || nCountryIndex == GlobalConstant.TURKEY_IND)
        {
            if(nCityIndex == 0)
                txtCitySel.setText(R.string.select);
            else
                txtCitySel.setText(GlobalConstant.CITY_LIST[nCityIndex - 1]);
        }
        else
        {
            txtCitySel.setVisibility(View.GONE);
            txtCityText.setVisibility(View.GONE);
            nSelCity = GlobalConstant.ADANA_IND;
        }

        txtDateSel.setText(sSelDate);
        txtPeriodSel.setText(nPeriodVal + " " + sPeriodUnit);
        edtRecipe.setText(sRecipe);

        calendar = Calendar.getInstance();
        @SuppressLint("SimpleDateFormat") SimpleDateFormat sdf = new SimpleDateFormat(GlobalConstant.DATE_FORMAT);
        try {
            calendar.setTime(Objects.requireNonNull(sdf.parse(sSelDate)));
        } catch (ParseException e) {
            // TODO Auto-generated catch block
            e.printStackTrace();
        }

        txtDateSel.setOnClickListener(v -> {
            Calendar cal = Calendar.getInstance();
            int year = cal.get(Calendar.YEAR);
            int month = cal.get(Calendar.MONTH);
            int day = cal.get(Calendar.DAY_OF_MONTH);

            DatePickerDialog dialog =  new DatePickerDialog(
                    MainActivity.this,
                    android.R.style.Theme_Holo_Light_Dialog_MinWidth,
                    mDateSetListener,
                    year,month,day
            );

            DatePicker dp = dialog.getDatePicker();
            cal.add(Calendar.DAY_OF_MONTH,1);
            dp.setMinDate(cal.getTimeInMillis());
            dialog.getWindow().setBackgroundDrawable( new ColorDrawable( Color.TRANSPARENT ) );
            dialog.show();


        });

        mDateSetListener = (datePicker, year, month, day) -> {
            //month = month + 1;

            Log.d( "onDateSet" , month + "/" + day + "/" + year );
                    /*txtDateSel.setText( new StringBuilder().append( day ).append( "." )
                            .append( month ).append( "." ).append( year ) );*/

            try {
                if (month+1< 10 && day < 10) {

                    String fmonth = "0" + month;
                    //month = Integer.parseInt(fmonth);
                    month = Integer.parseInt(fmonth) + 1;
                    String fDate = "0" + day;
                    @SuppressLint("DefaultLocale") String paddedMonth = String.format("%02d", month);
                    txtDateSel.setText(fDate + "." + paddedMonth + "." + year);

                } else {

                    String fmonth = "0" + month;
                    month = Integer.parseInt(fmonth) + 1;
                    @SuppressLint("DefaultLocale") String paddedMonth = String.format("%02d", month);
                    txtDateSel.setText(day + "." + paddedMonth + "." + year);
                }

            } catch (Exception e) {
                e.printStackTrace();
            }
        };
    }

    @SuppressLint({"NonConstantResourceId", "SetTextI18n"})
    @Override
    public void onClick(View v) {
        // TODO Auto-generated method stub
        switch(v.getId()){
            case R.id.txtCountrySel:
                AlertDialog.Builder dlgc = new AlertDialog.Builder(MainActivity.this);
                dlgc.setItems(GlobalConstant.COUNTRY_LIST, (dialog, which) -> {
                    dialog.dismiss();
                    txtCountrySel.setText(GlobalConstant.COUNTRY_LIST[which]);
                    nSelCountry = which + 1;
                    if(GlobalConstant.COUNTRY_LIST[which].equals("Turkey"))
                    {
                        txtCityText.setVisibility(View.VISIBLE);
                        txtCitySel.setVisibility(View.VISIBLE);
                        if(nCityIndex == 0)
                        {
                            nSelCity = 0;
                            txtCitySel.setText(R.string.select);
                        }
                        else
                        {
                            nSelCity = nCityIndex;
                            txtCitySel.setText(GlobalConstant.CITY_LIST[nCityIndex - 1]);
                        }
                    }
                    else
                    {
                        txtCityText.setVisibility(View.GONE);
                        txtCitySel.setVisibility(View.GONE);
                        nSelCity = GlobalConstant.ADANA_IND;
                    }
                });
                dlgc.show();
                break;

            case R.id.txtCitySel:
                AlertDialog.Builder dlg = new AlertDialog.Builder(MainActivity.this);
                dlg.setItems(GlobalConstant.CITY_LIST, (dialog, which) -> {
                    dialog.dismiss();
                    txtCitySel.setText(GlobalConstant.CITY_LIST[which]);
                    nSelCity = which + 1;
                });
                dlg.show();
                break;

            case R.id.txtPeriodSel:
                PeriodSelDialog pseldlg = new PeriodSelDialog(MainActivity.this, sSelPUnit, nSelPValue);
                pseldlg.setOnDismissListener(dialog -> {
                    // TODO Auto-generated method stub
                    sSelPUnit = ((PeriodSelDialog)dialog).sPUnit;
                    nSelPValue = ((PeriodSelDialog)dialog).nPValue;
                    txtPeriodSel.setText(nSelPValue + " " + sSelPUnit);
                });
                pseldlg.show();
                break;
            case R.id.btnCancel:
                doExit();
                break;
            case R.id.btnForward:
                doForwarding();
                break;
            case R.id.btnHelp:
                HelpDialog helpdlg = new HelpDialog(MainActivity.this);
                helpdlg.show();
                break;
        }
    }

    private void doForwarding(){
        String sAlertMsg = "";
        String sRecipeVal = edtRecipe.getText().toString();

        if (nSelCountry == 0){
            sAlertMsg = getResources().getString(R.string.selectcountry);
        }else if (nSelCity == 0){
            sAlertMsg = getResources().getString(R.string.selectcity);
        }else if (sRecipeVal.equals("")){
            sAlertMsg = getResources().getString(R.string.inputrecipe);
        }

        if (!sAlertMsg.equals("")){
            AlertDialog.Builder alert = new AlertDialog.Builder(this);
            alert.setPositiveButton(R.string.ok, (dialog, which) -> dialog.dismiss());
            alert.setMessage(sAlertMsg);
            alert.show();
        }else{
            String texdate= txtDateSel.getText().toString();
            //Toast.makeText(MainActivity.this, ""+texdate, Toast.LENGTH_SHORT).show();
            Intent intent = new Intent(this, ConfirmActivity.class);
            intent.putExtra("countryindex",nSelCountry);
            intent.putExtra("cityindex", nSelCity);
            intent.putExtra("seldate", texdate);
            intent.putExtra("selpunit", sSelPUnit);
            intent.putExtra("selpval", nSelPValue);
            intent.putExtra("recdesc", sRecipeVal);
            setCountryInfo(nSelCountry, nSelCity );

            startActivityForResult(intent, GlobalConstant.REQUEST_BACK);
        }
    }



    protected void onActivityResult(int requestCode, int resultCode, Intent data) {
        super.onActivityResult(requestCode, resultCode, data);
        if (resultCode == GlobalConstant.RESULT_INIT) {
            Init();
        } else if (resultCode == GlobalConstant.RESULT_SUCCESS) {
            doInitStore();

            Init();

            AlertDialog.Builder alert = new AlertDialog.Builder(MainActivity.this);
            alert.setPositiveButton(R.string.ok, (dialog, which) -> dialog.dismiss());
            alert.setMessage(R.string.setsuccess);
            alert.show();
        }
    }

    private void doExit(){
        AlertDialog.Builder builder = new AlertDialog.Builder(this);
        builder.setMessage(R.string.exitalert)
                .setTitle(R.string.corresponding)
                .setCancelable(false)
                .setPositiveButton(R.string.yes,
                        (dialog, id) -> {
                            finish();
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
        doExit();
    }


    @SuppressLint("ApplySharedPref")
    public void setCountryInfo(int strCountryIndex, int strCityIndex){
        SharedPreferences.Editor editor= pref.edit();
        editor.putInt("countryindex", strCountryIndex);
        editor.putInt("cindex", strCityIndex);
        editor.commit();
    }
}
