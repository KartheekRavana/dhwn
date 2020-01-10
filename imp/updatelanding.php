<?php
include_once 'connection/db.php';
$supplier_data="";$member_bill="";$ledger_data="";
$k=1;
 $data = mysql_query("SELECT tran_id,landing_cost FROM supplierbill");
 while($info = mysql_fetch_array( $data ))
 {
 
 	$supplier_data=$supplier_data."//".$info["tran_id"]."::".$info["landing_cost"];	
	
 	
 
 }
 
 include_once 'connection/db1.php';

 $member_type=4;
 $session_id=1;
 	$session_branch=1;
$temp_data=explode("//", $supplier_data);
 
 $command = "SELECT MAX(sk_member_id) as maxid FROM mst_member";
$cNo=0;
$result = mysql_query($command, $con);
while ($row = mysql_fetch_assoc($result)){
	$cNo = $row['maxid'];
}

$cNo++;

 for($i=1;$i<sizeof($temp_data);$i++){
 	
 	$temp=explode("::", $temp_data[$i]);
 	$old_id=$temp[0];
 	$member_name=$temp[1];
 	
	$query ="update txn_bill_support set landing_cost='$member_name' where sk_tran_id='$old_id'";
	mysql_query($query);
	

 }
 

 
 