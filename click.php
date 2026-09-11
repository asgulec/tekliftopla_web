<?// URL ve mail adreslerini link olarak basar. Dikkatli kullanilmali 
 function FormatLinks($str) { 
   $str = preg_replace("/(\w+):\/\/([^ ]+)/", "<A HREF=\"\\1://\\2\">\\1://\\2</A>", $str);  // her tur URL icin 
   $str = preg_replace("/(\w+)@([^ ]+)/", "<A HREF=\"mailto:\\1@\\2\">\\1@\\2</A>", $str);   // mail icin 
   return $str; 
 }?> 
