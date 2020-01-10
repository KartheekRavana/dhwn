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

$bill_no=$_POST["bill_no"];
$tran_id=$_POST["tran_id"];

$curtime=curtime();

$data2 = mysql_query("SELECT total from customerreturnmain where bill_no='$bill_no'");
while($info2 = mysql_fetch_array( $data2 ))
{
	$old_return_amt=$info2['total'];

}

$query="update customerreturnmain set customer_name='$customer_name',place='$address',phone='$phone',bill_date='$date',total='$total',other_exp='$other_exp',grand_total='$grand_total',login_id='$login' where bill_no='$bill_no'";
mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());

mysql_query("delete from customerreturn where bill_no='$bill_no'");

$data1=explode("//", $data);
for($i=1;$i<sizeof($data1);$i++)
{
	$data2=explode("#", $data1[$i]);
	//for($j=1;$j<=sizeof($data2);$j++)
	{	
		$flower=$data2[0];$qty=$data2[1];$aqty=$data2[2];$cost=$data2[3];$tcost=$data2[4];
	//$total=$info['supplier_quantity']*$info['rateper_no'];
	       	$query="INSERT INTO customerreturn(bill_no,item_date,item_name,item_qty,item_rate,amt,item_qty_p)
	       	VALUES ('$bill_no','".$date."','".$flower."','".$qty."','".$cost."','".$tcost."','$aqty')";
	       	mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
	    
	      
       	/*	$query ="update stock set qty=qty+$qty,remaining_qty=remaining_qty+$qty,p_qty=p_qty+$aqty where flower_name='$flower' and branch='$branch'";
       		mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
     */
	       	
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
	$bal='';
	
	$query ="update customer set balance=balance+$old_return_amt where customer_id='$s_id'";
	mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
	
	$data = mysql_query("SELECT balance from customer where customer_id='$s_id'");
	while($info = mysql_fetch_array( $data ))
	{
		$bal=$info['balance'];
	
	}$bal=$bal-$total;
	
	$query="update customer_transactions set debit=$total,balance=$bal,customer_id='$s_id',customer_name='$customer_name' where tran_id='$tran_id'";
	mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
	
	$query ="update customer set balance=balance-$total where customer_id='$s_id'";
	mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
}
	?>
	           <input type='hidden' name="bill_no" id="bill_no" value="<?php echo $_POST["bill_no"]?>">
           <input type='hidden' name="tran_id" id="tran_id" value="<?php echo $_POST["tran_id"]?>">
<script>
	var bill_no=document.getElementById("bill_no").value
	var tran_id=document.getElementById("tran_id").value
window.location="index.php?action=return_edit&c=stock&tran_id="+tran_id+"&bill_no="+bill_no;
</script>