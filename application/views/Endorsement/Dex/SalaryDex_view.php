
<!-- page content -->
<div class="right_col" role="main">

  <br />
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2><strong><?php echo $subtitle; ?></strong></h2>
          <!-- <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
        </ul> -->
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <?php if($this->session->flashdata('information') != ""): ?>
          <?php echo '<div class="container">
          <div class="alert alert-warning fade in">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Notification: </strong> '.$this->session->flashdata('information').'
          </div>
          </div>' ?>
        <?php endif; ?>
      </div>

    </div>
    <br />
  </div>
</div>
