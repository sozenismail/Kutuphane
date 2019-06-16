
<?php
ob_start();
session_start();

function seo($text) {
$turkce=array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","R","S","T","U","V","Y","Z","X","Q","W","ş","Ş","ı","(",")","'","ü","Ü","ö","Ö","ç","Ç"," ","/","*","?","ş","Ş","ı","ğ","Ğ","İ","ö","Ö","Ç","ç","ü","Ü","!","@","#");
$duzgun=array("a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","r","s","t","u","v","y","z","x","q","w","s","s","i","","","","u","u","o","o","c","c","-","","","","s","s","i","g","g","i","o","o","c","c","u","u","","","");
$text=str_replace($turkce,$duzgun,$text);
$text=urldecode($text);
$text = trim($text);
$ara = array('Ã‡','Ã§','Ğz','ÄŸ','Ä±','Ä°','Ã–','Ã¶','Åz','ÅŸ','Ãœ','Ã¼');
$degistir = array('c','c','g','g','i','i','o','o','s','s','u','u');
$text = str_replace($ara,$degistir,$text);
$text = preg_replace("@[^A-Za-z0-9\-_]+@i","",$text);
return $text;
}

?>