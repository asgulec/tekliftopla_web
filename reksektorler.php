<?php
include"headeryon.php";

/*$link=mysql_connect($host,$user,$password) or die("baglanti yok");
$query="SET NAMES 'UTF8'";
mysql_query($query);*/
$cat = $_GET["cat"];
$str1="SELECT * FROM sektor_grup where sektorgrupid='$cat'";
$result1=mysqli_query($coni,$str1);
while ($row = mysqli_fetch_array($result1)){
 echo "<title>".$row['sektorgrup']."</title>";
 ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="content-language" content="tr" />
<title>tekliftopla</title>
<link href="css/style.css" rel="stylesheet" type="text/css">

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

<table width="737" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td colspan="2" ><? include "ust.php"?></td>
    </tr>
    <tr>
      <td width="176" valign="top" ><? include "sol.php";?></td>
      <td   valign="top"><table  cellspacing="0" cellpadding="0" border="0" bgColor=white >
        <tr>
          <td>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td colspan="4" height="2" bgcolor="#FFFFFF"></td>
              </tr>
              <tr >
                <td background="image/yeni_orta.gif" height="50" width="191" ><img src="image/5/5_3.gif" width="176" height="64"></td>
                <td background="image/yeni_orta.gif" width="183" align="center" class="Baslik" valign="bottom">İş Kolları </td>
                <td background="image/yeni_orta.gif" width="154" valign="middle" align="right" class="Buyuk_Yazi"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td align="right">YENİ REKLAM</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                </table>                </td>
                <td background="image/yeni_orta.gif" width="27" ><img src="image/sag_ok.gif" width="27" height="64"></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td valign="top" bgcolor="#F6F6F6">
            <span class="title_kucuk">Lütfen reklamı göndermek istediğiniz sektörleri seçiniz.</span>
            <table width="95%"  border="0" align="center" cellpadding="1" cellspacing="0"  bordercolor="#F6F6F6"  bgcolor="#EAEAEA">
              <form action="rekekle.php?cat2=<? echo $cat ;?>&asama=sektor" method="post" name="frmSektor" id="frmSektor">
                <tr>
                  <td colspan="2" class="Baslik">
                    <center>
                      <? echo ucfirst($row['sektorgrup']);}?>
                    </center>
			    </td></tr>
                      <tr>
                        <td width="51%" bgcolor="silver"><INPUT name="allbox" onclick="CheckAll();" type="checkbox" value="Check All">
                        Tümünü Seç</td>
                </tr>
                      <?
$rekid=$_SESSION['rekid'];
$queryqq="SELECT distinct sektorler.sektor,sektorler.sektorid FROM  gecrek1 left join sektor_sektorgrup on(gecrek1.sektorid=sektor_sektorgrup.sektorid and sektor_sektorgrup.sektorgrupid='$cat')left join sektorler on(sektor_sektorgrup.sektorid=sektorler.sektorid) where gecrek1.rekid='$rekid' order by sektorler.sektor";
$etki=mysqli_query($coni,$queryqq);
$etkili=mysqli_affected_rows($coni);
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
                      <?}?>
                      <tr>
                        <td valign="top" class="govde" ><?
$sektorsay="SELECT sektorid FROM  sektorler";
$resultsek=mysqli_query($coni,$sektorsay);
$saysek=mysqli_num_rows($resultsek);
$sayseka=ceil($saysek/2);
$strw1="select sektorler.sektor,sektorler.sektorid  from sektor_sektorgrup,sektorler where sektor_sektorgrup.sektorgrupid=$cat and sektor_sektorgrup.sektorgrupid='26' and sektor_sektorgrup.sektorid=sektorler.sektorid order by sektorler.sektor limit 0,$sayseka";
$resultw1=mysqli_query($coni,$strw1);
while ($roww1 = mysqli_fetch_array($resultw1)){
                     $deger=$roww1['sektorid']; ?>
					 <input type=checkbox  name=sektor[] value=<? echo $deger ?>>
					 <? echo $roww1['sektor']; ?>
					 <br> <? }
									            ?></td>
                        <td width="49%" valign="top" class="govde" ><?
$strw1="select sektorler.sektor,sektorler.sektorid  from sektor_sektorgrup,sektorler where sektor_sektorgrup.sektorgrupid=$cat and sektor_sektorgrup.sektorgrupid='26' and sektor_sektorgrup.sektorid=sektorler.sektorid order by sektorler.sektor limit $sayseka,$sayseka";
$resultw1=mysqli_query($coni,$strw1);
while ($roww1 = mysqli_fetch_array($resultw1)){
                     $deger=$roww1['sektorid']; ?>
					 <input type=checkbox  name=sektor[] value=<? echo $deger ?>>
					 <? echo $roww1['sektor']; ?>
					 <br> <? }
									            ?></td>
                </tr>
                      <tr>
                        <td class="govde"><?

$strw="select sektorler.sektor,sektorler.sektorid  from sektor_sektorgrup,sektorler where sektor_sektorgrup.sektorgrupid=$cat and sektor_sektorgrup.sektorgrupid<>'26' and sektor_sektorgrup.sektorid=sektorler.sektorid order by sektorler.sektor ";
$resultw=mysqli_query($coni,$strw);
while ($roww = mysqli_fetch_array($resultw)){
                     $deger=$roww['sektorid']; ?>
					 <input type=checkbox  name=sektor[] value=<? echo $deger ?>>
					 <? echo $roww['sektor']; ?>
					 <br> <? }
									            ?></td>
                </tr>
                <tr>
                  <td colspan="2" height="30" align="center" bgcolor="#FFFFFF"><span class="aciklama"><strong><strong><img src="image/iptalet.gif" width="146" height="16" class="ResimDugme" onClick="javascript:window.location ='index.php'" ></strong> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</strong></span><img src="image/geri.gif" width="89" height="16" class="ResimDugme" onClick="javascript:history.go(-1)"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<img src="image/ilerle.gif" width="146" height="16" class="ResimDugme" onClick="Gonder()">
                  </td>
                </tr>
              </FORM>
            </table>        
        </tr>
      </table></td>
    </tr>
   
</table>
</body>
</html>
<script language="javascript">
function Gonder(){
	frmSektor.submit();
}
</script>