
<!-- page content -->
<div class="right_col" role="main">

  <div class="row">
  </div>
  <br />
  <div class="row" >
    <div class="col-md-12 col-sm-12 col-xs-12">
      <h3 style="text-align: center;"><strong>CREATE JO PACKET</strong></h3>
      <div class="clearfix"></br></div>
      <div class="x_panel">

        <div class="x_content">

          <form class="form-horizontal form-label-left">
          </div>

          <!-- START OF STEP1 -->
          <div class="row" >
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="clearfix"></br></div>
              <div class="x_panel">
                <div class="x_title">
                  <ul class="nav navbar-right panel_toolbox">
                    <form name="aduanform" enctype="multipart/form-data" ng-init="formWarn=false">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </ul>
                      <h4><strong>FIRST-STEP:</strong> PPTKIS DATA</h4>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                      <div class="col-md-8 center-margin">
                        <form class="form-horizontal form-label-left">
                          <div class="form-group">
                            <label>PPTKIS</label>
                            <div>
                              <select class="form-control" ng-model="formdata['pekerjaan']" ng-options="k.idjenispekerjaan as k.namajenispekerjaan for k in sop.pekerjaan"
                              selectpicker="{dropupAuto:false}" toggle-dropdown ng-disabled="disableAll">
                            </select>
                          </div>
                        </div>

                        <div class="form-group">
                          <label>Job Type</label>
                          <div>
                            <select class="form-control" ng-model="formdata['pekerjaan']" ng-options="k.idjenispekerjaan as k.namajenispekerjaan for k in sop.pekerjaan"
                            selectpicker="{dropupAuto:false}" toggle-dropdown ng-disabled="disableAll">
                          </select>
                        </div>
                      </div>
                      <div></br></br></div>
                      <div class="form-group">
                        <div class="col-md-8 col-sm-6 col-xs-12">
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                          <button type="reset" name="cancel" class="btn btn-primary">Cancel</button>
                          <button type="submit" name="submit" class="btn btn-success">Next</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- END OF STEP1 -->

                <!-- START OF STEP2 -->
                <div class="row" >
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="clearfix"></br></div>
                    <div class="x_panel">
                      <div class="x_title">
                        <ul class="nav navbar-right panel_toolbox">
                          <form name="aduanform" enctype="multipart/form-data" ng-init="formWarn=false">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </ul>
                            <h4><strong>SECOND-STEP:</strong> WORKER DATA</h4>
                            <div class="clearfix"></div>
                          </div>
                          <div class="x_content">
                            <div class="col-md-8 center-margin">
                              <form class="form-horizontal form-label-left">
                                <div class="form-group">
                                  <p><i><strong>Please input complete passport number (without space / " " character), and click Add : </i></strong></p> </br>
                                  <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">No.Passport TKI <span class="required">*</span></label>
                                  <div class="col-md-4 col-sm-4 col-xs-12">
                                    <input id="noku" type="text" name="kuno" required="required" class="form-control">
                                  </div>
                                  <div style="margin-left: -55px;" class="col-md-4 col-sm-4 col-xs-12">
                                    <button type="button" class="btn btn-primary" id="btnCheck">Add</button>
                                  </div>
                                </div>
                              </br></br>
                              <p><i>(Your Quota's Remain: Male=0,Female=15,Mixed=0)</i></p>
                              <p><i><strong>List of TKI :</i></strong></p>
                              <ul>
                                <li>AT677397, DEWI RATNANINGSIH, Female <a href="">(edit)</a> <a href="">(cancel)</a></li>
                              </ul>

                              <div></br></br></br></div>
                              <div class="form-group">
                                <div class="col-md-8 col-sm-6 col-xs-12">
                                </div>
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                  <button type="reset" name="cancel" class="btn btn-primary">Cancel</button>
                                  <button type="submit" name="submit" class="btn btn-success">Next</button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- END OF STEP2 -->

                        <!-- START OF STEP3 -->
                        <div class="row" >
                          <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="clearfix"></br></div>
                            <div class="x_panel">
                              <div class="x_title">
                                <ul class="nav navbar-right panel_toolbox">
                                  <form name="aduanform" enctype="multipart/form-data" ng-init="formWarn=false">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </ul>
                                    <h4><strong>THIRD-STEP:</strong> EMPLOYER DATA</h4>
                                    <div class="clearfix"></div>
                                  </div>
                                  <div class="x_content">
                                    <div class="col-md-10 center-margin">
                                      <form class="form-horizontal form-label-left">
                                        <div class="form-group">
                                          <label class="control-label col-md-5 col-sm-5 col-xs-12" for="name">ID No.<span class="required">*</span></label>
                                          <div class="col-md-5 col-sm-5 col-xs-12">
                                            <input type="text" name="name" required="required" class="form-control">
                                          </div>
                                        </div><br /><br /><br />
                                        <div class="form-group">
                                          <label class="control-label col-md-5 col-sm-5 col-xs-12" for="name">Company / Employer Name <span class="required">*</span></label>
                                          <div class="col-md-5 col-sm-5 col-xs-12">
                                            <input type="text" name="name" required="required" class="form-control">
                                          </div>
                                        </div><br /><br /><br />
                                        <div class="form-group">
                                          <label class="control-label col-md-5 col-sm-5 col-xs-12" for="name">Company / Employer Name (Local Languange)<span class="required">*</span></label>
                                          <div class="col-md-5 col-sm-5 col-xs-12">
                                            <input type="text" name="name" required="required" class="form-control">
                                          </div>
                                        </div><br /><br /><br />
                                        <div class="form-group">
                                          <label class="control-label col-md-5 col-sm-5 col-xs-12" for="name">Address<span class="required">*</span></label>
                                          <div class="col-md-5 col-sm-5 col-xs-12">
                                            <input type="text" name="name" required="required" class="form-control">
                                          </div>
                                        </div><br /><br /><br />
                                        <div class="form-group">
                                          <label class="control-label col-md-5 col-sm-5 col-xs-12" for="name">Address (Local Languange)<span class="required">*</span></label>
                                          <div class="col-md-5 col-sm-5 col-xs-12">
                                            <input type="text" name="name" required="required" class="form-control">
                                          </div>
                                        </div><br /><br /><br />
                                        <div class="form-group">
                                          <label class="control-label col-md-5 col-sm-5 col-xs-12" for="name">Phone<span class="required">*</span></label>
                                          <div class="col-md-5 col-sm-5 col-xs-12">
                                            <input type="text" name="name" required="required" class="form-control">
                                          </div>
                                        </div><br /><br /><br />
                                        <div class="form-group">
                                          <label class="control-label col-md-5 col-sm-5 col-xs-12" for="name">Fax<span class="required">*</span></label>
                                          <div class="col-md-5 col-sm-5 col-xs-12">
                                            <input type="text" name="name" required="required" class="form-control">
                                          </div>
                                        </div><br /><br /><br />
                                        <div class="form-group">
                                          <label class="control-label col-md-5 col-sm-5 col-xs-12" for="name">Authorized Person Name<span class="required">*</span></label>
                                          <div class="col-md-5 col-sm-5 col-xs-12">
                                            <input type="text" name="name" required="required" class="form-control">
                                          </div>
                                        </div><br /><br /><br />
                                        <div class="form-group">
                                          <label class="control-label col-md-5 col-sm-5 col-xs-12" for="name">Authorized Person Name (Local Languange)<span class="required">*</span></label>
                                          <div class="col-md-5 col-sm-5 col-xs-12">
                                            <input type="text" name="name" required="required" class="form-control">
                                          </div>
                                        </div><br /><br /><br />

                                        <div></br></br></br></div>
                                        <div class="form-group">
                                          <div class="col-md-8 col-sm-6 col-xs-12">
                                          </div>
                                          <div class="col-md-4 col-sm-6 col-xs-12">
                                            <button type="reset" name="cancel" class="btn btn-primary">Cancel</button>
                                            <button type="submit" name="submit" class="btn btn-success">Next</button>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <!-- END OF STEP3 -->

                                  <!-- START OF STEP4 -->
                                  <div class="row" >
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                      <div class="clearfix"></br></div>
                                      <div class="x_panel">
                                        <div class="x_title">
                                          <ul class="nav navbar-right panel_toolbox">
                                            <form name="aduanform" enctype="multipart/form-data" ng-init="formWarn=false">
                                              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                              </ul>
                                              <h4><strong>FOURTH-STEP:</strong> JOB ORDER DATA</h4>
                                              <div class="clearfix"></div>
                                            </div>
                                            <div class="x_content">
                                              <div class="col-md-10 center-margin">
                                                <form class="form-horizontal form-label-left">
                                                  <div class="form-group">
                                                    <label class="control-label col-md-5 col-sm-5 col-xs-12" for="name">CLA Recruitment Letter No.<span class="required">*</span></label>
                                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                                      <input type="text" name="name" required="required" class="form-control">
                                                    </div>
                                                  </div><br /><br /><br />
                                                  <div class="form-group">
                                                    <label class="control-label col-md-5 col-sm-5 col-xs-12" for="name">Company / Employer Name <span class="required">*</span></label>
                                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                                      <input type="text" name="name" required="required" class="form-control">
                                                    </div>
                                                  </div><br /><br /><br />
                                                  <div class="form-group">
                                                    <label class="control-label col-md-5 col-sm-5 col-xs-12" for="name">Jumlah Tenaga Kerja yang dibutuhkan<span class="required">*</span></label>
                                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                                      <input type="text" name="name" required="required" class="form-control">
                                                    </div>
                                                  </div><br /><br /><br />
                                                  <div class="form-group">
                                                    <label class="control-label col-md-5 col-sm-5 col-xs-12" for="name">Masa Kontrak<span class="required">*</span></label>
                                                    <div class="col-md-1 col-sm-1 col-xs-12">
                                                      <input type="text" name="name" required="required" class="form-control">
                                                    </div>
                                                    <div style="margin-left: -1.5em; margin-top: 0.5em" class="col-md-1 col-sm-1 col-xs-12">
                                                      <p>Tahun</p>
                                                    </div>
                                                    <div class="col-md-1 col-sm-1 col-xs-12">
                                                      <input type="text" name="name" required="required" class="form-control">
                                                    </div>
                                                    <div style="margin-left: -1.5em; margin-top: 0.5em" class="col-md-1 col-sm-1 col-xs-12">
                                                      <p>Bulan</p>
                                                    </div>
                                                    <div class="col-md-1 col-sm-1 col-xs-12">
                                                      <input type="text" name="name" required="required" class="form-control">
                                                    </div>
                                                    <div style="margin-left: -1.5em; margin-top: 0.5em" class="col-md-1 col-sm-1 col-xs-12">
                                                      <p>Hari</p>
                                                    </div>
                                                  </div><br /><br /><br />
                                                  <div class="form-group">
                                                    <label class="control-label col-md-5 col-sm-5 col-xs-12" for="name">Gaji <span class="required">*</span></label>
                                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                                      <input type="text" name="name" required="required" class="form-control">
                                                    </div>
                                                  </div><br /><br /><br />
                                                  <div class="form-group">
                                                    <label class="control-label col-md-5 col-sm-5 col-xs-12" for="name">Catatan </label>
                                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                                      <textarea class="resizable_textarea form-control" name="catatan"></textarea>
                                                    </div>
                                                  </div><br /><br /><br />
                                                  <div></br></br></br></div>
                                                  <div class="form-group">
                                                    <div class="col-md-8 col-sm-6 col-xs-12">
                                                    </div>
                                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                                      <button type="reset" name="cancel" class="btn btn-primary">Cancel</button>
                                                      <button type="submit" name="submit" class="btn btn-success">Next</button>
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                            <!-- END OF STEP4 -->

                                          </div>
                                        </div>
                                        <!-- START OF MODAL -->
                                        <div class="modal fade bs-example-modal-lg" id="modalcheck" tabindex="-1" role="dialog" aria-hidden="true">
                                          <div class="modal-dialog modal-lg">
                                            <div class="modal-content">

                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                                </button>
                                                <h4 class="modal-title" id="myModalLabel"><?php echo $subtitle2; ?></h4>
                                              </div>
                                              <div class="modal-body">
                                                <div class="x_content">
                                                  <br />
                                                  <div class="row" style="padding-top: 20px">
                                                    <div class="col-lg-12">
                                                      <!-- panel -->
                                                      <div class="panel with-nav-tabs panel-info">
                                                        <!-- panel heading -->
                                                        <div class="panel-heading" id="tabs-head">
                                                          <ul class="nav nav-tabs" id="tabs-list">
                                                            <li><a href=#tabworkerdata data-toggle="tab"><strong>Worker Data</strong></a>
                                                            </li>
                                                            <li><a href=#tabphoto data-toggle="tab"><strong>Photo</strong></a>
                                                            </li>
                                                          </ul>
                                                        </div>
                                                        <!-- panel body -->
                                                        <div class="panel-body" ng-controller="AgencyController">
                                                          <div class="tab-content">

                                                            <div class="tab-pane fade in active" id="tabworkerdata">
                                                              <!-- panel body -->
                                                              <div class="panel-body" ng-controller="AgencyController">
                                                                <div class="tab-content">


                                                                  <div class="col-md-12 center-margin">
                                                                    <form class="form-horizontal form-label-left">
                                                                      <div class="form-group">
                                                                        <label class="control-label col-md-6 col-sm-6 col-xs-12" for="name">Worker Name<span class="required">*</span></label>
                                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                                          <p>Setyassida Novian Putra D</p>
                                                                        </div>
                                                                      </div><br /><br />
                                                                      <div class="form-group">
                                                                        <label class="control-label col-md-6 col-sm-6 col-xs-12" for="name">Worker Address<span class="required">*</span></label>
                                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                                          <p>Setyassida Novian Putra D</p>
                                                                        </div>
                                                                      </div><br /><br />
                                                                      <div class="form-group">
                                                                        <label class="control-label col-md-6 col-sm-6 col-xs-12" for="name">ID Pasport<span class="required">*</span></label>
                                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                                          <p>Setyassida Novian Putra D</p>
                                                                        </div>
                                                                      </div><br /><br />
                                                                      <div class="form-group">
                                                                        <label class="control-label col-md-6 col-sm-6 col-xs-12" for="name">Passport Release Date / KTP<span class="required">*</span></label>
                                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                                          <p>Setyassida Novian Putra D</p>
                                                                        </div>
                                                                      </div><br /><br />
                                                                      <div class="form-group">
                                                                        <label class="control-label col-md-6 col-sm-6 col-xs-12" for="name">Passport Release Place<span class="required">*</span></label>
                                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                                          <input type="text" name="name" required="required" class="form-control">
                                                                        </div>
                                                                      </div><br /><br /><br />
                                                                      <div class="form-group">
                                                                        <label class="control-label col-md-6 col-sm-6 col-xs-12" for="name">Birth Date<span class="required">*</span></label>
                                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                                          <p>Setyassida Novian Putra D</p>
                                                                        </div>
                                                                      </div><br /><br />
                                                                      <div class="form-group">
                                                                        <label class="control-label col-md-6 col-sm-6 col-xs-12" for="name">Birth Place<span class="required">*</span></label>
                                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                                          <p>Setyassida Novian Putra D</p>
                                                                        </div>
                                                                      </div><br /><br />
                                                                      <div class="form-group">
                                                                        <label class="control-label col-md-6 col-sm-6 col-xs-12" for="name">Gender<span class="required">*</span></label>
                                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                                          <p>Setyassida Novian Putra D</p>
                                                                        </div>
                                                                      </div><br /><br />
                                                                      <div class="form-group">
                                                                        <label class="control-label col-md-6 col-sm-6 col-xs-12" for="name">Married Status<span class="required">*</span></label>
                                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                                          <div style="margin-top: -0.3em" class="radio">
                                                                            <label>
                                                                              <input type="radio" class="flat" name="iCheck3"> Married &nbsp
                                                                              <input type="radio" class="flat" name="iCheck3"> Single &nbsp
                                                                              <input type="radio" class="flat" name="iCheck3"> Divorced
                                                                            </label>
                                                                          </div>
                                                                        </div>
                                                                      </div><br /><br /><br />
                                                                      <div class="form-group">
                                                                        <label class="control-label col-md-6 col-sm-6 col-xs-12" for="name">Total childs under 18 y.o<span class="required">*</span></label>
                                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                                          <input type="text" name="name" required="required" class="form-control">
                                                                        </div>
                                                                      </div><br /><br /><br />
                                                                      <div class="form-group">
                                                                        <label class="control-label col-md-6 col-sm-6 col-xs-12" for="name">Heirs Name<span class="required">*</span></label>
                                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                                          <input type="text" name="name" required="required" class="form-control">
                                                                        </div>
                                                                      </div><br /><br /><br />
                                                                      <div class="form-group">
                                                                        <label class="control-label col-md-6 col-sm-6 col-xs-12" for="name">Emergency Contact Person Name<span class="required">*</span></label>
                                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                                          <input type="text" name="name" required="required" class="form-control">
                                                                        </div>
                                                                      </div><br /><br /><br />
                                                                      <div class="form-group">
                                                                        <label class="control-label col-md-6 col-sm-6 col-xs-12" for="name">Emergency Contact Person Address<span class="required">*</span></label>
                                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                                          <input type="text" name="name" required="required" class="form-control">
                                                                        </div>
                                                                      </div><br /><br /><br />
                                                                      <div class="form-group">
                                                                        <label class="control-label col-md-6 col-sm-6 col-xs-12" for="name">Emergency Contact Person Number<span class="required">*</span></label>
                                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                                          <input type="text" name="name" required="required" class="form-control">
                                                                        </div>
                                                                      </div><br /><br /><br />
                                                                      <div class="form-group">
                                                                        <label class="control-label col-md-6 col-sm-6 col-xs-12" for="name">Emergency Contact Person Relation<span class="required">*</span></label>
                                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                                          <input type="text" name="name" required="required" class="form-control">
                                                                        </div>
                                                                      </div><br /><br /><br />




                                                                      <div></br></br></br></div>

                                                                    </div>

                                                                  </div>
                                                                </div>
                                                              </div>

                                                              <!-- TAB PHOTO -->
                                                              <div class="tab-pane fade in" id="tabphoto">
                                                                <!-- panel body -->
                                                                <div class="panel-body" ng-controller="AgencyController">
                                                                  <div class="tab-content">
                                                                    <div class="col-lg-4"> </div>
                                                                    <div class="col-lg-4">
                                                                      <h1>CONTENT</h1>
                                                                    </div>
                                                                    <div class="col-lg-4">
                                                                    </div>
                                                                  </div>

                                                                </div>
                                                              </div>


                                                            </div>
                                                          </div>
                                                        </div>
                                                        <!-- end of panel -->
                                                      </div>
                                                    </div>
                                                  </div>
                                                  <div class="clearfix"></div>
                                                </div>

                                                <div class="modal-footer">
                                                  <button type="button" class="btn btn-primary" data-dismiss="modal">Update</button>
                                                </div>

                                              </div>
                                            </div>
                                          </div>
                                          <!-- END OF MODAL -->

                                          <script type="text/javascript">

                                          $(document).ready(function() {
                                            var errorku = $("#errorku");
                                            var wrapper = $("#listkuitansi");
                                            var pilihButton = $(".pilihButton");
                                            var submit = false;
                                            var table = $("#datatable").DataTable( {
                                              "columnDefs": [
                                                {
                                                  "targets": [ 6 ],
                                                  "visible": false
                                                },
                                                {
                                                  "targets": [ 7 ],
                                                  "visible": false
                                                },
                                                {
                                                  "targets": [ 8 ],
                                                  "visible": false
                                                }
                                              ]
                                            });
                                            $(errorku).hide();
                                            $("#btnCheck").click(function(){
                                              var noku = $("#noku").val();
                                              if (noku != ""){
                                                submit = true;
                                                $(errorku).hide();
                                                table.clear();
                                                $.post("<?php echo base_url()?>Kuitansi/checkkuitansi", {noku: noku}, function(data,status){
                                                  var obj = $.parseJSON(data);
                                                  if (obj.length > 0)
                                                  {
                                                    $(wrapper).empty();

                                                    for (var key in obj) {
                                                      if (obj.hasOwnProperty(key)) {
                                                        table.row.add( [
                                                          obj[key]["namadokumen"],
                                                          obj[key]["kupemohon"],
                                                          obj[key]["kukode"],
                                                          obj[key]["kutglmasuk"],
                                                          obj[key]["kutglkuitansi"],
                                                          '<div class="center-button"><button class="btn btn-primary pilihButton" type="button" name="button">Pilih</button></a></div>',
                                                          obj[key]["idtipe"],
                                                          obj[key]["kujmlbayar"],
                                                          obj[key]["kuno"]
                                                        ] ).draw();
                                                      }
                                                    }
                                                    $("#modalcheck").modal();
                                                  }
                                                  else {
                                                    window.alert("No. Kuitansi siap digunakan");
                                                  }
                                                });
                                              }
                                              else {
                                                $(errorku).show();
                                              }
                                            });

                                            $("#ceksubmit").click(function(){
                                              if(submit == false){
                                                window.alert("Cek No Kuitansi terlebih dahulu");
                                              }
                                            });

                                            $(wrapper).on("click",".pilihButton", function(e){ //user click on pilih
                                              e.preventDefault();
                                              var iddokumen = table.row($(this).closest('tr')).data()[6];
                                              var jmlterbayar = table.row($(this).closest('tr')).data()[7];
                                              var nokuitansi = table.row($(this).closest('tr')).data()[8];
                                              var namapemohon = $(this).closest('tr').find("td:nth-child(2)").text();
                                              $("#dokumen").val(iddokumen);
                                              $("#jmlterbayar").val(jmlterbayar);
                                              $("#noku").val(nokuitansi);
                                              $("#pemohon").val(namapemohon);
                                              $("#modalcheck").modal('toggle');
                                            })


                                          });
                                          </script>
