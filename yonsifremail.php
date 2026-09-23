<?
include"ayar.php";
session_start();
ob_start();
$coni = mysqli_connect($host,$user,$password,$db);
if (mysqli_connect_errno())
   {
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
   } 
mysqli_set_charset($coni,"utf8");

/*$connection=mysql_connect("$host","$user","$password") or die ("Could not connect to the MySQL Server");
$query="SET NAMES 'UTF8'";
mysql_query($query);
mysql_select_db($db);*/
if(!isset($_SESSION["verified_firmaid"])){
?>
<script type='text/javascript'>alert("Hata");</script>
<?
}
else
{
error_reporting(63);
$konu="Geçici şifreniz";
$kime=$_SESSION["verified_email"];  
$verified_firma = $_SESSION["verified_firma"];
$verified_sif = $_SESSION["verified_sif"];

$varsayilan_reklam=mysqli_fetch_array(mysqli_query($coni,"select grafik,link from rekkayit where rektip=13 order by kaytarih desc limit 0,1"));		
$html = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<title>..:: Teklif Toplama Sitesine Hosgeldiniz ::..</title>
<link href="css/style.css" rel="stylesheet" type="text/css">

<style type="text/css">
<!--
.style1 {color: #000000}
-->
</style>
</head>

<body>
<table width="600" border="0" align="center" cellpadding="2" cellspacing="0" bgcolor="#F9F9F9">
  <tr><td colspan="2"  bgcolor="#B5B8C0" height="8px" style="font-size:8px; line-height:8px;"><img src= "image/trans.gif" style="display: block;" alt="" width="1" height="1"></td></tr>
  <tr> 
    <td bgcolor="#FFFFFF" align="left"><a href="http://www.tekliftopla.com"><img src="' . TEKLIFTOPLA_LOGO_URL . '" width="176" height="62"></a></td>
	   <td bgcolor="#FFFFFF" align="center">
    <a href="'.$varsayilan_reklam['link'].'"><img src= "http://www.tekliftopla.com/reklamlar/'.$varsayilan_reklam['grafik'].'" border="0" width="385" height="60" ></a>
	   </td>
  </tr>
  <tr><td colspan="2"  bgcolor="#B5B8C0" height="8px" style="font-size:8px; line-height:8px;"><img src= "image/trans.gif" style="display: block;" alt="" width="1" height="1"></td></tr>
  <tr> 
    <td>&nbsp;</td>
  </tr>
  <tr> 
    <td colspan="2"><div align="center"> 
        <p><font color="#525764" size="2" face="Verdana, Arial, Helvetica, sans-serif">Şifre Bildirimi </font></p>
        <p><font class="govde style1">Teklif toplamanın ve toplanan tekliflerden haberdar olmanın en kolay ve ucuz yolu</font> <br>
        <a href=http://www.tekliftopla.com class="link">www.tekliftopla.com</a> <span class="govde"> kullanımınız için hazırdır.</span></p>
        <table border="0" cellpadding="0" cellspacing="2" bgcolor="#EFEFEF">
          <tr>
            <td colspan="2"><table border="0" cellpadding="0" cellspacing="4" bgcolor="#FFFFFF">
                <tr> 
                  <td width="113" align="right"><strong><font color="#6E9807" size="2" face="Verdana, Arial, Helvetica, sans-serif">Kullanıcı Adı :</font></strong></td> 
                  <td>'. $kime . '</td>
                </tr>
                <tr bgcolor="#EFEFEF"> 
                  <td colspan="2"><font color="#6E9807"><img src="trans.gif" width="1" height="2"></font></td>
                </tr>
                <tr> 
                  <td align="right"><strong><font color="#6E9807" size="2" face="Verdana, Arial, Helvetica, sans-serif">Geçici Şifreniz :</font></strong></td>
                  <td>'. $verified_sif .'</td>
                </tr>
                <tr bgcolor="#EFEFEF"> 
                  <td colspan="2"><font color="#6E9807"><img src="trans.gif" width="1" height="2"></font></td>
                </tr>
              </table></td>
          </tr>
        </table>
        
      </div>
      <p align="center"> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><a href="http://www.tekliftopla.com" class="link">www.tekliftopla.com</a> <span class="govde">adresinde e-posta ve geçici şifrenizle girerek:</span></font></p>
      <ul>
        <li class="govde"><font size="2" face="Verdana, Arial, Helvetica, sans-serif" align="center">teklif toplayabilirsiniz,</font></li>
        <li class="govde"><font size="2" face="Verdana, Arial, Helvetica, sans-serif" align="center"> bilgilerinizi ve şifrenizi değiştirebilirsiniz,</font></li>
        <li><font size="2" face="Verdana, Arial, Helvetica, sans-serif" class="govde" align="center"> teklif vermek istediğiniz sektör veya şehirleri düzenleyebilirsiniz.
          </font> 
          <br>
        </li>
      </ul></td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
  </tr>
  <tr><td colspan="2"  bgcolor="#B5B8C0" height="8px" style="font-size:8px; line-height:8px;"><img src= "image/trans.gif" style="display: block;" alt="" width="1" height="1"></td></tr>
</table>
</BODY></HTML>';
require_once("class.phpmailer.php"); //Require file
	$mail = new PHPMailer();
	$mail->AddAddress($kime,$verified_firma);
    $mail->Subject 	= $konu;
	$mail->Body		= $html;
	$mail->IsSMTP();
	$mail->Host 	= "mail.tekliftopla.com"; //Mail Sunucusu
	$mail->SMTPAuth = true;
	$mail->Username = "info@tekliftopla.com"; //Kullanýcý Adý
	$mail->Password = $infopass; //Þifre
	//$mail->Port = 587;
  $mail->IsHTML(true);
  $mail->Encoding = "base64";
	$mail->CharSet = "UTF-8";
	$mail->From 	= "info@tekliftopla.com";
	$mail->FromName = "tekliftopla";
	$mail->Send();

header("Location:son.php");
}
ob_end_flush();
?>
