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
    <script type="text/javascript">
		function validate()
		{			
			var state="1";
			if($("#bank_name").val()==""){$("#bank_name_v").addClass('has-error');state="2";}
			if($("#acc_no").val()==""){$("#acc_no_v").addClass('has-error');state="2";}
			
			if(state==2){return false;}
		}
		
        </script>
    
           
        <script type="text/javascript">
					function checkCust()
					{
						if(document.getElementById("tran_type2").checked==true)
						{
							document.getElementById("c").style.visibility='';
							document.getElementById("c").style.position='';
						}
						else {
							document.getElementById("c").style.visibility='hidden';
							document.getElementById("c").style.position='absolute';
						}
					}

					function validate()
					{
						if(document.getElementById("tran_type2").checked==true)
						{
							if(document.getElementById("c_name").value=="")
							{
								document.getElementById("c_v").innerHTML='Field Required';
								return false;
							}
						}
					}
	             </script>
    <script type="text/javascript">
					function checkSup()
					{
						if(document.getElementById("tran_type4").checked==true)
						{
							document.getElementById("s").style.visibility='';
							document.getElementById("s").style.position='';
						}
						else {
							document.getElementById("s").style.visibility='hidden';
							document.getElementById("s").style.position='absolute';
						}
					}

					function validate1()
					{
						if(document.getElementById("s_type2").checked==true)
						{
							if(document.getElementById("s_name").value=="")
							{
								document.getElementById("sup_msg").innerHTML='Field Required';
								return false;
							}
						}
					}
	             </script>
  
       <!-- ---------------------------------------------------POPUP--------------------------------------------------------------------------- -->
<div class='popup'>
<div class='content_popup' style="width: 80%">
<img src='<?php echo $UI_ELEMENTS?>notify/img/img.png' alt='quit' class='x' id='x'></img>
<div id="load_data">


<section class="content">
        
          
            <div class="row">
            <!-- left column -->
             
            <div class="col-md-3">
              <!-- general form elements -->
              <form action="index.php?action=operations/bank_deposit&c=transactions" method="post">
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">DEPOSIT</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
               
               
               
               <input type="hidden" name="bank_id" id="bank_id">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputFullName">Cheque No</label>
                      <input type="text" class="form-control" id="cheque_no" name="cheque_no" onfocus="document.getElementById('cheque_no_v').innerHTML=''">
                      <span  id='cheque_no_v'></span>
                    </div>
                     
                     <div class="box-body">
                      <div class="form-group">
                      <label for="exampleInputFullName">Enter Amount to be Payed</label>
                      <input type="text" class="form-control" id="amount" name="amount" onfocus="document.getElementById('amount_v').innerHTML=''">
                      <span  id='amount_v'></span>
                    </div>
                    </div>
                    <div class="box-body">
                      <div class="form-group">
                      <label for="exampleInputFullName">Tran Date</label>
                      <input type="date" class="form-control" id="tran_date" name="tran_date" value="<?php echo $date?>">
                      <span  id='amount_v'></span>
                    </div>
                    </div>
                    
                    
                    <div>                                                         
                    <input type="radio" name="t_type" value="Others" onclick="checkCust()" id="tran_type1" checked="checked">
                    <label for="exampleInputFullName">Others</label>                 
                    <br><input type="radio" name="t_type" value="Customer" onclick="checkCust()" id="tran_type2">
                    <label for="exampleInputFullName">Customer Payments</label>
                    </div>
                    
                    <div class="box-body" id='c' style="visibility: hidden;position: absolute;">
                      <div class="form-group">
                      <label for="exampleInputFullName">Customer Name</label>
                    <select class="form-control" id="c_name" name="c_name">
	               <option value=""></option>
	                <?php 
	                $data = mysql_query("SELECT sk_member_id,member_name FROM mst_member where member_status='active' and member_type='2' and branch_id='$session_branch' order by member_name asc");
	                while($info = mysql_fetch_array( $data ))
	                {
	                	?>
	                	               <option  value="<?php echo $info["sk_member_id"]?>"><?php echo $info["member_name"]?></option>
				<?php }?> </select>
                     <span  id='c_v'></span>
                    </div>
                    </div>
                    
                    <div class="box-body">
                      <div class="form-group">
                      <label for="exampleInputFullName">Note</label>
                      <input type="text" class="form-control" id="c_note" name="c_note" onfocus="document.getElementById('note_v').innerHTML=''">
                      <span  id='note_v'></span>
                    </div>
                    </div>
                    
				  <div class="form-group">                  
					<button class="btn btn-block btn-success" type="submit">SUBMIT</button>
				  </div>            
                  </div><!-- /.box-body -->                
              </div><!-- /.box -->
              </form>
          </div><!--/.col (left) -->
          <div class="col-md-4">
              <!-- general form elements -->
               <form action="index.php?action=operations/bank_withdrawl&c=transactions" method="post">
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">WITHDRAWL</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
               
                  
               <input type="hidden" name="bank_id" id="bank_id_id">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputFullName">Cheque No</label>
                      <input type="text" class="form-control" id="cheque_no1" name="cheque_no1" onfocus="document.getElementById('cheque_no_v').innerHTML=''">
                      <span  id='cheque_no_v'></span>
                    </div>
                     
                     <div class="box-body">
                      <div class="form-group">
                      <label for="exampleInputFullName">Enter Amount to be Withdrawn</label>
                      <input type="text" class="form-control" id="amount1" name="amount1" onfocus="document.getElementById('amount_v').innerHTML=''">
                      <span  id='amount_v'></span>
                    </div>
                    </div>
                    <div class="box-body">
                      <div class="form-group">
                      <label for="exampleInputFullName">Tran Date</label>
                      <input type="date" class="form-control" id="tran_date" name="tran_date" value="<?php echo $date?>">
                      <span  id='tran_date_v'></span>
                    </div>
                    </div>
                    <div>                                     
                    <div>                                     
                    <input type="radio" name="t_type_s" value="Others" onclick="checkSup()" id="tran_type3" checked="checked">
                    <label for="exampleInputFullName">Others</label>                 
                    <br><input type="radio" name="t_type_s" value="Supplier" onclick="checkSup()" id="tran_type4">
                    <label for="exampleInputFullName">Supplier Payments</label>
                    </div>
                    
                     <div class="box-body" id='s' style="visibility: hidden;position: absolute;">
                      <div class="form-group">
                      <label for="exampleInputFullName">Supplier Name</label>
                    <select id="s_name" name="s_name" class="form-control">
	               <option value=""></option>
	                <?php 
                    $data = mysql_query("SELECT sk_member_id,member_name FROM mst_member where member_status='active' and member_type='3' and branch_id='$session_branch' order by member_name asc");
                    while($info = mysql_fetch_array( $data ))
                    {
                    ?>  
	               <option  value="<?php echo $info["sk_member_id"]?>"><?php echo $info["member_name"]?></option>
	               <?php }?>
	               </select><span id='sup_msg' style="color: red"></span>
	                 </div>
                    </div>
                    
                    <div class="box-body">
                      <div class="form-group">
                      <label for="exampleInputFullName">Note</label>
                      <input type="text" class="form-control" id="s_note" name="s_note" onfocus="document.getElementById('note_v').innerHTML=''">
                      <span  id='note_v'></span>
                    </div>
                    </div>
                    
				  <div class="form-group">                  
					<button class="btn btn-block btn-success" onclick="addExpenses()">SUBMIT</button>
				  </div>            
                  </div><!-- /.box-body -->                
              </div><!-- /.box -->
              </div>
              </form>
          </div>
          
          <div class="col-md-4">
              <!-- general form elements -->
               <form action="index.php?action=operations/bank_transfer&c=transactions" method="post">
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">TRANSFER</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
               
                  
               <input type="hidden" name="bank_id" id="bank_transfer_id">
                  <div class="box-body">
                  <div class="box-body">
                      <div class="form-group">
                      <label for="exampleInputFullName">Bank</label>
                      <select class="form-control" id="to_bank_id" name="to_bank_id">
                      	<option value=""></option>
                      	<?php 
                      	$data=mysql_query("select sk_member_id,member_name,acc_no FROM mst_member where member_type=6 ");
                      	while($info = mysql_fetch_array( $data ))
                      	{
                      	?>
                      	<option value="<?php echo $info["sk_member_id"]?>"><?php echo $info["member_name"]?></option>
                      	<?php }?>
                      </select>
                      <span  id='amount_v'></span>
                    </div>
                    </div>
                     <div class="box-body">
                      <div class="form-group">
                      <label for="exampleInputFullName">Enter Amount to be Transfered</label>
                      <input type="text" class="form-control" id="amount2" name="amount2" onfocus="document.getElementById('amount_v').innerHTML=''">
                      <span  id='amount_v'></span>
                    </div>
                    </div>
                    <div class="box-body">
                      <div class="form-group">
                      <label for="exampleInputFullName">Tran Date</label>
                      <input type="date" class="form-control" id="tran_date" name="tran_date" value="<?php echo $date?>">
                      <span  id='tran_date_v'></span>
                    </div>
                    </div>
                    <div>                                     
                    
                     
                    <div class="box-body">
                      <div class="form-group">
                      <label for="exampleInputFullName">Note</label>
                      <input type="text" class="form-control" id="s_note" name="s_note" onfocus="document.getElementById('note_v').innerHTML=''">
                      <span  id='note_v'></span>
                    </div>
                    </div>
                    
				  <div class="form-group">                  
					<button class="btn btn-block btn-success" onclick="addExpenses()">SUBMIT</button>
				  </div>            
                  </div><!-- /.box-body -->                
              </div><!-- /.box -->
              </div>
              </form>
          </div>
            
          </div>   <!-- /.row -->
          
                 
        </section>




</div>
</div>
</div>   
<!-- ---------------------------------------------------POPUP--------------------------------------------------------------------------- -->      
      
    
        <!-- Main content -->
        <section class="content">
        
        
       
          <div class="row">
  
            
            <div class="col-md-9">
             

              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Bank List</h3>
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
                        <th>BANK NAME</th>
                        <th>ACC NO</th>                      
                        <th>BALANCE AMT</th>
                       <!-- <th style="text-align: center;font-weight: bold;">MAKE PAYMENT</th> --> 
                        <th>STATEMENT</th>
                        <th>ACTION</th>
                      </tr>
                    </thead>
                    <tbody>
                       
                      <tr>
                      <?php 
                    
                      $total_bal=0;$total_min=0;
                      $data=mysql_query("select sk_member_id,member_name,acc_no FROM mst_member where member_status!='$state' and member_type='6'");
                while($info = mysql_fetch_array( $data ))
                {
                	
                	$balance=0;
                	$bank_id=$info["sk_member_id"];
                	$supplier = mysql_query("SELECT credit, debit from txn_transaction where member_id='".$bank_id."' and tran_type='Bank' and tran_status='active'");
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
                	?>
								<td> <?php echo $info["member_name"]?></td>
								<td><?php echo  $info["acc_no"]?></td>						
								<td><?php echo  $balance?></td>		
							 <!--    <td style="text-align: center;font-weight: bold;"><a href="" class='click' onclick="document.getElementById('bank_id').value=<?php echo $info["sk_member_id"]?>,document.getElementById('bank_id_id').value=<?php echo $info["sk_member_id"]?>,document.getElementById('bank_transfer_id').value=<?php echo $info["sk_member_id"]?>">Make Transactions</a></td> -->
							    <td> <a href="index.php?action=view&c=transactions&bank_id=<?php echo $info['sk_member_id']?>">view</a></td>
							    <td> <?php if($state=="inactive"){?><a href="index.php?action=operations/close&c=transactions&bank_id=<?php echo $info['sk_member_id']?>">Close Acc</a><?php }else{?>

<a href="index.php?action=operations/activate&c=transactions&bank_id=<?php echo $info['sk_member_id']?>">Activate Acc</a><?php }?>
</td>
					</tr>
					<?php }?>
					</tbody>
					<tfoot>
                     <tr>
                     	<td></td><td>Total Bal</td><td style="background-color: #CEF6CE;font-weight: bold;"><?php echo $total_bal?></td><td><?php echo $total_min?></td><td></td><td></td>
                     </tr>
                    </tfoot>
                   
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
            
            <div class="col-md-3">
             <form role="form" onsubmit="return validate()" action="index.php?action=operations/bank_save&c=transactions" method="POST">
        <input type='hidden' name="session_branch" id="session_branch" value="<?php echo $session_branch?>">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Add New Bank</h3>
                </div>
                
                
                
                  <div class="box-body">
                    <div class="form-group" id='bank_name_v'>
                      <label>BANK NAME</label>
                      <input type="text" class="form-control" name='bank_name' id='bank_name'>
                        
                    </div>
                    
                    <div class="form-group" id="acc_no_v">
                      <label for="exampleInputCustomerPlace">ACC NO</label>
                      <input type="text" class="form-control" id="acc_no" name="acc_no" placeholder=""> 
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
