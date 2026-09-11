<? include"headeri.php";?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/style.css" rel="stylesheet" type="text/css">
<title>tekliftopla</title>
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
        <td height="27" width="25%" ></td>
        <td width="25%"></td>
        <td width="43%" align="right" class="title">Kullanıcı Aktif</td>
        <td width="7%" ><img src="image/sag_ok.gif"></td>
      </tr>
    </table>
      <table width="90%" align="center" bgColor="white" >
        <tr><td height="15px">
        </td></tr>
        <tr>
		<? $verified_firma = $_SESSION["verified_firma"]; ?>
          <td width="90%" align="left" valign="top" bgcolor="#f6f6f6"> <span class="Baslik">Sayın <? echo $verified_firma; ?>, kaydınız tekrar aktif hale gelecektir. Teyit ediniz..</span> </td></tr>
          	<tr> <td>
              <table align="center" >
                <tr>
                  <td></td></tr>
                   <tr>
                    <form action="update.php?islem=aktiv" method="post">
                     <td align="center" bgcolor="white"> <br>
                     <input name="submit" type="submit" class="Dugme"   value=" EVET  "> <br><br>
                     </td> 
                     </form>
                     </tr>   
                </table>
              </td>
            </table>
  </div>
  <div id="bant1"></div>
  <div id="alt">
    <?php include "alt.php" ?>
  </div>
</div>
</body>
</html>

