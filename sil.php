<? include"headeri.php";?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="content-language" content="tr" />
<title>tekliftopla</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<style type="text/css">
<!--
.style1 {color: #000000}
-->
</style>
<div id="sayfa"> 
  <div id="ust"> <? include "ust.php"?> </div>
  <div id="bant1"></div>
  <div id="sol"><? include "menu.php";?></div>
  <div id="analong">
  <table width="97%" align="center" border="0" cellspacing="0" cellpadding="0">
      <tr><? $verified_firma = isset ($_SESSION["verified_firma"]) ? $_SESSION["verified_firma"] : ''?>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">           
            <tr>
              <td colspan="4" height="2" ></td>
            </tr>
            <tr bgcolor="white"  >
              <td height="27" width="25%" ></td>
			  <td width="25%"></td>
			  <td width="43%" align="right" class="title">Kayıt Silme</td>
              <td width="7%" align="right" valign="bottom"><img src="image/sag_ok.gif"></td>
            </tr>
            <tr><td height="10px"></td></tr>        
        </table></td>
      </tr>
    <tr><td>
    <table width="95%" align="center"  bgColor="white" >
      <tr>
        <td width="100%" valign="top" bgcolor="#f6f6f6"><? $verified_firma = isset($_SESSION["verified_firma"]) ? $_SESSION["verified_firma"] : ""; ?>
          <span class="Baslik">Sayın <? echo $verified_firma; ?>, kaydınızı silmek istediginizi teyit ediniz.</span></td></tr>
          <tr><td>
          <table cellspacing="0" cellpadding="2" border="0" align="center" >
            <tr>
               <td align="center" valign="middle" height="60px">
              <form action="update.php?islem=kayitsil" method="post" name="frmSil">
              <a href="#here" onClick="javascript:frmSil.submit();" class="buttonPage"> Evet &nbsp;<i class="icon-arrow-right"></i></a> </form></td>
              <td><img src= "image/trans.gif" width="25" height="1"></td>
              <td align="center" valign="middle" height="60px" > <center>
                        <form action="guncelleme.php" method="post" name="frmIptal">
                          <a href="#here" onClick="javascript:frmIptal.submit();" class="buttonPage"> Hayır &nbsp;<i class="icon-close" ></i></a>                        
                        </form> </center> </td>
                    </tr>
                </table></td>
            </tr>
        </table></td>
      </tr>
    </table>
    </td></tr></table>
    </div> 
  <div id="bant1"></div> 
  <div id="alt">
  <? include "alt.php";?>
  </div>
</div>
</body>
</HTML>