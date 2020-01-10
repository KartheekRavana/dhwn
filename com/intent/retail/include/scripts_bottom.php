
<script>
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
	xmlhttp.open("GET",D_PATH+"/"+DIR+"/load/memberdetails.php?customer_id="+customer_id,true);
	xmlhttp.send();

}
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
<script>
/*function loadItems(row,val)
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
		



	}*/
</script>

<div id="contact-wrapper_search">
<div class="floating-contact-inner" id="floating-contact-wrap">
<div id="contact-btn"></div>
<div id="result"></div>


<table>
             <tr>
                
                <td><select class="form-control" id="category_searc" onchange="loadItems_search(1,this.value)"><option value="">Category</option><?php $data = mysql_query("SELECT category_id,category_name FROM category where category_status='active'");if($data)while($info = mysql_fetch_array( $data )){?><option  value="<?php echo $info["category_id"]?>"><?php echo $info["category_name"]?></option><?php }?></select></td>
                <td>&nbsp;&nbsp;</td>
                <td><select class="form-control" id="subcategory_search" onchange="loadItems2_search(1,this.value)"><option value="">Sub Category</option></select></td>
               <td>&nbsp;&nbsp;&nbsp;</td>
               <td><select class="form-control" id="item_search" onchange="loadItems1_search(1,this.value)"><option value="">Item Name</option></select></td>
               <td>&nbsp;&nbsp;&nbsp;</td>
               </tr>
               <tr><td colspan="3"><input type="text" id="filter_search" style="width: 100%" placeholder="Search Pattern" onkeyup="getData_search()" >
               </td><td></td><td><input type="text" id="qbarcode" style="" autocomplete="off" placeholder="Barcode" onchange="qbarcode(this.value)" ></td></tr>
               </table>

                <div id="items_load_search" style="height: 70%;overflow:auto;width: 60%;float: left"></div>
                <div id="items_load_search1" style="height: 70%;overflow:auto;width: 35%;float: left"></div>
</div>
</div>

<script>
	function qbarcode(barcode)
	{
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
				document.getElementById("qbarcode").value="";
			   document.getElementById("items_load_search").innerHTML=xmlhttp.responseText;
		     }
		   }

		 var D_PATH=document.getElementById("D_PATH").value
			var DIR=document.getElementById("DIR").value
			
		 xmlhttp.open("GET",D_PATH+"/stock/load/loaditemsbybarcode.php?barcode="+barcode,true);
		 xmlhttp.send();
	
	}
	</script>

<script type="text/javascript">
function loadItems_search(row,val)
{
  
	var category=document.getElementById("category_searc").value;
	document.getElementById("subcategory_search").options.length = 0;
	 

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
			
			document.getElementById("subcategory_search").options[j]=new Option(temp2[1],temp2[0]);
			
		    }
	     }
	   }

	 var D_PATH=document.getElementById("D_PATH").value
		var DIR=document.getElementById("DIR").value
		
	 xmlhttp.open("GET",D_PATH+"/stock/load/getsub_categorys.php?category="+category,true);
	 xmlhttp.send();
		



	}

function loadItems1_search(row,val)
{
 
	 var cid=document.getElementById("category_searc").value;
	 var sid=document.getElementById("subcategory_search").value;
		var item_search=document.getElementById("item_search").value
		var filter="";
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
			
		   document.getElementById("items_load_search").innerHTML=xmlhttp.responseText;
	     }
	   }

	 var D_PATH=document.getElementById("D_PATH").value
		var DIR=document.getElementById("DIR").value
		
	 xmlhttp.open("GET",D_PATH+"/stock/load/loaditems.php?&category="+cid+"&subcategoryid="+sid+"&filter="+filter+"&item_search="+item_search,true);
	 xmlhttp.send();



	}
function loadItems2_search(row,val)
{
 
	 var cid=document.getElementById("category_searc").value;
	 var sid=document.getElementById("subcategory_search").value;
		
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
				
				document.getElementById("item_search").options[j]=new Option(temp2[1],temp2[0]);
				
			    }
	     }
	   }

	 var D_PATH=document.getElementById("D_PATH").value
		var DIR=document.getElementById("DIR").value
		
	 xmlhttp.open("GET",D_PATH+"/stock/load/loaditem_name.php?category="+cid+"&subcategoryid="+sid,true);
	 xmlhttp.send();



	}

function getData_search()
{
	var category=document.getElementById("category_searc").value
	var subcategory=document.getElementById("subcategory_search").value
	var item_search=document.getElementById("item_search").value
	var filter=document.getElementById("filter_search").value
	
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
			
		   document.getElementById("items_load_search").innerHTML=xmlhttp.responseText;
	     }
	   }
	 var D_PATH=document.getElementById("D_PATH").value
		var DIR=document.getElementById("DIR").value					
	 xmlhttp.open("GET",D_PATH+"/stock/load/loaditems.php?&category="+category+"&subcategoryid="+subcategory+"&item_search="+item_search+"&filter="+filter,true);
	 xmlhttp.send();
				
}
function getitem_name_search(item_id)
{
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
			
		   document.getElementById("items_load_search1").innerHTML=xmlhttp.responseText;
	     }
	   }
	 var D_PATH=document.getElementById("D_PATH").value
		var DIR=document.getElementById("DIR").value					
	 xmlhttp.open("GET",D_PATH+"/stock/load/loaditemdetails.php?tran_id="+item_id,true);
	 xmlhttp.send();
}
</script>

<!-- jQuery 2.2.3 -->
<script src="<?php echo $UI_ELEMENTS?>plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo $UI_ELEMENTS?>bootstrap/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="<?php echo $UI_ELEMENTS?>plugins/morris/morris.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo $UI_ELEMENTS?>plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="<?php echo $UI_ELEMENTS?>plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo $UI_ELEMENTS?>plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo $UI_ELEMENTS?>plugins/knob/jquery.knob.js"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="<?php echo $UI_ELEMENTS?>plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="<?php echo $UI_ELEMENTS?>plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo $UI_ELEMENTS?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="<?php echo $UI_ELEMENTS?>plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo $UI_ELEMENTS?>plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo $UI_ELEMENTS?>dist/js/app.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- AdminLTE for demo purposes -->
<script src="<?php echo $UI_ELEMENTS?>dist/js/demo.js"></script>

<script src="<?php echo $UI_ELEMENTS?>plugins/select2/select2.full.min.js" type="text/javascript"></script>
 

 <!-- DATA TABES SCRIPT -->
    <script src="<?php echo $UI_ELEMENTS?>plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="<?php echo $UI_ELEMENTS?>plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
   
    <script type="text/javascript">
    $(function () {

    	  //Initialize Select2 Elements
    	  $(".select2").select2();
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
    
$(function () {
});
</script>
<script type="text/javascript">
     
    </script>