<?php
include_once 'connection/db.php';
$employee_data="";
$k=1;
$ledger=0;
$ledger_data="";
      $customer = mysql_query("SELECT sum(comm_amt) FROM comission where comm_date<='2016-03-31' order by comm_date desc");
      while($customer1 = mysql_fetch_array( $customer ))
      {      	
      	
      	$ledger=$customer1[0];
      }

  $customer = mysql_query("SELECT comm_amt,comm_date,agent_name,agent_place,agent_mobile FROM comission where comm_date>'2016-03-31' order by comm_date desc");
      while($customer1 = mysql_fetch_array( $customer ))
      {      	
      	
      	$ledger_data=$ledger_data."//".$customer1[0]."::".$customer1[1]."::".$customer1[2]."::".$customer1[3]."::".$customer1[4];
      }
 
 
 
 
 include_once 'connection/db1.php';

 $command = "SELECT MAX(sk_tran_id) as maxid FROM txn_transaction";
	$tran_id=0;
	$result = mysql_query($command, $con);
	while ($row = mysql_fetch_assoc($result))
	{
		$tran_id = $row['maxid'];
	}$tran_id++;
	
	
 $session_id=1;
 	$session_branch=1;
	
 $query="INSERT INTO txn_transaction(sk_tran_id,tran_date,tran_time, credit, debit,member_id, transaction_ref_id, ref_table, tran_type, tran_desc, note,tran_status, employee_id, branch_id)
	VALUES ('$tran_id','2016-03-31',now(),'$ledger','0','1','0','mst_expenselist','Expense','Comission','Ledger Balance as of 31-03-2016','active','$session_id','$session_branch')";
	mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
	

$temp_data=explode("//", $ledger_data);

 for($i=1;$i<sizeof($temp_data);$i++){
  	
 	$temp=explode("::", $temp_data[$i]);	
 	$amt=$temp[0];
 	$tran_date=$temp[1];
 	$note=$temp[2]." From ".$temp[3]." (".$temp[4].")";
 		
	$command = "SELECT MAX(sk_tran_id) as maxid FROM txn_transaction";
	$tran_id=0;
	$result = mysql_query($command, $con);
	while ($row = mysql_fetch_assoc($result))
	{
		$tran_id = $row['maxid'];
	}$tran_id++;
	
	$query="INSERT INTO txn_transaction(sk_tran_id,tran_date,tran_time, credit, debit,member_id, transaction_ref_id, ref_table, tran_type, tran_desc, note,tran_status, employee_id, branch_id)
	VALUES ('$tran_id','$tran_date',now(),'$amt','0','1','0','mst_expenselist','Expense','Comission','$note','active','$session_id','$session_branch')";
	mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());

	

 }

 
 
 