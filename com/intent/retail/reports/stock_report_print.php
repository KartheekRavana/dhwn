<?php include_once "$D_PATH/include/session.php";?>
<!DOCTYPE html>
<html>
  <head>
    
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Items List</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped" style="font-size: 14px;width: 100%" border=1 cellspacing=0 cellpadding=0>
                    <thead>
                      <tr>
<th>SlNo</th>
                        <th>Category</th>
                        <th>Sub Category</th>         
                        <th>Item Name</th>
                        <th>Description</th>
                        <th>Current Stock</th>
                        <th>L cost</th>
                        <th style='width:30%'>Barcode</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                      <?php if(isset($_GET["description_11"]) || isset($_GET["barcode"])){
                      	
                      	if(isset($_GET["description_11"])){
                               $desc=$_GET["description_11"];
                               $item_id=$_GET["item_id_11"];
                      	}else{
                      	$barcode=explode("-", $_GET["barcode"]);
$i=1;
$dateFilter="";
                $data = mysql_query("SELECT category,item_name,item_id FROM items WHERE item_id='".$barcode[0]."'");
	while($info = mysql_fetch_array($data))
	{
		$category=$info["category"];		
		$item_name=$info["item_name"];
		$item_id=$info["item_id"];
	}
                $data1 = mysql_query("SELECT distinct(description) as description FROM txn_bill_support WHERE sk_tran_id='".$barcode[1]."' ORDER BY description");
	while($info1 = mysql_fetch_array($data1))
	{
		$desc=$info1["description"];
	}
                      	}
                               
                               
                               
                                  $total=0;
                                  $date_filter="";
                                  $data = mysql_query("SELECT item_id, item_name, item_status, category, sub_category_id,rack_id,packing FROM items where item_id='".$item_id."' ORDER BY item_name ASC");
                                  while($info = mysql_fetch_array( $data ))
                                  {
                                  	
                                  	if($info['item_status']=="active")
                                  		$status="label-success";
                                  	else
                                  		$status="label-danger";
                                  	
                                  	$category_name="";
                                  	$sub_category_name="";
                                  	$rack_name="";
                                  	$data1 = mysql_query("SELECT category_name from category where category_id='".$info["category"]."'");
                                  	while($info1 = mysql_fetch_array( $data1 ))
                                  	{
                                  		$category_name=$info1["category_name"];
                                  	}
                                  	$data1 = mysql_query("SELECT sub_cid, category_id, sub_name, sub_status, branch from sub_category where sub_cid='".$info["sub_category_id"]."'");
                                  	while($info1 = mysql_fetch_array( $data1 ))
                                  	{
                                  		$sub_category_name=$info1["sub_name"];
                                  	}                                  	
                                  	$data1 = mysql_query("SELECT rack_name from rack where rack_id='".$info["rack_id"]."'");
                                  	while($info1 = mysql_fetch_array( $data1 ))
                                  	{
                                  		$rack_name=$info1["rack_name"];
                                  	}
                                  	
                                 	$item_id=$info["item_id"];
                                  
                                  	$data6 = mysql_query("SELECT distinct(description) as description from txn_bill_support where particular_id='".$item_id."' and description like '%".$desc."%'");
                                  	while($info6 = mysql_fetch_array( $data6 ))
                                  	{
                                  		$sk_tran_id=0;
                                  		$data8 = mysql_query("SELECT sk_tran_id from txn_bill_support where particular_id='".$item_id."' and description='".$info6[0]."' order by sk_tran_id asc limit 1");
	                                  	while($info8 = mysql_fetch_array( $data8 ))
	                                  	{
	                                  		$sk_tran_id=$info8["sk_tran_id"];
	                                  	}
	                                  	
	                                  	$cur_stock=0;
	                                  	$total_piece=0;
	                                  	$data2 = mysql_query("SELECT sum(qty_in_sft),sum(qty_in_piece) FROM txn_bill_support WHERE particular_id='$item_id' and bill_for='Supplier' and bill_type='Cash' and description='".$info6["description"]."' $date_filter");
	                                  	while($info2 = mysql_fetch_array($data2))
	                                  	{
	                                  		$total_sft=$info2[0];
	                                  		$total_piece=$info2[1];
	                                  	}
	                                  	
	                                  	$data2 = mysql_query("SELECT sum(qty_in_sft),sum(qty_in_piece) FROM txn_bill_support WHERE particular_id='$item_id' and bill_for='Supplier' and bill_type='Credit' and description='".$info6["description"]."' $date_filter");
	                                  	while($info2 = mysql_fetch_array($data2))
	                                  	{
	                                  		$total_sft=$total_sft=$info2[0];
	                                  		$total_piece=$total_piece=$info2[1];
	                                  	}
	                                  	
	                                  	
	                                  	$return_total_sft=0;
	                                  	$return_total_piece=0;
	                                  	$data2 = mysql_query("SELECT sum(qty_in_sft),sum(qty_in_piece) FROM txn_bill_support WHERE particular_id='$item_id' and bill_for='Supplier' and bill_date>'2017-04-24' and bill_type like '%return%' and description='".$info6["description"]."' $date_filter");
	                                  	while($info2 = mysql_fetch_array($data2))
	                                  	{
	                                  		$return_total_sft=$info2[0];
	                                  		$return_total_piece=$info2[1];
	                                  	}
	                                  	
	                                  	
	                                  	$total_sft=$total_sft-$return_total_sft;
	                                  	$total_piece=$total_piece-$return_total_piece;
	                                  	$c_sessing_qty=0;$c_sessing_qty_p=0;
	                                  	$data2 = mysql_query("SELECT sum(qty_in_sft),sum(qty_in_piece) FROM txn_bill_support WHERE particular_id='$item_id' and bill_for='Customer' and bill_type='Cash' and description='".$info6["description"]."' $date_filter");
	                                  	while($info2 = mysql_fetch_array($data2))
	                                  	{
	                                  		$c_sessing_qty=$info2[0];
	                                  		$c_sessing_qty_p=$info2[1];
	                                  	
	                                  	}
	                                  	$data2 = mysql_query("SELECT sum(qty_in_sft),sum(qty_in_piece) FROM txn_bill_support WHERE particular_id='$item_id' and bill_for='Customer' and bill_type='Credit' and description='".$info6["description"]."' $date_filter");
	                                  	while($info2 = mysql_fetch_array($data2))
	                                  	{
	                                  		$c_sessing_qty=$c_sessing_qty+$info2[0];
	                                  		$c_sessing_qty_p=$c_sessing_qty_p+$info2[1];
	                                  	
	                                  	}
	                                  	
	                                  	$ledger_qty=0;$ledger_qty_p=0;
	                                  	
	                                  	
	                                  	$r_sessing_qty=0;$r_sessing_qty_p=0;
	                                  	$data2 = mysql_query("SELECT sum(qty_in_sft),sum(qty_in_piece) FROM txn_bill_support WHERE particular_id='$item_id' and bill_for='Customer' and bill_type like '%return%' and description='".$info6["description"]."' $date_filter");
	                                  	while($info2 = mysql_fetch_array($data2))
	                                  	{
	                                  		$r_sessing_qty=$info2[0];
	                                  		$r_sessing_qty_p=$info2[1];
	                                  	
	                                  	}
	                                  	
	                                  	
	                                  	$o_sessing_qty=0;
	                                  	
	                                  	$data2 = mysql_query("SELECT sum(remaining_qty) FROM stock WHERE flower_name='$item_id' and description='".$info6["description"]."'");
	                                  	while($info2 = mysql_fetch_array($data2))
	                                  	{
	                                  		$o_sessing_qty=$info2[0];
	                                  	}
	                                  	 
	                                  	$cur_stock=($total_sft)-($o_sessing_qty+($c_sessing_qty-$r_sessing_qty));
	                                  	
	                                  	$landing_cost=0;
	                                  	 
	                                  	$data8 = mysql_query("SELECT landing_cost,bill_date FROM txn_bill_support WHERE description='".$info6["description"]."' and bill_for='Supplier' ORDER BY sk_tran_id desc limit 1 ");
	                                  	while($info8 = mysql_fetch_array($data8))
	                                  	{
	                                  		$landing_cost=$info8["landing_cost"];
	                                  	}
                                  		
                      
                                  ?>
                                    <tr style="height: 50px;font-weight: bold;">
                                       
                                       <td><input type="hidden" id='item_id<?php echo ++$i?>' value="<?php echo $item_id?>-<?php echo $sk_tran_id?>"><?php echo $i?></td>
                                        <td><?php echo $category_name?></td>
                                        <td><?php echo $sub_category_name?></td>             
                                         <td><?php echo $info['item_name']?></td>
                                         <td><?php echo $info6[0]?></td>
                                         <td><?php echo $cur_stock?></td>
                                         <td><?php echo $landing_cost?></td>
                                          <td style="text-align: center;"><svg style="height: 40px" id='barcode<?php echo $i?>'>jj</svg ></td>
                                         <?php }}?>
                    </tbody>
                    
                  </table>
                  <?php }?>
                  <input type="hidden" id='count' value="<?php echo $i?>">
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
            
                 
                
                
               
 <script src="JsBarcode.all.min.js"></script>
 <script type="text/javascript">
 var count=document.getElementById("count").value
 for(var i=1;i<=count;i++){
 var item_id=document.getElementById("item_id"+i).value
JsBarcode("#barcode"+i, item_id);
 }
 self.print();
 setTimeout(function() { window.close(); }, 2000);
</script>