
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
                        <?php echo form_open(base_url('institution/add')) ?>

                            <div class="form-group">
                              <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Nama Negara <span class="required">*</span></label>
                              <div class="col-md-5 col-sm-5 col-xs-12">
                                <select name="name" id="name" required="required" class="select2_single form-control" tabindex="-1">
                                  <option></option>
                                  <?php foreach($country as $row): ?>
                                    <option value="<?php echo $row->nicename ?>"><?php echo $row->nicename ?></option>
                                  <?php endforeach; ?>
                                </select>
                              </div>
                            </div><br /><br /><br />

                            <div class="form-group">
                              <label class="control-label col-md-2 col-sm-2 col-xs-12">Endorsement Type <span class="required">*</span></label>
                              <div class="col-md-5 col-sm-5 col-xs-12">
                                <select name="type" required="required" class="select2_single form-control" tabindex="-1">
                                  <option></option>
                                  <option value="Agensi">Agensi</option>
                                  <option value="Agensi">Swainput</option>
                                </select>
                              </div>
                            </div><br /><br /><br />


                            <div class="form-group">
                              <label class="control-label col-md-2 col-sm-2 col-xs-12">Currency <span class="required">*</span></label>
                              <div class="col-md-5 col-sm-5 col-xs-12">
                                <select name="currency" required="required" class="select2_single form-control" tabindex="-1">
                                  <option></option>
                                  <?php foreach($currency as $row): ?>
                                    <option value="<?php echo $row->idcurrency ?>"><?php echo $row->currencyname ?> | <?php echo $row->kurs ?></option>
                                  <?php endforeach; ?>
                                </select>
                              </div>
                            </div><br /><br /><br />

                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="active">Is Active </label>
                                <div class="col-md-1 col-sm-1 col-xs-2">
                                    <input type="checkbox" name="active">
                                </div>
                            </div><br />

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
