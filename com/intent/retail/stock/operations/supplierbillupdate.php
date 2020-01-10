<?php include_once "$D_PATH/include/session.php";?><?php


$bill_no=$_POST["bill_id"];
$bill_date=$_POST["bill_date"];
$s_id=$_POST["supplier_name"];
$mobile=$_POST["mobile"];
$place=$_POST["place"];

$grand_total=$_POST["grand_total"];
$other_expenses=$_POST["other_expenses"];
$transporter=$_POST["transporter"];
$transport_expenses=$_POST["transport_expenses"];
$hamali=$_POST["hamali"];
$hamali_expenses=$_POST["hamali_expenses"];
$total=$_POST["total"];
$login=$session_id;
$branch=$session_branch;
$note=$_POST['note'];

$data_details=$_POST["data"];
$curtime=curtime();

$grand_total=0;
//mysql_query("delete from supplierbill where bill_no='$bill_no'");

$data1=explode("//", $data_details);
for($i=1;$i<sizeof($data1);$i++)
{
	$data2=explode("#", $data1[$i]);
	//for($j=1;$j<=sizeof($data2);$j++)
	{
		$flower=$data2[1];$qty=$data2[2];$aqty=$data2[3];$cost=$data2[4];$tcost=$data2[5];$lcost=$data2[6];$tlcost=0;$old_tran_id=$data2[8];$disc=$data2[9];$desc=$data2[10];$vat=$data2[11];
		//$total=$info['supplier_quantity']*$info['rateper_no'];
		
		if($old_tran_id==0)
		{
			
			$command = "SELECT MAX(sk_tran_id) as maxid FROM txn_bill_support";
				$tran_id=0;
		$result = mysql_query($command, $con);
		while ($row = mysql_fetch_assoc($result))
		{
		$tran_id = $row['maxid'];
		}$tran_id++;


				$query="INSERT INTO txn_bill_support(sk_tran_id, bill_id, bill_for, bill_type, bill_date, particular_id,description,  qty_in_sft,qty_in_piece, rate,vat,discount, amount,landing_cost, bill_status, employee_id, branch_id)
				VALUES ('$tran_id','$bill_no','Supplier','Credit','$bill_date','$flower','$desc','$qty','$aqty','$cost','$vat','$disc','$tcost','$lcost','active','$session_id','$session_branch')";
				mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
	       	
		
	
		}else {
			//landing_cost='$lcost',
			$query="update txn_bill_support set bill_date='$bill_date',particular_id='$flower',qty_in_sft='$qty',rate='$cost',amount='$tcost',qty_in_piece='$aqty',description='$desc',discount='$disc',vat='$vat' where sk_tran_id='$old_tran_id'";
			mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
		}
		$grand_total=$tcost+$grand_total;
	}
}



$supplier_id=$s_id;

$t_credit=$grand_total+$other_expenses;

					$command = "SELECT MAX(sk_tran_id) as maxid FROM txn_transaction";
		$tran_id=0;
		$result = mysql_query($command, $con);
		while ($row = mysql_fetch_assoc($result))
		{
		$tran_id = $row['maxid'];
}$tran_id++;

$query="update txn_transaction set tran_status='Updated' where tran_type='Transporter' and tran_desc='New Bill' and transaction_ref_id='$bill_no'";
				mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
				
			if($transporter!=0)
			{
				$tran_id++;
				$query="INSERT INTO txn_transaction(sk_tran_id,tran_date,tran_time, credit, debit,member_id, transaction_ref_id, ref_table, tran_type, tran_desc, note,tran_status, employee_id, branch_id)
				VALUES ('$tran_id','$bill_date',now(),'$transport_expenses','0','$transporter','$bill_no','mst_bill_main','Transporter','New Bill','$note','active','$session_id','$session_branch')";
				mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
			}


//$query1 ="update txn_transaction set credit='$t_credit',tran_date='$bill_date',member_id='$supplier_id' where bill_id='$bill_no'";
//mysql_query($query1);


$query1 ="update txn_transaction set credit='$t_credit',tran_date='$bill_date',member_id='$supplier_id' where transaction_ref_id='$bill_no' and tran_type='Supplier' and tran_desc='New Bill'";
mysql_query($query1);

$total=$grand_total+$other_expenses+$transport_expenses+$hamali_expenses;

$query1 ="update mst_bill_main set member_id='$supplier_id',bill_amount='$grand_total',other_expenses='$other_expenses',transport_amount='$transport_expenses',hamali='$hamali_expenses',grand_total='$total',bill_date='$bill_date',note='$note' where sk_bill_id='$bill_no'";
mysql_query($query1);
//echo $query1;
?>
<input type="hidden" id="bill_no" value="<?php echo $bill_no?>">
<input type="hidden" id="c_id" value="<?php echo $supplier_id?>">
<script>
var bill_no=document.getElementById("bill_no").value
var c_id=document.getElementById("c_id").value
window.location="index.php?action=purchase_edit&c=stock&bill_no="+bill_no;
</script>