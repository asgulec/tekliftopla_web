<?php include "headeryon.php"; ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="content-language" content="tr" />
<title>tekliftopla</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
</head>
<body bgcolor="#FFFFFF">
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
      <form name="frmHaber" method="post" action="IsKoluKaydet.php">
        <input type="hidden" name="Durum" value="<? print $_POST["Durum"];?>">
        <input name="Id" type="hidden" value="<? print $_POST["Id"]; ?>">
        <tr bgcolor="#FFFFFF">
          <td colspan="2" align="center"bgcolor="#FFFFFF" class="title_kucuk">Sektör - İş Kolu  Ekleme/De&#287;i&#351;tirme </td>
        </tr>
        <tr bgcolor="#FFFFFF">
          <td class="title_kucuk">Sektor Grup Adı </td>
          <td><? $str="SELECT * FROM  sektor_grup where sektorgrupid!='26'  order by sektorgrup ";
$result=mysqli_query($coni,$str);  ?>

<select name="SektorGrup">
<? while ($row = mysqli_fetch_array($result)){ ?>
            <option value="<? echo $row['sektorgrupid'] ?>" <? if($_POST["Durum"]==2) if($_POST["SektorGrupId"]==$row['sektorgrupid']) print "selected"; ?>> <? echo $row['sektorgrup'] ?></option>
<? } ?>
          </select>
		</td>
        </tr>
        <tr bgcolor="#FFFFFF">
          <td width="33%" class="title_kucuk">İş Kolu  Ad&#305; </td>
          <td width="67%">
<? $str="SELECT * FROM  sektorler order by sektor ";
$result=mysqli_query($coni,$str);  ?>

<select name="IsKolu">
<? while ($row = mysqli_fetch_array($result)){ ?>
            <option value="<? echo $row['sektorid'] ?>" <? if($_POST["Durum"]==2) if($_POST["IsKoluId"]==$row['sektorid']) print "selected"; ?>> <? echo $row['sektor'] ?></option>
<? } ?>
          </select>            
          </td>
        </tr>
        <tr bgcolor="#FFFFFF">
          <td height="26" align="left" valign="top">&nbsp;</td>
          <td align="left" valign="top">
            <input name="Gonder" type="button"  value="Kaydet" onClick="Denetle()">
            <input name="Iptal" type="button"  value="IPTAL" onClick="javascript:history.go(-1);"></td>
        </tr>
      </form>
    </table>
 </div>
  <div id="bant1"></div> <!-- bant2 -->
  </div>

</body>
</html>
<script language="JavaScript" type="text/javascript">
 function Denetle()
 {   
  document.forms.frmHaber.submit(); 
 }
</script>