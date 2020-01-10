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
   <body class="<?php echo $body_style?>">
   

 <?php 
                  $view="Customer";
                  $member_type=2;
                  $customer="class='active'";$supplier="";$transporter="";$employee="";$annual="";$closed="";$agent="";$handloan="";$cash="";
                  $partner="";
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

       
                    <table id="example1" style="font-size: 12px;width:100%" border=1 cellpadding=0 cellspacing=0>
                    <thead>
                      <tr>
                      
                        
                        <th>Bill Date</th>
                        <th><?php echo $view?>&nbsp;Name</th>
                              <th>Mobile</th>             
                        <th>Place</th>
                        <th>Bill&nbsp;Amt</th>
                        
                               
                      </tr>
                    </thead>
                    <tbody>
                    	<?php 
                    	$data = mysql_query("SELECT sk_bill_id,member_name,mobile,place,grand_total,bill_date,measurement_slip_no FROM mst_bill_main where member_id=0 and bill_for='Customer'");
                    	while($info = mysql_fetch_array( $data ))
                    	{
                    	
                    		$balance=0;
                    	 
                    	?>
                    <tr>
                                      	
                                        <td><?php echo $info['bill_date']?></td>
                                        <td><?php echo $info['member_name']?></td>
                                        <td><a style="color: black;" href="tel:<?php echo $info['mobile']?>" title="<?php echo $info['mobile']?>"><?php echo $info['mobile']?></a> 
                                       <td><?php echo $info['place']?></td>
                                       
                                        <td><?php echo $info['grand_total']?></td>
                                      
                                    	</tr>
                    <?php }?>
                   
                                   
                   </tbody>
                   <tfoot>
                   	<tr>
                   		<td></td><td class='hidden-xs'></td>
                   		
                   		<td></td><td></td><td></td>
                   	</tr>
                   </tfoot>
                  </table>
              <script>
window.print();
setTimeout(function() { 
	 window.location="?action=cash&c=members&lt=<?php echo $view?>"; 
	}, 1000);
			 
			

</script>
</body>
</html>
      
