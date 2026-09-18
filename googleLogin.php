<?php
//include google api files
require_once 'src/Google_Client.php';
require_once 'src/contrib/Google_Oauth2Service.php';

//start session
session_start();
include"ayar.php";
$lang=isset($_GET["lang"]) ? $_GET["lang"] : '';
if ($lang=="tr"){
	$_SESSION['lang'] = $lang;
}
########## Google Settings.. Client ID, Client Secret from https://cloud.google.com/console #############
$google_client_id       = '834831338119-grfin81o8pvs9a6v47opouqiu9g6sld5.apps.googleusercontent.com';
$google_client_secret   = $asg_google_secret;
$google_redirect_url    = 'https://www.tekliftopla.com/googleLogin.php'; //'http://localhost/google/'; //path to your script
$google_developer_key   = $asg_google_developer_key;
$gClient = new Google_Client();
$gClient->setApplicationName('tekliftopla');
$gClient->setClientId($google_client_id);
$gClient->setClientSecret($google_client_secret);
$gClient->setRedirectUri($google_redirect_url);
$gClient->setDeveloperKey($google_developer_key);
$gClient->setApprovalPrompt("auto");

$google_oauthV2 = new Google_Oauth2Service($gClient);

//If user wish to log out, we just unset Session variable
if (isset($_REQUEST['reset']))
{
  unset($_SESSION['token']);
  unset($_SESSION['token_expires_at']);
  $gClient->revokeToken();
  //header("location:http://www.tekliftopla.com/index.php"); //ASG
  //return; //ASG
  header('Location: ' . filter_var($google_redirect_url, FILTER_SANITIZE_URL)); //redirect user back to page
}

if (isset($_GET['error'])) //ASG
{ 
    if(isset($_SESSION['lang'])){
	header('Location: index.php');
    return;
	} else {
	header('Location: en/index-e.php');
    return;
	}
}

//If code is empty, redirect user to google authentication page for code.
//Code is required to aquire Access Token from google
//Once we have access token, assign token to session variable
//and we can redirect user back to page and login.
if (isset($_GET['code'])) 
{ 
    try {
        $gClient->authenticate($_GET['code']);
        $_SESSION['token'] = $gClient->getAccessToken();
    } catch (Exception $e) {
        unset($_SESSION['token']);
        if(isset($_SESSION['lang'])){
            header('Location: index.php?google_error=1');
        } else {
            header('Location: en/index-e.php?google_error=1');
        }
        return;
    }
    header('Location: ' . filter_var($google_redirect_url, FILTER_SANITIZE_URL));
    return;
}

if (isset($_SESSION['token']) && !empty($_SESSION['token'])) {
    $gClient->setAccessToken($_SESSION['token']);
}


if ($gClient->getAccessToken()) 
{
      try {
          //For logged in user, get details from google using access token
          $user                 = $google_oauthV2->userinfo->get();

          if (is_array($user)) {
              $user_id              = isset($user['id']) ? $user['id'] : '';
              $user_name            = isset($user['name']) ? filter_var($user['name'], FILTER_SANITIZE_SPECIAL_CHARS) : '';
              $email                = isset($user['email']) ? filter_var($user['email'], FILTER_SANITIZE_EMAIL) : '';
              $profile_url          = isset($user['link']) ? filter_var($user['link'], FILTER_VALIDATE_URL) : '';
              $profile_image_url    = isset($user['picture']) ? filter_var($user['picture'], FILTER_VALIDATE_URL) : '';
          } else {
              $user_id              = $user->getId();
              $user_name            = filter_var($user->getName(), FILTER_SANITIZE_SPECIAL_CHARS);
              $email                = filter_var($user->getEmail(), FILTER_SANITIZE_EMAIL);
              $profile_url          = filter_var($user->getLink(), FILTER_VALIDATE_URL);
              $profile_image_url    = filter_var($user->getPicture(), FILTER_VALIDATE_URL);
          }

          $personMarkup         = "$email<div><img src='$profile_image_url?sz=50'></div>";
          $_SESSION['token']    = $gClient->getAccessToken();
      } catch (Exception $e) {
          unset($_SESSION['token']);
          if(isset($_SESSION['lang'])){
              header('Location: index.php?google_error=1');
          } else {
              header('Location: en/index-e.php?google_error=1');
          }
          return;
      }
}
else 
{
    //For Guest user, get google login url
    $authUrl = $gClient->createAuthUrl();
}

//HTML page start
/* echo '<!DOCTYPE HTML><html>';
echo '<head>';
echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
echo '<title>Login with Google</title>';
echo '</head>';
echo '<body>';
echo '<h1>Login with Google</h1>'; */

if(isset($authUrl)) //user is not logged in, show login button
{
    header('Location: ' . $authUrl);
	return;
	// ASG echo '<a class="login" href="'.$authUrl.'"><img src="image/Red-signin-Long-20dp.gif" /></a>';
} 
else // user logged in 
{
   /* connect to database using mysqli */
    include "ayar.php";
	$connection=mysqli_connect($host,$user,$password,$db);
	if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
		}
	mysqli_set_charset($connection,"utf8");
	/*$link=mysql_connect($host,$user,$password)or die ("Unable to connect to MySQL server.");
    $query="SET NAMES 'UTF8'";
    mysql_query($query);*/
	/*$mysqli = new mysqli($host, $user, $password, $db);
    if ($mysqli->connect_error) {
        die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
    }
    
    //compare user id in our database
    $user_exist = $mysqli->query("SELECT COUNT(email) as usercount FROM bilgi WHERE email=$email")->fetch_object()->usercount; 
    if($user_exist) */
    $email = trim($email);
    $statement = mysqli_prepare($connection, "SELECT sifre, email, firmaid, Firma_Adi FROM bilgi WHERE LOWER(email) = LOWER(?) LIMIT 1");
    $result1 = false;
    if ($statement) {
        mysqli_stmt_bind_param($statement, "s", $email);
        mysqli_stmt_execute($statement);
        $result1 = mysqli_stmt_get_result($statement);
    }
    $etki1=mysqli_num_rows($result1);
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
		if(isset($_SESSION['lang'])){
			header('location:giris.php');
		    exit();
		    } else {
			header('location:en/giris-e.php');
		    exit();
			}
		//return;
		}
        
		// ASG echo 'Welcome back '.$user_name.'!';
    }else{ 
        //user is new
        //echo 'Hi '.$user_name.', Thanks for Registering!';
        $_SESSION['verified_gemail']=$email;
		$_SESSION['verified_gfirma']=$user_name;
		if(isset($_SESSION['lang'])){
		   header('location:kayit-g.php');
		   exit ();
		   } else {
		   header('location:en/kayit-ge.php');
		   exit();
		   }
		/* $mysqli->query("INSERT INTO google_users (google_id, google_name, google_email, google_link, google_picture_link) 
        VALUES ($user_id, '$user_name','$email','$profile_url','$profile_image_url')"); */
    }

    
   /* echo '<br /><a href="'.$profile_url.'" target="_blank"><img src="'.$profile_image_url.'?sz=100" /></a>';
    echo '<br /><a class="logout" href="?reset=1">Logout</a>';
    
    //list all user details
    echo '<pre>'; 
    print_r($user);
    echo '</pre>';
	echo $email;  
}
 
echo '</body></html>'; */
}
?>