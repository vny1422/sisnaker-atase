<style media="screen">
    .minilabel{
        padding-top: 5%;
        margin-right: -20%;
    }

    .kuota{
      margin-left: -5%;
    }

    .addButton{
      margin-left: -70%;
    }

    .remove_field{
      margin-left: -70%;
    }
</style>
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
              <strong>'.$this->session->flashdata('information').'</strong> 
            </div>
          </div>' ?>
        <?php endif; ?>
          <?php echo form_open(base_url('PKP/addPkp')) ?>

          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12">Agency <span class="required">*</span></label>
            <div class="col-md-5 col-sm-5 col-xs-12">
              <?php if (isset($dataagensi)) { ?>
                <select name="agensi" required="required" class="select2_single form-control" tabindex="-1" disabled>
                    <option value="<?php echo $dataagensi->agid ?>"><?php echo $dataagensi->agnama ?></option>
                </select>
                <input type="hidden" name="agensi" value="<?php echo $dataagensi->agid ?>"/>
              <?php } else{ ?>
                <select name="agensi" required="required" class="select2_single form-control" tabindex="-1">
                  <option></option>
                  <?php foreach($listagensi as $row): ?>
                    <option value="<?php echo $row->agid ?>"><?php echo $row->agnama ?></option>
                  <?php endforeach; ?>
                </select>
              <?php } ?>

            </div>
          </div><br /><br /><br />

          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12">PPTKIS <span class="required">*</span></label>
            <div class="col-md-5 col-sm-5 col-xs-12">
              <select name="pptkis" required="required" class="select2_single form-control" tabindex="-1">
                <option></option>
                <?php foreach($listpptkis as $row): ?>
                  <option value="<?php echo $row->ppkode ?>"><?php echo $row->ppnama ?></option>
                <?php endforeach; ?>
                <?php foreach($cekalpptkis as $row): ?>
                  <option value="<?php echo $row->ppkode ?>" disabled><?php echo $row->ppnama ?> (BANNED)</option>
                <?php endforeach; ?>
              </select>
            </div>
          </div><br /><br /><br />

          <div class="form-group" >
            <label class="col-sm-2 control-label">Start Date</label>
            <div class="col-sm-4">
              <div class="input-group date datepicker col-md-12 col-xs-12" data-provide="datepicker" ng-class="{'has-error':(pst && shForm.inDate.$invalid)}">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <input id="pkpstart" type="text" class="form-control tglformat" ng-model="shelterform['in']" name="start" required></input>
              </div>
            </div>
          </div><br /><br /><br /><br />

          <div class="form-group" >
            <label class="col-sm-2 control-label">End Date</label>
            <div class="col-sm-4">
              <div class="input-group date datepicker col-md-12 col-xs-12" data-provide="datepicker" ng-class="{'has-error':(pst && shForm.inDate.$invalid)}">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <input id="pkpend" type="text" class="form-control tglformat" ng-model="shelterform['in']" name="end" required></input>
              </div>
            </div>
          </div><br /><br /><br /><br />

          <div class="input_fields_wrap" id="wrapopsi">
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12">Job Type <span class="required">*</span></label>
            <div class="col-md-5">
              <select name="jenispekerjaan[]" required="required" class="select2_single form-control">
                <option></option>
                <?php foreach($listjenispekerjaan as $row): ?>
                  <option value="<?php echo $row->idjenispekerjaan ?>"><?php echo $row->namajenispekerjaan ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col-md-5">

            </div>
            <div class="col-md-1">
              <button type="button" class="btn btn-default addButton"><i class="fa fa-plus"></i></button>
            </div>
            <br /> <br /> <br />
            <div class="col-md-12">
              <div class="col-md-2">

              </div>
              <div class="col-md-6">
                <div class="col-md-4 kuota">
                  <label class="control-label col-md-4 minilabel" for="name">L</label>
                  <div class="col-md-8 ">
                    <input type="number" value="0" min="0" name="laki[]" class="form-control">
                  </div>
                </div>

                <div class="col-md-4 kuota">
                  <label class="control-label col-md-4 minilabel" for="name">P</label>
                  <div class="col-md-8">
                    <input type="number" value="0" min="0" name="perempuan[]" class="form-control">
                  </div>
                </div>

                <div class="col-md-4 kuota">
                  <label class="control-label col-md-4 minilabel" for="name">C</label>
                  <div class="col-md-8">
                    <input type="number" value="0" min="0" name="campuran[]" class="form-control">
                  </div>
                </div>
              </div>


            </div>
          </div>
        </div>
        <br /><br /><br /><br />



        <div class="ln_solid"></div>
        <div class="form-group">
          <div class="col-md-6 col-sm-6 col-xs-12">
            <button type="reset" class="btn btn-primary">Cancel</button>
            <button type="submit" class="btn btn-success">Submit</button>
          </div>
        </div>

        </form>

      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
  var wrapper         = $("#wrapconn"); //Fields wrapper
  var wrapopsi        = $("#wrapopsi"); //Fields wrapper
  var add_button      = $(".addButton"); //Add button ID


  $(add_button).click(function(e){ //on add input button click
    e.preventDefault();
    $(wrapopsi).append('<div class="form-group">\
                  <br /> <br /> <br />\
                  <label class="control-label col-md-2 col-sm-2 col-xs-12"></label>\
                  <div class="col-md-5">\
                    <select name="jenispekerjaan[]" required="required" class="select2_single form-control">\
                      <option></option>\
                      <?php foreach($listjenispekerjaan as $row): ?>\
                        <option value="<?php echo $row->idjenispekerjaan ?>"><?php echo $row->namajenispekerjaan ?></option>\
                      <?php endforeach; ?>\
                    </select>\
                  </div>\
                  <div class="col-md-5">\
      \
                  </div>\
                  <div class="col-md-1">\
                    <button type="button" class="btn btn-default remove_field"><i class="fa fa-trash"></i></button>\
                  </div>\
                  <br /> <br /> <br />\
                  <div class="col-md-12">\
                    <div class="col-md-2">\
      \
                    </div>\
                    <div class="col-md-5">\
                      <div class="col-md-4 kuota">\
                        <label class="control-label col-md-4 minilabel" for="name">L</label>\
                        <div class="col-md-8 ">\
                          <input type="number" value="0" min="0" name="laki[]" class="form-control">\
                        </div>\
                      </div>\
      \
                      <div class="col-md-4 kuota">\
                        <label class="control-label col-md-4 minilabel" for="name">P</label>\
                        <div class="col-md-8">\
                          <input type="number" value="0" min="0" name="perempuan[]" class="form-control">\
                        </div>\
                      </div>\
      \
                      <div class="col-md-4 kuota">\
                        <label class="control-label col-md-4 minilabel" for="name">C</label>\
                        <div class="col-md-8">\
                          <input type="number" value="0" min="0" name="campuran[]" class="form-control">\
                        </div>\
                      </div>\
                    </div>\
      \
      \
                  </div>\
                </div>'); //add input box
  });

  $(wrapopsi).on("click",".remove_field", function(e){ //user click on remove text
    e.preventDefault();
    $(this).closest('.form-group').remove();
  })

});
</script>
