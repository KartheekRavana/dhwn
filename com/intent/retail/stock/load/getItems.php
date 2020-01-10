<?php ob_start();
session_start();

$category=$_GET["category"];

include '../../connection/db.php';
if($category==0)
{
	$barcode=explode("-", $_GET["barcode"]);
	
	$category="";
	$data = mysql_query("SELECT category,item_name,item_id FROM items WHERE item_id='".$barcode[0]."'");
	while($info = mysql_fetch_array($data))
	{
		$category=$info["category"];		
		$item_name=$info["item_name"];
		$item_id=$info["item_id"];
	}
	
	$data = mysql_query("SELECT category_name FROM category WHERE category_id='".$category."'");
	while($info = mysql_fetch_array($data))
	{
		$category_name=$info["category_name"];
	}
	
	
$data1 = mysql_query("SELECT distinct(description) as description FROM txn_bill_support WHERE sk_tran_id='".$barcode[1]."' ORDER BY description");
while($info1 = mysql_fetch_array($data1))
{
	$mrp=0;
	$data = mysql_query("SELECT mrp FROM stock WHERE flower_name='".$barcode[0]."' and description='".$info1["description"]."'");
	while($info = mysql_fetch_array($data))
	{
		$mrp=$info["mrp"];
	}
	
	echo "#$category#$category_name#".$item_id."#".$item_name ."(". $info1["description"]." )#$mrp#";
}
	
	
}
else
{
$data = mysql_query("SELECT item_id,item_name FROM items WHERE category='$category' order by item_name");
while($info = mysql_fetch_array($data))
{
	$data1 = mysql_query("SELECT distinct(description) as description FROM txn_bill_support WHERE particular_id='" .$info["item_id"]."' ORDER BY description");
	while($info1 = mysql_fetch_array($data1))
	{
		echo "#".$info["item_name"] ."(". $info1["description"]." )//".$info["item_id"];
	}
	
}
}