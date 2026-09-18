<?
include"ayar.php";
session_start();
$coni = mysqli_connect($host,$user,$password,$db);
if (mysqli_connect_errno())
   {
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
   } 
mysqli_set_charset($coni,"utf8");

/*$connection=mysql_connect("$host","$user","$password") or die ("Could not connect to the MySQL Server");
$query="SET NAMES 'UTF8'";
mysql_query($query);*/
$secililiste = $_POST["secililiste"] ?? '';
if (!preg_match('/^\s*\(\s*\d+(?:\s*,\s*\d+)*\s*\)\s*$/', $secililiste)) {
   header("location:uyelistesi.php");
   exit;
}
preg_match_all('/\d+/', $secililiste, $matches);
$firmaIds = array_values(array_unique(array_map('intval', $matches[0])));
$placeholders = implode(',', array_fill(0, count($firmaIds), '?'));
foreach (array('bilgi', 'firma_sehir', 'firma_sektor') as $table) {
   $statement = mysqli_prepare($coni, "DELETE FROM $table WHERE firmaid IN ($placeholders)");
   if ($statement) {
      $bindValues = array($statement, str_repeat('i', count($firmaIds)));
      foreach ($firmaIds as $key => $firmaId) {
         $bindValues[] = &$firmaIds[$key];
      }
      call_user_func_array('mysqli_stmt_bind_param', $bindValues);
      mysqli_stmt_execute($statement);
      mysqli_stmt_close($statement);
   }
}

/* $str2="DELETE a.*, b.*, c.*
FROM bilgi as a, firma_sehir as b, firma_sektor as c
WHERE a.firmaid = b.firmaid
AND b.firmaid = c.firmaid
AND a.aktivite=0
AND a.firmaid IN " . $secililiste;
$result2=mysql_db_query($db,"$str2");
*/

header("location:uyelistesi.php");
?>
