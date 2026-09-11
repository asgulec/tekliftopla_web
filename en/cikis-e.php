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
unset($_SESSION['verified_firmaid']);
unset($_SESSION['verified_sifrem']);
unset($_SESSION['verified_gemail']);
session_destroy();
header("location:http://www.tekliftopla.com/en/index-e.php");
exit;
?>
