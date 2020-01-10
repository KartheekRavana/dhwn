<?php
include '../connection/db.php';
include '../connection/jwt_helper.php';
$params = json_decode(@file_get_contents('php://input'), TRUE);
$output=null;
$header = apache_request_headers(); 
if(isset($header['Accesstoken'])) {
	try {
		$access_token=$header['Accesstoken'];
		$memberId=JWT::decode($access_token,$key);
		$res=mysql_query("select * from mst_member where sk_member_id='$memberId' ");
		$count=mysql_num_rows($res);
		if($count>0) {
			if($params["barCode"]!=''){
			    $barcode=explode("-", $params["barCode"]);
			    $category="";
			    //echo "<br/>SELECT category,item_name,item_id FROM items WHERE item_id='".$barcode[0]."' ";
			    $data = mysql_query("SELECT category,item_name,item_id FROM items WHERE item_id='".$barcode[0]."'") or die(mysql_error());
			    while($info = mysql_fetch_array($data)) {
			    $category=$info["category"];
			    	$item_name=$info["item_name"];
			    	$item_id=$info["item_id"];
			    }
			    
			    $data = mysql_query("SELECT category_name FROM category WHERE category_id='".$category."'");
			    while($info = mysql_fetch_array($data)) {
			    	$category_name=$info["category_name"];
			    }
			    
			    $item="";$mrp=0;
			    $data1 = mysql_query("SELECT distinct(description) as description FROM txn_bill_support WHERE sk_tran_id='".$barcode[1]."' ORDER BY description");
			    while($info1 = mysql_fetch_array($data1))
			    {
			    	$mrp=0;
			    	$data = mysql_query("SELECT mrp FROM stock WHERE flower_name='".$barcode[0]."' and description='".$info1["description"]."'");
			    	while($info = mysql_fetch_array($data))
			    	{
			    		$mrp=$info["mrp"];
			    	}
			    	$item=$item_name ."(" .$info1["description"].")";
			    	
			    }
			    if($category!="" && $item_id!=null && $item!="") {
			    	$output=array(
			    				'categoryId'=>$category,
			    				'categoryName'=>$category_name,
			    				'itemId'=>$item_id,
			    				'itemName'=>$item,
			    				'mrp'=>$mrp
			    			    
			    			);
			    	header('HTTP/1.1 200 Ok', true, 200);
			    	$result=array('status'=>true,
			    				  'message'=>'success',
			    				  'data'=>$output
			    				);
			    }
			    else {
			    	header('HTTP/1.1 404 Not Ok', true, 404);
			    	$result=array('status'=>false,
			    			'message'=>'No item found',
			    			'data'=>$output
			    	);
			    }
			}
			else {
			    header('HTTP/1.1 403 Not Ok', false, 403);
			    	$result=array('status'=>false,
			    				  'message'=>'failure',
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