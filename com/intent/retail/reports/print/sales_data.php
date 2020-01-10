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
        //count=parseInt(document.getElementById("count").value);
      
        var k=1;
        var z=1;
        var leave=0//parseInt(document.getElementById("leave_qty").value)
        count=count+leave;
       
        for(i=1;i<count;i++)
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
             
              
          // for(var j=1;j<=4;j++)
             {
             
               var value=tempval[i]
              
                   $("#barcodeTarget").html("").show().barcode(value, btype, settings);
                   temp=$("#barcodeTarget").html();
                  
               data=data+temp;
              // if(z>leave)
               {
               $("#barcode_"+i).html(temp)
              
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
    $bill_type=$_GET["bill_type"];
    $btype="";
    $heading="";
    if($bill_type=="Sales")
    {
    	$btype="bill_type='cash' ";
    	$heading="Cash Sales Data";
    }
    else {
    	$btype="bill_type='cash ret' or bill_type='cash return' ";
    	$heading="Cash Return Data";
    } 
    ?>
                <table id="example1" class="table table-bordered table-striped" style="font-size: 12px">
                    <thead>
                   <caption><b><?php echo $heading?></b></caption> 
                      <tr>
                        <th>Bill Date</th><th>Item</th><th>Discription</th>
                        <th>Qty in PCS</th><th>Qty in SFT</th> <th>Rate</th> <th>Discount</th> <th>Vat</th>
                        <th>Billing Amount</th> <th>Barcode</th> 
                       
                      </tr>
                    </thead>
                    <tbody id='div_print' style="font-size: 12px;">
                    <?php 
                    $i=1;$items_list="";$total=0;
                      $data1 = mysql_query("SELECT distinct(description) as description,particular_id FROM txn_bill_support where bill_for='Customer' and $btype and bill_date='".$_GET["from_date"]."'");
                    while($info1 = mysql_fetch_array( $data1 ))
                    {    
                    $qty_pcs=0;$amount=0;
                    $qty_sft=0;$rate=0;$discount=0;$vat=0;
                      $data = mysql_query("SELECT sk_tran_id, bill_id, bill_for, bill_type, bill_date, particular_id, description, qty_in_piece, qty_in_sft, rate, discount, vat, amount, landing_cost, bill_status, note, employee_id, branch_id FROM txn_bill_support where bill_for='Customer' and $btype and particular_id='".$info1['particular_id']."' and description='".$info1["description"]."' and bill_date='".$_GET["from_date"]."'");
                    while($info = mysql_fetch_array( $data ))
                    {      
              $member_name="";
              $mobile="";
              $particular_id=$info["particular_id"];
      $qty_pcs=$qty_pcs+$info["qty_in_piece"];
      $qty_sft=$qty_sft+$info["qty_in_sft"];
      //$rate=$info["rate"];
      $discount=$info["discount"];
      $vat=$info["vat"];
      $amount=$amount+$info["amount"];
      $rate=$amount/$qty_sft;
                        $data3 = mysql_query("SELECT item_name FROM items where item_id='$particular_id'");
                        while($info2 = mysql_fetch_array( $data3 ))
                        {
                          $particular_name=$info2["item_name"];
                        }
                    }
                    $sk_tran_id=0;
                      $data = mysql_query("SELECT sk_tran_id FROM txn_bill_support where description='".$info1["description"]."' order by sk_tran_id asc limit 1");
                    while($info = mysql_fetch_array( $data ))
                    {  
                      $sk_tran_id=$info["sk_tran_id"];
                    }
                   
                    ?><tr>
                    <td><?php $temp=explode("-", $info["from_date"]);echo $temp[2]."-".$temp[1]."-".$temp[0]?></td>
                    <td><?php echo $particular_name?></td>
                    <td><?php echo $info1["description"]?></td>
                    <td><?php echo $qty_pcs?></td>
                      <td><?php echo $qty_sft?></td>
                    <td><?php echo number_format($rate,2)?></td>
                      <td><?php echo $discount?></td>
                        <td><?php echo $vat?></td><td><?php echo $amount?></td>
                        
                    <td style="width: 250px">
                    <div style="float: left;width: 100%;height:<?php echo $height?>px;">
                    <span style="float: right" id="barcode_<?php echo $i?>"></span>
                    </div><?php $items_list=$items_list."#".$particular_id."-".$sk_tran_id?></td>
                    </tr>
                    
                    <?php $i++;
                    	$total=$total+$amount;
                    }?>
                                </tbody>
                                   <tfoot>
                                <tr>
                                	<td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                	<td>Total</td><td><?php echo $total?></td>
                                </tr>
                                </tfoot> 
                  </table>
                  <input type="hidden" id="values" value="<?php echo $items_list?>">
                  <div id="barcodeTarget" style="float: left;" class="barcodeTarget"></div>
                      <script>
window.print();
setInterval(
     function(){ window.location="?action=sales_data&c=reports"; },
      1000
    );
</script>