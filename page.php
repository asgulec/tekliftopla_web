<?
$artma=10;   //artma sayisini burada belirliyorum. 
$count=mysqli_num_rows($resultyy3455);    //kac row var?
$numpage=ceil($count/$artma);       //toplam kaç sayfa olacak?
if (isset($_GET["page"]))
	$page = $_GET["page"];
else
	$page = '';
if (($page=='') || ($page=='0'))   //eger page bos veya 0 gelmis ise.
       {
       $page=0;
       $basla=0;                //ilk basta page 0 veya bos olacagindan.
       if(($page+1)*$artma <= $count)    //next koysun mu?
           {
           $next='yes';
           $npage=$page+1;
		   $prev='';    // asg
		   $ppage=$page;  //asg
           }
       	   else                     // else asg koydu
		   {$next ='';
		    $prev='';
		   }
	   }
       else                       //page bos gelmedi. bir sayiyla dondu.
       {
       $basla=$page*$artma;       //sorguya kactan baslayacak?
       $ppage=$page-1;            //previous page?
       $prev='yes';
	   $next='';    //asg
               if(($page+1)*$artma <= $count)   //next koysun mu?
              {
              $next='yes';
              $npage=$page+1;
}
}

?>
