<?php
include_once 'connection/db.php';
$supplier_data="";$member_bill="";
$bank_data="";
$k=1;
 $data = mysql_query("SELECT item_name FROM items");
 while($info = mysql_fetch_array( $data ))
 {
    
	$supplier_data=$supplier_data."//".$info["item_name"]."::";	
		
 }
 
 include_once 'connection/db1.php';

 
 $temp_data=explode("//", $supplier_data);
  for($i=1;$i<sizeof($temp_data);$i++){
  	
  	$temp=explode("::", $temp_data[$i]);
 	
 	$particluar=$temp[0];
 	$state="";
 	 $data = mysql_query("SELECT particular_name FROM mst_particular where particular_name='$particluar'");
	 while($info = mysql_fetch_array( $data ))
	 {
	 	$state="Exist";
	 }
	 
	 
	 if($state==""){
	 	$command = "SELECT MAX(sk_particular_id) as maxid FROM mst_particular";
$cNo=0;
$result = mysql_query($command, $con);
while ($row = mysql_fetch_assoc($result)){
	$cNo = $row['maxid'];
}

$cNo++;

$query ="INSERT INTO mst_particular (sk_particular_id, particular_name, particular_desc, category_id, sub_category_id, particular_status, branch_id)
VALUES ('$cNo','$particluar','$particluar','1','0','active','1')";
mysql_query($query);
	 	
	 }
  }
