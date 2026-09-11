<?php include"headeryon.php";?>
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
$verified_kulid = $_SESSION["verified_kulid"];
/*$link=mysql_connect($host,$user,$password) or die("ba?lanty yok");
$query="SET NAMES 'UTF8'";
mysql_query($query);*/
$str="select distinct sektorler.sektor,sektorler.sektorid  from gecici2,sektorler where gecici2.sektorid=sektorler.sektorid and gecici2.kullanimid='$verified_kulid' order by sektorler.sektor ";
$result=mysqli_query($coni,$str);
$adet=mysqli_num_rows($result);
$fark=$adet-10;
?>
<SCRIPT LANGUAGE="JavaScript">
<!-- Begin
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
var max = document.playlist.length;
for (var idx = 0; idx < max; idx++) {
if (document.playlist.elements[idx].type == "checkbox" && document.playlist.elements[idx].name=="sektor[]" && document.playlist.elements[idx].checked==false) {
    total ++;
   }
}
   if(total>10)
   {
   fark=total-10;
 	alert (" Lütfen "+fark+" tane sektor seçerek siliniz. ");
    for (var idx = 0; idx < max; idx++) 
    {
      document.playlist.elements[idx].checked=false;
    }
    }
	else if(total<1)
   {alert (" Lütfen en az bir sektörü silmeyiniz. ");
    for (var idx = 0; idx < max; idx++) 
    {
      document.playlist.elements[idx].checked=false;
    }
    }
 else
 {
  
  document.playlist.submit();
 }
 
}
//  End -->
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
              <td height="50" width="191" ><img src="image/5/5_4.gif" width="176" height="64"></td>
              <td width="183" align="center" class="Baslik" valign="bottom"></td>
              <td width="154" valign="middle" align="right" class="Baslik" >Kontrol</td>
              <td width="27" ><img src="image/sag_ok.gif" width="27" height="64"></td>
            </tr>
          </table></td></tr>
          <tr>
        <td bgcolor="#F6F6F6"><span class="title_kucuk">Sayın  <? $verified_user = $_SESSION["verified_user"]; echo $verified_user;?>,&nbsp;l&uuml;tfen se&ccedil;mi&#351; oldu&#287;unuz i&#351; kollar&#305;n&#305; kontrol ediniz</span>
            <table width="95%"  border="0" align="center" cellpadding="2" cellspacing="0"  bordercolor="#EAEAEA"  bgcolor="#F6F6F6">
              <tr>
                <td>
                                 <span class="not">*</span>
                                 <form action="yonetimkulekle.php?islem=kulmodsil" method="post" name="playlist">
					<input type="hidden" name="yazi" id="yazi" >
                    <table align="center"  bgcolor="#EAEAEA" cellspacing="1" cellpadding="1" border="0" leftmagin="20" width="100%" >
                      <? if($adet>10){?>
                      <TR>
                        <td class="y" align="center"><span class="govde">Seçtiğiniz sektör sayısı </span><span class="title_kucuk"><?echo "<font color=Red>".$adet."</font>"?> </span><span class="govde"> tanedir.</span><br>
                            <span class="govde">L&uuml;tfen </span><strong><span class="title_kucuk"><?echo "<font color=Red>".$fark."</font>"?></span></strong><span class="govde"> tanesi silerek <font color="Red">10</font> taneye kadar indiriniz. </span>
                        <hr></td>
                      </TR>
                      <? }
else{?>
                      <TR>
                        <td class="y" align="center"><span class="not">A&#351;a&#287;&#305;dan se&ccedil;ece&#287;iniz i&#351; kolları <font color="Red">silinecektir.</font></span>
                          <hr></td>
                      </TR>
                      <? }?>
                      <TR>
                        <td>
                          <?
while ($row = mysqli_fetch_array($result)){
                     $deger=$row['sektorid']; ?>
                          <span class="govde">Sil</span>&nbsp;&nbsp;
              <input type = "checkbox" name="sektor[]" value=<? echo $deger;?> >
              <span class="govde"><? echo $row['sektor'];?></span><br>
              <? }?>
              <center>
            </center></td>
                      </TR>
                      <TR>
                        <td align="center" height="50" bgcolor="#F6F6F6"><img src="image/iptalet.gif" width="146" height="16" class="ResimDugme" onClick="javascript:window.location ='yonetimgiris.php'" ><img src= "image/trans.gif" alt="" width="20" height="1"> <img src="image/geri.gif" width="89" height="16" class="ResimDugme" onClick="javascript:history.go(-1)"><img src= "image/trans.gif" alt="" width="20" height="1"><img src="image/ilerle.gif" width="146" height="16" class="ResimDugme" onClick="anyCheck()"></td>
                      </TR>
                    </table>
                </form></td>
              </tr>
            </table></td></tr></table>
   </div>
  <div id="bant1"></div>
  
</div>
</body>
</HTML>
