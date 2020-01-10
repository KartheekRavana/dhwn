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
                        <input type='hidden' class='form-control' id='description_1' name='description_1'>
                       
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
	document.getElementById("description_1").value=document.getElementById("description_11").value
	
	
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
              
                <form role="form" action="index.php?action=barcode&c=stock" method="GET">
   <input type='hidden' name="action" value="barcode">
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
               <td><input type='text' class="form-control" value="<?php if(isset($_GET["description_11"])){echo $_GET["description_11"];}?>" id="description_11" name="description_11" style="width: 150px">
                </td>
               
               </tr>
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
                	$desc=$_GET["description_11"];
echo "<table id='example1' class='table table-bordered table-striped' style='font-size:13px'><thead><tr><th>Bill&nbsp;Date&nbsp;&nbsp;</th><th>Item&nbsp;Name</th><th>Description</th><th style='background: yellow'>Pcs</th><th style='background: yellow'>Sft</th><th style='background: orange'>T&nbsp;Pcs</th><th style='background: orange'>T&nbsp;Sft</th><th>P&nbsp;Cost</th><th>L&nbsp;Cost</th><th>Cur&nbsp;Stock</th><th>Billing</th><th>Selling&nbsp;Stock</th><th>Mrp</th><th>Rack</th><th>Action</th></thead></tr>";
$data = mysql_query("SELECT sk_tran_id, qty_in_piece, qty_in_sft,bill_date, particular_id, rate, description,landing_cost FROM txn_bill_support WHERE particular_id='$item_id' and description like '%$desc%'");
while($info = mysql_fetch_array($data))
{
	$description=$info["description"];
	$total_sft=0;
	$total_piece=0;
	$data2 = mysql_query("SELECT sum(qty_in_piece),sum(qty_in_sft) FROM txn_bill_support WHERE particular_id='$item_id' and description='$description' order by bill_date desc");
	while($info2 = mysql_fetch_array($data2))
	{
		$total_sft=$info2[0];
		$total_piece=$info2[1];
	}
	$sessing_qty="";
	$sessing_rate="";
	$selling_tran_id="";
	$data2 = mysql_query("SELECT qty_in_sft,rate,sk_tran_id FROM txn_bill_support WHERE particular_id='$item_id' and description='$description' order by bill_date desc");
	while($info2 = mysql_fetch_array($data2))
	{
		$sessing_qty=$info2["qty_in_sft"];
		$sessing_rate=$info2["rate"];
		$selling_tran_id=$info2["sk_tran_id"];
	}
	$c_sessing_qty=0;$c_sessing_qty_p=0;
	$data2 = mysql_query("SELECT sum(qty_in_sft),sum(qty_in_piece) FROM txn_bill_support WHERE particular_id='$item_id' and description='$description' order by bill_date desc");
	while($info2 = mysql_fetch_array($data2))
	{
		$c_sessing_qty=$info2[0];
		$c_sessing_qty_p=$info2[1];
		
	}
	
	$item_name="";
	$data1 = mysql_query("SELECT item_id, item_name FROM items WHERE item_id='$item_id'");
	while($info1 = mysql_fetch_array($data1))
	{
		$item_name=$info1["item_name"];
	}
	
	$rack_id=0;
	/*$data5 = mysql_query("SELECT rack_id from txn_bill_support where item_name='$item_id' and description='$description' and rack_id!=''");
	$mrp='';
	while($info5 = mysql_fetch_array( $data5 ))
	{
		$rack_id=$info5['rack_id'];
		 
	}*/
	

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
	if($landing_cost>0){
	echo "<tr>
			<td>$bill_date</td>
			<td>$item_name</td>
			  <td>". $info["description"]."</td>
			<td style='background: yellow'>". $info["qty_in_piece"]."</td>
			 <td style='background: yellow'>". $info["qty_in_sft"]."</td>
    		<td style='background: orange'>". $total_piece."</td>
         
    		<td style='background: orange'>". $total_sft."<input type='hidden' name='tot_st$i' id='tot_st$i' value='$total_sft'><input type='hidden' name='selling_tran_id$i' id='selling_tran_id$i' value='$selling_tran_id'></td>
			<td>". $item_rate."</td>
			<td>". $landing_cost."</td>
			<td><input type='text' name='stock' id='cur_stock$i' value='' onblur='calSelling($i)'>$cur_stock</td>
			<td><input type='text' name='stock' id='bill_stock$i' value='$c_sessing_qty' onblur='calSelling($i)'></td>
<td><input type='text' name='stock' id='stock$i' value='$sessing_qty' readonly='readonly'></td>
<td><input type='text' name='mrp' id='mrp$i' value='$mrp'><input type='hidden' name='cost' id='cost$i' value='$landing_cost'></td>";
	
	?>
		<td><select class="form-control select2" name='rack_id' id='rack<?php echo $i?>'  style="padding: 0">
                      <option value='<?php echo $rack_id?>'><?php echo $rack_name?></option>
	    <?php            
                       $data5 = mysql_query("SELECT rack_id, rack_name,rack_status, branch from rack where rack_status='active'");
                     while($info5 = mysql_fetch_array( $data5 ))
                     {?>	            
	               <option value='<?php echo $info5['rack_id']?>'><?php echo $info5['rack_name']?></option>
	                    <?php }?>                        
                      </select></td>
	
    <?php echo "<td><input type='button' value='Print Bracode' class='click' onclick='printQty(".$info["qty_in_sft"].",".$tran_id.",".$item_id.",".$i.")'>
         		
         		</td>
					</tr>
			";
$i++;}}} echo "</table>";?>
                </div>
               <script type="text/javascript">
				function calSelling(row)
				{
					var bill=0;
					if(document.getElementById("bill_stock"+row).value!='')
					{
					bill=parseInt(document.getElementById("bill_stock"+row).value)
					}
					document.getElementById("stock"+row).value=(parseFloat(document.getElementById("tot_st"+row).value))-(parseFloat(document.getElementById("cur_stock"+row).value)+bill)
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
    <!-- jQuery 2.1.3 -->
    <script src="<?php echo $UI_ELEMENTS?>plugins/select2/select2.full.min.js" type="text/javascript"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo $UI_ELEMENTS?>bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='<?php echo $UI_ELEMENTS?>plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="<?php echo $UI_ELEMENTS?>dist/js/app.min.js" type="text/javascript"></script>
    <!-- AdminLTE for demo purposes -->
    <?php include_once "$D_PATH/include/scripts_bottom.php";?>
  </body>
</html>
