
<!-- page content -->
<div class="right_col" role="main">

    <div class="row">
    </div>
    <br />

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2><strong><?php echo $subtitle; ?></strong></h2>
            <div class="clearfix"></div>
        </br>
        <blockquote>
            <p>You can use this form to update your agency's data.</p>
            <p>Your agency can only update the data <strong>up to 3 (three) times in a year.</strong></p>
        </blockquote>
        <div class="x_content">
            <?php
            if (validation_errors() != "") {
                echo "<div class=\"well well-sm\">";
                echo validation_errors();
                echo "</div>";
            }
            ?>
            <?php if($this->session->flashdata('information') != ""): ?>
                <?php echo '<div class="container">
                <div class="alert alert-success fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Notification: </strong> '.$this->session->flashdata('information').'
                </div>
            </div>' ?>
        <?php endif; ?>
        <?php if($this->session->flashdata('warning') != ""): ?>
            <?php echo '<div class="container">
            <div class="alert alert-danger fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Notification: </strong> '.$this->session->flashdata('warning').'
            </div>
        </div>' ?>
    <?php endif; ?>
        <br/>
        <?php echo form_open(base_url('Endorsement/updateagency')) ?>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Official Company Email <span class="required">*</span></label>
            <div class="col-md-5 col-sm-5 col-xs-12">
                <input type="text" name="email" value="<?php echo $values->agemail ?>" required="required" class="form-control">
            </div>
        </div><br /><br /><br />
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Agency Name <span class="required">*</span></label>
            <div class="col-md-5 col-sm-5 col-xs-12">
                <input type="text" name="name" value="<?php echo $values->agnama ?>" required="required" class="form-control">
            </div>
        </div><br /><br /><br />
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Agency Name (Local Languange)<span class="required">*</span></label>
            <div class="col-md-5 col-sm-5 col-xs-12">
                <input type="text" name="nameother" value="<?php echo $values->agnamaoth ?>" required="required" class="form-control">
            </div>
        </div><br /><br /><br />

        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Local Goverments Recruitment Letter<span class="required">*</span></label>
            <div class="col-md-5 col-sm-5 col-xs-12">
                <input type="text" name="noijin" value="<?php echo $values->agnoijincla ?>" required="required" class="form-control">
            </div>
        </div><br /><br /><br />

        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Office Address <span class="required">*</span></label>
            <div class="col-md-5 col-sm-5 col-xs-12">
                <input type="text" name="address" value="<?php echo $values->agalmtkantor ?>" required="required" class="form-control">
            </div>
        </div><br /><br /><br />

        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Office Address (Local Languange)<span class="required">*</span></label>
            <div class="col-md-5 col-sm-5 col-xs-12">
                <input type="text" name="addressother" value="<?php echo $values->agalmtkantoroth ?>" required="required" class="form-control">
            </div>
        </div><br /><br /><br />

        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Authorized Person Name<span class="required">*</span></label>
            <div class="col-md-5 col-sm-5 col-xs-12">
                <input type="text" name="penanggung" value="<?php echo $values->agpngjwb ?>" required="required" class="form-control">
            </div>
        </div><br /><br /><br />

        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Authorized Person Name (Local Languange)<span class="required">*</span></label>
            <div class="col-md-5 col-sm-5 col-xs-12">
                <input type="text" name="penanggungother" value="<?php echo $values->agpngjwboth ?>" required="required" class="form-control">
            </div>
        </div><br /><br /><br />

        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Phone<span class="required">*</span></label>
            <div class="col-md-5 col-sm-5 col-xs-12">
                <input type="text" name="notelp" value="<?php echo $values->agtelp ?>" required="required" class="form-control">
            </div>
        </div><br /><br /><br />

        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Fax<span class="required">*</span></label>
            <div class="col-md-5 col-sm-5 col-xs-12">
                <input type="text" name="nofax" value="<?php echo $values->agfax ?>" required="required" class="form-control">
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
<div></br></br></br></div>
</div>
