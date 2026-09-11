<?php include "headeryon.php";
$KulEkle = isset($_SESSION["KulEkle"]) ? $_SESSION["KulEkle"]: '0';
if($KulEkle !=='1')
{
?>
<script type='text/javascript'>alert("Hata");
window.location = "yonetimgiris.php";
</script> 
<? } 
$eold=mysqli_real_escape_string($coni,isset($_POST["eold"]) ? $_POST["eold"] : '' );
$enew=mysqli_real_escape_string($coni,isset($_POST["enew"]) ? $_POST["enew"] : '' );
//$eold=$_POST["eold"];
//$enew=$_POST["enew"];
$sonuc=mysqli_query($coni,"UPDATE bilgi SET email='$enew' WHERE email='$eold' LIMIT 1");
$sayi = mysqli_affected_rows($coni);
if ( $sayi > 0) {
   ?>
   <script type='text/javascript'>alert("Değişti <? echo $sayi; ?>");
    window.location = "emailbulx.php";
   </script> 
  <? } else { ?>
	<script type='text/javascript'>alert("Hata !!!!");
    window.location = "emailbulx.php";
   </script> 
   <?  } 
 ?>
