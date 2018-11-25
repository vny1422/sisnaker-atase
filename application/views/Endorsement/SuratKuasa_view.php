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

