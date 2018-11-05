<style media="screen">
    .minilabel{
        padding-top: 5%;
        margin-right: -20%;
    }

    .kuota{
      margin-left: -5%;
    }
</style>
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
          <?php echo form_open_multipart(base_url('PkNew/uploadDokFin/'.$values)) ?>

        <div class="form-group">
          <label class="control-label col-md-2" for="name">Dokumen Pengajuan PK<span class="required">*</span></label>
          <div class="col-md-5 ">
            <input id="dokumenfinalpk" type="file" name="dokumenfinalpk" class="form-control">
          </div>
        </div><br /><br /><br />



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

});
</script>
