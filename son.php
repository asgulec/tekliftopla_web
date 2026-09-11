<? include"headerki.php";
if (isset($_SESSION['verified_gemail']))
{
$email=isset($_SESSION['verified_gemail'])? $_SESSION['verified_gemail']:'';
$sql1="SELECT sifre,email,firmaid,Firma_Adi FROM bilgi WHERE email='$email' ";
    $result1 = mysqli_query($connection,$sql1) or die ("Couldn't execute SQL query");
    $etki1=mysqli_num_rows($result1);
    if($etki1)
    {
        while($row=mysqli_fetch_array($result1)){
        $verified_email=$row['email'];
        $_SESSION['verified_email']=$verified_email;
        $verified_sifrem=$row['sifre'];
        $_SESSION['verified_sifrem']=$verified_sifrem;
        $verified_firmaid=$row['firmaid'];
        $_SESSION['verified_firmaid']=$verified_firmaid;
        $firma=$row['Firma_Adi'];	
        $verified_firma=$firma;
        $_SESSION['verified_firma']=$verified_firma;
		}
        header('location:giris.php');
		exit();
	}
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="content-language" content="tr" />
<title>tekliftopla</title>
<link href="css/style.css" rel="stylesheet" type="text/css">

</head>

<body>
<div id="sayfa">
  <div id="ust">
    <?php include "ust.php" ?>
  </div>
  <div id="bant1"></div>
  <div id="sol">
    <?php include "menu.php" ?>
  </div>
  <div id="analong">  
      <table width="97%" border="0" align="center" cellpadding="0"  cellspacing="0" bgColor=white >
      <tr>
        <td align="center"  valign="middle" >
          <h4><span class="title_kucuk"><br><br><br><br>Kayıt işleminiz sona ermiştir. Teşekkür ederiz.<br><br></span> </h4>
        </td> </tr>
       <tr>
         <td align="center" class="govde"> Geçici şifreniz e-posta adresinize birkaç dakika içinde gönderilecektir. <br>Bu şifre ile tekliftopla.com'u hemen kullanmaya başlayabilirsiniz.
                   <br> <br>Lütfen önemsiz posta, spam veya istenmeyen posta klasörlerini kontrol ediniz.
          </td> </tr>
        <tr>
          <td align="center" class="govde">&nbsp; </td> </tr>
        <tr>
          <td align="center" height="50"><a href="#here" onClick="Iptal()" class="buttonPage"> İlerle &nbsp;<i class="icon-arrow-right"></i></a></td> </tr>
         </table>
  </div>
  <div id="bant1"></div>
  <div id="alt">
    <?php include "alt.php" ?>
  </div>
</div>         
</BODY></HTML>
<script language="javascript">
function Iptal(){
	window.location = "cikis.php";
}
</script>