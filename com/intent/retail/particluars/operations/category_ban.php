<?php include_once "$D_PATH/include/session.php";?>
<?php
$particular_id=$_GET["cid"];

$curtime=curtime();

$query ="update mst_particular set particular_status='inactive' where sk_particular_id='$particular_id'";
mysql_query($query);

//**********************************LOG START****************************************************
$log_id=0;$command = "SELECT MAX(sk_log_id) as maxid FROM txn_log";$result = mysql_query($command, $con);while ($row = mysql_fetch_assoc($result)){$log_id = $row['maxid'];}$log_id++;
$query ="INSERT INTO txn_log (sk_log_id, tran_date, tran_time, member_type, tran_type, tran_desc, tran_table, member_id, bill_id, tran_id, branch_id, employee_id)
VALUES ('$log_id','$date',now(),'Category','Banned','Category Banned','mst_particular','$particular_id','0','0','$session_branch','$session_id')";
mysql_query($query);
//**********************************LOG END****************************************************


$page=$_GET["page"];

?>
<script>
window.location="?action=<?php echo $page?>&c=particluars&status=success//Successfully Banned Category";
</script>