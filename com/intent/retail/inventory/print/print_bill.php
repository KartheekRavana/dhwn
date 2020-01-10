<?php include_once "$D_PATH/include/session.php";?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
     <style>
* {
color: #7F7F7F;
font-family: Arial, sans-serif;
font-size: 12px;
font-weight: normal;
}
#config {
overflow: auto;
margin-bottom: 10px;
}
.config {
float: left;
width: 200px;
height: 250px;
border: 1px solid #000;
margin-left: 10px;
}
.config .title {
font-weight: bold;
text-align: center;
}
.config .barcode2D,  #miscCanvas {
display: none;
}
#submit {
clear: both;
}
#barcodeTarget,  #canvasTarget {
margin-top: 20px;
}
</style>
<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript" src="jquery-barcode.js"></script>

<script type="text/javascript">
    
      function generateBarcode(){
        var data="";
        
        var values=document.getElementById("values").value
        
        var tempval=values.split("#");
        
        var count=tempval.length;
        //count=parseInt(document.getElementById("count").value);
      
        var k=1;
        var z=1;
        var leave=0//parseInt(document.getElementById("leave_qty").value)
        count=count+leave;
       
        for(i=1;i<count;i++)
          {       
                
       
        var btype = $("input[name=btype]:checked").val();
        var renderer = $("input[name=renderer]:checked").val();
        
    var quietZone = false;
        if ($("#quietzone").is(':checked') || $("#quietzone").attr('checked')){
          quietZone = true;
        }
    
        var settings = {
          output:renderer,
          bgColor: "FFF",
          color: "#000000",
          barWidth: "1",
          barHeight: "15",
          moduleSize: "5",
          posX: "10",
          posY: "20",
          addQuietZone: "1"
        };
        if ($("#rectangular").is(':checked') || $("#rectangular").attr('checked')){
          value = {code:value, rect: true};
        }
        if (renderer == 'canvas'){
          clearCanvas();
          $("#barcodeTarget").hide();
          $("#canvasTarget").show().barcode(value, btype, settings);
         
        } else {
            $("#canvasTarget").hide();
          
              var temp="";
             
              
          // for(var j=1;j<=4;j++)
             {
             
               var value=tempval[i]
              
                   $("#barcodeTarget").html("").show().barcode(value, btype, settings);
                   temp=$("#barcodeTarget").html();
                  
               data=data+temp;
              // if(z>leave)
               {
               $("#barcode_"+i).html(temp)
              
               }
               z++;
               }
         
          
        }
          }
        $("#barcodeTarget").html("")
       // $("#bar").html(data)
      }
          
      function showConfig1D(){
        $('.config .barcode1D').show();
        $('.config .barcode2D').hide();
      }
      
      function showConfig2D(){
        $('.config .barcode1D').hide();
        $('.config .barcode2D').show();
      }
      
      function clearCanvas(){
        var canvas = $('#canvasTarget').get(0);
        var ctx = canvas.getContext('2d');
        ctx.lineWidth = 1;
        ctx.lineCap = 'butt';
        ctx.fillStyle = '#FFFFFF';
        ctx.strokeStyle  = '#000000';
        ctx.clearRect (0, 0, canvas.width, canvas.height);
        ctx.strokeRect (0, 0, canvas.width, canvas.height);
      }
      
      $(function(){
          
        $('input[name=btype]').click(function(){
          if ($(this).attr('id') == 'datamatrix') showConfig2D(); else showConfig1D();
        });
        
        $('input[name=renderer]').click(function(){
          if ($(this).attr('id') == 'canvas') $('#miscCanvas').show(); else $('#miscCanvas').hide();
        });
       
        generateBarcode();
      });
  
    </script> 
    </head>
    <body class="interface">
        <!--  [if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        [endif]-->

      

        <!-- ==================== DROPDOWN MENU FOR MOREOPTIONS ICON (hidden state) ==================== -->
        
        <!-- ==================== END OF DROPDOWN MENU ==================== -->

        <!-- ==================== PAGE CONTENT ==================== -->
        <div class="content">

            <!-- ==================== TITLE LINE FOR HEADLINE ==================== -->
            
            <!-- ==================== END OF TITLE LINE ==================== -->

            <!-- ==================== BREADCRUMBS / DATETIME ==================== -->
       
            <!-- ==================== END OF BREADCRUMBS / DATETIME ==================== -->

            <!-- ==================== WIDGETS CONTAINER ==================== -->
            
                 <form action="view_bill.php?slipno=<?php echo $_GET["slipno"]?>" onsubmit="validate()" data-validate="parsley" id="formWizard" method="POST">        
                           <input type='hidden' id='data' name='data'>
                            <input type='hidden' id='login' name='login' value='<?php echo $session_id?>'>
                            <input type='hidden' id='branch' name='branch' value='<?php echo $session_branch?>'>  
                        <div class="container-fluid">

                <!-- ==================== COMMON ELEMENTS ROW ==================== -->
                <div class="row-fluid">
                    <div class="row-fluid" style="width:380px;margin-left:150px;font-size: 12px">  
                    
                 

                           
                            <?php 
                            $b_no=$_GET["bill_no"];
                            if($_GET["op"]=="print")
                            {
                            ?>
                    <div class="span2">
 					    
                        <!-- ==================== SPAN3 HEADLINE ==================== -->
                      
                   
                        <!-- ==================== END OF SPAN3 HEADLINE ==================== -->

                        <!-- ==================== SPAN3 FLOATING BOX ==================== -->
                     
                
                        <div class="floatingBox"> 
                        <div class="container-fluid">                     
                     <script type="text/javascript" src="js/intent-loan.js"></script>             
                
	    
	              <?php 
	              $bill_type="";$invoice="";$bill_for="";
	          $data = mysql_query("SELECT `sk_bill_id`, `bill_date`, `bill_time`, `member_id`, `member_name`, `mobile`, `place`, `bill_for`, `bill_type`, `bill_amount`, `tax_rate`, `tax_amount`, `t_discount_rate`, `t_discount_amount`, `bill_tax_amount`, `transporter_id`, `transporter_rate`, `transport_amount`, `other_expenses`, `hamali_id`, `hamali`, `grand_total`, `cash_amount`, `check_amount`, `paid_amount`, `discount`, `balance_amount`, `note`, `bank_id`, `bill_status`, `measurement_slip_no`, `agent_id`, `agent_rate`, `agent_amount`, `employee_id`, `branch_id` FROM mst_bill_main where sk_bill_id='".$b_no."'");
	          while($info = mysql_fetch_array( $data ))
	          {
	          	$note=$info["note"];
	          	$bill_type=$info['bill_type'];
	          	$bill_for=$info['bill_for'];
	          	if($bill_for=="Customer"){
		          	if($bill_type=="Cash" || $bill_type=="Credit"){
		          		$invoice="SALES";
		          	}
		          	if($bill_type=='Cash Retur' || $bill_type=='Credit Ret' || $bill_type=='Cash Return' || $bill_type=='Credit Return'){
		          		$invoice="SALES RETURN";
		          	}	
		         }
		         else{
					if($bill_type=="Cash" || $bill_type=="Credit"){
						$invoice="PURCHASE";
					}
					if($bill_type=='Cash Retur' || $bill_type=='Credit Ret' || $bill_type=='Cash Return' || $bill_type=='Credit Return'){
						$invoice="PURCHASE RETURN";
					}
				 }
	          	if($info["member_id"]==0){$c=$info["member_name"];}
	          	else{
	          		
$data1 = mysql_query("SELECT member_name FROM mst_member where sk_member_id='".$info["member_id"]."'");
while($info1 = mysql_fetch_array( $data1 ))
{
	$c=$info1["member_name"];
}

	          	}
	          ?>
	            <input type='hidden' id='bill_no' name='bill_no' value='<?php echo $info['bill_no']?>'>
	           
	           <table>
	           <caption style="font-weight: bolder;font-size: 20px;"><?php echo $invoice?></caption>
	           <tr><td>Name </td><td colspan="4"> : <?php echo $c?></td></tr>	           
	           <tr><td>Place </td><td> : <?php echo $info["place"]?></td><td>&nbsp;&nbsp;&nbsp;</td><td>Date</td><td> : <?php $tdate=explode("-", $info["bill_date"]);echo $tdate[2]."-".$tdate[1]."-".$tdate[0] ?></td></tr>
	           <tr><td>Mobile </td><td> : <?php echo $info["mobile"]?></td><td>&nbsp;&nbsp;&nbsp;</td><td>Ref No</td><td> : <?php echo $b_no ?></td></tr>
	           <tr></tr>
                  </table>             
		 
	           <?php }?>
	          
		</div>
		</div>
                          
               </div>
               
               <div class="span5">
 					        
                        <!-- ==================== SPAN3 HEADLINE ==================== -->
                      
                   
                        <!-- ==================== END OF SPAN3 HEADLINE ==================== -->

                        <!-- ==================== SPAN3 FLOATING BOX ==================== -->
                     
                 
                        <div class="floatingBox"> 
                        <div class="container-fluid">                     
                   
	           <table border=1 cellpadding='0' cellspacing=0 style="width: 100%;font-size: 13px">
	           <tr><th>ITEMS</th><th>QTY</th><th>COST</th><th>TOTAL</th></tr>
	           
	           <?php 
	           $i=1;$items_list="";
	           $data = mysql_query("SELECT `sk_tran_id`, `bill_id`, `bill_for`, `bill_type`,description,note, `bill_date`, `particular_id`, `qty_in_piece`, `qty_in_sft`, `rate`, `amount`, `landing_cost`, `bill_status`, `employee_id`, `branch_id` FROM txn_bill_support where bill_id='".$b_no."'");
	           while($info = mysql_fetch_array( $data ))
	           {
	           	$particular_id=$info["particular_id"];
	           $item_name="";
	           $data1 = mysql_query("SELECT item_name,thickness, length, breadth FROM items where item_id='".$info["particular_id"]."'");
	           	while($info1 = mysql_fetch_array( $data1 ))
	           	{
	           		$item_name=$info1["item_name"];
	           	}
	           	$note="";
	           	if($info["note"]!=""){
	           		$note=" - ".$info["note"];	
	           	}
	           	$sk_tran_id=0;
	           	$data2 = mysql_query("SELECT sk_tran_id FROM txn_bill_support where description='".$info["description"]."' order by sk_tran_id asc limit 1");
	           	while($info2 = mysql_fetch_array( $data2 ))
	           	{
	           		$sk_tran_id=$info2["sk_tran_id"];
	           	}
	           	 
	           ?>
	           <tr>
	           
	           		<td style="font-size: 13px">
	           		<?php echo $item_name?> <span style="text-transform: lowercase;">(<?php echo $info["description"]?>) <?php echo $note?></span>
	           		</td>	           		
	           		<td style="text-align: center;"><?php echo number_format($info["qty_in_sft"], 2, '.', '')?></td>
	           		<td style="text-align: right;"><?php echo number_format($info["rate"], 2, '.', '')?></td>
	           		<td style="text-align: right"><?php echo number_format($info["amount"], 2, '.', '')?></td>
	           		
	           </tr>
	           <?php $i++;}?>
	         
	          
	          <?php 
	          $data = mysql_query("SELECT  `bill_amount`, `tax_rate`, `tax_amount`, `t_discount_rate`, `t_discount_amount`, `bill_tax_amount`, `transporter_id`, `transporter_rate`, `transport_amount`, `other_expenses`, `hamali_id`, `hamali`, `grand_total`, `cash_amount`, `check_amount`, `paid_amount`, `discount`, `balance_amount`, `note`, `bank_id`, `bill_status`, `measurement_slip_no`, `agent_id`, `agent_rate`, `agent_amount`, `employee_id`, `branch_id` FROM mst_bill_main where sk_bill_id='".$b_no."'");
	          while($info = mysql_fetch_array( $data ))
	          {$tax_rate=$info["tax_rate"];
                	$tax_discount_rate=$info["t_discount_rate"];
                	$tax_discount=$info["t_discount_amount"];
                	$transporter_id=$info["transporter_id"];
                	$total_amt=$info["grand_total"];
	          ?>
	         
	             <tr><td colspan="2"></td><td>Total&nbsp;Amt</td><td style="text-align: right"><?php echo $info["bill_amount"]?></td></tr>
	           
	             <tr><td colspan="2"></td><td>Discount</td><td style="text-align: right"><?php echo $info["discount"]?></td></tr>
	             <tr><td colspan="2"></td><td>Transport</td><td style="text-align: right"><?php echo $info["transport_amount"]?></td></tr>
 <tr><td colspan="2"></td><td>Grand Total</td><td style="text-align: right"><?php echo ($info["bill_amount"]+$info["transport_amount"])-$info["discount"]?></td></tr>
	           </table>	           
	          
	       <?php }?>
		</div>
		</div>
                          
               </div>
                           <!-- ==================== END OF WIDGETS CONTAINER ==================== -->
 <input type='hidden' value='<?php echo $_GET["bill_no"];?>' id='slipno'> 
        <!-- ==================== END OF PAGE CONTENT ==================== -->
        <input type='hidden' id='supplier_id' value="<?php echo $_GET["bill_no"]?>">
<script type="text/javascript">
self.print();
var sup_id=document.getElementById("supplier_id").value;
setTimeout(function() { 
//	window.location="index.php?action=statement&c=customer&c_id="+sup_id;
window.close();
//window.location="?action=new&c=stock;
	}, 1000);

	           </script> 
               <?php }else{?>
               
                  <?php 
	          $data = mysql_query("SELECT bill_no, customer_id, bill_date, total, comm, lug_exp, prev_bal, total_bal, amount_paid, final_bal, login_id, branch, customer_name, partner_id, check_payment, cashe_payment, discount, phone, city, tax, transport,note FROM customerbillmain where bill_no='".$b_no."'");
	          while($info = mysql_fetch_array( $data ))
	          {
	          
	          	if($info["customer_id"]==0){$c=$info["customer_name"];}
	          	else{
	          		
$data1 = mysql_query("SELECT customer_name FROM customer where customer_id='".$info["customer_id"]."'");
while($info1 = mysql_fetch_array( $data1 ))
{
	$c=$info1["customer_name"];
}

	          	}
	          	$city=$info["city"];
	          	$phone=$info["phone"];
	          	$date1=$_SESSION['date1'];
	           $message="<table>
	           <tr><td>Buyer&nbsp;Name </td><td> : $c</td></tr>	           
	           <tr><td>Place </td><td> : $city</td></tr>
	           <tr><td>Mobile </td><td> : $phone</td></tr>
	           <tr><td>Stock Out Date</td><td> : $date1</td></tr>
                  </table> <br/>
	           <table border=1 cellpadding='0' cellspacing=0><tr><th>ITEMS</th><th>QTY&nbsp;IN&nbsp;PIECE</th><th>QTY&nbsp;SFT</th><th>COST</th><th>FINAL&nbsp;COST</th></tr>";
	         
	           $i=1;
	           $data = mysql_query("SELECT bill_no, item_date, item_name, item_qty, item_rate, amt, item_qty_p,tran_id FROM customerbill where bill_no='".$b_no."'");
	           while($info = mysql_fetch_array( $data ))
	           {
	           	$item_name=$info["item_name"];
	         	$item_qty_p=$info["item_qty_p"];
	         	$item_qty=$info["item_qty"];
	         	$item_rate=number_format($info["item_rate"], 2, '.', ' ');
	         	$amt=number_format($info["amt"], 2, '.', ' ');
	         	
	           	$message1=$message1."<tr><td>$item_name</td><td>$item_qty_p</td><td>$item_qty</td><td>$item_rate</td><td style='text-align: right'>$amt</td></tr>";
	           	           $i++;}?>
	           	         
	           	          
	           	          <?php 
	           	          $data = mysql_query("SELECT bill_no, customer_id, bill_date, total, comm, lug_exp, prev_bal, total_bal, amount_paid, final_bal, login_id, branch, customer_name, partner_id, check_payment, cashe_payment, discount, phone, city, tax, transport FROM customerbillmain where bill_no='".$b_no."'");
	           	          while($info = mysql_fetch_array( $data ))
	           	          {
	           	          	$total=number_format($info["total"], 2, '.', ' ');
	           	          	$tax=number_format($info["tax"], 2, '.', ' ');
	           	          	$transport=number_format($info["transport"], 2, '.', ' ');
	           	          	$lug_exp=number_format($info["lug_exp"], 2, '.', ' ');
	           	          	$total_val=number_format($info["total"]+$info["tax"]+$info["transport"]+$info["lug_exp"], 2, '.', ' ');	           	          	
	           	          	$amount_paid=number_format($info["amount_paid"], 2, '.', ' ');
	           	          	$balance=number_format(($info["total"]+$info["tax"]+$info["transport"]+$info["lug_exp"])-$info["amount_paid"], 2, '.', ' ');
	           	          	
           	         $message=$message.$message1."<tr><td></td><td></td><td></td><td>Total&nbsp;Amt</td><td style='text-align: right'>$total</td></tr><tr><td></td><td></td><td></td><td>Tax&nbsp;Amt</td><td style='text-align: right'>$tax</td></tr><tr><td></td><td></td><td></td><td>Transport&nbsp;Amt</td><td style='text-align: right'>$transport</td></tr><tr><td></td><td></td><td></td><td>Other&nbsp;Expenses</td><td style='text-align: right'>$lug_exp</td></tr><tr><td></td><td></td><td></td><td>Total Value</td><td style='text-align: right'>$total_val</td></tr><tr><td></td><td></td><td></td><td>Paid&nbsp;Amt</td><td style='text-align: right'>$amount_paid</td></tr><tr><td></td><td></td><td></td><td>Balance&nbsp;Amt</td><td style='text-align: right'>$balance</td></tr></table>";	  
           	         $customerid=$_GET["c_id"];
           	         mysql_query("update customer set email='".$_GET["c_email"]."' where customer_id='$customerid'");
           	    
           	          
           	         // declare our variables
           	         $name = "DHARANI GRANITES";
           	         $email = "dmgindia08@gmail.com";
           	         $message = nl2br($message);
           	         
           	         // set a title for the message
           	         $subject = "Message from Dharani Granites";
           	         $body = "From $name, \n\n$message";
           	         $headers = 'From: '.$email.'' . "\r\n" .
           	         		'Reply-To: '.$email.'' . "\r\n" .
           	         		'Content-type: text/html; charset=utf-8' . "\r\n" .
           	         		'X-Mailer: PHP/' . phpversion();
           	         
           	         // put your email address here
           	         mail($_GET["c_email"], $subject, $body, $headers);
           	         ?>
           	                             
           	                             <?php }?>
           	                           <input type='hidden' value='<?php echo $_GET["bill_no"];?>' id='slipno'> 
        <!-- ==================== END OF PAGE CONTENT ==================== -->
        <input type='hidden' id='supplier_id' value="<?php echo $_GET["c_id"]?>">
<script type="text/javascript">
var sup_id=document.getElementById("supplier_id").value;
setTimeout(function() { 
	//window.location="index.php?action=statement&c=customer&c_id="+sup_id+"&status=success//Email Sent Successfully";
	window.close(); 
	}, 1000);

	           </script> 
        
               <?php }}?>
               
               </div>
               </div>                 
                 
                 
                                 
                            </div>
                            
                            </form>
                        </div>
                        
              
                        
                      
<input type="hidden" id="values" value="<?php echo $items_list?>">
       <div id="barcodeTarget" style="float: left;" class="barcodeTarget"></div>
    </body>
</html>
