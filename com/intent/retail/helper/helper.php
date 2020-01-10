 <?php 
 function curtime()
 {
 $b = time ();  
 date_default_timezone_set('Asia/Calcutta');
 //print date("g:i A",$b) . "<br>"; 
 return date("g:i:s A D, F jS Y",$b) . "<br>"; 
 }
 
 function curdate()
 {
 	date_default_timezone_set('Asia/Calcutta');
 	return date("Y-m-d");
 }
 function curdate1()
 {
 	date_default_timezone_set('Asia/Calcutta');
 	return date("d-m-Y");
 }
 ?> 