<div class="right_col" role="main">

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
            <div class="row" style="<?php echo ($_SESSION['role'] == 1 || $_SESSION['role'] == 5 ? "" : "display:none;"); ?>">
              <div class="form-group col-lg-4">
                <label><h2>Institusi</h2></label>
                <select class="form-control" id="list-institusi" name="list-institusi" onchange="setInstField()">
                  <?php
                  if (isset($listinstitusi)) {
                    foreach($listinstitusi as $row):
                      if ($row->idinstitution != 1) {
                        echo "<option value=".$row->idinstitution.">".$row->nameinstitution."</option>";
                      }
                      endforeach;
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="row" style="padding-top: 20px">
              <div class="col-lg-12">
                <div class="panel with-nav-tabs panel-danger">
                  <div class="panel-body">
                    <div class="tab-content">
                      <div role="tabpanel" class="tab-pane fade in active" id="self">
                        <div class="row" style="padding-top: 20px">
                          <div class="col-lg-6 col-md-6">
                            <div class="panel panel-primary">
                              <div class="panel-heading">
                                <div class="row">
                                  <div class="col-xs-1">
                                    <i class="fa fa-list-alt"></i>
                                  </div>
                                  <div class="col-xs-11">
                                    <div>Detail Kasus Bulanan</div>
                                  </div>
                                </div>
                              </div>
                              <div class="panel-body">
                                <form action="" method="post" class="form-horizontal" id="form-detailrekap">
                                  <div class="form-group">
                                    <label class="col-sm-2 control-label">Kasus :</label>
                                    <div class="col-sm-6">
                                      <select class="form-control" required="required" id="status-detailrekap" name="status-detailrekap">
                                        <option value="all">Selesai + Belum Selesai</option>
                                        <option value="1">Belum Selesai</option>
                                        <option value="2">Selesai</option>
                                      </select>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="col-sm-2 control-label">Waktu :</label>
                                    <div class="col-sm-9">
                                      <div class="input-group">
                                        <span class="input-group-addon" id="basic-addon2">
                                          <i class="fa fa-calendar"></i>
                                        </span>
                                        <input type="text" class="form-control" required="required" id="time-detailrekap" name="time-detailrekap" placeholder="Pilih Waktu Rekap">
                                      </div>
                                      <span class="help-block">*Dapat memilih lebih dari satu waktu</span>
                                    </div>
                                  </div>
                                  <input class="idinst" type="hidden" name="idinst" value="" />
                                  <input class="namainst" type="hidden" name="namainst" value="" />

                                  <div class="form-group">
                                    <div class="col-sm-2 col-md-offset-2">
                                     <button type="submit" name="submit-detailrekap" class="btn btn-success" id="bt-detailrekap">
                                      <span class="fa fa-download"></span> Download Laporan
                                    </button>
                                  </div>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>

                        <div class="col-lg-6 col-md-6">
                          <div class="panel panel-primary">
                            <div class="panel-heading">
                              <div class="row">
                                <div class="col-xs-1">
                                  <i class="fa fa-list-alt"></i>
                                </div>
                                <div class="col-xs-11">
                                  <div>Rekap Shelter</div>
                                </div>
                              </div>
                            </div>
                            <div class="panel-body">
                              <form action="" method="post" class="form-horizontal" id="form-shelterrekap">
                                <div class="form-group">
                                  <label for="selectshelter" class="col-sm-2 control-label">Shelter :</label>
                                  <div class="col-sm-5">
                                    <select class="form-control" required="required" id="status-shelterrekap" name="status-shelterrekap" title='Pilih Shelter'>
                                      <option></option>
                                      <?php foreach($listshelter as $row): ?>
                                        <option value="<?php echo $row->id ?>"><?php echo $row->name ?></option>
                                      <?php endforeach; ?>
                                    </select>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-2 control-label">Waktu :</label>
                                  <div class="col-sm-9">
                                    <div class="input-group">
                                      <span class="input-group-addon" id="basic-addon2">
                                        <i class="fa fa-calendar"></i>
                                      </span>
                                      <input type="text" class="form-control" required="required" id="time-shelterrekap" name="time-shelterrekap" placeholder="Pilih Waktu Rekap">
                                    </div>
                                    <span class="help-block">*Dapat memilih lebih dari satu waktu</span>
                                  </div>
                                </div>
                                <input class="idinst" type="hidden" name="idinst" value="" />
                                <input class="namainst" type="hidden" name="namainst" value="" />

                                <div class="form-group">
                                  <div class="col-sm-2 col-md-offset-2">
                                   <button type="submit" name="submit-shelterrekap" class="btn btn-success" id="bt-shelterrekap">
                                    <span class="fa fa-download"></span> Download Laporan
                                  </button>
                                </div>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>

                    </div>
                    <!-- /.row -->
                    <div class="row">
                      <div class="col-lg-6 col-md-6">
                        <div class="panel panel-primary">
                          <div class="panel-heading">
                            <div class="row">
                              <div class="col-xs-1">
                                <i class="fa fa-list-alt"></i>
                              </div>
                              <div class="col-xs-11">
                                <div>Rekap Kasus Bulanan</div>
                              </div>
                            </div>
                          </div>
                          <div class="panel-body">
                            <form action="" method="post" class="form-horizontal" id="form-bulanrekap">
                              <div class="form-group">
                                <label class="col-sm-2 control-label">Dasar :</label>
                                <div class="col-sm-9">
                                  <div class="checkbox checkbox-warning checkbox-inline" >
                                    <input type="checkbox" id="inlineCheckbox1" value="jenis" name="dasar-bulanrekap[]" checked>
                                    <label for="inlineCheckbox1"> Jenis </label>
                                  </div>
                                  <div class="checkbox checkbox-warning checkbox-inline" >
                                    <input type="checkbox" id="inlineCheckbox2" value="sektor" name="dasar-bulanrekap[]">
                                    <label for="inlineCheckbox2"> Sektor </label>
                                  </div>
                                  <div class="checkbox checkbox-warning checkbox-inline" >
                                    <input type="checkbox" id="inlineCheckbox3" value="status" name="dasar-bulanrekap[]">
                                    <label for="inlineCheckbox3"> Status </label>
                                  </div>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-sm-2 control-label">Waktu :</label>
                                <div class="col-sm-9">
                                  <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon2">
                                      <i class="fa fa-calendar"></i>
                                    </span>
                                    <input type="text" name="time-bulanrekap" class="form-control" required="required" id="time-bulanrekap" placeholder="Pilih Waktu Rekap">
                                  </div>
                                  <span class="help-block">*Dapat memilih lebih dari satu waktu</span>
                                </div>
                              </div>
                              <input class="idinst" type="hidden" name="idinst" value="" />
                              <input class="namainst" type="hidden" name="namainst" value="" />

                              <div class="form-group">
                                <div class="col-sm-2 col-md-offset-2">
                                 <button type="submit" name="submit-bulanrekap" class="btn btn-success" id="bt-bulanrekap">
                                  <span class="fa fa-download"></span> Download Laporan
                                </button>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>

                    <div class="col-lg-6 col-md-6">
                      <div class="panel panel-primary">
                        <div class="panel-heading">
                          <div class="row">
                            <div class="col-xs-1">
                              <i class="fa fa-list-alt"></i>
                            </div>
                            <div class="col-xs-11">
                              <div>Rekap Kasus TKI (Kategori Klasifikasi)</div>
                            </div>
                          </div>
                        </div>
                        <div class="panel-body">
                          <form action="" method="post" class="form-horizontal" id="form-kelasrekap">
                            <div class="form-group">
                              <label for="selectklasifikasi" class="col-sm-2 control-label">Kategori :</label>
                              <div class="col-sm-5">
                                <select class="form-control" required="required" id="status-kelasrekap" name="status-kelasrekap" title='Pilih Klasifikasi'>
                                  <option></option>
                                  <?php foreach($listklasifikasi as $row): ?>
                                    <option value="<?php echo $row->name ?>"><?php echo $row->name ?></option>
                                  <?php endforeach; ?>
                                </select>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-2 control-label">Waktu :</label>
                              <div class="col-sm-9">
                                <div class="input-group">
                                  <span class="input-group-addon" id="basic-addon2">
                                    <i class="fa fa-calendar"></i>
                                  </span>
                                  <input type="text" name="time-kelasrekap" class="form-control" required="required" id="time-kelasrekap" placeholder="Pilih Waktu Rekap">
                                </div>
                                <span class="help-block">*Dapat memilih lebih dari satu waktu</span>
                              </div>
                            </div>
                            <input class="idinst" type="hidden" name="idinst" value="" />
                            <input class="namainst" type="hidden" name="namainst" value="" />

                            <div class="form-group">
                              <div class="col-sm-2 col-md-offset-2">
                               <button type="submit" name="submit-kelasrekap" class="btn btn-success" id="bt-kelasrekap">
                                <span class="fa fa-download"></span> Download Laporan
                              </button>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>



                </div>

                <!-- ./ Row -->
                <div class="row">
                  <div class="col-lg-6 col-md-6">
                    <div class="panel panel-primary">
                      <div class="panel-heading">
                        <div class="row">
                          <div class="col-xs-1">
                            <i class="fa fa-list-alt"></i>
                          </div>
                          <div class="col-xs-11">
                            <div>Rekap Kasus Tahunan</div>
                          </div>
                        </div>
                      </div>
                      <div class="panel-body">
                        <form action="" method="post" class="form-horizontal" id="form-tahunrekap">
                          <div class="form-group">
                            <label for="selectSource" class="col-sm-2 control-label">Lingkup :</label>
                            <div class="col-sm-5">
                              <select class="form-control" required="required" id="lokasi-rekap" name="lokasi-rekap" title='Pilih Koleksi'>
                                <option></option>
                                <option value="0">Semua Shelter</option>
                                <?php foreach($listshelter as $row): ?>
                                  <option value="<?php echo $row->id ?>"><?php echo $row->name ?></option>
                                <?php endforeach; ?>
                              </select>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-sm-2 control-label">Waktu :</label>
                            <div class="col-sm-9">
                              <div class="input-group">
                                <span class="input-group-addon" id="basic-addon2">
                                  <i class="fa fa-calendar"></i>
                                </span>
                                <input type="text" class="form-control" required="required" id="time-tahunrekap" name="time-tahunrekap" placeholder="Pilih Waktu Rekap">
                              </div>
                              <span class="help-block">*Dapat memilih lebih dari satu waktu</span>
                            </div>
                          </div>
                          <input class="idinst" type="hidden" name="idinst" value="" />
                          <input class="namainst" type="hidden" name="namainst" value="" />

                          <div class="form-group">
                            <div class="col-sm-2 col-md-offset-2">
                             <button type="submit" name="submit-tahunrekap" class="btn btn-success" id="bt-tahunrekap">
                              <span class="fa fa-download"></span> Download Laporan
                            </button>
                          </div>
                        </div>

                      </form>
                    </div>
                  </div>
                </div>


                <div class="col-lg-6 col-md-6">
                  <div class="panel panel-primary">
                    <div class="panel-heading">
                      <div class="row">
                        <div class="col-xs-1">
                          <i class="fa fa-list-alt"></i>
                        </div>
                        <div class="col-xs-11">
                          <div>Rekap Uang Selamat</div>
                        </div>
                      </div>
                    </div>
                    <div class="panel-body">
                      <form action="" method="post" class="form-horizontal" id="form-uangrekap">
                        <div class="form-group">
                          <label class="col-sm-2 control-label">Waktu :</label>
                          <div class="col-sm-9">
                            <div class="input-group">
                              <span class="input-group-addon" id="basic-addon2">
                                <i class="fa fa-calendar"></i>
                              </span>
                              <input type="text" class="form-control" required="required" id="time-uangrekap" name="time-uangrekap" placeholder="Pilih Waktu Rekap">
                            </div>
                            <span class="help-block">*Dapat memilih lebih dari satu waktu</span>
                          </div>
                        </div>
                        <input class="idinst" type="hidden" name="idinst" value="" />
                        <input class="namainst" type="hidden" name="namainst" value="" />

                        <div class="form-group">
                          <div class="col-sm-2 col-md-offset-2">
                           <button type="submit" name="submit-uangrekap" class="btn btn-success" id="bt-uangrekap">
                            <span class="fa fa-download"></span> Download Laporan
                          </button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>

            </div>

            <!-- ./ Row -->
          </div>

        </div>

      </div>
    </div>
  </div>
</div>
<div class="clearfix"></div>
</div>
</div>
</div>
</div>

<script type="text/javascript">

  var role = <?php echo $_SESSION['role'] ?>;

  if(role == 1 || role == 5) {
    setInstField();
  }

  function setInstField() {
    $(".idinst").val($("#list-institusi").val());
    $(".namainst").val($("#list-institusi option:selected").text());

    $.post("<?php echo base_url()?>Rekap/generateShelter", {idinst: $("#list-institusi").val()}, function(xml,status){
      json = $.parseJSON(xml);

      var htmlshelter = '<option></option>';
      var htmlkelas = '<option></option>';
      var htmltahun = '<option></option><option value="0">Semua Shelter</option>';

      $.each(json[0], function(i,val){
        htmlshelter += '<option value="' + val.id + '">' + val.name + '</option>';
        htmltahun += '<option value="' + val.id + '">' + val.name + '</option>';
      });

      $.each(json[1], function(i,val){
        htmlkelas += '<option value="' + val.name + '">' + val.name + '</option>';
      });

      $("#status-shelterrekap").html(htmlshelter).selectpicker('refresh');
      $("#status-kelasrekap").html(htmlkelas).selectpicker('refresh');
      $("#lokasi-rekap").html(htmltahun).selectpicker('refresh');
    });
  }

  $("#time-detailrekap").datepicker({
    minViewMode : 1,
    multidate :true
  });

  $("#time-bulanrekap").datepicker({
    minViewMode : 1,
    multidate : true
  });

  $("#time-shelterrekap").datepicker({
    minViewMode : 1,
    multidate : true
  });

  $("#time-tahunrekap").datepicker({
    minViewMode : 1,
    minViewMode: 2,
    multidate : true
  });

  $("#time-kelasrekap").datepicker({
    minViewMode : 1,
    minViewMode: 2,
    multidate : true
  });

  $("#time-uangrekap").datepicker({
    minViewMode : 1,
    minViewMode: 2,
    multidate : true
  });

  $("#status-detailrekap").selectpicker();
  $("#status-shelterrekap").selectpicker();
  $("#status-kelasrekap").selectpicker();
  $("#lokasi-rekap").selectpicker();
</script>