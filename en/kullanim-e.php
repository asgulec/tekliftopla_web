<? include"headeri-e.php"; ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="content-language" content="us" />
<title>tekliftopla</title>
<link href="../css/style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="../jquery/jquery-ui.theme.css">
<link rel="stylesheet" href="../jquery/jquery-ui.css">
<script src="../jquery/external/jquery/jquery.js"></script>
<script src="../jquery/jquery-ui.min.js"></script>
</head>
<body onLoad="ulkeSec()">
<SCRIPT LANGUAGE="JavaScript">
$(function() {
$( "#tektarih" ).datepicker({firstDay:"1",minDate: "+1", maxDate: "+3M +10D", dateFormat:"dd-mm-yy", autoSize:"true" });
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
function ulkeSec(){
var obj = document.getElementById("Ulke");
if ( obj.options[obj.selectedIndex].text =="Turkey" ) 
   { document.getElementById("cityr").style.display="";}
   else { document.getElementById("cityr").style.display="none";} 
}
function Iptal(){
	window.location = "giris-e.php";
}
function Gonder(){
	if (Kontrol())
		document.forms.frmKullanim.submit();
}
function Kontrol() {
if (document.forms.frmKullanim.text.value=="" ) 
{ 
 	$(function(){
    $("#dialog-hata").text('Please enter a brief description of goods or services required...');
	$("#dialog-hata" ).dialog({
		modal:true,
		position: {	my: "center",at: "center",of: sayfa},
		buttons:{OK: function () {
    $(this).dialog("close");
    }}
	});	
    });
	return (false); 
} 
if (document.forms.frmKullanim.Ulke.value=="TUR" && document.forms.frmKullanim.sehir.value=="Select" ) 
{ 
 	$(function(){
    $("#dialog-hata").text('Plesae select the city of delivery in Turkey...');
	$("#dialog-hata" ).dialog({
		modal:true,
		position: {	my: "center",at: "center",of: sayfa},
		buttons:{OK: function () {
    $(this).dialog("close");
    }}
	});	
    });
return (false); 
} 
if (! TarihKontrol())
{
 	$(function(){
    $("#dialog-hata").text("Due date for proposal can not be before today's date...");
	$("#dialog-hata" ).dialog({
		modal:true,
		position: {	my: "center",at: "center",of: sayfa},
		buttons:{OK: function () {
    $(this).dialog("close");
    }}
	});	
    });
return (false);
}
if (document.forms.frmKullanim.Sureler[0].checked )
	document.forms.frmKullanim.sure.value = document.forms.frmKullanim.GunSay.value + " Day(s)";
if (document.forms.frmKullanim.Sureler[1].checked )
	document.forms.frmKullanim.sure.value = document.forms.frmKullanim.HaftaSay.value + " Week(s)";
if (document.forms.frmKullanim.Sureler[2].checked )
	document.forms.frmKullanim.sure.value = document.forms.frmKullanim.AySay.value + " Month(s)";
if (document.forms.frmKullanim.Sureler[3].checked )
	document.forms.frmKullanim.sure.value = document.forms.frmKullanim.YilSay.value + " Year(s)";
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
    <?php include "ust-e.php" ?>
  </div>
  <div id="bant1"></div>
  <div id="sol">
    <?php include "menu-e.php" ?>
  </div>
  <div id="analong">
    <table width="97%" align="center"  cellspacing="0" cellpadding="0" border="0" bgColor=white >
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td colspan="4" height="2" bgcolor="#FFFFFF"></td>
            </tr>
            <tr height="25px">
              <td width="25%"></td>
              <td width="25%" ></td>
              <td valign="middle" width="43%" align="right" class="title">New RFP</td>
              <td valign="bottom" align="right" width="7%" ><img src="../image/sag_ok.gif"></td>
            </tr>
          </table></td>
      </tr>
      <tr>
        <td height="10px"></td>
      </tr>
      <tr>
        <td valign="top" bgcolor="#F6F6F6"><? $verified_firma = isset($_SESSION["verified_firma"]) ? $_SESSION["verified_firma"] : "";
		$verified_email = isset($_SESSION["verified_email"]) ? $_SESSION["verified_email"] : "" ; 
		$city = "SELECT a.Sehir, b.iso3 from bilgi as a, country as b WHERE a.email = '$verified_email' AND a.ulke = b.iso3 ";
		$cityx=mysqli_query($connection,$city);
		$resultx=mysqli_fetch_array($cityx);
		$cityver = $resultx['Sehir'];
		$ulkever = $resultx['iso3']; 
		?>
          <span class="Baslik"><?php echo $verified_firma; ?>, please fill out the form for your request for proposal.</span><span class="govde"> <br>
          You may revise default values as needed.</span>
          <?php
			$tarih=date("Y-m-d",time()+5*24*60*60);
            if(isset($_GET["kul"])) {
				$verified_kulid=intval($_GET["kul"]);
			}	
			if($verified_kulid>0) {
				$r=mysqli_query($connection,"select tarih,sure,iletisim,text,sehirid,ulke,session from kullanim where Kullanimid=$verified_kulid and firmaid=".$_SESSION["verified_firmaid"]);
				$n=mysqli_num_rows($r);
				if($n>0) {
					$_SESSION['verified_kulid']=$verified_kulid;
					list($tarih,$sure,$iletisim,$text,$cityver,$ulkever,$verified_sifre1)=mysqli_fetch_array($r);
					//echo $tarih.$sure.$iletisim.$text.$cityver;
					$_SESSION['verified_sifre1']=$verified_sifre1;
					$sure=explode(" ",$sure);
					$sure_miktar=intval($sure[0]);
					$sure_birim=$sure[1];
				}
			}
            ?></td>
      </tr>
      <tr>
        <td height="5px"></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" align="center" cellpadding="2" cellspacing="1" >
            <tr>
              <td><table width="95%"  border="0" align="center" cellpadding="2" cellspacing="0" >
                  <form method="post"  action="kulekle-e.php" name="frmKullanim" >
                    <input type="hidden" name="MesajNum" id="MesajNum" value="3000" >
                    <input type="hidden" name="yazi" id="yazi" >
                    <tr style="display:none">
                      <td width="45%" align="right" class="govde">Method of Communication : </td>
                      <td width="55%"><select name="iletisim" size="1">
                          <?php $iletisim_array=array("E-mail","Fax","Mail","Telephone","Visit"); 
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
                    <tr>
                      <td align="right" class="govde" >Deadline for Proposal: </td>
                      <td class="govde"><input type="text" name="tektarih" id="tektarih" value="<?php echo date("d-m-Y", strtotime($tarih)); ?> " />
                        
                        <!-- <script>DateInput('tektarih', true, 'YYYY-MM-DD', '<?php echo date("Y-m-d",time()+4*24*60*60); ?>')</script> --> 
                        (dd-mm-yyyy) 
                    </tr>
                    <tr>
                      <td align="right" valign="top" class="govde" >Delivery Period : </td>
                      <td><table width="70%">
                          <tr>
                            <td width="40%" class="govde"><label>
                                <input type="radio" name="Sureler" value="Day(s)" <?php if($sure_birim=="Day(s)") echo 'checked="checked"'; ?>>
                                Day(s)</label></td>
                            <td width="60%"><select name="GunSay" size="1" style="width:50px;" onchange="change(this)">
                                <?php
					for($i=1;$i<=29;$i++) {
						if($i==$sure_miktar && $sure_birim=="Day(s)")
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
                                <input type="radio" name="Sureler" value="Week(s)" <?php if($verified_kulid<=0 || $sure_birim=="Week(s)") echo 'checked="checked"'; ?>>
                                Week(s)</label></td>
                            <td><select name="HaftaSay" size="1" id="HaftaSay" style="width:50px;" onchange="change(this)">
                                <?php
					for($i=1;$i<=3;$i++) {
						if($i==$sure_miktar && $sure_birim=="Week(s)")
							$selected='selected="selected"';
				  		elseif ($i==2 && $sure_birim=="")
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
                                <input type="radio" name="Sureler" value="Month(s)" <?php if($sure_birim=="Month(s)") echo 'checked="checked"'; ?>>
                                Month(s)</label></td>
                            <td><select name="AySay" size="1" id="AySay" style="width:50px;" onchange="change(this)">
                                <?php
					for($i=1;$i<=11;$i++) {
							if($i==$sure_miktar && $sure_birim=="Month(s)")
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
                                <input type="radio" name="Sureler" value="Year(s)" <?php if($sure_birim=="Year(s)") echo 'checked="checked"'; ?>>
                                Year(s)</label></td>
                            <td><select name="YilSay" size="1" id="YilSay" style="width:50px;" onchange="change(this)">
                                <?php
					for($i=1;$i<=4;$i++) {
							if($i==$sure_miktar && $sure_birim=="Year(s)")
							$selected='selected="selected"';
				  		else
							$selected='';
					echo '<option value="'.sprintf("%02d",$i).'"'.$selected.'>'.sprintf("%2d",$i).'</option>';
						}
					?>
                              </select></td>
                          </tr>
                        </table>
                        <input type="hidden" name="sure" id="sure" value="deneme"></td>
                    </tr>
                    <TR>
                      <td  align="right" class="govde">Destination Country :</td>
                      <td align="left"><?
				$stra="select * from country order by ulke";
				$resulta=mysqli_query($connection,$stra);
				?>
                        <select name="Ulke" id="Ulke" onChange="ulkeSec()" >
                          <? while ($rowa = mysqli_fetch_array($resulta))
                     {
					 $ulkedx=$rowa['iso3'];
					 if($verified_kulid>0 && $ulkever==$rowa['iso3'] || $verified_kulid<=0 && $ulkever==$rowa['iso3'])
					 {
					 	echo "<option value=$ulkedx selected=selected>";
					 }
					 else 
					 {
					 	echo "<option value=$ulkedx>";
					 }
					 
					 echo $rowa['ulke'];}
                     echo"<br>";
					?>
                        </select></td>
                    </TR>
                    <TR id="cityr" style="display:none">
                      <td  align="right" class="govde">City of Delivery :</td>
                      <td align="left"><?
				$str="select * from sehir where sehirid<999 order by sehir";
				$result=mysqli_query($connection,$str);
				?>
                        <select name="sehir" id="sehir" >
                          <OPTION SELECTED>Select
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
                        </select></td>
                    </TR>
                    <tr>
                      <td align="right" valign="top" class="govde">Description in English of <br>
                        goods or services requested : <br>
                        <br></td>
                      <td class="govde"><textarea placeholder="(Details will increase the speed and relevance of replies....)" cols="55" name="text"  onKeyDown="textCounter(this.form.text,this.form.remLen,500)" onKeyUp="textCounter(this.form.text,this.form.remLen,500)" rows="10" wrap="soft"style="font-family: Arial; font-size: 9pt;"><?php echo $text; ?></textarea>
                        <br>
                        Remaining characters:
                        <input name="remLen" type="text" value="500" size="6"  maxlength=3 readonly ></td>
                    </tr>
                    <tr  >
                      <td height="40" colspan="2"  align="center" valign="middle"><a href="giris-e.php" class="buttonPage"> Cancel &nbsp;<i class="icon-close" ></i></a><img src= "../image/trans.gif" alt="" width="25" height="1"><a href="#here" onClick="Gonder()" class="buttonPage"> Next &nbsp;<i class="icon-arrow-right"></i></a></td>
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
    <?php include "alt-e.php" ?>
  </div>
</div>
</div>
<div id="dialog-hata" title="Warning" style="display:none" class="text_g" >
  <p> <span>Error messages... </span> </p>
</div>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script> 
<script type="text/javascript">
var pageTracker = _gat._getTracker("UA-699917-3");
pageTracker._trackPageview();
</script> 
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
			if ($sure[1] == 'Day(s)') $suretur = 0;
			if ($sure[1] == 'Week(s)') $suretur = 1;
			if ($sure[1] == 'Month(s)') $suretur = 2;
			if ($sure[1] == 'Year(s)') $suretur = 3;
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
			document.forms.frmKullanim.Ulke.value = <? echo "'" .$rowa['iso3']."'"?> ;
			document.forms.frmKullanim.sehir.value = <? echo "'" .$row['sehirid']."'"?> ;
			document.forms.frmKullanim.text.value = <? echo "'" .$yazi."'" ?> ;
<?			
		}
	}
?>
</script>
</BODY>
</HTML>