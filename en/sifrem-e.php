<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="content-language" content="us" />
<title>tekliftopla</title>
<link href="../css/style.css" rel="stylesheet" type="text/css">
<?php include"../headeri.php"; ?>
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
        <td height="27px" width="25%" ></td>
        <td width="25%"></td>
        <td width="43%" align="right" class="title">Confirmation</td>
        <td width="7%" valign="bottom" align="right" ><img src="../image/sag_ok.gif"></td>
      </tr>
    </table>
    <table width="90%" align="center" bgColor="white" >
      <? $verified_firma = isset($_SESSION["verified_firma"]) ? $_SESSION["verified_firma"] : "";
		 $mesaj = mysqli_real_escape_string($connection,isset($_GET["mesaj"]) ? $_GET["mesaj"] :'');
		 if ($mesaj=="tamam"){
		 ?>
      <tr><td height="10px"></td></tr>
      <tr>
        <td width="100%" valign="top" bgcolor="#f6f6f6"><span class="Baslik">User <? echo $verified_firma; ?> password is changed. </span></td>
      </tr>
      <tr>
        <td height="60px" align="center"><a href="#here" onClick="Git()" class="buttonPage"> User Menu &nbsp;<i class="icon-arrow-right"></i></a></td>
      </tr>
      
      <?php }
    else { ?>
      <tr>
        <td width="100%" valign="top" bgcolor="#f6f6f6"><span class="Baslik">User <? echo $verified_firma; ?> password change failed, please check old password and try again. </span></td>
      </tr>
      <tr>
        <td align="center" height="60px"><a href="#here" onClick="Git()" class="buttonPage"><i class="icon-arrow-left"></i>&nbsp; User Menu</a></td>
      
      <?php } ?>
    </table>
  </div>
  <div id="bant1"></div>
  <div id="alt">
    <?php include "alt-e.php" ?>
  </div>
</div>
<script language="javascript">
function Git(){
	window.location = "guncelleme-e.php";
}
function Gitx(){
	window.location = "yenisifre-e.php";
}
</script>
</body>
</HTML>
