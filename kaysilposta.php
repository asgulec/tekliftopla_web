<?php include "ip.php";
include"ayar.php";
session_start(); 
$coni = mysqli_connect($host,$user,$password,$db);
if (mysqli_connect_errno())
   {
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
   } 
mysqli_set_charset($coni,"utf8");

/*$link=mysql_connect($host,$user,$password)or die ("Unable to connect to MySQL server.");
$query="SET NAMES 'UTF8'";
mysql_query($query);*/
//$email = mysql_real_escape_string($_GET['kime']);
//$firmaid = mysql_real_escape_string($_GET['id']);
//$firmaid=intval(trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256,md5("artusa"),base64_decode(urldecode($_GET['c'])),MCRYPT_MODE_ECB)));
$firmaid=intval(trim(base64_decode(urldecode(isset($_GET['c']) ? $_GET['c'] : ''))));
//$idate=date("Ymd");

$sql="SELECT email,firmaid FROM bilgi WHERE firmaid=$firmaid";
$result = mysqli_query($coni,$sql) or die ("Couldn't execute SQL query");
$etki=mysqli_num_rows($result);
if($etki){
	while($row=mysqli_fetch_array($result)){
	$sql = "update bilgi set tekliftopla='0' where firmaid=$firmaid LIMIT 1";
	mysqli_query($coni,$sql) or die(mysqli_error($coni));
	$sqla = "REPLACE INTO unsubslist SET undate=now(), firmaid=$firmaid";
	mysqli_query($coni,$sqla) or die(mysqli_error($coni));
	session_destroy ();
	header("location:kaysilpostaok.php");
	exit;
	}
}
else{

session_destroy ();?>
<script type='text/javascript'>alert("Hata");
<?php
	header("location:index.php");
	exit;
?>
</script> 
<?php
}
?>