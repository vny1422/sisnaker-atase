<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>

<style type="text/css">
  .borderless td, .borderless th {
    border: none;
  }
  .table th {
    text-align: center;         
  }     
  .table th, td {
    padding: 5px;
  } 
</style>
<body>

<table width="100%" width="100%" border="2px" cellspacing="1" cellpadding="4" class="table-bordered">
    <thead>
      <tr>
        <th colspan="3" style="text-align: center; padding: 5px;">RECRUITMENT AGREEMENT FORM FOR INDONESIAN WORKERS<br>REQUESTED BY OVERSEAS EMPLOYERS</th>
      </tr>      
    </thead>
</table>

<?php
  $this->db->select('*');
  $this->db->where('idinstitution',$pkp[0]["idinstitution"]);
  $country = $this->db->get('institution')->row_array();
?> 

<table width="100%" border="2px" cellspacing="1" cellpadding="4" class="table-bordered">    
    <tr>
      <td colspan="3" style="text-align: center; padding: 5px;">NAME AND ADDRESS OF <?php echo strtoupper($country["nameinstitution"]); ?> AGENCIES</td>
    </tr>    
    <tr>
      <td valign="top">1.</td>
      <td>
        <table width="100%" class="borderless">
          <tr>
            <td width="15%">Country and place of Employment</td>
            <td width="5%">:</td>           
            <td width="80%"><?php echo strtoupper($country["nameinstitution"]); ?></td>
          </tr>
        </table>
      </td>
    </tr>  
    <tr>
      <td valign="top">2.</td>
      <td >
        <table class="borderless">
          <tr>
            <td colspan="3">Country Placement Recruitment Company / Agency</td>
          </tr>
          <tr>
            <td width="15%">Name</td>
            <td width="5%">:</td>
            <td width="80%"><?= $pkp[0]["agnama"];?></td>
          </tr>
          <tr>
            <td >License No.</td>
            <td >:</td>      
            <td ><?= $pkp[0]["agnoijincla"]; ?></td>
          </tr>
          <tr>
            <td >Address</td>
            <td >:</td>
            <td ><?= $pkp[0]["agalmtkantor"]; ?></td>
          </tr>
          <tr>
            <td >Phone No.</td>
            <td >:</td>
            <td ><?= $pkp[0]["agtelp"]; ?></td>
          </tr>          
          <tr>
            <td >Fax No.</td>
            <td >:</td>
            <td ><?= $pkp[0]["agfax"]; ?></td>
          </tr>
          <tr>
            <td >E-mail</td>
            <td >:</td>
            <td ><?= $pkp[0]["agemail"]; ?></td>
          </tr>                              
        </table>
      </td>
    </tr>    
    <tr>
      <td valign="top">3.</td>
      <td >
        <table width="100%" class="borderless">
          <tr>
            <td colspan="3">Represented by</td>
          </tr>
          <tr>
            <td width="15%">Name</td>
            <td width="5%">:</td>
            <td width="80%"><?= $pkp[0]["agpngjwb"]; ?></td>
          </tr>
          <tr>
            <td >Position</td>
            <td >:</td>
            <td ></td>
          </tr>
          <tr>
            <td >Passport No.</td>
            <td >:</td>
            <td ></td>
          </tr>
          <tr>
            <td >Home Address</td>
            <td >:</td>
            <td ></td>
          </tr>          
          <tr>
            <td >Phone No.</td>
            <td >:</td>
            <td ></td>
          </tr>
          <tr>
            <td >Mobile Phone No.</td>
            <td >:</td>
            <td ></td>
          </tr>                              
        </table>
      </td>
    </tr>
    <tr>
      <td colspan="3" style="text-align: center; padding: 5px;">NAME AND ADDRESS OF INDONESIAN AGENCIES</td>
    </tr>    
    <tr>
      <td valign="top">4.</td>
      <td >
        <table class="borderless">
          <tr>
            <td colspan="3">Indonesian Recruitment Company / Agency</td>
          </tr>
          <tr>
            <td width="15%">Name</td>
            <td width="5%">:</td>        
            <td width="80%"><?= $pkp[0]["ppnama"]; ?></td>
          </tr>
          <tr>
            <td >License No.</td>
            <td >:</td>
            <td ><?= $pkp[0]["ppijin"]; ?></td>
          </tr>
          <tr>
            <td >Address</td>
            <td >:</td>
            <td ><?= $pkp[0]["ppalmtkantor"]; ?></td>
          </tr>
          <tr>
            <td >Phone No.</td>
            <td >:</td>
            <td ><?= $pkp[0]["pptelp"]; ?></td>
          </tr>          
          <tr>
            <td >Fax No.</td>
            <td >:</td>
            <td ><?= $pkp[0]["ppfax"]; ?></td>
          </tr>
          <tr>
            <td >E-mail</td>
            <td >:</td>
            <td ></td>
          </tr>                              
        </table>
      </td>
    </tr>    
    <tr>
      <td valign="top">5.</td>
      <td >
        <table width="100%" class="borderless">
          <tr>
            <td colspan="3">Represented by</td>
          </tr>
          <tr>
            <td width="15%">Name</td>
            <td width="5%">:</td>
            <td width="80%"><?= $pkp[0]["pppngjwb"]; ?></td>
          </tr>
          <tr>
            <td >Position</td>
            <td >:</td>
            <td ></td>
          </tr>
          <tr>
            <td >Passport No.</td>
            <td >:</td>
            <td ></td>
          </tr>
          <tr>
            <td >Home Address</td>
            <td >:</td>
            <td ></td>
          </tr>          
          <tr>
            <td >Phone No.</td>
            <td >:</td>
            <td ></td>
          </tr>
          <tr>
            <td >Mobile Phone No.</td>
            <td >:</td>
            <td ></td>
          </tr>                              
        </table>
      </td>
    </tr>
    <tr>
      <td valign="top">6.</td>
      <td >
        <table class="borderless">
          <tr>
            <td width="15%">Recruitment Agreement</td>
            <td width="5%">:</td>
            <td width="80%"></td>
          </tr>
          <tr>
            <td >Number</td>
            <td >:</td>
            <td ></td>
          </tr>
          <tr>
            <td >Date</td>
            <td >:</td>
          </tr>                             
        </table>
      </td>
    </tr>     
    <tr>
      <td colspan="3" style="text-align: center; padding: 5px;">TYPE AND NUMBER OF WORKERS REQUESTED</td>
    </tr>
    <tr>
      <td valign="top"></td>
      <td >
        <table class="borderless">
        <?php 
        $c = 0;
        foreach($pkp as $p){
          $c++;
        }
        ?>
          <tr>
            <td width="15%">Job Title</td>
            <td width="5%">:</td>           
            <td width="80%">
            <?php for($i=0; $i<$c; $i++){
              if($i==$c-1)
                echo $pkp[$i]["namajenispekerjaan"];
              else
                echo $pkp[$i]["namajenispekerjaan"].", ";
            } 
            ?>
            </td>            
          </tr>
          <tr>
            <td >Duties of the Job</td>
            <td >:</td>
            <td >ARRANGED BY EMPLOYER</td>
          </tr>
          <tr>
            <td >Number needed elaborated in dispatching Schedule from Indonesia</td>
            <td >:</td>
            <td >
            <?php for($i=0; $i<$c; $i++){
              if($i==$c-1)
                echo $pkp[$i]["namajenispekerjaan"]." L : ".$pkp[$i]["pkpdl"].", P : ".$pkp[$i]["pkpdp"].", C : ".$pkp[$i]["pkpdc"];
              else
              echo $pkp[$i]["namajenispekerjaan"]." L : ".$pkp[$i]["pkpdl"].", P : ".$pkp[$i]["pkpdp"].", C : ".$pkp[$i]["pkpdc"]."; ";
            } 
            ?>            
            </td>            
          </tr>
          <tr>
            <td >Propose Duration of Service</td>
            <td >:</td>
            <?php
              $start_date = $pkp[0]["pkptglawal"];              
              $end_date = $pkp[0]["pkptglakhir"];              
           
              $diff = abs(strtotime($end_date) - strtotime($start_date));
              $years = floor($diff / (365*60*60*24));
              $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
              $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
            ?>
            <td ><?= $years.' Years '.$months.' Month '.$days.' Days'; ?></td>
          </tr>                                       
        </table>
      </td>
    </tr>    
    <tr>
      <td colspan="3" style="text-align: center; padding: 5px;">PERSONAL REQUIREMENT</td>
    </tr>
    <tr>
      <td valign="top"></td>
      <td >
        <table class="borderless">
          <tr>
            <td width="15%">Age and Sex</td>
            <td width="5%">:</td>
            <td width="80%"></td>
          </tr>
          <tr>
            <td >Education</td>
            <td >:</td>
            <td ></td>
          </tr>
          <tr>
            <td >Experience</td>
            <td >:</td>
            <td ></td>
          </tr>
          <tr>
            <td >Marital Status</td>
            <td >:</td>
            <td ></td>
          </tr>                   
          <tr>
            <td >Number of Dependents Allowed</td>
            <td >:</td>
            <td ></td>
          </tr>                                                 
        </table>
      </td>
    </tr> 
    <tr>
      <td colspan="3" style="text-align: center; padding: 5px;">TERMS OF EMPLOYMENT</td>
    </tr> 
    <tr>
      <td valign="top"></td>
      <td >
        <table class="borderless">
          <tr>
            <td width="15%">Number of Working Hours</td>
            <td width="5%">:</td>
            <td width="80%"></td>
          </tr>
          <tr>
            <td >Wage per Day/Week/Month Specified according to jobs</td>
            <td >:</td>
            <td >
            <?php for($i=0; $i<$c; $i++){
              if($i==$c-1)
                echo $pkp[$i]["namajenispekerjaan"]." : ".$pkp[$i]["jpgaji"];
              else
                echo $pkp[$i]["namajenispekerjaan"]." : ".$pkp[$i]["jpgaji"].", ";
            } 
            ?>            
            </td>
          </tr>
          <tr>
            <td >Other Benefits</td>
            <td >:</td>
            <td >ACCORDING TO <?php echo strtoupper($country["nameinstitution"]); ?> LABOR LAW</td>
          </tr>                   
          <tr>
            <td >Insurance against accidents or industrial (occupational) desease /life insurance (during the terms of overseas</td>
            <td >:</td>
            <td >ACCORDING TO <?php echo strtoupper($country["nameinstitution"]); ?> LABOR INSURANCE LAW</td>
          </tr>                                                 
        </table>
      </td>
    </tr>     
    <tr>
      <td colspan="3" style="text-align: center; padding: 5px;">TRANSPORTATION AND SOCIAL PROVISION</td>
    </tr>
    <tr>
      <td valign="top"></td>
      <td >
        <table class="borderless">
          <tr>
            <td width="15%">Transportation from Indonesia to the place of employment and return</td>
            <td width="5%">:</td>
            <td width="80%">FROM INDONESIA BY EMPLOYER AND RETURN EXPENSES PROVIDED BY EMPLOYER</td>
          </tr>
          <tr>
            <td >Board and Lodging</td>
            <td >:</td>
            <td >PROVIDED BY EMPLOYER</td>
          </tr>
          <tr>
            <td >Health Care / Medical Treatment</td>
            <td >:</td>
            <td >ACCORDING TO <?php echo strtoupper($country["nameinstitution"]); ?> HEALTH INSURANCE LAW</td>
          </tr>
          <tr>
            <td >Other Benefits</td>
            <td >:</td>
            <td >ACCORDING TO <?php echo strtoupper($country["nameinstitution"]); ?> LABOR LAW</td>
          </tr>                   
          <tr>
            <td >Working outfit</td>
            <td >:</td>
            <td >TO BE PAID BY EMPLOYER</td>
          </tr>                                                 
        </table>
      </td>
    </tr>    
  </table>  

  <pagebreak>

<style type="text/css">
div {
    margin-left: 300px;
    width: 320px;
    padding: 10px;
    border: 1px solid black;        
    text-align:center;
} 

</style>

<div>
<p><?= date("j F, Y") ?></p>
<p>(Signature and Position of Applicant)</p>
<br>
<br>
<br>
<p>(...................................)</p>
<p>(...................................)</p>
</div>

<br><br>

<div>
<p><?= date("j F, Y") ?></p>
<p>(Signature and Position of Applicant)</p>
<br>
<br>
<br>
<p>(<?= $pkp[0]["pppngjwb"]; ?>)</p>
<p>(...................................)</p>
</div>

<br><br>
<p style="margin-left: 300px;">SEEN BY :</p>
<div>
Indonesia Economic & Trade Office of <?= $country["nameinstitution"]; ?>
 Kantor Dagang dan Ekonomi Indonesia (KDEI)
</div>

<barcode style="margin-top: 5cm; margin-left:400px; " code="<?= $pkp[0]["pkpkode"];?>" type="C39" />
<p style="margin-left: 400px; text-align:center;"><?= $pkp[0]["pkpkode"];?></p>

</body>
