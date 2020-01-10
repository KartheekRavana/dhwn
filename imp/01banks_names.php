<?php
include_once 'connection/db.php';
$supplier_data="";$member_bill="";
$bank_data="";
$k=1;
 $data = mysql_query("SELECT bank_id,bank_name,acc_no FROM banks");
 while($info = mysql_fetch_array( $data ))
 {
 
 	$bank_id=$info["bank_id"];$balance=0;
                	$supplier = mysql_query("SELECT credit, debit from bank_transactions where bank_id='".$bank_id."' and tran_date<='2016-10-31' order by tran_date asc");
                	while($supplier1 = mysql_fetch_array( $supplier ))
                	{
                		if($supplier1['credit']>0 || $supplier1['debit']>0)
                		{
                			$balance=$balance+$supplier1['credit'];
                			$balance=$balance-$supplier1['debit'];
                			
                		}
                	}
                                
	$supplier_data=$supplier_data."//".$info["bank_id"]."::".$info["bank_name"]."::".$info["acc_no"]."::active::".$balance;	
		
 }
 
 $supplier = mysql_query("SELECT bank_id,credit, debit,tran_date,note from bank_transactions where tran_date>'2016-10-31' and customer_id=0 and supplier_id=0 and partner_id=0 order by tran_date asc");
while($supplier1 = mysql_fetch_array( $supplier ))
{
        $bank_data=$bank_data."//".$supplier1[0]."::".$supplier1[1]."::".$supplier1[2]."::".$supplier1[3]."::".$supplier1[4];        		             		
}
  $supplier = mysql_query("SELECT bank_id,credit, debit,tran_date,note from bank_transactions where tran_date>'2016-10-31' and customer_id=0 and supplier_id!=0 and partner_id=0 and tran_type='EXPENSES' order by tran_date asc");
while($supplier1 = mysql_fetch_array( $supplier ))
{
        $bank_data=$bank_data."//".$supplier1[0]."::".$supplier1[1]."::".$supplier1[2]."::".$supplier1[3]."::".$supplier1[4];        		             		
}
 include_once 'connection/db1.php';

 $member_type=6;
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
 	$cNo=$temp[0];
 	$member_name=$temp[1];
 	$acc_no=$temp[2];
 	$phone1="";
 	$phone2="";
 	$email="";
 	$address="";
 	$place="";
 	$member_status=$temp[3];
 	$old_id=0;
 	$balance=$temp[4];
 	
 	
	$query ="INSERT INTO mst_member (sk_member_id, member_type, member_name, acc_no, ifsc, mobile, landline, email, address, place, state, profile_pic, login_name, login_password, member_status,employee_id, branch_id,old_refid)
	VALUES ('$cNo','$member_type','$member_name','','','$phone1','$phone2','$email','$address','$place','','','','','$member_status','$session_id','$session_branch','$old_id')";
	mysql_query($query);
	
	$log_id=0;$command = "SELECT MAX(sk_log_id) as maxid FROM txn_log";$result = mysql_query($command, $con);while ($row = mysql_fetch_assoc($result)){$log_id = $row['maxid'];}$log_id++;
	$query ="INSERT INTO txn_log (sk_log_id, tran_type, tran_desc,log_date, log_time, tran_id, transaction_id, tran_table, branch_id, employee_id)
	VALUES ('$log_id','Bank','New Bank Added','2016-04-01',now(),'$cNo','$cNo','mst_member','$session_branch','$session_id')";
	mysql_query($query);
	
	$command = "SELECT MAX(sk_tran_id) as maxid FROM txn_transaction";
	$tran_id=0;
	$result = mysql_query($command, $con);
	while ($row = mysql_fetch_assoc($result))
	{
		$tran_id = $row['maxid'];
	}$tran_id++;
	
	$query="INSERT INTO txn_transaction(sk_tran_id,tran_date,tran_time, credit, debit,member_id, transaction_ref_id, ref_table, tran_type, tran_desc, note,tran_status, employee_id, branch_id)
	VALUES ('$tran_id','2016-10-31',now(),'$balance','0','$cNo','0','mst_member','Bank','Ledger Balance','Ledger Balance as of 31-03-2016','active','$session_id','$session_branch')";
	mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());


 }
 
 $temp_data=explode("//", $bank_data);
  for($i=1;$i<sizeof($temp_data);$i++){
  	
  	$temp=explode("::", $temp_data[$i]);
 	
 	$bank_id=$temp[0];
 	$credit=$temp[1];
 	$debit=$temp[2];
 	$tran_date=$temp[3];
 	$note=$temp[4];
 		$command = "SELECT MAX(sk_tran_id) as maxid FROM txn_transaction";
	$tran_id=0;
	$result = mysql_query($command, $con);
	while ($row = mysql_fetch_assoc($result))
	{
		$tran_id = $row['maxid'];
	}$tran_id++;
 	if($credit>0){
 	$query="INSERT INTO txn_transaction(sk_tran_id,tran_date,tran_time, credit, debit,member_id, transaction_ref_id, ref_table, tran_type, tran_desc, note,tran_status, employee_id, branch_id)
	VALUES ('$tran_id','$tran_date',now(),'$credit','0','$bank_id','0','mst_member','Bank','Deposit','$note','active','$session_id','$session_branch')";
	mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
 	}else{
	$query="INSERT INTO txn_transaction(sk_tran_id,tran_date,tran_time, credit, debit,member_id, transaction_ref_id, ref_table, tran_type, tran_desc, note,tran_status, employee_id, branch_id)
	VALUES ('$tran_id','$tran_date',now(),'0','$debit','$bank_id','0','mst_member','Bank','Withdraw','$note','active','$session_id','$session_branch')";
	mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
 	}
  }
