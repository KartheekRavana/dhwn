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

if($other_expenses==""){$other_expenses=0;}
	$total=$_POST["total"];
	$slip_no=$_POST['slip_no'];
	$paid_amt=$_POST['paid_amt'];
	$note=$_POST['note'];
	$tax=$_POST['tax'];
	$transport=$_POST['transport'];
	if($transport==""){$transport=0;}
$transporter="0";
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

//if($bill_type=="Credit")
{
	

	

	{

	
		$command = "SELECT MAX(sk_bill_id) as maxid FROM mst_bill_main";
$bill_no=0;
$result = mysql_query($command, $con);
while ($row = mysql_fetch_assoc($result))
{
	$bill_no = $row['maxid'];
}$bill_no++;
		
$query="INSERT INTO mst_bill_main(sk_bill_id, bill_date, bill_time, member_id, member_name, mobile, place, bill_for, bill_type, bill_amount, tax_rate, tax_amount, t_discount_rate, t_discount_amount, bill_tax_amount, transporter_id,transporter_rate, transport_amount, other_expenses, grand_total, cash_amount, check_amount, paid_amount, discount, balance_amount, note, bank_id, bill_status, measurement_slip_no,agent_id,agent_rate,agent_amount, employee_id, branch_id,slip_no)
VALUES ('$bill_no','$bill_date',now(),'$c_id','$customer_name','$mobile','$place','Customer','$bill_type Return','$grand_total','0','0','0','0','$grand_total','0','$transporter','$transport','$other_expenses','$total','$cash_amount','$check_amount','$paid_amt','$discount','$balance','$note','$bank_id','active','0','0','0','0','$session_id','$session_branch','0')";
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
				
				$command = "SELECT MAX(sk_tran_id) as tran_id FROM txn_bill_support";
				$tran_id=0;
				$result = mysql_query($command, $con);
				while ($row = mysql_fetch_assoc($result))
				{
					$tran_id = $row['tran_id'];
				}$tran_id++;
				
				$query="INSERT INTO txn_bill_support(sk_tran_id, bill_id, bill_for, bill_type, bill_date, particular_id,description, qty_in_piece, qty_in_sft, rate, amount, bill_status, employee_id, branch_id)
				VALUES ('$tran_id','$bill_no','Customer','$bill_type Return','$bill_date','$flower','$desc','$qty','$aqty','$cost','$tcost','active','$session_id','$session_branch')";
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

$total_debit=$total;
if($c_id>0){$total=0;}


$query="INSERT INTO txn_transaction(sk_tran_id,tran_date,tran_time, credit, debit,member_id, transaction_ref_id, ref_table, tran_type, tran_desc, note,tran_status, employee_id, branch_id)
VALUES ('$tran_id','$bill_date',now(),'$total','$total_debit','$c_id','$bill_no','mst_bill_main','Customer','Return Bill','$bill_type','active','$session_id','$session_branch')";
mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
		


	
	
	}
	
}




?>
<div style='width:330px;margin-left:200px;font-size: 12px'>

	      <?php 
                            $b_no=$bill_no;
                           
                            ?>
                    <div class="span2">
 					    
                        <!-- ==================== SPAN3 HEADLINE ==================== -->
                      
                   
                        <!-- ==================== END OF SPAN3 HEADLINE ==================== -->

                        <!-- ==================== SPAN3 FLOATING BOX ==================== -->
                     
                
                        <div class="floatingBox"> 
                        <div class="container-fluid">                     
                     <script type="text/javascript" src="js/intent-loan.js"></script>             
                
	    
	              <?php 
	         
	          $data = mysql_query("SELECT `sk_bill_id`, `bill_date`, `bill_time`, `member_id`, `member_name`, `mobile`, `place`, `bill_for`, `bill_type`, `bill_amount`, `tax_rate`, `tax_amount`, `t_discount_rate`, `t_discount_amount`, `bill_tax_amount`, `transporter_id`, `transporter_rate`, `transport_amount`, `other_expenses`, `hamali_id`, `hamali`, `grand_total`, `cash_amount`, `check_amount`, `paid_amount`, `discount`, `balance_amount`, `note`, `bank_id`, `bill_status`, `measurement_slip_no`, `agent_id`, `agent_rate`, `agent_amount`, `employee_id`, `branch_id` FROM mst_bill_main where sk_bill_id='".$b_no."'");
	          while($info = mysql_fetch_array( $data ))
	          {
	          		$note=$info["note"];
	          	if($info["member_id"]==0){$c=$info["member_name"];}
	          	else{
	          		
$data1 = mysql_query("SELECT member_name FROM mst_member where sk_member_id='".$info["member_id"]."'");
while($info1 = mysql_fetch_array( $data1 ))
{
	$c=$info1["member_name"];
}

	          	}
	          ?>
	            <input type='hidden' id='bill_no' name='bill_no' value='<?php echo $info['bill_no']?>'>
	           <center><h3>RETURN</h3></center>
	           <table>
	           <tr><td>Name </td><td colspan="4"> : <?php echo $c?></td></tr>	           
	           <tr><td>Place </td><td> : <?php echo $info["place"]?></td><td>&nbsp;&nbsp;&nbsp;</td><td>Date</td><td> : <?php $tdate=explode("-", $info["bill_date"]);echo $tdate[2]."-".$tdate[1]."-".$tdate[0] ?></td></tr>
	           <tr><td>Mobile </td><td> : <?php echo $info["mobile"]?></td><td>&nbsp;&nbsp;&nbsp;</td><td>Ref No</td><td> : <?php echo $b_no ?></td></tr>
	           <tr></tr>
                  </table>             
		 
	           <?php }?>
	          
		</div>
		</div>
                          
               </div>
               
               <div class="span5">
 					        
                        <!-- ==================== SPAN3 HEADLINE ==================== -->
                      
                   
                        <!-- ==================== END OF SPAN3 HEADLINE ==================== -->

                        <!-- ==================== SPAN3 FLOATING BOX ==================== -->
                     
                 
                        <div class="floatingBox"> 
                        <div class="container-fluid">                     
                   
	           <table border=1 cellpadding='0' cellspacing=0 style="width: 100%;font-size: 13px">
	           <tr><th>ITEMS</th><th>QTY</th><th>COST</th><th>TOTAL</th></tr>
	           
	           <?php 
	           $i=1;
	           $data = mysql_query("SELECT `sk_tran_id`, `bill_id`, `bill_for`, `bill_type`,description,note, `bill_date`, `particular_id`, `qty_in_piece`, `qty_in_sft`, `rate`, `amount`, `landing_cost`, `bill_status`, `employee_id`, `branch_id` FROM txn_bill_support where bill_id='".$b_no."'");
	           while($info = mysql_fetch_array( $data ))
	           {
	           	
	           $item_name="";
	           $data1 = mysql_query("SELECT item_name,thickness, length, breadth FROM items where item_id='".$info["particular_id"]."'");
	           	while($info1 = mysql_fetch_array( $data1 ))
	           	{
	           		$item_name=$info1["item_name"];
	           	}
	           	$note="";
	           	if($info["note"]!=""){
	           		$note=" - ".$info["note"];	
	           	}

	           ?>
	           <tr>
	           		<td style="font-size: 13px">
	           		<?php echo $item_name?> <span style="text-transform: lowercase;">(<?php echo $info["description"]?>)</span>
	           		</td>	           		
	           		<td style="text-align: center;"><?php echo number_format($info["qty_in_sft"], 2, '.', '')?></td>
	           		<td style="text-align: right;"><?php echo number_format($info["rate"], 2, '.', '')?></td>
	           		<td style="text-align: right"><?php echo number_format($info["amount"], 2, '.', '')?></td>
	           </tr>
	           <?php $i++;}?>
	         
	          
	          <?php 
	          $data = mysql_query("SELECT  `bill_amount`, `tax_rate`, `tax_amount`, `t_discount_rate`, `t_discount_amount`, `bill_tax_amount`, `transporter_id`, `transporter_rate`, `transport_amount`, `other_expenses`, `hamali_id`, `hamali`, `grand_total`, `cash_amount`, `check_amount`, `paid_amount`, `discount`, `balance_amount`, `note`, `bank_id`, `bill_status`, `measurement_slip_no`, `agent_id`, `agent_rate`, `agent_amount`, `employee_id`, `branch_id` FROM mst_bill_main where sk_bill_id='".$b_no."'");
	          while($info = mysql_fetch_array( $data ))
	          {$tax_rate=$info["tax_rate"];
                	$tax_discount_rate=$info["t_discount_rate"];
                	$tax_discount=$info["t_discount_amount"];
                	$transporter_id=$info["transporter_id"];
                	$total_amt=$info["grand_total"];
	          ?>
	         
	             <tr><td colspan="2"></td><td>Total&nbsp;Amt</td><td style="text-align: right"><?php echo $info["bill_amount"]?></td></tr>
	           
	             <tr><td colspan="2"></td><td>Discount</td><td style="text-align: right"><?php echo $info["discount"]?></td></tr>
 <tr><td colspan="2"></td><td>Grand Total</td><td style="text-align: right"><?php echo $info["bill_amount"]-$info["discount"]?></td></tr>
	           </table>	           
	          
	      
	        
 <?php }?>
 </div>
 
<script>
self.print();
setTimeout(function() { 
//	window.location="index.php?action=statement&c=customer&c_id="+sup_id;
window.location="index.php?action=return_new&c=stock";
//window.location="?action=new&c=stock;
	}, 1000);

</script>
