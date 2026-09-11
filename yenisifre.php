<?php include"headeri.php";?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="content-language" content="tr" />
<title>tekliftopla</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="jquery/jquery-ui.theme.css">
<link rel="stylesheet" href="jquery/jquery-ui.css">
<script src="jquery/external/jquery/jquery.js"></script>
<script src="jquery/jquery-ui.min.js"></script>
</head>

<body>

<script>
function Iptal(){
	window.location = "guncelleme.php";
}

function checkLength()
{
	if (document.forms.LoginForm.sifre1.value.length<6)
	{
  	  $(function(){
    $("#dialog-hata span").text('Yeni şifre 6 karekterden az, lütfen kontrol ediniz....');
	$("#dialog-hata" ).dialog({
		modal:true,
		position: {	my: "center",at: "center",of: sayfa},
		buttons:{Tamam: function () {
    $(this).dialog("close");
}}
	});	
  });
return (false);
}
return (true);
}

//*************************************************************************************************************
function checkPassword(field,fname) {
	var valid = "abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"
	var temp;
	for (var i=0; i<field.value.length; i++) 
	{
		temp = "" + field.value.substring(i, i+1);
		temp = valid.indexOf(temp);
		if (temp == "-1") 
			{
	  $(function(){
    $("#dialog-hata span").text('Yeni şifreniz hatalı gözüküyor. Lütfen [ ]  * + / ! ^ \" % & = ? ; : gibi özel karakterlerin bulunmadığından emin olunuz...');
	$("#dialog-hata" ).dialog({
		modal:true,
		position: {	my: "center",at: "center",of: sayfa},
		buttons:{Tamam: function () {
    $(this).dialog("close");
    }}
	});	
    });
	return false
	}
	}
	return true;
}
function checkLoginForm()
{
	if (!checkPassword(document.forms['LoginForm'].elements['sifre1'],"sifre1")) return false;
	if(!checkLength()) return false;
	if (document.forms['LoginForm'].elements['sifre1'].value!=document.forms['LoginForm'].elements['sifre2'].value) 
			{
		  	  $(function(){
    $("#dialog-hata span").text('Yeni Şifre ve Yeni Şifre Tekrar değerleri birbirinden farklı lütfen kontrol ediniz...');
	$("#dialog-hata" ).dialog({
		modal:true,
		position: {	my: "center",at: "center",of: sayfa},
		buttons:{Tamam: function () {
    $(this).dialog("close");
    }}
	});	
    });
	return false;
	}
	return true;
}
</script>
<div id="sayfa"> 
  <div id="ust"> <? include "ust.php"?> </div>
  <div id="bant1"></div>
  <div id="sol"><? include "menu.php";?></div>
  <div id="analong">
  <table width="97%" align="center" border="0" cellspacing="0" cellpadding="0">
      <tr><? $verified_firma = isset ($_SESSION["verified_firma"]) ? $_SESSION["verified_firma"] : ''?>
        <td><table align="center" width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td colspan="4" height="2" ></td>
            </tr>
            <tr bgcolor="white"  >
              <td height="27px" width="25%" ></td>
			  <td width="25%"></td>
			  <td width="43%" align="right" class="title">Şifre Değiştirme</td>
              <td width="7%" align="right" valign="middle" ><img src="image/sag_ok.gif"></td>
            </tr> 
            <tr><td height="10px"></td></tr>
        </table></td>
      </tr>
      <tr>
        <td bgcolor="#F6F6F6" ><? $verified_firma = isset ($_SESSION["verified_firma"]) ? $_SESSION["verified_firma"] : ''?>
          <span class="Baslik">Sayın <? echo $verified_firma;?>, eski şifrenizi kullanarak yeni şifre tanımlayabilirsiniz.</span><br>
          </td></tr>
          <tr><td>
          <table width="80%"  border="0" align="center" cellpadding="2" cellspacing="0">
            <form  method="post" name="LoginForm"  action="update.php?islem=sifredegis">
	        <input type="hidden" id="yazi" name="yazi" >
            <td  valign="center" colspan="2" class="not"><br>* Şifreniz en az 6 karakter olmalı<br></td>
            </tr>
            <tr>
              <td width="38%"  align="right" class="govde" > Eski Şifreniz    : </td>
              <td width="62%"  valign="center">
                <input  class="kutucuk" type="password" name="sifre">
              </td>
            </tr>
            <tr>
              <td align="right" class="govde" > Yeni Şifreniz    : </td>
              <td  valign="center">
                <input class="kutucuk" type="password" name="sifre1">
              </td>
            </tr>
            <tr>
              <td align="right" class="govde" > Yeni Şifre Tekrar    : </td>
              <td valign="center">
                <input class="kutucuk" type="password" name="sifre2">
              </td>
            </tr>
            <td  valign="center" colspan="2" class="not">&nbsp; </td>
            
			</form>
          
        </table>
		</td>
      </tr>
      <TR>
              <td colspan="2" align="center" class="aciklama" bgcolor="#FFFFFF" height="50" valign="middle"><a href="guncelleme.php" class="buttonPage"> İptal &nbsp;<i class="icon-close" ></i></a><img src= "image/trans.gif" alt="" width="25" height="1"><a href="#here" onClick="Gonder()" class="buttonPage"> Değiştir &nbsp;<i class="icon-arrow-right"></i></a></td>
            </TR>
    </table>
  </div> 
  <div id="bant1"></div> 
  <div id="alt">
  <? include "alt.php";?>
  </div>
</div>
<div id="dialog-hata" title="Uyarı" style="display:none" class="text_g" >
  <p>
    <span>Hata mesajları...</span>
  </p>
</div>

</BODY></HTML>
<script language="javascript">
function Gonder()
{
	if ( checkLoginForm())
	document.forms.LoginForm.submit();
}
</script>