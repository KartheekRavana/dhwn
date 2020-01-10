<?php include_once "$D_PATH/include/session.php";?><?php


$category=$_POST["category_id"];
$branch=$_POST["session_branch"];
$subcategory=$_POST["sub_category_id"];
$data=$_POST["data"];

$temp=explode("#", $data);

for($i=1;$i<sizeof($temp);$i++)
{
	$temp1=explode("//", $temp[$i]);
	
	$item_name=$temp1[0];
	$thickness=$temp1[1];
	$length=$temp1[2];
	$breadth=$temp1[3];
	$height=$temp1[4];
	$packing=$temp1[5];
	$color=$temp1[6];
	$waterproof=$temp1[7];
	$rackid=$temp1[8];
	
	

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
	
}



?>
<input type='hidden' id="status" value="<?php echo $status?>">
<script>
window.location="index.php?action=new_bulk&c=items&status="+document.getElementById("status").value;
</script>