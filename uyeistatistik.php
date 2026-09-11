<?php include "headeryon.php"; ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>tekliftopla</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
</head>
<? //************counter bilgilerini görüntüleme
$stra="SELECT * FROM  ip where ip!='193.192.123.50' and ip!='193.192.123.54' ";
$resulta = mysqli_query($coni,$stra);
$ghit=mysqli_num_rows($resulta);
/*$query="SET NAMES 'UTF8'";
mysql_query($query);
*/?>
<style type="text/css">
<!--
.style1 {font-family: verdana}
.style4 {
	font-size: 12px;
	font-weight: bold;
}
.style8 {font-family: verdana; font-size: 12px; font-weight: bold; }
-->
</style>
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
 
 <table width="540" align="center"  cellspacing="0" cellpadding="0" border="0" bgColor=white >
          
                <td colspan="4" height="2" bgcolor="#FFFFFF"></td>
              </tr>
              <tr  >
                <td background="image/yeni_orta.gif" height="50" width="191" >&nbsp;</td>
                <td background="image/yeni_orta.gif" width="183" align="center" class="Baslik" valign="middle">Üye Bilgileri </td>
                <td background="image/yeni_orta.gif" width="154" valign="middle" align="right" class="Buyuk_Yazi">&nbsp;</td>
                <td background="image/yeni_orta.gif" width="27" ><img src="image/sag_ok.gif" width="27" height="64"></td>
              </tr>
            </table>            
    <p><span class="title_kucuk">Sayın </span><span class="title_kucuk"><? $verified_user= isset ($_SESSION["verified_user"]) ? $_SESSION["verified_user"] : ''; echo $verified_user;?></span></p>
              <table width="540px" border="0" align="center" cellpadding="2" cellspacing="0"  bordercolor="#F6F6F6"  bgcolor="#EAEAEA">
                <tr>
                  <td colspan="4" class="govde"><strong>Toplam Üye Sayısı : 
				   <? 
				    $sql = mysqli_query($coni,"SELECT * FROM bilgi");
				    $sayi = mysqli_num_rows($sql);
				    echo $sayi;
				  ?>
		          </strong>
                  ( Aktif: 
                  <?
				  $sql_aktif = mysqli_query($coni,"SELECT * FROM bilgi WHERE aktivite = '1'");
				  $sayi_aktif = mysqli_num_rows($sql_aktif);
				  echo $sayi_aktif;
				  ?>			      
                  , Pasif:
                  <?
				  $sql_pasif = mysqli_query($coni,"SELECT * FROM bilgi WHERE aktivite = '0'");
				  $sayi_pasif = mysqli_num_rows($sql_pasif);
				  echo $sayi_pasif;
				  ?>   / Listeden çıkan:                
                  <?
				  $sql_unsubs = mysqli_query($coni,"SELECT * FROM unsubslist");
				  $sayi_unsubs = mysqli_num_rows($sql_unsubs);
				  echo $sayi_unsubs;
				  ?> )
                  </td>
                </tr>
                <tr>
                 <td colspan="4" class="govde">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="4" class="govde"><strong>Teklif tarihi geçmemiş teklif sayısı: </strong>
				    <? 
				    $sqltek = mysqli_query($coni,"SELECT kullanimid from kullanim where kullanim.tarih >=curdate()");
					$rowtek = mysqli_num_rows($sqltek);
					echo $rowtek;
				  ?>
		          </td>
                </tr>
                 <tr>
                 <td colspan="4" class="govde">&nbsp;</td>
                 </tr>
                <tr valign="top" class="govde">
                 <td width="25%"><strong> Son Sene Maks Teklif İst. Sektörler</strong></td>
                 <td width="25%"><strong> Son Sene Maks Teslim İst. Şehirler</strong></td><td width="25"><strong> En Az Üyeli Sektörler</strong></td><td width="25"><strong> En Az Üyeli Şehirler</strong></td>
                </tr>
                 <tr class="govde">
                 <td valign="top">
                  <? $sqlazseh = mysqli_query($coni,"select a.sektorid, b.sektor, count(distinct a.Kullanimid) as adet from kulsektor as a, sektorler as b, kullanim as c where a.sektorid=b.sektorid and a.Kullanimid=c.Kullanimid and c.date> adddate(curdate(), interval -360 day) and c.tamam=1 and c.readable=1 group by a.sektorid ORDER BY adet DESC  LIMIT 25");
				  while ($row = mysqli_fetch_array($sqlazseh))
				  { echo substr($row['sektor'],0,20);
				  echo"<br>";}
				  ?>
                  </td>
                 <td valign="top">
                 <? $sqlazseh = mysqli_query($coni,"SELECT a.sehirid, b.sehir, COUNT(a.sehirid) as adet FROM kullanim as a, sehir as b where a.sehirid=b.sehirid  and  a.date> adddate(curdate(), interval -360 day) and a.tamam=1 and a.readable=1 GROUP BY a.sehirid ORDER BY adet DESC LIMIT 25");
				  while ($row = mysqli_fetch_array($sqlazseh))
				  { echo $row['sehir'];
				  echo"<br>";}
				  ?> 
                  </td>
                 <td valign="top">
                 <? $sqlazseh = mysqli_query($coni,"select a.sektorid, b.sektor, count(distinct a.firmaid, a.sektorid) as adet from firma_sektor as a, sektorler as b where a.sektorid=b.sektorid group by b.sektor having adet<750 ORDER BY adet ASC  LIMIT 25");
				  while ($row = mysqli_fetch_array($sqlazseh))
				  { echo substr($row['sektor'],0,20);
				  echo"<br>";}
				  ?>  
                  </td>
                 <td valign="top">
                  <? $sqlazseh = mysqli_query($coni,"SELECT Sehir, COUNT(Sehir) as Uye FROM bilgi GROUP BY Sehir ORDER BY Uye ASC LIMIT 25");
				  while ($row = mysqli_fetch_array($sqlazseh))
				  { echo $row['Sehir'];
				  echo"<br>";}
				  ?>
                 </td>
                 </tr>
                 <tr>
                 <td colspan="4" class="govde">&nbsp;</td>
                 </tr>
                 <tr>
                  <td colspan="4" class="govde"><strong>Aynı şehire bir kereden fazla kere üye olan kullanıcı sayısı : </strong>
				    <? 
				    $sqlazseh = mysqli_query($coni,"select count(distinct firmaid) as firmasay from (SELECT firmaid, sehirid, count(*) FROM firma_sehir GROUP BY firmaid, sehirid having count(*) > 1) t");
					$row = mysqli_fetch_array($sqlazseh);
					echo $row['firmasay'];
				  ?>
		          </td>
                </tr>
                <tr>
                 <td colspan="4" class="govde"><strong>Aynı sektöre bir kereden fazla üye olan kullanıcı sayısı : </strong>
				    <? 
				    $sqlazseh = mysqli_query($coni,"Select count(distinct firmaid) as firmasay from (SELECT firmaid, sektorid, count(*) FROM firma_sektor GROUP BY firmaid, sektorid having count(*) > 1) tt");
					$row = mysqli_fetch_array($sqlazseh);
					echo $row['firmasay'];
				  ?>
		          </td>
                </tr>
                <tr>
                 <td colspan="4" class="govde"><strong>İlk Kullanım - Üye tablo kayıt tarihi : </strong>
				    <? 
				    $sqlkulid = mysqli_query($coni,"SELECT b.tarih from kulfirmaid as a, kullanim as b where a.kullanimid=b.kullanimid order by b.tarih asc limit 1");
					$row = mysqli_fetch_array($sqlkulid);
					echo $row['tarih'];
				  ?></td>
                 </tr>
                 <tr>
                 <td colspan="4" class="govde">&nbsp;</td>
                 </tr>
                 <tr>
                 <td colspan="4" class="govde"><strong>Aktif üye sayısı en yüksek  25 sektör</strong></td>
                </tr>
                 <tr>
                 <td colspan="2" class="govde"><strong>Sektör</strong></td><td colspan="2" class="govde"><strong>Üye Sayısı</strong></td>
                 </tr>
                 <?php
				 $uyesay = "select b.sektor, count(a.firmaid) as adet from firma_sektor as a, sektorler as b, bilgi as c where a.sektorid=b.sektorid and a.firmaid=c.firmaid and c.aktivite=1 group by a.sektorid order by adet desc limit 25";
				 $uyeler= mysqli_query($coni,$uyesay);
				 while ($uyerow=mysqli_fetch_array($uyeler))
				 { ?> <tr> <td colspan="2" class="govde"> <?php echo $uyerow['sektor'];?></td><td colspan="2" class="govde" ><?php echo $uyerow['adet'];?></td></tr>
                 <?php } ?>
                 <tr>
                 <td colspan="4" align="center" class="aciklama" bgcolor="#F6F6F6" height="50" valign="middle"><strong> <img src="image/yonetici.gif" width="146" height="16" class="ResimDugme" onClick="ilerle()" > </strong></td>
                </tr>
              </table>
</div>
  <div id="bant1"></div> <!-- bant2 -->
  
</div>
</BODY></HTML>
<script language="javascript">
 function ilerle() 
 {
  window.location="istatistik.php";
 }

</script>