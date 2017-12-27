
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
    <div class="x_panel">
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
              <div class="panel with-nav-tabs panel-info">
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
                    <li><a href=#tabdokumen data-toggle="tab"><strong>Surat&Dokumen</strong></a>
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

<script>
  $(document).ready(function () {
    var table = $('#datatable-responsive').DataTable({"columnDefs": [{"targets": [ 0 ],"visible": false,"searchable": false}]});
    var tbtki = $('#tabletki').DataTable({"bSort" : false,"bLengthChange": false,"scrollX": true});

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
            $.post("<?php echo base_url()?>endorsement/getDataFromEJID", {ejid: data[0]}, function(data,status){
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
                          </div><br /><br />")

                tbtki.clear();
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
                    obj.tkiall[i].tkhub
                    ] ).draw();

                $("#uridokumen").append("          <div class=\"col-md-12 col-sm-12 col-xs-12\">\
                            <a href=\"<?php echo base_url()?>document/"+obj.tkiall[i].tkidownloadurl+"?x="+obj.tkiall[i].md5tki+"\"><button class=\"ladda-button\" data-style=\"expand-right\" data-color=\"green\" data-size=\"xs\"><span class=\"ladda-label\" style=\"color:white\">Surat PK "+obj.tkiall[i].tknama+"</span></button></a>\
                          </div><br /><br />")
                }
              }
            });
        }
    } );
  });
</script>
