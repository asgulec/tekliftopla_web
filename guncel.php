<?php include"headeri.php" ?>
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
<script type="text/javascript" src="emailChecknew.js">
</script>
</head>

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
<table width="97%" align="center"  cellspacing="0" cellpadding="0" border="0" bgColor=white >
<tr>
  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td colspan="4" height="2" bgcolor="#FFFFFF"></td>
      </tr>
      <tr height="27px">
        <td width="25%" align="left" valign="top"><img src="image/5/5_1%20copy.gif"></td>
        <td width="25%" ></td>
        <td valign="middle" width="43%" align="right" class="title"><p>Güncelleme<br>
          <span class="title_kucuk">Üye Bilgileri</span></p></td>
        <td valign="bottom" align="right" width="7%" ><img src="image/sag_ok.gif"></td>
      </tr>
    </table></td>
</tr>
<tr>
  <td height="10px"></td>
</tr>

<?
$verified_firmaid = isset($_SESSION["verified_firmaid"]) ? $_SESSION["verified_firmaid"]: "";
$str="SELECT * FROM bilgi WHERE firmaid=$verified_firmaid";
$result=mysqli_query($connection,$str);
while ($rowFirma = mysqli_fetch_array($result))
{			 
?>
      <tr>
        <td>
 	    <form id="frm" name="frm" action="update.php?islem=guncelbilgi" method="post" >      
		<input type="hidden" name="yazi" id="yazi" >
        <input type="hidden" id="c1" name="c1" value="1">
        <input type="hidden" id="c2" name="c2" value="Firma">
        <span class="not">* Girilmesi Zorunlu Bilgiler</span>
        <TABLE width="95%"  border="0" align="center" cellpadding="1" cellspacing="0">
            <TR>
              <td bgcolor="#EAEAEA" colspan=2 align="left">
                  <input type="radio" name="c11" value="1" checked onClick="TurDegistir()">
                  <span class="govde"> Teklif toplamak ve teklif isteyenlerden haberdar olmak istiyorum </span></td>
            </TR>
            <TR>
              <td bgcolor="#EAEAEA" colspan=2 align="left" valign="top" height="30" >
                  <input type="radio" name="c11" value="0" class="onay" onClick="TurDegistir()">
                  <span class="govde"> Sadece teklif toplamak istiyorum </span></td>
            </TR>
              <TR>
                <td colspan=2 align="left" bgcolor="#F6F6F6">
                  <input type="radio" name="c21" value="Firma" <? if ($rowFirma['Tur']=="Firma") echo "checked"; ?>  onClick="BaslikDegistir()">
                  <span class="govde">Firma adına kayıt olmak istiyorum</span></td>
              </TR>
              <TR>
                <td colspan=2 align="left" valign="top" height="30" bgcolor="#F6F6F6">
                  <input type="radio" name="c21" value="Kullanıcı" <? if ($rowFirma['Tur']=="Kullanıcı") echo "checked"; ?> class="onay" onClick="BaslikDegistir()"> 
                  <span class="govde">Şahıs adına kayıt olmak istiyorum </span></td>
              </TR>
            <TR>
              <td width="50%" align="right" class="govde" id="FKAd">Kullanıcı Adı    :</td>
              <td width="50%" >
                 <INPUT  maxLength=80 id="Firma_Adi" name="Firma_Adi" size="25" style="border: 1 solid #666666" value="<?php echo htmlspecialchars($rowFirma['Firma_Adi'], ENT_QUOTES, 'UTF-8');?>">
                <FONT class="title"><strong>*</strong></FONT></td>
            </TR>
            <TR>
              <td class="govde" align="right" i><label id="ilgili">İlgili Kişi  :</label></td>
              <td><INPUT name="yetkili" style="border: 1 solid #666666" size=25  maxLength=50 value="<?php echo htmlspecialchars($rowFirma['yetkili'], ENT_QUOTES, 'UTF-8');?>"> 
                <FONT class="not">(Firmalar)</FONT></td>
            </TR>
            <TR>
              <td class="govde" align="right" id="FKAdres">Kullanıcı Adresi    :</td>
              <td><INPUT name="Adres" style="border: 1 solid #666666" size="25"  value="<?php echo htmlspecialchars($rowFirma['Adres'], ENT_QUOTES, 'UTF-8');?>"></td>
            </TR>
            <TR>
              <td class="govde" align="right">Posta Kodu    :</td>
              <td><INPUT name="Posta_Kodu" style="border: 1 solid #666666" size=5 maxLength=5 value="<?php echo htmlspecialchars($rowFirma['Posta_Kodu'], ENT_QUOTES, 'UTF-8');?>"> </td>
            </TR>
            <TR>
              <td  class="govde" align="right">Şehir :</td>
              <td align="left">
			  <?
			$str="select * from sehir where sehirid < 999 order by sehir";
			$result=mysqli_query($connection,$str);
				?>
                  <select name="Sehir" style="width:130px">
                    <?php while ($row = mysqli_fetch_array($result))
                     {
					if ($rowFirma['Sehir']==$row['sehir'])
						echo "<option selected>";
					else
  					    echo "<option>";
           echo htmlspecialchars($row['sehir'], ENT_QUOTES, 'UTF-8');
					  echo "</option>";
                     echo"<br>";}?>
                  </select>
              </td>
            </TR>
            <TR>
              <td class="govde" align="right" id="FKTelefon">Kullanıcı Telefonu :</td>
              <td valign="top"><strong>
                <?
				$str1="select * from sehir where sehirid < 999 order by sehir";
				$result1=mysqli_query($connection,$str1);?>
                <select name="tel_alankodu" style="width:130px"  >
                  <?php while ($row = mysqli_fetch_array($result1))
                     {
					if ($rowFirma['tel_alankodi']==$row['telkod'])
						echo "<option selected>";
					else
  					    echo "<option>";
           echo htmlspecialchars($row['telkod'], ENT_QUOTES, 'UTF-8');
				                     echo"<br>";}?>
                </select>
                <INPUT maxLength=7 name="Telefon" size=7  style="border: 1 solid #666666" value="<?php echo htmlspecialchars($rowFirma['Telefon'], ENT_QUOTES, 'UTF-8');?>">
              </strong></td>
            </TR>
            <TR>
              <td class="govde" align="right" id="FKFax">Kullanıcı Faksı :</td>
              <td><strong>
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
           echo htmlspecialchars($row['telkod'], ENT_QUOTES, 'UTF-8');
					 echo"<br>";}?>
                </select>
                <INPUT  maxLength=7 name="Fax" size=7 style="border: 1 solid #666666" value="<?php echo htmlspecialchars($rowFirma['Fax'], ENT_QUOTES, 'UTF-8');?>">
              </strong></td>
            </TR>
            <tr>
              <td class="govde" align="right">Tercih Ettiğiniz Teklif Toplama Yöntemi :</td>
              <td><strong>
                <select name="iletisim" >
                  <option <? if ($rowFirma['iletisim']=="Fax") echo " selected";?>  value="Faks">Faks</option>
                  <option <? if ($rowFirma['iletisim']=="Posta") echo " selected";?> value="Posta">Posta</option>
                  <option <? if ($rowFirma['iletisim']=="Telefon") echo " selected";?> >Telefon</option>
                  <option <? if ($rowFirma['iletisim']=="Ziyaret") echo " selected";?> >Ziyaret</option>
                  <option selected <? if ($rowFirma['iletisim']=="E-Posta") echo " selected";?> >E-Posta</option>
                </select>
              </strong></td>
            </tr>
            <tr>
              <td class="govde" align="right">Yurt Dışına Teklif Vermek İstiyor musunuz?    :</td>
              <td><strong>
                <select name="lisan" >
                  <option <? if ($rowFirma['lisan']=="Evet") echo " selected";?> >Evet</option>
                  <option <? if ($rowFirma['lisan']=="Hayır") echo " selected";?> >Hayır</option>
                </select>
              </strong></td>
            </tr>
            <TR>
              <td class="govde" align="right">Web Adresi :</td>
              <td><INPUT name="Web" style="border: 1 solid #666666"  size=25  maxLength=50 value="<?php echo htmlspecialchars($rowFirma['Web'], ENT_QUOTES, 'UTF-8');?>"></td>
            </TR>
            <TR>
              <td class="govde" align="right">E-Posta Adresi :</td>
              <td class="govde"><?php echo htmlspecialchars($rowFirma['email'], ENT_QUOTES, 'UTF-8');?>
                <input type="hidden" maxlength=50 name="email" id="email" size=25 style="border: 1 solid #666666" value="<?php echo htmlspecialchars($rowFirma['email'], ENT_QUOTES, 'UTF-8');?>"></td>
            </TR>
            
            <tr>
              <td colspan="2" align="left" height="30" valign="middle">
				<input type="Checkbox" name="agreement" value="yes" checked>
                <span class="govde"> <a href="#" onClick="YeniAc()" class="link">Kullanıcı Sözleşmesini</a> Kabul Ediyorum</span></td>
            </tr>
            <TR>
              <td colspan="2" align="center" height="50" valign="middle"><a href="#here"  onClick="Iptal()" class="buttonPage"> İptal &nbsp;<i class="icon-close" ></i></a><img src= "image/trans.gif" alt="" width="25" height="1"><a href="#here" onClick="Gonder()" class="buttonPage"> İlerle &nbsp;<i class="icon-arrow-right"></i></a></td>
            </TR>
        </table>
		</form>		</td>
      </tr>
    </table>
    </div>
<div id="bant1"></div>
<div id="alt">
  <?php include "alt.php" ?>
</div>
</div>    

<div id="dialog-sifreunut" title="Uyarı" style="display:none" class="text_g" >
  <p>
    <span>Hata mesajları...</span>
  </p>
</div>

</BODY></HTML>
<?php } ?>

<script language="javascript">

function BaslikDegistir(){
	if (document.forms.frm.c21[1].checked )
	{
		document.forms.frm.c2.value	= "Kullanıcı";
		document.getElementById("FKAd").innerHTML = "Kullanıcı Adı    :";
		document.getElementById("FKAdres").innerHTML = "Kullanıcı Adresi    :";
		document.getElementById("FKTelefon").innerHTML = "Kullanıcı Telefonu    :";
		document.getElementById("FKFax").innerHTML = "Kullanıcı Faksı    :";
	}
	else
	{
		document.forms.frm.c2.value	= "Kullanıcı";
		document.getElementById("FKAd").innerHTML = "Kullanıcı Adı    :";
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
	window.open("sozlesme.htm","Sözleşme Metni","resizable=no,width=650,height=350");
}
TurDegistir();
BaslikDegistir();

function Gonder(){
	if (Validate())
		document.forms.frm.submit();
}

function Iptal(){
	window.location = "guncelleme.php";
}
function Validate() { 
if (document.forms.frm.Firma_Adi.value =="") 
{ 
 	$(function(){
    $("#dialog-sifreunut span").text('Kullanıcı adı giriniz...');
	$("#dialog-sifreunut" ).dialog({
		modal:true,
		position: {	my: "center",at: "center",of: sayfa},
		buttons:{Tamam: function () {
    $(this).dialog("close");
    }}
	});	
    });
return false; 
} 
if (document.forms.frm.iletisim.value=="Telefon" &&  (document.forms.frm.Telefon.value=="" | document.forms.frm.Telefon.value=="0" ))
{ $(function(){
    $("#dialog-sifreunut span").text('Teklif toplama yöntemi "Telefon" seçildiği zaman telefon bilgisini girmelisiniz...');
	$("#dialog-sifreunut" ).dialog({
		modal:true,
		position: {	my: "center",at: "center",of: sayfa},
		buttons:{Tamam: function () {
    $(this).dialog("close");
}}
	});	
  });
       
return false;	   
} 

if (document.forms.frm.iletisim.value=="Faks" &&  (document.forms.frm.Fax.value=="" | document.forms.frm.Fax.value=="0" ))
{ 
    $(function(){
    $("#dialog-sifreunut span").text('Teklif toplama yöntemi "Faks" seçildiği zaman faks bilgisini girmelisiniz...');
	$("#dialog-sifreunut" ).dialog({
		modal:true,
		position: {	my: "center",at: "center",of: sayfa},
		buttons:{Tamam: function () {
    $(this).dialog("close");
    }}
	});	
    });
return (false); 
} 
if (document.forms.frm.iletisim.value=="Posta" &&  (document.forms.frm.Adres.value=="" ))
{ 
 	$(function(){
    $("#dialog-sifreunut span").text('Teklif toplama yöntemi "Posta" seçildiği zaman adres bilgisini girmelisiniz...');
	$("#dialog-sifreunut" ).dialog({
		modal:true,
		position: {	my: "center",at: "center",of: sayfa},
		buttons:{Tamam: function () {
    $(this).dialog("close");
    }}
	});	
    });
return (false); 
} 
if (document.forms.frm.iletisim.value=="Ziyaret" &&  (document.forms.frm.Adres.value=="" ))
{ 
 	$(function(){
    $("#dialog-sifreunut span").text('Teklif toplama yöntemi "Ziyaret" seçildiği zaman adres bilgisini girmelisiniz...');
	$("#dialog-sifreunut" ).dialog({
		modal:true,
		position: {	my: "center",at: "center",of: sayfa},
		buttons:{Tamam: function () {
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
    $("#dialog-sifreunut span").text('Kullanıcı sözleşmesini kabul etmeniz gerekir...');
	$("#dialog-sifreunut" ).dialog({
		modal:true,
		position: {	my: "center",at: "center",of: sayfa},
		buttons:{Tamam: function () {
    $(this).dialog("close");
    }}
	});	
    });
return (false);
}
return(true) 
} 

</script>