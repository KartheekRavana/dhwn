<?php include_once "$D_PATH/include/session.php";?>
<?php 
if(isset($_GET["m"]))
{
	
}
//echo "Mobile : ".$mobile;
$mobile="";
$data = mysql_query("SELECT mobile,tran_date FROM mst_measurement where sk_tran_id='".$_GET["m"]."'");
while($info = mysql_fetch_array( $data ))
{
	$mobile=$info["mobile"];
	$tran_date=$info["tran_date"];
}
$t_date=explode("-", $tran_date);
$date=$t_date[2]."-".$t_date[1]."-".$t_date[0];
//echo "Mobile : ".$mobile." Date : $date";
?>
<div style="float: left">Mobile : <?php echo $mobile?></div>
<div style="float: right">Date : <?php echo $date?></div>
<table border=1 cellspacing=0 cellpadding=0 style="width: 100%">
                <tr><th></th><th>Items</th><th>Qty In Piece</th><th>Qty In Sft</th></tr>
                <?php $k=1;
                if(isset($_GET["m"]))
                {$item_id="";
	                $data = mysql_query("SELECT distinct(item_id) FROM txn_measurement where tran_id='".$_GET["m"]."'");
	                while($info = mysql_fetch_array( $data ))
					{
						$item_id=$info[0];
		                $data1 = mysql_query("SELECT particular_name,category_id FROM mst_particular where sk_particular_id='".$item_id."'");
		                while($info1 = mysql_fetch_array( $data1 ))
						{
		                		$item_name=$info1["particular_name"];
		                		$category=$info1["category_id"];
		                }
	                	$category_name="";
	                	$data1 = mysql_query("SELECT particular_name FROM mst_particular where category_id='".$category."'");
	                	while($info1 = mysql_fetch_array( $data1 ))
	                	{
	                		$category_name=$info1["particular_name"];
	                	}
	                	
	                	$data1 = mysql_query("SELECT count(tran_id) as count,sum(total_sft) as sum FROM txn_measurement where tran_id='".$_GET["m"]."' and item_id='".$item_id."'");
	                	while($info1 = mysql_fetch_array( $data1 ))
	                	{
	                		$pcs=$info1["count"];
	                		$sft=$info1["sum"];
	                	}
	                ?>
	                <tr>
	                <td><?php echo $k?></td>
	               
	                <td><?php echo $item_name?></td>
	                <td><?php echo $pcs?></td>
	                <td><?php echo number_format($sft, 2, '.', '')?></td>
	                </tr>
	                
	                <?php 
	              $k++;}}?>
	              
	              </table>
	              
	              <?php $total_count=0;
	              $data = mysql_query("SELECT count(item_id) FROM txn_measurement where tran_id='".$_GET["m"]."'");
	              while($info = mysql_fetch_array( $data ))
	              {
	              	$total_count=$info[0];
	              }
	              $total_half=$total_count/2;
	              ?>
	              <div style="width: 100%">
	              <h2> Measurement Slip</h2>
	              </div>
	              
	              <div style="width: 100%;float: left;margin-left: 1%">
	              
<table border=1 cellspacing=0 cellpadding=0 style="width: 100%">
                <tr style="font-size: 12px"><th>SlNo</th><!-- <th>Category</th> --><th>Items</th><th>Length</th><th>Width</th><th>Total Sft</th><td style="border-bottom-color: white;border-top-color: white">&nbsp;&nbsp;&nbsp;&nbsp;</td><th>SlNo</th><!-- <th>Category</th> --><th>Items</th><th>Length</th><th>Width</th><th>Total Sft</th></tr>
                <?php $k=1;$m_c=1;
                if(isset($_GET["m"]))
                {$item_id="";
	                $data = mysql_query("SELECT txn_id, tran_id, category_id, item_id, length, width, div_by, total_sft, txn_status FROM txn_measurement where tran_id='".$_GET["m"]."'");
	                while($info = mysql_fetch_array( $data ))
					{
					$item_id=$info["item_id"];
		                $data1 = mysql_query("SELECT particular_name,category_id FROM mst_particular where sk_particular_id='".$item_id."'");
		                while($info1 = mysql_fetch_array( $data1 ))
						{
		                		$item_name=$info1["particular_name"];
		                		$category=$info1["category_id"];
		                }
	                	$category_name="";
	                	$data1 = mysql_query("SELECT particular_name FROM mst_particular where category_id='".$category."'");
	                	while($info1 = mysql_fetch_array( $data1 ))
	                	{
	                		$category_name=$info1["particular_name"];
	                	}
	                	
	                	$data1 = mysql_query("SELECT count(tran_id) as count,sum(total_sft) as sum FROM txn_measurement where tran_id='".$_GET["m"]."' and item_id='".$item_id."'");
	                	while($info1 = mysql_fetch_array( $data1 ))
	                	{
	                		$pcs=$info1["count"];
	                		$sft=$info1["sum"];
	                	}
	                	if($m_c==1){
	                ?>
	                <tr>
	                <?php }?>
	                <td><?php echo $k?></td>
	                <!-- <td><?php echo $category_name?></td> -->
	                <td><?php echo $item_name?></td>
	                <td><?php echo $info["length"]?></td>
	                <td><?php echo $info["width"]?></td>
	                <td><?php echo $info["total_sft"]?></td>
	                <?php 
	                if($m_c==1)
	                {
	                ?>
	                <td style="border-bottom-color: white;border-top-color: white"></td>
	                <?php }?>
	                <?php if($m_c==2){$m_c=0;?>
	                </tr>
	                <?php }?>
	                
	                <?php 
	              $m_c++;$k++;}}?>
	              
	              </table>
	              </div>
	              <script type="text/javascript">
self.print();
setTimeout(function() { window.close(); }, 1000);

	           </script> 