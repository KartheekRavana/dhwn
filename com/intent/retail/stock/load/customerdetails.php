<?php ob_start();
session_start();
$customer_id=$_GET["customer_id"];
include '../../connection/db.php';
include_once '../../helper/helper.php';
$customer_id=$_GET["customer_id"];
$data = mysql_query("SELECT mobile,place FROM mst_member WHERE sk_member_id='$customer_id'");
while($info = mysql_fetch_array($data))
{
	echo "#".$info["place"]."#".$info["mobile"]."#";
}
