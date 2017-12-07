
<!-- page content -->
<div class="right_col" role="main">

  <br />
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2><strong><?php echo $subtitle; ?></strong></h2>
          <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
          </ul>
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
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="barcode">Barcode <span class="required">*</span></label>
            <div class="col-md-3 col-sm-3 col-xs-12">
              <input autofocus="" id="barcode" type="text" name="barcode" required="required" class="form-control">
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12">
              <button id="check" class="ladda-button" data-style="expand-right" data-color="green" data-size="xs"><span class="ladda-label" style="color:white">Check</span></button>
            </div>
          </div><br /><br />
        </div>

      <div class="x_content checked" style="display: none" >
        <div class="row" style="padding-top: 20px">
          <div class="col-md-12">
            <div class="col-md-2">
              <label class="control-label" >Agensi:</label>
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
          <hr/>
          <div class="clearfix">
          </div>
          <div class="col-md-12 text-center">
            <button id="verify" class="ladda-button" style="width: 20%" data-style="expand-right" data-color="green" data-size="xs"><span class="ladda-label" style="color:white"><b>VERIFY</b></span></button>
          </div>
        </div>
        <div class="x_panel" id="checkedk" style="display: none">
        <div class="x_title">
          <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </ul>
              <h4>CATAT KUITANSI</h4>
              <div class="clearfix"></div>
            </div>
        <div class="x_content">
          <?php echo form_open(base_url('pkp/catatKuitansi')) ?>
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="active">Use Receipt? </label>
            <div class="col-md-1 col-sm-1 col-xs-2">
              <input type="checkbox" id="cekenable" name="catatkuitansi" checked="true">
            </div>
            <br /><br />
          </div>

          <div class="form-group" >
            <label class="col-sm-2 control-label">Tanggal Masuk</label>
            <div class="col-sm-2">
              <div class="input-group date datepicker col-md-12 col-xs-12" data-provide="datepicker" ng-class="{'has-error':(pst && shForm.inDate.$invalid)}">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <input id="ckstart" type="text" class="form-control tglformat" ng-model="shelterform['in']" name="start"></input>
              </div>
            </div>
          </div><br /><br /><br /><br />

          <div class="form-group" >
            <label class="col-sm-2 control-label">Tanggal Kuitansi</label>
            <div class="col-sm-2">
              <div class="input-group date datepicker col-md-12 col-xs-12" data-provide="datepicker" ng-class="{'has-error':(pst && shForm.inDate.$invalid)}">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <input id="ckexpired" type="text" class="form-control tglformat" ng-model="shelterform['in']" name="tglkuitansi" required></input>
              </div>
            </div>
          </div><br /><br /><br />

          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">No. Kuitansi <span class="required">*</span></label>
            <div class="col-md-3 col-sm-3 col-xs-12">
              <input id="noku" type="text" name="kuno" required="required" class="form-control">
            </div>
            <div style="margin-left: -55px;" class="col-md-3 col-sm-3 col-xs-12">
            <button type="button" class="btn btn-primary" id="btnCheck">Check</button><a id="errorku">Silahkan masukkan No. Kuitansi</a>
          </div>

          </div><br /><br /><br /><br />

          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Jumlah Terbayar <span class="required">*</span></label>
            <div class="col-md-5 col-sm-5 col-xs-12">
              <input id="jmlterbayar" type="text" name="jmlterbayar" required="required" class="form-control">Jumlah Terbayar dalam satuan <?php echo $currency?>
            </div>
          </div><br /><br /><br /><br />

          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Nama Pemohon <span class="required">*</span></label>
            <div class="col-md-5 col-sm-5 col-xs-12">
              <input id="pemohon" type="text" name="pemohon" required="required" class="form-control">
            </div>
          </div><br /><br /><br />

        <div class="form-group">
          <div class="col-md-6 col-sm-6 col-xs-12">
            <button type="reset" class="btn btn-primary">Cancel</button>
            <button type="submit" id="ceksubmit" class="btn btn-success">Submit</button>
          </div>
        </div>
        <br /><br />

        </form>
      </div>
      </div>

    </div>
    <br />
  </div>
</div>

<div class="modal fade bs-example-modal-lg" id="modalcheck" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $subtitle2; ?></h4>
      </div>
      <div class="modal-body">
        <div class="x_content">
          <table id="datatable" class="display table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
              <tr>
              <th>Jenis</th>
                <th>Nama Pemohon</th>
                <th>Nama Agensi</th>
                <th>Tgl. Masuk</th>
                <th>Tgl. Kuitansi</th>
                <th>Pilih</th>
                <th> ID tipe</th>
                <th> Jumlah Terbayar</th>
                <th> No Kuitansi</th>
              </tr>
            </thead>
          <tbody id="listkuitansi">
          </tbody>
          </table>
        </div>
        <div class="clearfix"></div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
      </div>

    </div>
  </div>
</div>
<script>
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
</script>

<?php if($this->session->flashdata('print') != ""): ?>
  <script type="text/javascript">
    var code = '<?php echo $bc; ?>';
    openlabel('POST',"<?php echo base_url()?>kuitansi/printLabel",{barcode: code},'Label');
  </script>
<?php endif; ?>

<script>

  $(document).ready(function () {
    var table = $('#tbpkpd').DataTable({
      responsive: true
    });
    var wrapper = $("#pkpdlist");
    var l = $("#check").ladda();
    var lv = $("#verify").ladda();
    $(document).keypress(function(e) {
      if(e.which == 13) {
          $("#check").click();
        }
    });

    $("#check").click(function() {
      l.ladda('start');
      var code = $("#barcode").val();

      $.post("<?php echo base_url()?>pkp/getDataFromBarcode", {barcode: code}, function(data,status){
        l.ladda('stop');
        var obj = $.parseJSON(data);
        if(obj.length > 0) {
          $("#pkpag").text(obj[0].agnama);
          $("#pkptkis").text(obj[0].ppnama);
          $("#pkpawal").text(obj[0].pkptglawal);
          $("#pkpakhir").text(obj[0].pkptglakhir);
            table.clear();
            $(wrapper).empty();
            for (var key in obj) {
              if (obj.hasOwnProperty(key)) {
                table.row.add( [
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
    });

    $("#verify").click(function() {
      lv.ladda('start');
      var code = $("#barcode").val();

      $.post("<?php echo base_url()?>pkp/verifyBarcode", {barcode: code}, function(data,status){
        lv.ladda('stop');
        var obj = $.parseJSON(data);
        if(obj) {
            $("#checkedk").show();
        } else {
          alert('PKP already has been verified before!');
        }
      });
    });

    // JS Kuitansi

    var errorku = $("#errorku");
    var wrapperk = $("#listkuitansi");
    var pilihButton = $(".pilihButton");
    var submit = false;
    var tablek = $("#datatable").DataTable( {
    "columnDefs": [
        {
            "targets": [ 6 ],
            "visible": false
        },
        {
            "targets": [ 7 ],
            "visible": false
        },
        {
            "targets": [ 8 ],
            "visible": false
        }
    ]
    });
    $(errorku).hide();
    $("#btnCheck").click(function(){
      var noku = $("#noku").val();
      if (noku != ""){
        submit = true;
        $(errorku).hide();
        tablek.clear();
        $.post("<?php echo base_url()?>Kuitansi/checkkuitansi", {noku: noku}, function(data,status){
          var obj = $.parseJSON(data);
          if (obj.length > 0)
          {
            $(wrapperk).empty();

            for (var key in obj) {
              if (obj.hasOwnProperty(key)) {
                tablek.row.add( [
                  obj[key]["namadokumen"],
                  obj[key]["kupemohon"],
                  obj[key]["kukode"],
                  obj[key]["kutglmasuk"],
                  obj[key]["kutglkuitansi"],
                  '<div class="center-button"><button class="btn btn-primary pilihButton" type="button" name="button">Pilih</button></a></div>',
                  obj[key]["idtipe"],
                  obj[key]["kujmlbayar"],
                  obj[key]["kuno"]
                ] ).draw();
              }
            }
            $("#modalcheck").modal();
          }
          else {
            window.alert("No. Kuitansi siap digunakan");
          }
        });
      }
      else {
        $(errorku).show();
      }
    });

    $("#noku").change(function(){
      submit = false;
    });

    $("#ceksubmit").click(function(e){
      if(submit == false){
        e.preventDefault();
        window.alert("Cek No Kuitansi terlebih dahulu");
      }
      // else {
      //   if($("#dokumen").val() == 1 && $("#barcode").val() == "")
      //   {
      //     e.preventDefault();
      //     $(hidebc).show();
      //   }
      //   else {
      //     $(hidebc).hide();
      //   }
      // }
    });

    $(wrapperk).on("click",".pilihButton", function(e){ //user click on pilih
      e.preventDefault();
      var iddokumen = tablek.row($(this).closest('tr')).data()[6];
      var jmlterbayar = tablek.row($(this).closest('tr')).data()[7];
      var nokuitansi = tablek.row($(this).closest('tr')).data()[8];
      var namapemohon = $(this).closest('tr').find("td:nth-child(2)").text();
      $("#jmlterbayar").val(jmlterbayar);
      $("#noku").val(nokuitansi);
      $("#pemohon").val(namapemohon);
      $("#modalcheck").modal('toggle');
    })
  });

</script>
