<?php
if(isset($_REQUEST['act']) && $_REQUEST['act'] =='autoSuggestUser' && isset($_REQUEST['queryString'])) {

	/*$db_host = 'localhost';
   $db_user = 'root';
   $db_password = 'root';
   $db_name = 'finance';
   */
	include_once '../connection/db.php';
/*   $connect = mysql_connect($db_host, $db_user ,$db_password);
   $db = mysql_select_db($db_name,$connect);
   if($db)*/{
  	$string = '';
  	$item_id=$_GET["item_id"];
		$queryString = $_REQUEST['queryString'];
		$query = "SELECT distinct(description) as description FROM txn_bill_support WHERE description like'%" .$queryString . "%' and particular_id='$item_id' ORDER BY description";
		$resource = mysql_query($query);
		
		if($resource && mysql_num_rows($resource) > 0) {
		$string.= '<ul>';
			while($result = mysql_fetch_object($resource)){
				$string.= '<li onClick="fillId(\''.addslashes($result->description).'\');fill(\''.addslashes($result->description).'\');">'.$result->description.'</li>';
				/*	$string.= '<li onClick="fillId(\''.addslashes($result->customer_id).'\');fill(\''.addslashes($result->customer_name).'\');">'.$result->customer_name.'</li>';*/
			}
		$string.= '</ul>';
			
		} else {
			$string.= '';//<li>No Record found</li>
		}
		echo $string;		
		exit;

   }
   exit;
}
	
?>
	<link rel="stylesheet" href="css/autosuggest.css" />

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.js"></script>
