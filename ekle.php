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
$asama=isset($_GET["asama"]) ? $_GET["asama"] : '';
$gkaynak=isset($_GET["gkaynak"]) ? $_GET["gkaynak"] : '';
switch($asama) 
{	
// anaformdan gelen bilgiyi ekleme
case 'firmabilgi':

$imgverrand_org=isset($_SESSION['imgverrand']) ? $_SESSION['imgverrand'] : '';
$imgverrand_kul=md5(strtoupper(isset($_POST['imgverrand']) ? $_POST['imgverrand'] :''));

$c1 = isset($_POST["c1"]) ? $_POST["c1"] : '';
$c2 = isset($_POST["c2"]) ? $_POST["c2"] : '';
$c11 = mysqli_real_escape_string($connection,isset($_POST["c11"]) ? $_POST["c11"] : '');
$c21 = mysqli_real_escape_string($connection,isset ($_POST["c21"]) ? $_POST["c21"] : '');
$Firma_Adi = isset($_POST["Firma_Adi"]) ? $_POST["Firma_Adi"] : '';
$yetkili = mysqli_real_escape_string($connection,isset($_POST["yetkili"]) ? $_POST["yetkili"] : '');
$Adres = isset($_POST["Adres"]) ? $_POST["Adres"] : '';
$Posta_Kodu = mysqli_real_escape_string($connection,isset($_POST["Posta_Kodu"]) ? $_POST["Posta_Kodu"] : '');
$Telefon = mysqli_real_escape_string($connection,isset($_POST["Telefon"]) ? $_POST["Telefon"] : '');
$Fax	= mysqli_real_escape_string($connection,isset($_POST["Fax"]) ? $_POST["Fax"] : '');
$email = isset($_POST["email"]) ? trim($_POST["email"]) : '';
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
$stmt = mysqli_prepare($connection, "SELECT firmaid FROM bilgi WHERE email = ?");
$etki = 0;
if ($stmt) {
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $kontrol = mysqli_stmt_get_result($stmt);
    if ($kontrol) {
        $etki = mysqli_num_rows($kontrol);
    }
    mysqli_stmt_close($stmt);
}
if($etki > 0){
		header("Location:kayit.php?hata1=kayitli&$get_string");
	exit;
}
else{
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
$stmt = mysqli_prepare($connection, "DELETE FROM gecici1 WHERE firmaid = ?");
if ($stmt) {
    mysqli_stmt_bind_param($stmt, "i", $verified_firmaid);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}
$stmt = mysqli_prepare($connection, "INSERT INTO bilgi (Tarih, Firma_Adi, Adres, tel_alankodi, fax_alankodi, Posta_Kodu, Sehir, Telefon, Fax, Web, email, yetkili, sifre, iletisim, lisan, tur, kaydeden) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '1')");
if (!$stmt) {
    die("Invalid query: " . mysqli_error($connection));
}
mysqli_stmt_bind_param($stmt, "ssssssssssssssss", $date1, $Firma_Adi, $Adres, $tel_alankodu, $fax_alankodu, $Posta_Kodu, $Sehir, $Telefon, $Fax, $Web, $email, $yetkili, $sif, $iletisim, $lisan, $c2);
$sonuc = mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
$verified_email=$email;
$_SESSION['verified_email']=$verified_email;
//session_register("verified_email");
$verified_firma=$Firma_Adi;
$_SESSION['verified_firma']=$verified_firma;
//session_register("verified_firma");
$stmt = mysqli_prepare($connection, "SELECT firmaid FROM bilgi WHERE email = ?");
if ($stmt) {
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
while ($row=mysqli_fetch_array($result)){
$verified_firmaid=$row['firmaid'];
$_SESSION['verified_firmaid']=$verified_firmaid;
//session_register("verified_firmaid");
}
mysqli_stmt_close($stmt);
}
}
if($c1==0)
{
$stmt = mysqli_prepare($connection, "UPDATE bilgi SET tekliftopla = '0' WHERE firmaid = ?");
if ($stmt) {
    mysqli_stmt_bind_param($stmt, "i", $verified_firmaid);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}
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
    $stmt = mysqli_prepare($connection, "INSERT INTO gecici1 (firmaid, sektorid) VALUES (?, ?)");
    if ($stmt) {
	  mysqli_stmt_bind_param($stmt, "ii", $verified_firmaid, $sektorler);
	  mysqli_stmt_execute($stmt);
	  mysqli_stmt_close($stmt);
    }
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
$stmt = mysqli_prepare($connection, "DELETE FROM gecici1 WHERE sektorid = ? AND firmaid = ?");
if ($stmt) {
    mysqli_stmt_bind_param($stmt, "ii", $sektorler, $verified_firmaid);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}
}
}
}
$stmt = mysqli_prepare($connection, "INSERT INTO firma_sektor (firmaid, sektorid) SELECT DISTINCT firmaid, sektorid FROM gecici1 WHERE firmaid = ?");
if ($stmt) {
    mysqli_stmt_bind_param($stmt, "i", $verified_firmaid);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}
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
    $stmt = mysqli_prepare($connection, "INSERT INTO firma_sehir (firmaid, sehirid) VALUES (?, ?)");
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ii", $verified_firmaid, $sehirler);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
     }}
  else {
    $stmt = mysqli_prepare($connection, "INSERT INTO firma_sehir (firmaid, sehirid) VALUES (?, 999)");
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $verified_firmaid);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
       }
}
$stmt = mysqli_prepare($connection, "DELETE FROM gecici1 WHERE firmaid = ?");
if ($stmt) {
    mysqli_stmt_bind_param($stmt, "i", $verified_firmaid);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}
header("location:emailsifre.php?kaynak=efirma");
break;
}
?>