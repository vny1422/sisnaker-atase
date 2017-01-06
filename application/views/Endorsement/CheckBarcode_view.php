
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
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Barcode <span class="required">*</span></label>
            <div class="col-md-3 col-sm-3 col-xs-12">
              <input id="" type="text" name="name" required="required" class="form-control">
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12">
              <button type="submit" class="btn btn-success">Check</button>
            </div>
          </div><br /><br />
        </form>
      </div>

      <div class="x_content">
  <br />
  <div class="row" style="padding-top: 20px">
    <div class="col-lg-12">
      <!-- panel -->
      <div class="panel with-nav-tabs panel-info">
        <!-- panel heading -->
        <div class="panel-heading" id="tabs-head">
          <ul class="nav nav-tabs" id="tabs-list">
            <li class="active"><a href=#tabagency data-toggle="tab"><strong>Barcode</strong></a>
            </li>
            <li><a href=#tabpptkis data-toggle="tab"><strong>Job Order</strong></a>
            </li>
            <li><a href=#tabcekalagency data-toggle="tab"><strong>Majikan</strong></a>
            </li>
            <li><a href=#tabcekalpptkis data-toggle="tab"><strong>Agensi Luar</strong></a>
            </li>
            <li><a href=#tabcekalpptkis data-toggle="tab"><strong>Agensi Indonesia</strong></a>
            </li>
            <li><a href=#tabcekalpptkis data-toggle="tab"><strong>TKI</strong></a>
            </li>
          </ul>
        </div>
        <!-- panel body -->
        <div class="panel-body" ng-controller="AgencyController">
          <div class="tab-content">
            <!-- tab agency -->
            <div class="tab-pane fade in active" id="tabagency">
              <?php include 'agency_template/list_agency.php'; ?>
            </div>
            <!-- tab agency -->
            <div class="tab-pane fade in" id="tabpptkis">
              <?php include 'agency_template/list_pptkis.php'; ?>
            </div>
            <!-- tab agency -->
            <div class="tab-pane fade in" id="tabcekalagency">
              <?php include 'agency_template/list_cekal_agency.php'; ?>
            </div>
            <!-- tab agency -->
            <div class="tab-pane fade in" id="tabcekalpptkis">
              <?php include 'agency_template/list_cekal_pptkis.php'; ?>
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

 <div class="row">
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
              <br />
              <div class="row" style="padding-top: 20px">
                <div class="col-lg-12">
            <!-- panel -->
            <div class="panel with-nav-tabs panel-info">
              <!-- panel heading -->
              <div class="panel-heading" id="tabs-head">
                <ul class="nav nav-tabs" id="tabs-list">
                  <li class="active"><a href=#tabagency data-toggle="tab"><strong>Kuitansi 1</strong></a>
                  </li>
                </ul>
              </div>
              <!-- panel body -->
              <div class="panel-body" ng-controller="AgencyController">
                <div class="tab-content">
                  <!-- tab agency -->
                  <div class="tab-pane fade in active" id="tabagency">
                    <div> 
                      <h5>Tanggal Masuk    <span style="text-indent: 15em">:30/11/2016</span></h5>
                      <h5>Tanggal Kuitansi :30/11/2016</h5>
                      <h5>Jenis Dokumen    :Legalisasi Dokumen TKI (Job Order)</h5>
                      <h5>No. Kuitansi     :463771</h5>
                      <h5>Jumlah Terbayar  :700 NT$</h5>
                      <h5>Nama Pemohon     :xian guo co ltd</h5>
                      <h5>Petugas          :herlan</h5>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- end of panel -->
          </div>

  <div class="clearfix"></div>

