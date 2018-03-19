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
<p style="padding-left:33 mm; margin-top:59 mm;"><?= $d;?>&nbsp;</p>
<p style="padding-left:44 mm; margin-top:59 mm;"><?= $m;?>&nbsp;</p>
<p style="padding-left:52 mm; margin-top:59 mm;"><?= $y;?>&nbsp;</p>

<p style="padding-left:48 mm; margin-top:67 mm;"><?= $d;?>&nbsp;</p>
<p style="padding-left:67 mm; margin-top:67 mm;"><?= $m;?>&nbsp;</p>
<p style="padding-left:87 mm; margin-top:67 mm;"><?= $y;?>&nbsp;</p>

<p style="padding-left:38 mm; margin-top:77 mm;"><?= $d;?>&nbsp;</p>
<p style="padding-left:60 mm; margin-top:77 mm;"><?= $m;?>&nbsp;</p>
<p style="padding-left:82 mm; margin-top:77 mm;"><?= $y;?>&nbsp;</p>

<p style="padding-left:97 mm; margin-top:97 mm;"><?= $humao['pppngjwb'];?></p>
<p style="padding-left:97 mm; margin-top:109 mm;"><?= "-";?></p>
<p style="padding-left:97 mm; margin-top:121 mm;"><?= "-";?></p>
<p style="padding-left:97 mm; margin-top:133 mm;"><?= $humao['ppnama'];?></p>
<p style="padding-left:97 mm; margin-top:144 mm;"><?= $humao['ppijin'];?></p>
<p style="padding-left:97 mm; margin-top:156 mm;"><?= row_two($humao['ppalmtkantor'],40);?></p>
<p style="padding-left:97 mm; margin-top:168 mm;"><?= $humao['pptelp'];?></p>
<p style="padding-left:97 mm; margin-top:180 mm;"><?= $humao['ppfax'];?></p>

<p style="padding-left:37 mm; margin-top:190 mm;"><?= $humao['pppngjwb'];?></p>
<p style="padding-left:124 mm; margin-top:190 mm;"><?= $humao['ppnama'];?></p>
<p style="padding-left:65 mm; margin-top:203 mm;"><?= $humao['pppngjwb'];?></p>
<p style="padding-left:85 mm; margin-top:207 mm;"><?= $humao['ppnama'];?></p>
<p style="padding-left:65 mm; margin-top:217 mm;"><?= $humao['pppngjwb'];?></p>
<p style="padding-left:52 mm; margin-top:221 mm;"><?= $humao['ppnama'];?></p>

<p style="padding-left:97 mm; margin-top:233 mm;"><?= $humao['agpngjwb'];?></p>
<p style="padding-left:97 mm; margin-top:245 mm;"><?= "-";?></p>
<p style="padding-left:97 mm; margin-top:257 mm;"><?= "-";?></p>

<pagebreak>

<!-- hal 2 -->
<p style="padding-left:97 mm; margin-top:1 mm;"><?= $humao['agnama'];?></p>
<p style="padding-left:97 mm; margin-top:9 mm;"><?= $humao['agnoijincla'];?></p>
<p style="padding-left:97 mm; margin-top:25 mm;"><?= row_two($humao['agalmtkantor'],40);?></p>
<p style="padding-left:97 mm; margin-top:41 mm;"><?= $humao['agtelp'];?></p>
<p style="padding-left:97 mm; margin-top:53 mm;"><?= $humao['agfax'];?></p>

<p style="padding-left:37 mm; margin-top:63 mm;"><?= $humao['agpngjwb'];?></p>
<p style="padding-left:97 mm; margin-top:63 mm;"><?= $humao['agnama'];?></p>
<p style="padding-left:62 mm; margin-top:74 mm;"><?= $humao['agpngjwb'];?></p>
<p style="padding-left:21 mm; margin-top:78 mm;"><?= $humao['agnama'];?></p>
<p style="padding-left:63 mm; margin-top:86 mm;"><?= $humao['agpngjwb'];?></p>
<p style="padding-left:29 mm; margin-top:90 mm;"><?= $humao['agnama'];?></p>

<pagebreak>
<!-- hal 3 -->
<pagebreak>
<!-- hal 4 -->
<pagebreak>
<!-- hal 5 -->
<pagebreak>

<!-- hal 6 -->
<p style="padding-left:19 mm; margin-top:121 mm;"><?= "-";?></p>
<p style="padding-left:45 mm; margin-top:141 mm;"><?= "-";?></p>
<p style="padding-left:19 mm; margin-top:165 mm;"><?= "-";?></p>

<p style="padding-left:98 mm; margin-top:184 mm;"><?= "-";?></p>
<p style="padding-left:98 mm; margin-top:192 mm;"><?= "-";?></p>
<p style="padding-left:98 mm; margin-top:200 mm;"><?= "-";?></p>
<p style="padding-left:98 mm; margin-top:208 mm;"><?= "-";?></p>

<p style="padding-left:48 mm; margin-top:220 mm;"><?= "-";?></p>
<p style="padding-left:93 mm; margin-top:220 mm;"><?= "-";?>&nbsp;</p>
<p style="padding-left:19 mm; margin-top:234 mm;"><?= "-";?></p>
<p style="padding-left:67 mm; margin-top:234 mm;"><?= "-";?>&nbsp;</p>
<p style="padding-left:27 mm; margin-top:247 mm;"><?= "-";?></p>
<p style="padding-left:78 mm; margin-top:247 mm;"><?= "-";?>&nbsp;</p>

<pagebreak>

<!-- hal 7 -->

<p style="padding-left:83 mm; margin-top:152 mm;"><?= "-";?>&nbsp;</p>
<p style="padding-left:80 mm; margin-top:165 mm;"><?= "-";?>&nbsp;</p>
<p style="padding-left:93 mm; margin-top:180 mm;"><?= "-";?>&nbsp;</p>

<pagebreak>
<!-- hal 8 -->
<pagebreak>
<!-- hal 9 -->
<pagebreak>
<!-- hal 10 -->
<pagebreak>

<!-- hal 11 -->

<p style="padding-left:14 mm; margin-top:188 mm;"><?= $humao['ppnama'];?></p>
<p style="padding-left:83 mm; margin-top:188 mm;"><?= $humao['agnama'];?></p>
<p style="padding-left:60 mm; margin-top:263 mm;"><?= "-";?></p>

<pagebreak>

<!-- hal 12 -->

<p style="padding-left:96 mm; margin-top:162 mm;"><?= $humao['agnama'];?></p>
<p style="padding-left:96 mm; margin-top:171 mm;"><?= $humao['agnoijincla'];?></p>
<p style="padding-left:96 mm; margin-top:175 mm;"><?= row_two($humao['agalmtkantor'],30);?></p>
<p style="padding-left:96 mm; margin-top:187 mm;"><?= $humao['agtelp'];?></p>
<p style="padding-left:96 mm; margin-top:191 mm;"><?= $humao['agfax'];?></p>
<p style="padding-left:96 mm; margin-top:194 mm;"><?= $humao['agemail'];?></p>

<p style="padding-left:96 mm; margin-top:206 mm;"><?= $humao['agpngjwb'];?></p>
<p style="padding-left:96 mm; margin-top:210 mm;"><?= "-";?></p>
<p style="padding-left:96 mm; margin-top:214 mm;"><?= "-";?></p>
<p style="padding-left:96 mm; margin-top:218 mm;"><?= "-";?></p>
<p style="padding-left:96 mm; margin-top:228 mm;"><?= "-";?></p>
<p style="padding-left:96 mm; margin-top:232 mm;"><?= "-";?></p>

<pagebreak>

<!-- hal 13 -->

<p style="padding-left:97 mm; margin-top:28 mm;"><?= $humao['ppnama'];?></p>
<p style="padding-left:97 mm; margin-top:35 mm;"><?= $humao['ppijin'];?></p>
<p style="padding-left:97 mm; margin-top:39 mm;"><?= row_two($humao['ppalmtkantor'],30);?></p>
<p style="padding-left:97 mm; margin-top:53 mm;"><?= $humao['pptelp'];?></p>
<p style="padding-left:97 mm; margin-top:57 mm;"><?= $humao['ppfax'];?></p>
<p style="padding-left:97 mm; margin-top:61 mm;"><?= "-";?></p>

<p style="padding-left:97 mm; margin-top:70 mm;"><?= $humao['pppngjwb'];?></p>
<p style="padding-left:97 mm; margin-top:73 mm;"><?= "-";?></p>
<p style="padding-left:97 mm; margin-top:76 mm;"><?= "-";?></p>
<p style="padding-left:97 mm; margin-top:80 mm;"><?= "-";?></p>
<p style="padding-left:97 mm; margin-top:95 mm;"><?= "-";?></p>
<p style="padding-left:97 mm; margin-top:99 mm;"><?= "-";?></p>

<p style="padding-left:97 mm; margin-top:111 mm;"><?= "-";?></p>
<p style="padding-left:97 mm; margin-top:120 mm;"><?= "-";?></p>
<p style="padding-left:97 mm; margin-top:129 mm;"><?= "-";?></p>

<p style="padding-left:101 mm; margin-top:165 mm;"><?= $humao['joposisi'];?></p>
<p style="padding-left:101 mm; margin-top:169 mm;"><?= "-";?></p>
<p style="padding-left:101 mm; margin-top:173 mm;"><?= "-";?></p>
<p style="padding-left:101 mm; margin-top:177 mm;"><?= "-";?></p>
<p style="padding-left:101 mm; margin-top:181 mm;"><?= "-";?></p>

<p style="padding-left:97 mm; margin-top:188 mm;"><?= "-";?></p>
<p style="padding-left:97 mm; margin-top:201 mm;"><?= $humao['jojmltki'];?></p>
<p style="padding-left:97 mm; margin-top:216 mm;"><?= $humao['jomkthn']." years ".$humao['jomkbln']." months ".$humao['jomkhr']." days";?></p>

<p style="padding-left:98 mm; margin-top:261 mm;"><?= "-";?></p>

<pagebreak>
<!-- hal 14 -->

<p style="padding-left:98 mm; margin-top:1 mm;"><?= "-";?></p>
<p style="padding-left:98 mm; margin-top:9 mm;"><?= "-";?></p>
<p style="padding-left:98 mm; margin-top:17 mm;"><?= "-";?></p>
<p style="padding-left:98 mm; margin-top:28 mm;"><?= "-";?></p> 

<p style="padding-left:101 mm; margin-top:104 mm;"><?= "-";?></p>
<p style="padding-left:101 mm; margin-top:127 mm;"><?= "-";?></p>
<p style="padding-left:101 mm; margin-top:140 mm;"><?= "-";?></p>

<p style="padding-left:98 mm; margin-top:197 mm;"><?= "-";?></p>
<p style="padding-left:98 mm; margin-top:214 mm;"><?= "-";?></p>
<p style="padding-left:98 mm; margin-top:226 mm;"><?= "-";?></p>
<p style="padding-left:98 mm; margin-top:240 mm;"><?= "-";?></p>

<pagebreak>
<!-- hal 15 -->
<pagebreak>
<!-- hal 16 -->
<pagebreak>
<!-- hal 17 -->

<p style="padding-left:47 mm; margin-top:37 mm;"><?= $humao['agnama'];?></p>
<p style="padding-left:47 mm; margin-top:46 mm;"><?= $humao['agnama'];?></p>
<p style="padding-left:52 mm; margin-top:60 mm;"><?= $humao['agnama'];?></p>

<p style="padding-left:47 mm; margin-top:105 mm;"><?= $humao['agpngjwb'];?></p>
<p style="padding-left:28 mm; margin-top:110 mm;"><?= "-";?></p>

<p style="padding-left:55 mm; margin-top:153 mm;"><?= $humao['agnoijincla'];?></p>
<p style="padding-left:68 mm; margin-top:164 mm;"><?= "-";?></p>
<p style="padding-left:110 mm; margin-top:164 mm;"><?= "-";?></p>

<p style="padding-left:45 mm; margin-top:185 mm;"><?= row_two($humao['agalmtkantor'],60);?></p>
<p style="padding-left:41 mm; margin-top:207 mm;"><?= $humao['agtelp'];?></p>
<p style="padding-left:37 mm; margin-top:211 mm;"><?= $humao['agfax'];?></p>

<pagebreak>
<!-- hal 18 -->
<pagebreak>
<!-- hal 19 -->
<pagebreak>
<!-- hal 20 -->

<p style="padding-left:43 mm; margin-top:105 mm;"><?= date("d-m-Y");?></p>

<pagebreak>
<!-- hal 21 -->

<p style="padding-left:105 mm; margin-top:33 mm;"><?= $humao['agnama'];?></p>
<p style="padding-left:105 mm; margin-top:40 mm;"><?= $humao['agnama'];?></p>
<p style="padding-left:55 mm; margin-top:61 mm;"><?= "-";?></p>
<p style="padding-left:55 mm; margin-top:68 mm;"><?= "-";?></p>

<p style="padding-left:117 mm; margin-top:200 mm;"><?= "-";?></p>
<p style="padding-left:117 mm; margin-top:210 mm;"><?= date("d-m-Y");?></p>

<p style="padding-left:83 mm; margin-top:256 mm;"><?= $humao['agpngjwb'];?></p>
<p style="padding-left:79 mm; margin-top:262 mm;"><?= $humao['agpngjwb'];?></p>
<p style="padding-left:88 mm; margin-top:267 mm;"><?= $humao['agpngjwb'];?></p>