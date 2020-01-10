<?php include_once "$D_PATH/include/session.php";?>
<?php

	$bill_no_customer=$_GET["pid"];
	
				$query="update customerpickermain set payment_status='Deleted' where bill_no=$bill_no_customer";
				mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
			
?>

 
<script>

window.location="?action=index&c=dashboard";
</script>