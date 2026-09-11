<? include "headeryon.php"; ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="content-language" content="tr" />
<title>tekliftopla</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="jquery/jquery-ui.theme.css">
<link rel="stylesheet" href="jquery/jquery-ui.css">
<script src="jquery/external/jquery/jquery.js"></script>
<script src="jquery/jquery-ui.min.js"></script>
<script type="text/javascript" src="emailChecknew.js"></script>
<?php
$KulEkle = isset($_SESSION["KulEkle"]) ? $_SESSION["KulEkle"]: '0';
?>
</head>
<body>
<div id="sayfa">
  <div id="ust">
    <?php include "ust.php" ?>
  </div>
  <div id="bant1"></div>
  <div id="sol">
    <?php include "solyonetim.php" ?>
  </div>
  <div id="analong">

<table width="540px" align="center" border="0" cellpadding="0"  cellspacing="0" bgcolor=white >
      <tr>
        <td height="2" bgcolor="#FFFFFF"></td>
      </tr>
      <tr  >
        <td background="image/yeni_orta.gif" height="50" width="171" >&nbsp;</td>
        <td background="image/yeni_orta.gif" width="223" align="center" class="Baslik" valign="bottom"><span class="Baslik">E-posta değiştirme sayfası</span></td>
        <td background="image/yeni_orta.gif" width="134" valign="middle" align="right" class="Buyuk_Yazi">&nbsp;</td>
        <td background="image/yeni_orta.gif" width="27" ><img src="image/sag_ok.gif" width="27" height="64"></td>
      </tr>
      <tr>

        <td width="777" valign="top" bgcolor="#F6F6F6" colspan="4"><span class="title_kucuk">Say&#305;n</span> <span class="title_kucuk"><? $verified_user= isset( $_SESSION["verified_user"]) ?  $_SESSION["verified_user"] : ''; echo $verified_user;?>,</span>&nbsp;&nbsp;<span class="title_kucuk">lütfen mevcut ve yeni e-posta adresini giriniz.</span> <br>
          <TABLE width="100%"  border="0" align="center" cellpadding="2" cellspacing="0"  bordercolor="#F6F6F6"  bgcolor="#EAEAEA">
              <form method="post"  action="emaildegis.php" name="emailx" id="emailx">
                               <TR>
                  <td width="248" class="govde" align="right">Mevcut E-posta Adresini Giriniz:</td>
                  <td width="231" class="aciklama"> <FONT color=#990000>
                    <input maxlength="80" class="kutucuk" size="30" type="Text" name="eold">
        *</FONT></td>
                </TR>
              <TR bgcolor="white">
                  <td width="248" class="govde" align="right">Yeni E-posta Adresini Giriniz:</td>
                  <td width="231" class="aciklama"> <FONT color=#990000>
                    <input maxlength="80" class="kutucuk" size="30" type="Text" name="enew">
        *</FONT></td>
                </TR>
                <TR>
                  <td colspan="2" align="center" class="aciklama" bgcolor="#F6F6F6" height="50"><img src="image/bul.gif" width="146" height="16" class="ResimDugme" onClick="if (! confirm('Değiştirmek istediğinize emin misiniz?')) return false ; Gonder()"><img src= "image/trans.gif" alt="" width="25px" height="1"><img src="image/yonetici.gif" width="146" height="16" class="ResimDugme" onClick="Ilerle()" ></td>
                </TR>
              </form>
            </table>           
      </tr>
    </table>
</div>
</div>
<div id="dialog-sifreunut" title="Uyarı" style="display:none" class="text_g" >
  <p>
    <span></span>
  </p>
</div>
  <div id="bant1"></div> <!-- bant2 -->
  </div>

</BODY></HTML>
<script language="javascript">
function Gonder(){
	document.forms.emailx.eold.value=document.forms.emailx.eold.value.replace(/^\s+|\s+$/g,"");
	document.forms.emailx.enew.value=document.forms.emailx.enew.value.replace(/^\s+|\s+$/g,"");
	if (Validate())
		document.forms.emailx.submit();
}
function Validate() { 
if (document.forms.emailx.eold.value =="") 
{ 
 	alert(" Eski e-posta adresi eksik.");
	return (false); 
} 
/*if (document.forms.emailx.enew.value=="" ) 
{ 
 	alert(" Yeni e-posa adresi eksik. ");
	return (false); 
} */
if (!checkEmail(document.forms.emailx.enew.value)) return false;

return true;
} 

function Ilerle()
{
window.location ="yonetimgiris.php";
}


</script>