<?php include"headeri-e.php" ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="content-language" content="us" />
<title>tekliftopla</title>
<link href="../css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="sayfa">
  <div id="ust">
    <?php include "ust-e.php" ?>
  </div>
  <div id="bant1"></div>
  <div id="sol">
    <?php include "menu-e.php" ?>
  </div>
  <div id="analong">
    <table width="97%" align="center"  cellspacing="0" cellpadding="0" border="0" bgColor=white >
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td colspan="4" height="2" bgcolor="#FFFFFF"></td>
            </tr>
            <tr height="25px">
              <td width="25%"></td>
              <td width="25%" ></td>
              <td valign="middle" width="43%" align="right" class="title">Approve RFP</td>
              <td valign="bottom" align="right" width="7%" ><img src="../image/sag_ok.gif"></td>
            </tr>
          </table></td>
      </tr>
      <tr>
        <td height="10px"></td>
      </tr>
      <tr>
        <td width="97%" valign="top" bgcolor="#F6F6F6"><? $verified_firma = isset($_SESSION["verified_firma"]) ? $_SESSION["verified_firma"]: '';?>
          <span class="Baslik" > Please check and confirm the RFP or revise if necessary.</span></td>
      </tr>
      <tr>
        <td height="5px" bgcolor="#F6F6F6"></td>
      </tr>
      <tr>
        <td><table width="95%"  border="0" align="center" cellpadding="3" cellspacing="5"  >
            <form action="emaililk-e.php" method="post" name="LoginForm">
              <TR>
                <? 
$verified_kulid = isset($_SESSION["verified_kulid"]) ? $_SESSION["verified_kulid"] : '';
$str="SELECT * FROM  kullanim  where Kullanimid='$verified_kulid'";
$result=mysqli_query($connection,$str);
while ($row = mysqli_fetch_array($result)){
?>
              <TR>
                <td width="30%" align="right" class="govde">RFP reference number :</td>
                <td  class="govde"><span class="title_kucuk"><? echo$verified_kulid;?></span></td>
              </TR>
              <TR style="display:none">
                <td  align="right" class="govde">Teklif Toplama Y&ouml;ntemi :</td>
                <td  class="govde"><? echo  $row['iletisim']?></td>
              </TR>
              <TR>
                <td  align="right" class="govde">Deadline for RFP : </td>
                <td   class="govde"><? $range=$row['tarih'];
$zaman1=explode("-",$range);
if ($zaman1[1] == 1) { $zaman1[1] = "January"; }
	if ($zaman1[1] == 2) { $zaman1[1] = "February"; }
    if ($zaman1[1] == 3) { $zaman1[1] = "March"; }
    if ($zaman1[1] == 4) { $zaman1[1] = "April"; }
    if ($zaman1[1] == 5) { $zaman1[1] = "May"; }
    if ($zaman1[1] == 6) { $zaman1[1] = "June"; }
    if ($zaman1[1] == 7) { $zaman1[1] = "July"; }
    if ($zaman1[1] == 8) { $zaman1[1] = "August"; }
    if ($zaman1[1] == 9) { $zaman1[1] = "September"; }
    if ($zaman1[1] == 10) { $zaman1[1] = "October"; }
    if ($zaman1[1] == 11) { $zaman1[1] = "November"; }
    if ($zaman1[1] == 12) { $zaman1[1] = "December"; }
	
echo $zaman1[2]."-".$zaman1[1]."-".$zaman1[0];?></td>
              </TR>
              <TR>
                <td  align="right" class="govde">Delivery period:</td>
                <td  class="govde" ><? echo $row['sure']?></td>
              </TR>
              <TR>
                <td align="right"  valign="top" class="govde">Description of goods or services requested :</td>
                <td width="60%" class="govde"><?
	function isBlank ($string) { 
        if ($string == " ") return true; 
        for ($i = 0; $i < strlen($string); $i++) { 
                $c = substr($string, $i, 1); 
                if (($c != "\r") && ($c != " ") && ($c != "\n")&& ($c != "\t")) { 
                        return false; 
                } 
        } 
        return true; 
} 
function wrap_text($text, $wrap) { 
       if (isBlank($text)) return; 
        if (!is_integer($wrap)) return $text; 
        $text_array = explode("\n", $text); 
        $i = $j = 0; 
        while ($i < sizeof($text_array)) { 
                $text_array[$i] = preg_replace("/\s/", " ", $text_array[$i]); 
                $length = strlen($text_array[$i]); 
                if ($length <= $wrap) { 
                        $new_text_array[$j] = $text_array[$i]; 
                        $i++; 
                } 
                else { 
                        $tmp = substr($text_array[$i], 0, $wrap); 
                        $spacePos = strrpos($tmp, " "); 
                        if ($spacePos > 0) { 
                                $new_text_array[$j] = substr($text_array[$i], 0, $spacePos+1); 
                                $new_text_array[$j] = ltrim($new_text_array[$j]); 
                                $text_array[$i] = substr($text_array[$i], $spacePos+1); 
                        } 
                        else { 
                                $new_text_array[$j] = $tmp; 
                                $text_array[$i] = substr($text_array[$i], $wrap); 
                        } 
                } 
                $j++; 
        } 
        return (implode("\n", $new_text_array)); 
} 
$string=$row['text']; 
$metin1=str_replace("<script","",$string);
$metin1=str_replace("<style","",$string);
$metin1=str_replace("<embed","",$string);
$metin=nl2br($metin1);
print (wrap_text($metin,72));
?></td>
              </TR>
              <TR>
                <td  align="right" class="govde">Destination country : </td>
                <td class="govde"><? 
$ulkex=$row['ulke'];
$strq="SELECT ulke FROM country where iso3='$ulkex'";
$resultq=mysqli_query($connection,$strq);
while ($rowq = mysqli_fetch_array($resultq)){
 $ulke= $rowq['ulke'];
 echo $ulke;}
}?></td>
              </TR>
              <TR style="<?php if($ulke !=="Turkey") echo "display:none"; ?>"; >
                <td  align="right" class="govde">City of delivery : </td>
                <td class="govde"><? 
$verified_sehirid = isset($_SESSION["verified_sehirid"]) ? $_SESSION["verified_sehirid"] : '';
$strq="SELECT sehir FROM  sehir where sehirid='$verified_sehirid'";
$resultq=mysqli_query($connection,$strq);
while ($rowq = mysqli_fetch_array($resultq)){
 echo $rowq['sehir'];}?></td>
              </TR>
              <tr>
                <td  colspan="2" align="right" class="govde">&nbsp;</td>
              </tr>
              <TR>
                <td  align="center" colspan="2"  valign="middle" ><a href="giris-e.php" class="buttonPage"> Cancel &nbsp;<i class="icon-close" ></i></a><img src= "../image/trans.gif" alt="" width="20" height="1"><a href="#here" onClick="Degistir()" class="buttonPage"> Revise &nbsp;<i class="icon-arrow-left"></i></a><img src= "../image/trans.gif" alt="" width="20" height="1"><a href="#here" onClick="Gonder()" class="buttonPage"> Submit &nbsp;<i class="icon-arrow-right"></i></a></td>
              </tr>
            </form>
            <form action="kuldegis-e.php" method="post" name="frmDegistir" id="frmDegistir">
            </form>
          </TABLE></td>
      </tr>
      <tr>
        <td align="center" valign="middle" height="15px" ></td>
      </tr>
    </table>
  </div>
  <div id="bant1"></div>
  <div id="alt">
    <?php include "alt-e.php" ?>
  </div>
</div>
</BODY>
</HTML>
<script language="javascript">
function Gonder(){
	document.forms.LoginForm.submit();
}
function Degistir(){
	document.forms.frmDegistir.submit();
}
</script>