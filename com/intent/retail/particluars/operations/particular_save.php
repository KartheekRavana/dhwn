<?php include_once "$D_PATH/include/session.php";?>
<?php
$category=$_POST["category"];
$particluar=$_POST["particluar"];

$curtime=curtime();
$command = "SELECT MAX(sk_particular_id) as maxid FROM mst_particular";
$cNo=0;
$result = mysql_query($command, $con);
while ($row = mysql_fetch_assoc($result)){
	$cNo = $row['maxid'];
}

$cNo++;

$query ="INSERT INTO mst_particular (sk_particular_id, particular_name, particular_desc, category_id, sub_category_id, particular_status, branch_id)
VALUES ('$cNo','$particluar','$particluar','$category','0','active','$session_branch')";
mysql_query($query);


//**********************************LOG START****************************************************
$log_id=0;$command = "SELECT MAX(sk_log_id) as maxid FROM txn_log";$result = mysql_query($command, $con);while ($row = mysql_fetch_assoc($result)){$log_id = $row['maxid'];}$log_id++;
$query ="INSERT INTO txn_log (sk_log_id, tran_date, tran_time, member_type, tran_type, tran_desc, tran_table, member_id, bill_id, tran_id, branch_id, employee_id)
VALUES ('$log_id','$date',now(),'Category','New','New $particluar Added','mst_particular','$cNo','0','0','$session_branch','$session_id')";
mysql_query($query);
//**********************************LOG END****************************************************
?>
<input type='hidden' name="status" id="status" value="<?php echo $commit?>">
<script>
window.location="?action=new&c=particluars&status=success//Successfully Added New Particular";
</script>