<?php include "headeri.php";
/*include"ayar.php";
session_start();
$connection=mysql_connect("$host","$user","$password") or die ("Could not connect to the MySQL Server");
$query="SET NAMES 'UTF8'";
mysql_query($query);
*/
if(!isset($_SESSION["verified_firmaid"]) and !isset($_SESSION["verified_sifrem"])){
?>
<script type='text/javascript'>alert("Hata");</script> 
<?php
}
else
{
$verified_firmaid = $_SESSION["verified_firmaid"];
$verified_kulid = $_SESSION["verified_kulid"];
$tempppx3="delete from gecici3 where kullanimid='$verified_kulid' or kullanimid='0'";
$etkinp3=mysqli_query($connection,$tempppx3);
$tempppx4="delete from gecici4 where kullanimid='$verified_kulid' or kullanimid='0'";
$etkinp4=mysqli_query($connection,$tempppx4);
$www="delete from gecici5 where kullanimid='$verified_kulid' or kullanimid='0'";
$etkinp5=mysqli_query($connection,$www);
$tempppx6="delete from gecici6 where kullanimid='$verified_kulid' or kullanimid='0'";
$etkinp6=mysqli_query($connection,$tempppx6);
unset($_SESSION['verified_kulid']);
//session_unregister("verified_kulid");
Header("Location:giris.php");
}
?>