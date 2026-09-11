<?php include"headeri.php"?>
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
<?php $kaynak = mysqli_real_escape_string($connection,$_GET["bilgi"]); ?>
<body>
<div id="sayfa">
  <div id="ust">
    <?php include "ust.php" ?>
  </div>
  <div id="bant1"></div>
  <div id="sol">
    <?php include "menu.php" ?>
  </div>
  <div id="analong">
    <table width="97%px" align="center"  cellspacing="0" cellpadding="0" border="0" bgColor=white >
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td colspan="4" height="2" bgcolor="#FFFFFF"></td>
            </tr>
            <tr height="25px">
              <td width="25%"></td>
              <td width="25%" ></td>
              <td valign="middle" width="43%" align="right" class="title">Bilgi Ekleme</td>
              <td valign="bottom" align="right" width="7%" ><img src="image/sag_ok.gif"></td>
            </tr>
          </table></td>
      </tr>
      <tr>
        <td height="10px"></td>
      </tr>
      <tr>
        <td width="97%" valign="top" bgcolor="#F6F6F6"><? $verified_firma = isset($_SESSION["verified_firma"]) ? $_SESSION["verified_firma"] : '';?>
          <span class="Baslik" > Lütfen kayıtlı bilgileriniz arasında bulunmayan eksik bilgiyi giriniz.</span></td>
      </tr>
      <tr>
        <td height="10px" ></td>
      </tr>
      <tr id="fax" style="display:none">
        <td>
      <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
        <FORM action="bilgiguncelle.php" method="post" name="frmFax" onsubmit="return Validate(this)">
		<input type="hidden" name="yazi" id="yazi" >
        <tr>
              <td class="govde" align="right" id="FKTelefon">Faks:</td>
              <td valign="top" class="aciklama"><strong>
                <?
         /*$connection=mysql_connect("$host","$user","$password") or die ("Could not connect to the MySQL Server");
         $query="SET NAMES 'UTF8'";
         mysql_query($query);*/
         $str1="select * from sehir order by sehir";
         $result1=mysqli_query($connection,$str1);?>
                <select name="fax_alankodu"   >
                  <? while ($row = mysqli_fetch_array($result1))
              {
			   echo "<option>";
			   echo $row['telkod'];
			   echo"<br>";}?>
                  </select>
                <INPUT maxLength=7 name="Fax" size=7  style="border: 1 solid #666666">
                <input type="hidden" name="tur" value="f">
                <FONT color=#990000 class="title">*</FONT></strong></td>
              </tr>
            <tr>
                <td height="50"colspan="2"  align="center" valign="middle"><a href="kullanim.php" class="buttonPage"> İptal &nbsp;<i class="icon-close" ></i></a><img src= "image/trans.gif" alt="" width="25" height="1"><a href="#here" onClick="Gonderf()" class="buttonPage"> İlerle &nbsp;<i class="icon-arrow-right"></i></a></td>
              </tr>
            </FORM>
          </table>
      </td></tr>
      <tr id="tel" style="display:none" ><td>
      <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
      <FORM action="bilgiguncelle.php" method=post name="frmTel" onsubmit="return Validate(this)">
	  <input type="hidden" name="yazi" id="yazi" >
      <tr>
          <td class="govde" align="right" id="FKTelefon">Telefon:</td>
          <td valign="top" class="aciklama"><strong>
         <?
       /*$connection=mysql_connect("$host","$user","$password") or die ("Could not connect to the MySQL Server");
       $query="SET NAMES 'UTF8'";
       mysql_query($query);*/
       $str1="select * from sehir order by sehir";
       $result1=mysqli_query($connection,$str1);?>
       <select name="tel_alankodu"   >
         <? while ($row = mysqli_fetch_array($result1))
           {
		   echo "<option>";
		   echo $row['telkod'];
		   echo"<br>";}?>
        </select>
        <INPUT maxLength=7 name="Telefon" size=7  style="border: 1 solid #666666">
		<input type="hidden" name="tur" value="t">
        <FONT color=#990000 class="title">*</FONT></strong></td>
        </tr>
        <tr>
        <td height="50"colspan="2"  align="center" valign="middle"><a href="kullanim.php" class="buttonPage"> İptal &nbsp;<i class="icon-close" ></i></a><img src= "image/trans.gif" alt="" width="25" height="1"><a href="#here" onClick="Gondert()" class="buttonPage"> İlerle &nbsp;<i class="icon-arrow-right"></i></a></td>
         </tr>
        </FORM>
        </table>
      </td></tr>
      
      <tr id="posta" style="display:none" ><td>
      <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
      <FORM action="bilgiguncelle.php" method=post name="frmPosta" onsubmit="return Validate(this)">
	  <input type="hidden" name="yazi" id="yazi" >
      <tr >
            <td class="govde" align="right" id="FKTelefon">Adres:</td>
            <td valign="top" class="aciklama"><strong>
              <INPUT maxLength=200 name="Adres" size=40  style="border: 1 solid #666666">
              <strong><FONT color=#990000 class="title">*</FONT></strong><input type="hidden" name="tur" value="p">
            </strong></td>
          </TR>
        <tr>
        <td height="50"colspan="2"  align="center" valign="middle"><a href="kullanim.php" class="buttonPage"> İptal &nbsp;<i class="icon-close" ></i></a><img src= "image/trans.gif" alt="" width="25" height="1"><a href="#here" onClick="Gonderp()" class="buttonPage"> İlerle &nbsp;<i class="icon-arrow-right"></i></a></td>
         </tr>
        </FORM>
        </table>
  
      </td></tr> 
      </table>
  </div>
  <div id="bant1"></div>
  <div id="alt">
    <?php include "alt.php" ?>
  </div>
</div>
<div id="dialog-hata" title="Uyarı" style="display:none" class="text_g" >
  <p>
    <span>Hata mesajları...</span>
  </p>
</div>

</BODY>
</HTML>
<?php
if ($kaynak=="f") {
    
	?><script type = "text/javascript">
	document.getElementById("fax").style.display = '';
    </script> <?php
    }
if ($kaynak=="t") {
	?><script type = "text/javascript">
	document.getElementById("tel").style.display = '';
    </script> <?php
	}
if ($kaynak=="p") {
	?><script type = "text/javascript">
	document.getElementById("posta").style.display = '';
    </script> <?php
	} else {
		header("location:kullanim.php");
    }
?>

<script language="javascript">
function Gonderf() {
	if (Kontrolf())
		document.forms.frmFax.submit();
}  
function Kontrolf() {
	if (document.forms.frmFax.Fax.value=="" ) 
{ $(function(){
    $("#dialog-hata span").text('Faks numaranızı giriniz...');
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
return true;
}
function Gondert() {
	if (Kontrolt())
		document.forms.frmTel.submit();
}  
function Kontrolt() {
	if (document.forms.frmTel.Telefon.value=="" ) 
{ $(function(){
    $("#dialog-hata span").text('Telefon numaranızı giriniz...');
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
return true;
}
function Gonderp() {
	if (Kontrolp())
		document.forms.frmPosta.submit();
}  
function Kontrolp() {
	if (document.forms.frmPosta.Adres.value=="" ) 
{ $(function(){
    $("#dialog-hata span").text('Adresinizi giriniz...');
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
return true;
}

</script>
