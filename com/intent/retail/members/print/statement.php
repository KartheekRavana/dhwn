<?php include_once "$D_PATH/include/session.php";?>
<!DOCTYPE html>
<html>
<head>
  
          <section class="content">
          
          <form role="form" onsubmit="return validate()" action="index.php?action=operations/in_save&c=stock" method="POST">
          <input type='hidden' id='data' name='data'>
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary" style="overflow: auto;">
               
                <!-- form start -->
                <br/>
                <?php $member_filter="";
                $customerid=$_GET["cid"];
                $data1 = mysql_query("SELECT member_name,place,mobile,landline,email,member_type FROM mst_member where sk_member_id='$customerid'");
                while($info1 = mysql_fetch_array( $data1 ))
                {
                	$customer_name=$info1["member_name"];
                	$mobile=$info1["mobile"];
                	$phone=$info1["landline"];
                	$place=$info1["place"];
                	$email=$info1["email"];
                	$member_type=$info1["member_type"];
                }
                
                $balance=0;
                $supplier = mysql_query("SELECT credit, debit,transaction_ref_id,tran_desc FROM txn_transaction where member_id='".$customerid."' and tran_status='active'");
                while($supplier1 = mysql_fetch_array( $supplier ))
                {
                	if($supplier1['credit']!=0 || $supplier1['debit']!=0)
                	{
                		$discount=0;
                   		if($supplier1["tran_desc"]=='New Bill'){
                  $data1 = mysql_query("SELECT discount FROM mst_bill_main where sk_bill_id='".$supplier1["transaction_ref_id"]."'");
                  while($info1 = mysql_fetch_array( $data1 ))
                  {
                  	$discount=$info1[0];
                  }
                   		}
                		$balance=$balance+($supplier1['credit']);
                		$balance=$balance-$supplier1['debit'];
                		$balance=$balance-$discount;
                		$balance=number_format((float)$balance, 0, '.', '');
                	}
                }
                ?>
                <input type="hidden" id="customer_id" value="<?php echo $_GET["c_id"]?>">
                <table>
                <tr>
                	<td>Member Name</td><td><?php echo $customer_name?></td><td>&nbsp;&nbsp;</td>
                	<td>Phone</td><td><?php echo $mobile?>,<?php echo $phone?></td><td>&nbsp;&nbsp;</td>                	
           			<td>Place</td><td><?php echo $place?></td><td>&nbsp;&nbsp;</td>
                	<td>Balance</td><td><?php echo $balance?></td><td>&nbsp;&nbsp;</td>
                	 
                </tr>
                </table><br/>
                </div>
                </div>
                
                <?php if($member_type!=8 && $member_type!=7 && $member_type!=1 && $member_type!=9 && $member_type!=10 && $member_type!=11){?>
                 <div class="col-md-5" style="float: left">
             
<?php if($_GET["op"]=="printbill" || $_GET["op"]=="printall" || $_GET["op"]=="emailbill" || $_GET["op"]=="emailall"){?>
            
                  <h3 class="box-title">Bills</h3>
                 
             
                
                 <table id="" class="table table-bordered table-striped" style="font-size: 12px;" border=1 cellspacing=0 cellpadding=0>
                 
                    <thead>
                       <tr><th>S&nbsp;NO</th><th>BILL&nbsp;DATE</th><th>BILL AMT</th><th>AMOUNT</th>
                       <?php if($member_type==5){?><th>COMISSION</th><?php }?>
                       <?php if($member_type==4){?><th>TRANSPORT</th><?php }?>
                      
                    </thead>
                    <tbody>
                    <?php 
	            $data="";$total=0;$q="";
	           if($member_type=="2"){$q=" and member_id='$customerid'";$page_="sales";}
	           if($member_type=="3"){$q=" and member_id='$customerid'";$page_="purchase"; $member_filter="  and tran_type='Supplier' ";}
	           if($member_type=="4"){$q=" and transporter_id='$customerid'";}
	           if($member_type=="5"){$q=" and agent_id='$customerid'";$page_="sales";}
                  $data = mysql_query("SELECT sk_bill_id, bill_date, bill_time, member_id, member_name, mobile, place, transporter_rate,bill_for, bill_type, bill_amount, tax_rate, tax_amount, t_discount_rate, t_discount_amount, bill_tax_amount, transporter_id, transport_amount, other_expenses, grand_total, cash_amount, check_amount, paid_amount, discount, balance_amount, note, bank_id, bill_status, measurement_slip_no, agent_id, agent_rate, agent_amount, employee_id, branch_id FROM mst_bill_main where bill_status='active' $q order by bill_date desc");
                  while($info = mysql_fetch_array( $data ))
                  {$page_ext="";
                  	$c_name="";$b_name="";
                  	$c_id=$info['member_id'];
                  	$b_id=$info['branch_id'];
                  	$total=$total+$info['grand_total'];
                  	
                  	$bill_type=$info["bill_type"];
                  		if($bill_type=="Credit Ret" || $bill_type=='Cash Ret'){$page_ext="_return";}
	           ?>
	           <tr>
	         
	           <td><?php echo $info["measurement_slip_no"]?></td>
	           <td><?php $t_date=explode("-", $info["bill_date"]) ;echo $t_date[2]."-".$t_date[1]."-".$t_date[0]?></td>
	           	<td><?php echo number_format($info['bill_amount'], 2, '.', '')?></td>
	           		<td><?php echo number_format($info['grand_total']-$info["discount"], 2, '.', '')?></td>
	           	<?php if($member_type==5){?><th><?php echo $info["agent_amount"]?>(<?php echo $info["agent_rate"]?>)</th><?php }?>
                       <?php if($member_type==4){?><th><?php echo $info["transport_amount"]?></th><?php }?>
	           		 
	           		 
	           </tr>
	           
	           <?php 
                  	/*}*/
	           }?>
	          
                    
                    </tbody>
                      <tr><td></td><td></td><td></td><td><?php echo number_format($total, 2, '.', '')?></td></tr>
                      
                    </table>
                    
                    <?php if($_GET["op"]=="printbill" || $_GET["op"]=="printall"){?>
                    <script type="text/javascript">
window.print();

</script>
                  <?php }?>  
                    
                    
                    
                    <?php if($_GET["op"]=="emailbill" || $_GET["op"]=="emailall"){

                     mysql_query("update customer set email='".$_GET["c_email"]."' where customer_id='$customerid'");
       
// declare our variables
 $name = "DHARANI GRANITES";
 $email = "dmgindia08@gmail.com";
 $message = nl2br($message);
 
 // set a title for the message
 $subject = "Message from Dharani Granites";
 $body = "From $name, \n\n$message";
 $headers = 'From: '.$email.'' . "\r\n" .
 		'Reply-To: '.$email.'' . "\r\n" .
 		'Content-type: text/html; charset=utf-8' . "\r\n" .
 		'X-Mailer: PHP/' . phpversion();
 
 // put your email address here
 mail($_GET["c_email"], $subject, $body, $headers);
 }
                    
                    ?>
                    
                    <?php }?>
                
                
               
          </div>   <!-- /.row -->
          <?php }?>
          <?php if($_GET["op"]=="printstatement" || $_GET["op"]=="printall" || $_GET["op"]=="emailstatement" || $_GET["op"]=="emailall"){?>
           <div class="col-md-5" style="float: left;margin-left: 10px">
                  <h3 class="box-title">Statement</h3>
             
                    <table id="" class="table table-bordered table-striped" border=1 cellspacing=0 cellpadding=0>
                 
                    <thead>
                       <tr>                       
	                      
                                      <th>TRAN DATE</th>
                                      <th>PERTICULAR</th>                             
                                      <th>CREDIT</th>                                   
                                      <th>DEBIT</th>               
                                      <th>BALANCE</th>
                                      <th>NOTE</th>
                                    
                       </tr>
                    </thead>
                    <tbody>
                    <?php   
                   
                   if(!isset($_GET["from_date"])){
                   
                   $balance=0;
                   $array_count=0;
                   $array = array();
                   $supplier = mysql_query("SELECT credit, debit,tran_desc,transaction_ref_id,tran_type FROM txn_transaction where member_id='".$customerid."' $member_filter and tran_status='active' order by tran_date asc");
                   while($supplier1 = mysql_fetch_array( $supplier ))
                   {
                   	if($supplier1['credit']!=0 || $supplier1['debit']!=0)
                   	{
                   	$discount=0;
                   		if($supplier1["tran_desc"]=='New Bill' && $supplier1["tran_type"]!='Agent'){
                  $data1 = mysql_query("SELECT discount FROM mst_bill_main where sk_bill_id='".$supplier1["transaction_ref_id"]."'");
                  while($info1 = mysql_fetch_array( $data1 ))
                  {
                  	$discount=$info1[0];
                  }
                   		}
                   		$balance=$balance+($supplier1['credit']);
                   		$balance=$balance-$supplier1['debit'];
                   		$balance=$balance-$discount;
                   		$balance=number_format((float)$balance, 0, '.', '');
                   		array_push($array, $balance);
                   		 
                   		$array_count++;
                   	}
                   }
                   
                   $supplier_c=1;
                                  $c=$array_count;
                                  $supplier_bt=0;
                                  $BAL=0;
                                  
                   $data = mysql_query("SELECT credit, debit,tran_type,tran_desc,tran_date,note,transaction_ref_id FROM txn_transaction where member_id='".$customerid."' $member_filter and tran_status='active' order by tran_date asc");               
                   while($info = mysql_fetch_array( $data ))
                   {
                   	
                   	$note=$info["note"];
                   	if($info['credit']!=0 || $info['debit']!=0)
                   	{
                   		$discount=0;
                   		if($info["tran_desc"]=='New Bill' && $info["tran_type"]!='Agent'){
                  $data1 = mysql_query("SELECT discount,note,slip_no,sk_bill_id FROM mst_bill_main where sk_bill_id='".$info["transaction_ref_id"]."'");
                  while($info1 = mysql_fetch_array( $data1 ))
                  {
                  	$discount=$info1[0];
                  	$note=$info1[1];
                  	$note=$note." (SlipNo : ".$info1[2].")";
                  	$sk_bill_id=$info1[3];
                  }
                   		}
                   	if($info["tran_desc"]=='Return Bill'){
                  $data1 = mysql_query("SELECT discount,note,slip_no,sk_bill_id FROM mst_bill_main where sk_bill_id='".$info["transaction_ref_id"]."'");
                  while($info1 = mysql_fetch_array( $data1 ))
                  {
                  	$discount=$info1[0];
                  	$note=$info1[1];
                  	$note=$note." (SlipNo : ".$info1[2].")";
                  	$sk_bill_id=$info1[3];
                  }
                   		}
                   	$c--;
                   	$PERTICULAR=$info["tran_desc"];
                   	
                   		$supplier_name="";
                   	if($member_type==12){
                   		$transaction_ref_id=$info["transaction_ref_id"];
                   	$supplier_id=0;
		                	$data1 = mysql_query("SELECT member_id FROM mst_bill_main where sk_bill_id='$transaction_ref_id'");
	                	while($info1 = mysql_fetch_array( $data1 ))
	                	{   
	                	$supplier_id=$info1["member_id"];
	                	}
	                	$supplier_name="";
	                	$data1 = mysql_query("SELECT member_name FROM mst_member where sk_member_id='$supplier_id'");
		                	while($info1 = mysql_fetch_array( $data1 ))
		                	{
		                		$supplier_name="(".$info1["member_name"].")";
		                	}
		                		
                   	}
                   	
                                  	?>
                                    <tr>          
                                     <td><?php if($member_type==12){?><a href='?action=purchase_edit&c=inventory&bill_no=<?php echo $info["transaction_ref_id"]?>'><?php } $t_date=explode("-", $info["tran_date"]) ;echo $t_date[2]."-".$t_date[1]."-".$t_date[0]?></a></td> 
                                      <td><?php echo $PERTICULAR?> <?php echo $supplier_name?></td>
                                      <td><?php if($member_type==4){echo number_format($info["credit"], 2, '.', '');}else{ echo number_format($info["credit"]-$discount, 2, '.', '');}?></td>
                                       <td><?php echo number_format($info["debit"], 2, '.', '')?></td>
                                       <td><?php echo $array[$c]?></td>
                                    <td><?php echo $note?>
                                    
                                    
                                    </td>
                                    <td></td> </tr>
									<?php 
                   	}}}else{?>
                   	
                   	
                   	 <?php   
                   
                 $member_filter="";
                   
                  $ledger=0;
                   $array_count=0;
                   $array = array();
                   $supplier = mysql_query("SELECT credit, debit,tran_desc,transaction_ref_id,tran_type FROM txn_transaction where member_id='".$customerid."' and tran_date<'".$_GET["from_date"]."' and tran_status='active' order by tran_date asc");
                   while($supplier1 = mysql_fetch_array( $supplier ))
                   {
                   	if($supplier1['credit']!=0 || $supplier1['debit']!=0)
                   	{
                   	$discount=0;
                   		if($supplier1["tran_desc"]=='New Bill' && $supplier1["tran_type"]!='Agent'){
                  $data1 = mysql_query("SELECT discount FROM mst_bill_main where sk_bill_id='".$supplier1["transaction_ref_id"]."'");
                  while($info1 = mysql_fetch_array( $data1 ))
                  {
                  	$discount=$info1[0];
                  }
                   		}
                   		$ledger=$ledger+($supplier1['credit']);
                   		$ledger=$ledger-$supplier1['debit'];
                   		$ledger=$ledger-$discount;
                   		$ledger=number_format((float)$ledger, 0, '.', '');
                   		
                   	}
                   }
                   
                   
                   $balance=$ledger;
                   $array_count=0;
                   $array = array();
                   $supplier = mysql_query("SELECT credit, debit,tran_desc,transaction_ref_id,tran_type FROM txn_transaction where member_id='".$customerid."'  and tran_date>='".$_GET["from_date"]."' and tran_status='active' order by tran_date asc");
                   while($supplier1 = mysql_fetch_array( $supplier ))
                   {
                   	if($supplier1['credit']!=0 || $supplier1['debit']!=0)
                   	{
                   	$discount=0;
                   		if($supplier1["tran_desc"]=='New Bill' && $supplier1["tran_type"]!='Agent'){
                  $data1 = mysql_query("SELECT discount FROM mst_bill_main where sk_bill_id='".$supplier1["transaction_ref_id"]."'");
                  while($info1 = mysql_fetch_array( $data1 ))
                  {
                  	$discount=$info1[0];
                  }
                   		}
                   		$balance=$balance+($supplier1['credit']);
                   		$balance=$balance-$supplier1['debit'];
                   		$balance=$balance-$discount;
                   		$balance=number_format((float)$balance, 0, '.', '');
                   		array_push($array, $balance);
                   		 
                   		$array_count++;
                   	}
                   }?>
                    <tr>          
                                     <td></td> 
                                      <td>Ledger</td>
                                      <td></td>
                                       <td></td>
                                       <td><?php echo $ledger?></td>
                                    <td></td>
                                    <td></td> </tr>      
                    
                   <?php 
                   
                   $supplier_c=1;
                                  $c=0;
                                  $supplier_bt=0;
                                  $BAL=0;
                                  
                   $data = mysql_query("SELECT credit, debit,tran_type,tran_desc,tran_date,note,transaction_ref_id FROM txn_transaction where member_id='".$customerid."'  and tran_date>='".$_GET["from_date"]."' and tran_status='active' order by tran_date asc");               
                   while($info = mysql_fetch_array( $data ))
                   {
                   	
                   	$note=$info["note"];
                   	if($info['credit']!=0 || $info['debit']!=0)
                   	{
                   		$discount=0;
                   		if($info["tran_desc"]=='New Bill' && $info["tran_type"]!='Agent'){
                  $data1 = mysql_query("SELECT discount,note,slip_no,sk_bill_id FROM mst_bill_main where sk_bill_id='".$info["transaction_ref_id"]."'");
                  while($info1 = mysql_fetch_array( $data1 ))
                  {
                  	$discount=$info1[0];
                  	$note=$info1[1];
                  	$note=$note." (SlipNo : ".$info1[2].")";
                  	$sk_bill_id=$info1[3];
                  }
                   		}
                   	if($info["tran_desc"]=='Return Bill'){
                  $data1 = mysql_query("SELECT discount,note,slip_no,sk_bill_id FROM mst_bill_main where sk_bill_id='".$info["transaction_ref_id"]."'");
                  while($info1 = mysql_fetch_array( $data1 ))
                  {
                  	$discount=$info1[0];
                  	$note=$info1[1];
                  	$note=$note." (SlipNo : ".$info1[2].")";
                  	$sk_bill_id=$info1[3];
                  }
                   		}
                   
                   	$PERTICULAR=$info["tran_desc"];
                   	
                   		$supplier_name="";
                   	if($member_type==12){
                   		$transaction_ref_id=$info["transaction_ref_id"];
                   	$supplier_id=0;
		                	$data1 = mysql_query("SELECT member_id FROM mst_bill_main where sk_bill_id='$transaction_ref_id'");
	                	while($info1 = mysql_fetch_array( $data1 ))
	                	{   
	                	$supplier_id=$info1["member_id"];
	                	}
	                	$supplier_name="";
	                	$data1 = mysql_query("SELECT member_name FROM mst_member where sk_member_id='$supplier_id'");
		                	while($info1 = mysql_fetch_array( $data1 ))
		                	{
		                		$supplier_name="(".$info1["member_name"].")";
		                	}
		                		
                   	}
                   	
                                  	?>
                                    <tr>          
                                     <td><?php if($member_type==12){?><a href='?action=purchase_edit&c=inventory&bill_no=<?php echo $info["transaction_ref_id"]?>'><?php } $t_date=explode("-", $info["tran_date"]) ;echo $t_date[2]."-".$t_date[1]."-".$t_date[0]?></a></td> 
                                      <td><?php echo $PERTICULAR?> <?php echo $supplier_name?></td>
                                      <td><?php if($member_type==4){echo number_format($info["credit"], 2, '.', '');}else{ echo number_format($info["credit"]-$discount, 2, '.', '');}?></td>
                                       <td><?php echo number_format($info["debit"], 2, '.', '')?></td>
                                       <td><?php echo $array[$c]?></td>
                                    <td><?php echo $note?>
                                    
                                    
                                    </td>
                                    <td></td> </tr>
                                    
                   	
                   	<?php	$c++; }}?>
                   	
                   	<?php }?>
                                   
                              
                    
                    </tbody>
                    </table>
                    </div>
                     <?php if($_GET["op"]=="printstatement" || $_GET["op"]=="printall"){?>
                     
<script type="text/javascript">
window.print();

</script>
<?php }?>
       <?php if($_GET["op"]=="emailstatement" || $_GET["op"]=="emailall"){
         mysql_query("update customer set email='".$_GET["c_email"]."' where customer_id='$customerid'");
       
// declare our variables
 $name = "DHARANI GRANITES";
 $email = "dmgindia08@gmail.com";
 $message = nl2br($message);
 
 // set a title for the message
 $subject = "Message from Dharani Granites";
 $body = "From $name, \n\n$message";
 $headers = 'From: '.$email.'' . "\r\n" .
 		'Reply-To: '.$email.'' . "\r\n" .
 		'Content-type: text/html; charset=utf-8' . "\r\n" .
 		'X-Mailer: PHP/' . phpversion();
 
 // put your email address here
 mail($_GET["c_email"], $subject, $body, $headers);
 }?>

                <?php }?>
        </section><!-- /.content -->
        
<script>
setTimeout(function() { 
	window.close();
	}, 1000);
</script>