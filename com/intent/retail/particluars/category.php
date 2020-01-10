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
        	
            <div class="col-md-4">
            <form role="form" onsubmit="return validate()" action="?action=operations/category_save&c=particluars" method="POST">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">New Category</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                
                  <div class="box-body">
                  
                    <div class="form-group">
                      <label for="exampleInputCustomerName">Category Name</label>
                      <input type="text" class="form-control" id="category" name="category" placeholder="Enter Category Name" required="required">
                    </div>
                   
                      <div class="form-group">                  
					<button class="btn btn-block btn-success">Add Category</button>
				  </div>  
                      
                  </div><!-- /.box-body -->
         
              </div><!-- /.box -->
</form>
             

              
              

            </div><!--/.col (left) -->
            <!-- right column -->
            <div class="col-md-8">
              <!-- general form elements disabled -->
              <div class="box box-warning">
                <div class="box-header">
                  <h3 class="box-title">Category List</h3>
                  <span class='pull-right'><a href="?action=category_banned&c=particluars">View Banned</a></span>
                </div><!-- /.box-header -->
                <div class="box-body">
                 <table id="example1" class="table table-bordered table-striped" style="font-size: 12px">
                    <thead>
                      <tr>
                      	<th>Category&nbsp;Name</th>
                        <th>Action</th>                        
                      </tr>
                    </thead>
                    <tbody>
                    	<?php 
                    	$data = mysql_query("SELECT sk_particular_id, particular_name, particular_desc, category_id, sub_category_id, particular_status, branch_id FROM mst_particular where category_id='0' and particular_status='active' and branch_id='$session_branch'");
                    	while($info = mysql_fetch_array( $data ))
                    	{
                    	?>
                    <tr>
                         <td><?php echo $info['particular_name']?></td>
                         <td><a href='?action=operations/category_ban&c=particluars&cid=<?php echo $info['sk_particular_id']?>&page=category'><span class="label label-danger">Ban</span></a> </td>
                    </tr>
                    <?php }?>
                   
                                   
                   </tbody>
                 
                  </table>
                    
				
                    </div>
				</div><!-- /.box-body -->
              </div><!-- /.box -->
                  
                
           
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
      
