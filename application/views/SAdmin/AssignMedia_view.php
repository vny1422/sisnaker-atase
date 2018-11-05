
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

          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12">Institusi <span class="required">*</span></label>
            <div class="col-md-5 col-sm-5 col-xs-12">
              <?php
              if ($_SESSION['role'] == 1)
              {
                echo
                "<select id=\"institution\" name=\"institution\" required=\"required\" class=\"select2_single form-control\" tabindex=\"-1\">
                <option></option>";
                foreach($listinstitution as $row):
                  echo "<option value=".$row->idinstitution.">".$row->nameinstitution."</option>";
                endforeach;
                echo "</select>";
              }
              else
              {
                echo $listinstitution->nameinstitution;
                echo "<input type=\"hidden\" id=\"inst\" name=\"inst\" value=".$listinstitution->idinstitution.">";
              }
              ?>
            </div>
          </div>
          <br /><br /><br/>

          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12">Media </label>
            <div class="col-md-5 col-sm-5 col-xs-12">
              <select id="Media" name="Media" class="select2_single form-control" tabindex="-1">
                <optgroup label="Nama Media">
                  <option></option>
                  <?php

                  foreach($listMedia as $row): ?>
                  <option value="<?php echo $row->id ?>"><?php echo $row->name ?></option>
                <?php endforeach; ?>
              </optgroup>
            </select>
          </div>
          <div class="col-md-1 col-sm-1 col-xs-1">
            <button type="button" class="btn btn-default addButton"><i class="fa fa-plus"></i></button>
          </div>
        </div>
        <br /><br />

        <div class="ln_solid"></div>

        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>ID Media</th>
              <th>Nama Media</th>
              <th>Is Active</th>
              <th>Hapus</th>
            </tr>
          </thead>
          <tbody id="listMedia">
          </tbody>
        </table>

      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
  var wrapper         = $("#listMedia"); //Fields wrapper
  var add_button      = $(".addButton"); //Add button ID
  var remove_button   = $(".removeButton");
  var Media           = $("#Media");
  var institution     = $("#institution");
  var single_inst     = $("#inst");
  var table           = $('#datatable-responsive').DataTable();

  if($(single_inst).length) {
    var value = $(single_inst).val();
  } else {
    var value = $(institution).val();
  }

  $(add_button).hide();

  $(Media).change(function(){
    if ($(this).val() == "") {
      $(add_button).hide();
    } else {
      $(add_button).show();
    }
  });

  function addRow(idMedia,inputvalue) {
    if(value > 0) {
      table.row.add( [
        idMedia,
        inputvalue,
        '1',
        '<div class="center-button"><button class="btn btn-danger removeButton" type="button" name="button">Hapus</button></a></div>'
        ] ).draw(false);

      $.post("<?php echo base_url()?>Media/addMediaInstitution", {idinstitution: value, idMedia: idMedia});
    }
  }

  function getTable() {
    $.post("<?php echo base_url()?>Media/getMediaInstitution", {idinstitution: value}, function(data, status){
      var listMedia = $.parseJSON(data);

      $(wrapper).empty();
      for (var key in listMedia) {
        if (listMedia.hasOwnProperty(key)) {
          table.row.add( [
            listMedia[key]["idMedia"],
            listMedia[key]["nameMedia"],
            listMedia[key]["isactive"],
            '<div class="center-button"><button class="btn btn-danger removeButton" type="button" name="button">Hapus</button></a></div>'
            ] ).draw();
        }
      }
    });
  }

  if ($(single_inst).length) {
    getTable();
  }
  
  $(institution).change(function(){
    table.clear();
    value = $(this).val();
    getTable();
  });

  $(add_button).click(function(){
    var idMedia = $(Media).val();
    var inputvalue = $("#Media :selected").text();

    $.post("<?php echo base_url()?>Media/checkMediaInstitution", {idinstitution: value, idMedia: idMedia}, function(data,status){
      var obj = $.parseJSON(data);
      if (obj == null) {
        addRow(idMedia,inputvalue);
      } else {
        alert('Input sudah terpakai');
      }
    });
  });

  $(wrapper).on("click",".removeButton", function(e){ //user click on remove text
    e.preventDefault();
    var idMedia = $(this).closest('tr').find("td:first").text();

    $.post("<?php echo base_url()?>Media/delMediaInstitution", {idinstitution: value, idMedia: idMedia});

    table.row( $(this).closest('tr') ).remove().draw(false);
  })

});
</script>
