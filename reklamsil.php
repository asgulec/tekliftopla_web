<?

include"headeryon.php";



/*$link=mysql_connect($host,$user,$password)or die("bağlantı yok");

$query="SET NAMES 'UTF8'";

mysql_query($query);

mysql_select_db($db);

*/

$durum=$_GET["durum"];

switch($durum) 

{	

case 'rekguncel':



//if (isset($_FILES['grafik'])) {



if ($_FILES['grafik'] ['error']!=4) {

$filename = trim($_POST["filename"]);

unlink("reklamlar/".$filename);

$rekid = mysqli_real_escape_string($coni,trim($_POST["rekid"]));

$rektip = mysqli_real_escape_string($coni,trim($_POST["rektip"]));

$izah = mysqli_real_escape_string($coni,trim($_POST["izah"]));

$bastarih = mysqli_real_escape_string($coni,trim($_POST["bastarih".$rekid]));

$sontarih = mysqli_real_escape_string($coni,trim($_POST["sontarih".$rekid]));

$link = mysqli_real_escape_string($coni,trim($_POST["link"]));

$adet = mysqli_real_escape_string($coni,trim($_POST["adet"]));



$temp_name=$_FILES["grafik"]["tmp_name"];

$file_name=$_FILES["grafik"]["name"];

$file_name=preg_replace("/.*\.(.*)/",time().".$1",$file_name);



if(is_uploaded_file($temp_name) && $_FILES["grafik"]["size"]>0 && $_FILES["grafik"]["size"]<=150000) {

	move_uploaded_file($temp_name,"reklamlar/".$file_name);

}



$degis="UPDATE rekkayit SET rektip='$rektip', izah='$izah', kaytarih=now(), bastarih='$bastarih', sontarih='$sontarih', adet='$adet', grafik='$file_name', link='$link' WHERE rekid = '$rekid' LIMIT 1";

$sonuc=mysqli_query($coni,$degis) or die("Invalid query: " . mysqli_error($coni));

}

else {

$rekid = mysqli_real_escape_string($coni,trim($_POST["rekid"]));

$rektip = mysqli_real_escape_string($coni,trim($_POST["rektip"]));

$izah = mysqli_real_escape_string($coni,trim($_POST["izah"]));

$bastarih = mysqli_real_escape_string($coni,trim($_POST["bastarih".$rekid]));

$sontarih = mysqli_real_escape_string($coni,trim($_POST["sontarih".$rekid]));

$link = mysqli_real_escape_string($coni,trim($_POST["link"]));

$adet = mysqli_real_escape_string($coni,trim($_POST["adet"]));



$degis="UPDATE rekkayit SET rektip='$rektip', izah='$izah', kaytarih=now(), bastarih='$bastarih', sontarih='$sontarih', adet='$adet',  link='$link' WHERE rekid = '$rekid' LIMIT 1";

$sonuc=mysqli_query($coni,$degis) or die("Invalid query: " . mysqli_error($coni));

}

header("Location:yonetimreklam.php");

exit;

break;



case 'reksil':

$rekid=mysqli_real_escape_string($coni,trim($_POST["rekid"]));

$filename = mysqli_real_escape_string($coni,trim($_POST["filename"]));

unlink("reklamlar/".$filename);



$str2="delete from rekkayit where rekid ='$rekid' limit 1";

$result2=mysqli_query($coni,$str2);



$str2="delete from reklam_sehir where rekid ='$rekid'";

$result2=mysqli_query($coni,$str2);



$str2="delete from reklam_sektor where rekid ='$rekid'";

$result2=mysqli_query($coni,$str2);

header("location:yonetimreklam.php");

exit;

break;

}



?>

