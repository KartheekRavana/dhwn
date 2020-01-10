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
            <form role="form" onsubmit="return validate()" action="?action=operations/particular_update&c=particluars" method="POST">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">New Particular</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <input type="hidden" class="form-control" value="<?php echo $_GET["cid"]?>" id="particluar_id" name="particluar_id">
                  <div class="box-body">
                  <?php 
                  $category_id=0;
                  $data1 = mysql_query("SELECT particular_name,category_id FROM mst_particular where sk_particular_id='".$_GET["cid"]."'");
                    		while($info1 = mysql_fetch_array( $data1 ))
                    		{
                    			$particular_name=$info1["particular_name"];
                    			$category_id=$info1["category_id"];
                    		}
                  ?>
                    <div class="form-group">
                      <label for="exampleInputCustomerName">Category Name</label>
                      <select class="form-control" id="category" name="category" placeholder="Enter Category Name" required="required">
                     <?php 
                      	$data = mysql_query("SELECT sk_particular_id, particular_name, particular_desc, category_id, sub_category_id, particular_status, branch_id FROM mst_particular where category_id='".$category_id."'");
                    	while($info = mysql_fetch_array( $data ))
                    	{
                      ?>
                      <option value="<?php echo $info["sk_particular_id"]?>"><?php echo $info["particular_name"]?></option>
                      <?php }?>
                      <?php 
                      	$data = mysql_query("SELECT sk_particular_id, particular_name, particular_desc, category_id, sub_category_id, particular_status, branch_id FROM mst_particular where category_id='0' and particular_status='active' and branch_id='$session_branch'");
                    	while($info = mysql_fetch_array( $data ))
                    	{
                      ?>
                      <option value="<?php echo $info["sk_particular_id"]?>"><?php echo $info["particular_name"]?></option>
                      <?php }?>
                      </select>
                    </div>
                     <div class="form-group">
                      <label for="exampleInputCustomerName">Particular Name</label>
                      <input type="text" class="form-control" value="<?php echo $particular_name?>" id="particluar" name="particluar" placeholder="Enter Particular Name" required="required">
                    </div>
                      <div class="form-group">                  
					<button class="btn btn-block btn-success">Update Particular</button>
				  </div>  
                      
                  </div><!-- /.box-body -->
         
              </div><!-- /.box -->
</form>
             

              
              

            </div><!--/.col (left) -->
            <!-- right column -->
            
                  
                
           
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
      
