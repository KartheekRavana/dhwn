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
                <input type="hidden" name="action" value="sales_data">
                <input type="hidden" name="c" value="reports">
                     <table>
                      <tr>
                      <td>From Date</td>
                      	<td>	          
                        	<input type='date' name='from_date' class="form-control" id="inputDate" value='<?php  if(isset($_GET['from_date'])){echo $_GET['from_date'];}else{ echo $date1;}?>'>
                        </td>
                        <td>
                        	<select name="bill_type" class="form-control">
                        	<?php if(isset($_GET['from_date'])){?>
                        		<option value="<?php echo $_GET['bill_type']?>"><?php echo $_GET['bill_type']?></option>
                        	<?php }?>
                        		<option value="Sales">Sales</option>
                        		<option value="Return">Return</option>
                        	</select>
                        </td>
                        <td>
                        <input type="submit" value='Get Report'/>&nbsp;
                         <?php 
                        if(isset($_GET["from_date"]))
                        {	?>
                        	<a class='btn btn-success' href="?action=print/sales_data&c=reports&from_date=<?php echo $_GET['from_date']?>&bill_type=<?php echo $_GET['bill_type']?>">Print</a>
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
				$bill_type=$_GET["bill_type"];
				$btype="";
				if($bill_type=="Sales")
				{
					$btype="bill_type='cash' ";
				}
				else {
					$btype="bill_type='cash ret' or bill_type='cash return' ";
				}
           		$q=" and bill_date='".$_GET["from_date"]."'";
           if($_GET["from_date"]==""){$q="";}
            $received_amt=0;
            ?>
            <div class="col-md-12">
              
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title"><?php if($bill_type=="Sales"){?>Sales Bills<?php }else{?>Return Bills<?php }?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                <table id="example1" class="table table-bordered table-striped" style="font-size: 12px">
                    <thead>
                      <tr>
                        <th>Bill Date</th><th>Item</th><th>Discription</th>
                        <th>Qty in PCS</th><th>Qty in SFT</th> <th>Rate</th> <th>Discount</th> <th>Vat</th>
                        <th>Billing Amount</th> 
                       
                      </tr>
                    </thead>
                    <tbody id='div_print' style="font-size: 12px;">
                    <?php
                    $total=0;
					//echo "====== SELECT distinct(description) as description FROM txn_bill_support where bill_for='Customer' and $btype and bill_date='".$_GET["from_date"]."'";
                      $data1 = mysql_query("SELECT distinct(description) as description,particular_id FROM txn_bill_support where bill_for='Customer' and $btype and bill_date='".$_GET["from_date"]."'");
	                	while($info1 = mysql_fetch_array( $data1 ))
	                	{    
                   	$qty_pcs=0;$amount=0;
                   	$qty_sft=0;$rate=0;$discount=0;$vat=0;
                    	$data = mysql_query("SELECT sk_tran_id, bill_id, bill_for, bill_type, bill_date, particular_id, description, qty_in_piece, qty_in_sft, rate, discount, vat, amount, landing_cost, bill_status, note, employee_id, branch_id FROM txn_bill_support where bill_for='Customer' and $btype and particular_id='".$info1['particular_id']."' and description='".$info1["description"]."' and bill_date='".$_GET["from_date"]."'");
	                	while($info = mysql_fetch_array( $data ))
	                	{      
							$member_name="";
							$mobile="";
							$particular_id=$info["particular_id"];
							$qty_pcs=$qty_pcs+$info["qty_in_piece"];
							$qty_sft=$qty_sft+$info["qty_in_sft"];
							//$rate=$info["rate"]/$qty_sft;
							$discount=$info["discount"];
							$vat=$info["vat"];
							$amount=$amount+$info["amount"];
							$rate=$amount/$qty_sft;
		                		$data3 = mysql_query("SELECT item_name FROM items where item_id='$particular_id'");
			                	while($info2 = mysql_fetch_array( $data3 ))
			                	{
			                		$particular_name=$info2["item_name"];
			                	}
	                	}
							     
                    ?><tr>
                    <td><?php $temp=explode("-", $info["from_date"]);echo $temp[2]."-".$temp[1]."-".$temp[0] ?></td>
                    <td><?php echo $particular_name?></td>
                  	<td><?php echo $info1["description"]?></td>
                    <td><?php echo $qty_pcs?></td>
                      <td><?php echo $qty_sft?></td>
                    <td><?php echo number_format($rate,2)?></td>
                      <td><?php echo $discount?></td>
                        <td><?php echo $vat?></td><td><?php echo $amount?></td>
                    <td></td>
                    </tr>
                    
                    <?php
                    	$total=$total+$amount; 
	                	}?>
                                </tbody>
                                <tfoot>
                                <tr>
                                	<td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                	<td>Total</td><td><?php echo $total?></td>
                                </tr>
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