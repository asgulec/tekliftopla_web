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

<table width="540px" align="center"  cellspacing="0" cellpadding="0" border="0" bgColor=white >
      <tr>
        <td>
		  <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td colspan="4" height="2" bgcolor="#FFFFFF"></td>
            </tr>
            <tr >
              <td background="image/yeni_orta.gif" height="50" width="191" ><img src="image/5/5_2%20copy.gif" width="176" height="64"></td>
              <td background="image/yeni_orta.gif" width="183" align="center" class="Baslik" valign="bottom">Sektör Grupları </td>
              <td background="image/yeni_orta.gif" width="154" valign="middle" align="right" class="Buyuk_Yazi"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td align="right">Yeni Üye</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                </tr>
              </table>                </td>
              <td background="image/yeni_orta.gif" width="27" ><img src="image/sag_ok.gif" width="27" height="64"></td>
            </tr>
          </table></td>
      </tr>
      <tr><? $verified_firma = isset($_SESSION["verified_firma"]) ? $_SESSION["verified_firma"]: ""; ?>
        <td valign="top" bgcolor="#F6F6F6" style="margin-left:5px"> <span class="title_kucuk" ><?echo $verified_firma;?> ürettiği, sattığı mal veya hizmetleri (faaliyet alanlarınızı) seçiniz.<br>
        <br> 
        En fazla <strong>25</strong> sekt&ouml;r se&ccedil;ebilirsiniz. Tamamladığınızda "İlerle" düğmesini tıklayınız.<br><br></span>
          <TABLE align="center"  cellPadding="2" cellSpacing="0" width="95%" border="0" >
			<FORM action="yondenetle.php" method="post" name="frmSektor">
            <input type="hidden" name="yazi" id="yazi" >
<?
$sekgrupsay="SELECT * FROM  sektor_grup";
$resultgrup=mysqli_query($coni,$sekgrupsay);
$saygrup=mysqli_num_rows($resultgrup);
$saygrupa=ceil($saygrup/2);
$str="SELECT * FROM  sektor_grup where sektorgrupid!='26'  order by sektorgrup limit 0,$saygrupa";
$result=mysqli_query($coni,$str);
$str22="SELECT * FROM  sektor_grup where sektorgrupid!='26'  order by sektorgrup limit $saygrupa,$saygrupa";
$result22=mysqli_query($coni,$str22);
$strkl="SELECT * FROM  sektor_grup where sektorgrupid='26'";
$resultkl=mysqli_query($coni,$strkl);
$kulid=isset($_SESSION["verified_firmaid"]) ? $_SESSION["verified_firmaid"] : "";
$temp5="SELECT Distinct sektorid FROM gecici1 WHERE firmaid = '$kulid'";
$result5=mysqli_query ($coni,$temp5);
$rescount=mysqli_num_rows($result5);
?>
            <tr >
              <td colspan="2" class="govde" align="center"><strong> 
                <? while ($rowkl = mysqli_fetch_array($resultkl)){
$cat1=$rowkl['sektorgrupid']; ?>
                <A class="link" href='yonsektorler.php?cat=<? echo $cat1;?>'><? echo $rowkl['sektorgrup'];?> </A>                <? } ?>                  
                </strong></td>
            </tr>
            <tr>
              <td>
                <?
while ($row = mysqli_fetch_array($result)){
$cat1=$row['sektorgrupid']; ?>
                <li style="margin-left:15px"><A class="link" href='yonsektorler.php?cat=<? echo $cat1; ?>'> <? echo $row['sektorgrup']; ?></A>
                    <? }
?>
                  </td>
              <td>
                <?
while ($row22 = mysqli_fetch_array($result22)){
$cat1=$row22['sektorgrupid']; ?>
                <li style="margin-left:15px"><A class="link" href='yonsektorler.php?cat=<? echo $cat1; ?>'> <? echo $row22['sektorgrup']; ?></A>
                    <? }
?>
                  </td>
            </tr>
            <tr>
                      <td class="not" colspan="2">Not: Birden fazla sektör seçmenizi tavsiye ederiz. Şu ana kadar seçilen sektör sayısı: <? echo $rescount ?></td>
                    </tr>
            <TR>
              <td align="center" colspan="2" height="50" ><img src="image/iptalet.gif" width="146" height="16" class="ResimDugme" onClick="javascript:window.location ='yonetimgiris.php'" ><img src= "image/trans.gif" alt="" width="20" height="1"><img src="image/geri.gif" width="89" height="16" class="ResimDugme" onClick="javascript:history.go(-1)"><img src= "image/trans.gif" alt="" width="20" height="1"><img src="image/ilerle.gif" width="146" height="16" class="ResimDugme" onClick="Gonder()"></td>
            </TR>
			</FORM>          
		</table>          </td>
      </tr>
    </table>
  </div>
  <div id="bant1"></div> <!-- bant2 -->
  
</div>
</body>
</HTML>
<script language="javascript">
document.onkeypress = processKey;

function processKey(e)
{
  if (null == e)
    e = window.event ;
  if (e.keyCode == 13)  {
    Gonder() ;
  }
}
function Gonder(){
	var total = <? echo $rescount ?>; 
	if(total < 1)
   { alert( " En az 1 sektör seçmelisiniz. ");
   }
	else {
	document.forms.frmSektor.submit(); }
    }
function Iptal(){
	window.location = "yonetimgiris.php";
}

</script>