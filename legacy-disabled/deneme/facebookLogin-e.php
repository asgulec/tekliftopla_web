<?php

// facebook login

session_start();
$lang=isset($_GET["lang"]) ? $_GET["lang"] : '';
if ($lang=="tr"){
	$_SESSION['lang'] = $lang;
}
require 'facebook/facebook.php';

define('APP_ID', '674383105958871');
define('APP_SECRET', '784b0a21387cfda69688f9fd5ad01548');
$facebook = new Facebook(array(
            'appId' => APP_ID,
            'secret' => APP_SECRET,
            ));

$user = $facebook->getUser();
if ($user) {
  try {
    // Proceed knowing you have a logged in user who's authenticated.
    $user_profile = $facebook->api('/me');
  } 
  catch (FacebookApiException $e) {
    error_log($e);
    $user = null;
  }
  if (!empty($user_profile )) {
        # User info ok? Let's print it (Here we will be adding the login and registering routines)
        $username = $user_profile['name'];
		$uid = $user_profile['id'];
		$email = $user_profile['email'];
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
		$sql1="SELECT sifre,email,firmaid,Firma_Adi FROM bilgi WHERE email='$email' ";
        $result1 = mysqli_query($connection,$sql1) or die ("Couldn't execute SQL query");
        $etki1=mysqli_num_rows($result1);
        if($etki1)
        {
          while($row=mysqli_fetch_array($result1)){
            $str78="update bilgi set aktivite='1' where email='$email'";
		    $result78=mysqli_query($connection,$str78) or die ("Couldn't execute SQL query");
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
} else {
    # There's no active session, let's generate one
	$login_url = $facebook->getLoginUrl(array( 'scope' => 'email'));
    header("Location: " . $login_url);
}

?>



