<?php

ob_start();

session_start();

set_time_limit(0);



include"ayar.php";



/*$connection=mysql_connect("$host","$user","$password") or die ("Could not connect to the MySQL Server");

$query="SET NAMES 'UTF8'";

mysql_select_db($db);

mysql_query($query); */



$connection=mysqli_connect($host,$user,$password,$db);

if (!$connection) {

    die("Connection failed: " . mysqli_connect_error());

}

mysqli_set_charset($connection,"utf8");



error_reporting(63);

include("class.phpmailer.php");



mysqli_query($connection,"delete from mail_que2 where retry>3");



$r=mysqli_query($connection,"select id,email,konu,mesaj from mail_que2 order by id asc limit 0,50");

$n=mysqli_num_rows($r);

$mesaj0="";



for($i=0;$i<$n;$i++) {

		list($id,$email,$konu,$mesaj)=mysqli_fetch_array($r);

		$email=stripslashes($email);

		$konu=stripslashes($konu);

		$mesaj=stripslashes($mesaj);

		

		$mail = new PHPMailer();

	    $mail->AddAddress($email,$email);

        $mail->Subject 	= $konu;

	    $mail->Body		= $mesaj;

	    $mail->IsSMTP();

	    $mail->Hostname = "www.tekliftopla.com"; // deneme için kondu

	    $mail->SMTPAuth = true;

	    $mail->Username = "info@tekliftopla.com"; //Kullanýcý Adý

	    $mail->Password = $infopass; //Þifre

	    //$mail->Port = 587;

		$mail->IsHTML(true);
		$mail->Encoding = "base64";

	    $mail->CharSet = "UTF-8";

	    $mail->From 	= "info@tekliftopla.com";

	    $mail->Fromname = "tekliftopla";

	    $mail_sent=$mail->Send();

		

		if(!$mail_sent)

			mysqli_query($connection,"update mail_que2 set retry=retry+1 where id=$id");

		else

			mysqli_query($connection,"delete from mail_que2 where id=$id");

		

		unset($mail);

}

exit;

?>