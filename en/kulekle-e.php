<?
include"../ayar.php";
tekliftopla_start_session();
tekliftopla_require_csrf();
$connection=mysqli_connect($host,$user,$password,$db);
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
mysqli_set_charset($connection,"utf8");
/*session_start();
$connection=mysql_connect("$host","$user","$password") or die ("Could not connect to the MySQL Server");
$query="SET NAMES 'UTF8'";
mysql_query($query);*/
$kulip = get_ip_address();
function get_ip_address(){
    foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
        if (array_key_exists($key, $_SERVER) === true){
            foreach (explode(',', $_SERVER[$key]) as $ip){
                $ip = trim($ip); // just to be safe
                if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
                    return $ip;
                }
            }
        }
    }
}
if(!isset($_SESSION["verified_firmaid"])  and !isset($_SESSION["verified_sifrem"]))
{
?>
<script type='text/javascript'>alert("Error");
window.location = "index-e.php";
</script>
<? 
}
else
{
$iletisim = mysqli_real_escape_string($connection,$_POST["iletisim"]) ;
$sure = mysqli_real_escape_string($connection,$_POST["sure"]);
$sehirx = mysqli_real_escape_string($connection,$_POST["sehir"]);
$Ulke= mysqli_real_escape_string($connection,$_POST["Ulke"]);
$sehir= ($Ulke =="TUR" ? $sehirx : "999" );
$text = mysqli_real_escape_string($connection,$_POST["text"]);
$tarih= date("Y-m-d", strtotime(mysqli_real_escape_string($connection,$_POST["tektarih"])));
$mesajnum = mysqli_real_escape_string($connection,$_POST["MesajNum"]);
$verified_firmaid = $_SESSION["verified_firmaid"];
if (isset($_SESSION["verified_kulid"]))
{
		$verified_kulid = $_SESSION["verified_kulid"];
		if ( !isset($_SESSION["verified_sehirid"]))
		{
			$verified_sehirid=$sehir;
			$_SESSION['verified_sehirid']=$verified_sehirid;
		} else if ($_SESSION["verified_sehirid"]=="") {
		    unset($_SESSION['verified_sehirid']);
			$verified_sehirid=$sehir;
		    $_SESSION['verified_sehirid']=$verified_sehirid;
			
		}
		$ekle1="Update kullanim set tarih='$tarih',sure='$sure',iletisim='$iletisim',text='$text',sehirid='$sehir', ulke='$Ulke' where Kullanimid ='$verified_kulid'";
		$sonuc1=mysqli_query($connection,$ekle1);
		if($sonuc1)
		{
			$tempppx2="delete from gecici2 where firmaid='$verified_firmaid' or kullanimid='0'";
			$etkinp2=mysqli_query($connection,$tempppx2);
	
			$tempppx3="delete from gecici3 where firmaid='$verified_firmaid' or kullanimid='0'";
			$etkinp3=mysqli_query($connection,$tempppx3);
			
			$tempppx4="delete from gecici4 where firmaid='$verified_firmaid' or kullanimid='0'";
			$etkinp4=mysqli_query($connection,$tempppx4);
			
			$www="delete from gecici5 where firmaid='$verified_firmaid' or kullanimid='0'";
			$etkinp5=mysqli_query($connection,$www);	
		
			$tempppx6="delete from gecici6 where firmaid='$verified_firmaid' or kullanimid='0'";
			$etkinp6=mysqli_query($connection,$tempppx6);			
			$verified_sifre1 = $_SESSION["verified_sifre1"];
			$id="select kullanimid from kullanim where session='$verified_sifre1' and firmaid='$verified_firmaid'";
			$result=mysqli_query($connection,$id);
		}
		header("location:kullanimgor-e.php");
		exit;
}
else
{
		$time=date("H:i:s");
		$date=date("Ymd");
		$sifre1=md5(microtime());
		$verified_sifre1=$sifre1;
		$_SESSION['verified_sifre1']=$verified_sifre1;
		//session_register("verified_sifre1");
		//$tarih=$yil."-".$ay."-".$gun;
		$sorgu ="Select * from bilgi Where firmaid='$verified_firmaid'";
		$sonuc=mysqli_query($connection,$sorgu);
		$satir=mysqli_fetch_array($sonuc);
		$hata= "Tamam";
		if ($iletisim=="Fax" and $satir['Fax']=="0") 
		{  
			$hata = "Hata"; 
?>
<script language="javascript">
			window.open('fax.php','Fax','width=350,height=300,scrollbars=yes');
		</script>
<?	
		}
		if ($iletisim=="Telephone" and $satir['Telefon']=="0") 
		{  
			$hata = "Hata"; 
?>
<script language="javascript">
			window.open('tel.php','Telefon','width=350,height=300,scrollbars=yes');
		</script>
<?	
		}
		if ($iletisim=="Mail" and $satir['Adres']=="") 
		{ 
			$hata = "Hata";  
?>
<script language="javascript">
				window.open('posta.php','Fax','width=400,height=300,scrollbars=yes');
			</script>
<? 		}
		if ($iletisim=="Visit" and $satir['Adres']=="") 
		{ 
			$hata = "Hata";  
?>
<script language="javascript">
				window.open('posta.php','Fax','width=400,height=300,scrollbars=yes');
			</script>
<? 		}
		if ($hata=="Hata")
		{
?>
<script language="javascript">
			history.go(-1);
		</script>
<?
		}
		else
		{
			$ekle1="INSERT INTO kullanim (tarih,sure,iletisim,text,firmaid,session,sehirid,ulke,date,time,mesajsay,kulip,dil) VALUES ('$tarih','$sure','$iletisim','$text','$verified_firmaid','$verified_sifre1','$sehir','$Ulke' ,'$date','$time','$mesajnum','$kulip', 'ENG')";
			$verified_sehirid=$sehir;
			$_SESSION['verified_sehirid']=$verified_sehirid;
			$sonuc1=mysqli_query($connection,$ekle1);
			if($sonuc1)
			{
				$tempppx2="delete from gecici2 where firmaid='$verified_firmaid' or kullanimid='0'";
				$etkinp2=mysqli_query($connection,$tempppx2);
	
				$tempppx3="delete from gecici3 where firmaid='$verified_firmaid' or kullanimid='0'";
				$etkinp3=mysqli_query($connection,$tempppx3);
	
				$tempppx4="delete from gecici4 where firmaid='$verified_firmaid' or kullanimid='0'";
				$etkinp4=mysqli_query($connection,$tempppx4);
	
				$www="delete from gecici5 where firmaid='$verified_firmaid' or kullanimid='0'";
				$etkinp5=mysqli_query($connection,$www);	
				$tempppx6="delete from gecici6 where firmaid='$verified_firmaid' or kullanimid='0'";
				$etkinp6=mysqli_query($connection,$tempppx6);
				$id="select kullanimid from kullanim where session='$verified_sifre1' and firmaid='$verified_firmaid'";
				$result=mysqli_query($connection,$id);
				while ($row=mysqli_fetch_array($result))
				{
					$verified_kulid=$row['kullanimid'];
					$_SESSION['verified_kulid']=$verified_kulid;
					
				}
				header("location:kullanimgor-e.php");
				exit;
			}
		}
}
}
?>