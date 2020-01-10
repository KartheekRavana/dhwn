<?php include_once "$D_PATH/include/session.php";?><?php 
if(isset($_POST["c_id"]))
{
	$employee_id=$_POST["c_id"];
	$allowedExts = array("png,jpg,jpeg");
	$temp = explode(".", $_FILES["file"]["name"]);

	$extension = end($temp);
	$p2="";
	if ($_FILES["file"]["error"] > 0)
	{
		echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
	}
	else
	{
		
		move_uploaded_file($_FILES["file"]["tmp_name"],
		"$D_PATH/employee/uploads/profilepics/" . $_FILES["file"]["name"]);
		
		//rename( '../../../images/employee/profilepic/' . $_FILES["file"]["name"], $myid.".jpg" );
		$picname=$_FILES['file']['name'];
		//	$query ="update customers set profile_pic='$picname' where customer_id='$myid'";
		//mysql_query($query);
		//****************************************
		
	}
	$_SESSION['profile_pic']=$picname;
	if($picname!="")
	{
$query="update employee set profile_pic='$picname' where employee_id='$employee_id'";
mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
//echo 'success';
	}
}
?>


<script>
window.location="index.php?action=profile&c=settings";
</script>




