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
          <h3><strong>Informasi TKI</strong></h3>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <div class="col-md-8 center-margin">

              <div class="form-group">
                <label>No. Paspor :</label> <br />
                <div class="input-group">
                  <input type="text" class="form-control required-entry" id="paspor" name="paspor" placeholder="Masukkan No. Paspor">
                  <span class="input-group-btn">
                    <button id="search-paspor" class="ladda-button" data-style="expand-right" data-color="green" data-size="xs"><span class="ladda-label" style="color:white">Search <i class="fa fa-search"></i></span></button>
                  </span>
                </div>
              </div>

            <div class="checked" style="display:none">

              <div class="form-group">
                <label>Jenis Pemulangan</label> <br />
                <div>
                  <select name="jenispemulangan" id="jenispemulangan" class="form-control required-entry" tabindex="0">
                    <option value=""></option>
                    <option value="1">Jenazah</option>
                    <option value="2">Sakit</option>
                    <option value="3">Repatriasi</option>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label>Nama TKI</label>
                <input type="text" class="form-control required-entry" placeholder="Nama TKI" id="namatki" name="namatki">
              </div>

              <div class="form-group">
                <label>Jenis Kelamin</label>
                <div class="form-control-static" style="padding: 0px">
                 <div class="btn-group">
                   <input type="button" class="btn btn-success" value="Laki-laki" id="buttonL">
                   <input type="button" class="btn" value="Perempuan" id="buttonP">
                 </div>
                </div>
                <input type="hidden" name="gender" id="gender" value="L">
              </div>

              <div class="form-group">
                <label>Alamat di Indonesia</label>
                <input type="text" class="form-control" placeholder="Alamat di Indonesia" id="alamatid" name="alamatid">
              </div>

              <div class="form-group">
                <label>Kronologis</label>
                <div>
                  <textarea class="form-control" rows="3" placeholder="Kronologis"
                  style="resize: vertical" id="kronologis" name="kronologis"></textarea>
                </div>
              </div>

              <div class="form-group">
                <label>Tanggal Pemulangan</label>
                <div class="input-group date datepicker col-md-12 col-xs-12" data-provide="datepicker">
                  <span class="glyphicon glyphicon-th input-group-addon"></span>
                  <input type="text" class="form-control required-entry" id="tglpemulangan" name="tglpemulangan">
                </div>
              </div>

              <div class="form-group">
                <label>Status Pemulangan</label> <br />
                <div class="form-control-static" style="padding: 0px">
                  <div class="btn-group">
                    <input type="button" class="btn" value="Selesai" id="buttonSelesai">
                    <input type="button" class="btn btn-success" value="Dalam Proses" id="buttonProses">
                  </div>
                </div>
                <input type="hidden" name="statuspemulangan" id="statuspemulangan" value="1">
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
                  <label>Nama Agensi</label>
                  <input type="text" class="form-control required-entry" placeholder="Nama Agensi" id="namaagensi" name="namaagensi">
                </div>

                <div class="form-group">
                  <label>Nama PPTKIS</label>
                  <input type="text" class="form-control required-entry" placeholder="Nama PPTKIS" id="namapptkis" name="namapptkis">
                </div>

                <div class="form-group">
                  <label>Nama Majikan</label>
                  <input type="text" class="form-control required-entry" placeholder="Nama Majikan" id="namamajikan" name="namamajikan">
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
    var tkiid = null;

    $("#search-paspor").click(function() {
      l.ladda('start');

      $.post("<?php echo base_url()?>Endorsement/requestTKI", {paspor: $('#paspor').val(), jpid: ''}, function(xml,status){
        l.ladda('stop');
        var json = $.parseJSON(xml);
        if(json == 0)
        {
          alert("Passport not found. Please insert manually.");
        }
        else {
          var data = json.data;
          $('#namatki').val(data.TKI_TKINAME);
          $('#gender').val(data.TKI_TKIGENDER);
          $('#alamatid').val(data.TKI_TKIADDRESS);
          $('#namaagensi').val(data.TKI_PJTKADESC);
          $('#namapptkis').val(data.TKI_PJTKIDESC);
          $('#namamajikan').val(data.TKI_TKIFATHERNAME);
          tkiid = data.TKI_TKIID;
        }
        $(".checked").show();
      });
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
        $.post("<?php echo base_url()?>PemulanganTKI/insertData", {postdata: jsondata}, function(data, status){
          alert(data);
        });
      }
    });
  });
</script>