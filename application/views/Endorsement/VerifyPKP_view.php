
<!-- page content -->
<div class="right_col" role="main">

  <br />
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2><strong><?php echo $subtitle; ?></strong></h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <?php if($this->session->flashdata('information') != ""): ?>
            <?php echo '<div class="container">
            <div class="alert alert-warning fade in">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Notification: </strong> '.$this->session->flashdata('information').'
            </div>
            </div>' ?>
          <?php endif; ?>
          <table id="tbpkp" class="table table-striped table-bordered dt-responsive" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>Barcode PKP</th>
                <th>PPTKIS</th>
                <th>Agensi</th>
                <th>Tanggal Awal</th>
                <th>Tanggal Akhir</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody id="pkplist">
              <?php
              foreach($listpkp as $row): ?>
              <tr>
                <td><?php echo $row->pkpkode ?></td>
                <td><?php echo $row->ppnama ?></td>
                <td><?php echo $row->agnama ?></td>
                <td><?php echo $row->pkptglawal ?></td>
                <td><?php echo $row->pkptglakhir ?></td>
                <td>
                  <div class="text-center">
                    <i class="fa fa-pencil-square" aria-hidden="true"></i>
                    <a onclick=show("<?php echo $row->pkpid ?>") data-toggle="modal" data-target="#modaltolak"><button class="btn btn-danger" type="button" name="button">Tolak</button></a>
                    <a id="confirmVerify" href=" <?php echo base_url() ?>Pkp/verifyPKP/<?php echo $row->pkpid ?>"><button class="btn btn-success" type="button" name="button">Setujui</button></a>
                  </div>
                </td>
              </tr>
              <?php
            endforeach;
            ?>
          </tbody>
        </table>
      </div>

    </div>
    <br />
  </div>
</div>
</div>

<body>
  <table id="example" class="display" width="100%" cellspacing="0">
    <thead>
      <tr>
        <th>order</th>
        <th>name</th>
        <th>country</th>
        <th>action</th>
      </tr>
    </thead>
  </table>


  <table id="newRow" style="display:none">
    <tbody>
      <tr>
        <td>
          <select id="selectbasic" name="selectbasic" class="form-control">
            <option value="1">option 1</option>
            <option value="2">option 2</option>
            <option value="2">option 3</option>
          </select>
        </td>
        <td>DVap
        </td>
        <td>
          www</td>
        <td><i class="fa fa-pencil-square" aria-hidden="true"></i>
          <i class="fa fa-minus-square" aria-hidden="true"></i> </td>
      </tr>
    </tbody>
  </table>


  <script>
    $(document).ready(function() {

      var table;

      $("#example").on('mousedown.edit', "i.fa.fa-pencil-square", function(e) {

        $(this).removeClass().addClass("fa fa-envelope-o");
        var $row = $(this).closest("tr").off("mousedown");
        var $tds = $row.find("td").not(':first').not(':last');

        $.each($tds, function(i, el) {
          var txt = $(this).text();
          $(this).html("").append("<input type='text' value=\""+txt+"\">");
        });

      });

      $("#example").on('mousedown', "input", function(e) {
        e.stopPropagation();
      });

      $("#example").on('mousedown.save', "i.fa.fa-envelope-o", function(e) {

        $(this).removeClass().addClass("fa fa-pencil-square");
        var $row = $(this).closest("tr");
        var $tds = $row.find("td").not(':first').not(':last');

        $.each($tds, function(i, el) {
          var txt = $(this).find("input").val()
          $(this).html(txt);
        });
      });


      table = $('#example').DataTable({
        rowReorder: {
          dataSrc: 'order',
          selector: 'tr'
        },
        columns: [{
          data: 'order'
        }, {
          data: 'place'
        }, {
          data: 'name'
        }, {
          data: 'delete'
        }]
      });

    });
  </script>
</body>


<div class="modal fade bs-example-modal-lg" id="modaltolak" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Tolak PKP</h4>
      </div>
      <div class="modal-body">
        <div class="x_content">
          <?php echo form_open(base_url('Pkp/rejectPkp/')) ?>
            <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Alasan Penolakan <span class="required">*</span></label>
                <div class="col-md-5 col-sm-5 col-xs-12">
                    <textarea name="alasan" class="form-control" rows="5" required></textarea>
                    <input type="hidden" id="hiddenidpkp" name="hiddenidpkp">
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
        <button type="submit" name="submit" class="btn btn-success">Submit</button>
      </div>
    </form>

    </div>
  </div>
</div>

<script>

$(document).ready(function () {
  $("#tbpkp").on('mousedown.edit', "i.fa.fa-pencil-square", function(e) {

    $(this).removeClass().addClass("fa fa-envelope-o");
    var $row = $(this).closest("tr").off("mousedown");
    var $tds = $row.find("td").not(':first').not(':last');

    $.each($tds, function(i, el) {
      var txt = $(this).text();
      $(this).html("").append("<input type='text' value=\""+txt+"\">");
    });

  });

  $("#tbpkp").on('mousedown', "input", function(e) {
    e.stopPropagation();
  });

  $("#tbpkp").on('mousedown.save', "i.fa.fa-envelope-o", function(e) {

    $(this).removeClass().addClass("fa fa-pencil-square");
    var $row = $(this).closest("tr");
    var $tds = $row.find("td").not(':first').not(':last');

    $.each($tds, function(i, el) {
      var txt = $(this).find("input").val()
      $(this).html(txt);
    });
  });

  table = $('#tbpkp').DataTable({
    rowReorder: {
      selector: 'tr'
    }
  });

  show = function(id)
  {
    $("#hiddenidpkp").val(id);
  }

  $("#confirmVerify").click(function(e){
    confirms = confirm('Apakah anda yakin ingin memverifikasi PKP ini?');
    if (!confirms)
    {
      e.preventDefault();
    }
  });

});

</script>
