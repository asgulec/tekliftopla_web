<?php
include "headeri.php";

if (!isset($_SESSION["verified_firmaid"]) || !isset($_SESSION["verified_sifrem"])) {
?>
<script type='text/javascript'>alert("Hata");</script>
<?php
} else {
    $verified_firmaid = (int)$_SESSION["verified_firmaid"];
    $tur = isset($_POST["tur"]) ? $_POST["tur"] : '';

    switch ($tur) {
        // kullanımdan gelen bilgiyi ekleme;
        case 'f':
            $fax_alankodu = isset($_POST["fax_alankodu"]) ? trim($_POST["fax_alankodu"]) : '';
            $Fax = isset($_POST["Fax"]) ? trim($_POST["Fax"]) : '';
            $stmt = mysqli_prepare($connection, "UPDATE bilgi SET fax_alankodi = ?, Fax = ? WHERE firmaid = ?");
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "ssi", $fax_alankodu, $Fax, $verified_firmaid);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
            }
            header("location:kullanimgor.php");
            exit;

        case 't':
            $tel_alankodu = isset($_POST["tel_alankodu"]) ? trim($_POST["tel_alankodu"]) : '';
            $Telefon = isset($_POST["Telefon"]) ? trim($_POST["Telefon"]) : '';
            $stmt = mysqli_prepare($connection, "UPDATE bilgi SET tel_alankodi = ?, Telefon = ? WHERE firmaid = ?");
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "ssi", $tel_alankodu, $Telefon, $verified_firmaid);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
            }
            header("location:kullanimgor.php");
            exit;

        case 'p':
            $Adres = isset($_POST["Adres"]) ? trim($_POST["Adres"]) : '';
            $stmt = mysqli_prepare($connection, "UPDATE bilgi SET Adres = ? WHERE firmaid = ?");
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "si", $Adres, $verified_firmaid);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
            }
            header("location:kullanimgor.php");
            exit;

        default:
            header("location:kullanim.php");
            exit;
    }
}
?>