
<!-- page content -->

<div class="right_col" role="main">

  <br />



  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="bs-example" data-example-id="simple-jumbotron">
        <div class="jumbotron">
          <h3><strong>INGAT!</strong></h3>
          <p><strong>Satu humao, satu barcode. </strong>Jika satu kuitansi digunakan untuk beberapa humao, silahkan diinput berulang kali (sesuai jumlah humao) dengan tetap menggunakan no. kuitansi yang sama.</p>

          <p>Jumlah stiker yang anda cetak ternyata kurang?
            Klik disini untuk cetak kembali stiker <a style="color: #029E8D" href="">Job Order Endorsement</a> ATAU <a style="color: #029E8D" href="">selain Job Order Endorsement</a>.</p>
          </div>
        </div>
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
              <strong>Notification: </strong> '.$this->session->flashdata('information').'
            </div>
          </div>' ?>
        <?php endif; ?>
          <?php echo form_open(base_url('kuitansi/catat')) ?>

          <div class="form-group" >
            <label class="col-sm-2 control-label">Tanggal Masuk</label>
            <div class="col-sm-2">
              <div class="input-group date datepicker col-md-12 col-xs-12" data-provide="datepicker" ng-class="{'has-error':(pst && shForm.inDate.$invalid)}">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <input id="ckstart" type="text" class="form-control tglformat" ng-model="shelterform['in']" name="start" required></input>
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
            <label class="control-label col-md-2 col-sm-2 col-xs-12">Jenis Dokumen <span class="required">*</span></label>
            <div class="col-md-5 col-sm-5 col-xs-12">
              <select id="dokumen" name="dokumen" required="required" class="select2_single form-control" tabindex="-1">
                <option></option>
                <?php foreach($listdokumen as $row): ?>
                  <option value="<?php echo $row->idtipe ?>"><?php echo $row->tipe ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <br /><br /><br/>

          <div class="input_fields_wrap"  id="hidebarcode">
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Barcode <span class="required">*</span></label>
            <div class="col-md-5 col-sm-5 col-xs-12">
              <input id="barcode" type="text" name="bc" class="form-control">
            </div>
            <br /><br /><br /><br />
          </div>
        </div>

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

          <div class="input_fields_wrap"  id="hideendorse">
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="active">Endorse Sekarang (Tidak Perlu Catat Kuitansi Ganda) ? </label>
            <div class="col-md-1 col-sm-1 col-xs-2">
              <input type="checkbox" id="cekenable" name="endorse">
            </div>
            <br /><br /><br /><br />
          </div>
        </div>



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

<br /><br /><br />


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

<script type="text/javascript">

$(document).ready(function() {
    var errorku = $("#errorku");
    var wrapper = $("#listkuitansi");
    var pilihButton = $(".pilihButton");
    var submit = false;
    var hidebc = $("#hidebarcode");
    var hideendorse = $("#hideendorse");
    var table = $("#datatable").DataTable( {
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
    $(hidebc).hide();
    $(hideendorse).hide();
    $(errorku).hide();
    $("#btnCheck").click(function(){
      var noku = $("#noku").val();
      if (noku != ""){
        submit = true;
        $(errorku).hide();
        table.clear();
        $.post("<?php echo base_url()?>Kuitansi/checkkuitansi", {noku: noku}, function(data,status){
          var obj = $.parseJSON(data);
          if (obj.length > 0)
          {
            $(wrapper).empty();

            for (var key in obj) {
              if (obj.hasOwnProperty(key)) {
                table.row.add( [
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
      else {
        if($("#dokumen").val() == 1 && $("#barcode").val() == "")
        {
          e.preventDefault();
          $(hidebc).show();
        }
        else {
          $(hidebc).hide();
        }
      }
    });

    $("#dokumen").change(function(){
      if($("#dokumen").val() == 1)
      {
        $(hidebc).show();
        $(hideendorse).show();
      }
      else {
        $(hidebc).hide();
        $(hideendorse).hide();
      }
    });

    $(wrapper).on("click",".pilihButton", function(e){ //user click on pilih
      e.preventDefault();
      var iddokumen = table.row($(this).closest('tr')).data()[6];
      var jmlterbayar = table.row($(this).closest('tr')).data()[7];
      var nokuitansi = table.row($(this).closest('tr')).data()[8];
      var namapemohon = $(this).closest('tr').find("td:nth-child(2)").text();
      $("#dokumen").val(iddokumen);
      $("#jmlterbayar").val(jmlterbayar);
      $("#noku").val(nokuitansi);
      $("#pemohon").val(namapemohon);
      $("#modalcheck").modal('toggle');
    })


  });
  </script>
