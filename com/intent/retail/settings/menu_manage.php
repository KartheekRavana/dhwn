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
  </head>
  <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
  <body class="skin-blue layout-top-nav">
    <div class="wrapper">
      
       <?php include_once "$D_PATH/settings/include/header.php";?> 
      <!-- Full Width Column -->
      <div class="content-wrapper">
        <div class="container-fluid">
          <!-- Content Header (Page header) -->
          <section class="content-header">
            <h1>
              Settings
              <small></small>
            </h1>
            <ol class="breadcrumb">
              <li><a href="index.php?action=settings&c=settings"><i class="fa fa-dashboard"></i> Home</a></li>
              <li><a href="index.php?action=branch_manage&c=settings"><i class="fa fa-setting"></i> Menu</a></li>
              <li class="active">Manage Menu</li>
            </ol>
          </section>

          <!-- Main content -->
          
          
          
          <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        

        <!-- Main content -->
        <section class="content">
        
        
        
        
     
          <div class="row">
            <!-- left column -->
            <div class="col-md-3">
            <form role="form" onsubmit="return validate()" action="index.php?action=operations/menusave&c=settings" method="POST">
               <input type='hidden' name="session_branch" id="session_branch" value="<?php echo $session_branch?>">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">MAIN MENU CONFIG</h3>
                </div>
                
                  <div class="box-body">              
                    
                    <div class="form-group" id="menu_name_v">
                      <label for="exampleInputCustomerPlace">Menu Name</label>
                      <input type="text" class="form-control" id="menu" name="menu" placeholder="Menu Name" value=''> 
                    </div>
                    <div class="form-group" id="link_v">
                      <label for="exampleInputCustomerPlace">Link</label>
                      <input type="text" class="form-control" id="link" name="link" placeholder="Link" value=''> 
                    </div>                                        
                      <div class="form-group">                  
					<button class="btn btn-block btn-success">Add Menu</button>
				  </div>                                
                    
                  </div><!-- /.box-body -->
              </div><!-- /.box -->
              </form>
            </div><!--/.col (left) -->
            <div class="col-md-3">
            <form role="form" onsubmit="return validate()" action="index.php?action=operations/menusubsave&c=settings" method="POST">
            <input type='hidden' name="session_branch" id="session_branch" value="<?php echo $session_branch?>">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">SUB MENU CONFIG</h3>
                </div>
                
                  <div class="box-body">              
                    
                    <div class="form-group" id="menu_name_v">
                      <label for="exampleInputCustomerPlace">Menu Name</label>
                      <select class="form-control" id="menu" name="menu" placeholder="Menu Name">
                      <option value=""></option>
                      <?php 
                      
                      $data = mysql_query("SELECT menu_id,menu_name FROM menu_main where menu_status='active' and branch_id='$session_branch'");
                      while($info = mysql_fetch_array( $data ))
                      {
                      ?>
                      <option value="<?php echo $info["menu_id"]?>"><?php echo $info["menu_name"]?></option>
                      <?php }?>
                      </select> 
                    </div>
                    <div class="form-group" id="menu_name_v">
                      <label for="exampleInputCustomerPlace">Sub Menu Name</label>
                      <input type="text" class="form-control" id="submenu" name="submenu" placeholder="Menu Name" value=''> 
                    </div>
                    <div class="form-group" id="link_v">
                      <label for="exampleInputCustomerPlace">Link</label>
                      <input type="text" class="form-control" id="link" name="link" placeholder="Link" value=''> 
                    </div>                                        
                      <div class="form-group">                  
					<button class="btn btn-block btn-success">Add Sub Menu</button>
				  </div>                                
                    
                  </div><!-- /.box-body -->
              </div><!-- /.box -->
              </form>
            </div>
            <!-- right column -->
            
            <div class="col-xs-6">
             

              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Items List</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                     
                                        <th>Menu Name</th>
                                        <th>Submenu</th>
                                       
                                        
                                        <th class="actions" style="width: 100px">Actions</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                                   
                       $data = mysql_query("SELECT menu_id,menu_name,menu_link,menu_status FROM menu_main where menu_status='active' and branch_id='$session_branch'");
                      while($info = mysql_fetch_array( $data ))
                      {
                      	$status=$info["menu_status"];
                      	$menu_link=$info["menu_link"];
                                  ?>
                                    <tr>
                                     
                                        <td><?php echo $info['menu_name']?></td>
                                        <td>
                                         <?php if($menu_link=="#"){?>
                                         <table class="table table-bordered table-striped">
                                        <tr><th>Sub&nbsp;Menu</th></tr>
                                        <?php   $data1 = mysql_query("SELECT submenu_id,submenu_name FROM menu_sub where menu_id='".$info["menu_id"]."' and branch_id='$session_branch'");
                      while($info1 = mysql_fetch_array( $data1 ))
                      {
                             ?>
                             <tr><td><?php echo $info1['submenu_name']?></td></tr>
                             <?php }?>
                                        </table>
                                        <?php }?>
                                        </td>
                                        
                                        <td><span class="label <?php echo $status?>"><a href="#" class="memberStatus"><?php echo $status?></a></span></td>
                                        <td><a href='alter.php?e_id=<?php echo $info['branch_id']?>' title='Update <?php echo $info['branch_name']?> Details'><span class="label label-warning">Edit</span></a>
                                        <?php if($status=='active'){?>
                                        <a href='operations/ban.php?e_id=<?php echo $info['branch_id']?>'><span class="label label-danger" title="Ban <?php echo $info['branch_name']?>">Delete</span></a>
                                    	<?php }else if($status=='banned'){?>
                                    	<a href='operations/active.php?e_id=<?php echo $info['branch_id']?>'><span class="label label-primary"><i class="icon-ok delete" title="Activate <?php echo $info['branch_name']?>"></i></span></a>
                                    	<?php }?>
                                    </td></tr>
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
