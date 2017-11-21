<div class="right_col" role="main">

  <div class="row">
  </div>
  <br />

  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2><strong><?php echo $subtitle; ?></strong></h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="col-md-12">
          <div class="row" style="<?php echo ($_SESSION['role'] == 1 || $_SESSION['role'] == 5 ? "" : "display:none;"); ?>">
            <div class="form-group col-lg-4">
              <label><h2>Institusi</h2></label>
              <select class="form-control" id="list-institusi" name="list-institusi">
                <?php
                if (isset($listinstitusi)) {
                  echo "<option>All</option>";
                  foreach($listinstitusi as $row):
                    if ($row->idinstitution != 1) {
                      echo "<option value=".$row->idinstitution.">".$row->nameinstitution."</option>";
                    }
                    endforeach;
                }
                ?>
              </select>
            </div>
          </div>
        </div>
        <div class="x_content">
          <table class="table table-striped table-bordered" id="tablepemulangan">
            <thead>
              <tr>
                <th>ID Pemulangan</th>
                <th>Jenis Pemulangan</th>
                <th>Nama TKI</th>
                <th>No. Paspor</th>
                <th>JK</th>
                <th>Alamat</th>
                <th>Kronologis</th>
                <th>Tanggal Pemulangan</th>
                <th>Status Pemulangan</th>
                <th>Nama Majikan</th>
                <th>Nama Agensi</th>
                <th>Nama PPTKIS</th>
                <th>Edit</th>
                <th>Hapus</th>
              </tr>
            </thead>
            <tbody id="list">
            <?php
            foreach($list as $row): ?>
              <tr>
                <td><?php echo $row->idtkipulang ?></td>
                <td><?php echo $row->jeniskepulangan ?></td>
                <td><?php echo $row->namatki ?></td>
                <td><?php echo $row->paspor ?></td>
                <td><?php echo $row->jk ?></td>
                <td><?php echo $row->alamatid ?></td>
                <td><?php echo $row->kronologis ?></td>
                <td><?php echo $row->tanggalpemulangan ?></td>
                <td><?php if ($row->statuspemulangan == 1) {echo 'Dalam Proses';} else echo 'Selesai';  ?></td>
                <td><?php echo $row->namamajikan ?></td>
                <td><?php echo $row->namaagensi ?></td>
                <td><?php echo $row->namapptkis ?></td>
                <td>
                  <div class="center-button"><a href="<?php echo base_url()?>pemulangantki/edit/<?php echo $row->idtkipulang ?>"><button class="btn btn-info" type="button" name="button">Edit</button></a></div>
                </td>
                <td>
                  <div class="center-button"><a href="<?php echo base_url()?>pemulangantki/delete/<?php echo $row->idtkipulang ?>"><button align="center" class="btn btn-danger" type="button" name="button">Hapus</button></a></div>
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
</div>

<script>
  $(document).ready(function () {

    var institusi = ("#list-institusi");
    var table = ("#tablepemulangan");
    var wrapper = ("#list");

    $(institusi).change(function(){
      windows.print();
      $.post(" <?php echo base_url()?>pemulangantki/list_pulang_institusi", {id: $(institusi).val()}, function(data, status){
        table.clear();
        $(wrapper).empty();
        var.listinput = $.parseJSON(data);
        var i=0;
        for (var key in listinput) {
          if (listinput.hasOwnProperty(key)) {
            table.row.add([
              listinput[key]["idtkipulang"],
              listinput[key]["jeniskepulangan"],
              listinput[key]["namatki"],
              listinput[key]["paspor"],
              listinput[key]["jk"],
              listinput[key]["alamatid"],
              listinput[key]["kronologis"],
              listinput[key]["tanggalpemulangan"],
              listinput[key]["statuspemulangan"] == 1 ? "Dalam Proses" : "Selesai",
              listinput[key]["namamajikan"],
              listinput[key]["namaagensi"],
              listinput[key]["namapptkis"]
            ]).draw();
            i = i+1;
          }
        }
      });
    });



    var tbtki = $('#tablepemulangan').DataTable({"bSort" : false,"bLengthChange": false,"scrollX": true});

    $('#tablepemulangan_filter').html("\
      <form class='form-inline' style='margin-bottom:10px'>\
        <div class='col-sm-offset-1 form-group'><label>Search: </label><input type='text' class='form-control' id='searchtki'></div>\
      </form>"
      );

    $("#searchtki").keyup(function() {
      tbtki.search($("#searchtki").val()).draw();
    });

  });
</script>
