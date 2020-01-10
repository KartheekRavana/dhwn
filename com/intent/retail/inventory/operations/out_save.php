<?php include_once "$D_PATH/include/session.php";?>
<?php

	$bill_for=$_POST["bill_for"];
	$bill_date=$_POST["bill_date"];
	$bill_type=$_POST["bill_type"];
	
	
	
	$mobile=$_POST["mobile"];
	$place=$_POST["place"];
	$c_id=$_POST["customer_id"];
	$customer_name=$_POST["customer_name"];
	$data_details=$_POST["data"];
	$grand_total=$_POST["grand_total"];
	$other_expenses=$_POST["other_expenses"];
	$total=$_POST["total"];
	$slip_no=$_POST['slip_no'];
	$paid_amt=$_POST['paid_amt'];
	$note=$_POST['note'];
	$tax=$_POST['tax'];
	$transport=$_POST['transport'];
	//if($transport==""){$transport=0;}
	$cash_amount=$_POST["cash_amount"];
	$check_amount=$_POST["check_amount"];
	$discount=$_POST["discount"];
	$balance=$_POST['balance'];
	$advance=$_POST["advance_amount"];
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
	if (strpos($agent_per, '%') !== false) {
		$agent_amount=$grand_total*$agent_per/100;
	}else if($agent_per>0){
		if($agent_per<15){
		$total_sft=$_POST["total_sft"];
		$agent_amount=$agent_per*$total_sft;
		}else{
			$agent_amount=$agent_per;
		}
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
	$transporter_rate=$_POST["transporter_rate"];
	if($transporter_rate==""){
$transporter_rate=0;

	}

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
		VALUES ('$log_id','$date',now(),'Customer','New Customer','New Customer Added','mst_member','$cNo','0','0','$session_branch','$session_id')";
		mysql_query($query);
		//**********************************LOG END****************************************************
		
		
		$customer_name="";
		$c_id=$cNo;
	}
	$query ="update mst_member set mobile='$mobile', place='$place',member_status='active' where sk_member_id='$c_id'";
	mysql_query($query);
	
}

if($bill_type=="Cash"){$c_id=0;}
if($c_id==""){$c_id=0;}

if($agent_name!=""){
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
		VALUES ('$log_id','$date',now(),'Agent','New Agent','New Agent Added','mst_member','$agent_id','0','0','$session_branch','$session_id')";
		mysql_query($query);
		//**********************************LOG END****************************************************
		
		
		
	}

}


$command = "SELECT MAX(sk_bill_id) as maxid FROM mst_bill_main";
$bill_no=0;
$result = mysql_query($command, $con);
while ($row = mysql_fetch_assoc($result))
{
	$bill_no = $row['maxid'];
}$bill_no++;

$c_slip=0;
$command = "SELECT count(sk_bill_id) as maxid FROM mst_bill_main where bill_for='Customer' and bill_type='Cash'";
$result = mysql_query($command, $con);
while ($row = mysql_fetch_assoc($result))
{
	$c_slip = $row['maxid'];
}
$command = "SELECT count(sk_bill_id) as maxid FROM mst_bill_main where bill_for='Customer' and bill_type='Credit'";
$result = mysql_query($command, $con);
while ($row = mysql_fetch_assoc($result))
{
	$c_slip = $c_slip+$row['maxid'];
}
$c_slip++;

$query="INSERT INTO mst_bill_main(sk_bill_id, bill_date, bill_time, member_id, member_name, mobile, place, bill_for, bill_type, bill_amount, tax_rate, tax_amount, t_discount_rate, t_discount_amount, bill_tax_amount, transporter_id,transporter_rate, transport_amount, other_expenses, grand_total, cash_amount, check_amount, paid_amount, discount, balance_amount, note, bank_id, bill_status, measurement_slip_no,agent_id,agent_rate,agent_amount, employee_id, branch_id,slip_no)
VALUES ('$bill_no','$bill_date',now(),'$c_id','$customer_name','$mobile','$place','$bill_for','$bill_type','$grand_total','$tax_rate','$tax','$tax_disc','$tax_disc_amt','$actual_amt','$transporter_id','$transporter_rate','$transport','$other_expenses','$total','$cash_amount','$check_amount','$paid_amt','$discount','$balance','$note','$bank_id','active','$m_id','$agent_id','$agent_per','$agent_amount','$session_id','$session_branch','$c_slip')";
mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
$query1="update mst_measurement set tran_status='Billed' where sk_tran_id='$m_id'";
mysql_query($query1) or die('Query "' . $query1 . '" failed: ' . mysql_error());


$data1=explode("//", $data_details);
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
				VALUES ('$tran_id','$bill_no','$bill_for','$bill_type','$bill_date','$flower','$qty','$aqty','$cost','$tcost','active','$session_id','$session_branch')";
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


$query="INSERT INTO txn_transaction(sk_tran_id,tran_date,tran_time, credit, debit,member_id, transaction_ref_id, ref_table, tran_type, tran_desc, note,tran_status, employee_id, branch_id)
VALUES ('$tran_id','$bill_date',now(),'$total','$paid_amt','$c_id','$bill_no','mst_bill_main','$bill_for','New Bill','$bill_type','active','$session_id','$session_branch')";
mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());

			if($transporter_id!=0)
			{
				$tran_id++;
				$query="INSERT INTO txn_transaction(sk_tran_id,tran_date,tran_time, credit, debit,member_id, transaction_ref_id, ref_table, tran_type, tran_desc, note,tran_status, employee_id, branch_id)
				VALUES ('$tran_id','$bill_date',now(),'$transport','0','$transporter_id','$bill_no','mst_bill_main','Transporter','New Bill','$bill_type','active','$session_id','$session_branch')";
				mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
			}
			if($agent_per>0)
			{
				
				
				$tran_id++;
				$query="INSERT INTO txn_transaction(sk_tran_id,tran_date,tran_time, credit, debit,member_id, transaction_ref_id, ref_table, tran_type, tran_desc, note,tran_status, employee_id, branch_id)
				VALUES ('$tran_id','$bill_date',now(),'$agent_amount','0','$agent_id','$bill_no','mst_bill_main','Agent','New Bill','$bill_type','active','$session_id','$session_branch')";
				mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
			}
			if($paid_amt>0)
			{
				if($check_amount!=0)
				{
					$tran_id++;
					$query="INSERT INTO txn_transaction(sk_tran_id,tran_date,tran_time, credit, debit,member_id, transaction_ref_id, ref_table, tran_type, tran_desc, note,tran_status, employee_id, branch_id)
					VALUES ('$tran_id','$bill_date',now(),'$check_amount','0','$bank_id','$bill_no','mst_bill_main','Bank','New Bill','$bill_type','active','$session_id','$session_branch')";
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
$message="Slip No : $slip_no, TAmt : $total, RAmt : $paid_amt, Bal : $bal_amt";
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
VALUES ('$log_id','$date',now(),'Customer','New $bill_type Bill','$message','txn_transaction','$c_id','$bill_no','$tran_id','$session_branch','$session_id')";
mysql_query($query);
//**********************************LOG END****************************************************

?>
 <!-- <embed src="http://167.114.60.246/VidyaSMS/SendSMS.aspx?User=dharani&Pwd=dharani&SenderId=DMGBLY&MobileNo=<?php echo $phone?>&Message=<?php echo $sms?>">
 -->

<script>
var url="?action=print/print_bill&c=inventory&bill_no=<?php echo $bill_no?>&op=print";

window.open(url,'_blank');
setTimeout(function() { window.location="?action=sales&c=inventory"; }, 5000);

</script>