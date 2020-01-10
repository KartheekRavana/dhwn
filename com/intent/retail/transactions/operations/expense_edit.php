<?php include_once "$D_PATH/include/session.php";?>

<?php
$tran_id=$_POST["tran_id"];
$expense_id=$_POST["exp_name"];
$expense_date=$_POST["date"];
$expense_amount=$_POST["exp_amount"];
$expense_note=$_POST["exp_note"];
$branch=$_POST["session_branch"];

$log_data="";

	$query1=mysql_query("select expense_name from mst_expenselist where expense_id=$expense_id");
	while($info = mysql_fetch_array( $query1 ))
		$expense_name=$info['expense_name'];

$query="update txn_transaction set tran_date='$expense_date',member_id='$expense_id',tran_desc='$expense_name',debit='$expense_amount',note='$expense_note' where sk_tran_id='$tran_id'";
$commit=mysql_query($query);



?>
<input type="hidden" id="tran_id" value="<?php echo $tran_id?>">
<input type="text" id="exp_name" value="<?php echo $expense_name?>">
<input type="text" id="exp_amt" value="<?php echo $expense_amount?>">
<script>
window.location="index.php?action=expenses_edit&c=transactions&tran_id="+document.getElementById("tran_id").value+"&status=success//Successfully Updated to "+document.getElementById("exp_name").value+" Expense Rs."+document.getElementById("exp_amt").value;;
</script>