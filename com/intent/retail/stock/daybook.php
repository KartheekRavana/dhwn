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
	  
	   $other_income_ledger=0;
     $data = mysql_query("SELECT sk_tran_id,tran_date,credit,tran_desc,member_id FROM txn_transaction where tran_type='Income' and credit>0 $q");
	 while($info = mysql_fetch_array( $data ))
	 {      
		$other_income_ledger=$other_income_ledger+$info["credit"];  
	  }
	  

	  
	  $hand_loan=0;
      $data = mysql_query("SELECT sk_tran_id,tran_date,debit,tran_desc,member_id FROM txn_transaction where tran_type='Hand Loan' and debit>0 and tran_desc!='Ledger Balance' $q");
	  while($info = mysql_fetch_array( $data ))
	  {   
	    $hand_loan=$hand_loan+$info["debit"];   
	  }
    
	  //************************************
	   $expense=0;
                    $data = mysql_query("SELECT sk_tran_id,tran_date,debit,tran_desc,member_id,note FROM txn_transaction where tran_type='Expense' and debit>0 $q");
	                	while($info = mysql_fetch_array( $data ))
	                	{      
						
	                		   $expense=$expense+$info["debit"]; 
	                	}
	                	
                    $data = mysql_query("SELECT sk_tran_id,tran_date,debit,tran_desc,member_id,note FROM txn_transaction where tran_type='Vat' and transaction_ref_id=0 and tran_desc='Payment' and debit>0 $q");
	                	while($info = mysql_fetch_array( $data ))
	                	{      
						
	                		   $expense=$expense+$info["debit"]; 
	                	}
	          $data = mysql_query("SELECT sk_tran_id,tran_date,debit,tran_desc,member_id,note FROM txn_transaction where tran_type='Bank' and tran_desc='Vat Payment' and debit>0 $q");
	          while($info = mysql_fetch_array( $data ))
	                	{  
	                		 $expense=$expense+$info["debit"]; 
	                	}
	                	
                    $data = mysql_query("SELECT sk_bill_id,purchase_exp,member_id FROM mst_bill_main where purchase_exp>0 and bill_date<'$from_date'");
	                	while($info = mysql_fetch_array( $data ))
	                	{      
					
	                		   $expense=$expense+$info["purchase_exp"];  
	                	}
	   $supplier_payments=0;
                    $data = mysql_query("SELECT sk_tran_id,tran_date,debit,tran_desc,member_id,transaction_ref_id FROM txn_transaction where tran_type='Bank' and tran_desc='Supplier Withdraw' and debit>0 $q");
	                	while($info = mysql_fetch_array( $data ))
	                	{ 
	                		  $supplier_payments=$supplier_payments+$info["credit"];  
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
	                	
	                	$customer_return=0;
                    $data = mysql_query("SELECT sk_tran_id,tran_date,credit,tran_desc,member_id,transaction_ref_id FROM txn_transaction where tran_type='Customer' and tran_desc='Payment Return' and credit>0 $q");
	                	while($info = mysql_fetch_array( $data ))
	                	{      
						
		                	
	                		   $customer_return=$customer_return+$info["credit"];  
	                	}
	                	 $data = mysql_query("SELECT sk_tran_id,tran_date,credit,tran_desc,member_id,transaction_ref_id FROM txn_transaction where tran_type='Customer' and tran_desc='Return Bill' and credit>0 $q");
	                	while($info = mysql_fetch_array( $data ))
	                	{      
						 $customer_return=$customer_return+$info["credit"];   
	                	}
	                	
	                	$opening=($received_amt+$credit_payment+$bank_withdraw+$hand_loan+$other_income_ledger)-($expense+$customer_return+$supplier_payments+$bank_deposit+$transport+$agent_com+$employee_payment+$partner_payment+$hand_loan_issue+$hamali+$rent);
	  $opening=($opening+52270+230628)-250482;
	  
	 
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
                  <h3 class="box-title">DayBook</h3> 
                  
                 <label style="float: right;"><a href="?action=expenses&c=reports">Add Expense</a></label>
                    
                  
                </div><!-- /.box-header -->
                <div class="box-body">
                
                <form action='?action=operations/save&c=reports' method="POST">
                <input type='hidden' name="session_branch" id="session_branch" value="<?php echo $session_branch?>">
                <input type='hidden' name="session_id" id="session_id" value="<?php echo $session_id?>">
                
                <div class="form-group col-md-2">
                	<input type="date" name="date" id="date" value="<?php echo $date?>" class="form-control" style="padding: 0">
                </div>
                <div class="form-group col-md-2">
                	<select name="tran_type" id="tran_type" class="form-control" onchange="getList(this.value)">
                 		<option value="">Tran Type</option>
                 		<option value="Expenses">Expenses</option>
                		<option value="Customer">Customer</option>
                		<option value="Supplier">Supplier</option>
                		
                		<option value="Auto">Transport</option>
                		<option value="Agent">Agent</option>
                		<option value="Employee">Employee</option>
                		<option value="Partner">Partner</option>
                		<option value="Bank">Bank</option>
                		<option value="Hand Loan">Hand Loan</option>
                		<option value="Hamali">Hamali</option>
                		<option value="Rent">Rent</option>
                		<option value="Investment">Investment</option>
                		<option value="Vat">Vat</option>
                		
                </select>
                </div>
                <div class="form-group col-md-2">
                	<select name="party" id="party" class="form-control select2">
               			<option value="">List</option>
                	</select>
                </div>    
                  <div class="form-group col-md-2">
                	<select class="form-control" id="pay_type" name="pay_type">
	               <option value="Cash">Cash</option>
	                <?php 
                                   
                                  $data = mysql_query("SELECT sk_member_id,member_name FROM mst_member where member_type=6");
                                  if($data)
                                  while($info = mysql_fetch_array( $data ))
                                  {
                                  ?>  
	               <option  value="<?php echo $info["sk_member_id"]?>">BANK - <?php echo $info["member_name"]?></option>
	               <?php }?>
	               </select>
                </div> 
                 <div class="form-group col-md-2">
                	<select name="tran_desc" id="tran_desc" class="form-control">
               			<option value="Pay">Pay</option>
               			<option value="Return">Return/Deposit</option>
                	</select>
                </div>  
                  <div class="form-group col-md-2">
                	<input type="text" name="amt" id="amt" class="form-control" placeholder="Amount" autocomplete="off">
                </div>  
                <div class="form-group col-md-2">
                	<input type="text" name="note" id="note" class="form-control" placeholder="Note">
                </div>  
                <div class="form-group col-md-2">
                	<input type="submit" value="Save" class='btn btn-success'>
                </div>  
                
             
             </form>
                </div>
                </div>
                </div>
                <div class="col-md-3">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">DayBook Report</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                
                <form action='?action=financial&c=reports'>
                <input type="hidden" name="action" value="daybook">
                <input type="hidden" name="c" value="reports">
                     <table>
                      <tr><td>Date</td><td>	          
                        <input type='date' name='from_date' class="form-control" id="inputDate" value='<?php  if(isset($_GET['from_date'])){echo $_GET['from_date'];}else{ echo $date1;}?>'>
                        </td></tr><tr><td></td><td>
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
           $q=" and tran_date between '".$_GET["from_date"]."' and '".$_GET["from_date"]."' and tran_status='active'";
           
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
                        <th>Received From</th> 
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
	                		        
                    ?><tr>
                    	<td><a href="?action=sales_edit&c=inventory&bill_no=<?php echo $info["transaction_ref_id"]?>"><?php echo $slip_no?></a></td>
                  
                    <td>Cash</td>
                    <td><?php echo $member_name?></td>
                    <td><?php echo $info["debit"]?></td>
                    </tr>
                    
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
                    ?><tr>
                    	<td><a href="?action=statement&c=members&cid=<?php echo $member_id?>"><?php echo $slip_no?></a></td>
                  
                    <td>Credit</td>
                    <td><?php echo $member_name?></td>
                    <td><?php echo $info["debit"]?></td>
                    </tr>
                    
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
		                	
	                		        
                    ?><tr>
                    	<td><?php echo $slip_no?></td>
                  
                    <td>Supplier</td>
                    <td><?php echo $member_name?></td>
                    <td><a href='javascript:void(0)'  data-toggle="modal" data-target="#myModal" onclick="setData(<?php echo $info["sk_tran_id"]?>,<?php echo $info["credit"]?>,'<?php echo $member_name?>','credit')"><?php echo $info["credit"]?></a></td>
                    </tr>
                    
                    <?php }?>    
                                    </tbody>
                                    <tfoot>
                                    <tr><td></td><td></td><td></td><td><?php echo $received_amt?></td></tr>
                                    </tfoot>
                  </table>
                  
                </div><!-- /.box-body -->
              </div><!-- /.box -->
                    
    
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Customer Credit Payment</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                <table id="" class="table table-bordered table-striped" style="font-size: 12px">
                    <thead>
                      <tr>
                        <th>Ref No</th>
                        <th>Description</th>
                        <th>Received From</th> 
                        <th>Amount</th>
                      </tr>
                    </thead>
                    <tbody id='div_print' style="font-size: 12px;">
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
                    ?><tr>
                    	<td><a href="?action=statement&c=members&cid=<?php echo $member_id?>"><?php echo $info["sk_tran_id"]?></a></td>
                  
                    <td><?php echo $info["tran_desc"]?></td>
                    <td><?php echo $member_name?></td>
                    <td><a href='javascript:void(0)'  data-toggle="modal" data-target="#myModal" onclick="setData(<?php echo $info["sk_tran_id"]?>,<?php echo $info["debit"]?>,'<?php echo $info["tran_desc"]?>','debit')"><?php echo $info["debit"]?></a></td>
                    </tr>
                    
                    <?php }}?>
                     
                                </tbody>
                                    <tfoot>
                                    <tr><td></td><td></td><td></td><td><?php echo $credit_payment?></td></tr>
                                    </tfoot>
                  </table>
                  
                </div><!-- /.box-body -->
              </div><!-- /.box -->
              
              
              
              
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Other Income</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                <table id="" class="table table-bordered table-striped" style="font-size: 12px">
                    <thead>
                      <tr>
                        <th>Date</th>
                        <th>Note</th>
                        
                        <th>Amount</th>
                      </tr>
                    </thead>
                    <tbody id='div_print' style="font-size: 12px;">
                    <?php 
                  
                    $other_income=0;
                    $data = mysql_query("SELECT sk_tran_id,tran_date,credit,tran_desc,member_id FROM txn_transaction where tran_type='Income' and credit>0 $q");
	                	while($info = mysql_fetch_array( $data ))
	                	{      
						
	                		
	                		    $other_income=$other_income+$info["credit"];  

	                		   if($info["credit"]>0){
                    ?><tr>
                    	<td><a href="?action=income_edit&c=stock&tran_id=<?php echo $info['sk_tran_id']?>"><?php echo $info["tran_date"]?></a></td>
                  
                    <td><?php echo $info["note"]?></td>
                    <td><?php echo $info["credit"];?></td>
                    </tr>
                    
                    <?php }}?>
                     
                                </tbody>
                                    <tfoot>
                                    <tr><td></td><td></td><td><?php echo $other_income?></td></tr>
                                    </tfoot>
                  </table>
                  
                </div><!-- /.box-body -->
              </div><!-- /.box -->
              
              
             
              
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Bank Withdrawals</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                <table id="" class="table table-bordered table-striped" style="font-size: 12px">
                    <thead>
                      <tr>
                        <th>Ref No</th>
                          <th>From </th> 
                        <th>Description</th>
                      
                        <th>Amount</th>
                      </tr>
                    </thead>
                    <tbody id='div_print' style="font-size: 12px;">
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
                    ?><tr>
                    	<td><a href="?action=view&c=transactions&bank_id=<?php echo $member_id?>"><?php echo $info["sk_tran_id"]?></a></td>
                  <td><?php echo $member_name?></td>
                    <td><?php if($info["tran_desc"]=="Auto Payment"){echo "Transport : ".$info["note"];}else{echo $info["tran_desc"];}?></td>
                    
                    <td><a href='javascript:void(0)'  data-toggle="modal" data-target="#myModal" onclick="setData(<?php echo $info["sk_tran_id"]?>,<?php echo $info["debit"]?>,'<?php echo $info["tran_desc"]?>','debit')"><?php echo $info["debit"]?></a></td>
                    </tr>
                    
                    <?php }?>
                                </tbody>
                                    <tfoot>
                                    <tr><td></td><td></td><td></td><td><?php echo $bank_withdraw?></td></tr>
                                    </tfoot>
                  </table>
                  
                </div><!-- /.box-body -->
              </div><!-- /.box -->
                    <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Loan Collection</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                <table id="" class="table table-bordered table-striped" style="font-size: 12px">
                    <thead>
                      <tr>
                        <th>Ref No</th>
                        <th>Description</th>
                        <th>Paid To</th> 
                        <th>Amount</th>
                      </tr>
                    </thead>
                    <tbody id='div_print' style="font-size: 12px;">
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
                    ?><tr>
                    	<td><a href="?action=statement&c=members&cid=<?php echo $member_id?>"><?php echo $info["sk_tran_id"]?></a></td>
                  
                    <td><?php echo $info["tran_desc"]?></td>
                    <td><?php echo $member_name?></td>
                    <td><a href='javascript:void(0)' data-toggle="modal" data-target="#myModal"  onclick="setData(<?php echo $info["sk_tran_id"]?>,<?php echo $info["debit"]?>,'<?php echo $info["tran_desc"]?>','debit')"><?php echo $info["debit"]?></a></td>
                    </tr>
                    
                    <?php }?>
                                </tbody>
                                    <tfoot>
                                    <tr><td></td><td></td><td></td><td><?php echo $hand_loan?></td></tr>
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
                        <th>Ref No</th>
                        <th>Purpose</th>
                        <th>Details</th> 
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
                    ?><tr>
                    	<td><?php echo $info["sk_tran_id"]?></td>
                   <td><?php echo $member_name?></td>
                    <td><?php echo $info["note"]?></td>
                   
                    <td><a href="javascript:void(0)" onclick="setData(<?php echo $info["sk_tran_id"]?>,<?php echo $info["debit"]?>,'<?php echo $member_name?>','debit')" data-toggle="modal" data-target="#myModal"><?php echo $info["debit"]?></a></td>
                    </tr>
                    
                    <?php }
                    
             $data = mysql_query("SELECT sk_tran_id,tran_date,debit,tran_desc,member_id,note FROM txn_transaction where tran_type='Bank' and tran_desc='Vat Payment' and debit>0 $q");
	                	while($info = mysql_fetch_array( $data ))
	                	{      
						$member_name="Bank";
						
	                		   $expense=$expense+$info["debit"];     
                    ?><tr>
                    	<td><?php echo $info["sk_tran_id"]?></td>
                   <td><?php echo $member_name?></td>
                    <td><?php echo $info["note"]?></td>
                   
                    <td><a href="javascript:void(0)" onclick="setData(<?php echo $info["sk_tran_id"]?>,<?php echo $info["debit"]?>,'<?php echo $member_name?>','debit')" data-toggle="modal" data-target="#myModal"><?php echo $info["debit"]?></a></td>
                    </tr>
                    
                    <?php }
                    
             $data = mysql_query("SELECT sk_tran_id,tran_date,debit,tran_desc,member_id,note FROM txn_transaction where tran_type='Rent' and tran_desc='Payment' and debit>0 $q");
	                	while($info = mysql_fetch_array( $data ))
	                	{      
						$member_name="Rent";
						
	                		   $expense=$expense+$info["debit"];     
                    ?><tr>
                    	<td><?php echo $info["sk_tran_id"]?></td>
                   <td><?php echo $member_name?></td>
                    <td style="overflow: auto;width: 200px"><?php echo $info["note"]?></td>
                   
                    <td><a href="javascript:void(0)" onclick="setData(<?php echo $info["sk_tran_id"]?>,<?php echo $info["debit"]?>,'<?php echo $member_name?>','debit')" data-toggle="modal" data-target="#myModal"><?php echo $info["debit"]?></a></td>
                    </tr>
                    
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
                    ?><tr>
                    	<td><?php echo $info["sk_tran_id"]?></td>
                   <td><?php echo $member_name?></td>
                    <td><?php echo $info["note"]?></td>
                   
                    <td><a href="javascript:void(0)" onclick="setData(<?php echo $info["sk_tran_id"]?>,<?php echo $info["debit"]?>,'<?php echo $member_name?>','debit')" data-toggle="modal" data-target="#myModal"><?php echo $info["debit"]?></a></td>
                    </tr>
                    
                    <?php }
                   
                   
                    $data = mysql_query("SELECT sk_bill_id,purchase_exp,member_id FROM mst_bill_main where purchase_exp>0 and bill_date='".$_GET["from_date"]."'");
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
                    ?><tr>
                    	<td><a href=""><?php echo $info["sk_bill_id"]?></a></td>
                   <td><?php echo $member_name?></td>
                    <td>Purchase Expense</td>
                   
                    <td><?php echo $info["purchase_exp"]?></td>
                    </tr>
                    
                    <?php }
                    
                    
                    ?>
                                </tbody>
                                    <tfoot>
                                    <tr><td></td><td></td><td></td><td><?php echo $expense?></td></tr>
                                    </tfoot>
                  </table>
                  
                </div><!-- /.box-body -->
              </div><!-- /.box -->
              
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Supplier Payments</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                <table id="" class="table table-bordered table-striped" style="font-size: 12px">
                    <thead>
                      <tr>
                        <th>Ref No</th>
                        <th>From</th>
                        <th>Paid To</th> 
                        <th>Amount</th>
                      </tr>
                    </thead>
                    <tbody id='div_print' style="font-size: 12px;">
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
                    ?><tr>
                    	<td><a href="?action=statement&c=members&cid=<?php echo $member_id?>"><?php echo $info["sk_tran_id"]?></a></td>
                  
                    <td><?php echo $bank_name?></td>
                    <td><?php echo $supplier_name?></td>
                   
                    <td><a href="javascript:void(0)" onclick="setData(<?php echo $info["sk_tran_id"]?>,<?php echo $info["debit"]?>,'<?php echo $bank_name?>','debit')" data-toggle="modal" data-target="#myModal"><?php echo $info["debit"]?></a></td>
                    </tr>
                    
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
                    ?><tr>
                    	<td><a href="?action=statement&c=members&cid=<?php echo $member_id?>"><?php echo $info["sk_tran_id"]?></a></td>
                  
                    <td><?php echo $info["tran_desc"]?></td>
                    <td><?php echo $member_name?></td>
                    <td><a href="javascript:void(0)" onclick="setData(<?php echo $info["sk_tran_id"]?>,<?php echo $info["debit"]?>,'<?php echo $member_name?>','debit')" data-toggle="modal" data-target="#myModal"><?php echo $info["debit"]?></a></td>
                    </tr>
                    
                    <?php }}?>
                                </tbody>
                                    <tfoot>
                                    <tr><td></td><td></td><td></td><td><?php echo $supplier_payments?></td></tr>
                                    </tfoot>
                  </table>
                  
                </div><!-- /.box-body -->
              </div><!-- /.box -->
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title"> Return Expense</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                <table id="" class="table table-bordered table-striped" style="font-size: 12px">
                    <thead>
                      <tr>
                        <th>Ref No</th>
                        <th>To</th>
                        <th>Particular</th> 
                        <th>Amount</th>
                      </tr>
                    </thead>
                    <tbody id='div_print' style="font-size: 12px;">
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
                    ?><tr>
                    	<td><a href="?action=statement&c=members&cid=<?php echo $member_id?>"><?php echo $info["sk_tran_id"]?></a></td>
                  
                    <td><?php echo $bank_name?></td>
                    <td><?php echo $supplier_name?></td>
                   
                    <td><a href='javascript:void(0)'  data-toggle="modal" data-target="#myModal" onclick="setData(<?php echo $info["sk_tran_id"]?>,<?php echo $info["credit"]?>,'<?php echo $bank_name?>','credit')"><?php echo $info["credit"]?></a></td>
                    </tr>
                    
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
                    ?><tr>
                    	<td><a href="?action=statement&c=members&cid=<?php echo $member_id?>"><?php echo $info["sk_tran_id"]?></a></td>
                  
                    <td><?php echo $bank_name?></td>
                    <td>Return Bill</td>
                   
                    <td><a href='javascript:void(0)'  data-toggle="modal" data-target="#myModal" onclick="setData(<?php echo $info["sk_tran_id"]?>,<?php echo $info["credit"]?>,'<?php echo $bank_name?>','credit')"><?php echo $info["credit"]?></a></td>
                    </tr>
                    
                    <?php }?>
                    
                                </tbody>
                                    <tfoot>
                                    <tr><td></td><td></td><td></td><td><?php echo $customer_return?></td></tr>
                                    </tfoot>
                  </table>
                  
                </div><!-- /.box-body -->
              </div><!-- /.box -->
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Bank Deposit</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                <table id="" class="table table-bordered table-striped" style="font-size: 12px">
                    <thead>
                      <tr>
                        <th>Ref No</th>
                        <th>Description</th>
                        <th>Paid To</th> 
                        <th>Amount</th>
                      </tr>
                    </thead>
                    <tbody id='div_print' style="font-size: 12px;">
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
                    ?><tr>
                    	<td><a href="?action=view&c=transactions&bank_id=<?php echo $member_id?>"><?php echo $info["sk_tran_id"]?></a></td>
                  
                    <td><?php echo $info["tran_desc"]?></td>
                    <td><?php echo $member_name?></td>
                    <td><a href='javascript:void(0)'  data-toggle="modal" data-target="#myModal" onclick="setData(<?php echo $info["sk_tran_id"]?>,<?php echo $info["credit"]?>,'<?php echo $info["tran_desc"]?>','credit')"><?php echo $info["credit"]?></a></td>
                    </tr>
                    
                    <?php }?>
                                </tbody>
                                    <tfoot>
                                    <tr><td></td><td></td><td></td><td><?php echo $bank_deposit?></td></tr>
                                    </tfoot>
                  </table>
                  
                </div><!-- /.box-body -->
              </div><!-- /.box -->
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Transport</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                <table id="" class="table table-bordered table-striped" style="font-size: 12px">
                    <thead>
                      <tr>
                        <th>Ref No</th>
                        <th>Description</th>
                        <th>Paid To</th> 
                        <th>Amount</th>
                      </tr>
                    </thead>
                    <tbody id='div_print' style="font-size: 12px;">
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
                    ?><tr>
                    	<td><a href="?action=statement&c=members&cid=<?php echo $member_id?>"><?php echo $info["sk_tran_id"]?></a></td>
                  
                    <td><?php echo $info["note"]?></td>
                    <td><?php echo $member_name?></td>
                    <td><a href='javascript:void(0)'  data-toggle="modal" data-target="#myModal" onclick="setData(<?php echo $info["sk_tran_id"]?>,<?php echo $info["debit"]?>,'<?php echo $info["tran_desc"]?>','debit')"><?php echo $info["debit"]?></a></td>
                    </tr>
                    
                    <?php }?>
                                </tbody>
                                    <tfoot>
                                    <tr><td></td><td></td><td></td><td><?php echo $transport?></td></tr>
                                    </tfoot>
                  </table>
                  
                </div><!-- /.box-body -->
              </div><!-- /.box -->
                 <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Agent Comission</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                <table id="" class="table table-bordered table-striped" style="font-size: 12px">
                    <thead>
                      <tr>
                        <th>Ref No</th>
                        <th>Description</th>
                        <th>Paid To</th> 
                        <th>Amount</th>
                      </tr>
                    </thead>
                    <tbody id='div_print' style="font-size: 12px;">
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
                    ?><tr>
                    	<td><a href="?action=statement&c=members&cid=<?php echo $member_id?>"><?php echo $info["sk_tran_id"]?></a></td>
                  
                    <td><?php echo $info["tran_desc"]?></td>
                    <td><?php echo $member_name?></td>
                    <td><a href='javascript:void(0)'  data-toggle="modal" data-target="#myModal" onclick="setData(<?php echo $info["sk_tran_id"]?>,<?php echo $info["debit"]?>,'<?php echo $info["tran_desc"]?>','debit')"><?php echo $info["debit"]?></a></td>
                    </tr>
                    
                    <?php }?>
                                </tbody>
                                    <tfoot>
                                    <tr><td></td><td></td><td></td><td><?php echo $agent_com?></td></tr>
                                    </tfoot>
                  </table>
                  
                </div><!-- /.box-body -->
              </div><!-- /.box -->
              
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Employee Payment</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                <table id="" class="table table-bordered table-striped" style="font-size: 12px">
                    <thead>
                      <tr>
                        <th>Ref No</th>
                        <th>Description</th>
                        <th>Paid To</th> 
                        <th>Amount</th>
                      </tr>
                    </thead>
                    <tbody id='div_print' style="font-size: 12px;">
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
                    ?><tr>
                    	<td><a href="?action=statement&c=members&cid=<?php echo $member_id?>"><?php echo $info["sk_tran_id"]?></a></td>
                  
                    <td><?php echo $info["tran_desc"]?></td>
                    <td><?php echo $member_name?></td>
                    <td><a href='javascript:void(0)'  data-toggle="modal" data-target="#myModal" onclick="setData(<?php echo $info["sk_tran_id"]?>,<?php echo $info["debit"]?>,'<?php echo $info["tran_desc"]?>','debit')"><?php echo $info["debit"]?></a></td>
                    </tr>
                    
                    <?php }?>
                                </tbody>
                                    <tfoot>
                                    <tr><td></td><td></td><td></td><td><?php echo $employee_payment?></td></tr>
                                    </tfoot>
                  </table>
                  
                </div><!-- /.box-body -->
              </div><!-- /.box -->
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Partner Payment</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                <table id="" class="table table-bordered table-striped" style="font-size: 12px">
                    <thead>
                      <tr>
                        <th>Ref No</th>
                        <th>Description</th>
                        <th>Paid To</th> 
                        <th>Amount</th>
                      </tr>
                    </thead>
                    <tbody id='div_print' style="font-size: 12px;">
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
                    ?><tr>
                    	<td><a href="?action=statement&c=members&cid=<?php echo $member_id?>"><?php echo $info["sk_tran_id"]?></a></td>
                  
                    <td><?php echo $info["tran_desc"]?></td>
                    <td><?php echo $member_name?></td>
                    <td><a href='javascript:void(0)'  data-toggle="modal" data-target="#myModal" onclick="setData(<?php echo $info["sk_tran_id"]?>,<?php echo $info["debit"]?>,'<?php echo $info["tran_desc"]?>','debit')"><?php echo $info["debit"]?></a></td>
                    </tr>
                    
                    <?php }?>
                                </tbody>
                                    <tfoot>
                                    <tr><td></td><td></td><td></td><td><?php echo $partner_payment?></td></tr>
                                    </tfoot>
                  </table>
                  
                </div><!-- /.box-body -->
              </div><!-- /.box -->
              
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Hand Loan</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                <table id="" class="table table-bordered table-striped" style="font-size: 12px">
                    <thead>
                      <tr>
                        <th>Ref No</th>
                        <th>Description</th>
                        <th>Paid To</th> 
                        <th>Amount</th>
                      </tr>
                    </thead>
                    <tbody id='div_print' style="font-size: 12px;">
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
                    ?><tr>
                    	<td><a href="?action=statement&c=members&cid=<?php echo $member_id?>"><?php echo $info["sk_tran_id"]?></a></td>
                  
                    <td><?php echo $info["tran_desc"]?></td>
                    <td><?php echo $member_name?></td>
                    <td><a href='javascript:void(0)'  data-toggle="modal" data-target="#myModal" onclick="setData(<?php echo $info["sk_tran_id"]?>,<?php echo $info["credit"]?>,'<?php echo $info["tran_desc"]?>','credit')"><?php echo $info["credit"]?></a></td>
                    </tr>
                    
                    <?php }?>
                                </tbody>
                                    <tfoot>
                                    <tr><td></td><td></td><td></td><td><?php echo $hand_loan_issue?></td></tr>
                                    </tfoot>
                  </table>
                  
                </div><!-- /.box-body -->
              </div><!-- /.box -->
              
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Hamali</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                <table id="" class="table table-bordered table-striped" style="font-size: 12px">
                    <thead>
                      <tr>
                        <th>Ref No</th>
                        <th>Description</th>
                        <th>Paid To</th> 
                        <th>Amount</th>
                      </tr>
                    </thead>
                    <tbody id='div_print' style="font-size: 12px;">
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
                    ?><tr>
                    	<td><a href="?action=statement&c=members&cid=<?php echo $member_id?>"><?php echo $info["sk_tran_id"]?></a></td>
                  
                    <td><?php echo $info["tran_desc"]?></td>
                    <td><?php echo $member_name?></td>
                    <td><a href='javascript:void(0)'  data-toggle="modal" data-target="#myModal" onclick="setData(<?php echo $info["sk_tran_id"]?>,<?php echo $info["debit"]?>,'<?php echo $info["tran_desc"]?>','debit')"><?php echo $info["debit"]?></a></td>
                    </tr>
                    
                    <?php }?>
                                </tbody>
                                    <tfoot>
                                    <tr><td></td><td></td><td></td><td><?php echo $hamali?></td></tr>
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
                <?php 
                $inc=$received_amt+$credit_payment+$bank_withdraw+$hand_loan+$other_income;
                $exp=$expense+$customer_return+$supplier_payments+$bank_deposit+$transport+$agent_com+$employee_payment+$partner_payment+$hand_loan_issue+$hamali;
                ?>
                <table id="" class="table table-bordered table-striped" style="font-size: 12px">
                    <thead>
                      <tr><th>Opening Balance</th><td><?php echo $opening?></td></tr>
                      <tr><th>Income</th><td><?php echo  $inc?></td></tr>
                      <tr><th>Expenses</th><td><?php echo $exp?></td></tr>
                      <tr><th>Closing Balance</th><td><?php echo ($opening+$inc)-$exp?></td></tr> 
                        
                      </tr>
                    </thead>
                 
                    
                    </table>
                   
                    </div>
                    </div>
                    </div>
                 <?php }?>
          </div>   <!-- /.row -->
        </section><!-- /.content -->
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