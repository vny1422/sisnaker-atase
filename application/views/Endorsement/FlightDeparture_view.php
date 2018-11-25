<div class="right_col" role="main">

  <div class="row"></div>
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
          <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>Nomor Paspor</th>
                <th>Nama TKI</th>
                <th>Kode Bandara</th>
                <th>Transit Port</th>
                <th>Timestamp</th>
                <th>Edit</th>
                <th>Hapus</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach($list as $row): ?>
              <tr>
                <td><?php echo $row->tkpaspor ?></td>
                <td><?php echo $row->tknama ?></td>
                <td><?php echo $row->bandaracode ?></td>
                <td><?php echo $row->transitport ?></td>
                <td><?php echo $row->timestamp ?></td>
                <td>
                  <div class="center-button"><a href="<?php echo base_url() ?>flight/departure/edit/<?php echo $row->keberangkatanid ?> "><button class="btn btn-info" type="button" name="button">Edit</button></a></div>
                </td>
                <td>
                  <div class="center-button"><a href="<?php echo base_url() ?>flight/departure/delete/<?php echo $row->keberangkatanid ?> "><button align="center" class="btn btn-danger" type="button" name="button">Hapus</button></a></div>
                </td>
              </tr>

              <?php
              endforeach;
              ?>
            </tbody>
          </table>
        </div>
        <div class="clearfix"></div>
      </div>
    </div>
  </div>
