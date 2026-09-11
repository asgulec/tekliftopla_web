<?php include "headeryon.php"; ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="content-language" content="tr" />
<title>tekliftopla</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
 <?
$str="SELECT 	s.sektorid,s.sektor
		  FROM 		sektorler s
		 Order by s.sektor";
$result=mysqli_query($coni,$str);
?>
<div id="sayfa">
  <div id="ust">
    <?php include "ust.php" ?>
  </div>
  <div id="bant1"></div>
  <div id="sol">
    <?php include "solyonetim.php" ?>
  </div>
  <div id="analong">

<table width="540px"  border="0" align="center" cellpadding="2" cellspacing="0"  bordercolor="#F6F6F6"  bgcolor="#EAEAEA">
	 <form action="" method="post" name="Liste">
<input type="hidden" name="Durum" value="1">
<input type="hidden" name="Sektor" value="1">
<input type="hidden" name="Id" value="1">
       <tr align="right" >
         <td colspan="7" align="center"bgcolor="#FFFFFF"><span class="title_kucuk">İş Kolu   Listesi </span></td>
       </tr>
       <tr align="right" >
         <td colspan="7" bgcolor="#FFFFFF"><input name="Ekle" type="button" class="Dugme"  onClick="YeniKayit()" value="yeni EKLE"></td>
       </tr>
       <tr>
         <td width="41" bgcolor="#F6F6F6" class="govde" ><strong >Sektör Id </strong></td>
         <td width="324" bgcolor="#F6F6F6" class="govde" ><strong >Sektör</strong></td>
         <td colspan="2" align="right" bgcolor="#EAEAEA" class="link"><a href="yonetimgiris.php">Yönetim Giriş Sayfası</a></td>
       </tr>
       <?
while ($row = mysqli_fetch_array($result))
   {
?>
       <tr>
         <td bgcolor="#F6F6F6" class="govde" id="SektorId<? print $row["sektorid"]; ?>"><? print $row["sektorid"]; ?></td>
         <td bgcolor="#EAEAEA" class="govde" id="Sektor<? print $row["sektorid"]; ?>"><? print $row["sektor"]; ?></td>
         <td width="61" bgcolor="#F6F6F6">
           <input  name="sil<? print $row["sektorid"] ?>" type="button" class="Dugme" id="sil<? print $row["sektorid"] ?>"  onClick="Sil(this.id)" value="SIL">
         </td>
         <td width="71"   bgcolor="#FFFFFF">
           <input  name="duz<? print $row["sektorid"] ?>" type="button" class="Dugme" id="duz<? print $row["sektorid"] ?>"  onClick="Duzelt(this.id)" value="D&Uuml;ZELT"></td>
       </tr>
       <tr>
         <td bgcolor="#FFFFFF" colspan="5" height="2"></td>
       </tr>
       <?
	}
?>
     </form></table>
 </div>
  <div id="bant1"></div> <!-- bant2 -->
 
</div>

</body>
</html>
<script language="javascript">
function YeniKayit() {
document.forms.Liste.Durum.value = 1;
document.forms.Liste.Id.value = -1;
document.forms.Liste.action="Sektor.php";
document.forms.Liste.submit();
}
function Duzelt(val) {
 document.forms.Liste.Durum.value = 2;
 str= val.substr(3);
 document.forms.Liste.Id.value	= str; 
 document.forms.Liste.Sektor.value= document.getElementById("Sektor"+str).innerHTML ; 
 document.forms.Liste.action="Sektor.php";
 document.forms.Liste.submit();
 }
function Sil(val) {
if (window.confirm("Aktif Kaydi SILMEK istediginizden EMIN Misiniz ?"))
{
	document.forms.Liste.Id.value = val.substr(3);
	document.forms.Liste.Durum.value=3;
    document.forms.Liste.action="SektorKaydet.php";
    document.forms.Liste.submit();    
}

}
</script>
