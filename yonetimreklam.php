<?php include"headeryon.php"; ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="content-language" content="tr" />
<title>tekliftopla reklam</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style1 {
	font-size: 36px;
	font-family: "Times New Roman", Times, serif;
	color: #FF0066;
}
-->
</style>
<script type="text/javascript" src="calendarDateInput.js"></script>

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
            <td valign="top" bgcolor="f6f6f6"><span class="title_kucuk">Sayın <? echo $verified_user;?>,</span>&nbsp;&nbsp;<span class="title_kucuk">reklam yönetim sayfasındasınız.</span>
                    <table width="100%">
<?php
$q="select rekkayit.rekid, rektip.tipid, rektip.tipadi, rekkayit.izah, rekkayit.bastarih, rekkayit.sontarih, rekkayit.adet, rekkayit.sayac, rekkayit.tiksayac, rekkayit.grafik, rekkayit.link, rekkayit.rektip from rekkayit, rektip where rekkayit.rektip=rektip.tipid order by rekkayit.rektip asc, rekkayit.rekid asc";
$r=mysqli_query($coni,$q);
$n=mysqli_num_rows($r);
for($i=0;$i<$n;$i++) {
	list($rekid, $rektipid, $rektip, $izah, $bastarih, $sontarih, $adet, $sayac, $tiksayac, $grafik, $link, $tipid)=mysqli_fetch_array($r);
?>
<tr>
<td>
<?php
	$ext=explode(".",$grafik);
	$ext=$ext[count($ext)-1];
	if($ext=="swf") {
		$grafik_name=explode(".swf",$grafik);
		$grafik_name=$grafik_name[0];
	?>
 <script type="text/javascript">
AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0','width','141','height','96','src','reklamlar/<?php echo $grafik_name; ?>','quality','high','pluginspage','http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash','movie','reklamlar/<?php echo $grafik_name; ?>' ); //end AC code
    </script>
      <noscript>
        <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0" width="141" height="96" align="right">
          <param name="movie" value="reklamlar/<?php echo $grafik; ?>" />
          <param name="quality" value="high" />
          <embed src="reklamlar/<?php echo $grafik; ?>" width="141" type="application/x-shockwave-flash" height="96" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" align="right"></embed>
        </object>
        </noscript>     
      <?php
	}
	else {
	  ?>
      <a href="<?php echo $link; ?>" target="_blank"><img src="reklamlar/<?php echo $grafik; ?>" border="0" width="141" /></a>
      <?php
	}
	  ?>
</td>
<td>
<form id="reklamyonet" name="reklamyonet" onSubmit="formaction(this)" method="post" enctype="multipart/form-data"/>
<table cellspacing="0">
<tr><td class="govde">İzah :</td>
  <td class="govde">
    <input type="hidden" name="rekid" value="<?php echo $rekid; ?>"/>
    <input type="hidden" name="rektip" value="<?php echo $tipid; ?>"/>
    <input type="text" name="izah" size="45" value="<?php echo $izah; ?>" />
    <br>
    [<?php echo $tipid; ?>] <?php echo $rektip; ?>[Rekid <?php echo $rekid; ?>]</td>
</tr>
<tr><td class="govde">Başlangıç :</td>
  <td class="govde">
    <script>DateInput('bastarih<?php echo $rekid; ?>', true, 'YYYY-MM-DD', '<?php echo $bastarih; ?>')</script>
  </td>
</tr>
<tr><td class="govde">Bitiş :</td>
  <td class="govde">
    <script>DateInput('sontarih<?php echo $rekid; ?>', true, 'YYYY-MM-DD', '<?php echo $sontarih; ?>')</script>
  </td>
</tr>
<tr><td class="govde">Sayaç / Adet :</td>
  <td class="govde"><?php echo $sayac; ?> / <input type="text" name="adet" size="3" value="<?php echo $adet; ?>" />
    Tık Sayısı : 
	<?php 
	if( $tipid==3 or $tipid==13 ){
	list($tiksay)=mysqli_fetch_array(mysqli_query($coni,"select count(r.id) from rektik as r, kulfirmaid as k where r.kulfirmaid=k.id and k.rekid=$rekid"));
	echo $tiksay; ?>  / 
	<?php
	list($tikson30)=mysqli_fetch_array(mysqli_query($coni,"select count(c.id) from rektik as c, kulfirmaid as d where c.kulfirmaid=d.id and d.rekid=$rekid and c.tikdate > subdate(now(),INTERVAL 30 DAY) "));
	echo $tikson30;
	} else { 
	echo $tiksayac;
	}
	
	if( ($adet-$sayac)== 0 || $sontarih <= date("Y-m-d") ) {
    echo '<img src="image/exclamation.gif" border="0" width="20" style="float:right" />';
	}
	?>
    </td>
</tr>
<tr><td class="govde">Link :</td>
  <td class="govde">
    <input type="text" name="link" size="45" value="<?php echo $link; ?>" />
  </td>
</tr>
<tr><td class="govde">Grafik :</td>
  <td class="govde">
    <input type="hidden" name="filename" value="<?php echo $grafik; ?>">
    <input type="hidden" name="MAX_FILE_SIZE" value="150000" /><input type="file"  size="30" name="grafik" />
  </td>
</tr>
<tr><td class="govde"><strong>
 <input type="submit" name="operation" style="width:60px" onclick="if (! confirm('Silmek istediğinize emin misiniz?')) return false;this.form.action = 'reklamsil.php?durum=reksil'" value="Sil" > 
</strong></td><td><input type="submit" name="operation" onclick="if (! confirm('Güncellemek istediğinize emin misiniz?')) return false;this.form.action = 'reklamsil.php?durum=rekguncel'" value="Güncelle" > &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
<?php
if ($rektipid==3) {
?>
 <input type="submit" align="middle" name="operation" style="width:100px" onclick="this.form.action = 'emailrekdok.php'" value="Döküm Gönder" > 
<?php
}
?>
</strong></td>
</tr>
</table>
</form>
</td>
</tr>
<tr>
<td colspan="3">
<hr size="1">
</td>
<?php
}
?>                    
                        </table>
          </tr>
          <tr>
                  <td align="center" class="aciklama" bgcolor="#FFFFFF" height="50" valign="middle"><strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <img src="image/yonetici.gif" width="146" height="16" class="ResimDugme" onClick="ilerle()" > </strong></td>
                </tr>
        </table>
 </div>
  <div id="bant1"></div> <!-- bant2 -->
  <div id="alt" style="clear:left">
    <?php include "alt.php" ?>
  </div>
</div>

</BODY></HTML>
<script language="javascript">
 function ilerle() 
 {
  window.location="yonetimgiris.php";
 
 }


</script>

<?php
$mesg =  isset($_GET['mesg']) ? $_GET['mesg'] : '';
if($mesg =="send_ok") {
?>
<script language="javascript">
	alert(" Reklam dökümü yöneticiye gönderilmiştir. ");
	setTimeout("history.go(-1)",50); 
</script>
<?php
}
?>