<?
include"ayar.php";
session_start();
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
<? }?>
