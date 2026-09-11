<?php include "headeryon.php";?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="content-language" content="tr" />
<title>tekliftopla reklam</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="calendarDateInput.js">
/***********************************************
* Jason's Date Input Calendar- By Jason Moon http://calendar.moonscript.com/dateinput.cfm
* Script featured on and available at http://www.dynamicdrive.com
* Keep this notice intact for use.
***********************************************/
</script>
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

<table width="540px" align="center" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td colspan="4" height="2" bgcolor="#FFFFFF"></td>
            </tr>
            <tr  >
              <td background="image/yeni_orta.gif" height="50" width="191" ><img src="image/5/5_1%20copy.gif" width="176" height="64"></td>
			  <td background="image/yeni_orta.gif" width="183" align="center" class="Baslik" valign="bottom">Reklam Bilgileri </td>
			  <td background="image/yeni_orta.gif" width="154" valign="middle" align="right" class="Buyuk_Yazi"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td align="right">Yeni Reklam</td>
                </tr>
                <tr>
                  <td> </td>
                </tr>
              </table>			    </td>
              <td background="image/yeni_orta.gif" width="27" ><img src="image/sag_ok.gif" width="27" height="64"></td>
            </tr>
        </table></td>
      </tr>
      <tr>
        <td bgcolor="#F6F6F6">
		<FORM id="frm" name="frm" method="post" action="rekekle.php?asama=reklambilgi" enctype="multipart/form-data">
        <input type="hidden" id="yazi" name="yazi" >
        <span class="not">* Girilmesi zorunlu bilgiler</span>
        <TABLE width="95%"  border="0" align="center" cellpadding="2" cellspacing="0"  bordercolor="#F6F6F6"  bgcolor="#EAEAEA">
            <TR>
              <td  class="govde" align="right">Reklam tipi:</td>
              <td align="left" class="aciklama"><?
				$str="select * from rektip order by tipid";
				$result=mysqli_query($coni,$str);
?>
                  <select name="rektip" style="width:250px" id="rektip" >
                    <? while ($row = mysqli_fetch_array($result))
                     {
					 $tipid=$row['tipid'];
					 echo "<option value=$tipid>";
					 echo $row['tipadi'];
					 echo "</option>";
                     echo"<br>";}
					 ?>
                  </select>              </td>
            </TR>
            <TR>
              <td class="govde" align="right">Kısa tanım:</td>
              <td class="aciklama"><INPUT name="izah" style="border: 1 solid #666666"   value="" size=25  maxLength=50></td>
            </TR>
            <TR>
              <td width="251" align="right" class="govde" id="rbas">Reklam başlama tarihi:</td>
              <td width="254" class="aciklama"><script>DateInput('bastarih', true, 'YYYY-MM-DD')</script><input type="button" onClick="alert(this.form.bastarih.value)" value="Gönderilen tarih değerini göster">
            </TR>
            <TR>
              <td class="govde" align="right" i><label id="rson">Reklam bitiş tarihi:</label></td>
              <td class="aciklama"><script>DateInput('sontarih', true, 'YYYY-MM-DD', '<?php echo date("Y-m-d",time()+183*24*60*60); ?>')</script> 
                </TR>
            <TR>
              <td class="govde" align="right" id="rgrafik">Reklam grafiği:</td>
              <td class="aciklama"><input type="hidden" name="MAX_FILE_SIZE" value="150000" /><INPUT type="file" name="grafik" style="border: 1 solid #666666" size=25 ></td>
            </TR>
            <TR>
              <td class="govde" align="right" id="rlink">Link:</td>
              <td class="aciklama"><INPUT type="text" name="link" style="border: 1 solid #666666" size=25   maxLength=100 value="http://"></td>
            </TR>
            <TR>
              <td class="govde" align="right">Mesaj sayısı:</td>
              <td class="aciklama"><INPUT type="number" name="adet" style="border: 1 solid #666666" size=5 maxLength=5 value="0"></td>
            </TR>
            <TR>
              <td colspan="2" align="center" bgcolor="#F6F6F6" height="50" valign="middle"> <img src="image/iptalet.gif" width="146" height="16" class="ResimDugme" onClick="javascript:window.location ='yonetimgiris.php'" ><img src= "image/trans.gif" alt="" width="25px" height="1"><img src="image/ilerle.gif" width="146" height="16" onClick="Gonder()" class="ResimDugme"></strong></strong></td>
            </TR>
        </table>
		</form>		</td>
      </tr>
    </table>
 </div>
  <div id="bant1"></div> <!-- bant2 -->
  
</div>

</bodY>
</HTML>
<script language="javascript">
function Gonder(){
	if (Validate())
		document.forms.frm.submit();
}

function Iptal(){
	window.location = "yonetimgiris.php";
}
function Validate() { 
if (document.forms.frm.izah.value =="") 
{ alert ( " Reklam tanımını girmediniz." );
	return (false); 
} 
if (document.forms.frm.grafik.value =="") 
{ alert ( "Reklam grafiğini girmediniz." );
	return (false); 
} 
 return true;
}

</script>