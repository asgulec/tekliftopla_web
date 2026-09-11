<?
session_start();

unset($_SESSION['fb_access_token']);
unset($_SESSION['fb_user']);
unset($_SESSION['oauth_id']);
unset($_SESSION['oauth_provider']);
unset($_SESSION['username']);
unset($_SESSION['email']);

$verified_firmaid="";
$verified_sifrem="";
$_SESSION['verified_firmaid']=$verified_firmaid;
$_SESSION['verified_sifrem']=$verified_sifrem;

//session_register("verified_firmaid");
//session_register("verified_sifrem");
//session_unregister("verified_firmaid");
//session_unregister("verified_sifrem");

unset($_SESSION['verified_firmaid']);
unset($_SESSION['verified_sifrem']);
unset($_SESSION['verified_gemail']);

//header("location:googleLogin.php?reset=1");

session_destroy();
header("location:http://www.tekliftopla.com/index.php");
exit;
?>
