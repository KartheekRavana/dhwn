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
                <div class="box-body">
                
                <form action='?action=financial&c=reports'>
                <input type="hidden" name="action" value="purchase_excel">
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
            <?php $q="";
            if(isset($_GET["from_date"])){
           		$q=" and bill_date between '".$_GET["from_date"]."' and '".$_GET["to_date"]."'";
           if($_GET["from_date"]=="" && $_GET["to_date"]==""){$q="";}
            $received_amt=0;
            ?>
            <div class="col-md-12" style="overflow: scroll;">
              
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Purchase Bills</h3>
                </div><!-- /.box-header -->
                <div class="box-body" style="overflow: scroll;">
                <table id="" class="table table-bordered table-striped" style="font-size: 12px">
                    <thead>
                      <tr>
                        <th>Bill Date</th><th>Bill Type</th><th>Bill No</th>
                        <th>Supplier Id</th><th>Supplier Name</th><th>Mobile</th>
                        <th>Billing Amount</th> <th>Grand Total</th> 
                         <td></td><th>Barcode</th><th>Category</th><th>Item Name</th><th>Note</th><th>Qty In Piece</th><th>Qty In Sft</th><th>Rate</th><th>Discount</th><th>vat</th><th>Amount</th>
              
                      </tr>
                    </thead>
                    <tbody id='div_print' style="font-size: 12px;">
                    <?php
                    $credit_payment=0;$i=1;
                    $data = mysql_query("SELECT sk_bill_id,bill_date,member_name,member_id,mobile,place,bill_for,bill_type,bill_amount,measurement_slip_no,bill_tax_amount FROM mst_bill_main where bill_for='Supplier' $q order by bill_date");
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
	                		$credit_payment=$credit_payment+$info["bill_amount"];     
                    ?>
                    
                    <?php 
	                	   $data5 = mysql_query("SELECT sk_tran_id, bill_id, bill_for, bill_type, bill_date, particular_id,description, qty_in_piece, qty_in_sft, rate,vat,discount, amount,landing_cost, bill_status, employee_id, branch_id,note FROM txn_bill_support where bill_id='".$info["sk_bill_id"]."' and qty_in_sft>0");
	           while($info5 = mysql_fetch_array( $data5 ))
	           {
	           	$item_id=$info5["particular_id"];
	           	$item_qty=$info5["qty_in_sft"];
	           	$item_qty_p=$info5["qty_in_piece"];
	           	$item_rate=$info5["rate"];
	           	$amt=$info5["amount"];
	           	$description=$info5["description"];
	           	$item_discount=$info5["discount"];
	           	$barcode="";
	           	$item_note=$info5["note"];
	          $vat=$info5["vat"];
	          
	           	$data1 = mysql_query("SELECT item_id, item_name, item_status, kannada_name, category, branch FROM items where item_id='$item_id'");
	           	while($info1 = mysql_fetch_array( $data1 ))
	           	{
	           		$barcode=$info1["item_id"]."-";
	           		$item_name=$info1["item_name"];
	           		$category_id=$info1["category"];
	           	}
	           	 
	           	$data1 = mysql_query("SELECT category_id, category_name, category_status, branch FROM category where category_id='$category_id'");
	           	while($info1 = mysql_fetch_array( $data1 ))
	           	{
	           		$category_name=$info1["category_name"];
	           	}
                $barcode=$barcode.$info5["sk_tran_id"];    
	           	?>
                  <tr>
                    <td><?php $temp=explode("-", $info["bill_date"]);echo $temp[2]."-".$temp[1]."-".$temp[0]?></td>
                    <td><?php echo $info["bill_type"]?></td>
                  	<td><?php echo $info["sk_bill_id"]?></td><td><?php echo $member_id?></td>
                    <td><?php echo $member_name?></td>
                    <td><?php echo $mobile?></td>
                    <td><?php echo $info["bill_amount"]?></td>
                    <td><?php echo $info["bill_tax_amount"]?></td>
                   
               <td></td>
                <td><?php echo $barcode?></td>
                <td><?php echo $category_name?></td>
                <td><?php echo $item_name?> (<?php echo $description?>)</td>
                <td><?php echo $item_note?></td>
                <td><?php echo $item_qty_p?></td>
                <td><?php echo $item_qty?></td>
                <td><?php echo $item_rate?></td>
              
                <td><?php echo $item_discount?></td>   <td><?php echo $vat?></td>
                <td><?php echo $amt?></td>
              
             
               
                 
                 <?php }?>   
                   
                    
                    <?php $i++;}?>
                                </tbody>
                                    <tfoot>
                                    <tr><td></td><td></td><td></td><td></td><td></td><td><?php echo $credit_payment?></td><td></td></tr>
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