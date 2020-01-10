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
                <input type="hidden" name="action" value="sales_report">
                <input type="hidden" name="c" value="reports">
                     <table>
                      <tr><td>From Date</td><td>	          
                        <input type='date' name='from_date' class="form-control" id="inputDate" value='<?php  if(isset($_GET['from_date'])){echo $_GET['from_date'];}else{ echo $date1;}?>'>
                        </td><td></td>
                        <td>To Date</td><td>	          
                        <input type='date' name='to_date' class="form-control" id="inputDate" value='<?php  if(isset($_GET['to_date'])){echo $_GET['to_date'];}else{ echo $date1;}?>'>
                        </td>
                        <td>Bill Type</td><td>	          
                        <?php
                        $select1="";$select2="";$select3="";$select4="";$select5="";
                        if(isset($_GET["from_date"]))
                        {
                        	if($_GET["bill_type"]=="Sales") $select1="selected";else $select2="selected";
                        	if($_GET["payment_type"]=="All")
                        		$select3="selected";
                        	else if($_GET["payment_type"]=="Cash") 
                        		$select4="selected";
                        	else if($_GET["payment_type"]=="Credit")
                        		$select5="selected";
                        	
                        } 
                        ?>
                        <select name='bill_type'  class="form-control" id="bill_type">
                        <option <?php echo $select1?> value="Sales">Sales</option>
                        <option <?php echo $select2?> value="Return">Return</option>
                        </select>
                        </td>
                        <td>Payment Type</td>
                        <td>
                        	<select name='payment_type' class="form-control" id="payment_type">
                        		<option <?php echo $select3?> value="All">All</option>
                        		<option <?php echo $select4?> value="Cash">Cash</option>
                        		<option <?php echo $select5?> value="Credit">Credit</option>
                        	</select>
                        </td><td>
                        <input type="submit" value='Get Report'/>&nbsp;
                         <?php 
                        if(isset($_GET["from_date"]))
                        {	?>
                        	<a class='btn btn-success' href="?action=print/sales_report&c=reports&from_date=<?php echo $_GET['from_date']?>&to_date=<?php echo $_GET['to_date']?>&bill_type=<?php echo $_GET["bill_type"]?>&payment_type=<?php echo $_GET["payment_type"]?>">Print</a>
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
				$payment_type=$_GET["payment_type"];
           		$q=" and bill_date between '".$_GET["from_date"]."' and '".$_GET["to_date"]."'";
           if($_GET["from_date"]=="" && $_GET["to_date"]==""){$q="";}
            $received_amt=0;
            ?>
            <div class="col-md-12">
              
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Sales Bills</h3>
                </div><!-- /.box-header -->
                <div class="box-body" style="overflow: auto">
                <table id="" class="table table-bordered table-striped" style="font-size: 12px">
                    <thead>
                      <tr><th>SlNo</th>
                        <th>Bill&nbsp;Date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th><th>Bill Type</th>
                        <th>Customer Name</th><th>Mobile</th>
                        <th>Billing Amount</th> 
                       <th>Note</th> <th>Action</th> 
                      </tr>
                    </thead>
                    <tbody id='div_print' style="font-size: 12px;">
                    <?php
                   
                    $credit_payment=0;$i=1;$return_page='sales_edit';
                     if($_GET["bill_type"]=="Sales" && ($payment_type=="Cash" || $payment_type=="Credit")){
                    		$data = mysql_query("SELECT sk_bill_id,bill_date,member_name,member_id,mobile,place,bill_for,bill_type,bill_amount,measurement_slip_no,slip_no,note,grand_total,t_discount_amount,transport_amount,discount FROM mst_bill_main where bill_for='Customer' and (bill_type='$payment_type') $q order by bill_date ");
                     }
                     else if($_GET["bill_type"]=="Sales" && $payment_type=="All"){
                     	$data = mysql_query("SELECT sk_bill_id,bill_date,member_name,member_id,mobile,place,bill_for,bill_type,bill_amount,measurement_slip_no,slip_no,note,grand_total,t_discount_amount,transport_amount,discount FROM mst_bill_main where bill_for='Customer' and (bill_type='Cash' or bill_type='Credit') $q order by bill_date ");
                     }
                     else if($_GET["bill_type"]=="Return" && $payment_type=="All"){
                     	$return_page="sales_return_edit";
 						$data = mysql_query("SELECT sk_bill_id,bill_date,member_name,member_id,mobile,place,bill_for,bill_type,bill_amount,measurement_slip_no,slip_no,note,grand_total,t_discount_amount,transport_amount,discount FROM mst_bill_main where bill_for='Customer' and (bill_type='Cash Retur' or bill_type='Credit Ret' or bill_type='Cash Return' or bill_type='Credit Return') $q order by bill_date ");
                     }
                     else if($_GET["bill_type"]=="Return" && ($payment_type=="Cash" || $payment_type=="Credit")){
                     	$return_page="sales_return_edit";
                     	$data = mysql_query("SELECT sk_bill_id,bill_date,member_name,member_id,mobile,place,bill_for,bill_type,bill_amount,measurement_slip_no,slip_no,note,grand_total,t_discount_amount,transport_amount,discount FROM mst_bill_main where bill_for='Customer' and (bill_type='$payment_type Retur' or bill_type='$payment_type Ret' or bill_type='$payment_type Return') $q order by bill_date ");
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
							//echo $info["t_discount_amount"];
	                		$credit_payment=$credit_payment+$info["bill_amount"]-$info["t_discount_amount"]+$info["transport_amount"];     
                    ?><tr><td><?php echo $i?></td>
                    <td><a href='?action=<?php echo $return_page?>&c=stock&bill_no=<?php echo $info["sk_bill_id"]?>' target="blank"><?php $temp=explode("-", $info["bill_date"]);echo $temp[2]."-".$temp[1]."-".$temp[0]?></a></td>
                    <td><?php echo $info["bill_type"]?></td>
                  
                    <td><?php echo $member_name?></td>
                    <td><?php echo $mobile?></td>
                    <td><?php echo $info["grand_total"]+$info["transport_amount"]-$info["discount"]?></td>
                     <td><?php echo $info["note"]?></td>
                     <td> <a target="blank" href='index.php?action=print/print_bill_barcode&c=inventory&bill_no=<?php echo $info['sk_bill_id']?>&op=print'>Print</a></td>
                    </tr>
                    
                    <?php $i++;}?>
                                </tbody>
                                    <tfoot>
                                    <tr><td></td><td></td><td></td><td></td><td></td><td><?php echo $credit_payment?></td></tr>
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