<?php include_once "$D_PATH/include/session.php";?><?php

    $e_id=$_GET["mid"];  
	$query ="update mst_measurement set tran_status='banned' where sk_tran_id='$e_id'";
	mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());


?>
<script>


window.location="index.php?action=index&c=dashboard&status=success//Successfully Deleted Sheet";
</script>