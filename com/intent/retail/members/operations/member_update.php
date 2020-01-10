<?php include_once "$D_PATH/include/session.php";?>
<?php
$member_id=$_POST["member_id"];
$member_type=$_POST["member_type"];
$member_name=$_POST["member_name"];
$address=$_POST["address"];
$place=$_POST["place"];
$email=$_POST["email"];
$phone1=$_POST["phone1"];
$phone2=$_POST["phone2"];
$salary=$_POST["salary"];

$login_name=$_POST["login_name"];
$login_pwd=$_POST["login_pwd"];


$query ="update mst_member set member_type='$member_type',login_name='$login_name',login_password='$login_pwd', member_name='$member_name', mobile='$phone1', landline='$phone2', email='$email', address='$address', place='$place',salary='$salary' where sk_member_id='$member_id'";
mysql_query($query);
//echo $query;

?>
<input type='hidden' name="status" id="status" value="<?php echo $commit?>">
<script>
window.location="?action=member_alter&c=members&m_id=<?php echo $member_id?>&status=success//Successfully Updated Member";
</script>