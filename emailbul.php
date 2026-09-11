<? include "headeryon.php"; ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="content-language" content="tr" />
<title>tekliftopla</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
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
        <td background="image/yeni_orta.gif" height="50" width="191" >&nbsp;</td>
        <td background="image/yeni_orta.gif" width="183" align="center" class="Baslik" valign="bottom"><span class="Baslik">Üye  Arama Sayfası</span></td>
        <td background="image/yeni_orta.gif" width="154" valign="middle" align="right" class="Buyuk_Yazi">&nbsp;</td>
        <td background="image/yeni_orta.gif" width="27" ><img src="image/sag_ok.gif" width="27" height="64"></td>
      </tr>
      <tr>

        <td width="777" valign="top" bgcolor="#F6F6F6" colspan="4"><span class="title_kucuk">Say&#305;n</span> <span class="title_kucuk"><? $verified_user= isset($_SESSION["verified_user"]) ? $_SESSION["verified_user"] : ''; echo $verified_user;?>,</span>&nbsp;&nbsp;<span class="title_kucuk">lütfen e-posta adresini giriniz.</span> <br>
          <TABLE width="100%"  border="0" align="center" cellpadding="2" cellspacing="0"  bordercolor="#F6F6F6"  bgcolor="#EAEAEA">
              <form method="post"  action="emailgor.php" name="LoginForm">
                               <TR>
                  <td width="248" class="govde" align="right">Firma E-posta Adresini Giriniz:</td>
                  <td width="231" class="aciklama"> <FONT color=#990000>
                    <input maxlength="80" class="kutucuk" size="30" type="Text" name="efirma">
        *</FONT></td>
                </TR>
              
                <TR>
                  <td colspan="2" align="center" class="aciklama" bgcolor="#F6F6F6" height="50"><img src="image/bul.gif" width="146" height="16" class="ResimDugme" onClick="Gonder()"><img src= "image/trans.gif" alt="" width="25px" height="1"><img src="image/yonetici.gif" width="146" height="16" class="ResimDugme" onClick="Ilerle()" ></td>
                </TR>
              </form>
            </table>           
      </tr>
    </table>
</div>
  <div id="bant1"></div> <!-- bant2 -->
  </div>

</BODY></HTML>
<script language="javascript">
function Gonder()
{
 document.forms.LoginForm.submit();
}
function Ilerle()
{
window.location ="yonetimgiris.php";
}


</script>