<style>
p {
    font-family: "Arial", Helvetica, sans-serif;
    font-size: 12pt;    
}

td {
    text-align: justify;
    text-justify: inter-word;
    font-family: "Arial", Helvetica, sans-serif;
    font-size: 12pt;        
}
</style>

<p style="text-align:center; font-size:20pt;">
<b>PERJANJIAN KERJA</b>
</p>

<p style="text-align:center;">

<?php 
    //$today = date("N-d-m-Y");
    //echo $today;

    function tgl_indo($tanggal){
        $hari = array (
            1 =>   'Senin',
            'Selasa',
            'Rabu',
            'Kamis',
            'Jumat',
            'Sabtu',
            'Minggu'
        );

        $bulan = array (
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $date = explode('-', $tanggal);        
        
        return $hari[ (int)$date[0] ] . ', ' . $date[1] . ', ' . $bulan[ (int)$date[2] ] . ', ' . $date[3];
    }    
    
?>
Perjanjian ini dibuat pada <?= tgl_indo(date("N-d-m-Y"));?>, diantara: <br><br>
<?= $pk['agnama'];?> <br>
<?= $pk['agalmtkantor'];?> <br>
<?= $pk['agtelp']." & ".$pk['agfax'];?><br>
<?= $pk['agemail'];?><br>
(selepas ini dinamakan “Majikan”).<br><br>
dan <?= $pk['tknama'];?> Warga Negara Indonesia,<br>
dengan No. Pasport <?= $pk['tkpaspor'];?> (selepas ini dinamakan “Pekerja").
<br>
</p>

<p>
Dengan ini adalah dipersetujui syarat-syarat yang berikut:
<table>

<tr>
<td valign="top">1. </td>
<td valign="top"><b>JAWATAN</b></td>
<td valign="top">: <td>
<td><?= $pk['namajenispekerjaan'];?></td>
</tr>

<tr>
<td valign="top">2. </td>
<td valign="top"><b>TEMPO KONTRAK</b></td>
<td valign="top">: <td>
<?php

$start = $pk['jostart'];
$end = $pk['joend'];

if($start == NULL && $end == NULL){
    $jostart = "0000-00-00";
    $joend = "0000-00-00";
}
$jostart = explode("-", $jostart);
$joend = explode("-", $joend);

?>
<td><?= $pk['jomkthn'];?> TAHUN<br>Tambahan tempoh kontrak kerja boleh disambung dengan persetujuan majikan, Pekerja dan kelulusan daripada Kerajaan Malaysia.	
</td>
</tr>

<tr>
<td valign="top">3. </td>
<td valign="top"><b>TEMPAT KERJA</b></td>
<td valign="top">: <td>
<td><?= $pk['mjnama'];?>,<br><?= $pk['mjalmt'];?></td>
</tr>

<tr>
<td valign="top">4. </td>
<td valign="top"><b>TUGAS DAN TANGGUNGJAWAB</b></td>
<td valign="top">: <td>
<td></td>
</tr>

</table>

<table>

<tr>
<td valign="top"></td>
<td valign="top">&emsp;a.</td>
<td>Pekerja mestilah menunjukkan mutu kerja yang baik dan mematuhi segala arahan yang diberikan oleh majikan melalui pegawai-pegawai yang dilantik dari masa-kemasa.</td>
</tr>

<tr>
<td valign="top"></td>
<td valign="top">&emsp;b.</td>
<td>Pekerja mestilah bekerja untuk majikan ataupun syarikat ini sahaja dan dilarang bekerja di mana-mana tempat lain.</td>
</tr>

<tr>
<td valign="top"></td>
<td valign="top">&emsp;c.</td>
<td>Pekerja mestilah bersikap bertanggungjawab dan penuh dedikasi di atas segala tugas yang ditetapkan.</td>
</tr>
<tr>
<td valign="top"></td>
<td valign="top">&emsp;d.</td>
<td>Pekerja mestilah sentiasa menjaga perlakuan diri, budi bahasa dan sentiasa menghormati majikan atau wakil-wakilnya, teman sekerja dan masyarakat sekeliling.</td>
</tr>
<tr>
<td valign="top"></td>
<td valign="top">&emsp;e.</td>
<td>Pekerja mestilah menghormati kebudayaan, tata-susila dan cara hidup orang-orang tempatan dan undang-undang Malaysia.</td>
</tr>
<tr>
<td valign="top"></td>
<td valign="top">&emsp;f.</td>
<td>Pekerja mestilah mematuhi semua peraturan yang ditetapkan oleh syarikat seperti yang tertera di dalam buku peraturan dan syarat- syarat kerja dan ketetapan yang dibuat untuk asrama syarikat.</td>
</tr>
<tr>
<td valign="top"></td>
<td valign="top">&emsp;g.</td>
<td>Pekerja boleh diambil atau dikenakan tindakan <b>TATA TERTIB / DISIPLIN</b> jika didapati melanggar mana-mana peraturan kerja yang telah ditetapkan ataupun undang-undang perburuhan Malaysia.</td>
</tr>
</table>

<table>

<tr>
<td valign="top">5. </td>
<td valign="top"><b>WAKTU BEKERJA ADALAH SEPERTI BERIKUT</b></td>
<td valign="top">: <td>
<td></td>
</tr>

</table>

<table>
<tr>
<td valign="top"></td>
<td valign="top">&emsp;</td>
<td>TKI akan bekerja selama 12 (dua belas) jam per hari, dan 4 (empat) hari dalam seminggu atau 48 (empat puluh delapan) jam seminggu dan jadwal kerjanya akan diatur oleh Pihak Syarikat.</td>
</tr>
</table>

<pagebreak>

<table>

<tr>
<td valign="top">6. </td>
<td valign="top"><b>GAJI DAN ELAUN</b></td>
<td valign="top">: <td>
<td></td>
</tr>

</table>

<table>
<tr>
<td valign="top"></td>
<td valign="top">&emsp;</td>
<td>GAJI POKOK : RM <?= $pk['jpgaji'];?> (Ringgit Malaysia), dengan tambahan Elaun/Tunjangan seperti berikut:</td>
</tr>

<tr>
<td valign="top"></td>
<td valign="top">&emsp;</td>
<td>

<table>
<tr>
<td>a. </td>
<td>Elaun / tunjangan kedatangan</td>
<td>:</td>
<td>RM.	[0.00] /hari</td>
</tr>

<tr>
<td>b. </td>
<td>Elaun / tunjangan shift siang</td>
<td>:</td>
<td>RM.	[0.00] /hari</td>
</tr>

<tr>
<td>c. </td>
<td>Elaun / tunjangan shift malam</td>
<td>:</td>
<td>RM.	[0.00] /hari</td>
</tr>

<tr>
<td>d. </td>
<td>Over Time wajib 1 bulan 1 hari mengikut keperluan syarikat</td>
<td>:</td>
<td></td>
</tr>

</table>

</td>
</tr>

<tr>
<td valign="top"></td>
<td valign="top">&emsp;</td>
<td>MAJIKAN akan membayar gaji pokok sebesar RM <?= $pk['jpgaji']; ?> (Ringgit Malaysia) per bulan, serta lain-lain kemudahan akan dibayar dan disediakan sebagaimana kadar yang diperuntukkan oleh Undang- Undang Pengajian Buruh Kerajaan Malaysia atau Perjanjian Penggajian Pertubuhan yang diluluskan Kerajaan Malaysia.</td>
</tr>

<tr>
<td valign="top"></td>
<td valign="top">&emsp;</td>
<td>MAJIKAN atas persetujuan PEKERJA boleh mewujudkan satu skim pengajian berasaskan pengeluaran / unit atau secara kontrak atau seumpamanya.</td>
</tr>

<tr>
<td valign="top"></td>
<td valign="top">&emsp;</td>
<td>Gaji akan dibayar 1 ( satu ) kali dalam sebulan yaitu selewat - lewatnya pada setiap tanggal 7 bulan barikutnya dibayar cash atau melalui account bank Pekerja.</td>
</tr>

</table>

<table>

<tr>
<td valign="top">7. </td>
<td valign="top"><b>LAIN-LAIN KEMUDAHAN YANG DISEDIAKAN</b></td>
<td valign="top">: <td>
<td></td>
</tr>

</table>

<table>

<tr>
<td valign="top"></td>
<td valign="top">&emsp;a.</td>
<td>Kemudahan pengangkutan daripada asrama ke tempat kerja pergi dan balik disediakan oleh syarikat jika jaraknya berjauhan dari asrama.</td>
</tr>

<tr>
<td valign="top"></td>
<td valign="top">&emsp;b.</td>
<td>Pakaian seragam disediakan oleh pihak syarikat.</td>
</tr>

<tr>
<td valign="top"></td>
<td valign="top">&emsp;c.</td>
<td>Kemudahan perubatan disediakan oleh pihak syarikat dengan percuma.</td>
</tr>
<tr>
<td valign="top"></td>
<td valign="top">&emsp;d.</td>
<td>Kemudahan tempat beribadat disediakan di dalam kawasan tempat bekerja.</td>
</tr>
</table>

<table>

<tr>
<td valign="top">8. </td>
<td valign="top"><b>CUTI TAHUNAN</b></td>
<td valign="top">: <td>
<td></td>
</tr>

</table>

<table>
<tr>
<td valign="top"></td>
<td valign="top">&emsp;</td>
<td>Perusahaan ini memberikan cuti kerja kepada TKI sesuai Undang-Undang Kerajaan Malaysia sebagai berikut:</td>
</tr>

<tr>
<td valign="top"></td>
<td valign="top">&emsp;</td>
<td>

<table>

<tr>
<td>a. </td>
<td>Cuti Am (Public holiday) selama 15 hari setahun.</td>
</tr>

<tr>
<td>b. </td>
<td>Cuti sakit / MC (Medical Certiticate) diberikan sebanyak 14 hari pertahun maksimum dan upah di bayar.</td>
</tr>

<tr>
<td>c. </td>
<td>Cuti Rawatan Inap (Wad) 60 hari dan upah dibayar.</td>
</tr>

<tr>
<td>d. </td>
<td>Cuti tahunan berupah disediakan sebagai berikut:</td>
</tr>

<tr>
<td valign="top"></td>
<td>
<table>
<tr>
<td>•</td>
<td>Kurang dari 2 (dua) tahun</td>
<td>:</td>
<td>10	hari cuti</td>
</tr>

<tr>
<td>•</td>
<td>2 (dua) hingga 5 (lima) tahun</td>
<td>:</td>
<td>14	hari cuti</td>
</tr>

<tr>
<td>•</td>
<td>5 (lima) hingga 10 (sepuluh) tahun</td>
<td>:</td>
<td>18	hari cuti</td>
</tr>

<tr>
<td>•</td>
<td>10 (sepuluh) tahun ke atas</td>
<td>:</td>
<td>19	hari cuti</td>
</tr>
</table>
</td>
</tr>

<tr>
<td>e. </td>
<td>Cuti rehat mingguan 1 (satu) hari dalam seminggu dan upah di bayar.</td>
</tr>

<tr>
<td>f. </td>
<td>Cuti Kecemasan.</td>
</tr>

<tr>
<td valign="top"></td>
<td>
<table>
<tr>
<td valign="top">1)</td>
<td>Pekerja dibenarkan cuti pulang ke Indonesia diatas belanja sendiri jika berlaku kematian keatas keluarga sendiri.</td>
</tr>

<tr>
<td valign="top">2)</td>
<td>Tempoh cuti adalah menurut kebenaran dan budi bicara pihak perusahaan.</td>
</tr>

<tr>
<td valign="top">3)</td>
<td>Pekerja mestilah mengesahkan kedudukan perkara dengan menyerahkan telegram atau sijil kematian pengkebumian kepada pihak perusahaan.</td>
</tr>

</table>
</td>
</tr>

</table>

</td>
</tr>


</table>

<pagebreak>

<table>

<tr>
<td valign="top">9. </td>
<td valign="top"><b>ASRAMA</b></td>
<td valign="top">: <td>
<td></td>
</tr>

</table>

<table>
<tr>
<td></td>
<td>&emsp;</td>
<td>Pihak syarikat menyediakan asrama yang lengkap untuk semua pekerja asing. Walaubagaimana pun pihak syarikat perlu membuat peraturan dan syarat-syarat kepada semua penghuni yang tinggal diasrama syarikat. Syarat-syaratnya adalah seperti berikut:
</td>
</tr>

<tr>
<td></td>
<td>&emsp;</td>
<td>
<table>
<tr>
<td valign="top">a.</td>
<td>Penghuni asrama hanya dibenarkan tinggal di asrama yang disediakan oleh pihak syarikat sahaja dan dilarang menduduki ditempat selain dari tempat yang ditetapkan.</td>
</tr>
<tr>
<td valign="top">b.</td>
<td>Penghuni asrama yang tinggal di asrama syarikat, dikehendaki menjaga semua kelengkapan yang disediakan daripada hilang ataupun rosak.</td>
</tr>
<tr>
<td valign="top">c.</td>
<td>Penghuni asrama yang tinggal di asrama syarikat dikehendaki menjaga kelakuan, cara bersosial dan pakaian semasa di rumah.</td>
</tr>
<tr>
<td valign="top">d.</td>
<td>Penghuni asrama dilarang keras membawa balik keasrama teman, tetamu ataupun saudara mara sama ada laki-laki ataupun perempuan.</td>
</tr>
<tr>
<td valign="top">e.</td>
<td>Penghuni asrama dikehendaki menjaga kebersihan rumah sendiri dan .kawasan sekeliling di asrama.</td>
</tr>
<tr>
<td valign="top">f.</td>
<td>Majikan akan memberikan membayar bil listrik dan air secara percuma.</td>
</tr>
</table>
</td>
</tr>

</table>

<table>

<tr>
<td valign="top">10. </td>
<td valign="top"><b>PEMBERHENTIAN KERJA</b></td>
<td valign="top">: </td>
<td></td>
</tr>

<tr>
<td valign="top"></td>
<td valign="top" colspan=2>Pihak syarikat boleh membatalkan kontrak perjanjian pekerjaan inisekiranya seseorang pekerja itu melanggar perkara-kara yang berikut:</td>
<td></td>
</tr>

<tr>
<td valign="top"></td>
<td valign="top" colspan=2>
<table>
<tr>
<td>a.</td>
<td>Tidak mencapai tahap mutu kerja yang dikehendaki oleh majikan.</td>
</tr>
<tr>
<td>b.</td>
<td>Tidak mematuhi peraturan dan undang-undang yang ditetapkan oleh majikan.</td>
</tr>
<tr>
<td>c.</td>
<td>Kekerapan tidak hadir bertugas dan atau lewat hadir bertugas.</td>
</tr>
<tr>
<td>d.</td>
<td>Tidak jujur, cuai atau lalai dan tidak bertanggungjawab semasa bertugas.</td>
</tr>
<tr>
<td>e.</td>
<td>Berkelakuan atau menjalankan apa-apa aktiviti yang boleh menggugat keharmonisan, kesejahteraan, harta benda dan pengeluaran syarikat serta pekerja lain.</td>
</tr>
<tr>
<td>f.</td>
<td>Menyalah gunakan harta benda syarikat atau pun orang perseorangan dengan tiada kebenaran.</td>
</tr>
<tr>
<td>g.</td>
<td>Merakam kad perakam waktu kerja orang lain atau meminta orang lain merakamkan ka perakam waktu kerja anda.</td>
</tr>
<tr>
<td>h.</td>
<td>Menjalankan apa-apa aktiviti sosial yang boleh menjatuhkan imej syarikat dan lain-lain pekerja syarikat.</td>
</tr>
</table>
</td>
<td></td>
</tr>

<tr>
<td valign="top">11. </td>
<td valign="top"><b>PENGHANTARAN PULANG PEKERJA KE NEGARA ASAL</b></td>
<td valign="top">: <td>
<td></td>
</tr>

<tr>
<td valign="top"></td>
<td valign="top" colspan=2>
<table>
<tr>
<td valign="top">a.</td>
<td>Pihak syarikat akan membiayai sepenuhnya kos pengangkutan karana menghantar pulang pekerja-pekerja asing ke negara asal disebabkan :</td>
</tr>
<tr>
<td valign="top"></td>
<td>
<table>
<tr>
<td>1)</td>
<td>Pekerja itu telah tamat tempoh kontrak kerjanya.</td>
</tr>
<tr>
<td>2)</td>
<td>Kematian</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
<td></td>
</tr>

</table>

<pagebreak>

<table>

<tr>
<td valign="top"></td>
<td valign="top" colspan=2>
<table>
<tr>
<td valign="top">b.</td>
<td>Walau bagaimanapun pihak syarikat tidak akan membiayai kos pengangkutan menghantar pulang pekerja asing ke negara asal disebabkan :</td>
</tr>
<tr>
<td valign="top"></td>
<td>
<table>
<tr>
<td valign="top">1)</td>
<td>Disebabkan mengidapi penyakit yang teruk dan berjangkit - (AIDS, Hipetatis B, STD, HIV, Tuberclosis dan lain-lain seperti yang disahkan oleh pakar perubatan di Malaysia.</td>
</tr>
<tr>
<td valign="top">2)</td>
<td>Didapati bersalah mengikut mana-mana hukum janayah.</td>
</tr>
<tr>
<td valign="top">3)</td>
<td>Mempunyai dan terlibat di dalam masalah sosial.</td>
</tr>
<tr>
<td valign="top">4)</td>
<td>Menamatkan kontrak kerja sebelum tempoh waktunya.</td>
</tr>
<tr>
<td>5)</td>
<td valign="top">Penghantaran pulang disebabkan tidak boleh menjalankan tugas ke tahap yang dikehendaki dan ditentukan oleh syarikat walaupun setelah diberi bimbingan dan tunjuk ajar dan jangka waktu yang wajar.</td>
</tr>
<tr>
<td>6)</td>
<td>Penghantaran pulang disebabkan permasalahan atau permintaan keluarga.</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
<td></td>
</tr>

<tr>
<td valign="top"> </td>
<td valign="top" colspan=2>Sekiranya berlaku sebab-sebab seperti di dalam terma 11.b.2) hingga 11.b.5), mana-mana pekerja yang terbabit juga diperlukan membayar kembali baki wang levi dan apa-apa juga bayaran lain yang telah dibuat oleh majikan kerana mengambil pekerja ini dari negara asal mereka.
</td>
</tr>

<tr>
<td valign="top">12. </td>
<td valign="top"><b>BAYARAN LEVY</b> :</td>
<td></td><td></td>
</tr>

<tr>
<td valign="top"></td>
<td valign="top" colspan=2>Majikan membayar dan memsubsidi biaya levy sebesar RM. 1,850.00 (Ringgit Malaysia : Satu ribu delapan ratus lima puluh) dan biaya yang termasuk didalamnya sesuai dengan regulasi yang berlaku. Jika hal ini dilanggar maka pekerja atau PPTKIS atau KBRI berhak mengajukan tuntutan ke Jabatan Tenaga Kerja Malaysia.
<br>Pihak Majikan tidak akan melakukan pememotongan gaji TKI untuk pembayaran levy Pekerja.</td>
</tr>

<tr>
<td valign="top">13. </td>
<td valign="top" colspan=3><b>BIAYA BIO MEDICAL, VISA DENGAN RUJUKAN DAN IMMIGRASI SECURITY CLEARANCE</b> :</td>
</tr>

<tr>
<td valign="top"></td>
<td valign="top" colspan=3>Bahwa semua biaya terkait dengan pengurusan TKI untuk urusan Visa Dengan Rujukan (VDR) melalui PT. OMNI Sarana Cipta, Bio Medical Foreign Workers Centralized Management System (FWCMS) dan Immigration Security Clearance (ISC) dibayar oleh Pihak Majikan/Pengguna Jasa TKI”.</td>
</tr>

</table>
</p>

<p>Adapun dengan ini dipersetujui kontrak perjanjian diatas untuk kedua-dua belah pihak.
<br><br>
<?= $pk['agnama'];?><br><br>
<?= $pk['agpngjwb']?><br><br>
<table>
<tr>
<td>Nama TKI</td>
<td>:</td>
<td><?= $pk['tknama'];?></td>
</tr>
<tr>
<td>Nomor Paspor</td>
<td>:</td>
<td><?= $pk['tkpaspor'];?></td>
</tr>
<tr>
<td>Tanda Tangan</td>
<td>:</td>
<td></td>
</tr>
</table>

<br>
<b>SAKSI</b><br>
<?= $pk['ppnama'];?><br>
<?= $pk['pppngjwb'];?>
</p>