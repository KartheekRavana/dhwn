<?php
include_once 'com/intent/retail/connection/db.php';
include_once "com/intent/retail/helper/helper.php";
$data=$_GET["data"];
$e_id=$_GET["m"];  

$date=curdate();
	$query ="update mst_measurement set tran_status='printed' where sk_tran_id='$e_id'";
	mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
$temp=explode("//", $data);
?>

<table>
<tr><th>Bill Date</th><td> : </td><td><?php echo $temp[1]?></td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<th>Mobile</th><td> : </td><td><?php echo $temp[2]?></td></tr>
</table>


<table border=1 cellspacing=0 cellpadding=0 style="width: 100%">
<tr><th>SlNo</th><th>Particular</th><th>Qty In Pcs</th><th>Qty In Sft</th><th>Rate</th><th>Cost</th></tr>
<?php 
$temp2=explode("$",$data);

//$temp1=explode("#", $temp2[1]);
for($i=1;$i<sizeof($temp2);$i++){
	$tdata=explode("@", $temp2[$i]);
	$item_name="";
$data1 = mysql_query("SELECT sk_particular_id, particular_name,category_id FROM mst_particular where sk_particular_id='".$tdata[0]."'");
		                while($info1 = mysql_fetch_array( $data1 ))
						{
		                		$item_name=$info1["particular_name"];
		                		$category=$info1["particular_name"];
		                }
		                
$message=$message."(Name : ".$item_name." Qty : ".$tdata[1]." Sft : ".$tdata[2]." Rate : ".$tdata[3]." Cost : ".$tdata[4].")\n";
?>
<tr>
	<td><?php echo $i?></td>
	<td><?php echo $item_name?></td>
	<td style="text-align: center;"><?php echo $tdata[1]?></td>
	<td style="text-align: center;"><?php echo $tdata[2]?></td>
	<td style="text-align: right;"><?php echo $tdata[3]?></td>
	<td style="text-align: right;"><?php echo $tdata[4]?></td>

</tr>
<?php }?>

</table>




<table style="float: right">
<tr><th>Billing Amount</th><td></td><td style="text-align: right;"><?php echo $temp[3]?></td></tr>
<tr><th>Tax Amt</th><td></td><td style="text-align: right;"><?php echo $temp[4]?></td></tr>
<tr><th>T Disc</th><td></td><td style="text-align: right;"><?php echo $temp[5]?></td></tr>
<tr><th>Total Amount</th><td></td><td style="text-align: right;"><?php echo $temp[6]?></td></tr>
<tr><th>Transport Amount</th><td></td><td style="text-align: right;"><?php echo $temp[7]?></td></tr>
<tr><th>Other Exp</th><td></td><td style="text-align: right;"><?php echo $temp[8]?></td></tr>
<tr><th>Total Payable</th><td></td><td style="text-align: right;"><?php echo $temp[9]?></td></tr>

</table>
<?php 

//**********************************LOG START****************************************************
$log_id=0;$command = "SELECT MAX(sk_log_id) as maxid FROM txn_log";$result = mysql_query($command, $con);while ($row = mysql_fetch_assoc($result)){$log_id = $row['maxid'];}$log_id++;
$query ="INSERT INTO txn_log (sk_log_id, tran_date, tran_time, member_type, tran_type, tran_desc, tran_table, member_id, bill_id, tran_id, branch_id, employee_id)
VALUES ('$log_id','$date',now(),'Customer','Measurement Print','$message','txn_measurement','0','0','$e_id','$session_branch','$session_id')";
mysql_query($query);
//**********************************LOG END****************************************************
?>
<script>
window.print();
setInterval(
		  function(){ window.close(); },
		  1000
		);
</script>