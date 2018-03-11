<div class="right_col" role="main">

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
          <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="" width="100%">
            <thead>
              <tr>
                <th>ID Institusi</th>
                <th>Nama Institusi</th>
                <th>Endorsement Type</th>
                <th>Currency</th>
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
                <td><?php echo $row->idinstitution ?></td>
                <td><?php echo $row->nameinstitution ?></td>
                <td><?php echo $row->endorsementtype ?></td>
                <td><?php echo $listnama[$i]->currencyname ?></td>
                <td><?php if ($row->isactive == 1) {echo 'Active';} else echo 'Not Active';  ?></td>
                <td>
                  <div class="center-button"><a href=" <?php echo base_url() ?>institution/edit/<?php echo $row->idinstitution ?>"><button class="btn btn-info" type="button" name="button">Edit</button></a></div>
                </td>
                <td>
                  <div class="center-button"><a href=" <?php echo base_url() ?>/institution/delete/<?php echo $row->idinstitution ?>"><button class="btn btn-danger" type="button" name="button">Hapus</button></a></div>
                </td>
              </tr>
            <?php $i=$i+1;
                endforeach; ?>

            </tbody>
          </table>
        </div>
      </div>
  </div>
  <div class="clearfix"></div>
</div>
