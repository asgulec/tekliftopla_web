<?php include"headeryon.php"; ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="content-language" content="tr" />
<title>..:: Teklif Toplama Sitesine Hosgeldiniz ::..</title>
<link href="css/style.css" rel="stylesheet" type="text/css">

<style type="text/css">
<!--
.style1 {color: #FF0000}
-->
</style>
</head>

<body>
<?php $rekid = $_SESSION["rekid"];
$str="select distinct sektorler.sektor,sektorler.sektorid  from gecrek1,sektorler where gecrek1.sektorid=sektorler.sektorid and gecrek1.rekid=$rekid order by sektor ";
$result=mysqli_query($coni,$str);
?>

<SCRIPT LANGUAGE="JavaScript">
<!-- Begin
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
   {alert(" Sektörlerin hepsini silemezsiniz. ");
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
<link href="css/style.css" rel="stylesheet" type="text/css">


<table width="737" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td colspan="2" ><?php include "ust.php"?></td>
    </tr>
    <tr>
      <td width="176" valign="top"><?php include "sol.php";?></td>
      <td   valign="top"><table width="100%" border="0" cellpadding="0">
        <tr>
          <td >		<table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td colspan="4" height="2" bgcolor="#FFFFFF"></td>
            </tr>
            <tr >
              <td background="image/yeni_orta.gif" height="50" width="191" ><img src="image/5/5_4.gif" width="176" height="64"></td>
              <td background="image/yeni_orta.gif" width="183" align="center" class="Baslik" valign="bottom">&nbsp;</td>
              <td background="image/yeni_orta.gif" width="154" valign="middle" align="right" class="Buyuk_Yazi"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td align="right">YENİ REKLAM </td>
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
          <td bgcolor="#F6F6F6"><span class="title_kucuk" style="margin-left:5px">Lütfen seçmiş olduğunuz sektörleri kontrol ediniz. </span>
              <table width="98%"  border="0" align="center" cellpadding="2" cellspacing="0"  bordercolor="#EAEAEA"  bgcolor="#F6F6F6">
                <tr>
                  <td><center class="not">
                    <strong>  
                    </strong>
                  </center></td>
                </tr>
                <tr>
                  <td>
                    
                        <TR>
                          <td align="left" > <span class="not">Aşağıdan seçeceğiniz sektörler <span class="style1"><strong>silinecektir</strong></span>. Listeyi kabul için <strong>"İlerle"</strong> düğmesini tıklayınız.</span>
                            <hr></td>
                        </TR>
                        <TR>
                          <td class="govde"><form  name="frmSektorOnay" id="frmSektorOnay" method="post" action="rekekle.php?asama=denetle" >
						<input type="hidden" name="yazi" id="yazi" >
                                   <?php
while ($row = mysqli_fetch_array($result)){
?>                            Sil&nbsp;&nbsp;
                    <input type=checkbox  name=sektor[] value=<? echo $row['sektorid']; ?>>
                    <?php echo $row['sektor']; ?> <br>
                    <?php } ?></form>
                    </td>
                        </TR>
                        <TR>
                          <td align="center" height="30" bgcolor="#FFFFFF"><span class="aciklama"><strong><img src="image/iptalet.gif" width="146" height="16" class="ResimDugme" onClick="javascript:window.location ='index.php'" > <strong><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </strong></strong></strong></span><img src="image/geri.gif" width="89" height="16" class="ResimDugme" onClick="javascript:history.go(-1)"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<img src="image/ilerle.gif" width="146" height="16" class="ResimDugme" onClick="anyCheck()"></td>
                        </TR>
                      </table>
                    
                  </td> 
        </tr>
            </table></td>
        </tr>
      </table></td>
    </tr>
    
</table>
</BODY></HTML>