<style>
p{
    font-size:8pt;
    position: absolute;
}

</style>

<p style="padding-left:-5 mm; margin-top:-3mm;"><?= $pk['agnama'];?></p>

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

<p style="padding-left:18 mm; margin-top:2mm;"><?= $row1;?></p>
<p style="padding-left:-5 mm; margin-top:9mm;"><?= $row2;?></p>
<p style="padding-left:-5 mm; margin-top:16mm;"><?= $pk['agtelp'];?>&emsp;<?= $pk['agfax'];?></p>
<p style="padding-left:-5 mm; margin-top:23mm;">Agency's MOL License Number : <?= $pk['agnoijincla'];?></p>
<p style="padding-left:90 mm; margin-top:38mm; font-family:sun-extA;"><?php if($pk['mjpngjwbcn'] == "" ) echo $pk['mjnamacn']; else echo $pk['mjnamacn']."(".$pk['mjpngjwbcn'].")";?></p>
<p style="padding-left:78 mm; margin-top:46mm;"><?php if($pk['mjpngjwb'] == "" ) echo $pk['mjnama']; else echo $pk['mjnama']."(".$pk['mjpngjwb'].")";?></p>
<p style="padding-left:15 mm; margin-top:52mm; font-family:sun-extA;"><?= $pk['mjalmtcn'];?></p>
<p style="padding-left:22 mm; margin-top:59mm;"><?= $pk['mjalmt'];?></p>
<p style="padding-left:15 mm; margin-top:65mm;"><?= $pk['mjtelp'];?></p>
<p style="padding-left:37 mm; margin-top:98mm;"><?= $pk['tknama'];?></p>
<p style="padding-left:50 mm; margin-top:110mm;"><?= $pk['tkalmtid'];?></p>
<p style="padding-left:77 mm; margin-top:123mm;"><?= $pk['tkpaspor'];?></p>
<p style="padding-left:77 mm; margin-top:128mm;"><?= $pk['tktglkeluar']."/".$pk['tktmptkeluar'];?></p>
<p style="padding-left:28 mm; margin-top:137mm;"><?= $pk['tktgllahir'];?></p>
<p style="padding-left:87 mm; margin-top:137mm;"><?= $pk['tktmptlahir'];?></p>
<p style="padding-left:136 mm; margin-top:137mm;"><?= $pk['tkjk'];?></p>
<p style="padding-left:35 mm; margin-top:143mm;"><?= $pk['tktgllahir'];?></p>
<p style="padding-left:95 mm; margin-top:143mm;"><?= $pk['tktmptlahir'];?></p>
<p style="padding-left:155 mm; margin-top:143mm;"><?= $pk['tkjk'];?></p>
<p style="padding-left:53 mm; margin-top:150mm;"><?php if($pk['tkstatkwn'] == 0) echo"V";?></p>
<p style="padding-left:93 mm; margin-top:150mm;"><?php if($pk['tkstatkwn'] == 1) echo"V";?></p>
<p style="padding-left:138 mm; margin-top:150mm;"><?php if($pk['tkstatkwn'] == 2) echo"V";?></p>
<p style="padding-left:62 mm; margin-top:162mm;"><?= $pk['tkjmlanaktanggungan'];?></p>
<p style="padding-left:37 mm; margin-top:175mm;"><?= $pk['tkahliwaris'];?></p>
<p style="padding-left:47 mm; margin-top:182mm;"><?= $pk['tkahliwaris'];?></p>
<p style="padding-left:20 mm; margin-top:195mm; font-family:sun-extA;"><?= $pk['tknamacn2'];?></p>
<p style="padding-left:20 mm; margin-top:202mm;"><?= $pk['tknama2'];?></p>
<p style="padding-left:22 mm; margin-top:208mm; font-family:sun-extA;"><?= $pk['tkalmtcn2'];?></p>
<p style="padding-left:22 mm; margin-top:215mm;"><?= $pk['tkalmt2'];?></p>
<p style="padding-left:19 mm; margin-top:222mm;"><?= $pk['tktelp'];?></p>
<p style="padding-left:102 mm; margin-top:222mm;"><?= $pk['tkhub'];?></p>

<p style="padding-left:112 mm; margin-top:253mm;"><barcode code="<?= $bc;?>" type="C39" /></p>
<p style="padding-left:142 mm; margin-top:265mm;"><?= $bc;?></p>

<pagebreak>

<p style="padding-left:104 mm; margin-top:46mm;"><?= $pk['jomkthn'];?></p>
<p style="padding-left:116 mm; margin-top:46mm;"><?= $pk['jomkbln'];?></p>
<p style="padding-left:127 mm; margin-top:46mm;"><?= $pk['jomkhr'];?></p>

<p style="padding-left:82 mm; margin-top:66mm;"><?= $pk['jomkthn'];?></p>
<p style="padding-left:103 mm; margin-top:66mm;"><?= $pk['jomkbln'];?></p>
<p style="padding-left:120 mm; margin-top:66mm;"><?= $pk['jomkhr'];?></p>

<p style="padding-left:112 mm; margin-top:253mm;"><barcode code="<?= $bc;?>" type="C39" /></p>
<p style="padding-left:142 mm; margin-top:265mm;"><?= $bc;?></p>

<pagebreak>

<p style="padding-left:96 mm; margin-top:8mm;"><?= $pk['jpgaji'];?></p>
<p style="padding-left:164 mm; margin-top:22mm;"><?= $pk['jpgaji'];?></p>

<p style="padding-left:86 mm; margin-top:199mm;"><?= $pk['jpgaji']/30;?></p>
<p style="padding-left:113 mm; margin-top:221mm;"><?= $pk['jpgaji']/30;?></p>

<p style="padding-left:112 mm; margin-top:253mm;"><barcode code="<?= $bc;?>" type="C39" /></p>
<p style="padding-left:142 mm; margin-top:265mm;"><?= $bc;?></p>

<pagebreak>

<p style="padding-left:66 mm; margin-top:22mm;"><?= $pk['jpgaji']/30;?></p>
<p style="padding-left:73 mm; margin-top:52mm;"><?= $pk['jpgaji']/30;?></p>

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

<p style="padding-left:0 mm; margin-top:138mm;"><?php if($pk['mjpngjwb'] == "" ) echo $pk['mjnama']; else echo $pk['mjnama']."(".$pk['mjpngjwb'].")";?></p>
<p style="padding-left:93 mm; margin-top:138mm;"><?= $pk['tknama'];?></p>

<p style="padding-left:0 mm; margin-top:161mm;"><?= $pk['agnama'];?></p>
<p style="padding-left:93 mm; margin-top:161mm;"><?= $pk['ppnama'];?></p>


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

<p style="padding-left:0 mm; margin-top:184mm;"><?= $row1; ?><br><?= $row2;?><br><?= $pk['agtelp'];?>&emsp;<?=  $pk['agfax'];?></p>

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

<p style="padding-left:93 mm; margin-top:184mm;"><?= $row1; ?><br><?= $row2;?><br><?= $pk['pptelp'];?>&emsp;<?=  $pk['ppfax'];?></p>

<p style="padding-left:112 mm; margin-top:253mm;"><barcode code="<?= $bc;?>" type="C39" /></p>
<p style="padding-left:142 mm; margin-top:265mm;"><?= $bc;?></p>
