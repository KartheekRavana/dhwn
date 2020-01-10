<?php include_once "$D_PATH/include/session.php";?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
         <?php include_once "$D_PATH/include/title.php";?>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
   <?php include_once "$D_PATH/include/scripts_top.php";?>
  
  </head>
   <body class="<?php echo $body_style?>">
    <div class="wrapper">
      
       <!-- ---------------------------------------------------POPUP--------------------------------------------------------------------------- -->
<div class='popup'>
<div class='content_popup'>
<img src='<?php echo $UI_ELEMENTS?>notify/img/img.png' alt='quit' class='x' id='x'></img>
<div>
<p id="load_data">


<section class="content">
        
          
            <div class="row">
            <!-- left column -->
             
            <div class="col-md-6">
              <!-- general form elements -->
              <form action="index.php?action=operations/partner_invest&c=partners" method="post">
              
              <input type='hidden' id='employee' name='employee' value='<?php echo $session_id?>'>
                            <input type='hidden' id='branch' name='branch' value='<?php echo $session_branch?>'>
                            <input type='hidden' id='mode' name='mode' value='deposit'>                               
                            <input type='hidden' id='person_id' name='person_id' value=''>  
                            
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">INVESTMENT</h3>
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
                      <label for="exampleInputFullName">Enter Amount to be Invested</label>
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
                    <input type="radio" name="t_type" value="Cash" onclick="checkCust()" id="Others" checked="checked">
                    <label for="exampleInputFullName">Cash Deposit</label>                 
                    <br><input type="radio" name="t_type" value="Bank" onclick="checkCust()" id="bank">
                    <label for="exampleInputFullName">Bank Deposit</label>
                    </div>
                    
                    <div class="box-body" id='c' style="visibility: hidden;position: absolute;">
                      <div class="form-group">
                      <label for="exampleInputFullName">Bank Name</label>
                    <select class="form-control" id="c_name" name="c_name">
	               <option value=""></option>
	                <?php 
                                   
                                  $data = mysql_query("SELECT bank_id, bank_name, acc_no, balance, login_id, branch FROM banks order by bank_name asc");
                                  if($data)
                                  while($info = mysql_fetch_array( $data ))
                                  {
                                  ?>  
	               <option  value="<?php echo $info["bank_id"]?>"><?php echo $info["bank_name"]?></option>
	               <?php }?>
	               </select>
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
          <div class="col-md-6">
              <!-- general form elements -->
               <form action="index.php?action=operations/partner_withdrawl&c=partners" method="post">
               
               <input type='hidden' id='employee' name='employee' value='<?php echo $session_id?>'>
                  <input type='hidden' id='branch' name='branch' value='<?php echo $session_branch?>'>
                            <input type='hidden' id='mode' name='mode' value='withdraw'>                               
                            <input type='hidden' id='person_id1' name='person_id1' value=''>  
                            
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
                      <span  id='amount_v'></span>
                    </div>
                    </div>
                    <div>                                     
                    <div>                                     
                    <input type="radio" name="t_type_s" value="Cash" onclick="checkSup()" id="tran_type3" checked="checked">
                    <label for="exampleInputFullName">Cash Withdrawl</label>                 
                    <br><input type="radio" name="t_type_s" value="Bank" onclick="checkSup()" id="tran_type4">
                    <label for="exampleInputFullName">Bank Withdrawl</label>
                    </div>
                    
                     <div class="box-body" id='s' style="visibility: hidden;position: absolute;">
                      <div class="form-group">
                      <label for="exampleInputFullName">Bank Name</label>
                    <select id="s_name" name="c_name" class="form-control">
	               <option value=""></option>
	                <?php 
                                   
                                  $data = mysql_query("SELECT bank_id, bank_name, acc_no, balance, login_id, branch FROM banks order by bank_name asc");
                                  if($data)
                                  while($info = mysql_fetch_array( $data ))
                                  {
                                  ?>  
	               <option  value="<?php echo $info["bank_id"]?>"><?php echo $info["bank_name"]?></option>
	               <?php }?>
	               </select>
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
          
            
          </div>   <!-- /.row -->
          
                 
        </section>



</p>
</div>
</div>
</div>   
<!-- ---------------------------------------------------POPUP--------------------------------------------------------------------------- -->      
      
      
      <?php include_once "$D_PATH/include/header.php";?> 
      <!-- Left side column. contains the logo and sidebar -->
       <?php include_once "$D_PATH/include/side.php";?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
             Partner Payments
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php?action=index&c=dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Partner</a></li>
            <li class="active">View Partner</li>
          </ol>
        </section>
          <section class="content">
          
          <form role="form" onsubmit="return validate()" action="index.php?action=operations/partner_payment&c=members" method="POST">
          <input type='hidden' id='branch' name='branch' value='<?php echo $session_branch?>'/>
		<input type='hidden' id='employee' name='employee' value='<?php echo $session_id?>'/>
          <div class="row">
            <!-- left column -->
            <div class="col-md-4">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Partner Details</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                
                  <div class="box-body">
                          
                          
                       <?php 

$i=1;
				$data = mysql_query("SELECT sk_member_id, member_name,salary FROM mst_member where member_type='7' order by member_name asc");
				while($info = mysql_fetch_array( $data ))
				{					
				?>
						 <label><?php echo $info["member_name"]?></label>
						<label><?php echo $info['salary']?>%<input type='hidden' id='per_<?php echo $i?>' value='<?php echo $info['salary']?>'>
						<input type='hidden' id='per_amt<?php echo $i?>' name='per_amt<?php echo $i?>' value=''>
						<input type='hidden' id='partner_id<?php echo $i?>' name='partner_id<?php echo $i?>' value='<?php echo $info['sk_member_id']?>'>
						<span id='p_<?php echo $i++?>' style="color: green;font-weight: bold;"></span>
						</label><br/>
						
		<?php } ?><input type='hidden' id='count' name='count' value='<?php echo $i-1?>'>   
                                                                                                
                    <div class="form-group" id="employee_v">
                      <label>Profit Amt</label>
                      <input type="text" class="form-control" id="user_name" name="user_name" name='advance' id='advance' placeholder="00.00"  onblur="shareProfit(this.value)">
                    </div>
                    
                    <div class="form-group" id='user_name_v'>
                      <label for="exampleInputFullName">Date</label>
                      <input type="date" class="form-control" id="date" name="date" placeholder="">
                    </div>
                   
                    
				  <div class="form-group">                  
					<button class="btn btn-block btn-success">SUBMIT</button>
				  </div>                                                 
                    
                  </div><!-- /.box-body -->                  
                
              </div><!-- /.box -->        
                  
            </div><!--/.col (left) -->
            
            
            
            
            
            
            
            
            
            <!-- right column -->
            
          </div>   <!-- /.row -->
          
                  </form>
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
<script type="text/javascript">
function shareProfit(amt)
{
	
	var count=document.getElementById("count").value
	
	for(var i=1;i<=count;i++)
	{
		var profit=(amt/100)*document.getElementById("per_"+i).value;
		//alert(profit);
		document.getElementById("p_"+i).innerHTML=profit;
		document.getElementById("per_amt"+i).value=profit
	}
}
function checkCust()
{
	if(document.getElementById("bank").checked==true)
	{
		document.getElementById("c").style.visibility='';
		document.getElementById("c").style.position='';
	}
	else {
		document.getElementById("c").style.visibility='hidden';
		document.getElementById("c").style.position='absolute';
	}
}
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
</script>
<?php include_once "$D_PATH/include/scripts_bottom.php";?> 
</body>
</html>
      
