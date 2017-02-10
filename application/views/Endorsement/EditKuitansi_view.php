
<!-- page content -->
<div class="right_col" role="main">

    <div class="row">
    </div>
    <br />

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2><strong><?php echo $title; ?></strong></h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <?php
            if (validation_errors() != "") {
                echo "<div class=\"well well-sm\">";
                echo validation_errors();
                echo "</div>";
            }
            ?>
            <?php echo form_open(base_url('kuitansi/edit/'.$values->kuid)) ?>

            <div class="form-group">
              <label>Tanggal Masuk</label>
              <div class="input-group date datepicker col-md-3 col-xs-3 " data-provide="datepicker" ng-model="formdata['tglmasukTW']" ng-disabled="disableAll" >
                <span class="glyphicon glyphicon-th input-group-addon"></span>
                <input type="text" name="kutglmasuk" value="<?php echo $values->kutglmasuk ?>" id="tglubah" class="form-control">
            </div>
        </div> <br/>

        <div class="form-group">
          <label>Tanggal Kuitansi </label>
          <div class="input-group date datepicker col-md-3 col-xs-3 " data-provide="datepicker" ng-model="formdata['tglmasukTW']" ng-disabled="disableAll" >

            <span class="glyphicon glyphicon-th input-group-addon"></span>
            <input type="text" name="kutglkuitansi" value="<?php echo $values->kutglkuitansi; ?>" id="tglubah" class="form-control">
        </div>
    </div> <br/><br/>

    <div class="form-group">
        <label class="control-label col-md-2 col-sm-2 col-xs-12">Jenis Dokumen <span class="required">*</span></label>
        <div class="col-md-5 col-sm-5 col-xs-12">
          <select name="idtipe" required="required" class="select2_single form-control" tabindex="-1">
            <option></option>
            <?php foreach ($listtipe as $row): ?>
                <option value="<?php echo $row->idtipe?>" 
                    <?php if ($row->idtipe == $values->idtipe) echo 'selected' ?>>
                    <?php echo $row->tipe; ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
</div>
<br /><br /><br />



<div class="form-group">
    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="type">Nomor Kuitansi <span class="required">*</span></label>
    <div class="col-md-5 col-sm-5 col-xs-12">
        <input type="text" name="noku" value="<?php echo $values->kuno ?>" required="required" class="form-control">
    </div>
</div><br /><br /><br />

<div class="form-group">
    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="type">Terbayar <span class="required">*</span></label>
    <div class="col-md-5 col-sm-5 col-xs-12">
        <input type="text" name="kujmlbayar" value="<?php echo $values->kujmlbayar; ?>" required="required" class="form-control">
    </div>
</div><br /><br /><br />

<div class="form-group">
    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="type">Nama Pemohon <span class="required">*</span></label>
    <div class="col-md-5 col-sm-5 col-xs-12">
        <input type="text" name="kupemohon" value="<?php echo $values->kupemohon; ?>" required="required" class="form-control">
    </div>
</div><br /><br /><br />

<div class="ln_solid"></div>
<div class="form-group">
    <div class="col-md-6 col-sm-6 col-xs-12">
        <button type="reset" name="cancel" class="btn btn-primary">Cancel</button>
        <button type="submit" name="submit" class="btn btn-success">Update</button>
    </div>
</div>

</form>
</div>
</div>
</div>
</div>