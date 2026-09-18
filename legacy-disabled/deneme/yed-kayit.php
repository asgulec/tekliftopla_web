<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="content-language" content="tr" />
<title>tekliftopla</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="emailCheck.js">
</script>
<script>
function sehirSec(Sehirx) {
	document.getElementById("tel_alankodu").options[Sehirx].selected=true;
	document.getElementById("fax_alankodu").options[Sehirx].selected=true;
}

function iletisim_yontemi() {
	var yontem=document.getElementById("iletisim").value;
	switch(yontem) {
		case "Faks": document.getElementById("tr_faks").style.display="table-row";
						document.getElementById("tr_pk").style.display="none";
						document.getElementById("tr_adres").style.display="none";
						document.getElementById("tr_telefon").style.display="none";
						 break;
		case "Posta": 
		case "Ziyaret": document.getElementById("tr_pk").style.display="table-row";
						document.getElementById("tr_adres").style.display="table-row"; 
						document.getElementById("tr_faks").style.display="none";
						document.getElementById("tr_telefon").style.display="none";
						break;
		case "Telefon": document.getElementById("tr_telefon").style.display="table-row"; 
						document.getElementById("tr_faks").style.display="none";
						document.getElementById("tr_pk").style.display="none";
						document.getElementById("tr_adres").style.display="none";
						break;
		case "E-Posta": document.getElementById("tr_telefon").style.display="none"; 
						document.getElementById("tr_faks").style.display="none";
						document.getElementById("tr_pk").style.display="none";
						document.getElementById("tr_adres").style.display="none";
						break;
	}
}
</script>
<?php include "ayar.php";
$connection=mysql_connect("$host","$user","$password") or die ("Could not connect to the MySQL Server");
$query="SET NAMES 'UTF8'";
mysql_query($query);
mysql_select_db($db);
?>

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
      <tr height="25px">
        <td width="25%">&nbsp;</td>
        <td width="25%" ></td>
        <td valign="middle" width="43%" align="right" class="title"><p>Yeni Üye<br>
          <span class="title_kucuk">Bilgiler</span></p></td>
        <td valign="bottom" align="right" width="7%" ><img src="image/sag_ok.gif" width="27"></td>
      </tr>
    </table></td>
</tr>
<tr>
  <td height="10px"></td>
</tr>
  <tr>
        <td>
		<FORM id="frm" name="frm" method="post" action="ekle.php?asama=firmabilgi" >
        <input type="hidden" id="yazi" name="yazi" >
        <input type="hidden" id="c1" name="c1" value="1">
        <input type="hidden" id="c2" name="c2" value="Firma">
        <span class="not"><strong>* Girilmesi zorunlu bilgiler</strong></span>
        <TABLE width="95%"  border="0" align="center" cellpadding="2" cellspacing="0">
            <TR>
              <td colspan=2 align="left" height="30px" bgcolor="#F6F6F6">
              <?php
			  if(isset($_GET['c11'])) {
			  if($_GET['c11']==1) {
				  $check1='checked="checked"';
				  $check2='';
			  }
			else {
				  $check1='';
				  $check2='checked="checked"';
			}
			  }
			  else {
				  $check1='checked="checked"';
				  $check2='';
			  }
			  ?>
                  <input type="radio" name="c11" value="1" <?php echo $check1; ?> onClick="TurDegistir()">
                  <strong><em><span class="title_kucuk">Teklif toplamak ve teklif isteyenlerden haberdar olmak istiyorum </span></em></strong></td>
            </TR>
            <TR>
              <td colspan=2 align="left" valign="top" height="30" bgcolor="#F6F6F6">
                  <input type="radio" name="c11" value="0" <?php echo $check2; ?> class="onay" onClick="TurDegistir()">
                  <strong><em><span class="title_kucuk">Sadece teklif toplamak istiyorum </span></em></strong></td>
            </TR>
                          <?php
			  if(isset($_GET['c21'])) {
			  if($_GET['c21']=="Firma") {
				  $check1='checked="checked"';
				  $check2='';
			  }
			else {
				  $check1='';
				  $check2='checked="checked"';
			}
			  }
			  else {
				  $check1='checked="checked"';
				  $check2='';
			  }
			  ?>

              <TR style="display:none">
                <td colspan=2 align="left" class="govde" bgcolor="#F6F6F6">
                  <input type="radio" name="c21" value="Firma" <?php echo $check1; ?> class="onay">Firma adına kayıt olmak istiyorum</td>
              </TR>
              <TR style="display:none">
                <td colspan=2 align="left" class="govde" bgcolor="#F6F6F6">
                  <input type="radio" name="c21" value="Kullanıcı" <?php echo $check2; ?> class="onay">Şahıs  adına kayıt olmak istiyorum</td>
              </TR>
            <TR>
              <td width="251" align="right" class="govde" id="FKAd">Firma veya Kullanıcı Adı :</td>
              <td width="254">
                 <INPUT  maxLength=80 id="Firma_Adi" name="Firma_Adi" size="25" style="border: 1 solid #666666" value="<?php echo isset($_GET['Firma_Adi']) ? $_GET['Firma_Adi'] : '';?>" >
                <FONT class="title"><strong> * </strong></FONT></td>
            </TR>
             <TR>
              <td  class="govde" align="right">Şehir :</td>
              <td align="left"><?
$sehir=isset($_GET['Sehir']) ? $_GET['Sehir'] : '';
$str="select * from sehir where sehirid < 999 order by sehir";
$result=mysql_db_query("teklifto_teklif_topla","$str");
?>
                  <select name="Sehir" style="width:130px" id="Sehir" onChange="sehirSec(this.selectedIndex-1)">
                    <OPTION SELECTED>Seçiniz
					<? while ($row = mysql_fetch_array($result))
                     {
						 if($row['sehir']==$sehir) {
						 	$selected='selected="selected"';
						 }
						 else
						 {
							 $selected='';
						 }
					 echo "<option $selected >";
					 echo $row['sehir'];
					  echo "</option>";
                     echo"<br>";}
					 ?>
                  </select><FONT class="title"> * </FONT> </td>
            </TR>
            <TR>
              <td class="govde" align="right">Şifre Gönderilmesi İçin E-Posta Adresi :</td>
              <td><font color=#004040 style="BACKGROUND-COLOR: #eeeecc; FONT-SIZE: 10px"><span style="font-weight: bold">
                <input  maxlength=50 name="email" size=25 style="border: 1 solid #666666" id="email"   value="<?php echo isset($_GET['email']) ? $_GET['email'] : '';?>">
              </span></font><span class="title"> * </span></td>
            </TR>
            <TR>
              <td class="govde" align="right">Doğrulama Kodu :</td>
              <td><img src="random_image.php" /></td>
            </TR>
            <TR>
              <td class="govde" align="right">Doğrulama Kodunu Giriniz :</td>
              <td><INPUT name="imgverrand" style="border: 1 solid #666666" size=25  maxLength=4><FONT class="title"><strong> * </strong></FONT> </td>
            </TR>
             <tr height="30px">
              <td class="govde" align="right">Tercih Ettiğiniz Teklif Toplama Yöntemi :</td>
              <td><strong>
                <select name="iletisim" id="iletisim" style="border: 1 solid #666666" onchange="iletisim_yontemi()">
                <?php
				$iletisima = isset($_GET['iletisim']) ? $_GET['iletisim'] : '';
				$iletisim_sekilleri=array("E-Posta","Faks","Posta","Telefon","Ziyaret");
				foreach($iletisim_sekilleri as $iletisim_sekli) {
						 if($iletisim_sekli==$iletisima) {
						 	$selected='selected="selected"';
						 }
						 else
						 {
							 $selected='';
						 }
					echo "<option value=\"$iletisim_sekli\" $selected>$iletisim_sekli</option>";
				}
				?>
                </select>
              </strong></td>
            </tr>
            <TR style="display:none">
              <td class="govde" align="right"><label id="ilgili">Firma İrtibat Kişisi :</label></td>
              <td><INPUT name="yetkili" style="border: 1 solid #666666" size=25  maxLength=50  value="<?php echo isset($_GET['yetkili']) ? $_GET['yetkili'] : ''; ?>"> 
             </TR>
            <TR style="display:none" id="tr_adres">
              <td class="govde" align="right">Kullanıcı Adresi :</td>
              <td ><INPUT name="Adres" style="border: 1 solid #666666" size=25   maxLength=100 value="<?php echo isset($_GET['Adres']) ? $_GET['Adres'] : ''; ?>"></td>
            </TR>
            <TR style="display:none"  id="tr_pk">
              <td class="govde" align="right">Posta Kodu :</td>
              <td><INPUT name="Posta_Kodu" style="border: 1 solid #666666" size=5 maxLength=5 value="<?php echo isset($_GET['Posta_Kodu']) ? $_GET['Posta_Kodu'] : ''; ?>"></td>
            </TR>
           <TR style="display:none" id="tr_telefon">
              <td class="govde" align="right">Kullanıcı Telefonu :</td>
              <td valign="top"><strong>
                <?

$str1="select * from sehir where sehirid < 999 order by sehir";
$result1=mysql_db_query("teklifto_teklif_topla","$str1");

?>
          <select id="tel_alankodu" name="tel_alankodu" style="width:130px" >
                  <? while ($row = mysql_fetch_array($result1))
                     {
					 $telkodx=$row['telkod'];
						 if($row['telkod']==isset($_GET['tel_alankodu']) ? $_GET['tel_alankodu'] : '') {
						 	$selected='selected="selected"';
						 }
						 else
						 {
							 $selected='';
						 }

						echo "<option value=$telkodx $selected>$telkodx</option>";
					 }
					/*
					 if($sehir==$row['sehir'])
					 {
						 echo "<option value=$telkodx selected=selected>";
					 }
					 else
					 {
						 echo "<option value=$telkodx>";
					 }
					 echo $row['telkod'];}
				      echo"<br>";
					  */
					  ?>
                </select>
                <INPUT maxLength=7 name="Telefon" size=7  style="border: 1 solid #666666" value="<?php echo isset($_GET['Telefon']) ? $_GET['Telefon'] : '';?>">
                </strong></td>
            </TR>
            <TR style="display:none" id="tr_faks">
              <td class="govde" align="right">Kullanıcı Faksı :</td>
              <td><strong>
                <?
$str2="select * from sehir where sehirid < 999 order by sehir";
$result2=mysql_db_query("teklifto_teklif_topla","$str2");
?>
                <select id="fax_alankodu" name="fax_alankodu" style="width:130px">
                  <?
                  	 while ($row = mysql_fetch_array($result2))
                     {
					 $telkodx=$row['telkod'];
						 if($row['telkod']==isset($_GET['fax_alankodu']) ? $_GET['fax_alankodu'] : '') {
						 	$selected='selected="selected"';
						 }
						 else
						 {
							 $selected='';
						 }

						echo "<option value=$telkodx $selected>$telkodx</option>";
					 }?>
                </select>
                <INPUT  maxLength=7 name="Fax" size=7 style="border: 1 solid #666666"  value="<?php echo isset($_GET['Fax']) ? $_GET['Fax'] : '';?>">
              </strong></td>
            </TR>
           
            <tr style="display:none">
              <td class="govde" align="right">Yurt Dışına Teklif Vermek İstiyor musunuz? :</td>
              <td><strong>
                <select name="lisan" >
                <?php
				$lisanlar=array("Evet","Hayır");
				foreach($lisanlar as $lisan1) {
						 if($lisan1==isset($_GET['lisan']) ? $_GET['lisan'] : '') {
						 	$selected='selected="selected"';
						 }
						 else
						 {
							 $selected='';
						 }
					echo "<option value=\"$lisan1\" $selected>$lisan1</option>";
				}
				?>
                </select>
              </strong></td>
            </tr>
            <TR style="display:none">
              <td class="govde" align="right">Web Adresi :</td>
              <td><INPUT name="Web2" style="border: 1 solid #666666"   value="<?php echo isset($_GET['Web2']) ? $_GET['Web2'] : '';?>" size=25  maxLength=50></td>
            </TR>
            <tr>
              <td colspan="2" align="left" height="30" valign="middle">
				<?php 
				$agreement= isset($_GET['agreement']) ? 'checked="checked"' : ''; 
				?>
                <input type="Checkbox" name="agreement" value="yes" <?php echo $agreement; ?>>
                <span class="govde">  <a href="#" onClick="YeniAc()" class="link_k">Kullanıcı Sözleşmesini</a> kabul ediyorum.</span></td>
            </tr>
            <TR>
              <td colspan="2" align="center" height="50" valign="middle"><a href="#here" onClick="Iptal()" class="buttonPage"> İptal &nbsp;<i class="icon-close" ></i></a><img src= "image/trans.gif" alt="" width="25" height="1"><a href="#here" onClick="Gonder()" class="buttonPage"> İlerle &nbsp;<i class="icon-arrow-right"></i></a></td>
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
</bodY>
</HTML>
<script language="javascript">
function YeniAc(){
	window.open('sozlesme.htm','sozlesme','width=650,height=500,scrollbars=yes');
}
function Gonder(){
	document.forms.frm.email.value=document.forms.frm.email.value.replace(/^\s+|\s+$/g,"");
	if (Validate())
		document.forms.frm.submit();
}

function Iptal(){
	window.location = "cikis.php";
}
function Validate() { 
if (document.forms.frm.Firma_Adi.value =="") 
{ 
 	document.getElementById("yazi").value = " Kullanıcı adını girmediniz.";
	window.open('dikkat.html',"win1","width=400, height=200,menubar=0,resizable=0,scrollbars=0,status=0,titlebar=0,toolbar=0,left="+(screen.width-400)/2+",top="+(screen.height-200)/2);
	return (false); 
} 
if (document.forms.frm.Sehir.value=="Seçiniz" ) 
{ 
 	document.getElementById("yazi").value = " Bulunduğunuz şehri seçmediniz. ";
	window.open('dikkat.html',"win1","width=400, height=200,menubar=0,resizable=0,scrollbars=0,status=0,titlebar=0,toolbar=0,left="+(screen.width-400)/2+",top="+(screen.height-200)/2);
 return (false); 
} 
if (document.forms.frm.iletisim.value=="Telefon" &&  (document.forms.frm.Telefon.value=="" | document.forms.frm.Telefon.value=="0" ))
{ 
 	document.getElementById("yazi").value = " Teklif toplama yöntemi Telefon seçildiği zaman Telefon bilgisini girmelisiniz.";
	window.open('dikkat.html',"win1","width=400, height=200,menubar=0,resizable=0,scrollbars=0,status=0,titlebar=0,toolbar=0,left="+(screen.width-400)/2+",top="+(screen.height-200)/2);
	return (false); 
} 
if (document.forms.frm.iletisim.value=="Faks" &&  (document.forms.frm.Fax.value=="" | document.forms.frm.Fax.value=="0" ))
{ 
 	document.getElementById("yazi").value = " Teklif toplama yöntemi Fax seçildiği zaman Fax bilgisini girmelisiniz.";
	window.open('dikkat.html',"win1","width=400, height=200,menubar=0,resizable=0,scrollbars=0,status=0,titlebar=0,toolbar=0,left="+(screen.width-400)/2+",top="+(screen.height-200)/2);
	return (false); 
} 
if (document.forms.frm.iletisim.value=="Posta" &&  (document.forms.frm.Adres.value=="" ))
{ 
 	document.getElementById("yazi").value = " Teklif toplama yöntemi Posta seçildiği zaman Adres bilgisini girmelisiniz.";
	window.open('dikkat.html',"win1","width=400, height=200,menubar=0,resizable=0,scrollbars=0,status=0,titlebar=0,toolbar=0,left="+(screen.width-400)/2+",top="+(screen.height-200)/2);
	return (false); 
} 

if (!checkEmail(document.forms.frm.email.value)) return (false);

if (document.forms.frm.agreement.checked == false)
    {
  	  document.getElementById("yazi").value = " Kullanıcı sözleşmesini kabul etmeniz gerekir. ";
	  window.open('dikkat.html',"win1","width=400, height=200,menubar=0,resizable=0,scrollbars=0,status=0,titlebar=0,toolbar=0,left="+(screen.width-400)/2+",top="+(screen.height-200)/2);
      return (false);
    }
return(true) 
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
TurDegistir();
<?php
if(isset($_GET['hata']) ? $_GET['hata'] : ''=='imgver') {
	echo 'var yazi;
	document.getElementById("yazi").value = " Doğrulama kodu hatası, lütfen doğru kodu giriniz. ";
	  window.open(\'dikkat.html\',"win1","width=400, height=200,menubar=0,resizable=0,scrollbars=0,status=0,titlebar=0,toolbar=0,left="+(screen.width-400)/2+",top="+(screen.height-200)/2);';
}

if(isset($_GET['hata1']) ? $_GET['hata1'] : ''=='kayitli') {
	echo 'var yazi;
	document.getElementById("yazi").value = " Girdiğiniz e-posta adresi sistemimizde kayıtlıdır. Şifrenizi unuttuysanız \"Şifremi Unuttum\" bağlantısını tıklayınız. ";
	  window.open(\'dikkat.html\',"win1","width=400, height=200,menubar=0,resizable=0,scrollbars=0,status=0,titlebar=0,toolbar=0,left="+(screen.width-400)/2+",top="+(screen.height-200)/2);';
}

?>

</script>