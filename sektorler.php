<? include"headerki.php"; ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="content-language" content="tr" />
<title>tekliftopla</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
<?php
/*$link=mysql_connect($host,$user,$password) or die("baglanti yok");
$query="SET NAMES 'UTF8'";
mysql_query($query);
mysql_select_db($db);*/
$cat = $_GET["cat"];
$str1="SELECT * FROM sektor_grup where sektorgrupid='$cat'";
$result1=mysqli_query($connection,$str1);
while ($row = mysqli_fetch_array($result1)){
echo "<title>".$row['sektorgrup']."</title>";
?>
</head>

<body>
	
<script>function CheckAll()
{
 for (var i=0;i<document.frmSektor.elements.length;i++)
 {
  var e=document.frmSektor.elements[i];
  if (e.name != 'allbox')
   e.checked=document.frmSektor.allbox.checked;
 }
}</script>

<div id="sayfa">
<div id="ust">
  <?php include "ust.php" ?>
</div>
<div id="bant1"></div>
<div id="sol">
  <?php include "menu.php" ?>
</div>
<div id="analong">
<table width="540" align="center"  cellspacing="0" cellpadding="0" border="0" bgColor="white" >
<tr>
  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td colspan="4" height="2" bgcolor="#FFFFFF"></td>
      </tr>
      <tr height="25px">
        <td width="25%"><img src="image/5/5_3.gif" width="176" height="64"></td>
        <td width="25%" ></td>
        <td valign="middle" width="43%" align="right" class="title"><p>Yeni Üye<br>
          <span class="title_kucuk">İş Kolları</span></p></td>
        <td valign="bottom" align="right" width="7%" ><img src="image/sag_ok.gif" width="27"></td>
      </tr>
    </table></td>
</tr>
<tr>
  <td height="10px"></td>
</tr>
<tr>
<td valign="top" bgcolor="#F6F6F6" class="Baslik"><? $verified_firma = isset($_SESSION['verified_firma']) ? $_SESSION['verified_firma'] : ''; ?>Sayın <? echo $verified_firma; ?>, bu sektörden yaptığınız işleri seçiniz.</td></tr>
<tr><td>
            <table width="95%"  border="0" align="center" cellpadding="1" cellspacing="0" >
              <form action="ekle.php?cat2=<? echo $cat ;?>&asama=sektor" method="post" name="frmSektor" id="frmSektor">
                <tr>
                  <td colspan="2" class="title_kucuk">
                    <center>
                      <p class="govde"><? echo ucfirst($row['sektorgrup']);}?>
                      </p>
                    </center>
			    </td></tr>
                      <tr>
                        <td class="govde" width="51%"><INPUT name="allbox" onclick="CheckAll();" type="checkbox" value="Check All"><strong>Tümünü Seç</strong></td>
                </tr>
                      <?
$verified_firmaid = isset($_SESSION['verified_firmaid']) ? $_SESSION['verified_firmaid'] : '';
$queryqq="SELECT distinct sektorler.sektor,sektorler.sektorid FROM  gecici1 left join sektor_sektorgrup on(gecici1.sektorid=sektor_sektorgrup.sektorid and sektor_sektorgrup.sektorgrupid='$cat')left join sektorler on(sektor_sektorgrup.sektorid=sektorler.sektorid) where gecici1.firmaid='$verified_firmaid' order by sektorler.sektor";
$etki=mysqli_query($connection,$queryqq);
$etkili=mysqli_affected_rows($connection);
if($etkili){
?>
                      <tr> 
                        <td class="govde">
                          <? while ($row2 = mysqli_fetch_array($etki)){
                     echo $row2['sektor'];
					 echo "<br>";}?></td>
                </tr>
                      <tr>
                      </tr>
                      <? } ?>
                      <tr>
                        <td valign="top" class="govde" ><?
$sektorsay="SELECT sektorid FROM  sektorler";
$resultsek=mysqli_query($connection,$sektorsay);
$saysek=mysqli_num_rows($resultsek);
$sayseka=ceil($saysek/2);
$strw1="select sektorler.sektor,sektorler.sektorid  from sektor_sektorgrup,sektorler where sektor_sektorgrup.sektorgrupid=$cat and sektor_sektorgrup.sektorgrupid='26' and sektor_sektorgrup.sektorid=sektorler.sektorid order by sektorler.sektor limit 0,$sayseka";
$resultw1=mysqli_query($connection,$strw1);
while ($roww1 = mysqli_fetch_array($resultw1)){
                     $deger=$roww1['sektorid']; ?>
					 <input type=checkbox  name=sektor[] value=<? echo $deger ?>>
					 <? echo $roww1['sektor']; ?>
					 <br> <? }
									            ?></td>
                        <td width="49%" valign="top" class="govde" ><?
$strw1="select sektorler.sektor,sektorler.sektorid  from sektor_sektorgrup,sektorler where sektor_sektorgrup.sektorgrupid=$cat and sektor_sektorgrup.sektorgrupid='26' and sektor_sektorgrup.sektorid=sektorler.sektorid order by sektorler.sektor limit $sayseka,$sayseka";
$resultw1=mysqli_query($connection,$strw1);
while ($roww1 = mysqli_fetch_array($resultw1)){
                     $deger=$roww1['sektorid']; ?>
					 <input type=checkbox  name=sektor[] value=<? echo $deger ?>>
					 <? echo $roww1['sektor']; ?>
					 <br> <? }
									            ?></td>
                </tr>
                      <tr>
                        <td class="govde"><?
$say="select sektorler.sektor,sektorler.sektorid  from sektor_sektorgrup,sektorler where sektor_sektorgrup.sektorgrupid=$cat and sektor_sektorgrup.sektorgrupid<>'26' and sektor_sektorgrup.sektorid=sektorler.sektorid order by sektorler.sektor ";
$resultw=mysqli_query($connection,$say);
$sayser=mysqli_num_rows($resultw);
$saysekw=ceil($sayser/2);
$strw="select sektorler.sektor,sektorler.sektorid  from sektor_sektorgrup,sektorler where sektor_sektorgrup.sektorgrupid=$cat and sektor_sektorgrup.sektorgrupid<>'26' and sektor_sektorgrup.sektorid=sektorler.sektorid order by sektorler.sektor limit 0,$saysekw";
$resultw=mysqli_query($connection,$strw);
while ($roww = mysqli_fetch_array($resultw)){
                     $deger=$roww['sektorid']; ?>
					 <input type=checkbox  name=sektor[] value=<? echo $deger ?>>
					 <? echo $roww['sektor']; ?>
					 <br> <? } ?></td>
                <td class="govde">
				<?
$strw="select sektorler.sektor,sektorler.sektorid  from sektor_sektorgrup,sektorler where sektor_sektorgrup.sektorgrupid=$cat and sektor_sektorgrup.sektorgrupid<>'26' and sektor_sektorgrup.sektorid=sektorler.sektorid order by sektorler.sektor limit $saysekw,$saysekw ";
$resultw=mysqli_query($connection,$strw);
while ($roww = mysqli_fetch_array($resultw)){
                     $deger=$roww['sektorid']; ?>
					 <input type=checkbox  name=sektor[] value=<? echo $deger ?>>
					 <? echo $roww['sektor']; ?>
					 <br> <? }
									            ?></td>
                </tr>
                <tr>
                  <td align="center" colspan="2" valign="middle" height="50"><a href="cikis.php" class="buttonPage"> İptal &nbsp;<i class="icon-close" ></i></a><img src= "image/trans.gif" alt="" width="20" height="1"><a href="#here" onClick="javascript:history.go(-1)" class="buttonPage"> Geri &nbsp;<i class="icon-arrow-left"></i></a><img src= "image/trans.gif" alt="" width="20" height="1"><a href="#here" onClick="Gonder()" class="buttonPage"> İlerle &nbsp;<i class="icon-arrow-right"></i></a></td>  
                </tr>
              </FORM>
            </table>        
        </tr>
</table>
</div>
<div id="bant1"></div>
<div id="alt">
  <?php include "alt.php" ?>
</div>
</div>
</body>
</html>
<script language="javascript">
function Gonder(){
	frmSektor.submit();
}
</script>