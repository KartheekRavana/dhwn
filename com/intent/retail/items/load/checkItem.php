<?php
include_once '../../connection/db.php';

$item_name=$_GET["item_name"];
$category=$_GET["category"];
$branch=$_GET["session_branch"];
$status="Available";
$data = mysql_query("SELECT item_id, item_name, item_status, kannada_name, category, branch FROM items where item_name='".$item_name."' and category='$category' and branch='$branch'");
while($info = mysql_fetch_array( $data ))
{
	$status="Exist";
}
if($status=="Available")
{
	$cNo=0;
	$command = "SELECT MAX(item_id) as maxid FROM items";
	$result = mysql_query($command, $con);
	while ($row = mysql_fetch_assoc($result)){
		$cNo = $row['maxid'];
	}
	$cNo++;
	
$query="INSERT INTO items(item_id,item_name,kannada_name,item_status,category,branch)
VALUES ($cNo,'$item_name','','active','$category','$branch')";
mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
}
echo $status."#".$item_name;
?>
