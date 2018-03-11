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
  
  <br />
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2><strong><?php echo $subtitle; ?></strong></h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <table id="datatable-responsive" class="table table-striped table-bordered table-hover dt-responsive nowrap" cellspacing="" width="100%">
            <thead>
              <tr>
                <th style="display:none;">ID</th>
                <th>Date Filled</th>
                <th>PPTKIS</th>
                <th>Job Type</th>
                <th>Barcode</th>
                <th>Date Endorsed</th>
                <th style="display:none;">ID JP</th>
                <th style="display:none;">PPKODE</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if(isset($rows)){
                foreach($rows as $row): ?>
                <tr>
                  <td style="display:none;"><?php echo $row[0] ?></td>
                  <td><?php echo $row[1] ?></td>
                  <td><?php echo $row[2] ?></td>
                  <td><?php echo $row[3] ?></td>
                  <td><?php echo $row[4] ?></td>
                  <td><?php echo $row[5] ?></td>
                  <td style="display:none;"><?php echo $row[6] ?></td>
                  <td style="display:none;"><?php echo $row[7] ?></td>
                </tr>
              <?php endforeach; }?>
            </tbody>
          </table>
        </div>
        
      </div>
      <br />
    </div>
  </div>
  
  <div class="row checked">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel" id="loading">
        <div class="x_title">
          <h2><strong><?php echo $subtitle2; ?></strong></h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content checked">
          <div class="row" style="padding-top: 20px">
            <div class="col-lg-12">
              <!-- panel -->
              <div class="panel with-nav-tabs panel-default">
                <!-- panel heading -->
                <div class="panel-heading" id="tabs-head">
                  <ul class="nav nav-tabs" id="tabs-list">
                    <li class="active"><a href=#tabjopacket data-toggle="tab"><strong>JO Packet</strong></a>
                    </li>
                    <li><a href=#tabemployer data-toggle="tab"><strong>Employer Data</strong></a>
                    </li>
                    <li><a href=#tabagency data-toggle="tab"><strong>Agency Data</strong></a>
                    </li>
                    <li><a href=#tabpptkis data-toggle="tab"><strong>PPTKIS Data</strong></a>
                    </li>
                    <li><a href=#tabworker data-toggle="tab"><strong>Worker Data</strong></a>
                    </li>
                    <li><a href=#tabdokumen data-toggle="tab"><strong>Surat & Document</strong></a>
                    </li>
                  </ul>
                </div>
                <!-- panel body -->
                <div class="panel-body">
                  <div class="tab-content">
                    <div class="tab-pane fade in active table-responsive" id="tabjopacket">
                      <!-- START OF TAB CONTENT -->
                      <div class="col-lg-12">
                        <div class="form-group">
                          <label class="control-label col-md-4 col-sm-6 col-xs-12">Job Type</label>
                          <div id="lJOJenisPekerjaan" class="col-md-6 col-sm-6 col-xs-12"></div>
                        </div><br /><br />
                        <div class="form-group">
                          <label class="control-label col-md-4 col-sm-6 col-xs-12">CLA Recruitment Letter No.</label>
                          <div id="lJOCLANO" class="col-md-6 col-sm-6 col-xs-12"></div>
                        </div><br /><br />
                        <div class="form-group">
                          <label class="control-label col-md-4 col-sm-6 col-xs-12">CLA Recruitment Letter Date</label>
                          <div id="lJOCLATgl" class="col-md-6 col-sm-6 col-xs-12"></div>
                        </div><br /><br />
                        <div class="form-group">
                          <label class="control-label col-md-4 col-sm-6 col-xs-12">Work As</label>
                          <div id="lJOPosisi" class="col-md-6 col-sm-6 col-xs-12"></div>
                        </div><br /><br />
                        <div class="form-group">
                          <label class="control-label col-md-4 col-sm-6 col-xs-12">Total Workers Needed</label>
                          <div id="lJOJumlahTKI" class="col-md-6 col-sm-6 col-xs-12"></div>
                        </div><br /><br />
                        <div class="form-group">
                          <label class="control-label col-md-4 col-sm-6 col-xs-12">Contract Period</label>
                          <div id="lJOMKTanggal" class="col-md-6 col-sm-6 col-xs-12"></div>
                        </div><br /><br />
                        <div class="form-group">
                          <label class="control-label col-md-4 col-sm-6 col-xs-12">Note</label>
                          <div id="lJOCatatan" class="col-md-6 col-sm-6 col-xs-12"></div>
                        </div><br /><br />
                        <div class="form-group">
                          <label class="control-label col-md-4 col-sm-6 col-xs-12">Salary</label>
                          <div id="lJOGaji" class="col-md-6 col-sm-6 col-xs-12"></div>
                        </div><br /><br />
                      </div>
                      <!-- END OF TAB CONTENT -->
                    </div>
                    <div class="tab-pane fade in table-responsive" id="tabemployer">
                      <div class="col-lg-12">
                        <div class="form-group">
                          <label class="control-label col-md-4 col-sm-6 col-xs-12">ID No.</label>
                          <div id="lMJNoKTP" class="col-md-6 col-sm-6 col-xs-12"></div>
                        </div><br /><br />
                        <div class="form-group">
                          <label class="control-label col-md-4 col-sm-6 col-xs-12">Company / Employer Name</label>
                          <div id="lMJNamaMajikan" class="col-md-6 col-sm-6 col-xs-12"></div>
                        </div><br /><br />
                        <div class="form-group">
                          <label class="control-label col-md-4 col-sm-6 col-xs-12">Address</label>
                          <div id="lMJAlamat" class="col-md-6 col-sm-6 col-xs-12"></div>
                        </div><br /><br />
                        <div class="form-group">
                          <label class="control-label col-md-4 col-sm-6 col-xs-12">Authorized Person Name</label>
                          <div id="lMJPenanggungJawab" class="col-md-6 col-sm-6 col-xs-12"></div>
                        </div><br /><br />
                        <div class="form-group">
                          <label class="control-label col-md-4 col-sm-6 col-xs-12">Phone</label>
                          <div id="lMJTelp" class="col-md-6 col-sm-6 col-xs-12"></div>
                        </div><br /><br />
                        <div class="form-group">
                          <label class="control-label col-md-4 col-sm-6 col-xs-12">Fax</label>
                          <div id="lMJFax" class="col-md-6 col-sm-6 col-xs-12"></div>
                        </div><br />
                      </div>
                    </div>
                    <div class="tab-pane fade in table-responsive" id="tabagency">
                      <div class="col-lg-12">
                        <div class="form-group">
                          <label class="control-label col-md-4 col-sm-6 col-xs-12">Company Name</label>
                          <div id="lAGNamaPerusahaan" class="col-md-6 col-sm-6 col-xs-12"></div>
                        </div><br /><br />
                        <div class="form-group">
                          <label class="control-label col-md-4 col-sm-6 col-xs-12">CLA License Number</label>
                          <div id="lAGNoIjinCLA" class="col-md-6 col-sm-6 col-xs-12"></div>
                        </div><br /><br />
                        <div class="form-group">
                          <label class="control-label col-md-4 col-sm-6 col-xs-12">Address</label>
                          <div id="lAGAlamatKantor" class="col-md-6 col-sm-6 col-xs-12"></div>
                        </div><br /><br />
                        <div class="form-group">
                          <label class="control-label col-md-4 col-sm-6 col-xs-12">Authorized Person Name</label>
                          <div id="lAGPenanggungJawab" class="col-md-6 col-sm-6 col-xs-12"></div>
                        </div><br /><br />
                        <div class="form-group">
                          <label class="control-label col-md-4 col-sm-6 col-xs-12">Phone</label>
                          <div id="lAGTelp" class="col-md-6 col-sm-6 col-xs-12"></div>
                        </div><br /><br />
                        <div class="form-group">
                          <label class="control-label col-md-4 col-sm-6 col-xs-12">Fax</label>
                          <div id="lAGFax" class="col-md-6 col-sm-6 col-xs-12"></div>
                        </div><br />
                      </div>
                    </div>
                    <div class="tab-pane fade in table-responsive" id="tabpptkis">
                      <div class="col-lg-12">
                        <div class="form-group">
                          <label class="control-label col-md-4 col-sm-6 col-xs-12">Company Name</label>
                          <div id="lPPNamaAgen" class="col-md-6 col-sm-6 col-xs-12"></div>
                        </div><br /><br />
                        <div class="form-group">
                          <label class="control-label col-md-4 col-sm-6 col-xs-12">License Number</label>
                          <div id="lPPNoIjin" class="col-md-6 col-sm-6 col-xs-12"></div>
                        </div><br /><br />
                        <div class="form-group">
                          <label class="control-label col-md-4 col-sm-6 col-xs-12">Address</label>
                          <div id="lPPAlamatKantor" class="col-md-6 col-sm-6 col-xs-12"></div>
                        </div><br /><br />
                        <div class="form-group">
                          <label class="control-label col-md-4 col-sm-6 col-xs-12">Authorized Person Name</label>
                          <div id="lPPPenanggungJawab" class="col-md-6 col-sm-6 col-xs-12"></div>
                        </div><br /><br />
                        <div class="form-group">
                          <label class="control-label col-md-4 col-sm-6 col-xs-12">Phone</label>
                          <div id="lPPTelp" class="col-md-6 col-sm-6 col-xs-12"></div>
                        </div><br /><br />
                        <div class="form-group">
                          <label class="control-label col-md-4 col-sm-6 col-xs-12">Fax</label>
                          <div id="lPPFax" class="col-md-6 col-sm-6 col-xs-12"></div>
                        </div><br /><br />
                      </div>
                    </div>
                    <div class="tab-pane fade in table-responsive" id="tabdokumen">
                      <div class="col-lg-12" id="uridokumen">
                      </div>
                    </div>
                    <div class="tab-pane fade in table-responsive" id="tabworker">
                      
                      <table class="table table-striped table-bordered table-hover" id="tabletki">
                        <thead>
                          <tr>
                            <th>Nama TKI</th>
                            <th>Tgl.Lahir</th>
                            <th>Jenis Kelamin</th>
                            <th>Revisi?</th>
                            <th>Diganti Oleh</th>
                            <th>Tgl.Endorsement</th>
                            <th>Alamat</th>
                            <th>No.Paspor</th>
                            <th>Tgl.Pengeluaran</th>
                            <th>Tempat Pengeluaran</th>
                            <th>Tempat Lahir</th>
                            <th>Status Perkawinan</th>
                            <th>Jumlah Anak Tanggungan</th>
                            <th>Nama Ahli Waris</th>
                            <th>Nama Kontak Darurat</th>
                            <th>Alamat Kontak Darurat</th>
                            <th>Telepon Kontak Darurat</th>
                            <th>Hubungan Kontak Darurat</th>
                            <th>Action</th>
                            <th style="display:none;">JK</th>
                            <th style="display:none;">Stat</th>
                            <th style="display:none;">TKID</th>
                          </tr>
                        </thead>
                        <tbody class="table-hover">
                          
                        </tbody>
                      </table>
                      
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
  
  <div class="modal fade bs-example-modal-sm" id="modalinput" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title" id="myModalLabel2">Insert New Passport</h4>
        </div>
        <div class="modal-body">
        	<div class="col-md-12 text-center">
        		<input style="margin-left: 20px" class="form-control input-sm" type="text" name="new_tki_passport" id="new_tki_passport">
        		<br>
        		<button class="btn btn-sm btn-success" id="btnCheck">Check</button>
        	</div>
        </div>
        
      </div>
    </div>
  </div>

  <div class="modal fade bs-example-modal-lg" id="modalconfirm" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title" id="myModalLabel">Detail Data TKI Pengganti</h4>
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
          <button type="submit" class="btn btn-primary" id="btnRevise">Revise</button>
        </div>

      </div>
    </div>
  </div>

  <script>
  $(document).ready(function () {
    var table = $('#datatable-responsive').DataTable({
      "columnDefs": [
        {"targets": [ 0 ],"visible": false,"searchable": false},
        {"targets": [ 6 ],"visible": false,"searchable": false},
        {"targets": [ 7 ],"visible": false,"searchable": false}
      ]
    });
    var tbtki = $('#tabletki').DataTable({
      "bSort" : false,"bLengthChange": false,"scrollX": true,
      "columnDefs" : [
        {
          "targets": [ 19 ],
          "visible": false,
          "searchable": false
        },
        {
          "targets": [ 20 ],
          "visible": false,
          "searchable": false
        },
        {
          "targets": [ 21 ],
          "visible": false,
          "searchable": false
        }
      ]
    });
    var formAddTki = $("#frmAddTki");
    var ejid = '';
    var jpid = '';
    var ppkode = '';
    var jeniskelamin = ''
    var idtkilama = '';
    var isrevisedbefore = false;
    
    $('#tabletki_filter').html("\
    <form class='form-inline' style='margin-bottom:10px'>\
    <div class='col-sm-offset-1 form-group'><label>Search: </label><input type='text' class='form-control' id='searchtki'></div>\
    </form>"
  );
  
  $("#searchtki").keyup(function() {
    tbtki.search($("#searchtki").val()).draw();
  });
  
  $('a[data-toggle="tab"]').on( 'shown.bs.tab', function (e) {
    tbtki.columns.adjust().draw();
  } );

  $('#datatable-responsive tbody').on( 'click', 'tr', function () {
    if ( $(this).hasClass('active') ) {
      $(this).removeClass('active');
    }
    else {
      table.$('tr.active').removeClass('active');
      $(this).addClass('active');
      var data = table.row(this).data();

      ejid = data[0];
      jpid = data[6];
      ppkode = data[7];

      loadDataFromEjId(ejid);
    }
  } );

$('#tabletki tbody').on( 'click', 'tr', function () {
  idtkilama = tbtki.row(this).data()[21];
  jeniskelamin = tbtki.row(this).data()[19];

  if (tbtki.row(this).data()[20] == '1') {
    isrevisedbefore = true;
  }
});

function loadDataFromEjId(ejid)
{
  $.post("<?php echo base_url()?>endorsement/getDataFromEJID", {ejid: ejid}, function(data,status){
    var obj = $.parseJSON(data);
    if(obj.success) {
      $("#lJOJenisPekerjaan").text(": " + obj.namajenispekerjaan);
      $("#lJOCLANO").text(": " + obj.joclano);
      $("#lJOCLATgl").text(": " + obj.joclatgl);
      $("#lJOCLADueDate").text(": " + obj.joestduedate);
      $("#lJOPosisi").text(": " + obj.joposisi);
      $("#lJOJumlahTKI").text(": " + obj.jojmltki);
      var tgl = obj.jomkthn + " Tahun " + obj.jomkbln + " Bulan " + obj.jomkhr + " Hari";
      $("#lJOMKTanggal").text(": " + tgl);
      $("#lJOCatatan").text(": " + obj.jocatatan);
      $("#lJOGaji").text(": " + obj.jpgaji);

      $("#lMJNoKTP").text(": " + obj.mjktp);
      $("#lMJNamaMajikan").text(": " + obj.mjnama);
      $("#lMJAlamat").text(": " + obj.mjalmt);
      $("#lMJTelp").text(": " + obj.mjtelp);
      $("#lMJFax").text(": " + obj.mjfax);
      $("#lMJPenanggungJawab").text(": " + obj.mjpngjwb);

      $("#lAGNamaPerusahaan").text(": " + obj.agnama);
      $("#lAGNoIjinCLA").text(": " + obj.agnoijincla);
      $("#lAGAlamatKantor").text(": " + obj.agalmtkantor);
      $("#lAGPenanggungJawab").text(": " + obj.agpngjwb);
      $("#lAGTelp").text(": " + obj.agtelp);
      $("#lAGFax").text(": " + obj.agfax);

      $("#lPPNamaAgen").text(": " + obj.ppnama);
      $("#lPPAlamatKantor").text(": " + obj.ppalmtkantor);
      $("#lPPTelp").text(": " + obj.pptelp);
      $("#lPPFax").text(": " + obj.ppfax);
      $("#lPPNoIjin").text(": " + obj.ppijin);
      $("#lPPPenanggungJawab").text(": " + obj.pppngjwb);
      $("#uridokumen").html("          <div class=\"form-group\">\
        <label class=\"control-label col-md-4 col-sm-4 col-xs-12\" for=\"barcode\">Silahkan download halaman berikut, dan cetaklah.</label>\
        <br /><br />\
        <div class=\"col-md-3 col-sm-3 col-xs-12\">\
          <a href=\"<?php echo base_url()?>document/"+obj.jodownloadurl+"?x="+obj.md5ej+"\"><button class=\"ladda-button\" data-style=\"expand-right\" data-color=\"blue\" data-size=\"xs\"><span class=\"ladda-label\" style=\"color:white\">Job Order & Surat Kuasa</span></button></a>\
        </div>\
      </div><br /><br />");

      tbtki.clear();

      if (obj.tkiall) {
        for (i = 0; i < obj.tkiall.length; i++) {
          switch(obj.tkiall[i].tkjk) {
            case 'L': $jk = 'Laki-laki'; break;
            case 'P': $jk = 'Perempuan'; break;
            default: $jk = '';
          }
          switch(obj.tkiall[i].tkstatkwn) {
            case '0': $statkwn = 'Belum Menikah'; break;
            case '1': $statkwn = 'Menikah'; break;
            case '2': $statkwn = 'Cerai'; break;
            default: $statkwn = '';
          }
          switch(obj.tkiall[i].tkstat) {
            case '0': $revisi = 'Tidak'; break;
            case '1': $revisi = 'Ya'; break;
          }

          if (!obj.tkiall[i].tktglendorsement || obj.tkiall[i].tkstat == '1') {
            var $btn_revise = '<button type="button" class="btn btn-sm" disabled>Revise</button>';
          } else {
            var $btn_revise = '<button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modalinput">Revise</button>';
          }

          tbtki.row.add( [
            obj.tkiall[i].tknama,
            obj.tkiall[i].tktgllahir,
            $jk,
            $revisi,
            obj.tkiall[i].tkrevnama,
            obj.tkiall[i].tktglendorsement,
            obj.tkiall[i].tkalmtid,
            obj.tkiall[i].tkpaspor,
            obj.tkiall[i].tktglkeluar,
            obj.tkiall[i].tktmptkeluar,
            obj.tkiall[i].tktmptlahir,
            $statkwn,
            obj.tkiall[i].tkjmlanaktanggungan,
            obj.tkiall[i].tkahliwaris,
            obj.tkiall[i].tknama2,
            obj.tkiall[i].tkalmt2,
            obj.tkiall[i].tktelp,
            obj.tkiall[i].tkhub,
            $btn_revise,
            obj.tkiall[i].tkjk,
            obj.tkiall[i].tkstat,
            obj.tkiall[i].tkid
            ] ).draw();

          $("#uridokumen").append("          <div class=\"col-md-12 col-sm-12 col-xs-12\">\
            <a href=\"<?php echo base_url()?>document/"+obj.tkiall[i].tkidownloadurl+"?x="+obj.tkiall[i].md5tki+"\"><button class=\"ladda-button\" data-style=\"expand-right\" data-color=\"green\" data-size=\"xs\"><span class=\"ladda-label\" style=\"color:white\">Surat PK "+obj.tkiall[i].tknama+"</span></button></a>\
          </div><br /><br />");
        }
      }
    }
  });
}

function editDialog(data)
{
  $("#modalconfirm").modal('show');
  $("#modalconfirm").mask('Loading...');

  formAddTki.find("input[type=text]").each(function() {
    $(this).val("");
  });

  formAddTki.find("input[type=radio]").each(function() {
    $(this).prop('checked', false);
  });

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

  $("#imgfoto").attr("src", "http://siskotkln.bnp2tki.go.id/function/get_image.php?img=" + data.TKI_TKIID);

  $("#btnRevise").unbind('click').click(function() {
    if (formAddTki.find("input[name=tkitelp]").val() !== "" && formAddTki.find("input[name=tkijmlhanaktanggungan]").val() !== "" && formAddTki.find("input[name=tkiahliwaris]").val() !== "" && formAddTki.find("input[name=tkinama2]").val() !== "" && formAddTki.find("input[name=tkitelp]").val() !== "") {
      data.tkistatkwn = formAddTki.find("input[name=tkistatkwn]:checked").val();
      data.tkitmptkeluar = formAddTki.find("input[name=tkitmptkeluar]").val();
      data.tkijmlanaktanggungan = formAddTki.find("input[name=tkijmlhanaktanggungan]").val();
      data.tkiahliwaris = formAddTki.find("input[name=tkiahliwaris]").val();
      data.tkinama2 = formAddTki.find("input[name=tkinama2]").val();
      data.tkialmt2 = formAddTki.find("input[name=tkialmt2]").val();
      data.tkitelp = formAddTki.find("input[name=tkitelp]").val();
      data.tkihub = formAddTki.find("input[name=tkihub]").val();

      $("#modalconfirm").modal('hide');
      $("#loading").mask("Loading...");

      $.post("<?php echo base_url()?>endorsement/reviseTKI", {datatki: JSON.stringify(data), ejid: ejid, jpid: jpid, idTkiLama: idtkilama}, function(data,status){
        $("#loading").unmask();
        var obj = $.parseJSON(data);
        alert(obj.message);

        if (obj.success) {
          loadDataFromEjId(ejid);
        }
      });
    }
    else {
      alert('Make sure all fields are filled');
    }
  });

  $("#modalconfirm").unmask();
}
  
$("#btnCheck").click(function() {
  if ($("#new_tki_passport").val() == '') {
    alert("Please input The Passport No. of Worker!");
    return;
  } else if (isrevisedbefore) {
    alert("Maximum number of revision is one time only");
    return;
  }

  $("#modalinput").modal("hide");
  $("#loading").mask("Loading...");

  $.post("<?php echo base_url()?>Endorsement/requestTKI", {paspor: $("#new_tki_passport").val(), jpid: jpid}, function(xml,status){
    $("#loading").unmask();
    var json = $.parseJSON(xml);

    if(json == 0)
    {
      alert("Passport is not found. Please contact your Indonesian agency (PPTKIS) partner.");
    }
    else {
      var agid = json.my_agid;
      var tki_agid = json.tki_agid;
      var data = json.data;

      if (data.TKI_PJTKIID !== ppkode || agid !== tki_agid) {
        alert("Passport " + data.TKI_PASPORNO + " (" + data.TKI_TKINAME + ") is found, but registered for " + data.TKI_PJTKADESC + " - PT. " + data.TKI_PJTKIDESC + ". Please contact your partner PPTKIS to revise it via SISKO System in Indonesia.");
      }
      else if (typeof data.TKI_PASPORNO === "undefined") {
        alert("The Indonesian migrant worker data is still not completed. Please contact your partner PPTKIS to complete it via SISKO System in Indonesia.");
      }
      else if (data.TKI_TKIGENDER !== jeniskelamin) {
        alert("The substitute worker must have same gender as the one being replace.");
      }
      else {
        editDialog(data);
      }
    }
  });
});
  
});
</script>
