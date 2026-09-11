<?php include"headeri.php"?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="content-language" content="tr" />
<title>tekliftopla</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
<?php include "click.php"?>
</head>

<body>
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
              <td width="25%">&nbsp;</td>
              <td width="25%" ></td>
              <td valign="middle" width="43%" align="right" class="title"><p>Güncel Bilgileriniz<br>
              </p></td>
              <td valign="bottom" align="right" width="7%" ><img src="image/sag_ok.gif" width="27"></td>
            </tr>
          </table>
<TABLE width="95%" border="0" align="center" cellspacing="3" class="govde">
          <?
$verified_firmaid = isset($_SESSION["verified_firmaid"]) ? $_SESSION["verified_firmaid"] : "";
$str="SELECT * FROM bilgi  where firmaid='$verified_firmaid'";
$result=mysqli_query($connection,$str);
while ($row = mysqli_fetch_array($result)){
?>
          <tr><td height="10px"></td></tr>
          <TR align="left">
            <td colspan="2" bgcolor="#F6F6F6" class="Baslik">Bilgilerinizin dökümü.</td>
            </TR>
          <TR>
            <td width="248" class="govde" align="right">Firma veya Kullanıcı Adı :</td>
            <td width="231" class="govde"><?echo  $row['Firma_Adi']?></td>
          </TR>
          <TR>
            <td class="govde" align="right">Yetkili : </td>
            <td class="govde"><? echo $row['yetkili']; ?></td>
          </TR>
          <TR>
            <td class="govde" align="right">Firma veya Kullanıcı Adresi : </td>
            <td class="govde"><? echo $row['Adres']?></td>
          </TR>
          <TR>
            <td  align="right">Posta Kodu :</td>
            <td class="govde"><? echo $row['Posta_Kodu']?></td>
          </TR>
          <TR>
            <td class="govde" align="right">Firma veya Kullanıcı Telefonu :</td>
            <td valign="top" class="govde"><? echo "(".$row['tel_alankodi'].")"?>&nbsp;<?echo $row['Telefon']?></td>
          </TR>
          <TR>
            <td class="govde" align="right">Firma veya Kullanıcı Faxı    : </td>
            <td class="govde"><? echo "(".$row['fax_alankodi'].")";?>&nbsp;<?echo$row['Fax'];?> </td>
          </TR>
          <TR>
            <td class="govde" align="right">Firma Merkezi    :</td>
            <td class="govde"><? echo$row['Sehir']?></td>
          </TR>
          <TR>
            <td  class="govde" align="right">E-Posta Adresi    :</td>
            <td align="left" class="govde"><? echo$row['email']?></td>
          </TR>
          <TR>
            <td  class="govde" align="right">Yurtdışı Teklif :</td>
            <td align="left" class="govde"><? echo $row['lisan'] ; ?></td>
          </TR>
          <TR>
            <td  class="govde" align="right">Web Adresi    :</td>
            <td align="left" class="govde"><? echo $row['Web'] ;} ?></td>
          </TR>
          <tr align="center">
            <td colspan="2" align="left" class="title_kucuk">Teklif vermek istedifiniz iş kolları   : </td> 
            </tr>
           <tr class="govde" > <td colspan="2" align="center" class="govde">
                 <?
				$count=1;
				$column=1;
				$str1="SELECT distinct sektorler.sektor FROM firma_sektor left join sektorler on firma_sektor.sektorid=sektorler.sektorid where 				firma_sektor.firmaid='$verified_firmaid' order by sektorler.sektor";
				$result1=mysqli_query($connection,$str1);
				while ($row1 = mysqli_fetch_array($result1))
				{
				if ($column==1)
				{
				printf("<tr><td>%s</td>",$row1['sektor']);
				}
				else{
				printf("<td>%s</td></tr>",$row1['sektor']);
				}
				$count+=1;
				$column = $count%2;
				}
				?>
                </td></tr>
          <tr>
            <td colspan="2" class="title_kucuk" align="left"><br>Teklif vermek istediginiz şehirler    : </td> 
            </tr>
            <tr class="govde" > <td colspan="2" align="center" class="govde">              
			<?
			$count=1;
			$column=1;
			$strp2="SELECT sehir.sehir FROM  firma_sehir,sehir where firma_sehir.sehirid=sehir.sehirid and firma_sehir.firmaid='$verified_firmaid'  order by sehir.sehir";
			$resultp2=mysqli_query($connection,$strp2);
			while ($rowp2 = mysqli_fetch_array($resultp2))
			{
				if ($column==1)
				{
				printf("<tr><td>%s</td>",$rowp2['sehir']);
				}
				else{
				printf("<td>%s</td></tr>",$rowp2['sehir']);
				}
				$count+=1;
				$column = $count%2;
				}
				?>            
                </td></tr>
        </table>
         <tr>
                        <td colspan="3" height="50" bgcolor="#FFFFFF" align="center"><a href="#here" onClick="Git()" class="buttonPage"> Kullanıcı Menüsü &nbsp;<i class="icon-arrow-right"></i></a></td>
                      </tr>
</table>
</div>
<div id="bant1"></div>
<div id="alt">
<?php include "alt.php" ?>
</div>
</div>

</BODY></HTML>
<script language="javascript">
function Git(){
	window.location ="giris.php";
}
</script>