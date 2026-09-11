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
<div id="sayfa">
  <div id="ust">
    <?php include "ust.php" ?>
  </div>
  <div id="bant1"></div>
  <div id="sol">
    <?php include "solyonetim.php" ?>
  </div>
  <div id="analong">
<?php if (!EMPTY($_POST["textshort"])) {
$textshort=mysqli_real_escape_string($coni,$_POST["textshort"]);
$tekid=$_SESSION['verified_kulid'];
$sql = "UPDATE kullanim SET textshort='$textshort' WHERE Kullanimid='$tekid'";
$sonuc15=mysqli_query($coni,$sql); }
?>
<table width="100%"  cellspacing="0" cellpadding="0" border="0" bgColor="white" >
      <tr>
        <td>
		  <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td colspan="4" height="2" bgcolor="#FFFFFF"></td>
            </tr>
            <tr >
              <td height="50" width="191" ><img src="image/5/5_2%20copy.gif" width="176" height="64"></td>
              <td width="183" align="center" class="Baslik" valign="bottom"></td>
              <td width="154" valign="middle" align="right" class="Baslik" >Sektör Grupları </td>
              <td background="image/yeni_orta.gif" width="27" ><img src="image/sag_ok.gif" width="27" height="64"></td>
            </tr>
          </table></td></tr>
       <tr>
        <td valign="top" bgcolor="#F6F6F6">
          <span class="title_kucuk">Sayın <? $verified_user = $_SESSION["verified_user"]; echo $verified_user;?>&nbsp;, <font color=#990000 class="title_kucuk">bu talebinizi hangi sektörlere duyurmak istiyorsunuz? <br><br></font></span>
          <FORM action="yonetimsil.php" method="post" name="frmSektor">	
          <input type="hidden" name="yazi" id="yazi" >  
          <TABLE align="center"  cellPadding="2" cellSpacing="0" width="95%" border="0" bgcolor="#EAEAEA"  bordercolor="#F6F6F6"  >
            <?php 
			/*$link=mysql_connect($host,$user,$password) or die("bağlantı yok");
			$query="SET NAMES 'UTF8'";
            mysql_query($query);
            mysql_select_db($db);*/
$sekgrupsay="SELECT * FROM  sektor_grup";
$resultgrup=mysqli_query($coni,$sekgrupsay);
$saygrup=mysqli_num_rows($resultgrup);
$saygrupa=ceil(($saygrup-1)/2);
$saygrupb=$saygrupa+1;
$str="SELECT * FROM  sektor_grup where sektorgrupid!='26'  order by sektorgrup limit 0,$saygrupa";
$result=mysqli_query($coni,$str);
$str22="SELECT * FROM  sektor_grup where sektorgrupid!='26'  order by sektorgrup limit $saygrupa,$saygrupb";
$result22=mysqli_query($coni,$str22);
$strkl="SELECT * FROM  sektor_grup where sektorgrupid='26'";
$resultkl=mysqli_query($coni,$strkl);
$kulid=$_SESSION["verified_kulid"];
$temp5="SELECT Distinct sektorid FROM gecici2 WHERE kullanimid = '$kulid'";
$result5=mysqli_query ($coni,$temp5);
$rescount=mysqli_num_rows($result5);
			 ?>
            <tr class="govde">
              <td colspan="2" align="center"><strong>
                <? while ($rowkl = mysqli_fetch_array($resultkl)){
$cat1=$rowkl['sektorgrupid']; ?>
                <A class="link" href='yonetimsektorler.php?cat=<? echo $cat1; ?>'><? echo $rowkl['sektorgrup']; ?> </A>
                      <? } ?>
                  </strong></td>
              </tr>
            <tr class="govde">
              <td>
                <?
while ($row = mysqli_fetch_array($result)){
$cat1=$row['sektorgrupid']; ?>
                <li style="margin-left:15px"> <A class="link" href='yonetimsektorler.php?cat=<? echo $cat1; ?>'> <? echo $row['sektorgrup']; ?> </A>
                    <? } ?>
                  </td>
              <td>
                <?
while ($row22 = mysqli_fetch_array($result22)){
$cat1=$row22['sektorgrupid']; ?>
                <li><A class="link" href='yonetimsektorler.php?cat= <? echo $cat1; ?>'> <? echo $row22['sektorgrup']; ?></A>
                    <? } ?>
                  </td>
            </tr>
                    <tr>
                      <td class="not" colspan="2">Not: Birden fazla sektör seçmenizi tavsiye ederiz. Şu ana kadar seçilen sektör sayısı: <? echo $rescount ?><br><br></td>
                    </tr>
            <TR>
              <td height="50" colspan="2" align="center" bgcolor="#F6F6F6"> <img src="image/iptalet.gif" width="146" height="16" class="ResimDugme" onClick="javascript:window.location ='yonetimgiris.php'" ><img src= "image/trans.gif" alt="" width="20" height="1"><img src="image/geri.gif" width="89" height="16" class="ResimDugme" onClick="javascript:history.go(-1)"><img src= "image/trans.gif" alt="" width="20" height="1"><img src="image/ilerle.gif" width="146" height="16" class="ResimDugme" onClick="Gonder()"></td>
            </TR>
          </table>
          </form></td>
      </tr>
    </table>
    
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
   {alert (" En az 1 sektör seçmelisiniz. ");
	}
	else {
	document.forms.frmSektor.submit(); }
                 }
function Iptal(){
	window.location = "yonetimgiris.php";
}

</script>  

</div>
  <div id="bant1"></div>
  
</div>
</body>
</HTML>
