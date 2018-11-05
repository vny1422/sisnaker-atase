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

    <!-- Custom styling plus plugins -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/maps/jquery-jvectormap-2.0.3.css'); ?>" />
    <link href="<?php echo base_url('assets/css/icheck/flat/green.css'); ?>" rel="stylesheet" />
    <link href="<?php echo base_url('assets/css/floatexamples.css'); ?>" rel="stylesheet" type="text/css" />

    <!-- jQuery -->
    <script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>

    <!-- Bootstrap -->
    <script src="<?php echo base_url('assets/vendors/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>

    <!-- DataTables -->
    <link href="<?php echo base_url('assets/css/datatables/css/dataTables.bootstrap.css'); ?>" rel="stylesheet">

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
