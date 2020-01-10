<?php
include_once '../../connection/db.php';
$category_name=$_GET["rack"];
$session_branch=$_GET["session_branch"];
$status="Available";
$cNo=0;
$data = mysql_query("SELECT rack_id, rack_name,rack_status, branch from rack where rack_name='".$category_name."'");
while($info = mysql_fetch_array( $data ))
{
	$status="Exist";
}
if($status=="Available")
{
	$command = "SELECT MAX(rack_id) as maxid FROM rack";
	$result = mysql_query($command, $con);
	while ($row = mysql_fetch_assoc($result)){
		$cNo = $row['maxid'];
	}
	$cNo++;
	mysql_query("insert into rack(rack_id, rack_name, rack_status, branch)values('$cNo','$category_name','active','$session_branch')");
}
echo $status."#".$cNo;