<?php include_once "$D_PATH/include/session.php";?><?php

$item_id=$_GET["e_id"];



$query ="update items set item_status='active' where item_id='$item_id'";
mysql_query($query);


?>

<script>


window.location="index.php?action=new&c=items";


</script>