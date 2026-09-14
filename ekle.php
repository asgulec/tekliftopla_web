<?
include"ayar.php";
session_start();
$connection=mysqli_connect($host,$user,$password,$db);
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
mysqli_set_charset($connection,"utf8");
/*$link=mysql_connect($host,$user,$password)or die("baðlantý yok");
$query="SET NAMES 'UTF8'";
mysql_query($query);
*/
$verified_firmaid= isset($_SESSION["verified_firmaid"]) ? (int)$_SESSION["verified_firmaid"] : 0;
// $verified_firmaid = $_SESSION["verified_firmaid"];
$asama=$_GET["asama"];
$gkaynak=isset($_GET["gkaynak"]) ? $_GET["gkaynak"] : '';
switch($asama) 
{	
// anaformdan gelen bilgiyi ekleme
case 'firmabilgi':

$imgverrand_org=isset($_SESSION['imgverrand']) ? $_SESSION['imgverrand'] : '';
$imgverrand_kul=md5(strtoupper(isset($_POST['imgverrand']) ? $_POST['imgverrand'] :''));

$c1 = mysqli_real_escape_string($connection,isset($_POST["c1"]) ? $_POST["c1"] : '');
$c2 = mysqli_real_escape_string($connection,isset($_POST["c2"]) ? $_POST["c2"] : '');
$c11 = mysqli_real_escape_string($connection,isset($_POST["c11"]) ? $_POST["c11"] : '');
$c21 = mysqli_real_escape_string($connection,isset ($_POST["c21"]) ? $_POST["c21"] : '');
$Firma_Adi = mysqli_real_escape_string($connection,isset($_POST["Firma_Adi"]) ? $_POST["Firma_Adi"] : '');
$yetkili = mysqli_real_escape_string($connection,isset($_POST["yetkili"]) ? $_POST["yetkili"] : '');
$Adres = mysqli_real_escape_string($connection,isset($_POST["Adres"]) ? $_POST["Adres"] : '');
$Posta_Kodu = mysqli_real_escape_string($connection,isset($_POST["Posta_Kodu"]) ? $_POST["Posta_Kodu"] : '');
$Telefon = mysqli_real_escape_string($connection,isset($_POST["Telefon"]) ? $_POST["Telefon"] : '');
$Fax	= mysqli_real_escape_string($connection,isset($_POST["Fax"]) ? $_POST["Fax"] : '');
$email = mysqli_real_escape_string($connection,isset($_POST["email"]) ? $_POST["email"] : ''); 
$Web	= mysqli_real_escape_string($connection,isset($_POST["Web2"]) ? $_POST["Web2"] : '');
$tel_alankodu = mysqli_real_escape_string($connection,isset($_POST["tel_alankodu"]) ? $_POST["tel_alankodu"] : '');
$fax_alankodu = mysqli_real_escape_string($connection,isset($_POST["fax_alankodu"]) ? $_POST["fax_alankodu"] :'');
$Sehir = mysqli_real_escape_string($connection,isset($_POST["Sehir"]) ? $_POST["Sehir"] : '');
$iletisim = mysqli_real_escape_string($connection,isset($_POST["iletisim"]) ? $_POST["iletisim"] : '');
$agreement = mysqli_real_escape_string($connection,isset($_POST["agreement"]) ? $_POST["agreement"] : '');
$lisan = mysqli_real_escape_string($connection,isset($_POST["lisan"]) ? $_POST["lisan"] : '');
$get_string='';
foreach($_POST as $key=>$var) {
	$get_string.= "$key=$var&";
}

if($gkaynak!=="google"){
if($imgverrand_org!==$imgverrand_kul) {
	header("Location:kayit.php?hata=imgver&$get_string");
	exit;
   }
}
$date1=date("Ymd");
$str="SELECT * from bilgi where email='". $email ."'";
$kontrol=mysqli_query($connection,$str);
$etki=mysqli_num_rows($kontrol);
if($etki > 0){
		header("Location:kayit.php?hata1=kayitli&$get_string");
	exit;
}
else{
 srand((double)microtime()*1000000); 
     $vowels = array("W","X","C","B","a", "e", "i", "o", "u"); 
    $cons = array("R","O","K","L","N","H","b", "c", "d", "g", "h", "j", "k", "l", "m", "n", "p", "r", "s", "t", "u", "v", "w", "tr", 
    "cr", "br", "fr", "th", "dr", "ch", "ph", "wr", "st", "sp", "sw", "pr", "sl", "cl"); 
     
    $num_vowels = count($vowels); 
    $num_cons = count($cons); 
    $password1 = ""; 
    for($i = 0; $i < 6; $i++){ 
        $password1 .= $cons[rand(0, $num_cons - 1)] . $vowels[rand(0, $num_vowels - 1)]; 
    } 
$sif=substr($password1, 0, 6);
$verified_sif=$sif;
$_SESSION['verified_sif']=$verified_sif;
//session_register("verified_sif");
$temppp="delete from gecici1 where firmaid=$verified_firmaid";
$etkinp=mysqli_query($connection,$temppp);
$ekle="INSERT INTO bilgi(Tarih,Firma_Adi,Adres,tel_alankodi,fax_alankodi,Posta_Kodu,Sehir,Telefon,Fax,Web,email,yetkili,sifre,iletisim,lisan,tur, kaydeden) ";
$ekle.="VALUES('$date1','$Firma_Adi','$Adres','$tel_alankodu','$fax_alankodu','$Posta_Kodu','$Sehir','$Telefon','$Fax','$Web','$email','$yetkili','$sif','$iletisim','$lisan','$c2','1')";
$sonuc=mysqli_query($connection,$ekle) or die("Invalid query: " . mysqli_error($connection));
$verified_email=$email;
$_SESSION['verified_email']=$verified_email;
//session_register("verified_email");
$verified_firma=$Firma_Adi;
$_SESSION['verified_firma']=$verified_firma;
//session_register("verified_firma");
$id="select firmaid from bilgi where email='$email'";
$result=mysqli_query($connection,$id);
while ($row=mysqli_fetch_array($result)){
$verified_firmaid=$row['firmaid'];
$_SESSION['verified_firmaid']=$verified_firmaid;
//session_register("verified_firmaid");
}
}
if($c1==0)
{
$hakan="update bilgi set tekliftopla='0' where firmaid='$verified_firmaid'";
$hakan1=mysqli_query($connection,$hakan);
header("location:emailsifre.php?kaynak=efirma");
exit;
}
else
{
if($etki == 0)
header("location:sektorgruplari.php");
exit;
}
break;


//sektorleri geçici tabloya ekle

case 'sektor':
$cat2 = $_GET["cat2"];
if (isset($_POST["sektor"]))
{
 $sektor = $_POST["sektor"];
 if($sektor){
 foreach($sektor as $sektorler){
	$sektorler = (int)$sektorler;
  $temp2="INSERT INTO gecici1 (firmaid,sektorid) values('$verified_firmaid','$sektorler')";
  $etki2=mysqli_query($connection,$temp2);
 }}
}
header("location:sektorgruplari.php");

break;
//tüm sektor bilgisini ekleme

case 'denetle':
if (isset($_POST["sektor"]))
{
$sektor = $_POST["sektor"];
if($sektor){
foreach($sektor as $sektorler){
    $sektorler = (int)$sektorler;
$temp5="delete from gecici1 where sektorid='$sektorler' and firmaid='$verified_firmaid'";
$etki5=mysqli_query($connection,$temp5);}
}
}
$temp3="INSERT INTO firma_sektor(firmaid,sektorid) SELECT distinct firmaid,sektorid FROM gecici1 where firmaid='$verified_firmaid'";
$etki3=mysqli_query($connection,$temp3);
header("location:sehirler.php");
break;
//sehir bilgisini ekleme

case 'sehir':
if (isset($_POST["sehir"]))
{
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
$temppp="delete from gecici1 where firmaid=$verified_firmaid";
$etkinp=mysqli_query($connection,$temppp);
header("location:emailsifre.php?kaynak=efirma");
break;
}
?>