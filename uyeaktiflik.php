<?
include"ayar.php";
session_start();
/*$connection=mysql_connect("$host","$user","$password") or die ("Could not connect to the MySQL Server");
$query="SET NAMES 'UTF8'";
mysql_query($query);*/
$connection=mysqli_connect($host,$user,$password,$db);
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
mysqli_set_charset($connection,"utf8");
$deger = "0";
$secililiste=$_POST["secililiste"];
if (isset($_POST["cbAktif"]))
	$deger	= "0";
else
	$deger	= "1";
$str2="update bilgi set aktivite=" . $deger . " where firmaid IN " . $secililiste;
$result2=mysqli_query($connection,$str2);

header("location:uyelistesi.php");
?>
