<?php include_once "$D_PATH/include/session.php";

$item_id=$_POST["i_id"];
$desc=$_POST["desc"];
$desc_old=$_POST["desc_old"];


$query ="update supplierbill set description='$desc' where item_name='$item_id' and description='$desc_old'";
$commit=mysql_query($query);

$query ="update customerbill set description='$desc' where item_name='$item_id' and description='$desc_old'";
$commit=mysql_query($query);

$query ="update stock set description='$desc' where flower_name='$item_id' and description='$desc_old'";
$commit=mysql_query($query);

?>

<input type="hidden" name="c_id" id="i_id" value="<?php echo $item_id?>">
<input type='hidden' name="status" id="status" value="<?php echo $commit?>">
<script>
window.location="index.php?action=Edit_items&c=items&i_id="+document.getElementById("i_id").value;
</script>