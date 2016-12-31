
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
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Nama Agensi <span class="required">*</span></label>
            <div class="col-md-5 col-sm-5 col-xs-12">
              <input type="text" name="name" required="required" class="form-control">
            </div>
          </div><br /><br /><br />

          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="active">Is Active </label>
            <div class="col-md-1 col-sm-1 col-xs-2">
              <input type="checkbox" id="cekenable" name="active">
            </div>
          </div><br /><br />

          <div class="form-group" >
            <label class="col-sm-2 control-label">Mulai</label>
            <div class="col-sm-2">
              <div class="input-group date datepicker col-md-12 col-xs-12" data-provide="datepicker" ng-class="{'has-error':(pst && shForm.inDate.$invalid)}">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <input id="ckstart" type="text" class="form-control tglformat" ng-model="shelterform['in']" name="inDate" required disabled=""></input>
              </div>
            </div>
          </div><br /><br /><br />

          <div class="form-group" >
            <label class="col-sm-2 control-label">Berakhir</label>
            <div class="col-sm-2">
              <div class="input-group date datepicker col-md-12 col-xs-12" data-provide="datepicker" ng-class="{'has-error':(pst && shForm.inDate.$invalid)}">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <input id="ckexpired" type="text" class="form-control tglformat" ng-model="shelterform['in']" name="inDate" required disabled=""></input>
              </div>
            </div>
          </div><br /><br /><br />

          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Catatan </label>
            <div class="col-md-5 col-sm-5 col-xs-12">
              <textarea class="resizable_textarea form-control"></textarea>
            </div>
          </div><br /><br /><br /><br /><br /><br /><br /><br />

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
var checkbox = $("#cekenable");

checkbox.change(function(event) {
    var checkbox = event.target;
    if (checkbox.checked) {
        $('.tglformat').removeAttr('disabled');
    } else {
        $('.tglformat').attr('disabled', 'disabled');
    }
});
</script>
