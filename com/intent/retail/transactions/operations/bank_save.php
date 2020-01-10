<?php include_once "$D_PATH/include/session.php";?>
<?php
$bank_name=$_POST["bank_name"];
$acc_no=$_POST["acc_no"];
$address="";
$place="";
$email="";
$phone1="";
$phone2="";



$curtime=curtime();
$command = "SELECT MAX(sk_member_id) as maxid FROM mst_member";
$cNo=0;
$result = mysql_query($command, $con);
while ($row = mysql_fetch_assoc($result)){
	$cNo = $row['maxid'];
}

$cNo++;

$message="BankName:".$bank_name."AccNO:".$acc_no;
$query ="INSERT INTO mst_member (sk_member_id, member_type, member_name, acc_no, ifsc, mobile, landline, email, address, place, state, profile_pic, login_name, login_password, login_status,employee_id, branch_id)
VALUES ('$cNo','6','$bank_name','$acc_no','','$phone1','$phone2','$email','$address','$place','','','','','active','$session_id','$session_branch')";
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
window.location="?action=bank&c=transactions&status=success//Successfully Added New Bank";
</script>