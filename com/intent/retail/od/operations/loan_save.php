<?php include_once "$D_PATH/include/session.php";?>
<?php
$loan_amount=$_POST["amount"];
$loan_date=$_POST["loan_date"];
$interest_rate=$_POST["interest_rate"];



$curtime=curtime();
$command = "SELECT MAX(sk_loan_id) as maxid FROM mst_loan";
$cNo=0;
$result = mysql_query($command, $con);
while ($row = mysql_fetch_assoc($result)){
	$cNo = $row['maxid'];
}

$cNo++;

$message="BankName:".$bank_name."AccNO:".$acc_no;
$query ="INSERT INTO mst_loan (sk_loan_id, loan_amount, loan_date, interest_rate, close_date, loan_status, branch_id)
VALUES ('$cNo','$loan_amount','$loan_date','$interest_rate','0000-00-00','active','$session_branch')";
mysql_query($query);

//**********************************LOG START****************************************************
$log_id=0;$command = "SELECT MAX(sk_log_id) as maxid FROM txn_log";$result = mysql_query($command, $con);while ($row = mysql_fetch_assoc($result)){$log_id = $row['maxid'];}$log_id++;
$query ="INSERT INTO txn_log (sk_log_id, tran_date, tran_time, member_type, tran_type, tran_desc, tran_table, member_id, bill_id, tran_id, branch_id, employee_id)
VALUES ('$log_id','$date',now(),'Bank','New','$message','mst_member','$cNo','0','0','$session_branch','$session_id')";
mysql_query($query);
//**********************************LOG END****************************************************
?>
<input type='hidden' name="status" id="status" value="<?php echo $commit?>">
<script>
window.location="?action=od_loan&c=od&status=success//Successfully Added New Bank";
</script>