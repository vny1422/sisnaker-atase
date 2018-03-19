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
                  echo "<option value = "."all".">All</option>";
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
          <table class="table table-hover table-condensed" id="tablepemulangan">
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
            <tbody >
            <?php
            foreach($list as $row): ?>
              <tr id="list">
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
                  <div class="center-button"><a href="<?php echo base_url()?>pemulangantki/edit/<?php echo $row->idtkipulang ?>"><button class="btn btn-info btn-sm" type="button" name="button">Edit</button></a></div>
                </td>
                <td>
                  <div class="center-button"><a href="<?php echo base_url()?>pemulangantki/delete/<?php echo $row->idtkipulang ?>"><button align="center" class="btn btn-danger btn-sm" type="button" name="button">Hapus</button></a></div>
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
    //var table = ("#tablepemulangan");
    //var wrapper = ("#list");


    $('#list-institusi').change(function(){
      //alert( "Handler for .change() called." );
      var id=$(this).val();
			$.ajax({
				url : "<?php echo base_url()?>pemulangantki/list_pulang_institusi",
				method : "POST",
				data : {id: id},
				async : false,
		        dataType : 'json',
				success: function(data){
          //console.log(data);
          $("#tablepemulangan tr").remove();
          var tr = '';
          for (var i = 0; i < data.length; i++) {
            tr = $('<tr/>');
            tr.append("<td>" + data[i].idtkipulang + "</td>");
            tr.append("<td>" + data[i].jeniskepulangan + "</td>");
            tr.append("<td>" + data[i].namatki + "</td>");
            tr.append("<td>" + data[i].paspor + "</td>");
            tr.append("<td>" + data[i].jk + "</td>");
            tr.append("<td>" + data[i].alamatid + "</td>");
            tr.append("<td>" + data[i].kronologis + "</td>");
            tr.append("<td>" + data[i].tanggalpemulangan + "</td>");
            tr.append("<td>" + data[i].statuspemulangan+ "</td>");
            tr.append("<td>" + data[i].namamajikan + "</td>");
            tr.append("<td>" + data[i].namaagensi + "</td>");
            tr.append("<td>" + data[i].namapptkis + "</td>");
            tr.append(
              '<td><div class="center-button"><a href="<?php echo base_url()?>pemulangantki/edit/' +data[i].idtkipulang + '"><button class="btn btn-info" type="button" name="button">Edit</button></a></div></td>'
            );
            tr.append(
              '<td><div class="center-button"><a href="<?php echo base_url()?>pemulangantki/delete/' +data[i].idtkipulang + '"><button class="btn btn-info" type="button" name="button">Hapus</button></a></div></td>'
            );

            $('table').last().append(tr);
          }
				}
			});
		});







    var tbtki = $('#tablepemulangan').DataTable({"bSort" : false,"bLengthChange": false,"scrollX": true});

    $('#tablepemulangan_filter').html("\
      <form style='margin-bottom:10px'>\
        <div class='col-sm-offset-1 form-group'><label>Search: </label><input type='text' class='form-control input-sm' id='searchtki'></div>\
      </form>"
      );

    $("#searchtki").keyup(function() {
      tbtki.search($("#searchtki").val()).draw();
    });

  });
</script>
