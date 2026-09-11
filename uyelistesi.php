<? include "headeryon.php"; ?>
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
  <div>
    <form name="Kullanici" method="post" action="">
      <span class="title_kucuk"><strong>Sayın</strong>
      <? $verified_user = $_SESSION["verified_user"]; echo $verified_user;?>
      ,</span>
      <input  type="hidden" name="liste" value="">
      <input  type="hidden" name="secililiste" value="">
      <table width="731px" align="center" border="0" >
        <tr>
          <td colspan="5" ><table width="95%"  border="0" align="center" cellpadding="2" cellspacing="0"  bordercolor="#F6F6F6"  bgcolor="#EAEAEA">
              <tr>
                <td width="330" align="right" class="govde">Firma veya Kullanıcı Adı : </td>
                <td width="336" class="govde"><span class="aciklama">
                  <INPUT  maxLength=80 id="Firma_Adi" name="Firma_Adi" size="25" style="border: 1 solid #666666" value="<? if (isset($Firma_Adi)) print $Firma_Adi; ?>">
                  </span></td>
              </tr>
              <tr>
                <td width="330" align="right" class="govde">E-Posta : </td>
                <td class="govde"><span class="aciklama"><FONT color=#990000><span style="font-weight: bold"><font color=#990000><font color=#004040 
      style="BACKGROUND-COLOR: #eeeecc; FONT-SIZE: 10px"><span style="font-weight: bold">
                  <input  maxlength=50 name="email" size=25 style="border: 1 solid #666666" value= "<? if (isset($email)) print $email; ?>">
                  </span></font></font></span></FONT></span></td>
              </tr>
              <tr>
                <td width="330" align="right" class="govde">Şehir : </td>
                <td class="govde"><span class="aciklama">
                  <?
$str="select * from sehir where sehirid<999 order by sehirid";
$result=mysqli_query($coni,$str);
?>
                  <select name="Sehir"    >
                    <option  value ="-1" selected="selected">.Tümü.</option>
                    <? while ($row = mysqli_fetch_array($result))
                     { ?>
                    <option <? if (isset($_POST["Sehir"])) if ($_POST["Sehir"] == $row['sehir']) print "selected "?>>
                    <?  echo $row['sehir']; ?>
                    </option>
                    <br>
                    <? }?>
                  </select>
                  Üyelik Seviyesi:
                  <select name="prolevel">
                    <option  value ="-1" selected="selected">.Tümü.</option>
                    <?php 
				  for($i=0;$i<=2;$i++) {
				  	$plevel=isset($_POST["prolevel"]) ? $_POST["prolevel"] : '';
					if($i==$plevel && !empty($plevel))
						$selected='selected="selected"';
				  	else
						$selected='';
					echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';
				  }
				  ?>
                  </select>
                  </span></td>
              </tr>
              <tr>
              <tr>
                <td colspan="2" align="center" class="govde"><input type="checkbox" name="cbAktif" value="aktif" <? if (isset($_POST["cbAktif"])) print "checked" ?> >
                  Aktif </td>
              </tr>
              <tr>
                <td height="30" colspan="2" align="center"><img src="image/bul.gif" width="147" height="16" onClick="javascript:Kullanici.submit();" class="ResimDugme"><img src= "image/trans.gif" alt="" width="25px" height="1"><img src="image/yonetici.gif" width="146" height="16" class="ResimDugme" onClick="Ilerle()" ></strong></span></td>
              </tr>
            </table></td>
        </tr>
        <tr align="left" valign="middle">
          <td colspan="5" ><table width="100%" border="0" cellpadding="0" cellspacing="1" >
              <tr align="left" valign="middle">
                <td width="20" rowspan="2" align="right" bgcolor="#77A20D">&nbsp;</td>
                <td width="150" align="center" class="govde" bgcolor="#EAEAEA"><strong class="govde">Firma Adı </strong></td>
                <td width="200" align="center" class="govde" bgcolor="#F6F6F6"><strong>E-Posta</strong></td>
                <td width="200" align="center" class="govde" bgcolor="#EAEAEA"><strong>Yetkili</strong></td>
                <td width="75" align="center" bgcolor="#F6F6F6" class="govde"><strong>Şehir</strong></td>
              </tr>
            </table></td>
        </tr>
        <tr align="left" valign="top">
          <td colspan="5" bgcolor="#FFFFFF"><div id="ListePosta" style="overflow:auto; left:331px; top:70px; width:100%; height : 300px;  z-index:1">
              <table align="center" width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#999999">
                <? 
				/*
			$Cumle	= " SELECT DISTINCT b.firmaid, Firma_Adi, Adres, Posta_Kodu, Sehir, tel_alankodi, Telefon, fax_alankodi, Fax, Web, email, yetkili, iletisim, lisan, tekliftopla, s.sektorgrupid, g.sektorgrup ".
							" FROM bilgi b, firma_sektor s, sektor_grup g ".
							" WHERE b.firmaid = s.firmaid AND s.sektorgrupid = g.sektorgrupid ";
							*/
			$Cumle	= " SELECT DISTINCT firmaid, Firma_Adi, Posta_Kodu, Sehir, email, yetkili ".
							" FROM bilgi ".
							" WHERE 1=1";
			if (isset($_POST["Firma_Adi"]))
			{
				$Firma_Adi = mysqli_real_escape_string($coni,$_POST["Firma_Adi"]);
				$email	= mysqli_real_escape_string($coni,$_POST["email"]);
				$Sehir	= mysqli_real_escape_string($coni,$_POST["Sehir"]);
				$prolevel=mysqli_real_escape_string($coni,$_POST["prolevel"]);
				$SektorGrup	= mysqli_real_escape_string($coni,isset($_POST["SektorGrup"]) ? $_POST["SektorGrup"] : '');
				if (isset($_POST["cbAktif"]))
					$cbAktif	= $_POST["cbAktif"];
				if ($Firma_Adi  != "") 
					$Cumle	.=  " and Firma_Adi like '%" . $Firma_Adi . "%'";
				if ($email  != "") 
					$Cumle	.=  " and email like '%" . $email . "%'";
				if ($Sehir  != "-1") 
					$Cumle	.=  " and Sehir ='" . $Sehir . "'";
				if  (isset($cbAktif))
					$Cumle .= " and aktivite =1 ";
				else
					$Cumle .= " and aktivite =0 ";
				if ($prolevel  != "-1")
					$Cumle.= " and proflag=$prolevel";
				
			$result1=mysqli_query($coni,$Cumle); 
			while($row = mysqli_fetch_array($result1)) {
?>
                <tr align="left" valign="middle"> 
                  <script language="JavaScript">
				document.forms.Kullanici.liste.value	+= <? echo $row["firmaid"]; ?> + ",";			
			</script>
                  <td width="20" align="right" bgcolor="#77A20D"><input name="Kutu<?php echo $row["firmaid"]; ?>" type="checkbox" class="title"  ></td>
                  <td width="150" bgcolor="#EAEAEA" class="govde" ><? echo $row["Firma_Adi"]; ?></td>
                  <td width="200" bgcolor="#F6F6F6" class="govde" ><? echo $row["email"]; ?></td>
                  <td width="200" bgcolor="#EAEAEA" class="govde" ><? echo $row["yetkili"]; ?></td>
                  <td width="75" bgcolor="#F6F6F6" class="govde" ><? echo $row["Sehir"]; ?></td>
                </tr>
                <? } }
			?>
              </table>
            </div></td>
        </tr>
        <tr align="left" valign="top">
          <td width="19%" valign="middle" >
            <input name="cbsec" type="checkbox" onClick="sec(this.checked)">
            <strong class="govde">Tümünü Seç</strong></td>
          <td width="33%" valign="middle" ><span class="govde">Seçtiklerime :</span> <strong>{ <a href="" class="link" id="posta" onClick="this.href =	 mailliste()"> e-posta gönder</a> }</strong></td>
          <td width="17%" valign="middle" ><strong>
            <?php if (isset($cbAktif)) { if ($prolevel==2) { ?>
            { <a href="#" class="link" id="normal" onClick="normalYap()"> Normal Yap</a> }
            <?php } else {?>
            { <a href="#" class="link" id="pro" onClick="proYap()"> Pro Yap</a> }
            <?php } }?>
            </strong></td>
          <td width="17%" valign="middle" ><strong>{ <a href="#" class="link" id="posta" onClick="Aktivite()">
            <? if (isset($cbAktif)) print "Pasif Yap"; else print "Aktif Yap"; ?>
            </a> }</strong></td>
          <td width="25%" valign="middle" ><strong> <a href="#" class="link" id="posta" onClick="TamamenSil()">
            <? if (!isset($cbAktif)) print "{Tamamen Sil}"; else print ""; ?>
            </a> </strong></td>
        </tr>
      </table>
    </form>
  </div>
  <div id="bant1"></div>
  <!-- bant2 -->
  
</div>
</body>
</html>
<script language="JavaScript">
function Aktivite()
{
		var IDListe	= document.forms.Kullanici.liste.value;
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
		document.forms.Kullanici.secililiste.value = "( " + liste + " ) ";
		document.forms.Kullanici.action	= "uyeaktiflik.php";
		document.forms.Kullanici.submit();
	}

function proYap()
{
		var IDListe	= document.forms.Kullanici.liste.value;
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
		document.forms.Kullanici.secililiste.value = "( " + liste + " ) ";
		document.forms.Kullanici.action	= "uyeproyap.php";
		document.forms.Kullanici.submit();
	}

function normalYap()
{
		var IDListe	= document.forms.Kullanici.liste.value;
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
		document.forms.Kullanici.secililiste.value = "( " + liste + " ) ";
		document.forms.Kullanici.action	= "uyenormalyap.php";
		document.forms.Kullanici.submit();
	}

function TamamenSil()
{
		var IDListe	= document.forms.Kullanici.liste.value;
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
		document.forms.Kullanici.secililiste.value = "( " + liste + " ) ";
		document.forms.Kullanici.action	= "uyetamamensil.php";
		document.forms.Kullanici.submit();
	}

	function mailliste()
	{
		var IDListe	= document.forms.Kullanici.liste.value;
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
		var IDListe	= document.forms.Kullanici.liste.value;
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