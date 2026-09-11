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
   <table width="540px" align="center" cellspacing="0" cellpadding="0" border="0"bgcolor="#f6f6f6" >
   <tr>
     <td width="540px" valign="top" bgcolor="#f6f6f6">
     <table width="100%" border="0" cellspacing="0" cellpadding="0">
     <tr>
      <td colspan="4" height="2" bgcolor="#FFFFFF"></td>
     </tr>
     <tr>
      <td background="image/yeni_orta.gif" width="191" >&nbsp;</td>
      <td background="image/yeni_orta.gif" width="183" align="center" class="Baslik" valign="bottom">Ayrılan 50 Üye Dökümü</td>
      <td background="image/yeni_orta.gif" width="154" valign="middle" align="right" >&nbsp;</td>
      <td background="image/yeni_orta.gif" width="27" ><img src="image/sag_ok.gif" width="27" height="64"></td>
     </tr>
     </table>
     </td>
   </tr>
   </table>            
   <h4 class="title_kucuk">Sayın <? $verified_user= $_SESSION["verified_user"]; echo $verified_user;?>,&nbsp;&nbsp;hoşgeldiniz.</h4>
   <table width="95%"  border="0" align="center" cellpadding="1" cellspacing="0"  bordercolor="#F6F6F6"  bgcolor="#EAEAEA">
          <?php $stryy22="SELECT b.undate, b.firmaid, a.Firma_Adi, a.Sehir FROM bilgi as a, unsubslist as b WHERE b.firmaid=a.firmaid ORDER BY b.undate DESC LIMIT 0, 50";
           $resultyy22=mysqli_query($coni,$stryy22);
           $ok222=mysqli_num_rows($resultyy22);
           if($ok222){?>
   <tr>
    <td width="12%" bgcolor="#EAEAEA" class="govde"><strong>Tarih</strong></td>
    <td width="20%" bgcolor="#EAEAEA" class="govde"><strong>Firma Adı</strong></td>
                  <!-- <td width="30" bgcolor="#EAEAEA" class="govde">e-posta</td> -->
    <td width="17%" bgcolor="#EAEAEA" class="govde"><strong>Şehir</strong></td>
    <td width="10%" bgcolor="#EAEAEA" class="govde"><strong>ID</strong></td>
    <td width="41%" bgcolor="#EAEAEA" class="govde"><strong>Sektörler</strong></td>
   </tr>
           <? while ($rowyy22 = mysqli_fetch_array($resultyy22)){
            $ftarih=date('d-m-y', strtotime($rowyy22['undate']));
            $nfirmaid=$rowyy22['firmaid'];
            $firmaad=substr($rowyy22['Firma_Adi'],0,15);
            $bcity=$rowyy22['Sehir']; 
           ?>
   <tr> 
    <td valign="top" class=govde ><? echo $ftarih ?></td>
    <td valign="top" class=govde ><? echo $firmaad ?></td>
    <td valign="top" class=govde ><? echo $bcity ?></td>
    <td valign="top" class=govde ><? echo $nfirmaid ?></td>
    <td valign="top" class=govde >
		   <?php
	       $sekrow="select a.sektor from sektorler as a, firma_sektor as b where b.firmaid='$nfirmaid' and a.sektorid = b.sektorid";
	       $sekdok=mysqli_query($coni,$sekrow);
	       while ($sekler = mysqli_fetch_array($sekdok))
           { echo $sekler['sektor']; ?> / <?php }
	       ?>
     </td>
   </tr>
	       <? 
			}}
           else{?>
   <tr>
    <td class="info" colspan="5" align="center" bgcolor="#EAEAEA"><br>
             <span class="not" >Üye bulunamadı</span><br>
      <br></td>
   </tr>
           <?php }?>
   <tr>
    <td colspan="5" align="center" class="aciklama" bgcolor="#F6F6F6" height="50" valign="middle"><img src="image/yonetici.gif" width="146" height="16" class="ResimDugme" onClick="ilerle()" > </td>
   </tr>
   </table>
</div>
  <div id="bant1"></div> <!-- bant2 -->
  <div id="alt" style="clear:left">
    <?php include "alt.php" ?>
  </div>
</div>
</BODY>
</HTML>
<script language="javascript">
 function ilerle() 
 {
  window.location="yonetimgiris.php";
 }

</script>