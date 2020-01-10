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
		
	 xmlhttp.open("GET",D_PATH+"/"+DIR+"/load/getsub_categorys.php?category="+category,true);
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
		
	 xmlhttp.open("GET",D_PATH+"/"+DIR+"/load/loaditems_list.php?&category="+cid+"&subcategoryid="+sid,true);
	 xmlhttp.send();



	}
	

</script>
     
  
  </head>
  <body class="<?php echo $body_style?> sidebar-collapse">
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
              
                <form role="form" action="index.php?action=update&c=stock" method="GET">
   <input type='hidden' name="action" value="update">
          <input type='hidden' name="c" value="stock">
          <input type='hidden' id='data' name='data'>
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
                  <?php 
                if(isset($_GET["subcategory1"]))
                {
                	$data = mysql_query("SELECT sub_cid, category_id, sub_name, sub_status, branch FROM sub_category where sub_cid='".$_GET["subcategory1"]."' and branch='".$session_branch."'");if($data)while($info = mysql_fetch_array( $data )){?><option  value="<?php echo $_GET["subcategory1"]?>"><?php echo $info["sub_name"]?></option><?php }
                	$data = mysql_query("SELECT sub_cid, category_id, sub_name, sub_status, branch FROM sub_category where category_id='".$_GET["category1"]."' and branch='".$session_branch."' order by sub_name asc");if($data)while($info = mysql_fetch_array( $data )){?><option  value="<?php echo $_GET["subcategory1"]?>"><?php echo $info["sub_name"]?></option><?php }
                }
                ?>
                <option value=""></option></select></td>
                <th>Item</th><td>&nbsp;&nbsp;&nbsp;</td>
               <td><select class="form-control select2" id="item_id_11" name="item_id_11" style="width: 150px">
                 <?php 
                if(isset($_GET["item_id_11"]))
                {
                	$data = mysql_query("SELECT item_id, item_name FROM items where item_id='".$_GET["item_id_11"]."' and branch='".$session_branch."'");if($data)while($info = mysql_fetch_array( $data )){?><option  value="<?php echo $_GET["item_id_11"]?>"><?php echo $info["item_name"]?></option><?php }
                	$data = mysql_query("SELECT item_id, item_name FROM items where category='".$_GET["category1"]."' and sub_category_id='".$_GET["subcategory1"]."' and branch='".$session_branch."' order by item_name asc");if($data)while($info = mysql_fetch_array( $data )){?><option  value="<?php echo $info["item_id"]?>"><?php echo $info["item_name"]?></option><?php }
                }
                ?>
               <option value=""></option></select></td>
               <td>&nbsp;&nbsp;&nbsp;</td></tr>
               <tr><td><input type='submit' value='Get Bills' class='btn btn-block btn-success'></td>
               </tr>
               <tr>
                
                
                
               
               
               
               </table>
               </form>
               </div></div></div>
                 <div class="col-xs-12" >
              
              <div class="box" >
                
                <div class="box-body" >
                <?php 
                if(isset($_GET["item_id_11"]))
                {
                	$i=1;
                	$item_id=$_GET["item_id_11"];
echo "<table id='example1' class='table table-bordered table-striped' style='font-size:13px'><thead><tr><th>Item&nbsp;Name</th><th>Description</th><th style='background: orange'>T&nbsp;Sft</th><th>Old&nbsp;Selling</th><th>Selling</th><th>Cur&nbsp;Stock</th><th>P&nbsp;Cost</th><th>L&nbsp;Cost</th><th>Mrp</th><th>Min Stock</th><th>Rack</th><th>Action</th></thead></tr>";
$data = mysql_query("SELECT distinct(description) as description FROM txn_bill_support WHERE bill_for='Supplier' and particular_id='$item_id'");
while($info = mysql_fetch_array($data))
{
	$description=$info["description"];
	$item_rate=0;
	$landing_cost=0;
	$item_qty_p=0;
	$item_qty=0;
	$data2 = mysql_query("SELECT rate,landing_cost,qty_in_piece,qty_in_sft FROM txn_bill_support WHERE bill_for='Supplier' and particular_id='$item_id' and description='$description'");
	while($info2 = mysql_fetch_array($data2))
	{
		$item_rate=$info2["rate"];
		$landing_cost=$info2["landing_cost"];
		$item_qty_p=$info2["qty_in_piece"];
		$item_qty=$info2["qty_in_sft"];
	}
	
	$total_sft=0;
	$total_piece=0;
	$data2 = mysql_query("SELECT sum(qty_in_sft),sum(qty_in_piece) FROM txn_bill_support WHERE bill_for='Supplier' and particular_id='$item_id' and description='$description' order by bill_date desc");
	while($info2 = mysql_fetch_array($data2))
	{
		$total_sft=$info2[0];
		$total_piece=$info2[1];
	}
	$sessing_qty="";
	$sessing_rate="";
	$selling_tran_id="";
	
	$item_name="";
	$data1 = mysql_query("SELECT item_id, item_name FROM items WHERE item_id='$item_id'");
	while($info1 = mysql_fetch_array($data1))
	{
		$item_name=$info1["item_name"];
	}
	
	$rack_id=0;
	

	$rack_name='';
	
	
	$data5 = mysql_query("SELECT mrp,min_stock from stock where flower_name='$item_id' and description='$description'");
	$mrp='';$min_stock=0;
	while($info5 = mysql_fetch_array( $data5 ))
	{
		$mrp=$info5['mrp'];
		$mrp=$info5['mrp'];
		$min_stock=$info5['min_stock'];
			
	}
	
	$c_sessing_qty=0;$c_sessing_qty_p=0;
	
	
	$r_sessing_qty=0;$r_sessing_qty_p=0;
	
	$o_sessing_qty="";
	
	
	$item_rate=number_format($item_rate, 2, '.', '');
	$landing_cost=number_format($landing_cost, 2, '.', '');
	
	
	$cur_stock=$total_sft-($o_sessing_qty+($c_sessing_qty-$r_sessing_qty));
	

	?><tr>
			
			<td><?php echo $item_name?></td>
			  <td><?php echo $info["description"]?><input type='hidden' name='desc' id='desc<?php echo $i?>' value='<?php echo $info["description"]?>'></td>
				
         
    		<td style='background: orange'><?php echo $total_sft?><input type='hidden' name='tot_st<?php echo $i?>' id='tot_st<?php echo $i?>' value='<?php echo $total_sft?>'><input type='hidden' name='selling_tran_id<?php echo $i?>' id='selling_tran_id<?php echo $i?>' value='<?php echo $selling_tran_id?>'></td>
    		<td><?php echo $o_sessing_qty?></td>
    		<td><?php echo $c_sessing_qty-$r_sessing_qty?></td>
    		<td><?php echo $cur_stock?></td>
			<td><?php echo $item_rate?></td>
			<td><?php echo $landing_cost?></td>

<td><input type='text' name='mrp' id='mrp<?php echo $i?>' value='<?php echo $mrp?>'><input type='hidden' name='cost' id='cost<?php echo $i?>' value='<?php echo $landing_cost?>'></td>
	<td><input type='text' name='min' id='min<?php echo $i?>' value='<?php echo $min_stock?>'></td>
	
		<td><select class="form-control select2" name='rack_id' id='rack<?php echo $i?>'  style="padding: 0">
                      <option value='<?php echo $rack_id?>'><?php echo $rack_name?></option>
	    <?php            
                       $data5 = mysql_query("SELECT rack_id, rack_name,rack_status, branch from rack where rack_status='active' and branch='$session_branch'");
                     while($info5 = mysql_fetch_array( $data5 ))
                     {?>	            
	               <option value='<?php echo $info5['rack_id']?>'><?php echo $info5['rack_name']?></option>
	                    <?php }?>                        
                      </select></td>
	
    <?php echo "<td id='button$i'><input type='button' value='Update' onclick='update(".$item_id.",".$i.")'>
         		
         		</td>
					</tr>
			";
$i++;}} echo "</table>";?>
                </div>
               <script type="text/javascript">
				function update(item_id,row)
				{
				
					var desc=document.getElementById("desc"+row).value	
					var mrp=document.getElementById("mrp"+row).value		
					var min=document.getElementById("min"+row).value
					var rack=document.getElementById("rack"+row).value

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
						   document.getElementById("button"+row).innerHTML="Updated";
					     }
					   }
					 var D_PATH=document.getElementById("D_PATH").value
						var DIR=document.getElementById("DIR").value
						
					 xmlhttp.open("GET",D_PATH+"/"+DIR+"/operations/update.php?item_id="+item_id+"&desc="+desc+"&mrp="+mrp+"&min="+min+"&rack="+rack,true);
					 xmlhttp.send();
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
    <script src="<?php echo $UI_ELEMENTS?>plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="<?php echo $UI_ELEMENTS?>plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
  
    <!-- AdminLTE for demo purposes -->
    <?php include_once "$D_PATH/include/scripts_bottom.php";?>
  </body>
</html>
