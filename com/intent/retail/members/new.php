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
            <!-- left column -->
        	<form role="form" onsubmit="return validate()" action="?action=operations/member_save&c=members" method="POST">
            <div class="col-md-4">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Member Details</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                
                  <div class="box-body">
                  <div class="form-group" id="customer_name_v">
                      <label for="exampleInputCustomerName">Member Type</label>
                      <select class="form-control" id="member_type" name="member_type" required>
                      	<option value=""></option>
                      	<?php 
                      	$data = mysql_query("SELECT sk_member_type_id, member_type, member_type_status, branch_id from mst_member_type where member_type_status='active' and sk_member_type_id!=6 and branch_id='$session_branch'");
                      	while($info = mysql_fetch_array( $data ))
                      	{
                      	?>
                      	<option value="<?php echo $info["sk_member_type_id"]?>"><?php echo $info["member_type"]?></option>
                      	<?php }?>
                      </select>
                    </div>
                    <div class="form-group" id="customer_name_v">
                      <label for="exampleInputCustomerName">Member Name</label>
                      <input type="text" class="form-control" id="member_name" name="member_name" placeholder="Enter Member Name" required="required">
                    </div>
                    <div class="form-group" id="address_v">
                      <label>Address</label>
                      <textarea class="form-control" rows="3" placeholder="" id="address" name="address"></textarea>
                    </div>
                    <div class="form-group" id="customer_place_v">
                      <label for="exampleInputCustomerPlace">Place</label>
                      <input type="text" class="form-control" id="place" name="place" placeholder="Place"> 
                    </div>
                     
                    
                  </div><!-- /.box-body -->

                  
                
              </div><!-- /.box -->

             

              
              

            </div><!--/.col (left) -->
            <!-- right column -->
            <div class="col-md-4">
              <!-- general form elements disabled -->
              <div class="box box-warning">
                <div class="box-header">
                  <h3 class="box-title">Member Contact Details</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                 <div class="form-group" id="email_v">
                      <label for="exampleInputCustomerPlace">E_Mail</label>
                      <input type="email" class="form-control" id="email" name="email" placeholder="Customer Mail_Id"> 
                    </div>
                    <!-- text input -->
                    <div class="form-group" id="phone1_v">
                      <label>Phone 1</label>
                      <input type="text" class="form-control onlyNumbers" maxlength="10" name="phone1" id="phone1" placeholder="must be a number">
                    </div>
                    <div class="form-group" >
                      <label>Phone 2</label>
                      <input type="text" class="form-control onlyNumbers" maxlength="10" name="phone2" id="phone2" placeholder="must be a number">
                    </div>
                     
<div class="form-group" >
                      <label>Salary</label>
                      <input type="text" class="form-control onlyNumbers" maxlength="10" value="0" name="salary" id="salary" placeholder="must be a number">
                    </div>
                    
                    <div class="form-group" >
                      <label>Login Name</label>
                      <input type="text" class="form-control" value="" name="login_name" id="login_name" placeholder="">
                    </div>
                    <div class="form-group" >
                      <label>Login Password</label>
                      <input type="text" class="form-control" value="" name="login_pwd" id="login_pwd" placeholder="">
                    </div>
                    <!-- select -->
                    
                    
				  <div class="form-group">                  
					<button class="btn btn-block btn-success">Add Member</button>
				  </div>  
                      
                    </div>
				</div><!-- /.box-body -->
              </div><!-- /.box -->
                  </form>
                
           
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
      
