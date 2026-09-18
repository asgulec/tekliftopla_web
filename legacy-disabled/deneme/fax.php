<?
include"header.php"
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>TeklifTopla.com</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="200" border="0" align="center" cellpadding="0" cellspacing="0">
  <FORM action="bilgiguncelle.php" method=post name="frmBilgi" onsubmit="return Validate(this)">
		<input type="hidden" name="yazi" id="yazi" >
    <tr>
      <td><TABLE align=center   cellPadding=4 cellSpacing=4 width=330 border="0">
          <TR>
            <td colspan="2" align="center" ><img src="image/logo.gif" width="176" height="62" border="0" alt=""></td>
          </TR>
      </table></td>
    </tr>
    <tr>
      <td><table align=center   bgcolor="#F6F6F6"  cellPadding=4 cellSpacing=4 width=330 border="0">
          <TR>
            <td colspan="2" class="not"bgcolor="#F6F6F6" >Lütfen kayıtlı bilgilerinizde bulunmayan faks numaranızı tanımlayınız.</td>
          </TR>
          <TR bordercolor="#F6F6F6" bgcolor="#EAEAEA">
            <td class="govde" align="right" id="FKTelefon">Faks:</td>
            <td valign="top" class="aciklama"><strong>
              <?
$connection=mysql_connect("$host","$user","$password") or die ("Could not connect to the MySQL Server");
$query="SET NAMES 'UTF8'";
mysql_query($query);
$str1="select * from sehir order by sehir";
$result1=mysql_db_query("teklifto_teklif_topla","$str1");?>
              <select name="fax_alankodu"   >
                <? while ($row = mysql_fetch_array($result1))
                     {
					 echo "<option>";
					 echo $row['telkod'];
				                     echo"<br>";}?>
              </select>
              <INPUT maxLength=7 name="Fax" size=7  style="border: 1 solid #666666">
			  <input type="hidden" name="tur" value="f">
              <FONT color=#990000 class="title">*</FONT></strong></td>
          </TR>
          <TR>
            <td colspan="2" align="center" bgcolor="#F6F6F6"  >
              <img src="image/gonder.gif" width="147" height="16" class="ResimDugme" onClick="Gonder()"></td>
          </TR>
      </table></td>
    </tr>
  </FORM>
</table>
</body>
</html>
<script language="javascript">
function Gonder() {
	if (Kontrol())
		document.forms.frmBilgi.submit();
}  
function Kontrol() {
	if (document.forms.frmBilgi.Fax.value=="" ) 
{ 
 	document.getElementById("yazi").value = " Fax numaranızı giriniz. ";
	window.open('dikkat.html',"win1","width=400, height=200,menubar=0,resizable=0,scrollbars=0,status=0,titlebar=0,toolbar=0,left="+(screen.width-400)/2+",top="+(screen.height-200)/2);
 return (false); 
} 
return true;
}
</script>