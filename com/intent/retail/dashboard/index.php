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
      
      	<?php include_once "$D_PATH/include/header_dashboard.php";?>
  	
  <!-- Left side column. contains the logo and sidebar -->
  
    <?php include_once "$D_PATH/include/side.php";?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    
    <?php include_once "$D_PATH/include/navigation.php";?>
<?php 


$data = mysql_query("SELECT sk_member_id,salary from mst_member where member_status='active' and member_type='1'");
                            while($info = mysql_fetch_array( $data ))
                            {
                            	
                            	
                            	$employee_id=$info['sk_member_id'];
                            	date_default_timezone_set('Asia/Calcutta');
                            	$m_start=date("Y-m")."-1";
                            	$m_end=date("Y-m")."-31";
                            	$status='credit';
                            	$data1 = mysql_query("SELECT member_id from txn_transaction where member_id='$employee_id' and tran_type='Employee' and tran_desc='Salary Credit' and tran_date between '$m_start' and '$m_end'");
                            	while($info1 = mysql_fetch_array( $data1 ))
                            	{
	                            	$status='';
	                            	echo $status;
                            	}
                            	if($status=='credit')
                            	{
                            		$command = "SELECT MAX(sk_tran_id) as maxid FROM txn_transaction";
                            		$cNo=0;
                            		$result = mysql_query($command, $con);
                            		while ($row = mysql_fetch_assoc($result)){
                            			$cNo = $row['maxid'];
                            		}
                            		$cNo++;
                            		
                            		$query="INSERT INTO txn_transaction(sk_tran_id,tran_date,tran_time, credit, debit,member_id, transaction_ref_id, ref_table, tran_type, tran_desc, note,tran_status, employee_id, branch_id)
		VALUES ('$cNo','$date',now(),'".$info["salary"]."','0','$employee_id','0','mst_member','Employee','Salary Credit','','active','$session_id','$session_branch')";
		mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
                            	}
                            }
                            
                            $data = mysql_query("SELECT sk_member_id,salary from mst_member where member_status='active' and member_type='10'");
                            while($info = mysql_fetch_array( $data ))
                            {
                            	
                            	
                            	$employee_id=$info['sk_member_id'];
                            	date_default_timezone_set('Asia/Calcutta');
                            	$m_start=date("Y-m")."-1";
                            	$m_end=date("Y-m")."-31";
                            	$status='credit';
                            	$data1 = mysql_query("SELECT member_id from txn_transaction where member_id='$employee_id' and tran_type='Rent' and tran_desc='credit' and tran_date between '$m_start' and '$m_end'");
                            	while($info1 = mysql_fetch_array( $data1 ))
                            	{
	                            	$status='';
	                            	echo $status;
                            	}
                            	if($status=='credit')
                            	{
                            		$command = "SELECT MAX(sk_tran_id) as maxid FROM txn_transaction";
                            		$cNo=0;
                            		$result = mysql_query($command, $con);
                            		while ($row = mysql_fetch_assoc($result)){
                            			$cNo = $row['maxid'];
                            		}
                            		$cNo++;
                            		
                            		$query="INSERT INTO txn_transaction(sk_tran_id,tran_date,tran_time, credit, debit,member_id, transaction_ref_id, ref_table, tran_type, tran_desc, note,tran_status, employee_id, branch_id)
		VALUES ('$cNo','$date',now(),'".$info["salary"]."','0','$employee_id','0','mst_member','Rent','credit','','active','$session_id','$session_branch')";
		mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
                            	}
                            }


$collection=0;
              $q="";
              
              	$q=" and branch_id='$session_branch' and tran_status='active'";
              $day_credit_sale=0;
              $sql=mysql_query("select sum(credit) from txn_transaction where credit>0 and tran_date='$date' and tran_type='Customer' and tran_desc='New Bill' and note='Credit' $q");
              while($info=mysql_fetch_array($sql))
              {
              	$day_credit_sale=$info[0];
              }if($day_credit_sale==""){$day_credit_sale=0;}
              $day_credit_sale_paid=0;
              $sql=mysql_query("select sum(debit) from txn_transaction where debit>0 and tran_date='$date' and tran_type='Customer' and tran_desc='New Bill' and note='Credit' $q");
              while($info=mysql_fetch_array($sql))
              {
              	$day_credit_sale_paid=$info[0];
              }if($day_credit_sale_paid==""){$day_credit_sale_paid=0;}
              $day_cash_sale=0;
              $sql=mysql_query("select sum(credit) from txn_transaction where credit>0 and tran_date='$date' and tran_type='Customer' and tran_desc='New Bill' and note='Cash' $q");
              while($info=mysql_fetch_array($sql))
              {
              	$day_cash_sale=$info[0];
              }
              $day_cash_discount=0;
              $sql=mysql_query("select sum(discount) from mst_bill_main where bill_date='$date' and bill_type='Cash'");
              while($info=mysql_fetch_array($sql))
              {
              	$day_cash_discount=$info[0];
              }
              if($day_cash_discount==""){$day_cash_discount=0;}
             
 			  $day_expenses=0;
              $sql=mysql_query("select sum(debit) from txn_transaction where debit>0 and tran_date='$date' and tran_type='Expenses' $q");
              while($info=mysql_fetch_array($sql))
              {
              	$day_expenses=$info[0];
              }if($day_expenses==""){$day_expenses=0;}
              
              $total_investment=0;
              $sql=mysql_query("select sum(debit) from txn_transaction where credit>0 and tran_date='$date' and tran_type='Partner' and tran_desc='Investment' $q");
              while($info=mysql_fetch_array($sql))
              {
              	$total_investment=$info[0];
              }if($total_investment==""){$total_investment=0;}
              
              ?>
        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-2 col-xs-6">
              <!-- small box -->
              
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h5>Total Sale : <?php echo $day_credit_sale?></h5>
                  <h5>Cash Received : <?php echo $day_credit_sale_paid?></h5>
                  <p></p>
                </div>
                
                <a href="#" class="small-box-footer">Day Credit Sale <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-2 col-xs-6">
              <!-- small box -->
              
              <div class="small-box bg-green">
                <div class="inner">
                  <h5>Total Sale : <?php echo $day_cash_sale-$day_cash_discount?><sup style="font-size: 20px"></sup></h5>
                  <h5>Discount : <?php echo $day_cash_discount?></h5>
                </div>
               
                <a href="#" class="small-box-footer">Day Cash Sale <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-2 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h2><?php echo $day_expenses?></h2>
                  <p></p>
                </div>
                
                <a href="?action=new&c=expenses&branch_name=<?php echo $session_branch?>&date=<?php echo $date?>" class="small-box-footer">Day Expenses <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            
            <?php 
            if($session_type=="Director")
            {
            ?>
            <div class="col-lg-2 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h2><?php echo $total_investment?></h2>
                  
                </div>
               
                <a href="?action=partner_investment&c=partner" class="small-box-footer">Total Investment <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-4 col-xs-12">
              <!-- small box -->
             
             <section class="col-lg-12 col-md-12 connectedSortable">
              <!-- Custom tabs (Charts with tabs)-->
              <div class="nav-tabs-custom">
                <!-- Tabs within a box -->
                <ul class="nav nav-tabs pull-right">
                  <li class="active"><a href="#revenue-chart" data-toggle="tab"></a></li>
                  <li><a href="#sales-chart" data-toggle="tab"></a></li>
                  <li class="pull-left header"><i class="fa fa-money"></i>Out Standing</li>
                </ul>
                <div class="tab-content no-padding">
               
                <table id="" class="table table-bordered table-striped" style="font-size: 12px">
                    <thead>
                      <tr><th>Day Opening</th><th>0</th></tr>
                       
                       <tr><th>Day In</th><th>0</th></tr>
                      <tr><th>Day Closing</th><th>0</th></tr>
                    </thead>
               
                 </table>
                </div>
              </div><!-- /.nav-tabs-custom -->

              <!-- Chat box -->
              
              <!-- TO DO List -->
              

              <!-- quick email widget -->
              
            </section>
            </div><!-- ./col -->
            <!-- ./col -->
            <?php }?>
          </div><!-- /.row -->
          <!-- Main row -->
          <div class="row">
            <!-- Left col -->
            <div class="col-md-6">
             

              <div class="box" style="overflow: auto;">
                <div class="box-header">
                
                </div><!-- /.box-header -->
                <div class="box-body">
                
                  <table id="example1" class="table table-bordered table-striped" style="font-size: 12px">
                 
                    <thead>
                      <tr>
                         <th class="info"></th>
						 <th>Ad.By</th>
                                       <th>Customer&nbsp;Name</th><th>Mobile</th>
                    <th>PickDate</th><th>Type</th>
                                         <th>Total</th>
                                        <th class="actions">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                       <?php 
                                
                                   $i=1;
                                  $total=0;$loginId="";$addedBy="";
                                  $data = mysql_query("SELECT bill_no, customer_id, bill_date,phone,city, total, comm, lug_exp, prev_bal, total_bal, amount_paid, final_bal, login_id, branch, customer_name, partner_id, check_payment, cashe_payment, discount FROM customerpickermain where payment_status='Done'");
                                  while($info = mysql_fetch_array( $data ))
                                  {
                                  	$slip_no=$info['bill_no'];
                                 	$loginId=$info['login_id'];                          	
                                  	$customerid=$info['customer_id'];
                                  $total=$total+$info['amount_paid'];
                                  $t_date=explode("-", $info["bill_date"]);
                                  $b_date=$t_date[2]."-".$t_date[1]."-".$t_date[0];
                                  
                                  $customer_name=$info['customer_name'];
                                  
                                  $tran_type="SALE";
                                  if($info['customer_id']!=0)
                                  {
                                  	$data1 = mysql_query("SELECT member_name FROM mst_member where sk_member_id='".$customerid."'");
                                  	while($info1 = mysql_fetch_array( $data1 ))
                                  	{
                                  		$customer_name=$info1[0];
                                  	}
									
									
                                  	
                                  	$tran_type="CREDIT";
                                  }
								  
								  $data22 = mysql_query("SELECT member_name FROM mst_member where sk_member_id='".$loginId."'");
                                  	while($info22 = mysql_fetch_array( $data22 ))
                                  	{
                                  		$addedBy=$info22[0];
                                  	}
                                 
                                  ?>
                                    <tr>                                     
                                        <td><?php echo $slip_no;?></td>
										<td><?php echo $addedBy;?></td>
										<td><?php echo $customer_name?></td> <td><?php echo $info['phone'].""?></td>
                                        <td><?php echo $b_date?></td>
                                        <td><?php echo $tran_type?></td>                                                 
                                       
                                        <td><?php echo $info['total']?></td>   
                                         
                                        <td>
                                        <a href="index.php?action=print/pickerlist_print&c=stock&pid=<?php echo $info['bill_no']?>">Print </a>|
                                        <a href="index.php?action=picker_list_edit&c=stock&pid=<?php echo $info['bill_no']?>">Edit </a>|
                                        <a href="index.php?action=new&c=stock&c_id=<?php echo $customerid?>&pid=<?php echo $info['bill_no']?>">Gen Bill</a> | 
                                         <a href="index.php?action=operations/delete_picker&c=stock&c_id=<?php echo $customerid?>&pid=<?php echo $info['bill_no']?>">Delete</a> 
                                       </td>
                                    </tr>
                                    <?php }?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                      <th></th>
                        <th></th> <th><?php echo $total?></th>  <th></th>
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
            
            <div class="col-md-6">
             

              <div class="box" style="overflow: auto;">
                <div class="box-header">
                
                </div><!-- /.box-header -->
                <div class="box-body">
                
                  <table id="example1" class="table table-bordered table-striped" style="font-size: 12px">
                 
                    <thead>
                      <tr>
                         <th class="info"></th>
                                        <th>Supplier Name</th>
                    <th>Order Date</th>
                                       
                                        <th class="actions">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                       <?php 
                                
                                   $i=1;
                                  $total=0;
                                  $data = mysql_query("SELECT bill_no, supplier_id, bill_date FROM supplierorderformmain where bill_status='pending'");
                                  while($info = mysql_fetch_array( $data ))
                                  {
                                  	$slip_no=$info['bill_no'];
                                 	                          	
                                  	$customerid=$info['supplier_id'];
                                 
                                  $t_date=explode("-", $info["bill_date"]);
                                  $b_date=$t_date[2]."-".$t_date[1]."-".$t_date[0];
                                  
                                 
                                  
                                  $tran_type="SALE";
                                  	$data1 = mysql_query("SELECT member_name FROM mst_member where sk_member_id='".$customerid."'");
                                  	while($info1 = mysql_fetch_array( $data1 ))
                                  	{
                                  		$customer_name=$info1[0];
                                  	}
                                  	
                                  
                              
                                 
                                  ?>
                                    <tr>                                     
                                        <td><?php echo $slip_no;?></td><td><?php echo $customer_name?></td> 
                                        <td><?php echo $b_date?></td>
                                                      
                                       
                                       
                                        
                                         <td><a href="index.php?action=order_form_edit&c=stock&c_id=<?php echo $customerid?>&pid=<?php echo $info['bill_no']?>">Edit Order</a> | 
                                         <a href="index.php?action=in_new&c=stock&c_id=<?php echo $customerid?>&pid=<?php echo $info['bill_no']?>">Gen Bill</a> |
                                          <a href="index.php?action=print/order_form&c=stock&c_id=<?php echo $customerid?>&pid=<?php echo $info['bill_no']?>" target="blank">Print</a> |
                                          <a href="index.php?action=print/order_form_email&c=stock&c_id=<?php echo $customerid?>&pid=<?php echo $info['bill_no']?>" target="blank">Email</a> | 
                                          <a href="index.php?action=operations/order_form_delete&c=stock&c_id=<?php echo $customerid?>&pid=<?php echo $info['bill_no']?>" target="blank">Delete</a>
                                       </td>
                                    </tr>
                                    <?php }?>
                    </tbody>
                    
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
            <?php 
                        if($session_type=="AA")
                        {
                        ?>
            <section class="col-lg-5 connectedSortable">
              <!-- Custom tabs (Charts with tabs)-->
              <div class="nav-tabs-custom">
                <!-- Tabs within a box -->
                <ul class="nav nav-tabs pull-right">
                  <li class="active"><a href="#revenue-chart" data-toggle="tab"></a></li>
                  <li><a href="#sales-chart" data-toggle="tab"></a></li>
                  <li class="pull-left header"><i class="fa fa-inbox"></i>Day Report</li>
                </ul>
                <div class="tab-content no-padding">
                <?php $total_collection=0;
 			
                ?>
                <table id="example1" class="table table-bordered table-striped" style="font-size: 12px">
                    <thead>
                      <tr><th>Open Balance</th><th>0</th></tr>
                       <tr><th>Day Investment</th><th>0</th></tr>
                       <tr><th>Day Collection</th><th>0</th></tr>
                      <!-- <tr><th>Day Interest</th><th>0</th></tr> --> 
                        <tr><th>Day Loan Issue</th><th>0</th></tr>
                        <tr><th>Day Expenses</th><th>0</th></tr>
                        <tr><th>Closing Balance</th><th>0</th></tr>
                    </thead>
               
                 </table>
                </div>
              </div><!-- /.nav-tabs-custom -->

              <!-- Chat box -->
              
              <!-- TO DO List -->
              

              <!-- quick email widget -->
              
            </section>
            <?php }?>
            <!-- /.Left col -->
            <!-- right col (We are only adding the ID to make the widgets sortable)-->
            
          </div><!-- /.row (main row) -->

   </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      
      
      
      
      <?php 
      
       $status="";
    $data = mysql_query("SELECT sms FROM sms_notification where sms_status='sent' and sms_type='DAY' and sms_date='$date'");
    while($info = mysql_fetch_array( $data ))
    {
    	$status="Sent";
    }
    
   if($status=='')
    {
      
       $yesterday = date("Y-m-d", mktime(0, 0, 0, date("m") , date("d")-1,date("Y")));
       $q=" and branch_id='$session_branch' and tran_status='active'";
        	
       		$day_credit_sale=0;
              $sql=mysql_query("select sum(credit) from txn_transaction where credit>0 and tran_date='$yesterday' and tran_type='Customer' and tran_desc='New Bill' and note='Credit' $q");
              while($info=mysql_fetch_array($sql))
              {
              	$day_credit_sale=number_format((float)$info[0], 0, '.', '');
              }if($day_credit_sale==""){$day_credit_sale=0;}
             
              
               $day_credit_sale_paid=0;
              $sql=mysql_query("select sum(debit) from txn_transaction where debit>0 and tran_date='$yesterday' and tran_type='Customer' and tran_desc='New Bill' and note='Credit' $q");
              while($info=mysql_fetch_array($sql))
              {
              	$day_credit_sale_paid=$info[0];
              }if($day_credit_sale_paid==""){$day_credit_sale_paid=0;}
               else{number_format((float)$day_credit_sale_paid, 0, '.', '');}
              
               $day_cash_sale=0;
              $sql=mysql_query("select sum(credit) from txn_transaction where credit>0 and tran_date='$yesterday' and tran_type='Customer' and tran_desc='New Bill' and note='Cash' $q");
              while($info=mysql_fetch_array($sql))
              {
              	$day_cash_sale=number_format((float)$info[0], 0, '.', '');
              }
              
              $day_cash_discount=0;
              $sql=mysql_query("select sum(discount) from mst_bill_main where bill_date='$yesterday' and bill_type='Cash'");
              while($info=mysql_fetch_array($sql))
              {
              	$day_cash_discount=$info[0];
              }
              if($day_cash_discount==""){$day_cash_discount=0;}
              $cash_total=$day_cash_sale-$day_cash_discount;
             $cash_total=number_format((float)$cash_total, 0, '.', '');
              
              $purchase_value=0;
              $customer = mysql_query("SELECT bill_no, supplier_id, bill_date, total, other_exp, lug_exp, exp, advance, gtotal, total_bal, login_id, branch, hamali FROM supplierbillmain where branch='$session_branch' and bill_date='$yesterday'");
                                  while($customer1 = mysql_fetch_array( $customer ))
                                  {
                                  
                                  	
                                  	$purchase_value=$purchase_value+$customer1['gtotal'];
                                  }
               $purchase_value=number_format((float)$purchase_value, 0, '.', '');
                                  
                                    $supplier_payments=0;
                    $data = mysql_query("SELECT sk_tran_id,tran_date,debit,tran_desc,member_id,transaction_ref_id FROM txn_transaction where tran_type='Bank' and tran_desc='Supplier Withdraw' and debit>0 and tran_date='$yesterday'");
	                	while($info = mysql_fetch_array( $data ))
	                	{      
							$supplier_payments=$supplier_payments+$info["debit"];  
	                	}
	                
$data = mysql_query("SELECT sk_tran_id,tran_date,debit,tran_desc,member_id FROM txn_transaction where tran_type='Supplier' and debit>0 and tran_desc='Payment' and tran_date='$yesterday'");
	                	while($info = mysql_fetch_array( $data ))
	                	{      
						
	                		   $supplier_payments=$supplier_payments+$info["debit"];  
	                	}
               $supplier_payments=number_format((float)$supplier_payments, 0, '.', '');
	                	 $day_expenses=0;
              $sql=mysql_query("select sum(debit) from txn_transaction where debit>0 and tran_date='$yesterday' and tran_type='Expenses' $q");
              while($info=mysql_fetch_array($sql))
              {
              	$day_expenses=number_format((float)$info[0], 0, '.', '');
              }if($day_expenses==""){$day_expenses=0;}
	                
              
	                 $purchase_total=0;
              $data = mysql_query("SELECT sk_member_id, member_type, member_name, acc_no, ifsc, mobile, landline, email, address, place, state, profile_pic, login_name, login_password, login_status, employee_id, branch_id,member_status FROM mst_member where member_type='3' and member_status='active'");
                    	while($info = mysql_fetch_array( $data ))
                    	{
                    		$member_type=$info["member_type"];
                    		$customerid=$info['sk_member_id'];
                    		$member_filter="";
                    		
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
                    				$purchase_total=$purchase_total+($supplier1['credit']);
                    				$purchase_total=$purchase_total-$supplier1['debit'];
                    				$purchase_total=$purchase_total-$discount;
                    				$purchase_total=number_format((float)$purchase_total, 0, '.', '');
                    			}
                    		}
                    		
                    	}
	                	 $purchase_total=number_format((float)$purchase_total, 0, '.', '');	
             
              
	                	 
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
                    $q=" and tran_date='$yesterday'";
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
                    
                    <?php }}
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
                    $supplier_payments=0;
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
                    
                    <?php }}
                    
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
                    <?php }
                     
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
                    
                    <?php }
                   
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
                    
                    <?php }
                    
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
                    
                    <?php }
                    
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
                    <?php }
                   
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
                    <?php }
                     
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
                    
                    <?php }
                    
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
                    <?php }}
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
                    
                    <?php }
                     $exp=$expense+$customer_return+$supplier_payments+$bank_deposit+$transport+$agent_com+$employee_payment+$partner_payment+$hand_loan_issue+$hamali+$investment_payments;
                    
              
       $msg="($yesterday) SALE(CASH : ".$cash_total.", CRE : ".$day_credit_sale."), CRE COLL:".$day_credit_sale_paid.", PUR:".$purchase_value."(SUP PAY:".$supplier_payments.", EXP:".$exp."), CUST BAL:".$customer_credit_balance.", SUP BAL:".$purchase_total.", CB:".$opening;
   echo $msg;
      $phone_no="9480157357,8971139956";
      //
      ?>
     <!--  <embed src="http://167.114.60.246/VidyaSMS/SendSMS.aspx?User=dharani&Pwd=dharani&SenderId=DMGDHW&MobileNo=<?php echo $phone_no?>&Message=<?php echo $msg?>"> -->
      <?php $command = "SELECT MAX(sms_id) as maxid FROM sms_notification";
    $cNo=0;
    $result = mysql_query($command, $con);
    while ($row = mysql_fetch_assoc($result)){
    	$cNo = $row['maxid'];
    }
   $cNo++;
$query ="INSERT INTO sms_notification (sms_id, sms, to_numbers, sms_type, sms_date, sms_time, sms_status,sms_count)
VALUES ('$cNo','$msg','9480157357,8971139956','DAY','$date',now(),'sent','2')";
mysql_query($query);}?>
 <?php include_once "$D_PATH/include/footer.php";?>

  <!-- Control Sidebar -->
 <?php include_once "$D_PATH/include/side_container.php";?> 
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<?php include_once "$D_PATH/include/scripts_bottom.php";?> 
</body>
</html>
      
          
