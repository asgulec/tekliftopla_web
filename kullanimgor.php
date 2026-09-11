<?php include "headeri.php";?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="content-language" content="tr" />
<title>tekliftopla</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
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
    <table width="97%px" align="center"  cellspacing="0" cellpadding="0" border="0" bgColor=white >
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td colspan="4" height="2" bgcolor="#FFFFFF"></td>
            </tr>
            <tr height="25px">
              <td width="25%"><img src="image/5/2-2.gif"></td>
              <td width="25%" ></td>
              <td valign="middle" width="43%" align="right" class="title">Teklif Talebi Onay</td>
              <td valign="bottom" align="right" width="7%" ><img src="image/sag_ok.gif"></td>
            </tr>
          </table></td>
      </tr>
      <tr>
        <td height="10px"></td>
      </tr>
      <tr>
        <td width="97%" valign="top" bgcolor="#F6F6F6"><?php $verified_firma = isset($_SESSION["verified_firma"]) ? $_SESSION["verified_firma"] : '';?>
          <span class="Baslik" > Teklif talebiniz ilgili tedarikçilere gönderilecektir. Lütfen kontrol ediniz.</span></td>
      </tr>
      <tr>
        <td height="10px" ></td>
      </tr>
      <tr>
        <td><table width="95%"  border="0" align="center" cellpadding="3" cellspacing="5"  >
            <form action="emaililk.php" method="post" name="LoginForm">
              <TR>
                <?php //************kullan&yacute;m bilgilerini g&ouml;r&uuml;nt&uuml;leme
$verified_kulid = isset($_SESSION["verified_kulid"]) ? $_SESSION["verified_kulid"] : '';
$str="SELECT * FROM  kullanim  where Kullanimid='$verified_kulid'";
$result=mysqli_query($connection,$str);
while ($row = mysqli_fetch_array($result)){
?>
              <TR>
                <td  align="right" class="govde">Kayıt Numaranız  :</td>
                <td  class="govde"><span class="title_kucuk"><?php echo $verified_kulid;?></span></td>
              </TR>
              <TR>
                <td  align="right" class="govde">Teklif Toplama Y&ouml;ntemi :</td>
                <td  class="govde"><?php echo  $row['iletisim'] ?></td>
              </TR>
              <TR>
                <td  align="right" class="govde">En Son Teklif Verme Tarihi    :</td>
                <td   class="govde"><?php $range=$row['tarih'];
$zaman1=explode("-",$range);
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
	
echo $zaman1[2]."-".$zaman1[1]."-".$zaman1[0];?></td>
              </TR>
              <TR>
                <td  align="right" class="govde">Mal - Hizmetin Teslim S&uuml;resi    :</td>
                <td  class="govde" ><?php echo $row['sure']?></td>
              </TR>
              <TR>
                <td align="right"  valign="top" class="govde">Talep Edilen <br>Mal veya Hizmetin Tarifi    :</td>
                <td width="60%" class="govde">
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
print (wrap_text($metin,72));

}?>
                </td>
              </TR>
              <TR>
                <td  align="right" class="govde">Mal veya Hizmetin Teslim Yeri    :</td>
                <td class="govde">
				<?php 
$verified_sehirid = isset($_SESSION["verified_sehirid"]) ? $_SESSION["verified_sehirid"] : '';
$strq="SELECT sehir FROM  sehir where sehirid='$verified_sehirid'";
$resultq=mysqli_query($connection,$strq);
while ($rowq = mysqli_fetch_array($resultq)){
 echo $rowq['sehir'];}?> </td>
              </TR>
              <td  colspan="2" align="right" class="govde">&nbsp; &nbsp; &nbsp; &nbsp;</td>
                </tr>
              <tr>
                <td  align="center"colspan="2"  valign="middle" ><a href="giris.php" class="buttonPage"> İptal &nbsp;<i class="icon-close" ></i></a><img src= "image/trans.gif" alt="" width="20" height="1"><a href="#here" onClick="Degistir()" class="buttonPage"> Değiştir &nbsp;<i class="icon-arrow-left"></i></a><img src= "image/trans.gif" alt="" width="20" height="1"><a href="#here" onClick="Gonder()" class="buttonPage"> Gönder &nbsp;<i class="icon-arrow-right"></i></a>
				</td>
              </tr>
			</form>
            <form action="kuldegis.php" method="post" name="frmDegistir" id="frmDegistir"></form>
            </TABLE></td>
      </tr>
      <tr>
      <td align="center" valign="middle" height="15px" ></td></tr>
    </table>
  </div>
  <div id="bant1"></div>
  <div id="alt">
    <?php include "alt.php" ?>
  </div>
</div>
</BODY></HTML>
<script language="javascript">
function Gonder(){
	document.forms.LoginForm.submit();
}
function Degistir(){
	document.forms.frmDegistir.submit();
}

</script>

