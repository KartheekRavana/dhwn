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
	
	$cash_amount=$_POST["cash_amount"];
	$check_amount=$_POST["check_amount"];
	$discount=$_POST["discount"];
	$balance=$_POST['balance'];
	$advance=$_POST["advance_amount"];
	$bank_id=$_POST["bank"];
	$check_no=$_POST["check_no"];
	
	$login=$session_id;
	$branch=$session_branch;

$p_name=0;

if($bill_type=="Credit")
{
	
	if($customer_name!="" && $c_id=="")
	{
	
		$command = "SELECT MAX(customer_id) as maxid FROM customer";
		$cNo=0;
		$result = mysql_query($command, $con);
		while ($row = mysql_fetch_assoc($result)){
			$cNo = $row['maxid'];
	
		}
		$cNo++;
		//$date=curdate();
	
		$sNo=$cNo+1000;
		$query ="INSERT INTO customer (customer_id,customer_no,customer_name,city,phone,mobile,balance,branch,customer_status)
		VALUES ($cNo,'$sNo','$customer_name','$place','','$mobile','0','$session_branch','active')";
		mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
		echo $query;
	
		$customer_name="";
		$c_id=$cNo;
	}
	
	
	if($customer_name=="" && $c_id!="")
	{
		$command = "SELECT MAX(bill_no) as maxid FROM customerbillmain";
		$bill_no=0;
		$result = mysql_query($command, $con);
		while ($row = mysql_fetch_assoc($result))
		{
			$bill_no = $row['maxid'];
		}$bill_no++;
	
		$query="INSERT INTO customerbillmain(bill_no,customer_id,bill_date,total,comm,lug_exp,prev_bal,total_bal,amount_paid,final_bal,login_id,branch,customer_name,partner_id,check_payment,cashe_payment,discount,phone,city,tax,transport,customer_bill_no,payment_status)
		VALUES ('$bill_no','$c_id','$bill_date','".$grand_total."','0','".$other_expenses."','$advance','$total','$paid_amt','$balance','$session_id','$session_branch','$customer_name','0','$check_amount','$cash_amount','$discount','$mobile','$place','$tax','$transport','$bill_no_customer','$payment_status')";
		mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
	if($advance>0)
	{
		$bid=$_POST["b_id"];
		$query1="update customerbillmainadvance set bill_status='Billed' where bill_no='$bid'";
		mysql_query($query1) or die('Query "' . $query1 . '" failed: ' . mysql_error());
	}
		
		
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
				
				$command = "SELECT MAX(tran_id) as tran_id FROM customerbill";
				$tran_id=0;
				$result = mysql_query($command, $con);
				while ($row = mysql_fetch_assoc($result))
				{
					$tran_id = $row['tran_id'];
				}$tran_id++;
				
				$query="INSERT INTO customerbill(tran_id,bill_no,item_date,item_name,item_qty,item_qty_p,item_rate,amt,description,barcode,item_id,item_tran_id,discount,note)
				VALUES ('$tran_id','$bill_no','$bill_date','$flower','$aqty','$qty','$cost','$tcost','$desc','$barcode','$item_id','$item_tran_id','$discount','$note')";
				mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
				
			}
		}
		$total=$total-$discount;
		$bal=$total-$paid_amt;
		$query="INSERT INTO customer_transactions(CUSTOMER_ID, TRAN_DATE, TRAN_TIME, BILL_NO, slip_no, credit, debit,balance, TRAN_STATUS, employee, branch,note,customer_name,tran_type,transaction_id)
		VALUES ('$c_id','".$bill_date."',now(),'".$bill_no."','$slip_no','".$total."','$paid_amt','$bal','active','$session_id','$session_branch','$note_tran','$customer_name','CREDIT BILL','$bill_no')";
		mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
	
		if($paid_amt>0)
		{
	
			if($check_amount!=0)
			{
				$bank_bal='';
				$data1 = mysql_query("SELECT balance from banks where bank_id='$bank_id'");
				while($info = mysql_fetch_array( $data1 ))
				{
					$bank_bal=$info['balance'];
				}$bank_bal=$check_amount+$bank_bal;
				$query="INSERT INTO bank_transactions(bank_ID, TRAN_DATE, TRAN_TIME, cheque_no, slip_no, credit, debit,balance, TRAN_STATUS, employee, branch,tran_type,transaction_id)
				VALUES ('$bank_id','".$bill_date."',now(),'$check_no','$slip_no','$check_amount','0','$bank_bal','active','$session_id','$session_branch','CUSTOMER','$bill_no')";
				mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
	
				$query ="update banks set balance=balance+$check_amount where bank_id='$bank_id'";
				mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
			}
	
	
		}
	
		$query ="update customer set balance=balance+$bal where customer_id='$c_id'";
		mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
	
	}
	
}
else
{
	if($customer_name!="" && $c_id=="")
	{
		$command = "SELECT MAX(bill_no) as maxid FROM customerbillmain";
		$bill_no=0;
		$result = mysql_query($command, $con);
		while ($row = mysql_fetch_assoc($result))
		{
			$bill_no = $row['maxid'];
		}$bill_no++;
	
		$query="INSERT INTO customerbillmain(bill_no,customer_id,bill_date,total,comm,lug_exp,prev_bal,total_bal,amount_paid,final_bal,login_id,branch,customer_name,partner_id,check_payment,cashe_payment,discount,phone,city,tax,transport,customer_bill_no,payment_status)
		VALUES ('$bill_no','0','$bill_date','".$grand_total."','0','".$other_expenses."','0','$total','$paid_amt','$balance','$session_id','$session_branch','$customer_name','0','$check_amount','$cash_amount','$discount','$mobile','$place','$tax','$transport','$bill_no_customer','$payment_status')";
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
				
				$command = "SELECT MAX(tran_id) as tran_id FROM customerbill";
				$tran_id=0;
				$result = mysql_query($command, $con);
				while ($row = mysql_fetch_assoc($result))
				{
					$tran_id = $row['tran_id'];
				}$tran_id++;
				
				$query="INSERT INTO customerbill(tran_id,bill_no,item_date,item_name,item_qty,item_qty_p,item_rate,amt,description,barcode,item_id,item_tran_id,discount,note)
				VALUES ('$tran_id','$bill_no','$bill_date','$flower','$aqty','$qty','$cost','$tcost','$desc','$barcode','$item_id','$item_tran_id','$discount','$note')";
				mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
				
				
				
					
			}
		}
		if($payment_status=="Done")
		{
			$bal=$total-$paid_amt;
			$query="INSERT INTO customer_transactions(CUSTOMER_ID, TRAN_DATE, TRAN_TIME, BILL_NO, slip_no, credit, debit,balance, TRAN_STATUS, employee, branch,note,customer_name,tran_type,transaction_id)
		VALUES ('0','".$bill_date."',now(),'".$bill_no."','$slip_no','".$total."','$paid_amt','$bal','active','$session_id','$session_branch','$note_tran','$customer_name','CASH BILL','$bill_no')";
			mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
	
			if($check_amount!=0)
			{
				$bank_bal='';
				$data1 = mysql_query("SELECT balance from banks where bank_id='$bank_id'");
				while($info = mysql_fetch_array( $data1 ))
				{
					$bank_bal=$info['balance'];
				}$bank_bal=$check_amount+$bank_bal;
				$query="INSERT INTO bank_transactions(bank_ID, TRAN_DATE, TRAN_TIME, cheque_no, slip_no, credit, debit,balance, TRAN_STATUS, employee, branch,tran_type,transaction_id)
				VALUES ('$bank_id','".$bill_date."',now(),'$check_no','$slip_no','$check_amount','0','$bank_bal','active','$session_id','$session_branch','CUSTOMER','$bill_no')";
				mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
					
				$query ="update banks set balance=balance+$check_amount where bank_id='$bank_id'";
				mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
			}
	
	
		}
	}
}



?>
<div style='width:330px;margin-left:200px;font-size: 12px'>
 <?php 
	          $data = mysql_query("SELECT bill_no, customer_id, bill_date, total, comm, lug_exp, prev_bal, total_bal, amount_paid, final_bal, login_id, branch, customer_name, partner_id, check_payment, cashe_payment, discount, phone, city, tax, transport FROM customerbillmain where bill_no='".$bill_no."'");
	          while($info = mysql_fetch_array( $data ))
	          {
	          	if($info["customer_id"]==0){$c=$info["customer_name"];}
	          	else{
	          		
$data1 = mysql_query("SELECT customer_name FROM customer where customer_id='".$info["customer_id"]."'");
while($info1 = mysql_fetch_array( $data1 ))
{
	$c=$info1["customer_name"];
}

	          	}
	          ?>
	            <input type='hidden' id='bill_no' name='bill_no' value='<?php echo $info['bill_no']?>'>
	           
	           <table style="width: 100%;font-size:12px">
	           <tr><td rowspan="2">Buyer&nbsp;Name : <?php echo $c?><br/>Place : <?php echo $info["city"]?><br/>Mobile : <?php echo $info["phone"]?></td><td colspan="2">Ref No : <?php echo $info['bill_no']?><br/>Date : <?php echo $_SESSION['date1'];?></td></tr>	           
	           
	           <tr></tr>
                  </table>             
		 
	           <?php }?>
	          <hr width="100%" color="black">
<table cellspacing=0 cellpadding=0 border="#000" style="width: 100%;font-size: 12px">
	           <tr><th>Particulars&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th><th>Qty</th><th>Rate</th><th>Amount</th></tr>
	           
	           <?php 
	           $i=1;
	           $data = mysql_query("SELECT bill_no, item_date, item_name,description, item_qty, item_rate, amt, item_qty_p,tran_id,note FROM customerbill where bill_no='".$bill_no."'");
	           while($info = mysql_fetch_array( $data ))
	           {
	           	$item_name="";
	           	$thickness="";
	           	$size="";
	           	$data1 = mysql_query("SELECT item_name,thickness, length, breadth FROM items where item_id='".$info["item_name"]."'");
	           	while($info1 = mysql_fetch_array( $data1 ))
	           	{
	           		$item_name=$info1["item_name"];
	           	if($info1["thickness"]!=0)
	           		{
	           		$thickness=$info1["thickness"]."mm";
	           		$size="(".$info1["length"]."*".$info1["breadth"].")";
	           		}
	           	}
	           	
	           	if($info["item_name"]=="3")
	           	{
	           		$qty=$info["item_qty"];
	           	}
	           	else {
					$qty=$info["item_qty"];
				}
				
				$qty=$info["item_qty"];
				if($item_name=="PLYWOOD")
				{
					$qty=$info["item_qty"]." Sft(".$info["item_qty_p"]." Pcs)";
				}
				
				$item_name=$info["description"];
				$note=$info["note"];
	           	if($note!=""){$note="(".$note.")";}
	           ?>
	           <tr style="border-bottom-color: white;border-top-color: white" >
	           		<td style="border-bottom : 0;border-top: 0"><?php echo $item_name?> <?php echo $note?></td>
	           		<td style="border-bottom : 0;border-top: 0;text-align: center;"><?php echo $qty?></td>
	           		<td style="border-bottom : 0;border-top: 0;text-align: center;"><?php echo $info["item_rate"]?></td>
	           		<td style="text-align: right;border-bottom : 0;border-top: 0;text-align: right;"><?php echo $info["amt"]?></td>
	           </tr>
	           <?php $i++;}
	           for($j=$i;$j<20;$j++)
	           {
	           ?>
	         <tr style="border-bottom-color: white;border-top-color: white"><td style="border-bottom : 0;border-top: 0">&nbsp;</td><td style="border-bottom : 0;border-top: 0"></td><td style="border-bottom : 0;border-top: 0"></td><td style="border-bottom : 0;border-top: 0"></td></tr>
	          <?php }?>
	          <?php 
	          $data = mysql_query("SELECT bill_no, customer_id, bill_date, total, comm, lug_exp, prev_bal, total_bal, amount_paid, final_bal, login_id, branch, customer_name, partner_id, check_payment, cashe_payment, discount, phone, city, tax, transport FROM customerbillmain where bill_no='".$bill_no."'");
	          while($info = mysql_fetch_array( $data ))
	          {
	          ?>
	         
	               <tr><td colspan="3" style="text-align: right;">Total&nbsp;</td><td style="text-align: right"><?php echo $info["total"]?></td></tr>
	               <tr><td colspan="3" style="text-align: right;">Discount&nbsp;</td><td style="text-align: right"><?php echo $info["discount"]?></td></tr>
	               <tr><td colspan="3" style="text-align: right;">G Total&nbsp;</td><td style="text-align: right"><?php echo $info["total"]-$info["discount"]?></td></tr>
	            
	           </table>	 
	        
 <?php }?>
 </div>
 
<script>
self.print();
window.location="index.php?action=new&c=stock";
</script>