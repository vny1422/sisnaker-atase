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
<p style="padding-left:33 mm; margin-top:49 mm;"><?= $d;?>&nbsp;</p>
<p style="padding-left:44 mm; margin-top:49 mm;"><?= $m;?>&nbsp;</p>
<p style="padding-left:52 mm; margin-top:49 mm;"><?= $y;?>&nbsp;</p>

<p style="padding-left:48 mm; margin-top:54 mm;"><?= $d;?>&nbsp;</p>
<p style="padding-left:69 mm; margin-top:54 mm;"><?= $m;?>&nbsp;</p>
<p style="padding-left:87 mm; margin-top:54 mm;"><?= $y;?>&nbsp;</p>

<p style="padding-left:38 mm; margin-top:65 mm;"><?= $d;?>&nbsp;</p>
<p style="padding-left:60 mm; margin-top:65 mm;"><?= $m;?>&nbsp;</p>
<p style="padding-left:82 mm; margin-top:65 mm;"><?= $y;?>&nbsp;</p>

<p style="padding-left:97 mm; margin-top:85 mm;"><?= $humao['pppngjwb'];?></p>
<p style="padding-left:97 mm; margin-top:97 mm;"><?= "-";?></p>
<p style="padding-left:97 mm; margin-top:109 mm;"><?= "-";?></p>
<p style="padding-left:97 mm; margin-top:120 mm;"><?= $humao['ppnama'];?></p>
<p style="padding-left:97 mm; margin-top:132 mm;"><?= $humao['ppijin'];?></p>
<p style="padding-left:97 mm; margin-top:144 mm;"><?= row_two($humao['ppalmtkantor'],40);?></p>
<p style="padding-left:97 mm; margin-top:156 mm;"><?= $humao['pptelp'];?></p>
<p style="padding-left:97 mm; margin-top:168 mm;"><?= $humao['ppfax'];?></p>

<p style="padding-left:37 mm; margin-top:178 mm;"><?= $humao['pppngjwb'];?></p>
<p style="padding-left:117 mm; margin-top:178 mm;"><?= $humao['ppnama'];?></p>
<p style="padding-left:65 mm; margin-top:191 mm;"><?= $humao['pppngjwb'];?></p>
<p style="padding-left:85 mm; margin-top:196 mm;"><?= $humao['ppnama'];?></p>
<p style="padding-left:65 mm; margin-top:209 mm;"><?= $humao['pppngjwb'];?></p>
<p style="padding-left:50 mm; margin-top:214 mm;"><?= $humao['ppnama'];?></p>

<p style="padding-left:97 mm; margin-top:231 mm;"><?= $humao['agpngjwb'];?></p>
<p style="padding-left:97 mm; margin-top:243 mm;"><?= "-";?></p>
<p style="padding-left:97 mm; margin-top:255 mm;"><?= "-";?></p>
<p style="padding-left:97 mm; margin-top:267 mm;"><?= $humao['agnama'];?></p>

<pagebreak>

<!-- hal 2 -->
<p style="padding-left:97 mm; margin-top:2 mm;"><?= $humao['agnoijincla'];?></p>
<p style="padding-left:97 mm; margin-top:17 mm;"><?= row_two($humao['agalmtkantor'],40);?></p>
<p style="padding-left:97 mm; margin-top:33 mm;"><?= $humao['agtelp'];?></p>
<p style="padding-left:97 mm; margin-top:45 mm;"><?= $humao['agfax'];?></p>

<p style="padding-left:37 mm; margin-top:60 mm;"><?= $humao['agpngjwb'];?></p>
<p style="padding-left:96 mm; margin-top:60 mm;"><?= $humao['agnama'];?></p>
<p style="padding-left:62 mm; margin-top:71 mm;"><?= $humao['agpngjwb'];?></p>
<p style="padding-left:21 mm; margin-top:75 mm;"><?= $humao['agnama'];?></p>
<p style="padding-left:63 mm; margin-top:83 mm;"><?= $humao['agpngjwb'];?></p>
<p style="padding-left:29 mm; margin-top:87 mm;"><?= $humao['agnama'];?></p>

<pagebreak>
<!-- hal 3 -->
<pagebreak>
<!-- hal 4 -->
<pagebreak>
<!-- hal 5 -->
<pagebreak>

<!-- hal 6 -->
<p style="padding-left:128 mm; margin-top:191 mm;"><?= "-";?></p>
<p style="padding-left:78 mm; margin-top:215 mm;"><?= "-";?></p>
<p style="padding-left:129 mm; margin-top:236 mm;"><?= "-";?></p>

<p style="padding-left:98 mm; margin-top:255 mm;"><?= "-";?></p>
<p style="padding-left:98 mm; margin-top:263 mm;"><?= "-";?></p>
<p style="padding-left:98 mm; margin-top:271 mm;"><?= "-";?></p>

<pagebreak>

<!-- hal 7 -->
<p style="padding-left:98 mm; margin-top:1 mm;"><?= "-";?></p>

<p style="padding-left:46 mm; margin-top:33 mm;"><?= "-";?></p>
<p style="padding-left:90 mm; margin-top:33 mm;"><?= "-";?>&nbsp;</p>
<p style="padding-left:33 mm; margin-top:47 mm;"><?= "-";?></p>
<p style="padding-left:79 mm; margin-top:47 mm;"><?= "-";?>&nbsp;</p>
<p style="padding-left:140 mm; margin-top:57 mm;"><?= "-";?></p>
<p style="padding-left:43 mm; margin-top:60 mm;"><?= "-";?>&nbsp;</p>

<p style="padding-left:80 mm; margin-top:224 mm;"><?= "-";?>&nbsp;</p>
<p style="padding-left:100 mm; margin-top:237 mm;"><?= "-";?>&nbsp;</p>
<p style="padding-left:73 mm; margin-top:254 mm;"><?= "-";?>&nbsp;</p>

<pagebreak>
<!-- hal 8 -->
<pagebreak>
<!-- hal 9 -->
<pagebreak>
<!-- hal 10 -->
<pagebreak>

<!-- hal 11 -->

<p style="padding-left:14 mm; margin-top:174 mm;"><?= $humao['ppnama'];?></p>
<p style="padding-left:81 mm; margin-top:174 mm;"><?= $humao['agnama'];?></p>
<p style="padding-left:60 mm; margin-top:254 mm;"><?= "-";?></p>

<pagebreak>

<!-- hal 12 -->

<p style="padding-left:96 mm; margin-top:115 mm;"><?= $humao['agnama'];?></p>
<p style="padding-left:96 mm; margin-top:122 mm;"><?= $humao['agnoijincla'];?></p>
<p style="padding-left:96 mm; margin-top:126 mm;"><?= row_two($humao['agalmtkantor'],30);?></p>
<p style="padding-left:96 mm; margin-top:138 mm;"><?= $humao['agtelp'];?></p>
<p style="padding-left:96 mm; margin-top:142 mm;"><?= $humao['agfax'];?></p>
<p style="padding-left:96 mm; margin-top:146 mm;"><?= $humao['agemail'];?></p>

<p style="padding-left:96 mm; margin-top:157 mm;"><?= $humao['agpngjwb'];?></p>
<p style="padding-left:96 mm; margin-top:161 mm;"><?= "-";?></p>
<p style="padding-left:96 mm; margin-top:165 mm;"><?= "-";?></p>
<p style="padding-left:96 mm; margin-top:169 mm;"><?= "-";?></p>
<p style="padding-left:96 mm; margin-top:179 mm;"><?= "-";?></p>
<p style="padding-left:96 mm; margin-top:183 mm;"><?= "-";?></p>

<p style="padding-left:97 mm; margin-top:236 mm;"><?= $humao['ppnama'];?></p>
<p style="padding-left:97 mm; margin-top:241 mm;"><?= $humao['ppijin'];?></p>
<p style="padding-left:97 mm; margin-top:245 mm;"><?= row_two($humao['ppalmtkantor'],30);?></p>
<p style="padding-left:97 mm; margin-top:260 mm;"><?= $humao['pptelp'];?></p>
<p style="padding-left:97 mm; margin-top:264 mm;"><?= $humao['ppfax'];?></p>
<p style="padding-left:97 mm; margin-top:268 mm;"><?= "-";?></p>

<pagebreak>

<!-- hal 13 -->
<p style="padding-left:97 mm; margin-top:4 mm;"><?= $humao['pppngjwb'];?></p>
<p style="padding-left:97 mm; margin-top:7 mm;"><?= "-";?></p>
<p style="padding-left:97 mm; margin-top:11 mm;"><?= "-";?></p>
<p style="padding-left:97 mm; margin-top:15 mm;"><?= "-";?></p>
<p style="padding-left:97 mm; margin-top:27 mm;"><?= "-";?></p>
<p style="padding-left:97 mm; margin-top:31 mm;"><?= "-";?></p>

<p style="padding-left:97 mm; margin-top:46 mm;"><?= "-";?></p>
<p style="padding-left:97 mm; margin-top:53 mm;"><?= "-";?></p>
<p style="padding-left:97 mm; margin-top:61 mm;"><?= "-";?></p>

<p style="padding-left:101 mm; margin-top:99 mm;"><?= $humao['joposisi'];?></p>
<p style="padding-left:101 mm; margin-top:103 mm;"><?= "-";?></p>
<p style="padding-left:101 mm; margin-top:107 mm;"><?= "-";?></p>
<p style="padding-left:101 mm; margin-top:111 mm;"><?= "-";?></p>
<p style="padding-left:101 mm; margin-top:115 mm;"><?= "-";?></p>

<p style="padding-left:97 mm; margin-top:122 mm;"><?= "-";?></p>
<p style="padding-left:97 mm; margin-top:137 mm;"><?= $humao['jojmltki'];?></p>
<p style="padding-left:97 mm; margin-top:152 mm;"><?= $humao['jomkthn']." years ".$humao['jomkbln']." months ".$humao['jomkhr']." days";?></p>

<p style="padding-left:98 mm; margin-top:196 mm;"><?= "-";?></p>
<p style="padding-left:98 mm; margin-top:205 mm;"><?= "-";?></p>
<p style="padding-left:98 mm; margin-top:213 mm;"><?= "-";?></p>
<p style="padding-left:98 mm; margin-top:221 mm;"><?= "-";?></p>
<p style="padding-left:98 mm; margin-top:232 mm;"><?= "-";?></p>

<pagebreak>
<!-- hal 14 -->

<p style="padding-left:101 mm; margin-top:47 mm;"><?= "-";?></p>
<p style="padding-left:101 mm; margin-top:70 mm;"><?= "-";?></p>
<p style="padding-left:101 mm; margin-top:83 mm;"><?= "-";?></p>

<p style="padding-left:98 mm; margin-top:137 mm;"><?= "-";?></p>
<p style="padding-left:98 mm; margin-top:154 mm;"><?= "-";?></p>
<p style="padding-left:98 mm; margin-top:166 mm;"><?= "-";?></p>
<p style="padding-left:98 mm; margin-top:180 mm;"><?= "-";?></p>

<pagebreak>
<!-- hal 15 -->
<pagebreak>
<!-- hal 16 -->
<pagebreak>
<!-- hal 17 -->

<p style="padding-left:47 mm; margin-top:50 mm;"><?= $humao['agnama'];?></p>
<p style="padding-left:47 mm; margin-top:59 mm;"><?= $humao['agnama'];?></p>
<p style="padding-left:52 mm; margin-top:73 mm;"><?= $humao['agnama'];?></p>

<p style="padding-left:47 mm; margin-top:118 mm;"><?= $humao['agpngjwb'];?></p>
<p style="padding-left:28 mm; margin-top:123 mm;"><?= "-";?></p>

<p style="padding-left:55 mm; margin-top:166 mm;"><?= $humao['agnoijincla'];?></p>
<p style="padding-left:68 mm; margin-top:177 mm;"><?= "-";?></p>
<p style="padding-left:110 mm; margin-top:177 mm;"><?= "-";?></p>

<p style="padding-left:45 mm; margin-top:198 mm;"><?= row_two($humao['agalmtkantor'],60);?></p>
<p style="padding-left:41 mm; margin-top:221 mm;"><?= $humao['agtelp'];?></p>
<p style="padding-left:37 mm; margin-top:226 mm;"><?= $humao['agfax'];?></p>

<pagebreak>
<!-- hal 18 -->
<pagebreak>
<!-- hal 19 -->
<pagebreak>
<!-- hal 20 -->

<p style="padding-left:43 mm; margin-top:125 mm;"><?= date("d-m-Y");?></p>

<pagebreak>
<!-- hal 21 -->

<p style="padding-left:105 mm; margin-top:33 mm;"><?= $humao['agnama'];?></p>
<p style="padding-left:105 mm; margin-top:40 mm;"><?= $humao['agnama'];?></p>
<p style="padding-left:55 mm; margin-top:61 mm;"><?= "-";?></p>
<p style="padding-left:55 mm; margin-top:68 mm;"><?= "-";?></p>

<p style="padding-left:117 mm; margin-top:194 mm;"><?= "-";?></p>
<p style="padding-left:117 mm; margin-top:204 mm;"><?= date("d-m-Y");?></p>

<p style="padding-left:83 mm; margin-top:251 mm;"><?= $humao['agpngjwb'];?></p>
<p style="padding-left:79 mm; margin-top:257 mm;"><?= $humao['agpngjwb'];?></p>
<p style="padding-left:88 mm; margin-top:262 mm;"><?= $humao['agpngjwb'];?></p>