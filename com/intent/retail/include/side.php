<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel hidden-md hidden-xs">
        <div class="pull-left image">
          <img src="<?php echo $UI_ELEMENTS?>dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $session_name?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <!-- <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form> -->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        
         <?php 
           $data = mysql_query("SELECT menu_id,menu_name,menu_link,menu_status,dir FROM menu_main where menu_status='active' and branch_id='$session_branch' order by priority asc");
           while($info = mysql_fetch_array( $data ))
           {
           	if($info["menu_link"]!="#")
           	{
           		$data2 = mysql_query("SELECT menu_status FROM menu_conf where menu_id='".$info["menu_id"]."' and branch_id='$session_branch' and employee_id='$session_id'");
           		while($info2 = mysql_fetch_array( $data2 ))
           		{
           			if($info2["menu_status"]=="active")
           			{
           				?>
           				<li class="" id='<?php echo $info["dir"]?>'>
              <a  class="waitMe_ex" href="<?php echo $info["menu_link"]?>">
                <i class="fa fa-dashboard"></i> <span><?php echo $info["menu_name"]?></span> 
              </a>
              
            </li>
           				<?php 
           			}
           		}
           ?>
           
           <?php }else{
           			$data2 = mysql_query("SELECT menu_status FROM menu_conf where menu_id='".$info["menu_id"]."' and branch_id='$session_branch' and employee_id='$session_id'");
           		while($info2 = mysql_fetch_array( $data2 ))
           		{
           			if($info2["menu_status"]=="active")
           			{?>
           
           <li class="treeview" id="<?php echo $info["dir"]?>">
              <a href="#">
                <i class="fa fa-list-alt"></i>
                <span><?php echo $info["menu_name"]?></span>
                
              </a>
              <ul class="treeview-menu">
              <?php 
              $data1 = mysql_query("SELECT submenu_id,submenu_name,submenu_link FROM menu_sub where menu_id='".$info["menu_id"]."' and branch_id='$session_branch'");
              while($info1 = mysql_fetch_array( $data1 ))
              {
              	$menu_status="";
              	$data2 = mysql_query("SELECT menu_status FROM menu_conf where submenu_id='".$info1["submenu_id"]."' and branch_id='$session_branch' and employee_id='$session_id'");
              	while($info2 = mysql_fetch_array( $data2 ))
              	{
              		if($info2["menu_status"]=="active")
              		{
              			?>
              			 <li><a  class="waitMe_ex" href="<?php echo $info1["submenu_link"]?>"><i class="fa fa-circle-o"></i> <?php echo $info1["submenu_name"]?></a></li>
              			<?php 
              		}
              	}
              ?>
               
               <?php }?>
              </ul>
            </li>
           <?php }}}?>
           <?php            
           }?>
        
    <!--     
        
        <li class="treeview" id='dashboard'>
          <a href="?action=index&c=dashboard">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              
            </span>
          </a>
          
        </li>
        <li class="treeview" id='inventory'>
          <a href="#">
            <i class="fa fa-edit"></i>
            <span>Inventory</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="?action=measurement_slip&c=inventory"><i class="fa fa-circle-o"></i> Measurement Slip</a></li>
            <li><a href="?action=sales&c=inventory"><i class="fa fa-circle-o"></i> Sales</a></li>
            <li><a href="?action=purchase&c=inventory"><i class="fa fa-circle-o"></i> Purchase</a></li>
            <li><a href="?action=sales_return&c=inventory"><i class="fa fa-circle-o"></i> Sales Return</a></li>
            <li><a href="?action=purchase_return&c=inventory"><i class="fa fa-circle-o"></i> Purchase Return</a></li>
            
          </ul>
        </li>
        <li class="treeview" id='transactions'>
          <a href="?action=bank&c=transactions">
            <i class="fa fa-users"></i>
            <span>Financial Transaction</span>
            <span class="pull-right-container">
        
            
            </span>
          </a>
       
        </li>
        <li class="treeview" id='members'>
          <a href="#">
            <i class="fa fa-users"></i>
            <span>Manage Members</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="?action=new&c=members"><i class="fa fa-circle-o"></i> New Member</a></li>
            <li class='hidden-xs'><a href="?action=view&c=members"><i class="fa fa-circle-o"></i> View Members</a></li>
             <li class='hidden-md hidden-lg'><a href="?action=view&c=members&lt=Customer" ><i class="fa fa-circle-o"></i>Credit Customer</a></li>
                  <li class='hidden-md hidden-lg'><a href="?action=cash&c=members&lt=Cash" ><i class="fa fa-circle-o"></i>Cash Customer</a></li>
                  <li class='hidden-md hidden-lg'><a href="?action=view&c=members&lt=Supplier"><i class="fa fa-circle-o"></i>Supplier</a></li>
                  <li class='hidden-md hidden-lg'><a href="?action=view&c=members&lt=Transporter"><i class="fa fa-circle-o"></i>Transporter</a></li>
                  <li class='hidden-md hidden-lg'><a href="?action=view&c=members&lt=Employee"><i class="fa fa-circle-o"></i>Employee</a></li>
                  <li class='hidden-md hidden-lg'><a href="?action=view&c=members&lt=Agent"><i class="fa fa-circle-o"></i>Agent</a></li>
                  <li class='hidden-md hidden-lg'><a href="?action=view&c=members&lt=Partner"><i class="fa fa-circle-o"></i>Partner</a></li>
                   <li class='hidden-md hidden-lg'><a href="?action=view&c=members&lt=HandLoan"><i class="fa fa-circle-o"></i>Hand Loan</a></li>
                  <li class='hidden-md hidden-lg'><a href="?action=view&c=members&lt=Hamali"><i class="fa fa-circle-o"></i>Hamali</a></li>
                  <li class='hidden-md hidden-lg'><a href="?action=view&c=members&lt=Rent"><i class="fa fa-circle-o"></i>Rent</a></li>
                  <li class='hidden-md hidden-lg'><a href="?action=view&c=members&lt=Investment"><i class="fa fa-circle-o"></i>Investment</a></li>
          </ul>
        </li>
        <li class="treeview" id='particluars'>
          <a href="#">
            <i class="fa fa-th"></i>
            <span>Particular</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="?action=new&c=particluars"><i class="fa fa-circle-o"></i> Manage Particluar</a></li>
            <li><a href="?action=category&c=particluars"><i class="fa fa-circle-o"></i> Manage Category</a></li>
          </ul>
        </li>
        <li class="treeview" id='reports'>
          <a href="#">
            <i class="fa fa-users"></i>
            <span>Reports</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
              
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="?action=daybook&c=reports"><i class="fa fa-circle-o"></i> DayBook</a></li>
            <li><a href="?action=sales_report&c=reports"><i class="fa fa-circle-o"></i> Sales Report</a></li>
            <li><a href="?action=purchase_report&c=reports"><i class="fa fa-circle-o"></i> Purchase Report</a></li>
            <li><a href="?action=expense_report&c=reports"><i class="fa fa-circle-o"></i> Expense Report</a></li>
            <li><a href="?action=stock_report&c=reports"><i class="fa fa-circle-o"></i> Stock Report</a></li>
            <li><a href="?action=log_report&c=reports"><i class="fa fa-circle-o"></i> Log Report</a></li>
           
          </ul>
        </li>
        
        
        <li class="treeview" id='reports'>
          <a href="#">
            <i class="fa fa-users"></i>
            <span>Settings</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
             
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="?action=menu_manage&c=settings"><i class="fa fa-circle-o"></i> Menu</a></li>
            <li><a href="?action=login_account&c=settings"><i class="fa fa-circle-o"></i> Menu Config</a></li>
           
          </ul>
        </li>
        
        <!-- <li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Charts</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="pages/charts/chartjs.html"><i class="fa fa-circle-o"></i> ChartJS</a></li>
            <li><a href="pages/charts/morris.html"><i class="fa fa-circle-o"></i> Morris</a></li>
            <li><a href="pages/charts/flot.html"><i class="fa fa-circle-o"></i> Flot</a></li>
            <li><a href="pages/charts/inline.html"><i class="fa fa-circle-o"></i> Inline charts</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span>UI Elements</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="pages/UI/general.html"><i class="fa fa-circle-o"></i> General</a></li>
            <li><a href="pages/UI/icons.html"><i class="fa fa-circle-o"></i> Icons</a></li>
            <li><a href="pages/UI/buttons.html"><i class="fa fa-circle-o"></i> Buttons</a></li>
            <li><a href="pages/UI/sliders.html"><i class="fa fa-circle-o"></i> Sliders</a></li>
            <li><a href="pages/UI/timeline.html"><i class="fa fa-circle-o"></i> Timeline</a></li>
            <li><a href="pages/UI/modals.html"><i class="fa fa-circle-o"></i> Modals</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-edit"></i> <span>Forms</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="pages/forms/general.html"><i class="fa fa-circle-o"></i> General Elements</a></li>
            <li><a href="pages/forms/advanced.html"><i class="fa fa-circle-o"></i> Advanced Elements</a></li>
            <li><a href="pages/forms/editors.html"><i class="fa fa-circle-o"></i> Editors</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-table"></i> <span>Tables</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="pages/tables/simple.html"><i class="fa fa-circle-o"></i> Simple tables</a></li>
            <li><a href="pages/tables/data.html"><i class="fa fa-circle-o"></i> Data tables</a></li>
          </ul>
        </li>
        <li>
          <a href="pages/calendar.html">
            <i class="fa fa-calendar"></i> <span>Calendar</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-red">3</small>
              <small class="label pull-right bg-blue">17</small>
            </span>
          </a>
        </li>
        <li>
          <a href="pages/mailbox/mailbox.html">
            <i class="fa fa-envelope"></i> <span>Mailbox</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-yellow">12</small>
              <small class="label pull-right bg-green">16</small>
              <small class="label pull-right bg-red">5</small>
            </span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-folder"></i> <span>Examples</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="pages/examples/invoice.html"><i class="fa fa-circle-o"></i> Invoice</a></li>
            <li><a href="pages/examples/profile.html"><i class="fa fa-circle-o"></i> Profile</a></li>
            <li><a href="pages/examples/login.html"><i class="fa fa-circle-o"></i> Login</a></li>
            <li><a href="pages/examples/register.html"><i class="fa fa-circle-o"></i> Register</a></li>
            <li><a href="pages/examples/lockscreen.html"><i class="fa fa-circle-o"></i> Lockscreen</a></li>
            <li><a href="pages/examples/404.html"><i class="fa fa-circle-o"></i> 404 Error</a></li>
            <li><a href="pages/examples/500.html"><i class="fa fa-circle-o"></i> 500 Error</a></li>
            <li><a href="pages/examples/blank.html"><i class="fa fa-circle-o"></i> Blank Page</a></li>
            <li><a href="pages/examples/pace.html"><i class="fa fa-circle-o"></i> Pace Page</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-share"></i> <span>Multilevel</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
            <li>
              <a href="#"><i class="fa fa-circle-o"></i> Level One
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
                <li>
                  <a href="#"><i class="fa fa-circle-o"></i> Level Two
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                  </ul>
                </li>
              </ul>
            </li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
          </ul>
        </li>
        <li><a href="documentation/index.html"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
        <li class="header">LABELS</li>
        <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li> -->
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
  
    <input type='hidden' id='ref_mod' value='<?php echo $_GET['c'];?>'>
<script type="text/javascript">
var pack=document.getElementById('ref_mod').value
var page="";

if(document.getElementById(pack).className=="")
    document.getElementById(pack).className=" active open";
else
	document.getElementById(pack).className=document.getElementById(pack).className+" active open";


if(document.getElementById(pack+"-nav").className=="")
    document.getElementById(pack+"-nav").className="open";
else
	document.getElementById(pack+"-nav").className="open";


</script>
        