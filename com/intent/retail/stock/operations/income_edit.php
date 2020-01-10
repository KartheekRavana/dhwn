<?php include_once "$D_PATH/include/session.php";?><?php


$income=$_POST["exp_amount"];
$date=$_POST["date"];
$note=$_POST["exp_note"];
$tran_id=$_POST["tran_id"];

$query="update txn_transaction set credit='$income',note='$note',tran_date='$date' where sk_tran_id='$tran_id'";
mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());

?>

<script>
window.location="index.php?action=income&c=stock";
</script>