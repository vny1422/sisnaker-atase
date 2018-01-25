<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">

  <!-- Bootstrap -->
  <link href="<?php echo base_url('assets/vendors/bootstrap/dist/css/bootstrap.min.css'); ?>" rel="stylesheet">
  <link href="<?php echo base_url('assets/vendors/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet">

  <!-- jQuery -->
  <script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>

  <style>
  .kiri{
    background-color: #015249;
    height: 768px;
    width: 50%;
    padding-top: 10%;
  }

  .kanan{
    background-color: white;
    height: 768px;
    width: 50%;
    padding-top: 20%;
  }

  .logo{
    width: 35%;
  }

  .text-white{
    color: white;
    font-family: Calibri, Georgia, Serif;
  }

  .text-black{
    color: black;
    font-family: Calibri, Georgia, Serif;
  }

  .container { white-space: nowrap; }
  .column { display: inline-block; width: 100%; white-space: normal; }

  a{
    color: black;
  }

  a:hover{
    color : #7e7e7e;
  }

  .tombol{
    margin-top: 5%;
  }
  </style>

  <title>SISNAKER - ATASE</title>
</head>
<body>



  <div class="row text-white">
    <div class="col-md-6 kiri text-center">
      <div id="sec-bg-2" class="content">
        <img style="text-align:center;" class="logo" src="<?php echo base_url('assets/images/garuda.png'); ?>">


        <div class="control-label form-gorup">
          <div class="col-md-3">

          </div>
          <div id="sec1" class="col-md-6">

            <h3 id="dkdtai"><b>Indonesian Economic and Trade Office to Taipei</b></h3>

            <br><br><br><br>
            <img style="text-align:center; width:20%" src="<?php echo base_url('assets/images/logo_kemnaker_white.png'); ?>">
            <h4 class=""><b>ONLINE - ATNAKER</b></h4>
          </div>



          <div class="col-md-3">
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-6 kanan text-black">
      <?php if(validation_errors()) {?>
        <div class="row">
          <div class="col-md-2">

          </div>
          <div class="col-lg-8" style="margin-top:-100px;">
            <div class="alert alert-danger alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4><i class="fa fa-warning"></i> Warning!</h4>
              <?php echo validation_errors()?>
            </div>
          </div>
        </div>
      <?php }?>
      <section class="login_content">
        <div style="padding-top:30px" class="panel-body">

          <?php echo form_open(base_url('login')) ?>
          <form id="loginform" method="post">
            <div class="col-md-12">
              <div class="col-md-2">

              </div>
              <div class="col-md-8">
                <div class="col-md-12">
                  <input type="text" name="username" class="form-control" placeholder="Username" required="" /> </br>
                  <input type="password" name="password" class="form-control" placeholder="Password" required="" />
                </br>
                <button class="btn btn-success submit pull-right" value="Login" type="submit" name="button">LOGIN</button>


                <br><br>


              </div>



              <div class="col-md-12">
                <h3> <b>ONLINE SERVICES</b></h3>
                <a href="tw-reentry.atnaker.kemnaker.go.id" title="Reentry Direct Hiring (Dengan Pulang)"><i class="fa fa-plane"> <b>Re-Entry</b> Direct Hiring (Dengan Pulang)</i> </a>
                <br>
                <a href="tw-dex.atnaker.kemnaker.go.id" title="Direct Extension Hiring (Tanpa Pulang)"><i class="fa fa-refresh"> <b>Direct Extension</b> Hiring (Tanpa Pulang)</i></a>

              </div>


              <div class="col-md-12">
                <h3> <b>OTHER SERVICES</b></h3>
                <a href="<?php echo base_url() ?>Login/Daftar" title="For Agency, click to apply for user name"><i class="fa fa-sign-in">     For Agency, click to apply for user name</i></a>
                <br>
                <a href="<?php echo base_url() ?>uploads/SISNAKER_MANUAL.pdf" title="For tutorial, please download this document"><i class="fa fa-info">         For tutorial, please download this document</i></a>

                <!-- <h5 id="daftar"> <a href="<?php //echo base_url() ?>Login/Daftar">For Agency, click to apply for user name</a></h5> -->
              </div>


            </div>
            <div class="col-md-2">

            </div>
          </div>
        </form>
      </div>
    </section>
  </div>

</div>

</body>
</html>
