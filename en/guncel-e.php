<? include"headeri-e.php"?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>tekliftopla</title>
<link href="../css/style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="../jquery/jquery-ui.theme.css">
<link rel="stylesheet" href="../jquery/jquery-ui.css">
<script src="../jquery/external/jquery/jquery.js"></script>
<script src="../jquery/jquery-ui.min.js"></script>
<script type="text/javascript" src="emailChecknew-e.js">
</script>
<script type="text/javascript">
function ulkeSec(){
var obj = document.getElementById("Ulke");
if ( obj.options[obj.selectedIndex].text =="Turkey" ) 
   { document.getElementById("city").style.display="";}
   else { document.getElementById("city").style.display="none";} 
}
</script>
</head>
<body onLoad="ulkeSec()">
<?
$verified_firmaid = isset($_SESSION["verified_firmaid"]) ? $_SESSION["verified_firmaid"]: "";
$str="SELECT * FROM bilgi WHERE firmaid=$verified_firmaid";
$result=mysqli_query($connection,$str);
while ($rowFirma = mysqli_fetch_array($result))
{			 
?>
<div id="sayfa">
  <div id="ust">
    <? include "ust-e.php"?>
  </div>
  <div id="bant1"></div>
  <div id="sol">
    <? include "sol-e.php";?>
  </div>
  <div id="analong">
    <table width="97%" align="center" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td colspan="4" height="2" ></td>
            </tr>
            <tr bgcolor="white"  >
              <td height="27px" width="25%" ></td>
              <td width="25%"></td>
              <td width="43%" valign="middle" align="right" class="title">Update User</td>
              <td width="7%" valign="bottom" align="right" ><img src="../image/sag_ok.gif"></td>
            </tr>
          </table></td>
      </tr>
      <tr>
        <td><form id="frm" name="frm" action="update-e.php?islem=guncelbilgi" method="post" >
            <input type="hidden" name="yazi" id="yazi" >
            <input type="hidden" id="c1" name="c1" value="1">
            <input type="hidden" id="c2" name="c2" value="Firma">
            <span class="not"><strong>* Required fields. Update as needed.<br>
            <br>
            </strong></span>
            <TABLE width="95%"  border="0" align="center" cellpadding="5" cellspacing="0" >
              <TR style="display:none">
                <td colspan=2 align="left" class="aciklama" ><input type="radio" name="c11" value="1" checked onClick="TurDegistir()">
                  <span class="govde"> Teklif toplamak ve teklif isteyenlerden haberdar olmak istiyorum </span></td>
              </TR>
              <TR style="display:none">
                <td colspan=2 align="left" valign="top" height="30" ><input type="radio" name="c11" value="0" class="onay" onClick="TurDegistir()">
                  <span class="govde">Sadece teklif toplamak istiyorum </span></td>
              </TR>
              <TR style="display:none">
                <td colspan=2 align="left" class="aciklama" bgcolor="#F6F6F6"><input type="radio" name="c21" value="Firma" <? if ($rowFirma['Tur']=="Firma") echo "checked"; ?>  onClick="BaslikDegistir()">
                  <span class="govde">Firma adına kayıt olmak istiyorum</span></td>
              </TR>
              <TR style="display:none">
                <td colspan=2 align="left" valign="top" height="30" bgcolor="#F6F6F6"><input type="radio" name="c21" value="Kullanıcı" <? if ($rowFirma['Tur']=="Kullanıcı") echo "checked"; ?> class="onay" onClick="BaslikDegistir()">
                  <span class="govde">Şahıs adına kayıt olmak istiyorum </span></td>
              </TR>
              <TR>
                <td width="50%" align="right" class="govde" id="FKAd">User Name :</td>
                <td width="50%" class="aciklama"><INPUT  maxLength=80 id="Firma_Adi" name="Firma_Adi" size="25" style="border: 1 solid #666666" value="<? echo $rowFirma['Firma_Adi'];?>">
                  <FONT color=#990000 class="title"><strong>*</strong></FONT></td>
              </TR>
              <TR style="display:none">
                <td class="govde" align="right" i><label id="ilgili">İlgili Kişi  :</label></td>
                <td class="aciklama"><INPUT name="yetkili" style="border: 1 solid #666666" size=25  maxLength=50 value="<? echo $rowFirma['yetkili'];?>">
                  <FONT color=#990000 class="not">(Firmalar için)</FONT></td>
              </TR>
              <TR style="display:none">
                <td class="govde" align="right" id="FKAdres">Kullanıcı Adresi    :</td>
                <td class="aciklama"><INPUT name="Adres" style="border: 1 solid #666666" size="25"  value="<?php echo $rowFirma['Adres'];?>"></td>
              </TR>
              <TR style="display:none">
                <td class="govde" align="right">Posta Kodu    :</td>
                <td class="aciklama"><INPUT name="Posta_Kodu" style="border: 1 solid #666666" size=5 maxLength=5 value="<?echo $rowFirma['Posta_Kodu'];?>"></td>
              </TR>
              <TR>
                <td  class="govde" align="right">Country of Residence:</td>
                <td align="left" class="aciklama"><?
              $strc="select * from country order by ulke";
              $resultc=mysqli_query($connection,$strc);
              ?>
                  <select name="Ulke" style="width:130px" id="Ulke" onChange="ulkeSec()">
                    <? while ($row = mysqli_fetch_array($resultc))
                     {   $ulkex=$row['iso3'];
						 if($rowFirma['ulke']==$row['iso3'])
						 {
					 	 echo "<option value=$ulkex selected=selected>";
					     }
					     else 
					     {
						 echo "<option value=$ulkex>";
					     }
					 
					 echo $row['ulke'];}
                     echo"<br>";
					 ?>
                  </select>
                  <FONT color=#990000 class="title"> * </FONT></td>
              </TR>
              <TR id="city" style="display:none">
                <td  class="govde" align="right">City :</td>
                <td align="left" class="aciklama"><?
			$str="select * from sehir where sehirid < 999 order by sehir";
			$result=mysqli_query($connection,$str);
				?>
                  <select name="Sehir" id="Sehir" style="width:130px">
                    <OPTION SELECTED>Select
                    <? while ($row = mysqli_fetch_array($result))
                     {  $sehirx=$row['sehir'];
					    if ($rowFirma['Sehir']==$row['sehir'])
						{
					 	 echo "<option value=$sehirx selected=selected>";
					     }
					     else 
					     {
						 echo "<option value=$sehirx>";
					     }
					 
					 echo $row['sehir'];}
                     echo"<br>";?>
                  </select>
                  <FONT color=#990000 class="title"> * </FONT></td>
              </TR>
              <TR style="display:none">
                <td class="govde" align="right" id="FKTelefon">Kullanıcı Telefonu    :</td>
                <td valign="top" class="aciklama"><strong>
                  <?php
				//mysqli_query($query);
				$str1="select * from sehir where sehirid < 999 order by sehir";
				$result1=mysqli_query($connection,$str1);?>
                  <select name="tel_alankodu" style="width:130px"  >
                    <?php while ($row = mysqli_fetch_array($result1))
                     {
					if ($rowFirma['tel_alankodi']==$row['telkod'])
						echo "<option selected>";
					else
  					    echo "<option>";
					 echo $row['telkod'];
				                     echo"<br>";}?>
                  </select>
                  <INPUT maxLength=7 name="Telefon" size=7  style="border: 1 solid #666666" value="<? echo $rowFirma['Telefon'];?>">
                  <FONT color=#990000 class="title">*</FONT></strong></td>
              </TR>
              <TR style="display:none">
                <td class="govde" align="right" id="FKFax">Kullanıcı Faksı :</td>
                <td class="aciklama"><strong>
                  <?
				$str2="select * from sehir where sehirid < 999 order by sehir";
				$result2=mysqli_query($connection,$str2);
				?>
                  <select name="fax_alankodu" style="width:130px" >
                    <?php while ($row = mysqli_fetch_array($result2))
                     {
	 					if ($rowFirma['fax_alankodi']==$row['telkod'])
							echo "<option selected>";
						else
  					    	echo "<option>";
					 echo $row['telkod'];
					 echo"<br>";}?>
                  </select>
                  <INPUT  maxLength=7 name="Fax" size=7 style="border: 1 solid #666666" value="<? echo $rowFirma['Fax'];?>" >
                  </strong></td>
              </TR>
              <tr style="display:none">
                <td class="govde" align="right">Tercih Ettiğiniz Teklif Toplama Yöntemi    :</td>
                <td class="sss"><strong>
                  <select name="iletisim" >
                    <option <? if ($rowFirma['iletisim']=="Fax") echo " selected";?>  value="Faks">Faks</option>
                    <option <? if ($rowFirma['iletisim']=="Posta") echo " selected";?> value="Posta">Posta</option>
                    <option <? if ($rowFirma['iletisim']=="Telefon") echo " selected";?> >Telefon</option>
                    <option <? if ($rowFirma['iletisim']=="Ziyaret") echo " selected";?> >Ziyaret</option>
                    <option selected <? if ($rowFirma['iletisim']=="E-Posta") echo " selected";?> >E-Posta</option>
                  </select>
                  </strong></td>
              </tr>
              <tr style="display:none">
                <td class="govde" align="right">Yurt Dışına Teklif Vermek İstiyor musunuz?    :</td>
                <td class="aciklama"><strong>
                  <select name="lisan" >
                    <option <? if ($rowFirma['lisan']=="Evet") echo " selected";?> >Evet</option>
                    <option <? if ($rowFirma['lisan']=="Hayır") echo " selected";?> >Hayır</option>
                  </select>
                  </strong></td>
              </tr>
              <TR style="display:none">
                <td colspan=2 align="left" class="aciklama"><span class="not">Not: Şifrenizi alabilmek için lütfen geçerli bir e-posta adresi giriniz.</span></td>
              </TR>
              <TR>
                <td class="govde" align="right">E-mail Address :</td>
                <td class="govde"><? echo $rowFirma['email'];?>
                  <input type="hidden"  maxlength=50 name="email" id="email" size=25 style="border: 1 solid #666666" value="<? echo $rowFirma['email'];?>"></td>
              </TR>
              <TR style="display:none">
                <td class="govde" align="right">Web Adresi    :</td>
                <td class="aciklama"><INPUT name="Web" style="border: 1 solid #666666"  size=25  maxLength=50 value="<? echo $rowFirma['Web'];?>"></td>
              </TR>
              <tr>
                <td colspan="2" align="left"  class="aciklama" height="30" valign="middle"><input type="Checkbox" name="agreement" value="yes" checked>
                  <span class="govde"> <a href="#" onClick="YeniAc()" class="link">Terms of Use</a> accepted</span></td>
              </tr>
              <TR>
                <td colspan="2" align="center" height="50" valign="middle"><a href="#here"  onClick="Iptal()" class="buttonPage"> Cancel &nbsp;<i class="icon-close" ></i></a><img src= "../image/trans.gif" alt="" width="25px" height="1"><a href="#here" onClick="Gonder()" class="buttonPage"> Next &nbsp;<i class="icon-arrow-right"></i></a></td>
              </TR>
            </table>
          </form></td>
      </tr>
    </table>
  </div>
  <!-- analong -->
  <div id="bant1"></div>
  <!-- bant2 -->
  <div id="alt">
    <? include "alt-e.php";?>
  </div>
</div>
<div id="dialog-sifreunut" title="Warning" style="display:none" class="text_g" >
  <p> <span>Error mesajı...</span> </p>
</div>
</BODY>
</HTML>
<?php }?>
<script language="javascript">
function BaslikDegistir(){
	if (document.forms.frm.c21[1].checked )
	{
		document.forms.frm.c2.value	= "Kullanıcı";
		document.getElementById("FKAd").innerHTML = "User Name :";
		document.getElementById("FKAdres").innerHTML = "Kullanıcı Adresi    :";
		document.getElementById("FKTelefon").innerHTML = "Kullanıcı Telefonu    :";
		document.getElementById("FKFax").innerHTML = "Kullanıcı Faksı    :";
	}
	else
	{
		document.forms.frm.c2.value	= "Kullanıcı";
		document.getElementById("FKAd").innerHTML = "User Name :";
		document.getElementById("FKAdres").innerHTML = "Kullanıcı Adresi    :";
		document.getElementById("FKTelefon").innerHTML = "Kullanıcı Telefonu    :";
		document.getElementById("FKFax").innerHTML = "Kullanıcı Faksı    :";
	}
}
function TurDegistir(){
	if (document.forms.frm.c11[0].checked )
	{
		document.forms.frm.c1.value	= "1";
	}
	else
	{
		document.forms.frm.c1.value	= "0";
	}
}
function YeniAc(){
	window.open('sozlesme-e.htm','sozlesme','width=650,height=500,scrollbars=yes');
}
function Gonder(){
	document.forms.frm.email.value=document.forms.frm.email.value.replace(/^\s+|\s+$/g,"");
	if (Validate())
		document.forms.frm.submit();
}
function Iptal(){
	window.location = "guncelleme-e.php";
}
function Validate() { 
if (document.forms.frm.Firma_Adi.value =="") 
{ 
 	$(function(){
    $("#dialog-sifreunut span").text('User name missing...');
	$("#dialog-sifreunut" ).dialog({
	modal:true,
	position: {	my: "center",at: "center",of: sayfa},
	buttons:{OK: function () {
    $(this).dialog("close");
    }}
	});	
    });
	return (false); 
} 
if (document.forms.frm.Ulke.value=="Select" ) 
{ 
 	$(function(){
    $("#dialog-sifreunut span").text('Please select the country of residence...');
	$("#dialog-sifreunut" ).dialog({
	modal:true,
	position: {	my: "center",at: "center",of: sayfa},
	buttons:{OK: function () {
    $(this).dialog("close");
    }}
	});	
    });
	return (false); 
}
if (document.forms.frm.Ulke.value=="TUR" && document.forms.frm.Sehir.value=="Select" ) 
{ 
 	$(function(){
    $("#dialog-sifreunut span").text('Please select the city of your residence...');
	$("#dialog-sifreunut" ).dialog({
	modal:true,
	position: {	my: "center",at: "center",of: sayfa},
	buttons:{OK: function () {
    $(this).dialog("close");
    }}
	});	
    });
	return (false); 
} 
if (document.forms.frm.iletisim.value=="Telefon" &&  (document.forms.frm.Telefon.value=="" | document.forms.frm.Telefon.value=="0" ))
{ 
 	$(function(){
    $("#dialog-sifreunut span").text('Telephone number should be entered when "Telephone" is chosen as preferred communication method...');
	$("#dialog-sifreunut" ).dialog({
	modal:true,
	position: {	my: "center",at: "center",of: sayfa},
	buttons:{OK: function () {
    $(this).dialog("close");
    }}
	});	
    });
	return (false); 
} 
if (document.forms.frm.iletisim.value=="Faks" &&  (document.forms.frm.Fax.value=="" | document.forms.frm.Fax.value=="0" ))
{ 
 	$(function(){
    $("#dialog-sifreunut span").text('Fax number should be entered when "Fax" is chosen as preferred communication method...');
	$("#dialog-sifreunut" ).dialog({
	modal:true,
	position: {	my: "center",at: "center",of: sayfa},
	buttons:{OK: function () {
    $(this).dialog("close");
    }}
	});	
    });
	return (false); 
} 
if (document.forms.frm.iletisim.value=="Posta" &&  (document.forms.frm.Adres.value=="" ))
{ 
 	$(function(){
    $("#dialog-sifreunut span").text('Address should be entered when "Mail" is chosen as preferred communication method...');
	$("#dialog-sifreunut" ).dialog({
	modal:true,
	position: {	my: "center",at: "center",of: sayfa},
	buttons:{OK: function () {
    $(this).dialog("close");
    }}
	});	
    });
	return (false); 
} 
if (!checkEmail(document.forms.frm.email.value)) return (false);
if (document.forms.frm.agreement.checked == false)
    {
  	$(function(){
    $("#dialog-sifreunut span").text('To proceed "Terms of Use" should be accepted...');
	$("#dialog-sifreunut" ).dialog({
	modal:true,
	position: {	my: "center",at: "center",of: sayfa},
	buttons:{OK: function () {
    $(this).dialog("close");
    }}
	});	
    });
	return (false);
    }
return(true) 
} 
</script>