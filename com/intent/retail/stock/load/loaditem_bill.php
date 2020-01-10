<?php
ob_start();
session_start();

$item_id=$_GET["item_id"];

include '../../connection/db.php';


$i=1;$j=1;

echo "<table class='table table-bordered'><thead><tr><th>Bill Date</th><th>Item Name</th><th>Qty</th><th>Purchase Cost</th><th>Landing Cost</th><th>Action</th></thead></tr>";
$data = mysql_query("SELECT tran_id, bill_no, item_date, item_name, item_qty, item_rate, amt, landing_cost, total_landing_cost, item_qty_p, discount, description FROM supplierbill WHERE item_name='$item_id'");
while($info = mysql_fetch_array($data))
{
	$item_name="";
	$data1 = mysql_query("SELECT item_id, item_name FROM items WHERE item_id='$item_id'");
	while($info1 = mysql_fetch_array($data1))
	{
		$item_name=$info1["item_name"];
	}
	$t_date=explode("-", $info["item_date"]);
	$bill_date=$t_date[2]."-".$t_date[1]."-".$t_date[0];

	echo "<tr>
			<td>$bill_date</td>
			<td>$item_name</td>
			<td>". $info["item_qty"]."</td>
			<td>". $info["item_rate"]."</td>
			<td>". $info["landing_cost"]."</td>
					<td><input type='button' value='Print Bracode' class='click'></td>
					</tr>
			";
}
?>