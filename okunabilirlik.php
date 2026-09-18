<?
include "headeryon.php";
/*include"ayar.php";
session_start();
$connection=mysql_connect("$host","$user","$password") or die ("Could not connect to the MySQL Server");
$query="SET NAMES 'UTF8'";
mysql_query($query);
*/
$deger = "0";
$secililiste = $_POST["secililiste"] ?? '';
if (isset($_POST["cbreadable"]))
	$deger	= "0";
else
	$deger	= "1";

if (!preg_match('/^\s*\(\s*\d+(?:\s*,\s*\d+)*\s*\)\s*$/', $secililiste)) {
	header("location:kullanimlistesi.php");
	exit;
}

preg_match_all('/\d+/', $secililiste, $matches);
$kullanimIds = array_map('intval', $matches[0]);
$placeholders = implode(',', array_fill(0, count($kullanimIds), '?'));
$str2 = "UPDATE kullanim SET readable = ? WHERE kullanimid IN ($placeholders)";
$statement = mysqli_prepare($coni, $str2);
if ($statement) {
	$types = 'i' . str_repeat('i', count($kullanimIds));
	$values = array_merge(array((int)$deger), $kullanimIds);
	$bindValues = array($statement, $types);
	foreach ($values as $key => $value) {
		$bindValues[] = &$values[$key];
	}
	call_user_func_array('mysqli_stmt_bind_param', $bindValues);
	mysqli_stmt_execute($statement);
	mysqli_stmt_close($statement);
}

header("location:kullanimlistesi.php");
?>
