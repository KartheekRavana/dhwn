<?php

$host="localhost";
$username="ISCAP";
$password="Intent01!";
$db_name="retail_dhwn";
$con=mysql_connect("$host", "$username", "$password")or die("cannot connect");
mysql_select_db("$db_name")or die("can not select DB");
return $con;
?>



