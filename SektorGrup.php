<?php include "headeryon.php"; ?>
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
  <div id="ust">
    <?php include "ust.php" ?>
  </div>
  <div id="bant1"></div>
  <div id="sol">
    <?php include "solyonetim.php" ?>
  </div>
  <div id="analong">

<table width="540px"  border="0" align="center" cellpadding="2" cellspacing="0"  bordercolor="#F6F6F6"  bgcolor="#EAEAEA">
      <form name="frmHaber" method="post" action="SektorGrupKaydet.php">
        <input type="hidden" name="Durum" value="<? print $_POST["Durum"];?>">
        <input name="Id" type="hidden" value="<? print $_POST["Id"]; ?>">
        <tr bgcolor="#FFFFFF" class="title_kucuk">
          <td colspan="2" align="center"bgcolor="#FFFFFF" class="title_kucuk">Sekt&ouml;r  Ekleme/De&#287;i&#351;tirme </td>
        </tr>
        <tr bgcolor="#FFFFFF">
          <td width="33%" class="Baslik"><strong class="title_kucuk">Sekt&ouml;r Grup Ad&#305; </strong></td>
          <td width="67%">
            <input name="Adi" type="text" id="Adi" value="<? if($_POST["Durum"]==2) print $_POST["Adi"]; ?>" size="50">
          </td>
        </tr>
        <tr bgcolor="#FFFFFF">
          <td height="26" align="left" valign="top">&nbsp;</td>
          <td align="left" valign="top">
            <input name="Gonder" type="button"  value="Kaydet" onClick="Denetle()">
            <input name="Iptal" type="button"  value="IPTAL" onClick="javascript:history.go(-1);"></td>
        </tr>
      </form>
    </table>
 </div>
  <div id="bant1"></div> <!-- bant2 -->
  
</div>

</body>
</html>
<script language="JavaScript" type="text/javascript">
 function Denetle()
 {   
  frmHaber.submit(); 
 }
</script>