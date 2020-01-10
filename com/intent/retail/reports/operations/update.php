<?php include_once "$D_PATH/include/session.php";?>
<?php 
$tran_id=$_POST["tran_id"];
$tran_amt=$_POST["tran_amt"];
$tran_old_amt=$_POST["tran_old_amt"];
$tran_date=$_POST["from"];
$tran_type=$_POST["tran_type"];

$credit=0;
$debit=0;
$transaction_ref_id=0;


 	$data = mysql_query("SELECT `sk_tran_id`, `tran_date`, `tran_time`, `credit`, `debit`, `member_id`, `transaction_ref_id`, `ref_table`, `tran_type`, `tran_desc`, `note` FROM txn_transaction where sk_tran_id='$tran_id'");
	while($info = mysql_fetch_array( $data ))
	{     
	     $credit=$info["credit"];     
	     $debit=$info["debit"];    
	     $transaction_ref_id=$info["transaction_ref_id"];         		
	}

	if($tran_type=="debit"){
		$query="update txn_transaction set debit='$tran_amt' where sk_tran_id='$tran_id' and debit='$tran_old_amt' and tran_date='$tran_date'";
		mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
		
		$query="update txn_transaction set credit='$tran_amt' where sk_tran_id='$transaction_ref_id' and credit='$tran_old_amt' and tran_date='$tran_date'";
		mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
		
		$query="update txn_transaction set debit='$tran_amt' where sk_tran_id='$transaction_ref_id' and debit='$tran_old_amt' and tran_date='$tran_date'";
		mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
	}else{
		$query="update txn_transaction set credit='$tran_amt' where sk_tran_id='$tran_id' and credit='$tran_old_amt' and tran_date='$tran_date'";
		mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
		
		$query="update txn_transaction set debit='$tran_amt' where sk_tran_id='$transaction_ref_id' and debit='$tran_old_amt' and tran_date='$tran_date'";
		mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
		
		$query="update txn_transaction set credit='$tran_amt' where sk_tran_id='$transaction_ref_id' and credit='$tran_old_amt' and tran_date='$tran_date'";
		mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
	}

	
?>
<input type="hidden" id="tran_date" value="<?php echo $tran_date?>">
<script>
var tran_date=document.getElementById("tran_date").value
window.location="index.php?action=daybook&c=reports&from_date="+tran_date;
</script>
