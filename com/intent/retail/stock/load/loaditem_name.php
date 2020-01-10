<?php ob_start();
session_start();

$category=$_GET["category"];
$subcategoryid=$_GET["subcategoryid"];

include '../../connection/db.php';

$data = mysql_query("SELECT item_name,item_id FROM items WHERE category='$category' and sub_category_id='$subcategoryid' order by item_name");
while($info = mysql_fetch_array($data))
{
	echo "#".$info["item_id"]."//".$info["item_name"];
}
