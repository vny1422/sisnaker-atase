
<!-- page content -->
<div class="right_col" role="main">

  <br />
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2><strong><?php echo $subtitle; ?></strong></h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="row">
              <div class="col-lg-12">
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
                              <th class="text-center" style="width:15%">Paspor</th>
                              <th class="text-center" style="width:5%">Status TKI</th>
                              <th class="text-center" style="width:25%">Klasifikasi Kasus</th>
                              <th class="text-center" style="width:20%">Pekerjaan</th>
                              <th class="text-center" style="width:5%">Interval (hari)</th>
                            </tr>
                          </thead>
                          <tbody class="table-hover">
                            <?php $i = 1; foreach ($kasusproses as $row ) { ?>
                              <tr>
                                <td class="text-center"><?php echo $i ?></td>
                                <td>
                                  <a href="#windowModal" data-toggle="modal" id=<?php echo $row['idmasalah'] ?>>
                                    <?php echo strtoupper($row['namatki']);  if ($row['jumlah'] > 1) echo ' ('.$row['jumlah'].' orang)'?>
                                  </a>
                                </td>
                                <td class="text-center">
                                  <a style="cursor: pointer;"onclick="openLookExt('<?php echo $row['paspor'] ?>');"><?php echo $row['paspor'] ?></a>
                                </td>
                                <td><?php echo $row['statustki']==1?"Resmi":"Kaburan"; ?></td>
                                <td><?php echo $row['klasifikasi'] ?></td>
                                <td><?php echo $row['jenis'] ?></td>
                                <td class="text-center"><?php echo $row['lama'] ?></td>
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
                                <th class="text-center" style="width:15%">Paspor</th>
                                <th class="text-center" style="width:5%">Status TKI</th>
                                <th class="text-center" style="width:25%">Klasifikasi Kasus</th>
                                <th class="text-center" style="width:20%">Pekerjaan</th>
                                <th class="text-center" style="width:5%">Interval (hari)</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php $i = 1; foreach ($kasusselesai as $row ) { ?>
                                <tr>
                                  <td class="text-center"><?php echo $i ?></td>
                                  <td>
                                    <a href="#windowModal" data-toggle="modal" id=<?php echo $row['idmasalah'] ?>>
                                      <?php echo strtoupper($row['namatki']);  if ($row['jumlah'] > 1) echo ' ('.$row['jumlah'].' orang)'?>
                                    </a>
                                  </td>
                                  <td class="text-center">
                                    <a style="cursor: pointer;"onclick="openLookExt('<?php echo $row['paspor'] ?>');"><?php echo $row['paspor'] ?></a>
                                  </td>
                                  <td><?php echo $row['statustki']==1?"Resmi":"Kaburan"; ?></td>
                                  <td><?php echo $row['klasifikasi'] ?></td>
                                  <td><?php echo $row['jenis'] ?></td>
                                  <td class="text-center"><?php echo $row['lama'] ?></td>
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

              </div>
            </div>
          </div>

          <!-- View Data Modal -->
          <?php include 'modal_view.php' ?>

        </div>

        <script type="text/javascript">
              $('#tablekasus').css('padding-bottom','0px');
              $('#tabskasus').css('border-bottom','0px');
              $(function () {
                var tbproses = $('#tableproses').DataTable({"bSort" : false,"bLengthChange": false});
                var tbselesai = $('#tableselesai').DataTable({"bSort" : false,"bLengthChange": false});   

                $('a[data-toggle="tab"]').on( 'shown.bs.tab', function (e) {
                  //$.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();
                  tbproses.columns.adjust().draw();
                  tbselesai.columns.adjust().draw();
                } );
              });

              $(".modal-wide").on("show.bs.modal", function() {
                var height = $(window).height() - 200;
                $(this).find(".modal-body").css("max-height", height);
              });

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

                    $("#editkasus").click(function(){
                      //window.location.href = "<?php echo site_url('edit/index') ?>/"+obj[0].idmasalah;
                    });
                  }
                  );
              });

              $("#downloadform").click(function() {
                var idprob = $("#downloadform").val();
                window.open("<?php echo site_url('perlindungan/convertToPDF') ?>"+"/"+idprob);
              });   
            </script>
