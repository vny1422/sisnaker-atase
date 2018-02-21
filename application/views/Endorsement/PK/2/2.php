<style>
p{
    font-size:10pt;
    position: absolute;
}

</style>

<p style="font-size:8pt; padding-left:-5 mm; margin-top:-3mm;"><?= $pk['agnama'];?></p>

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

<p style="font-size:8pt; padding-left:18 mm; margin-top:3mm;"><?= $row1;?></p>
<p style="font-size:8pt; padding-left:-5 mm; margin-top:10mm;"><?= $row2;?></p>
<p style="font-size:8pt; padding-left:-5 mm; margin-top:16mm;"><?= $pk['agtelp'];?>&emsp;<?= $pk['agfax'];?></p>
<p style="font-size:8pt; padding-left:-5 mm; margin-top:23mm;">Agency's MOL License Number : <?= $pk['agnoijincla'];?></p>

<p style="padding-left:73 mm; margin-top:30mm; font-family:sun-extA;"><?php if($pk['mjpngjwbcn'] == "" ) echo $pk['mjnamacn']; else echo $pk['mjnamacn']."(".$pk['mjpngjwbcn'].")";?></p>
<p style="padding-left:50 mm; margin-top:38mm;"><?php if($pk['mjpngjwb'] == "" ) echo $pk['mjnama']; else echo $pk['mjnama']."(".$pk['mjpngjwb'].")";?></p>
<p style="padding-left:20 mm; margin-top:44mm; font-family:sun-extA;"><?= $pk['mjalmtcn'];?></p>
<p style="padding-left:25 mm; margin-top:52mm;"><?= $pk['mjalmt'];?></p>
<p style="padding-left:20 mm; margin-top:58mm;"><?= $pk['mjtelp'];?></p>

<p style="padding-left:37 mm; margin-top:90mm;"><?= $pk['tknama'];?></p>
<p style="padding-left:50 mm; margin-top:102mm;"><?= $pk['tkalmtid'];?></p>
<p style="padding-left:77 mm; margin-top:117mm;"><?= $pk['tkpaspor'];?><br><?= $pk['tktglkeluar']."/".$pk['tktmptkeluar'];?></p>
<p style="padding-left:28 mm; margin-top:130mm;"><?= $pk['tktgllahir'];?></p>
<p style="padding-left:87 mm; margin-top:130mm;"><?= $pk['tktmptlahir'];?></p>
<p style="padding-left:136 mm; margin-top:130mm;"><?= $pk['tkjk'];?></p>
<p style="padding-left:35 mm; margin-top:136mm;"><?= $pk['tktgllahir'];?></p>
<p style="padding-left:95 mm; margin-top:136mm;"><?= $pk['tktmptlahir'];?></p>
<p style="padding-left:155 mm; margin-top:136mm;"><?= $pk['tkjk'];?></p>
<p style="padding-left:53 mm; margin-top:143mm;"><?php if($pk['tkstatkwn'] == 0) echo"V";?></p>
<p style="padding-left:93 mm; margin-top:143mm;"><?php if($pk['tkstatkwn'] == 1) echo"V";?></p>
<p style="padding-left:138 mm; margin-top:143mm;"><?php if($pk['tkstatkwn'] == 2) echo"V";?></p>
<p style="padding-left:62 mm; margin-top:155mm;"><?= $pk['tkjmlanaktanggungan'];?></p>
<p style="padding-left:35 mm; margin-top:168mm;"><?= $pk['tkahliwaris'];?></p>
<p style="padding-left:45 mm; margin-top:175mm;"><?= $pk['tkahliwaris'];?></p>
<p style="padding-left:20 mm; margin-top:187mm; font-family:sun-extA;"><?= $pk['tknamacn2'];?></p>
<p style="padding-left:20 mm; margin-top:194mm;"><?= $pk['tknama2'];?></p>
<p style="padding-left:22 mm; margin-top:201mm; font-family:sun-extA;"><?= $pk['tkalmtcn2'];?></p>
<p style="padding-left:22 mm; margin-top:207mm;"><?= $pk['tkalmt2'];?></p>
<p style="padding-left:19 mm; margin-top:214mm;"><?= $pk['tktelp'];?></p>
<p style="padding-left:102 mm; margin-top:214mm;"><?= $pk['tkhub'];?></p>

<p style="padding-left:112 mm; margin-top:253mm;"><barcode code="<?= $bc;?>" type="C39" /></p>
<p style="padding-left:138 mm; margin-top:265mm;"><?= $bc;?></p>

<pagebreak>

<p style="padding-left:67 mm; margin-top:6mm;font-family:sun-extA;"><?= $pk['joposisicn'];?></p>
<p style="padding-left:124 mm; margin-top:19mm;"><?= $pk['joposisi'];?></p>

<p style="padding-left:109 mm; margin-top:46mm;"><?= $pk['jomkthn'];?></p>
<p style="padding-left:122 mm; margin-top:46mm;"><?= $pk['jomkbln'];?></p>
<p style="padding-left:131 mm; margin-top:46mm;">_<?= $pk['jomkhr'];?>_</p>

<p style="padding-left:87 mm; margin-top:66mm;"><?= $pk['jomkthn'];?></p>
<p style="padding-left:107 mm; margin-top:66mm;"><?= $pk['jomkbln'];?></p>
<p style="padding-left:121 mm; margin-top:66mm;">_<?= $pk['jomkhr'];?>_</p>

<p style="padding-left:81 mm; margin-top:123mm;font-family:sun-extA;"><?= $pk['joposisicn'];?></p>
<p style="padding-left:138 mm; margin-top:131mm;"><?= $pk['joposisi'];?></p>

<p style="padding-left:112 mm; margin-top:253mm;"><barcode code="<?= $bc;?>" type="C39" /></p>
<p style="padding-left:138 mm; margin-top:265mm;"><?= $bc;?></p>

<pagebreak>

<p style="padding-left:99 mm; margin-top:22mm;"><?= $pk['jpgaji'];?></p>
<p style="padding-left:171 mm; margin-top:36mm;"><?= $pk['jpgaji'];?></p>

<p style="padding-left:112 mm; margin-top:253mm;"><barcode code="<?= $bc;?>" type="C39" /></p>
<p style="padding-left:138 mm; margin-top:265mm;"><?= $bc;?></p>

<pagebreak>

<p style="padding-left:140 mm; margin-top:62mm;"><?= $pk['joakomodasi'];?></p>
<p style="padding-left:55 mm; margin-top:87mm;"><?= $pk['joakomodasi'];?></p>

<p style="padding-left:96 mm; margin-top:142mm;"><?= $pk['jpgaji']/30;?></p>
<p style="padding-left:136 mm; margin-top:164mm;"><?= $pk['jpgaji']/30;?></p>

<p style="padding-left:66 mm; margin-top:215mm;"><?= $pk['jpgaji']/30;?></p>
<p style="padding-left:120 mm; margin-top:246mm;"><?= $pk['jpgaji']/30;?></p>

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

<p style="padding-left:112 mm; margin-top:253mm;"><barcode code="<?= $bc;?>" type="C39" /></p>
<p style="padding-left:138 mm; margin-top:265mm;"><?= $bc;?></p>

<pagebreak>

<p style="padding-left:3 mm; margin-top:53mm;"><?php if($pk['mjpngjwb'] == "" ) echo $pk['mjnama']; else echo $pk['mjnama']."(".$pk['mjpngjwb'].")";?></p>
<p style="padding-left:96 mm; margin-top:53mm;"><?= $pk['tknama'];?></p>

<p style="padding-left:3 mm; margin-top:73mm;"><?= $pk['agnama'];?></p>
<p style="padding-left:96 mm; margin-top:73mm;"><?= $pk['ppnama'];?></p>


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

<p style="padding-left:3 mm; margin-top:90mm;"><?= $row1; ?><br><?= $row2;?><br><?= $pk['agtelp'];?>&emsp;<?=  $pk['agfax'];?></p>

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

<p style="padding-left:96 mm; margin-top:90mm;"><?= $row1; ?><br><?= $row2;?><br><?= $pk['pptelp'];?>&emsp;<?=  $pk['ppfax'];?></p>

<p style="padding-left:112 mm; margin-top:253mm;"><barcode code="<?= $bc;?>" type="C39" /></p>
<p style="padding-left:138 mm; margin-top:265mm;"><?= $bc;?></p>
