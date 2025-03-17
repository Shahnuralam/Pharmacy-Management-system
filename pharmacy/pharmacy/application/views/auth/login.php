<!DOCTYPE html>
<html lang="en">
<head>
    <base href="<?php echo base_url();?>">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Rizvi">
    <meta name="keyword" content="Php, Hospital, Clinic, Management, Software, Php, CodeIgniter, pharmacy, Accounting">
    <link rel="shortcut icon" href="uploads/favicon.png">

    <title><?php echo lang('login'); ?> - <?php echo lang('system_title'); ?></title>

    <!-- Bootstrap core CSS -->
    <link href="common/css/bootstrap.min.css" rel="stylesheet">
    <link href="common/css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="common/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="common/css/style.css" rel="stylesheet">
    <link href="common/css/style-responsive.css" rel="stylesheet" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>

  <body class="login-body">

    <div class="container">

      <form class="form-signin" method="post" action="auth/login">
        <h2 class="login form-signin-heading"><?php echo lang('system_title'); ?><br/><br/><img alt="" src="uploads/favicon.png"></h2>
        <div id="infoMessage"><?php echo $message;?></div>
        <div class="login-wrap">
            <input type="text" class="form-control" name="identity" placeholder="<?php echo lang('useremail'); ?>" autofocus>
            <input type="password" class="form-control" name="password" placeholder="<?php echo lang('password'); ?>">
            
            
           
           
           <p><a data-toggle="modal" href="#myModal"> <?php echo lang('forgot_password'); ?></a></p>
      <!--     
            <label class="checkbox">
                <input type="checkbox" value="remember-me"> Remember me
                <span class="pull-right">
                    <a data-toggle="modal" href="#myModal"> Forgot Password?</a>

                </span>
            </label> 
      -->
            <button class="btn btn-lg btn-login btn-block" type="submit"> <?php echo lang('sign_in'); ?></button>
            
          

        </div>

        

      </form>

    </div>
      
      
      
      
      
      
      
        
        
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <form method="post" action="auth/forgot_password">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title"><?php echo lang('forgot_password'); ?></h4>
                            </div>

                              <div class="modal-body">
                                  <p><?php echo lang('reset_message');?></p>
                                  <input type="text" name="email" placeholder="<?php echo lang('email');?>" autocomplete="off" class="form-control placeholder-no-fix">

                              </div>
                              <div class="modal-footer">
                                  <button data-dismiss="modal" class="btn btn-default" type="button"><?php echo lang('cancel');?></button>
                                  <input class="btn btn-success" type="submit" name="submit" value="submit">
                              </div>
                      </form>
                  </div>
              </div>
          </div>
          


    <!-- js placed at the end of the document so the pages load faster -->
    <script src="common/js/jquery.js"></script>
    <script src="common/js/bootstrap.min.js"></script>


  </body>
</html>
