<?php
include "headeryon.php";
/*include"ayar.php";
session_start();
$connection=mysql_connect("$host","$user","$password") or die ("Could not connect to the MySQL Server");
$query="SET NAMES 'UTF8'";
mysql_query($query);*/

$kulip = get_ip_address();
function get_ip_address(){
    foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
        if (array_key_exists($key, $_SERVER) === true){
            foreach (explode(',', $_SERVER[$key]) as $ip){
                $ip = trim($ip); // just to be safe

                if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
                    return $ip;
                }
            }
        }
    }
}
if(!isset($_SESSION["verified_pass"]) and !isset($_SESSION["verified_user"])){
?>
<script type='text/javascript'>alert("Hata");
window.location = "tradmin.php";
</script> 
<?php
}
else{
$islem = $_GET["islem"];
switch($islem) 
{
// kullanýmdan gelen bilgiyi ekleme;
case'kullanim':
$firma = mysqli_real_escape_string($coni,$_POST["firma"]);
$ePosta = mysqli_real_escape_string($coni,$_POST["FirmaEPosta"]);
$iletisimBilgi = mysqli_real_escape_string($coni,$_POST["iletisimBilgi"]);
/* $yil = $_POST["yil"];
$ay = $_POST["ay"];
$gun = $_POST["gun"];
$tarih=$yil."-".$ay."-".$gun; */
$tarih= date("Y-m-d", strtotime(mysqli_real_escape_string($coni,$_POST["tektarih"])));
$surex = mysqli_real_escape_string($coni,$_POST["sure"]);
$sehirx = mysqli_real_escape_string($coni,$_POST["sehir"]);
$iletisimx = mysqli_real_escape_string($coni,$_POST["iletisim"]);
$ulke= mysqli_real_escape_string($coni,$_POST["ulke"]);
$sehir= ($ulke =="TUR" ? $sehirx : "999" );
$dil= ($ulke =="TUR" ? "TUR" : "ENG");
if($dil=="ENG"){
	$trans = array("Gün" => "Day(s)", "Hafta" => "Week(s)","Ay" => "Month(s)", "Yıl" => "Year(s)");
    $sure = strtr($surex,$trans);
	$transa = array("E-Posta" => "E-mail");
	$iletisim = strtr($iletisimx,$transa); }
	else {
	$sure = $surex;
	$iletisim=$iletisimx; }

$mesajnum = mysqli_real_escape_string($coni,$_POST["MesajNum"]);
$sifre1=md5(microtime());
$verified_sifre1=$sifre1;
$_SESSION['verified_sifre1']=$verified_sifre1;
//session_register("verified_sifre1");
$time=date("H:i:s");
$date=date("Ymd");
$text=mysqli_real_escape_string($coni,$_POST["text"]);
$textshort=mysqli_real_escape_string($coni,$_POST["textshort"]);
$text = str_ireplace(array("<script", "<style", "<embed"), "", $text);
$verified_yonid = $_SESSION["verified_yonid"];
$ekle1="INSERT INTO kullanim (tarih,sure,iletisim,text,textshort,firmaid,session,sehirid,ulke,date,time,FirmaEPosta,Firmailetisim,Firma,mesajsay,kulip,dil) VALUES ('$tarih','$sure','$iletisim','$text','$textshort','$verified_yonid','$verified_sifre1','$sehir','$ulke','$date','$time','$ePosta','$iletisimBilgi','$firma','$mesajnum','$kulip','$dil')";
$verified_sehirid=$sehir;
$_SESSION['verified_sehirid']=$verified_sehirid;
//session_register("verified_sehirid");
$verified_firma=$firma;
$_SESSION['verified_firma']=$verified_firma;
//session_register("verified_firma");
$sonuc1=mysqli_query($coni,$ekle1);
if($sonuc1){

$id="select Kullanimid from kullanim where session='$verified_sifre1' and firmaid='$verified_yonid'";
$result=mysqli_query($coni,$id);

while ($row=mysqli_fetch_array($result)){

$verified_kulid=$row['Kullanimid'];
$_SESSION['verified_kulid']=$verified_kulid;
//session_register("verified_kulid");
}

$tempppx2="delete from gecici2 where kullanimid='$verified_kulid' or kullanimid='0'";
$etkinp2=mysqli_query($coni,$tempppx2);

$tempppx3="delete from gecici3 where kullanımid='$verified_kulid' or kullanimid='0'";
$etkinp3=mysqli_query($coni,$tempppx3);

$tempppx4="delete from gecici4 where kullanimid='$verified_kulid' or kullanimid='0'";
$etkinp4=mysqli_query($coni,$tempppx4);

$www="delete from gecici5 where kullanimid='$verified_kulid' or kullanimid='0'";
$etkinp5=mysqli_query($coni,$www);

$tempppx6="delete from gecici6 where kullanimid='$verified_kulid' or kullanimid='0'";
$etkinp6=mysqli_query($coni,$tempppx6);

header("location:yonetimsektorgruplari.php");
exit;
}
break;

// yontekkullanim dan gelen bilgiyi ekleme;
case'kultekkul':
$firma = mysqli_real_escape_string($coni,$_POST["firma"]);
$ePosta = mysqli_real_escape_string($coni,$_POST["FirmaEPosta"]);
$iletisimBilgi = mysqli_real_escape_string($coni,$_POST["iletisimBilgi"]);
$tarih= date("Y-m-d", strtotime(mysqli_real_escape_string($coni,$_POST["tektarih"])));
$sure = mysqli_real_escape_string($coni,$_POST["sure"]);
$sehir = mysqli_real_escape_string($coni,$_POST["sehir"]);
$iletisim = mysqli_real_escape_string($coni,$_POST["iletisim"]);
$mesajnum = mysqli_real_escape_string($coni,$_POST["MesajNum"]);
$sifre1=md5(microtime());
$verified_sifre1=$sifre1;
$_SESSION['verified_sifre1']=$verified_sifre1;
$time=date("H:i:s");
$date=date("Ymd");
$text=mysqli_real_escape_string($coni,$_POST["text"]);
$text = str_ireplace(array("<script", "<style", "<embed"), "", $text);
$verified_yonid = $_SESSION["verified_yonid"];
$ekle1="INSERT INTO kullanim (tarih,sure,iletisim,text,firmaid,session,sehirid,date,time,FirmaEPosta,Firmailetisim,Firma,mesajsay,aktif,kulip) VALUES ('$tarih','$sure','$iletisim','$text','$verified_yonid','$verified_sifre1','$sehir','$date','$time','$ePosta','$iletisimBilgi','$firma','$mesajnum','1','$kulip')";
$sonuc1=mysqli_query($coni,$ekle1);
if($sonuc1){
$id="select Kullanimid from kullanim where session='$verified_sifre1' and firmaid='$verified_yonid'";
$result=mysqli_query($coni,$id);
while ($row=mysqli_fetch_array($result)){
$verified_kulid=$row['Kullanimid'];
}
$tempppx2="delete from gecici2 where kullanimid='$verified_kulid' or kullanimid='0'";
$etkinp2=mysqli_query($coni,$tempppx2);
$tempppx3="delete from gecici3 where kullanımid='$verified_kulid' or kullanimid='0'";
$etkinp3=mysqli_query($coni,$tempppx3);
$tempppx6="delete from gecici6 where kullanimid='$verified_kulid' or kullanimid='0'";
$etkinp6=mysqli_query($coni,$tempppx6);

$subject = "Bekleyen teklif talebi var...";
$message = $firma."\n \n".$sehir."\n \n".$text;
require_once("class.phpmailer.php"); //Require file
	$mail = new PHPMailer();
	$mail->AddAddress("gulec59-g@yahoo.com","ASG");
    //$mail->AddAddress("gulecme@gmail.com","MAG");
	$mail->Subject 	= $subject;
	$mail->Body		= $message;
	$mail->IsSMTP();
	$mail->SMTPAuth = true;
	$mail->Username = "info@tekliftopla.com"; //Kullanýcý Adý
	$mail->Password = $infopass; //Þifre
	//$mail->Port = 587;
	$mail->IsHTML(false);
	$mail->CharSet = "UTF-8";
	$mail->From 	= "info@tekliftopla.com";
	$mail->FromName = "tekliftopla";
	$mail->Send();

header("location:yonetimgiris.php");

exit;
}
break;

//sektorleri geçici tabloya ekle;

case 'kulsektor':
$verified_yonid = $_SESSION["verified_yonid"];
$verified_kulid = $_SESSION["verified_kulid"];
if (isset($_POST["sektor"]))
{
 $sektor =($_POST["sektor"]);
 if($sektor){
 foreach($sektor as $sektorler){
  
  $temp2="INSERT INTO gecici2 (kullanimid,sektorid,firmaid) values('$verified_kulid','$sektorler','$verified_yonid')";
  $etki2=mysqli_query($coni,$temp2);
  }}
}
header("location:yonetimsektorgruplari.php");
break;
//tüm sektor bilgisini ekleme;

break;
case 'kulmodsil':
$verified_kulid = $_SESSION["verified_kulid"];
if (isset($_POST["sektor"]))
{
 $sektor = $_POST["sektor"];
 if($sektor){
 foreach($sektor as $sektorler){
  $temp5="delete from gecici2 where sektorid='$sektorler' and kullanimid='$verified_kulid'";
  $etki5=mysqli_query($coni,$temp5);
 }}
}
$temp3="INSERT INTO kulsektor (Kullanimid,sektorid) SELECT distinct kullanimid,sektorid FROM gecici2 where kullanimid='$verified_kulid'";
$etki3=mysqli_query($coni,$temp3);
if (isset($_SESSION["kontrol"])) {
	header("location:tummaille2.php");
	exit;
}
else {
	header("location:yonetimgor.php");
	exit;
}
break;

}}
?>