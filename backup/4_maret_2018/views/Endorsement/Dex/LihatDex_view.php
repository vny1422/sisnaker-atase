
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
        <table id="table" class="display" cellspacing="0" width="100%">
            <thead>
                <tr>
                  <th>Nama Pekerja</th>
                  <th>No Paspor</th>
                  <th>Nama Majikan</th>
                  <th>Nama Perusahaan</th>
                  <th>Jenis Pekerjaan</th>
                  <th>Tanggal Mulai</th>
                  <th>Tanggal Selesai</th>
                  <th>Status</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
      </div>

    </div>
    <br />
  </div>
</div>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
    var save_method; //for save method string
    var table;

    $(document).ready(function() {
        //datatables
        table = $('#table').DataTable({ 
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": '<?php echo base_url()?>/dex/entry_json',
                "type": "POST"
            },
            //Set column definition initialisation properties.
            "columns": [
                {"data": "nama_pekerja",width:100},
                {"data": "no_paspor",width:100},
                {"data": "nama_majikan",width:100},
                {"data": "nama_perusahaan",width:100},
                {"data": "pekerjaan",width:100},
                {"data": "tgl_mulai",width:100},
                {"data": "tgl_selesai",width:100},
                {"data": "status",width:170}
            ],

        });
    });
</script>
