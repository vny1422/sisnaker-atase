<!-- page content -->
<div class="right_col" role="main">
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">

      <div class="" role="tabpanel" data-example-id="togglable-tabs">
        <ul class="nav nav-tabs bar_tabs" role="tablist">
          <li class="active"><a href="#tabpenempatan" data-toggle="tab">Penempatan</a></li>
          <li><a href="#tabperlindungan" data-toggle="tab">Perlindungan</a></li>
          <li><a href="#tabstatistik" data-toggle="tab">Statistik</a></li>
        </ul>
      </div>

      <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade in active" id="tabpenempatan">
          <div class="dashboard_graph">
            <div class="x_panel">
              <div class="x_title">
                <div class="col-md-4">
                  <h3>DASHBOARD <small><b><?php echo $subtitle; ?></b></small></h3>
                </div>
                <div class="col-md-1">
                  <select class="form-control" name="" data-size="3" data-live-search="true" id="tahun">
                    <?php 
                    foreach ($tahunpenempatan as $row) {
                      if (!empty($row->tahun)) {
                        echo '<option value="'.$row->tahun.'">'.$row->tahun.'</option>';
                      }
                    }
                    ?>
                  </select>
                </div>
                <div class="col-md-2">
                  <select class="form-control" name="" data-size="3" data-live-search="true" id="bulan">
                    <option value="01" <?php echo '',($month == '01' ? 'selected' : '') ?>>January</option>
                    <option value="02" <?php echo '',($month == '02' ? 'selected' : '') ?>>February</option>
                    <option value="03" <?php echo '',($month == '03' ? 'selected' : '') ?>>March</option>
                    <option value="04" <?php echo '',($month == '04' ? 'selected' : '') ?>>April</option>
                    <option value="05" <?php echo '',($month == '05' ? 'selected' : '') ?>>May</option>
                    <option value="06" <?php echo '',($month == '06' ? 'selected' : '') ?>>June</option>
                    <option value="07" <?php echo '',($month == '07' ? 'selected' : '') ?>>July</option>
                    <option value="08" <?php echo '',($month == '08' ? 'selected' : '') ?>>August</option>
                    <option value="09" <?php echo '',($month == '09' ? 'selected' : '') ?>>September</option>
                    <option value="10" <?php echo '',($month == '10' ? 'selected' : '') ?>>October</option>
                    <option value="11" <?php echo '',($month == '11' ? 'selected' : '') ?>>November</option>
                    <option value="12" <?php echo '',($month == '12' ? 'selected' : '') ?>>December</option>
                  </select>
                </div>
                <div class="col-md-2">
                  <select class="form-control" name="" data-size="3" data-live-search="true" id="institusi">
                    <option value="all">All</option>
                    <?php 
                    foreach ($institusi as $row) {
                      if ($row->nameinstitution != "Pusat") {
                        echo '<option value="'.$row->idinstitution.'">'.$row->nameinstitution.'</option>';
                      }
                    }
                    ?>
                  </select>
                </div>
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                </ul>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <br />

                <div id="loader-dashboard-penempatan"></div>

                <div id="penempatan_parent" style="display:none;">

                  <div class="row">

                    <div class="col-lg-4 col-md-6">
                      <div class="panel panel-success">
                        <div class="panel-heading">
                          <div class="row">
                            <div class="col-xs-2">
                              <i class="fa fa-venus-mars fa-5x"></i>
                            </div>
                            <div class="col-xs-10 text-right">
                              <div><h2 class="dtahun"></h2></div>
                              <div><h5>(Jenis Kelamin)</h5></div>
                            </div>
                          </div>
                        </div>
                        <div class="panel-body">
                          <div class="row">
                            <div class="col-lg-8 col-xs-10" style="height: 250px" id="donut-jktahun"></div>
                            <div class="col-lg-4 col-xs-2" style="text-align: right"><h1 id="sumjktahun"></h1></div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                      <div class="panel panel-success">
                        <div class="panel-heading">
                          <div class="row">
                            <div class="col-xs-2">
                              <i class="fa fa-venus-mars fa-5x"></i>
                            </div>
                            <div class="col-xs-10 text-right">
                              <div><h2 class="dbulan"></h2></div>
                              <div><h5>(Jenis Kelamin)</h5></div>
                            </div>
                          </div>
                        </div>
                        <div class="panel-body">
                          <div class="row">
                            <div class="col-lg-8 col-xs-10" style="height: 250px" id="donut-jkbulan"></div>
                            <div class="col-lg-4 col-xs-2" style="text-align: right"><h1 id="sumjkbulan"></h1></div>
                          </div>
                        </div>
                      </div>
                    </div>

                  </div>
                  <br />

                  <div class="row">

                    <div class="col-lg-4 col-md-6">
                      <div class="panel panel-info">
                        <div class="panel-heading">
                          <div class="row">
                            <div class="col-xs-2">
                              <i class="fa fa-group fa-5x"></i>
                            </div>
                            <div class="col-xs-10 text-right">
                              <div><h2 class="dtahun"></h2></div>
                              <div><h5>(Sektor)</h5></div>
                            </div>
                          </div>
                        </div>
                        <div class="panel-body">
                          <div class="row">
                            <div class="col-lg-8 col-xs-10" style="height: 250px" id="donut-sektortahun"></div>
                            <div class="col-lg-4 col-xs-2" style="text-align: right"><h1 id="sumsektahun"></h1></div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                      <div class="panel panel-info">
                        <div class="panel-heading">
                          <div class="row">
                            <div class="col-xs-2">
                              <i class="fa fa-group fa-5x"></i>
                            </div>
                            <div class="col-xs-10 text-right">
                              <div><h2 class="dbulan"></h2></div>
                              <div><h5>(Sektor)</h5></div>
                            </div>
                          </div>
                        </div>
                        <div class="panel-body">
                          <div class="row">
                            <div class="col-lg-8 col-xs-10" style="height: 250px" id="donut-sektorbulan"></div>
                            <div class="col-lg-4 col-xs-2" style="text-align: right"><h1 id="sumsekbulan"></h1></div>
                          </div>
                        </div>
                      </div>
                    </div>

                  </div>
                  <br />

                  <div class="row">
                    <div class="col-lg-12">
                      <div class="panel panel-default">
                        <div class="panel-heading">
                          <div class="row">
                            <div class="col-xs-1">
                              <i class="fa fa-bar-chart-o fa-5x"></i>
                            </div>
                            <div class="col-xs-11">
                              <h3 id="gtahun"></h3><h5> (Jenis Pekerjaan)</h5>
                            </div>
                          </div>
                        </div>

                        <div class="panel-body">
                          <div id="graph-jptahun"></div>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>

        <div role="tabpanel" class="tab-pane fade in" id="tabperlindungan">
          <div class="dashboard_graph">
            <div class="x_panel">
              <div class="row x_title">
                <div class="col-md-4">
                  <h3>DASHBOARD <small><b><?php echo $subtitle; ?></b></small></h3>
                </div>
                <div class="col-md-4">
                  <select class="form-control" name="" data-size="3" data-live-search="true" id="institusi_perlindungan">
                    <option value="all">All</option>
                    <?php 
                      foreach ($institusi as $row) {
                        if ($row->idinstitution != 6) {
                          echo '<option value="'.$row->idinstitution.'">'.$row->nameinstitution.'</option>';
                        }
                      }
                    ?>
                  </select>
                </div>
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                </ul>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <br />

                <div id="loader-dashboard-perlindungan"></div>

                <div id="perlindungan_parent" style="display:none;">
                  <!-- Statistik Kasus -->
                  <div class="row">
                    <!-- KASUS TAHUN INI -->
                    <div class="col-lg-6 col-md-6">
                      <div class="panel" id="kasus_tahunan_panel">
                        <div class="panel-heading">
                          <div class="row">
                            <div class="col-xs-2">
                              <i class="fa fa-line-chart fa-5x"></i>
                            </div>
                            <div class="col-xs-10 text-right">
                              <div class="huge" id="kasus_tahunan_performance"></div>
                              <div>Kasus Tahun ini</div>
                            </div>
                          </div>
                        </div>
                        <div class="panel-body">
                          <div class="row">
                            <div class="col-lg-3 barlabel">Selesai</div>
                            <div class="col-lg-9">
                              <div class="progress">
                                <div class="progress-bar progress-bar-success" id="kasus_tahunan_finished" role="progressbar" aria-valuemax="100"></div>
                              </div>
                            </div>
                            <div class="col-lg-3 barlabel">Proses</div>
                            <div class="col-lg-9">
                              <div class="progress">
                                <div class="progress-bar progress-bar-danger" id="kasus_tahunan_inprocess" role="progressbar" aria-valuemax="100"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <a id="kasus_tahunan_uri" href="">
                          <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                          </div>
                        </a>
                      </div>
                    </div>

                    <!-- KASUS BULAN INI -->
                    <div class="col-lg-6 col-md-6">
                      <div class="panel panel-info">
                        <div class="panel-heading">
                          <div class="row">
                            <div class="col-xs-2">
                              <i class="fa fa-pencil fa-5x"></i>
                            </div>
                            <div class="col-xs-10 text-right">
                              <div class="huge" id="kasus_bulanan_performance"></div>
                              <div>Kasus Bulan ini</div>
                            </div>
                          </div>
                        </div>
                        <div class="panel-body">
                          <div class="row">
                            <div class="col-lg-3 barlabel">Selesai</div>
                            <div class="col-lg-9">
                              <div class="progress">
                                <div class="progress-bar progress-bar-success" id="kasus_bulanan_finished" role="progressbar" aria-valuemax="100"></div>
                              </div>
                            </div>
                            <div class="col-lg-3 barlabel">Proses</div>
                            <div class="col-lg-9">
                              <div class="progress">
                                <div class="progress-bar progress-bar-danger" id="kasus_bulanan_inprocess" role="progressbar" aria-valuemax="100"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <a id="kasus_bulanan_uri" href="">
                          <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                          </div>
                        </a>
                      </div>
                    </div>

                  </div>

                  <!-- Statistik Petugas -->
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="panel panel-default">
                        <div class="panel-heading">
                          <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Statistik Petugas Tahun ini</h3>
                        </div>
                        <div class="panel-body">
                          <div class="row" id="officers_performance">
                            <!-- KDEI Officer Performance -->
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-12" id="maintable">
                      <div class="panel with-nav-tabs panel-info">
                        <div class="panel-heading" id="tablekasus">
                          <ul class="nav nav-tabs" id="tabskasus">
                            <li class="active">
                              <a href="#tab1default" data-toggle="tab">
                                <i class="fa fa-pencil"></i>
                                <strong>Kasus Dalam Proses</strong>
                              </a>
                            </li>
                            <li>
                              <a href="#tab2default" data-toggle="tab">
                                <i class="fa fa-check"></i>
                                <strong>Kasus Selesai</strong>
                              </a>
                            </li>
                          </ul>
                        </div>
                        <div class="panel-body">
                          <div class="tab-content">
                            <div class="tab-pane fade in active table-responsive" id="tab1default">
                              <table class="table table-striped table-bordered table-hover" id="tableproses">
                                <thead>
                                  <tr class="btn-danger">
                                    <th class="text-center" style="width:5%">Nomor</th>
                                    <th class="text-center" style="width:25%">Nama TKI</th>
                                    <th class="text-center" style="width:10%">Paspor</th>
                                    <th class="text-center" style="width:5%">Status TKI</th>
                                    <th class="text-center" style="width:20%">Klasifikasi Kasus</th>
                                    <th class="text-center" style="width:15%">Keyword</th>
                                    <th class="text-center" style="width:15%">Petugas</th>
                                    <th class="text-center" style="width:5%">Interval (hari)</th>
                                  </tr>
                                </thead>
                                <tbody>
                                </tbody>
                              </table>
                            </div>
                            <div class="tab-pane fade table-responsive" id="tab2default">
                              <table class="table table-striped table-bordered table-hover" id="tableselesai">
                                <thead>
                                  <tr class="btn-success">
                                    <th class="text-center" style="width:5%">Nomor</th>
                                    <th class="text-center" style="width:25%">Nama TKI</th>
                                    <th class="text-center" style="width:10%">Paspor</th>
                                    <th class="text-center" style="width:5%">Status TKI</th>
                                    <th class="text-center" style="width:20%">Klasifikasi Kasus</th>
                                    <th class="text-center" style="width:15%">Keyword</th>
                                    <th class="text-center" style="width:15%">Petugas</th>
                                    <th class="text-center" style="width:5%">Interval (hari)</th>
                                  </tr>
                                </thead>
                                <tbody>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Chart -->
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="panel panel-success">
                        <div class="panel-heading">
                          <div class="row">
                            <div class="panel-title col-lg-3">
                              <h4><i class="fa fa-bar-chart-o fa-fw"></i> Statistik Kasus Detail Tahun </h4>
                            </div>
                            <div class="col-lg-3">
                              <select class="form-control col-xs-7" name="" data-size="3" data-live-search="true" id="tahun_perlindungan">
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="panel-body">
                          <!-- Total Kasus Dalam Tahun Terpilih -->
                          <div class="row">
                            <div class="col-lg-3">
                              <div class="panel panel-primary">
                                <div class="panel-heading">
                                  <div class="row">
                                    <div class="col-xs-2">
                                      <i class="fa fa-list-alt fa-4x"></i>
                                    </div>
                                    <div class="col-xs-10 text-right">
                                      <div class="huge" id="total-year"></div>
                                      <div>Jumlah Total Kasus</div>
                                    </div>
                                  </div>
                                </div>
                                <div class="panel-footer">
                                  <span class="pull-left">Lihat Grafik untuk Detail</span>
                                  <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                  <div class="clearfix"></div>
                                </div>
                              </div>
                            </div>

                            <div class="col-lg-9">
                              <div class="text-center">
                                <h4><label><u>Jumlah Kasus Setiap Bulan</u></label></h4>
                              </div>
                              <div id="graph-problem"></div>
                            </div>
                          </div>
                          <div>
                            <div style="height:15px; border-bottom:1px dotted #ABABAB; margin: 10px 0 20px 0"></div>
                          </div>
                          <!-- Total Uang Diselamatkan Dalam Tahun Terpilih -->
                          <div class="row">
                            <div class="col-lg-3">
                              <div class="panel panel-warning">
                                <div class="panel-heading">
                                  <div class="row">
                                    <div class="col-xs-2">
                                      <i class="fa fa-usd fa-4x"></i>
                                    </div>
                                    <div class="col-xs-10 text-right">
                                      <div class="huge" id="money-year"></div>
                                      <div>Jumlah Total Uang</div>
                                    </div>
                                  </div>
                                </div>
                                <div class="panel-footer">
                                  <span class="pull-left">Lihat Grafik untuk Detail</span>
                                  <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                  <div class="clearfix"></div>
                                </div>
                              </div>
                            </div>

                            <div class="col-lg-9">
                              <div class="text-center">
                                <h4><label><u>Jumlah Uang Yang Diselamatkan (<?php echo $namacurrency?>)</u></label></h4>
                                <div id="graph-money"></div>
                              </div>
                            </div>
                          </div>
                        </div>

                      </div>
                    </div>
                  </div>

                </div>

                <!-- View Data Modal -->
                <?php include 'modal_view.php' ?>

                <div class="clearfix"></div>
            </div>
          </div>
        </div>
      </div>

      <div role="tabpanel" class="tab-pane fade in" id="tabstatistik">
        <div class="dashboard_graph">
          <div class="x_panel">
            <div class="x_title">
              <div class="col-md-4">
                <h3>DASHBOARD <small><b><?php echo $subtitle; ?></b></small></h3>
              </div>
              <div class="col-md-1">
                <select class="form-control" name="" data-size="3" data-live-search="true" id="tahun_statistik">
                  <?php 
                  foreach ($tahunstatistik as $row) {
                    if (!empty($row->tahun)) {
                      echo '<option value="'.$row->tahun.'">'.$row->tahun.'</option>';
                    }
                  }
                  ?>
                </select>
              </div>
              <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
              </ul>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <br />

              <div class="row">
                <div class="col-lg-12">
                  <div class="panel panel-success">
                    <div class="panel-heading">
                      <div class="row">
                        <div class="col-xs-1">
                          <i class="fa fa-line-chart fa-5x"></i>
                        </div>
                        <div class="col-xs-11">
                          <h3 id="stat_penempatan_tahun"></h3><h5> (Antar Institusi)</h5>
                        </div>
                      </div>
                    </div>

                    <div class="panel-body">
                      <div id="graph-stat-penempatan-tahun"></div>
                    </div>
                  </div>
                </div>
              </div>
              <br />

              <div class="row">
                <div class="col-lg-12">
                  <div class="panel panel-primary">
                    <div class="panel-heading">
                      <div class="row">
                        <div class="col-xs-1">
                          <i class="fa fa-line-chart fa-5x"></i>
                        </div>
                        <div class="col-xs-11">
                          <h3 id="stat_kasus_tahun"></h3><h5> (Antar Institusi)</h5>
                        </div>
                      </div>
                    </div>

                    <div class="panel-body">
                      <div id="graph-stat-kasus-tahun"></div>
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
</div>

<script id="officer_performance_template" type="text/template">
  <div class="col-lg-4 col-md-6">
    <div class="panel panel-info">
      <div class="panel-heading">
        <div class="row">
          <div class="col-xs-3">
            <img class="img-circle" alt="" style="width:65px;height:65px" src="{{ officerPicture }}" />
          </div>
          <div class="col-xs-9 text-right">
            <div class="huge">{{ officerPerformance }}</div>
            <div>{{ officerName }}</div>
          </div>
        </div>
      </div>
      <a href="{{ officerUri }}">
        <div class="panel-footer">
          <span class="pull-left">
            {{ officerCasesAll }} Kasus
            ( <i class="fa fa-check" style="color: green;"> {{ officerCasesFinished }}</i>
            <i></i>
            <i class="fa fa-close" style="color: red;padding-left:8px;"> {{ officerCasesUnfinished }}</i> )
          </span>
          <span class="pull-right"><i class="fa fa-arrow-circle-right"> Details</i></span>
          <div class="clearfix"></div>
        </div>
      </a>
    </div>
  </div>
</script>

<script type="text/javascript">
  $(document).ready(function () {
    $('select').selectpicker();

    $('.dtahun').html("Penempatan Tahun " + $("#tahun").val());
    $('.dbulan').html("Penempatan Bulan " + $("#bulan option:selected").text());
    $('#gtahun').html("Statistik Penempatan Tahun " + $("#tahun").val());
    $('#stat_penempatan_tahun').html("Statistik Total Penempatan Tahun " + $("#tahun_statistik").val());
    $('#stat_kasus_tahun').html("Statistik Total Kasus Tahun " + $("#tahun_statistik").val());

    $(".modal-wide").on("show.bs.modal", function() {
      var height = $(window).height() - 200;
      $(this).find(".modal-body").css("max-height", height);
    });

    tbProses = $('#tableproses').DataTable({"bSort" : false,"bLengthChange": false, "columnDefs": [
      { className: "text-center", "targets": [0, 7] } ]
    });
    tbSelesai = $('#tableselesai').DataTable({"bSort" : false,"bLengthChange": false, "columnDefs": [
      { className: "text-center", "targets": [0, 7] } ]
    });

    $('#tableproses_filter').html("\
      <form class='form-inline' style='margin-bottom:10px'>\
        <div class='col-sm-offset-1 form-group'><label>Search: </label><input type='text' class='form-control' id='tbproall'></div>\
      </form>"
    );
    $('#tableselesai_filter').html("\
      <form class='form-inline' style='margin-bottom:10px'>\
        <div class='col-sm-offset-1 form-group'><label>Search: </label><input type='text' class='form-control' id='tbselall'></div>\
      </form>"
    );

    $("#tbproall").keyup(function() {
      tbProses.search($("#tbproall").val()).draw();
    });
    $("#tbselall").keyup(function() {
      tbSelesai.search($("#tbselall").val()).draw();
    });

    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
      $(window).trigger('resize');
      tbProses.columns.adjust().draw();
      tbSelesai.columns.adjust().draw();
    });

    $("#downloadform").click(function() {
      var idProblem = $("#downloadform").val();
      window.open("<?php echo site_url('pusat/convertToPDF') ?>" + "/" + idProblem);
    });

    loadDashboardPenempatan();
    loadDashboardPerlindungan();
    loadDashboardStatistik();
  });

  $("#institusi_perlindungan").change(function(){
    loadDashboardPerlindungan();
  });

  $("#tahun_perlindungan").change(function(){
    loadGraph();
  });

  $("#tahun").change(function(){
    onPlacementYearChange();
  });

  $("#bulan").change(function(){
    onPlacementMonthChange();
  });

  $("#institusi").change(function(){
    onPlacementInstitutionChange();
  });

  $("#tahun_statistik").change(function(){
    loadDashboardStatistik();
  });

  function loadDashboardPerlindungan() {
    $("#institusi_perlindungan").prop('disabled', true);
    $("#perlindungan_parent").hide();
    $("#loader-dashboard-perlindungan").show();
    tbProses.clear();
    tbSelesai.clear();
    $("#officers_performance").html("");
    $("#total-year").html("");
    $("#money-year").html("");
    $("#graph-problem").html("");
    $("#graph-money").html("");

    $.ajax({
      url     : "<?php echo site_url('pusat/collect_dashboard_perlindungan_info')?>",
      data    : {"idinstitution":$("#institusi_perlindungan").val()},
      type    : "post",
      dataType  : "json",
      success   : function(data) {
        // Load Graph
        var options = "";
        for (var i = 0; i < data.list_of_years.length; i++) {
          var year = data.list_of_years[i].tahun;

          if (year != null) {
            options += '<option value="' + year + '">' + year + '</option>';
          }
        }
        $("#tahun_perlindungan").html(options);
        $("#tahun_perlindungan").selectpicker('refresh');
        loadGraph();

        // Load Cases
        loadCases(data.cases_process, tbProses);
        loadCases(data.cases_finished, tbSelesai);
        $('a[data-toggle="modal"]').click(function() {
          getCaseDetail($(this).attr('id'));
        });

        // Load Cases this Year
        var yearScaleTotal = data.kasus_finish_this_year + data.kasus_inprocess_this_year;
        if (yearScaleTotal > 0) {
          $("#kasus_tahunan_finished").attr("style", "min-width: 2em;width: " + ((100 * data.kasus_finish_this_year) / yearScaleTotal) + "%;");
          $("#kasus_tahunan_inprocess").attr("style", "min-width: 2em;width: " + ((100 * data.kasus_inprocess_this_year) / yearScaleTotal) + "%;");
        } else {
          $("#kasus_tahunan_finished").attr("style", "min-width: 2em;width: 0%");
          $("#kasus_tahunan_inprocess").attr("style", "min-width: 2em;width: 0%");
        }
        $("#kasus_tahunan_panel").addClass(data.panel_color);
        $("#kasus_tahunan_performance").html(data.year_performance.toFixed(1) + '%');
        $("#kasus_tahunan_finished").html(data.kasus_finish_this_year);
        $("#kasus_tahunan_inprocess").html(data.kasus_inprocess_this_year);
        $("#kasus_tahunan_uri").attr("href", getBaseUrl('pusat/data/year/' + $("#institusi_perlindungan").val()));

        // Load Cases this Month
        var monthScaleTotal = data.kasus_finish_this_month + data.kasus_inprocess_this_month;
        if (monthScaleTotal > 0) {
          $("#kasus_bulanan_finished").attr("style", "min-width: 2em;width: " + ((100 * data.kasus_finish_this_month) / monthScaleTotal) + "%;");
          $("#kasus_bulanan_inprocess").attr("style", "min-width: 2em;width: " + ((100 * data.kasus_inprocess_this_month) / monthScaleTotal) + "%;");
        } else {
          $("#kasus_bulanan_finished").attr("style", "min-width: 2em;width: 0%");
          $("#kasus_bulanan_inprocess").attr("style", "min-width: 2em;width: 0%");
        }
        $("#kasus_bulanan_performance").html(data.month_performance);
        $("#kasus_bulanan_finished").html(data.kasus_finish_this_month);
        $("#kasus_bulanan_inprocess").html(data.kasus_inprocess_this_month);
        $("#kasus_bulanan_uri").attr("href", getBaseUrl('pusat/data/month/' + $("#institusi_perlindungan").val()));

        // Load Officers Performance this Year
        var officerPerformanceTemplate = $("#officer_performance_template").html();
        for (var officerUsername in data.officers_name) {
          if (data.officers_name.hasOwnProperty(officerUsername)) {
            var officerData = {
              officerPicture: function() {
                if (data.officers_picture[officerUsername] && data.officers_picture[officerUsername].length > 0) {
                  return getBaseUrl('assets/images/' + data.officers_picture[officerUsername]);
                } else {
                  return getBaseUrl('assets/images/user.png');
                }
              },
              officerPerformance: data.officers_performance[officerUsername][1].toFixed(1) + '%',
              officerName: data.officers_name[officerUsername],
              officerUri: getBaseUrl('pusat/officer/' + officerUsername),
              officerCasesAll: data.officers_performance[officerUsername][0],
              officerCasesFinished: data.officers_performance[officerUsername][2],
              officerCasesUnfinished: data.officers_performance[officerUsername][3]
            };

            var html = Mustache.render(officerPerformanceTemplate, officerData);
            $("#officers_performance").append(html);
          }
        }

        $(window).trigger('resize');
        $("#loader-dashboard-perlindungan").hide();
        $("#perlindungan_parent").show();
        $("#institusi_perlindungan").prop('disabled', false);
      }
    });
  }

  function loadDashboardPenempatan() {
    $("#tahun").prop('disabled', true);
    $("#bulan").prop('disabled', true);
    $("#institusi").prop('disabled', true);
    $("#penempatan_parent").hide();
    $("#loader-dashboard-penempatan").show();

    $.ajax({
      url     : "<?php echo site_url('pusat/get_info_year_dashboard_penempatan')?>",
      data    : {"y":$("#tahun").val(),"m":$("#bulan").val(),"i":$("#institusi").val()},
      type    : "post",
      dataType  : "json",
      success   : function(data) {
        $("#sumjktahun").html(data[0]);
        $("#sumjkbulan").html(data[2]);
        $("#sumsektahun").html(data[4]);
        $("#sumsekbulan").html(data[6]);

        var datajktahun = [];
        for (i = 0; i < data[1].length; i++) {
          datajktahun.push({label: data[1][i].tkjk, value: data[1][i].total, total: data[0]});
        }
        if (datajktahun.length == 0) {
          datajktahun.push({label: "", value: ""});
        }

        jktahun = Morris.Donut({
          element: 'donut-jktahun',
          data: datajktahun,
          resize: true,
          formatter: function (y, datas) { return y + " (" + Math.round(y/datas.total*100) + "%)"}
        });

        if(datajktahun.length > 1) {
          jktahun.options.colors = ["#0A4C20","#58CC7E"];
        } else if (datajktahun.length == 1 && datajktahun[0].label == "L") {
          jktahun.options.colors = ["#0A4C20"];
        } else if (datajktahun.length == 1 && datajktahun[0].label == "P") {
          jktahun.options.colors = ["#58CC7E"];
        }
        jktahun.redraw();

        var datajkbulan = [];
        for (i = 0; i < data[3].length; i++) {
          datajkbulan.push({label: data[3][i].tkjk, value: data[3][i].total, total: data[2]});
        }
        if (datajkbulan.length == 0) {
          datajkbulan.push({label: "", value: ""});
        }

        jkbulan = Morris.Donut({
          element: 'donut-jkbulan',
          data: datajkbulan,
          resize: true,
          formatter: function (y, datas) { return y + " (" + Math.round(y/datas.total*100) + "%)"}
        });

        if(datajkbulan.length > 1) {
          jkbulan.options.colors = ["#0A4C20","#58CC7E"];
        } else if (datajkbulan.length == 1 && datajkbulan[0].label == "L") {
          jkbulan.options.colors = ["#0A4C20"];
        } else if (datajkbulan.length == 1 && datajkbulan[0].label == "P") {
          jkbulan.options.colors = ["#58CC7E"];
        }
        jkbulan.redraw();

        var datasektortahun = [];
        for (i = 0; i < data[5].length; i++) {
          if (data[5][i].sektor == '1') {
            datasektortahun.push({label: 'Informal', value: data[5][i].total, total: data[4]});
          } else if (data[5][i].sektor == '2') {
            datasektortahun.push({label: 'Formal', value: data[5][i].total, total: data[4]});
          }
        }
        if (datasektortahun.length == 0) {
          datasektortahun.push({label: "", value: ""});
        }

        sektortahun = Morris.Donut({
          element: 'donut-sektortahun',
          data: datasektortahun,
          resize: true,
          formatter: function (y, datas) { return y + " (" + Math.round(y/datas.total*100) + "%)"}
        });

        if(datasektortahun.length > 1) {
          sektortahun.options.colors = ["#58A8CC","#0A384C"];
        } else if (datasektortahun.length == 1 && datasektortahun[0].label == "Informal") {
          sektortahun.options.colors = ["#58A8CC"];
        } else if (datasektortahun.length == 1 && datasektortahun[0].label == "Formal") {
          sektortahun.options.colors = ["#0A384C"];
        }
        sektortahun.redraw();

        var datasektorbulan = [];
        for (i = 0; i < data[7].length; i++) {
          if (data[7][i].sektor == '1') {
            datasektorbulan.push({label: 'Informal', value: data[7][i].total, total: data[6]});
          } else if (data[7][i].sektor == '2') {
            datasektorbulan.push({label: 'Formal', value: data[7][i].total, total: data[6]});
          }
        }
        if (datasektorbulan.length == 0) {
          datasektorbulan.push({label: "", value: ""});
        }

        sektorbulan = Morris.Donut({
          element: 'donut-sektorbulan',
          data: datasektorbulan,
          resize: true,
          formatter: function (y, datas) { return y + " (" + Math.round(y/datas.total*100) + "%)"}
        });

        if(datasektorbulan.length > 1) {
          sektorbulan.options.colors = ["#58A8CC","#0A384C"];
        } else if (datasektorbulan.length == 1 && datasektorbulan[0].label == "Informal") {
          sektorbulan.options.colors = ["#58A8CC"];
        } else if (datasektorbulan.length == 1 && datasektorbulan[0].label == "Formal") {
          sektorbulan.options.colors = ["#0A384C"];
        }
        sektorbulan.redraw();

        var datajptahun = [];
        for (i = 0; i < data[9].length; i++) {
          var datajpmonth = {month: data[9][i].bulan, total: data[9][i].total};
          for (j = 0; j < data[8].length; j++) {
            datajpmonth[data[8][j]] = data[9][i][data[8][j]];
          }
          datajptahun.push(datajpmonth);
        }

        jptahun = Morris.Bar({
          element: 'graph-jptahun',
          data: datajptahun,
          xkey: 'month',
          ykeys: data[8],
          yLabelFormat: function(y){return y != Math.round(y)?'':y;},
          hoverCallback: function(index, options, content, row) {
            var contents = $.trim(content);
            contents = contents.replace(/\n/g, "");
            var total = row.total;
            for (key in row) {
              if(key != "month" && key != "total") {
                var replaced = "  " + key + ":  " + row[key];
                if(total == 0) {
                  newf = "  " + key + ":  " + row[key] + " (0%)";
                } else {
                  newf = "  " + key + ":  " + row[key] + " (" + (row[key]/total*100) + '%)';
                }
                contents = contents.replace(replaced,newf);
              }
            }
            return contents;
          },
          labels: data[8],
          stacked: true,
          resize: true
        });

        $(window).trigger('resize');
        $("#loader-dashboard-penempatan").hide();
        $("#penempatan_parent").show();
        $("#tahun").prop('disabled', false);
        $("#bulan").prop('disabled', false);
        $("#institusi").prop('disabled', false);
      }
    });
  }

  function loadDashboardStatistik() {
    $("#tahun_statistik").prop('disabled', true);
    $('#stat_penempatan_tahun').html("Statistik Total Penempatan Tahun " + $("#tahun_statistik").val());
    $('#stat_kasus_tahun').html("Statistik Total Kasus Tahun " + $("#tahun_statistik").val());
    $("#graph-stat-penempatan-tahun").html("");
    $("#graph-stat-kasus-tahun").html("");

    $.ajax({
      url     : "<?php echo site_url('pusat/get_info_year_dashboard_statistik')?>",
      data    : {"y":$("#tahun_statistik").val()},
      type    : "post",
      dataType  : "json",
      success   : function(data){
        var dataplacementtahun = [];
        if (data[0].length > 0) {
          for (i = 0; i < data[1].length; i++) {
            var dataplacementmonth = {month: data[1][i].bulan, total: data[1][i].total};
            for (j = 0; j < data[0].length; j++) {
              dataplacementmonth[data[0][j]] = data[1][i][data[0][j]];
            }
            dataplacementtahun.push(dataplacementmonth);
          }

          var morrisLinePenempatan = Morris.Line({
            element: 'graph-stat-penempatan-tahun',
            behaveLikeLine: true,
            resize: true,
            parseTime: false,
            data: dataplacementtahun,
            xkey: 'month',
            ykeys: data[0],
            labels: data[0]
          });
        } else {
          var morrisLinePenempatan = Morris.Line({
            element: 'graph-stat-penempatan-tahun',
            data: [],
            xkey: '',
            ykeys: [],
            labels: []
          });
        }
        
        var datacasetahun = [];
        if (data[2].length > 0) {
          for (i = 0; i < data[3].length; i++) {
            var datacasemonth = {month: data[3][i].bulan, total: data[3][i].total};
            for (j = 0; j < data[2].length; j++) {
              datacasemonth[data[2][j]] = data[3][i][data[2][j]];
            }
            datacasetahun.push(datacasemonth);
          }

          var morrisLineKasus = Morris.Line({
            element: 'graph-stat-kasus-tahun',
            behaveLikeLine: true,
            resize: true,
            parseTime: false,
            data: datacasetahun,
            xkey: 'month',
            ykeys: data[2],
            labels: data[2]
          });
        } else {
          var morrisLineKasus = Morris.Line({
            element: 'graph-stat-kasus-tahun',
            data: [],
            xkey: '',
            ykeys: [],
            labels: []
          });
        }
        
        $("#tahun_statistik").prop('disabled', false);
      }
    });
  }

  function getBaseUrl(path) {
    var baseUrl = '<?php echo base_url(); ?>';

    return baseUrl + path;
  }

  function loadCases(casesData, table) {
    for (var idxCase = 0; idxCase < casesData.length; idxCase++) {
      table.row.add( [
        idxCase + 1,
        '<a href="#windowModal" data-toggle="modal" id="' + casesData[idxCase].idmasalah + '">' + (
          casesData[idxCase].jumlah > 1 ? 
          casesData[idxCase].namatki.toUpperCase() + " (" + casesData[idxCase].jumlah + " orang)" : 
          casesData[idxCase].namatki.toUpperCase()
        ) + '</a>',
        casesData[idxCase].paspor,
        (casesData[idxCase].statustki == 1 ? "Resmi" : "Kaburan"),
        casesData[idxCase].klasifikasi,
        casesData[idxCase].keyword,
        casesData[idxCase].nama,
        casesData[idxCase].lama
      ] );
    }

    table.draw();
  }

  function getCaseDetail(idProblem) {
    $.post("<?php echo site_url('pusat/modal')?>",{id:idProblem},
      function(datas) {
        var obj = JSON.parse(datas);

        $("#casesiap").hide();

        if(obj[2].length > 0) {
          $("#berkaskasus").html('');
          for(i=0; i<obj[2].length; i++) {
            var dt = '';

            dt = '<tr>';
            dt += ' <td><a href="'+window.location.protocol+'//'+window.location.hostname+'/'+obj[2][i].filename+'" target="_blank">'+obj[2][i].filename+'</a></td>';
            dt += '</tr>';

            $("#berkaskasus").append(dt);
          }
        } else {
          $("#berkaskasus").html('');
          $("#berkaskasus").append("<tr><td>Berkas kasus tidak tersedia!</td></tr>");
        }

        $("#downloadform").val(obj[0].idmasalah);
        $("#inputpaspor").text(obj[1][0].paspor);
        $("#namebmi").text(obj[1][0].namatki);
        $("#jk").text(obj[1][0].jk);
        $("#arc").text(obj[1][0].arc);
        $("#phone").text(obj[1][0].handphone);
        $("#jenispekerjaan").text(obj[0].jenis);
        $("#statustki").text(obj[0].statustki);
        $("#agensitw").text(obj[0].agensi);
        $("#cpagensitw").text(obj[0].cpagensi);
        $("#hpagensitw").text(obj[0].teleponagensi);
        $("#pptkis").text(obj[0].pptkis);
        $("#majikan").text(obj[0].majikan);
        $("#organisasi").text(obj[0].organisasi);
        $("#petugaspenanganan").text(obj[0].petugaspenanganan);
        $("#nomorkasus").text(obj[0].nomormasalah);
        $("#pelapor").text(obj[0].namapelapor);
        $("#tlppelapor").text(obj[0].teleponpelapor);
        $("#tglpengaduan").text(obj[0].tanggalpengaduan);
        $("#media").text(obj[0].media);
        $("#klasifikasikasus").text(obj[0].klasifikasi);
        $("#permasalahan").text(obj[0].permasalahan);
        $("#tuntutan").text(obj[0].tuntutan);
        $("#tindaklanjut").html(obj[0].tindaklanjut);
        $("#nominal").text(obj[0].uang);
        $("#statusmasalah").text(obj[0].statusmasalah);
        $("#namacurrency").text(("Nominal Yang Diselamatkan " + obj[0].currencyname + " :"));
      }
    );
  }

  function loadGraph() {
    $("#tahun_perlindungan").prop('disabled', true);
    $("#total-year").html("");
    $("#money-year").html("");
    $("#graph-problem").html("");
    $("#graph-money").html("");

    $.ajax({
      url     : "<?php echo site_url('pusat/get_info_year_dashboard_perlindungan')?>",
      data    : {"y":$("#tahun_perlindungan").val(),"idinstitution":$("#institusi_perlindungan").val()},
      type    : "post",
      dataType  : "json",
      success   : function(data){
        $("#total-year").html(data[0]);
        $("#money-year").html(data[2]);

        var morrisArea = Morris.Area({
          element: 'graph-problem',
          behaveLikeLine: true,
          parseTime: false,
          resize: true,
          lineColors:['blue','green','red'],
          fillOpacity: 0.6,
          data: data[1],
          xkey: 'bulan',
          ykeys: ['total', 'fin', 'pro'],
          labels: ['Total', 'Selesai', 'Proses']
        });

        var morrisBar = Morris.Bar({
          element: 'graph-money',
          behaveLikeLine: true,
          resize: true,
          parseTime: false,
          barSizeRatio:0.8,
          barColors: ['orange'],
          data: data[3],
          xkey: 'bulan',
          ykeys: ['uang'],
          labels: ['Total']
        });

        $("#tahun_perlindungan").prop('disabled', false);
      }
    });
  }

  function onPlacementYearChange() {
    $("#tahun").prop('disabled', true);
    $("#bulan").prop('disabled', true);
    $("#institusi").prop('disabled', true);
    $("#penempatan_parent").hide();
    $("#loader-dashboard-penempatan").show();

    $('.dtahun').html("Penempatan Tahun " + $("#tahun").val());
    $('#gtahun').html("Statistik Penempatan Tahun " + $("#tahun").val());

    $.ajax({
      url     : "<?php echo site_url('pusat/get_info_year_dashboard_penempatan')?>",
      data    : {"y":$("#tahun").val(),"m":$("#bulan").val(),"i":$("#institusi").val()},
      type    : "post",
      dataType  : "json",
      success   : function(data){
        $("#sumjktahun").html(data[0]);
        $("#sumjkbulan").html(data[2]);
        $("#sumsektahun").html(data[4]);
        $("#sumsekbulan").html(data[6]);

        var datajktahun = [];
        for (i = 0; i < data[1].length; i++) {
          datajktahun.push({label: data[1][i].tkjk, value: data[1][i].total, total: data[0]});
        }
        if (datajktahun.length == 0) {
          datajktahun.push({label: "", value: ""});
        }

        if(datajktahun.length > 1) {
          jktahun.options.colors = ["#0A4C20","#58CC7E"];
        } else if (datajktahun.length == 1 && datajktahun[0].label == "L") {
          jktahun.options.colors = ["#0A4C20"];
        } else if (datajktahun.length == 1 && datajktahun[0].label == "P") {
          jktahun.options.colors = ["#58CC7E"];
        }
        jktahun.setData(datajktahun);

        var datajkbulan = [];
        for (i = 0; i < data[3].length; i++) {
          datajkbulan.push({label: data[3][i].tkjk, value: data[3][i].total, total: data[2]});
        }
        if (datajkbulan.length == 0) {
          datajkbulan.push({label: "", value: ""});
        }

        if(datajkbulan.length > 1) {
          jkbulan.options.colors = ["#0A4C20","#58CC7E"];
        } else if (datajkbulan.length == 1 && datajkbulan[0].label == "L") {
          jkbulan.options.colors = ["#0A4C20"];
        } else if (datajkbulan.length == 1 && datajkbulan[0].label == "P") {
          jkbulan.options.colors = ["#58CC7E"];
        }
        jkbulan.setData(datajkbulan);

        var datasektortahun = [];
        for (i = 0; i < data[5].length; i++) {
          if (data[5][i].sektor == '1') {
            datasektortahun.push({label: 'Informal', value: data[5][i].total, total: data[4]});
          } else if (data[5][i].sektor == '2') {
            datasektortahun.push({label: 'Formal', value: data[5][i].total, total: data[4]});
          }
        }
        if (datasektortahun.length == 0) {
          datasektortahun.push({label: "", value: ""});
        }

        if(datasektortahun.length > 1) {
          sektortahun.options.colors = ["#58A8CC","#0A384C"];
        } else if (datasektortahun.length == 1 && datasektortahun[0].label == "Informal") {
          sektortahun.options.colors = ["#58A8CC"];
        } else if (datasektortahun.length == 1 && datasektortahun[0].label == "Formal") {
          sektortahun.options.colors = ["#0A384C"];
        }
        sektortahun.setData(datasektortahun);

        var datasektorbulan = [];
        for (i = 0; i < data[7].length; i++) {
          if (data[7][i].sektor == '1') {
            datasektorbulan.push({label: 'Informal', value: data[7][i].total, total: data[6]});
          } else if (data[7][i].sektor == '2') {
            datasektorbulan.push({label: 'Formal', value: data[7][i].total, total: data[6]});
          }
        }
        if (datasektorbulan.length == 0) {
          datasektorbulan.push({label: "", value: ""});
        }

        if(datasektorbulan.length > 1) {
          sektorbulan.options.colors = ["#58A8CC","#0A384C"];
        } else if (datasektorbulan.length == 1 && datasektorbulan[0].label == "Informal") {
          sektorbulan.options.colors = ["#58A8CC"];
        } else if (datasektorbulan.length == 1 && datasektorbulan[0].label == "Formal") {
          sektorbulan.options.colors = ["#0A384C"];
        }
        sektorbulan.setData(datasektorbulan);

        var datajptahun = [];
        for (i = 0; i < data[9].length; i++) {
          var datajpmonth = {month: data[9][i].bulan, total: data[9][i].total};
          for (j = 0; j < data[8].length; j++) {
            datajpmonth[data[8][j]] = data[9][i][data[8][j]];
          }
          datajptahun.push(datajpmonth);
        }
        jptahun.options.ykeys = data[8];
        jptahun.options.labels = data[8];
        jptahun.setData(datajptahun);

        $(window).trigger('resize');
        $("#loader-dashboard-penempatan").hide();
        $("#penempatan_parent").show();
        $("#tahun").prop('disabled', false);
        $("#bulan").prop('disabled', false);
        $("#institusi").prop('disabled', false);
      }
    });
  }

  function onPlacementMonthChange() {
    $("#tahun").prop('disabled', true);
    $("#bulan").prop('disabled', true);
    $("#institusi").prop('disabled', true);
    $("#penempatan_parent").hide();
    $("#loader-dashboard-penempatan").show();

    $('.dbulan').html("Penempatan Bulan " + $("#bulan option:selected").text());

    $.ajax({
      url     : "<?php echo site_url('pusat/get_info_year_dashboard_penempatan')?>",
      data    : {"y":$("#tahun").val(),"m":$("#bulan").val(),"i":$("#institusi").val()},
      type    : "post",
      dataType  : "json",
      success   : function(data){
        $("#sumjkbulan").html(data[2]);
        $("#sumsekbulan").html(data[6]);

        var datajkbulan = [];
        for (i = 0; i < data[3].length; i++) {
          datajkbulan.push({label: data[3][i].tkjk, value: data[3][i].total, total: data[2]});
        }
        if (datajkbulan.length == 0) {
          datajkbulan.push({label: "", value: ""});
        }

        if(datajkbulan.length > 1) {
          jkbulan.options.colors = ["#0A4C20","#58CC7E"];
        } else if (datajkbulan.length == 1 && datajkbulan[0].label == "L") {
          jkbulan.options.colors = ["#0A4C20"];
        } else if (datajkbulan.length == 1 && datajkbulan[0].label == "P") {
          jkbulan.options.colors = ["#58CC7E"];
        }
        jkbulan.setData(datajkbulan);

        var datasektorbulan = [];
        for (i = 0; i < data[7].length; i++) {
          if (data[7][i].sektor == '1') {
            datasektorbulan.push({label: 'Informal', value: data[7][i].total, total: data[6]});
          } else if (data[7][i].sektor == '2') {
            datasektorbulan.push({label: 'Formal', value: data[7][i].total, total: data[6]});
          }
        }
        if (datasektorbulan.length == 0) {
          datasektorbulan.push({label: "", value: ""});
        }

        if(datasektorbulan.length > 1) {
          sektorbulan.options.colors = ["#58A8CC","#0A384C"];
        } else if (datasektorbulan.length == 1 && datasektorbulan[0].label == "Informal") {
          sektorbulan.options.colors = ["#58A8CC"];
        } else if (datasektorbulan.length == 1 && datasektorbulan[0].label == "Formal") {
          sektorbulan.options.colors = ["#0A384C"];
        }
        sektorbulan.setData(datasektorbulan);

        $(window).trigger('resize');
        $("#loader-dashboard-penempatan").hide();
        $("#penempatan_parent").show();
        $("#tahun").prop('disabled', false);
        $("#bulan").prop('disabled', false);
        $("#institusi").prop('disabled', false);
      }
    });
  }

  function onPlacementInstitutionChange() {
    $("#tahun").prop('disabled', true);
    $("#bulan").prop('disabled', true);
    $("#institusi").prop('disabled', true);
    $("#penempatan_parent").hide();
    $("#loader-dashboard-penempatan").show();

    $.ajax({
      url     : "<?php echo site_url('pusat/get_info_year_dashboard_penempatan')?>",
      data    : {"y":$("#tahun").val(),"m":$("#bulan").val(),"i":$("#institusi").val()},
      type    : "post",
      dataType  : "json",
      success   : function(data){
        $("#sumjktahun").html(data[0]);
        $("#sumjkbulan").html(data[2]);
        $("#sumsektahun").html(data[4]);
        $("#sumsekbulan").html(data[6]);

        var datajktahun = [];
        for (i = 0; i < data[1].length; i++) {
          datajktahun.push({label: data[1][i].tkjk, value: data[1][i].total, total: data[0]});
        }
        if (datajktahun.length == 0) {
          datajktahun.push({label: "", value: ""});
        }

        if(datajktahun.length > 1) {
          jktahun.options.colors = ["#0A4C20","#58CC7E"];
        } else if (datajktahun.length == 1 && datajktahun[0].label == "L") {
          jktahun.options.colors = ["#0A4C20"];
        } else if (datajktahun.length == 1 && datajktahun[0].label == "P") {
          jktahun.options.colors = ["#58CC7E"];
        }
        jktahun.setData(datajktahun);

        var datajkbulan = [];
        for (i = 0; i < data[3].length; i++) {
          datajkbulan.push({label: data[3][i].tkjk, value: data[3][i].total, total: data[2]});
        }
        if (datajkbulan.length == 0) {
          datajkbulan.push({label: "", value: ""});
        }

        if(datajkbulan.length > 1) {
          jkbulan.options.colors = ["#0A4C20","#58CC7E"];
        } else if (datajkbulan.length == 1 && datajkbulan[0].label == "L") {
          jkbulan.options.colors = ["#0A4C20"];
        } else if (datajkbulan.length == 1 && datajkbulan[0].label == "P") {
          jkbulan.options.colors = ["#58CC7E"];
        }
        jkbulan.setData(datajkbulan);

        var datasektortahun = [];
        for (i = 0; i < data[5].length; i++) {
          if (data[5][i].sektor == '1') {
            datasektortahun.push({label: 'Informal', value: data[5][i].total, total: data[4]});
          } else if (data[5][i].sektor == '2') {
            datasektortahun.push({label: 'Formal', value: data[5][i].total, total: data[4]});
          }
        }
        if (datasektortahun.length == 0) {
          datasektortahun.push({label: "", value: ""});
        }

        if(datasektortahun.length > 1) {
          sektortahun.options.colors = ["#58A8CC","#0A384C"];
        } else if (datasektortahun.length == 1 && datasektortahun[0].label == "Informal") {
          sektortahun.options.colors = ["#58A8CC"];
        } else if (datasektortahun.length == 1 && datasektortahun[0].label == "Formal") {
          sektortahun.options.colors = ["#0A384C"];
        }
        sektortahun.setData(datasektortahun);

        var datasektorbulan = [];
        for (i = 0; i < data[7].length; i++) {
          if (data[7][i].sektor == '1') {
            datasektorbulan.push({label: 'Informal', value: data[7][i].total, total: data[6]});
          } else if (data[7][i].sektor == '2') {
            datasektorbulan.push({label: 'Formal', value: data[7][i].total, total: data[6]});
          }
        }
        if (datasektorbulan.length == 0) {
          datasektorbulan.push({label: "", value: ""});
        }

        if(datasektorbulan.length > 1) {
          sektorbulan.options.colors = ["#58A8CC","#0A384C"];
        } else if (datasektorbulan.length == 1 && datasektorbulan[0].label == "Informal") {
          sektorbulan.options.colors = ["#58A8CC"];
        } else if (datasektorbulan.length == 1 && datasektorbulan[0].label == "Formal") {
          sektorbulan.options.colors = ["#0A384C"];
        }
        sektorbulan.setData(datasektorbulan);

        var datajptahun = [];
        for (i = 0; i < data[9].length; i++) {
          var datajpmonth = {month: data[9][i].bulan, total: data[9][i].total};
          for (j = 0; j < data[8].length; j++) {
            datajpmonth[data[8][j]] = data[9][i][data[8][j]];
          }
          datajptahun.push(datajpmonth);
        }
        jptahun.options.ykeys = data[8];
        jptahun.options.labels = data[8];
        jptahun.setData(datajptahun);

        $(window).trigger('resize');
        $("#loader-dashboard-penempatan").hide();
        $("#penempatan_parent").show();
        $("#tahun").prop('disabled', false);
        $("#bulan").prop('disabled', false);
        $("#institusi").prop('disabled', false);
      }
    });
  }
</script>
