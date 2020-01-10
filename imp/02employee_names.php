<?php
include_once 'connection/db.php';
$employee_data="";
$k=1;
$employee_tran="";
 $data = mysql_query("SELECT employee_id,employee_name,phone,doj,employee_status,salary,login_name,login_password,login_type,login_status FROM employee order by employee_name asc");
 while($info = mysql_fetch_array( $data ))
 {
                                
	$employee_id=$info["employee_id"];$balance=0;$customer = mysql_query("SELECT credit_amt, debit_amt FROM employee_transactions where employee_id='".$employee_id."' and tran_date<='2016-10-31' order by TRAN_DATE asc");
    while($customer1 = mysql_fetch_array( $customer )){if($customer1['credit_amt']>0 || $customer1['debit_amt']>0){$balance=$balance+$customer1['credit_amt'];$balance=$balance-$customer1['debit_amt'];}}
	
 	$employee_data=$employee_data."//".$info["employee_name"]."::".$info["phone"]."::".$info["doj"]."::".$info["employee_status"]."::".$info["salary"]."::".$info["login_name"]."::".$info["login_password"]."::".$info["login_type"]."::".$info["login_status"]."::".$balance."::".$info["employee_id"]."::";
 	
 	 
      $customer = mysql_query("SELECT employee_id, TRAN_DATE,tran_type,credit_amt, debit_amt,note FROM employee_transactions where employee_id='".$info["employee_id"]."' and tran_date>'2016-10-31' order by TRAN_DATE desc");
      while($customer1 = mysql_fetch_array( $customer ))
      {      	
      	
      	$employee_tran=$employee_tran."//".$employee_id."::".$customer1["TRAN_DATE"]."::".$customer1["tran_type"]."::".$customer1["credit_amt"]."::".$customer1["debit_amt"]."::".$customer1["note"]."::";
      }
 }
 
 
 
 
 
 
 include_once 'connection/db1.php';

 $member_type=1;
 $session_id=1;
 	$session_branch=1;
$temp_data=explode("//", $employee_data);
 
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
 	$phone1=$temp[1];
 	$doj=$temp[2];
 	$member_status=$temp[3];
 	$salary=$temp[4];
 	$login_name=$temp[5];
 	$login_password=$temp[6];
 	$login_status=$temp[7];
 	$phone2="";
 	$email="";
 	$address="";
 	$place="";
 	
 	$old_id=$temp[10];
 	$balance=$temp[9];
 	
 	
	$query ="INSERT INTO mst_member (sk_member_id, member_type, member_name, acc_no, ifsc, mobile, landline, email, address, place, state, profile_pic,doj,salary, login_name, login_password, login_status,employee_id, branch_id,old_refid)
	VALUES ('$cNo','$member_type','$member_name','','','$phone1','$phone2','$email','$address','$place','','','$doj','$salary','$login_name','$login_password','login_status','$session_id','$session_branch','$old_id')";
	mysql_query($query);
	
	$log_id=0;$command = "SELECT MAX(sk_log_id) as maxid FROM txn_log";$result = mysql_query($command, $con);while ($row = mysql_fetch_assoc($result)){$log_id = $row['maxid'];}$log_id++;
	$query ="INSERT INTO txn_log (sk_log_id, tran_type, tran_desc,log_date, log_time, tran_id, transaction_id, tran_table, branch_id, employee_id)
	VALUES ('$log_id','Employee','New Employee Added','2016-04-01',now(),'$cNo','$cNo','mst_member','$session_branch','$session_id')";
	mysql_query($query);
	
	$command = "SELECT MAX(sk_tran_id) as maxid FROM txn_transaction";
	$tran_id=0;
	$result = mysql_query($command, $con);
	while ($row = mysql_fetch_assoc($result))
	{
		$tran_id = $row['maxid'];
	}$tran_id++;
	
	$query="INSERT INTO txn_transaction(sk_tran_id,tran_date,tran_time, credit, debit,member_id, transaction_ref_id, ref_table, tran_type, tran_desc, note,tran_status, employee_id, branch_id)
	VALUES ('$tran_id','2016-10-31',now(),'$balance','0','$cNo','0','mst_member','Employee','Ledger Balance','Ledger Balance as of 31-03-2016','active','$session_id','$session_branch')";
	mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());

	$cNo++;

 }


 	$temp_date=explode("//", $employee_tran);
 	for($i=1;$i<sizeof($temp_date);$i++){
 		
 		$temp=explode("::", $temp_date[$i]);
 		$old_ref=$temp[0];
 		$tran_date=$temp[1];
 		$tran_type=$temp[2];
 		$credit=$temp[3];
 		$debit=$temp[4];
 		$time="";
 		
 		$note=$temp[5];
 		$tran_id=0;
 		$transaction_id=0;
 		
 		
 		$bank_id=0;	
 	$sk_member_id=0;
	$data = mysql_query("SELECT sk_member_id,mobile,place FROM mst_member where old_refid='$old_ref' and member_type=1");
	while($info = mysql_fetch_array( $data ))
	{
	 $sk_member_id=$info["sk_member_id"];    
	 $mobile=$info["mobile"];   
	 $place=$info["place"];                          	
	}
 		
 	$command = "SELECT MAX(sk_tran_id) as maxid FROM txn_transaction";
	$sk_tran_id=0;$result = mysql_query($command, $con);while ($row = mysql_fetch_assoc($result)){$sk_tran_id = $row['maxid'];}$sk_tran_id++;
 	
 		if($tran_type=="BANK"){
 			
 			$query="INSERT INTO txn_transaction(sk_tran_id,tran_date,tran_time, credit, debit,member_id, transaction_ref_id, ref_table, tran_type, tran_desc, note,tran_status, employee_id, branch_id)
		VALUES ('$sk_tran_id','$tran_date','$time','$credit','$debit','$sk_member_id','$transaction_id','mst_member','Employee','Bank Payment','$note','active','$session_id','$session_branch')";
		mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
		$t=$sk_tran_id+1;
		echo $query;
		$query="INSERT INTO txn_transaction(sk_tran_id,tran_date,tran_time, credit, debit,member_id, transaction_ref_id, ref_table, tran_type, tran_desc, note,tran_status, employee_id, branch_id)
	VALUES ('$t','$tran_date',now(),'0','$debit','$bank_id ','$sk_tran_id','mst_member','Bank','Employee Deposit','$note','active','$session_id','$session_branch')";
	mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
		
 		}else{
 		$query="INSERT INTO txn_transaction(sk_tran_id,tran_date,tran_time, credit, debit,member_id, transaction_ref_id, ref_table, tran_type, tran_desc, note,tran_status, employee_id, branch_id)
		VALUES ('$sk_tran_id','$tran_date','$time','$credit','$debit','$sk_member_id','0','mst_member','Employee','$tran_type','$note','active','$session_id','$session_branch')";
		mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
 		}
 	}
 
 
 