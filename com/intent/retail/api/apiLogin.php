<?php
	include '../connection/db.php';
	include '../connection/jwt_helper.php';
	$params = json_decode(@file_get_contents('php://input'), TRUE);
	try {
		if(count($params)>0) {
			$username=$params['username'];
			$password=$params['password'];
			$data = mysql_query("SELECT sk_member_id,member_name,member_type,branch_id,profile_pic,role FROM mst_member where login_name='$username' and login_password='$password' and login_name!='' and login_status='active'");
			$countRows=mysql_num_rows($data);
			if($countRows>0) {
				while($info = mysql_fetch_array( $data )) {
					$accessToken=JWT::encode($info["sk_member_id"],$key);
					$memberName=$info["member_name"];
					$memberType=$info["role"];
					$branch=$info["branch_id"];
				
					if($info["profile_pic"]=="" || $info["profile_pic"]=="no_preview.png") {
						$profilePic="dmg.png";
					}
					else {
						$profilePic=$info["profile_pic"];
					}
					header('HTTP/1.1 200 Ok', true, 200);
					$result=array('status'=>true,
								  'message'=>'success',
								  'data'=>array('Accesstoken'=>$accessToken,'MemberName'=>$memberName,'MemberType'=>$memberType,'Branch'=>$branch,'ProfilePic'=>$profilePic)
								);
					
				}
			}
			else {
				header('HTTP/1.1 401 Not Ok', true, 401);
				$result=array('status'=>false,
						'message'=>"User doesn't exist",
						'data'=>null
				);
			}
		}
		else {
			header('HTTP/1.1 403 Not Ok', true, 403);
			$result=array('status'=>false,
					'message'=>'Input is missing',
					'data'=>null
			);
		}
		
	}
	catch(Exception $e) {
		header('HTTP/1.1 403 Not Ok', true, 403);
		$result=array('status'=>false,
				'message'=>'Something went wrong',
				'data'=>null
		);
	}
	echo json_encode($result);
?>