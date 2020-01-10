<?php
$key="auhfughy37hskfhiwuejhbjhgyug456mn78bv45gvnb87vnbvhc0909uhjkhhh4uyg";
$host="localhost";
$username="root";
$password="";
$db_name="dhwn";
$con=mysql_connect("$host", "$username", "$password")or die("cannot connect");
mysql_select_db("$db_name")or die("can not select DB");
return $con;
?>



