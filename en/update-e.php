<?
include"../ayar.php";
tekliftopla_start_session();
tekliftopla_require_csrf();
$connection=mysqli_connect($host,$user,$password,$db);
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
mysqli_set_charset($connection,"utf8");
/*session_start();
$connection=mysql_connect("$host","$user","$password") or die ("Could not connect to the MySQL Server");
$query="SET NAMES 'UTF8'";
mysql_query($query);*/
if(!isset($_SESSION["verified_firmaid"])  and !isset($_SESSION["verified_sifrem"])){
?>
<script type='text/javascript'>alert("Error");
window.location = "index-e.php";
</script>
<?
}
$verified_firmaid = $_SESSION["verified_firmaid"];
$islem = $_GET["islem"];
switch($islem)
{
// anaformdan gelen bilgiyi güncelleme
case 'guncelbilgi':
$c1 = mysqli_real_escape_string($connection,$_POST["c1"]);
$c2 = mysqli_real_escape_string($connection,$_POST["c2"]);
$c11 = mysqli_real_escape_string($connection,$_POST["c11"]);
$c21 = mysqli_real_escape_string($connection,$_POST["c21"]);
$Firma_Adi = mysqli_real_escape_string($connection,$_POST["Firma_Adi"]);
$yetkili = mysqli_real_escape_string($connection,$_POST["yetkili"]);
$Adres = mysqli_real_escape_string($connection,$_POST["Adres"]);
$Posta_Kodu = mysqli_real_escape_string($connection,$_POST["Posta_Kodu"]);
$Telefon = mysqli_real_escape_string($connection,$_POST["Telefon"]);
$Fax= mysqli_real_escape_string($connection,$_POST["Fax"]);
$email = mysqli_real_escape_string($connection,$_POST["email"]); 
$Web= mysqli_real_escape_string($connection,$_POST["Web"]);
$tel_alankodu = mysqli_real_escape_string($connection,$_POST["tel_alankodu"]);
$fax_alankodu = mysqli_real_escape_string($connection,$_POST["fax_alankodu"]);
$Sehirx = mysqli_real_escape_string($connection,$_POST["Sehir"]);
$ulke= mysqli_real_escape_string($connection,$_POST["Ulke"]);
$sehir= ($ulke =="TUR" ? $Sehirx : "" );
$iletisim = mysqli_real_escape_string($connection,$_POST["iletisim"]);
$lisan = mysqli_real_escape_string($connection,$_POST["lisan"]);
$sqlu1="UPDATE bilgi SET Firma_Adi='$Firma_Adi',Adres='$Adres',tel_alankodi='$tel_alankodu',fax_alankodi='$fax_alankodu',Posta_Kodu='$Posta_Kodu',Sehir='$sehir', ulke='$ulke', Telefon='$Telefon',Fax='$Fax',Web='$Web',yetkili='$yetkili',iletisim='$iletisim',lisan='$lisan',tekliftopla='0' WHERE firmaid='$verified_firmaid'";
$kontrolu1=mysqli_query($connection,$sqlu1);
$tempppx22="delete from firma_sektor where firmaid='$verified_firmaid'";
$etkinp22=mysqli_query($connection,$tempppx22);
$tempppx22="delete from firma_sehir where firmaid='$verified_firmaid'";
$etkinp22=mysqli_query($connection,$tempppx22);
header("location:guncelleme-e.php");
break;

//sektor bilgisini gecici taboya ekle
case 'guncelsektor':
if (isset($_POST["sektor"]))
{
 $sektor = $_POST["sektor"];
 if($sektor){
 	foreach($sektor as $sektorler)
 	{
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
header("location:sifrem-e.php?mesaj=tamam");
}
else{
header("location:sifrem-e.php");
}
break;

case 'kayitsil':

$str2="update bilgi set aktivite='0' where firmaid='$verified_firmaid'";
$result2=mysqli_query($connection,$str2);
if($result2){
header("location:index-e.php");
}
else{header("location:index-e.php");
}
break;

case 'aktiv':
$str78="update bilgi set aktivite='1' where firmaid='$verified_firmaid'";
$result78=mysqli_query($connection,$str78);
if($result78){
header("location:giris-e.php");
}
break;
}
?>