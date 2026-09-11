<?php include"headeryon.php"?>
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

<table width="540px" align="center"  cellspacing="0" cellpadding="0" border="0" bgColor=white >
      <tr>
        <td>
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td colspan="4" height="2" bgcolor="#FFFFFF"></td>
            </tr>
            <tr >
              <td background="image/yeni_orta.gif" height="50" width="191" ><img src="image/5/5_5.gif" width="176" height="64"></td>
              <td background="image/yeni_orta.gif" width="183" align="center" class="Baslik" valign="bottom">&nbsp;</td>
              <td background="image/yeni_orta.gif" width="154" valign="middle" align="right" class="Buyuk_Yazi"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td align="right" class="Baslik">Teklif gönder</td>
                </tr>
              </table>                </td>
              <td background="image/yeni_orta.gif" width="27" ><img src="image/sag_ok.gif" width="27" height="64"></td>
            </tr>
        </table></td>
      </tr>
      <tr>
        <td bgcolor="#F6F6F6">
          <?
$verified_kulid = $_SESSION["verified_kulid"];
$verified_sehirid = $_SESSION["verified_sehirid"];
/* $str11="INSERT INTO gecici4 (firmaid,kullanimid) SELECT distinct firma_sektor.firmaid,gecici3.kullanimid FROM gecici3, firma_sektor where gecici3.sektorid=firma_sektor.sektorid and gecici3.kullanimid='$verified_kulid'";
$result11=mysql_db_query($db,"$str11");
$strp21="INSERT INTO gecici5 (firmaid,kullanimid) SELECT distinct firma_sehir.firmaid,kullanim.Kullanimid FROM firma_sehir,kullanim where firma_sehir.sehirid='$verified_sehirid' and  firma_sehir.sehirid=kullanim.sehirid and kullanim.Kullanimid='$verified_kulid'";
$resultp21=mysql_db_query($db,"$strp21");
$str111="insert into gecici6 (firmaid,kullanimid) SELECT distinct gecici4.firmaid,gecici4.kullanimid FROM gecici4,gecici5 where gecici4.firmaid=gecici5.firmaid and  gecici4.kullanimid=gecici5.kullanimid and gecici4.kullanimid='$verified_kulid'";
 */

// Çağlar yaptın kolaymış satır 56 
$stryx="SELECT * FROM  kullanim where Kullanimid='$verified_kulid'";
$resultyx=mysqli_query($coni,$stryx);
while ($rowyx = mysqli_fetch_array($resultyx)){
$ulkek=$rowyx['ulke'];
$dilk=$rowyx['dil'];
}
/*$str111="insert into gecici6 (firmaid,kullanimid) SELECT distinct firma_sektor.firmaid, gecici3.kullanimid FROM gecici3, firma_sektor, firma_sehir, kullanim
where gecici3.sektorid=firma_sektor.sektorid 
and gecici3.kullanimid='$verified_kulid'
and  ( firma_sehir.sehirid=kullanim.sehirid or firma_sehir.sehirid=999)
and kullanim.Kullanimid='$verified_kulid'
and firma_sehir.firmaid=firma_sektor.firmaid"; */

if($ulkek=="TUR"){
$str111="insert into gecici6 (firmaid,kullanimid) SELECT distinct firma_sektor.firmaid, gecici3.kullanimid FROM gecici3, firma_sektor, firma_sehir, kullanim
where gecici3.sektorid=firma_sektor.sektorid 
and gecici3.kullanimid='$verified_kulid'
and  (firma_sehir.sehirid=kullanim.sehirid or firma_sehir.sehirid=999)
and kullanim.Kullanimid='$verified_kulid'
and firma_sehir.firmaid=firma_sektor.firmaid"; }
else {
$str111="insert into gecici6 (firmaid,kullanimid) SELECT distinct firma_sektor.firmaid, gecici3.kullanimid FROM gecici3, firma_sektor, kullanim, bilgi 
where gecici3.sektorid=firma_sektor.sektorid  
and gecici3.kullanimid='$verified_kulid' 
and kullanim.Kullanimid='$verified_kulid' 
and firma_sektor.firmaid=bilgi.firmaid 
and bilgi.lisan='Evet' "; }

$result111=mysqli_query($coni,$str111);
$son="select distinct bilgi.Firma_Adi,bilgi.firmaid,bilgi.email from gecici6,bilgi where gecici6.firmaid=bilgi.firmaid and bilgi.aktivite='1' and bilgi.tekliftopla='1' and gecici6.kullanimid='$verified_kulid' order by bilgi.Firma_Adi";
$sonuc=mysqli_query($coni,$son);
$sonuc1=mysqli_num_rows($sonuc);
?>
          <span class="title_kucuk">Kayıt numaranız  :<? echo $verified_kulid;?></span>
          <p><span class="title_kucuk"><? $verified_firma = $_SESSION["verified_firma"]; echo $verified_firma;?>
 teklif vermek isteyen <?echo $sonuc1;?>  tane firma bulunmuştur.</span>
          
          <table width="95%"  border="0" align="center" cellpadding="2" cellspacing="0"  bordercolor="#F6F6F6"  bgcolor="#EAEAEA">
          <form action="yonetimmailreklam.php" method="post" name="LoginForm">
              <? if($sonuc1){?>
                            <tr>
                              <td align="center" height="50" bgcolor="#F6F6F6" colspan="2"><img src="image/tumunu.gif" width="146" height="16" class="ResimDugme" onClick="TumuneGonder()"><img src= "image/trans.gif" alt="" width="20" height="1"><img src="image/secili.gif" width="146" height="16" class="ResimDugme" onClick="Gonder()"></td>
                            </TR>
              <tr>
                <td bgcolor="silver" class="govde"><input name="allbox" onClick="CheckAll();" type="checkbox" value="Check All">
              Tümünü Seç</td>
              </tr>
              <tr>
                <td width="400" align="left" class="govde">
                  <?
					while($satirs = mysqli_fetch_array($sonuc)){
					$dene33=$satirs['email']; ?>
                  <input type="checkbox"   name="tummail[]" value="<? echo $satirs['firmaid'] . '/' . $dene33; ?>">
                  <? echo $satirs['Firma_Adi']; ?> <br>
                  <? } ?>				  </td>
			    </tr>
<?				  }
else{?>
                <tr>
                    <td width="400" class="not" align="center">Bu sektörlere kayıtlı firma bulunmamaktadır
                        <?}?>
                    </td>
                </TR>
                            <tr>
                              <td align="center" height="50" bgcolor="#F6F6F6" colspan="2"><img src="image/tumunu.gif" width="146" height="16" class="ResimDugme" onClick="TumuneGonder()"><img src= "image/trans.gif" alt="" width="20" height="1"><img src="image/secili.gif" width="146" height="16" class="ResimDugme" onClick="Gonder()"></td>
                            </TR>
            </form>
        </TABLE></td>
      </tr>
    </table></div>
  <div id="bant1"></div> <!-- bant2 -->
  
</div>
</body>
</HTML>
<script language="javascript">
function Gonder(){

	document.forms.LoginForm.submit();
}
function TumuneGonder(){
 for (var i=0;i<document.forms.LoginForm.elements.length;i++)
 {
  var e=document.forms.LoginForm.elements[i];
  if (e.name != 'allbox')
   e.checked=true;
 }
Gonder();
}

function CheckAll()
{
 for (var i=0;i<document.forms.LoginForm.elements.length;i++)
 {
  var e=document.forms.LoginForm.elements[i];
  if (e.name != 'allbox')
   e.checked=document.forms.LoginForm.allbox.checked;
 }
 
}
// Example: showHideLayers(Layer1,'','show',Layer2,'','hide');
function showHideLayers()
{ 
  var i, visStr, obj, args = showHideLayers.arguments;
  for (i=0; i<(args.length-3); i+=4)
  {
    if ((obj = findObj(args[i])) != null)
    {
      visStr = args[i+2];
      if (obj.style)
      {
        obj = obj.style;
        if(visStr == 'show') visStr = 'visible';
        else if(visStr == 'hide') visStr = 'hidden';
      }
      obj.visibility = visStr;
	  obj.height	= args[i+3];
    }
  }
}
// Macromedia JavaScript Functions //

function findObj(theObj, theDoc)
{
  var p, i, foundObj;
  
  if(!theDoc) theDoc = document;
  if( (p = theObj.indexOf("?")) > 0 && parent.frames.length)
  {
    theDoc = parent.frames[theObj.substring(p+1)].document;
    theObj = theObj.substring(0,p);
  }
  if(!(foundObj = theDoc[theObj]) && theDoc.all) foundObj = theDoc.all[theObj];
  for (i=0; !foundObj && i < theDoc.forms.length; i++) 
    foundObj = theDoc.forms[i][theObj];
  for(i=0; !foundObj && theDoc.layers && i < theDoc.layers.length; i++) 
    foundObj = findObj(theObj,theDoc.layers[i].document);
  if(!foundObj && document.getElementById) foundObj = document.getElementById(theObj);
  
  return foundObj;
}

</script>