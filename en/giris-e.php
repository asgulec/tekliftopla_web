<?php include"headeri-e.php";?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="content-language" content="us" />
<title>tekliftopla</title>
<link href="../css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="sayfa">
  <div id="ust">
    <?php include "ust-e.php" ?>
  </div>
  <div id="bant1"></div>
  <div id="sol">
    <?php include "menu-e.php" ?>
  </div>
  <div id="analong">
    <table width="97%" align="center" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td colspan="4" height="2" ></td>
      </tr>
      <tr bgcolor="white"  >
        <td height="27px" width="25%" ></td>
        <td width="25%"></td>
        <td width="43%" align="right" class="title">User Menu</td>
        <td width="7%" valign="bottom" align="center" ><img src="../image/sag_ok.gif"></td>
      </tr>
    </table>
    <table align="center" width="95%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <? $verified_firma = isset($_SESSION['verified_firma']) ? $_SESSION['verified_firma'] : ''; $verified_firmaid = isset($_SESSION['verified_firmaid']) ? $_SESSION['verified_firmaid'] : ''; ?>
        <td bgcolor="#F6F6F6" colspan="4" align="left" class="Baslik" valign="middle">User Menu for <? echo $verified_firma;?></td>
      </tr>
      <?php $kultip = "select tekliftopla from bilgi where firmaid='$verified_firmaid'";
			   $restip=mysqli_query($connection,$kultip);
			   $kulyon = mysqli_fetch_array($restip);
			   $tip=$kulyon['tekliftopla'];
			 ?>
      <tr>
        <td colspan="4"><table width="90%" border="0" align="center" cellpadding="2" cellspacing="5" >
            <tr>
              <td><center class="title">
                </center>
            <TR>
              <td align="left"><span style="font-weight: bold"><i class="icon-stop-b"></i></span><a href="kullanim-e.php" class="link"> Prepare a request for proposal (RFP)</a></td>
            </TR>
            <?php if ( $tip == 1) {?>
            <TR style="display:none">
              <td align="left"><span style="font-weight: bold"><i class="icon-stop-b"></i></span><a href="../kularagor1.php" class="link"> Teklif Bekleyenler </a></td>
            </TR>
            <?php } ?>
            <TR>
              <td align="left" class="govde"><span style="font-weight: bold"><i class="icon-stop-b"></i></span><a href="guncelleme-e.php" class="link"> Update User Info </a></td>
            </TR>
            <TR>
              <td align="left" class="govde"><span style="font-weight: bold"><i class="icon-stop-b"></i></span><a href="cikis-e.php" class="link"> Log Out</a></td>
            </TR>
            <tr>
              <td align="left"  class="title_kucuk" height="15" valign="middle"></span></td>
            </tr>
          </table></td>
      </tr>
      <tr>
        <td class="not"><br>
          tekliftopla.com will only service purchasing RFP's. All other and/or usages not complying with 'Terms of Use' will be canceled.<br>
          <br></td>
      </tr>
      <tr>
        <td height:"25px" colspan="4" align="left" class="Baslik" valign="middle"><img src= "../image/trans.gif" alt="" width="1" height="15"></td>
    </table>
  </div>
  <div id="bant1"></div>
  <div id="alt">
    <?php include "alt-e.php" ?>
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
</BODY>
</HTML>
