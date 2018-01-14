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

<p style="padding-left:18 mm; margin-top:3mm;"><?= $row1;?></p>
<p style="padding-left:-5 mm; margin-top:10mm;"><?= $row2;?></p>
<p style="padding-left:-5 mm; margin-top:16mm;"><?= $pk['agtelp'];?>&emsp;<?= $pk['agfax'];?></p>
<p style="padding-left:-5 mm; margin-top:22mm;">Agency's MOL License Number : <?= $pk['agnoijincla'];?></p>

<p style="padding-left:71 mm; margin-top:41mm; font-family:sun-extA;"><?php if($pk['mjpngjwbcn'] == "" ) echo $pk['mjnamacn']; else echo $pk['mjnamacn']."(".$pk['mjpngjwbcn'].")";?></p>
<p style="padding-left:40 mm; margin-top:48mm;"><?php if($pk['mjpngjwb'] == "" ) echo $pk['mjnama']; else echo $pk['mjnama']."(".$pk['mjpngjwb'].")";?></p>
<p style="padding-left:25 mm; margin-top:55mm; font-family:sun-extA;"><?= $pk['mjalmtcn'];?></p>
<p style="padding-left:21 mm; margin-top:62mm;"><?= $pk['mjalmt'];?></p>
<p style="padding-left:18 mm; margin-top:68mm;"><?= $pk['mjtelp'];?></p>

<p style="padding-left:35 mm; margin-top:102mm;"><?= $pk['tknama'];?></p>
<p style="padding-left:48 mm; margin-top:115mm;"><?= $pk['tkalmtid'];?></p>
<p style="padding-left:77 mm; margin-top:129mm;"><?= $pk['tkpaspor'];?><br><?= $pk['tktglkeluar']."/".$pk['tktmptkeluar'];?></p>
<p style="padding-left:26 mm; margin-top:141mm;"><?= $pk['tktgllahir'];?></p>
<p style="padding-left:85 mm; margin-top:141mm;"><?= $pk['tktmptlahir'];?></p>
<p style="padding-left:134 mm; margin-top:141mm;"><?= $pk['tkjk'];?></p>
<p style="padding-left:33 mm; margin-top:148mm;"><?= $pk['tktgllahir'];?></p>
<p style="padding-left:93 mm; margin-top:148mm;"><?= $pk['tktmptlahir'];?></p>
<p style="padding-left:153 mm; margin-top:148mm;"><?= $pk['tkjk'];?></p>
<p style="padding-left:46 mm; margin-top:155mm;"><?php if($pk['tkstatkwn'] == 0) echo"V";?></p>
<p style="padding-left:86 mm; margin-top:155mm;"><?php if($pk['tkstatkwn'] == 1) echo"V";?></p>
<p style="padding-left:131 mm; margin-top:155mm;"><?php if($pk['tkstatkwn'] == 2) echo"V";?></p>
<p style="padding-left:60 mm; margin-top:172mm;"><?= $pk['tkjmlanaktanggungan'];?></p>
<p style="padding-left:33 mm; margin-top:185mm;"><?= $pk['tkahliwaris'];?></p>
<p style="padding-left:43 mm; margin-top:192mm;"><?= $pk['tkahliwaris'];?></p>
<p style="padding-left:18 mm; margin-top:206mm; font-family:sun-extA;"><?= $pk['tknamacn2'];?></p>
<p style="padding-left:18 mm; margin-top:213mm;"><?= $pk['tknama2'];?></p>
<p style="padding-left:20 mm; margin-top:219mm; font-family:sun-extA;"><?= $pk['tkalmtcn2'];?></p>
<p style="padding-left:20 mm; margin-top:225mm;"><?= $pk['tkalmt2'];?></p>
<p style="padding-left:17 mm; margin-top:233mm;"><?= $pk['tktelp'];?></p>
<p style="padding-left:100 mm; margin-top:233mm;"><?= $pk['tkhub'];?></p>

<p style="padding-left:112 mm; margin-top:253mm;"><barcode code="<?= $bc;?>" type="C39" /></p>
<p style="padding-left:142 mm; margin-top:265mm;"><?= $bc;?></p>

<pagebreak>

<p style="padding-left:106 mm; margin-top:46mm;"><?= $pk['jomkthn'];?></p>
<p style="padding-left:118 mm; margin-top:46mm;"><?= $pk['jomkbln'];?></p>
<p style="padding-left:129 mm; margin-top:46mm;"><?= $pk['jomkhr'];?></p>

<p style="padding-left:84 mm; margin-top:66mm;"><?= $pk['jomkthn'];?></p>
<p style="padding-left:104 mm; margin-top:66mm;"><?= $pk['jomkbln'];?></p>
<p style="padding-left:120 mm; margin-top:66mm;"><?= $pk['jomkhr'];?></p>

<p style="padding-left:90 mm; margin-top:183mm;"><?= $pk['jpgaji'];?></p>
<p style="padding-left:165 mm; margin-top:196mm;"><?= $pk['jpgaji'];?></p>

<p style="padding-left:112 mm; margin-top:253mm;"><barcode code="<?= $bc;?>" type="C39" /></p>
<p style="padding-left:142 mm; margin-top:265mm;"><?= $bc;?></p>

<pagebreak>

<p style="padding-left:77 mm; margin-top:81mm;"><?= $pk['jpgaji']/30;?></p>
<p style="padding-left:112 mm; margin-top:102mm;"><?= $pk['jpgaji']/30;?></p>

<p style="padding-left:58 mm; margin-top:139mm;"><?= $pk['jpgaji']/30;?></p>
<p style="padding-left:54 mm; margin-top:161mm;"><?= $pk['jpgaji']/30;?></p>

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

<p style="padding-left:0 mm; margin-top:60mm;"><?php if($pk['mjpngjwb'] == "" ) echo $pk['mjnama']; else echo $pk['mjnama']."(".$pk['mjpngjwb'].")";?></p>
<p style="padding-left:93 mm; margin-top:60mm;"><?= $pk['tknama'];?></p>

<p style="padding-left:0 mm; margin-top:80mm;"><?= $pk['agnama'];?></p>
<p style="padding-left:93 mm; margin-top:80mm;"><?= $pk['ppnama'];?></p>


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

<p style="padding-left:0 mm; margin-top:98mm;"><?= $row1; ?><br><?= $row2;?><br><?= $pk['agtelp'];?>&emsp;<?=  $pk['agfax'];?></p>

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

<p style="padding-left:93 mm; margin-top:98mm;"><?= $row1; ?><br><?= $row2;?><br><?= $pk['pptelp'];?>&emsp;<?=  $pk['ppfax'];?></p>

<p style="padding-left:112 mm; margin-top:253mm;"><barcode code="<?= $bc;?>" type="C39" /></p>
<p style="padding-left:142 mm; margin-top:265mm;"><?= $bc;?></p>
