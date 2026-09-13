<?php
ob_start();
session_start();
set_time_limit(0);
include"ayar.php";

function safe_redirect($target)
{
    if (!headers_sent()) {
        header("Location: {$target}");
        exit;
    }

    echo "<script type='text/javascript'>window.location = '{$target}';</script>";
    exit;
}
/*$connection=mysql_connect("$host","$user","$password") or die ("Could not connect to the MySQL Server");
$query="SET NAMES 'UTF8'";
mysql_select_db($db);
mysql_query($query);*/
$coni = mysqli_connect($host,$user,$password,$db);
if (mysqli_connect_errno())
   {
   die("Failed to connect to MySQL: " . mysqli_connect_error());
   }
mysqli_set_charset($coni,"utf8");

if(!isset($_SESSION["verified_pass"]) and !isset($_SESSION["verified_user"])){
    safe_redirect("index.php");
}
$verified_kulid = isset($_SESSION["verified_kulid"]) ? $_SESSION["verified_kulid"]: '';
$verified_teklifid = isset($_SESSION["verified_teklifid"]) ? $_SESSION["verified_teklifid"] : '';
$teklifid = $verified_teklifid;
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

$stryy1="SELECT  bilgi.*, kullanim.Kullanimid FROM kullanim,bilgi where kullanim.firmaid=bilgi.firmaid and kullanim.Kullanimid='$verified_teklifid'";
$resultyy1=mysqli_query($coni,$stryy1);
while ($rowyy1 = mysqli_fetch_array($resultyy1)){
	$smail=$rowyy1['email'];
	$verified_teklifid=$rowyy1['Kullanimid'];
	$sfirma=$rowyy1['Firma_Adi'];
	$sfirmaid=$rowyy1['firmaid'];
	$adres1=$rowyy1['Adres'];	
	$syetkili=$rowyy1['yetkili'];
	$telefon=$rowyy1['Telefon'];
	$fax=$rowyy1['Fax'];
	$afax=$rowyy1['fax_alankodi'];
	$atel=$rowyy1['tel_alankodi'];
	}

$str="SELECT a.iletisim, a.tarih, a.sure, a.text, a.ulke as ulkekod, a.dil, b.sehir, c.ulke FROM  kullanim as a, sehir as b, country as c where a.Kullanimid='$verified_teklifid' and a.sehirid=b.sehirid and a.ulke=c.iso3";
$result=mysqli_query($coni,$str);
while ($row = mysqli_fetch_array($result)){
	$iletisim =  $row["iletisim"];
	$tarih =  $row["tarih"];
	$sure =  $row["sure"];
	$teklifid = $verified_teklifid;
	$text = $row["text"];
	$sehir = $row["sehir"];
	$ulkekod = $row["ulkekod"];
	$ulke = $row["ulke"];
	$dil = $row["dil"];
	$ver_teklifid = $teklifid;
	$adres = "";
	}
$teslim = $ulkekod=="TUR" ? $sehir : $ulke;
$_SESSION['ver_teklifid'] = $ver_teklifid;
switch($iletisim){
case'E-Posta':
$adres=$smail;
break;
case'E-mail':
$adres=$smail;
break;
case'Faks':
$adres=$afax."   ".$fax;
break;
case'Posta':
$adres=$adres1;
break;
case'Telefon':
$adres=$atel."   ".$telefon;
break;
case'Ziyaret':
$adres=$adres1;
break;
}
$zaman3=explode("-",$tarih);
$tarih2=$zaman3[2]."-".$zaman3[1]."-".$zaman3[0];
$metin1=str_replace("<script","",$text);
$metin1=str_replace("<style","",$text);
$metin1=str_replace("<embed","",$text);
$metin=nl2br($metin1);
$mesaj="";         

$konu= "Teklif talebi";
        $textm = '';
		
		foreach($tummail as $firmabilgi)
		{
				
		$reklam_link=$firmabilgi['link'];
		$reklam_grafik=$firmabilgi['grafik'];

//$cik='?c='.urlencode(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256,md5("tekliftopla"),$firmabilgi['firmaid'],MCRYPT_MODE_ECB))); 

		mysqli_query($coni,"INSERT INTO kulfirmaid (kullanimid,firmaid,rekid) values('$verified_kulid','".$firmabilgi["firmaid"]."','".$firmabilgi["rekid"]."')");
		$kulfirmaid=mysqli_insert_id($coni);        
		ob_start();
		include("epostasablon.php");
		$html=ob_get_contents();
		ob_clean();
		$db_email=mysqli_real_escape_string($coni,$firmabilgi['email']);
		$db_konu=mysqli_real_escape_string($coni,$konu);
		$db_mesaj=mysqli_real_escape_string($coni,$html);
		mysqli_query($coni,"insert into mail_que (email,konu,mesaj) values ('$db_email','$db_konu','$db_mesaj')");
		}
		
/* kullan�c�ya ve y�neticiye bilgi mesaj� */

$array = "kime=".$smail."&id=".$sfirmaid;	
ob_start();
if ($dil=="TUR") {
	include("epostasablonbilgi.php");
} else { include("epostasablonbilgi-e.php"); }
$html=ob_get_contents();
ob_clean();
$db_email=mysqli_real_escape_string($coni,$smail);
$db_emaily=mysqli_real_escape_string($coni,"gulec59-g@yahoo.com");
if ($dil=="TUR") {
	$db_konu=mysqli_real_escape_string($coni,"Teklif talep bilginiz");
} else { $db_konu=mysqli_real_escape_string($coni,"Your RFP conveyed");}
$db_mesaj=mysqli_real_escape_string($coni,$html);
mysqli_query($coni,"insert into mail_que (email,konu,mesaj) values ('$db_email','$db_konu','$db_mesaj')");
mysqli_query($coni,"insert into mail_que (email,konu,mesaj) values ('$db_emaily','$db_konu','$db_mesaj')");

			
unset($_SESSION['kontrol']);
unset($_SESSION['verified_kulid']);
unset($_SESSION['verified_teklifid']);

safe_redirect("mailtamam.php?teklifid={$teklifid}");
}
else{
unset($_SESSION['kontrol']);
unset($_SESSION['verified_kulid']);
unset($_SESSION['verified_teklifid']);
safe_redirect("mailtamam.php?teklifid={$teklifid}");
}
?>