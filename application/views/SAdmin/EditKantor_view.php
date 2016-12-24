
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

            <?php echo form_open(base_url('kantor/edit/'.$values->idkantor)) ?>

            <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Name <span class="required">*</span></label>
                <div class="col-md-5 col-sm-5 col-xs-12">
                    <input type="text" name="name" value="<?php echo $values->namakantor ?>" required="required" class="form-control">
                </div>
            </div><br /><br /><br />

            <?php if($this->session->userdata('role') == 1):
            echo '<div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12">Institution <span class="required">*</span></label>
            <div class="col-md-5 col-sm-5 col-xs-12">
              <select name="institution" required="required" class="select2_single form-control" tabindex="-1">
                <option></option>';
                elseif($this->session->userdata('role') == 2):
                    echo '<div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Institution <span class="required">*</span></label>
                <div class="col-md-5 col-sm-5 col-xs-12">
                  <select name="institution" disabled required="required" class="select2_single form-control" tabindex="0">';
                    endif; ?>
                    <?php foreach($listinstitution as $row): ?>
                        <option value="<?php echo $row->idinstitution ?>" <?php if ($row->idinstitution == $values->idinstitution) echo 'selected'?>><?php echo $row->nameinstitution ?></option>
                    <?php endforeach; ?>
                </select>
                <?php if($this->session->userdata('role') == 2):
                echo '<input type="hidden" name="institution"value="'.$row->idinstitution.'" />';
                endif; ?>
            </div>
        </div>
        <br /><br /><br />

        <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="active">Is Active </label>
            <div class="col-md-1 col-sm-1 col-xs-2">
                <input type="checkbox" name="active" <?php if($values->isactive == 1) echo 'checked';?>>
            </div>
        </div><br />

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
