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
            
                <div class="col-md-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Payment and Receipt Report</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                
                <form action='?action=financial&c=reports'>
                <input type="hidden" name="action" value="pr_report">
                <input type="hidden" name="c" value="reports">
                     <table>
                      <tr><td>From Date</td><td>	          
                        <input type='date' name='from_date' class="form-control" id="inputDate" value='<?php  if(isset($_GET['from_date'])){echo $_GET['from_date'];}else{ echo $date1;}?>'>
                        </td><td></td>
                        <td>To Date</td><td>	          
                        <input type='date' name='to_date' class="form-control" id="inputDate" value='<?php  if(isset($_GET['to_date'])){echo $_GET['to_date'];}else{ echo $date1;}?>'>
                        </td><td></td><td>
                         <td>&nbsp;</td><td>	          
                        <select name="tran_type" id="tran_type" class="form-control" onchange="getList(this.value)">
                        <?php  
                        if(isset($_GET['tran_type']))
                        {?>
                        	<option value="<?php echo $_GET['tran_type']?>"><?php echo $_GET['tran_type']?></option>
                       <?php 	}?>
                 		<option value="">Tran Type</option>
                 		<!-- <option value="Expenses">Expenses</option> -->
                		<option value="Customer">Customer</option>
                		<option value="Supplier">Supplier</option>
                		
                		<option value="Transport">Transport</option>
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
                        </td><td>&nbsp;</td>
                        <td>
                        	<select name="tran" class="form-control">
                        		<?php  
		                        if(isset($_GET['tran']))
		                        {?>
		                        	<option value="<?php echo $_GET['tran']?>"><?php echo $_GET['tran']?></option>
		                       <?php 	}?>
                        		<option value="Payment">Payment</option>
                				<option value="Receipt">Receipt</option>
                        	</select>
                        </td>
                        <td>&nbsp;</td>
                        <td>
                        <input type="submit" value='Get Report'/>&nbsp;
                         <?php 
                        if(isset($_GET["from_date"]))
                        {	?>
                        	<a class='btn btn-success' href="?action=print/pr_report&c=reports&tran=<?php echo $_GET["tran"]?>&tran_type=<?php echo $_GET["tran_type"]?>&from_date=<?php echo $_GET['from_date']?>&to_date=<?php echo $_GET['to_date']?>">Print</a>
                        	<?php 
                        }
                        ?></td>
                      </tr></table>
                        </form><br/>
                        </div>
                        </div>
                        </div>
            <!-- right column -->
            <?php $q="";
            if(isset($_GET["from_date"]))
			{	
				if($_GET['tran_type']=='Customer' || $_GET['tran_type']=='Bank')
				{
					if($_GET['tran']=='Receipt')
					{
						$q="where (tran_type='".$_GET['tran_type']."') and debit>0 and (tran_desc='Payment' ) and tran_date between '".$_GET["from_date"]."' and '".$_GET["to_date"]."' order by tran_date ";
					}
					else
					{
						$q="where (tran_type='".$_GET['tran_type']."') and credit>0 and (tran_desc='Payment Return') and tran_date between '".$_GET["from_date"]."' and '".$_GET["to_date"]."' order by tran_date ";
					}
				}
				else 
				{
					if($_GET['tran']=='Payment')
					{
						$q="where (tran_type='".$_GET['tran_type']."') and debit>0 and (tran_desc='Payment' ) and tran_date between '".$_GET["from_date"]."' and '".$_GET["to_date"]."' order by tran_date ";
					}
					else
					{
						$q="where (tran_type='".$_GET['tran_type']."') and credit>0 and (tran_desc='Payment Return') and tran_date between '".$_GET["from_date"]."' and '".$_GET["to_date"]."' order by tran_date ";
					}
				}
            	$received_amt=0;
            ?>
            <div class="col-md-12">
              
              <div class="box">
               
                <div class="box-body" style="overflow: auto;">
                <table id="" class="table table-bordered table-striped" style="font-size: 12px">
                    <thead>
                    <?php if($_GET['tran']=='Receipt'){?>
                      <tr>
                        <th>Date</th>
                        <th>Bank/Cash</th>
                        <th>Received From</th> 
                        <th>Amount</th>
                        <th>Note</th>
                      </tr>
                     <?php }else{?>
                     	<tr>
                        <th>Date</th>
                        <th>Bank/Cash</th>
                        <th>Paid To</th> 
                        <th>Amount</th>
                        <th>Note</th>
                      </tr>
                     <?php }?>
                    </thead>
					<?php if(isset($_GET["from_date"])) {?>
                    <tbody id='div_print' style="font-size: 12px;">
                    <?php 
                  
                    $credit_payment=0;
                   // echo "SELECT sk_tran_id,tran_date,debit,credit,tran_desc,member_id FROM txn_transaction $q";
				  //echo "SELECT * FROM txn_transaction $q";
                    $data = mysql_query("SELECT * FROM txn_transaction $q");
	                	while($info = mysql_fetch_array( $data ))
	                	{      
							$member_name="";
							$ref_id=$info['transaction_ref_id'];
							$member_id=$info["member_id"];
							$data1 = mysql_query("SELECT member_name FROM mst_member where sk_member_id='$member_id'");
							while($info1 = mysql_fetch_array( $data1 ))
							{
								$member_name=$info1["member_name"];
							}
							$bank_name="";$payment="";
							if($ref_id==0)
							{
								$payment="Cash";
								
							}
							else 
							{
								$payment="Bank";
								$data2=mysql_query("select member_id from txn_transaction where sk_tran_id='$ref_id' ");
								while($info2=mysql_fetch_array($data2))
								{
									$member_id=$info2["member_id"];
									$data1 = mysql_query("SELECT member_name FROM mst_member where sk_member_id='$member_id'");
									while($info1 = mysql_fetch_array( $data1 ))
									{
										$bank_name=$info1["member_name"];
									}
								}
								
							}
						
	                		   

	                		   if($info["debit"]>0){
									$credit_payment=$credit_payment+$info["debit"];
                    ?><tr>
                    	<td><?php echo date("d-m-Y",strtotime($info["tran_date"]))?></td>
                  		<td><?php echo $payment.'-'.$bank_name?></td>
	                    <td><?php echo $member_name?></td>
	                    
	                    <td><a href='javascript:void(0)'  data-toggle="modal" data-target="#myModal" onclick="setData(<?php echo $info["sk_tran_id"]?>,<?php echo $info["debit"]?>,'<?php echo $info["tran_desc"]?>','debit')"><?php echo $info["debit"]?></a></td>
	                    <td><?php echo $info['note']?></td>
                    </tr>
                    
                    <?php }
                    if($info["credit"]>0){
						$credit_payment=$credit_payment+$info["credit"];
                    	?><tr>
                                        <td><?php echo date("d-m-Y",strtotime($info["tran_date"]))?></td>
                                        <td><?php echo $payment.'-'.$bank_name?></td>
                                        <td><?php echo $member_name?></td>
                                        <td><?php echo $info["tran_date"]?></td>
                                        <td><a href='javascript:void(0)'  data-toggle="modal" data-target="#myModal" onclick="setData(<?php echo $info["sk_tran_id"]?>,<?php echo $info["credit"]?>,'<?php echo $info["tran_desc"]?>','credit')"><?php echo $info["credit"]?></a></td>
                                        <td><?php echo $info['note']?></td>
                                        </tr>
                                        
                                        <?php }
	                	}?>
                     
                                </tbody>
                                    <tfoot>
                                    <tr><td></td><td></td><td></td><td><?php echo $credit_payment?></td><td></td></tr>
					</tfoot><?php }?>
                  </table>
                  
                </div><!-- /.box-body -->
              </div><!-- /.box -->
              
             
              
              
                    
    	</div>   
               <?php }?>  
                 
                 
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