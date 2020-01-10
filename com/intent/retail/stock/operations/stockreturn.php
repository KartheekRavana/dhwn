<?php include_once "$D_PATH/include/session.php";?><?php
$customer_name=$_POST["customer_name"];
$address=$_POST["place"];
$phone=$_POST["mobile"];
$date=$_POST["bill_date"];
$total=$_POST["total"];

$other_exp=$_POST["other_expenses"];
$grand_total=$_POST["grand_total"];

$note=$_POST["note"];
$data=$_POST['data'];
$login=$session_id;
$branch=$session_branch;

$curtime=curtime();
/*
$date1=explode("-", $date3);
$date=$date1[2]."-".$date1[1]."-".$date1[0];*/
$command = "SELECT MAX(bill_no) as maxid FROM customerreturnmain";
$bill_no=0;
$result = mysql_query($command, $con);
while ($row = mysql_fetch_assoc($result)){
	$bill_no = $row['maxid'];

}

$bill_no++;

$query="INSERT INTO customerreturnmain(bill_no,customer_name,place,phone,bill_date,total,other_exp,grand_total,login_id,branch)
VALUES ('$bill_no','$customer_name','$address','".$phone."','".$date."','".$total."','$other_exp','$grand_total','$login','$branch')";
mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());

$data1=explode("//", $data);
for($i=1;$i<sizeof($data1);$i++)
{
	$data2=explode("#", $data1[$i]);
	//for($j=1;$j<=sizeof($data2);$j++)
	{	
		$flower=$data2[0];$qty=$data2[1];$cost=$data2[2];$tcost=$data2[3];$aqty=$data2[4];
	//$total=$info['supplier_quantity']*$info['rateper_no'];
	       	$query="INSERT INTO customerreturn(bill_no,item_date,item_name,item_qty,item_rate,amt,item_qty_p)
	       	VALUES ('$bill_no','".$date."','".$flower."','".$qty."','".$cost."','".$tcost."','$aqty')";
	       	mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
	       	 
	    
	      
       		$query ="update stock set qty=qty+$qty,remaining_qty=remaining_qty+$qty,p_qty=p_qty+$aqty where flower_name='$flower' and branch='$branch'";
       		mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
     
	       	
	}

}

if($customer_name!='')
{
$query ="INSERT INTO expense (expense_date,expense_id,expense_title,expense_name,amount,note,employee,branch)
VALUES ('$date','0','$customer_name','STOCK RETURN','$total','$note',$login,$branch)";
mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
}
else
{
	$s_id=$_POST["customer_id"];
	$data = mysql_query("SELECT balance from customer where customer_id='$s_id'");
	$bal='';
	while($info = mysql_fetch_array( $data ))
	{
		$bal=$info['balance'];
	
	}$bal=$bal-$total;
	
	$query="INSERT INTO customer_transactions(CUSTOMER_ID, TRAN_DATE, TRAN_TIME, BILL_NO, slip_no, credit, debit,balance, TRAN_STATUS, employee, branch,note,customer_name,tran_type,transaction_id)
	VALUES ('$s_id','".$date."',now(),'".$bill_no."','0','0','".$total."','$bal','active','$session_id','$session_branch','RETURN','$customer_name','RETURN','$bill_no')";
	mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
	
	$query ="update customer set balance=balance-$total where customer_id='$s_id'";
	mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
}
	?>
	
<script>
window.location="index.php?action=return&c=stock";
</script>