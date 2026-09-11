<?
include"ayar.php";
session_start();
ob_start();
$connection=mysqli_connect($host,$user,$password,$db);
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
mysqli_set_charset($connection,"utf8");
/*$connection=mysql_connect("$host","$user","$password") or die ("Could not connect to the MySQL Server");
$query="SET NAMES 'UTF8'";
mysql_query($query);*/
if(!isset($_SESSION["verified_firmaid"]) and !isset($_SESSION["verified_sifrem"])){
?>
<script type='text/javascript'>alert("Hata");
window.location = "index.php";
</script> 
<?php 
}
$verified_firmaid = isset($_SESSION["verified_firmaid"]) ? $_SESSION["verified_firmaid"] : '';
$verified_kulid = isset($_SESSION["verified_kulid"]) ? $_SESSION["verified_kulid"] : '';
$verified_sehirid = isset($_SESSION["verified_sehirid"]) ? $_SESSION["verified_sehirid"] : '';
$str11="INSERT INTO gecici4 (firmaid,kullanimid) SELECT distinct firma_sektor.firmaid,gecici3.kullanimid FROM gecici3, firma_sektor where gecici3.sektorid=firma_sektor.sektorid and gecici3.kullanimid='$verified_kulid'";
$result11=mysqli_query($connection,$str11);
$strp21="INSERT INTO gecici5 (firmaid,kullanimid) SELECT distinct firma_sehir.firmaid,kullanim.Kullanimid FROM firma_sehir,kullanim where firma_sehir.sehirid='$verified_sehirid' and  firma_sehir.sehirid=kullanim.sehirid and kullanim.Kullanimid='$verified_kulid'";
$resultp21=mysqli_query($connection,$strp21);
$str111="insert into gecici6 (firmaid,kullanimid) SELECT distinct gecici4.firmaid,gecici4.kullanimid FROM gecici4,gecici5 where gecici4.firmaid=gecici5.firmaid and  gecici4.kullanimid=gecici5.kullanimid and gecici4.kullanimid='$verified_kulid'";
$result111=mysqli_query($connection,$str111);

$temp2p="INSERT INTO kulfirmaid (kullanimid,firmaid) SELECT distinct firmaid,kullanimid FROM gecici6 where kullanimid='$verified_kulid'";
$etki2p=mysqli_query($connection,$temp2p);

$ykm="update kullanim set aktif='1' where Kullanimid='$verified_kulid'";
$ykm1=mysqli_query($connection,$ykm);

$tempppx322="delete from gecici3 where kullanim='$verified_kulid'";
$etkinp322=mysqli_query($connection,$tempppx322);

$tempppx422="delete from gecici4 where kullanim='$verified_kulid'";
$etkinp422=mysqli_query($connection,$tempppx422);

$www22="delete from gecici5 where kullanim='$verified_kulid'";
$etkinp522=mysqli_query($connection,$www22);

$tempppx622="delete from gecici6 where kullanim='$verified_kulid'";
$etkinp622=mysqli_query($connection,$tempppx622);

$query = "SELECT a.Firma_Adi, b.sehir, c.text from bilgi as a, sehir as b, kullanim as c where c.Kullanimid='$verified_kulid' and 
c.firmaid=a.firmaid and c.sehirid=b.sehirid";
$queryx=mysqli_query($connection,$query) or die(mysqli_error($connection));
$queryr=mysqli_fetch_array($queryx) or die(mysqli_error($connection));
$sehirx = $queryr['sehir'];
$firmax=$queryr['Firma_Adi'];
$textx=$queryr['text'];

$subject = "Bekleyen teklif talebi var...";
$message = $firmax."\n \n".$sehirx."\n \n".$textx;
/** $from = "info@tekliftopla.com";
$headers = "From: " . $from;
$headers1 = 'Content-type: text/html; charset=iso-8859-1' . "\n\n" .'From: info@tekliftopla.com' . "\n\n" . 'Reply-To: info@tekliftopla.com' . "\n\n";

mail('gulec59-g@yahoo.com',$subject,$message, $headers,"-f ".$from);
mail('gulecme@gmail.com',$subject,$message,$headers,"-f ".$from);
mail('selamigulec@gmail.com',$subject,$message,$headers,"-f ".$from); **/

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
	$mail->Fromname = "tekliftopla";
	$mail->Send();

/*foreach($secili as $firmaid){
$temp2p="INSERT INTO kulfirmaid (kullanimid,firmaid) values('$verified_kulid','$firmaid')";
$etki2p=mysql_db_query($db,$temp2p);} */

header("Location:ok.php");
ob_end_flush();
?>