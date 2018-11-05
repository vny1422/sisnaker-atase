
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

          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="barcode">Barcode <span class="required">*</span></label>
            <div class="col-md-3 col-sm-3 col-xs-12">
              <input id="barcode" type="text" name="barcode" required="required" class="form-control">
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12">
              <button id="check" class="ladda-button" data-style="expand-right" data-color="green" data-size="xs"><span class="ladda-label" style="color:white">Cetak</span></button>
            </div>
          </div><br /><br />
        </div>
    </div>
    <br />
  </div>
</div>

<script>
  $(document).ready(function () {
      var l = $("#check").ladda();

      openlabel = function(verb, url, data, target) {
        var form = document.createElement("form");
        form.action = url;
        form.method = verb;
        form.target = target;
        if (data) {
          for (var key in data) {
            var input = document.createElement("textarea");
            input.name = key;
            input.value = typeof data[key] === "object" ? JSON.stringify(data[key]) : data[key];
            form.appendChild(input);
          }
        }
        form.style.display = 'none';
        document.body.appendChild(form);
        map = window.open("", "Label", "width=400,height=300");
        form.submit();
      };

    $("#check").click(function() {
      l.ladda('start');
      var code = $("#barcode").val();
      $.post("<?php echo base_url()?>Endorsement/getKukodeByBC", {barcode: code}, function(data,status){
        var obj = $.parseJSON(data);
        l.ladda('stop');  
        if(obj.length > 0)
        {
          openlabel('POST',"<?php echo base_url()?>kuitansi/printLabel",{barcode: obj[0].kukode},'Label');
        }
        else
        {
          window.alert('Barcode tidak valid!');
        }

      });
    });
    });
</script>