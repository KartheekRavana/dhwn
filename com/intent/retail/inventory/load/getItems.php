<?php ob_start();
session_start();

$category=$_GET["category"];

include '../../connection/db.php';

$data = mysql_query("SELECT sk_particular_id,particular_name FROM mst_particular WHERE category_id='$category' order by particular_name");
while($info = mysql_fetch_array($data))
{
	echo "#".$info["particular_name"]."//".$info["sk_particular_id"];
}
