<?php include_once "$D_PATH/include/session.php";?>
<?php
$password=$_POST["password"];



$query ="update mst_member set login_password='$password' where sk_member_id='$session_id'";
mysql_query($query);
//echo $query;

?>
<input type='hidden' name="status" id="status" value="<?php echo $commit?>">
<script>
window.location="?action=profile&c=login&status=success//Successfully Updated Password";
</script>