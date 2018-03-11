<!DOCTYPE html>
<html lang="en">
  <head>
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/sisnaker_logo.png'); ?>">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SISNAKER</title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url('assets/vendors/bootstrap/dist/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url('assets/vendors/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url('assets/vendors/nprogress/nprogress.css" rel="stylesheet'); ?>" rel="stylesheet">
    <!-- jQuery custom content scroller -->
    <link href="<?php echo base_url('assets/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css'); ?>" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url('assets/build/css/custom.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/custom.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/mycss.css'); ?>" rel="stylesheet">
    <link href="<?php echo assets_url() ?>css/jquery.notifyBar.css" rel="stylesheet" type="text/css">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">

        <div class="animate form login_form">
          <section class="login_content">
            <div style="padding-top:30px" class="panel-body">
              <?php if(validation_errors()) {?>
                <div class="row">
                  <div class="col-lg-12">
                    <div class="alert alert-danger alert-dismissable">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <h4><i class="fa fa-warning"></i> Warning!</h4>
                      <?php echo validation_errors()?>
                    </div>
                  </div>
                </div>
                <?php }?>
                <?php echo form_open(base_url('login')) ?>
                <form id="loginform" method="post">
                  <h3>
                    <img style="text-align:center;" src="<?php echo base_url('assets/images/sisnaker-white.png'); ?>">
                  </h3>
                </br>
                <div>
                  <input type="text" name="username" class="form-control" placeholder="Username" required="" />
                </div>
                <div>
                  <input type="password" name="password" class="form-control" placeholder="Password" required="" />
                </div>
                <div>
                    <button class="btn btn-success submit" value="Login" type="submit" name="button">LOGIN</button>
                </div>
                <h6 style="color:white;">If your Agency is not registered yet, CLICK <a href="<?php echo base_url() ?>/Login/Daftar">HERE</a></h6>
                <div class="clearfix"></div>

                <div class="separator">
                  <div class="clearfix"></div>
                  <br />

                  <div>

                    <h6 style="color:white;">©2016 All Rights Reserved</h6>
                  </div>
                </div>
              </form>
            </div>
          </section>
        </div>
    </div>

    <script src="<?php echo assets_url() ?>js/jquery.min.js"></script>
    <script src="<?php echo assets_url() ?>js/jquery.notifyBar.js"></script>
    <script src="<?php echo assets_url() ?>js/bowser.min.js"></script>
    <script src="<?php echo assets_url() ?>js/bootstrap.min.js"></script>
    <script src="<?php echo assets_url() ?>js/jqBootstrapValidation.js"></script>

    <script type="text/javascript">
    	function doAuthCC() {
            $("#formAuthCC").submit();
        }

    	//var url = 'http://unsplash.com/rss';
    	if (bowser.msie || bowser.msedge) {
    		var inlinehtml= "<span class='blacktext'>"+
    						"Mohon gunakan <a href='https://www.mozilla.org/en-US/firefox/new/'>Mozilla Firefox</a>"+
    						" atau <a href='https://www.google.com/chrome/browser/desktop/index.html'>Google Chrome</a>"+
    						" untuk fungsionalitas penuh" +
    						"</span>";
    		$.notifyBar({
    			cssClass: "warning",
    			html: inlinehtml,
    			close: true,
    			delay: 1000000,
    			closeOnClick: false
    		});
    	}
    </script>
  </body>
</html>
