<?php include"headeryon.php"; ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="content-language" content="tr" />
<title>tekliftopla</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php 
/*$link=mysql_connect($host,$user,$password) or die("ba?lanty yok");
$query="SET NAMES 'UTF8'";
mysql_query($query);*/
$cat = $_GET["cat"];
$str1="SELECT * FROM sektor_grup where sektorgrupid='$cat'";
$result1=mysqli_query($coni,$str1);
while ($row = mysqli_fetch_array($result1)){
echo "<title>".$row['sektorgrup']."</title>";
?>
	
<script>
function CheckAll()
{
 for (var i=0;i<document.frmIskolu.elements.length;i++)
 {
  var e=document.frmIskolu.elements[i];
  if (e.name != 'allbox')
   e.checked=document.frmIskolu.allbox.checked;
 }
}
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
/* var total = 0;
var max = document.frmIskolu.length;
 
for (var idx = 0; idx < max; idx++) {
if (document.frmIskolu.elements[idx].type == "checkbox" && document.frmIskolu.elements[idx].name=="sektor[]" && document.frmIskolu.elements[idx].checked==true) {
    total ++;
   }
}
   if(total<1)
   {
 	document.getElementById("yazi").value = " En az 1 sektör seçmelisiniz. ";
	window.open('dikkat.html',"win1","width=400, height=200,menubar=0,resizable=0,scrollbars=0,status=0,titlebar=0,toolbar=0,left="+(screen.width-400)/2+",top="+(screen.height-200)/2);
    for (var idx = 0; idx < max; idx++) 
    {
      document.frmIskolu.elements[idx].checked=false;
    }
   }
 else
 {
  
  document.frmIskolu.submit();
 } */

document.frmIskolu.submit(); 
}

</script>

<div id="sayfa">
  <div id="ust">
    <?php include "ust.php" ?>
  </div>
  <div id="bant1"></div>
  <div id="sol">
    <?php include "solyonetim.php" ?>
  </div>
  <div id="analong">

<table width="100%"  cellspacing="0" cellpadding="0" border="0" bgColor="white" >
      <tr>
        <td>
		  <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td colspan="4" height="2" bgcolor="#FFFFFF"></td>
            </tr>
            <tr >
              <td height="50" width="191" ><img src="image/5/5_3.gif" width="176" height="64"></td>
              <td width="183" align="center" class="Baslik" valign="bottom"></td>
              <td width="154" valign="middle" align="right" class="Baslik" >İş kolları </td>
              <td width="27" ><img src="image/sag_ok.gif" width="27" height="64"></td>
            </tr>
          </table></td></tr>
        <tr>
          <td valign="top" bgcolor="#F6F6F6">
            <span class="title_kucuk">Sayın <? $verified_user = $_SESSION["verified_user"]; echo $verified_user;?>, bu talebinize hangi sektörler cevap verebilir?</span>
            <table width="95%" border="0" align="center"  cellPadding="2" cellSpacing="0"  bordercolor="#F6F6F6" bgcolor="#EAEAEA" class="govde" >
              <form action="yonetimkulekle.php?cat2=<?=$cat;?>&islem=kulsektor" method="post" name="frmIskolu">
				<input type="hidden" name="yazi" id="yazi" >
                <tr>
                  <td colspan="2">
                    <center>
                      <?php echo ucfirst($row['sektorgrup']);}?>
                    </center>
				</td>
			</tr>
            <tr>
                        <td bgcolor="silver" class="govde"><input name="allbox" onClick="CheckAll();" type="checkbox" value="Check All">
                          Tümünü Seç</td>
                      </tr>
                      <tr>
                        <td class="gh" valign="top">
<?
$sektorsay="SELECT sektorid FROM  sektorler";
$resultsek=mysqli_query($coni,$sektorsay);
$saysek=mysqli_num_rows($resultsek);
$sayseka=ceil($saysek/2);
$strm="select sektorler.sektor,sektorler.sektorid  from sektor_sektorgrup,sektorler where sektor_sektorgrup.sektorgrupid=$cat and sektor_sektorgrup.sektorgrupid='26' and sektor_sektorgrup.sektorid=sektorler.sektorid  ORDER BY sektorler.sektor limit 0,$sayseka";
$resultm=mysqli_query($coni,$strm);
while ($rowm = mysqli_fetch_array($resultm)){
                     $deger=$rowm['sektorid'];
					 echo "<input type=checkbox  name=sektor[] value=$deger>";
					 echo $rowm['sektor'];
					 echo "<br>";}

?>
                        </td>
                        <td width="248" valign="top" class="gh">
                          <?
$str1n="select sektorler.sektor,sektorler.sektorid  from sektor_sektorgrup,sektorler where sektor_sektorgrup.sektorgrupid=$cat and sektor_sektorgrup.sektorgrupid='26' and sektor_sektorgrup.sektorid=sektorler.sektorid  ORDER BY sektorler.sektor limit $sayseka,$sayseka";
$result1n=mysqli_query($coni,$str1n);
while ($row1n = mysqli_fetch_array($result1n)){
                     $deger=$row1n['sektorid'];
					 echo "<input type=checkbox  name=sektor[] value=$deger>";
					 echo $row1n['sektor'];
					 echo "<br>";}

?>
                        </td>
                      </tr>
                      <tr>
                        <td class="govde">
<?
$sayi="select sektorler.sektor,sektorler.sektorid  from sektor_sektorgrup,sektorler where sektor_sektorgrup.sektorgrupid=$cat and sektor_sektorgrup.sektorgrupid!='26'  and sektor_sektorgrup.sektorid=sektorler.sektorid ORDER BY sektorler.sektor ";
$results=mysqli_query($coni,$sayi);
$says=mysqli_num_rows($results);
$saysi=ceil($says/2);
$str="select sektorler.sektor,sektorler.sektorid  from sektor_sektorgrup,sektorler where sektor_sektorgrup.sektorgrupid=$cat and sektor_sektorgrup.sektorgrupid!='26'  and sektor_sektorgrup.sektorid=sektorler.sektorid ORDER BY sektorler.sektor limit 0,$saysi";
$result=mysqli_query($coni,$str);
while ($row = mysqli_fetch_array($result)){
                     $deger=$row['sektorid'];
					 echo "<input type=checkbox  name=sektor[] value=$deger>";
					 echo $row['sektor'];
					 echo "<br>";}

?>
                        </td>
                        <td>
<? $str="select sektorler.sektor,sektorler.sektorid  from sektor_sektorgrup,sektorler where sektor_sektorgrup.sektorgrupid=$cat and sektor_sektorgrup.sektorgrupid!='26'  and sektor_sektorgrup.sektorid=sektorler.sektorid ORDER BY sektorler.sektor limit $saysi,$saysi";
$result=mysqli_query($coni,$str);
while ($row = mysqli_fetch_array($result)){
                     $deger=$row['sektorid'];
					 echo "<input type=checkbox  name=sektor[] value=$deger>";
					 echo $row['sektor'];
					 echo "<br>";}

?>
                        </td>                      
                      </tr>
                      <tr>
                        <td class="not" colspan="2">Not: Birden fazla iş kolu seçmenizi tavsiye ederiz. </td>
                      </tr>
                <tr>
                  <td height="50" valign="middle" align="center" colspan="2" bgcolor="#F6F6F6"><img src="image/iptalet.gif" width="146" height="16" class="ResimDugme" onClick="javascript:window.location ='yonetimgiris.php'" ><img src= "image/trans.gif" alt="" width="20" height="1"> <img src="image/geri.gif" width="89" height="16" class="ResimDugme" onClick="javascript:history.go(-1)"><img src= "image/trans.gif" alt="" width="20" height="1"><img src="image/ilerle.gif" width="146" height="16" class="ResimDugme" onClick="anyCheck()"> </td>
                </tr>
              </form>
            </table>
        </tr>
    </table>
</div>
  <div id="bant1"></div>
  
</div>
</body>
</HTML>

