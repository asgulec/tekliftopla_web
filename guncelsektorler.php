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
<script>function CheckAll()
{
 for (var i=0;i<document.LoginForm.elements.length;i++)
 {
  var e=document.LoginForm.elements[i];
  if (e.name != 'allbox')
   e.checked=document.LoginForm.allbox.checked;
 }
}
</script>
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
        <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td colspan="4" height="2" bgcolor="#FFFFFF"></td>
            </tr>
            <tr height="25px">
              <td width="25%"><img src="image/5/5_3.gif" width="176" height="64"></td>
              <td width="25%" ></td>
              <td valign="middle" width="43%" align="right" class="title"><p>Güncelleme<br>
                  <span class="title_kucuk">İş Kolları</span></p></td>
              <td valign="bottom" align="right" width="7%" ><img src="image/sag_ok.gif" width="27"></td>
            </tr>
          </table></td></tr>
      <tr>
        <td class="Baslik" width="100%" valign="top" bgcolor="#F6F6F6"><? $verified_firma = isset($_SESSION["verified_firma"]) ? $_SESSION["verified_firma"] : ''; ?>
          Sayın <?php echo $verified_firma;?>, lütfen teklif vermek istediğiniz iş kollarını seçiniz.</td></tr>
          <tr><td>
          <table align="center"  cellpadding="0" cellspacing="0" width="100%" border="0">
            <form action="update.php?islem=guncelsektor" method="post" name="LoginForm" >
              <?php
$cat = filter_input(INPUT_GET, "cat", FILTER_VALIDATE_INT);
if ($cat === false || $cat === null || $cat < 1) {
  http_response_code(400);
  exit;
}
$verified_firmaid = isset($_SESSION["verified_firmaid"]) ? $_SESSION["verified_firmaid"] : '';
$query="SELECT distinct sektorler.sektor,sektorler.sektorid FROM  gecici left join sektor_sektorgrup on(gecici.sektorid=sektor_sektorgrup.sektorid and sektor_sektorgrup.sektorgrupid=$cat)left join sektorler on(sektor_sektorgrup.sektorid=sektorler.sektorid) where gecici.firmaid=$verified_firmaid order by sektorler.sektor";
$etki=mysqli_query($connection,$query);
$hakan=mysqli_num_rows($etki);
if($hakan>=1){
?>
              <tr>
                <td class="title_kucuk" colspan="2" align="left"><br>
                  Bu gruptan <strong>kayıtlı</strong> olduğunuz iş kolları </td>
              </tr>
              <tr>
                <td colspan="2" align="right"><?php 
                 $count=1;
				 $column=1;
				 while ($row2 = mysqli_fetch_array($etki))
				 {
				 if ($column==0)
				{
				 printf("<tr><td bgcolor=\"#F6F6F6\" class=\"govde\">%s</td>",$row2['sektor']);
				}
				else{
				printf("<td bgcolor=\"#F6F6F6\" class=\"govde\">%s</td></tr>",$row2['sektor']);
				
				}
				$count+=1;
				$column = $count%2;
				}
				/* {
                     echo $row2['sektor'] ."<br>"; } */
				 ?></td>
              </tr>
              <tr>
                <td colspan="2" ><br></td>
              </tr>
              <tr>
                <td colspan="2" align="left" class="title_kucuk">Bu guruptan <strong>kayıt olabileceğiniz</strong> iş kolları </td>
              </tr>
              <?php }?>
              <tr>
                <td bgcolor="#F6F6F6"><input name="allbox" onClick="CheckAll();" type="checkbox" value="Check All">
                  <strong><span class="govde">Tümünü Seç</span></strong></td>
              </tr>
              <tr>
                <td class="govde" valign="top"><?
$sektorsay="SELECT sektorid FROM sektorler";
$resultsek=mysqli_query($connection,$sektorsay);
$saysek=mysqli_num_rows($resultsek);
$sayseka=ceil($saysek/2);
$str="select sektorler.sektor,sektorler.sektorid  from sektor_sektorgrup,sektorler where sektor_sektorgrup.sektorgrupid=$cat and sektor_sektorgrup.sektorgrupid='26' and sektor_sektorgrup.sektorid=sektorler.sektorid  ORDER BY sektorler.sektor limit 0,$sayseka";
$result=mysqli_query($connection,$str);
while ($row = mysqli_fetch_array($result)){
                     $deger=$row['sektorid']; ?>
                  <input type=checkbox  name=sektor[] value=<? echo $deger ?>>
                  <?					 echo $row['sektor']; 
							echo "<br>";}
?></td>
                <td class="govde" valign="top"><?
$str1="select sektorler.sektor,sektorler.sektorid  from sektor_sektorgrup,sektorler where sektor_sektorgrup.sektorgrupid=$cat and sektor_sektorgrup.sektorgrupid='26' and sektor_sektorgrup.sektorid=sektorler.sektorid  ORDER BY sektorler.sektor limit $sayseka,$sayseka";
$result1=mysqli_query($connection,$str1);
while ($row1 = mysqli_fetch_array($result1)){
                     $deger=$row1['sektorid']; ?>
                  <input type=checkbox  name=sektor[] value=<? echo $deger ?>>
                  <?					 echo $row1['sektor'];
					 echo "<br>";}

?></td>
              </tr>
              <tr>
                <td class="govde"><?
$say="select sektorler.sektor,sektorler.sektorid  from sektor_sektorgrup,sektorler where sektor_sektorgrup.sektorgrupid=$cat and sektor_sektorgrup.sektorgrupid!='26' and sektor_sektorgrup.sektorid=sektorler.sektorid order by sektorler.sektor ";
$resultw=mysqli_query($connection,$say);
$sayser=mysqli_num_rows($resultw);
$saysekw=ceil($sayser/2);
$str="select sektorler.sektor,sektorler.sektorid  from sektor_sektorgrup,sektorler where sektor_sektorgrup.sektorgrupid=$cat and sektor_sektorgrup.sektorgrupid!='26' and sektor_sektorgrup.sektorid=sektorler.sektorid  ORDER BY sektorler.sektor limit 0,$saysekw ";
$result=mysqli_query($connection,$str);
while ($row = mysqli_fetch_array($result)){
                     $deger=$row['sektorid']; ?>
                  <input type=checkbox  name=sektor[] value=<? echo $deger; ?> >
                  <?					 echo $row['sektor']; ?>
                  <br>
                  <? } ?></td>
              <td class="govde"><?php 
$str="select sektorler.sektor,sektorler.sektorid  from sektor_sektorgrup,sektorler where sektor_sektorgrup.sektorgrupid=$cat and sektor_sektorgrup.sektorgrupid!='26' and sektor_sektorgrup.sektorid=sektorler.sektorid  ORDER BY sektorler.sektor limit $saysekw,$saysekw ";
$result=mysqli_query($connection,$str);
while ($row = mysqli_fetch_array($result)){
                     $deger=$row['sektorid']; ?>
                  <input type=checkbox  name=sektor[] value=<? echo $deger; ?> >
                  <?php echo $row['sektor']; ?>
                  <br>
                  <?php } ?></td>
              </tr>
              <tr>
                <td align="center" colspan="2" valign="middle" height="50"><a href="giris.php" class="buttonPage"> İptal &nbsp;<i class="icon-close" ></i></a><img src= "image/trans.gif" alt="" width="18" height="1"><a href="#here" onClick="javascript:history.go(-1)" class="buttonPage"> Geri &nbsp;<i class="icon-arrow-left"></i></a><img src= "image/trans.gif" alt="" width="18" height="1"><a href="#here" onClick="LoginForm.submit()" class="buttonPage"> İlerle &nbsp;<i class="icon-arrow-right"></i></a></td>
              </tr>
            </form>
          </table></td></tr>
    </table>
</div>
<div id="bant1"></div>
<div id="alt">
<?php include "alt.php" ?>
</div>
</div>
</body>
</html>