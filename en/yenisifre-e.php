<?php include"headeri-e.php"; ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="content-language" content="us" />
<title>tekliftopla</title>
<link href="../css/style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="../jquery/jquery-ui.theme.css">
<link rel="stylesheet" href="../jquery/jquery-ui.css">
<script src="../jquery/external/jquery/jquery.js"></script>
<script src="../jquery/jquery-ui.min.js"></script>
</head>
<body>
<script>
function Gonder()
{
	if ( checkLoginForm())
	document.forms.LoginForm.submit();
}
function Iptal(){
	window.location = "guncelleme-e.php";
}
function checkLength()
{
	if (document.forms.LoginForm.sifre1.value.length<6)
	{
  	$(function(){
    $("#dialog-hata span").text('New password should be minimum 6 characters long....');
	$("#dialog-hata" ).dialog({
		modal:true,
		position: {	my: "center",at: "center",of: sayfa},
		buttons:{OK: function () {
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
             $("#dialog-hata span").text('Please do not use [ ]  * + / ! ^ \" % & = ? ; : or similar speacial characters in your password....');
	         $("#dialog-hata" ).dialog({
		     modal:true,
			 position: {	my: "center",at: "center",of: sayfa},
		     buttons:{OK: function () {
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
    		 $("#dialog-hata span").text('New password and confirmation input do not match, please check....');
			 $("#dialog-hata" ).dialog({
		     modal:true,
			 position: {	my: "center",at: "center",of: sayfa},
		     buttons:{OK: function () {
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
  <div id="ust">
    <? include "ust-e.php"?>
  </div>
  <div id="bant1"></div>
  <div id="sol">
    <? include "menu-e.php";?>
  </div>
  <div id="analong">
    <table align="center" width="97%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <? $verified_firma = isset ($_SESSION["verified_firma"]) ? $_SESSION["verified_firma"] : ''?>
        <td><table width="100%" align="center" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td colspan="4" height="2" ></td>
            </tr>
            <tr>
              <td height="27px" width="25%" ></td>
              <td width="25%"></td>
              <td width="43%" align="right" class="title">Change Password</td>
              <td width="7%" align="right" valign="bottom" ><img src="../image/sag_ok.gif"></td>
            </tr>
            <tr>
              <td height="10px"></td>
            </tr>
          </table></td>
      </tr>
      <tr>
        <td bgcolor="#F6F6F6"><span class="Baslik">All fields are required to change password. <br>
          Password should be minimum 6 characters long.</span></td>
      </tr>
      <tr>
        <td><TABLE width="95%"  border="0" align="center" cellpadding="2" cellspacing="0">
            <tr>
              <td colspan="2" height="10px"></td>
            </tr>
              <form  method="post" name="LoginForm"  action="update-e.php?islem=sifredegis">
            
            <input type="hidden" id="yazi" name="yazi" >
            <tr>
              <td width="38%"  align="right" class="govde" > Old password : </td>
              <td width="62%"  valign="center"><input  class="kutucuk" type="password" name="sifre"></td>
            </tr>
            <tr>
              <td align="right" class="govde" > New password : </td>
              <td  valign="center"><input class="kutucuk" type="password" name="sifre1"></td>
            </tr>
            <tr>
              <td align="right" class="govde" > Confirm new password : </td>
              <td valign="center"><input class="kutucuk" type="password" name="sifre2"></td>
            </tr>
            
              <td  valign="center" colspan="2" class="not"></td>
            <TR>
              <td colspan="2" align="center" class="aciklama" height="50" valign="middle"><a href="#here" onClick="Iptal()" class="buttonPage"> Cancel &nbsp;<i class="icon-close" ></i></a><img src= "../image/trans.gif" alt="" width="25" height="1"><a href="#here" onClick="Gonder()" class="buttonPage"> Change Password&nbsp;<i class="icon-arrow-right"></i></a></td>
            </TR>
              </form>
            
          </table></td>
      </tr>
    </table>
  </div>
  <div id="bant1"></div>
  <div id="alt">
    <? include "alt-e.php";?>
  </div>
</div>
<div id="dialog-hata" title="Warning" style="display:none" class="text_g" >
  <p> <span>Error mesajı...</span> </p>
</div>
</BODY>
</HTML>
