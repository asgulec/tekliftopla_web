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

 <table width="540px" align="center"  cellspacing="0" cellpadding="0" border="0" bgColor=white >
          <tr>
            <td width="777" valign="top" bgcolor="#f6f6f6"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td colspan="4" height="2" bgcolor="#FFFFFF"></td>
              </tr>
              <tr  >
                <td background="image/yeni_orta.gif" height="50" width="191" >&nbsp;</td>
                <td background="image/yeni_orta.gif" width="183" align="center" class="Baslik" valign="middle">Kayıt-Teklif İstatistikleri </td>
                <td background="image/yeni_orta.gif" width="154" valign="middle" align="right" class="Buyuk_Yazi">&nbsp;</td>
                <td background="image/yeni_orta.gif" width="27" ><img src="image/sag_ok.gif" width="27" height="64"></td>
              </tr>
            </table>            
              <p><span class="title_kucuk">Sayın </span><span class="title_kucuk"><? $verified_user= isset($_SESSION["verified_user"]) ? $_SESSION["verified_user"] : ''; echo $verified_user;?></span></p>
              <table width="95%"  border="0" align="center" cellpadding="2" cellspacing="0"  bordercolor="#F6F6F6"  bgcolor="#EAEAEA">
                <tr>
                  <td colspan="3" align="center" class="title_kucuk" bgcolor="#FFFFFF" height="15" valign="middle"><p>Son 12 Ay ( Gidecek mesaj: 
                  <?php 
				  $stra = mysqli_query($coni, "select count(*) from mail_que2");
                  $data = mysqli_fetch_array($stra);
				  $datay=$data[0];
				  $strab = mysqli_query($coni, "select count(*) from mail_que");
                  $datab = mysqli_fetch_array($strab);
				  $datak=$datab[0];
				  $datat=$datay + $datak;
				  $date = date('d/m/y H:i:s', time());
                  echo " Kul ".number_format($datak)." + Yön ".number_format($datay)."= ".number_format($datat). " - ". $date;
				  ?> )
                  </p></td>
                </tr>
                <tr>
                  <td valign="top" > <center>   <span class="govde"><strong> Üye Kayıt </strong></span>
                  </center>  <table width="65%" border="1" align="center" cellpadding="2" cellspacing="0"  bordercolor="#F6F6F6"  bgcolor="#EAEAEA">
                    <tr class="govde">
                      <td width="26%" align="center"><strong>Yıl</strong></td>
                      <td width="30%" align="right"><strong>Ay</strong></td>
                      <td width="44%" align="right"><strong>Sayı</strong></td>
                    </tr>
			<? 
					$str =  " SELECT year( Tarih) yil,MONTH (Tarih) ay, count( * ) sayi ".
								" FROM bilgi ".
								" WHERE Tarih >= DATE_SUB( CURRENT_DATE( ) , INTERVAL '1'  YEAR )  ".
								" GROUP BY year( Tarih ) , MONTH ( Tarih) ".
								" ORDER BY year( Tarih ) DESC , MONTH ( Tarih) DESC";
					$resultm = mysqli_query($coni,$str);
					while ($rowm = mysqli_fetch_array($resultm)){
			?>
                    <tr class="govde">
                      <td align="center"><? echo $rowm["yil"];?></td>
                      <td align="right"><? echo $rowm["ay"];?></td>
                      <td align="right"><? echo $rowm["sayi"];?></td>
                    </tr>
				<? } ?>
                  </table></td>
                  <td  align="center" valign="top" class="govde"><strong> Teklif Talebi</strong>                    <table width="65%" border="1" align="center" cellpadding="2" cellspacing="0"  bordercolor="#F6F6F6"  bgcolor="#EAEAEA">
                    <tr class="govde">
                      <td width="26%" align="center"><strong>Yıl</strong></td>
                      <td width="30%" align="right"><strong>Ay</strong></td>
                      <td width="44%" align="right"><strong>Sayı</strong></td>
                    </tr>
                    <? 
					$str =  " SELECT year( date ) yil,MONTH (date) ay, count( * ) sayi ".
								" FROM kullanim ".
								" WHERE date >= DATE_SUB( CURRENT_DATE( ) , INTERVAL '1'  YEAR )  ".
								" GROUP BY year( date ) , MONTH ( date) ".
								" ORDER BY year( date ) DESC , MONTH ( date) DESC";
					$resultm = mysqli_query($coni,$str);
					while ($rowm = mysqli_fetch_array($resultm)){
			?>
                    <tr class="govde">
                      <td align="center"><? echo $rowm["yil"];?></td>
                      <td align="right"><? echo $rowm["ay"];?></td>
                      <td align="right"><? echo $rowm["sayi"];?></td>
                    </tr>
                    <? } ?>
                  </table></td>
                <td valign="top" > <center>   <span class="govde"><strong> E-posta Giden </strong></span>
                  </center>  <table width="65%" border="1" align="center" cellpadding="2" cellspacing="0"  bordercolor="#F6F6F6"  bgcolor="#EAEAEA">
                    <tr class="govde">
                      <td width="26%" align="center"><strong>Yıl</strong></td>
                      <td width="30%" align="right"><strong>Ay</strong></td>
                      <td width="44%" align="right"><strong>Sayı</strong></td>
                    </tr>
			<? 
					$str =  " SELECT YEAR(b.date) sene, MONTH(b.date) ay, COUNT(a.kullanimid) sayi ". 
							"FROM kulfirmaid as a, kullanim as b ". 
							"WHERE b.date>=SUBDATE(NOW(), INTERVAL 1 YEAR) AND a.kullanimid=b.Kullanimid ". 
							"GROUP BY YEAR(b.date) , MONTH(b.date) ".
							"ORDER BY YEAR(b.date) DESC, MONTH(b.date) DESC";
					$resultm = mysqli_query($coni,$str);
					while ($rowm = mysqli_fetch_array($resultm)){
			?>
                    <tr class="govde">
                      <td align="center"><? echo $rowm["sene"];?></td>
                      <td align="right"><? echo $rowm["ay"];?></td>
                      <td align="right"><? echo number_format($rowm["sayi"]);?></td>
                    </tr>
				<? } ?>
                  </table></td>
                </tr>
                <tr>
                  <td colspan="3" align="center" class="aciklama" bgcolor="#F6F6F6" height="50" valign="middle"><img src="image/yonetici.gif" width="146" height="16" class="ResimDugme" onClick="ilerle()" > </td>
                </tr>
              </table>
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

</script>