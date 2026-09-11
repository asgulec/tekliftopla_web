<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="content-language" content="tr" />
<title>tekliftopla</title>
<link href="../css/style.css" type="text/css" rel="stylesheet">
<link rel="stylesheet" href="../jquery/jquery-ui.theme.css">
<link rel="stylesheet" href="../jquery/jquery-ui.css">
<script src="../jquery/external/jquery/jquery.js"></script>
<script src="../jquery/jquery-ui.min.js"></script>
<script type="text/javascript" src="emailChecknew-e.js"></script>
</head>
<body>
<?php
$cevap =isset($_GET['sonuc']) ? $_GET['sonuc'] : '';
if ($cevap == 'tamam') {?>
<script language="javascript">
 $(function(){
    $( "#dialog-sifreok" ).dialog({
		close: function () {
        window.location.href = "index-e.php"
        },
		modal:true,
		position: {	my: "center",at: "center",of: sayfa},
		buttons:{OK: function () {
    $(this).dialog("close");
	}}
	});	
  });
</script>
<?php }
if ($cevap == 'epostayok') {?>
<script language="javascript">
$(function(){
    $( "#dialog-sifreno" ).dialog({
		close: function () {
        window.location.href = "forgetpass-e.php"
        },
		modal:true,
		position: {	my: "center",at: "center",of: sayfa},
		buttons:{OK: function () {
    $(this).dialog("close");
	}}
	});	
  });
</script>
<?php } ?>
<div id="sayfa">
  <div id="ust">
    <? include "ust-e.php"?>
  </div>
  <!-- ust -->
  <div id="bant1"></div>
  <!-- bant1 -->
  <div id="sol">
    <? include "sol-e.php";?>
  </div>
  <!-- sol -->
  <div id="analong">
    <table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td colspan="4" height="2" ></td>
      </tr>
      <tr bgcolor="white"  >
        <td height="64" width="191" ></td>
        <td width="160"></td>
        <td width="177" align="right" class="title">Password Recovery</td>
        <td width="27" ><img src="../image/sag_ok.gif" width="27" height="64"></td>
      </tr>
    </table>
    <table width="95%" cellspacing="10" cellpadding="0" align="center" border="0">
      <tbody>
        <tr>
          <td bgcolor="#F6F6F6" colspan="2" class="Baslik">Enter your e-mail address to receive your password. <br></td>
        </tr>
        <tr>
          <td colspan="2" height="10"></td>
        </tr>
      <FORM name="LoginForm" id="LoginForm" action="emailunut-e.php" method="post" >
        <input type="hidden" name="yazi" id="yazi" >
        <TR>
          <td class="govde" align="right" >E-mail address: </td>
          <td><input type="text" id="semail" name="semail" size=20 style="border: 1 solid #666666" width="200" >
            <FONT color=#990000>*</FONT></td>
        </TR>
        <TR>
          <td colspan="2" align="center" height="50px"><a href='javascript:Eposta()' class="buttonPage"> Send &nbsp;<i class="icon-arrow-right"></i></a></td>
        </TR>
      </FORM>
      <tr>
        <td colspan="2" height="10"></td>
      </tr>
      <tr>
        <td colspan="2" class="Baslik"></td>
      </tr>
        </tbody>
      
    </table>
  </div>
  <!-- ana -->
  <div id="bant1"></div>
  <!-- bant2 -->
  <div id="alt">
    <? include "alt-e.php";?>
  </div>
  <!-- alt --> 
</div>
<!-- sayfa -->
<div id="dialog-sifreok" title="Confirmation" style="display:none" class="text_g" >
  <p> Your password is sent to your e-mail address. </p>
  <p>Please check your spam and junk folders. </p>
</div>
<div id="dialog-sifreno" title="Warning" style="display:none" class="text_g" >
  <p> This e-mail is not a user of our system. </p>
  <p>You can easily become a user by clicking one of the;<br>
    <br>
    "NEW USER", <br>
    "Sign in with Google" or <br>
    "Sign in with Facebook" <br>
    <br>
    buttons. </p>
</div>
<div id="dialog-sifreunut" title="Warning" style="display:none" class="text_g" >
  <p> <span>...</span> </p>
</div>
<script type="text/javascript">
function Eposta()
{ 
var semail=document.forms.LoginForm.semail.value;
// semail=semail.trim();
if (!checkEmail(semail)===false)
    {document.forms.LoginForm.submit();}
}
</SCRIPT>
</body>
</html>
