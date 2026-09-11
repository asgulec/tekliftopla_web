<?php include"headeri.php"?>
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
<table width="97%" align="center"  cellspacing="0" cellpadding="0" border="0" bgColor=white >
<tr>
  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td colspan="4" height="2" bgcolor="#FFFFFF"></td>
      </tr>
      <tr height="25px">
        <td width="25%">&nbsp;</td>
        <td width="25%" ></td>
        <td valign="middle" width="43%" align="right" class="title">Teklif Talep Detayı</td>
        <td valign="bottom" align="right" width="7%" ><img src="image/sag_ok.gif"></td>
      </tr>
    </table></td>
</tr>
<tr>
  <td height="10px" /td>
</tr>
<tr>
        <td valign="top"  bgcolor="#F6F6F6" class="Baslik" ><? $verified_firma = isset ($_SESSION["verified_firma"]) ? $_SESSION["verified_firma"] : ''; ?>Sayın <? echo $verified_firma;?> seçmiş olduğunuz teklif talebi detayları aşağıdadır.</td></tr>
        <tr><td height="10px"></td></tr>
        <tr><td>
          <table width="95%" border="0" align="center" cellpadding="3" cellspacing="0"  >
            <TR>
              <td  align="right" class="govde">Teklif İsteyen: </td>
              <td class="govde">

                <?
$kullanimidxler=$_GET["kullanimidxler"];
$stryy100=" SELECT bilgi.Firma_Adi bFirma, bilgi.Adres bAdres, bilgi.Posta_Kodu bPostaKodu, bilgi.tel_alankodi btel_alankodi, bilgi.Telefon  bTelefon, bilgi.fax_alankodi bfax_alankodi, bilgi.Fax bFax,  bilgi.email bemail, bilgi.iletisim biletisim, sehir.sehir bsehir, country.ulke coun, kullanim.*".
				  " FROM kullanim left join bilgi on (kullanim.firmaid=bilgi.firmaid) left join country on (kullanim.ulke=country.iso3) left join sehir on (kullanim.sehirid=sehir.sehirid) where kullanim.Kullanimid='$kullanimidxler'";
$resultyy100=mysqli_query($connection,$stryy100);
$rowyy100 = mysqli_fetch_array($resultyy100);
$Firma = $rowyy100['bFirma'];
$Tarih		= $rowyy100['tarih'];
$Sure		= $rowyy100['sure'];
$Tarif		= $rowyy100['text'];
$meml = ($rowyy100['coun']=="Turkey" ? $rowyy100['bsehir'] : $rowyy100['coun']) ;
if(!$Firma) // Yönetimden Giriş
{
	$Firma 		= $rowyy100['Firma'];
	$EPosta	= $rowyy100['FirmaEPosta'];
	$Iletisim	= $rowyy100['iletisim']. "-" . $rowyy100['Firmailetisim'];
	$Telefon='';
}
else
{
	$EPosta	= $rowyy100['bemail'];
	$Telefon	= $rowyy100['btel_alankodi']."    ".$rowyy100['bTelefon'];
	$Iletisim	= $rowyy100['iletisim'];
	if ($Iletisim == "Fax")
		$Iletisim = $Iletisim ."- " .$rowyy100['bfax_alankodu'] . "  ".  $rowkl['bfax'];
  	 if ($Iletisim  == "Posta" or $Iletisim  == "Ziyaret")
		$Iletisim = $Iletisim ."- " .$rowyy100['bAdres'] . "  ".  $rowyy100['bPosta_Kodu'] . "  ".  $rowyy100['bSehir'];
  	 if ($Iletisim   == "Telefon")
		$Iletisim = $Iletisim . "- " .$rowyy100['bTel_alankodu'] . "  ".  $rowyy100['bTelefon'];
	if ($Iletisim == "E-Posta" || $Iletisim == "E-mail" )
		$Iletisim = $Iletisim  ."- <a href=\"mailto:" . $rowyy100['bemail'] . "\" class=\"link\" >". $rowyy100['bemail']."</a>";
} 
echo $Firma;
?></td>
            </TR>
            <TR>
              <td  align="right" class="govde">E-Posta Adresi    :</td>
              <td class="govde"> <? echo $EPosta;?></td>
            </TR>
            <TR>
              <td  align="right" class="govde">Telefon    :</td>
              <td class="govde"> <? echo $Telefon; ?></td>
            </TR>
            <TR>
              <td  align="right" class="govde" >Başvuru Adresi    :</td>
              <td class="govde"><? echo $Iletisim;?></td>
            </TR>
            <TR>
              <td  align="right" class="govde">En Son Teklif Verme Tarihi    :</td>
              <td   class="govde" ><? echo date("d-m-Y", strtotime($Tarih));?></td>
            </TR>
            <TR>
              <td  align="right" class="govde">Mal veya Hizmetin Teslim S&uuml;resi    :</td>
              <td  class="govde"><?	echo $Sure;?></td>
            </TR>
            <TR>
              <td  valign="top" align="right" class="govde">Talep Edilen Mal ve Hizmetin Tarifi :</td>
              <td width="300" class="govde"><? 
			  //$Tarif = str_replace("\r", '', $Tarif); // remove carriage returns
			  //$Tarif = str_replace(array("\r", "\n"), "", $Tarif);
			  //$Tarif=preg_replace( "/\r/", "", $Tarif);
			  //$Tarif=preg_replace('/\s+/', ' ',$Tarif);
			  //$Tarif = preg_replace("/\n\n+/", "\n\n", $Tarif);
			  //echo $Tarif;
			  echo nl2br($Tarif); ?></td>
            </TR>
            <TR>
              <td  align="right" class="govde">Mal veya Hizmetin Teslim Yeri 
			     :</td>
              <td class="govde">
                <? echo $meml ;?> </td>
            </TR>
			                <tr>
                  <td colspan="2" align="center" class="aciklama" height="60" valign="middle"><a href="javascript:history.go(-1)" class="buttonPage"> Geri Dön &nbsp;<i class="icon-arrow-left"></i></a></td>
                </tr>
          </TABLE></td>
      </tr>
            </table>
</div>
<div id="bant1"></div>
<div id="alt">
  <?php include "alt.php" ?>
</div>
</div>
</body>
</HTML>


