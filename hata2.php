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
  <div id="ust"> <? include "ust.php"?> </div>
  <div id="bant1"></div>
  <div id="sol"><? include "menu.php";?></div>
  <div id="analong">
  <table width="97%" align="center" border="0" cellspacing="0" cellpadding="0">
      <tr><?php $verified_firma = isset ($_SESSION["verified_firma"]) ? $_SESSION["verified_firma"] : ''?>
        <td>
        <table align="center" width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
          <td colspan="4" height="2" ></td>
          </tr>
          <tr bgcolor="white"  >
          <td height="27px" width="25%" ></td>
		  <td width="25%"></td>
		  <td width="43%" align="right" class="title">Hatalı İşlem</td>
          <td width="7%" align="right" valign="middle" ><img src="image/sag_ok.gif"></td>
          </tr>
          <tr><td height="10px"></td></tr>
        </table>
        </td>
      </tr>
      <tr>
      <td bgcolor="#F6F6F6"><span class="Baslik">Hatalı işlem, lütfen tekrar deneyiniz.</span></td></tr>
      <tr><td>
           <table width="80%" cellspacing="0" cellpadding="2" border="0" align="center">
           <tr>
           <td height="10px" align="center"></td>
           </tr>
           <tr>
           <td align="center" class="aciklama" height="50" valign="middle"><a href="javascript:history.go(-1)" class="buttonPage"><i class="icon-arrow-left" ></i> &nbsp; Tekrar Dene</a></td>
           </tr>
           </table>
           </TR>
    </table>
  </div> 
  <div id="bant1"></div> 
  <div id="alt">
  <? include "alt.php";?>
  </div>
</div>
</BODY>
</HTML>
