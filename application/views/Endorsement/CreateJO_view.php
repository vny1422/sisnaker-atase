
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
                              <select class="form-control input1st" id="pptkis" toggle-dropdown ng-disabled="disableAll">
                            </select>
                          </div>
                        </div>

                        <div class="form-group">
                          <label>Job Type</label>
                          <div>
                            <select class="form-control input1st"  id="jobtype" toggle-dropdown ng-disabled="disableAll">
                          </select>
                        </div>
                      </div>
                      <div></br></br></div>
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12">
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <button id="next1st" class="btn btn-success">Next</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- END OF STEP1 -->


                <!-- START OF STEP2 -->
                <div class="input_fields_wrap"  id="wrap2nd">
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
                                    <input id="passport" type="text" name="passport" required="required" class="form-control input2nd">
                                  </div>
                                  <div style="margin-left: -55px;" class="col-md-4 col-sm-4 col-xs-12">
                                    <button type="button" class="btn btn-primary" id="btnCheck">Add</button>
                                  </div>
                                </div>
                              </br></br>
                              <p><i>(Your Quota's Remain: Male=0,Female=15,Mixed=0)</i></p>
                              <p><i><strong>List of TKI :</i></strong></p>
                              <ul id="listtki">
                               <li>AT677397, DEWI RATNANINGSIH, Female <a href="">(edit)</a> <a href="">(cancel)</a></li>
                              </ul>

                              <div></br></br></br></div>
                              <div class="form-group">
                                <div class="col-md-8 col-sm-6 col-xs-12">
                                </div>
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                  <button id="back2nd" class="btn btn-primary">Back</button>
                                  <button id="next2nd" class="btn btn-success">Next</button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                        <!-- END OF STEP2 -->

                        <!-- START OF STEP3 -->
                        <div class="input_fields_wrap"  id="wrap3rd">
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
                                            <input type="text" name="name" required="required" class="form-control input3rd 3rdrequired">
                                          </div>
                                        </div><br /><br /><br />
                                        <div class="form-group">
                                          <label class="control-label col-md-5 col-sm-5 col-xs-12" for="name">Company / Employer Name <span class="required">*</span></label>
                                          <div class="col-md-5 col-sm-5 col-xs-12">
                                            <input type="text" name="name" required="required" class="form-control input3rd 3rdrequired">
                                          </div>
                                        </div><br /><br /><br />
                                        <div class="form-group">
                                          <label class="control-label col-md-5 col-sm-5 col-xs-12" for="name">Company / Employer Name (Local Languange)<span class="required">*</span></label>
                                          <div class="col-md-5 col-sm-5 col-xs-12">
                                            <input type="text" name="name" required="required" class="form-control input3rd 3rdrequired">
                                          </div>
                                        </div><br /><br /><br />
                                        <div class="form-group">
                                          <label class="control-label col-md-5 col-sm-5 col-xs-12" for="name">Address<span class="required">*</span></label>
                                          <div class="col-md-5 col-sm-5 col-xs-12">
                                            <input type="text" name="name" required="required" class="form-control input3rd 3rdrequired">
                                          </div>
                                        </div><br /><br /><br />
                                        <div class="form-group">
                                          <label class="control-label col-md-5 col-sm-5 col-xs-12" for="name">Address (Local Languange)<span class="required">*</span></label>
                                          <div class="col-md-5 col-sm-5 col-xs-12">
                                            <input type="text" name="name" required="required" class="form-control input3rd 3rdrequired">
                                          </div>
                                        </div><br /><br /><br />
                                        <div class="form-group">
                                          <label class="control-label col-md-5 col-sm-5 col-xs-12" for="name">Phone<span class="required"></span></label>
                                          <div class="col-md-5 col-sm-5 col-xs-12">
                                            <input type="text" name="name" required="required" class="form-control input3rd">
                                          </div>
                                        </div><br /><br /><br />
                                        <div class="form-group">
                                          <label class="control-label col-md-5 col-sm-5 col-xs-12" for="name">Fax<span class="required"></span></label>
                                          <div class="col-md-5 col-sm-5 col-xs-12">
                                            <input type="text" name="name" required="required" class="form-control input3rd">
                                          </div>
                                        </div><br /><br /><br />
                                        <div class="form-group">
                                          <label class="control-label col-md-5 col-sm-5 col-xs-12" for="name">Authorized Person Name<span class="required"></span></label>
                                          <div class="col-md-5 col-sm-5 col-xs-12">
                                            <input type="text" name="name" required="required" class="form-control input3rd">
                                          </div>
                                        </div><br /><br /><br />
                                        <div class="form-group">
                                          <label class="control-label col-md-5 col-sm-5 col-xs-12" for="name">Authorized Person Name (Local Languange)<span class="required">*</span></label>
                                          <div class="col-md-5 col-sm-5 col-xs-12">
                                            <input type="text" name="name" required="required" class="form-control input3rd">
                                          </div>
                                        </div><br /><br /><br />

                                        <div></br></br></br></div>
                                        <div class="form-group">
                                          <div class="col-md-8 col-sm-6 col-xs-12">
                                          </div>
                                          <div class="col-md-4 col-sm-6 col-xs-12">
                                            <button id="back3rd" class="btn btn-primary">Back</button>
                                            <button id="next3rd" class="btn btn-success">Next</button>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>

                                  <!-- END OF STEP3 -->

                                  <!-- START OF STEP4 -->
                                  <div class="input_fields_wrap"  id="wrap4th">
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
                                                      <input type="text" name="name" required="required" class="form-control input4th">
                                                    </div>
                                                  </div><br /><br /><br />
                                                  <div class="form-group">
                                                    <label class="control-label col-md-5 col-sm-5 col-xs-12" for="name">Company / Employer Name <span class="required">*</span></label>
                                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                                      <input type="text" name="name" required="required" class="form-control input4th">
                                                    </div>
                                                  </div><br /><br /><br />
                                                  <div class="form-group">
                                                    <label class="control-label col-md-5 col-sm-5 col-xs-12" for="name">Jumlah Tenaga Kerja yang dibutuhkan<span class="required">*</span></label>
                                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                                      <input type="text" name="name" required="required" class="form-control input4th">
                                                    </div>
                                                  </div><br /><br /><br />
                                                  <div class="form-group">
                                                    <label class="control-label col-md-5 col-sm-5 col-xs-12" for="name">Masa Kontrak<span class="required">*</span></label>
                                                    <div class="col-md-1 col-sm-1 col-xs-12">
                                                      <input type="text" name="name" required="required" class="form-control input4th">
                                                    </div>
                                                    <div style="margin-left: -1.5em; margin-top: 0.5em" class="col-md-1 col-sm-1 col-xs-12">
                                                      <p>Tahun</p>
                                                    </div>
                                                    <div class="col-md-1 col-sm-1 col-xs-12">
                                                      <input type="number" max="100" name="tahun" required="required" class="form-control input4th">
                                                    </div>
                                                    <div style="margin-left: -1.5em; margin-top: 0.5em" class="col-md-1 col-sm-1 col-xs-12">
                                                      <p>Bulan</p>
                                                    </div>
                                                    <div class="col-md-1 col-sm-1 col-xs-12">
                                                      <input type="number" max="100" name="bulan" required="required" class="form-control input4th">
                                                    </div>
                                                    <div style="margin-left: -1.5em; margin-top: 0.5em" class="col-md-1 col-sm-1 col-xs-12">
                                                      <p>Hari</p>
                                                    </div>
                                                  </div><br /><br /><br />
                                                  <div class="form-group">
                                                    <label class="control-label col-md-5 col-sm-5 col-xs-12" for="name">Gaji <span class="required">*</span></label>
                                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                                      <input type="number" max="100" name="hari" required="required" class="form-control input4th">
                                                    </div>
                                                  </div><br /><br /><br />
                                                  <div class="form-group">
                                                    <label class="control-label col-md-5 col-sm-5 col-xs-12" for="name">Catatan </label>
                                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                                      <textarea class="resizable_textarea form-control input4th" name="catatan"></textarea>
                                                    </div>
                                                  </div><br /><br /><br />
                                                  <div></br></br></br></div>
                                                  <div class="form-group">
                                                    <div class="col-md-8 col-sm-6 col-xs-12">
                                                    </div>
                                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                                      <button class="btn btn-primary">Back</button>
                                                      <button type="submit" name="submit" class="btn btn-success">Submit</button>
                                                    </div>
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
                                            var wrap2nd = $("#wrap2nd");
                                            var wrap3rd = $("#wrap3rd");
                                            var wrap4th = $("#wrap4th");
                                            var cek1st = false;
                                            var cek2nd = false;
                                            var cek3rd = false;

                                            $(wrap2nd).hide();
                                            $(wrap3rd).hide();
                                            $(wrap4th).hide();

                                            $("#next1st").click(function(e){
                                              if(cek1st == false)
                                              {
                                                e.preventDefault();
                                                cek1st = true;
                                                $('.input1st').attr('disabled', 'disabled');
                                                $(wrap2nd).show();
                                              }
                                              else {
                                                $('.input1st').attr('disabled', 'disabled');
                                                $('.input2nd').removeAttr('disabled');
                                              }
                                            });

                                            $("#next2nd").click(function(e){
                                              if(cek2nd == false)
                                              {
                                                e.preventDefault();
                                                if ($('#listtki li').length == 0)
                                                {
                                                  window.alert("Please enter TKI Passport first")
                                                }
                                                else {
                                                  cek2nd = true;
                                                  $(wrap3rd).show();
                                                  $('.input2nd').attr('disabled', 'disabled');
                                                }
                                              }
                                              else {
                                                e.preventDefault();
                                                $('.input2nd').attr('disabled', 'disabled');
                                                $('.input3rd').removeAttr('disabled');
                                              }

                                            });

                                            $("#next3rd").click(function(e){
                                              if(cek3rd == false)
                                              {
                                                if($('.3rdrequired').val() != "")
                                                {
                                                  cek3rd = true;
                                                  e.preventDefault();
                                                  $('.input3rd').attr('disabled', 'disabled');
                                                  $(wrap4th).show();
                                                }
                                              }
                                              else {
                                                e.preventDefault();
                                                $('.input3rd').attr('disabled', 'disabled');
                                                $('.input4th').removeAttr('disabled');
                                              }

                                            });

                                            $("#back4th").click(function(e){
                                              e.preventDefault();
                                              $('.input3rd').removeAttr('disabled');
                                              $('.input4th').attr('disabled','disabled');
                                            });

                                            $("#back3rd").click(function(e){
                                              e.preventDefault();
                                              $('.input2nd').removeAttr('disabled');
                                              $('.input3rd').attr('disabled','disabled');
                                            });

                                            $("#back2nd").click(function(e){
                                              e.preventDefault();
                                              $('.input1st').removeAttr('disabled');
                                              $('.input2nd').attr('disabled','disabled');
                                            });

                                          });
                                          </script>
