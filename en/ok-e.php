<? include"headeri-e.php"; ?>
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
    <table width="97%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td colspan="4" height="2" ></td>
      </tr>
      <tr bgcolor="white"  >
        <td height="25px" width="25%" ></td>
        <td width="25%"></td>
        <td width="43%" align="right" class="title">Confirmation</td>
        <td width="7%" align="right" valign="bottom" ><img src="../image/sag_ok.gif"></td>
      </tr>
    </table>
    <table width="95%" cellspacing="1" cellpadding="1" border="0" align="center" >
      <tr>
        <td ><form action="clear-e.php" method="post" name="LoginForm">
            <table cellspacing="0" cellpadding="0" border="0" align="center" width="100%" height="250px">
              <tr>
                <td bgcolor="#F6F6F6" height="15px"></td>
              </tr>
              <tr class="onay">
                <td align="center"> Your RFP is e-mailed to relevant suppliers in Turkey.<br>
                  <br>
                  You will also receive a confirmation e-mail.
                  <p>RFP reference number:
                    <?php $verified_kulid = isset($_SESSION["verified_kulid"]) ? $_SESSION["verified_kulid"]:''; echo $verified_kulid; ?>
                  </p></td>
              </tr>
              <tr>
                <td align="center" height="50px"><a href="#here" onClick="javascript:LoginForm.submit();" class="buttonPage"> User Menu &nbsp;<i class="icon-arrow-right"></i></a></td>
              </tr>
              <tr>
                <td height="10px"></td>
              </tr>
            </TABLE>
          </form></td>
      </tr>
    </table>
  </div>
  <div id="bant1"></div>
  <div id="alt">
    <?php include "alt-e.php" ?>
  </div>
</div>
</body>
</HTML>