<?php
session_start();
if(!isset($_SESSION["verified_sifrem"])){
?>
<script type='text/javascript'>alert("Hata");
window.location = "index.php";
</script> 
<?php
}
include('class.html.mime.mail.inc');
$adsoyad =  $_POST["AdSoyad"];
$eposta =  $_POST["EPosta"];
$metin = $_POST["SoruOneri"];

$mesaj="";         
$mail = new html_mime_mail('X-Mailer: Html Mime Mail Class');

$konu="Soru - Öneri";
$textm = '';

$html='
<html>
<head>
<title>Teklif Topla</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="600" border="0" align="center" cellpadding="2" cellspacing="0" bgcolor="#F9F9F9">
  <tr> 
    <td colspan="2" bgcolor="#B5B8C0">&nbsp;</td>
  </tr>
  <tr> 
    <td bgcolor="#FFFFFF" align="left"><a href="http://www.tekliftopla.com"><img src="<?php echo TEKLIFTOPLA_LOGO_URL; ?>" width="176" height="62"></a></td>
	   <td bgcolor="#FFFFFF" align="center"><?php include("reklamlar/emailReklam.html"); ?></td>
  </tr>
  <tr> 
    <td colspan="2" bgcolor="#B5B8C0">&nbsp;</td>
  </tr>
  <tr> 
    <td colspan="2" >&nbsp;</td>
  </tr>
  <tr> 
    <td colspan="2" ><div align="center"> 
        <p><font color="#525764" size="2" face="Verdana, Arial, Helvetica, sans-serif">Soru - &Ouml;neri </font></p>
        <table width="550" border="0" cellpadding="0" cellspacing="2" bgcolor="#EFEFEF">
          <tr>
            <td><table width="550" border="0" cellpadding="0" cellspacing="5" bgcolor="#FFFFFF">
                <tr> 
                  <td width="30%" align="right" valign="top"><font color="#6E9807" size="2" face="Verdana, Arial, Helvetica, sans-serif">Gönderen: </font></td>
                  <td width="200" valign="top"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">'.$adsoyad.'</font></td>
                </tr>
                <tr> 
                  <td width="30%" align="right" valign="top"><font color="#6E9807" size="2" face="Verdana, Arial, Helvetica, sans-serif">Soru - Öneri: </font></td>
                  <td valign="top"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">'.$metin.'</font></td>
                </tr>
                <tr> 
                  <td width="30%" align="right" valign="top"><font color="#6E9807" size="2" face="Verdana, Arial, Helvetica, sans-serif">E-Posta Adresi: </font></td>
                  <td valign="top"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> <a href="mailto:'.$eposta.'" class="link">'.$eposta.'</a></font></td>
                </tr>
            </table></td>
          </tr>
        </table>
        
      </div></td>
  </tr>
  <tr> 
    <td colspan="2" >&nbsp;</td>
  </tr>
  <tr> 
    <td colspan="2" bgcolor="#B5B8C0">&nbsp;</td>
  </tr>
</table>
</body>
</html>';
		
$mail->add_html($html, $mesaj);
$mail->set_body($mesaj);
$mail->set_charset('UTF-8', TRUE);
$mail->build_message();		
$mail->send('gulec59-g@yahoo.com', 'gulec59-g@yahoo.com','Tekliftopla','info@tekliftopla.com',$konu);

Header("Location:index.php");

?>