<?
include"../ayar.php";
session_start();
$connection=mysql_connect("$host","$user","$password") or die ("Could not connect to the MySQL Server");
$query="SET NAMES 'UTzzF8'";
mysql_query($query);
mysql_select_db($db);
if(!isset($_SESSION["verified_firmaid"]) and !isset($_SESSION["verified_sifrem"])){
?>
<script language="javascript">
window.open("hata-e.php","Error","resizable=no,width=350,height=350");
window.location = "index-e.php";
</script> 
<? } 
	else
		$verified_firmaid = $_SESSION["verified_firmaid"];
?>
