<?php
include __DIR__ . '/../ayar.php';

header('Cache-Control: no-cache, must-revalidate');

$sqlKey = $cfg['DENEME_SQL_KEY'] ?? getenv('TEKLITOPLA_SQL_KEY');
if (!is_string($sqlKey) || $sqlKey === '') {
	http_response_code(500);
	exit;
}

//error_log(print_r($_POST,TRUE));

if (!isset($_POST['vemail'], $_POST['key'])) {
	http_response_code(400);
	exit;
}

$key = urldecode((string)$_POST['key']);
if (!hash_equals($sqlKey, $key)) {
	http_response_code(400);
	exit;
}

$connection = mysqli_connect($host, $user, $password, $db);
if (!$connection) {
	http_response_code(400);
	exit;
}
mysqli_set_charset($connection, 'utf8');

$email = trim(urldecode((string)$_POST['vemail']));
$userName = trim(urldecode((string)($_POST['vuser'] ?? '')));
$countryId = trim(urldecode((string)($_POST['vcountryid'] ?? '')));
$cityId = trim(urldecode((string)($_POST['vcityid'] ?? '')));
$dateInput = trim(urldecode((string)($_POST['vdate'] ?? '')));
$duration = trim(urldecode((string)($_POST['dsure'] ?? '')));
$text = trim(urldecode((string)($_POST['dtext'] ?? '')));

$dateTimestamp = strtotime($dateInput);
if ($dateTimestamp === false) {
	mysqli_close($connection);
	http_response_code(400);
	exit;
}

$requestDate = date('Y-m-d', $dateTimestamp);
$createdDate = date('Y-m-d');
$statement = mysqli_prepare(
	$connection,
	'INSERT INTO andkullan (akdate, akeposta, akisim, akulke, aksehir, aktarih, aksure, akmetin) VALUES (?, ?, ?, ?, ?, ?, ?, ?)'
);

if (!$statement) {
	mysqli_close($connection);
	http_response_code(400);
	exit;
}

mysqli_stmt_bind_param(
	$statement,
	'ssssssss',
	$createdDate,
	$email,
	$userName,
	$countryId,
	$cityId,
	$requestDate,
	$duration,
	$text
);

if (!mysqli_stmt_execute($statement)) {
	mysqli_stmt_close($statement);
	mysqli_close($connection);
	http_response_code(400);
	exit;
}
mysqli_stmt_close($statement);

$subject = 'tekliftopla test message ...';
$message = $email . "\n \n" . $userName . "\n \n" . $countryId . "\n \n" . $cityId . "\n \n" . $requestDate . "\n \n" . $duration . "\n \n" . $text;
require_once __DIR__ . '/../class.phpmailer.php';
$mail = new PHPMailer();
$mail->AddAddress('gulec59-g@yahoo.com', 'ASG');
$mail->AddAddress('maliknadeemasghar03@gmail.com', 'Nadeem');
$mail->Subject = $subject;
$mail->Body = $message;
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->Username = 'info@tekliftopla.com';
$mail->Password = $infopass;
$mail->IsHTML(false);
$mail->CharSet = 'UTF-8';
$mail->From = 'info@tekliftopla.com';
$mail->FromName = 'tekliftopla';
$mail->Send();

mysqli_close($connection);
http_response_code(200);
