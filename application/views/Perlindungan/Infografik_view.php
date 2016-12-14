<style>
  body {
    margin-top: 0;
    margin-bottom: 0;
    font-family: 'Open Sans', sans-serif;
    background-color: #DADFE1;
    color: #6C7A89;
  }
  .heading{
    margin-left: 25px;
    font-size: 32;
    color: #6C7A89;
  }
  .header{
    padding-top: 25px;
    padding-bottom: 25px;
  }
  .bg-hf {
    background-color: white;
  }
  .foot {
    padding-top: 20px;
    padding-bottom: 20px;
    text-align: center;
  }
  .menu {
    padding: 20px 0px;
    text-align: center;
    cursor: pointer;
    /*font-size: 15;*/
  }
  .onselect {
    border-bottom: 3px #2574A9 solid;
    padding-bottom: 5px;
    font-weight: bold;
  }
  .round {
    -moz-border-radius: 4px;
    -webkit-border-radius: 4px;
    -o-border-radius: 4px;
  }
  .card {
    -moz-border-radius: 4px;
    -webkit-border-radius: 4px;
    -o-border-radius: 4px;
    background-color: white;
  }
  .inner-pad{
    padding: 15px !important;
  }
  .inner-pad2{
    padding-top: 15px !important;
    padding-left: 45px !important;
    padding-right: 45px !important;
  }
  .rowmargin{
    margin-top: 25px !important;
  }
  .nbselect{
    border: none;
    padding: inherit;
  }
  .label-A{
    font-size: 20;
    font-weight: 400;
    text-align: right;
  }
  .label-B{
    font-size: 32;
    font-weight: 400;
  }
  .line-legend{
    margin-bottom: 0px;
  }
  .st-selected{
    background-color: cornflowerblue ;
  }
  .ngdialog-content{width :60% !important;}
  .pad-v{
    margin: 5px 0px;
  }
  ol{
    padding-left: 1em;
  }
  li{
    text-indent:-1em;
  }
  .notb-border > td{
    border-bottom: none !important;
  }
</style>
<div class="right_col" role="main" ng-app="InfografikApp">

  <div class="row">
  </div>
  <br />

  <div class="row" ng-controller="MainController">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>
            <strong><?php echo $subtitle; ?></strong>
              <select class="heading nbselect" ng-model="slYear">
                <option>2014</option>
                <option>2015</option>
                <option>2016</option>
              </select>
          </h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
        		<!--- tab menu & content-->
          <div class="panel with-nav-tabs panel-info">
            <div class="panel-heading" id="tabs-head">
              <ul class="nav nav-tabs" id="tabs-list">
                <li class="active"><a ng-click="pickedMenu=0" data-toggle="tab"><strong>Penanganan Aduan</strong></a>
                </li>
                <li><a ng-click="pickedMenu=1" data-toggle="tab"><strong>Tenaga Kerja Indonesia</strong></a>
                </li>
                <li><a ng-click="pickedMenu=2" data-toggle="tab"><strong>Profil Ketenagakerjaan Indonesia</strong></a>
                </li>
              </ul>
            </div>
          </div>
        		<!--- content -->
        		<span ng-view></span>
        		<!--- footer -->
        		<div class="row bg-hf foot round rowmargin">
        			<div class="twelve columns">
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
<!-- application code  -->
  <script type="text/javascript">
    var app = angular.module('InfografikApp', ['chart.js','ngRoute','smart-table','ngDialog','ngSanitize','hc.marked']);

    app.config(["$routeProvider", function($routeProvider) {
        $routeProvider.when("/simpati", {templateUrl: window.location.protocol+"//localhost/sisnaker/assets/template/infografik/simpati.html", controller: "SimpatiController"});
        $routeProvider.when("/tki", {templateUrl: window.location.protocol+"//localhost/sisnaker/assets/template/infografik/tki.html", controller: "TkiController"});
        $routeProvider.when("/profil",  {templateUrl: window.location.protocol+"//localhost/sisnaker/assets/template/infografik/indonesia.html", controller: "ProfilController"});
    }]);

    app.controller('MainController',['$scope', '$document','$http','$timeout','$location','$rootScope',function($scope,$document,$http,$timeout,$location,$rootScope){
        $scope.pickedMenu = 0;
		$scope.menustyle = [false,false,false];
        $scope.$watch('pickedMenu', function(newval,oldval){
			$scope.menustyle = [false,false,false];
            switch (newval) {
                case 0  : $location.url("/simpati"); $scope.menustyle[0]=true; break;
                case 1  : $location.url("/tki"); $scope.menustyle[1]=true; break;
                case 2  : $location.url("/profil"); $scope.menustyle[2]=true; break;
            }
        });

		$scope.slYear = "";
		$scope.$watch("slYear", function(newValue, oldValue) {
			$rootScope.slYear = $scope.slYear;
			$rootScope.$emit('refreshData',newValue);
		});
		$timeout(function(){$scope.slYear="2016"},200);
    }]);

    app.controller('SimpatiController',['$scope', '$document','$http','$timeout','$rootScope','ngDialog',function($scope,$document,$http,$timeout,$rootScope,ngDialog){

		$scope.total = 0;
		$scope.totaluang = "13,000,000";
		$scope.ratio = 90;
		$scope.ratioW = 90;
		$scope.speed = 5;
		$scope.tahun = $rootScope.slYear;
		$scope.arraybulan = ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun",
							 "Jul", "Agu", "Sep", "Okt", "Nop","Des"];
		$scope.dataChart = [];
		$scope.listkategori=[];
		$scope.nowYear = moment().year();

		/// auth variables
		$scope.authID = null;
		$scope.vbLabel = "verify";
		$scope.lockedV = false;
		$scope.url = null;
		$scope.listAduan = [];
		$scope.queryState = " ";
		$scope.dataStats = " ";

		//// simpati refresh
		$scope.SimpatiRefresh = function(xyear){
            $http({	/// async info year
					method	: "post",
					url		: "<?php echo base_url('infografik/get_info_year'); ?>",
					data	: {'y':xyear}
				}).success(function(response){
					//console.log(response);
					$scope.total = angular.copy(response[0]);
					$scope.totaluang = angular.copy(response[2]);
                    $scope.dataChart['kasus'] = $scope.formatchart_kasus(response[1]);
                    $scope.dataChart['uang'] = $scope.formatchart_uang(response[3]);
					$scope.ratio = angular.copy(response[4]);
					$scope.ratioW = angular.copy(response[5]);
					//wN = today.getWeekNum();
					var wN = moment().year();
					if (wN == $scope.tahun) {
                        wN = moment().dayOfYear();
                    }
					else{
						wN = moment('31-12-'+$scope.tahun, "DD-MM-YYYY").dayOfYear();
					}
					wN = wN / 7;
					$scope.speed = (($scope.ratioW / 100)*$scope.total) / wN;
					$scope.speed = Math.floor($scope.speed);
					//console.log($scope.dataChart['kasus']);
				});

			$http({	/// async kategori year
					method	: "post",
					url		: "<?php echo site_url("infografik/get_kategori_year"); ?>",
					data	: {'y':xyear}
				}).success(function(response){
                    $scope.dataChart['kategori'] = $scope.formatchart_kategori(response[0],response[1]);
				});
		}

		$scope.SimpatiRefresh($scope.tahun);

		$rootScope.$on('refreshData',function(evt,ags){
			$scope.tahun = ags;
			$scope.SimpatiRefresh(ags);
		});

		/////////////////////////////////////////
		/// chart formatting
		$scope.formatchart_kasus = function(src) {
			var chartOBJ ={};
			chartOBJ.labels = $scope.arraybulan;
			chartOBJ.series = ['Total','Selesai','Proses'];
			var fin = [];
			var pro = [];
			var tot = [];
			var max = 0;
			for(i=0;i<src.length;i++){
				fin.push(src[i]['fin']);
				pro.push(src[i]['pro']);
				tot.push(src[i]['total']);
				if (max < src[i]['total']) {
					max = src[i]['total'];
				}
			};
			var scalestep = max/5;

			chartOBJ.opts = {};
			chartOBJ.colors = ['#090003','#38852d','#F62459','#090003'];
			chartOBJ.data = [];
			chartOBJ.data.push(tot,fin,pro);
			return chartOBJ;
		};
		$scope.formatchart_uang = function(src) {
                chartOBJ = {};
                chartOBJ.labels = $scope.arraybulan;
                chartOBJ.data = [];
                chartOBJ.series = ["Nominal"];
                max = 0;
                dar = [];
                for(i=0;i<src.length;i++){
                    mval = parseInt(src[i]['uang']);
                    dar.push(mval);
                    if (max < mval) {
                        max = mval;
                    }
                };
                scalestep = max/5;
                chartOBJ.opts = {
                        scaleLabel: function(label){return  ' NT$ ' + label.value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");},
                        // String - Template string for  tooltips
                        tooltipTemplate : function (label) {return 'NT$ ' + label.value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");}
					};
                chartOBJ.colors = ['#38852d'];
                chartOBJ.data.push(dar);
                return chartOBJ;
            };

		$scope.formatchart_kategori = function(label,src) {
			chartOBJ = {};
			chartOBJ.labels = [];
			chartOBJ.data = [];
			chartOBJ.series = ["Kategori"];
			max = 0;
			dar = [];
			for(i=0;i<src.length;i++){
				mval = parseInt(src[i]);
				dar.push(mval);
				if (max < mval) {
					max = mval;
				}
			};

			$scope.listkategori=[];
			for(i=0;i<label.length;i++){
				vn = String.fromCharCode(65+i);
				chartOBJ.labels.push(vn);
				$scope.listkategori.push({alpha:vn,text:label[i]});
			}

			scalestep = max/5;
			chartOBJ.opts = {};
			chartOBJ.colors = ['#F62459'];
			chartOBJ.data.push(dar);
			return chartOBJ;
		};

		///// check auth code
		$scope.verifyID = function(){
			$scope.lockedV = true;

			if ($scope.url==null) {
                $scope.vbLabel = "verifying..";
				$scope.queryState = "Authentication process ...";
            }
			else{
				$scope.url = null;
				$scope.vbLabel = "login";
				$scope.lockedV = false;
				$scope.queryState = "Logged Out";
				$scope.authID = "";
				$scope.dataStats = "";
				$timeout(function(){$scope.queryState = "";},2000);
				return;
			}

			$http({	/// async info year
					method	: "post",
					url		: "<?php echo site_url("infografik/verifyauth"); ?>",
					data	: {'auth':$scope.authID}
				}).success(function(response){
					if (response != "null") {
                        $scope.vbLabel = "Log Out";
						$scope.lockedV = false;
						$scope.url = angular.copy(response);
						$scope.querykasus(0);
                    }
					else{
						$scope.queryState = "Invalid Auth Code";
						$scope.lockedV = false;
						$scope.vbLabel = "login";
						$scope.dataStats = "";
						$scope.url = null;
					}
				}).error(function(response){
					$scope.queryState = "Connection Error";
					$scope.lockedV = false;
					$scope.vbLabel = "login";
					$scope.url = null;
				});
		};

		//// query data
		$scope.dbuffer = {};
		$scope.jtotal = 0;
		$scope.querykasus = function(id){
			var qurl = $scope.url;
			$scope.queryState = "Retrieving data from Server";
			if (id!=0) {
                 qurl = qurl+"/"+id;
            }
			$http({	/// async info year
					method:"get",url:qurl
				}).success(function(response){
					if (response != "null") {
						if (id==0) {
							///query for table
							$scope.jtotal = "Total aduan : "+response[1].length;
							$scope.listAduan = angular.copy(response[1]);
							$scope.dataStats = response[0][0]+"% terselesaikan ("+response[0][1]+" dalam proses)";
						}
						else{
							///query for dialog
							$scope.dbuffer = angular.copy(response);
							//console.log($scope.dbuffer);
							ngDialog.open({
								template: "<?php echo assets_url() ?>"+"template/infografik/detail_kasus_publik.html",
								scope: $scope
							});
						}
						$scope.queryState = $scope.jtotal;
					}
					else{
						$scope.queryState = "Invalid Auth Code";
						$scope.lockedV = false;
						$scope.vbLabel = "login";
						$scope.url = null;
						$scope.dataStats = "";
					}
				}).error(function(response){
					$scope.queryState = "Connection Error";
				});
		}

	}]);

	/////////////////////////////////////////////////////
	///// TKI
	/////////////////////////////////////////////////////
    app.controller('TkiController',['$scope', '$document','$http','$timeout','$rootScope',function($scope,$document,$http,$timeout,$rootScope){
        $scope.arraybulan = ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nop","Des"];
		//// async peta data year
		$scope.dataThisYear = [];
		$scope.dataThisYearTW = [];
		$scope.yearVis = $rootScope.slYear;
		$scope.availS = 0;
		/// async remitansi year
		$scope.availR = 0;
		$scope.dataRemitansi = [];

		//// functions
		$scope.renewTaiwan = function(year){
			//// get data peta
			$http({
				method	: "get",
				url		: "<?php echo site_url("peta_p/dataYear"); ?>"+ "/" +year
			}).success(function(response){
				if (response!=0) {
					console.log(response);
					angular.copy(response[0],$scope.dataThisYearTW);
					angular.copy(response[1],$scope.dataThisYear);
					$scope.formatChartData(0);
					$scope.availS = response[1][0]['maxmonth'];
				}
			});
			//// get data remitansi
			$http({
				method	: "get",
				url		: "<?php echo site_url("infografik/remitansi"); ?>"+ "/" +year
			}).success(function(response){
				if (response!=0) {
					angular.copy(response,$scope.dataRemitansi);
					if(response.length>1) {
						$scope.availR = 1;
						$scope.formatChartRemitansi();
					}
					else $scope.availR = 0;
					//console.log($scope.dataRemitansi);
				}
			});
		}

		$rootScope.$on('refreshData',function(evt,ags){
			$scope.yearVis = ags;
			$scope.renewTaiwan(ags);
		});

		var chartInstances = [];
		$scope.$on('create', function (event, chart) {
			chartInstances.push(chart);
		});


		$scope.renewTaiwan($scope.yearVis);

		/////////// SVG code
		$scope.labelchart = "Taiwan 2015";
		$scope.petaChart = [];
		$scope.remitansiChart = [];

		$scope.formatChartData= function(dataID){
			//console.log(chartInstances.length);

			var tmp = [];
			_.each(chartInstances, function(val,key) {
				if (val.chart.canvas.id != "lineR") {
                    val.destroy();
                }
				else {
					tmp.push(val);
				}
			});
			chartInstances = tmp;


			var tid=0;
			var datasrc = null;
			if(dataID>0) datasrc = $scope.dataThisYear[dataID - 1];
			else datasrc = $scope.dataThisYearTW;

			var d = new Date();
			var mykeys = ['total','formal','informal'];
			var colorkeys = [
							['#F62459','#090003','#090003','#090003'],
							['#38852d','#090003','#090003','#090003'],
							['#F9690E','#090003','#090003','#090003']
							];

			$scope.labelchart = datasrc.nama + " " +$scope.yearVis; //' 2015' ; //' (' +d.getFullYear()+ ')';
			$scope.petaChart = [];

			for(var mkey in mykeys){
				var ekey = mykeys[mkey];
				var chartOBJ = {};
				chartOBJ.labels = $scope.arraybulan;
				chartOBJ.data = [];
				chartOBJ.series = ['mydata'];
				var tmpdata =[]
				var max=0, min=datasrc[0][ekey];

				for(var i=0;i<12;i++){
					tmpdata[i] = datasrc[i][ekey];
					if (!(tmpdata[i]==0)){
						if (tmpdata[i]>max) max = tmpdata[i];
						if (tmpdata[i]<min) min = tmpdata[i];
					}
					else{
						tmpdata[i] = null;
					}
				}

				var divisor = 3
				var scale = 0.1;
				var stepw = max-min;
				var stepwlen = stepw.toString().length;
				stepwlen = stepwlen>0?(stepwlen-1):0;
				stepwlen = stepwlen>3?3:stepwlen;
				if (stepwlen<1) scale = scale * 5;
				min = min-(scale*stepw);
				min = min > 0 ? min:0;
				min = $scope.decimalAdjust("floor",min,stepwlen);
				max = (stepw/(divisor)) + (scale*stepw);
				max = $scope.decimalAdjust("ceil",max,stepwlen);

				chartOBJ.opts = {
					scaleOverride: true,
					scaleSteps: divisor,
					scaleStepWidth: max,
					scaleStartValue: min,
					scaleLabel: "<%=' '+value%>",
					scaleLineColor: "rgba(230,230,230,1)",
				};
				chartOBJ.colors = angular.copy(colorkeys[mkey]);
				chartOBJ.keyVal = angular.copy(datasrc[datasrc['maxmonth']-1]);
				chartOBJ.data.push(angular.copy(tmpdata));
				$scope.petaChart.push(angular.copy(chartOBJ));
			}

			//console.log($scope.petaChart);

		};


		$scope.formatChartRemitansi = function(){

			var tmp = [];
			_.each(chartInstances, function(val,key) {
				if (val.chart.canvas.id == "lineR") {
                    val.destroy();
                }
				else {
					tmp.push(val);
				}
			});
			chartInstances = tmp;

			var rchartOBJ = {};
			rchartOBJ.labels = $scope.arraybulan;
			rchartOBJ.series = ['Taiwan'];
			rchartOBJ.colors = ['#38852d','#090003','#090003','#090003'];
			rchartOBJ.opts = {
                        scaleLabel: function(label){return  ' US$ ' + label.value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");},
                        // String - Template string for  tooltips
                        tooltipTemplate : function (label) {return 'US$ ' + label.value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");}
					};
			//console.log($scope.dataRemitansi[1]);
			rchartOBJ.data = [];
			rchartOBJ.data.push($scope.dataRemitansi[1]);
			$scope.remitansiChart = angular.copy(rchartOBJ);
		}

		$document.ready(function(){
			var clickedID = 0;
			var clickedObj = null;
			var s = Snap("#map");
			var urload = "<?php echo assets_url() ?>tw-all.svg";

			$http.get("<?php echo site_url("peta_p/detailWilayah"); ?>")
				.success(function(response){
					var listWilayah = response;
					Snap.load(urload, function (f) {
						var g = f.select("g");
						s.append(g);
						allpath = g.selectAll("path");

						//$scope.formatChartData(0);

						angular.forEach(allpath.items, function(data,idx){
							var idnum = $scope.explodeval(data.attr('id'));
							var bbox = data.getBBox();
							var label = "";
							if (listWilayah != null && !isNaN(idnum)) {
								if(idnum>0) label = listWilayah[idnum-1]['namawilayah'];
								else label = "Taiwan";
							}
							var x = Snap.parse("<title class='tooltip_style'>"+label+"</title>");
							data.append(x);

							data.click(function() {
								if(clickedObj != null) clickedObj.attr({fill: "#a5c2ed"});
								if(idnum>0) {
									this.attr({fill: "#913D88"});
									clickedID = idnum;
									clickedObj = data;
								}
								$timeout($scope.formatChartData(idnum),500);
							});
							data.mouseover(function() {
								if(idnum>0 && clickedID != idnum) data.attr({fill: "#2e71d5"});
							});
							data.mouseout(function() {
								if(idnum>0 && clickedID != idnum) data.attr({fill: "#a5c2ed"});
							});
						});
					});
				});
		});
		$scope.explodeval = function(datain) {
			var split = datain.split("-");
			return parseInt(split[0]);
		};
		$scope.decimalAdjust = function(type, value, exp) {
			// If the exp is undefined or zero...
			if (typeof exp === 'undefined' || +exp === 0) {
			  return Math[type](value);
			}
			value = +value;
			exp = +exp;
			// If the value is not a number or the exp is not an integer...
			if (isNaN(value) || !(typeof exp === 'number' && exp % 1 === 0)) {
			  return NaN;
			}
			// Shift
			value = value.toString().split('e');
			value = Math[type](+(value[0] + 'e' + (value[1] ? (+value[1] - exp) : -exp)));
			// Shift back
			value = value.toString().split('e');
			return +(value[0] + 'e' + (value[1] ? (+value[1] + exp) : exp));
		}
	}]);

	/////////////////////////////////////////////////////
	///// BNSP
	/////////////////////////////////////////////////////
    app.controller('ProfilController',['$scope', '$document','$http','$timeout',function($scope,$document,$http,$timeout){
        $scope.infoshow = false;
		$scope.ttstyle = "";
		$scope.ttdata = {};
		$scope.bnspdata = [];

		$scope.infobawah = "jamkerja";
		$scope.detailBLK = "";
		$scope.selectedBLK = " ";

		$scope.dotstyle = "";

		/////////// SVG code
		///// document ready for snap init
		$document.ready(function(){
			var it= 0;
			var s = Snap("#mapID");
			var urload = "<?php echo assets_url() ?>indonesia_map.svg";


			Snap.load(urload, function (f) {
				var g = f.select("g");
				s.append(g);
				var allpath = g.selectAll("path");

				var refColor = {};
				var obj = null;

				var currentbox = g.getBBox();

				angular.forEach(allpath.items, function(data,idx){
					var svgid = (data.attr()['id']);
					var idcol = (data.attr()['style']);
					var regx = /\#[a-fA-F0-9]+/g;
					idcol = regx.exec(idcol)[0];    //color

					data.mouseover(function(vx) {
						if (svgid!="backg") {
							data.attr({fill: "#C7282A"});
						}
					});

					data.click(function(vx) {
						//console.log("clicked");

						$scope.dotstyle = {};
						$scope.ttstyle = {};
						$timeout(function(){
							$scope.infoshow=false;
						},10);

						angular.forEach($scope.bnspdata, function(dx,id){
							if (svgid==dx.idpropinsi) {
								$timeout(function(){
									$scope.ttdata = $scope.bnspdata[id];
									if ($scope.ttdata.balai!='') {
										var xx = angular.copy($scope.ttdata.balai);
										if (typeof xx == "string") {
                                            $scope.ttdata.balai = xx.split(",");
                                        }
										else $scope.ttdata.balai = xx;

                                        //$scope.ttdata.balai = xx.split(",");
                                    }
									$scope.detailBLK = "";
									$scope.infoshow=true;
								},200);
								$scope.setPos(vx.layerX,vx.layerY);
								//data.attr({fill: "#C7282A"});
								var elsize = document.getElementById("mapID").getBoundingClientRect();

								$scope.dotstyle.top = (vx.layerY-25)+'px';
								$scope.dotstyle.left = (vx.layerX-25)+'px';
							}
						});

					});

					data.mouseout(function() {
						data.attr({fill: idcol});
					});

				});
			});

		});

		$scope.cleanup = function(){
			$scope.infoshow=false;
		};

		//// bnsp data
		$http.get("<?php echo site_url("infografik/get_bnsp_data"); ?>").
			success(function(res){
				$scope.bnspdata = angular.copy(res);
			});

		$scope.setPos = function(x,y){
			$scope.ttstyle = {};
			var mapelement = document.getElementById("mapID").getBoundingClientRect();

			if (x < (0.5*mapelement.width)) {
                $scope.ttstyle.right = '0px';
            }
			else{
				$scope.ttstyle.left = '0px';
			}
		};

		///update markdown
		$scope.$watch('selectedBLK', function() {
			if ($scope.selectedBLK.length > 3) {
                var fname = $scope.selectedBLK;
				fname = fname.replace(" ","_");
				fname = fname.toLowerCase();
				//console.log(fname);

				$http.get("https://simpati.kdei-taipei.org/v2/assets/markdown/"+fname+".mdown").
					success(function(res){
						$scope.detailBLK = angular.copy(res);
					});

            }
		}, true);



		$scope.expression = "UM_n=UM_t+\\left\\{UM_t\\times\\left(Inflasi_t+\\%\\triangle PDB_t\\right)\\right\\}";
		$scope.E1 = "UM_n";
		$scope.E2 = "UM_t";
		$scope.E3 = "Inflasi_t";
		$scope.E4 = "\\triangle PDB_t";
    }]);


	////////////////////////////////////////////////////////////
	app.directive("mathjaxBind", function() {
		return {
			restrict: "A",
			controller: ["$scope", "$element", "$attrs", function($scope, $element, $attrs) {
				$scope.$watch($attrs.mathjaxBind, function(value) {
					var $script = angular.element("<script type='math/tex'>").
						text(value == undefined ? "" : value);
					$element.html("");
					$element.append($script);
					MathJax.Hub.Queue(["Typeset", MathJax.Hub, $element[0]]);
				});
			}]
		};
	});
  </script>

  <script type="text/x-mathjax-config">
	MathJax.Hub.Config({
	  tex2jax: {inlineMath: [['$','$'], ['\\(','\\)']]}
	});
	MathJax.Hub.Configured();
  </script>
