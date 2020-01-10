<?php include_once "$D_PATH/include/session.php";?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <?php include_once "$D_PATH/include/title.php";?>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
 
 <?php include_once "$D_PATH/include/scripts_top.php";?>
  
  </head>
   <body class="<?php echo $body_style?>">
    <div class="wrapper">
      
      	<?php include_once "$D_PATH/include/header.php";?>
  	
  <!-- Left side column. contains the logo and sidebar -->
  
    <?php include_once "$D_PATH/include/side.php";?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
   <?php 
     if(isset($_GET["from_date"])){
           $q=" and tran_date>='2016-10-31' and tran_date<'".$_GET["from_date"]."'  and tran_status='active'";   
           $from_date=$_GET["from_date"];
     }
     $received_amt=0;
    $data = mysql_query("SELECT sk_tran_id,tran_date,debit,tran_desc,transaction_ref_id FROM txn_transaction where tran_type='Customer' and tran_desc='New Bill' and debit>0 and note='Cash' $q");
	while($info = mysql_fetch_array( $data ))
	{      
	 	$received_amt=$received_amt+$info["debit"];
	}
	 $data = mysql_query("SELECT sk_tran_id,tran_date,credit,tran_desc,transaction_ref_id,member_id FROM txn_transaction where tran_type='Supplier' and tran_desc='Payment Return' and credit>0 $q");
	                	while($info = mysql_fetch_array( $data ))
	                	{      
	                		$received_amt=$received_amt+$info["credit"];
	                	}
	$data = mysql_query("SELECT sk_tran_id,tran_date,debit,tran_desc,member_id,transaction_ref_id FROM txn_transaction where tran_type='Customer' and debit>0 and tran_desc='New Bill' and member_id!=0 $q");
	while($info = mysql_fetch_array( $data ))
	{      
	    $received_amt=$received_amt+$info["debit"];      		
	}
	 $credit_payment=0;
     $data = mysql_query("SELECT sk_tran_id,tran_date,debit,tran_desc,member_id FROM txn_transaction where tran_type='Customer' and debit>0 and tran_desc='Payment' $q");
	 while($info = mysql_fetch_array( $data ))
	 {      
		$credit_payment=$credit_payment+$info["debit"];  
	 }
	 $bank_withdraw=0;
     $data = mysql_query("SELECT sk_tran_id,tran_date,debit,tran_desc,member_id FROM txn_transaction where tran_type='Bank' and debit>0 $q");
	 while($info = mysql_fetch_array( $data ))
	 {      
		$bank_withdraw=$bank_withdraw+$info["debit"];  
	  }
	  $hand_loan=0;
      $data = mysql_query("SELECT sk_tran_id,tran_date,debit,tran_desc,member_id FROM txn_transaction where tran_type='Hand Loan' and debit>0 and tran_desc!='Ledger Balance' $q");
	  while($info = mysql_fetch_array( $data ))
	  {   
	    $hand_loan=$hand_loan+$info["debit"];   
	  }
	  
	  $income_ledger=0;
      $data = mysql_query("SELECT sk_tran_id,tran_date,credit,tran_desc,member_id FROM txn_transaction where tran_type='Income' and credit>0 $q");
	  while($info = mysql_fetch_array( $data ))
	  {   
	    $income_ledger=$income_ledger+$info["credit"];   
	  }
    
	  //************************************
	   $expense=0;
                    $data = mysql_query("SELECT sk_tran_id,tran_date,debit,tran_desc,member_id,note FROM txn_transaction where tran_type='Expense' and debit>0 $q");
	                	while($info = mysql_fetch_array( $data ))
	                	{      
						
	                		   $expense=$expense+$info["debit"]; 
	                	}
	                	 $data = mysql_query("SELECT sk_tran_id,tran_date,debit,tran_desc,member_id,note FROM txn_transaction where tran_type='Vat' and tran_desc='Payment' and transaction_ref_id=0 and debit>0 $q");
	                	while($info = mysql_fetch_array( $data ))
	                	{      
						
	                		   $expense=$expense+$info["debit"]; 
	                	}
	                	 $data = mysql_query("SELECT sk_tran_id,tran_date,debit,tran_desc,member_id,note FROM txn_transaction where tran_type='Bank' and tran_desc='Vat Payment' and debit>0 $q");
	          while($info = mysql_fetch_array( $data ))
	                	{  
	                		 $expense=$expense+$info["debit"]; 
	                	}
                    $data = mysql_query("SELECT sk_bill_id,purchase_exp,member_id FROM mst_bill_main where purchase_exp>0 and bill_date<='$date'");
	                	while($info = mysql_fetch_array( $data ))
	                	{      
					
	                		   $expense=$expense+$info["purchase_exp"];  
	                	}
	   $supplier_payments=0;
                    $data = mysql_query("SELECT sk_tran_id,tran_date,debit,tran_desc,member_id,transaction_ref_id FROM txn_transaction where tran_type='Bank' and tran_desc='Supplier Withdraw' and debit>0 $q");
	                	while($info = mysql_fetch_array( $data ))
	                	{ 
	                		  $supplier_payments=$supplier_payments+$info["debit"];  
	                	}
	                	
                    $data = mysql_query("SELECT sk_tran_id,tran_date,debit,tran_desc,member_id FROM txn_transaction where tran_type='Supplier' and debit>0 and tran_desc='Payment' $q");
	                	while($info = mysql_fetch_array( $data ))
	                	{      
						
	                		   $supplier_payments=$supplier_payments+$info["debit"]; 
	                	}
	                	$rent=0;
	                		  $data = mysql_query("SELECT sk_tran_id,tran_date,debit,tran_desc,member_id,note FROM txn_transaction where tran_type='Rent' and tran_desc='Payment' and debit>0 $q");
	                	while($info = mysql_fetch_array( $data ))
	                	{  
	                		$rent=$rent+$info["debit"];  
	                	}
	   $bank_deposit=0;
                    $data = mysql_query("SELECT sk_tran_id,tran_date,credit,tran_desc,member_id FROM txn_transaction where tran_type='Bank' and credit>0 and tran_desc!='Ledger Balance' $q");
	                	while($info = mysql_fetch_array( $data ))
	                	{      
					$bank_deposit=$bank_deposit+$info["credit"];   
	                	}
	    $transport=0;
                    $data = mysql_query("SELECT sk_tran_id,tran_date,debit,tran_desc,member_id FROM txn_transaction where tran_type='Transport' and debit>0 $q");
	                	while($info = mysql_fetch_array( $data ))
	                	{      
							$transport=$transport+$info["debit"];  
	                	}
	    $agent_com=0;
                    $data = mysql_query("SELECT sk_tran_id,tran_date,debit,tran_desc,member_id FROM txn_transaction where tran_type='Agent' and tran_desc='Payment' and debit>0 $q");
	                	while($info = mysql_fetch_array( $data ))
	                	{      
	                		   $agent_com=$agent_com+$info["debit"];
	                	}
	     $employee_payment=0;
                    $data = mysql_query("SELECT sk_tran_id,tran_date,debit,tran_desc,member_id FROM txn_transaction where tran_type='Employee' and tran_desc='Payment' and debit>0 $q");
	                	while($info = mysql_fetch_array( $data ))
	                	{      
						  $employee_payment=$employee_payment+$info["debit"];  
	                	}
	     $partner_payment=0;
                    $data = mysql_query("SELECT sk_tran_id,tran_date,debit,tran_desc,member_id FROM txn_transaction where tran_type='Partner' and tran_desc='Payment' and debit>0 $q");
	                	while($info = mysql_fetch_array( $data ))
	                	{      
						
	                		   $partner_payment=$partner_payment+$info["debit"];  
	                	}
	      $hand_loan_issue=0;
                    $data = mysql_query("SELECT sk_tran_id,tran_date,credit,tran_desc,member_id FROM txn_transaction where tran_type='Hand Loan' and tran_desc!='Ledger Balance' and credit>0 $q");
	                	while($info = mysql_fetch_array( $data ))
	                	{      
	                		   $hand_loan_issue=$hand_loan_issue+$info["credit"];  
	                	}
	     $hamali=0;
                    
                    $data = mysql_query("SELECT sk_tran_id,tran_date,debit,tran_desc,member_id FROM txn_transaction where tran_type='Hamali' and debit>0 $q");
	                	while($info = mysql_fetch_array( $data ))
	                	{      
						
	                		   $hamali=$hamali+$info["debit"];    
	                	}
	                	
	                		$investment_payment_ledger=0;
                    
                    $data = mysql_query("SELECT sk_tran_id,tran_date,debit,tran_desc,member_id FROM txn_transaction where tran_type='Investment' and tran_type='Payment' and debit>0 $q");
	                	while($info = mysql_fetch_array( $data ))
	                	{      
						
	                		   $investment_payment_ledger=$investment_payment_ledger+$info["debit"];    
	                	}
	                	
	                	$investment_deposit_ledger=0;
                    
                    $data = mysql_query("SELECT sk_tran_id,tran_date,debit,tran_desc,member_id FROM txn_transaction where tran_type='Investment' and tran_type='Payment' and debit>0 $q");
	                	while($info = mysql_fetch_array( $data ))
	                	{      
						
	                		   $investment_deposit_ledger=$investment_deposit_ledger+$info["debit"];    
	                	}
	                	
	                	
	                	$customer_return=0;
                    $data = mysql_query("SELECT sk_tran_id,tran_date,credit,tran_desc,member_id,transaction_ref_id FROM txn_transaction where tran_type='Customer' and tran_desc='Payment Return' and credit>0 $q");
	                	while($info = mysql_fetch_array( $data ))
	                	{      
						
		                	
	                		   $customer_return=$customer_return+$info["credit"];  
	                	}
	                	 $data = mysql_query("SELECT sk_tran_id,tran_date,debit,tran_desc,member_id,transaction_ref_id FROM txn_transaction where tran_type='Customer' and tran_desc='Return Bill' and debit>0 and member_id=0 $q");
	                	while($info = mysql_fetch_array( $data ))
	                	{      
						 $customer_return=$customer_return+$info["debit"];   
	                	}
	                	
	                	$opening=($received_amt+$credit_payment+$bank_withdraw+$hand_loan+$income_ledger+$investment_deposit_ledger)-($expense+$customer_return+$supplier_payments+$bank_deposit+$transport+$agent_com+$employee_payment+$partner_payment+$hand_loan_issue+$hamali+$rent+$investment_payment_ledger);
	 $opening=($opening+52270+230628)-250482;
	 
	 
	 
	  
	  $data = mysql_query("SELECT sk_member_id, member_type, member_name, acc_no, ifsc, mobile, landline, email, address, place, state, profile_pic, login_name, login_password, login_status, employee_id, branch_id,member_status FROM mst_member where member_type='2' and member_status='active'");
                    	while($info = mysql_fetch_array( $data ))
                    	{
                    		$member_type=$info["member_type"];
                    		$customerid=$info['sk_member_id'];
                    		$member_filter="";
                    		$balance=0;
                    	  if($member_type=="3"){$q=" and member_id='$customerid'";$page="purchase"; $member_filter="  and tran_type='Supplier' ";}
                    		$supplier = mysql_query("SELECT credit, debit,transaction_ref_id,tran_desc FROM txn_transaction where member_id='".$customerid."' $member_filter and tran_status='active'");
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
                    		
                    		
                    		if($balance>0){
                    		$total=$total+$balance;
                    		}
                    	}
                    	$customer_credit_balance=$total;
	 
    ?>
    <?php include_once "$D_PATH/include/navigation.php";?>
    <script>
    function setData(tran_id,amt,tran_desc,tran_type){
		document.getElementById("tran_id").value=tran_id
		document.getElementById("tran_amt").value=amt
		document.getElementById("tran_old_amt").value=amt
		document.getElementById("tran_desc").value=tran_desc
		document.getElementById("tran_type").value=tran_type
    }
    
    </script>
    <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Transaction</h4>
      </div>
      <form action="?action=operations/update&c=reports" method="post">
      <div class="modal-body" align="center">
      		
      		<input type='hidden' name='from' id='from' value='<?php echo $_GET["from_date"]?>'>
      		<input type='hidden' name='to' id='to' value='<?php echo $_GET["to_date"]?>'>
      		<input type='hidden' name='tran_id' id='tran_id'>
      		<input type='hidden' name='tran_type' id='tran_type'>
      		<input type='hidden' name='tran_old_amt' id='tran_old_amt'>
      		
        		<table>
        			<tr><th>Purpose</th><td><input type='text' id='tran_desc' readonly="readonly"></td></tr>
        			<tr><td>&nbsp;</td></tr>
        		<tr><th>Amount</th><td><input type='text' name='tran_amt' id='tran_amt' class="form-control"></td></tr>
        		</table>
        		
        	
      </div>
      <div class="modal-footer">
      <div class="form-group col-md-2">
                	<input type="submit" value="Update" class='btn btn-success'>
                </div>  
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>

  </div>
</div>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            
                <div class="col-md-9">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">DayBook Report</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                
                <form action='?action=financial&c=reports'>
                <input type="hidden" name="action" value="financial">
                <input type="hidden" name="c" value="reports">
                     <table>
                      <tr><td>From Date</td><td>	          
                        <input type='date' name='from_date' class="form-control" id="inputDate" value='<?php  if(isset($_GET['from_date'])){echo $_GET['from_date'];}else{ echo $date1;}?>'>
                        </td><td>&nbsp;&nbsp;</td><td>To Date</td><td>	          
                        <input type='date' name='to_date' class="form-control" id="inputDate" value='<?php  if(isset($_GET['to_date'])){echo $_GET['to_date'];}else{ echo $date1;}?>'>
                        </td><td>&nbsp;&nbsp;</td><td></td><td>
                        <input type="submit" value='Get Report'/>&nbsp;
                         <?php 
                        if(isset($_GET["date"]))
                        {	?>
                        	<a class='btn btn-success' href="print/daybook_print.php?branch_name=<?php echo $_GET["branch_name"]?>&date=<?php echo $_GET['date']?>">Print</a>
                        	<?php 
                        }
                        ?></td>
                      </tr></table>
                        </form><br/>
                        </div>
                        </div>
                        </div>
            <!-- right column -->
            <?php 
            if(isset($_GET["from_date"])){
           $q=" and tran_date between '".$_GET["from_date"]."' and '".$_GET["to_date"]."' and tran_status='active'";
           
            $received_amt=0;
            ?>
            <div class="col-md-4">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Received Amount</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                <table id="" class="table table-bordered table-striped" style="font-size: 12px">
                    <thead>
                      <tr>
                        <th>Slip No</th>
                        <th>Description</th>
                        
                        <th>Amount</th>
                      </tr>
                    </thead>
                    <tbody id='div_print' style="font-size: 12px;">
                    <?php
                    $data = mysql_query("SELECT sk_tran_id,tran_date,debit,tran_desc,transaction_ref_id FROM txn_transaction where tran_type='Customer' and tran_desc='New Bill' and debit>0 and note='Cash' $q");
	                	while($info = mysql_fetch_array( $data ))
	                	{      
	                		$received_amt=$received_amt+$info["debit"];
						$member_name="";
						$bill_no=$info["transaction_ref_id"];
						$slip_no=0;
	                		$data1 = mysql_query("SELECT member_name,slip_no FROM mst_bill_main where sk_bill_id='$bill_no'");
		                	while($info1 = mysql_fetch_array( $data1 ))
		                	{
		                		$member_name=$info1["member_name"];
		                		$slip_no=$info1["slip_no"];
		                	}
	                		        
                    ?>
                    
                    <?php }?>
                             <?php
                  
                    $data = mysql_query("SELECT sk_tran_id,tran_date,debit,tran_desc,member_id,transaction_ref_id FROM txn_transaction where tran_type='Customer' and debit>0 and tran_desc='New Bill' and member_id!=0 $q");
	                	while($info = mysql_fetch_array( $data ))
	                	{      
						$member_name="";
						$member_id=$info["member_id"];
	                		$data1 = mysql_query("SELECT member_name FROM mst_member where sk_member_id='$member_id'");
		                	while($info1 = mysql_fetch_array( $data1 ))
		                	{
		                		$member_name=$info1["member_name"];
		                	}
	                		   $received_amt=$received_amt+$info["debit"];  
	                	$bill_no=$info["transaction_ref_id"];
						$slip_no=0;
						
	                		$data1 = mysql_query("SELECT member_name,slip_no FROM mst_bill_main where sk_bill_id='$bill_no'");
		                	while($info1 = mysql_fetch_array( $data1 ))
		                	{
		                		if($member_name==""){
		                		$member_name=$info1["member_name"];
		                		}
		                		$slip_no=$info1["slip_no"];
		                	}

	                		   if($info["debit"]>0){
                    ?>
                    
                    <?php }}?>    
                    
                    <?php
                    $data = mysql_query("SELECT sk_tran_id,tran_date,credit,tran_desc,transaction_ref_id,member_id FROM txn_transaction where tran_type='Supplier' and tran_desc='Payment Return' and credit>0 $q");
	                	while($info = mysql_fetch_array( $data ))
	                	{      
	                		$received_amt=$received_amt+$info["credit"];
						$member_name="";
						$bill_no=$info["transaction_ref_id"];
	                		$data1 = mysql_query("SELECT member_name FROM mst_member where sk_member_id='".$info["member_id"]."'");
		                	while($info1 = mysql_fetch_array( $data1 ))
		                	{
		                		$member_name=$info1["member_name"];
		                	}
		                	$bill_no=$info["transaction_ref_id"];
						$slip_no=0;
	                		$data1 = mysql_query("SELECT member_name,slip_no FROM mst_bill_main where sk_bill_id='$bill_no'");
		                	while($info1 = mysql_fetch_array( $data1 ))
		                	{
		                		$member_name=$info1["member_name"];
		                		$slip_no=$info1["slip_no"];
		                	}
		                	
	                		        
                    ?>
                    
                    <?php }?>    
                                   
                                    <tr><td>1</td><td>Received Amount</td><td><?php echo $received_amt?></td></tr>
                
                    <?php 
                  
                    $credit_payment=0;
                    $data = mysql_query("SELECT sk_tran_id,tran_date,debit,tran_desc,member_id FROM txn_transaction where tran_type='Customer' and debit>0 and tran_desc='Payment' $q");
	                	while($info = mysql_fetch_array( $data ))
	                	{      
						$member_name="";
						$member_id=$info["member_id"];
	                		$data1 = mysql_query("SELECT member_name FROM mst_member where sk_member_id='$member_id'");
		                	while($info1 = mysql_fetch_array( $data1 ))
		                	{
		                		$member_name=$info1["member_name"];
		                	}
	                		   $credit_payment=$credit_payment+$info["debit"];  

	                		   if($info["debit"]>0){
                    ?>
                    
                    <?php }}?>
                     
                               
                                    <tr><td>2</td><td>Customer Credit Payment</td><td><?php echo $credit_payment?></td></tr>
                                   
                 
                    <?php 
                  
                    $other_income=0;
                    $data = mysql_query("SELECT sk_tran_id,tran_date,credit,tran_desc,member_id,note FROM txn_transaction where tran_type='Income' and credit>0 $q");
	                	while($info = mysql_fetch_array( $data ))
	                	{      
						
	                		
	                		    $other_income=$other_income+$info["credit"];  

	                		   if($info["credit"]>0){
                    ?>
                    <?php }}?>
                     
                              
                                    <tr><td>3</td><td>Other Income</td><td><?php echo $other_income?></td></tr>
                                   
                    <?php
                    $bank_withdraw=0;
                     
                    $data = mysql_query("SELECT sk_tran_id,tran_date,debit,tran_desc,member_id,note FROM txn_transaction where tran_type='Bank' and debit>0 $q");
	                	while($info = mysql_fetch_array( $data ))
	                	{      
						$member_name="";
						$member_id=$info["member_id"];
	                		$data1 = mysql_query("SELECT member_name FROM mst_member where sk_member_id='$member_id'");
		                	while($info1 = mysql_fetch_array( $data1 ))
		                	{
		                		$member_name=$info1["member_name"];
		                	}
	                		   $bank_withdraw=$bank_withdraw+$info["debit"];     
                    ?>
                    
                    <?php }?>
                              
                                    <tr><td>4</td><td>Bank Withdrawals</td><td><?php echo $bank_withdraw?></td></tr>
                                   
                    <?php
                    
                    $investment_return=0;
                  
                  
                    $data = mysql_query("SELECT sk_tran_id,tran_date,credit,tran_desc,member_id FROM txn_transaction where tran_type='Investment' and credit>0 and tran_desc='Returns' $q");
	                	while($info = mysql_fetch_array( $data ))
	                	{      
						$member_name="";
						$member_id=$info["member_id"];
	                		$data1 = mysql_query("SELECT member_name FROM mst_member where sk_member_id='$member_id'");
		                	while($info1 = mysql_fetch_array( $data1 ))
		                	{
		                		$member_name=$info1["member_name"];
		                	}
	                		   $investment_return=$investment_return+$info["credit"];  

	                		   if($info["credit"]>0){
                    ?>
                    <?php }}?>
                              
                                    <tr><td>5</td><td>Partner Investment</td><td><?php echo $investment_return?></td></tr>
                                  
                    <?php
                    $hand_loan=0;
                     
                    $data = mysql_query("SELECT sk_tran_id,tran_date,debit,tran_desc,member_id FROM txn_transaction where tran_type='Hand Loan' and debit>0 and tran_desc!='Ledger Balance' $q");
	                	while($info = mysql_fetch_array( $data ))
	                	{      
						$member_name="";
						$member_id=$info["member_id"];
	                		$data1 = mysql_query("SELECT member_name FROM mst_member where sk_member_id='$member_id'");
		                	while($info1 = mysql_fetch_array( $data1 ))
		                	{
		                		$member_name=$info1["member_name"];
		                	}
	                		   $hand_loan=$hand_loan+$info["debit"];     
                    ?>
                    
                    <?php }?>
                                </tbody>
                                    <tfoot>
                                    <tr><td>6</td><td>Loan Collection</td><td><?php echo $hand_loan?></td></tr>
                                    </tfoot>
                  </table>
                  
                </div><!-- /.box-body -->
              </div><!-- /.box -->
    </div>
    	
    	 
                    
                 
                 <div class="col-md-4">
                 <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Expenses</h3>
                </div><!-- /.box-header -->
                <div class="box-body" style="overflow: auto;">
                <table id="" class="table table-bordered table-striped" style="font-size: 12px">
                    <thead>
                      <tr>
                        <th>SlNo</th>
                        <th>Description</th>
                       
                        <th>Amount</th>
                      </tr>
                    </thead>
                    <tbody id='div_print' style="font-size: 12px;">
                    <?php
                   
                    $expense=0;
                    $data = mysql_query("SELECT sk_tran_id,tran_date,debit,tran_desc,member_id,note FROM txn_transaction where tran_type='Vat' and tran_desc='Payment' and transaction_ref_id=0 and debit>0 $q");
	                	while($info = mysql_fetch_array( $data ))
	                	{      
						$member_name="Vat";
						
	                		   $expense=$expense+$info["debit"];     
                    ?>
                    
                    <?php }
                    
             $data = mysql_query("SELECT sk_tran_id,tran_date,debit,tran_desc,member_id,note FROM txn_transaction where tran_type='Bank' and tran_desc='Vat Payment' and debit>0 $q");
	                	while($info = mysql_fetch_array( $data ))
	                	{      
						$member_name="Bank";
						
	                		   $expense=$expense+$info["debit"];     
                    ?>
                    
                    <?php }
                    
             $data = mysql_query("SELECT sk_tran_id,tran_date,debit,tran_desc,member_id,note FROM txn_transaction where tran_type='Rent' and tran_desc='Payment' and debit>0 $q");
	                	while($info = mysql_fetch_array( $data ))
	                	{      
						$member_name="Rent";
						
	                		   $expense=$expense+$info["debit"];     
                    ?>
                    
                    <?php }
                    
            $data = mysql_query("SELECT sk_tran_id,tran_date,debit,tran_desc,member_id,note FROM txn_transaction where tran_type='Expense' and debit>0 $q");
	                	while($info = mysql_fetch_array( $data ))
	                	{      
						$member_name="";
						$member_id=$info["member_id"];
	                		$data1 = mysql_query("SELECT expense_name FROM mst_expenselist where expense_id='$member_id'");
		                	while($info1 = mysql_fetch_array( $data1 ))
		                	{
		                		$member_name=$info1["expense_name"];
		                	}
	                		   $expense=$expense+$info["debit"];     
                    ?>
                    
                    <?php }
                   
                   
                    $data = mysql_query("SELECT sk_bill_id,purchase_exp,member_id FROM mst_bill_main where purchase_exp>0 and bill_date between '".$_GET["from_date"]."' and  '".$_GET["to_date"]."'");
	                	while($info = mysql_fetch_array( $data ))
	                	{      
						$member_name="";
						$member_id=$info["member_id"];
	                		$data1 = mysql_query("SELECT member_name FROM mst_member where sk_member_id='$member_id'");
		                	while($info1 = mysql_fetch_array( $data1 ))
		                	{
		                		$member_name=$info1["member_name"];
		                	}
	                		   $expense=$expense+$info["purchase_exp"];     
                    ?>
                    
                    <?php }
                    
                    
                    ?>
                               
                                    <tr><td>1</td><td>Expenses</td><td><?php echo $expense?></td></tr>
                                  
                    <?php
                    
                    $supplier_payments=0;
                    $data = mysql_query("SELECT sk_tran_id,tran_date,debit,tran_desc,member_id,transaction_ref_id FROM txn_transaction where tran_type='Bank' and tran_desc='Supplier Withdraw' and debit>0 $q");
	                	while($info = mysql_fetch_array( $data ))
	                	{      
						$member_name="";
						$member_id=$info["member_id"];
						$transaction_ref_id=$info["transaction_ref_id"];
	                		$data1 = mysql_query("SELECT member_name FROM mst_member where sk_member_id='$member_id'");
		                	while($info1 = mysql_fetch_array( $data1 ))
		                	{
		                		$bank_name=$info1["member_name"];
		                	}
		                	$supplier_id=0;
		                	$data1 = mysql_query("SELECT member_id FROM txn_transaction where sk_tran_id='$transaction_ref_id'");
	                	while($info1 = mysql_fetch_array( $data1 ))
	                	{   
	                	$supplier_id=$info1["member_id"];
	                	}
	                	$supplier_name="";
	                	$data1 = mysql_query("SELECT member_name FROM mst_member where sk_member_id='$supplier_id'");
		                	while($info1 = mysql_fetch_array( $data1 ))
		                	{
		                		$supplier_name=$info1["member_name"];
		                	}
		                	
	                		   $supplier_payments=$supplier_payments+$info["credit"];     
                    ?>
                    <?php }?>
                    <?php 
                  
                  
                    $data = mysql_query("SELECT sk_tran_id,tran_date,debit,tran_desc,member_id FROM txn_transaction where tran_type='Supplier' and debit>0 and tran_desc='Payment' $q");
	                	while($info = mysql_fetch_array( $data ))
	                	{      
						$member_name="";
						$member_id=$info["member_id"];
	                		$data1 = mysql_query("SELECT member_name FROM mst_member where sk_member_id='$member_id'");
		                	while($info1 = mysql_fetch_array( $data1 ))
		                	{
		                		$member_name=$info1["member_name"];
		                	}
	                		   $supplier_payments=$supplier_payments+$info["debit"];  

	                		   if($info["debit"]>0){
                    ?>
                    
                    <?php }}?>
                               
                                    <tr><td>2</td><td>Supplier Payments</td><td><?php echo $supplier_payments?></td></tr>
                                 
                    <?php
                    
                    $customer_return=0;
                    $data = mysql_query("SELECT sk_tran_id,tran_date,credit,tran_desc,member_id,transaction_ref_id FROM txn_transaction where tran_type='Customer' and tran_desc='Payment Return' and credit>0 $q");
	                	while($info = mysql_fetch_array( $data ))
	                	{      
						$member_name="";
						$member_id=$info["member_id"];
						$transaction_ref_id=$info["transaction_ref_id"];
	                		$data1 = mysql_query("SELECT member_name FROM mst_member where sk_member_id='$member_id'");
		                	while($info1 = mysql_fetch_array( $data1 ))
		                	{
		                		$bank_name=$info1["member_name"];
		                	}
		                	$supplier_id=0;
		                	$data1 = mysql_query("SELECT member_id FROM txn_transaction where sk_tran_id='$transaction_ref_id'");
	                	while($info1 = mysql_fetch_array( $data1 ))
	                	{   
	                	$supplier_id=$info1["member_id"];
	                	}
	                	$supplier_name="";
	                	$data1 = mysql_query("SELECT member_name FROM mst_member where sk_member_id='$supplier_id'");
		                	while($info1 = mysql_fetch_array( $data1 ))
		                	{
		                		$supplier_name=$info1["member_name"];
		                	}
		                	
	                		   $customer_return=$customer_return+$info["credit"];     
                    ?>
                    
                    <?php }
	                	 $data = mysql_query("SELECT sk_tran_id,tran_date,credit,tran_desc,member_id,transaction_ref_id FROM txn_transaction where tran_type='Customer' and tran_desc='Return Bill' and credit>0 $q");
	                	while($info = mysql_fetch_array( $data ))
	                	{      
						$member_name="";
						$member_id=$info["member_id"];
						$transaction_ref_id=$info["transaction_ref_id"];
	                		$data1 = mysql_query("SELECT member_name FROM mst_member where sk_member_id='$member_id'");
		                	while($info1 = mysql_fetch_array( $data1 ))
		                	{
		                		$bank_name=$info1["member_name"];
		                	}
		                	if($member_id==0){
		                	$data1 = mysql_query("SELECT member_name FROM mst_bill_main where sk_bill_id='$transaction_ref_id'");
		                	while($info1 = mysql_fetch_array( $data1 ))
		                	{
		                		$bank_name=$info1["member_name"];
		                	}
		                	}
		                	
		                	
	                		   $customer_return=$customer_return+$info["credit"];     
                    ?>
                    <?php }?>
                    
                                    <tr><td>3</td><td>Return Expense</td><td><?php echo $customer_return?></td></tr>
                                   
                    <?php
                     
                    $bank_deposit=0;
                    $data = mysql_query("SELECT sk_tran_id,tran_date,credit,tran_desc,member_id FROM txn_transaction where tran_type='Bank' and credit>0 and tran_desc!='Ledger Balance' $q");
	                	while($info = mysql_fetch_array( $data ))
	                	{      
						$member_name="";
						$member_id=$info["member_id"];
	                		$data1 = mysql_query("SELECT member_name FROM mst_member where sk_member_id='$member_id'");
		                	while($info1 = mysql_fetch_array( $data1 ))
		                	{
		                		$member_name=$info1["member_name"];
		                	}
	                		   $bank_deposit=$bank_deposit+$info["credit"];     
                    ?>
                    
                    <?php }?>
                               
                                    <tr><td>4</td><td>Bank Deposit</td><td><?php echo $bank_deposit?></td></tr>
                                    
                    <?php
                   
                    $transport=0;
                    $data = mysql_query("SELECT sk_tran_id,tran_date,debit,tran_desc,member_id,note FROM txn_transaction where tran_type='Transport' and debit>0 $q");
	                	while($info = mysql_fetch_array( $data ))
	                	{      
						$member_name="";
						$member_id=$info["member_id"];
	                		$data1 = mysql_query("SELECT member_name FROM mst_member where sk_member_id='$member_id'");
		                	while($info1 = mysql_fetch_array( $data1 ))
		                	{
		                		$member_name=$info1["member_name"];
		                	}
	                		   $transport=$transport+$info["debit"];     
                    ?>
                    
                    <?php }?>
                               
                                    <tr><td>5</td><td>Transport</td><td><?php echo $transport?></td></tr>
                                  
                    <?php
                    
                    $agent_com=0;
                    $data = mysql_query("SELECT sk_tran_id,tran_date,debit,tran_desc,member_id FROM txn_transaction where tran_type='Agent' and tran_desc='Payment' and debit>0 $q");
	                	while($info = mysql_fetch_array( $data ))
	                	{      
						$member_name="";
						$member_id=$info["member_id"];
	                		$data1 = mysql_query("SELECT member_name FROM mst_member where sk_member_id='$member_id'");
		                	while($info1 = mysql_fetch_array( $data1 ))
		                	{
		                		$member_name=$info1["member_name"];
		                	}
	                		   $agent_com=$agent_com+$info["debit"];     
                    ?>
                    
                    <?php }?>
                              
                                    <tr><td>6</td><td>Agent Comission</td><td><?php echo $agent_com?></td></tr>
                                   
                    <?php
                    
                    $employee_payment=0;
                    $data = mysql_query("SELECT sk_tran_id,tran_date,debit,tran_desc,member_id FROM txn_transaction where tran_type='Employee' and tran_desc='Payment' and debit>0 $q");
	                	while($info = mysql_fetch_array( $data ))
	                	{      
						$member_name="";
						$member_id=$info["member_id"];
	                		$data1 = mysql_query("SELECT member_name FROM mst_member where sk_member_id='$member_id'");
		                	while($info1 = mysql_fetch_array( $data1 ))
		                	{
		                		$member_name=$info1["member_name"];
		                	}
	                		   $employee_payment=$employee_payment+$info["debit"];     
                    ?>
                    <?php }?>
                               
                                    <tr><td>7</td><td>Employee Payment</td><td><?php echo $employee_payment?></td></tr>
                                  
                    <?php
                   
                    $partner_payment=0;
                    $data = mysql_query("SELECT sk_tran_id,tran_date,debit,tran_desc,member_id FROM txn_transaction where tran_type='Partner' and tran_desc='Payment' and debit>0 $q");
	                	while($info = mysql_fetch_array( $data ))
	                	{      
						$member_name="";
						$member_id=$info["member_id"];
	                		$data1 = mysql_query("SELECT member_name FROM mst_member where sk_member_id='$member_id'");
		                	while($info1 = mysql_fetch_array( $data1 ))
		                	{
		                		$member_name=$info1["member_name"];
		                	}
	                		   $partner_payment=$partner_payment+$info["debit"];     
                    ?>
                    <?php }?>
                               
                                    <tr><td>8</td><td>Partner Payment</td><td><?php echo $partner_payment?></td></tr>
                                    
                    <?php
                     
                    $hand_loan_issue=0;
                    $data = mysql_query("SELECT sk_tran_id,tran_date,credit,tran_desc,member_id FROM txn_transaction where tran_type='Hand Loan' and tran_desc!='Ledger Balance' and credit>0 $q");
	                	while($info = mysql_fetch_array( $data ))
	                	{      
						$member_name="";
						$member_id=$info["member_id"];
	                		$data1 = mysql_query("SELECT member_name FROM mst_member where sk_member_id='$member_id'");
		                	while($info1 = mysql_fetch_array( $data1 ))
		                	{
		                		$member_name=$info1["member_name"];
		                	}
	                		   $hand_loan_issue=$hand_loan_issue+$info["credit"];     
                    ?>
                    
                    <?php }?>
                               
                                    <tr><td>9</td><td>Hand Loan</td><td><?php echo $hand_loan_issue?></td></tr>
                                   
                    <?php
                    
                    $investment_payments=0;
                  
                  
                    $data = mysql_query("SELECT sk_tran_id,tran_date,debit,tran_desc,member_id FROM txn_transaction where tran_type='Investment' and debit>0 and tran_desc='Payment' $q");
	                	while($info = mysql_fetch_array( $data ))
	                	{      
						$member_name="";
						$member_id=$info["member_id"];
	                		$data1 = mysql_query("SELECT member_name FROM mst_member where sk_member_id='$member_id'");
		                	while($info1 = mysql_fetch_array( $data1 ))
		                	{
		                		$member_name=$info1["member_name"];
		                	}
	                		   $investment_payments=$investment_payments+$info["debit"];  

	                		   if($info["debit"]>0){
                    ?>
                    <?php }}?>
                             
                                    <tr><td>10</td><td>Investment</td><td><?php echo $investment_payments?></td></tr>
                                  
                    <?php
                    $hamali=0;
                    
                    $data = mysql_query("SELECT sk_tran_id,tran_date,debit,tran_desc,member_id FROM txn_transaction where tran_type='Hamali' and debit>0 $q");
	                	while($info = mysql_fetch_array( $data ))
	                	{      
						$member_name="";
						$member_id=$info["member_id"];
	                		$data1 = mysql_query("SELECT member_name FROM mst_member where sk_member_id='$member_id'");
		                	while($info1 = mysql_fetch_array( $data1 ))
		                	{
		                		$member_name=$info1["member_name"];
		                	}
	                		   $hamali=$hamali+$info["debit"];     
                    ?>
                    
                    <?php }?>
                                
                                    <tr><td>11</td><td>Hamali</td><td><?php echo $hamali?></td></tr>
                                    </tfoot>
                  </table>
                  
                </div><!-- /.box-body -->
              </div><!-- /.box -->
              
                 </div>
                 
                 <div class="col-md-4">
                 <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Expenses</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                <?php $state="active";
                $inc=$received_amt+$credit_payment+$bank_withdraw+$hand_loan+$other_income+$investment_return;
                $exp=$expense+$customer_return+$supplier_payments+$bank_deposit+$transport+$agent_com+$employee_payment+$partner_payment+$hand_loan_issue+$hamali+$investment_payments;
                ?>
                
                 <?php 
                    
                      $total_bal=0;$total_min=0;
                      $data=mysql_query("select sk_member_id,member_name,acc_no FROM mst_member where member_status='$state' and member_type='6'");
                while($info = mysql_fetch_array( $data ))
                {
                	
                	$balance=0;
                	$bank_id=$info["sk_member_id"];
                	$supplier = mysql_query("SELECT credit, debit from txn_transaction where member_id='".$bank_id."' and tran_type='Bank' and tran_date<='".$_GET["to_date"]."' and tran_status='active'");
                	while($supplier1 = mysql_fetch_array( $supplier ))
                	{
                		//if($supplier1['credit']>0 || $supplier1['debit']>0)
                		{
                			$balance=$balance+$supplier1['credit'];
                			$balance=$balance-$supplier1['debit'];
                			
                		}
                	}
                	if($balance<0){
					$total_min=$total_min+$balance;
					}else{
                	$total_bal=$total_bal+$balance;
                	}
                }
                	?>
                	
                	<?php 
                    	$handloantotal=0;
                    	$negative_total=0;
                    	$data = mysql_query("SELECT sk_member_id, member_type, member_name, acc_no, ifsc, mobile, landline, email, address, place, state, profile_pic, login_name, login_password, login_status, employee_id, branch_id,member_status FROM mst_member where member_type='8' and member_status='$state'");
                    	while($info = mysql_fetch_array( $data ))
                    	{
                    		$member_type=$info["member_type"];
                    		$customerid=$info['sk_member_id'];
                    		$member_filter="";
                    		$balance=0;
                    	  
                    		$supplier = mysql_query("SELECT credit, debit,transaction_ref_id,tran_desc,tran_type FROM txn_transaction where member_id='".$customerid."' $member_filter and tran_status='active'");
                    		while($supplier1 = mysql_fetch_array( $supplier ))
                    		{
                    			//if($supplier1['credit']!=0 || $supplier1['debit']!=0)
                    			{
                    			$discount=0;
                   					$balance=$balance+($supplier1['credit']);
                    				$balance=$balance-$supplier1['debit'];
                    				$balance=$balance-$discount;
                    				$balance=number_format((float)$balance, 0, '.', '');
                    			}
                    		}
                    		
                    		
                    		if($balance>0){
                    		$handloantotal=$handloantotal+$balance;
                    		}else{
                    			$negative_total=$negative_total+$balance;
                    		}
                    	?>
                   
                    <?php }?>
							
				
					
					
					 <?php 
                    	$stotal=0;
                    	$snegative_total=0;
                    	$data = mysql_query("SELECT sk_member_id, member_type, member_name, acc_no, ifsc, mobile, landline, email, address, place, state, profile_pic, login_name, login_password, login_status, employee_id, branch_id,member_status FROM mst_member where member_type='3' and member_status='active'");
                    	while($info = mysql_fetch_array( $data ))
                    	{
                    		$member_type=$info["member_type"];
                    		$customerid=$info['sk_member_id'];
                    		$member_filter="";
                    		$balance=0;
                    	  if($member_type=="3"){$q=" and member_id='$customerid'";$page="purchase"; $member_filter="  and tran_type='Supplier' ";}
                    		$supplier = mysql_query("SELECT credit, debit,transaction_ref_id,tran_desc,tran_type FROM txn_transaction where member_id='".$customerid."' $member_filter and tran_status='active'");
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
                    			}
                    		}
                    		
                    		
                    		if($balance>0){
                    		$stotal=$stotal+$balance;
                    		}else{
                    			$snegative_total=$snegative_total+$balance;
                    		}
                    	?>
                   
                    <?php }?>
                    
                     <?php 
                    	$ctotal=0;
                    	$cnegative_total=0;
                    	$data = mysql_query("SELECT sk_member_id, member_type, member_name, acc_no, ifsc, mobile, landline, email, address, place, state, profile_pic, login_name, login_password, login_status, employee_id, branch_id,member_status FROM mst_member where member_type='2' and member_status='$state'");
                    	while($info = mysql_fetch_array( $data ))
                    	{
                    		$member_type=$info["member_type"];
                    		$customerid=$info['sk_member_id'];
                    		$member_filter="";
                    		$balance=0;
                    	  if($member_type=="3"){$q=" and member_id='$customerid'";$page="purchase"; $member_filter="  and tran_type='Supplier' ";}
                    		$supplier = mysql_query("SELECT credit, debit,transaction_ref_id,tran_desc,tran_type FROM txn_transaction where member_id='".$customerid."' $member_filter and tran_status='active'");
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
                    			}
                    		}
                    		
                    		
                    		
                    		if($balance>0){
                    		$ctotal=$ctotal+$balance;
                    		}else{
                    			$cnegative_total=$cnegative_total+$balance;
                    		}
                    	?>
                   
                    <?php }?>
                    <?php $total_income=(($opening+$inc)-$exp)+$total_bal+$customer_credit_balance+$handloantotal+($snegative_total*-1);
                    $stock_value=stockValue($_GET["to_date"]);
                    ?>
                <table id="" class="table table-bordered table-striped" style="font-size: 12px">
                    <thead>
                      <tr><th>Opening Balance</th><td><?php echo $opening?></td></tr>
                      <tr><th>Income</th><td><?php echo  $inc?></td></tr>
                      <tr><th>Expenses</th><td><?php echo $exp?></td></tr>
                      <tr style="background-color: skyblue;color: white;font-weight: bold;"><th>Closing Cash Balance</th><td><?php echo ($opening+$inc)-$exp?></td></tr> 
                      
                        <tr><th>Bank Balance</th><td><?php echo $total_bal?></td></tr> 
                         <tr><th>Customer Credit Balance</th><td><?php echo $customer_credit_balance?></td></tr> 
                         <tr><th>Hand Loan Balance</th><td><?php echo $handloantotal?></td></tr> 
                         <tr><th>Supplier Advance</th><td><?php echo $snegative_total*-1?></td></tr> 
                          <tr style="background-color: green;color: white;font-weight: bold;"><th>Closing Balance</th><td><?php echo $total_income?></td></tr> 
                        
                          <tr><th>Bank Loans</th><td><?php echo $total_min*-1?></td></tr> 
                           <tr><th>Borrowings</th><td><?php echo $negative_total*-1?></td></tr> 
                           
                          
							 <tr><th>Customer Advance</th><td><?php echo $cnegative_total*-1?></td></tr> 
	
                            <tr><th>Supplier Payments Balance</th><td><?php echo $stotal?></td></tr> 
                         <tr style="background-color: orange;font-weight: bold;"><th>Balance</th><td><?php echo $total_income-(($negative_total*-1+$total_min*-1+$cnegative_total*-1+$stotal))?></td></tr> 
 <tr><th>Stock Value</th><td><?php echo $stock_value?></td></tr> 
                        <tr style="background-color: green;font-weight: bold;color: white"><th>Balance</th><td><?php echo ($total_income)-(($negative_total*-1+$total_min*-1+$cnegative_total*-1+$stotal))+$stock_value?></td></tr> 
                       
                      
                    </thead>
                 
                    
                    </table>
                   
                    </div>
                    </div>
                    </div>
 <div class="col-md-6">
                 <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Report</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
               
               <?php 
               $stock_opening=stockValue($_GET["from_date"]);
                $stock_closing=stockValue($_GET["to_date"]);
               
               $customer_opening=getMemberBalance($_GET["from_date"],2);
           $customer_closing=getMemberBalance($_GET["to_date"],2);
           $supplier_opening=getMemberBalance($_GET["from_date"],3);
           $supplier_closing=getMemberBalance($_GET["to_date"],3);
           
            $bank_opening=getBankBalance($_GET["from_date"],6);
             $bank_closing=getBankBalance($_GET["to_date"],6);
             
             $bank_loan_opening=getBankLoanBalance($_GET["from_date"],6);
             $bank_loan_closing=getBankLoanBalance($_GET["to_date"],6);
             
               $hand_opening=getMemberBalance($_GET["from_date"],8);
             $hand_closing=getMemberBalance($_GET["to_date"],8);
             
              $investment_opening=getMemberBalance($_GET["from_date"],11);
             $investment_closing=getMemberBalance($_GET["to_date"],11);
             
               $loan_opening=getMemberNegativeBalance($_GET["from_date"],8);
             $loan_closing=getMemberNegativeBalance($_GET["to_date"],8);
             
               ?>
                <table id="" class="table table-bordered table-striped" style="font-size: 12px">
               		<tr><th>Particular</th><th>Opening</th><th>Closing</th><th>Difference</th></tr>
               		<tr><th>Stock</th><td><?php echo $stock_opening?></td><td><?php echo $stock_closing?></td><td><?php echo $stock_opening-$stock_closing?></td></tr>
               		<tr><th>Customer Credit</th><td><?php echo $customer_opening?></td><td><?php echo $customer_closing?></td><td><?php echo $customer_opening-$customer_closing?></td></tr>
               		<tr><th>Bank Balance</th><td><?php echo $bank_opening?></td><td><?php echo $bank_closing?></td><td><?php echo $bank_opening-$bank_closing?></td></tr>
               		<tr><th>Bank Loan</th><td><?php echo $bank_loan_opening?></td><td><?php echo $bank_loan_closing?></td><td><?php echo $bank_loan_opening-$bank_loan_closing?></td></tr>
               <tr><th>Hand Loan</th><td><?php echo $hand_opening?></td><td><?php echo $hand_closing?></td><td><?php echo $hand_opening-$hand_closing?></td></tr>
               <tr><th>Investments</th><td><?php echo $investment_opening?></td><td><?php echo $investment_closing?></td><td><?php echo $investment_opening-$investment_closing?></td></tr>
               <tr><th>Loans</th><td><?php echo $loan_opening?></td><td><?php echo $loan_closing?></td><td><?php echo $loan_opening-$loan_closing?></td></tr>
               <tr><th>Supplier Payments</th><td><?php echo $supplier_opening?></td><td><?php echo $supplier_closing?></td><td><?php echo $supplier_opening-$supplier_closing?></td></tr>
               </table>
                   
                    </div>
                    </div>
                    </div>
                 <?php }?>
          </div>   <!-- /.row -->
        </section><!-- /.content -->

  <?php 
        function getMemberBalance($date,$member_type){
         $opening_customer=0;
                    	$negative_total=0;
                    	$q="";
                    	if($member_type=="3"){$q=" and member_id='$customerid'";$page="purchase"; $member_filter="  and tran_type='Supplier' ";}
                    	  $q=$q." and tran_date<'$date'";
                    	$data = mysql_query("SELECT sk_member_id, member_type, member_name, acc_no, ifsc, mobile, landline, email, address, place, state, profile_pic, login_name, login_password, login_status, employee_id, branch_id,member_status FROM mst_member where member_type='$member_type' and member_status='active'");
                    	while($info = mysql_fetch_array( $data ))
                    	{
                    		$member_type=$info["member_type"];
                    		$customerid=$info['sk_member_id'];
                    		$member_filter="";
                    		$balance=0;
                    	  
                    		$supplier = mysql_query("SELECT credit, debit,transaction_ref_id,tran_desc,tran_type FROM txn_transaction where member_id='".$customerid."' $member_filter and tran_date<='$date' and tran_status='active'");
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
                    			}
                    		}
                    		
                    		
                    		if($balance>0){
                    		$opening_customer=$opening_customer+$balance;
                    		}else{
                    			$negative_total=$negative_total+$balance;
                    		}
                    	}
        	return $opening_customer;
        }
          function getMemberNegativeBalance($date,$member_type){
         $opening_customer=0;
                    	$negative_total=0;
                    	$q="";
                    	if($member_type=="3"){$q=" and member_id='$customerid'";$page="purchase"; $member_filter="  and tran_type='Supplier' ";}
                    	  $q=$q." and tran_date<'$date'";
                    	$data = mysql_query("SELECT sk_member_id, member_type, member_name, acc_no, ifsc, mobile, landline, email, address, place, state, profile_pic, login_name, login_password, login_status, employee_id, branch_id,member_status FROM mst_member where member_type='$member_type' and member_status='active'");
                    	while($info = mysql_fetch_array( $data ))
                    	{
                    		$member_type=$info["member_type"];
                    		$customerid=$info['sk_member_id'];
                    		$member_filter="";
                    		$balance=0;
                    	  
                    		$supplier = mysql_query("SELECT credit, debit,transaction_ref_id,tran_desc,tran_type FROM txn_transaction where member_id='".$customerid."' $member_filter and tran_date<='$date' and tran_status='active'");
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
                    			}
                    		}
                    		
                    		
                    		if($balance>0){
                    		$opening_customer=$opening_customer+$balance;
                    		}else{
                    			$negative_total=$negative_total+$balance;
                    		}
                    	}
        	return $negative_total*-1;
        }
        
        function getBankBalance($date,$member_type){
        	
        	
           $total_bal=0;$total_min=0;
                      $data=mysql_query("select sk_member_id,member_name,acc_no FROM mst_member where member_status='active' and member_type='6'");
                while($info = mysql_fetch_array( $data ))
                {
                	
                	$balance=0;
                	$bank_id=$info["sk_member_id"];
                	$supplier = mysql_query("SELECT credit, debit from txn_transaction where member_id='$bank_id' and tran_date<='$date' and tran_type='Bank' and tran_status='active'");
                	while($supplier1 = mysql_fetch_array( $supplier ))
                	{
                		{
                			$balance=$balance+$supplier1['credit'];
                			$balance=$balance-$supplier1['debit'];
                			
                		}
                	}
                	if($balance<0){
					$total_min=$total_min+$balance;
					}else{
                	$total_bal=$total_bal+$balance;
                	}
                }
                	return $total_bal;
        }
        
         function getBankLoanBalance($date,$member_type){
        	
        	
           $total_bal=0;$total_min=0;
                      $data=mysql_query("select sk_member_id,member_name,acc_no FROM mst_member where member_status='active' and member_type='6'");
                while($info = mysql_fetch_array( $data ))
                {
                	
                	$balance=0;
                	$bank_id=$info["sk_member_id"];
                	$supplier = mysql_query("SELECT credit, debit from txn_transaction where member_id='$bank_id' and tran_date<='$date' and tran_type='Bank' and tran_status='active'");
                	while($supplier1 = mysql_fetch_array( $supplier ))
                	{
                		{
                			$balance=$balance+$supplier1['credit'];
                			$balance=$balance-$supplier1['debit'];
                			
                		}
                	}
                	if($balance<0){
					$total_min=$total_min+$balance;
					}else{
                	$total_bal=$total_bal+$balance;
                	}
                }
                	return $total_min;
        }
        
        function stockValue($date){
        	
        	$dateFilter=" and bill_date<='$date'";
        	$data12 = mysql_query("SELECT item_id,category FROM items WHERE item_status='active' order by category asc");
while($info12 = mysql_fetch_array($data12))
{
	$item_id=$info12["item_id"];
	$data13 = mysql_query("SELECT distinct(description) FROM txn_bill_support WHERE particular_id='$item_id' and bill_for='Supplier'");
	while($info13 = mysql_fetch_array($data13))
	{	 
		$desc=$info13[0];
$data = mysql_query("SELECT sum(qty_in_sft), sum(amount),sum(landing_cost) FROM txn_bill_support WHERE particular_id='$item_id' and bill_for='Supplier' and description='$desc' $dateFilter");
while($info = mysql_fetch_array($data))
{
	$pur_qty=$info[0];
	$pur_rate=$info[1];
	$rack_id=0;
	$landing_cost=0;//$info[3];
	
	if($landing_cost==0)
	{
		
		$data4 = mysql_query("SELECT landing_cost FROM txn_bill_support WHERE particular_id='$item_id' and bill_for='Supplier' and description='$desc' $dateFilter");
		while($info4 = mysql_fetch_array($data4))
		{
			$landing_cost=$info4["landing_cost"];
		}
	}
	
	
	$sessing_qty=0;
	$sessing_rate=0;
	$sessing_cost=0;
	
$data2 = mysql_query("SELECT rate FROM txn_bill_support WHERE particular_id='$item_id' and bill_for='Customer' and description='$desc' $dateFilter");
	while($info2 = mysql_fetch_array($data2))
	{
		$sessing_rate=$info2[0];
	}
	
	$data2 = mysql_query("SELECT sum(qty_in_sft), sum(amount) FROM txn_bill_support WHERE particular_id='$item_id' and bill_for='Customer' and description='$desc' $dateFilter");
	while($info2 = mysql_fetch_array($data2))
	{
		$sessing_qty=$info2[0];
		
		$sessing_cost=$info2[1];
	}
	
	$r_sessing_qty=0;$r_sessing_qty_p=0;
	$data2 = mysql_query("SELECT sum(qty_in_sft),sum(qty_in_piece) FROM txn_bill_support WHERE particular_id='$item_id' and bill_for='Customer' and bill_type like '%Return%' and description='$desc' $dateFilter order by bill_date desc");
	while($info2 = mysql_fetch_array($data2))
	{
		$r_sessing_qty=$info2[0];
		$r_sessing_qty_p=$info2[1];	
	}
	
	$o_sessing_qty=0;
  $data2 = mysql_query("SELECT sum(remaining_qty) FROM stock WHERE flower_name='$item_id' and description='$desc'");
              while($info2 = mysql_fetch_array($data2))
              {
              	$o_sessing_qty=$info2[0];
              }
              
	$sessing_qty=$sessing_qty+$r_sessing_qty;
	
	$item_name="";
	$data1 = mysql_query("SELECT item_id, item_name FROM items WHERE item_id='$item_id'");
	while($info1 = mysql_fetch_array($data1))
	{
		$item_name=$info1["item_name"];
	}
	
	$data5 = mysql_query("SELECT rack_name from rack where rack_id='$rack_id'");
	$rack_name='';
	while($info5 = mysql_fetch_array( $data5 ))
	{
		$rack_name=$info5['rack_name'];
			
	}
	
	$data5 = mysql_query("SELECT mrp from stock where flower_name='$item_id' and description='$desc'");
	$mrp=0;
	while($info5 = mysql_fetch_array( $data5 ))
	{
		$mrp=$info5['mrp'];
			
	}
	$temp_cost="";
	if($sessing_rate==0)
	{
		$temp_cost="#F5D0A9";
		$sessing_rate=$landing_cost+(($landing_cost*15)/100);
	}
	

	$t_p=$t_p+($pur_qty*$landing_cost);
	$t_s=$t_s+$sessing_cost+($o_sessing_qty*$sessing_rate);
	$selling_purchase=$selling_purchase+($sessing_qty*$landing_cost)+($o_sessing_qty*$landing_cost);

	$selling_p=$sessing_qty*$landing_cost;
	$color="#CEF6CE";
	if(($selling_p+($o_sessing_qty+$landing_cost))>($sessing_cost+($sessing_rate*$sessing_rate)))
	{
		$color="red";
	}
	$available_qty=$pur_qty-$sessing_qty;
	
	$available_cost_t=$available_cost_t+(($available_qty-$o_sessing_qty)*$landing_cost);
}
	}}
                                  return number_format((float)$available_cost_t, 0, '.', '');
        }
        ?>
 </div><!-- /.content-wrapper -->
 <?php include_once "$D_PATH/include/footer.php";?>

  <!-- Control Sidebar -->
 <?php include_once "$D_PATH/include/side_container.php";?> 
 <script type="text/javascript">
				function getList(val)
				{
					removeOptions(document.getElementById("party"),status);
					
					var xmlhttp;			 
					 if (window.XMLHttpRequest)
					   {// code for IE7+, Firefox, Chrome, Opera, Safari
					   xmlhttp=new XMLHttpRequest();
					   }
					 else
					   {// code for IE6, IE5
					   xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
					   }
					 xmlhttp.onreadystatechange=function()
					   {
					   if (xmlhttp.readyState==4 && xmlhttp.status==200)
					     {
						   var status=xmlhttp.responseText;

						
			                  var temp1=status.split("//");
			                  
			                  for (var n=1;n<=temp1.length;n++)
			                  {              
			                	  temp2=temp1[n].split("#");
			                	  		          	
			                  document.getElementById("party").options[n]=new Option(temp2[1],temp2[0]);
			                
			                  }



						   
					     }
					   }

					 var D_PATH=document.getElementById("D_PATH").value
						var DIR=document.getElementById("DIR").value
						var session_branch=document.getElementById("session_branch").value
					 xmlhttp.open("GET",D_PATH+"/"+DIR+"/load/getList.php?tran_type="+val+"&session_branch="+session_branch,true);
					 xmlhttp.send();

				}

				function removeOptions(selectbox,status)
				{
				    var i;
				    for(i=selectbox.options.length-1;i>=0;i--)
				    {
				        selectbox.remove(i);
				    }
				    selectbox.innerHTML=status;
				    
				}
                </script>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<?php include_once "$D_PATH/include/scripts_bottom.php";?> 
</body>
</html>