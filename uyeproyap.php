<?
include"ayar.php";
$coni = mysqli_connect($host,$user,$password,$db);
if (mysqli_connect_errno())
   {
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
   } 
mysqli_set_charset($coni,"utf8");

/*session_start();
$connection=mysql_connect("$host","$user","$password") or die ("Could not connect to the MySQL Server");
$query="SET NAMES 'UTF8'";
mysql_query($query)*/;
$secililiste = $_POST["secililiste"] ?? '';
if (!preg_match('/^\s*\(\s*\d+(?:\s*,\s*\d+)*\s*\)\s*$/', $secililiste)) {
   header("location:uyelistesi.php");
   exit;
}
preg_match_all('/\d+/', $secililiste, $matches);
$firmaIds = array_values(array_unique(array_map('intval', $matches[0])));
$placeholders = implode(',', array_fill(0, count($firmaIds), '?'));
$statement = mysqli_prepare($coni, "UPDATE bilgi SET proflag = 2 WHERE firmaid IN ($placeholders)");
if ($statement) {
   $bindValues = array($statement, str_repeat('i', count($firmaIds)));
   foreach ($firmaIds as $key => $firmaId) {
      $bindValues[] = &$firmaIds[$key];
   }
   call_user_func_array('mysqli_stmt_bind_param', $bindValues);
   mysqli_stmt_execute($statement);
   mysqli_stmt_close($statement);
}
//echo $str2;
header("location:uyelistesi.php");
exit;
?>
