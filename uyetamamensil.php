<?
include"ayar.php";
session_start();
$coni = mysqli_connect($host,$user,$password,$db);
if (mysqli_connect_errno())
   {
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
   } 
mysqli_set_charset($coni,"utf8");

/*$connection=mysql_connect("$host","$user","$password") or die ("Could not connect to the MySQL Server");
$query="SET NAMES 'UTF8'";
mysql_query($query);*/
$secililiste=$_POST["secililiste"];
$str2="delete from bilgi where firmaid IN " . $secililiste;
$result2=mysqli_query($coni,$str2);

$str2="delete from firma_sehir where firmaid IN " . $secililiste;
$result2=mysqli_query($coni,$str2);

$str2="delete from firma_sektor where firmaid IN " . $secililiste;
$result2=mysqli_query($coni,$str2);

/* $str2="DELETE a.*, b.*, c.*
FROM bilgi as a, firma_sehir as b, firma_sektor as c
WHERE a.firmaid = b.firmaid
AND b.firmaid = c.firmaid
AND a.aktivite=0
AND a.firmaid IN " . $secililiste;
$result2=mysql_db_query($db,"$str2");
*/

header("location:uyelistesi.php");
?>
