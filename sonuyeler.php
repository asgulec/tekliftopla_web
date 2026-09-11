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
 <div id="sayfa">
  <div id="ust">
    <?php include "ust.php" ?>
  </div>
  <div id="bant1"></div>
  <div id="sol">
    <?php include "solyonetim.php" ?>
  </div>
  <div id="analong">

    <table width="540px" align="center" cellspacing="0" cellpadding="0" border="0"bgcolor="#f6f6f6" >
          <tr>
            <td width="100%" valign="top" bgcolor="#f6f6f6"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td colspan="4" height="2" bgcolor="#FFFFFF"></td>
              </tr>
              <tr  >
                <td background="image/yeni_orta.gif" height="50" width="191" >&nbsp;</td>
                <td background="image/yeni_orta.gif" width="183" align="center" class="Baslik" valign="bottom">Yeni  Üye Dökümü</td>
                <td background="image/yeni_orta.gif" width="154" valign="middle" align="right" class="Buyuk_Yazi">&nbsp;</td>
                <td background="image/yeni_orta.gif" width="27" ><img src="image/sag_ok.gif" width="27" height="64"></td>
              </tr>
            </table>            
            <h4 class="title_kucuk">Sayın <? $verified_user= isset ($_SESSION["verified_user"]) ? $_SESSION["verified_user"] : ''; echo $verified_user;?>,&nbsp;&nbsp;hoşgeldiniz.</h4>
             <table width="95%"  border="0" align="center" cellpadding="1" cellspacing="0"  bordercolor="#F6F6F6"  bgcolor="#EAEAEA">
                <?
$stryy="SELECT b.username, a.Tarih, a.Firma_Adi, a.Sehir, a.firmaid FROM bilgi AS a, yonetim AS b, (SELECT MAX(firmaid) AS foo FROM `bilgi` GROUP BY kaydeden) AS foos WHERE b.yonid>1 AND a.firmaid=foos.foo AND b.yonid=a.kaydeden GROUP BY b.username ORDER BY a.Tarih";
$resultyy=mysqli_query($coni,$stryy);
$ok2=mysqli_num_rows($resultyy);
if($ok2){?>
                <tr>
                  <td width="12%" bgcolor="#EAEAEA" class="govde"><strong>Yönetici</strong></td>
                  <td width="16%" bgcolor="#EAEAEA" class="govde"><strong>Tarih</strong></td>
                  <!-- <td width="30" bgcolor="#EAEAEA" class="govde">e-posta</td> -->
                  <td width="18%" bgcolor="#EAEAEA" class="govde"><strong>Firma Adı</strong></td>
                  <td width="18%" bgcolor="#EAEAEA" class="govde"><strong>Bul. Şehir</strong></td>
                  <td width="18%" bgcolor="#EAEAEA" class="govde"><strong>Hiz. Şehir</strong></td>
                  <td width="18%" bgcolor="#EAEAEA" class="govde"><strong>Sektörler</strong></td>
                </tr>
                <? while ($rowyy = mysqli_fetch_array($resultyy)){
$ytarih=date('d-m-y', strtotime($rowyy['Tarih']));
$yyonetici=$rowyy['username'];
$yfirmaad=substr($rowyy['Firma_Adi'],0,10);
$ycity=$rowyy['Sehir'];
$yfirmaid=$rowyy['firmaid']; 
?>
<tr> <td valign="top" class=govde ><? echo $yyonetici ?></td>
      <td valign="top" class=govde ><? echo $ytarih ?></td>
      <td valign="top" class=govde ><? echo $yfirmaad ?></td>
      <td valign="top" class=govde ><? echo $ycity ?></td>
      <td valign="top" class=govde ><?php 
	  $ysehr="select a.sehir from sehir as a, firma_sehir as b where b.firmaid='$yfirmaid' and a.sehirid = b.sehirid";
	  $ysehs=mysqli_query($coni,$ysehr);
	  while ($ysehler = mysqli_fetch_array($ysehs))
      { echo $ysehler['sehir']; ?> / <?php }?></td>
      <td valign="top" class=govde ><?php
	  $ysekr="select a.sektor from sektorler as a, firma_sektor as b where b.firmaid='$yfirmaid' and a.sektorid = b.sektorid";
	  $ysekd=mysqli_query($coni,$ysekr);
	  while ($ysekl = mysqli_fetch_array($ysekd))
      { echo $ysekl['sektor']; ?> / <?php }
	  ?>
      </td>
</tr>
	  <? 
							}}
else{?>
                <tr>
            <td class="info" colspan="5" align="center" bgcolor="#EAEAEA"><br>
                      <span class="not" >Üye bulunamadı</span><br>
                      <br></td>
                </tr>
                <?}?>
                <tr>
                  <td colspan="6" align="center" class="aciklama" bgcolor="#C7D8BE" height="50" valign="middle"><img src="image/yonetici.gif" width="146" height="16" class="ResimDugme" onClick="ilerle()" ></td>
                </tr>
                <tr>
              </table>
             
             
              <table width="95%"  border="0" align="center" cellpadding="1" cellspacing="0"  bordercolor="#F6F6F6"  bgcolor="#EAEAEA">
                <?
$stryy11="SELECT firmaid, Firma_Adi, Tarih, Sehir, email, ulke FROM bilgi WHERE kaydeden ='1' ORDER  BY firmaid DESC  LIMIT 0, 50";
$resultyy11=mysqli_query($coni,$stryy11);
$ok22=mysqli_num_rows($resultyy11);
if($ok22){?>
                <tr>
                  <td width="12%" bgcolor="#EAEAEA" class="govde"><strong>Tarih</strong></td>
                  <td width="20%" bgcolor="#EAEAEA" class="govde"><strong>Firma Adı</strong></td>
                  <!-- <td width="30" bgcolor="#EAEAEA" class="govde">e-posta</td> -->
                  <td width="17%" bgcolor="#EAEAEA" class="govde"><strong>Şehir-Ülke</strong></td>
                  <td width="10%" bgcolor="#EAEAEA" class="govde"><strong>Şeh say</strong></td>
                  <td width="41%" bgcolor="#EAEAEA" class="govde"><strong>Sektörler</strong></td>
                </tr>
                <? while ($rowyy11 = mysqli_fetch_array($resultyy11)){
$ftarih=date('d-m-y', strtotime($rowyy11['Tarih']));
$nfirmaid=$rowyy11['firmaid'];
$firmaad=substr($rowyy11['Firma_Adi'],0,15);
$epost=$rowyy11['email'];
$bcity=$rowyy11['Sehir'];
$bulke=$rowyy11['ulke']; 
?>
<tr <?php echo ($bulke=="TUR" ? " style=\"background-color:#EAEAEA\" " : " style=\"background-color:#F5F3BF\" "); ?>> <td valign="top" class=govde ><? echo $ftarih ?></td>
      <td valign="top" class=govde ><? echo $firmaad ?></td>
      <!-- <td class=govde><? echo $epost ?></td> -->
	  <td valign="top" class=govde ><? if ($bcity!=="") {echo $bcity;} else {echo $bulke;} ?></td>
      <td valign="top" class=govde ><?php 
	  $sehrow="select firmaid from firma_sehir where firmaid='$nfirmaid'";
	  $sehsay=mysqli_query($coni,$sehrow);
	  $numseh=mysqli_num_rows($sehsay);
	  echo $numseh ?></td>
      <td valign="top" class=govde ><?php
	  $sekrow="select a.sektor from sektorler as a, firma_sektor as b where b.firmaid='$nfirmaid' and a.sektorid = b.sektorid";
	  $sekdok=mysqli_query($coni,$sekrow);
	  while ($sekler = mysqli_fetch_array($sekdok))
      { echo $sekler['sektor']; ?> / <?php }
	  ?>
      </td>
</tr>
	  <? 
							}}
else{?>
                <tr>
            <td class="info" colspan="5" align="center" bgcolor="#EAEAEA"><br>
                      <span class="not" >Üye bulunamadı</span><br>
                      <br></td>
                </tr>
                <?}?>
                <tr>
                  <td colspan="6" align="center" class="aciklama" bgcolor="#C7D8BE" height="50" valign="middle"><img src="image/yonetici.gif" width="146" height="16" class="ResimDugme" onClick="ilerle()" ></td>
                </tr>
                <tr>
              </table>
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

</script>