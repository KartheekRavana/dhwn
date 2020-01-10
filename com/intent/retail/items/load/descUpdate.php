<?php
include_once '../../connection/db.php';
$particular_id=$_GET["particular_id"];
$old_desc=$_GET["old_desc"];
$new_desc=$_GET["new_desc"];
$bill_for=$_GET["bill_for"];

if($bill_for!="stock") {
	$data = mysql_query("update txn_bill_support set description='$new_desc' where particular_id='$particular_id' and description='$old_desc' and bill_for='$bill_for' ")
	or die(mysql_error());
}
else if($bill_for=="stock") {
	$data = mysql_query("update stock set description='$new_desc' where flower_name='$particular_id' and description='$old_desc'  ")
	or die(mysql_error());
}
