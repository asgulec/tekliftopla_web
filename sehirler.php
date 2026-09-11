<? include"headerki.php";?>
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
</head>
<body>
<SCRIPT LANGUAGE="JavaScript">
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
 	$(function(){
    $( "#dialog-hata" ).dialog({
		modal:true,
		position: {	my: "center",at: "center",of: sayfa},
		buttons:{Tamam: function () {
    $(this).dialog("close");
}}
	});	
  }); 
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
        <td width="25%"><img src="image/5/5_5.gif" width="176" height="64"></td>
        <td width="25%" ></td>
        <td valign="middle" width="43%" align="right" class="title"><p>Yeni Üye<br>
          <span class="title_kucuk">Şehir Seçimi</span></p></td>
        <td valign="bottom" align="right" width="7%" ><img src="image/sag_ok.gif" width="27"></td>
      </tr>
    </table></td>
</tr>
<tr>
  <td height="10px"></td>
</tr>
      <tr><? $verified_firma = isset($_SESSION['verified_firma']) ? $_SESSION['verified_firma'] : ''; ?>
        <td class="Baslik" valign="top" bgcolor="#F6F6F6">Sayın <?php echo $verified_firma;?> hizmet vermek, iş yapmak istediğiniz şehirleri seçiniz.</td></tr>
        <tr><td>
            <form action="ekle.php?asama=sehir" method="post" id="frmSehir" name="frmSehir">
				<input type="hidden" name="yazi" id="yazi" >
                    <table width="95%"  border="0" align="center" cellpadding="2" cellspacing="0">
                      <tr>
                        <td colspan="3" class="title_kucuk" ><em class="govde"><strong><br>
                        <INPUT name=allbox onclick=CheckAll(); type=checkbox value="Check All">
                        Tümünü Seç</strong></em></td>
                      </tr>
                      <tr>
                        <td colspan="3"><hr>
                        </td>
                      </tr>
                      <tr class="govde">
                        <td  valign="top">
                          <?
$sehirsay="SELECT sehirid FROM sehir where sehirid<999";
$resultseh=mysqli_query($connection,$sehirsay);
$sayseh=mysqli_num_rows($resultseh);
$sayseha=ceil($sayseh/3);
$saysehb=$sayseha*2;
$str1="select * from sehir where sehirid<999 order by sehir limit 0,$sayseha";
$result1=mysqli_query($connection,$str1);
while ($row1 = mysqli_fetch_array($result1)){
                     $deger1=$row1['sehirid']; ?>
                          <input type=checkbox  name=sehir[] value=<? echo $deger1;?>>
                          <? echo $row1['sehir']; ?><br>
                          <? }
										            ?></td>
                        <td  valign="top">
                          <?
$str="select * from sehir where sehirid<999 order by sehir limit $sayseha,$sayseha";
$result=mysqli_query($connection,$str);
while ($row = mysqli_fetch_array($result)){
                     $deger=$row['sehirid']; ?>
                          <input type=checkbox  name=sehir[] value=<? echo $deger ;?>>
                          <? echo $row['sehir']; ?><br>
                          <? }
										            ?></td>
                        <td valign="top">
                          <?
$str="select * from sehir where sehirid<999 order by sehir limit $saysehb,$sayseha";
$result=mysqli_query($connection,$str);
while ($row = mysqli_fetch_array($result)){
                     $deger=$row['sehirid']; ?>
                          <input type=checkbox  name=sehir[] value=<? echo $deger ?>>
                          <? echo $row['sehir']; ?><br>
                          <? }
										            ?></td>
                      </tr>
                      <tr>
                        <td colspan="3" height="50" align="center"><a href="cikis.php" class="buttonPage"> İptal &nbsp;<i class="icon-close" ></i></a><img src= "image/trans.gif" alt="" width="20" height="1"><a href="#here" onClick="javascript:history.go(-1)" class="buttonPage"> Geri &nbsp;<i class="icon-arrow-left"></i></a><img src= "image/trans.gif" alt="" width="20" height="1"><a href="#here" onClick="anyCheck()" class="buttonPage"> İlerle &nbsp;<i class="icon-arrow-right"></i></a></td>
                      </tr>
                    </table>
          </FORM></td>
      </tr>
    </table></td>
  </tr>      </table>
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