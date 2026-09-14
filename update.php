<?
include"ayar.php";
session_start();
$connection=mysqli_connect($host,$user,$password,$db);
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
	}
mysqli_set_charset($connection,"utf8");
/*$connection=mysql_connect("$host","$user","$password") or die ("Could not connect to the MySQL Server");
$query="SET NAMES 'UTF8'";
mysql_query($query);*/
if(!isset($_SESSION["verified_firmaid"])  and !isset($_SESSION["verified_sifrem"])){
?>
<script type='text/javascript'>alert("Hata");
window.location = "index.php";
</script> 
<?
}
$verified_firmaid = isset($_SESSION["verified_firmaid"])?(int)$_SESSION["verified_firmaid"]:0;
$islem = $_GET["islem"];
switch($islem)
{
// anaformdan gelen bilgiyi güncelleme
case 'guncelbilgi':
$c1 = mysqli_real_escape_string($connection,isset($_POST["c1"]) ? $_POST["c1"] : '');
$c2 = mysqli_real_escape_string($connection,isset($_POST["c2"]) ? $_POST["c2"] : '');
$c11 = mysqli_real_escape_string($connection,isset($_POST["c11"]) ? $_POST["c11"] : '');
$c21 = mysqli_real_escape_string($connection,isset($_POST["c21"]) ? $_POST["c21"] : '');
$Firma_Adi = mysqli_real_escape_string($connection,isset($_POST["Firma_Adi"]) ? $_POST["Firma_Adi"] : '');
$yetkili = mysqli_real_escape_string($connection,isset($_POST["yetkili"]) ? $_POST["yetkili"] : '');
$Adres = mysqli_real_escape_string($connection,isset($_POST["Adres"]) ? $_POST["Adres"] : '');
$Posta_Kodu = mysqli_real_escape_string($connection,isset($_POST["Adres"])?$_POST["Adres"]:'');
$Telefon = mysqli_real_escape_string($connection,isset($_POST["Telefon"])?$_POST["Telefon"]:'');
$Fax	= mysqli_real_escape_string($connection,isset($_POST["Fax"])?$_POST["Fax"]:'');
$email = mysqli_real_escape_string($connection,isset($_POST["email"])?$_POST["email"]:''); 
$Web	= mysqli_real_escape_string($connection,isset($_POST["Web"])?$_POST["Web"]:'');
$tel_alankodu = mysqli_real_escape_string($connection,isset($_POST["tel_alankodu"])?$_POST["tel_alankodu"]:'');
$fax_alankodu = mysqli_real_escape_string($connection,isset($_POST["fax_alankodu"])?$_POST["fax_alankodu"]:'');
$Sehir = mysqli_real_escape_string($connection,isset($_POST["Sehir"])?$_POST["Sehir"]:'');
$iletisim = mysqli_real_escape_string($connection,isset($_POST["iletisim"])?$_POST["iletisim"]:'');
$lisan = mysqli_real_escape_string($connection,isset($_POST["lisan"])?$_POST["lisan"]:'');
if($c1==1){
$sql="UPDATE bilgi SET Firma_Adi='$Firma_Adi',Adres='$Adres',tel_alankodi='$tel_alankodu',fax_alankodi='$fax_alankodu',Posta_Kodu='$Posta_Kodu',Sehir='$Sehir',Telefon='$Telefon',Fax='$Fax',email='$email',Web='$Web',yetkili='$yetkili',iletisim='$iletisim',lisan='$lisan',tekliftopla='1', tur='$c2'  WHERE firmaid='$verified_firmaid'";
$kontrol=mysqli_query($connection,$sql);
$tempppx="delete from gecici where firmaid='$verified_firmaid'";
$etkinp=mysqli_query($connection,$tempppx);
$temp2="INSERT INTO gecici (firmaid,sektorid) SELECT firmaid,sektorid FROM firma_sektor where firmaid='$verified_firmaid'";
$etki2=mysqli_query($connection,$temp2);
header("location:guncelsektorgruplari.php");
}
else
{
$sqlu1="UPDATE bilgi SET Firma_Adi='$Firma_Adi',Adres='$Adres',tel_alankodi='$tel_alankodu',fax_alankodi='$fax_alankodu',Posta_Kodu='$Posta_Kodu',Sehir='$Sehir',Telefon='$Telefon',Fax='$Fax',Web='$Web',yetkili='$yetkili',iletisim='$iletisim',lisan='$lisan',tekliftopla='0' WHERE firmaid='$verified_firmaid'";
$kontrolu1=mysqli_query($connection,$sqlu1);
$tempppx22="delete from firma_sektor where firmaid='$verified_firmaid'";
$etkinp22=mysqli_query($connection,$tempppx22);
$tempppx22="delete from firma_sehir where firmaid='$verified_firmaid'";
$etkinp22=mysqli_query($connection,$tempppx22);
header("location:goruntuleme33.php");
}
break;

//sektor bilgisini gecici taboya ekle
case 'guncelsektor':
if (isset($_POST["sektor"]))
{
 $sektor = $_POST["sektor"];
 if($sektor){
		foreach($sektor as $sektorler)
 	{
			$sektorler = (int)$sektorler;
			$temp2="INSERT INTO gecici (firmaid,sektorid) values('$verified_firmaid','$sektorler')";
		$etki2=mysqli_query($connection,$temp2);
 	}
 }
}
header("location:guncelsektorgruplari.php");

break;
//tüm sektor bilgisini güncelleme
case 'sektorsil':
if (isset($_POST["sektor"]))
{
 $sektor = $_POST["sektor"];
 if($sektor)
 {
	foreach($sektor as $sektorler)
	{
		$sektorler = (int)$sektorler;
		$temp5="delete from gecici where sektorid='$sektorler' and firmaid='$verified_firmaid'";
		$etki5=mysqli_query($connection,$temp5);
	}
 }
}
$strc="delete from firma_sektor where firmaid='$verified_firmaid'";
$resultc=mysqli_query($connection,$strc);
$temp3="INSERT INTO firma_sektor(firmaid,sektorid) SELECT distinct firmaid,sektorid FROM gecici where firmaid='$verified_firmaid'";
$etki3=mysqli_query($connection,$temp3);
header("location:guncelsehirler.php");
break;
//sehir bilgisini güncelle
case 'guncelsehir':
if (isset($_POST["sehir"]))
{
 $tempppx263="delete from firma_sehir where firmaid='$verified_firmaid'";
 $etkinp263=mysqli_query($connection,$tempppx263);
 $sehir = $_POST["sehir"];
 if(count($sehir)<50){
	foreach($sehir as $sehirler){
	$sehirler = (int)$sehirler;
	$str2="insert into firma_sehir (firmaid,sehirid)values('$verified_firmaid','$sehirler')";
	$result2=mysqli_query($connection,$str2);
     }}
  else {
	$str2="insert into firma_sehir (firmaid,sehirid)values('$verified_firmaid',999)";
	$result2=mysqli_query($connection,$str2);
       }
}
$tempppx23="delete from gecici where firmaid='$verified_firmaid'";
$etkinp23=mysqli_query($connection,$tempppx23);
header("location:goruntuleme1.php");
break;

case 'sifredegis':
$sifre = mysqli_real_escape_string($connection,$_POST["sifre"]);
$sifre1 = mysqli_real_escape_string($connection,$_POST["sifre1"]);
$strr1="select * from bilgi where firmaid='$verified_firmaid' and sifre='$sifre'";
$resultrx1=mysqli_query($connection,$strr1);
$resultrx11=mysqli_num_rows($resultrx1);
if($resultrx11){
$strr="update bilgi set sifre='$sifre1' where firmaid='$verified_firmaid' and sifre='$sifre'";
$resultrx=mysqli_query($connection,$strr);
header("location:sifrem.php");
}
else{
header("location:hata1.php");
}
break;

case 'kayitsil':

$str2="update bilgi set aktivite='0' where firmaid='$verified_firmaid'";
$result2=mysqli_query($connection,$str2);
if($result2){
header("location:kayitsil.php");
}
else{header("location:hata2.php");
}
break;
case 'aktiv':
$str78="update bilgi set aktivite='1' where firmaid='$verified_firmaid'";
$result78=mysqli_query($connection,$str78);
if($result78){
header("location:giris.php");
}
break;
}
?>