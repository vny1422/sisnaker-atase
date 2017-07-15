
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
            <?php foreach($list as $row): ?>
              <tr data-agrid="<?php echo $row->agrid ?>" data-namacn="<?php echo $row->agrnamacn ?>" data-almtcn="<?php echo $row->agralmtkantorcn ?>" data-pngcn="<?php echo $row->agrpngjwbcn ?>" data-telp="<?php echo $row->agrtelp ?>" data-fax="<?php echo $row->agrfax ?>" data-file="<?php echo $row->filename ?>">
                <td class="email"><?php echo $row->agremail ?></td>
                <td class="nama"><?php echo $row->agrnama ?></td>
                <td class="cla"><?php echo $row->agrnoijincla ?></td>
                <td class="almt"><?php echo $row->agralmtkantor ?></td>
                <td class="pngjwb"><?php echo $row->agrpngjwb ?></td>
                <td class="status"><?php echo ($row->agrstatus === NULL ? "Waiting" : $row->agrstatus ) ?></td>
                <td>
                  <div class="center-button"><button class="btn btn-info togglebtn" type="button" data-toggle="modal" data-target=".bs-example-modal-lg">Lihat Data</button></div>
                </td>
              </tr>
            <?php endforeach; ?>

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
                                <div id="CLALetter" class="col-md-6 col-sm-6 col-xs-12">
                                  <button type="button" class="btn btn-default btn-sm">Download</button>
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
  function generateUserPass(agrid, cla) {
    var username = "user-" + agrid;
    var password = md5(cla);
    return {
      "username":username,
      "password":password
    }
  }

  $(document).ready(function () {
    var json = null;
    var agid = null;
    var userpass = null;

    $(".togglebtn").click(function() {
      $("#agensiRID").text($(this).closest("tr").data("agrid"));
      $("#companyEmail").text($(this).closest("tr").find("td.email").text());
      $("#agensiName").text($(this).closest("tr").find("td.nama").text());
      $("#otherAgensiName").text($(this).closest("tr").data("namacn"));
      $("#agensiNo").text($(this).closest("tr").find("td.cla").text());
      $("#officeAddress").text($(this).closest("tr").find("td.almt").text());
      $("#otherOfficeAddress").text($(this).closest("tr").data("almtcn"));
      $("#authorizedPerson").text($(this).closest("tr").find("td.pngjwb").text());
      $("#otherAuthorizedPerson").text($(this).closest("tr").data("pngcn"));
      $("#phone").text($(this).closest("tr").data("telp"));
      $("#fax").text($(this).closest("tr").data("fax"));
    });

    $("#btnSend").click( function(e) {
      e.preventDefault();
      
      $.post("<?php echo base_url()?>Agensi/cekCLA", {cla: $('#agensiNo').text()}, function(xml,status){
        agid = $.parseJSON(xml);
        if (agid == 0) {
          $.post("<?php echo base_url()?>Endorsement/insert_agency", {agrid: $('#agensiRID').text()}, function(xml,status){
            json = $.parseJSON(xml);

            alert(json.msg);
            if(json.status == 1) {
              userpass = generateUserPass($('#agensiRID').text(), $("#agensiNo").text());
              agid = json.agid;
            }
          });
        } else {
          alert("Registration successfullll.");
          userpass = generateUserPass($('#agensiRID').text(), $("#agensiNo").text());
        }
        
      $(".bs-example-modal-lg").modal('hide');
      window.location.reload();
      });
    });
  });
</script>
