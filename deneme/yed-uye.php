
<script type="text/javascript">
function UyeGonder() 
 {
  if (Validate (document.forms.frmGiris) ) document.forms.frmGiris.submit();
 }
function Validate ()

/* function UyeGonder() 
 {
  frmGiris.submit();
 }
function Validate(frmGiris) 
*/
{ 
if (document.forms.frmGiris.email.value=="") 
{ 
 	document.getElementById("yazi").value = " E-posta adresini giriniz. ";
	window.open('dikkat.html',"win1","width=400, height=200,menubar=0,resizable=0,scrollbars=0,status=0,titlebar=0,toolbar=0,left="+(screen.width-400)/2+",top="+(screen.height-200)/2);
/*	frmGiris.email.focus(); */ 
	return (false); 
}
var emailstr =document.forms.frmGiris.email.value;
var i =  emailstr.indexOf("@");
if (i<0) 
{ 
 	document.getElementById("yazi").value = " E-posta adresinde @isaretini unuttunuz. ";
	window.open('dikkat.html',"win1","width=400, height=200,menubar=0,resizable=0,scrollbars=0,status=0,titlebar=0,toolbar=0,left="+(screen.width-400)/2+",top="+(screen.height-200)/2);
/*	frmGiris.email.focus(); */ 
	return (false); 
}

if (document.forms.frmGiris.sifre.value=="" ) 
{ 
	document.getElementById("yazi").value = " Sifrenizi giriniz. ";
	window.open('dikkat.html',"win1","width=400, height=200,menubar=0,resizable=0,scrollbars=0,status=0,titlebar=0,toolbar=0,left="+(screen.width-400)/2+",top="+(screen.height-200)/2);
/*	frmGiris.sifre.focus(); */ 
	return (false); 
} 
return(true) 
} 
</script>
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
<link href="css/style.css" rel="stylesheet" type="text/css">

<table class="text_s" width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#F6F6F6">
<FORM name="frmGiris" id="frmGiris" action="kontrol.php" method="post"  onsubmit="return Validate(this)">
<input type="hidden" id="yazi" name="yazi" >
  <tr>
    <td height="18" align="center" valign="middle" style="font-size: 14px; font-weight: normal;" >Üye Giriş</td>
  </tr>
  <tr>
    <td height="115"><table width="85%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td > e-posta </td>
        </tr>
        <tr>
          <td >
          <input width="140" type="text" name="email" id="email" placeholder="e-posta adresinizi giriniz" />
		  </td>
        </tr>
        <tr>
          <td >şifre</td>
        </tr>
        <tr>
          <td ><input width="140" type="password" name="sifre" id="sifre" placeholder="şifrenizi giriniz"/></td>
        </tr>
        <tr>
          <td height="28px" align="center" ><a href="#here" onClick='javascript:UyeGonder();' class="buttonPage">Giriş &nbsp;<i class="icon-arrow-right-p" style="color: #294590 ; font-size:10px";></i></a></td>  
		 <!-- <td height="30" class="aciklama"><a href="javascript:UyeGonder();"><img src="image/uyegiris.gif" width="147" height="16" class="ResimDugme"> </a> </td>//-->
          </tr>
        <tr>
          <td height="28" align="center" ><a href=#here onClick='javascript:window.open("forgetpass.php","sifrem","resizable=no,width=450,height=350");' class="buttonPage">Şifremi Unuttum &nbsp;<i class="icon-arrow-right-p" style="color: #294590 ; font-size:10px";></i></a> 
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
