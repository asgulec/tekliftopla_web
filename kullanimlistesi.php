<?php include "headeryon.php"; ?>
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
  <div >

     <form name="Kullanim" method="post" action="">
      <span class="title_kucuk"><strong>Sayın</strong> <? $verified_user = $_SESSION["verified_user"]; echo $verified_user;?>,</span>
      <input  type="hidden" name="liste" value="">
      <input  type="hidden" name="secililiste" value="">
      <table width="731px" align="center" border="0" >
        <tr>
          <td colspan="5" ><table width="95%"  border="0" align="center" cellpadding="2" cellspacing="0"  bordercolor="#F6F6F6"  bgcolor="#EAEAEA">
              <tr>
                <td width="330" align="right" class="govde">Firma Adı : </td>
                <td width="336" class="govde"><span class="aciklama">
                  <INPUT  maxLength=80 id="Firma_Adi" name="Firma_Adi" size="25" style="border: 1 solid #666666" value="<? if (isset($Firma_Adi)) print $Firma_Adi; ?>">
                </span></td>
              </tr>
              <tr>
                <td width="330" align="right" class="govde">Teklif Metni : </td>
                <td width="336" class="govde"><span class="aciklama">
                  <input  maxlength=100 name="metin" size=25 style="border: 1 solid #666666" value= "<? if (isset($metin)) print $metin; ?>">
                </span></font></font></span></FONT></span></td>
              </tr>
              <tr>
                <td width="330" align="right" class="govde">Teslim Şehir : </td>
                <td class="govde"><span class="aciklama">
                  <?
$str="select * from sehir where sehirid<999 order by sehirid";
$result=mysqli_query($coni,$str);
?>
                  <select name="Sehir"    >
                    <option  value ="-1" selected>.. Tümü ..</option>
                    <? while ($row = mysqli_fetch_array($result))
                     { ?>
                    <option <? if (isset($_POST["Sehir"])) if ($_POST["Sehir"] == $row['sehir']) print "selected "?>>
                    <?  echo $row['sehir']; ?>
                    </option>
                    <br>
                    <? }?>
                  </select>
                </span></td>
              </tr>
              <tr>
              <tr>
                <td colspan="2" align="center" class="govde"><input type="checkbox" name="cbreadable" value="readable" <? if (isset($_POST["cbreadable"])) print "checked" ?> > 
                  Okunabilir/Görünebilir </td>
                </tr>
              <tr>
                <td height="30" colspan="2" align="center"><img src="image/bul.gif" width="147" height="16" onClick="javascript:Kullanim.submit();" class="ResimDugme"><img src= "image/trans.gif" alt="" width="25px" height="1"><img src="image/yonetici.gif" width="146" height="16" class="ResimDugme" onClick="Ilerle()" ></td></tr>
          </table></td>
        </tr>
        <tr align="left" valign="middle">
          <td colspan="5" ><table width="100%" border="0" cellpadding="0" cellspacing="1" >
              <tr align="left" valign="middle">
                <td width="24" rowspan="2" align="right" bgcolor="#77A20D">&nbsp;</td>
                <td width="77" aling="left" class="govde" bgcolor="#F6F6F6"><strong class="govde">Kullanım</strong></td>
                <td width="384" align="center" class="govde" bgcolor="#F6F6F6"><strong>Metin</strong></td>
                <td width="108" align="left" class="govde" bgcolor="#F6F6F6"><strong>Firma</strong></td>
                <td width="75" align="left" bgcolor="#F6F6F6" class="govde"><strong>Şehir</strong></td>
			</tr>
          </table></td>
        </tr>
        <tr align="left" valign="top">
          <td colspan="5" bgcolor="#FFFFFF">
            <div id="ListePosta" style="overflow:auto; left:331px; top:70px; width:100%; height : 300px;  z-index:1">
              <table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#999999">
                <? 
				/*
			$Cumle	= " SELECT DISTINCT b.firmaid, Firma_Adi, Adres, Posta_Kodu, Sehir, tel_alankodi, Telefon, fax_alankodi, Fax, Web, email, yetkili, iletisim, lisan, tekliftopla, s.sektorgrupid, g.sektorgrup ".
							" FROM bilgi b, firma_sektor s, sektor_grup g ".
							" WHERE b.firmaid = s.firmaid AND s.sektorgrupid = g.sektorgrupid ";
							*/
			$Cumle	= " SELECT DISTINCT a.Kullanimid, a.text, a.Firma, b.sehir ".
							" FROM kullanim as a, sehir as b".
							" WHERE a.sehirid=b.sehirid and a.tamam=1";
			if (isset($_POST["Firma_Adi"]))
			{
				$Firma_Adi = mysqli_real_escape_string($coni,$_POST["Firma_Adi"]);
				$metin	= mysqli_real_escape_string($coni,$_POST["metin"]);
				$Sehir	= mysqli_real_escape_string($coni,$_POST["Sehir"]);
				if (isset($_POST["cbreadable"]))
					$cbreadable	= $_POST["cbreadable"];
				if ($Firma_Adi  != "") 
					$Cumle	.=  " and a.Firma like '%" . $Firma_Adi . "%'";
				if ($metin  != "") 
					$Cumle	.=  " and a.text like '%" . $metin . "%'";
				if ($Sehir  != "-1") 
					$Cumle	.=  " and b.sehir ='" . $Sehir . "'";
				if  (isset($cbreadable))
					$Cumle .= " and a.readable =1 ";
				else
					$Cumle .= " and a.readable =0 ";
				
			$result1=mysqli_query($coni,$Cumle); 
			while($row = mysqli_fetch_array($result1)) {
?>
                <tr align="left" valign="middle">
                  <script language="JavaScript">
				document.forms.Kullanim.liste.value	+= <? echo $row["Kullanimid"]; ?> + ",";			
			</script>
                  <td width="25" align="center" valign="middle" bgcolor="#77A20D">
                    <input name="Kutu<? echo $row["Kullanimid"]; ?>" type="checkbox" class="title" >                  </td>
                  <td width="77" bgcolor="#EAEAEA" class="govde" ><? echo $row["Kullanimid"]; ?></td>
                  <td width="384" bgcolor="#F6F6F6" class="govde" ><? echo $row["text"]; ?></td>
                  <td width="108" bgcolor="#EAEAEA" class="govde" ><? echo $row["Firma"]; ?></td>
                  <td width="74" bgcolor="#F6F6F6" class="govde" ><? echo $row["sehir"]; ?></td>
                </tr>
                <? } }
			?>
              </table>
              </div></td>
        </tr>
        <tr align="left" valign="top">
          <td width="19%" valign="middle" > &nbsp; &nbsp; &nbsp;
            <input name="cbsec" type="checkbox" onClick="sec(this.checked)">
              <strong class="govde">Tümünü Seç</strong></td>
          <td colspan="3" width="33%" valign="middle" ><span class="govde">Seçtiklerimi : </span><strong>{ <a href="#" class="link" id="posta" onClick="Aktivite()"><? if (isset($cbreadable)) print "Okunamaz Yap"; else print "Okunur Yap"; ?></a> }</strong> </td>
          <td width="17%" valign="middle" ></td>
         </tr>
      </table>
    </form>
</div>
  <div id="bant1"></div> <!-- bant2 -->
  
</div>

</body>
</html>
<script language="JavaScript">

function Aktivite()
{
		var IDListe	= document.forms.Kullanim.liste.value;
		var don = true;
		var indis;
		var ID;
		var liste ="0";
		while (don)
		{
			indis = IDListe.indexOf(",")
			if (indis == -1)
			 don = false;
			else
			{
				ID	= IDListe.substring(0,indis);
				if (findObj("Kutu"+ID).checked)
					liste += "," + ID;
				IDListe	= IDListe.substring(indis+1);
			}			 
		}
		document.forms.Kullanim.secililiste.value = "( " + liste + " ) ";
		document.forms.Kullanim.action	= "okunabilirlik.php";
		document.forms.Kullanim.submit();
	}

function TamamenSil()
{
		var IDListe	= document.forms.Kullanim.liste.value;
		var don = true;
		var indis;
		var ID;
		var liste ="0";
		while (don)
		{
			indis = IDListe.indexOf(",")
			if (indis == -1)
			 don = false;
			else
			{
				ID	= IDListe.substring(0,indis);
				if (findObj("Kutu"+ID).checked)
					liste += "," + ID;
				IDListe	= IDListe.substring(indis+1);
			}			 
		}
		document.forms.Kullanim.secililiste.value = "( " + liste + " ) ";
		document.forms.Kullanim.action	= "bllluyetamamensil.php";
		document.forms.Kullanim.submit();
	}

	function mailliste()
	{
		var IDListe	= document.forms.Kullanim.liste.value;
		var don = true;
		var indis;
		var ID;
		var mailliste ="mailto:";
//		findObj("posta").href	= "mailto:";
		while (don)
		{
			indis = IDListe.indexOf(",")
			if (indis == -1)
			 don = false;
			else
			{
				ID	= IDListe.substring(0,indis);
				if (findObj("Kutu"+ID).checked)
					mailliste += findObj("ePosta"+ID).innerHTML + ";";
//					findObj("posta").href += findObj("ePosta"+ID).innerHTML + ";";
				IDListe	= IDListe.substring(indis+1);
			}			 
		}
		showHideLayers("posta","","show",0);
		return mailliste;
	}
	function sec(val)
	{
		var IDListe	= document.forms.Kullanim.liste.value;
		var don = true;
		var indis;
		var ID;
		while (don)
		{
			indis = IDListe.indexOf(",")
			if (indis == -1)
			 don = false;
			else
			{
				ID	= IDListe.substring(0,indis);
				findObj("Kutu"+ID).checked = val;
				IDListe	= IDListe.substring(indis+1);
			}			 
		}
	}
	
	
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
function Ilerle()
{
window.location ="yonetimgiris.php";
}
</script>