<?php include"headeryon.php"?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="content-language" content="tr" />
<title>..:: Teklif Toplama Sitesine Hosgeldiniz ::..</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
<body>

<table width="737" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" ><? include "ust.php"?></td>
  </tr>
  <tr>
    <td width="176" valign="top" ><? include "solyonetim.php";?></td>
    <td   valign="top"><table width="100%"  cellspacing="0" cellpadding="0" border="0" bgColor=white >
      <tr>
        <td valign="top" bgcolor="#f6f6f6">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td colspan="4" height="2" bgcolor="#FFFFFF"></td>
            </tr>
            <tr  >
              <td background="image/yeni_orta.gif" height="50" width="191" >&nbsp;</td>
              <td background="image/yeni_orta.gif" width="183" align="center" class="Baslik" valign="bottom">Mal veya Hizmet Teklif Talebi </td>
              <td background="image/yeni_orta.gif" width="154" valign="middle" align="right" class="Buyuk_Yazi">&nbsp;</td>
              <td background="image/yeni_orta.gif" width="27" ><img src="image/sag_ok.gif" width="27" height="64"></td>
            </tr>
          </table>
          <span class="title_kucuk">Sayın <? $verified_user= isset($_SESSION['verified_user']) ? $_SESSION['verified_user'] : ''; echo $verified_user;?>,</span>
          <span class="title_kucuk">teklif talebi bilgilerinizi kontrol ediniz.</span>
          <table width="95%"  border="0" align="center" cellpadding="2" cellspacing="0"  bordercolor="#F6F6F6"  bgcolor="#EAEAEA">
            <form action="teklifbul.php" method="post" name="LoginForm">
              <tr>
                <td  class="govde" align="right">Teklif İsteyen Firma:  </td>
                <td class="govde">
                  <?
$teklifnos= isset($_GET["teklifnos"]) ? $_GET["teklifnos"] : '';
$stryy1="SELECT  bilgi.*, kullanim.Kullanimid ,kullanim.Firma, kullanim.FirmaEPosta,kullanim.Firmailetisim FROM kullanim LEFT JOIN bilgi ON kullanim.firmaid = bilgi.firmaid  where kullanim.Kullanimid='$teklifnos'";
$resultyy1=mysqli_query($coni,$stryy1);
while ($rowyy1 = mysqli_fetch_array($resultyy1)){
if ($rowyy1['Firma_Adi'] =="")
{
	$smail=$rowyy1['FirmaEPosta'];
	echo $rowyy1['Firma'];
}
else	
{
	$smail=$rowyy1['email'];
	echo $rowyy1['Firma_Adi'];
}
?></td>
              </tr>
              <tr>
                <td  class="govde" align="right">E-Posta Adresi:</td>
                <td class="govde"><?echo $smail;?>&nbsp;</td>
              </tr>
              <tr>
                <td  class="govde" align="right">Telefon:</td>
                <td class="govde"><?echo $rowyy1['tel_alankodi']."    ".$rowyy1['Telefon'];?>&nbsp;</td>
              </tr>
              <tr>
                <td  class="govde" align="right">Yetkili:</td>
                <td class="govde"><?echo $rowyy1['yetkili'];}?>&nbsp;</td>
              </tr>
  <? //************kullanym bilgilerini görüntüleme
$str="SELECT * FROM  kullanim where Kullanimid='$teklifnos'";
$result=mysqli_query($coni,$str);
while ($row = mysqli_fetch_array($result)){
?>  
              <tr>
                <td  class="govde" align="right">Teklif Toplama Y&ouml;ntemi:</td>
                <td class="govde"> <?
				$ilet=$row['iletisim'];
echo "<input type=hidden name='iletisim' value='$ilet'>";
echo  $row['iletisim'];?>
                  &nbsp;</td>
              </tr>
              <tr>
                <td  class="govde" align="right">En Son Teklif Verme Tarihi:</td>
                <td class="govde" ><?
$tari=$row['tarih'];
echo "<input type=hidden name='tarih' value='$tari'>";
$rng=$row['tarih'];
$zama1=explode("-",$rng);
echo $zama1[2]."-".$zama1[1]."-".$zama1[0];
?>
                  &nbsp;</td>
              </tr>
              <tr>
                <td  class="govde" align="right">Mal veya Hizmetin Teslim S&uuml;resi:</td>
                <td class="govde" ><?php $tar=$row['sure'];
echo "<input type=hidden name='sure' value='$tar'>";
	echo $row['sure'];?>
                  &nbsp;</td>
              </tr>
              <tr>
                <td  valign="top" class="govde" align="right" width="300">Talep Edilen Mal ve Hizmetin Tarifi:</td>
                <td class="govde" width="300">
                  <?
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
&nbsp;                </td>
              </tr>
              <tr>
                <td  class="govde" align="right">Mal veya Hizmetin Teslim Yeri:</td>
                <td class="govde">
                  <? $strq="SELECT sehir.sehir FROM  sehir,kullanim where kullanim.sehirid=sehir.sehirid and kullanim.Kullanimid='$teklifnos'";
$resultq=mysqli_query($coni,$strq);
while ($rowq = mysqli_fetch_array($resultq)){
$city=$rowq['sehir'];
echo "<input type=hidden name='sehir' value='$city'>";
 echo $rowq['sehir'];}?>
                  &nbsp;</td>
              </tr>
              <tr>
              <td  class="govde" align="right">Talebin Gönderildiği Sektörler:</td>
              <td class="govde">
              <?
			  $str101="SELECT distinct sektorler.sektor FROM sektorler,kulsektor where kulsektor.Kullanimid='$teklifnos' and sektorler.sektorid=kulsektor.sektorid";
$result101=mysqli_query($coni,$str101);
while ($row101 = mysqli_fetch_array($result101))
{echo $row101['sektor'];
echo "<br>";}
			  ?> </td>
              <tr>
                <td  colspan="2" class="govde" align="center" width="300">Teklif talebi 
				<? 
				$str11="SELECT distinct bilgi.Firma_Adi,bilgi.email FROM bilgi,kulfirmaid where kulfirmaid.kullanimid='$teklifnos' and 		bilgi.firmaid=kulfirmaid.firmaid and bilgi.aktivite='1'";
				$result11=mysqli_query($coni,$str11);
				$num_rows = mysqli_num_rows($result11);
				echo "$num_rows"; ?> üyeye gönderildi.</td> 
                </tr>
                <tr>
                
                <td colspan="2" class="govde">
                <table width="450" border="0" align="center">
                  <?
//************firmalary görüntüleme
$count=1;
$column=1;
$str11="SELECT distinct bilgi.Firma_Adi,bilgi.email FROM bilgi,kulfirmaid where kulfirmaid.kullanimid='$teklifnos' and bilgi.firmaid=kulfirmaid.firmaid and bilgi.aktivite='1'";
$result11=mysqli_query($coni,$str11);
while ($row11 = mysqli_fetch_array($result11))
{
if ($column==1)
{
printf("<tr><td>%s</td>",$row11['Firma_Adi']);
}
else{
printf("<td>%s</td></tr>",$row11['Firma_Adi']);
}
$count+=1;
$column = $count%2;
}?>
                </table></td>
              </tr>
			                <tr>
                  <td colspan="2" align="center" class="aciklama" bgcolor="#FFFFFF" height="30" valign="middle"><img src="image/geri.gif" width="89" height="16" class="ResimDugme" onClick="Gonder()" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <img src="image/but_girissayfasinailerle.gif" width="144" height="16" class="ResimDugme" onClick="ilerle()" ></td>
                </tr>
</form>
          </table>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2"><? include "alt.php";?></td>
  </tr>
</table>
</BODY></HTML>
<script language="javascript">
 function Gonder() 
 {
  window.location="haftalikteklifler.php";
 }
 function ilerle() 
 {
  window.location="yonetimgiris.php";
 }

</script>