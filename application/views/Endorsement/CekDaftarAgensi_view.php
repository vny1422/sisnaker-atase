
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
            <?php //foreach($listcekal as $row): ?>
              <tr>
                <td><?php //echo $row->agnama ?> agensisayabundar@agensi.com</td>
                <td><?php //echo $row->castart ?> Agensi Topi Bundar</td>
                <td><?php //echo $row->caend ?> 098135478</td>
                <td><?php //echo $row->cacatatan ?>Bundaran ITS</td>
                <td><?php //echo $row->enable ?>Romelo Lukaku</td>
                <td>Waiting</td>
                <td>
                  <div class="center-button"><button class="btn btn-info" type="button" name="button" data-toggle="modal" data-target=".bs-example-modal-lg">Lihat Data</button></div>
                </td>
              </tr>
            <?php //endforeach; ?>
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
                              <div class="form-group">
                                <label class="control-label col-md-6 col-sm-6 col-xs-12">Official Company Email</label>
                                <div id="companyEmail" class="col-md-6 col-sm-6 col-xs-12">agensi@agensi.co.id</div>
                              </div><br /><br />

                              <div class="form-group">
                                <label class="control-label col-md-6 col-sm-6 col-xs-12">Agency Name</label>
                                <div id="agensiName" class="col-md-6 col-sm-6 col-xs-12">agensi@agensi.co.id</div>
                              </div><br /><br />

                              <div class="form-group">
                                <label class="control-label col-md-6 col-sm-6 col-xs-12">Other Agency Name</label>
                                <div id="otherAgensiName" class="col-md-6 col-sm-6 col-xs-12">agensi@agensi.co.id</div>
                              </div><br /><br />

                              <div class="form-group">
                                <label class="control-label col-md-6 col-sm-6 col-xs-12">Agency License No</label>
                                <div id="agensiNo" class="col-md-6 col-sm-6 col-xs-12">agensi@agensi.co.id</div>
                              </div><br /><br />

                              <div class="form-group">
                                <label class="control-label col-md-6 col-sm-6 col-xs-12">Office Address</label>
                                <div id="officeAddress" class="col-md-6 col-sm-6 col-xs-12">agensi@agensi.co.id</div>
                              </div><br /><br />

                              <div class="form-group">
                                <label class="control-label col-md-6 col-sm-6 col-xs-12">Other Office Address</label>
                                <div id="otherOfficeAddress" class="col-md-6 col-sm-6 col-xs-12">agensi@agensi.co.id</div>
                              </div><br /><br />

                              <div class="form-group">
                                <label class="control-label col-md-6 col-sm-6 col-xs-12">Authorized Person Name</label>
                                <div id="authorizedPerson" class="col-md-6 col-sm-6 col-xs-12">agensi@agensi.co.id</div>
                              </div><br /><br />

                              <div class="form-group">
                                <label class="control-label col-md-6 col-sm-6 col-xs-12">Other Authorized Person Name</label>
                                <div id="otherAuthorizedPerson" class="col-md-6 col-sm-6 col-xs-12">agensi@agensi.co.id</div>
                              </div><br /><br />

                              <div class="form-group">
                                <label class="control-label col-md-6 col-sm-6 col-xs-12">Phone</label>
                                <div id="phone" class="col-md-6 col-sm-6 col-xs-12">agensi@agensi.co.id</div>
                              </div><br /><br />

                              <div class="form-group">
                                <label class="control-label col-md-6 col-sm-6 col-xs-12">Faximile</label>
                                <div id="fax" class="col-md-6 col-sm-6 col-xs-12">agensi@agensi.co.id</div>
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
                          <button type="button" class="btn btn-success">Accept</button>
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
  $( "#agensi" ).autocomplete({
    source: function(request, response) {
      $.post('<?php echo base_url();?>/Paket/ambilnamaagensi/', { term:request.term}, function(json) {
        response( $.map( json.rows, function( item ) {
          return {
            label: item.agnama,
            id: item.agid
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
