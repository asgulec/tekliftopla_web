<?
include "headeryon.php";
/*include"ayar.php";
session_start();
$connection=mysql_connect("$host","$user","$password") or die ("Could not connect to the MySQL Server");
$query="SET NAMES 'UTF8'";
mysql_query($query);
if(!isset($_SESSION["verified_pass"]) and !isset($_SESSION["verified_user"]))
{
?>
<script type='text/javascript'>alert("Hata");
window.location = "index.php";
</script> 
<?
}
else{

$connection=mysql_connect("$host","$user","$password") or die ("Could not connect to the MySQL Server");
$query="SET NAMES 'UTF8'";
mysql_query($query);*/

$teklifid = isset($_GET['teklifid']) ? $_GET['teklifid'] : '0';
$tempppx21="update kullanim set tamam='1',readable='1' where Kullanimid='$teklifid'";
$etkinp21=mysqli_query($coni,$tempppx21);
unset($_SESSION['kontrol']);
//session_unregister("kontrol");
unset($_SESSION['verified_kulid']);
//session_unregister("verified_kulid");
unset($_SESSION['verified_teklifid']);
//session_unregister("verified_teklifid");
unset($_SESSION['verified_firma']);
//session_unregister("verified_firma");
unset($_SESSION['verified_sehirid']);
//session_unregister("verified_sehirid");
header("location:yonetimgiris.php");
exit;
//}
?>
