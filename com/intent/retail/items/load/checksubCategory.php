<?php
include_once '../../connection/db.php';
$category_id=$_GET["category"];
$subcategory_name=$_GET["subcategory"];
$session_branch=$_GET["session_branch"];
$status="Available";
$cNo=0;
$data = mysql_query("SELECT sub_cid,category_id, sub_name, sub_status, branch FROM sub_category where sub_name='".$subcategory_name."' and category_id='$category_id'");
while($info = mysql_fetch_array( $data ))
{
	$status="Exist";
}
if($status=="Available")
{
	$command = "SELECT MAX(sub_cid) as maxid FROM sub_category";
	$result = mysql_query($command, $con);
	while ($row = mysql_fetch_assoc($result)){
		$cNo = $row['maxid'];
	}
	$cNo++;
	mysql_query("insert into sub_category(sub_cid,category_id, sub_name, sub_status, branch)values('$cNo','$category_id','$subcategory_name','active','$session_branch')");
}
echo $status."#".$cNo;