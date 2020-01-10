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
                      <input type="text" class="form-control" id="expense_name" name="expense_name" onfocus="document.getElementById('expense_name_v').innerHTML=''">
                      <span  id='expense_name_v'></span>
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
        <!-- Main content -->
        <section class="content">
        
        
       <script type="text/javascript">
	function addExpenses()
	{
		var state=1;
		if($("#expense_name").val()==""){$("#expense_name_v").addClass('has-error');state="2";}
		if(state==2){return false;}
		
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
		  
		  var temp=status.split("#");
		  if(temp[0]=="Available")
		  {
			  document.getElementById("expense_name_v").innerHTML="<label style='color:green'>Added Successfully</label>";

			  	var combo=document.getElementById("exp_name");
	        	var option = document.createElement("option");
		        option.text = expenses;
		        option.value = temp[1];
		        combo.add(option,null);
		  }	  
		  else
		  {
			  document.getElementById("expense_name_v").innerHTML="<label style='color:red'>Item Already Exist</label>";
		  }
		  		
		  }
		}
		
		var D_PATH=document.getElementById("D_PATH").value
		var DIR=document.getElementById("DIR").value
		var expenses=document.getElementById("expense_name").value
		var session_branch=document.getElementById("session_branch").value
		var session_id=document.getElementById("session_id").value
		xmlhttp.open("GET",D_PATH+"/"+DIR+"/load/checkExpenses.php?expenses="+expenses+"&session_branch="+session_branch+"&session_id="+session_id,true);
		xmlhttp.send();
	
	}
    </script>
    
    <script type="text/javascript">
		function validate()
		{			
			var state="1";
			if($("#exp_name").val()==""){$("#branch_v").addClass('has-error');state="2";}
			if($("#exp_amount").val()==""){$("#exp_amount_v").addClass('has-error');state="2";}
			
			if(state==2){return false;}
		}
		
        </script>
       
          <div class="row">
            <!-- left column -->
            <div class="col-md-4">
             <form role="form" onsubmit="return validate()" action="index.php?action=operations/expense_save&c=transactions" method="POST">
        <input type='hidden' name="session_branch" id="session_branch" value="<?php echo $session_branch?>">
        <input type='hidden' name="session_id" id="session_id" value="<?php echo $session_id?>">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Expense Details</h3>
                </div>
                
                
                
                  <div class="box-body">
                    <div class="form-group" id='branch_v'>
                      <label>Expense</label><label style="float: right;"><a href="" class='click'>Add Expense</a></label>
                      <select class="form-control" name='exp_name' id='exp_name'>
                        <option value=""></option>
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
                      <input type="text" class="form-control numbersDecimals" id="exp_amount" name="exp_amount" placeholder="Expense Amount"> 
                    </div>
                    <div class="form-group" id="date_v">
                      <label for="exampleInputCustomerPlace">Date</label>
                      <input type="date" class="form-control" id="date" name="date" placeholder="Expense Date" value='<?php echo $date?>'> 
                    </div>
                    <div class="form-group" id="exp_note_v">
                      <label>Note</label>
                      <textarea class="form-control" rows="3" placeholder="" id="exp_note" name="exp_note"></textarea>
                    </div>
                      <div class="form-group">                  
					<button class="btn btn-block btn-success">Add Expense</button>
				  </div>             
                    
                    
                  </div><!-- /.box-body -->

                
            
              </div><!-- /.box -->
 </form>
             </div>
             
              
             

           
            <!-- right column -->
            
            
            
            
            <div class="col-xs-8">
             

              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Day Office Expenses</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                <form action='index.php?action=new&c=expenses'>
                <input type="hidden" name="action" value="new">
                <input type="hidden" name="c" value="expenses">
                     <table>
                      <tr><td></td>
	            <td><input type='hidden' name="branch_name" value="<?php echo $_GET['branch_name']?>"></td></tr><tr><td>Date</td><td>	          
                        <input type='date' name='date' class="form-control" id="inputDate" value='<?php  if(isset($_GET['date'])){echo $_GET['date'];}else{ echo $date1;}?>'>
                        </td></tr><tr><td></td><td>
                        <input type="submit" value='Get Exp'/>&nbsp;
                        </td>
                      </tr></table>
                        </form>
                        
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Expense</th>
                        <th>Amount</th>                      
                        <th>Note</th>
                        <th>Action</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                       <?php        
                       $lug=0;
                       $ham=0;
                       if(isset($_GET["date"]))
                       {
                       	$date=$_GET["date"];
                       }
                      
                                  $data = mysql_query("SELECT sk_tran_id,debit,tran_type,tran_desc,note FROM txn_transaction where tran_date='$date' and tran_type='Expenses' and branch_id='$session_branch'");
                                  while($info = mysql_fetch_array( $data ))
                                  {       
                                  	if($info['debit']>0)
                                  	{                           	
                                  ?>
                      <tr>
								<td><?php echo $info['tran_desc']?></td>
									<td><?php echo $info['debit']?></td>						
									
									<td><?php echo $info['note']?></td>
									<td><a href="index.php?action=expenses_edit&c=transactions&tran_id=<?php echo $info['sk_tran_id']?>">Edit</a></td>
									</tr>
                     <?php }}?>
                    </tbody>
                    
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
            
            
            
            
            
            
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
      
        