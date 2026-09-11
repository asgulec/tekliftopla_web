<?
include"ayar.php";
$coni = mysqli_connect($host,$user,$password,$db);
if (mysqli_connect_errno())
   {
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
   } 
mysqli_set_charset($coni,"utf8");

/*session_start();
$connection=mysql_connect("$host","$user","$password") or die ("Could not connect to the MySQL Server");
$query="SET NAMES 'UTF8'";
mysql_query($query)*/;
$secililiste=$_POST["secililiste"];
$str2="update bilgi set proflag=2 where firmaid IN " . $secililiste;
$result2=mysqli_query($coni,$str2);
//echo $str2;
header("location:uyelistesi.php");
exit;
?>
