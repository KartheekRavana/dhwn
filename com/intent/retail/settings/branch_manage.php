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
              <li><a href="index.php?action=branch_manage&c=settings"><i class="fa fa-setting"></i> Branch</a></li>
              <li class="active">Manage Branch</li>
            </ol>
          </section>

          <!-- Main content -->
          
          
          
          <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        

        <!-- Main content -->
        <section class="content">
        
        
        <form role="form" onsubmit="return validate()" action="index.php?action=operations/branchsave&c=settings" method="POST">
        
        <input type='hidden' name="session_branch" id="session_branch" value="<?php echo $session_branch?>">
          <div class="row">
            <!-- left column -->
            <div class="col-md-3">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Item Details</h3>
                </div>
                
                
                <span id="status"><?php if(isset($_GET["status"])){echo $_GET["status"];}?></span>
                  <div class="box-body">
                    
                    
                    <div class="form-group" id="item_name_v">
                      <label for="exampleInputCustomerPlace">Branch Name</label>
                      <input type="text" class="form-control" id="b_name" name="b_name" placeholder="Branch Name" value=''> 
                    </div>
                    <div class="form-group" id="item_name_v">
                      <label for="exampleInputCustomerPlace">Address</label>
                      <input type="text" class="form-control" id="address" name="address" placeholder="Address" value=''> 
                    </div>
                    <div class="form-group" id="item_name_v">
                      <label for="exampleInputCustomerPlace">City</label>
                      <input type="text" class="form-control" id="city" name="city" placeholder="Item Name" value=''> 
                    </div>
                    <div class="form-group" id="item_name_v">
                      <label for="exampleInputCustomerPlace">State</label>
                      <input type="text" class="form-control" id="state" name="state" placeholder="Item Name" value=''> 
                    </div>
                    <div class="form-group" id="item_name_v">
                   
                      <input type="hidden" class="form-control" id="country" name="country" placeholder="Item Name" value=''> 
                    </div>
                    <div class="form-group" id="item_name_v">
                      <label for="exampleInputCustomerPlace">Phone</label>
                      <input type="text" class="form-control" id="phone" name="phone" placeholder="Item Name" value=''> 
                    </div>
                    <div class="form-group" id="item_name_v">
                     
                      <input type="hidden" class="form-control" id="validity" name="validity" placeholder="Item Name" value='0000-00-00'> 
                    </div>
                    <div class="form-group" id="item_name_v">
                      <label for="exampleInputCustomerPlace">Branch Type</label>
                      <select class="form-control" id="branch_type" name="branch_type"> 
                       <option value="Account 2">Account 2</option>
	               <option value="Account 1">Account 1</option>
	               </select>
                    </div>
                    
                      <div class="form-group">                  
					<button class="btn btn-block btn-success">Add Branch</button>
				  </div>             
                    
                    
                  </div><!-- /.box-body -->

                
            
              </div><!-- /.box -->

             

              
              

            </div><!--/.col (left) -->
            <!-- right column -->
            
            
            
            
            <div class="col-xs-9">
             

              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Items List</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                     
                                        <th>Branch Name</th>
                                        <th>Address</th>
                                        <th>City</th>
                                        <th>State</th>
                                      
                                        <th>Phone Number</th>
                                        <th>Validity</th>
                                        <th>Branch Status</th>
                                        
                                        <th class="actions" style="width: 100px">Actions</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                                   
                                  $data = mysql_query("SELECT branch_id,branch_code,branch_name,address,city,state,country,phone,branch_status,validity FROM branch");
                                  if($data)
                                  while($info = mysql_fetch_array( $data ))
                                  {$status=$info['branch_status'];
                                  ?>
                                    <tr>
                                     
                                        <td><a href="#" class="username"><?php echo $info['branch_name']?></a></td>
                                        <td><a href="#" class="registrationDate"><?php echo $info['address']?></a></td>
                                        <td><a href="#" class="memberGroup"><?php echo $info['city']?></a></td>
                                        <td><a href="#" class="memberGroup"><?php echo $info['state']?></a></td>
                                      
                                       <td><a href="#" class="memberGroup"><?php echo $info['phone']?></a></td>
                                        <td><a href="#" class="memberGroup"><?php echo $info['validity']?></a></td>
                                      
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
          </form>
        </section><!-- /.content -->
      </div>
          
          
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
      <?php include_once "$D_PATH/settings/include/footer.php";?>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.3 -->
    <script src="<?php echo $UI_ELEMENTS?>plugins/jQuery/jQuery-2.1.3.min.js"></script>
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
