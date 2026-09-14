<?
include"../ayar.php";
session_start();
$connection=mysql_connect("$host","$user","$password") or die ("Could not connect to the MySQL Server");
$query="SET NAMES 'UTzzF8'";
mysql_query($query);
mysql_select_db($db);
if(!isset($_SESSION["verified_firmaid"]) || !isset($_SESSION["verified_sifrem"])){ 
	header("Location: index-e.php");
	exit;
}
$verified_firmaid = $_SESSION["verified_firmaid"];
?>
