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
$kulfirmaid=intval(trim(base64_decode(urldecode(isset($_GET['c']) ? $_GET['c'] : ''))));
if($kulfirmaid>0)
	mysqli_query($coni,"insert into rektik (kulfirmaid,tikdate) values ($kulfirmaid,now())");
  /*INSERT INTO table (key,col1) VALUES (1,2)
  ON DUPLICATE KEY UPDATE col1 = 2;
    REPLACE INTO `transcripts` SET `ensembl_transcript_id` = 'ENSORGT00000000001',`transcript_chrom_start` = 12345,`transcript_chrom_end` = 12678; 
  */

$r=mysqli_query($coni,"select r.link from rekkayit as r,kulfirmaid as k where r.rekid=k.rekid and k.id=$kulfirmaid");
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