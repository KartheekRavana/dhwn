<?php
include "$D_PATH/connection/db.php";

$username=$_POST["username"];
$mobile=$_POST["mobile"];

$status="Fail";
$login_status='fail';
$data = mysql_query("SELECT employee_name,login_password,profile_pic FROM employee where login_name='$username' and phone='$mobile' and login_status='active'");
while($info = mysql_fetch_array( $data ))
{
	$status="Success";
	$password=$info["login_password"];
	$employee_name=$info["employee_name"];
}
if($status=="Success")
{
$msg="Dear $employee_name, Your Password is $password";
}
else 
{
	$data = mysql_query("SELECT employee_name,phone FROM employee where login_name='$username' and login_status='active'");
	while($info = mysql_fetch_array( $data ))
	{
		$employee_name=$info["employee_name"];
		$mobile=$info["phone"];
	}
	$msg="Dear $employee_name, Some One trying to recover your password";
}
?>

 <embed src="http://bulksms.mysmsmantra.com:8080/WebSMS/SMSAPI.jsp?username=iadc&password=940037614&sendername=IADCBA&mobileno=<?php echo $mobile?>&message=<?php echo $msg?>">
    <script>

    setInterval(function(){
        window.location="index.php?action=forgot&c=login";
        },1000);
    </script>