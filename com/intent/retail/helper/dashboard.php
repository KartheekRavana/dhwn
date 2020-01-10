 <?php 
 include_once '../connection/db.php';
 $temp_date="";

 $total_rev=0;
 $total_profit=0;
 $total_cost=0;
 $temp_sales=0;
 $temp_exp=0;
	for($x=11; $x>=0;$x--){
	
		date_default_timezone_set('Asia/Calcutta');
 		$temp_date=$temp_date."#".date('F Y', strtotime(date('Y-m')." -" . $x . " month"));
 		$year=date('Y', strtotime(date('Y-m')." -" . $x . " month"));
 		$month=date('m', strtotime(date('Y-m')." -" . $x . " month"));
 		$tran_date=" between '$year-$month-1' and '$year-$month-31'";
 		$exp=expenses($tran_date);
 		$temp_exp=$temp_exp."#".$exp;
 		$sale=sales($tran_date);
 		$temp_sales=$temp_sales."#".$sale;
 		$total_rev=$total_rev+$sale;
 		$total_cost=$total_cost+$exp;
 		$total_profit=$total_profit+($sale-$exp);
 	}
 	echo $temp_date."::".$temp_exp."::".$temp_sales."::".$total_rev."::".$total_cost."::".$total_profit;
?>


<?php 



function expenses($tran_date)
{
	$br_id="All";
	if($br_id=='All'){$br_id="";$br_id1='';}else{$br_id=" and branch=".$session_branch;$br_id1=" where branch=".$session_branch;}
	
	
	$loan_paid=0;
	$customer = mysql_query("SELECT loan_id, person_id, date_payed, amount_payed, login_id, branch FROM loanpay where date_payed $tran_date $br_id");
	while($customer1 = mysql_fetch_array( $customer ))
	{
		$loan_paid=$loan_paid+$customer1["amount_payed"];
	}
	
	$expense_t1=0;
	$exp2 = mysql_query("SELECT sum(amount) FROM expense where expense_date $tran_date and expense_name!='DISCOUNT' $br_id");
	while($expense3 = mysql_fetch_array( $exp2 ))
	{
		$expense_t1=$expense3[0];
	}
	
	$supplier_t1=0;
	$supplier = mysql_query("SELECT sum(debit) FROM supplier_transactions where tran_date $tran_date $br_id");
	while($supplier1 = mysql_fetch_array( $supplier ))
	{
		$supplier_t1=$supplier1[0];
	}
	
	$comission_t1=0;
	$supplier = mysql_query("SELECT sum(comm_amt) FROM comission where comm_date $tran_date $br_id");
	while($supplier1 = mysql_fetch_array( $supplier ))
	{
		$comission_t1=$supplier1[0];
	}
	
	$employee_t1=0;
	$supplier = mysql_query("SELECT sum(debit_amt) FROM employee_transactions where tran_date $tran_date $br_id");
	while($supplier1 = mysql_fetch_array( $supplier ))
	{
		$employee_t1=$supplier1[0];
	}
	
	$layer_t1=0;
	$supplier = mysql_query("SELECT sum(debit_amt) FROM layer_transactions where tran_date $tran_date $br_id");
	while($supplier1 = mysql_fetch_array( $supplier ))
	{
		$layer_t1=$supplier1[0];
	}
	
	$bank_credit=0;
	$customer = mysql_query("SELECT bank_ID,customer_id, TRAN_DATE, TRAN_TIME, cheque_NO, slip_no, credit, debit, TRAN_STATUS, employee, branch, tran_id, balance, note FROM bank_transactions where credit>0 and tran_date $tran_date and tran_type!='INTEREST' and tran_date>'2014-10-23' $br_id");
	while($customer1 = mysql_fetch_array( $customer ))
	{
		$bank_credit=$bank_credit+$customer1['credit'];
	}
	
	$partner_debit=0;
	$customer = mysql_query("SELECT partner_ID, TRAN_DATE, TRAN_TIME, BILL_NO, slip_no, credit, debit, TRAN_STATUS, employee, branch, tran_id, balance, note FROM partner_transactions where debit>0 and tran_date $tran_date $br_id");
	while($customer1 = mysql_fetch_array( $customer ))
	{
		$partner_debit=$partner_debit+$customer1['debit'];
	}
	
	$loan_issue=0;
	$data = mysql_query("SELECT sum(debit) as debit from fin_loan_transaction where tran_date $tran_date");
	while($info = mysql_fetch_array( $data ))
	{
		$loan_issue=$info['debit'];
	}
	return ($loan_paid+$expense_t1+$supplier_t1+$comission_t1+$employee_t1+$layer_t1+$bank_credit+$partner_debit+$loan_issue);
}
?>




<?php 


function sales($tran_date)
{
	$br_id="All";
	if($br_id=='All'){$br_id="";$br_id1='';}else{$br_id=" and branch=".$session_branch;$br_id1=" where branch=".$session_branch;}
	
	
	$t=0;
	$supplier = mysql_query("SELECT sum(amount_paid),sum(final_bal) FROM customerbillmain where bill_date $tran_date $br_id");
	while($supplier1 = mysql_fetch_array( $supplier ))
	{
	
		$t=$supplier1[0]+$supplier1[1];
	}
	
	/*
$customer_t1=0;
$supplier = mysql_query("SELECT sum(debit) FROM customer_transactions where tran_date $tran_date and note!='Discount' and note!='RETURN' $br_id");
while($supplier1 = mysql_fetch_array( $supplier ))
{

	$customer_t1=$supplier1[0];
}
$advance_t=0;
$supplier = mysql_query("SELECT sum(advance) FROM customerbillmainadvance where bill_date $tran_date $br_id");
while($supplier1 = mysql_fetch_array( $supplier ))
{

	$advance_t=$supplier1[0];
}
$loan_coll=0;
$data = mysql_query("SELECT sum(credit) as credit from fin_loan_transaction where tran_date $tran_date");
while($info = mysql_fetch_array( $data ))
{

	$loan_coll=$info['credit'];

}
$customer_b1=0;
$supplier = mysql_query("SELECT sum(balance) FROM customer $br_id1");
while($supplier1 = mysql_fetch_array( $supplier ))
{

	$customer_b1=$supplier1[0];
}
$cashe_b1=0;
$supplier = mysql_query("SELECT sum(amt) FROM cashe_balance where cashe_date<='2014-10-23' $br_id");
while($supplier1 = mysql_fetch_array( $supplier ))
{

	$cashe_b1=$supplier1[0];
}
$bank_debit=0;
$customer = mysql_query("SELECT bank_ID,customer_id, TRAN_DATE, TRAN_TIME, cheque_NO, slip_no, credit, debit, TRAN_STATUS, employee, branch, tran_id, balance, note FROM bank_transactions where debit>0 and tran_date $tran_date and tran_date>'2014-10-23' $br_id");
while($customer1 = mysql_fetch_array( $customer ))
{
	$bank_debit=$bank_debit+$customer1['debit'];
}
$partner_credit=0;
$customer = mysql_query("SELECT partner_ID, TRAN_DATE, TRAN_TIME, BILL_NO, slip_no, credit, debit, TRAN_STATUS, employee, branch, tran_id, balance, note FROM partner_transactions where credit>0 and note!='Profit Credit' and tran_date $tran_date $br_id");
while($customer1 = mysql_fetch_array( $customer ))
{
	$partner_credit=$partner_credit+$customer1['credit'];
}

$loan=0;
$customer = mysql_query("SELECT loan_id, person_id, amount, amount_payed, date_credit, login_id, branch FROM loan where date_credit $tran_date and date_credit>'2014-10-23' $br_id");
while($customer1 = mysql_fetch_array( $customer ))
{
	$loan=$loan+$customer1["a0mount"];
}*/
	return($t);
//return ($loan+$customer_t1+$cashe_b1+$advance_t+$bank_debit+$partner_credit+$loan_coll); 
}
//*********************************************************************************
//$final_bal=($loan+$customer_t1+$cashe_b1+$advance_t+$bank_debit+$partner_credit+$loan_coll)-($loan_paid+$expense_t1+$supplier_t1+$comission_t1+$employee_t1+$layer_t1+$bank_credit+$partner_debit+$loan_issue);

?>