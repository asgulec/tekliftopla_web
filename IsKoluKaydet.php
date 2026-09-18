<?php include "headeryon.php";
	/*include "ayar.php";
	$link=mysql_connect($host,$user,$password) or die ("Unable to connect to MySQL server.");
	$query="SET NAMES 'UTF8'";
mysql_query($query);*/
	 if ($_POST["Durum"]==2)
	 {
		$sektorId = filter_var($_POST["IsKolu"] ?? null, FILTER_VALIDATE_INT);
		$sektorGrupId = filter_var($_POST["SektorGrup"] ?? null, FILTER_VALIDATE_INT);
		$id = filter_var($_POST["Id"] ?? null, FILTER_VALIDATE_INT);
		if ($sektorId !== false && $sektorGrupId !== false && $id !== false) {
			$statement = mysqli_prepare($coni, "UPDATE sektor_sektorgrup SET sektorid = ?, sektorgrupid = ? WHERE id = ?");
			if ($statement) {
				mysqli_stmt_bind_param($statement, "iii", $sektorId, $sektorGrupId, $id);
				mysqli_stmt_execute($statement);
				mysqli_stmt_close($statement);
			}
		}
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

		$sektorId = filter_var($_POST["IsKolu"] ?? null, FILTER_VALIDATE_INT);
		$sektorGrupId = filter_var($_POST["SektorGrup"] ?? null, FILTER_VALIDATE_INT);
		if ($sektorId !== false && $sektorGrupId !== false) {
			$statement = mysqli_prepare($coni, "INSERT INTO sektor_sektorgrup (sektorid, sektorgrupid) VALUES (?, ?)");
			if ($statement) {
				mysqli_stmt_bind_param($statement, "ii", $sektorId, $sektorGrupId);
				mysqli_stmt_execute($statement);
				mysqli_stmt_close($statement);
			}
		}
	}
	else    if ($_POST["Durum"] ==3)
	   		{ 
		     $id = filter_var($_POST["Id"] ?? null, FILTER_VALIDATE_INT);
		     if ($id !== false) {
				$statement = mysqli_prepare($coni, "DELETE FROM sektor_sektorgrup WHERE id = ?");
				if ($statement) {
					mysqli_stmt_bind_param($statement, "i", $id);
					mysqli_stmt_execute($statement);
					mysqli_stmt_close($statement);
				}
			 }
//		     $sorgu = mysql_db_query($db,"Delete from sektorler where id=".$_POST["IsKoluId"]);
 			}
	header("Location:IsKoluListe.php");
?>	 
