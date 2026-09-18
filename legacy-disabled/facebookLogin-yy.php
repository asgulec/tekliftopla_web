<!-- <?php
// facebook login
session_start();
$lang=isset($_GET["lang"]) ? $_GET["lang"] : '';
if ($lang=="tr"){
	$_SESSION['lang'] = $lang;
}

require_once 'facebook-php-sdk5/src/Facebook/autoload.php';
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
?> -->
<?php
// Start session
session_start();

// Language handling
$lang = isset($_GET["lang"]) ? $_GET["lang"] : '';
if ($lang === "tr") {
    $_SESSION['lang'] = $lang;
}

// Load Facebook SDK
//require_once __DIR__ . '/facebook-php-sdk5/src/Facebook/autoload.php';
require_once 'facebook-php-sdk5/src/Facebook/autoload.php';
// Create Facebook object
$fb = new \Facebook\Facebook([
    'app_id' => '674383105958871',
    'app_secret' => '784b0a21387cfda69688f9fd5ad01548',
    'default_graph_version' => 'v19.0', // Updated to latest stable version
]);

// Get login helper
$helper = $fb->getRedirectLoginHelper();

// Permissions you want from the user
$permissions = ['email'];

// Build redirect URL safely
$redirectURL = "https://" . $_SERVER['SERVER_NAME'] . "/facebookLoginCallBack.php";

// Generate login URL
try {
    $loginUrl = $helper->getLoginUrl($redirectURL, $permissions);
} catch (Exception $e) {
    die("Facebook Login Error: " . $e->getMessage());
}

// Redirect user to Facebook login
header("Location: " . htmlspecialchars($loginUrl));
exit;
?>