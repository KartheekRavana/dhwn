<?php
$branch_id=$_POST['branch_id'];
$b_name=$_POST["b_name"];
$address=$_POST["address"];
$city=$_POST["city"];
$state=$_POST["state"];
$country=$_POST["country"];
$phone=$_POST["phone"];



include_once '../../connection/db.php';

$query ="update branch set branch_name='$b_name',address='$address',city='$city',state='$state',country='$country',phone='$phone'where branch_id='$branch_id'";
$res=mysql_query($query);
$status="fail";
if($res==1)
{
	$status='success';
}

