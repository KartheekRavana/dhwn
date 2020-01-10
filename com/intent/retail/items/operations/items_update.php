<?php include_once "$D_PATH/include/session.php";

$item_id=$_POST["i_id"];
$category=$_POST["Category"];
$item_name=$_POST["item_name"];


$log_data="";
$sql=mysql_query("select item_id, category, item_name from items where item_id='$item_id' ");
while($info=mysql_fetch_array($sql))
{
	if($info["category"]!=$category){$log_data=$log_data."Updated Categoory  as $category (".$info["category"].")<br>";}
	if($info["item_name"]!=$item_name){$log_data=$log_data."Updated Item Name as $item_name (".$info["item_name"].")<br>";}
}

$query ="update items set item_name='$item_name',category='$category' where item_id='$item_id'";
$commit=mysql_query($query);
?>

<input type="hidden" name="c_id" id="i_id" value="<?php echo $item_id?>">
<input type='hidden' name="status" id="status" value="<?php echo $commit?>">
<script>
window.location="index.php?action=alter&c=items&status="+document.getElementById("status").value+"&i_id="+document.getElementById("i_id").value;
</script>