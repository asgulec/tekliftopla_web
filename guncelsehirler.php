<? include"headeri.php";?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="content-language" content="tr" />
<title>tekliftopla</title>
<link rel="stylesheet" href="jquery/jquery-ui.theme.css">
<link rel="stylesheet" href="jquery/jquery-ui.css">
<script src="jquery/external/jquery/jquery.js"></script>
<script src="jquery/jquery-ui.min.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style1 {
	color: #FF0000;
	font-weight: bold;
}
-->
</style>
</head>

<body>

<script>
function anyCheck() {
var total = 0;
var fark=0;
var max = document.LoginForm.length;
for (var idx = 0; idx < max; idx++) 
{
   if (document.LoginForm.elements[idx].type == "checkbox" && document.LoginForm.elements[idx].name=="sehir[]" && document.LoginForm.elements[idx].checked==true) 
   {
    total ++;
   }
}

   if(total<1)
   {
   fark=total-10;
 	$(function(){
    $( "#dialog-hata" ).dialog({
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
function CheckAll()
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
<table width="540" align="center" cellspacing="0" cellpadding="0" border="0" bgColor=white >
      <tr>
        <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td colspan="4" height="2" bgcolor="#FFFFFF"></td>
            </tr>
            <tr height="25px">
              <td width="25%"><img src="image/5/5_5.gif" width="176" height="64"></td>
              <td width="25%" ></td>
              <td valign="middle" width="43%" align="right" class="title"><p>Güncelleme<br>
                  <span class="title_kucuk">Şehir Seçimi</span></p></td>
              <td valign="bottom" align="right" width="7%" ><img src="image/sag_ok.gif" width="27"></td>
            </tr>
          </table></td></tr>
        <tr>
          <td valign="top" bgcolor="#F6F6F6" class="Baslik"><? $verified_firma = isset($_SESSION["verified_firma"]) ? $_SESSION["verified_firma"] : ""; ?>
            Sayın <?php echo $verified_firma;?>, faaliyet gösterdiğiniz, iş yaptığınız şehirleri <span class="style1">tekrar</span> seçiniz.<br></td></tr>
            <tr><td>
            <table width="95%"  border="0" align="center" cellpadding="1" cellspacing="0">
              <form action="update.php?islem=guncelsehir" method="post" name="LoginForm">
				<input type="hidden" name="yazi" id="yazi" >
                <?
$verified_firmaid = isset($_SESSION["verified_firmaid"]) ? $_SESSION["verified_firmaid"] : "";
$str2="SELECT distinct sehir.sehir FROM firma_sehir,sehir where firma_sehir.firmaid='$verified_firmaid' and firma_sehir.sehirid=sehir.sehirid order by sehir.sehir";
$result2=mysqli_query($connection,$str2);?>
                <tr>
                  <td colspan="3" class="title_kucuk"><strong><br> Daha önceden seçmiş olduğunuz şehirler; </strong></td>
                </tr>
                <tr>
                  <td colspan="3" class="govde" >
                    <?
while ($row2= mysqli_fetch_array($result2)){ ?>
        ( <? echo $row2['sehir']; ?> ),
        <? } ?>
                  </td>
                </tr>
                <tr>
                  <td colspan="3" bgcolor="#F6F6F6">
                    <INPUT name=allbox onclick=CheckAll(); type=checkbox value="Check All">
                  <span class="govde"> Tümünü Seç</span></td>
                </tr>
                <tr>
                  <td valign="top">
                
                    <?
$sehirsay="SELECT sehirid FROM sehir where sehirid<999";
$resultseh=mysqli_query($connection,$sehirsay);
$sayseh=mysqli_num_rows($resultseh);
$sayseha=ceil($sayseh/3);
$saysehb=$sayseha*2;
$str1="select * from sehir where sehirid<999 order by sehir limit 0,$sayseha";
$result1=mysqli_query($connection,$str1);
while ($row1 = mysqli_fetch_array($result1)){ ?>
                        <span class="govde"><input type="checkbox"  name=sehir[] value=<? echo $row1['sehirid'];?> >
                    <? echo $row1['sehir'];?> </span><br>
                    <? } ?>
                  </td>
                  <td  valign="top">
                   
                    <?
$str="select * from sehir where sehirid<999 order by sehir limit $sayseha,$sayseha";
$result=mysqli_query($connection,$str);
while ($row = mysqli_fetch_array($result)){ ?>
                    <span class="govde"> <input type=checkbox  name="sehir[]" value= <? echo $row['sehirid']; ?>>
                    <? echo $row['sehir']; ?> </span><br>
                    <? } ?>
                  </td>
                  <td valign="top">
                    
                    <?
$str="select * from sehir where sehirid<999 order by sehir limit $saysehb,$sayseha";
$result=mysqli_query($connection,$str);
while ($row = mysqli_fetch_array($result)){ ?>
                    <span class="govde"><input type=checkbox  name=sehir[] value=<? echo $row['sehirid']; ?>>
                    <? echo $row['sehir']; ?></span><br>
                    <? } ?>
                  </td>
                </tr>
                <tr>
                  <td colspan="3" height="50" align="center"><a href="giris.php" class="buttonPage"> İptal &nbsp;<i class="icon-close" ></i></a><img src= "image/trans.gif" alt="" width="20" height="1"><a href="#here" onClick="javascript:history.go(-1)" class="buttonPage"> Geri &nbsp;<i class="icon-arrow-left"></i></a><img src= "image/trans.gif" alt="" width="20" height="1"><a href="#here" onClick="anyCheck()" class="buttonPage"> İlerle &nbsp;<i class="icon-arrow-right"></i></a></td>
                </tr>
              </FORM>
          </table>          </td>
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
    En az 1 tane şehir seçmelisiniz...
  </p>
</div>

</body>
</html>