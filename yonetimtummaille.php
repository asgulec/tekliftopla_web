<?php
include "headeryon.php";
ob_start();
set_time_limit(0);
/*include"ayar.php";
$connection=mysql_connect("$host","$user","$password") or die ("Could not connect to the MySQL Server");
$query="SET NAMES 'UTF8'";
mysql_select_db($db);
mysql_query($query);*/

if(!isset($_SESSION["verified_user"])){
?>
<script type='text/javascript'>alert("Hata");
window.location = "tradmin.php";
</script> 
<?
}
$verified_kulid = $_SESSION["verified_kulid"];
$tummail = array();

$q="select firmaid, email, rekid, grafik, link from gecrek6 where kullanimid=$verified_kulid";
$r=mysqli_query($coni,$q);
$n=mysqli_num_rows($r);
/////////////////////////////////////////
if($n>0){
	for($i=0;$i<$n;$i++) {
		list($firmaid, $email, $rekid, $grafik, $link)=mysqli_fetch_array($r);
		$tummail[$i]['firmaid']=$firmaid;
		$tummail[$i]['email']=$email;
		$tummail[$i]['rekid']=$rekid;
		$tummail[$i]['grafik']=$grafik;
		$tummail[$i]['link']=$link;
	} 
	mysqli_query($coni,"delete from gecrek6 where kullanimid=$verified_kulid");

	error_reporting(63);
	include('class.html.mime.mail.inc');
	$verified_sehirid = $_SESSION["verified_sehirid"];
	$str787="SELECT * FROM sehir WHERE sehirid='$verified_sehirid'";
	$result787=mysqli_query($coni,$str787);
	while ($row787 = mysqli_fetch_array($result787)) {
		$sehir=$row787['sehir'];
	}	                
	$str="SELECT * FROM kullanim WHERE  Kullanimid='$verified_kulid'";
	$result=mysqli_query($coni,$str);
	while ($row = mysqli_fetch_array($result)) {
		$iletisim=$row['iletisim'];
		$adres = $row['Firmailetisim'];
		$smail = $row['FirmaEPosta'];
		$teklifid =$row["Kullanimid"];
		$tarih=$row['tarih'];
		$sure=$row['sure'];
		$text=$row['text'];
		$ulkekod=$row['ulke'];
		$dil=$row['dil'];
		$syetkili = "";
	}
	$zaman2=explode("-",$tarih);
	$tarih2=$zaman2[2]."-".$zaman2[1]."-".$zaman2[0];
	$metin1=str_replace("<script","",$text);
	$metin1=str_replace("<style","",$text);
	$metin1=str_replace("<embed","",$text);
	$metin=nl2br($metin1);
	$str788="SELECT * FROM country WHERE iso3='$ulkekod'";
	$result788=mysqli_query($coni,$str788);
	while ($row788 = mysqli_fetch_array($result788)) {
		$ulke=$row788['ulke'];
	}
	$teslim = $ulkekod=="TUR" ? $sehir : $ulke;
	$mesaj="";         
	$sfirma = $_SESSION["verified_firma"];
	$konu=$sfirma." teklif talep duyurusu.";
	$textm = '';
		
		foreach($tummail as $firmabilgi)
		{
		$reklam_link=$firmabilgi['link'];
		$reklam_grafik=$firmabilgi['grafik'];
		//$cik='?kime='.$firmabilgi['email'].'&id='.$firmabilgi['firmaid'];														         //$cik='?c='.urlencode(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256,md5("tekliftopla"),$firmabilgi['firmaid'],MCRYPT_MODE_ECB))); 

		mysqli_query($coni,"INSERT INTO kulfirmaid (kullanimid,firmaid,rekid) values('$verified_kulid','".$firmabilgi["firmaid"]."','".$firmabilgi["rekid"]."')");
		
		$kulfirmaid=mysqli_insert_id($coni);
		
		ob_start();
		include("epostasablon.php");
		$html=ob_get_contents();
		ob_clean();
		$db_email=mysqli_real_escape_string($coni,$firmabilgi['email']);
		$db_konu=mysqli_real_escape_string($coni,$konu);
		$db_mesaj=mysqli_real_escape_string($coni,$html);
		mysqli_query($coni,"insert into mail_que2 (email,konu,mesaj) values ('$db_email','$db_konu','$db_mesaj')");	
			/*
		$mail = new html_mime_mail(array("X-Mailer: Html Mime Mail Class"));
		
		
		$mail->add_html($html, $mesaj);
		$mail->set_body($mesaj);
		$mail->set_charset('UTF-8', TRUE);
        $mail->build_message();
		$mail->send($firmabilgi['email'],$firmabilgi['email'],'Tekliftopla.com','info@tekliftopla.com',$konu);
		unset($mail);
*/
		}
	ob_start();
	if ($dil=="TUR") {
	include("epostasablonbilgi.php");
} else { include("epostasablonbilgi-e.php"); }
	$html=ob_get_contents();
	ob_clean();
	$db_email=mysqli_real_escape_string($coni,$smail);
	$db_emaily=mysqli_real_escape_string($coni,"asgulec@outlook.com");
	if ($dil=="TUR") {
	$db_konu=mysqli_real_escape_string($coni,"Teklif talep bilginiz");
    } else { $db_konu=mysqli_real_escape_string($coni,"Your RFP conveyed");}
	$db_mesaj=mysqli_real_escape_string($coni,$html);
	mysqli_query($coni,"insert into mail_que2 (email,konu,mesaj) values ('$db_email','$db_konu','$db_mesaj')");
	mysqli_query($coni,"insert into mail_que2 (email,konu,mesaj) values ('$db_emaily','$db_konu','$db_mesaj')");
	
	
	/*
	$mail = new html_mime_mail(array("X-Mailer: Html Mime Mail Class"));
			
	$mail->add_html($html, $mesaj);
	$mail->set_body($mesaj);
	$mail->set_charset('UTF-8', TRUE);
	$mail->build_message();
	$mail->send($smail, $smail,'Tekliftopla.com','info@tekliftopla.com','Teklif talep bilginiz');
	$mail->send('gulec59-g@yahoo.com', 'gulec59-g@yahoo.com','Tekliftopla.com','info@tekliftopla.com','Teklif talep bilginiz');
	*/
	
	$_SESSION['oneshot'] = false;
	header("Location:mailtamam1.php?teklifid=$teklifid");
	exit;
}
else{
	unset($_SESSION['kontrol']);
	//session_unregister("kontrol");
	unset($_SESSION['verified_kulid']);
	//session_unregister("verified_kulid");
	unset($_SESSION['verified_teklifid']);
	//session_unregister("verified_teklifid");
	unset($_SESSION['verified_firma']);
	//session_unregister("verified_firma");
	$_SESSION['oneshot'] = false;
	header("Location:mailtamam1.php");
	exit;
}
?>