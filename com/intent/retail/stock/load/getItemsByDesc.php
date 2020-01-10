<?php ob_start();
session_start();

$category=$_GET["category"];

include '../../connection/db.php';
if($category==0)
{
	$item_id=$_GET["item_id"];
	$desc=$_GET["desc"];
	

	$mrp=0;
	$data = mysql_query("SELECT mrp FROM stock WHERE flower_name='$item_id' and description='$desc'");
	while($info = mysql_fetch_array($data))
	{
		$mrp=$info["mrp"];
	}
	$discount=0;$vat=0;$item_rate=0;
	$data = mysql_query("SELECT discount,vat,rate FROM txn_bill_support WHERE particular_id='$item_id' and description='$desc'");
	while($info = mysql_fetch_array($data))
	{
		$discount=$info["discount"];
		$vat=$info["vat"];
		$item_rate=$info["rate"];
	}
	echo "#$mrp#$discount#$vat#$item_rate#";

	
	
}
