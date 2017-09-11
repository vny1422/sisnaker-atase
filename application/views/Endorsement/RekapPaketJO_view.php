


<!-- page content -->
<div class="right_col" role="main">

  <br />
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2><strong><?php echo $subtitle; ?></strong></h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <div class="row" style="<?php echo ($_SESSION['role'] == 1 || $_SESSION['role'] == 5 ? "" : "display:none;"); ?>">
            <div class="form-group col-lg-4">
              <label><h2>Institusi</h2></label>
              <select class="form-control" id="list-institusi" name="list-institusi" onchange="refreshjqgrid()">
                <?php
                if (isset($listinstitusi)) {
                  foreach($listinstitusi as $row):
                    if ($row->idinstitution != 1) {
                      echo "<option value=".$row->idinstitution.">".$row->nameinstitution."</option>";
                    }
                    endforeach;
                  }
                  ?>
                </select>
              </div>
            </div>
        <div class="col-md-12 col-sm-12 col-xs-12" style="padding-top: 20px">
          <div id="jo" class="row">
            <table id="grid"></table>
            <div id="pgrid"></div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

<script>
  var idinstitution = <?php echo $_SESSION['institution'] ?>;

  function refreshjqgrid() {
    idinstitution = $("#list-institusi").val();
    $("#grid").jqGrid('clearGridData');
    $("#grid").jqGrid('setGridParam', { 
        postData: {idinstitution:idinstitution}
    })
    $("#grid").trigger('reloadGrid');
  }

  $(document).ready(function () {
    var divjo         = $("div#jo");
    var role = <?php echo $_SESSION['role'] ?>;
    if(role == 1 || role == 5) {
      idinstitution = $("#list-institusi").val();
    }

    var grid = $("#grid").jqGrid({
      url: '<?php echo base_url()?>paket/listAgensi',
      postData: { idinstitution: idinstitution },
      datatype: "json",
      mtype: "POST",
      colNames: ["ID", "Nama Agensi", "No CLA"],
      colModel: [
        {name:'agid', index:'agid',  key:true, hidden: true},
        {name:'agnama', index:'agnama', width:550, searchoptions:{sopt:['cn']}},
        {name:'agnoijincla', index:'agnoijincla', width:150, searchoptions:{sopt:['cn']}}
      ],
      height: 'auto',
      pager: "#pgrid",
      autowidth: true,
      viewrecords: true,
      sortname: 'agnama',
      sortorder: 'ASC',
      subGrid: true,
      subGridRowExpanded: function(subgrid_id, row_id) {
        var agid = row_id;
        
        var subgrid_table_id = subgrid_id+"_t";
        var pager_id = "p_"+subgrid_table_id;
        
        var template = "<table id='"+subgrid_table_id+"' class='scroll'></table><div id='"+pager_id+"' class='scroll'></div>";
        $("#"+subgrid_id).html(template);
        
        var subgrid = $("#" + subgrid_table_id).jqGrid({
          url: '<?php echo base_url()?>paket/listPPTKIS',
          postData: { agid: row_id },
          datatype: "json",
          mtype: "POST",
          colNames: ["ID", "Nama PPTKIS"],
          colModel: [
            {name:'ppkode', index:'ppkode', key:true, hidden: true},
            {name:'ppnama', index:'ppnama', searchoptions:{sopt:['cn']}},
          ],
          height: 'auto',
          pager: "#" + pager_id,
          autowidth: true,
          viewrecords: true,
          sortname: 'ppnama',
          sortorder: 'ASC',
          subGrid: true,
          subGridRowExpanded: function(subgrid_id, row_id) {
            var ppkode = row_id;
            
            var subgrid_table_id = subgrid_id+"_t";
            var pager_id = "p_"+subgrid_table_id;
            
            var template = "<table id='"+subgrid_table_id+"' class='scroll'></table><div id='"+pager_id+"' class='scroll'></div>";
            $("#"+subgrid_id).html(template);

            var initCustom = function() {
              var el = divjo.find('#jobtglawal');
              el.css("readonly", "");
              el.datepicker({
                showOn: "button",
                buttonImage: '<?php echo base_url();?>/assets/images/calendar.gif',
                buttonImageOnly: true,
                dateFormat:'dd/mm/yy',
                changeMonth: true,
                changeYear: true,
                yearRange: '1900:+200'
              });
              
              var el = divjo.find('#jobtglakhir');
              el.css("readonly", "");
              el.datepicker({
                showOn: "button",
                buttonImage: '<?php echo base_url();?>/assets/images/calendar.gif',
                buttonImageOnly: true,
                dateFormat:'dd/mm/yy',
                changeMonth: true,
                changeYear: true,
                yearRange: '1900:+200'
              });
            }

            var grid = $("#" + subgrid_table_id).jqGrid({
              url: "<?php echo base_url()?>paket/listJO",
              postData: { ppkode: ppkode,agid: agid },
              mtype: "POST",
              datatype: "json",
              colNames: ["ID", "No.JO(FORM01)", "Tgl.Awal", "Tgl.Akhir", "Aktif", "Pushed?"],
              colModel: [
                {name:'id', index:'jobid', key:true, hidden: true},
                {name:'jobno', index:'jobno', width:100, editable:true, searchoptions:{sopt:['cn']}, editoptions:{size:30, maxlength:50}, editrules:{required:true}, formoptions:{elmsuffix:'(*)'}, editoptions:{size:2}},
                {name:'jobtglawal', index:'jobtglawal', width:80, editable:true, searchoptions:{sopt:['gt','ge', 'lt','le']}, editoptions:{size:10, maxlength:50}, editrules:{edithidden:false, required:true}, formoptions:{elmsuffix:'(*)'}},
                {name:'jobtglakhir', index:'jobtglakhir', width:80, editable:true, searchoptions:{sopt:['gt','ge', 'lt','le']}, editoptions:{size:10, maxlength:50}, editrules:{edithidden:true, required:true}, formoptions:{elmsuffix:'(*)'}},
                {name:'jobenable', index:'jobenable', width:50, align:'center', editable:true, searchoptions:{sopt:['eq']}, editable:true, editoptions:{defaultValue:"1", size:1, maxlength:1}, formatoptions:{disabled:true}},
                {name:'jobispushed', index:'jobispushed', width:50, align:'center', searchoptions:{sopt:['eq']}, editoptions:{defaultValue:"1", size:1, maxlength:1}, formatoptions:{disabled:true}}
              ],
              height: 'auto',
              pager: "#" + pager_id,
              autowidth: true,
              viewrecords: true,
              sortname: 'jobid',
              sortorder: 'desc',
              subGrid: true,
              subGridRowExpanded: function(subgrid_id, row_id) {
                var subgrid_table_id = subgrid_id+"_t";
                var pager_id = "p_"+subgrid_table_id;
                
                var template = "<table id='"+subgrid_table_id+"' class='scroll'></table><div id='"+pager_id+"' class='scroll'></div>";
                $("#"+subgrid_id).html(template);
                
                var subgrid = $("#"+subgrid_table_id).jqGrid({
                  datatype: "json",
                  mtype: "POST",
                  colNames: ["ID", "IDJP", "Jenis Pekerjaan", "L", "P", "C"],
                  colModel: [
                    {name:'id', index:'jobdid', key:true, hidden: true},
                    {name:'jpid', index:'jpid', hidden: true},
                    {name:'jpnama', index: 'jpnama', edittype:'select', editable:true, editrules:{required:true}, formoptions:{elmsuffix:'(*)'}},
                    {name:'jobdl', index:'jobdl', width:40, editable:true, editoptions:{size:8, maxlength:11, defaultValue:'0'}, editrules:{required:true, minValue:0, number:true}, formoptions:{elmsuffix:'(*)'}},
                    {name:'jobdp', index:'jobdp', width:40, editable:true, editoptions:{size:8, maxlength:11, defaultValue:'0'}, editrules:{required:true, minValue:0, number:true}, formoptions:{elmsuffix:'(*)'}},
                    {name:'jobdc', index:'jobdc', width:40, editable:true, editoptions:{size:8, maxlength:11, defaultValue:'0'}, editrules:{required:true, minValue:0, number:true}, formoptions:{elmsuffix:'(*)'}}
                  ],
                  autowidth:true,
                  height: 'auto',
                  pager: "#"+pager_id,
                  viewrecords: true,
                  sortname: 'jobdid',
                  sortorder: 'asc',
                  url: '<?php echo base_url()?>paket/listJODetail',
                  postData: { jobid: row_id }
                });
                  
                var initCustom2 = function() {
                  var rowId = $("#"+subgrid_table_id).getGridParam('selrow');
                  var rowData = $("#"+subgrid_table_id).getRowData(rowId);
                  $.post('<?php echo base_url();?>/paket/listJP', function(data) {
                    var obj = $.parseJSON(data);
                    var el = $("tr#tr_jpnama").find("select");
                    $.each(obj['rows'], function(index,value) {
                      if (value.idjenispekerjaan == rowData['jpid']) {
                        $temp = "<option value='" + value.idjenispekerjaan + "' selected>" + value.namajenispekerjaan + "</option>";
                      } else {
                        $temp = "<option value='" + value.idjenispekerjaan + "'>" + value.namajenispekerjaan + "</option>";
                      }
                      el.append($temp);
                    });
                    
                    el.css("width", "200px");
                    el.attr("id", "jpnama");
                    el.attr("name", "jpnama");
                  });
                }
                
                var reload = function() {
                  subgrid.trigger('reloadGrid');
                }
                
                subgrid.jqGrid(
                  'navGrid',
                  "#"+pager_id,
                  {edit:true, add:true, del:true, search:true, view:false, refresh:true, beforeRefresh: function() {$(this).clearGridData(true);}},
                  {url: '<?php echo base_url()?>paket/editJODetail',editData: { jobid: function () { return row_id; }},jqModal:true, width: 450, checkOnSubmit:true, closeAfterEdit:true, afterComplete:reload, recreateForm:true, beforeShowForm:initCustom2, bottominfo:"Fields marked with (*) are required"}, // edit
                  {url: '<?php echo base_url()?>paket/editJODetail',editData: { jobid: function () { return row_id; }},jqModal:true, width: 450, closeOnEscape:true, checkOnUpdate:true, clearAfterAdd:true, closeAfterAdd:true, afterComplete:reload, recreateForm:true, beforeShowForm:initCustom2, bottominfo:"Fields marked with (*) are required"}, // add
                  {url: '<?php echo base_url()?>paket/editJODetail',delData: { jobid: function () { return row_id; }}, closeOnEscape:true,afterComplete:reload}, // del
                  {multipleSearch:true},
                  {}
                );
              }
            });

            var reload = function() {
              grid.trigger('reloadGrid');
            }

            grid.jqGrid(
                'navGrid',
                '#' + pager_id,
                {edit:true, add:true, del:true, search:true, view:false, refresh:true, beforeRefresh: function() {$(this).clearGridData(true);}},
                {url: '<?php echo base_url()?>paket/editJO',editData: { ppkode: function () { return ppkode; }, agid: function () { return agid; }},jqModal:true, width: 450, closeOnEscape:true, checkOnSubmit:true, closeAfterEdit:true, afterComplete:reload, recreateForm:true, beforeShowForm:initCustom, bottominfo:"Fields marked with (*) are required"}, // edit
                {url: '<?php echo base_url()?>paket/editJO',editData: { ppkode: function () { return ppkode; }, agid: function () { return agid; }},jqModal:true, width: 450, closeOnEscape:true, checkOnUpdate:true, clearAfterAdd:true, closeAfterAdd:true, afterComplete:reload, beforeShowForm:initCustom, recreateForm:true, bottominfo:"Fields marked with (*) are required"}, // add
                {url: '<?php echo base_url()?>paket/editJO',delData: { ppkode: function () { return idpptkis; }, agid: function () { return idagensi; }}, closeOnEscape:true,afterComplete:reload}, // del
                {multipleSearch:true},
                {}
            );
          }
        });

        var reload = function() {
          subgrid.trigger('reloadGrid');
        }
        
        subgrid.jqGrid(
          'navGrid',
          "#" + pager_id,
          {edit:false, add:false, del:false, search:true, view:false, refresh:true, beforeRefresh: function() {$(this).clearGridData(true);}},
          {}, // edit
          {}, // add
          {}, // del
          {multipleSearch:true},
          {}
        );
      }
    });

    var reload = function() {
      grid.trigger('reloadGrid');
    }
    
    grid.jqGrid(
      'navGrid',
      '#pgrid',
      {edit:false, add:false, del:false, search:true, view:false, refresh:true, beforeRefresh: function() {$(this).clearGridData(true);}},
      {}, // edit
      {}, // add
      {}, // del
      {multipleSearch:true},
      {}
    );

  });
  </script>
