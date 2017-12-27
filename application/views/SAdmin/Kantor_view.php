<div class="right_col" role="main">

  <div class="row">
  </div>
  <br />

  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2><strong><?php echo $title; ?></strong></h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>ID Kantor</th>
                <th>Nama Kantor</th>
                <th>Nama Institusi</th>
                <th>Is Active</th>
                <th>Edit</th>
                <th>Hapus</th>
              </tr>
            </thead>
            <tbody>
            <?php
              $i=0;
            foreach($list as $row): ?>
              <tr>
                <td><?php echo $row->idkantor ?></td>
                <td><?php echo $row->namakantor ?></td>
                <td><?php echo $listnama[$i]->nameinstitution ?></td>
                <td><?php if ($row->isactive == 1) {echo 'Active';} else echo 'Not Active';  ?></td>
                <td>
                  <div class="center-button"><a href="<?php echo base_url()?>kantor/edit/<?php echo $row->idkantor ?>"><button class="btn btn-info" type="button" name="button">Edit</button></a></div>
                </td>
                <td>
                  <div class="center-button"><a href="<?php echo base_url()?>kantor/delete/<?php echo $row->idkantor ?>"><button align="center" class="btn btn-danger" type="button" name="button">Hapus</button></a></div>
                </td>
              </tr>

            <?php $i=$i+1;
                  endforeach;
            ?>
            </tbody>
          </table>

        </div>
        <div class="clearfix"></div>
      </div>
  </div>
</div>
</div>
