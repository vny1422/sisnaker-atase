<div class="right_col" role="main" ng-app="verifyApp" ng-controller="VerifyController">
  <div class="row" >
  </div>
  <br />
  <div class="row" >
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <ul class="nav navbar-right panel_toolbox">
            <form name="aduanform" enctype="multipart/form-data" ng-init="formWarn=false">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </ul>
            <h3><strong>Verifikasi Input Kasus</strong></h3>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
          <div class="row">
          <div class="col-lg-12">
                        <h1 class="col-lg-12" style="text-align: center">
                            Apakah aduan telah tercatat sebelumnya?
                            </br>
                            <small>verifikasi untuk mencegah duplikasi pencatatan aduan</small>
                        </h1>
                        <div class="col-lg-12" style="padding: 30px 0px">
                            <form class="form-group">
                                <div class="col-lg-8 col-lg-offset-2">
                                    <div class="input-group">
                                        <input type="text" class="form-control input-lg" ng-model="qstring">
                                        <span class="input-group-btn">
                                            <button class="btn btn-primary btn-lg" ng-click = "cari()">
                                                <i class="fa fa-search"></i> Cari Aduan
                                            </button>
                      <button class="btn btn-danger btn-lg" type="button"
                          ng-click="newentry()">
                                                <i class="fa fa-edit"></i> Input Aduan Baru
                                            </button>
                                        </span>
                                    </div>
                                    <span>
                    <b>(* </b>tulis nama atau / dan paspor. tidak harus lengkap. contoh: <b>hendra A92123</b> <i>atau</i> <b>koko 33456</b>
                    </br>
                    <b>(**</b>jika hasil pencarian tidak ada / sesuai. Silahkan pilih <strong>Input aduan baru</strong> untuk menambahkan aduan.
                  </span>
                </div>
                            </form>
                        </div>
            <div class="col-lg-12" ng-show="label_q[3]==true" style="text-align: center">
              <h3><i>{{label_q[0]}} <strong>{{label_q[2]}}</strong> {{label_q[1]}}</i></h3>
            </div>
                    </div>
                    <div class="col-lg-12">
            <!-- tabel -->
                        <div class="panel panel-default" ng-show="query_result.length>0">
              <table st-table="queries" st-safe-src="query_result" class="table table-striped table-hover table-bordered panel" >
                <thead>
                  <tr class="btn-danger">
                    <th class="text-center">No</th>
                    <th class="text-center col-lg-3">Nama TKI</th>
                    <th class="text-center col-lg-1">Paspor</th>
                    <th class="text-center col-lg-2">Pekerjaan</th>
                    <th class="text-center col-lg-1">Tgl Pengaduan</th>
                    <th class="text-center col-lg-2">Klasifikasi</th>
                    <th class="text-center col-lg-2">Penanganan</th>
                    <th class="text-center col-lg-1">Status Masalah</th>
                  </tr>
                </thead>
                <tbody class="table-hover " >
                  <tr ng-repeat="query in queries">
                    <td class="text-center">{{query.idx}}</td>
                    <td >
                      <a href ng-click="justTest(query.idmasalah)" data-toggle="modal" id="{{query.idmasalah}}">
                        {{query.namatki}}
                        <!--font ng-if="query.paspor!=''" ></br>({{query.paspor}})</font-->
                      </a>
                    </td>
                    <td class="text-center">{{query.paspor}}</td>
                    <td class="text-center">{{query.jenis}}</td>
                    <td class="text-center">{{query.tanggalpengaduan}}</td>
                    <td class="text-center">{{query.klasifikasi}}</td>
                    <td class="text-center"><strong>{{query.petugas}}</strong></td>
                    <td class="text-center">{{query.status}}</td>
                  </tr>
                </tbody>
                <tfoot ng-hide="query_result.length<=6">
                  <tr>
                    <td colspan="8" class="text-center">
                      <div st-pagination="" st-items-by-page="6" st-template="<?php echo assets_url() ?>/template/custom.pagination.html"></div>
                    </td>
                  </tr>

                </tfoot>
              </table>
                        </div>
            <!-- EoT -->
                    </div>
                </div>

            <div class="ln_solid"></div>
          </div>
        </div>
      </div>
    </div>

    <!-- Masa Tinggal Shelter -->
    <script type="text/javascript">
    /////////////////// JQUERY MODAL

    $(".modal-wide").on("show.bs.modal", function() {
        var height = $(window).height() - 200;
        $(this).find(".modal-body").css("max-height", height);
    });

    function popupMasalah(problemID){
      $('#windowModal').modal('show');
      $.post("<?php echo site_url('main/modal')?>",{id:problemID},
        function(data){
          var obj = JSON.parse(data);

          //console.log(obj);

          if(obj[3].length == 0) {$("#casesiap").hide();}
          else {
            $("#casesiap").show();
            $("#perihal").text(obj[3][0].perihal);
            $("#pesandisposisi").text(obj[3][0].pesandisposisi);
            $("#filesiap").attr("href", obj[3][0].filedisposisi);
          }

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
            window.location.href = "<?php echo site_url('edit/index') ?>/"+obj[0].idmasalah;
          });
        }
      );
    };

    $("#Adownloadform").click(function() {
      var idprob = $("#Adownloadform").val();
      window.open("<?php echo site_url('formulir/index') ?>"+"/"+idprob);
    });

  </script>

  <script type="text/javascript">
    /////////////////// ANGULAR CONTROLLER
    var app = angular.module('verifyApp', ['smart-table','angular-bootstrap-select','ngAlertify']);
    app.controller('VerifyController', function($scope,$http,alertify) {

                $scope.qstring ="";

        /// binding for modal popup
        $scope.justTest = function(input){
          popupMasalah(input);
        };

        ////// query all parameter and update all ng-options and ng-model on success

        $scope.query_result = [];
        $scope.queries = [].concat($scope.query_result);
        $scope.label_q = ["","","",false];
        $scope.ena = 0;

        $scope.cari = function(){
                    if($scope.qstring=="") return;
                    //console.log($scope.qstring);
          $scope.query_result = [];
          $scope.ena = 1;
          $http({
            method  : "post",
            url   : "<?php echo base_url("kasus/checkkasus"); ?>",
            data  : {'text':$scope.qstring}
          }).success(function(response){
            //console.log(response);
            angular.copy(response,$scope.query_result);
            if(response.length==0){
              $scope.label_q[0] = 'Informasi';
              $scope.label_q[1] = 'tidak ditemukan';
              $scope.label_q[2] = $scope.qstring;
              $scope.label_q[3] = true;
            }
            else{
              $scope.label_q[0] = 'Terdapat '+response.length+' hasil pencarian ';
              $scope.label_q[1] = '';
              $scope.label_q[2] = $scope.qstring;
              $scope.label_q[3] = true;
            }
          });
        };

        $scope.newentry = function(){
          if ($scope.ena==0) {
            alertify.alert("Mohon lakukan pencarian terlebih dahulu sebelum membuat aduan baru.");
                        return;
                    }
          else{
            alertify.confirm("Anda akan membuat aduan baru. Lanjutkan?", function () {
              window.location = '<?php echo base_url('kasus')?>';
            }, function(){
              return;
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
