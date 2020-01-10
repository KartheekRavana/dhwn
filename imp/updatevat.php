<?php
include_once 'connection/db.php';

$member_bill_support="";
       
         	$data4 = mysql_query("SELECT tran_id, bill_no, item_date, item_name, item_qty, item_rate, amt, landing_cost, total_landing_cost, item_qty_p,vat,discount FROM supplierbill");
            while($info4 = mysql_fetch_array( $data4 ))
            {
                	$item_id=$info4["item_name"];
                	$item_qty=$info4["item_qty"];
                	$item_qty_p=$info4["item_qty_p"];
                	$item_rate=$info4["item_rate"];
                	$amt=$info4["vat"];
                	$landing_cost=$info4["discount"];
                	$total_landing_cost=$info4["total_landing_cost"];
                	$member_bill_support=$member_bill_support."#".$item_id."::".$item_qty."::".$item_qty_p."::".$item_rate."::".$amt."::".$landing_cost."::".$total_landing_cost."::";
            }
            
            
             include_once 'connection/db1.php';
             
             
             $bill_support=explode("#", $member_bill_support);
              for($i=1;$i<sizeof($bill_support);$i++){
              	
             $temp=explode("::",$bill_support[$i]);
             $query="update txn_bill_support set vat='".$temp[4]."',discount='".$temp[5]."' where sk_tran_id='".$temp[0]."' and bill_for='supplier' ";
				mysql_query($query) or die('Query "' . $query . '" failed: ' . mysql_error());
				
               }