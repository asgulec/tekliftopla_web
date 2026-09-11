<?php include "headeryon.php"; ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="content-language" content="tr" />
<title>tekliftopla</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
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
<table width="540px" align="center" border="0" cellpadding="0"  cellspacing="0" bgColor=white >
          <tr>
            <td width="540px" valign="top" bgcolor="#f6f6f6"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td colspan="4" height="2" bgcolor="#FFFFFF"></td>
                </tr>
                <tr  >
                  <td background="image/yeni_orta.gif" height="50" width="191" >&nbsp;</td>
                  <td background="image/yeni_orta.gif" width="183" align="center" class="Baslik" valign="bottom">Teklif Arama Sayfası</td>
                  <td background="image/yeni_orta.gif" width="154" valign="middle" align="right" class="Buyuk_Yazi">&nbsp;</td>
                  <td background="image/yeni_orta.gif" width="27" ><img src="image/sag_ok.gif" width="27" height="64"></td>
                </tr>
              </table><? $verified_firma = $_SESSION["verified_user"]; ?>
                <p class="title_kucuk">Sayın <? echo $verified_firma;?>, lütfen teklif numarasını giriniz.</p>
                                    <form method="post"  action="teklifgoster.php" name="LoginForm">
                          <table width="100%"  border="0" align="center" cellpadding="2" cellspacing="0"  bordercolor="#F6F6F6"  bgcolor="#EAEAEA" >
                            <tr>
                              <td width="46%" class="sss"><div align="right" class="govde">Teklif Numarası</div></td>
                              <td width="54%">
                                <input maxlength="15" class="kutucuk" size="10" type="number" name="teklifnumber">
                              </td>
                            </tr>
<TR>
              <td colspan="2" align="center" class="aciklama" bgcolor="#F6F6F6" height="50" valign="middle"><img src="image/bul.gif" width="147" height="16" onClick="Gonder()" class="ResimDugme"><img src= "image/trans.gif" alt="" width="25px" height="1"><img src="image/yonetici.gif" width="146" height="16" class="ResimDugme" onClick="ilerle()" ></td>
            </TR>
            </table>
            </form>          </tr>
        </table>
   </div>
  <div id="bant1"></div> <!-- bant2 -->
  
</div>
</body>
</HTML>
<script language="javascript">
function Gonder()
{
 document.forms.LoginForm.submit();
}
function ilerle()
{

window.location ="yonetimgiris.php";

}


</script>