<?php ob_start();
session_start();

$category=$_GET["category"];

include '../../connection/db.php';

$data = mysql_query("SELECT sub_cid,sub_name FROM sub_category WHERE category_id='$category' order by sub_name");
while($info = mysql_fetch_array($data))
{
	echo "#".$info["sub_cid"]."//".$info["sub_name"];
}
