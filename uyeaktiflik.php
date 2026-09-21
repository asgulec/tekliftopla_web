<?
include"ayar.php";
tekliftopla_start_session();
tekliftopla_require_csrf();
/*$connection=mysql_connect("$host","$user","$password") or die ("Could not connect to the MySQL Server");
$query="SET NAMES 'UTF8'";
mysql_query($query);*/
$connection=mysqli_connect($host,$user,$password,$db);
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
mysqli_set_charset($connection,"utf8");
$deger = "0";
$secililiste = $_POST["secililiste"] ?? '';
if (isset($_POST["cbAktif"]))
	$deger	= "0";
else
	$deger	= "1";
if (!preg_match('/^\s*\(\s*\d+(?:\s*,\s*\d+)*\s*\)\s*$/', $secililiste)) {
	header("location:uyelistesi.php");
	exit;
}
preg_match_all('/\d+/', $secililiste, $matches);
$firmaIds = array_values(array_unique(array_map('intval', $matches[0])));
$placeholders = implode(',', array_fill(0, count($firmaIds), '?'));
$statement = mysqli_prepare($connection, "UPDATE bilgi SET aktivite = ? WHERE firmaid IN ($placeholders)");
if ($statement) {
	$bindValues = array($statement, 'i' . str_repeat('i', count($firmaIds)), (int)$deger);
	foreach ($firmaIds as $key => $firmaId) {
		$bindValues[] = &$firmaIds[$key];
	}
	call_user_func_array('mysqli_stmt_bind_param', $bindValues);
	mysqli_stmt_execute($statement);
	mysqli_stmt_close($statement);
}

header("location:uyelistesi.php");
?>
