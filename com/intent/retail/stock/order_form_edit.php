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

   <link rel="stylesheet" href="com/intent/retail/stock/css/autosuggest.css" />
    
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
   <script type="text/javascript">
   function totalSft(count)
   {
	   
   	var qty=document.getElementById("piece_sft_"+count).value;
   	var sft=document.getElementById("qty_piece"+count).value;
   	document.getElementById("qty_sft"+count).value=(qty*sft);
   }
   
    function calCost(count)
    {
    var qty=document.getElementById("qty_sft"+count).value;
    var cost=document.getElementById("cost"+count).value;
    var disc=document.getElementById("discount"+count).value;
    var vat=document.getElementById("vat"+count).value;
    if(vat==""){vat=0;}
    
    //  document.getElementById("fcost"+count).value=qty*cost;
    //document.getElementById("cost"+count).value=(cost)-((disc/100)*(cost));
	if(disc!="" && cost!="" && qty!="")
	{
		document.getElementById("fcost"+count).value=(((qty*cost)-((disc/100)*(qty*cost)))+(((qty*cost)-((disc/100)*(qty*cost)))*(vat/100))).toFixed(2);
	}
	



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
    		if(document.getElementById("qty_sft"+i).value!="")
    		{
    		total_qty=total_qty+parseInt(document.getElementById("qty_sft"+i).value);
    		}
    	}
    	var miss_cost=exp+t_exp;
    	var cost_unit=(parseFloat(exp)+parseFloat(t_exp))/total_qty;
    	//alert(miss_cost+"/"+total_qty)
    	for(var i=1;i<tcount;i++)
    	{    		
    		if(document.getElementById("fcost"+i).value!="")
    		{    			
        		var fcost=document.getElementById("fcost"+i).value/document.getElementById("qty_sft"+i).value;
    			document.getElementById("lcost"+i).value=((parseFloat(fcost)+cost_unit)).toFixed(2);
    			document.getElementById("tlcost"+i).value=parseFloat(document.getElementById("lcost"+i).value)*parseInt(document.getElementById("qty_sft"+i).value);
    		/*document.getElementById("lcost"+i).value=parseInt(document.getElementById("total").value)/parseInt(document.getElementById("qty"+i).value);
    		document.getElementById("tlcost"+i).value=(parseInt(document.getElementById("total").value)/parseInt(document.getElementById("qty"+i).value))*parseInt(document.getElementById("qty"+i).value);*/
    		}
    	}
    	
    	//document.myform.submit();
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
				var category=$("#category"+i).val();
				var item=$("#item"+i).val();
				var qty_piece=$("#qty_piece"+i).val();
				var qty_sft=$("#qty_sft"+i).val();
				var cost=0;
				var fcost=0;
				var lcost=0;
				var tlcost=0;
				var subid=$("#subcategory"+i).val();
				var discount=0;
				var vat=0;
				var desc=$("#desc"+i).val();
				var curStock=parseInt($("#item_stock"+i).val());
				//alert(curStock);
				var barcode=0
				if(barcode==""){barcode=0;}
				if(vat==""){vat=0;}

		
				if( item!="" && qty_piece!="" && qty_sft!="")
				{
					
					data=data+"//"+category+"#"+item+"#"+qty_piece+"#"+qty_sft+"#"+cost+"#"+fcost+"#"+lcost+"#"+tlcost+"#"+subid+"#"+discount+"#"+desc+"#"+barcode+"#"+vat+"#"+curStock;
				}
				
				
			}
			//alert(data);
			if(data=="")
			{
				alert("No Data To Submit");
				state="2";
			}
			document.getElementById("data").value=data
			if(state==2){return false;}
			var result = confirm("Are Your Sure, Want to Save Order Form?");
			if (result) {
				document.myform.submit();
				return true;
			}else{return false;}
			
		
		}
		
        </script>
    
       <script type="text/javascript">
function loadItems(row,val)
{
  
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
  
	
	 document.getElementById("items_load").innerHTML="Loading....";
	 var cid=document.getElementById("category1").value;
	 var sid=document.getElementById("subcategory1").value;
		var filter=document.getElementById("filter").value
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
		
	 xmlhttp.open("GET",D_PATH+"/"+DIR+"/load/loaditems.php?&category="+cid+"&subcategoryid="+sid+"&filter="+filter+"&item_search=0",true);
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
				document.getElementById("item"+i).value=document.getElementById("itemid_"+col).value;
				document.getElementById("item_name"+i).value=document.getElementById("item_"+col).value;
				//document.getElementById("piece_sft_"+i).value=document.getElementById("sft_"+col).value;
				document.getElementById("qty_piece"+i).style.borderColor = "Red";
				document.getElementById("desc"+i).focus();
				
				document.getElementById("clear"+i).style.visibility="";
				return false;
			}
		}
		
	}
    </script>
    
    <script type="text/javascript">
	function clearData(i)
	{
		       
	//	document.getElementById("category"+i).value="";  
		document.getElementById("item"+i).value="";
		document.getElementById("desc"+i).value="";
		document.getElementById("item_name"+i).value="";
		document.getElementById("qty_piece"+i).value="";
		document.getElementById("qty_sft"+i).value="";
		document.getElementById("costt"+i).value="";
		document.getElementById("discount"+i).value="0";
		document.getElementById("fcost"+i).value="";
		document.getElementById("lcost"+i).value="";
		document.getElementById("tlcost"+i).value="";
		document.getElementById("barcode"+i).value="";
		calFinalCost()
	}

    </script>
    <script type="text/javascript">
	function calLength(row)
	{
		var sft=1;
		document.getElementById("piece_sft_"+row).value=1;
		//alert(document.getElementById("piece_sft_"+row).value)
		if(document.getElementById("category1").value=="1")
		{
			var temp=document.getElementById("desc"+row).value;
			
			var temp1=temp.split("/");
			var temp2=temp1[2].split(" ");
			var temp3=temp2[1].split("*");
			var total=parseFloat(temp3[0])*parseFloat(temp3[1]);
			if (isNaN(total)) 
			  {
				document.getElementById("piece_sft_"+row).value=1	
			  }
			else
			{
				document.getElementById("piece_sft_"+row).value=total
				
			
			//sft=parseFloat(temp3[0])*parseFloat(temp3[1]);
			}
		}
		else
		{
			document.getElementById("piece_sft_"+row).value=1;
		}
		//return sft;
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


<script>
function suggest(inputString,row){
	document.getElementById("row").value=row
	var item_id=document.getElementById("item"+row).value
	if(inputString.length == 0) {
		$('#suggestions'+row).fadeOut();
	} else {
	$.ajax({
	  url: "com/intent/retail/stock/autosuggest.php?item_id="+item_id,
	  data: 'act=autoSuggestUser&queryString='+inputString,
	  success: function(msg){
		  	if(msg.length >0) {
				$('#suggestions'+row).fadeIn();
				$('#suggestionsList'+row).html(msg);
				$('#desc'+row).removeClass('load');
			}
	  }
	});
	}
}
function fill(thisValue) {
	var row=document.getElementById("row").value;
	if(thisValue!="22222"){
	$('#desc'+row).val(thisValue);
	getProductCost(row,thisValue);
	}
	setTimeout("$('#suggestions'"+row+").fadeOut();", 600);
	setTimeout(function(){ document.getElementById("suggestions"+row).style.display="none"; }, 300);
	//getCurrentStock(row);
}
function fillId(thisValue) {
	var row=document.getElementById("row").value;
	document.getElementById("qty_piece"+row).focus();
	$('#country_id'+row).val(thisValue);
	setTimeout("$('#suggestions'"+row+").fadeOut();", 600);
	setTimeout(function(){ document.getElementById("suggestions"+row).style.display="none"; }, 300);
	//getCurrentStock(row);
}

function getCurrentStock(row) {
	document.getElementById("row").value=row;
	var item_id=document.getElementById("item"+row).value;
	var desc=document.getElementById("desc"+row).value;
	$.ajax({
	  type:'post',
	  url: "com/intent/retail/stock/load/getCurrentStock.php",
	  data:{item_id:item_id,desc:desc},
	  success: function(msg){
		  $("#item_stock"+row).val(msg);
	  }
	});
}

function getProductCost(row,desc){
var item_id=document.getElementById("item"+row).value

$.ajax({
	  url: "com/intent/retail/stock/load/getItemsByDesc.php?item_id="+item_id,
	  data: 'category=0&desc='+desc,
	  success: function(msg){
		
		  	if(msg.length >0) {
		  		 var temp=msg.split("#");
				$('#cost'+row).val(temp[4]);
				$('#discount'+row).val(temp[2]);
				$('#vat'+row).val(temp[3]);
				
			}
	  }
	});
}

</script>

      <?php include_once "$D_PATH/include/header.php";?> 
      <!-- Left side column. contains the logo and sidebar -->
       <?php include_once "$D_PATH/include/side.php";?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        
          <section class="content">
          
          <form role="form" name="myform" onsubmit="return validate()" action="index.php?action=operations/orderform_update&c=stock" method="POST">
          <input type='hidden' name="session_branch" id="session_branch" value="<?php echo $session_branch?>">
          <input type='hidden' id='data' name='data'>
           <input type='hidden' id='bill_id' name='bill_id' value="<?php echo $_GET["pid"]?>">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
               
                <!-- form start -->
                <br/>
                 <?php 
                $supplier_id=$_GET["c_id"];
                $bill_no=$_GET["pid"];
                                         
       $data = mysql_query("SELECT sk_member_id, member_type, member_name, acc_no, ifsc, mobile, landline, email, address, place, state, profile_pic, login_name, login_password, login_status, member_status, employee_id, branch_id FROM mst_member where sk_member_id=$supplier_id");
                while($info = mysql_fetch_array( $data ))
                {
                	$customer_name=$info['member_name'];
                	$mobile=$info['mobile'];
                	$city=$info['place'];       
                	$customer_type="Credit";
                }
                        
                
                $data = mysql_query("SELECT bill_no, supplier_id, bill_date, total, other_exp, lug_exp, exp, advance, gtotal, total_bal, login_id, branch, hamali,note,discount,discount_date FROM supplierorderformmain where bill_no=$bill_no");
                while($info = mysql_fetch_array( $data ))
                {
                	
                	$bill_date=$info['bill_date'];
                	
                	$total=$info['total'];
                	$other_exp=$info['other_exp'];
                	$hamali=$info['hamali'];
                	$lug_exp=$info['lug_exp'];
                	$gtotal=$info['gtotal'];
                	$note=$info['note'];
                	$discount=$info["discount"];
                	$discount_date=$info["discount_date"];
    
                }
                ?>
                <table>
                <tr>
                	<td></td><td id='bill_no_v'><input type="hidden" value="<?php echo $bill_no?>" class="form-control onlyNumbers" id="bill_no" name="bill_no"></td><td>&nbsp;&nbsp;</td>
                	<td>Bill&nbsp;Date</td><td id='bill_date_v'><input type="date" class="form-control" id="bill_date" name="bill_date" value="<?php echo $bill_date?>" size="9"></td><td>&nbsp;&nbsp;</td>
                	
           			<td>Supplier&nbsp;Name</td><td id='supplier_name_v'><select class="form-control select2" id="supplier_name" name="supplier_name" onchange="getSupplier(this.value)"  data-trigger="change" data-required="true" class="span10">
	              <option value="<?php echo $supplier_id?>"><?php echo $customer_name?></option>
	                <?php 
                                   
                                  $data = mysql_query("SELECT sk_member_id,member_name FROM mst_member where member_status='active' and member_type='3' order by member_name asc");
                                  if($data)
                                  while($info = mysql_fetch_array( $data ))
                                  {
                                  ?>  
	               <option  value="<?php echo $info["sk_member_id"]?>"><?php echo $info["member_name"]?></option>
	               <?php }?>
	               </select></td><td>&nbsp;&nbsp;</td>
                	<td>Mobile</td><td id='mobile_v'><input type="text" value="<?php echo $mobile?>" class="form-control onlyNumbers" id="mobile" name="mobile"></td><td>&nbsp;&nbsp;</td>
                	<td>Place</td><td id='place_v'><input type="text" value="<?php echo $city?>" class="form-control" id="place" name="place"></td><td>&nbsp;&nbsp;</td>
                
                </tr>
                </table><br/><br/>
                </div>
                </div>
                
                <div class="col-xs-3" >
             

              <div class="box" >
                
                <div class="box-body" >
                </br>
                <div class="form-group">
                      <label for="exampleInputFullName">Barcode</label>
                      <input type="text" class="form-control" id="inbarcode" name="inbarcode"  onchange="copyBarcodein(this.value)" >
                      <span  id='category_v'></span>
                    </div>
                    
                <table style="width: 96%;margin-left: 2%">
                <tr><th>Category<a href="" class='click'>+</a></th><td>&nbsp;&nbsp;</td>
               <th>Sub Category<a href="" class='click'>+</a></th><th></th></tr>
               <tr>
                
                <td><select class="form-control" id="category1" name="category1" onchange="loadItems(1,this.value)"><option value=""></option><?php $data = mysql_query("SELECT category_id,category_name FROM category where category_status='active' and branch='".$session_branch."'");if($data)while($info = mysql_fetch_array( $data )){?><option  value="<?php echo $info["category_id"]?>"><?php echo $info["category_name"]?></option><?php }?></select></td>
                <td>&nbsp;&nbsp;</td>
                <td><select class="form-control" id="subcategory1" name="subcategory1" onchange="loadItems1(1,this.value)"><option value=""></option></select></td>
               <td>&nbsp;&nbsp;&nbsp;</td></tr>
               <tr><td colspan="3"><input type="text" id="filter" name="filter" style="width: 100%" placeholder="Search Pattern" onkeyup="getData()" ></td></tr>
               </table>
                <div id="items_load" style="height: 50%;overflow:auto;">
                

                </div>
                </div>
                </div>
                </div>
           <script type="text/javascript">
        function copyBarcodein(val)
        {
        	
    		var barcode=val

    		if(barcode!="")
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
				document.getElementById("inbarcode").value="";
				for(var i=1;i<=120;i++){
					if(document.getElementById("category"+i).value=="")
					{
		    		  	document.getElementById("category"+i).value=temp[1];
		          		document.getElementById("item"+i).value=temp[2];
		          		document.getElementById("item_name"+i).value=temp[3];
		          		document.getElementById("desc"+i).value=temp[4];
		          		document.getElementById("qty_sft"+i).value=1;
		          		document.getElementById("qty_piece"+i).value = 1;
		          		document.getElementById("cost"+i).value=temp[5];
		          		getProductCost(i,temp[4]);
		          		getCurrentStock(i);
		          		return;
					}
				}
    		    }
    		}

    		 var D_PATH=document.getElementById("D_PATH").value
    			var DIR=document.getElementById("DIR").value
    		xmlhttp.open("GET",D_PATH+"/"+DIR+"/load/getitemsbybarcode.php?barcode="+barcode,true);
    		xmlhttp.send();
    		}
    		
    	}
        </script>
           <script type="text/javascript">
			function getData()
			{
				var category=document.getElementById("category1").value
				var subcategory=document.getElementById("subcategory1").value
				var filter=document.getElementById("filter").value
				
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
				 xmlhttp.open("GET",D_PATH+"/"+DIR+"/load/loaditems.php?&category="+category+"&subcategoryid="+subcategory+"&filter="+filter+"&item_search=0",true);
				 xmlhttp.send();
							
			}

           </script>
           
           <input type="hidden" id="row">
            
             <div class="col-xs-9">

              <div class="box">
                
                <div class="box-body" style="height: 500px;overflow: scroll;">
           
                <br/>
                <table style="width: 100%;margin-left: 2%">
                <tr><th></th><td>&nbsp;&nbsp;</td><th></th><td>&nbsp;&nbsp;</td>
                <th>Items</th><td>&nbsp;&nbsp;</td>
                <th>Desc</th><td>&nbsp;&nbsp;</td>
                <th>In&nbsp;Box</th><td>&nbsp;&nbsp;</td><th>Sft/Piece</th><td>&nbsp;&nbsp;</td><th>Cur Stock</th><td>&nbsp;&nbsp;</td><th></th><td>&nbsp;&nbsp;</td><th></th>
                <td>&nbsp;&nbsp;</td><th></th><td>&nbsp;&nbsp;</td><th></th><th></th><th></th></tr>
                <?php 
                $i=0;
                $k="";
                $itemname="";
                $length="";
                $breadth="";
                $thickness="";
              
                $query=mysql_query("select tran_id,item_name,item_qty,item_rate,amt,landing_cost,item_qty_p,discount,description,vat,cur_stock from supplierorderform where bill_no='".$bill_no."' order by tran_id asc");
                while($info=mysql_fetch_array($query))
                {
                	
                	$vat=$info["vat"];
                	
                	$name="";
               	
                	 $query1=mysql_query("select item_name,color,packing,category,thickness,length,breadth from items where item_id='".$info["item_name"]."'");
                	 while($info1=mysql_fetch_array($query1))
                	 {
                	 	$category=$info1["category"];
                	 	$category_name="";
                	 	$data2 = mysql_query("SELECT category_name FROM category where category_id='".$info1["category"]."'");
                	 	while($info2 = mysql_fetch_array( $data2 ))
                	 	{
                	 		$category_name=$info2["category_name"];
                	 	}
                	 	if($category_name=="PAINTS")
                	 	{
                	 	$itemname=$info1["item_name"];
                	 	$color=$info1["color"];
                	 	$packing=$info1["packing"];
                	 	
                	 	$name=$itemname;//."|".$color."|".$packing;
                	 	}
                	 	else
                	 	{
                	 		$itemname=$info1["item_name"];
                	 		$length=$info1["length"];
                	 		$breadth=$info1["breadth"];
                	 		$thickness=$info1["thickness"];
                	 		$name=$itemname;
                	 	}
                	 }
                	 $description=$info["description"];
                	 
                	
                	 {
                	 	$i++;
                	?>
                	<input type="hidden" id="piece_sft_<?php echo $i?>" value="<?php echo $length*$breadth?>">
                	<input type="hidden" id="tran_id_<?php echo $i?>" value="<?php echo $info["tran_id"]?>">
                <tr>
                <td><?php echo $i?></td><td>&nbsp;&nbsp;</td>
                <td><input type="hidden" class="form-control" id="category<?php echo $i?>" value='<?php echo $category?>'  name="category<?php echo $i?>" onchange="loadItems(<?php echo $i?>,this.value)"></td><td>&nbsp;&nbsp;</td>
                <td><input type="hidden" class="form-control" id="item<?php echo $i?>" name="item<?php echo $i?>" value="<?php echo $info["item_name"]?>">
                	<input type="text" style="padding: 0" class="form-control" id="item_name<?php echo $i?>" name="item_name<?php echo $i?>" value="<?php echo $name?>">
                </td><td>&nbsp;&nbsp;</td>
                 <td><input type="text" style="padding: 0" class="form-control removespace" value="<?php echo $description?>" onkeyup="suggest(this.value,<?php echo $i?>);" onblur="calLength(<?php echo $i?>);fill(22222);fillId();" id="desc<?php echo $i?>" name="desc<?php echo $i?>">
                <div class="suggestionsBox" id="suggestions<?php echo $i?>" style="display: none;"> <div class="suggestionList" id="suggestionsList<?php echo $i?>"> &nbsp; </div>
  				</div>
                
                </td><td>&nbsp;&nbsp;</td>
                <td><input type="text" style="padding: 0" class="form-control onlyNumbers" id="qty_piece<?php echo $i?>" name="qty_piece<?php echo $i?>" size="1" onblur="calLength(<?php echo $i?>);totalSft(<?php echo $i?>)" value="<?php echo $info["item_qty_p"]?>"></td><td>&nbsp;&nbsp;</td>
                <td><input type="text" style="padding: 0" class="form-control" onkeypress="return isDecimalNumber(event,this);" id="qty_sft<?php echo $i?>" name="qty_sft<?php echo $i?>" size="3" value="<?php echo $info["item_qty"]?>"></td><td>&nbsp;&nbsp;</td>
                <td><input type="text" style="padding: 0" class="form-control removespace" onkeypress="return isDecimalNumber(event,this);" id="item_stock<?php echo $i?>" value="<?php echo $info["cur_stock"]?>" onfocus="getCurrentStock(<?php echo $i?>)" size="3"></td><td>&nbsp;&nbsp;</td> 
                <td><input type="hidden" style="padding: 0" class="form-control" onkeypress="return isDecimalNumber(event,this);" id="cost<?php echo $i?>" name="cost<?php echo $i?>" size="5" onblur="calCost(<?php echo $i?>)" value="<?php echo $info["item_rate"]?>">
                 
                </td><td>&nbsp;&nbsp;</td>
                <td><input type="hidden" class="form-control removespace" onkeypress="return isDecimalNumber(event,this);" id="discount<?php echo $i?>" name="discount<?php echo $i?>" onblur="calCost(<?php echo $i?>)" value="<?php echo $info["discount"]?>" size="3">
                <input type="hidden" style="padding: 0" value="<?php echo $vat?>" class="form-control removespace" onkeypress="return isDecimalNumber(event,this);" id="vat<?php echo $i?>" name="vat<?php echo $i?>" onblur="calCost(<?php echo $i?>)" size="3">
                <input type="hidden" style="padding: 0" class="form-control" id="fcost<?php echo $i?>" name="fcost<?php echo $i?>" readonly="readonly" size='4' value="<?php echo $info["amt"]?>">
                <input type="hidden" style="padding: 0" class="form-control" id="lcost<?php echo $i?>" name="lcost<?php echo $i?>" readonly="readonly" size='4' value="<?php echo $info["landing_cost"]?>">
                <input type="hidden" class="form-control" id="tlcost<?php echo $i?>" name="tlcost<?php echo $i?>" readonly="readonly" ></td><td>&nbsp;&nbsp;</td>
                 <td id="clear<?php echo $i?>"><a href="javascript:void(0)" onclick="calCost(<?php echo $i?>);clearData(<?php echo $i?>)"><img title="Clear" src="<?php echo $UI_ELEMENTS?>/images/clear.png" width="20px"></a></td>
               
                </tr>
                <tr><td>&nbsp;</td></tr>
                <?php }
                }$k=$i+1;
	               
                 for($i=$k;$i<=120;$i++)
                {
                	
                	
                ?><input type='hidden' id="piece_sft_<?php echo $i?>">
                <tr>
                <td><?php echo $i?></td><td>&nbsp;&nbsp;</td>
                <td><input type="hidden" class="form-control" id="category<?php echo $i?>" name="category<?php echo $i?>" onchange="loadItems(<?php echo $i?>,this.value)"></td><td>&nbsp;&nbsp;</td>
                <td><input type="hidden" class="form-control" id="item<?php echo $i?>" name="item<?php echo $i?>">
                	<input type="text" class="form-control removespace" id="item_name<?php echo $i?>" name="item_name<?php echo $i?>" style="padding: 0">
                </td><td>&nbsp;&nbsp;</td>
                <td><input type="text" style="padding: 0" class="form-control removespace" onkeyup="suggest(this.value,<?php echo $i?>);" onblur="fill(22222);fillId();" id="desc<?php echo $i?>" name="desc<?php echo $i?>">
                <div class="suggestionsBox" id="suggestions<?php echo $i?>" style="display: none;margin-top: 100px"> <div class="suggestionList" id="suggestionsList<?php echo $i?>"> &nbsp; </div>
  				</div>
                
                </td><td>&nbsp;&nbsp;</td>
                <td><input type="text" style="padding: 0" class="form-control onlyNumbers removespace" id="qty_piece<?php echo $i?>" name="qty_piece<?php echo $i?>" size="1" onblur="calLength(<?php echo $i?>);totalSft(<?php echo $i?>)"></td><td>&nbsp;&nbsp;</td>
                <td><input type="text" style="padding: 0" class="form-control removespace" onkeypress="return isDecimalNumber(event,this);" id="qty_sft<?php echo $i?>" onfocus="" name="qty_sft<?php echo $i?>" size="3"></td><td>&nbsp;&nbsp;</td> 
                <td><input type="text" style="padding: 0" class="form-control removespace" onkeypress="return isDecimalNumber(event,this);" id="item_stock<?php echo $i?>" onfocus="getCurrentStock(<?php echo $i?>)" size="3"></td><td>&nbsp;&nbsp;</td>                
                <td><input type="hidden" style="padding: 0" class="form-control removespace" onkeypress="return isDecimalNumber(event,this);" value=0 id="cost<?php echo $i?>" name="cost<?php echo $i?>" size="5"  onblur="calCost(<?php echo $i?>)">
                <input type="hidden" value=0 id="cost<?php echo $i?>"></td>
                <td>&nbsp;&nbsp;<input type="hidden" style="padding: 0" value="0" class="form-control removespace" onkeypress="return isDecimalNumber(event,this);" id="discount<?php echo $i?>" name="discount<?php echo $i?>" onblur="calCost(<?php echo $i?>)" size="3">
				<input type="hidden" style="padding: 0" value="0" class="form-control removespace" onkeypress="return isDecimalNumber(event,this);" id="vat<?php echo $i?>" name="vat<?php echo $i?>" onblur="calCost(<?php echo $i?>)" size="3"></td>
                <td><input type="hidden" style="padding: 0" class="form-control removespace" id="fcost<?php echo $i?>" name="fcost<?php echo $i?>" value=0 readonly="readonly" size='4'></td><td>&nbsp;&nbsp;</td>
                <td><input type="hidden" style="padding: 0" class="form-control removespace" id="lcost<?php echo $i?>" name="lcost<?php echo $i?>" value=0 readonly="readonly" size='4'></td><td>&nbsp;&nbsp;</td>
                <td><input type="hidden" class="form-control" id="tlcost<?php echo $i?>" name="tlcost<?php echo $i?>" readonly="readonly"></td><td>&nbsp;&nbsp;</td>
                <td><input type="hidden" style="padding: 0" class="form-control" id="barcode<?php echo $i?>" value="" size='4'></td>
                <td style="visibility: hidden;" id="clear<?php echo $i?>"><a href="javascript:void(0)" onclick="calCost(<?php echo $i?>);clearData(<?php echo $i?>)"><img title="Clear" src="<?php echo $UI_ELEMENTS?>/images/clear.png" width="20px"></a></td>
                
                </tr>
                <tr><td></td></tr>
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
	             <tr><td></td><td><input value=0 type="hidden" class="form-control" onfocus="calFinalCost()" id="grand_total" name="grand_total" readonly="readonly"/></td>
	             <td>&nbsp;</td>
	             <td></td><td id="other_expenses_v"><input value=0 type="hidden" onkeypress="return isNumberKey(event)" class="form-control" onfocus="calFinalCost()" id="other_expenses" name="other_expenses"/></td>
	             <td>&nbsp;</td>
	             <td></td><td id="transport_expenses_v"><input value=0 type="hidden" onkeypress="return isNumberKey(event)" class="form-control"  onblur="calFinalCost()" id="transport_expenses" name="transport_expenses"/></td>
	             <td>&nbsp;</td>
	             <td></td><td id="hamali_expenses_v"><input type="hidden" value=0 class="form-control" onkeypress="return isNumberKey(event)" onblur="calcalFinalCost()" id="hamali_expenses" name="hamali_expenses" value='0' /></td>
	             <td>&nbsp;</td>
	             <td></td><td><input type="hidden" class="form-control" value=0 onfocus="calFinalCost()" id="total" name="total" readonly="readonly"/> </td>
	             <td>&nbsp;</td></tr>
	             <tr><td>Note</td><td><textarea class="form-control" name="note" id="note"></textarea></td></tr>
	             <tr><td>&nbsp;</td></tr>
	             </table>
                  <!-- /.box-body -->

                    <div class="form-group">      
                    <input type="button" class="btn btn-block btn-success" onclick="calFinalCost();validate()" value="Create Order Form">             
					
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
    
  
    <!-- AdminLTE for demo purposes -->
    <?php include_once "$D_PATH/include/scripts_bottom.php";?>
  </body>
</html>
