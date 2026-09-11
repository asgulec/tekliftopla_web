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
$str="SELECT 	sg.id, sg.sektorgrupid,sg.sektorid,g.sektorgrup, s.sektor
		  FROM 		sektor_sektorgrup sg, sektorler s, sektor_grup g
		  WHERE 	sg.sektorgrupid = g.sektorgrupid and 
						s.sektorid = sg.sektorid and 
						g.sektorgrupid != 26 			
		 Order by g.sektorgrup, s.sektor";
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

 <table width="540px"  border="0" align="center" cellpadding="1" cellspacing="0"  bordercolor="#F6F6F6"  bgcolor="#EAEAEA">
	 <form action="" method="post" name="Liste">
<input type="hidden" name="Durum" value="1">
<input type="hidden" name="SektorGrup" value="1">
<input type="hidden" name="IsKolu" value="1">
<input type="hidden" name="Id" value="1">
<input type="hidden" name="SektorGrupId" value="1">
<input type="hidden" name="IsKoluId" value="1">
       <tr align="right" >
         <td colspan="7" align="center"bgcolor="#FFFFFF"><span class="title_kucuk">Sektör - İş Kolu Listesi </span></td>
       </tr>
       <tr align="right" >
         <td colspan="7" bgcolor="#FFFFFF"><input name="Ekle" type="button" class="Dugme"  onClick="YeniKayit()" value="yeni EKLE"></td>
       </tr>
       <tr>
         <td width="21" bgcolor="#EAEAEA" class="govde"><strong >Id </strong></td>
         <td width="41" bgcolor="#F6F6F6" class="govde" ><strong >Sektör Id </strong></td>
         <td width="28" bgcolor="#F6F6F6" class="govde" ><strong >İş Kolu Id </strong></td>
         <td width="152" bgcolor="#F6F6F6" class="govde" ><strong >Sektör Grubu</strong></td>
         <td width="149" bgcolor="#F6F6F6" class="govde" ><strong >İş Kolu </strong></td>
         <td colspan="2" align="right" bgcolor="#EAEAEA" class="link"><a href="yonetimgiris.php">Yönetim Giriş Sayfası</a></td>
       </tr>
       <?php
while ($row = mysqli_fetch_array($result))
   {
?>
       <tr>
         <td width="21" bgcolor="#EAEAEA" class="govde" id="Id<? print $row["id"]; ?>"><? print $row["id"]; ?></td>
         <td width="41" bgcolor="#F6F6F6" class="govde" id="SektorGrupId<? print $row["id"]; ?>"><? print $row["sektorgrupid"]; ?></td>
         <td width="28" bgcolor="#F6F6F6" class="govde" id="IsKoluId<? print $row["id"]; ?>"><? print $row["sektorid"]; ?></td>
         <td width="152" bgcolor="#F6F6F6" class="govde" id="SektorGrup<? print $row["id"]; ?>"><? print $row["sektorgrup"]; ?></td>
         <td width="149" bgcolor="#F6F6F6" class="govde" id="IsKolu<? print $row["id"]; ?>"><? print $row["sektor"]; ?></td>
         <td width="35" align="center"   bgcolor="#EAEAEA">
           <input  name="sil<? print $row["id"] ?>" type="button" class="Dugme" id="sil<? print $row["id"] ?>"  onClick="Sil(id)" value="SIL">
         </td>
         <td width="59" align="center"   bgcolor="#FFFFFF">
           <input  name="duz<? print $row["id"] ?>" type="button" class="Dugme" id="duz<? print $row["id"] ?>"  onClick="Duzelt(id)" value="D&Uuml;ZELT"></td>
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
document.forms.Liste.action="IsKolu.php";
document.forms.Liste.submit();
}
function Duzelt(val) {
 document.forms.Liste.Durum.value = 2;
 str= val.substr(3);
 document.forms.Liste.Id.value	= str; 
 document.forms.Liste.SektorGrupId.value= document.getElementById("SektorGrupId"+str).innerHTML ; 
 document.forms.Liste.IsKoluId.value		= document.getElementById("IsKoluId"+str).innerHTML ; 
 document.forms.Liste.SektorGrup.value	= document.getElementById("SektorGrup"+str).innerHTML ; 
 document.forms.Liste.IsKolu.value			= document.getElementById("IsKolu"+str).innerHTML ; 
 document.forms.Liste.action="IsKolu.php";
 document.forms.Liste.submit();
 }
function Sil(val) {
if (window.confirm("Aktif Kaydi SILMEK istediginizden EMIN Misiniz ?"))
{
	document.forms.Liste.Id.value = val.substr(3);
	document.forms.Liste.IsKoluId.value		= document.getElementById("IsKoluId"+str).innerHTML ; 
	document.forms.Liste.Durum.value=3;
    document.forms.Liste.action="IsKoluKaydet.php";
    document.forms.Liste.submit();    
}

}
</script>
