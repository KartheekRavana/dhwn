<?php include_once "$D_PATH/include/session.php";?><?php

$item_name=$_POST["item_name"];
$category=$_POST["category_id"];
$branch=$_POST["session_branch"];

$subcategory=$_POST["sub_category_id"];
$thickness=$_POST["thickness"];
$length=$_POST["length"];
$breadth=$_POST["bredth"];
$height=$_POST["height"];
$packing=$_POST["packing"];
$color=$_POST["color"];
$waterproof=$_POST["waterproof"];
$rackid=$_POST["rack_id"];

$bNo="";
$status="<span style='color:green'>Successfully Added New Item</span>";
$data = mysql_query("SELECT item_id, item_name, item_status, kannada_name, category, branch FROM items where item_name='".$item_name."' and category='$category' and sub_category_id='$subcategory' and length='$length' and breadth='$breadth' and thickness='$thickness' and height='$height' and packing='$packing' and color='$color' and waterproof='$waterproof' and branch='$branch'");
while($info = mysql_fetch_array( $data ))
{
	$status="<span style='color:red'>Adding Item Failed, Item Exist</span>";
}
if($status=="<span style='color:green'>Successfully Added New Item</span>")
{
	$cNo=0;
	$command = "SELECT MAX(item_id) as maxid FROM items";
	$result = mysql_query($command, $con);
	while ($row = mysql_fetch_assoc($result)){
		$cNo = $row['maxid'];
	}
	$cNo++;
$query="INSERT INTO items(item_id,item_name,kannada_name,item_status,category,branch,thickness,length,breadth,height,packing,color,waterproof,sub_category_id,rack_id)
VALUES ($cNo,'$item_name','','active','$category','$branch','$thickness','$length','$breadth','$height','$packing','$color','$waterproof','$subcategory','$rackid')";
mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
}
?>
<input type='hidden' id="status" value="<?php echo $status?>">
<script>
window.location="index.php?action=new&c=items&status="+document.getElementById("status").value;
</script>