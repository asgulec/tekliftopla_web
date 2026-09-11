<?php
session_start(); //control default lang vs user preferance
if (!isset( $_SESSION['redirect']))
  {$lang = isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2) : '';
   $_SESSION['redirect'] = true;  
   if ($lang !== "tr")
     { header("Location: en/index-e.php"); 
	 }
	 else {header("Location: index.php");
	 }
   exit();}
?>
<? include "ip.php";?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<link rel="stylesheet" href="jquery/jquery-ui.theme.css">

<link rel="stylesheet" href="jquery/jquery-ui.css">

<link href="css/style.css" rel="stylesheet" type="text/css">

<script src="jquery/external/jquery/jquery.js"></script>

<script src="jquery/jquery-ui.min.js"></script>



<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta http-equiv="content-language" content="tr" />

<meta name="robots" content="noindex, follow">

<meta name="description" content="Teklif toplamanın ve toplanan tekliflerden haberdar olmanın en kolay yolu. Güncel fiyatlara, güncel tedarikçilere, satıcılara ulaşın.">

<meta name="keywords" content="teklif, fiyat, sigorta, teklif topla, fiyat al, jeneratör, boya">

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
    "message": "Veri politikasındaki amaçlarla sınırlı ve mevzuata uygun şekilde çerez konumlandırmaktayız. Detaylar için veri politikamızı inceleyebilirsiniz.",
    "dismiss": "Kabul ediyorum!",
    "link": "Daha fazla bilgi",
    "href": "https://tekliftopla.com/gizlilik.htm"
  }
})});
</script>

</head>



<body>

<?php 

$cevap =isset($_GET['sonuc']) ? $_GET['sonuc'] : '';

if ($cevap == 'epostayok') {?>



<script language="javascript">

 $(function(){

    $( "#dialog-epostayok" ).dialog({

		close: function () {

        window.location.href = "index.php"

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

         echo '<img src='.$resim.' data-thumb='.$resim.' alt="tekliftopla.com"  />'; // height="192" çıkartıldı

		 ?>

      </div>

    </div>

    <script type="text/javascript" src="jquery-1.7.1.min.js"></script>

    <script> $171 = jQuery.noConflict();</script>

    <script type="text/javascript" src="jquery.nivo.slider.pack.js"></script>

    <link rel="stylesheet" href="nivo-slider.css" type="text/css" media="screen" />

    <link rel="stylesheet" href="themes/default/default.css" type="text/css" media="screen" />

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

    <p align="center" class="title" > TEKLİF TOPLAMANIN EN KOLAY YOLU</p>

    <p align="left" style="margin:3px" > <span class="govde">Türkiye'nin her yerinde <?php echo $numsay; ?> değişik iş kolunda kayıtlı <?php echo number_format( $numuye); ?> üye ile şahsi ve kurumsal mal ve hizmet alımlarınızda teklif toplamanın, toplanan tekliflerden haberdar olmanın en kolay ve bedava yolu !<br>

      <br>

      Kısa tanıtım için <a href="tekliftopla sunum.ppsx" target="_blank"> tıklayınız </a>.<br></span></p>

          

  </div>

  <div id="sat2" style="padding-left:5px;"><?php include "socialicons.php"; ?>

  </div>

</div>

  

<div id="sag">

<?php include "sag.php"; ?>

</div>

<div>

<?php 

 $datex=date('Y-m-d', strtotime('-1 day'));



 $strx=mysqli_query($connection,"SELECT kullanim.textshort as textshort, sehir.sehir as sehir, country.ulke as memleket FROM kullanim, sehir, country where kullanim.sehirid=sehir.sehirid and kullanim.readable='1' and kullanim.tarih >'$datex' and kullanim.textshort !='' and kullanim.ulke=country.iso3 ORDER BY RAND()");

 

 $scroll ="";

 $xadet=mysqli_num_rows($strx);

 

if ($xadet>40) {

while ($row = mysqli_fetch_array($strx)) {

	if ($row['memleket']=='Turkey') {

    $scroll=$scroll.$row['textshort']." - ".$row['sehir']."......... "; }

	else { $scroll=$scroll.$row['textshort']." - ".$row['memleket']."......... "; }

}



?>

  <marquee scrolldelay="1" scrollamount="3" hspace="12px" width="700px" class="govde"><?php echo $scroll; ?> </marquee> 

<?php }; ?>

</div>  <!-- bant1 -->

<div id="alt">

    <? include "alt.php";?>

  </div>

<div id="dialog-epostayok" title="Uyarı" style="display:none" class="text_g" >

  <p>

    E-posta adresi veya şifre hatalı, tekrar deneyiniz... </p>

   <p>Şifrenizi unuttuysanız "Şifremi Unuttum" düğmesini tıklayınız...</p>

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