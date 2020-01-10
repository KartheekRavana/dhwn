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
    
    <script type="text/javascript">
		function validate()
		{			
			var state="1";
			if($("#supplier_name").val()==""){$("#supplier_name_v").addClass('has-error');state="2";}
			if($("#address").val()==""){$("#address_v").addClass('has-error');state="2";}
			if($("#supplier_place").val()==""){$("#supplier_place_v").addClass('has-error');state="2";}
			if($("#state").val()==""){$("#state_v").addClass('has-error');state="2";}
			if($("#phone1").val()==""){$("#phone1_v").addClass('has-error');state="2";}
			
			if($("#balance").val()==""){$("#balance_v").addClass('has-error');state="2";}
			if($("#branch").val()==""){$("#branch_v").addClass('has-error');state="2";}
			if(state==2){return false;}
		}
		
        </script>
    
           <!-- -----------------------------------------NOTIFY------------------------------------- 
<script src="<?php echo $UI_ELEMENTS?>notify/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="<?php echo $UI_ELEMENTS?>notify/jquery.noty.js"></script>
<script type="text/javascript" src="<?php echo $UI_ELEMENTS?>notify/layouts/topCenter.js"></script>
<script type="text/javascript" src="<?php echo $UI_ELEMENTS?>notify/themes/default.js"></script>
<script src="<?php echo $UI_ELEMENTS?>notify/call-me-for-status.js"></script>
<!-- -----------------------------------------END NOTIFY------------------------------------- -->
    
  </head>
  <body class="skin-red fixed" onload="callme('success//hello')">
    <div class="wrapper">
      
      <?php include_once "$D_PATH/include/header.php";?> 
      <!-- Left side column. contains the logo and sidebar -->
       <?php include_once "$D_PATH/include/side.php";?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
             Add New Items
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php?action=index&c=dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="index.php?action=new&c=items">Items</a></li>
            <li class="active">Alter Item</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
        <?php 
        $i_id=$_GET['i_id'];
        $sql=mysql_query("select item_id, category, item_name from items where item_id='$i_id' ");
        while($info=mysql_fetch_array($sql))
        {
        	$category=$info["category"];
        	$item_name=$info["item_name"];
        }
        ?>
        
        <form role="form" onsubmit="return validate()" action="index.php?action=operations/items_update&c=items" method="POST">
        <input type="hidden" name="i_id" id="i_id" value="<?php echo $i_id?>" >
          <div class="row">
            <!-- left column -->
            <div class="col-md-4">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Item Details</h3>
                </div>
               
                  <div class="box-body">
                    <div class="form-group" id='branch_v'>
                      <label>Category</label>
                      <select class="form-control" name='Category' id='Category'>
                      <?php $category_name="";
                      $data = mysql_query("SELECT category_id, category_name, category_status, branch from category where category_id='$category' and branch='$session_branch'");
                      while($info = mysql_fetch_array( $data ))
                      {
                      	$category_name=$info["category_name"];
                      }
                      ?>
                        <option value="<?php echo $category?>"><?php echo $category_name?></option>
                         <?php            
                       $data = mysql_query("SELECT category_id, category_name, category_status, branch from category where category_status='active' and branch='$session_branch'");
                     while($info = mysql_fetch_array( $data ))
                     {?>	            
	               <option value='<?php echo $info['category_id']?>'><?php echo $info['category_name']?></option>
	                    <?php }?>   
                        
                      </select>
                    </div>
                    
                    
                    <div class="form-group" id="date_v">
                      <label for="exampleInputCustomerPlace">Item Name</label>
                      <input type="text" class="form-control" id="item_name" name="item_name" placeholder="Expense Name" value='<?php echo $item_name?>'> 
                    </div>
                    
                      <div class="form-group">                  
					<button class="btn btn-block btn-success">UPDATE</button>
				  </div>             
                    
                    
                  </div><!-- /.box-body -->

                
            
              </div><!-- /.box -->

             

              
              

            </div><!--/.col (left) -->
            <!-- right column -->
            
            
            
            
            
            
            
            
            
            <!--/.col (right) -->
          </div>   <!-- /.row -->
          </form>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <?php include_once "$D_PATH/include/footer.php";?>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.3 -->
    <script src="<?php echo $UI_ELEMENTS?>plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo $UI_ELEMENTS?>bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- DATA TABES SCRIPT -->
    <script src="<?php echo $UI_ELEMENTS?>plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="<?php echo $UI_ELEMENTS?>plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    <!-- SlimScroll -->
    <script src="<?php echo $UI_ELEMENTS?>plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='<?php echo $UI_ELEMENTS?>plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="<?php echo $UI_ELEMENTS?>dist/js/app.min.js" type="text/javascript"></script>
    <!-- AdminLTE for demo purposes -->
    <?php include_once "$D_PATH/include/scripts_bottom.php";?>
    <!-- page script -->
    <script type="text/javascript">
      $(function () {
        $("#example1").dataTable();
        $('#example2').dataTable({
          "bPaginate": true,
          "bLengthChange": false,
          "bFilter": false,
          "bSort": true,
          "bInfo": true,
          "bAutoWidth": false
        });
      });
    </script>
  </body>
</html>
