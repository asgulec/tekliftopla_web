<?php include"headeryon.php"; ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>tekliftopla</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
<body>
<?php //************counter bilgilerini görüntüleme
function get_country($ip) {
    return file_get_contents("http://ipinfo.io/{$ip}/country");
}
$stra="SELECT * FROM  ip ";
$resulta = mysqli_query($coni,$stra);
$ghit=mysqli_num_rows($resulta);
$date=date("Ymd");
$strcc="SELECT * FROM  ip  where date='$date' order by time desc";
$resultcc=mysqli_query($coni,$strcc);
/* $str="SELECT * FROM  ip  where date='$date' order by time desc limit 15"; */
$str="SELECT ip FROM  ip  where date='$date' group by ip";
$result=mysqli_query($coni,$str);
$hit=mysqli_num_rows($resultcc);?>
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
                <td background="image/yeni_orta.gif" width="183" align="center" class="Baslik" valign="middle">Site Erişim İstatistikleri </td>
                <td background="image/yeni_orta.gif" width="154" valign="middle" align="right" class="Buyuk_Yazi">&nbsp;</td>
                <td background="image/yeni_orta.gif" width="27" ><img src="image/sag_ok.gif" width="27" height="64"></td>
              </tr>
            </table>            
              <p><span class="title_kucuk">Sayın </span><span class="title_kucuk"><? $verified_user= isset($_SESSION["verified_user"])? $_SESSION["verified_user"]: ''; echo $verified_user;?></span></p>
              <table width="95%"  border="0" align="center" cellpadding="2" cellspacing="0"  bordercolor="#F6F6F6"  bgcolor="#EAEAEA">
                <tr>
                  <td width="238" align="right" class="govde">Siteyi ziyaret edenlerin toplam sayısı:</td>
                  <td width="267" class="govde"><? echo $ghit?></td>
                </tr>
                <tr>
                  <td align="right" class="govde">Bugün siteyi ziyaret edenlerin sayısı: </td>
                  <td class="govde"><? echo $hit?></td>
                </tr>
                <tr>
                  <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="2" align="center" class="govde">This product includes GeoLite data created by MaxMind, available from
  <a href="http://www.maxmind.com">http://www.maxmind.com</a>.</td>
                </tr>
                <tr>
                  <td valign="top"> <center>   <span class="govde"><strong>Son 12 Aylık Ziyaret</strong></span> </center>  
                  <table width="40%" border="2" align="center" cellpadding="1" cellspacing="0"  bordercolor="#F6F6F6"  bgcolor="#EAEAEA">
                    <tr class="govde">
                      <td width="26%" align="center"><strong>Yıl</strong></td>
                      <td width="30%" align="right"><strong>Ay</strong></td>
                      <td width="44%" align="right"><strong>Sayı</strong></td>
                    </tr>
			<? 
					$str =  " SELECT year( date ) yil,MONTH (date) ay, count( * ) sayi ".
								" FROM ip ".
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
                  <td valign="top"> <center>   <span class="govde"><strong>Bu gün bağlanan ip'ler</strong></span> </center>  
                  <table width="78%" border="2" align="center" cellpadding="1" cellspacing="0"  bordercolor="#F6F6F6"  bgcolor="#EAEAEA">
                    <tr class="govde">
                      <td width="43%" align="left"><strong>IP</strong></td>
                      <td width="57%" align="right"><strong>Ülke</strong></td>
                    </tr>
                  <?php	while ($row = mysqli_fetch_array($result)){ ?>
					<tr class="govde">
                      <td align="left"><?php echo $row["ip"];?></td>
                      <td align="right">
                      <?php
                       $ipx= $row["ip"];
					   $iplong = ip2long($ipx);
					   $sip = "SELECT cn FROM ipdb WHERE $iplong BETWEEN start AND end LIMIT 1";
					   $res=mysqli_query($coni,$sip);
					   $rw = mysqli_fetch_array($res);
					   echo $rw["cn"];
                       ?> 
                      </td>
                    </tr>
                    <?php } ?>
                </table></td>
                </tr>
                <tr>
                  <td colspan="2" align="center" class="aciklama" bgcolor="#F6F6F6" height="50" valign="middle"><img src="image/yonetici.gif" width="146" height="16" class="ResimDugme" onClick="ilerle()" ></td>
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