<?php ob_start();
session_start();

	$_SESSION['session_id']="";
	$_SESSION['session_type']="";
	$_SESSION['session_name']="";

	$status="";
	if(isset($_GET["status"]))
	{
	$status=$_GET["status"];
	}
	if($status==""){$status=="loged Out";}
	?>

<input type="hidden" id="status" value="<?php echo $status?>">


	
<script>
window.location='?status='+document.getElementById("status").value;
</script>