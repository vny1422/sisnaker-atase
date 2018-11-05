
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
          <?php echo form_open(base_url('AgensiPPTKIS/addAgensi')) ?>

          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Nama Agensi <span class="required">*</span></label>
            <div class="col-md-5 col-sm-5 col-xs-12">
              <input type="text" name="name" required="required" class="form-control">
            </div>
          </div><br /><br /><br />
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Nama Agensi (Other)<span class="required">*</span></label>
            <div class="col-md-5 col-sm-5 col-xs-12">
              <input type="text" name="nameother" required="required" class="form-control">
            </div>
          </div><br /><br /><br />
          <?php if($this->session->userdata('role') == 1):
            echo '<div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12">Negara <span class="required">*</span></label>
            <div class="col-md-5 col-sm-5 col-xs-12">
            <select name="institution" required="required" class="select2_single form-control" tabindex="-1">
            <option></option>';
            elseif($this->session->userdata('role') == 2):
              echo '<div class="form-group">
              <label class="control-label col-md-2 col-sm-2 col-xs-12">Institution <span class="required">*</span></label>
              <div class="col-md-5 col-sm-5 col-xs-12">
              <select name="institution" disabled required="required" class="select2_single form-control" tabindex="0">';
            endif; ?>
            <?php foreach($listinstitution as $row): ?>
              <option value="<?php echo $row->idinstitution ?>"><?php echo $row->nameinstitution ?></option>
            <?php endforeach; ?>
          </select>
          <?php if($this->session->userdata('role') == 2):
            echo '<input type="hidden" name="institution"value="'.$row->idinstitution.'" />';
          endif; ?>
        </div>
      </div>
      <br /><br /><br />
      <?php if($this->session->userdata('role') == 1):
        echo '<div class="form-group">
        <label class="control-label col-md-2 col-sm-2 col-xs-12">User Agensi <span class="required">*</span></label>
        <div class="col-md-5 col-sm-5 col-xs-12">
        <input id="useragensi" type="text" placeholder="autocomplete" name="useragensi" class="form-control">
        <input type="hidden" id="useragensiid" name="useragensiid" class="form-control">';
        elseif($this->session->userdata('role') == 2):
          echo '<div class="form-group">
          <label class="control-label col-md-2 col-sm-2 col-xs-12">User Agensi <span class="required">*</span></label>
          <div class="col-md-5 col-sm-5 col-xs-12">
          <input id="useragensi" type="text" placeholder="autocomplete" name="useragensi" class="form-control">
          <input type="hidden" id="useragensiid" name="useragensiid" class="form-control">';
        endif; ?>

    </div>
  </div>
  <br /><br /><br />
  <div class="form-group">
    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">No Ijin CLA<span class="required">*</span></label>
    <div class="col-md-5 col-sm-5 col-xs-12">
      <input type="text" name="noijin" required="required" class="form-control">
    </div>
  </div><br /><br /><br />

  <div class="form-group">
    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Alamat Agensi <span class="required">*</span></label>
    <div class="col-md-5 col-sm-5 col-xs-12">
      <input type="text" name="address" required="required" class="form-control">
    </div>
  </div><br /><br /><br />

  <div class="form-group">
    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Alamat Agensi (Other) <span class="required">*</span></label>
    <div class="col-md-5 col-sm-5 col-xs-12">
      <input type="text" name="addressother" required="required" class="form-control">
    </div>
  </div><br /><br /><br />

  <div class="form-group">
    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Penanggung Jawab Agensi <span class="required">*</span></label>
    <div class="col-md-5 col-sm-5 col-xs-12">
      <input type="text" name="penanggung" required="required" class="form-control">
    </div>
  </div><br /><br /><br />

  <div class="form-group">
    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Penanggung Jawab Agensi (Other) <span class="required">*</span></label>
    <div class="col-md-5 col-sm-5 col-xs-12">
      <input type="text" name="penanggungother" required="required" class="form-control">
    </div>
  </div><br /><br /><br />

  <div class="form-group">
    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">No Telp Agensi<span class="required">*</span></label>
    <div class="col-md-5 col-sm-5 col-xs-12">
      <input type="text" name="notelp" required="required" class="form-control">
    </div>
  </div><br /><br /><br />

  <div class="form-group">
    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">No Fax Agensi<span class="required">*</span></label>
    <div class="col-md-5 col-sm-5 col-xs-12">
      <input type="text" name="nofax" required="required" class="form-control">
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
      <a href="javascript:history.back()" class="btn btn-primary">Cancel</a>
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

  $(function() {
    $( "#useragensi" ).autocomplete({
      source: function(request, response) {
        $.post('<?php echo base_url();?>AgensiPPTKIS/get_user_agensi/', { term:request.term}, function(json) {
          response( $.map( json.rows, function( item ) {
            return {
              label: item.username
            }
          }));
        }, 'json');
      },
      minLength: 1,
      select: function( event, ui ) {
        $("#useragensiid").val(ui.item.label);
      }
    });
  } );

});

</script>
