<?php include_once "$D_PATH/include/session.php";?>
<?php
$member_type=$_POST["member_type"];
$member_name=$_POST["member_name"];
$address=$_POST["address"];
$place=$_POST["place"];
$email=$_POST["email"];
$phone1=$_POST["phone1"];
$phone2=$_POST["phone2"];
$salary=$_POST["salary"];
$login_name=$_POST["login_name"];
$login_pwd=$_POST["login_pwd"];

$curtime=curtime();
$command = "SELECT MAX(sk_member_id) as maxid FROM mst_member";
$cNo=0;
$result = mysql_query($command, $con);
while ($row = mysql_fetch_assoc($result)){
	$cNo = $row['maxid'];
}

$cNo++;

$query ="INSERT INTO mst_member (sk_member_id, member_type, member_name, acc_no, ifsc, mobile, landline, email, address, place, state, profile_pic, login_name, login_password, login_status,employee_id, branch_id,salary)
VALUES ('$cNo','$member_type','$member_name','','','$phone1','$phone2','$email','$address','$place','','','$login_name','$login_pwd','active','$session_id','$session_branch','$salary')";
mysql_query($query);



//**********************************LOG START****************************************************
$log_id=0;$command = "SELECT MAX(sk_log_id) as maxid FROM txn_log";$result = mysql_query($command, $con);while ($row = mysql_fetch_assoc($result)){$log_id = $row['maxid'];}$log_id++;
$query ="INSERT INTO txn_log (sk_log_id, tran_date, tran_time, member_type, tran_type, tran_desc, tran_table, member_id, bill_id, tran_id, branch_id, employee_id)
VALUES ('$log_id','$date',now(),'$member_type','New','New $member_type Added','mst_member','$cNo','0','0','$session_branch','$session_id')";
mysql_query($query);
//**********************************LOG END****************************************************


?>
<input type='hidden' name="status" id="status" value="<?php echo $commit?>">
<script>
window.location="?action=new&c=members&status=success//Successfully Added New Member";
</script>