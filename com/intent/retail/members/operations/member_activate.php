<?php include_once "$D_PATH/include/session.php";?>
<?php
$member_id=$_GET["mid"];

$page=$_GET["p"];;

$query ="update mst_member set member_status='active' where sk_member_id='$member_id'";
mysql_query($query);


?>
<input type='hidden' name="status" id="status" value="<?php echo $commit?>">
<script>
window.location="?action=view&c=members&lt=<?php echo $page?>&status=success//Successfully Activated Member";
</script>