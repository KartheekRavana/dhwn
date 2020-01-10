<?php ob_start();
session_start();
/*$_SESSION['session_id']='0';
$_SESSION['session_type']='admin';
$_SESSION['session_name']='Manoj';
$_SESSION['session_branch']='0';*/


if($_SESSION['session_id']==null){header("Location: index.php?action=logout&c=login");}
else{
	
	$session_type=$_SESSION['session_type'];$session_name=$_SESSION['session_name'];
	$session_branch=$_SESSION['session_branch'];
	$session_id=$_SESSION['session_id'];
	$session_branch_type=$_SESSION['session_branch_type'];
}
include "$D_PATH/connection/db.php";

include_once "$D_PATH/helper/helper.php";
$date1=$_SESSION['date1'];
$time=$_SESSION['time'];
$date=$_SESSION['date'];

$command = "SELECT count(slip_no) as maxid FROM customer_transactions where branch='$session_branch' and slip_no!=0";
$slip_no=0;
$result = mysql_query($command, $con);
while ($row = mysql_fetch_assoc($result)){
	$slip_no = $row['maxid'];
}

$slip_no++;


?>
<link href="<?php echo $UI_ELEMENTS?>notify/css/style.css" rel="stylesheet" type="text/css"></link>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.js"></script>
<script type="text/javascript" src="<?php echo $UI_ELEMENTS?>notify/js/jquery.intent.js"></script>
