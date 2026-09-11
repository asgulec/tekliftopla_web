<?php include "headeri.php"; ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="content-language" content="tr" />
<title>tekliftopla</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="jquery/jquery-ui.theme.css">
<link rel="stylesheet" href="jquery/jquery-ui.css">
<script src="jquery/external/jquery/jquery.js"></script>
<script src="jquery/jquery-ui.min.js"></script>
<script src="jquery/jquery.ui.datepicker-tr.js"></script>
</head>
<body>
<!-- <script type="text/javascript" src="calendarDateInput.js">

/***********************************************
* Jason's Date Input Calendar- By Jason Moon http://calendar.moonscript.com/dateinput.cfm
* Script featured on and available at http://www.dynamicdrive.com
* Keep this notice intact for use.
***********************************************/

</script> -->
<SCRIPT LANGUAGE="JavaScript">
$(function() {
$( "#tektarih" ).datepicker({firstDay:"1",minDate: "+1", maxDate: "+3M +10D", dateFormat:"dd-mm-yy", autoSize:"true", numberOfMonths:1 });
$( "#tektarih" ).datepicker("setDate", '+5');
});
function change(select){
        if(select.name === "GunSay")
		{document.forms.frmKullanim.Sureler[0].checked=true;}
		else if(select.name === "HaftaSay")
		{document.forms.frmKullanim.Sureler[1].checked=true;}
		else if(select.name === "AySay")
		{document.forms.frmKullanim.Sureler[2].checked=true;}
		else if(select.name === "YilSay")
		{document.forms.frmKullanim.Sureler[3].checked=true;}
}
function Iptal(){
	window.location = "giris.php";
}
function Gonder(){
	if (Kontrol())
		document.forms.frmKullanim.submit();
}

function Kontrol() {
if (document.forms.frmKullanim.text.value=="" ) 
{ 
 	$(function(){
    $("#dialog-hata").text('Lütfen teklif toplamak istediğiniz mal veya hizmetin tarifini yapınız...');
	$("#dialog-hata" ).dialog({
		modal:true,
		position: {	my: "center",at: "center",of: sayfa},
		buttons:{Tamam: function () {
    $(this).dialog("close");
}}
	});	
  });

	return (false); 
} 
if (! TarihKontrol())
{
 	$(function(){
    $("#dialog-hata").text('En son teklif toplama tarihi bugünden önce olamaz...');
	$("#dialog-hata" ).dialog({
		modal:true,
		position: {	my: "center",at: "center",of: sayfa},
		buttons:{Tamam: function () {
    $(this).dialog("close");
}}
	});	
  });
	return (false);
}

if (document.forms.frmKullanim.Sureler[0].checked )
	document.forms.frmKullanim.sure.value = document.forms.frmKullanim.GunSay.value + " Gün";
if (document.forms.frmKullanim.Sureler[1].checked )
	document.forms.frmKullanim.sure.value = document.forms.frmKullanim.HaftaSay.value + " Hafta";
if (document.forms.frmKullanim.Sureler[2].checked )
	document.forms.frmKullanim.sure.value = document.forms.frmKullanim.AySay.value + " Ay";
if (document.forms.frmKullanim.Sureler[3].checked )
	document.forms.frmKullanim.sure.value = document.forms.frmKullanim.YilSay.value + " Yil";
return(true) 
} 
function textCounter(field, countfield, maxlimit) {
if (field.value.length > maxlimit) // if too long...trim it!
field.value = field.value.substring(0, maxlimit);
// otherwise, update 'characters left' counter
else 
countfield.value = maxlimit - field.value.length;
}

function TarihKontrol() {
var tarih = document.forms.frmKullanim.tektarih.value;
tarih = new Date(tarih.split("-").reverse().join("-")); 
if (tarih > new Date())
    { return true;
    }
    else {return false;
    }
}

// End -->
</script>
<?php 
$verified_sifre1="";
$verified_sehirid="";
$verified_kulid = "";
$_SESSION['verified_sehirid']=$verified_sehirid;
unset($_SESSION['verified_sehirid']);
$_SESSION['verified_sifre1']=$verified_sifre1;
unset($_SESSION['verified_sifre1']);
$_SESSION['verified_kulid']=$verified_kulid;
unset($_SESSION['verified_kulid']);
$iletisim = $sure_miktar = $sure_birim = $text = '' ;
?>
<div id="sayfa">
  <div id="ust">
    <?php include "ust.php" ?>
  </div>
  <div id="bant1"></div>
  <div id="sol">
    <?php include "menu.php" ?>
  </div>
  <div id="analong">
    <table width="97%" align="center"  cellspacing="0" cellpadding="0" border="0" bgColor=white >
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td colspan="4" height="2" bgcolor="#FFFFFF"></td>
            </tr>
            <tr height="25px">
              <td width="25%"><img src="image/5/2_1.gif"></td>
              <td width="25%" ></td>
              <td valign="middle" width="43%" align="right" class="title">Yeni Teklif Talebi</td>
              <td valign="bottom" align="right" width="7%" ><img src="image/sag_ok.gif"></td>
            </tr>
          </table></td>
      </tr>
      <tr><td height="10px"></td></tr>
      <tr>
        <td valign="top" bgcolor="#F6F6F6"><? $verified_firma = isset($_SESSION["verified_firma"])? $_SESSION["verified_firma"]: '';
		$verified_email = isset($_SESSION["verified_email"])? $_SESSION["verified_email"]:''; 
		?>
			<span class="Baslik" style="margin-left:10px">Sayın 
            <?
            echo $verified_firma;
			echo '&nbsp';
			$city = "SELECT Sehir from bilgi WHERE email = '$verified_email'";
			$cityx=mysqli_query($connection,$city);
			$resultx=mysqli_fetch_array($cityx);
			$cityver = $resultx['Sehir']; 
			?>, lütfen talebinizle ilgili aşağıdaki bilgileri giriniz. </span><br>
            <?php
			$tarih=date("Y-m-d",time()+5*24*60*60);
            if(isset($_GET["kul"])) {
				$verified_kulid=intval($_GET["kul"]);
			}	
			if($verified_kulid>0) {
				$r=mysqli_query($connection,"select tarih,sure,iletisim,text,sehirid,session from kullanim where Kullanimid=$verified_kulid and firmaid=".$_SESSION["verified_firmaid"]);
				$n=mysqli_num_rows($r);
				if($n>0) {
					$_SESSION['verified_kulid']=$verified_kulid;
					list($tarih,$sure,$iletisim,$text,$cityver,$verified_sifre1)=mysqli_fetch_array($r);
					//echo $tarih.$sure.$iletisim.$text.$cityver;
					$_SESSION['verified_sifre1']=$verified_sifre1;
					$sure=explode(" ",$sure);
					$sure_miktar=intval($sure[0]);
					$sure_birim=$sure[1];
				}
			}
            ?>
            <table bgcolor="#FFFFFF" width="100%" border="0" align="center" cellpadding="2" cellspacing="1" >
              <tr><td height="10px"></td></tr>
              <tr>
                <td >
                  <table width="95%"  border="0" align="center" cellpadding="2" cellspacing="0" >
                    <form method="post"  action="kulekle.php" name="frmKullanim" >
						<input type="hidden" name="MesajNum" id="MesajNum" value="3000" >
                        <input type="hidden" name="yazi" id="yazi" >
                      <td width="45%" align="right" class="govde">Teklif Toplama Yöntemi    :</td>
                        <td width="55%"><select name="iletisim" size="1">
                        <?php $iletisim_array=array("E-Posta","Faks","Posta","Telefon","Ziyaret"); 
                        foreach($iletisim_array as $iletisim_temp) {
							if($iletisim_temp==$iletisim)
								$selected='selected="selected"';
				  			else
								$selected='';
							echo "<option value=\"$iletisim_temp\" $selected>$iletisim_temp</option>";
						}
                        ?>    
                        </select></td>
                    </tr>
              <td align="right" class="govde" >En Son Teklif Verme Tarihi:</td>
                  <td><input type="text" name="tektarih" id="tektarih" value="<?php echo date("d-m-Y", strtotime($tarih)); ?> " />
<!-- <script>DateInput('tektarih', true, 'YYYY-MM-DD', '<?php echo date("Y-m-d",time()+4*24*60*60); ?>')</script> -->
              </tr>
              <tr>
                <td align="right" valign="top" class="govde" >Mal veya Hizmetin<br> Teslim Süresi    : </td>
                <td>
                  <table width="60%">
                    <tr>
                      <td width="40%" class="govde"><label>
                        <input type="radio" name="Sureler" value="Gün" <?php if($verified_kulid<=0 || $sure_birim=="Gün") echo 'checked="checked"'; ?>>
      Gün</label></td>
                      <td width="60%"><select name="GunSay" size="1" style="width:50px;" onchange="change(this)">
                    <?php
					for($i=1;$i<=29;$i++) {
						if($i==$sure_miktar && $sure_birim=="Gün")
							$selected='selected="selected"';
				  		elseif ($i==5 && $sure_birim=="")
						    $selected='selected="selected"';
						else
							$selected='';
						echo '<option value="'.sprintf("%02d",$i).'" '.$selected.'>'.$i.'</option>';
						}
					?>
                      </select></td>
                    </tr>
                    <tr>
                      <td class="govde"><label>
                        <input type="radio" name="Sureler" value="Hafta" <?php if($sure_birim=="Hafta") echo 'checked="checked"'; ?>>
      Hafta</label></td>
                      <td><select name="HaftaSay" size="1" id="HaftaSay" style="width:50px;" onchange="change(this)">
                    <?php
					for($i=1;$i<=3;$i++) {
						if($i==$sure_miktar && $sure_birim=="Hafta")
							$selected='selected="selected"';
				  		else
							$selected='';
						echo '<option value="'.sprintf("%02d",$i).'" '.$selected.'>'.sprintf("%2d",$i).'</option>';
						}
					?>
                      </select></td>
                    </tr>
                    <tr>
                      <td class="govde"><label>
                        <input type="radio" name="Sureler" value="Ay" <?php if($sure_birim=="Ay") echo 'checked="checked"'; ?>>
      Ay</label></td>
                      <td><select name="AySay" size="1" id="AySay" style="width:50px;" onchange="change(this)">
                    <?php
					for($i=1;$i<=11;$i++) {
							if($i==$sure_miktar && $sure_birim=="Ay")
							$selected='selected="selected"';
				  		else
							$selected='';
					echo '<option value="'.sprintf("%02d",$i).'" '.$selected.'>'.sprintf("%2d",$i).'</option>';
						}
					?>
                      </select></td>
                    </tr>
                    <tr>
                      <td class="govde"><label>
                        <input type="radio" name="Sureler" value="Yil" <?php if($sure_birim=="Yil") echo 'checked="checked"'; ?>>
      Yıl</label></td>
                      <td><select name="YilSay" size="1" id="YilSay" style="width:50px;" onchange="change(this)">
                    <?php
					for($i=1;$i<=4;$i++) {
							if($i==$sure_miktar && $sure_birim=="Yil")
							$selected='selected="selected"';
				  		else
							$selected='';
					echo '<option value="'.sprintf("%02d",$i).'"'.$selected.'>'.sprintf("%2d",$i).'</option>';
						}
					?>
                      </select></td>
                    </tr>
                  </table>
                  <input type="hidden" name="sure" id="sure" value="deneme">                  </td>
              </tr>
              <TR>
                <td  align="right" class="govde">Mal veya Hizmetin Teslim Yeri:</td>
                <td align="left"><?php
				$str="select * from sehir where sehirid<999 order by sehir";
				$result=mysqli_query($connection,$str);
				?>
                    <select name="sehir" >
                     <? while ($row = mysqli_fetch_array($result))
                     {
					 $sehiridx=$row['sehirid'];
					 if($verified_kulid>0 && $cityver==$row['sehirid'] || $verified_kulid<=0 && $cityver==$row['sehir'])
					 {
					 	echo "<option value=$sehiridx selected=selected>";
					 }
					 else 
					 {
						 echo "<option value=$sehiridx>";
					 }
					 
					 echo $row['sehir'];}
                     echo"<br>";
					?>
                    </select>
                </td>
              </TR>
              <tr>
                <td align="right" valign="top" class="govde">Talep Edilen Mal / Hizmetin Tarifi : </td>
                <td class="govde"> 					
				<textarea placeholder="(Yazacağınız detay tekliflerin daha sağlıklı ve hızlı gelmesini sağlayacaktır.)" cols="50" name="text"  onKeyDown="textCounter(this.form.text,this.form.remLen,500)" onKeyUp="textCounter(this.form.text,this.form.remLen,500)" rows="8" wrap="soft" style="font-family: Verdana; font-size: 11px;"><?php echo $text; ?></textarea>

                  <br>
                  Kalan karakter sayısı:
                  <input name="remLen" type="text" value="500" size="6"  maxlength=3 readonly style="border:none" > </td>
              </tr>
              <tr>
                <td height="50"colspan="2"  align="center" valign="middle"><a href="giris.php" class="buttonPage"> İptal &nbsp;<i class="icon-close" ></i></a><img src= "image/trans.gif" alt="" width="25" height="1"><a href="#here" onClick="Gonder()" class="buttonPage"> İlerle &nbsp;<i class="icon-arrow-right"></i></a></td>
              </tr>
				  </form>
                        </table></td>
            </tr>
          </table>
      </tr>
    </table>
    </td>
    </tr>
    </table>
  </div>
  <div id="bant1"></div>
  <div id="alt">
    <?php include "alt.php" ?>
  </div>
</div>
<div id="dialog-hata" title="Uyarı" style="display:none" class="text_g" >
  <p>
    <span>En az 1 tane şehir seçmelisiniz... </span>
  </p>
</div>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
var pageTracker = _gat._getTracker("UA-699917-3");
pageTracker._trackPageview();
</script>
</BODY></HTML>
<script language="javascript">
	var now = new Date();
	now.setDate(now.getDate()+5);
	document.forms.frmKullanim.gun.value = now.getDate();
	document.forms.frmKullanim.ay.value = now.getMonth()+1;
	document.forms.frmKullanim.yil.value = now.getFullYear();
<? if (isset($_SESSION["verified_kulid"]))
	{
		$verified_kulid = $_SESSION["verified_kulid"];
		$str="SELECT * FROM  kullanim  where Kullanimid='$verified_kulid'";
		$result=mysqli_query($connection,$str);
		while ($row = mysqli_fetch_array($result)){ 
			$yazi = str_replace("'", "\'",str_replace("\n", "", str_replace("\r", "", $row["text"])));
			$range=$row['tarih'];
			$zaman1=explode("-",$range);
			$range=$row['sure'];
			$sure	=explode(" ",$range);
			if ($sure[1] == 'Gün') $suretur = 0;
			if ($sure[1] == 'Hafta') $suretur = 1;
			if ($sure[1] == 'Ay') $suretur = 2;
			if ($sure[1] == 'Yıl') $suretur = 3;
?>                
			document.forms.frmKullanim.iletisim.value = <? echo "'" . $row["iletisim"] . "'";?>;
			document.forms.frmKullanim.gun.value = <? echo "'" .$zaman1[2]."'" ; ?>;
			document.forms.frmKullanim.ay.value = <? echo "'" .$zaman1[1]."'" ;?>;
			document.forms.frmKullanim.yil.value = <? echo "'" .$zaman1[0]."'" ;?>;
			document.forms.frmKullanim.Sureler[<? echo $suretur ?>].checked= true;
			if ( <? echo $suretur ?>  == 0)	document.forms.frmKullanim.GunSay.value = <? echo "'" .$sure[0]."'" ;?>;
   		    if ( <? echo $suretur ?>  == 1) document.forms.frmKullanim.HaftaSay.value = <? echo "'" .$sure[0]."'" ;?>;
			if ( <? echo $suretur ?>  == 2)	document.forms.frmKullanim.AySay.value = <? echo "'" .$sure[0]."'" ;?>;
			if ( <? echo $suretur ?>  == 3)	document.forms.frmKullanim.YilSay.value = <? echo "'" .$sure[0]."'" ;?>;
			document.forms.frmKullanim.sehir.value = <? echo "'" .$row['sehirid']."'"?> ;
			document.forms.frmKullanim.text.value = <? echo "'" .$yazi."'" ?> ;
<?			
		}
	}
?>
</script>