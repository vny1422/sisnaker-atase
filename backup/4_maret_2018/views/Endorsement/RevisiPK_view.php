
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
                  <li class="active"><a href=#tabjo data-toggle="tab"><strong>Job Order</strong></a>
                  </li>
                  <li><a href=#tabmajikan data-toggle="tab"><strong>Majikan</strong></a>
                  </li>
                  <li><a href=#tabagensi data-toggle="tab"><strong>Agensi</strong></a>
                  </li>
                  <li><a href=#tabpptkis data-toggle="tab"><strong>PPTKIS</strong></a>
                  </li>
                  <li><a href=#tabtkilama data-toggle="tab"><strong>TKI Lama</strong></a>
                  </li>
                  <li><a href=#tabtkipengganti data-toggle="tab"><strong>TKI Pengganti</strong></a>
                  </li>
                  <li><a href=#tabcetak data-toggle="tab"><strong>Cetak Stiker</strong></a>
                  </li>
                </ul>
              </div>
              <!-- panel body -->
              <div class="panel-body">
                <div class="tab-content">
                  <div class="tab-pane fade in active table-responsive" id="tabjo">
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
                  <div class="tab-pane fade in table-responsive" id="tabtkilama">
                    <div class="col-lg-2">
                      <h5>Nama TKI</h5>
                      <h5>Alamat</h5>
                      <h5>No. Paspor</h5>
                      <h5>Tgl. Pengeluaran</h5>
                      <h5>Tempat Pengeluaran</h5>
                      <h5>Tgl. Lahir</h5>
                      <h5>Tempat Lahir</h5>
                      <h5>Jenis Kelamin</h5>
                      <h5>Status Perkawinan</h5>
                      <h5>Jumlah Anak Tanggungan</h5>
                      <h5>Nama Ahli Waris</h5>
                      <h5>Nama Kontak Darurat</h5>
                      <h5>Alamat Kontak Darurat</h5>
                      <h5>Telepon Kontak Darurat</h5>
                      <h5>Hubungan Kontak Darurat</h5>
                    </div>
                    <div class="col-lg-3">
                      <h5 id="lTKNamaTKI">: </h5>
                      <h5 id="lTKAlamatTKI">: </h5>
                      <h5 id="lTKPaspor">: </h5>
                      <h5 id="lTKTglPengeluaran">: </h5>
                      <h5 id="lTKTempatPengeluaran">: </h5>
                      <h5 id="lTKTglLahir">: </h5>
                      <h5 id="lTKTempatLahir">: </h5>
                      <h5 id="lTKJK">: </h5>
                      <h5 id="lTKStatusKawin">: </h5>
                      <h5 id="lTKJmlTanggungan">: </h5>
                      <h5 id="lTKAhliWaris">: </h5>
                      <h5 id="lTKNama">: </h5>
                      <h5 id="lTKAlamat">: </h5>
                      <h5 id="lTKTelepon">: </h5>
                      <h5 id="lTKHubungan">: </h5>
                    </div>
                    <div class="col-lg-7"> </div>
                  </div>
                  <div class="tab-pane fade in table-responsive" id="tabtkipengganti">
                    <div class="col-lg-2">
                      <h5>Nama TKI</h5>
                      <h5>Alamat</h5>
                      <h5>No. Paspor</h5>
                      <h5>Tgl. Pengeluaran</h5>
                      <h5>Tempat Pengeluaran</h5>
                      <h5>Tgl. Lahir</h5>
                      <h5>Tempat Lahir</h5>
                      <h5>Jenis Kelamin</h5>
                      <h5>Status Perkawinan</h5>
                      <h5>Jumlah Anak Tanggungan</h5>
                      <h5>Nama Ahli Waris</h5>
                      <h5>Nama Kontak Darurat</h5>
                      <h5>Alamat Kontak Darurat</h5>
                      <h5>Telepon Kontak Darurat</h5>
                      <h5>Hubungan Kontak Darurat</h5>
                    </div>
                    <div class="col-lg-3">
                      <h5 id="bTKNamaTKI">: </h5>
                      <h5 id="bTKAlamatTKI">: </h5>
                      <h5 id="bTKPaspor">: </h5>
                      <h5 id="bTKTglPengeluaran">: </h5>
                      <h5 id="bTKTempatPengeluaran">: </h5>
                      <h5 id="bTKTglLahir">: </h5>
                      <h5 id="bTKTempatLahir">: </h5>
                      <h5 id="bTKJK">: </h5>
                      <h5 id="bTKStatusKawin">: </h5>
                      <h5 id="bTKJmlTanggungan">: </h5>
                      <h5 id="bTKAhliWaris">: </h5>
                      <h5 id="bTKNama">: </h5>
                      <h5 id="bTKAlamat">: </h5>
                      <h5 id="bTKTelepon">: </h5>
                      <h5 id="bTKHubungan">: </h5>
                    </div>
                    <div class="col-lg-7"> </div>
                  </div>
                  <div class="tab-pane fade in table-responsive" id="tabcetak">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-1">Perjanjian Kerja :</div>
                    <div id="rPerjanjianKerja" class="col-lg-5"> 
                      
                    </div>
                    <div class="col-lg-3"></div>
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
  openlabel = function(verb, url, data, target) {
    var form = document.createElement("form");
    form.action = url;
    form.method = verb;
    form.target = target;
    if (data) {
      for (var key in data) {
        var input = document.createElement("textarea");
        input.name = key;
        input.value = typeof data[key] === "object" ? JSON.stringify(data[key]) : data[key];
        form.appendChild(input);
      }
    }
    form.style.display = 'none';
    document.body.appendChild(form);
    map = window.open("", "Label", "width=400,height=300");
    form.submit();
  };
</script>

<script>
  $(document).ready(function () {
    var l = $("#check").ladda();

    $("#check").click(function() {
      l.ladda('start');
      var table = $('#tabletki').DataTable();
      var code = $("#barcode").val();

      $.post("<?php echo base_url()?>pk/getDataRevisiPK", {barcode: code}, function(data,status){
        l.ladda('stop');
        var obj = $.parseJSON(data);
        if(obj.success) {
          if (obj.ejid) {
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

            $("#lTKNamaTKI").text(": " + obj.tklama.tknama);
            $("#lTKAlamatTKI").text(": " + obj.tklama.tkalmtid);
            $("#lTKPaspor").text(": " + obj.tklama.tkpaspor);
            $("#lTKTglPengeluaran").text(": " + obj.tklama.tktglkeluar);
            $("#lTKTempatPengeluaran").text(": " + obj.tklama.tktmptkeluar);
            $("#lTKTglLahir").text(": " + obj.tklama.tktgllahir);
            $("#lTKTempatLahir").text(": " + obj.tklama.tktmptlahir);
            $("#lTKJK").text(obj.tklama.tkjk == "L" ? ": Laki-laki" : ": Perempuan");
            var statkwn = obj.tklama.tkstatkwn;
            if (statkwn == '0')
              $("#lTKStatusKawin").text(": Belum Menikah");
            else if (statkwn == '1')
              $("#lTKStatusKawin").text(": Menikah");
            else if (statkwn == '2')
              $("#lTKStatusKawin").text(": Cerai"); 
            var jmlanaktanggungan = obj.tklama.tkjmlanaktanggungan;
            if (jmlanaktanggungan) {
              $("#lTKJmlTanggungan").text(": " + obj.tklama.tkjmlanaktanggungan);
            } else {
              $("#lTKJmlTanggungan").text(": 0");
            }
            $("#lTKAhliWaris").text(": " + obj.tklama.tkahliwaris);
            $("#lTKNama").text(": " + obj.tklama.tknama2);
            $("#lTKAlamat").text(": " + obj.tklama.tkalmt2);
            $("#lTKTelepon").text(": " + obj.tklama.tktelp);
            $("#lTKHubungan").text(": " + obj.tklama.tkhub);

            $("#bTKNamaTKI").text(": " + obj.tkpengganti.tknama);
            $("#bTKAlamatTKI").text(": " + obj.tkpengganti.tkalmtid);
            $("#bTKPaspor").text(": " + obj.tkpengganti.tkpaspor);
            $("#bTKTglPengeluaran").text(": " + obj.tkpengganti.tktglkeluar);
            $("#bTKTempatPengeluaran").text(": " + obj.tkpengganti.tktmptkeluar);
            $("#bTKTglLahir").text(": " + obj.tkpengganti.tktgllahir);
            $("#bTKTempatLahir").text(": " + obj.tkpengganti.tktmptlahir);
            $("#bTKJK").text(obj.tkpengganti.tkjk == "L" ? ": Laki-laki" : ": Perempuan");
            var statkwn = obj.tkpengganti.tkstatkwn;
            if (statkwn == '0')
              $("#bTKStatusKawin").text(": Belum Menikah");
            else if (statkwn == '1')
              $("#bTKStatusKawin").text(": Menikah");
            else if (statkwn == '2')
              $("#bTKStatusKawin").text(": Cerai"); 
            var jmlanaktanggungan = obj.tkpengganti.tkjmlanaktanggungan;
            if (jmlanaktanggungan) {
              $("#bTKJmlTanggungan").text(": " + obj.tkpengganti.tkjmlanaktanggungan);
            } else {
              $("#bTKJmlTanggungan").text(": 0");
            }
            $("#bTKAhliWaris").text(": " + obj.tkpengganti.tkahliwaris);
            $("#bTKNama").text(": " + obj.tkpengganti.tknama2);
            $("#bTKAlamat").text(": " + obj.tkpengganti.tkalmt2);
            $("#bTKTelepon").text(": " + obj.tkpengganti.tktelp);
            $("#bTKHubungan").text(": " + obj.tkpengganti.tkhub);

            $("#rPerjanjianKerja").html("<input id='bPrintStickerPK' type='button' class='btn btn-primary' value='Perjanjian Kerja "+obj.tkpengganti.tknama+"'/>");

            $("#bPrintStickerPK").click(function() {
              $.post("<?php echo base_url()?>pk/endorseTKI", {barcode: code}, function(data,status){
                var obj2 = $.parseJSON(data);
                if (obj2.success) {
                  openlabel('POST',"<?php echo base_url()?>pk/printLabel",{barcode: code, token: obj.ejtoken},'Label');
                } else {
                  alert(obj2.message);
                }
              });
            });

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