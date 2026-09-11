<?php include "headeryon.php"; ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="content-language" content="tr" />
<title>tekliftopla</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
<?php
if (isset($_SESSION["KulEkle"]))
		$KulEkle = $_SESSION["KulEkle"];
	else
		$KulEkle = 0;
?>
<style type="text/css">
<!--
.style1 {
	font-size: 36px;
	font-family: "Times New Roman", Times, serif;
	color: #FF0066;
}
-->
</style>
</head>
<body>
<div id="sayfa">
  <div id="ust">
    <?php include "ust.php" ?>
  </div>
  <!-- ust -->
  <div id="bant1"></div>
  <!-- bant1 -->
  <div id="sol">
    <?php include "solyonetim.php" ?>
  </div>
  <!-- sol -->
  <div id="analong">
  <!-- ana -->
  <table width="540px" align="center"  cellspacing="0" cellpadding="0" border="0" bgColor=white >
    <tr>
      <? $verified_user =isset($_SESSION["verified_user"]) ? $_SESSION["verified_user"] : '';
			   $gunkayit=$aykayit=$yilkayit=0;
			   $resyonid=mysqli_query($coni, "select yonid from yonetim where username='$verified_user'");
			   if(mysqli_num_rows($resyonid) ) {
			   $rowyon = mysqli_fetch_array($resyonid);
			   $yonid=$rowyon['yonid'];
			   $rowyyon22=mysqli_query($coni,"select count(firmaid) as adetay from bilgi Where month(Tarih)=month(now()) and year(Tarih)=year(now()) and kaydeden=$yonid");
			   $rowyyon2=mysqli_fetch_array($rowyyon22);
			   $aykayit=$rowyyon2['adetay'];
			   $rowyyon33=mysqli_query($coni,"select count(firmaid) as adetyil from bilgi Where year(Tarih)=year(now()) and kaydeden=$yonid");
			   $rowyyon3=mysqli_fetch_array($rowyyon33);
			   $yilkayit=$rowyyon3['adetyil'];
			   $rowyyon44=mysqli_query($coni,"select count(firmaid) as adetgun from bilgi Where day(Tarih)=day(now()) and month(Tarih)=month(now()) and year(Tarih)=year(now())and kaydeden=$yonid");
			   $rowyyon4=mysqli_fetch_array($rowyyon44);
			   $gunkayit=$rowyyon4['adetgun'];
			   }
			   ?>
      <td align="center" valign="top" bgcolor="#FFFFFF"><span class="title_kucuk">Yönetici Menüsü <br>
        Sayın <? echo $verified_user .' (kayıt sayınız bu gün='.$gunkayit.', ay='.$aykayit.', yıl='.number_format($yilkayit).')';?></span>&nbsp;&nbsp;<span class="title_kucuk"></span></td>
    </tr>
    <tr>
      <td><table width="353"  border="0" align="center" cellpadding="3" cellspacing="0"  bordercolor="#F6F6F6"  bgcolor="f6f6f6">
          <tr>
            <td><table align="center" width="353"  border="0" cellpadding="2" cellspacing="5"  bordercolor="#F6F6F6"  bgcolor="f6f6f6">
                <? 	if  ($KulEkle== 1 or $KulEkle==2 or $KulEkle==3)  {?>
                <tr>
                  <td><i class="icon-stop" style="color: #294590; font-size:10px"></i><a href="yonkayit.php" class="text_g" style="font-size:14px"> Yeni Üye Ekle</a></td>
                </tr>
                <tr>
                  <td ><i class="icon-stop" style="color: #294590; font-size:10px"></i><a href="yontekkullanim.php" class="text_s" style="font-size:14px"> Yönetim Teklif Talebi</a></td>
                </tr>
                <? } ?>
                <? 	if  ($KulEkle== 1 or $KulEkle==2)  {?>
                <tr>
                  <td ><i class="icon-stop" style="color: #294590; font-size:10px"></i><a href="istatistik.php" class="text_c" style="font-size:14px"> İstatistik</a></td>
                </tr>
                <tr>
                  <td ><i class="icon-stop" style="color: #294590; font-size:10px"></i><a href="yonetimkullanim.php" class="link"> Teklif Topla</a></td>
                </tr>
                <tr>
                  <td ><i class="icon-stop" style="color: #294590; font-size:10px"></i><a href="mailcontrol.php" class="link"> Teklifleri Kontrol Et</a></td>
                </tr>
                <tr>
                  <td ><i class="icon-stop" style="color: #294590; font-size:10px"></i><a href="teklifbul.php" class="link"> Teklif Numarasına Göre Arama</a></td>
                </tr>
                <tr>
                  <td ><i class="icon-stop" style="color: #294590; font-size:10px"></i><a href="emailbul.php" class="link"> E-posta Adresine Göre Arama</a></td>
                </tr>
                <tr>
                  <td ><i class="icon-stop" style="color: #294590; font-size:10px"></i><a href="uyelistesi.php" class="link"> Üye Listesi</a></td>
                </tr>
                <tr>
                  <td ><i class="icon-stop" style="color: #294590; font-size:10px"></i><a href="kullanimlistesi.php" class="link"> Kullanım Listesi</a></td>
                </tr>
                <? } ?>
                <? 	if  ($KulEkle== 1)  {?>
                <tr>
                  <td ><i class="icon-stop" style="color: #294590; font-size:10px"></i><a href="emailbulx.php" class="link"> E-posta değistir</a></td>
                </tr>
                <tr>
                  <td ><i class="icon-stop" style="color: #294590; font-size:10px"></i><a href="eskikaysil.php?islem=kayitsil" class="link"> Eski Kayıtları Sil</a></td>
                </tr>
                <tr>
                  <td ><i class="icon-stop" style="color: #294590; font-size:10px"></i><a href="SektorGrupListe.php" class="link"> Sektörler</a></td>
                <tr>
                  <td ><i class="icon-stop" style="color: #294590; font-size:10px"></i><a href="SektorListe.php" class="link"> İş Kolları </a></td>
                <tr>
                  <td ><i class="icon-stop" style="color: #294590; font-size:10px"></i><a href="IsKoluListe.php" class="link"> Sektör - İş Kolları Eşleştirme</a></td>
                </tr>
                <tr>
                  <td ><i class="icon-stop" style="color: #294590; font-size:10px"></i><a href="reklamkayit.php" class="link"> Reklam Kayıt</a></td>
                </tr>
                <tr>
                  <td ><i class="icon-stop" style="color: #294590; font-size:10px"></i><a href="yonetimreklam.php" class="link"> Reklam Yönetim</a></td>
                </tr>
                <tr>
                  <td ><i class="icon-stop" style="color: #294590; font-size:10px"></i><a href="YoneticiEkleListe.php" class="link"> Yönetici  Ekleme </a></td>
                </tr>
                <? } ?>
                <tr>
                  <td ><i class="icon-stop" style="color: #294590; font-size:10px"></i><a href="yonetimcikis.php" class="link"> Çıkış</a></td>
                </tr>
              </table></td>
          </tr>
        </table></td>
    </tr>
  </table>
  </div>
  <div id="bant1"></div> <!-- bant2 -->
  
</div>
<!-- sayfa -->
</body>
</html>