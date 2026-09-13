<?
include"ayar.php";
session_start();
ob_start();
include "headeri.php";
/*$connection=mysql_connect("$host","$user","$password") or die ("Could not connect to the MySQL Server");
$query="SET NAMES 'UTF8'";
mysql_query($query);
mysql_select_db($db);*/
$kaynak=mysqli_real_escape_string($connection,$_GET["kaynak"]);
if(!isset($_SESSION["verified_firmaid"])){
?>
<script type='text/javascript'>alert("Hata");</script> 
<?
}
else
{
switch($kaynak) {
case 'efirma':

error_reporting(63);
$konu="Geçici şifreniz";
$kime=$_SESSION["verified_email"];  
$verified_firma = $_SESSION["verified_firma"];
$verified_sif = $_SESSION["verified_sif"];
$textm = '';
$varsayilan_reklam=mysqli_fetch_array(mysqli_query($connection,"select grafik,link from rekkayit where rektip=13 order by kaytarih desc limit 0,1"));		
$images = glob("image/index/*.{jpg,jpeg,gif,png,bmp}", GLOB_BRACE);
$randombanner = $images[array_rand($images)];

$html = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<title>..:: Teklif Toplama Sitesine Hosgeldiniz ::..</title>
<link href="css/style.css" rel="stylesheet" type="text/css">

<style type="text/css">
<!--
.style1 {color: #000000}
.mesaj1 {font-family:Verdana, Arial, Helvetica, sans-serif ;font-size:10pt; color:#525764; }
.mesaj2 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 8pt; color: #4D8C4E; font-weight: bold; }
-->
</style>
</head>

<body>
<table width="600" border="0" align="center" cellpadding="2" cellspacing="0" bgcolor="#F9F9F9">
  <tr><td colspan="2"  bgcolor="#B5B8C0" height="8px" style="font-size:8px; line-height:8px;"><img src= "image/trans.gif" style="display: block;" alt="" width="1" height="1"></td></tr>
  <tr> 
    <td bgcolor="#FFFFFF" align="left"><a href="http://www.tekliftopla.com"><img src="http://www.tekliftopla.com/image/logo.gif" width="176" height="62"></a></td>
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
        <p class="mesaj1">Teklif toplamanın ve toplanan tekliflerden haberdar olmanın en kolay ve ücretsiz yolu<br>
        <a href="http://www.tekliftopla.com" class="link">www.tekliftopla.com</a> kullanımınıza hazır.</p>
        <table border="0" cellpadding="0" cellspacing="2" bgcolor="#EFEFEF">
          <tr>
            <td colspan="2"><table border="0" cellpadding="0" cellspacing="4" bgcolor="#F9F9F9" >
                <tr> 
                  <td width="113" align="left" class="mesaj2">Kullanıcı Adınız :</td> 
                  <td class="mesaj1">'. $kime . '</td>
                </tr>
                <tr bgcolor="#EFEFEF"> 
                  <td colspan="2"><font color="#6E9807"><img src="trans.gif" style="display: block;" width="1" height="2"></font></td>
                </tr>
                <tr> 
                  <td align="left" class="mesaj2">Geçici Şifreniz :</td>
                  <td class="mesaj1">'. $verified_sif .'</td>
                </tr>
                <tr bgcolor="#EFEFEF"> 
                  <td colspan="2"><font color="#6E9807"><img src="trans.gif" style="display: block;" width="1" height="2"></font></td>
                </tr>
            </table></td>
          </tr>
        </table>
        
      </div>
      <p align="center" class="mesaj1"><a href="http://www.tekliftopla.com" class="link">www.tekliftopla.com</a> adresinde e-posta ve geçici şifrenizle girerek:</p>
      <ul class="mesaj1">
        <li>teklif toplayabilirsiniz,</li>
        <li>bilgilerinizi ve şifrenizi değiştirebilirsiniz,</li>
        <li>teklif vermek istediğiniz iş kolları veya şehirleri düzenleyebilirsiniz.<br></li>
      </ul></td>
  </tr>
  <tr>
  <td colspan="2" align="center"><a href="http://www.tekliftopla.com"><img src="http://www.tekliftopla.com/'.$randombanner.'" ></a>
  </td>
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
  // $mail->AddAddress("gulecme@gmail.com","MAG");
	// $mail->AddBCC("yusuf@infomedya.com.tr","YG"); //BCC
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

	header("Location:son.php");
	ob_end_flush();
break;

case 'eyonetici':

error_reporting(63);
$konu="tekliftopla.com";
$kime=$_SESSION["verified_email"];  
$verified_firma = $_SESSION["verified_firma"];
$verified_sif = $_SESSION["verified_sif"];
$textm = '';
$varsayilan_reklam=mysqli_fetch_array(mysqli_query($connection,"select grafik,link from rekkayit where rektip=13 order by kaytarih desc limit 0,1"));		
$images = glob("image/index/*.{jpg,jpeg,gif,png,bmp}", GLOB_BRACE);
$randombanner = $images[array_rand($images)];

$html = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<title>..:: Teklif Toplama Sitesine Hosgeldiniz ::..</title>
<link href="css/style.css" rel="stylesheet" type="text/css">

<style type="text/css">
<!--
.style1 {color: #000000}
.mesaj1 {font-family:Verdana, Arial, Helvetica, sans-serif ;font-size:10pt; color:#525764; }
.mesaj2 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 8pt; color: #4D8C4E; font-weight: bold; }
-->
</style>
</head>

<body>
<table width="600" border="0" align="center" cellpadding="2" cellspacing="0" bgcolor="#F9F9F9">
 <tr><td colspan="2"  bgcolor="#B5B8C0" height="8px" style="font-size:8px; line-height:8px;"><img src= "image/trans.gif" style="display: block;" alt="" width="1" height="1"></td></tr>
  <tr> 
    <td bgcolor="#FFFFFF" align="left"><a href="http://www.tekliftopla.com"><img src="http://www.tekliftopla.com/image/logo.gif" width="176" height="62"></a></td>
	   <td bgcolor="#FFFFFF" align="center">
    <a href="'.$varsayilan_reklam['link'].'"><img src= "http://www.tekliftopla.com/reklamlar/'.$varsayilan_reklam['grafik'].'" border="0" width="385" height="60" ></a>
	   </td>
  </tr>
 <tr><td colspan="2"  bgcolor="#B5B8C0" height="8px" style="font-size:8px; line-height:8px;"><img src= "image/trans.gif" style="display: block;" alt="" width="1" height="1"></td></tr>
  <tr> 
    <td>&nbsp;</td>
  </tr>
  <tr align="left"> 
    <td colspan="2" class="mesaj1" ><div align="left"> 
        <p>İyi günler,</font></p>
        <p>Üyelerimizin, faaliyet gösterdiğiniz iş kolları ve hizmet verdiğiniz şehirdeki teklif talepleri <br>size de e-posta ile duyurulacaktır.</p>
        <p>Arzu ederseniz sizde <a href="http://www.tekliftopla.com" class="link">www.tekliftopla.com</a> sitemizden mal ve hizmet alımlarınız için ücretsiz teklif toplayabilirsiniz.</p>
        <p>Saygılarımızla</p>
        <p>tekliftopla.com</p>
    </div>
    <p>&nbsp;</p></td>
  </tr>
  <tr>
  <td colspan="2" align="center"><a href="http://www.tekliftopla.com"><img src= "http://www.tekliftopla.com/'.$randombanner.'" ></a>
  </td>
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

	$str122="select Sehir as city from bilgi Where email='$kime'";
	$row3=mysqli_fetch_array(mysqli_query($connection,$str122));
	$sonsehir=$row3['city'];
	$verified_firmaid="";
	$verified_sifrem="";
	$kime="";
	$verified_firma="";
	$_SESSION['verified_firmaid']=$verified_firmaid;
	//session_register("verified_firmaid");
	$_SESSION['verified_sifrem']=$verified_sifrem;
	//session_register("verified_sifrem");
	$_SESSION['verified_firma']=$verified_firma;
	//session_register("verified_firma");	
	unset($_SESSION['verified_firmaid']);
	//session_unregister("verified_firmaid");
	unset($_SESSION['verified_sifrem']);
	//session_unregister("verified_sifrem");
	unset($_SESSION['verified_email']);
	//session_unregister("verified_email");
	unset($_SESSION['verified_firma']);
	//session_unregister("verified_firma");
	header("Location:yonkayit.php?lcity=$sonsehir");
	ob_end_flush();
	break;
	}
}
?>
