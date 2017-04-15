<div class="right_col" role="main" ng-app="shelterApp">

  <div class="row">
  </div>
  <br />

  <div ng-controller="shelterCtrl">
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
              <form>
                <div class="form-group col-lg-4">
                  <label>Shelter</label>
                  <select class="form-control" ng-model="datacontrol.shelter" ng-options="s.id as s.name for s in shelterlist"
                  selectpicker="{dropupAuto:false}" toggle-dropdown ng-change="refresh()" ng-disabled="viewAll">
                </select>
              </div>
              <div class="form-group col-lg-3">
                <label>Bulan & Tahun</label>
                <input type="text" class="form-control tglformat" ng-model="datacontrol.dateyear" ng-change="refresh()">
              </div>
            </form>
          </div>
          <div ng-show="query_result.length > 0 && query_result[0]!=0" class="table-responsive row">
            <div class="col-lg-12">
              <table st-table="queries" st-safe-src="query_result"
              class="table table-striped table-hover table-bordered animateMe">
              <thead>
                <tr>
                  <th colspan="5" style="border:hidden;"></th>
                  <th colspan="2" style="border:hidden;">
                    <input st-search placeholder="Filter pencarian" class="input-sm form-control" type="search"/>
                  </th>
                </tr>
                <tr class="btn-danger">
                  <th class="text-center" style="width:5%" >No</th>
                  <th class="text-center" style="width:auto" >Nama TKI</th>
                  <th class="text-center" style="width:10%" >Paspor</th>
                  <th class="text-center" style="width:24%" >Klasifikasi</th>
                  <th class="text-center" style="width:8%" >Kasus Tahun</th>
                  <th class="text-center" style="width:15%" >Ditangani oleh</th>
                  <th class="text-center" style="width:12%" >Status Masalah</th>
                </tr>
              </thead>
              <tbody class="table-hover" >
                <tr ng-repeat="query in queries" ng-cloak>
                  <td class="text-center">{{query.idx}}</td>
                  <td class="">
                    <a href ng-click="showKasus(query)" data-toggle="modal" id="{{query.idmasalah}}">
                      {{query.namatki}}
                    </a>
                  </td>
                  <td class="text-center">{{query.paspor}}</td>
                  <td class="text-center">{{query.klasifikasi}}</td>
                  <td class="text-center">{{query.yearadu}}</td>
                  <td class="text-center">{{query.petugas}}</td>
                  <td class="text-center" ng-if="query.statusmasalah==1">Belum selesai</td>
                  <td class="text-center" ng-if="query.statusmasalah==2">Selesai</td>
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
  $(function(){
   $('.tglformat').datepicker({
    format: "MM - yyyy",
    todayBtn: "linked",
    minViewMode	: 1,
    todayHighlight: true
  });
 });

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
  var TIMEOUT = 100;
    /////////////////// ANGULAR CONTROLLER
    var app = angular.module('shelterApp', ['smart-table','angular-bootstrap-select','ngAlertify']);
    app.controller('shelterCtrl', function($scope,$http,$filter,$timeout,alertify,DataService) {
      $scope.shelterlist = [];
      $scope.datacontrol = {};
      $scope.viewAll  = true;
      $scope.query_result = [];
      $scope.queries = [];
      $scope.query = null;
      var idinstitution = "<?php echo $this->session->userdata('institution');?>";

      DataService.getShelter(idinstitution).success(function(res){
        $scope.shelterlist = angular.copy(res);
        $scope.datacontrol.shelter = $scope.shelterlist[0].id;
        $scope.viewAll = false;
        $scope.datacontrol.dateyear = moment().format("MMMM - YYYY");
        $scope.refresh();
      });

      $scope.refresh = function(){
        if ($scope.datacontrol.dateyear == "") {
          $scope.datacontrol.dateyear = moment().format("MMMM - YYYY");
        }
        DataService.getResident($scope.datacontrol).success(function(res){
          $scope.query_result = [];
          if (res!==0) {
            for(i=0;i<res.length;i++){
              $scope.query_result.push(res[i]);
            }
          }
        });
      };

      /// binding for modal popup
      $scope.showKasus = function(input){
        $scope.query = input;
        popupMasalah(input.idmasalah);
      };

      $scope.delKasus = function(){
        var r = confirm('Benar ingin menghapus kasus ini ?');
        if(r == true){
          DataService.delKasus($scope.query.idmasalah).success(function(message){
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

    app.service('DataService',function($http){
      this.getShelter = function(idinstitution){
        return $http.post("<?php echo site_url('shelter/getShelter') ?>",{idinstitution:idinstitution});
      };
      this.getResident = function(pass){
        var tdate = moment(pass.dateyear,"MMMM-YYYYY").format("MM/YYYY");
        return $http.post("<?php echo site_url('shelter/getResident') ?>",{shelter:pass.shelter,dateyear:tdate});
      };
      this.delKasus = function(idmasalah){
        return $http.post("<?php echo site_url('kasus/delKasus') ?>",{idmasalah:idmasalah});
      };
    });
  </script>
