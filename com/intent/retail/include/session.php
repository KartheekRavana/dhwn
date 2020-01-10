<?php ob_start();
session_start();
session_set_cookie_params(86400);
ini_set('session.gc_maxlifetime', 86400);
/*$_SESSION['session_id']='0';
$_SESSION['session_type']='admin';
$_SESSION['session_name']='Manoj';
$_SESSION['session_branch']='0';*/
//ini_set('session.gc_maxlifetime', 3600);

if($_SESSION['session_id']==null){header("Location: index.php?action=logout&c=login&status=error//Invalid User Name or Password");}
else{
	
	$session_type=$_SESSION['session_type'];$session_name=$_SESSION['session_name'];
	$session_branch=$_SESSION['session_branch'];
	$session_id=$_SESSION['session_id'];
	$profile_pic=$_SESSION['profile_pic'];
}
include "$D_PATH/connection/db.php";

include_once "$D_PATH/helper/helper.php";
$date1=$_SESSION['date1'];
$time=$_SESSION['time'];
$date=$_SESSION['date'];

/*$command = "SELECT max(slip_no) as maxid FROM customer_transactions where branch='$session_branch'";
$slip_no=0;
$result = mysql_query($command, $con);
while ($row = mysql_fetch_assoc($result)){
	$slip_no = $row['maxid'];
}
*/
$body_style="hold-transition sidebar-mini skin-purple-light wysihtml5-supported fixed";

?>
 
 
 <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
 <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    
    
<link href="<?php echo $UI_ELEMENTS?>notify/css/style.css" rel="stylesheet" type="text/css"></link>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.js"></script>
<script type="text/javascript" src="<?php echo $UI_ELEMENTS?>notify/js/jquery.intent.js"></script>


 <!-- -----------------------------------------NOTIFY------------------------------------- -->
<script src="<?php echo $UI_ELEMENTS?>notify/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="<?php echo $UI_ELEMENTS?>notify/jquery.noty.js"></script>
<script type="text/javascript" src="<?php echo $UI_ELEMENTS?>notify/layouts/topCenter.js"></script>
<script type="text/javascript" src="<?php echo $UI_ELEMENTS?>notify/themes/default.js"></script>
<script src="<?php echo $UI_ELEMENTS?>notify/call-me-for-status.js"></script>
<!-- -----------------------------------------END NOTIFY------------------------------------- -->
<!-- -----------------------------------------FEEDBACK----------------------------------------- -->
<!-- <script type="text/javascript" src="<?php echo $UI_ELEMENTS?>feedback/js/jquery-1.10.2.min.js"></script> -->
<script type="text/javascript" src="<?php echo $UI_ELEMENTS?>feedback/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo $UI_ELEMENTS?>feedback/js/stickyfloat.js"></script>
<script type="text/javascript">
$( document ).ready(function() {
	$('#contact-wrapper').stickyfloat({ duration: 400, cssTransition: true, offsetY:100}); //stickyfloat contact form

	$("#contact-btn").click(function() { //smoothly slide open/close form
		var floatbox = $("#floating-contact-wrap");
		
		if (floatbox.hasClass('visiable')){
			
			floatbox.animate({"right":"-820px"}, "fast").removeClass('visiable');
		}else{
			floatbox.animate({"right":"0px"}, "fast").addClass('visiable');
		}
	});
	
	
	
});
</script>
<link href="<?php echo $UI_ELEMENTS?>feedback/style.css" rel="stylesheet" type="text/css" />
<!-- -----------------------------------------FEEDBACK----------------------------------------- -->

<script type="text/javascript" src="<?php echo $UI_ELEMENTS?>validation/validate-intent.js"></script>

<link type="text/css" rel="stylesheet" href="<?php echo $UI_ELEMENTS?>loading/waitMe.css">

<?php if(isset($_GET["status"])){?>
<input type="hidden" id="status" value="<?php echo $_GET["status"]?>">
<script type="text/javascript">
callme(document.getElementById("status").value);
</script>
<?php }?>