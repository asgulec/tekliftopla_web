<? include"headeri.php"?>
<? include"click.php"?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="content-language" content="tr" />
<title>..:: Teklif Toplama Sitesine Hosgeldiniz ::..</title>
<link href="css/style.css" rel="stylesheet" type="text/css">

</head>

<body>
<table width="737" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" ><? include "ust.php"?></td>
  </tr>
  <tr>
    <td width="176" valign="top" ><? include "sol.php";?></td>
    <td   valign="top"><table width="100%" border="0" cellpadding="0"  cellspacing="0" bgColor=white >
	  <?
$verified_firmaid = $_SESSION["verified_firmaid"];
$str="SELECT * FROM bilgi  where firmaid='$verified_firmaid'";
$result=mysqli_query($connection,$str);
while ($row = mysqli_fetch_array($result)){
?>  

      <tr>
        <td width="100%" valign="top" bgcolor="#EAEAEA"><? $verified_firma = $_SESSION["verified_firma"]; ?>
          <h4><span class="title_kucuk">Sayın <?echo$verified_firma;?>,</span> <span class="title_kucuk">sistemde kayıtlı bilgileriniz.</span> </h4>
          <TABLE width="507"  border="1" align="center" cellpadding="1" cellspacing="0"  bordercolor="#F6F6F6"  bgcolor="#EAEAEA">
            <TR class="title_kucuk">
              <td colspan="2" class="aciklama" bgcolor="#F6F6F6"><div align="center" class="title_kucuk"><strong>Kay&#305;tl&#305; Bilgiler D&ouml;k&uuml;m&uuml; </strong></div></td>
            </TR>
            <TR>
              <td width="248" class="govde" align="right">Firma veya Kullanıcı Adı: </td>
              <td width="231" class="aciklama"> <? echo  $row['Firma_Adi']?></td>
            </TR>
            <TR>
              <td class="govde" align="right">Firma veya Kullanıcı Adresi: </td>
              <td class="aciklama"><? echo $row['Posta_Kodu']?></td>
            </TR>
            <TR>
              <td class="aciklama" align="right"><span class="govde">Posta Kodu</span>:</td>
              <td class="aciklama"><? echo $row['Posta_Kodu']?></td>
            </TR>
            <TR>
              <td class="govde" align="right">Firma veya Kullanıcı Telefonu:</td>
              <td valign="top" class="aciklama"><? echo "(".$row['tel_alankodi'].")"?>&nbsp;<? echo $row['Telefon'];?></td>
            </TR>
            <TR>
              <td class="govde" align="right">Firma veya Kullanıcı Fax: </td>
              <td class="aciklama"><? echo "(".$row['fax_alankodi'].")"?>&nbsp;<? echo $row['Fax']; ?> </td>
            </TR>
            <TR>
              <td class="govde" align="right">Firma Merkezi: </td>
              <td class="aciklama"><? echo $row['Sehir']; ?></td>
            </TR>
            <TR>
              <td  class="govde" align="right">E-Posta Adresi:</td>
              <td align="left" class="aciklama"><? echo $row['email'];?></td>
            </TR>
            <TR>
              <td  class="govde" align="right">Web Adresi:</td>
              <td align="left" class="aciklama"><? echo $row['yetkili']; ?> </td>
            </TR>
            <tr>
              <td class="govde" align="right">Teklif vermek istedifiniz sektörler: </td>
              <td class="aciklama">
                <?
$str1="SELECT distinct sektorler.sektor FROM firma_sektor left join sektorler on firma_sektor.sektorid=sektorler.sektorid where firma_sektor.firmaid='$verified_firmaid' order by sektorler.sektor";
$result1=mysqli_query($connection,$str1);
while ($row1 = mysqli_fetch_array($result1)){
echo ($row1['sektor']);
echo "<br>";}?>
              </td>
            </tr>
            <tr>
              <td class="govde" align="right">Teklif vermek istediginiz şehirler: </td>
              <td class="aciklama">
                <?
$strp2="SELECT sehir.sehir FROM  firma_sehir,sehir where firma_sehir.sehirid=sehir.sehirid and firma_sehir.firmaid='$verified_firmaid'  order by sehir.sehir";
$resultp2=mysqli_query($connection,$strp2);
while ($rowp2 = mysqli_fetch_array($resultp2)){
  echo ($rowp2['sehir']);echo"<br>";}?>
             </td>
            </tr>
            <TR>
              <td colspan="2" align="center" class="aciklama" bgcolor="#FFFFFF" height="30" valign="middle"><strong>                &nbsp;&nbsp;&nbsp;<img src="image/but_girissayfasinailerle.gif" width="144" height="16" class="ResimDugme" onClick="Git();" >              </strong></td>
            </TR>			  
          </table>
<? } ?>
        </table></td>
  </tr>
  <tr>
    <td colspan="2"><? include "alt.php";?></td>
  </tr>
</table>
</BODY></HTML>
<script language="javascript">
function Git(){
	window.location = "giris.php";
}
</script>