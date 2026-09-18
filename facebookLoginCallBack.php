<?php

// facebook login
session_start();
require_once 'facebook-php-sdk5/src/Facebook/autoload.php';

$fb = new Facebook\Facebook([
  'app_id' => '674383105958871', // Replace {app-id} with your app id
  'app_secret' => '784b0a21387cfda69688f9fd5ad01548',
  'default_graph_version' => 'v2.2',
  ]);

$helper = $fb->getRedirectLoginHelper();

$accessToken = null;
$response = null;

if (isset($_SESSION['fb_access_token']) && !empty($_SESSION['fb_access_token'])) {
  $expiresAt = $_SESSION['fb_access_token_expires_at'] ?? 0;
  if ((int) $expiresAt > time()) {
    $accessToken = new \Facebook\Authentication\AccessToken($_SESSION['fb_access_token'], (int) $expiresAt);
  } else {
    unset($_SESSION['fb_access_token']);
    unset($_SESSION['fb_access_token_expires_at']);
  }
}

if (!isset($accessToken)) {
  try {
    $accessToken = $helper->getAccessToken();
  } catch(Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
  } catch(Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
  }
}

if (! isset($accessToken)) {
  if ($helper->getError()) {
    header('HTTP/1.0 401 Unauthorized');
    echo "Error: " . $helper->getError() . "\n";
    echo "Error Code: " . $helper->getErrorCode() . "\n";
    echo "Error Reason: " . $helper->getErrorReason() . "\n";
    echo "Error Description: " . $helper->getErrorDescription() . "\n";
  } else {
    header('HTTP/1.0 400 Bad Request');
    echo 'Bad request';
  }
  exit;
}

// Logged in
//echo '<h3>Access Token</h3>';
//var_dump($accessToken->getValue());

// The OAuth 2.0 client handler helps us manage access tokens
$oAuth2Client = $fb->getOAuth2Client();

// Get the access token metadata from /debug_token
$tokenMetadata = $oAuth2Client->debugToken($accessToken);
//echo '<h3>Metadata</h3>';
//var_dump($tokenMetadata);

// Validation (these will throw FacebookSDKException's when they fail)
$tokenMetadata->validateAppId('674383105958871'); // Replace {app-id} with your app id
// If you know the user ID this access token belongs to, you can validate it here
//$tokenMetadata->validateUserId('123');
$tokenMetadata->validateExpiration();

if (! $accessToken->isLongLived()) {
  // Exchanges a short-lived access token for a long-lived one
  try {
    $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
  } catch (Facebook\Exceptions\FacebookSDKException $e) {
    echo "<p>Error getting long-lived access token: " . $e->getMessage() . "</p>\n\n";
    exit;
  }

//  echo '<h3>Long-lived</h3>';
//  var_dump($accessToken->getValue());
}

$_SESSION['fb_access_token'] = (string) $accessToken;
if ($accessToken->getExpiresAt() instanceof \DateTime) {
  $_SESSION['fb_access_token_expires_at'] = $accessToken->getExpiresAt()->getTimestamp();
} else {
  $_SESSION['fb_access_token_expires_at'] = 0;
}

$fb->setDefaultAccessToken($accessToken);

try {
  $response = $fb->get('/me?fields=email,name,id');
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

if ($response === null) {
  die("There was an error.");
}


// User is logged in with a long-lived access token.
// You can redirect them to a members-only page.
//header('Location: https://example.com/members.php');

$user = $response->getGraphUser();
if (!empty($user)) {
        # User info ok? Let's print it (Here we will be adding the login and registering routines)
        $username = $user['name'];
		$uid = $user['id'];
		$email = $user['email'];
		$_SESSION['id'] = $uid;
        $_SESSION['oauth_id'] = $uid;
        $_SESSION['username'] = $username;
		$_SESSION['email'] = $email;
        $_SESSION['oauth_provider'] = 'facebook';
     	include "ayar.php";
	    $connection=mysqli_connect($host,$user,$password,$db);
		if (!$connection) {
    		die("Connection failed: " . mysqli_connect_error());
			}
		mysqli_set_charset($connection,"utf8");
		$email = trim($email);
		$statement = mysqli_prepare($connection, "SELECT sifre, email, firmaid, Firma_Adi FROM bilgi WHERE LOWER(email) = LOWER(?) LIMIT 1");
    $result1 = false;
    if ($statement) {
      mysqli_stmt_bind_param($statement, "s", $email);
      mysqli_stmt_execute($statement);
      $result1 = mysqli_stmt_get_result($statement);
    }
    $etki1 = $result1 ? mysqli_num_rows($result1) : 0;
        if($etki1)
        {
          while($row=mysqli_fetch_array($result1)){
      		    $updateStatement = mysqli_prepare($connection, "UPDATE bilgi SET aktivite = '1' WHERE email = ?");
            if ($updateStatement) {
              mysqli_stmt_bind_param($updateStatement, "s", $email);
              mysqli_stmt_execute($updateStatement);
              mysqli_stmt_close($updateStatement);
            }
		    $verified_email=$row['email'];
            $_SESSION['verified_email']=$verified_email;
            $verified_sifrem=$row['sifre'];
            $_SESSION['verified_sifrem']=$verified_sifrem;
            $verified_firmaid=$row['firmaid'];
            $_SESSION['verified_firmaid']=$verified_firmaid;
            $firma=$row['Firma_Adi'];	
            $verified_firma=$firma;
            $_SESSION['verified_firma']=$verified_firma;
            unset($_SESSION['id']);
            unset($_SESSION['username']);
            unset($_SESSION['oauth_provider']);
			unset($_SESSION['oauth_id']);
			unset($_SESSION['email']);
		    if(isset($_SESSION['lang']))
		    {
			  header('location:giris.php');
		      exit();
		    } else {
			  header('location:en/giris-e.php');
		      exit();
			}

		  }
        }else{ 
         $_SESSION['verified_gemail']=$email;
		 $_SESSION['verified_gfirma']=$username;
		 unset($_SESSION['id']);
         unset($_SESSION['username']);
         unset($_SESSION['oauth_provider']);
		 if(isset($_SESSION['lang']))
		 {
		   header('location:kayit-g.php');
		   exit ();
		 } else {
		   header('location:en/kayit-ge.php');
		   exit();
		 }
		 }

		

    } else {

        # For testing purposes, if there was an error, let's kill the script

        die("There was an error.");

    }

?>

*/

