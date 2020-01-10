<?php
include_once 'connection/db.php';
$supplier_data="";$member_bill="";
$k=1;
$bank_tran="";
 $data = mysql_query("SELECT supplier_id,supplier_name,address,phone,mobile,supplier_no,balance,email,supplier_status,city,mobile,supplier_status FROM supplier order by supplier_name asc");
 while($info = mysql_fetch_array( $data ))
 {
                                
	$customerid=$info["supplier_id"];$balance=0;$supplier = mysql_query("SELECT credit, debit FROM supplier_transactions where supplier_id='".$customerid."' order by TRAN_DATE asc");
    while($supplier1 = mysql_fetch_array( $supplier )){if($supplier1['credit']>0 || $supplier1['debit']>0){$balance=$balance+$supplier1['credit'];$balance=$balance-$supplier1['debit'];}}
	
 	$supplier_data=$supplier_data."//".$info["supplier_name"]."::".$info["address"]."::".$info["mobile"]."::".$info["phone"]."::".$info["email"]."::".$info["city"]."::".$info["supplier_status"]."::".$info["supplier_id"]."::".$balance;
 	
 	
 		$data1 = mysql_query("SELECT bill_no, supplier_id, bill_date, total, other_exp, lug_exp, exp, advance, gtotal, total_bal, login_id, branch,hamali FROM supplierbillmain where supplier_id='".$info["supplier_id"]."' order by bill_date desc");
        while($info1 = mysql_fetch_array( $data1 ))
        {
         	$member_bill=$member_bill."//".$info1["supplier_id"]."::".$info1["bill_date"]."::".$info1["total"]."::".$info1["other_exp"]."::".$info1["lug_exp"]."::".$info1["exp"]."::".$info1["advance"]."::".$info1["gtotal"]."::".$info1["total_bal"]."::".$info1["hamali"]."::";         	
        	
         	$member_bill_support="";
         	$bill_no=$info1["bill_no"];
         	$data4 = mysql_query("SELECT tran_id, bill_no, item_date, item_name, item_qty, item_rate, amt, landing_cost, total_landing_cost, item_qty_p,description FROM supplierbill where bill_no=$bill_no");
            while($info4 = mysql_fetch_array( $data4 ))
            {
                	$item_id=$info4["item_name"];
                	$item_qty=$info4["item_qty"];
                	$item_qty_p=$info4["item_qty_p"];
                	$item_rate=$info4["item_rate"];
                	$amt=$info4["amt"];
                	$landing_cost=$info4["landing_cost"];
                	$total_landing_cost=$info4["total_landing_cost"];
                	$description=$info4["description"];
                	$tran_id=$info4["tran_id"];
                	$member_bill_support=$member_bill_support."#".$item_id."::".$item_qty."::".$item_qty_p."::".$item_rate."::".$amt."::".$landing_cost."::".$total_landing_cost."::".$description."::".$tran_id."::";
            }
            $member_bill=$member_bill.$member_bill_support;
            $k++;
        }
        
        
      $supplier = mysql_query("SELECT supplier_id, TRAN_DATE, TRAN_TIME, BILL_NO, slip_no, credit, debit,balance, TRAN_STATUS, employee, branch,note,tran_id,transaction_id,tran_type FROM supplier_transactions where supplier_id='".$info["supplier_id"]."' order by TRAN_DATE desc");
      while($supplier1 = mysql_fetch_array( $supplier ))
      {      	
      	$bank_id=0;
      	if($supplier1["tran_type"]=="BANK"){
      		
      			$data4 = mysql_query("SELECT bank_id FROM bank_transactions where tran_id='".$supplier1["transaction_id"]."'");
            while($info4 = mysql_fetch_array( $data4 ))
            {
            	$bank_id=$info4["bank_id"];
            }
      	}
      	$bank_tran=$bank_tran."//".$supplier1["TRAN_DATE"]."::".$supplier1["TRAN_TIME"]."::".$supplier1["debit"]."::".$supplier1["note"]."::".$supplier1["tran_id"]."::".$supplier1["transaction_id"]."::".$supplier1["tran_type"]."::".$supplier1["supplier_id"]."::".$bank_id."::";
      }
 }
 
 
 
 
 
 
 include_once 'connection/db1.php';

 $member_type=3;
 $session_id=1;
 	$session_branch=1;
$temp_data=explode("//", $supplier_data);
 
 $command = "SELECT MAX(sk_member_id) as maxid FROM mst_member";
$cNo=0;
$result = mysql_query($command, $con);
while ($row = mysql_fetch_assoc($result)){
	$cNo = $row['maxid'];
}

$cNo++;

 for($i=1;$i<sizeof($temp_data);$i++){
 	
 	$temp=explode("::", $temp_data[$i]);
 	$member_name=$temp[0];
 	$phone1=$temp[3];
 	$phone2=$temp[2];
 	$email=$temp[4];
 	$address=$temp[1];
 	$place=$temp[5];
 	$member_status=$temp[6];
 	$old_id=$temp[7];
 	$balance=$temp[8];
 	
 	
	$query ="INSERT INTO mst_member (sk_member_id, member_type, member_name, acc_no, ifsc, mobile, landline, email, address, place, state, profile_pic, login_name, login_password, login_status,employee_id, branch_id,old_refid)
	VALUES ('$cNo','$member_type','$member_name','','','$phone1','$phone2','$email','$address','$place','','','','','$member_status','$session_id','$session_branch','$old_id')";
	mysql_query($query);
	
	$log_id=0;$command = "SELECT MAX(sk_log_id) as maxid FROM txn_log";$result = mysql_query($command, $con);while ($row = mysql_fetch_assoc($result)){$log_id = $row['maxid'];}$log_id++;
	$query ="INSERT INTO txn_log (sk_log_id, tran_type, tran_desc,log_date, log_time, tran_id, transaction_id, tran_table, branch_id, employee_id)
	VALUES ('$log_id','Supplier','New Supplier Added','2016-04-01',now(),'$cNo','$cNo','mst_member','$session_branch','$session_id')";
	mysql_query($query);
	
	$command = "SELECT MAX(sk_tran_id) as maxid FROM txn_transaction";
	$tran_id=0;
	$result = mysql_query($command, $con);
	while ($row = mysql_fetch_assoc($result))
	{
		$tran_id = $row['maxid'];
	}$tran_id++;
	
	$query="INSERT INTO txn_transaction(sk_tran_id,tran_date,tran_time, credit, debit,member_id, transaction_ref_id, ref_table, tran_type, tran_desc, note,tran_status, employee_id, branch_id)
	VALUES ('$tran_id','2016-10-31',now(),'$balance','0','$cNo','0','mst_member','Supplier','Ledger Balance','Ledger Balance as of 31-03-2016','active','$session_id','$session_branch')";
	mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());

	$cNo++;

 }

 $temp_data=explode("//", $member_bill);
 for($i=1;$i<sizeof($temp_data);$i++){
 	
 	$bill_main=explode("::", $temp_data[$i]);
 	$bill_support=explode("#", $temp_data[$i]);

	$old_ref=$bill_main[0];
 	$bill_date=$bill_main[1];
 	$bill_amount=$bill_main[2];
 	$tax_rate=0;
 	$tax=0;
 	$tax_disc=0;
 	$tax_disc_amt=0;
 	$bill_tax_amount=0;
 	$transporter_id=0;
 	$transporter_rate=0;
 	$transport=$bill_main[4];
 	$other_expenses=$bill_main[3];
 	$hamali=$bill_main[9];
 	$actual_amt=$bill_amount+$other_expenses;
 	$total=$bill_main[7];
 	$cash_amount=0;
 	$check_amount=0;
 	$paid_amt=0;
 	$discount=0;
 	$balance=$bill_main[8];
 	$note="";
 	$bank_id=0;
 	$bill_status='active';
 	$measurement_slip_no=0;
 	$agent_id=0;
 	$agent_per=0;
 	$agent_amount=0;
 	$m_id=0;
 	
 	$sk_member_id=0;
	$data = mysql_query("SELECT sk_member_id,mobile,place FROM mst_member where old_refid='$old_ref' and member_type=3");
	while($info = mysql_fetch_array( $data ))
	{
	 $sk_member_id=$info["sk_member_id"];    
	 $mobile=$info["mobile"];   
	 $place=$info["place"];                          	
	}
 	
 	$command = "SELECT MAX(sk_bill_id) as maxid FROM mst_bill_main";
$bill_no=0;
$result = mysql_query($command, $con);
while ($row = mysql_fetch_assoc($result))
{
	$bill_no = $row['maxid'];
}$bill_no++;
	$query="INSERT INTO mst_bill_main(sk_bill_id, bill_date, bill_time, member_id, member_name, mobile, place, bill_for, bill_type, bill_amount, tax_rate, tax_amount, t_discount_rate, t_discount_amount, bill_tax_amount, transporter_id,transporter_rate, transport_amount, other_expenses,hamali, grand_total, cash_amount, check_amount, paid_amount, discount, balance_amount, note, bank_id, bill_status, measurement_slip_no,agent_id,agent_rate,agent_amount, employee_id, branch_id)
	VALUES ('$bill_no','$bill_date',now(),'$sk_member_id','','$mobile','$place','Supplier','Credit','$bill_amount','$tax_rate','$tax','$tax_disc','$tax_disc_amt','$actual_amt','$transporter_id','$transporter_rate','$transport','$other_expenses','$hamali','$total','$cash_amount','$check_amount','$paid_amt','$discount','$balance','$note','$bank_id','active','$m_id','$agent_id','$agent_per','$agent_amount','$session_id','$session_branch')";
	mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
	
	$command = "SELECT MAX(sk_tran_id) as maxid FROM txn_transaction";
	$sk_tran_id=0;$result = mysql_query($command, $con);while ($row = mysql_fetch_assoc($result)){$sk_tran_id = $row['maxid'];}$sk_tran_id++;
	

	$query="INSERT INTO txn_transaction(sk_tran_id,tran_date,tran_time, credit, debit,member_id, transaction_ref_id, ref_table, tran_type, tran_desc, note,tran_status, employee_id, branch_id)
VALUES ('$sk_tran_id','$bill_date',now(),'$actual_amt','0','$sk_member_id','$bill_no','mst_bill_main','Supplier','New Bill','Credit','active','$session_id','$session_branch')";
mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
	
	//$member_bill=$member_bill."#".$item_id."#".$item_qty."#".$item_qty_p."#".$item_rate."#".$amt."#".$landing_cost."#".$total_landing_cost."#";
	 for($j=1;$j<sizeof($bill_support);$j++){
	 	
	 	$b=explode("::", $bill_support[$j]);
		$flower=$b[0];$qty=$b[2];$aqty=$b[1];$cost=$b[3];
		$tcost=$b[4];$lcost=number_format($b[5], 2, '.', ' ');$tlcost=number_format($b[6], 2, '.', ' ');
		$description=$b[7];
	$tran_id=$b[8];
		$sk_particular_id=$flower;
		/*	$data1 = mysql_query("SELECT sk_particular_id FROM mst_particular where particular_name='$flower'");
            while($info1 = mysql_fetch_array( $data1 ))
            {
            	$sk_particular_id=$info1["sk_particular_id"];
				
            }
				if($sk_particular_id==0){
					$command = "SELECT MAX(sk_particular_id) as maxid FROM mst_particular";
$cNo=0;
$result = mysql_query($command, $con);
while ($row = mysql_fetch_assoc($result)){
	$sk_particular_id = $row['maxid'];
}

$sk_particular_id++;
					$query ="INSERT INTO mst_particular (sk_particular_id, particular_name, particular_desc, category_id, sub_category_id, particular_status, branch_id)
				VALUES ('$sk_particular_id','$flower','$description','1','0','active','$session_branch')";
				mysql_query($query);
				}
		$command = "SELECT MAX(sk_tran_id) as maxid FROM txn_bill_support";
		$tran_id=0;
		$result = mysql_query($command, $con);
		while ($row = mysql_fetch_assoc($result))
		{
			$tran_id = $row['maxid'];
		}
		$tran_id++;*/
		
	 	$query="INSERT INTO txn_bill_support(sk_tran_id, bill_id, bill_for, bill_type, bill_date, particular_id,description, qty_in_piece, qty_in_sft, rate, amount,landing_cost, bill_status, employee_id, branch_id)
				VALUES ('$tran_id','$bill_no','Supplier','Credit','$bill_date','$sk_particular_id','$description','$qty','$aqty','$cost','$tcost','$lcost','active','$session_id','$session_branch')";
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
	$data = mysql_query("SELECT sk_member_id,mobile,place FROM mst_member where old_refid='$old_ref'");
	while($info = mysql_fetch_array( $data ))
	{
	 $sk_member_id=$info["sk_member_id"];    
	 $mobile=$info["mobile"];   
	 $place=$info["place"];                          	
	}
 		
 	$command = "SELECT MAX(sk_tran_id) as maxid FROM txn_transaction";
	$sk_tran_id=0;$result = mysql_query($command, $con);while ($row = mysql_fetch_assoc($result)){$sk_tran_id = $row['maxid'];}$sk_tran_id++;
 	if($debit>0)
 		if($tran_type=="BANK"){
 			
 			$query="INSERT INTO txn_transaction(sk_tran_id,tran_date,tran_time, credit, debit,member_id, transaction_ref_id, ref_table, tran_type, tran_desc, note,tran_status, employee_id, branch_id)
		VALUES ('$sk_tran_id','$tran_date','$time','0','$debit','$sk_member_id','$transaction_id','mst_member','Supplier','Bank Payment','$note','active','$session_id','$session_branch')";
		mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
		$t=$sk_tran_id+1;
		//echo $query;
		$query="INSERT INTO txn_transaction(sk_tran_id,tran_date,tran_time, credit, debit,member_id, transaction_ref_id, ref_table, tran_type, tran_desc, note,tran_status, employee_id, branch_id)
	VALUES ('$t','$tran_date',now(),'0','$debit','$bank_id ','$sk_tran_id','mst_member','Bank','Supplier Withdraw','$note','active','$session_id','$session_branch')";
	mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
		
 		}else{
 		$query="INSERT INTO txn_transaction(sk_tran_id,tran_date,tran_time, credit, debit,member_id, transaction_ref_id, ref_table, tran_type, tran_desc, note,tran_status, employee_id, branch_id)
		VALUES ('$sk_tran_id','$tran_date','$time','0','$debit','$sk_member_id','0','mst_member','Supplier','Payment','$note','active','$session_id','$session_branch')";
		mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
 		}
 	}
 
 
 