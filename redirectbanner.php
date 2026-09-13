<?php
ob_start();
include"ayar.php";

$coni = mysqli_connect($host,$user,$password,$db);
if (mysqli_connect_errno())
   {
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
   } 
mysqli_set_charset($coni,"utf8");


/*$connection=mysql_connect("$host","$user","$password") or die ("Could not connect to the MySQL Server");
$query="SET NAMES 'UTF8'";
mysql_select_db($db);
mysql_query($query);*/

//$kulfirmaid=intval(trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256,md5("artusa"),base64_decode(urldecode($_GET['c'])),MCRYPT_MODE_ECB)));
$rekid_raw = isset($_GET['d']) ? trim(urldecode($_GET['d'])) : '';
$rekid = intval($rekid_raw);
if ($rekid <= 0 && $rekid_raw !== '') {
    $decoded = base64_decode($rekid_raw, true);
    if ($decoded !== false) {
        $rekid = intval(trim($decoded));
    }
}
mysqli_query($coni,"update rekkayit set tiksayac=tiksayac+1 where rekid=$rekid");

$r=mysqli_query($coni,"select link from rekkayit where rekid=$rekid");
if(mysqli_num_rows($r)>0) {
	list($link)=mysqli_fetch_array($r);
	if(!empty($link)) {
		header("Location: $link");
		exit;
	}
}

header("Location: http://www.tekliftopla.com");
exit;
?>