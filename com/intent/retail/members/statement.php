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
        <!-- ---------------------------------------------------POPUP--------------------------------------------------------------------------- -->
<div class='popup'>
<div class='content_popup'>
<img src='<?php echo $UI_ELEMENTS?>notify/img/img.png' alt='quit' class='x' id='x'></img>
<div>
<p id="load_data">


<section class="content">
        
          
            <div class="row">
            <!-- left column -->
             
            <div class="col-md-12">
              <!-- general form elements -->
              <form action="index.php?action=operations/customer_payment_edit&c=customer" method="post" onsubmit="return validate()">
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">MAKE customer PAYMENT</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
               
               
               <input type="hidden" name="tran_id" id="tran_id">
               <input type="hidden" name="customer_id" id="customer_id" value="<?php echo $_GET["c_id"]?>">
                  <div class="box-body">
                    
                     
                     <div class="box-body">
                      <div class="form-group">
                      <label for="exampleInputFullName">Enter Amount to be Payed</label>
                      <input type="text" class="form-control" onkeypress="return isNumberKey(event)" id="amount" name="amount" onfocus="document.getElementById('amount_v').innerHTML=''">
                      <span  id='amount_v'></span>
                    </div>
                    </div>
                    <div class="box-body">
                      <div class="form-group">
                      <label for="exampleInputFullName">Tran Date</label>
                      <input type="date" class="form-control" id="tran_date" name="tran_date" onfocus="document.getElementById('amount_v').innerHTML=''">
                      <span  id='tran_date_v'></span>
                    </div>
                    </div>
                    
                    
                    
                    
                    <div class="box-body">
                      <div class="form-group">
                      <label for="exampleInputFullName">Note</label>
                      <input type="text" class="form-control" id="c_note1" name="c_note" onfocus="document.getElementById('note_v').innerHTML=''">
                      <span  id='note_v'></span>
                    </div>
                    </div>
                    
				  <div class="form-group">                  
					<button class="btn btn-block btn-warning" type="submit">UPDATE PAYMENT</button>
				  </div>            
                  </div><!-- /.box-body -->                
              </div><!-- /.box -->
              </form>
          </div><!--/.col (left) -->
          
          
            
          </div>   <!-- /.row -->
          
                 
        </section>



</p>
</div>
</div>
</div>   




<!-- ---------------------------------------------------POPUP--------------------------------------------------------------------------- -->      
   
          <section class="content">
          
         
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary" style="overflow: auto;">
               
                <!-- form start -->
                <br/>
                <?php $member_filter="";
                $customerid=$_GET["cid"];
                $data1 = mysql_query("SELECT member_name,place,mobile,landline,email,member_type FROM mst_member where sk_member_id='$customerid'");
                while($info1 = mysql_fetch_array( $data1 ))
                {
                	$customer_name=$info1["member_name"];
                	$mobile=$info1["mobile"];
                	$phone=$info1["landline"];
                	$place=$info1["place"];
                	$email=$info1["email"];
                	$member_type=$info1["member_type"];
                }
                
                $balance=0;
                $supplier = mysql_query("SELECT credit, debit,transaction_ref_id,tran_desc,tran_type FROM txn_transaction where member_id='".$customerid."' and tran_type!='Expense' and tran_status='active'");
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
                ?>
                <input type="hidden" id="customer_id" value="<?php echo $_GET["c_id"]?>">
                <table>
                <tr>
                	<td>Member Name</td><td><input type="text" class="form-control" style="width: 180px" value="<?php echo $customer_name?>" readonly="readonly"></td><td>&nbsp;&nbsp;</td>
                	<td>Phone</td><td><input type="text" class="form-control" style="width: 120px" value="<?php echo $mobile?>,<?php echo $phone?>" readonly="readonly"></td><td>&nbsp;&nbsp;</td>                	
           			<td>Place</td><td><input type="text" class="form-control" style="width: 120px" value="<?php echo $place?>" readonly="readonly"></td><td>&nbsp;&nbsp;</td>
                	<td>Balance</td><td><input type="text" class="form-control" style="width: 80px" value="<?php echo $balance?>" readonly="readonly" style="color: red;font-weight: bold;font-size: 15px"></td><td>&nbsp;&nbsp;</td>
                	<td>Email</td><td><input type="text" class="form-control" style="width: 120px" value="<?php echo $email?>" id="email" style="color: red;font-weight: bold;font-size: 15px"></td><td>&nbsp;&nbsp;</td>
                	 
                </tr>
                </table><br/>
                </div>
                </div>
                
                <?php if($member_type!=8 && $member_type!=7 && $member_type!=1 && $member_type!=9 && $member_type!=10 && $member_type!=11){?>
                 <div class="col-md-5">
             

              <div class="box box-warning" style="overflow: auto;">
                
                <div class="box-body">
            <div class="box-header">
                  <h3 class="box-title">Bills</h3>
                    <span style="font-size: 14px;margin-left: 150px"><a target="blank" href="index.php?action=print/statement&c=members&cid=<?php echo $_GET["cid"]?>&op=printbill">Print  </a>|</span>
                  <span style="font-size: 14px;margin-left: 0px"><a href="javascript:void(0)" onclick="emailbill()">Email</a></span>
                   <script type="text/javascript">
                  function emailbill()
                  {
                      var email=document.getElementById("email").value
                      var c_id=document.getElementById("customer_id").value
                 
					window.location="index.php?action=bill_print&c=customer&c_id="+c_id+"&op=email&c_email="+email;
                  }
                  </script>
                </div>
                
                
                 <table id="" class="table table-bordered table-striped" style="font-size: 12px">
                 
                    <thead>
                       <tr><th>S&nbsp;NO</th><th>BILL&nbsp;DATE</th><th>BILL AMT</th><th>AMOUNT</th>
                       <?php if($member_type==5){?><th>COMISSION</th><?php }?>
                       <?php if($member_type==4){?><th>TRANSPORT</th><?php }?>
                       <?php if($member_type==12){?><th>TAX COLL</th><?php }?>
					   <th>BIll TYPE</th>
                       <th>VIEW BILL</th></tr>
                    </thead>
                    <tbody>
                    <?php $i=1;
	            $data="";$total=0;$q="";$return_amt=0;
	           if($member_type=="2"){$q=" and member_id='$customerid'";$page_="sales";}
	           if($member_type=="3"){$q=" and member_id='$customerid'";$page_="purchase"; $member_filter="  and tran_type='Supplier' ";}
	           if($member_type=="4"){$q=" and transporter_id='$customerid'";}
	           if($member_type=="5"){$q=" and agent_id='$customerid'";$page_="sales";}
	           if($page_==""){$page_="sales";}
                  $data = mysql_query("SELECT sk_bill_id,slip_no, bill_date, bill_time, member_id, member_name, mobile, place, transporter_rate,bill_for, bill_type, bill_amount, tax_rate, tax_amount, t_discount_rate, t_discount_amount, bill_tax_amount, transporter_id, transport_amount, other_expenses, grand_total, cash_amount, check_amount, paid_amount, discount, balance_amount, note, bank_id, bill_status, measurement_slip_no, agent_id, agent_rate, agent_amount, employee_id, branch_id FROM mst_bill_main where bill_status='active' $q order by bill_date desc");
                  while($info = mysql_fetch_array( $data ))
                  {$page_ext="";
                  	$c_name="";$b_name="";
                  	$c_id=$info['member_id'];
                  	$b_id=$info['branch_id'];
                  	$total=$total+$info['grand_total'];
                  	
                  	$bill_type=$info["bill_type"];
                  	
                  		if($bill_type=="Credit Return" || $bill_type=="Credit Ret" || $bill_type=='Cash Ret' || $bill_type=='Cash Return' )
						{
							$page_ext="_return";
							$return_amt=$return_amt+$info['bill_amount'];
						}
                  		
                  		$tax_total=$tax_total+($info["tax_amount"]-$info["t_discount_amount"]);
                  		
                  		$display_status="show";
                  		if($member_type=="4" && $info["transport_amount"]<=0){
                  			$display_status="hide";
                  		}
                  		
                  		if($display_status=="show"){
	           ?>
	           <tr>
	         
	           <td><?php echo $i?></td>
	           <td><?php $t_date=explode("-", $info["bill_date"]) ;echo $t_date[2]."-".$t_date[1]."-".$t_date[0]?></td>
	           	<td><?php if($member_type==3){echo  $info["bill_amount"]+$info["other_expenses"];}else{echo number_format($info['bill_amount'], 2, '.', '')?><?php }?></td>
	           		<td><?php echo number_format($info['grand_total']-$info["discount"], 2, '.', '')?></td>
	           	<?php if($member_type==5){?><th><?php echo $info["agent_amount"]?>(<?php echo $info["agent_rate"]?>)</th><?php }?>
                       <?php if($member_type==4){?><th><?php echo number_format($info["transport_amount"], 2, '.', '');?></th><?php }?>
                       <?php if($member_type==12){?><th><?php echo $info["tax_amount"]-$info["t_discount_amount"]?></th><?php }?>
					   <td><?php echo $bill_type?></td>
	           		 <td><a href="index.php?action=<?php echo $page_?><?php echo $page_ext?>_edit&c=stock&bill_no=<?php echo $info['sk_bill_id']?>">Edit</a> | 
	           		 <a target="blank" href='index.php?action=print/print_bill_barcode&c=inventory&bill_no=<?php echo $info['sk_bill_id']?>&op=print'>Print Barcode</a> |
	           		 <a target="blank" href='index.php?action=print/print_bill&c=inventory&bill_no=<?php echo $info['sk_bill_id']?>&op=print'>Print </a> | 
	           		 <a target="blank" href="javascript:void(0)" onclick="email_bill('<?php echo $info['bill_no']?>')">Email</a> | 
	           		 <a target="blank" href="index.php?action=print/measurement_print&c=inventory&m=<?php echo $info["measurement_slip_no"]?>">MS</a>
	           		 </td>
	           		 
	           </tr>
	           
	           <?php $i++;}
                  	/*}*/
	           }?>
	          
                    
                    </tbody>
                      <tr><td></td><td></td><td><?php echo "Rt ".$return_amt?></td><td><?php echo " Tr " .number_format($total-$return_amt, 2, '.', '')?></td><td><?php if($member_type==12){echo $tax_total; }?></td></tr>
                      
                    </table>
                    
                
                
                
                
                  <!-- /.box-body -->
 
              </div><!-- /.box -->
        
            </div><!--/.col (left) -->
            <!-- right column -->
            
          </div>   <!-- /.row -->
          <?php }?>
          
          
          <div class="col-md-7">
             

              <div class="box" style="overflow: auto;">
                
                <div class="box-body box-danger">
           <?php $from_date="";$to_date="";
           if(isset($_GET['from_date'])){$from_date=$_GET['from_date'];}
            if(isset($_GET['to_date'])){$to_date=$_GET['to_date'];}
           ?>
           	 <div class="box-header">
                  <h3 class="box-title">Statement
                 <span style="font-size: 14px;margin-left: 150px"><a target="blank" href="index.php?action=print/statement&c=members&cid=<?php echo $_GET["cid"]?>&op=printstatement&from_date=<?php echo $from_date?>&to_date=<?php echo $to_date?>">Print  </a>|</span>
                  <span style="font-size: 14px;margin-left: 0px"><a href="javascript:void(0)" onclick="email()">Email</a></span></h3>
                  <span style="font-size: 14px;margin-left: 0px;float: left">
                  <form action='?action=financial&c=reports'>
                <input type="hidden" name="action" value="statement">
                <input type="hidden" name="c" value="members">
                <input type="hidden" name="cid" value="<?php echo $_GET["cid"]?>">
                     <table>
                      <tr><td>From Date</td><td>	          
                        <input type='date' name='from_date' class="form-control" id="inputDate" value='<?php  if(isset($_GET['from_date'])){echo $_GET['from_date'];}else{ echo $date1;}?>'>
                        </td>
<td>To Date</td><td>	          
                        <input type='date' name='to_date' class="form-control" id="inputDate" value='<?php  if(isset($_GET['to_date'])){echo $_GET['to_date'];}else{ echo $date1;}?>'>
                        </td><td></td><td>
                        <input type="submit" value='Get Report'/>&nbsp;
                         </td>
                      </tr></table>
                        </form>
                        </span>
                        
                </div>
                  <script type="text/javascript">
                  function email()
                  {
                	  var email=document.getElementById("email").value
                   	var customer_id=document.getElementById("customer_id").value
					window.location="index.php?action=statement_print&c=customer&c_id="+customer_id+"&op=email&c_email="+email;
                  }
                  </script>
                  
                <table id="" class="table table-bordered table-striped" style="font-size: 12px">
                 
                    <thead>
                       <tr>                       
	                      
                                      <th>TRAN DATE</th>
                                      <th>PERTICULAR</th>                             
                                      <th>CREDIT</th>                                   
                                      <th>DEBIT</th>               
                                      <th>BALANCE</th>
                                      <th>NOTE</th>
                                      <th>ACTION</th>   
                       </tr>
                    </thead>
                    <tbody>
                   <?php   
                   
                   if(!isset($_GET["from_date"])){
                   
                   $balance=0;
                   $array_count=0;
                   $array = array();
				  
                   $supplier = mysql_query("SELECT credit, debit,tran_desc,transaction_ref_id,tran_type FROM txn_transaction where member_id='".$customerid."' $member_filter and tran_status='active' and tran_type!='Expense' order by tran_date asc");
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
                   		array_push($array, $balance);
                   		 
                   		$array_count++;
                   	}
                   }
                   
                   $supplier_c=1;
                                  $c=$array_count;
                                  $supplier_bt=0;
                                  $BAL=0;
                                  
                   $data = mysql_query("SELECT credit, debit,tran_type,tran_desc,tran_date,note,transaction_ref_id FROM txn_transaction where member_id='".$customerid."' $member_filter and tran_status='active' and tran_type!='Expense' order by tran_date desc");               
                   while($info = mysql_fetch_array( $data ))
                   {
                   	
                   	$note=$info["note"];
                   	if($info['credit']!=0 || $info['debit']!=0)
                   	{
                   		$discount=0;
                   		if($info["tran_desc"]=='New Bill' && $info["tran_type"]!='Agent'){
                  $data1 = mysql_query("SELECT discount,note,slip_no,sk_bill_id FROM mst_bill_main where sk_bill_id='".$info["transaction_ref_id"]."'");
                  while($info1 = mysql_fetch_array( $data1 ))
                  {

                  	$discount=$info1[0];
                  	$note=$info1[1];
                  	$note=$note." (SlipNo : ".$info1[2].")";
                  	$sk_bill_id=$info1[3];
                  }
                   		}
                   	if($info["tran_desc"]=='Return Bill'){
                  $data1 = mysql_query("SELECT discount,note,slip_no,sk_bill_id FROM mst_bill_main where sk_bill_id='".$info["transaction_ref_id"]."'");
                  while($info1 = mysql_fetch_array( $data1 ))
                  {
                  	$discount=$info1[0];
                  	$note=$info1[1];
                  	$note=$note." (SlipNo : ".$info1[2].")";
                  	$sk_bill_id=$info1[3];
                  }
                   		}
                   	$c--;
                   	$PERTICULAR=$info["tran_desc"];
                   	
                   		$supplier_name="";
                   	if($member_type==12){
                   		$transaction_ref_id=$info["transaction_ref_id"];
                   	$supplier_id=0;
		                	$data1 = mysql_query("SELECT member_id FROM mst_bill_main where sk_bill_id='$transaction_ref_id'");
	                	while($info1 = mysql_fetch_array( $data1 ))
	                	{   
	                	$supplier_id=$info1["member_id"];
	                	}
	                	$supplier_name="";
	                	$data1 = mysql_query("SELECT member_name FROM mst_member where sk_member_id='$supplier_id'");
		                	while($info1 = mysql_fetch_array( $data1 ))
		                	{
		                		$supplier_name="(".$info1["member_name"].")";
		                	}
		                		
                   	}
                   	$total_credit=$total_credit+$info["credit"];
                        $total_debit=$total_debit+$info["debit"];
                                  	?>
                                    <tr>          
                                     <td><?php if($member_type==12){?><a href='?action=purchase_edit&c=stock&bill_no=<?php echo $info["transaction_ref_id"]?>'><?php } $t_date=explode("-", $info["tran_date"]) ;echo $t_date[2]."-".$t_date[1]."-".$t_date[0]?></a></td> 
                                      <td><?php echo $PERTICULAR?> <?php echo $supplier_name?></td>
                                      <td><?php if($member_type==4){echo number_format($info["credit"], 2, '.', '');}else{ echo number_format($info["credit"]-$discount, 2, '.', '');}?></td>
                                       <td><?php echo number_format($info["debit"], 2, '.', '')?></td>
                                       <td><?php echo $array[$c]?></td>
                                    <td><?php echo $note?>
                                    
                                    
                                    </td>
                                    <td></td> </tr>
									<?php 
                   	}}}else{?>
                   	
                   	
                   	 <?php   
                   
                 $member_filter="";
                   
                  $ledger=0;
                   $array_count=0;
                   $array = array();
                   $supplier = mysql_query("SELECT credit, debit,tran_desc,transaction_ref_id,tran_type FROM txn_transaction where member_id='".$customerid."' and tran_date between '".$_GET["from_date"]."' and '".$_GET["to_date"]."' and tran_status='active' order by tran_date asc");

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
                   		$ledger=$ledger+($supplier1['credit']);
                   		$ledger=$ledger-$supplier1['debit'];
                   		$ledger=$ledger-$discount;
                   		$ledger=number_format((float)$ledger, 0, '.', '');
                   		
                   	}
                   }
                   
                   
                   $balance=$ledger;
                   $array_count=0;
                   $array = array();
                   $supplier = mysql_query("SELECT credit, debit,tran_desc,transaction_ref_id,tran_type FROM txn_transaction where member_id='".$customerid."'  and tran_date>='".$_GET["from_date"]."' and tran_status='active' order by tran_date asc");
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
                   		array_push($array, $balance);
                   		 
                   		$array_count++;
                   	}
                   }
                   
                   $supplier_c=1;
                                  $c=$array_count;
                                  $supplier_bt=0;
                                  $BAL=0;
                                  
                   $data = mysql_query("SELECT credit, debit,tran_type,tran_desc,tran_date,note,transaction_ref_id FROM txn_transaction where member_id='".$customerid."'  and tran_date>='".$_GET["from_date"]."' and tran_status='active' order by tran_date desc");               
                   while($info = mysql_fetch_array( $data ))
                   {
                   	
                   	$note=$info["note"];
                   	if($info['credit']!=0 || $info['debit']!=0)
                   	{
                   		$discount=0;
                   		if($info["tran_desc"]=='New Bill' && $info["tran_type"]!='Agent'){
                  $data1 = mysql_query("SELECT discount,note,slip_no,sk_bill_id FROM mst_bill_main where sk_bill_id='".$info["transaction_ref_id"]."'");
                  while($info1 = mysql_fetch_array( $data1 ))
                  {
                  	$discount=$info1[0];
                  	$note=$info1[1];
                  	$note=$note." (SlipNo : ".$info1[2].")";
                  	$sk_bill_id=$info1[3];
                  }
                   		}
                   	if($info["tran_desc"]=='Return Bill'){
                  $data1 = mysql_query("SELECT discount,note,slip_no,sk_bill_id FROM mst_bill_main where sk_bill_id='".$info["transaction_ref_id"]."'");
                  while($info1 = mysql_fetch_array( $data1 ))
                  {
                  	$discount=$info1[0];
                  	$note=$info1[1];
                  	$note=$note." (SlipNo : ".$info1[2].")";
                  	$sk_bill_id=$info1[3];
                  }
                   		}
                   	$c--;
                   	$PERTICULAR=$info["tran_desc"];
                   	
                   		$supplier_name="";
                   	if($member_type==12){
                   		$transaction_ref_id=$info["transaction_ref_id"];
                   	$supplier_id=0;
		                	$data1 = mysql_query("SELECT member_id FROM mst_bill_main where sk_bill_id='$transaction_ref_id'");
	                	while($info1 = mysql_fetch_array( $data1 ))
	                	{   
	                	$supplier_id=$info1["member_id"];
	                	}
	                	$supplier_name="";
	                	$data1 = mysql_query("SELECT member_name FROM mst_member where sk_member_id='$supplier_id'");
		                	while($info1 = mysql_fetch_array( $data1 ))
		                	{
		                		$supplier_name="(".$info1["member_name"].")";
		                	}
		                		
                   	}
                   	$total_credit=$total_credit+$info["credit"];
                        $total_debit=$total_debit+$info["debit"];
                                  	?>
                                    <tr>          
                                     <td><?php if($member_type==12){?><a href='?action=purchase_edit&c=stock&bill_no=<?php echo $info["transaction_ref_id"]?>'><?php } $t_date=explode("-", $info["tran_date"]) ;echo $t_date[2]."-".$t_date[1]."-".$t_date[0]?></a></td> 
                                      <td><?php echo $PERTICULAR?> <?php echo $supplier_name?></td>
                                      <td><?php if($member_type==4){echo number_format($info["credit"], 2, '.', '');}else{ echo number_format($info["credit"]-$discount, 2, '.', '');}?></td>
                                       <td><?php echo number_format($info["debit"], 2, '.', '')?></td>
                                       <td><?php echo $array[$c]?></td>
                                    <td><?php echo $note?>
                                    
                                    
                                    </td>
                                    <td></td> </tr>
                                    
                   	
                   	<?php }}?>
                   	 <tr>          
                                     <td></td> 
                                      <td>Ledger</td>
                                      <td></td>
                                       <td></td>
                                       <td><?php echo $ledger?></td>
                                    <td></td>
                                    <td></td> </tr>    
  
                    
                   	<?php }?>
                                   
                              <tr>          
                                     <td></td> 
                                      <td></td>
                                      <td><?php echo $total_credit?></td>
                                       <td><?php echo $total_debit?></td>
                                       <td><?php echo $ledger?></td>
                                    <td></td>
                                    <td></td> </tr>
                    
                    </tbody>
                    </table>
                    
                
              </div><!-- /.box -->
        
            </div><!--/.col (left) -->
            <!-- right column -->
            
          </div> 
                 
        </section><!-- /.content -->
</div><!-- /.content-wrapper -->
 <?php include_once "$D_PATH/include/footer.php";?>
 <script type="text/javascript">
                  function email_bill(bill_no)
                  {
                      var email=document.getElementById("email").value
                 	var customer_id=document.getElementById("customer_id").value
					window.location="index.php?action=print_bill&c=customer&c_id="+customer_id+"&op=email&c_email="+email+"&bill_no="+bill_no;
                  }
                  </script>
                   
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
