<?php
include_once '../../connection/db.php';

$cid=$_GET["cid"];
$data="";
$query=mysql_query("select sub_cid,sub_name from sub_category where category_id='$cid' and sub_status='active' order by sub_name asc ");
while($info=mysql_fetch_array($query))
{
	
	$data=$data."#".$info["sub_cid"]."::".$info["sub_name"];
	
}
echo $data;