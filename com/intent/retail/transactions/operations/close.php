<?php include_once "$D_PATH/include/session.php";?>

<?php 
$bank_name=$_GET["bank_id"];

$data="update mst_member set member_status='inactive' where sk_member_id='$bank_name'";
$commit=mysql_query($data);


?>
<script>
window.location="index.php?action=bank&c=transactions";
</script>

