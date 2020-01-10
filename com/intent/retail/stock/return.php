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
		function validate()
		{			           
		
			var state="1";
			if($("#bill_no").val()==""){$("#bill_no_v").addClass('has-error');state="2";}
			if($("#bill_date").val()==""){$("#bill_date_v").addClass('has-error');state="2";}
			if($("#bill_type").val()==""){$("#bill_type_v").addClass('has-error');state="2";}
			
			if($("#mobile").val()==""){$("#mobile_v").addClass('has-error');state="2";}
			if($("#place").val()==""){$("#place_v").addClass('has-error');state="2";}
			if($("#consider").val()==""){$("#consider_v").addClass('has-error');state="2";}

			if($("#bill_type").val()=="Cash"){
			if($("#customer_name").val()==""){$("#customer_name_v").addClass('has-error');state="2";}
			}else{
				if($("#customer_id").val()==""){$("#customer_id_v").addClass('has-error');state="2";}
				
				
			}

			if($("#grand_total").val()==""){$("#grand_total_v").addClass('has-error');state="2";}
			if($("#tax").val()==""){$("#tax_v").addClass('has-error');state="2";}
			if($("#transport").val()==""){$("#transport_v").addClass('has-error');state="2";}
			if($("#other_expenses").val()==""){$("#other_expenses_v").addClass('has-error');state="2";}
			if($("#total").val()==""){$("#total_v").addClass('has-error');state="2";}
			
			
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
    
       <script type="text/javascript">
function loadItems(row,val)
{
  
	var category=document.getElementById("category"+row).value;
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
			document.getElementById("item"+row).options[j]=new Option(temp2[0],temp2[1]);
			
		    }
	     }
	   }

	 var D_PATH=document.getElementById("D_PATH").value
		var DIR=document.getElementById("DIR").value
		
	 xmlhttp.open("GET",D_PATH+"/"+DIR+"/load/getItems.php?category="+category,true);
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
		</script>
		
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
	 var tax=document.getElementById("tax").value;if(tax==''){tax=0;}
	 var transport=document.getElementById("transport").value;if(transport==''){transport=0;}
 	document.getElementById("total").value=parseFloat(grand_total)+parseFloat(other_expenses)+parseFloat(tax)+parseFloat(transport);
	var paid_amt=document.getElementById("paid_amt").value
	if(paid_amt==""){paid_amt=0;}

	//document.getElementById("balance").value=(parseFloat(grand_total)+parseFloat(other_expenses)+parseFloat(tax)+parseFloat(transport))-paid_amt;
 	
 }

 function checkCustomer(val)
 {
	var bill_type= document.getElementById("bill_type").value

	if(bill_type=="Credit")
	{
		document.getElementById("customer_type1").style.visibility="";
		document.getElementById("customer_type").style.visibility="hidden";
		document.getElementById("customer_type").style.position="absolute";
		document.getElementById("customer_type1").style.position="relative";
	} 
	else
	{
		document.getElementById("customer_type").style.visibility="";
		document.getElementById("customer_type1").style.visibility="hidden";
		document.getElementById("customer_type1").style.position="absolute";
		document.getElementById("customer_type").style.position="relative";
	} 
	
 }

 function cashe()
 {
 	
 	var cashe_amt=document.getElementById("cash_amount").value;
 	document.getElementById("check_amount").value=document.getElementById("total").value-document.getElementById("cash_amount").value;
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
 	document.getElementById("discount").value=document.getElementById("total").value-paid;
 	
 }

 function Balance()
 {
	 document.getElementById("balance").value=parseFloat(document.getElementById("total").value)-(parseFloat(document.getElementById("paid_amt").value)+parseFloat(document.getElementById("discount").value));
 }

 function unHide()
	{
		var amt=document.getElementById("check_amount").value
		if(amt>1)
		{
		document.getElementById("span1").style.visibility='';
		document.getElementById("span2").style.visibility='';
		}
		else
		{
			document.getElementById("span1").style.visibility='hidden';
			document.getElementById("span2").style.visibility='hidden';
		}
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
		 document.getElementById("status").innerHTML="";
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
			  document.getElementById("status").innerHTML="<label style='color:green'>Added Successfully</label>";

			 
		  }	  
		  else
		  {
			  document.getElementById("status").innerHTML="<label style='color:red'>Item Already Exist</label>";
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

	function getCustomer(customer_id)
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
		xmlhttp.open("GET",D_PATH+"/"+DIR+"/load/customerdetails.php?customer_id="+customer_id,true);
		xmlhttp.send();

	}
	
    </script>
    
      
 
  </head>
  <body class="skin-blue fixed">
    <div class="wrapper">
       <!-- ---------------------------------------------------POPUP--------------------------------------------------------------------------- -->
<div class='popup'>
<div class='content_popup'>
<img src='<?php echo $UI_ELEMENTS?>notify/img/img.png' alt='quit' class='x' id='x'></img>
<div>



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
                    
                      <div class="form-group">                  
					<button class="btn btn-block btn-success" onclick="addItem()">Add Item</button>
				  </div>             
                    
                    
                  </div><!-- /.box-body -->

                
            
              </div><!-- /.box -->

             

              
              

            </div>
        
          
            
          </div>   <!-- /.row -->
          
                 
        </section>




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
          
          <form role="form" onsubmit="return validate()" action="index.php?action=operations/stockreturn&c=stock" method="POST">
          <input type='hidden' id='data' name='data'>
           <input type='hidden' name="session_branch" id="session_branch" value="<?php echo $session_branch?>">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
               
                <!-- form start -->
                <br/>
                <table>
                <tr>
                	
                	<td>Return&nbsp;Date</td><td id='bill_date_v'><input type="date" class="form-control" id="bill_date" name="bill_date" value="<?php echo $date?>" style="width: 150px"> </td><td>&nbsp;&nbsp;</td>
                	<td>Customer&nbsp;Type</td><td id='bill_type_v'><select style="width: 80px;float: left" class="form-control" id="bill_type" name="bill_type" onchange="checkCustomer(this.value)"><option value="Cash">Cash</option><option value="Credit">Credit</option></select>
                	
                	</td><td>&nbsp;&nbsp;</td>
                	
                	

                	<td>Customer</td><td id='customer_name_v' style="width: 150px">
                	<span id="customer_type" style="position: relative;">
                	<input type="text" class="form-control" id="customer_name" name="customer_name">
                	</span>
                	<span style="visibility: hidden;position: relative" id="customer_type1">
                	<select  name="customer_id" id="customer_id" class="form-control"  onchange="getCustomer(this.value)" style="position: absolute ;width: 150px">
                	<option value=""></option>
                	 <?php 
                                   
                                  $data = mysql_query("SELECT customer_id,customer_name FROM customer where customer_status='active' and branch='$session_branch' order by customer_name asc");
                                  if($data)
                                  while($info = mysql_fetch_array( $data ))
                                  {
                                  ?>  
	               <option  value="<?php echo $info["customer_id"]?>"><?php echo $info["customer_name"]?></option>
	               <?php }?>
                	</select>
                	</span>
                	</td><td>&nbsp;&nbsp;</td>
                	<td>Mobile</td><td id='mobile_v'><input type="text" maxlength="10" class="form-control onlyNumbers" id="mobile" name="mobile"></td><td>&nbsp;&nbsp;</td>
                	<td>Place</td><td id='place_v'><input type="text" class="form-control" id="place" name="place" style="width: 160px"></td><td>&nbsp;&nbsp;</td>
                	   </tr>
                </table>
                <br/>
                </div>
                </div>
                
                
                 <div class="col-xs-9">
             

              <div class="box">
                
                <div class="box-body">
           
                <br/>
                <table style="width: 96%;margin-left: 2%">
                <tr><th></th><td>&nbsp;&nbsp;</td><th>Category&nbsp;<a href="" class='click'>+</a></th><td>&nbsp;&nbsp;</td><th>Items&nbsp;&nbsp;&nbsp;<a href="" class='click'>+</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th><td>&nbsp;&nbsp;</td><th>Qty In Piece</th><td>&nbsp;&nbsp;</td><th>Qty In Sft</th><td>&nbsp;&nbsp;</td><th>Cost</th><td>&nbsp;&nbsp;</td><th>Final Cost</th></tr>
                <?php 
                for($i=1;$i<=5;$i++)
                {
                ?>
                <tr>
                <td><?php echo $i?></td><td>&nbsp;&nbsp;</td>
                <td><select class="form-control" id="category<?php echo $i?>" name="category<?php echo $i?>" onchange="loadItems(<?php echo $i?>,this.value)"><option value=""></option><?php $data = mysql_query("SELECT category_id,category_name FROM category where category_status='active' and branch='".$session_branch."'");if($data)while($info = mysql_fetch_array( $data )){?><option  value="<?php echo $info["category_id"]?>"><?php echo $info["category_name"]?></option><?php }?></select></td><td>&nbsp;&nbsp;</td>
                <td><select class="form-control" id="item<?php echo $i?>" name="item<?php echo $i?>"><option value=""></option></select></td><td>&nbsp;&nbsp;</td>
                <td><input type="text" class="form-control onlyNumbers" id="qty_piece<?php echo $i?>" name="qty_piece<?php echo $i?>" size="5"></td><td>&nbsp;&nbsp;</td>
                <td><input type="text" class="form-control" onkeypress="return isNumberKey(event)" id="qty_sft<?php echo $i?>" name="qty_sft<?php echo $i?>" size="5" onblur="checkQty(<?php echo $i?>)"></td><td>&nbsp;&nbsp;</td>
                <td><input type="text" class="form-control" onkeypress="return isNumberKey(event)" id="cost<?php echo $i?>" name="cost<?php echo $i?>" size="5" onblur="calCost(<?php echo $i?>)"></td><td>&nbsp;&nbsp;</td>
                <td><input type="text" class="form-control" id="fcost<?php echo $i?>" name="fcost<?php echo $i?>" readonly="readonly"></td><td>&nbsp;&nbsp;</td>
                </tr>
                <tr><td>&nbsp;</td></tr>
                <?php }?>
                 <?php 
                for($i=6;$i<=50;$i++)
                {
                	$state='';
                	if($i>6){
                		$state="style='visibility: hidden;position: absolute;'";
                	}
                ?>
                <tr id="subnewboxes<?php echo $i?>" name="subnewboxes<?php echo $i?>" <?php echo $state?>>
                <td><?php echo $i?></td><td>&nbsp;&nbsp;</td>
                <td><select class="form-control" id="category<?php echo $i?>" name="category<?php echo $i?>" onchange="loadItems(<?php echo $i?>,this.value)"><option value=""></option><?php $data = mysql_query("SELECT category_id,category_name FROM category where category_status='active' and branch='".$session_branch."'");if($data)while($info = mysql_fetch_array( $data )){?><option  value="<?php echo $info["category_id"]?>"><?php echo $info["category_name"]?></option><?php }?></select></td><td>&nbsp;&nbsp;</td>
                <td><select class="form-control" id="item<?php echo $i?>" name="item<?php echo $i?>"><option value=""></option></select></td><td>&nbsp;&nbsp;</td>
                <td><input type="text" class="form-control onlyNumbers" id="qty_piece<?php echo $i?>" name="qty_piece<?php echo $i?>"></td><td>&nbsp;&nbsp;</td>
                <td><input type="text" class="form-control" onkeypress="return isNumberKey(event)" id="qty_sft<?php echo $i?>" name="qty_sft<?php echo $i?>" onblur="checkQty(<?php echo $i?>)"></td><td>&nbsp;&nbsp;</td>
                <td><input type="text" class="form-control"  onkeypress="return isNumberKey(event)" id="cost<?php echo $i?>" name="cost<?php echo $i?>" onblur="calCost(<?php echo $i?>)"></td><td>&nbsp;&nbsp;</td>
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
          <div class="col-xs-3">
             

              <div class="box">
                
                <div class="box-body">
           
                <br/>
                
                  <input type='hidden' name='count' id='count' value="<?php echo $i?>">
                  <table>
	             <tr><td>Total&nbsp;Amount*</td><td id='grand_total_v'><input type="text" onkeypress="return isNumberKey(event)" class="form-control" onfocus="finalCost()" id="grand_total" name="grand_total" readonly="readonly"/></td></tr>
	             
	             <tr><td></td><td id='tax_v'><input type="hidden" value="0" onkeypress="return isNumberKey(event)" class="form-control" onfocus="finalCost()" id="tax" name="tax"/></td></tr>

	             <tr><td></td><td id='transport_v'><input type="hidden" value="0" onkeypress="return isNumberKey(event)" class="form-control"  onblur="finalCost()" id="transport" name="transport"/></td></tr>
	             <tr><td>&nbsp;</td></tr>
	         <tr><td>Other&nbsp;Expenses* </td><td id='other_expenses_v'><input type="text" onkeypress="return isNumberKey(event)" class="form-control" onblur="finalCost()" id="other_expenses" value='0' name="other_expenses"/></td></tr>
	         <tr><td>&nbsp;</td></tr>
	               <tr><td>Total Value*</td><td id='total_v'><input type="text" onkeypress="return isNumberKey(event)" class="form-control" onfocus="finalCost()" id="total" name="total" readonly="readonly"/>
	               <tr><td>&nbsp;</td></tr>
	             
	             <tr><td>Note*</td><td><input type="text" class="form-control" id="note" name="note"/></td></tr> 
	            <tr><td>&nbsp;</td></tr>

	             </table>
                  <!-- /.box-body -->
    <input type='hidden' name='count' id='count' value="<?php echo $i?>">

                    <div class="form-group">                  
					<input type="submit" class="btn btn-block btn-success" value="Return Bill">
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
