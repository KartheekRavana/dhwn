<?php include_once "com/intent/retail/connection/db.php";
include_once "com/intent/retail/helper/helper.php";
?><?php

$finaldata=$_POST["data"];
$mobile=$_POST["mobile"];
$divby=$_POST["divby"];
$employee=$_POST["employee"];
$branch_id=$_POST["session_branch"];

$mtype=$_POST["mtype"];

$date=curdate();

$command = "SELECT MAX(sk_tran_id ) as maxid FROM mst_measurement";
$bill_no=0;
$result = mysql_query($command, $con);
while ($row = mysql_fetch_assoc($result)){
    $bill_no = $row['maxid'];

}

$bill_no++;
$message="";
$query="INSERT INTO mst_measurement(`sk_tran_id`, `tran_date`, `tran_time`,mobile, `tran_status`,employee_id,branch_id,measurement_type)
VALUES ('$bill_no','$date',now(),'$mobile','active','$employee','$branch_id','$mtype')";
mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());

//$count=$_POST["count"];

$temp=explode("//", $finaldata);
for($i=1;$i<sizeof($temp);$i++)
{
	$temp1=explode("#", $temp[$i]);
	$item=$temp1[0];
	$length=$temp1[1];
	$width=$temp1[2];
	$sft=$temp1[3];

	if($item!="" && $sft!="")
	{
	$category_id=0;
	$data = mysql_query("SELECT sk_particular_id,particular_name FROM mst_particular where sk_particular_id='$item'");
	while($info = mysql_fetch_array( $data )){
		$category_id=$info["sk_particular_id"];
	}
	
	$command = "SELECT MAX(txn_id) as maxid FROM txn_measurement";
$txn_id=0;
$result = mysql_query($command, $con);
while ($row = mysql_fetch_assoc($result)){
    $txn_id = $row['maxid'];

}$txn_id++;

	$query="INSERT INTO txn_measurement( txn_id,`tran_id`, `category_id`, `item_id`, `length`, `width`, `div_by`, `total_sft`, `txn_status`,employee_id,branch_id)
	VALUES ('$txn_id','$bill_no','$category_id','$item','$length','$width','$divby','$sft','pending','$employee','$branch_id')";
	mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
	
	
	$item_name="";
	$sql=mysql_query("SELECT sk_particular_id, particular_name, particular_desc, category_id, sub_category_id, particular_status, branch_id FROM mst_particular WHERE sk_particular_id='$item'");
	while ($row1=mysql_fetch_array($sql))
	{
		$item_name=$row1['particular_name'];
	}
	
	$message=$message."(Name : ".$item_name." Length : ".$length." Width : ".$width." Divided : ".$divby." sft : ".$sft.")\n";
	
	}
	
}

$data = mysql_query("SELECT sk_member_id,member_name,member_type,branch_id,profile_pic,role FROM mst_member where sk_member_id='$employee'");
$login_status='fail';
while($info = mysql_fetch_array( $data ))
{
		$_SESSION['session_id']=$info["sk_member_id"];
		$_SESSION['session_name']=$info["member_name"];
		$_SESSION['session_type']=$info["role"];
		$_SESSION['session_branch']=$info["branch_id"];
		
		if($info["profile_pic"]=="" || $info["profile_pic"]=="no_preview.png"){$_SESSION['profile_pic']="dmg.png";}
		else {
		$_SESSION['profile_pic']=$info["profile_pic"];
		}
		//echo $_SESSION['profile_pic'];
		
}


//**********************************LOG START****************************************************
$log_id=0;$command = "SELECT MAX(sk_log_id) as maxid FROM txn_log";$result = mysql_query($command, $con);while ($row = mysql_fetch_assoc($result)){$log_id = $row['maxid'];}$log_id++;
$query ="INSERT INTO txn_log (sk_log_id, tran_date, tran_time, member_type, tran_type, tran_desc, tran_table, member_id, bill_id, tran_id, branch_id, employee_id)
VALUES ('$log_id','$date',now(),'Customer','Measurement','$message','txn_transaction','0','0','$bill_no','$session_branch','$session_id')";
mysql_query($query);
//**********************************LOG END****************************************************

?>

<script>
window.location="?action=measurement_slip&c=inventory&status=success//Successfully Saved Measurements";
</script>
