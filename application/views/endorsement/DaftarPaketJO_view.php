


<!-- page content -->
<div class="right_col" role="main">

  <br />
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2><strong><?php echo $title; ?></strong></h2>
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
    var divjo           = $("div#jo");

    var grid = $("#grid").jqGrid({
      mtype: "POST",
      datatype: "json",
      colNames: ["ID", "No.JO(FORM01)", "Tgl.Awal", "Tgl.Akhir", "Aktif", "Pushed?"],
      colModel: [
        {name:'id', index:'jobid', key:true, hidden: true},
        {name:'jobno', index:'jobno', width:100, editable:true, searchoptions:{sopt:['cn']}, editoptions:{size:30, maxlength:50}, editrules:{required:true}, formoptions:{elmsuffix:'(*)'}},
        {name:'jobtglawal', index:'jobtglawal', width:80, editable:true, searchoptions:{sopt:['gt','ge', 'lt','le']}, editoptions:{size:10, maxlength:50}, editrules:{edithidden:false, required:true}, formoptions:{elmsuffix:'(*)'}},
        {name:'jobtglakhir', index:'jobtglakhir', width:80, editable:true, searchoptions:{sopt:['gt','ge', 'lt','le']}, editoptions:{size:10, maxlength:50}, editrules:{edithidden:true, required:true}, formoptions:{elmsuffix:'(*)'}},
        {name:'jobenable', index:'jobenable', width:50, align:'center', editable:true, searchoptions:{sopt:['eq']}, editable:true, editoptions:{defaultValue:"1", size:1, maxlength:1}, formatoptions:{disabled:true}},
        {name:'joispushed', index:'joispushed', width:50, align:'center', searchoptions:{sopt:['eq']}, editoptions:{defaultValue:"1", size:1, maxlength:1}, formatoptions:{disabled:true}}
      ],
      height: 300,
      pager: "#pgrid",
      autowidth: true,
      viewrecords: true,
      sortname: 'jobid',
      sortorder: 'desc'
    });

    var reload = function() {
      grid.trigger('reloadGrid');
    }

    grid.jqGrid(
        'navGrid',
        '#pgrid',
        {edit:true, add:true, del:false, search:true, view:false, refresh:true, beforeRefresh: function() {$(this).clearGridData(true);}},
        {jqModal:true, width: 450, checkOnSubmit:true, closeAfterEdit:true, afterComplete:reload, recreateForm:true, bottominfo:"Fields marked with (*) are required"}, // edit
        {jqModal:true, width: 450, closeOnEscape:true, checkOnUpdate:true, clearAfterAdd:true, closeAfterAdd:true, afterComplete:reload, recreateForm:true, bottominfo:"Fields marked with (*) are required"}, // add
        {}, // del
        {multipleSearch:true},
        {}
    );

    $(add_button).click(function(){
      if (agensi.val() === "" || pptkis.val() === "") {
        alert("Nama Agensi atau PPTKIS harus diisi!");
        return;
      }

      agensi.attr("disabled", "");
      pptkis.attr("disabled", "");

      $("#grid").jqGrid('setGridParam', {
        url: "<?php echo base_url()?>paket/listJO",
        postData: { ppkode: pptkis.val(),agid: agensi.val() }
      }).trigger('reloadGrid');

      divjo.show();
    });

    $(remove_button).click(function(){
      agensi.removeAttr("disabled").val("");
      pptkis.removeAttr("disabled").val("");

      divjo.hide();
    });

    $(function() {
      $( "#agensi" ).autocomplete({
        source: function(request, response) {
          $.ajax({ 
            url: "<?php echo base_url(); ?>/Paket/ambilnamaagensi/",
            data: { kode: request.term},
            dataType: "json",
            type: "POST",
            success: function(data){
              response(data);
            }
          });
        }
      });
    } );

    $(function() {
      $( "#pptkis" ).autocomplete({
        source: function(request, response) {
          $.ajax({ 
            url: "<?php echo base_url(); ?>/Paket/ambilnamapptkis/",
            data: { kode: request.term},
            dataType: "json",
            type: "POST",
            success: function(data){
              response(data);
            }
          });
        }
      });
    } );

    divjo.hide();
  });
  </script>

