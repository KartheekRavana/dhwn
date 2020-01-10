<?php
include_once '../../connection/db.php';
$expenses_name=$_GET["expenses"];
$session_branch=$_GET["session_branch"];
$session_id=$_GET["session_id"];
$status="Available";
$cNo=0;
$data = mysql_query("SELECT expense_id, expense_name, expense_status, employee_id, branch_id FROM mst_expenselist where expense_name='".$expenses_name."'");
while($info = mysql_fetch_array( $data ))
{
	$status="Exist";
}
if($status=="Available")
{
	$command = "SELECT MAX(expense_id) as maxid FROM mst_expenselist";
	$result = mysql_query($command, $con);
	while ($row = mysql_fetch_assoc($result)){
		$cNo = $row['maxid'];
	}
	$cNo++;
	mysql_query("insert into mst_expenselist(expense_id, expense_name, expense_status, employee_id, branch_id )
	values('$cNo','$expenses_name','active','$session_id','$session_branch')");

}
echo $status."#".$cNo;