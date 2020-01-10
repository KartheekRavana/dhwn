<?php include_once "$D_PATH/include/session.php";?><?php


$menu=$_POST["menu"];
$link=$_POST["link"];
$session_branch=$_POST["session_branch"];

$bNo="";
$command = "SELECT MAX(menu_id) as maxid FROM menu_main";
$menu_id=0;
$result = mysql_query($command, $con);
while ($row = mysql_fetch_assoc($result)){
	$menu_id = $row['maxid'];

}
$menu_id++;
	
$query="INSERT INTO menu_main(menu_id, menu_name, menu_link, menu_status, branch_id)
VALUES ('$menu_id','$menu','$link','active','$session_branch')";
mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
//echo 'success';

?>

<script>
window.location="index.php?action=menu_manage&c=settings&status=success//Menu Added Successfully";
</script>