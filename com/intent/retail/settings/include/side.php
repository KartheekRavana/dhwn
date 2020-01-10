<aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="<?php echo $UI_ELEMENTS?>dist/img/user2-160x160.jpg" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
              <p><?php echo $session_name?></p>
	<script type="text/javascript">
	
	setInterval(function(){
	       document.getElementById("session_timeout").innerHTML=document.getElementById("session_timeout").innerHTML-1;
	       if(document.getElementById("session_timeout").innerHTML<=0){window.location="index.php?action=logout&c=login";}
	       if(document.getElementById("session_timeout").innerHTML<=200){document.getElementById("session_timeout").style.color = 'red'}
	 },1000);
	</script>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a> <span title="Session TimeOut" id="session_timeout" style="color: green;font-weight: bold;"><?php echo $maxlifetime = ini_get("session.gc_maxlifetime");?></span>
            </div>
          </div>
          <!-- search form -->
          
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
           
            <li class="" id='dashboard'>
              <a href="index.php?action=settings&c=settings">
                <i class="fa fa-dashboard"></i> <span>Home</span> 
              </a>
              
            </li>
            
            
            <li class="treeview" id="settings">
              <a href="#">
                <i class="fa fa-users"></i>
                <span>Branch</span>
                <span class="label label-primary pull-right">4</span>
              </a>
              <ul class="treeview-menu">
                <li><a href="index.php?action=new&c=settings"><i class="fa fa-circle-o"></i> New Branch</a></li>
                <li><a href="index.php?action=view&c=branch"><i class="fa fa-circle-o"></i> View Branch</a></li>
                
          
              </ul>
            </li>
            <li class="treeview" id="supplier">
              <a href="#">
                <i class="fa fa-user"></i>
                <span>Supplier</span>
                <span class="label label-primary pull-right">4</span>
              </a>
              <ul class="treeview-menu">
                <li><a href="index.php?action=new&c=supplier"><i class="fa fa-circle-o"></i> New Supplier</a></li>
                <li><a href="index.php?action=view&c=supplier"><i class="fa fa-circle-o"></i> View Supplier</a></li>
          		
              </ul>
            </li>
            <li class="treeview" id="employee">
              <a href="#">
                <i class="fa fa-male"></i>
                <span>Employee</span>
                <span class="label label-primary pull-right">4</span>
              </a>
              <ul class="treeview-menu">
                <li><a href="index.php?action=new&c=employee"><i class="fa fa-circle-o"></i> New Employee</a></li>
                <li><a href="index.php?action=view&c=employee"><i class="fa fa-circle-o"></i> View Employee</a></li>
          
              </ul>
            </li>
            
            
            
            <li class="treeview" id="items">
              <a href="#">
                <i class="fa fa-th-large"></i>
                <span>Items</span>
                <span class="label label-primary pull-right">4</span>
              </a>
              <ul class="treeview-menu">
                <li><a href="index.php?action=new&c=items"><i class="fa fa-circle-o"></i> Manage Items</a></li>
                
          
              </ul>
            </li>
            
            <li class="treeview" id="addressbook">
              <a href="#">
                <i class="fa fa-phone"></i>
                <span>Address Book</span>
                <span class="label label-primary pull-right">4</span>
              </a>
              <ul class="treeview-menu">
                <li><a href="index.php?action=suppllier&c=addressbook"><i class="fa fa-circle-o"></i> Supplier AddressBook</a></li>
                <li><a href="index.php?action=customer&c=addressbook"><i class="fa fa-circle-o"></i> Customer AddressBook</a></li>
          <li><a href="index.php?action=agent&c=addressbook"><i class="fa fa-circle-o"></i> Agent AddressBook</a></li>
              </ul>
            </li>
            <!-- <li>
              <a href="pages/widgets.html">
                <i class="fa fa-th"></i> <span>Widgets</span> <small class="label pull-right bg-green">new</small>
              </a>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-pie-chart"></i>
                <span>Charts</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/charts/morris.html"><i class="fa fa-circle-o"></i> Morris</a></li>
                <li><a href="pages/charts/flot.html"><i class="fa fa-circle-o"></i> Flot</a></li>
                <li><a href="pages/charts/inline.html"><i class="fa fa-circle-o"></i> Inline charts</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-laptop"></i>
                <span>UI Elements</span>
                <i class="fa fa-angle-left pull-right"></i>
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
                <i class="fa fa-angle-left pull-right"></i>
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
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/tables/simple.html"><i class="fa fa-circle-o"></i> Simple tables</a></li>
                <li><a href="pages/tables/data.html"><i class="fa fa-circle-o"></i> Data tables</a></li>
              </ul>
            </li>
            <li>
              <a href="pages/calendar.html">
                <i class="fa fa-calendar"></i> <span>Calendar</span>
                <small class="label pull-right bg-red">3</small>
              </a>
            </li>
            <li>
              <a href="pages/mailbox/mailbox.html">
                <i class="fa fa-envelope"></i> <span>Mailbox</span>
                <small class="label pull-right bg-yellow">12</small>
              </a>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-folder"></i> <span>Examples</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/examples/invoice.html"><i class="fa fa-circle-o"></i> Invoice</a></li>
                <li><a href="pages/examples/login.html"><i class="fa fa-circle-o"></i> Login</a></li>
                <li><a href="pages/examples/register.html"><i class="fa fa-circle-o"></i> Register</a></li>
                <li><a href="pages/examples/lockscreen.html"><i class="fa fa-circle-o"></i> Lockscreen</a></li>
                <li><a href="pages/examples/404.html"><i class="fa fa-circle-o"></i> 404 Error</a></li>
                <li><a href="pages/examples/500.html"><i class="fa fa-circle-o"></i> 500 Error</a></li>
                <li><a href="pages/examples/blank.html"><i class="fa fa-circle-o"></i> Blank Page</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-share"></i> <span>Multilevel</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
                <li>
                  <a href="#"><i class="fa fa-circle-o"></i> Level One <i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
                    <li>
                      <a href="#"><i class="fa fa-circle-o"></i> Level Two <i class="fa fa-angle-left pull-right"></i></a>
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
            <li><a href="documentation/index.html"><i class="fa fa-book"></i> Documentation</a></li>
            <li class="header">LABELS</li>
            <li><a href="#"><i class="fa fa-circle-o text-danger"></i> Important</a></li>
            <li><a href="#"><i class="fa fa-circle-o text-warning"></i> Warning</a></li>
            <li><a href="#"><i class="fa fa-circle-o text-info"></i> Information</a></li> -->
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
        