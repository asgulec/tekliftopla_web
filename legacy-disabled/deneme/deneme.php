<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>teklitopla deneme</title>
<link href="../css/style.css" rel="stylesheet" type="text/css">
<meta charset="utf-8">
</head>
<body>
<?php 

$adres = simplexml_load_file("http://www.tcmb.gov.tr/kurlar/today.xml"); 

foreach ($adres->Currency as $poster) {
    if ((string) $poster['Kod'] == 'USD') {
        echo (string) $poster->Kod. "<br>";
		echo (string) $poster->ForexBuying. "<br>";
		echo (string) $poster->ForexSelling. "<br>";
    }
}

print_r($poster);
echo $adres->Currency[0]->Isim. "<br>";
echo $adres->Currency[0]->ForexBuying. "<br>";
echo $adres->Currency[0]->ForexSelling. "<br>";
echo $adres->Currency[0]['Kod']. "<br>";

echo "Selami". "<br>";
echo $adres->getName() . "<br>";
foreach ($adres->children() as $child)
  {
  echo $child->getName() . "<br>";
  }

echo array_search('KUVEYT',$adres);

print_r($adres);

?>


<?php
if (function_exists('mysqli_connect')) {
  ?><p class="text_g" style="font-size: 14px;"> A. Selami Güleç işüÜğÖçIıiİĞ </p>
<p class="text_s" style="font-size: 14px;"> A. Selami Güleç işüÜğÖçIıiİĞ </p> <?php
  //mysqli is installed
}
?>

<p class="text_c"; style="font-size:14px;"> A. Selami Güleç işüÜğÖçIıiİĞ </p>  


</body>
</html>

