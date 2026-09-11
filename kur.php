 <link href="css/style.css" rel="stylesheet" type="text/css">
<?php
//$adres = simplexml_load_file('http://www.tcmb.gov.tr/kurlar/today.xml');
if (!$adres = new SimpleXMLElement("http://www.tcmb.gov.tr/kurlar/today.xml",null,true)) 
{
?>
<table width="150" border="0" align="center" cellpadding="1" cellspacing="1"  bordercolor="#FFFFFF"> 
<tr>
    <td colspan="3" height="60" align="center" valign="middle"><img src="/image/turkiye2.gif" width="132" height="50" align="middle"></td>
</tr>
<tr>
<td colspan="3" align="center" class="title_kucuk"><p><strong>TCMB Kurları</strong></p>    </td>
</tr> 
<tr>
<td width="35" align="left" ></td>
<td width="52" align="right" class="govde" > Alış</td>
<td width="53" align="right" class="govde" > Satış</td>
</tr>
<tr class="govde">
<td colspan="3" align="right" style="font-size: x-small" ><?php echo '"Bağlantı yok"';?></td>
<td align="right" style="font-size: x-small" ><? echo ' '; ?></td>
<td align="right" style="font-size: x-small" ><? echo ' '; ?></td>
</tr> 
<tr class="govde">
<td align="right" style="font-size: x-small" ><?php echo ' '; ?></td>
<td align="right" style="font-size: x-small" ><? echo ' '; ?></td>
<td align="right" style="font-size: x-small" ><? echo ' ';  ?></td>
</tr>
</table> 
<?php
}
else {
$adres = new SimpleXMLElement("http://www.tcmb.gov.tr/kurlar/today.xml",null,true);
?>
<table width="150" border="0" align="center" cellpadding="1" cellspacing="1"  bordercolor="#FFFFFF"> 
<tr>
    <td colspan="3" height="60" align="center" valign="middle"><img src="/image/turkiye2.gif" width="132" height="50" align="middle"></td>
</tr>
<tr>
<td colspan="3" align="center" class="title_kucuk"><p><strong>TCMB Kurları</strong></p>    </td>
</tr> 
<tr>
<td width="35" align="left" ></td>
<td width="52" align="right" class="govde" > Alış</td>
<td width="53" align="right" class="govde" > Satış</td>
</tr>
<tr class="govde">
<td align="right" style="font-size: x-small" ><?php echo $adres->Currency[0]['Kod'];?></td>
<td align="right" style="font-size: x-small" ><? echo $adres->Currency[0]->ForexBuying; ?></td>
<td align="right" style="font-size: x-small" ><? echo $adres->Currency[0]->ForexSelling; ?></td>
</tr> 
<tr class="govde">
<td align="right" style="font-size: x-small" ><?php echo $adres->Currency[3]['Kod'];?></td>
<td align="right" style="font-size: x-small" ><? echo $adres->Currency[3]->ForexBuying; ?></td>
<td align="right" style="font-size: x-small" ><? echo $adres->Currency[3]->ForexSelling; ?></td>
</tr>
</table> 
<?php
}
