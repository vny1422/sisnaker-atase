
<!-- page content -->
<div class="right_col" role="main">

  <br />
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2><strong><?php echo $subtitle; ?></strong></h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">

          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Barcode <span class="required">*</span></label>
            <div class="col-md-3 col-sm-3 col-xs-12">
              <input id="" type="text" name="name" required="required" class="form-control">
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12">
              <button type="submit" class="btn btn-success">Check</button>
            </div>
          </div><br />
        </form>
      </div>
      <!-- START OF TABBED CONTENT -->
      <div class="x_content">
        <br />
        <div class="row" style="padding-top: 20px">
          <div class="col-lg-12">
            <!-- panel -->
            <div class="panel with-nav-tabs panel-info">
              <!-- panel heading -->
              <div class="panel-heading" id="tabs-head">
          <ul class="nav nav-tabs" id="tabs-list">
            <li><a href=#tabjo data-toggle="tab"><strong>Job Order</strong></a>
            </li>
            <li><a href=#tabmajikan data-toggle="tab"><strong>Majikan</strong></a>
            </li>
            <li><a href=#tabagensiluar data-toggle="tab"><strong>Agensi Luar</strong></a>
            </li>
            <li><a href=#tabagensiindo data-toggle="tab"><strong>Agensi Indonesia</strong></a>
            </li>
            <li><a href=#tabtkilama data-toggle="tab"><strong>TKI Lama</strong></a>
            </li>
            <li><a href=#tabtkipengganti data-toggle="tab"><strong>TKI Pengganti</strong></a>
            </li>
            <li><a href=#tabcetakstiker data-toggle="tab"><strong>Cetak Stiker</strong></a>
            </li>
          </ul>
        </div>
              <!-- panel body -->
              <div class="panel-body" ng-controller="AgencyController">
                <div class="tab-content">
                  <!-- tab agency -->
                  <div class="tab-pane fade in active" id="tabjo">
                    <!-- panel body -->
                    <div class="panel-body" ng-controller="AgencyController">
                      <div class="tab-content">
                        <div class="col-lg-1"> </div>
                        <div class="col-lg-4"> 
                          <strong><p>Jenis Pekerjaan</p></strong>
                          <strong><p>CLA LETTER NO</p></strong>
                          <strong><p>CLA LETTER Tanggal</p></strong>
                          <strong><p>CLA LETTER Due Date </p></strong>
                          <strong><p>Jumlah Tenaga Kerja yang dibutuhkan</p></strong>
                          <strong><p>Masa Kontrak </p></strong>
                          <strong><p>Catatan</p></strong>
                          <strong><p>Gaji</p></strong>
                        </div>
                        <div class="col-lg-4"> 
                          <p>: PERAWAT ORANG SAKIT (CARE GIVER)</p>
                          <p>: 1051206985</p>
                          <p>: 2016-07-14</p>
                          <p>: </p>
                          <p>: 1</p>
                          <p>: 3 Tahun 0 Bulan 0 Hari</p>
                          <p>: </p>
                          <p>: NT$ 17000.00</p>
                        </div>
                        <div class="col-lg-3"> </div>
                      </div>
                    </div>
                  </div>
                  <!-- tab agency -->
                  <div class="tab-pane fade in" id="tabmajikan">
                    <!-- panel body -->
                    <div class="panel-body" ng-controller="AgencyController">
                      <div class="tab-content">
                        <div class="col-lg-1"> </div>
                        <div class="col-lg-4"> 
                          <strong><p>No. KTP / No. ID Card</p></strong>
                          <strong><p>Nama Perusahaan / Majikan</p></strong>
                          <strong><p>Nama Perusahaan (Bahasa Lokal) </p></strong>
                          <strong><p>Alamat  </p></strong>
                          <strong><p>Alamat (Bahasa Lokal) </p></strong>
                          <strong><p>No. Telp / Phone Number </p></strong>
                          <strong><p>No. Fax</p></strong>
                        </div>
                        <div class="col-lg-5"> 
                          <p>: C120217728</span></p>
                          <p>: CHUANG CHAN SHIANG</p>
                          <p>: 莊讚祥</p>
                          <p>: No,30,Lane245,Chang An St,Chi Du District,Kee Lung City,</p>
                          <p>: 基隆市七堵區長安街245巷30號</p>
                          <p>: 0912228769</p>
                          <p>: </p>
                        </div>
                        <div class="col-lg-2"> </div>
                      </div>
                    </div>

                  </div>
                  <!-- tab agency -->
                  <div class="tab-pane fade in" id="tabagensiluar">
                    <!-- panel body -->
                    <div class="panel-body" ng-controller="AgencyController">
                      <div class="tab-content">
                        <div class="col-lg-1"> </div>
                        <div class="col-lg-4"> 
                          <strong><p>Nama Perusahaan</p></strong>
                          <strong><p>Nama Perusahaan (Bahasa Lokal)</p></strong>
                          <strong><p>No. Ijin CLA / No. CLA Permission</p></strong>
                          <strong><p>Alamat Kantor  </p></strong>
                          <strong><p>Alamat Kantor (Bahasa Lokal)</p></strong>
                          <strong><p>Nama Penanggung Jawab</p></strong>
                          <strong><p>Nama Penanggung Jawab (Bahasa Lokal)</p></strong>
                          <strong><p>No. Telp / Phone Number </p></strong>
                          <strong><p>No. Fax</p></strong>
                        </div>
                        <div class="col-lg-5"> 
                          <p>: XIAN GUO CO., LTD.</p>
                          <p>: C憲國有限公司</p>
                          <p>: 1861</p>
                          <p>: N5F,No.33,HuaYin St, Datung Dist, Taipei City</p>
                          <p>: 台北市大同區華陰街33號5樓</p>
                          <p>: LAI FU-YUAN</p>
                          <p>: 賴富源</p>
                          <p>: 02- 25589681</p>
                          <p>: 02- 25589681</p>
                        </div>
                        <div class="col-lg-2"> </div>
                      </div>
                    </div>
                  </div>
                  <!-- tab agency -->
                  <div class="tab-pane fade in" id="tabagensiindo">
                    <!-- panel body -->
                    <div class="panel-body" ng-controller="AgencyController">
                      <div class="tab-content">
                        <div class="col-lg-1"> </div>
                        <div class="col-lg-4"> 
                          <strong><p>Nama Agent / Agent Name</p></strong>
                          <strong><p>Alamat Kantor / Office Address</p></strong>
                          <strong><p>No. Telp / Phone Number</p></strong>
                          <strong><p>No. Fax</p></strong>
                          <strong><p>No. Ijin / Permission Number</p></strong>
                          <strong><p>Nama Penanggung Jawab</p></strong>
                          <strong><p>Nama Penanggung Jawab (Bahasa Lokal)</p></strong>
                        </div>
                        <div class="col-lg-7"> 
                          <p>: ANTAR TENAGA MANDIRI</p>
                          <p>: JL.SERSAN MAYOR MARJUKI NO.7 RT 06 RW 02 KEL.MARGAJAYA KEC.BEKASI SELATAN</p>
                          <p>: 021-88958855/8896758</p>
                          <p>: 021-88958855/8896758</p>
                          <p>: 021-88958855/8896758</p>
                          <p>: SANGAB BARUS</p>
                          <p>: </p>
                        </div>
                      </div>
                    </div>
                  </div>
                   <!-- tab agency -->
                  <div class="tab-pane fade in" id="tabtkilama">
                    <!-- panel body -->
                    <div class="panel-body" ng-controller="AgencyController">
                      <div class="tab-content">
                        <div class="col-lg-1"> </div>
                        <div class="col-lg-4"> 
                          <strong><p>Nama TKI</p></strong>
                          <strong><p>Alamat</p></strong>
                          <strong><p>No. Paspor</p></strong>
                          <strong><p>Tgl. Pengeluaran</p></strong>
                          <strong><p>Tempat Pengeluaran</p></strong>
                          <strong><p>Tgl. Lahir</p></strong>
                          <strong><p>Tempat Lahir</p></strong>
                          <strong><p>Jenis Kelamin</p></strong>
                          <strong><p>Status Perkawinan</p></strong>
                          <strong><p>Jumlah anak dibawah umur 18 tahun dan belum menikah</p></strong>
                          <strong><p>Nama Ahli Waris</p></strong>
                          <strong><p>Nama Kontak Darurat</p></strong>
                          <strong><p>Alamat Kontak Darurat</p></strong>
                          <strong><p>Telepon Kontak Darurat</p></strong>
                          <strong><p>Hubungan Kontak Darurat</p></strong>
                        </div>
                        <div class="col-lg-5"> 
                          <p>: dummy</p>
                          <p>: dummy</p>
                          <p>: dummy</p>
                          <p>: dummy</p>
                          <p>: dummy</p>
                          <p>: dummy</p>
                          <p>: dummy</p>
                          <p>: dummy</p>
                          <p>: dummy</p>
                          <p>: dummy</p>
                          <p>: dummy</p>
                          <p>: dummy</p>
                          <p>: dummy</p>
                          <p>: dummy</p>
                          <p>: dummy</p>
                        </div>
                        <div class="col-lg-2"> </div>
                      </div>
                    </div>
                  </div>
                   <!-- tab agency -->
                  <div class="tab-pane fade in" id="tabtkipengganti">
                    <!-- panel body -->
                    <div class="panel-body" ng-controller="AgencyController">
                      <div class="tab-content">
                        <div class="col-lg-1"> </div>
                        <div class="col-lg-4"> 
                          <strong><p>Nama TKI</p></strong>
                          <strong><p>Alamat</p></strong>
                          <strong><p>No. Paspor</p></strong>
                          <strong><p>Tgl. Pengeluaran</p></strong>
                          <strong><p>Tempat Pengeluaran</p></strong>
                          <strong><p>Tgl. Lahir</p></strong>
                          <strong><p>Tempat Lahir</p></strong>
                          <strong><p>Jenis Kelamin</p></strong>
                          <strong><p>Status Perkawinan</p></strong>
                          <strong><p>Jumlah anak dibawah umur 18 tahun dan belum menikah</p></strong>
                          <strong><p>Nama Ahli Waris</p></strong>
                          <strong><p>Nama Kontak Darurat</p></strong>
                          <strong><p>Alamat Kontak Darurat</p></strong>
                          <strong><p>Telepon Kontak Darurat</p></strong>
                          <strong><p>Hubungan Kontak Darurat</p></strong>
                        </div>
                        <div class="col-lg-5"> 
                          <p>: dummy</p>
                          <p>: dummy</p>
                          <p>: dummy</p>
                          <p>: dummy</p>
                          <p>: dummy</p>
                          <p>: dummy</p>
                          <p>: dummy</p>
                          <p>: dummy</p>
                          <p>: dummy</p>
                          <p>: dummy</p>
                          <p>: dummy</p>
                          <p>: dummy</p>
                          <p>: dummy</p>
                          <p>: dummy</p>
                          <p>: dummy</p>
                        </div>
                        <div class="col-lg-2"> </div>
                      </div>
                    </div>
                  </div>
                   <!-- tab agency -->
                  <div class="tab-pane fade in" id="tabcetakstiker">
                    <!-- panel body -->
                    <div class="panel-body" ng-controller="AgencyController">
                      <div class="tab-content">
                        <div class="col-lg-1"> </div>
                        <div class="col-lg-1"> 
                          
                          <strong><p>Perjanjian Kerja :</p></strong>
                        </div>
                        <div class="col-lg-5"> 
                          <button type="submit" class="btn btn-primary">Perjanjian Kerja ENDANG SULISTYOWATI</button>
                        </div>
                        <div class="col-lg-5"> </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- END OF TABBED CONTENT -->
    </div>
    <br /><br />
  </div>
</div>

<div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2><strong><?php echo $subtitle2; ?></strong></h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </ul>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <br />
              <div class="row" style="padding-top: 20px">
                <div class="col-lg-12">
            <!-- panel -->
            <div class="panel with-nav-tabs panel-info">
              <!-- panel heading -->
              <div class="panel-heading" id="tabs-head">
                <ul class="nav nav-tabs" id="tabs-list">
                  <li class="active"><a href=#tabagency data-toggle="tab"><strong>Kuitansi 1</strong></a>
                  </li>
                </ul>
              </div>
              <!-- panel body -->
              <div class="panel-body" ng-controller="AgencyController">
                <div class="tab-content">
                  <!-- tab agency -->
                  <div class="tab-pane fade in active" id="tabagency">
                    <div class="col-lg-1"> </div>
                    <div class="col-lg-4"> 
                      <p>Tanggal Masuk</p>
                      <p>Tanggal Kuitansi</p>
                      <p>Jenis Dokumen</p>
                      <p>No. Kuitansi</p>
                      <p>Jumlah Terbayar</p>
                      <p>Nama Pemohon</p>
                      <p>Petugas</p>
                    </div>
                    <div class="col-lg-4"> 
                      <p>: 30/11/2016</span></p>
                      <p>: 30/11/2016</p>
                      <p>: Legalisasi Dokumen TKI (Job Order)</p>
                      <p>: 463771</p>
                      <p>: 700 NT$</p>
                      <p>: xian guo co ltd</p>
                      <p>: herlan</p>
                    </div>
                    <div class="col-lg-3"> </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- end of panel -->
          </div>
          </div>
          </div>

  <div class="clearfix"></div>
