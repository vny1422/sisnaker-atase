


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
          <br />
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Nama Agensi <span class="required">*</span></label>
            <div class="col-md-5 col-sm-5 col-xs-12">
              <input type="text" id="agensi" name="name" required="required" class="form-control">
            </div>
          </div><br /><br /><br />

          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Nama PPTKIS <span class="required">*</span></label>
            <div class="col-md-5 col-sm-5 col-xs-12">
              <input type="text" id="pptkis" name="name" required="required" class="form-control">
            </div>
          </div><br /><br /><br />

        <div class="ln_solid"></div>
        <div class="form-group">
          <div class="col-md-8 col-sm-8 col-xs-12">
            <button id="reset" type="reset" class="btn btn-primary">Cancel</button>
            <button id="pilih" type="submit" class="btn btn-success">Submit</button>
          </div>
        </div><br /><br /><br />

        <div class="col-md-12 col-sm-12 col-xs-12">
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
  $(document).ready(function () {
    var add_button      = $("#pilih");
    var remove_button   = $("#reset");
    var agensi          = $("#agensi");
    var pptkis          = $("#pptkis");
    var idagensi        = "";
    var idpptkis        = "";
    var divjo           = $("div#jo");

    $(add_button).click(function(){
      if (agensi.val() === "" || pptkis.val() === "") {
        alert("Nama Agensi atau PPTKIS harus diisi!");
        return;
      }

      $.post("<?php echo base_url()?>paket/checkCekal", {idag: idagensi, idpp: idpptkis}, function(data,status){
        var obj = $.parseJSON(data);
        if(!obj.success) {
          alert(obj.message);
          return;
        } else {
          agensi.attr("disabled", "");
          pptkis.attr("disabled", "");

          $("#grid").jqGrid('setGridParam', {
            url: "<?php echo base_url()?>paket/listJO",
            postData: { ppkode: idpptkis,agid: idagensi }
          }).trigger('reloadGrid');

          divjo.show();
        }
      });

    });

    $(remove_button).click(function(){
      agensi.removeAttr("disabled").val("");
      pptkis.removeAttr("disabled").val("");

      divjo.hide();
    });

    $(function() {
      $( "#agensi" ).autocomplete({
        source: function(request, response) {
          $.post('<?php echo base_url();?>/paket/ambilnamaagensi/', { term:request.term}, function(json) {
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

    $(function() {
      $( "#pptkis" ).autocomplete({
        source: function(request, response) {
          $.post('<?php echo base_url();?>/paket/ambilnamapptkis/', { term:request.term}, function(json) {
            response( $.map( json.rows, function( item ) {
              return {
                label: item.ppnama,
                id: item.ppkode
              }
            }));
          }, 'json');
        },
        minLength: 1,
      select: function( event, ui ) {
        idpptkis = ui.item.id;
      }
      });
    } );

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

    var grid = $("#grid").jqGrid({
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
      height: 300,
      pager: "#pgrid",
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
          height: 80,
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
        '#pgrid',
        {edit:true, add:true, del:true, search:true, view:false, refresh:true, beforeRefresh: function() {$(this).clearGridData(true);}},
        {url: '<?php echo base_url()?>paket/editJO',editData: { ppkode: function () { return idpptkis; }, agid: function () { return idagensi; }},jqModal:true, width: 450, closeOnEscape:true, checkOnSubmit:true, closeAfterEdit:true, afterComplete:reload, recreateForm:true, beforeShowForm:initCustom, bottominfo:"Fields marked with (*) are required"}, // edit
        {url: '<?php echo base_url()?>paket/editJO',editData: { ppkode: function () { return idpptkis; }, agid: function () { return idagensi; }},jqModal:true, width: 450, closeOnEscape:true, checkOnUpdate:true, clearAfterAdd:true, closeAfterAdd:true, afterComplete:reload, beforeShowForm:initCustom, recreateForm:true, bottominfo:"Fields marked with (*) are required"}, // add
        {url: '<?php echo base_url()?>paket/editJO',delData: { ppkode: function () { return idpptkis; }, agid: function () { return idagensi; }}, closeOnEscape:true,afterComplete:reload}, // del
        {multipleSearch:true},
        {}
    );

    divjo.hide();
  });
  </script>
