
<!-- page content -->
<div class="right_col" role="main">

  <br />
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2><strong><?php echo $subtitle; ?></strong></h2>
          <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">

          <div class="form-group">
            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="barcode">Silahkan download halaman berikut, dan cetaklah.</label>
            <br /><br />
            <div class="col-md-3 col-sm-3 col-xs-12">
              <a href="<?php echo base_url()?>document/<?php echo $jourl->jodownloadurl ?>?x=<?php echo $md5ej ?>"><button class="ladda-button" data-style="expand-right" data-color="blue" data-size="xs"><span class="ladda-label" style="color:white">Job Order & Surat Kuasa</span></button></a>
            </div>
          </div><br /><br />
          <?php foreach($listtki as $tki)
          {
          ?>
          <div class="col-md-3 col-sm-3 col-xs-12">
            <a href="<?php echo base_url()?>document/<?php echo $tki->tkidownloadurl ?>?x=<?php echo $tki->md5tki ?>"><button class="ladda-button" data-style="expand-right" data-color="green" data-size="xs"><span class="ladda-label" style="color:white">Surat PK <?php echo $tki->tknama ?></span></button></a>
          </div>
          <?php
          }
          ?>
        </div>
    </div>
    <br />
  </div>
</div>
