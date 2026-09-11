<?php include"headeryon.php"?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="content-language" content="tr" />
<title>tekliftopla</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
</head>
<SCRIPT LANGUAGE="JavaScript">
<!-- Begin
document.onkeypress = processKey;

function processKey(e)
{
  if (null == e)
    e = window.event ;
  if (e.keyCode == 13)  {
    LoginForm.submit() ;
  }
}
</script>
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
        <td>
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td colspan="4" height="2" bgcolor="#FFFFFF"></td>
            </tr>
            <tr >
              <td background="image/yeni_orta.gif" height="50" width="191" ><img src="image/5/5_4.gif" width="176" height="64"></td>
              <td background="image/yeni_orta.gif" width="183" align="center" class="Baslik" valign="bottom">&nbsp;</td>
              <td background="image/yeni_orta.gif" width="154" valign="middle" align="right" class="Buyuk_Yazi"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td align="right" class="Baslik">Teklif kontrol</td>
                </tr>
              </table>                </td>
              <td background="image/yeni_orta.gif" width="27" ><img src="image/sag_ok.gif" width="27" height="64"></td>
            </tr>
        </table></td>
      </tr>
      <tr>
        <td width="778" valign="top" bgcolor="#F6F6F6">
          <span class="title_kucuk">Sayın <? $verified_user = $_SESSION["verified_user"]; echo $verified_user;?>,</span> <span class="title_kucuk">teklif talebiniz  ilgili firmalara gönderilecektir. Lütfen kontrol ediniz.</span>
          <span class="title_kucuk">          </span>
            <table width="95%"  border="0" align="center" cellpadding="5" cellspacing="0"  bordercolor="#F6F6F6"  bgcolor="#EAEAEA">
          <form action="yonetimmail.php" method="post" name="LoginForm">
              <?php //************kullan&yacute;m bilgilerini g&ouml;r&uuml;nt&uuml;leme
$verified_kulid = $_SESSION["verified_kulid"];
$str="SELECT * FROM  kullanim  where Kullanimid='$verified_kulid'";
$result=mysqli_query($coni,$str);
while ($row = mysqli_fetch_array($result)){
$_SESSION["verified_sifre1"]=$row['session'];
$_SESSION["verified_firma"]=$row['Firma'];
$_SESSION["verified_sehirid"]=$row['sehirid'];
$verified_sifre1 = $_SESSION["verified_sifre1"];
$verified_firma = $_SESSION["verified_firma"];
?>
              <tr>
              <tr>
                <td  align="right" class="govde">Teklif Toplayan Firma:</td>
                <td class="govde" ><?php echo  $verified_firma?></td>
              </tr>
              <tr>
                <td  align="right" class="govde">Teklif Toplama Y&ouml;ntemi:</td>
                <td class="govde" ><?php echo  $row['iletisim']?></td>
              </tr>
              <tr>
                <td  align="right" class="govde">En Son Teklif Verme Tarihi:</td>
                <td class="govde"  ><?php 
				$range=$row['tarih'];
/* $zaman1=explode("-",$range);
if ($zaman1[1] == 1) { $zaman1[1] = "Ocak"; }
	if ($zaman1[1] == 2) { $zaman1[1] = "Şubat"; }
    if ($zaman1[1] == 3) { $zaman1[1] = "Mart"; }
    if ($zaman1[1] == 4) { $zaman1[1] = "Nisan"; }
    if ($zaman1[1] == 5) { $zaman1[1] = "Mayıs"; }
    if ($zaman1[1] == 6) { $zaman1[1] = "Haziran"; }
    if ($zaman1[1] == 7) { $zaman1[1] = "Temmuz"; }
    if ($zaman1[1] == 8) { $zaman1[1] = "Ağustos"; }
    if ($zaman1[1] == 9) { $zaman1[1] = "Eylül"; }
    if ($zaman1[1] == 10) { $zaman1[1] = "Ekim"; }
    if ($zaman1[1] == 11) { $zaman1[1] = "Kasım"; }
    if ($zaman1[1] == 12) { $zaman1[1] = "Aralık"; }
*/
	
echo  date("d-m-Y", strtotime($row['tarih']));/*$zaman1[2]."-".$zaman1[1]."-".$zaman1[0]; */?></td>
              </tr>
              <tr>
                <td  align="right" class="govde">Mal veya Hizmetin Teslim S&uuml;resi:</td>
                <td class="govde"  ><?php echo $row['sure']?></td>
              </tr>
              <tr>
                <td  valign="top" align="right" class="govde" width="200">Talep Edilen Mal ve Hizmetin Tarifi:</td>
                <td width="330" class="govde">                    <?
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
print (wrap_text($metin,72));

}?>                    </td>
              </tr>
              <tr>
                <td align="right" valign="top" class="govde"  lign="right"> Teslim Yeri / Ülke:</td>
                <td class="govde"><?php 
$verified_sehirid = $_SESSION["verified_sehirid"];
// $strq="SELECT sehir FROM  sehir where sehirid='$verified_sehirid'";
$strq="SELECT sehir.sehir, sehir.sehirid, kullanim.ulke FROM  sehir,kullanim where kullanim.sehirid=sehir.sehirid and kullanim.Kullanimid='$verified_kulid'";
$resultq=mysqli_query($coni,$strq);
while ($rowq = mysqli_fetch_array($resultq)){
 //echo $rowq['sehir'];
 echo $rowq['sehir']." - ".$rowq['ulke'];
 }?>
              </td>
              </tr>
              <tr>
                <td  align="right" class="govde" width="200">Teklif Talebinizi Duyurmak İstediğiniz Sekt&ouml;rler</td>
                <td width="330" class="govde">                    <?
//***************gecici3 tablosuna sektorid ve sehirid ekleme
$verified_kulid = $_SESSION["verified_kulid"];
$str5="SELECT distinct sektorid FROM  kulsektor  where kullanimid='$verified_kulid'";
$result5=mysqli_query($coni,$str5);
while ($row5=mysqli_fetch_array($result5)){
$sekid=$row5['sektorid'];
}
$str6="insert into gecici3 (sektorid,kullanimid) SELECT distinct sektorid, Kullanimid FROM  kulsektor  where kulsektor.Kullanimid='$verified_kulid'";
$result6=mysqli_query($coni,$str6);

//************sektorleri görüntüleme
$str1="SELECT distinct sektorler.sektor FROM kulsektor left join sektorler on kulsektor.sektorid=sektorler.sektorid where kulsektor.Kullanimid='$verified_kulid' order by sektorler.sektor";
$result1=mysqli_query($coni,$str1);
while ($row1 = mysqli_fetch_array($result1)){
echo ($row1['sektor']);
echo "<br>";}?>                    </td>
              </tr>
              <tr>
                <td height="50px"  align="center"colspan="2"  bgcolor="#F6F6F6" valign="middle" > <img src="image/degistir.gif" width="145" height="16" onClick="javascript:frmDegistir.submit()" class="ResimDugme"><img src= "image/trans.gif" alt="" width="20" height="1"><img src="image/ilerle.gif" width="146" height="16" onClick="javascript:LoginForm.submit()" class="ResimDugme"> </td>
              </tr>
          </form>
            <form action="yonetimdegis.php" method="post" name="frmDegistir">
             
           </form>
            </table>
      </tr>
    </table>
  </div>
  <div id="bant1"></div> <!-- bant2 -->
  
</div>
</body>
</HTML>


