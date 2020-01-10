<?php include_once "$D_PATH/include/session.php";?><?php


$bill_no_s=$_POST["bill_no"];

$bill_date=$_POST["bill_date"];
$s_id=$_POST["supplier_name"];
$mobile=$_POST["mobile"];
$place=$_POST["place"];

$grand_total=0;$other_expenses=0;$transporter="";$transport_expenses=0;$hamali="";$hamali_expenses=0;$note="";$total=0;
if(isset($_POST["grand_total"])) {
	$grand_total=$_POST["grand_total"];
}
if(isset($_POST["other_expenses"])) {
	$other_expenses=$_POST["other_expenses"];
}
if(isset($_POST["transporter"])) {
	$transporter=$_POST["transporter"];
}
if(isset($_POST["transport_expenses"])) {
	$transport_expenses=$_POST["transport_expenses"];
}
if(isset($_POST["hamali"])) {
	$hamali=$_POST["hamali"];
}
if(isset($_POST["hamali_expenses"])) {
	$hamali_expenses=$_POST["hamali_expenses"];
}
if(isset($_POST["total"])) {
	$total=$_POST["total"];
}
$login=$session_id;
$branch=$session_branch;

if(isset($_POST["note"])) {
	$note=$_POST['note'];
}

$data_details=$_POST["data"];
$curtime=curtime();


$query ="update supplierorderformmain set bill_status='Completed' where bill_no='$bill_no_s'";
mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());



$command = "SELECT MAX(sk_bill_id) as maxid FROM mst_bill_main";
$bill_no=0;
$result = mysql_query($command, $con);
while ($row = mysql_fetch_assoc($result))
{
	$bill_no = $row['maxid'];
}$bill_no++;

$c_slip=0;
$command = "SELECT count(sk_bill_id) as maxid FROM mst_bill_main where bill_for='Supplier' and bill_type='Cash'";
$result = mysql_query($command, $con);
while ($row = mysql_fetch_assoc($result))
{
	$c_slip = $row['maxid'];
}
$command = "SELECT count(sk_bill_id) as maxid FROM mst_bill_main where bill_for='Supplier' and bill_type='Credit'";
$result = mysql_query($command, $con);
while ($row = mysql_fetch_assoc($result))
{
	$c_slip = $c_slip+$row['maxid'];
}
$c_slip++;

$query="INSERT INTO mst_bill_main(sk_bill_id, bill_date, bill_time, member_id, member_name, mobile, place, bill_for, bill_type, bill_amount, tax_rate, tax_amount, t_discount_rate, t_discount_amount, bill_tax_amount, transporter_id, transport_amount, other_expenses,hamali_id,hamali, grand_total, cash_amount, check_amount, paid_amount, discount, balance_amount, note, bank_id, bill_status, measurement_slip_no,agent_id,agent_rate,agent_amount,cmeasurement,purchase_exp,invoice_amt,vat_rate,vat, employee_id, branch_id,slip_no)
VALUES ('$bill_no','$bill_date',now(),'$s_id','','$mobile','$place','Supplier','Credit','$grand_total','0','0','0','0','$grand_total','0','$transport_expenses','$other_expenses','0','$hamali_expenses','$total','0','0','0','0','0','$note','0','active','$bill_no_s','0','0','0','0','0','0','0','0','$session_id','$session_branch','0')";
mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());




/*
$command = "SELECT MAX(bill_no) as maxid FROM supplierbillmain";
$bill_no=0;
$result = mysql_query($command, $con);
while ($row = mysql_fetch_assoc($result)){
	$bill_no = $row['maxid'];

}

$bill_no++;

$query="INSERT INTO supplierbillmain(bill_no,supplier_id,bill_date,total,other_exp,lug_exp,exp,advance,gtotal,total_bal,login_id,branch,hamali,supplier_bill_no,note)
VALUES ('$bill_no','$s_id','$bill_date','".$grand_total."','".$other_expenses."','".$transport_expenses."','0','0','".$total."','0','$session_id','$session_branch','$hamali_expenses','$bill_no_s','$note')";
mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
*/
$total_bar=0;
$items_list="";
$data1=explode("//", $data_details);
for($i=1;$i<sizeof($data1);$i++)
{
	$data2=explode("#", $data1[$i]);
	//for($j=1;$j<=sizeof($data2);$j++)
	{	
		$flower=$data2[1];$qty=$data2[2];$aqty=$data2[3];$cost=$data2[4];$tcost=$data2[5];$lcost=$data2[6];$tlcost=$data2[7];$subcategoryid=$data2[8];$discount=$data2[9];$desc=$data2[10];$vat=$data2[12];
	//$total=$info['supplier_quantity']*$info['rateper_no'];
	
		/*$command = "SELECT MAX(tran_id) as tran_id FROM supplierbill";
		$tran_id=0;
		$result = mysql_query($command, $con);
		while ($row = mysql_fetch_assoc($result)){
			$tran_id= $row['tran_id'];
		
		}$tran_id++;
		
		
		
	       	$query="INSERT INTO supplierbill(tran_id,bill_no,item_date,item_name,item_qty,item_rate,amt,landing_cost,total_landing_cost,item_qty_p,discount,description,vat)
	       	VALUES ('$tran_id','$bill_no','".$bill_date."','".$flower."','".$aqty."','".$cost."','".$tcost."','$lcost','$tlcost','$qty','$discount','$desc','$vat')";
	       	mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
	       	 
	       	$data = mysql_query("SELECT flower_name from stock where flower_name='$flower' and branch='$branch'");
	       	$state='';
	       	while($info = mysql_fetch_array( $data ))
	       	{
	       		$state=$info['flower_name'];
	       		 
	       	}*/
		
		$command = "SELECT MAX(sk_tran_id) as maxid FROM txn_bill_support";
				$tran_id=0;
		$result = mysql_query($command, $con);
		while ($row = mysql_fetch_assoc($result))
		{
		$tran_id = $row['maxid'];
		}$tran_id++;


				$query="INSERT INTO txn_bill_support(sk_tran_id, bill_id, bill_for, bill_type, bill_date, particular_id,description, qty_in_piece, qty_in_sft, rate,vat,discount, amount,landing_cost, bill_status, employee_id, branch_id)
				VALUES ('$tran_id','$bill_no','Supplier','Credit','$bill_date','$flower','$desc','$qty','$aqty','$cost','$vat','$discount','$tcost','$lcost','active','$session_id','$session_branch')";
				mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
	       	
	       	$bar=$data2[11];
	       	$total_bar=$total_bar+$bar;
	       	for($z=1;$z<=$bar;$z++)
	       	{
	       	$items_list=$items_list."#".$flower."-".$tran_id;
	       	}

	       	
	}

}

$bal='';
$bal=$total-($transport_expenses+$hamali_expenses);

//$total=$total-;

/*$query="INSERT INTO supplier_transactions(SUPPLIER_ID, TRAN_DATE, TRAN_TIME, BILL_NO, slip_no, credit, debit,balance, TRAN_STATUS, employee, branch,note,tran_type,transaction_id)
VALUES ('$s_id','".$bill_date."',now(),'".$bill_no."','0','".$bal."','0','$sup_bal','active','$session_id','$session_branch','$note','PURCHASE','$bill_no')";
mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
	*/

	$command = "SELECT MAX(sk_tran_id) as maxid FROM txn_transaction";
		$tran_id=0;
		$result = mysql_query($command, $con);
		while ($row = mysql_fetch_assoc($result))
		{
		$tran_id = $row['maxid'];
}$tran_id++;

$query="INSERT INTO txn_transaction(sk_tran_id,tran_date,tran_time, credit, debit,member_id, transaction_ref_id, ref_table, tran_type, tran_desc, note,tran_status, employee_id, branch_id)
VALUES ('$tran_id','$bill_date',now(),'$bal','0','$s_id','$bill_no','mst_bill_main','Supplier','New Bill','Credit','active','$session_id','$session_branch')";
mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());


if($transport_expenses!=0)
			{
				$tran_id++;
				$query="INSERT INTO txn_transaction(sk_tran_id,tran_date,tran_time, credit, debit,member_id, transaction_ref_id, ref_table, tran_type, tran_desc, note,tran_status, employee_id, branch_id)
				VALUES ('$tran_id','$bill_date',now(),'$transport_expenses','0','$transporter','$bill_no','mst_bill_main','Transporter','New Bill','$bill_type','active','$session_id','$session_branch')";
				mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
			}
			
			
if($hamali_expenses!=0)
			{
				$tran_id++;
				$query="INSERT INTO txn_transaction(sk_tran_id,tran_date,tran_time, credit, debit,member_id, transaction_ref_id, ref_table, tran_type, tran_desc, note,tran_status, employee_id, branch_id)
				VALUES ('$tran_id','$bill_date',now(),'$hamali_expenses','0','$hamali','$bill_no','mst_bill_main','Hamali','New Bill','$bill_type','active','$session_id','$session_branch')";
				mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
			}
?>
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
    	  count=document.getElementById("count").value;
    	
    	  var k=1;
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
        		 $("#barcode_"+i+"_"+j).html(temp)
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
    <input type="hidden" id="values" value="<?php echo $items_list?>">
    <input type="hidden" id="count" value="<?php echo $total_bar?>">
    <?php 
  	if($total_bar<=4){
  	for($k=1;$k<=4;$k++)
    {
    ?>
<div style="width: 1150px;height:1520px;margin-top: 120px;">
<div style="width: 100%;">
	<?php 
	$height=69;
	$total_items=20+$k;
	for($i=$k;$i<=$total_items;$i++)
	{	
	for($j=1;$j<=4;$j++)
	{
	?>
	<div style="float: left;width: 24.2%;height:<?php echo $height?>px;"><span style="float: right" id="barcode_<?php echo $i ?>_<?php echo $j?>"></span></div>
	<?php }$k=$total_items;}?>
</div>
<div id="generator">
<div id="config">
</div>
</div>
</div>
<?php }
  	}else{
    for($k=1;$k<=$total_bar/4;$k++)
    {
    ?>
<div style="width: 1150px;height:1520px;margin-top: 120px;">
<div style="width: 100%;">
	<?php 
	$height=69;
	$total_items=20+$k;
	for($i=$k;$i<=$total_items;$i++)
	{	
	for($j=1;$j<=4;$j++)
	{
	?>
	<div style="float: left;width: 24.2%;height:<?php echo $height?>px;"><span style="float: right" id="barcode_<?php echo $i ?>_<?php echo $j?>"></span></div>
	<?php }$k=$total_items;}?>
</div>
<div id="generator">
<div id="config">
</div>
</div>
</div>
<?php }}?>
<div id="barcodeTarget" style="float: left;" class="barcodeTarget"></div>

<script>
//
 self.print(); 

 setTimeout(function() {window.location="index.php?action=in_new&c=stock&status=Stock Added Succesfully";}, 2000);
</script>