<?php include_once "$D_PATH/include/session.php";?><?php

$employee=$_POST["employee"];
$branch=$_POST["branch"];
$count=$_POST["count"];
$note="Profit Credit";


$tran_date=$_POST['date'];



for($i=1;$i<=$count;$i++)
{
	$partner_id=$_POST["partner_id".$i];
	$per_amt=$_POST["per_amt".$i];
	
	

$command = "SELECT MAX(sk_tran_id) as maxid FROM txn_transaction";
	$tran_id=0;
	$result = mysql_query($command, $con);
	while ($row = mysql_fetch_assoc($result))
	{
		$tran_id = $row['maxid'];
	}$tran_id++;
	
	$btran_id=$tran_id+1;
	
	
	$query="INSERT INTO txn_transaction(sk_tran_id,tran_date,tran_time, credit, debit,member_id, transaction_ref_id, ref_table, tran_type, tran_desc, note,tran_status, employee_id, branch_id)
	VALUES ('$btran_id','$tran_date',now(),'$per_amt','0','$partner_id','0','mst_member','Partner','Profit Share','','active','$session_id','$session_branch')";
	mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
	
	
}
?>
<script>
window.location='index.php?action=partner&c=members';
</script>