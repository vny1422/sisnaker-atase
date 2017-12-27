
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

          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Nama Input <span class="required">*</span></label>
            <div class="col-md-5 col-sm-5 col-xs-12">
              <input type="text" name="name" required="required" class="form-control">
            </div>
          </div><br /><br /><br />

          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12">Kategori <span class="required">*</span></label>
            <div class="col-md-5 col-sm-5 col-xs-12">
              <select name="kategori" required="required" class="select2_single form-control" tabindex="-1">
                <option></option>
                <?php foreach($listcategory as $row): ?>
                  <option value="<?php echo $row->idcategory_penempatan ?>"><?php echo $row->namecategory ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div><br /><br /><br />

          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12">Tipe Input <span class="required">*</span></label>
            <div class="col-md-5 col-sm-5 col-xs-12">
              <select id="inputtype" name="inputtype" required="required" class="select2_single form-control" tabindex="-1">
                <option></option>
                <?php foreach($listinputtype as $row): ?>
                  <option value="<?php echo $row->idinputtype ?>"><?php echo $row->nameinputtype ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <br /><br /><br />
          </div>
          <div class="input_fields_wrap" id="wrapconn">
            <div class="form-group">
              <label class="control-label col-md-1 col-sm-1 col-xs-12 col-md-offset-1" for="name">Opsi Input <span class="required">*</span></label>
              <div class="col-md-3 col-sm-3 col-xs-12">
                <select id="conntable" name="conntable" class="select2_single form-control" tabindex="-1">
                <option></option>
                <option value="tabel">Dari Tabel</option>
                <option value="opsi">Dari Opsi Input</option>
              </select>
              </div>
              <br /><br /><br />
            </div>
          </div>

          <div class="input_fields_wrap" id="wraptabel">
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Nama Tabel <span class="required">*</span></label>
            <div class="col-md-5 col-sm-5 col-xs-12">
              <input type="text" name="namatabel" class="form-control">*Tabel harus mempunyai field id dan name
            </div>
            
          </div><br /><br /><br /><br />
        </div>

          <div class="input_fields_wrap" id="wrapopsi">
            <div class="form-group">
              <label class="control-label col-md-1 col-sm-1 col-xs-12 col-md-offset-1" for="name">Opsi 1 <span class="required">*</span></label>
              <div class="col-md-3 col-sm-3 col-xs-12">
                <input type="text" name="opsi1" class="form-control">
              </div>
              <div class="col-md-1 col-sm-1 col-xs-1">
                <button type="button" class="btn btn-default addButton"><i class="fa fa-plus"></i></button>
              </div>
              <br /><br /><br />
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Keterangan </label>
            <div class="col-md-5 col-sm-5 col-xs-12">
              <input type="text" name="keterangan" class="form-control">
            </div>
          </div><br /><br /><br />

          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Field Name </label>
            <div class="col-md-5 col-sm-5 col-xs-12">
              <input type="text" name="fieldname" class="form-control">
            </div>
          </div><br /><br />

        <div class="ln_solid"></div>
        <div class="form-group">
          <div class="col-md-6 col-sm-6 col-xs-12">
            <button type="reset" class="btn btn-primary">Cancel</button>
            <button type="submit" class="btn btn-success">Submit</button>
          </div>
        </div>

        </form>

      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
  var max_fields      = 100; //maximum input boxes allowed
  var wrapper         = $("#wrapconn"); //Fields wrapper
  var wrapopsi        = $("#wrapopsi"); //Fields wrapper
  var add_button      = $(".addButton"); //Add button ID
  var input_type      = $("#inputtype");
  var wraptabel       = $("#wraptabel");
  var x = 2; //initlal text box count

  $(wrapper).hide();
  $(wrapopsi).hide();
  $(wraptabel).hide();

  $(input_type).change(function(){
    if ($("#inputtype :selected").text() == 'select' || $("#inputtype :selected").text() == 'Select') {
      $(wrapper).show();
    } else {
      $(wrapper).hide();
    }
  });

  $(wrapper).change(function(){
    if ($("#wrapconn :selected").text() == 'Dari Opsi Input') {
      $(wrapopsi).show();
      $(wraptabel).hide();
    } else if ($("#wrapconn :selected").text() == 'Dari Tabel') {
      $(wraptabel).show();
      $(wrapopsi).hide();
    }
    else {
      $(wrapopsi).hide();
      $(wraptabel).hide();
      $(wrapper).hide();
    }
  });

  $(add_button).click(function(e){ //on add input button click
    e.preventDefault();
    if(x < max_fields){ //max input box allowed
      $(wrapopsi).append('<div class="form-group"><label class="control-label col-md-1 col-sm-1 col-xs-12 col-md-offset-1" for="name">Opsi '+ x +'<span class="required">*</span></label><div class="col-md-3 col-sm-3 col-xs-12"><input type="text" name="opsi'+ x +'" required="required" class="form-control"></div><div class="col-md-1 col-sm-1 col-xs-1"><button type="button" class="btn btn-default remove_field"><i class="fa fa-trash"></i></button></div><br /><br /><br /></div>'); //add input box

      x++; //text box increment
    }
  });

  $(wrapopsi).on("click",".remove_field", function(e){ //user click on remove text
    e.preventDefault();
    $(this).closest('.form-group').remove();
    x--;
  })

});
</script>
