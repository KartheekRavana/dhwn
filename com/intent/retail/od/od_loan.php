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
    
    <?php include_once "$D_PATH/include/navigation.php";?>
   
  
    
        <!-- Main content -->
        <section class="content">
        
        
       
          <div class="row">
  
            
            <div class="col-md-9">
             

              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Loan List</h3>
                </div><!-- /.box-header -->
                <div class="box-body" style="overflow: auto;">
                <?php $state="active";if(isset($_GET["state"])){
                $state=$_GET["state"];
                	 }
                	 if($state=="active"){$state="inactive";}else{$state='active';}?>
                <a href="index.php?action=bank&c=transactions&state=<?php echo $state?>">View <?php echo $state?> Acc</a>
                  <table id="example1" class="table table-bordered table-striped" style="font-size: 12px">
                    <thead>
                      <tr>
                        <th>LOAN AMOUNT</th>
                        <th>LOAN DATE</th>                      
                        <th>INTEREST</th>
                        <th>TOTAL</th>
                        <th>PAID</th>
                        <th>BALANCE</th>
                        <th>ACTION</th>
                      </tr>
                    </thead>
                    <tbody>
                       
                    
                      <?php 
                    
                      $total_bal=0;$total_min=0;
                      $data=mysql_query(" SELECT `sk_loan_id`, `loan_amount`, `loan_date`, `interest_rate`, `close_date`, `loan_status`, `branch_id` FROM `mst_loan` where loan_status='active'");
                while($info = mysql_fetch_array( $data ))
                {
                	
                	$balance=0;
                	$bank_id=$info["sk_member_id"];
                	$supplier = mysql_query("SELECT credit, debit from txn_transaction where tran_type='Loan od'");
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
                	?><tr>
								<td> <?php echo $info["loan_amount"]?></td>
								<td><?php echo  $info["loan_date"]?></td><td>0</td><td><?php echo  $info["loan_amount"]?></td>						
								<td>0</td>		<td><?php echo $info["loan_amount"]?></td>		
							    <td> <a href="index.php?action=view&c=transactions&bank_id=<?php echo $info['sk_member_id']?>">view</a>
							     <a href="index.php?action=operations/close&c=transactions&bank_id=<?php echo $info['sk_member_id']?>">Close Acc</a></td>
					</tr>
					<?php }?>
						
					</tbody>
					
                   
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
            
            <div class="col-md-3">
             <form role="form" onsubmit="return validate()" action="index.php?action=operations/loan_save&c=od" method="POST">
        <input type='hidden' name="session_branch" id="session_branch" value="<?php echo $session_branch?>">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">TAKE LOAN</h3>
                </div>
                
                
                
                  <div class="box-body">
                    <div class="form-group" id='bank_name_v'>
                      <label>AMOUNT</label>
                      <input type="text" class="form-control" name='amount' id='amount'>
                        
                    </div>
                    <div class="form-group" id='bank_name_v'>
                      <label>LOAN DATE</label>
                      <input type="date" class="form-control" name='loan_date' id='loan_date'>
                        
                    </div>
                    
                    <div class="form-group" id="acc_no_v">
                      <label for="exampleInputCustomerPlace">INTEREST RATE</label>
                      <input type="text" class="form-control" id="interest_rate" name="interest_rate" placeholder=""> 
                    </div>
                            
					<button class="btn btn-block btn-success">SUBMIT</button>
				  </div>             
                    
                    
                  </div><!-- /.box-body -->

 </form>               
            
              </div><!-- /.box -->
 
            
            
            
            <!--/.col (right) -->
          </div>   <!-- /.row -->
          
  </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
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
