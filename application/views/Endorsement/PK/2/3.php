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
<p style="padding-left:90 mm; margin-top:38mm; font-family:sun-extA;"><?php if($pk['mjpngjwb'] == "" ) echo $pk['mjnama']; else echo $pk['mjnama']."(".$pk['mjpngjwb'].")";?></p>
<p style="padding-left:78 mm; margin-top:46mm;"><?php if($pk['mjpngjwbcn'] == "" ) echo $pk['mjnamacn']; else echo $pk['mjnamacn']."(".$pk['mjpngjwbcn'].")";?></p>
<p style="padding-left:15 mm; margin-top:52mm;"><?= $pk['mjalmtcn'];?></p>
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
<p style="padding-left:55 mm; margin-top:150mm;">V</p>
<p style="padding-left:37 mm; margin-top:98mm;"><?= $pk['tknama'];?></p>
<p style="padding-left:37 mm; margin-top:98mm;"><?= $pk['tknama'];?></p>
<p style="padding-left:37 mm; margin-top:98mm;"><?= $pk['tknama'];?></p>
<p style="padding-left:37 mm; margin-top:98mm;"><?= $pk['tknama'];?></p>
<p style="padding-left:37 mm; margin-top:98mm;"><?= $pk['tknama'];?></p>
<p style="padding-left:37 mm; margin-top:98mm;"><?= $pk['tknama'];?></p>
<p style="padding-left:37 mm; margin-top:98mm;"><?= $pk['tknama'];?></p>
<p style="padding-left:37 mm; margin-top:98mm;"><?= $pk['tknama'];?></p>
<p style="padding-left:37 mm; margin-top:98mm;"><?= $pk['tknama'];?></p>
<p style="padding-left:37 mm; margin-top:98mm;"><?= $pk['tknama'];?></p>
<p style="padding-left:37 mm; margin-top:98mm;"><?= $pk['tknama'];?></p>
<p style="padding-left:37 mm; margin-top:98mm;"><?= $pk['tknama'];?></p>
<p style="padding-left:37 mm; margin-top:98mm;"><?= $pk['tknama'];?></p>
<p style="padding-left:37 mm; margin-top:98mm;"><?= $pk['tknama'];?></p>





