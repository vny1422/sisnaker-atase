
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
            <label class="control-label col-md-2 col-sm-2 col-xs-12">Level <span class="required">*</span></label>
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
            <label class="control-label col-md-2 col-sm-2 col-xs-12">Detail Privilege </label>
            <div class="col-md-5 col-sm-5 col-xs-12">
              <select id="detail" name="detail" class="select2_single form-control" tabindex="-1">
                <optgroup label="Nama Menu | Page URL | Nama Privilege Group">
                  <option></option>
                  <?php
                  $i=0;
                  foreach($listdpriv as $row): ?>
                  <option value="<?php echo $row->idprivilege ?>"><?php echo $row->menuname ?> | <?php echo $row->pageurl ?> | <?php echo $listnamapg[$i]->privilegegroupname ?></option>
                  <?php $i=$i+1; endforeach; ?>
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
                <th>ID Detail Privilege</th>
                <th>Nama Menu</th>
                <th>Page URL</th>
                <th>Name Privilege Group</th>
                <th>Hapus</th>
              </tr>
            </thead>
            <tbody id="listdetail">
            </tbody>
          </table>

        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    $(document).ready(function() {
  var wrapper         = $("#listdetail"); //Fields wrapper
  var add_button      = $(".addButton"); //Add button ID
  var remove_button   = $(".removeButton");
  var level           = $("#level");
  var detail          = $("#detail");
  var table           = $('#datatable-responsive').DataTable();

  $(add_button).hide();

  $(detail).change(function(){
    if ($(this).val() == "") {
      $(add_button).hide();
    } else {
      $(add_button).show();
    }
  });

  function addRow(idprivilege,inputarray) {
    if($(level).val() > 0) {
      table.row.add( [
          idprivilege,
          inputarray[0],
          inputarray[1],
          inputarray[2],
          '<div class="center-button"><button class="btn btn-danger removeButton" type="button" name="button">Hapus</button></a></div>'
        ] ).draw(false);

      $.post("<?php echo base_url()?>level/addLevelDetail", {idlevel: $(level).val(),idprivilege: idprivilege});
    }
  }

  $(add_button).click(function(){
    var idprivilege = $(detail).val();
    var inputvalue = $("#detail :selected").text();
    var inputarray = inputvalue.split(" | ");

    $.post("<?php echo base_url()?>level/checkLevelDetail", {idlevel: $(level).val(),idprivilege: idprivilege}, function(data,status){
      var obj = $.parseJSON(data);
      if (obj == null) {
        addRow(idprivilege,inputarray);
      } else {
        alert('Privilege Detail sudah terpakai');
      }
    });
  });

  $(level).change(function(){
    table.clear();
    $.post("<?php echo base_url()?>level/getLevelDetail", {idlevel: $(this).val()}, function(data, status){
      var listdetail = $.parseJSON(data);

      $(wrapper).empty();
      for (var key in listdetail) {
        if (listdetail.hasOwnProperty(key)) {
            table.row.add( [
            listdetail[key]["idprivilege"],
            listdetail[key]["menuname"],
            listdetail[key]["pageurl"],
            listdetail[key]["namepg"],
            '<div class="center-button"><button class="btn btn-danger removeButton" type="button" name="button">Hapus</button></a></div>'
            ] ).draw();
          }
        }
      });
  });

  $(wrapper).on("click",".removeButton", function(e){ //user click on remove text
    e.preventDefault();
    var idprivilege = $(this).closest('tr').find("td:first").text();

    $.post("<?php echo base_url()?>level/delLevelDetail", {idlevel: $(level).val(),idprivilege: idprivilege});

    table.row( $(this).closest('tr') ).remove().draw(false);
  })

});
</script>
