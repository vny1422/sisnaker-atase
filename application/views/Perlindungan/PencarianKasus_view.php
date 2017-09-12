<div class="right_col" role="main" ng-app="searchApp">

  <div class="row">
  </div>
  <br />

  <div ng-controller="FormController"> 
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
              <div class="col-xs-12" ng-mouseleave="refreshTable()" ng-cloak>
                <span class="col-lg-3"><h3>Rentang aduan <b>{{slideTahun[0]}} - {{slideTahun[1]}}</b></h3></span>
                <span class="col-lg-4" style="vertical-align: middle; padding-top: 22px"
                slider ng-model="slideTahun" min="2012" step="1" max="<?php echo date('Y'); ?>"
                range="true" value="[2014,<?php echo date('Y'); ?>]">
              </span>
              <span class="col-lg-2" ng-show="query_result.length==0" style="text-align: center">
                <h3><i class="fa fa-refresh fa-spin "> </i><i class=""> refreshing</i></h3>
              </span>
            </div>
          </div>
          <div class="col-xs-12" style="padding-top: 20px" class=" table-responsive">
            <table st-table="queries" st-safe-src="query_result" class="table table-striped table-hover table-bordered" ng-hide="query_result.length==0">
              <thead>
                <tr>
                  <th colspan="<?php echo ($_SESSION['role'] == 1 || $_SESSION['role'] == 5 ? "6" : "5"); ?>" style="border:hidden;"></th>
                  <th colspan="2" style="border:hidden;">
                    <input st-search="keyword" placeholder="keyword aduan" class="input-sm form-control" type="search"/>
                  </th>
                </tr>
                <tr class="btn-info">
                  <th>
                    <input st-search="namatki" placeholder="Filter NAMA" class="input-sm form-control" type="search"/>
                  </th>
                  <th>
                    <input st-search="paspor" placeholder="Filter PASPOR" class="input-sm form-control" type="search" style="margin-bottom: 5px"/>
                    <select st-search="statustki" class="input-sm form-control" type="search">
                      <option value="">-- Semua --</option>
                      <option value="Resmi">Resmi</option>
                      <option value="Kaburan">Kaburan</option>
                    </select>
                  </th>
                  <th style="<?php echo ($_SESSION['role'] == 1 || $_SESSION['role'] == 5 ? "" : "display:none;"); ?>" >
                    <input st-search="namainstitusi" placeholder="Filter INSTITUSI" class="input-sm form-control" type="search"/>
                  </th>
                  <th>
                    <input st-search="jenispekerjaan" placeholder="Filter PEKERJAAN" class="input-sm form-control" type="search"/>
                  </th>
                  <th>
                    <input st-search="klasifikasi" placeholder="Filter KLASIFIKASI" class="input-sm form-control" type="search"/>
                  </th>
                  <th>
                    <input st-search="tanggalpengaduan" placeholder="Filter TANGGAL" class="input-sm form-control" type="search"/>
                  </th>
                  <th>
                    <input st-search="petugas" placeholder="Filter PETUGAS" class="input-sm form-control" type="search"/>
                  </th>
                  <th>
                    <select st-search="statusmasalah" class="input-sm form-control" type="search" style="margin-bottom: 5px; width:100px">
                      <option value="">-- Semua --</option>
                      <option value="selesai">Selesai</option>
                      <option value="proses">Proses</option>
                    </select>
                  </th>
                </tr>
                <tr class="btn-danger">
                  <th class="text-center col-lg-2">Nama</th>
                  <th class="text-center col-lg-2">Paspor</th>
                  <th style="<?php echo ($_SESSION['role'] == 1 || $_SESSION['role'] == 5 ? "" : "display:none;"); ?>" class="text-center col-lg-2">Institusi</th>
                  <th class="text-center col-lg-2">Pekerjaan</th>
                  <th class="text-center col-lg-2">Klasifikasi</th>
                  <th class="text-center col-lg-1">Tgl Pengaduan</th>
                  <th class="text-center col-lg-1">Petugas</th>
                  <th class="text-center col-lg-1">Status Masalah</th>
                </tr>
              </thead>
              <tbody class="table-hover " >
                <tr ng-repeat="query in queries" ng-cloak>
                  <td class="text-left">
                    <a href ng-click="showKasus(query)" data-toggle="modal" id="{{query.idmasalah}}">{{query.namatki}}
                    </a>
                  </td>
                  <td class="text-left">
                    {{query.paspor}} <i>- ({{query.statustki}})</i>
                  </td>
                  <td style="<?php echo ($_SESSION['role'] == 1 || $_SESSION['role'] == 5 ? "" : "display:none;"); ?>" class="text-left">{{query.namainstitusi}}</td>
                  <td class="text-left">{{query.jenispekerjaan}}</td>
                  <td class="text-left">{{query.klasifikasi}}</td>
                  <td class="text-left">{{query.tanggalpengaduan}}</td>
                  <td class="text-left">{{query.petugas}}</td>
                  <td class="text-left">{{query.statusmasalah}}
                    <font ng-if="query.statusmasalah=='Selesai'">
                      <br/>
                      {{query.tanggalpenyelesaian}}
                    </font>
                  </td>
                </tr>
              </tbody>
              <tfoot>
                <tr>
                  <td colspan="7" class="text-center">
                    <div st-pagination="" st-items-by-page="10" st-template="<?php echo base_url('assets/template/custom.pagination.html') ?>"></div>
                  </td>
                </tr>

              </tfoot>
            </table>
          </div>
        </div>
        <div class="clearfix"></div>
      </div>
    </div>
  </div>

<!-- View Data Modal -->
<?php include 'modal_view_angular_friendly.php'; ?>

</div>
</div>

<script type="text/javascript">
  //////////////////// JQUERY MODAL

  $(".modal-wide").on("show.bs.modal", function() {
    var height = $(window).height() - 200;
    $(this).find(".modal-body").css("max-height", height);
  });

  function popupMasalah(problemID){
    $('#windowModal').modal('show');
    $.post("<?php echo site_url('perlindungan/modal')?>",{id:problemID},
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

          $("#Adownloadform").val(obj[0].idmasalah);
          $("#Ainputpaspor").text(obj[1][0].paspor);
          $("#Anamebmi").text(obj[1][0].namatki);
          $("#Ajk").text(obj[1][0].jk);
          $("#Aarc").text(obj[1][0].arc);
          $("#Aphone").text(obj[1][0].handphone);
          $("#Ajenispekerjaan").text(obj[0].jenis);
          $("#Astatustki").text(obj[0].statustki);
          $("#Aagensitw").text(obj[0].agensi);
          $("#Acpagensitw").text(obj[0].cpagensi);
          $("#Ahpagensitw").text(obj[0].teleponagensi);
          $("#Apptkis").text(obj[0].pptkis);
          $("#Amajikan").text(obj[0].majikan);
          $("#Aorganisasi").text(obj[0].organisasi);
          $("#Apetugaspenanganan").text(obj[0].petugaspenanganan);
          $("#Anomorkasus").text(obj[0].nomormasalah);
          $("#Apelapor").text(obj[0].namapelapor);
          $("#Atlppelapor").text(obj[0].teleponpelapor);
          $("#Atglpengaduan").text(obj[0].tanggalpengaduan);
          $("#Amedia").text(obj[0].media);
          $("#Aklasifikasikasus").text(obj[0].klasifikasi);
          $("#Apermasalahan").text(obj[0].permasalahan);
          $("#Atuntutan").text(obj[0].tuntutan);
          $("#Atindaklanjut").html(obj[0].tindaklanjut);
          $("#Anominal").text(obj[0].uang);
          $("#Astatusmasalah").text(obj[0].statusmasalah);

          $("#editkasus").click(function(){
            //window.location.href = "<?php echo site_url('edit/index') ?>/"+obj[0].idmasalah;
          });
        }
        );
  };

  $("#Adownloadform").click(function() {
    var idprob = $("#Adownloadform").val();
    window.open("<?php echo site_url('perlindungan/convertToPDF') ?>"+"/"+idprob);
  });
</script>

<script type="text/javascript">

    var idinstitution = <?php echo $_SESSION['institution'] ?>;

    /////////////////// ANGULAR CONTROLLER
    var app = angular.module('searchApp', ['smart-table','angular-bootstrap-select','ui.bootstrap-slider']);
    app.controller('FormController', function($scope,$http) {
      $scope.slideTahun = [2014,<?php echo date('Y'); ?>];
      $scope.oldslideTahun = $scope.slideTahun;
      $scope.query_result = [];
      $scope.query = null;

      /// binding for modal popup
      $scope.showKasus = function(input){
        $scope.query = input;
        popupMasalah(input.idmasalah);
      };

      $scope.getData = function(year){
          $scope.query_result = []; ///to force dirty check
          $http({
            method  : "post",
            url   : "<?php echo site_url("kasus/get_table"); ?>",
            data  : {'from':year[0], 'to':year[1], 'idinstitution':idinstitution}
          }).success(function(response){
            angular.copy(response,$scope.query_result);
          });
        };

      $scope.getData($scope.slideTahun);

      $scope.refreshTable = function(){
        if ($scope.slideTahun[0] == $scope.oldslideTahun[0] && $scope.slideTahun[1] == $scope.oldslideTahun[1]) {
          return;
        }
        $scope.oldslideTahun = $scope.slideTahun;
        $scope.getData($scope.slideTahun);
      }

      $scope.delKasus = function(){
        var r = confirm('Benar ingin menghapus kasus ini ?');
        if(r == true){
          $.post("<?php echo site_url()?>kasus/delKasus", {idmasalah:$scope.query.idmasalah}, function(message){
            if(message == 'true'){
              var index = $scope.query_result.indexOf($scope.query);
              if (index !== -1) {
                $scope.query_result.splice(index,1);
              }
            } else {
              alert('Maaf telah terjadi kesalahan. Silahkan coba kembali.');
            }
            
            $('#windowModal').modal('hide');
          });
        }
      };

    });

    app.directive('pageSelect', function() {
      return {
        restrict: 'E',
        template: '<font>{{currentPage}}</font>',
        link: function(scope, element, attrs) {
          scope.$watch('currentPage', function(c) {
            scope.inputPage = c;
          });
        }
      }
    });
  </script>
