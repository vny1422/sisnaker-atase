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
                <select name="agensi" required="required" class="agensi select2_single form-control" tabindex="-1" disabled>
                    <option value="<?php echo $dataagensi->agid ?>"><?php echo $dataagensi->agnama ?></option>
                </select>
                <input id="agensi" type="hidden" name="agensi" value="<?php echo $dataagensi->agid ?>"/>
              <?php } else{ ?>
                <select id="agensi" name="agensi" required="required" class="agensi select2_single form-control" tabindex="-1">
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
              <?php if (isset($datapptkis)){ ?>
                <select id="pptkis" name="pptkis" required="required" class="pptkis select2_single form-control" tabindex="-1">
                  <option></option>
                  <?php foreach($datapptkis as $row): ?>
                    <option value="<?php echo $row->ppkode ?>"><?php echo $row->ppnama ?></option>
                  <?php endforeach; ?>
                </select>
              <?php } else{ ?>
                <select id="pptkis" name="pptkis" required="required" class="pptkis select2_single form-control" tabindex="-1">
                  <option></option>
                  <?php foreach($listpptkis as $row): ?>
                    <option value="<?php echo $row->ppkode ?>"><?php echo $row->ppnama ?></option>
                  <?php endforeach; ?>
                </select>
              <?php } ?>
            </div>
            <div class="col-md-2">
              <input id="btncari" class="btn btn-success caributton" type="button" name="btncari" value="CARI">
            </div>

          </div><br /><br /><br />




          <div class="x_content">
            <br/><br/><br/>
            <table id="datatable-pk" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Kode PK</th>
                  <!-- <th>Agensi</th>
                  <th>PPTKIS</th> -->
                  <th>Nama Majikan</th>
                  <th>Nama TKI</th>
                  <th>Pekerjaan</th>
                  <th>Durasi Kerja</th>
                  <th>S. Legalisasi</th>
                  <th>S. Upload</th>
                  <th>Date Modified</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody id="list-pk">


              </tbody>
            </table>

          </div>

        <div class="ln_solid"></div>
        <div class="form-group">
          <div class="col-md-6 col-sm-6 col-xs-12">
            <?php $href = isset($dataagensi) ? 'PKNew/addPkPenempatan' : 'PKNew/addPk' ?>
            <a class="btn btn-warning" href=" <?php echo base_url($href) ?> ">Tambah PK</a>
          </div>
        </div>

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
      $.post(" <?php echo base_url(); ?>PKNew/getDataPK", {agid:$("#agensi").val(), ppkode:$("#pptkis").val()}, function(data, status){
        var listinput = $.parseJSON(data);
        $(wrapper_pk).html('');
        for (var key in listinput) {

          if (listinput[key]["isverified"] == 1) {
            if (listinput[key]["isuploaded"] == 1) {           
              td = '<a target="_blank" class="btn btn-xs btn-default" href=" <?php echo base_url() ?>uploads/dokumenfinalpk/Dokumen_Final_PK_' + listinput[key]["ejbcsp"] +'.pdf ">DOWNLOAD</a>'
            }
            else{
              td = '<a class="btn btn-xs btn-default" href=" <?php echo base_url(); ?>PkNew/uploadDokFin/' + listinput[key]["ejbcsp"] +' ">UPLOAD</a>'
            }
          }
          else {
            td = 'Segera Lakukan Verifikasi'
          }

          var string = '\
          <tr>\
            <td>'+listinput[key]["ejbcsp"]+ '</td> \
            <td>'+listinput[key]["mjnama"]+ '</td> \
            <td>'+listinput[key]["tknama"]+ '</td> \
            <td>'+listinput[key]["namajenispekerjaan"]+ '</td> \
            <td>'+listinput[key]["jomkthn"]+' yr ' + listinput[key]["jomkbln"] + ' mth ' + listinput[key]["jomkhr"] + ' days </td> \
            <td>'+ (listinput[key]["isverified"] == 1 ? "Sudah" : "Belum") + '</td> \
            <td>'+ (listinput[key]["isuploaded"]  == 1 ? "Sudah" : "Belum")+ '</td> \
            <td>'+listinput[key]["pktimestamp"]+ '</td> \
            <td class="text-center">'+ td + '</td> \
          </tr>'
          $(wrapper_pk).append(string);
        }
      });
    <?php endif; ?>

    //var table = ('#datatable-pkp');

    var table = $('#datatable-pk').DataTable({
            "columnDefs": [
        {
            //"targets": [ 0 ],
            //"visible": false
        }
    ]
        });

    var wrapper_pk = ('#list-pk')
    var wrapper_detail =('#pkpdlist')

    $('#datatable-pk').dataTable();

    $('#btncari').click(function () {
      if ($("#agensi").val() == null || $("#pptkis").val() == null) {
        alert("Pilih Agensi dan PPTKIS")
      }
      else {
        $.post(" <?php echo base_url(); ?>PKNew/getDataPK", {agid:$("#agensi").val(), ppkode:$("#pptkis").val()}, function(data, status){
          var listinput = $.parseJSON(data);
          $(wrapper_pk).html('');
          for (var key in listinput) {

            if (listinput[key]["isverified"] == 1) {
              if (listinput[key]["isuploaded"] == 1) {
                td = '<a target="_blank" class="btn btn-xs btn-default" href=" <?php echo base_url() ?>PkNew/downloadDokFin/' + listinput[key]["ejbcsp"] + ' ">DOWNLOAD</a>'      
                //td = '<a target="_blank" class="btn btn-xs btn-default" href=" <?php echo base_url() ?>uploads/dokumenfinalpk/Dokumen_Final_PK_' + listinput[key]["ejbcsp"] +'.pdf ">DOWNLOAD</a>'
              }
              else{
                td = '<a class="btn btn-xs btn-default" href=" <?php echo base_url(); ?>PkNew/uploadDokFin/' + listinput[key]["ejbcsp"] +' ">UPLOAD</a>'
              }
            }
            else {
              td = 'Segera Lakukan Legalisasi'
            }

            var string = '\
            <tr>\
              <td>'+listinput[key]["ejbcsp"]+ '</td> \
              <td>'+listinput[key]["mjnama"]+ '</td> \
              <td>'+listinput[key]["tknama"]+ '</td> \
              <td>'+listinput[key]["namajenispekerjaan"]+ '</td> \
              <td>'+listinput[key]["jomkthn"]+' yr ' + listinput[key]["jomkbln"] + ' mth ' + listinput[key]["jomkhr"] + ' days </td> \
              <td>'+ (listinput[key]["isverified"] == 1 ? "Sudah" : "Belum") + '</td> \
              <td>'+ (listinput[key]["isuploaded"]  == 1 ? "Sudah" : "Belum")+ '</td> \
              <td>'+listinput[key]["pktimestamp"]+ '</td> \
              <td class="text-center">'+ td + '</td> \
            </tr>'
            $(wrapper_pk).append(string);
          }
        });
      }
    });

    $('.agensi').on('change', function() {
      //alert( this.value );
      $.post(" <?php echo base_url() ?>PKNew/getPPTKISByAgensi", {agid:this.value}, function(data, status){
        var obj = $.parseJSON(data);
        if(obj.length > 0) {
          $(".pptkis").empty();
          for (var key in obj) {
            //$(".pptkis").add(new Option(obj[key].ppnama, obj[key].ppkode));
            $(".pptkis").append($("<option></option>")
               .attr("value", obj[key].ppkode).text(obj[key].ppnama));
          }
        } else {
          $(".pptkis").empty();
          //alert('Data tidak ada');
        }
      });
    });

  });
</script>
