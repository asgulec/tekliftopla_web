<? include"headeri-e.php";?>
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
    <table align="center" width="97%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td colspan="4" height="2" ></td>
      </tr>
      <tr>
        <td height="27px" width="25%" ></td>
        <td width="25%"></td>
        <td width="43%" align="right" class="title">Disable User</td>
        <td width="7%" align="right" valign="bottom" ><img src="../image/sag_ok.gif"></td>
      </tr>
      <tr>
        <td colspan="4" height="10px"></td>
      </tr>
    </table>
    <table align="center" width="95%">
      <tr>
        <td width="100%" valign="top" bgcolor="#f6f6f6"><? $verified_firma = isset($_SESSION["verified_firma"]) ? $_SESSION["verified_firma"]:""; ?>
          <span class="Baslik">User <? echo $verified_firma; ?> will be disabled ! Please confirm..</span></td>
      </tr>
      <tr>
        <td><table align="center">
            <tr>
              <td height="60px"><form action="update-e.php?islem=kayitsil" method="post" name="frmSil">
                  <a href="#here" onClick="javascript:frmSil.submit();" class="buttonPage"> Yes &nbsp;<i class="icon-arrow-right"></i></a>
                </form></td>
              <td><img src= "../image/trans.gif" width="25" height="1"></td>
              <td><form action="guncelleme-e.php" method="post" name="frmIptal">
                  <a href="#here" onClick="javascript:frmIptal.submit();" class="buttonPage"> Cancel &nbsp;<i class="icon-close" ></i></a>
                </form></td>
            </tr>
          </table>
    </table>
  </div>
  <div id="bant1"></div>
  <div id="alt">
    <?php include "alt-e.php" ?>
  </div>
</div>
</body>
</HTML>