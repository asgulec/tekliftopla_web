<?php
/*
 * Written By: ShivalWolf
*/
//DATABSE DETAILS//
$DB_ADDRESS="localhost";
$DB_USER="teklifto_ttdene";
$DB_PASS="q1w2e3e3!!";
$DB_NAME="teklifto_ttdeneme";

$SQLKEY="q1w2e3e3";
header('Cache-Control: no-cache, must-revalidate');

//error_log(print_r($_POST,TRUE));

if( isset($_POST["vemail"]) && isset($_POST["key"]) ){  //checks ifthe tag post is there and if its been a proper form post
/*$link = mysql_connect($DB_ADDRESS,$DB_USER,$DB_PASS) or die("no connection");
        $query="SET NAMES UTF8";
		mysql_query($query);*/
		$coni = mysqli_connect($DB_ADDRESS,$DB_USER,$DB_PASS,$DB_NAME);
		//if (mysqli_connect_errno())
   		//{
   		//echo "Failed to connect to MySQL: " . mysqli_connect_error();
   		//} 
		mysqli_set_charset($coni,"utf8");
		$key=mysqli_real_escape_string($coni,urldecode($_POST["key"]));
		if($key==$SQLKEY){          ///validate the SQL key
              $xe=mysqli_real_escape_string($coni,urldecode($_POST["vemail"]));
              $xi=mysqli_real_escape_string($coni,urldecode($_POST["vuser"]));
              $xc=mysqli_real_escape_string($coni,urldecode($_POST["vcountryid"]));
              $xs=mysqli_real_escape_string($coni,urldecode($_POST["vcityid"]));
              $ot=mysqli_real_escape_string($coni,urldecode($_POST["vdate"]));
              $xt=date("Y-m-d", strtotime($ot));
			  $xd=date("Y-m-d", time());
			  $xsr=mysqli_real_escape_string($coni,urldecode($_POST["dsure"]));
              $xm=mysqli_real_escape_string($coni,urldecode($_POST["dtext"]));
              //$coni = mysqli_connect($DB_ADDRESS,$DB_USER,$DB_PASS,$DB_NAME);  //connect to the MYSQL database
              if($coni){
               		  $ekle="INSERT INTO andkullan (akdate, akeposta, akisim, akulke, aksehir, aktarih, aksure, akmetin) VALUES ('$xd', '$xe', '$xi', '$xc', '$xs', '$xt', '$xsr', '$xm')";
                      $sonuc=mysqli_query($coni,$ekle);     //runs the posted query (NO PROTECTION FROM INJECTION HERE)
                      $subject = "tekliftopla test message ...";
                      $message = $xe."\n \n".$xi."\n \n".$xc."\n \n".$xs."\n \n".$xt."\n \n".$xsr."\n \n".$xm;
                      require_once("class.phpmailer.php"); //Require file
	                  $mail = new PHPMailer();
					  $mail->AddAddress("gulec59-g@yahoo.com","ASG");
   					  $mail->AddAddress("maliknadeemasghar03@gmail.com","Nadeem");
				      $mail->Subject 	= $subject;
					  $mail->Body		= $message;
			          $mail->IsSMTP();
	                  $mail->SMTPAuth = true;
	                  $mail->Username = "info@tekliftopla.com"; //Kullanýcý Adý
	                  $mail->Password = "Reno_1978"; //Þifre
	                  //$mail->Port = 587;
	                  $mail->IsHTML(false);
	                  $mail->CharSet = "UTF-8";
	                  $mail->From 	= "info@tekliftopla.com";
	                  $mail->Fromname = "tekliftopla";
	                  $mail->Send();
					  header("HTTP/1.0 200");
					  mysqli_close($coni);     //close the DB
               } 
		      else {header("HTTP/1.0 400 Bad Request");} 
		}
        else {header("HTTP/1.0 400 Bad Request");} 
}

?>
