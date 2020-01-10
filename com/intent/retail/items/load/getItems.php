<?php
include_once '../../connection/db.php';

$cid=$_GET["category_id"];
$scid=$_GET["sub_category_id"];
$data="";
$query=mysql_query("select * from items where category='$cid' and sub_category_id='$scid' and item_status='active' order by item_name asc ");
while($info=mysql_fetch_array($query))
{
	
	$data=$data."#".$info["item_id"]."::".$info["item_name"];
	
}
echo $data;