<?php include "headeryon.php";?>
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
  
    <table align="center" width="540"  cellspacing="0" cellpadding="0" border="0" bgColor=white >
      <tr>
        <td valign="top" bgcolor="f6f6f6"><table width="540" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td colspan="4" height="2" bgcolor="#FFFFFF"></td>
            </tr>
            <tr>
              <td background="image/yeni_orta.gif" height="55" width="191" >&nbsp;</td>
              <td background="image/yeni_orta.gif" width="183" align="center" class="Baslik" valign="bottom">Onay Bekleyen Teklifler </td>
              <td background="image/yeni_orta.gif" width="154" valign="middle" align="right" class="Buyuk_Yazi">&nbsp;</td>
              <td background="image/yeni_orta.gif" width="27" ><img src="image/sag_ok.gif" width="27" height="64"></td>
            </tr>
          </table>
          <h4 class="title_kucuk">Sayın
            <?php echo htmlspecialchars($verified_user, ENT_QUOTES, 'UTF-8'); ?>
            ,</h4>
          <div style="min-height:250px">
          <table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" bgColor="f6f6f6">
            <tr>
              <td><center>
                </center>
                
                <table width="95%"  border="0" align="center" cellpadding="2" cellspacing="0"  bordercolor="#F6F6F6"  bgcolor="#EAEAEA">
                  <?php
                    $stryy = "SELECT b.Firma_Adi, k.date, k.time, k.Kullanimid, k.ulke
                              FROM kullanim AS k
                              INNER JOIN bilgi AS b ON k.firmaid = b.firmaid
                              WHERE k.tamam = '0' AND k.aktif = '1'
                              ORDER BY k.date DESC";
                    $resultyy = mysqli_query($coni, $stryy);
                    if ($resultyy === false) {
                        echo '<tr bgcolor="eaeaea"><td align="center"><br><span class="govde">Veri sorgusu hatası.</span><br><br></td></tr>';
                    } else {
                        $ok = mysqli_num_rows($resultyy);
                        $stryw = "SELECT Firma, date, time, Kullanimid, ulke
                                  FROM kullanim
                                  WHERE firmaid > '1000000' AND tamam = '0' AND aktif = '1'
                                  ORDER BY date DESC";
                        $resultw = mysqli_query($coni, $stryw);
                        if ($resultw === false) {
                            echo '<tr bgcolor="eaeaea"><td align="center"><br><span class="govde">İkinci veri sorgusu hatası.</span><br><br></td></tr>';
                        } else {
                            $yok = mysqli_num_rows($resultw);

                            if ($ok > 0 || $yok > 0) {
                                echo '<tr bgcolor="eaeaea">';
                                echo '<td width="41%" class="govde">Firma Adı </td>';
                                echo '<td width="29%" class="govde">Teklif Tarihi</td>';
                                echo '<td width="20%" class="govde">Teklif Saati</td>';
                                echo '<td width="10%" class="govde">Ülke</td>';
                                echo '</tr>';

                                while ($rowyy = mysqli_fetch_assoc($resultyy)) {
                                    $teklifidx = $rowyy['Kullanimid'];
                                    echo "<tr>
                                            <td class='link'><a href='tummaille222.php?teklifid={$teklifidx}'>{$rowyy['Firma_Adi']}</a></td>
                                            <td class='govde'>" . date('d-m-Y', strtotime($rowyy['date'])) . "</td>
                                            <td class='govde'>" . htmlspecialchars($rowyy['time'], ENT_QUOTES, 'UTF-8') . "</td>
                                            <td class='govde'>" . htmlspecialchars($rowyy['ulke'], ENT_QUOTES, 'UTF-8') . "</td>
                                          </tr>";
                                }

                                echo '<tr><td colspan="4" class="govde">-------------------------------</td></tr>';

                                while ($roww = mysqli_fetch_assoc($resultw)) {
                                    $teklifidx = $roww['Kullanimid'];
                                    echo "<tr>
                                            <td class='link'><a href='yontekgor.php?teklifid={$teklifidx}'>{$roww['Firma']}</a></td>
                                            <td class='govde'>" . date('d-m-Y', strtotime($roww['date'])) . "</td>
                                            <td class='govde'>" . htmlspecialchars($roww['time'], ENT_QUOTES, 'UTF-8') . "</td>
                                            <td class='govde'>" . htmlspecialchars($roww['ulke'], ENT_QUOTES, 'UTF-8') . "</td>
                                          </tr>";
                                }
                            } else {
                                echo '<tr bgcolor="eaeaea">';
                                echo '<td align="center"><br><span class="govde">Gönderilmeyen teklif bulunamadı</span><br><br></td>';
                                echo '</tr>';
                            }
                        }
                    }
                  ?>
                  <TR>
                    <td colspan="4" align="center" class="aciklama" bgcolor="#F6F6F6" height="50" valign="middle"><strong> &nbsp;&nbsp;&nbsp;<img src="image/yonetici.gif" width="146" height="16" class="ResimDugme"  onClick="ilerle();" > </strong></td>
                  </TR>
                </table></td>
            </tr>
          </table>
          </div>
      </tr>
    </table>
    
   </div>
  <div id="bant1"></div>
  
</div>
</BODY>
</HTML>
<script language="javascript">
 function ilerle()
 {
 window.location="yonetimgiris.php";
 }


</script>