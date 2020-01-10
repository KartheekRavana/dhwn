<?php 
$total=0;
           $q=" and tran_date>='2016-10-31' and tran_date<='$date' and tran_status='active'";    
  $from_date=$date;
     
    $received_amt=0;
    $data = mysql_query("SELECT sk_tran_id,tran_date,debit,tran_desc,transaction_ref_id FROM txn_transaction where tran_type='Customer' and tran_desc='New Bill' and debit>0 and note='Cash' $q");
	while($info = mysql_fetch_array( $data ))
	{      
	 	$received_amt=$received_amt+$info["debit"];
	}
	 $data = mysql_query("SELECT sk_tran_id,tran_date,credit,tran_desc,transaction_ref_id,member_id FROM txn_transaction where tran_type='Supplier' and tran_desc='Payment Return' and credit>0 $q");
	                	while($info = mysql_fetch_array( $data ))
	                	{      
	                		$received_amt=$received_amt+$info["credit"];
	                	}
	$data = mysql_query("SELECT sk_tran_id,tran_date,debit,tran_desc,member_id,transaction_ref_id FROM txn_transaction where tran_type='Customer' and debit>0 and tran_desc='New Bill' and member_id!=0 $q");
	while($info = mysql_fetch_array( $data ))
	{      
	    $received_amt=$received_amt+$info["debit"];      		
	}
	 $credit_payment=0;
     $data = mysql_query("SELECT sk_tran_id,tran_date,debit,tran_desc,member_id FROM txn_transaction where tran_type='Customer' and debit>0 and tran_desc='Payment' $q");
	 while($info = mysql_fetch_array( $data ))
	 {      
		$credit_payment=$credit_payment+$info["debit"];  
	 }
	 $bank_withdraw=0;
     $data = mysql_query("SELECT sk_tran_id,tran_date,debit,tran_desc,member_id FROM txn_transaction where tran_type='Bank' and debit>0 $q");
	 while($info = mysql_fetch_array( $data ))
	 {      
		$bank_withdraw=$bank_withdraw+$info["debit"];  
	  }
	  $hand_loan=0;
      $data = mysql_query("SELECT sk_tran_id,tran_date,debit,tran_desc,member_id FROM txn_transaction where tran_type='Hand Loan' and debit>0 and tran_desc!='Ledger Balance' $q");
	  while($info = mysql_fetch_array( $data ))
	  {   
	    $hand_loan=$hand_loan+$info["debit"];   
	  }
	  
	  $income_ledger=0;
      $data = mysql_query("SELECT sk_tran_id,tran_date,credit,tran_desc,member_id FROM txn_transaction where tran_type='Income' and credit>0 $q");
	  while($info = mysql_fetch_array( $data ))
	  {   
	    $income_ledger=$income_ledger+$info["credit"];   
	  }
    
	  //************************************
	   $expense=0;
                    $data = mysql_query("SELECT sk_tran_id,tran_date,debit,tran_desc,member_id,note FROM txn_transaction where tran_type='Expense' and debit>0 $q");
	                	while($info = mysql_fetch_array( $data ))
	                	{      
						
	                		   $expense=$expense+$info["debit"]; 
	                	}
	                	 $data = mysql_query("SELECT sk_tran_id,tran_date,debit,tran_desc,member_id,note FROM txn_transaction where tran_type='Vat' and tran_desc='Payment' and transaction_ref_id=0 and debit>0 $q");
	                	while($info = mysql_fetch_array( $data ))
	                	{      
						
	                		   $expense=$expense+$info["debit"]; 
	                	}
	                	 $data = mysql_query("SELECT sk_tran_id,tran_date,debit,tran_desc,member_id,note FROM txn_transaction where tran_type='Bank' and tran_desc='Vat Payment' and debit>0 $q");
	          while($info = mysql_fetch_array( $data ))
	                	{  
	                		 $expense=$expense+$info["debit"]; 
	                	}
                    $data = mysql_query("SELECT sk_bill_id,purchase_exp,member_id FROM mst_bill_main where purchase_exp>0 and bill_date<='$date'");
	                	while($info = mysql_fetch_array( $data ))
	                	{      
					
	                		   $expense=$expense+$info["purchase_exp"];  
	                	}
	   $supplier_payments=0;
                    $data = mysql_query("SELECT sk_tran_id,tran_date,debit,tran_desc,member_id,transaction_ref_id FROM txn_transaction where tran_type='Bank' and tran_desc='Supplier Withdraw' and debit>0 $q");
	                	while($info = mysql_fetch_array( $data ))
	                	{ 
	                		  $supplier_payments=$supplier_payments+$info["debit"];  
	                	}
	                	
                    $data = mysql_query("SELECT sk_tran_id,tran_date,debit,tran_desc,member_id FROM txn_transaction where tran_type='Supplier' and debit>0 and tran_desc='Payment' $q");
	                	while($info = mysql_fetch_array( $data ))
	                	{      
						
	                		   $supplier_payments=$supplier_payments+$info["debit"]; 
	                	}
	                	$rent=0;
	                		  $data = mysql_query("SELECT sk_tran_id,tran_date,debit,tran_desc,member_id,note FROM txn_transaction where tran_type='Rent' and tran_desc='Payment' and debit>0 $q");
	                	while($info = mysql_fetch_array( $data ))
	                	{  
	                		$rent=$rent+$info["debit"];  
	                	}
	   $bank_deposit=0;
                    $data = mysql_query("SELECT sk_tran_id,tran_date,credit,tran_desc,member_id FROM txn_transaction where tran_type='Bank' and credit>0 and tran_desc!='Ledger Balance' $q");
	                	while($info = mysql_fetch_array( $data ))
	                	{      
					$bank_deposit=$bank_deposit+$info["credit"];   
	                	}
	    $transport=0;
                    $data = mysql_query("SELECT sk_tran_id,tran_date,debit,tran_desc,member_id FROM txn_transaction where tran_type='Transport' and debit>0 $q");
	                	while($info = mysql_fetch_array( $data ))
	                	{      
							$transport=$transport+$info["debit"];  
	                	}
	    $agent_com=0;
                    $data = mysql_query("SELECT sk_tran_id,tran_date,debit,tran_desc,member_id FROM txn_transaction where tran_type='Agent' and tran_desc='Payment' and debit>0 $q");
	                	while($info = mysql_fetch_array( $data ))
	                	{      
	                		   $agent_com=$agent_com+$info["debit"];
	                	}
	     $employee_payment=0;
                    $data = mysql_query("SELECT sk_tran_id,tran_date,debit,tran_desc,member_id FROM txn_transaction where tran_type='Employee' and tran_desc='Payment' and debit>0 $q");
	                	while($info = mysql_fetch_array( $data ))
	                	{      
						  $employee_payment=$employee_payment+$info["debit"];  
	                	}
	     $partner_payment=0;
                    $data = mysql_query("SELECT sk_tran_id,tran_date,debit,tran_desc,member_id FROM txn_transaction where tran_type='Partner' and tran_desc='Payment' and debit>0 $q");
	                	while($info = mysql_fetch_array( $data ))
	                	{      
						
	                		   $partner_payment=$partner_payment+$info["debit"];  
	                	}
	      $hand_loan_issue=0;
                    $data = mysql_query("SELECT sk_tran_id,tran_date,credit,tran_desc,member_id FROM txn_transaction where tran_type='Hand Loan' and tran_desc!='Ledger Balance' and credit>0 $q");
	                	while($info = mysql_fetch_array( $data ))
	                	{      
	                		   $hand_loan_issue=$hand_loan_issue+$info["credit"];  
	                	}
	     $hamali=0;
                    
                    $data = mysql_query("SELECT sk_tran_id,tran_date,debit,tran_desc,member_id FROM txn_transaction where tran_type='Hamali' and debit>0 $q");
	                	while($info = mysql_fetch_array( $data ))
	                	{      
						
	                		   $hamali=$hamali+$info["debit"];    
	                	}


	                	
	                		$investment_payment_ledger=0;
                    
                    $data = mysql_query("SELECT sk_tran_id,tran_date,debit,tran_desc,member_id FROM txn_transaction where tran_type='Investment' and tran_desc='Payment' and debit>0 $q");
	                	while($info = mysql_fetch_array( $data ))
	                	{      
						
	                		   $investment_payment_ledger=$investment_payment_ledger+$info["debit"];    
	                	}
	                	
	                	$investment_deposit_ledger=0;
                    
                    $data = mysql_query("SELECT sk_tran_id,tran_date,credit,tran_desc,member_id FROM txn_transaction where tran_type='Investment' and tran_desc='Returns' and credit>0 $q");
	                	while($info = mysql_fetch_array( $data ))
	                	{      
						
	                		   $investment_deposit_ledger=$investment_deposit_ledger+$info["credit"];    
	                	}
	                	
	                	
	                	$customer_return=0;
                    $data = mysql_query("SELECT sk_tran_id,tran_date,credit,tran_desc,member_id,transaction_ref_id FROM txn_transaction where tran_type='Customer' and tran_desc='Payment Return' and credit>0 $q");
	                	while($info = mysql_fetch_array( $data ))
	                	{      
						
		                	
	                		   $customer_return=$customer_return+$info["credit"];  
	                	}
	                	 $data = mysql_query("SELECT sk_tran_id,tran_date,debit,tran_desc,member_id,transaction_ref_id FROM txn_transaction where tran_type='Customer' and tran_desc='Return Bill' and debit>0 and member_id=0 $q");
	                	while($info = mysql_fetch_array( $data ))
	                	{      
						 $customer_return=$customer_return+$info["debit"];   
	                	}


	                	
	                	$opening=($received_amt+$credit_payment+$bank_withdraw+$hand_loan+$income_ledger+$investment_deposit_ledger)-($expense+$customer_return+$supplier_payments+$bank_deposit+$transport+$agent_com+$employee_payment+$partner_payment+$hand_loan_issue+$hamali+$rent+$investment_payment_ledger);
	 $opening=($opening+52270+230628)-250482;
	  
	  
	  $data = mysql_query("SELECT sk_member_id, member_type, member_name, acc_no, ifsc, mobile, landline, email, address, place, state, profile_pic, login_name, login_password, login_status, employee_id, branch_id,member_status FROM mst_member where member_type='2' and member_status='active'");
                    	while($info = mysql_fetch_array( $data ))
                    	{
                    		$member_type=$info["member_type"];
                    		$customerid=$info['sk_member_id'];
                    		$member_filter="";
                    		$balance=0;
                    	  if($member_type=="3"){$q=" and member_id='$customerid'";$page="purchase"; $member_filter="  and tran_type='Supplier' ";}
                    		$supplier = mysql_query("SELECT credit, debit,transaction_ref_id,tran_desc FROM txn_transaction where member_id='".$customerid."' $member_filter and tran_status='active'");
                    		while($supplier1 = mysql_fetch_array( $supplier ))
                    		{
                    			if($supplier1['credit']!=0 || $supplier1['debit']!=0)
                    			{
                    			$discount=0;
                   		if($supplier1["tran_desc"]=='New Bill'){
                  $data1 = mysql_query("SELECT discount FROM mst_bill_main where sk_bill_id='".$supplier1["transaction_ref_id"]."'");
                  while($info1 = mysql_fetch_array( $data1 ))
                  {
                  	$discount=$info1[0];
                  }
                   		}
                    				$balance=$balance+($supplier1['credit']);
                    				$balance=$balance-$supplier1['debit'];
                    				$balance=$balance-$discount;
                    				$balance=number_format((float)$balance, 0, '.', '');
                    			}
                    		}
                    		
                    		
                    		if($balance>0){
                    		$total=$total+$balance;
                    		}
                    	}
                    	$customer_credit_balance=$total;
?>
<header class="main-header">
    <!-- Logo -->
    <a href="?action=index&c=dashboard" class="logo hidden-md hidden-xs">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>DHW</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>DHW</b>GNT</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
      <ul class="nav navbar-nav" id='li1'>
            <li class="hidden-xs hidden-md"><a href="index.php?action=dateupdate&c=settings" title="Click On Date To Change Date"><?php echo $date1?> <span class="sr-only">(current)</span></a></li>
              <li class='hidden-xs hidden-md'><a href="#" style="font-weight: bold;font-size: 12px;position: relative;-moz-box-shadow: 0 0 30px 5px #fff;-webkit-box-shadow: 0 0 30px 5px #fff;">CB : <?php echo $opening?> &nbsp;&nbsp;| <span style="color: white;">&nbsp;&nbsp;&nbsp;CBL : <?php echo number_format((float)($total), 2, '.', '')?>&nbsp;</span></a></li> 
           <li>   
           
              </li>
              
            </ul>
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">4</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 4 messages</li>
              <li>
          
                <ul class="menu">
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="<?php echo $UI_ELEMENTS?>dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Support Team
                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                 
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="<?php echo $UI_ELEMENTS?>dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        AdminLTE Design Team
                        <small><i class="fa fa-clock-o"></i> 2 hours</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="<?php echo $UI_ELEMENTS?>dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Developers
                        <small><i class="fa fa-clock-o"></i> Today</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="<?php echo $UI_ELEMENTS?>dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Sales Department
                        <small><i class="fa fa-clock-o"></i> Yesterday</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="<?php echo $UI_ELEMENTS?>dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Reviewers
                        <small><i class="fa fa-clock-o"></i> 2 days</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">See All Messages</a></li>
            </ul>
          </li>
         
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">10</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 10 notifications</li>
              <li>
            
                <ul class="menu">
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
                      page and may cause design problems
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-red"></i> 5 new members joined
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-user text-red"></i> You changed your username
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>
       
          <li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              <span class="label label-danger">9</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 9 tasks</li>
              <li>
           
                <ul class="menu">
                  <li>
                    <a href="#">
                      <h3>
                        Design some buttons
                        <small class="pull-right">20%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">20% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                 
                  <li>
                    <a href="#">
                      <h3>
                        Create a nice theme
                        <small class="pull-right">40%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">40% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                 
                  <li>
                    <a href="#">
                      <h3>
                        Some task I need to do
                        <small class="pull-right">60%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">60% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                 
                  <li>
                    <a href="#">
                      <h3>
                        Make beautiful transitions
                        <small class="pull-right">80%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">80% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  
                </ul>
              </li>
              <li class="footer">
                <a href="#">View all tasks</a>
              </li>
            </ul>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo $UI_ELEMENTS?>dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $session_name?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo $UI_ELEMENTS?>dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p>
                  <?php echo $session_name?>
                  
                </p>
              </li>
              <!-- Menu Body -->
              
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="?action=profile&c=login" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="?action=logout&c=login" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>