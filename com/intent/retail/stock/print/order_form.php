<?php include_once "$D_PATH/include/session.php";?><?php 
$bill_no=$_GET["pid"];
?>


<div style='width:400px;margin-left:130px;font-size: 12px'>
 <?php 
	          $data = mysql_query("SELECT bill_no,supplier_id FROM supplierorderformmain where bill_no='".$bill_no."'");
	          while($info = mysql_fetch_array( $data ))
	          {
	          	
	          		
$data1 = mysql_query("SELECT member_name,place,mobile FROM mst_member where sk_member_id='".$info["supplier_id"]."'");
while($info1 = mysql_fetch_array( $data1 ))
{
	$c=$info1["member_name"];
$city=$info1["place"];
$mobile=$info1["mobile"];
}

	          	
	          ?>
	            <input type='hidden' id='bill_no' name='bill_no' value='<?php echo $info['bill_no']?>'>
	           <center style="font-weight: bold;font-size:16px">Order Form</center>
			   <table style="width: 100%;font-size:12px">
				<tr>
					<td rowspan="2" style="font-weight: bold;">DHARANI HARDWARES<br/>Shop No, 1&2, Gudur Complex, Opp. Church<br/> Vidyanagar, Ballari-583104</td>
				</tr>	           
				<tr></tr>
                  </table> 
			   
	           <table style="width: 90%;font-size:12px">
	           <tr><td rowspan="2">Seller&nbsp;Name : <?php echo $c?><br/>Place : <?php echo $city?><br/>Mobile : <?php echo $mobile?></td>
			   <td colspan="2">Ref No : <?php echo $info['bill_no']?><br/>Date : <?php echo $_SESSION['date1'];?></td></tr>	           
	           
	           <tr></tr>
                  </table>             
		 
	           <?php }?>
	          <hr width="100%" color="black">
<table cellspacing=0 cellpadding=0 border="#000" style="width: 120%;font-size: 12px">
	           <tr><th>SlNo</th><th>Particulars&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th><th>Qty</th><th>Qty/Pcs&nbsp;&nbsp;&nbsp;</th>
			   <th style="border:none;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
			   <th style="border:none;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
			   <th style="border:none;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
			   <th>Cur Stock</th></tr>
	           
	           <?php 
	           $i=1;
	          
	           $data = mysql_query("SELECT bill_no, item_date, item_name,description, item_qty, item_rate, amt, item_qty_p,tran_id,cur_stock FROM supplierorderform where bill_no='".$bill_no."'");
	           while($info = mysql_fetch_array( $data ))
	           {
	           	$item_name="";
	           	$thickness="";
	           	$cusStock="";
	           	$curStock=$info['cur_stock'];
	           	$size="";
	           	$data1 = mysql_query("SELECT item_name,thickness, length, breadth FROM items where item_id='".$info["item_name"]."'");
	           	while($info1 = mysql_fetch_array( $data1 ))
	           	{
	           		$item_name=$info1["item_name"];
	           	if($info1["thickness"]!=0)
	           		{
	           		$thickness=$info1["thickness"]."mm";
	           		$size="(".$info1["length"]."*".$info1["breadth"].")";
	           		}
	           	}
	           	if($info["item_name"]=="3")
	           	{
	           		$qty=$info["item_qty"];
	           	}
	           	else {
					$qty=$info["item_qty"];
				}
				
			$item_name=$item_name."(".$info["description"].")";
				
	           ?>
	           <tr style="border-bottom-color: white;border-top-color: white" >
<td><?php echo $i++?></td>
	           		<td><?php echo $item_name?></td>
	           		<td style="text-align: center;"><?php echo $info["item_qty_p"]?></td>
	           		<td style="text-align: center;"><?php echo $qty?></td>
					<td style="border:none;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
					<td style="border:none;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
					<td style="border:none;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
	           		<td style="text-align: center;"><?php echo $curStock?></td>
	           </tr>
	           
 <?php }?>
 </div>
 <script>
 self.print();
 setTimeout(function() { window.location="?action=index&c=dashboard"; }, 1000);
 </script>