<!DOCTYPE html>
<html lang="en">
  <head>
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/sisnaker_logo.png'); ?>">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo $title ?> | SISNAKER-ATASE</title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url('assets/vendors/bootstrap/dist/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <!-- DataTables -->
    <link href="<?php echo base_url('assets/css/datatables/css/dataTables.bootstrap.css'); ?>" rel="stylesheet">
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

    <!-- chart CSS -->
    <link href="<?php echo base_url('assets/css/angular-chart.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/normalize.css') ?>" rel="stylesheet">

    <!-- Select CSS -->
    <link href="<?php echo base_url('assets/css/bootstrap-select.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/select/select2.min.css'); ?>" rel="stylesheet">

    <!-- My CSS -->
    <link href="<?php echo base_url('assets/css/modal.css') ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('assets/css/alertify.css') ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('assets/css/ngDialog.min.css')?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('assets/css/ngDialog-theme-default.min.css')?>" rel="stylesheet" type="text/css">

    <!-- Check box -->
    <link href="<?php echo base_url('assets/css/build.less.css') ?>" rel="stylesheet" type="text/css">

    <!-- Custom styling plus plugins -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/maps/jquery-jvectormap-2.0.3.css'); ?>" />
    <link href="<?php echo base_url('assets/css/icheck/flat/green.css'); ?>" rel="stylesheet" />
    <link href="<?php echo base_url('assets/css/floatexamples.css'); ?>" rel="stylesheet" type="text/css" />

    <!-- Slider -->
    <link href="<?php echo base_url('assets/css/bootstrap-slider.min.css'); ?>" rel="stylesheet">

    <!-- Datepicker -->
    <link href="<?php echo base_url('assets/css/datepicker/bootstrap-datepicker.css'); ?>" rel="stylesheet">
    <!-- Datepicker CSS -->
    <link href="<?php echo base_url('assets/css/datepicker.css'); ?>" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="<?php echo assets_url() ?>css/plugins/morris.css" rel="stylesheet">

    <!-- Bootstrap Progressbar CSS -->
    <link href="<?php echo assets_url() ?>css/progressbar/bootstrap-progressbar-3.3.0.css" rel="stylesheet">

    <!-- Ladda -->
    <link href="<?php echo base_url('assets/css/ladda.min.css'); ?>" rel="stylesheet">

    <!-- css for input kasus -->
    <link href="<?php echo base_url('assets/css/fileinput.min.css'); ?>" rel="stylesheet">

    <!-- jQuery -->
    <script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>

    <!-- jQueryFileTree -->
    <link href="<?php echo base_url('assets/css/jQueryFileTree.min.css') ?>" rel="stylesheet" type="text/css">
    <script src="<?php echo base_url('assets/js/jQueryFileTree.min.js') ?>"></script>

    <!-- Mithril -->
    <script src="<?php echo base_url('assets/js/mithril.min.js'); ?>"></script>

    <!-- Bootstrap -->
    <script src="<?php echo base_url('assets/vendors/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap-select.min.js') ?>"></script>

    <!-- angular -->
    <script src="<?php echo base_url('assets/js/angular.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/angular-bootstrap-select.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/ngAlertify.js') ?>"></script>

    <!-- moment JS -->
    <script src="<?php echo base_url('assets/js/moment.js') ?>"></script>

    <!-- Morris JavaScript -->
    <script src="<?php echo assets_url() ?>js/morris/raphael.min.js"></script>
    <script src="<?php echo assets_url() ?>js/morris/morris.min.js"></script>

    <!-- Slider -->
    <script src="<?php echo base_url('assets/js/bootstrap-slider.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/slider.js') ?>"></script>

    <!-- Datepicker -->
    <script src="<?php echo base_url('assets/js/datepicker/bootstrap-datepicker.js'); ?>"></script>

    <!-- smart tables -->
    <script src="<?php echo base_url('assets/js/smart-table.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/ngDialog.min.js') ?>"></script>

    <!-- Angular Material requires Angular.js Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-route.min.js"></script>
     <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-sanitize.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>

    <!-- ChartJS -->
    <script src="<?php echo base_url('assets/js/Chart.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/angular-chart.min.js') ?>"></script>

    <!-- SnapSVG JavaScript -->
    <script src="<?php echo base_url('assets/js/snap.svg-min.js') ?>"></script>

    <script src="<?php echo base_url('assets/js/marked.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/angular-marked.min.js') ?>"></script>

    <!-- Bootstrap Progressbar JavaScript -->
    <script src="<?php echo base_url('assets/js/progressbar/bootstrap-progressbar.min.js') ?>"></script>

    <script src='https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML'></script>
    <style type="text/css">
    .slider-selection {
      background: red;
    }
    </style>
    <style type="text/css">
    .ngdialog-content{width :70% !important;}
    </style>

  </head>

  <body class="nav-md footer_fixed">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col menu_fixed">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="<?php echo base_url(); ?>" class="site_title"><img src="<?php echo base_url('assets/images/sisnaker-white-mini.png'); ?>" > </a>
            </div>

            <div class="clearfix"></div>


            <!-- sidebar menu -->
            <?php
            $this->load->view($sidebar);
            ?>
