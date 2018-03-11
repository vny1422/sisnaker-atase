<style>
p, div{
    font-size:9pt;
    font-family: "Arial", Helvetica, sans-serif;    
}
</style>

<div align="right"><?= $pk['agnama'];?></div>
<div align="right" style="font-family:sun-extA;">巨興人力仲介有限公司<?= $pk['agnamacn'];?></div>
<div align="right"><?= $pk['agalmtkantor'];?></div>
<div align="right" style="font-family:sun-extA;"><?= $pk['agalmtkantorcn'];?></div>
<div align="right"><?= $pk['agtelp'];?></div>

<p align="center" style="font-family:sun-extA;">授 權 書</p>
<p style="font-family:sun-extA;">
雇主 : <?= $pk['mjnamacn'];?><br>
地址 : <?= $pk['mjalmtcn'];?><br><br>
公司名稱 : <?= $pk['ppnama'];?><br>
地址 : <?= $pk['ppalmtkantor'];?><br>
執照號碼 : <?= $pk['ppijin'];?><br>
電話 : <?= $pk['pptelp'];?> 傳真 : <?= $pk['ppfax'];?><br><br>
正式成為本公司合法委託人，以協助本公司在印尼招募營造工來台工作<?= $pk['jpnamacn'];?>，並遵照印尼法規填寫一切所需文件及聘僱契約，並安排其護照於當地使領館及有關單位根據核准函號<br>
碼勞職外字第： <?= $pk['joclano'];?> 號,日期： <?= $pk['joclatgl'];?> ，申請簽證，以協助勞工到達工作地點<br><br>
謹此附上僱傭勞動契約以便作業謹此証明此份文件之簽署完成於：台北，中華民國<br>
</p>

<p align="center">SURAT KUASA</p>

<p>MAJIKAN : <?= $pk['mjnama'];?><br>
ALAMAT : <?= $pk['mjalmt'];?><br><br>
MEMBERIKAN KUASA KEPADA :<br><br>
NAMA PERUSAHAAN : <?= $pk['ppnama'];?><br>
ALAMAT : <?= $pk['ppalmtkantor'];?><br>
NO. IJIN PPTKIS : <?= $pk['ppijin'];?><br>
TEL : <?= $pk['pptelp'];?><br>
FAX : <?= $pk['ppfax'];?><br></p>

<p align="justify">
ADALAH BENAR DAN SAH JIKA SAYA MEMBERIKAN KUASA KEPADA PERUSAHAAN YANG DITUNJUK 
UNTUK MEMBANTU MEREKRUT PEKERJA YANG ADA DI INDONESIA, YANG AKAN BEKERJA SEBAGAI 
<?= $pk['jpnama'];?> DI TAIWAN DAN MENGISI SEMUA DATA-DATA YANG 
DIBUTUHKAN SESUAI PERATURAN YANG ADA. DAN MEMBANTU PEMBUATAN PASPOR, DAN UNTUK 
PEMBUATAN VISA KAMI MELAMPIRKAN SURAT DARI KANTOR PERWAKILAN R.O.C MENURUT SURAT C.L.A NO: <?= $pk['joclano'];?>, TANGGAL: <?= $pk['joclatgl'];?> UNTUK MEMBANTU TENAGA KERJA SUPAYA DAPAT DATANG KE TAIWAN.
</p>

<p align="justify">
KAMI JUGA MELAMPIRKAN KONTRAK KERJA UNTUK MEMPERMUDAH EFISIENSI KERJA. SURAT INI DITANDATANGANI OLEH SAKSI YANG ADA DI TAIPEI, TAIWAN, REPUBLIC OF CHINA. 
</p>

<div style="font-family:sun-extA;">
雇主/Majikan : <?= $pk['mjnamacn'];?>, <?= $pk['mjnama'];?><br>
住址 : <?= $pk['mjalmtcn'];?><br>
Alamat : <?= $pk['mjalmt'];?><br>
電話/ No. Tel : <?= $pk['mjtelp'];?><br>
</div>

<p style="padding-left:112 mm;"><barcode code="<?= $sk;?>" type="C39" /></p>
<p style="padding-left:138 mm;"><?= $sk;?></p>

<pagebreak>

<div align="right"><?= $pk['agnama'];?></div>
<div align="right" style="font-family:sun-extA;">巨興人力仲介有限公司<?= $pk['agnamacn'];?></div>
<div align="right"><?= $pk['agalmtkantor'];?></div>
<div align="right" style="font-family:sun-extA;"><?= $pk['agalmtkantorcn'];?></div>
<div align="right"><?= $pk['agtelp'];?></div>

<p align="center" style="font-family:sun-extA;">需 求 函</p>
<p style="font-family:sun-extA;">
公司名稱 : <?= $pk['ppnama'];?><br>
地址 : <?= $pk['ppalmtkantor'];?><br>
執照號碼 : <?= $pk['ppijin'];?><br>
電話 : <?= $pk['pptelp'];?> 傳真 : <?= $pk['ppfax'];?><br><br>
敬啟者 : 
本公司謹此根據 : <?= $pk['ejdatefilled'];?> 所簽訂之授權書要求貴方依下述各項條件招募節選操作工<br>
工作地點 : <?= $pk['mjalmtcn'];?><br>
<?= $pk['jojmltki'];?> 人 月薪: NT$ <?= $pk['jpgaji'];?> 職稱: <?= $pk['jpnamacn'];?><br>
<br><br>
條件 :<br>
1.	聘僱期限 : <?= $pk['jomkthn']." 年 ".$pk['jomkbln']." 月 ".$pk['jomkhr']." 日"?><br>
<?php if($pk['idjenispekerjaan'] == 1 || $pk['idjenispekerjaan'] == 3){?>
2.	每二週工作總時數不得超過84小時。1天工作不得超過12個小時，延長工作時間1個月不超過46個小時。<br>
<?php } ?>
<?php if($pk['idjenispekerjaan'] == 2  || $pk['idjenispekerjaan'] == 4  || $pk['idjenispekerjaan'] == 6){?>
2.	工作時間 : 一星期工作6天,免費提供膳宿<br>
<?php } ?>
<?php if($pk['idjenispekerjaan'] == 5 ){?>
2.	工作時間 : 一星期工作6天, 膳宿費用雇主提供, 但每月得從薪資中扣除新台幣 3500元<br>
<?php } ?>
3.	旅  費 : 契約期滿回程機票由雇主負擔<br>
4.	醫療費用 : 依當地勞工法規定辦理<br>
5.	加班給付 : 依台灣勞動基準法規定之<br>
6.	月薪年假 : 依台灣勞動基準法規定之(年假七天)<br>
7.	保  險 : 依台灣政府法律規定之<br>
8.	稅  法 : 根據中華民國稅法<br>
9.	試用期間 : 四十天<br>
</p>

<p align="center">SURAT PERMINTAAN</p>

<p align="justify">
NAMA PERUSAHAAN : <?= $pk['ppnama'];?><br>
ALAMAT : <?= $pk['ppalmtkantor'];?><br>
NO. IJIN PPTKIS : <?= $pk['ppijin'];?><br>
TEL : <?= $pk['pptelp'];?><br>
FAX : <?= $pk['ppfax'];?><br><br>
KEPADA YANG TERHORMAT :<br>
Surat kuasa ini dibuat pada tanggal : <?= $pk['ejdatefilled'];?> tujuannya adalah untuk memperkerjakan
Tenaga Kerja Indonesia sebagai <?= $pk['jpnama'];?> dengan syarat-syarat yang tertera sebagai berikut.<br>
Alamat Pekerjaan : <?= $pk['mjalmt'];?><br>
Jumlah  : <?= $pk['jojmltki'];?> Pekerjaan : <?= $pk['jpnama'];?> Gaji/ Bulan : NT$ <?= $pk['jpgaji'];?>	<br><br>
Syarat-syarat :<br>
1.	Masa Kontrak : <?= $pk['jomkthn']." Tahun ".$pk['jomkbln']." Bulan ".$pk['jomkhr']." Hari"?><br>
<?php if($pk['idjenispekerjaan'] == 1 || $pk['idjenispekerjaan'] == 3){?>
2.	Waktu bekerja :Total jam kerja setiap 2 (dua) minggu tidak melebihi 84 (delapan puluh empat) jam,  jumlah lembur dalam 1 bulan tidak melebihi 46 jam.<br>
<?php } ?>
<?php if($pk['idjenispekerjaan'] == 2  || $pk['idjenispekerjaan'] == 4  || $pk['idjenispekerjaan'] == 6){?>
2.	Waktu bekerja : Jam kerja dalam 1 minggu adalah selama 6 hari. Makan dan akomodasi ditanggung majikan<br>
<?php } ?>
<?php if($pk['idjenispekerjaan'] == 5 ){?>
2.	Waktu bekerja : Jam kerja dalam 1 minggu adalah selama 6 hari. Makan dan akomodasi dapat disediakan majikan dan        di kenakan potongan gaji sebesar NTD 3500 / bulan<br>
<?php } ?>
3.	Biaya perjalanan : Jika masa kontrak kerja telah selesai maka tiket ditanggung oleh majikan.<br>
4.	Biaya pengobatan : Menurut hukum yang berlaku di Taiwan<br>
5.	Uang lembur : Menurut hukum yang berlaku di Taiwan<br>
6.	Libur tahunan : Menurut hukum perburuhan di Taiwan (1 tahun ada 7 hari libur)<br>
7.	Asuransi : Menurut hukum yang berlaku di Taiwan<br>
8.	Pajak : Menurut hukum yang berlaku di Taiwan<br>
9.  Masa Percobaan : 40 hari<br>
</p>

<div style="font-family:sun-extA;">
雇主/Majikan : <?= $pk['mjnamacn'];?>, <?= $pk['mjnama'];?><br>
住址 : <?= $pk['mjalmtcn'];?><br>
Alamat : <?= $pk['mjalmt'];?><br>
電話/ No. Tel : <?= $pk['mjtelp'];?><br>
</div>
<p style="padding-left:112 mm;"><barcode code="<?= $sp;?>" type="C39" /></p>
<p style="padding-left:138 mm;"><?= $sp;?></p>

