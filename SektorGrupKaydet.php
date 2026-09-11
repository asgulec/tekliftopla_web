<?php include "headeryon.php";      
	//include "ayar.php";
	/*$link=mysql_connect($host,$user,$password) or die ("Unable to connect to MySQL server.");
	$query="SET NAMES 'UTF8'";
mysql_query($query);*/
	 if ($_POST["Durum"] ==2)
	 {
		$sorgu =  mysqli_query($coni, "UPDATE sektor_grup SET " .
	                      " sektorgrup='".mysqli_real_escape_string($coni,$_POST["Adi"]) . "'" .
						  " Where sektorgrupid=". mysqli_real_escape_string($coni,$_POST["Id"]) );
	}
	else 	 if ($_POST["Durum"] ==1)
	{
		$sorgu =  mysqli_query($coni, "Insert Into sektor_grup(sektorgrup) Values( " .
	                      "'" .mysqli_real_escape_string($coni,$_POST["Adi"]) . "' )");
	}
	else    if ($_POST["Durum"] ==3)
	   		{ 
		     $sorgu = mysqli_query($coni,"Delete from sektor_grup where sektorgrupid='".mysqli_real_escape_string($coni,$_POST["Id"])."'");
 			}
	header("Location:SektorGrupListe.php");
?>	 
