<link rel="stylesheet" href="jquery/jquery-ui.theme.css">
<link rel="stylesheet" href="jquery/jquery-ui.css">
<link href="css/style.css" rel="stylesheet" type="text/css">
<script src="jquery/external/jquery/jquery.js"></script>
<script src="jquery/jquery-ui.min.js"></script>
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
    $("#dialog-eposta span").html('Lütfen geçerli bir e-posta adresi giriniz... </p><p> İsterseniz Facebook veya Google hesabınızla giriş yapabilirsiniz...');
	$( "#dialog-eposta" ).dialog({
		modal:true,
		position: {	my: "center",at: "center",of: sayfa},
		buttons:{Tamam: function () {
    $(this).dialog("close");
    }}
	});	
    });
return (false);       
}
if (document.forms.frmGiris.sifre.value=="" ) 
{ 
	$(function(){
    $("#dialog-eposta span").html(' Şifrenizi giriniz... </p><p>Şifrenizi bilmiyorsanız gönderilmesi için "Şifremi Unuttum" düğmesini tıklayınız.');
	$( "#dialog-eposta" ).dialog({
		modal:true,
		position: {	my: "center",at: "center",of: sayfa},
		buttons:{Tamam: function () {
    $(this).dialog("close");
    }}
	});	
    }); 
return (false); }
else { 
return true;}
} 
</script>
<div id="dialog-eposta" title="Uyarı" style="display:none" class="text_g" >
  <p><span>.....</span>
  </p>
</div>
<? 	
  if (!isset($_SESSION["verified_firmaid"]) || !isset($_SESSION["verified_sifrem"]))
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
<link href="css/style.css" rel="stylesheet" type="text/css">

<table class="text_s" width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#F6F6F6">
<FORM name="frmGiris" id="frmGiris" action="kontrol.php" method="post"  onsubmit="return Validate(this)">
<input type="hidden" id="yazi" name="yazi" >
  <tr>
    <td height="18" align="center" valign="middle" style="font-size: 14px; font-weight: normal;" >Üye Giriş</td>
  </tr>
  <tr>
    <td height="115"><table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td > e-posta </td>
        </tr>
        <tr>
          <td >
          <input width="130" type="text" name="email" id="email" placeholder="e-posta adresinizi giriniz" />
		  </td>
        </tr>
        <tr>
          <td >şifre</td>
        </tr>
        <tr>
          <td ><input width="130" type="password" name="sifre" id="sifre" placeholder="şifrenizi giriniz"/></td>
        </tr>
        <tr>
          <td height="28px" align="center" ><a href="#here" onClick='javascript:UyeGonder();' class="buttonPage">Giriş &nbsp;<i class="icon-arrow-right-p" style="color: #294590 ; font-size:10px";></i></a></td>  
		 <!-- <td height="30" class="aciklama"><a href="javascript:UyeGonder();"><img src="image/uyegiris.gif" width="147" height="16" class="ResimDugme"> </a> </td>//-->
          </tr>
        <tr>
          <td height="28" align="center" ><a href=#here onClick="location = 'forgetpass.php';" class="buttonPage">Şifremi Unuttum &nbsp;<i class="icon-arrow-right-p" style="color: #294590 ; font-size:10px";></i></a> 
		  </td>
        </tr>
        <tr>
          <td height="28" align="center" valign="middle" style="font-weight: normal; font-size: 14px;" ><strong><a href="kayit.php" class="buttonPage">YENİ ÜYE &nbsp;<i class="icon-arrow-right-p" style="color: #294590 ; font-size:10px";></i></a> 
		  </strong></td>
        </tr>
        <tr>
          <td height="8px" valign="bottom"> 
		  </td>
        </tr>
    </table></td>
  </tr>
</form>
</table>
<? } ?>