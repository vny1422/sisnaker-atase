
<!-- page content -->
<div class="right_col" role="main">

  <br />

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
                  <div class="center-button"><button onclick='toggleBtn(<?php echo json_encode($row); ?>, "<?php echo $listnama[$i]->nameinstitution; ?>")' class="btn btn-info tglButton" type="button" data-toggle="modal" data-target=".bs-example-modal-lg">Lihat Data</button></div>
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

<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
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


<script type="text/javascript">
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
    var table = $('#datatable-responsive').DataTable({"bSort" : false});

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

    $("#btnSend").click( function(e) {
      e.preventDefault();

      $.post("<?php echo base_url()?>Agensi/cekCLA", {cla: $('#agensiNo').text()}, function(xml,status){
        var result = $.parseJSON(xml);
        agid = result.agid;

        if (result.regist == 0) {
          $.post("<?php echo base_url()?>Endorsement/insert_agency", {agrid: $('#agensiRID').text(), idinst: $("#instID").text()}, function(xml,status){
            json = $.parseJSON(xml);

            alert(json.msg);
            if(json.status == 1) {
              data[5] = 'A';
              userpass = generateUserPass($('#agensiName').text(), $("#agensiNo").text());
              agid = json.agid;
              $.post("<?php echo base_url()?>Agensi/updateMagensiUser", {user: userpass.userpass, pass: userpass.md5, agid: agid, agnama: $('#agensiName').text(),email: $('#companyEmail').text(), idinst: $("#instID").text()});
            } else {
              data[5] = 'D';
            }
            table.row(currentTR).data(data).draw();
          });
        } else if (result.regist == 1){
          alert("You already registered.");
          $.post("<?php echo base_url()?>Agensi/updateStatusRegistrasi", {agrid: $('#agensiRID').text(), agid: agid, status: 'D'});
          data[5] = 'D';
          table.row(currentTR).data(data).draw();
        } else {
          alert("Registration successful.");
          $.post("<?php echo base_url()?>Agensi/updateStatusRegistrasi", {agrid: $('#agensiRID').text(), agid: agid, status: 'A'});
          data[5] = 'A';
          table.row(currentTR).data(data).draw();
          userpass = generateUserPass($('#agensiName').text(), $("#agensiNo").text());
          $.post("<?php echo base_url()?>Agensi/updateMagensiUser", {user: userpass.userpass, pass: userpass.md5, agid: agid, agnama: $('#agensiName').text(),email: $('#companyEmail').text(), idinst: $("#instID").text()});
        }

      $(".bs-example-modal-lg").modal('hide');
      });
    });
  });
</script>
