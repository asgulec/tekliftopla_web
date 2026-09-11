<link rel="stylesheet" href="../jquery/jquery-ui.theme.css">
<link rel="stylesheet" href="../jquery/jquery-ui.css">
<link href="../css/style.css" rel="stylesheet" type="text/css">
<script src="../jquery/external/jquery/jquery.js"></script>
<script src="../jquery/jquery-ui.min.js"></script>
<script type="text/javascript">
function UyeGonder() 
{
  if (Validate (document.forms.frmGiris) ) document.forms.frmGiris.submit();
}
function Validate (){ 
var str =document.forms.frmGiris.email.value;
str=str.trim();
document.getElementById('email').value = str;
var filter=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
if (!filter.test(str))
{ 
 	$(function(){
    $("#dialog-error span").html('Please input a valid e-mail address... </p><p>You can also log-in with your Facebook or Google accounts... ');
	$("#dialog-error" ).dialog({
		position: {	my: "center",at: "center",of: sayfa},
		modal:true,
		buttons:{OK: function () {
    $(this).dialog("close");
    }}
	});	
    });	
	
return (false); }
if (document.forms.frmGiris.sifre.value=="" ) 
{ 
	$(function(){
    $("#dialog-error span").html(' Enter your password. </p><p>Click "Forgot Password" to receive your password...');
	$("#dialog-error" ).dialog({
		modal:true,
		position: {	my: "center",at: "center",of: sayfa},
		buttons:{OK: function () {
    $(this).dialog("close");
    }}
	});	
    });
	
return (false); }
else { 
return true;} 
} 
</script>
<div id="dialog-error" title="Warning" style="display:none" class="text_g" >
  <p> <span>...</span> </p>
</div>
<? 	
	if (! isset($_SESSION["verified_firmaid"]))
	{
?>
<style type="text/css">
<!--
.style1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 14px;
}
-->
</style>
<link href="../css/style.css" rel="stylesheet" type="text/css">
<table class="text_s" width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#F6F6F6">
  <FORM name="frmGiris" id="frmGiris" action="kontrol-e.php" method="post"  onsubmit="return Validate(this)">
    <input type="hidden" id="yazi" name="yazi" >
    <tr>
      <td height="18" align="center" valign="middle" style="font-size: 14px; font-weight: normal;" >User Log In</td>
    </tr>
    <tr>
      <td height="115"><table width="85%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td > e-mail </td>
          </tr>
          <tr>
            <td ><input width="140" type="text" name="email" id="email"/></td>
          </tr>
          <tr>
            <td>Password</td>
          </tr>
          <tr>
            <td ><input width="140" type="password" name="sifre" id="sifre"/></td>
          </tr>
          
            <td height="28px" align="center" ><a href="#here" onClick='javascript:UyeGonder();' class="buttonPage">Enter &nbsp;<i class="icon-arrow-right-p" style="color: #294590 ; font-size:10px";></i></a></td>
          </tr>
          <tr>
            <td height="28" align="center" ><a href=#here onClick="location = 'forgetpass-e.php';" class="buttonPage">Forgot password &nbsp;<i class="icon-arrow-right-p" style="color: #294590 ; font-size:10px";></i></a></td>
          <tr>
            <td height="28" align="center" valign="middle" style="font-weight: normal; font-size: 14px;" ><strong><a href="kayit-e.php" class="buttonPage">NEW USER &nbsp;<i class="icon-arrow-right-p" style="color: #294590 ; font-size:10px";></i></a> </strong></td>
          </tr>
          <tr>
            <td height="8px" valign="bottom"></td>
          </tr>
        </table></td>
    </tr>
  </form>
</table>
<? } ?>
