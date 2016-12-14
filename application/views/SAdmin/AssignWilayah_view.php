
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
            <label class="control-label col-md-2 col-sm-2 col-xs-12">Wilayah </label>
            <div class="col-md-5 col-sm-5 col-xs-12">
              <select id="wilayah" name="wilayah" class="select2_single form-control" tabindex="-1">
                <optgroup label="Nama Wilayah">
                  <option></option>
                  <?php

                  foreach($listwilayah as $row): ?>
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
              <th>ID Wilayah</th>
              <th>Nama Wilayah</th>
              <th>Is Active</th>
              <th>Hapus</th>
            </tr>
          </thead>
          <tbody id="listwilayah">
          </tbody>
        </table>

      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
  var wrapper         = $("#listwilayah"); //Fields wrapper
  var add_button      = $(".addButton"); //Add button ID
  var remove_button   = $(".removeButton");
  var wilayah         = $("#wilayah");
  var institution     = $("#institution");
  var single_inst     = $("#inst");
  var table           = $('#datatable-responsive').DataTable();

  if($(single_inst).length) {
    var value = $(single_inst).val();
  } else {
    var value = $(institution).val();
  }

  $(add_button).hide();

  $(wilayah).change(function(){
    if ($(this).val() == "") {
      $(add_button).hide();
    } else {
      $(add_button).show();
    }
  });

  function addRow(idwilayah,inputvalue) {
    if(value > 0) {
      table.row.add( [
        idwilayah,
        inputvalue,
        '1',
        '<div class="center-button"><button class="btn btn-danger removeButton" type="button" name="button">Hapus</button></a></div>'
        ] ).draw(false);

      $.post("<?php echo base_url()?>wilayah/addWilayahInstitution", {idinstitution: value,idwilayah: idwilayah});
    }
  }

  function getTable() {
    $.post("<?php echo base_url()?>wilayah/getWilayahInstitution", {idinstitution: value}, function(data, status){
      var listwilayah = $.parseJSON(data);

      $(wrapper).empty();
      for (var key in listwilayah) {
        if (listwilayah.hasOwnProperty(key)) {
          table.row.add( [
            listwilayah[key]["idwilayah"],
            listwilayah[key]["namewilayah"],
            listwilayah[key]["isactive"],
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
    var idwilayah = $(wilayah).val();
    var inputvalue = $("#wilayah :selected").text();

    $.post("<?php echo base_url()?>wilayah/checkWilayahInstitution", {idinstitution: value, idwilayah: idwilayah}, function(data,status){
      var obj = $.parseJSON(data);
      if (obj == null) {
        addRow(idwilayah,inputvalue);
      } else {
        alert('Input sudah terpakai');
      }
    });
  });

  $(wrapper).on("click",".removeButton", function(e){ //user click on remove text
    e.preventDefault();
    var idwilayah = $(this).closest('tr').find("td:first").text();

    $.post("<?php echo base_url()?>wilayah/delWilayahInstitution", {idinstitution: value, idwilayah: idwilayah});

    table.row( $(this).closest('tr') ).remove().draw(false);
  })

});
</script>
