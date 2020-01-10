<?php include_once "$D_PATH/include/session.php";?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
         <?php include_once "$D_PATH/include/title.php";?>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
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
                <input type='hidden' name="action" value="stock_report">
          <input type='hidden' name="c" value="reports">
                <input type="text" style="width: 60%" class="form-control col-md-6" name="barcode" id="barcode" onchange="copyBarcode(this.value)" class="form-control" size='15px' placeholder="Barcode">
                <input type='submit' style="width: 30%" value="Submit" class="form-control col-md-6 btn-warning">
                </form>
       
                <div class="col-xs-12" >
              
             
                
              <div class="box" >
                
                <div class="box-body" >
                 <div class="col-xs-12" style="height: 50px" >
                <form role="form" action="index.php?action=stock_report&c=stock" method="GET">
   <input type='hidden' name="action" value="stock_report">
          <input type='hidden' name="c" value="reports">
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
                <td><select class="form-control select2" style="width: 200px" id="subcategory1" name="subcategory1" onchange="loadItems1(1,this.value)">
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
               
               </table>
               <table>
               <tr>
               <td><input type='date' name='date' class="form-control" value='<?php  if(isset($_GET['date'])){echo $_GET['date'];}else{ echo $date1;}?>'></td>
<td><input type='date' name='date2' class="form-control" value='<?php  if(isset($_GET['date2'])){echo $_GET['date2'];}else{ echo $date1;}?>'></td>
               
               <td><input type='submit' value='Get Report' class='btn btn-block btn-success'></td>
                <td><?php if(isset($_GET["category1"])){?>
                <a target="blank" href="?action=stock_report_print&c=reports&data=&category1=<?php echo $_GET["category1"]?>&subcategory1=<?php echo $_GET["subcategory1"]?>&item_id_11=<?php echo $_GET["item_id_11"]?>&description_11=<?php echo $_GET["description_11"]?>&date=<?php echo $_GET["date"]?>&date2=<?php echo $_GET["date2"]?>"><input type='button' value='Print' class='btn btn-block btn-warning'></a>
                <?php }?>
                </td>
               </tr>
               </table>
               </form>
               </div></div></div>
               
               
                 <div class="col-xs-12">
             

              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Items List</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped" style="font-size: 12px">
                    <thead>
                      <tr>
                        <th>Category</th>
                        <th>Sub Category</th>         
                        <th>Item Name</th>
                        <th>Description</th>
                        <th>Purchase</th>
                        <th>Sales</th>
                         <th>Current Stock</th>
                         <th>L Cost</th>
                        <th>Rack</th>
                      
                    <th>Status</th>
                        <th>Action</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                      <?php if(isset($_GET["description_11"]) || isset($_GET["barcode"]))
                      {
                      	
                      	if(isset($_GET["description_11"])){
                               $desc=$_GET["description_11"];
                               $item_id=$_GET["item_id_11"];
                      	}else{
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
					$desc=$info1["description"];
				}
				
                      	}
                               
                               
                               
                                  $total=0;
                                  $date_filter="";
                                  $data = mysql_query("SELECT item_id, item_name, item_status, category, sub_category_id,rack_id,packing FROM items where item_id='".$item_id."' ORDER BY item_name ASC");
                                  while($info = mysql_fetch_array( $data ))
                                  {
                                  	
                                  	if($info['item_status']=="active")
                                  		$status="label-success";
                                  	else
                                  		$status="label-danger";
                                  	
                                  	$category_name="";
                                  	$sub_category_name="";
                                  	$rack_name="";
                                  	$data1 = mysql_query("SELECT category_name from category where category_id='".$info["category"]."'");
                                  	while($info1 = mysql_fetch_array( $data1 ))
                                  	{
                                  		$category_name=$info1["category_name"];
                                  	}
                                  	$data1 = mysql_query("SELECT sub_cid, category_id, sub_name, sub_status, branch from sub_category where sub_cid='".$info["sub_category_id"]."'");
                                  	while($info1 = mysql_fetch_array( $data1 ))
                                  	{
                                  		$sub_category_name=$info1["sub_name"];
                                  	}                                  	
                                  	$data1 = mysql_query("SELECT rack_name from rack where rack_id='".$info["rack_id"]."'");
                                  	while($info1 = mysql_fetch_array( $data1 ))
                                  	{
                                  		$rack_name=$info1["rack_name"];
                                  	}
                                  	
                                 	$item_id=$info["item_id"];
                                  
                                  	$data6 = mysql_query("SELECT distinct(description) as description from txn_bill_support where particular_id='".$item_id."' and description like '%".$desc."%'");
                                  	while($info6 = mysql_fetch_array( $data6 ))
                                  	{
                                  	
                                  		
                                  		$total_piece=0;
	$data2 = mysql_query("SELECT sum(qty_in_sft),sum(qty_in_piece) FROM txn_bill_support WHERE particular_id='$item_id' and bill_for='Supplier' and bill_type='Cash' and description='".$info6["description"]."' $date_filter");
	while($info2 = mysql_fetch_array($data2))
	{
		$total_sft=$info2[0];
		$total_piece=$info2[1];
	}
	
   $data2 = mysql_query("SELECT sum(qty_in_sft),sum(qty_in_piece) FROM txn_bill_support WHERE particular_id='$item_id' and bill_for='Supplier' and bill_type='Credit' and description='".$info6["description"]."' $date_filter");
	while($info2 = mysql_fetch_array($data2))
	{
		$total_sft=$total_sft=$info2[0];
		$total_piece=$total_piece=$info2[1];
	}
	
	
	$return_total_sft=0;
	$return_total_piece=0;
	$data2 = mysql_query("SELECT sum(qty_in_sft),sum(qty_in_piece) FROM txn_bill_support WHERE particular_id='$item_id' and bill_for='Supplier' and bill_date>'2017-04-24' and bill_type like '%return%' and description='".$info6["description"]."' $date_filter");
	while($info2 = mysql_fetch_array($data2))
	{
		$return_total_sft=$info2[0];
		$return_total_piece=$info2[1];
	}
	
	
	$total_sft=$total_sft-$return_total_sft;
	$total_piece=$total_piece-$return_total_piece;
              $c_sessing_qty=0;$c_sessing_qty_p=0;
              $data2 = mysql_query("SELECT sum(qty_in_sft),sum(qty_in_piece) FROM txn_bill_support WHERE particular_id='$item_id' and bill_for='Customer' and bill_type='Cash' and description='".$info6["description"]."' $date_filter");
              while($info2 = mysql_fetch_array($data2))
              {
              	$c_sessing_qty=$info2[0];
              	$c_sessing_qty_p=$info2[1];
              
              }
              $data2 = mysql_query("SELECT sum(qty_in_sft),sum(qty_in_piece) FROM txn_bill_support WHERE particular_id='$item_id' and bill_for='Customer' and bill_type='Credit' and description='".$info6["description"]."' $date_filter");
              while($info2 = mysql_fetch_array($data2))
              {
              	$c_sessing_qty=$c_sessing_qty+$info2[0];
              	$c_sessing_qty_p=$c_sessing_qty_p+$info2[1];
              
              }
              
              $ledger_qty=0;$ledger_qty_p=0;
              
              
              $r_sessing_qty=0;$r_sessing_qty_p=0;
              $data2 = mysql_query("SELECT sum(qty_in_sft),sum(qty_in_piece) FROM txn_bill_support WHERE particular_id='$item_id' and bill_for='Customer' and bill_type like '%return%' and description='".$info6["description"]."' $date_filter");
              while($info2 = mysql_fetch_array($data2))
              {
              	$r_sessing_qty=$info2[0];
              	$r_sessing_qty_p=$info2[1];
              
              }
              
              
              $o_sessing_qty=0;
                                  
              $data2 = mysql_query("SELECT sum(remaining_qty) FROM stock WHERE flower_name='$item_id' and description='".$info6["description"]."'");
              while($info2 = mysql_fetch_array($data2))
              {
              	$o_sessing_qty=$info2[0];
              }
             
              $cur_stock=($total_sft)-($o_sessing_qty+($c_sessing_qty-$r_sessing_qty));
                               
  			$total=$total+$cur_stock; 	
                                 $purchase=$purchase+$total_sft;
                                 $sales=$sales+($o_sessing_qty+($c_sessing_qty-$r_sessing_qty));

                                 $landing_cost=0;
                                 
                                 $data8 = mysql_query("SELECT landing_cost,bill_date FROM txn_bill_support WHERE description='".$info6["description"]."' and bill_for='Supplier' ORDER BY sk_tran_id desc limit 1 ");
                                 while($info8 = mysql_fetch_array($data8))
                                 {
                                 	$landing_cost=$info8["landing_cost"];
                                 }
                                  ?>
                                    <tr>
                                       
                                       
                                        <td><a href="#" class="username"><?php echo $category_name?></a></td>
                                        <td><a href="#" class="username"><?php echo $sub_category_name?></a></td>             
                                         <td><a href="#" class="username"><?php echo $info['item_name']?></a></td>
                                         <td><a href="#" class="username"><?php echo $info6[0]?></a></td>
                                         
                                           <td><a href="#" class="username"><?php echo $total_sft?></a></td>
                                             <td><a href="#" class="username"><?php echo ($o_sessing_qty+($c_sessing_qty-$r_sessing_qty))?></a></td>
                                           
                                         <td><a href="#" class="username"><?php echo $cur_stock?></a></td>
                                         <td><a href="#" class="username"><?php echo $landing_cost?></a></td>
                                        
                                         <td><a href="#" class="username"><?php echo $rack_name?></a></td>
                                                                       
                                        <td><span class="label <?php echo $status?>"><?php echo $info['item_status']?></span></td>
                                        <td><a href='index.php?action=Edit_items&c=items&i_id=<?php echo $info['item_id']?>' title='Update <?php echo $info['item_name']?> Details'><span class="label label-warning">Edit</span></a>
                                       
                                        <?php if($info['item_status']=='active'){?>
                                        <a href='index.php?action=operations/ban&c=items&e_id=<?php echo $info['item_id']?>'><span class="label label-danger" title="Ban <?php echo $info['item_name']?>">Ban</span></a>
                                    	<?php }else if($info['item_status']=='banned'){?>
                                    	<a href='index.php?action=operations/active&c=items&e_id=<?php echo $info['item_id']?>'><span class="label label-primary">Activate</span></a>
                                    	<?php }?>
                                    </td></tr>
                                   <?php }}?>
                    </tbody>
                    <tfoot>
                      <tr> <th></th> <th></th> <th></th>
                        <th>Total Items</th><th><?php echo $purchase?></th><th><?php echo $sales?></th>
                        <th><?php echo $total?></th>
                        <th></th>
                        <th></th>
                      
                      </tr>
                    </tfoot>
                  </table>
                  <?php }?>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
            
                 
                
                
                
                
                
                
                
                
                
                 </div>
                 
                 </div>
               
             
           
           
           
              
          
          
                  
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

  <!-- Control Sidebar -->
 
 
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
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
   
</body>
</html>