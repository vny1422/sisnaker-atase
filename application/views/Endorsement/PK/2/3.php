<style>
p{
    font-size:8pt;
    position: absolute;
}

</style>

<p style="padding-left:-7 mm; margin-top:-3mm;"><?= $pk['agnama'];?></p>

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

<p style="padding-left:14 mm; margin-top:3mm;"><?= $row1;?></p>
<p style="padding-left:-7 mm; margin-top:10mm;"><?= $row2;?></p>
<p style="padding-left:-7 mm; margin-top:16mm;"><?= $pk['agtelp'];?>&emsp;<?= $pk['agfax'];?></p>
<p style="padding-left:-7 mm; margin-top:23mm;">Agency's MOL License Number : <?= $pk['agnoijincla'];?></p>

<p style="padding-left:93 mm; margin-top:35mm; font-family:sun-extA;"><?php if($pk['mjpngjwbcn'] == "" ) echo $pk['mjnamacn']; else echo $pk['mjnamacn']."(".$pk['mjpngjwbcn'].")";?></p>
<p style="padding-left:75 mm; margin-top:43mm;"><?php if($pk['mjpngjwb'] == "" ) echo $pk['mjnama']; else echo $pk['mjnama']."(".$pk['mjpngjwb'].")";?></p>
<p style="padding-left:17 mm; margin-top:49mm; font-family:sun-extA;"><?= $pk['mjalmtcn'];?></p>
<p style="padding-left:22 mm; margin-top:56mm;"><?= $pk['mjalmt'];?></p>
<p style="padding-left:17 mm; margin-top:63mm;"><?= $pk['mjtelp'];?></p>

<p style="padding-left:37 mm; margin-top:95mm;"><?= $pk['tknama'];?></p>
<p style="padding-left:50 mm; margin-top:107mm;"><?= $pk['tkalmtid'];?></p>
<p style="padding-left:77 mm; margin-top:122mm;"><?= $pk['tkpaspor'];?><br><?= $pk['tktglkeluar']."/".$pk['tktmptkeluar'];?></p>
<p style="padding-left:28 mm; margin-top:133mm;"><?= $pk['tktgllahir'];?></p>
<p style="padding-left:87 mm; margin-top:133mm;"><?= $pk['tktmptlahir'];?></p>
<p style="padding-left:136 mm; margin-top:133mm;"><?= $pk['tkjk'];?></p>
<p style="padding-left:35 mm; margin-top:140mm;"><?= $pk['tktgllahir'];?></p>
<p style="padding-left:95 mm; margin-top:140mm;"><?= $pk['tktmptlahir'];?></p>
<p style="padding-left:155 mm; margin-top:140mm;"><?= $pk['tkjk'];?></p>
<p style="padding-left:51 mm; margin-top:147mm;"><?php if($pk['tkstatkwn'] == 0) echo"V";?></p>
<p style="padding-left:91 mm; margin-top:147mm;"><?php if($pk['tkstatkwn'] == 1) echo"V";?></p>
<p style="padding-left:136 mm; margin-top:147mm;"><?php if($pk['tkstatkwn'] == 2) echo"V";?></p>
<p style="padding-left:62 mm; margin-top:159mm;"><?= $pk['tkjmlanaktanggungan'];?></p>
<p style="padding-left:32 mm; margin-top:171mm;"><?= $pk['tkahliwaris'];?></p>
<p style="padding-left:42 mm; margin-top:178mm;"><?= $pk['tkahliwaris'];?></p>
<p style="padding-left:18 mm; margin-top:192mm; font-family:sun-extA;"><?= $pk['tknamacn2'];?></p>
<p style="padding-left:20 mm; margin-top:199mm;"><?= $pk['tknama2'];?></p>
<p style="padding-left:19 mm; margin-top:206mm; font-family:sun-extA;"><?= $pk['tkalmtcn2'];?></p>
<p style="padding-left:22 mm; margin-top:212mm;"><?= $pk['tkalmt2'];?></p>
<p style="padding-left:19 mm; margin-top:219mm;"><?= $pk['tktelp'];?></p>
<p style="padding-left:102 mm; margin-top:219mm;"><?= $pk['tkhub'];?></p>

<p style="padding-left:112 mm; margin-top:253mm;"><barcode code="<?= $bc;?>" type="C39" /></p>
<p style="padding-left:142 mm; margin-top:265mm;"><?= $bc;?></p>

<pagebreak>

<p style="padding-left:107 mm; margin-top:46mm;"><?= $pk['jomkthn'];?></p>
<p style="padding-left:120 mm; margin-top:46mm;"><?= $pk['jomkbln'];?></p>
<p style="padding-left:131 mm; margin-top:46mm;"><?= $pk['jomkhr'];?></p>

<p style="padding-left:80 mm; margin-top:67mm;"><?= $pk['jomkthn'];?></p>
<p style="padding-left:99 mm; margin-top:67mm;"><?= $pk['jomkbln'];?></p>
<p style="padding-left:115 mm; margin-top:67mm;"><?= $pk['jomkhr'];?></p>

<p style="padding-left:112 mm; margin-top:253mm;"><barcode code="<?= $bc;?>" type="C39" /></p>
<p style="padding-left:142 mm; margin-top:265mm;"><?= $bc;?></p>

<pagebreak>

<p style="padding-left:96 mm; margin-top:12mm;"><?= $pk['jpgaji'];?></p>
<p style="padding-left:168 mm; margin-top:26mm;"><?= $pk['jpgaji'];?></p>

<p style="padding-left:112 mm; margin-top:253mm;"><barcode code="<?= $bc;?>" type="C39" /></p>
<p style="padding-left:142 mm; margin-top:265mm;"><?= $bc;?></p>

<pagebreak>

<p style="padding-left:137 mm; margin-top:35mm;">asd<?= $pk['joakomodasi'];?></p>
<p style="padding-left:55 mm; margin-top:60mm;">asd<?= $pk['joakomodasi'];?></p>

<p style="padding-left:81 mm; margin-top:115mm;"><?= $pk['jpgaji']/30;?></p>
<p style="padding-left:121 mm; margin-top:137mm;"><?= $pk['jpgaji']/30;?></p>

<p style="padding-left:53 mm; margin-top:190mm;"><?= $pk['jpgaji']/30;?></p>
<p style="padding-left:56 mm; margin-top:220mm;"><?= $pk['jpgaji']/30;?></p>

<p style="padding-left:112 mm; margin-top:253mm;"><barcode code="<?= $bc;?>" type="C39" /></p>
<p style="padding-left:142 mm; margin-top:265mm;"><?= $bc;?></p>

<pagebreak>

<p style="padding-left:112 mm; margin-top:253mm;"><barcode code="<?= $bc;?>" type="C39" /></p>
<p style="padding-left:142 mm; margin-top:265mm;"><?= $bc;?></p>

<pagebreak>

<p style="padding-left:112 mm; margin-top:253mm;"><barcode code="<?= $bc;?>" type="C39" /></p>
<p style="padding-left:142 mm; margin-top:265mm;"><?= $bc;?></p>

<pagebreak>

<p style="padding-left:112 mm; margin-top:253mm;"><barcode code="<?= $bc;?>" type="C39" /></p>
<p style="padding-left:142 mm; margin-top:265mm;"><?= $bc;?></p>

<pagebreak>

<p style="padding-left:0 mm; margin-top:239mm;"><?php if($pk['mjpngjwb'] == "" ) echo $pk['mjnama']; else echo $pk['mjnama']."(".$pk['mjpngjwb'].")";?></p>
<p style="padding-left:93 mm; margin-top:239mm;"><?= $pk['tknama'];?></p>

<p style="padding-left:112 mm; margin-top:253mm;"><barcode code="<?= $bc;?>" type="C39" /></p>
<p style="padding-left:142 mm; margin-top:265mm;"><?= $bc;?></p>

<pagebreak>

<p style="padding-left:0 mm; margin-top:5mm;"><?= $pk['agnama'];?></p>
<p style="padding-left:93 mm; margin-top:5mm;"><?= $pk['ppnama'];?></p>


<?php 
    $alamat= explode(" ",$pk['agalmtkantor']);

    $count = 0;
    $row1 = "";
    $row2 = "";
    $i = 0;
    foreach($alamat as $a){
        if($count<55){
            $row1 = $row1." ".$alamat[$i];
            $count = strlen($row1);
        }else{
            $row2 = $row2." ".$alamat[$i];
        }
        $i++;
    }    
?>

<p style="padding-left:0 mm; margin-top:22mm;"><?= $row1; ?><br><?= $row2;?><br><?= $pk['agtelp'];?>&emsp;<?=  $pk['agfax'];?></p>

<?php 
    $alamat= explode(" ",$pk['ppalmtkantor']);

    $count = 0;
    $row1 = "";
    $row2 = "";
    $i = 0;
    foreach($alamat as $a){
        if($count<55){
            $row1 = $row1." ".$alamat[$i];
            $count = strlen($row1);
        }else{
            $row2 = $row2." ".$alamat[$i];
        }
        $i++;
    }    
?>

<p style="padding-left:93 mm; margin-top:22mm;"><?= $row1; ?><br><?= $row2;?><br><?= $pk['pptelp'];?>&emsp;<?=  $pk['ppfax'];?></p>

<p style="padding-left:112 mm; margin-top:253mm;"><barcode code="<?= $bc;?>" type="C39" /></p>
<p style="padding-left:142 mm; margin-top:265mm;"><?= $bc;?></p>
