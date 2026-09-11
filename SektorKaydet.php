<?      
	include "ayar.php";
	/*$link=mysql_connect($host,$user,$password) or die ("Unable to connect to MySQL server.");
	$query="SET NAMES 'UTF8'";
mysql_query($query);*/
$coni = mysqli_connect($host,$user,$password,$db);
if (mysqli_connect_errno())
   {
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
   } 
mysqli_set_charset($coni,"utf8");

	 if ($_POST["Durum"] ==2)
	 {
		$sorgu =  mysqli_query($coni, "UPDATE sektorler SET " .
	                      " sektor='".mysqli_real_escape_string($coni,$_POST["Sektor"]) ."'".
						  " Where sektorid=". mysqli_real_escape_string($coni,$_POST["Id"]) );
	}
	else 	 if ($_POST["Durum"] ==1)
	{
		$isim= mysqli_real_escape_string($coni,$_POST["Sektor"]);
		$sorgu =  mysqli_query($coni, "Insert Into sektorler (sektor) Values( '$isim')");
		$yenisek= mysqli_query($coni, "select sektorid from sektorler where sektor='$isim'");
		$sekid = mysqli_fetch_array($yenisek);
		$id=$sekid['sektorid'];
		$yenitum = mysqli_query($coni, "Insert Into sektor_sektorgrup (sektorid, sektorgrupid) values( '$id', '26')");
	}
	else    if ($_POST["Durum"] ==3)
	   		{ 
		     $sorgu = mysqli_query($coni,"Delete from sektorler where sektorid='".mysqli_real_escape_string($coni,$_POST["Id"])."'");
			 $eslesme= mysqli_query($coni,"Delete from sektor_sektorgrup where sektorid='".mysqli_real_escape_string($coni,$_POST["Id"])."'");
 			}
	header("Location:SektorListe.php");
?>	 
