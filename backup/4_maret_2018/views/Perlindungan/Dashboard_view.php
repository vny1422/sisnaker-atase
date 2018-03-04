
<!-- page content -->
<div class="right_col" role="main">
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="dashboard_graph">
        <div class="x_panel">
          <div class="row x_title">
            <div class="col-md-4">
              <h3>DASHBOARD <small><b><?php echo $subtitle; ?></b></small></h3>
            </div>
            <div class="col-md-4">
              <select class="form-control" name="" data-size="3" data-live-search="true" id="kantor">
                <option value="all"><?php echo $namainstitusi?></option>
                <?php foreach ($kantors as $row) {
                  if ($this->session->userdata('kantor') == $row->idkantor) {
                    echo '<option value="'.$row->idkantor.'" selected>'.$row->namakantor.'</option>';
                  } else {
                    echo '<option value="'.$row->idkantor.'">'.$row->namakantor.'</option>';
                  }
                }?>
              </select>
            </div>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
            </ul>
            <div class="clearfix"></div>
          </div>

          <div class="x_content">
            <br />

            <div id="loader"></div>

            <div id="view_parent" style="display:none;">
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
                          <select class="form-control col-xs-7" name="" data-size="3" data-live-search="true" id="tahun" class="">
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
      tbProses.columns.adjust().draw();
      tbSelesai.columns.adjust().draw();
    });

    $("#downloadform").click(function() {
      var idProblem = $("#downloadform").val();
      window.open("<?php echo site_url('perlindungan/convertToPDF') ?>" + "/" + idProblem);
    });

    loadView();
  });

  $("#kantor").change(function(){
    loadView();
  });

  $("#tahun").change(function(){
    loadGraph();
  });

  function loadView() {
    $("#kantor").prop('disabled', true);
    $("#view_parent").hide();
    $("#loader").show();
    tbProses.clear();
    tbSelesai.clear();
    $("#officers_performance").html("");
    $("#total-year").html("");
    $("#money-year").html("");
    $("#graph-problem").html("");
    $("#graph-money").html("");

    $.ajax({
      url     : "<?php echo site_url('perlindungan/collect_dashboard_info')?>",
      data    : {"idkantor":$("#kantor").val()},
      type    : "post",
      dataType  : "json",
      success   : function(data) {
        $("#loader").hide();
        $("#view_parent").show();
        $("#kantor").prop('disabled', false);

        // Load Graph
        var options = "";
        for (var i = 0; i < data.list_of_years.length; i++) {
          var year = data.list_of_years[i].tahun;

          if (year != null) {
            options += '<option value="' + year + '">' + year + '</option>';
          }
        }
        $("#tahun").html(options);
        $("#tahun").selectpicker('refresh');
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
        $("#kasus_tahunan_uri").attr("href", getBaseUrl('perlindungan/data/year/' + $("#kantor").val()));

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
        $("#kasus_bulanan_uri").attr("href", getBaseUrl('perlindungan/data/month/' + $("#kantor").val()));

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
              officerUri: getBaseUrl('perlindungan/officer/' + officerUsername),
              officerCasesAll: data.officers_performance[officerUsername][0],
              officerCasesFinished: data.officers_performance[officerUsername][2],
              officerCasesUnfinished: data.officers_performance[officerUsername][3]
            };

            var html = Mustache.render(officerPerformanceTemplate, officerData);
            $("#officers_performance").append(html);
          }
        }
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
    $.post("<?php echo site_url('perlindungan/modal')?>",{id:idProblem},
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
    $("#total-year").html("");
    $("#money-year").html("");
    $("#graph-problem").html("");
    $("#graph-money").html("");

    $.ajax({
      url     : "<?php echo site_url('perlindungan/get_info_year_dashboard')?>",
      data    : {"y":$("#tahun").val(),"idkantor":$("#kantor").val()},
      type    : "post",
      dataType  : "json",
      success   : function(data){
        $("#total-year").html(data[0]);
        $("#money-year").html(data[2]);

        var morrisarea = Morris.Area({
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

        var morrisbar = Morris.Bar({
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
      }
    });
  }
</script>
