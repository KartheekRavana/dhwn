<?php include_once "$D_PATH/include/session.php";?>
<?php 
$tran_type=$_POST["tran_type"];
$party=$_POST["party"];
$amt=$_POST["amt"];
$tran_date=$_POST["date"];
$note=$_POST["note"];
$branch=$_POST["session_branch"];
$session_id=$_POST["session_id"];
$pay_type=$_POST["pay_type"];
$tran_desc=$_POST["tran_desc"];
$bank_id=$pay_type;
$amount=$amt;

$command = "SELECT MAX(sk_tran_id) as maxid FROM txn_transaction";
	$tran_id=0;
	$result = mysql_query($command, $con);
	while ($row = mysql_fetch_assoc($result))
	{
		$tran_id = $row['maxid'];
	}$tran_id++;
	
	$btran_id=$tran_id+1;
	
	if($tran_desc=="Pay"){
	if($pay_type!="Cash" && $tran_type=="Customer"){
		$expense_id=$party;$expense_date=$tran_date;
	$expense_amount=$amt;$expense_note=$note;
		$query="INSERT INTO txn_transaction(sk_tran_id,tran_date,tran_time, credit, debit,member_id, transaction_ref_id, ref_table, tran_type, tran_desc, note,tran_status, employee_id, branch_id)
	VALUES ('$btran_id','$expense_date',now(),'$expense_amount','0','$pay_type','$tran_id','mst_member','Bank','$tran_type Deposit','$note','active','$session_id','$session_branch')";
	mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
		
	}
	else if($pay_type!="Cash" && $tran_type=="Bank"){
		$expense_id=$party;$expense_date=$tran_date;
	$expense_amount=$amt;$expense_note=$note;
		$query="INSERT INTO txn_transaction(sk_tran_id,tran_date,tran_time, credit, debit,member_id, transaction_ref_id, ref_table, tran_type, tran_desc, note,tran_status, employee_id, branch_id)
	VALUES ('$btran_id','$expense_date',now(),'$expense_amount','0','$pay_type','$tran_id','mst_member','Bank','$tran_type Transfer','$note','active','$session_id','$session_branch')";
	mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
		
	}
	else if($pay_type!="Cash"){
		$expense_id=$party;$expense_date=$tran_date;
	$expense_amount=$amt;$expense_note=$note;
		$query="INSERT INTO txn_transaction(sk_tran_id,tran_date,tran_time, credit, debit,member_id, transaction_ref_id, ref_table, tran_type, tran_desc, note,tran_status, employee_id, branch_id)
	VALUES ('$btran_id','$expense_date',now(),'0','$expense_amount','$pay_type','$tran_id','mst_member','Bank','$tran_type Payment','$note','active','$session_id','$session_branch')";
	mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
		
	}
	}else{
		
	if($pay_type!="Cash" && $tran_type=="Customer"){
		$expense_id=$party;$expense_date=$tran_date;
	$expense_amount=$amt;$expense_note=$note;
		$query="INSERT INTO txn_transaction(sk_tran_id,tran_date,tran_time, credit, debit,member_id, transaction_ref_id, ref_table, tran_type, tran_desc, note,tran_status, employee_id, branch_id)
	VALUES ('$btran_id','$expense_date',now(),'0','$expense_amount','$pay_type','$tran_id','mst_member','Bank','$tran_type Payment','$note','active','$session_id','$session_branch')";
	mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
		
	}else if($pay_type!="Cash"){
		
		$expense_id=$party;$expense_date=$tran_date;
	$expense_amount=$amt;$expense_note=$note;
		$query="INSERT INTO txn_transaction(sk_tran_id,tran_date,tran_time, credit, debit,member_id, transaction_ref_id, ref_table, tran_type, tran_desc, note,tran_status, employee_id, branch_id)
	VALUES ('$btran_id','$expense_date',now(),'$expense_amount','0','$pay_type','$tran_id','mst_member','Bank','$tran_type Deposit','$note','active','$session_id','$session_branch')";
	mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
		
	}
		
	}

if($pay_type=="Cash"){$btran_id=0;}
if($tran_type=="Expenses")
{
	$expense_id=$party;$expense_date=$tran_date;
	$expense_amount=$amt;$expense_note=$note;
	$query1=mysql_query("select expense_name from mst_expenselist where expense_id=$expense_id");
	while($info = mysql_fetch_array( $query1 ))
	$expense_name=$info['expense_name'];
	
	
	
	$message="Name:".$expense_name.",Amount".$expense_amount.",Note:".$expense_note;
	
	$query="INSERT INTO txn_transaction(sk_tran_id,tran_date,tran_time, credit, debit,member_id, transaction_ref_id, ref_table, tran_type, tran_desc, note,tran_status, employee_id, branch_id)
	VALUES ('$tran_id','$expense_date',now(),'0','$expense_amount','$expense_id','$btran_id','mst_expenselist','Expense','$expense_name','$expense_note','active','$session_id','$session_branch')";
	mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
	
	//**********************************LOG START****************************************************
	$log_id=0;$command = "SELECT MAX(sk_log_id) as maxid FROM txn_log";$result = mysql_query($command, $con);while ($row = mysql_fetch_assoc($result)){$log_id = $row['maxid'];}$log_id++;
	$query ="INSERT INTO txn_log (sk_log_id, tran_date, tran_time, member_type, tran_type, tran_desc, tran_table, member_id, bill_id, tran_id, branch_id, employee_id)
	VALUES ('$log_id','$date',now(),'Expenses','New','$message','txn_transaction','$expense_id','$btran_id','$tran_id','$session_branch','$session_id')";
	mysql_query($query);
	//**********************************LOG END****************************************************
	
}
if($tran_type=="Customer")
{
	$expense_id=$party;$expense_date=$tran_date;
	$expense_amount=$amt;$expense_note=$note;

	
	if($tran_desc=="Return"){
		$message="Amount:".$expense_amount.",Note:".$expense_note;
		$query="INSERT INTO txn_transaction(sk_tran_id,tran_date,tran_time, credit, debit,member_id, transaction_ref_id, ref_table, tran_type, tran_desc, note,tran_status, employee_id, branch_id)
		VALUES ('$tran_id','$expense_date',now(),'$expense_amount','0','$expense_id','$btran_id','mst_member','Customer','Payment Return','$expense_note','active','$session_id','$session_branch')";
		mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
		
		//**********************************LOG START****************************************************
		$log_id=0;$command = "SELECT MAX(sk_log_id) as maxid FROM txn_log";$result = mysql_query($command, $con);while ($row = mysql_fetch_assoc($result)){$log_id = $row['maxid'];}$log_id++;
		$query ="INSERT INTO txn_log (sk_log_id, tran_date, tran_time, member_type, tran_type, tran_desc, tran_table, member_id, bill_id, tran_id, branch_id, employee_id)
		VALUES ('$log_id','$date',now(),'Customer','Payment Return','$message','txn_transaction','$expense_id','$btran_id','$tran_id','$session_branch','$session_id')";
		mysql_query($query);
		//**********************************LOG END****************************************************
	}
	else{
		$message="Amount:".$expense_amount.",Note:".$expense_note;
	$query="INSERT INTO txn_transaction(sk_tran_id,tran_date,tran_time, credit, debit,member_id, transaction_ref_id, ref_table, tran_type, tran_desc, note,tran_status, employee_id, branch_id)
	VALUES ('$tran_id','$expense_date',now(),'0','$expense_amount','$expense_id','$btran_id','mst_member','Customer','Payment','$expense_note','active','$session_id','$session_branch')";
	mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
	
	//**********************************LOG START****************************************************
	$log_id=0;$command = "SELECT MAX(sk_log_id) as maxid FROM txn_log";$result = mysql_query($command, $con);while ($row = mysql_fetch_assoc($result)){$log_id = $row['maxid'];}$log_id++;
	$query ="INSERT INTO txn_log (sk_log_id, tran_date, tran_time, member_type, tran_type, tran_desc, tran_table, member_id, bill_id, tran_id, branch_id, employee_id)
	VALUES ('$log_id','$date',now(),'Customer','Payment','$message','txn_transaction','$expense_id','$btran_id','$tran_id','$session_branch','$session_id')";
	mysql_query($query);
	//**********************************LOG END****************************************************
	}
}
if($tran_type=="Supplier")
{
	$expense_id=$party;$expense_date=$tran_date;
	$expense_amount=$amt;$expense_note=$note;

	
	if($tran_desc=="Return"){
		$message="Amount:".$expense_amount.",Note:".$expense_note;
		$query="INSERT INTO txn_transaction(sk_tran_id,tran_date,tran_time, credit, debit,member_id, transaction_ref_id, ref_table, tran_type, tran_desc, note,tran_status, employee_id, branch_id)
		VALUES ('$tran_id','$expense_date',now(),'$expense_amount','0','$expense_id','$btran_id','mst_member','Supplier','Payment Return','$expense_note','active','$session_id','$session_branch')";
		mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
		
		//**********************************LOG START****************************************************
		$log_id=0;$command = "SELECT MAX(sk_log_id) as maxid FROM txn_log";$result = mysql_query($command, $con);while ($row = mysql_fetch_assoc($result)){$log_id = $row['maxid'];}$log_id++;
		$query ="INSERT INTO txn_log (sk_log_id, tran_date, tran_time, member_type, tran_type, tran_desc, tran_table, member_id, bill_id, tran_id, branch_id, employee_id)
		VALUES ('$log_id','$date',now(),'Supplier','Payment Return','$message','txn_transaction','$expense_id','$btran_id','$tran_id','$session_branch','$session_id')";
		mysql_query($query);
		//**********************************LOG END****************************************************
		
	}
	else{
		$message="Amount:".$expense_amount.",Note:".$expense_note;
	$query="INSERT INTO txn_transaction(sk_tran_id,tran_date,tran_time, credit, debit,member_id, transaction_ref_id, ref_table, tran_type, tran_desc, note,tran_status, employee_id, branch_id)
	VALUES ('$tran_id','$expense_date',now(),'0','$expense_amount','$expense_id','$btran_id','mst_member','Supplier','Payment','$expense_note','active','$session_id','$session_branch')";
	mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
	
	//**********************************LOG START****************************************************
	$log_id=0;$command = "SELECT MAX(sk_log_id) as maxid FROM txn_log";$result = mysql_query($command, $con);while ($row = mysql_fetch_assoc($result)){$log_id = $row['maxid'];}$log_id++;
	$query ="INSERT INTO txn_log (sk_log_id, tran_date, tran_time, member_type, tran_type, tran_desc, tran_table, member_id, bill_id, tran_id, branch_id, employee_id)
	VALUES ('$log_id','$date',now(),'Supplier','Payment','$message','txn_transaction','$expense_id','$btran_id','$tran_id','$session_branch','$session_id')";
	mysql_query($query);
	//**********************************LOG END****************************************************
	}
}
if($tran_type=="Auto")
{
	$expense_id=$party;$expense_date=$tran_date;
	$expense_amount=$amt;$expense_note=$note;

	
	if($tran_desc=="Return"){
		$message="Amount:".$expense_amount.",Note:".$expense_note;
		$query="INSERT INTO txn_transaction(sk_tran_id,tran_date,tran_time, credit, debit,member_id, transaction_ref_id, ref_table, tran_type, tran_desc, note,tran_status, employee_id, branch_id)
		VALUES ('$tran_id','$expense_date',now(),'$expense_amount','0','$expense_id','$btran_id','mst_member','Transport','Payment Return','$expense_note','active','$session_id','$session_branch')";
		mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
		//**********************************LOG START****************************************************
		$log_id=0;$command = "SELECT MAX(sk_log_id) as maxid FROM txn_log";$result = mysql_query($command, $con);while ($row = mysql_fetch_assoc($result)){$log_id = $row['maxid'];}$log_id++;
		$query ="INSERT INTO txn_log (sk_log_id, tran_date, tran_time, member_type, tran_type, tran_desc, tran_table, member_id, bill_id, tran_id, branch_id, employee_id)
		VALUES ('$log_id','$date',now(),'Transport','Payment Return','$message','txn_transaction','$expense_id','$btran_id','$tran_id','$session_branch','$session_id')";
		mysql_query($query);
		//**********************************LOG END****************************************************
	}else{
		$message="Amount:".$expense_amount.",Note:".$expense_note;
	$query="INSERT INTO txn_transaction(sk_tran_id,tran_date,tran_time, credit, debit,member_id, transaction_ref_id, ref_table, tran_type, tran_desc, note,tran_status, employee_id, branch_id)
	VALUES ('$tran_id','$expense_date',now(),'0','$expense_amount','$expense_id','$btran_id','mst_member','Transport','Payment','$expense_note','active','$session_id','$session_branch')";
	mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
	//**********************************LOG START****************************************************
	$log_id=0;$command = "SELECT MAX(sk_log_id) as maxid FROM txn_log";$result = mysql_query($command, $con);while ($row = mysql_fetch_assoc($result)){$log_id = $row['maxid'];}$log_id++;
	$query ="INSERT INTO txn_log (sk_log_id, tran_date, tran_time, member_type, tran_type, tran_desc, tran_table, member_id, bill_id, tran_id, branch_id, employee_id)
	VALUES ('$log_id','$date',now(),'Transport','Payment','$message','txn_transaction','$expense_id','$btran_id','$tran_id','$session_branch','$session_id')";
	mysql_query($query);
	//**********************************LOG END****************************************************
	}
}
if($tran_type=="Agent")
{
	$expense_id=$party;$expense_date=$tran_date;
	$expense_amount=$amt;$expense_note=$note;

	
	if($tran_desc=="Return"){
		$message="Amount:".$expense_amount.",Note:".$expense_note;
		$query="INSERT INTO txn_transaction(sk_tran_id,tran_date,tran_time, credit, debit,member_id, transaction_ref_id, ref_table, tran_type, tran_desc, note,tran_status, employee_id, branch_id)
		VALUES ('$tran_id','$expense_date',now(),'$expense_amount','0','$expense_id','$btran_id','mst_member','Agent','Payment Return','$expense_note','active','$session_id','$session_branch')";
		mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
		//**********************************LOG START****************************************************
		$log_id=0;$command = "SELECT MAX(sk_log_id) as maxid FROM txn_log";$result = mysql_query($command, $con);while ($row = mysql_fetch_assoc($result)){$log_id = $row['maxid'];}$log_id++;
		$query ="INSERT INTO txn_log (sk_log_id, tran_date, tran_time, member_type, tran_type, tran_desc, tran_table, member_id, bill_id, tran_id, branch_id, employee_id)
		VALUES ('$log_id','$date',now(),'Agent','Payment Return','$message','txn_transaction','$expense_id','$btran_id','$tran_id','$session_branch','$session_id')";
		mysql_query($query);
		//**********************************LOG END****************************************************
	}else{
		$message="Amount:".$expense_amount.",Note:".$expense_note;
	$query="INSERT INTO txn_transaction(sk_tran_id,tran_date,tran_time, credit, debit,member_id, transaction_ref_id, ref_table, tran_type, tran_desc, note,tran_status, employee_id, branch_id)
	VALUES ('$tran_id','$expense_date',now(),'0','$expense_amount','$expense_id','$btran_id','mst_member','Agent','Payment','$expense_note','active','$session_id','$session_branch')";
	mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
	//**********************************LOG START****************************************************
	$log_id=0;$command = "SELECT MAX(sk_log_id) as maxid FROM txn_log";$result = mysql_query($command, $con);while ($row = mysql_fetch_assoc($result)){$log_id = $row['maxid'];}$log_id++;
	$query ="INSERT INTO txn_log (sk_log_id, tran_date, tran_time, member_type, tran_type, tran_desc, tran_table, member_id, bill_id, tran_id, branch_id, employee_id)
	VALUES ('$log_id','$date',now(),'Agent','Payment','$message','txn_transaction','$expense_id','$btran_id','$tran_id','$session_branch','$session_id')";
	mysql_query($query);
	//**********************************LOG END****************************************************
	}
}
if($tran_type=="Employee")
{
	$expense_id=$party;$expense_date=$tran_date;
	$expense_amount=$amt;$expense_note=$note;

	
	if($tran_desc=="Return"){
		$message="Amount:".$expense_amount.",Note:".$expense_note;
		$query="INSERT INTO txn_transaction(sk_tran_id,tran_date,tran_time, credit, debit,member_id, transaction_ref_id, ref_table, tran_type, tran_desc, note,tran_status, employee_id, branch_id)
		VALUES ('$tran_id','$expense_date',now(),'$expense_amount','0','$expense_id','$btran_id','mst_member','Employee','Payment Return','$expense_note','active','$session_id','$session_branch')";
		mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
		//**********************************LOG START****************************************************
		$log_id=0;$command = "SELECT MAX(sk_log_id) as maxid FROM txn_log";$result = mysql_query($command, $con);while ($row = mysql_fetch_assoc($result)){$log_id = $row['maxid'];}$log_id++;
		$query ="INSERT INTO txn_log (sk_log_id, tran_date, tran_time, member_type, tran_type, tran_desc, tran_table, member_id, bill_id, tran_id, branch_id, employee_id)
		VALUES ('$log_id','$date',now(),'Employee','Payment Return','$message','txn_transaction','$expense_id','$btran_id','$tran_id','$session_branch','$session_id')";
		mysql_query($query);
		//**********************************LOG END****************************************************
	}else{
		$message="Amount:".$expense_amount.",Note:".$expense_note;
	$query="INSERT INTO txn_transaction(sk_tran_id,tran_date,tran_time, credit, debit,member_id, transaction_ref_id, ref_table, tran_type, tran_desc, note,tran_status, employee_id, branch_id)
	VALUES ('$tran_id','$expense_date',now(),'0','$expense_amount','$expense_id','$btran_id','mst_member','Employee','Payment','$expense_note','active','$session_id','$session_branch')";
	mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
	//**********************************LOG START****************************************************
	$log_id=0;$command = "SELECT MAX(sk_log_id) as maxid FROM txn_log";$result = mysql_query($command, $con);while ($row = mysql_fetch_assoc($result)){$log_id = $row['maxid'];}$log_id++;
	$query ="INSERT INTO txn_log (sk_log_id, tran_date, tran_time, member_type, tran_type, tran_desc, tran_table, member_id, bill_id, tran_id, branch_id, employee_id)
	VALUES ('$log_id','$date',now(),'Employee','Payment','$message','txn_transaction','$expense_id','$btran_id','$tran_id','$session_branch','$session_id')";
	mysql_query($query);
	//**********************************LOG END****************************************************
	}
}
if($tran_type=="Partner")
{
	$expense_id=$party;$expense_date=$tran_date;
	$expense_amount=$amt;$expense_note=$note;

	
	if($tran_desc=="Return"){
		$message="Amount:".$expense_amount.",Note:".$expense_note;
		$query="INSERT INTO txn_transaction(sk_tran_id,tran_date,tran_time, credit, debit,member_id, transaction_ref_id, ref_table, tran_type, tran_desc, note,tran_status, employee_id, branch_id)
		VALUES ('$tran_id','$expense_date',now(),'$expense_amount','0','$expense_id','$btran_id','mst_member','Partner','Payment Return','$expense_note','active','$session_id','$session_branch')";
		mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
		//**********************************LOG START****************************************************
		$log_id=0;$command = "SELECT MAX(sk_log_id) as maxid FROM txn_log";$result = mysql_query($command, $con);while ($row = mysql_fetch_assoc($result)){$log_id = $row['maxid'];}$log_id++;
		$query ="INSERT INTO txn_log (sk_log_id, tran_date, tran_time, member_type, tran_type, tran_desc, tran_table, member_id, bill_id, tran_id, branch_id, employee_id)
		VALUES ('$log_id','$date',now(),'Partner','Payment Return','$message','txn_transaction','$expense_id','$btran_id','$tran_id','$session_branch','$session_id')";
		mysql_query($query);
		//**********************************LOG END****************************************************
	}else{
		$message="Amount:".$expense_amount.",Note:".$expense_note;
	$query="INSERT INTO txn_transaction(sk_tran_id,tran_date,tran_time, credit, debit,member_id, transaction_ref_id, ref_table, tran_type, tran_desc, note,tran_status, employee_id, branch_id)
	VALUES ('$tran_id','$expense_date',now(),'0','$expense_amount','$expense_id','$btran_id','mst_member','Partner','Payment','$expense_note','active','$session_id','$session_branch')";
	mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
	//**********************************LOG START****************************************************
	$log_id=0;$command = "SELECT MAX(sk_log_id) as maxid FROM txn_log";$result = mysql_query($command, $con);while ($row = mysql_fetch_assoc($result)){$log_id = $row['maxid'];}$log_id++;
	$query ="INSERT INTO txn_log (sk_log_id, tran_date, tran_time, member_type, tran_type, tran_desc, tran_table, member_id, bill_id, tran_id, branch_id, employee_id)
	VALUES ('$log_id','$date',now(),'Partner','Payment','$message','txn_transaction','$expense_id','$btran_id','$tran_id','$session_branch','$session_id')";
	mysql_query($query);
	//**********************************LOG END****************************************************
	}
}
if($tran_type=="Hand Loan")
{
	$expense_id=$party;$expense_date=$tran_date;
	$expense_amount=$amt;$expense_note=$note;

	if($tran_desc=="Return"){
		$message="Amount:".$expense_amount.",Note:".$expense_note;
		$query="INSERT INTO txn_transaction(sk_tran_id,tran_date,tran_time, credit, debit,member_id, transaction_ref_id, ref_table, tran_type, tran_desc, note,tran_status, employee_id, branch_id)
		VALUES ('$tran_id','$expense_date',now(),'0','$expense_amount','$expense_id','$btran_id','mst_member','Hand Loan','Payment Return','$expense_note','active','$session_id','$session_branch')";
		mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
		//**********************************LOG START****************************************************
		$log_id=0;$command = "SELECT MAX(sk_log_id) as maxid FROM txn_log";$result = mysql_query($command, $con);while ($row = mysql_fetch_assoc($result)){$log_id = $row['maxid'];}$log_id++;
		$query ="INSERT INTO txn_log (sk_log_id, tran_date, tran_time, member_type, tran_type, tran_desc, tran_table, member_id, bill_id, tran_id, branch_id, employee_id)
		VALUES ('$log_id','$date',now(),'Hand Loan','Payment Return','$message','txn_transaction','$expense_id','$btran_id','$tran_id','$session_branch','$session_id')";
		mysql_query($query);
		//**********************************LOG END****************************************************
	}else{
		$message="Amount:".$expense_amount.",Note:".$expense_note;
	$query="INSERT INTO txn_transaction(sk_tran_id,tran_date,tran_time, credit, debit,member_id, transaction_ref_id, ref_table, tran_type, tran_desc, note,tran_status, employee_id, branch_id)
	VALUES ('$tran_id','$expense_date',now(),'$expense_amount','0','$expense_id','$btran_id','mst_member','Hand Loan','Payment','$expense_note','active','$session_id','$session_branch')";
	mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
	//**********************************LOG START****************************************************
	$log_id=0;$command = "SELECT MAX(sk_log_id) as maxid FROM txn_log";$result = mysql_query($command, $con);while ($row = mysql_fetch_assoc($result)){$log_id = $row['maxid'];}$log_id++;
	$query ="INSERT INTO txn_log (sk_log_id, tran_date, tran_time, member_type, tran_type, tran_desc, tran_table, member_id, bill_id, tran_id, branch_id, employee_id)
	VALUES ('$log_id','$date',now(),'Hand Loan','Payment','$message','txn_transaction','$expense_id','$btran_id','$tran_id','$session_branch','$session_id')";
	mysql_query($query);
	//**********************************LOG END****************************************************
	}
}
if($tran_type=="Hamali")
{
	$expense_id=$party;$expense_date=$tran_date;
	$expense_amount=$amt;$expense_note=$note;

	
	if($tran_desc=="Return"){
		$message="Amount:".$expense_amount.",Note:".$expense_note;
		$query="INSERT INTO txn_transaction(sk_tran_id,tran_date,tran_time, credit, debit,member_id, transaction_ref_id, ref_table, tran_type, tran_desc, note,tran_status, employee_id, branch_id)
		VALUES ('$tran_id','$expense_date',now(),'$expense_amount','0','$expense_id','$btran_id','mst_member','Hamali','Payment Return','$expense_note','active','$session_id','$session_branch')";
		mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
		//**********************************LOG START****************************************************
		$log_id=0;$command = "SELECT MAX(sk_log_id) as maxid FROM txn_log";$result = mysql_query($command, $con);while ($row = mysql_fetch_assoc($result)){$log_id = $row['maxid'];}$log_id++;
		$query ="INSERT INTO txn_log (sk_log_id, tran_date, tran_time, member_type, tran_type, tran_desc, tran_table, member_id, bill_id, tran_id, branch_id, employee_id)
		VALUES ('$log_id','$date',now(),'Hamali','Payment Return','$message','txn_transaction','$expense_id','$btran_id','$tran_id','$session_branch','$session_id')";
		mysql_query($query);
		//**********************************LOG END****************************************************
	}else{
		$message="Amount:".$expense_amount.",Note:".$expense_note;
	$query="INSERT INTO txn_transaction(sk_tran_id,tran_date,tran_time, credit, debit,member_id, transaction_ref_id, ref_table, tran_type, tran_desc, note,tran_status, employee_id, branch_id)
	VALUES ('$tran_id','$expense_date',now(),'0','$expense_amount','$expense_id','$btran_id','mst_member','Hamali','Payment','$expense_note','active','$session_id','$session_branch')";
	mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
	//**********************************LOG START****************************************************
	$log_id=0;$command = "SELECT MAX(sk_log_id) as maxid FROM txn_log";$result = mysql_query($command, $con);while ($row = mysql_fetch_assoc($result)){$log_id = $row['maxid'];}$log_id++;
	$query ="INSERT INTO txn_log (sk_log_id, tran_date, tran_time, member_type, tran_type, tran_desc, tran_table, member_id, bill_id, tran_id, branch_id, employee_id)
	VALUES ('$log_id','$date',now(),'Hamali','Payment','$message','txn_transaction','$expense_id','$btran_id','$tran_id','$session_branch','$session_id')";
	mysql_query($query);
	//**********************************LOG END****************************************************
	}
}
if($tran_type=="Rent")
{
	$expense_id=$party;$expense_date=$tran_date;
	$expense_amount=$amt;$expense_note=$note;

	
	if($tran_desc=="Return"){
		$message="Amount:".$expense_amount.",Note:".$expense_note;
		$query="INSERT INTO txn_transaction(sk_tran_id,tran_date,tran_time, credit, debit,member_id, transaction_ref_id, ref_table, tran_type, tran_desc, note,tran_status, employee_id, branch_id)
		VALUES ('$tran_id','$expense_date',now(),'$expense_amount','0','$expense_id','$btran_id','mst_member','Rent','Payment Return','$expense_note','active','$session_id','$session_branch')";
		mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
		//**********************************LOG START****************************************************
		$log_id=0;$command = "SELECT MAX(sk_log_id) as maxid FROM txn_log";$result = mysql_query($command, $con);while ($row = mysql_fetch_assoc($result)){$log_id = $row['maxid'];}$log_id++;
		$query ="INSERT INTO txn_log (sk_log_id, tran_date, tran_time, member_type, tran_type, tran_desc, tran_table, member_id, bill_id, tran_id, branch_id, employee_id)
		VALUES ('$log_id','$date',now(),'Rent','Payment Return','$message','txn_transaction','$expense_id','$btran_id','$tran_id','$session_branch','$session_id')";
		mysql_query($query);
		//**********************************LOG END****************************************************
	}else{
		$message="Amount:".$expense_amount.",Note:".$expense_note;
	$query="INSERT INTO txn_transaction(sk_tran_id,tran_date,tran_time, credit, debit,member_id, transaction_ref_id, ref_table, tran_type, tran_desc, note,tran_status, employee_id, branch_id)
	VALUES ('$tran_id','$expense_date',now(),'0','$expense_amount','$expense_id','$btran_id','mst_member','Rent','Payment','$expense_note','active','$session_id','$session_branch')";
	mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
	//**********************************LOG START****************************************************
	$log_id=0;$command = "SELECT MAX(sk_log_id) as maxid FROM txn_log";$result = mysql_query($command, $con);while ($row = mysql_fetch_assoc($result)){$log_id = $row['maxid'];}$log_id++;
	$query ="INSERT INTO txn_log (sk_log_id, tran_date, tran_time, member_type, tran_type, tran_desc, tran_table, member_id, bill_id, tran_id, branch_id, employee_id)
	VALUES ('$log_id','$date',now(),'Rent','Payment','$message','txn_transaction','$expense_id','$btran_id','$tran_id','$session_branch','$session_id')";
	mysql_query($query);
	//**********************************LOG END****************************************************
	}
}
if($tran_type=="Investment")
{
	$expense_id=$party;$expense_date=$tran_date;
	$expense_amount=$amt;$expense_note=$note;


	if($tran_desc=="Return"){
		$message="Amount:".$expense_amount.",Note:".$expense_note;
		$query="INSERT INTO txn_transaction(sk_tran_id,tran_date,tran_time, credit, debit,member_id, transaction_ref_id, ref_table, tran_type, tran_desc, note,tran_status, employee_id, branch_id)
		VALUES ('$tran_id','$expense_date',now(),'$expense_amount','0','$expense_id','$btran_id','mst_member','Investment','Returns','$expense_note','active','$session_id','$session_branch')";
		mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
		//**********************************LOG START****************************************************
		$log_id=0;$command = "SELECT MAX(sk_log_id) as maxid FROM txn_log";$result = mysql_query($command, $con);while ($row = mysql_fetch_assoc($result)){$log_id = $row['maxid'];}$log_id++;
		$query ="INSERT INTO txn_log (sk_log_id, tran_date, tran_time, member_type, tran_type, tran_desc, tran_table, member_id, bill_id, tran_id, branch_id, employee_id)
		VALUES ('$log_id','$date',now(),'Investment','Returns','$message','txn_transaction','$expense_id','$btran_id','$tran_id','$session_branch','$session_id')";
		mysql_query($query);
		//**********************************LOG END****************************************************
	}else{
		$message="Amount:".$expense_amount.",Note:".$expense_note;
	$query="INSERT INTO txn_transaction(sk_tran_id,tran_date,tran_time, credit, debit,member_id, transaction_ref_id, ref_table, tran_type, tran_desc, note,tran_status, employee_id, branch_id)
	VALUES ('$tran_id','$expense_date',now(),'0','$expense_amount','$expense_id','$btran_id','mst_member','Investment','Payment','$expense_note','active','$session_id','$session_branch')";
	mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
	//**********************************LOG START****************************************************
	$log_id=0;$command = "SELECT MAX(sk_log_id) as maxid FROM txn_log";$result = mysql_query($command, $con);while ($row = mysql_fetch_assoc($result)){$log_id = $row['maxid'];}$log_id++;
	$query ="INSERT INTO txn_log (sk_log_id, tran_date, tran_time, member_type, tran_type, tran_desc, tran_table, member_id, bill_id, tran_id, branch_id, employee_id)
	VALUES ('$log_id','$date',now(),'Investment','Payment','$message','txn_transaction','$expense_id','$btran_id','$tran_id','$session_branch','$session_id')";
	mysql_query($query);
	//**********************************LOG END****************************************************
	}
}

if($tran_type=="Bank")
{
	$expense_id=$party;$expense_date=$tran_date;
	$expense_amount=$amt;$expense_note=$note;

	
	if($tran_desc=="Return"){
		$message="Amount:".$expense_amount.",Note:".$expense_note;
		$query="INSERT INTO txn_transaction(sk_tran_id,tran_date,tran_time, credit, debit,member_id, transaction_ref_id, ref_table, tran_type, tran_desc, note,tran_status, employee_id, branch_id)
		VALUES ('$tran_id','$expense_date',now(),'$expense_amount','0','$expense_id','$btran_id','mst_member','Bank','Deposit','$expense_note','active','$session_id','$session_branch')";
		mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
		//**********************************LOG START****************************************************
		$log_id=0;$command = "SELECT MAX(sk_log_id) as maxid FROM txn_log";$result = mysql_query($command, $con);while ($row = mysql_fetch_assoc($result)){$log_id = $row['maxid'];}$log_id++;
		$query ="INSERT INTO txn_log (sk_log_id, tran_date, tran_time, member_type, tran_type, tran_desc, tran_table, member_id, bill_id, tran_id, branch_id, employee_id)
		VALUES ('$log_id','$date',now(),'Bank','Deposit','$message','txn_transaction','$expense_id','$btran_id','$tran_id','$session_branch','$session_id')";
		mysql_query($query);
		//**********************************LOG END****************************************************
	}else{
		$message="Amount:".$expense_amount.",Note:".$expense_note;
	$query="INSERT INTO txn_transaction(sk_tran_id,tran_date,tran_time, credit, debit,member_id, transaction_ref_id, ref_table, tran_type, tran_desc, note,tran_status, employee_id, branch_id)
	VALUES ('$tran_id','$expense_date',now(),'0','$expense_amount','$expense_id','$btran_id','mst_member','Bank','Withdraw','$expense_note','active','$session_id','$session_branch')";
	mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
	//**********************************LOG START****************************************************
	$log_id=0;$command = "SELECT MAX(sk_log_id) as maxid FROM txn_log";$result = mysql_query($command, $con);while ($row = mysql_fetch_assoc($result)){$log_id = $row['maxid'];}$log_id++;
	$query ="INSERT INTO txn_log (sk_log_id, tran_date, tran_time, member_type, tran_type, tran_desc, tran_table, member_id, bill_id, tran_id, branch_id, employee_id)
	VALUES ('$log_id','$date',now(),'Bank','Withdraw','$message','txn_transaction','$expense_id','$btran_id','$tran_id','$session_branch','$session_id')";
	mysql_query($query);
	//**********************************LOG END****************************************************
	}
}

if($tran_type=="Vat")
{
	$expense_id=$party;$expense_date=$tran_date;
	$expense_amount=$amt;$expense_note=$note;

	
	if($tran_desc=="Return"){
		$message="Amount:".$expense_amount.",Note:".$expense_note;
		$query="INSERT INTO txn_transaction(sk_tran_id,tran_date,tran_time, credit, debit,member_id, transaction_ref_id, ref_table, tran_type, tran_desc, note,tran_status, employee_id, branch_id)
		VALUES ('$tran_id','$expense_date',now(),'$expense_amount','0','$expense_id','$btran_id','mst_member','Vat','Payment Return','$expense_note','active','$session_id','$session_branch')";
		mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
		//**********************************LOG START****************************************************
		$log_id=0;$command = "SELECT MAX(sk_log_id) as maxid FROM txn_log";$result = mysql_query($command, $con);while ($row = mysql_fetch_assoc($result)){$log_id = $row['maxid'];}$log_id++;
		$query ="INSERT INTO txn_log (sk_log_id, tran_date, tran_time, member_type, tran_type, tran_desc, tran_table, member_id, bill_id, tran_id, branch_id, employee_id)
		VALUES ('$log_id','$date',now(),'Rent','Payment Return','$message','txn_transaction','$expense_id','$btran_id','$tran_id','$session_branch','$session_id')";
		mysql_query($query);
		//**********************************LOG END****************************************************
	}else{
		$message="Amount:".$expense_amount.",Note:".$expense_note;
	$query="INSERT INTO txn_transaction(sk_tran_id,tran_date,tran_time, credit, debit,member_id, transaction_ref_id, ref_table, tran_type, tran_desc, note,tran_status, employee_id, branch_id)
	VALUES ('$tran_id','$expense_date',now(),'0','$expense_amount','$expense_id','$btran_id','mst_member','Vat','Payment','$expense_note','active','$session_id','$session_branch')";
	mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
	//**********************************LOG START****************************************************
	$log_id=0;$command = "SELECT MAX(sk_log_id) as maxid FROM txn_log";$result = mysql_query($command, $con);while ($row = mysql_fetch_assoc($result)){$log_id = $row['maxid'];}$log_id++;
	$query ="INSERT INTO txn_log (sk_log_id, tran_date, tran_time, member_type, tran_type, tran_desc, tran_table, member_id, bill_id, tran_id, branch_id, employee_id)
	VALUES ('$log_id','$date',now(),'Rent','Payment','$message','txn_transaction','$expense_id','$btran_id','$tran_id','$session_branch','$session_id')";
	mysql_query($query);
	//**********************************LOG END****************************************************
	}
}
?>
<input type="hidden" id="tran_date" value="<?php echo $tran_date?>">
<input type="hidden" id="branch" value="<?php echo $branch?>">
<script>
var branch=document.getElementById("branch").value
var tran_date=document.getElementById("tran_date").value
window.location="index.php?action=daybook&c=reports&from_date="+tran_date;
</script>
