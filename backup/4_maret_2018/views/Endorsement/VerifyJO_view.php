
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
            <div class="alert alert-success fade in">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Notification: </strong> '.$this->session->flashdata('information').'
            </div>
            </div>' ?>
          <?php endif; ?>
          <table id="tbjo" class="table table-condensed table-striped table-bordered dt-responsive" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>JO Code</th>
                <th>PKP Code</th>
                <th>PPTKIS</th>
                <th>Agency</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Edit</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody id="jolist">
              <?php
              foreach($listjo as $row): ?>
              <tr>
                <td class="text-center"><a onclick=showDetail("<?php echo $row->jokode ?>") data-toggle="modal" data-target="#modaldetail"><?php echo $row->jokode ?></a></td>
                <td><?php echo $row->pkpkode ?></td>
                <td><?php echo $row->ppnama ?></td>
                <td><?php echo $row->agnama ?></td>
                <td><?php echo $row->jobtglawal ?></td>
                <td><?php echo $row->jobtglakhir ?></td>
                <td>
                  <div class="text-center">
                    <i class="fa fa-pencil-square fa-2x" aria-hidden="true"></i>
                  </div>
                </td>
                <td>
                  <div class="text-center">
                    <a onclick=show("<?php echo $row->jokode ?>") data-toggle="modal" data-target="#modaltolak"><button class="btn btn-sm btn-danger" type="button" name="button">Reject</button></a>
                    <a id="confirmVerify" href=" <?php echo base_url() ?>JO/verifyJO/<?php echo $row->jokode ?>"><button class="btn btn-sm btn-success" type="button" name="button">Approve</button></a>
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

<div class="modal fade bs-example-modal-lg" id="modaltolak" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Tolak JO</h4>
      </div>
      <div class="modal-body">
        <div class="x_content">
          <?php echo form_open(base_url('JO/rejectJO/')) ?>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-2 col-xs-12" for="name">Alasan Penolakan <span class="required">*</span></label>
            <div class="col-md-9 col-sm-5 col-xs-12">
              <textarea name="alasan" class="form-control" rows="5" required></textarea>
              <input type="hidden" id="hiddenjokode" name="hiddenjokode">
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

<div class="modal fade bs-example-modal-lg" id="modaldetail" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">DETAIL JO</h4>
      </div>
      <div class="modal-body">
        <div class="x_content checked" style="display: " >
          <div class="row" style="padding-top: 20px">
            <div class="col-md-12">
              <div class="col-md-2">
                <label id="coba" class="control-label" >Agensi:</label>
              </div>
              <div class="col-md-10">
                <p id="joag"></p>
              </div>
            </div>
            <div class="col-md-12">
              <div class="col-md-2">
                <label class="control-label" >PPTKIS:</label>
              </div>
              <div class="col-md-10">
                <p id="jotkis"></p>
              </div>
            </div>
            <div class="col-md-12">
              <div class="col-md-2">
                <label class="control-label" >Kode PKP:</label>
              </div>
              <div class="col-md-10">
                <p id="jopkpkode"></p>
              </div>
            </div>
            <div class="col-md-12">
              <div class="col-md-2">
                <label class="control-label" >Tanggal Mulai:</label>
              </div>
              <div class="col-md-10">
                <p id="joawal"></p>
              </div>
            </div>
            <div class="col-md-12">
              <div class="col-md-2">
                <label class="control-label" >Tanggal Akhir:</label>
              </div>
              <div class="col-md-10">
                <p id="joakhir"></p>
              </div>
            </div>
          </div>
          <hr/>
          <table id="tbjod" class="table table-striped table-bordered dt-responsive" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>ID</th>
                <th>Jenis Pekerjaan</th>
                <th>Laki-Laki</th>
                <th>Perempuan</th>
                <th>Campuran</th>
                <th>Edit</th>
              </tr>
            </thead>
            <tbody id="jodlist">
            </tbody>
          </table>
          <div class="clearfix">
          </div>

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<script>

$(document).ready(function () {

  var tableDetail = $('#tbjod').DataTable({
    responsive: true,
    "columnDefs": [
      {
        "targets": [ 0 ],
        "visible": false
      }
    ]
  });
  var wrapper_detail =('#jodlist');

  $("#tbjod").on("mousedown.edit", "i.fa.fa-pencil-square", function(e) {
    $(this).removeClass().addClass("fa fa-envelope-o fa-lg");
    $row = $(this).closest("tr").off("mousedown");
    tds = $row.find("td").not(':first').not(':last');

    $.each(tds, function(i, el) {
      var txt = $(this).text();
      $(this).html("").append("<input type='text' value=\""+txt+"\">");
    });
  });

  $("#tbjod").on('mousedown.save', "i.fa.fa-envelope-o", function(e) {

    $(this).removeClass().addClass("fa fa-pencil-square fa-2x");
    idjod = tableDetail.row($(this).closest('tr')).data()[0];
    $row = $(this).closest("tr").off("mousedown");
    tds = $row.find("td").not(':first').not(':last');
    postData = []
    $.each(tds, function(i, el) {
      var txt = $(this).find("input").val();
      postData.push(txt);
      $(this).html(txt);
    });
    $.post(" <?php echo base_url(); ?>JO/editJOd", {id: idjod, laki: postData[0], perempuan: postData[1], campuran: postData[2]}, function(data, status){
      var listinput = $.parseJSON(data);
    });
  });

  $("#tbjo").on('mousedown.edit', "i.fa.fa-pencil-square", function(e) {
    $(this).removeClass().addClass("fa fa-envelope-o fa-lg");
    $row = $(this).closest("tr").off("mousedown");
    // var $tds = $row.find("td").not(':first').not(':last');
    $td1 = $row.find("td").eq(4);
    $td2 = $row.find("td").eq(5);
    var tds = [$td1, $td2];
    $.each(tds, function(i, el) {
      var txt = $(this).text();
      $(this).html("").append("<input data-provide='datepicker' type='text' value=\""+txt+"\">");
    });

  });

  $("#tbjo").on('mousedown.save', "i.fa.fa-envelope-o", function(e) {

    $(this).removeClass().addClass("fa fa-pencil-square fa-2x");
    $row = $(this).closest("tr").off("mousedown");
    // var $tds = $row.find("td").not(':first').not(':last');
    $td1 = $row.find("td").eq(4);
    $td2 = $row.find("td").eq(5);
    bc = $row.find("td").eq(0).text();
    tds = [$td1, $td2];
    postData = []
    $.each(tds, function(i, el) {
      var txt = $(this).find("input").val();
      postData.push(txt);
      $(this).html(txt);
    });
    $.post(" <?php echo base_url(); ?>JO/editJO", {jokode: bc, tglawal: postData[0], tglakhir: postData[1]}, function(data, status){
      var listinput = $.parseJSON(data);
    });
  });

  table = $('#tbjo').DataTable();

  show = function(jokode)
  {
    $("#hiddenjokode").val(jokode);
  }

  showDetail = function (bc)
  {
    //alert(bc);
    $.post(" <?php echo base_url() ?>JO/getDataFromBarcode", {jokode:bc}, function(data, status){
      var obj = $.parseJSON(data);
      if(obj.length > 0) {
        $("#joag").text(obj[0].agnama);
        $("#jotkis").text(obj[0].ppnama);
        $("#jopkpkode").text(obj[0].pkpkode);
        $("#joawal").text(obj[0].jobtglawal);
        $("#joakhir").text(obj[0].jobtglakhir);
        tableDetail.clear();
        $(wrapper_detail).empty();
        for (var key in obj) {
          if (obj.hasOwnProperty(key)) {
            tableDetail.row.add( [
              obj[key]["jobdid"],
              obj[key]["namajenispekerjaan"],
              obj[key]["jobdl"],
              obj[key]["jobdp"],
              obj[key]["jobdc"],
              '<td>\
              <div class="text-center">\
              <i class="fa fa-pencil-square fa-2x" aria-hidden="true"></i>\
              </div>\
              </td>'
            ] ).draw();
          }
        }
        $(".checked").show();
      } else {
        alert('Barcode tidak valid!');
      }

    });
  }

  $("#confirmVerify").click(function(e){
    confirms = confirm('Apakah anda yakin ingin memverifikasi JO ini?');
    if (!confirms)
    {
      e.preventDefault();
    }
  });

});

</script>
