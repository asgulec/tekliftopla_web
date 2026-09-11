<?
include"ayar.php";
session_start();
$connection=mysql_connect("$host","$user","$password") or die ("Could not connect to the MySQL Server");
$query="SET NAMES 'UTF8'";
mysql_query($query);
mysql_select_db($db);
if(!isset($_SESSION["verified_firmaid"])){
?>
<script type='text/javascript'>alert("Hata");
window.location = "index.php";
</script> 
<? }?>
