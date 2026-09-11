<?php include"headeri.php";?>
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
    <?php include "menu.php" ?>
  </div>
  <div id="analong">
    <table width="97%" align="center" border="0" cellspacing="0" cellpadding="0">
              <tr>
              <td colspan="4" height="2" ></td>
            </tr>
            <tr bgcolor="white"  >
              <td height="27px" width="25%" ></td>
			  <td width="25%"></td>
			  <td width="43%" align="right" class="title">Bilgi Güncelleme </td>
              <td width="7%" align="right" valign="bottom" ><img src="image/sag_ok.gif"></td>
            </tr>
        </table>
    <table align="center" width="95%" border="0" cellspacing="10px" cellpadding="0px">
          <tr bgcolor="#F6F6F6"><td> <? $verified_firma = isset($_SESSION["verified_firma"]) ? $_SESSION["verified_firma"]:''; ?>           
				<span class="Baslik">Sayın <?php echo $verified_firma;?>, güncellemek istediğiniz bilgiyi seçiniz. </span></td></tr>
                            <TR>
                            <td>
                            <table width="90%" border="0" align="center" cellpadding="2" cellspacing="5">
                            <tr><td align="left" class="govde"><span style="font-weight: bold"><i class="icon-stop-b"></i></span></span><a href="guncel.php" class="link"> Kullanıcı Bilgilerini Değiştirmek İstiyorum </a></td>
                          </TR>
                          <TR >
                            <td align="left" class="govde"><span style="font-weight: bold"><i class="icon-stop-b"></i></span> <a href="yenisifre.php" class="link"> Şifremi Değiştirmek İstiyorum</a> </td>
                          </TR>
                          <TR>
                            <td align="left" class="govde"><span style="font-weight: bold"><i class="icon-stop-b"></i></span> <a href="sil.php" class="link"> Kaydımı Silmek İstiyorum </a></td>
                          </TR>
                          <TR>
                            <td align="left" class="govde"><span style="font-weight: bold"><i class="icon-stop-b"></i></span> <a href="giris.php" class="link"> Kullanıcı Menüsüne Dön </a></td>
                          </TR>
                        </table>
                        </td></tr>
                      <tr><td height="10px"></td></tr>
                      </table>
                    </td>
                  </tr>
              </table>
  </div>
  <div id="bant1"></div>
  <div id="alt">
    <?php include "alt.php" ?>
  </div>
</div>
</BODY>
</HTML>
