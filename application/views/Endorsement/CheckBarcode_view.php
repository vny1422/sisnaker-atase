
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

          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="barcode">Barcode <span class="required">*</span></label>
            <div class="col-md-3 col-sm-3 col-xs-12">
              <input id="barcode" type="text" name="barcode" required="required" class="form-control">
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12">
              <button id="check" class="ladda-button" data-style="expand-right" data-color="green" data-size="xs"><span class="ladda-label" style="color:white">Check</span></button>
            </div>
          </div><br /><br />
        </div>

      <div class="x_content checked" style="display:none">
        <br />
        <div class="row" style="padding-top: 20px">
          <div class="col-lg-12">
            <!-- panel -->
            <div class="panel with-nav-tabs panel-info">
              <!-- panel heading -->
              <div class="panel-heading" id="tabs-head">
                <ul class="nav nav-tabs" id="tabs-list">
                  <li class="active"><a href=#tabbarcode data-toggle="tab"><strong>Barcode</strong></a>
                  </li>
                  <li><a href=#tabjo data-toggle="tab"><strong>Job Order</strong></a>
                  </li>
                  <li><a href=#tabmajikan data-toggle="tab"><strong>Majikan</strong></a>
                  </li>
                  <li><a href=#tabagensi data-toggle="tab"><strong>Agensi</strong></a>
                  </li>
                  <li><a href=#tabpptkis data-toggle="tab"><strong>PPTKIS</strong></a>
                  </li>
                  <li><a href=#tabtki data-toggle="tab"><strong>TKI</strong></a>
                  </li>
                </ul>
              </div>
              <!-- panel body -->
              <div class="panel-body">
                <div class="tab-content">
                  <div class="tab-pane fade in active table-responsive" id="tabbarcode">
                    <div class="col-lg-2">
                      <h5>Surat Permintaan</h5>
                      <h5>Surat Kuasa</h5>
                      <h5>Surat Perjanjian Kerja</h5>
                    </div>
                    <div id="bc" class="col-lg-3"></div>
                    <div class="col-lg-7"></div>
                  </div>
                  <div class="tab-pane fade in table-responsive" id="tabjo">
                    <div class="col-lg-2">
                      <h5>Jenis Pekerjaan</h5>
                      <h5>CLA LETTER NO</h5>
                      <h5>CLA LETTER Tanggal</h5>
                      <h5>CLA LETTER Due Date</h5>
                      <h5>Bekerja Sebagai</h5>
                      <h5>Jumlah Tenaga Kerja</h5>
                      <h5>Masa Kontrak</h5>
                      <h5>Catatan</h5>
                      <h5>Gaji</h5>
                    </div>
                    <div class="col-lg-3">
                      <h5 id="lJOJenisPekerjaan">: </h5>
                      <h5 id="lJOCLANO">: </h5>
                      <h5 id="lJOCLATgl">: </h5>
                      <h5 id="lJOCLADueDate">: </h5>
                      <h5 id="lJOPosisi">: </h5>
                      <h5 id="lJOJumlahTKI">: </h5>
                      <h5 id="lJOMKTanggal">: </h5>
                      <h5 id="lJOCatatan">: </h5>
                      <h5 id="lJOGaji">: </h5>
                    </div>
                    <div class="col-lg-7"></div>
                  </div>
                  <div class="tab-pane fade in table-responsive" id="tabmajikan">
                    <div class="col-lg-2">
                      <h5>No. KTP</h5>
                      <h5>Nama Majikan</h5>
                      <h5>Alamat</h5>
                      <h5>Nama Penanggung Jawab</h5>
                      <h5>No. Telp</h5>
                      <h5>No. Fax</h5>
                    </div>
                    <div class="col-lg-3">
                      <h5 id="lMJNoKTP">: </h5>
                      <h5 id="lMJNamaMajikan">: </h5>
                      <h5 id="lMJAlamat">: </h5>
                      <h5 id="lMJPenanggungJawab">: </h5>
                      <h5 id="lMJTelp">: </h5>
                      <h5 id="lMJFax">: </h5>
                    </div>
                    <div class="col-lg-7"> </div>
                  </div>
                  <div class="tab-pane fade in table-responsive" id="tabagensi">
                    <div class="col-lg-2">
                      <h5>Nama Perusahaan</h5>
                      <h5>No. Ijin CLA</h5>
                      <h5>Alamat Kantor</h5>
                      <h5>Nama Penanggung Jawab</h5>
                      <h5>No. Telp</h5>
                      <h5>No. Fax</h5>
                    </div>
                    <div class="col-lg-3">
                      <h5 id="lAGNamaPerusahaan">: </h5>
                      <h5 id="lAGNoIjinCLA">: </h5>
                      <h5 id="lAGAlamatKantor">: </h5>
                      <h5 id="lAGPenanggungJawab">: </h5>
                      <h5 id="lAGTelp">: </h5>
                      <h5 id="lAGFax">: </h5>
                    </div>
                    <div class="col-lg-7"> </div>
                  </div>
                  <div class="tab-pane fade in table-responsive" id="tabpptkis">
                    <div class="col-lg-2">
                      <h5>Nama Perusahaan</h5>
                      <h5>No. Ijin</h5>
                      <h5>Alamat Kantor</h5>
                      <h5>Nama Penanggung Jawab</h5>
                      <h5>No. Telp</h5>
                      <h5>No. Fax</h5>
                    </div>
                    <div class="col-lg-3">
                      <h5 id="lPPNamaAgen">: </h5>
                      <h5 id="lPPNoIjin">: </h5>
                      <h5 id="lPPAlamatKantor">: </h5>
                      <h5 id="lPPPenanggungJawab">: </h5>
                      <h5 id="lPPTelp">: </h5>
                      <h5 id="lPPFax">: </h5>
                    </div>
                    <div class="col-lg-7"> </div>
                  </div>
                  <div class="tab-pane fade in table-responsive" id="tabtki">

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
    <br />
  </div>
</div>

<div class="row checked" style="display:none">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2><strong><?php echo $subtitle2; ?></strong></h2>
        <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
        </ul>
        <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <div class="row" style="padding-top: 20px">
            <div id="rKuitansi" class="col-lg-12" style="display:none">
              <div id="dataKuitansi" class="panel with-nav-tabs panel-info">
                
              </div>
            </div>
            <div id="rNoKuitansi" class="col-lg-12" style="display:none">
              <h2 style="color: red; text-align: center">Pencatatan kuitansi belum diproses</h2>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<script>
  $(document).ready(function () {
    var l = $("#check").ladda();
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

    $("#check").click(function() {
      l.ladda('start');
      var table = $('#tabletki').DataTable();
      var code = $("#barcode").val();

      $.post("<?php echo base_url()?>endorsement/getDataFromBarcode", {barcode: code}, function(data,status){
        l.ladda('stop');
        var obj = $.parseJSON(data);
        if(obj.success) {
          if (obj.ejid) {
            var tmp = "<h5 id='suratpermintaan'>: " + obj.ejbcsp + "</h5>";
            tmp += "<h5 id='suratkuasa'>: " + obj.ejbcsk + "</h5>";

            for (i = 0; i < obj.tki.length; i++) {
              tmp += "<h5 id='suratpk" + i + "'>: " + obj.tki[i].tknama + " (" + obj.tki[i].tkbc + ")</h5>";
            }

            $("#bc").html(tmp);

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

            table.clear();
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

              table.row.add( [  
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
            }

            $(".checked").show();
          }

          if (obj.kuitansi) {
            var rKuitansiTabs = "<div class='panel-heading' id='tabs-head'><ul class='nav nav-tabs' id='tabs-list'>";

            for (i = 0; i < obj.kuitansi.length; i++) {
              if(i == 0) {
                rKuitansiTabs += "<li class='active'>";
              } else {
                rKuitansiTabs += "<li>";
              }
              rKuitansiTabs += "<a href='#tabkuitansi"+i+"' data-toggle='tab'><strong>Kuitansi "+(i+1)+"</strong></a></li>";
            }

            rKuitansiTabs += "</ul></div>";

            var rKuitansiBody = "<div class='panel-body'><div class='tab-content'>";

            for (i = 0; i < obj.kuitansi.length; i++) {
                if(i == 0) {
                  rKuitansiBody += "<div class='tab-pane fade in active table-responsive' id='tabkuitansi"+i+"'>";
                } else {
                  rKuitansiBody += "<div class='tab-pane fade in table-responsive' id='tabkuitansi"+i+"'>";
                }
                rKuitansiBody += "<div class='col-lg-4'></div><div class='col-lg-2'><h5>Tanggal Masuk</h5><h5>Tanggal Kuitansi</h5><h5>Jenis Dokumen</h5><h5>No. Kuitansi</h5><h5>Jumlah Terbayar</h5><h5>Nama Pemohon</h5><h5>Petugas</h5></div><div class='col-lg-4'><h5>: "+obj.kuitansi[i].kutglmasuk+"</h5><h5>: "+obj.kuitansi[i].kutglmasuk+"</h5><h5>: "+obj.kuitansi[i].tipe+"</h5><h5>: "+obj.kuitansi[i].kuno+"</h5><h5>: "+obj.kuitansi[i].kujmlbayar+"</h5><h5>: "+obj.kuitansi[i].kupemohon+"</h5><h5>: "+obj.kuitansi[i].username+"</h5></div><div class='col-lg-2'></div></div>";
            }

            rKuitansiBody += "</div></div>";

            $("#dataKuitansi").html(rKuitansiTabs + rKuitansiBody);

            if (obj.kuitansi.length > 0)           
              $("#rKuitansi").show();
            else
              $("#rNoKuitansi").show();
          }

        } else {
          alert(obj.message);
        }
      });
    });
  });
</script>