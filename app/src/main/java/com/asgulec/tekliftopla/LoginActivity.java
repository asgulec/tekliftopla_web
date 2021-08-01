package com.asgulec.tekliftopla;

import android.annotation.SuppressLint;
import android.app.AlertDialog;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.preference.PreferenceManager;
import android.util.Log;
import android.view.View;
import android.view.View.OnClickListener;

import java.util.Arrays;

import com.facebook.CallbackManager;
import com.facebook.FacebookCallback;
import com.facebook.FacebookException;
import com.facebook.GraphRequest;
import com.facebook.login.LoginManager;
import com.facebook.login.LoginResult;
import com.google.android.gms.auth.api.Auth;
import com.google.android.gms.auth.api.signin.GoogleSignInAccount;
import com.google.android.gms.auth.api.signin.GoogleSignInOptions;
import com.google.android.gms.auth.api.signin.GoogleSignInResult;
import com.google.android.gms.common.api.GoogleApiClient;

public class LoginActivity extends BaseActivity implements OnClickListener {
  CallbackManager callbackManager;
  GoogleApiClient mGoogleApiClient;
  private final int RC_SIGN_IN = 1234;

  @Override public void onCreate(Bundle savedInstanceState) {
    super.onCreate(savedInstanceState);
    setContentView(R.layout.login);
    final SharedPreferences sharedPreferences = PreferenceManager.getDefaultSharedPreferences(this);
    if (sharedPreferences.getBoolean("is_first_run", true)) {
      new AlertDialog.Builder(this).setMessage(getString(R.string.conditions))
          .setPositiveButton(R.string.yes, (dialog, which) -> sharedPreferences.edit().putBoolean("is_first_run", false))
          .setNegativeButton(R.string.no, (dialog, which) -> finish())
          .show();
    }
    findViewById(R.id.layoutFacebookLogin).setOnClickListener(this);
    findViewById(R.id.layoutGoogleLogin).setOnClickListener(this);
    callbackManager = CallbackManager.Factory.create();
    LoginManager.getInstance()
        .registerCallback(callbackManager, new FacebookCallback<LoginResult>() {
          @Override public void onSuccess(LoginResult loginResult) {
            Log.e("login_result", loginResult.toString());
            GraphRequest request = GraphRequest.newMeRequest(loginResult.getAccessToken(),
                    (object, response) -> {
                      // Application code
                      assert object != null;
                      String name = object.optString("name");
                      String email = object.optString("email");
                      setUserInfo(name, email);
                      doLoginSuccess();
                    });
            Bundle parameters = new Bundle();
            parameters.putString("fields", "id,name,email");
            request.setParameters(parameters);
            request.executeAsync();
          }

          @Override public void onCancel() {
          }

          @Override public void onError(FacebookException error) {
          }
        });

    GoogleSignInOptions gso = new GoogleSignInOptions.Builder(GoogleSignInOptions.DEFAULT_SIGN_IN)
            .requestEmail()
            .build();

    // Build a GoogleApiClient with access to GoogleSignIn.API and the options above.
    mGoogleApiClient = new GoogleApiClient.Builder(this)
            .enableAutoManage(this, connectionResult -> {

            })
            .addApi(Auth.GOOGLE_SIGN_IN_API, gso)
            .build();
  }

  @SuppressLint("NonConstantResourceId")
  @Override public void onClick(View v) {
    // TODO Auto-generated method stub
    switch (v.getId()) {
      case R.id.layoutFacebookLogin:
        LoginManager.getInstance()
            .logInWithReadPermissions(this, Arrays.asList("public_profile", "email"));
        break;
      case R.id.layoutGoogleLogin:
        LoginViaGoogle();
        break;
    }
  }

  @Override
  protected void onActivityResult(final int requestCode, final int resultCode, final Intent data) {
    super.onActivityResult(requestCode, resultCode, data);
    if (requestCode == RC_SIGN_IN) {
      GoogleSignInResult result = Auth.GoogleSignInApi.getSignInResultFromIntent(data);
      assert result != null;
      if (result.isSuccess()) {
        GoogleSignInAccount acct = result.getSignInAccount();
        // Get account information
        assert acct != null;
        String mFullName = acct.getDisplayName();
        String mEmail = acct.getEmail();
        assert mFullName != null;
        if (!mFullName.equals("")) {
          assert mEmail != null;
          if (!mEmail.equals("")) {
            setUserInfo(mFullName, mEmail);
            doLoginSuccess();
          }
        }
      }
    }
    else
    {
      callbackManager.onActivityResult(requestCode, resultCode, data);
    }
  }

  public void doLoginSuccess() {
    Intent intent = new Intent(LoginActivity.this, MainActivity.class);
    startActivity(intent);
    finish();
  }

  private void LoginViaGoogle() {

    Intent signInIntent = Auth.GoogleSignInApi.getSignInIntent(mGoogleApiClient);
    startActivityForResult(signInIntent, RC_SIGN_IN);
  }
}
