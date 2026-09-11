<link href="../css/style.css" rel="stylesheet" type="text/css">
<?php
$adres = new SimpleXMLElement("http://www.tcmb.gov.tr/kurlar/today.xml",null,true);
?>
<table width="150" border="0" align="center" cellpadding="1" cellspacing="1"  bordercolor="#FFFFFF">
  <tr>
    <td colspan="3" width="132" height="70" align="center" valign="middle"><img src="/image/turkey-logo.gif" width="132" height="50" align="middle"></td>
  </tr>
  <tr>
    <td colspan="3" align="center" class="title_kucuk"><p><strong>C. Bank of Turkey<br>
        TL x-rates</strong></p></td>
  </tr>
  <tr>
    <td width="35" align="left" ></td>
    <td width="52" align="right" class="govde" > Buy</td>
    <td width="53" align="right" class="govde" > Sell</td>
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
