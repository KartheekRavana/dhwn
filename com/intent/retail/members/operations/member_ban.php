<?php include_once "$D_PATH/include/session.php";?>
<?php
$member_id=$_GET["mid"];
$paid_amt=$_GET["pamt"];
$bill_for=$_GET["bill_for"];

$page=$_GET["p"];;

$query ="update mst_member set member_status='Banned' where sk_member_id='$member_id'";
mysql_query($query);

	$command = "SELECT MAX(sk_tran_id) as maxid FROM txn_transaction";
		$tran_id=0;
		$result = mysql_query($command, $con);
		while ($row = mysql_fetch_assoc($result))
		{
		$tran_id = $row['maxid'];
}$tran_id++;

$query="INSERT INTO txn_transaction(sk_tran_id,tran_date,tran_time, credit, debit,member_id, transaction_ref_id, ref_table, tran_type, tran_desc, note,tran_status, employee_id, branch_id)
VALUES ('$tran_id','$date',now(),'0','$paid_amt','$member_id','0','mst_member','$bill_for','Discount','Customer Banned and Applied Discount','active','$session_id','$session_branch')";
mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());

?>
<input type='hidden' name="status" id="status" value="<?php echo $commit?>">
<script>
window.location="?action=view&c=members&lt=<?php echo $page?>&status=success//Successfully Banned Member";
</script>