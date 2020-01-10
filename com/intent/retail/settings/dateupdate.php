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
              Change Date
              <small></small>
            </h1>
            <ol class="breadcrumb">
              <li><a href="index.php?action=settings&c=settings"><i class="fa fa-dashboard"></i> Home</a></li>
              <li><a href="index.php?action=index&c=dashboard"><i class="fa fa-setting"></i> Back</a></li>
              <li class="active">Manage Branch</li>
            </ol>
          </section>

          <!-- Main content -->
          
          
          
          <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        

        <!-- Main content -->
        <section class="content">
          <?php 
                            if(isset($_POST['date']))
                            {
                            	$_SESSION['date1']=$_POST['date'];
                            	$date1=explode("-", $_SESSION['date1']);
                            	$date=$date1[2]."-".$date1[1]."-".$date1[0];
                            	$_SESSION['date']=$_POST['date'];
                            }
                            ?>
        
        <form role="form" onsubmit="return validate()" action="index.php?action=dateupdate&c=settings" method="POST">
        
        <input type='hidden' name="session_branch" id="session_branch" value="<?php echo $session_branch?>">
          <div class="row">
            <!-- left column -->
            <div class="col-md-3">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
              
                </div>
                
                
                <span id="status"><?php if(isset($_GET["status"])){echo $_GET["status"];}?></span>
                  <div class="box-body">
                    
                    
                    <div class="form-group" id="item_name_v">
                      <label for="exampleInputCustomerPlace">Current Date</label>
                      <input type="date" class="form-control" id="b_name" name="b_name" readonly="readonly" placeholder="Branch Name" value='<?php echo $_SESSION['date1']?>'> 
                    </div>
                    <div class="form-group" id="item_name_v">
                      <label for="exampleInputCustomerPlace">New Date</label>
                      <input type="date" class="form-control" id="date" name="date" placeholder="date" value='<?php echo $_SESSION['date1']?>'> 
                    </div>
                 
                      <div class="form-group">                  
					<button class="btn btn-block btn-success">Update Date</button>
				  </div>             
                    
                    
                  </div><!-- /.box-body -->

                
            
              </div><!-- /.box -->

             

              
              

            </div><!--/.col (left) -->
            <!-- right column -->
            
            
            
            
            
            
            
            
            
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
