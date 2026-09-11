<?php include "headeryon.php"?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="content-language" content="tr" />
<title>tekliftopla</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php 
$teklifnumber1=trim($_POST["teklifnumber"]);
$stryy134="SELECT  bilgi.* FROM kullanim,bilgi where kullanim.firmaid=bilgi.firmaid  and kullanim.Kullanimid='$teklifnumber1'";
$resultyy134=mysqli_query($coni,$stryy134);
$bul=mysqli_num_rows($resultyy134);
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
        <td valign="top" bgcolor="#f6f6f6">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td colspan="4" height="2" bgcolor="#FFFFFF"></td>
            </tr>
            <tr  >
              <td background="image/yeni_orta.gif" height="50" width="171" >&nbsp;</td>
              <td background="image/yeni_orta.gif" width="223" align="center" class="Baslik" valign="bottom">Mal veya Hizmet Teklif Talebi </td>
              <td background="image/yeni_orta.gif" width="134" valign="middle" align="right" class="Buyuk_Yazi">&nbsp;</td>
              <td background="image/yeni_orta.gif" width="27" ><img src="image/sag_ok.gif" width="27" height="64"></td>
            </tr>
          </table>
          <span class="title_kucuk">Sayın <?php  $verified_user = $_SESSION["verified_user"]; echo $verified_user;?>,</span>
          <span class="title_kucuk">teklif talebi bilgilerinizi kontrol ediniz.</span>
          <table width="95%"  border="0" align="center" cellpadding="2" cellspacing="0"  bordercolor="#F6F6F6"  bgcolor="#EAEAEA">
            <form action="teklifbul.php" method="post" name="LoginForm">
              <?php if($bul){?>
              <tr>
                <td  class="govde" align="right">Teklif İsteyen Firma:</td>
                <td class="govde">
                  <?php while ($rowyy134 = mysqli_fetch_array($resultyy134)){
echo $rowyy134['Firma_Adi'];?></td>
              </tr>
              <tr>
                <td  class="govde" align="right">E-Posta Adresi:</td>
                <td class="govde"><?php echo $rowyy134['email'];?></td>
              </tr>
              <tr>
                <td  class="govde" align="right">Telefon:</td>
                <td class="govde"><?php echo $rowyy134['tel_alankodi']."    ".$rowyy134['Telefon'];?></td>
              </tr>
              <tr>
                <td  class="govde" align="right">Yetkili:</td>
                <td class="govde"><?php echo $rowyy134['yetkili'];}?></td>
              </tr>
              <?php //************kullan&yacute;m bilgilerini g&ouml;r&uuml;nt&uuml;leme
$str134="SELECT * FROM  kullanim where Kullanimid='$teklifnumber1'";
$result134=mysqli_query($coni,$str134);
while ($row134 = mysqli_fetch_array($result134)){
?>
              <tr>
                <td  class="govde" align="right">Başvuru Adresi:</td>
                <td class="govde" > <?php echo  $row134['iletisim'];?></td>
              </tr>
              <tr>
                <td  class="govde" align="right">En Son Teklif Verme Tarihi:</td>
                <td class="govde"  ><?php  $zaman8=$row134['tarih'];
	$zaman9=explode("-",$zaman8);
$tarih1=$zaman9[2]."-".$zaman9[1]."-".$zaman9[0];
echo $tarih1;?></td>
              </tr>
              <tr>
                <td  class="govde" align="right">Mal veya Hizmetin Teslim S&uuml;resi:</td>
                <td class="govde"  ><?php	echo $row134['sure'];?></td>
              </tr>
              <tr>
                <td  valign="top" class="govde" align="right" width="200">Talep Edilen Mal ve Hizmetin Tarifi:</td>
                <td width="300" class="govde">
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

$string=$row134['text']; 
$metin1=str_replace("<script","",$string);
$metin1=str_replace("<style","",$string);
$metin1=str_replace("<embed","",$string);
$metin=nl2br($metin1);
print (wrap_text($metin,72));
}?>
                </td>
              </tr>
              <tr>
                <td  class="govde" align="right">Mal veya Hizmetin Teslim Yeri:</td>
                <td class="govde">
                  <?php $strq134="SELECT sehir.sehir FROM  sehir,kullanim where kullanim.sehirid=sehir.sehirid and kullanim.Kullanimid='$teklifnumber1'";
$resultq134=mysqli_query($coni,$strq134);
while ($rowq134 = mysqli_fetch_array($resultq134)){
echo $rowq134['sehir'];}?></td>
              </tr>
              <tr>
              <td  class="govde" align="right" width="200">Talebin G&ouml;nderildiği Sekt&ouml;rler:</td>
              <td width="300" class="govde"><?php 
//************sekt&ouml;rleri g&ouml;r&uuml;nt&uuml;leme
$str113400="SELECT distinct sektorler.* FROM kulsektor,sektorler where kulsektor.Kullanimid='$teklifnumber1' and sektorler.sektorid=kulsektor.sektorid order by sektorler.sektor";
$result113400=mysqli_query($coni,$str113400);
while($row113400 = mysqli_fetch_array($result113400))
{
echo $row113400['sektor'];
echo "<br>";}?></td>
            </tr>
              <tr>
                <td  colspan="2" class="govde" align="center" width="300">Teklif talebi 
				<?php 
				$str11="SELECT distinct bilgi.Firma_Adi,bilgi.email FROM bilgi,kulfirmaid where kulfirmaid.kullanimid='$teklifnumber1' and 		bilgi.firmaid=kulfirmaid.firmaid and bilgi.aktivite='1'";
				$result11=mysqli_query($coni,$str11);
				$num_rows = mysqli_num_rows($result11);
				echo "$num_rows"; ?> üyeye gönderildi.</td> 
                </tr>
            <tr>
              <td colspan="2" class="govde">
                <table width="400" border="0" align="center">
                <?php
//************firmalar&yacute; g&ouml;r&uuml;nt&uuml;leme
$count=1;
$column=1;
$str1="SELECT distinct bilgi.Firma_Adi,bilgi.email FROM bilgi,kulfirmaid where kulfirmaid.kullanimid='$teklifnumber1' and bilgi.firmaid=kulfirmaid.firmaid and bilgi.aktivite='1'";
$result1=mysqli_query($coni,$str1);
while ($row1 = mysqli_fetch_array($result1))
{
if ($column==1)
{
printf("<tr><td>%s</td>",$row1['Firma_Adi']);
}
else{
printf("<td>%s</td></tr>",$row1['Firma_Adi']);
}
$count+=1;
$column = $count%2;
}?></table></td>
            </tr>
              <?php }
else
{
$stryy13401="SELECT  kullanim.*,yonetim.* FROM kullanim,yonetim where kullanim.firmaid=yonetim.yonid and kullanim.Kullanimid='$teklifnumber1'";
$resultyy13401=mysqli_query($coni,$stryy13401);
$bul21=mysqli_num_rows($resultyy13401);
if($bul21){?>
              <tr>
                <td  class="title_kucuk" colspan="2" align="center">Yönetici İlanı </td>
                <td>           
              </tr>
              <tr>
                <td  class="govde" align="right">Talep Yapan Y&ouml;netici:</td>
                <td class="govde">
                  <?php while ($rowyy13401 = mysqli_fetch_array($resultyy13401)){
echo $rowyy13401['username'];}?></td>
              </tr>
              <?php //************kullan&yacute;m bilgilerini g&ouml;r&uuml;nt&uuml;leme
$str134444="SELECT * FROM  kullanim where Kullanimid='$teklifnumber1'";
$result134444=mysqli_query($coni,$str134444);
while ($row134444 = mysqli_fetch_array($result134444)){
?>
              <tr>
                <td  class="govde" align="right">Teklif Toplama Y&ouml;ntemi:</td>
                <td class="govde" > <?php echo $row134444['iletisim'];?></td>
              </tr>
              <tr>
                <td  class="govde" align="right">En Son Teklif Verme Tarihi:</td>
                <td class="govde"  ><?php echo $row134444['tarih'];?></td>
              </tr>
            
            <td  valign="top" class="govde" align="right" width="200">Talep Edilen Mal ve Hizmetin Tarifi:</td>
                <td width="300" class="govde">
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

$string=$row134444['text']; 
$metin1=str_replace("<script","",$string);
$metin1=str_replace("<style","",$string);
$metin1=str_replace("<embed","",$string);
$metin=nl2br($metin1);
print (wrap_text($metin,72));
}?>
                </td>
            </tr>
            <tr>
              <td  class="govde" align="right">Mal veya Hizmetin Teslim Yeri:</td>
              <td class="govde">
                <?php $strq134000="SELECT sehir.sehir FROM  sehir,kullanim where kullanim.sehirid=sehir.sehirid and kullanim.Kullanimid='$teklifnumber1'";
$resultq134000=mysqli_query($coni,$strq134000);
while ($rowq134000 = mysqli_fetch_array($resultq134000)){
echo $rowq134000['sehir'];}?>
              </td>
            </tr>
            <tr>
              <td  class="govde" align="right" width="200">Talebin G&ouml;nderildiği Sekt&ouml;rler:</td>
              <td width="300" class="govde"><?php 
//************sekt&ouml;rleri g&ouml;r&uuml;nt&uuml;leme
$str113400="SELECT distinct sektorler.* FROM kulsektor,sektorler where kulsektor.Kullanimid='$teklifnumber1' and sektorler.sektorid=kulsektor.sektorid order by sektorler.sektor";
$result113400=mysqli_query($coni,$str113400);
while($row113400 = mysqli_fetch_array($result113400))
{
echo $row113400['sektor'];
echo "<br>";} ?> </td>
            </tr>
            <tr>
                <td  colspan="2" class="govde" align="center" width="300">Teklif talebi 
				<?php 
				$str11="SELECT distinct bilgi.Firma_Adi,bilgi.email FROM bilgi,kulfirmaid where kulfirmaid.kullanimid='$teklifnumber1' and 		bilgi.firmaid=kulfirmaid.firmaid and bilgi.aktivite='1'";
				$result11=mysqli_query($coni,$str11);
				$num_rows = mysqli_num_rows($result11);
				echo "$num_rows"; ?> üyeye gönderildi.</td> 
                </tr>
            <tr>
              <td colspan="2" class="govde">
                <table width="400" border="0" align="center">
                <?php
//************firmalar&yacute; g&ouml;r&uuml;nt&uuml;leme
$count=1;
$column=1;
$str1="SELECT distinct bilgi.Firma_Adi,bilgi.email FROM bilgi,kulfirmaid where kulfirmaid.kullanimid='$teklifnumber1' and bilgi.firmaid=kulfirmaid.firmaid and bilgi.aktivite='1'";
$result1=mysqli_query($coni,$str1);
while ($row1 = mysqli_fetch_array($result1))
{
if ($column==1)
{
printf("<tr><td>%s</td>",$row1['Firma_Adi']);
}
else{
printf("<td>%s</td></tr>",$row1['Firma_Adi']);
}
$count+=1;
$column = $count%2;
}?></table></td>
            </tr>
            <?php }
else{?>
            <tr>
              <td  colspan="2" class="info" align="center"><span class="not"><br>
      Bu teklif numarası yanlış veya 13 aydan eski bir teklif talebine aittir.</span><br>
      <br></td>
	  
            </tr>
            <?php }}?>
			                <tr>
                  <td colspan="2" align="center" class="aciklama" bgcolor="#F6F6F6" height="50" valign="middle"><img src="image/but_yeni_aramayap.gif" width="146" height="16" class="ResimDugme" onClick="Gonder()" ><img src= "image/trans.gif" alt="" width="25px" height="1"><img src="image/but_girissayfasinailerle.gif" width="144" height="16" class="ResimDugme" onClick="ilerle()" ></td>
                </tr>
</form>
          </table>
        </tr>
    </table>
 
 </div>
  <div id="bant1"></div> <!-- bant2 -->
  
</div>
</BODY></HTML>
<script language="javascript">
 function Gonder() 
 {
  document.forms.LoginForm.submit();
 }
 function ilerle() 
 {
  window.location="yonetimgiris.php";
 }

</script>