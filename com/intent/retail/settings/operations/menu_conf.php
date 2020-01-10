<?php include_once "../../connection/db.php";

$menu=$_GET["menu"];
$session_id=$_GET["session_id"];
$branch=$_GET["branch"];
$user_id=$_GET["user_id"];
$status=$_GET["status"];
$state=1;
$submenu=$_GET["submenu"];



$update_status="error//Failed To Update";

$sql=mysql_query("select conf_id, menu_id, submenu_id, employee_id, menu_status, branch_id, session_id from menu_conf where menu_id='$menu' and submenu_id='$submenu' and employee_id='$user_id' ");
while($info=mysql_fetch_array($sql))
{
	$state=2;
	$query ="update menu_conf set menu_status='$status' where conf_id='".$info["conf_id"]."'";
	$commit=mysql_query($query);
	$update_status="success//Updated Successfully";
}

if($state==1)
{
	$log_id=0;$command = "SELECT MAX(conf_id) as maxid FROM menu_conf";$result = mysql_query($command, $con);while ($row = mysql_fetch_assoc($result)){$log_id = $row['maxid'];}$log_id++;
	
	$query ="INSERT INTO menu_conf (conf_id, menu_id, submenu_id, employee_id, menu_status, branch_id, session_id)
	VALUES ('$log_id','$menu','$submenu','$user_id','$status','$branch','$session_id')";
	mysql_query($query);
	$update_status="success//Updated Successfully";
}
$log_data="";
//**********************************LOG START***************************************************
	if($log_data!="")
	{
	$log_id=0;$command = "SELECT MAX(log_id) as maxid FROM log_changes";$result = mysql_query($command, $con);while ($row = mysql_fetch_assoc($result)){$log_id = $row['maxid'];}$log_id++;
	$query ="INSERT INTO log_changes (log_id, log_type, tran_type,tran_id, log_timestamp, log_date, log_data, session_id,session_branch,log_person)
	VALUES ('$log_id','Layer','Update','$employee_id',now(),'$date','$log_data','$session_id','$session_branch','$employee_id')";
	//mysql_query($query);
	}
//**********************************LOG END****************************************************

echo $update_status
?>
