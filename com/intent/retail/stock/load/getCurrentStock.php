<?php

	include_once '../../connection/db.php';

  	$string = '';$date_filter="";
  	$item_id=$_POST["item_id"];
  	$desc=$_POST["desc"];
		
		$data6 = mysql_query("SELECT distinct(description) as description from txn_bill_support where particular_id='".$item_id."' and description like '%".$desc."%'");
        while($info6 = mysql_fetch_array( $data6 ))
        {
        	$total_piece=0;
			$data2 = mysql_query("SELECT sum(qty_in_sft),sum(qty_in_piece) FROM txn_bill_support WHERE particular_id='$item_id' and bill_for='Supplier' and bill_type='Cash' and description='".$info6["description"]."' $date_filter");
			while($info2 = mysql_fetch_array($data2))
			{
				$total_sft=$info2[0];
				$total_piece=$info2[1];
			}
	
		   $data2 = mysql_query("SELECT sum(qty_in_sft),sum(qty_in_piece) FROM txn_bill_support WHERE particular_id='$item_id' and bill_for='Supplier' and bill_type='Credit' and description='".$info6["description"]."' $date_filter");
			while($info2 = mysql_fetch_array($data2))
			{
				$total_sft=$total_sft=$info2[0];
				$total_piece=$total_piece=$info2[1];
			}
	
	
			$return_total_sft=0;
			$return_total_piece=0;
			$data2 = mysql_query("SELECT sum(qty_in_sft),sum(qty_in_piece) FROM txn_bill_support WHERE particular_id='$item_id' and bill_for='Supplier' and bill_date>'2017-04-24' and bill_type like '%return%' and description='".$info6["description"]."' $date_filter");
			while($info2 = mysql_fetch_array($data2))
			{
				$return_total_sft=$info2[0];
				$return_total_piece=$info2[1];
			}
	
	
			$total_sft=$total_sft-$return_total_sft;
			$total_piece=$total_piece-$return_total_piece;
              $c_sessing_qty=0;$c_sessing_qty_p=0;
              $data2 = mysql_query("SELECT sum(qty_in_sft),sum(qty_in_piece) FROM txn_bill_support WHERE particular_id='$item_id' and bill_for='Customer' and bill_type='Cash' and description='".$info6["description"]."' $date_filter");
              while($info2 = mysql_fetch_array($data2))
              {
              	$c_sessing_qty=$info2[0];
              	$c_sessing_qty_p=$info2[1];
              
              }
              $data2 = mysql_query("SELECT sum(qty_in_sft),sum(qty_in_piece) FROM txn_bill_support WHERE particular_id='$item_id' and bill_for='Customer' and bill_type='Credit' and description='".$info6["description"]."' $date_filter");
              while($info2 = mysql_fetch_array($data2))
              {
              	$c_sessing_qty=$c_sessing_qty+$info2[0];
              	$c_sessing_qty_p=$c_sessing_qty_p+$info2[1];
              
              }
              
              $ledger_qty=0;$ledger_qty_p=0;
              
              
              $r_sessing_qty=0;$r_sessing_qty_p=0;
              $data2 = mysql_query("SELECT sum(qty_in_sft),sum(qty_in_piece) FROM txn_bill_support WHERE particular_id='$item_id' and bill_for='Customer' and bill_type like '%return%' and description='".$info6["description"]."' $date_filter");
              while($info2 = mysql_fetch_array($data2))
              {
              	$r_sessing_qty=$info2[0];
              	$r_sessing_qty_p=$info2[1];
              
              }
              
              
              $o_sessing_qty=0;
                                  
              $data2 = mysql_query("SELECT sum(remaining_qty) FROM stock WHERE flower_name='$item_id' and description='".$info6["description"]."'");
              while($info2 = mysql_fetch_array($data2))
              {
              	$o_sessing_qty=$info2[0];
              }
             
              $cur_stock=($total_sft)-($o_sessing_qty+($c_sessing_qty-$r_sessing_qty));
		}
		if(isset($cur_stock))
			echo $cur_stock;
?>
	
