
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
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th class="text-center">Waktu</th>
                  <th class="text-center">Aktivitas</th>
                </tr>
              </thead>
              <tbody id="listlog">
                <?php foreach ($result_log as $row ) { ?>
                  <tr>
                    <td class="text-center"><?php echo $row[2]->timestamp ?></td>
                    <td>
                      <em><?php echo $row[0] ?></em><?php echo " ".$row[2]->history ?>
                      <a href onclick='return click_modal("<?php echo $row[2]->idmasalah ?>");'>
                        <?php echo " ".$row[1] ?>
                      </a>
                    </td>
                  </tr>
                  <?php }?>
                </tbody>
              </table>

            </div>
          </div>
        </div>

        <!-- View Data Modal -->
        <?php include 'modal_view.php' ?>

      </div>

      <script type="text/javascript">
        var refID = -1;
        function click_modal(arg) {
          refID = arg;
          $(".modal-wide").modal("show");
          return false;
        };
      </script>

      <script type="text/javascript">
        $(document).ready(function() {
          var wrapper         = $("#listlog"); //Fields wrapper
          var table           = $('#datatable-responsive');

          table.DataTable({"bSort" : false,"bLengthChange": false});

          $(".modal-wide").on("show.bs.modal", function() {
            var height = $(window).height() - 200;
            $(this).find(".modal-body").css("max-height", height);

            $.post("<?php echo site_url('perlindungan/modal')?>",{id:refID},
              function(data){
                var obj = JSON.parse(data);

          //console.log(obj);

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
            refID = -1;
          });

          $("#downloadform").click(function() {
            var idprob = $("#downloadform").val();
            window.open("<?php echo site_url('perlindungan/convertToPDF') ?>"+"/"+idprob);
          });
        });
      </script>
