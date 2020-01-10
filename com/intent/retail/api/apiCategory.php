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
				$data = mysql_query("SELECT category_id,category_name FROM category where category_status='active' ");
			    if($data) {
			    	$output=array();
			    	while($info = mysql_fetch_array( $data )){
			    		$list=array();
			    		$list['categoryId']=$info["category_id"];
			    		$list['categoryName']=$info["category_name"];
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