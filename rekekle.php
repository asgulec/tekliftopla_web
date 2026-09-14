<?
include"headeryon.php";
/*$link=mysql_connect($host,$user,$password)or die("baðlantý yok");
$query="SET NAMES 'UTF8'";
mysql_query($query);
*/
$asama=$_GET["asama"];
switch($asama) 
{	
// anaformdan gelen bilgiyi ekleme
case 'reklambilgi':

$rektip = mysqli_real_escape_string($coni,trim($_POST["rektip"]));
$izah = mysqli_real_escape_string($coni,trim($_POST["izah"]));
$bastarih = mysqli_real_escape_string($coni,trim($_POST["bastarih"]));
$sontarih = mysqli_real_escape_string($coni,trim($_POST["sontarih"]));
$link = mysqli_real_escape_string($coni,trim($_POST["link"]));
$adet = mysqli_real_escape_string($coni,trim($_POST["adet"]));

$temp_name=$_FILES["grafik"]["tmp_name"];
$file_name=$_FILES["grafik"]["name"];
$file_name=preg_replace("/.*\.(.*)/",time().".$1",$file_name);
//$file_name = time().".".$type['extension'];

if(is_uploaded_file($temp_name) && $_FILES["grafik"]["size"]>0 && $_FILES["grafik"]["size"]<=150000) {
	move_uploaded_file($temp_name,"reklamlar/".$file_name);
}

$ekle="INSERT INTO rekkayit (rektip, izah, kaytarih, bastarih, sontarih, adet, grafik, link) VALUES ('$rektip', '$izah', now(), '$bastarih', '$sontarih', '$adet', '$file_name', '$link')";
$sonuc=mysqli_query($coni,$ekle) or die("Invalid query: " . mysqli_error($coni));
$_SESSION['rekid']=mysqli_insert_id($coni);
header("Location:reksekgruplari.php");
exit;

break;

//sektorleri geçici tabloya ekle
case 'sektor':
$cat2 = $_GET["cat2"];
$rekid=$_SESSION['rekid'];
if (isset($_POST["sektor"]))
{
 $sektor = $_POST["sektor"];
 if($sektor){
 foreach($sektor as $sektorler){
	$sektorler = (int)$sektorler;
  $temp2="INSERT INTO gecrek1 (rekid,sektorid) values('$rekid','$sektorler')";
  $etki2=mysqli_query($coni,$temp2);
 }}
}
header("location:reksekgruplari.php");
exit;

break;
//tüm sektor bilgisini ekleme

case 'denetle':
$rekid=$_SESSION['rekid'];
if (isset($_POST["sektor"]))
{
$sektor = $_POST["sektor"];
if($sektor){
foreach($sektor as $sektorler){
  $sektorler = (int)$sektorler;
$temp5="delete from gecrek1 where sektorid='$sektorler' and rekid='$rekid'";
$etki5=mysqli_query($coni,$temp5);}
}
}
$temp3="INSERT INTO reklam_sektor(rekid,sektorid) SELECT distinct rekid,sektorid FROM gecrek1 where rekid='$rekid'";
$etki3=mysqli_query($coni,$temp3);
header("location:reksehirler.php");
exit;
break;
//sehir bilgisini ekleme

case 'sehir':
$rekid=$_SESSION['rekid'];
if (isset($_POST["sehir"]))
{
 $sehir = $_POST["sehir"];
 if($sehir){
  foreach($sehir as $sehirler){
  $sehirler = (int)$sehirler;
	$str2="insert into reklam_sehir (rekid,sehirid)values('$rekid','$sehirler')";
	$result2=mysqli_query($coni,"$str2");
  }}
}
$temppp="delete from gecrek1 where rekid=$rekid";
$etkinp=mysqli_query($coni,$temppp);
header("location:yonetimgiris.php");
exit;
break;
}
?>