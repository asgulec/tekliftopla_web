<? include"headeri.php";?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/style.css" rel="stylesheet" type="text/css">
<title>tekliftopla</title>
</head>
<body>
<div id="sayfa"> 
  <div id="ust"> <? include "ust.php"?> </div>
  <div id="bant1"></div>
  <div id="sol"><? include "sol.php";?></div>
  <div id="analong">
    <table width="540" align="center" cellspacing="0" cellpadding="0" border="0" bgColor=white >
      <tr>
        <td width="95%" valign="middle" >
		<? $verified_firma = $_SESSION["verified_firma"]; ?>	
          <table width="100%" border="0" align="center" cellpadding="1" cellspacing="1">
            <tr>
              <td><center class="Baslik">
                  <br><br>Kayıt Silme Doğrulaması
                </center>
                  <table width="100%" border="0" align="center">
                  <td align="center" bgcolor="#f6f6f6" class="title_kucuk"><br>
                  tekliftopla.com hizmetlerini  e-posta ve şifrenizle tekrar aktif hale getirebilirsiniz.<br><br></td>
                  </tr>
              <tr>
                <td height="50" align="center"><form action="cikis.php" method="post" name="frmGiris">
                    <a href="#here" onClick="javascript:frmGiris.submit();" class="buttonPage"> Çıkış &nbsp;<i class="icon-arrow-right"></i></a>                
                </form></td>
              </tr>
                </table></td>
            </tr>
          </table>      </tr>
    </table>
    
 </div> 
  <div id="bant1"></div> 
  <div id="alt">
  <? include "alt.php";?>
  </div>
</div>
</BODY></HTML>