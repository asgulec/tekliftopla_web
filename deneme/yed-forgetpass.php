<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="content-language" content="tr" />
<title>tekliftopla</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="emailCheck.js">
</script>
</head>
<script type="text/javascript">
function Eposta()
{ 
if (!checkEmail(document.forms.LoginForm.semail.value)===false)
    {document.forms.LoginForm.submit();}
}
</SCRIPT>
<body bgcolor="white">
<table width="95%" border="0" align="center" cellpadding="2" cellspacing="0">
 <FORM name="LoginForm" id="LoginForm" action="emailunut.php" method="post" onsubmit="return false">
  <input type="hidden" name="yazi" id="yazi" > 
  <tr><td colspan="2" align="center" ><img src="image/logo.gif" width="176" height="62" border="0" alt=""></td></TR>
  <tr><td colspan="2" class="Baslik" bgcolor="#F6F6F6" >E-posta adresinizi giriniz şifreniz gönderilecektir. </td></TR>
   <tr><td colspan="2" height="10px"></td></tr>
   <TR><td class="govde" >E-Posta Adresi: </td>
        <td><input type="text" id="semail" name="semail" size=20 style="border: 1 solid #666666" width="200" >
            <FONT color=#990000>*</FONT></td>
      </TR>
      <TR>
        <td colspan="2" align="center" height="50px"><a href='javascript:Eposta()' class="buttonPage"> Gönder &nbsp;<i class="icon-arrow-right"></i></a></td>
      </TR>
     </FORM>
</table>
</body>
</html>
