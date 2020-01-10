<?php
ob_start();
session_start();

$uname=$_POST['username'];
$pwd=$_POST['password'];

include "$D_PATH/connection/db.php";
//echo "SELECT sk_member_id,member_name,member_type,branch_id,profile_pic,role FROM mst_member where login_name='$uname' and login_password='$pwd' and login_name!='' and login_status='active'";
$data = mysql_query("SELECT sk_member_id,member_name,member_type,branch_id,profile_pic,role FROM mst_member where login_name='$uname' and login_password='$pwd' and login_name!='' and login_status='active'");
$login_status='fail';
while($info = mysql_fetch_array( $data ))
{
		$_SESSION['session_id']=$info["sk_member_id"];
		$_SESSION['session_name']=$info["member_name"];
		$_SESSION['session_type']=$info["role"];
		$_SESSION['session_branch']=$info["branch_id"];
		
		if($info["profile_pic"]=="" || $info["profile_pic"]=="no_preview.png"){$_SESSION['profile_pic']="dmg.png";}
		else {
		$_SESSION['profile_pic']=$info["profile_pic"];
		}
		//echo $_SESSION['profile_pic'];
		
}
include_once "$D_PATH/helper/helper.php";
$_SESSION['date1']=curdate1();
$_SESSION['time']=curtime();
$_SESSION['date']=curdate();

//header("Location: $page");
?>
<input type="hidden" id="name" value="<?php echo $_SESSION['session_name']?>">
<script>
window.location='?action=index&c=dashboard&status=success//Welcome '+document.getElementById("name").value;
</script>
