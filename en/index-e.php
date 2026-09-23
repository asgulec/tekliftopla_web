<?php
include "../ayar.php";
tekliftopla_start_session();

if (isset($_SESSION['verified_firmaid']) && isset($_SESSION['verified_sifrem'])) {
    header('Location: giris-e.php');
    exit;
}

if (!isset($_SESSION['redirect'])) {
    $_SESSION['redirect'] = true;
}
?>
<?php
require_once "../ip.php";
if (!isset($connection) || !($connection instanceof mysqli)) {
  die("Database connection is unavailable.");
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="content-language" content="us" />
<meta name="robots" content="noindex, follow">
<title>tekliftopla</title>
<link href="../css/style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="../jquery/jquery-ui.theme.css">
<link rel="stylesheet" href="../jquery/jquery-ui.css">
<script src="../jquery/external/jquery/jquery.js"></script>
<script src="../jquery/jquery-ui.min.js"></script>
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-699917-3']);
  _gaq.push(['_trackPageview']);
  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
<script type="text/javascript">
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
</script>
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.1.0/cookieconsent.min.css" />
<script src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.1.0/cookieconsent.min.js"></script>
<script>
window.addEventListener("load", function(){
window.cookieconsent.initialise({
  "palette": {
    "popup": {
      "background": "#000"
    },
    "button": {
      "background": "#f1d600"
    }
  },
  "content": {
    "dismiss": "Accept!",
    "href": "https://tekliftopla.com/en/gizlilik-e.htm"
  }
})});
</script>
</head>
<body onLoad="MM_preloadImages('../image/infomedya_hard.gif')">
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>
<?php 
$cevap =isset($_GET['sonuc']) ? $_GET['sonuc'] : '';
if ($cevap == 'epostayok') {?>
<script language="javascript">
 $(function(){
    $( "#dialog-epostayok" ).dialog({
		close: function () {
        window.location.href = "index-e.php"
        },
		modal:true,
		position: {	my: "center",at: "center",of: sayfa},
		buttons:{OK: function () {
    $(this).dialog("close");
	}}
	});	
  });
</script>
<?php } ?>
<div id="sayfa">
  <div id="ust">
<?php include "ust-e.php"; ?>
</div>
  <!-- ust -->
  <div id="bant1"></div>
  <!-- bant1 -->
  <div id="sol">
    <div id="sat1">
<?php
include "menu-e.php";
include "sociallogin-e.php";
?>
    </div>
    <div id="sat2g">
<?php include "uye-e.php"; ?>
    </div>
  </div>
  <!-- sol -->
  <div id="ana">
    <div id="sat1">
      <div class="slider-wrapper theme-default">
        <div id="slider" class="nivoSlider">
<?php
		 $resimler = glob("../image/en/*.{jpg,gif,png,bmp}", GLOB_BRACE);
		 foreach($resimler as $resim)
         echo '<img src='.$resim.' data-thumb='.$resim.' alt="tekliftopla.com" height="192" />';
		 ?>
        </div>
      </div>
      <script type="text/javascript" src="../jquery-1.7.1.min.js"></script> 
      <script> $171 = jQuery.noConflict();</script> 
      <script type="text/javascript" src="../jquery.nivo.slider.pack.js"></script>
      <link rel="stylesheet" href="../nivo-slider.css" type="text/css" media="screen" />
      <link rel="stylesheet" href="../themes/default/default.css" type="text/css" media="screen" />
      <script type="text/javascript">
         $171(window).load(function() {
         $171('#slider').nivoSlider({pauseTime: 5000,randomStart: true,});
         });
         </script> 
    </div>
    <div id="sat2" style="padding-left:5px;">
      <?php $sayim =mysqli_query($connection,"select sektorid from sektorler");
	        $numsay= mysqli_num_rows($sayim);
			$uyesay=mysqli_query($connection,"select firmaid from bilgi where aktivite=1 ");
			$numuye=mysqli_num_rows($uyesay);	  
		 ?>
      <p align="center" style="font-family: Verdana, Geneva, sans-serif; font-size: 15px; color: #063; font-style: italic; font: Verdana;          font-weight: bold;">Send requests for proposal (RFP's) to<br>
        suppliers in Turkey.</p>
      <p align="left" style="margin:3px" > <span class="govde">Easiest and free way to reach <?php echo number_format( $numuye); ?> suppliers in <?php echo $numsay; ?> lines of business in Turkey for your corporate or personal goods and services procurements. !!!<br>
        <br>
        <br>
        <br>
        </span></p>
      <div class="fb-like" data-href="http://www.facebook.com/tekliftopla" data-send="true" data-layout="button_count" data-width="400" data-show-faces="false" data-font="lucida grande"></div>
    </div>
  </div>
  <!-- ana -->
  <div id="sag">
    <div id="sag">
      <table>
        <tr>
          <td style="margin:auto"><?php include "kur-e.php"; ?></td>
        </tr>
        <tr>
          <td style="margin:auto;"><?php
       $sqltek = mysqli_query($connection,"SELECT kullanimid from kullanim where kullanim.tarih >= curdate() and kullanim.readable = '1'");
		 $rowtek = mysqli_num_rows($sqltek);
         if ($rowtek > 0) {
     ?>
            <p align="center" style="font-family: Verdana, Geneva, sans-serif; font-size: x-small; color: #333; font-style: italic; font: Verdana;"><span><br>
              <a>( Active RFP's : <?php echo number_format( $rowtek); ?> ) </a></span></p></td>
         <?php } ?>
        </tr>
      </table>
    </div>
    <div id="sat2">
      <table style="margin-left:auto; margin-right:auto">
        <tr>
          <td valign="middle" align="center"><?php
	$q="select rekid, grafik, link from rekkayit 
		where bastarih <= now()
		and sontarih >= now()
		and rektip=2
    and adet > tiksayac
    and adet > 0
		order by kaytarih asc limit 0,1";
	$r=mysqli_query($connection,$q);
	$n=mysqli_num_rows($r);
	if($n>0) {
		list($rekid, $grafik, $link)=mysqli_fetch_array($r);
	}
	else {
    $q="select rekid, grafik, link from rekkayit where rektip=12 and adet > tiksayac and adet > 0 order by kaytarih desc limit 0,1";
		$r=mysqli_query($connection,$q);
		list($rekid, $grafik, $link)=mysqli_fetch_array($r);
	}	
	mysqli_query($connection,"update rekkayit set sayac=sayac+1 where rekid=$rekid");
	$reklam_link_code=urlencode($rekid);
	$ext=explode(".",$grafik);
	$ext=$ext[count($ext)-1];
	if($ext=="swf") {
		$grafik_name=explode(".swf",$grafik);
		$grafik_name=$grafik_name[0];
	?>
            <script type="text/javascript">
AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0','width','141','height','96','src','../reklamlar/<?php echo $grafik_name; ?>','quality','high','pluginspage','http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash','movie','../reklamlar/<?php echo $grafik_name; ?>', 'flashvars', 'clickTAG=http://www.tekliftopla.com/redirectbanner.php?d=<?php echo $reklam_link_code; ?>' ); //end AC code
    </script>
            <noscript>
            <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0" width="141" height="96" align="right" valign="middle">
              <param name="movie" value="../reklamlar/<?php echo $grafik; ?>" />
              <param name="quality" value="high" />
              <embed src="../reklamlar/<?php echo $grafik; ?>" flashvars="clickTAG=http://www.tekliftopla.com/redirectbanner.php?d=<?php echo $reklam_link_code; ?>" width="141" type="application/x-shockwave-flash" height="96" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" align="right" valign="middle"></embed>
            </object>
            </noscript>
            <?php
	}
	else {
	  ?>
            <a href="http://www.tekliftopla.com/redirectbanner.php?d=<?php echo $reklam_link_code; ?>" target="_blank"><img src="../reklamlar/<?php echo $grafik; ?>" border="0" width="141" height="96" /></a>
            <?php
	}
	  ?></td>
        </tr>
      </table>
    </div>
  </div>
  <!-- sag -->
  <div id="bant1"></div>
  <!-- bant1 -->
  <div id="alt">
    <?php include "alt-e.php"; ?>
  </div>
  <!-- alt -->
  <div id="dialog-epostayok" title="Warning" style="display:none" class="text_g" >
    <p> Please check your e-mail and password and try again... </p>
    <p>Click "Forgot Password" to receive your password if needed...</p>
  </div>
</div>
<!-- sayfa --> 
<!-- Yeniden Pazarlama Etiketi için Google Kodu --> 
<!--------------------------------------------------
Yeniden pazarlama etiketleri, kimlik bilgileriyle ilişkilendirilemez veya hassas kategorilerle ilgili sayfalara yerleştirilemez. Daha fazla bilgi edinmek ve etiketin nasıl ayarlanacağıyla ilgili talimatlar için şu adresi ziyaret edin: http://google.com/ads/remarketingsetup
---------------------------------------------------> 
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 1068850805;
var google_custom_params = window.google_tag_params;
var google_remarketing_only = true;
/* ]]> */
</script> 
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;"> <img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/1068850805/?value=0&amp;guid=ON&amp;script=0"/> </div>
</noscript>
</body>
</html>