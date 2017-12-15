<style media="screen">
.minilabel{
  padding-top: 5%;
  margin-right: -20%;
}

.kuota{
  margin-left: -5%;
}

.caributton{
  margin-left: -30%;
}
</style>
<!-- page content -->
<div class="right_col" role="main">

  <br />
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2><strong><?php echo $title; ?></strong></h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <?php
          if (validation_errors() != "") {
            echo "<div class=\"well well-sm\">";
            echo validation_errors();
            echo "</div>";
          }
          ?>
          <?php if($this->session->flashdata('print') != ""): ?>
            <?php echo '<div class="container">
            <div class="alert alert-warning fade in">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Notification: </strong> '.$this->session->flashdata('print').'
            </div>
            </div>' ?>
          <?php endif; ?>
          <div class="form-group">
            <label class="control-label col-md-2">Agensi</label>
            <div class="col-md-5">
              <?php if (isset($dataagensi)) { ?>
                <select name="agensi" required="required" class="select2_single form-control" tabindex="-1" disabled>
                  <option value="<?php echo $dataagensi->agid ?>"><?php echo $dataagensi->agnama ?></option>
                </select>
                <input id="agensi" type="hidden" name="agensi" value="<?php echo $dataagensi->agid ?>"/>
              <?php } else{ ?>
                <select id="agensi" name="agensi" required="required" class="select2_single form-control" tabindex="-1">
                  <option></option>
                  <?php foreach($listagensi as $row): ?>
                    <option value="<?php echo $row->agid ?>"><?php echo $row->agnama ?></option>
                  <?php endforeach; ?>
                </select>
              <?php } ?>
            </div>
          </div><br /><br /><br />

          <div class="form-group">
            <label class="control-label col-md-2">PPTKIS <span class="required">*</span></label>
            <div class="col-md-5">
              <select id="pptkis" name="pptkis" required="required" class="select2_single form-control" tabindex="-1">
                <option></option>
                <?php foreach($listpptkis as $row): ?>
                  <option value="<?php echo $row->ppkode ?>"><?php echo $row->ppnama ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col-md-2">
              <input id="btncari" class="btn btn-success caributton" type="button" name="btncari" value="CARI">
            </div>

          </div><br /><br /><br />




          <div class="x_content">
            <br/><br/><br/>
            <table id="datatable-pkp" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Kode JO</th>
                  <th>Kode PKP</th>
                  <!-- <th>Agensi</th>
                  <th>PPTKIS</th> -->
                  <th>Tanggal Mulai</th>
                  <th>Tangggal Selesai</th>
                  <th>S. Verifikasi</th>
                  <th>S. Upload</th>
                  <th>Date Modified</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody id="list-pkp">


              </tbody>
            </table>

          </div>

          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12">
              <a class="btn btn-warning" href=" <?php echo base_url('PKP/addJO') ?> ">Tambah JO</a>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>


  <div id="modalDetail" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title" id="myModalLabel">DETAIL PKP</h4>
        </div>
        <div class="modal-body">
          <div class="x_content checked" style="display: " >
            <div class="row" style="padding-top: 20px">
              <div class="col-md-12">
                <div class="col-md-2">
                  <label id="coba" class="control-label" >Agensi:</label>
                </div>
                <div class="col-md-10">
                  <p id="pkpag"></p>
                </div>
              </div>
              <div class="col-md-12">
                <div class="col-md-2">
                  <label class="control-label" >PPTKIS:</label>
                </div>
                <div class="col-md-10">
                  <p id="pkptkis"></p>
                </div>
              </div>
              <div class="col-md-12">
                <div class="col-md-2">
                  <label class="control-label" >Tanggal Mulai:</label>
                </div>
                <div class="col-md-10">
                  <p id="pkpawal"></p>
                </div>
              </div>
              <div class="col-md-12">
                <div class="col-md-2">
                  <label class="control-label" >Tanggal Akhir:</label>
                </div>
                <div class="col-md-10">
                  <p id="pkpakhir"></p>
                </div>
              </div>
            </div>
            <hr/>
            <table id="tbpkpd" class="table table-striped table-bordered dt-responsive" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Jenis Pekerjaan</th>
                  <th>Laki-Laki</th>
                  <th>Perempuan</th>
                  <th>Campuran</th>
                </tr>
              </thead>
              <tbody id="pkpdlist">
              </tbody>
            </table>
            <div class="clearfix">
            </div>

          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>

      </div>
    </div>
  </div>

  <div class="modal fade bs-example-modal-lg" id="modalTolak" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title" id="myModalLabel">PKP Ditolak</h4>
        </div>
        <div class="modal-body">
          <div class="x_content checked" style="display: " >
            <div class="row" style="padding-top: 20px">
              <div class="col-md-12">
                <div class="col-md-2">
                  <label id="coba" class="control-label" >Alasan Penolakan:</label>
                </div>
                <div class="col-md-10">
                  <p id="alasanPenolakan"></p>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>

        </div>
      </div>
    </div>

    <script type="text/javascript">
    $(document).ready(function() {
      openlabel = function(verb, url, data, target) {
        var form = document.createElement("form");
        form.action = url;
        form.method = verb;
        form.target = target;
        if (data) {
          for (var key in data) {
            var input = document.createElement("textarea");
            input.name = key;
            input.value = typeof data[key] === "object" ? JSON.stringify(data[key]) : data[key];
            form.appendChild(input);
          }
        }
        form.style.display = 'none';
        document.body.appendChild(form);
        map = window.open("", "Label", "width=400,height=300");
        form.submit();
      };

      <?php if($this->session->flashdata('print') != ""): ?>
      var code = '<?php echo $bc; ?>';
      openlabel('POST',"<?php echo base_url()?>kuitansi/printLabel",{barcode: code},'Label');
      $("#agensi").val(<?php echo $kuitansiag ?>);
      $("#pptkis").val('<?php echo $kuitansipp ?>');
      $.post(" <?php echo base_url(); ?>PKP/getDataPKP", {agid:$("#agensi").val(), ppkode:$("#pptkis").val()}, function(data, status){
        var listinput = $.parseJSON(data);
        $(wrapper_pkp).html('');
        for (var key in listinput) {

          if (listinput[key]["isverified"] == 1) {
            if (listinput[key]["isuploaded"] == 1) {
              td = '<a target="_blank" class="btn btn-xs btn-default" href=" <?php echo base_url() ?>uploads/dokumenfinalpkp/Dokumen_Final_PKP_' + listinput[key]["pkpkode"] +'.pdf ">DOWNLOAD</a>'
            }
            else{
              td = '<a class="btn btn-xs btn-default" href=" <?php echo base_url(); ?>PKP/uploadDokFin/' + listinput[key]["pkpkode"] +' ">UPLOAD</a>'
            }
          }
          else {
            td = 'Segera Lakukan Verifikasi'
          }

          var string = '\
          <tr>\
          <td id="kodepkp" class="text-center" value = "' + listinput[key]["pkpkode"] +'"><a onclick=show("'+listinput[key]["pkpkode"]+'") data-toggle="modal" data-target="#modalDetail">' + listinput[key]["pkpkode"] + '</a></td>\
          <td>'+listinput[key]["pkptglawal"]+ '</td> \
          <td>'+listinput[key]["pkptglakhir"]+ '</td> \
          <td>'+ (listinput[key]["isverified"] == 1 ? "Sudah" : "Belum") + '</td> \
          <td>'+ (listinput[key]["isuploaded"]  == 1 ? "Sudah" : "Belum")+ '</td> \
          <td>'+listinput[key]["pkptimestamp"]+ '</td> \
          <td class="text-center">'+ td + '</td> \
          </tr>'
          $(wrapper_pkp).append(string);
        }
      });
      <?php endif; ?>

      //var table = ('#datatable-pkp');

      var table = $('#datatable-pkp').DataTable({
        "columnDefs": [
          {
            //"targets": [ 0 ],
            //"visible": false
          }
        ]
      });

      var tableDetail = $('#tbpkpd').DataTable({
        responsive: true
      });

      var wrapper_pkp = ('#list-pkp')
      var wrapper_detail =('#pkpdlist')

      $('#datatable-pkp').dataTable();

      $('#btncari').click(function () {
        if ($("#agensi").val() == null || $("#pptkis").val() == null) {
          alert("Pilih Agensi dan PPTKIS")
        }
        else {
          $.post(" <?php echo base_url(); ?>JO/getDataJO", {agid:$("#agensi").val(), ppkode:$("#pptkis").val()}, function(data, status){
            var obj = $.parseJSON(data);
            if(obj.length > 0){
              table.clear();
              $(wrapper_pkp).empty();
              for(var key in obj){
                if(obj.hasOwnProperty(key)){
                  if (obj[key]["isverified"] == 1){
                    td = '<a onclick=showTolak("'+obj[key]["jobno"]+'") data-toggle="modal" data-target="#modalTolak">JO Ditolak</a>'
                  }
                  else if (obj[key]["isverified"] == 2) {
                    td = 'Segera Lakukan Legalisasi'
                  }
                  else if (obj[key]["isverified"] == 3) {
                    if (obj[key]["isuploaded"] == 1) {
                      td = '<a target="_blank" class="btn btn-xs btn-default" href=" <?php echo base_url() ?>uploads/dokumenfinalpkp/Dokumen_Final_JO_' + obj[key]["jobno"] +'.pdf ">DOWNLOAD</a>'
                    }
                    else{
                      td = '<a class="btn btn-xs btn-default" href=" <?php echo base_url(); ?>PKP/uploadDokFin/' + obj[key]["jobno"] +' ">UPLOAD</a>'
                    }
                  }
                  else {
                    td = 'Segera Lakukan Verifikasi'
                  }
                  table.row.add([
                    '<td id="kodepkp" class="text-center" value = "' + obj[key]["jobno"] +'"><a onclick=show("'+obj[key]["pkpkode"]+'") data-toggle="modal" data-target="#modalDetail">' + obj[key]["jobno"] + '</a></td>',
                    obj[key]["pkpkode"],
                    obj[key]["jobtglawal"],
                    obj[key]["jobtglakhir"],
                    '<td>'+ (obj[key]["isverified"] == 1 ? "Sudah" : "Belum") + '</td>',
                    '<td>'+ (obj[key]["isuploaded"]  == 1 ? "Sudah" : "Belum")+ '</td>',
                    obj[key]["jobtimestamp"],
                    '<td class="text-center">'+ td + '</td>'
                  ]).draw();
                }
              }
            }
            else {
              alert('Choose Agensi and PPTKIS');
            }
          });
        }
      });

      show = function (bc)
      {
        //alert(bc);
        $.post(" <?php echo base_url() ?>JO/getDataFromBarcode", {barcode:bc}, function(data, status){
          var obj = $.parseJSON(data);
          if(obj.length > 0) {
            $("#pkpag").text(obj[0].agnama);
            $("#pkptkis").text(obj[0].ppnama);
            $("#pkpawal").text(obj[0].pkptglawal);
            $("#pkpakhir").text(obj[0].pkptglakhir);
            tableDetail.clear();
            $(wrapper_detail).empty();
            for (var key in obj) {
              if (obj.hasOwnProperty(key)) {
                tableDetail.row.add( [
                  obj[key]["namajenispekerjaan"],
                  obj[key]["pkpdl"],
                  obj[key]["pkpdp"],
                  obj[key]["pkpdc"]
                ] ).draw();
              }
            }
            $(".checked").show();
          } else {
            alert('Barcode tidak valid!');
          }

        });
      }

      showTolak = function (bc)
      {
        //alert(bc);
        $.post(" <?php echo base_url() ?>PKP/getDataFromBarcode", {barcode:bc}, function(data, status){
          var obj = $.parseJSON(data);
          if(obj.length > 0) {
            $("#alasanPenolakan").text(obj[0].alasanpenolakan);
            $(".checked").show();
          } else {
            alert('Barcode tidak valid!');
          }

        });
      }



    });
  </script>
