<?php include_once "$D_PATH/include/session.php";?><?php


$income=$_POST["exp_amount"];
$date=$_POST["date"];
$note=$_POST["exp_note"];


	$command = "SELECT MAX(sk_tran_id) as maxid FROM txn_transaction";
		$tran_id=0;
		$result = mysql_query($command, $con);
		while ($row = mysql_fetch_assoc($result))
		{
		$tran_id = $row['maxid'];
}$tran_id++;

$query="INSERT INTO txn_transaction(sk_tran_id,tran_date,tran_time, credit, debit,member_id, transaction_ref_id, ref_table, tran_type, tran_desc, note,tran_status, employee_id, branch_id)
VALUES ('$tran_id','$date',now(),'$income','0','0','0','mst_bill_main','Income','','$note','active','$session_id','$session_branch')";
mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());


?>

<script>
window.location="index.php?action=income&c=stock";
</script>