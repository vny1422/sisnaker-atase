<!-- start of modal -->
<div class="modal fade bs-example-modal-lg" id="modaltki" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog modal-lg">
  <div class="modal-content">

    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
      </button>
      <h4 class="modal-title" id="myModalLabel">Pilih Versi</h4>
    </div>
    <div class="modal-body">
      <div class="x_content">
        <br />
        <div class="row" style="padding-top: 10px">
          <div class="col-lg-12">
            <!-- panel -->
            <div class="panel with-nav-tabs panel-info">
              <!-- panel heading -->
              <div class="panel-heading" id="tabs-head">
                <ul class="nav nav-tabs" id="tabs-list">
                  <li class="active"><a href=#tablokal data-toggle="tab"><strong>Versi Lokal</strong></a>
                  </li>
                  <li><a href=#tabbnp2tki data-toggle="tab"><strong>Versi BNP2TKI</strong></a>
                  </li>
                </ul>
              </div>
              <!-- panel body -->
              <div class="panel-body">
                <div class="tab-content">

                  <!-- TAB LOKAL -->
                  <div class="tab-pane fade in active" id="tablokal">
                    <div class="panel-body">
                      <div class="tab-content">
                        <div class="col-md-12 left-margin">
                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="namatki">Nama TKI :</label>
                            <div class="col-md-6 col-sm-6 col-xs-12 fielddata">
                              <p id="namatkilokal"></p>
                            </div>
                          </div><br /><br />
                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="jk">Jenis Kelamin :</label>
                            <div class="col-md-6 col-sm-6 col-xs-12 fielddata">
                              <p id="jklokal"></p>
                            </div>
                          </div><br /><br />
                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="alamat">Alamat di Indonesia :</label>
                            <div class="col-md-6 col-sm-6 col-xs-12 fielddata">
                              <p id="alamatlokal"></p>
                            </div>
                          </div><br /><br />
                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="namaagensi">Nama Agensi :</label>
                            <div class="col-md-6 col-sm-6 col-xs-12 fielddata">
                              <p id="namaagensilokal"></p>
                            </div>
                          </div><br /><br />
                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="namapptkis">Nama PPTKIS :</label>
                            <div class="col-md-6 col-sm-6 col-xs-12 fielddata">
                              <p id="namapptkislokal"></p>
                            </div>
                          </div><br /><br />
                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="namamajikan">Nama Majikan :</label>
                            <div class="col-md-6 col-sm-6 col-xs-12 fielddata">
                              <p id="namamajikanlokal"></p>
                            </div>
                          </div><br />
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- TAB BNP2TKI -->
                  <div class="tab-pane fade in" id="tabbnp2tki">
                    <div class="panel-body">
                      <div class="tab-content">
                        <div class="col-md-12 left-margin">
                          <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="namatki">Nama TKI :</label>
                            <div class="col-md-6 col-sm-6 col-xs-12 fielddata">
                              <p id="namatkibnp2tki"></p>
                            </div>
                          </div><br /><br />
                          <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="jk">Jenis Kelamin :</label>
                            <div class="col-md-6 col-sm-6 col-xs-12 fielddata">
                              <p id="jkbnp2tki"></p>
                            </div>
                          </div><br /><br />
                          <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="alamat">Alamat di Indonesia :</label>
                            <div class="col-md-6 col-sm-6 col-xs-12 fielddata">
                              <p id="alamatbnp2tki"></p>
                            </div>
                          </div><br /><br />
                          <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="namaagensi">Nama Agensi :</label>
                            <div class="col-md-6 col-sm-6 col-xs-12 fielddata">
                              <p id="namaagensibnp2tki"></p>
                            </div>
                          </div><br /><br />
                          <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="namapptkis">Nama PPTKIS :</label>
                            <div class="col-md-6 col-sm-6 col-xs-12 fielddata">
                              <p id="namapptkisbnp2tki"></p>
                            </div>
                          </div><br /><br />
                          <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="namamajikan">Nama Majikan :</label>
                            <div class="col-md-6 col-sm-6 col-xs-12 fielddata">
                              <p id="namamajikanbnp2tki"></p>
                            </div>
                          </div><br />
                        </div>
                      </div>
                    </div>
                  </div>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="clearfix"></div>
      </div>

      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="btnPilih">Pilih</button>
      </div>

    </div>
  </div>
</div>

<!-- end of modals -->

<div class="right_col" role="main">
  <div class="row" ></div>
  <br />
  <form class="form-horizontal form-label-left">
  <div class="row" >
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
          </ul>
          <h3><strong>Informasi TKI yang Dipulangkan</strong></h3>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <div class="col-md-8 center-margin">

              <div class="form-group">
                <label>No. Paspor *</label> <br />
                <div class="input-group">
                  <input type="text" class="form-control required-entry" id="paspor" name="paspor" placeholder="Masukkan No. Paspor" value="<?php if(isset($list)) {echo $list->paspor;} else echo ""; ?>">
                  <span class="input-group-btn">
                    <button id="search-paspor" class="ladda-button" data-style="expand-right" data-color="green" data-size="xs"><span class="ladda-label" style="color:white">Search <i class="fa fa-search"></i></span></button>
                  </span>
                </div>
              </div>

            <div class="checked" style="display:none">

              <div class="form-group">
                <label>Jenis Pemulangan *</label> <br />
                <div>
                  <select name="jenispemulangan" id="jenispemulangan" class="form-control required-entry" tabindex="0">
                    <option value=""></option>
                    <option value="1" <?php if(isset($list)) {echo $list->jeniskepulangan == 'Jenazah' ? 'selected' : '';}?>>Jenazah</option>
                    <option value="2" <?php if(isset($list)) {echo $list->jeniskepulangan == 'Sakit' ? 'selected' : '';}?>>Sakit</option>
                    <option value="3" <?php if(isset($list)) {echo $list->jeniskepulangan == 'Repatriasi' ? 'selected' : '';}?>>Repatriasi</option>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label>Nama TKI *</label>
                <input type="text" class="form-control required-entry" placeholder="Nama TKI" id="namatki" name="namatki" value="<?php if(isset($list)) {echo $list->namatki;} else echo ""; ?>">
              </div>

              <div class="form-group">
                <label>Jenis Kelamin *</label>
                <div class="form-control-static" style="padding: 0px">
                 <div class="btn-group">
                   <input type="button" class="btn" value="Laki-laki" id="buttonL">
                   <input type="button" class="btn" value="Perempuan" id="buttonP">
                 </div>
                </div>
                <input type="hidden" name="gender" id="gender" value="<?php if(isset($list)) {echo $list->jk;} else echo "L"; ?>">
              </div>

              <div class="form-group">
                <label>Alamat di Indonesia *</label>
                <input type="text" class="form-control required-entry" placeholder="Alamat di Indonesia" id="alamatid" name="alamatid" value="<?php if(isset($list)) {echo $list->alamatid;} else echo ""; ?>">
              </div>

              <div class="form-group">
                <label>Kronologis</label>
                <div>
                  <textarea class="form-control" rows="3" placeholder="Kronologis"
                  style="resize: vertical" id="kronologis" name="kronologis"><?php if(isset($list)) {echo $list->kronologis;} else echo ""; ?></textarea>
                </div>
              </div>

              <div class="form-group">
                <label>Tanggal Pemulangan *</label>
                <div class="input-group date datepicker col-md-12 col-xs-12" data-provide="datepicker">
                  <span class="glyphicon glyphicon-th input-group-addon"></span>
                  <input type="text" class="form-control required-entry" id="tglpemulangan" name="tglpemulangan" value="<?php if(isset($list)) {$splittgl = explode("-", $list->tanggalpemulangan);
                    echo $splittgl[0]."/".$splittgl[1]."/".$splittgl[2];} else echo ""; ?>">
                </div>
              </div>

              <div class="form-group">
                <label>Status Pemulangan *</label> <br />
                <div class="form-control-static" style="padding: 0px">
                  <div class="btn-group">
                    <input type="button" class="btn" value="Selesai" id="buttonSelesai">
                    <input type="button" class="btn" value="Dalam Proses" id="buttonProses">
                  </div>
                </div>
                <input type="hidden" name="statuspemulangan" id="statuspemulangan" value="<?php if(isset($list)) {echo $list->statuspemulangan;} else echo "1"; ?>">
              </div>

              <br />

          </div>

          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row checked" style="display:none">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
            </ul>
              <h3><strong>Informasi Agensi dan Majikan TKI</strong></h3>
              <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="col-md-8 center-margin">
                <div class="form-group">
                  <label>Nama Agensi *</label>
                  <input type="text" class="form-control required-entry" placeholder="Nama Agensi" id="namaagensi" name="namaagensi" value="<?php if(isset($list)) {echo $list->namaagensi;} else echo ""; ?>">
                </div>

                <div class="form-group">
                  <label>Nama PPTKIS *</label>
                  <input type="text" class="form-control required-entry" placeholder="Nama PPTKIS" id="namapptkis" name="namapptkis" value="<?php if(isset($list)) {echo $list->namapptkis;} else echo ""; ?>">
                </div>

                <div class="form-group">
                  <label>Nama Majikan *</label>
                  <input type="text" class="form-control required-entry" placeholder="Nama Majikan" id="namamajikan" name="namamajikan" value="<?php if(isset($list)) {echo $list->namamajikan;} else echo ""; ?>">
                </div>
            </div>
            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-2">
                <button type="reset" class="btn btn-primary">Batal</button>
                <button class="btn btn-success" id="simpan">Simpan</button>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
  </form>

<script type="text/javascript">
  $(document).ready(function () {
    var l = $("#search-paspor").ladda();
    var idtkipulang = "<?php if(isset($list)) {echo $list->idtkipulang;} else null; ?>";
    var tkiid = "<?php if(isset($list)) {echo $list->tkiid;} else null; ?>";
    var json = null;
    var json2 = null;
    var data2 = null;

    if(tkiid == ""){
      tkiid = null;
    }

    if($("#gender").val() == "L") {
      $("#buttonL.btn").toggleClass("btn-success");
    } else {
      $("#buttonP.btn").toggleClass("btn-success");
    }

    if($("#statuspemulangan").val() == "1") {
      $("#buttonProses.btn").toggleClass("btn-success");
    } else {
      $("#buttonSelesai.btn").toggleClass("btn-success");
    }

    if(idtkipulang != ""){
      $(".checked").show();
    }

    $("#search-paspor").click(function() {
      l.ladda('start');

      $.post("<?php echo base_url()?>PemulanganTKI/checkPaspor", {paspor: $('#paspor').val()}, function(xml,status){
        l.ladda('stop');
        json = $.parseJSON(xml);
        
        $.post("<?php echo base_url()?>Endorsement/requestTKI", {paspor: $('#paspor').val(), jpid: ''}, function(xml,status){
          json2 = $.parseJSON(xml);

          if(json == null && json2 == 0)
          {
            alert("Passport not found. Please insert manually.");
          }
          else if (json == null && json2 != 0){
            data2 = json2.data;
            $('#namatki').val(data2.TKI_TKINAME);
            $('#gender').val(data2.TKI_TKIGENDER);
            $('#alamatid').val(data2.TKI_TKIADDRESS);
            $('#namaagensi').val(data2.TKI_PJTKADESC);
            $('#namapptkis').val(data2.TKI_PJTKIDESC);
            $('#namamajikan').val(data2.TKI_VISAMAJIKANNAME);
            tkiid = data2.TKI_TKIID;
          }
          else if (json != null && json2 == 0){
            $('#namatki').val(json.namatki);
            $('#gender').val(json.jk);
            $('#alamatid').val(json.alamatid);
            $('#namaagensi').val(json.namaagensi);
            $('#namapptkis').val(json.namapptkis);
            $('#namamajikan').val(json.namamajikan);
            tkiid = json.tkiid;
          }
          else if (json != null && json2 != 0){
            data2 = json2.data;

            $('#namatkilokal').html(json.namatki);
            $('#jklokal').html(json.jk);
            $('#alamatlokal').html(json.alamatid);
            $('#namaagensilokal').html(json.namaagensi);
            $('#namapptkislokal').html(json.namapptkis);
            $('#namamajikanlokal').html(json.namamajikan);

            $('#namatkibnp2tki').html(data2.TKI_TKINAME);
            $('#jkbnp2tki').html(data2.TKI_TKIGENDER);
            $('#alamatbnp2tki').html(data2.TKI_TKIADDRESS);
            $('#namaagensibnp2tki').html(data2.TKI_PJTKADESC);
            $('#namapptkisbnp2tki').html(data2.TKI_PJTKIDESC);
            $('#namamajikanbnp2tki').html(data2.TKI_VISAMAJIKANNAME);

            $("#modaltki").modal('show');
          }
          $(".checked").show();
        });       
      });      
    });

    $("#btnPilih").click( function(e) {
      e.preventDefault();
      if($("#tablokal").hasClass("active")){
        $('#namatki').val(json.namatki);
        $('#gender').val(json.jk);
        $('#alamatid').val(json.alamatid);
        $('#namaagensi').val(json.namaagensi);
        $('#namapptkis').val(json.namapptkis);
        $('#namamajikan').val(json.namamajikan);
        tkiid = json.tkiid;
      } else {
        $('#namatki').val(data2.TKI_TKINAME);
        $('#gender').val(data2.TKI_TKIGENDER);
        $('#alamatid').val(data2.TKI_TKIADDRESS);
        $('#namaagensi').val(data2.TKI_PJTKADESC);
        $('#namapptkis').val(data2.TKI_PJTKIDESC);
        $('#namamajikan').val(data2.TKI_VISAMAJIKANNAME);
        tkiid = data2.TKI_TKIID;
      }
      $("#modaltki").modal('hide');
    });

    $("#buttonL").click( function() {
      if($("#gender").val() != "L") {
        $("#buttonL.btn").toggleClass("btn-success");
        $("#buttonP.btn").toggleClass("btn-success");
        $("#gender").val("L");
      }
    });
    $("#buttonP").click( function() {
      if($("#gender").val() != "P") {
        $("#buttonL.btn").toggleClass("btn-success");
        $("#buttonP.btn").toggleClass("btn-success");
        $("#gender").val("P");
      }
    });
    $("#buttonSelesai").click( function() {
      if($("#statuspemulangan").val() != "2") {
        $("#buttonSelesai.btn").toggleClass("btn-success");
        $("#buttonProses.btn").toggleClass("btn-success");
        $("#statuspemulangan").val("2");
      }
    });
    $("#buttonProses").click( function() {
      if($("#statuspemulangan").val() != "1") {
        $("#buttonSelesai.btn").toggleClass("btn-success");
        $("#buttonProses.btn").toggleClass("btn-success");
        $("#statuspemulangan").val("1");
      }
    });

    $("#simpan").click( function(e) {
      e.preventDefault();
      
      var emptyInput = $('.required-entry').filter(function () {
        return $.trim(this.value) === "";
      });
      
      if(emptyInput.length == 0){
        var postdata = {
          jeniskepulangan:$('#jenispemulangan option:selected').text(),
          jk:$('#gender').val(),
          namatki:$('#namatki').val(),
          paspor:$('#paspor').val(),
          alamatid:$('#alamatid').val(),
          namaagensi:$('#namaagensi').val(),
          namapptkis:$('#namapptkis').val(),
          namamajikan:$('#namamajikan').val(),
          kronologis:$('#kronologis').val(),
          tanggalpemulangan:$('#tglpemulangan').val(),
          statuspemulangan:$('#statuspemulangan').val(),
          tkiid:tkiid
        };
        var jsondata = JSON.stringify(postdata);
        $.post("<?php echo base_url()?>PemulanganTKI/insertData", {postdata: jsondata, id:idtkipulang}, function(data, status){
          alert(data);
        });
      } else {
        alert("Mohon cek kelengkapan data.")
      }
    });
  });
</script>