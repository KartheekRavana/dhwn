<?php include_once "$D_PATH/include/session.php";?>

<?php

$expense_id=$_POST["exp_name"];
$expense_date=$_POST["date"];
$expense_amount=$_POST["exp_amount"];
$expense_note=$_POST["exp_note"];
$branch=$_POST["session_branch"];



$query1=mysql_query("select expense_name from mst_expenselist where expense_id=$expense_id");
while($info = mysql_fetch_array( $query1 ))
	$expense_name=$info['expense_name'];


$command = "SELECT MAX(sk_tran_id) as maxid FROM txn_transaction";
$tran_id=0;
$result = mysql_query($command, $con);
while ($row = mysql_fetch_assoc($result))
{
	$tran_id = $row['maxid'];
}$tran_id++;

$query="INSERT INTO txn_transaction(sk_tran_id,tran_date,tran_time, credit, debit,member_id, transaction_ref_id, ref_table, tran_type, tran_desc, note,tran_status, employee_id, branch_id)
VALUES ('$tran_id','$expense_date',now(),'0','$expense_amount','$expense_id','0','mst_expenselist','Expenses','$expense_name','$expense_note','active','$session_id','$session_branch')";
mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());



//**********************************LOG START****************************************************
		$log_id=0;$command = "SELECT MAX(sk_log_id) as maxid FROM txn_log";$result = mysql_query($command, $con);while ($row = mysql_fetch_assoc($result)){$log_id = $row['maxid'];}$log_id++;
		$query ="INSERT INTO txn_log (sk_log_id, tran_type, tran_desc,log_date, log_time, tran_id, transaction_id, tran_table, branch_id, employee_id)
		VALUES ('$log_id','Expense','$expense_name : $expense_amount','$expense_date',now(),'$expense_id','$expense_id','mst_expenselist','$session_branch','$session_id')";
		mysql_query($query);
		//**********************************LOG END****************************************************
?>
<input type="text" id="exp_name" value="<?php echo $expense_name?>">
<input type="text" id="exp_amt" value="<?php echo $expense_amount?>">
<script>
window.location="?action=expenses&c=transactions&status=success//Successfully Added "+document.getElementById("exp_name").value+" Expense Rs."+document.getElementById("exp_amt").value;
</script>