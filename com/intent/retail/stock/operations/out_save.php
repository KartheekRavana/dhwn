<?php include_once "$D_PATH/include/session.php";?>
<?php

	$bill_no_customer=$_POST["bill_no"];
	$bill_date=$_POST["bill_date"];
	$bill_type=$_POST["bill_type"];
	$payment_status=$_POST["payment_status"];
	$partner=$_POST["partner"];
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
	$note_tran=$_POST['note'];
	$tax=$_POST['tax'];
	$transport=$_POST['transport'];
	$transporter=$_POST["transporter"];
	$cash_amount=$_POST["cash_amount"];
	$check_amount=$_POST["check_amount"];
	$discount=$_POST["discount"];
	$balance=$_POST['balance'];
	$advance=$_POST["advance_amount"];
	$bank_id=$_POST["bank"];
	$check_no=$_POST["check_no"];
	$note=$_POST['note'];
	$login=$session_id;
	$branch=$session_branch;
	
	$agent_type=$_POST["agent_type"];
	$agent_id=$_POST["agent_id"];
	$agent_name=$_POST["agent_name"];
	$agent_per=$_POST["agent_per"];
	if (strpos($agent_per, '%') !== false) {
		$agent_amount=$grand_total*$agent_per/100;
	}else if($agent_per>0){
		if($agent_per<15){
		$total_sft=$_POST["grand_total"];
		$agent_amount=($total_sft/100)*$agent_per;
		}else{
			$agent_amount=$agent_per;
		}
	}else{
		$agent_amount=0;
		$agent_id=0;
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
VALUES ('$bill_no','$bill_date',now(),'$c_id','$customer_name','$mobile','$place','Customer','$bill_type','$grand_total','0','0','0','0','$grand_total','0','$transporter','$transport','$other_expenses','$total','$cash_amount','$check_amount','$paid_amt','$discount','$balance','$note','$bank_id','active','0','$agent_id','$agent_per','0','$session_id','$session_branch','$c_slip')";
mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());

	

	
		
		$data1=explode("//", $data_details);
		for($i=1;$i<sizeof($data1);$i++)
		{
			$data2=explode("#", $data1[$i]);
			{
	
				$flower=$data2[0];$qty=$data2[1];$aqty=$data2[2];$cost=$data2[3];$tcost=$data2[4];$desc=$data2[5];$barcode=$data2[6];
				$discount=$data2[7];$note=$data2[8];
				$item_id=0;$item_tran_id=0;
				if($barcode!="")
				{$temp=explode("-", $barcode);
				$item_id=$temp[0];
				$item_tran_id=$temp[1];}
				
				$command = "SELECT MAX(sk_tran_id) as maxid FROM txn_bill_support";
				$tran_id=0;
		$result = mysql_query($command, $con);
		while ($row = mysql_fetch_assoc($result))
		{
		$tran_id = $row['maxid'];
		}$tran_id++;


				$query="INSERT INTO txn_bill_support(sk_tran_id, bill_id, bill_for, bill_type, bill_date, particular_id,description,note, qty_in_piece, qty_in_sft, rate, amount, bill_status, employee_id, branch_id)
				VALUES ('$tran_id','$bill_no','Customer','$bill_type','$bill_date','$flower','$desc','$note','$qty','$aqty','$cost','$tcost','active','$session_id','$session_branch')";
				mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
				
				
				
				
			}
		}
		$total=$total-$discount;
		$bal=$total-$paid_amt;
		
		
		$command = "SELECT MAX(sk_tran_id) as maxid FROM txn_transaction";
		$tran_id=0;
		$result = mysql_query($command, $con);
		while ($row = mysql_fetch_assoc($result))
		{
		$tran_id = $row['maxid'];
}$tran_id++;


$query="INSERT INTO txn_transaction(sk_tran_id,tran_date,tran_time, credit, debit,member_id, transaction_ref_id, ref_table, tran_type, tran_desc, note,tran_status, employee_id, branch_id)
VALUES ('$tran_id','$bill_date',now(),'$total','$paid_amt','$c_id','$bill_no','mst_bill_main','Customer','New Bill','$bill_type','active','$session_id','$session_branch')";
mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
		

if($transporter!=0)
			{
				$tran_id++;
				$query="INSERT INTO txn_transaction(sk_tran_id,tran_date,tran_time, credit, debit,member_id, transaction_ref_id, ref_table, tran_type, tran_desc, note,tran_status, employee_id, branch_id)
				VALUES ('$tran_id','$bill_date',now(),'$transport','0','$transporter','$bill_no','mst_bill_main','Transporter','New Bill','$bill_type','active','$session_id','$session_branch')";
				mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
			}
			

$pid=$_POST["pid"];

	$query ="update customerpickermain set payment_status='active' where bill_no='$pid'";
				mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
				
			
		

if($agent_per>0)
			{
				
				
				$tran_id++;
				$query="INSERT INTO txn_transaction(sk_tran_id,tran_date,tran_time, credit, debit,member_id, transaction_ref_id, ref_table, tran_type, tran_desc, note,tran_status, employee_id, branch_id)
				VALUES ('$tran_id','$bill_date',now(),'$agent_amount','0','$agent_id','$bill_no','mst_bill_main','Agent','New Bill','$bill_type','active','$session_id','$session_branch')";
				mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
			}
?>

 
<script>
//self.print();
var url="?action=print/print_bill&c=inventory&bill_no=<?php echo $bill_no?>&op=print";

window.open(url,'_blank');
setTimeout(function() { window.location="?action=new&c=stock"; }, 2000);
//window.location="?action=print/print_bill&c=inventory&bill_no=<?php echo $bill_no?>&op=print";
</script>