<html>
<head>
<title>tekliftopla</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="css/style.css" rel="stylesheet" type="text/css">
<style>
.mesaj1 {font-family:Verdana, Arial, Helvetica, sans-serif ;font-size:10pt; color:#525764; }
.mesaj2 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 8pt; color: #4D8C4E; font-weight: bold; }
</style>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<?php
    $reklam_grafik = isset($reklam_grafik) ? $reklam_grafik : '';
    $sfirma = isset($sfirma) ? $sfirma : '';
    $tarih2 = isset($tarih2) ? $tarih2 : '';
    $sure = isset($sure) ? $sure : '';
    $teslim = isset($teslim) ? $teslim : '';
    $metin = isset($metin) ? $metin : '';
    $iletisim = isset($iletisim) ? $iletisim : '';
    $adres = isset($adres) ? $adres : '';
    $syetkili = isset($syetkili) ? $syetkili : '';
    $smail = isset($smail) ? $smail : '';
    $teklifid = isset($teklifid) ? $teklifid : '';
    $dil = isset($dil) ? $dil : '';
    $reklam_link = isset($reklam_link) ? $reklam_link : 'http://www.tekliftopla.com';
    $cik = isset($cik) ? $cik : '';
    $cikex = isset($cikex) ? $cikex : '';
?>
<style>
#gallery { height: 100%; width: 400px; position: relative; }

#gallery img {
  /* CSS Hack will make it width 100% and height 100% */
  position: absolute;
  top: 0px;
  right: 0px;
  bottom: 0px;
  left: 0px;
  /* Maintain aspect ratio */
  max-height: 100%;
  max-width: 100%;
}

</style>
<table width="600" border="0" align="center" cellpadding="2" cellspacing="0" bgcolor="#F9F9F9">
  <tr><td colspan="2"  bgcolor="#B5B8C0" height="8px" style="font-size:8px; line-height:8px;"><img src= "image/trans.gif" style="display: block;" alt="" width="1" height="1"></td></tr>
  <!-- <tr> 
    <td colspan="2" bgcolor="#B5B8C0">&nbsp;</td>
  </tr> -->
  <tr> 
    <td bgcolor="#FFFFFF" align="left"><a href="http://www.tekliftopla.com"><img src="http://www.tekliftopla.com/image/logo.gif" width="176"></a></td>
    <td bgcolor="#FFFFFF" align="center"><a href="<?php echo htmlspecialchars($reklam_link, ENT_QUOTES, 'UTF-8'); ?>"><img src="http://www.tekliftopla.com/reklamlar/<?php echo htmlspecialchars($reklam_grafik, ENT_QUOTES, 'UTF-8'); ?>" width="420px" border="0"></a></td>
  </tr>
  <tr><td colspan="2"  bgcolor="#B5B8C0" height="8px" style="font-size:8px; line-height:8px;"><img src= "image/trans.gif" style="display: block;" alt="" width="1" height="1"></td></tr>
  <!-- <tr><td colspan="2" bgcolor="#B5B8C0">&nbsp;</td></tr> -->
  <tr> 
    <td colspan="2" >&nbsp;</td>
  </tr>
  <tr> 
    <td colspan="2" ><div align="center">
        <div style="background-color:#FDFDFD ; text-align:justify"><p><span class="mesaj1" style="font-size:9px; color:#E92D39"><strong><u>HATIRLATMA</u></strong><br><br>Bugüne kadar bizden aldığınız tüm teklif talep e-postalarımızda olduğu gibi, bu ve bundan sonraki mesajlarımızda da istediğiniz zaman listemizden çıkabileceğinizi hatırlatmak isteriz.<br><br>
Tek yapmanız gereken e-postalarımızın hepsinin altında bulunan &quot;Mesaj listesinden çıkmak için tıklayınız&quot; cümlesini kullanmaktır.</span><br><br>
       </div> 
        <span class="mesaj1">Aşağıdaki şartlarda teklif istenilmektedir,<br><br>
        <strong><u>soruları ve teklifinizi BAŞVURU ADRESİNE</u></strong> gönderiniz.</span><br></p>
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
                  <td width="30%" align="right" valign="top" class="mesaj2">Başvuru Adresi:</td>
                  <td valign="top" class="mesaj1">(<?php echo $iletisim; ?>)  <?php echo $adres; ?></td>
                </tr>
                <tr> 
                  <td width="30%" align="right" valign="top" class="mesaj2">Yetkili Kişi:</td>
                  <td valign="top" class="mesaj1"><?php echo $syetkili; ?></td>
                </tr>
                <tr> 
                  <td width="30%" align="right" valign="top" class="mesaj2">E-Posta:</td>
                  <td valign="top"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> <a href="mailto:<?php echo $smail; ?>" class="link"><?php echo $smail; ?></a></font></td>
                </tr>
            </table></td>
          </tr>
        </table>
        
      </div>
      <p align="center" class="mesaj1"><br>
	 	Bu mesaj ile ilgili bize yapacağınız müracaatlarda <strong><?php echo $teklifid; ?></strong> 
        teklif numarasını belirtiniz.<br><br>
        <span style="font-size:9px">(Yukarıda verilen bilgilerin doğruluğuyla ilgili tekliftopla.com hiç bir sorumluluk kabul etmez. Taleplerin gönderilmesini durdurmak veya değiştirmek için www.tekliftopla.com da üyelik kaydınızı değiştirebilirsiniz.<br><br>
        <?php if ($dil=="TUR") { ?>
        Mesaj listesinden çıkmak için <a href="http://www.tekliftopla.com/kaysilposta.php" >tıklayınız.</a><br>
        <?php } else { ?> 
        Yurtdışından teklif taleplerini almak istemiyorsanız <a href="http://www.tekliftopla.com/kaysilex.php" >tıklayınız.</a><br>
        <?php } ?>
        </span><br>
        <a href="http://www.tekliftopla.com">www.tekliftopla.com</a> 
      </p></td>
  </tr>
  <tr> 
    <td colspan="2" >&nbsp;</td>
  </tr>
  <tr><td colspan="2"  bgcolor="#B5B8C0" height="8px" style="font-size:8px; line-height:8px;"><img src= "image/trans.gif" style="display: block;" alt="" width="1" height="1"></td></tr>
  <!-- <tr><td colspan="2" bgcolor="#B5B8C0">&nbsp;</td></tr> -->
</table>
</body>
</html>