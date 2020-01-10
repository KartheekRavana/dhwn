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
        
        <?php 
        $member_name="";
        $data = mysql_query("SELECT sk_member_id, member_type, member_name, acc_no, ifsc, mobile, landline, email, address, place, state, profile_pic, login_name, login_password, login_status, employee_id, branch_id,member_status FROM mst_member where sk_member_id='$session_id'");
                    	while($info = mysql_fetch_array( $data ))
                    	{
                    		$member_name=$info["member_name"];
                    		$address=$info["address"];
                    		$place=$info["place"];
                    		$email=$info["email"];
                    		$mobile=$info["mobile"];
                    		$landline=$info["landline"];
                    		$member_type=$info["member_type"];
                    	}
        ?>
        
          <div class="row">
            <!-- left column -->
        	<form role="form" onsubmit="return validate()" action="?action=operations/password_update&c=members" method="POST">
        	<input type='hidden' name='member_id' value="<?php echo $_GET["m_id"]?>">
            <div class="col-md-4">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Update Password</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                
                  <div class="box-body">
                  
                    <div class="form-group" id="customer_name_v">
                      <label for="exampleInputCustomerName">New Password</label>
                      <input type="text" class="form-control" id="password" value="" name="password" placeholder="Enter Member Name" required="required">
                    </div>
                    
                      <div class="form-group">                  
					<button class="btn btn-block btn-success">Update Member</button>
				  </div>  
                  </div><!-- /.box-body -->

                  
                
              </div><!-- /.box -->

             

              
              

            </div><!--/.col (left) -->
            <!-- right column -->
            
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
      
