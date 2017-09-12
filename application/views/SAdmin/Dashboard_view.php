
<!-- DASHBOARD PERLINDUNGAN -->
<div class="right_col" role="main">

  <div class="row">

    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="dashboard_graph">
        <div class="x_panel">
          <div class="row x_title">
            <div class="col-md-6">
              <h3>DASHBOARD <small><b><?php echo $subtitle; ?></b></small></h3>
            </div>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </ul>
              <div class="clearfix"></div>
            </div>

            <div class="x_content">

              <br />

              <!-- Statistik Kasus -->

              <div class="row">

                <!---- CAPAIAN ---->
                <div class="col-lg-6 col-md-6">
                  <div class="panel <?php echo $panel_color?>">
                    <div class="panel-heading">
                      <div class="row">
                        <div class="col-xs-2">
                          <i class="fa fa-line-chart fa-5x"></i>
                        </div>
                        <div class="col-xs-10 text-right">
                          <div class="huge"><?php echo number_format($year_performance,1,".",",") ?>% </div>
                          <div>Kasus Tahun ini</div>
                        </div>
                      </div>
                    </div>
                    <div class="panel-body">
                      <?php
                      $scaleTotal = $datafinishthisyear + $dataprocessthisyear;
                      if($scaleTotal>0){
                        $scaleFinish = (100*$datafinishthisyear) / $scaleTotal;
                        $scaleProcess = (100*$dataprocessthisyear) / $scaleTotal;
                      }
                      else{
                        $scaleFinish = 0;
                        $scaleProcess = 0;
                      }
                      ?>
                      <div class="row">
                        <div class="col-lg-3 barlabel">Selesai</div>
                        <div class="col-lg-9">
                          <div class="progress">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuemax="100" style="min-width: 2em; width: <?php echo $scaleFinish ?>%;">
                              <?php echo $datafinishthisyear ?>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-3 barlabel">Proses</div>
                        <div class="col-lg-9">
                          <div class="progress">
                            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuemax="100" style="min-width: 2em;  width: <?php echo $scaleProcess ?>%;">
                              <?php echo $dataprocessthisyear ?>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-9">
                          <div class="progress" style="margin-bottom: 0px; visibility: hidden">
                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuemax="100" style="min-width: 2em;"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <a href="<?php echo site_url('perlindungan/data/year')?>">
                      <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                      </div>
                    </a>
                  </div>
                </div>

                <!---- KASUS BULAN INI ---->
                <div class="col-lg-6 col-md-6">
                  <div class="panel panel-info">
                    <div class="panel-heading">
                      <div class="row">
                        <div class="col-xs-2">
                          <i class="fa fa-pencil fa-5x"></i>
                        </div>
                        <div class="col-xs-10 text-right">
                          <div class="huge"><?php echo $datathismonth ?> </div>
                          <div>Kasus Bulan ini</div>
                        </div>
                      </div>
                    </div>
                    <div class="panel-body">
                      <?php
                      if($datathismonth>0){
                        $scaleFinish = (100*$datafinishthismonth) / $datathismonth;
                        $scaleProcess = (100*$dataprocessthismonth) / $datathismonth;
                      }
                      else{
                        $scaleFinish = 0;
                        $scaleProcess = 0;
                      }
                      ?>
                      <div class="row">
                        <div class="col-lg-3 barlabel">Selesai</div>
                        <div class="col-lg-9">
                          <div class="progress">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuemax="100" style="min-width: 2em; width: <?php echo $scaleFinish ?>%;">
                              <?php echo $datafinishthismonth ?>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-3 barlabel">Proses</div>
                        <div class="col-lg-9">
                          <div class="progress">
                            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuemax="100" style="min-width: 2em;  width: <?php echo $scaleProcess ?>%;">
                              <?php echo $dataprocessthismonth ?>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-9">
                          <div class="progress" style="margin-bottom: 0px; visibility: hidden">
                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuemax="100" style="min-width: 2em;"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <a href="<?php echo site_url('perlindungan/data/month')?>">
                      <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                      </div>
                    </a>
                  </div>
                </div>
              </div>
              <!---------------------------->

              <!-- Statistik Petugas -->
              <div class="row">
                <div class="col-lg-12">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Statistik Petugas Tahun ini</h3>
                    </div>

                    <div class="panel-body">
                      <div class="row">

                        <!-- KDEI Officer Performance -->
                        <?php foreach($officername as $username => $officer) {?>
                          <div class="col-lg-4 col-md-6">
                            <div class="panel panel-info">
                              <div class="panel-heading">
                                <div class="row">
                                  <div class="col-xs-3">
                                    <!-- <i class="fa fa-user fa-5x"></i> -->
                                    <img class="img-circle" alt="" style="width:65px;height:65px" src="<?php echo ($officerpicture[$username] != "" ? base_url('assets/images/'.$officerpicture[$username]) : base_url('assets/images/user.png')); ?>">
                                  </div>
                                  <div class="col-xs-9 text-right">
                                    <div class="huge"> <h1><?php echo number_format($performance[$username][1],1,".",",") ?>%</h1></div>
                                    <div><b><?php echo $officer ?></b></div>
                                  </div>
                                </div>
                              </div>
                              <a href="<?php echo site_url('perlindungan/officer/'.$username)?>">
                                <div class="panel-footer">
                                  <span class="pull-left">
                                    <?php echo $performance[$username][0]?> Kasus
                                    ( <i class="fa fa-check" style="color: green;"> <?php echo $performance[$username][2]?></i>
                                      <i></i>
                                      <i class="fa fa-close" style="color: red;padding-left:8px;"> <?php echo $performance[$username][3]?></i> )
                                  </span>
                                  <span class="pull-right"><i class="fa fa-arrow-circle-right"> Details</i></span>
                                  <div class="clearfix"></div>
                                </div>
                              </a>
                            </div>
                          </div>
                          <?php }?>

                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Table Kasus Petugas Login -->

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
                              <tbody class="table-hover">
                                <?php $i = 1; foreach ($kasusproses->result() as $row ) { ?>
                                  <tr>
                                    <td class="text-center"><?php echo $i ?></td>
                                    <td>
                                      <a href="#windowModal" data-toggle="modal" id=<?php echo $row->idmasalah ?>>
                                        <?php echo strtoupper($row->namatki);  if ($row->jumlah > 1) echo ' ('.$row->jumlah.' orang)'?>
                                      </a>
                                    </td>
                                    <td><?php echo $row->paspor ?></td>
                                    <td><?php echo $row->statustki==1?"Resmi":"Kaburan"; ?></td>
                                    <td><?php echo $row->klasifikasi ?></td>
                                    <td><?php echo $row->keyword ?></td>
                                    <td><?php echo $row->nama ?></td>
                                    <td class="text-center"><?php echo $row->lama ?></td>
                                  </tr>
                                  <?php $i++; }?>
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
                                  <?php $i = 1; foreach ($kasusselesai->result() as $row ) { ?>
                                    <tr>
                                      <td class="text-center"><?php echo $i ?></td>
                                      <td>
                                        <a href="#windowModal" data-toggle="modal"  id=<?php echo $row->idmasalah ?> >
                                          <?php echo strtoupper($row->namatki);  if ($row->jumlah > 1) echo ' ('.$row->jumlah.' orang)'?>
                                        </a>
                                      </td>
                                      <td><?php echo $row->paspor ?></td>
                                      <td><?php echo $row->statustki==1?"Resmi":"Kaburan"; ?></td>
                                      <td><?php echo $row->klasifikasi ?></td>
                                      <td><?php echo $row->keyword ?></td>
                                      <td><?php echo $row->nama ?></td>
                                      <td class="text-center"><?php echo $row->lama ?></td>
                                    </tr>
                                    <?php $i++; }?>
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
                                <select class="form-control" name="" data-size="3" data-live-search="true" id="tahunperlindungan" class="col-xs-7">
                                  <?php foreach ($tahundb->result() as $row ) {?>
                                    <option value="<?php echo $row->tahun?>"><?php echo $row->tahun?></option>
                                    <?php }?>
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
                  </div>

                  <!-- View Data Modal -->
                  <?php include 'modal_view.php' ?>

                  <div class="clearfix"></div>
                </div>
              </div>

            </div>


          <!-- DASHBOARD ENDORSEMENT -->
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <div class="col-md-3">
                      <h3>DASHBOARD <small><b><?php echo $subtitle2; ?></b></small></h3>
                    </div>
                    <div class="col-md-1">
                      <select class="form-control" name="" data-size="3" data-live-search="true" id="tahun">
                        <?php foreach ($tahunpenempatan as $row ) {?>
                          <option value="<?php echo $row->tahun?>"><?php echo $row->tahun?></option>
                          <?php }?>
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
                      <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </ul>
                        <div class="clearfix"></div>
                      </div>
                      <div class="x_content">
                        <br />

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


          <script>

            $(".modal-wide").on("show.bs.modal", function() {
              var height = $(window).height() - 200;
              $(this).find(".modal-body").css("max-height", height);
            });

            $(function () {
              var tbproses = $('#tableproses').DataTable({"bSort" : false,"bLengthChange": false});
              var tbselesai = $('#tableselesai').DataTable({"bSort" : false,"bLengthChange": false});

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
                tbproses.search($("#tbproall").val()).draw();
              });
              $("#tbselall").keyup(function() {
                tbselesai.search($("#tbselall").val()).draw();
              });

              $('a[data-toggle="tab"]').on( 'shown.bs.tab', function (e) {
                //$.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();
                tbproses.columns.adjust().draw();
                tbselesai.columns.adjust().draw();
              } );

              $("a[data-toggle=modal]").click(function(){
                var thisid = $(this).attr('id');
                $.post("<?php echo site_url('perlindungan/modal')?>",{id:thisid},
                  function(data){

                    var obj = JSON.parse(data);

                    // if(obj[3].length == 0) {$("#casesiap").hide();}
                    // else {
                    //   $("#casesiap").show();
                    //   $("#perihal").text(obj[3][0].perihal);
                    //   $("#pesandisposisi").text(obj[3][0].pesandisposisi);
                    //   $("#filesiap").attr("href", obj[3][0].filedisposisi);
                    // }

                    $("#casesiap").hide();

                    if(obj[2].length > 0) {
                      $("#berkaskasus").html('');
                      for(i=0; i<obj[2].length; i++) {
                        //console.log(i);
                        var dt = '';

                        dt = '<tr>';
                        //dt += ' <td><a href="<?php echo $this->config->item('domain_url')?>'+obj[2][i].filename+'" target="_blank">'+obj[2][i].filename+'</a></td>';
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
                  }
                  );
              });

              $("#downloadform").click(function() {
                var idprob = $("#downloadform").val();
                window.open("<?php echo site_url('perlindungan/convertToPDF') ?>"+"/"+idprob);
              });

              $('select').selectpicker();

              $.ajax({
                url     : "<?php echo site_url('perlindungan/get_info_year_dashboard')?>",
                data    : {"y":$("#tahunperlindungan").val()},
                type    : "post",
                dataType  : "json",
                success   : function(data){
                  $("#total-year").html(data[0]);
                  $("#money-year").html(data[2]);
                  //console.log(data[1]);
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

              $("#tahunperlindungan").change(function(){
                $("#graph-problem").html("");
                $("#graph-money").html("");

                $.ajax({
                  url     : "<?php echo site_url('perlindungan/get_info_year_dashboard')?>",
                  data    : {"y":$("#tahunperlindungan").val()},
                  type    : "post",
                  dataType  : "json",
                  success   : function(data){
                    $("#total-year").html(data[0]);
                    $("#money-year").html(data[2]);
                    $("#graph-problem").html("");
                    $("#graph-money").html("");

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

                    //console.log(data[3]);
                  }
                });
              });

            });
          </script>

          <script>
  $(document).ready(function () {
    $('select').selectpicker();

    $('.dtahun').html("Penempatan Tahun " + $("#tahun").val());
    $('.dbulan').html("Penempatan Bulan " + $("#bulan option:selected").text());
    $('#gtahun').html("Statistik Penempatan Tahun " + $("#tahun").val());

    $.ajax({
      url     : "<?php echo site_url('endorsement/get_info_year_dashboard')?>",
      data    : {"y":$("#tahun").val(),"m":$("#bulan").val()},
      type    : "post",
      dataType  : "json",
      success   : function(data){
        //console.log(data);

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

      }
    });

    $("#tahun").change(function(){
      $('.dtahun').html("Penempatan Tahun " + $("#tahun").val());
      $('#gtahun').html("Statistik Penempatan Tahun " + $("#tahun").val());

      $.ajax({
        url     : "<?php echo site_url('endorsement/get_info_year_dashboard')?>",
        data    : {"y":$("#tahun").val(),"m":$("#bulan").val()},
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

        }
      });
    });

    $("#bulan").change(function(){
      $('.dbulan').html("Penempatan Bulan " + $("#bulan option:selected").text());

      $.ajax({
        url     : "<?php echo site_url('endorsement/get_info_year_dashboard')?>",
        data    : {"y":$("#tahun").val(),"m":$("#bulan").val()},
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

        }
      });
    });

  });

</script>
