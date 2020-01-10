<?php include_once "$D_PATH/include/session.php";?><?php

$bill_no_s=$_GET["pid"];



$query="delete from supplierorderformmain where bill_no='$bill_no_s'";
mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());


$query="delete from supplierorderform where bill_no='$bill_no_s'";
mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());


?>

<script>
//self.print();

window.location="?action=index&c=dashboard&status=Order Form Deleted Succesfully";
</script>
