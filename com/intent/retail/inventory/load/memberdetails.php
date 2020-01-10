<?php ob_start();
session_start();
$customer_id=$_GET["customer_id"];
include '../../connection/db.php';
include_once '../../helper/helper.php';
$customer_id=$_GET["customer_id"];
$data = mysql_query("SELECT place,mobile,landline FROM mst_member WHERE sk_member_id='$customer_id'");
while($info = mysql_fetch_array($data))
{
	$phone="";
	$phone=$info["mobile"];
	if($phone=="")
	{
		$phone=$info["landline"];
	}
	
	echo "#".$info["place"]."#".$phone."#";
}
