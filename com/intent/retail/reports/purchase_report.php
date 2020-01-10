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
                  <h3 class="box-title">DayBook Report</h3>
                </div><!-- /.box-header -->
                <div class="box-body" style="overflow: auto">
                
                <form action='?action=financial&c=reports'>
                <input type="hidden" name="action" value="purchase_report">
                <input type="hidden" name="c" value="reports">
                     <table>
                      <tr><td>From Date</td><td>	          
                        <input type='date' name='from_date' class="form-control" id="inputDate" value='<?php  if(isset($_GET['from_date'])){echo $_GET['from_date'];}else{ echo $date1;}?>'>
                        </td><td></td>
                        <td>To Date</td><td>	          
                        <input type='date' name='to_date' class="form-control" id="inputDate" value='<?php  if(isset($_GET['to_date'])){echo $_GET['to_date'];}else{ echo $date1;}?>'>
                        </td>
                        <td>Bill Type</td><td>	          
                        <select name='bill_type' class="form-control" id="bill_type">
                        <option value="Purchase">Purchase</option>
                        <option value="Return">Return</option>
                        </select>
                        </td><td></td><td>
                        <input type="submit" value='Get Report'/>&nbsp;
                         <?php 
                        if(isset($_GET["from_date"]))
                        {	?>
                        	<a class='btn btn-success' href="print/daybook_print.php?branch_name=<?php echo $_GET["branch_name"]?>&date=<?php echo $_GET['date']?>">Print</a>
                        	<?php 
                        }
                        ?></td>
                      </tr></table>
                        </form><br/>
                        </div>
                        </div>
                        </div>
            <!-- right column -->
            <?php $q="";
            if(isset($_GET["from_date"])){
           		$q=" and bill_date between '".$_GET["from_date"]."' and '".$_GET["to_date"]."'";
           if($_GET["from_date"]=="" && $_GET["to_date"]==""){$q="";}
            $received_amt=0;
            ?>
            <div class="col-md-12">
              
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Purchase Bills</h3>
                </div><!-- /.box-header -->
                <div class="box-body" style="overflow: auto">
                <table id="" class="table table-bordered table-striped" style="font-size: 12px">
                    <thead>
                      <tr><th>SlNo</th>
                        <th>Bill&nbsp;Date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th><th>Bill Type</th><th>Slip No</th>
                        <th>Customer Name</th><th>Mobile</th>
                        <th>Purchase Exp</th> <th>Billing Amount</th> 
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody id='div_print' style="font-size: 12px;">
                    <?php
                    $credit_payment=0;$i=1;
                     if($_GET["bill_type"]=="Purchase"){
                    $data = mysql_query("SELECT sk_bill_id,bill_date,member_name,member_id,mobile,place,bill_for,bill_type,slip_no,bill_amount,measurement_slip_no,purchase_exp, bill_tax_amount, grand_total FROM mst_bill_main where bill_for='Supplier' $q order by bill_date desc");
                     }else{
                     	 $data = mysql_query("SELECT sk_bill_id,bill_date,member_name,member_id,mobile,place,bill_for,bill_type,slip_no,bill_amount,measurement_slip_no,purchase_exp, bill_tax_amount, grand_total FROM mst_bill_main where bill_for='Supplier' $q order by bill_date desc");
                     }
                    while($info = mysql_fetch_array( $data ))
	                	{      
	                		
	                		
	                		
							$member_name="";
							$mobile="";
							$member_id=$info["member_id"];
							if($member_id!=0){
		                		$data1 = mysql_query("SELECT member_name,mobile FROM mst_member where sk_member_id='$member_id'");
			                	while($info1 = mysql_fetch_array( $data1 ))
			                	{
			                		$member_name=$info1["member_name"];
			                		$mobile=$info1["mobile"];
			                	}
							}else{
								$member_name=$info["member_name"];
								$mobile=$info["mobile"];
							}
	                		$credit_payment=$credit_payment+$info["grand_total"];    
	                		
	                		$purchase_exp=$purchase_exp+$info["purchase_exp"];
	                		 
                    ?><tr><td><?php echo $i?>
                    <td><a href='?action=purchase_edit&c=inventory&bill_no=<?php echo $info["sk_bill_id"]?>' target="blank"><?php $temp=explode("-", $info["bill_date"]);echo $temp[2]."-".$temp[1]."-".$temp[0]?></a></td>
                    <td><?php echo $info["bill_type"]?></td>
                  	<td><a href='?action=purchase_edit&c=inventory&bill_no=<?php echo $info["sk_bill_id"]?>' target="blank">SLIP-<?php echo $info["sk_bill_id"]?></a></td>
                    <td><?php echo $member_name?></td>
                    <td><?php echo $mobile?></td>
                    <td><?php echo $info["purchase_exp"]?></td>
                    <td><?php echo $info["grand_total"]?></td>
                    <td></td>
                    </tr>
                    
                    <?php $i++;}?>
                                </tbody>
                                    <tfoot>
                                    <tr><td></td><td></td><td></td><td></td><td></td><td></td><td><?php echo $purchase_exp?></td><td><?php echo $credit_payment?></td><td></td></tr>
                                    </tfoot>
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