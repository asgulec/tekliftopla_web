<?php include"headerki.php";?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="content-language" content="tr" />
<title>tekliftopla</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="jquery/jquery-ui.theme.css">
<link rel="stylesheet" href="jquery/jquery-ui.css">
<script src="jquery/external/jquery/jquery.js"></script>
<script src="jquery/jquery-ui.min.js"></script>
<style type="text/css">
<!--
.style1 {color: #FF0000}
-->
</style>
</head>

<body>
<?php $verified_firmaid = isset($_SESSION["verified_firmaid"]) ? $_SESSION["verified_firmaid"] : '';
$str="select distinct sektorler.sektor,sektorler.sektorid  from gecici1,sektorler where gecici1.sektorid=sektorler.sektorid and gecici1.firmaid=$verified_firmaid order by sektor ";
$result=mysqli_query($connection,$str);
$bos=mysqli_num_rows($result);
$fark=$bos-25;
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
   {
    $(function(){
    $("#dialog-hata span").text('İş kollarının hepsini silmeyiniz...');
	$("#dialog-hata" ).dialog({
		modal:true,
		position: {	my: "center",at: "center",of: sayfa},
		buttons:{Tamam: function () {
    $(this).dialog("close");
    }}
	});	
    });

    for (var idx = 0; idx < max; idx++) 
    {
      document.frmSektorOnay.elements[idx].checked=false;
    }
   }
 else if(total>25)
   {
   fark=total-25;
   	$(function(){
    $("#dialog-hata span").text('En fazla 25 iş kolu seçebilirsiniz. Lütfen '+fark+' tane silinecek iş kolu seçiniz...');
	$("#dialog-hata" ).dialog({
		modal:true,
		position: {	my: "center",at: "center",of: sayfa},
		buttons:{Tamam: function () {
    $(this).dialog("close");
    }}
	});	
    });

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
  <?php include "menu.php" ?>
</div>
<div id="analong">
<table width="540" align="center"  cellspacing="0" cellpadding="0" border="0" bgColor=white >
<tr>
  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td colspan="4" height="2" bgcolor="#FFFFFF"></td>
      </tr>
      <tr height="25px">
        <td width="25%"><img src="image/5/5_4.gif" width="176" height="64"></td>
        <td width="25%" ></td>
        <td valign="middle" width="43%" align="right" class="title"><p>Yeni Üye<br>
          <span class="title_kucuk">İş Kolları Kontrol</span></p></td>
        <td valign="bottom" align="right" width="7%" ><img src="image/sag_ok.gif" width="27"></td>
      </tr>
    </table></td>
</tr>
<tr>
  <td height="10px"></td>
</tr>
        <tr><?php $verified_firma = isset($_SESSION["verified_firma"]) ? $_SESSION["verified_firma"] : ''; ?>
          <td bgcolor="#F6F6F6" class="Baslik"><span style="margin-left:5px">Sayın <?php echo $verified_firma;?>, lütfen seçmiş olduğunuz iş kollarını kontrol ediniz. </span></td></tr>
          <tr><td>
            <table width="98%"  border="0" align="center" cellpadding="2" cellspacing="0">
                <tr>
                  <td><center class="not">
                    <strong>  
                    </strong>
                  </center></td>
                </tr>
                <tr>
                  <td>
                    <form  name="frmSektorOnay" id="frmSektorOnay" method="post" action="ekle.php?asama=denetle" >
						<input type="hidden" name="yazi" id="yazi" >
                      <?php
/* action="ekle.php?cat2=<?php echo $cat ;?>&asama=denetle" - asg değiştirdi
$verified_firmaid = $_SESSION["verified_firmaid"];
$str="select distinct sektorler.sektor,sektorler.sektorid  from gecici1,sektorler where gecici1.sektorid=sektorler.sektorid and gecici1.firmaid=$verified_firmaid order by sektor ";
$result=mysql_db_query($db,"$str");
$bos=mysql_num_rows($result); */
if($bos){ ?>
                      <table align="center"  cellspacing="1" cellpadding="1" border="0" leftmagin="20" width="100%">
                        <?php if($bos>25){?>
                      <TR>
                        <td class="govde"><br>Seçtiğiniz iş kolu sayısı <?php echo "<font color=Red>".$bos."</font>"?> adettir. Lütfen <?php echo "<font color=Red>".$fark."</font>"?> adedini silerek <font color="Red">25</font> taneye kadar indiriniz.<br> </td></TR>
                      <?php }
else{?>
                        <TR>
                          <td class="govde" align="left" ><br>Aşağıdan seçeceğiniz iş kolları <span class="style1"><strong>silinecektir</strong></span>. Listeyi kabul için <strong>"İlerle"</strong> düğmesini tıklayınız.<br></td>
                        </TR>
                        <?php }?>
                        <TR>
                          <td class="govde">
                                   <?php
while ($row = mysqli_fetch_array($result)){
?>                            Sil&nbsp;&nbsp;
                    <input type=checkbox  name=sektor[] value=<? echo $row['sektorid']; ?>>
                    <?php echo $row['sektor']; ?> <br>
                    <?php } ?>
                    <center>
                    </center></td>
                        </TR>
                        <TR>
                          <td align="center" height="50"><a href="cikis.php" class="buttonPage"> İptal &nbsp;<i class="icon-close" ></i></a><img src= "image/trans.gif" alt="" width="20" height="1"><a href="#here" onClick="javascript:history.go(-1)" class="buttonPage"> Geri &nbsp;<i class="icon-arrow-left"></i></a><img src= "image/trans.gif" alt="" width="20" height="1"><a href="#here" onClick="anyCheck()" class="buttonPage"> İlerle &nbsp;<i class="icon-arrow-right"></i></a></td>
                        </TR>
                      </table>
                    </form>
                  </td> <?php } ?>
                </tr>
            </table></td>
        </tr>
      </table>
</div>
<div id="bant1"></div>
<div id="alt">
  <?php include "alt.php" ?>
</div>
</div>
<div id="dialog-hata" title="Uyarı" style="display:none" class="text_g" >
  <p>
    <span>Hata mesajları...</span>
  </p>
</div>

</BODY></HTML>