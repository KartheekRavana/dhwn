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
      
      
       <!-- ---------------------------------------------------POPUP--------------------------------------------------------------------------- -->
<div class='popup'>
<div class='content_popup'>
<img src='<?php echo $UI_ELEMENTS?>notify/img/img.png' alt='quit' class='x' id='x'></img>
<div>
<p id="load_data">


<section class="content">
        
          
            <div class="row">
            <!-- left column -->
              <div class="col-md-2"></div>
            <div class="col-md-8">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Add New Expense</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
               
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputFullName">Expenses</label>
                      <input type="text" class="form-control" id="expenses" name="expenses" onfocus="document.getElementById('category_v').innerHTML=''">
                      <span  id='expenses_v'></span>
                    </div>
                    
				  <div class="form-group">                  
					<button class="btn btn-block btn-success" onclick="addExpenses()">Add Expenses</button>
				  </div>            
                  </div><!-- /.box-body -->                
              </div><!-- /.box -->
          </div><!--/.col (left) -->
          <div class="col-md-2"></div>
          
            
          </div>   <!-- /.row -->
          
          
          
                 
        </section>
        



</p>
</div>
</div>
</div>   
<!-- ---------------------------------------------------POPUP--------------------------------------------------------------------------- -->      
      
      
      
      
        
         <script type="text/javascript">
		function validate()
		{			
			var state="1";
			if($("#exp_name").val()==""){$("#branch_v").addClass('has-error');state="2";}
			if($("#exp_amount").val()==""){$("#exp_amount_v").addClass('has-error');state="2";}
			
			if(state==2){return false;}
		}
		
        </script>
        <!-- Main content -->
        <section class="content">
        
        <?php 
        $tran_id=$_GET["tran_id"];
         $data=mysql_query("select sk_tran_id,tran_date,debit,member_id,tran_desc,note from txn_transaction where sk_tran_id='$tran_id' and tran_type='Expenses'");
         while($info = mysql_fetch_array( $data ))
         {
           $amount=$info["debit"];
           $expense_date=$info["tran_date"];
           $note=$info["note"];
           $expense_name=$info["tran_desc"];
           $expense_id=$info["member_id"];
         }
        ?>
        
        <form role="form" onsubmit="return validate()" action="index.php?action=operations/expense_edit&c=transactions" method="POST">
        <input type='hidden' name="session_branch" id="session_branch" value="<?php echo $session_branch?>">
        <input type='hidden' name="tran_id" id="tran_id" value="<?php echo $tran_id?>">
          <div class="row">
            <!-- left column -->
            <div class="col-md-4">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Expense Details</h3>
                </div>
                
                
                
                  <div class="box-body">
                    <div class="form-group" id='branch_v'>
                      <label>Expense</label><label style="float: right;"><a href="" class='click'>Add Expense</a></label>
                      <select class="form-control" name='exp_name' id='exp_name' >
                      <?php 
                      $query1=mysql_query("select expense_name from mst_expenselist where expense_id=$expense_id");
                      while($info = mysql_fetch_array( $query1 ))
                      	$expense_name=$info['expense_name'];
                      ?>
                        <option value="<?php echo $expense_id?>"><?php echo $expense_name?></option>
                        <?php 
$read='';

				$data = mysql_query("SELECT expense_id,expense_name FROM mst_expenselist where expense_status='active' and branch_id='$session_branch' order by expense_name asc	");
				while($info = mysql_fetch_array( $data ))
				{					
				?>
							
					<option value="<?php echo $info[0]?>"><?php echo $info[1]?></option>			
					
		<?php } ?>
                        
                      </select>
                    </div>
                    
                    <div class="form-group" id="exp_amount_v">
                      <label for="exampleInputCustomerPlace">Amount</label>
                      <input type="text" class="form-control numbersDecimals" id="exp_amount" name="exp_amount" placeholder="Expense Amount" value='<?php echo $amount?>'> 
                    </div>
                    <div class="form-group" id="date_v">
                      <label for="exampleInputCustomerPlace">Date</label>
                      <input type="date" class="form-control" id="date" name="date" placeholder="Expense Date" value='<?php echo $date?>'> 
                    </div>
                    <div class="form-group" id="exp_note_v">
                      <label>Note</label>
                      <textarea class="form-control" rows="3" placeholder="" id="exp_note" name="exp_note"><?php echo $note?></textarea>
                    </div>
                      <div class="form-group">                  
					<button class="btn btn-block btn-success">Update Expense</button>
				  </div>             
                    
                    
                  </div><!-- /.box-body -->

                
            
              </div><!-- /.box -->

             

              
              </form>

            </div><!--/.col (left) -->
            <!-- right column -->
            
            
            
            
           
            
            
            
            
            
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
      
        