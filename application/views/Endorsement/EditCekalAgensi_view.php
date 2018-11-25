
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
          <?php echo form_open(base_url('cekal/editcklag/'.$values->caid)) ?>

          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12">Nama Agensi <span class="required">*</span></label>
            <div class="col-md-5 col-sm-5 col-xs-12">
              <select name="agensi" required="required" class="select2_single form-control" tabindex="-1">
                <option></option>
                <?php foreach($agency as $row): ?>
                  <option value="<?php echo $row->agid ?>" <?php if ($row->agid == $values->agid) echo 'selected'?>><?php echo $row->agnama ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div><br /><br /><br />

          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="active">Is Active </label>
            <div class="col-md-1 col-sm-1 col-xs-2">
              <input type="checkbox" id="cekenable" name="active" <?php if($values->caend != NULL) echo 'checked';?>>
            </div>
          </div><br /><br />

          <div class="form-group" >
            <label class="col-sm-2 control-label">Mulai</label>
            <div class="col-sm-2">
              <div class="input-group date datepicker col-md-12 col-xs-12" data-provide="datepicker" ng-class="{'has-error':(pst && shForm.inDate.$invalid)}">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <input id="ckstart" type="text" name="start" value="<?php echo $values->castart ?>" class="form-control tglformat" ng-model="shelterform['in']" name="inDate" required disabled=""></input>
              </div>
            </div>
          </div><br /><br /><br />

          <div class="form-group" >
            <label class="col-sm-2 control-label">Berakhir</label>
            <div class="col-sm-2">
              <div class="input-group date datepicker col-md-12 col-xs-12" data-provide="datepicker" ng-class="{'has-error':(pst && shForm.inDate.$invalid)}">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <input id="ckexpired" type="text" name="end" value="<?php echo $values->caend ?>" class="form-control tglformat" ng-model="shelterform['in']" name="inDate" required disabled=""></input>
              </div>
            </div>
          </div><br /><br /><br />

          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="active">Enable </label>
            <div class="col-md-1 col-sm-1 col-xs-2">
              <input type="checkbox" id="agenable" name="enable" <?php if($values->enable == 1) echo 'checked';?>>
            </div>
          </div><br /><br />

          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Catatan </label>
            <div class="col-md-5 col-sm-5 col-xs-12">
              <textarea class="resizable_textarea form-control" name="catatan"><?php echo $values->cacatatan ?></textarea>
            </div>
          </div><br /><br /><br /><br /><br /><br /><br /><br />

          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12">
              <button type="reset" name="cancel" class="btn btn-primary">Cancel</button>
              <button type="submit" name="submit" class="btn btn-success">Update</button>
            </div>
          </div>

        </form>

      </div>
    </div>
  </div>




</div>


<script type="text/javascript">
var checkbox = $("#cekenable");
$( document ).ready(function() {
  var cekdate = document.getElementById("ckexpired").value;
  if (cekdate!="") {
      $('.tglformat').removeAttr('disabled');

  } else {
      $('.tglformat').attr('disabled', 'disabled');
  }
});


checkbox.change(function(event) {
    var checkbox = event.target;
    if (checkbox.checked) {
        $('.tglformat').removeAttr('disabled');
    } else {
        $('.tglformat').attr('disabled', 'disabled');
    }
});

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
