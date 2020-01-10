<?php ob_start();
session_start();
include '../../connection/db.php';

$data = mysql_query("SELECT item_id,item_name FROM items WHERE item_status='active' order by item_name");
while($info = mysql_fetch_array($data))
{
	$data1 = mysql_query("SELECT distinct(description) as description FROM supplierbill WHERE item_name='" .$info["item_id"]."' ORDER BY description");
	while($info1 = mysql_fetch_array($data1))
	{
		echo "#".$info["item_name"] ."(". $info1["description"]." )//".$info["item_id"];
	}
	
}
