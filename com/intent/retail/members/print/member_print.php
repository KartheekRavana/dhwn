<?php include_once "$D_PATH/include/session.php";?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <?php include_once "$D_PATH/include/title.php";?>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
 
 <?php include_once "$D_PATH/include/scripts_top.php";?>
  
  </head>
  

 <?php 
                  $view="Customer";
                  $member_type=2;
                  $customer="class='active'";$supplier="";$transporter="";$employee="";$annual="";$closed="";$agent="";$handloan="";$cash="";$hamali="";
                  $partner="";$rent="";$investment="";$vat="";
                  if(isset($_GET["lt"]))
                  {
                  	$view=$_GET["lt"];
                  	if($view=="Customer"){
                  		$customer="class='active'";
                  		$member_type=2;
                  	}
                  	else if($view=="Cash"){
                  		$cash="class='active'";$customer="";
                  		$member_type=2;
                  	}
                  	else if($view=="Supplier"){
                  		$supplier="class='active'";$customer="";
                  		$member_type=3;
                  	}
                  	else if($view=="Transporter"){
                  		$transporter="class='active'";$customer="";
                  		$member_type=4;
					}
					else if($view=="Employee"){
						$employee="class='active'";$customer="";
						$member_type=1;
					}
					else if($view=="Agent"){
						$agent="class='active'";$customer="";
						$member_type=5;
					}	
					else if($view=="Partner"){
						$partner="class='active'";$customer="";
						$member_type=7;
					}
                  else if($view=="HandLoan"){
						$handloan="class='active'";$customer="";
						$member_type=8;
					}
                  else if($view=="Hamali"){
						$hamali="class='active'";$customer="";
						$member_type=9;
					}
                  else if($view=="Rent"){
						$rent="class='active'";$customer="";
						$member_type=10;
					}
                  else if($view=="Investment"){
						$investment="class='active'";$customer="";
						$member_type=11;
					}
                  else if($view=="Vat"){
						$vat="class='active'";$customer="";
						$member_type=12;
					}
                  }
                 
                 $state="active";
                 $re_state="Banned";
                    	if(isset($_GET["ms"])){
                    		$state=$_GET["ms"];
                    		if($_GET["ms"]=="active"){
                    		  $re_state="Banned";
                    		}else{
                    			 $re_state="active";
                    		}
                    	}
                 ?>

        <!-- Main content -->
     
                  <table id="example1" style="font-size: 12px;width:100%" border=1 cellpadding=0 cellspacing=0>
                    <thead>
                      <tr>
                      
                        
                        <th>SlNo</th>
                        <th><?php echo $view?>&nbsp;Name</th>
                        <th class='hidden-xs'>Email</th>                        
                        <th>Mobile</th>
                        <th>Bal&nbsp;Amt</th>
                        <?php if($member_type==2) { echo "<th>Due From(In Days)</th>";}?>
                        <th>Remarks&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                              
                      </tr>
                    </thead>
                    <tbody>
                    	<?php $i=1;
                    	$total=0;
                    	$negative_total=0;
                    	$data = mysql_query("SELECT sk_member_id, member_type, member_name, acc_no, ifsc, mobile, landline, email, address, place, state, profile_pic, login_name, login_password, login_status, employee_id, branch_id,member_status FROM mst_member where member_type='$member_type' and member_status='$state' order by member_name");
                    	while($info = mysql_fetch_array( $data ))
                    	{
                    		$member_type=$info["member_type"];
                    		$customerid=$info['sk_member_id'];
                    		$member_filter="";
                    		$balance=0;
                    	  if($member_type=="3"){$q=" and member_id='$customerid'";$page="purchase"; $member_filter="  and tran_type='Supplier' ";}
                    		$supplier = mysql_query("SELECT credit, debit,transaction_ref_id,tran_desc,tran_type FROM txn_transaction where member_id='".$customerid."' $member_filter and tran_status='active'");
                    		while($supplier1 = mysql_fetch_array( $supplier ))
                    		{
                    			if($supplier1['credit']!=0 || $supplier1['debit']!=0)
                    			{
                    			$discount=0;
                   		if($supplier1["tran_desc"]=='New Bill' && $supplier1["tran_type"]!='Agent'){
                  $data1 = mysql_query("SELECT discount FROM mst_bill_main where sk_bill_id='".$supplier1["transaction_ref_id"]."'");
                  while($info1 = mysql_fetch_array( $data1 ))
                  {
                  	$discount=$info1[0];
                  }
                   		}
                    				$balance=$balance+($supplier1['credit']);
                    				$balance=$balance-$supplier1['debit'];
                    				$balance=$balance-$discount;
                    				$balance=number_format((float)$balance, 0, '.', '');
                    			}
                    		}
                    		
                    		$lastTrandate="";$days="";
                    		if($member_type=="2" && $balance>0) {
                    				
                    			$result=mysql_query("select max(bill_date)  from mst_bill_main where member_id='$customerid' ");
                    			while($row=mysql_fetch_array($result)) {
                    				$lastTrandate=$row[0];
                    			}
								if($lastTrandate=="")$lastTrandate="2017-04-25";
									$date1=date_create(date('Y-m-d'));
									$date2=date_create($lastTrandate);
									$diff=date_diff($date2,$date1);
									$days = $diff->format("%a");
									$days++;
                    		}
                    		
                    		
                    		if($balance>0){
                    			$total=$total+$balance;
                    		}else{
                    			$negative_total=$negative_total+$balance;
                    		}
                    	?>
                    <tr>
                                      	<td><?php echo $i++?></td>
                                        <td><?php echo $info['member_name']?></td>
                                        <td class='hidden-xs'><?php echo $info['email']?></td>
                                        <td><?php echo $info['mobile']?>, <?php echo $info['landline']?>
                                        
                                        </td>
                                        <td style="text-align: right;"><?php echo $balance?></td>
                                        <?php if($member_type==2) {echo "<td style='text-align: center;'>$days</td>";}?>
                                        <td></td>
                                    	</tr>
                    <?php }?>
                   
                                   
                   </tbody>
                   <tfoot>
                   	<tr>
                   		<td></td><td class='hidden-xs'></td>
                   		
                   		<td></td><td>T : <?php echo $total?><br/>T : <?php echo $negative_total?></td><td></td>
                   	</tr>
                   </tfoot>
                  </table>
                 
</body>
<script>
window.print();

setTimeout(function() { 
	  window.location="?action=view&c=members&lt=<?php echo $view?>"; 
	}, 1000);		
			

</script>
</html>
      
