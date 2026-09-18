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
$rekkod = filter_var($_POST["rekid"] ?? null, FILTER_VALIDATE_INT);
if ($rekkod === false || $rekkod < 1) {
	http_response_code(400);
	exit;
}
$mesaj='';         
$statement = mysqli_prepare($coni, "SELECT izah FROM rekkayit WHERE rekid = ?");
if (!$statement) {
	http_response_code(500);
	exit;
}
mysqli_stmt_bind_param($statement, "i", $rekkod);
mysqli_stmt_execute($statement);
$result = mysqli_stmt_get_result($statement);
mysqli_stmt_close($statement);
$row = $result ? mysqli_fetch_assoc($result) : null;
if (!$row) {
	http_response_code(404);
	exit;
}
$izahat=$row['izah'];
$konu= $rekkod." numaralı ".$izahat." reklam dökümü";
$textm = '';
$html = '';
/* $xq="SELECT a.date, b.Firma_Adi, b.Sehir, d.tikdate FROM kullanim as a, bilgi as b, kulfirmaid as c, rektik as d WHERE a.Kullanimid=c.kullanimid AND b.firmaid=c.firmaid AND c.rekid=$rekkod AND d.kulfirmaid=c.id ORDER BY a.date ASC"; */
$xq="select kullanim.date, kulfirmaid.rekid, bilgi.Firma_Adi, bilgi.Sehir, rektik.tikdate from kullanim, bilgi, kulfirmaid left join rektik ON kulfirmaid.id=rektik.kulfirmaid WHERE kullanim.Kullanimid=kulfirmaid.kullanimid AND bilgi.firmaid=kulfirmaid.firmaid HAVING kulfirmaid.rekid = ? ORDER BY kullanim.date ASC";
$statement = mysqli_prepare($coni, $xq);
if (!$statement) {
	http_response_code(500);
	exit;
}
mysqli_stmt_bind_param($statement, "i", $rekkod);
mysqli_stmt_execute($statement);
$r = mysqli_stmt_get_result($statement);
mysqli_stmt_close($statement);
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
	$mail->Password = $infopass ?? ''; //Þifre
	//$mail->Port = 587;
	$mail->IsHTML(true);
	$mail->Encoding = "base64";
	$mail->CharSet = "UTF-8";
	$mail->From 	= "info@tekliftopla.com";
	$mail->FromName = "tekliftopla";
	$mail->Send();  

header("Location:yonetimreklam.php?mesg=send_ok");
exit;
?>
</BODY></HTML>