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
            
                <div class="col-md-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Log Report</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                
                <form action='?action=log_report&c=reports'>
                <input type="hidden" name="action" value="log_report">
                <input type="hidden" name="c" value="reports">
                     <table>
                      <tr><td>From Date</td><td>	          
                        <input type='date' name='from_date' class="form-control" id="inputDate" value='<?php  if(isset($_GET['from_date'])){echo $_GET['from_date'];}else{ echo $date1;}?>'>
                        </td><td></td>
                        <td>To Date</td><td>	          
                        <input type='date' name='to_date' class="form-control" id="inputDate" value='<?php  if(isset($_GET['to_date'])){echo $_GET['to_date'];}else{ echo $date1;}?>'>
                        </td><td></td><td>
                        <input type="submit" value='Get Report'/>&nbsp;
                         </td>
                      </tr></table>
                        </form><br/>
                        </div>
                        </div>
                        </div>
            <!-- right column -->
            <?php
            if(isset($_GET["from_date"])){
            	$from_date=$_GET["from_date"];
            	$to_date=$_GET["to_date"];
            	
            ?>
            <div class="col-md-12">
              
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Log Details</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                <table id="" class="table table-bordered table-striped" style="font-size: 12px">
                    <thead>
                      <tr>
                        <th>Sl NO</th><th>Employee</th><th>Date</th><th>Type</th><th>Particular</th><th>Description</th>
                      </tr>
                    </thead>
                    <tbody id='div_print' style="font-size: 12px;">
                    <?php
                    $i=1;
                    $data = mysql_query("SELECT `sk_log_id`, `tran_date`, `tran_time`, `member_type`, `tran_type`, `tran_desc`, `tran_table`, `member_id`, `bill_id`, `tran_id`, `branch_id`, `employee_id` FROM txn_log where tran_date between '$from_date' and '$to_date' order by tran_time");
	                	while($info = mysql_fetch_array( $data ))
	                	{      
							$member_name="";
	                		$data1 = mysql_query("SELECT member_name FROM mst_member where sk_member_id='".$info["member_id"]."'");
	                	while($info1 = mysql_fetch_array( $data1 ))
	                	{     
	                		$member_name=$info1["member_name"];
	                	}
	                	$employee_name="";
	                		$data1 = mysql_query("SELECT member_name FROM mst_member where sk_member_id='".$info["employee_id"]."'");
	                	while($info1 = mysql_fetch_array( $data1 ))
	                	{     
	                		$employee_name=$info1["member_name"];
	                	}
                    ?><tr>
                    <td><?php echo $i++?></td>
                     <td><?php echo $employee_name?></td>
                     <td><?php echo $info['tran_date']?></td>
                    <td><?php echo $info['member_type']?> (<?php echo $info['tran_type']?> )</td>
                    <td><?php echo $member_name?></td>
                    <td><?php echo $info['tran_desc']?></td>
                    
                    </tr>
                    
                    <?php }?>
                                </tbody>
                                    
                  </table>
                  
                </div><!-- /.box-body -->
              </div><!-- /.box -->
              
             
              
              
                    
    	</div>   
               <?php }?>  
                 
                 
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