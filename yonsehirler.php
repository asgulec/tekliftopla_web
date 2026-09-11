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
<SCRIPT LANGUAGE="JavaScript">
document.onkeypress = processKey;

function processKey(e)
{
  if (null == e)
    e = window.event ;
  if (e.keyCode == 13)  {
    anyCheck() ;
  }
}
function anyCheck() {
var total = 0;
var fark=0;
var max = document.frmSehir.length;
for (var idx = 0; idx < max; idx++) 
{
   if (document.frmSehir.elements[idx].type == "checkbox" && document.frmSehir.elements[idx].name=="sehir[]" && document.frmSehir.elements[idx].checked==true) 
   {
    total ++;
   }
}
   if(total<1)
   {
   fark=total-10;
 	alert(" En az 1 tane şehir seçiniz. ");
	for (var idx = 0; idx < max; idx++) 
    {
      document.frmSehir.elements[idx].checked=false;
    }
   }
 else
 {
  
  document.frmSehir.submit();
 }
}
function CheckAll()
{
 for (var i=0;i<document.frmSehir.elements.length;i++)
 {
  var e=document.frmSehir.elements[i];
  if (e.name != 'allbox')
   e.checked=document.frmSehir.allbox.checked;
 }
}

function CheckBolge(field)
{
<?php
$str101="SELECT sehirid from sehir where bolge='Akdeniz'";
$result101=mysqli_query($coni,$str101);
while ($rows = mysqli_fetch_array($result101))
{
 $deges=$rows['sehirid']; ?>
for (i = 0; i < field.length; i++)  
 {
 if(field[i].value == <?php echo $deges; ?>) 
  {
	  if(!field[i].checked)
	   field[i].checked = true;
	   else
	   	field[i].checked=false;
  }
 }
<?php } ?>
}
</script>
<link href="css/style.css" rel="stylesheet" type="text/css">
<div id="sayfa">
  <div id="ust">
    <?php include "ust.php" ?>
  </div>
  <div id="bant1"></div>
  <div id="sol">
    <?php include "solyonetim.php" ?>
  </div>
  <div id="analong">

<table width="540px" align="center"  cellspacing="0" cellpadding="0" border="0" bgColor="white" >
      <tr>
        <td>
		  <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td colspan="4" height="2" bgcolor="#FFFFFF"></td>
            </tr>
            <tr >
              <td background="image/yeni_orta.gif" height="50" width="191" ><img src="image/5/5_5.gif" width="176" height="64"></td>
              <td background="image/yeni_orta.gif" width="183" align="center" class="Baslik" valign="bottom">&#350;ehir Se&ccedil;imi </td>
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
      <tr><? $verified_firma = isset($_SESSION["verified_firma"]) ? $_SESSION["verified_firma"] : ''; ?>
        <td valign="top" bgcolor="#F6F6F6"> <span class="title_kucuk"><? echo $verified_firma;?></span> <span class="title_kucuk"> hangi şehirlerde iş yapar?</span><br><br>
            <form action="yonekle.php?asama=sehir" method="post" id="frmSehir" name="frmSehir">
				<input type="hidden" name="yazi" id="yazi" >
                    <table width="95%"  border="0" align="center" cellpadding="2" cellspacing="0"  bordercolor="#EAEAEA"  bgcolor="#F6F6F6">
                      <tr>
                        <td colspan="3" valign="middle" bgcolor="Silver" class="govde"><INPUT name=allbox onclick=CheckAll(); type=checkbox value="Check All">
                          Tümünü Seç</td>
                      </tr>
                      <tr>
                        <td colspan="3" valign="middle" bgcolor="Silver" class="govde"><INPUT name="Akdeniz" onclick="CheckBolge(document.getElementById('frmSehir')['sehir[]']);" type="checkbox" value="Akdeniz">
                          Akdeniz</td>
                      </tr>
                      <tr class="govde">
                        <td  valign="top">
                          <?
$eposta=isset($_SESSION["verified_email"]) ? $_SESSION["verified_email"] : ''; 
$sehkay="SELECT sehir.sehirid as issehir from sehir, bilgi where bilgi.email='$eposta' and bilgi.Sehir=sehir.sehir";
$row33=mysqli_fetch_array(mysqli_query($coni,$sehkay));
$wsehir=$row33['issehir']; 
$sehirsay="SELECT sehirid FROM sehir where sehirid<999";
$resultseh=mysqli_query($coni,$sehirsay);
$sayseh=mysqli_num_rows($resultseh);
$sayseha=ceil($sayseh/3);
$saysehb=$sayseha*2;
$str1="select * from sehir where sehirid<999 order by sehir limit 0,$sayseha";
$result1=mysqli_query($coni,$str1);
while ($row1 = mysqli_fetch_array($result1)){
                     $deger1=$row1['sehirid']; ?>
                          <input type=checkbox  name=sehir[] value=<? echo $deger1;?> <? if ($deger1==$wsehir) echo " CHECKED"; ?>>
                          <? echo $row1['sehir']; ?><br>
                          <? }
										            ?></td>
                        <td  valign="top">
                          <?
$str="select * from sehir where sehirid<999 order by sehir limit $sayseha,$sayseha";
$result=mysqli_query($coni,$str);
while ($row = mysqli_fetch_array($result)){
                     $deger=$row['sehirid']; ?>
                          <input type=checkbox  name=sehir[] value=<? echo $deger ;?> <? if ($deger==$wsehir) echo " CHECKED"; ?>>
                          <? echo $row['sehir']; ?><br>
                          <? }
										            ?></td>
                        <td valign="top">
                          <?
$str="select * from sehir where sehirid<999 order by sehir limit $saysehb,$sayseha";
$result=mysqli_query($coni,$str);
while ($row = mysqli_fetch_array($result)){
                     $deger=$row['sehirid']; ?>
                          <input type=checkbox  name=sehir[] value=<? echo $deger ?> <? if ($deger==$wsehir) echo " CHECKED"; ?>>
                          <? echo $row['sehir']; ?><br>
                          <? }
						  ?></td>
                      </tr>
                      <tr>
                      <td colspan="3" height="50" align="center"><img src="image/iptalet.gif" width="146" height="16" class="ResimDugme" onClick="javascript:window.location ='yonetimgiris.php'" ><img src= "image/trans.gif" alt="" width="20" height="1"><img src="image/geri.gif" width="89" height="16" class="ResimDugme" onClick="javascript:history.go(-1)"><img src= "image/trans.gif" alt="" width="20" height="1"><img src="image/ilerle.gif" width="146" height="16" class="ResimDugme" onClick="anyCheck()"></td></tr>
                    </table>
          </FORM></td>
      </tr>
    </table>
 </div>
  <div id="bant1"></div> <!-- bant2 -->
  
</div>
</body>
</html>