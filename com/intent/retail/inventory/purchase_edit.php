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
            
          <section class="content">
          
          <form role="form" onsubmit="return validate()" action="index.php?action=operations/in_edit&c=inventory" method="POST">
          <input type='hidden' id='data' name='data'>
          <input type='hidden' id='bill_for' name='bill_for' value="Supplier">
          <input type='hidden' id='total_sft' name='total_sft'>
           <input type='hidden' name="session_branch" id="session_branch" value="<?php echo $session_branch?>">
           <input type='hidden' name="customer_bill_no" id="customer_bill_no" value="<?php echo $_GET['bill_no']?>">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary" style="overflow: auto;">
                <?php 
                
                $bill_no=$_GET["bill_no"];
                $customer_name="";
                $customer_type="Cash";
                $tax_discount_rate=0;
                $tax_discount=0;
                $transporter_id=0;$tax_rate=0;$total_amt=0;
                $customer_name_cash="";
                $data = mysql_query("SELECT sk_bill_id, slip_no,bill_date, bill_time, member_id,cmeasurement, member_name, mobile, place, bill_for, bill_type, bill_amount, tax_rate, tax_amount, t_discount_rate, t_discount_amount, bill_tax_amount, transporter_id, transport_amount, other_expenses, hamali, grand_total, cash_amount, check_amount, paid_amount, discount, balance_amount, note, bank_id, bill_status, measurement_slip_no,agent_id,agent_rate,agent_amount, employee_id, branch_id,invoice_amt,vat_rate,vat,purchase_exp FROM mst_bill_main where sk_bill_id=$bill_no");
                while($info = mysql_fetch_array( $data ))
                {
                	$customer_id=$info["member_id"];
                	$member_name=$info["member_name"];
                	$mobile=$info['mobile'];
                	$city=$info['place'];
                	$bill_no=$info['sk_bill_id'];
                	$bill_date=$info['bill_date'];
                	 $bill_amount=$info["bill_amount"];
                	$tax_rate=$info["tax_rate"];
                	$tax_amount=$info["tax_amount"];
                	$tax_discount_rate=$info["t_discount_rate"];
                	$tax_discount=$info["t_discount_amount"];
                	$transporter_id=$info["transporter_id"];
                	$bill_tax_amount=$info["bill_tax_amount"];
                	$transporter_id=$info["transporter_id"];
                	$transport_amount=$info["transport_amount"];
                	$other_expenses=$info["other_expenses"];
                	$grand_total=$info["grand_total"];
                	$cash_amount=$info["cash_amount"];
                	$check_amount=$info["check_amount"];
                	$paid_amount=$info["paid_amount"];
                	$discount=$info["discount"];
                	$balance_amount=$info["balance_amount"];
                	$note=$info["note"];
                	$bank_id=$info["bank_id"];
                	$measurement_slip_no=$info["measurement_slip_no"];
                	$hamali=$info["hamali"];
                	$slip_no=$info["slip_no"];

                	$cmeasurement=$info["cmeasurement"];
                	$agent_id=$info["agent_id"];
                	$agent_rate=$info["agent_rate"];
                	$agent_amount=$info["agent_amount"];
                	
                	$invoice_amt=$info["invoice_amt"];
                	$vat_rate=$info["vat_rate"];
                	$vat=$info["vat"];
                	$purchase_exp=$info["purchase_exp"];
                }
                $data = mysql_query("SELECT sk_member_id, member_type, member_name, acc_no, ifsc, mobile, landline, email, address, place, state, profile_pic, login_name, login_password, login_status, member_status, employee_id, branch_id FROM mst_member where sk_member_id=$customer_id");
                while($info = mysql_fetch_array( $data ))
                {
                	$customer_name=$info['member_name'];
                	$mobile=$info['mobile'];
                	$city=$info['place'];       
                	$customer_type="Credit";
                }
                
                ?>
                <!-- form start -->
                <br/>
                
                <table>
                <tr>
                	<td>Slip&nbsp;No</td><td id='bill_no_v'><input type="text" style="width: 150px;float: left" class="form-control" value='<?php echo $slip_no?>' readonly="readonly" onfocus="finalCost()" id="slip_no" name="slip_no"/></td><td>&nbsp;&nbsp;</td>
                	<td>Bill&nbsp;Date</td><td id='bill_date_v'><input type="date" class="form-control" id="bill_date" name="bill_date" value="<?php echo $bill_date?>"></td><td>&nbsp;&nbsp;</td>
                	<td>Bill&nbsp;Type</td><td id='bill_type_v'><select style="width: 80px;float: left" class="form-control" id="bill_type" name="bill_type" onchange="checkCustomer(this.value)"><option value="<?php echo $customer_type?>"><?php echo $customer_type?></option><option value="Cash">Cash</option><option value="Credit">Credit</option></select>
                	<select style="width: 80px;float: left" class="form-control" id="bill_type1" name="bill_type1" onchange="checkCustomer(this.value)"><option value="Existing">Existing</option><option value="New">New</option></select>
                	</td><td>&nbsp;&nbsp;</td>
                	<td>&nbsp;&nbsp;</td>
                	<td>Agent</td><td id='agent_name_v'>
                	<select style="width: 80px;" class="form-control pull-left" id="agent_type" name="agent_type" onchange="checkAgent(this.value)"><option value="Existing">Existing</option><option value="New">New</option></select>
                	<span id="existing" style="float: left">
                	<select  name="agent_id" id="agent_id" class="form-control selectpicker pull-left" data-live-search="true" data-live-search-style="begins" title="Please select a Agent ..." style="width: 150px"  onchange="getAgent(this.value)">
                	 <?php 
                        $data = mysql_query("SELECT sk_member_id,member_name FROM mst_member where member_status='active' and sk_member_id='$agent_id'");
                        while($info = mysql_fetch_array( $data ))
                        {
                        ?>  
	               <option  value="<?php echo $info["sk_member_id"]?>"><?php echo $info["member_name"]?></option>
	               <?php }?>
                	<option value=""></option>
                	 <?php 
                                   
                                  $data = mysql_query("SELECT sk_member_id,member_name FROM mst_member where member_status='active' and branch_id='$session_branch' and member_type='5' order by member_name asc");
                                  while($info = mysql_fetch_array( $data ))
                                  {
                                  ?>  
	               <option  value="<?php echo $info["sk_member_id"]?>"><?php echo $info["member_name"]?></option>
	               <?php }?>
                	</select>
                	
                	</span>
                	<span style="display : none;float: left" id="new">
                	<input type="text" class="form-control pull-left" id="agent_name" name="agent_name" style="width: 150px">
                	</span>
                	<input type="text" class="form-control pull-left" id="agent_per" onblur="finalCost()" name="agent_per" value='<?php echo $agent_rate?>' placeholder="%" style="width: 80px">
                	</td>
                </tr>
                <tr><td>&nbsp;</td></tr>
                 <tr>
                	<td>Customer</td><td id='customer_name_v'>
                	
                	<?php $status="";$status1="";
                	if($customer_id=="0"){$status=" style='display:none;width: 150px'";}
                	else{$status1=" style='display:none;width: 150px'";}
                	if($customer_id==0){$customer_id="";}
                	?>
                	<span id="customer_type">
                	<input type="text" class="form-control" id="customer_name" size="15" name="customer_name" value="<?php echo $member_name?>" <?php echo $status1?>>
                	</span>
                	<span id="customer_type1">
                	<select  name="customer_id" id="customer_id" class="form-control" <?php echo $status?> style="width: 150px;float: left">
                	 <option value="<?php echo $customer_id?>"><?php echo $customer_name?></option>
                	 <?php 
                                   
                                  $data = mysql_query("SELECT sk_member_id,member_name FROM mst_member where member_status='active' and branch_id='$session_branch' and member_type=2 order by member_name asc");
                                  while($info = mysql_fetch_array( $data ))
                                  {
                                  ?>  
	               <option  value="<?php echo $info["sk_member_id"]?>"><?php echo $info["member_name"]?></option>
	               <?php }?>
                	</select>
                	</span>
                	</td><td>&nbsp;&nbsp;</td>
                	<td>Mobile</td><td id='mobile_v'><input type="text" maxlength="10" class="form-control onlyNumbers" id="mobile" name="mobile" value="<?php echo $mobile?>"></td><td>&nbsp;&nbsp;</td>
                	<td>Place</td><td id='place_v'><input type="text" class="form-control" id="place" name="place" value="<?php echo $city?>"></td><td>&nbsp;&nbsp;</td>
                	<td>&nbsp;&nbsp;</td>
                	<td>C Mnt in%</td><td id='place_v'><input type="text" class="form-control" id="cmeasurement" value="<?php echo $cmeasurement?>" name="cmeasurement" style="width: 160px" value='0'></td><td>&nbsp;&nbsp;</td>
                
                	
                </tr>
                </table>
                <br/>
                </div>
                </div>
                
                
                 <div class="col-md-9">
             

              <div class="box" style="overflow: auto;">
                
                <div class="box-body">
           
                <br/>
                <table style="width: 96%;margin-left: 2%">
                <tr><th></th><td>&nbsp;&nbsp;</td><th>Category&nbsp;<a href="" class='click'>+</a></th><td>&nbsp;&nbsp;</td><th>Items&nbsp;&nbsp;&nbsp;<a href="" class='click'>+</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th><td>&nbsp;&nbsp;</td><th>Qty/Piece</th><td>&nbsp;&nbsp;</td><th>Qty&nbsp;In&nbsp;Sft</th><td>&nbsp;&nbsp;</td><th>Cost&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th><td>&nbsp;&nbsp;</td><th>Total&nbsp;Amt</th><th></th><th>Lan Cost</th></tr>
                <?php 
	           $i=1;
	           
	           $data = mysql_query("SELECT sk_tran_id, bill_id, bill_for, bill_type, bill_date, particular_id, qty_in_piece, qty_in_sft, rate, amount,landing_cost, bill_status, employee_id, branch_id FROM txn_bill_support where bill_id='".$bill_no."' and qty_in_sft>0");
	           while($info = mysql_fetch_array( $data ))
	           {
	           	
	           	$item_id=$info["particular_id"];
	           	$item_qty=$info["qty_in_sft"];
	           	$item_qty_p=$info["qty_in_piece"];
	           	$item_rate=$info["rate"];
	           	$amt=$info["amount"];
	           	$lcost=$info["landing_cost"];
	          
	          
	           	$data1 = mysql_query("SELECT sk_particular_id, particular_name, particular_desc, category_id, sub_category_id, particular_status, branch_id FROM mst_particular where sk_particular_id='$item_id'");
	           	while($info1 = mysql_fetch_array( $data1 ))
	           	{
	           		$item_name=$info1["particular_name"];
	           		$category_id=$info1["category_id"];
	           	}
	           	 
	           	$data1 = mysql_query("SELECT particular_name FROM mst_particular where sk_particular_id='$category_id'");
	           	while($info1 = mysql_fetch_array( $data1 ))
	           	{
	           		$category_name=$info1["particular_name"];
	           	}
	           	
                ?>
                <tr>
                <td><?php echo $i?></td><td>&nbsp;&nbsp;</td>
                 <td><select class="form-control" id="category<?php echo $i?>" name="category<?php echo $i?>" onchange="loadItems(<?php echo $i?>,this.value)"><option value="<?php echo $category_id?>"><?php echo $category_name?></option><?php $data1 = mysql_query("SELECT sk_particular_id, particular_name FROM mst_particular where particular_status='active' and category_id=0 and branch_id='".$session_branch."'");while($info1 = mysql_fetch_array( $data1 )){?><option  value="<?php echo $info1["sk_particular_id"]?>"><?php echo $info1["particular_name"]?></option><?php }?></select></td><td>&nbsp;&nbsp;</td>
                <td><select class="form-control" id="item<?php echo $i?>" name="item<?php echo $i?>"><option value="<?php echo $item_id?>"><?php echo $item_name?></option><option value=""></option><?php $data1 = mysql_query("SELECT sk_particular_id, particular_name FROM mst_particular where category_id='$category_id' and category_id!=0 and branch_id='".$session_branch."'");while($info1 = mysql_fetch_array( $data1 )){?><option  value="<?php echo $info1["sk_particular_id"]?>"><?php echo $info1["particular_name"]?></option><?php }?></select></td><td>&nbsp;&nbsp;</td>
                <td><input type="text" class="form-control onlyNumbers" value="<?php echo $item_qty_p?>" id="qty_piece<?php echo $i?>" name="qty_piece<?php echo $i?>" size="5"></td><td>&nbsp;&nbsp;</td>
                <td><input type="text" class="form-control" onkeypress="return isDecimalNumber(event,this);" value="<?php echo $item_qty?>" id="qty_sft<?php echo $i?>" name="qty_sft<?php echo $i?>" size="5" onblur="finalCost()"></td><td>&nbsp;&nbsp;</td>
                <td><input type="text" class="form-control" onkeypress="return isDecimalNumber(event,this);" value="<?php echo $item_rate?>" id="cost<?php echo $i?>" name="cost<?php echo $i?>" size="5" onblur="finalCost()"></td><td>&nbsp;&nbsp;</td>
                <td><input type="text" class="form-control" value="<?php echo $amt?>" id="fcost<?php echo $i?>" name="fcost<?php echo $i?>" readonly="readonly"></td><td>&nbsp;&nbsp;</td>
                <td><input type="text" class="form-control" value="<?php echo $lcost?>" id="lcost<?php echo $i?>" name="lcost<?php echo $i?>" readonly="readonly"></td><td>&nbsp;&nbsp;</td>
                </tr>
                <tr><td>&nbsp;</td></tr>
                <?php $i++;}?>
                 <?php $j=$i+1;
                for($i=$i;$i<=50;$i++)
                {
                	$state='';
                	if($i>$j){
                		$state="style='visibility: hidden;position: absolute;'";
                	}
                ?>
                <tr id="subnewboxes<?php echo $i?>" name="subnewboxes<?php echo $i?>" <?php echo $state?>>
                <td><?php echo $i?></td><td>&nbsp;&nbsp;</td>
                <td><select class="form-control" id="category<?php echo $i?>" name="category<?php echo $i?>" onchange="loadItems(<?php echo $i?>,this.value)"><option value=""></option><?php $data1 = mysql_query("SELECT sk_particular_id, particular_name FROM mst_particular where particular_status='active' and category_id=0 and branch_id='".$session_branch."'");while($info1 = mysql_fetch_array( $data1 )){?><option  value="<?php echo $info1["sk_particular_id"]?>"><?php echo $info1["particular_name"]?></option><?php }?></select></td><td>&nbsp;&nbsp;</td>
                <td><select class="form-control" id="item<?php echo $i?>" name="item<?php echo $i?>"><option value=""></option></select></td><td>&nbsp;&nbsp;</td>
                 <td><input type="text" class="form-control onlyNumbers" id="qty_piece<?php echo $i?>" name="qty_piece<?php echo $i?>"></td><td>&nbsp;&nbsp;</td>
                <td><input type="text" class="form-control" onkeypress="return isDecimalNumber(event,this);" id="qty_sft<?php echo $i?>" name="qty_sft<?php echo $i?>" onblur="finalCost()"></td><td>&nbsp;&nbsp;</td>
                <td><input type="text" class="form-control" onkeypress="return isDecimalNumber(event,this);" id="cost<?php echo $i?>" name="cost<?php echo $i?>" onblur="finalCost()"></td><td>&nbsp;&nbsp;</td>
                <td><input type="text" class="form-control" id="fcost<?php echo $i?>" name="fcost<?php echo $i?>" readonly="readonly"></td><td>&nbsp;&nbsp;</td>
                <td><input type="text" class="form-control" value="" id="lcost<?php echo $i?>" name="lcost<?php echo $i?>" readonly="readonly"></td><td>&nbsp;&nbsp;</td>
                <td><input type='button' value='+' onclick="subshowonlyonev1('subnewboxes<?php echo $i+1?>');subshowonlyonev2('subnewboxes_r<?php echo $i+1?>')"> </td>
                </tr>
                <tr id="subnewboxes_r<?php echo $i?>" name="subnewboxes_r<?php echo $i?>" <?php echo $state?>><td>&nbsp;</td></tr>
                <?php }?>
                </table>
                  <input type='hidden' name='count' id='count' value="<?php echo $i?>">
                  
                  <!-- /.box-body -->
 
              </div><!-- /.box -->
        
            </div><!--/.col (left) -->
            <!-- right column -->
            
          </div>   <!-- /.row -->
          <div class="col-md-3">
             

              <div class="box" style="overflow: auto;">
                
                <div class="box-body">
           
                <br/>
                
                  <input type='hidden' name='count' id='count' value="<?php echo $i?>">
                  <table>
	             <tr><td>Total&nbsp;Amount*</td><td id='grand_total_v'><input type="text" value="<?php echo $bill_amount?>" onkeypress="return isDecimalNumber(event,this);" class="form-control" onfocus="finalCost()" id="grand_total" name="grand_total" readonly="readonly"/></td></tr>
	             <tr><td>&nbsp;</td></tr>
	             <tr><td>Invoice&nbsp;Amount*</td><td id='grand_total_v'><input type="text" onkeypress="return isDecimalNumber(event,this);" class="form-control" onblur="finalCost()" id="invoice_amt" name="invoice_amt" value='<?php echo $invoice_amt?>'/></td></tr>
	             <tr><td>&nbsp;</td></tr>
	             <tr><td>Tax<input type='text' name='tax_rate' id='tax_rate' value="<?php echo $tax_rate?>" size='2' onblur="finalCost()"></td><td id='tax_v'><input type="text" onkeypress="return isDecimalNumber(event,this);" class="form-control" onfocus="finalCost()" id="tax" name="tax" value="<?php echo $tax_amount?>"></td></tr>
	            
	             <tr><td><input type='hidden' name='tax_disc' id='tax_disc' value="0" size='1' onblur="finalCost()"></td><td id=''><input type="hidden" onkeypress="return isDecimalNumber(event,this);" class="form-control" onfocus="finalCost()" id="tax_disc_amt" value="0" name="tax_disc_amt"/></td></tr>
	            
	             <tr><td><input type='hidden' name='tax_rate' id='tax_rate' value="<?php echo $tax_rate?>" size='2' onblur="finalCost()"></td><td id='tax_v'><input type="hidden" onkeypress="return isDecimalNumber(event,this);" class="form-control" onfocus="finalCost()" value="<?php echo $tax_amount?>" id="tax" name="tax"/></td></tr>
	             
	             <tr><td><input type='hidden' name='tax_disc' id='tax_disc' value="<?php echo $tax_discount_rate?>" size='1' onblur="finalCost()"></td><td id=''><input type="hidden" onkeypress="return isDecimalNumber(event,this);" class="form-control" onfocus="finalCost()" value="<?php echo $tax_discount?>" id="tax_disc_amt" name="tax_disc_amt"/></td></tr>
	            
	               <tr><td>&nbsp;</td></tr>
	         <tr><td>Other&nbsp;Expenses* </td><td id='other_expenses_v'><input type="text" value="<?php echo $other_expenses?>" onkeypress="return isDecimalNumber(event,this);" class="form-control" onblur="finalCost()" id="other_expenses" value='0' name="other_expenses"/></td></tr>
	             <tr><td>&nbsp;</td></tr>  
	        
	             <tr><td>Total&nbsp;Amount*</td><td id=''><input type="text" onkeypress="return isDecimalNumber(event,this);" class="form-control" onfocus="finalCost()" id="total_amt" name="total_amt" value="<?php echo $bill_tax_amount?>"/></td></tr>
	             <tr><td>&nbsp;</td></tr>
	             <tr><td>Vat<input type='text' name='vat_rate' id='vat_rate' value="<?php echo $vat_rate?>" size='3' onblur="finalCost()"></td><td id='tax_v'><input type="text" onkeypress="return isDecimalNumber(event,this);" class="form-control" onfocus="finalCost()" id="vat" name="vat" value="<?php echo $vat?>"></td></tr>
	            
	             <tr><td>&nbsp;</td></tr>
	              <tr><td>Transporter*</td><td id=''><select class="form-control" onfocus="finalCost()" id="transporter_id" name="transporter_id">
	              <?php 
	              if($transporter_id!=0){
					
	              $data = mysql_query("SELECT sk_member_id, member_name from mst_member where member_status='active' and member_type='4' and sk_member_id='$transporter_id'");
	              while($info = mysql_fetch_array( $data ))
	              {
	              	$name=$info["member_name"];
	              }
	              ?>
	              <option value="<?php echo $transporter_id?>"><?php echo $name?></option>
	              <?php }?>
	              <option value="0">Cash</option>
	              <?php 
	              $data = mysql_query("SELECT sk_member_id, member_name from mst_member where member_status='active' and member_type='4'");
	              while($info = mysql_fetch_array( $data ))
	              {
	              ?>
	              <option value="<?php echo $info["sk_member_id"]?>"><?php echo $info["member_name"]?></option>
	              <?php }?>
	              </select></td></tr>
	             <tr><td>&nbsp;</td></tr>
	             <tr><td>Transport&nbsp;Amount*</td><td id='transport_v'><input type="text" value="<?php echo $transport_amount?>" onkeypress="return isDecimalNumber(event,this);" class="form-control"  onblur="finalCost()" id="transport" name="transport"/></td></tr>
	             <tr><td>&nbsp;</td></tr>
	             <tr><td>Hamali*</td><td id=''><select class="form-control" onfocus="finalCost()" id="hamali_id" name="hamali_id">
	             
	              <?php 
	              $data = mysql_query("SELECT sk_member_id, member_name from mst_member where member_status='active' and member_type='9' order by member_name asc");
	              while($info = mysql_fetch_array( $data ))
	              {
	              ?>
	              <option value="<?php echo $info["sk_member_id"]?>"><?php echo $info["member_name"]?></option>
	              <?php }?>
	              </select></td></tr>
	               <tr><td>&nbsp;</td></tr>
	             <tr><td>Hamali&nbsp;Amount*</td><td id='hamali_v'><input type="text" onkeypress="return isDecimalNumber(event,this);" class="form-control"  onblur="finalCost()" id="hamali" name="hamali" value="<?php echo $hamali?>"/></td></tr>
	            <tr><td>&nbsp;</td></tr>
	          <tr><td>Purchase&nbsp;Expeses*</td><td id='hamali_v'><input type="text" onkeypress="return isDecimalNumber(event,this);" class="form-control"  onblur="finalCost()" id="purchase_exp" name="purchase_exp" value='<?php echo $purchase_exp?>'/></td></tr>
	        
	             <tr><td>&nbsp;</td></tr>
	             
	             <tr><td>Total Value*</td><td id='total_v'><input type="text" value="<?php echo $grand_total?>" onkeypress="return isDecimalNumber(event,this);" class="form-control" onfocus="finalCost()" id="total" name="total_val" readonly="readonly"/>
	               <tr><td>&nbsp;</td></tr>	             
	              <tr><td>Note*</td><td><input type="text" class="form-control" id="note" name="note" value='<?php echo $note?>'/></td></tr>
	               <tr><td>&nbsp;</td></tr>
	             
	           

	             </table>
                  <!-- /.box-body -->

                       <div class="form-group">                  
					<input type="submit" class="btn btn-block btn-warning" value="Update Bill" onclick="finalCost()">
				  </div>
                  
              </div><!-- /.box -->
        
            </div><!--/.col (left) -->
            <!-- right column -->
            
          </div> 
          
          
          
          
          
          <div class="col-md-3" style="display: none">
             

              <div class="box" style="overflow: auto;">
                
                <div class="box-body">
           
                <br/>
                
                  <input type='hidden' name='count' id='count' value="<?php echo $i?>">
                  <table>
                   <tr><td>Cash&nbsp;Amount*</td><td id='cash_amount_v'><input type="text" value="<?php echo $cash_amount?>" onkeypress="return isDecimalNumber(event,this);" onblur="cashe()" class="form-control" onfocus="finalCost()" id="cash_amount" name="cash_amount"/></td></tr>
	             <tr><td>&nbsp;</td></tr>
	             <tr><td>Check&nbsp;Amount*</td><td id='check_amount_v'><input type="text" value="<?php echo $check_amount?>" onkeypress="return isDecimalNumber(event,this);" class="form-control"  onblur="unHide();Paid()" id="check_amount" name="check_amount"/></td></tr>
	             <tr><td>&nbsp;</td></tr>
	             
                    <tr><td>Paid&nbsp;Amount*</td><td id='paid_amt_v'><input type="text" value="<?php echo $paid_amount?>" onkeypress="return isDecimalNumber(event,this);" readonly="readonly" class="form-control" onfocus="Paid()" id="paid_amt" name="paid_amt"/></td></tr>
	                <tr><td>&nbsp;</td></tr>
	                 <tr><td>Discount*</td><td id='discount_v'><input type="text" value="<?php echo $discount?>" onkeypress="return isDecimalNumber(event,this);" class="form-control" onblur="Balance()" id="discount" name="discount"/></td></tr>
	             <tr><td>&nbsp;</td></tr>
	             <tr><td>Balance&nbsp;Amount*</td><td id='balance_v'><input type="text" value="<?php echo $balance_amount?>" onkeypress="return isDecimalNumber(event,this);" class="form-control" readonly="readonly" id="balance" name="balance"/></td></tr>
	             
	            <tr><td>&nbsp;</td></tr>
	            
	              
	              
	               <tr id='span1' style="visibility: hidden;"><td>Bank*</td><td id='bank_v'><select class="form-control" id="bank" name="bank">
	               <option value=""></option>
	                <?php 
                                   
                                  $data = mysql_query("SELECT bank_id,bank_name FROM banks  where branch='$session_branch' order by bank_name asc");
                                  if($data)
                                  while($info = mysql_fetch_array( $data ))
                                  {
                                  ?>  
	               <option  value="<?php echo $info["bank_id"]?>"><?php echo $info["bank_name"]?></option>
	               <?php }?>
	               </select>
	               <tr><td>&nbsp;</td></tr>
	              
	             <tr id='span2' style="visibility: hidden;"><td>Check No*</td><td><input type="text" class="form-control" id="check_no" name="check_no"/></td></tr> 
	            <tr><td>&nbsp;</td></tr>

	             </table>
                  <!-- /.box-body -->

                                 
                  
              </div><!-- /.box -->
        
            </div><!--/.col (left) -->
            <!-- right column -->
            
          </div> 
          
          
          
          </div>
          
          
                  </form>
        </section><!-- /.content -->
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
<script type="text/javascript">

function calCost(count)
{
	for(var i=1;i<=count;i++)
	{
		var qty=document.getElementById("qty_sft"+i).value;
		var cost=document.getElementById("cost"+i).value;
		if(qty>0 && cost>0)
		document.getElementById("fcost"+i).value=qty*cost;
	}

	var tcount=document.getElementById("count").value;
	var total=0;
	for(var i=1;i<tcount;i++)
	{
	if(document.getElementById("fcost"+i).value!="")
	{
	total=total+parseInt(document.getElementById("fcost"+i).value);
	}
}

document.getElementById("grand_total").value=total;
finalCost()
}

function finalCost()
{
	var tcount=document.getElementById("count").value;
	var total=0;
	for(var i=1;i<tcount;i++)
	{
		var qty=document.getElementById("qty_sft"+i).value;
		var cost=document.getElementById("cost"+i).value;
		if(qty!="" && cost!=""){
		document.getElementById("fcost"+i).value=qty*cost;
		total=total+parseInt(document.getElementById("fcost"+i).value);
		}
	}
	document.getElementById("grand_total").value=total;
var grand_total=document.getElementById("grand_total").value;if(grand_total==''){grand_total=0;}
var other_expenses=document.getElementById("other_expenses").value;if(other_expenses==''){other_expenses=0;}
var tax_rate=document.getElementById("tax_rate").value;
var invoice_amt=document.getElementById("invoice_amt").value;
if(invoice_amt==""){invoice_amt=0;}
document.getElementById("tax").value=(invoice_amt*tax_rate/100).toFixed(0);
var tax=document.getElementById("tax").value;if(tax==''){tax=0;}

var tax_disc=document.getElementById("tax_disc").value
if(tax_disc==0){
document.getElementById("tax_disc_amt").value=0;
}else{
	document.getElementById("tax_disc_amt").value=(parseFloat(tax*tax_disc)/100).toFixed(0);
}
var tax_disc_amount=document.getElementById("tax_disc_amt").value
document.getElementById("total_amt").value=(parseFloat(other_expenses)+parseFloat(grand_total)+parseFloat(tax)).toFixed(0);

grand_total=document.getElementById("total_amt").value;
document.getElementById("balance").value=grand_total;

//*******************
var vat_rate=document.getElementById("vat_rate").value
 var invoice_amt=document.getElementById("invoice_amt").value
	             var tax_amt=document.getElementById("tax").value
	             var taxable_amt=parseFloat(invoice_amt)+parseFloat(tax_amt);

	             if(tax_rate<5){
	             var vat_amt=taxable_amt+((taxable_amt*10)/100);
	             document.getElementById("vat").value=((vat_amt*vat_rate)/100).toFixed(2)
	             }else{
		             var vat_amt=((taxable_amt*10)/100);
		             document.getElementById("vat").value=((vat_amt*vat_rate)/100).toFixed(2);
	             }
	             var vat_amount=document.getElementById("vat").value;

var total_sft=0;
var count=document.getElementById("count").value;
for(var i=1;i<count;i++)
{
	var category=$("#category"+i).val();
	var item=$("#item"+i).val();
	var qty_piece=$("#qty_piece"+i).val();
	var qty_sft=$("#qty_sft"+i).val();
	var cost=$("#cost"+i).val();
	var fcost=$("#fcost"+i).val();
	if(item!="" && qty_piece!="" && qty_sft!="" && cost!="" && fcost!="")
	{
		var total_sft=total_sft+parseFloat(qty_sft);
	}
}

document.getElementById("total_sft").value=total_sft;
var transport=document.getElementById("transport").value;if(transport==''){transport=0;document.getElementById("transport").value=0;}
var hamali=document.getElementById("hamali").value;if(hamali==''){hamali=0;document.getElementById("hamali").value=0;}
var purchase_exp=document.getElementById("purchase_exp").value;if(hamali==''){hamali=0;document.getElementById("purchase_exp").value=0;}
document.getElementById("total").value=parseFloat(grand_total)+parseFloat(transport)+parseFloat(hamali)+parseFloat(vat_amount)+parseFloat(purchase_exp);
var total_qty=0;
for(var i=1;i<tcount;i++)
{
	if(document.getElementById("qty_sft"+i).value!="")
	{
		total_qty=total_qty+parseInt(document.getElementById("qty_sft"+i).value);
	}
}

var total_val=document.getElementById("total").value;//(parseFloat(transport)+parseFloat(hamali)+parseFloat(other_expenses)).toFixed(0);
var total_exp=parseFloat(document.getElementById("tax").value)+parseFloat(document.getElementById("other_expenses").value)+parseFloat(document.getElementById("vat").value)+parseFloat(document.getElementById("transport").value)+parseFloat(document.getElementById("hamali").value)+parseFloat(document.getElementById("purchase_exp").value)

var agent_per=document.getElementById("agent_per").value;
if(agent_per==''){agent_per=0;document.getElementById("agent_per").value=0;}
var agent_amt=0;
if(agent_per>=1 && agent_per<=15){
agent_amt=(grand_total/100)*parseFloat(agent_per)
}else if(agent_per>15){
	agent_amt=parseFloat(agent_per);
}

var cost_unit=parseFloat(total_exp+agent_amt)/total_qty;

for(var i=1;i<tcount;i++)
{
	if(document.getElementById("fcost"+i).value!="")
	{
		//parseFloat(document.getElementById("cost"+i).value)+
		document.getElementById("lcost"+i).value=((parseFloat($("#cost"+i).val())+cost_unit)).toFixed(2);
	}
}

var paid_amt=document.getElementById("paid_amt").value
if(paid_amt==""){paid_amt=0;}



//document.getElementById("balance").value=(parseFloat(grand_total)+parseFloat(other_expenses)+parseFloat(tax)+parseFloat(transport))-paid_amt;

}
function cashe()
{
	
	var cashe_amt=document.getElementById("cash_amount").value;
	document.getElementById("check_amount").value=(document.getElementById("total").value-document.getElementById("cash_amount").value).toFixed(0);
	unHide()
}

function Paid()
{
	var paid=0;
	
	if(document.getElementById("cash_amount").value=='' && document.getElementById("check_amount").value=='')
	{
		paid=0;
	}
	else
	{
		paid=parseFloat(document.getElementById("cash_amount").value)+parseFloat(document.getElementById("check_amount").value)
		document.getElementById("paid_amt").value=paid.toFixed();
	}
	document.getElementById("discount").value=parseFloat(document.getElementById("total").value-paid).toFixed(2);
	
}

function Balance()
{
	 document.getElementById("balance").value=parseFloat(document.getElementById("total").value)-(parseFloat(document.getElementById("paid_amt").value)+parseFloat(document.getElementById("discount").value));
}

function unHide()
	{
		var amt=document.getElementById("check_amount").value
		if(amt>1)
		{
		document.getElementById("span1").style.display='block';
		document.getElementById("span2").style.display='block';
		}
		else
		{
			document.getElementById("span1").style.display='none';
			document.getElementById("span2").style.display='none';
		}
	}
	
function checkCustomer(val)
{
	var bill_type= document.getElementById("bill_type").value
	var bill_type1= document.getElementById("bill_type1").value
	
	if(bill_type=="Credit" && bill_type1=='Existing')
	{
		document.getElementById("customer_id").style.display="block";
		document.getElementById("customer_name").style.display="none";
		$("#customer_id").val("");
	} 
	else
	{
		document.getElementById("customer_id").style.display="none";
		document.getElementById("customer_name").style.display="block";
		$("#customer_name").val("");
	} 
	
}
function checkAgent(val)
{
	if(val=="New")
	{
		document.getElementById("new").style.display="block";
		document.getElementById("existing").style.display="none";
		$("#agent_id").val("");
	} 
	else
	{
		document.getElementById("new").style.display="none";
		document.getElementById("existing").style.display="block";
		$("#agent_name").val("");
	} 
	
}
</script>

 <script type="text/javascript">
		function validate()
		{			           
		
			var state="1";
			if($("#bill_no").val()==""){$("#bill_no_v").addClass('has-error');state="2";}
			if($("#bill_date").val()==""){$("#bill_date_v").addClass('has-error');state="2";}
			if($("#bill_type").val()==""){$("#bill_type_v").addClass('has-error');state="2";}
		//	if($("#payment_status").val()==""){$("#payment_status_v").addClass('has-error');state="2";}
			//if($("#partner").val()==""){$("#partner_v").addClass('has-error');state="2";}
			
			if($("#mobile").val()==""){$("#mobile_v").addClass('has-error');state="2";}
			if($("#place").val()==""){$("#place_v").addClass('has-error');state="2";}
			if($("#consider").val()==""){$("#consider_v").addClass('has-error');state="2";}

			if($("#bill_type").val()=="Cash"){
			if($("#customer_name").val()==""){$("#customer_name_v").addClass('has-error');state="2";}
			}else{
				if($("#bill_type1").val()=="Existing"){
					if($("#customer_id").val()==""){$("#customer_name_v").addClass('has-error');state="2";}
				}
				else
				{
					if($("#customer_name").val()==""){$("#customer_name_v").addClass('has-error');state="2";}
				}
				
				
			}

			if($("#grand_total").val()==""){$("#grand_total_v").addClass('has-error');state="2";}
			if($("#tax").val()==""){$("#tax_v").addClass('has-error');state="2";}
			if($("#transport").val()==""){$("#transport_v").addClass('has-error');state="2";}
			
			if($("#other_expenses").val()==""){$("#other_expenses_v").addClass('has-error');state="2";}
			if($("#total").val()==""){$("#total_v").addClass('has-error');state="2";}
			if($("#cash_amount").val()==""){$("#cash_amount_v").addClass('has-error');state="2";}
			if($("#check_amount").val()==""){$("#check_amount_v").addClass('has-error');state="2";}
			if($("#paid_amt").val()==""){$("#paid_amt_v").addClass('has-error');state="2";}
			if($("#discount").val()==""){$("#discount_v").addClass('has-error');state="2";}
			if($("#balance").val()==""){$("#balance_v").addClass('has-error');state="2";}

			if($("#check_amount").val()>0){
			if($("#bank").val()==""){$("#bank_v").addClass('has-error');state="2";}
			}	

			
			var data="";
			var count=document.getElementById("count").value;
			for(var i=1;i<count;i++)
			{
				var category=$("#category"+i).val();
				var item=$("#item"+i).val();
				var qty_piece=$("#qty_piece"+i).val();
				var qty_sft=$("#qty_sft"+i).val();
				var cost=$("#cost"+i).val();
				var fcost=$("#fcost"+i).val();
				var lcost=$("#lcost"+i).val();

				if(item!="" && qty_piece!="" && qty_sft!="" && cost!="" && fcost!="")
				{
					data=data+"//"+item+"#"+qty_piece+"#"+qty_sft+"#"+cost+"#"+fcost+"#"+lcost;
				}
			
				
			}

			document.getElementById("data").value=data
			
			if(data=="")
			{
				alert("No Data To Submit");
				state="2";
			}
			
			if(state==2){return false;}
			var result = confirm("Are Your Sure, Want to Update Bill?");
			if (result) {
				return true;
			}else{return false;}
			
		
		
		}
		
        </script>
    
<?php include_once "$D_PATH/include/scripts_bottom.php";?> 
</body>
</html>
