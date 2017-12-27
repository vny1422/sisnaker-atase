<style type="text/css">
  .fielddata{
    padding-top: 1%;
  }
  .fieldtitle{
    margin-top: -5%;
  }
</style>

<!-- start of modal -->
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
                  <li class="active"><a href=#tabworkerdata data-toggle="tab"><strong>Worker Data</strong></a>
                  </li>
                  <li><a href=#tabphoto data-toggle="tab"><strong>Photo</strong></a>
                  </li>
                </ul>
              </div>
              <!-- panel body -->
              <div class="panel-body">
                <div class="tab-content">

                  <div class="tab-pane fade in active" id="tabworkerdata">
                    <!-- panel body -->
                    <div class="panel-body">
                      <div class="tab-content">


                        <div class="col-md-12 center-margin">
                          <form class="form-horizontal form-label-left" id="frmAddTki">
                            <div class="form-group">
                              <label class="control-label col-md-6 col-sm-6 col-xs-12" for="name">Worker Name<span class="required">*</span></label>
                              <div class="col-md-6 col-sm-6 col-xs-12 fielddata">
                                <p id="tkinama"></p>
                              </div>
                            </div><br /><br />
                            <div class="form-group fieldtitle">
                              <label class="control-label col-md-6 col-sm-6 col-xs-12" for="name">Worker Address<span class="required">*</span></label>
                              <div class="col-md-6 col-sm-6 col-xs-12 fielddata">
                                <p id="tkialmtid"></p>
                              </div>
                            </div><br /><br />
                            <div class="form-group fieldtitle">
                              <label class="control-label col-md-6 col-sm-6 col-xs-12" for="name">ID Passport<span class="required">*</span></label>
                              <div class="col-md-6 col-sm-6 col-xs-12 fielddata">
                                <p id="tkipaspor"></p>
                              </div>
                            </div><br /><br />
                            <div class="form-group fieldtitle">
                              <label class="control-label col-md-6 col-sm-6 col-xs-12" for="name">Passport Release Date / KTP<span class="required">*</span></label>
                              <div class="col-md-6 col-sm-6 col-xs-12 fielddata">
                                <p id="tkitglkeluar"></p>
                              </div>
                            </div><br /><br />
                            <div class="form-group fieldtitle">
                              <label class="control-label col-md-6 col-sm-6 col-xs-12" for="name">Passport Release Place<span class="required">*</span></label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="tkitmptkeluar" name="tkitmptkeluar" required="required" class="form-control">
                              </div>
                            </div><br /><br /><br />
                            <div class="form-group fieldtitle">
                              <label class="control-label col-md-6 col-sm-6 col-xs-12" for="name">Birth Date<span class="required">*</span></label>
                              <div class="col-md-6 col-sm-6 col-xs-12 fielddata">
                                <p id="tkitgllahir"></p>
                              </div>
                            </div><br /><br />
                            <div class="form-group fieldtitle">
                              <label class="control-label col-md-6 col-sm-6 col-xs-12" for="name">Birth Place<span class="required">*</span></label>
                              <div class="col-md-6 col-sm-6 col-xs-12 fielddata">
                                <p id="tkitmptlahir"></p>
                              </div>
                            </div><br /><br />
                            <div class="form-group fieldtitle">
                              <label class="control-label col-md-6 col-sm-6 col-xs-12" for="name">Gender<span class="required">*</span></label>
                              <div class="col-md-6 col-sm-6 col-xs-12 fielddata">
                                <p id="tkitkjk"></p>
                              </div>
                            </div><br /><br />
                            <div class="form-group fieldtitle">
                              <label class="control-label col-md-6 col-sm-6 col-xs-12" for="name">Married Status<span class="required">*</span></label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <div style="margin-top: -0.3em" class="radio">
                                    <span style="margin-left: 5%; color: black;">
                                      <input type="radio" name="tkistatkwn" value="0"> Married &nbsp
                                    </span>
                                    <span style="margin-left: 5%; color: black;">
                                      <input type="radio" name="tkistatkwn" value="1"> Single &nbsp
                                    </span>
                                    <span style="margin-left: 5%; color: black;">
                                      <input type="radio" name="tkistatkwn" value="2"> Divorced 
                                    </span>
                                </div>
                              </div>
                            </div><br /><br /><br />
                            <div class="form-group fieldtitle">
                              <label class="control-label col-md-6 col-sm-6 col-xs-12" for="name">Total childs under 18 y.o<span class="required">*</span></label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="tkijmlhanaktanggungan" required="required" class="form-control">
                              </div>
                            </div><br /><br /><br />
                            <div class="form-group fieldtitle">
                              <label class="control-label col-md-6 col-sm-6 col-xs-12" for="name">Heirs Name<span class="required">*</span></label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="tkiahliwaris" required="required" class="form-control">
                              </div>
                            </div><br /><br /><br />
                            <div class="form-group fieldtitle">
                              <label class="control-label col-md-6 col-sm-6 col-xs-12" for="name">Emergency Contact Person Name<span class="required">*</span></label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="tkinama2" required="required" class="form-control">
                              </div>
                            </div><br /><br /><br />
                            <div class="form-group fieldtitle">
                              <label class="control-label col-md-6 col-sm-6 col-xs-12" for="name">Emergency Contact Person Address<span class="required">*</span></label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="tkialmt2" required="required" class="form-control">
                              </div>
                            </div><br /><br /><br />
                            <div class="form-group fieldtitle">
                              <label class="control-label col-md-6 col-sm-6 col-xs-12" for="name">Emergency Contact Person Number<span class="required">*</span></label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="tkitelp" required="required" class="form-control">
                              </div>
                            </div><br /><br /><br />
                            <div class="form-group fieldtitle">
                              <label class="control-label col-md-6 col-sm-6 col-xs-12" for="name">Emergency Contact Person Relation<span class="required">*</span></label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="tkihub" required="required" class="form-control">
                              </div>
                            </div>
                          </form>



                            <div></br></div>

                          </div>

                        </div>
                      </div>
                    </div>

                    <!-- TAB PHOTO -->
                    <div class="tab-pane fade in" id="tabphoto">
                      <!-- panel body -->
                      <div class="panel-body">
                        <div class="tab-content">
                          <div class="col-lg-4"> </div>
                          <div class="col-lg-4">
                            <img id="imgfoto" src=""/>
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
        <button type="submit" class="btn btn-primary" id="btnSubmitForm">Update</button>
      </div>

    </div>
  </div>
</div>

<!-- end of modals -->

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

          <form class="form-horizontal form-label-left" >
          </div>

          <!-- START OF STEP1 -->
          <div class="row" >
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="clearfix"></br></div>
              <div class="x_panel" id="loading1st">
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
                              <select class="form-control input1st" id="pptkis" toggle-dropdown>
                                <option>
                                </option>
                                <?php foreach($listconnpp as $row): ?>
                                    <option value="<?php echo $row->ppkode."/".$row->jobid ?>"><?php echo $row->ppnama ?></option>
                                <?php endforeach; ?>
                            </select>
                          </div>
                        </div>

                        <div class="form-group">
                          <label>Job Type</label>
                          <div>
                            <select class="form-control input1st"  id="jobtype" toggle-dropdown>
                              <option></option>
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
                    <div class="x_panel" id="loading2nd">
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
                                    <button type="button" class="btn btn-primary" id="addTKI">Add</button>
                                  </div>
                                </div>
                              </br></br>
                              <p id="kuota"><i></i></p>
                              <p><i><strong>List of TKI :</i></strong></p>
                              <ul id="listtki">
                               <!-- <li>AT677397, DEWI RATNANINGSIH, Female <a href="">(edit)</a> <a href="">(cancel)</a></li> -->
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
                                          <label class="control-label col-md-5 col-sm-5 col-xs-12" for="name">ID Card No.<span class="required">*</span></label>
                                          <div class="col-md-5 col-sm-5 col-xs-12">
                                            <input type="text" name="name" id="idno" required="required" class="form-control input3rd 3rdrequired">
                                          </div>
                                        </div><br /><br /><br />
                                        <div class="form-group">
                                          <label class="control-label col-md-5 col-sm-5 col-xs-12" for="name">Company / Employer Name <span class="required">*</span></label>
                                          <div class="col-md-5 col-sm-5 col-xs-12">
                                            <input type="text" name="tesad" required="required" id="employer" class="form-control input3rd 3rdrequired">
                                          </div>
                                        </div><br /><br /><br />
                                        <div class="form-group">
                                          <label class="control-label col-md-5 col-sm-5 col-xs-12" for="name">Company / Employer Name (Local Languange)<span class="required">*</span></label>
                                          <div class="col-md-5 col-sm-5 col-xs-12">
                                            <input type="text" name="name" required="required" id="employer2" class="form-control input3rd 3rdrequired">
                                          </div>
                                        </div><br /><br /><br />
                                        <div class="form-group">
                                          <label class="control-label col-md-5 col-sm-5 col-xs-12" for="name">Address<span class="required">*</span></label>
                                          <div class="col-md-5 col-sm-5 col-xs-12">
                                            <input type="text" name="name" required="required" id="address" class="form-control input3rd 3rdrequired">
                                          </div>
                                        </div><br /><br /><br />
                                        <div class="form-group">
                                          <label class="control-label col-md-5 col-sm-5 col-xs-12" for="name">Address (Local Languange)<span class="required">*</span></label>
                                          <div class="col-md-5 col-sm-5 col-xs-12">
                                            <input type="text" name="name" required="required" id="address2" class="form-control input3rd 3rdrequired">
                                          </div>
                                        </div><br /><br /><br />
                                        <div class="form-group">
                                          <label class="control-label col-md-5 col-sm-5 col-xs-12" for="name">Phone<span class="required"></span></label>
                                          <div class="col-md-5 col-sm-5 col-xs-12">
                                            <input type="text" name="name" id="phone" class="form-control input3rd">
                                          </div>
                                        </div><br /><br /><br />
                                        <div class="form-group">
                                          <label class="control-label col-md-5 col-sm-5 col-xs-12" for="name">Fax<span class="required"></span></label>
                                          <div class="col-md-5 col-sm-5 col-xs-12">
                                            <input type="text" name="name" id="fax" class="form-control input3rd">
                                          </div>
                                        </div><br /><br /><br />
                                        <div class="form-group">
                                          <label class="control-label col-md-5 col-sm-5 col-xs-12" for="name">Authorized Person Name<span class="required"></span></label>
                                          <div class="col-md-5 col-sm-5 col-xs-12">
                                            <input type="text" name="name" id="pngjwb" class="form-control input3rd">
                                          </div>
                                        </div><br /><br /><br />
                                        <div class="form-group">
                                          <label class="control-label col-md-5 col-sm-5 col-xs-12" for="name">Authorized Person Name (Local Languange)<span class="required">*</span></label>
                                          <div class="col-md-5 col-sm-5 col-xs-12">
                                            <input type="text" name="name" id="pngjwb2" class="form-control input3rd">
                                          </div>
                                        </div><br /><br /><br />
                                        <?php foreach($employer as $row): ?>
                                          <div class="form-group">
                                            <label class="control-label col-md-5 col-sm-5 col-xs-12" for="name"><?php echo $row->nameinputdetail ?></label>
                                            <div class="col-md-5 col-sm-5 col-xs-12">
                                              <input type="text" id="<?php echo $row->fieldname ?>" class="form-control input3rd">
                                            </div>
                                          </div><br /><br /><br />
                                        <?php endforeach; ?>



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
                                  <div id="scroll4th">
                                  </div>
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
                                            <div class="x_content" >
                                              <div class="col-md-10 center-margin">
                                                <form class="form-horizontal form-label-left">
                                                  <div class="form-group">
                                                    <label class="control-label col-md-5 col-sm-5 col-xs-12" for="name">CLA Recruitment Letter No.<span class="required">*</span></label>
                                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                                      <input type="text" name="name" required="required" id="clano" class="form-control input4th">
                                                    </div>
                                                  </div><br /><br /><br />
                                                  <div class="form-group" >
                                                      <label class="control-label col-md-5 col-sm-5 col-xs-12" for="name">CLA Recruitment Letter Date<span class="required">*</span></label>
                                                      <div class="col-md-5 col-sm-5 col-xs-12">
                                                      <div class="input-group date datepicker col-md-12 col-xs-12" data-provide="datepicker" ng-class="{'has-error':(pst && shForm.inDate.$invalid)}">
                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                        <input id="cladate" type="text" class="form-control tglformat" required></input>
                                                      </div>
                                                    </div>
                                                  </div><br /><br /><br />
                                                  <div class="form-group">
                                                      <label class="control-label col-md-5 col-sm-5 col-xs-12" for="name">Jumlah Tenaga Kerja yang dibutuhkan<span class="required">*</span></label>
                                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                                      <input type="text" readonly name="jojmltki" id="jojmltki" required="required" class="form-control input4th">
                                                    </div>
                                                  </div><br /><br /><br />
                                                  <div class="form-group">
                                                    <label class="control-label col-md-5 col-sm-5 col-xs-12" for="name">Masa Kontrak<span class="required">*</span></label>
                                                    <div class="col-md-1 col-sm-1 col-xs-12">
                                                      <input type="text" id="tahun" required="required" class="form-control input4th">
                                                    </div>
                                                    <div style="margin-left: -1.5em; margin-top: 0.5em" class="col-md-1 col-sm-1 col-xs-12">
                                                      <p>Tahun</p>
                                                    </div>
                                                    <div class="col-md-1 col-sm-1 col-xs-12">
                                                      <input type="number" id="bulan" required="required" class="form-control input4th">
                                                    </div>
                                                    <div style="margin-left: -1.5em; margin-top: 0.5em" class="col-md-1 col-sm-1 col-xs-12">
                                                      <p>Bulan</p>
                                                    </div>
                                                    <div class="col-md-1 col-sm-1 col-xs-12">
                                                      <input type="number" id="hari" required="required" class="form-control input4th">
                                                    </div>
                                                    <div style="margin-left: -1.5em; margin-top: 0.5em" class="col-md-1 col-sm-1 col-xs-12">
                                                      <p>Hari</p>
                                                    </div>
                                                  </div><br /><br /><br />
                                                  <div class="form-group">
                                                    <label class="control-label col-md-5 col-sm-5 col-xs-12" for="name">Gaji <span class="required">*</span></label>
                                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                                      <input type="number" readonly required="required" id="jogaji" class="form-control input4th">
                                                    </div>
                                                  </div><br /><br /><br />
                                                  <div class="form-group">
                                                    <label class="control-label col-md-5 col-sm-5 col-xs-12" for="name">Catatan </label>
                                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                                      <textarea class="resizable_textarea form-control input4th" id="catatan"></textarea>
                                                    </div>
                                                  </div><br /><br /><br />
                                                  <?php foreach($joborder as $row): ?>
                                                    <div class="form-group">
                                                      <label class="control-label col-md-5 col-sm-5 col-xs-12" for="name"><?php echo $row->nameinputdetail ?></label>
                                                      <div class="col-md-5 col-sm-5 col-xs-12">
                                                        <input type="text" id="<?php echo $row->fieldname ?>" class="form-control input4th">
                                                      </div>
                                                    </div><br /><br /><br />
                                                  <?php endforeach; ?>
                                                  <div></br></br></br></div>
                                                  <div class="form-group">
                                                    <div class="col-md-8 col-sm-6 col-xs-12">
                                                    </div>
                                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                                      <button class="btn btn-primary" id="back4th">Back</button>
                                                      <button name="submit" class="btn btn-success" id="submitpost">Submit</button>
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                            <!-- END OF STEP4 -->


                                          <script type="text/javascript">

                                          $(document).ready(function() {
                                            window.smoothScrollTo = (function () {
                                              var timer, start, factor;

                                              return function (target, duration) {
                                                var offset = window.pageYOffset,
                                                delta  = target - window.pageYOffset; // Y-offset difference
                                                duration = duration || 500;              // default 1 sec animation
                                                start = Date.now();                       // get start time
                                                factor = 0;

                                                if( timer ) {
                                                  clearInterval(timer); // stop any running animations
                                                }

                                                function step() {
                                                  var y;
                                                  factor = (Date.now() - start) / duration; // get interpolation factor
                                                  if( factor >= 1 ) {
                                                    clearInterval(timer); // stop animation
                                                    factor = 1;           // clip to max 1.0
                                                  }
                                                  y = factor * delta + offset;
                                                  window.scrollBy(0, y - window.pageYOffset);
                                                }

                                                timer = setInterval(step, 10);
                                                return timer;
                                              };
                                            }());
                                            var data;
                                            var jo;
                                            var dlg = $("#dlgAddTKI");
                                            var formAddTki = $("#frmAddTki");
                                            var tkidata = [];
                                            $(dlg).dialog({
                                              title:"Worker Data",
                                              autoOpen: false,
                                              width: "850",
                                              height: "auto",
                                              resizable: false,
                                              modal: true
                                            });
                                            var wrap2nd = $("#wrap2nd");
                                            var wrap3rd = $("#wrap3rd");
                                            var wrap4th = $("#wrap4th");
                                            var cek1st = false;
                                            var cek2nd = false;
                                            var cek3rd = false;
                                            var jpid = 0;
                                            var ppkode = 0;
                                            var laki = 0;
                                            var perempuan = 0;
                                            var campuran = 0;
                                            var upperboundl = 0;
                                            var upperboundp = 0;
                                            var upperboundc = 0;
                                            var addTKI = $("#addTKI");
                                            var cek = false;


                                            $(wrap2nd).hide();
                                            $(wrap3rd).hide();
                                            $(wrap4th).hide();

                                            $(addTKI).click(function(e){
                                              var paspor = $("#passport").val();
                                              var search = _.find(tkidata, function(d) { return d.TKI_PASPORNO === paspor});
                                              if (search !== undefined) {
                                                alert("Worker already in the list!");
                                                return;
                                              }
                                              else if (paspor == "") {
                                                alert("Please input The Passport No. of Worker!");
                                                return;
                                              }
                                              else {
                                                $("#loading2nd").mask("Loading...");
                                                $.post("<?php echo base_url()?>Endorsement/requestTKI", {paspor: paspor, jpid: jpid}, function(xml,status){
                                                  var json = $.parseJSON(xml);
                                                  if(json == 0)
                                                  {
                                                    $("#loading2nd").unmask();
                                                    alert("Passport is not found. Please contact your Indonesian agency (PPTKIS) partner.")
                                                    return;
                                                  }
                                                  else {
                                                    var agid = json.my_agid;
                                                    var tki_agid = json.tki_agid;
                                                    data = json.data;
                                                    // var agid_mirip = json.tki_agid_mirip;
                                                    var jpid3 = json.jpid;
                                                    if (data.TKI_PJTKIID !== ppkode) {
                                                      $("#loading2nd").unmask();
                                                      alert("Passport " + data.TKI_PASPORNO + " (" + data.TKI_TKINAME + ") is found, but registered for " + data.TKI_PJTKADESC + " - PT. " + data.TKI_PJTKIDESC + ". Please contact your partner PPTKIS to revise it via SISKO System in Indonesia.");
                                                      return;
                                                    }
                                                    else if (agid !== tki_agid) {
                                                      // if (agid == agid_mirip) {
                                                      //   failed = false;
                                                      // }
                                                      // else {failed = true;}
                                                      $("#loading2nd").unmask();
                                                      alert("Passport " + data.TKI_PASPORNO + " (" + data.TKI_TKINAME + ") is found, but registered for " + data.TKI_PJTKADESC + " - PT. " + data.TKI_PJTKIDESC + ". Please contact your partner PPTKIS to revise it via SISKO System in Indonesia.");
                                                      return;
                                                    }
                                                    else if (typeof data.TKI_PASPORNO === "undefined")
                                                    {
                                                      $("#loading2nd").unmask();
                                                      alert("The Indonesian migrant worker data is still not completed. Please contact your partner PPTKIS to complete it via SISKO System in Indonesia.");
					                                            return;
                                                    }
                                                    else {
                                                      var valid = 0;
                                                      var undefinedsex = 0;

                                                      // laki-laki
                                                      if (data.TKI_TKIGENDER === "L") {
                                                        if (laki == 0) {
                                                          if (campuran > 0) {
                                                            campuran--;
                                                            valid = 1;
                                                          }
                                                        } else {
                                                          laki--;
                                                          valid = 1;
                                                        }
                                                      } else if (data.TKI_TKIGENDER === "P") {
                                                        if (perempuan == 0) {
                                                          if (campuran > 0) {
                                                            campuran--;
                                                            valid = 1;
                                                          }
                                                        } else {
                                                          perempuan--;
                                                          valid = 1;
                                                        }
                                                      }
                                                      else {undefinedsex = 1;}
                                                      if (valid) {
                                                        $("#loading2nd").unmask();
                                                        $("#kuota").text('(Your Quota\'s Remain: Male='+laki+',Female='+perempuan+',Mixed='+campuran+')');
                                                        editDialog(data);
                                                      } else if( undefinedsex == 1){
                                                        $("#loading2nd").unmask();
                                                        alert("Please contact your Indonesian Agency (PPTKIS) partner to input Gender Type (Male / Female) of "+ data.TKI_PASPORNO + " (" + data.TKI_TKINAME + ") in SISKO." );
                                                      }
                                                      else {
                                                        $("#loading2nd").unmask();
                                                        alert("You add " + (data.TKI_TKIGENDER === "L"? "a male worker.\n" : "a female worker.\n") + "Your quota has been used up!" );
                                                      }
                                                    }
                                                  }
                                                });
                                              }
                                            });

                                            function editDialog(data,isEdit)
                                            {
                                              isEdit = typeof isEdit === 'undefined' ? false : isEdit;
                                              $("#modalcheck").modal('toggle');
                                              $("#modalcheck").mask('Loading...');
                                              if (!isEdit) {
                                                formAddTki.find("input[type=text]").each(function() {
                                                  $(this).val("");
                                                });

                                                formAddTki.find("input[type=radio]").each(function() {
                                                  $(this).prop('checked', false);
                                                });
                                              }



                                              if (!isEdit) {
                                                $("#tkinama").html(data.TKI_TKINAME);
                                                $("#tkialmtid").html(data.TKI_TKIADDRESS);
                                                $("#tkipaspor").html(data.TKI_PASPORNO);
                                                $("#tkitglkeluar").html(data.TKI_PASPORDATE);
                                                $("#tkitgllahir").html(data.TKI_TKIDOB);
                                                $("#tkitmptlahir").html(data.TKI_TKIPOBDESC);
                                                $("#tkitkjk").html(data.TKI_TKIGENDER == "L" ? "Male" : "Female");
                                                formAddTki.find("input[name=tkiahliwaris]").val(data.TKI_TKIFATHERNAME);
                                                formAddTki.find("input[name=tkinama2]").val(data.TKI_TKIFATHERNAME);
                                                formAddTki.find("input[name=tkialmt2]").val(data.TKI_ORTUADDR);
                                                formAddTki.find("input[name=tkihub]").val("AYAH");
                                                formAddTki.find("input[name=tkitmptkeluar]").val(data.TKI_PASPORISSUE);
                                                formAddTki.find("input[name=tkijmlhanaktanggungan]").val(data.TKI_JUMLAH_ANAK);
                                                formAddTki.find("input[name=tkitelp]").val(data.TKI_TELPKELUARGA);
                                                if (data.TKI_TKIMARITAL == "009.002") {tempkwn = 0;}
                                                else if (data.TKI_TKIMARITAL == "009.003") {tempkwn = 1;}
                                                else if (data.TKI_TKIMARITAL == "009.001") {tempkwn = 2;}
                                                formAddTki.find("input:radio[name=tkistatkwn]").filter("[value=" + tempkwn + "]").prop('checked', true);
                                              } else if (isEdit) {
                                                cek = true;
                                                formAddTki.find("input:radio[name=tkistatkwn]").filter("[value=" + data.tkistatkwn + "]").prop('checked', true);
                                                formAddTki.find("input[name=tkitmptkeluar]").val(data.tkitmptkeluar);
                                                formAddTki.find("input[name=tkijmlanaktanggungan]").val(data.tkijmlanaktanggungan);
                                                formAddTki.find("input[name=tkiahliwaris]").val(data.tkiahliwaris);
                                                formAddTki.find("input[name=tkinama2]").val(data.tkinama2);
                                                formAddTki.find("input[name=tkialmt2]").val(data.tkialmt2);
                                                formAddTki.find("input[name=tkitelp]").val(data.tkitelp);
                                                formAddTki.find("input[name=tkihub]").val(data.tkihub);
                                              }

                                              $("#imgfoto").attr("src", "http://siskotkln.bnp2tki.go.id/function/get_image.php?img=" + data.TKI_TKIID);
                                              $("#modalcheck").unmask();
                                              $("#btnSubmitForm").unbind('click').click(function(){
                                                if (formAddTki.find("input[name=tkitelp]").val() !== "" && formAddTki.find("input[name=tkijmlhanaktanggungan]").val() !== "" && formAddTki.find("input[name=tkiahliwaris]").val() !== "" && formAddTki.find("input[name=tkinama2]").val() !== "" && formAddTki.find("input[name=tkitelp]").val() !== "") {
                                                  data.tkistatkwn = formAddTki.find("input[name=tkistatkwn]:checked").val();
                                                  data.tkitmptkeluar = formAddTki.find("input[name=tkitmptkeluar]").val();
                                                  data.tkijmlanaktanggungan = formAddTki.find("input[name=tkijmlhanaktanggungan]").val();
                                                  data.tkiahliwaris = formAddTki.find("input[name=tkiahliwaris]").val();
                                                  data.tkinama2 = formAddTki.find("input[name=tkinama2]").val();
                                                  data.tkialmt2 = formAddTki.find("input[name=tkialmt2]").val();
                                                  data.tkitelp = formAddTki.find("input[name=tkitelp]").val();
                                                  data.tkihub = formAddTki.find("input[name=tkihub]").val();
                                                  if (!cek)
                                                  {
                                                    tkidata.push(data);
                                                    drawTKI();
                                                  }
                                                  $("#jojmltki").val(tkidata.length);
                                                  $("#modalcheck").modal('hide');
                                                }
                                              else {
                                                window.alert('Pastikan semua data terisi!');
                                              }});
                                            }



                                            function drawTKI()
                                            {
                                              $("#kuota").text('(Your Quota\'s Remain: Male='+laki+',Female='+perempuan+',Mixed='+campuran+')');
                                              var el = $("#listtki");
                                              el.empty();
                                              if (tkidata.length > 0) {
                                                _.each(tkidata, function(tki) {
                                                  el.append("<li>"+ tki.TKI_PASPORNO + ", " + tki.TKI_TKINAME + ", " + (tki.TKI_TKIGENDER === "L" ? "Male" : "Female") + " <a edit paspor='" + tki.TKI_PASPORNO + "' href='javascript:void(0)'>(edit)</a>" + " <a delete paspor='" + tki.TKI_PASPORNO + "' href='javascript:void(0)'>(cancel)</a></li>");
                                                });
                                              } else {
                                                el.html("Empty");
                                              }

                                              el.find("a[edit]").click(function() {
                                                var tmp = $(this).attr("paspor");
                                                editDialog(_.find(tkidata, function(a) { return a.TKI_PASPORNO == tmp }), true);
                                              });

                                              el.find("a[delete]").click(function() {
                                                if (confirm("Are you sure to remove this worker?")) {
                                                  var tmp = $(this).attr("paspor");
                                                  for (var i=0; i<tkidata.length; i++) {
                                                    if (tkidata[i].TKI_PASPORNO == tmp) {
                                                      if (tkidata[i].TKI_TKIGENDER === "L") {
                                                        if (laki <= 0 && campuran < upperboundc) {
                                                          campuran++;
                                                        } else {
                                                          laki++;
                                                        }
                                                      } else if (tkidata[i].TKI_TKIGENDER === "P") {
                                                        if (perempuan <= 0 && campuran < upperboundc) {
                                                          campuran++;
                                                        } else {
                                                          perempuan++;
                                                        }
                                                      }

                                                      delete tkidata[i];
                                                      break;
                                                    }
                                                  }
                                                  tkidata = _.compact(tkidata);
                                                  drawTKI();
                                                }
                                              });
                                            }

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
                                                  smoothScrollTo(document.getElementById('wrap3rd').offsetTop);
                                                }
                                              }
                                              else {
                                                e.preventDefault();
                                                if ($('#listtki li').length == 0)
                                                {
                                                  window.alert("Please enter TKI Passport first")
                                                }
                                                else {
                                                  $('.input2nd').attr('disabled', 'disabled');
                                                  $('.input3rd').removeAttr('disabled');
                                                  smoothScrollTo(document.getElementById('wrap3rd').offsetTop);
                                                }
                                              }

                                            });

                                            $("#next3rd").click(function(e){
                                              if(cek3rd == false)
                                              {
                                                if($('#idno').val() != "" && $('#employer').val() != "" && $('#employer2').val() != "" && $('#address').val() != "" && $('#address2').val() != "")
                                                {
                                                  cek3rd = true;
                                                  $(wrap4th).show();
                                                  e.preventDefault();
                                                  $('.input3rd').attr('disabled', 'disabled');
                                                  document.getElementById('clano').scrollIntoView();
                                                }
                                              }
                                              else {
                                                e.preventDefault();
                                                $('.input3rd').attr('disabled', 'disabled');
                                                $('.input4th').removeAttr('disabled');
                                                document.getElementById('clano').scrollIntoView();
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

                                            $("#submitpost").click(function(e){
                                              e.preventDefault();
                                              var ppkode = $('#pptkis').val().split('/')[0];
                                              var jobid = $('#jobtype').val().split('/')[0];
                                              var selisihl = upperboundl-laki;
                                              var selisihp = upperboundp-perempuan;
                                              var selisihc = upperboundc-campuran;
                                              $('jobtype').val()
                                              var postdata = {
                                                mjktp:$('#idno').val(),
                                                mjnama:$('#employer').val(),
                                                mjnamacn:$('#employer2').val(),
                                                mjalmt:$('#address').val(),
                                                mjalmtcn:$('#address2').val(),
                                                mjtelp:$('#phone').val(),
                                                mjfax:$('#fax').val(),
                                                mjpngjwb:$('#pngjwb').val(),
                                                mjpngjwbcn:$('#pngjwb2').val(),
                                                joclano:$('#clano').val(),
                                                joclatgl:$('#cladate').val(),
                                                jojmltki:$('#jojmltki').val(),
                                                jomkthn:$('#tahun').val(),
                                                jomkbln:$('#bulan').val(),
                                                jomkhr:$('#hari').val(),
                                                jpgaji:$('#jogaji').val(),
                                                jocatatan:$('#catatan').val(),
                                                ppkode:ppkode,
                                                idjenispekerjaan:jobid
                                              };
                                              var jsondata = JSON.stringify(postdata);
                                              var posttki = JSON.stringify(tkidata);
                                              $.post("<?php echo base_url()?>Endorsement/insertEJ", {postdata: jsondata, posttki: posttki, jo: jo, job: jobid,laki: selisihl, perempuan: selisihp, campuran: selisihc}, function(data, status){
                                                var obj = $.parseJSON(data);
                                                window.location.replace("<?php echo base_url()?>Endorsement/printDokumen/"+obj);
                                              })

                                            });



                                            $("#pptkis").change(function(){
                                              $("#loading1st").mask("Loading...");
                                              $('#jobtype')
                                              .find('option')
                                              .remove()
                                              .end()
                                              .append('<option></option>');;
                                              var value = $("#pptkis").val();
                                              if(value != "")
                                              {
                                                var splitter = value.split('/');
                                                ppkode = splitter[0];
                                                jo = splitter[1];
                                                $.post("<?php echo base_url()?>Endorsement/getJodetail", {ppkode : ppkode}, function(data,status){
                                                  var obj = $.parseJSON(data);
                                                  console.log(data);
                                                  $.each(obj, function (i, item) {
                                                    $('#jobtype').append($('<option>', {
                                                      value: item[1]+'/'+item[3]+'/'+item[4]+'/'+item[5]+'/'+item[6],
                                                      text : item[2] + ' {REMAIN: ' + item[3] + "(L) " + item[4] + "(P) " + item[5] + "(C)}"
                                                    }));
                                                  });
                                                });
                                                $("#loading1st").unmask();
                                              }
                                              $("#loading1st").unmask();
                                            });

                                            $("#jobtype").change(function(){
                                              var kuota = $("#jobtype").val();
                                              var kuotastripped = kuota.split('/');
                                              $("#jogaji").val(kuotastripped[4]);
                                              jpid = kuotastripped[0];
                                              laki = kuotastripped[1];
                                              perempuan = kuotastripped[2];
                                              campuran = kuotastripped[3];
                                              upperboundl = kuotastripped[1];
                                              upperboundp = kuotastripped[2];
                                              upperboundc = kuotastripped[3];
                                              $("#kuota").text('(Your Quota\'s Remain: Male='+laki+',Female='+perempuan+',Mixed='+campuran+')');
                                            });

                                          });
                                          </script>
