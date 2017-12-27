<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Agency Registration</title>



    <!-- Bootstrap -->
    <link href="<?php echo base_url('assets/vendors/bootstrap/dist/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url('assets/vendors/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url('assets/vendors/nprogress/nprogress.css" rel="stylesheet'); ?>" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?php echo base_url('assets/css/icheck/flat/green.css'); ?>" rel="stylesheet" />
    <!-- bootstrap-wysiwyg -->
    <link href="<?php echo base_url('assets/vendors/google-code-prettify/bin/prettify.min.css'); ?>" rel="stylesheet">
    <!-- Select2 -->
    <link href=" <?php echo base_url('assets/vendors/select2/dist/css/select2.min.css'); ?>" rel="stylesheet">
    <!-- Switchery -->
    <link href=" <?php echo base_url('assets/vendors/switchery/dist/switchery.min.css')?>" rel="stylesheet">
    <!-- starrr -->
    <link href=" <?php echo base_url('assets/vendors/starrr/dist/starrr.css'); ?>" rel="stylesheet" >
    <!-- Custom Theme Style -->
    <link href="<?php echo base_url('assets/build/css/customku.css');?>" rel="stylesheet">
  </head>


  <body class="login">
    <div class="container body">
      <div class="login-wrapper">
        <div class="col-md-12 left_col">

        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu" style="float: ">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class=""></i></a>

              </div>

              <ul class="nav navbar-nav navbar-right">

              <a href="<?php echo base_url()?>"><img style="margin-top: 10px; padding-bottom: 10px; margin-left: 120px;" src=" <?php echo base_url() ?>assets/images/sisnaker_tag_logo2.png"></a>

              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
           		<div class="col-md-3"></div>
              <div class="text-center title_left">

                <h3>USER REGISTRATION</h3>
                <p>For Indonesia Agency (PPTKIS), please use SISKOTKLN BNP2TKI in Indonesia. Both Endorsement v2 KDEI and SISKOTKLN BNP2TKI are connected to each other.</p>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-8 col-sm-12 col-xs-12 col-md-offset-2">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Registration Form</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <?php
                    if (validation_errors() != "") {
                        echo "<div class=\"well well-sm\">";
                        echo validation_errors();
                        echo "</div>";
                    }
                    ?>
                    <?php if($this->session->flashdata('information') != ""): ?>
                    <?php echo '<div class="container">
                      <div class="alert alert-success fade in">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        '.$this->session->flashdata('information').'
                      </div>
                    </div>' ?>
                  <?php endif; ?>
                    <form enctype="multipart/form-data" action="<?php echo base_url(); ?>Login/daftar" method="post" class="form-horizontal form-label-left">
                      <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12">Institution <span class="required">*</span></label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <select name="institution" required="required" class="select2_single form-control" tabindex="-1">
                              <option></option>
                              <?php foreach($institution as $row): ?>
                                  <?php if($row->nameinstitution != 'Super'): ?>
                                  <option value="<?php echo $row->idinstitution ?>"><?php echo $row->nameinstitution ?></option>
                                <?php endif; ?>
                              <?php endforeach; ?>
                            </select>
                          </div>
                        </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Official Company Email <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="email" name="agemail" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Agency Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="agnama" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Other Agency Name</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="agnamaoth" name="agnamaot" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">C.L.A Private Employment Service Agency License No.<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="agijincla" class="form-control col-md-7 col-xs-12" type="text" required="required" name="nocla">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Office Address<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="" class="form-control col-md-7 col-xs-12" type="text" name="officealamat" required="required">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Other Office Address</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="middle-name" class="form-control col-md-7 col-xs-12" type="text" name="ot_officealamat">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Authorized Person Name</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="middle-name" class="form-control col-md-7 col-xs-12" type="text" name="authperson">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Other Authorized Person Name</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="middle-name" class="form-control col-md-7 col-xs-12" type="text" name="ot_authperson">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Phone</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="middle-name" class="form-control col-md-7 col-xs-12" type="text" name="phone">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Faximile	</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="middle-name" class="form-control col-md-7 col-xs-12" type="text" name="fax">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Please Upload your C.L.A Private Employment Service Agency License Letter (jpg/png/pdf) :
						</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="filecla" required="required" class="form-control col-md-7 col-xs-12" type="file" name="filecla" accept=".jpg,.png,.pdf">
                        </div>
                      </div>

                      <br>
                      <h2 class="text-center">*After verification finished, we will send username and password to this email
</h2>

                      <div class="ln_solid"></div>

                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button class="btn btn-primary pull-left" type="button">Login</button>
                          <button type="submit" class="pull-right btn btn-success">Submit</button>
						  <button class="pull-right btn btn-primary" type="reset">Reset</button>

                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer style="margin-left: 0">
          <div class="text-center">
          <b>
           SISNAKER-ATASE | Kementerian Ketenagakerjaan Republik Indonesia
            </b>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="../vendors/iCheck/icheck.min.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="../vendors/moment/min/moment.min.js"></script>
    <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap-wysiwyg -->
    <script src="../vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
    <script src="../vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
    <script src="../vendors/google-code-prettify/src/prettify.js"></script>
    <!-- jQuery Tags Input -->
    <script src="../vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
    <!-- Switchery -->
    <script src="../vendors/switchery/dist/switchery.min.js"></script>
    <!-- Select2 -->
    <script src="../vendors/select2/dist/js/select2.full.min.js"></script>
    <!-- Parsley -->
    <script src="../vendors/parsleyjs/dist/parsley.min.js"></script>
    <!-- Autosize -->
    <script src="../vendors/autosize/dist/autosize.min.js"></script>
    <!-- jQuery autocomplete -->
    <script src="../vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
    <!-- starrr -->
    <script src="../vendors/starrr/dist/starrr.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="../build/js/customku.js"></script>

  </body>
</html>
