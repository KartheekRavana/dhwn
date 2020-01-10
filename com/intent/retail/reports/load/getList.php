<?php
$tran_type=$_GET["tran_type"];
$session_branch=$_GET["session_branch"];
include '../../connection/db.php';
include_once '../../helper/helper.php';

$output="";
if($tran_type=="Expenses")
{
$data = mysql_query("SELECT expense_id, expense_name FROM mst_expenselist WHERE expense_status='active' and branch_id='$session_branch' order by expense_name asc");
while($info = mysql_fetch_array($data))
{
     $output=$output."//".$info["expense_id"]."#".$info["expense_name"]."#";
}
}
if($tran_type=="Supplier")
{
	$data = mysql_query("SELECT sk_member_id,member_name FROM mst_member WHERE member_status='active' and member_type='3' and branch_id='$session_branch' order by member_name asc");
	while($info = mysql_fetch_array($data))
	{
	 $output=$output."//".$info["sk_member_id"]."#".$info["member_name"]."#";
	}
}
if($tran_type=="Customer")
{
	$data = mysql_query("SELECT sk_member_id,member_name FROM mst_member WHERE member_status='active' and member_type='2' and branch_id='$session_branch' order by member_name asc");
	while($info = mysql_fetch_array($data))
	{
	 $output=$output."//".$info["sk_member_id"]."#".$info["member_name"]."#";
	}
}
if($tran_type=="Employee")
{
	$data = mysql_query("SELECT sk_member_id,member_name FROM mst_member WHERE member_status='active' and member_type='1' and branch_id='$session_branch' order by member_name asc");
	while($info = mysql_fetch_array($data))
	{
	 $output=$output."//".$info["sk_member_id"]."#".$info["member_name"]."#";
	}
}
if($tran_type=="Auto")
{
	$data = mysql_query("SELECT sk_member_id,member_name FROM mst_member WHERE member_status='active' and member_type='4' and branch_id='$session_branch' order by member_name asc");
	while($info = mysql_fetch_array($data))
	{
	 $output=$output."//".$info["sk_member_id"]."#".$info["member_name"]."#";
	}
}
if($tran_type=="Agent")
{
	$data = mysql_query("SELECT sk_member_id,member_name FROM mst_member WHERE member_status='active' and member_type='5' and branch_id='$session_branch' order by member_name asc");
	while($info = mysql_fetch_array($data))
	{
	 $output=$output."//".$info["sk_member_id"]."#".$info["member_name"]."#";
	}
}
if($tran_type=="Bank")
{
	$data = mysql_query("SELECT sk_member_id,member_name,acc_no FROM mst_member WHERE member_status='active' and member_type='6' and branch_id='$session_branch' order by member_name asc");
	while($info = mysql_fetch_array($data))
	{
	 $output=$output."//".$info["sk_member_id"]."#".$info["member_name"]."(".$info["acc_no"].")#";
	}
}
if($tran_type=="Partner")
{
	$data = mysql_query("SELECT sk_member_id,member_name,acc_no FROM mst_member WHERE member_status='active' and member_type='7' and branch_id='$session_branch' order by member_name asc");
	while($info = mysql_fetch_array($data))
	{
	 $output=$output."//".$info["sk_member_id"]."#".$info["member_name"]."(".$info["mobile"].")#";
	}
}
if($tran_type=="Hand Loan")
{
	$data = mysql_query("SELECT sk_member_id,member_name,acc_no FROM mst_member WHERE member_status='active' and member_type='8' and branch_id='$session_branch' order by member_name asc");
	while($info = mysql_fetch_array($data))
	{
	 $output=$output."//".$info["sk_member_id"]."#".$info["member_name"]."(".$info["mobile"].")#";
	}
}
if($tran_type=="Hamali")
{
	$data = mysql_query("SELECT sk_member_id,member_name,acc_no FROM mst_member WHERE member_status='active' and member_type='9' and branch_id='$session_branch' order by member_name asc");
	while($info = mysql_fetch_array($data))
	{
	 $output=$output."//".$info["sk_member_id"]."#".$info["member_name"]."(".$info["mobile"].")#";
	}
}
if($tran_type=="Rent")
{
	$data = mysql_query("SELECT sk_member_id,member_name,acc_no FROM mst_member WHERE member_status='active' and member_type='10' and branch_id='$session_branch' order by member_name asc");
	while($info = mysql_fetch_array($data))
	{
	 $output=$output."//".$info["sk_member_id"]."#".$info["member_name"]."(".$info["mobile"].")#";
	}
}
if($tran_type=="Investment")
{
	$data = mysql_query("SELECT sk_member_id,member_name,acc_no FROM mst_member WHERE member_status='active' and member_type='11' and branch_id='$session_branch' order by member_name asc");
	while($info = mysql_fetch_array($data))
	{
	 $output=$output."//".$info["sk_member_id"]."#".$info["member_name"]."(".$info["mobile"].")#";
	}
}
if($tran_type=="Vat")
{
	$data = mysql_query("SELECT sk_member_id,member_name,acc_no FROM mst_member WHERE member_status='active' and member_type='12' and branch_id='$session_branch' order by member_name asc");
	while($info = mysql_fetch_array($data))
	{
	 $output=$output."//".$info["sk_member_id"]."#".$info["member_name"]."(".$info["mobile"].")#";
	}
}
echo $output;