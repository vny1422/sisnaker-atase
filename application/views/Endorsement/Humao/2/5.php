<style>
p{
    font-size:9pt;
    position: absolute;
}

</style>

<?php
    $d = date("d");
    $m = date("m");
    $y = date("Y");
    //echo $d.$m.$y;
?>

<?php
    function row_two($var, $char){
        $alamat= explode(" ",$var);

        $count = 0;
        $row1 = "";
        $row2 = "";
        $i = 0;
        foreach($alamat as $a){
            if($count<$char){
                $row1 = $row1." ".$alamat[$i];
                $count = strlen($row1);
            }else{
                $row2 = $row2." ".$alamat[$i];
            }
            $i++;
        }          
        
        return $row1."<br>".$row2;
    } 
?>
<!-- <p style="padding-left:112 mm; margin-top:253mm;"><barcode code="<?= $bc;?>" type="C39" /></p>
<p style="padding-left:138 mm; margin-top:265mm;"><?= $bc;?></p> -->

<!-- hal 1 -->
<p style="padding-left:33 mm; margin-top:61 mm;"><?= $d;?>&nbsp;</p>
<p style="padding-left:44 mm; margin-top:61 mm;"><?= $m;?>&nbsp;</p>
<p style="padding-left:52 mm; margin-top:61 mm;"><?= $y;?>&nbsp;</p>

<p style="padding-left:44 mm; margin-top:69 mm;"><?= $d;?>&nbsp;</p>
<p style="padding-left:63 mm; margin-top:69 mm;"><?= $m;?>&nbsp;</p>
<p style="padding-left:77 mm; margin-top:69 mm;"><?= $y;?>&nbsp;</p>

<p style="padding-left:31 mm; margin-top:79 mm;"><?= $d;?>&nbsp;</p>
<p style="padding-left:47 mm; margin-top:79 mm;"><?= $m;?>&nbsp;</p>
<p style="padding-left:60 mm; margin-top:79 mm;"><?= $y;?>&nbsp;</p>

<p style="padding-left:101 mm; margin-top:90 mm;"><?= $humao['pppngjwb'];?></p>
<p style="padding-left:101 mm; margin-top:99 mm;"><?= "-";?></p>
<p style="padding-left:101 mm; margin-top:108 mm;"><?= "-";?></p>
<p style="padding-left:101 mm; margin-top:117 mm;"><?= $humao['ppnama'];?></p>
<p style="padding-left:101 mm; margin-top:126 mm;"><?= $humao['ppijin'];?></p>
<p style="padding-left:101 mm; margin-top:135 mm;"><?= row_two($humao['ppalmtkantor'],40);?></p>
<p style="padding-left:101 mm; margin-top:144 mm;"><?= $humao['pptelp'];?></p>
<p style="padding-left:101 mm; margin-top:153 mm;"><?= $humao['ppfax'];?></p>

<p style="padding-left:101 mm; margin-top:196 mm;"><?= $humao['agpngjwb'];?></p>
<p style="padding-left:101 mm; margin-top:205 mm;"><?= "-";?></p>
<p style="padding-left:101 mm; margin-top:214 mm;"><?= "-";?></p>
<p style="padding-left:101 mm; margin-top:223 mm;"><?= $humao['agnama'];?></p>
<p style="padding-left:101 mm; margin-top:232 mm;"><?= $humao['agnoijincla'];?></p>
<p style="padding-left:101 mm; margin-top:244 mm;"><?= row_two($humao['agalmtkantor'],40);?></p>
<p style="padding-left:101 mm; margin-top:260 mm;"><?= $humao['agtelp'];?></p>
<p style="padding-left:101 mm; margin-top:269 mm;"><?= $humao['agfax'];?></p>

<pagebreak>

<!-- hal 2 -->

<pagebreak>
<!-- hal 3 -->
<pagebreak>
<!-- hal 4 -->
<pagebreak>
<!-- hal 5 -->
<pagebreak>

<!-- hal 6 -->

<pagebreak>

<!-- hal 7 -->

<pagebreak>
<!-- hal 8 -->
<p style="padding-left:88 mm; margin-top:84 mm;"><?= "-";?>&nbsp;</p>
<p style="padding-left:123 mm; margin-top:103 mm;"><?= "-";?>&nbsp;</p>
<p style="padding-left:66 mm; margin-top:123 mm;"><?= "-";?>&nbsp;</p>
<pagebreak>
<!-- hal 9 -->
<pagebreak>
<!-- hal 10 -->
<pagebreak>

<!-- hal 11 -->

<pagebreak>

<!-- hal 12 -->

<pagebreak>

<!-- hal 13 -->

<p style="padding-left:14 mm; margin-top:36 mm;"><?= $humao['ppnama'];?></p>
<p style="padding-left:103 mm; margin-top:36 mm;"><?= $humao['agnama'];?></p>
<p style="padding-left:54 mm; margin-top:126 mm;"><?= "-";?></p>

<p style="padding-left:47 mm; margin-top:205 mm;"><?= $humao['agnama'];?></p>
<p style="padding-left:47 mm; margin-top:214 mm;"><?= $humao['agnama'];?></p>
<p style="padding-left:52 mm; margin-top:228 mm;"><?= $humao['agnama'];?></p>

<pagebreak>
<!-- hal 14 -->

<p style="padding-left:47 mm; margin-top:35 mm;"><?= $humao['agpngjwb'];?></p>
<p style="padding-left:120 mm; margin-top:35 mm;"><?= "-";?></p>

<p style="padding-left:55 mm; margin-top:87 mm;"><?= $humao['agnoijincla'];?></p>
<p style="padding-left:68 mm; margin-top:98 mm;"><?= "-";?></p>
<p style="padding-left:110 mm; margin-top:98 mm;"><?= "-";?></p>

<p style="padding-left:45 mm; margin-top:122 mm;"><?= row_two($humao['agalmtkantor'],60);?></p>
<p style="padding-left:41 mm; margin-top:144 mm;"><?= $humao['agtelp'];?></p>
<p style="padding-left:37 mm; margin-top:151 mm;"><?= $humao['agfax'];?></p>
<pagebreak>
<!-- hal 15 -->
<pagebreak>
<!-- hal 16 -->
<pagebreak>
<!-- hal 17 -->
<p style="padding-left:43 mm; margin-top:32 mm;"><?= date("d-m-Y");?></p>
<pagebreak>
<!-- hal 18 -->
<p style="padding-left:98 mm; margin-top:83 mm;"><?= $humao['agnama'];?></p>
<p style="padding-left:98 mm; margin-top:91 mm;"><?= $humao['agnoijincla'];?></p>
<p style="padding-left:98 mm; margin-top:95 mm;"><?= row_two($humao['agalmtkantor'],30);?></p>
<p style="padding-left:98 mm; margin-top:107 mm;"><?= $humao['agtelp'];?></p>
<p style="padding-left:98 mm; margin-top:111 mm;"><?= $humao['agfax'];?></p>
<p style="padding-left:98 mm; margin-top:114 mm;"><?= $humao['agemail'];?></p>

<p style="padding-left:98 mm; margin-top:125 mm;"><?= $humao['agpngjwb'];?></p>
<p style="padding-left:98 mm; margin-top:129 mm;"><?= "-";?></p>
<p style="padding-left:98 mm; margin-top:133 mm;"><?= "-";?></p>
<p style="padding-left:98 mm; margin-top:137 mm;"><?= "-";?></p>
<p style="padding-left:98 mm; margin-top:147 mm;"><?= "-";?></p>
<p style="padding-left:98 mm; margin-top:151 mm;"><?= "-";?></p>

<p style="padding-left:98 mm; margin-top:201 mm;"><?= $humao['ppnama'];?></p>
<p style="padding-left:98 mm; margin-top:208 mm;"><?= $humao['ppijin'];?></p>
<p style="padding-left:98 mm; margin-top:212 mm;"><?= row_two($humao['ppalmtkantor'],30);?></p>
<p style="padding-left:98 mm; margin-top:226 mm;"><?= $humao['pptelp'];?></p>
<p style="padding-left:98 mm; margin-top:230 mm;"><?= $humao['ppfax'];?></p>
<p style="padding-left:98 mm; margin-top:234 mm;"><?= "-";?></p>

<pagebreak>
<!-- hal 19 -->
<p style="padding-left:97 mm; margin-top:10 mm;"><?= $humao['pppngjwb'];?></p>
<p style="padding-left:97 mm; margin-top:13 mm;"><?= "-";?></p>
<p style="padding-left:97 mm; margin-top:16 mm;"><?= "-";?></p>
<p style="padding-left:97 mm; margin-top:19 mm;"><?= "-";?></p>
<p style="padding-left:97 mm; margin-top:35 mm;"><?= "-";?></p>
<p style="padding-left:97 mm; margin-top:38 mm;"><?= "-";?></p>

<p style="padding-left:97 mm; margin-top:51 mm;"><?= "-";?></p>
<p style="padding-left:97 mm; margin-top:60 mm;"><?= "-";?></p>
<p style="padding-left:97 mm; margin-top:69 mm;"><?= "-";?></p>

<p style="padding-left:98 mm; margin-top:115 mm;"><?= $humao['joposisi'];?></p>

<pagebreak>
<!-- hal 20 -->

<pagebreak>
<!-- hal 21 -->
<p style="padding-left:98 mm; margin-top:147 mm;"><?= $humao['jojmltki'];?></p>
<p style="padding-left:98 mm; margin-top:170 mm;"><?= $humao['jomkthn']." years ".$humao['jomkbln']." months ".$humao['jomkhr']." days";?></p>

<p style="padding-left:98 mm; margin-top:221 mm;"><?= "-";?></p>
<p style="padding-left:98 mm; margin-top:229 mm;"><?= "-";?></p>
<p style="padding-left:98 mm; margin-top:239 mm;"><?= "-";?></p>
<p style="padding-left:98 mm; margin-top:249 mm;"><?= "-";?></p> 
<p style="padding-left:98 mm; margin-top:257 mm;"><?= "-";?></p>

<pagebreak>

<!-- hal 22 -->
<p style="padding-left:101 mm; margin-top:57 mm;"><?= "-";?></p>
<p style="padding-left:101 mm; margin-top:80 mm;"><?= "-";?></p>
<p style="padding-left:101 mm; margin-top:93 mm;"><?= "-";?></p>

<p style="padding-left:101 mm; margin-top:150 mm;"><?= "-";?></p>
<p style="padding-left:101 mm; margin-top:167 mm;"><?= "-";?></p>
<p style="padding-left:101 mm; margin-top:179 mm;"><?= "-";?></p>
<p style="padding-left:101 mm; margin-top:193 mm;"><?= "-";?></p>

<pagebreak>
<!-- hal 23 -->
<pagebreak>
<!-- hal 24 -->
<pagebreak>
<!-- hal 25 -->

<p style="padding-left:95 mm; margin-top:43 mm;"><?= $humao['agnama'];?></p>
<p style="padding-left:95 mm; margin-top:50 mm;"><?= $humao['agnama'];?></p>
<p style="padding-left:45 mm; margin-top:71 mm;"><?= "-";?></p>
<p style="padding-left:45 mm; margin-top:78 mm;"><?= "-";?></p>

<p style="padding-left:108 mm; margin-top:204 mm;"><?= "-";?></p>
<p style="padding-left:108 mm; margin-top:214 mm;"><?= date("d-m-Y");?></p>

<p style="padding-left:75 mm; margin-top:256 mm;"><?= $humao['agpngjwb'];?></p>
<p style="padding-left:71 mm; margin-top:262 mm;"><?= $humao['agpngjwb'];?></p>
<p style="padding-left:80 mm; margin-top:267 mm;"><?= $humao['agpngjwb'];?></p>