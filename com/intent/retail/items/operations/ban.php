<?php include_once "$D_PATH/include/session.php";?><?php

$customer_id=$_GET["e_id"];


$query ="update items set item_status='banned' where item_id='$customer_id'";
$res=mysql_query($query);
?>

<script>


window.location="index.php?action=new&c=items";


</script>