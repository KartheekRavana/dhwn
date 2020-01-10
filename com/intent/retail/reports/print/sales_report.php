<?php include_once "$D_PATH/include/session.php";?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  </head>
   <body >
    <div class="wrapper">
      
      
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    
            <!-- right column -->
            <?php $q="";
            if(isset($_GET["from_date"])){
				$payment_type=$_GET["payment_type"];
           		$q=" and bill_date between '".$_GET["from_date"]."' and '".$_GET["to_date"]."'";
           if($_GET["from_date"]=="" && $_GET["to_date"]==""){$q="";}
            $received_amt=0;
            ?>
            <div class="col-md-12">
              
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Sales Bills</h3>
                </div><!-- /.box-header -->
                <div class="box-body" style="overflow: auto">
                <table id="" class="table table-bordered table-striped" style="font-size: 12px;width: 100%" border=1 cellpadding=0 cellspacing=0>
                    <thead>
                      <tr>
                       
                        <th>Customer Name</th><th>Mobile</th>
                        <th>Billing Amount</th> 
                       <th>Note</th> 
                      </tr>
                    </thead>
                    <tbody id='div_print' style="font-size: 12px;">
                    <?php
                   
                    $credit_payment=0;$i=1;$return_page='sales_edit';
                     if($_GET["bill_type"]=="Sales" && ($payment_type=="Cash" || $payment_type=="Credit")){
                    		$data = mysql_query("SELECT sk_bill_id,bill_date,member_name,member_id,mobile,place,bill_for,bill_type,bill_amount,measurement_slip_no,slip_no,note,grand_total,t_discount_amount,transport_amount,discount FROM mst_bill_main where bill_for='Customer' and (bill_type='$payment_type') $q order by bill_date ");
                     }
                     else if($_GET["bill_type"]=="Sales" && $payment_type=="All"){
                     	$data = mysql_query("SELECT sk_bill_id,bill_date,member_name,member_id,mobile,place,bill_for,bill_type,bill_amount,measurement_slip_no,slip_no,note,grand_total,t_discount_amount,transport_amount,discount FROM mst_bill_main where bill_for='Customer' and (bill_type='Cash' or bill_type='Credit') $q order by bill_date ");
                     }
                     else if($_GET["bill_type"]=="Return" && $payment_type=="All"){
                     	$return_page="sales_return_edit";
 						$data = mysql_query("SELECT sk_bill_id,bill_date,member_name,member_id,mobile,place,bill_for,bill_type,bill_amount,measurement_slip_no,slip_no,note,grand_total,t_discount_amount,transport_amount,discount FROM mst_bill_main where bill_for='Customer' and (bill_type='Cash Retur' or bill_type='Credit Ret' or bill_type='Cash Return' or bill_type='Credit Return') $q order by bill_date ");
                     }
                     else if($_GET["bill_type"]=="Return" && ($payment_type=="Cash" || $payment_type=="Credit")){
                     	$return_page="sales_return_edit";
                     	$data = mysql_query("SELECT sk_bill_id,bill_date,member_name,member_id,mobile,place,bill_for,bill_type,bill_amount,measurement_slip_no,slip_no,note,grand_total,t_discount_amount,transport_amount,discount FROM mst_bill_main where bill_for='Customer' and (bill_type='$payment_type Retur' or bill_type='$payment_type Ret' or bill_type='$payment_type Return') $q order by bill_date ");
                     }
                    while($info = mysql_fetch_array( $data ))
	                	{      
	                		
	                	
	                		
							$member_name="";
							$mobile="";
							$member_id=$info["member_id"];
							if($member_id!=0){
		                		$data1 = mysql_query("SELECT member_name,mobile FROM mst_member where sk_member_id='$member_id'");
			                	while($info1 = mysql_fetch_array( $data1 ))
			                	{
			                		$member_name=$info1["member_name"];
			                		$mobile=$info1["mobile"];
			                	}
							}else{
								$member_name=$info["member_name"];
								$mobile=$info["mobile"];
							}
	                		$credit_payment=$credit_payment+$info["bill_amount"];     
                    ?><tr>
                    
                  	
                    <td><?php echo $member_name?></td>
                    <td><?php echo $mobile?></td>
                    <td><?php echo $info["bill_amount"]?></td>
                     <td><?php echo $info["note"]?></td>
                     
                    </tr>
                    
                    <?php $i++;}?>
                                </tbody>
                                    
                  </table>
                  
                </div><!-- /.box-body -->
              </div><!-- /.box -->
              
             
              
              
                    
    	</div>   
               <?php }?>  
                 
        <script>
window.print();
setInterval(
		  function(){ window.location="?action=sales_report&c=reports&from_date=<?php echo $_GET["from_date"]?>&to_date=<?php echo $_GET["to_date"]?>&bill_type=Sales"; },
		  1000
		);
</script>
</body>
</html>
