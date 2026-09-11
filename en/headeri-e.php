<?php
include"../ayar.php";
session_start();
$connection=mysqli_connect($host,$user,$password,$db);
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
mysqli_set_charset($connection,"utf8");
if(!isset($_SESSION["verified_firmaid"]) and !isset($_SESSION["verified_sifrem"])){
?>
<script type='text/javascript'>alert("Error");
window.location = "index-e.php";
</script>
<?php } 
	else
		$verified_firmaid = $_SESSION["verified_firmaid"];
?>
