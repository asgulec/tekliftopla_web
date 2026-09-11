<?php include"headerki.php"; ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="content-language" content="tr" />
<title>tekliftopla</title>
<link rel="stylesheet" href="jquery/jquery-ui.theme.css">
<link rel="stylesheet" href="jquery/jquery-ui.css">
<script src="jquery/external/jquery/jquery.js"></script>
<script src="jquery/jquery-ui.min.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css">
<?php
/*$link=mysql_connect($host,$user,$password) or die("ba&eth;lant&yacute; yok");
$query="SET NAMES 'UTF8'";
mysql_query($query);
mysql_select_db($db);*/
?>
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
<table width="540" align="center"  cellspacing="0" cellpadding="0" border="0" bgColor=white >
<tr>
  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td colspan="4" height="2" bgcolor="#FFFFFF"></td>
      </tr>
      <tr height="25px">
        <td width="25%"><img src="image/5/5_2%20copy.gif" width="176" height="64"></td>
        <td width="25%" ></td>
        <td valign="middle" width="43%" align="right" class="title"><p>Yeni Üye<br>
          <span class="title_kucuk">Sektörler</span></p></td>
        <td valign="bottom" align="right" width="7%" ><img src="image/sag_ok.gif" width="27"></td>
      </tr>
    </table></td>
</tr>
<tr>
  <td height="10px"></td>
</tr>
<tr>
  <? $verified_firma = isset($_SESSION['verified_firma']) ? $_SESSION['verified_firma'] : ''; ?>
  <td class="Baslik" valign="top" bgcolor="#F6F6F6" style="margin-left:5px">Sayın <?php echo $verified_firma;?>, NELER SATARSINIZ ?</td></tr>
  <tr><td class="govde"><br>Ürettiğiniz, sattığınız mal veya hizmetleri (faaliyet alanlarınızı) seçiniz.<br>
<br>En fazla <strong>25</strong> iş kolu seçebilirsiniz. Tamamladığınızda "İlerle" düğmesini tıklayınız.<br>    <br>
  </td></tr>
  <tr><td>
    <TABLE align="center"  cellPadding="2" cellSpacing="0" width="95%" border="0" >
      <FORM action="denetle.php" method="post" name="frmSektor">
        <input type="hidden" name="yazi" id="yazi" >
        <?
$sekgrupsay="SELECT * FROM  sektor_grup";
$resultgrup=mysqli_query($connection,$sekgrupsay);
$saygrup=mysqli_num_rows($resultgrup);
$saygrupa=ceil(($saygrup-1)/2);
$saygrupb=$saygrupa+1;
$str="SELECT * FROM  sektor_grup where sektorgrupid!='26'  order by sektorgrup limit 0,$saygrupa";
$result=mysqli_query($connection,$str);
$str22="SELECT * FROM  sektor_grup where sektorgrupid!='26'  order by sektorgrup limit $saygrupa,$saygrupb";
$result22=mysqli_query($connection,$str22);
$strkl="SELECT * FROM  sektor_grup where sektorgrupid='26'";
$resultkl=mysqli_query($connection,$strkl);
$kulid=isset($_SESSION['verified_firmaid']) ? $_SESSION['verified_firmaid'] : '';
$temp5="SELECT Distinct sektorid FROM gecici1 WHERE firmaid = '$kulid'";
$result5=mysqli_query ($connection,$temp5);
$rescount=mysqli_num_rows($result5);
?>
        <tr >
          <td colspan="2" class="govde" align="center"><strong>
            <? while ($rowkl = mysqli_fetch_array($resultkl)){
$cat1=$rowkl['sektorgrupid']; ?>
            <A class="link_k" href='sektorler.php?cat=<? echo $cat1;?>'><? echo $rowkl['sektorgrup'];?> </A>
            <? } ?>
            </strong></td>
        </tr>
        <tr>
          <td><?
while ($row = mysqli_fetch_array($result)){
$cat1=$row['sektorgrupid']; ?>
            <li style="margin-left:15px"><A class="link_k" href='sektorler.php?cat=<? echo $cat1; ?>'> <? echo $row['sektorgrup']; ?></A>
              <? }
?>
          </td>
          <td><?
while ($row22 = mysqli_fetch_array($result22)){
$cat1=$row22['sektorgrupid']; ?>
            <li style="margin-left:15px"><A class="link_k" href='sektorler.php?cat=<? echo $cat1; ?>'> <? echo $row22['sektorgrup']; ?></A>
              <? }
?>
          </td>
        </tr>
        <tr>
          <td class="not" colspan="2"><br>Not: Birden fazla iş kolu seçmenizi tavsiye ederiz. Şu ana kadar seçilen iş kolu sayısı: <? echo $rescount ?></td>
        </tr>
        <TR>
          <td align="center"  valign="middle" colspan="2" height="50"><a href="cikis.php" class="buttonPage"> İptal &nbsp;<i class="icon-close" ></i></a><img src= "image/trans.gif" alt="" width="20" height="1"><a href="#here" onClick="javascript:history.go(-1)" class="buttonPage"> Geri &nbsp;<i class="icon-arrow-left"></i></a><img src= "image/trans.gif" alt="" width="20" height="1"><a href="#here" onClick="Gonder()" class="buttonPage"> İlerle &nbsp;<i class="icon-arrow-right"></i></a></td>
        </TR>
      </FORM>
    </table>
</table>
</div>
<div id="bant1"></div>
<div id="alt">
  <?php include "alt.php" ?>
</div>
</div>
<div id="dialog-hata" title="Uyarı" style="display:none" class="text_g" >
  <p>
    En az 1 iş kolu seçmelisiniz...
  </p>
</div>

</body>
</HTML>
<script language="javascript">
function Gonder(){
	var total = <? echo $rescount ?>; 
	if(total < 1)
   { $(function(){
    $( "#dialog-hata" ).dialog({
		modal:true,
		position: {	my: "center",at: "center",of: sayfa},
		buttons:{Tamam: function () {
    $(this).dialog("close");
}}
	});	
  });
	}
	else {
	document.forms.frmSektor.submit(); }
    }
function Iptal(){
	window.location = "index.php";
}

</script>