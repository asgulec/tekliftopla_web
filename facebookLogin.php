<?php
// facebook login
session_start();
$lang=isset($_GET["lang"]) ? $_GET["lang"] : '';
if ($lang=="tr"){
	$_SESSION['lang'] = $lang;
}

require_once 'facebook-php-sdk5/src/Facebook/autoload.php';

if (isset($_SESSION['fb_access_token']) && !empty($_SESSION['fb_access_token'])) {
    $expiresAt = $_SESSION['fb_access_token_expires_at'] ?? 0;
    if ((int) $expiresAt > time()) {
        header('Location: facebookLoginCallBack.php');
        exit;
    }

    unset($_SESSION['fb_access_token']);
    unset($_SESSION['fb_access_token_expires_at']);
}

$fb = new \Facebook\Facebook ([
    'app_id' => '674383105958871',
    'app_secret' => '784b0a21387cfda69688f9fd5ad01548',
    'default_graph_version' => 'v2.2',
    
    //'default_access_token' => '{access-token}', // optional
]);

$helper = $fb->getRedirectLoginHelper();

$permissions = ['email']; // Optional permissions
$redirectURL = "https://".$_SERVER['SERVER_NAME']."/facebookLoginCallBack.php";
$loginUrl = $helper->getLoginUrl($redirectURL, $permissions);

//echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>';

//header("Location:".htmlspecialchars($loginUrl));

echo("<meta http-equiv='refresh' content=\"0;URL='". htmlspecialchars($loginUrl) ."'\" />");
exit;
?>