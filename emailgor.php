<?php include "headeryon.php";
function mysqli_result($res,$row=0,$col=0){ 
    $numrows = mysqli_num_rows($res); 
    if ($numrows && $row <= ($numrows-1) && $row >=0){
        mysqli_data_seek($res,$row);
        $resrow = (is_numeric($col)) ? mysqli_fetch_row($res) : mysqli_fetch_assoc($res);
        if (isset($resrow[$col])){
            return $resrow[$col];
        }
    }
    return false;
}

?>
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
    <?php include "solyonetim.php" ?>
  </div>
  <div id="analong">

<table width="540px" align="center" border="0" cellpadding="0"  cellspacing="0" bgColor=white >
      <tr>
        <td height="50"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td colspan="4" height="2" bgcolor="#FFFFFF"></td>
          </tr>
          <tr  >
            <td background="image/yeni_orta.gif" height="50" width="180" >&nbsp;</td>
            <td background="image/yeni_orta.gif" width="193" align="center" class="Baslik" valign="bottom">Kayıtlı Bilgilerin Dökümü </td>
            <td background="image/yeni_orta.gif" width="5" valign="middle" align="right" class="Buyuk_Yazi"></td>
            <td align="right" background="image/yeni_orta.gif" width="183" ><img src="image/sag_ok.gif" width="27" height="64"></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td bgcolor="#F6F6F6">
            <TABLE width="95%"  border="0" align="center" cellpadding="2" cellspacing="0"  bordercolor="#F6F6F6"  bgcolor="#EAEAEA">
            
	    <?
$emfirma=trim($_POST["efirma"]);
$strss="SELECT * FROM bilgi where email like '%$emfirma%'";
$resultss=mysqli_query($coni,$strss);
$occur=mysqli_num_rows($resultss);
if($occur){
while ($rowss = mysqli_fetch_array($resultss)) {
$verfirmaid=$rowss['firmaid'];
?>  
              <tr>
                <td colspan="2">&nbsp;</td>
              </tr>
              <TR align="left">
                <td width="248" class="govde"><strong>Firma veya Kullanıcı Adı: </strong></td>
                <td width="231" class="govde"><strong><? echo  $rowss['Firma_Adi']?></strong></td>
              </TR>
              <TR align="left">
                <td align="right" class="govde">E-Posta Adresi:</td>
                <td class="govde"><strong><? echo$rowss['email']?></strong></td>
              </TR>
              <TR align="left">
                <td align="right" class="govde">Şifre:</td>
                <td class="govde"><? echo $rowss['sifre'];?>
                </td>
              </TR>
              <TR align="left">
                <td align="right" class="govde">Şehir - Ülke:</td>
                <td class="govde"><? echo $rowss['Sehir']." - ".$rowss['ulke'];?>
                </td>
              </TR>
              <TR align="left">
                <td align="right" class="govde">Üyelik Seviyesi:</td>
                <td class="govde"><? echo $rowss['proflag'];?>
                </td>
              </TR>
              <TR align="left">
                <td align="right" class="govde">Üyelik Durumu:</td>
                <td class="govde"><? if($rowss['aktivite']=='1'){echo "Aktif";} else { echo "Pasif";}?>
                </td>
              </TR>
              <TR align="left">
                <td align="right" class="govde">Kaydeden:</td>
                <td class="govde"><? $numara = $rowss['kaydeden'];
				$kaydeden =  mysqli_query($coni,"SELECT username FROM yonetim WHERE yonid ='$numara' LIMIT 1");
				$kaydeden = mysqli_result($kaydeden);
                 echo $kaydeden;
				 ?>
                </td>
              </TR>
              <TR>
                <td colspan="2" class="govde" align="center">Teklif vermek istedigi sektörler: </td>
                </TR>
                <tr>
                <td colspan="2" class="govde">
                <table width="450" border="0" align="center">
                <?
				$count=1;
				$column=1;
$str13322="SELECT distinct sektorler.sektor FROM firma_sektor left join sektorler on firma_sektor.sektorid=sektorler.sektorid where firma_sektor.firmaid='$verfirmaid' order by sektorler.sektor";
$result13322=mysqli_query($coni,$str13322);
while ($row13322 = mysqli_fetch_array($result13322))
{
if ($column==1)
{
printf("<tr><td>%s</td>",$row13322['sektor']);
}
else{
printf("<td>%s</td></tr>",$row13322['sektor']);
}
$count+=1;
$column = $count%2;
}
?>
				</table>
                </td>
              </TR>
              <TR>
                <td colspan="2" class="govde" align="center">Teklif vermek istediği şehirler: </td>
               </TR>
                <td colspan="2" class="govde">
                <table width="450" border="0" align="center">
                <?
				$count=1;
				$column=1;
$strp2111="SELECT distinct sehir.sehir FROM  firma_sehir,sehir where firma_sehir.sehirid=sehir.sehirid and firma_sehir.firmaid='$verfirmaid'  order by sehir.sehir";
$resultp2111=mysqli_query($coni,$strp2111);
while ($rowp2111 = mysqli_fetch_array($resultp2111))
{
if ($column==1)
{
printf("<tr><td>%s</td>",$rowp2111['sehir']);
}
else{
printf("<td>%s</td></tr>",$rowp2111['sehir']);
}
$count+=1;
$column = $count%2;
}
  ?>
  				</table>
                </td>
              </TR>  <? }}else{?>
              <TR align="center">
                <td  colspan="2" class="govde"><span class="not">Bu e-mail adresine sahip firma yoktur.</span></td>
              </TR>
<?  }?>
              <TR>
                <td colspan="2" align="center" class="aciklama" bgcolor="#F6F6F6" height="60"><img src="image/but_yeni_aramayap.gif" width="146" height="16" class="ResimDugme" onClick="Gonder()"><img src= "image/trans.gif" alt="" width="25px" height="1"><img src="image/yonetici.gif" width="146" height="16" class="ResimDugme" onClick="ilerle()"> </td>
              </TR>
            </table>
        </td>
      </tr>
      </table>
</div>
  <div id="bant1"></div> <!-- bant2 -->
  
</div>

</BODY></HTML>
<script language="javascript">
 function ilerle() 
 {
  window.location="yonetimgiris.php";
 }
 
 function Gonder()
 {
  window.location="emailbul.php";

 }

</script>