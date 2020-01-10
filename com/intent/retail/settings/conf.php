<?php include_once "$D_PATH/include/session.php";?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>AdminLTE 2 | Dashboard</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="<?php echo $UI_ELEMENTS?>bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="<?php echo $UI_ELEMENTS?>plugins/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="<?php echo $UI_ELEMENTS?>plugins/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo $UI_ELEMENTS?>dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link href="<?php echo $UI_ELEMENTS?>dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="<?php echo $UI_ELEMENTS?>https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="<?php echo $UI_ELEMENTS?>https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript">
			function checkMenu(row,menu,submenu)
			{
				
				var session_id=document.getElementById("session_id").value
				var branch=document.getElementById("session_branch").value
				var user_id=document.getElementById("user_id").value

				var status="inactive";
				if(submenu==0)
				{
				if(document.getElementById("menu_"+row).checked==true)
				{
					status="active";
				}
				}
				else
				{
					if(document.getElementById("submenu_"+row).checked==true)
					{
						status="active";
					}
				}
				
				var xmlhttp;			 
				 if (window.XMLHttpRequest)
				   {// code for IE7+, Firefox, Chrome, Opera, Safari
				   xmlhttp=new XMLHttpRequest();
				   }
				 else
				   {// code for IE6, IE5
				   xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
				   }
				 xmlhttp.onreadystatechange=function()
				   {
				   if (xmlhttp.readyState==4 && xmlhttp.status==200)
				     {
					   var status=xmlhttp.responseText;
					   callme(status);
				     }
				   }

				 var D_PATH=document.getElementById("D_PATH").value
					var DIR=document.getElementById("DIR").value
					
				 xmlhttp.open("GET",D_PATH+"/"+DIR+"/operations/menu_conf.php?menu="+menu+"&submenu="+submenu+"&session_id="+session_id+"&branch="+branch+"&user_id="+user_id+"&status="+status,true);
				 xmlhttp.send();
					
			}
             </script>
             
  </head>
  <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
  <body class="skin-blue fixed">
    <div class="wrapper">
      
         <?php include_once "$D_PATH/include/header.php";?> 
      <!-- Left side column. contains the logo and sidebar -->
       <?php include_once "$D_PATH/include/side.php";?>
        
      <!-- Full Width Column -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
             Employee Login Account
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php?action=index&c=dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Employee</a></li>
            <li class="active">New Employee</li>
          </ol>
        </section>
          <section class="content">
        
        
        
        
     
          <div class="row">
            <!-- left column -->
            
            
            <!-- right column -->
            
            <div class="col-xs-12">
             

              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Items List</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                <input type='hidden' name="session_branch" id="session_branch" value="<?php echo $session_branch?>">
                <input type='hidden' name="session_id" id="session_id" value="<?php echo $session_id?>">
                <input type='hidden' name="user_id" id="user_id" value="<?php echo $_GET["e_id"]?>">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                     
                                        <th>Menu Name</th>
                                        <th>Submenu</th>
                                       
                                        
                                     
                        
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      $i=0;
                       $data = mysql_query("SELECT menu_id,menu_name,menu_link,menu_status FROM menu_main where menu_status='active' and branch_id='$session_branch'");
                      while($info = mysql_fetch_array( $data ))
                      {
                      	$status=$info["menu_status"];
                      	$menu_link=$info["menu_link"];
                                 $i++; 
                                 $menu_status="";
                                 
                                 $data2 = mysql_query("SELECT menu_status FROM menu_conf where menu_id='".$info["menu_id"]."' and branch_id='$session_branch' and employee_id='".$_GET["e_id"]."'");
                                 while($info2 = mysql_fetch_array( $data2 ))
                                 {
                                 	if($info2["menu_status"]=="active")
                                 	{
                                 	$menu_status="checked=checked";
                                 	}
                                 }
                                 ?>
                                    <tr>
                                     
                                        <td><input type='checkbox' <?php echo $menu_status?> onclick="checkMenu(<?php echo $i?>,<?php echo $info['menu_id']?>,0)" id='menu_<?php echo $i?>' value='<?php echo $info['menu_id']?>'><?php echo $info['menu_name']?></td>
                                        <td>
                                         <?php if($menu_link=="#"){?>
                                         <table class="table table-bordered table-striped">
                                        <tr><th>Sub&nbsp;Menu</th></tr>
                                        <?php   $data1 = mysql_query("SELECT submenu_id,submenu_name FROM menu_sub where menu_id='".$info["menu_id"]."' and branch_id='$session_branch'");
                      while($info1 = mysql_fetch_array( $data1 ))
                      {$i++;
                      $menu_status="";
                      $data2 = mysql_query("SELECT menu_status FROM menu_conf where submenu_id='".$info1["submenu_id"]."' and branch_id='$session_branch' and employee_id='".$_GET["e_id"]."'");
                      while($info2 = mysql_fetch_array( $data2 ))
                      {
                      	if($info2["menu_status"]=="active")
                      	{
                      		$menu_status="checked=checked";
                      	}
                      }
                             ?>
                             <tr><td><input type='checkbox' <?php echo $menu_status?> onclick="checkMenu(<?php echo $i?>,<?php echo $info['menu_id']?>,<?php echo $info1['submenu_id']?>)" id='submenu_<?php echo $i?>'><?php echo $info1['submenu_name']?></td></tr>
                             <?php }?>
                                        </table>
                                        <?php }?>
                                        </td>
                                        
                                        
                                        </tr>
                                   <?php }?>
                    </tbody>
                    
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
            
            
            
            
            
            
            <!--/.col (right) -->
          </div>   <!-- /.row -->
          
        </section><!-- /.content -->
      </div>
          
          
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
      <?php include_once "$D_PATH/settings/include/footer.php";?>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.3 -->
    
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo $UI_ELEMENTS?>bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- SlimScroll -->
    <script src="<?php echo $UI_ELEMENTS?>plugins/slimScroll/jquery.slimScroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='<?php echo $UI_ELEMENTS?>plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="<?php echo $UI_ELEMENTS?>dist/js/app.min.js" type="text/javascript"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo $UI_ELEMENTS?>dist/js/demo.js" type="text/javascript"></script>
  </body>
</html>
