<?php
ob_start();
session_start();

$category=$_GET["category"];
$sid=$_GET["subcategoryid"];


include '../../connection/db.php';

$subqry_c="";
if($category!="")
{
	$subqry_c=" and category='$category'";
}
$subqry_s="";
if($sid!="")
{
	$subqry_s=" and sub_category_id='$sid'";
}
$i=1;$j=1;
$result="";
$data = mysql_query("SELECT item_id, item_name FROM items WHERE item_status='active' $subqry_c $subqry_s order by item_name");
while($info = mysql_fetch_array($data))
{
	$result=$result."#".$info["item_id"]."//".$info["item_name"]."//";
}
echo $result;