<?php include_once "$D_PATH/include/session.php";?>
<?php 

$bank_id=$_POST["bank_id"];
$to_bank_id=$_POST["to_bank_id"];
$amount=$_POST["amount2"];
$note=$_POST["s_note"];
$date=$_POST["tran_date"];



	
	$command = "SELECT MAX(sk_tran_id) as maxid FROM txn_transaction";
	$tran_id=0;
	$result = mysql_query($command, $con);
	while ($row = mysql_fetch_assoc($result))
	{
		$tran_id = $row['maxid'];
	}$tran_id++;
	
	$t_id=$tran_id+1;
	
	$query="INSERT INTO txn_transaction(sk_tran_id,tran_date,tran_time, credit, debit,member_id, transaction_ref_id, ref_table, tran_type, tran_desc, note,tran_status, employee_id, branch_id)
	VALUES ('$tran_id','$date',now(),'0','$amount','$bank_id','$t_id','mst_member','Bank','Transfer','$note','active','$session_id','$session_branch')";
	mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
	
	
	//**********************************LOG START****************************************************
	$log_id=0;$command = "SELECT MAX(sk_log_id) as maxid FROM txn_log";$result = mysql_query($command, $con);while ($row = mysql_fetch_assoc($result)){$log_id = $row['maxid'];}$log_id++;
	$query ="INSERT INTO txn_log (sk_log_id, tran_date, tran_time, member_type, tran_type, tran_desc, tran_table, member_id, bill_id, tran_id, branch_id, employee_id)
	VALUES ('$log_id','$date',now(),'Bank','Transfer','$amount','txn_transaction','$bank_id','0','$tran_id','$session_branch','$session_id')";
	mysql_query($query);
	//**********************************LOG END****************************************************
	
	
	$query="INSERT INTO txn_transaction(sk_tran_id,tran_date,tran_time, credit, debit,member_id, transaction_ref_id, ref_table, tran_type, tran_desc, note,tran_status, employee_id, branch_id)
	VALUES ('$t_id','$date',now(),'$amount','0','$to_bank_id','$tran_id','mst_member','Bank','Transfer','$note','active','$session_id','$session_branch')";
	mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
	
	//**********************************LOG START****************************************************
	$log_id=0;$command = "SELECT MAX(sk_log_id) as maxid FROM txn_log";$result = mysql_query($command, $con);while ($row = mysql_fetch_assoc($result)){$log_id = $row['maxid'];}$log_id++;
	$query ="INSERT INTO txn_log (sk_log_id, tran_date, tran_time, member_type, tran_type, tran_desc, tran_table, member_id, bill_id, tran_id, branch_id, employee_id)
	VALUES ('$log_id','$date',now(),'Bank','Transfer','$amount','txn_transaction','$to_bank_id','0','$t_id','$session_branch','$session_id')";
	mysql_query($query);
	//**********************************LOG END****************************************************

?>
<script>
window.location="index.php?action=bank&c=transactions";
</script>
