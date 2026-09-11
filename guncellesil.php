<?php include"headeri.php"; ?>
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
.style1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 9px;
}
.style2 {color: #FF0000}
-->
</style>
</head>

<body>

<SCRIPT LANGUAGE="JavaScript">
<!-- Begin
function anyCheck() {
var total = 0;
var fark=0;
var max = document.LoginForm.length;
for (var idx = 0; idx < max; idx++) {
if (document.LoginForm.elements[idx].type == "checkbox" && document.LoginForm.elements[idx].name=="sektor[]" && document.LoginForm.elements[idx].checked==false) {
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
      document.LoginForm.elements[idx].checked=false;
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
      document.LoginForm.elements[idx].checked=false;
    }
   }
 else
 {
  
  document.LoginForm.submit();
 }
 
}
//  End -->
</script>
<?php 
$verified_firmaid = $_SESSION["verified_firmaid"];
$verified_firma  = $_SESSION["verified_firma"];
$str="select distinct sektorler.sektor,sektorler.sektorid  from gecici,sektorler where gecici.sektorid=sektorler.sektorid and gecici.firmaid='$verified_firmaid' order by sektorler.sektor ";
$result=mysqli_query($connection,$str);
$bos1=mysqli_num_rows($result);
$fark1=$bos1-25;
?>

<div id="sayfa">
  <div id="ust">
    <?php include "ust.php" ?>
  </div>
  <div id="bant1"></div>
  <div id="sol">
    <?php include "menu.php" ?>
  </div>
  <div id="analong">
<table width="540" align="center" cellspacing="0" cellpadding="0" border="0" bgColor=white >
      <tr>
        <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td colspan="4" height="2" bgcolor="#FFFFFF"></td>
            </tr>
            <tr height="25px">
              <td width="25%"><img src="image/5/5_4.gif" width="176" height="64"></td>
              <td width="25%" ></td>
              <td valign="middle" width="43%" align="right" class="title"><p>Güncelleme<br>
                  <span class="title_kucuk">İş Kolları Kontrol</span></p></td>
              <td valign="bottom" align="right" width="7%" ><img src="image/sag_ok.gif" width="27"></td>
            </tr>
          </table></td></tr>
          <tr>
        <td width="100%" valign="top" bgcolor="#F6F6F6" class="Baslik">Sayın <?php echo $verified_firma;?>, lütfen seçmiş olduğunuz iş kollarını kontrol ediniz. </td></tr>
 <?php
if($bos1){ ?>
 					<?php if($bos1>25){?>
                      <TR>
                        <td align="center"><span class="title_kucuk"><br>Seçtiğiniz iş kolu sayısı <?php echo "<font color=Red>".$bos1."</font>"?> tanedir.</span><br>
                            <span class="title_kucuk">Lütfen <?php echo "<font color=Red>".$fark1."</font>"?> adedini silerek <font color="Red">25</font> taneye kadar indiriniz. <br><br></span>
                        <hr></td>
                       </TR>
                       <?php }
                         else{?>
 <tr><td><span class="title_kucuk"><br>Burada sadece <span class="style2">SİLMEK</span> istediğiniz iş kollarını seçiniz. Tamamını kabul ederek devam etmek için <strong>'İlerle'</strong> düğmesini tıklayınız.<br><br></span>  <?php }?>
          <table width="95%"  border="0" align="center" cellpadding="1" cellspacing="0" >
            <tr>
              <td>
              <form action="update.php?islem=sektorsil" method="post" name="LoginForm">
 						<input type="hidden" name="yazi" id="yazi" >
              
<table align="center"  cellspacing="3" cellpadding="0" border="0" width="100%" >
                      <TR>
                        <td>
<?
while ($row = mysqli_fetch_array($result)){?>
     <span class="govde">S&#304;L&nbsp;&nbsp;
                     
                    <input type=checkbox name=sektor[] value=<? echo $row['sektorid']; ?>>
                    <? echo $row['sektor']; ?></span><br>
                    <? } ?></td>
                      </TR>
                        <TR>
                          <td align="center" height="50"><a href="giris.php" class="buttonPage"> İptal &nbsp;<i class="icon-close" ></i></a><img src= "image/trans.gif" alt="" width="20" height="1"><a href="#here" onClick="javascript:history.go(-1)" class="buttonPage"> Geri &nbsp;<i class="icon-arrow-left"></i></a><img src= "image/trans.gif" alt="" width="20" height="1"><a href="#here" onClick="anyCheck()" class="buttonPage"> İlerle &nbsp;<i class="icon-arrow-right"></i></a></td>
                        </TR>            
                    </table>
                  </form>
                  <?php }else{?>
                  <center class="title_kucuk">
                    Sektör Seçim Hatası
                  </center>
                  <table align="center" cellspacing="1" cellpadding="1" border="0" width="100%" >
                    <TR>
                      <td class="info" align="center"><br>
                          <span class="style1"><font color="#FF0000">Lütfen geri dönüp teklif vermek istediğiniz iş kollarını seçiniz.</font></span><br>
                      </td>
                    </TR>
                    <tr>
                      <td height="30" align="center"><a href="javascript:history.go(-1)" class="buttonPage"> Geri &nbsp;<i class="icon-arrow-left"></i></a></td>
                    </tr>
                    <?php } ?>
                </table></td>
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
</div>
<div id="dialog-hata" title="Uyarı" style="display:none" class="text_g" >
  <p>
    <span>Hata mesajları...</span>
  </p>
</div>

</BODY></HTML>