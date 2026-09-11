<?php

//DATABSE DETAILS//
$DB_ADDRESS="localhost";
$DB_USER="teklifto_nadeem";
$DB_PASS="q1w2e3e3!!";
$DB_NAME="teklifto_ttdeneme";

$SQLKEY="q1w2e3e3";


//error_log(print_r($_GET,TRUE));

if( isset($_GET["vemail"]) && isset($_GET["key"]) ){  //checks ifthe tag post is there and if its been a proper form post
/*$link = mysql_connect($DB_ADDRESS,$DB_USER,$DB_PASS) or die("no connection");
        $query="SET NAMES UTF8";
		mysql_query($query);*/
		$coni = mysqli_connect($DB_ADDRESS,$DB_USER,$DB_PASS,$DB_NAME);
		//if (mysqli_connect_errno())
   		//{
   		//echo "Failed to connect to MySQL: " . mysqli_connect_error();
   		//} 
		mysqli_set_charset($coni,"utf8");
		$key=$_GET["key"];
		if($key==$SQLKEY){          ///validate the SQL key
              $xe=$_GET["vemail"];
              $xi=$_GET["vuser"];
              $xc=$_GET["vcountryid"];
              $xs=$_GET["vcityid"];
              $ot=$_GET["vdate"];
              $xt=date("Y-m-d", strtotime($ot));
	      $xd=date("Y-m-d", time());
	      $xsr=$_GET["dsure"];
              $xm=$_GET["dtext"];
              //$coni = mysqli_connect($DB_ADDRESS,$DB_USER,$DB_PASS,$DB_NAME);  //connect to the MYSQL database
              if($coni){
               	      $ekle="INSERT INTO andkullan (akdate, akeposta, akisim, akulke, aksehir, aktarih, aksure, akmetin) VALUES ('$xd', '$xe', '$xi', '$xc', '$xs', '$xt', '$xsr', '$xm')";
                      $sonuc=mysqli_query($coni,$ekle);     //runs the posted query (NO PROTECTION FROM INJECTION HERE)
                      $subject = "tekliftopla test message ...";
                      $message = $xe."\n \n".$xi."\n \n".$xc."\n \n".$xs."\n \n".$xt."\n \n".$xsr."\n \n".$xm;
                      require_once("class.phpmailer.php"); //Require file
	                  $mail = new PHPMailer();
			  $mail->AddAddress("gulec59-g@yahoo.com","ASG");
   			  //$mail->AddAddress("maliknadeemasghar03@gmail.com","Nadeem");
		          $mail->Subject	= $subject;
			  $mail->Body= $message;
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

	                  echo "{'suncces':'1','massege':'successfuly save'}";
			
			  
			  mysqli_close($coni);     //close the DB
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