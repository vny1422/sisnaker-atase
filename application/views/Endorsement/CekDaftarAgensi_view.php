
<!-- page content -->
<div class="right_col" role="main">

  <br />

    <div class="row">
    <div style="display:none;" id="loader"></div>
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
                <th>Company Email</th>
                <th>Agency Name</th>
                <th>C.L.A No</th>
                <th>Office Address</th>
                <th>Authorized Person</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            <?php
            $i=0;
            foreach($list as $row): ?>
              <tr>
                <td class="email"><?php echo $row->agremail ?></td>
                <td class="nama"><?php echo $row->agrnama ?></td>
                <td class="cla"><?php echo $row->agrnoijincla ?></td>
                <td class="almt"><?php echo $row->agralmtkantor ?></td>
                <td class="pngjwb"><?php echo $row->agrpngjwb ?></td>
                <td class="status"><?php echo ($row->agrstatus === NULL ? "Waiting" : $row->agrstatus ) ?></td>
                <td>
                  <div class="center-button"><button onclick='toggleBtn(<?php echo json_encode($row); ?>, "<?php echo $listnama[$i]->nameinstitution; ?>")' class="btn btn-info tglButton" type="button" data-toggle="modal" data-target="#modalreg">Lihat Data</button></div>
                </td>
              </tr>
            <?php
            $i=$i+1;
            endforeach; ?>

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

<div class="modal fade bs-example-modal-lg" id="modalreg" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Detail Data</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-3"></div>
          <div class="col-md-6">
            <div id="agensiRID" style="display: none;"></div>
            <div id="instID" style="display: none;"></div>

            <div class="form-group">
              <label class="control-label col-md-6 col-sm-6 col-xs-12">Institution</label>
              <div id="institution" class="col-md-6 col-sm-6 col-xs-12"></div>
            </div><br /><br />

            <div class="form-group">
              <label class="control-label col-md-6 col-sm-6 col-xs-12">Official Company Email</label>
              <div id="companyEmail" class="col-md-6 col-sm-6 col-xs-12"></div>
            </div><br /><br />

            <div class="form-group">
              <label class="control-label col-md-6 col-sm-6 col-xs-12">Agency Name</label>
              <div id="agensiName" class="col-md-6 col-sm-6 col-xs-12"></div>
            </div><br /><br />

            <div class="form-group">
              <label class="control-label col-md-6 col-sm-6 col-xs-12">Other Agency Name</label>
              <div id="otherAgensiName" class="col-md-6 col-sm-6 col-xs-12"></div>
            </div><br /><br />

            <div class="form-group">
              <label class="control-label col-md-6 col-sm-6 col-xs-12">Agency License No</label>
              <div id="agensiNo" class="col-md-6 col-sm-6 col-xs-12"></div>
            </div><br /><br />

            <div class="form-group">
              <label class="control-label col-md-6 col-sm-6 col-xs-12">Office Address</label>
              <div id="officeAddress" class="col-md-6 col-sm-6 col-xs-12"></div>
            </div><br /><br />

            <div class="form-group">
              <label class="control-label col-md-6 col-sm-6 col-xs-12">Other Office Address</label>
              <div id="otherOfficeAddress" class="col-md-6 col-sm-6 col-xs-12"></div>
            </div><br /><br />

            <div class="form-group">
              <label class="control-label col-md-6 col-sm-6 col-xs-12">Authorized Person Name</label>
              <div id="authorizedPerson" class="col-md-6 col-sm-6 col-xs-12"></div>
            </div><br /><br />

            <div class="form-group">
              <label class="control-label col-md-6 col-sm-6 col-xs-12">Other Authorized Person Name</label>
              <div id="otherAuthorizedPerson" class="col-md-6 col-sm-6 col-xs-12"></div>
            </div><br /><br />

            <div class="form-group">
              <label class="control-label col-md-6 col-sm-6 col-xs-12">Phone</label>
              <div id="phone" class="col-md-6 col-sm-6 col-xs-12"></div>
            </div><br /><br />

            <div class="form-group">
              <label class="control-label col-md-6 col-sm-6 col-xs-12">Faximile</label>
              <div id="fax" class="col-md-6 col-sm-6 col-xs-12"></div>
            </div><br /><br />

            <div class="form-group">
              <label class="control-label col-md-6 col-sm-6 col-xs-12">C.L.A Private Employment Service Agency License Letter</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <button type="button" class="btn btn-default btn-sm" id="btnDL">Download</button>
              </div>
            </div><br /><br />

          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success" id="btnSend">Accept</button>
      </div>

    </div>
  </div>
</div>

<div class="modal fade bs-example-modal-lg" id="modalagensi" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Pilih Agensi</h4>
      </div>
      <div class="modal-body">
        <div class="x_content">
          <br />
          <div class="row">
            <div class="col-lg-12">
              <!-- panel -->
              <div class="panel with-nav-tabs panel-info">
                <!-- panel heading -->
                <div class="panel-heading" id="tabs-head">
                  <ul class="nav nav-tabs" id="tabs-list">

                  </ul>
                </div>
                <!-- panel body -->
                <div class="panel-body">
                  <div class="tab-content" id="konten">

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="clearfix"></div>
      </div>
      <div class="modal-footer">
        <div>*Jika tidak ditemukan data agensi yang sama, silahkan memilih tombol <font color="red">Registrasi Agensi Baru</font></div>
        <div>**Pastikan anda berada di tab agensi yang akan dijadikan induk sebelum memilih tombol <font color="red">Pilih Sebagai Agensi Utama</font></div><br />
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-danger" id="btnTolak">Tolak Registrasi</button>
        <button type="button" class="btn btn-warning" id="btnKirim">Registrasi Agensi Baru</button>
        <button type="button" class="btn btn-success" id="btnConfirm">Pilih Sebagai Agensi Utama</button>
      </div>

    </div>
  </div>
</div>


<script type="text/javascript">

  $("#loader").hide();

  function generateUserPass(agnama, cla) {
    var userpass = agnama.substr(0, 4) + cla;
    var passmd5 = md5(userpass);
    return {
      "userpass":userpass,
      "md5":passmd5
    }
  }

  var filename = null;

  function toggleBtn(row, namainst) {
    $("#agensiRID").text(row.agrid);
    $("#instID").text(row.idinstitution);
    $("#institution").text(namainst);
    $("#companyEmail").text((row.agremail == null ? "" : row.agremail ));
    $("#agensiName").text((row.agrnama == null ? "" : row.agrnama ));
    $("#otherAgensiName").text((row.agrnamacn == null ? "" : row.agrnamacn ));
    $("#agensiNo").text(row.agrnoijincla);
    $("#officeAddress").text((row.agralmtkantor == null ? "" : row.agralmtkantor ));
    $("#otherOfficeAddress").text((row.agralmtkantorcn == null ? "" : row.agralmtkantorcn ));
    $("#authorizedPerson").text((row.agrpngjwb == null ? "" : row.agrpngjwb ));
    $("#otherAuthorizedPerson").text((row.agrpngjwbcn == null ? "" : row.agrpngjwbcn ));
    $("#phone").text((row.agrtelp == null ? "" : row.agrtelp ));
    $("#fax").text((row.agrfax == null ? "" : row.agrfax ));
    filename = (row.filename == null ? "" : row.filename );
  }

  $(document).ready(function () {
    var json = null;
    var agid = null;
    var userpass = null;
    var currentTR = null;
    var data = null;
    var result = null;
    var table = $('#datatable-responsive').DataTable({"bSort" : false});

    function insert_sisko(){
      $("#loader").show();
      $.post("<?php echo base_url()?>Endorsement/insert_agency", {agrid: $('#agensiRID').text(), idinst: $("#instID").text()}, function(xml,status){
        json = $.parseJSON(xml);

        if(json.status == 1) {
          userpass = generateUserPass($('#agensiName').text(), $("#agensiNo").text());
          agid = json.agid;
          $.post("<?php echo base_url()?>Agensi/updateMagensiUser", {user: userpass.userpass, pass: userpass.md5, agid: agid, agnama: $('#agensiName').text(),email: $('#companyEmail').text(), idinst: $("#instID").text()}, function(xml,status){
            data[5] = 'A';
            table.row(currentTR).data(data).draw();
            $("#loader").hide();
            alert(json.msg);
          });
        } else {
          data[5] = 'D';
          table.row(currentTR).data(data).draw();
          $("#loader").hide();
          alert(json.msg);
        }
      });
    }

    function merge_agensi(induk, kembar){
      $.post("<?php echo base_url()?>Agensi/mergeAgensi", {induk: induk, kembar: kembar}, function(xml,status){
        json = $.parseJSON(xml);
      });
    }

    $('body').on('click', '.tglButton', function () {
         currentTR = $(this).closest('tr');
         data = table.row(currentTR).data();
     });

    $("#btnDL").click( function(e) {
      e.preventDefault();
      if(filename != "") {
        window.open("<?php echo base_url("uploadsregister/")?>" + filename, "_blank");
      }
    });

    $("#btnTolak").click( function(e) {
      e.preventDefault();
      $.post("<?php echo base_url()?>Agensi/updateStatusRegistrasi", {agrid: $('#agensiRID').text(), status: 'D'});
      data[5] = 'D';
      table.row(currentTR).data(data).draw();
      $("#modalagensi").modal('hide');
    });

    $("#btnKirim").click( function(e) {
      e.preventDefault();
      insert_sisko();
      $("#modalagensi").modal('hide');
    });

    $("#btnConfirm").click( function(e) {
      e.preventDefault();
      var tab = $('.tab-content .active').attr('id');
      var id = tab.substring(3);
      var idkembar = $("#konten input:checkbox:checked").map(function(){
        return $(this).val();
      }).get();

      if(id == 0) {
        alert("Silahkan pilih agensi utama pada tab agensi yang bersangkutan.");
      } else {
        var index = idkembar.indexOf(result[id-1].agid);
        if(index != -1) {
          idkembar.splice(index, 1);
        }
        if(idkembar.length > 0) {
          merge_agensi(result[id-1].agid, idkembar);
        }

        var dataAgensi = {
          idinstitution:$("#instID").text(),
          agnama:$('#agensiName').text(),
          agnamaoth:$('#otherAgensiName').text(),
          agnoijincla:$("#agensiNo").text(),
          agalmtkantor:$("#officeAddress").text(),
          agalmtkantoroth:$("#otherOfficeAddress").text(),
          agpngjwb:$("#authorizedPerson").text(),
          agpngjwboth:$("#otherAuthorizedPerson").text(),
          agtelp:$("#phone").text(),
          agfax:$("#fax").text(),
          agemail:$("#companyEmail").text()
        };
        userpass = generateUserPass($('#agensiName').text(), $("#agensiNo").text());
        $("#loader").show();
        $.post("<?php echo base_url()?>Agensi/updateMagensiUser", {user: userpass.userpass, pass: userpass.md5, agid: result[id-1].agid, agnama: $('#agensiName').text(),email: $('#companyEmail').text(), idinst: $("#instID").text(), dataagensi: dataAgensi}, function(xml,status){
          $.post("<?php echo base_url()?>Agensi/updateStatusRegistrasi", {agrid: $('#agensiRID').text(), status: 'A', agid: result[id-1].agid});
          data[5] = 'A';
          table.row(currentTR).data(data).draw();
          $("#loader").hide();
          alert("Registration successful.");
        });
        $("#modalagensi").modal('hide');
      }
    });

    $("#btnSend").click( function(e) {
      e.preventDefault();

      $.post("<?php echo base_url()?>Agensi/cekAgensi", {cla: $('#agensiNo').text(), agnama: $("#agensiName").text()}, function(xml,status){
        result = $.parseJSON(xml);
        
        if(result != 0) {
          $("#tabs-list").empty();
          $("#konten").empty();          
          for(i = 0; i <= result.length; i++) {
            if(i == 0) {
              $("#tabs-list").append("<li class=\"active\"><a href=#tab" + i + " data-toggle=\"tab\"><strong>Data Registrasi</strong></a></li>");
              $("#konten").append("<div class=\"tab-pane fade in active\" id=\"tab" + i +"\">" +
                  "<div class=\"panel-body\">" +
                    "<div class=\"tab-content\">" +
                      "<div class=\"col-md-12 left-margin\">" +
                        "<div class=\"form-group\">" +
                        "<label class=\"control-label col-md-6 col-sm-6 col-xs-12\">Institution</label>" +
                          "<div class=\"col-md-6 col-sm-6 col-xs-12\">" + $("#institution").text() + "</div>" +
                        "</div><br /><br />" +
                        "<div class=\"form-group\">" +
                        "<label class=\"control-label col-md-6 col-sm-6 col-xs-12\">Official Company Email</label>" +
                          "<div class=\"col-md-6 col-sm-6 col-xs-12\">" + $("#companyEmail").text() + "</div>" +
                        "</div><br /><br />" +
                        "<div class=\"form-group\">" +
                        "<label class=\"control-label col-md-6 col-sm-6 col-xs-12\">Agency Name</label>" +
                          "<div class=\"col-md-6 col-sm-6 col-xs-12\">" + $("#agensiName").text() + "</div>" +
                        "</div><br /><br />" +
                        "<div class=\"form-group\">" +
                        "<label class=\"control-label col-md-6 col-sm-6 col-xs-12\">Other Agency Name</label>" +
                          "<div class=\"col-md-6 col-sm-6 col-xs-12\">" + $("#otherAgensiName").text() + "</div>" +
                        "</div><br /><br />" +
                        "<div class=\"form-group\">" +
                        "<label class=\"control-label col-md-6 col-sm-6 col-xs-12\">Agency License No</label>" +
                          "<div class=\"col-md-6 col-sm-6 col-xs-12\">" + $("#agensiNo").text() + "</div>" +
                        "</div><br /><br />" +
                        "<div class=\"form-group\">" +
                        "<label class=\"control-label col-md-6 col-sm-6 col-xs-12\">Office Address</label>" +
                          "<div class=\"col-md-6 col-sm-6 col-xs-12\">" + $("#officeAddress").text() + "</div>" +
                        "</div><br /><br />" +
                        "<div class=\"form-group\">" +
                        "<label class=\"control-label col-md-6 col-sm-6 col-xs-12\">Other Office Address</label>" +
                          "<div class=\"col-md-6 col-sm-6 col-xs-12\">" + $("#otherOfficeAddress").text() + "</div>" +
                        "</div><br /><br />" +
                        "<div class=\"form-group\">" +
                        "<label class=\"control-label col-md-6 col-sm-6 col-xs-12\">Authorized Person Name</label>" +
                          "<div class=\"col-md-6 col-sm-6 col-xs-12\">" + $("#authorizedPerson").text() + "</div>" +
                        "</div><br /><br />" +
                        "<div class=\"form-group\">" +
                        "<label class=\"control-label col-md-6 col-sm-6 col-xs-12\">Other Authorized Person Name</label>" +
                          "<div class=\"col-md-6 col-sm-6 col-xs-12\">" + $("#otherAuthorizedPerson").text() + "</div>" +
                        "</div><br /><br />" +
                        "<div class=\"form-group\">" +
                        "<label class=\"control-label col-md-6 col-sm-6 col-xs-12\">Phone</label>" +
                          "<div class=\"col-md-6 col-sm-6 col-xs-12\">" + $("#phone").text() + "</div>" +
                        "</div><br /><br />" +
                        "<div class=\"form-group\">" +
                        "<label class=\"control-label col-md-6 col-sm-6 col-xs-12\">Faximile</label>" +
                          "<div class=\"col-md-6 col-sm-6 col-xs-12\">" + $("#fax").text() + "</div>" +
                        "</div><br />" +
                  "</div></div></div></div>");
            } else {
              $("#tabs-list").append("<li><a href=#tab" + i + " data-toggle=\"tab\"><strong>Versi " + i + "</strong></a></li>");
              $("#konten").append("<div class=\"tab-pane fade in\" id=\"tab" + i +"\">" +
                  "<div class=\"panel-body\">" +
                    "<div class=\"tab-content\">" +
                      "<div class=\"col-md-12 left-margin\">" +
                        "<div class=\"form-group\">" +
                        "<label class=\"control-label col-md-6 col-sm-6 col-xs-12\">Username</label>" +
                          "<div class=\"col-md-6 col-sm-6 col-xs-12\">" + (result[i-1].username == null ? "" : result[i-1].username) + "</div>" +
                        "</div><br /><br />" +
                        "<div class=\"form-group\">" +
                        "<label class=\"control-label col-md-6 col-sm-6 col-xs-12\">Institution</label>" +
                          "<div class=\"col-md-6 col-sm-6 col-xs-12\">" + result[i-1].namainst + "</div>" +
                        "</div><br /><br />" +
                        "<div class=\"form-group\">" +
                        "<label class=\"control-label col-md-6 col-sm-6 col-xs-12\">Official Company Email</label>" +
                          "<div class=\"col-md-6 col-sm-6 col-xs-12\">" + (result[i-1].agemail == null ? "" : result[i-1].agemail) + "</div>" +
                        "</div><br /><br />" +
                        "<div class=\"form-group\">" +
                        "<label class=\"control-label col-md-6 col-sm-6 col-xs-12\">Agency Name</label>" +
                          "<div class=\"col-md-6 col-sm-6 col-xs-12\">" + (result[i-1].agnama == null ? "" : result[i-1].agnama) + "</div>" +
                        "</div><br /><br />" +
                        "<div class=\"form-group\">" +
                        "<label class=\"control-label col-md-6 col-sm-6 col-xs-12\">Other Agency Name</label>" +
                          "<div class=\"col-md-6 col-sm-6 col-xs-12\">" + (result[i-1].agnamaoth == null ? "" : result[i-1].agnamaoth) + "</div>" +
                        "</div><br /><br />" +
                        "<div class=\"form-group\">" +
                        "<label class=\"control-label col-md-6 col-sm-6 col-xs-12\">Agency License No</label>" +
                          "<div class=\"col-md-6 col-sm-6 col-xs-12\">" + result[i-1].agnoijincla + "</div>" +
                        "</div><br /><br />" +
                        "<div class=\"form-group\">" +
                        "<label class=\"control-label col-md-6 col-sm-6 col-xs-12\">Office Address</label>" +
                          "<div class=\"col-md-6 col-sm-6 col-xs-12\">" + (result[i-1].agalmtkantor == null ? "" : result[i-1].agalmtkantor) + "</div>" +
                        "</div><br /><br />" +
                        "<div class=\"form-group\">" +
                        "<label class=\"control-label col-md-6 col-sm-6 col-xs-12\">Other Office Address</label>" +
                          "<div class=\"col-md-6 col-sm-6 col-xs-12\">" + (result[i-1].agalmtkantoroth == null ? "" : result[i-1].agalmtkantoroth) + "</div>" +
                        "</div><br /><br />" +
                        "<div class=\"form-group\">" +
                        "<label class=\"control-label col-md-6 col-sm-6 col-xs-12\">Authorized Person Name</label>" +
                          "<div class=\"col-md-6 col-sm-6 col-xs-12\">" + (result[i-1].agpngjwb == null ? "" : result[i-1].agpngjwb) + "</div>" +
                        "</div><br /><br />" +
                        "<div class=\"form-group\">" +
                        "<label class=\"control-label col-md-6 col-sm-6 col-xs-12\">Other Authorized Person Name</label>" +
                          "<div class=\"col-md-6 col-sm-6 col-xs-12\">" + (result[i-1].agpngjwboth == null ? "" : result[i-1].agpngjwboth) + "</div>" +
                        "</div><br /><br />" +
                        "<div class=\"form-group\">" +
                        "<label class=\"control-label col-md-6 col-sm-6 col-xs-12\">Phone</label>" +
                          "<div class=\"col-md-6 col-sm-6 col-xs-12\">" + (result[i-1].agtelp == null ? "" : result[i-1].agtelp) + "</div>" +
                        "</div><br /><br />" +
                        "<div class=\"form-group\">" +
                        "<label class=\"control-label col-md-6 col-sm-6 col-xs-12\">Faximile</label>" +
                          "<div class=\"col-md-6 col-sm-6 col-xs-12\">" + (result[i-1].agfax == null ? "" : result[i-1].agfax) + "</div>" +
                        "</div><br /><br />" +
                        "<div class=\"form-group\">" +
                        "<label class=\"control-label col-md-6 col-sm-6 col-xs-12\">Pilih sebagai data pendukung</label>" +
                          "<div class=\"col-md-6 col-sm-6 col-xs-12\"><input type=\"checkbox\" value=\"" + result[i-1].agid + "\"></div>" +
                        "</div><br />" +
                  "</div></div></div></div>");
            }
          }
          $("#modalagensi").modal('show');
        }
        else {
          insert_sisko();
        }
      $("#modalreg").modal('hide');
      });
    });
  });
</script>
