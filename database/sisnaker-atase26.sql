/*
SQLyog Ultimate v11.33 (64 bit)
MySQL - 5.6.20 : Database - sisnaker
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`sisnaker` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `sisnaker`;

/*Table structure for table `agensi_merge_map` */

DROP TABLE IF EXISTS `agensi_merge_map`;

CREATE TABLE `agensi_merge_map` (
  `agid_kembar` int(11) NOT NULL,
  `agid_induk` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `agensi_merge_map` */

/*Table structure for table `cekalagensi` */

DROP TABLE IF EXISTS `cekalagensi`;

CREATE TABLE `cekalagensi` (
  `caid` int(11) NOT NULL AUTO_INCREMENT,
  `agid` int(11) NOT NULL,
  `castart` date NOT NULL,
  `caend` date DEFAULT NULL,
  `cacatatan` text COLLATE utf8_unicode_ci,
  `enable` decimal(1,0) NOT NULL,
  `idinstitution` int(11) NOT NULL,
  PRIMARY KEY (`caid`),
  KEY `fk_cekalagensi_institution1_idx` (`idinstitution`),
  CONSTRAINT `fk_cekalagensi_institution1` FOREIGN KEY (`idinstitution`) REFERENCES `institution` (`idinstitution`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `cekalagensi` */

insert  into `cekalagensi`(`caid`,`agid`,`castart`,`caend`,`cacatatan`,`enable`,`idinstitution`) values (2,2,'2017-01-02',NULL,'tes','0',2),(5,1,'2017-01-02',NULL,'asd','0',1),(6,1,'2017-01-25','2017-01-27','hehes','0',1),(8,1,'2017-01-06',NULL,'tes list','1',1);

/*Table structure for table `cekalmajikan` */

DROP TABLE IF EXISTS `cekalmajikan`;

CREATE TABLE `cekalmajikan` (
  `cmid` int(11) NOT NULL AUTO_INCREMENT,
  `ktp` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `startdate` date DEFAULT NULL,
  `enddate` date DEFAULT NULL,
  `idinstitution` int(11) NOT NULL,
  PRIMARY KEY (`cmid`),
  KEY `fk_cekalmajikan_institution1_idx` (`idinstitution`),
  CONSTRAINT `fk_cekalmajikan_institution1` FOREIGN KEY (`idinstitution`) REFERENCES `institution` (`idinstitution`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `cekalmajikan` */

/*Table structure for table `cekalpptkis` */

DROP TABLE IF EXISTS `cekalpptkis`;

CREATE TABLE `cekalpptkis` (
  `cpid` int(11) NOT NULL AUTO_INCREMENT,
  `ppkode` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `cpstart` date NOT NULL,
  `cpend` date DEFAULT NULL,
  `enable` decimal(1,0) NOT NULL,
  PRIMARY KEY (`cpid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `cekalpptkis` */

insert  into `cekalpptkis`(`cpid`,`ppkode`,`cpstart`,`cpend`,`enable`) values (2,'1','2017-01-02','2017-01-25','1');

/*Table structure for table `currency` */

DROP TABLE IF EXISTS `currency`;

CREATE TABLE `currency` (
  `idcurrency` int(11) NOT NULL AUTO_INCREMENT,
  `currencyname` varchar(45) DEFAULT NULL,
  `kurs` double DEFAULT NULL,
  PRIMARY KEY (`idcurrency`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `currency` */

insert  into `currency`(`idcurrency`,`currencyname`,`kurs`) values (1,'usd',13299);

/*Table structure for table `entryjo` */

DROP TABLE IF EXISTS `entryjo`;

CREATE TABLE `entryjo` (
  `ejid` int(11) NOT NULL AUTO_INCREMENT,
  `idjenispekerjaan` int(11) NOT NULL,
  `idinstitution` int(11) NOT NULL,
  `mjktp` varchar(20) DEFAULT NULL,
  `mjnama` varchar(50) DEFAULT NULL,
  `mjnamacn` varchar(50) DEFAULT NULL,
  `mjalmt` varchar(100) DEFAULT NULL,
  `mjalmtcn` varchar(100) DEFAULT NULL,
  `mjtelp` varchar(20) DEFAULT NULL,
  `mjfax` varchar(20) DEFAULT NULL,
  `mjpngjwb` varchar(50) DEFAULT NULL,
  `mjpngjwbcn` varchar(50) DEFAULT NULL,
  `joclano` varchar(20) DEFAULT NULL COMMENT 'No CLA',
  `joclatgl` date DEFAULT NULL COMMENT 'Tanggal CLA',
  `joestduedate` date DEFAULT NULL,
  `jojmltki` int(11) DEFAULT '0',
  `jomkthn` decimal(2,0) DEFAULT NULL,
  `jomkbln` decimal(2,0) DEFAULT NULL,
  `jomkhr` decimal(3,0) DEFAULT NULL,
  `jocatatan` text,
  `joposisi` varchar(30) DEFAULT NULL COMMENT 'Hanya diisi jika jenis pekerjaan adalah pekerja.',
  `joposisicn` varchar(30) DEFAULT NULL,
  `joakomodasi` decimal(7,2) DEFAULT NULL,
  `jotime` int(11) DEFAULT NULL,
  `jostart` date DEFAULT NULL,
  `joend` date DEFAULT NULL,
  `jogajikonstruksi` decimal(10,2) DEFAULT NULL,
  `ejbcform` varchar(10) NOT NULL COMMENT 'Barcode untuk Form Info',
  `ejbcsk` varchar(10) NOT NULL COMMENT 'Barcode surat kuasa',
  `ejbcsp` varchar(10) NOT NULL COMMENT 'Barcode untuk Surat Permintaan',
  `ejtglendorsement` date DEFAULT NULL,
  `ejdatefilled` date DEFAULT NULL,
  `ejtoken` varchar(32) NOT NULL,
  `ejtglpengambilan` timestamp NULL DEFAULT NULL,
  `ppkode` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `agid` int(11) DEFAULT NULL,
  `jpgaji` decimal(7,2) DEFAULT NULL,
  `jpakomodasi` decimal(7,2) DEFAULT NULL,
  `md5ej` varchar(255) NOT NULL,
  `jodownloadurl` varchar(255) NOT NULL,
  PRIMARY KEY (`ejid`),
  UNIQUE KEY `ejtoken` (`ejtoken`),
  UNIQUE KEY `ejbcform` (`ejbcform`),
  UNIQUE KEY `ejbcsk` (`ejbcsk`),
  UNIQUE KEY `ejbcsp` (`ejbcsp`),
  KEY `entryjo_agid` (`agid`),
  KEY `entryjo_ppkode` (`ppkode`),
  KEY `fk_entryjo_jenispekerjaan1_idx` (`idjenispekerjaan`),
  KEY `fk_entryjo_institution1_idx` (`idinstitution`),
  CONSTRAINT `entryjo_agid` FOREIGN KEY (`agid`) REFERENCES `magensi` (`agid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `entryjo_ppkode` FOREIGN KEY (`ppkode`) REFERENCES `mpptkis` (`ppkode`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_entryjo_institution1` FOREIGN KEY (`idinstitution`) REFERENCES `institution` (`idinstitution`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_entryjo_jenispekerjaan1` FOREIGN KEY (`idjenispekerjaan`) REFERENCES `jenispekerjaan` (`idjenispekerjaan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

/*Data for the table `entryjo` */

insert  into `entryjo`(`ejid`,`idjenispekerjaan`,`idinstitution`,`mjktp`,`mjnama`,`mjnamacn`,`mjalmt`,`mjalmtcn`,`mjtelp`,`mjfax`,`mjpngjwb`,`mjpngjwbcn`,`joclano`,`joclatgl`,`joestduedate`,`jojmltki`,`jomkthn`,`jomkbln`,`jomkhr`,`jocatatan`,`joposisi`,`joposisicn`,`joakomodasi`,`jotime`,`jostart`,`joend`,`jogajikonstruksi`,`ejbcform`,`ejbcsk`,`ejbcsp`,`ejtglendorsement`,`ejdatefilled`,`ejtoken`,`ejtglpengambilan`,`ppkode`,`agid`,`jpgaji`,`jpakomodasi`,`md5ej`,`jodownloadurl`) values (1,1,2,'987','Ovan','Wa Shing Shong','Wonogiri','Chinagiri','08572501789','567876','Ovan','Wa Shing Shong','1','2016-11-01','2017-02-28',5,'3','4','16','baik baik saja','Gelandang Bertahan','Wo Ni Lau Ba','2500.00',NULL,NULL,NULL,NULL,'kl988','kl988','kl988','2017-01-26','2016-12-30','bebasinitoken123','2016-12-30 03:18:18','TAT338',6862,'99999.99','99999.99','',''),(2,2,2,'123','Udin','-','Solo','-','08123123123','123123','Budi','-','1','2016-11-01','2017-02-28',3,'3','3','3','sehat','Pacul Garang','-','1500.00',NULL,NULL,NULL,NULL,'kl1000','kl900','kl900','2017-02-01','2017-01-01','token123','2017-01-01 23:52:02','TAT338',6862,'99999.99','99999.99','',''),(4,1,2,'asd','asdas','asd','asdasd','asd','','','','','AT677397','2017-02-22',NULL,1,'3','2','1','asdasdasd',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'I17023GD6','K1702WHAF','J1702IV4D',NULL,NULL,'',NULL,'TAT338',6862,NULL,NULL,'eccbc87e4b5ce2fe28308fd9f2a7baf3',''),(22,1,2,'asd','asd','asd','asd','asd','','','','','asd','2017-02-22',NULL,1,'3','1','1','asd',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'I1702R8LI','K1702G16Z','J17020T6Z',NULL,NULL,'0ced705b0d7f470499b7d2cca423bc6a',NULL,'TAT338',6862,'17000.00',NULL,'e4da3b7fbbce2345d7772b0674a318d5',''),(23,1,2,'asd','asd','asd','asd','asd','','','','','asd','2017-02-21',NULL,1,'3','0','1','asd',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'I1702LEFK','K1702C9EV','J1702B416',NULL,NULL,'cfd53fd954389d1455bcdc33a7d0d104',NULL,'TAT338',6862,'17000.00',NULL,'37693cfc748049e45d87b8c7d8b9aacd',''),(24,1,2,'as','das','dasd','asd','asd','','','','','asd','2017-02-19',NULL,1,'3','1','1','asd',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'I1702TQB0','K1702NK9I','J17029I7G',NULL,NULL,'f31912da93ed2014e1ba9c7563dc5caa',NULL,'TAT338',6862,'17000.00',NULL,'1ff1de774005f8da13f42943881c655f','perawattaiwan'),(25,2,2,'ADSA','asdad','adasd','asd','asd','','','','','asd','2017-02-13',NULL,1,'3','1','1','asd',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'I1702TEZ0','K1702KLEJ','J1702ODQV',NULL,NULL,'fd23828e272d303449eb79279f62b59c',NULL,'TAT338',6862,'17000.00',NULL,'8e296a067a37563370ded05f5a3bf3ec',''),(26,1,2,'sada','asd','asd','asd','asd','','','','','asd','2017-02-08',NULL,1,'3','1','1','asd',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'I1702M7W9','K1702G123','J1702AN49',NULL,NULL,'c7bed565c03c82c435fa7b219673100f',NULL,'TAT338',6862,'17000.00',NULL,'4e732ced3463d06de0ca9a15b6153677','perawattaiwan'),(27,1,2,'asd','asd','asd','asd','asd','','','','','asd','2017-02-28',NULL,1,'3','1','1','asd',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'I17029YJS','K1702HAZS','J1702OTMV',NULL,NULL,'a03615c8c4ed5f44017e0056f3aec64b',NULL,'TAT338',6862,'17000.00',NULL,'02e74f10e0327ad868d138f2b4fdd6f0','perawattaiwan'),(28,2,2,'asd','asd','asd','asd','asd','','','','','asd','2017-02-14',NULL,1,'3','1','-2','asd',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'I17023CDA','K170245AZ','J1702PQ3G',NULL,NULL,'f621d77bd8e05624ad01845c237f794f',NULL,'TAT338',6862,'17000.00',NULL,'33e75ff09dd601bbe69f351039152189',''),(29,1,2,'asd','asd','asdas','dasd','asdasd','','','','','asd','2017-01-30',NULL,1,'3','1','1','asd',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'I1702S12R','K170289EV','J1702CPER',NULL,NULL,'f9bb25397df584f4998fdf43694cd50e',NULL,'TAT338',6862,'17000.00',NULL,'6ea9ab1baa0efb9e19094440c317e21b','perawattaiwan'),(30,2,2,'asd','asd','asd','asd','SAd','','','','','sad','2017-02-28',NULL,1,'3','1','1','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'I17027SHQ','K1702YR8P','J1702CDQR',NULL,NULL,'e27a99f5a49be8648d4efabf6471a474',NULL,'TAT338',6862,'17000.00',NULL,'34173cb38f07f89ddbebc2ac9128303f',''),(31,2,2,'asd','sad','asd','sad','Sd','','','','','asd','2017-02-13',NULL,1,'3','2','1','asd',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'I1702PYZK','K1702MBO9','J1702KXQF',NULL,NULL,'8acf70add2d944741d8a20196e21d79f',NULL,'TAT338',6862,'17000.00',NULL,'c16a5320fa475530d9583c34fd356ef5','petani'),(32,2,2,'asd','asd','sadssad','sadssad','asd','','','','','asd','2017-02-26',NULL,1,'3','1','1','sad',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'I1702LIVK','K1702Z4T2','J1702Z8HY',NULL,NULL,'f7bf5109d0737a847deb1d93b1ca1afe',NULL,'TAT338',6862,'17000.00',NULL,'6364d3f0f495b6ab9dcf8d3b5c6e0b01','petani'),(33,1,2,'asd','asd','asd','asd','asd','','','','','asd','2017-02-14',NULL,1,'3','1','1','asd',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'I1702OL6J','K1702YR09','J1702C52N',NULL,NULL,'3ae39dc923a81d14951083180417ff55',NULL,'TAT338',6862,'17000.00',NULL,'182be0c5cdcd5072bb1864cdee4d3d6e','perawattaiwan'),(34,1,2,'asd','sad','asd','asd','asd','','','','','asd','2017-02-07',NULL,1,'3','1','1','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'I1702X2J0','K17021AZO','J17028T6F',NULL,NULL,'1c2e1b32a09aee6409d30c8f42929ae5',NULL,'TAT338',6862,'17000.00',NULL,'e369853df766fa44e1ed0ff613f563bd','perawattaiwan'),(35,2,2,'asd','asd','sad','asdasd','asd','','','','','asd','2017-02-21',NULL,1,'3','1','1','sad',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'I1702U7KX','K1702BGL2','J1702EZ0H',NULL,NULL,'7fa35c0bf3e5d2b499b8fa07151ebae2',NULL,'TAT338',6862,'17000.00',NULL,'1c383cd30b7c298ab50293adfecb7b18','petani'),(36,2,2,'asd','asda','asd','asd','asd','asd','','','','sads','2017-02-21',NULL,1,'3','1','1','asd',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'I1702F89A','K1702IFCP','J1702TU70',NULL,NULL,'d9db2013b5210454e14c45af8aedcfa5',NULL,'TAT338',6862,'17000.00',NULL,'19ca14e7ea6328a42e0eb13d585e4c22','petani'),(37,2,2,'asd','asd','sada','asdas','asd','','','','','asd','2017-02-07',NULL,1,'3','0','0','asd',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'I17023GLI','K1702S5M3','J1702N8T6',NULL,NULL,'9e1269f8a1856d7465a2b1e695af6d25',NULL,'TAT338',6862,'17000.00',NULL,'a5bfc9e07964f8dddeb95fc584cd965d','petani'),(38,1,2,'asd','asd','asd','asd','sd2','sad','asd','','','asd','2017-02-13',NULL,3,'3','1','1','asd',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'I1702ANOT','K1702RK5A','J17022BCT',NULL,NULL,'51a9fa85457c50a479af3da92c387bb7',NULL,'TAT338',6862,'17000.00',NULL,'a5771bce93e200c36f7cd9dfd0e5deaa','perawattaiwan'),(39,1,2,'asd','asd','asd','asd','sd2','sad','asd','','','asd','2017-02-13',NULL,3,'3','1','1','asd',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'I1702MROX','K1702BCDY','J1702L23O',NULL,NULL,'75710be97d7f53041d63409d670691e3',NULL,'TAT338',6862,'17000.00',NULL,'d67d8ab4f4c10bf22aa353e27879133c','perawattaiwan');

/*Table structure for table `file` */

DROP TABLE IF EXISTS `file`;

CREATE TABLE `file` (
  `idmasalah` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(150) CHARACTER SET big5 NOT NULL,
  `username` varchar(45) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `fk_file_masalah1_idx` (`idmasalah`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `file` */

/*Table structure for table `history` */

DROP TABLE IF EXISTS `history`;

CREATE TABLE `history` (
  `idhistory` int(11) NOT NULL AUTO_INCREMENT,
  `idmasalah` int(11) NOT NULL,
  `history` varchar(250) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_username` varchar(45) NOT NULL,
  PRIMARY KEY (`idhistory`),
  KEY `fk_history_masalah1_idx` (`idmasalah`),
  KEY `fk_history_user1_idx` (`user_username`),
  CONSTRAINT `fk_history_masalah1` FOREIGN KEY (`idmasalah`) REFERENCES `masalah` (`idmasalah`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_history_user1` FOREIGN KEY (`user_username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `history` */

insert  into `history`(`idhistory`,`idmasalah`,`history`,`timestamp`,`user_username`) values (1,3488,'menginputkan masalah baru','2017-04-12 18:10:58','agent');

/*Table structure for table `info_bnsp` */

DROP TABLE IF EXISTS `info_bnsp`;

CREATE TABLE `info_bnsp` (
  `idpropinsi` int(2) NOT NULL AUTO_INCREMENT,
  `propinsi` varchar(19) DEFAULT NULL,
  `propinsieng` varchar(50) DEFAULT NULL,
  `umr2015` int(10) DEFAULT NULL,
  `umr2016` int(7) DEFAULT NULL,
  `ctk2014` int(7) DEFAULT NULL,
  `blk_eng` int(7) DEFAULT NULL,
  `blk_non` int(7) DEFAULT NULL,
  `smk_eng` int(7) DEFAULT NULL,
  `blk_count` int(5) DEFAULT NULL,
  `balai` text NOT NULL,
  KEY `idpropinsi` (`idpropinsi`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `info_bnsp` */

/*Table structure for table `info_remitansi` */

DROP TABLE IF EXISTS `info_remitansi`;

CREATE TABLE `info_remitansi` (
  `idinstitution` int(11) NOT NULL,
  `month` int(2) DEFAULT NULL,
  `value` int(15) DEFAULT NULL,
  `year` int(4) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `info_remitansi` */

/*Table structure for table `inputcategory_penempatan` */

DROP TABLE IF EXISTS `inputcategory_penempatan`;

CREATE TABLE `inputcategory_penempatan` (
  `idcategory_penempatan` int(11) NOT NULL AUTO_INCREMENT,
  `namecategory` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idcategory_penempatan`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `inputcategory_penempatan` */

insert  into `inputcategory_penempatan`(`idcategory_penempatan`,`namecategory`) values (1,'Worker Data'),(2,'Job Order Data');

/*Table structure for table `inputcategory_perlindungan` */

DROP TABLE IF EXISTS `inputcategory_perlindungan`;

CREATE TABLE `inputcategory_perlindungan` (
  `idcategory_perlindungan` int(11) NOT NULL AUTO_INCREMENT,
  `namecategory` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idcategory_perlindungan`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `inputcategory_perlindungan` */

insert  into `inputcategory_perlindungan`(`idcategory_perlindungan`,`namecategory`) values (1,'Test'),(2,'Info Agensi');

/*Table structure for table `inputdetail_penempatan` */

DROP TABLE IF EXISTS `inputdetail_penempatan`;

CREATE TABLE `inputdetail_penempatan` (
  `idinputdetail_penempatan` int(11) NOT NULL AUTO_INCREMENT,
  `nameinputdetail` varchar(45) DEFAULT NULL,
  `idcategory_penempatan` int(11) NOT NULL,
  `idinputtype` int(11) NOT NULL,
  `keterangan` varchar(90) DEFAULT NULL,
  `conntable` varchar(60) DEFAULT NULL,
  `fieldname` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idinputdetail_penempatan`),
  KEY `fk_inputdetail_inputcategory1_idx` (`idcategory_penempatan`),
  KEY `fk_inputdetail_inputtype1_idx` (`idinputtype`),
  CONSTRAINT `fk_inputdetail_inputcategory1` FOREIGN KEY (`idcategory_penempatan`) REFERENCES `inputcategory_penempatan` (`idcategory_penempatan`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_inputdetail_inputtype1` FOREIGN KEY (`idinputtype`) REFERENCES `inputtype` (`idinputtype`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `inputdetail_penempatan` */

insert  into `inputdetail_penempatan`(`idinputdetail_penempatan`,`nameinputdetail`,`idcategory_penempatan`,`idinputtype`,`keterangan`,`conntable`,`fieldname`) values (1,'Worker Data #1',1,1,'dinamis',NULL,'testing'),(2,'Worker Data #2',1,1,'dinamis',NULL,'agensiname'),(3,'Worker Data #3',1,1,'dinamis',NULL,'agensiname'),(4,'Worker Data #4',1,1,'dinamis',NULL,'agensiname'),(5,'JO Data #1',2,1,'dinamis',NULL,'jenisagensi'),(6,'JO Data #2',2,1,'dinamis',NULL,'jenisagensi'),(7,'JO Data #3',2,1,'dinamis',NULL,'jenisagensi'),(8,'JO Data #4',2,1,'dinamis',NULL,'nohp');

/*Table structure for table `inputdetail_perlindungan` */

DROP TABLE IF EXISTS `inputdetail_perlindungan`;

CREATE TABLE `inputdetail_perlindungan` (
  `idinputdetail_perlindungan` int(11) NOT NULL AUTO_INCREMENT,
  `nameinputdetail` varchar(45) DEFAULT NULL,
  `idcategory_perlindungan` int(11) NOT NULL,
  `idinputtype` int(11) NOT NULL,
  `keterangan` varchar(90) DEFAULT NULL,
  `conntable` varchar(45) DEFAULT NULL,
  `fieldname` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idinputdetail_perlindungan`),
  KEY `fk_inputdetail_perlindungan_inputtype1_idx` (`idinputtype`),
  KEY `fk_inputdetail_perlindungan_inputcategory_perlindungan1_idx` (`idcategory_perlindungan`),
  CONSTRAINT `fk_inputdetail_perlindungan_inputcategory_perlindungan1` FOREIGN KEY (`idcategory_perlindungan`) REFERENCES `inputcategory_perlindungan` (`idcategory_perlindungan`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_inputdetail_perlindungan_inputtype1` FOREIGN KEY (`idinputtype`) REFERENCES `inputtype` (`idinputtype`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `inputdetail_perlindungan` */

insert  into `inputdetail_perlindungan`(`idinputdetail_perlindungan`,`nameinputdetail`,`idcategory_perlindungan`,`idinputtype`,`keterangan`,`conntable`,`fieldname`) values (1,'Testing',1,1,'taiwan',NULL,'testing'),(2,'Jenis Kelamin',1,1,'Gender',NULL,'gender'),(9,'Tanggal meninggal',1,3,'dead date',NULL,'deaddate'),(10,'Jenis Kelamin',1,2,'Gender','wilayah','Gendertype'),(11,'Nama PPTKIS',2,1,'PPTKIS name',NULL,'PPTKIS');

/*Table structure for table `inputoption_penempatan` */

DROP TABLE IF EXISTS `inputoption_penempatan`;

CREATE TABLE `inputoption_penempatan` (
  `idinputoption_penempatan` int(11) NOT NULL AUTO_INCREMENT,
  `nameinputoption` varchar(45) DEFAULT NULL,
  `idinputdetail_penempatan` int(11) NOT NULL,
  PRIMARY KEY (`idinputoption_penempatan`),
  KEY `fk_inputoption_inputdetail1_idx` (`idinputdetail_penempatan`),
  CONSTRAINT `fk_inputoption_inputdetail1` FOREIGN KEY (`idinputdetail_penempatan`) REFERENCES `inputdetail_penempatan` (`idinputdetail_penempatan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `inputoption_penempatan` */

/*Table structure for table `inputoption_perlindungan` */

DROP TABLE IF EXISTS `inputoption_perlindungan`;

CREATE TABLE `inputoption_perlindungan` (
  `idinputoption_perlindungan` int(11) NOT NULL AUTO_INCREMENT,
  `nameinputoption` varchar(45) DEFAULT NULL,
  `idinputdetail_perlindungan` int(11) NOT NULL,
  PRIMARY KEY (`idinputoption_perlindungan`),
  KEY `fk_inputoption_perlindungan_inputdetail_perlindungan1_idx` (`idinputdetail_perlindungan`),
  CONSTRAINT `fk_inputoption_perlindungan_inputdetail_perlindungan1` FOREIGN KEY (`idinputdetail_perlindungan`) REFERENCES `inputdetail_perlindungan` (`idinputdetail_perlindungan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `inputoption_perlindungan` */

insert  into `inputoption_perlindungan`(`idinputoption_perlindungan`,`nameinputoption`,`idinputdetail_perlindungan`) values (1,'Cowok',10),(2,'Cewek',10);

/*Table structure for table `inputtype` */

DROP TABLE IF EXISTS `inputtype`;

CREATE TABLE `inputtype` (
  `idinputtype` int(11) NOT NULL AUTO_INCREMENT,
  `nameinputtype` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idinputtype`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `inputtype` */

insert  into `inputtype`(`idinputtype`,`nameinputtype`) values (1,'text'),(2,'select'),(3,'date');

/*Table structure for table `institution` */

DROP TABLE IF EXISTS `institution`;

CREATE TABLE `institution` (
  `idinstitution` int(11) NOT NULL AUTO_INCREMENT,
  `nameinstitution` varchar(45) DEFAULT NULL,
  `endorsementtype` varchar(45) DEFAULT NULL,
  `idcurrency` int(11) NOT NULL,
  `isactive` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idinstitution`),
  KEY `fk_currency` (`idcurrency`),
  CONSTRAINT `fk_currency` FOREIGN KEY (`idcurrency`) REFERENCES `currency` (`idcurrency`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `institution` */

insert  into `institution`(`idinstitution`,`nameinstitution`,`endorsementtype`,`idcurrency`,`isactive`) values (1,'Super',NULL,1,'1'),(2,'Taiwan','Swainput',1,'1'),(3,'test','test',1,NULL),(4,'Amerika','Swainput',1,'1');

/*Table structure for table `institution_has_inputdetail_penempatan` */

DROP TABLE IF EXISTS `institution_has_inputdetail_penempatan`;

CREATE TABLE `institution_has_inputdetail_penempatan` (
  `idinstitution` int(11) NOT NULL,
  `idinputdetail_penempatan` int(11) NOT NULL,
  `isactive` varchar(45) DEFAULT NULL,
  KEY `fk_institution_has_inputdetail_inputdetail1_idx` (`idinputdetail_penempatan`),
  KEY `fk_institution_has_inputdetail_institution_idx` (`idinstitution`),
  CONSTRAINT `fk_institution_has_inputdetail_inputdetail1` FOREIGN KEY (`idinputdetail_penempatan`) REFERENCES `inputdetail_penempatan` (`idinputdetail_penempatan`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_institution_has_inputdetail_institution` FOREIGN KEY (`idinstitution`) REFERENCES `institution` (`idinstitution`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `institution_has_inputdetail_penempatan` */

insert  into `institution_has_inputdetail_penempatan`(`idinstitution`,`idinputdetail_penempatan`,`isactive`) values (2,1,'1'),(2,4,'1'),(2,7,'1');

/*Table structure for table `institution_has_inputdetail_perlindungan` */

DROP TABLE IF EXISTS `institution_has_inputdetail_perlindungan`;

CREATE TABLE `institution_has_inputdetail_perlindungan` (
  `idinstitution` int(11) NOT NULL,
  `idinputdetail_perlindungan` int(11) NOT NULL,
  `isactive` varchar(45) DEFAULT NULL,
  KEY `fk_institution_has_inputdetail_perlindungan_inputdetail_per_idx` (`idinputdetail_perlindungan`),
  KEY `fk_institution_has_inputdetail_perlindungan_institution1_idx` (`idinstitution`),
  CONSTRAINT `fk_institution_has_inputdetail_perlindungan_inputdetail_perli1` FOREIGN KEY (`idinputdetail_perlindungan`) REFERENCES `inputdetail_perlindungan` (`idinputdetail_perlindungan`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_institution_has_inputdetail_perlindungan_institution1` FOREIGN KEY (`idinstitution`) REFERENCES `institution` (`idinstitution`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `institution_has_inputdetail_perlindungan` */

insert  into `institution_has_inputdetail_perlindungan`(`idinstitution`,`idinputdetail_perlindungan`,`isactive`) values (2,1,'1'),(2,11,'1'),(2,10,'1');

/*Table structure for table `institution_has_klasifikasi` */

DROP TABLE IF EXISTS `institution_has_klasifikasi`;

CREATE TABLE `institution_has_klasifikasi` (
  `id` int(11) NOT NULL,
  `idinstitution` int(11) NOT NULL,
  `isactive` tinyint(1) DEFAULT NULL,
  KEY `fk_klasifikasi_has_institution_institution1_idx` (`idinstitution`),
  KEY `fk_klasifikasi_has_institution_klasifikasi1_idx` (`id`),
  CONSTRAINT `fk_klasifikasi_has_institution_institution1` FOREIGN KEY (`idinstitution`) REFERENCES `institution` (`idinstitution`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_klasifikasi_has_institution_klasifikasi1` FOREIGN KEY (`id`) REFERENCES `klasifikasi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `institution_has_klasifikasi` */

insert  into `institution_has_klasifikasi`(`id`,`idinstitution`,`isactive`) values (1,2,1),(2,2,1);

/*Table structure for table `institution_has_media` */

DROP TABLE IF EXISTS `institution_has_media`;

CREATE TABLE `institution_has_media` (
  `id` int(11) NOT NULL,
  `idinstitution` int(11) NOT NULL,
  `isactive` tinyint(1) NOT NULL,
  KEY `fk_institution_has_media_media1_idx` (`id`),
  KEY `fk_institution_has_media_institution1_idx` (`idinstitution`),
  CONSTRAINT `fk_institution_has_media_institution1` FOREIGN KEY (`idinstitution`) REFERENCES `institution` (`idinstitution`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_institution_has_media_media1` FOREIGN KEY (`id`) REFERENCES `media` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `institution_has_media` */

insert  into `institution_has_media`(`id`,`idinstitution`,`isactive`) values (1,2,1);

/*Table structure for table `institution_has_wilayah` */

DROP TABLE IF EXISTS `institution_has_wilayah`;

CREATE TABLE `institution_has_wilayah` (
  `id` int(11) NOT NULL,
  `idinstitution` int(11) NOT NULL,
  `isactive` tinyint(1) NOT NULL,
  KEY `fk_institution_has_wilayah_wilayah1_idx` (`id`),
  KEY `fk_institution_has_wilayah_institution1_idx` (`idinstitution`),
  CONSTRAINT `fk_institution_has_wilayah_institution1` FOREIGN KEY (`idinstitution`) REFERENCES `institution` (`idinstitution`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_institution_has_wilayah_wilayah1` FOREIGN KEY (`id`) REFERENCES `wilayah` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `institution_has_wilayah` */

insert  into `institution_has_wilayah`(`id`,`idinstitution`,`isactive`) values (1,2,1);

/*Table structure for table `jenispekerjaan` */

DROP TABLE IF EXISTS `jenispekerjaan`;

CREATE TABLE `jenispekerjaan` (
  `idjenispekerjaan` int(11) NOT NULL AUTO_INCREMENT,
  `namajenispekerjaan` varchar(45) DEFAULT NULL,
  `isactive` varchar(45) NOT NULL,
  `idpekerjaan_bnp2tki` varchar(45) DEFAULT NULL,
  `idinstitution` int(11) NOT NULL,
  `sektor` int(11) DEFAULT NULL,
  `jpgaji` float NOT NULL,
  `curjodownloadurl` varchar(255) NOT NULL,
  `curtkidownloadurl` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idjenispekerjaan`),
  KEY `fk_jenispekerjaan_institution1_idx` (`idinstitution`),
  CONSTRAINT `fk_jenispekerjaan_institution1` FOREIGN KEY (`idinstitution`) REFERENCES `institution` (`idinstitution`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `jenispekerjaan` */

insert  into `jenispekerjaan`(`idjenispekerjaan`,`namajenispekerjaan`,`isactive`,`idpekerjaan_bnp2tki`,`idinstitution`,`sektor`,`jpgaji`,`curjodownloadurl`,`curtkidownloadurl`) values (1,'Perawat','1','1',2,2,200.4,'perawattaiwan','tkiperawattaiwan'),(2,'Petani','1','1',2,1,150,'petani','petani');

/*Table structure for table `jo` */

DROP TABLE IF EXISTS `jo`;

CREATE TABLE `jo` (
  `jobid` int(11) NOT NULL AUTO_INCREMENT,
  `ppkode` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `agid` int(11) NOT NULL,
  `idinstitution` int(11) NOT NULL,
  `jobno` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `jobtglawal` date DEFAULT NULL,
  `jobtglakhir` date DEFAULT NULL,
  `jobenable` decimal(1,0) DEFAULT '1',
  `jobtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `jobispushed` decimal(1,0) NOT NULL DEFAULT '0',
  `username` varchar(45) NOT NULL,
  `jopushtimestamp` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`jobid`),
  KEY `jobtglawal` (`jobtglawal`),
  KEY `jobtglakhir` (`jobtglakhir`),
  KEY `jobtglawal_2` (`jobtglawal`,`jobtglakhir`),
  KEY `fk_jo_mpptkis1_idx` (`ppkode`),
  KEY `fk_jo_magensi1_idx` (`agid`),
  KEY `fk_jo_user1_idx` (`username`),
  KEY `fk_jo_institution1_idx` (`idinstitution`),
  CONSTRAINT `fk_jo_institution1` FOREIGN KEY (`idinstitution`) REFERENCES `institution` (`idinstitution`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_jo_magensi1` FOREIGN KEY (`agid`) REFERENCES `magensi` (`agid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_jo_mpptkis1` FOREIGN KEY (`ppkode`) REFERENCES `mpptkis` (`ppkode`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_jo_user1` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `jo` */

insert  into `jo`(`jobid`,`ppkode`,`agid`,`idinstitution`,`jobno`,`jobtglawal`,`jobtglakhir`,`jobenable`,`jobtimestamp`,`jobispushed`,`username`,`jopushtimestamp`) values (2,'TAT338',6862,2,'1','2016-11-01','2017-04-25','1','2017-04-13 18:20:48','0','budi',NULL),(3,'TAT338',2,2,'4','2017-04-13','2017-04-27','1','2017-04-13 18:12:52','0','gian',NULL);

/*Table structure for table `jodetail` */

DROP TABLE IF EXISTS `jodetail`;

CREATE TABLE `jodetail` (
  `jobdid` int(11) NOT NULL AUTO_INCREMENT,
  `jobid` int(11) NOT NULL,
  `idjenispekerjaan` int(11) NOT NULL,
  `jobdl` int(11) DEFAULT NULL,
  `jobdp` int(11) DEFAULT NULL,
  `jobdc` int(11) DEFAULT NULL,
  PRIMARY KEY (`jobdid`),
  KEY `jodetail_jobid` (`jobid`),
  KEY `fk_jodetail_jenispekerjaan1_idx` (`idjenispekerjaan`),
  CONSTRAINT `fk_jodetail_jenispekerjaan1` FOREIGN KEY (`idjenispekerjaan`) REFERENCES `jenispekerjaan` (`idjenispekerjaan`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `jodetail_ibfk_2` FOREIGN KEY (`jobid`) REFERENCES `jo` (`jobid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `jodetail` */

insert  into `jodetail`(`jobdid`,`jobid`,`idjenispekerjaan`,`jobdl`,`jobdp`,`jobdc`) values (1,2,1,10,8,0),(2,2,2,8,7,10),(5,3,1,10,10,5);

/*Table structure for table `kantor` */

DROP TABLE IF EXISTS `kantor`;

CREATE TABLE `kantor` (
  `idkantor` int(11) NOT NULL AUTO_INCREMENT,
  `idinstitution` int(11) NOT NULL,
  `namakantor` varchar(45) DEFAULT NULL,
  `isactive` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idkantor`),
  KEY `fk_kantor_institution_idx` (`idinstitution`),
  CONSTRAINT `fk_kantor_institution1` FOREIGN KEY (`idinstitution`) REFERENCES `institution` (`idinstitution`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `kantor` */

insert  into `kantor`(`idkantor`,`idinstitution`,`namakantor`,`isactive`) values (1,1,'Super','1'),(2,2,'Local','1'),(3,2,'Taili','1');

/*Table structure for table `keberangkatan` */

DROP TABLE IF EXISTS `keberangkatan`;

CREATE TABLE `keberangkatan` (
  `keberangkatanid` int(11) NOT NULL AUTO_INCREMENT,
  `tkiid` int(11) NOT NULL,
  `tkpaspor` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `bandaracode` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `transitport` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`keberangkatanid`)
) ENGINE=MyISAM AUTO_INCREMENT=8570 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `keberangkatan` */

/*Table structure for table `kepulangan` */

DROP TABLE IF EXISTS `kepulangan`;

CREATE TABLE `kepulangan` (
  `kepulanganid` int(11) NOT NULL AUTO_INCREMENT,
  `tkiid` int(11) NOT NULL,
  `tkpaspor` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `bandaracode` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `transitport` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`kepulanganid`)
) ENGINE=MyISAM AUTO_INCREMENT=4923 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `kepulangan` */

/*Table structure for table `klasifikasi` */

DROP TABLE IF EXISTS `klasifikasi`;

CREATE TABLE `klasifikasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `klasifikasi` */

insert  into `klasifikasi`(`id`,`name`) values (1,'Gaji'),(2,'KDRT');

/*Table structure for table `komentar` */

DROP TABLE IF EXISTS `komentar`;

CREATE TABLE `komentar` (
  `idkomentar` int(11) NOT NULL AUTO_INCREMENT,
  `idmasalah` int(11) NOT NULL,
  `komentar` text CHARACTER SET big5 NOT NULL,
  `username` varchar(45) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idkomentar`),
  KEY `fk_komentar_user1_idx` (`username`),
  KEY `fk_komentar_masalah1_idx` (`idmasalah`)
) ENGINE=MyISAM AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;

/*Data for the table `komentar` */

/*Table structure for table `kuitansi` */

DROP TABLE IF EXISTS `kuitansi`;

CREATE TABLE `kuitansi` (
  `kuid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `idinstitution` int(11) NOT NULL,
  `idtipe` int(11) NOT NULL,
  `kuno` varchar(10) DEFAULT NULL,
  `kujmlbayar` decimal(7,0) DEFAULT NULL,
  `kupemohon` varchar(50) DEFAULT NULL,
  `kutglmasuk` date DEFAULT NULL,
  `kutglendorsement` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `kuhapus` decimal(1,0) DEFAULT NULL,
  `kukode` varchar(8) DEFAULT NULL,
  `kutglkuitansi` timestamp NULL DEFAULT NULL,
  `kutglpengambilan` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`kuid`),
  KEY `fk_kuitansi_user1_idx` (`username`),
  KEY `fk_kuitansi_institution1_idx` (`idinstitution`),
  KEY `fk_kuitansi_tipe1_idx` (`idtipe`),
  CONSTRAINT `fk_kuitansi_institution1` FOREIGN KEY (`idinstitution`) REFERENCES `institution` (`idinstitution`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_kuitansi_tipe1` FOREIGN KEY (`idtipe`) REFERENCES `tipe` (`idtipe`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_kuitansi_user1` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

/*Data for the table `kuitansi` */

insert  into `kuitansi`(`kuid`,`username`,`idinstitution`,`idtipe`,`kuno`,`kujmlbayar`,`kupemohon`,`kutglmasuk`,`kutglendorsement`,`kuhapus`,`kukode`,`kutglkuitansi`,`kutglpengambilan`) values (1,'gian',2,1,'123456','1000','Budiman','2017-01-08','2017-01-08 00:48:53',NULL,NULL,'2016-12-30 21:07:46',NULL),(3,'agent',2,1,'1','1000','Budiman','2017-01-11','2017-01-06 21:05:41',NULL,NULL,'2017-01-19 00:00:00',NULL),(4,'agent',2,1,'2','1000','Budiman','2017-01-11','2017-01-06 21:24:46',NULL,NULL,'2017-01-19 00:00:00',NULL),(5,'agent',2,1,'3','1000','Budiman','2017-01-11','2017-01-06 21:25:42',NULL,NULL,'2017-01-19 00:00:00',NULL),(6,'agent',2,1,'4','1000','Budiman','2017-01-11','2017-01-06 21:25:48',NULL,NULL,'2017-01-19 00:00:00',NULL),(7,'agent',2,1,'5','1000','Budiman','2017-01-11','2017-01-06 21:26:54',NULL,NULL,'2017-01-19 00:00:00',NULL),(8,'agent',2,1,'6','1000','Budiman','2017-01-11','2017-01-06 21:29:38',NULL,NULL,'2017-01-19 00:00:00',NULL),(9,'agent',2,1,'7','1000','Budiman','2017-01-11','2017-01-06 21:30:03',NULL,NULL,'2017-01-26 00:00:00',NULL),(10,'sadmin',1,1,'8','1000','Budiman','2017-01-10','2017-01-07 17:35:09',NULL,NULL,'2017-01-26 00:00:00',NULL),(11,'sadmin',1,1,'testif','1000','Budiman','2017-01-10','2017-01-07 17:37:10',NULL,NULL,'2017-01-26 00:00:00',NULL),(12,'sadmin',1,1,'testifz','123213','sdsadas','2017-01-10','2017-01-07 17:37:37',NULL,NULL,'2017-01-27 00:00:00',NULL),(13,'sadmin',1,1,'testpreven','1234','sadasd','2017-01-03','2017-01-07 17:38:20',NULL,NULL,'2017-01-26 00:00:00',NULL),(14,'sadmin',1,1,'testpreven','1234','sadasd','2017-01-03','2017-01-07 17:49:51',NULL,NULL,'2017-01-26 00:00:00',NULL),(15,'sadmin',1,1,'wqeqweq','213213','sadasda','2017-01-09','2017-01-07 17:50:03',NULL,NULL,'2017-01-27 00:00:00',NULL),(16,'sadmin',1,1,'testifz','123213','sdsadas','2017-01-10','2017-01-07 17:50:33',NULL,NULL,'2017-01-27 00:00:00',NULL),(17,'sadmin',1,1,'testifz','123213','sdsadas','2017-01-10','2017-01-07 18:01:32',NULL,NULL,'2017-01-27 00:00:00',NULL),(18,'sadmin',1,1,'testifz','123213','sdsadas','2017-01-10','2017-01-07 18:02:19',NULL,NULL,'2017-01-27 00:00:00',NULL),(19,'sadmin',1,1,'testif','1000','Budiman','2017-01-10','2017-01-07 18:02:22',NULL,NULL,'2017-01-26 00:00:00',NULL),(20,'sadmin',1,2,'asdasd','123213','asdads','2017-01-04','2017-01-07 19:00:39',NULL,NULL,'2017-01-12 00:00:00',NULL),(21,'sadmin',1,2,'tescatat','2132131','asdasd','2017-01-03','2017-01-07 19:01:44',NULL,NULL,'2017-01-20 00:00:00',NULL),(22,'sadmin',1,2,'testupdate','1232132','sadasdsa','2017-01-04','2017-01-07 19:26:39',NULL,NULL,'2017-01-19 00:00:00',NULL),(23,'sadmin',1,2,'testupdate','1232132','sadasdsa','2017-01-04','2017-01-07 19:28:07',NULL,NULL,'2017-01-19 00:00:00',NULL),(24,'sadmin',1,2,'testupdate','12312','asdasdas','2017-01-11','2017-01-07 19:28:50',NULL,NULL,'2017-01-27 00:00:00',NULL),(25,'sadmin',1,2,'pastibisa','21321','asdasds','2017-01-10','2017-01-07 19:30:59',NULL,NULL,'2017-01-20 00:00:00',NULL),(26,'sadmin',1,2,'pastibisah','1232131','asdasda','2017-01-18','2017-01-07 19:32:32',NULL,NULL,'2017-02-02 00:00:00',NULL),(27,'sadmin',1,1,'asdasd','123213','asdads','2017-01-05','2017-01-07 20:28:25',NULL,'00001AGA','2017-01-19 00:00:00',NULL),(28,'sadmin',1,1,'fixselesai','2132131','asdasdas','2017-01-05','2017-01-07 20:30:37',NULL,'00020AGA','2017-01-20 00:00:00',NULL),(29,'gian',2,1,'1234','1000','Budimen','2017-01-08','2017-01-08 08:16:31',NULL,NULL,'2017-01-07 00:16:47',NULL),(30,'gian',2,1,'123','1500','Budimun','2017-01-09','2017-01-09 01:09:51',NULL,NULL,'2017-01-08 01:09:58',NULL),(31,'gian',2,2,'121241241','1000','abc','2017-02-01','2017-02-09 17:19:53',NULL,'00001BGB','2017-02-01 00:00:00',NULL),(32,'gian',2,2,'1251535353','1000','abac','2017-02-01','2017-02-09 17:22:43',NULL,'00002BGB','2017-02-01 00:00:00',NULL),(33,'gian',2,2,'142141351','1000','abcdf','2017-02-01','2017-02-09 17:28:37',NULL,'00003BGB','2017-02-01 00:00:00',NULL),(34,'gian',2,2,'TESTJAM','123213','asdads','2017-02-28','2017-02-10 09:49:53',NULL,'00004BGB','2017-02-17 00:00:00',NULL);

/*Table structure for table `level` */

DROP TABLE IF EXISTS `level`;

CREATE TABLE `level` (
  `idlevel` int(11) NOT NULL AUTO_INCREMENT,
  `levelname` varchar(45) DEFAULT NULL,
  `dashboard` varchar(50) NOT NULL,
  PRIMARY KEY (`idlevel`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `level` */

insert  into `level`(`idlevel`,`levelname`,`dashboard`) values (1,'SAdmin',''),(2,'LAdmin',''),(3,'Staff',''),(4,'Agensi','');

/*Table structure for table `level_has_privilegedetail` */

DROP TABLE IF EXISTS `level_has_privilegedetail`;

CREATE TABLE `level_has_privilegedetail` (
  `idlevel` int(11) NOT NULL,
  `idprivilege` int(11) NOT NULL,
  KEY `fk_level_has_priviligedetail_priviligedetail1_idx` (`idprivilege`),
  KEY `fk_level_has_priviligedetail_level1_idx` (`idlevel`),
  CONSTRAINT `fk_level_has_priviligedetail_level1` FOREIGN KEY (`idlevel`) REFERENCES `level` (`idlevel`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_level_has_priviligedetail_priviligedetail1` FOREIGN KEY (`idprivilege`) REFERENCES `privilegedetail` (`idprivilege`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `level_has_privilegedetail` */

insert  into `level_has_privilegedetail`(`idlevel`,`idprivilege`) values (1,1),(1,2),(1,3),(1,4),(1,5),(1,6),(1,7),(1,8),(1,9),(1,10),(1,11),(1,12),(1,13),(1,14),(1,15),(1,16),(1,17),(1,18),(1,19),(1,20),(1,21),(1,22),(1,23),(1,24),(1,25),(1,26),(2,3),(2,4),(2,5),(2,6),(2,7),(2,17),(2,18),(2,19),(2,20),(2,21),(2,22),(2,23),(2,24),(2,25),(2,26),(3,27),(3,28),(1,29),(1,30),(1,31),(2,29),(2,30),(2,31),(3,32),(1,33),(1,34),(1,35),(2,33),(2,34),(2,35),(1,36),(1,37),(1,38),(1,39),(1,41),(2,38),(2,39),(3,42),(3,43),(3,44),(3,45),(3,46),(1,47),(1,48),(2,47),(2,48),(1,49),(1,50),(2,49),(2,50),(4,60),(4,61),(2,51),(2,52),(2,53),(2,54),(2,55),(2,56),(2,57),(2,58),(4,58),(4,59),(2,27),(2,28),(2,32),(2,43),(2,44),(2,45),(2,46),(1,62),(2,63),(2,64),(3,63),(3,64);

/*Table structure for table `logagensi` */

DROP TABLE IF EXISTS `logagensi`;

CREATE TABLE `logagensi` (
  `idlog` int(11) NOT NULL AUTO_INCREMENT,
  `agid` int(11) NOT NULL,
  `timestamp` date NOT NULL,
  PRIMARY KEY (`idlog`),
  KEY `fk_log_magensi1` (`agid`),
  CONSTRAINT `fk_log_magensi1` FOREIGN KEY (`agid`) REFERENCES `magensi` (`agid`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `logagensi` */

/*Table structure for table `magensi` */

DROP TABLE IF EXISTS `magensi`;

CREATE TABLE `magensi` (
  `agid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) DEFAULT NULL,
  `agnama` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `idinstitution` int(11) NOT NULL,
  `agnamaoth` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `agnoijincla` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `agalmtkantor` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `agalmtkantoroth` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `agpngjwb` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `agpngjwboth` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `agtelp` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `agfax` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `agemail` varchar(255) DEFAULT NULL,
  `agenable` decimal(1,0) DEFAULT '1',
  `agtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`agid`),
  UNIQUE KEY `username_2` (`username`),
  UNIQUE KEY `username_3` (`username`),
  KEY `magensi_username` (`username`),
  KEY `fk_institution` (`idinstitution`),
  KEY `username` (`username`),
  CONSTRAINT `fk_institution` FOREIGN KEY (`idinstitution`) REFERENCES `institution` (`idinstitution`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_relationship_31` FOREIGN KEY (`username`) REFERENCES `user` (`username`),
  CONSTRAINT `magensi_username` FOREIGN KEY (`username`) REFERENCES `user` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=6863 DEFAULT CHARSET=latin1;

/*Data for the table `magensi` */

insert  into `magensi`(`agid`,`username`,`agnama`,`idinstitution`,`agnamaoth`,`agnoijincla`,`agalmtkantor`,`agalmtkantoroth`,`agpngjwb`,`agpngjwboth`,`agtelp`,`agfax`,`agemail`,`agenable`,`agtimestamp`) values (2,'gian','Wang Sen Yong',2,'sabeb','1','1','1','1','1','1','1',NULL,'1','2017-04-12 14:14:50'),(6862,'budi','Taichungli',2,'cung gi wa','123','123','213','123','123','213','123',NULL,'1','2017-01-31 15:15:32');

/*Table structure for table `masalah` */

DROP TABLE IF EXISTS `masalah`;

CREATE TABLE `masalah` (
  `idmasalah` int(11) NOT NULL AUTO_INCREMENT,
  `idinstitution` int(11) NOT NULL,
  `nomormasalah` varchar(100) DEFAULT NULL,
  `idmedia` int(11) NOT NULL,
  `idklasifikasi` int(11) NOT NULL,
  `idjenispekerjaan` int(11) NOT NULL,
  `idwilayah` int(5) NOT NULL,
  `namapelapor` varchar(200) DEFAULT NULL,
  `teleponpelapor` varchar(50) DEFAULT NULL,
  `alamatpelapor` varchar(200) DEFAULT NULL,
  `tanggalpengaduan` date DEFAULT NULL,
  `penerimapengaduan` varchar(100) DEFAULT NULL,
  `petugaspenanganan` varchar(100) DEFAULT NULL,
  `tanggalmasuktaiwan` date DEFAULT NULL,
  `agensi` varchar(255) DEFAULT NULL,
  `cpagensi` varchar(100) DEFAULT NULL,
  `teleponagensi` varchar(255) DEFAULT NULL,
  `pptkis` varchar(255) DEFAULT NULL,
  `majikan` varchar(100) DEFAULT NULL,
  `statustki` int(11) DEFAULT NULL COMMENT ' /* comment truncated */ /*1 = resmi  2 = kaburan*/',
  `permasalahan` text,
  `tuntutan` varchar(400) DEFAULT NULL,
  `uang` varchar(20) DEFAULT NULL,
  `statusmasalah` int(11) NOT NULL COMMENT ' /* comment truncated */ /*1 = belumselesai  2 = sudahselesai*/',
  `tanggalpenyelesaian` date DEFAULT NULL,
  `isinshelter` tinyint(1) DEFAULT NULL,
  `idshelter` int(11) NOT NULL,
  `tanggalmasukshelter` date DEFAULT NULL,
  `tanggalkeluarshelter` date DEFAULT NULL,
  `ppkode` varchar(45) NOT NULL,
  `agid` int(11) NOT NULL,
  `enable` tinyint(1) NOT NULL DEFAULT '1',
  `pulang` tinyint(1) NOT NULL DEFAULT '0',
  `keyword` varchar(200) NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deaddate` date DEFAULT NULL,
  `Gendertype` varchar(45) DEFAULT NULL,
  `PPTKISlain` varchar(100) DEFAULT NULL,
  `testing` int(100) DEFAULT NULL,
  PRIMARY KEY (`idmasalah`),
  KEY `fk_masalah_institution1_idx` (`idinstitution`),
  KEY `fk_masalah_klasifikasi1_idx` (`idklasifikasi`),
  KEY `fk_masalah_media1_idx` (`idmedia`),
  KEY `fk_masalah_jenispekerjaan1_idx` (`idjenispekerjaan`),
  KEY `fk_masalah_wilayah1_idx` (`idwilayah`),
  KEY `fk_masalah_shelter1_idx` (`idshelter`)
) ENGINE=InnoDB AUTO_INCREMENT=3499 DEFAULT CHARSET=utf8;

/*Data for the table `masalah` */

insert  into `masalah`(`idmasalah`,`idinstitution`,`nomormasalah`,`idmedia`,`idklasifikasi`,`idjenispekerjaan`,`idwilayah`,`namapelapor`,`teleponpelapor`,`alamatpelapor`,`tanggalpengaduan`,`penerimapengaduan`,`petugaspenanganan`,`tanggalmasuktaiwan`,`agensi`,`cpagensi`,`teleponagensi`,`pptkis`,`majikan`,`statustki`,`permasalahan`,`tuntutan`,`uang`,`statusmasalah`,`tanggalpenyelesaian`,`isinshelter`,`idshelter`,`tanggalmasukshelter`,`tanggalkeluarshelter`,`ppkode`,`agid`,`enable`,`pulang`,`keyword`,`last_update`,`deaddate`,`Gendertype`,`PPTKISlain`,`testing`) values (3488,2,'1/ADU/KDEI/I/2014 1.2014',1,1,1,1,'Gian',NULL,NULL,'2016-11-18','-','agent','0000-00-00','-','-','-','-','-',1,'TKI illegal, menderita infeksi paru2 serta gangguan pernafasan. 17 Okt -19 Nop 2013 dirawat di ruang ICU.','Tuntutan pengobatan dan pemulangan','1221321',1,'0000-00-00',1,1,'2016-11-19','0000-00-00','0',0,1,0,'sakit','2016-11-19 14:34:16',NULL,NULL,NULL,NULL),(3489,2,'2/ADU/KDEI/I/2014 2.2014',1,2,2,1,'Nano',NULL,NULL,'2017-01-03','-','agent','0000-00-00','-','-','-','-','-',1,'TKI illegal, menderita infeksi ginjal.','Tuntutan pengobatan dan pemulangan','1000000',1,'0000-00-00',1,2,'2017-01-04','0000-00-00','0',0,1,0,'sakit','2017-04-12 18:15:20',NULL,NULL,NULL,NULL);

/*Table structure for table `masalah_has_shelter` */

DROP TABLE IF EXISTS `masalah_has_shelter`;

CREATE TABLE `masalah_has_shelter` (
  `idmasalah` int(11) NOT NULL,
  `idshelter` int(11) NOT NULL,
  `tanggalmasukshelter` date DEFAULT NULL,
  `tanggalkeluarshelter` date DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  KEY `fk_masalah_has_shelter_shelter1_idx` (`idshelter`),
  KEY `fk_masalah_has_shelter_masalah1_idx` (`idmasalah`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `masalah_has_shelter` */

/*Table structure for table `masterprivilegegroup` */

DROP TABLE IF EXISTS `masterprivilegegroup`;

CREATE TABLE `masterprivilegegroup` (
  `masterprivilegegroupid` int(11) NOT NULL AUTO_INCREMENT,
  `masterprivilegegroupname` varchar(45) NOT NULL,
  PRIMARY KEY (`masterprivilegegroupid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `masterprivilegegroup` */

insert  into `masterprivilegegroup`(`masterprivilegegroupid`,`masterprivilegegroupname`) values (1,'Sistem Admin'),(2,'Penempatan'),(3,'Perlindungan');

/*Table structure for table `media` */

DROP TABLE IF EXISTS `media`;

CREATE TABLE `media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `media` */

insert  into `media`(`id`,`name`) values (1,'Langsung');

/*Table structure for table `mpptkis` */

DROP TABLE IF EXISTS `mpptkis`;

CREATE TABLE `mpptkis` (
  `ppkode` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `ppnama` varchar(70) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ppalmtkantor` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pptelp` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ppfax` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ppijin` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pppngjwb` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ppstatus` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ppkota` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pppropinsi` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ppenable` decimal(1,0) DEFAULT '1',
  `pptimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ppkode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `mpptkis` */

insert  into `mpptkis`(`ppkode`,`ppnama`,`ppalmtkantor`,`pptelp`,`ppfax`,`ppijin`,`pppngjwb`,`ppstatus`,`ppkota`,`pppropinsi`,`ppenable`,`pptimestamp`) values ('1','1','1','1','1','1','1','1','1','1','1','2016-12-02 14:22:42'),('123','123','213','123','213','213','123','1','123',NULL,'1','2016-12-02 00:05:01'),('TAT338','TATA BOGA','1','1','1','1','TATA BOGA','T','TATA BOGA',NULL,'1','2017-01-31 15:16:02');

/*Table structure for table `pencatatanej` */

DROP TABLE IF EXISTS `pencatatanej`;

CREATE TABLE `pencatatanej` (
  `kuid` int(11) NOT NULL,
  `ejid` int(11) NOT NULL,
  KEY `fk_kuitansi_has_entryjo_entryjo1_idx` (`ejid`),
  KEY `fk_kuitansi_has_entryjo_kuitansi1_idx` (`kuid`),
  CONSTRAINT `fk_kuitansi_has_entryjo_entryjo1` FOREIGN KEY (`ejid`) REFERENCES `entryjo` (`ejid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_kuitansi_has_entryjo_kuitansi1` FOREIGN KEY (`kuid`) REFERENCES `kuitansi` (`kuid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `pencatatanej` */

insert  into `pencatatanej`(`kuid`,`ejid`) values (1,1),(29,1),(30,2);

/*Table structure for table `privilegedetail` */

DROP TABLE IF EXISTS `privilegedetail`;

CREATE TABLE `privilegedetail` (
  `idprivilege` int(11) NOT NULL AUTO_INCREMENT,
  `menuname` varchar(45) DEFAULT NULL,
  `pageurl` varchar(45) DEFAULT NULL,
  `idprivilegegroup` int(11) NOT NULL,
  PRIMARY KEY (`idprivilege`),
  KEY `fk_priviligedetail_privilegegroup1_idx` (`idprivilegegroup`),
  CONSTRAINT `fk_priviligedetail_privilegegroup1` FOREIGN KEY (`idprivilegegroup`) REFERENCES `privilegegroup` (`idprivilegegroup`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=latin1;

/*Data for the table `privilegedetail` */

insert  into `privilegedetail`(`idprivilege`,`menuname`,`pageurl`,`idprivilegegroup`) values (1,'Lihat Institution','institution',1),(2,'Tambah Institution','institution/add',1),(3,'Lihat Classification','classification',2),(4,'Tambah Classification','classification/add',2),(5,'Assign Classification','classification/assign',2),(6,'Lihat Job Type','jobtype',3),(7,'Tambah Job Type','jobtype/add',3),(8,'Lihat Master Privilege Group','privilege/viewMPG',4),(9,'Tambah Master Privilege Group','privilege/addMPG',4),(10,'Lihat Privilege Group','privilege/viewPG',5),(11,'Tambah Privilege Group','privilege/addPG',5),(12,'Lihat Detail Privilege','privilege/viewDP',6),(13,'Tambah Detail Privilege','privilege/addDP',6),(14,'Lihat Level','level',7),(15,'Tambah Level','level/add',7),(16,'Assign Level','level/assign',7),(17,'Lihat User','user',8),(18,'Tambah User','user/add',8),(19,'Lihat Tipe Input','inputtype',9),(20,'Tambah Tipe Input','inputtype/add',9),(21,'Tambah Kategori','category/addpenempatan',20),(22,'Tambah Detil Input','input/addpenempatan',20),(23,'Assign Input','input/assignpenempatan',10),(24,'Tambah Kategori','category/addperlindungan',11),(25,'Tambah Detil Input','input/addperlindungan',11),(26,'Assign Input','input/assignperlindungan',11),(27,'Hunian Shelter','shelter/hunian',11),(28,'Pencarian Kasus','kasus/search',11),(29,'Lihat Media','media',14),(30,'Tambah Media','media/add',14),(31,'Assign Media','media/assign',14),(32,'Pencarian Data TKI','datatki/search',11),(33,'Lihat Wilayah','wilayah',16),(34,'Tambah Wilayah','wilayah/add',16),(35,'Assign Wilayah','wilayah/assign',16),(36,'Lihat Currency','currency',17),(37,'Tambah Currency','currency/add',17),(38,'Lihat Agensi & PPTKIS','agensipptkis',18),(39,'Tambah Agensi','agensipptkis/addAgensi',18),(41,'Tambah PPTKIS','agensipptkis/addPPTKIS',18),(42,'Agensi & PPTKIS','agensipptkis',11),(43,'Infografik','infografik',11),(44,'Input Kasus Baru','kasus',11),(45,'Rekap Laporan','rekap',11),(46,'Log Aktivitas','log',11),(47,'Lihat Kantor','kantor',19),(48,'Tambah Kantor','kantor/add',19),(49,'Lihat Shelter','shelter',13),(50,'Tambah Shelter','shelter/add',13),(51,'Pencatatan Kuitansi','kuitansi/catat',10),(52,'Cek Barcode','endorsement/checkbarcode',10),(53,'Revisi PK','pk/revisi',10),(54,'Download Laporan Rekap','rekapendorsement',10),(55,'Cekal Agensi','cekal/agensi',10),(56,'Cekal PPTKIS','cekal/pptkis',10),(57,'Pendaftaran Kuota','/paket/add',10),(58,'View Quota','/paket',10),(59,'Update Agency','endorsement/updateagency',10),(60,'Create JO Packet','endorsement/createjo',10),(61,'View JO Packet','endorsement/viewjo',10),(62,'Upload Stamp','pk/uploadstamp',10),(63,'Pemulangan TKI','pemulangantki',11),(64,'Tambah Pemulangan TKI','pemulangantki/add',11);

/*Table structure for table `privilegegroup` */

DROP TABLE IF EXISTS `privilegegroup`;

CREATE TABLE `privilegegroup` (
  `idprivilegegroup` int(11) NOT NULL AUTO_INCREMENT,
  `privilegegroupname` varchar(45) DEFAULT NULL,
  `masterprivilegegroupid` int(11) NOT NULL,
  PRIMARY KEY (`idprivilegegroup`),
  KEY `fk_privilegegroup_masterprivilegegroup1_idx` (`masterprivilegegroupid`),
  CONSTRAINT `fk_privilegegroup_masterprivilegegroup1` FOREIGN KEY (`masterprivilegegroupid`) REFERENCES `masterprivilegegroup` (`masterprivilegegroupid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

/*Data for the table `privilegegroup` */

insert  into `privilegegroup`(`idprivilegegroup`,`privilegegroupname`,`masterprivilegegroupid`) values (1,'Institusi',1),(2,'Klasifikasi',1),(3,'Tipe Pekerjaan',1),(4,'Master Privilege',1),(5,'Privilege Group',1),(6,'Detail Privilege',1),(7,'Level',1),(8,'User',1),(9,'Tipe Input',1),(10,'No Group',2),(11,'No Group',3),(13,'Shelter',1),(14,'Media',1),(16,'Wilayah',1),(17,'Currency',1),(18,'Agensi & PPTKIS',1),(19,'Kantor',1),(20,'Setting',2);

/*Table structure for table `shelter` */

DROP TABLE IF EXISTS `shelter`;

CREATE TABLE `shelter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET big5 NOT NULL,
  `isactive` varchar(45) DEFAULT NULL,
  `idinstitution` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_shelter_institution1_idx` (`idinstitution`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `shelter` */

insert  into `shelter`(`id`,`name`,`isactive`,`idinstitution`) values (1,'Shelter Taichung','1',2),(2,'Shelter Conhi','1',2);

/*Table structure for table `tindak_lanjut` */

DROP TABLE IF EXISTS `tindak_lanjut`;

CREATE TABLE `tindak_lanjut` (
  `idtindaklanjut` int(12) NOT NULL AUTO_INCREMENT,
  `idmasalah` int(11) NOT NULL,
  `tindakan` text NOT NULL,
  `tanggal` date NOT NULL,
  `username` varchar(45) NOT NULL,
  PRIMARY KEY (`idtindaklanjut`),
  KEY `id` (`idtindaklanjut`),
  KEY `fk_tindak_lanjut_masalah1_idx` (`idmasalah`),
  KEY `fk_tindak_lanjut_user1_idx` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=3799 DEFAULT CHARSET=utf8;

/*Data for the table `tindak_lanjut` */

/*Table structure for table `tipe` */

DROP TABLE IF EXISTS `tipe`;

CREATE TABLE `tipe` (
  `idtipe` int(11) NOT NULL AUTO_INCREMENT,
  `tipe` varchar(150) DEFAULT NULL,
  `kode` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`idtipe`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tipe` */

insert  into `tipe`(`idtipe`,`tipe`,`kode`) values (1,'Legalisasi Dokumen TKI (Job Order)','A'),(2,'Recruitment Agreement (PPTKIS dan Agensi)','B');

/*Table structure for table `tki` */

DROP TABLE IF EXISTS `tki`;

CREATE TABLE `tki` (
  `tkid` int(11) NOT NULL AUTO_INCREMENT,
  `ejid` int(11) NOT NULL,
  `tknama` varchar(50) DEFAULT NULL,
  `tknamacn` varchar(50) DEFAULT NULL,
  `tkalmtid` varchar(120) DEFAULT NULL,
  `tkpaspor` varchar(70) DEFAULT NULL,
  `tktglkeluar` date DEFAULT NULL,
  `tktmptkeluar` varchar(30) DEFAULT NULL,
  `tktgllahir` date DEFAULT NULL,
  `tktmptlahir` varchar(30) DEFAULT NULL,
  `tkjk` varchar(1) DEFAULT NULL COMMENT 'Value	Label\r\n            L	Laki-laki\r\n            P	Perempuan',
  `tkstatkwn` decimal(1,0) DEFAULT NULL COMMENT 'Value	Label\r\n            0	Menikah\r\n            1	Belum Menikah\r\n            2	Cerai',
  `tkjmlanaktanggungan` decimal(2,0) DEFAULT NULL,
  `tkahliwaris` varchar(50) DEFAULT NULL,
  `tknama2` varchar(50) DEFAULT NULL,
  `tknamacn2` varchar(50) DEFAULT NULL,
  `tkalmt2` varchar(120) DEFAULT NULL,
  `tkalmtcn2` varchar(100) DEFAULT NULL,
  `tktelp` varchar(20) DEFAULT NULL,
  `tkhub` varchar(30) DEFAULT NULL,
  `tkbc` varchar(10) NOT NULL,
  `tkstat` decimal(1,0) DEFAULT '0',
  `tkrevid` int(11) DEFAULT NULL,
  `tktglubah` date DEFAULT NULL,
  `tktglendorsement` date DEFAULT NULL,
  `tktglendorsement2` date DEFAULT NULL COMMENT 'history pernah diendorse',
  `tkiid` int(11) DEFAULT NULL,
  `tkidownloadurl` varchar(255) NOT NULL,
  `md5tki` varchar(255) NOT NULL,
  `md5ej` varchar(255) NOT NULL,
  PRIMARY KEY (`tkid`),
  UNIQUE KEY `uq_tkbc` (`tkbc`),
  KEY `tki_tkiid` (`tkiid`),
  KEY `fk_tki_entryjo1_idx` (`ejid`),
  CONSTRAINT `fk_tki_entryjo1` FOREIGN KEY (`ejid`) REFERENCES `entryjo` (`ejid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

/*Data for the table `tki` */

insert  into `tki`(`tkid`,`ejid`,`tknama`,`tknamacn`,`tkalmtid`,`tkpaspor`,`tktglkeluar`,`tktmptkeluar`,`tktgllahir`,`tktmptlahir`,`tkjk`,`tkstatkwn`,`tkjmlanaktanggungan`,`tkahliwaris`,`tknama2`,`tknamacn2`,`tkalmt2`,`tkalmtcn2`,`tktelp`,`tkhub`,`tkbc`,`tkstat`,`tkrevid`,`tktglubah`,`tktglendorsement`,`tktglendorsement2`,`tkiid`,`tkidownloadurl`,`md5tki`,`md5ej`) values (2,1,'Setyassida','Wa Lau Bu','Wonogiri','H780GFT','2017-01-01','dummy','2010-11-15','Wonogiri','L','1','2','Saipull','Saipull','Pul Li Naw','Washington','dummy','08675787687','Ayah','kl988','1',3,'2017-01-08','2017-01-06',NULL,NULL,'','',''),(3,1,'Ling','-','Solo','H123FGB','2017-01-05','dummy','2005-01-01','Solo','P','0',NULL,'Jamil','Jamil','-','Beijing','-','08123123123','Ayah','kl999','0',NULL,NULL,'2017-04-13',NULL,NULL,'','',''),(4,2,'Dono','-','Kediri','H123123','2017-01-07','dummy','2001-01-01','Kediri','L','1','2','Ahmad','Ahmad','-','Indonesia','-','08123123231','Ayah','kl1000','0',NULL,NULL,'2017-02-01',NULL,NULL,'','',''),(5,29,'DEWI RATNANINGSIH',NULL,'TANJUNG SERAYAN RT. 19 RW. 5 KEL. TANJUNG SERAYA KEC. MESUJI KECAMATAN MESUJI','AT677397','0000-00-00','KOTABUMI ','0000-00-00','LAMPUNG TENGAH','P','0','0','DADANG','DADANG',NULL,'TANJUNG SERAYAN RT. 19 RW. 5 KEL. TANJUNG SERAYA KEC. MESUJI',NULL,'asd','AYAH','T17029EB8','0',NULL,NULL,NULL,NULL,11300000,'tkiperawattaiwan','e4da3b7fbbce2345d7772b0674a318d5','6ea9ab1baa0efb9e19094440c317e21b'),(6,31,'DEWI RATNANINGSIH',NULL,'TANJUNG SERAYAN RT. 19 RW. 5 KEL. TANJUNG SERAYA KEC. MESUJI KECAMATAN MESUJI','AT677397','0000-00-00','KOTABUMI ','0000-00-00','LAMPUNG TENGAH','P','0','0','DADANG','DADANG',NULL,'TANJUNG SERAYAN RT. 19 RW. 5 KEL. TANJUNG SERAYA KEC. MESUJI',NULL,'asd','AYAH','T1702IRWD','0',NULL,NULL,NULL,NULL,11300000,'petani','1679091c5a880faf6fb5e6087eb1b2dc','c16a5320fa475530d9583c34fd356ef5'),(7,32,'DEWI RATNANINGSIH',NULL,'TANJUNG SERAYAN RT. 19 RW. 5 KEL. TANJUNG SERAYA KEC. MESUJI KECAMATAN MESUJI','AT677397','0000-00-00','KOTABUMI ','0000-00-00','LAMPUNG TENGAH','P','0','0','DADANG','DADANG',NULL,'TANJUNG SERAYAN RT. 19 RW. 5 KEL. TANJUNG SERAYA KEC. MESUJI',NULL,'asd','AYAH','T17021IBG','0',NULL,NULL,NULL,NULL,11300000,'petani','8f14e45fceea167a5a36dedd4bea2543','6364d3f0f495b6ab9dcf8d3b5c6e0b01'),(8,33,'DEWI RATNANINGSIH',NULL,'TANJUNG SERAYAN RT. 19 RW. 5 KEL. TANJUNG SERAYA KEC. MESUJI KECAMATAN MESUJI','AT677397','0000-00-00','KOTABUMI ','0000-00-00','LAMPUNG TENGAH','P','0','0','DADANG','DADANG',NULL,'TANJUNG SERAYAN RT. 19 RW. 5 KEL. TANJUNG SERAYA KEC. MESUJI',NULL,'asd','AYAH','T1702RKDQ','0',NULL,NULL,NULL,NULL,11300000,'tkiperawattaiwan','c9f0f895fb98ab9159f51fd0297e236d','182be0c5cdcd5072bb1864cdee4d3d6e'),(9,34,'DEWI RATNANINGSIH',NULL,'TANJUNG SERAYAN RT. 19 RW. 5 KEL. TANJUNG SERAYA KEC. MESUJI KECAMATAN MESUJI','AT677397','0000-00-00','KOTABUMI ','0000-00-00','LAMPUNG TENGAH','P','0','0','DADANG','DADANG',NULL,'TANJUNG SERAYAN RT. 19 RW. 5 KEL. TANJUNG SERAYA KEC. MESUJI',NULL,'asd','AYAH','T1702P2JW','0',NULL,NULL,NULL,NULL,11300000,'tkiperawattaiwan','45c48cce2e2d7fbdea1afc51c7c6ad26','e369853df766fa44e1ed0ff613f563bd'),(10,35,'DEWI RATNANINGSIH',NULL,'TANJUNG SERAYAN RT. 19 RW. 5 KEL. TANJUNG SERAYA KEC. MESUJI KECAMATAN MESUJI','AT677397','0000-00-00','KOTABUMI ','0000-00-00','LAMPUNG TENGAH','P','0','0','DADANG','DADANG',NULL,'TANJUNG SERAYAN RT. 19 RW. 5 KEL. TANJUNG SERAYA KEC. MESUJI',NULL,'asd','AYAH','T1702I7S5','0',NULL,NULL,NULL,NULL,11300000,'petani','d3d9446802a44259755d38e6d163e820','1c383cd30b7c298ab50293adfecb7b18'),(11,36,'DEWI RATNANINGSIH',NULL,'TANJUNG SERAYAN RT. 19 RW. 5 KEL. TANJUNG SERAYA KEC. MESUJI KECAMATAN MESUJI','AT677397','0000-00-00','KOTABUMI ','0000-00-00','LAMPUNG TENGAH','P','0','0','DADANG','DADANG',NULL,'TANJUNG SERAYAN RT. 19 RW. 5 KEL. TANJUNG SERAYA KEC. MESUJI',NULL,'asd','AYAH','T1702NGXQ','0',NULL,NULL,NULL,NULL,11300000,'petani','6512bd43d9caa6e02c990b0a82652dca','19ca14e7ea6328a42e0eb13d585e4c22'),(12,37,'DEWI RATNANINGSIH',NULL,'TANJUNG SERAYAN RT. 19 RW. 5 KEL. TANJUNG SERAYA KEC. MESUJI KECAMATAN MESUJI','AT677397','0000-00-00','KOTABUMI ','0000-00-00','LAMPUNG TENGAH','P','0','0','DADANG','DADANG',NULL,'TANJUNG SERAYAN RT. 19 RW. 5 KEL. TANJUNG SERAYA KEC. MESUJI',NULL,'asd','AYAH','T1702ROXQ','0',NULL,NULL,NULL,NULL,11300000,'petani','c20ad4d76fe97759aa27a0c99bff6710','a5bfc9e07964f8dddeb95fc584cd965d'),(13,38,'DEWI RATNANINGSIH',NULL,'TANJUNG SERAYAN RT. 19 RW. 5 KEL. TANJUNG SERAYA KEC. MESUJI KECAMATAN MESUJI','AT677397','0000-00-00','KOTABUMI ','0000-00-00','LAMPUNG TENGAH','P','0','0','DADANG','DADANG',NULL,'TANJUNG SERAYAN RT. 19 RW. 5 KEL. TANJUNG SERAYA KEC. MESUJI',NULL,'sad','AYAH','T170209AF','0',NULL,NULL,NULL,NULL,11300000,'tkiperawattaiwan','c51ce410c124a10e0db5e4b97fc2af39','a5771bce93e200c36f7cd9dfd0e5deaa'),(14,38,'DEWI RATNANINGSIH',NULL,'TANJUNG SERAYAN RT. 19 RW. 5 KEL. TANJUNG SERAYA KEC. MESUJI KECAMATAN MESUJI','AT677397','0000-00-00','KOTABUMI ','0000-00-00','LAMPUNG TENGAH','P','0','0','DADANG','DADANG',NULL,'TANJUNG SERAYAN RT. 19 RW. 5 KEL. TANJUNG SERAYA KEC. MESUJI',NULL,'sad','AYAH','T1702ZKXA','0',NULL,NULL,NULL,NULL,11300000,'tkiperawattaiwan','aab3238922bcc25a6f606eb525ffdc56','a5771bce93e200c36f7cd9dfd0e5deaa'),(15,38,'DEWI RATNANINGSIH',NULL,'TANJUNG SERAYAN RT. 19 RW. 5 KEL. TANJUNG SERAYA KEC. MESUJI KECAMATAN MESUJI','AT677397','0000-00-00','KOTABUMI ','0000-00-00','LAMPUNG TENGAH','P','0','0','DADANG','DADANG',NULL,'TANJUNG SERAYAN RT. 19 RW. 5 KEL. TANJUNG SERAYA KEC. MESUJI',NULL,'sad','AYAH','T1702QRW9','0',NULL,NULL,NULL,NULL,11300000,'tkiperawattaiwan','9bf31c7ff062936a96d3c8bd1f8f2ff3','a5771bce93e200c36f7cd9dfd0e5deaa'),(16,39,'DEWI RATNANINGSIH',NULL,'TANJUNG SERAYAN RT. 19 RW. 5 KEL. TANJUNG SERAYA KEC. MESUJI KECAMATAN MESUJI','AT677397','0000-00-00','KOTABUMI ','0000-00-00','LAMPUNG TENGAH','P','0','0','DADANG','DADANG',NULL,'TANJUNG SERAYAN RT. 19 RW. 5 KEL. TANJUNG SERAYA KEC. MESUJI',NULL,'sad','AYAH','T1702Q7C5','0',NULL,NULL,NULL,NULL,11300000,'tkiperawattaiwan','c74d97b01eae257e44aa9d5bade97baf','d67d8ab4f4c10bf22aa353e27879133c'),(17,39,'DEWI RATNANINGSIH',NULL,'TANJUNG SERAYAN RT. 19 RW. 5 KEL. TANJUNG SERAYA KEC. MESUJI KECAMATAN MESUJI','AT677397','0000-00-00','KOTABUMI ','0000-00-00','LAMPUNG TENGAH','P','0','0','DADANG','DADANG',NULL,'TANJUNG SERAYAN RT. 19 RW. 5 KEL. TANJUNG SERAYA KEC. MESUJI',NULL,'sad','AYAH','T1702EZGP','0',NULL,NULL,NULL,NULL,11300000,'tkiperawattaiwan','70efdf2ec9b086079795c442636b55fb','d67d8ab4f4c10bf22aa353e27879133c'),(18,39,'DEWI RATNANINGSIH',NULL,'TANJUNG SERAYAN RT. 19 RW. 5 KEL. TANJUNG SERAYA KEC. MESUJI KECAMATAN MESUJI','AT677397','0000-00-00','KOTABUMI ','0000-00-00','LAMPUNG TENGAH','P','0','0','DADANG','DADANG',NULL,'TANJUNG SERAYAN RT. 19 RW. 5 KEL. TANJUNG SERAYA KEC. MESUJI',NULL,'sad','AYAH','T1702YFGT','0',NULL,NULL,NULL,NULL,11300000,'tkiperawattaiwan','6f4922f45568161a8cdf4ad2299f6d23','d67d8ab4f4c10bf22aa353e27879133c');

/*Table structure for table `tki_pulang` */

DROP TABLE IF EXISTS `tki_pulang`;

CREATE TABLE `tki_pulang` (
  `idtkipulang` int(11) NOT NULL AUTO_INCREMENT,
  `jeniskepulangan` varchar(100) NOT NULL,
  `jk` varchar(2) DEFAULT NULL,
  `namatki` varchar(100) NOT NULL,
  `paspor` varchar(10) DEFAULT NULL,
  `alamatid` varchar(100) DEFAULT NULL,
  `namaagensi` varchar(100) DEFAULT NULL,
  `namapptkis` varchar(100) DEFAULT NULL,
  `namamajikan` varchar(100) DEFAULT NULL,
  `kronologis` text,
  `tanggalpemulangan` date DEFAULT NULL,
  `statuspemulangan` int(11) DEFAULT NULL,
  `tkiid` int(11) DEFAULT NULL,
  `idinstitution` int(11) NOT NULL,
  PRIMARY KEY (`idtkipulang`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `tki_pulang` */

insert  into `tki_pulang`(`idtkipulang`,`jeniskepulangan`,`jk`,`namatki`,`paspor`,`alamatid`,`namaagensi`,`namapptkis`,`namamajikan`,`kronologis`,`tanggalpemulangan`,`statuspemulangan`,`tkiid`,`idinstitution`) values (8,'Jenazah','P','DEWI RATNANINGSIHH','AT677397','TANJUNG SERAYAN RT. 19 RW. 5 KEL. TANJUNG SERAYA KEC. MESUJI KECAMATAN MESUJI','LI YUAN INTERNATIOANL CO,LTD','TATA ATLAS MASTERINDO','DADANG','abcd','2017-04-20',1,11300000,2),(10,'Sakit','L','nanonano','2141343','abcd','abcd','abcd','abcd','abcd','2017-04-11',2,NULL,2),(11,'Repatriasi','L','nanonanonano','2141343','abcd','abcd','abcd','abcd','abcde','2017-04-20',1,NULL,2);

/*Table structure for table `tkimasalah` */

DROP TABLE IF EXISTS `tkimasalah`;

CREATE TABLE `tkimasalah` (
  `idtkimasalah` int(11) NOT NULL AUTO_INCREMENT,
  `idmasalah` int(11) NOT NULL,
  `jk` varchar(11) DEFAULT NULL,
  `namatki` varchar(100) CHARACTER SET utf8 NOT NULL,
  `paspor` varchar(10) DEFAULT NULL,
  `arc` varchar(30) DEFAULT NULL,
  `handphone` varchar(50) DEFAULT NULL,
  `alamatindonesia` varchar(300) CHARACTER SET utf8 DEFAULT NULL,
  `alamattaiwan` varchar(300) CHARACTER SET utf8 DEFAULT NULL,
  `enable` int(11) NOT NULL DEFAULT '1',
  `tkiid` int(11) DEFAULT NULL,
  PRIMARY KEY (`idtkimasalah`),
  KEY `fk_tkimasalah_masalah1_idx` (`idmasalah`),
  KEY `fk_tkimasalah_tki1_idx` (`tkiid`),
  CONSTRAINT `fk_tkimasalah_masalah1` FOREIGN KEY (`idmasalah`) REFERENCES `masalah` (`idmasalah`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_tkimasalah_tki1` FOREIGN KEY (`tkiid`) REFERENCES `tki` (`tkid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7910 DEFAULT CHARSET=latin1;

/*Data for the table `tkimasalah` */

insert  into `tkimasalah`(`idtkimasalah`,`idmasalah`,`jk`,`namatki`,`paspor`,`arc`,`handphone`,`alamatindonesia`,`alamattaiwan`,`enable`,`tkiid`) values (7899,3488,'P','Siti Halimah','AN602601',NULL,'-','Jalan Diponegoro, Surabaya','Shen Cin Wu',1,NULL),(7900,3489,'L','Rudi Prakarsa','AT515151',NULL,'-','Jalan Soekarno Hatta, Bandung','Xi Men Ding',1,NULL);

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `username` varchar(45) NOT NULL,
  `password` varchar(45) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `idinstitution` int(11) NOT NULL,
  `idlevel` int(11) NOT NULL,
  `idkantor` int(11) NOT NULL,
  PRIMARY KEY (`username`),
  KEY `fk_user_institution1_idx` (`idinstitution`),
  KEY `fk_user_level1_idx` (`idlevel`),
  KEY `fk_user_kantor1_idx` (`idkantor`),
  CONSTRAINT `fk_user_institution1` FOREIGN KEY (`idinstitution`) REFERENCES `institution` (`idinstitution`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_user_kantor1` FOREIGN KEY (`idkantor`) REFERENCES `kantor` (`idkantor`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_user_level1` FOREIGN KEY (`idlevel`) REFERENCES `level` (`idlevel`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `user` */

insert  into `user`(`username`,`password`,`name`,`idinstitution`,`idlevel`,`idkantor`) values ('agent','b33aed8f3134996703dc39f9a7c95783','Agent',2,3,3),('budi','00dfc53ee86af02e742515cdcf075ed3','Budi',2,4,3),('gian','56ea9c664e8c9f1ad611cf8e5f1bb41c','Gian Sebastian',2,2,2),('hilman','44ed2b584bcff6f010c7305821cf541a','Hilman',2,2,2),('sadmin','ba41b0eedddc9abaf3d1b55781c4a9c9','Superman',1,1,1);

/*Table structure for table `wilayah` */

DROP TABLE IF EXISTS `wilayah`;

CREATE TABLE `wilayah` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `wilayah` */

insert  into `wilayah`(`id`,`name`) values (1,'New Taipei Country'),(2,'Taipei City');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
