<?php include_once "$D_PATH/include/session.php";?>
<?php 

$day=$_POST["day"];
$month=$_POST["month"];

$query="insert into financial_year(day,month)values('$day','$month')";
mysql_query($query);
echo $query
?>