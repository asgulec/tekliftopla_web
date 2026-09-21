<?
include"ayar.php";
tekliftopla_start_session();
$connection=mysqli_connect($host,$user,$password,$db);
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
mysqli_set_charset($connection,"utf8");

if(!isset($_SESSION["verified_firmaid"])){
?>
<script type='text/javascript'>alert("Hata");
window.location = "index.php";
</script> 
<? } else {
    tekliftopla_require_csrf();
    ob_start('tekliftopla_inject_csrf_fields');
}?>
