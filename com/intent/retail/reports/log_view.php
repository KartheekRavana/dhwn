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
            
            <!-- right column -->
            <div class="col-md-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">View Log Details</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th class='hidden-xs'>SlNo</th>
                        <th class='hidden-xs'>Description</th>
                        <td>Date&nbsp;and&nbsp;Time</td> 
                      </tr>
                    </thead>
                    <tbody id='div_print' style="font-size: 12px;">
                                       <?php 
                        		         $i=1;
                        		$tran_id=$_GET["t_id"];
                                $data = mysql_query("SELECT  sk_log_id,tran_type,tran_desc,log_time,tran_id,tran_table,branch_id,employee_id FROM txn_log where tran_id='$tran_id' and tran_type='Loan' order by sk_log_id desc");
                                  if($data)
                                  while($info = mysql_fetch_array( $data ))
                                  {  
                                  ?>
                                   <tr>
                                   <td class='hidden-xs'><?php echo $i++;?></td>
                                   <td><?php echo $info["tran_desc"]?></td>
                                   <td><?php echo $info["log_time"]?></td>
                                   </tr>
                                   <?php }?>
                                   
                                    </tbody>
                  </table>
                  
                </div><!-- /.box-body -->
              </div><!-- /.box -->
                    
    </div>   
                 
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