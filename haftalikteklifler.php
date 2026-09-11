<?php include "headeryon.php"; ?>
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
    <?php include "solyonetim.php" ?>
  </div>
  <div id="analong">

 <table width="540px" align="center"  cellspacing="0" cellpadding="0" border="0"bgcolor="#f6f6f6" >
          <tr>
            <td width="540px" align="center" valign="top" bgcolor="#f6f6f6">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td colspan="4" height="2" bgcolor="#FFFFFF"></td>
              </tr>
              <tr  >
                <td background="image/yeni_orta.gif" height="50" width="191" >&nbsp;</td>
                <td background="image/yeni_orta.gif" width="183" align="center" class="Baslik" valign="bottom">Son Haftanın Teklif Talepleri </td>
                <td background="image/yeni_orta.gif" width="154" valign="middle" align="right" class="Buyuk_Yazi">&nbsp;</td>
                <td background="image/yeni_orta.gif" width="27" ><img src="image/sag_ok.gif" width="27" height="64"></td>
              </tr>
            </table>            
            <h4 class="title_kucuk">Sayın <? $verified_user= isset($_SESSION["verified_user"]) ? $_SESSION["verified_user"]:''; echo $verified_user;?>,&nbsp;&nbsp;hoşgeldiniz.</h4>
              <table width="95%"  border="0" align="center" cellpadding="2" cellspacing="0"  bordercolor="#F6F6F6"  bgcolor="#EAEAEA">
                <?
//$datex=date("Ymd");
//$date11=$datex-7;
$stryy222="SELECT bilgi.Firma_Adi, kullanim.date, kullanim.time, kullanim.Kullanimid, text, kullanim.Firma FROM kullanim LEFT JOIN bilgi ON kullanim.firmaid = bilgi.firmaid WHERE  kullanim.readable =  '1' ORDER  BY kullanim.kullanimid DESC  LIMIT 0, 50";
$resultyy22=mysqli_query($coni,$stryy222);
$ok22=mysqli_num_rows($resultyy22);
if($ok22){?>
                <tr>
                  <td width="54" bgcolor="#EAEAEA" class="title_kucuk">Teklif No </td>
                  <td width="324"bgcolor="#EAEAEA" class="title_kucuk">Firma</td>
                  <td width="96"bgcolor="#EAEAEA" class="title_kucuk">Teklif Tarihi </td>
                  <td width="23"bgcolor="#EAEAEA" class="title_kucuk">&nbsp;</td>
                </tr>
                <? while ($rowyy22 = mysqli_fetch_array($resultyy22)){
$teklifno=$rowyy22['Kullanimid'];
$roc22=$rowyy22['date'];
$bzaman2=explode("-",$roc22); 

$tarif=$rowyy22['text'];
$tarif1=nl2br($tarif);
$tarif2=substr($tarif,0,100);

$tarif=$rowyy22['text'];
$tarif1=nl2br($tarif);

?>
<tr><td  class=govde ><? echo $teklifno ?></td>
      <td class=link> <A href='haftalik.php?teklifnos=<? echo $teklifno ?>'><? if ($rowyy22['Firma_Adi'] =="" ) echo $rowyy22['Firma']; else echo $rowyy22['Firma_Adi'] ?> </A></td>
	  <td  class=govde ><? echo $bzaman2[2]."-".$bzaman2[1]."-".$bzaman2[0] ?></td>
      <td  class=govde ><span class="link"><img src="image/note01.gif" title="<? echo $tarif?>"></span></td>
</tr>
	  <? 
							}}
else{?>
                <tr>
                  <td class="info" colspan="4" align="center" bgcolor="#EAEAEA"><br>
                      <span class="not" >G&ouml;nderilmeyen Teklif Bulunamadı</span><br>
                      <br></td>
                </tr>
                <?}?>
                <tr>
                  <td colspan="4" align="center" class="aciklama" bgcolor="#F5F3BF" height="50" valign="middle"><img src="image/yonetici.gif" width="146" height="16" class="ResimDugme" onClick="ilerle()" ></td>
                </tr>
                <tr>
              </table>
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