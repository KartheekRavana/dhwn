<?php
ob_start();
session_start();

$tran_id=$_GET["tran_id"];

include '../../connection/db.php';



$i=1;$j=1;
$item_id=0;
$description="";
$data = mysql_query("SELECT particular_id,description FROM txn_bill_support WHERE sk_tran_id='$tran_id'");
while($info = mysql_fetch_array($data))
{
	$item_id=$info["particular_id"];
	$description=$info["description"];
}

$data = mysql_query("SELECT item_id, item_name, category, thickness, length, breadth,height, color, waterproof, sub_category_id,packing FROM items WHERE item_id='$item_id'");
while($info = mysql_fetch_array($data))
{
	echo "<table style='color:white'> <tr>";
	echo "<tr><td>Item Name</td><td> : </td><td>".$info["item_name"]."</td></tr>";
	echo "<tr><td>Description</td><td> : </td><td>".$description."</td></tr>";
	echo "</table>";
}
echo "<hr/><b style='font-size:15px'>Purchase History</b>";
echo "<table style='color:white;border-color:white;width:100%;font-size=10px' border=1 cellspacing=0 cellpadding=0> <tr><td>BNo</td><td>Date</td><td>Qty</td><td>Rate</td>
		<td>Discount</td><td>Vat</td><td>Lan Cost</td>
		";


$data = mysql_query("SELECT bill_id, qty_in_sft, rate,bill_date,landing_cost,vat,discount FROM txn_bill_support WHERE bill_for='Supplier' and particular_id='$item_id' and description='$description' order by bill_date desc");
while($info = mysql_fetch_array($data))
{
	$t_date=explode("-", $info["bill_date"]);
	$temp_date=$t_date[2]."-".$t_date[1]."-".$t_date[0];
	echo "<tr><td>".$info["bill_id"]."</td>
			<td>$temp_date</td>
			<td>".$info["qty_in_sft"]."</td>
			<td>".$info["rate"]."</td>
					<td>".$info["discount"]."</td>
							<td>".$info["vat"]."</td>
					<td>".$info["landing_cost"]."</td>
					</tr>
		";
}
echo "</table>";