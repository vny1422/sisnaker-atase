
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
              <strong>Notification: </strong> '.$this->session->flashdata('information').'
            </div>
          </div>' ?>
        <?php endif; ?>
          <?php echo form_open(base_url('cekal/pptkis')) ?>

          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12">Nama PPTKIS <span class="required">*</span></label>
            <div class="col-md-5 col-sm-5 col-xs-12">
              <select name="pptkis" required="required" class="select2_single form-control" tabindex="-1">
                <option></option>
                <?php foreach($list as $row): ?>
                  <option value="<?php echo $row->ppkode ?>"><?php echo $row->ppnama ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div><br /><br /><br />

          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="active">Gunakan Batasan Tanggal</label>
            <div class="col-md-1 col-sm-1 col-xs-2">
              <input type="checkbox" id="cekenable" name="active">
            </div>
          </div><br /><br />

          <div class="form-group" >
            <label class="col-sm-2 control-label">Mulai</label>
            <div class="col-sm-2">
              <div class="input-group date datepicker col-md-12 col-xs-12" data-provide="datepicker" ng-class="{'has-error':(pst && shForm.inDate.$invalid)}">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <input id="ckstart" type="text" class="form-control tglformat" name="start" required disabled=""></input>
              </div>
            </div>
          </div><br /><br /><br />

          <div class="form-group" >
            <label class="col-sm-2 control-label">Berakhir</label>
            <div class="col-sm-2">
              <div class="input-group date datepicker col-md-12 col-xs-12" data-provide="datepicker" ng-class="{'has-error':(pst && shForm.inDate.$invalid)}">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <input id="ckexpired" type="text" class="form-control tglformat" name="end" required disabled=""></input>
              </div>
            </div>
          </div><br /><br /><br /><br /><br />

        <div class="form-group">
          <div class="col-md-6 col-sm-6 col-xs-12">
            <button type="reset" class="btn btn-primary">Cancel</button>
            <button type="submit" class="btn btn-success">Submit</button>
          </div>
        </div>

        </form>

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
          <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>PPTKIS</th>
                <th>Mulai</th>
                <th>Berakhir</th>
                <th>Aktif</th>
                <th>Edit</th>
                <th>Hapus</th>
              </tr>
            </thead>
            <tbody>
            <?php foreach($listcekal as $row): ?>
              <tr>
                <td><?php echo $row->ppnama ?></td>
                <td><?php echo $row->cpstart ?></td>
                <td><?php echo $row->cpend ?></td>
                <td><?php echo $row->enable ?></td>
                <td>
                  <div class="center-button"><a href="<?php echo base_url() ?>Cekal/editcklpptkis/<?php echo $row->cpid ?>"><button class="btn btn-info" type="button" name="button">Edit</button></a></div>
                </td>
                <td>
                  <div class="center-button"><a href=" <?php echo base_url() ?>Cekal/deletePPTKIS/<?php echo $row->cpid ?>"><button align="center" class="btn btn-danger" type="button" name="button">Hapus</button></a></div>
                </td>
              </tr>
            <?php endforeach; ?>
              </tr>

            </tbody>
          </table>

        </div>
        <div class="clearfix"></div>
      </div>
      <div>
        <br><br>
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

$(function() {
  $( "#pptkis" ).autocomplete({
    source: function(request, response) {
      $.post('<?php echo base_url();?>/Paket/ambilnamapptkis/', { term:request.term}, function(json) {
        response( $.map( json.rows, function( item ) {
          return {
            label: item.ppnama,
            id: item.ppkode
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
