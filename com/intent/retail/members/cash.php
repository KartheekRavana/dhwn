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
    
    <?php include_once "$D_PATH/include/navigation.php";?>

 <?php 
                  $view="Customer";
                  $member_type=2;
                  $customer="class='active'";$supplier="";$transporter="";$employee="";$annual="";$closed="";$agent="";$handloan="";$cash="";$hamali="";
                  $partner="";$rent="";$investment="";$vat="";
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
                 
                 <a href="?action=view&c=members&lt=<?php echo $view?>&ms=<?php echo $re_state?>" style="float: right">View <?php echo $re_state?></a>
                  <a href="?action=print/cash_print&c=members&lt=<?php echo $view?>&ms=<?php echo $state?>" style="float: right">Print | </a>
                
                  <table id="example1" class="table table-bordered table-striped" style="font-size: 12px">
                    <thead>
                      <tr>
                      
                        
                        <th>Bill Date</th>
                        <th><?php echo $view?>&nbsp;Name</th>
                              <th>Mobile</th>             
                        <th>Place</th>
                        <th>Bill&nbsp;Amt</th>
                        
                        <th>Action</th>                        
                      </tr>
                    </thead>
                    <tbody>
                    	<?php 
                    	$data = mysql_query("SELECT sk_bill_id,member_name,mobile,place,grand_total,bill_date,measurement_slip_no,discount FROM mst_bill_main where member_id=0 and bill_for='Customer'");
                    	while($info = mysql_fetch_array( $data ))
                    	{
                    	
                    		$balance=0;
                    	 
                    	?>
                    <tr>
                                      	
                                        <td><?php echo $info['bill_date']?></td>
                                        <td><?php echo $info['member_name']?></td>
                                        <td><a style="color: black;" href="tel:<?php echo $info['mobile']?>" title="<?php echo $info['mobile']?>"><?php echo $info['mobile']?></a> 
                                       <td><?php echo $info['place']?></td>
                                       
                                        <td><?php echo $info['grand_total']-$info["discount"];?></td>
                                        <td>
                                       
                                        <a href='?action=sales_edit&c=stock&bill_no=<?php echo $info['sk_bill_id']?>'><span class="label label-primary">Edit</span></a>&nbsp;
                                        <a target="blank" href='?action=print/print_bill&c=inventory&bill_no=<?php echo $info['sk_bill_id']?>&op=print'><span class="label label-primary">Print</span></a>&nbsp;
                                      
                                    </td>
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
      
