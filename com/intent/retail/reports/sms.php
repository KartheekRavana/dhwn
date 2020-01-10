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
    <!-- DATA TABLES -->
    <link href="<?php echo $UI_ELEMENTS?>plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
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
	function sendSms()
	{	
		var count=document.getElementById("count").value

		for(var i=1;i<count;i++)
		{
			var sms=document.getElementById("sms"+i).value
			var mobile=document.getElementById("mobile"+i).value
			var sms_status=document.getElementById("sms_status"+i).value

			if(sms_status=='Yes')
			{
				document.getElementById("smsv"+i).innerHTML='Sms Sent';
			if (window.XMLHttpRequest)
			{// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
			}
			else
			{// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange=function()
			{
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
			  {
			  var status=xmlhttp.responseText;
			
			 alert(status)

			  }
			}
			//alert("http://122.175.41.83/SMSPanel/SendSMS.aspx?User=dharani&Pwd=dharaniSenderId=DMGDHW&MobileNo="+mobile+"&Message="+sms)
			xmlhttp.open("GET","http://167.114.60.246/VidyaSMS/SendSMS.aspx?User=dharani&Pwd=dharaniSenderId=DMGDHW&MobileNo="+mobile+"&Message="+sms,true);
			xmlhttp.send();
			
		}}


	}
	function sendSmsByNo(i)
	{	
		
			var sms=document.getElementById("sms"+i).value
			var sms_status=document.getElementById("sms_status"+i).value
			var mobile=document.getElementById("mobile"+i).value

			if(sms_status=='Yes')
			{
				document.getElementById("smsv"+i).innerHTML='Sms Sent';
				
			if (window.XMLHttpRequest)
			{// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
			}
			else
			{// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange=function()
			{
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
			  {
			  var status=xmlhttp.responseText;
			
			 alert(status)

			  }
			}
			//alert("http://122.175.41.83/SMSPanel/SendSMS.aspx?User=dharani&Pwd=dharani&SenderId=DMGDHW&MobileNo="+mobile+"&Message="+sms)
			xmlhttp.open("GET","http://167.114.60.246/VidyaSMS/SendSMS.aspx?User=dharani&Pwd=dharani&SenderId=DMGDHW&MobileNo="+mobile+"&Message="+sms,true);
			xmlhttp.send();
			}
			
		}
   </script>
    
  </head>
  <body class="<?php echo $body_style?>">
    <div class="wrapper">
      
    
       <?php include_once "$D_PATH/include/header.php";?> 
      <!-- Left side column. contains the logo and sidebar -->
       <?php include_once "$D_PATH/include/side.php";?>

       
<!-- ---------------------------------------------------POPUP--------------------------------------------------------------------------- -->
<div class='popup'>
<div class='content_popup'>
<img src='<?php echo $UI_ELEMENTS?>notify/img/img.png' alt='quit' class='x' id='x'></img>
<div id="load_data">
<p>
</p>
</div>
</div>
</div>   
<!-- ---------------------------------------------------POPUP--------------------------------------------------------------------------- -->       
       
       
       
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Customer List
            
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php?action=index&c=dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Customer</a></li>
            <li class="active">View Customers</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
             

              <div class="box">
                <div class="box-header">
            
                </div><!-- /.box-header -->
                <div class="box-body">
                <input type="hidden" id="session_id" value="<?php echo $session_id?>">
                <input type="hidden" id="session_branch" value="<?php echo $session_branch?>">
                  <table id="" class="table table-bordered table-striped" style="font-size: 12px">
                    <thead>
                      <tr>                                    
                                        <th>Customer No</th>
                                        <th>User Name</th>
                                        <th>Mobile</th>                                           
                                        <th>Loan</th>
                                                               <th>SMS</th>                                       
                                        
                                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                       <?php 
                     
                                
                                  $i=1;
                                  $total=0;
                                  $data = mysql_query("SELECT sk_member_id, member_type, member_name, acc_no, ifsc, mobile, landline, email, address, place, state, profile_pic, login_name, login_password, login_status, employee_id, branch_id,member_status FROM mst_member where member_type='2' and member_status='active'");
                    	while($info = mysql_fetch_array( $data ))
                    	{
                    		$customer_name=$info["member_name"];
                    		$phone=$info["mobile"];
                    		$customerid=$info['sk_member_id'];
                    		$member_filter="";
                    		$balance=0;
                    	  
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
                    		
                                  	
                                  	$loan_statement="Balance : $balance";
                                  	
                                  
                                  	$sms="Dear $customer_name, Your Due Balance as of $date1 is $balance, Kindly Repay. Thanks For your Co-operation, DHARANI HARDWARE, BELLARY";
                                  	$sms_status="No";
                                  	if($balance>0){$sms_status='Yes';}
                                  	
                                  		
                                  ?>
                                    <tr>                         
                                        <td><?php echo $info['sk_member_id']?></td>
                                        <td><?php echo $customer_name?></td>
                                        <td><?php echo $phone?></td>
                                        <td><?php echo $loan_statement?></td>
                                        <td>
                                        <input type='hidden' id='mobile<?php echo $i?>' value='<?php echo $phone?>'>
                                        <input type='hidden' id='sms_status<?php echo $i?>' value='<?php echo $sms_status?>'>
                                        <textarea id='sms<?php echo $i?>' cols="65"><?php echo $sms?></textarea></td>
                                         
                                        <td id='smsv<?php echo $i?>'>
                                         <?php if($phone==''){?><span style="color: red">No Contact no</span><?php }
                                         else if($sms_status=='Yes'){?>
                                        <a href='javascript:void(0)' onclick="sendSmsByNo(<?php echo $i?>)"><span class="label label-warning">Send SMS</span></a>
                                       <?php }?>
                                      
                                        </td>
                                        
                                    </tr>
                                    <?php $i++;}?>
                                     <tfoot>
                      
                    </tfoot>
                                    
                    </tbody>
                  
                  </table>
                  <input type='hidden' id='count' value='<?php echo $i?>'>;
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <?php include_once "$D_PATH/include/footer.php";?>
    </div><!-- ./wrapper -->

    
    
    
    

    
    
    
    <!-- jQuery 2.1.3 -->
    <script src="<?php echo $UI_ELEMENTS?>plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo $UI_ELEMENTS?>bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- DATA TABES SCRIPT -->
    <script src="<?php echo $UI_ELEMENTS?>plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="<?php echo $UI_ELEMENTS?>plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    <!-- SlimScroll -->
    <script src="<?php echo $UI_ELEMENTS?>plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='<?php echo $UI_ELEMENTS?>plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="<?php echo $UI_ELEMENTS?>dist/js/app.min.js" type="text/javascript"></script>
    <!-- AdminLTE for demo purposes -->
    <?php include_once "$D_PATH/include/scripts_bottom.php";?>
    <!-- page script -->
    <script type="text/javascript">
      $(function () {
        $("#example1").dataTable();
        $('#example2').dataTable({
          "bPaginate": true,
          "bLengthChange": false,
          "bFilter": false,
          "bSort": true,
          "bInfo": true,
          "bAutoWidth": false
        });
      });
    </script>
<script src="<?php echo $UI_ELEMENTS?>loading/waitMe.js"></script>
  </body>
</html>
