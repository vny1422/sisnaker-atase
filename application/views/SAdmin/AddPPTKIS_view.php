
<!-- page content -->

<div class="right_col" role="main">

  <div class="row">
  </div>
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
          <?php echo form_open(base_url('AgensiPPTKIS/addPPTKIS')) ?>

          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Kode PPTKIS <span class="required">*</span></label>
            <div class="col-md-5 col-sm-5 col-xs-12">
              <input type="text" name="kode" required="required" class="form-control">
            </div>
          </div><br /><br /><br />

          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Name <span class="required">*</span></label>
            <div class="col-md-5 col-sm-5 col-xs-12">
              <input type="text" name="name" required="required" class="form-control">
            </div>
          </div><br /><br /><br />

          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Alamat Kantor <span class="required">*</span></label>
            <div class="col-md-5 col-sm-5 col-xs-12">
              <input type="text" name="address" required="required" class="form-control">
            </div>
          </div><br /><br /><br />

          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">No Telp PPTKIS<span class="required">*</span></label>
            <div class="col-md-5 col-sm-5 col-xs-12">
              <input type="text" name="notelp" required="required" class="form-control">
            </div>
          </div><br /><br /><br />

          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">No Fax PPTKIS<span class="required">*</span></label>
            <div class="col-md-5 col-sm-5 col-xs-12">
              <input type="text" name="nofax" required="required" class="form-control">
            </div>
          </div><br /><br /><br />

          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Ijin PPTKIS<span class="required">*</span></label>
            <div class="col-md-5 col-sm-5 col-xs-12">
              <input type="text" name="ijin" required="required" class="form-control">
            </div>
          </div><br /><br /><br />

          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Penanggung Jawab PPTKIS<span class="required">*</span></label>
            <div class="col-md-5 col-sm-5 col-xs-12">
              <input type="text" name="penanggung" required="required" class="form-control">
            </div>
          </div><br /><br /><br />

          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Status PPTKIS<span class="required">*</span></label>
            <div class="col-md-5 col-sm-5 col-xs-12">
              <input type="text" name="status" required="required" class="form-control">
            </div>
          </div><br /><br /><br />

          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Provinsi <span class="required">*</span></label>
            <div class="col-md-5 col-sm-5 col-xs-12">
              <select name="propinsi" id="provinsi" required="required" class="select2_single form-control" tabindex="-1">
                <option></option>
                <?php foreach($provinsi as $row): ?>
                  <option value="<?php echo $row->id_prov ?>"><?php echo $row->nama ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div><br /><br /><br />

          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Kota <span class="required">*</span></label>
            <div class="col-md-5 col-sm-5 col-xs-12">
              <select name="kota" id="kota" required="required" class="select2_single form-control" tabindex="-1">
                <option></option>
              </select>
            </div>
          </div><br /><br /><br />

          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="active">Is Active </label>
            <div class="col-md-1 col-sm-1 col-xs-2">
              <input type="checkbox" name="active">
            </div>
          </div><br />

          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12">
              <button type="reset" name="cancel" class="btn btn-primary">Cancel</button>
              <button type="submit" name="submit" class="btn btn-success">Submit</button>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>



<script type="text/javascript">
$(document).ready(function() {

  $('#provinsi').on('change', function() {
    // alert( 'On change nih!' );
    $.post(" <?php echo base_url() ?>AgensiPPTKIS/get_kota_by_prov", {prov_id:this.value}, function(data, status){
      var obj = $.parseJSON(data);
      if(obj.length > 0) {
        $("#kota").empty();
        for (var key in obj) {
          //$(".pptkis").add(new Option(obj[key].ppnama, obj[key].ppkode));
          $("#kota").append($("<option></option>")
          .attr("value", obj[key].id_kab).text(obj[key].nama));
        }
      } else {
        $(".kota").empty();
        //alert('Data tidak ada');
      }
    });

  });
});

</script>
