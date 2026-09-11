<?php include"headeryon.php"; ?>
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

<table width="540px" align="center"  cellspacing="0" cellpadding="0" border="0" bgColor=white >
          <tr>
            <td valign="top" bgcolor="f6f6f6"><h4><span class="title_kucuk">Sayın <? $verified_user= isset($_SESSION['verified_user']) ? $_SESSION['verified_user'] : ''; echo $verified_user;?>.</span></h4>
                <table width="353"  border="0" align="center" cellpadding="2" cellspacing="5"  bordercolor="#F6F6F6"  bgcolor="f6f6f6">
                  <tr>
                    <td class="title_kucuk"><center class="title" deletetype="title_kucuk" searchtype="title_kucuk" runat="title_kucuk">
                        İstatistik Sayfası 
                    </center>
                        <table align="center" width="350"  border="0" cellpadding="2" cellspacing="5"  bordercolor="#F6F6F6"  bgcolor="f6f6f6">
                          <tr>
                            <td class="s"><img src="image/ok.gif" width="15" height="15" border="0" alt="Counter"><a href="uyeistatistik.php" class="link">Üye ve Teklif Bilgileri </a></td>
                          </tr>
                          <tr>
                            <td class="s"><img src="image/ok.gif" width="15" height="15" border="0" alt="Son 50 üye"><a href="sonuyeler.php" class="link">Son 50 Üye Bilgileri</a></td>
                          </tr>
                          <tr>
                            <td class="s"><img src="image/ok.gif" width="15" height="15" border="0" alt="Counter"><a href="iplog.php" class="link">Site Erişim Bilgileri </a></td>
                          </tr>
                          <tr>
                            <td class="s"><img src="image/ok.gif" width="15" height="15" border="0" alt="Son 12 Aylık Üye ve Talep"><a href="kayitteklifsayisi.php" class="link">Son 12 Aylık Kayıt ve Teklif Bilgileri </a></td>
                          </tr>
                          <tr>
                            <td class="s"><img src="image/ok.gif" width="15" height="15" border="0" alt="Tarihe G&ouml;re Kay&yacute;t Say&yacute;s&yacute;"><a href="tarihrapor.php" class="link">Tarihe G&ouml;re Kayıt Sayısı </a></td>
                          </tr>
                          <tr>
                            <td class="s"><img src="image/ok.gif" width="15" height="15" border="0" alt="Son haftanın teklif talepleri"><a href="haftalikteklifler.php" class="link">Son Haftanın Teklif Talepleri</a></td>
                          </tr>
                          <tr>
                            <td class="s"><img src="image/ok.gif" width="15" height="15" border="0" alt="Son haftanın teklif talepleri"><a href="sonunsubscribe.php" class="link">Son 50 Listeden Çıkan</a></td>
                          </tr>
                          <tr>
                            <td class="s"><img src="image/ok.gif" width="15" height="15" border="0" alt="Çıkış"><a href="yonetimgiris.php" class="link">Yönetici Sayfasına Dön </a></td>
                          </tr>
                      </table></td>
                  </tr>
                </table>
          </tr>
        </table>
 </div>
  <div id="bant1"></div> <!-- bant2 -->
  
</div>        
</BODY></HTML>
