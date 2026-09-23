<?php
include "ayar.php";
$SQLKEY = "1qazcde3";
header('Cache-Control: no-cache, must-revalidate');

if (isset($_POST["xe"]) && isset($_POST["key"])) {
    $link = mysqli_connect($host, $user, $password, $db);
    if (!$link) {
        header("HTTP/1.0 400 Bad Request");
        exit;
    }
    mysqli_set_charset($link, "utf8");

    $key = urldecode($_POST["key"]);
    if ($key == $SQLKEY) {
        $xe = isset($_POST["xe"]) ? trim(urldecode($_POST["xe"])) : '';
        $xi = isset($_POST["xi"]) ? trim(urldecode($_POST["xi"])) : '';
        $xs = isset($_POST["xs"]) ? trim(urldecode($_POST["xs"])) : '';
        $ot = isset($_POST["xt"]) ? trim(urldecode($_POST["xt"])) : '';
        $xt = date("Y-m-d", strtotime($ot));
        $xd = date("Y-m-d", time());
        $xsr = isset($_POST["xsr"]) ? trim(urldecode($_POST["xsr"])) : '';
        $xm = isset($_POST["xm"]) ? trim(urldecode($_POST["xm"])) : '';
        $vlanguage = isset($_POST["vlanguage"]) ? strtolower(trim(urldecode($_POST["vlanguage"]))) : '';

        // Check if email exists
        $kadet = 0;
        $stmt = mysqli_prepare($link, "SELECT email FROM bilgi WHERE email = ?");
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $xe);
            mysqli_stmt_execute($stmt);
            $kontres = mysqli_stmt_get_result($stmt);
            if ($kontres) {
                $kadet = mysqli_num_rows($kontres);
            }
            mysqli_stmt_close($stmt);
        }

        if (!$kadet) {
            $chars = str_shuffle('abcdefghijkmnopqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ0123456789');
            $count = mb_strlen($chars);
            $length = 6;
            $presult = '';
            for ($i = 0; $i < $length; $i++) {
                $index = rand(0, $count - 1);
                $presult .= mb_substr($chars, $index, 1);
            }

            $stmt_ins = mysqli_prepare($link, "INSERT INTO bilgi (Tarih, Firma_Adi, Sehir, email, sifre, aktivite, iletisim, lisan, tekliftopla, Tur, kaydeden, proflag) VALUES (?, ?, ?, ?, ?, '1', 'E-Posta', 'Evet', '0', 'Kullanıcı', '1', '0')");
            if ($stmt_ins) {
                mysqli_stmt_bind_param($stmt_ins, "sssss", $xd, $xi, $xs, $xe, $presult);
                mysqli_stmt_execute($stmt_ins);
                mysqli_stmt_close($stmt_ins);
            }
        }

        $firmaid = 0;
        $stmt_f = mysqli_prepare($link, "SELECT firmaid FROM bilgi WHERE email = ?");
        if ($stmt_f) {
            mysqli_stmt_bind_param($stmt_f, "s", $xe);
            mysqli_stmt_execute($stmt_f);
            $resulta = mysqli_stmt_get_result($stmt_f);
            if ($resulta && ($rowa = mysqli_fetch_array($resulta))) {
                $firmaid = (int)$rowa['firmaid'];
            }
            mysqli_stmt_close($stmt_f);
        }

        $sehirid = 0;
        $stmt_s = mysqli_prepare($link, "SELECT sehirid FROM sehir WHERE sehir = ?");
        if ($stmt_s) {
            mysqli_stmt_bind_param($stmt_s, "s", $xs);
            mysqli_stmt_execute($stmt_s);
            $resultb = mysqli_stmt_get_result($stmt_s);
            if ($resultb && ($rowb = mysqli_fetch_array($resultb))) {
                $sehirid = (int)$rowb['sehirid'];
            }
            mysqli_stmt_close($stmt_s);
        }

        $xdil = (preg_match('/^en(?:-|$)/', $vlanguage) || in_array($vlanguage, array('eng', 'english'), true)) ? 'ENG' : 'TUR';

        $chars = str_shuffle('abcdefghijkmnopqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ0123456789');
        $count = mb_strlen($chars);
        $length = 20;
        $pses = '';
        for ($i = 0; $i < $length; $i++) {
            $index = rand(0, $count - 1);
            $pses .= mb_substr($chars, $index, 1);
        }

        $stmt_k = mysqli_prepare($link, "INSERT INTO kullanim (firmaid, iletisim, tarih, sure, text, session, sehirid, date, time, tamam, readable, aktif, FirmaEPosta, mesajsay, ulke, dil) VALUES (?, 'E-Posta', ?, ?, ?, ?, ?, ?, '10:00:00', '0', '0', '1', ?, '3000', 'TUR', ?)");
        if ($stmt_k) {
            mysqli_stmt_bind_param($stmt_k, "issssssss", $firmaid, $xt, $xsr, $xm, $pses, $sehirid, $xd, $xe, $xdil);
            mysqli_stmt_execute($stmt_k);
            mysqli_stmt_close($stmt_k);
        }

        $subject = "Bekleyen teklif talebi var...";
        $message = $xi . "\n \n" . $xs . "\n \n" . $xm;
        require_once("class.phpmailer.php");
        $mail = new PHPMailer();
        $mail->AddAddress("gulec59-g@yahoo.com", "ASG");
        $mail->Subject = $subject;
        $mail->Body = $message;
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->Username = "info@tekliftopla.com";
        $mail->Password = $infopass;
        $mail->IsHTML(false);
        $mail->CharSet = "UTF-8";
        $mail->From = "info@tekliftopla.com";
        $mail->FromName = "tekliftopla";
        $mail->Send();

        header("HTTP/1.0 200");
        mysqli_close($link);
    } else {
        mysqli_close($link);
        header("HTTP/1.0 400 Bad Request");
    }
} else {
    header("HTTP/1.0 400 Bad Request");
}
?>
