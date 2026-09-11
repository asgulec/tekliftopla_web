<?php include "headeryon.php";?>
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
          <table width="540px" align="center" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td colspan="4" height="2" bgcolor="#FFFFFF"></td>
                </tr>
                <tr>
                  <td background="image/yeni_orta.gif" height="50" width="191" >&nbsp;</td>
                  <td background="image/yeni_orta.gif" width="183" align="center" class="Baslik" valign="middle">Son 30 Gün Kayıt Raporu </td>
                  <td background="image/yeni_orta.gif" width="154" valign="middle" align="right" class="Buyuk_Yazi">&nbsp;</td>
                  <td background="image/yeni_orta.gif" width="27" ><img src="image/sag_ok.gif" width="27" height="64"></td>
                </tr>
              </table>
              <table width="540px" align="center">
              <tr>
              <td colspan="2"><span class="title_kucuk">Sayın <?php $verified_user=isset($_SESSION["$verified_user"]) ? $_SESSION["$verified_user"]: ""; echo $verified_user?>,<br><br></span>
              </td>
              </tr>
              <tr>
              <td valign="top">
              <table width="90%"  border="0" align="center" cellpadding="2" cellspacing="0"  bordercolor="#F6F6F6"  bgcolor="#EAEAEA">
                  <tr>
                    <td width="60%" align="right" class="govde"> Toplam Kayıt Sayısı :</td>
                    <td width="40%" align="left" class="govde">
                      <? 
//$date1=date("Ymd")-15;
$date1=date('Y-m-d', strtotime('-30 day'));
$str1rr22233="select firmaid from bilgi Where Tarih>='$date1' order by Tarih";
$result1rr22233=mysqli_query($coni,$str1rr22233);
$toplam33=mysqli_num_rows($result1rr22233);
echo $toplam33;?></td>
                  </tr>
                  <tr align="left">
                    <td colspan="2" >&nbsp;</td>
                  </tr>
                  <tr>
                    <td  class="title_kucuk" align="center">Tarih</td>
                    <td class="title_kucuk" align="right">Kayıt Sayısı </td>
                  </tr>
                  <?
//$date13=date("Ymd")-15;
$date13=date('Y-m-d', strtotime('-30 day'));
$str1rr22="select distinct Tarih from bilgi where Tarih >='$date13' order by  Tarih desc ";
$result1rr22=mysqli_query($coni,$str1rr22);
while ($row1rr22 = mysqli_fetch_array($result1rr22)){
$ad=$row1rr22['Tarih'];
$zamanx1=explode("-",$ad);
$str1="SELECT count(firmaid) as ali FROM bilgi where Tarih='$ad'";
$result1=mysqli_query($coni,$str1);
while ($row1 = mysqli_fetch_array($result1)){
$adet=$row1['ali'];
echo "<tr><td align=center class=govde>".$zamanx1[2]."-".$zamanx1[1]."-".$zamanx1[0]."</td><td align=right class=govde>".$adet."</td></tr>";
}}
?>
                    
              </table>
           </td>
           <td valign="top">
           <table width="90%"  border="0" align="center" cellpadding="2" cellspacing="0"  bordercolor="#F6F6F6"  bgcolor="#EAEAEA">
                  <tr>
                    <td width="60%" align="right" class="govde"> Toplam Mesaj Sayısı :</td>
                    <td width="40%" align="left" class="govde">
                      <? 
$sql33 = "SELECT COUNT(a.kullanimid) sayi FROM kulfirmaid as a, kullanim as b WHERE b.date>=SUBDATE(NOW(), INTERVAL 31 DAY) AND a.kullanimid=b.Kullanimid";
$result33=mysqli_query($coni,$sql33);
$row1rr33 = mysqli_fetch_array($result33);
$toplam33=$row1rr33['sayi'];
echo number_format($toplam33);?></td>
                  </tr>
                  <tr align="left">
                    <td colspan="2" >&nbsp;</td>
                  </tr>
                  <tr>
                    <td  class="title_kucuk" align="center">Tarih</td>
                    <td class="title_kucuk" align="right">Mesaj Sayısı </td>
                  </tr>
                  <?
$str1rr22="SELECT DATE(b.date) tarih, COUNT(a.kullanimid) sayi FROM kulfirmaid as a, kullanim as b WHERE b.date>=SUBDATE(NOW(), INTERVAL 31 DAY) AND a.kullanimid=b.Kullanimid GROUP BY DATE(b.date) ORDER BY DATE(b.date) DESC ";
$result1rr22=mysqli_query($coni,$str1rr22);
while ($row1rr22 = mysqli_fetch_array($result1rr22)){
$tarih=$row1rr22['tarih'];
$tarih2 = date('d-m-Y', strtotime($tarih));
/* $dtmp = explode("-",$tarih);
$dadate = mktime(0,0,0,$dtmp[1],$dtmp[2],$dtmp[0]);
$tarih2=date('d/m/Y',$dadate);*/
$sayi=$row1rr22['sayi']; 
echo "<tr><td align=center class=govde>".$tarih2."</td><td align=right class=govde>". number_format($sayi)."</td></tr>";
}
?>
                    
             </table>
             </td>
             </tr>
             <tr>
              <td valign="top" colspan="2">
              <table width="90%"  border="0" align="center" cellpadding="2" cellspacing="0"  bordercolor="#F6F6F6"  bgcolor="#EAEAEA">
                  <tr>
                    <td width="60%" align="right" class="govde" colspan="2"> Bu ay üye kayıt sayısı:</td>
                    <td width="40%" align="left" class="govde" colspan="2">
                      <? 
//$date1=date("Ymd")-15;
$str1="select count(firmaid) from bilgi Where month(Tarih)=month(now()) and year(Tarih)=year(now())";
list($kayit_sayisi)=mysqli_fetch_array(mysqli_query($coni,$str1));
echo $kayit_sayisi;?></td>
                  </tr>
                  <tr align="left">
                    <td colspan="4" >&nbsp;</td>
                  </tr>
                  <tr>
                    <td  class="title_kucuk" align="center">Kaydeden</td>
                    <td  class="title_kucuk" align="right">Bu gün</td>
                    <td  class="title_kucuk" align="right">Bu ay</td>
                    <td class="title_kucuk" align="right">Toplam</td>
                  </tr>
                  <?
//$date13=date("Ymd")-15;
$str1rr22="select yonid,username from yonetim order by  username asc";
$result1rr22=mysqli_query($coni,$str1rr22);
while ($row1rr22 = mysqli_fetch_array($result1rr22)){
$yonid=$row1rr22['yonid'];
$username=$row1rr22['username'];
$str1="select count(firmaid) from bilgi where kaydeden=$yonid";
list($kayit_sayisi)=mysqli_fetch_array(mysqli_query($coni,$str1));
$str2="select count(firmaid) from bilgi Where month(Tarih)=month(now()) and year(Tarih)=year(now()) and kaydeden=$yonid";
list($kayit_ay)=mysqli_fetch_array(mysqli_query($coni,$str2));
$str3="select count(firmaid) from bilgi Where Tarih=curdate() and kaydeden=$yonid";
list($kayit_gun)=mysqli_fetch_array(mysqli_query($coni,$str3));
if($kayit_sayisi>0)
echo "<tr><td align=center class=govde>".$username."</td><td align=right class=govde>".$kayit_gun."</td><td align=right class=govde>".$kayit_ay."</td><td align=right class=govde>".$kayit_sayisi."</td></tr>";

}
?>
                    
              </table>
           </td>
           </tr>
           <tr><td colspan="2" valign="top">&nbsp;</td>
             </tr>
             <tr>
               <td colspan="4"></tr>
             
             <tr>
             <td height="50" colspan="2" align="center" valign="middle" bgcolor="#f6f6f6" class="aciklama"><img src="image/yonetici.gif" width="146" height="16" class="ResimDugme" onClick="ilerle()" ></td>>
</tr>   
</table>
</div>
  <div id="bant1"></div> <!-- bant2 -->
  
</div>
</BODY>
</HTML>
<script language="javascript">
 function ilerle() 
 {
  window.location="yonetimgiris.php";
 }

</script>