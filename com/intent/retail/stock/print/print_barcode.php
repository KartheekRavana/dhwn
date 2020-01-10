<?php include_once "$D_PATH/include/session.php";?>
<style>
* {
color: #7F7F7F;
font-family: Arial, sans-serif;
font-size: 12px;
font-weight: normal;
}
#config {
overflow: auto;
margin-bottom: 10px;
}
.config {
float: left;
width: 200px;
height: 250px;
border: 1px solid #000;
margin-left: 10px;
}
.config .title {
font-weight: bold;
text-align: center;
}
.config .barcode2D,  #miscCanvas {
display: none;
}
#submit {
clear: both;
}
#barcodeTarget,  #canvasTarget {
margin-top: 20px;
}
</style>
<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript" src="jquery-barcode.js"></script>

<script type="text/javascript">
    
      function generateBarcode(){
        var data="";
        var values=document.getElementById("values").value
       
        var tempval=values.split("#");
        
        var count=tempval.length;
        count=parseInt(document.getElementById("count").value);
      
        var k=1;
        var z=1;
        var leave=parseInt(document.getElementById("leave_qty").value)
        count=count+leave;
      
        for(i=1;i<=count;i++)
          {       
                
       
        var btype = $("input[name=btype]:checked").val();
        var renderer = $("input[name=renderer]:checked").val();
        
    var quietZone = false;
        if ($("#quietzone").is(':checked') || $("#quietzone").attr('checked')){
          quietZone = true;
        }
    
        var settings = {
          output:renderer,
          bgColor: "FFF",
          color: "#000000",
          barWidth: "1",
          barHeight: "15",
          moduleSize: "5",
          posX: "10",
          posY: "20",
          addQuietZone: "1"
        };
        if ($("#rectangular").is(':checked') || $("#rectangular").attr('checked')){
          value = {code:value, rect: true};
        }
        if (renderer == 'canvas'){
          clearCanvas();
          $("#barcodeTarget").hide();
          $("#canvasTarget").show().barcode(value, btype, settings);
         
        } else {
            $("#canvasTarget").hide();
          
              var temp="";
             
         
           for(var j=1;j<=4;j++)
             {
             
               var value=tempval[k++]
               
                   $("#barcodeTarget").html("").show().barcode(value, btype, settings);
                   temp=$("#barcodeTarget").html();
                   
               data=data+temp;
               if(z>leave)
               {
               $("#barcode_"+i+"_"+j).html(temp)
              
               }
               z++;
               }
         
          
        }
          }
        $("#barcodeTarget").html("")
       // $("#bar").html(data)
      }
          
      function showConfig1D(){
        $('.config .barcode1D').show();
        $('.config .barcode2D').hide();
      }
      
      function showConfig2D(){
        $('.config .barcode1D').hide();
        $('.config .barcode2D').show();
      }
      
      function clearCanvas(){
        var canvas = $('#canvasTarget').get(0);
        var ctx = canvas.getContext('2d');
        ctx.lineWidth = 1;
        ctx.lineCap = 'butt';
        ctx.fillStyle = '#FFFFFF';
        ctx.strokeStyle  = '#000000';
        ctx.clearRect (0, 0, canvas.width, canvas.height);
        ctx.strokeRect (0, 0, canvas.width, canvas.height);
      }
      
      $(function(){
        $('input[name=btype]').click(function(){
          if ($(this).attr('id') == 'datamatrix') showConfig2D(); else showConfig1D();
        });
        $('input[name=renderer]').click(function(){
          if ($(this).attr('id') == 'canvas') $('#miscCanvas').show(); else $('#miscCanvas').hide();
        });
        generateBarcode();
      });
  
    </script>
    <?php 
    $total_bar=$_GET["print_qty"];
    $items_list="";
    for($i=1;$i<=$total_bar;$i++)
    {
    $items_list=$items_list."#".$_GET["item_id"]."-".$_GET["tran_id"];
    }
    ?>
    <input type="hidden" id="values" value="<?php echo $items_list?>">
    <input type="hidden" id="count" value="<?php echo $total_bar?>">
    <?php
    $t=$total_bar/4; 
    if($t<1){$t=1;}
    for($k=1;$k<=$t;$k++)
    {
    ?>
<div style="width: 1150px;height:1520px;margin-top: 120px;">
<div style="width: 100%;">

  
  <?php 
  $leave=$_GET["leave_qty"];
  $height=69;
  $total_items=20+$k;
  for($i=$k;$i<=$total_items;$i++)
  { 
  for($j=1;$j<=4;$j++)
  {
    ?>
  <div style="float: left;width: 23%;height:<?php echo $height?>px;"><span style="float: right" id="barcode_<?php echo $i ?>_<?php echo $j?>"></span></div>
  <?php }$k=$total_items;}?>
</div>
<div id="generator">
<div id="config">
</div>
</div>
</div>
<?php }?>
<div id="barcodeTarget" style="float: left;" class="barcodeTarget"></div>
<input type="hidden" id="leave_qty" value="<?php echo $leave?>">

 <input type="hidden" id="action" value="<?php echo $_GET["r_action"]?>">
 <input type="hidden" id="c" value="<?php echo $_GET["r_c"]?>">
 <input type="hidden" id="category1" value="<?php echo $_GET["category_main"]?>">
  <input type="hidden" id="sub" value="<?php echo $_GET["subcategory_main"]?>">
   <input type="hidden" id="item" value="<?php echo $_GET["item_id"]?>">
   <input type="hidden" id="stock" value="<?php echo $_GET["stock"]?>">
   <input type="hidden" id="description_11" value="<?php echo $_GET["description_11"]?>">
   
   <?php 
   if($_GET["tran_type"]=='save')
   {
   $command = "SELECT MAX(tran_id) as tran_id FROM customerbill";
   $tran_id=0;
   $result = mysql_query($command, $con);
   while ($row = mysql_fetch_assoc($result))
   {
    $tran_id = $row['tran_id'];
   }$tran_id++;
   
   $cost=$_GET["cost"];
   $stock=$_GET["stock"];
   $item=$_GET["item_id"];
   $tran=$_GET["tran_id"];
   $rack=$_GET["rack"];
   $selling_tran_id=$_GET["selling_tran_id"];
   $barcode=$item."-".$tran;
   
   $data1 = mysql_query("SELECT description from supplierbill where tran_id='$tran'");
   while($info = mysql_fetch_array( $data1 ))
   {
    $description=$info['description'];
   }
   $amt=$stock*$cost;
   
   $query="update supplierbill set rack_id='$rack' where tran_id='$tran'";
   mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
   
   if($selling_tran_id=="")
   {
   $query="INSERT INTO txn_bill_support(tran_id,bill_no,item_date,item_name,item_qty,item_qty_p,item_rate,amt,description,barcode,item_id,item_tran_id)
   VALUES ('$tran_id','1','2015-06-04','$item','$stock','$stock','$cost','$amt','$description','$barcode','$item','$tran_id')";
   mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
    
   
   }
   else
   {
    $query="update txn_bill_support set qty_in_sft='$stock',qty_in_piece='$stock',rate='$cost',amount='$amt' where sk_tran_id='$selling_tran_id'";
    mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
   }
   
   $data = mysql_query("SELECT mrp from stock where flower_name='$item' and description='$description'");
   $mrp='';
   while($info = mysql_fetch_array( $data ))
   {
    $mrp=$info['mrp'];
     
   }
 if($mrp!='')
    {
   $query ="update stock set mrp=$mrp where flower_name='$item' and description='$description'";
   mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
   }
   else
   {
    $command = "SELECT MAX(stock_id) as stock_id FROM stock";
    $stock_id=0;
    $result = mysql_query($command, $con);
    while ($row = mysql_fetch_assoc($result))
    {
      $stock_id = $row['stock_id'];
    }$stock_id++;
     
    $mrp=$_GET["mrp"];
   $query ="insert into stock(stock_id, stock_date, flower_name, description, qty, remaining_qty, mrp, branch, landing_cost, p_qty, subcategory_id)
   values ('$stock_id','2015-06-04','$item','$description','$stock','$stock','$cost','1','0','0','0')";
   mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());

    $query ="update stock set mrp=$mrp where flower_name='$item' and description='$description'";
   mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
   
   }
   }
   ?>
<script>
self.print();
var cat=document.getElementById("category1").value;
var sub=document.getElementById("sub").value;
var item=document.getElementById("item").value;
var action=document.getElementById("action").value;
var c=document.getElementById("c").value;
var description_11=document.getElementById("description_11").value;
//if(c=="stock")
{
  window.location="index.php?action=barcode&c=stock&category1="+cat+"&subcategory1="+sub+"&item_id_11="+item+"&description_11="+description_11;

}
//else
{
  
}
</script>