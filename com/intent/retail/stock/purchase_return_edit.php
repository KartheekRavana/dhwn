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
  
  <link href="<?php echo $UI_ELEMENTS?>plugins/select2/select2.min.css" rel="stylesheet" type="text/css" />
  
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

    //  document.getElementById("fcost"+count).value=qty*cost;
    //document.getElementById("cost"+count).value=(cost)-((disc/100)*(cost));
	if(disc!="" && cost!="" && qty!="")
	{
		//document.getElementById("fcost"+count).value=(qty*cost)-((disc/100)*(qty*cost));
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
    			
    			//document.getElementById("lcost"+i).value=((parseFloat(document.getElementById("cost"+i).value)+cost_unit)).toFixed(2);
    			document.getElementById("tlcost"+i).value=(parseFloat(document.getElementById("lcost"+i).value)*parseInt(document.getElementById("qty_sft"+i).value)).toFixed(2);
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

			
			document.getElementById("grand_total1").value=document.getElementById("grand_total").value
			document.getElementById("other_expenses1").value=document.getElementById("other_expenses").value
			document.getElementById("transport_expenses1").value=document.getElementById("transport_expenses").value
			document.getElementById("hamali_expenses1").value=document.getElementById("hamali_expenses").value
			document.getElementById("total1").value=document.getElementById("total").value
			document.getElementById("note1").value=document.getElementById("note").value
			
			var data="";
			var count=document.getElementById("count").value-1;
			for(var i=1;i<count;i++)
			{
				var category="0";
				var item=$("#item"+i).val();
				var qty_piece=$("#qty_piece"+i).val();
				var qty_sft=$("#qty_sft"+i).val();
				var cost=$("#cost"+i).val();
				var fcost=$("#fcost"+i).val();
				var lcost=$("#lcost"+i).val();
				var tlcost=$("#tlcost"+i).val();
				var tran_id=$("#tran_id_"+i).val();
				var discount=$("#discount"+i).val();
				var vat=$("#vat"+i).val();
				var desc=$("#desc"+i).val();
				if(vat==""){vat=0;}
				
				if(category!="" && item!="" && qty_piece!="" && qty_sft!="" && cost!="" && fcost!="" && lcost!="")
				{
					data=data+"//"+category+"#"+item+"#"+qty_sft+"#"+qty_piece+"#"+cost+"#"+fcost+"#"+lcost+"#"+tlcost+"#"+tran_id+"#"+discount+"#"+desc+"#"+vat;
				}
				
				
			}
			
			
			if(data=="")
			{
				alert("No Data To Submit");
				state="2";
			}
			document.getElementById("data").value=data
			if(state==2){return false;}
			var result = confirm("Are Your Sure, Want to Update Bill?");
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
       		document.getElementById("subcategory"+row).options.length = 0;
       		
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
       		
       	 xmlhttp.open("GET",D_PATH+"/stock/load/getsub_categorys.php?category="+category,true);
       	 xmlhttp.send();
       		



       	}

       function loadItems1(row,val)
       {
         
       	
       	 var cid=document.getElementById("category1").value;
       	 var sid=document.getElementById("subcategory1").value;
       	var filter=document.getElementById("filter").value
        document.getElementById("items_load").innerHTML="Loading....";
        
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
       		
       	 xmlhttp.open("GET",D_PATH+"/stock/load/loaditems.php?&category="+cid+"&subcategoryid="+sid+"&filter="+filter,true);
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
		xmlhttp.open("GET",D_PATH+"/stock/load/supplierdetails.php?supplier_id="+supplier_id,true);
		xmlhttp.send();

	}

	function getitem_name(col)
	{
		var count=document.getElementById("count").value-1;
		var count2=document.getElementById("count2").value
		
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
				 xmlhttp.open("GET",D_PATH+"/stock/load/loaditems.php?&category="+category+"&subcategoryid="+subcategory+"&filter="+filter,true);
				 xmlhttp.send();
							
			}

           </script>
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
	}
	setTimeout("$('#suggestions'"+row+").fadeOut();", 600);

	setTimeout(function(){ document.getElementById("suggestions"+row).style.display="none";return false; }, 300);
}
function fillId(thisValue) {
	var row=document.getElementById("row").value;
	document.getElementById("qty_piece"+row).focus();
	$('#country_id'+row).val(thisValue);
	setTimeout("$('#suggestions'"+row+").fadeOut();", 600);

	setTimeout(function(){ document.getElementById("suggestions"+row).style.display="none";return false; }, 300);
}

</script>
  <script type="text/javascript">
	function clearData(i)
	{
		if(document.getElementById("tran_id_"+i).value==0)
		{
			document.getElementById("category"+i).value="";  
			document.getElementById("item"+i).value="";
			document.getElementById("item_name"+i).value="";
			document.getElementById("qty_piece"+i).value="";
			document.getElementById("qty_sft"+i).value="";
			document.getElementById("cost"+i).value="";
			document.getElementById("discount"+i).value="";
			document.getElementById("fcost"+i).value="";
			document.getElementById("lcost"+i).value="";
			document.getElementById("tlcost"+i).value="";
			document.getElementById("desc"+i).value="";
			document.getElementById("barcode"+i).value="";
		}else
		{       
	//	document.getElementById("category"+i).value="";  
		//document.getElementById("item"+i).value="";
		//document.getElementById("item_name"+i).value="";
		document.getElementById("qty_piece"+i).value="0";
		document.getElementById("qty_sft"+i).value="0";
		document.getElementById("cost"+i).value="0";
		document.getElementById("discount"+i).value="0";
		document.getElementById("fcost"+i).value="0";
		document.getElementById("lcost"+i).value="0";
		document.getElementById("tlcost"+i).value="0";
		//document.getElementById("desc"+i).value="";
		document.getElementById("barcode"+i).value="";
		}
		calFinalCost()
	}
	</script>
            <script type="text/javascript">
	function calLength(row)
	{
		
		var sft=1;
		document.getElementById("piece_sft_"+row).value=1;
        //alert(document.getElementById("category"+row).value)
		if(document.getElementById("category"+row).value=="1")
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
  <body class="<?php echo $body_style?>">
    <div class="wrapper">
      
      <?php include_once "$D_PATH/include/header.php";?> 
      <!-- Left side column. contains the logo and sidebar -->
       <?php include_once "$D_PATH/include/side.php";?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Supplier Bill Edit
           
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php?action=index&c=dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Supplier</a></li>
            <li><a href="index.php?action=view&c=supplier">View Supplier</a></li>
            <li><a href="index.php?action=statement&c=supplier&c_id=<?php echo $_GET["c_id"]?>">Supplier Statement</a></li>
            <li class="active">Edit Bill</li>
          </ol>
        </section>
          <section class="content">
          
          <form role="form" onsubmit="return validate()" action="index.php?action=operations/supplier_return_billUpdate&c=stock" method="POST">
          <input type='hidden' id='data' name='data'>
               
          <input type='hidden' id='grand_total1' name='grand_total'>
          <input type='hidden' id='other_expenses1' name='other_expenses'>
          <input type='hidden' id='transport_expenses1' name='transport_expenses'>
          <input type='hidden' id='hamali_expenses1' name='hamali_expenses'>
          <input type='hidden' id='total1' name='total'>
          <input type='hidden' id='note1' name='note'>
          
          <input type='hidden' id='bill_id' name='bill_id' value="<?php echo $_GET["bill_no"]?>">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
               
                <!-- form start -->
                <br/>
                <?php 
             
                $bill_no=$_GET["bill_no"];
 
                 $data = mysql_query("SELECT sk_bill_id, slip_no,bill_date, bill_time, member_id,cmeasurement, member_name, mobile, place, bill_for, bill_type, bill_amount, tax_rate, tax_amount, t_discount_rate, t_discount_amount, bill_tax_amount, transporter_id, transport_amount, other_expenses, hamali, grand_total, cash_amount, check_amount, paid_amount, discount, balance_amount, note, bank_id, bill_status, measurement_slip_no,agent_id,agent_rate,agent_amount, employee_id, branch_id,invoice_amt,vat_rate,vat,purchase_exp FROM mst_bill_main where sk_bill_id=$bill_no");
                while($info = mysql_fetch_array( $data ))
                {
                	$supplier_id=$info["member_id"];
                
                	$mobile=$info['mobile'];
                	$city=$info['place'];
                	$bill_no=$info['sk_bill_id'];
                	$bill_date=$info['bill_date'];
                	 $bill_amount=$info["bill_amount"];
                	$tax_rate=$info["tax_rate"];
                	$tax_amount=$info["tax_amount"];
                	$tax_discount_rate=$info["t_discount_rate"];
                	$tax_discount=$info["t_discount_amount"];
                	$transporter_id=$info["transporter_id"];
                	$bill_tax_amount=$info["bill_tax_amount"];
                	$transporter_id=$info["transporter_id"];
                	$transport_amount=$info["transport_amount"];
                	$other_expenses=$info["other_expenses"];
                	$grand_total=$info["grand_total"];
                	$cash_amount=$info["cash_amount"];
                	$check_amount=$info["check_amount"];
                	$paid_amount=$info["paid_amount"];
                	$discount=$info["discount"];
                	$balance_amount=$info["balance_amount"];
                	$note=$info["note"];
                	$bank_id=$info["bank_id"];
                	$measurement_slip_no=$info["measurement_slip_no"];
                	$hamali=$info["hamali"];
                	$slip_no=$info["slip_no"];

                	$cmeasurement=$info["cmeasurement"];
                	$agent_id=$info["agent_id"];
                	$agent_rate=$info["agent_rate"];
                	$agent_amount=$info["agent_amount"];
                	
                	$invoice_amt=$info["invoice_amt"];
                	$vat_rate=$info["vat_rate"];
                	$vat=$info["vat"];
                	$purchase_exp=$info["purchase_exp"];
                }
                                
       $data = mysql_query("SELECT sk_member_id, member_type, member_name, acc_no, ifsc, mobile, landline, email, address, place, state, profile_pic, login_name, login_password, login_status, member_status, employee_id, branch_id FROM mst_member where sk_member_id=$supplier_id");
                while($info = mysql_fetch_array( $data ))
                {
                	$customer_name=$info['member_name'];
                	$mobile=$info['mobile'];
                	$city=$info['place'];       
                	$customer_type="Credit";
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
                </table><br/>
                </div>
                </div>
                
                
                 <div class="col-xs-3" >
             

              <div class="box" >
                
                <div class="box-body" >
                </br>
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
                <div id="items_load" style="height: 50%;overflow:auto;"></div>
                </div>
                </div>
                </div>  <!-- /.row -->
          <div class="col-xs-9">
             

              <div class="box">
                
                <div class="box-body" style="height: 500px;overflow: scroll;">
           
                <br/>
                <table style="width: 96%;margin-left: 2%">
                <tr><th></th><td>&nbsp;&nbsp;</td><th></th><td>&nbsp;&nbsp;</td>
                <th>Items</th><td>&nbsp;&nbsp;</td><th>Desc</th><td>&nbsp;&nbsp;</td>
                <th>In&nbsp;Piece</th><td>&nbsp;&nbsp;</td><th>Sft/Box</th><td>&nbsp;&nbsp;</td><th>Cost</th><td>&nbsp;&nbsp;</td><th>Disc%</th><td>&nbsp;&nbsp;</td><th>Vat%</th><td>&nbsp;&nbsp;</td><th>Final Cost</th>
                <td>&nbsp;&nbsp;</td><th>Lan Cost</th><td>&nbsp;&nbsp;</td><th></th></tr>
                <?php 
                $i=0;
                $k="";
                $itemname="";
                $length="";
                $breadth="";
                $thickness="";
                $query=mysql_query("SELECT sk_tran_id, bill_id, bill_for, bill_type, bill_date, particular_id,description, qty_in_piece, qty_in_sft, rate,vat,discount, amount,landing_cost, bill_status, employee_id, branch_id FROM txn_bill_support where bill_id='".$bill_no."' and qty_in_sft>0");
                while($info=mysql_fetch_array($query))
                {
                	
                	$vat=$info["vat"];
                	
                	$name="";
               	
                	 $query1=mysql_query("select item_name,color,packing,category,thickness,length,breadth from items where item_id='".$info["particular_id"]."'");
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
                	 
                	 if($info["rate"]>=0)
                	 {
                	 	$i=$i+1;
                	?>
                	<input type="hidden" id="piece_sft_<?php echo $i?>" value="<?php echo $length*$breadth?>">
                	<input type="hidden" id="tran_id_<?php echo $i?>" value="<?php echo $info["sk_tran_id"]?>">
                <tr>
                <td><?php echo $i?></td><td>&nbsp;&nbsp;</td>
                <td><input type="hidden" class="form-control" id="category<?php echo $i?>" value='<?php echo $category?>' onchange="loadItems(<?php echo $i?>,this.value)"></td><td>&nbsp;&nbsp;</td>
                <td><input type="hidden" class="form-control" id="item<?php echo $i?>" value="<?php echo $info["particular_id"]?>">
                	<input type="text" style="padding: 0" class="form-control" id="item_name<?php echo $i?>" value="<?php echo $name?>">
                </td><td>&nbsp;&nbsp;</td>
                 <td><input type="text" style="padding: 0" class="form-control removespace" value="<?php echo $description?>" onkeyup="suggest(this.value,<?php echo $i?>);" onblur="calLength(<?php echo $i?>);fill(22222);fillId();" id="desc<?php echo $i?>">
                <div class="suggestionsBox" id="suggestions<?php echo $i?>" style="display: none;"> <div class="suggestionList" id="suggestionsList<?php echo $i?>"> &nbsp; </div>
  				</div>
                
                </td><td>&nbsp;&nbsp;</td>
                <td><input type="text" style="padding: 0" class="form-control onlyNumbers" id="qty_piece<?php echo $i?>" size="1" onblur="calLength(<?php echo $i?>);totalSft(<?php echo $i?>)" value="<?php echo $info["qty_in_piece"]?>"></td><td>&nbsp;&nbsp;</td>
                <td><input type="text" style="padding: 0" class="form-control" onkeypress="return isDecimalNumber(event,this);" id="qty_sft<?php echo $i?>" size="3" value="<?php echo $info["qty_in_sft"]?>"></td><td>&nbsp;&nbsp;</td>
                <td><input type="text" style="padding: 0" class="form-control" onkeypress="return isDecimalNumber(event,this);" id="cost<?php echo $i?>" size="5" onblur="calCost(<?php echo $i?>)" value="<?php echo $info["rate"]?>">
                 
                </td><td>&nbsp;&nbsp;</td>
                <td><input type="text" class="form-control removespace" onkeypress="return isDecimalNumber(event,this);" id="discount<?php echo $i?>" onblur="calCost(<?php echo $i?>)" value="<?php echo $info["discount"]?>" size="3"></td><td>&nbsp;&nbsp;</td>
                <td><input type="text" style="padding: 0" value="<?php echo $vat?>" class="form-control removespace" onkeypress="return isDecimalNumber(event,this);" id="vat<?php echo $i?>" onblur="calCost(<?php echo $i?>)" size="3"></td><td>&nbsp;&nbsp;</td>
                <td><input type="text" style="padding: 0" class="form-control" id="fcost<?php echo $i?>" readonly="readonly" size='4' value="<?php echo $info["amount"]?>"></td><td>&nbsp;&nbsp;</td>
                <td><input type="text" style="padding: 0" class="form-control" id="lcost<?php echo $i?>" readonly="readonly" size='4' value="<?php echo $info["landing_cost"]?>"></td><td>&nbsp;&nbsp;</td>
                <td><input type="hidden" class="form-control" id="tlcost<?php echo $i?>" readonly="readonly" ></td><td>&nbsp;&nbsp;</td>
                 <td id="clear<?php echo $i?>"><a href="javascript:void(0)" onclick="calCost(<?php echo $i?>);clearData(<?php echo $i?>)"><img title="Clear" src="<?php echo $UI_ELEMENTS?>/images/clear.png" width="20px"></a></td>
               
                </tr>
                <tr><td>&nbsp;</td></tr>
                <?php }
                }$k=$i+1;
                ?>
                <input type="hidden" name="count2" id="count2" value="<?php echo $k?>">
                <?php 
                for($i=$k;$i<=850;$i++)
                {
                ?><input type="hidden" id="piece_sft_<?php echo $i?>">
                <input type="hidden" id="tran_id_<?php echo $i?>" value="0">
                <tr>
                <td><?php echo $i?></td><td>&nbsp;&nbsp;</td>
                <td><input type="hidden" class="form-control" id="category<?php echo $i?>" onchange="loadItems(<?php echo $i?>,this.value)"></td><td>&nbsp;&nbsp;</td>
                <td><input type="hidden" class="form-control" id="item<?php echo $i?>">
                	<input type="text" style="padding: 0" class="form-control" id="item_name<?php echo $i?>">
                </td><td>&nbsp;&nbsp;</td>
                 <td><input type="text" style="padding: 0" class="form-control removespace" onkeyup="suggest(this.value,<?php echo $i?>);" onblur="calLength(<?php echo $i?>);fill(22222);fillId();" id="desc<?php echo $i?>">
                <div class="suggestionsBox" id="suggestions<?php echo $i?>" style="display: none;"> <div class="suggestionList" id="suggestionsList<?php echo $i?>"> &nbsp; </div>
  				</div>
                
                </td><td>&nbsp;&nbsp;</td>
                <td><input type="text" style="padding: 0" class="form-control onlyNumbers" id="qty_piece<?php echo $i?>" size="1" onblur="totalSft(<?php echo $i?>)"></td><td>&nbsp;&nbsp;</td>
                <td><input type="text" style="padding: 0" class="form-control" onkeypress="return isDecimalNumber(event,this);" id="qty_sft<?php echo $i?>" size="3"></td><td>&nbsp;&nbsp;</td>
                <td><input type="text" style="padding: 0" class="form-control" onkeypress="return isDecimalNumber(event,this);" id="cost<?php echo $i?>" size="5" onblur="calCost(<?php echo $i?>)">
                <input type="hidden" id="cost<?php echo $i?>" value="<?php echo $info["item_rate"]?>">
                </td><td>&nbsp;&nbsp;</td>
                <td><input type="text" value="0" class="form-control removespace" onkeypress="return isDecimalNumber(event,this);" id="discount<?php echo $i?>" onblur="calCost(<?php echo $i?>)" size="3"></td><td>&nbsp;&nbsp;</td>
                <td><input type="text" style="padding: 0" value="0" class="form-control removespace" onkeypress="return isDecimalNumber(event,this);" id="vat<?php echo $i?>" onblur="calCost(<?php echo $i?>)" size="3"></td><td>&nbsp;&nbsp;</td>
                <td><input type="text" style="padding: 0" class="form-control" id="fcost<?php echo $i?>" readonly="readonly" size='4'></td><td>&nbsp;&nbsp;</td>
                <td><input type="text" style="padding: 0" class="form-control" id="lcost<?php echo $i?>" readonly="readonly" size='4'></td><td>&nbsp;&nbsp;</td>
                <td><input type="hidden" class="form-control" id="tlcost<?php echo $i?>" readonly="readonly"></td><td>&nbsp;&nbsp;</td>
                <td style="visibility: hidden;" id="clear<?php echo $i?>"><a href="javascript:void(0)" onclick="calCost(<?php echo $i?>);clearData(<?php echo $i?>)"><img title="Clear" src="<?php echo $UI_ELEMENTS?>/images/clear.png" width="20px"></a></td>
                
                </tr>
                <tr><td>&nbsp;</td></tr>
                <?php }?>
                
                </table>
                  <input type='hidden' name='count' id='count' value="<?php echo $i?>">
                  
                  
  <input type="hidden" id="row">
              </div>
        
            </div>
           
            
          </div>  
          <div class="col-xs-12">
             

              <div class="box">
                
                <div class="box-body">
           
                <br/>
                
                  <input type='hidden' name='count' id='count' value="<?php echo $i?>">
                  <table>
	             <tr><td>Total&nbsp;Amount*</td><td><input type="text" class="form-control" onfocus="calFinalCost()" id="grand_total" name="grand_total" value="<?php echo $bill_amount?>" readonly="readonly"/></td>
	             <td>&nbsp;</td>
	             <td>Other&nbsp;Exp*</td><td id="other_expenses_v"><input type="text" onkeypress="return isNumberKey(event)" class="form-control" value="<?php echo $other_expenses?>" onfocus="calFinalCost()" id="other_expenses" name="other_expenses"/></td>
	             <td>&nbsp;</td>
 <td>Transport*</td><td><select class="form-control" id="transporter" name="transporter">
  <?php 
                                   
                                  $data = mysql_query("SELECT sk_member_id,member_name FROM mst_member  where sk_member_id='$transporter_id'");
                                  if($data)
                                  while($info = mysql_fetch_array( $data ))
                                  {
                                  ?>  
	               <option  value="<?php echo $info["sk_member_id"]?>"><?php echo $info["member_name"]?></option>
	               <?php }?>
	              
	                <?php 
                                   
                                  $data = mysql_query("SELECT sk_member_id,member_name FROM mst_member  where member_type=4 order by member_name asc");
                                  if($data)
                                  while($info = mysql_fetch_array( $data ))
                                  {
                                  ?>  
	               <option  value="<?php echo $info["sk_member_id"]?>"><?php echo $info["member_name"]?></option>
	               <?php }?>
	               </select>
	               <td>&nbsp;</td>
	             <td>Transport&nbsp;Amount*</td><td id="transport_expenses_v"><input type="text" onkeypress="return isNumberKey(event)" value="<?php echo $transport_amount?>" class="form-control"  onblur="calFinalCost()" id="transport_expenses" name="transport_expenses"/></td>
	             <td>&nbsp;</td>
 <td>Hamali*</td><td><select class="form-control" id="hamali" name="hamali">
	               
	                <?php 
                                   
                                  $data = mysql_query("SELECT sk_member_id,member_name FROM mst_member  where member_type=9 order by member_name asc");
                                  if($data)
                                  while($info = mysql_fetch_array( $data ))
                                  {
                                  ?>  
	               <option  value="<?php echo $info["sk_member_id"]?>"><?php echo $info["member_name"]?></option>
	               <?php }?>
	               </select>
	             <td>&nbsp;</td>
	             <td>Hamali* </td><td id="hamali_expenses_v"><input type="text" class="form-control" onkeypress="return isNumberKey(event)" value="<?php echo $hamali?>"  onblur="calcalFinalCost()" id="hamali_expenses" name="hamali_expenses" value='0' /></td>
	             <td>&nbsp;</td>
	             <td>Total Value*</td><td><input type="text" class="form-control" onfocus="calFinalCost()" id="total" name="total" value="<?php echo $grand_total?>" readonly="readonly"/> </td>
	             <td>&nbsp;</td></tr>
	             <tr><td>Note</td><td><textarea class="form-control" name="note" id="note" ><?php echo $note?></textarea></td></tr>
	             <tr><td>&nbsp;</td></tr>
	             </table>
                  <!-- /.box-body -->

                    <div class="form-group">                  
					<button  class="btn btn-block btn-success" onclick="calFinalCost()">Update Stock</button>
				  </div>             
                  
              </div><!-- /.box -->
        
            </div><!--/.col (left) -->
            <!-- right column -->
            
          </div> 
          
                  </form>
                  
                  
                  <div class="col-xs-12">
             

              <div class="box">
                
                <div class="box-body">
                
                <form action="index.php?action=operations/supplierbillupdatediscount&c=supplier" method="post">
                <input type='hidden' id='bill_id' name='bill_id' value="<?php echo $_GET["bill_no"]?>">
                <input type="hidden" id="c_id" name="c_id" value="<?php echo $_GET["c_id"]?>">
                <?php $status="new";
                if($discount>0)
                {
                	$status="old";
                }
                ?>
                <input type="hidden" id="status" name="status" value="<?php echo $status?>">
                <table>
                <tr>
                	<td>Discount Date</td><td><input type='date' class="form-control" name='discount_date' value='<?php echo $discount_date?>' required="required"></td>
                	<td>Amount</td><td><input class="form-control" type='text' value='<?php echo $discount?>' name='amount' required="required"></td>
                
                </tr>
                <tr><td>&nbsp;</td></tr>
                </table>
                 <div class="form-group">                  
					<button  class="btn btn-block btn-success">Update Discount</button>
				  </div>  
				  
				    </form>
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
                                
<script src="<?php echo $UI_ELEMENTS?>plugins/select2/select2.full.min.js" type="text/javascript"></script>
    <!-- jQuery 2.1.3 -->
    <!-- AdminLTE for demo purposes -->
    <?php include_once "$D_PATH/include/scripts_bottom.php";?>
  </body>
</html>