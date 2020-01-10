<?php include_once "$D_PATH/include/session.php";?><?php

$bill_no_s=$_POST["bill_no"];

$bill_date=$_POST["bill_date"];
$s_id=$_POST["supplier_name"];
$mobile=$_POST["mobile"];
$place=$_POST["place"];



$grand_total=$_POST["grand_total"];
$other_expenses=$_POST["other_expenses"];
$transport_expenses=$_POST["transport_expenses"];
$hamali_expenses=$_POST["hamali_expenses"];
$total=$_POST["total"];
$login=$session_id;
$branch=$session_branch;
$note=$_POST['note'];

$data_details=$_POST["data"];
$curtime=curtime();


$command = "SELECT MAX(bill_no) as maxid FROM supplierorderformmain";
$bill_no=0;
$result = mysql_query($command, $con);
while ($row = mysql_fetch_assoc($result)){
	$bill_no = $row['maxid'];

}
$total_bar=0;
$bill_no++;
$items_list="";
$query="INSERT INTO supplierorderformmain(bill_no,supplier_id,bill_date,total,other_exp,lug_exp,exp,advance,gtotal,total_bal,login_id,branch,hamali,supplier_bill_no,note)
VALUES ('$bill_no','$s_id','$bill_date','".$grand_total."','".$other_expenses."','".$transport_expenses."','0','0','".$total."','0','$session_id','$session_branch','$hamali_expenses','$bill_no_s','$note')";
mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());

$data1=explode("//", $data_details);
for($i=1;$i<sizeof($data1);$i++)
{
	$data2=explode("#", $data1[$i]);
	//for($j=1;$j<=sizeof($data2);$j++)
	{	
		$flower=$data2[1];$qty=$data2[2];$aqty=$data2[3];$cost=$data2[4];$tcost=$data2[5];$lcost=$data2[6];$tlcost=$data2[7];$subcategoryid=$data2[8];$discount=$data2[9];$desc=$data2[10];$vat=$data2[12];
		$curStock=$data2[13];
	//$total=$info['supplier_quantity']*$info['rateper_no'];
	
		$command = "SELECT MAX(tran_id) as tran_id FROM supplierorderform";
		$tran_id=0;
		$result = mysql_query($command, $con);
		while ($row = mysql_fetch_assoc($result)){
			$tran_id= $row['tran_id'];
		
		}$tran_id++;
		
		
		
	       	$query="INSERT INTO supplierorderform(tran_id,bill_no,item_date,item_name,item_qty,item_rate,amt,landing_cost,total_landing_cost,item_qty_p,discount,description,vat,cur_stock)
	       	VALUES ('$tran_id','$bill_no','".$bill_date."','".$flower."','".$aqty."','".$cost."','".$tcost."','$lcost','$tlcost','$qty','$discount','$desc','$vat','$curStock')";
	       	mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
	       	 
	       	$data = mysql_query("SELECT flower_name from stock where flower_name='$flower' and branch='$branch'");
	       	$state='';
	       	while($info = mysql_fetch_array( $data ))
	       	{
	       		$state=$info['flower_name'];
	       		 
	       	}
	       	
	       	$bar=$data2[11];
	       	$total_bar=$total_bar+$bar;
	       	for($z=1;$z<=$bar;$z++)
	       	{
	       		$items_list=$items_list."#".$flower."-".$tran_id;
	       	}

	       	
	}

}

?>

<script>
//self.print();

window.location="index.php?action=order_form&c=stock&status=Stock Added Succesfully";
</script>
