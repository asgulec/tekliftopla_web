<?php include"headeri.php";?>
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
  <?php include "menu.php" ?>
</div>
<div id="analong">
<table width="97%" align="center"  cellspacing="0" cellpadding="0" border="0" bgColor=white >
<tr>
  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td colspan="4" height="2" bgcolor="#FFFFFF"></td>
      </tr>
      <tr height="25px">
        <td width="25%">&nbsp;</td>
        <td width="25%" ></td>
        <td valign="middle" width="43%" align="right" class="title">Güncel Teklif Talepleri</td>
        <td valign="bottom" align="right" width="7%" ><img src="image/sag_ok.gif"></td>
      </tr>
    </table></td>
</tr>
<tr>
  <td height="10px"></td>
</tr>
	            <tr> <? $verified_firma = isset ($_SESSION["verified_firma"]) ? $_SESSION["verified_firma"] : '';?>
            <td valign="middle" class="Baslik" bgcolor="#F6F6F6" >Sayın <?php echo isset ($_SESSION["verified_firma"]) ? $_SESSION["verified_firma"] : '';?> kayıtlı olduğunuz iş kollarındaki güncel teklif talepleri;
                  <table bgcolor="#FFFFFF" width="100%"  border="0" align="center" cellpadding="1" cellspacing="0"  >
                    <?
$date11=date('Y-m-d', strtotime('-3 day'));

$verified_firmaid = isset ($_SESSION["verified_firmaid"]) ? $_SESSION["verified_firmaid"] : '';
$stryy3455="SELECT DISTINCT kullanim.*, bilgi.*, sehir.sehir, country.ulke coun FROM kullanim left join kulsektor on (kullanim.Kullanimid=kulsektor.Kullanimid) left join firma_sektor on (kulsektor.sektorid=firma_sektor.sektorid)left join bilgi on (kullanim.firmaid=bilgi.firmaid) left join sehir on (kullanim.sehirid=sehir.sehirid) left join country on (kullanim.ulke=country.iso3) where firma_sektor.firmaid ='$verified_firmaid' and kullanim.readable='1' and kullanim.tarih >'$date11' order by kullanim.tarih asc";

$resultyy3455=mysqli_query($connection,$stryy3455);

require "page.php";// sayfalara ay&yacute;rma scripti
$stryy34="SELECT DISTINCT kullanim.*, bilgi.*, sehir.sehir, country.ulke coun FROM kullanim left join kulsektor on (kullanim.Kullanimid=kulsektor.Kullanimid) left join firma_sektor on (kulsektor.sektorid=firma_sektor.sektorid)left join bilgi on (kullanim.firmaid=bilgi.firmaid) left join sehir on (kullanim.sehirid=sehir.sehirid) left join country on (kullanim.ulke=country.iso3) where firma_sektor.firmaid ='$verified_firmaid' and kullanim.readable='1' and kullanim.tarih > '$date11' order by kullanim.tarih asc limit $basla,$artma";

$resultyy34=mysqli_query($connection,$stryy34);
$ok1=mysqli_num_rows($resultyy3455);
if($ok1){ 
$j=$page*$artma+1;
$i=$basla+1;?>
                    <tr >
                      <td height="30" class="govde" colspan="5" align="center"><strong><?php echo $ok1 ?> adet </strong></td>
                    </tr>
                    <tr>
                      <td class="title_kucuk" width="5%">&nbsp;</td>
                      <td class="title_kucuk" width="50%">Teklif İsteyen </td>
                      <td class="title_kucuk" width="15%">Teslim Yeri</td>
                      <td width="22%" align="center" class="title_kucuk">Son Teklif Tarihi</td>
                      <td width="8%" align="center" class="title_kucuk">Özet</td>
                    </tr>
                    <?php while ($rowyy34= mysqli_fetch_array($resultyy34)){
 $i++;
$firmsname=$rowyy34['Firma_Adi'];
$tarif=$rowyy34['text'];
$tarif1=nl2br($tarif);
$tarif2=substr($tarif,0,100);
if(!$firmsname){
	$firmsname=$rowyy34['Firma'];
}
/* $tarif=$rowyy34['text'];
$tarif1=nl2br($tarif); */
$kulidx=$rowyy34['Kullanimid'];
$range1=$rowyy34['tarih'];
$zaman4=explode("-",$range1);
$tarihi=$zaman4[2]."-".$zaman4[1]."-".$zaman4[0];
$meml = ($rowyy34['coun']=="Turkey" ? $rowyy34['sehir'] : $rowyy34['coun']) ;
?>
                    <tr>
                      <td  width="5%" class="govde"><? echo $j++; ?></td>
                      <td  width="50%" class="govde"><a href='tekliflerigor.php?kullanimidxler=<? echo $kulidx;?>' > <font color=#0066ff> <? echo $firmsname;?></font></a></td>
                      <td  class=govde width="15%">
					    <? echo $meml; ?></td>
                      <td  width="22%" align="center"  class=govde><? echo $tarihi;?></td>
                      <td   width="8%" align="center" class=info1><img src=image/note01.gif width=22 height=31 border=0 title='<? echo $tarif;?>'></td>
                    </tr>
                    <?				} ?>
                    <tr>
                      <td>&nbsp;&nbsp;</td>
                    </tr>
                    <tr>
                      <td colspan=8 style='text-align:center' >
                        <?  if ($prev =='yes')    //previous sayfasi var mi? normalde yok.
                         { echo "<a href='kularagor1.php?page=$ppage'><<</a>";
                        
                          }         //sadece hangi sayfaya gidecegini soyluyor.
       else { ?>
&nbsp;
      <? }    //yoksa: bos.  

               for( $i = 0; $i < $numpage; $i++ )   //sayfalari yan yana yaziyor.
               {
               $spage =$i+1;
               echo "<a href='kularagor1.php?page=$i' class=startpage2 >&nbsp;<font color=#360>$spage</font>&nbsp;</a>";
               echo " ";
               }
            
       if ($next =='yes')  //next page olacak mi?
       {
       echo "<a href='kularagor1.php?page=$npage'>>></a>";
       }
       else {echo "&nbsp";
	   echo "</td></tr>";
	   };
echo "<tr><td colspan=8 style='text-align:center' class=sss>";
       
echo "</td></tr>";
}

else{?>
                    <tr>
                                        <td colspan="5" align="center" valign="middle" class="govde"><strong><br>
      İş kollarınızda aktif teklif talebi yoktur.<br>
      <br>
                      </strong></td>
                    </tr>
                                      <?}?>
                                      <tr>
                                        <td height="50" colspan="5" align="center" valign="middle">                                            <form name="frmYeniListe" method="post" action="sehirara.php"> 
                                              <a href="#here" onClick="Git();" class="buttonPage"> Kullanıcı Menüsü &nbsp;<i class="icon-arrow-right"></i></a> </form> </td>
                                      </tr>
                  </table></td>
	            </tr>
                  </table>
</div>
<div id="bant1"></div>
<div id="alt">
  <?php include "alt.php" ?>
</div>
</div>

<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
var pageTracker = _gat._getTracker("UA-699917-3");
pageTracker._trackPageview();
</script>
</BODY></HTML>
<script language="javascript">
function Git(){
	window.location = "giris.php";
}
</script>