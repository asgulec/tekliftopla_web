<? include "headeryon.php";     
	/*include "ayar.php";
	$link=mysql_connect($host,$user,$password) or die ("Unable to connect to MySQL server.");
	$query="SET NAMES 'UTF8'";
mysql_query($query);*/
	 if ($_POST["Durum"] ==2)
	 {
		$sorgu =  mysqli_query($coni, "UPDATE yonetim SET " .
	                      " username='".mysqli_real_escape_string($coni,$_POST["username"]) ."',".
	                      " password='".mysqli_real_escape_string($coni,$_POST["password"]) ."' ,".
						  " KullaniciEkleme=". mysqli_real_escape_string($coni,$_POST["kullaniciekleme"]).
						  " Where yonid=". mysqli_real_escape_string($coni,$_POST["Id"]) );
	}
	else 	 if ($_POST["Durum"] ==1)
	{
		$sorgu =  mysqli_query($coni, "Insert Into yonetim (username,password,KullaniciEkleme) Values( " .
	                      "'" .mysqli_real_escape_string($coni,$_POST["username"]) ."',".
	                      "'" .mysqli_real_escape_string($coni,$_POST["password"]) ."',".
						  mysqli_real_escape_string($coni,$_POST["kullaniciekleme"]). " )");
	}
	else    if ($_POST["Durum"] ==3)
	   		{ 
		     $sorgu = mysqli_query($coni,"Delete from yonetim where yonid='".mysqli_real_escape_string($coni,$_POST["Id"])."'");
 			}
	header("Location:YoneticiEkleListe.php");
?>	 
