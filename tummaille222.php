<?php include"headeryon.php"; ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="content-language" content="tr" />
<title>tekliftopla</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<script>function CheckAll()
{
 for (var i=0;i<document.LoginForm.elements.length;i++)
 {
  var e=document.LoginForm.elements[i];
  if (e.name != 'allbox')
   e.checked=document.LoginForm.allbox.checked;
 }
}</script>
<div id="sayfa">
  <div id="ust">
    <?php include "ust.php" ?>
  </div>
  <div id="bant1"></div>
  <div id="sol">
    <?php include "solyonetim.php" ?>
  </div>
  <div id="analong">
     <table width="100%"  cellspacing="0" cellpadding="0" border="0" bgColor=white >
            <tr>
              <td width="550" height="436" valign="top" >
               <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td colspan="4" height="2" bgcolor="#FFFFFF"></td>
                  </tr>
                  <tr  >
                    <td height="30" width="191" ></td>
                    <td width="95" align="center" class="Baslik" valign="bottom"></td>
                    <td width="242" valign="middle" align="right" class="Baslik">Mal veya Hizmet Teklif Talebi</td>
                    <td width="27" ><img src="image/sag_ok.gif" width="27" height="64"></td>
                  </tr>
                </table>
                <span class="title_kucuk">Sayın </span>
                <?php $verified_user = isset($_SESSION["verified_user"]) ? $_SESSION["verified_user"] :''; echo $verified_user;?>
                <span class="title_kucuk">, lütfen teklif bilgilerini kontrol ediniz.</span>
                <form action="yonetimsektorgruplari.php" method="post" name="LoginForm">
                <table width="95%"  border="0" align="center" cellpadding="2" cellspacing="0"  bordercolor="#F6F6F6"  bgcolor="#EAEAEA">
                  
                    <tr>
                      <td width="224"  align="right" class="govde"><span class="govde">Teklif İsteyen Üye     :</span></td>
                      <td><span class="govde">
                        <?
$teklifid=$_GET["teklifid"];
$_SESSION['verified_kulid']=$teklifid;
$_SESSION['verified_teklifid']=$teklifid;
$_SESSION['kontrol']=1;


$stryy1="SELECT  bilgi.*, kullanim.Kullanimid FROM kullanim,bilgi where kullanim.firmaid=bilgi.firmaid and kullanim.Kullanimid='$teklifid'";
$resultyy1=mysqli_query($coni,$stryy1);
while ($rowyy1 = mysqli_fetch_array($resultyy1)){
$firmid = $rowyy1['firmaid'];
$smail=$rowyy1['email'];
echo "<input type=hidden name='smail' value='$smail'>";
$teklifid=$rowyy1['Kullanimid'];
echo $rowyy1['Firma_Adi'];
$ad=$rowyy1['Firma_Adi'];
echo "<input type=hidden name='sfirma' value='$ad'>";
$adres1=$rowyy1['Adres'];	
echo "<input type=hidden name='adres1' value='$adres1'>";
$syetkili=$rowyy1['yetkili'];
echo "<input type=hidden name='syetkili' value='$syetkili'>";
$telefon=$rowyy1['Telefon'];
echo "<input type=hidden name='telefon' value='$telefon'>";
$fax=$rowyy1['Fax'];
echo "<input type=hidden name='fax' value='$fax'>";
$afax=$rowyy1['fax_alankodi'];
echo "<input type=hidden name='afax' value='$afax'>";
$atel=$rowyy1['tel_alankodi'];
echo "<input type=hidden name='atel' value='$atel'>";?>
                        </span></td>
                    </TR>
                    <TR>
                      <td  align="right" class="govde"><span class="govde">Teklif No     :</span></td>
                      <td><span class="govde"><?php echo $teklifid;?></span></td>
                    <TR>
                      <td  align="right" class="govde"><span class="govde">E-Posta Adresi     :</span></td>
                      <td  ><span class="govde"><?php echo $smail;}?></span></td>
                    </TR>
                    <span class="govde">
                    <?php //************kullan&yacute;m bilgilerini g&ouml;r&uuml;nt&uuml;leme
$str="SELECT * FROM  kullanim where Kullanimid='$teklifid'";
$result=mysqli_query($coni,$str);
while ($row = mysqli_fetch_array($result)){
?>
                    </span>
                    <TR>
                      <td  align="right" class="govde""><span class="govde">Teklif Toplama Y&ouml;ntemi     :</span></td>
                      <td ><span class="govde">
                        <?php $ilet=$row['iletisim'];
echo "<input type=hidden name='iletisim' value='$ilet'>";
echo  $row['iletisim'];?>
                        </span></td>
                    </TR>
                    <TR>
                      <td  align="right" class="govde"><span class="govde">En Son Teklif Verme Tarihi     :</span></td>
                      <td  ><span class="govde">
                        <?
$tari=$row['tarih'];
echo "<input type=hidden name='tarih' value='$tari'>";

echo date("d-m-Y", strtotime($row['tarih']));
?>
                        </span></td>
                    </TR>
                    <TR>
                      <td  align="right" class="govde"><span class="govde">Mal veya Hizmetin Teslim S&uuml;resi     :</span></td>
                      <td  ><span class="govde">
                        <?php $tar=$row['sure'];
echo "<input type=hidden name='sure' value='$tar'>";
	echo $row['sure'];?>
                        </span></td>
                    </TR>
                    <TR>
                      <td align="right"  valign="top" class="govde"><span class="govde">Talep Edilen Mal ve Hizmetin Tarifi     :</span></td>
                      <td width="276"><span class="govde">
                        <?php
	function isBlank ($string) { 
        if ($string == " ") return true; 
        for ($i = 0; $i < strlen($string); $i++) { 
                $c = substr($string, $i, 1); 
                if (($c != "\r") && ($c != " ") && ($c != "\n")&& ($c != "\t")) { 
                        return false; 
                } 
        } 
        return true; 
} 

function wrap_text($text, $wrap) { 
       if (isBlank($text)) return; 
        if (!is_integer($wrap)) return $text; 
        $text_array = explode("\n", $text); 
        $i = $j = 0; 
        while ($i < sizeof($text_array)) { 
                $text_array[$i] = preg_replace("/\s/", " ", $text_array[$i]); 
                $length = strlen($text_array[$i]); 
                if ($length <= $wrap) { 
                        $new_text_array[$j] = $text_array[$i]; 
                        $i++; 
                } 
                else { 
                        $tmp = substr($text_array[$i], 0, $wrap); 
                        $spacePos = strrpos($tmp, " "); 
                        if ($spacePos > 0) { 
                                $new_text_array[$j] = substr($text_array[$i], 0, $spacePos+1); 
                                $new_text_array[$j] = ltrim($new_text_array[$j]); 
                                $text_array[$i] = substr($text_array[$i], $spacePos+1); 
                        } 
                        else { 
                                $new_text_array[$j] = $tmp; 
                                $text_array[$i] = substr($text_array[$i], $wrap); 
                        } 
                } 
                $j++; 
        } 
        return (implode("\n", $new_text_array)); 
} 

$string=$row['text']; 
$metin1=str_replace("<script","",$string);
$metin1=str_replace("<style","",$string);
$metin1=str_replace("<embed","",$string);
$metin=nl2br($metin1);
$string1=wrap_text($metin,72);
print (wrap_text($metin,72));
echo "<input type=hidden name='metin' value='$string1'>";
}?>
                        </span></td>
                    </TR>
                    <TR>
                      <td  align="right" valign="top" class="govde"><span class="govde">Mal veya Hizmetin Teslim Yeri/Ülke:</span></td>
                      <td><span class="govde">
                        <?php 
$strq="SELECT sehir.sehir, sehir.sehirid, kullanim.ulke FROM  sehir,kullanim where kullanim.sehirid=sehir.sehirid and kullanim.Kullanimid='$teklifid'";
$resultq=mysqli_query($coni,$strq);
while ($rowq = mysqli_fetch_array($resultq)){
	$city=$rowq['sehir'];
	echo "<input type=hidden name='sehir' value='$city'>";
	echo $rowq['sehir']." - ".$rowq['ulke'];
	$verified_sehirid = $rowq["sehirid"];	
	$_SESSION['verified_sehirid']=$verified_sehirid;
	//session_register("verified_sehirid");
}?>
                        </span></td>
                    </TR>
                    <tr>
                      <td  align="right" valign="top" class="govde"><span class="govde">Üyenin Kayıtlı Olduğu Sektörler :</span></td>
                      <td valign="top" class=govde ><?php
	  $sekrow="select a.sektor from sektorler as a, firma_sektor as b where b.firmaid='$firmid' and a.sektorid = b.sektorid";
	  $sekdok=mysqli_query($coni,$sekrow);
	  while ($sekler = mysqli_fetch_array($sekdok))
      { echo $sekler['sektor']; ?>
                        /
                        <?php }
	  ?></td>
                    </tr>
                      <tr>
                      <td align="right" class="govde">Kısa Tarif:</td>
                      <td class="govde">
                      <input type="text" maxlength="200" size="40" id="textshort" name="textshort"> 
                      </td></TR>  
                    <tr>
                      <td align="center" colspan="2" class="aciklama" bgcolor="#FFFFFF" height="30" valign="middle"><span class="aciklama"><strong><img src="image/ilerle.gif" width="147" height="16" class="ResimDugme" onClick="Gonder()" ></strong></span></td>
                    </TR>
                  
                </TABLE></form>
                <table width="95%"  border="0" align="center" cellpadding="2" cellspacing="0"  bordercolor="#F6F6F6"  bgcolor="#EAEAEA">
                  <tr>
                    <td align="center"  class="aciklama" bgcolor="#FFFFFF" height="30" valign="middle"><form action="emailiptal.php?teklifid=<?=$teklifid?>" method="post" name="frmIptal" id="frmIptal"><img src="image/iptalet.gif" width="146" height="16" class="ResimDugme" onClick="Iptal()" ></form></td>
                    <td align="center"  class="aciklama" bgcolor="#FFFFFF" height="30" valign="middle"><form action="emailiptdog.php?teklifid=<?=$teklifid?>" method="post" name="frmDogiptal" id="frmDogiptal"><img src="image/iptaletd.png" width="146" height="16" class="ResimDugme" onClick="Iptald()" ></form></td>
                    <td align="center"  class="aciklama" bgcolor="#FFFFFF" height="30" valign="middle"><form action="emailiptmes.php?teklifid=<?=$teklifid?>" method="post" name="frmMesaj" id="frmMesaj"><img src="image/iptaletmesaj.gif" width="146" height="16" class="ResimDugme" onClick="Mesaj()" ></form></td>
                  </tr>
                  <tr>
                    <td colspan="3" align="center" class="aciklama" bgcolor="#FFFFFF" height="30" valign="middle"><img src="image/yonetici.gif" width="146" height="16" class="ResimDugme" onClick="ilerle()" ></td>
                  </tr>
                </table>
            </tr>
          </table>
          
  </div>
  <div id="bant1"></div>
  
</div>
</BODY>
</HTML>

<script language="javascript">
function Gonder()
{
	document.forms.LoginForm.submit();
}
function Iptal()
{
	document.forms.frmIptal.submit();
}
function Iptald()
{
	document.forms.frmDogiptal.submit();
}
function Mesaj()
{
	document.forms.frmMesaj.submit();
}
function ilerle() 
 {
  window.location="yonetimgiris.php";
 }
</script>