<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Language" content="tr">
<link href="css/style.css" rel="stylesheet" type="text/css">
<meta HTTP-EQUIV="Pragma" CONTENT="no-cache">
<meta HTTP-EQUIV="expires" CONTENT="0">
<meta name="robots" content="noindex, follow">
<title>tekliftopla</title>

<script>
function Validate(LoginForm) { 
if (LoginForm.username.value =="") 
{ alert("Yönetici adını girmediniz..");
  return (false); 
} 
if (LoginForm.pass.value =="") 
{alert(" Yönetici  şifresini girmediniz... ");
  return (false); 
} 
return(true) 
} 
</SCRIPT>
<style type="text/css">
<!--
.style1 {color: #000000}
.style2 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
}
.style3 {font-size: 12px}
-->
</style>
</head>

<body bgcolor="white">
<FORM action="adminkontrol.php" method="post" name="LoginForm" onSubmit="return Validate(this)">
<input type="hidden" name="yazi" id="yazi" >
  <table width="372" border="1" align="center" bordercolor="#808080">
     <tr>
       <td colspan="2" align="center" bgcolor="#F6F6F6" ><span class="title">Yönetici Girişi</span></td>
     </tr>
     <tr>
       <td colspan="2" class="govde"bgcolor="#F6F6F6"><SPAN class=coolink><span class="style1">tekliftopla.</span><font color="#990000"><font color="Black">com</font></font></SPAN> yönetici giriş bölümüne hoş geldiniz.<br>
       Bu bölümü sadece sistem yöneticileri tarafından yetkilendirilmiş kullanıcılar kullanabilir.</td>
    </tr>
     <tr>
       <td width="131"bgcolor="EAEAEA" class="baslik_kalin style2">Yönetici Adı : </td>
       <td width="225" bgcolor="EAEAEA"><input  type="Text" maxlength=80 name="username" size=20 style="border: 1 solid #666666"><font color=#990000>*</font></td>
    </tr>
     <tr>
       <td bgcolor="EAEAEA" class="baslik_kalin style2 style3">Yönetici Şifresi : </td>
       <td bgcolor="EAEAEA"><input  type="Password" maxlength=50  name="pass" size=20 style="border: 1 solid #666666" >
       <font color=#990000>*</font></td>
     </tr>
     <tr>
       <td bgcolor="#F6F6F6">&nbsp;</td>
       <td bgcolor="#F6F6F6"><input name="submit"  type="submit" class="Dugme"  value="   GİRİŞ   "></td>
     </tr>
   </table>
</FORM>
</body>
</html>
