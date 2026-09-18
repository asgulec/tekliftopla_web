<? include"header.php";

$link=mysql_connect($host,$user,$password) or die("ba?lanty yok");
$query="SET NAMES 'UTF8'";
mysql_query($query);
$str1="SELECT * FROM sektor_grup where sektorgrupid='$cat'";
$result1=mysql_db_query($db,"$str1");
while ($row = mysql_fetch_array($result1)){
                echo "<title>".$row['sektorgrup']."</title>";
					 ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="content-type" content="text/html; charset=ISO-8859-9" />
<meta http-equiv="content-language" content="tr" />
<title>..:: Teklif Toplama Sitesine Hosgeldiniz ::..</title>
<link href="css/style.css" rel="stylesheet" type="text/css">

</head>

<body>

<SCRIPT LANGUAGE="JavaScript">
<!-- Begin
function anyCheck() {
var total = 0;
var max = document.frmIskolu.length;
 
for (var idx = 0; idx < max; idx++) {
if (document.frmIskolu.elements[idx].type == "checkbox" && document.frmIskolu.elements[idx].name=="sektor[]" && document.frmIskolu.elements[idx].checked==true) {
    total ++;
   }
}
   if(total<1)
   {
 	document.all.yazi.value = " En az 1 sektör seçmelisiniz. ";
	window.open('dikkat.html',"win1","width=400, height=200,menubar=0,resizable=0,scrollbars=0,status=0,titlebar=0,toolbar=0,left="+(screen.width-400)/2+",top="+(screen.height-200)/2);
    for (var idx = 0; idx < max; idx++) 
    {
      document.frmIskolu.elements[idx].checked=false;
    }
   }
 else
 {
  
  document.frmIskolu.submit();
 }
 
}
//  End -->
</script>

	
<script>
function CheckAll()
{
 for (var i=0;i<document.frmIskolu.elements.length;i++)
 {
  var e=document.frmIskolu.elements[i];
  if (e.name != 'allbox')
   e.checked=document.frmIskolu.allbox.checked;
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
                <td background="image/yeni_orta.gif" width="183" align="center" class="Baslik" valign="bottom">&nbsp;</td>
                <td background="image/yeni_orta.gif" width="154" valign="middle" align="right" class="Buyuk_Yazi"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td align="right" class="Buyuk_Yazi">YEN&#304; TALEP</td>
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
        <td valign="top" bgcolor="#F6F6F6"><? $verified_firma = $_SESSION["verified_firma"]; ?>
          <h4><span class="title_kucuk">Sayın <?echo$verified_firma;?>,</span>&nbsp;<font color=#990000 class="title_kucuk">bu talebinizi hangi i&#351; kollar&#305; cevap verebilir?</font></h4>
          <table width="95%" border="10" align="center"  cellPadding="0" cellSpacing="0"  bordercolor="#F6F6F6" bgcolor="#EAEAEA" class="govde" >
            <form action="kulekle.php?cat2=<?=$cat;?>&islem=kulsektor" method="post" name="frmIskolu">
            <input type="hidden" name="yazi" id="yazi" >
			  <tr>
                <td colspan="2" class="govde">
                  <center>
                    <strong><?echo ucfirst($row['sektorgrup']);}?></strong>
                  </center>
				  </td>
			  </tr>
                    <tr>
                      <td  bgcolor="silver" class="govde"><input name="allbox" onClick="CheckAll();" type="checkbox" value="Check All">
      T&uuml;m&uuml;n&uuml; Se&ccedil;</td>
                    </tr>
                    <?
$verified_kulid = $_SESSION["verified_kulid"];
$queryqq="SELECT distinct sektorler.sektor,sektorler.sektorid FROM  gecici2 left join sektor_sektorgrup on(gecici2.sektorid=sektor_sektorgrup.sektorid and sektor_sektorgrup.sektorgrupid='$cat')left join sektorler on(sektor_sektorgrup.sektorid=sektorler.sektorid) where gecici2.kullanimid='$verified_kulid' order by sektorler.sektor";
$etki=mysql_db_query($db,$queryqq);
$etkili=mysql_affected_rows();
if($etkili){
?>
                    <tr>
                      <td  width="252">
                        <?while ($row2= mysql_fetch_array($etki)){
                     echo $row2['sektor'];
					 echo "<br>";}?></td>
                    </tr>
                    <?}?>
                    <tr>
                      <td class="gh" valign="top">
                        <?
$strm="select sektorler.sektor,sektorler.sektorid  from sektor_sektorgrup,sektorler where sektor_sektorgrup.sektorgrupid=$cat and sektor_sektorgrup.sektorgrupid='26' and sektor_sektorgrup.sektorid=sektorler.sektorid  ORDER BY sektorler.sektor limit 0,172";
$resultm=mysql_db_query($db,"$strm");
while ($rowm = mysql_fetch_array($resultm)){
                     $deger=$rowm['sektorid'];
					 echo "<input type=checkbox  name=sektor[] value=$deger>";
					 echo $rowm['sektor'];
					 echo "<br>";}

?>
                      </td>
                      <td width="247" valign="top" class="gh">
                        <?
$str1n="select sektorler.sektor,sektorler.sektorid  from sektor_sektorgrup,sektorler where sektor_sektorgrup.sektorgrupid=$cat and sektor_sektorgrup.sektorgrupid='26' and sektor_sektorgrup.sektorid=sektorler.sektorid  ORDER BY sektorler.sektor limit 172,344";
$result1n=mysql_db_query($db,"$str1n");
while ($row1n = mysql_fetch_array($result1n)){
                     $deger=$row1n['sektorid'];
					 echo "<input type=checkbox  name=sektor[] value=$deger>";
					 echo $row1n['sektor'];
					 echo "<br>";}

?>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <?
$str="select sektorler.sektor,sektorler.sektorid  from sektor_sektorgrup,sektorler where sektor_sektorgrup.sektorgrupid=$cat and sektor_sektorgrup.sektorgrupid!='26'  and sektor_sektorgrup.sektorid=sektorler.sektorid  ORDER BY sektorler.sektor ";
$result=mysql_db_query($db,"$str");
while ($row = mysql_fetch_array($result)){
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
                <td colspan="2" height="30" valign="middle" align="center">                  <span class="aciklama"><strong><strong><strong><img src="image/iptalet.gif" width="146" height="16" class="ResimDugme" onClick="javascript:window.location ='giris.php'" ></strong></strong> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</strong></span><img src="image/geri.gif" width="89" height="16" class="ResimDugme" onClick="javascript:history.go(-1)"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<img src="image/ilerle.gif" width="146" height="16" class="ResimDugme" onClick="anyCheck()">                  </td>
              </tr>
            </FORM>
          </table>      
        </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2"><? include "alt.php";?></td>
  </tr>
</table>
<p>&nbsp;</p>
</html>
