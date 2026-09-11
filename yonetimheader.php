<?
include"ayar.php";
session_start();
$connection=mysql_connect("$host","$user","$password") or die ("Could not connect to the MySQL Server");
mysql_select_db($db);
$coni = mysqli_connect($host,$user,$password,$db) or die("Some error occurred during connection " . mysqli_error($coni));
mysqli_query($coni,"SET NAMES 'UTF8'");
$query="SET NAMES 'UTF8'";
mysql_query($query);
if(!isset($_SESSION["verified_pass"]) and !isset($_SESSION["verified_user"]))
{
?>
<script type='text/javascript'>alert("Hata");
window.location = "tradmin.php";
</script> 
<? } 
else
{
	$verified_user = $_SESSION["verified_user"];
}
?>