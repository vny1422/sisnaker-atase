
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
          <table id="datatable-pk" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>Kode PK</th>
                <th>Agensi</th>
                <th>PPTKIS</th>
                <th>Nama Majikan</th>
                <th>Nama TKI</th>
                <th>Pekerjaan</th>
                <th>Durasi Kerja</th>
              </tr>
            </thead>
            <tbody id="list-pk">


            </tbody>
          </table>
          <hr/>
          <div class="clearfix">
          </div>
          <div class="col-md-12 text-center">
            <button id="legalize" class="ladda-button" style="width: 20%" data-style="expand-right" data-color="green" data-size="xs"><span class="ladda-label" style="color:white"><b>ENDORSE</b></span></button>
          </div>
        </div>
        <div class="x_panel checkedk" id="scroll" style="display: none">
        <div class="x_title">
          <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </ul>
              <h4>CATAT KUITANSI</h4>
              <div class="clearfix"></div>
            </div>
        <div class="x_content">
          <?php echo form_open(base_url('PkNew/catatKuitansi')) ?>
          <input type="hidden" id="kuitansiag" name="kuitansiag"/>
          <input type="hidden" id="kuitansipp" name="kuitansipp"/>
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="active">Use Receipt? </label>
            <div class="col-md-1 col-sm-1 col-xs-2">
              <input type="checkbox" id="cekenable" name="catatkuitansi" checked>
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
                <input id="ckexpired" type="text" class="form-control tglformat" ng-model="shelterform['in']" name="tglkuitansi"></input>
              </div>
            </div>
          </div><br /><br /><br />

          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">No. Kuitansi <span class="required">*</span></label>
            <div class="col-md-3 col-sm-3 col-xs-12">
              <input id="noku" type="text" name="kuno" class="form-control">
            </div>
            <div style="margin-left: -55px;" class="col-md-3 col-sm-3 col-xs-12">
            <button type="button" class="btn btn-primary" id="btnCheck">Check</button><a id="errorku">Silahkan masukkan No. Kuitansi</a>
          </div>

          </div><br /><br /><br /><br />

          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Jumlah Terbayar <span class="required">*</span></label>
            <div class="col-md-5 col-sm-5 col-xs-12">
              <input id="jmlterbayar" type="text" name="jmlterbayar" class="form-control">Jumlah Terbayar dalam satuan <?php echo $currency?>
            </div>
          </div><br /><br /><br /><br />

          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Nama Pemohon <span class="required">*</span></label>
            <div class="col-md-5 col-sm-5 col-xs-12">
              <input id="pemohon" type="text" name="pemohon" class="form-control">
            </div>
          </div><br /><br /><br />
      </div>

    </div>
    <div class="form-group">
      <div class="col-md-12 text-center checkedk" style="display: none">
        <button type="submit" id="ceksubmit" style="width: 20%" class="btn btn-success">Submit</button>
      </div>
    </div>
    <br /><br />

    </form>
  </div>
    <br />
  </div>
</div>

<script>

  $(document).ready(function () {
    window.smoothScrollTo = (function () {
      var timer, start, factor;

      return function (target, duration) {
        var offset = window.pageYOffset,
        delta  = target - window.pageYOffset; // Y-offset difference
        duration = duration || 500;              // default 1 sec animation
        start = Date.now();                       // get start time
        factor = 0;

        if( timer ) {
          clearInterval(timer); // stop any running animations
        }

        function step() {
          var y;
          factor = (Date.now() - start) / duration; // get interpolation factor
          if( factor >= 1 ) {
            clearInterval(timer); // stop animation
            factor = 1;           // clip to max 1.0
          }
          y = factor * delta + offset;
          window.scrollBy(0, y - window.pageYOffset);
        }

        timer = setInterval(step, 10);
        return timer;
      };
    }());
    var wrapper = $("#pkpdlist");
    var wrapper_pk = ('#list-pk')
    var l = $("#check").ladda();
    var lv = $("#legalize").ladda();
    $(document).keypress(function(e) {
      if(e.which == 13) {
          $("#check").click();
        }
    });

    $("#check").click(function() {
      l.ladda('start');
      var code = $("#barcode").val();

      $.post("<?php echo base_url()?>PkNew/getDataFromBarcode", {barcode: code}, function(data,status){
        l.ladda('stop');
        var listinput = $.parseJSON(data);
        if(listinput.length > 0) {
          $(wrapper_pk).html('');
          $("#kuitansiag").val(listinput[0].agid);
          $("#kuitansipp").val(listinput[0].ppkode);
          for (var key in listinput) {
            var string = '\
            <tr>\
              <td>'+listinput[key]["ejbcsp"]+ '</td> \
              <td>'+listinput[key]["agnama"]+ '</td> \
              <td>'+listinput[key]["ppnama"]+ '</td> \
              <td>'+listinput[key]["mjnama"]+ '</td> \
              <td>'+listinput[key]["tknama"]+ '</td> \
              <td>'+listinput[key]["namajenispekerjaan"]+ '</td> \
              <td>'+listinput[key]["jomkthn"]+' yr ' + listinput[key]["jomkbln"] + ' mth ' + listinput[key]["jomkhr"] + ' days </td> \
            </tr>'
            $(wrapper_pk).append(string);
          }
            $(".checked").show();
        } else {
          alert('Barcode tidak valid!');
        }
      });
    });

    $("#legalize").click(function() {
      confirms = confirm("Are you sure to legalize this document?");
      if (confirms == true)
      {
        lv.ladda('start');
        var code = $("#barcode").val();
        $.post("<?php echo base_url()?>PkNew/legalizeBarcode", {barcode: code}, function(data,status){
          lv.ladda('stop');
          var obj = $.parseJSON(data);
          if(obj) {
              $(".checkedk").show();
              smoothScrollTo(document.getElementById('scroll').offsetTop);
          } else {
            alert('PK already has been legalized before!');
          }
        });
      }
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
      if(submit == false && $('#cekenable').is(':checked')) {
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
