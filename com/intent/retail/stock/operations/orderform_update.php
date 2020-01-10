<?php include_once "$D_PATH/include/session.php";?><?php


$bill_no=$_POST["bill_id"];
$bill_date=$_POST["bill_date"];
$s_id=$_POST["supplier_name"];
$mobile=$_POST["mobile"];
$place=$_POST["place"];

$login=$session_id;
$branch=$session_branch;
$note=$_POST['note'];

$data_details=$_POST["data"];
$curtime=curtime();

$grand_total=0;
mysql_query("delete from supplierorderform where bill_no='$bill_no'");

$data1=explode("//", $data_details);
for($i=1;$i<sizeof($data1);$i++)
{
	$data2=explode("#", $data1[$i]);
	//for($j=1;$j<=sizeof($data2);$j++)
	{
		$flower=$data2[1];$aqty=$data2[2];$qty=$data2[3];$cost=$data2[4];$tcost=$data2[5];$lcost=$data2[6];$tlcost=0;$old_tran_id=$data2[8];$disc=$data2[9];$desc=$data2[10];$vat=$data2[11];
		$curStock=$data2[13];
		//$total=$info['supplier_quantity']*$info['rateper_no'];
		//if($old_tran_id==0)
		{
			$command = "SELECT MAX(tran_id) as tran_id FROM supplierorderform";
		$tran_id=0;
		$result = mysql_query($command, $con);
		while ($row = mysql_fetch_assoc($result)){
			$tran_id= $row['tran_id'];
		
		}$tran_id++;
		
		$query="INSERT INTO supplierorderform(tran_id,bill_no,item_date,item_name,item_qty,item_rate,amt,landing_cost,total_landing_cost,item_qty_p,description,discount,vat,cur_stock)
		VALUES ('$tran_id','$bill_no','".$bill_date."','".$flower."','".$qty."','".$cost."','".$tcost."','$lcost','$tlcost','$aqty','$desc','$disc','$vat','$curStock')";
		
		//echo $query."<br/>";
		
		mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
	
		}
	/*	else {
			$query="update supplierorderform set item_date='$bill_date',item_name='$flower',item_qty='$qty',item_rate='$cost',amt='$tcost',landing_cost='$lcost',total_landing_cost='$tlcost',item_qty_p='$aqty',description='$desc',discount='$disc',vat='$vat' where tran_id='$old_tran_id'";
			mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
		}*/
		$grand_total=$tcost+$grand_total;
	}
}



$supplier_id=$s_id;



$query1 ="update supplierorderformmain set supplier_id='$supplier_id',bill_date='$bill_date',note='$note' where bill_no='$bill_no'";
mysql_query($query1);
//echo $query1;
?>
<input type="hidden" id="bill_no" value="<?php echo $bill_no?>">
<input type="hidden" id="c_id" value="<?php echo $supplier_id?>">
<script>
	var bill_no=document.getElementById("bill_no").value
	var c_id=document.getElementById("c_id").value
	window.location="index.php?action=order_form_edit&c=stock&c_id="+c_id+"&pid="+bill_no;
</script>