<?php
include_once 'connection/db.php';
$customer_data="";$member_bill="";
$k=1;
$bank_tran="";

 		$data1 = mysql_query("SELECT bill_no, customer_id, bill_date, total, comm, lug_exp, tax, transport, prev_bal, total_bal, amount_paid, final_bal, login_id, branch, customer_name, partner_id, check_payment, cashe_payment, discount, phone, city, customer_bill_no, payment_status FROM customerbillmain where customer_id='0' order by bill_date desc limit 3000,6000");
        while($info1 = mysql_fetch_array( $data1 ))
        {
        	$member_bill=$member_bill."//".$info1["customer_id"]."::".$info1["bill_date"]."::".$info1["total"]."::".$info1["comm"]."::".$info1["lug_exp"]."::".$info1["tax"]."::".$info1["transport"]."::".$info1["prev_bal"]."::".$info1["total_bal"]."::".$info1["amount_paid"]."::".$info1["final_bal"]."::".$info1["login_id"]."::".$info1["branch"]."::".$info1["customer_name"]."::".$info1["partner_id"]."::".$info1["check_payment"]."::".$info1["cashe_payment"]."::".$info1["discount"]."::".$info1["phone"]."::".$info1["city"]."::".$info1["customer_bill_no"]."::".$info1["payment_status"]."::0::0::0::".$info1["total_bal"]."::0::0::";         	
        	
         	$member_bill_support="";
         	$bill_no=$info1["bill_no"];
         	$data4 = mysql_query("SELECT tran_id, bill_no, item_date, item_name,description, item_qty, item_rate, amt, item_qty_p FROM customerbill where bill_no=$bill_no");
            while($info4 = mysql_fetch_array( $data4 ))
            {
                	$item_id=$info4["item_name"];
                	$item_qty=$info4["item_qty"];
                	$item_qty_p=$info4["item_qty_p"];
                	$item_rate=$info4["item_rate"];
                	$amt=$info4["amt"];
                	$description=$info4['description'];
                	$landing_cost=0;
                	$total_landing_cost=0;
                	$member_bill_support=$member_bill_support."#".$item_id."::".$item_qty."::".$item_qty_p."::".$item_rate."::".$amt."::".$landing_cost."::".$total_landing_cost."::".$description."::";
            }
            $member_bill=$member_bill.$member_bill_support;
            $k++;

        }
        
        
     
 
 
 
 
 
 
 include_once 'connection/db1.php';

 $member_type=2;
 $session_id=1;
 	$session_branch=1;

 $temp_data=explode("//", $member_bill);
 for($i=1;$i<sizeof($temp_data);$i++){
 	
 	$bill_main=explode("::", $temp_data[$i]);
 	$bill_support=explode("#", $temp_data[$i]);
 	/*
2."::".$info1["comm"]."::".4."::".5."::".6."::".$info1["prev_bal"]."::".$info1["total_bal"]."::".9."::".10
."::".$info1["login_id"]."::".$info1["branch"]."::".$info1["customer_name"]."::".$info1["partner_id"]."::".15."::".
16."::".$info1["discount"]."::".$info1["phone"]."::".$info1["city"]."::".$info1["customer_bill_no"]."::".
$info1["payment_status"]."::".22."::".23."::".24."::".$info1["actual_amount"]."::".
$info1["measurement_slip"]."::".27."::";         	
        	*/
 	
	$old_ref=$bill_main[0];
 	$bill_date=$bill_main[1];
 	$bill_amount=$bill_main[2];
 	$tax_rate=$bill_main[22];
 	$tax=$bill_main[5];
 	$tax_disc=$bill_main[23];
 	$tax_disc_amt=$bill_main[24];
 	$bill_tax_amount=0;
 	$transporter_id=$bill_main[27];
 	$transporter_rate=0;
 	$transport=$bill_main[6];
 	$other_expenses=$bill_main[3];
 	$hamali=$bill_main[9];
 	$actual_amt=$bill_amount+$other_expenses;
 	$total=$bill_main[8];
 	$cash_amount=$bill_main[16];
 	$check_amount=$bill_main[15];
 	$customer_name=$bill_main[13];
 	$paid_amt=$bill_main[9];
 	$discount=0;
 	$balance=$bill_main[10];
 	$note="";
 	$bank_id=0;
 	$bill_status='active';
 	$measurement_slip_no=0;
 	$agent_id=0;
 	$agent_per=0;
 	$agent_amount=0;
 	$m_id=0;
 	
 	$mobile="";
 	$sk_member_id=0;$place=0;
	
 	
 	$command = "SELECT MAX(sk_bill_id) as maxid FROM mst_bill_main";
$bill_no=0;
$result = mysql_query($command, $con);
while ($row = mysql_fetch_assoc($result))
{
	$bill_no = $row['maxid'];
}$bill_no++;
	$query="INSERT INTO mst_bill_main(sk_bill_id, bill_date, bill_time, member_id, member_name, mobile, place, bill_for, bill_type, bill_amount, tax_rate, tax_amount, t_discount_rate, t_discount_amount, bill_tax_amount, transporter_id,transporter_rate, transport_amount, other_expenses,hamali, grand_total, cash_amount, check_amount, paid_amount, discount, balance_amount, note, bank_id, bill_status, measurement_slip_no,agent_id,agent_rate,agent_amount, employee_id, branch_id)
	VALUES ('$bill_no','$bill_date',now(),'$sk_member_id','$customer_name','$mobile','$place','Customer','Cash','$bill_amount','$tax_rate','$tax','$tax_disc','$tax_disc_amt','$actual_amt','$transporter_id','$transporter_rate','$transport','$other_expenses','$hamali','$total','$cash_amount','$check_amount','$paid_amt','$discount','$balance','$note','$bank_id','active','$m_id','$agent_id','$agent_per','$agent_amount','$session_id','$session_branch')";
	mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
	echo $query;
	$command = "SELECT MAX(sk_tran_id) as maxid FROM txn_transaction";
	$sk_tran_id=0;$result = mysql_query($command, $con);while ($row = mysql_fetch_assoc($result)){$sk_tran_id = $row['maxid'];}$sk_tran_id++;
	

	$query="INSERT INTO txn_transaction(sk_tran_id,tran_date,tran_time, credit, debit,member_id, transaction_ref_id, ref_table, tran_type, tran_desc, note,tran_status, employee_id, branch_id)
VALUES ('$sk_tran_id','$bill_date',now(),'$total','0','$sk_member_id','$bill_no','mst_bill_main','Customer','New Bill','Cash','active','$session_id','$session_branch')";
mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
	
	//$member_bill=$member_bill."#".$item_id."#".$item_qty."#".$item_qty_p."#".$item_rate."#".$amt."#".$landing_cost."#".$total_landing_cost."#";
	 for($j=1;$j<sizeof($bill_support);$j++){
	 	
	 	$b=explode("::", $bill_support[$j]);
		$flower=$b[0];$qty=$b[2];$aqty=$b[1];$cost=$b[3];
		$tcost=$b[4];$lcost=number_format($b[5], 2, '.', ' ');$tlcost=number_format($b[6], 2, '.', ' ');;
	
		$sk_particular_id=0;
			$data1 = mysql_query("SELECT sk_particular_id FROM mst_particular where particular_name='$flower'");
            while($info1 = mysql_fetch_array( $data1 ))
            {
            	$sk_particular_id=$info1["sk_particular_id"];
				
            }
			/*	if($sk_particular_id==0){
					$command = "SELECT MAX(sk_particular_id) as maxid FROM mst_particular";
$cNo=0;
$result = mysql_query($command, $con);
while ($row = mysql_fetch_assoc($result)){
	$sk_particular_id = $row['maxid'];
}

$sk_particular_id++;
					$query ="INSERT INTO mst_particular (sk_particular_id, particular_name, particular_desc, category_id, sub_category_id, particular_status, branch_id)
				VALUES ('$sk_particular_id','$flower','$flower','1','0','active','$session_branch')";
				mysql_query($query);
				}*/
		$command = "SELECT MAX(sk_tran_id) as maxid FROM txn_bill_support";
		$tran_id=0;
		$result = mysql_query($command, $con);
		while ($row = mysql_fetch_assoc($result))
		{
			$tran_id = $row['maxid'];
		}
		$tran_id++;
		
	 	$query="INSERT INTO txn_bill_support(sk_tran_id, bill_id, bill_for, bill_type, bill_date, particular_id,description, qty_in_piece, qty_in_sft, rate, amount,landing_cost, bill_status, employee_id, branch_id)
				VALUES ('$tran_id','$bill_no','Customer','Cash','$bill_date','$sk_particular_id','$description','$qty','$aqty','$cost','$tcost','$lcost','active','$session_id','$session_branch')";
				mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
	 }     	 
 	
 	
 }
 
 

 	$temp_date=explode("//", $bank_tran);
 	for($i=1;$i<sizeof($temp_date);$i++){
 		
 		$temp=explode("::", $temp_date[$i]);
 		
 		$tran_date=$temp[0];
 		$time=$temp[1];
 		$debit=$temp[2];
 		$note=$temp[3];
 		$tran_id=$temp[4];
 		$transaction_id=$temp[5];
 		$tran_type=$temp[6];
 		$old_ref=$temp[7];
 		$bank_id=$temp[8];
 	$sk_member_id=0;
	
 		
 	$command = "SELECT MAX(sk_tran_id) as maxid FROM txn_transaction";
	$sk_tran_id=0;$result = mysql_query($command, $con);while ($row = mysql_fetch_assoc($result)){$sk_tran_id = $row['maxid'];}$sk_tran_id++;
 	if($debit>0)
 		if($tran_type=="BANK"){
 			
 			$query="INSERT INTO txn_transaction(sk_tran_id,tran_date,tran_time, credit, debit,member_id, transaction_ref_id, ref_table, tran_type, tran_desc, note,tran_status, employee_id, branch_id)
		VALUES ('$sk_tran_id','$tran_date','$time','0','$debit','$sk_member_id','$transaction_id','mst_member','Customer','Bank Payment','$note','active','$session_id','$session_branch')";
		mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
		$t=$sk_tran_id+1;
		//echo $query;
		$query="INSERT INTO txn_transaction(sk_tran_id,tran_date,tran_time, credit, debit,member_id, transaction_ref_id, ref_table, tran_type, tran_desc, note,tran_status, employee_id, branch_id)
		VALUES ('$t','$tran_date',now(),'$debit','0','$bank_id ','$sk_tran_id','mst_member','Bank','Customer Deposit','$note','active','$session_id','$session_branch')";
		mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
		
 		}else{
 		$query="INSERT INTO txn_transaction(sk_tran_id,tran_date,tran_time, credit, debit,member_id, transaction_ref_id, ref_table, tran_type, tran_desc, note,tran_status, employee_id, branch_id)
		VALUES ('$sk_tran_id','$tran_date','$time','0','$debit','$sk_member_id','$sk_tran_id','mst_member','Customer','Payment','$note','active','$session_id','$session_branch')";
		mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
 		}
 	}
 
 
 