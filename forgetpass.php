<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="content-language" content="tr" />
<title>tekliftopla</title>
<link href="css/style.css" type="text/css" rel="stylesheet">
<link rel="stylesheet" href="jquery/jquery-ui.theme.css">
<link rel="stylesheet" href="jquery/jquery-ui.css">
<script src="jquery/external/jquery/jquery.js"></script>
<script src="jquery/jquery-ui.min.js"></script>
<script type="text/javascript" src="emailChecknew.js"></script>
</head>
<body>
<?php
$cevap =isset($_GET['sonuc']) ? $_GET['sonuc'] : '';
if ($cevap == 'tamam') {?>
<script language="javascript">
 $(function(){
    $("#dialog-sifreteyit" ).dialog({
		close: function () {
            window.location.href = "index.php" },
		modal:true,
		position: {	my: "center",at: "center",of: sayfa},
		buttons:{Tamam: function () {
    $(this).dialog("close");
    }}
	});	
  });
</script>
<?php }
if ($cevap == 'epostayok') {?>
<script language="javascript">
$(function(){
    $( "#dialog-sifreyok" ).dialog({
		close: function () {
            window.location.href = "forgetpass.php" },
		modal:true,
		position: {	my: "center",at: "center",of: sayfa},
		buttons:{Tamam: function () {
    $(this).dialog("close");
	}}
	});	
  });
</script>
<?php } ?>
<div id="sayfa"> 
  <div id="ust"> <? include "ust.php"?> </div> <!-- ust -->
  <div id="bant1"></div> <!-- bant1 -->
  <div id="sol"><? include "sol.php";?></div> <!-- sol -->
  <div id="analong">
  <table border="0" cellspacing="0" cellpadding="0">
           
            <tr>
              <td colspan="4" height="2" ></td>
            </tr>
            <tr bgcolor="white"  >
              <td height="64" width="191" ></td>
			  <td width="164"></td>
			  <td width="173" align="right" class="title">Şifre Bildirme</td>
              <td width="27" ><img src="image/sag_ok.gif" width="27" height="64"></td>
            </tr>
        </table>
  <table width="95%" cellspacing="10" cellpadding="0" align="center" border="0">
        <tbody>
        <tr><td bgcolor="#F6F6F6" colspan="2" class="Baslik">E-posta adresinizi giriniz şifreniz gönderilecektir. <br> </td></tr>
        <tr><td colspan="2" height="10"> </td></tr>
        <FORM name="LoginForm" id="LoginForm" action="emailunut.php" method="post">
  <input type="hidden" name="yazi" id="yazi" > 
        <TR><td class="govde" align="right" >E-Posta Adresi: </td>
        <td><input type="text" id="semail" name="semail" size=20 style="border: 1 solid #666666" width="200" >
            <FONT color=#990000>*</FONT></td>
      </TR>
      <TR>
        <td colspan="2" align="center" height="50px"><a href='javascript:Eposta()' class="buttonPage"> Gönder &nbsp;<i class="icon-arrow-right"></i></a></td>
      </TR>
     </FORM>
        <tr><td colspan="2" height="10"> </td></tr>
        <tr><td colspan="2" class="Baslik"> </td></tr>
        
        </tbody>
        </table>
  </div> <!-- ana -->
  <div id="bant1"></div> <!-- bant2 -->
  <div id="alt"> <? include "alt.php";?> </div> <!-- alt -->
</div> <!-- sayfa -->

<div id="dialog-sifreteyit" title="Bilgi" style="display:none" class="text_g" >
  <p>
    Şifreniz e-posta adresinize gönderilmiştir. </p>
   <p>Lütfen önemsiz posta, spam ve istenmeyen posta klasörlerini kontrol ediniz. 
  </p>
</div>
<div id="dialog-sifreyok" title="Uyarı" style="display:none" class="text_g" >
  <p>
    Bu e-posta adresi sisteme kayıtlı değildir. </p>
   <p>Arzu ederseniz ; <br><br>"YENİ ÜYE", <br>"Google ile giriş yap" veya <br>"Facebook ile giriş yap" <br><br>düğmelerini tıklayarak kolayca üye olabilirsiniz. 
  </p>
</div>
<div id="dialog-sifreunut" title="Uyarı" style="display:none" class="text_g" >
  <p>
    <span>...</span>
  </p>
</div>
<script type="text/javascript">
function Eposta()
{ 
if (!checkEmail(document.forms.LoginForm.semail.value)===false)
    {   document.forms.LoginForm.submit();}
}
</SCRIPT>
</body>
</html>
