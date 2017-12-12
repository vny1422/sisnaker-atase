
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
                <th>Edit</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody id="pkplist">
              <?php
              foreach($listpkp as $row): ?>
              <tr>
                <td class="text-center"><a onclick=showDetail("<?php echo $row->pkpkode ?>") data-toggle="modal" data-target="#modaldetail"><?php echo $row->pkpkode ?></a></td>
                <td><?php echo $row->ppnama ?></td>
                <td><?php echo $row->agnama ?></td>
                <td><?php echo $row->pkptglawal ?></td>
                <td><?php echo $row->pkptglakhir ?></td>
                <td>
                  <div class="text-center">
                    <i class="fa fa-pencil-square fa-2x" aria-hidden="true"></i>
                  </div>
                </td>
                <td>
                  <div class="text-center">
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

<!-- <body>
<table id="example" class="display" width="100%" cellspacing="0">
<thead>
<tr>
<th>order</th>
<th>name</th>
<th>country</th>
<th>action</th>
</tr>
</thead>
</table> -->


<!-- <table id="newRow" style="display:none">
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
</table> -->


<!-- <script>
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
var $tds = $row.find("td").not(':eq(1)').not(':last');

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
</body> -->


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

<div class="modal fade bs-example-modal-lg" id="modaldetail" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">DETAIL PKP</h4>
      </div>
      <div class="modal-body">
        <div class="x_content checked" style="display: " >
          <div class="row" style="padding-top: 20px">
            <div class="col-md-12">
              <div class="col-md-2">
                <label id="coba" class="control-label" >Agensi:</label>
              </div>
              <div class="col-md-10">
                <p id="pkpag"></p>
              </div>
            </div>
            <div class="col-md-12">
              <div class="col-md-2">
                <label class="control-label" >PPTKIS:</label>
              </div>
              <div class="col-md-10">
                <p id="pkptkis"></p>
              </div>
            </div>
            <div class="col-md-12">
              <div class="col-md-2">
                <label class="control-label" >Tanggal Mulai:</label>
              </div>
              <div class="col-md-10">
                <p id="pkpawal"></p>
              </div>
            </div>
            <div class="col-md-12">
              <div class="col-md-2">
                <label class="control-label" >Tanggal Akhir:</label>
              </div>
              <div class="col-md-10">
                <p id="pkpakhir"></p>
              </div>
            </div>
          </div>
          <hr/>
          <table id="tbpkpd" class="table table-striped table-bordered dt-responsive" cellspacing="0" width="100%">
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
            <tbody id="pkpdlist">
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

  var tableDetail = $('#tbpkpd').DataTable({
    responsive: true,
    "columnDefs": [
{
    "targets": [ 0 ],
    "visible": false
}
]
  });
  var wrapper_detail =('#pkpdlist');

  $("#tbpkpd").on("mousedown.edit", "i.fa.fa-pencil-square", function(e) {
    $(this).removeClass().addClass("fa fa-envelope-o fa-lg");
    $row = $(this).closest("tr").off("mousedown");
    tds = $row.find("td").not(':first').not(':last');

    $.each(tds, function(i, el) {
      var txt = $(this).text();
      $(this).html("").append("<input type='text' value=\""+txt+"\">");
    });
  });

  $("#tbpkpd").on('mousedown.save', "i.fa.fa-envelope-o", function(e) {

    $(this).removeClass().addClass("fa fa-pencil-square fa-2x");
    idpkpd = tableDetail.row($(this).closest('tr')).data()[0];
    $row = $(this).closest("tr").off("mousedown");
    tds = $row.find("td").not(':first').not(':last');
    postData = []
    $.each(tds, function(i, el) {
      var txt = $(this).find("input").val();
      postData.push(txt);
      $(this).html(txt);
    });
    $.post(" <?php echo base_url(); ?>PKP/editPKPd", {id: idpkpd, laki: postData[0], perempuan: postData[1], campuran: postData[2]}, function(data, status){
      var listinput = $.parseJSON(data);
    });
  });

  $("#tbpkp").on('mousedown.edit', "i.fa.fa-pencil-square", function(e) {
    $(this).removeClass().addClass("fa fa-envelope-o fa-lg");
    $row = $(this).closest("tr").off("mousedown");
    // var $tds = $row.find("td").not(':first').not(':last');
    $td1 = $row.find("td").eq(3);
    $td2 = $row.find("td").eq(4);
    var tds = [$td1, $td2];
    $.each(tds, function(i, el) {
      var txt = $(this).text();
      $(this).html("").append("<input type='text' value=\""+txt+"\">");
    });

  });

  $("#tbpkp").on('mousedown.save', "i.fa.fa-envelope-o", function(e) {

    $(this).removeClass().addClass("fa fa-pencil-square fa-2x");
    $row = $(this).closest("tr").off("mousedown");
    // var $tds = $row.find("td").not(':first').not(':last');
    $td1 = $row.find("td").eq(3);
    $td2 = $row.find("td").eq(4);
    bc = $row.find("td").eq(0).text();
    tds = [$td1, $td2];
    postData = []
    $.each(tds, function(i, el) {
      var txt = $(this).find("input").val();
      postData.push(txt);
      $(this).html(txt);
    });
    $.post(" <?php echo base_url(); ?>PKP/editPKP", {pkpbc: bc, tglawal: postData[0], tglakhir: postData[1]}, function(data, status){
      var listinput = $.parseJSON(data);
    });
  });

  table = $('#tbpkp').DataTable();

  show = function(id)
  {
    $("#hiddenidpkp").val(id);
  }

  showDetail = function (bc)
  {
    //alert(bc);
    $.post(" <?php echo base_url() ?>PKP/getDataFromBarcode", {barcode:bc}, function(data, status){
      var obj = $.parseJSON(data);
      if(obj.length > 0) {
        $("#pkpag").text(obj[0].agnama);
        $("#pkptkis").text(obj[0].ppnama);
        $("#pkpawal").text(obj[0].pkptglawal);
        $("#pkpakhir").text(obj[0].pkptglakhir);
          tableDetail.clear();
          $(wrapper_detail).empty();
          for (var key in obj) {
            if (obj.hasOwnProperty(key)) {
              tableDetail.row.add( [
                obj[key]["pkpdid"],
                obj[key]["namajenispekerjaan"],
                obj[key]["pkpdl"],
                obj[key]["pkpdp"],
                obj[key]["pkpdc"],
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
    confirms = confirm('Apakah anda yakin ingin memverifikasi PKP ini?');
    if (!confirms)
    {
      e.preventDefault();
    }
  });

});

</script>
