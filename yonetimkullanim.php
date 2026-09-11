<?php include"headeryon.php";?>
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
<script src="jquery/jquery.ui.datepicker-tr.js"></script>
<!-- <script type="text/javascript" src="calendarDateInput.js">

/***********************************************
* Jason's Date Input Calendar- By Jason Moon http://calendar.moonscript.com/dateinput.cfm
* Script featured on and available at http://www.dynamicdrive.com
* Keep this notice intact for use.
***********************************************/

</script> -->
</head>
<body>
<SCRIPT LANGUAGE="JavaScript">
$(function() {
var days = new Date();
if (days.getDate()> 8) { var aysa = 2; }
$( "#tektarih" ).datepicker({firstDay:"1",minDate: "+0", maxDate: "+6M +10D", dateFormat:"dd-mm-yy", autoSize:"true", numberOfMonths:aysa });
$( "#tektarih" ).datepicker("setDate", '+0');
});
function change(select){
        if(select.name === "GunSay")
		{document.forms.frmYonKullanim.Sureler[0].checked=true;}
		else if(select.name === "HaftaSay")
		{document.forms.frmYonKullanim.Sureler[1].checked=true;}
		else if(select.name === "AySay")
		{document.forms.frmYonKullanim.Sureler[2].checked=true;}
		else if(select.name === "YilSay")
		{document.forms.frmYonKullanim.Sureler[3].checked=true;}
}
function Iptal(){
	window.location = "yonetimgiris.php";
}
function Gonder(){
	if (Kontrol())
		document.forms.frmYonKullanim.submit();
}
function Kontrol() {
if (document.forms.frmYonKullanim.firma.value=="" ) 
{ alert (" Lütfen teklif isteyen firma adını giriniz. ");
  document.forms.frmYonKullanim.text.focus(); 
  return (false); 
} 
if (document.forms.frmYonKullanim.text.value=="" ) 
{ alert (" Lütfen teklif toplamak istediğiniz mal veya hizmetin tarifini yapınız. ");
  document.forms.frmYonKullanim.text.focus(); 
  return (false); 
} 

if (document.forms.frmYonKullanim.ePosta3.value=="" ) 
{ alert ( " Lütfen iletişim bilgisini giriniz. ");
  document.forms.frmYonKullanim.ePosta3.focus(); 
  return (false); 
} 

if (! TarihKontrol())
{alert ( " En son teklif toplama tarihi bugünden önce olamaz. ");
   document.forms.frmYonKullanim.gun.focus(); 
   return (false);
}

if (document.forms.frmYonKullanim.Sureler[0].checked )
	document.forms.frmYonKullanim.sure.value = document.forms.frmYonKullanim.GunSay.value + " Gün";
if (document.forms.frmYonKullanim.Sureler[1].checked )
	document.forms.frmYonKullanim.sure.value = document.forms.frmYonKullanim.HaftaSay.value + " Hafta";
if (document.forms.frmYonKullanim.Sureler[2].checked )
	document.forms.frmYonKullanim.sure.value = document.forms.frmYonKullanim.AySay.value + " Ay";
if (document.forms.frmYonKullanim.Sureler[3].checked )
	document.forms.frmYonKullanim.sure.value = document.forms.frmYonKullanim.YilSay.value + " Yıl";
return(true) 
} 
function textCounter(field, countfield, maxlimit) {
if (field.value.length > maxlimit) // if too long...trim it!
field.value = field.value.substring(0, maxlimit);
// otherwise, update 'characters left' counter
else 
countfield.value = maxlimit - field.value.length;
}
function TarihKontrol() {
/*    var now = new Date();
	var tarih = document.forms.frmYonKullanim.tektarih.value;
	var dateParts = tarih.split("-");
    var jsDate = new Date( dateParts[2], dateParts[1] - 1,dateParts[0]);
	
if (jsDate > now) */
var tarih = document.forms.frmYonKullanim.tektarih.value;
tarih = new Date(tarih.split("-").reverse().join("-")); 
if (tarih > new Date())
    { return true;
    }
    else {return false;
    }
}
<!-- Begin bu fonksiyon EKAP bülteninden kopya-yapıştır karakter düzeltmesi içindir
function replaceChars(entry,ecase) {
var myout=["Ġ","ġ","Ģ"];
var myadd=["İ","Ş","ş"];
temp = "" + entry; // temporary holder
for(var i=0; i<3; i++) 
{
out = myout[i]; // replace this
add = myadd[i]; // with this
while (temp.indexOf(out)>-1) {
pos= temp.indexOf(out);
temp = "" + (temp.substring(0, pos) + add + 
temp.substring((pos + out.length), temp.length));
}
}
switch (ecase)
{ case 'firma':
document.forms.frmYonKullanim.firma.value = temp;
break;
case 'iletisimBilgi':
document.forms.frmYonKullanim.iletisimBilgi.value = temp;
break;
case 'text':
document.forms.frmYonKullanim.text.value = temp;
break;
case 'textshort':
document.forms.frmYonKullanim.textshort.value = temp;
break;
}
}

// End -->
</script>
<?php $verified_sifre1="";
$verified_sehirid="";
$verified_kulid = "";
$verified_teklifid= "";
$_SESSION['verified_sehirid']=$verified_sehirid;
unset($_SESSION['verified_sehirid']);
$_SESSION['verified_sifre1']=$verified_sifre1;
unset($_SESSION['verified_sifre1']);
$_SESSION['verified_kulid']=$verified_kulid;
unset($_SESSION['verified_kulid']);
$_SESSION['verified_teklifid']=$verified_teklifid;
unset($_SESSION['verified_teklifid']);
unset($_SESSION['kontrol']);
?>
<div id="sayfa">
  <div id="ust">
    <?php include "ust.php" ?>
  </div>
  <div id="bant1"></div>
  <div id="sol">
    <?php include "solyonetim.php" ?>
  </div>
  <div id="analong">

<table width="540px" align="center"  cellspacing="0" cellpadding="0" border="0" bgColor=white >
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td colspan="4" height="2" bgcolor="#FFFFFF"></td>
            </tr>
            <tr  >
              <td background="image/yeni_orta.gif" height="50" width="191" ><img src="image/5/5_1%20copy.gif" width="176" height="64"></td>
              <td background="image/yeni_orta.gif" width="183" align="center" class="Baslik" valign="bottom">&nbsp;</td>
              <td background="image/yeni_orta.gif" width="154" valign="middle" align="right" class="Buyuk_Yazi"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td align="right">Yeni talep</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                </tr>
              </table>                </td>
              <td background="image/yeni_orta.gif" width="27" ><img src="image/sag_ok.gif" width="27" height="64"></td>
            </tr>
        </table></td>
      </tr>
      <tr>
        <td valign="top" bgcolor="#F6F6F6"><span class="title_kucuk">Sayın  <? $verified_user = isset($_SESSION["verified_user"])? $_SESSION["verified_user"]:''; echo $verified_user;?>,  l&uuml;tfen talebinizle ilgili a&#351;a&#287;&#305;daki bilgileri giriniz. </span>
            <table width="100%" border="0" align="center" cellpadding="2" cellspacing="1" >
              <tr>
                <td bgcolor="#F6F6F6">
                  <table width="95%"  border="0" align="center" cellpadding="2" cellspacing="0"  bordercolor="#F6F6F6"  bgcolor="#EAEAEA">
                    <form method="post"  action="yonetimkulekle.php?islem=kullanim" name="frmYonKullanim" >
					<input type="hidden" name="yazi" id="yazi" >
                    <tr>
                      <td align="right" class="govde">Teklif Toplayan   : </td>
                      <td><input maxlength="150" size="30" type="Text" name="firma" onBlur="replaceChars(this.value,'firma');" ></td>
                    </tr>
                    <tr>
                      <td align="right" class="govde"> Firma E-Posta:</td>
                      <td><input name="FirmaEPosta" type="Text" id="ePosta" size="30" maxlength="150"></td>
                    </tr>
                        <td width="240" align="right" class="govde"> Yöntemi / İletişim Bilgisi :</td>
                        <td width="259"><select name="iletisim" size="1">
                            <option value="E-Posta" >E-Posta</option>
                            <option value="Faks">Faks</option>
                            <option value="Posta">Posta</option>
                            <option value="Telefon">Telefon</option>
                            <option value="Ziyaret" selected>Ziyaret</option>
                        </select>
                          <input name="iletisimBilgi" type="Text" id="ePosta3" size="30" maxlength="150" onBlur="replaceChars(this.value,'iletisimBilgi');"></td>
                    </tr>
                    <TR>
              <td align="right" class="govde" i><label id="tektar">En Son Teklif Verme Tarihi:</label></td>
              <td class="aciklama"><input type="text" name="tektarih" id="tektarih" />
			  
			  <!-- <script>DateInput('tektarih', true, 'YYYY-MM-DD', '<?php echo date("Y-m-d",time()+4*24*60*60); ?>')</script> -->
                </TR>
              <tr>
                <td align="right" class="govde" >Teslim Süresi : </td>
                <td>
                  <table width="200">
                      <tr>
                        <td width="74" class="govde"><label>
                          <input type="radio" name="Sureler" value="Gün" checked>
                        Gün</label></td>
                        <td width="114"><select name="GunSay" size="1" onchange="change(this)">
                            <?php
                             for ($i=1; $i<=45; $i++)
                             { if ($i==45)
                             $selected="selected";
							 else
							 $selected=''; 
						     echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';
						     } ?> 
                        </select></td>
                      </tr>
                      <tr>
                        <td class="govde"><label>
<input type="radio" name="Sureler" value="Hafta">                        
Hafta</label></td>
                        <td><select name="HaftaSay" size="1" id="HaftaSay" onchange="change(this)">
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select></td>
                      </tr>
                      <tr>
                        <td class="govde"><label>
                          <input type="radio" name="Sureler" value="Ay">
                        Ay</label></td>
                        <td><select name="AySay" size="1" id="AySay" onchange="change(this)">
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                        </select></td>
                      </tr>
                      <tr>
                        <td class="govde"><label>
                          <input type="radio" name="Sureler" value="Yil">
                        Yıl</label></td>
                        <td><select name="YilSay" size="1" id="YilSay" onchange="change(this)">
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select></td>
                      </tr>
                  </table>
                  <input type="hidden" name="sure" id="sure">
                </td>
              </tr>
              <TR>
                <td  align="right" class="govde">Teslim Ülke: </td>
                <td align="left"><?
$strc="select * from country order by ulke";
$resultc=mysqli_query($coni,$strc);
?>
                    <select name="ulke"  width="90" style="width: 90px">
                      <?php while ($rowr = mysqli_fetch_array($resultc))
                     {
					 $ciso3=$rowr['iso3'];
					 if($rowr['ulke']=="Turkey")
					 {
					 	echo "<option value=$ciso3 selected=selected>";
					 }
					 else 
					 {
						 echo "<option value=$ciso3>"; }
					 echo $rowr['ulke'];}
                     echo"<br>";?>
                    </select>
                </td>
              </TR>
              <TR>
                <td  align="right" class="govde">Teslim Şehri: </td>
                <td align="left"><?
$str="select * from sehir where sehirid < 999 order by sehir";
$result=mysqli_query($coni,$str);
?>
                    <select name="sehir"    >
                      <?php while ($row = mysqli_fetch_array($result))
                     {
					 $sehiridx=$row['sehirid'];
					 echo "<option value=$sehiridx>";
					 echo $row['sehir'];}
                     echo"<br>";?>
                    </select>
                </td>
              </TR>
              <tr>
                <td align="right" class="govde">Mal ve Hizmetin Tarifi :</td>
                <td class="govde">
                  <textarea cols="50" name="text"  onKeyDown="textCounter(this.form.text,this.form.remLen,500)" onKeyUp="textCounter(this.form.text,this.form.remLen,500)" rows="10" wrap="soft"style="font-family: Arial; font-size: 8pt;" onBlur="replaceChars(this.value,'text');">İlave bilgi  https://ekap.kik.gov.tr/EKAP/Ortak/IhaleArama/index.html  adresindedir. &#10; &#10;</textarea>
                  <br>
                  Kalan karakter sayısı:
                  <input name="remLen" type="text" value="500" size="6"  maxlength=3 readonly >
                </td>
              </tr>
              <tr>
                <td align="right" class="govde">Kısa Tarif:</td>
                <td class="govde">
                  <input maxlength="200" size="40" type="Text" id="textshort" name="textshort" onBlur="replaceChars(this.value,'textshort');" >
                </td>
              </tr>

              <tr>
              <td width="240" align="right" class="govde">İlgili kaç üyemize gönderilsin?</td>
                        <td width="259"><select name="MesajNum" size="1" id="MesajNum">
                            <option value="200" >En fazla 200</option>
                            <option value="300">En fazla 300</option>
                            <option value="3000" selected>Hepsine</option>
                            </select>
                        </td>
                    </tr>
              <tr>
                <td height="50px" colspan="2"  align="center" bgcolor="#F6F6F6" valign="middle" ><a href="yonetimgiris.php" class="buttonPage"> İptal &nbsp;<i class="icon-close" ></i></a><img src= "image/trans.gif" alt="" width="20" height="1"><a href="#here" onClick="Gonder()" class="buttonPage"> İlerle &nbsp;<i class="icon-arrow-right"></i></a></td>
              </tr></form>
                </table></td>
              </tr>
            </table>
      </tr>
    </table>
  </div>
  <div id="bant1"></div> <!-- bant2 -->
 
 </div>  
</BODY></HTML>
<script language="javascript">
	var now = new Date();
	if (now.getDate() <9)
		document.forms.frmYonKullanim.gun.value =  "0" + (now.getDate() +1)
	else	
		document.forms.frmYonKullanim.gun.value = now.getDate() +1;
	if (now.getMonth() <9)
		document.forms.frmYonKullanim.ay.value = "0" + (now.getMonth() + 1);
	else
		document.forms.frmYonKullanim.ay.value = now.getMonth() + 1;
	
	document.forms.frmYonKullanim.yil.value = now.getFullYear();
</script>