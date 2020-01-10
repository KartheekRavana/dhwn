<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <?php include_once "$D_PATH/include/title.php";?>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="<?php echo $UI_ELEMENTS?>bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="<?php echo $UI_ELEMENTS?>bootstrap/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo $UI_ELEMENTS?>dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="<?php echo $UI_ELEMENTS?>plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
     <!-- -----------------------------------------NOTIFY------------------------------------- -->
<!-- <script src="<?php echo $UI_ELEMENTS?>notify/jquery-1.7.2.min.js"></script> --> 
<script src="<?php echo $UI_ELEMENTS?>notify/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="<?php echo $UI_ELEMENTS?>notify/jquery.noty.js"></script>
<script type="text/javascript" src="<?php echo $UI_ELEMENTS?>notify/layouts/topCenter.js"></script>
<script type="text/javascript" src="<?php echo $UI_ELEMENTS?>notify/themes/default.js"></script>
<script src="<?php echo $UI_ELEMENTS?>notify/call-me-for-status.js"></script>
<!-- -----------------------------------------END NOTIFY------------------------------------- -->



<?php if(isset($_GET["status"])){?>
<input type="hidden" id="status" value="<?php echo $_GET["status"]?>">
<script type="text/javascript">
callme(document.getElementById("status").value);
</script>
<?php }?>
  </head>
  <body class="login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="index.php"><b>DHW</b>BELLARY</a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <form action="?action=check&c=login" method="post">
          <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="User Name" name='username'/>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Password" name="password"/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">    
              <div class="checkbox icheck">
             <!--    <label>
                  <input type="checkbox"> Remember Me
                </label> -->
              </div>                        
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div><!-- /.col -->
          </div>
        </form>

        

        <a href="index.php?action=forgot&c=login">I forgot my password</a><br>
       
<a href="https://chrome.google.com/webstore/detail/auto-history-wipe/hdgnienkeomlaeeojaibeicglpoaadnj?utm_source=gmail" target="blank">Delete History Automatically</a>
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.3 -->
    
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo $UI_ELEMENTS?>bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="<?php echo $UI_ELEMENTS?>plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
</html>