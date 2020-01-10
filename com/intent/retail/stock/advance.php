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
				
				var item=$("#flower"+i).val();
				
				var cost=$("#cost"+i).val();
				

				if(item!="" && cost!="")
				{
					data=data+"//"+item+"#"+cost;
				}
			
				
			}

			document.getElementById("data").value=data
			
			if(data=="")
			{
				alert("No Data To Submit");
				state="2";
			}
			
			if(state==2){return false;}
			var result = confirm("Are Your Sure, Want to Add Advance?");
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
          
          <form role="form" onsubmit="return validate()" action="index.php?action=operations/stockadvancesave&c=stock" method="POST">        
                           <input type='hidden' id='data' name='data'>
                            <input type='hidden' id='login' name='login' value='<?php echo $session_id?>'>
                            <input type='hidden' id='branch' name='branch' value='<?php echo $session_branch?>'>  
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
               
                <!-- form start -->
                <br/>
                <table>
                <tr>
                	
                	<td>Buyer&nbsp; Name *</td><td id='b_name_v'><input type="text" class="form-control" id="b_name" name="b_name"  style="width: 150px"> </td><td>&nbsp;&nbsp;</td>
                	
                	
                	

                	
                	<td>Mobile</td><td id='mobile_v'><input type="text" maxlength="10" class="form-control onlyNumbers" id="mobile" name="mobile"></td><td>&nbsp;&nbsp;</td>
                	<td>Place</td><td id='place_v'><input type="text" class="form-control" id="place" name="place" style="width: 160px"></td><td>&nbsp;&nbsp;</td>
                	<td>Stock Out Date</td><td><input type="text" id="date" name="date" value='<?php echo $_SESSION['date1'];?>'> </td>   
                	   
                	   </tr>
                </table>
                <br/>
                </div>
                </div>
                
                
                 <div class="col-xs-6">
             

              <div class="box">
                
                <div class="box-body">
           
                <br/>
                <table >
	           <tr><th>ITEMS</th><th>COST</th></tr>
	           <?php 
	           for($i=1;$i<=5;$i++)
	           {
	           	if($i==1){
	           ?>
	           <tr>
	           		<td><select class="form-control" id="flower<?php echo $i?>">
	           		<option value=''></option>
	           		
	           		 <?php 
                                   
                                  $data = mysql_query("SELECT item_name FROM items where item_status='active' and branch='$session_branch'");
                                  while($info = mysql_fetch_array( $data ))
                                  {
                                  ?>  
	               <option  value="<?php echo $info["item_name"]?>"><?php echo $info["item_name"]?></option>
	               <?php }?>
	           		</select></td>
	           		
	           		<td><input type="text"  class="form-control" id="cost<?php echo $i?>" onblur="calCost(<?php echo $i?>)"/></td>
	           		
	           </tr>
	           <?php }else{
	           ?>
	           <tr>
	           		<td><select data-trigger="change"  class="form-control" id="flower<?php echo $i?>">
	           		<option value=''></option>
	           		
	           		 <?php 
                                   
                                  $data = mysql_query("SELECT item_name FROM items where item_status='active' and branch='$session_branch'");
                                  if($data)
                                  while($info = mysql_fetch_array( $data ))
                                  {
                                  ?>  
	               <option  value="<?php echo $info["item_name"]?>"><?php echo $info["item_name"]?></option>
	               <?php }?>
	           		
	           		</select></td>
	           		
	           		<td><input type="text" class="form-control" id="cost<?php echo $i?>"   onblur="calCost(<?php echo $i?>)"/></td>
	           		
	           </tr>
	           
	           <?php 
	           
	           } }?>
	           </table>
	          <input type='hidden' id='icount' value='<?php echo $i?>'>
	          
	          
	           <div class="span4"><br/>
	          <table>
	             <tr><td>Advance&nbsp;paid*</td><td><input type="text" class="form-control" onfocus="finalCost()" id="advance" name="advance" data-validation-minlength="0" data-trigger="change" data-required="true"  data-type="number"/>
	             </td></tr>
	         	<tr><td>Note</td><td><textarea name='note' id='note' class="form-control"></textarea></td></tr>
	           </table>	           
	           </div>
                  <div class="form-group" style="width: 30%;">                  
					<input type="submit" class="btn btn-block btn-success" value="Submit">
				  </div> 
                  <!-- /.box-body -->
 
              </div><!-- /.box -->
        
            </div><!--/.col (left) -->
            <!-- right column -->
            
          </div>   <!-- /.row -->
          <div class="col-xs-6">
             

              <div class="box">
                
                <div class="box-body">
           
                <br/>
                
                  
                  <table class="table table-striped">
                        <tr><th>Slno</th><th>Customer Name</th><th>Booking Date</th><th>Advance</th><th>Action</th></tr>
                        
                        <?php 
                        $sl_no=1;
                        $supplier = mysql_query("SELECT bill_no,customer_name,advance,bill_date FROM customerbillmainadvance where bill_status='active' and branch='$session_branch' order by bill_date asc");
                        while($supplier1 = mysql_fetch_array( $supplier ))
                        { ?>
                        <tr><td><?php echo $sl_no++?></td><td><?php echo $supplier1["customer_name"]?></td><td><?php $t_date=explode("-", $supplier1["bill_date"]);echo $t_date[2]."-".$t_date[1]."-".$t_date[0] ?></td><td><?php echo $supplier1["advance"]?></td>
                        <td><a href='index.php?action=booking_view&c=stock&bill_no=<?php echo $supplier1["bill_no"]?>'>View</a>&nbsp;&nbsp;&nbsp;<a href='index.php?action=booking_edit&c=stock&bill_no=<?php echo $supplier1["bill_no"]?>'>Create Bill</a></td></tr>
                        <?php }?>
                        </table>   
                  <!-- /.box-body -->
    <input type='hidden' name='count' id='count' value="<?php echo $i?>">

                                             
                  
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
