<?php
set_time_limit(0);
include"headeryon.php";
$tummail = isset($_POST["tummail"]) ? $_POST["tummail"] :'';

$kullanimid = isset($_SESSION["verified_kulid"])? $_SESSION["verified_kulid"] : '';

$str1="SELECT mesajsay FROM kullanim WHERE  Kullanimid='$kullanimid'";
$result1=mysqli_query($coni,$str1);
while ($row1 = mysqli_fetch_array($result1)) {
	$mesajad=$row1['mesajsay'];
}

if(count($tummail)>$mesajad) {
$prolar=array();
$freeler=array();
	foreach($tummail as $tummail_var) {
		$firma_temp=explode("/",$tummail_var);
		$firma_id=$firma_temp[0];
		$firma_email=$firma_temp[1];
		
		$r=mysqli_query($coni,"select proflag from bilgi where firmaid='$firma_id'");
		list($proflag)=mysqli_fetch_array($r);
		
		if($proflag>0)
			$prolar[]=$tummail_var;
		else {
			$freeler[]=$tummail_var;
		}		
	}
	
	
	if(count($prolar)>=$mesajad) {
		shuffle($prolar);
		$tummail=array_slice($prolar,0,$mesajad);
	}
	else {
		shuffle($freeler);
		$tummail=array_merge($prolar,array_slice($freeler,0,$mesajad-count($prolar)));
	}
}

foreach($tummail as $firma) {
	$firma=explode("/",$firma);
	$firmaid=$firma[0];
	$email=$firma[1];
	$q="select rekkayit.rekid,rekkayit.grafik,rekkayit.link from rekkayit,bilgi,firma_sektor,reklam_sektor,reklam_sehir,sehir 
	where reklam_sehir.sehirid=sehir.sehirid 
	and bilgi.Sehir=sehir.sehir
	and reklam_sektor.sektorid=firma_sektor.sektorid
	and rekkayit.rekid=reklam_sektor.rekid
	and rekkayit.rekid=reklam_sehir.rekid
	and bilgi.firmaid=$firmaid
	and firma_sektor.firmaid=$firmaid
	and rekkayit.bastarih <= now()
	and rekkayit.sontarih >= now()
	and rekkayit.adet>rekkayit.sayac
	and rekkayit.adet>0
	and rekkayit.rektip=3
	order by kaytarih asc";
	$r=mysqli_query($coni,$q);
	$n=mysqli_num_rows($r);
	
	if($n>0) {
		$rek=mysqli_fetch_array($r);
		$rekid=$rek["rekid"];
		$grafik=$rek["grafik"];
		$link=$rek["link"];
	}
	else {
		$q="select rekid,grafik,link from rekkayit where rektip=13 order by kaytarih desc limit 0,1";
		$r=mysqli_query($coni,$q);
		$rek=mysqli_fetch_array($r);
		$rekid=$rek["rekid"];
		$grafik=$rek["grafik"];
		$link=$rek["link"];
	}
	mysqli_query($coni,"update rekkayit set sayac=sayac+1 where rekid=$rekid");
	
	mysqli_query($coni,"insert into gecrek6 (kullanimid,firmaid,email,rekid,grafik,link) values ('$kullanimid','$firmaid','$email','$rekid','$grafik','$link')");
}
$tempppx2="delete from gecici2 where kullanimid='$kullanimid' or kullanimid='0'";
$etkinp2=mysqli_query($coni,$tempppx2);
$tempppx3="delete from gecici3 where kullanimid='$kullanimid' or kullanimid='0'";
$etkinp3=mysqli_query($coni,$tempppx3);
$tempppx6="delete from gecici6 where kullanimid='$kullanimid' or kullanimid='0'";
$etkinp6=mysqli_query($coni,$tempppx6);
header("Location:tummaille22.php");
exit;
?>