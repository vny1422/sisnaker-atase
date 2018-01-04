<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">

  <!-- Bootstrap -->
  <link href="<?php echo base_url('assets/vendors/bootstrap/dist/css/bootstrap.min.css'); ?>" rel="stylesheet">
  <link href="<?php echo base_url('assets/vendors/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet">

  <!-- jQuery -->
  <script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>

  <style>
  .kiri{
    background-color: #015249;
    height: 768px;
    width: 50%;
    padding-top: 10%;
  }

  .kanan{
    background-color: white;
    height: 768px;
    width: 50%;
    padding-top: 20%;
  }

  .logo{
    width: 35%;
  }

  .text-white{
    color: white;
    font-family: Calibri, Georgia, Serif;
  }

  .text-black{
    color: black;
    font-family: Calibri, Georgia, Serif;
  }

  .container { white-space: nowrap; }
  .column { display: inline-block; width: 100%; white-space: normal; }

  a{
    color: black;
  }

  a:hover{
    color : #7e7e7e;
  }

  .tombol{
    margin-top: 5%;
  }
  </style>

  <title>SISNAKER - ATASE</title>
</head>
<body>



  <div class="row text-white">
    <div class="col-md-6 kiri text-center">
      <div id="sec-bg-1" class="content" >
        <img style="text-align:center;" class="logo" src="<?php echo base_url('assets/images/logo_kemnaker_white.png'); ?>">
        <h1 class=""><b>ONLINE - ATNAKER</b></h1>
        <div class="control-label form-gorup">
          <div class="col-md-3">

          </div>
          <div id="sec1" class="col-md-6">
            <label>Pick Your Country</label>
            <select id="institusi" class="form-control select input-sm" name="">
              <option value="" placeholder="Choose"></option>
              <option value="ar">Arab Saudi</option>
              <option value="hk">Hongkong</option>
              <option value="kw">Kuwait</option>
              <option value="ml">Malaysia</option>
              <option value="sg">Singapore</option>
              <option value="tw">Taiwan</option>
              <option value="uae">Uni Emirate Arab</option>
            </select>
          </div>

          <div id="sec2-ar" class="col-md-6" style="display:none;">
            <h4><a id="kbriyadh" class="btn btn-default" href="#">Embassy of The Republic of Indonesia in Riyadh</a></h4>
            <h4><a id="kjjeddah" class="btn btn-default" href="#">Consulate General of The Republic of Indonesia in Jeddah</a></h4>
            <br> <a href="#" class="back btn btn-warning input-sm btn-sm">Back</a>
          </div>

          <div id="sec2-hk" class="col-md-6" style="display:none;">
            <a id="kjhk" href="#" class="btn btn-default">Consulate General of The Republic of Indonesia in Hongkong</a> <br>
            <br> <a  href="#" class="back btn btn-warning input-sm btn-sm">Back</a>
          </div>

          <div id="sec2-kw" class="col-md-6" style="display:none;">
            <a id="kbkw" href="#" class="btn btn-default">Embassy of The Republic of Indonesia in Kuwait</a> <br>
            <br> <a href="#" class="back btn btn-warning input-sm btn-sm">Back</a>
          </div>

          <div id="sec2-ml" class="col-md-6" style="display:none;">
            <h4><a id="kbkl" class="btn btn-default" href="#">Embassy of The Republic of Indonesia in Kuala Lumpur</a></h4>
            <h4><a id="kjjohor" class="btn btn-default" href="#">Consulate General of The Republic of Indonesia in Johor Bahru</a></h4>
            <h4><a id="kjpenang" class="btn btn-default" href="#">Consulate General of The Republic of Indonesia in Penang</a></h4>
            <h4><a id="kjkuching" class="btn btn-default" href="#">Consulate General of The Republic of Indonesia in Kuching Sarawak</a></h4>
            <h4><a id="kjkina" class="btn btn-default" href="#">Consulate General of The Republic of Indonesia in Kota Kinabalu</a></h4>
            <h4><a id="kjtawau" class="btn btn-default" href="#">Consulate General of The Republic of Indonesia in Tawau</a></h4>
            <br> <a href="#" class="back btn btn-warning input-sm btn-sm">Back</a>
          </div>

          <div id="sec2-sg" class="col-md-6" style="display:none;">
            <h4><a id="kjsg" class="btn btn-default" href="#">Embassy of The Republic of Indonesia in Singapore</a></h4>
            <br> <a href="#" class="back btn btn-warning input-sm btn-sm">Back</a>
          </div>

          <div id="sec2-tw" class="col-md-6" style="display:none;">
            <h4><a id="kdtai" class="btn btn-default" href="#">Indonesian Economic and Trade Office to Taipei</a></h4>
            <br> <a href="#" class="back btn btn-warning input-sm btn-sm">Back</a>
          </div>

          <div id="sec2-uae" class="col-md-6" style="display:none;">
            <h4><a id="kbabu"class="btn btn-default" href="#">Embassy of The Republic of Indonesia in Abu Dhabi</a> <br></h4>
            <h4><a id="kjdubai" class="btn btn-default" href="#">Consulate General of The Republic of Indonesia in Dubai</a> <br></h4>
            <br> <a href="#" class="back btn btn-warning input-sm btn-sm">Back</a>
          </div>
          <div class="col-md-3">
          </div>
        </div>
      </div>

      <div id="sec-bg-2" class="content"  style="display:none">
        <img style="text-align:center;" class="logo" src="<?php echo base_url('assets/images/garuda.png'); ?>">


        <div class="control-label form-gorup">
          <div class="col-md-3">

          </div>
          <div id="sec1" class="col-md-6">
            <h3 id="dkbriyadh" style="display:none;"><b>Embassy of The Republic of Indonesia in Riyadh</b></h3>
            <h3 id="dkjjeddah" style="display:none;"><b>Consulate General of The Republic of Indonesia in Jeddah</b></h3>


            <h3 id="dkjhk" style="display:none;"><b>Consulate General of The Republic of Indonesia in Hongkong</b></h3>

            <h3 id="dkbkw" style="display:none;"><b>Embassy of The Republic of Indonesia in Kuwait</b></h3>

            <h3 id="dkbkl" style="display:none;"><b>Embassy of The Republic of Indonesia in Kuala Lumpur</b></h3>
            <h3 id="dkjjohor" style="display:none;"><b>Consulate General of The Republic of Indonesia in Johor</b></h3>
            <h3 id="dkjpenang" style="display:none;"><b>Consulate General of The Republic of Indonesia in Penang</b></h3>
            <h3 id="dkjkuching" style="display:none;"><b>Consulate General of The Republic of Indonesia in Kuching Sarawak</b></h3>
            <h3 id="dkjkina" style="display:none;"><b>Consulate General of The Republic of Indonesia in Kota Kinabalu</b></h3>
            <h3 id="dkjtawau" style="display:none;"><b>Consulate General of The Republic of Indonesia in Tawau</b></h3>


            <h3 id="dkjsg" style="display:none;"><b>Consulate General of The Republic of Indonesia in Singapore</b></h3>

            <h3 id="dkdtai" style="display:none;"><b>Indonesian Economic and Trade Office to Taipei</b></h3>

            <h3 id="dkbabu" style="display:none;"><b>Embassy of The Republic of Indonesia in Abu Dhabi</b></h3>
            <h3 id="dkjdubai" style="display:none;"><b>Consulate General of The Republic of Indonesia in Dubai</b></h3>



            <br><br><br><br>
            <img style="text-align:center; width:20%" src="<?php echo base_url('assets/images/sisnaker_logo_white.png'); ?>">
            <h4 class=""><b>ONLINE - ATNAKER</b></h4>
          </div>



          <div class="col-md-3">
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-6 kanan text-black">
      <section class="login_content">
        <div style="padding-top:30px" class="panel-body">
          <?php if(validation_errors()) {?>
            <div class="row">
              <div class="col-lg-12">
                <div class="alert alert-danger alert-dismissable">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h4><i class="fa fa-warning"></i> Warning!</h4>
                  <?php echo validation_errors()?>
                </div>
              </div>
            </div>
          <?php }?>
          <?php echo form_open(base_url('login')) ?>
          <form id="loginform" method="post">
            <div class="col-md-12">
              <div class="col-md-2">

              </div>
              <div class="col-md-8">
                <input type="text" name="username" class="form-control" placeholder="Username" required="" /> </br>
                <input type="password" name="password" class="form-control" placeholder="Password" required="" />
              </br>
              <button class="btn btn-success submit" value="Login" type="submit" name="button">LOGIN</button>


              <br><br><br><br><br>
              <h5 id="daftar" style="display:none;"><a href="<?php echo base_url() ?>Login/Daftar">For Agency, click to apply for user name</a></h5>
              <h5 id="usermanual"><a href="<?php echo base_url() ?>uploads/SISNAKER_MANUAL.pdf" target="_blank">For tutorial, please download this document</a></h5>

            </div>
            <div class="col-md-2">

            </div>
          </div>
        </form>
      </div>
    </section>
  </div>

</div>

</body>
</html>

<script type="text/javascript">

$(document).ready(function() {
  $('select').on('change', function(){
    //alert( this.value );
    $("#sec1").hide(1000);
    if(this.value == "ar"){
      $("#sec2-ar").show(1000);
    }
    else if (this.value == "hk") {
      $("#sec2-hk").show(1000);
    }
    else if (this.value == "kw") {
      $("#sec2-kw").show(1000);
    }
    else if (this.value == "ml") {
      $("#sec2-ml").show(1000);
    }
    else if (this.value == "sg") {
      $("#sec2-sg").show(1000);
    }
    else if (this.value == "tw") {
      $("#sec2-tw").show(1000);
    }
    else{
      $("#sec2-uae").show(1000);
    }

  });

  $('.back').on('click', function(){
    $("#sec2-ar").hide();
    $("#sec2-hk").hide();
    $("#sec2-kw").hide();
    $("#sec2-ml").hide();
    $("#sec2-sg").hide();
    $("#sec2-tw").hide();
    $("#sec2-uae").hide();
    $("#sec1").show(1000);
  });

  $('.btn-default').on('click', function(){
    $("#sec2-ar").hide();
    $("#sec2-hk").hide();
    $("#sec2-kw").hide();
    $("#sec2-ml").hide();
    $("#sec2-sg").hide();
    $("#sec2-tw").hide();
    $("#sec2-uae").hide();
    $("#sec1").show(1000);
  });

  $('#kbriyadh').on('click', function(){
    $("#sec-bg-1").hide();
    $("#sec-bg-2").show(1000);
    $("#dkbriyadh").show();
    $("#dkjjeddah").hide();
    $("#dkjhk").hide();
    $("#dkbkw").hide();
    $("#dkbkl").hide();
    $("#dkjjohor").hide();
    $("#dkjpenang").hide();
    $("#dkjkuching").hide();
    $("#dkjkina").hide();
    $("#dkjtawau").hide();
    $("#dkjsg").hide();
    $("#dkdtai").hide();
    $("#dkbabu").hide();
    $("#dkjdubai").hide();
  });

  $('#kjjeddah').on('click', function(){
    $("#sec-bg-1").hide();
    $("#sec-bg-2").show(1000);
    $("#dkbriyadh").hide();
    $("#dkjjeddah").show();
    $("#dkjhk").hide();
    $("#dkbkw").hide();
    $("#dkbkl").hide();
    $("#dkjjohor").hide();
    $("#dkjpenang").hide();
    $("#dkjkuching").hide();
    $("#dkjkina").hide();
    $("#dkjtawau").hide();
    $("#dkjsg").hide();
    $("#dkdtai").hide();
    $("#dkbabu").hide();
    $("#dkjdubai").hide();
  });

  $('#kjhk').on('click', function(){
    $("#daftar").show(1000);
    $("#sec-bg-1").hide();
    $("#sec-bg-2").show(1000);
    $("#dkbriyadh").hide();
    $("#dkjjeddah").hide();
    $("#dkjhk").show();
    $("#dkbkw").hide();
    $("#dkbkl").hide();
    $("#dkjjohor").hide();
    $("#dkjpenang").hide();
    $("#dkjkuching").hide();
    $("#dkjkina").hide();
    $("#dkjtawau").hide();
    $("#dkjsg").hide();
    $("#dkdtai").hide();
    $("#dkbabu").hide();
    $("#dkjdubai").hide();
  });

  $('#kbkw').on('click', function(){
    $("#sec-bg-1").hide();
    $("#sec-bg-2").show(1000);
    $("#dkbriyadh").hide();
    $("#dkjjeddah").hide();
    $("#dkjhk").hide();
    $("#dkbkw").show();
    $("#dkbkl").hide();
    $("#dkjjohor").hide();
    $("#dkjpenang").hide();
    $("#dkjkuching").hide();
    $("#dkjkina").hide();
    $("#dkjtawau").hide();
    $("#dkjsg").hide();
    $("#dkdtai").hide();
    $("#dkbabu").hide();
    $("#dkjdubai").hide();
  });

  $('#kbkl').on('click', function(){
    $("#sec-bg-1").hide();
    $("#sec-bg-2").show(1000);
    $("#dkbriyadh").hide();
    $("#dkjjeddah").hide();
    $("#dkjhk").hide();
    $("#dkbkw").hide();
    $("#dkbkl").show();
    $("#dkjjohor").hide();
    $("#dkjpenang").hide();
    $("#dkjkuching").hide();
    $("#dkjkina").hide();
    $("#dkjtawau").hide();
    $("#dkjsg").hide();
    $("#dkdtai").hide();
    $("#dkbabu").hide();
    $("#dkjdubai").hide();
  });

  $('#kjjohor').on('click', function(){
    $("#sec-bg-1").hide();
    $("#sec-bg-2").show(1000);
    $("#dkbriyadh").hide();
    $("#dkjjeddah").hide();
    $("#dkjhk").hide();
    $("#dkbkw").hide();
    $("#dkbkl").hide();
    $("#dkjjohor").show();
    $("#dkjpenang").hide();
    $("#dkjkuching").hide();
    $("#dkjkina").hide();
    $("#dkjtawau").hide();
    $("#dkjsg").hide();
    $("#dkdtai").hide();
    $("#dkbabu").hide();
    $("#dkjdubai").hide();
  });

  $('#kjpenang').on('click', function(){
    $("#sec-bg-1").hide();
    $("#sec-bg-2").show(1000);
    $("#dkbriyadh").hide();
    $("#dkjjeddah").hide();
    $("#dkjhk").hide();
    $("#dkbkw").hide();
    $("#dkbkl").hide();
    $("#dkjjohor").hide();
    $("#dkjpenang").show();
    $("#dkjkuching").hide();
    $("#dkjkina").hide();
    $("#dkjtawau").hide();
    $("#dkjsg").hide();
    $("#dkdtai").hide();
    $("#dkbabu").hide();
    $("#dkjdubai").hide();
  });

  $('#kjkuching').on('click', function(){
    $("#sec-bg-1").hide();
    $("#sec-bg-2").show(1000);
    $("#dkbriyadh").hide();
    $("#dkjjeddah").hide();
    $("#dkjhk").hide();
    $("#dkbkw").hide();
    $("#dkbkl").hide();
    $("#dkjjohor").hide();
    $("#dkjpenang").hide();
    $("#dkjkuching").show();
    $("#dkjkina").hide();
    $("#dkjtawau").hide();
    $("#dkjsg").hide();
    $("#dkdtai").hide();
    $("#dkbabu").hide();
    $("#dkjdubai").hide();
  });

  $('#kjkina').on('click', function(){
    $("#sec-bg-1").hide();
    $("#sec-bg-2").show(1000);
    $("#dkbriyadh").hide();
    $("#dkjjeddah").hide();
    $("#dkjhk").hide();
    $("#dkbkw").hide();
    $("#dkbkl").hide();
    $("#dkjjohor").hide();
    $("#dkjpenang").hide();
    $("#dkjkuching").hide();
    $("#dkjkina").show();
    $("#dkjtawau").hide();
    $("#dkjsg").hide();
    $("#dkdtai").hide();
    $("#dkbabu").hide();
    $("#dkjdubai").hide();
  });

  $('#kjtawau').on('click', function(){
    $("#sec-bg-1").hide();
    $("#sec-bg-2").show(1000);
    $("#dkbriyadh").hide();
    $("#dkjjeddah").hide();
    $("#dkjhk").hide();
    $("#dkbkw").hide();
    $("#dkbkl").hide();
    $("#dkjjohor").hide();
    $("#dkjpenang").hide();
    $("#dkjkuching").hide();
    $("#dkjkina").hide();
    $("#dkjtawau").show();
    $("#dkjsg").hide();
    $("#dkdtai").hide();
    $("#dkbabu").hide();
    $("#dkjdubai").hide();
  });

  $('#kjsg').on('click', function(){
    $("#daftar").show(1000);
    $("#sec-bg-1").hide();
    $("#sec-bg-2").show(1000);
    $("#dkbriyadh").hide();
    $("#dkjjeddah").hide();
    $("#dkjhk").hide();
    $("#dkbkw").hide();
    $("#dkbkl").hide();
    $("#dkjjohor").hide();
    $("#dkjpenang").hide();
    $("#dkjkuching").hide();
    $("#dkjkina").hide();
    $("#dkjtawau").hide();
    $("#dkjsg").show();
    $("#dkdtai").hide();
    $("#dkbabu").hide();
    $("#dkjdubai").hide();
  });

  $('#kdtai').on('click', function(){
    $("#daftar").show(1000);
    $("#sec-bg-1").hide();
    $("#sec-bg-2").show(1000);
    $("#dkbriyadh").hide();
    $("#dkjjeddah").hide();
    $("#dkjhk").hide();
    $("#dkbkw").hide();
    $("#dkbkl").hide();
    $("#dkjjohor").hide();
    $("#dkjpenang").hide();
    $("#dkjkuching").hide();
    $("#dkjkina").hide();
    $("#dkjtawau").hide();
    $("#dkjsg").hide();
    $("#dkdtai").show();
    $("#dkbabu").hide();
    $("#dkjdubai").hide();
  });

  $('#kbabu').on('click', function(){
    $("#daftar").show(1000);
    $("#sec-bg-1").hide();
    $("#sec-bg-2").show(1000);
    $("#dkbriyadh").hide();
    $("#dkjjeddah").hide();
    $("#dkjhk").hide();
    $("#dkbkw").hide();
    $("#dkbkl").hide();
    $("#dkjjohor").hide();
    $("#dkjpenang").hide();
    $("#dkjkuching").hide();
    $("#dkjkina").hide();
    $("#dkjtawau").hide();
    $("#dkjsg").hide();
    $("#dkdtai").hide();
    $("#dkbabu").show();
    $("#dkjdubai").hide();
  });

  $('#kjdubai').on('click', function(){
    $("#daftar").show(1000);
    $("#sec-bg-1").hide();
    $("#sec-bg-2").show(1000);
    $("#dkbriyadh").hide();
    $("#dkjjeddah").hide();
    $("#dkjhk").hide();
    $("#dkbkw").hide();
    $("#dkbkl").hide();
    $("#dkjjohor").hide();
    $("#dkjpenang").hide();
    $("#dkjkuching").hide();
    $("#dkjkina").hide();
    $("#dkjtawau").hide();
    $("#dkjsg").hide();
    $("#dkdtai").hide();
    $("#dkbabu").hide();
    $("#dkjdubai").show();
  });



});

</script>
