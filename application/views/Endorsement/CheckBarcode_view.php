
<!-- page content -->
<div class="right_col" role="main">

  <br />
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2><strong><?php echo $subtitle; ?></strong></h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">

          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="barcode">Barcode <span class="required">*</span></label>
            <div class="col-md-3 col-sm-3 col-xs-12">
              <input id="barcode" type="text" name="barcode" required="required" class="form-control">
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12">
              <button id="check" class="btn btn-success">Check</button>
            </div>
          </div><br /><br />
        </div>

      <div class="x_content checked">
        <br />
        <div class="row" style="padding-top: 20px">
          <div class="col-lg-12">
            <!-- panel -->
            <div class="panel with-nav-tabs panel-info">
              <!-- panel heading -->
              <div class="panel-heading" id="tabs-head">
                <ul class="nav nav-tabs" id="tabs-list">
                  <li class="active"><a href=#tabbarcode data-toggle="tab"><strong>Barcode</strong></a>
                  </li>
                  <li><a href=#tabjo data-toggle="tab"><strong>Job Order</strong></a>
                  </li>
                  <li><a href=#tabmajikan data-toggle="tab"><strong>Majikan</strong></a>
                  </li>
                  <li><a href=#tabagensi data-toggle="tab"><strong>Agensi</strong></a>
                  </li>
                  <li><a href=#tabpptkis data-toggle="tab"><strong>PPTKIS</strong></a>
                  </li>
                  <li><a href=#tabtki data-toggle="tab"><strong>TKI</strong></a>
                  </li>
                </ul>
              </div>
              <!-- panel body -->
              <div class="panel-body">
                <div class="tab-content">
                  <div class="tab-pane fade in active" id="tabbarcode">

                  </div>
                  <div class="tab-pane fade in" id="tabjo">

                  </div>
                  <div class="tab-pane fade in" id="tabmajikan">

                  </div>
                  <div class="tab-pane fade in" id="tabagensi">

                  </div>
                  <div class="tab-pane fade in" id="tabpptkis">

                  </div>
                  <div class="tab-pane fade in" id="tabtki">

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
    <br />
  </div>
</div>

<div class="row checked">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2><strong><?php echo $subtitle2; ?></strong></h2>
        <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <div class="row" style="padding-top: 20px">
            <div class="col-lg-12">
              <!-- panel -->
              <div class="panel with-nav-tabs panel-info">
                <!-- panel heading -->
                <div class="panel-heading" id="tabs-head">
                  <ul class="nav nav-tabs" id="tabs-list">
                    <li class="active"><a href=#tabkuitansi data-toggle="tab"><strong>Kuitansi 1</strong></a>
                    </li>
                  </ul>
                </div>
                <!-- panel body -->
                <div class="panel-body">
                  <div class="tab-content">
                    <!-- tab agency -->
                    <div class="tab-pane fade in active" id="tabkuitansi">
                      <div class="col-lg-4"> </div>
                      <div class="col-lg-2"> 
                        <h4>Tanggal Masuk</h4>
                        <h4>Tanggal Kuitansi</h4>
                        <h5>Jenis Dokumen</h5>
                        <h5>No. Kuitansi</h5>
                        <h5>Jumlah Terbayar</h5>
                        <h5>Nama Pemohon</h5>
                        <h5>Petugas</h5>
                      </div>
                      <div class="col-lg-3"> 
                        <h4>: 30/11/2016</span></h4>
                        <h4>: 30/11/2016</h4>
                        <h5>: Legalisasi Dokumen TKI (Job Order)</h5>
                        <h5>: 463771</h5>
                        <h5>: 700 NT$</h5>
                        <h5>: xian guo co ltd</h5>
                        <h5>: herlan</h5>
                      </div>
                      <div class="col-lg-3"> </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- end of panel -->
            </div>

            <div class="clearfix"></div>

<script>
  $(document).ready(function () {
    $(".checked").hide();

    $("#check").click(function() {
      $(".checked").show();
    });
  });
</script>

