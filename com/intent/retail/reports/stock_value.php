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

            <link href="<?php echo $UI_ELEMENTS?>plugins/select2/select2.min.css" rel="stylesheet" type="text/css" />
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
   
    
    
       <script type="text/javascript">
function loadItems(row,val)
{
	loadItems1(row,val)
	var category=document.getElementById("category"+row).value;
	document.getElementById("subcategory"+row).options.length = 0;

	document.getElementById("subcategory"+row).options[0]=new Option("Loading.....","Loading...");

	var xmlhttp;   
	 
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
			
		 var temp=status.split("#");
		
		 var temp1=temp.length-1;
		 document.getElementById("subcategory"+row).options.length = 0;
		for(var j=1;j<=temp1;j++)
		{
			 var temp2=temp[j].split("//");
			
			document.getElementById("subcategory"+row).options[j]=new Option(temp2[1],temp2[0]);
			
		    }
	     }
	   }

	 var D_PATH=document.getElementById("D_PATH").value
		var DIR=document.getElementById("DIR").value
		
	 xmlhttp.open("GET",D_PATH+"/stock/load/getsub_categorys.php?category="+category,true);
	 xmlhttp.send();
		



	}

function loadItems1(row,val)
{

		 var cid=document.getElementById("category1").value;
	 var sid=document.getElementById("subcategory1").value;
		document.getElementById("item_id_11").options.length = 0;
		document.getElementById("item_id_11").options[0]=new Option("Loading.....","Loading...");
		
	var xmlhttp;   
	 
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
			
		   var temp=status.split("#");
			
			 var temp1=temp.length-1;
			 document.getElementById("item_id_11").options.length = 0;
			for(var j=1;j<=temp1;j++)
			{
				 var temp2=temp[j].split("//");
				
				document.getElementById("item_id_11").options[j]=new Option(temp2[1],temp2[0]);
				
			    }
		    
	     }
	   }

	 var D_PATH=document.getElementById("D_PATH").value
		var DIR=document.getElementById("DIR").value
		
	 xmlhttp.open("GET",D_PATH+"/stock/load/loaditems_list.php?&category="+cid+"&subcategoryid="+sid,true);
	 xmlhttp.send();



	}

function loadItems2(row,val)
{

		 var cid=document.getElementById("category1").value;
	 var sid=document.getElementById("subcategory1").value;
	 var item=document.getElementById("item_id_11").value;
		document.getElementById("description_11").options.length = 0;
		document.getElementById("description_11").options[0]=new Option("Loading.....","Loading...");
		
	var xmlhttp;   
	 
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
		  
		   var temp=status.split("#");
			
			 var temp1=temp.length-1;
			 document.getElementById("description_11").options.length = 0;
			for(var j=1;j<=temp1;j++)
			{
				 var temp2=temp[j].split("//");
				
				document.getElementById("description_11").options[j]=new Option(temp2[1],temp2[0]);
				
			    }
		    
	     }
	   }

	 var D_PATH=document.getElementById("D_PATH").value
		var DIR=document.getElementById("DIR").value
		
	 xmlhttp.open("GET",D_PATH+"/stock/load/loaddesc_list.php?&category="+cid+"&subcategoryid="+sid+"+&item="+item,true);
	 xmlhttp.send();



	}


	
	function getStock()
	{

		 document.getElementById("load_stock").innerHTML="Loading.....";	
		 var cid=document.getElementById("category1").value;
		 var sid=document.getElementById("subcategory1").value;
		 var item=document.getElementById("item_id_11").value;
			var description=document.getElementById("description_11").value;

			var date=document.getElementById("date").value;
			var date2=document.getElementById("date2").value;
			
		var xmlhttp;   
		 
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
			  
			 document.getElementById("load_stock").innerHTML=status;
			    
		     }
		   }

		 var D_PATH=document.getElementById("D_PATH").value
			var DIR=document.getElementById("DIR").value
			
		 xmlhttp.open("GET",D_PATH+"/"+DIR+"/load/getstockvalue.php?category="+cid+"&subcategoryid="+sid+"&item="+item+"&description="+description+"&date="+date+"&date2="+date2,true);
		 xmlhttp.send();
	
	}

</script>
     
  
  </head>
  <body class="<?php echo $body_style?>">
    <div class="wrapper">
         <!-- ---------------------------------------------------POPUP--------------------------------------------------------------------------- -->
<div class='popup'>
<div class='content_popup'>
<img src='<?php echo $UI_ELEMENTS?>notify/img/img.png' alt='quit' class='x' id='x'></img>
<div>
<form action="index.php?action=print/print_barcode&c=stock" method="get">
 <input type='hidden' name="action" value="print/print_barcode">
          <input type='hidden' name="c" value="stock">
   <input type='hidden' name="category_main" value="<?php echo $_GET["category1"]?>">
          <input type='hidden' name='subcategory_main' value="<?php echo $_GET["subcategory1"]?>">
          
          
<section class='content'>
            <div class='row'>
            <div class='col-md-12'>
              <div class='box box-primary'>
                <div class='box-header'>
                  <h3 class='box-title'>Configur Barcode Print</h3>
                </div>
                  <div class='box-body'>
                    <div class='form-group'>
                      <select name='tran_type'>
                      <option value='save'>Save and Print</option>
                      <option value='print'>Print</option>
                      </select>
                      
                      <label for='exampleInputFullName'>Leave</label>
                      <input type='text' class='form-control' id='leave_qty' name='leave_qty' value="0">
                      
                      
                      <label for='exampleInputFullName'>Print Qty</label>
                      <input type='text' class='form-control' id='print_qty' name='print_qty'>
                       <input type='hidden' class='form-control' id='tran_id' name='tran_id'>
                       <input type='hidden' class='form-control' id='item_id' name='item_id'>
                       <input type='hidden' class='form-control' id='stock_new' name='stock'>
                       <input type='hidden' class='form-control' id='cost_new' name='cost'>
                       <input type='hidden' class='form-control' id='mrp' name='mrp'>
                       <input type='hidden' class='form-control' id='rack_new' name='rack'>
                       <input type='hidden' class='form-control' id='selling_tran_id' name='selling_tran_id'>
                      <span  id='category_v'></span>
                    </div>
                    
				  <div class='form-group'>                  
					<button class='btn btn-block btn-success' onclick='Print()'>Print Barcode</button>
				  </div>            
                  </div>                
              </div>
          </div>
          </div>  
        </section>
        </form>
</div>
</div>
</div>  

<script type="text/javascript">
function printQty(qty,tran_id,item_id,row)
{
	
	document.getElementById("print_qty").value=qty
	document.getElementById("tran_id").value=tran_id
	document.getElementById("item_id").value=item_id
	document.getElementById("selling_tran_id").value=document.getElementById("selling_tran_id"+row).value
	document.getElementById("stock_new").value=document.getElementById("stock"+row).value
	document.getElementById("cost_new").value=document.getElementById("cost"+row).value
	document.getElementById("mrp").value=document.getElementById("mrp"+row).value
	
	document.getElementById("rack_new").value=document.getElementById("rack"+row).value
}
</script> 
<!-- ---------------------------------------------------POPUP--------------------------------------------------------------------------- -->  
     

      <?php include_once "$D_PATH/include/header.php";?> 
      <!-- Left side column. contains the logo and sidebar -->
       <?php include_once "$D_PATH/include/side.php";?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        
          <section class="content">
          
       
          <div class="row">
            <!-- left column -->
            
                  
          
       
                
               
                 <form role="form" action="index.php?action=stock_value&c=reports" method="GET">
                <input type='hidden' name="action" value="stock_value">
          <input type='hidden' name="c" value="reports">
                <input type="text" style="width: 60%" class="form-control col-md-6" name="barcode" id="barcode" onchange="copyBarcode(this.value)" class="form-control" size='15px' placeholder="Barcode">
                <input type='submit' style="width: 30%" value="Submit" class="form-control col-md-6 btn-warning">
                </form>
              
                 <div class="col-xs-12" >
              
              <div class="box" >
                
                <div class="box-body" >
                
                <table style="width: 96%;margin-left: 2%">
                <tr><th>Category</th><td>&nbsp;&nbsp;</td><td><select class="form-control select2" id="category1" name="category1" onchange="loadItems(1,this.value)">
                <?php 
                if(isset($_GET["category1"]))
                {
                	$data = mysql_query("SELECT category_id,category_name FROM category where category_id='".$_GET["category1"]."' and branch='".$session_branch."'");if($data)while($info = mysql_fetch_array( $data )){?><option  value="<?php echo $_GET["category1"]?>"><?php echo $info["category_name"]?></option><?php }
                
                }
                ?>
                <option value=""></option><?php $data = mysql_query("SELECT category_id,category_name FROM category where category_status='active' and branch='".$session_branch."'");if($data)while($info = mysql_fetch_array( $data )){?><option  value="<?php echo $info["category_id"]?>"><?php echo $info["category_name"]?></option><?php }?></select></td>
               <th>Sub Category</th> <td>&nbsp;&nbsp;</td>
                <td><select class="form-control select2" id="subcategory1" name="subcategory1" onchange="loadItems1(1,this.value)">
                  <option value=""></option>
                  <?php 
                if(isset($_GET["subcategory1"]))
                {
                	$data = mysql_query("SELECT sub_cid, category_id, sub_name, sub_status, branch FROM sub_category where sub_cid='".$_GET["subcategory1"]."' and branch='".$session_branch."'");if($data)while($info = mysql_fetch_array( $data )){?><option  value="<?php echo $_GET["subcategory1"]?>"><?php echo $info["sub_name"]?></option><?php }
                	$data = mysql_query("SELECT sub_cid, category_id, sub_name, sub_status, branch FROM sub_category where category_id='".$_GET["category1"]."' and branch='".$session_branch."' order by sub_name asc");if($data)while($info = mysql_fetch_array( $data )){?><option  value="<?php echo $_GET["subcategory1"]?>"><?php echo $info["sub_name"]?></option><?php }
                }
                ?>
                </select></td>
                <th>Item</th><td>&nbsp;&nbsp;&nbsp;</td>
               <td><select class="form-control select2" id="item_id_11" name="item_id_11" style="width: 150px" onchange="loadItems2(1,this.value)">
                 <?php 
                if(isset($_GET["item_id_11"]))
                {
                	$data = mysql_query("SELECT item_id, item_name FROM items where item_id='".$_GET["item_id_11"]."' and branch='".$session_branch."'");if($data)while($info = mysql_fetch_array( $data )){?><option  value="<?php echo $_GET["item_id_11"]?>"><?php echo $info["item_name"]?></option><?php }
                	$data = mysql_query("SELECT item_id, item_name FROM items where category='".$_GET["category1"]."' and sub_category_id='".$_GET["subcategory1"]."' and branch='".$session_branch."' order by item_name asc");if($data)while($info = mysql_fetch_array( $data )){?><option  value="<?php echo $info["item_id"]?>"><?php echo $info["item_name"]?></option><?php }
                }
                ?>
               <option value=""></option></select></td>
               <td>&nbsp;&nbsp;&nbsp;</td>
               <th>Description</th><td>&nbsp;&nbsp;&nbsp;</td>
               <td><input type='text' class="form-control" onkeyup="getStock()" id="description_11" name="description_11" style="width: 150px">
               </td>
               
               </tr>
               <tr>
               </tr>
               <tr>
                
               </table>
                <table>
               <tr>
               <td><input type='date' id='date' class="form-control" value=''></td>
<td><input type='date' id='date2' class="form-control" value=''></td>
               
               <td><input type='submit' value='Get Report' onclick="getStock()" class='btn btn-block btn-success'></td>
               </tr>
               </table>
                
                <span id='load_stock'>
                <?php 
                if(isset($_GET["barcode"])){
                
                	$i=1;
                
?>

<h4>Purchase Report</h4>
<table id='example1' class='table table-bordered table-striped' style='font-size:13px'>
	<thead>
		<tr><th>SlNo</th>
			<th>Item Name&nbsp;&nbsp;</th>
			<th>Description&nbsp;&nbsp;</th>
			
			<th style='background: yellow'>Pur Qty</th><th style='background: yellow'>Pur Value</th>
			<th>Landing&nbsp;Cost</th><th style='background: #CEF6CE'>Sel Qty</th>
			<th style='background: #CEF6CE'>Sel Value(Pur Cost)</th>
			<th style='background: #CEF6CE'>Sel Value</th>
			<th>Sell&nbsp;Cost</th>
			<th style='background: orange'>Avail Stock</th>
			<th style='background: orange'>Stock Value(Pur Cost)</th>
			<th>Mrp</th><th>Rack</th></tr></thead>
<?php 
$barcode=explode("-", $_GET["barcode"]);
$dateFilter="";
                $data = mysql_query("SELECT category,item_name,item_id FROM items WHERE item_id='".$barcode[0]."'");
	while($info = mysql_fetch_array($data))
	{
		$category=$info["category"];		
		$item_name=$info["item_name"];
		$item_id=$info["item_id"];
	}
                $data1 = mysql_query("SELECT distinct(description) as description FROM txn_bill_support WHERE sk_tran_id='".$barcode[1]."' ORDER BY description");
	while($info1 = mysql_fetch_array($data1))
	{
		$description=$info1["description"];
	}
$main_filter="";
if($category!=''){$main_filter=" category='$category' and ";}
if($item_id!=''){$main_filter=$main_filter." item_id='".$barcode[0]."' and ";}

$subfilter="";
if($description!=''){$subfilter=" and description like '%$description%'";}

$i=1;
$t_p=0;
$t_p_c=0;
$t_p_l=0;
$t_s=0;
$selling_purchase=0;
$available_qty_t=0;
$available_cost_t=0;

$data12 = mysql_query("SELECT item_id,category FROM items WHERE $main_filter item_status='active' order by category asc");
while($info12 = mysql_fetch_array($data12))
{
	$item_id=$info12["item_id"];
	$data13 = mysql_query("SELECT distinct(description) FROM txn_bill_support WHERE particular_id='$item_id' and bill_for='Supplier' $subfilter");
	while($info13 = mysql_fetch_array($data13))
	{	 
		$desc=$info13[0];
$data = mysql_query("SELECT sum(qty_in_sft), sum(amount),sum(landing_cost),landing_cost FROM txn_bill_support WHERE particular_id='$item_id' and bill_for='Supplier' and description='$desc' $dateFilter");
while($info = mysql_fetch_array($data))
{
	$pur_qty=$info[0];
	$pur_rate=$info[1];
	$rack_id=0;
	$landing_cost=$info[3];
	
	if($landing_cost==0)
	{
		
		$data4 = mysql_query("SELECT landing_cost FROM txn_bill_support WHERE particular_id='$item_id' and bill_for='Supplier' and description='$desc'");
		while($info4 = mysql_fetch_array($data4))
		{
			$landing_cost=$info4["landing_cost"];
		}
	}
	
	
	$sessing_qty=0;
	$sessing_rate=0;
	$sessing_cost=0;
	
	$data2 = mysql_query("SELECT sum(qty_in_sft),rate, sum(amount) FROM txn_bill_support WHERE particular_id='$item_id' and bill_for='Customer' and description='$desc' $dateFilter");
	while($info2 = mysql_fetch_array($data2))
	{
		$sessing_qty=$info2[0];
		$sessing_rate=$info2[1];
		$sessing_cost=$info2[2];
	}
	
	$r_sessing_qty=0;$r_sessing_qty_p=0;
	$data2 = mysql_query("SELECT sum(qty_in_sft),sum(qty_in_piece) FROM txn_bill_support WHERE particular_id='$item_id' and bill_for='Customer' and bill_type like '%Return%' and description='$desc' $dateFilter order by bill_date desc");
	while($info2 = mysql_fetch_array($data2))
	{
		$r_sessing_qty=$info2[0];
		$r_sessing_qty_p=$info2[1];	
	}
	
	$o_sessing_qty=0;
  $data2 = mysql_query("SELECT sum(remaining_qty) FROM stock WHERE flower_name='$item_id' and description='$desc'");
              while($info2 = mysql_fetch_array($data2))
              {
              	$o_sessing_qty=$info2[0];
              }
              
	$sessing_qty=$sessing_qty+$r_sessing_qty;
	
	$item_name="";
	$data1 = mysql_query("SELECT item_id, item_name FROM items WHERE item_id='$item_id'");
	while($info1 = mysql_fetch_array($data1))
	{
		$item_name=$info1["item_name"];
	}
	
	$data5 = mysql_query("SELECT rack_name from rack where rack_id='$rack_id'");
	$rack_name='';
	while($info5 = mysql_fetch_array( $data5 ))
	{
		$rack_name=$info5['rack_name'];
			
	}
	
	$data5 = mysql_query("SELECT mrp from stock where flower_name='$item_id' and description='$desc'");
	$mrp=0;
	while($info5 = mysql_fetch_array( $data5 ))
	{
		$mrp=$info5['mrp'];
			
	}
	$temp_cost="";
	if($sessing_rate==0)
	{
		$temp_cost="#F5D0A9";
		$sessing_rate=$landing_cost+(($landing_cost*15)/100);
	}
	

	/*$tran_id=$info["tran_id"];
	$item_rate=number_format($info["item_rate"], 2, '.', '');
	$landing_cost=number_format($info["landing_cost"], 2, '.', '');
	*/
	/*
	$cur_stock=$total_sft-$sessing_qty;
	
	$t_p=$t_p+$info["item_qty"];
	$t_p_c=$t_p_c+$item_rate;
	$t_p_l=$t_p_l+$landing_cost;*/
	$t_p=$t_p+($pur_qty*$landing_cost);
	$t_s=$t_s+$sessing_cost+($o_sessing_qty*$sessing_rate);
	$selling_purchase=$selling_purchase+($sessing_qty*$landing_cost)+($o_sessing_qty*$landing_cost);

	$selling_p=$sessing_qty*$landing_cost;
	$color="#CEF6CE";
	if(($selling_p+($o_sessing_qty+$landing_cost))>($sessing_cost+($sessing_rate*$sessing_rate)))
	{
		$color="red";
	}
	$available_qty=$pur_qty-$sessing_qty;
	
	$available_cost_t=$available_cost_t+(($available_qty-$o_sessing_qty)*$landing_cost);
	?>
	<tr>
<td><?php $i?></td>
			<td><?php echo $item_name?></td>
			<td><?php echo $desc?></td>
						
			 <td style='background: yellow'><?php echo number_format($pur_qty, 0, '.', '')?></td>    		
			<td style='background: yellow;text-align:right'><?php echo number_format($pur_qty*$landing_cost, 2, '.', '')?></td>
			<td><?php echo number_format($landing_cost, 2, '.', '')?></td>
			<td style='background: #CEF6CE'><?php echo number_format($sessing_qty+$o_sessing_qty, 0, '.', '')?>(<?php echo number_format($sessing_qty, 0, '.', '')?>+<?php echo number_format($o_sessing_qty, 0, '.', '')?>)</td>
			<td style='background: #CEF6CE;text-align:right'><?php echo number_format($selling_p+($o_sessing_qty*$landing_cost), 2, '.', '')?></td>
			<td style='background: <?php echo $color?>;text-align:right'><?php echo number_format($sessing_cost+($o_sessing_qty*$sessing_rate), 2, '.', '')?><!-- (<?php echo number_format($sessing_cost, 0, '.', '')?> + <?php echo number_format($o_sessing_qty*$sessing_rate, 0, '.', '')?>) --></td>
				<td style="background: <?php echo $temp_cost?>"><?php echo number_format($sessing_rate, 0, '.', '')?></td>
				
				<td style='background: orange;text-align:right'><?php echo number_format($available_qty-$o_sessing_qty, 2, '.', '')?></td>
				<td style='background: orange;text-align:right'><?php echo number_format(($available_qty-$o_sessing_qty)*$landing_cost, 2, '.', '')?></td>
				
	<td><?php echo $mrp?></td>
		<td><?php echo $rack_name?></td>
	
    <?php echo "
					</tr>
			";
$i++;}}}?>
<tfoot>
<tr><td></td><td></td><td></td><td><?php echo number_format($t_p, 2, '.', '')?></td>
<td></td><td></td><td><?php echo number_format($selling_purchase, 2, '.', '')?></td>
<td><?php echo number_format($t_s, 2, '.', '')?></td>

<td style="background: red"><?php echo number_format($t_s-$selling_purchase, 2, '.', '')?></td>
<td></td>
<td><?php echo number_format($available_cost_t, 2, '.', '')?></td>
<td></td>
</tfoot>
<thead>
		<tr>
<th>SlNo</th>
			<th>Item Name&nbsp;&nbsp;</th>
			<th>Description&nbsp;&nbsp;</th>
			
			<th style='background: yellow'>Pur Qty</th><th style='background: yellow'>Pur Value</th>
			<th>Landing&nbsp;Cost</th><th style='background: #CEF6CE'>Sel Qty</th>
			<th style='background: #CEF6CE'>Sel Value(Pur Cost)</th>
			<th style='background: #CEF6CE'>Sel Value</th>
			<th>Sell&nbsp;Cost</th>
			<th style='background: orange'>Avail Stock</th>
			<th style='background: orange'>Stock Value(Pur Cost)</th>
			<th>Mrp</th><th>Rack</th></tr></thead>
</table>
<?php }?>
</span>
                </div>
               
                </div>
                </div>
                
                
                
                
                
                
                
                
                
                
                
                
                
                 </div>
                 
                 </div>
               
             
           
           
           
              
          
          
                  
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <?php include_once "$D_PATH/include/footer.php";?>
    </div><!-- ./wrapper -->
<script type="text/javascript">
$(function () {
  //Initialize Select2 Elements
  $(".select2").select2();

  
});
</script>
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
     <!-- DATA TABES SCRIPT -->
    
    <!-- AdminLTE for demo purposes -->
    <?php include_once "$D_PATH/include/scripts_bottom.php";?>
  </body>
</html>
