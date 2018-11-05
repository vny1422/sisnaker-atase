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
            <label class="control-label col-md-2">Agency</label>
            <div class="col-md-5">
              <?php if (isset($dataagensi)) { ?>
                <select name="agensi" required="required" class="agensi select2_single form-control input-sm" tabindex="-1" disabled>
                  <option value="<?php echo $dataagensi->agid ?>"><?php echo $dataagensi->agnama ?></option>
                </select>
                <input id="agensi" type="hidden" name="agensi" value="<?php echo $dataagensi->agid ?>"/>
              <?php } else{ ?>
                <select id="agensi" name="agensi" required="required" class="agensi select2_single form-control input-sm" tabindex="-1">
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
                <select id="pptkis" name="pptkis" required="required" class="pptkis select2_single form-control input-sm" tabindex="-1">
                  <option></option>
                  <?php foreach($datapptkis as $row): ?>
                    <option value="<?php echo $row->ppkode ?>"><?php echo $row->ppnama ?></option>
                  <?php endforeach; ?>
                </select>
              <?php } else{ ?>
                <select id="pptkis" name="pptkis" required="required" class="pptkis select2_single form-control input-sm" tabindex="-1">
                  <option></option>
                  <?php foreach($listpptkis as $row): ?>
                    <option value="<?php echo $row->ppkode ?>"><?php echo $row->ppnama ?></option>
                  <?php endforeach; ?>
                </select>
              <?php } ?>
            </div>
            <div class="col-md-2">
              <input id="btncari" class="btn btn-success caributton btn-sm" type="button" name="btncari" value="CARI">
            </div>

          </div><br /><br /><br />




          <div class="x_content">
            <br/><br/><br/>
            <table id="datatable-pkp" class="table table-striped table-condensed table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Rec. Agreement (PKP) Code</th>
                  <!-- <th>Agensi</th>
                  <th>PPTKIS</th> -->
                  <th>Start Date</th>
                  <th>End Date</th>
                  <th>Verification Status</th>
                  <th>Upload Status</th>
                  <th>Date Modified</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody id="list-pkp">


              </tbody>
            </table>

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
          <h4 class="modal-title" id="myModalLabel">Recruitment Agreement (PKP) Detail</h4>
        </div>
        <div class="modal-body">
          <div class="x_content checked" style="display: " >
            <div class="row" style="padding-top: 20px">
              <div class="col-md-12">
                <div class="col-md-2">
                  <label id="coba" class="control-label" >Agency:</label>
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
                  <label class="control-label" >Start Date:</label>
                </div>
                <div class="col-md-10">
                  <p id="pkpawal"></p>
                </div>
              </div>
              <div class="col-md-12">
                <div class="col-md-2">
                  <label class="control-label" >End Date:</label>
                </div>
                <div class="col-md-10">
                  <p id="pkpakhir"></p>
                </div>
              </div>
            </div>
            <hr/>
            <table id="tbpkpd" class="table table-condensed table-bordered table-striped dt-responsive" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Job Type</th>
                  <th>Male</th>
                  <th>Female</th>
                  <th>M/F</th>
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
          <h4 class="modal-title" id="myModalLabel">Reject Recruitment Agreement (PKP)</h4>
        </div>
        <div class="modal-body">
          <div class="x_content checked" style="display: " >
            <div class="row" style="padding-top: 20px">
              <div class="col-md-12">
                <div class="col-md-2">
                  <label id="coba" class="control-label" >Rejection Reason:</label>
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

      <?php if($this->session->flashdata('print') != ""):?>

      <?php if(isset($bc)){ ?>
        var code = '<?php echo $bc; ?>';
        openlabel('POST',"<?php echo base_url()?>kuitansi/printLabel",{barcode: code},'Label');
      <?php } ?>

      $("#agensi").val(<?php echo $kuitansiag ?>);
      $("#pptkis").val('<?php echo $kuitansipp ?>');
      $.post(" <?php echo base_url(); ?>PKP/getDataPKP", {agid:$("#agensi").val(), ppkode:$("#pptkis").val()}, function(data, status){

        var obj = $.parseJSON(data);
        if(obj.length > 0){
          table.clear();
          $(wrapper_pkp).empty();
          for(var key in obj){
            if(obj.hasOwnProperty(key)){
              if (obj[key]["isverified"] == 1){
                td = '<a onclick=showTolak("'+obj[key]["pkpkode"]+'") data-toggle="modal" data-target="#modalTolak">Recruitment Agreement (PKP) Rejected</a>'
              }
              else if (obj[key]["isverified"] == 2) {
                td = '<a target="_blank" class="btn btn-xs btn-default" href=" <?php echo base_url() ?>pkp/downloadDokFin/' + obj[key]["pkpkode"] + ' ">Download Rec. Agreement (PKP) Document</a>'
              }
              else if (obj[key]["isverified"] == 3) {
                if (obj[key]["isuploaded"] == 1) {
                  td = '<a target="_blank" class="btn btn-xs btn-default" href=" <?php echo base_url() ?>uploads/dokumenfinalpkp/Dokumen_Final_PKP_' + obj[key]["pkpkode"] +'.pdf ">Download Archived Document</a>'
                }
                else{
                  td = '<a class="btn btn-xs btn-default" href=" <?php echo base_url(); ?>PKP/uploadDokFin/' + obj[key]["pkpkode"] +' ">Upload Rec.Agreement (PKP) Document</a>'
                }
              }
              else {
                td = 'Need Verification'
              }
              console.log(obj[key]["isverified"]);
              table.row.add([
                '<td id="kodepkp" class="text-center" value = "' + obj[key]["pkpkode"] +'"><a onclick=show("'+obj[key]["pkpkode"]+'") data-toggle="modal" data-target="#modalDetail">' + obj[key]["pkpkode"] + '</a></td>',
                obj[key]["pkptglawal"],
                obj[key]["pkptglakhir"],
                '<td>'+ (obj[key]["isverified"] > 1 ? "Verified" : "Waiting") + '</td>',
                '<td>'+ (obj[key]["isuploaded"]  == 1 ? "Uploaded" : "Waiting")+ '</td>',
                obj[key]["pkptimestamp"],
                '<td class="text-center">'+ td + '</td>'
              ]).draw();
            }
          }
        }
        else {
          alert('Choose Agensi and PPTKIS');
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
          alert("Please choose you Agency and PPTKIS")
        }
        else {
          $.post(" <?php echo base_url(); ?>PKP/getDataPKP", {agid:$("#agensi").val(), ppkode:$("#pptkis").val()}, function(data, status){
            var obj = $.parseJSON(data);
            if(obj.length > 0){
              table.clear();
              $(wrapper_pkp).empty();
              for(var key in obj){
                if(obj.hasOwnProperty(key)){
                  if (obj[key]["isverified"] == 1){
                    td = '<a onclick=showTolak("'+obj[key]["pkpkode"]+'") data-toggle="modal" data-target="#modalTolak">Recruitment Agreement (PKP) Rejected</a>'
                  }
                  else if (obj[key]["isverified"] == 2) {
                    td = '<a target="_blank" class="btn btn-xs btn-default" href=" <?php echo base_url() ?>pkp/downloadDokFin/' + obj[key]["pkpkode"] + ' ">Download Rec. Agreement (PKP) Document</a>'
                  }
                  else if (obj[key]["isverified"] == 3) {
                    if (obj[key]["isuploaded"] == 1) {
                      td = '<a target="_blank" class="btn btn-xs btn-default" href=" <?php echo base_url() ?>uploads/dokumenfinalpkp/Dokumen_Final_PKP_' + obj[key]["pkpkode"] +'.pdf ">Download Archived Document</a>'
                    }
                    else{
                      td = '<a class="btn btn-xs btn-default" href=" <?php echo base_url(); ?>PKP/uploadDokFin/' + obj[key]["pkpkode"] +' ">Upload Rec.Agreement (PKP) Document</a>'
                    }
                  }
                  else {
                    td = 'Need Verification'
                  }
                  console.log(obj[key]["isverified"]);
                  table.row.add([
                    '<td id="kodepkp" class="text-center" value = "' + obj[key]["pkpkode"] +'"><a onclick=show("'+obj[key]["pkpkode"]+'") data-toggle="modal" data-target="#modalDetail">' + obj[key]["pkpkode"] + '</a></td>',
                    obj[key]["pkptglawal"],
                    obj[key]["pkptglakhir"],
                    '<td>'+ (obj[key]["isverified"] > 1 ? "Verified" : "Waiting") + '</td>',
                    '<td>'+ (obj[key]["isuploaded"]  == 1 ? "Uploaded" : "Waiting")+ '</td>',
                    obj[key]["pkptimestamp"],
                    '<td class="text-center">'+ td + '</td>'
                  ]).draw();
                }
              }
            }
            else {
              alert('No data found');
            }
          });
        }
      });

      $('.agensi').on('change', function() {
        //alert( this.value );
        $.post(" <?php echo base_url() ?>PKP/getPPTKISByAgensi", {agid:this.value}, function(data, status){
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

      showTolak = function (bc)
      {
        //alert(bc);
        $.post(" <?php echo base_url() ?>PKP/getDataFromBarcode", {barcode:bc}, function(data, status){
          var obj = $.parseJSON(data);
          if(obj.length > 0) {
            $("#alasanPenolakan").text(obj[0].alasanpenolakan);
            $(".checked").show();
          } else {
            alert('Invalid Barcode');
          }

        });
      }

    });
    </script>
