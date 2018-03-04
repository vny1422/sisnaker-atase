
<?php
  $monthDict = array(
    'Januari',
    'Februari',
    'Maret',
    'April',
    'Mei',
    'Juni',
    'Juli',
    'Agustus',
    'September',
    'Oktober',
    'Nopember',
    'Desember'
  );
?>

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
              <label class="control-label col-md-2 col-sm-2 col-xs-12">Bulan dan Tahun : <span class="required">*</span></label>
              <div class="col-md-5 col-sm-5 col-xs-12">
                  <select name="rekap" id="rekap" required="required" class="select2_single form-control" tabindex="0">
                  <option value=""></option>
                  <?php
                  for ($i = $startYear; $i <= $year; $i++) {
                    $k = 1;
                    if ($i == $startYear) {
                      $k = 12;
                    }

                    for ($j = $k; $j <= 12; $j++) {
                      if ($i >= $year && $j > $month) {
                        break;
                      }
                      ?>
                      <option value="<?=$i."-".$j?>"><?=$monthDict[$j-1] . " " . $i?></option>
                      <?php
                    }
                  }
                  ?>
                </select>
            </div>
          </div>
          <br /><br /><br />
          <div id="download" style="display:none;" class="row">
            <div class="space"></div>
            <p>
              <ul>
                <li><a id="d1" href="#">Rekap Penerimaan Endorsement</a></li>
                <li><a id="d2" href="#">Rekap Job Order</a></li>
                <li><a id="d3" href="#">Rekap Data TKI Masuk di Endorsement</a></li>
              </ul>
            </p>
          </div>

      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function () {
    $("#rekap").change(function(){
      var download = $("#download");
      if ($(this).val()) {
        download.find("a#d1").attr("href", "<?php echo base_url()?>rekapendorsement/rekapKuitansi/" + $(this).val());
        download.find("a#d2").attr("href", "<?php echo base_url()?>rekapendorsement/rekapJO/" + $(this).val());
        download.find("a#d3").attr("href", "<?php echo base_url()?>rekapendorsement/rekapTKI/" + $(this).val());
        download.show();
      } else {
        download.find("a#d1").attr("href", "#");
        download.find("a#d2").attr("href", "#");
        download.find("a#d3").attr("href", "#");
        download.hide();
      }
    });
  });
  </script>
