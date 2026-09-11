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
<div id="sayfa">
  <div id="ust">
    <?php include "ust.php" ?>
  </div>
  <div id="bant1"></div>
  <div id="sol">
    <?php include "solyonetim.php" ?>
  </div>
  <div id="analong">

<table width="540px" align="center" border="0" cellpadding="0"  cellspacing="0" bgcolor=white >
      <tr>
        <td height="2" bgcolor="#FFFFFF"></td>
      </tr>
      <tr  >
        <td background="image/yeni_orta.gif" height="50" width="191" >&nbsp;</td>
        <td background="image/yeni_orta.gif" width="183" align="center" class="Baslik" valign="bottom"><span class="Baslik">Yönetici Ekleme</span></td>
        <td background="image/yeni_orta.gif" width="154" valign="middle" align="right" class="Buyuk_Yazi">&nbsp;</td>
        <td background="image/yeni_orta.gif" width="27" ><img src="image/sag_ok.gif" width="27" height="64"></td>
      </tr>
      <tr>

        <td width="777" valign="top" bgcolor="#F6F6F6" colspan="4">
        
        <?
$str="select * from yonetim  order by username";
$result=mysqli_query($coni,$str);
?>
 <table width="100%" border="0" align="center" >
<form action="" method="post" name="Liste">
<input type="hidden" name="Durum" value="1">
<input type="hidden" name="username" value="1">
<input type="hidden" name="password" value="1">
<input type="hidden" name="kullaniciekleme" value="0">
<input type="hidden" name="Id" value="1">
   <tr>
     <td ><div align="center" class="title"></div>
	   
       <table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0"  bordercolor="#F6F6F6"  bgcolor="#EAEAEA">
         
         <tr align="right" >
           <td height="50px" colspan="6" bgcolor="#FFFFFF"><input name="Ekle" type="button" class="Dugme"  onClick="YeniKayit()" value="yeni EKLE"></td>
         </tr>
         <tr height="50px">
           <td width="80" bgcolor="#EAEAEA" class="govde"><strong >Yönetici Id </strong></td>
           <td width="144" bgcolor="#F6F6F6" class="govde" ><strong >Yönetici Adı </strong></td>
           <td width="81" bgcolor="#EAEAEA" class="govde"><strong >Şifre</strong></td>
           <td width="150"   bgcolor="#F6F6F6" class="govde" ><strong >Kullanıcı Ekleme </strong></td>
           <td colspan="2" align="right" bgcolor="#EAEAEA" class="link"><a href="yonetimgiris.php">Yönetim Giriş Sayfası</a></td>
         </tr>
         <?
while ($row = mysqli_fetch_array($result))
   {
?>
         <tr>
           <td width="80" bgcolor="#EAEAEA" class="govde" id="Id<? print $row["yonid"]; ?>"><? print $row["yonid"]; ?></td>
           <td width="144" bgcolor="#F6F6F6" class="govde" id="username<? print $row["yonid"]; ?>"><? print $row["username"]; ?></td>
           <td width="81" bgcolor="#EAEAEA" class="govde"id="sifre<? print $row["yonid"]; ?>"><? print $row["password"]; ?></td>
           <td width="75" bgcolor="#F6F6F6" class="govde"id="kullaniciekleme<? print $row["yonid"]; ?>"><? print $row["KullaniciEkleme"]; ?></td>
           <td width="75" align="center"   bgcolor="#EAEAEA">
             <input  name="sil<? print $row["yonid"] ?>" type="button" class="Dugme" id="sil<? print $row["yonid"] ?>"  onClick="Sil(this.id)" value="SIL">
           </td>
           <td width="100" align="center"   bgcolor="#EAEAEA">
             <input  name="duz<? print $row["yonid"] ?>" type="button" class="Dugme" id="duz<? print $row["yonid"] ?>"  onClick="Duzelt(this.id)" value="D&Uuml;ZELT"></td>
         </tr>
		
         <?
	}
?>
       </table></td>
   </tr>
</form>
</table>  
        </td>
      </TR>
               <tr> <td height="50px" colspan="4" align="center" bgcolor="#F6F6F6" class="link"><a href="yonetimgiris.php"><strong>Yönetim Giriş Sayfası</strong></a></td></tr>
    </table> 
</div>
  <div id="bant1"></div> <!-- bant2 -->
  
</div>

</body>
</html>
<script language="javascript">
function YeniKayit() {
document.forms.Liste.Durum.value = 1;
document.forms.Liste.id.value = -1;
document.forms.Liste.action="YoneticiEkle.php";
document.forms.Liste.submit();
}
function Duzelt(val) {
 document.forms.Liste.Durum.value = 2;
 str= val.substr(3);
 document.forms.Liste.Id.value	= str; 
 document.forms.Liste.username.value	= document.getElementById("username"+str).innerHTML ; 
 document.forms.Liste.password.value		= document.getElementById("sifre"+str).innerHTML ; 
 document.forms.Liste.kullaniciekleme.value		= document.getElementById("kullaniciekleme"+str).innerHTML ; 
 document.forms.Liste.action="YoneticiEkle.php";
 document.forms.Liste.submit();
 }
function Sil(val) {
if (window.confirm("Aktif Kaydi SILMEK istediginizden EMIN Misiniz ?"))
{
	document.forms.Liste.Id.value = val.substr(3);
	document.forms.Liste.Durum.value=3;
    document.forms.Liste.action="YoneticiEkleKaydet.php";
    document.forms.Liste.submit();    
}

}
</script>
