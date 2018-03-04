<div id="windowTL" class="modal fade">
    <div class="modal-dialog dialog-content">
        <div class="modal-content" ng-app="FormApp" ng-controller="TindakController">
            <div class="modal-header">
                <h4 class="modal-title"><strong>Form Tindak Lanjut </strong></h4>
            </div>
            <div class="modal-body">
                <form action="" class="form-horizontal" name="tlForm" ng-init="pst=false">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tanggal Tindak Lanjut :</label>
                        <div class="col-sm-4">                            
                            <div class="input-group" ng-class="{'has-error':(pst && tlForm.tldate.$invalid)}">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="text" class="form-control tglformat" ng-model="formtl.date" name="tldate" required></input>
                            </div>
                            <span style="color: red" ng-show="pst && tlForm.tldate.$invalid">(* wajib</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tindak Lanjut :</label>
                        <div class="col-sm-8">
                            <textarea rows="4" class="form-control" ng-model="formtl.text" style="resize: vertical"
                                      ng-class="{'has-error':(pst && tlForm.tltext.$invalid)}" required name="tltext">
                            </textarea>
                            <span style="color: red" ng-show="pst && tlForm.tltext.$invalid">(* wajib</span>
                        </div>
                    </div>
                    <div class="form-group" ng-show="selection">
                        <label class="col-sm-3 control-label">Petugas :</label>
                        <div class="col-sm-8">
                            <select class="form-control" ng-model="formtl.by" ng-options="k.nama for k in petugas"
                                    selectpicker toggle-dropdown data-live-search="true" data-size="8">
                            </select>
                            
                        </div>
                    </div>
                    <div style="height:15px; border-bottom:1px dotted #ABABAB; margin: 10px 0 20px 0"></div>
                    <div style="text-align: center">
                        <button type="button" ng-click="(tlForm.tltext.$invalid || tlForm.tldate.$invalid) ? pst=true :save(formtl)"
                                style="text-align: center" class="btn btn-primary">
                                Simpan
                        </button>
                        <button type="button" ng-click="cancel()" style="text-align: center" class="btn btn-warning">
                        Batal</button>                        
                    </div>                    
                </form>
            </div>
        </div>
    </div>
</div>