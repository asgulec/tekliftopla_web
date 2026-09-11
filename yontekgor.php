<?php
include"headeryon.php";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="content-language" content="tr" />
<title>tekliftopla</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
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
<table width="737" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" ><? include "ust.php"?></td>
  </tr>
  <tr>
    <td width="176" valign="top" ><? include "solyonetim.php";?></td>
    <td   valign="top" bgcolor="#f6f6f6"><table width="100%"  cellspacing="0" cellpadding="0" border="0" bgColor=white >
      <tr>
        <td width="777" height="436" valign="top" bgcolor="#f6f6f6">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td colspan="4" height="2" bgcolor="#FFFFFF"></td>
            </tr>
            <tr  >
              <td background="image/yeni_orta.gif" height="50" width="191" ><img src="image/5/5_1%20copy.gif" width="176" height="64"></td>
              <td background="image/yeni_orta.gif" width="183" align="center" class="Baslik" valign="bottom"> Mal veya Hizmet Teklif Talebi</td>
              <td background="image/yeni_orta.gif" width="154" valign="middle" align="right" class="Buyuk_Yazi">&nbsp;</td>
              <td background="image/yeni_orta.gif" width="27" ><img src="image/sag_ok.gif" width="27" height="64"></td>
            </tr>
          </table>
          <span class="title_kucuk">Sayın </span><?php $verified_user = $_SESSION["verified_user"]; echo $verified_user;?><span class="title_kucuk">, lütfen teklif bilgilerini kontrol ediniz.</span>
          <table width="95%"  border="0" align="center" cellpadding="2" cellspacing="0"  bordercolor="#F6F6F6"  bgcolor="#EAEAEA">
            <form action="yonetimsektorgruplari.php" method="post" name="LoginForm">
			<tr>
              <td width="224"  align="right" class="govde"><span class="govde">Teklif İsteyen Kişi / Şirket :</span></td>
                <td>
                  <span class="govde">
                  <?
$verified_sifre1="";
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
$teklifid=$_GET["teklifid"];
$_SESSION['verified_kulid']=$teklifid;
$_SESSION['verified_teklifid']=$teklifid;
// $_SESSION['kontrol']=1;
$stryy1="SELECT * FROM kullanim WHERE Kullanimid='$teklifid'";
$resultyy1=mysqli_query($coni,$stryy1);
while ($rowyy1 = mysqli_fetch_array($resultyy1)){
$firmid = $rowyy1['firmaid'];
$smail=$rowyy1['FirmaEPosta'];
//echo "<input type=hidden name='smail' value='$smail'>";
$teklifid=$rowyy1['Kullanimid'];
echo $rowyy1['Firma'];
$ad=$rowyy1['Firma'];
$_SESSION['verified_firma']=$ad;
//echo "<input type=hidden name='sfirma' value='$ad'>";
$adres1=$rowyy1['Firmailetisim'];	
//echo "<input type=hidden name='adres1' value='$adres1'>";
$syetkili=" ";
//echo "<input type=hidden name='syetkili' value='$syetkili'>";
$iletisim=$rowyy1['iletisim'];
//echo "<input type=hidden name='iletisim' value='$iletisim'>";
$verified_sifre1=$rowyy1['session'];
$_SESSION['verified_sifre1']=$verified_sifre1;
$tari=$rowyy1['tarih'];
//echo "<input type=hidden name='tarih' value='$tari'>";
$rng=$rowyy1['tarih'];
$zama1=explode("-",$rng);
$tari=$zama1[2]."-".$zama1[1]."-".$zama1[0];
$tar=$rowyy1['sure'];
// echo "<input type=hidden name='sure' value='$tar'>";
$string=$rowyy1['text']; 
$metin1=str_replace("<script","",$string);
$metin1=str_replace("<style","",$string);
$metin1=str_replace("<embed","",$string);
$metin=nl2br($metin1);
$string1=wrap_text($metin,72);
//echo "<input type=hidden name='metin' value='$string1'>";
}
$strq="SELECT sehir.sehir, sehir.sehirid FROM  sehir,kullanim where kullanim.sehirid=sehir.sehirid and kullanim.Kullanimid='$teklifid'";
$resultq=mysqli_query($coni,$strq);
while ($rowq = mysqli_fetch_array($resultq)){
	$city=$rowq['sehir'];
	//echo "<input type=hidden name='sehir' value='$city'>";
	$verified_sehirid = $rowq["sehirid"];	
	$_SESSION['verified_sehirid']=$verified_sehirid;
    }
$strql="SELECT username from yonetim where yonid='$firmid'";
$resultql=mysqli_query($coni,$strql);
while ($rowql = mysqli_fetch_array($resultql)){
	$yonad=$rowql['username'];
	}
?>
                 </span></td>
            </TR>
            <TR>
              <td  align="right" class="govde"><span class="govde">Teklif No     :</span></td>
              <td><span class="govde"><?php echo $teklifid;?></span></td>
            <TR>
              <td  align="right" class="govde"><span class="govde">E-Posta Adresi     :</span></td>
              <td><span class="govde"><?php echo $smail;?></span></td>
            </TR>
            <TR>
              <td  align="right" class="govde"> <span class="govde"> Teklif Toplama Yöntemi:</span></td>
              <td><span class="govde"><?php echo $iletisim; ?></span></td>
             </TR>
            <TR>
              <td  align="right" class="govde"><span class="govde">En Son Teklif Verme Tarihi:</span></td>
              <td  ><span class="govde"><?php echo $tari;?></span></td>
            </TR>
            <TR>
              <td  align="right" class="govde"><span class="govde">Mal veya Hizmetin Teslim Süresi:</span></td>
              <td  ><span class="govde"><?php echo $tar; ?></span></td>
            </TR>
            <TR>
              <td align="right"  class="govde"><span class="govde">Talep Edilen Mal ve Hizmetin Tarifi:</span></td>
              <td width="276"><span class="govde"><?php	echo $string1; ?></span></td>
            </TR>
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
?>                  
              <TR>
              <td  align="right" valign="top" class="govde"><span class="govde">Mal veya Hizmetin Teslim Yeri:</span></td>
              <td><span class="govde"><?php echo $city; ?> </span></td>
              </TR>
              <TR>
              <td  align="right" valign="top" class="govde"><span class="govde">Talebi Kaydeden Yönetici:</span></td>
              <td><span class="govde"><?php echo $yonad; ?> </span></td>
              </TR>
              <tr>
              <td colspan=2>&nbsp; 
              </td>  
              </tr>
            <tr></TR>
           </form>
          </TABLE>
          <table width="95%"  border="0" align="center" cellpadding="2" cellspacing="0"  bordercolor="#F6F6F6"  bgcolor="#EAEAEA">
            <tr>
              <td align="center"  class="aciklama" bgcolor="#FFFFFF" height="30" valign="middle">                
			  <form action="emailiptal.php?teklifid=<?=$teklifid?>" method="post" name="frmIptal" id="frmIptal">
                      <strong><img src="image/iptalet.gif" width="146" height="16" class="ResimDugme" onClick="Iptal()" ></strong>              
              </form></td>
              <td align="center" class="aciklama" bgcolor="#FFFFFF" height="30" valign="middle"><span class="aciklama"><strong><img src="image/ilerle.gif" width="147" height="16" class="ResimDugme" onClick="Gonder()" ></strong></span>	</td></tr>
            <tr>
                  <td colspan="2" align="center" class="aciklama" bgcolor="#FFFFFF" height="30" valign="middle"><strong> <img src="image/yonetici.gif" width="146" height="16" class="ResimDugme" onClick="ilerle()" > </strong></td>
             </tr>
          </table>        </tr>
    </table></td>
  </tr>
  
</table>
</BODY></HTML>
<script language="javascript">
function Gonder()
{
	document.forms.LoginForm.submit();
}
function Iptal()
{
	document.forms.frmIptal.submit();
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
