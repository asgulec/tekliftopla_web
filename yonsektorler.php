<?php include "headeryon.php"; ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="content-language" content="tr" />
<title>..:: Teklif Toplama Sitesine Hosgeldiniz ::..</title>
<link href="css/style.css" rel="stylesheet" type="text/css">

</head>

<body>
<?php
$cat = filter_input(INPUT_GET, "cat", FILTER_VALIDATE_INT);
if ($cat === false || $cat === null || $cat < 1) {
  http_response_code(400);
  exit;
}
$str1="SELECT * FROM sektor_grup where sektorgrupid=$cat";
$result1=mysqli_query($coni,$str1);
while ($row = mysqli_fetch_array($result1)){
echo "<title>" . htmlspecialchars($row['sektorgrup'], ENT_QUOTES, 'UTF-8') . "</title>";
?>
	
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
                <td background="image/yeni_orta.gif" height="50" width="191" ><img src="image/5/5_3.gif" width="176" height="64"></td>
                <td background="image/yeni_orta.gif" width="183" align="center" class="Baslik" valign="bottom">İş Kolları </td>
                <td background="image/yeni_orta.gif" width="154" valign="middle" align="right" class="Buyuk_Yazi"><table width="100%" border="0" cellpadding="0" cellspacing="0">
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
        <tr>
          <td valign="top" bgcolor="#F6F6F6"><?php $verified_firma = isset($_SESSION["verified_firma"]) ? $_SESSION["verified_firma"] : ''; ?>
            <span class="title_kucuk"><?php echo htmlspecialchars($verified_firma, ENT_QUOTES, 'UTF-8'); ?>,</span> <span class="title_kucuk"> ürettiği, sattığı mal veya hizmetleri, yaptığı işleri seçiniz.</span>
            <table width="95%"  border="0" align="center" cellpadding="1" cellspacing="0" >
              <form action="yonekle.php?cat2=<? echo $cat ;?>&asama=sektor" method="post" name="frmSektor" id="frmSektor" >
                <tr>
                  <td colspan="2" class="Baslik">
                    <center>
                      <?php echo htmlspecialchars(ucfirst($row['sektorgrup']), ENT_QUOTES, 'UTF-8'); }?>
                    </center>
			    </td></tr>
                      <tr>
                        <td width="51%" bgcolor="silver"><INPUT name="allbox" onclick="CheckAll();" type="checkbox" value="Check All" >
                        Tümünü Seç</td>
                </tr>
                      <?
$verified_firmaid = $_SESSION["verified_firmaid"];
$queryqq="SELECT distinct sektorler.sektor,sektorler.sektorid FROM  gecici1 left join sektor_sektorgrup on(gecici1.sektorid=sektor_sektorgrup.sektorid and sektor_sektorgrup.sektorgrupid=$cat)left join sektorler on(sektor_sektorgrup.sektorid=sektorler.sektorid) where gecici1.firmaid='$verified_firmaid' order by sektorler.sektor";
$etki=mysqli_query($coni,$queryqq);
$etkili=mysqli_affected_rows($coni);
if($etkili){
?>
                      <tr>
                        <td class="govde">
                          <? while ($row2 = mysqli_fetch_array($etki)){
                     echo htmlspecialchars($row2['sektor'], ENT_QUOTES, 'UTF-8');
					 echo "<br>";}?></td>
                </tr>
                      <tr>
                      </tr>
                      <? } ?>
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
					 <input type="checkbox" name="sektor[]" value="<?php echo htmlspecialchars((string)$deger, ENT_QUOTES, 'UTF-8'); ?>">
           <?php echo htmlspecialchars($roww1['sektor'], ENT_QUOTES, 'UTF-8'); ?>
					 <br> <? }
									            ?></td>
                        <td width="49%" valign="top" class="govde" ><?
$strw1="select sektorler.sektor,sektorler.sektorid  from sektor_sektorgrup,sektorler where sektor_sektorgrup.sektorgrupid=$cat and sektor_sektorgrup.sektorgrupid='26' and sektor_sektorgrup.sektorid=sektorler.sektorid order by sektorler.sektor limit $sayseka,$sayseka";
$resultw1=mysqli_query($coni,$strw1);
while ($roww1 = mysqli_fetch_array($resultw1)){
                     $deger=$roww1['sektorid']; ?>
					 <input type="checkbox" name="sektor[]" value="<?php echo htmlspecialchars((string)$deger, ENT_QUOTES, 'UTF-8'); ?>">
           <?php echo htmlspecialchars($roww1['sektor'], ENT_QUOTES, 'UTF-8'); ?>
					 <br> <? }
									            ?></td>
                </tr>
                      <tr>
                        <td class="govde"><?
$say="select sektorler.sektor,sektorler.sektorid  from sektor_sektorgrup,sektorler where sektor_sektorgrup.sektorgrupid=$cat and sektor_sektorgrup.sektorgrupid<>'26' and sektor_sektorgrup.sektorid=sektorler.sektorid order by sektorler.sektor ";
$resultw=mysqli_query($coni,$say);
$sayser=mysqli_num_rows($resultw);
$saysekw=ceil($sayser/2);
$strw="select sektorler.sektor,sektorler.sektorid  from sektor_sektorgrup,sektorler where sektor_sektorgrup.sektorgrupid=$cat and sektor_sektorgrup.sektorgrupid<>'26' and sektor_sektorgrup.sektorid=sektorler.sektorid order by sektorler.sektor limit 0,$saysekw";
$resultw=mysqli_query($coni,$strw);
while ($roww = mysqli_fetch_array($resultw)){
                     $deger=$roww['sektorid']; ?>
					 <input type="checkbox" name="sektor[]" value="<?php echo htmlspecialchars((string)$deger, ENT_QUOTES, 'UTF-8'); ?>">
           <?php echo htmlspecialchars($roww['sektor'], ENT_QUOTES, 'UTF-8'); ?>
					 <br> <? }
									            ?></td>
                <td class="govde"><?

$strw="select sektorler.sektor,sektorler.sektorid  from sektor_sektorgrup,sektorler where sektor_sektorgrup.sektorgrupid=$cat and sektor_sektorgrup.sektorgrupid<>'26' and sektor_sektorgrup.sektorid=sektorler.sektorid order by sektorler.sektor limit $saysekw,$saysekw ";
$resultw=mysqli_query($coni,$strw);
while ($roww = mysqli_fetch_array($resultw)){
                     $deger=$roww['sektorid']; ?>
					 <input type="checkbox" name="sektor[]" value="<?php echo htmlspecialchars((string)$deger, ENT_QUOTES, 'UTF-8'); ?>">
           <?php echo htmlspecialchars($roww['sektor'], ENT_QUOTES, 'UTF-8'); ?>
					 <br> <? }
									            ?></td>
                </tr>
                <tr>
                  <td colspan="2" height="50" align="center"><img src="image/iptalet.gif" width="146" height="16" class="ResimDugme" onClick="javascript:window.location ='yonetimgiris.php'" ><img src= "image/trans.gif" alt="" width="20" height="1"><img src="image/geri.gif" width="89" height="16" class="ResimDugme" onClick="javascript:history.go(-1)"> <img src= "image/trans.gif" alt="" width="20" height="1"><img src="image/ilerle.gif" width="146" height="16" class="ResimDugme" onClick="Gonder()">
                  </td>
                </tr>
              </FORM>
            </table>        
        </tr>
      </table>
  </div>
  <div id="bant1"></div> <!-- bant2 -->
 
</div>
</body>
</html>
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
	frmSektor.submit();
}
</script>