<link href="<?php echo assets_url() ?>css/dex/sweetalert.css" rel="stylesheet">
<link href="<?php echo assets_url() ?>css/dex/selectize.css" rel="stylesheet">
<style type="text/css">
  
  label.btn span {
    font-size: 1.5em ;
  }

  label input[type="radio"] ~ i.fa.fa-circle-o{
      color: #c8c8c8;    display: inline;
  }
  label input[type="radio"] ~ i.fa.fa-dot-circle-o{
      display: none;
  }
  label input[type="radio"]:checked ~ i.fa.fa-circle-o{
      display: none;
  }
  label input[type="radio"]:checked ~ i.fa.fa-dot-circle-o{
      color: #00a65a;    display: inline;
  }
  label:hover input[type="radio"] ~ i.fa {
  color: #00a65a;
  }

  label input[type="checkbox"] ~ i.fa.fa-square-o{
      color: #c8c8c8;    display: inline;
  }
  label input[type="checkbox"] ~ i.fa.fa-check-square-o{
      display: none;
  }
  label input[type="checkbox"]:checked ~ i.fa.fa-square-o{
      display: none;
  }
  label input[type="checkbox"]:checked ~ i.fa.fa-check-square-o{
      color: #00a65a;    display: inline;
  }
  label:hover input[type="checkbox"] ~ i.fa {
  color: #00a65a;
  }

  div[data-toggle="buttons"] label.active{
      color: #00a65a;
  }

  div[data-toggle="buttons"] label {
  display: inline-block;
  padding: 6px 12px;
  margin-bottom: 0;
  font-size: 14px;
  font-weight: normal;
  line-height: 2em;
  text-align: left;
  white-space: nowrap;
  vertical-align: top;
  cursor: pointer;
  background-color: none;
  border: 0px solid 
  #c8c8c8;
  border-radius: 3px;
  color: #c8c8c8;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  -o-user-select: none;
  user-select: none;
  }

  div[data-toggle="buttons"] label:hover {
  color: #00a65a;
  }

  div[data-toggle="buttons"] label:active, div[data-toggle="buttons"] label.active {
  -webkit-box-shadow: none;
  box-shadow: none;
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
            <!-- <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
          </ul> -->
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <?php if($this->session->flashdata('information') != ""): ?>
            <?php echo '<div class="container">
            <div class="alert alert-warning fade in">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Notification: </strong> '.$this->session->flashdata('information').'
            </div>
            </div>' ?>
          <?php endif; ?>
          <form class="form-horizontal" method="GET" action="<?php echo base_url()?>dex/verify">
            <div class="form-group">
              <label class="col-sm-2 control-label">Kode Entry</label>
              <div class="col-sm-9">
                <input type="text" name="kode_entry" class="form-control" placeholder="Kode Entry" 
                value="<?php if(isset($_GET['kode_entry']))echo $_GET['kode_entry']; ?>"
                >
              </div>
              <div class="col-sm-1">
                <button type="submit" class="btn btn-info">Cari</button>  
              </div>
            </div>
          </form>
          <?php if(isset($entry) && !empty($entry)){ ?>
          <hr />
          <form class="form-horizontal" method="POST" action="<?php echo base_url()?>dex/verify">
            <input type="hidden" name="_method" value="PUT"/>
            <div class="form-group">
              <label class="col-sm-2 control-label">Kode Entry</label>
              <div class="col-sm-9">
                <input type="text" name="kode_entry" class="form-control" placeholder="Kode Entry" 
                value="<?php echo $entry->kode_entry?>" disabled>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">No Ijin CLA</label>
              <div class="col-sm-9">
                <input type="text" name="no_cla" class="form-control" placeholder="No Ijin CLA" 
                value="<?php echo $entry->no_cla?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Tanggal Ijin CLA</label>
              <div class="col-sm-9">
                <input type="text" name="tgl_cla" class="form-control datepicker" placeholder="Tanggal Ijin CLA" 
                value="<?php echo date_view($entry->tgl_cla) ?>">
              </div>
            </div>
            <hr />
            <div class="form-group">
              <label class="col-sm-2 control-label text-success">Majikan/<br>Penanggung Jawab</label>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Nama Majikan</label>
              <div class="col-sm-9">
                <input type="text" name="nama_majikan" class="form-control" placeholder="Nama Majikan" 
                value="<?php echo $entry->nama_majikan?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Nama Majikan (English)</label>
              <div class="col-sm-9">
                <input type="text" name="nama_majikan_eng" class="form-control" placeholder="Nama Majikan (English)" 
                value="<?php echo $entry->nama_majikan_eng?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Alamat Bekerja</label>
              <div class="col-sm-9">
                <input type="text" name="alamat_bekerja" class="form-control" placeholder="Alamat Bekerja" 
                value="<?php echo $entry->alamat_bekerja?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Alamat Bekerja (English)</label>
              <div class="col-sm-9">
                <input type="text" name="alamat_bekerja_eng" class="form-control" placeholder="Alamat Bekerja (English)" 
                value="<?php echo $entry->alamat_bekerja_eng?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">No Telepon Majikan</label>
              <div class="col-sm-9">
                <input type="text" name="telp_majikan" class="form-control" placeholder="No Telepon Majikan" 
                value="<?php echo $entry->telp_majikan?>">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label text-success">Agensi / 仲介公司名稱</label>
              <div class="col-sm-9">
                <select class="selectize-agensi" name="agensi">
                  <option value="<?php  echo $entry->nama_agensi_eng; ?>/<?php  echo $entry->nama_agensi;?>" selected><?php  echo $entry->nama_agensi_eng; ?> - <?php  echo $entry->nama_agensi;?></option>
                </select>
              </div>
            </div>
            <hr />
            <div class="form-group">
              <label class="col-sm-2 control-label">Pekerjaan</label>
            </div>
            <div class="form-group">
              <label class="col-sm-2 col-form-label text-success">Jenis Pekerjaan / 工作類別</label>
              <div class="col-sm-9">
                <select id="select_pekerjaan" class="form-control" name="pekerjaan_id" placeholder="Jenis Pekerjaan">
                    <?php foreach($pekerjaans as $pekerjaan){  ?>
                    
                    <option value="<?php echo $pekerjaan->id; ?>" <?php  $entry->pekerjaan_id === $pekerjaan->id ? "selected='selected'" : "" ?> > <?php  echo $pekerjaan->nama?> - <?php  echo $pekerjaan->nama_cn ?></option>
                    <?php } ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Gaji</label>
              <div class="col-sm-9">
                <input type="text" name="gaji" class="form-control input-accounting" placeholder="Gaji" 
                value="<?php echo $entry->gaji?>">
              </div>
              <div class="col-sm-1">
                <h4>元</h4>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 col-form-label text-success">Jangka Waktu Perjanjian Kerja</label>
              <div class="col-sm-10">
                <div>
                  <div class="btn-group" data-toggle="buttons">
                    <label id="check_A" class="btn" style="pointer-events: none;">
                      <input type="radio" name='jangka_waktu' checked value="1"><i class="fa fa-circle-o fa-2x"></i><i class="fa fa-dot-circle-o fa-2x"></i> <span> 3 Tahun</span>
                    </label>
                    <label id="check_B" class="btn" style="pointer-events: none;">
                      <input type="radio" name='jangka_waktu' value="2"><i class="fa fa-circle-o fa-2x"></i><i class="fa fa-dot-circle-o fa-2x"></i><span> 1.5 - 2 Tahun</span>
                    </label>
                    <label id="check_C" class="btn" style="pointer-events: none;">
                      <input type="radio" name='jangka_waktu' value="3"><i class="fa fa-circle-o fa-2x"></i><i class="fa fa-dot-circle-o fa-2x"></i><span> 2 - 3 Tahun</span>
                    </label>
                  </div>
                </div>
              </div>
            </div>
            <div id="tgl_jangka_waktu" class="form-group" style="display: none;">
              <label class="col-sm-2 col-form-label text-success">Tanggal Perjanjian</label>
              <div class="col-sm-5">
                <span class="text-success">Tanggal Tiba di Taiwan</span>
                <input type="text" class="form-control datepicker" name="tgl_mulai" value="<?php echo date_view($entry->tgl_mulai)?>">
              </div>
              <div class="col-sm-5">
                <span class="text-success">Tanggal Berakhir Masa Kerja</span>
                <input type="text" class="form-control datepicker" name="tgl_selesai" value="<?php echo date_view($entry->tgl_selesai)?>">
              </div>
            </div>
            <hr />
            <div class="form-group">
              <label class="col-sm-2 control-label text-success">Tenaga Kerja Indonesia (TKI) <br>印尼籍勞工</label>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Nomor Paspor</label>
              <div class="col-sm-9">
                <input type="text" name="no_paspor" class="form-control" placeholder="Nomor Paspor" 
                value="<?php echo $entry->no_paspor?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Nama Pekerja</label>
              <div class="col-sm-9">
                <input type="text" name="nama_pekerja" class="form-control" placeholder="Nama Pekerja" 
                value="<?php echo $entry->nama_pekerja?>">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label text-success">Jenis Kelamin / 性別</label>
              <div class="col-sm-10">
                <select class="form-control" name="jenis_kelamin">
                  <option value="L" <?php if($entry->jenis_kelamin === 'L')echo "selected='selected'"; ?> >Laki-Laki</option>
                  <option value="P" <?php if($entry->jenis_kelamin === 'P')echo "selected='selected'";  ?> >Perempuan</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Alamat Indonesia</label>
              <div class="col-sm-9">
                <input type="text" name="alamat_indonesia" class="form-control" placeholder="Alamat Indonesia" 
                value="<?php echo $entry->alamat_indonesia; ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Tanggal Pengeluaran Paspor</label>
              <div class="col-sm-9">
                <input type="text" name="tgl_paspor" class="form-control datepicker" placeholder="Tanggal Pengeluaran Paspor" 
                value="<?php echo date_view($entry->tgl_paspor); ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Tempat Penegeluaran Paspor</label>
              <div class="col-sm-9">
                <input type="text" name="tempat_paspor" class="form-control" placeholder="Tempat Penegeluaran Paspor" 
                value="<?php echo $entry->tempat_paspor; ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">No Telepon Indonesia</label>
              <div class="col-sm-9">
                <input type="text" name="telp_indonesia" class="form-control" placeholder="No Telepon Indonesia" 
                value="<?php echo $entry->telp_indonesia; ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">No Telepon Taiwan</label>
              <div class="col-sm-9">
                <input type="text" name="telp_taiwan" class="form-control" placeholder="No Telepon Taiwan" 
                value="<?php echo $entry->telp_taiwan; ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Nomor ARC</label>
              <div class="col-sm-9">
                <input type="text" name="no_arc" class="form-control" placeholder="Nomor ARC" 
                value="<?php echo $entry->no_arc; ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Tanggal Lahir</label>
              <div class="col-sm-9">
                <input type="text" name="tgl_lahir" class="form-control datepicker" placeholder="Tanggal Lahir" 
                value="<?php echo date_view($entry->tgl_lahir); ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Tempat Lahir</label>
              <div class="col-sm-9">
                <input type="text" name="tempat_lahir" class="form-control" placeholder="Tempat Lahir" 
                value="<?php echo $entry->tempat_lahir; ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Status Perkawinan</label>
              <div class="col-sm-9">
                <input type="text" name="status_perkawinan" class="form-control" placeholder="Status Perkawinan" 
                value="<?php echo $entry->status_perkawinan; ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Jumlah Anak di Bawah 18 Tahun dan Belum Menikah</label>
              <div class="col-sm-9">
                <input type="text" name="jumlah_tanggungan_anak" class="form-control" placeholder="Jumlah Anak di Bawah 18 Tahun dan Belum Menikah" 
                value="<?php echo $entry->jumlah_tanggungan_anak; ?>">
              </div>
            </div>
            <hr />
            <div class="form-group">
              <label class="col-sm-2 control-label text-success">Ahli Waris</label>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Nama</label>
              <div class="col-sm-9">
                <input type="text" name="nama_ahli_waris" class="form-control" placeholder="Nama" 
                value="<?php echo $entry->nama_ahli_waris; ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Alamat</label>
              <div class="col-sm-9">
                <input type="text" name="alamat_ahli_waris" class="form-control" placeholder="Alamat" 
                value="<?php echo $entry->alamat_ahli_waris; ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Hubungan</label>
              <div class="col-sm-9">
                <input type="text" name="hubungan" class="form-control" placeholder="Hubungan" 
                value="<?php echo $entry->hubungan; ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label"></label>
              <div class="col-sm-9">
                <!-- <button type="submit" class="btn btn-warning">Update</button> -->
              </div>
            </div>
            <hr>
            <?php 
            define('FILE_UPLOAD',array(['key'=>'FILE_SURAT_MOL','value'=>'Surat MOL （勞動部招募函）'],['key'=>'FILE_KTP_MAJIKAN','value'=>'KTP majikan（雇主身份證)'],['key'=>'FILE_PASPOR_ARC','value'=>'paspor & ARC TKI（勞工護照及居留證）'],['key'=>'FILE_ASURANSI_TAIWAN','value'=>'Asuransi Taiwan （臺灣保險）'],['key'=>'FILE_LISENSI_AGENSI','value'=>'Lisensi agensi*  （臺仲許可證）'],['key'=>'FILE_SURAT_IJIN_KELUARGA','value'=>'Surat ijin keluarga （家屬同意書）'],['key'=>'FILE_SURAT_PERNYATAAN_TKI','value'=>'Surat pernyataan TKI （勞工切結書）'],['key'=>'FILE_LISENSI_PERUSAHAAN','value'=>'Lisensi perusahaan/panti jompo/kapal** （公司/養護機構/船 登記證/經濟部）']))
             ?>
            <div class="form-group">
              <?php foreach(FILE_UPLOAD as $file){  ?>
              <div class="col-sm-3 text-center">
                <?php if(isset($entry->{strtolower($file["key"])})){ ?>
                
                <a href="http://tw-dex.atnaker.kemnaker.go.id/api/get_file_by_id/<?php  echo $entry->{strtolower($file['key'])}; ?>" target="_blank" class="thumbnail">
                  <img src="<?php echo assets_url() ?>/images/file.png" alt="..." width="74%" height="74%">
                </a>
                <?php }else{ ?>
                <a href="" class="thumbnail">
                  <img src="<?php echo assets_url() ?>/images/file-404.png" alt="..." width="50%" height="50%">
                </a>
                <?php } ?>
                <h4><?php  echo $file["value"]; ?></h4>
              </div>
              <?php } ?>
            </div> 
          </form>

          <hr />
          <form class="form-horizontal" method="POST" action="<?php echo base_url()?>dex/verify">
            <input type="hidden" name="_method" value="POST"/>
            <div class="form-group">
              <label class="col-sm-2 control-label">Status penerimaan</label>
              <div class="radio col-sm-9">
                <?php if(!$entry->is_terima && !$entry->is_tolak){ ?>
                <div>
                  <div class="btn-group btn-group-vertical" data-toggle="buttons">
                    <label class="btn active">
                      <input type="radio" name='status_validasi' checked value="1"><i class="fa fa-circle-o fa-2x"></i><i class="fa fa-dot-circle-o fa-2x"></i> <span> Terima</span>
                    </label>
                    <label class="btn">
                      <input type="radio" name='status_validasi' value="0"><i class="fa fa-circle-o fa-2x"></i><i class="fa fa-dot-circle-o fa-2x"></i><span> Tolak</span>
                    </label>
                    <input type="hidden" name="kode_entry" value="<?php  echo $entry->kode_entry;?>">
                  </div>
                </div>
                <?php }else { ?>
                <span class="label <?php  if($entry->is_terima)echo 'label-success'; else echo 'label-danger' ?>" style="font-size: 16px;">Permohonan di <?php  if($entry->is_terima)echo 'Terima'; else echo 'Tolak' ?></span>
                <?php } ?>
              </div>
            </div>
            <?php  if(!$entry->is_terima && !$entry->is_tolak){ ?>
            <div class="form-group">
              <label class="col-sm-2 control-label"></label>
              <div class="col-sm-9">
                <button type="submit" class="btn btn-success">Simpan</button>
              </div>
            </div>
            <?php } ?>
          </form> 
          <?php  } elseif(!empty($_GET['kode_entry'])){ ?>
          <h4 class="text-center">Data Tidak Ditemukan</h4>
          <?php } ?>
        </div>
      </div>
      <br />
    </div>
  </div>
  <?php if(isset($entry) && !empty($entry)){  ?>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
            <h2><strong>Kuitansi</strong></h2>
            <!-- <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
          </ul> -->
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <?php if($this->session->flashdata('information') != ""): ?>
            <?php echo '<div class="container">
            <div class="alert alert-warning fade in">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Notification: </strong> '.$this->session->flashdata('information').'
            </div>
            </div>' ?>
          <?php endif; ?>
          <form class="form-horizontal" method="POST" action="<?php echo base_url()?>dex/simpan_kuitansi">
            <input type="hidden" name="_method" value="POST"/>
            <input type="hidden" name="entry_id" value="<?php  echo $entry->id; ?>" >
            <div class="form-group">
                <label class="col-sm-2 control-label">Kode Entry</label>
                <div class="col-sm-9">
                  <input type="text" name="kode_entry" class="form-control" placeholder="Kode Entry" 
                  value="<?php  echo $entry->kode_entry;?>" readonly>
                </div>
              </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Nomor Kuitansi</label>
              <div class="col-sm-9">
                <input type="text" name="no_kuitansi" value="<?php  if(!empty($kuitansi))echo $kuitansi->no_kuitansi; ?>" class="form-control" placeholder="Nomor Kuitansi" <?php  if(!empty($kuitansi))echo "disabled"; ?> required
                >

              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Jumlah Pembayaran</label>
              <div class="col-sm-9">
                <input type="text" name="jumlah" value="<?php  if(!empty($kuitansi))echo $kuitansi->jumlah; ?>" class="form-control input-accounting" placeholder="Jumlah Pembayaran" <?php  if(!empty($kuitansi))echo "disabled"; ?> required  
                >
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Pemohon</label>
              <div class="col-sm-9">
                <input type="text" name="pemohon" value="<?php  if(!empty($kuitansi))echo $kuitansi->pemohon; ?>" class="form-control" placeholder="Pemohon" <?php  if(!empty($kuitansi))echo "disabled"; ?> required  
                >
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Tanggal Masuk Dokumen</label>
              <div class="col-sm-9">
                <input type="text" name="tgl_masuk" value="<?php  if(!empty($kuitansi))echo date_view($kuitansi->tgl_masuk); ?>" class="form-control datepicker" placeholder="Tanggal Masuk Dokumen" <?php  if(!empty($kuitansi))echo "disabled"; ?> required  
                >
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Tanggal Kuitansi</label>
              <div class="col-sm-9">
                <input type="text" name="tgl_kuitansi" value="<?php  if(!empty($kuitansi))echo date_view($kuitansi->tgl_kuitansi); ?>" class="form-control datepicker" placeholder="Tanggal Kuitansi" <?php  if(!empty($kuitansi))echo "disabled"; ?> required  
                >
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label"></label>
              <div class="col-sm-9">
                <?php  if(!empty($kuitansi)) {?> 
                <div class="row">
                  <div class="col-md-12 col-sm-offset-0">
                    <div class="col-md-3 text-center">
                      <a href="http://tw-dex.atnaker.kemnaker.go.id/pdf/formulir/<?php echo $_GET['kode_entry']; ?>" target="_blank">
                        <img border="0" alt="PDF" src="<?php echo assets_url() ?>/images/pdf.png" width="50" height="50">
                      </a>
                      <p><?php echo $_GET['kode_entry']; ?>_formulir.pdf</p>
                    </div>
                    <div class="col-md-3 text-center">
                      <a href="http://endorsement.kdei-taipei.org/proses/printlabel4.php?bc={{base64UrlEncode($entry->kode_entry)}}" onclick="return popitup(this)">
                        <img border="0" alt="STIKER" src="<?php echo assets_url() ?>/images/print.png" width="50" height="50">
                      </a>
                      <p>Cetak Stiker</p>
                    </div>
                  </div>
                </div>
                <?php }else { ?>
                <button type="submit" class="btn btn-success">Simpan</button>
                <?php } ?>
              </div>
            </div>
          </form>
        </div>
      </div>
      <br />
    </div>
  </div>
  <?php } ?>
<script src="<?php echo base_url('assets/js/dex/jquery.js'); ?>" ></script>
<script src="<?php echo base_url('assets/js/dex/sweetalert.min.js'); ?>" ></script>
<script src="<?php echo base_url('assets/js/dex/selectize.js'); ?>" ></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/dex/cleave.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/dex/numeral.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/dex/moment.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/dex/bootstrap-datetimepicker.min.js'); ?>"></script>
<script>
  $(function(){
    $('.datepicker').datetimepicker({
      format: "DD-MM-YYYY"
    });
  })
  availHeight = window.screen.availHeight
  availWidth = window.screen.availWidth
  if(availWidth<900)
  {
    if(availWidth<900)$('.table-responsive').removeClass('col-xs-12');
    else $('.table-responsive').addClass('col-xs-12');
  }
  $(window).on('resize', function(){
    if(availWidth<900)$('.table-responsive').removeClass('col-xs-12');
    else $('.table-responsive').addClass('col-xs-12');
  });
  
</script>
<script>
var cleaved = [];
$(function() {
  makeAccounting(".input-accounting", true);
});

makeAccounting = function(e, multi) {
  const opt = {
        numeral: true,
        numeralThousandsGroupStyle: 'thousand'
      }
  if (multi) {
    console.log('multi')
    $(e).each(function() {
      var cleave = new Cleave(this, opt);
      cleaved.push(cleave);
    })
  } else {
    console.log('one', $(e))
    var cleave = new Cleave($(e), opt);
    cleaved.push(cleave);
  }
}

accounting = function(n) {
  return numeral(n).format('0,0');
}
unaccounting = function (n) {
  return numeral(n).value();
}
</script>
<script>
  <?php if($this->session->flashdata('create_success')){ ?>
  swal("Persetujuan Berhasil", "Data berhasil disetujui", "success");
  <?php } ?>

  <?php if($this->session->flashdata('create_kutansi_success')){ ?>
  swal("Kuitansi Tersimpan", "Kuitansi baru berhasil dicatat", "success");
  <?php } ?>

  <?php if($this->session->flashdata('create_failed')){ ?>
  swal('Oops...','Terjadi Kesalahan!','error')
  <?php } ?>

  <?php 
  if($this->session->flashdata('update_success')){ ?>
  swal("Perbaruan data berhasil", "Data berhasil diperbarui", "success");
  <?php } ?>

  <?php if($this->session->flashdata('update_failed')){ ?>
  swal('Oops...','Terjadi Kesalahan!','error')
  <?php } ?>
  
  function popitup(link) {
      var w = window.open(link.href, 'Label', 'width = 400, height = 300');
      return w? false:true;
  }

  <?php if(isset($entry) && !empty($entry)){  ?>

  selectize_agensi = $('.selectize-agensi').selectize({
      valueField: 'value',
      labelField: 'name',
      searchField: 'name',
      options: [],
      loadThrottle: 600,
      create: false,
      load: function(query, callback) {
          if (!query.length) return callback();
          $.ajax({
              url: 'http://tw-dex.atnaker.kemnaker.go.id/api/get_agensi_by_name',
              type: 'GET',
              dataType: 'json',
              data: {
                  name: query,
              },
              error: function() {
                  callback();
              },
              success: function(res) {
                console.log(res)
                  callback(res);
              }
          });
      }
    })[0].selectize;
  $("#select_pekerjaan").change(function()
    {
      var pekerjaans = []
      <?php foreach($pekerjaans as $pekerjaan){  ?>
          pekerjaans.push({id:<?php  echo $pekerjaan->id;?>,batas_bawah:<?php  echo $pekerjaan->batas_bawah;?>,batas_atas:<?php  echo $pekerjaan->batas_atas;?>})
      <?php } ?>
        selected_pekerjaan =$("#select_pekerjaan").val()
        pekerjaan = $.grep(pekerjaans, function(e){ return e.id == selected_pekerjaan; })[0];
        
        $("#select_gaji").find('option').remove().end()
        $("#batas_bawah_gaji").text(pekerjaan.batas_bawah+" 元");
        $("#batas_atas_gaji").text(pekerjaan.batas_atas+" 元");
        if(pekerjaan.id == 3)
        {
          $("#check_A").css('pointer-events','none')
          $("#check_B").css('pointer-events','')
          $("#check_C").css('pointer-events','')
          $("#check_B").click()
          $("#tgl_jangka_waktu").show()
        }
        else
        {
          $("#check_A").css('pointer-events','')
          $("#check_B").css('pointer-events','none')
          $("#check_C").css('pointer-events','none')
          $("#check_A").click()
          $("#tgl_jangka_waktu").hide() 
        }
        if (pekerjaan.id == 5 || pekerjaan.id == 6 )
        {
          $("#perusahaan").hide()
        }
        else $("#perusahaan").show() 
    })
    $('#select_pekerjaan').trigger("change");
    <?php if($entry->jangka_waktu==1){ ?>
    $("#check_A").css('pointer-events','')
    $("#check_A").click()
    <?php }else if($entry->jangka_waktu==2){ ?>
    $("#check_B").css('pointer-events','')
    $("#check_B").click()
    <?php }else { ?>
    $("#check_C").css('pointer-events','')
    $("#check_C").click()
    <?php } ?>
  <?php } ?>
</script>