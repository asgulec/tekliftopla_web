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

<table width="100%"  cellspacing="0" cellpadding="0" border="0" bgColor="white" >
      <tr>
        <td>
		  <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td colspan="4" height="2" bgcolor="#FFFFFF"></td>
            </tr>
            <tr >
              <td height="50" width="191" ><img src="image/5/5_5.gif" width="176" height="64"></td>
              <td width="183" align="center" class="Baslik" valign="bottom"></td>
              <td width="154" valign="middle" align="right" class="Baslik" >Kontrol</td>
              <td width="27" ><img src="image/sag_ok.gif" width="27" height="64"></td>
            </tr>
          </table></td></tr>
          <tr><td>
          <span class="title_kucuk">Sayın </span><? $verified_user = isset($_SESSION["verified_user"]) ? $_SESSION["verified_user"] : ''; echo $verified_user;?><span class="title_kucuk">, lütfen teklif bilgilerini kontrol ediniz.</span> </td></tr>
          <tr><td>
          <table width="95%"  border="0" align="center" cellpadding="2" cellspacing="0"  bordercolor="#F6F6F6"  bgcolor="#EAEAEA">
<? $verified_teklifid = isset($_SESSION["verified_teklifid"]) ? $_SESSION["verified_teklifid"] : '';  ?>
            <form action="tummaillereklam.php?teklifid=<?=$verified_teklifid?>" method="post" name="LoginForm">
			<tr>
              <td  align="right" class="govde"><span class="govde">Teklif İsteyen Firma     :</span></td>
                <td class="govde">
                  <span class="govde">
                  <?
$stryy1="SELECT  bilgi.*, kullanim.Kullanimid FROM kullanim,bilgi where kullanim.firmaid=bilgi.firmaid and kullanim.Kullanimid='$verified_teklifid'";
$resultyy1=mysqli_query($coni,$stryy1);
while ($rowyy1 = mysqli_fetch_array($resultyy1)){
$smail=$rowyy1['email'];
//echo "<input type=hidden name='smail' value='$smail'>";
$verified_teklifid=$rowyy1['Kullanimid'];
//echo $rowyy1['Firma_Adi'];
$ad=$rowyy1['Firma_Adi'];
//echo "<input type=hidden name='sfirma' value='$ad'>";
$firmaid=$rowyy1['firmaid'];
//echo "<input type=hidden name='sfirmaid' value='$firmaid'>";
$adres1=$rowyy1['Adres'];	
//echo "<input type=hidden name='adres1' value='$adres1'>";
$syetkili=$rowyy1['yetkili'];
//echo "<input type=hidden name='syetkili' value='$syetkili'>";
$telefon=$rowyy1['Telefon'];
//echo "<input type=hidden name='telefon' value='$telefon'>";
$fax=$rowyy1['Fax'];
//echo "<input type=hidden name='fax' value='$fax'>";
$afax=$rowyy1['fax_alankodi'];
//echo "<input type=hidden name='afax' value='$afax'>";
$atel=$rowyy1['tel_alankodi'];
//echo "<input type=hidden name='atel' value='$atel'>";
echo $ad;?>
                  </span></td>
            </TR>
            <TR>
              <td  align="right" class="govde"><span class="govde">Teklif No     :</span></td>
              <td class="govde"><span class="govde"><?php echo $verified_teklifid;?></span></td>
            <TR>
              <td  align="right" class="govde"><span class="govde">E-Posta Adresi     :</span></td>
              <td  ><span class="govde"><?php echo $smail;}?></span></td>
      
            </TR>
            <span class="govde">
            <?php //************kullanıcı bilgilerini görüntüleme
$str="SELECT * FROM  kullanim where Kullanimid='$verified_teklifid'";
$result=mysqli_query($coni,$str);
while ($row = mysqli_fetch_array($result)){
$ulkek=$row['ulke'];
$dilk=$row['dil'];
?>
            </span>
            <TR>
              <td  align="right" class="govde""><span class="govde">Teklif Toplama Y&ouml;ntemi     :</span></td>
              <td >
                <span class="govde">
                  <? $ilet=$row['iletisim'];
//echo "<input type=hidden name='iletisim' value='$ilet'>";
echo  $row['iletisim'];?>
                  </span></td>
            </TR>
            <TR>
              <td  align="right" class="govde"><span class="govde">En Son Teklif Verme Tarihi :</span></td>
              <td  ><span class="govde">
                <?
$tari=$row['tarih'];
//echo "<input type=hidden name='tarih' value='$tari'>";
echo date("d-m-Y", strtotime($row['tarih']));
?>
              </span></td>
            </TR>
            <TR>
              <td  align="right" class="govde"><span class="govde">Mal veya Hizmetin Teslim Süresi :</span></td>
              <td  ><span class="govde">
                <?php $tar=$row['sure'];
//echo "<input type=hidden name='sure' value='$tar'>";
	echo $row['sure'];?>
              </span></td>
            </TR>
            <TR>
              <td align="right"  valign="top" class="govde"><span class="govde">Talep Edilen Mal ve Hizmetin Tarifi :</span></td>
              <td width="276"> <span class="govde">
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
        $new_text_array = array();
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
//echo "<input type=hidden name='metin' value='$string1'>";
}?>                  
                </span></td>
            </TR>
            <TR>
              <td  align="right" valign="top" class="govde"><span class="govde">Mal veya Hizmetin Teslim Yeri     :</span></td>
              <td>
                <span class="govde">
                <?php $strq="SELECT sehir.sehir FROM  sehir,kullanim where kullanim.sehirid=sehir.sehirid and kullanim.Kullanimid='$verified_teklifid'";
$resultq=mysqli_query($coni,$strq);
while ($rowq = mysqli_fetch_array($resultq)){
$city=$rowq['sehir'];
//echo "<input type=hidden name='sehir' value='$city'>";
 echo $rowq['sehir']." - ".$ulkek;}?>                
                </span></td>
            </TR>
            <tr>
              <td width="224"  align="right" valign="top" class="govde"><span class="govde">Teklif Talebinizi Duyurmak İstediği Sektörler :</span></td>
              <td width="276"><span class="govde">
                <?
//************sektörleri görüntüleme
$str113400="SELECT distinct sektorler.* FROM kulsektor,sektorler where kulsektor.Kullanimid='$verified_teklifid' and sektorler.sektorid=kulsektor.sektorid order by sektorler.sektor";
$result113400=mysqli_query($coni,$str113400);
while($row113400 = mysqli_fetch_array($result113400))
{
echo $row113400['sektor'];
echo "<br>";}?>
              </span></td>
            </TR>
            <tr>
              <td  width="224"  align="right" valign="top" class="govde"><span class="govde">Teklif Talebinizi Duyurmak İstediği Firmalar :</span></td>
              <td width="276"><span class="govde">
                <?
//************firmaları görüntüleme
$verified_kulid = isset($_SESSION["verified_kulid"])?$_SESSION["verified_kulid"]:'';
$verified_sehirid = isset($_SESSION["verified_sehirid"])?$_SESSION["verified_sehirid"]:'';
$str6="insert into gecici3 (sektorid,kullanimid) SELECT distinct sektorid, Kullanimid FROM  kulsektor  where kulsektor.Kullanimid='$verified_kulid'";
$result6=mysqli_query($coni,$str6);
/* $str11="INSERT INTO gecici4 (firmaid,kullanimid) SELECT distinct firma_sektor.firmaid,gecici3.kullanimid FROM gecici3, firma_sektor where gecici3.sektorid=firma_sektor.sektorid and gecici3.kullanimid='$verified_kulid'";
$result11=mysql_db_query($db,"$str11");
$strp21="INSERT INTO gecici5 (firmaid,kullanimid) SELECT distinct firma_sehir.firmaid,kullanim.Kullanimid FROM firma_sehir,kullanim where firma_sehir.sehirid='$verified_sehirid' and firma_sehir.sehirid=kullanim.sehirid and kullanim.Kullanimid='$verified_kulid'";
$resultp21=mysql_db_query($db,"$strp21");
$str111="insert into gecici6 (firmaid,kullanimid) SELECT distinct gecici4.firmaid,gecici4.kullanimid FROM gecici4,gecici5 where gecici4.firmaid=gecici5.firmaid and  gecici4.kullanimid=gecici5.kullanimid and gecici4.kullanimid='$verified_kulid'"; */

if($ulkek=="TUR"){
$str111="insert into gecici6 (firmaid,kullanimid) SELECT distinct firma_sektor.firmaid, gecici3.kullanimid FROM gecici3, firma_sektor, firma_sehir, kullanim
where gecici3.sektorid=firma_sektor.sektorid 
and gecici3.kullanimid='$verified_kulid'
and  (firma_sehir.sehirid=kullanim.sehirid or firma_sehir.sehirid=999)
and kullanim.Kullanimid='$verified_kulid'
and firma_sehir.firmaid=firma_sektor.firmaid"; }
else {
$str111="insert into gecici6 (firmaid,kullanimid) SELECT distinct firma_sektor.firmaid, gecici3.kullanimid FROM gecici3, firma_sektor, kullanim, bilgi 
where gecici3.sektorid=firma_sektor.sektorid  
and gecici3.kullanimid='$verified_kulid' 
and kullanim.Kullanimid='$verified_kulid' 
and firma_sektor.firmaid=bilgi.firmaid 
and bilgi.lisan='Evet' "; }

$result111=mysqli_query($coni,$str111);
$str1="select distinct bilgi.Firma_Adi,bilgi.firmaid,bilgi.email from gecici6,bilgi where gecici6.firmaid=bilgi.firmaid and bilgi.aktivite='1' and bilgi.tekliftopla='1' and gecici6.kullanimid='$verified_kulid' order by bilgi.Firma_Adi";

$result1=mysqli_query($coni,$str1);
$sayif=mysqli_num_rows($result1);
while ($row1 = mysqli_fetch_array($result1))
{
$eposta=$row1['email'];
$id=$row1['firmaid'];
$mail=$id.'/'.$eposta;
echo "<input type=checkbox  name='tummail[]' value='$mail'>";
echo $row1['Firma_Adi'];
echo "<br>";}?>
</span></td></TR>
<tr><td></td><td bgcolor="silver" class="govde">
  <INPUT name="allbox" onclick="CheckAll()" type="checkbox" value="Check All">
  Tümünü Seç Adet <?php echo $sayif ?></td></tr>	
<tr>
<td align="center" colspan="2" class="aciklama" bgcolor="#FFFFFF" height="50" valign="middle"><img src="image/teklif_topla.gif" width="146" height="16" class="ResimDugme" onClick="Gonder()" ></td>
</TR>
</form>
</TABLE>
<table width="95%"  border="0" align="center" cellspacing="0"  bordercolor="#F6F6F6" >
            <tr>
              <td align="center"  class="aciklama" bgcolor="#FFFFFF" height="50" valign="middle">                
			  <form action="emailiptal.php?teklifid=<?=$verified_teklifid?>" method="post" name="frmIptal" id="frmIptal">
                     <img src="image/iptalet.gif" width="146" height="16" class="ResimDugme" onClick="Iptal()" >             
              </form></td>
            </tr>
          </table>
        </tr>
    </table></div>
  <div id="bant1"></div>
  <div id="alt">
    <?php include "alt.php" ?>
  </div>
</div>
</body>
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
</script>


