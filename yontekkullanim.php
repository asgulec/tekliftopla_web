<? include "headeryon.php";?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="content-language" content="tr" />
<title>tekliftopla</title>
<link rel="stylesheet" href="jquery/jquery-ui.theme.css">
<link rel="stylesheet" href="jquery/jquery-ui.css">
<script src="jquery/external/jquery/jquery.js"></script>
<script src="jquery/jquery-ui.min.js"></script>
<script src="jquery/jquery.ui.datepicker-tr.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css">
<!-- <script type="text/javascript" src="calendarDateInput.js">

/***********************************************
* Jason's Date Input Calendar- By Jason Moon http://calendar.moonscript.com/dateinput.cfm
* Script featured on and available at http://www.dynamicdrive.com
* Keep this notice intact for use.
***********************************************/

</script> -->
<script type="text/javascript" src="emailChecknew.js">
</script>
</head>

<body>
<SCRIPT LANGUAGE="JavaScript">
$(function() {
$( "#tektarih" ).datepicker({firstDay:"1",minDate: "+1", maxDate: "+3M +10D", dateFormat:"dd-mm-yy", autoSize:"true" });
$( "#tektarih" ).datepicker("setDate", '+5');
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
{ 
 	alert(" Lütfen teklif isteyen kişi/firma adını giriniz. ");
	return (false); 
} 
		
if (!TarihKontrol())
{
   alert(" En son teklif toplama tarihi bu günden önce olamaz. ");
   document.forms.frmYonKullanim.tektarih.focus(); 
   return (false);
}
if (document.forms.frmYonKullanim.sehir.value=="Seçiniz" ) 
{ 
 	alert(" Teslim şehri seçmediniz. ");
	document.forms.frmYonKullanim.sehir.focus();
	return (false); 
} 
if (document.forms.frmYonKullanim.text.value=="" ) 
{ 
 	alert(" Lütfen teklif toplamak istediğiniz mal veya hizmetin tarifini yapınız. ");
	document.forms.frmYonKullanim.text.focus(); 
	return (false); 
} 

if (document.forms.frmYonKullanim.ePosta3.value=="" ) 
{ 
 	alert(" Lütfen iletişim bilgisini giriniz. ");
	document.forms.frmYonKullanim.ePosta3.focus(); 
	return (false); 
} 
if (document.forms.frmYonKullanim.iletisim.value=="E-Posta" && !checkEmail(document.forms.frmYonKullanim.ePosta3.value))
		{
		document.forms.frmYonKullanim.ePosta3.focus(); 
		return (false);
		}
if (document.forms.frmYonKullanim.Sureler[0].checked )
	document.forms.frmYonKullanim.sure.value = document.forms.frmYonKullanim.GunSay.value + " Gün";
if (document.forms.frmYonKullanim.Sureler[1].checked )
	document.forms.frmYonKullanim.sure.value = document.forms.frmYonKullanim.HaftaSay.value + " Hafta";
if (document.forms.frmYonKullanim.Sureler[2].checked )
	document.forms.frmYonKullanim.sure.value = document.forms.frmYonKullanim.AySay.value + " Ay";
if (document.forms.frmYonKullanim.Sureler[3].checked )
	document.forms.frmYonKullanim.sure.value = document.forms.frmYonKullanim.YilSay.value + " Yil";
return(true); 
} 
function textCounter(field, countfield, maxlimit) {
if (field.value.length > maxlimit) // if too long...trim it!
field.value = field.value.substring(0, maxlimit);
// otherwise, update 'characters left' counter
else 
countfield.value = maxlimit - field.value.length;
}
function TarihKontrol() {
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
<table width="737" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" ><? include "ust.php"?></td>
  </tr>
  <tr>
    <td width="176" valign="top" ><? include "solyonetim.php";?></td>
    <td   valign="top"><table width="100%"  cellspacing="0" cellpadding="0" border="0" bgColor=white >
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
                  <td align="right">YEN&#304; TALEP</td>
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
        <td valign="top" bgcolor="#F6F6F6"><span class="title_kucuk">Sayın : <? $verified_user = $_SESSION["verified_user"]; echo $verified_user;?>,  l&uuml;tfen talebinizle ilgili a&#351;a&#287;&#305;daki bilgileri giriniz. </span>
            <table width="100%" border="0" align="center" cellpadding="2" cellspacing="1" >
              <tr>
                <td bgcolor="#F6F6F6">
                  <table width="95%"  border="0" align="center" cellpadding="2" cellspacing="0"  bordercolor="#F6F6F6"  bgcolor="#EAEAEA">
                    <form method="post"  action="yonetimkulekle.php?islem=kultekkul" name="frmYonKullanim" >
					<input type="hidden" name="MesajNum" id="MesajNum" value="3000" >
                    <input type="hidden" name="yazi" id="yazi" >
                    <tr>
                      <td align="right" class="govde">Teklif Toplamak İsteyen: </td>
                      <td><input maxlength="150" size="30" type="Text" name="firma" onBlur="replaceChars(this.value,'firma');" ></td>
                    </tr>
                    <tr>
                      <td align="right" class="govde">Teklif Toplamak İsteyen  E-Posta:</td>
                      <td><input name="FirmaEPosta" type="Text" id="ePosta" size="30" maxlength="150"></td>
                    </tr>
                      <td width="240" align="right" class="govde">Teklif Toplama Yöntemi / İletişim Bilgisi :</td>
                        <td width="259"><select name="iletisim" id="iletisim" size="1">
                            <option value="E-Posta" selected>E-Posta</option>
                            <option value="Faks">Faks</option>
                            <option value="Posta">Posta</option>
                            <option value="Telefon">Telefon</option>
                            <option value="Ziyaret">Ziyaret</option>
                        </select>
                          <input name="iletisimBilgi" type="Text" id="ePosta3" size="30" maxlength="150" onBlur="replaceChars(this.value,'iletisimBilgi');"></td>
                    </tr>
                    <TR>
              <td align="right" class="govde" i><label id="tektar">En Son Teklif Verme Tarihi:</label></td>
              <td class="aciklama"><input type="text" name="tektarih" id="tektarih" />
			  
			  <!-- <script>DateInput('tektarih', true, 'YYYY-MM-DD', '<?php echo date("Y-m-d",time()+4*24*60*60); ?>')</script> --> 
                </TR>
              <tr>
                <td align="right" class="govde" >Mal veya Hizmetin Teslim Süresi : </td>
                <td>
                  <table width="200">
                      <tr>
                        <td width="74" class="govde"><label>
                          <input type="radio" name="Sureler" value="Gün" checked>
                        Gün</label></td>
                        <td width="114"><select name="GunSay" size="1" onchange="change(this)">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5" selected>5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                            <option value="13">13</option>
                            <option value="14">14</option>
                            <option value="15">15</option>
                            <option value="16">16</option>
                            <option value="17">17</option>
                            <option value="18">18</option>
                            <option value="19">19</option>
                            <option value="20">20</option>
                            <option value="21">21</option>
                            <option value="22">22</option>
                            <option value="23">23</option>
                            <option value="24">24</option>
                            <option value="25">25</option>
                            <option value="26">26</option>
                            <option value="27">27</option>
                            <option value="28">28</option>
                            <option value="29">29</option>
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
                <td  align="right" class="govde">Mal veya Hizmetin Teslim Yeri :</td>
                <td align="left"><?
$str="select * from sehir where sehirid<999 order by sehir";
$result=mysqli_query($coni,$str);
?>
                    <select name="sehir" id="sehir"   >
                      <OPTION SELECTED>Seçiniz
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
                <td align="right" class="govde">Talep Edilen Mal ve Hizmetin Tarifi :</td>
                <td class="govde">
                  <textarea cols="50" name="text"  onKeyDown="textCounter(this.form.text,this.form.remLen,500)" onKeyUp="textCounter(this.form.text,this.form.remLen,500)" rows="10" wrap="soft"style="font-family: Arial; font-size: 8pt;" onBlur="replaceChars(this.value,'text');"></textarea>
                  <br>
                  Kalan karakter sayısı:
                  <input name="remLen" type="text" value="500" size="6"  maxlength=3 readonly >
                </td>
              </tr>
              <!-- Aktif hale gelirse formdaki silinecek
              <tr >
              <td width="240" align="right" class="govde">İlgili kaç üyemize gönderilsin?</td>
                        <td width="259"><select name="MesajNum" size="1" id="MesajNum">
                            <option value="200" >En fazla 200</option>
                            <option value="300">En fazla 300</option>
                            <option value="3000" selected>Hepsine</option>
                            </select>
                        </td>
                    </tr> -->
              <tr>
                <td  align="center"colspan="2"  bgcolor="#F6F6F6" valign="middle" ><span class="aciklama"><strong><img src="image/iptalet.gif" width="146" height="16" class="ResimDugme" onClick="Iptal()" ><strong><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </strong></strong><strong><img src="image/ilerle.gif" width="146" height="16" onClick="Gonder()" class="ResimDugme"></strong></strong></span> </td>
              </tr></form>
                </table></td>
              </tr>
            </table>
      </tr>
    </table></td>
  </tr>
 
</table>
<div id="dialog-sifreunut" title="Uyarı" style="display:none" class="text_g" >
  <p>
    <span>Hata mesajları...</span>
  </p>
</div>
</div>
</BODY></HTML>
<script language="javascript">
/*	var now = new Date();
	if (now.getDate() <9)
		document.forms.frmYonKullanim.gun.value =  "0" + (now.getDate() +1)
	else	
		document.forms.frmYonKullanim.gun.value = now.getDate() +1;
	if (now.getMonth() <9)
		document.forms.frmYonKullanim.ay.value = "0" + (now.getMonth() + 1);
	else
		document.forms.frmYonKullanim.ay.value = now.getMonth() + 1;
	
	document.forms.frmYonKullanim.yil.value = now.getFullYear();
*/
</script>