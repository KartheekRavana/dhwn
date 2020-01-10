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
    
   <script type="text/javascript">
				function getData()
				{
					var count=document.getElementById("count").value
					var data="";
					for(var i=1;i<count;i++)
					{
						var item_name=document.getElementById("item_name_"+i).value
						var thickness=document.getElementById("thickness_"+i).value
						var length=document.getElementById("length_"+i).value
						var bredth=document.getElementById("bredth_"+i).value
						var height=document.getElementById("height_"+i).value
						var packing=document.getElementById("packing_"+i).value
						var color=document.getElementById("color_"+i).value
						var waterproof=document.getElementById("waterproof_"+i).value
						var rack_id=document.getElementById("rack_id_"+i).value
						if(item_name!="" && thickness!="" && length!="" && bredth!="" && height!="" && packing!="" && color!="" && waterproof!="" && rack_id!="")
						{
							data=data+"#"+item_name+"//"+thickness+"//"+length+"//"+bredth+"//"+height+"//"+packing+"//"+color+"//"+waterproof+"//"+rack_id+"//";
						} 

					}
					if(document.getElementById("category_id").value==""){alert("Select Category");return false;}
					if(document.getElementById("sub_category_id").value==""){alert("Select SubCategory");return false;}
					document.getElementById("data").value=data
					document.myform.submit();
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
             Add New Items
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php?action=index&c=dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="index.php?action=new&c=items">Items</a></li>
            <li class="active">New Item</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
        
        
        <form role="form" onsubmit="return validate()" name="myform" action="index.php?action=operations/itemsave_bulk&c=items" method="POST">
        
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
                      <label>Sub Category</label><label style="float: right;"><a href="" class='click'>Add Sub Category</a></label>
                      <select class="form-control" name='sub_category_id' id='sub_category_id'>
                        <option value=""></option>
                                             
                      </select>
                    </div>
                    
                    
                    
                      <div class="form-group">                  
					<button type="button" class="btn btn-block btn-success" onclick="getData()">Add Item</button>
				  </div>             
                    
                  </div><!-- /.box-body -->

              </div><!-- /.box -->

            </div><!--/.col (left) -->
            <!-- right column -->
            
            <div class="col-md-9" style="">
              <!-- general form elements -->
              <div class="box box-primary" style="overflow: scroll;height: 100%;position: relative ;">
                <div class="box-header">
                  <h3 class="box-title">Item Details</h3>
                </div>
                
                <script type="text/javascript">
				function copyElements(row)
				{
					var previous=row-1;
					if(document.getElementById("item_name_"+row).value=='')
					{
					document.getElementById("item_name_"+row).value=document.getElementById("item_name_"+previous).value
					document.getElementById("thickness_"+row).value=document.getElementById("thickness_"+previous).value
					document.getElementById("length_"+row).value=document.getElementById("length_"+previous).value
					document.getElementById("bredth_"+row).value=document.getElementById("bredth_"+previous).value
					document.getElementById("height_"+row).value=document.getElementById("height_"+previous).value
					document.getElementById("packing_"+row).value=document.getElementById("packing_"+previous).value
					document.getElementById("color_"+row).value=document.getElementById("color_"+previous).value
					}
				}

                </script>
                <span id="status"><?php if(isset($_GET["status"])){echo $_GET["status"];}?></span>
                  <div class="box-body">
                    <input type="hidden" name="data" id="data">
                     <table id="example1" class="table table-bordered table-striped" style="font-size: 13px">
                    <tr><th>Item Name/Type</th>
                    <!-- <th>Thickness (mm)</th><th>Length (ft)</th><th>Breadth (ft)/ Width</th><th>Height (ft)</th><th>Packing</th><th>Color</th><th>Water Proof</th> -->
                    <th><label>Rack</label><label style="float: right;"><a href="" class='click'>Add Rack</a></label></th></tr>
                    <?php 
                    for($i=1;$i<=100;$i++)
                    {
                    ?>
                    <tr>
                    	<td><input type="text" onfocus="copyElements(<?php echo $i?>)" class="form-control" id="item_name_<?php echo $i?>" name="item_name" placeholder="Item Name/Type" value='' style="padding: 0"></td>
                    	<td><input type="hidden" value="0" class="form-control" id="thickness_<?php echo $i?>" size="2" name="thickness" placeholder="Thickness" onkeypress="return isDecimalNumber(event,this);"  value='' style="padding: 0">
                    	<input type="hidden" value="0" class="form-control" id="length_<?php echo $i?>" size="2" name="length" placeholder="Length" onkeypress="return isDecimalNumber(event,this);"  value='' style="padding: 0">
                    	<input type="hidden" value="0" class="form-control" id="bredth_<?php echo $i?>" size="2" name="bredth" placeholder="Bredth" onkeypress="return isDecimalNumber(event,this);"  value='' style="padding: 0">
                    	<input type="hidden" value="0" class="form-control" id="height_<?php echo $i?>" size="2" name="height" placeholder="Height" onkeypress="return isDecimalNumber(event,this);"  value='' style="padding: 0">
                    	<input type="hidden" value="1" class="form-control" id="packing_<?php echo $i?>" size="2" name="packing" placeholder="qty" onkeypress="return isDecimalNumber(event,this);"  value='' style="padding: 0">
                    	<input type="hidden" value="-" class="form-control" id="color_<?php echo $i?>" name="color" placeholder="Color" value='' style="padding: 0">
                    	<input type="hidden" value="NO" class="form-control" name='waterproof' id='waterproof_<?php echo $i?>' style="padding: 0">
                    	<select class="form-control" name='rack_id' id='rack_id_<?php echo $i?>'  style="padding: 0">
                       
                       <?php            
                       $data1 = mysql_query("SELECT rack_id, rack_name,rack_status, branch from rack where rack_status='active' and branch='$session_branch'");
                     while($info1 = mysql_fetch_array( $data1 ))
                     {?>	            
	               <option value='<?php echo $info1['rack_id']?>'><?php echo $info1['rack_name']?></option>
	                    <?php }?>                        
                      </select></td>
                    	
                    	
                    	</tr>
                    	<?php }?>
                    </table>
                  <input type="hidden" id='count' value="<?php echo $i?>">
                    <div class="form-group" id="height_v">
                      <label for="exampleInputCustomerPlace"></label>
                       
                    </div>
                    
                    <div class="form-group" id="color_v">
                      <label for="exampleInputCustomerPlace"></label>
                      
                    </div>
                    <div class="form-group" id="waterproof_v">
                      <label for="exampleInputCustomerPlace"></label>
                      
                    </div>
                    <div class="form-group" id='rack_id_v'>
                      
                      
                    </div>
                    
                      <div class="form-group">                  
					<button type="submit" class="btn btn-block btn-success">Add Item</button>
				  </div>             
                    
                    
                  </div><!-- /.box-body -->

                
            
              </div><!-- /.box -->

             

              
              

            </div><!--/.col (left) -->
            
            
            
            
            
            
            
            <!--/.col (right) -->
          </div>   <!-- /.row -->
          </form>
        </section><!-- /.content -->
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
