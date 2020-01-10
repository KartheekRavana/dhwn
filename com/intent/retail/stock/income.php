<?php include_once "$D_PATH/include/session.php";?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
         <?php include_once "$D_PATH/include/title.php";?>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="<?php echo $UI_ELEMENTS?>bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="<?php echo $UI_ELEMENTS?>plugins/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="<?php echo $UI_ELEMENTS?>bootstrap/css/ionicons.min.css" rel="stylesheet" type="text/css" />    
    <!-- Theme style -->
    <link href="<?php echo $UI_ELEMENTS?>dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="<?php echo $UI_ELEMENTS?>dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    
  
           <!-- -----------------------------------------NOTIFY------------------------------------- 
<script src="<?php echo $UI_ELEMENTS?>notify/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="<?php echo $UI_ELEMENTS?>notify/jquery.noty.js"></script>
<script type="text/javascript" src="<?php echo $UI_ELEMENTS?>notify/layouts/topCenter.js"></script>
<script type="text/javascript" src="<?php echo $UI_ELEMENTS?>notify/themes/default.js"></script>
<script src="<?php echo $UI_ELEMENTS?>notify/call-me-for-status.js"></script>
<!-- -----------------------------------------END NOTIFY------------------------------------- -->
    
          <!--    select  -->  
  <link rel="stylesheet" href="<?php echo $UI_ELEMENTS?>select/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo $UI_ELEMENTS?>select/css/bootstrap-select.css">
  <script src="<?php echo $UI_ELEMENTS?>select/js/bootstrap.min.js"></script>
  <script src="<?php echo $UI_ELEMENTS?>select/js/bootstrap-select.js"></script>
<!--    select  -->
  
  </head>
  <body class="<?php echo $body_style?>">
    <div class="wrapper">
      
      
      
      
      <?php include_once "$D_PATH/include/header.php";?> 
      <!-- Left side column. contains the logo and sidebar -->
       <?php include_once "$D_PATH/include/side.php";?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
             Add New Income
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php?action=index&c=dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Stock</a></li>
            <li class="active">Income</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
        
        
       
          <div class="row">
            <!-- left column -->
            <div class="col-md-4">
             <form role="form" onsubmit="return validate()" action="index.php?action=operations/income_save&c=stock" method="POST">
        <input type='hidden' name="session_branch" id="session_branch" value="<?php echo $session_branch?>">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Income Details</h3>
                </div>
                
                
                
                  <div class="box-body">
                    
                    
                    <div class="form-group" id="exp_amount_v">
                      <label for="exampleInputCustomerPlace">Amount</label>
                      <input type="text" class="form-control numbersDecimals" id="exp_amount" name="exp_amount" placeholder="Income Amount"> 
                    </div>
                    <div class="form-group" id="date_v">
                      <label for="exampleInputCustomerPlace">Date</label>
                      <input type="date" class="form-control" id="date" name="date" placeholder="Expense Date" value='<?php echo $date?>'> 
                    </div>
                    <div class="form-group" id="exp_note_v">
                      <label>Note</label>
                      <textarea class="form-control" rows="3" placeholder="" id="exp_note" name="exp_note"></textarea>
                    </div>
                      <div class="form-group">                  
					<button class="btn btn-block btn-success">Add Income</button>
				  </div>             
                    
                    
                  </div><!-- /.box-body -->

                
            
              </div><!-- /.box -->
 </form>
             </div>
             
              
             

           
            <!-- right column -->
            
            
            
            
            <div class="col-xs-8">
             

              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Income Details</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Date</th> 
                        <th>Amount</th>                      
                        <th>Note</th>
                        <th>Action</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                       <?php        
                       $lug=0;
                       $ham=0;
                     
		                   
                                  $data = mysql_query("SELECT sk_tran_id,credit,tran_date,note FROM txn_transaction where tran_type='Income' and credit>0");
                                  while($info = mysql_fetch_array( $data ))
                                  {       
                                  	                       	
                                  ?>
                      <tr>
								
									<td><?php echo $info['tran_date']?></td>						
									<td><?php echo $info['credit']?></td>		
									<td><?php echo $info['note']?></td>
									<td><a href="index.php?action=income_edit&c=stock&tran_id=<?php echo $info['sk_tran_id']?>">Edit</a></td>
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
      </div><!-- /.content-wrapper -->
      <?php include_once "$D_PATH/include/footer.php";?>

  <!-- Control Sidebar -->
 <?php include_once "$D_PATH/include/side_container.php";?> 
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<?php include_once "$D_PATH/include/scripts_bottom.php";?> 
</body>
</html>
      

