<?php include "headeri-e.php";?>
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
        <td width="43%" align="right" class="title">Account Settings</td>
        <td width="7%" align="right" valign="bottom" ><img src="../image/sag_ok.gif"></td>
      </tr>
    </table>
    <table align="center" width="95%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <? $verified_firma = isset($_SESSION["verified_firma"]) ? $_SESSION["verified_firma"] : '';?>
        <td bgcolor="#F6F6F6" colspan="4" align="left" class="Baslik" valign="middle">Account settings for <? echo $verified_firma;?></td>
      </tr>
      <tr>
        <td colspan="4"><table width="90%" border="0" align="center" cellpadding="2" cellspacing="5" >
            <tr>
              <td><center class="title">
                </center></td>
            </tr>
            <TR>
              <td align="left" class="govde"><span style="font-weight: bold"><i class="icon-stop-b"></i></span><a href="guncel-e.php" class="link"> Update my information</a></td>
            </TR>
            <TR>
              <td align="left" class="govde"><span style="font-weight: bold"><i class="icon-stop-b"></i></span><a href="yenisifre-e.php" class="link"> Change password </a></td>
            </TR>
            <TR>
              <td align="left" class="govde"><span style="font-weight: bold"><i class="icon-stop-b"></i></span><a href="sil-e.php" class="link"> Disable account </a></td>
            </TR>
            <TR>
              <td align="left" class="govde"><span style="font-weight: bold"><i class="icon-stop-b"></i></span><a href="giris-e.php" class="link"> Return to my account</a></td>
            </TR>
            <tr>
              <td align="left"  class="title_kucuk" height="15" valign="middle"></span></td>
            </tr>
          </table></td>
      </tr>
      <tr>
        <td class="not"></td>
      </tr>
      <tr>
        <td height:"25px" colspan="4" align="left" class="Baslik" valign="middle"><img src= "../image/trans.gif" alt="" width="1" height="15"></td>
      </tr>
    </table>
  </div>
  <div id="bant1"></div>
  <div id="alt">
    <?php include "alt-e.php" ?>
  </div>
</div>
</BODY>
</HTML>
