<?php
include"ayar.php";
$SQLKEY="1qazcde3";
header('Cache-Control: no-cache, must-revalidate');

// error_log(print_r($_POST,TRUE));

if( isset($_POST["xe"]) && isset($_POST["key"]) ){  //checks ifthe tag post is there and if its been a proper form post

$link = mysqli_connect($host,$user,$password,$db);
		//if (!$connection) {
    		//die("Connection failed: " . mysqli_connect_error());
		//	}
		mysqli_set_charset($link,"utf8");
		$key=mysqli_real_escape_string($link,urldecode($_POST["key"]));
		if($key==$SQLKEY){          ///validate the SQL key
              $xe=mysqli_real_escape_string($link,urldecode($_POST["xe"]));
              $xi=mysqli_real_escape_string($link,urldecode($_POST["xi"]));
              $xs=mysqli_real_escape_string($link,urldecode($_POST["xs"]));
              $ot=mysqli_real_escape_string($link,urldecode($_POST["xt"]));
              $xt=date("Y-m-d", strtotime($ot));
			  $xd=date("Y-m-d", time());
			  $xsr=mysqli_real_escape_string($link,urldecode($_POST["xsr"]));
              $xm=mysqli_real_escape_string($link,urldecode($_POST["xm"]));
              $link = mysqli_connect($host,$user,$password,$db) ;  //connect ot the MYSQL database
              //mysqli_select_db($db,$link);                        //connect to the right DB
              if($link){
               		  /* $ekle="INSERT INTO andkullan (akdate, akeposta, akisim, aksehir, aktarih, aksure, akmetin) VALUES ('$xd', '$xe', '$xi', '$xs', '$xt', '$xsr', '$xm')";
                      $sonuc=mysql_query("$ekle");*/                  //runs the posted query (NO PROTECTION FROM INJECTION HERE)
                      $kontrol="SELECT email FROM bilgi WHERE email='$xe' ";
                      $kontres=mysqli_query($link,$kontrol);
                      $kadet=mysqli_num_rows($kontres);
                      if(!$kadet){
                         $chars = str_shuffle('abcdefghijkmnopqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ0123456789');
                         $count = mb_strlen($chars);
                         $length=6;
	                     for ($i = 0, $presult = ''; $i < $length; $i++) {
                           $index = rand(0, $count - 1);
                           $presult .= mb_substr($chars, $index, 1);
                           }
                         $ekle="INSERT INTO bilgi (Tarih, Firma_Adi, Sehir, email, sifre, aktivite, iletisim, lisan, tekliftopla, Tur, kaydeden, proflag) VALUES ('$xd', '$xi', '$xs', '$xe', '$presult', '1', 'E-Posta', 'Evet', '0', 'Kullanıcı', '1', '0')";
                         $sonuc=mysqli_query($link,$ekle);
                         }
                      $resulta = mysqli_query($link,"SELECT firmaid FROM bilgi WHERE email='$xe'");
                      $rowa = mysqli_fetch_array($resulta);
                      $firmaid=$rowa[0];
                      $resultb = mysqli_query($link,"SELECT sehirid FROM sehir WHERE sehir='$xs'");
                      $rowb = mysqli_fetch_array($resultb);
                      $sehirid=$rowb[0];
                      $chars = str_shuffle('abcdefghijkmnopqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ0123456789');
                         $count = mb_strlen($chars);
                         $length=20;
	                     for ($i = 0, $pses = ''; $i < $length; $i++) {
                           $index = rand(0, $count - 1);
                           $pses .= mb_substr($chars, $index, 1);
                           }
					  
					  // $i=date("h:i:s"); 
					  $ekleb="INSERT INTO kullanim (firmaid, iletisim, tarih, sure, text, session, sehirid, date, time, tamam, readable, aktif, FirmaEPosta, mesajsay) VALUES ('$firmaid', 'E-Posta', '$xt', '$xsr', '$xm', '$pses', '$sehirid', '$xd', '10:00:00', '0', '0', '1', '$xe', '3000')";
                      $sonucb=mysqli_query($link,$ekleb);
					  $subject = "Bekleyen teklif talebi var...";
                     $message = $xi."\n \n".$xs."\n \n".$xm;
                     require_once("class.phpmailer.php"); //Require file
	                  $mail = new PHPMailer();
					      $mail->AddAddress("gulec59-g@yahoo.com","ASG");
   					   //$mail->AddAddress("gulecme@gmail.com","MAG");
				         $mail->Subject 	= $subject;
					      $mail->Body		= $message;
			            $mail->IsSMTP();
	                  $mail->SMTPAuth = true;
	                  $mail->Username = "info@tekliftopla.com"; //Kullanýcý Adý
	                  $mail->Password = $infopass; //Þifre
	                  //$mail->Port = 587;
	                  $mail->IsHTML(false);
	                  $mail->CharSet = "UTF-8";
	                  $mail->From 	= "info@tekliftopla.com";
	                  $mail->Fromname = "tekliftopla";
	                  $mail->Send();
					  header("HTTP/1.0 200");
					  mysqli_close($link);     //close the DB
               } 
		      else {header("HTTP/1.0 400 Bad Request");} 
		}
        else {header("HTTP/1.0 400 Bad Request");} 
}
else {header("HTTP/1.0 400 Bad Request");}
?>
