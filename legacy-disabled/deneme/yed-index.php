<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<?php
session_start();
$lang = isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2) : '';
if (!isset( $_SESSION['redirect']))
  {$_SESSION['redirect'] = true;  
   if ($lang != "tr")
   { header("Location: en/index-e.php"); 
	exit(); }
	else {header("Location: index.php");
	exit();}
   exit();}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="content-language" content="tr" />
<meta name="robots" content="noindex, follow">
<title>tekliftopla</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
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
<? include "ip.php";?>
</head>

<body>
<div id="sayfa">
<div id="ust">
  <?php include "ust.php" ?>
</div>
<div id="bant1"></div> 
<div id="sol">
  <div id="sat1">
    <?php include "menuindex.php" ?>
    <?php include "sociallogin.php" ?>
  </div>
  <div id="sat2g">
    <?php include "uye.php" ?>
    
  </div>
</div>
<div id="ana">
  <div id="sat1">
    <div class="slider-wrapper theme-default">
      <div id="slider" class="nivoSlider">
        <?php
		 $resimler = glob("image/index/*.{jpg,gif,png,bmp}", GLOB_BRACE);
		 foreach($resimler as $resim)
         echo '<img src='.$resim.' data-thumb='.$resim.' alt="tekliftopla.com" height="192" />';
		 ?>
      </div>
    </div>
    <script type="text/javascript" src="jquery-1.7.1.min.js"></script> 
    <script type="text/javascript" src="jquery.nivo.slider.pack.js"></script>
    <link rel="stylesheet" href="nivo-slider.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="themes/default/default.css" type="text/css" media="screen" />
    <script type="text/javascript">
         $(window).load(function() {
         $('#slider').nivoSlider({pauseTime: 5000,randomStart: true,});
         });
         </script> 
  </div>
  <div id="sat2" style="padding-left:5px;">
    
	<?php $sayim =mysql_query("select sektorid from sektorler");
	        $numsay= mysql_num_rows($sayim);
			$uyesay=mysql_query("select firmaid from bilgi where aktivite=1 ");
			$numuye=mysql_num_rows($uyesay);	  
		 ?>
    <p align="center" class="title" > TEKLİF TOPLAMANIN EN KOLAY YOLU</p>
    <p align="left" style="margin:3px" > <span class="govde">Türkiye'nin her yerinde <?php echo $numsay; ?> değişik iş kolunda kayıtlı <?php echo number_format( $numuye); ?> üye ile şahsi ve kurumsal mal ve hizmet alımlarınızda teklif toplamanın, toplanan tekliflerden haberdar olmanın en kolay ve bedava yolu !<br>
      <br>
      Kısa tanıtım için <a href="tekliftopla sunum.ppsx" target="_blank"> tıklayınız </a>.<br><br><br></span></p>
          
  </div>
  <div id="sat2" style="padding-left:5px;"><?php include "socialicons.php"; ?>
  </div>
</div>
  
<div id="sag">
<?php include "sag.php"; ?>
</div>
<div id="bant1"></div>  <!-- bant1 -->
<div id="alt">
    <? include "alt.php";?>
  </div>
</div>


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
<div style="display:inline;"><img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/1068850805/?value=0&amp;guid=ON&amp;script=0"/></div>
</noscript>

</body>
</html>