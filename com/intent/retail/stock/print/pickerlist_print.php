<?php include_once "$D_PATH/include/session.php";?>
<?php

	$bill_no=$_GET['pid'];

?>
<div style='width:330px;margin-left:200px;font-size: 12px'>
<h4>Picker List</h4>
 <?php 
	          $data = mysql_query("SELECT bill_no, customer_id, bill_date, total, comm, lug_exp, prev_bal, total_bal, amount_paid, final_bal, login_id, branch, customer_name, partner_id, check_payment, cashe_payment, discount, phone, city, tax, transport FROM customerpickermain where bill_no='".$bill_no."'");
	          while($info = mysql_fetch_array( $data ))
	          {
	          	if($info["customer_id"]==0){$c=$info["customer_name"];}
	          	else{
	          		
	          		
	          		
$data1 = mysql_query("SELECT member_name,place,mobile FROM mst_member where sk_member_id='".$info["customer_id"]."'");
while($info1 = mysql_fetch_array( $data1 ))
{
	$c=$info1["member_name"];
$city=$info1["place"];
$mobile=$info1["mobile"];
}

	          	}
	          ?>
	            <input type='hidden' id='bill_no' name='bill_no' value='<?php echo $info['bill_no']?>'>
	           
	           <table style="width: 100%;font-size:12px">
	           <tr><td rowspan="2">Buyer&nbsp;Name : <?php echo $c?><br/>Place : <?php echo $info["city"]?><br/>Mobile : <?php echo $info["phone"]?></td><td colspan="2">Ref No : <?php echo $info['bill_no']?><br/>Date : <?php echo $_SESSION['date1'];?></td></tr>	           
	           
	           <tr></tr>
                  </table>             
		 
	           <?php }?>
	          <hr width="100%" color="black">
<table cellspacing=0 cellpadding=0 border="#000" style="width: 100%;font-size: 12px">
	           <tr><th>SlNo</th><th>Particulars&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th><th>Qty</th><th>Rate</th><th>Discount</th><th>Amount</th></tr>
	           
	           <?php 
	           $i=1;
	           $data = mysql_query("SELECT bill_no, item_date, item_name,description, item_qty, item_rate, amt, item_qty_p,tran_id,note,discount FROM customerpicker where bill_no='".$bill_no."'");
	           while($info = mysql_fetch_array( $data ))
	           {
	           	$item_name="";
	           	$thickness="";
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
				$note=$info["note"];
				if($note==""){$note="(".$note.")";}
	           ?>
	           <tr style="border-bottom-color: white;border-top-color: white" >
<td><?php echo $i?></td>
	           		<td style="border-bottom : 0;border-top: 0"><?php echo $item_name?> <?php echo $note?></td>
	           		<td style="border-bottom : 0;border-top: 0;text-align: center;"><?php echo $qty?></td>
	           		<td style="border-bottom : 0;border-top: 0;text-align: center;"><?php echo $info["item_rate"]?></td>
	           		<td style="border-bottom : 0;border-top: 0;text-align: center;"><?php echo $info["discount"]?>%</td>
	           		<td style="text-align: right;border-bottom : 0;border-top: 0;text-align: right;"><?php echo $info["amt"]?></td>
	           </tr>
	           <?php $i++;}
	           for($j=$i;$j<20;$j++)
	           {
	           ?>
	         <tr style="border-bottom-color: white;border-top-color: white"><td style="border-bottom : 0;border-top: 0">&nbsp;</td><td style="border-bottom : 0;border-top: 0"></td><td style="border-bottom : 0;border-top: 0"></td><td style="border-bottom : 0;border-top: 0"></td></tr>
	          <?php }?>
	          <?php 
	          $data = mysql_query("SELECT bill_no, customer_id, bill_date, total, comm, lug_exp, prev_bal, total_bal, amount_paid, final_bal, login_id, branch, customer_name, partner_id, check_payment, cashe_payment, discount, phone, city, tax, transport FROM customerpickermain where bill_no='".$bill_no."'");
	          while($info = mysql_fetch_array( $data ))
	          {
	          ?>
	         
	               <tr><td colspan="3" style="text-align: right;">Total&nbsp;</td><td style="text-align: right"><?php echo $info["total"]?></td></tr>
	               <tr><td colspan="3" style="text-align: right;">Discount&nbsp;</td><td style="text-align: right"><?php echo $info["discount"]?></td></tr>
	               <tr><td colspan="3" style="text-align: right;">G Total&nbsp;</td><td style="text-align: right"><?php echo $info["total"]-$info["discount"]?></td></tr>
	            
	           </table>	 
	        
 <?php }?>
 </div>
 
<script>
setTimeout(function(){
	window.print();
	window.location="index.php?action=index&c=dashboard";
}, 500);
</script>