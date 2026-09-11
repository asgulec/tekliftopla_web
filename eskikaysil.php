<?php
set_time_limit(0);
ignore_user_abort(1);
include"ayar.php";
session_start();
$islem = $_GET["islem"];
switch($islem)
{
case 'kayitsil':
/*$connection=mysql_connect("$host","$user","$password") or die ("Could not connect to the MySQL Server");
$query="SET NAMES 'UTF8'";
mysql_query($query);
 */
$coni = mysqli_connect($host,$user,$password,$db);
if (mysqli_connect_errno())
   {
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
   } 
mysqli_set_charset($coni,"utf8");
 
$str2="delete from kulfirmaid where kullanimid in (select b.kullanimid from kullanim as b where b.tarih < subdate(now(),INTERVAL 366 DAY) order by b.kullanimid asc)";
$result2=mysqli_query($coni,$str2);
/*
$str2="DELETE FROM kulfirmaid
USING kulfirmaid, kullanim
WHERE kulfirmaid.kullanimid = kullanim.kullanimid
AND kullanim.tarih < subdate(now(),INTERVAL 183 DAY)";

*/


$str3="DELETE FROM kullanim WHERE tamam=0 AND aktif=0 AND kullanim.tarih < subdate(now(),INTERVAL 183 DAY)";
$result3=mysqli_query($coni,$str3);
$stra3="OPTIMIZE TABLE kullanim";
$resulta3=mysqli_query($coni,$stra3);

$str4="DELETE FROM kulfirmaid WHERE kulfirmaid.firmaid not in (select bilgi.firmaid from bilgi )";
$result4=mysqli_query($coni,$str4);
$str5="DELETE FROM kulfirmaid WHERE kulfirmaid.kullanimid not in (select kullanim.Kullanimid from kullanim )";
$result5=mysqli_query($coni,$str5);

mysqli_query($coni,"insert into kullanim_e (select * from kullanim where tarih < subdate(now(),INTERVAL 396 DAY))");
mysqli_query($coni,"delete from kullanim where tarih < subdate(now(),INTERVAL 396 DAY)");

$stra2="OPTIMIZE TABLE kulfirmaid";
$resulta2=mysqli_query($coni,$stra2);

/* mysql_query("update bilgi set proflag=1 where proflag=0 and firmaid in (select firmaid from kullanim where readable=1 group by firmaid having count(firmaid)>2)"); */

$idler=mysqli_query($coni,"select firmaid from kullanim where readable=1 group by firmaid having count(firmaid)>2");
$idadet=mysqli_num_rows($idler);
if ( $idadet>0) 
while ($row = mysqli_fetch_array($idler, MYSQL_ASSOC)) {
    $firmaid=$row["firmaid"];
	mysqli_query($coni,"update bilgi set proflag=1 where proflag=0 and firmaid=$firmaid");
}

mysqli_query($coni,"update bilgi set proflag=0 where proflag=1 and firmaid in (select firmaid from kullanim where readable=1 group by firmaid having count(firmaid)<3)");


header("location:yonetimgiris.php"); 
exit();
break;

/* firma_sehir tablosundaki mükerrer kayıtları siler */

case 'mukerrer':
/*$connection=mysql_connect("$host","$user","$password") or die ("Could not connect to the MySQL Server");
$query="SET NAMES 'UTF8'";
mysql_query($query);
mysql_select_db("teklifto_teklif_topla");
*/
$coni = mysqli_connect($host,$user,$password,$db);
if (mysqli_connect_errno())
   {
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
   } 
mysqli_set_charset($coni,"utf8");

mysqli_query($coni,"Delete t from firma_sektor t inner join firma_sektor tt On t.firmaid = tt.firmaid and t.sektorid = tt.sektorid and t.id > tt.id");
$str4="OPTIMIZE TABLE firma_sektor";
$result4=mysqli_query($coni,$str4); 

mysqli_query($coni,"delete from ip where date < subdate(now(),INTERVAL 370 DAY)");

header("location:yonetimgiris.php");
exit();
break;

case 'mukerrerseh':
/*$connection=mysql_connect("$host","$user","$password") or die ("Could not connect to the MySQL Server");
$query="SET NAMES 'UTF8'";
mysql_query($query);
mysql_select_db("teklifto_teklif_topla");
*/
$coni = mysqli_connect($host,$user,$password,$db);
if (mysqli_connect_errno())
   {
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
   } 
mysqli_set_charset($coni,"utf8");

mysqli_query($coni,"Delete t from firma_sehir t inner join firma_sehir tt On t.firmaid = tt.firmaid and t.sehirid = tt.sehirid and t.id > tt.id");
$str5="OPTIMIZE TABLE firma_sehir";
$result4=mysqli_query($coni,$str5); 

/* $querysec="select distinct firmaid from (SELECT firmaid, sehirid, count(*) FROM firma_sehir GROUP BY firmaid, sehirid having count(*) > 1) t";
$resultsec=mysql_query($querysec);
while($rowid=mysql_fetch_array($resultsec))
  {
  echo "Kontrol edilen " . $rowid['firmaid'] . "<br />";
  $query1="SELECT distinct firmaid, sehirid FROM firma_sehir WHERE firmaid=".$rowid['firmaid']."";
  $result=mysql_query($query1);
	
	while($row = mysql_fetch_array($result))
	{
    $rfirmaid=$row['firmaid'];
	$rsehirid=$row['sehirid'];
	$sql="SELECT firmaid FROM firma_sehir WHERE firmaid=".$rfirmaid." AND sehirid=".$rsehirid."";
    $res=mysql_query($sql);
    $count = mysql_num_rows($res) - 1;
    $delsql="DELETE FROM firma_sehir WHERE firmaid=".$rfirmaid." AND sehirid=".$rsehirid." LIMIT ".$count."";
    $resdel=mysql_query($delsql);
	} 
  }
$str4="OPTIMIZE TABLE firma_sehir";
$result4=mysql_query($str4); */

 /* firmasekt tablosundaki mükerrer kayıtları siler 

mysql_connect("$host","$user","$password") or die ("Could not connect to the MySQL Server");
mysql_select_db('tekliftopla'); */
/*
$tableName='firma_sektor';
$querysek="select distinct firmaid from (SELECT firmaid, sektorid, count(*) FROM firma_sektor GROUP BY firmaid, sektorid having count(*) > 1) t";
$resultsek=mysql_query($querysek);
while($i=mysql_fetch_array($resultsek))
{
  echo "Kontrol edilen " . $i['firmaid'] . "<br />";
  $query="SELECT distinct firmaid, sektorid FROM $tableName WHERE firmaid=".$i['firmaid']." ";
  $result=mysql_query($query);

  while($row = mysql_fetch_array($result))
  {
    $sql="SELECT firmaid FROM $tableName WHERE firmaid='".$row['firmaid']."' AND sektorid='".$row['sektorid']."' ";
    $res=mysql_query($sql);
    $count = mysql_num_rows($res) - 1;
    $delsql="DELETE FROM $tableName WHERE firmaid='".$row['firmaid']."' AND sektorid='".$row['sektorid']."' LIMIT ".$count;
    mysql_query($delsql);
  }

}
$str4="OPTIMIZE TABLE firma_sektor";
$result4=mysql_query($str4); 
*/
header("location:yonetimgiris.php");
exit();
break;
}
?>