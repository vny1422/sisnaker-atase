/*
SQLyog Ultimate v11.33 (64 bit)
MySQL - 5.6.20 : Database - sisnaker-1
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`sisnaker-1` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `sisnaker`;

/*Table structure for table `currency` */

DROP TABLE IF EXISTS `currency`;

CREATE TABLE `currency` (
  `idcurrency` int(11) NOT NULL AUTO_INCREMENT,
  `currencyname` varchar(45) DEFAULT NULL,
  `kurs` double DEFAULT NULL,
  PRIMARY KEY (`idcurrency`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `currency` */

insert  into `currency`(`idcurrency`,`currencyname`,`kurs`) values (1,'usd',13299);

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
  KEY `fk_history_user1_idx` (`user_username`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `history` */

insert  into `history`(`idhistory`,`idmasalah`,`history`,`timestamp`,`user_username`) values (1,3488,'menginputkan masalah baru','2016-12-14 18:10:58','agent');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `inputcategory_penempatan` */

insert  into `inputcategory_penempatan`(`idcategory_penempatan`,`namecategory`) values (1,'Test');

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

insert  into `inputdetail_penempatan`(`idinputdetail_penempatan`,`nameinputdetail`,`idcategory_penempatan`,`idinputtype`,`keterangan`,`conntable`,`fieldname`) values (1,'Testing',1,1,'taiwan',NULL,'testing'),(2,'Nama Agensi',1,1,'Agency Name',NULL,'agensiname'),(3,'Nama Agensi',1,1,'Agency Name',NULL,'agensiname'),(4,'Nama Agensi',1,1,'Agency Name',NULL,'agensiname'),(5,'Jenis Agensi',1,1,'Agency Type',NULL,'jenisagensi'),(6,'Jenis Agensi',1,1,'Agency Type',NULL,'jenisagensi'),(7,'Jenis Agensi',1,1,'Agency Type',NULL,'jenisagensi'),(8,'No HP',1,1,'Phone Number',NULL,'nohp');

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

insert  into `institution_has_inputdetail_penempatan`(`idinstitution`,`idinputdetail_penempatan`,`isactive`) values (2,1,'1');

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

insert  into `institution_has_klasifikasi`(`id`,`idinstitution`,`isactive`) values (1,2,1);

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
  PRIMARY KEY (`idjenispekerjaan`),
  KEY `fk_jenispekerjaan_institution1_idx` (`idinstitution`),
  CONSTRAINT `fk_jenispekerjaan_institution1` FOREIGN KEY (`idinstitution`) REFERENCES `institution` (`idinstitution`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `jenispekerjaan` */

insert  into `jenispekerjaan`(`idjenispekerjaan`,`namajenispekerjaan`,`isactive`,`idpekerjaan_bnp2tki`,`idinstitution`,`sektor`) values (1,'Perawat','1',NULL,2,2);

/*Table structure for table `klasifikasi` */

DROP TABLE IF EXISTS `klasifikasi`;

CREATE TABLE `klasifikasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `klasifikasi` */

insert  into `klasifikasi`(`id`,`name`) values (1,'Gaji');

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

/*Table structure for table `level` */

DROP TABLE IF EXISTS `level`;

CREATE TABLE `level` (
  `idlevel` int(11) NOT NULL AUTO_INCREMENT,
  `levelname` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idlevel`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `level` */

insert  into `level`(`idlevel`,`levelname`) values (1,'SAdmin'),(2,'LAdmin'),(3,'Agensi');

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

insert  into `level_has_privilegedetail`(`idlevel`,`idprivilege`) values (1,1),(1,2),(1,3),(1,4),(1,5),(1,6),(1,7),(1,8),(1,9),(1,10),(1,11),(1,12),(1,13),(1,14),(1,15),(1,16),(1,17),(1,18),(1,19),(1,20),(1,21),(1,22),(1,23),(1,24),(1,25),(1,26),(2,3),(2,4),(2,5),(2,6),(2,7),(2,17),(2,18),(2,19),(2,20),(2,21),(2,22),(2,23),(2,24),(2,25),(2,26),(3,27),(3,28),(1,29),(1,30),(1,31),(2,29),(2,30),(2,31),(3,32),(1,33),(1,34),(1,35),(2,33),(2,34),(2,35),(1,36),(1,37),(1,38),(1,39),(1,41),(2,38),(2,39),(3,38),(3,43),(3,44),(3,45),(3,46);

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
  `agenable` decimal(1,0) DEFAULT '1',
  `agtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`agid`),
  UNIQUE KEY `username` (`username`),
  KEY `magensi_username` (`username`),
  KEY `fk_institution` (`idinstitution`),
  CONSTRAINT `fk_institution` FOREIGN KEY (`idinstitution`) REFERENCES `institution` (`idinstitution`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_relationship_31` FOREIGN KEY (`username`) REFERENCES `user` (`username`),
  CONSTRAINT `magensi_username` FOREIGN KEY (`username`) REFERENCES `user` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `magensi` */

insert  into `magensi`(`agid`,`username`,`agnama`,`idinstitution`,`agnamaoth`,`agnoijincla`,`agalmtkantor`,`agalmtkantoroth`,`agpngjwb`,`agpngjwboth`,`agtelp`,`agfax`,`agenable`,`agtimestamp`) values (1,'gian','Agensi Taichung',1,'cung gi wa','123','123','213','123','123','213','123','1','2016-12-14 14:21:25');

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
  PRIMARY KEY (`idmasalah`),
  KEY `fk_masalah_institution1_idx` (`idinstitution`),
  KEY `fk_masalah_klasifikasi1_idx` (`idklasifikasi`),
  KEY `fk_masalah_media1_idx` (`idmedia`),
  KEY `fk_masalah_jenispekerjaan1_idx` (`idjenispekerjaan`),
  KEY `fk_masalah_wilayah1_idx` (`idwilayah`),
  KEY `fk_masalah_shelter1_idx` (`idshelter`)
) ENGINE=MyISAM AUTO_INCREMENT=3489 DEFAULT CHARSET=utf8;

/*Data for the table `masalah` */

insert  into `masalah`(`idmasalah`,`idinstitution`,`nomormasalah`,`idmedia`,`idklasifikasi`,`idjenispekerjaan`,`idwilayah`,`namapelapor`,`teleponpelapor`,`alamatpelapor`,`tanggalpengaduan`,`penerimapengaduan`,`petugaspenanganan`,`tanggalmasuktaiwan`,`agensi`,`cpagensi`,`teleponagensi`,`pptkis`,`majikan`,`statustki`,`permasalahan`,`tuntutan`,`uang`,`statusmasalah`,`tanggalpenyelesaian`,`isinshelter`,`idshelter`,`tanggalmasukshelter`,`tanggalkeluarshelter`,`ppkode`,`agid`,`enable`,`pulang`,`keyword`,`last_update`,`deaddate`,`Gendertype`) values (3488,2,'1/ADU/KDEI/I/2014 1.2014',1,1,1,1,'Gian',NULL,NULL,'2016-11-18','-','agent','0000-00-00','-','-','-','-','-',1,'TKI illegal, menderita infeksi paru2 serta gangguan pernafasan. 17 Okt -19 Nop 2013 dirawat di ruang ICU.','Tuntutan pengobatan dan pemulangan','1221321',1,'0000-00-00',1,1,'2016-11-19','0000-00-00','0',0,1,0,'sakit','2016-11-19 14:34:16',NULL,NULL);

/*Table structure for table `masalah_has_shelter` */

DROP TABLE IF EXISTS `masalah_has_shelter`;

CREATE TABLE `masalah_has_shelter` (
  `idmasalah` int(11) NOT NULL,
  `idshelter` int(11) NOT NULL,
  `tanggalmasukshelter` date DEFAULT NULL,
  `tanggalkeluarshelter` date DEFAULT NULL,
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

insert  into `mpptkis`(`ppkode`,`ppnama`,`ppalmtkantor`,`pptelp`,`ppfax`,`ppijin`,`pppngjwb`,`ppstatus`,`ppkota`,`pppropinsi`,`ppenable`,`pptimestamp`) values ('1','1','1','1','1','1','1','1','1','1','1','2016-12-02 14:22:42'),('123','123','213','123','213','213','123','1','123',NULL,'1','2016-12-02 00:05:01');

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
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;

/*Data for the table `privilegedetail` */

insert  into `privilegedetail`(`idprivilege`,`menuname`,`pageurl`,`idprivilegegroup`) values (1,'Lihat Institution','institution',1),(2,'Tambah Institution','institution/add',1),(3,'Lihat Classification','classification',2),(4,'Tambah Classification','classification/add',2),(5,'Assign Classification','classification/assign',2),(6,'Lihat Job Type','jobtype',3),(7,'Tambah Job Type','jobtype/add',3),(8,'Lihat Master Privilege Group','privilege/viewMPG',4),(9,'Tambah Master Privilege Group','privilege/addMPG',4),(10,'Lihat Privilege Group','privilege/viewPG',5),(11,'Tambah Privilege Group','privilege/addPG',5),(12,'Lihat Detail Privilege','privilege/viewDP',6),(13,'Tambah Detail Privilege','privilege/addDP',6),(14,'Lihat Level','level',7),(15,'Tambah Level','level/add',7),(16,'Assign Level','level/assign',7),(17,'Lihat User','user',8),(18,'Tambah User','user/add',8),(19,'Lihat Tipe Input','inputtype',9),(20,'Tambah Tipe Input','inputtype/add',9),(21,'Tambah Kategori','category/addpenempatan',10),(22,'Tambah Detil Input','input/addpenempatan',10),(23,'Assign Input','input/assignpenempatan',10),(24,'Tambah Kategori','category/addperlindungan',11),(25,'Tambah Detil Input','input/addperlindungan',11),(26,'Assign Input','input/assignperlindungan',11),(27,'Hunian Shelter','shelter',12),(28,'Pencarian Kasus','kasus/search',13),(29,'Lihat Media','media',14),(30,'Tambah Media','media/add',14),(31,'Assign Media','media/assign',14),(32,'Pencarian Data TKI','datatki/search',15),(33,'Lihat Wilayah','wilayah',16),(34,'Tambah Wilayah','wilayah/add',16),(35,'Assign Wilayah','wilayah/assign',16),(36,'Lihat Currency','currency',17),(37,'Tambah Currency','currency/add',17),(38,'Lihat Agensi & PPTKIS','agensipptkis',18),(39,'Tambah Agensi','agensipptkis/addAgensi',18),(41,'Tambah PPTKIS','agensipptkis/addPPTKIS',18),(42,'Agensi & PPTKIS','agensipptkis',11),(43,'Infografik','infografik',11),(44,'Input Kasus Baru','kasus',11),(45,'Rekap Laporan','rekap',11),(46,'Log Aktivitas','log',11);

/*Table structure for table `privilegegroup` */

DROP TABLE IF EXISTS `privilegegroup`;

CREATE TABLE `privilegegroup` (
  `idprivilegegroup` int(11) NOT NULL AUTO_INCREMENT,
  `privilegegroupname` varchar(45) DEFAULT NULL,
  `masterprivilegegroupid` int(11) NOT NULL,
  PRIMARY KEY (`idprivilegegroup`),
  KEY `fk_privilegegroup_masterprivilegegroup1_idx` (`masterprivilegegroupid`),
  CONSTRAINT `fk_privilegegroup_masterprivilegegroup1` FOREIGN KEY (`masterprivilegegroupid`) REFERENCES `masterprivilegegroup` (`masterprivilegegroupid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

/*Data for the table `privilegegroup` */

insert  into `privilegegroup`(`idprivilegegroup`,`privilegegroupname`,`masterprivilegegroupid`) values (1,'Institusi',1),(2,'Klasifikasi',1),(3,'Tipe Pekerjaan',1),(4,'Master Privilege',1),(5,'Privilege Group',1),(6,'Detail Privilege',1),(7,'Level',1),(8,'User',1),(9,'Tipe Input',1),(10,'No Group',2),(11,'No Group',3),(12,'Kasus',3),(13,'Shelter',3),(14,'Media',1),(15,'Data TKI',3),(16,'Wilayah',1),(17,'Currency',1),(18,'Agensi & PPTKIS',1);

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

insert  into `shelter`(`id`,`name`,`isactive`,`idinstitution`) values (1,'Shelter Taichung','1',2),(2,'Shelter Taipei','1',2);

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
  KEY `fk_tkimasalah_masalah1_idx` (`idmasalah`)
) ENGINE=MyISAM AUTO_INCREMENT=7900 DEFAULT CHARSET=latin1;

/*Data for the table `tkimasalah` */

insert  into `tkimasalah`(`idtkimasalah`,`idmasalah`,`jk`,`namatki`,`paspor`,`arc`,`handphone`,`alamatindonesia`,`alamattaiwan`,`enable`,`tkiid`) values (7899,3488,'P','Siti Halimah','AN602601',NULL,'-','Jalan Diponegoro, Surabaya','Shen Cin Wu',1,NULL);

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `username` varchar(45) NOT NULL,
  `password` varchar(45) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `idinstitution` int(11) NOT NULL,
  `idlevel` int(11) NOT NULL,
  PRIMARY KEY (`username`),
  KEY `fk_user_institution1_idx` (`idinstitution`),
  KEY `fk_user_level1_idx` (`idlevel`),
  CONSTRAINT `fk_user_institution1` FOREIGN KEY (`idinstitution`) REFERENCES `institution` (`idinstitution`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_user_level1` FOREIGN KEY (`idlevel`) REFERENCES `level` (`idlevel`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `user` */

insert  into `user`(`username`,`password`,`name`,`idinstitution`,`idlevel`) values ('agent','b33aed8f3134996703dc39f9a7c95783','Agent',2,3),('gian','56ea9c664e8c9f1ad611cf8e5f1bb41c','Gian Sebastian',2,2),('sadmin','ba41b0eedddc9abaf3d1b55781c4a9c9','Superman',1,1);

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
