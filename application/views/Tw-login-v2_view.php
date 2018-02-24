<!DOCTYPE html>
<html lang="en">
<head>
  <title>SISNAKER - ATASE</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--===============================================================================================-->
  <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
  <!--===============================================================================================-->
  <link href="<?php echo base_url('assets/vendors/bootstrap/dist/css/bootstrap.min.css'); ?>" rel="stylesheet">
  <!--===============================================================================================-->
  <link href="<?php echo base_url('assets/vendors/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet">
  <!--===============================================================================================-->
  <link href="<?php echo base_url('assets/vendors/animate/animate.css" rel="stylesheet'); ?>" rel="stylesheet">
  <!--===============================================================================================-->
  <link href="<?php echo base_url('assets/vendors/css-hamburgers/hamburgers.min.css" rel="stylesheet'); ?>" rel="stylesheet">
  <!--===============================================================================================-->
  <link href="<?php echo base_url('assets/css/select/select2.min.css'); ?>" rel="stylesheet">
  <!--===============================================================================================-->
  <link href="<?php echo base_url('assets/css/login-tw/util.css'); ?>" rel="stylesheet">
  <link href="<?php echo base_url('assets/css/login-tw/main.css'); ?>" rel="stylesheet">
  <!--===============================================================================================-->

  <style>
  .tooltip {
    position: relative;
    display: inline-block;
    border-bottom: 1px dotted black;
  }

  .tooltip .tooltiptext {
    visibility: hidden;
    width: 120px;
    background-color: black;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 5px 0;

    /* Position the tooltip */
    position: absolute;
    z-index: 1;
  }

  .tooltip:hover .tooltiptext {
    visibility: visible;
  }
</style>

</head>
<body>

  <div class="limiter">
    <div class="container-login100">
      <div class="wrap-login100">
        <div class="login100-pic text-center" >
          <img class="js-tilt"style="width: 65%; margin-top:30px;" src=" <?php echo base_url('assets/images/garuda.png'); ?> " alt="IMG" data-tilt>

          <div class="p-t-80">
            <div class="col-md-12">
              <div class="col-md-6">
                <a href="<?php echo base_url() ?>Login/Daftar"> <i class="fa fa fa-user-plus fa-2x" title="For New Agency, click to apply for user name "></i> <br> New Agency</a>

              </div>
              <div class="col-md-6">
                <a href="<?php echo base_url() ?>uploads/online_atnaker_manual.pdf"> <i class="fa fa fa-book fa-2x" title="For tutorial, please download this document"></i> <br> User Manual</a>
              </div>

            </div>
          </div>

        </div>

        <div class="login100-form validate-form">
          <span class="login100-form-title">
            <!-- Indonesian Economic and Trade Office to Taipei -->
            <!-- <img style="width: 25%; margin-top: -70px; margin-bottom:20px;" src=" <?php echo base_url('assets/images/online_atnaker.png'); ?> " alt="IMG"> -->
            <br>
            <b>INDONESIAN ECONOMIC AND TRADE OFFICE TO TAIPEI</b>
          </span>

          <?php if(validation_errors()) {?>
            <div class="row">
              <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="fa fa-warning"></i> Warning!</h4>
                <?php echo validation_errors()?>
              </div>
            </div>
          <?php }?>

          <div id="menu_login">
            <div class="container-login100-form-btn">
              <a href="#" id="endorsement" class="login100-form-btn toform">
                Endorsement
              </a>
            </div>

            <!-- <div class="container-login100-form-btn">
            <a href="<?php //echo ('http://tw-reentry.atnaker.kemnaker.go.id') ?>" id="endorsement" class="login100-form-btn">
            Reentry Direct Hiring
          </a>
        </div> -->

        <div class="container-login100-form-btn">
          <a href="<?php echo ('http://tw-dex.atnaker.kemnaker.go.id') ?>" class="login100-form-btn">
            Direct Extension Hiring
          </a>
        </div>

        <div class="container-login100-form-btn">
          <a href="#" id="simpati" class="login100-form-btn toform">
            SIMPATI (Perlindungan)
          </a>
        </div>
      </div>

      <?php echo form_open(base_url('login/tw'))?>
      <form method="post">
        <div id="form_login" style="display:none">



          <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
            <input class="input100 form-control" type="text" name="username" placeholder="Username">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
              <i class="fa fa-user" aria-hidden="true"></i>
            </span>
          </div>

          <div class="wrap-input100 validate-input" data-validate = "Password is required">
            <input class="input100 form-control" type="password" name="password" placeholder="Password">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
              <i class="fa fa-lock" aria-hidden="true"></i>
            </span>
          </div>

          <div class="col-md-3">
            <div class="container-login100-form-btn">
              <a class="login100-form-btn" value="Back" id="backbtn">
                Back
              </a>
            </div>
          </div>
          <div class="col-md-9">

            <div class="container-login100-form-btn">
              <button class="login100-form-btn" value="Login" type="submit" name="button">
                Login
              </button>
            </div>

          </div>





        </div>



      </form>


    </div>
  </div>
</div>
</div>




<!--===============================================================================================-->
<script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
<!--===============================================================================================-->
<script src="<?php echo base_url('assets/vendors/popper/popper.js'); ?>"></script>
<script src="<?php echo base_url('assets/vendors/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
<!--===============================================================================================-->
<script src="<?php echo base_url('assets/vendors/select2/dist/js/select2.min.js'); ?>"></script>

<!--===============================================================================================-->
<script src="<?php echo base_url('assets/vendors/tilt/tilt.jquery.min.js'); ?>"></script>
<script >


$(document).ready(function() {

  $('.toform').on('click', function(){
    $("#menu_login").hide(1000);
    $("#form_login").show(1000);

  });

  $('#backbtn').on('click', function(){
    $("#menu_login").show(1000);
    $("#form_login").hide(1000);

  });

});

$('.js-tilt').tilt({
  scale: 1.1
})

</script>
<!--===============================================================================================-->
<script src="<?php echo base_url('assets/js/tw-login/main.js'); ?>"></script>

</body>
</html>
