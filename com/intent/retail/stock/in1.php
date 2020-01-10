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

    function totalSft(count)
    {
    	var qty=document.getElementById("qty_sft"+count).value;
    	var sft=document.getElementById("qty_piece"+count).value;
    	document.getElementById("t_sft"+count).value=(qty*sft);
    }
    function calCost(count)
    {
    var qty=document.getElementById("qty_sft"+count).value;
    var sft=document.getElementById("t_sft"+count).value;
    var cost=document.getElementById("cost"+count).value;
    //alert(qty)
    document.getElementById("fcost"+count).value=(sft)*cost;

    	var tcount=document.getElementById("count").value;
    	var total=0;
    	for(var i=1;i<tcount;i++)
    	{
    	if(document.getElementById("fcost"+i).value!="")
    	{
    	total=total+(parseInt(document.getElementById("fcost"+i).value));
    	}
    }

    document.getElementById("grand_total").value=total;
    }
    
    function calFinalCost()
    {  
    	var total=document.getElementById("grand_total").value;
    	var exp=document.getElementById("other_expenses").value;
    	var hamali=document.getElementById("hamali_expenses").value;
    	var t_exp=document.getElementById("transport_expenses").value;
    	if(hamali==''){hamali=0;}	
    	if(total==''){total=0;}
    	if(exp==''){exp=0;}
    	if(t_exp==''){t_exp=0;}
    	t_exp=parseFloat(t_exp)+parseFloat(hamali);
    	document.getElementById("total").value=parseFloat(exp)+parseFloat(t_exp)+parseFloat(total);
    	var tcount=document.getElementById("count").value;
    	var total=0;
    	var total_qty=0;
    	for(var i=1;i<tcount;i++)
    	{
    		if(document.getElementById("t_sft"+i).value!="")
    		{
    		total_qty=total_qty+parseInt(document.getElementById("t_sft"+i).value);
    		}
    	}
    	var miss_cost=exp+t_exp;

    	var cost_unit=(parseFloat(exp)+parseFloat(t_exp))/total_qty;
    	//alert(miss_cost+"/"+total_qty)
    	for(var i=1;i<tcount;i++)
    	{
    		
    		if(document.getElementById("fcost"+i).value!="")
    		{
    			
    			document.getElementById("lcost"+i).value=((parseFloat(document.getElementById("cost"+i).value)+cost_unit));
    			document.getElementById("tlcost"+i).value=parseFloat(document.getElementById("lcost"+i).value)*parseInt(document.getElementById("t_sft"+i).value);
    		/*document.getElementById("lcost"+i).value=parseInt(document.getElementById("total").value)/parseInt(document.getElementById("qty"+i).value);
    		document.getElementById("tlcost"+i).value=(parseInt(document.getElementById("total").value)/parseInt(document.getElementById("qty"+i).value))*parseInt(document.getElementById("qty"+i).value);*/
    		}
    	}
    }
    </script>
    <script type="text/javascript">
		function validate()
		{			
			var state="1";
			if($("#bill_no").val()==""){$("#bill_no_v").addClass('has-error');state="2";}
			if($("#bill_date").val()==""){$("#bill_date_v").addClass('has-error');state="2";}
			
			if($("#supplier_name").val()==""){$("#supplier_name_v").addClass('has-error');state="2";}
			if($("#mobile").val()==""){$("#mobile_v").addClass('has-error');state="2";}
			if($("#place").val()==""){$("#place_v").addClass('has-error');state="2";}
			  
			if($("#other_expenses").val()==""){$("#other_expenses_v").addClass('has-error');state="2";}
			if($("#transport_expenses").val()==""){$("#transport_expenses_v").addClass('has-error');state="2";}
			if($("#hamali_expenses").val()==""){$("#hamali_expenses_v").addClass('has-error');state="2";}
			
			var data="";
			var count=document.getElementById("count").value;
			for(var i=1;i<count;i++)
			{
				var category=$("#category1").val();
				var item=$("#item"+i).val();
				var qty_piece=$("#qty_piece"+i).val();
				var qty_sft=$("#qty_sft"+i).val();
				var cost=$("#cost"+i).val();
				var fcost=$("#fcost"+i).val();
				var lcost=$("#lcost"+i).val();
				var tlcost=$("#tlcost"+i).val();
				var subid=$("#subcategory1").val();

				if(category!="" && item!="" && qty_piece!="" && qty_sft!="" && cost!="" && fcost!="" && lcost!="" && tlcost!="" && subid!="")
				{
					data=data+"//"+category+"#"+item+"#"+qty_piece+"#"+qty_sft+"#"+cost+"#"+fcost+"#"+lcost+"#"+tlcost+"#"+subid;
				}
				
				
			}
			
			if(data=="")
			{
				alert("No Data To Submit");
				state="2";
			}
			document.getElementById("data").value=data
			if(state==2){return false;}
			var result = confirm("Are Your Sure, Want to Create Bill?");
			if (result) {
				return true;
			}else{return false;}
			
		
		}
		
        </script>
    
       <script type="text/javascript">
function loadItems(row,val)
{
  
	var category=document.getElementById("category"+row).value;
	document.getElementById("subcategory"+row).options.length = 0;
	 

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
  
	/*var category=document.getElementById("category"+row).value;
	document.getElementById("item"+row).options.length = 0;
	 

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
		
		for(var j=1;j<=temp1;j++)
		{
			 var temp2=temp[j].split("//");
			
			document.getElementById("item"+row).options[j]=new Option(temp2[1],temp2[0]);
			
		    }
	     }
	   }

	 var D_PATH=document.getElementById("D_PATH").value
		var DIR=document.getElementById("DIR").value
		
	 xmlhttp.open("GET",D_PATH+"/"+DIR+"/load/getItems.php?category="+category,true);
	 xmlhttp.send();*/
	 var cid=document.getElementById("category1").value;
	 var sid=document.getElementById("subcategory1").value;
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
			
		   document.getElementById("items_load").innerHTML=xmlhttp.responseText;
	     }
	   }

	 var D_PATH=document.getElementById("D_PATH").value
		var DIR=document.getElementById("DIR").value
		
	 xmlhttp.open("GET",D_PATH+"/"+DIR+"/load/loaditems.php?&category="+cid+"&subcategoryid="+sid,true);
	 xmlhttp.send();



	}

</script>
     <script type="text/javascript">
	function subshowonlyonev1(thechosenone,row) {
			
			for(var j=5;j<=row;j++)
			{
				 document.getElementById("sub"+j).innerHTML='';
				
			}
		      var newboxes = document.getElementsByTagName("tr");
		      var id=0;
		      for(var x=0; x<newboxes.length; x++) {
		            name = newboxes[x].getAttribute("name");          
		            if (name == thechosenone) {
		                  if (newboxes[x].id == thechosenone) {
		                        if (newboxes[x].style.visibility == '') {
		                              newboxes[x].style.visibility = 'hidden';
		                              newboxes[x].style.position='absolute';
		                        }
		                        else {
		                              newboxes[x].style.visibility = '';
		                              newboxes[x].style.position='relative';
		                            
		                        }
		                  }else {
		                        newboxes[x].style.visibility = 'hidden';
		                        newboxes[x].style.position='absolute';
		                  }
		            }
		      }
		}

	function subshowonlyonev2(thechosenone,row) {
		
	
	      var newboxes = document.getElementsByTagName("tr");
	      var id=0;
	      for(var x=0; x<newboxes.length; x++) {
	            name = newboxes[x].getAttribute("name");          
	            if (name == thechosenone) {
	                  if (newboxes[x].id == thechosenone) {
	                        if (newboxes[x].style.visibility == '') {
	                              newboxes[x].style.visibility = 'hidden';
	                              newboxes[x].style.position='absolute';
	                        }
	                        else {
	                              newboxes[x].style.visibility = '';
	                              newboxes[x].style.position='relative';
	                            
	                        }
	                  }else {
	                        newboxes[x].style.visibility = 'hidden';
	                        newboxes[x].style.position='absolute';
	                  }
	            }
	      }
	}



	function getSupplier(supplier_id)
	{
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
		
		  		document.getElementById("place").value=temp[1];
		  		document.getElementById("mobile").value=temp[2];
		  }
		}

		 var D_PATH=document.getElementById("D_PATH").value
			var DIR=document.getElementById("DIR").value
		xmlhttp.open("GET",D_PATH+"/"+DIR+"/load/supplierdetails.php?supplier_id="+supplier_id,true);
		xmlhttp.send();

	}
		</script>
		
		
		
		
		
		
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

		        for(i=1;i<=50;i++)
		        {
		        	var combo=document.getElementById("category"+i);
		        	var option = document.createElement("option");
			        option.text = category;
			        option.value = temp[1];
			        combo.add(option,null);
		        }
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
		xmlhttp.open("GET",D_PATH+"/items/load/checkCategory.php?category="+category+"&session_branch="+session_branch,true);
		xmlhttp.send();
	
	}


	function addItem()
	{
		var state=1;
		if($("#category_id").val()==""){$("#category_id_v").addClass('has-error');state="2";}
		if($("#item_name").val()==""){$("#item_name_v").addClass('has-error');state="2";}
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
			  document.getElementById("category_id_v").innerHTML="<label style='color:green'>Added Successfully</label>";

			 
		  }	  
		  else
		  {
			  document.getElementById("category_id_v").innerHTML="<label style='color:red'>Item Already Exist</label>";
		  }
		  		
		  }
		}
		
		var D_PATH=document.getElementById("D_PATH").value
		var DIR=document.getElementById("DIR").value
		var category=document.getElementById("category_id").value
		var item_name=document.getElementById("item_name").value
		var session_branch=document.getElementById("session_branch").value
		xmlhttp.open("GET",D_PATH+"/items/load/checkItem.php?category="+category+"&item_name="+item_name+"&session_branch="+session_branch,true);
		xmlhttp.send();
	
	}


	function getitem_name(col)
	{
		var count=document.getElementById("count").value
		
		for(var i=1;i<count;i++)
		{
			if(document.getElementById("item"+i).value=="")
			{
				document.getElementById("item"+i).value=document.getElementById("item_"+col).value;
				document.getElementById("qty_piece"+i).value=document.getElementById("sft_"+col).value;
				document.getElementById("qty_sft"+i).style.borderColor = "Red";
				document.getElementById("qty_sft"+i).focus();
				return false;
			}
		}
	}
    </script>
    
    
  </head>
  <body class="skin-red fixed" onload="callme('success//hello')">
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
             
            <div class="col-md-6">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Add New Category</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
               
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputFullName">Category</label>
                      <input type="text" class="form-control" id="category" name="category" onfocus="document.getElementById('category_v').innerHTML=''">
                      <span  id='category_v'></span>
                    </div>
                    
				  <div class="form-group">                  
					<button class="btn btn-block btn-success" onclick="addCategory()">Add Category</button>
				  </div>            
                  </div><!-- /.box-body -->                
              </div><!-- /.box -->
          </div><!--/.col (left) -->
          
          <div class="col-md-6">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Item Details</h3>
                </div>
                
                
                <span id="status"><?php if(isset($_GET["status"])){echo $_GET["status"];}?></span>
                  <div class="box-body">
                    <div class="form-group" id='category_id_v'>
                      <label>Category</label><label style="float: right;"></label>
                      <select class="form-control" name='category_id' id='category_id'>
                        <option value=""></option>
                       <?php            
                       $data = mysql_query("SELECT category_id, category_name, category_status, branch from category where category_status='active' and branch='$session_branch'");
                     while($info = mysql_fetch_array( $data ))
                     {?>	            
	               <option value='<?php echo $info['category_id']?>'><?php echo $info['category_name']?></option>
	                    <?php }?>                        
                      </select>
                    </div>
                    
                    
                    <div class="form-group" id="item_name_v">
                      <label for="exampleInputCustomerPlace">Item Name</label>
                      <input type="text" class="form-control" id="item_name" name="item_name" placeholder="Item Name" value=''> 
                    </div>
                    
                      <div class="form-group" >                  
					<button class="btn btn-block btn-success" onclick="addItem()">Add Item</button>
				  </div>             
                    
                    
                  </div><!-- /.box-body -->

                
            
              </div><!-- /.box -->

             

              
              

            </div>
        
          
            
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
        
          <section class="content">
          
          <form role="form" onsubmit="return validate()" action="index.php?action=operations/in_save&c=stock" method="POST">
          <input type='hidden' name="session_branch" id="session_branch" value="<?php echo $session_branch?>">
          <input type='hidden' id='data' name='data'>
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
               
                <!-- form start -->
                <br/>
                <table>
                <tr>
                	<td>Bill&nbsp;No</td><td id='bill_no_v'><input type="text" class="form-control onlyNumbers" id="bill_no" name="bill_no"></td><td>&nbsp;&nbsp;</td>
                	<td>Bill&nbsp;Date</td><td id='bill_date_v'><input type="date" class="form-control" id="bill_date" name="bill_date" value="<?php echo $date?>" size="9"></td><td>&nbsp;&nbsp;</td>
                	
           			<td>Supplier&nbsp;Name</td><td id='supplier_name_v'><select class="form-control" id="supplier_name" name="supplier_name" onchange="getSupplier(this.value)"  data-trigger="change" data-required="true" class="span10">
	               <option value=""></option>
	                <?php 
                                   
                                  $data = mysql_query("SELECT supplier_id,nick_name,supplier_name FROM supplier where supplier_status='active' and branch='$session_branch' order by nick_name asc");
                                  if($data)
                                  while($info = mysql_fetch_array( $data ))
                                  {
                                  ?>  
	               <option  value="<?php echo $info["supplier_id"]?>"><?php echo $info["supplier_name"]?></option>
	               <?php }?>
	               </select></td><td>&nbsp;&nbsp;</td>
                	<td>Mobile</td><td id='mobile_v'><input type="text" class="form-control onlyNumbers" id="mobile" name="mobile"></td><td>&nbsp;&nbsp;</td>
                	<td>Place</td><td id='place_v'><input type="text" class="form-control" id="place" name="place"></td><td>&nbsp;&nbsp;</td>
                
                </tr>
                </table><br/>
                </div>
                </div>
                
                <div class="col-xs-4" >
             

              <div class="box" >
                
                <div class="box-body" >
                </br>
                <table style="width: 96%;margin-left: 2%">
                <tr><th>Category<a href="" class='click'>+</a></th><td>&nbsp;&nbsp;</td>
               <th>Sub Category<a href="" class='click'>+</a></th><th></th></tr>
               <tr>
                
                <td><select class="form-control" id="category1" name="category1" onchange="loadItems(1,this.value)"><option value=""></option><?php $data = mysql_query("SELECT category_id,category_name FROM category where category_status='active' and branch='".$session_branch."'");if($data)while($info = mysql_fetch_array( $data )){?><option  value="<?php echo $info["category_id"]?>"><?php echo $info["category_name"]?></option><?php }?></select></td>
                <td>&nbsp;&nbsp;</td>
                <td><select class="form-control" id="subcategory1" name="subcategory1" onchange="loadItems1(1,this.value)"><option value=""></option></select></td></tr>
               <td>&nbsp;&nbsp;&nbsp;</td>
               </table>
                <div id="items_load" style="height: 50%;overflow:auto;"></div>
                </div>
                </div>
                </div>
           
            
             <div class="col-xs-8">
             

              <div class="box">
                
                <div class="box-body" style="height: 500px;overflow: scroll;">
           
                <br/>
                <table style="width: 96%;margin-left: 2%">
                <tr><th></th><td>&nbsp;&nbsp;</td><th></th><td>&nbsp;&nbsp;</td>
               <th></th><td>&nbsp;&nbsp;</td>
                <th>Items&nbsp;&nbsp;&nbsp;<a href="" class='click'>+</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th><td>&nbsp;&nbsp;</td>
                <td></td><td></td><th>In&nbsp;Piece</th><td>&nbsp;&nbsp;</td><th>&nbsp;Sft/Box</th><td>&nbsp;&nbsp;</td><th>Cost</th><td>&nbsp;&nbsp;</td><th>Final Cost</th>
                <td>&nbsp;&nbsp;</td><th>Lan Cost</th><td>&nbsp;&nbsp;</td><th>Tot&nbsp;Lan&nbsp;Cost</th></tr>
                <?php 
                for($i=1;$i<=50;$i++)
                {
                ?>
                <tr>
                <td><?php echo $i?></td><td>&nbsp;&nbsp;</td>
                <td><input type="hidden" class="form-control" id="category<?php echo $i?>" name="category<?php echo $i?>" onchange="loadItems(<?php echo $i?>,this.value)"></td><td>&nbsp;&nbsp;</td>
                <td><input type="hidden" class="form-control" id="subcategory<?php echo $i?>" name="subcategory<?php echo $i?>" onchange="loadItems1(<?php echo $i?>,this.value)"></td><td>&nbsp;&nbsp;</td>
                <td><input type="text" class="form-control" id="item<?php echo $i?>" name="item<?php echo $i?>"></td><td>&nbsp;&nbsp;</td>
                <td><input type="hidden" class="form-control onlyNumbers" id="qty_piece<?php echo $i?>" name="qty_piece<?php echo $i?>" size="5" value="0"></td><td>&nbsp;&nbsp;</td>
                <td><input type="text" class="form-control" onkeypress="return isNumberKey(event)" id="qty_sft<?php echo $i?>" name="qty_sft<?php echo $i?>" size="3" onblur="totalSft(<?php echo $i?>)"></td><td>&nbsp;&nbsp;</td>
                <td><input type="text" class="form-control onlyNumbers" id="t_sft<?php echo $i?>" name="t_sft<?php echo $i?>" size="5" value=""></td><td>&nbsp;&nbsp;</td>
                <td><input type="text" class="form-control" onkeypress="return isNumberKey(event)" id="cost<?php echo $i?>" name="cost<?php echo $i?>" size="5" onblur="calCost(<?php echo $i?>)"></td><td>&nbsp;&nbsp;</td>
                <td><input type="text" class="form-control" id="fcost<?php echo $i?>" name="fcost<?php echo $i?>" size="5" readonly="readonly"></td><td>&nbsp;&nbsp;</td>
                <td><input type="text" class="form-control" id="lcost<?php echo $i?>" name="lcost<?php echo $i?>" size="5" readonly="readonly"></td><td>&nbsp;&nbsp;</td>
                <td><input type="text" class="form-control" id="tlcost<?php echo $i?>" name="tlcost<?php echo $i?>" size="5" readonly="readonly"></td><td>&nbsp;&nbsp;</td>
                </tr>
                <tr><td>&nbsp;</td></tr>
                <?php }?>
                
                </table>
                  <input type='hidden' name='count' id='count' value="<?php echo $i?>">
                  
                  
 
              </div>
        
            </div>
           
            
          </div>  
          
          <div class="col-xs-12">
             

              <div class="box">
                
                <div class="box-body">
           
                <br/>
                
                  <input type='hidden' name='count' id='count' value="<?php echo $i?>">
                  <table>
	             <tr><td>Total&nbsp;Amount*</td><td><input type="text" class="form-control" onfocus="calFinalCost()" id="grand_total" name="grand_total" readonly="readonly"/></td>
	             <td>&nbsp;</td>
	             <td>Other&nbsp;Exp*</td><td id="other_expenses_v"><input type="text" onkeypress="return isNumberKey(event)" class="form-control" onfocus="calFinalCost()" id="other_expenses" name="other_expenses"/></td>
	             <td>&nbsp;</td>
	             <td>Transport&nbsp;Amount*</td><td id="transport_expenses_v"><input type="text" onkeypress="return isNumberKey(event)" class="form-control"  onblur="calFinalCost()" id="transport_expenses" name="transport_expenses"/></td>
	             <td>&nbsp;</td>
	             <td>Hamali* </td><td id="hamali_expenses_v"><input type="text" class="form-control" onkeypress="return isNumberKey(event)" onblur="calcalFinalCost()" id="hamali_expenses" name="hamali_expenses" value='0' /></td>
	             <td>&nbsp;</td>
	             <td>Total Value*</td><td><input type="text" class="form-control" onfocus="calFinalCost()" id="total" name="total" readonly="readonly"/> </td>
	             <td>&nbsp;</td></tr>
	             <tr><td>Note</td><td><textarea class="form-control" name="note" id="note"></textarea></td></tr>
	             <tr><td>&nbsp;</td></tr>
	             </table>
                  <!-- /.box-body -->

                    <div class="form-group">                  
					<button class="btn btn-block btn-success">Add Stock</button>
				  </div>             
                  
              </div><!-- /.box -->
        
            </div><!--/.col (left) -->
            <!-- right column -->
            
          </div> 
                  </form>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <?php include_once "$D_PATH/include/footer.php";?>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.3 -->
    <script src="<?php echo $UI_ELEMENTS?>plugins/jQuery/jQuery-2.1.3.min.js"></script>
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
