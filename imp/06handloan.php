<?php
include_once 'connection/db.php';
$partner_data="";
$k=1;
$partner_tran="";
 $data = mysql_query("SELECT customer_id,customer_name,mobile FROM fin_customer");
 while($info = mysql_fetch_array( $data ))
 {
           $partner_id=$info["customer_id"];      

         $balance=0;$customer = mysql_query("SELECT credit, debit FROM fin_loan_transaction where customer_no='".$partner_id."' and tran_date<='2016-10-31' order by TRAN_DATE asc");
    while($customer1 = mysql_fetch_array( $customer )){if($customer1['credit']>0 || $customer1['debit']>0){$balance=$balance-$customer1['credit'];$balance=$balance+$customer1['debit'];}}
	
    
		$partner_data=$partner_data."//".$info["customer_name"]."::".$info["mobile"]."::".$info["customer_id"]."::".$balance."::";
 	
 	 
      $customer = mysql_query("SELECT payment_type,tran_date,credit, debit,note FROM fin_loan_transaction where customer_no='".$partner_id."' and tran_date>'2016-10-31' order by TRAN_DATE desc");
      while($customer1 = mysql_fetch_array( $customer ))
      {      	
      	$partner_tran=$partner_tran."//".$partner_id."::".$customer1["tran_date"]."::".$customer1["payment_type"]."::".$customer1["credit"]."::".$customer1["debit"]."::".$customer1["note"]."::";
      }
 }
 
 
 
 
 
 
 include_once 'connection/db1.php';

 $member_type=8;
 $session_id=1;
 	$session_branch=1;
$temp_data=explode("//", $partner_data);
 
 $command = "SELECT MAX(sk_member_id) as maxid FROM mst_member";
$cNo=0;
$result = mysql_query($command, $con);
while ($row = mysql_fetch_assoc($result)){
	$cNo = $row['maxid'];
}

$cNo++;

 for($i=1;$i<sizeof($temp_data);$i++){
 	
 	
 	$temp=explode("::", $temp_data[$i]);
 	$member_name=$temp[0];
 	$per="0";
 	$phone1=$temp[1];
 	$doj="0000-00-00";
 	$member_status="active";
 	$salary="0";
 	$login_name="";
 	$login_password="";
 	$login_status="";
 	$phone2="";
 	$email="";
 	$address="";
 	$place="";
 	
 	$old_id=$temp[2];
 	$balance=$temp[3];
 	
 	
	$query ="INSERT INTO mst_member (sk_member_id,percentage, member_type, member_name, acc_no, ifsc, mobile, landline, email, address, place, state, profile_pic,doj,salary, login_name, login_password, login_status,employee_id, branch_id,old_refid)
	VALUES ('$cNo','$per','$member_type','$member_name','','','$phone1','$phone2','$email','$address','$place','','','$doj','$salary','$login_name','$login_password','login_status','$session_id','$session_branch','$old_id')";
	mysql_query($query);
	
	$log_id=0;$command = "SELECT MAX(sk_log_id) as maxid FROM txn_log";$result = mysql_query($command, $con);while ($row = mysql_fetch_assoc($result)){$log_id = $row['maxid'];}$log_id++;
	$query ="INSERT INTO txn_log (sk_log_id, tran_type, tran_desc,log_date, log_time, tran_id, transaction_id, tran_table, branch_id, employee_id)
	VALUES ('$log_id','Hand Loan','New Hand Loan Added','2016-04-01',now(),'$cNo','$cNo','mst_member','$session_branch','$session_id')";
	mysql_query($query);
	
	$command = "SELECT MAX(sk_tran_id) as maxid FROM txn_transaction";
	$tran_id=0;
	$result = mysql_query($command, $con);
	while ($row = mysql_fetch_assoc($result))
	{
		$tran_id = $row['maxid'];
	}$tran_id++;
	
	$query="INSERT INTO txn_transaction(sk_tran_id,tran_date,tran_time, credit, debit,member_id, transaction_ref_id, ref_table, tran_type, tran_desc, note,tran_status, employee_id, branch_id)
	VALUES ('$tran_id','2016-10-31',now(),'$balance','0','$cNo','0','mst_member','Hand Loan','Ledger Balance','Ledger Balance as of 31-03-2016','active','$session_id','$session_branch')";
	mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());

	$cNo++;

 }


 	$temp_date=explode("//", $partner_tran);
 	for($i=1;$i<sizeof($temp_date);$i++){
 		
 		$temp=explode("::", $temp_date[$i]);
 		$old_ref=$temp[0];
 		$tran_date=$temp[1];
 		$tran_type=$temp[2];
 		$debit=$temp[3];
 		$credit=$temp[4];
 		$time="";
 		
 		$note=$temp[5];
 		$tran_id=0;
 		$transaction_id=0;
 		
 		
 		$bank_id=$temp[6];	
 	$sk_member_id=0;
	$data = mysql_query("SELECT sk_member_id,mobile,place FROM mst_member where old_refid='$old_ref' and member_type=8");
	while($info = mysql_fetch_array( $data ))
	{
	 $sk_member_id=$info["sk_member_id"];    
	 $mobile=$info["mobile"];   
	 $place=$info["place"];                          	
	}
 		
 	$command = "SELECT MAX(sk_tran_id) as maxid FROM txn_transaction";
	$sk_tran_id=0;$result = mysql_query($command, $con);while ($row = mysql_fetch_assoc($result)){$sk_tran_id = $row['maxid'];}$sk_tran_id++;
 	
 			
 			$query="INSERT INTO txn_transaction(sk_tran_id,tran_date,tran_time, credit, debit,member_id, transaction_ref_id, ref_table, tran_type, tran_desc, note,tran_status, employee_id, branch_id)
		VALUES ('$sk_tran_id','$tran_date','$time','$credit','$debit','$sk_member_id','$transaction_id','mst_member','Hand Loan','$tran_type','$note','active','$session_id','$session_branch')";
		mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
	
 	}
 
 
 