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
		function validate()
		{			           
		
			var state="1";
			if($("#bill_no").val()==""){$("#bill_no_v").addClass('has-error');state="2";}
			if($("#bill_date").val()==""){$("#bill_date_v").addClass('has-error');state="2";}
			if($("#bill_type").val()==""){$("#bill_type_v").addClass('has-error');state="2";}
			if($("#payment_status").val()==""){$("#payment_status_v").addClass('has-error');state="2";}
			if($("#partner").val()==""){$("#partner_v").addClass('has-error');state="2";}
			
			if($("#mobile").val()==""){$("#mobile_v").addClass('has-error');state="2";}
			if($("#place").val()==""){$("#place_v").addClass('has-error');state="2";}
			if($("#consider").val()==""){$("#consider_v").addClass('has-error');state="2";}

			if($("#bill_type").val()=="Cash"){
			if($("#customer_name").val()==""){$("#customer_name_v").addClass('has-error');state="2";}
			}else{
				if($("#bill_type1").val()=="Existing"){
					if($("#customer_id").val()==""){$("#customer_name_v").addClass('has-error');state="2";}
				}
				else
				{
					if($("#customer_name").val()==""){$("#customer_name_v").addClass('has-error');state="2";}
				}
				
				
			}

			if($("#grand_total").val()==""){$("#grand_total_v").addClass('has-error');state="2";}
			if($("#tax").val()==""){$("#tax_v").addClass('has-error');state="2";}
			if($("#transport").val()==""){$("#transport_v").addClass('has-error');state="2";}
			if($("#other_expenses").val()==""){$("#other_expenses_v").addClass('has-error');state="2";}
			if($("#total").val()==""){$("#total_v").addClass('has-error');state="2";}
			if($("#cash_amount").val()==""){$("#cash_amount_v").addClass('has-error');state="2";}
			if($("#check_amount").val()==""){$("#check_amount_v").addClass('has-error');state="2";}
			if($("#paid_amt").val()==""){$("#paid_amt_v").addClass('has-error');state="2";}
			if($("#discount").val()==""){$("#discount_v").addClass('has-error');state="2";}
			if($("#balance").val()==""){$("#balance_v").addClass('has-error');state="2";}

			if($("#check_amount").val()>0){
			if($("#bank").val()==""){$("#bank_v").addClass('has-error');state="2";}
			}	

			
			var data="";
			var count=document.getElementById("count").value;
			for(var i=1;i<count;i++)
			{
				var category=$("#category"+i).val();
				var item=$("#item"+i).val();
				var desc=$("#desc"+i).val();
				var qty_piece=$("#qty_piece"+i).val();
				var qty_sft=$("#qty_sft"+i).val();
				var cost=$("#cost"+i).val();
				var fcost=$("#fcost"+i).val();
				var barcode=$("#barcode"+i).val();
				var disc=document.getElementById("discount"+i).value;
				var note=document.getElementById("note"+i).value;
				if(item!="" && qty_piece!="" && qty_sft!="" && cost!="" && fcost!="")
				{
					data=data+"//"+item+"#"+qty_piece+"#"+qty_sft+"#"+cost+"#"+fcost+"#"+desc+"#"+barcode+"#"+disc+"#"+note;
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
	//document.getElementById("item"+row).className='';

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
		 var qty=parseFloat(document.getElementById("qty_sft"+count).value);
		 var cost=parseFloat(document.getElementById("cost"+count).value);
		 if(qty==""){qty=0;}if(cost==""){cost=0;}
		 var disc=document.getElementById("discount"+count).value;
		 if(disc==""){disc=0;}
if(disc==0){
	document.getElementById("fcost"+count).value=(qty*cost).toFixed(2);
}
else
{
	
	document.getElementById("fcost"+count).value=((qty*cost)-((parseFloat(disc)/100)*(qty*cost))).toFixed(2);
	
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
		 finalCost()
		 }
		 
 function finalCost()
 {

	 var count=document.getElementById("count").value;
 	 var tot=0;
	   for(var i=1;i<count;i++)
       {    
		  var qty_sft=document.getElementById("qty_sft"+i).value
		  var cost=document.getElementById("cost"+i).value
			if(qty_sft!='' && cost!='')
			{
				var disc=document.getElementById("discount"+i).value;
				 if(disc==""){disc=0;}
				 if(disc==0){
				document.getElementById("fcost"+i).value=qty_sft*cost
				tot=tot+(qty_sft*cost)
				 }else{

					 document.getElementById("fcost"+i).value=(qty_sft*cost)-((parseFloat(disc)/100)*(qty_sft*cost))
						tot=(tot+(qty_sft*cost))-((parseFloat(disc)/100)*(qty_sft*cost))
				 }
			}
		  }
	   document.getElementById("grand_total").value=tot
	   
	   
	 var grand_total=document.getElementById("grand_total").value;if(grand_total==''){grand_total=0;}
	 var other_expenses=document.getElementById("other_expenses").value;if(other_expenses==''){other_expenses=0;}
	 var tax=document.getElementById("tax").value;if(tax==''){tax=0;}
	 var transport=document.getElementById("transport").value;if(transport==''){transport=0;}
 	document.getElementById("total").value=parseFloat(grand_total)+parseFloat(other_expenses)+parseFloat(tax)+parseFloat(transport);

 	if(document.getElementById("bill_type").value=="Cash")
 	{
	var paid_amt=document.getElementById("paid_amt").value
	if(paid_amt==""){paid_amt=0;}

	document.getElementById("cash_amount").value=document.getElementById("total").value
	cashe();
	Paid();
	Balance();
 	}
 	else
 	{
 		document.getElementById("cash_amount").value=0;
 		document.getElementById("check_amount").value=0;
 		document.getElementById("paid_amt").value=0;
 		document.getElementById("discount").value=0;
 		document.getElementById("balance").value=document.getElementById("total").value
 	}
	//document.getElementById("balance").value=(parseFloat(grand_total)+parseFloat(other_expenses)+parseFloat(tax)+parseFloat(transport))-paid_amt;
 	
 }

 function checkCustomer(val)
 {
	 document.getElementById("customer_name").value="";
	var bill_type= document.getElementById("bill_type").value
	var bill_type1= document.getElementById("bill_type1").value
	if(bill_type=="Credit" && bill_type1=='Existing')
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
     <script type="text/javascript">
			function copyDesc(row)
			{
			
				var val=document.getElementById("item"+row).options[document.getElementById('item'+row).selectedIndex].text;
				var temp=val.split("(")
				var temp1=temp[1].split(")")
				
				document.getElementById("desc"+row).value=temp1[0]
				
			}

           </script>
      <script type="text/javascript">
	function getBarItem(row)
	{
		
		var barcode=document.getElementById("barcode"+row).value

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
		  document.getElementById("clear"+row).style.visibility="";  
		//  document.getElementById("category"+row).className="form-control";
		//  document.getElementById("item"+row).className="form-control";
		$('#category'+row)[0].options.length = 0;
		$('#item'+row)[0].options.length = 0;
		  document.getElementById("category"+row).options[0]=new Option(temp[2],temp[1]);
		  document.getElementById("item"+row).options[0]=new Option(temp[4],temp[3]);
		  document.getElementById("qty_piece"+row).value=1 
		  document.getElementById("qty_sft"+row).value=1
		  document.getElementById("discount"+row).value=0 
		  document.getElementById("cost"+row).value=temp[5]
		  document.getElementById("fcost"+row).value=parseFloat(temp[5])*1;
		  copyDesc(row)

		  calCost(row)
		  finalCost()
			  }
		}

		 var D_PATH=document.getElementById("D_PATH").value
			var DIR=document.getElementById("DIR").value
		xmlhttp.open("GET",D_PATH+"/"+DIR+"/load/getItems.php?barcode="+barcode+"&category=0",true);
		xmlhttp.send();
		}
		
	}

      </script>
 <script type="text/javascript">
function getAllItem(row)
{
  
		document.getElementById("barcode").focus()
	 

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
		 var count=document.getElementById("count").value
			for(var i=1;i<=count;i++)
			{document.getElementById("item"+i).options.length = 0;
		for(var j=1;j<=temp1;j++)
		{
			 var temp2=temp[j].split("//");
			document.getElementById("item"+i).options[j]=new Option(temp2[0],temp2[1]);
			
		    }
			}
	     }
	   }

	 var D_PATH=document.getElementById("D_PATH").value
		var DIR=document.getElementById("DIR").value
		
	 xmlhttp.open("GET",D_PATH+"/"+DIR+"/load/getAllItems.php",true);
	 xmlhttp.send();
		



	}

</script>
  <script type="text/javascript">
        function copyBarcode(val)
        {
        	 var count=document.getElementById("count").value;
        	 document.getElementById("note1").focus();
           for(var i=1;i<count;i++)
           {
          var category=document.getElementById("category"+i).value;
   		  var item=document.getElementById("item"+i).value;
   		  var qty_piece=document.getElementById("qty_piece"+i).value
   		  var qty_sft=document.getElementById("qty_sft"+i).value
   		  var cost=document.getElementById("cost"+i).value
   		  var fcost=document.getElementById("fcost"+i).value
   		 var barcode=document.getElementById("barcode"+i).value
   		
	   		if(barcode==val)
			{
	   		 document.getElementById("qty_piece"+i).value=parseInt(qty_piece)+1;
	   		  document.getElementById("qty_sft"+i).value=parseFloat(qty_sft)+1
	   		document.getElementById("barcode").value="";
	   		 document.getElementById("barcode").focus();
	   		finalCost()
	   		  return false;
			}

   		  
			if(category=='' && item=='' && qty_piece=='' && qty_sft=='' && cost=='' && fcost=='')
			{
				document.getElementById("barcode"+i).value=val;
				getBarItem(i)
				document.getElementById("barcode").value="";
				finalCost()
				 document.getElementById("barcode").focus();
				return false;
			}
   		  }
   		  
        }
        </script>
          <script type="text/javascript">
	function clearData(i)
	{
		document.getElementById("category"+i).value="";
		document.getElementById("item"+i).value="";
		document.getElementById("qty_piece"+i).value="";
		document.getElementById("qty_sft"+i).value="";
		document.getElementById("cost"+i).value="";
		document.getElementById("discount"+i).value="";
		document.getElementById("fcost"+i).value="";
		document.getElementById("desc"+i).value="";
		document.getElementById("barcode"+i).value="";
		
		finalCost()
	}

    </script>
          <script type="text/javascript">
		function copyToBill(row)
		{
			 var count=document.getElementById("count").value;
			 
			 var new_cat=document.getElementById("category"+row).value;
				var new_item=document.getElementById("item"+row).value;
				var new_cat_val=document.getElementById("category"+row).options[document.getElementById('category'+row).selectedIndex].text;
				var new_item_val=document.getElementById("item"+row).options[document.getElementById('item'+row).selectedIndex].text;
				 
	           for(var i=1;i<count;i++)
	           {
	        	   var category=document.getElementById("category"+i).value;
	 	   		  var item=document.getElementById("item"+i).value;
	 	   		  var qty_piece=document.getElementById("qty_piece"+i).value
	 	   		  var qty_sft=document.getElementById("qty_sft"+i).value
	 	   		  var cost=document.getElementById("cost"+i).value
	 	   		  var fcost=document.getElementById("fcost"+i).value

		 	   		 var desc=document.getElementById("desc"+i).value
	 	   		 var barcode=document.getElementById("barcode"+i).value

	 	   		var temp=new_item_val.split("(")
				var temp1=temp[1].split(")")
				
				
	 	   		if(category==new_cat && item==new_item && desc==temp1[0])
	 			{
	 	   		 document.getElementById("qty_piece"+i).value=parseInt(qty_piece)+1;
	 	   		  document.getElementById("qty_sft"+i).value=parseFloat(qty_sft)+1
	 	   		document.getElementById("barcode").value="";
	 	   		finalCost()
	 	   		  return false;
	 			}
		 			
				if(category=='' && item=='' && qty_piece=='')
				{
					document.getElementById("category"+i).options.length = 0;
					 document.getElementById("item"+i).options.length = 0;
					 
					 document.getElementById("clear"+i).style.visibility="";  
					  document.getElementById("category"+i).options[0]=new Option(new_cat_val,new_cat);
					  document.getElementById("item"+i).options[0]=new Option(new_item_val,new_item);
	
					 document.getElementById("qty_piece"+i).value=1;
		 	   		 document.getElementById("qty_sft"+i).value=1;
		 	   		 document.getElementById("cost"+i).value=0;
		 	   		 document.getElementById("fcost"+i).value=0;
		 	   		var temp=new_item_val.split("(")
					var temp1=temp[1].split(")")
					document.getElementById("desc"+i).value=temp1[0]
		 	   		//document.getElementById("desc"+i).value=new_item_val
		 	   		
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
	      		//  document.getElementById("category"+row).className="form-control";
	      		//  document.getElementById("item"+row).className="form-control";
	      		  document.getElementById("discount"+i).value=0
	      		  document.getElementById("cost"+i).value=temp[1]
	      		  document.getElementById("fcost"+i).value=parseFloat(temp[1])*1;
	      		
	      		  copyDesc(i)
					
	      		  calCost(i)
	      		  finalCost()
		       		
	       	     }
	       	   }

	       	 var D_PATH=document.getElementById("D_PATH").value
	       		var DIR=document.getElementById("DIR").value
	       		xmlhttp.open("GET",D_PATH+"/"+DIR+"/load/getItemsByDesc.php?barcode=0&category=0&item_id="+new_item+"&desc="+temp1[0],true);
	       	 
	       	 xmlhttp.send();
		 	   		
					return false;
				}


					
	   		  }



	     
		}

       </script>
         
  </head>
  <body class="<?php echo $body_style?> sidebar-collapse" ><!-- onload="getAllItem('All')" -->
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
          <script type="text/javascript">
			function check()
			{
				return false;
			}
          </script>
          <form action="#" onsubmit="return check()">
          <table>
          <tr><td><input type="text" name="barcode" id="barcode" onchange="copyBarcode(this.value)" class="form-control" size='15px' placeholder="Barcode"></td>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
           <td><select class="form-control select2" style="padding: 0;width: 110px" id="category11111" name="category11111" onchange="loadItems(11111,this.value)"><option value=""></option><?php $data = mysql_query("SELECT category_id,category_name FROM category where category_status='active' and branch='".$session_branch."'");if($data)while($info = mysql_fetch_array( $data )){?><option  value="<?php echo $info["category_id"]?>"><?php echo $info["category_name"]?></option><?php }?></select></td><td>&nbsp;&nbsp;</td>
                <td><select class="form-control select2" onchange="copyDesc(11111)" style="width: 350px" id="item11111" name="item11111"><option value=""></option></select></td><td>&nbsp;&nbsp;</td>
                <td><input type='button' value='Copy' onclick="copyToBill(11111)"></td>
               </tr>
               </table>
          </form>
          <form role="form" onsubmit="return validate()" name='myForm' action="index.php?action=operations/pickerlist_update&c=stock" method="POST">
          <input type='hidden' id='data' name='data'>
          
           <input type='hidden' name="session_branch" id="session_branch" value="<?php echo $session_branch?>">
           <input type="hidden" id='advance_amount' value="0" onkeypress="return isNumberKey(event)" class="form-control" onblur="finalCost()"   name="advance_amount"  readonly="readonly" />
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
               
                <!-- form start -->
                <br/>
                <table>
                <?php
                if(isset($_GET['pid']))
                {
                	$pid=$_GET['pid'];
                	$result=mysql_query("select * from customerpickermain where bill_no='$pid' ");
                	while($row=mysql_fetch_array($result))
                	{
                		$cust_name=$row['customer_name'];
                		$phone=$row['phone'];
                		$city=$row['city'];
                		$total=$row['total'];
                		$transport=$row['transport'];
                		$total_bal=$row['total_bal'];
                	}
                } 
                ?>
                <tr>
                	<td></td><td id='bill_no_v'><input type="hidden" class="form-control onlyNumbers" id="bill_no" name="bill_no" value="<?php echo $pid?>"></td><td>&nbsp;&nbsp;</td>
                	<td>Bill&nbsp;Date</td><td id='bill_date_v'><input type="date" style="width: 140px" class="form-control" id="bill_date" name="bill_date" value="<?php echo $date?>"></td><td>&nbsp;&nbsp;</td>
                	<td>Bill&nbsp;Type</td><td id='bill_type_v'><select style="width: 80px;float: left" class="form-control" id="bill_type" name="bill_type" onchange="checkCustomer(this.value),finalCost()"><option value="Cash">Cash</option><option value="Credit">Credit</option></select>
                	<select style="width: 80px;float: left" class="form-control" id="bill_type1" name="bill_type1" onchange="checkCustomer(this.value)"><option value="Existing">Existing</option><option value="New">New</option></select>
                	</td><td>&nbsp;&nbsp;</td>
                	<td>Payment&nbsp;Status</td><td id='payment_status_v'><select class="form-control" id="payment_status" name="payment_status"><option value="Done">Done</option><option value="Pending">Pending</option></select></td><td>&nbsp;&nbsp;</td>
                	<td></td><td id='partner_v'><input type="hidden" value="0" id="partner" name="partner">
                
                	<td>Customer</td><td id='customer_name_v'>
                	<span id="customer_type" style="position: absolute  ;">
                	<input type="text" class="form-control" id="customer_name" name="customer_name" value='<?php echo $cust_name?>'>
                	</span>
                	<span style="visibility: hidden;" id="customer_type1">
                	<select  name="customer_id" id="customer_id" class="form-control" style="position: relative ;width: 150px"  onchange="getCustomer(this.value)">
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
                	<input type='hidden' id='pid' name='pid' value='<?php echo $pid?>'>
                	</td><td>&nbsp;&nbsp;</td>
                	<td>Mobile</td><td id='mobile_v'><input type="text" maxlength="10" value="<?php echo $phone?>" class="form-control onlyNumbers" id="mobile" name="mobile"></td><td>&nbsp;&nbsp;</td>
                	<td>Place</td><td id='place_v'><input type="text" value="<?php echo $city?>" class="form-control" id="place" name="place" style="width: 160px"></td><td>&nbsp;&nbsp;</td>
                <td></td><td><input type="hidden" class="form-control" value='<?php echo $slip_no?>' readonly="readonly" onfocus="finalCost()" id="slip_no" name="slip_no"/></td>
                	<td></td><td id='consider_v'><input type="hidden" value="No" class="form-control" id="consider" name="consider"></td><td>&nbsp;&nbsp;</td>
                	
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
                <tr><th></th><td>&nbsp;&nbsp;</td><th>Barcode</th><td>&nbsp;&nbsp;</td><th>Category&nbsp;<a href="" class='click'>+</a></th><td>&nbsp;&nbsp;</td><th>Items&nbsp;&nbsp;&nbsp;<a href="" class='click'>+</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th><td>&nbsp;&nbsp;</td><th>Note</th><th>Qty In Piece</th><td>&nbsp;&nbsp;</td><th>Qty In Sft</th><td>&nbsp;&nbsp;</td><th>Cost</th><td>&nbsp;&nbsp;</td><th>Discount</th><td>&nbsp;&nbsp;</td><th>Final Cost</th></tr>
                <?php   $i=1;
                if(isset($_GET["pid"])){
                	$picker=$_GET["pid"];
                
                 
	         
	           
	           $data = mysql_query("SELECT bill_no, item_date, item_name, item_qty, item_rate, amt, item_qty_p,tran_id,description,discount,barcode,note FROM customerpicker where bill_no='".$picker."' and item_qty>0");
	           while($info = mysql_fetch_array( $data ))
	           {
	           	$item_id=$info["item_name"];
	           	$item_qty=$info["item_qty"];
	           	$item_qty_p=$info["item_qty_p"];
	           	$item_rate=$info["item_rate"];
	           	$amt=$info["amt"];
	           	$description=$info["description"];
	           	$discount=$info["discount"];
	           	$barcode=$info["barcode"];
	           	$note=$info["note"];
	          
	           	$data1 = mysql_query("SELECT item_id, item_name, item_status, kannada_name, category, branch FROM items where item_id='$item_id'");
	           	while($info1 = mysql_fetch_array( $data1 ))
	           	{
	           		$item_name=$info1["item_name"];
	           		$category_id=$info1["category"];
	           	}
	           	 
	           	$data1 = mysql_query("SELECT category_id, category_name, category_status, branch FROM category where category_id='$category_id'");
	           	while($info1 = mysql_fetch_array( $data1 ))
	           	{
	           		$category_name=$info1["category_name"];
	           	}
	           	
	               //  $discount=0;
	                 $vat=0;
	                // $item_rate=0;
	$data3 = mysql_query("SELECT discount,vat,rate FROM txn_bill_support WHERE particular_id='".$info["item_name"]."' and description='$description'");
	while($info3 = mysql_fetch_array($data3))
	{
		//$discount=$info3["discount"];
		$vat=$info3["vat"];
		//$item_rate=$info3["rate"];
	}
	           	
                ?>
               <!-- <?php //$data1 = mysql_query("SELECT category_id,category_name FROM category where category_status='active' and branch='".$session_branch."'");if($data1)while($info1 = mysql_fetch_array( $data1 )){?><option  value="<?php //echo $info1["category_id"]?>"><?php //echo $info1["category_name"]?></option><?php //}?> -->
               <input type='hidden' id="piece_sft_<?php echo $i?>">
                <tr>
                <td> <input type="hidden" id="desc<?php echo $i?>" value='<?php echo $description?>'><?php echo $i?></td><td>&nbsp;&nbsp;</td>
                <td><input type="text" class="form-control" value="<?php echo $barcode?>" id="barcode<?php echo $i?>" style="padding: 0;width: 80px" onblur="getBarItem(<?php echo $i?>)" ></td><td></td>
                <td><select class="form-control" style="padding: 0;width: 110px" id="category<?php echo $i?>" name="category<?php echo $i?>" onchange="loadItems(<?php echo $i?>,this.value)"><option value="<?php echo $category_id?>"><?php echo $category_name?></option><option value=""></option></select></td><td>&nbsp;&nbsp;</td>
                <td><select class="form-control" onchange="copyDesc(<?php echo $i?>)" style="padding: 0;width: 350px" id="item<?php echo $i?>" name="item<?php echo $i?>"><option value="<?php echo $item_id?>"><?php echo $item_name?> (<?php echo $description?>)</option><option value=""></option></select></td><td>&nbsp;&nbsp;</td>
                <td><input type='text' class="form-control" value='<?php echo $note?>' id='note<?php echo $i?>' size="12px" style="padding: 0;"></td>
                <td><input type="text" class="form-control onlyNumbers" value="<?php echo $item_qty_p?>" style="padding: 0;" id="qty_piece<?php echo $i?>" name="qty_piece<?php echo $i?>" onblur="calLength(<?php echo $i?>);totalSft(<?php echo $i?>)"></td><td>&nbsp;&nbsp;</td>
                <td><input type="text" class="form-control" style="padding: 0" value="<?php echo $item_qty?>" onkeypress="return isNumberKey(event)" id="qty_sft<?php echo $i?>" name="qty_sft<?php echo $i?>" onfocus="totalSft(<?php echo $i?>)" size="5" onblur="checkQty(<?php echo $i?>)"></td><td>&nbsp;&nbsp;</td>
                <td><input type="text" class="form-control" style="padding: 0" value="<?php echo $item_rate?>" onkeypress="return isNumberKey(event)" id="cost<?php echo $i?>" name="cost<?php echo $i?>" size="5" onblur="calCost(<?php echo $i?>)"></td><td>&nbsp;&nbsp;</td>
                <td><input type="text" class="form-control" style="padding: 0" value="<?php echo $discount?>" onkeypress="return isNumberKey(event)" id="discount<?php echo $i?>" name="discont<?php echo $i?>" size="5" onblur="calCost(<?php echo $i?>)"></td><td>&nbsp;&nbsp;</td>
                <td><input type="text" class="form-control" style="padding: 0" value="<?php echo $amt?>" id="fcost<?php echo $i?>" name="fcost<?php echo $i?>" readonly="readonly"></td>
                <td id="clear<?php echo $i?>"><a href="javascript:void(0)" onclick="calCost(<?php echo $i?>);clearData(<?php echo $i?>)"><img title="Clear" src="<?php echo $UI_ELEMENTS?>/images/clear.png" width="20px"></a>
                </td>
                <td></td>
                </tr>
                <tr><td>&nbsp;</td></tr>
                <?php $i++;}}?>
                 <?php $j=$i+1;$k=1;
               ?>
                 <?php 
                for($i=$i;$i<=55;$i++)
                {
                	$state='';
                	if($i>20){
                		$state="style='visibility: hidden;position: absolute;'";
                	}
                ?><input type='hidden' id="piece_sft_<?php echo $i?>">
                <tr id="subnewboxes<?php echo $i?>" name="subnewboxes<?php echo $i?>" <?php echo $state?>>
                <td><input type="hidden" id="desc<?php echo $i?>"><?php echo $i?></td><td>&nbsp;&nbsp;</td>
                <td><input type="text" class="form-control" name="" id="barcode<?php echo $i?>" style="padding: 0;width: 80px" onblur="getBarItem(<?php echo $i?>)"></td><td></td>
                <td><select class="form-control" style="padding: 0;width: 110px" id="category<?php echo $i?>" name="category<?php echo $i?>" onchange="loadItems(<?php echo $i?>,this.value)"><option value=""></option></select></td><td>&nbsp;&nbsp;</td>
                <td><select class="form-control" onchange="copyDesc(<?php echo $i?>)" style="padding: 0;width: 350px" id="item<?php echo $i?>" name="item<?php echo $i?>"><option value=""></option></select></td><td>&nbsp;&nbsp;</td>
                <td><input type='text' class="form-control" name='' id='note<?php echo $i?>' size="12px" style="padding: 0;"></td>
                <td><input type="text" class="form-control onlyNumbers" style="padding: 0" id="qty_piece<?php echo $i?>" name="qty_piece<?php echo $i?>"></td><td>&nbsp;&nbsp;</td>
                <td><input type="text" class="form-control" style="padding: 0" onkeypress="return isNumberKey(event)" id="qty_sft<?php echo $i?>" name="qty_sft<?php echo $i?>" onblur="checkQty(<?php echo $i?>)"></td><td>&nbsp;&nbsp;</td>
                <td><input type="text" class="form-control"  style="padding: 0" onkeypress="return isNumberKey(event)" id="cost<?php echo $i?>" name="cost<?php echo $i?>" onblur="calCost(<?php echo $i?>)"></td><td>&nbsp;&nbsp;</td>
                <td><input type="text" class="form-control" style="padding: 0" onkeypress="return isNumberKey(event)" id="discount<?php echo $i?>" name="discont<?php echo $i?>" size="5" onblur="calCost(<?php echo $i?>)"></td><td>&nbsp;&nbsp;</td>
                <td><input type="text" class="form-control" style="padding: 0" id="fcost<?php echo $i?>" name="fcost<?php echo $i?>" readonly="readonly"></td><td>&nbsp;&nbsp;</td>
                
                <td style="visibility: hidden;" id="clear<?php echo $i?>"><a href="javascript:void(0)" onclick="calCost(<?php echo $i?>);clearData(<?php echo $i?>)"><img title="Clear" src="<?php echo $UI_ELEMENTS?>/images/clear.png" width="20px"></a></td>
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
          
          
          <script type="text/javascript">
	function calLength(row)
	{
		var sft=1;
		document.getElementById("piece_sft_"+row).value=1;
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

	 function totalSft(count)
	   {
		  
	   	var qty=document.getElementById("piece_sft_"+count).value;
	   	var sft=document.getElementById("qty_piece"+count).value;
	 
	   	document.getElementById("qty_sft"+count).value=(qty*sft);
	   }
    </script>
          
          
          
          <div class="col-xs-3">
             <div class="box">
                
                <div class="box-body">
           
                <br/>
                
                  <input type='hidden' name='count' id='count' value="<?php echo $i?>">
                  <table>
	             <tr><td>Total&nbsp;Amount*</td><td id='grand_total_v'><input type="text" onkeypress="return isNumberKey(event)" class="form-control" onfocus="finalCost()" id="grand_total" name="grand_total" readonly="readonly" value="<?php echo $total?>"/></td></tr>
	 
	             <tr><td></td><td id='tax_v'><input style="visibility: hidden;" type="text" value='0' onkeypress="return isNumberKey(event)" class="form-control" onfocus="finalCost()" id="tax" name="tax"/></td></tr>
	             
	             <tr><td>Transport&nbsp;Amount*</td><td id='transport_v'><input type="text" value='<?php echo $transport?>' onkeypress="return isNumberKey(event)" class="form-control"  onblur="finalCost()" id="transport" name="transport"/></td></tr>
	         
	         <tr><td></td><td id='other_expenses_v'><input style="visibility: hidden" type="hidden" value="0" onkeypress="return isNumberKey(event)" class="form-control" onblur="finalCost()" id="other_expenses" value='0' name="other_expenses"/></td></tr>
	         <tr><td>&nbsp;</td></tr>
	               <tr><td>Total Value*</td><td id='total_v'><input type="text" onkeypress="return isNumberKey(event)" class="form-control" onfocus="finalCost()" id="total" name="total" readonly="readonly" value="<?php echo $total_bal?>"/>
	               
	               <tr><td>&nbsp;</td></tr>
	             
	             <tr><td>Note*</td><td><input type="text" class="form-control" id="note" name="note"/></td></tr> 
	            <tr><td>&nbsp;</td></tr>

	             </table>
                  <!-- /.box-body -->

                       
          
             
                
                  <input type='hidden' name='count' id='count' value="<?php echo $i?>">
                  <table>
                   <tr><td></td><td id='cash_amount_v'><input type="hidden" onkeypress="return isNumberKey(event)" onblur="cashe()" class="form-control" onfocus="finalCost()" id="cash_amount" name="cash_amount"/></td></tr>
	             <tr><td>&nbsp;</td></tr>
	             <tr><td></td><td id='check_amount_v'><input type="hidden" onkeypress="return isNumberKey(event)" class="form-control"  onblur="unHide();Paid()" id="check_amount" name="check_amount"/></td></tr>
	             <tr><td>&nbsp;</td></tr>
	             
                    <tr><td></td><td id='paid_amt_v'><input type="hidden" onkeypress="return isNumberKey(event)" readonly="readonly" class="form-control" onfocus="Paid()" id="paid_amt" name="paid_amt"/></td></tr>
	                <tr><td>&nbsp;</td></tr>
	                 <tr><td></td><td id='discount_v'><input type="hidden" onkeypress="return isNumberKey(event)" class="form-control" onblur="Balance()" id="discount" name="discount"/></td></tr>
	             <tr><td>&nbsp;</td></tr>
	             <tr><td></td><td id='balance_v'><input type="hidden" class="form-control" readonly="readonly" id="balance" name="balance"/></td></tr>
	             <tr><td>&nbsp;</td></tr>	             
	            
	            
	              
	              
	               <tr id='span1' style="visibility: hidden;"><td>Bank*</td><td id='bank_v'><select class="form-control" id="bank" name="bank">
	               <option value=""></option>
	                <?php 
                                   
                                  $data = mysql_query("SELECT bank_id,bank_name FROM banks  where branch='$session_branch' order by bank_name asc");
                                  if($data)
                                  while($info = mysql_fetch_array( $data ))
                                  {
                                  ?>  
	               <option  value="<?php echo $info["bank_id"]?>"><?php echo $info["bank_name"]?></option>
	               <?php }?>
	               </select>
	               <tr><td>&nbsp;</td></tr>
	              
	             <tr id='span2' style="visibility: hidden;"><td>Check No*</td><td><input type="text" class="form-control" id="check_no" name="check_no"/></td></tr> 
	            <tr><td>&nbsp;</td></tr>

	             </table>
                  <!-- /.box-body -->

                    <div class="form-group">                  
					<input type="submit" class="btn btn-block btn-success" value="Update Picker List" onclick="Balance()">
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
     <script type="text/javascript">
$(function () {
  //Initialize Select2 Elements
  $(".select2").select2();

  
});
</script>
 <script src="<?php echo $UI_ELEMENTS?>plugins/select2/select2.full.min.js" type="text/javascript"></script>
   
    <!-- AdminLTE for demo purposes -->
    <?php include_once "$D_PATH/include/scripts_bottom.php";?>
  </body>
</html>
