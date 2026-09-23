<?php
include"ayar.php";
$connection=mysqli_connect($host,$user,$password,$db);
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
mysqli_set_charset($connection,"utf8");
/*$connection=mysql_connect($host,$user,$password) or die ("Could not connect to the MySQL Server");
$query="SET NAMES 'UTF8'";
mysql_query($query);
mysql_select_db($db);*/
$semail = isset($_POST["semail"]) ? trim($_POST["semail"]) : '';
if ($semail === '') {
    header("Location:forgetpass.php?sonuc=epostayok");
    exit;
}

$stmt = mysqli_prepare($connection, "SELECT email, sifre, Firma_Adi FROM bilgi WHERE email = ?");
$no = 0;
$kime = '';
$sifreniz = '';
$frm = '';

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "s", $semail);
    mysqli_stmt_execute($stmt);
    $last = mysqli_stmt_get_result($stmt);
    if ($last) {
        $no = mysqli_num_rows($last);
        if ($raw = mysqli_fetch_array($last)) {
            $kime = $raw['email'];
            $sifreniz = $raw['sifre'];
            $frm = $raw['Firma_Adi'];
        }
    }
    mysqli_stmt_close($stmt);
}

if($no>0){
error_reporting(63);

$konu="tekliftopla.com kullanıcı bilgileriniz";
$qryx=mysqli_query($connection,"select grafik,link from rekkayit where rektip=13 order by kaytarih desc limit 0,1");
$varsayilan_reklam=mysqli_fetch_array($qryx);	
$html = '
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Teklif Topla</title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="600" border="0" align="center" cellpadding="2" cellspacing="0" bgcolor="#F9F9F9">
  <tr><td colspan="2"  bgcolor="#B5B8C0" height="8px" style="font-size:8px; line-height:8px;"><img src= "image/trans.gif" style="display: block;" alt="" width="1" height="1"></td></tr>
  <tr> 
    <td bgcolor="#FFFFFF" align="left"><a href="http://www.tekliftopla.com"><img src="' . TEKLIFTOPLA_LOGO_URL . '" width="176" height="62"></a></td>
    <td bgcolor="#FFFFFF" align="center"><a href="'.$varsayilan_reklam['link'].'"><img src= "http://www.tekliftopla.com/reklamlar/'.$varsayilan_reklam['grafik'].'" border="0" width="385" height="60" ></a></td>
  </tr>
  <tr><td colspan="2"  bgcolor="#B5B8C0" height="8px" style="font-size:8px; line-height:8px;"><img src= "image/trans.gif" style="display: block;" alt="" width="1" height="1"></td></tr>
  <tr> 
    <td>&nbsp;</td>
  </tr>
  <tr> 
    <td colspan="2"><div align="center"> 
        <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif">tekliftopla.com kayıt bilgileriniz: </font></p>
        <table border="0" cellpadding="0" cellspacing="2" bgcolor="#EFEFEF">
          <tr>
            <td colspan="2"><table border="0" cellpadding="0" cellspacing="2" bgcolor="#FFFFFF">
                <tr> 
                  <td width="113" align="right"><font color="#6E9807" size="2" face="Verdana, Arial, Helvetica, sans-serif">E-posta :</font></td>
                  <td align="left"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">'. $kime. ' </font></td>
                </tr>
                <tr> 
                  <td colspan="2"><font color="#6E9807"><img src="trans.gif" style="display: block;" width="1" height="2"></font></td>
                </tr>
                <tr> 
                  <td align="right"><font color="#6E9807" size="2" face="Verdana, Arial, Helvetica, sans-serif">Şifre :</font></td>
                  <td align="left"> <font size="2" face="Verdana, Arial, Helvetica, sans-serif">'. $sifreniz .' </font></td>
                </tr>
                <tr> 
                  <td colspan="2"><font color="#6E9807"><img src="trans.gif" style="display: block;" width="1" height="2"></font></td>
                </tr>
            </table></td>
          </tr>
        </table>
        
      </div>
      <p align="center" > <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><br>
          <font size="2">Kayıtlı bilgilerinizi ve şifrenizi  <a href="http://www.tekliftopla.com">www.tekliftopla.com</a> sitesine girerek değiştirebilirsiniz.</font></font> <br>
        <br>
    </p></td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
  </tr>
  <tr><td colspan="2"  bgcolor="#B5B8C0" height="8px" style="font-size:8px; line-height:8px;"><img src= "image/trans.gif" style="display: block;" alt="" width="1" height="1"></td></tr>
</table>
</body>
</html>';
require_once("class.phpmailer.php"); //Require file
	$mail = new PHPMailer();
	$mail->AddAddress($kime,$frm);
    $mail->Subject 	= $konu;
	$mail->Body		= $html;
	$mail->IsSMTP();
	$mail->SMTPAuth = true;
	$mail->Username = "info@tekliftopla.com"; //Kullanýcý Adý
	$mail->Password = $infopass; //Þifre
	//$mail->Port = 587;
	$mail->IsHTML(true);
  $mail->Encoding = "base64";
	$mail->CharSet = "UTF-8";
	$mail->From 	= "info@tekliftopla.com";
	$mail->Fromname = "tekliftopla";
	$mail->Send();
header("Location:forgetpass.php?sonuc=tamam");
}
else{
header("Location:forgetpass.php?sonuc=epostayok");
}
?>