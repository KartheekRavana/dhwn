<?php include_once "$D_PATH/include/session.php";?><?php

$item_name=$_POST["item_name"];
$category=$_POST["category_id"];
$branch=$_POST["session_branch"];

$subcategory=$_POST["sub_category_id"];

$rackid=$_POST["rack_id"];
$itemid=$_POST["itemid"];
$bNo="";
$status="success//Successfully Updated $item_name";

if($status=="success//Successfully Updated $item_name")
{
	$query="update items set item_name='$item_name',category='$category',branch='$branch',sub_category_id='$subcategory',rack_id='$rackid' where item_id='$itemid'";

mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
}
?>
<input type='hidden' id="status" value="<?php echo $status?>">
<input type='hidden' id="i_id" value="<?php echo $itemid?>">
<script>
var i_id=document.getElementById("i_id").value
window.location="index.php?action=Edit_items&c=items&i_id="+i_id+"&status="+document.getElementById("status").value;
</script>