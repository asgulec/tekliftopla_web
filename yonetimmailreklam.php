<?php
include"headeryon.php";
$postedMail = $_POST["tummail"] ?? array();
$tummail = is_array($postedMail) ? $postedMail : array();

$kullanimid = filter_var($_SESSION["verified_kulid"] ?? null, FILTER_VALIDATE_INT);
if ($kullanimid === false || $kullanimid < 1) {
	http_response_code(400);
	exit;
}

$quotaStatement = mysqli_prepare($coni, "SELECT mesajsay FROM kullanim WHERE Kullanimid = ?");
if (!$quotaStatement) {
	http_response_code(500);
	exit;
}
mysqli_stmt_bind_param($quotaStatement, "i", $kullanimid);
mysqli_stmt_execute($quotaStatement);
$quotaResult = mysqli_stmt_get_result($quotaStatement);
$quotaRow = $quotaResult ? mysqli_fetch_assoc($quotaResult) : null;
mysqli_stmt_close($quotaStatement);
$mesajad = isset($quotaRow['mesajsay']) ? (int)$quotaRow['mesajsay'] : 0;

$selectedFirmIds = array();
foreach ($tummail as $tummail_var) {
	$parts = explode('/', (string)$tummail_var, 2);
	if (count($parts) !== 2 || !ctype_digit($parts[0]) || (int)$parts[0] < 1) {
		continue;
	}
	$selectedFirmIds[] = (int)$parts[0];
}
$selectedFirmIds = array_values(array_unique($selectedFirmIds));

if (count($selectedFirmIds) > $mesajad) {
$prolar=array();
$freeler=array();
	$flagStatement = mysqli_prepare($coni, "SELECT proflag FROM bilgi WHERE firmaid = ?");
	if (!$flagStatement) {
		http_response_code(500);
		exit;
	}
	foreach($selectedFirmIds as $firma_id) {
		mysqli_stmt_bind_param($flagStatement, "i", $firma_id);
		mysqli_stmt_execute($flagStatement);
		$flagResult = mysqli_stmt_get_result($flagStatement);
		$flagRow = $flagResult ? mysqli_fetch_assoc($flagResult) : null;
		$proflag = isset($flagRow['proflag']) ? (int)$flagRow['proflag'] : 0;
		
		if($proflag>0)
			$prolar[]=$firma_id;
		else {
			$freeler[]=$firma_id;
		}		
	}
	mysqli_stmt_close($flagStatement);
	
	if(count($prolar)>=$mesajad) {
		shuffle($prolar);
		$selectedFirmIds=array_slice($prolar,0,$mesajad);
	}
	else {
		shuffle($freeler);
		$selectedFirmIds=array_merge($prolar,array_slice($freeler,0,$mesajad-count($prolar)));
	}
}

foreach($selectedFirmIds as $firmaid) {
	$q="select rekkayit.rekid,rekkayit.grafik,rekkayit.link,bilgi.email from rekkayit,bilgi,firma_sektor,reklam_sektor,reklam_sehir,sehir 
	where reklam_sehir.sehirid=sehir.sehirid 
	and bilgi.Sehir=sehir.sehir
	and reklam_sektor.sektorid=firma_sektor.sektorid
	and rekkayit.rekid=reklam_sektor.rekid
	and rekkayit.rekid=reklam_sehir.rekid
	and bilgi.firmaid=?
	and firma_sektor.firmaid=?
	and rekkayit.bastarih <= now()
	and rekkayit.sontarih >= now()
	and rekkayit.adet>rekkayit.sayac
	and rekkayit.adet>0
	and rekkayit.rektip=3
	order by kaytarih asc";
	$adStatement = mysqli_prepare($coni, $q);
	if (!$adStatement) {
		continue;
	}
	mysqli_stmt_bind_param($adStatement, "ii", $firmaid, $firmaid);
	mysqli_stmt_execute($adStatement);
	$r = mysqli_stmt_get_result($adStatement);
	$rek = $r ? mysqli_fetch_assoc($r) : null;
	mysqli_stmt_close($adStatement);
	
	if($rek) {
		$rekid=$rek["rekid"];
		$grafik=$rek["grafik"];
		$link=$rek["link"];
		$email=$rek["email"];
	}
	else {
		$q="select rekid,grafik,link from rekkayit where rektip=13 order by kaytarih desc limit 0,1";
		$r=mysqli_query($coni,$q);
		$rek=$r ? mysqli_fetch_assoc($r) : null;
		if (!$rek) {
			continue;
		}
		$rekid=$rek["rekid"];
		$grafik=$rek["grafik"];
		$link=$rek["link"];
		$emailStatement = mysqli_prepare($coni, "SELECT email FROM bilgi WHERE firmaid = ?");
		if (!$emailStatement) {
			continue;
		}
		mysqli_stmt_bind_param($emailStatement, "i", $firmaid);
		mysqli_stmt_execute($emailStatement);
		$emailResult = mysqli_stmt_get_result($emailStatement);
		$emailRow = $emailResult ? mysqli_fetch_assoc($emailResult) : null;
		mysqli_stmt_close($emailStatement);
		if (!$emailRow) {
			continue;
		}
		$email = $emailRow["email"];
	}
	
	$counterStatement = mysqli_prepare($coni, "UPDATE rekkayit SET sayac = sayac + 1 WHERE rekid = ?");
	if (!$counterStatement) {
		continue;
	}
	mysqli_stmt_bind_param($counterStatement, "i", $rekid);
	mysqli_stmt_execute($counterStatement);
	mysqli_stmt_close($counterStatement);
	
	$insertStatement = mysqli_prepare($coni, "INSERT INTO gecrek6 (kullanimid, firmaid, email, rekid, grafik, link) VALUES (?, ?, ?, ?, ?, ?)");
	if (!$insertStatement) {
		continue;
	}
	mysqli_stmt_bind_param($insertStatement, "iisiss", $kullanimid, $firmaid, $email, $rekid, $grafik, $link);
	mysqli_stmt_execute($insertStatement);
	mysqli_stmt_close($insertStatement);
}
$tempppx2="delete from gecici2 where kullanimid='$kullanimid' or kullanimid='0'";
$etkinp2=mysqli_query($coni,$tempppx2);
$tempppx3="delete from gecici3 where kullanimid='$kullanimid' or kullanimid='0'";
$etkinp3=mysqli_query($coni,$tempppx3);
$tempppx6="delete from gecici6 where kullanimid='$kullanimid' or kullanimid='0'";
$etkinp6=mysqli_query($coni,$tempppx6);
header("Location:yonetimtummaille.php");
exit;
?>