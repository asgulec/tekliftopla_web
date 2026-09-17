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
<? /*$link=mysql_connect($host,$user,$password) or die("ba&eth;lant&yacute; yok");
$query="SET NAMES 'UTF8'";
mysql_query($query);*/
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
$kulid = isset($_SESSION["verified_firmaid"]) ? (int)$_SESSION["verified_firmaid"] : 0;
$temp5="SELECT Distinct sektorid FROM gecici WHERE firmaid = $kulid";
$result5=mysqli_query ($connection,$temp5);
$rescount=mysqli_num_rows($result5);
$temp6="SELECT Distinct sektorid FROM firma_sektor WHERE firmaid = $kulid";
$result6=mysqli_query ($connection,$temp6);
$mevcut=mysqli_num_rows($result6);
$temp_yeni="SELECT Distinct sektorid FROM gecici WHERE firmaid = $kulid AND sektorid NOT IN (SELECT sektorid FROM firma_sektor WHERE firmaid = $kulid)";
$result_yeni=mysqli_query($connection,$temp_yeni);
$yeni_secilen=mysqli_num_rows($result_yeni);
?>
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
        <td>
		  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td colspan="4" height="2" bgcolor="#FFFFFF"></td>
      </tr>
      <tr height="25px">
        <td width="25%"><img src="image/5/5_2%20copy.gif" width="176" height="64"></td>
        <td width="25%" ></td>
        <td valign="middle" width="43%" align="right" class="title"><p>Güncelleme<br>
          <span class="title_kucuk">Sektörler</span></p></td>
        <td valign="bottom" align="right" width="7%" ><img src="image/sag_ok.gif" width="27"></td>
      </tr>
    </table></td>
      </tr>
      <tr><td height="10px"></td></tr>
      <tr>
        <td class="Baslik" width="100%" valign="top" bgcolor="#F6F6F6"><? $verified_firma = isset($_SESSION["verified_firma"]) ? $_SESSION["verified_firma"] : ''; ?>
          Sayın <? echo $verified_firma;?>, lütfen iş kollarınızı, ürettiğiniz mal veya hizmetleri, yaptığınız işleri seçiniz.</td></tr>
         <tr><td> 
          <span class="govde"><br>Kayıtlı iş kolu adedi: <?php echo $mevcut;?>, yeni seçilen adet: <?php echo $yeni_secilen; ?>. En fazla 25 adet seçebilirsiniz.<br><br></span>          
          <TABLE align="center"  cellPadding="2" cellSpacing="0" width="95%" border="0">
            <FORM action="guncellesil.php" method="post" name="frmSektorGuncelle">
               <tr>               
                 <td colspan="2" align="center"><span class="govde">
                    <? while ($rowkl = mysqli_fetch_array($resultkl)){ ?>
                </span><span class="link_k"><A href='guncelsektorler.php?cat=<? echo $rowkl['sektorgrupid'];?>'><? echo $rowkl['sektorgrup'];?></A>
                        <? } ?>
                  </span> </td>
				  <td></td>
              </tr>
              <tr>
                <td><span class="govde">
                    <?
while ($row = mysqli_fetch_array($result)){ ?>
                  </span>
                    <li style = "margin-left:15px"><span class="link_k"><A href='guncelsektorler.php?cat=<? echo $row['sektorgrupid']; ?>'><? echo $row['sektorgrup']; ?></A>
                          <?php } ?>
                </span></td>
                <td>
                  <span class="govde">
                    <?
while ($row22 = mysqli_fetch_array($result22)){ ?>
                  </span>
                  <li style = "margin-left:15px"><span class="link_k"><A href='guncelsektorler.php?cat=<? echo $row22['sektorgrupid']; ?>'><? echo $row22['sektorgrup']; ?> </A>
                        <? } ?>
                </span> </td>
              </tr>
              
            </FORM>
        </table>
        <TR>
                <td align="center"  valign="middle" colspan="2" height="50"><a href="giris.php" class="buttonPage"> İptal &nbsp;<i class="icon-close" ></i></a><img src= "image/trans.gif" alt="" width="20" height="1"><a href="#here" onClick="javascript:history.go(-1)" class="buttonPage"> Geri &nbsp;<i class="icon-arrow-left"></i></a><img src= "image/trans.gif" alt="" width="20" height="1"><a href="#here" onClick="Gonder()" class="buttonPage"> İlerle &nbsp;<i class="icon-arrow-right"></i></a></td>
              </TR>
        </td>
      </tr>
    </table>
</div>
<div id="bant1"></div>
<div id="alt">
  <?php include "alt.php" ?>
</div>
</div>
</BODY></HTML>
<script language="javascript">
function Gonder()
{
	document.forms.frmSektorGuncelle.submit();
}
</script>