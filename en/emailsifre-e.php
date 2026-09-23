<?
include"../ayar.php";
//session_start();
ob_start();
session_start();
$connection=mysqli_connect($host,$user,$password,$db);
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
mysqli_set_charset($connection,"utf8");
/*$connection=mysql_connect("$host","$user","$password") or die ("Could not connect to the MySQL Server");
$query="SET NAMES 'UTF8'";
mysql_query($query);
mysql_select_db($db);*/
if(!isset($_SESSION["verified_firmaid"])){
?>
<script type='text/javascript'>alert("Error");
</script>
<?
}
else
{
error_reporting(63);
$konu="User password";
$kime=$_SESSION["verified_email"];  
$verified_firma = $_SESSION["verified_firma"];
$verified_sif = $_SESSION["verified_sif"];
$textm = '';
$varsayilan_reklam=mysqli_fetch_array(mysqli_query($connection,"select grafik,link from rekkayit where rektip=13 order by kaytarih desc limit 0,1"));		
$images = glob("../image/index/*.{jpg,jpeg,gif,png,bmp}", GLOB_BRACE);
$randombanner = $images[array_rand($images)];

$html = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<title>tekliftopla</title>
<link href="../css/style.css" rel="stylesheet" type="text/css">

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
  <tr><td colspan="2"  bgcolor="#B5B8C0" height="8px" style="font-size:8px; line-height:8px;"><img src= "../image/trans.gif" style="display: block;" alt="" width="1" height="1"></td></tr>
    <td bgcolor="#FFFFFF" align="left"><a href="http://www.tekliftopla.com"><img src="' . TEKLIFTOPLA_LOGO_URL . '" width="176" height="62"></a></td>
	   <td bgcolor="#FFFFFF" align="center">
    <a href="'.$varsayilan_reklam['link'].'"><img src= "http://www.tekliftopla.com/reklamlar/'.$varsayilan_reklam['grafik'].'" border="0" width="385" height="60" ></a>
	   </td>
  </tr>
 <tr><td colspan="2"  bgcolor="#B5B8C0" height="8px" style="font-size:8px; line-height:8px;"><img src= "../image/trans.gif" style="display: block;" alt="" width="1" height="1"></td></tr>
  <tr> 
    <td>&nbsp;</td>
  </tr>
  <tr> 
    <td colspan="2" class="mesaj1"><div align="center"> 
        <p style="color: #4D8C4E;">User information </p>
        <p>Easiest and free method of inquiring for goods and services of Turkish suppliers<br>
        <a href="http://www.tekliftopla.com/en/index-e.php" class="link">www.tekliftopla.com</a> is ready for your service.</p>
        <table border="0" cellpadding="0" cellspacing="2" bgcolor="#EFEFEF">
          <tr>
            <td colspan="2"><table border="0" cellpadding="0" cellspacing="4" bgcolor="#F9F9F9" >
                <tr> 
                  <td width="113" align="left" class="mesaj2">User name : </td> 
                  <td>'. $kime . '</td>
                </tr>
                <tr bgcolor="#EFEFEF"> 
                  <td colspan="2"><font color="#6E9807"><img src="trans.gif" width="1" height="2"></font></td>
                </tr>
                <tr> 
                  <td align="left" class="mesaj2">Password : </td>
                  <td>'. $verified_sif .'</td>
                </tr>
                <tr bgcolor="#EFEFEF"> 
                  <td colspan="2"><font color="#6E9807"><img src="trans.gif" width="1" height="2"></font></td>
                </tr>
            </table></td>
          </tr>
        </table>
        
      </div>
      <p align="center" class="mesaj1">You can change your password by loging in at <a href="http://www.tekliftopla.com/en/index-e.php" class="link">www.tekliftopla.com</a> <br> 
        <br>
      </td>
  </tr>
  <tr>
  <td colspan="2" align="center"><a href="http://www.tekliftopla.com/en/index-e.php"><img src="http://www.tekliftopla.com/'.$randombanner.'" ></a>
  </td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
  </tr>
  <tr><td colspan="2"  bgcolor="#B5B8C0" height="8px" style="font-size:8px; line-height:8px;"><img src= "../image/trans.gif" style="display: block;" alt="" width="1" height="1"></td></tr>
</table>
</BODY></HTML>';
       
require_once("../class.phpmailer.php"); //Require file
	$mail = new PHPMailer();
	$mail->AddAddress($kime,$verified_firma);
   	$mail->Subject 	= $konu;
	$mail->Body		= $html;
	$mail->IsSMTP();
	$mail->SMTPAuth = true;
	$mail->Username = "info@tekliftopla.com"; //Kullanýcý Adý
	$mail->Password = $infopass; //Þifre
  $mail->IsHTML(true);
  $mail->Encoding = "base64";
	$mail->CharSet = "UTF-8";
	$mail->From 	= "info@tekliftopla.com";
	$mail->FromName = "tekliftopla";
	$mail->Send();

	header("Location:son-e.php");
	ob_end_flush();
}
?>
