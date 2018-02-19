<style>
p{
    font-size:10pt;
    position: absolute;
}

</style>

<?php 
    $alamat= explode(" ",$pk['agalmtkantor']);

    $count = 0;
    $row1 = "";
    $row2 = "";
    $i = 0;
    foreach($alamat as $a){
        if($count<30){
            $row1 = $row1." ".$alamat[$i];
            $count = strlen($row1);
        }else{
            $row2 = $row2." ".$alamat[$i];
        }
        $i++;
    }    
?>

<p style="font-size:8pt; padding-left:-5 mm; margin-top:-1mm;"><?= $pk['agnama'];?></p>
<p style="font-size:8pt; padding-left:15 mm; margin-top:5mm;"><?= $row1;?></p>
<p style="font-size:8pt; padding-left:-5 mm; margin-top:10mm;"><?= $row2;?></p>
<p style="font-size:8pt; padding-left:-5 mm; margin-top:15mm;"><?= $pk['agtelp'];?>&emsp;<?= $pk['agfax'];?></p>
<p style="font-size:8pt; padding-left:-5 mm; margin-top:20mm;">Agency's MOL License Number : <?= $pk['agnoijincla'];?></p>

<p style="padding-left:100 mm; margin-top:37mm; font-family:sun-extA;"><?php if($pk['mjpngjwbcn'] == "" ) echo $pk['mjnamacn']; else echo $pk['mjnamacn']."(".$pk['mjpngjwbcn'].")";?></p>
<p style="padding-left:40 mm; margin-top:49mm;"><?php if($pk['mjpngjwb'] == "" ) echo $pk['mjnama']; else echo $pk['mjnama']."(".$pk['mjpngjwb'].")";?></p>
<p style="padding-left:22 mm; margin-top:53mm; font-family:sun-extA;"><?= $pk['mjalmtcn'];?></p>
<p style="padding-left:23 mm; margin-top:61mm;"><?= $pk['mjalmt'];?></p>
<p style="padding-left:18 mm; margin-top:66mm;"><?= $pk['mjtelp'];?></p>

<p style="padding-left:39 mm; margin-top:96mm;"><?= $pk['tknama'];?></p>
<p style="padding-left:50 mm; margin-top:108mm;"><?= $pk['tkalmtid'];?></p>
<p style="padding-left:77 mm; margin-top:120mm;"><?= $pk['tkpaspor'];?><br><?= $pk['tktglkeluar']."/".$pk['tktmptkeluar'];?></p>
<p style="padding-left:30 mm; margin-top:132mm;"><?= $pk['tktgllahir'];?></p>
<p style="padding-left:89 mm; margin-top:132mm;"><?= $pk['tktmptlahir'];?></p>
<p style="padding-left:138 mm; margin-top:132mm;"><?= $pk['tkjk'];?></p>
<p style="padding-left:36 mm; margin-top:138mm;"><?= $pk['tktgllahir'];?></p>
<p style="padding-left:96 mm; margin-top:138mm;"><?= $pk['tktmptlahir'];?></p>
<p style="padding-left:156 mm; margin-top:138mm;"><?= $pk['tkjk'];?></p>
<p style="padding-left:53 mm; margin-top:144mm;"><?php if($pk['tkstatkwn'] == 0) echo"V";?></p>
<p style="padding-left:94 mm; margin-top:144mm;"><?php if($pk['tkstatkwn'] == 1) echo"V";?></p>
<p style="padding-left:139 mm; margin-top:144mm;"><?php if($pk['tkstatkwn'] == 2) echo"V";?></p>
<p style="padding-left:63 mm; margin-top:149mm;"><?= $pk['tkjmlanaktanggungan'];?></p>
<p style="padding-left:23 mm; margin-top:167mm;"><?= $pk['tkahliwaris'];?></p>
<p style="padding-left:30 mm; margin-top:174mm;"><?= $pk['tkahliwaris'];?></p>
<p style="padding-left:18 mm; margin-top:186mm; font-family:sun-extA;"><?= $pk['tknamacn2'];?></p>
<p style="padding-left:20 mm; margin-top:192mm;"><?= $pk['tknama2'];?></p>
<p style="padding-left:20 mm; margin-top:198mm; font-family:sun-extA;"><?= $pk['tkalmtcn2'];?></p>
<p style="padding-left:23 mm; margin-top:204mm;"><?= $pk['tkalmt2'];?></p>
<p style="padding-left:19 mm; margin-top:210mm;"><?= $pk['tktelp'];?></p>
<p style="padding-left:102 mm; margin-top:210mm;"><?= $pk['tkhub'];?></p>

<p style="padding-left:112 mm; margin-top:253mm;"><barcode code="<?= $bc;?>" type="C39" /></p>
<p style="padding-left:138 mm; margin-top:265mm;"><?= $bc;?></p>

<pagebreak>

<p style="padding-left:68 mm; margin-top:3mm;"><?= $pk['joposisicn'];?></p>
<p style="padding-left:127 mm; margin-top:15mm; font-family:sun-extA;"><?= $pk['joposisi'];?></p>

<?php

$start = $pk['jostart'];
$end = $pk['joend'];

if($start == NULL && $end == NULL){
    $jostart = "0000-00-00";
    $joend = "0000-00-00";
}
$jostart = explode("-", $jostart);
$joend = explode("-", $joend);

?>

<?php if($pk['jotime'] == 1 ){?>
<p style="padding-left:24 mm; margin-top:52mm;">V&emsp; <?= $jostart[0]; ?> &emsp;&emsp;<?= $jostart[1]; ?>&emsp;&emsp; <?= $jostart[2];?> &emsp;&emsp;&emsp;<?= $joend[0];?> &emsp;&emsp;<?= $joend[1]; ?> &emsp;&emsp;<?= $joend[2];?></p>
<?php } ?>

<?php if($pk['jotime'] == 2 ){?>
<p style="padding-left:24 mm; margin-top:59mm;">V&emsp; <?= $jostart[0]; ?> &emsp;&emsp;<?= $jostart[1]; ?> &emsp;&emsp;<?= $jostart[2];?> &emsp;&emsp;&emsp;<?= $joend[0];?> &emsp;&emsp;<?= $joend[1]; ?> &emsp;&emsp;<?= $joend[2];?></p>
<?php } ?>

<?php if($pk['jotime'] == 1 ){?>
<p style="padding-left:24 mm; margin-top:84mm;">V</p>
<p style="padding-left:173 mm; margin-top:84mm;">. <?= $jostart[2]; ?> .</p>
<p style="padding-left:45 mm; margin-top:90mm;"><?= $jostart[1]; ?> &emsp;&emsp;&emsp;&emsp;<?= $jostart[0]; ?>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; <?= $end; ?></p>
<?php } ?>

<?php if($pk['jotime'] == 2 ){?>
<p style="padding-left:24 mm; margin-top:96mm;">V</p>
<p style="padding-left:174 mm; margin-top:96mm;">. <?= $jostart[2]; ?> .</p>
<p style="padding-left:43 mm; margin-top:102mm;"><?= $jostart[1]; ?>&emsp;&emsp;&emsp;&emsp;<?= $jostart[0]; ?>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<?= $end; ?></p>
<?php } ?>

<p style="padding-left:112 mm; margin-top:253mm;"><barcode code="<?= $bc;?>" type="C39" /></p>
<p style="padding-left:138 mm; margin-top:265mm;"><?= $bc;?></p>

<pagebreak>

<p style="padding-left:88 mm; margin-top:73mm;"><?= $pk['jpgaji'];?></p>
<p style="padding-left:162 mm; margin-top:86mm;"><?= $pk['jpgaji'];?></p>

<p style="padding-left:103 mm; margin-top:201mm;"><?= $pk['jpgaji']/30;?></p>
<p style="padding-left:122 mm; margin-top:208mm;"><?= $pk['jpgaji']/30;?></p>

<p style="padding-left:165 mm; margin-top:208mm;"><?= $pk['jpgaji']/30*1.33/8;?></p>
<p style="padding-left:109 mm; margin-top:215mm;"><?= $pk['jpgaji']/30*1.33/8;?></p>

<p style="padding-left:155 mm; margin-top:215mm;"><?= $pk['jpgaji']/30*1.33/8*2;?></p>

<p style="padding-left:112 mm; margin-top:253mm;"><barcode code="<?= $bc;?>" type="C39" /></p>
<p style="padding-left:138 mm; margin-top:265mm;"><?= $bc;?></p>

<pagebreak>

<p style="padding-left:103 mm; margin-top:30mm;"><?= $pk['jpgaji']/30;?></p>
<p style="padding-left:124 mm; margin-top:37mm;"><?= $pk['jpgaji']/30;?></p>
<p style="padding-left:164 mm; margin-top:37mm;"><?= $pk['jpgaji']/30*1.66/8;?></p>
<p style="padding-left:110 mm; margin-top:44mm;"><?= $pk['jpgaji']/30*1.66/8;?></p>
<p style="padding-left:155 mm; margin-top:44mm;"><?= $pk['jpgaji']/30*1.33/8*2;?></p>

<p style="padding-left:149 mm; margin-top:89mm;"><?= $pk['jpgaji']/30;?></p>
<p style="padding-left:75 mm; margin-top:157mm;"><?= $pk['jpgaji']/30;?></p>

<p style="padding-left:77 mm; margin-top:206mm;"><?= $pk['jpgaji']/30;?></p>
<p style="padding-left:87 mm; margin-top:227mm;"><?= $pk['jpgaji']/30;?></p>

<p style="padding-left:112 mm; margin-top:253mm;"><barcode code="<?= $bc;?>" type="C39" /></p>
<p style="padding-left:138 mm; margin-top:265mm;"><?= $bc;?></p>

<pagebreak>

<p style="padding-left:168 mm; margin-top:71mm;"><?= $pk['jpgaji']/30;?></p>
<p style="padding-left:114 mm; margin-top:110mm;"><?= $pk['jpgaji']/30;?></p>

<p style="padding-left:112 mm; margin-top:253mm;"><barcode code="<?= $bc;?>" type="C39" /></p>
<p style="padding-left:138 mm; margin-top:265mm;"><?= $bc;?></p>

<pagebreak>

<p style="padding-left:112 mm; margin-top:253mm;"><barcode code="<?= $bc;?>" type="C39" /></p>
<p style="padding-left:138 mm; margin-top:265mm;"><?= $bc;?></p>

<pagebreak>

<p style="padding-left:112 mm; margin-top:253mm;"><barcode code="<?= $bc;?>" type="C39" /></p>
<p style="padding-left:138 mm; margin-top:265mm;"><?= $bc;?></p>

<pagebreak>

<p style="padding-left:112 mm; margin-top:253mm;"><barcode code="<?= $bc;?>" type="C39" /></p>
<p style="padding-left:138 mm; margin-top:265mm;"><?= $bc;?></p>

<pagebreak>

<p style="padding-left:0 mm; margin-top:202mm;"><?php if($pk['mjpngjwb'] == "" ) echo $pk['mjnama']; else echo $pk['mjnama']."(".$pk['mjpngjwb'].")";?></p>
<p style="padding-left:93 mm; margin-top:202mm;"><?= $pk['tknama'];?></p>

<p style="padding-left:112 mm; margin-top:253mm;"><barcode code="<?= $bc;?>" type="C39" /></p>
<p style="padding-left:138 mm; margin-top:265mm;"><?= $bc;?></p>

<pagebreak>

<p style="padding-left:0 mm; margin-top:8mm;"><?= $pk['agnama'];?></p>
<p style="padding-left:93 mm; margin-top:8mm;"><?= $pk['ppnama'];?></p>


<?php 
    $alamat= explode(" ",$pk['agalmtkantor']);

    $count = 0;
    $row1 = "";
    $row2 = "";
    $i = 0;
    foreach($alamat as $a){
        if($count<45){
            $row1 = $row1." ".$alamat[$i];
            $count = strlen($row1);
        }else{
            $row2 = $row2." ".$alamat[$i];
        }
        $i++;
    }    
?>

<p style="padding-left:0 mm; margin-top:28mm;"><?= $row1; ?><br><?= $row2;?><br><?= $pk['agtelp'];?>&emsp;<?=  $pk['agfax'];?></p>

<?php 
    $alamat= explode(" ",$pk['ppalmtkantor']);

    $count = 0;
    $row1 = "";
    $row2 = "";
    $i = 0;
    foreach($alamat as $a){
        if($count<40){
            $row1 = $row1." ".$alamat[$i];
            $count = strlen($row1);
        }else{
            $row2 = $row2." ".$alamat[$i];
        }
        $i++;
    }    
?>

<p style="padding-left:93 mm; margin-top:28mm;"><?= $row1; ?><br><?= $row2;?><br><?= $pk['pptelp'];?>&emsp;<?=  $pk['ppfax'];?></p>

<p style="padding-left:112 mm; margin-top:253mm;"><barcode code="<?= $bc;?>" type="C39" /></p>
<p style="padding-left:138 mm; margin-top:265mm;"><?= $bc;?></p>
