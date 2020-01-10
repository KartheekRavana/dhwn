<?php include_once "$D_PATH/include/session.php";?>
<?php

	$bill_for=$_POST["bill_for"];
	$bill_date=$_POST["bill_date"];
	$bill_type=$_POST["bill_type"];
	
	$bill_no=$_POST["customer_bill_no"];
	
	
	$mobile=$_POST["mobile"];
	$place=$_POST["place"];
	$c_id=$_POST["customer_id"];
	$customer_name=$_POST["customer_name"];
	$data_details=$_POST["data"];
	$grand_total=$_POST["grand_total"];
	$other_expenses=$_POST["other_expenses"];
	$total=$_POST["total_val"];
	$slip_no=$_POST['slip_no'];
	$paid_amt=$_POST['paid_amt'];
	$note=$_POST['note'];
	$tax=$_POST['tax'];
	$transport=$_POST['transport'];
	
	$cash_amount=$_POST["cash_amount"];
	$check_amount=$_POST["check_amount"];
	$discount=$_POST["discount"];
	$balance=$_POST['balance'];

	$bank_id=$_POST["bank"];
	$check_no=$_POST["check_no"];
	
	$login=$session_id;
	$branch=$session_branch;
	
	$tax_rate=$_POST["tax_rate"];
	$tax_disc=$_POST["tax_disc"];
	$tax_disc_amt=$_POST["tax_disc_amt"];
	$actual_amt=$_POST["total_amt"];
	
	$agent_type=$_POST["agent_type"];
	$agent_id=$_POST["agent_id"];
	$agent_name=$_POST["agent_name"];
	$agent_per=$_POST["agent_per"];
	if($agent_per>0){
		$agent_amount=$grand_total*$agent_per/100;
	}else{
		$agent_amount=0;
		$agent_id=0;
	}
	
	if(isset($_POST["m_id"])){
	$m_id=$_POST["m_id"];
	}else{
		$m_id=0;
	}
	$transporter_id=$_POST["transporter_id"];
$p_name=0;

if($bill_type=="Credit")
{
	if($customer_name!="" && $c_id=="")
	{
		$command = "SELECT MAX(sk_member_id) as maxid FROM mst_member";
		$cNo=0;
		$result = mysql_query($command, $con);
		while ($row = mysql_fetch_assoc($result)){
			$cNo = $row['maxid'];
		}
		$cNo++;
		$query ="INSERT INTO mst_member (sk_member_id, member_type, member_name, acc_no, ifsc, mobile, landline, email, address, place, state, profile_pic, login_name, login_password, login_status,employee_id, branch_id)
		VALUES ('$cNo','2','$customer_name','','','$mobile','','','','$place','','','','','active','$session_id','$session_branch')";
		mysql_query($query);
		//**********************************LOG START****************************************************
		$log_id=0;$command = "SELECT MAX(sk_log_id) as maxid FROM txn_log";$result = mysql_query($command, $con);while ($row = mysql_fetch_assoc($result)){$log_id = $row['maxid'];}$log_id++;
		$query ="INSERT INTO txn_log (sk_log_id, tran_date, tran_time, member_type, tran_type, tran_desc, tran_table, member_id, bill_id, tran_id, branch_id, employee_id)
		VALUES ('$log_id','$date',now(),'Customer','New','New Customer Added','mst_member','$cNo','0','0','$session_branch','$session_id')";
		mysql_query($query);		
		//**********************************LOG END****************************************************
		$customer_name="";
		$c_id=$cNo;
	}
	$query ="update mst_member set mobile='$mobile', place='$place' where sk_member_id='$c_id'";
	mysql_query($query);
	
}

if($c_id==""){$c_id=0;}

if($agent_per!=""){
	if($agent_type=="New"){
		$command = "SELECT MAX(sk_member_id) as maxid FROM mst_member";
		$agent_id=0;
		$result = mysql_query($command, $con);
		while ($row = mysql_fetch_assoc($result)){
			$agent_id = $row['maxid'];
		}
		$agent_id++;
		$query ="INSERT INTO mst_member (sk_member_id, member_type, member_name, acc_no, ifsc, mobile, landline, email, address, place, state, profile_pic, login_name, login_password, login_status,employee_id, branch_id)
		VALUES ('$agent_id','5','$agent_name','','','$mobile','','','','$place','','','','','active','$session_id','$session_branch')";
		mysql_query($query);
		//**********************************LOG START****************************************************
		$log_id=0;$command = "SELECT MAX(sk_log_id) as maxid FROM txn_log";$result = mysql_query($command, $con);while ($row = mysql_fetch_assoc($result)){$log_id = $row['maxid'];}$log_id++;
		$query ="INSERT INTO txn_log (sk_log_id, tran_date, tran_time, member_type, tran_type, tran_desc, tran_table, member_id, bill_id, tran_id, branch_id, employee_id)
		VALUES ('$log_id','$date',now(),'Agent','New','New Agent Added','mst_member','$agent_id','0','0','$session_branch','$session_id')";
		mysql_query($query);
		//**********************************LOG END****************************************************
	}

}



$query="update mst_bill_main set bill_date='$bill_date', member_id='$c_id', member_name='$customer_name', mobile='$mobile', place='$place', bill_for='$bill_for', bill_type='$bill_type', bill_amount='$grand_total', tax_rate='$tax_rate', tax_amount='$tax', t_discount_rate='$tax_disc', t_discount_amount='$tax_disc_amt', bill_tax_amount='$actual_amt', transporter_id='$transporter_id', transport_amount='$transport', other_expenses='$other_expenses', grand_total='$total', cash_amount='$cash_amount', check_amount='$check_amount', paid_amount='$paid_amt', discount='$discount', balance_amount='$balance', note='$note', bank_id='$bank_id',agent_id='$agent_id',agent_rate='$agent_per',agent_amount='$agent_amount' where sk_bill_id='$bill_no'";
mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());


$data1=explode("//", $data_details);

mysql_query("delete from txn_bill_support where bill_id='$bill_no'");

for($i=1;$i<sizeof($data1);$i++)
{
$data2=explode("#", $data1[$i]);
{

$flower=$data2[0];$qty=$data2[1];$aqty=$data2[2];$cost=$data2[3];$tcost=$data2[4];

$command = "SELECT MAX(sk_tran_id) as maxid FROM txn_bill_support";
				$tran_id=0;
		$result = mysql_query($command, $con);
		while ($row = mysql_fetch_assoc($result))
		{
		$tran_id = $row['maxid'];
		}$tran_id++;


				$query="INSERT INTO txn_bill_support(sk_tran_id, bill_id, bill_for, bill_type, bill_date, particular_id, qty_in_piece, qty_in_sft, rate, amount, bill_status, employee_id, branch_id)
				VALUES ('$tran_id','$bill_no','$bill_for','$bill_type','$bill_date','$flower','$aqty','$qty','$cost','$tcost','active','$session_id','$session_branch')";
				mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
					
}
}

		$command = "SELECT MAX(sk_tran_id) as maxid FROM txn_transaction";
		$tran_id=0;
		$result = mysql_query($command, $con);
		while ($row = mysql_fetch_assoc($result))
		{
		$tran_id = $row['maxid'];
}$tran_id++;


mysql_query("update txn_transaction set tran_status='Updated' where transaction_ref_id='$bill_no' and ref_table='mst_bill_main' and tran_type='$bill_for' and tran_desc='Return Bill'");

			$query="INSERT INTO txn_transaction(sk_tran_id,tran_date,tran_time, credit, debit,member_id, transaction_ref_id, ref_table, tran_type, tran_desc, note,tran_status, employee_id, branch_id)
			VALUES ('$tran_id','$bill_date',now(),'$paid_amt','$total','$c_id','$bill_no','mst_bill_main','$bill_for','Return Bill','$bill_type','active','$session_id','$session_branch')";
			mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());

mysql_query("update txn_transaction set tran_status='Updated' where transaction_ref_id='$bill_no' and ref_table='mst_bill_main' and tran_type='Transporter' and tran_desc='Return Bill'");
			if($transporter_id!=0)
			{
				$tran_id++;
				$query="INSERT INTO txn_transaction(sk_tran_id,tran_date,tran_time, credit, debit,member_id, transaction_ref_id, ref_table, tran_type, tran_desc, note,tran_status, employee_id, branch_id)
				VALUES ('$tran_id','$bill_date',now(),'$transport','0','$transporter_id','$bill_no','mst_bill_main','Transporter','Return Bill','$bill_type','active','$session_id','$session_branch')";
				mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
			}
mysql_query("update txn_transaction set tran_status='Updated' where transaction_ref_id='$bill_no' and ref_table='mst_bill_main' and tran_type='Agent' and tran_desc='Return Bill'");			
			if($agent_per>0)
			{
				$tran_id++;
				$query="INSERT INTO txn_transaction(sk_tran_id,tran_date,tran_time, credit, debit,member_id, transaction_ref_id, ref_table, tran_type, tran_desc, note,tran_status, employee_id, branch_id)
				VALUES ('$tran_id','$bill_date',now(),'0','$agent_amount','$agent_id','$bill_no','mst_bill_main','Agent','Return Bill','$bill_type','active','$session_id','$session_branch')";
				mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
			}
mysql_query("update txn_transaction set tran_status='Updated' where transaction_ref_id='$bill_no' and ref_table='mst_bill_main' and tran_type='Bank' and tran_desc='Return Bill'");
			if($paid_amt>0)
			{
				if($check_amount>0)
				{
					$tran_id++;
					$query="INSERT INTO txn_transaction(sk_tran_id,tran_date,tran_time, credit, debit,member_id, transaction_ref_id, ref_table, tran_type, tran_desc, note,tran_status, employee_id, branch_id)
					VALUES ('$tran_id','$bill_date',now(),'0','$check_amount','$bank_id','$bill_no','mst_bill_main','Bank','Return Bill','$bill_type','active','$session_id','$session_branch')";
					mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
				}


				}



$curtime=curtime();
$command = "SELECT MAX(sms_id) as maxid FROM txn_sms";
$cNo=0;
$sms_id=0;
$result = mysql_query($command, $con);
while ($row = mysql_fetch_assoc($result)){
	$sms_id = $row['maxid'];
}
$sms_id++;
$bal_amt=($total-$paid_amt)-$discount;
$message="Bill Updated : Slip No : $slip_no, TAmt : $total, RAmt : $paid_amt, Bal : $bal_amt";
$query ="INSERT INTO txn_sms (sms_id, sms_date, message, sms_type, customer_id, customers, sms_status,employee_id,branch_id)
VALUES ('$sms_id','$date','$message','BILL','0','0','Sent','$session_id','$session_branch')";
mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());

$phone="9483234888,9448690680,9886400401";


$sms=$message;
/* $query1="update mst_measurement set tran_status='Billed' where sk_tran_id='$m_id'";
mysql_query($query1) or die('Query "' . $query1 . '" failed: ' . mysql_error());
 */

//**********************************LOG START****************************************************
$log_id=0;$command = "SELECT MAX(sk_log_id) as maxid FROM txn_log";$result = mysql_query($command, $con);while ($row = mysql_fetch_assoc($result)){$log_id = $row['maxid'];}$log_id++;
$query ="INSERT INTO txn_log (sk_log_id, tran_date, tran_time, member_type, tran_type, tran_desc, tran_table, member_id, bill_id, tran_id, branch_id, employee_id)
VALUES ('$log_id','$date',now(),'Supplier','Return Update','$message','txn_transaction','$c_id','$bill_no','$tran_id','$session_branch','$session_id')";
mysql_query($query);
//**********************************LOG END****************************************************

?>
<!-- <embed src="http://167.114.60.246/VidyaSMS/SendSMS.aspx?User=dharani&Pwd=dharani&SenderId=DMGBLY&MobileNo=<?php echo $phone?>&Message=<?php echo $sms?>">
 -->

<script>
//var url="?action=print/print_bill&c=inventory&c_id=0&bill_no=<?php echo $bill_no?>&op=print";

//window.open(url,'_blank');
setTimeout(function() { window.location="?action=purchase_return_edit&c=inventory&bill_no=<?php echo $bill_no?>"; }, 100);

</script>