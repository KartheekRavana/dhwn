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

         <!-- Main content -->
        <section class="content">
        
        <form role="form" onsubmit="return validate()" action="?action=operations/in_return&c=inventory" method="POST">
          <input type='hidden' value='0' name='advance_amount'>
          <input type='hidden' id='data' name='data'>
          <input type='hidden' id='bill_for' name='bill_for' value="Supplier">
           <input type='hidden' name="session_branch" id="session_branch" value="<?php echo $session_branch?>">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary" style="overflow: auto;">
               
                <!-- form start -->
                <br/>
                <input type='hidden'  id="payment_status" name="payment_status" value="Done"><span id='payment_status_v'></span>
                <input type='hidden'  id="partner" name="partner" value="<?php echo $session_id?>"><span id='partner_v'></span>
                <?php $slip_no="";
                if(isset($_GET["m"])){
				$slip_no=$_GET["m"];
				}
                ?>
                <table>
                <tr>
                	<td>Slip No</td><td id='bill_no_v'><input type="text" class="form-control" value='' onfocus="finalCost()" id="slip_no" name="slip_no" value="<?php echo $slip_no?>" style="width: 150px;float: left"/></td><td>&nbsp;&nbsp;</td>
                	<td>Bill&nbsp;Date</td><td id='bill_date_v'><input type="date" class="form-control" id="bill_date" name="bill_date" value="<?php echo $date?>"></td><td>&nbsp;&nbsp;</td>
                	<td>Bill&nbsp;Type</td><td id='bill_type_v'><select style="width: 80px;float: left" class="form-control" id="bill_type" name="bill_type" onchange="checkCustomer(this.value)"><option value="Cash">Cash</option><option value="Credit">Credit</option></select>
                	<select style="width: 80px;float: left" class="form-control" id="bill_type1" name="bill_type1" onchange="checkCustomer(this.value)"><option value="Existing">Existing</option><option value="New">New</option></select>
                	</td><td>&nbsp;&nbsp;</td>
                	<td>Agent</td><td id='agent_name_v'>
                	<select style="width: 80px;" class="form-control pull-left" id="agent_type" name="agent_type" onchange="checkAgent(this.value)"><option value="Existing">Existing</option><option value="New">New</option></select>
                	<span id="existing" style="float: left">
                	<select  name="agent_id" id="agent_id" class="form-control selectpicker pull-left" data-live-search="true" data-live-search-style="begins" title="Please select a Agent ..." style="width: 150px"  onchange="getAgent(this.value)">
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
                	<input type="number" class="form-control pull-left" id="agent_per" name="agent_per" placeholder="%" style="width: 80px">
                	</td>
                </tr>
                <tr><td>&nbsp;</td></tr>
                 <tr>
                 <?php $mobile="";
                 if(isset($_GET["m"]))
                 {
                 	$mobile=$_GET["mobile"];
                 }
                 ?>
                	<td>Supplier</td><td id='customer_name_v'>
                	<span id="customer_type">
                	<input type="text" class="form-control" id="customer_name" name="customer_name" style="width: 150px">
                	</span>
                	<span style="display : none;" id="customer_type1">
                	<select  name="customer_id" id="customer_id" onchange="getCustomer(this.value)" class="form-control selectpicker" data-live-search="true" data-live-search-style="begins" title="Please select a customer ..." style="width: 150px">
                	<option value=""></option>
                	 <?php 
                                   
                                  $data = mysql_query("SELECT sk_member_id,member_name FROM mst_member where member_status='active' and branch_id='$session_branch' and member_type='3' order by member_name asc");
                                  while($info = mysql_fetch_array( $data ))
                                  {
                                  ?>  
	               <option  value="<?php echo $info["sk_member_id"]?>"><?php echo $info["member_name"]?></option>
	               <?php }?>
                	</select>
                	</span>
                	</td><td>&nbsp;&nbsp;</td>
                	<td>Mobile</td><td id='mobile_v'><input type="text" value="<?php echo $mobile?>" maxlength="10" class="form-control onlyNumbers" id="mobile" name="mobile"></td><td>&nbsp;&nbsp;</td>
                	<td>Place</td><td id='place_v'><input type="text" class="form-control" id="place" name="place" style="width: 160px"></td><td>&nbsp;&nbsp;</td>
                
                	<td></td><td id='consider_v'><input type="hidden" value="No" class="form-control" id="consider" name="consider"></td><td>&nbsp;&nbsp;</td>
                	
                </tr>
                </table>
                <br/>
                </div>
                </div>
                
                
                 <div class="col-md-6">
             

              <div class="box" style="overflow: auto;max-height: 400px">
                
                <div class="box-body">
           
                <br/>
                <table style="width: 96%;margin-left: 2%">
                <tr><th></th><td>&nbsp;&nbsp;</td><th>Category&nbsp;<a href="" class='click'>+</a></th><td>&nbsp;&nbsp;</td><th>Items&nbsp;&nbsp;&nbsp;<a href="" class='click'>+</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th><td>&nbsp;&nbsp;</td><th>Qty/Piece</th><td>&nbsp;&nbsp;</td><th>Qty&nbsp;In&nbsp;Sft</th><td>&nbsp;&nbsp;</td><th>Cost&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th><td>&nbsp;&nbsp;</td><th>Final&nbsp;Cost&nbsp;&nbsp;&nbsp;&nbsp;</th></tr>
                <?php $k=1;
                if(isset($_GET["m"]))
                {$item_id="";
	                $data = mysql_query("SELECT distinct(item_id) FROM txn_measurement where tran_id='".$_GET["m"]."'");
	                while($info = mysql_fetch_array( $data ))
					{
						$item_id=$info[0];
		                $data1 = mysql_query("SELECT sk_particular_id, particular_name,category_id FROM mst_particular where sk_particular_id='".$item_id."'");
		                while($info1 = mysql_fetch_array( $data1 ))
						{
		                		$item_name=$info1["particular_name"];
		                		$category=$info1["category"];
		                }
	                	$category_name="";
	                	$data1 = mysql_query("SELECT particular_name FROM mst_particular where category_id='".$category."'");
	                	while($info1 = mysql_fetch_array( $data1 ))
	                	{
	                		$category_name=$info1["particular_name"];
	                	}
	                	
	                	$data1 = mysql_query("SELECT count(tran_id) as count,sum(total_sft) as sum FROM txn_measurement where tran_id='".$_GET["m"]."' and item_id='".$item_id."'");
	                	while($info1 = mysql_fetch_array( $data1 ))
	                	{
	                		$pcs=$info1["count"];
	                		$sft=$info1["sum"];
	                	}
	                ?>
	                <tr>
	                <td><?php echo $k?><input type='hidden' name="m_id" value="<?php echo $_GET["m"]?>"></td><td>&nbsp;&nbsp;</td>
	                <td><select class="form-control select2" id="category<?php echo $k?>" name="category<?php echo $k?>" onchange="loadItems(<?php echo $k?>,this.value)"><option value="<?php echo $category?>"><?php echo $category_name?></option><?php $data1 = mysql_query("SELECT sk_particular_id, particular_name,category_id FROM mst_particular where particular_status='active' and category_id=0 and branch_id='".$session_branch."'");while($info1 = mysql_fetch_array( $data1 )){?><option  value="<?php echo $info1["sk_particular_id"]?>"><?php echo $info1["particular_name"]?></option><?php }?></select></td><td>&nbsp;&nbsp;</td>
	                <td><select class="form-control select2" id="item<?php echo $k?>" name="item<?php echo $k?>"><option value="<?php echo $item_name?>"><?php echo $item_name?></option></select></td><td>&nbsp;&nbsp;</td>
	                <td><input type="text" style="padding: 0" class="form-control onlyNumbers" value="<?php echo $pcs?>" id="qty_piece<?php echo $k?>" name="qty_piece<?php echo $k?>" size="5"></td><td>&nbsp;&nbsp;</td>
	                <td><input type="text" style="padding: 0" class="form-control" value="<?php echo $sft?>" onkeypress="return isDecimalNumber(event,this);" id="qty_sft<?php echo $k?>" name="qty_sft<?php echo $k?>" size="5" onblur="checkQty(<?php echo $k?>)"></td><td>&nbsp;&nbsp;</td>
	                <td><input type="text" style="padding: 0" class="form-control" onkeypress="return isDecimalNumber(event,this);" id="cost<?php echo $k?>" name="cost<?php echo $k?>" size="5" onblur="calCost(<?php echo $k?>)"></td><td>&nbsp;&nbsp;</td>
	                <td><input type="text" style="padding: 0;" class="form-control" id="fcost<?php echo $k?>" name="fcost<?php echo $k?>" readonly="readonly"></td><td>&nbsp;&nbsp;</td>
	                <td><input type='button' value='+' onclick="subshowonlyonev1('subnewboxes<?php echo $k+1?>');subshowonlyonev2('subnewboxes_r<?php echo $k+1?>')"> </td>
	                </tr>
	                <tr><td>&nbsp;</td></tr>
	                <?php 
	              $k++;}}?>
                 <?php 
                for($i=$k;$i<=50;$i++)
                {
                	$state='';
                	if($i>1)
					{
                		$state="style='visibility:hidden;position:absolute'";
                	}
                ?>
                <tr id="subnewboxes<?php echo $i?>" name="subnewboxes<?php echo $i?>" <?php echo $state?>>
                <td><?php echo $i?></td><td>&nbsp;&nbsp;</td>
                <td><select class="form-control select2" id="category<?php echo $i?>" name="category<?php echo $i?>" onchange="loadItems(<?php echo $i?>,this.value)"><option value=""></option><?php $data1 = mysql_query("SELECT sk_particular_id, particular_name,category_id FROM mst_particular where particular_status='active' and category_id=0 and branch_id='".$session_branch."'");while($info1 = mysql_fetch_array( $data1 )){?><option  value="<?php echo $info1["sk_particular_id"]?>"><?php echo $info1["particular_name"]?></option><?php }?></select></td><td>&nbsp;&nbsp;</td>
                <td><select class="form-control select2" style="width:155px" id="item<?php echo $i?>" name="item<?php echo $i?>"><option value=""></option></select></td><td>&nbsp;&nbsp;</td>
                <td><input type="text" class="form-control onlyNumbers" id="qty_piece<?php echo $i?>" name="qty_piece<?php echo $i?>"></td><td>&nbsp;&nbsp;</td>
                <td><input type="text" class="form-control" onkeypress="return isDecimalNumber(event,this);" id="qty_sft<?php echo $i?>" name="qty_sft<?php echo $i?>" onblur="checkQty(<?php echo $i?>)"></td><td>&nbsp;&nbsp;</td>
                <td><input type="text" class="form-control"  onkeypress="return isDecimalNumber(event,this);" id="cost<?php echo $i?>" name="cost<?php echo $i?>" onblur="calCost(<?php echo $i?>)"></td><td>&nbsp;&nbsp;</td>
                <td><input type="text" class="form-control" id="fcost<?php echo $i?>" name="fcost<?php echo $i?>" readonly="readonly"></td><td>&nbsp;&nbsp;</td>
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
             

              <div class="box">
                
                <div class="box-body">
           
                <br/>
                
                  <input type='hidden' name='count' id='count' value="<?php echo $i?>">
                  <table>
	             <tr><td>Bill&nbsp;Amount*</td><td id='grand_total_v'><input type="text" onkeypress="return isDecimalNumber(event,this);" class="form-control" onfocus="finalCost()" id="grand_total" name="grand_total" readonly="readonly"/></td></tr>
	             <tr><td>&nbsp;</td></tr>
	             <tr><td>Tax&nbsp;Amount*<input type='text' name='tax_rate' id='tax_rate' value="14.5" size='1' onblur="finalCost()">%</td><td id='tax_v'><input type="text" onkeypress="return isDecimalNumber(event,this);" class="form-control" onfocus="finalCost()" id="tax" name="tax"/></td></tr>
	             <tr><td>&nbsp;</td></tr>
	             <tr><td>T&nbsp;Disc*<input type='text' name='tax_disc' id='tax_disc' value="0" size='1' onblur="finalCost()">%</td><td id=''><input type="text" onkeypress="return isDecimalNumber(event,this);" class="form-control" onfocus="finalCost()" id="tax_disc_amt" name="tax_disc_amt"/></td></tr>
	            
	             <tr><td>&nbsp;</td></tr>
	             <tr><td>Total&nbsp;Amount*</td><td id=''><input type="text" onkeypress="return isDecimalNumber(event,this);" class="form-control" onfocus="finalCost()" id="total_amt" name="total_amt"/></td></tr>
	              <tr><td>&nbsp;</td></tr>
	              <tr><td>Transporter*</td><td id=''><select class="form-control" onfocus="finalCost()" id="transporter_id" name="transporter_id">
	              <option value="0">Cash</option>
	              <?php 
	              $data = mysql_query("SELECT sk_member_id, member_name from mst_member where member_status='active' and member_type='4' order by member_name asc and member_type='4'");
	              while($info = mysql_fetch_array( $data ))
	              {
	              ?>
	              <option value="<?php echo $info["sk_member_id"]?>"><?php echo $info["member_name"]?></option>
	              <?php }?>
	              </select></td></tr>
	             <tr><td>&nbsp;</td></tr>
	             <tr><td>Transport&nbsp;Amount*</td><td id='transport_v'><input type="text" onkeypress="return isDecimalNumber(event,this);" class="form-control"  onblur="finalCost()" id="transport" name="transport"/></td></tr>
	             <tr><td>&nbsp;</td></tr>
	         <tr><td>Other&nbsp;Expenses* </td><td id='other_expenses_v'><input type="text" onkeypress="return isDecimalNumber(event,this);" class="form-control" onblur="finalCost()" id="other_expenses" value='0' name="other_expenses"/></td></tr>
	         <tr><td>&nbsp;</td></tr>
	               <tr><td>Total Value*</td><td id='total_v'><input type="text" onkeypress="return isDecimalNumber(event,this);" class="form-control" onfocus="finalCost()" id="total" name="total" readonly="readonly"/>
	               <tr><td>&nbsp;</td></tr>
	             
	             
	            <tr><td>&nbsp;</td></tr>

	             </table>
                  <!-- /.box-body -->

                       
                  
              </div><!-- /.box -->
        
            </div><!--/.col (left) -->
            <!-- right column -->
            
          </div> 
          
          
          
          
          
          <div class="col-md-3">
             

              <div class="box">
                
                <div class="box-body">
           
                <br/>
                
                  <input type='hidden' name='count' id='count' value="<?php echo $i?>">
                  <table>
                   <tr><td>Cash&nbsp;Amount*</td><td id='cash_amount_v'><input type="text" onkeypress="return isDecimalNumber(event,this);" onblur="cashe()" class="form-control" onfocus="finalCost()" id="cash_amount" name="cash_amount"/></td></tr>
	             <tr><td>&nbsp;</td></tr>
	             <tr><td>Check&nbsp;Amount*</td><td id='check_amount_v'><input type="text" onkeypress="return isDecimalNumber(event,this);" class="form-control"  onblur="unHide();Paid()" id="check_amount" name="check_amount"/></td></tr>
	             <tr><td>&nbsp;</td></tr>
	             
                    <tr><td>Paid&nbsp;Amount*</td><td id='paid_amt_v'><input type="text" onkeypress="return isDecimalNumber(event,this);" readonly="readonly" class="form-control" onfocus="Paid()" id="paid_amt" name="paid_amt"/></td></tr>
	                <tr><td>&nbsp;</td></tr>
	                 <tr><td>Discount*</td><td id='discount_v'><input type="text" onkeypress="return isDecimalNumber(event,this);" class="form-control" onblur="Balance()" id="discount" name="discount"/></td></tr>
	             <tr><td>&nbsp;</td></tr>
	             <tr><td>Balance&nbsp;Amount*</td><td id='balance_v'><input type="text" class="form-control" readonly="readonly" id="balance" name="balance"/></td></tr>
	             <tr><td>&nbsp;</td></tr>	             
	            
	            
	              
	              
	               <tr id='span1' style="display: none;"><td>Bank*</td><td id='bank_v'><select class="form-control" id="bank" name="bank">
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
	               <tr id='span3' style="display: none;"><td>&nbsp;</td></tr>
	              
	             <tr id='span2' style="display: none;"><td>Check No*</td><td><input type="text" class="form-control" id="check_no" name="check_no"/></td></tr> 
	            <tr><td>&nbsp;</td></tr>
 <tr><td>Note*</td><td><input type="text" class="form-control" id="note" name="note"/></td></tr>
	             </table>
                  <!-- /.box-body -->

                    <div class="form-group">                  
					<input type="submit" class="btn btn-block btn-success" value="Generate Bill">
				  </div>             
                  
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
var qty=document.getElementById("qty_sft"+count).value;
var cost=document.getElementById("cost"+count).value;
document.getElementById("fcost"+count).value=qty*cost;

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
var grand_total=document.getElementById("grand_total").value;if(grand_total==''){grand_total=0;}
var other_expenses=document.getElementById("other_expenses").value;if(other_expenses==''){other_expenses=0;}
document.getElementById("tax").value=(grand_total*14.5/100).toFixed(0);
var tax=document.getElementById("tax").value;if(tax==''){tax=0;}

var tax_disc=document.getElementById("tax_disc").value
if(tax_disc==0){
document.getElementById("tax_disc_amt").value=0;
}else{
	document.getElementById("tax_disc_amt").value=(parseFloat(tax*tax_disc)/100).toFixed(0);
}
var tax_disc_amount=document.getElementById("tax_disc_amt").value
document.getElementById("total_amt").value=(parseFloat(tax-tax_disc_amount)+parseFloat(grand_total)).toFixed(0);

grand_total=document.getElementById("total_amt").value;

var transport=document.getElementById("transport").value;if(transport==''){transport=0;document.getElementById("transport").value=0;}
document.getElementById("total").value=parseFloat(grand_total)+parseFloat(other_expenses)+parseFloat(transport);
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
	document.getElementById("discount").value=parseFloat(document.getElementById("total").value-paid).toFixed(0);
	
}

function Balance()
{
	 document.getElementById("balance").value=parseFloat(document.getElementById("total").value)-(parseFloat(document.getElementById("paid_amt").value)+parseFloat(document.getElementById("discount").value)).toFixed(0);
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
		document.getElementById("customer_type1").style.display="block";
		document.getElementById("customer_type").style.display="none";
		
	} 
	else
	{
		document.getElementById("customer_type1").style.display="none";
		document.getElementById("customer_type").style.display="block";
	} 
	
}
function checkAgent(val)
{
	if(val=="New")
	{
		document.getElementById("new").style.display="block";
		document.getElementById("existing").style.display="none";
		
	} 
	else
	{
		document.getElementById("new").style.display="none";
		document.getElementById("existing").style.display="block";
	} 
	
}
</script>

 <script type="text/javascript">
		function validate()
		{			           
		
			var state="1";
			//if($("#bill_no").val()==""){$("#bill_no_v").addClass('has-error');state="2";}
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

				if(item!="" && qty_piece!="" && qty_sft!="" && cost!="" && fcost!="")
				{
					data=data+"//"+item+"#"+qty_piece+"#"+qty_sft+"#"+cost+"#"+fcost;
				}
			
				
			}

			document.getElementById("data").value=data
			
			if(data=="")
			{
				alert("No Data To Submit");
				state="2";
			}
			
			if(state==2){return false;}
			var result = confirm("Are Your Sure, Want to Create Bill?");
			if (result) {
				return true;
			}else{return false;}
			
		
		
		}
		
        </script>
    
<?php include_once "$D_PATH/include/scripts_bottom.php";?> 
</body>
</html>
      
