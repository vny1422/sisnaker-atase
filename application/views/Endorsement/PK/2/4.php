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

<p style="font-size:8pt; padding-left:-5 mm; margin-top:-3mm;"><?= $pk['agnama'];?></p>
<p style="font-size:8pt; padding-left:18 mm; margin-top:3mm;"><?= $row1;?></p>
<p style="font-size:8pt; padding-left:-5 mm; margin-top:10mm;"><?= $row2;?></p>
<p style="font-size:8pt; padding-left:-5 mm; margin-top:16mm;"><?= $pk['agtelp'];?>&emsp;<?= $pk['agfax'];?></p>
<p style="font-size:8pt; padding-left:-5 mm; margin-top:23mm;">Agency's MOL License Number : <?= $pk['agnoijincla'];?></p>

<p style="padding-left:71 mm; margin-top:35mm; font-family:sun-extA;"><?php if($pk['mjpngjwbcn'] == "" ) echo $pk['mjnamacn']; else echo $pk['mjnamacn']."(".$pk['mjpngjwbcn'].")";?></p>
<p style="padding-left:40 mm; margin-top:43mm;"><?php if($pk['mjpngjwb'] == "" ) echo $pk['mjnama']; else echo $pk['mjnama']."(".$pk['mjpngjwb'].")";?></p>
<p style="padding-left:16 mm; margin-top:48mm; font-family:sun-extA;"><?= $pk['mjalmtcn'];?></p>
<p style="padding-left:21 mm; margin-top:56mm;"><?= $pk['mjalmt'];?></p>
<p style="padding-left:18 mm; margin-top:63mm;"><?= $pk['mjtelp'];?></p>

<p style="padding-left:35 mm; margin-top:95mm;"><?= $pk['tknama'];?></p>
<p style="padding-left:48 mm; margin-top:108mm;"><?= $pk['tkalmtid'];?></p>
<p style="padding-left:77 mm; margin-top:121mm;"><?= $pk['tkpaspor'];?><br><?= $pk['tktglkeluar']."/".$pk['tktmptkeluar'];?></p>
<p style="padding-left:26 mm; margin-top:133mm;"><?= $pk['tktgllahir'];?></p>
<p style="padding-left:85 mm; margin-top:133mm;"><?= $pk['tktmptlahir'];?></p>
<p style="padding-left:134 mm; margin-top:133mm;"><?= $pk['tkjk'];?></p>
<p style="padding-left:33 mm; margin-top:140mm;"><?= $pk['tktgllahir'];?></p>
<p style="padding-left:93 mm; margin-top:140mm;"><?= $pk['tktmptlahir'];?></p>
<p style="padding-left:153 mm; margin-top:140mm;"><?= $pk['tkjk'];?></p>
<p style="padding-left:49 mm; margin-top:147mm;"><?php if($pk['tkstatkwn'] == 0) echo"V";?></p>
<p style="padding-left:89 mm; margin-top:147mm;"><?php if($pk['tkstatkwn'] == 1) echo"V";?></p>
<p style="padding-left:134 mm; margin-top:147mm;"><?php if($pk['tkstatkwn'] == 2) echo"V";?></p>
<p style="padding-left:60 mm; margin-top:159mm;"><?= $pk['tkjmlanaktanggungan'];?></p>
<p style="padding-left:33 mm; margin-top:172mm;"><?= $pk['tkahliwaris'];?></p>
<p style="padding-left:43 mm; margin-top:179mm;"><?= $pk['tkahliwaris'];?></p>
<p style="padding-left:18 mm; margin-top:192mm; font-family:sun-extA;"><?= $pk['tknamacn2'];?></p>
<p style="padding-left:18 mm; margin-top:199mm;"><?= $pk['tknama2'];?></p>
<p style="padding-left:20 mm; margin-top:205mm; font-family:sun-extA;"><?= $pk['tkalmtcn2'];?></p>
<p style="padding-left:20 mm; margin-top:212mm;"><?= $pk['tkalmt2'];?></p>
<p style="padding-left:17 mm; margin-top:219mm;"><?= $pk['tktelp'];?></p>
<p style="padding-left:100 mm; margin-top:219mm;"><?= $pk['tkhub'];?></p>

<p style="padding-left:112 mm; margin-top:253mm;"><barcode code="<?= $bc;?>" type="C39" /></p>
<p style="padding-left:138 mm; margin-top:265mm;"><?= $bc;?></p>

<pagebreak>

<p style="padding-left:108 mm; margin-top:36mm;"><?= $pk['jomkthn'];?></p>
<p style="padding-left:121 mm; margin-top:36mm;"><?= $pk['jomkbln'];?></p>
<p style="padding-left:128 mm; margin-top:36mm;">_<?= $pk['jomkhr'];?>_</p>

<p style="padding-left:85 mm; margin-top:53mm;"><?= $pk['jomkthn'];?></p>
<p style="padding-left:105 mm; margin-top:53mm;"><?= $pk['jomkbln'];?></p>
<p style="padding-left:119 mm; margin-top:53mm;">_<?= $pk['jomkhr'];?>_</p>

<p style="padding-left:90 mm; margin-top:164mm;"><?= $pk['jpgaji'];?></p>
<p style="padding-left:55 mm; margin-top:182mm;"><?= $pk['jpgaji'];?></p>

<p style="padding-left:112 mm; margin-top:253mm;"><barcode code="<?= $bc;?>" type="C39" /></p>
<p style="padding-left:138 mm; margin-top:265mm;"><?= $bc;?></p>

<pagebreak>

<p style="padding-left:87 mm; margin-top:91mm;"><?= $pk['jpgaji']/30;?></p>
<p style="padding-left:136 mm; margin-top:112mm;"><?= $pk['jpgaji']/30;?></p>

<p style="padding-left:62 mm; margin-top:149mm;"><?= $pk['jpgaji']/30;?></p>
<p style="padding-left:58 mm; margin-top:171mm;"><?= $pk['jpgaji']/30;?></p>

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

<p style="padding-left:3 mm; margin-top:103mm;"><?php if($pk['mjpngjwb'] == "" ) echo $pk['mjnama']; else echo $pk['mjnama']."(".$pk['mjpngjwb'].")";?></p>
<p style="padding-left:96 mm; margin-top:103mm;"><?= $pk['tknama'];?></p>

<p style="padding-left:3 mm; margin-top:125mm;"><?= $pk['agnama'];?></p>
<p style="padding-left:96 mm; margin-top:125mm;"><?= $pk['ppnama'];?></p>


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

<p style="padding-left:3 mm; margin-top:150mm;"><?= $row1; ?><br><?= $row2;?><br><?= $pk['agtelp'];?>&emsp;<?=  $pk['agfax'];?></p>

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

<p style="padding-left:96 mm; margin-top:150mm;"><?= $row1; ?><br><?= $row2;?><br><?= $pk['pptelp'];?>&emsp;<?=  $pk['ppfax'];?></p>

<p style="padding-left:112 mm; margin-top:253mm;"><barcode code="<?= $bc;?>" type="C39" /></p>
<p style="padding-left:138 mm; margin-top:265mm;"><?= $bc;?></p>
