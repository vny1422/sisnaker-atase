
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
                                <?php if($this->session->flashdata('information') != ""): ?>
                                <?php echo '<div class="container">
                                  <div class="alert alert-success fade in">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>Selamat!</strong> '.$this->session->flashdata('information').'
                                  </div>
                                </div>' ?>
                              <?php endif; ?>
                        <?php echo form_open(base_url('wilayah/add')) ?>

                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Name <span class="required">*</span></label>
                            <div class="col-md-5 col-sm-5 col-xs-12">
                                <input type="text" name="name" required="required" class="form-control">
                            </div>
                        </div><br /><br />


                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <button type="reset" name="cancel" class="btn btn-primary">Cancel</button>
                            <button type="submit" name="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
