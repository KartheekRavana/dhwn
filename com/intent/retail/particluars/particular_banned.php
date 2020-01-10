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
        	
            
            <!-- right column -->
            <div class="col-md-8">
              <!-- general form elements disabled -->
              <div class="box box-warning">
                <div class="box-header">
                  <h3 class="box-title">Particular List</h3>
                  <span class='pull-right'><a href="?action=new&c=particluars">View Active Particluars</a></span>
                </div><!-- /.box-header -->
                <div class="box-body">
                 <table id="example1" class="table table-bordered table-striped" style="font-size: 12px">
                    <thead>
                      <tr>
                      	<th>Category&nbsp;Name</th>
                      	<th>Particular&nbsp;Name</th>
                        <th>Action</th>                        
                      </tr>
                    </thead>
                    <tbody>
                    	<?php 
                    	$data = mysql_query("SELECT sk_particular_id, particular_name, particular_desc, category_id, sub_category_id, particular_status, branch_id FROM mst_particular where category_id!='0' and particular_status='inactive' and branch_id='$session_branch'");
                    	while($info = mysql_fetch_array( $data ))
                    	{
                    		$category="";
                    		$data1 = mysql_query("SELECT particular_name FROM mst_particular where sk_particular_id='".$info["category_id"]."'");
                    		while($info1 = mysql_fetch_array( $data1 ))
                    		{
                    			$category=$info1["particular_name"];
                    		}
                    	?>
                    <tr>
                    	 <td><?php echo $category?></td>
                         <td><?php echo $info['particular_name']?></td>
                         <td><a href='?action=operations/category_activate&c=particluars&cid=<?php echo $info['sk_particular_id']?>&page=particular_banned'><span class="label label-success">Activate</span></a> </td>
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
      
