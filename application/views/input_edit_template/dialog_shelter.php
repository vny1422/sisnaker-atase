<div id="windowShelter" class="modal fade">
    <div class="modal-dialog dialog-content">
        <div class="modal-content" ng-app="FormApp" ng-controller="ShelterController">
            <div class="modal-header">
                <h4 class="modal-title"><strong>Form Data Shelter</strong></h4>
            </div>
            <div class="modal-body">
                <form action="" class="form-horizontal" name="shForm" novalidate ng-init="pst=false">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Lokasi Shelter</label>
                        <div class="col-sm-8">
                            <select class="form-control" ng-model="shelterform['lokasi']" ng-options="k.organisasi for k in shList"
                                    selectpicker toggle-dropdown>
                            </select>
                        </div>
                    </div>
                    <div class="form-group" >
                        <label class="col-sm-3 control-label">Tanggal Masuk Shelter</label>
                        <div class="col-sm-4">                            
                            <div class="input-group" ng-class="{'has-error':(pst && shForm.inDate.$invalid)}">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="text" class="form-control tglformat" ng-model="shelterform['in']" name="inDate" required></input>
                            </div>
                            <span style="color: red" ng-show="pst && shForm.inDate.$invalid">(* wajib</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tanggal Keluar Shelter</label>
                        <div class="col-sm-4">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="text" class="form-control tglformat" ng-model="shelterform['out']"></input>
                            </div>
                            (* kosongkan jika belum keluar
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Keterangan</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" ng-model="shelterform['info']"></input>              								
                        </div>
                    </div>
                    <div style="height:15px; border-bottom:1px dotted #ABABAB; margin: 10px 0 20px 0"></div>
                    <div style="text-align: center">
                        <button type="button" ng-click="shForm.inDate.$invalid ? pst=true : save(shelterform)" class="btn btn-primary">
                            Simpan
                        </button>
                        <button type="button" ng-click="cancel()" class="btn btn-warning">Batal</button>                        
                    </div>                    
                </form>
            </div>
        </div>
    </div>
</div>