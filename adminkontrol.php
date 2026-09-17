<?php
ini_set("display_errors", 1);
include "ayar.php";
session_start();

$link = mysqli_connect($host, $user, $password, $db);
if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}
mysqli_set_charset($link, "utf8");

$pass = isset($_POST["pass"]) ? trim($_POST["pass"]) : '';
$username = isset($_POST["username"]) ? trim($_POST["username"]) : '';

$stmt = mysqli_prepare($link, "SELECT password, username, yonid, KullaniciEkleme FROM yonetim WHERE password = ? AND username = ?");
$result1 = false;
$etki1 = 0;

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "ss", $pass, $username);
    mysqli_stmt_execute($stmt);
    $result1 = mysqli_stmt_get_result($stmt);
    if ($result1) {
        $etki1 = mysqli_num_rows($result1);
    }
}

if ($etki1 > 0) {
    while ($row1 = mysqli_fetch_array($result1)) {
        $_SESSION["verified_pass"] = $row1['password'];
        $_SESSION["verified_user"] = $row1['username'];
        $_SESSION["verified_yonid"] = $row1['yonid'];
        $_SESSION["KulEkle"] = $row1['KullaniciEkleme'];
        if ($stmt) {
            mysqli_stmt_close($stmt);
        }
        mysqli_close($link);
        header("location:yonetimgiris.php");
        exit;
    }
} else {
    if ($stmt) {
        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
?>
<script type='text/javascript'>alert("Hata");
window.history.back()
</script>
<?php
}
?>
