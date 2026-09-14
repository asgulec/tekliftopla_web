<?php
include"ayar.php";
session_start();
$connection=mysqli_connect($host,$user,$password,$db);
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
mysqli_set_charset($connection,"utf8");

if(!isset($_SESSION["verified_firmaid"]) || !isset($_SESSION["verified_sifrem"])){
	header("Location: index.php");
	exit;
}
$verified_firmaid = $_SESSION["verified_firmaid"];
?>
