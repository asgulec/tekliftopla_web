<? include"headeri.php"; ?>
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
			  <td width="43%" align="right" class="title">Kullanıcı Menüsü </td>
              <td width="7%" valign="bottom" align="right"><img src="image/sag_ok.gif"></td>
            </tr>
        </table>
    <table align="center" width="95%" border="0" cellspacing="10" cellpadding="0">
      <tr>
	     <? $verified_firma = isset($_SESSION['verified_firma']) ? $_SESSION['verified_firma'] : ''; $verified_firmaid = isset($_SESSION['verified_firmaid']) ? $_SESSION['verified_firmaid'] : ''; ?>
        <td bgcolor="#F6F6F6" colspan="4" align="left" class="Baslik" valign="middle"><? echo $verified_firma;?> kullanıcı menüsü</td>
      </tr>
            <?php $kultip = "select tekliftopla from bilgi where firmaid='$verified_firmaid'";
			   $restip=mysqli_query($connection,$kultip);
			   $kulyon = mysqli_fetch_array($restip);
			   $tip=$kulyon['tekliftopla'];
			 ?>  
            <tr>
            <td colspan="4">
              <TABLE width="90%"  border="0" align="center" padding="2" cellspacing="8"  >
                          <TR>
                            <td align="left" class="govde"><span style="font-weight: bold"><i class="icon-stop-b"></i></span><a href="kullanim.php" class="link"> Teklif Topla</a></td>
                          </TR>
              <?php if ( $tip == 1) {?>
                          <TR>
                            <td align="left" class="govde"><span style="font-weight: bold"><i class="icon-stop-b"></i></span><a href="kularagor1.php" class="link"> Teklif Bekleyenler</a></td>
                          </TR>
              <?php } ?>            
                          <TR>
                            <td align="left" class="govde" ><span style="font-weight: bold"><i class="icon-stop-b"></i></span> <a href="guncelleme.php" class="link"> Kullanıcı Bilgilerini Değiştirme</a></td>
                          </TR>
                          <TR>
                            <td align="left" class="govde"><span style="font-weight: bold"><i class="icon-stop-b"></i></span> <a href="cikis.php" class="link"> Çıkış</a></td>
                          </TR>
                        </table></td>
                  </tr>
              <tr>
              <td align="left"  height="15" ></td>
            </tr>
          </td>
      </tr>
      <tr><td class="not"><br>
        <strong class="not"> Not: </strong><span class="not">tekliftopla.com şimdilik sadece mal ve hizmet <em><strong>alımları</strong></em> için kullanılmaktadır. Mal veya hizmet alımları dışındaki kullanımlar  iptal edilecektir. </span><br>
        <br> </td></tr>
        </table>
  </div>
  <div id="bant1"></div>
  <div id="alt">
    <?php include "alt.php" ?>
  </div>
</div>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
var pageTracker = _gat._getTracker("UA-699917-3");
pageTracker._trackPageview();
</script>
</BODY></HTML>
