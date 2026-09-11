<?php
include"ayar.php";
$SQLKEY="q1w2e3";
header('Cache-Control: no-cache, must-revalidate');
// AKTİF OLAN php
// error_log(print_r($_POST,TRUE));

if( isset($_GET["vemail"]) && isset($_GET["key"]) ){  //checks ifthe tag post is there and if its been a proper form post

$link =mysqli_connect($host,$user,$password,$db);
mysqli_set_charset($link,"utf8");

		$key=mysqli_real_escape_string($link,urldecode($_GET["key"]));
		if($key==$SQLKEY){          ///validate the SQL key
                $xe=mysqli_real_escape_string($link,urldecode($_GET["vemail"]));
                $xi=mysqli_real_escape_string($link,urldecode($_GET["vuser"]));
                $xc=mysqli_real_escape_string($link,urldecode($_GET["vcountryid"]));
                $xs=mysqli_real_escape_string($link,urldecode($_GET["vcityid"]));
                $ot=mysqli_real_escape_string($link,urldecode($_GET["vdate"]));
                $xt=date("Y-m-d", strtotime($ot));
	        $xd=date("Y-m-d", time());
		$xsr=mysqli_real_escape_string($link,urldecode($_GET["dsure"]));
                $xm=mysqli_real_escape_string($link,urldecode($_GET["dtext"]));
                //$link = mysqli_connect($host,$user,$password,$db) ;  //connect ot the MYSQL database
               //mysql_select_db($db,$link);                        //connect to the right DB
               if($link){
               		  
                      $ulkekont="SELECT iso3 FROM country WHERE id='$xc' ";
                      $ulkeres = mysqli_query($link,$ulkekont);
                      $ulkear = mysqli_fetch_array($ulkeres);
                      $ulkeiso=$ulkear[0];                      
                      $kontrol="SELECT email FROM bilgi WHERE email='$xe' ";
                      $kontres=mysqli_query($link,$kontrol);
                      $kadet=mysqli_num_rows($kontres);
                      if(!$kadet){
                         /* $ekle="INSERT INTO andkullan (akdate, akeposta, akisim, akulke, aksehir, aktarih, aksure, akmetin) VALUES ('$xd', '$xe', '$xi', '$xc', '$xs', '$xt', '$xsr', '$xm')";
                      $sonuc=mysql_query("$ekle"); */                  //runs the posted query (NO PROTECTION FROM INJECTION HERE)
                      $seed = str_split('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'); // and any other characters
                      shuffle($seed); // probably optional since array_is randomized; this may be redundant
                      $rand = '';
                      foreach (array_rand($seed, 6) as $k) $rand .= $seed[$k];
                      $presult=$rand;
                         $resultb = mysqli_query($link,"SELECT sehir FROM sehir WHERE sehirid='$xs'");
                         $rowb = mysqli_fetch_array($resultb);
                         $sehir=$rowb[0];
			 $ekle="INSERT INTO bilgi (Tarih, Firma_Adi, Sehir, email, sifre, aktivite, iletisim, lisan, tekliftopla, Tur, kaydeden, proflag, ulke) VALUES ('$xd', '$xi', '$sehir', '$xe', '$presult', '1', 'E-Posta', 'Evet', '0', 'Kullanıcı', '1', '0','$ulkeiso')";
                         $sonuc=mysqli_query($link,$ekle);
                         }
                      $resulta = mysqli_query($link,"SELECT firmaid FROM bilgi WHERE email='$xe'");
                      $rowa = mysqli_fetch_array($resulta);
                      $firmaid=$rowa[0];
                      $xdil="TUR";
                      if ($ulkeiso!=='TUR')
                      	{$xs=999;
                      	 $xdil="ENG"; }
                                           
                      $seed = str_split('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'); // and any other characters
                      shuffle($seed); // probably optional since array_is randomized; this may be redundant
                      $rand = '';
                      foreach (array_rand($seed, 20) as $k) $rand .= $seed[$k];
                      $pses=$rand;
                      /* $chars = str_shuffle('abcdefghijkmnopqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ0123456789');
                         $count = mb_strlen($chars);
                         $length=20;
	                     for ($i = 0, $pses = ''; $i < $length; $i++) {
                           $index = rand(0, $count - 1);
                           $pses .= mb_substr($chars, $index, 1);
                           } */
                      $ekleb="INSERT INTO kullanim (firmaid, iletisim, tarih, sure, text, session, sehirid, date, time, tamam, readable, aktif, FirmaEPosta, mesajsay, ulke, dil) VALUES ('$firmaid', 'E-Posta', '$xt', '$xsr', '$xm', '$pses', '$xs', '$xd', '10:00:00', '0', '0', '1', '$xe', '3000', '$ulkeiso', '$xdil')";
                      $sonucb=mysqli_query($link,$ekleb);
                      $subject = "Bekleyen teklif talebi var !!!";
                      $message = $xi."\n \n".$ulkeiso."\n \n".$xs."\n \n".$xm;
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
	                  
	                  echo "{'suncces':'1','massege':'successfuly save'}";
					  mysqli_close($link);     //close the DB
               } 
		      else {
		      	echo "{'suncces':'2','massege':'Data Not Save, Try Again'}";
		           } 
		}
        else {
        	echo "{'suncces':'0','massege':'Something went Wrong, Try Again'}";
        	} 
}
else
{
	echo "{'suncces':'0','massege':'Something went Wrong, Try Again'}";
}


?>