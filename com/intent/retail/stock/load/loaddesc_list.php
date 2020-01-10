<?php
ob_start();
session_start();

$category=$_GET["category"];
$sid=$_GET["subcategoryid"];
$item=$_GET["item"];


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
$data = mysql_query("SELECT distinct(description) as description FROM txn_bill_support WHERE particular_id='$item' order by description");
while($info = mysql_fetch_array($data))
{
	$result=$result."#".$info["description"]."//".$info["description"]."//";
}
echo $result;