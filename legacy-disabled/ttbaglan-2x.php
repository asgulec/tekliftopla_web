<?php
include "ayar.php";
$SQLKEY = "q1w2e3";
header('Cache-Control: no-cache, must-revalidate');

if (isset($_GET["vemail"]) && isset($_GET["key"])) {
    $link = mysqli_connect($host, $user, $password, $db);
    if (!$link) {
        echo "{'suncces':'2','massege':'Data Not Save, Try Again'}";
        exit;
    }
    mysqli_set_charset($link, "utf8");

    $key = urldecode($_GET["key"]);
    if ($key == $SQLKEY) {
        $xe = isset($_GET["vemail"]) ? trim(urldecode($_GET["vemail"])) : '';
        $xi = isset($_GET["vuser"]) ? trim(urldecode($_GET["vuser"])) : '';
        $xc = isset($_GET["vcountryid"]) ? trim(urldecode($_GET["vcountryid"])) : '';
        $xs = isset($_GET["vcityid"]) ? trim(urldecode($_GET["vcityid"])) : '';
        $ot = isset($_GET["vdate"]) ? trim(urldecode($_GET["vdate"])) : '';
        $xt = date("Y-m-d", strtotime($ot));
        $xd = date("Y-m-d", time());
        $xsr = isset($_GET["dsure"]) ? trim(urldecode($_GET["dsure"])) : '';
        $xm = isset($_GET["dtext"]) ? trim(urldecode($_GET["dtext"])) : '';

        // Get country iso3
        $ulkeiso = '';
        $stmt_c = mysqli_prepare($link, "SELECT iso3 FROM country WHERE id = ?");
        if ($stmt_c) {
            mysqli_stmt_bind_param($stmt_c, "s", $xc);
            mysqli_stmt_execute($stmt_c);
            $ulkeres = mysqli_stmt_get_result($stmt_c);
            if ($ulkeres && ($ulkear = mysqli_fetch_array($ulkeres))) {
                $ulkeiso = $ulkear[0];
            }
            mysqli_stmt_close($stmt_c);
        }

        // Check if user exists
        $kadet = 0;
        $stmt_k = mysqli_prepare($link, "SELECT email FROM bilgi WHERE email = ?");
        if ($stmt_k) {
            mysqli_stmt_bind_param($stmt_k, "s", $xe);
            mysqli_stmt_execute($stmt_k);
            $kontres = mysqli_stmt_get_result($stmt_k);
            if ($kontres) {
                $kadet = mysqli_num_rows($kontres);
            }
            mysqli_stmt_close($stmt_k);
        }

        if (!$kadet) {
            $seed = str_split('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789');
            shuffle($seed);
            $rand = '';
            foreach (array_rand($seed, 6) as $k) $rand .= $seed[$k];
            $presult = $rand;

            $sehir = '';
            $stmt_s = mysqli_prepare($link, "SELECT sehir FROM sehir WHERE sehirid = ?");
            if ($stmt_s) {
                mysqli_stmt_bind_param($stmt_s, "s", $xs);
                mysqli_stmt_execute($stmt_s);
                $resultb = mysqli_stmt_get_result($stmt_s);
                if ($resultb && ($rowb = mysqli_fetch_array($resultb))) {
                    $sehir = $rowb[0];
                }
                mysqli_stmt_close($stmt_s);
            }

            $stmt_ins = mysqli_prepare($link, "INSERT INTO bilgi (Tarih, Firma_Adi, Sehir, email, sifre, aktivite, iletisim, lisan, tekliftopla, Tur, kaydeden, proflag, ulke) VALUES (?, ?, ?, ?, ?, '1', 'E-Posta', 'Evet', '0', 'Kullanıcı', '1', '0', ?)");
            if ($stmt_ins) {
                mysqli_stmt_bind_param($stmt_ins, "ssssss", $xd, $xi, $sehir, $xe, $presult, $ulkeiso);
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
                $firmaid = (int)$rowa[0];
            }
            mysqli_stmt_close($stmt_f);
        }

        $xdil = "TUR";
        if ($ulkeiso !== 'TUR') {
            $xs = "999";
            $xdil = "ENG";
        }

        $seed = str_split('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789');
        shuffle($seed);
        $rand = '';
        foreach (array_rand($seed, 20) as $k) $rand .= $seed[$k];
        $pses = $rand;

        $stmt_kul = mysqli_prepare($link, "INSERT INTO kullanim (firmaid, iletisim, tarih, sure, text, session, sehirid, date, time, tamam, readable, aktif, FirmaEPosta, mesajsay, ulke, dil) VALUES (?, 'E-Posta', ?, ?, ?, ?, ?, ?, '10:00:00', '0', '0', '1', ?, '3000', ?, ?)");
        if ($stmt_kul) {
            mysqli_stmt_bind_param($stmt_kul, "isssssssss", $firmaid, $xt, $xsr, $xm, $pses, $xs, $xd, $xe, $ulkeiso, $xdil);
            mysqli_stmt_execute($stmt_kul);
            mysqli_stmt_close($stmt_kul);
        }

        $subject = "Bekleyen teklif talebi var !!!";
        $message = $xi . "\n \n" . $ulkeiso . "\n \n" . $xs . "\n \n" . $xm;
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
        $mail->Fromname = "tekliftopla";
        $mail->Send();

        echo "{'suncces':'1','massege':'successfuly save'}";
        mysqli_close($link);
    } else {
        mysqli_close($link);
        echo "{'suncces':'0','massege':'Something went Wrong, Try Again'}";
    }
} else {
    echo "{'suncces':'0','massege':'Something went Wrong, Try Again'}";
}
?>