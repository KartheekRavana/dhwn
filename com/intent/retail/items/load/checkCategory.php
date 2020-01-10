<?php
include_once '../../connection/db.php';
$category_name=$_GET["category"];
$session_branch=$_GET["session_branch"];
$status="Available";
$cNo=0;
$data = mysql_query("SELECT category_id, category_name, category_status, branch FROM category where category_name='".$category_name."'");
while($info = mysql_fetch_array( $data ))
{
	$status="Exist";
}
if($status=="Available")
{
	$command = "SELECT MAX(category_id) as maxid FROM category";
	$result = mysql_query($command, $con);
	while ($row = mysql_fetch_assoc($result)){
		$cNo = $row['maxid'];
	}
	$cNo++;
	mysql_query("insert into category(category_id, category_name, category_status, branch)values('$cNo','$category_name','active','$session_branch')");
}
echo $status."#".$cNo;