<div class="right_col" role="main">

    <div class="row">
    </div>
    <br />

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2><strong><?php echo $subtitle; ?></strong></h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </ul>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <br />
              <div class="row" style="padding-top: 20px">
                      <div class="col-xs-12">
                        <div class="panel panel-default">
                          <div class="panel-body">
                            <!-- form -->
                            <div class="col-xs-12">
                              <form class="form-horizontal" method="post" id="thisform">
                                <div class="form-group">
                                  <label class="col-sm-1 control-label">Nama</label>
                                  <div class="col-sm-4">
                                    <input type="text" class="form-control" name="nama" placeholder="ex: $dian → diawali 'dian'">
                                  </div>
                                  <label class="col-sm-1 control-label">No. Paspor</label>
                                  <div class="col-sm-3">
                                    <input type="text" class="form-control" name="paspor">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-1 control-label">Asal</label>
                                  <div class="col-sm-4">
                                    <input type="text" class="form-control" name="asal">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-1 control-label">Wilayah Kerja</label>
                                  <div class="col-sm-4">
                                    <input type="text" class="form-control" name="wilayahkerja" placeholder="">
                                  </div>
                                  <label class="col-sm-1 control-label">Pekerjaan</label>
                                  <div class="col-sm-3">
                                    <input type="text" class="form-control" name="kerja">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <button type="submit" class="btn btn-primary col-sm-1 col-sm-offset-2"><i class="fa fa-search-plus"></i> Cari</button>
                                </div>
                              </form>
                            </div>
            <div class="ln_solid"></div>

        </form>
      </div>
    </div>


    <div class="row">
<div class="col-xs-12">
  <div class="panel with-nav-tabs panel-info">
    <div class="panel-heading" id="tabs-head">
      <ul class="nav nav-tabs" id="tabs-list">
        <li class="active"><a href=#tbendorse data-toggle="tab"><strong>Endorsement</strong></a>
        </li>
      </ul>
    </div>
    <div class="panel-body" >
      <div class="tab-content">
        <!-- tb user -->
        <div class="tab-pane fade in active" id="tbendorse">
          <div class="col-xs-12" >
            <table id="dtable" class="table table-striped table-bordered table-hover">
              <thead>
                <tr class="btn-danger">
                  <th style="width:20%">Nama</th>
                  <th style="width:10%">Paspor</th>
                  <th style="width:20%">Institusi</th>
                  <th style="width:20%">Pekerjaan</th>
                  <th style="width:20%">Agensi</th>
                  <th style="width:20%">PPTKIS</th>
                  <th style="width:10%">Tanggal Endorse</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  if($hasil != NULL){
                    $tmp = $hasil[0];
                    for($i=0;$i<sizeof($tmp);$i++){
                      $data = $tmp[$i];
                    echo '
                    <tr>
                    <td><a href="#winModal" data-toggle="modal" data-target="#winModal" onclick="Modal.modalData(\''.$data['idtkimasalah'].'\')">'.$data['namatki'].'</a></td>
                      <td>'.$data['paspor'].' - '.$data['statustki'].'</td>
                      <td>'.$data['nameinstitution'].'</td>
                      <td>'.$data['pekerjaan'].'</td>
                      <td>'.$data['agensi'].'</td>
                      <td>'.$data['pptkis'].'</td>
                      <td>'.$data['info'].'</td>
                    </tr>
                ';
                    }
                  }
                ?>
              </tbody>
            </table>
          </div>
        </div>
        <!-- tb user -->
      </div>
    </div>
  </div>
</div>
</div>

<!-- /.Data Modal -->

      <div class="modal fade" tabindex="-1" role="dialog" id="winModal" >
        <div class="modal-dialog modal-lg" style="width: 75%">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="innerTitle">Detail Data TKI</h4>
            </div>
              <div class="modal-body" id="innerData">
              hallo
              </div>
          </div>
        </div>
      </div>



  </div>
  <div class="clearfix"></div>
</div>
</div>
</div>
</div>

<script>
$(function(){
 $('.tglformat').datepicker({
  format: "MM - yyyy",
  todayBtn: "linked",
  minViewMode	: 1,
  todayHighlight: true
});
 $('select').selectpicker();
});
</script>

<script>
		var kontenModal = null;
		var Modal = {
			modalData : function (refs) {
				kontenModal = null;
				m.redraw(true);

				//rquest
				var req="<?=base_url('pusat/query_detail')?>";
				$.post(req,{idref:refs}, function(result){
					kontenModal = JSON.parse(result);
					m.redraw(true);
				});
			},
			view: function(ctrl) {
				if (kontenModal==null) {
                    return m(".row",
								m(".text-center",[
									m("i",{class:"fa fa-spinner fa-3x fa-spin"}),
									m("h4","Loading...(requesting data)")
								])
							);
                }
				else if (kontenModal.length==2) {
                    return m(".row",
								m("form",{class:"form-horizontal col-sm-12"},
								[
									$.map(kontenModal[0],function(value, index){
										return m(".form-group ",[
													m("label",{class:"col-sm-3 control-label"},index),
													m(".col-sm-9",{style:"padding-top:7px"},[
														m("span",{class:"control-label", style:"padding-top:7px"},value)
													])
											])
									}),
									// $.map(kontenModal[1],function(value, index){
									// 	return m(".form-group .col-sm-12",[
									// 				m("label",{class:"col-sm-3 control-label"},index),
									// 				m(".col-sm-9",{style:"padding-top:7px"},[
									// 					m("a",{class:"control-label",href:value},"Download "+index)
									// 				])
									// 		])
									// })
								])
							);
                }
				else{

					return m(".row",
								m("form",{class:"form-horizontal col-sm-12"},
								[
									$.map(kontenModal,function(value, index){
										return m(".form-group ",[
													m("label",{class:"col-sm-3 control-label"},index),
													m(".col-sm-9",{style:"padding-top:7px"},[
														m("span",{class:"control-label", style:"padding-top:7px"},value)
													])
											])
									})
								])
							);
				}
			}
		};
		m.mount(document.getElementById("innerData"),Modal);
	</script>
