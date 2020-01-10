<?php include_once "$D_PATH/include/session.php";?><?php


$menu=$_POST["menu"];
$submenu=$_POST["submenu"];
$link=$_POST["link"];
$session_branch=$_POST["session_branch"];

$bNo="";
$command = "SELECT MAX(submenu_id) as maxid FROM menu_sub";
$menu_id=0;
$result = mysql_query($command, $con);
while ($row = mysql_fetch_assoc($result)){
	$menu_id = $row['maxid'];

}
$menu_id++;
	
$query="INSERT INTO menu_sub(submenu_id, menu_id, submenu_name, submenu_link, submenu_status, branch_id)
VALUES ('$menu_id','$menu','$submenu','$link','active','$session_branch')";
mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
//echo 'success';

?>

<script>
window.location="index.php?action=menu_manage&c=settings&status=success//Menu Added Successfully";
</script>