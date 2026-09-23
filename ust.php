<style type="text/css">

.opakrenkli {

opacity:0.2;

filter:alpha(opacity=20);



}

</style>

<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>



<table border="0" align="center" cellpadding="0" cellspacing="0">

  <tr bgcolor="#B9B6BF" >

    <td colspan="3" height="6"> </td>

  </tr>

  <tr>

    <td width="176" align="left"><img src="<?php echo TEKLIFTOPLA_LOGO_PATH; ?>" width="176" height="62"></td>

    <td width="400" align="center" valign="middle"><?php if (!isset($connection) && isset($coni) && $coni instanceof mysqli) { $connection = $coni; } if (isset($connection) && $connection instanceof mysqli): ?><div align="center" style="position:relative;opacity:1;filter:alpha(opacity=100);width:400px;">

    <?php

  $rekid = 0;
  $grafik = '';
  $link = '';
  $r=mysqli_query($connection,"select rekid, grafik, link from rekkayit

		where bastarih <= now()

		and sontarih >= now()

		and rektip=1

    and adet > tiksayac

    and adet > 0

		order by kaytarih asc limit 0,1");

  $n=$r ? mysqli_num_rows($r) : 0;

	if($n>0) {

    if ($banner=mysqli_fetch_array($r)) {
      list($rekid, $grafik, $link)=$banner;
    }

	}

	else {

    $r=mysqli_query($connection,"select rekid, grafik, link from rekkayit where rektip=11 and adet > tiksayac and adet > 0 order by kaytarih desc limit 0,1");

    if ($r && ($banner=mysqli_fetch_array($r))) {
      list($rekid, $grafik, $link)=$banner;
    }

	}

	

  if ($rekid > 0 && $grafik !== '') {
    mysqli_query($connection,"update rekkayit set sayac=sayac+1 where rekid=$rekid");
  }

	$reklam_link_code=urlencode($rekid);

	

	$ext=explode(".",$grafik);

	$ext=$ext[count($ext)-1];

	if($ext=="swf") {

		$grafik_name=explode(".swf",$grafik);

		$grafik_name=$grafik_name[0];

	?>

 <script type="text/javascript">

AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0','width','370','height','80','src','reklamlar/<?php echo $grafik_name; ?>','quality','high','pluginspage','http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash','movie','reklamlar/<?php echo $grafik_name; ?>' ); //end AC code

    </script>

      <noscript>

        <object style="position:absolute;top:0px;left:0px;z-index:5;" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0" width="370" height="80" align="middle" >

          <param name="movie" value="reklamlar/<?php echo $grafik; ?>?clickTAG=http://www.tekliftopla.com/redirectbanner.php?d=<?php echo $reklam_link_code; ?>" />

          <param name="quality" value="high" />

          <embed src="reklamlar/<?php echo $grafik; ?>?clickTAG=http://www.tekliftopla.com/redirectbanner.php?d=<?php echo $reklam_link_code; ?>" width="370" type="application/x-shockwave-flash" height="80" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" align="middle"></embed>

        </object>

        </noscript>     

      <a style="position:absolute;top:0px;left:0px;z-index:10;width:400px;height:80px;text-indent:-9000px;" href="http://www.tekliftopla.com/redirectbanner.php?d=<?php echo $reklam_link_code; ?>" target="_blank"> /></a>

	  <?php

	} else {

	   ?>

      <a href="http://www.tekliftopla.com/redirectbanner.php?d=<?php echo $reklam_link_code; ?>" target="_blank"><img src="reklamlar/<?php echo $grafik; ?>" border="0" width="385" height="60" /></a>

      <?php

	} 

	   ?> 

    </div><?php endif; ?></td>

    <td align="right" valign="middle" width="155" ><?php $englishTarget = (isset($_SESSION['verified_firmaid']) && isset($_SESSION['verified_sifrem'])) ? 'en/giris-e.php' : '/en/index-e.php'; ?>
    <a href="<?php echo $englishTarget; ?>"><img width="43" border="0" alt="UK-Flag" src="image/britishflag.gif"/></a><br>

    <span class="link"><a href="soruoneri.php">SSS</a></span> | <a href="<?php echo $englishTarget; ?>" class="link" >English</a></td>

  </tr>

  <tr class="opakrenkli" bgcolor=<?php  $r = rand(128,255); 

       $g = rand(128,255); 

       $b = rand(128,255); 

       $color = dechex($r) . dechex($g) . dechex($b);

       echo "#".$color;  ?>;>

    <td colspan="3" height="6" ></td>

  </tr>

</table>

