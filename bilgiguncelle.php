<?php include "headeri.php";
/*include"ayar.php";
$connection=mysql_connect("$host","$user","$password") or die ("Could not connect to the MySQL Server");
$query="SET NAMES 'UTF8'";
mysql_query($query);
*/if(!isset($_SESSION["verified_firmaid"])  and !isset($_SESSION["verified_sifrem"])){
?>
<script type='text/javascript'>alert("Hata");</script>
<?
}
else
{
$verified_firmaid = $_SESSION["verified_firmaid"];
$tur = $_POST["tur"];
switch($tur) 
{
// kullanymdan gelen bilgiyi ekleme;
case'f';
	$fax_alankodu = mysqli_real_escape_string($connection,$_POST["fax_alankodu"]);
	$Fax = mysqli_real_escape_string($connection,$_POST["Fax"]);
	$ekle1="Update bilgi Set fax_alankodi ='$fax_alankodu', Fax='$Fax' Where firmaid ='$verified_firmaid' ";
	$sonuc1=mysqli_query($connection,$ekle1);
	header("location:kullanimgor.php");
break;
case't';
	$tel_alankodu = mysqli_real_escape_string($connection,$_POST["tel_alankodu"]);
	$Telefon = mysqli_real_escape_string($connection,$_POST["Telefon"]);
	$ekle1="Update bilgi Set tel_alankodi ='$tel_alankodu', Telefon='$Telefon' Where firmaid ='$verified_firmaid' ";
	$sonuc1=mysqli_query($connection,$ekle1);
	header("location:kullanimgor.php");
break;
case'p';
	$Adres	= $_POST["Adres"];
	$ekle1="Update bilgi Set Adres ='$Adres' Where firmaid ='$verified_firmaid' ";
	$sonuc1=mysqli_query($connection,$ekle1);
	header("location:kullanimgor.php");
break;
default:
header("location:kullanim.php");
}
header("location:kullanim.php"); 
}
?>