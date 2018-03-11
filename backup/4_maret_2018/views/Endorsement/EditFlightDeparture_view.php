
<!-- page content -->
<div class="right_col" role="main">

    <div class="row"></div>
    <br />

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
              <h2><strong><?php echo $subtitle; ?></strong></h2>
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

            <?php echo form_open(base_url('flight/departure/edit/'.$values->keberangkatanid)) ?>

            <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="paspor">Paspor </label>
                <div class="col-md-5 col-sm-5 col-xs-12">
                    <input type="text" name="paspor" value ="<?php echo $values->tkpaspor ?>" required="required" class="form-control" readonly>
                </div>
            </div><br /><br /><br /><br />
            <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="bandaracode">Kode Bandara <span class="required">*</span></label>
                <div class="col-md-5 col-sm-5 col-xs-12">
                    <input type="text" name="bandaracode" value ="<?php echo $values->bandaracode ?>" required="required" class="form-control">
                </div>
            </div><br /><br /><br />
            <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="transitport">Transit Port <span class="required">*</span></label>
                <div class="col-md-5 col-sm-5 col-xs-12">
                    <input type="text" name="transitport" value ="<?php echo $values->transitport ?>" required="required" class="form-control">
                </div>
            </div><br /><br /><br />
            <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="timestamp">Timestamp </label>
                <div class="col-md-5 col-sm-5 col-xs-12">
                    <input type="text" name="timestamp" value ="<?php echo $values->timestamp ?>" class="form-control">
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
</div>
