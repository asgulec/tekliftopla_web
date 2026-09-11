<?
include"../ayar.php";
session_start();
$connection=mysqli_connect($host,$user,$password,$db);
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
mysqli_set_charset($connection,"utf8");
/*session_start();
$link=mysql_connect($host,$user,$password)or die("Connection failed");
$query="SET NAMES 'UTF8'";
mysql_query($query);*/
$verified_firmaid= isset($_SESSION["verified_firmaid"]) ? $_SESSION["verified_firmaid"] : '';
$gkaynak=isset($_GET["gkaynak"]) ? $_GET["gkaynak"] : '';
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
$xUlke = mysqli_real_escape_string($connection,isset($_POST["Ulke"]) ? $_POST["Ulke"] : '');
$xSehir = mysqli_real_escape_string($connection,isset($_POST["Sehir"]) ? $_POST["Sehir"] : '');
$iletisim = mysqli_real_escape_string($connection,isset($_POST["iletisim"]) ? $_POST["iletisim"] : '');
$agreement = mysqli_real_escape_string($connection,isset($_POST["agreement"]) ? $_POST["agreement"] : '');
$lisan = mysqli_real_escape_string($connection,isset($_POST["lisan"]) ? $_POST["lisan"] : '');
$get_string='';
foreach($_POST as $key=>$var) {
	$get_string.= "$key=$var&";
}
if($gkaynak!=="google"){
if($imgverrand_org!==$imgverrand_kul) {
	header("Location:kayit-e.php?hata=imgver&$get_string");
	exit;
   }
}
$date1=date("Ymd");
$str="SELECT * from bilgi where email='". $email ."'";
$kontrol=mysqli_query($connection,$str);
$etki=mysqli_num_rows($kontrol);
if($etki > 0){
		header("Location:kayit-e.php?hata1=kayitli&$get_string");
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
$query="select iso3 from country where ulke='$xUlke' limit 1"; 
$result = mysqli_query($connection,$query) or die(); 
$row = mysqli_fetch_object($result);
$Ulke = $row->iso3;
$Sehir= $Ulke=="TUR" ? $xSehir : ""; 
$temppp="delete from gecici1 where firmaid=$verified_firmaid";
$etkinp=mysqli_query($connection,$temppp);
$ekle="INSERT INTO bilgi(Tarih,Firma_Adi,Adres,tel_alankodi,fax_alankodi,Posta_Kodu,Sehir,Telefon,Fax,Web,email,yetkili,sifre,iletisim,lisan,tekliftopla,tur, kaydeden,ulke) ";
$ekle.="VALUES('$date1','$Firma_Adi','$Adres','$tel_alankodu','$fax_alankodu','$Posta_Kodu','$Sehir','$Telefon','$Fax','$Web','$email','$yetkili','$sif','$iletisim','$lisan','0','$c2','1','$Ulke')";
$sonuc=mysqli_query($connection,$ekle) or die("Invalid query: " . mysqli_error($connection));
$verified_email=$email;
$_SESSION['verified_email']=$verified_email;
$verified_firma=$Firma_Adi;
$_SESSION['verified_firma']=$verified_firma;
$id="select firmaid from bilgi where email='$email'";
$result=mysqli_query($connection,$id);
while ($row=mysqli_fetch_array($result)){
$verified_firmaid=$row['firmaid'];
$_SESSION['verified_firmaid']=$verified_firmaid;
}
}
header("location:emailsifre-e.php");
exit;
?>