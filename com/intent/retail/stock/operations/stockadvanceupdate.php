
<?php
include_once "$D_PATH/include/session.php";
include_once "$D_PATH/helper/helper.php";
$s_id=$_POST["b_name"];
$data=$_POST["data"];
//echo $data;
$advance=$_POST["grand_total"];

$login=$_POST['login'];
$branch=$_POST['branch'];

$note=$_POST['note'];

$phone=$_POST['mobile'];
$address=$_POST['place'];




$p_name=0;
if(isset($_POST["p_name"]))
{
	$p_name=$_POST["p_name"];	
}


$check_amt=0;


$curtime=curtime();

$date5=explode("-", $_POST["date"]);
$curdate=$date5[2]."-".$date5[1]."-".$date5[0];

//$curdate=//curdate();




$billno=$_POST["billno"];
/*$command = "SELECT MAX(bill_no) as maxid FROM customerbillmainadvance";
$bill_no=0;
$result = mysql_query($command, $con);
while ($row = mysql_fetch_assoc($result)){
	$bill_no = $row['maxid'];
}
$bill_no++;
*/

$query="update customerbillmainadvance set customer_name='$s_id', phone='$phone', city='$address', bill_date='$curdate', advance='$advance', login_id='$session_id', branch='$session_branch' where bill_no='$billno' ";
mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());

$query1="delete from customerbilladvance where bill_no='$billno'";
mysql_query($query1) or die('Query "' . $query1 . '" failed: ' . mysql_error());

$query1="update customer_transactions set note='$note' where bill_no='$billno'";
mysql_query($query1) or die('Query "' . $query1 . '" failed: ' . mysql_error());

$data1=explode("//", $data);
for($i=1;$i<sizeof($data1);$i++)
{
	$data2=explode("#", $data1[$i]);
	{	
		$flower=$data2[0];$cost=$data2[1];
		
	       	$query="INSERT INTO customerbilladvance(bill_no,item_date,item_name,item_qty,item_qty_p,item_rate,amt)
	       	VALUES ('$billno','$curdate','$flower','0','0','$cost','0')";
	       	mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
	      // echo $query;
	}
}

?>
<script>
window.location="index.php?action=advance&c=stock";
</script>
