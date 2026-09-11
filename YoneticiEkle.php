<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script language="JavaScript" type="text/javascript"></script>
<link href="css/style.css" rel="stylesheet" type="text/css">
</head>
<body bgcolor="#FFFFFF">
<table width="590" border="0" align="center" cellpadding="3" cellspacing="0">
  <tr>
    <td width="584" align="center" valign="middle" bgcolor="#FF9900"><strong>Y&ouml;netici Ekleme Arabirimi </strong>    </td>
  </tr>
</table>
<table width="590" border="1" align="center" cellpadding="4" cellspacing="1" bgcolor="#CCCCCC">
  <form name="frmHaber" method="post" action="YoneticiEkleKaydet.php">
    <input type="hidden" name="Durum" value="<? print $_POST["Durum"];?>">
    <input name="Id" type="hidden" value="<? print $_POST["Id"]; ?>">
    <tr bgcolor="#FFFFFF">
      <td width="33%" class="Baslik"><strong>Y&ouml;netici Ad&#305; </strong></td>
      <td width="67%">
        <input name="username" type="text" id="username" value="<? if($_POST["Durum"]==2) print $_POST["username"]; ?>" size="50">
      </td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td class="Baslik"><strong>&#350;ifre</strong></td>
      <td><input name="password" type="text" id="password" value="<? if($_POST["Durum"]==2) print $_POST["password"]; ?>" size="50"></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="26" align="left" valign="top" class="Baslik"><strong>Kullan&#305;c&#305; Ekleme </strong></td>
      <td align="left" valign="top"><input name="kullaniciekleme" type="text" id="kullaniciekleme" value="<? if($_POST["Durum"]==2) print $_POST["kullaniciekleme"]; ?>" size="5"> 
        <span class="not">Not: 1 ekleyebilir 0 ekleyemez</span> </td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="26" align="left" valign="top">&nbsp;</td>
      <td align="left" valign="top">
        <input name="Gonder" type="button"  value="Kaydet" onClick="Denetle()">
        <input name="Iptal" type="button"  value="IPTAL" onClick="javascript:history.go(-1);"></td>
    </tr>
  </form>
</table>
<p>&nbsp;</p>
</body>
</html>
<script language="JavaScript" type="text/javascript">
 function Denetle()
 {   
  document.forms.frmHaber.submit(); 
 }
</script>