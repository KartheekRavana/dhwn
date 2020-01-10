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
		 		$data = mysql_query("SELECT item_id,item_name FROM items WHERE category='$categoryId' order by item_name");
				while($info = mysql_fetch_array($data))
				{
					$list=array();
					$data1 = mysql_query("SELECT distinct(description) as description FROM txn_bill_support WHERE particular_id='" .$info["item_id"]."' ORDER BY description");
					while($info1 = mysql_fetch_array($data1))
					{
						$itemName=$info["item_name"] ."(". $info1["description"]." )";
						$desc=$info1["description"];
					
					
				
					$item_id=$info["item_id"];
					
					
					
					$mrp=0;
					$data2 = mysql_query("SELECT mrp FROM stock WHERE flower_name='$item_id' and description='$desc'");
					while($info2 = mysql_fetch_array($data2))
					{
						$mrp=$info2["mrp"];
					}
					
					/* $discount=0;$vat=0;$item_rate=0;
					$data3 = mysql_query("SELECT discount,vat,rate FROM txn_bill_support WHERE particular_id='$item_id' and description='$desc'");
					while($info3 = mysql_fetch_array($data3))
					{
						$discount=$info3["discount"];
						$vat=$info3["vat"];
						$item_rate=$info3["rate"];
					} */
					$list=array(
							'itemId'=>$item_id,
							'itemName'=>$itemName,
							'mrp'=>$mrp
							/* 'discount'=>$discount,
							'gst'=>$vat,
							'rate'=>$item_rate */
								
					);
					//echo "#$mrp#$discount#$vat#$item_rate#";
					$output[]=$list;
					}
				}
			    header('HTTP/1.1 200 Ok', true, 200);
			    $result=array(
			    		'status'=>true,
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