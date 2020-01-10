<?php
ob_start();
session_start();

$category=$_GET["category"];
$sid=$_GET["subcategoryid"];
$item_id=$_GET["item_search"];
$filter=$_GET["filter"];

include '../../connection/db.php';

$subqry_c="";
if($category!="")
{
	$subqry_c=" and category='$category'";
}
$subqry_s="";
if($sid!="")
{
	$subqry_s=" and sub_category_id='$sid'";
}



$i=1;$j=1;
$category_name="";
$data1 = mysql_query("SELECT category_name FROM category where category_id='".$category."'");
while($info1 = mysql_fetch_array( $data1 ))
{
	$category_name=$info1["category_name"];
}
if($item_id!=0)
{
if($filter=="")
{
echo "<table> <tr>";
	$data = mysql_query("SELECT distinct(description) as description FROM txn_bill_support WHERE bill_for='Supplier' and particular_id=$item_id order by description");
	while($info = mysql_fetch_array($data))
	{
		$tran_id="";
		
		$data1 = mysql_query("SELECT sk_tran_id FROM txn_bill_support WHERE bill_for='Supplier' and particular_id=$item_id and description='".$info["description"]."' limit 1");
		while($info1 = mysql_fetch_array($data1))
		{
			$tran_id=$info1["sk_tran_id"];
		}
		
		if($j==3)
		{
			echo "<tr><td>&nbsp;</td></tr><tr></tr>";
			$j=1;
		}
		echo "
		<td onclick='getitem_name_search($tran_id)'>
		<input type='hidden' id='itemid_$i' value='".$tran_id."'>
		<input type='hidden' id='item_$i' value='".$tran_id."'>
		<input type='button' style='font-size:12px' value='".$info["description"]."' class='btn btn-block btn-success'>
		</td><td>&nbsp;&nbsp;</td>
		";
				$i=$i+1;
				$j++;
	}
}
else 
{
echo "<table> <tr>";

	$data = mysql_query("SELECT distinct(description) as description FROM txn_bill_support WHERE  bill_for='Supplier' and particular_id=$item_id and description like '%".$filter."%' order by description");
	while($info = mysql_fetch_array($data))
	{
	$tran_id="";
		
		$data1 = mysql_query("SELECT sk_tran_id FROM txn_bill_support WHERE  bill_for='Supplier' and particular_id=$item_id and description='".$info["description"]."' limit 1");
		while($info1 = mysql_fetch_array($data1))
		{
			$tran_id=$info1["sk_tran_id"];
		}
		
		if($j==3)
		{
			echo "<tr><td>&nbsp;</td></tr><tr></tr>";
			$j=1;
		}
		echo "
		<td onclick='getitem_name_search($tran_id)'>
		<input type='hidden' id='itemid_$i' value='".$tran_id."'>
		<input type='hidden' id='item_$i' value='".$tran_id."'>
		<input type='button' style='font-size:12px' value='".$info["description"]."' class='btn btn-block btn-success'>
		</td><td>&nbsp;&nbsp;</td>
		";
				$i=$i+1;
				$j++;
	}
	
	/*echo "<table> <tr>";
	$data = mysql_query("SELECT tran_id, bill_no, item_date, item_name, item_qty, item_rate, amt, landing_cost, total_landing_cost, item_qty_p, discount, description FROM supplierbill WHERE item_name=$item_id and description like '%".$filter."%' order by description");
	while($info = mysql_fetch_array($data))
	{
		$item_id=$info["tran_id"];
		if($j==3)
		{
			echo "<tr><td>&nbsp;</td></tr><tr></tr>";
			$j=1;
		}
		echo "
		<td onclick='getitem_name_search($item_id)'>
		<input type='hidden' id='itemid_$i' value='".$info["tran_id"]."'>
		<input type='hidden' id='item_$i' value='".$info["tran_id"]."'>
		<input type='button' style='font-size:12px' onclick='getitem_name($i)' value='".$info["description"]."' class='btn btn-block btn-success'>
		</td><td>&nbsp;&nbsp;</td>
		";
				$i=$i+1;
				$j++;
	}	*/
}
}
else
{
	echo "<table> <tr>";
	$data = mysql_query("SELECT item_id, item_name, item_status, kannada_name, category, branch, thickness, length, breadth, color, waterproof, sub_category_id, rack_id, height, packing FROM items WHERE item_status='active' $subqry_c $subqry_s and item_name like '%".$filter."%' order by item_name");
	while($info = mysql_fetch_array($data))
	{
		$item_id=$info["item_id"];
		if($j==3)
		{
			echo "<tr><td>&nbsp;</td></tr><tr></tr>";
			$j=1;
		}
		echo "
		<td onclick='getitem_name_search($item_id)'>
		<input type='hidden' id='itemid_$i' value='".$info["item_id"]."'>
		<input type='hidden' id='item_$i' value='".$info["item_name"]."'>
		<input type='button' style='font-size:12px' onclick='getitem_name($i)' value='".$info["item_name"]."' class='btn btn-block btn-success'>
		</td><td>&nbsp;&nbsp;</td>
		";
				$i=$i+1;
				$j++;
	}
}
	
echo "</tr> </table>";