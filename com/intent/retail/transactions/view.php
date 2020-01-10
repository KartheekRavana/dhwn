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
			
			if($("#payment_type").val()==""){$("#payment_type_v").addClass('has-error');state="2";}
			if($("#amount").val()==""){$("#amount_v").addClass('has-error');state="2";}
			
			if(state==2){return false;}
		}
		
        </script>
     
       
         
  </head>
  <body class="<?php echo $body_style?>">
    <div class="wrapper">
      
      
      
      
      
      <?php include_once "$D_PATH/include/header.php";?> 
      <!-- Left side column. contains the logo and sidebar -->
       <?php include_once "$D_PATH/include/side.php";?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
             Bank Transactions
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php?action=index&c=dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Banks</a></li>          
            <li><a href="index.php?action=bank&c=transactions">View Banks</a></li>
            <li class="active">View Transactions</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
        
        
        <input type="hidden" name="tran_id" id="tran_id">
        <input type='hidden' name="session_branch" id="session_branch" value="<?php echo $session_branch?>">
          <div class="row">
          
         
            <!-- left column -->
            
              <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary" style="overflow: auto;">
               
                <!-- form start -->
                <br/>
                <?php
                $customerid=$_GET["bank_id"];
                $data1 = mysql_query("SELECT member_name,place,mobile,landline,email,member_type,acc_no FROM mst_member where sk_member_id='$customerid'");
                while($info1 = mysql_fetch_array( $data1 ))
                {
                	$customer_name=$info1["member_name"];
                	$mobile=$info1["mobile"];
                	$phone=$info1["landline"];
                	$place=$info1["place"];
                	$email=$info1["acc_no"];
                	$member_type=$info1["member_type"];
                }
                
                $balance=0;
                $supplier = mysql_query("SELECT credit, debit,transaction_ref_id,tran_desc FROM txn_transaction where member_id='".$customerid."' and tran_type='Bank' and tran_status='active'");
                while($supplier1 = mysql_fetch_array( $supplier ))
                {
                	if($supplier1['credit']!=0 || $supplier1['debit']!=0)
                	{
                		$discount=0;
                   		
                		$balance=$balance+($supplier1['credit']);
                		$balance=$balance-$supplier1['debit'];
                		$balance=$balance-$discount;
                		$balance=number_format((float)$balance, 0, '.', '');
                	}
                }
                ?>
                <input type="hidden" id="customer_id" value="<?php echo $_GET["c_id"]?>">
                <table>
                <tr>
                	<td>Bank Name</td><td><input type="text" class="form-control" style="width: 180px" value="<?php echo $customer_name?>" readonly="readonly"></td><td>&nbsp;&nbsp;</td>
                	<td>Acc No</td><td><input type="text" class="form-control" readonly="readonly" style="width: 120px" value="<?php echo $email?>" id="email" style="color: red;font-weight: bold;font-size: 15px"></td><td>&nbsp;&nbsp;</td>
                	
                	<td>Balance</td><td><input type="text" class="form-control" style="width: 80px" value="<?php echo $balance?>" readonly="readonly" style="color: red;font-weight: bold;font-size: 15px"></td><td>&nbsp;&nbsp;</td>
                	 
                </tr>
                </table><br/>
                </div>
                </div>

           <div class="col-md-12">
             

              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Bank Statement</h3>
                  <form action='?action=financial&c=reports'>
                <input type="hidden" name="action" value="view">
                <input type="hidden" name="c" value="transactions">
                <input type="hidden" name="bank_id" value="<?php echo $_GET["bank_id"]?>">
                     <table>
                      <tr><td>From Date</td><td>	          
                        <input type='date' name='from_date' class="form-control" id="inputDate" value='<?php  if(isset($_GET['from_date'])){echo $_GET['from_date'];}else{ echo $date1;}?>'>
                        </td>
<td>To Date</td><td>	          
                        <input type='date' name='to_date' class="form-control" id="inputDate" value='<?php  if(isset($_GET['to_date'])){echo $_GET['to_date'];}else{ echo $date1;}?>'>
                        </td><td></td><td>
                        <input type="submit" value='Get Report'/>&nbsp;
                         <?php 
                        if(isset($_GET["date"]))
                        {	?>
                        	<a class='btn btn-success' href="print/daybook_print.php?branch_name=<?php echo $_GET["branch_name"]?>&date=<?php echo $_GET['date']?>">Print</a>
                        	<?php 
                        }
                        ?></td>
                      </tr></table>
                        </form>
                </div><!-- /.box-header -->
                <div class="box-body" style="overflow: auto;">
                  <table id="" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                         <th>Tran&nbsp;Date&nbsp;&nbsp;&nbsp;</th>     
                        <th>Particular</th>
                                                        
                        <th>Credit</th>
                        <th>Debit</th>
                        <th>Balance</th>                                      
                        <th>Note</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                       <?php  

                       if(!isset($_GET["from_date"])){
                       
                         $bank_id=$_GET["bank_id"] ; 
                         
                         $balance=0;
                         $array_count=0;
                         $array = array();
                         $supplier = mysql_query("SELECT credit, debit from txn_transaction where member_id='$bank_id' and tran_type='Bank' and tran_status='active' order by tran_date asc,sk_tran_id asc");
                         while($supplier1 = mysql_fetch_array( $supplier ))
                         {
                         	//if($supplier1['credit']>0 || $supplier1['debit']>0)
                         	{
                         		$balance=$balance+$supplier1['credit'];
                         		$balance=$balance-$supplier1['debit'];
                         		array_push($array, $balance);
                         
                         		$array_count++;
                         	}
                         }
                         
                         $c=$array_count;
                         $data = mysql_query("SELECT sk_tran_id,member_id,tran_date,transaction_ref_id, credit, debit,tran_type,tran_desc,note from txn_transaction where member_id='".$bank_id."' and tran_type='Bank' and tran_status='active' order by tran_date desc,sk_tran_id desc");
                      while($info = mysql_fetch_array( $data ))
                      {            
                      //if($info['credit']>0 || $info['debit']>0)
                      {         
                      	$name="";
                      	$tran_id=$info["sk_tran_id"];
                      	$member_id=0;
                      	$data4 = mysql_query("SELECT member_id FROM txn_transaction where sk_tran_id='".$info["transaction_ref_id"]."'");
            while($info4 = mysql_fetch_array( $data4 ))
            {
            	$member_id=$info4["member_id"];
            }
            
                      	$supplier_name="";
                      if($info['tran_desc']=="Supplier Withdraw"||$info['tran_desc']=="Supplier Payment"){
							$data3 = mysql_query("SELECT sk_member_id,member_name FROM mst_member where sk_member_id='$member_id'");
							while($info3 = mysql_fetch_array( $data3 ))
							{
								$supplier_name=" (".$info3["member_name"].")";
							}
						}
						if($info['tran_desc']=="Customer Deposit"){

							$data3 = mysql_query("SELECT sk_member_id,member_name FROM mst_member where sk_member_id='$member_id'");
							while($info3 = mysql_fetch_array( $data3 ))
							{
								$supplier_name=" (".$info3["member_name"].")";
							}
						}
                      	$c--;	
                                  ?>
                      <tr>
								<td><?php $tdate=explode("-", $info['tran_date']);echo $tdate[2]."-".$tdate[1]."-".$tdate[0] ?></td>	
							    <td><?php echo $info['tran_desc']."".$supplier_name?></td>
							    
							    <td><?php echo $info['credit']?></td>
							    <td><?php echo $info['debit']?></td>
							    <td><?php echo $array[$c];//$info['balance']?></td>
							    <td><?php echo $info['note']?></td>		
							    <td><a href="index.php?action=bank_balance_edit&c=transactions&tran_id=<?php echo $info['tran_id']?>&tran_type=<?php echo $info['tran_type']?>&bank_id=<?php echo $info['bank_ID']?>">Edit</a></td>			
									
									</tr>
                     <?php }}}else{

                     
                         $bank_id=$_GET["bank_id"] ; 
                         
                         $balance=0;
                         $array_count=0;
                         $array = array();
                         
                         $ledger=0;
                      $supplier = mysql_query("SELECT credit, debit from txn_transaction where member_id='$bank_id' and tran_type='Bank' and tran_status='active' and tran_date<'".$_GET["from_date"]."' order by tran_date asc,sk_tran_id asc");
                         while($supplier1 = mysql_fetch_array( $supplier ))
                         {
                         	//if($supplier1['credit']>0 || $supplier1['debit']>0)
                         	{
                         		$ledger=$ledger+$supplier1['credit'];
                         		$ledger=$ledger-$supplier1['debit'];
                         		
                         	}
                         }
                         
                         $balance=$ledger;
                         $supplier = mysql_query("SELECT credit, debit from txn_transaction where member_id='$bank_id' and tran_type='Bank' and tran_status='active' and tran_date>='".$_GET["from_date"]."' order by tran_date asc,sk_tran_id asc");
                         while($supplier1 = mysql_fetch_array( $supplier ))
                         {
                         	//if($supplier1['credit']>0 || $supplier1['debit']>0)
                         	{
                         		$balance=$balance+$supplier1['credit'];
                         		$balance=$balance-$supplier1['debit'];
                         		array_push($array, $balance);
                         
                         		$array_count++;
                         	}
                         }
                         
                         $c=$array_count;
                         $data = mysql_query("SELECT sk_tran_id,member_id,tran_date,transaction_ref_id, credit, debit,tran_type,tran_desc,note from txn_transaction where member_id='".$bank_id."' and tran_date>='".$_GET["from_date"]."' and tran_type='Bank' and tran_status='active' order by tran_date desc,sk_tran_id desc");
                      while($info = mysql_fetch_array( $data ))
                      {            
                      //if($info['credit']>0 || $info['debit']>0)
                      {         
                      	$name="";
                      	$tran_id=$info["sk_tran_id"];
                      	$member_id=0;
                      	$data4 = mysql_query("SELECT member_id FROM txn_transaction where sk_tran_id='".$info["transaction_ref_id"]."'");
            while($info4 = mysql_fetch_array( $data4 ))
            {
            	$member_id=$info4["member_id"];
            }
            
                      	$supplier_name="";
                      if($info['tran_desc']=="Supplier Withdraw"){
							$data3 = mysql_query("SELECT sk_member_id,member_name FROM mst_member where sk_member_id='$member_id'");
							while($info3 = mysql_fetch_array( $data3 ))
							{
								$supplier_name=" (".$info3["member_name"].")";
							}
						}
						if($info['tran_desc']=="Customer Deposit"){

							$data3 = mysql_query("SELECT sk_member_id,member_name FROM mst_member where sk_member_id='$member_id'");
							while($info3 = mysql_fetch_array( $data3 ))
							{
								$supplier_name=" (".$info3["member_name"].")";
							}
						}
                      	$c--;	
                                  ?>
                      <tr>
								<td><?php $tdate=explode("-", $info['tran_date']);echo $tdate[2]."-".$tdate[1]."-".$tdate[0] ?></td>	
							    <td><?php echo $info['tran_desc']."".$supplier_name?></td>
							    
							    <td><?php echo $info['credit']?></td>
							    <td><?php echo $info['debit']?></td>
							    <td><?php echo $array[$c];//$info['balance']?></td>
							    <td><?php echo $info['note']?></td>		
							    <td><a href="index.php?action=bank_balance_edit&c=transactions&tran_id=<?php echo $info['tran_id']?>&tran_type=<?php echo $info['tran_type']?>&bank_id=<?php echo $info['bank_ID']?>">Edit</a></td>			
									
									</tr>
                     <?php }}?>
                        <tr>
								<td></td>	
							    <td>Ledger</td>
							    
							    <td>-</td>
							    <td>-</td>
							    <td><?php echo $ledger?></td>
							    <td>-</td>		
							    <td></td>			
									
									</tr>
                     <?php 
                     }?>
                    </tbody>
                    
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
            
            
            
            <!-- right column -->
            
            
            
            
           
            
            
            
            
            
            
            <!--/.col (right) -->
          </div>   <!-- /.row -->
          
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <?php include_once "$D_PATH/include/footer.php";?>
    </div><!-- ./wrapper -->

    <!-- AdminLTE for demo purposes -->
    <?php include_once "$D_PATH/include/scripts_bottom.php";?>
    <!-- page script -->
    <script type="text/javascript">
     /* $(function () {
        $("#example1").dataTable();
        $('#example2').dataTable({
          "bPaginate": true,
          "bLengthChange": false,
          "bFilter": false,
          "bSort": true,
          "bInfo": true,
          "bAutoWidth": false
        });
      });*/
    </script>
  </body>
</html>
