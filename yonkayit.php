<?php include "headeryon.php"; ?>
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
<script>
function sehirSec(Sehirx) {
	document.getElementById("tel_alankodu").options[Sehirx].selected=true;
	}
</script>
<script type="text/javascript" src="emailChecknew.js">
</script>
</head>
<body>
<div id="sayfa">
  <div id="ust">
    <?php include "ust.php" ?>
  </div>
  <!-- ust -->
  <div id="bant1"></div>
  <!-- bant1 -->
  <div id="sol">
    <?php include "solyonetim.php" ?>
  </div>
  <!-- sol -->
  <div id="analong">
  
  <table align="center" width="540" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td colspan="4" height="2" bgcolor="#FFFFFF"></td>
            </tr>
            <tr  >
              <td background="image/yeni_orta.gif" height="50" width="191" ><img src="image/5/5_1%20copy.gif" width="176" height="64"></td>
			  <td background="image/yeni_orta.gif" width="183" align="center" class="Baslik" valign="bottom">Üye Bilgileri </td>
			  <td background="image/yeni_orta.gif" width="154" valign="middle" align="right" class="Buyuk_Yazi"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td align="right">Yeni Üye</td>
                </tr>
                <tr>
                  <td> </td>
                </tr>
              </table>			    </td>
              <td background="image/yeni_orta.gif" width="27" ><img src="image/sag_ok.gif" width="27" height="64"></td>
            </tr>
        </table></td>
      </tr>
      <tr>
        <td bgcolor="#F6F6F6">
		<FORM id="frm" name="frm" method="post" action="yonekle.php?asama=firmabilgi" >
        <input type="hidden" id="yazi" name="yazi" >
        <input type="hidden" id="c1" name="c1" value="1">
        <input type="hidden" id="c2" name="c2" value="Firma">
        <span class="not">* Girilmesi zorunlu bilgiler</span>
        <TABLE width="95%"  border="0" align="center" cellpadding="2" cellspacing="0"  bordercolor="#F6F6F6"  bgcolor="#EAEAEA">
            <TR>
              <td colspan=2 align="left" class="aciklama" >
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
                  <span class="govde">Teklif toplamak ve teklif isteyenlerden haberdar olmak istiyor. </span></td>
            </TR>
            <TR>
              <td colspan=2 align="left" valign="top" height="30" >
                  <input type="radio" name="c11" value="0" <?php echo $check2; ?> class="onay" onClick="TurDegistir()">
                  <span class="govde">Sadece teklif toplamak istiyor. </span></td>
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

              <TR>
                <td colspan=2 align="left" class="aciklama" bgcolor="#F6F6F6">
                  <input type="radio" name="c21" value="Firma" <?php echo $check1; ?>  onClick="BaslikDegistir()">
                  <span class="govde">Firma adına kayıt olmak istiyor.</span></td>
              </TR>
              <TR>
                <td colspan=2 align="left" valign="top" height="30" bgcolor="#F6F6F6">
                  <input type="radio" name="c21" value="Kullanıcı" <?php echo $check2; ?> class="onay" onClick="BaslikDegistir()">
                  <span class="govde">Şahıs adına kayıt olmak istiyor. </span></td>
              </TR>
            <TR>
              <td class="govde" align="right">E-Posta Adresi    :</td>
              <td class="aciklama"> <FONT color=#990000><span style="font-weight: bold"><font color=#990000><font color=#004040 
      style="BACKGROUND-COLOR: #eeeecc; FONT-SIZE: 10px"><span style="font-weight: bold">
                <input  maxlength=50 name="email" size=25 style="border: 1 solid #666666" id="email" onKeyPress="return submitenter(this,event)"  value="<?php echo isset($_GET['email']) ? $_GET['email'] : ''; ?>">
              </span></font></font></span><span class="title">*<font color=#004040 
      style="BACKGROUND-COLOR: #eeeecc; FONT-SIZE: 10px">
              <span style="font-weight: bold"></span></font></span> </FONT></td>
            </TR>
            <TR>
              <td width="251" align="right" class="govde" id="FKAd">Firma veya Kullanıcı Adı    :</td>
              <td width="254" class="aciklama">
                 <INPUT  maxLength=80 id="Firma_Adi" name="Firma_Adi" size="25" style="border: 1 solid #666666" onKeyPress="return submitenter(this,event)" value="<?php echo isset($_GET['Firma_Adi']) ? $_GET['Firma_Adi'] : ''; ?>" >
                <FONT color=#990000 class="title"><strong>*</strong></FONT></td>
            </TR>
            <TR>
              <td  class="govde" align="right">Şehir    :</td>
              <td align="left" class="aciklama"><?
$sehir= isset($_GET['lcity']) ? $_GET['lcity'] : '';
$str="select * from sehir where sehirid<999 order by sehir ";
$result=mysqli_query($coni,$str);
?>
                  <select name="Sehir" style="width:130px" id="Sehir" onChange="sehirSec(this.selectedIndex-1)">
                     <OPTION SELECTED>Seçiniz
					<? while ($row = mysqli_fetch_array($result))
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
                  </select> <FONT color=#990000 class="title"><strong>*</strong></FONT></td>
            </TR>
            <tr>
              <td class="govde" align="right">Tercih Ettiği Teklif Toplama Yöntemi    :</td>
              <td class="sss"><strong>
                <select name="iletisim" style="border: 1 solid #666666">
                <?php
				$iletisim_sekilleri=array("E-Posta");
				foreach($iletisim_sekilleri as $iletisim_sekli) {
						 if($iletisim_sekli==isset($_GET['iletisim']) ? $_GET['iletisim'] : '') {
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
            <tr>
              <td class="govde" align="right">Yurt Dışına Teklif ?    :</td>
              <td class="aciklama"><strong>
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
             <tr>
              <td colspan="2" align="left"  class="aciklama" bgcolor="#F6F6F6" height="30" valign="middle">
				<input type="Checkbox" checked="checked" name="agreement" value="yes">
                <span class="govde">  <a href="#" onClick="YeniAc()" class="link">Kullanıcı Sözleşmesini</a> Kabul Ediyorum</span></td>
            </tr>
            <TR>
              <td colspan="2" align="center" class="aciklama" bgcolor="#F6F6F6" height="50" valign="middle"><img src="image/iptalet.gif" width="146" height="16" class="ResimDugme" onClick="javascript:window.location ='yonetimgiris.php'" ><img src= "image/trans.gif" alt="" width="20" height="1"><img src="image/ilerle.gif" width="146" height="16" onClick="Gonder()" class="ResimDugme"></td>
            </TR>
        </table>
		</form>		</td>
      </tr>
    </table>
</div>
<div id="dialog-sifreunut" title="Uyarı" style="display:none" class="text_g" >
  <p>
    <span>Hata mesajları...</span>
  </p>
</div>
  <div id="bant1"></div> <!-- bant2 -->
  
</div>
</bodY>
</HTML>
<script language="javascript">
function submitenter(myfield,e)
    {
        var keycode;
        if (window.event) keycode = window.event.keyCode;
        else if (e) keycode = e.which;
        else return true;

        if (keycode == 13)
        {
            Gonder();
            return false;
        }
        else
            return true;
    }


function YeniAc(){
	window.open('sozlesme.htm','sozlesme','width=650,height=500,scrollbars=yes');
}
function Gonder(){
	document.forms.frm.email.value=document.forms.frm.email.value.replace(/^\s+|\s+$/g,"");
	document.forms.frm.Firma_Adi.value=document.forms.frm.Firma_Adi.value.replace(/^\s+|\s+$/g,"");
	if (Validate())
		document.forms.frm.submit();
}

function Iptal(){
	window.location = "yonetimgiris.php";
}
function Validate() { 
if (document.forms.frm.Firma_Adi.value =="") 
{ 
 	alert(" Firma / Kullanıcı adını girmediniz.");
	return (false); 
} 
if (document.forms.frm.Sehir.value=="Seçiniz" ) 
{ 
 	alert(" Bulunduğu şehri seçmediniz. ");
	return (false); 
} 
if (!checkEmail(document.forms.frm.email.value)) return (false);

if (document.forms.frm.agreement.checked == false)
    {
  	  alert(" Kullanıcı sözleşmesini kabul etmeniz gerekir. ");
	  return (false);
    }
return(true) 
} 

function BaslikDegistir(){
	if (document.forms.frm.c21[1].checked )
	{
		document.forms.frm.c2.value	= "Kullanıcı";
		document.getElementById("FKAd").innerHTML = "Kullanıcı Adı    :";
	}
	else
	{
		document.forms.frm.c2.value	= "Firma";
		document.getElementById("FKAd").innerHTML = "Firma Adı    :";
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
TurDegistir();
BaslikDegistir();
<?php
if(isset($_GET['hata']) ? $_GET['hata'] : ''=='kayitli') {
	echo 'alert( " Girdiğiniz e-posta adresi sistemde kayıtlıdır... ");';
}

?>

</script>