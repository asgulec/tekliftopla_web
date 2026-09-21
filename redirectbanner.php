<?php
ob_start();
include"ayar.php";

$coni = mysqli_connect($host,$user,$password,$db);
if (!$coni) {
    header('Location: https://www.tekliftopla.com');
    exit;
}
mysqli_set_charset($coni,"utf8");


/*$connection=mysql_connect("$host","$user","$password") or die ("Could not connect to the MySQL Server");
$query="SET NAMES 'UTF8'";
mysql_select_db($db);
mysql_query($query);*/

//$kulfirmaid=intval(trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256,md5("artusa"),base64_decode(urldecode($_GET['c'])),MCRYPT_MODE_ECB)));
$rekid_raw = isset($_GET['d']) ? trim(urldecode($_GET['d'])) : '';
$rekid = filter_var($rekid_raw, FILTER_VALIDATE_INT);
if ($rekid === false || $rekid < 1) {
    header('Location: https://www.tekliftopla.com');
    exit;
}
$counterStatement = mysqli_prepare($coni, "UPDATE rekkayit SET tiksayac = tiksayac + 1 WHERE rekid = ?");
if ($counterStatement) {
    mysqli_stmt_bind_param($counterStatement, "i", $rekid);
    mysqli_stmt_execute($counterStatement);
    mysqli_stmt_close($counterStatement);
}

$linkStatement = mysqli_prepare($coni, "SELECT link FROM rekkayit WHERE rekid = ? LIMIT 1");
$link = '';
if ($linkStatement) {
    mysqli_stmt_bind_param($linkStatement, "i", $rekid);
    mysqli_stmt_execute($linkStatement);
    $linkResult = mysqli_stmt_get_result($linkStatement);
    $linkRow = $linkResult ? mysqli_fetch_assoc($linkResult) : null;
    $link = $linkRow['link'] ?? '';
    mysqli_stmt_close($linkStatement);
}
if (!empty($link)) {
	header("Location: " . $link);
	exit;
}

header("Location: https://www.tekliftopla.com");
exit;
?>