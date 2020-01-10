<?php ob_start();
session_start();
$supplier_id=$_GET["supplier_id"];
include '../../connection/db.php';
include_once '../../helper/helper.php';
$supplier_id=$_GET["supplier_id"];
$data = mysql_query("SELECT place,mobile FROM mst_member WHERE sk_member_id='$supplier_id'");
while($info = mysql_fetch_array($data))
{
	echo "#".$info["place"]."#".$info["mobile"]."#";
}
