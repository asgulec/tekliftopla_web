<?php
session_start();

require_once __DIR__ . '/facebook-php-sdk5/src/Facebook/autoload.php';

// Facebook SDK configuration
$fb = new \Facebook\Facebook([
    'app_id' => '674383105958871',
    'app_secret' => '784b0a21387cfda69688f9fd5ad01548',
    'default_graph_version' => 'v19.0',
]);

$helper = $fb->getRedirectLoginHelper();

// --- GET ACCESS TOKEN ---
try {
    $accessToken = $helper->getAccessToken();
} catch (Facebook\Exceptions\FacebookResponseException $e) {
    die("Graph returned an error: " . $e->getMessage());
} catch (Facebook\Exceptions\FacebookSDKException $e) {
    die("Facebook SDK returned an error: " . $e->getMessage());
}

if (!isset($accessToken)) {
    die("Unable to obtain access token.");
}

// --- VALIDATE TOKEN ---
$oAuth2Client = $fb->getOAuth2Client();
$tokenMetadata = $oAuth2Client->debugToken($accessToken);

$tokenMetadata->validateAppId('YOUR_APP_ID');
$tokenMetadata->validateExpiration();

// Convert to long-lived token
if (!$accessToken->isLongLived()) {
    try {
        $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
    } catch (Facebook\Exceptions\FacebookSDKException $e) {
        die("Error getting long-lived access token: " . $e->getMessage());
    }
}

$_SESSION['fb_access_token'] = (string)$accessToken;

// --- GET USER DATA ---
$fb->setDefaultAccessToken($accessToken);

try {
    $response = $fb->get('/me?fields=id,name,email');
    $user = $response->getGraphUser();
} catch (Facebook\Exceptions\FacebookResponseException $e) {
    die("Graph returned an error: " . $e->getMessage());
} catch (Facebook\Exceptions\FacebookSDKException $e) {
    die("Facebook SDK returned an error: " . $e->getMessage());
}

if (empty($user)) {
    die("Unable to fetch user information.");
}

$uid    = $user['id'];
$name   = $user['name'];
$email  = $user['email'];

// Store temporary session data
$_SESSION['oauth_provider'] = 'facebook';
$_SESSION['oauth_id']       = $uid;
$_SESSION['username']       = $name;
$_SESSION['email']          = $email;

// --- DATABASE CHECK ---
include "ayar.php";
$connection = mysqli_connect($host, $user, $password, $db);

if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}

mysqli_set_charset($connection, "utf8");

// Check if user exists
$sql = "SELECT sifre, email, firmaid, Firma_Adi FROM bilgi WHERE email = '$email'";
$result = mysqli_query($connection, $sql);

if (mysqli_num_rows($result)) {

    // Existing user
    $row = mysqli_fetch_assoc($result);

    mysqli_query($connection, "UPDATE bilgi SET aktivite='1' WHERE email='$email'");

    $_SESSION['verified_email']    = $row['email'];
    $_SESSION['verified_sifrem']   = $row['sifre'];
    $_SESSION['verified_firmaid']  = $row['firmaid'];
    $_SESSION['verified_firma']    = $row['Firma_Adi'];

    // Clear temporary OAuth data
    unset($_SESSION['id'], $_SESSION['username'], $_SESSION['oauth_provider'], $_SESSION['oauth_id'], $_SESSION['email']);

    // Redirect based on language
    if (isset($_SESSION['lang'])) {
        header("Location: giris.php");
    } else {
        header("Location: en/giris-e.php");
    }
    exit;

} else {

    // New user → redirect to registration
    $_SESSION['verified_gemail'] = $email;
    $_SESSION['verified_gfirma'] = $name;

    unset($_SESSION['id'], $_SESSION['username'], $_SESSION['oauth_provider']);

    if (isset($_SESSION['lang'])) {
        header("Location: kayit-g.php");
    } else {
        header("Location: en/kayit-ge.php");
    }
    exit;
}

?>

