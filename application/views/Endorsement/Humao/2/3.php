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

<p style="padding-left:97 mm; margin-top:238 mm;"><?= $humao['agpngjwb'];?></p>
<p style="padding-left:97 mm; margin-top:250 mm;"><?= "-";?></p>


<pagebreak>

<!-- hal 2 -->
<p style="padding-left:97 mm; margin-top:1 mm;"><?= "-";?></p>
<p style="padding-left:97 mm; margin-top:12 mm;"><?= $humao['agnama'];?></p>
<p style="padding-left:97 mm; margin-top:21 mm;"><?= $humao['agnoijincla'];?></p>
<p style="padding-left:97 mm; margin-top:33 mm;"><?= row_two($humao['agalmtkantor'],40);?></p>
<p style="padding-left:97 mm; margin-top:49 mm;"><?= $humao['agtelp'];?></p>
<p style="padding-left:97 mm; margin-top:61 mm;"><?= $humao['agfax'];?></p>

<p style="padding-left:37 mm; margin-top:99 mm;"><?= $humao['agpngjwb'];?></p>
<p style="padding-left:97 mm; margin-top:99 mm;"><?= $humao['agnama'];?></p>
<p style="padding-left:62 mm; margin-top:110 mm;"><?= $humao['agpngjwb'];?></p>
<p style="padding-left:21 mm; margin-top:114 mm;"><?= $humao['agnama'];?></p>
<p style="padding-left:63 mm; margin-top:122 mm;"><?= $humao['agpngjwb'];?></p>
<p style="padding-left:29 mm; margin-top:126 mm;"><?= $humao['agnama'];?></p>

<pagebreak>
<!-- hal 3 -->
<pagebreak>
<!-- hal 4 -->
<pagebreak>
<!-- hal 5 -->
<pagebreak>

<!-- hal 6 -->
<p style="padding-left:19 mm; margin-top:211 mm;"><?= "-";?></p>
<p style="padding-left:45 mm; margin-top:231 mm;"><?= "-";?></p>
<p style="padding-left:19 mm; margin-top:255 mm;"><?= "-";?></p>


<pagebreak>

<!-- hal 7 -->

<p style="padding-left:98 mm; margin-top:39 mm;"><?= "-";?></p>
<p style="padding-left:98 mm; margin-top:47 mm;"><?= "-";?></p>
<p style="padding-left:98 mm; margin-top:55 mm;"><?= "-";?></p>
<p style="padding-left:98 mm; margin-top:63 mm;"><?= "-";?></p>

<p style="padding-left:50 mm; margin-top:75 mm;"><?= "-";?></p>
<p style="padding-left:95 mm; margin-top:75 mm;"><?= "-";?>&nbsp;</p>
<p style="padding-left:19 mm; margin-top:88 mm;"><?= "-";?></p>
<p style="padding-left:67 mm; margin-top:88 mm;"><?= "-";?>&nbsp;</p>
<p style="padding-left:18 mm; margin-top:102 mm;"><?= "-";?></p>
<p style="padding-left:96 mm; margin-top:102 mm;"><?= "-";?>&nbsp;</p>


<p style="padding-left:86 mm; margin-top:255 mm;"><?= "-";?>&nbsp;</p>


<pagebreak>
<!-- hal 8 -->
<p style="padding-left:69 mm; margin-top:2 mm;"><?= "-";?>&nbsp;</p>
<p style="padding-left:75 mm; margin-top:19 mm;"><?= "-";?>&nbsp;</p>

<pagebreak>
<!-- hal 9 -->
<pagebreak>
<!-- hal 10 -->
<pagebreak>

<!-- hal 11 -->

<p style="padding-left:14 mm; margin-top:174 mm;"><?= $humao['ppnama'];?></p>
<p style="padding-left:83 mm; margin-top:174 mm;"><?= $humao['agnama'];?></p>
<p style="padding-left:60 mm; margin-top:249 mm;"><?= "-";?></p>

<pagebreak>

<!-- hal 12 -->

<p style="padding-left:96 mm; margin-top:150 mm;"><?= $humao['agnama'];?></p>
<p style="padding-left:96 mm; margin-top:157 mm;"><?= $humao['agnoijincla'];?></p>
<p style="padding-left:96 mm; margin-top:161 mm;"><?= row_two($humao['agalmtkantor'],30);?></p>
<p style="padding-left:96 mm; margin-top:173 mm;"><?= $humao['agtelp'];?></p>
<p style="padding-left:96 mm; margin-top:177 mm;"><?= $humao['agfax'];?></p>
<p style="padding-left:96 mm; margin-top:181 mm;"><?= $humao['agemail'];?></p>

<p style="padding-left:96 mm; margin-top:191 mm;"><?= $humao['agpngjwb'];?></p>
<p style="padding-left:96 mm; margin-top:295 mm;"><?= "-";?></p>
<p style="padding-left:96 mm; margin-top:199 mm;"><?= "-";?></p>
<p style="padding-left:96 mm; margin-top:203 mm;"><?= "-";?></p>
<p style="padding-left:96 mm; margin-top:213 mm;"><?= "-";?></p>
<p style="padding-left:96 mm; margin-top:217 mm;"><?= "-";?></p>

<pagebreak>

<!-- hal 13 -->

<p style="padding-left:97 mm; margin-top:10 mm;"><?= $humao['ppnama'];?></p>
<p style="padding-left:97 mm; margin-top:17 mm;"><?= $humao['ppijin'];?></p>
<p style="padding-left:97 mm; margin-top:21 mm;"><?= row_two($humao['ppalmtkantor'],30);?></p>
<p style="padding-left:97 mm; margin-top:35 mm;"><?= $humao['pptelp'];?></p>
<p style="padding-left:97 mm; margin-top:39 mm;"><?= $humao['ppfax'];?></p>
<p style="padding-left:97 mm; margin-top:43 mm;"><?= "-";?></p>

<p style="padding-left:97 mm; margin-top:52 mm;"><?= $humao['pppngjwb'];?></p>
<p style="padding-left:97 mm; margin-top:55 mm;"><?= "-";?></p>
<p style="padding-left:97 mm; margin-top:58 mm;"><?= "-";?></p>
<p style="padding-left:97 mm; margin-top:62 mm;"><?= "-";?></p>
<p style="padding-left:97 mm; margin-top:77 mm;"><?= "-";?></p>
<p style="padding-left:97 mm; margin-top:81 mm;"><?= "-";?></p>

<p style="padding-left:97 mm; margin-top:93 mm;"><?= "-";?></p>
<p style="padding-left:97 mm; margin-top:102 mm;"><?= "-";?></p>
<p style="padding-left:97 mm; margin-top:111 mm;"><?= "-";?></p>

<p style="padding-left:101 mm; margin-top:147 mm;"><?= $humao['joposisi'];?></p>
<p style="padding-left:101 mm; margin-top:151 mm;"><?= "-";?></p>
<p style="padding-left:101 mm; margin-top:155 mm;"><?= "-";?></p>
<p style="padding-left:101 mm; margin-top:159 mm;"><?= "-";?></p>
<p style="padding-left:101 mm; margin-top:163 mm;"><?= "-";?></p>

<p style="padding-left:97 mm; margin-top:170 mm;"><?= "-";?></p>
<p style="padding-left:97 mm; margin-top:183 mm;"><?= $humao['jojmltki'];?></p>
<p style="padding-left:97 mm; margin-top:198 mm;"><?= $humao['jomkthn']." years ".$humao['jomkbln']." months ".$humao['jomkhr']." days";?></p>

<p style="padding-left:98 mm; margin-top:243 mm;"><?= "-";?></p>
<p style="padding-left:98 mm; margin-top:252 mm;"><?= "-";?></p>
<p style="padding-left:98 mm; margin-top:261 mm;"><?= "-";?></p>

<pagebreak>
<!-- hal 14 -->

<p style="padding-left:98 mm; margin-top:1 mm;"><?= "-";?></p>
<p style="padding-left:98 mm; margin-top:10 mm;"><?= "-";?></p> 

<p style="padding-left:101 mm; margin-top:92 mm;"><?= "-";?></p>
<p style="padding-left:101 mm; margin-top:115 mm;"><?= "-";?></p>
<p style="padding-left:101 mm; margin-top:128 mm;"><?= "-";?></p>

<p style="padding-left:98 mm; margin-top:183 mm;"><?= "-";?></p>
<p style="padding-left:98 mm; margin-top:198 mm;"><?= "-";?></p>
<p style="padding-left:98 mm; margin-top:212 mm;"><?= "-";?></p>
<p style="padding-left:98 mm; margin-top:221 mm;"><?= "-";?></p>

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
<p style="padding-left:37 mm; margin-top:213 mm;"><?= $humao['agfax'];?></p>

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