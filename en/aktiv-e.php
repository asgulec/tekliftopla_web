<? include "headeri-e.php";?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../css/style.css" rel="stylesheet" type="text/css">
<title>tekliftopla</title>
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
        <td height="27" width="25%" ></td>
        <td width="25%"></td>
        <td width="43%" align="right" class="title">Activate User</td>
        <td width="7%" ><img src="../image/sag_ok.gif"></td>
      </tr>
    </table>
    <table width="90%" align="center" bgColor="white" >
      <tr>
        <td height="15px">
      <tr>
        <td valign="top" bgcolor="#f6f6f6"><? $verified_firma = $_SESSION["verified_firma"]; ?>
          <span class="Baslik">User <? echo $verified_firma; ?> will be activated ! Please confirm..</span></td>
      </tr>
      <tr>
        <td><table cellspacing="1" cellpadding="1" border="0" align="center" >
            <tr>
              <form action="update-e.php?islem=aktiv" method="post">
                <td align="center" valign="middle" bgcolor="white"><br>
                  <input name="submit" type="submit" class="Dugme"   value=" YES  ">
                  <br></td>
              </form>
            </tr>
          </table></td>
      </tr>
    </table>
  </div>
  <div id="bant1"></div>
  <div id="alt">
    <?php include "alt-e.php" ?>
  </div>
</div>
</body>
</html>
