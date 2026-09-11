<?php
include "headeryon.php";
/*include"ayar.php";
session_start();
$connection=mysql_connect("$host","$user","$password") or die ("Could not connect to the MySQL Server");
$query="SET NAMES 'UTF8'";
mysql_query($query); */
$verified_kulid = $_SESSION["verified_kulid"];
$tempppx2="delete from gecici2 where kullanim='$verified_kulid'";
$etkinp2=mysqli_query($coni,$tempppx2);

$tempppx3="delete from gecici3 where kullanim='$verified_kulid'";
$etkinp3=mysqli_query($coni,$tempppx3);

$tempppx4="delete from gecici4 where kullanim='$verified_kulid'";
$etkinp4=mysqli_query($coni,$tempppx4);

$www="delete from gecici5 where kullanim='$verified_kulid'";
$etkinp5=mysqli_query($coni,$www);

$tempppx6="delete from gecici6 where kullanim='$verified_kulid'";
$etkinp6=mysqli_query($coni,$tempppx6);
$verified_sifre1="";
$verified_sehirid="";
$verified_kulid = "";
$_SESSION['verified_sehirid']=$verified_sehirid;
//session_register("verified_sehirid");
unset($_SESSION['verified_sehirid']);
//session_unregister("verified_sehirid");
$_SESSION['verified_sifre1']=$verified_sifre1;
//session_register("verified_sifre1");
unset($_SESSION['verified_sifre1']);
//session_unregister("verified_sifre1");
$_SESSION['verified_kulid']=$verified_kulid;
//session_register("verified_kulid");
unset($_SESSION['verified_kulid']);
//session_unregister("verified_kulid");
header("location:yonetimkullanim.php");
?>
