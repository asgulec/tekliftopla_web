<?php include "headeryon.php"; ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="content-language" content="tr" />
<title>tekliftopla</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style1 {
	color: #FF0000
}
-->
</style>
</head>

<body>
<?php $verified_firmaid = isset($_SESSION["verified_firmaid"]) ? $_SESSION["verified_firmaid"] : '';
$str="select distinct sektorler.sektor,sektorler.sektorid  from gecici1,sektorler where gecici1.sektorid=sektorler.sektorid and gecici1.firmaid=$verified_firmaid order by sektor ";
$result=mysqli_query($coni,$str);
$bos=mysqli_num_rows($result);
$fark=$bos-25;
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
var max = document.frmSektorOnay.length;
for (var idx = 0; idx < max; idx++) {
if (document.frmSektorOnay.elements[idx].type == "checkbox" && document.frmSektorOnay.elements[idx].name=="sektor[]" && document.frmSektorOnay.elements[idx].checked==false) {
    total ++;
   }
}
   if(total<1)
   {alert( " Sektörlerin hepsini silemezsiniz. ");
  	for (var idx = 0; idx < max; idx++) 
    {
      document.frmSektorOnay.elements[idx].checked=false;
    }
   }
 else if(total>25)
   {
   fark=total-25;
 	alert(" En fazla 25 ektör seçebilirsiniz. Lütfen "+fark+" tane sektor seçerek siliniz. ");
	for (var idx = 0; idx < max; idx++) 
    {
      document.frmSektorOnay.elements[idx].checked=false;
    }
   }
 
 else
 {
  
  document.frmSektorOnay.submit();
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
    <table width="540px" align="center" border="0" cellpadding="0">
      <tr>
        <td ><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td colspan="4" height="2" bgcolor="#FFFFFF"></td>
            </tr>
            <tr >
              <td background="image/yeni_orta.gif" height="50" width="191" ><img src="image/5/5_4.gif" width="176" height="64"></td>
              <td background="image/yeni_orta.gif" width="183" align="center" class="Baslik" valign="bottom">&nbsp;</td>
              <td background="image/yeni_orta.gif" width="154" valign="middle" align="right" class="Buyuk_Yazi"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td align="right">Yeni Üye</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                </table></td>
              <td background="image/yeni_orta.gif" width="27" ><img src="image/sag_ok.gif" width="27" height="64"></td>
            </tr>
          </table></td>
      </tr>
      <tr>
        <?php $verified_firma = isset($_SESSION["verified_firma"]) ? $_SESSION["verified_firma"] : ''; ?>
        <td bgcolor="#F6F6F6"><span class="title_kucuk" style="margin-left:5px"></span> <span class="title_kucuk"><?php echo $verified_firma;?></span> <span class="title_kucuk">için seçmiş olduğunuz sektörleri kontrol ediniz. </span>
          <table width="98%"  border="0" align="center" cellpadding="2" cellspacing="0"  bordercolor="#EAEAEA"  bgcolor="#F6F6F6">
            <tr>
              <td><center class="not">
                  <strong> </strong>
                </center></td>
            </tr>
            <tr>
              <td><form  name="frmSektorOnay" id="frmSektorOnay" method="post" action="yonekle.php?asama=denetle" >
                  <input type="hidden" name="yazi" id="yazi" >
                  <?php
/* yonekle.php?cat2=<?php echo $cat ;?>&asama=denetle -asg actiondan sildi */
$verified_firmaid = $_SESSION["verified_firmaid"];
$str="select distinct sektorler.sektor,sektorler.sektorid  from gecici1,sektorler where gecici1.sektorid=sektorler.sektorid and gecici1.firmaid=$verified_firmaid order by sektor ";
$result=mysqli_query($coni,$str);
$bos=mysqli_num_rows($result);
if($bos){ ?>
                  <table align="center"  cellspacing="1" cellpadding="1" border="0" leftmagin="20" width="100%">
                    <?php if($bos>25){?>
                    <TR>
                      <td class="y" align="center"><span class="title_kucuk">Seçtiğiniz sektör sayısı </span><span class="title_kucuk"><?php echo "<font color=Red>".$bos."</font>"?> </span><span class="title_kucuk"> tanedir.</span><br>
                        <span class="title_kucuk">L&uuml;tfen </span><span class="title_kucuk"><?php echo "<font color=Red>".$fark."</font>"?></span><span class="title_kucuk"> adedini silerek <font color="Red">25</font> taneye kadar indiriniz. </span>
                        <hr></td>
                    </TR>
                    <?php }
else{?>
                    <TR>
                      <td align="left" ><span class="not">Aşağıdan seçeceğiniz sektörler <span class="style1"><strong>silinecektir</strong></span>. Listeyi kabul için <strong>"İlerle"</strong> düğmesini tıklayınız.</span>
                        <hr></td>
                    </TR>
                    <?php }?>
                    <TR>
                      <td class="govde"><?php
while ($row = mysqli_fetch_array($result)){
?>
                        Sil&nbsp;&nbsp;
                        <input type=checkbox  name=sektor[] value=<? echo $row['sektorid']; ?>>
                        <?php echo $row['sektor']; ?> <br>
                        <?php } ?>
                        <center>
                        </center></td>
                    </TR>
                    <TR>
                      <td align="center" height="50"><img src="image/iptalet.gif" width="146" height="16" class="ResimDugme" onClick="javascript:window.location ='yonetimgiris.php'" > <img src= "image/trans.gif" alt="" width="20" height="1"><img src="image/geri.gif" width="89" height="16" class="ResimDugme" onClick="javascript:history.go(-1)"><img src= "image/trans.gif" alt="" width="20" height="1"><img src="image/ilerle.gif" width="146" height="16" class="ResimDugme" onClick="anyCheck()"></td>
                    </TR>
                  </table>
                </form></td>
              <?php } ?>
            </tr>
          </table></td>
      </tr>
    </table>
  </div>
  <div id="bant1"></div>
  
</div>
</BODY>
</HTML>