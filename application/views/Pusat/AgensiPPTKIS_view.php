<div class="right_col" ng-app="AgencyApp" role="main">

    <div class="row">
    </div>
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
              <br />
              <div class="row" style="padding-top: 20px">
                <div class="col-lg-12">
						<!-- panel -->
						<div class="panel with-nav-tabs panel-info">
							<!-- panel heading -->
							<div class="panel-heading" id="tabs-head">
								<ul class="nav nav-tabs" id="tabs-list">
									<li class="active"><a href=#tabagency data-toggle="tab"><strong>Daftar Agensi</strong></a>
									</li>
									<li><a href=#tabpptkis data-toggle="tab"><strong>Daftar PPTKIS</strong></a>
									</li>
									<li><a href=#tabcekalagency data-toggle="tab"><strong>Daftar Cekal Agensi</strong></a>
									</li>
									<li><a href=#tabcekalpptkis data-toggle="tab"><strong>Daftar Cekal PPTKIS</strong></a>
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
						<!-- end of panel -->
					</div>

  <div class="clearfix"></div>
</div>
</div>
</div>
</div>

<script type="text/javascript">
		$('#tabs-list').css('border-bottom','0px');
		$('#tabs-head').css('padding-bottom','0px');

		var templateURL = "<?php echo assets_url() ?>"+"template/";
		//console.log(templateURL);
	</script>


	<script type="text/javascript">
		var app = angular.module('AgencyApp', ['smart-table','ngDialog']);
		app.controller('AgencyController', function($scope,$http,$filter,$timeout,ngDialog) {
			/// safe async -- smart table req
			$scope.agencies_q = [];
			$scope.cekalagencies_q = [];
			$scope.pptkis_q = [];
			$scope.cekalpptkis_q = [];
			/// main table src -- smart table req
			$scope.agencies = [];
			$scope.cekalagencies = [];
			$scope.pptkis = [];
			$scope.cekalpptkis = [];
			$scope.buffer = [];
			$scope.buffer2 = [];

			/// ajax list agency
      $http.get("<?php echo base_url('pusat/get_agency_list') ?>")
      .then(function(response){
        angular.copy(response.data,$scope.agencies_q);
        $scope.agencies = [].concat($scope.agencies_q);
      });
      /// ajax list pptkis
      $http.get("<?php echo base_url('pusat/get_pptkis_list') ?>")
      .then(function(response){
        angular.copy(response.data,$scope.pptkis_q);
        $scope.pptkis = [].concat($scope.pptkis_q);
      });

      $http.get("<?php echo base_url('pusat/get_cekalpptkis_list') ?>")
      .then(function(response){
        console.log(response.data);
        angular.copy(response.data,$scope.cekalpptkis_q);
        $scope.cekalpptkis = [].concat($scope.cekalpptkis_q);
      });

      $http.get("<?php echo base_url('pusat/get_cekalagency_list') ?>")
      .then(function(response){
        console.log(response.data);
        angular.copy(response.data,$scope.cekalagencies_q);
        $scope.cekalagencies = [].concat($scope.cekalagencies_q);
      });


			/// dialog - modal agency
			$scope.detail_agency = function(agenid){
				$scope.buffer = [];
				$scope.buffer2 = [];
				//console.log(agenid);
				$http.get("<?php echo site_url('pusat/get_agency_info') ?>"+"/"+agenid).then(function(response){
						//console.log(response);
						angular.copy(response.data['list'],$scope.buffer2);
            console.log(response.data['list']);
            console.log(response.data['agen']);
						var agen_info = response.data['agen'];
						for(var key in agen_info){
							$scope.buffer.push({field:key,value:agen_info[key]});
						}
						//console.log(response.data);
						ngDialog.open({
							template: templateURL+'detail_agency.html',
							scope: $scope
						});
					});
			};
			/// dialog - modal pptkis
			$scope.detail_pptkis = function(ppkode){
				$scope.buffer = [];
				$scope.buffer2 = [];
				//console.log(ppkode);
				$http.get("<?php echo site_url('pusat/get_pptkis_info') ?>"+"/"+ppkode).then(function(response){
						//console.log(response);
						angular.copy(response.data['list'],$scope.buffer2);
						var pt_info = response.data['pt'];
						for(var key in pt_info){
							$scope.buffer.push({field:key,value:pt_info[key]});
						}
						console.log($scope.buffer);
						ngDialog.open({
							template: templateURL+'detail_pptkis.html',
							scope: $scope
						});
					});
			};

		});

	</script>
