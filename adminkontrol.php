<?
ini_set("display_errors",1);
include"ayar.php";
session_start();
$link = mysqli_connect($host,$user,$password,$db);
if (mysqli_connect_errno())
   {
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
   } 
mysqli_query($link,"SET NAMES 'UTF8'");
$pass = mysqli_real_escape_string($link,$_POST["pass"]);
$username = mysqli_real_escape_string($link,$_POST["username"]);
$result1 = mysqli_query($link,"SELECT * FROM yonetim WHERE password='$pass' AND username='$username'");
$etki1=mysqli_num_rows($result1);
if($etki1)
{
while($row1=mysqli_fetch_array($result1))
{
$verified_pass=$row1['password'];
$_SESSION["verified_pass"]=$verified_pass;
//session_register("verified_pass");
$verified_user=$row1['username'];
$_SESSION["verified_user"]=$verified_user;
//session_register("verified_user");
$verified_yonid=$row1['yonid'];
$_SESSION["verified_yonid"]=$verified_yonid;
//session_register("verified_yonid");
$KulEkle=$row1['KullaniciEkleme'];
$_SESSION["KulEkle"]=$KulEkle;
//session_register("KulEkle");
mysqli_close($link);
header("location:yonetimgiris.php");
}
}
else
{
?>
<script type='text/javascript'>alert("Hata");
window.history.back()
</script>
<? 
 } 
?>
