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


<section class="content">
        
          
            <div class="row">
            <!-- left column -->
              <div class="col-md-2"></div>
            <div class="col-md-12">
            <div>
            
            <!-- /.box -->
              <!-- general form elements -->
              <div class="box box-primary" style="width: 25%;float: left;">
                <div class="box-header">
                  <h3 class="box-title">Add New Category</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
               
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputFullName">Category</label>
                      <input type="text" class="form-control" id="category" name="category" >
                      <span  id='category_v'></span>
                    </div>
                    
				  <div class="form-group">                  
					<button class="btn btn-block btn-success" onclick="addCategory()">Add Category</button>
				  </div>            
                  </div><!-- /.box-body -->                
              </div><!-- /.box -->
              <div class="box box-primary" style="width: 27%;float: left;padding: 5px;">
                <div class="box-header">
                  <h3 class="box-title">Add New Rack</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
               
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputFullName">Rack</label>
                      <input type="text" class="form-control" id="rack" name="rack" >
                      <span  id='rack_v'></span>
                    </div>
                    
				  <div class="form-group">                  
					<button class="btn btn-block btn-success" onclick="addRack()">Add Rack</button>
				  </div>            
                  </div><!-- /.box-body -->                
              </div>
              <div class="box box-primary" style="width: 45%;float: right;">
                <div class="box-header">
                  <h3 class="box-title">Add New Sub Category</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
               
                  <div class="box-body">
                  <div class="form-group" >
                      <label>Category</label>
                      <select class="form-control" name='category_id1' id='category_id1'>
                        <option value=""></option>
                       <?php            
                       $data = mysql_query("SELECT category_id, category_name, category_status, branch from category where category_status='active' and branch='$session_branch'");
                     while($info = mysql_fetch_array( $data ))
                     {?>	            
	               <option value='<?php echo $info['category_id']?>'><?php echo $info['category_name']?></option>
	                    <?php }?>                        
                      </select>
                    </div>
                    <div class="form-group" >
                      <label for="exampleInputFullName">Sub Category</label>
                      <input type="text" class="form-control" id="sub_category" name="sub_category" onfocus="document.getElementById('sub_category_v').innerHTML=''">
                      <span  id='sub_category_v'></span>
                    </div>
                    
				  <div class="form-group">                  
					<button class="btn btn-block btn-success" onclick="sub_addCategory()">Add Sub Category</button>
				  </div>            
                  </div><!-- /.box-body -->     
                  
                          
              </div>
              
              
              
              </div>
          </div><!--/.col (left) -->
          <div class="col-md-2"></div>
          
            
          </div>   <!-- /.row -->
          
                 
        </section>



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
             Edit Items
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php?action=index&c=dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="index.php?action=new&c=items">Items</a></li>
            <li class="active">View Item</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
        
        
        <form role="form" onsubmit="return validate()" action="index.php?action=operations/update_item&c=items" method="POST">
        <input type="hidden" name="itemid" id="itemid" value="<?php echo $_GET["i_id"]?>">
        <?php 
        $category_name="";
        $subcategory_name="";
        $rack_name="";
        $query=mysql_query("select item_name,category,thickness,length,breadth,height,color,waterproof,sub_category_id,rack_id from items where item_id='".$_GET["i_id"]."'");
        while($info=mysql_fetch_array($query))
        {
        	$itemname=$info["item_name"];
        	$thickness=$info["thickness"];
        	$length=$info["length"];
        	$breadth=$info["breadth"];
        	$height=$info["height"];
        	$color=$info["color"];
        	$waterproof=$info["waterproof"];
        	$cid=$info["category"];
        	$subid=$info["sub_category_id"];
        	$rid=$info["rack_id"];
        	if($rid==""){$rid=0;}
        	$query1=mysql_query("select category_name from category where category_id='".$info["category"]."'");
        	while($info2=mysql_fetch_array($query1))
        	{
        		$category_name=$info2["category_name"];
        	}
        
        	$query2=mysql_query("select sub_name from sub_category where sub_cid='".$info["sub_category_id"]."'");
        	while($info3=mysql_fetch_array($query2))
        	{
        		$subcategory_name=$info3["sub_name"];
        	}
        	
        	$query3=mysql_query("select rack_name from rack where rack_id='".$info["rack_id"]."'");
        	while($info4=mysql_fetch_array($query3))
        	{
        		$rack_name=$info4["rack_name"];
        	}
        ?>
        <input type='hidden' name="session_branch" id="session_branch" value="<?php echo $session_branch?>">
          <div class="row">
            <!-- left column -->
            <div class="col-md-3">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Item Details</h3>
                </div>
                
                
                <span id="status"><?php if(isset($_GET["status"])){echo $_GET["status"];}?></span>
                  <div class="box-body">
                    <div class="form-group" id='category_id_v'>
                      <label>Category</label><label style="float: right;"><a href="" class='click'>Add Category</a></label>
                      <select class="form-control" name='category_id' id='category_id' onchange="loadsub_category(this.value);">
                        <option value="<?php echo $cid?>"><?php echo $category_name?></option>
                       <?php            
                       $data = mysql_query("SELECT category_id, category_name, category_status, branch from category where category_status='active' and branch='$session_branch'");
                     while($info = mysql_fetch_array( $data ))
                     {?>	            
	               <option value='<?php echo $info['category_id']?>'><?php echo $info['category_name']?></option>
	                    <?php }?>                        
                      </select>
                    </div>
                    <div class="form-group" id='sub_category_id_v'>
                      <label>Sub Category</label><label style="float: right;"><a href="" class='click'>Add Sub Category</a></label>
                      <select class="form-control" name='sub_category_id' id='sub_category_id'>
                        <option value="<?php echo $subid ?>"><?php echo $subcategory_name?></option>
                                  <?php  $data = mysql_query("SELECT sub_cid, category_id, sub_name, sub_status, branch FROM sub_category where category_id='".$cid."' and branch='".$session_branch."' order by sub_name asc");if($data)while($info = mysql_fetch_array( $data )){?><option  value="<?php echo $info["sub_cid"]?>"><?php echo $info["sub_name"]?></option><?php }?>            
                      </select>
                    </div>
                    
                    <div class="form-group" id="item_name_v">
                      <label for="exampleInputCustomerPlace">Item Name/Type</label>
                      <input type="text" class="form-control" id="item_name" name="item_name" placeholder="Item Name/Type" value="<?php echo $itemname?>"> 
                    </div>
                    
                   
                    <div class="form-group" id='rack_id_v'>
                      <label>Rack</label><label style="float: right;"><a href="" class='click'>Add Rack</a></label>
                      <select class="form-control" name='rack_id' id='rack_id' >
                        <option value="<?php echo $rid?>"><?php echo $rack_name?></option>
                       <?php            
                       $data1 = mysql_query("SELECT rack_id, rack_name,rack_status, branch from rack where rack_status='active' and branch='$session_branch'");
                     while($info1 = mysql_fetch_array( $data1 ))
                     {?>	            
	               <option value='<?php echo $info1["rack_id"]?>'><?php echo $info1['rack_name']?></option>
	                    <?php }?>                        
                      </select>
                    </div>
                    <?php }?>
                      <div class="form-group">                  
					<button type="submit" class="btn btn-block btn-success">Update Item</button>
				  </div>             
                    
                     </form>
                  </div><!-- /.box-body -->

                
            
              </div><!-- /.box -->

             

              
              

            </div><!--/.col (left) -->
            <!-- right column -->
            
            
            
            
            
            <div class="col-xs-9">
             

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
                      
                    <th>Status</th>
                    
                        
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                               
                                  $total=0;
                                  $data = mysql_query("SELECT item_id, item_name, item_status, category, sub_category_id,rack_id,packing FROM items where branch='$session_branch' and item_id='".$_GET["i_id"]."' ORDER BY item_name ASC");
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
                                  	
                                 	
                                  	
                                  	$data6 = mysql_query("SELECT distinct(description) from supplierbill where item_name='".$info["item_id"]."'");
                                  	while($info6 = mysql_fetch_array( $data6 ))
                                  	{
                                  	$item_qty=0;
                                  	$data1 = mysql_query("SELECT sum(item_qty) from supplierbill where item_name='".$info["item_id"]."' and description='".$info6[0]."'");
                                  	while($info1 = mysql_fetch_array( $data1 ))
                                  	{
                                  		$item_qty=$info1[0];
                                  	}
                                  	$rate=0;
                                  	$data1 = mysql_query("SELECT item_rate from supplierbill where item_name='".$info["item_id"]."' and description='".$info6[0]."'");
                                  	while($info1 = mysql_fetch_array( $data1 ))
                                  	{
                                  		$rate=$info1[0];
                                  	}
                                  ?>
                                    <tr>
                                       
                                       
                                        <td><a href="#" class="username"><?php echo $category_name?></a></td>
                                        <td><a href="#" class="username"><?php echo $sub_category_name?></a></td>             
                                         <td><a href="#" class="username"><?php echo $info['item_name']?></a></td>
                                         <td><a href="#" class="username"><?php echo $info6[0]?></a>
                                         <form action='index.php?action=operations/edit_desc&c=items&i_id=<?php echo $_GET["i_id"]?>' method="POST">
                                         <input type='hidden' name='i_id' value="<?php echo $_GET["i_id"]?>">
                                         <input type='hidden' name='desc_old' id='desc_old' value="<?php echo $info6[0]?>">
                                         <input type='text' name='desc' id='desc' value="<?php echo $info6[0]?>">
                                         <input type='submit' value="Update">
                                         </form>
                                         </td>
                                     
                                        <td><span class="label <?php echo $status?>"><?php echo $info['item_status']?></span></td>
                                       </tr>
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
         
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <?php include_once "$D_PATH/include/footer.php";?>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.3 -->
    
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo $UI_ELEMENTS?>bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- DATA TABES SCRIPT -->
    <script src="<?php echo $UI_ELEMENTS?>plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="<?php echo $UI_ELEMENTS?>plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    <!-- SlimScroll -->
    <script src="<?php echo $UI_ELEMENTS?>plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='<?php echo $UI_ELEMENTS?>plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="<?php echo $UI_ELEMENTS?>dist/js/app.min.js" type="text/javascript"></script>
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
