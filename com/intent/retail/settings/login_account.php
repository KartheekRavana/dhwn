<?php include_once "$D_PATH/include/session.php";?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
         <?php include_once "$D_PATH/include/title.php";?>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="<?php echo $UI_ELEMENTS?>bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="<?php echo $UI_ELEMENTS?>plugins/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="<?php echo $UI_ELEMENTS?>bootstrap/css/ionicons.min.css" rel="stylesheet" type="text/css" />    
    <!-- Theme style -->
    <link href="<?php echo $UI_ELEMENTS?>dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="<?php echo $UI_ELEMENTS?>dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    
    <script type="text/javascript">
		function validate()
		{			
			var state="1";
			if($("#user_name").val()==""){$("#user_name_v").addClass('has-error');state="2";}
			if($("#password").val()==""){$("#password_v").addClass('has-error');state="2";}
			
			
			if(state==2){return false;}
		}
		
        </script>
    
           <!-- -----------------------------------------NOTIFY------------------------------------- 
<script src="<?php echo $UI_ELEMENTS?>notify/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="<?php echo $UI_ELEMENTS?>notify/jquery.noty.js"></script>
<script type="text/javascript" src="<?php echo $UI_ELEMENTS?>notify/layouts/topCenter.js"></script>
<script type="text/javascript" src="<?php echo $UI_ELEMENTS?>notify/themes/default.js"></script>
<script src="<?php echo $UI_ELEMENTS?>notify/call-me-for-status.js"></script>
<!-- -----------------------------------------END NOTIFY------------------------------------- -->
    
     
    
  </head>
  <body class="skin-blue fixed">
    <div class="wrapper">
      
      <?php include_once "$D_PATH/include/header.php";?> 
      <!-- Left side column. contains the logo and sidebar -->
       <?php include_once "$D_PATH/include/side.php";?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
             Employee Login Account
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php?action=index&c=dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Employee</a></li>
            <li class="active">New Employee</li>
          </ol>
        </section>
          <section class="content">
          
          <form role="form" onsubmit="return validate()" action="index.php?action=operations/employee_acc_update&c=employee" method="POST">
          
          <div class="row">
            <!-- left column -->
            
            
            
            <div class="col-xs-12">
             

              <div class="box">
                <div class="box-header">
              
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped" style="font-size: 12px">
                    <thead>
                      <tr>
                      
                        
                        
                        <th>Employee&nbsp;Name</th>
                        <th class='hidden-xs'>Email</th>                        
                        <th>Mobile</th>
                        <th>Bal&nbsp;Amt</th>
                        
                        <th>Action&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>                        
                      </tr>
                    </thead>
                    <tbody>
                    	<?php 
                    	$total=0;
                    	$member_type=3;
                    	$negative_total=0;
                    	$data = mysql_query("SELECT sk_member_id, member_type, member_name, acc_no, ifsc, mobile, landline, email, address, place, profile_pic, login_name, login_password, login_status, employee_id, branch_id,member_status FROM mst_member where member_type='1' and member_status='active'");
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
                    		
                    		if($balance<500 && $balance>=0)
                    		if($view=="Customer")
                    		{
                    				$command = "SELECT MAX(sk_tran_id) as maxid FROM txn_transaction";
		$tran_id=0;
		$result = mysql_query($command, $con);
		while ($row = mysql_fetch_assoc($result))
		{
		$tran_id = $row['maxid'];
		
}$tran_id++;
$member_id=$info['sk_member_id'];
//$query ="update mst_member set member_status='Banned' where sk_member_id='$member_id'";
//mysql_query($query);
$query="INSERT INTO txn_transaction(sk_tran_id,tran_date,tran_time, credit, debit,member_id, transaction_ref_id, ref_table, tran_type, tran_desc, note,tran_status, employee_id, branch_id)
VALUES ('$tran_id','$date',now(),'0','$balance','$member_id','0','mst_member','$view','Discount','Customer Banned and Applied Discount','active','$session_id','$session_branch')";
mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
                    			
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
                                        <td>
                                        
                                         <a href='?action=conf&c=settings&e_id=<?php echo $info['sk_member_id']?>'><span class="label label-warning">Config Menu</span></a> |
                                      
                                       
                                      
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
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
            
            
            
            
            
            
            
            <!-- right column -->
            
          </div>   <!-- /.row -->
          
                  </form>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <?php include_once "$D_PATH/include/footer.php";?>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.3 -->
   
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo $UI_ELEMENTS?>bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='<?php echo $UI_ELEMENTS?>plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="<?php echo $UI_ELEMENTS?>dist/js/app.min.js" type="text/javascript"></script>
    <!-- AdminLTE for demo purposes -->
    <?php include_once "$D_PATH/include/scripts_bottom.php";?>
  </body>
</html>

