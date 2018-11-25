
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
        <?php 
        define('FILE_UPLOAD',array(['key'=>'FILE_SURAT_MOL','value'=>'Surat MOL （勞動部招募函）'],['key'=>'FILE_KTP_MAJIKAN','value'=>'KTP majikan（雇主身份證)'],['key'=>'FILE_PASPOR_ARC','value'=>'paspor & ARC TKI（勞工護照及居留證）'],['key'=>'FILE_ASURANSI_TAIWAN','value'=>'Asuransi Taiwan （臺灣保險）'],['key'=>'FILE_LISENSI_AGENSI','value'=>'Lisensi agensi*  （臺仲許可證）'],['key'=>'FILE_SURAT_IJIN_KELUARGA','value'=>'Surat ijin keluarga （家屬同意書）'],['key'=>'FILE_SURAT_PERNYATAAN_TKI','value'=>'Surat pernyataan TKI （勞工切結書）'],['key'=>'FILE_LISENSI_PERUSAHAAN','value'=>'Lisensi perusahaan/panti jompo/kapal** （公司/養護機構/船 登記證/經濟部）']))
         ?>
         <?php foreach ($pekerjaans as $pekerjaan){?>
         <form class="form-horizontal" method="POST" action="<?php echo base_url()?>dex/salary/">
           <input type="hidden" name="id" value="<?php echo $pekerjaan->id ?>">
           <input type="hidden" name="_method" value="PUT"/>
           <div class="form-group">
              <label class="col-sm-2 control-label"><?php echo $pekerjaan->nama ?></label>
              <div class="col-sm-3">
                <input type="text" name="batas_bawah" class="form-control input-accounting" placeholder="Batas Bawah" 
                value="<?php echo $pekerjaan->batas_bawah ?>">
              </div>
              <div class="col-sm-1">
                Sampai
              </div>
              <div class="col-sm-3">
                <input type="text" name="batas_atas" class="form-control input-accounting" placeholder="Batas Atas" 
                value="<?php echo $pekerjaan->batas_atas ?>">
              </div>
              <div class="col-sm-1">
                <button type="submit" class="btn btn-success">Update</button>
              </div>
            </div>
         </form>

         <?php } ?>
      </div>

    </div>
    <br />
  </div>
</div>
<script src="<?php echo base_url('assets/js/dex/jquery.js'); ?>" ></script>
<script src="<?php echo base_url('assets/js/dex/sweetalert.min.js'); ?>" ></script>
<script src="<?php echo base_url('assets/js/dex/selectize.js'); ?>" ></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/dex/cleave.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/dex/numeral.min.js'); ?>"></script>
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
  <?php 
  if($this->session->flashdata('update_success')){ ?>
  swal("Perbaruan data berhasil", "Data berhasil diperbarui", "success");
  <?php } ?>

  <?php if($this->session->flashdata('update_failed')){ ?>
  swal('Oops...','Terjadi Kesalahan!','error')
  <?php } ?>
</script>