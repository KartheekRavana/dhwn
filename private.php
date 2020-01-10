<?php
$D_PATH="com/intent/retail";
$UI_ELEMENTS="http://irepo.in/ISCAP/UI_ELEMENTS/";
if(isset($_GET["c"]))
{
	$page=$_GET["action"];
	$DIR=$_GET["c"];
	include_once "$D_PATH/$DIR/$page.php";
}
else
{
	include_once "$D_PATH/login/login.php";
}
?>
<input type='hidden' id='D_PATH' value='<?php echo $D_PATH?>'>
<input type='hidden' id='DIR' value='<?php echo $DIR?>'>
