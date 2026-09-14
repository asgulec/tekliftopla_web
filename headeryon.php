<?php
include "ayar.php";
session_start();

$coni = mysqli_connect($host, $user, $password, $db);
if (!$coni) {
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}

mysqli_set_charset($coni, "utf8");

if (!isset($_SESSION["verified_pass"]) || !isset($_SESSION["verified_user"])) {
    header("Location: index.php");
    exit;
}

$verified_user = $_SESSION["verified_user"] ?? '';
?>