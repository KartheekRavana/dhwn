<?php
ob_start();
session_start();

$barcode=$_GET["barcode"];

$barcode=explode("-", $_GET["barcode"]);


include '../../connection/db.php';
$filter="";
$category="";
	$data = mysql_query("SELECT category,item_name,item_id FROM items WHERE item_id='".$barcode[0]."'");
	while($info = mysql_fetch_array($data))
	{
		$category=$info["category"];		
		$item_name=$info["item_name"];
		$item_id=$info["item_id"];
	}
	$data1 = mysql_query("SELECT description,rate FROM txn_bill_support WHERE sk_tran_id='".$barcode[1]."' order by sk_tran_id desc limit 1");
	while($info1 = mysql_fetch_array($data1))
	{
		$filter=$info1["description"];
		$mrp=$info1["rate"];
	}
	/*$mrp=0;
	$data = mysql_query("SELECT mrp FROM stock WHERE flower_name='".$barcode[0]."' and description='".$filter."'");
	while($info = mysql_fetch_array($data))
	{
		$mrp=$info["mrp"];
	}*/
	
echo "#".$category."#".$item_id."#".$item_name."#".$filter."#".$mrp;

?>