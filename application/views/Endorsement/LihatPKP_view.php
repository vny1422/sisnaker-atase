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
          <?php if($this->session->flashdata('information') != ""): ?>
          <?php echo '<div class="container">
            <div class="alert alert-success fade in">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Selamat!</strong> '.$this->session->flashdata('information').'
            </div>
          </div>' ?>
        <?php endif; ?>
          <?php echo form_open_multipart(base_url('PKP/addPkp')) ?>

          <div class="form-group">
            <label class="control-label col-md-2">Agensi</label>
            <div class="col-md-5">
                <select id="agensi" name="agensi" required="required" class="select2_single form-control" tabindex="-1">
                  <option></option>
                  <?php foreach($listagensi as $row): ?>
                    <option value="<?php echo $row->agid ?>"><?php echo $row->agnama ?></option>
                  <?php endforeach; ?>
                </select>
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
            <a class="btn btn-warning" href=" <?php echo base_url('PKP/addPkp') ?> ">Tambah PKP</a>
          </div>
        </div>

        </form>

      </div>
    </div>
  </div>
</div>


<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Modal title</h4>
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

<script type="text/javascript">
  $(document).ready(function() {

    var agensi;
    var pptkis;

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

    // get value agensi
    $('#agensi').on('change', function() {
      agensi = $("#agensi").val();
    });

    // get value pptkis
    $('#pptkis').on('change', function() {
      pptkis = $("#pptkis").val();
    });

    $('#btncari').click(function () {
      if (agensi == null || pptkis == null) {
        alert("Pilih Agensi dan PPTKIS")
      }
      else {
        $.post(" <?php echo base_url(); ?>PKP/getDataPKP", {agid:agensi, ppkode:pptkis}, function(data, status){
          var listinput = $.parseJSON(data);
          $(wrapper_pkp).html('');
          for (var key in listinput) {
            var string = '\
            <tr>\
              <td id="kodepkp" class="text-center" value = "' + listinput[key]["pkpkode"] +'"><a onclick=show("'+listinput[key]["pkpkode"]+'") data-toggle="modal" data-target=".bs-example-modal-lg">' + listinput[key]["pkpkode"] + '</a></td>\
              <td>'+listinput[key]["pkptglawal"]+ '</td> \
              <td>'+listinput[key]["pkptglakhir"]+ '</td> \
              <td>'+listinput[key]["isverified"]+ '</td> \
              <td>'+listinput[key]["isuploaded"]+ '</td> \
              <td>'+listinput[key]["pkptimestamp"]+ '</td> \
              <td><a class="btn btn-xs btn-default" href=" <?php echo base_url(); ?>PKP/uploadDokFin/' + listinput[key]["pkpkode"] +' ">UPLOAD</a> <a class="btn btn-xs btn-default" href="#">DOWNLOAD</a></td> \
            </tr>'
            $(wrapper_pkp).append(string);
          }
        });
      }
    });

    show = function (bc)
    {
      //alert(bc);
      $.post(" <?php echo base_url() ?>PKP/getDataFromBarcode", {barcode:bc}, function(data, status){
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



  });
</script>
