
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
          if ($error != "" && $error != "You did not select a file to upload.") {
            echo "<div class=\"well well-sm\">";
            echo $error;
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

          <form enctype="multipart/form-data" action="<?php echo base_url('user/profile') ?>" method="post">

            <div class="row">
              <div class="col-md-5 col-sm-12 col-xs-12">
                <div class="form-group">
                  <label class="control-label col-md-4" for="name">Name </label>
                  <div class="col-md-8">
                    <?php echo $values->name ?>
                  </div>
                </div><br /><br />
                <div class="form-group">
                  <label class="control-label col-md-4" for="institution">Institution </label>
                  <div class="col-md-8">
                    <?php echo $namainstitusi ?>
                  </div>
                </div><br /><br />
                <div class="form-group">
                  <label class="control-label col-md-4" for="kantor">Office </label>
                  <div class="col-md-8">
                    <?php echo $namakantor ?>
                  </div>
                </div><br /><br />
                <div class="form-group">
                  <label class="control-label col-md-4" for="username">Username </label>
                  <div class="col-md-8">
                    <?php echo $values->username ?>
                  </div>
                </div><br /><br />
                <div class="form-group">
                  <label class="control-label col-md-4" for="passlama">Old Password </label>
                  <input class="col-md-6" type="password" name="passlama">
                  <div class="col-md-2"></div>
                </div><br /><br />
                <div class="form-group">
                  <label class="control-label col-md-4" for="passbaru">New Password </label>
                  <input class="col-md-6" id="password" type="password" name="passbaru" >
                  <div class="col-md-2"></div>
                </div><br /><br />
                <div class="form-group">
                  <label class="control-label col-md-4" for="confirmpassbaru">Confirm Password </label>
                  <input class="col-md-6" id="confirm_password" type="password" name="confirmpassbaru" >
                  <div class="col-md-2"></div>
                </div><br /><br />
                <div class="form-group">
                  <span class="control-label col-md-4"> </span>
                  <span class="col-md-4 col-sm-4 col-xs-12" id='message'></span>
                </div>
              </div>
              <div class="col-md-7 col-sm-12 col-xs-12">
                <img id="pic" src="<?php echo ($values->picture != "" ? base_url('assets/images/'.$values->picture) : base_url('assets/images/user.png')); ?>" alt="Profile Picture" style="width:150px;height:150px;">
                <input id="uppic" type="file" name="picture" class="form-control" style="width:150px;" onchange="readURL(this);">
              </div>
            </div>

            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-6 col-sm-6 col-xs-12">
                <button id="cancel" type="reset" name="cancel" class="btn btn-primary">Cancel</button>
                <button type="submit" name="submit" class="btn btn-success">Update</button>
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>

  <script>
  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      var fileType = input.files[0]["type"];
      var ValidImageTypes = ["image/jpeg", "image/png"];
      if ($.inArray(fileType, ValidImageTypes) < 0) {
        alert("Invalid File");
        $("#uppic").val("");
      } else {
        reader.onload = function (e) {
          $('#pic')
          .attr('src', e.target.result)
          .width(150)
          .height(150);
        };

        reader.readAsDataURL(input.files[0]);
      }
    }
  }

  $('#password, #confirm_password').on('keyup', function () {
    if ($('#password').val() == $('#confirm_password').val() && $('#password').val() != "" && $('#confirm_password').val() != "") {
      $('#message').html('Password Matched').css('color', 'green');
    } else
    $('#message').html('Password Not Matched').css('color', 'red');
  });

  $('form').submit(function() {
    if ( $("#message").html() === "Password Matched" || ($('#password').val() == "" && $("#uppic").val() != "")) {
      return true;
    } else {
      return false;
    }
  });

  $("#cancel").click(function( event ) {
    $('#message').html('');
  });

</script>
