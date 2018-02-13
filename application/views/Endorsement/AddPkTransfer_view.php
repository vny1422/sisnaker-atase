<style type="text/css">
.fielddata{
  padding-top: 1%;
}
.fieldtitle{
  margin-top: -5%;
}
</style>

<!-- page content -->
<div class="right_col" role="main">

  <div class="row">
  </div>
  <br />
  <div class="row" >
    <div class="col-md-12 col-sm-12 col-xs-12">
      <h3 style="text-align: center;"><strong>Create Transfer (Labour Contract)</strong></h3>
      <div class="clearfix"></br></div>
      <div class="x_panel">



        <div class="x_content">

          <form class="form-horizontal form-label-left" >
          </div>

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
                        <h4><strong>FIRST-STEP:</strong> WORKER DATA</h4>
                        <div class="clearfix"></div>
                      </div>
                      <div class="x_content">
                        <div class="col-md-8 center-margin">
                          <form class="form-horizontal form-label-left">
                            <div class="form-group">
                              <p><i><strong>Please input complete passport number (without space / " " character), and click Add : </i></strong></p> </br>
                              <label class="control-label col-md-3 col-sm-2 col-xs-12" for="name">No.Passport TKI <span class="required">*</span></label>
                              <div class="col-md-4 col-sm-4 col-xs-12">
                                <input id="passport" type="text" name="passport" required="required" class="form-control input2nd">
                              </div>
                              <div style="margin-left: -40px;" class="col-md-4 col-sm-4 col-xs-12">
                                <button type="button" class="btn btn-primary" id="addTKI">Add</button>
                              </div>
                            </div>
                          </br></br>
                          <!-- <div class="form-group">
                          <label class="control-label col-md-2" for="name">Married Status<span class="required">*</span></label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          <div style="margin-top: -0.1em" class="radio">
                          <span style="margin-left: 23%; color: black;">
                          <input type="radio" name="tkistatkwn" value="1"> Ya &nbsp
                        </span>
                        <span style="margin-left: 5%; color: black;">
                        <input type="radio" name="tkistatkwn" value="0"> Tidak &nbsp
                      </span>
                    </div>
                  </div>
                </div><br /><br /><br />
                <div class="form-group">
                <label class="control-label col-md-2" for="name">Married Status<span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                <div style="margin-top: -0.1em" class="radio">
                <span style="margin-left: 23%; color: black;">
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
    </div><br /><br /> -->
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
              <div class="col-md-12">
                <div class="col-md-4"><h4><strong>SECOND-STEP:</strong> EMPLOYER DATA</h4></div>
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
                          <h4><strong>THIRD-STEP:</strong> JOB ORDER DATA</h4>
                          <div class="clearfix"></div>
                        </div>
                        <div class="x_content" >
                          <div class="col-md-10 center-margin">
                            <form class="form-horizontal form-label-left">
                              <div class="form-group">
                                <label class="control-label col-md-5 col-sm-5 col-xs-12" for="name">Local Manpower Authority Recruitment Letter No.<span class="required">*</span></label>
                                <div class="col-md-5 col-sm-5 col-xs-12">
                                  <input type="text" name="name" required="required" id="clano" class="form-control input4th">
                                </div>
                              </div><br /><br /><br />
                              <div class="form-group" >
                                <label class="control-label col-md-5 col-sm-5 col-xs-12" for="name">Local Manpower Authority Recruitment Letter Date<span class="required">*</span></label>
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
              var tkidata = [];
              var wrap2nd = $("#wrap2nd");
              var wrap3rd = $("#wrap3rd");
              var wrap4th = $("#wrap4th");
              var cek1st = false;
              var cek2nd = false;
              var cek3rd = false;
              var jpid = 0;
              var agid;
              var ppkode = 0;
              var addTKI = $("#addTKI");
              var cek = false;


              // $(wrap2nd).hide();
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
                else if (tkidata.length > 0)
                {
                  alert("You already added another Worker!");
                  return;
                }
                else {
                  $("#loading2nd").mask("Loading...");
                  $.post("<?php echo base_url()?>PkNew/checkPaspor", {paspor: paspor}, function(xml,status){
                    var obj = $.parseJSON(xml);
                    if(obj == null)
                    {
                      $("#loading2nd").unmask();
                      alert("Passport is not found. Please contact your Indonesian agency (PPTKIS) partner.")
                      return;
                    }
                    else {
                      $("#loading2nd").unmask();
                      $("#jogaji").val(obj.jpgaji);
                      $("#idno").val(obj.mjktp);
                      $("#employer").val(obj.mjnama);
                      $("#employer2").val(obj.mjnamacn);
                      $("#address").val(obj.mjalmt);
                      $("#address2").val(obj.mjalmtcn);
                      $("#phone").val(obj.mjtelp);
                      $("#fax").val(obj.mjfax);
                      $("#pngjwb").val(obj.mjpngjwb);
                      $("#pngjwb2").val(obj.mjpngjwbcn);
                      tkidata.push(obj);
                      drawTKI();
                      ppkode = obj.ppkode;
                      agid = obj.agid;
                      jpid = obj.idjenispekerjaan;
                      $("#jojmltki").val(tkidata.length);
                    }
                  });
                }
              });

              function drawTKI()
              {
                var el = $("#listtki");
                el.empty();
                if (tkidata.length > 0) {
                  _.each(tkidata, function(tki) {
                    el.append("<li>"+ tki.tkpaspor + ", " + tki.tknama + ", " + (tki.tkjk === "L" ? "Male" : "Female") + " <a delete paspor='" + tki.tkpaspor + "' href='javascript:void(0)'>(cancel)</a></li>");
                  });
                } else {
                  el.html("Empty");
                }

                el.find("a[delete]").click(function() {
                  if (confirm("Are you sure to remove this worker?")) {
                    var tmp = $(this).attr("paspor");
                    for (var i=0; i<tkidata.length; i++) {
                      if (tkidata[i].tkpaspor == tmp) {
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
                var postdata = {
                  agid:agid,
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
                  idjenispekerjaan:jpid,
                  jenispk:2
                };
                var jsondata = JSON.stringify(postdata);
                var posttki = JSON.stringify(tkidata);
                $.post("<?php echo base_url()?>PkNew/insertEJ", {postdata: jsondata, posttki: posttki }, function(data, status){
                  var obj = $.parseJSON(data);
                  window.location.replace("<?php echo base_url()?>Endorsement/printDokumenV2/"+obj);
                })

              });

            });

            </script>
