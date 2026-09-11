<?
include"../ayar.php";
session_start();
$connection=mysqli_connect($host,$user,$password,$db);
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
mysqli_set_charset($connection,"utf8");
/*$link=mysql_connect($host,$user,$password)or die ("Unable to connect to MySQL server.");
$query="SET NAMES 'UTF8'";
mysql_query($query);
session_start();*/
$sifre = mysqli_real_escape_string($connection,isset ($_POST["sifre"]) ? $_POST["sifre"] : '');
$email = mysqli_real_escape_string($connection,isset ($_POST["email"]) ? $_POST["email"] : '');
$sql1="SELECT sifre,email,firmaid,Firma_Adi FROM bilgi WHERE sifre='$sifre' AND email='$email' and aktivite='0'";
$result1 = mysqli_query($connection,$sql1) or die ("Couldn't execute SQL query");
$etki1=mysqli_num_rows($result1);
if($etki1)
{
while($row1=mysqli_fetch_array($result1))
{
$verified_firmaid=$row1['firmaid'];
$_SESSION['verified_firmaid']=$verified_firmaid;
$verified_email=$row1['email'];
$_SESSION['verified_email']=$verified_email;
$verified_sifrem=$row1['sifre'];
$_SESSION['verified_sifrem']=$verified_sifrem;
$firma=$row1['Firma_Adi'];	
$verified_firma=$firma;
$_SESSION['verified_firma']=$verified_firma;
header("location:aktiv-e.php");
exit;
}}
$sql="SELECT sifre,email,firmaid,Firma_Adi FROM bilgi WHERE sifre='$sifre' AND email='$email' and aktivite='1'";
$result = mysqli_query($connection,$sql) or die ("Couldn't execute SQL query");
$etki=mysqli_num_rows($result);
if($etki)
{
while($row=mysqli_fetch_array($result))
{
$verified_email=$row['email'];
$_SESSION['verified_email']=$verified_email;
$verified_sifrem=$row['sifre'];
$_SESSION['verified_sifrem']=$verified_sifrem;
$verified_firmaid=$row['firmaid'];
$_SESSION['verified_firmaid']=$verified_firmaid;
$firma=$row['Firma_Adi'];	
$verified_firma=$firma;
$_SESSION['verified_firma']=$verified_firma;
header("location:giris-e.php");}
}
else{ header("location:index-e.php?sonuc=epostayok");
}
?>
