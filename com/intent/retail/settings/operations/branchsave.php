<?php include_once "$D_PATH/include/session.php";?><?php


$b_name=$_POST["b_name"];
$address=$_POST["address"];
$city=$_POST["city"];
$state=$_POST["state"];
$country=$_POST["country"];
$phone=$_POST["phone"];
$validity=$_POST["validity"];
$branch_type=$_POST["branch_type"];

$bNo="";
$command = "SELECT MAX(branch_code) as maxid FROM branch";
$branch_no=0;
$result = mysql_query($command, $con);
while ($row = mysql_fetch_assoc($result)){
	$branch_no = $row['maxid'];

}

$command = "SELECT MAX(branch_id) as maxid FROM branch";
$branch_id=0;
$result = mysql_query($command, $con);
while ($row = mysql_fetch_assoc($result))
{
	$branch_id = $row['maxid'];
}$branch_id++;

if($branch_no==0){$branch_no=1001;}else{$branch_no++;}
	
$query="INSERT INTO branch(branch_id,branch_code,branch_name,address,city,state,country,phone,branch_status,validity,branch_type)
VALUES ('$branch_id','$branch_no','$b_name','$address','$city','$state','$country','$phone','active','$validity','$branch_type')";
mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
//echo 'success';

?>

<script>
window.location="index.php?action=branch_manage&c=settings";
</script>