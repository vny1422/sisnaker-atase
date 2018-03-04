
<!-- page content -->
<div class="right_col" role="main">

  <div class="row">

    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="dashboard_graph">

        <div class="row x_title">
          <div class="col-md-6">
            <h3>DASHBOARD <small><b><?php echo $title; ?></b></small></h3>
          </div>
          <div class="col-md-6">

          </div>
        </div>


        
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Data User </h2>
              <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Settings 1</a>
                    </li>
                    <li><a href="#">Settings 2</a>
                    </li>
                  </ul>
                </li>
                <li><a class="close-link"><i class="fa fa-close"></i></a>
                </li>
              </ul>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th>Username</th>
                    <th>Nama</th>
                    <th>Institusi</th>
                    <th>Kantor</th>
                    <th>Level</th>
                    <th>Edit</th>
                    <th>Hapus</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  $i=0;
                foreach($list as $row): ?>
                  <tr>
                    <td><?php echo $row->username ?></td>
                    <td><?php echo $row->name ?></td>
                    <td><?php echo $listnamainstitusi[$i]->nameinstitution ?></td>
                    <td><?php echo $listnamakantor[$i]->namakantor ?></td>
                    <td><?php echo $listnamalevel[$i]->levelname ?></td>
                    <td>
                      <div class="center-button"><a href=" <?php echo base_url() ?>user/edit/<?php echo $row->username ?>"><button class="btn btn-info" type="button" name="button">Edit</button></a></div>
                    </td>
                    <td>
                      <div class="center-button"><a href="<?php echo base_url() ?>user/delete/<?php echo $row->username ?>"><button align="center" class="btn btn-danger" type="button" name="button">Hapus</button></a></div>
                    </td>
                  </tr>

                <?php $i=$i+1;
                      endforeach;
                ?>
                </tbody>
              </table>

            </div>
          </div>
        </div>


        <div class="clearfix"></div>
      </div>
    </div>

  </div>
</div>
<br />
