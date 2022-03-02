-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.1.43-community


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema ncir_krisanthium
--

CREATE DATABASE IF NOT EXISTS ncir_krisanthium;
USE ncir_krisanthium;

--
-- Definition of table `cir_correction_action`
--

DROP TABLE IF EXISTS `cir_correction_action`;
CREATE TABLE `cir_correction_action` (
  `idCA` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `codeCustCare` varchar(45) NOT NULL,
  `rootcause` text,
  `plannedAction` longtext,
  `deadline_plan` date DEFAULT NULL,
  `createdby` varchar(45) DEFAULT NULL,
  `createddate` datetime DEFAULT NULL,
  `changedby` varchar(45) DEFAULT NULL,
  `changeddate` datetime DEFAULT NULL,
  `idDepart` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`idCA`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cir_correction_action`
--

/*!40000 ALTER TABLE `cir_correction_action` DISABLE KEYS */;
INSERT INTO `cir_correction_action` (`idCA`,`codeCustCare`,`rootcause`,`plannedAction`,`deadline_plan`,`createdby`,`createddate`,`changedby`,`changeddate`,`idDepart`) VALUES 
 (1,'CIR-20190807-003','sdsdsd','sdsdsdsd','2019-08-14','suwarno','2019-08-13 09:31:21','suwarno','2019-08-13 09:31:21',5),
 (2,'CIR-20190812-001','dsdsddds878787878787878','dserrr5454545ffffffffffff','2019-09-09','wilarni','2019-09-04 09:44:50','wilarni','2019-09-04 09:55:23',5),
 (3,'CIR-20190807-001','fdfd','fdfdfdf','2019-09-07','suwarno','2019-09-04 10:12:17','suwarno','2019-09-04 10:12:17',5),
 (4,'CIR-20190904-001','Percobaan qc','Percobaan qc','2019-09-25','suwarno','2019-09-04 13:42:58','suwarno','2019-09-04 13:42:58',5),
 (5,'CIR-20190904-002','cetakan tercampuir','pemisahan cetakan barang bagus dan jelek','2019-09-09','suwarno','2019-09-04 16:46:34','suwarno','2019-09-04 16:46:34',5),
 (6,'CIR-20190906-001','rerer','eeerer','2019-11-12','suwarno','2019-11-11 09:34:17','suwarno','2019-11-11 09:34:17',6);
/*!40000 ALTER TABLE `cir_correction_action` ENABLE KEYS */;


--
-- Definition of table `cir_correction_imm`
--

DROP TABLE IF EXISTS `cir_correction_imm`;
CREATE TABLE `cir_correction_imm` (
  `idCirIm` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `codeCustCare` varchar(45) NOT NULL,
  `rootCause` text,
  `correctiveAct` text,
  `createdBy` varchar(45) DEFAULT NULL,
  `createdDate` datetime DEFAULT NULL,
  `changedBy` varchar(45) DEFAULT NULL,
  `changedDate` datetime DEFAULT NULL,
  `idDepart` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`idCirIm`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cir_correction_imm`
--

/*!40000 ALTER TABLE `cir_correction_imm` DISABLE KEYS */;
INSERT INTO `cir_correction_imm` (`idCirIm`,`codeCustCare`,`rootCause`,`correctiveAct`,`createdBy`,`createdDate`,`changedBy`,`changedDate`,`idDepart`) VALUES 
 (2,'CIR-20190807-003','hdshdsjk sdhsdhsd shdsjdhs dhskjdhs dshdkhskjd skdhskjdhkjs','hdshdsjk sdhsdhsd shdsjdhs dhskjdhs dshdkhskjd skdhskjdhkjs','sunawan','2019-08-09 15:45:36','sunawan','2019-08-09 15:45:36',6),
 (3,'CIR-20190807-003','cxcxcx','cxcxcxc','ewidiyanto','2019-08-13 11:50:59','ewidiyanto','2019-08-13 11:50:59',7),
 (4,'CIR-20190812-001','sdfdsfssdsdsdsdsdsd','dsfdsfsdf45454545454545','miarti','2019-09-04 09:08:18','miarti','2019-09-04 09:39:19',7),
 (7,'CIR-20190807-001','dfdsf','dsfsdfdf','sunawan','2019-09-04 10:10:44','sunawan','2019-09-04 10:10:44',6),
 (8,'CIR-20190904-001','Percobaan produksi','Percobaan produksi','sunawan','2019-09-04 13:43:16','sunawan','2019-09-04 13:43:16',6),
 (9,'CIR-20190904-002','cetakan tidak merah','akan disortir ulang','miarti','2019-09-04 16:43:34','miarti','2019-09-04 16:43:34',7),
 (10,'CIR-20190906-001','fhgfh','fghfhg','sunawan','2019-11-11 09:08:17','sunawan','2019-11-11 09:08:17',7);
/*!40000 ALTER TABLE `cir_correction_imm` ENABLE KEYS */;


--
-- Definition of table `cir_correction_type`
--

DROP TABLE IF EXISTS `cir_correction_type`;
CREATE TABLE `cir_correction_type` (
  `idType` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `codeCustCare` varchar(45) DEFAULT NULL,
  `jenis_koreksi` varchar(45) DEFAULT NULL,
  `CreatedBy` varchar(45) DEFAULT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  PRIMARY KEY (`idType`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cir_correction_type`
--

/*!40000 ALTER TABLE `cir_correction_type` DISABLE KEYS */;
INSERT INTO `cir_correction_type` (`idType`,`codeCustCare`,`jenis_koreksi`,`CreatedBy`,`CreatedDate`) VALUES 
 (3,'CIR-20190807-003','Sortir','sunawan','2019-08-09 15:45:36'),
 (4,'CIR-20190807-003','Reject','sunawan','2019-08-09 15:45:36'),
 (5,'CIR-20190807-003','Rework','ewidiyanto','2019-08-13 11:50:59'),
 (20,'CIR-20190812-001','Sortir','miarti','2019-09-04 09:39:19'),
 (21,'CIR-20190812-001','Reject','miarti','2019-09-04 09:39:19'),
 (22,'CIR-20190812-001','Rework','miarti','2019-09-04 09:39:19'),
 (23,'CIR-20190807-001','Segregation','sunawan','2019-09-04 10:10:44'),
 (24,'CIR-20190807-001','Konsesi','sunawan','2019-09-04 10:10:44'),
 (25,'CIR-20190904-001','Rework','sunawan','2019-09-04 13:43:16'),
 (26,'CIR-20190904-002','Sortir','miarti','2019-09-04 16:43:34'),
 (27,'CIR-20190906-001','Sortir','sunawan','2019-11-11 09:08:17'),
 (28,'CIR-20190906-001','Reject','sunawan','2019-11-11 09:08:17');
/*!40000 ALTER TABLE `cir_correction_type` ENABLE KEYS */;


--
-- Definition of table `cir_customer`
--

DROP TABLE IF EXISTS `cir_customer`;
CREATE TABLE `cir_customer` (
  `idCirCust` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `companyName` varchar(45) DEFAULT NULL,
  `customerInfo` text,
  `productName` text,
  `designCode` varchar(45) DEFAULT NULL COMMENT 'kode material di GID',
  `status` varchar(45) DEFAULT NULL,
  `jumKerusakan` int(11) DEFAULT NULL,
  `GID` varchar(45) DEFAULT NULL,
  `tgl_lapor` varchar(45) DEFAULT NULL,
  `codeCustCare` varchar(45) DEFAULT NULL,
  `info_via` text,
  `uploadFile` longtext,
  `jumKirim` int(11) DEFAULT NULL,
  `action` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idCirCust`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cir_customer`
--

/*!40000 ALTER TABLE `cir_customer` DISABLE KEYS */;
INSERT INTO `cir_customer` (`idCirCust`,`companyName`,`customerInfo`,`productName`,`designCode`,`status`,`jumKerusakan`,`GID`,`tgl_lapor`,`codeCustCare`,`info_via`,`uploadFile`,`jumKirim`,`action`) VALUES 
 (1,'dadad','adada','adadad','adad','Complaint',3,'asasa','2019-08-07 14:53:34','CIR-20190807-001','','4055969-147.jpg',123,'Forwarded'),
 (2,'asasasas','asasasas','asasas','asasasas','Complaint',33,'sasasa','2019-08-07 14:56:20','CIR-20190807-002','asasasas','13402_1465225805_edp.jpg',231,'Forwarded'),
 (3,'PT. Maha Mulia','asas','sas','adad','Complaint',232,'GID-190723-0007','2019-08-07 14:57:43','CIR-20190807-003','asas@gmail.com','13402_1465225805_edp.jpg',321,'Forwarded'),
 (4,'PT Khhjhj','adada','adadad','adad','Reject',21212,'asasa','2019-08-12 15:55:12','CIR-20190812-001','asas@gsgas.com','13402_1465225805_edp.jpg',0,'Forwarded'),
 (5,'PT. Unilever Indonesia Tbk','Email','Pepsodent Strong 12 Jam 75gr','TC.0021.0138','Complaint',10000,'GID-190903-0006','2019-09-04 13:21:13','CIR-20190904-001','a@unilever.com','gid.png',NULL,'Forwarded'),
 (6,'unilever','surabaya','pepsodent white 225 zaha','tc.0021.0124','Reject',50000,'gid-190903-0004','2019-09-04 16:37:36','CIR-20190904-002','ratna.astuty@krisanthium.com','footer.png',NULL,'Forwarded'),
 (7,'PT. Unilever Indonesia Tbk','adada','Pepsodent Strong 12 Jam 75gr','TC.0021.0138','Complaint',10000,'GID-190903-0006','2019-09-05 11:14:14','CIR-20190905-001','asas@gsgas.com','gid.png',NULL,'Forwarded'),
 (8,'PT. Unilever Indonesia Tbk','asasasas','Pepsodent Strong 12 Jam 75gr','TC.0021.0138','Reject',121222,'GID-190903-0006','2019-09-05 11:31:33','CIR-20190905-002','asas@gsgas.com','gid.png',NULL,'Forwarded'),
 (10,'PT. Unilever Indonesia Tbk','Email','Pepsodent Strong 12 Jam 75gr','TC.0021.0138','Complaint',12222,'GID-190903-0006','2019-09-06 09:49:39','CIR-20190906-001','ratna.astuty@krisanthium.com','World Bank logo (large).jpg',NULL,'Forwarded');
/*!40000 ALTER TABLE `cir_customer` ENABLE KEYS */;


--
-- Definition of table `cir_forward`
--

DROP TABLE IF EXISTS `cir_forward`;
CREATE TABLE `cir_forward` (
  `idCirF` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `codeCustCare` varchar(45) NOT NULL,
  `idDepart` int(10) unsigned DEFAULT NULL,
  `forwardBy` varchar(45) NOT NULL,
  `forwardAt` datetime NOT NULL,
  `approvedBy` varchar(45) NOT NULL,
  `approvedAt` datetime NOT NULL,
  `statusJawab` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idCirF`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1 COMMENT='FORWARD_APPROVED';

--
-- Dumping data for table `cir_forward`
--

/*!40000 ALTER TABLE `cir_forward` DISABLE KEYS */;
INSERT INTO `cir_forward` (`idCirF`,`codeCustCare`,`idDepart`,`forwardBy`,`forwardAt`,`approvedBy`,`approvedAt`,`statusJawab`) VALUES 
 (3,'CIR-20190807-003',7,'admin','2019-08-08 15:13:33','admin','2019-08-08 15:13:33',NULL),
 (4,'CIR-20190807-003',6,'admin','2019-08-08 15:13:33','admin','2019-08-08 15:13:33',NULL),
 (5,'CIR-20190807-003',5,'admin','2019-08-08 15:13:33','admin','2019-08-08 15:13:33',NULL),
 (8,'CIR-20190807-002',7,'admin','2019-08-08 16:49:32','admin','2019-08-08 16:49:32',NULL),
 (9,'CIR-20190807-002',5,'admin','2019-08-08 16:49:32','admin','2019-08-08 16:49:32',NULL),
 (10,'CIR-20190812-001',7,'nanggraini','2019-08-12 15:57:58','nanggraini','2019-08-12 15:57:58',NULL),
 (11,'CIR-20190812-001',5,'nanggraini','2019-08-12 15:57:58','nanggraini','2019-08-12 15:57:58',NULL),
 (12,'CIR-20190807-001',6,'admin','2019-08-21 17:39:10','admin','2019-08-21 17:39:10',NULL),
 (13,'CIR-20190807-001',5,'admin','2019-08-21 17:39:10','admin','2019-08-21 17:39:10',NULL),
 (14,'CIR-20190904-001',7,'ffitrotul','2019-09-04 13:23:42','ffitrotul','2019-09-04 13:23:42',NULL),
 (15,'CIR-20190904-001',6,'ffitrotul','2019-09-04 13:23:42','ffitrotul','2019-09-04 13:23:42',NULL),
 (16,'CIR-20190904-001',5,'ffitrotul','2019-09-04 13:23:42','ffitrotul','2019-09-04 13:23:42',NULL),
 (17,'CIR-20190904-002',7,'ffitrotul','2019-09-04 16:39:37','ffitrotul','2019-09-04 16:39:37',NULL),
 (18,'CIR-20190904-002',6,'ffitrotul','2019-09-04 16:39:37','ffitrotul','2019-09-04 16:39:37',NULL),
 (19,'CIR-20190904-002',5,'ffitrotul','2019-09-04 16:39:37','ffitrotul','2019-09-04 16:39:37',NULL),
 (20,'CIR-20190905-001',9,'ffitrotul','2019-09-05 11:29:01','ffitrotul','2019-09-05 11:29:01',NULL),
 (21,'CIR-20190905-001',10,'ffitrotul','2019-09-05 11:29:01','ffitrotul','2019-09-05 11:29:01',NULL),
 (22,'CIR-20190905-001',6,'ffitrotul','2019-09-05 11:29:01','ffitrotul','2019-09-05 11:29:01',NULL),
 (23,'CIR-20190905-002',4,'ffitrotul','2019-09-05 11:32:09','ffitrotul','2019-09-05 11:32:09',NULL),
 (24,'CIR-20190905-002',9,'ffitrotul','2019-09-05 11:32:09','ffitrotul','2019-09-05 11:32:09',NULL),
 (25,'CIR-20190905-002',6,'ffitrotul','2019-09-05 11:32:09','ffitrotul','2019-09-05 11:32:09',NULL),
 (26,'CIR-20190906-001',10,'admin','2019-11-11 09:00:41','admin','2019-11-11 09:00:41',NULL),
 (27,'CIR-20190906-001',7,'admin','2019-11-11 09:00:41','admin','2019-11-11 09:00:41',NULL),
 (28,'CIR-20190906-001',6,'admin','2019-11-11 09:00:41','admin','2019-11-11 09:00:41',NULL);
/*!40000 ALTER TABLE `cir_forward` ENABLE KEYS */;


--
-- Definition of table `cir_verifikasi`
--

DROP TABLE IF EXISTS `cir_verifikasi`;
CREATE TABLE `cir_verifikasi` (
  `idVer` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `codeCustCare` varchar(45) NOT NULL,
  `verifiedBy` varchar(45) NOT NULL,
  `verifiedDate` datetime NOT NULL,
  `statusKasus` varchar(45) NOT NULL,
  PRIMARY KEY (`idVer`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cir_verifikasi`
--

/*!40000 ALTER TABLE `cir_verifikasi` DISABLE KEYS */;
INSERT INTO `cir_verifikasi` (`idVer`,`codeCustCare`,`verifiedBy`,`verifiedDate`,`statusKasus`) VALUES 
 (3,'CIR-20190807-003','lfitri','2019-08-13 16:04:40','Closed'),
 (4,'CIR-20190812-001','lfitri','2019-09-04 10:01:27','Closed'),
 (5,'CIR-20190807-001','lfitri','2019-09-04 10:12:25','Closed'),
 (6,'CIR-20190904-001','lfitri','2019-09-04 13:54:48','Closed'),
 (8,'CIR-20190904-002','lfitri','2019-09-05 11:30:50','Closed');
/*!40000 ALTER TABLE `cir_verifikasi` ENABLE KEYS */;


--
-- Definition of table `departemen`
--

DROP TABLE IF EXISTS `departemen`;
CREATE TABLE `departemen` (
  `idDepart` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `departName` varchar(45) NOT NULL,
  `ketDepart` text,
  `idDepMain` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`idDepart`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departemen`
--

/*!40000 ALTER TABLE `departemen` DISABLE KEYS */;
INSERT INTO `departemen` (`idDepart`,`departName`,`ketDepart`,`idDepMain`) VALUES 
 (1,'EDP','IT',1),
 (2,'Finance','Finance',1),
 (3,'Purchasing','Purchasing',2),
 (4,'Marketing','Marketing',3),
 (6,'Quality','Quality',2),
 (7,'Produksi','Produksi',2),
 (8,'Cetak','Produksi',2),
 (9,'Plong','Produksi',2),
 (10,'PPIC','PPIC',3),
 (11,'PGA','PGA',1),
 (13,'Prepress','Produksi',2),
 (14,'Accounting','Accounting',1);
/*!40000 ALTER TABLE `departemen` ENABLE KEYS */;


--
-- Definition of table `departemenmain`
--

DROP TABLE IF EXISTS `departemenmain`;
CREATE TABLE `departemenmain` (
  `idDepMain` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `DepMain` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idDepMain`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departemenmain`
--

/*!40000 ALTER TABLE `departemenmain` DISABLE KEYS */;
INSERT INTO `departemenmain` (`idDepMain`,`DepMain`) VALUES 
 (1,'Finance'),
 (2,'Manufacture'),
 (3,'Marketing');
/*!40000 ALTER TABLE `departemenmain` ENABLE KEYS */;


--
-- Definition of table `departemenrole`
--

DROP TABLE IF EXISTS `departemenrole`;
CREATE TABLE `departemenrole` (
  `idDep` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `depName` varchar(45) NOT NULL,
  `ketDep` text,
  `idDepart` int(11) DEFAULT NULL,
  PRIMARY KEY (`idDep`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departemenrole`
--

/*!40000 ALTER TABLE `departemenrole` DISABLE KEYS */;
INSERT INTO `departemenrole` (`idDep`,`depName`,`ketDep`,`idDepart`) VALUES 
 (1,'QCCHIEF','Quality Control Chief',6),
 (2,'QCKARY','Quality Control Staff/Karyawan',6),
 (3,'PRODCHIEF','Produksi Chief',7),
 (4,'PRODKARY','Produksi Staff/Karyawan',7),
 (5,'ADMINISTRATOR','Administrator',1),
 (6,'CETAKKARY','Cetak Produksi',8),
 (7,'QCMGR','Manager Quality',6),
 (8,'MKTCHIEF','Marketing Chief',4),
 (9,'MKTKARY','Marketing Karyawan',4),
 (10,'PPICCHIEF','PPIC Chief',10),
 (11,'PPICKARY','',10),
 (12,'PURCCHIEF','PURCHASING CHIEF',3),
 (13,'PURCKARY','PURCHASING KARYAWAN',3),
 (14,'EDPCHIEF','EDP CHIEF',1),
 (15,'FINCHIEF','FINANCE CHIEF',2),
 (16,'PGACHIEF','PGA CHIEF',11),
 (17,'PGAKARY','PGA KARYAWAN',11),
 (18,'ACCCHIEF','Accounting Chief',14),
 (19,'ACCKARY','Accounting Karyawan',14),
 (20,'MKTMGR','Marketing Manager',4),
 (21,'FINMGR','FINANCE MGR',1),
 (22,'PRODMGR','Manager Produksi',7);
/*!40000 ALTER TABLE `departemenrole` ENABLE KEYS */;


--
-- Definition of table `mdokumen`
--

DROP TABLE IF EXISTS `mdokumen`;
CREATE TABLE `mdokumen` (
  `idDok` varchar(46) NOT NULL,
  `judulDokumen` text,
  `createdByDok` varchar(45) DEFAULT NULL,
  `createdDateDok` datetime DEFAULT NULL,
  `changedByDok` varchar(45) DEFAULT NULL,
  `changedDateDok` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idDok`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mdokumen`
--

/*!40000 ALTER TABLE `mdokumen` DISABLE KEYS */;
INSERT INTO `mdokumen` (`idDok`,`judulDokumen`,`createdByDok`,`createdDateDok`,`changedByDok`,`changedDateDok`) VALUES 
 ('1','QI.89-122.999.001','admin','2019-05-24 12:00:00','admin','2019-05-24 12:00:00');
/*!40000 ALTER TABLE `mdokumen` ENABLE KEYS */;


--
-- Definition of table `menu`
--

DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `idMenu` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `menuName` varchar(205) NOT NULL,
  `linkMenu` text NOT NULL,
  `main` varchar(45) NOT NULL,
  PRIMARY KEY (`idMenu`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` (`idMenu`,`menuName`,`linkMenu`,`main`) VALUES 
 (11,'Non Conformance IR','','transaction'),
 (12,'Non Conformance AR','','transaction'),
 (13,'Non Conformance R','','transaction'),
 (14,'Customer Information R','','transaction'),
 (15,'Non Conformance IR','page.php?n=rpncir','report'),
 (16,'Non Conformance AR','page.php?n=rpncar','report'),
 (17,'Non Conformance R','page.php?n=rpncr','report'),
 (18,'Customer Information R','page.php?n=rpcir','report');
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;


--
-- Definition of table `menugroup1`
--

DROP TABLE IF EXISTS `menugroup1`;
CREATE TABLE `menugroup1` (
  `idSubMenu` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idMenu` int(10) unsigned NOT NULL,
  `subMenu` varchar(45) NOT NULL,
  `link` text NOT NULL,
  PRIMARY KEY (`idSubMenu`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menugroup1`
--

/*!40000 ALTER TABLE `menugroup1` DISABLE KEYS */;
INSERT INTO `menugroup1` (`idSubMenu`,`idMenu`,`subMenu`,`link`) VALUES 
 (1,11,'Inspection','page.php?n=input-ncir'),
 (2,11,'Correction','page.php?n=list-ncir'),
 (3,12,'Incompatibility','page.php?n=input-ncar'),
 (4,12,'Correction','page.php?n=list-ncar'),
 (5,13,'Incompatibility','page.php?n=input-ncr'),
 (6,13,'Correction','page.php?n=list-ncr'),
 (7,14,'Compliment','page.php?n=list-cir'),
 (8,14,'Correction','page.php?n=forward-cir');
/*!40000 ALTER TABLE `menugroup1` ENABLE KEYS */;


--
-- Definition of table `menugroup2`
--

DROP TABLE IF EXISTS `menugroup2`;
CREATE TABLE `menugroup2` (
  `idSubmenu2` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idSubMenu` int(10) unsigned NOT NULL,
  `subMenu2` varchar(45) NOT NULL,
  PRIMARY KEY (`idSubmenu2`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menugroup2`
--

/*!40000 ALTER TABLE `menugroup2` DISABLE KEYS */;
/*!40000 ALTER TABLE `menugroup2` ENABLE KEYS */;


--
-- Definition of table `menurole`
--

DROP TABLE IF EXISTS `menurole`;
CREATE TABLE `menurole` (
  `idmrole` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idDep` int(10) unsigned NOT NULL,
  `idMenu` int(10) unsigned NOT NULL,
  `ChangedBy` varchar(45) NOT NULL,
  `ChangedDate` datetime NOT NULL,
  PRIMARY KEY (`idmrole`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menurole`
--

/*!40000 ALTER TABLE `menurole` DISABLE KEYS */;
INSERT INTO `menurole` (`idmrole`,`idDep`,`idMenu`,`ChangedBy`,`ChangedDate`) VALUES 
 (1,1,1,'admin','2019-05-02 00:00:00'),
 (2,2,1,'admin','2019-05-02 00:00:00');
/*!40000 ALTER TABLE `menurole` ENABLE KEYS */;


--
-- Definition of table `menusubrole`
--

DROP TABLE IF EXISTS `menusubrole`;
CREATE TABLE `menusubrole` (
  `idmsrole` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idMenu` int(10) unsigned DEFAULT NULL,
  `idSubMenu` int(10) unsigned DEFAULT NULL,
  `idDep` int(10) unsigned DEFAULT NULL,
  `ChangedBy` varchar(45) DEFAULT NULL,
  `ChangedDate` date DEFAULT NULL,
  PRIMARY KEY (`idmsrole`)
) ENGINE=InnoDB AUTO_INCREMENT=254 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menusubrole`
--

/*!40000 ALTER TABLE `menusubrole` DISABLE KEYS */;
INSERT INTO `menusubrole` (`idmsrole`,`idMenu`,`idSubMenu`,`idDep`,`ChangedBy`,`ChangedDate`) VALUES 
 (1,11,1,1,'admin','2019-05-02'),
 (2,11,1,2,'admin','2019-05-02'),
 (3,11,1,5,'admin','2019-05-02'),
 (4,11,2,5,'admin','2019-05-02'),
 (5,12,3,5,'admin','2019-05-02'),
 (6,12,4,5,'admin','2019-05-02'),
 (7,13,5,5,'admin','2019-05-02'),
 (8,13,6,5,'admin','2019-05-02'),
 (9,14,7,5,'admin','2019-05-02'),
 (10,14,8,5,'admin','2019-05-02'),
 (11,15,NULL,1,'admin','2019-05-02'),
 (12,15,NULL,2,'admin','2019-05-02'),
 (13,11,2,3,'admin','2019-05-02'),
 (16,11,2,2,'admin','2019-05-02'),
 (17,11,2,1,'admin','2019-05-02'),
 (18,11,2,4,'admin','2019-05-02'),
 (19,15,NULL,4,'admin','2019-05-02'),
 (20,15,NULL,5,'admin','2019-05-02'),
 (22,17,NULL,5,'admin','2019-05-02'),
 (23,18,NULL,5,'admin','2019-05-02'),
 (25,14,8,1,'admin','2019-05-02'),
 (27,14,8,3,'admin','2019-05-02'),
 (28,14,7,8,'admin','2019-05-02'),
 (29,14,7,9,'admin','2019-05-02'),
 (30,14,8,8,'admin','2019-05-02'),
 (31,14,8,9,'admin','2019-05-02'),
 (32,18,NULL,8,'admin','2019-05-02'),
 (33,18,NULL,9,'admin','2019-05-02'),
 (34,14,8,10,'admin','2019-05-02'),
 (35,14,8,11,'admin','2019-05-02'),
 (36,18,NULL,10,'admin','2019-05-02'),
 (37,18,NULL,11,'admin','2019-05-02'),
 (38,14,8,2,'admin','2019-05-02'),
 (39,18,NULL,2,'admin','2019-05-02'),
 (40,18,NULL,1,'admin','2019-05-02'),
 (42,18,NULL,7,'admin','2019-05-02'),
 (43,13,5,1,'admin','2019-05-02'),
 (44,13,6,1,'admin','2019-05-02'),
 (45,17,NULL,1,'admin','2019-05-02'),
 (46,13,5,8,'admin','2019-05-02'),
 (47,13,6,8,'admin','2019-05-02'),
 (77,11,1,0,'admin','2019-08-29'),
 (78,11,2,0,'admin','2019-08-29'),
 (79,11,1,7,'admin','2019-08-29'),
 (80,11,2,7,'admin','2019-08-29'),
 (81,12,3,7,'admin','2019-08-29'),
 (82,12,4,7,'admin','2019-08-29'),
 (83,13,5,7,'admin','2019-08-29'),
 (108,13,6,7,'admin','2019-08-29'),
 (109,14,7,7,'admin','2019-08-29'),
 (112,15,NULL,7,'admin','2019-08-30'),
 (113,16,NULL,7,'admin','2019-08-30'),
 (114,12,3,3,'admin','2019-08-30'),
 (115,12,4,3,'admin','2019-08-30'),
 (116,15,NULL,3,'admin','2019-08-30'),
 (117,16,NULL,3,'admin','2019-08-30'),
 (119,17,NULL,3,'admin','2019-08-30'),
 (121,12,3,2,'admin','2019-08-30'),
 (122,12,4,2,'admin','2019-08-30'),
 (123,16,NULL,2,'admin','2019-08-30'),
 (124,17,NULL,2,'admin','2019-08-30'),
 (128,13,5,2,'admin','2019-08-30'),
 (129,13,6,2,'admin','2019-08-30'),
 (132,16,NULL,5,'admin','2019-08-30'),
 (133,14,8,7,'admin','2019-09-04'),
 (134,18,NULL,3,'admin','2019-09-04'),
 (135,12,3,1,'admin','2019-09-04'),
 (136,12,4,1,'admin','2019-09-04'),
 (137,16,NULL,1,'admin','2019-09-04'),
 (138,12,3,8,'admin','2019-09-04'),
 (139,12,4,8,'admin','2019-09-04'),
 (140,12,3,11,'admin','2019-09-04'),
 (141,12,4,11,'admin','2019-09-04'),
 (142,16,NULL,11,'admin','2019-09-04'),
 (144,11,2,20,'admin','2019-09-05'),
 (145,12,3,20,'admin','2019-09-05'),
 (146,12,4,20,'admin','2019-09-05'),
 (147,13,5,20,'admin','2019-09-05'),
 (148,13,6,20,'admin','2019-09-05'),
 (149,14,7,20,'admin','2019-09-05'),
 (150,14,8,20,'admin','2019-09-05'),
 (151,15,NULL,0,'admin','2019-09-05'),
 (152,16,NULL,0,'admin','2019-09-05'),
 (153,17,NULL,0,'admin','2019-09-05'),
 (154,18,NULL,0,'admin','2019-09-05'),
 (155,18,NULL,20,'admin','2019-09-05'),
 (156,15,NULL,20,'admin','2019-09-05'),
 (157,16,NULL,20,'admin','2019-09-05'),
 (158,17,NULL,20,'admin','2019-09-05'),
 (160,11,2,18,'admin','2019-09-05'),
 (161,12,3,18,'admin','2019-09-05'),
 (162,12,4,18,'admin','2019-09-05'),
 (163,13,5,18,'admin','2019-09-05'),
 (164,13,6,18,'admin','2019-09-05'),
 (166,14,8,18,'admin','2019-09-05'),
 (167,15,NULL,18,'admin','2019-09-05'),
 (168,16,NULL,18,'admin','2019-09-05'),
 (169,17,NULL,18,'admin','2019-09-05'),
 (170,18,NULL,18,'admin','2019-09-05'),
 (172,11,2,15,'admin','2019-09-05'),
 (173,12,3,15,'admin','2019-09-05'),
 (174,12,4,15,'admin','2019-09-05'),
 (175,13,5,15,'admin','2019-09-05'),
 (176,13,6,15,'admin','2019-09-05'),
 (178,14,8,15,'admin','2019-09-05'),
 (179,15,NULL,15,'admin','2019-09-05'),
 (180,16,NULL,15,'admin','2019-09-05'),
 (181,17,NULL,15,'admin','2019-09-05'),
 (182,18,NULL,15,'admin','2019-09-05'),
 (184,11,2,21,'ssetyabudi','2019-09-05'),
 (185,12,3,21,'ssetyabudi','2019-09-05'),
 (186,12,4,21,'ssetyabudi','2019-09-05'),
 (187,13,5,21,'ssetyabudi','2019-09-05'),
 (188,13,6,21,'ssetyabudi','2019-09-05'),
 (189,14,7,21,'ssetyabudi','2019-09-05'),
 (190,14,8,21,'ssetyabudi','2019-09-05'),
 (191,15,NULL,21,'ssetyabudi','2019-09-05'),
 (192,16,NULL,21,'ssetyabudi','2019-09-05'),
 (193,17,NULL,21,'ssetyabudi','2019-09-05'),
 (194,18,NULL,21,'ssetyabudi','2019-09-05'),
 (195,13,5,3,'admin','2019-09-05'),
 (196,13,6,3,'admin','2019-09-05'),
 (197,11,2,14,'admin','2019-09-05'),
 (198,12,3,14,'admin','2019-09-05'),
 (199,12,4,14,'admin','2019-09-05'),
 (200,13,5,14,'admin','2019-09-05'),
 (201,13,6,14,'admin','2019-09-05'),
 (202,14,8,14,'admin','2019-09-05'),
 (203,15,NULL,14,'admin','2019-09-05'),
 (204,16,NULL,14,'admin','2019-09-05'),
 (205,17,NULL,14,'admin','2019-09-05'),
 (206,18,NULL,14,'admin','2019-09-05'),
 (207,11,2,8,'admin','2019-09-05'),
 (208,15,NULL,8,'admin','2019-09-05'),
 (209,16,NULL,8,'admin','2019-09-05'),
 (210,17,NULL,8,'admin','2019-09-05'),
 (211,11,2,16,'admin','2019-09-05'),
 (212,12,3,16,'admin','2019-09-05'),
 (213,12,4,16,'admin','2019-09-05'),
 (214,13,5,16,'admin','2019-09-05'),
 (215,13,6,16,'admin','2019-09-05'),
 (216,14,8,16,'admin','2019-09-05'),
 (217,15,NULL,16,'admin','2019-09-05'),
 (218,16,NULL,16,'admin','2019-09-05'),
 (219,17,NULL,16,'admin','2019-09-05'),
 (220,18,NULL,16,'admin','2019-09-05'),
 (221,11,2,10,'admin','2019-09-05'),
 (222,12,3,10,'admin','2019-09-05'),
 (223,12,4,10,'admin','2019-09-05'),
 (224,13,5,10,'admin','2019-09-05'),
 (225,13,6,10,'admin','2019-09-05'),
 (226,15,NULL,10,'admin','2019-09-05'),
 (227,16,NULL,10,'admin','2019-09-05'),
 (228,17,NULL,10,'admin','2019-09-05'),
 (229,11,2,12,'admin','2019-09-05'),
 (230,12,3,12,'admin','2019-09-05'),
 (231,12,4,12,'admin','2019-09-05'),
 (232,13,5,12,'admin','2019-09-05'),
 (233,13,6,12,'admin','2019-09-05'),
 (234,14,8,12,'admin','2019-09-05'),
 (235,15,NULL,12,'admin','2019-09-05'),
 (236,16,NULL,12,'admin','2019-09-05'),
 (237,17,NULL,12,'admin','2019-09-05'),
 (238,18,NULL,12,'admin','2019-09-05'),
 (239,11,2,6,'admin','2019-09-05'),
 (240,13,5,6,'admin','2019-09-05'),
 (241,13,6,6,'admin','2019-09-05'),
 (242,15,NULL,6,'admin','2019-09-05'),
 (243,11,1,22,'admin','2019-09-11'),
 (244,11,2,22,'admin','2019-09-11'),
 (245,12,3,22,'admin','2019-09-11'),
 (246,12,4,22,'admin','2019-09-11'),
 (247,13,5,22,'admin','2019-09-11'),
 (248,13,6,22,'admin','2019-09-11'),
 (249,14,8,22,'admin','2019-09-11'),
 (250,15,NULL,22,'admin','2019-09-11'),
 (251,16,NULL,22,'admin','2019-09-11'),
 (252,17,NULL,22,'admin','2019-09-11'),
 (253,18,NULL,22,'admin','2019-09-11');
/*!40000 ALTER TABLE `menusubrole` ENABLE KEYS */;


--
-- Definition of table `mjeniskoreksi`
--

DROP TABLE IF EXISTS `mjeniskoreksi`;
CREATE TABLE `mjeniskoreksi` (
  `idKoreksi` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `jenisKoreksi` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idKoreksi`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mjeniskoreksi`
--

/*!40000 ALTER TABLE `mjeniskoreksi` DISABLE KEYS */;
INSERT INTO `mjeniskoreksi` (`idKoreksi`,`jenisKoreksi`) VALUES 
 (1,'Sortir'),
 (2,'Reject'),
 (3,'Rework'),
 (4,'Segregation'),
 (5,'Konsesi'),
 (6,'Pembuatan Dok.'),
 (7,'Revisi'),
 (8,'Training');
/*!40000 ALTER TABLE `mjeniskoreksi` ENABLE KEYS */;


--
-- Definition of table `msetting`
--

DROP TABLE IF EXISTS `msetting`;
CREATE TABLE `msetting` (
  `idSetting` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name_set` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idSetting`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `msetting`
--

/*!40000 ALTER TABLE `msetting` DISABLE KEYS */;
INSERT INTO `msetting` (`idSetting`,`name_set`) VALUES 
 (4,'ApproveNCIRCorrection'),
 (5,'ApproveNCIRInspection'),
 (6,'ButtonCorrectionNCIR'),
 (7,'PrintNCIR'),
 (8,'FullReportNCIR'),
 (9,'ButtonCIRCorrection'),
 (10,'ApproveStatusCIR'),
 (11,'FullReportCIR'),
 (12,'ButtonReplyDeptCIR'),
 (13,'PrintCIR'),
 (14,'MailToCIR'),
 (15,'ApproveNCRInspection'),
 (16,'ApproveNCRCorrection'),
 (17,'ButtonCorrectionNCR'),
 (18,'PrintNCR'),
 (25,'ApproveNCARInspection'),
 (26,'ButtonCorrectionNCAR'),
 (27,'FullReportNCR');
/*!40000 ALTER TABLE `msetting` ENABLE KEYS */;


--
-- Definition of table `msetting_value`
--

DROP TABLE IF EXISTS `msetting_value`;
CREATE TABLE `msetting_value` (
  `idValue` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idSetting` int(10) unsigned DEFAULT NULL,
  `value_set` text,
  PRIMARY KEY (`idValue`)
) ENGINE=InnoDB AUTO_INCREMENT=129 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `msetting_value`
--

/*!40000 ALTER TABLE `msetting_value` DISABLE KEYS */;
INSERT INTO `msetting_value` (`idValue`,`idSetting`,`value_set`) VALUES 
 (4,4,'PRODCHIEF'),
 (6,5,'QCCHIEF'),
 (7,6,'PRODCHIEF'),
 (9,6,'ADMINISTRATOR'),
 (12,6,'PRODKARY'),
 (13,7,'QCKARY'),
 (14,7,'QCCHIEF'),
 (15,7,'ADMINISTRATOR'),
 (16,8,'QCCHIEF'),
 (17,8,'QCKARY'),
 (18,8,'ADMINISTRATOR'),
 (19,5,'ADMINISTRATOR'),
 (20,9,'QCCHIEF'),
 (21,9,'QCKARY'),
 (24,9,'ADMINISTRATOR'),
 (25,10,'QCMGR'),
 (26,11,'ADMINISTRATOR'),
 (27,11,'MKTCHIEF'),
 (28,11,'MKTKARY'),
 (29,12,'ADMINISTRATOR'),
 (30,12,'MKTCHIEF'),
 (31,12,'MKTKARY'),
 (32,11,'QCCHIEF'),
 (33,11,'QCKARY'),
 (34,12,'QCCHIEF'),
 (35,12,'QCKARY'),
 (36,12,'QCMGR'),
 (37,9,'QCMGR'),
 (38,13,'QCMGR'),
 (39,13,'QCCHIEF'),
 (40,13,'QCKARY'),
 (41,13,'ADMINISTRATOR'),
 (42,14,'MKTCHIEF'),
 (43,14,'MKTKARY'),
 (44,13,'MKTCHIEF'),
 (45,13,'MKTKARY'),
 (46,16,'ADMINISTRATOR'),
 (47,15,'ADMINISTRATOR'),
 (48,17,'ADMINISTRATOR'),
 (49,18,'ADMINISTRATOR'),
 (50,17,'MKTCHIEF'),
 (51,15,'MKTCHIEF'),
 (52,18,'MKTCHIEF'),
 (53,22,'ADMINISTRATOR'),
 (54,21,'ADMINISTRATOR'),
 (55,20,'ADMINISTRATOR'),
 (56,25,'ADMINISTRATOR'),
 (57,25,'QCMGR'),
 (60,26,'ADMINISTRATOR'),
 (61,27,'ADMINISTRATOR'),
 (62,17,'QCKARY'),
 (64,26,'QCCHIEF'),
 (65,26,'QCMGR'),
 (66,4,'QCCHIEF'),
 (67,4,'QCMGR'),
 (68,6,'QCKARY'),
 (69,6,'QCCHIEF'),
 (70,13,'MKTMGR'),
 (71,12,'MKTMGR'),
 (72,11,'MKTMGR'),
 (73,14,'MKTMGR'),
 (74,25,'MKTMGR'),
 (75,26,'MKTMGR'),
 (76,26,'MKTCHIEF'),
 (77,26,'MKTKARY'),
 (78,26,'ACCCHIEF'),
 (79,26,'ACCKARY'),
 (80,26,'PRODCHIEF'),
 (81,25,'FINMGR'),
 (82,26,'FINMGR'),
 (84,16,'MKTMGR'),
 (85,16,'FINMGR'),
 (86,16,'QCMGR'),
 (87,15,'QCMGR'),
 (88,15,'FINMGR'),
 (89,15,'MKTMGR'),
 (90,17,'MKTMGR'),
 (93,27,'QCMGR'),
 (94,17,'PRODCHIEF'),
 (95,15,'PRODCHIEF'),
 (96,15,'PPICCHIEF'),
 (97,15,'FINCHIEF'),
 (98,16,'PRODCHIEF'),
 (99,16,'PPICCHIEF'),
 (100,18,'PRODCHIEF'),
 (101,18,'PPICCHIEF'),
 (102,18,'FINCHIEF'),
 (103,18,'EDPCHIEF'),
 (104,18,'MKTMGR'),
 (105,18,'QCMGR'),
 (106,18,'FINMGR'),
 (108,17,'EDPCHIEF'),
 (110,16,'EDPCHIEF'),
 (111,15,'EDPCHIEF'),
 (112,16,'QCKARY'),
 (113,18,'QCKARY'),
 (114,15,'QCKARY'),
 (116,6,'CETAKKARY'),
 (121,25,'QCKARY'),
 (122,25,'PRODMGR'),
 (123,15,'PRODMGR'),
 (124,16,'PRODMGR'),
 (125,26,'PRODMGR'),
 (126,6,'PRODMGR'),
 (127,17,'PRODMGR'),
 (128,18,'PRODMGR');
/*!40000 ALTER TABLE `msetting_value` ENABLE KEYS */;


--
-- Definition of table `muser`
--

DROP TABLE IF EXISTS `muser`;
CREATE TABLE `muser` (
  `idUser` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fullName` varchar(45) DEFAULT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `level` varchar(45) NOT NULL,
  `email` varchar(45) DEFAULT NULL,
  `idDep` int(10) unsigned NOT NULL,
  `jabatan` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idUser`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `muser`
--

/*!40000 ALTER TABLE `muser` DISABLE KEYS */;
INSERT INTO `muser` (`idUser`,`fullName`,`username`,`password`,`level`,`email`,`idDep`,`jabatan`) VALUES 
 (1,'Administrator','admin','S3mangat!','admin','admin@krisanthium.com',5,'Superadmin'),
 (2,'Wildan Nasrullah','wnasrullah','Wil-123','admin','wildan.nasrullah@krisanthium.com',14,'Non Manager'),
 (3,'Ratna Yani Astuti','rastuty','Rat-123','admin','ratna.astuty@krisanthium.com',5,'Non Manager'),
 (4,'Sugiharto Setyabudi','ssetyabudi','Sug-123','admin','sugiharto.setyabudi@krisanthium.com',21,'Manager'),
 (5,'Suwarno','suwarno','Suw-123','user','suwarno@krisanthium.com',1,'Non Manager'),
 (7,'Sunawan','sunawan','Sun-123','user','sunawan@krisanthium.com',3,'Non Manager'),
 (8,'Suud Wahyono','swahyono','Suu-123','user','',4,'Non Manager'),
 (10,'Lukas Ari W','lwibowo','Luk-123','user','',2,'Non Manager'),
 (12,'PH Lorein Fitri','lfitri','Lor-123','user','',7,'Manager'),
 (13,'Nisa Anggraini','nanggraini','Nis-123','user','',8,'Non Manager'),
 (14,'Fita Fitrotul','ffitrotul','Fit-123','user','',9,'Non Manager'),
 (15,'Eko Widiyanto','ewidiyanto','Eko-123','user','',10,'Non Manager'),
 (16,'Wilarni','wilarni','Wil-123','user','',2,'Non Manager'),
 (17,'Miarti','miarti','Mia-123','user','',11,'Non Manager'),
 (18,'Mita Waluyo','mwaluyo','Mit-123','user','mita.waluyo@krisanthium.com',15,'Non Manager'),
 (19,'Ika Sufitri','isufitri','Ika-123','user','ika.sufitri@krisanthium.com',18,'Non Manager'),
 (20,'Rizki Pandurika','rpandurika','Riz-123','user','rizki.pandurika@krisanthium.com',16,'Non Manager'),
 (21,'Vera Setiono','vsetiono','Ver-123','user','vera.setiono@krisanthium.com',12,'Non Manager'),
 (22,'Maria Endah','mendah','Mar-123','user','',20,'Manager'),
 (23,'Mawan Estyawan','mestyawan','Maw-123','user','',6,'Non Manager'),
 (24,'Nur Hari Susanto','nsusanto','Sus-123','user','nurhari.susanto@krisanthium.com',22,'Manager');
/*!40000 ALTER TABLE `muser` ENABLE KEYS */;


--
-- Definition of table `ncar`
--

DROP TABLE IF EXISTS `ncar`;
CREATE TABLE `ncar` (
  `ncarCode` varchar(45) NOT NULL DEFAULT '',
  `tanggal_audit` date DEFAULT NULL,
  `idDepart` int(11) DEFAULT NULL,
  `dokAcuan` varchar(45) DEFAULT NULL,
  `objektif` text,
  `lokasi` varchar(45) DEFAULT NULL,
  `referensi` text,
  `kategori` varchar(45) DEFAULT NULL,
  `auditor` varchar(45) DEFAULT NULL,
  `auditee` varchar(45) DEFAULT NULL,
  `tanggal_auditor` date DEFAULT NULL COMMENT 'Tanggal Tanda Tangan Auditor',
  `tanggal_auditee` date DEFAULT NULL COMMENT 'Tanggal Auditee Tanda tangan',
  `ttd_auditor` varchar(45) DEFAULT NULL,
  `ttd_auditee` varchar(45) DEFAULT NULL,
  `createdBy` varchar(45) DEFAULT NULL,
  `createdDate` datetime DEFAULT NULL,
  `approvedBy` varchar(45) DEFAULT NULL,
  `approvedDate` datetime DEFAULT NULL,
  `changedBy` varchar(45) DEFAULT NULL,
  `changedDate` datetime DEFAULT NULL,
  `penjelasan` longtext,
  PRIMARY KEY (`ncarCode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ncar`
--

/*!40000 ALTER TABLE `ncar` DISABLE KEYS */;
INSERT INTO `ncar` (`ncarCode`,`tanggal_audit`,`idDepart`,`dokAcuan`,`objektif`,`lokasi`,`referensi`,`kategori`,`auditor`,`auditee`,`tanggal_auditor`,`tanggal_auditee`,`ttd_auditor`,`ttd_auditee`,`createdBy`,`createdDate`,`approvedBy`,`approvedDate`,`changedBy`,`changedDate`,`penjelasan`) VALUES 
 ('NCAR-001','2019-08-23',8,'sasadas','ssfds6767jkjkljlkljlk','fdsfds','fdsfdsfsdf','Minor','admin','admin','2019-08-23','2019-08-23','admin','admin','admin','2019-08-23 13:54:54','admin','2019-08-23 14:19:57','admin','2019-08-23 14:17:10','ghghghg'),
 ('NCAR-002','2019-08-26',9,'sdsdsdsdsdd','wweewewewewe','ewewewe','wewewewewe','Major','admin','admin','2019-08-26','2019-08-26','admin','admin','admin','2019-08-26 17:12:59','admin','2019-08-28 11:18:39','admin','2019-08-28 11:17:09','ssdsdsdsdsdsdsdsd'),
 ('NCAR-003','2019-09-04',6,'QP.108-67.THG REV.01','fsdfsdfsdf','dsfsdfd','sfdsfdsf','Minor','miarti','suwarno','2019-09-04','2019-09-04','miarti','suwarno','miarti','2019-09-04 15:02:56','miarti','2019-09-04 15:05:13','miarti','2019-09-04 15:02:56','dsfdsfdsf'),
 ('NCAR-004','2019-09-05',14,'QP.108-67.THG REV.01','sadsadsa','dasdasds','adasdasd','Major','mendah','isufitri','2019-09-05','2019-09-05','mendah','isufitri','mendah','2019-09-05 11:45:16','mendah','2019-09-05 11:46:00','mendah','2019-09-05 11:45:16','asdasdasdasd'),
 ('NCAR-005','2019-09-06',4,'QP.919','sdkjhsdkjsd sdhfjdkshfdsf dsfjkdfhdsf dsfjhdsjkfds','sdsdsfdf','dsfdsfsf dbsbfds sndfjdnsfjdsfj jkhjk','Minor','isufitri','nanggraini','2019-09-06','2019-09-06','isufitri','nanggraini','isufitri','2019-09-06 08:29:15','isufitri','2019-09-06 08:38:06','isufitri','2019-09-06 08:29:15','sdfsdfmndsf nsdfmbdsfjs nfjkdshfkjdsf'),
 ('NCAR-006','2019-09-11',1,'sasadas','asdsad','asdsad','fdsfsf','Minor','admin',NULL,'2019-09-11',NULL,'admin',NULL,'admin','2019-09-11 08:56:11','admin','2019-09-11 08:56:39','admin','2019-09-11 08:56:11','sdfdsfdsf');
/*!40000 ALTER TABLE `ncar` ENABLE KEYS */;


--
-- Definition of table `ncar_correction`
--

DROP TABLE IF EXISTS `ncar_correction`;
CREATE TABLE `ncar_correction` (
  `idCorNcar` varchar(46) NOT NULL,
  `rootCauseNcar` text,
  `CorrectiveActNcar` text,
  `managerAuditee` varchar(45) DEFAULT NULL,
  `tanggalSelesai` date DEFAULT NULL,
  `tanggal_mgr` datetime DEFAULT NULL COMMENT 'Tanggal Manager Auditee TTD',
  `ttd_mgrAuditee` varchar(45) DEFAULT NULL,
  `CreatedBy` varchar(45) DEFAULT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `ApprovedBy` varchar(45) DEFAULT NULL,
  `ApprovedDate` datetime DEFAULT NULL,
  `ChangedBy` varchar(45) DEFAULT NULL,
  `ChangedDate` datetime DEFAULT NULL,
  `ncarCode` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idCorNcar`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ncar_correction`
--

/*!40000 ALTER TABLE `ncar_correction` DISABLE KEYS */;
INSERT INTO `ncar_correction` (`idCorNcar`,`rootCauseNcar`,`CorrectiveActNcar`,`managerAuditee`,`tanggalSelesai`,`tanggal_mgr`,`ttd_mgrAuditee`,`CreatedBy`,`CreatedDate`,`ApprovedBy`,`ApprovedDate`,`ChangedBy`,`ChangedDate`,`ncarCode`) VALUES 
 ('COIR-20190826-001','sddsd78','sdsdsdsd','admin','2019-08-27','2019-08-26 15:36:05','admin','admin','2019-08-26 15:36:05','admin','2019-08-26 16:34:06','admin','2019-08-26 16:33:54','NCAR-001'),
 ('COIR-20190828-001','sds','dsdsdsdsd','admin','2019-08-26','2019-08-28 11:27:22','admin','admin','2019-08-28 11:27:22','admin','2019-08-30 17:16:26','admin','2019-08-28 11:29:23','NCAR-002'),
 ('COIR-20190904-001','cxcx','cxcxcxc','suwarno','2019-09-05','2019-09-04 16:10:25','suwarno','suwarno','2019-09-04 16:10:25','lfitri','2019-09-04 16:13:43','suwarno','2019-09-04 16:10:25','NCAR-003'),
 ('COIR-20190905-001','FGGDF','GDFGDGDF','isufitri','2019-09-07','2019-09-05 11:49:18','isufitri','isufitri','2019-09-05 11:49:18','ssetyabudi','2019-09-05 11:57:40','isufitri','2019-09-05 11:49:18','NCAR-004'),
 ('COIR-20190906-001','sdfsdf sfdfdsf','sfsdf sdfdsfdsf','mendah','2019-09-08','2019-09-06 08:52:33','mendah','nanggraini','2019-09-06 08:50:52','mendah','2019-09-06 08:52:33','nanggraini','2019-09-06 08:50:52','NCAR-005');
/*!40000 ALTER TABLE `ncar_correction` ENABLE KEYS */;


--
-- Definition of table `ncar_correction_type`
--

DROP TABLE IF EXISTS `ncar_correction_type`;
CREATE TABLE `ncar_correction_type` (
  `idNcarCorType` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idCorNcar` varchar(45) DEFAULT NULL,
  `jenisCor` varchar(45) DEFAULT NULL,
  `createdByType` varchar(45) DEFAULT NULL,
  `createdDateType` datetime DEFAULT NULL,
  PRIMARY KEY (`idNcarCorType`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ncar_correction_type`
--

/*!40000 ALTER TABLE `ncar_correction_type` DISABLE KEYS */;
INSERT INTO `ncar_correction_type` (`idNcarCorType`,`idCorNcar`,`jenisCor`,`createdByType`,`createdDateType`) VALUES 
 (14,'COIR-20190826-001','Pembuatan Dok.',NULL,NULL),
 (15,'COIR-20190826-001','Revisi',NULL,NULL),
 (27,'COIR-20190828-001','Pembuatan Dok.','admin','2019-08-28 11:29:23'),
 (35,'COIR-20190904-001','Revisi','suwarno','2019-09-04 16:10:25'),
 (36,'COIR-20190904-001','Training','suwarno','2019-09-04 16:10:25'),
 (37,'COIR-20190905-001','Revisi','isufitri','2019-09-05 11:49:18'),
 (38,'COIR-20190905-001','Training','isufitri','2019-09-05 11:49:18'),
 (40,'COIR-20190906-001','Revisi','nanggraini','2019-09-06 08:50:52');
/*!40000 ALTER TABLE `ncar_correction_type` ENABLE KEYS */;


--
-- Definition of table `ncar_verifikasi`
--

DROP TABLE IF EXISTS `ncar_verifikasi`;
CREATE TABLE `ncar_verifikasi` (
  `idNcarVer` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ncarCode` varchar(45) DEFAULT NULL,
  `hasilVerifikasi` text,
  `tanggal_periksa` date DEFAULT NULL,
  `createdby` varchar(45) DEFAULT NULL,
  `createddate` datetime DEFAULT NULL,
  PRIMARY KEY (`idNcarVer`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ncar_verifikasi`
--

/*!40000 ALTER TABLE `ncar_verifikasi` DISABLE KEYS */;
INSERT INTO `ncar_verifikasi` (`idNcarVer`,`ncarCode`,`hasilVerifikasi`,`tanggal_periksa`,`createdby`,`createddate`) VALUES 
 (1,'NCAR-001','ddadadadad','2019-08-29','admin','2019-08-26 17:57:25'),
 (5,'NCAR-002','dsadaddad','2019-08-26','admin','2019-08-30 17:16:39'),
 (7,'NCAR-003','mdbsdbsmnd','2019-09-05','miarti','2019-09-04 16:20:34'),
 (8,'NCAR-004','ddfsffsdf','2019-09-08','mendah','2019-09-05 12:02:13'),
 (9,'NCAR-005','dadadadad','2019-09-02','isufitri','2019-09-06 08:53:12');
/*!40000 ALTER TABLE `ncar_verifikasi` ENABLE KEYS */;


--
-- Definition of table `ncar_verifikasi_qa`
--

DROP TABLE IF EXISTS `ncar_verifikasi_qa`;
CREATE TABLE `ncar_verifikasi_qa` (
  `idVerQa` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ncarCode` varchar(45) DEFAULT NULL,
  `komentar` text,
  `status` varchar(45) DEFAULT NULL,
  `tanggal_qa` date DEFAULT NULL,
  `createdByQa` varchar(45) DEFAULT NULL,
  `createdDateQa` datetime DEFAULT NULL,
  PRIMARY KEY (`idVerQa`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ncar_verifikasi_qa`
--

/*!40000 ALTER TABLE `ncar_verifikasi_qa` DISABLE KEYS */;
INSERT INTO `ncar_verifikasi_qa` (`idVerQa`,`ncarCode`,`komentar`,`status`,`tanggal_qa`,`createdByQa`,`createdDateQa`) VALUES 
 (1,'NCAR-001','asasasasasasa43443434','Close','2019-08-22','admin','2019-08-26 17:58:26'),
 (4,'NCAR-002','sasasas','Close','2019-08-28','admin','2019-08-30 17:16:53'),
 (6,'NCAR-003','dsfdsfdsfsdfsdf','Close','2019-09-04','suwarno','2019-09-04 16:23:50'),
 (8,'NCAR-004','retretretret','Close','2019-09-26','lfitri','2019-09-05 13:07:45'),
 (9,'NCAR-005','dasdasdsadasd','Close','2019-09-08','lfitri','2019-09-06 08:55:28');
/*!40000 ALTER TABLE `ncar_verifikasi_qa` ENABLE KEYS */;


--
-- Definition of table `ncir_correction`
--

DROP TABLE IF EXISTS `ncir_correction`;
CREATE TABLE `ncir_correction` (
  `idCor` varchar(45) NOT NULL DEFAULT '',
  `rootCause` text,
  `correctiveAct` text,
  `hasil_verifikasi` text,
  `hasil_baik` varchar(45) DEFAULT NULL,
  `hasil_rusak` varchar(45) DEFAULT NULL,
  `CreatedBy` varchar(45) DEFAULT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `ApprovedBy` varchar(45) DEFAULT NULL,
  `ApprovedDate` datetime DEFAULT NULL,
  `ncirCode` varchar(45) DEFAULT NULL,
  `ChangedBy` varchar(45) DEFAULT NULL,
  `ChangedDate` datetime DEFAULT NULL,
  PRIMARY KEY (`idCor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ncir_correction`
--

/*!40000 ALTER TABLE `ncir_correction` DISABLE KEYS */;
INSERT INTO `ncir_correction` (`idCor`,`rootCause`,`correctiveAct`,`hasil_verifikasi`,`hasil_baik`,`hasil_rusak`,`CreatedBy`,`CreatedDate`,`ApprovedBy`,`ApprovedDate`,`ncirCode`,`ChangedBy`,`ChangedDate`) VALUES 
 ('COIR-20190517-002','Debu kertas, kertas tercabut','Gosok kertas dengan sikat, tinta blue dikasih NContex','','','','swahyono','2019-05-17 16:09:11','kismuntoyo','2019-05-17 16:11:55','NCIR-001','swahyono','2019-05-17 16:09:11'),
 ('COIR-20190520-001','fgfgfg','fgfgfg','gfgfg','66','77','swahyono','2019-05-20 11:49:56','sunawan','2019-05-20 11:50:29','NCIR-003','swahyono','2019-05-20 11:49:56'),
 ('COIR-20190523-002','fggf','ggffg','hhg','1212','1212','sunawan','2019-05-23 10:06:18','sunawan','2019-09-05 17:39:21','NCIR-006','mestyawan','2019-09-05 17:33:44'),
 ('COIR-20190905-001','fdsfdsfsdf','sdfdsfdsf','sfddsfdsf','343','dfd','wilarni','2019-09-05 10:48:31','suwarno','2019-09-05 11:09:26','NCIR-008','wilarni','2019-09-05 11:04:51');
/*!40000 ALTER TABLE `ncir_correction` ENABLE KEYS */;


--
-- Definition of table `ncir_correction_type`
--

DROP TABLE IF EXISTS `ncir_correction_type`;
CREATE TABLE `ncir_correction_type` (
  `idCorType` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idCor` varchar(45) DEFAULT NULL,
  `jenisCor` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idCorType`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ncir_correction_type`
--

/*!40000 ALTER TABLE `ncir_correction_type` DISABLE KEYS */;
INSERT INTO `ncir_correction_type` (`idCorType`,`idCor`,`jenisCor`) VALUES 
 (13,'COIR-20190515-002','Segregation'),
 (14,'COIR-20190515-002','Konsesi'),
 (15,'COIR-20190517-001','Sortir'),
 (17,'COIR-20190521-001','Sortir'),
 (18,'COIR-20190905-001','Segregation'),
 (19,'COIR-20190905-001','Konsesi'),
 (20,'COIR-20190523-002','Reject');
/*!40000 ALTER TABLE `ncir_correction_type` ENABLE KEYS */;


--
-- Definition of table `ncir_inspection`
--

DROP TABLE IF EXISTS `ncir_inspection`;
CREATE TABLE `ncir_inspection` (
  `ncirCode` varchar(45) NOT NULL,
  `tanggal_ncir` date DEFAULT NULL,
  `penerbit` varchar(105) DEFAULT NULL,
  `tujuan` varchar(105) DEFAULT NULL,
  `jenis_inspection` varchar(45) DEFAULT NULL,
  `nama_barang` varchar(200) DEFAULT NULL,
  `po_wo` varchar(45) DEFAULT NULL,
  `jum_ketidaksesuian` varchar(45) DEFAULT NULL,
  `jum_sample` varchar(45) DEFAULT NULL,
  `keterangan` text,
  `jum_karantina` varchar(45) DEFAULT NULL,
  `lot` varchar(45) DEFAULT NULL,
  `no_suratjalan` varchar(45) DEFAULT NULL,
  `tanggal_datang` varchar(45) DEFAULT NULL,
  `supplier` varchar(45) DEFAULT NULL,
  `tanggal_hasil` text,
  `createdBy` varchar(45) DEFAULT NULL,
  `createdDate` datetime DEFAULT NULL,
  `approvedBy` varchar(45) DEFAULT NULL,
  `approvedDate` datetime DEFAULT NULL,
  `changedBy` varchar(45) DEFAULT NULL,
  `changedDate` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ncirCode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ncir_inspection`
--

/*!40000 ALTER TABLE `ncir_inspection` DISABLE KEYS */;
INSERT INTO `ncir_inspection` (`ncirCode`,`tanggal_ncir`,`penerbit`,`tujuan`,`jenis_inspection`,`nama_barang`,`po_wo`,`jum_ketidaksesuian`,`jum_sample`,`keterangan`,`jum_karantina`,`lot`,`no_suratjalan`,`tanggal_datang`,`supplier`,`tanggal_hasil`,`createdBy`,`createdDate`,`approvedBy`,`approvedDate`,`changedBy`,`changedDate`) VALUES 
 ('NCIR-001','2019-05-17','Quality','7','','FB Vidoran XMart LT Vanila 350 G','WOT-190329-0002','330','1176','Kertas serabut, red banyak noda','3000','','CD 6 & II','Devin','Masuki','','lwibowo','2019-05-17 15:57:19','suwarno','2019-05-17 16:00:46','lwibowo','2019-05-17 15:57:19'),
 ('NCIR-003','2019-05-20','Quality Control','7','','Esse Mild','WOT-190329-0002','32','45','gfdgdfgdf fdgfdgdfg fgfgfgfg','23','','CD 6 & II','Devin','Masuki','08-04-2019','lwibowo','2019-05-20 11:47:39','suwarno','2019-05-20 11:48:41','lwibowo','2019-05-20 11:47:39'),
 ('NCIR-006','2019-05-22','sdsdsds','8','','dsdsd','ds','sds','sd','dsdsd','sdsd','sds','dsds','dssds','dsd','sdsd','suwarno','2019-05-22 09:31:15','admin','2019-05-22 09:54:43','suwarno','2019-05-22 09:31:15'),
 ('NCIR-007','2019-05-22','Quality Control','2','','sdd','WOT-190329-0002','ggf','fgfggfg','gfgg','ggfgf','gfggf','gfgfgf','gfg','gg','gggf','admin','2019-05-22 10:22:41','suwarno','2019-05-23 11:09:43','admin','2019-05-22 10:22:41'),
 ('NCIR-008','2019-09-05','EDP','6','','sfsfdf','sdfsdf','2332','232','2xccdscsd','32','nkn','sfdfsdf','dsfdsf','dsfdsf','dfsfsd','admin','2019-09-05 10:46:47','admin','2019-09-05 10:46:52','admin','2019-09-05 10:46:47'),
 ('NCIR-009','2021-05-10','Quality','7','','sasasasasas','12121212','1000','5000','Warna blobor','1000','FFHGHFH','GID-HIHIIJKH','SUPARMAN','CAREL','15 MEI 2021','wilarni','2021-05-10 12:04:20',NULL,NULL,'wilarni','2021-05-10 12:05:12'),
 ('NCIR-010','2021-06-03','quality','7','','fidoran','DASWD','3','5','tdk sesuai','1','asdasd','asd','1231sdasdkj','asdasd','jsdhfkjsdh','admin','2021-06-03 13:34:38',NULL,NULL,'admin','2021-06-03 13:34:38');
/*!40000 ALTER TABLE `ncir_inspection` ENABLE KEYS */;


--
-- Definition of table `ncr_correction`
--

DROP TABLE IF EXISTS `ncr_correction`;
CREATE TABLE `ncr_correction` (
  `idCorNcr` varchar(45) NOT NULL,
  `jenisKoreksi` varchar(45) NOT NULL,
  `ncrCode` varchar(45) NOT NULL,
  `rootCouse` text NOT NULL,
  `correctiveAction` text NOT NULL,
  `CreatedBy` varchar(45) DEFAULT NULL,
  `createdDate` date NOT NULL,
  `ApprovedBy` varchar(45) DEFAULT NULL,
  `approvedDate` date DEFAULT NULL,
  `changedBy` varchar(45) NOT NULL,
  `changedDate` date NOT NULL,
  PRIMARY KEY (`idCorNcr`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ncr_correction`
--

/*!40000 ALTER TABLE `ncr_correction` DISABLE KEYS */;
INSERT INTO `ncr_correction` (`idCorNcr`,`jenisKoreksi`,`ncrCode`,`rootCouse`,`correctiveAction`,`CreatedBy`,`createdDate`,`ApprovedBy`,`approvedDate`,`changedBy`,`changedDate`) VALUES 
 ('COR-20190819-001','','NCR-001','pembagian shift','atur ulang shift','admin','2019-08-19','admin','2019-08-19','admin','2019-08-19'),
 ('COR-20190819-002','','NCR-002','Komputer lama','Beli komputer baru ru ru','admin','2019-08-19','admin','2019-08-21','admin','2019-08-21'),
 ('COR-20190821-001','','NCR-003','xzxzx5555','zxzxz','admin','2019-08-21','admin','2019-09-04','admin','2019-09-04'),
 ('COR-20190905-001','','NCR-005','sadsadsad','asdasdasd','sunawan','2019-09-05','sunawan','2019-09-05','sunawan','2019-09-05'),
 ('COR-20190905-002','','NCR-006','dasdsad','sadasd','mendah','2019-09-05','mendah','2019-09-05','mendah','2019-09-05'),
 ('COR-20190905-003','','NCR-007','qweqweqwe','wqeqweqwe','mendah','2019-09-05','mendah','2019-09-05','mendah','2019-09-05'),
 ('COR-20190905-004','','NCR-008','fgfd','gdgdfgdf','wnasrullah','2019-09-05','wnasrullah','2019-09-05','wnasrullah','2019-09-05'),
 ('COR-20190905-005','','NCR-009','dfsdfdsf','dsfdsfdsfd','wilarni','2019-09-05','wilarni','2019-09-05','wilarni','2019-09-05');
/*!40000 ALTER TABLE `ncr_correction` ENABLE KEYS */;


--
-- Definition of table `ncr_correction_type`
--

DROP TABLE IF EXISTS `ncr_correction_type`;
CREATE TABLE `ncr_correction_type` (
  `idCorType` int(11) NOT NULL AUTO_INCREMENT,
  `idCor` varchar(45) NOT NULL,
  `jenisCor` varchar(45) NOT NULL,
  PRIMARY KEY (`idCorType`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ncr_correction_type`
--

/*!40000 ALTER TABLE `ncr_correction_type` DISABLE KEYS */;
INSERT INTO `ncr_correction_type` (`idCorType`,`idCor`,`jenisCor`) VALUES 
 (1,'COR-20190819-001','penambahan_pembuatan'),
 (2,'COR-20190819-001','training'),
 (4,'COR-20190819-002','revisi'),
 (10,'COR-20190821-001','penambahan_pembuatan'),
 (11,'COR-20190821-001','revisi'),
 (12,'COR-20190905-001','penambahan_pembuatan'),
 (13,'COR-20190905-002','revisi'),
 (14,'COR-20190905-003','revisi'),
 (15,'COR-20190905-003','training'),
 (16,'COR-20190905-004','penambahan_pembuatan'),
 (17,'COR-20190905-005','revisi'),
 (18,'COR-20190905-005','training');
/*!40000 ALTER TABLE `ncr_correction_type` ENABLE KEYS */;


--
-- Definition of table `ncr_files`
--

DROP TABLE IF EXISTS `ncr_files`;
CREATE TABLE `ncr_files` (
  `idFileLampiran` int(11) NOT NULL AUTO_INCREMENT,
  `idNcr` varchar(45) NOT NULL,
  `nama` varchar(100) NOT NULL,
  PRIMARY KEY (`idFileLampiran`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ncr_files`
--

/*!40000 ALTER TABLE `ncr_files` DISABLE KEYS */;
INSERT INTO `ncr_files` (`idFileLampiran`,`idNcr`,`nama`) VALUES 
 (1,'NCR-001','NCR-001-0.png'),
 (3,'NCR-002','NCR-002-0.png'),
 (7,'NCR-004','NCR-004-0.png'),
 (10,'NCR-005','NCR-005-0.jpg'),
 (11,'NCR-006','NCR-006-0.jpg');
/*!40000 ALTER TABLE `ncr_files` ENABLE KEYS */;


--
-- Definition of table `ncr_inspection`
--

DROP TABLE IF EXISTS `ncr_inspection`;
CREATE TABLE `ncr_inspection` (
  `ncrCode` varchar(45) NOT NULL,
  `tanggal_ncr` date NOT NULL,
  `penerbit` varchar(105) NOT NULL,
  `tujuan` varchar(105) NOT NULL,
  `jenis_inspection` varchar(45) NOT NULL,
  `uraian` text NOT NULL,
  `createdBy` varchar(45) DEFAULT NULL,
  `createdDate` date NOT NULL,
  `approvedBy` varchar(45) DEFAULT NULL,
  `approvedDate` date DEFAULT NULL,
  `changedBy` varchar(45) DEFAULT NULL,
  `changedDate` varchar(45) NOT NULL,
  PRIMARY KEY (`ncrCode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ncr_inspection`
--

/*!40000 ALTER TABLE `ncr_inspection` DISABLE KEYS */;
INSERT INTO `ncr_inspection` (`ncrCode`,`tanggal_ncr`,`penerbit`,`tujuan`,`jenis_inspection`,`uraian`,`createdBy`,`createdDate`,`approvedBy`,`approvedDate`,`changedBy`,`changedDate`) VALUES 
 ('NCR-001','2019-08-19','1','#','SDM','kekurangan orang','admin','2019-08-19','admin','2019-08-19','admin','2019-08-19 10:23:55'),
 ('NCR-002','2019-08-19','1','6','lain-lain','Komputernya error','admin','2019-08-19','admin','2019-08-19','admin','2019-08-19 14:14:32'),
 ('NCR-003','2019-08-21','4','7','SDM','sasasas','admin','2019-08-21','admin','2019-08-21','admin','2019-08-21 17:27:56'),
 ('NCR-004','2019-08-21','1','4','Sistem','gjhgjh','admin','2019-08-21','admin','2019-08-21','admin','2019-08-21 17:51:40'),
 ('NCR-005','2019-09-05','4','7','Mesin & Perawatan','sdsadsdad','mendah','2019-09-05','mendah','2019-09-05','mendah','2019-09-05 13:50:09'),
 ('NCR-006','2019-09-05','7','4','Mesin & Perawatan','thfhfhfh','sunawan','2019-09-05','sunawan','2019-09-05','sunawan','2019-09-05 14:25:42'),
 ('NCR-007','2019-09-05','1','4','Mesin & Perawatan','qweqweqwe','wnasrullah','2019-09-05','wnasrullah','2019-09-05','wnasrullah','2019-09-05 16:26:09'),
 ('NCR-008','2019-09-05','4','1','Mesin & Perawatan','fdgdfgdfgdfgdf','mendah','2019-09-05','mendah','2019-09-05','mendah','2019-09-05 16:31:09'),
 ('NCR-009','2019-09-05','1','6','Manajemen','asASas','wnasrullah','2019-09-05','wnasrullah','2019-09-05','wnasrullah','2019-09-05 16:37:21'),
 ('NCR-010','2019-09-05','6','1','Mesin & Perawatan','sdfsdfdf','wilarni','2019-09-05','wilarni','2019-09-05','wilarni','2019-09-05 16:59:01');
/*!40000 ALTER TABLE `ncr_inspection` ENABLE KEYS */;


--
-- Definition of table `simkop`
--

DROP TABLE IF EXISTS `simkop`;
CREATE TABLE `simkop` (
  `docno` varchar(15) CHARACTER SET utf8 NOT NULL,
  `docdate` date NOT NULL,
  `sodocno` varchar(15) CHARACTER SET utf8 NOT NULL,
  `pono` varchar(50) CHARACTER SET utf8 NOT NULL,
  `so_wo` varchar(15) CHARACTER SET utf8,
  `wo_no` varchar(15) CHARACTER SET utf8,
  `so_no` varchar(15) CHARACTER SET utf8,
  `materialcode` varchar(20) CHARACTER SET utf8,
  `qtydelivered` decimal(18,4),
  `information` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `simkop`
--

/*!40000 ALTER TABLE `simkop` DISABLE KEYS */;
INSERT INTO `simkop` (`docno`,`docdate`,`sodocno`,`pono`,`so_wo`,`wo_no`,`so_no`,`materialcode`,`qtydelivered`,`information`) VALUES 
 ('GID-190723-0007','2019-07-23','SOD-190522-0004','O-91-190523-00003','SOD-190522-0004','WOT-190523-0002','SOD-190522-0004','ET.0195.94','5000000.0000','COA :  1024                   K190628-0005                   6 @ 100.000 pcs = 600.000 pcs.'),
 ('GID-190723-0007','2019-07-23','SOD-190522-0004','O-91-190523-00003','SOD-190522-0004','WOT-190628-0005','SOD-190522-0004','ET.0195.94','5000000.0000','COA :  1024                   K190628-0005                   6 @ 100.000 pcs = 600.000 pcs.'),
 ('GID-190723-0007','2019-07-23','SOD-190522-0004','O-91-190523-00003','SOD-190522-0004','WOT-190628-0006','SOD-190522-0004','ET.0195.94','5000000.0000','COA :  1024                   K190628-0005                   6 @ 100.000 pcs = 600.000 pcs.'),
 ('GID-190723-0007','2019-07-23','SOD-190522-0004','O-91-190523-00003','SOD-190522-0004','WOT-190628-0007','SOD-190522-0004','ET.0195.94','5000000.0000','COA :  1024                   K190628-0005                   6 @ 100.000 pcs = 600.000 pcs.'),
 ('GID-190723-0007','2019-07-23','SOD-190522-0004','O-91-190523-00003','SOD-190522-0004','WOT-190712-0001','SOD-190522-0004','ET.0195.94','5000000.0000','COA :  1024                   K190628-0005                   6 @ 100.000 pcs = 600.000 pcs.');
/*!40000 ALTER TABLE `simkop` ENABLE KEYS */;


--
-- Definition of procedure `SP_simKOP`
--

DROP PROCEDURE IF EXISTS `SP_simKOP`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_simKOP`(
    IN noGID text
)
BEGIN
drop table ncir_krisanthium.simkop;

    CREATE TABLE IF NOT EXISTS ncir_krisanthium.simkop
    AS
     SELECT h.docno, h.docdate, h.sodocno, h.pono, w.sodocno as so_wo, w.docno as wo_no, s.docno as so_no,
        d.materialcode, d.qtydelivered, h.information
        FROM sim_krisanthium.goodsissueh h
        left join sim_krisanthium.workorderh w on h.sodocno = w.sodocno
        left join sim_krisanthium.salesorderh s on h.sodocno = s.docno
        left join sim_krisanthium.salesorderd d on s.docno = d.docno
        where h.docno = noGID;


    SELECT docno, docdate, sodocno, pono, so_wo, wo_no, so_no, materialcode, qtydelivered, information
        FROM simkop;

END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
