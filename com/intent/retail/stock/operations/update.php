<?php include_once "../../connection/db.php";
include_once "../../helper/helper.php";

$item_id=$_GET["item_id"];
$desc=$_GET["desc"];
$mrp=$_GET["mrp"];
$min=$_GET["min"];
$rack=$_GET["rack"];
if($mrp==''){$mrp=0;}
if($min==''){$min=0;}
if($rack==''){$rack=0;} 

$date=curdate();


  // $query="update supplierbill set rack_id='$rack' where item_name='$item_id' and description='$desc'";
 //  mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
   
	$status=1;
   $data5 = mysql_query("SELECT mrp from stock where flower_name='$item_id' and description='$desc'");
   while($info5 = mysql_fetch_array( $data5 ))
   {
   	$status=2;
   }
   if($status==2)
   {
   
   $query ="update stock set mrp=$mrp,min_stock='$min' where flower_name='$item_id' and description='$desc'";
   mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
   }
   else
   {
   	$command = "SELECT MAX(stock_id) as stock_id FROM stock";
   	$stock_id=0;
   	$result = mysql_query($command, $con);
   	while ($row = mysql_fetch_assoc($result))
   	{
   		$stock_id = $row['stock_id'];
   	}$stock_id++;
   	 
   	$query ="insert into stock(stock_id, stock_date, flower_name, description, qty, remaining_qty, mrp, branch, landing_cost, p_qty, subcategory_id,min_stock)
   	values ('$stock_id','$date','$item_id','$desc','0','0','$mrp','1','0','0','0','$min')";
   	mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
   	
   }
   
   
   
   ?>
