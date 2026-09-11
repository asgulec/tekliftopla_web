<?php include "headeryon.php";
	/*include "ayar.php";
	$link=mysql_connect($host,$user,$password) or die ("Unable to connect to MySQL server.");
	$query="SET NAMES 'UTF8'";
mysql_query($query);*/
	 if ($_POST["Durum"]==2)
	 {
		$sorgu =  mysqli_query($coni, "UPDATE sektor_sektorgrup SET " .
	                      " sektorid =".mysqli_real_escape_string($coni,$_POST["IsKolu"]) . "," .
	                      " sektorgrupid =".mysqli_real_escape_string($coni,$_POST["SektorGrup"]) .  
						  " Where id=". mysqli_real_escape_string($coni,$_POST["Id"]) );
//		$sorgu =  mysql_db_query($db, "UPDATE sektorler SET " .
//	                      " sektor ='".$_POST["Adi"] . "'" .
//						  " Where sektorid=". $_POST["IsKoluId"] );
	}
	else 	 if ($_POST["Durum"] ==1)
	{
//		$sorgu =  mysql_db_query($db, "Insert Into sektorler(sektor) Values( " .
//	                      "'" . $_POST["Adi"] . "')");

// 	   $sorgu = mysql_query("SELECT sektorid FROM sektorler Where  " .
//						  " sektor='". $_POST["Adi"] ."'" )
//		      or die("Invalid query: ".mysql_error());
//	   $row=mysql_fetch_array($sorgu);

		$sorgu =  mysqli_query($coni, "Insert Into sektor_sektorgrup(sektorid,sektorgrupid) Values( " .
	              mysqli_real_escape_string($coni,$_POST["IsKolu"]). ",". 
				  mysqli_real_escape_string($coni,$_POST["SektorGrup"]) . ")");
	}
	else    if ($_POST["Durum"] ==3)
	   		{ 
		     $sorgu = mysqli_query($coni,"Delete from sektor_sektorgrup where id=".mysqli_real_escape_string($coni,$_POST["Id"]));
//		     $sorgu = mysql_db_query($db,"Delete from sektorler where id=".$_POST["IsKoluId"]);
 			}
	header("Location:IsKoluListe.php");
?>	 
