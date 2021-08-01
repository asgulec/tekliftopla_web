package com.asgulec.tekliftopla;

import android.app.Application;

public class MyApplication extends Application
{
    @Override
    public void onCreate()
    {
        super.onCreate();

        GlobalConstant.Init(this);
    }
}