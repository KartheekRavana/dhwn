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
            
                  
          
       
                <div class="col-xs-12" >
              
              <div class="box" >
                
                <div class="box-body" >
                 <div class="col-xs-12" style="height: 50px" >
                <form role="form" action="index.php?action=salepurchase&c=reports" method="GET">
                <input type='hidden' name="action" value="salepurchase">
          <input type='hidden' name="c" value="reports">
                <input type="text" style="width: 60%" class="form-control col-md-6" name="barcode" id="barcode" onchange="copyBarcode(this.value)" class="form-control" size='15px' placeholder="Barcode">
                <input type='submit' style="width: 30%" value="Submit" class="form-control col-md-6 btn-warning">
                </form>
              </div>
                <form role="form" action="index.php?action=barcode&c=stock" method="GET">
   <input type='hidden' name="action" value="salepurchase">
          <input type='hidden' name="c" value="reports">
          <input type='hidden' id='data' name='data'>
          <?php 
          if(isset($_GET["barcode"])){
                 		$barcode=explode("-", $_GET["barcode"]);
              		$category="";
	$data = mysql_query("SELECT category,item_name,item_id,sub_category_id FROM items WHERE item_id='".$barcode[0]."'");
	while($info = mysql_fetch_array($data))
	{
		$category=$info["category"];		
		$item_name=$info["item_name"];
		$item_id=$info["item_id"];
		$sub_category_id=$info["sub_category_id"];
	}
          $data1 = mysql_query("SELECT distinct(description) as description FROM txn_bill_support WHERE sk_tran_id='".$barcode[1]."' ORDER BY description");
	while($info1 = mysql_fetch_array($data1))
	{
		$desc=$info1["description"];
	}
          }
          ?>
                <table style="width: 96%;margin-left: 2%">
                <tr><th>Category</th><td>&nbsp;&nbsp;</td><td><select class="form-control select2" id="category1" name="category1" onchange="loadItems(1,this.value)">
                <?php 
                if(isset($_GET["category1"]))
                {
                	$data = mysql_query("SELECT category_id,category_name FROM category where category_id='".$_GET["category1"]."' and branch='".$session_branch."'");if($data)while($info = mysql_fetch_array( $data )){?><option  value="<?php echo $_GET["category1"]?>"><?php echo $info["category_name"]?></option><?php }
                
                }
                 if(isset($category))
                {
                	$data = mysql_query("SELECT category_id,category_name FROM category where category_id='".$category."' and branch='".$session_branch."'");if($data)while($info = mysql_fetch_array( $data )){?><option  value="<?php echo $_GET["category1"]?>"><?php echo $info["category_name"]?></option><?php }
                
                }
                ?>
                <option value=""></option><?php $data = mysql_query("SELECT category_id,category_name FROM category where category_status='active' and branch='".$session_branch."'");if($data)while($info = mysql_fetch_array( $data )){?><option  value="<?php echo $info["category_id"]?>"><?php echo $info["category_name"]?></option><?php }?></select></td>
               <th>Sub Category</th> <td>&nbsp;&nbsp;</td>
                <td><select class="form-control select2" id="subcategory1" name="subcategory1" onchange="loadItems1(1,this.value)" style="min-width: 150px">
                  <?php 
                  if(isset($sub_category_id)){
                  $data = mysql_query("SELECT sub_cid, category_id, sub_name, sub_status, branch FROM sub_category where sub_cid='".$sub_category_id."' and branch='".$session_branch."'");if($data)while($info = mysql_fetch_array( $data )){?><option  value="<?php echo $_GET["subcategory1"]?>"><?php echo $info["sub_name"]?></option><?php }
                  }
                if(isset($_GET["subcategory1"]))
                {
                	$data = mysql_query("SELECT sub_cid, category_id, sub_name, sub_status, branch FROM sub_category where sub_cid='".$_GET["subcategory1"]."' and branch='".$session_branch."'");if($data)while($info = mysql_fetch_array( $data )){?><option  value="<?php echo $_GET["subcategory1"]?>"><?php echo $info["sub_name"]?></option><?php }
                	$data = mysql_query("SELECT sub_cid, category_id, sub_name, sub_status, branch FROM sub_category where category_id='".$_GET["category1"]."' and branch='".$session_branch."' order by sub_name asc");if($data)while($info = mysql_fetch_array( $data )){?><option  value="<?php echo $_GET["subcategory1"]?>"><?php echo $info["sub_name"]?></option><?php }
                }
                ?>
                <option value=""></option></select></td>
                <th>Item</th><td>&nbsp;&nbsp;&nbsp;</td>
               <td><select class="form-control select2" id="item_id_11" name="item_id_11" style="width: 150px" onchange="loadItems2(1,this.value)">
                 <?php 
                 if(isset($item_id)){
                 $data = mysql_query("SELECT item_id, item_name FROM items where item_id='".$item_id."' and branch='".$session_branch."'");while($info = mysql_fetch_array( $data )){?><option  value="<?php echo $item_name?>"><?php echo $info["item_name"]?></option><?php }
                 }
                if(isset($_GET["item_id_11"]))
                {
                	$data = mysql_query("SELECT item_id, item_name FROM items where item_id='".$_GET["item_id_11"]."' and branch='".$session_branch."'");if($data)while($info = mysql_fetch_array( $data )){?><option  value="<?php echo $_GET["item_id_11"]?>"><?php echo $info["item_name"]?></option><?php }
                	$data = mysql_query("SELECT item_id, item_name FROM items where category='".$_GET["category1"]."' and sub_category_id='".$_GET["subcategory1"]."' and branch='".$session_branch."' order by item_name asc");if($data)while($info = mysql_fetch_array( $data )){?><option  value="<?php echo $info["item_id"]?>"><?php echo $info["item_name"]?></option><?php }
                }
                ?>
               <option value=""></option></select></td>
               <td>&nbsp;&nbsp;&nbsp;</td>
               <th>Description</th><td>&nbsp;&nbsp;&nbsp;</td>
               <td><select class="form-control select2" id="description_11" name="description_11" style="width: 150px">
                 <?php 
                  if(isset($desc))
                {
                	?><option  value="<?php echo $desc?>"><?php echo $desc?></option><?php
                }
                if(isset($_GET["description_11"]))
                {
               	?><option  value="<?php echo $_GET["description_11"]?>"><?php echo $_GET["description_11"]?></option><?php
                	$data = mysql_query("SELECT distinct(description) as description FROM txn_bill_support where particular_id='".$_GET["item_id_11"]."' order by description asc");if($data)while($info = mysql_fetch_array( $data )){?><option  value="<?php echo $info["description"]?>"><?php echo $info["description"]?></option><?php }
                }
                ?>
               <option value=""></option></select></td>
               
               </tr>
               
               </table>
               <table>
               <tr>
               <td><input type='date' name='date' class="form-control" value='<?php  if(isset($_GET['date'])){echo $_GET['date'];}else{ echo $date1;}?>'></td>
<td><input type='date' name='date2' class="form-control" value='<?php  if(isset($_GET['date2'])){echo $_GET['date2'];}else{ echo $date1;}?>'></td>
               
               <td><input type='submit' value='Get Report' class='btn btn-block btn-success'></td>
               </tr>
               </table>
               </form>
               </div></div></div>
               
               
                 <div class="col-xs-12" >
              
              <div class="box" >
                
                <div class="box-body" >
              
              
              <?php $total_sft=0;$cur_stock=0;  $c_sessing_qty=0;$c_sessing_qty_p=0;$ledger_qty=0;$ledger_qty_p=0;  $r_sessing_qty=0;$r_sessing_qty_p=0;
              if(isset($_GET["item_id_11"]) || isset($_GET["barcode"]))
              {
              	$i=1;
              	
              	$date_filter="";
              	if(isset($_GET["date"]))
              	if($_GET["date"])
              	{
              		$date_filter="and item_date between '".$_GET["date"]."' and '".$_GET["date2"]."'";
              	}
              	
              	if(isset($_GET["barcode"])){
              		
              		$barcode=explode("-", $_GET["barcode"]);
              		$category="";
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
		$desc=$info1["description"];
	}
	
              		
              		
              	}else{
              		$item_id=$_GET["item_id_11"];
              	$desc=$_GET["description_11"];
              	}
              	

	$total_piece=0;
	$data2 = mysql_query("SELECT sum(qty_in_sft),sum(qty_in_piece) FROM txn_bill_support WHERE particular_id='$item_id' and bill_for='Supplier' and bill_type='Cash' and description='$desc' $date_filter");
	while($info2 = mysql_fetch_array($data2))
	{
		$total_sft=$info2[0];
		$total_piece=$info2[1];
	}
              $data2 = mysql_query("SELECT sum(qty_in_sft),sum(qty_in_piece) FROM txn_bill_support WHERE particular_id='$item_id' and bill_for='Supplier' and bill_type='Credit' and description='$desc' $date_filter");
	while($info2 = mysql_fetch_array($data2))
	{
		$total_sft=$total_sft+$info2[0];
		$total_piece=+$total_piece+$info2[1];
	}
	$return_total_sft=0;
	$return_total_piece=0;
	$data2 = mysql_query("SELECT sum(qty_in_sft),sum(qty_in_piece) FROM txn_bill_support WHERE bill_for='Supplier' and bill_type like '%return%' and particular_id='$item_id' and description='$desc' $date_filter order by bill_date desc");
	while($info2 = mysql_fetch_array($data2))
	{
		$return_total_sft=$info2[0];
		$return_total_piece=$info2[1];
	}
	//$total_sft=$total_sft-$return_total_sft;
	$total_sft=$total_sft-$return_total_sft;
	$total_piece=$total_piece-$return_total_piece;
              $c_sessing_qty=0;$c_sessing_qty_p=0;
              $data2 = mysql_query("SELECT sum(qty_in_sft),sum(qty_in_piece) FROM txn_bill_support WHERE particular_id='$item_id' and bill_for='Customer' and description='$desc' and bill_type not like '%return%' $date_filter");
              while($info2 = mysql_fetch_array($data2))
              {
              	$c_sessing_qty=$info2[0];
              	$c_sessing_qty_p=$info2[1];
              
              }
              
              $ledger_qty=0;$ledger_qty_p=0;
              $data2 = mysql_query("SELECT sum(remaining_qty) FROM stock WHERE flower_name='$item_id' and description='$desc'");
              while($info2 = mysql_fetch_array($data2))
              {
              	$ledger_qty=$info2[0];
             
              }
              
              $r_sessing_qty=0;$r_sessing_qty_p=0;
              $data2 = mysql_query("SELECT sum(qty_in_sft),sum(qty_in_piece) FROM txn_bill_support WHERE particular_id='$item_id' and bill_for='Customer' and bill_type like '%return%' and description='$desc' $date_filter");
              while($info2 = mysql_fetch_array($data2))
              {
              	$r_sessing_qty=$info2[0];
              	$r_sessing_qty_p=$info2[1];
              
              }
              $o_sessing_qty=0;
          
              $cur_stock=$total_sft-($o_sessing_qty+($c_sessing_qty-$r_sessing_qty));
              }
              
              
             ?>
              <table id='' class='table table-bordered table-striped'>
              	<tr><td>Purchase Stock</td><td><?php echo $total_sft?></td></tr>
              	<tr><td>Selling Stock</td><td><?php echo $c_sessing_qty?>(Ledger = <?php echo $ledger_qty?>)</td></tr>
              	<tr><td>Return Stock</td><td><?php echo $r_sessing_qty?></td></tr>
              	<tr><td>Current Stock</td><td><?php echo (($total_sft)-(($c_sessing_qty+$ledger_qty)-$r_sessing_qty))?><!--$cur_stock-$ledger_qty-->
              	
              	</td></tr>
              </table>
              </div>
              </div>
              </div>
              
                 <div class="col-xs-6" >
              
              <div class="box" >
                
                <div class="box-body" >
                <?php 
                $t_p=0;
$t_p_c=0;
$t_p_l=0;
                if(isset($_GET["item_id_11"]) || isset($_GET["barcode"]))
                {
                	$i=1;
                	
                	
                	if(isset($_GET["barcode"])){
              		
              		$barcode=explode("-", $_GET["barcode"]);
              		$category="";
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
		$desc=$info1["description"];
	}
	
              		
              		
              	}else{
              		$item_id=$_GET["item_id_11"];
                	$desc=$_GET["description_11"];
              	}
?>
<h4>Purchase Report</h4>
<table id='' class='table table-bordered table-striped' style='font-size:12px'>
	<thead>
		<tr>
		<th>Supplier Name</th>
			<th>Bill&nbsp;Date&nbsp;&nbsp;</th>
			<th style='background: yellow'>Pcs</th><th style='background: yellow'>Sft</th>
			<th>P&nbsp;Cost</th><th>L&nbsp;Cost</th><th>Mrp</th><th>Rack</th></tr></thead>
<?php 

$data = mysql_query("SELECT sk_tran_id, bill_id, bill_date, qty_in_sft,qty_in_piece, rate, amount, landing_cost, description FROM txn_bill_support WHERE particular_id='$item_id' and bill_type  not like '%return%' and bill_for='Supplier' and description='$desc' $date_filter order by bill_date desc");
while($info = mysql_fetch_array($data))
{
	$description=$info["description"];
	$rack_id=0;
	$total_sft=0;
	$total_piece=0;
	
	$sessing_qty="";
	$sessing_rate="";
	$selling_tran_id="";
	
	$supplier_name="";
	$supplier_id=0;
	$data1 = mysql_query("SELECT member_id FROM mst_bill_main WHERE sk_bill_id='".$info["bill_id"]."'");
	while($info1 = mysql_fetch_array($data1))
	{
		$supplier_id=$info1["member_id"];
		
	}
$data1 = mysql_query("SELECT member_name FROM mst_member WHERE sk_member_id='$supplier_id'");
		while($info1 = mysql_fetch_array($data1))
		{
			$supplier_name=$info1["member_name"];
		}

	
	
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
	
	$data5 = mysql_query("SELECT mrp from stock where flower_name='$item_id' and description='$description'");
	$mrp='';
	while($info5 = mysql_fetch_array( $data5 ))
	{
		$mrp=$info5['mrp'];
			
	}
	
	$t_date=explode("-", $info["bill_date"]);
	$bill_date=$t_date[2]."-".$t_date[1]."-".$t_date[0];

	$tran_id=$info["sk_tran_id"];
	$item_rate=number_format($info["rate"], 2, '.', '');
	$landing_cost=number_format($info["landing_cost"], 2, '.', '');
	
	
	$cur_stock=$total_sft-$sessing_qty;
	
	$t_p=$t_p+$info["qty_in_sft"];
$t_qty_in_piece=$t_qty_in_piece+$info["qty_in_piece"];
	$t_p_c=$t_p_c+$item_rate;
	$t_p_l=$t_p_l+$landing_cost;
	
	?>
	<tr>
			<td><a href="?action=purchase_edit&c=stock&bill_no=<?php echo $info["bill_id"]?>" target="blank"><?php echo $supplier_name?></a></td>
			<td><a href="?action=purchase_edit&c=stock&bill_no=<?php echo $info["bill_id"]?>" target="blank"><?php echo $bill_date?></a></td>
			
			<td style='background: yellow'><?php echo $info["qty_in_piece"]?></td>
			 <td style='background: yellow'><?php echo $info["qty_in_sft"]?></td>
    		
			<td><?php echo $item_rate?></td>
			<td><?php echo $landing_cost?></td>
	<td><?php echo $mrp?></td>
		<td><?php echo $info5['rack_name']?></td>
	
    <?php echo "
					</tr>
			";
$i++;}}?>
<tfoot>
<tr><td></td><td></td><td><?php echo $t_qty_in_piece?></td><td><?php echo $t_p?></td>
<td></td>
<td></td><td></td>
</tfoot>
</table>

                </div>
               <script type="text/javascript">
				function calSelling(row)
				{
					var bill=0;
					if(document.getElementById("bill_stock"+row).value!='')
					{
					bill=parseInt(document.getElementById("bill_stock"+row).value)
					}
					document.getElementById("stock"+row).value=(parseInt(document.getElementById("tot_st"+row).value))-(parseInt(document.getElementById("cur_stock"+row).value)+bill)
				}
               </script>
                </div>
                </div>
                
                
                
                
                
                
                <div class="col-xs-6" >
              
              <div class="box" >
                
                <div class="box-body" >
                <?php $t_s=0;
$t_s_c=0;
$t_s_l=0;
                if(isset($_GET["item_id_11"]) || isset($_GET["barcode"]))
                {
                	$i=1;
                	
                	
                	if(isset($_GET["barcode"])){
              		
              		$barcode=explode("-", $_GET["barcode"]);
              		$category="";
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
		$desc=$info1["description"];
	}
	
              		
              		
              	}else{
              		$item_id=$_GET["item_id_11"];
                	$desc=$_GET["description_11"];
              	}
?>
<h4>Sales Report</h4>
<table id='' class='table table-bordered table-striped' style='font-size:13px'>
	<thead>
		<tr>
		<th>Ref No</th>
			<th>Bill&nbsp;Date&nbsp;&nbsp;</th>
			<th style='background: yellow'>Pcs</th><th style='background: yellow'>Sft</th>
			<th>Cost</th><th>Mrp</th></tr></thead>
<?php $t_qty_in_piece=0;
echo 
$data = mysql_query("SELECT sk_tran_id, bill_id, bill_date, particular_id, qty_in_sft,qty_in_piece, rate, amount, qty_in_piece, discount, description FROM txn_bill_support WHERE particular_id='$item_id' and bill_for='Customer' and description='$desc' $date_filter order by bill_date desc");
while($info = mysql_fetch_array($data))
{
	$description=$info["description"];
	
	$total_sft=0;
	$total_piece=0;
	
	$sessing_qty="";
	$sessing_rate="";
	$selling_tran_id="";
	
	$customer_name="";
	$customer_id=0;
	$data1 = mysql_query("SELECT member_id,member_name FROM mst_bill_main WHERE sk_bill_id='".$info["bill_id"]."'");
	while($info1 = mysql_fetch_array($data1))
	{
		$customer_id=$info1["member_id"];
		if($customer_id==0)
		{
			$customer_name=$info1["member_name"];
			
		}
	}
	
	if($customer_id!=0)
	{
		$data1 = mysql_query("SELECT member_name FROM mst_member WHERE sk_member_id='$customer_id'");
		while($info1 = mysql_fetch_array($data1))
		{
			$customer_name=$info1["member_name"];
		}
	}
	
	$item_name="";
	$data1 = mysql_query("SELECT item_id, item_name FROM items WHERE item_id='$item_id'");
	while($info1 = mysql_fetch_array($data1))
	{
		$item_name=$info1["item_name"];
	}
	
	
	$data5 = mysql_query("SELECT mrp from stock where flower_name='$item_id' and description='$description'");
	$mrp='';
	while($info5 = mysql_fetch_array( $data5 ))
	{
		$mrp=$info5['mrp'];
			
	}
	
	$t_date=explode("-", $info["bill_date"]);
	$bill_date=$t_date[2]."-".$t_date[1]."-".$t_date[0];

	$tran_id=$info["sk_tran_id"];
	$item_rate=number_format($info["rate"], 2, '.', '');
	
	
	$cur_stock=$total_sft-$sessing_qty;
	$t_s=$t_s+$info["qty_in_sft"];
$t_qty_in_piece=$t_qty_in_piece+$info["qty_in_piece"];
	$t_s_c=$t_s_c+$item_rate;
	
	if($bill_date=='04-06-2015'){$customer_name="Ledger";}
	
	if($customer_name=="Sale"){$customer_name="return";}
	
	echo "<tr>
	<td><a href='?action=sales_edit&c=stock&bill_no=".$info["bill_id"]."' target='blank'>".$info["bill_id"]."($customer_name)</a></td>
			<td>$bill_date</td>
			
			<td style='background: yellow'>". $info["qty_in_piece"]."</td>
			 <td style='background: yellow'>". $info["qty_in_sft"]."</td>
    		
			<td>". $item_rate."</td>
			
			<td>". $mrp."</td>

					</tr>
			";
$i++;}}?>
<tfoot>
<tr><td></td><td></td><td><?php echo $t_qty_in_piece?></td><td><?php echo $t_s?></td>

<td></td>
</tfoot></table>
                </div>
               <script type="text/javascript">
				function calSelling(row)
				{
					var bill=0;
					if(document.getElementById("bill_stock"+row).value!='')
					{
					bill=parseInt(document.getElementById("bill_stock"+row).value)
					}
					document.getElementById("stock"+row).value=(parseInt(document.getElementById("tot_st"+row).value))-(parseInt(document.getElementById("cur_stock"+row).value)+bill)
				}
               </script>
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
