<?php include_once "$D_PATH/include/session.php";

$employee_id=$_POST["c_id"];
$employee_name=$_POST["employee_name"];
$phone=$_POST["phone"];
$salary=$_POST["salary"];
$joining_date=$_POST["joining_date"];
$branch=$_POST["branch"];



$log_data="";
$sql=mysql_query("select employee_id, employee_name, dob, mobile, phone, email, address, country, state, city, taluk, doj, salary from employee where employee_id='$employee_id' ");
while($info=mysql_fetch_array($sql))
{
	if($info["employee_name"]!=$employee_name){$log_data=$log_data."Updated Employee Name as $employee_name (".$info["employee_name"].")<br>";}
	if($info["phone"]!=$phone){$log_data=$log_data."Updated Phone as $phone (".$info["phone"].")<br>";}
	if($info["salary"]!=$salary){$log_data=$log_data."Updated Salary as $salary (".$info["salary"].")<br>";}
	if($info["doj"]!=$joining_date){$log_data=$log_data."Updated DOJ as $joining_date (".$info["doj"].")<br>";}
	
}

$query ="update employee set employee_name='$employee_name',phone='$phone',salary='$salary',doj='$joining_date' where employee_id='$employee_id'";
$commit=mysql_query($query);



//**********************************LOG START****************************************************
if($commit==1)
{	
	if($log_data!="")
	{
	$log_id=0;$command = "SELECT MAX(log_id) as maxid FROM log_changes";$result = mysql_query($command, $con);while ($row = mysql_fetch_assoc($result)){$log_id = $row['maxid'];}$log_id++;
	$query ="INSERT INTO log_changes (log_id, log_type, tran_type,tran_id, log_timestamp, log_date, log_data, session_id,session_branch,log_person)
	VALUES ('$log_id','Employee','Update','$employee_id',now(),'$date','$log_data','$session_id','$session_branch','$employee_id')";
	mysql_query($query);
	}
}
//**********************************LOG END****************************************************


?>
 <input type="hidden" name="e_id" id="e_id" value="<?php echo $employee_id?>">
<input type='hidden' name="status" id="status" value="<?php echo $commit?>">
<script>
window.location="index.php?action=profile&c=settings&status="+document.getElementById("status").value;
</script>