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

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    
    <script type="text/javascript">
	function addCategory()
	{
		var state=1;
		if($("#category").val()==""){$("#category_v").addClass('has-error');state="2";}
		if(state==2){return false;}
		
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
		  if(temp[0]=="Available")
		  {
			  document.getElementById("category_v").innerHTML="<label style='color:green'>Added Successfully</label>";

			  	var combo=document.getElementById("category_id");
	        	var option = document.createElement("option");
		        option.text = category;
		        option.value = temp[1];
		        combo.add(option,null);
		        
		        var combo1=document.getElementById("category_id1");
	        	var option1 = document.createElement("option");
		        option1.text = category;
		        option1.value = temp[1];
		        combo1.add(option1,null);
		  }	  
		  else
		  {
			  document.getElementById("category_v").innerHTML="<label style='color:red'>Item Already Exist</label>";
		  }
		  		
		  }
		}
		
		var D_PATH=document.getElementById("D_PATH").value
		var DIR=document.getElementById("DIR").value
		var category=document.getElementById("category").value
		var session_branch=document.getElementById("session_branch").value
		xmlhttp.open("GET",D_PATH+"/"+DIR+"/load/checkCategory.php?category="+category+"&session_branch="+session_branch,true);
		xmlhttp.send();
	
	}

	function sub_addCategory()
	{
		var state=1;
		if($("#sub_category").val()==""){$("#sub_category_v").addClass('has-error');state="2";}
		if($("#category_id1").val()==""){$("#category_id1_v").addClass('has-error');state="2";}
		if(state==2){return false;}
		
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
		  if(temp[0]=="Available")
		  {
			  document.getElementById("sub_category_v").innerHTML="<label style='color:green'>Added Successfully</label>";

			  	/*var combo=document.getElementById("sub_category_id");
	        	var option = document.createElement("option");
		        option.text = subcategory;
		        option.value = temp[1];
		        combo.add(option,null);*/
		  }	  
		  else
		  {
			  document.getElementById("sub_category_v").innerHTML="<label style='color:red'>Item Already Exist</label>";
		  }
		  		
		  }
		}
		
		var D_PATH=document.getElementById("D_PATH").value
		var DIR=document.getElementById("DIR").value
		var category=document.getElementById("category_id1").value
		var subcategory=document.getElementById("sub_category").value
		var session_branch=document.getElementById("session_branch").value
		xmlhttp.open("GET",D_PATH+"/"+DIR+"/load/checksubCategory.php?&subcategory="+subcategory+"&session_branch="+session_branch+"&category="+category,true);
		xmlhttp.send();
	
	}
    </script>
    
      <script type="text/javascript">
		function validate()
		{			
			var state="1";
			if($("#category_id").val()==""){$("#category_id_v").addClass('has-error');state="2";}
			if($("#sub_category_id").val()==""){$("#sub_category_id_v").addClass('has-error');state="2";}
			if($("#item_name").val()==""){$("#item_name_v").addClass('has-error');state="2";}

			if($("#thickness").val()==""){$("#thickness_v").addClass('has-error');state="2";}
			if($("#length").val()==""){$("#length_v").addClass('has-error');state="2";}
			if($("#bredth").val()==""){$("#bredth_v").addClass('has-error');state="2";}
			if($("#color").val()==""){$("#color_v").addClass('has-error');state="2";}
			if($("#rack_id").val()==""){$("#rack_id_v").addClass('has-error');state="2";}
			
			if(state==2){return false;}
		}


		function loadsub_category(cid)
		{
			removeOptions(document.getElementById("sub_category_id"),status);
			var xmlhttp;
			if (window.XMLHttpRequest)
			{
				xmlhttp=new XMLHttpRequest();
			}
			else
			{
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange=function()
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{
				var status=xmlhttp.responseText;
				
				removeOptions(document.getElementById("sub_category_id"),status);
				var combo1=document.getElementById("sub_category_id");
		    	var option1 = document.createElement("option");
		        option1.text = "";
		        option1.value = "";
		        combo1.add(option1,null);
		        
				var temp=status.split("#");
					for(var i=1;i<=temp.length;i++)
					{
						var t = temp[i].split("::");
						
						 	var combo=document.getElementById("sub_category_id");
				        	var option = document.createElement("option");
					        option.text = t[1];
					        option.value = t[0];
					        combo.add(option,null);
					}
				}
			
			}
			var D_PATH=document.getElementById("D_PATH").value
			var DIR=document.getElementById("DIR").value
			
			xmlhttp.open("GET",D_PATH+"/"+DIR+"/load/getsub_categorys.php?&cid="+cid,true);
			xmlhttp.send();
			}

		function removeOptions(selectbox,status)
		{
		    var i;
		    for(i=selectbox.options.length-1;i>=0;i--)
		    {
		        selectbox.remove(i);
		    }
		    selectbox.innerHTML=status;
		    
		}


		function isDecimalNumber(evt, c)
		{
		    var charCode = (evt.which) ? evt.which : event.keyCode;
		    var dot1 = c.value.indexOf('.');
		    var dot2 = c.value.lastIndexOf('.');

		    if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57))
		        return false;
		    else if (charCode == 46 && (dot1 == dot2) && dot1 != -1 && dot2 != -1)
		        return false;

		    return true;
		}


		function addRack()
		{
			var state=1;
			if($("#rack").val()==""){$("#rack_v").addClass('has-error');state="2";}
			if(state==2){return false;}
			
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
			  if(temp[0]=="Available")
			  {
				  document.getElementById("rack_v").innerHTML="<label style='color:green'>Added Successfully</label>";

				  	var combo=document.getElementById("rack_id");
		        	var option = document.createElement("option");
			        option.text = rack;
			        option.value = temp[1];
			        combo.add(option,null);
			        
			       
			  }	  
			  else
			  {
				  document.getElementById("rack_v").innerHTML="<label style='color:red'>Item Already Exist</label>";
			  }
			  		
			  }
			}
			
			var D_PATH=document.getElementById("D_PATH").value
			var DIR=document.getElementById("DIR").value
			var rack=document.getElementById("rack").value
			var session_branch=document.getElementById("session_branch").value
			xmlhttp.open("GET",D_PATH+"/"+DIR+"/load/addrack_save.php?rack="+rack+"&session_branch="+session_branch,true);
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
<p id="load_data">






</p>
</div>
</div>
</div>   
<!-- ---------------------------------------------------POPUP--------------------------------------------------------------------------- -->      

      <?php include_once "$D_PATH/include/header.php";?> 
      <!-- Left side column. contains the logo and sidebar -->
       <?php include_once "$D_PATH/include/side.php";?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
             View Items
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php?action=index&c=dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="index.php?action=new&c=items">Items</a></li>
            <li class="active">View Item</li>
          </ol>
        </section>
		
		
		<section class="content">
        
        
        <form action="index.php?action=new&c=items" method="post">
        
        
          <div class="row">
            <!-- left column -->
            
            <!-- right column -->
            
            
            
            
            <div class="col-xs-4">
             

              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Items List</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="form-group" >
                      <label>Category</label>
                      <select class="form-control" name='category_id1' id='category_id1' onchange="loadsub_category(this.value);">
                      <?php 
                      if(isset($_POST["category_id1"])) {
                			$data = mysql_query("SELECT category_id,category_name FROM category where category_id='".$_POST["category_id1"]."' and branch='".$session_branch."'");
                			if($data)while($info = mysql_fetch_array( $data )) {?>
                			<option  value="<?php echo $_POST["category_id1"]?>">
                			<?php echo $info["category_name"]?></option><?php 
						}
                	  } 
                ?>
                        <option value=""></option>
                       <?php            
                       $data = mysql_query("SELECT category_id, category_name, category_status, branch from category where category_status='active' and branch='$session_branch'");
                     while($info = mysql_fetch_array( $data ))
                     {?>	            
	               <option value='<?php echo $info['category_id']?>'><?php echo $info['category_name']?></option>
	                    <?php }?>                        
                      </select>
                    </div>
                    <div class="form-group" id='sub_category_id_v'>
                      <label>Sub Category</label>
                      <select class="form-control" name='sub_category_id' id='sub_category_id'>
                         <?php 
                if(isset($_POST["sub_category_id"]))
                {
                	$data = mysql_query("SELECT sub_cid, category_id, sub_name, sub_status, branch FROM sub_category where sub_cid='".$_POST["sub_category_id"]."' and branch='".$session_branch."'");if($data)while($info = mysql_fetch_array( $data )){?><option  value="<?php echo $_POST["sub_category_id"]?>"><?php echo $info["sub_name"]?></option><?php }
                	$data = mysql_query("SELECT sub_cid, category_id, sub_name, sub_status, branch FROM sub_category where category_id='".$_POST["category_id1"]."' and branch='".$session_branch."' order by sub_name asc");if($data)while($info = mysql_fetch_array( $data )){?><option  value="<?php echo $info["sub_cid"]?>"><?php echo $info["sub_name"]?></option><?php }
                }
                ?>
                                             
                      </select>
                    </div>
                </div><!-- /.box-body -->
                <div class="form-group">                  
					<button type="submit" class="btn btn-block btn-success">Get Item List</button>
				  </div>
              </div><!-- /.box -->
            </div>
            
            
            
            
            
            
            <!--/.col (right) -->
          </div>   <!-- /.row -->
          </form>
        </section>
        <!-- Main content -->
        <?php
        	if(isset($_POST['category_id1']) && isset($_POST['sub_category_id'])) {
        ?>
        <section class="content">
        
        
        <form role="form" onsubmit="return validate()" action="index.php?action=operations/itemsave&c=items" method="POST">
        
        <input type='hidden' name="session_branch" id="session_branch" value="<?php echo $session_branch?>">
          <div class="row">
            <!-- left column -->
            
            <!-- right column -->
            
            
            
            
            <div class="col-xs-12">
             

              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Items List</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Category</th>
                        <th>Sub Category</th>         
                        <th>Item Name</th>
                        <th>Description</th>
                        <th>Stock</th>
                        <th>Rate</th>
                        <th>Rack</th>
                      
                    <th>Status</th>
                        <th>Action</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                               
                                  $total=0;
                                  $data = mysql_query("SELECT item_id, item_name, item_status, category, sub_category_id,rack_id,packing FROM items where category='".$_POST['category_id1']."' and sub_category_id='".$_POST['sub_category_id']."' ORDER BY item_name ASC ");
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
                                  	
                                 	
                                  	
                                  	$data6 = mysql_query("SELECT distinct(description) from txn_bill_support where particular_id='".$info["item_id"]."'");
                                  	while($info6 = mysql_fetch_array( $data6 ))
                                  	{
                                  	$item_qty=0;
                                  	$data1 = mysql_query("SELECT sum(qty_in_sft) from txn_bill_support where particular_id='".$info["item_id"]."' and description='".$info6[0]."'");
                                  	while($info1 = mysql_fetch_array( $data1 ))
                                  	{
                                  		$item_qty=$info1[0];
                                  	}
                                  	$rate=0;
                                  	$data1 = mysql_query("SELECT rate from txn_bill_support where particular_id='".$info["item_id"]."' and description='".$info6[0]."'");
                                  	while($info1 = mysql_fetch_array( $data1 ))
                                  	{
                                  		$rate=$info1[0];
                                  	}
                                  ?>
                                    <tr>
                                       
                                       
                                        <td><a href="#" class="username"><?php echo $category_name?></a></td>
                                        <td><a href="#" class="username"><?php echo $sub_category_name?></a></td>             
                                         <td><a href="#" class="username"><?php echo $info['item_name']?></a></td>
                                         <td><a href="#" class="username"><?php echo $info6[0]?></a></td>
                                         <td><a href="#" class="username"><?php echo $item_qty?></a></td>
                                         <td><a href="#" class="username"><?php echo $rate?></a></td>
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
                      <tr>
                        <th>Total Items</th>
                        <th><?php echo $total?></th>
                        <th></th>
                        <th></th>
                      
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
            
            
            
            
            
            
            <!--/.col (right) -->
          </div>   <!-- /.row -->
          </form>
        </section><!-- /.content -->
        <?php }?>
      </div><!-- /.content-wrapper -->
      <?php include_once "$D_PATH/include/footer.php";?>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.3 -->
 
    <!-- AdminLTE for demo purposes -->
    <?php include_once "$D_PATH/include/scripts_bottom.php";?>
    <!-- page script -->
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
  </body>
</html>
