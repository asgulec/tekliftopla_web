<?
include "headeryon.php";
/*include"ayar.php";
session_start();
$connection=mysql_connect("$host","$user","$password") or die ("Could not connect to the MySQL Server");
$query="SET NAMES 'UTF8'";
mysql_query($query);
*/
$deger = "0";
$secililiste=mysqli_real_escape_string($coni,$_POST["secililiste"]);
if (isset($_POST["cbreadable"]))
	$deger	= "0";
else
	$deger	= "1";
$str2="update kullanim set readable=" . $deger . " where kullanimid IN " . $secililiste;
$result2=mysqli_query($coni,$str2);

header("location:kullanimlistesi.php");
?>
