<?php
include '../connection/db.php';
include '../connection/jwt_helper.php';

$params = json_decode(@file_get_contents('php://input'), TRUE);
$output=null;
$header = apache_request_headers(); 
if(isset($header['Accesstoken'])) {
	 try {
	 		$access_token=$header['Accesstoken'];
	 		$categoryId=$params['categoryId'];
	 		$memberId=JWT::decode($access_token,$key);
	 		$res=mysql_query("select * from mst_member where sk_member_id='$memberId' ");
	 		$count=mysql_num_rows($res);
	 		if($count>0) {
	 		    if(count($params)>0) {
    	 			date_default_timezone_set("Asia/Kolkata");
    	 			$date=date('Y-m-d');
    	 			$time=date("h:i:sa");
    	 			
    	 			$bill_no_customer=0;
    	 			$bill_date=$date;
    	 			//$bill_type=$_POST["bill_type"];
    	 			$payment_status='Done';
    	 			//$partner=$_POST["partner"];
    	 			$mobile=$params["customerNumber"];
    	 			$place="Ballari";
    	 			//$c_id=$_POST["customer_id"];
    	 			$customer_name=$params["customerName"];
    	 			$data_details=$params["items"];
    	 			$grand_total=$params["grandTotal"];
    	 			$other_expenses=0;
    	 			$total=$grand_total;
    	 			//$slip_no=$_POST['slip_no'];
    	 			$paid_amt=$grand_total;
    	 			//$note_tran=$_POST['note'];
    	 			$tax=0;
    	 			$transport=0;
    	 			
    	 			$cash_amount=$grand_total;
    	 			$check_amount=0;
    	 			$discount=0;
    	 			$balance=0;
    	 			//$advance=$_POST["advance_amount"];
    	 			//$bank_id=$_POST["bank"];
    	 			//$check_no=$_POST["check_no"];
    	 			
    	 			$login=$session_id;
    	 			
    		 		$command = "SELECT MAX(bill_no) as maxid FROM customerpickermain";
    				$bill_no=0;
    				$result = mysql_query($command, $con);
    				while ($row = mysql_fetch_assoc($result))
    				{
    					$bill_no = $row['maxid'];
    				}$bill_no++;
    			
    				$query="INSERT INTO customerpickermain(bill_no,customer_id,bill_date,total,comm,lug_exp,prev_bal,total_bal,amount_paid,final_bal,login_id,branch,customer_name,partner_id,check_payment,cashe_payment,discount,phone,city,tax,transport,customer_bill_no,payment_status)
    				VALUES ('$bill_no','0','$bill_date','".$grand_total."','0','".$other_expenses."','0','$total','$paid_amt','$balance','$memberId','1','$customer_name','0','$check_amount','$cash_amount','$discount','$mobile','$place','$tax','$transport','$bill_no_customer','$payment_status')";
    				mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
    			    foreach ($data_details as $object) {
    					
    				
    				//$data1=explode("//", $data_details);
    				//for($i=1;$i<sizeof($data1);$i++) {
    					//$data2=explode("#", $data1[$i]); {
    						$flower=$object['itemName'];
    						$exp=explode("(", $flower);
    						$itemName=$exp[0];
    						$desc=str_replace(array("(",")"), array('',''), $exp[1]);
    						$qty=$object['quantity'];
    						$aqty=$qty;
    						$cost=$object['mrp'];
    						$tcost=$qty*$cost;
    						$barcode="";
    						$discount=0;
    						$note="";
    						$item_id=$object['itemId'];
    						$item_tran_id=0;
    						if($barcode!="")
    						{
    							$temp=explode("-", $barcode);
    							$item_id=$temp[0];
    							$item_tran_id=$temp[1];
    						}
    						
    						$command = "SELECT MAX(tran_id) as tran_id FROM customerpicker";
    						$tran_id=0;
    						$result = mysql_query($command, $con);
    						while ($row = mysql_fetch_assoc($result))
    						{
    							$tran_id = $row['tran_id'];
    						}$tran_id++;
    						
    					$query="INSERT INTO customerpicker(tran_id,bill_no,item_date,item_name,item_qty,item_qty_p,item_rate,amt,description,barcode,item_id,item_tran_id,discount,note)
    						VALUES ('$tran_id','$bill_no','$bill_date','$item_id','$aqty','$qty','$cost','$tcost','$desc','$barcode','$item_id','$item_tran_id','$discount','$note')";
    						mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error()); 
    					//}
    				//}
    				}
    			    header('HTTP/1.1 200 Ok', true, 200);
    			    $result=array(
    			    		'status'=>true,
    			    		//'count'=>sizeof($output),
    			    		'message'=>'success',
    			    		'data'=>$output
    			    );
	 		    }
	 		    else {
    	 		    header('HTTP/1.1 404 Not Ok', false, 404);
    		 		$result=array('status'=>false,
    		 				'message'=>'404',
    		 				'data'=>$output
    		 		);
	 		    }
	 		}
		 	else {
		 		header('HTTP/1.1 404 Not Ok', false, 404);
		 		$result=array('status'=>false,
		 				'message'=>'404',
		 				'data'=>$output
		 		);
		 	}
	 }
	 catch(Exception $e) {
	 	header('HTTP/1.1 404 Not Ok', false, 404);
	 	$result=array('status'=>false,
	 			'message'=>'404',
	 			'data'=>$output
	 	);
	 }
}
else {
	header('HTTP/1.1 404 Not Ok', false, 404);
	$result=array('status'=>false,
			'message'=>'404',
			'data'=>$output
	);
}
echo json_encode($result);	
?>