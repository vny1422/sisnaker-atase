<div id="windowPaspor" class="modal fade">
    <div class="modal-dialog dialog-content">
        <div class="modal-content" ng-app="FormApp" ng-controller="PasporController">
            <div class="modal-header">
				<button type="button" data-dismiss="modal" class="btn btn-info pull-right">
					<i class="fa fa-times"></i> Tutup
				</button>
                <h4 class="modal-title"><strong>Data TKI ({{Paspor}})</strong></h4>
            </div>
            <div class="modal-body">
                <div id="paspor-info">
                    <ul class="nav nav-tabs" id="paspor">
						<li class="active">
                            <a href="#tabendors" data-toggle="tab">
                                <strong>Data Endorsment KDEI</strong>
                            </a>
                        </li>
                        <li>
                            <a href="#tabktkln" data-toggle="tab">
                                <strong>Data KTKLN</strong>
                            </a>
                        </li>                        
                    </ul>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade in" id="tabktkln">
                        <div>&nbsp;</div>
                        <form action="" class="form-horizontal" ng-hide="ktkln===0 || ktkln===1 || ktkln===404" >
                            <div class="form-group" ng-repeat="idx in label" >
                                <label class="col-sm-3 control-label">{{::idx.label}} :</label>
								<div class="col-sm-9">
									<p class=form-control-static" style="padding-top: 7px">{{ktkln[idx.key]}}</p>   
								</div>								 
                            </div>
                            <div style="text-align: center" >
                                <button type="button" ng-click="salin(ktkln)" class="btn btn-primary btn-lg">
                                    Salin</button>
                            </div>
                        </form>
                        <div class="text-center" ng-show="ktkln===0">
							<i class="fa fa-cog fa-4x fa-times-circle-o" style="color: #7F0000"></i>
							<h4> Data <strong>KTKLN</strong> tidak tersedia </h4>
						</div>
                        <div class="text-center" ng-show="ktkln===1">
							<i class="fa fa-cog fa-4x fa-spin"></i>
							<h4> Loading... (menghubungi server <strong>KTKLN</strong>) </h4>
						</div>
						<div class="text-center" ng-show="ktkln===404">
							<i class="fa fa-close fa-4x"></i>
							<h4> Server <strong>KTKLN</strong> tidak dapat dihubungi </h4>
						</div>
                    </div>
                    <div class="tab-pane fade in active" id="tabendors">
                        <div>&nbsp;</div>
                        <form action="" class="form-horizontal" ng-hide="endorse===0 || endorse===1">
                            <div class="form-group" ng-repeat="idx in label">
                                <label class="col-sm-3 control-label">{{::idx.label}} :</label>
								<div class="col-sm-9">
									<p class="form-control-static" ng-hide="idx.key=='pekerjaan'">{{endorse[idx.key]}}</p>
									<p class="form-control-static" ng-show="idx.key=='pekerjaan'">{{endorse[idx.key]['jenis']}}</p>
								</div>                                
                            </div>
                            <div style="text-align: center" >
                                <button type="button" ng-click="salin(endorse)" class="btn btn-primary btn-lg">
                                    Salin</button>
                            </div>
                        </form>
                        <div class="text-center" ng-show="endorse===0">
							<i class="fa fa-cog fa-4x fa-times-circle-o" style="color: #7F0000"></i>
							<h4> Data <strong>Endorsement</strong> tidak tersedia </h4>
						</div>
                        <div class="text-center" ng-show="endorse===1">
							<i class="fa fa-cog fa-4x fa-spin"></i>
							<h4> Loading... (menelusuri data <strong>Endorsement</strong>) </h4>
						</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>