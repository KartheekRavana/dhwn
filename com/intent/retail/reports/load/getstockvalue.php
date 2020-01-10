<?php
$category=$_GET["category"];
$sid=$_GET["subcategoryid"];
$item=$_GET["item"];
$item=$_GET["item"];
$description=$_GET["description"];

$fromDate=$_GET["date"];
$toDate=$_GET["date2"];

$dateFilter="";
if($fromDate!="")
{
	$dateFilter=" and bill_date between '".$fromDate."' and '".$toDate."' ";
}

include '../../connection/db.php';
include_once '../../helper/helper.php';
?>
<h4>Purchase Report</h4>
<table id='example1' class='table table-bordered table-striped' style='font-size:13px'>
	<thead>
		<tr><th>SlNo</th><!--<th>Barcode</th>
<th>Category&nbsp;&nbsp;</th><th>SubCategory&nbsp;&nbsp;</th>-->
			<th>Item Name&nbsp;&nbsp;</th>
			<th>Description&nbsp;&nbsp;</th>
			
			<th style='background: yellow'>Pur Qty</th><th style='background: yellow'>Pur Value</th>
			<th>Landing&nbsp;Cost</th><th style='background: #CEF6CE'>Sel Qty</th>
			<th style='background: #CEF6CE'>Sel Value(Pur Cost)</th>
			<th style='background: #CEF6CE'>Sel Value</th>
			<th>Sell&nbsp;Cost</th>
			<th style='background: orange'>Avail Stock</th>
			<th style='background: orange'>Stock Value(Pur Cost)</th>
			<th>Mrp</th><th>Rack</th></tr></thead>
<?php 

$main_filter="";
if($category!=''){$main_filter=" category='$category' and ";}
if($sid!=''){$main_filter=$main_filter." sub_category_id='$sid' and ";}
if($item!=''){$main_filter=$main_filter." item_id='$item' and ";}

$subfilter="";
if($description!=''){$subfilter=" and description like '%$description%'";}

$i=1;
$t_p=0;
$t_p_c=0;
$t_p_l=0;
$t_s=0;
$selling_purchase=0;
$available_qty_t=0;
$available_cost_t=0;
$total_stock_value=0;

$data12 = mysql_query("SELECT item_id,category, sub_category_id FROM items WHERE $main_filter item_status='active' order by category asc");
while($info12 = mysql_fetch_array($data12))
{
	$item_id=$info12["item_id"];
	$data13 = mysql_query("SELECT distinct(description) FROM txn_bill_support WHERE particular_id='$item_id' and bill_for='Supplier' $subfilter");
	while($info13 = mysql_fetch_array($data13))
	{	 
		$desc=$info13[0];
$data = mysql_query("SELECT sum(qty_in_sft), sum(amount),sum(landing_cost) FROM txn_bill_support WHERE particular_id='$item_id' and bill_for='Supplier' and description='$desc' $dateFilter");
while($info = mysql_fetch_array($data))
{
	$pur_qty=$info[0];
	$pur_rate=$info[1];
	$rack_id=0;
	$landing_cost=0;//$info[3];
	
	/*****************content*************************/
	$total_piece=0;
	$data2 = mysql_query("SELECT sum(qty_in_sft),sum(qty_in_piece) FROM txn_bill_support WHERE particular_id='$item_id' and bill_for='Supplier' and bill_type='Cash' and description='$desc' $dateFilter");
	while($info2 = mysql_fetch_array($data2))
	{
		$total_sft=$info2[0];
		$total_piece=$info2[1];
	}
	
	$data2 = mysql_query("SELECT sum(qty_in_sft),sum(qty_in_piece) FROM txn_bill_support WHERE particular_id='$item_id' and bill_for='Supplier' and bill_type='Credit' and description='$desc' $dateFilter");
	while($info2 = mysql_fetch_array($data2))
	{
		$total_sft=$total_sft=$info2[0];
		$total_piece=$total_piece=$info2[1];
	}
	
	
	$return_total_sft=0;
	$return_total_piece=0;
	$data2 = mysql_query("SELECT sum(qty_in_sft),sum(qty_in_piece) FROM txn_bill_support WHERE particular_id='$item_id' and bill_for='Supplier' and bill_date>'2017-04-24' and bill_type like '%return%' and description='$desc' $dateFilter");
	while($info2 = mysql_fetch_array($data2))
	{
		$return_total_sft=$info2[0];
		$return_total_piece=$info2[1];
	}
	
	
	$total_sft=$total_sft-$return_total_sft;
	$total_piece=$total_piece-$return_total_piece;
	$c_sessing_qty=0;$c_sessing_qty_p=0;
	$data2 = mysql_query("SELECT sum(qty_in_sft),sum(qty_in_piece) FROM txn_bill_support WHERE particular_id='$item_id' and bill_for='Customer' and bill_type='Cash' and description='$desc' $dateFilter");
	while($info2 = mysql_fetch_array($data2))
	{
		$c_sessing_qty=$info2[0];
		$c_sessing_qty_p=$info2[1];
	
	}
	$data2 = mysql_query("SELECT sum(qty_in_sft),sum(qty_in_piece) FROM txn_bill_support WHERE particular_id='$item_id' and bill_for='Customer' and bill_type='Credit' and description='$desc' $dateFilter");
	while($info2 = mysql_fetch_array($data2))
	{
		$c_sessing_qty=$c_sessing_qty+$info2[0];
		$c_sessing_qty_p=$c_sessing_qty_p+$info2[1];
	
	}
	
	$ledger_qty=0;$ledger_qty_p=0;
	
	
	$r_sessing_qty=0;$r_sessing_qty_p=0;
	$data2 = mysql_query("SELECT sum(qty_in_sft),sum(qty_in_piece) FROM txn_bill_support WHERE particular_id='$item_id' and bill_for='Customer' and bill_type like '%return%' and description='$desc' $dateFilter");
	while($info2 = mysql_fetch_array($data2))
	{
		$r_sessing_qty=$info2[0];
		$r_sessing_qty_p=$info2[1];
	
	}
	
	
	$o_sessing_qty=0;
	
	$data2 = mysql_query("SELECT sum(remaining_qty) FROM stock WHERE flower_name='$item_id' and description='$desc'");
	while($info2 = mysql_fetch_array($data2))
	{
		$o_sessing_qty=$info2[0];
	}
	 
	$cur_stock=($total_sft)-($o_sessing_qty+($c_sessing_qty-$r_sessing_qty));
	
	//echo "CurrentStock:".$cur_stock;
	
	/***************content***************************/
	
	if($landing_cost==0)
	{
		
		$data4 = mysql_query("SELECT landing_cost FROM txn_bill_support WHERE particular_id='$item_id' and bill_for='Supplier' and description='$desc'");
		while($info4 = mysql_fetch_array($data4))
		{
			$landing_cost=$info4["landing_cost"];
		}
	}
	
	
	$sessing_qty=0;
	$sessing_rate=0;
	$sessing_cost=0;

$data2 = mysql_query("SELECT rate FROM txn_bill_support WHERE particular_id='$item_id' and bill_for='Customer' and description='$desc' $dateFilter");
	while($info2 = mysql_fetch_array($data2))
	{
		
		$sessing_rate=$info2[0];
		
	}
	
	$data2 = mysql_query("SELECT sum(qty_in_sft), sum(amount) FROM txn_bill_support WHERE particular_id='$item_id' and bill_for='Customer' and description='$desc' $dateFilter");
	while($info2 = mysql_fetch_array($data2))
	{
		$sessing_qty=$info2[0];
	
		$sessing_cost=$info2[1];
	}
	
	$r_sessing_qty=0;$r_sessing_qty_p=0;
	$data2 = mysql_query("SELECT sum(qty_in_sft),sum(qty_in_piece) FROM txn_bill_support WHERE particular_id='$item_id' and bill_for='Customer' and bill_type like '%return%' and description='$desc' $dateFilter order by bill_date desc");
	while($info2 = mysql_fetch_array($data2))
	{
		$r_sessing_qty=$info2[0];
		$r_sessing_qty_p=$info2[1];	
	}
	
	$o_sessing_qty=0;
  $data2 = mysql_query("SELECT sum(remaining_qty) FROM stock WHERE flower_name='$item_id' and description='$desc'");
              while($info2 = mysql_fetch_array($data2))
              {
              	$o_sessing_qty=$info2[0];
              }
              
	$sessing_qty=$sessing_qty+$r_sessing_qty;
	//echo "Selling Qty:".$sessing_qty;
	$item_name="";
	$data1 = mysql_query("SELECT item_id, item_name FROM items WHERE item_id='$item_id'");
	while($info1 = mysql_fetch_array($data1))
	{
		$item_name=$info1["item_name"];
	}
	
	/*$data5 = mysql_query("SELECT rack_name from rack where rack_id='$rack_id'");
	$rack_name='';
	while($info5 = mysql_fetch_array( $data5 ))
	{
		$rack_name=$info5['rack_name'];
			
	}
	*/
	$data5 = mysql_query("SELECT mrp from stock where flower_name='$item_id' and description='$desc'");
	$mrp=0;
	while($info5 = mysql_fetch_array( $data5 ))
	{
		$mrp=$info5['mrp'];
			
	}
	$temp_cost="";
	if($sessing_rate==0)
	{
		$temp_cost="#F5D0A9";
		$sessing_rate=$landing_cost+(($landing_cost*15)/100);
	}
	

	/*$tran_id=$info["tran_id"];
	$item_rate=number_format($info["item_rate"], 2, '.', '');
	$landing_cost=number_format($info["landing_cost"], 2, '.', '');
	*/
	/*
	$cur_stock=$total_sft-$sessing_qty;
	
	$t_p=$t_p+$info["item_qty"];
	$t_p_c=$t_p_c+$item_rate;
	$t_p_l=$t_p_l+$landing_cost;*/
	$t_p=$t_p+($pur_qty*$landing_cost);
	$t_s=$t_s+$sessing_cost+($o_sessing_qty*$sessing_rate);
	$selling_purchase=$selling_purchase+($sessing_qty*$landing_cost)+($o_sessing_qty*$landing_cost);

	$selling_p=$sessing_qty*$landing_cost;
	$color="#CEF6CE";
	if(($selling_p+($o_sessing_qty+$landing_cost))>($sessing_cost+($sessing_rate*$sessing_rate)))
	{
		$color="red";
	}
	$available_qty=$pur_qty-$sessing_qty;
	
	
	
	$available_cost_t=$available_cost_t+(($available_qty-$o_sessing_qty)*number_format($landing_cost, 2, '.', ''));
if($pur_qty>0){
/*
$category_name="";
$data5 = mysql_query("SELECT category_name from category where category_id='".$info12["category"]."'");

	while($info5 = mysql_fetch_array( $data5 ))
	{
		$category_name=$info5['category_name'];
			
	}

$sub_category="";
$data5 = mysql_query("SELECT sub_name from sub_category where sub_cid ='".$info12["sub_category_id"]."'");

	while($info5 = mysql_fetch_array( $data5 ))
	{
		$sub_category=$info5['sub_name'];
			
	}
*/
/*$sk_tran_id=0;
                                  		$data8 = mysql_query("SELECT sk_tran_id from txn_bill_support where particular_id='".$item_id."' and description='".$desc."'");
                                  	while($info8 = mysql_fetch_array( $data8 ))
                                  	{
                                  		$sk_tran_id=$info8["sk_tran_id"];
                                  	}*/

	?>
	<tr><td><?php echo $i?></td><!--<td><?php echo $info12["item_id"]?>-<?php echo $sk_tran_id?></td><td><?php echo $category_name?></td><td><?php echo $sub_category?></td>-->
			<td><?php echo $item_name?></td>
			<td><?php echo $desc?></td>
						
			 <td style='background: yellow'><?php echo number_format($pur_qty, 0, '.', '')?></td>    		
			<td style='background: yellow;text-align:right'><?php echo number_format($pur_qty*$landing_cost, 2, '.', '')?></td>
			<td><?php echo number_format($landing_cost, 2, '.', '')?></td>
			<td style='background: #CEF6CE'><?php echo number_format($sessing_qty+$o_sessing_qty, 0, '.', '')?>(<?php echo number_format($sessing_qty, 0, '.', '')?>+<?php echo number_format($o_sessing_qty, 0, '.', '')?>)</td>
			<td style='background: #CEF6CE;text-align:right'><?php echo number_format($selling_p+($o_sessing_qty*$landing_cost), 2, '.', '')?></td>
			<td style='background: <?php echo $color?>;text-align:right'><?php echo number_format($sessing_cost+($o_sessing_qty*$sessing_rate), 2, '.', '')?><!-- (<?php echo number_format($sessing_cost, 0, '.', '')?> + <?php echo number_format($o_sessing_qty*$sessing_rate, 0, '.', '')?>) --></td>
				<td style="background: <?php echo $temp_cost?>"><?php echo number_format($sessing_rate, 0, '.', '')?></td>
				<?php /*$available_qty-$o_sessing_qty*/?>
				<td style='background: orange;text-align:right'><?php echo number_format($cur_stock, 2, '.', '')?></td>
				<?php
					$total_stock_value=$total_stock_value+(number_format(($cur_stock)*number_format($landing_cost, 2, '.', ''), 2, '.', '')) 
				?>
				<td style='background: orange;text-align:right'><?php echo number_format(($cur_stock)*number_format($landing_cost, 2, '.', ''), 2, '.', '');?></td>
				
	<td><?php echo $mrp?></td>
		<td><?php echo $rack_name?></td>
	
    <?php echo "
					</tr>
			";
$i++;}}}}?>
<tfoot>
<tr><td></td><td></td><td></td><td><?php echo number_format($t_p, 2, '.', '')?></td>
<td></td><td></td><td><?php echo number_format($selling_purchase, 2, '.', '')?></td>
<td><?php echo number_format($t_s, 2, '.', '')?></td>

<td style="background: red"><?php echo number_format($t_s-$selling_purchase, 2, '.', '')?></td>
<td></td>
<td></td>
<td><?php echo number_format($total_stock_value, 2, '.', '')?></td>
</tfoot>
<thead>
		<tr><th>SlNo</th>
			<th>Item Name&nbsp;&nbsp;</th>
			<th>Description&nbsp;&nbsp;</th>
			
			<th style='background: yellow'>Pur Qty</th><th style='background: yellow'>Pur Value</th>
			<th>Landing&nbsp;Cost</th><th style='background: #CEF6CE'>Sel Qty</th>
			<th style='background: #CEF6CE'>Sel Value(Pur Cost)</th>
			<th style='background: #CEF6CE'>Sel Value</th>
			<th>Sell&nbsp;Cost</th>
			<th style='background: orange'>Avail Stock</th>
			<th style='background: orange'>Stock Value(Pur Cost)</th>
			<th>Mrp</th><th>Rack</th></tr></thead>
</table>