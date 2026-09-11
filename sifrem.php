<?php include "headeri.php"; ?>
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
  <table width="90%" cellspacing="4" border="0" align="center" >
  <tr>
  <td>&nbsp;
  </td>   
  </tr>
  <tr>
  <td align="center"><strong><span class="title_kucuk">Şifreniz başarıyla değiştirilmiştir
  </span></strong></td>
  </tr>
  <tr>
  <td>&nbsp;
  </td>   
  </tr>
  <tr>
  <td colspan="2" align="center" height="30" valign="middle"><a href="#here" onClick="Git()" class="buttonPage"> Kullanıcı Menüsü &nbsp;<i class="icon-arrow-right"></i></a></td>
  </tr>			  
  </table>
</div> 
  <div id="bant1"></div> 
  <div id="alt">
  <? include "alt.php";?>
  </div>
</div>
</BODY>

</HTML>
<script language="javascript">
function Git(){
	window.location = "giris.php";
}
</script>