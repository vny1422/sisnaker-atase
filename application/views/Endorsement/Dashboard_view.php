<!-- page content -->
<div class="right_col" role="main">

  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <div class="col-md-8">
            <h3> <b>DASHBOARD <?php echo $subtitle; ?></b></h3>
          </div>
          <div class="col-md-2">
            <select class="form-control" name="" data-size="3" data-live-search="true" id="tahun">
              <?php foreach ($tahunpenempatan as $row ) {?>
              <option value="<?php echo $row->tahun?>"><?php echo $row->tahun?></option>
              <?php }?>
            </select>
          </div>
          <div class="col-md-2">
            <select class="form-control" name="" data-size="3" data-live-search="true" id="bulan">
              <option value="01" <?php echo '',($month == '01' ? 'selected' : '') ?>>January</option>
              <option value="02" <?php echo '',($month == '02' ? 'selected' : '') ?>>February</option>
              <option value="03" <?php echo '',($month == '03' ? 'selected' : '') ?>>March</option>
              <option value="04" <?php echo '',($month == '04' ? 'selected' : '') ?>>April</option>
              <option value="05" <?php echo '',($month == '05' ? 'selected' : '') ?>>May</option>
              <option value="06" <?php echo '',($month == '06' ? 'selected' : '') ?>>June</option>
              <option value="07" <?php echo '',($month == '07' ? 'selected' : '') ?>>July</option>
              <option value="08" <?php echo '',($month == '08' ? 'selected' : '') ?>>August</option>
              <option value="09" <?php echo '',($month == '09' ? 'selected' : '') ?>>September</option>
              <option value="10" <?php echo '',($month == '10' ? 'selected' : '') ?>>October</option>
              <option value="11" <?php echo '',($month == '11' ? 'selected' : '') ?>>November</option>
              <option value="12" <?php echo '',($month == '12' ? 'selected' : '') ?>>December</option>
            </select>
          </div>
          <!-- <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </ul> -->
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <div class="row">
            <div class="col-md-6">
              <div class="panel panel-success">
                <div class="panel-heading">
                  <div class="row">
                    <div class="col-md-2">
                      <i class="fa fa-venus-mars fa-3x"></i>
                    </div>
                    <div class="col-md-10">
                      <div class="text-right">
                        <h4> <b class="dtahun"></b> - (Based on Gender)</h4>
                        <b></b>
                      </div>

                    </div>
                  </div>
                </div>
                <div class="panel-body">
                  <div class="row">
                    <div class="col-lg-8 col-xs-10" style="height: 250px" id="donut-jktahun"></div>
                    <div class="col-lg-4 col-xs-2" style="text-align: right"><h1 id="sumjktahun"></h1></div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="panel panel-success">
                <div class="panel-heading">
                  <div class="row">
                    <div class="col-md-2">
                      <i class="fa fa-venus-mars fa-3x"></i>
                    </div>
                    <div class="col-md-10 text-right">
                      <div><h4><b class="dbulan"></b> - (Based on Gender)</h4></div>
                    </div>
                  </div>
                </div>
                <div class="panel-body">
                  <div class="row">
                    <div class="col-lg-8 col-xs-10" style="height: 250px" id="donut-jkbulan"></div>
                    <div class="col-lg-4 col-xs-2" style="text-align: right"><h1 id="sumjkbulan"></h1></div>
                  </div>
                </div>
              </div>
            </div>

        </div>
        <br />

        <div class="row">
            <div class="col-md-6">
              <div class="panel panel-success">
                <div class="panel-heading">
                  <div class="row">
                    <div class="col-md-2">
                      <i class="fa fa-group fa-3x"></i>
                    </div>
                    <div class="col-md-10 text-right">
                      <div><h4><b class="dtahun"></b> - (Based on Sector)</h4></div>
                    </div>
                  </div>
                </div>
                <div class="panel-body">
                  <div class="row">
                    <div class="col-lg-8 col-xs-10" style="height: 250px" id="donut-sektortahun"></div>
                    <div class="col-lg-4 col-xs-2" style="text-align: right"><h1 id="sumsektahun"></h1></div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="panel panel-success">
                <div class="panel-heading">
                  <div class="row">
                    <div class="col-md-2">
                      <i class="fa fa-group fa-3x"></i>
                    </div>
                    <div class="col-md-10 text-right">
                      <div><h5><b class="dbulan"></b> - (Based on Sector)</h5></div>
                    </div>
                  </div>
                </div>
                <div class="panel-body">
                  <div class="row">
                    <div class="col-lg-8 col-xs-10" style="height: 250px" id="donut-sektorbulan"></div>
                    <div class="col-lg-4 col-xs-2" style="text-align: right"><h1 id="sumsekbulan"></h1></div>
                  </div>
                </div>
              </div>
            </div>

        </div>
        <br />

        <div class="row">

          <div class="col-lg-12">
            <div class="panel panel-success">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-md-2">
                    <i class="fa fa-bar-chart-o fa-3x"></i>
                  </div>
                  <div class="col-md-10 text-right">
                    <h5> <b id="gtahun"></b> - (Based on Job Type)</h5>
                  </div>
                </div>
              </div>

              <div class="panel-body">
                <div id="graph-jptahun"></div>
              </div>
            </div>
          </div>

        </div>

        <div class="row">

          <div class="col-lg-12">
            <div class="panel panel-success">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-md-2">
                    <i class="fa fa-bar-chart-o fa-3x"></i>
                  </div>
                  <div class="col-md-10 text-right">
                    <h5> <b id="gpptkistahun"></b> - (Based on PPTKIS)</h5>
                  </div>
                </div>
              </div>

              <div class="panel-body">
                <div id="graph-pptkistahun"></div>
              </div>
            </div>
          </div>

        </div>

      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function () {
    $('select').selectpicker();

    $('.dtahun').html("Placement on (Year) " + $("#tahun").val());
    $('.dbulan').html("Placement on (Month) " + $("#bulan option:selected").text());
    $('#gtahun').html("Placement Statistic (Year) " + $("#tahun").val());
    $('#gpptkistahun').html("Placement Statistic (Year) " + $("#tahun").val());

    $.ajax({
      url     : "<?php echo site_url('endorsement/get_info_year_dashboard_agensi')?>",
      data    : {"y":$("#tahun").val(),"m":$("#bulan").val()},
      type    : "post",
      dataType  : "json",
      success   : function(data){
        //console.log(data);

        $("#sumjktahun").html(data[0]);
        $("#sumjkbulan").html(data[2]);
        $("#sumsektahun").html(data[4]);
        $("#sumsekbulan").html(data[6]);

        var datajktahun = [];
        for (i = 0; i < data[1].length; i++) {
          datajktahun.push({label: data[1][i].tkjk, value: data[1][i].total, total: data[0]});
        }
        if (datajktahun.length == 0) {
          datajktahun.push({label: "", value: ""});
        }

        jktahun = Morris.Donut({
          element: 'donut-jktahun',
          data: datajktahun,
          resize: true,
          formatter: function (y, datas) { return y + " (" + Math.round(y/datas.total*100) + "%)"}
        });

        if(datajktahun.length > 1) {
          jktahun.options.colors = ["#0A4C20","#58CC7E"];
        } else if (datajktahun.length == 1 && datajktahun[0].label == "L") {
          jktahun.options.colors = ["#0A4C20"];
        } else if (datajktahun.length == 1 && datajktahun[0].label == "P") {
          jktahun.options.colors = ["#58CC7E"];
        }
        jktahun.redraw();

        var datajkbulan = [];
        for (i = 0; i < data[3].length; i++) {
          datajkbulan.push({label: data[3][i].tkjk, value: data[3][i].total, total: data[2]});
        }
        if (datajkbulan.length == 0) {
          datajkbulan.push({label: "", value: ""});
        }

        jkbulan = Morris.Donut({
          element: 'donut-jkbulan',
          data: datajkbulan,
          resize: true,
          formatter: function (y, datas) { return y + " (" + Math.round(y/datas.total*100) + "%)"}
        });

        if(datajkbulan.length > 1) {
          jkbulan.options.colors = ["#0A4C20","#58CC7E"];
        } else if (datajkbulan.length == 1 && datajkbulan[0].label == "L") {
          jkbulan.options.colors = ["#0A4C20"];
        } else if (datajkbulan.length == 1 && datajkbulan[0].label == "P") {
          jkbulan.options.colors = ["#58CC7E"];
        }
        jkbulan.redraw();

        var datasektortahun = [];
        for (i = 0; i < data[5].length; i++) {
          if (data[5][i].sektor == '1') {
            datasektortahun.push({label: 'Informal', value: data[5][i].total, total: data[4]});
          } else if (data[5][i].sektor == '2') {
            datasektortahun.push({label: 'Formal', value: data[5][i].total, total: data[4]});
          }
        }
        if (datasektortahun.length == 0) {
          datasektortahun.push({label: "", value: ""});
        }

        sektortahun = Morris.Donut({
          element: 'donut-sektortahun',
          data: datasektortahun,
          resize: true,
          formatter: function (y, datas) { return y + " (" + Math.round(y/datas.total*100) + "%)"}
        });

        if(datasektortahun.length > 1) {
          sektortahun.options.colors = ["#58A8CC","#0A384C"];
        } else if (datasektortahun.length == 1 && datasektortahun[0].label == "Informal") {
          sektortahun.options.colors = ["#58A8CC"];
        } else if (datasektortahun.length == 1 && datasektortahun[0].label == "Formal") {
          sektortahun.options.colors = ["#0A384C"];
        }
        sektortahun.redraw();

        var datasektorbulan = [];
        for (i = 0; i < data[7].length; i++) {
          if (data[7][i].sektor == '1') {
            datasektorbulan.push({label: 'Informal', value: data[7][i].total, total: data[6]});
          } else if (data[7][i].sektor == '2') {
            datasektorbulan.push({label: 'Formal', value: data[7][i].total, total: data[6]});
          }
        }
        if (datasektorbulan.length == 0) {
          datasektorbulan.push({label: "", value: ""});
        }

        sektorbulan = Morris.Donut({
          element: 'donut-sektorbulan',
          data: datasektorbulan,
          resize: true,
          formatter: function (y, datas) { return y + " (" + Math.round(y/datas.total*100) + "%)"}
        });

        if(datasektorbulan.length > 1) {
          sektorbulan.options.colors = ["#58A8CC","#0A384C"];
        } else if (datasektorbulan.length == 1 && datasektorbulan[0].label == "Informal") {
          sektorbulan.options.colors = ["#58A8CC"];
        } else if (datasektorbulan.length == 1 && datasektorbulan[0].label == "Formal") {
          sektorbulan.options.colors = ["#0A384C"];
        }
        sektorbulan.redraw();

        var datajptahun = [];
        for (i = 0; i < data[9].length; i++) {
          var datajpmonth = {month: data[9][i].bulan, total: data[9][i].total};
          for (j = 0; j < data[8].length; j++) {
            datajpmonth[data[8][j]] = data[9][i][data[8][j]];
          }
          datajptahun.push(datajpmonth);
        }

        jptahun = Morris.Bar({
          element: 'graph-jptahun',
          data: datajptahun,
          xkey: 'month',
          ykeys: data[8],
          yLabelFormat: function(y){return y != Math.round(y)?'':y;},
          hoverCallback: function(index, options, content, row) {
            var contents = $.trim(content);
            contents = contents.replace(/\n/g, "");
            var total = row.total;
            for (key in row) {
              if(key != "month" && key != "total") {
                var replaced = "  " + key + ":  " + row[key];
                var newf = "";
                if(total == 0) {
                  newf = "  " + key + ":  " + row[key] + " (0%)";
                } else {
                  newf = "  " + key + ":  " + row[key] + " (" + (row[key]/total*100) + '%)';
                }
                contents = contents.replace(replaced,newf);
              }
            }
            return contents;
          },
          labels: data[8],
          stacked: true,
          resize: true
        });

        var datapptkistahun = [];
        for (i = 0; i < data[12].length; i++) {
          var datapptkismonth = {month: data[12][i].bulan, total: data[12][i].total};
          for (j = 0; j < data[10].length; j++) {
            datapptkismonth[data[10][j]] = data[12][i][data[10][j]];
          }
          datapptkistahun.push(datapptkismonth);
        }

        pptkistahun = Morris.Bar({
          element: 'graph-pptkistahun',
          data: datapptkistahun,
          xkey: 'month',
          ykeys: data[10],
          yLabelFormat: function(y){return y != Math.round(y)?'':y;},
          hoverCallback: function(index, options, content, row) {
            var contents = $.trim(content);
            contents = contents.replace(/\n/g, "");
            var total = row.total;
            for (key in row) {
              if(key != "month" && key != "total") {
                var replaced = "  " + key + ":  " + row[key];
                var newf = "";
                if(total == 0) {
                  newf = "  " + key + ":  " + row[key] + " (0%)";
                } else {
                  newf = "  " + key + ":  " + row[key] + " (" + (row[key]/total*100) + '%)';
                }
                contents = contents.replace(replaced,newf);
              }
            }
            return contents;
          },
          labels: data[10],
          stacked: true,
          resize: true
        });

      }
    });

    $("#tahun").change(function(){
      $('.dtahun').html("Penempatan Tahun " + $("#tahun").val());
      $('#gtahun').html("Statistik Penempatan Tahun " + $("#tahun").val());
      $('#gpptkistahun').html("Statistik Penempatan Tahun " + $("#tahun").val());

      $.ajax({
        url     : "<?php echo site_url('endorsement/get_info_year_dashboard_agensi')?>",
        data    : {"y":$("#tahun").val(),"m":$("#bulan").val()},
        type    : "post",
        dataType  : "json",
        success   : function(data){
          $("#sumjktahun").html(data[0]);
          $("#sumjkbulan").html(data[2]);
          $("#sumsektahun").html(data[4]);
          $("#sumsekbulan").html(data[6]);

          var datajktahun = [];
          for (i = 0; i < data[1].length; i++) {
            datajktahun.push({label: data[1][i].tkjk, value: data[1][i].total, total: data[0]});
          }
          if (datajktahun.length == 0) {
            datajktahun.push({label: "", value: ""});
          }

          if(datajktahun.length > 1) {
            jktahun.options.colors = ["#0A4C20","#58CC7E"];
          } else if (datajktahun.length == 1 && datajktahun[0].label == "L") {
            jktahun.options.colors = ["#0A4C20"];
          } else if (datajktahun.length == 1 && datajktahun[0].label == "P") {
            jktahun.options.colors = ["#58CC7E"];
          }
          jktahun.setData(datajktahun);

          var datajkbulan = [];
          for (i = 0; i < data[3].length; i++) {
            datajkbulan.push({label: data[3][i].tkjk, value: data[3][i].total, total: data[2]});
          }
          if (datajkbulan.length == 0) {
            datajkbulan.push({label: "", value: ""});
          }

          if(datajkbulan.length > 1) {
            jkbulan.options.colors = ["#0A4C20","#58CC7E"];
          } else if (datajkbulan.length == 1 && datajkbulan[0].label == "L") {
            jkbulan.options.colors = ["#0A4C20"];
          } else if (datajkbulan.length == 1 && datajkbulan[0].label == "P") {
            jkbulan.options.colors = ["#58CC7E"];
          }
          jkbulan.setData(datajkbulan);

          var datasektortahun = [];
          for (i = 0; i < data[5].length; i++) {
            if (data[5][i].sektor == '1') {
              datasektortahun.push({label: 'Informal', value: data[5][i].total, total: data[4]});
            } else if (data[5][i].sektor == '2') {
              datasektortahun.push({label: 'Formal', value: data[5][i].total, total: data[4]});
            }
          }
          if (datasektortahun.length == 0) {
            datasektortahun.push({label: "", value: ""});
          }

          if(datasektortahun.length > 1) {
            sektortahun.options.colors = ["#58A8CC","#0A384C"];
          } else if (datasektortahun.length == 1 && datasektortahun[0].label == "Informal") {
            sektortahun.options.colors = ["#58A8CC"];
          } else if (datasektortahun.length == 1 && datasektortahun[0].label == "Formal") {
            sektortahun.options.colors = ["#0A384C"];
          }
          sektortahun.setData(datasektortahun);

          var datasektorbulan = [];
          for (i = 0; i < data[7].length; i++) {
            if (data[7][i].sektor == '1') {
              datasektorbulan.push({label: 'Informal', value: data[7][i].total, total: data[6]});
            } else if (data[7][i].sektor == '2') {
              datasektorbulan.push({label: 'Formal', value: data[7][i].total, total: data[6]});
            }
          }
          if (datasektorbulan.length == 0) {
            datasektorbulan.push({label: "", value: ""});
          }

          if(datasektorbulan.length > 1) {
            sektorbulan.options.colors = ["#58A8CC","#0A384C"];
          } else if (datasektorbulan.length == 1 && datasektorbulan[0].label == "Informal") {
            sektorbulan.options.colors = ["#58A8CC"];
          } else if (datasektorbulan.length == 1 && datasektorbulan[0].label == "Formal") {
            sektorbulan.options.colors = ["#0A384C"];
          }
          sektorbulan.setData(datasektorbulan);

          var datajptahun = [];
          for (i = 0; i < data[9].length; i++) {
            var datajpmonth = {month: data[9][i].bulan, total: data[9][i].total};
            for (j = 0; j < data[8].length; j++) {
              datajpmonth[data[8][j]] = data[9][i][data[8][j]];
            }
            datajptahun.push(datajpmonth);
          }
          jptahun.options.ykeys = data[8];
          jptahun.options.labels = data[8];
          jptahun.setData(datajptahun);

          var datapptkistahun = [];
          for (i = 0; i < data[12].length; i++) {
            var datapptkismonth = {month: data[12][i].bulan, total: data[12][i].total};
            for (j = 0; j < data[10].length; j++) {
              datapptkismonth[data[10][j]] = data[12][i][data[10][j]];
            }
            datapptkistahun.push(datapptkismonth);
          }
          pptkistahun.options.ykeys = data[10];
          pptkistahun.options.labels = data[10];
          pptkistahun.setData(datapptkistahun);

        }
      });
    });

    $("#bulan").change(function(){
      $('.dbulan').html("Penempatan Bulan " + $("#bulan option:selected").text());

      $.ajax({
        url     : "<?php echo site_url('endorsement/get_info_year_dashboard_agensi')?>",
        data    : {"y":$("#tahun").val(),"m":$("#bulan").val()},
        type    : "post",
        dataType  : "json",
        success   : function(data){
          $("#sumjkbulan").html(data[2]);
          $("#sumsekbulan").html(data[6]);

          var datajkbulan = [];
          for (i = 0; i < data[3].length; i++) {
            datajkbulan.push({label: data[3][i].tkjk, value: data[3][i].total, total: data[2]});
          }
          if (datajkbulan.length == 0) {
            datajkbulan.push({label: "", value: ""});
          }

          if(datajkbulan.length > 1) {
            jkbulan.options.colors = ["#0A4C20","#58CC7E"];
          } else if (datajkbulan.length == 1 && datajkbulan[0].label == "L") {
            jkbulan.options.colors = ["#0A4C20"];
          } else if (datajkbulan.length == 1 && datajkbulan[0].label == "P") {
            jkbulan.options.colors = ["#58CC7E"];
          }
          jkbulan.setData(datajkbulan);

          var datasektorbulan = [];
          for (i = 0; i < data[7].length; i++) {
            if (data[7][i].sektor == '1') {
              datasektorbulan.push({label: 'Informal', value: data[7][i].total, total: data[6]});
            } else if (data[7][i].sektor == '2') {
              datasektorbulan.push({label: 'Formal', value: data[7][i].total, total: data[6]});
            }
          }
          if (datasektorbulan.length == 0) {
            datasektorbulan.push({label: "", value: ""});
          }

          if(datasektorbulan.length > 1) {
            sektorbulan.options.colors = ["#58A8CC","#0A384C"];
          } else if (datasektorbulan.length == 1 && datasektorbulan[0].label == "Informal") {
            sektorbulan.options.colors = ["#58A8CC"];
          } else if (datasektorbulan.length == 1 && datasektorbulan[0].label == "Formal") {
            sektorbulan.options.colors = ["#0A384C"];
          }
          sektorbulan.setData(datasektorbulan);

        }
      });
    });

  });

  </script>
