<? include"ayar.php";
session_start();
$connection=mysqli_connect($host,$user,$password,$db);
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
mysqli_set_charset($connection,"utf8");
/*$connection=mysql_connect("$host","$user","$password") or die ("Could not connect to the MySQL Server");
$query="SET NAMES 'UTF8'";
mysql_query($query);*/
$verified_kulid = $_SESSION["verified_kulid"];
$tempppx3="delete from gecici3 where kullanimid='$verified_kulid'";
$etkinp3=mysqli_query($connection,$tempppx3);
$tempppx4="delete from gecici4 where kullanimid='$verified_kulid'";
$etkinp4=mysqli_query($connection,$tempppx4);
$www="delete from gecici5 where kullanimid='$verified_kulid'";
$etkinp5=mysqli_query($connection,$www);
$tempppx6="delete from gecici6 where kullanimid='$verified_kulid'";
$etkinp6=mysqli_query($connection,$tempppx6);
$thy1="update kullanim set tamam='0' where Kullanimid='$verified_kulid'";
$thy=mysqli_query($connection,$thy1);
$verified_sifre1="";
$verified_sehirid="";
$_SESSION['verified_sehirid']=$verified_sehirid;
//session_register("verified_sehirid");
$_SESSION['verified_sifre1']=$verified_sifre1;
//session_register("verified_sifre1");
header("location:kullanim.php?kul=$verified_kulid");
exit;
?>
