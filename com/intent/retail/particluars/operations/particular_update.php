<?php include_once "$D_PATH/include/session.php";?>
<?php
$particular_id=$_POST["particluar_id"];
$particluar=$_POST["particluar"];
echo "update mst_particular set particular_name='$particluar' where sk_particular_id='$particular_id'";
$query ="update mst_particular set particular_name='$particluar' where sk_particular_id='$particular_id'";
mysql_query($query);


?>

<script>
window.location="?action=new&c=particluars&status=success//Successfully Added New Particular";
</script>