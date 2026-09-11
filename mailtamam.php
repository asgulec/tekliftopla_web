<?php
ob_start();
include "ayar.php";
session_start();

function redirect_to($target)
{
    if (!headers_sent()) {
        header("Location: {$target}");
        exit;
    }

    echo "<script type='text/javascript'>window.location = '{$target}';</script>";
    exit;
}

$connection = mysqli_connect($host, $user, $password, $db);
if (!$connection) {
    redirect_to('mailcontrol.php');
}
mysqli_set_charset($connection, "utf8");

if (!isset($_SESSION["verified_pass"]) || !isset($_SESSION["verified_user"])) {
    redirect_to('index.php');
}

$teklifid = filter_input(INPUT_GET, 'teklifid', FILTER_VALIDATE_INT);
if ($teklifid === null || $teklifid === false || $teklifid <= 0) {
    redirect_to('mailcontrol.php');
}

$query = "UPDATE kullanim SET tamam = '1', readable = '1' WHERE Kullanimid = ?";
$stmt = mysqli_prepare($connection, $query);
if ($stmt === false) {
    redirect_to('mailcontrol.php');
}

mysqli_stmt_bind_param($stmt, "i", $teklifid);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

redirect_to('mailcontrol.php');
