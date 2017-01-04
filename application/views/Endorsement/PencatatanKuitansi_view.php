
<!-- page content -->
<div class="right_col" role="main">

  <br />
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2><strong><?php echo $title; ?></strong></h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <?php
            if (validation_errors() != "") {
              echo "<div class=\"well well-sm\">";
                echo validation_errors();
              echo "</div>";
            }
          ?>
          <?php if($this->session->flashdata('information') != ""): ?>
          <?php echo '<div class="container">
            <div class="alert alert-success fade in">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Selamat!</strong> '.$this->session->flashdata('information').'
            </div>
          </div>' ?>
        <?php endif; ?>
          <?php echo form_open(base_url('input/addpenempatan')) ?>

          <div class="form-group" >
            <label class="col-sm-2 control-label">Tanggal Masuk</label>
            <div class="col-sm-2">
              <div class="input-group date datepicker col-md-12 col-xs-12" data-provide="datepicker" ng-class="{'has-error':(pst && shForm.inDate.$invalid)}">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <input id="ckstart" type="text" class="form-control tglformat" ng-model="shelterform['in']" name="inDate" required></input>
              </div>
            </div>
          </div><br /><br /><br /><br />

          <div class="form-group" >
            <label class="col-sm-2 control-label">Tanggal Kuitansi</label>
            <div class="col-sm-2">
              <div class="input-group date datepicker col-md-12 col-xs-12" data-provide="datepicker" ng-class="{'has-error':(pst && shForm.inDate.$invalid)}">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <input id="ckexpired" type="text" class="form-control tglformat" ng-model="shelterform['in']" name="inDate" required></input>
              </div>
            </div>
          </div><br /><br /><br />

          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12">Jenis Dokumen <span class="required">*</span></label>
            <div class="col-md-5 col-sm-5 col-xs-12">
              <select id="level" name="level" required="required" class="select2_single form-control" tabindex="-1">
                <option></option>
                <?php foreach($listlevel as $row): ?>
                  <option value="<?php echo $row->idlevel ?>"><?php echo $row->levelname ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <br /><br /><br/>

          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">No. Kuitansi <span class="required">*</span></label>
            <div class="col-md-3 col-sm-5 col-xs-12">
              <input id="agensi" type="text" name="name" required="required" class="form-control">
              <div class="value"><input id="checkkuno" type="button" value="Check"/><label for="kuno" class="error">Silahkan masukkan No. Kuitansi</label></div>
            </div>
          </div><br /><br /><br /><br />

          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Jumlah Terbayar <span class="required">*</span></label>
            <div class="col-md-5 col-sm-5 col-xs-12">
              <input id="" type="text" name="name" required="required" class="form-control">Jumlah Terbayar dalam satuan NT$
            </div>  
          </div><br /><br /><br /><br />

          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Nama Pemohon <span class="required">*</span></label>
            <div class="col-md-5 col-sm-5 col-xs-12">
              <input id="agensi" type="text" name="name" required="required" class="form-control">
            </div>
          </div><br /><br /><br />

          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="active">Endorse Sekarang (Tidak Perlu Catat Kuitansi Ganda) ? </label>
            <div class="col-md-1 col-sm-1 col-xs-2">
              <input type="checkbox" id="cekenable" name="active">
            </div>
          </div><br /><br /><br /><br />

        <div class="form-group">
          <div class="col-md-6 col-sm-6 col-xs-12">
            <button type="reset" class="btn btn-primary">Cancel</button>
            <button type="submit" class="btn btn-success">Submit</button>
          </div>
        </div>
        <br /><br />

        </form>
      </div>
   </div>

<br /><br /><br />



<div class="bs-example" data-example-id="simple-jumbotron">
  <div class="jumbotron">
    <h1>INGAT!</h1>
    <p><strong>Satu humao, satu barcode. </strong>Jika satu kuitansi digunakan untuk beberapa humao, silahkan diinput berulang kali (sesuai jumlah humao) dengan tetap menggunakan no. kuitansi yang sama.</p>

    <p>Jumlah stiker yang anda cetak ternyata kurang?
      Klik disini untuk cetak kembali stiker <a style="color: #029E8D" href="">Job Order Endorsement</a> ATAU <a style="color: #029E8D" href="">selain Job Order Endorsement</a>.</p>
    </div>
  </div>

    </div>
</div>


<script type="text/javascript">

$(function() {
  $( "#agensi" ).autocomplete({
    source: function(request, response) {
      $.post('<?php echo base_url();?>/Paket/ambilnamaagensi/', { term:request.term}, function(json) {
        response( $.map( json.rows, function( item ) {
          return {
            label: item.agnama,
            id: item.agid
          }
        }));
      }, 'json');
    },
    minLength: 1,
    select: function( event, ui ) {
      idagensi = ui.item.id;
    }
  });
} );
</script>
