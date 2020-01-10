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
    <div class="wrapper">
      
      	<?php include_once "$D_PATH/include/header.php";?>
  	
  <!-- Left side column. contains the logo and sidebar -->
  
    <?php include_once "$D_PATH/include/side.php";?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    
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
        <section class="content">
          <div class="row">
                  
                 
              
                 <div class="col-md-12">
                 <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li <?php echo $customer?>><a href="?action=view&c=members&lt=Customer" >Credit Customer</a></li>
                  <li <?php echo $cash?>><a href="?action=cash&c=members&lt=Cash" >Cash Customer</a></li>
                  <li <?php echo $supplier?>><a href="?action=view&c=members&lt=Supplier">Supplier</a></li>
                  <li <?php echo $transporter?>><a href="?action=view&c=members&lt=Transporter">Transporter</a></li>
                  <li <?php echo $employee?>><a href="?action=view&c=members&lt=Employee">Employee</a></li>
                  <li <?php echo $agent?>><a href="?action=view&c=members&lt=Agent">Agent</a></li>
                 
                  <li <?php echo $partner?>><a href="?action=view&c=members&lt=Partner">Partner</a></li>
                 
                   <li <?php echo $handloan?>><a href="?action=view&c=members&lt=HandLoan">Hand Loan</a></li>
                  <li <?php echo $hamali?>><a href="?action=view&c=members&lt=Hamali">Hamali</a></li>
                  <li <?php echo $rent?>><a href="?action=view&c=members&lt=Rent">Rent</a></li>
                  <li <?php echo $investment?>><a href="?action=view&c=members&lt=Investment">Investments</a></li>
                   <li <?php echo $vat?>><a href="?action=view&c=members&lt=Vat">Vat</a></li>
                </ul>
                
                
                <div class="tab-content">
                  <div class="tab-pane active" style="overflow: auto;">
                 
                 <a href="?action=view&c=members&lt=<?php echo $view?>&ms=<?php echo $re_state?>" style="float: right"> View <?php echo $re_state?></a> 
                 <a href="?action=print/member_print&c=members&lt=<?php echo $view?>&ms=<?php echo $state?>" style="float: right">Print | </a>
                 
                  <table id="example1" class="table table-bordered table-striped" style="font-size: 12px">
                    <thead>
                      <tr>
                      
                        
                        
                        <th><?php echo $view?>&nbsp;Name</th>
                        <th class='hidden-xs'>Email</th>                        
                        <th>Mobile</th>
                        <th>Bal&nbsp;Amt</th>
                        <?php if($member_type==2) { echo "<th>Due From(In Days)</th>";}?>
                        <th>Action&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>                        
                      </tr>
                    </thead>
                    <tbody>
                    	<?php 
                    	$total=0;
                    	$negative_total=0;
                    	$data = mysql_query("SELECT sk_member_id, member_type, member_name, acc_no, ifsc, mobile, landline, email, address, place, state, profile_pic, login_name, login_password, login_status, employee_id, branch_id,member_status FROM mst_member where member_type='$member_type' and member_status='$state'");
                    	while($info = mysql_fetch_array( $data ))
                    	{
                    		$member_type=$info["member_type"];
                    		$customerid=$info['sk_member_id'];
                    		$member_filter="";
                    		$balance=0;
                    	  if($member_type=="3"){$q=" and member_id='$customerid'";$page="purchase"; $member_filter="  and tran_type='Supplier' ";}
                    		$supplier = mysql_query("SELECT credit, debit,transaction_ref_id,tran_desc,tran_type FROM txn_transaction where member_id='".$customerid."' and tran_type!='Expense' $member_filter and tran_status='active'");
                    		while($supplier1 = mysql_fetch_array( $supplier ))
                    		{
                    			if($supplier1['credit']!=0 || $supplier1['debit']!=0)
                    			{
                    			$discount=0;
                          if($member_type!='4'){
                   		if($supplier1["tran_desc"]=='New Bill' && $supplier1["tran_type"]!='Agent'){
                  $data1 = mysql_query("SELECT discount FROM mst_bill_main where sk_bill_id='".$supplier1["transaction_ref_id"]."'");
                  while($info1 = mysql_fetch_array( $data1 ))
                  {
                  	$discount=$info1[0];
                  }
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
                                      	
                                        <td><?php echo $info['member_name']?></td>
                                        <td class='hidden-xs'><?php echo $info['email']?></td>
                                        <td><a style="color: black;" href="tel:<?php echo $info['mobile']?>" title="<?php echo $info['mobile']?>"><?php echo $info['mobile']?></a> | 
                                        <a style="color: black;" href="tel:<?php echo $info['landline']?>" title="<?php echo $info['landline']?>"><?php echo $info['landline']?></a>
                                        </td>
                                        <td><?php echo $balance?></td>
                                        <?php if($member_type==2) {echo "<td>$days</td>";}?>
                                        <td>
                                        <a href='?action=statement&c=members&cid=<?php echo $info['sk_member_id']?>'><span class="label label-warning">Statement</span></a> |
                                       
                                         
                                        <a href='?action=member_alter&c=members&m_id=<?php echo $info['sk_member_id']?>'><span class="label label-primary">Edit</span></a>&nbsp;
                                       <?php if($session_type=="Director"){?>
                                        <!-- |&nbsp;<a class='hidden-xs' href='?action=operations/loan_inactive&c=loan&e_id=<?php echo $info['sk_loan_id']?>'><span class="label label-danger">Delete</span></a> -->
                                        | <a href='?action=log_view&c=reports&t_id=<?php echo $info['sk_member_id']?>&lt=member'><span class="label label-primary">Log</span></a>
                                    	<?php }?>
                                    	
                                        <?php if($info['member_status']=="active"){?>
                                        <a href='?action=operations/member_ban&c=members&mid=<?php echo $info['sk_member_id']?>&p=<?php echo $_GET["lt"]?>&pamt=<?php echo $balance?>&bill_for=<?php echo $view?>'><span class="label label-danger">Ban</span></a> |
                                         <?php }else{?>
                                         <a href='?action=operations/member_activate&c=members&mid=<?php echo $info['sk_member_id']?>&p=<?php echo $_GET["lt"]?>'><span class="label label-success">Activate</span></a> |
                                         <?php }?>
                                       
                                      
                                    </td>
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
                  </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
                    
    </div>          </div>   <!-- /.row -->
                  
                  </section>
      </div><!-- /.content-wrapper -->
 <?php include_once "$D_PATH/include/footer.php";?>

  <!-- Control Sidebar -->
 <?php include_once "$D_PATH/include/side_container.php";?> 
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<?php include_once "$D_PATH/include/scripts_bottom.php";?> 
</body>
</html>
      
