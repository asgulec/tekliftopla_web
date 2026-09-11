<? 
include "headeryon.php";

$asama=$_GET["asama"];
switch($asama) 
{	
// anaformdan gelen bilgiyi ekleme
case 'firmabilgi':

$c1 = mysqli_real_escape_string($coni,isset($_POST["c1"]) ? $_POST["c1"] : '' );
$c2 = mysqli_real_escape_string($coni,isset($_POST["c2"]) ? $_POST["c2"] : '');
$c11 = mysqli_real_escape_string($coni,isset($_POST["c11"]) ? $_POST["c11"] : '');
$c21 = mysqli_real_escape_string($coni,isset($_POST["c21"]) ? $_POST["c21"] : '');
$Firma_Adi = mysqli_real_escape_string($coni,isset($_POST["Firma_Adi"]) ? $_POST["Firma_Adi"] : '');
$email = mysqli_real_escape_string($coni,isset($_POST["email"]) ? $_POST["email"] : ''); 
$Sehir = mysqli_real_escape_string($coni,isset($_POST["Sehir"]) ? $_POST["Sehir"] : '' );
$iletisim = mysqli_real_escape_string($coni,isset($_POST["iletisim"]) ? $_POST["iletisim"] : '');
$lisan = mysqli_real_escape_string($coni,isset($_POST["lisan"]) ? $_POST["lisan"] : '');
$date1=date("Ymd");
$yonetici=isset($_SESSION["verified_yonid"]) ? $_SESSION["verified_yonid"] : "";
$str="SELECT * from bilgi where email='". $email ."'";
$kontrol=mysqli_query($coni,$str);
$etki=mysqli_num_rows($kontrol);
if($etki > 0){
		header("Location:yonkayit.php?hata=kayitli");
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
$verified_firmaid=isset($_SESSION['verified_firmaid']) ? $_SESSION['verified_firmaid'] : '';
$temppp="delete from gecici1 where firmaid=$verified_firmaid";
$etkinp=mysqli_query($coni,$temppp);
$ekle="INSERT INTO bilgi(Tarih,Firma_Adi,Sehir,email,sifre,iletisim,lisan,tur,kaydeden) ";
$ekle.="VALUES('$date1','$Firma_Adi','$Sehir','$email','$sif','$iletisim','$lisan','$c2','$yonetici')";
$sonuc=mysqli_query($coni,$ekle) or die("Invalid query: " . mysqli_error($coni));
$verified_email=$email;
$_SESSION['verified_email']=$verified_email;
//session_register("verified_email");
$verified_firma=$Firma_Adi;
$_SESSION['verified_firma']=$verified_firma;
//session_register("verified_firma");
$id="select firmaid from bilgi where email='$email'";
$result=mysqli_query($coni,$id);
while ($row=mysqli_fetch_array($result)){
$verified_firmaid=$row['firmaid'];
$_SESSION['verified_firmaid']=$verified_firmaid;
//session_register("verified_firmaid");
}
}
if($c1==0)
{
$hakan="update bilgi set tekliftopla='0' where firmaid='$verified_firmaid'";
$hakan1=mysqli_query($coni,$hakan);
header("location:yonetimgiris.php");
exit;
}
else
{
if($etki == 0)
header("location:yonsektorgrup.php");
exit;
}
break;


//sektorleri geçici tabloya ekle

case 'sektor':
$cat2 = $_GET["cat2"];
$verified_firmaid = $_SESSION["verified_firmaid"];
if (isset($_POST["sektor"]))
{
 $sektor = $_POST["sektor"];
 if($sektor){
 foreach($sektor as $sektorler){
  $temp2="INSERT INTO gecici1 (firmaid,sektorid) values('$verified_firmaid','$sektorler')";
  $etki2=mysqli_query($coni,$temp2);
 }}
}
header("location:yonsektorgrup.php");

break;
//tüm sektor bilgisini ekleme

case 'denetle':
$verified_firmaid = $_SESSION["verified_firmaid"];
if (isset($_POST["sektor"]))
{
$sektor = $_POST["sektor"];
if($sektor){
foreach($sektor as $sektorler){
$temp5="delete from gecici1 where sektorid='$sektorler' and firmaid='$verified_firmaid'";
$etki5=mysqli_query($coni,$temp5);}
}
}
$temp3="INSERT INTO firma_sektor(firmaid,sektorid) SELECT distinct firmaid,sektorid FROM gecici1 where firmaid='$verified_firmaid'";
$etki3=mysqli_query($coni,$temp3);
header("location:yonsehirler.php");
break;
//sehir bilgisini ekleme

case 'sehir':
$verified_firmaid = isset($_SESSION["verified_firmaid"]) ? $_SESSION["verified_firmaid"] : "";
if (isset($_POST["sehir"]))
{
 $sehir = $_POST["sehir"];
 if(count($sehir)<50){
  foreach($sehir as $sehirler){
	$str2="insert into firma_sehir (firmaid,sehirid)values('$verified_firmaid','$sehirler')";
	$result2=mysqli_query($coni,$str2);
  }}
  else {
	$str2="insert into firma_sehir (firmaid,sehirid)values('$verified_firmaid',999)";
	$result2=mysqli_query($coni,$str2);
       }
}
$temppp="delete from gecici1 where firmaid=$verified_firmaid";
$etkinp=mysqli_query($coni,$temppp);
header("location:emailsifre.php?kaynak=eyonetici");
break;
}
?>