<?php include_once "$D_PATH/include/session.php";?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <?php include_once "$D_PATH/include/title.php";?>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
 
 <?php include_once "$D_PATH/include/scripts_top.php";?>
  
  </head>
   <body class="<?php echo $body_style?>">
    <div class="wrapper">
      
      	<?php include_once "$D_PATH/include/header.php";?>
  	
  <!-- Left side column. contains the logo and sidebar -->
  
    <?php include_once "$D_PATH/include/side.php";?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    
    <?php include_once "$D_PATH/include/navigation.php";?>

         <!-- Main content -->
        <section class="content">
        
        <div class="row">
           <form role="form" name="myform" action="index.php?action=operations/measurement_save&c=inventory" method="POST">
          <input type='hidden' value='0' name='advance_amount'>
          <input type='hidden' id='data' name='data'>
          <input type="hidden" name="employee" value="<?php echo $session_id?>">
           <input type='hidden' name="session_branch" id="session_branch" value="<?php echo $session_branch?>">
            <!-- left column -->

                           <div class="col-md-12">
             

              <div class="box">
                
                <div class="box-body" >
          
          <table><tr><td>Customer Mobile</td><td><input type="text" class='form-control' name="mobile" id="mobile" required="required"></td><td>
          <input type="text" name="divby" class='form-control' style='width:50px' id="divby" required="required" value='144' onblur="calSft()"></td>
          
          <td><select name="mtype" id="mtype"><option value="Sales">Sales</option><option value="Return">Return</option></select></td>
          <td><input type='button' onclick="calSft(1)" value='Cal'></td></tr>
          </table>
          </div>
          </div>

          </div></form>
                
                 <div class="col-md-6">
             

              <div class="box">
                
                <div class="box-body"  style="overflow: scroll;height: 300px">
          
                <br/>
       
                <table>
	<thead>
	<tr><th>SlNo</th><th>Item</th><th>Length</th><th>Width</th><th>Total&nbsp;Sft</th></tr>
	</thead>
	<tbody>
	<?php $items=""; 
	$data = mysql_query("SELECT sk_particular_id,particular_name FROM mst_particular where particular_status='active' and branch_id='".$session_branch."' order by particular_name asc");
	while($info = mysql_fetch_array( $data )){
$items=$items."//".$info["sk_particular_id"]."#".$info["particular_name"];

}
	for($i=1;$i<=250;$i++)
	{
	?>
	<tr>
		<td><?php echo $i?></td>
		<td><select name="item<?php echo $i?>" class='select2 form-control' id="item<?php echo $i?>" style="width: 200px"><option value=""></option><?php $data1 = mysql_query("SELECT sk_particular_id, particular_name,category_id FROM mst_particular where particular_status='active' and category_id!=0 and branch_id='".$session_branch."' order by particular_name asc");while($info1 = mysql_fetch_array( $data1 )){?><option  value="<?php echo $info1["sk_particular_id"]?>"><?php echo $info1["particular_name"]?></option><?php }?></select></td>
		<td><input type="text" class="form-control" name="length<?php echo $i?>" size=5 id="length<?php echo $i?>" onblur="calDft(<?php echo $i?>)"></td>
		<td><input type="text" class="form-control" name="width<?php echo $i?>" size=5 id="width<?php echo $i?>" onblur="calSft1(<?php echo $i?>)"></td>
		<td><input type="text" class="form-control" name="sft<?php echo $i?>" size=5 id="sft<?php echo $i?>"></td>
		<td></td>
		</tr>
	<?php }?>
	</tbody>
</table>

<input type="hidden" id="itemsData" value="<?php echo $items?>">
<input type='hidden' name='count' id='count' value="<?php echo $i?>">
                  
                  <!-- /.box-body -->
 
              </div><!-- /.box -->
        
            </div><!--/.col (left) -->
            <!-- right column -->
            
          </div>   <!-- /.row -->
          
          <div class="col-md-6" style="height: 200px;overflow: scroll;">
             

              <div class="box">
                
                <div class="box-body">
           <table>
           	<thead>
           		<tr><th>SlNo</th><th>Item Name</th><th>Total Pcs</th><th>Total Sft</th></tr>
           	</thead>
           	<tbody id='myTable'>
           		<?php 
           		for($i=1;$i<=10;$i++)
           		{
           		?>
           		<tr><td><?php echo $i?></td>
           			<td><input type='text' class='form-control' name="item_<?php echo $i?>" id="item_<?php echo $i?>"></td>
           			<td><input type='text' class="form-control" size=5 name="pcs_<?php echo $i?>" id="pcs_<?php echo $i?>"></td>
           			<td><input type='text' class="form-control" size=5 name="sft_<?php echo $i?>" id="sft_<?php echo $i?>"></td>
           		</tr>
           		<?php }?>
           	</tbody>
           	<tfoot>
           		<tr><td></td>
           		<td></td><td>Total Sft</td>
           		<td id='t_sft'></td>
           		</tr>
           	</tfoot>
           </table>
                <br/>
                  
                  <!-- /.box-body -->
 
              </div><!-- /.box -->
        
            </div><!--/.col (left) -->
            <!-- right column -->
            
          </div>   <!-- /.row -->
          
          <div class="col-md-6" style="height: 200px;overflow: scroll;">
             

              <div class="box">
                
                <div class="box-body">
                 <input type="button" value="Save" class='btn btn-success' onclick="validate()">
                </div>
                </div>
          
          
          </div>
          
          
          </div>
        
          
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
 <?php include_once "$D_PATH/include/footer.php";?>

  <!-- Control Sidebar -->
 <?php include_once "$D_PATH/include/side_container.php";?> 
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<script type="text/javascript">
 function calSft1(row){

	 var width=$("#width"+row).val();
	 var length=$("#length"+row).val();
	 var divby=$("#divby").val();

	 var sft=((length*width)/divby).toFixed(3);
		$("#sft"+row).val(sft)

		var next=row+1;		
			

			if($("#item"+next).val()==""){
				$('#item'+next)[0].options.length = 0;
				var prev=row;
				var prev_item=$("#item"+prev).val();
				var itemname=$("#item"+prev+" option:selected").text();
				
				document.getElementById("item"+next).options[0]=new Option(itemname,prev_item);
				var items=$("#itemsData").val();
				
				var temp=items.split("//");
				for(var j=1;j<temp.length;j++)
				{
						var temp1=temp[j].split("#");
						var combo=document.getElementById("item"+next);
			        	var option = document.createElement("option");
				        option.text = temp1[1];
				        option.value = temp1[0];
				        combo.add(option,null);
						
				}
			}
			

 }
 function calSft(row)
	{
		
	/*	var prev_item=$("#item"+row).val();
		var itemname=$("#item"+row+" option:selected").text();

		
		var next=row+1;		
		//$('#item'+next)[0].options.length = 0;

		//document.getElementById("item"+next).options.length = 0;
		 
		//document.getElementById("item"+next).options[0]=new Option(itemname,prev_item);
		var items=$("#itemsData").val();
		
		var temp=items.split("//");
		for(var j=1;j<temp.length;j++)
		{
				var temp1=temp[j].split("#");
				var combo=document.getElementById("item"+next);
	        	var option = document.createElement("option");
		        option.text = temp1[1];
		        option.value = temp1[0];
		        combo.add(option,null);
				
		}*/
		
		var count=$("#count").val();
		var divby=$("#divby").val();
		for(var i=1;i<count;i++)
		{
			var length=$("#length"+i).val();
			var width=$("#width"+i).val();
			if($("#width"+i).val()!="" && $("#length"+i).val())
			{	
				if(length==""){length=0;}
				if(width==""){width=0;}
				var sft=((length*width)/divby).toFixed(3);
				$("#sft"+i).val(sft)
			}
		}
		for(var k=1;k<=10;k++)
		{
			$("#item_"+k).val("")
			$("#pcs_"+k).val("")
			$("#sft_"+k).val("")
		}	
		var data="";
		for(var i=1;i<count;i++)
		{
			var pcs=0;var sft=0;
			var item=$("#item"+i+" option:selected").text();
			var length=$("#length"+i).val()
			if(item!='' && length!='')
			{	
				for(var j=1;j<=count;j++)
				{
					var pclength=$("#length"+j).val()
					if($("#item"+j+" option:selected").text()==item && pclength!='')
					{
						pcs=pcs+1;
						if($("#sft"+j).val()!='')
						sft=sft+parseFloat($("#sft"+j).val());
					}
				}
				data=data+"//"+item+"#"+pcs+"#"+sft;	
			}
			
		}
		var l=1;
		var t_sft=0;
		var temp=data.split("//");
		for(var k=1;k<=temp.length;k++)
		{
			var temp1=temp[k].split("#");
			var status="";
			for(var z=1;z<=10;z++)
			{
				if(temp1[0]==$("#item_"+z).val())
				{
					status="exist";
				}
			}
			if(status=="")
			{
				t_sft=parseFloat(t_sft)+parseFloat(temp1[2]);
				$("#item_"+l).val(temp1[0])
				$("#pcs_"+l).val(temp1[1])
				$("#sft_"+l).val(parseFloat(temp1[2]).toFixed(3))
				l++;
			}
			document.getElementById("t_sft").innerHTML=t_sft.toFixed(3);
		}
			
	}
           </script>
 <script type="text/javascript">
		function validate()
		{			           
			var data="";
			var count=$("#count").val();
			var divby=$("#divby").val();
			for(var i=1;i<count;i++)
			{
				var item=$("#item"+i).val()
				var length=$("#length"+i).val();
				var width=$("#width"+i).val();
				var sft=$("#sft"+i).val();
				if($("#width"+i).val()!="" && $("#length"+i).val()!="")
				{	
					data=data+"//"+item+"#"+length+"#"+width+"#"+sft
				}
			}
		
			$("#data").val(data);
		
		document.myform.submit();
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
    
      

<?php include_once "$D_PATH/include/scripts_bottom.php";?> 
</body>
</html>
      
