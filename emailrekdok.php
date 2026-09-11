<?
ob_start();
include"headeryon.php";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="content-language" content="tr" />
<title>tekliftopla</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<?
session_start();
/*$connection=mysql_connect("$host","$user","$password") or die ("Could not connect to the MySQL Server");
$query="SET NAMES 'UTF8'";
mysql_query($query);
mysql_select_db($db);*/
$rekkod=mysqli_real_escape_string($coni,trim($_POST["rekid"]));
$mesaj='';         
$sql = "SELECT izah FROM rekkayit WHERE rekid =$rekkod";
$result = mysqli_query($coni,$sql);
$row = mysqli_fetch_assoc($result);
$izahat=$row['izah'];
$konu= $rekkod." numaralı ".$izahat." reklam dökümü";
$textm = '';
$html = '';
/* $xq="SELECT a.date, b.Firma_Adi, b.Sehir, d.tikdate FROM kullanim as a, bilgi as b, kulfirmaid as c, rektik as d WHERE a.Kullanimid=c.kullanimid AND b.firmaid=c.firmaid AND c.rekid=$rekkod AND d.kulfirmaid=c.id ORDER BY a.date ASC"; */
$xq="select kullanim.date, kulfirmaid.rekid, bilgi.Firma_Adi, bilgi.Sehir, rektik.tikdate from kullanim, bilgi, kulfirmaid left join rektik ON kulfirmaid.id=rektik.kulfirmaid WHERE kullanim.Kullanimid=kulfirmaid.kullanimid AND bilgi.firmaid=kulfirmaid.firmaid HAVING  kulfirmaid.rekid=$rekkod ORDER BY kullanim.date ASC";
$r=mysqli_query($coni,$xq);
$n=mysqli_num_rows($r);
if($n>0){
	for($i=0;$i<$n;$i++) {
		list($tarih, $rekkod, $uye, $sehir, $ttarih)=mysqli_fetch_array($r);
	    $mesaj.=''.$tarih.','.$uye.','.$sehir.','.$ttarih.'';
		$mesaj.="\r\n";
		}
        }

require_once("class.phpmailer.php"); //Require file
	$mail = new PHPMailer();
	$mail->AddAddress('gulec59-g@yahoo.com');
    $mail->Subject 	= $konu;
	$mail->Body		= $mesaj;
	$mail->IsSMTP();
	$mail->SMTPAuth = true;
	$mail->Username = "info@tekliftopla.com"; //Kullanýcý Adý
	$mail->Password = $infopass; //Þifre
	//$mail->Port = 587;
	$mail->IsHTML(true);
	$mail->CharSet = "UTF-8";
	$mail->From 	= "info@tekliftopla.com";
	$mail->Fromname = "tekliftopla";
	$mail->Send();  

header("Location:yonetimreklam.php?mesg=send_ok");
exit;
?>
</BODY></HTML>