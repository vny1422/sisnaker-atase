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

          <div class="form-group">
            <label>Lihat data pada tanggal masuk</label>
            <div class="input-group date datepicker col-md-3 col-xs-3 " data-provide="datepicker" ng-model="formdata['tglmasukTW']" ng-disabled="disableAll" >

              <span class="glyphicon glyphicon-th input-group-addon"></span>
              <input type="text" name="fieldtgl" id="tglubah" value=" <?php echo date("Y/m/d"); ?> " class="form-control">
            </div>
          </div> <br/><br/>


          <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>Jenis Dokumen</th>
                <th>No. Kuitansi</th>
                <th>Terbayar</th>
                <th>Nama Pemohon</th>
                <th>Edit</th>
                <th>Cetak</th>
              </tr>
            </thead>
            <tbody id=listkuitansi>
            <?php
             $i=0;
            foreach($list as $row): ?>
              <tr>
                <td><?php echo $row->tipe ?></td>
                <td><?php echo $row->kuno ?></td>
                <td><?php echo $row->kujmlbayar ?></td>
                <td><?php echo $row->kupemohon ?></td>
                <td>
                  <div class="center-button"><a href="<?php echo base_url()?>kuitansi/edit/<?php echo $row->kuid ?>"><button class="btn btn-primary" type="button" name="button">Edit</button></a></div>
                </td>
                <td>
                  <div class="center-button"><a href="<?php echo base_url()?>kuitansi/cetak/<?php echo $row->kukode ?>"><button align="center" class="btn btn-success" type="button" name="button">Cetak</button></a></div>
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

<script type="text/javascript">
  $(document).ready(function(){
    var table = $("#datatable-responsive").DataTable();
    var wrapper = $("#listkuitansi");
    $("#tglubah").change(function(){
      var fieldtgl = $("#tglubah").val();
      // var fieldtglformatted = fieldtgl.replace("/", "-");
      $.post("<?php echo base_url()?>Kuitansi/getKuitansiByDate", {fieldtgl: fieldtgl}, function(data, status){
        var datakuitansi = $.parseJSON(data);
          $(wrapper).empty();
          table.clear();
          for (var key in datakuitansi){
            if (datakuitansi.hasOwnProperty(key)) {
              table.row.add( [
                datakuitansi[key]["tipe"],
                datakuitansi[key]["kuno"],
                datakuitansi[key]["kujmlbayar"],
                datakuitansi[key]["kupemohon"],
                '<div class="center-button"><a href=" <?php echo base_url() ?>kuitansi/edit/'+datakuitansi[key]["kuid"]+'"><button class="btn btn-primary pilihButton" type="button" name="button">Edit</button></a></div>',
                '<div class="center-button"><a href="<?php echo base_url() ?>kuitansi/cetak/'+datakuitansi[key]["kukode"]+'"><button class="btn btn-success pilihButton" type="button" name="button">Cetak</button></a></div>'
              ]).draw();
            }
          }
        console.log(datakuitansi);
      })
    });
  });
</script>
