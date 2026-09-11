<style>

#hoverbox {

	float:left;

    position:relative;

}



#hoverbox img {

    width:150px;

}



#hoverbox:hover img {

    position: absolute;

    bottom:0px;

	right:-150px;

	/*top:-250px;

    left:-150px; */

    width:200px;

    display:block;

    z-index:999;

}

div#root {

    position: relative;

    width: 150px;

    height: 170px;

}



/* iframe itself */

div#root > iframe {

    display: block;

    width: 100%;

    height: 100%;

    border: none;

}



div#root:hover {

    position: relative;

    top:-80px;

	right:0px;

	z-index:999;

}

div#root:hover > iframe {

    display: block;

    width: 250px;

    height: 250px;

    border: none;

}

</style>



<div id="sag">

<div style="position:relative">

<table>

     <tr><td style="margin:auto"><? include "kur.php"; ?></td></tr>

     <tr><td style="margin:auto;">

         <? 

	     $sqltek = mysqli_query($connection,"SELECT kullanimid from kullanim where kullanim.tarih >=curdate()");

		 $rowtek = mysqli_num_rows($sqltek);

	     if ($rowtek>10) {?>

<p align="center" style="font-family: Verdana, Geneva, sans-serif; font-size: 10px; color: #333; font-style: italic; font: Verdana;"><span> <a title="Kayıtlı olduğunuz iş kollarında teklif toplayanları görmek için üye girişi yapınız.">Teklif bekleyen sayısı:<?php echo number_format( $rowtek); ?></a><a title="Kayıtlı olduğunuz iş kollarında teklif toplayanları görmek için üye girişi yapınız."><br>

  (Üye girişi yapınız)</a></span></p>
         <? } else { ?> <a title=""><br><br><br></a> <? } ?>
     </td>

     </tr>

     <tr>

     <td valign="top" align="right">

     <div id="root" style="display:none">

     </div>

    </td>

    </tr>

     <tr>

     <td height="140px" valign="bottom" align="right">

     <?php

	  $q="select rekid, grafik, link from rekkayit 

		where bastarih <= now()

		and sontarih >= now()

		and rektip=2

		order by kaytarih asc limit 0,1";

	$r=mysqli_query($connection,$q);

	$n=mysqli_num_rows($r);

	if($n>0) {

		list($rekid, $grafik, $link)=mysqli_fetch_array($r);

	 }

	 else {

		$q="select rekid, grafik, link from rekkayit where rektip=12 order by kaytarih desc limit 0,1";

		$r=mysqli_query($connection,$q);

		list($rekid, $grafik, $link)=mysqli_fetch_array($r);

	 }

	

	mysqli_query($connection,"update rekkayit set sayac=sayac+1 where rekid=$rekid");

	$reklam_link_code=urlencode(base64_encode($rekid));

	$ext=explode(".",$grafik);

	$ext=$ext[count($ext)-1];

	if($ext=="swf") {

		$grafik_name=explode(".swf",$grafik);

		$grafik_name=$grafik_name[0];

	?>

  <script type="text/javascript">

AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0','width','141','height','96','src','reklamlar/<?php echo $grafik_name; ?>','quality','high','pluginspage','http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash','movie','reklamlar/<?php echo $grafik_name; ?>', 'flashvars', 'clickTAG=http://www.tekliftopla.com/redirectbanner.php?d=<?php echo $reklam_link_code; ?>' ); //end AC code

    </script>

  <noscript>

  <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0" width="141" height="96" align="right" valign="middle">

    <param name="movie" value="reklamlar/<?php echo $grafik; ?>" />

    <param name="quality" value="high" />

    <embed src="reklamlar/<?php echo $grafik; ?>" flashvars="clickTAG=http://www.tekliftopla.com/redirectbanner.php?d=<?php echo $reklam_link_code; ?>" width="141" type="application/x-shockwave-flash" height="96" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" align="right" valign="middle"></embed>

  </object>

  </noscript>

  <?php

	}

	else {

	  ?>

  <div id="hoverbox"> <a href="http://www.tekliftopla.com/redirectbanner.php?d=<?php echo $reklam_link_code; ?>" target="_blank"><img src="reklamlar/<?php echo $grafik; ?>" border="0" ></a></div>

  <?php

	}

	  ?>

    </td>

    </tr>

    </table>

    </div>  

</div>

