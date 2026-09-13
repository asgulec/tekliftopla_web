<?
include"../ayar.php";
session_start();
$connection=mysqli_connect($host,$user,$password,$db);
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
mysqli_set_charset($connection,"utf8");
/*$link=mysql_connect($host,$user,$password)or die ("Unable to connect to MySQL server.");
$query="SET NAMES 'UTF8'";
mysql_query($query);
session_start();*/
$sifre = isset($_POST["sifre"]) ? trim($_POST["sifre"]) : '';
$email = isset($_POST["email"]) ? trim($_POST["email"]) : '';

$sql1 = "SELECT sifre, email, firmaid, Firma_Adi FROM bilgi WHERE sifre = ? AND email = ? AND aktivite = '0'";
$stmt1 = mysqli_prepare($connection, $sql1);
$result1 = false;
$etki1 = 0;
if ($stmt1) {
    mysqli_stmt_bind_param($stmt1, 'ss', $sifre, $email);
    mysqli_stmt_execute($stmt1);
    $result1 = mysqli_stmt_get_result($stmt1);
    $etki1 = mysqli_num_rows($result1);
}

if ($etki1) {
    while ($row1 = mysqli_fetch_array($result1)) {
        $verified_firmaid = $row1['firmaid'];
        $_SESSION['verified_firmaid'] = $verified_firmaid;
        $verified_email = $row1['email'];
        $_SESSION['verified_email'] = $verified_email;
        $verified_sifrem = $row1['sifre'];
        $_SESSION['verified_sifrem'] = $verified_sifrem;
        $firma = $row1['Firma_Adi'];
        $verified_firma = $firma;
        $_SESSION['verified_firma'] = $verified_firma;
        header("location:aktiv-e.php");
        exit;
    }
}

$sql = "SELECT sifre, email, firmaid, Firma_Adi FROM bilgi WHERE sifre = ? AND email = ? AND aktivite = '1'";
$stmt = mysqli_prepare($connection, $sql);
$result = false;
$etki = 0;
if ($stmt) {
    mysqli_stmt_bind_param($stmt, 'ss', $sifre, $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $etki = mysqli_num_rows($result);
}

if ($etki) {
    while ($row = mysqli_fetch_array($result)) {
        $verified_email = $row['email'];
        $_SESSION['verified_email'] = $verified_email;
        $verified_sifrem = $row['sifre'];
        $_SESSION['verified_sifrem'] = $verified_sifrem;
        $verified_firmaid = $row['firmaid'];
        $_SESSION['verified_firmaid'] = $verified_firmaid;
        $firma = $row['Firma_Adi'];
        $verified_firma = $firma;
        $_SESSION['verified_firma'] = $verified_firma;
        header("location:giris-e.php");
    }
} else {
    header("location:index-e.php?sonuc=epostayok");
}
?>
