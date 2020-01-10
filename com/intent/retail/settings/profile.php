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
			if($("#employee_name").val()==""){$("#employee_name_v").addClass('has-error');state="2";}
			if($("#phone").val()==""){$("#phone_v").addClass('has-error');state="2";}
			
			
			if($("#salary").val()==""){$("#salary_v").addClass('has-error');state="2";}
			if($("#branch").val()==""){$("#branch_v").addClass('has-error');state="2";}
			if(state==2){return false;}
		}
		
        </script>
    
    
    
     
    
  </head>
  <body class="skin-blue fixed">
    <div class="wrapper">
      
      <?php include_once "$D_PATH/include/header.php";?> 
      <!-- Left side column. contains the logo and sidebar -->
       <?php include_once "$D_PATH/include/side.php";?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Update Profile
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
            <div class="col-md-4">
            <form role="form" onsubmit="return validate()" action="index.php?action=operations/profile_update&c=settings" method="POST">
           <input type="hidden" name="c_id" value="<?php echo $session_id?>">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Employee Details</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php 
                $c_id=$session_id;
                $data = mysql_query("SELECT employee_id,employee_no,employee_name,nick_name,phone,salary,doj,branch,employee_status FROM employee where employee_id=$c_id");
                while($info = mysql_fetch_array( $data ))
                {
                	$employee_name=$info["employee_name"];
                	$phone=$info["phone"];
                	$salary=$info["salary"];
                	$doj=$info["doj"];
                
                	$branch=$info["branch"];
                
                
                	
                ?>
                  <div class="box-body">
                    <div class="form-group" id='employee_name_v'>
                      <label for="exampleInputFullName">Full Name</label>
                      <input type="text" class="form-control" id="employee_name" name="employee_name" value="<?php echo $info["employee_name"]?>" placeholder="">
                    </div>
                    <div class="form-group" id="phone_v" >
                      <label>Phone </label>
                      <input type="text" class="form-control onlyNumbers" id="phone" name="phone" value="<?php echo $info["phone"]?>" placeholder="must be a number">
                    </div>
                    <div class="form-group" id="salary_v" >
                      <label>Salary</label>
                      <input type="text" class="form-control numbersDecimals" id="salary" name="salary" value="<?php echo $info["salary"]?>" placeholder="must be a number">
                    </div>
                    <div class="form-group">
                      <label>Joining Date</label>
                      <input type="date" class="form-control" id="joining_date" name="joining_date" value="<?php echo $info["doj"]?>" placeholder="">
                    </div>
                    
                    <div class="form-group" id="branch_v">
                      <label>Branch</label>
                      <select class="form-control" id="branch" name="branch">
                         <?php 
                                
                            if($session_id=="3")
                    {
                    	$data = mysql_query("SELECT branch_id,branch_name from branch where branch_status='active'");
                    } 
                    else {

                                  $data = mysql_query("SELECT branch_id,branch_name from branch where branch_status='active' and branch_id='$session_branch'");
						}
                                  while($info = mysql_fetch_array( $data ))
                                  {
                                  ?>
	            
	               <option value='<?php echo $info['branch_id']?>'><?php echo $info['branch_name']?></option>
	                    <?php }?>
                        
                      </select>
                    </div>
                   
				  <div class="form-group">                  
					<button class="btn btn-block btn-success">Update Employee</button>
				  </div>   
                        
                      
                    
                  </div>
                  
                  
                  
                  
                  
                  <!-- /.box-body -->
 <?php }?>
                  
                
              </div><!-- /.box -->
          </form>
            </div>
            
            
            
            <div class="col-md-4">
              <form action="index.php?action=operations/profilepic_upload&c=settings" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="c_id" value="<?php echo $session_id?>">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Employee Profile Pic</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php 
                $c_id=$session_id;
                $data = mysql_query("SELECT employee_id,employee_no,employee_name,nick_name,phone,salary,doj,branch,employee_status FROM employee where employee_id=$c_id");
                while($info = mysql_fetch_array( $data ))
                {
                	$employee_name=$info["employee_name"];
                	$phone=$info["phone"];
                	$salary=$info["salary"];
                	$doj=$info["doj"];
                
                	$branch=$info["branch"];
                
                
                	
                ?>
                  <div class="box-body">
                    <img src="<?php echo $D_PATH?>/employee/uploads/profilepics/<?php echo $profile_pic?>" width="150px">
                    
                    <div class="form-group" id="employee_type_v">
                      <label>Employee Profile Pic</label>
                     <input type="file" class="form-control" name="file">
                      </div>
                    
                    
                    
                    
                   
				  <div class="form-group">                  
					<button class="btn btn-block btn-success">Update Profile Pic</button>
				  </div>   
                        
                      
                    
                  </div>
                  
                  
                  
                  
                  
                  <!-- /.box-body -->
 <?php }?>
                  
                
              </div><!-- /.box -->
        
                  
                </form>
                       
          
             
              

            </div>
            
            
            
            
            
            
            <!--/.col (left) -->
            <!-- right column -->
            
          </div>   <!-- /.row -->
          
                
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <?php include_once "$D_PATH/include/footer.php";?>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.3 -->
    <script src="<?php echo $UI_ELEMENTS?>plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo $UI_ELEMENTS?>bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='<?php echo $UI_ELEMENTS?>plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="<?php echo $UI_ELEMENTS?>dist/js/app.min.js" type="text/javascript"></script>
    <!-- AdminLTE for demo purposes -->
    <?php include_once "$D_PATH/include/scripts_bottom.php";?>
  </body>
</html>
