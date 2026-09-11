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

/*$connection=mysql_connect($host,$user,$password) or die ("Could not connect to the MySQL Server");
$query="SET NAMES 'UTF8'";
mysql_query($query);
mysql_select_db($db);*/
if(!isset($_SESSION["verified_user"])){
?>
<script type='text/javascript'>alert("Hata");
window.location = "tradmin.php";
</script> 
<?
}
/* $teklifid =$_POST["teklifid"]; */
$teklifid = mysqli_real_escape_string($coni,$_GET["teklifid"]);
$stryy1="SELECT  bilgi.Firma_Adi, bilgi.email, bilgi.firmaid, kullanim.text, kullanim.dil FROM kullanim, bilgi where kullanim.firmaid=bilgi.firmaid and kullanim.Kullanimid='$teklifid'";
    $last=mysqli_query($coni,$stryy1);
    $raw=mysqli_fetch_array($last);
    $frm=$raw['Firma_Adi'];
	$kime=$raw['email'];
	$metin=$raw['text'];
	$firmaid = $raw['firmaid'];
	$dil=$raw['dil'];
	$array = "kime=".$kime."&id=".$firmaid;
error_reporting(63);

if($dil=='TUR') {

$konu=$teklifid." teklif talebi iptal edildi";
$varsayilan_reklam=mysqli_fetch_array(mysqli_query($coni,"select grafik,link from rekkayit where rektip=13 order by kaytarih desc limit 0,1"));
$images = glob("image/index/*.{jpg,jpeg,gif,png,bmp}", GLOB_BRACE);
$randombanner = $images[array_rand($images)];
$html = '
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>tekliftopla</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<style type="text/css">
.mesaj1 {font-family:Verdana, Arial, Helvetica, sans-serif ;font-size:10pt; color:#525764; }
.mesaj2 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 8pt; color: #4D8C4E; font-weight: bold; }
</style>
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="600" border="0" align="center" cellpadding="2" cellspacing="0" bgcolor="#F9F9F9">
  <tr><td colspan="2"  bgcolor="#B5B8C0" height="8px" style="font-size:8px; line-height:8px;"><img src= "image/trans.gif" style="display: block;" alt="" width="1" height="1"></td></tr>
    <tr><td bgcolor="#FFFFFF" align="left"><a href="http://www.tekliftopla.com"><img src="http://www.tekliftopla.com/image/logo.gif" width="176" height="62"></a></td>
	   <td bgcolor="#FFFFFF" align="center"><a href="'.$varsayilan_reklam['link'].'"><img src= "http://www.tekliftopla.com/reklamlar/'.$varsayilan_reklam['grafik'].'" border="0" width="385" height="60" ></a></td>
  </tr>
  <tr><td colspan="2"  bgcolor="#B5B8C0" height="8px" style="font-size:8px; line-height:8px;"><img src= "image/trans.gif" style="display: block;" alt="" width="1" height="1"></td></tr>
  <tr> 
    <td colspan="2" ><div align="left"> 
        <p class="mesaj1">İyi günler,<br><br>
		tekliftopla.com sadece mal veya hizmet satın alma teklif taleplerini üyelerine iletmektedir.<br><br>
		Mal veya hizmet satış veya tanıtımına yönelik aşağıdaki mesajınız iptal edilmiştir.<br><br>
		tekliftopla.com vasıtasıyla tanıtım imkanları için <a href="http://www.tekliftopla.com/reklam.php">www.tekliftopla.com/reklam</a> sayfamızı inceleyiniz.<br><br>
		Bu vesileyle şirketiniz mal ve hizmet alımlarında <a href="http://www.tekliftopla.com">www.tekliftopla.com</a> sitemizden bedelsiz olarak faydalanabileceğinizi hatırlatmak isteriz.<br><br>
		Saygılarımızla<br>
		tekliftopla.com <br><br></p>
        <table border="0" cellpadding="0" cellspacing="2" bgcolor="#EFEFEF">
          <tr>
            <td><table border="0" cellpadding="0" cellspacing="4" bgcolor="#FFFFFF">
                <tr> 
                  <td width="100" align="left" class="mesaj2">Teklif no :</td>
                  <td class="mesaj1">'. $teklifid. ' </td>
                </tr>
                <tr bgcolor="#EFEFEF"> 
                  <td colspan="2"><font color="#6E9807"><img src="trans.gif" width="1" height="2"></font></td>
                </tr>
                <tr> 
                  <td align="left" class="mesaj2">Kullanıcı:</td>
                  <td class="mesaj1">'. $frm .'</td>
                </tr>
				<tr bgcolor="#EFEFEF"> 
                  <td colspan="2"><font color="#6E9807"><img src="trans.gif" width="1" height="2"></font></td>
                </tr>
                <tr> 
                  <td align="left" class="mesaj2">Mesaj içeriği:</td>
                  <td class="mesaj1">'. $metin .' </td>
                </tr>
                </table></td>
          </tr>
        </table>
        </div>
       <br>
      </td>
  </tr>
  <tr> 
    <td colspan="2" >&nbsp;</td>
  </tr>
  <tr>
  <td colspan="2" align="center"><a href="http://www.tekliftopla.com"><img src= "http://www.tekliftopla.com/'.$randombanner.'" ></a>
  </td>
  </tr>
  <tr><td colspan="2"  bgcolor="#B5B8C0" height="8px" style="font-size:8px; line-height:8px;"><img src= "image/trans.gif" style="display: block;" alt="" width="1" height="1"></td></tr>
  
</table>
</body>
</html>';
}
else { 
$konu=" Canceled RFP no ".$teklifid." .";
$varsayilan_reklam=mysqli_fetch_array(mysqli_query($coni,"select grafik,link from rekkayit where rektip=13 order by kaytarih desc limit 0,1"));
$images = glob("image/index/*.{jpg,jpeg,gif,png,bmp}", GLOB_BRACE);
$randombanner = $images[array_rand($images)];
$html = '
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>tekliftopla</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<style type="text/css">
.mesaj1 {font-family:Verdana, Arial, Helvetica, sans-serif ;font-size:10pt; color:#525764; }
.mesaj2 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 8pt; color: #4D8C4E; font-weight: bold; }
</style>
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="600" border="0" align="center" cellpadding="2" cellspacing="0" bgcolor="#F9F9F9">
  <tr><td colspan="2"  bgcolor="#B5B8C0" height="8px" style="font-size:8px; line-height:8px;"><img src= "image/trans.gif" style="display: block;" alt="" width="1" height="1"></td></tr>
  <tr> 
    <td bgcolor="#FFFFFF" align="left"><a href="http://www.tekliftopla.com"><img src="http://www.tekliftopla.com/image/logo.gif" width="176" height="62"></a></td>
	   <td bgcolor="#FFFFFF" align="center"><a href="'.$varsayilan_reklam['link'].'"><img src= "http://www.tekliftopla.com/reklamlar/'.$varsayilan_reklam['grafik'].'" border="0" width="385" height="60" ></a></td>
  </tr>
  <tr><td colspan="2"  bgcolor="#B5B8C0" height="8px" style="font-size:8px; line-height:8px;"><img src= "image/trans.gif" style="display: block;" alt="" width="1" height="1"></td></tr>
  <tr> 
    <td colspan="2" ><div align="left"> 
        <p class="mesaj1">Goodday,<br>
            <br>
		tekliftopla.com only conveys purchasing RFP\'s to its members.<br>
		<br>
		Your below message aimed at promoting or selling goods or services is canceled.<br>
		<br>
		Please send us an <a href="mailto:info@tekliftopla.com">e-mail</a> for advertising oppurtunities through tekliftopla.com .<br>
		<br>
		We take this oppurtunity to invite you to use <a href="http://www.tekliftopla.com/en/index-e.php">www.tekliftopla.com</a> to reach Turkish suppliers for your goods and services needs.<br><br>
		Regards<br>
		tekliftopla.com <br><br></p>
        <table border="0" cellpadding="0" cellspacing="2" bgcolor="#EFEFEF">
          <tr>
            <td><table border="0" cellpadding="0" cellspacing="4" bgcolor="#FFFFFF">
                <tr> 
                  <td width="100" align="left" class="mesaj2">RFP no :</td>
                  <td class="mesaj1">'. $teklifid. '</td>
                </tr>
                <tr bgcolor="#EFEFEF"> 
                  <td colspan="2"><font color="#6E9807"><img src="trans.gif" width="1" height="2"></font></td>
                </tr>
                <tr> 
                  <td align="left" class="mesaj2">User name :</td>
                  <td class="mesaj1">'. $frm .' </td>
                </tr>
				<tr bgcolor="#EFEFEF"> 
                  <td colspan="2"><font color="#6E9807"><img src="trans.gif" width="1" height="2"></font></td>
                </tr>
                <tr> 
                  <td align="left" class="mesaj2">RFP text :</td>
                  <td class="mesaj1">'. $metin .' </td>
                </tr>
                </table></td>
          </tr>
        </table>
        </div>
       <br>
      </td>
  </tr>
  <tr> 
    <td colspan="2" >&nbsp;</td>
  </tr>
  <tr>
  <td colspan="2" align="center"><a href="http://www.tekliftopla.com"><img src= "http://www.tekliftopla.com/'.$randombanner.'" ></a>
  </td>
  </tr>
  <tr><td colspan="2"  bgcolor="#B5B8C0" height="8px" style="font-size:8px; line-height:8px;"><img src= "image/trans.gif" style="display: block;" alt="" width="1" height="1"></td></tr>
  
</table>
</body>
</html>';

}

require_once("class.phpmailer.php"); //Require file
	$mail = new PHPMailer();
	$mail->AddAddress($kime);
  $mail->AddBCC("gulec59-g@yahoo.com","ASG"); //BCC
	$mail->Subject 	= $konu;
	$mail->Body		= $html;
	$mail->IsSMTP();
	$mail->SMTPAuth = true;
	$mail->Username = "info@tekliftopla.com"; //Kullanýcý Adý
	$mail->Password = $infopass; //Þifre
	//$mail->Port = 587;
	$mail->IsHTML(true);
	$mail->CharSet = "UTF-8";
	$mail->From 	= "info@tekliftopla.com";
	$mail->FromName = "tekliftopla";
	$mail->Send();

$tempppx2="update kullanim set tamam='1' where Kullanimid='$teklifid'";
$etkinp2=mysqli_query($coni,$tempppx2);
header("location:mailcontrol.php");
ob_end_flush();
?>
