
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
                            <select class="form-control input1st"  id="jobtype" toggle-dropdown ng-disabled="disableAll">
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
                                        <?php foreach($employer as $row): ?>
                                          <div class="form-group">
                                            <label class="control-label col-md-5 col-sm-5 col-xs-12" for="name"><?php echo $row->nameinputdetail ?></label>
                                            <div class="col-md-5 col-sm-5 col-xs-12">
                                              <input type="text" name="<?php echo $row->fieldname ?>" class="form-control input3rd">
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
                                                  <?php foreach($joborder as $row): ?>
                                                    <div class="form-group">
                                                      <label class="control-label col-md-5 col-sm-5 col-xs-12" for="name"><?php echo $row->nameinputdetail ?></label>
                                                      <div class="col-md-5 col-sm-5 col-xs-12">
                                                        <input type="text" name="<?php echo $row->fieldname ?>" class="form-control input4th">
                                                      </div>
                                                    </div><br /><br /><br />
                                                  <?php endforeach; ?>
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
                                            <div id="dlgAddTKI" style="padding:0px !important;">
                                                  <div id="tabs">
                                                    <ul>
                                                      <li><a href="#data">WORKER DATA</a></li>
                                                      <li><a href="#foto">PHOTO</a></li>
                                                    </ul>
                                                    <div id="foto">
                                                      <img id="imgfoto" src=""/>
                                                    </div>
                                                    <div id="data">
                                                      <form id="frmAddTki" method="POST" style="padding:10px !important;">
                                                        <div class="row">
                                                          <div class="name3">Nama TKI 勞方姓名 :</div>
                                                          <div class="value label"><span id="tkinama"></span></div>
                                                          <div class="end"></div>
                                                        </div>
                                                        <div class="row">
                                                          <div class="name3">Alamat 印尼地址 :</div>
                                                          <div class="value label"><span id="tkialmtid"></span></div>
                                                          <div class="end"></div>
                                                        </div>
                                                        <div class="row">
                                                          <div class="name3">No. Paspor/KTP 護照號碼/印尼身分證號碼 :</div>
                                                          <div class="value label"><span id="tkipaspor"></span></div>
                                                          <div class="end"></div>
                                                        </div>
                                                        <div class="row">
                                                          <div class="name3">Tgl. Pengeluaran Paspor/ KTP 護照/ 印尼身分證發照日期 :</div>
                                                          <div class="value label"><span id="tkitglkeluar"></span></div>
                                                          <div class="end"></div>
                                                        </div>
                                                        <div class="row">
                                                          <div class="name3">Tempat Pengeluaran Paspor/ KTP 護照/ 印尼身分證發照地點 :</div>
                                                          <div class="value"><input name="tkitmptkeluar" type="text" size="30" maxlength="30"/>(*)</div>
                                                          <div class="end"></div>
                                                        </div>
                                                        <div class="row">
                                                          <div class="name3">Tgl. Lahir 出生日期 :</div>
                                                          <div class="value label"><span id="tkitgllahir"></span></div>
                                                          <div class="end"></div>
                                                        </div>
                                                        <div class="row">
                                                          <div class="name3">Tempat Lahir 出生地點 :</div>
                                                          <div class="value label"><span id="tkitmptlahir"></span></div>
                                                          <div class="end"></div>
                                                        </div>
                                                        <div class="row">
                                                          <div class="name3">Jenis Kelamin 性別 :</div>
                                                          <div class="value label"><span id="tkitkjk"></span></div>
                                                          <div class="end"></div>
                                                        </div>
                                                        <div class="row">
                                                          <div class="name3">Status Perkawinan 婚姻狀況 :</div>
                                                          <div class="value label"><input name="tkistatkwn" type="radio" value="0"/> Married <input name="tkistatkwn" type="radio" value="1"/> Single <input name="tkistatkwn" type="radio" value="2"/> Divorced (*)</div>
                                                          <div class="end"></div>
                                                        </div>
                                                        <div class="row">
                                                          <div class="name3">Jumlah anak dibawah umur 18 tahun dan belum menikah 十八歲以下未婚子女數目 :</div>
                                                          <div class="value"><input name="tkijmlanaktanggungan" type="text" size="2" maxlength="2" style="text-align: right;"/>(*)</div>
                                                          <div class="end"></div>
                                                        </div>
                                                        <div class="row">
                                                          <div class="name3">Nama Ahli Waris 受益人姓名 :</div>
                                                          <div class="value"><input name="tkiahliwaris" type="text" size="50" maxlength="50"/>(*)</div>
                                                          <div class="end"></div>
                                                        </div>
                                                        <div class="row">
                                                          <div class="name3">Nama Kontak Darurat 如遇意外時通知(姓名) :</div>
                                                          <div class="value"><input name="tkinama2" type="text" size="50" maxlength="50"/>(*)</div>
                                                          <div class="end"></div>
                                                        </div>
                                                        <div class="row">
                                                          <div class="name3">Alamat Kontak Darurat 住址 :</div>
                                                          <div class="value"><input name="tkialmt2" type="text" size="70" maxlength="120"/>(*)</div>
                                                          <div class="end"></div>
                                                        </div>
                                                        <div class="row">
                                                          <div class="name3">Telepon Kontak Darurat 電話 :</div>
                                                          <div class="value"><input name="tkitelp" type="text" size="20"  maxlength="20"/>(*)</div>
                                                          <div class="end"></div>
                                                        </div>
                                                        <div class="row">
                                                          <div class="name3">Hubungan Kontak Darurat 關係 :</div>
                                                          <div class="value"><input name="tkihub" type="text" size="30" maxlength="30"/>(*)</div>
                                                          <div class="end"></div>
                                                        </div>
                                                        <div class="form-error"></div>
                                                        <div class="spacer"></div>
                                                        <div class="row">
                                                          <div class="value_right"><input id="btnSubmitForm" type="button" value="Update" style="width:80px;"/></div>
                                                          <div class="end"></div>
                                                        </div>
                                                      </form>
                                                    </div>
                                                  </div>
                                                </div>
                                        <!-- START OF MODAL -->

                                          <!-- END OF MODAL -->

                                          <script type="text/javascript">

                                          $(document).ready(function() {
                                            var data;
                                            var dlg = $("#dlgAddTKI");
                                            var formAddTki = $("#frmAddTki");
                                            var tkidata = [];
                                            $(dlg).dialog({
                                              title:"Worker Data",
                                              autoOpen: false,
                                              width: "850",
                                              height: "auto",
                                              resizable: false,
                                              modal: true,
                                              open : function (event, ui) {
                                                $("#tkinama").html(data.TKI_TKINAME);
                                                $("#tkialmtid").html(data.TKI_TKIADDRESS);
                                                $("#tkipaspor").html(data.TKI_PASPORNO);
                                                $("#tkitglkeluar").html(data.TKI_PASPORDATE);
                                                $("#tkitgllahir").html(data.TKI_TKIDOB);
                                                $("#tkitmptlahir").html(data.TKI_TKIPOBDESC);
                                                $("#tkitkjk").html(data.TKI_TKIGENDER == "L" ? "Male" : "Female");
                                              }
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
                                                    console.log(data);
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
                                              dlg.dialog('open');
                                              dlg.mask("Loading...");
                                              if (!isEdit) {
                                                formAddTki.find("input[type=text]").each(function() {
                                                  $(this).val("");
                                                });

                                                formAddTki.find("input[type=radio]").each(function() {
                                                  $(this).prop('checked', false);
                                                });
                                              }



                                              if (!isEdit) {
                                                formAddTki.find("input[name=tkiahliwaris]").val(data.TKI_TKIFATHERNAME);
                                                formAddTki.find("input[name=tkinama2]").val(data.TKI_TKIFATHERNAME);
                                                formAddTki.find("input[name=tkialmt2]").val(data.TKI_ORTUADDR);
                                                formAddTki.find("input[name=tkihub]").val("AYAH");
                                                formAddTki.find("input[name=tkitmptkeluar]").val(data.TKI_PASPORISSUE);
                                                formAddTki.find("input[name=tkijmlanaktanggungan]").val(data.TKI_JUMLAH_ANAK);
                                                formAddTki.find("input[name=tkitelp]").val(data.TKI_TELPKELUARGA);
                                                if (data.TKI_TKIMARITAL == "009.002") {tempkwn = 0;}
                                                else if (data.TKI_TKIMARITAL == "009.003") {tempkwn = 1;}
                                                else if (data.TKI_TKIMARITAL == "009.001") {tempkwn = 2;}
                                                formAddTki.find("input:radio[name=tkistatkwn]").filter("[value=" + tempkwn + "]").prop('checked', true);
                                              } else if (isEdit) {
                                                formAddTki.find("input:radio[name=tkistatkwn]").filter("[value=" + data.tkistatkwn + "]").prop('checked', true);
                                                formAddTki.find("input[name=tkitmptkeluar]").val(data.tkitmptkeluar);
                                                formAddTki.find("input[name=tkijmlanaktanggungan]").val(data.tkijmlanaktanggungan);
                                                formAddTki.find("input[name=tkiahliwaris]").val(data.tkiahliwaris);
                                                formAddTki.find("input[name=tkinama2]").val(data.tkinama2);
                                                formAddTki.find("input[name=tkialmt2]").val(data.tkialmt2);
                                                formAddTki.find("input[name=tkitelp]").val(data.tkitelp);
                                                formAddTki.find("input[name=tkihub]").val(data.tkihub);
                                              }

                                              $("#tabs").find("#foto").find("img#imgfoto").attr("src", "http://siskotkln.bnp2tki.go.id/function/get_image.php?img=" + data.TKI_TKIID);

                                              dlg.unmask();
                                              if (!isEdit)
                                              tkidata.push(data);
                                            }

                                            $("#btnSubmitForm").click(function(){
                                              drawTKI();
                                              dlg.dialog('close');
                                            });

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
                                                }
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

                                            $("#pptkis").change(function(){
                                              $("#loading1st").mask("Loading...");
                                              $('#jobtype')
                                              .find('option')
                                              .remove()
                                              .end()
                                              .append('<option></option>');                                              ;
                                              var value = $("#pptkis").val();
                                              if(value != "")
                                              {
                                                var splitter = value.split('/');
                                                ppkode = splitter[0];
                                                var jobid = splitter[1];
                                                $.post("<?php echo base_url()?>Endorsement/getJodetail", {jobid: jobid}, function(data,status){
                                                  var obj = $.parseJSON(data);
                                                  $.each(obj, function (i, item) {
                                                    $('#jobtype').append($('<option>', {
                                                      value: item[1]+'/'+item[3]+'/'+item[4]+'/'+item[5],
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
