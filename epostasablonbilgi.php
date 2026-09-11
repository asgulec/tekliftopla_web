<html>
<head>
<title>tekliftopla</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="css/style.css" rel="stylesheet" type="text/css">
<style type="text/css">
.mesaj1 {font-family:Verdana, Arial, Helvetica, sans-serif ;font-size:10pt; color:#525764; }
.mesaj2 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 8pt; color: #4D8C4E; font-weight: bold; }
</style>
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="600" border="0" align="center" cellpadding="2" cellspacing="0" bgcolor="#F9F9F9">
  <tr><td colspan="2"  bgcolor="#B5B8C0" height="6px" style="font-size:6px; line-height:6px;"><img src= "image/trans.gif" style="display: block;" alt="" width="1" height="1"></td></tr>
  <!-- <tr><td colspan="2" bgcolor="#B5B8C0">&nbsp;</td></tr> -->
  <tr> 
    <td bgcolor="#FFFFFF" align="left"><a href="http://www.tekliftopla.com"><img src="http://www.tekliftopla.com/image/logo.gif" width="176" height="62"></a></td>
	   <td bgcolor="#FFFFFF" align="center">
       <?php
	   $sfirma = $sfirma ?? '';
	   $tarih2 = $tarih2 ?? '';
	   $sure = $sure ?? '';
	   $teslim = $teslim ?? '';
	   $metin = $metin ?? '';
	   $iletisim = $iletisim ?? '';
	   $adres = $adres ?? '';
	   $syetkili = $syetkili ?? '';
	   $smail = $smail ?? '';
	   $teklifid = $teklifid ?? '';
	   $tummail = $tummail ?? array();
	   $varsayilan_reklam = array('grafik' => '', 'link' => '');
	   if (isset($coni) && $coni instanceof mysqli) {
	       $varsayilan_reklam = mysqli_fetch_assoc(mysqli_query($coni, "select grafik,link from rekkayit where rektip=13 order by kaytarih desc limit 0,1"));
	       if (!$varsayilan_reklam) {
	           $varsayilan_reklam = array('grafik' => '', 'link' => '');
	       }
	   }
		echo '<a href="'.$varsayilan_reklam['link'].'"><img src="http://www.tekliftopla.com/reklamlar/'.$varsayilan_reklam['grafik'].'" border="0" width="385" height="60" /></a>';
	   ?>
       </td>
  </tr>
  <tr><td colspan="2"  bgcolor="#B5B8C0" height="6px" style="font-size:6px; line-height:6px;"><img src= "image/trans.gif" style="display: block;" alt="" width="1" height="1"></td></tr>
  <!-- <tr><td colspan="2" bgcolor="#B5B8C0">&nbsp;</td></tr> -->
  <tr> 
    <td colspan="2" >&nbsp;</td>
  </tr>
  <tr> 
    <td colspan="2" ><div align="center"> 
        <p class="mesaj1">Aşağıdaki teklif talebiniz ilgili sektör ve şehire hizmet veren üyelerimize gönderilmiştir.</p>
        <table width="550" border="0" cellpadding="0" cellspacing="2" bgcolor="#EFEFEF">
          <tr>
            <td><table width="550" border="0" cellpadding="0" cellspacing="5" bgcolor="#FFFFFF">
                <tr> 
                  <td width="30%" align="right" valign="top" class="mesaj2">Teklif İsteyen:</td>
                  <td valign="top" class="mesaj1"><?php echo $sfirma; ?></td>
                </tr>
                <tr> 
                  <td width="30%" align="right" valign="top" class="mesaj2">Son Teklif Tarihi:</td>
                  <td width="200" valign="top" class="mesaj1"><?php echo $tarih2; ?></td>
                </tr>
                <tr> 
                  <td width="30%" align="right" valign="top" class="mesaj2">Teslim/İş Süresi:</td>
                  <td valign="top" class="mesaj1"><?php echo $sure; ?></td>
                </tr>
                 <tr> 
                  <td width="30%" align="right" valign="top" class="mesaj2">Teslim Yeri:</td>
                  <td valign="top" class="mesaj1"><?php echo $teslim; ?></td>
                </tr>
                <tr> 
                  <td width="30%" align="right" valign="top" class="mesaj2">Teklif İstenilen Mal veya Hizmetin Tarifi:</td>
                  <td valign="top" class="mesaj1"><?php echo $metin; ?></td>
                </tr>
                <tr> 
                  <td width="30%" align="right" valign="top" class="mesaj2">Başvuru Adresi: </td>
                  <td valign="top" class="mesaj1">(<?php echo $iletisim; ?>)  <?php echo $adres; ?></td>
                </tr>
                <tr> 
                  <td width="30%" align="right" valign="top" class="mesaj2">Yetkili Kişi:</td>
                  <td valign="top" class="mesaj1"><?php echo $syetkili; ?></td>
                </tr>
                <tr> 
                  <td width="30%" align="right" valign="top" class="mesaj2">E-Posta: </td>
                  <td valign="top" class="mesaj1"> <a href="mailto:<?php echo $smail; ?>" class="link"><?php echo $smail;?></a></td>
                </tr>
            </table></td>
          </tr>
        </table>
        
      </div>
      <p align="center" class="mesaj1">Bu mesaj ile ilgili bize yapacağınız müracaatlarda <strong><?php echo $teklifid; ?></strong> teklif numarasını belirtiniz.<br>
        <span style="font-size:9px">(Yukarıda verilen bilgilerin doğruluğuyla ilgili tekliftopla.com hiç bir sorumluluk kabul etmez. Taleplerin gönderilmesini durdurmak veya değiştirmek için www.tekliftopla.com da üyelik kaydınızı değiştirebilirsiniz.)<span style="color:#CCC" ><?php echo count($tummail); ?></span></span><br>	
        <br>
        <a href="http://www.tekliftopla.com">www.tekliftopla.com</a> 
      </p></td>
  </tr>
  <tr> 
    <td colspan="2" >&nbsp;</td>
  </tr>
  <tr><td colspan="2"  bgcolor="#B5B8C0" height="6px" style="font-size:6px; line-height:6px;"><img src= "image/trans.gif" style="display: block;" alt="" width="1" height="1"></td></tr>
  <!-- <tr><td colspan="2" bgcolor="#B5B8C0">&nbsp;</td></tr> -->
</table>
</body>
</html>