<? session_start(); ?>
<html>
<head>
<title>tekliftopla</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="css/style.css" type="text/css" rel="stylesheet">
<link rel="stylesheet" href="jquery/jquery-ui.theme.css">
<link rel="stylesheet" href="jquery/jquery-ui.css">
<script src="jquery/external/jquery/jquery.js"></script>
<script src="jquery/jquery-ui.min.js"></script>
</head>
<?
include"ayar.php";
$connection=mysql_connect($host,$user,$password) or die ("Could not connect to the MySQL Server");
$query="SET NAMES 'UTF8'";
mysql_query($query);
mysql_select_db($db);
$semail =mysql_real_escape_string(isset($_POST["semail"]) ? $_POST["semail"] : '');
$st="select * from bilgi where email='$semail'";
$last=mysql_db_query($db,$st);
/** if (mysql_result($last,0)>0) {  **/
$no=mysql_num_rows($last);
if($no>0){
while ($raw = mysql_fetch_array($last)){
                     $kime=$raw['email'];
					 $sifreniz=$raw['sifre'];
     	             $frm=$raw['Firma_Adi'];
					 	   			 }
error_reporting(63);

$konu="tekliftopla.com kullanıcı bilgileriniz";

$varsayilan_reklam=mysql_fetch_array(mysql_query("select grafik,link from rekkayit where rektip=13 order by kaytarih desc limit 0,1"));	
$html = '
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Teklif Topla</title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="600" border="0" align="center" cellpadding="2" cellspacing="0" bgcolor="#F9F9F9">
  <tr><td colspan="2"  bgcolor="#B5B8C0" height="8"><img src= "image/trans.gif" alt="" width="1" height="1"></td></tr>
  <tr> 
    <td bgcolor="#FFFFFF" align="left"><a href="http://www.tekliftopla.com"><img src="http://www.tekliftopla.com/image/logo.gif" width="176" height="62"></a></td>
	   <td bgcolor="#FFFFFF" align="center"><a href="'.$varsayilan_reklam['link'].'"><img src= "http://www.tekliftopla.com/reklamlar/'.$varsayilan_reklam['grafik'].'" border="0" width="385" height="60" ></a></td>
  </tr>
  <tr><td colspan="2"  bgcolor="#B5B8C0" height="8"><img src= "image/trans.gif" alt="" width="1" height="1"></td></tr>
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
                  <td colspan="2"><font color="#6E9807"><img src="trans.gif" width="1" height="2"></font></td>
                </tr>
                <tr> 
                  <td align="right"><font color="#6E9807" size="2" face="Verdana, Arial, Helvetica, sans-serif">Şifre :</font></td>
                  <td align="left"> <font size="2" face="Verdana, Arial, Helvetica, sans-serif">'. $sifreniz .' </font></td>
                </tr>
                <tr> 
                  <td colspan="2"><font color="#6E9807"><img src="trans.gif" width="1" height="2"></font></td>
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
  <tr><td colspan="2" bgcolor="#B5B8C0" height="8"><img src= "image/trans.gif" alt="" width="1" height="1"></td></tr>
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
	$mail->CharSet = "UTF-8";
	$mail->From 	= "info@tekliftopla.com";
	$mail->Fromname = "tekliftopla";
	$mail->Send();     

?>
<script language="javascript">
 $(function(){
    $( "#dialog-sifreteyit" ).dialog({
		close: function () {
            window.location.href = "index.php"
        },
		modal:true,
		/* position: {	my: "center",at: "center",of: sayfa}, */
		buttons:{Tamam: function () {
    $(this).dialog("close");
	}}
	});	
  });

</script>
<? }
else{ ?>
<script language="javascript">
$(function(){
    $( "#dialog-sifreyok" ).dialog({
		close: function () {
            window.location.href = "forgetpass.php"
        },
		modal:true,
		/* position: {	my: "center",at: "center",of: sayfa}, */
		buttons:{Tamam: function () {
    $(this).dialog("close");
	}}
	});	
  });
</script>
<?
}
?>
<div id="dialog-sifreteyit" title="Bilgi" style="display:none" class="text_g" >
  <p>
    Şifreniz e-posta adresinize gönderilmiştir. </p>
   <p>Lütfen önemsiz posta, spam ve istenmeyen posta klasörlerini kontrol ediniz. 
  </p>
</div>
<div id="dialog-sifreyok" title="Uyarı" style="display:none" class="text_g" >
  <p>
    Bu e-posta adresi sisteme kayıtlı değildir. </p>
   <p>Arzu ederseniz "YENİ ÜYE", "Google ile giriş yap" veya "Facebook ile giriş yap" düğmelerini tıklayarak kolayca üye olabilirsiniz. 
  </p>
</div>
</html>

