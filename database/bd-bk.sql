-- MySQL dump 10.13  Distrib 5.5.40, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: rounded.dev
-- ------------------------------------------------------
-- Server version	5.5.40-0ubuntu0.14.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `bsr_account_settings`
--

DROP TABLE IF EXISTS `bsr_account_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bsr_account_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `credit_card` varchar(64) DEFAULT NULL,
  `expiry_date` varchar(15) DEFAULT NULL,
  `sercurity_number` varchar(15) DEFAULT NULL,
  `status` varchar(15) DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `expires_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bsr_account_settings`
--

LOCK TABLES `bsr_account_settings` WRITE;
/*!40000 ALTER TABLE `bsr_account_settings` DISABLE KEYS */;
INSERT INTO `bsr_account_settings` VALUES (1,1,'12344567','2016-04','1234','paid','2015-01-05','2015-02-05'),(2,45,NULL,NULL,NULL,'trial',NULL,'2015-01-09'),(3,46,NULL,NULL,NULL,'trial',NULL,'2015-02-07'),(4,47,NULL,NULL,NULL,'trial',NULL,'2015-02-22'),(5,48,NULL,NULL,NULL,'trial',NULL,'2015-03-03'),(6,49,NULL,NULL,NULL,'trial',NULL,'2015-03-03');
/*!40000 ALTER TABLE `bsr_account_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bsr_banks`
--

DROP TABLE IF EXISTS `bsr_banks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bsr_banks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_name` varchar(255) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bsr_banks`
--

LOCK TABLES `bsr_banks` WRITE;
/*!40000 ALTER TABLE `bsr_banks` DISABLE KEYS */;
INSERT INTO `bsr_banks` VALUES (13,'ACB',1),(16,'Test',45),(17,'NAB',11),(18,'Virgin Credit',11),(19,'oakdps',47),(20,'TEST',16);
/*!40000 ALTER TABLE `bsr_banks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bsr_business_details`
--

DROP TABLE IF EXISTS `bsr_business_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bsr_business_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `lodge_bas` tinyint(2) DEFAULT NULL,
  `register_gst` tinyint(1) DEFAULT NULL,
  `report_gst` varchar(25) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `abn` varchar(255) DEFAULT NULL,
  `business_name` varchar(255) DEFAULT '',
  `first_name` varchar(255) DEFAULT '',
  `last_name` varchar(255) DEFAULT '',
  `email` varchar(255) DEFAULT '',
  `phone` varchar(255) DEFAULT '',
  `fax` varchar(255) DEFAULT '',
  `address` varchar(255) DEFAULT '',
  `address2` varchar(255) DEFAULT '',
  `suburb` varchar(255) DEFAULT '',
  `state` varchar(255) DEFAULT '',
  `country` varchar(255) DEFAULT '',
  `website` varchar(255) DEFAULT '',
  `postcode` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bsr_business_details`
--

LOCK TABLES `bsr_business_details` WRITE;
/*!40000 ALTER TABLE `bsr_business_details` DISABLE KEYS */;
INSERT INTO `bsr_business_details` VALUES (3,45,NULL,1,'quarterly','Trung Le','1233444','Rounded','','','','','','','','','','','',''),(8,46,NULL,1,'quarterly','AAAA Le','asd','asd','AAAA','Le','','','','','','','','Australia','',''),(9,1,1,0,'quarterly','Trung Le','ABN','Rounded','Trung','Le','admin@admin.com','asd','asd','asdasdasdasdasdasdasd','asdsadasdasdsd','','','Australia','asd',''),(10,16,1,1,'quarterly','Manesh Bahuguna','69797KLM798','Frontlinewebdevelopers','Manesh','Bahuguna','manesh_2660632@yahoo.com','+639278868720','','Block 12 Lot 2 Lincoln Road cor Barton St. ','Dreamcrest Homes, Longos,','',' Malolos City Bulacan','Australia','','3000'),(11,11,NULL,1,'quarterly','Grant McCall','42565564456','Wallamba','Grant','McCall','grant@grantmccall.com','','','8 Hoskins Street','','Nabiac','New South Wales','Australia','','2312'),(12,48,1,1,'quarterly','Thomas Smith','1938729384738','Smith Electrics','Thomas','Smith','','','','','','','','','',''),(13,49,NULL,0,'quarterly','Igor Pantović','12345678','Igor\'s Company','Igor','Pantović','','','','','','','','','','');
/*!40000 ALTER TABLE `bsr_business_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bsr_categories`
--

DROP TABLE IF EXISTS `bsr_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bsr_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(225) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bsr_categories`
--

LOCK TABLES `bsr_categories` WRITE;
/*!40000 ALTER TABLE `bsr_categories` DISABLE KEYS */;
INSERT INTO `bsr_categories` VALUES (1,'Equipment13',1),(2,'Rental',1),(3,'cate1',3),(4,'computer',5),(5,'Other expenses',6),(6,'Other expenses',7),(7,'cate a2',7),(8,'Other expenses',10),(9,'Other expenses',14),(10,'Other expenses',17),(11,'Other expenses',18),(12,'mycate',18),(13,'cate1',18),(14,'Other expenses',19),(15,'Other expenses',20),(16,'Other expenses',21),(18,'category 1',21),(19,'Advertising Costs',0),(20,'Phone & Internet',0),(21,'Utilities',0),(22,'Software',0),(23,'Rent',0),(24,'Contractors',0),(25,'Repair & Maintenance',0),(26,'Vehicle Expenses',0),(27,'Office Supplies',0),(28,'Travel',0),(39,'Other expenses',22),(40,'new cate for user 24',24),(46,'my cate',32),(47,'a u',32),(48,'aaa',1),(49,'Test',1),(50,'test 2',1),(51,'test 3',1),(52,'abc233',1),(53,'Test new Design',1),(54,'Test',1),(55,'đâs',1),(58,'Travelling Expenses',16),(62,'Grants category',11);
/*!40000 ALTER TABLE `bsr_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bsr_clients`
--

DROP TABLE IF EXISTS `bsr_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bsr_clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `business_name` varchar(255) DEFAULT NULL,
  `contact_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `abn` varchar(255) DEFAULT NULL,
  `invoice_prefix` varchar(15) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `sign` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bsr_clients`
--

LOCK TABLES `bsr_clients` WRITE;
/*!40000 ALTER TABLE `bsr_clients` DISABLE KEYS */;
INSERT INTO `bsr_clients` VALUES (1,'ACB','Acb','admin@admin.com','1234456','ACB','Hue, Viet Nam','{\'col\':\'#de0d6b\',\'char\':\'ab\'}',1),(2,'CDA','Trung Le','aaaa','aaaaa','CDA','aaaa','{\'col\':\'#cb2c72\',\'char\':\'CD\'}',1),(3,'KFC','Colonel Sanders','grant.mccall@astutepayroll.com','231412341234','KFC','7 Farnell Street\nNabiac, NSW, 2312','{\'col\':\'#cc2d32\',\'char\':\'KF\'}',11),(4,'KFC','KFC','manesh.bahuguna@gmail.com','58686KJHN','KFC','262 S. Brookside, Wichita, KS 67218','{\'col\':\'#cb2c72\',\'char\':\'KF\'}',16),(5,'McDonalds','Ronald','grant@wallamba.com','3345345345','MCD','7 Smith Street','{\'col\':\'#ffc421\',\'char\':\'MC\'}',11),(6,'Astute Payroll','Nicholas Beames','noone@gmail.com','24523542345','AST','Level 4, 325 Flinders Lane\nMelbourne, Victoria, 3000','{\'col\':\'#2d77cc\',\'char\':\'AS\'}',11),(7,'Eva Mezei','Eva','mezeeeva@gmail.com','9787987987','EVA','7 Somewhere Street\nbumbfuckville, 3000','{\'col\':\'#78d636\',\'char\':\'EV\'}',11),(8,'adsop','okdsapdk','asda','adsa','ADS','das','{\'col\':\'#cb2c72\',\'char\':\'AD\'}',47),(10,'McDonalds','Ronald','ronald@mcdonald.com','324523452345','MCD','asdjklfha s;dlfkj a;sldkfjasdfasdf','{\'col\':\'#f5f51d\',\'char\':\'MC\'}',48),(11,'Some Client','Somebody','php.igor@gmail.com','123456','SOM','Some address','{\'col\':\'#3123cc\',\'char\':\'SC\'}',49),(14,'WizStudio','Andy','marknz76@yahoo.com','789056789','WIZ','Block 12 Lot 2 Dreamcrest Homes','{\'col\':\'#2d4dcc\',\'char\':\'WI\'}',16),(15,'ACD','ACD','ACD@ACD.com','ACDE','ACD','Test','{\'col\':\'#ab6382\',\'char\':\'AC\'}',1),(16,'DIck Smith','Dick','grant.mccall@astutepayroll.com','2345345345','DIC','45 Fig street\nMelbourne, 3000','{\'col\':\'#634f58\',\'char\':\'DI\'}',11);
/*!40000 ALTER TABLE `bsr_clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bsr_email_templates`
--

DROP TABLE IF EXISTS `bsr_email_templates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bsr_email_templates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `invoice_subject` text,
  `invoice_content` text,
  `reminder_subject` text,
  `reminder_content` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bsr_email_templates`
--

LOCK TABLES `bsr_email_templates` WRITE;
/*!40000 ALTER TABLE `bsr_email_templates` DISABLE KEYS */;
INSERT INTO `bsr_email_templates` VALUES (1,1,'<span contenteditable=\"false\">your business name</span><br>','das asd asdad<span contenteditable=\"false\">your full name</span>&nbsp;asd asd asd as d&nbsp;<span contenteditable=\"false\">client name</span>&nbsp;asd asd<br>asdas asd asdasd asd &nbsp;<span contenteditable=\"false\">client name</span>&nbsp;&nbsp;','<br>','<br>'),(2,11,'New invoice from&nbsp;<span contenteditable=\"false\">your business name</span>','Hello&nbsp;<span contenteditable=\"false\">client name</span>,<br><br>Please find attached invoice&nbsp;<span contenteditable=\"false\">invoice number</span>&nbsp;for&nbsp;<span contenteditable=\"false\">payment amount</span>&nbsp;which is done on the&nbsp;<span contenteditable=\"false\">invoice due date</span>.<br><br>Best regards,<br><br><span contenteditable=\"false\">your full name</span><br>','','dasd as ASD asd asd<span contenteditable=\"false\">your business name</span>'),(3,16,'<span contenteditable=\"false\">invoice number</span><br>','Hello&nbsp;<span contenteditable=\"false\">client name</span>&nbsp;,<br>Please pay invoice on time <span contenteditable=\"false\">invoice due days</span>&nbsp;and save overdue fine.<br>Thanks<br><br>Regards,<br>Manesh<br><span contenteditable=\"false\">your business name</span><br>','','Hello<span contenteditable=\"false\">your full name</span>,&nbsp;<div>Please pay on time.</div>'),(4,48,'New invoice from&nbsp;<span contenteditable=\"false\">your business name</span>','Hello&nbsp;<span contenteditable=\"false\">client name</span>,<br><br>Please find an invoice for&nbsp;<span contenteditable=\"false\">payment amount</span>&nbsp;which is due on the&nbsp;<span contenteditable=\"false\">invoice due date</span><br><br>Thanks,<br><br><span contenteditable=\"false\">your full name</span><br>','',''),(5,49,'Invoice -&nbsp;<span contenteditable=\"false\">client name</span>&nbsp;tfttttztztztz','Greetings&nbsp;<span contenteditable=\"false\">client name</span>,<br><br>I\'m sending you an $<span contenteditable=\"false\">payment amount</span>&nbsp;invoice which is due in&nbsp;<span contenteditable=\"false\">invoice due days</span>.<br><br>Best Regards,<br><br><span contenteditable=\"false\">your full name</span><br>','','');
/*!40000 ALTER TABLE `bsr_email_templates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bsr_expenses`
--

DROP TABLE IF EXISTS `bsr_expenses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bsr_expenses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `amount` double DEFAULT '0',
  `gst` double DEFAULT '0',
  `inc_gst` tinyint(1) DEFAULT '0',
  `description` text,
  `attachment` varchar(225) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` char(16) DEFAULT '',
  `category_id` int(11) DEFAULT NULL,
  `business_use` int(3) DEFAULT '100',
  `expense_type` tinyint(1) DEFAULT NULL,
  `expense_area` varchar(16) DEFAULT NULL,
  `invoice_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) DEFAULT '0',
  `bank_id` int(11) DEFAULT '0',
  `recur_id` int(11) DEFAULT '0',
  `parent_id` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2979 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bsr_expenses`
--

LOCK TABLES `bsr_expenses` WRITE;
/*!40000 ALTER TABLE `bsr_expenses` DISABLE KEYS */;
INSERT INTO `bsr_expenses` VALUES (2575,500,45.45,1,'',NULL,'2015-01-26 13:00:00','2015-01-26 13:00:00','income',NULL,100,NULL,'workbook',95,16,0,0,0),(2576,400,36.36,1,'',NULL,'2015-01-26 13:00:00','2015-01-26 13:00:00','income',NULL,100,NULL,'workbook',99,16,0,0,0),(2577,1000,0,0,'',NULL,'2015-01-26 13:00:00','2015-01-26 13:00:00','income',NULL,100,NULL,'workbook',62,1,0,0,0),(2578,5000,454.55,1,'Stuff',NULL,'2015-01-26 13:00:00','2015-01-26 13:00:00','income',NULL,100,NULL,'workbook',106,11,0,0,0),(2579,3280,298.18181818182,1,'INTERNET BPAY VIRGIN MONEY 4724373520085182\r\n',NULL,'2014-12-30 13:00:00','2014-12-30 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2580,2000,181.81818181818,1,'INTERNET BPAY TAX OFFICE PAYMENTS 425655644567360\r\n',NULL,'2014-12-30 13:00:00','2014-12-30 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2581,0.07,0.0063636363636364,1,'INTEREST\r\n',NULL,'2014-12-30 13:00:00','2014-12-30 13:00:00','income',NULL,100,NULL,'banking',0,11,17,0,0),(2582,9776.25,888.75,1,'Astute Payroll Astute Corporati Grant McCall\r\n',NULL,'2014-12-29 13:00:00','2014-12-29 13:00:00','income',NULL,100,NULL,'banking',0,11,17,0,0),(2583,34.95,3.1772727272727,1,'V0284 24/12 gdwebhos t 040 9262123 74100454361\r\n',NULL,'2014-12-28 13:00:00','2014-12-28 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2584,9.07,0.82454545454545,1,'V0284 23/12 FOREIGN CURRENCY TRAN FEE 74598374357\r\n',NULL,'2014-12-28 13:00:00','2014-12-28 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2585,7.5,0.68181818181818,1,'INTERNET TRANSFER CASH TRANSFER\r\n',NULL,'2014-12-28 13:00:00','2014-12-28 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2586,5,0.45454545454545,1,'V0284 23/12 OVERSEAS ATM TRANS FEE 74598374357\r\n',NULL,'2014-12-28 13:00:00','2014-12-28 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2587,302.49,27.499090909091,1,'V0284 23/12 MEINL BA NK WIE N 74598374357\r\n',NULL,'2014-12-23 13:00:00','2014-12-23 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2588,9.05,0.82272727272727,1,'V0284 20/12 FOREIGN CURRENCY TRAN FEE 74598374354\r\n',NULL,'2014-12-23 13:00:00','2014-12-23 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2589,5,0.45454545454545,1,'V0284 20/12 OVERSEAS ATM TRANS FEE 74598374354\r\n',NULL,'2014-12-23 13:00:00','2014-12-23 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2590,301.53,27.411818181818,1,'V0284 20/12 UNICREDI T BANK AUSTRIA AGWIE N 74598374354\r\n',NULL,'2014-12-22 13:00:00','2014-12-22 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2591,11.02,1.0018181818182,1,'V0284 20/12 SUPREX I NTERNATIONAL D BEO GRAD 74187354355\r\n',NULL,'2014-12-22 13:00:00','2014-12-22 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2592,6.63,0.60272727272727,1,'V0284 20/12 WIENER L INIEN 3038 Wie n 74830174355\r\n',NULL,'2014-12-22 13:00:00','2014-12-22 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2593,5.76,0.52363636363636,1,'V0284 19/12 AU BEOGR AD PRVI MAJ BEO GRAD 74174754356\r\n',NULL,'2014-12-22 13:00:00','2014-12-22 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2594,0.33,0.03,1,'V0284 20/12 FOREIGN CURRENCY TRAN FEE 74187354355\r\n',NULL,'2014-12-22 13:00:00','2014-12-22 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2595,0.2,0.018181818181818,1,'V0284 20/12 FOREIGN CURRENCY TRAN FEE 74830174355\r\n',NULL,'2014-12-22 13:00:00','2014-12-22 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2596,0.17,0.015454545454545,1,'V0284 19/12 FOREIGN CURRENCY TRAN FEE 74174754356\r\n',NULL,'2014-12-22 13:00:00','2014-12-22 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2597,210,19.090909090909,1,'Monthly Bonus G McCall Grant McCall\r\n',NULL,'2014-12-21 13:00:00','2014-12-21 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2598,50,4.5454545454545,1,'INTERNET TRANSFER Mums xmas pressie\r\n',NULL,'2014-12-18 13:00:00','2014-12-18 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2599,0.19,0.017272727272727,1,'V0284 15/12 FOREIGN CURRENCY TRAN FEE 74381614349\r\n',NULL,'2014-12-16 13:00:00','2014-12-16 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2600,0.16,0.014545454545455,1,'V0284 15/12 FOREIGN CURRENCY TRAN FEE 74187354350\r\n',NULL,'2014-12-16 13:00:00','2014-12-16 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2601,6.23,0.56636363636364,1,'V0284 15/12 TIJANA-I ZTCR BEO GRAD 74381614349\r\n',NULL,'2014-12-15 13:00:00','2014-12-15 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2602,5.36,0.48727272727273,1,'V0284 15/12 DVA-STAP ICA 021 DOO BE NOV I BEOGR 74187354350\r\n',NULL,'2014-12-15 13:00:00','2014-12-15 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2603,1500,136.36363636364,1,'INTERNET TRANSFER Video Editing\r\n',NULL,'2014-12-11 13:00:00','2014-12-11 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2604,4900,445.45454545455,1,'INTERNET BPAY VIRGIN MONEY 4724373520085182\r\n',NULL,'2014-12-10 13:00:00','2014-12-10 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2605,1500,136.36363636364,1,'INTERNET BPAY TAX OFFICE PAYMENTS 425655644567360\r\n',NULL,'2014-12-10 13:00:00','2014-12-10 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2606,7206.38,655.12545454545,1,'INTERNET TRANSFER HOMECAMP WEBSITE HOMECAMP\r\n',NULL,'2014-12-09 13:00:00','2014-12-09 13:00:00','income',NULL,100,NULL,'banking',0,11,17,0,0),(2607,0.14,0.012727272727273,1,'V0284 05/12 FOREIGN CURRENCY TRAN FEE 74187354340\r\n',NULL,'2014-12-08 13:00:00','2014-12-08 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2608,4.67,0.42454545454545,1,'V0284 05/12 SUPREX I NTERNATIONAL D BEO GRAD 74187354340\r\n',NULL,'2014-12-07 13:00:00','2014-12-07 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2609,500,45.454545454545,1,'INTERNET TRANSFER Cash\r\n',NULL,'2014-12-04 13:00:00','2014-12-04 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2610,0.34,0.030909090909091,1,'V0284 03/12 FOREIGN CURRENCY TRAN FEE 74648924338\r\n',NULL,'2014-12-04 13:00:00','2014-12-04 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2611,11.21,1.0190909090909,1,'V0284 03/12 ATECHMED IA.COMCHARGE +44 1202901 74648924338\r\n',NULL,'2014-12-03 13:00:00','2014-12-03 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2612,7.5,0.68181818181818,1,'INTERNET TRANSFER CASH TRANSFER\r\n',NULL,'2014-11-30 13:00:00','2014-11-30 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2613,9000,818.18181818182,1,'INTERNET BPAY VIRGIN MONEY 4724373520085182\r\n',NULL,'2014-11-25 13:00:00','2014-11-25 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2614,34.95,3.1772727272727,1,'V0284 24/11 gdwebhos t 040 9262123 74100454329\r\n',NULL,'2014-11-25 13:00:00','2014-11-25 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2615,5,0.45454545454545,1,'V0284 24/11 OVERSEAS ATM TRANS FEE 74168904328\r\n',NULL,'2014-11-25 13:00:00','2014-11-25 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2616,3.6,0.32727272727273,1,'V0284 24/11 FOREIGN CURRENCY TRAN FEE 74168904328\r\n',NULL,'2014-11-25 13:00:00','2014-11-25 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2617,1.08,0.098181818181818,1,'V0284 21/11 FOREIGN CURRENCY TRAN FEE 74787794326\r\n',NULL,'2014-11-25 13:00:00','2014-11-25 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2618,0.48,0.043636363636364,1,'V0284 24/11 FOREIGN CURRENCY TRAN FEE 74187354329\r\n',NULL,'2014-11-25 13:00:00','2014-11-25 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2619,120.03,10.911818181818,1,'V0284 24/11 SBERBANK SRBIJ/BEOGRAD,CABEO GRAD 74168904328\r\n',NULL,'2014-11-24 13:00:00','2014-11-24 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2620,36.02,3.2745454545455,1,'V0284 21/11 HOME CEN TER-USCE K4 NOV I BEOGR 74787794326\r\n',NULL,'2014-11-24 13:00:00','2014-11-24 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2621,15.86,1.4418181818182,1,'V0284 24/11 Z.U. APO TEKA LILLY DRO NOV I BEOGR 74187354329\r\n',NULL,'2014-11-24 13:00:00','2014-11-24 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2622,1000,90.909090909091,1,'Serbia EVA MEZEI Grant McCall\r\n',NULL,'2014-11-24 13:00:00','2014-11-24 13:00:00','income',NULL,100,NULL,'banking',0,11,17,0,0),(2623,9000,818.18181818182,1,'Cash\r\n',NULL,'2014-11-24 13:00:00','2014-11-24 13:00:00','income',NULL,100,NULL,'banking',0,11,17,0,0),(2624,550,50,1,'DIBBLE WORK MR WILLIAM COVER GRANT MCCALL\r\n',NULL,'2014-11-23 13:00:00','2014-11-23 13:00:00','income',NULL,100,NULL,'banking',0,11,17,0,0),(2625,210,19.090909090909,1,'Monthly Bonus G McCall Grant McCall\r\n',NULL,'2014-11-20 13:00:00','2014-11-20 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2626,5,0.45454545454545,1,'V0284 19/11 OVERSEAS ATM TRANS FEE 74168904323\r\n',NULL,'2014-11-20 13:00:00','2014-11-20 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2627,3.64,0.33090909090909,1,'V0284 19/11 FOREIGN CURRENCY TRAN FEE 74168904323\r\n',NULL,'2014-11-20 13:00:00','2014-11-20 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2628,2100,190.90909090909,1,'INTERNET BPAY VIRGIN MONEY 4724373520085182\r\n',NULL,'2014-11-19 13:00:00','2014-11-19 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2629,121.28,11.025454545455,1,'V0284 19/11 SBERBANK SRBIJ/BEOGRAD,CABEO GRAD 74168904323\r\n',NULL,'2014-11-19 13:00:00','2014-11-19 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2630,0.7,0.063636363636364,1,'V0284 17/11 FOREIGN CURRENCY TRAN FEE 74187354322\r\n',NULL,'2014-11-18 13:00:00','2014-11-18 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2631,23.49,2.1354545454545,1,'V0284 17/11 SUPREX I NTERNATIONAL D BEO GRAD 74187354322\r\n',NULL,'2014-11-17 13:00:00','2014-11-17 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2632,5,0.45454545454545,1,'V0284 13/11 OVERSEAS ATM TRANS FEE 74168904317\r\n',NULL,'2014-11-16 13:00:00','2014-11-16 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2633,3.59,0.32636363636364,1,'V0284 13/11 FOREIGN CURRENCY TRAN FEE 74168904317\r\n',NULL,'2014-11-16 13:00:00','2014-11-16 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2634,119.72,10.883636363636,1,'V0284 13/11 SBERBANK SRBIJ/BEOGRAD,CABEO GRAD 74168904317\r\n',NULL,'2014-11-13 13:00:00','2014-11-13 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2635,3851.38,350.12545454545,1,'Odecee Invoice 026 Odecee Pty Ltd A Grant McCall\r\n',NULL,'2014-11-13 13:00:00','2014-11-13 13:00:00','income',NULL,100,NULL,'banking',0,11,17,0,0),(2636,0.18,0.016363636363636,1,'V0284 10/11 FOREIGN CURRENCY TRAN FEE 74787794315\r\n',NULL,'2014-11-12 13:00:00','2014-11-12 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2637,5.99,0.54454545454545,1,'V0284 10/11 TELENOR GLAVNA PROD. BEO GRAD 74787794315\r\n',NULL,'2014-11-11 13:00:00','2014-11-11 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2638,5,0.45454545454545,1,'V0284 10/11 OVERSEAS ATM TRANS FEE 74187344314\r\n',NULL,'2014-11-11 13:00:00','2014-11-11 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2639,4.38,0.39818181818182,1,'V0284 10/11 SCHWEIZ. BUNDESBAHN BER N 74627644316\r\n',NULL,'2014-11-11 13:00:00','2014-11-11 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2640,1.81,0.16454545454545,1,'V0284 10/11 FOREIGN CURRENCY TRAN FEE 74187344314\r\n',NULL,'2014-11-11 13:00:00','2014-11-11 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2641,0.29,0.026363636363636,1,'V0284 09/11 FOREIGN CURRENCY TRAN FEE 74627644315\r\n',NULL,'2014-11-11 13:00:00','2014-11-11 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2642,60.18,5.4709090909091,1,'V0284 10/11 BANKA IN TESA B/Kralja MilBeo grad 74187344314\r\n',NULL,'2014-11-10 13:00:00','2014-11-10 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2643,9.65,0.87727272727273,1,'V0284 09/11 AL-NARJI SE SARL GEN EVE 74627644315\r\n',NULL,'2014-11-10 13:00:00','2014-11-10 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2644,1.3,0.11818181818182,1,'V0284 08/11 FOREIGN CURRENCY TRAN FEE 74974004312\r\n',NULL,'2014-11-10 13:00:00','2014-11-10 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2645,1.2,0.10909090909091,1,'V0284 09/11 FOREIGN CURRENCY TRAN FEE 74970114313\r\n',NULL,'2014-11-10 13:00:00','2014-11-10 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2646,0.48,0.043636363636364,1,'V0284 08/11 FOREIGN CURRENCY TRAN FEE 74972004312\r\n',NULL,'2014-11-10 13:00:00','2014-11-10 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2647,0.46,0.041818181818182,1,'V0284 09/11 FOREIGN CURRENCY TRAN FEE 74976064313\r\n',NULL,'2014-11-10 13:00:00','2014-11-10 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2648,0.07,0.0063636363636364,1,'V0284 06/11 FOREIGN CURRENCY TRAN FEE 74974004313\r\n',NULL,'2014-11-10 13:00:00','2014-11-10 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2649,43.47,3.9518181818182,1,'V0284 08/11 EURL BUL UT 4123377 69L YON 8 74974004312\r\n',NULL,'2014-11-09 13:00:00','2014-11-09 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2650,39.85,3.6227272727273,1,'V0284 09/11 SNCF LYO N 74970114313\r\n',NULL,'2014-11-09 13:00:00','2014-11-09 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2651,15.94,1.4490909090909,1,'V0284 08/11 UGC BORN ES CCLYO2412474 CCL YO24124 74972004312\r\n',NULL,'2014-11-09 13:00:00','2014-11-09 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2652,15.36,1.3963636363636,1,'V0284 09/11 WALLACE BAR LYO N 74976064313\r\n',NULL,'2014-11-09 13:00:00','2014-11-09 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2653,5,0.45454545454545,1,'V0284 06/11 OVERSEAS ATM TRANS FEE 74977834310\r\n',NULL,'2014-11-09 13:00:00','2014-11-09 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2654,2.63,0.23909090909091,1,'V0284 06/11 FOREIGN CURRENCY TRAN FEE 74977834310\r\n',NULL,'2014-11-09 13:00:00','2014-11-09 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2655,2.17,0.19727272727273,1,'V0284 06/11 JCDECAUX VELOV 4918017 92N EUILLY 74974004313\r\n',NULL,'2014-11-09 13:00:00','2014-11-09 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2656,1.28,0.11636363636364,1,'V0284 04/11 FOREIGN CURRENCY TRAN FEE 74627644311\r\n',NULL,'2014-11-09 13:00:00','2014-11-09 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2657,87.57,7.9609090909091,1,'V0284 06/11 CCM LYON BELLECOUR LYO N CEDEX 74977834310\r\n',NULL,'2014-11-06 13:00:00','2014-11-06 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2658,42.62,3.8745454545455,1,'V0284 04/11 AL-NARJI SE SARL GEN EVE 74627644311\r\n',NULL,'2014-11-06 13:00:00','2014-11-06 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2659,0.9,0.081818181818182,1,'V0284 03/11 FOREIGN CURRENCY TRAN FEE 74950514308\r\n',NULL,'2014-11-06 13:00:00','2014-11-06 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2660,1500,136.36363636364,1,'INTERNET TRANSFER Video Editing\r\n',NULL,'2014-11-05 13:00:00','2014-11-05 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2661,600,54.545454545455,1,'INTERNET BPAY TAX OFFICE PAYMENTS 425655644567360\r\n',NULL,'2014-11-05 13:00:00','2014-11-05 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2662,250,22.727272727273,1,'INTERNET BPAY VIRGIN MONEY 4724373520085182\r\n',NULL,'2014-11-05 13:00:00','2014-11-05 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2663,5.21,0.47363636363636,1,'52WJ28EZK6EXG PAYPAL AUSTRALIA GRANT MCCALL\r\n',NULL,'2014-11-05 13:00:00','2014-11-05 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2664,29.89,2.7172727272727,1,'V0284 03/11 Aperto G en ve Gen eve 74950514308\r\n',NULL,'2014-11-04 13:00:00','2014-11-04 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2665,5,0.45454545454545,1,'V0284 02/11 OVERSEAS ATM TRANS FEE 74687644306\r\n',NULL,'2014-11-03 13:00:00','2014-11-03 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2666,2.36,0.21454545454545,1,'V0284 01/11 FOREIGN CURRENCY TRAN FEE 74970114305\r\n',NULL,'2014-11-03 13:00:00','2014-11-03 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2667,1.79,0.16272727272727,1,'V0284 02/11 FOREIGN CURRENCY TRAN FEE 74687644306\r\n',NULL,'2014-11-03 13:00:00','2014-11-03 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2668,78.75,7.1590909090909,1,'V0284 01/11 SNCF LYO N 74970114305\r\n',NULL,'2014-11-02 13:00:00','2014-11-02 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2669,59.71,5.4281818181818,1,'V0284 02/11 BANQUE D U LEMAN BANCO GENGen eve 74687644306\r\n',NULL,'2014-11-02 13:00:00','2014-11-02 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2670,1.31,0.11909090909091,1,'V0284 27/10 FOREIGN CURRENCY TRAN FEE 74976064300\r\n',NULL,'2014-10-29 13:00:00','2014-10-29 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2671,43.61,3.9645454545455,1,'V0284 27/10 TCL LYO N 74976064300\r\n',NULL,'2014-10-28 13:00:00','2014-10-28 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2672,7.5,0.68181818181818,1,'INTERNET TRANSFER CASH TRANSFER\r\n',NULL,'2014-10-28 13:00:00','2014-10-28 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2673,1.11,0.10090909090909,1,'V0284 26/10 FOREIGN CURRENCY TRAN FEE 74533784300\r\n',NULL,'2014-10-28 13:00:00','2014-10-28 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2674,0.5,0.045454545454545,1,'V0284 26/10 FOREIGN CURRENCY TRAN FEE 74971004300\r\n',NULL,'2014-10-28 13:00:00','2014-10-28 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2675,2750,250,1,'INTERNET TRANSFER Soleurs deposit Doron Francis\r\n',NULL,'2014-10-28 13:00:00','2014-10-28 13:00:00','income',NULL,100,NULL,'banking',0,11,17,0,0),(2676,36.85,3.35,1,'V0284 26/10 CHINA EX UPERY BRO N 74533784300\r\n',NULL,'2014-10-27 13:00:00','2014-10-27 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2677,16.76,1.5236363636364,1,'V0284 26/10 KING ART HUR 69L YON 02 74971004300\r\n',NULL,'2014-10-27 13:00:00','2014-10-27 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2678,34.95,3.1772727272727,1,'V0284 24/10 GDWEBHOS T 877 -294027 74889174297\r\n',NULL,'2014-10-26 13:00:00','2014-10-26 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2679,210,19.090909090909,1,'Monthly Bonus G McCall Grant McCall\r\n',NULL,'2014-10-20 13:00:00','2014-10-20 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2680,44.99,4.09,1,'V0284 16/10 GAVIDIA MARKET SEV ILLA 74106264289\r\n',NULL,'2014-10-19 13:00:00','2014-10-19 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2681,0.17,0.015454545454545,1,'V0284 15/10 FOREIGN CURRENCY TRAN FEE 74548984288\r\n',NULL,'2014-10-16 13:00:00','2014-10-16 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2682,7050,640.90909090909,1,'INTERNET BPAY VIRGIN MONEY 4724373520085182\r\n',NULL,'2014-10-15 13:00:00','2014-10-15 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2683,1800,163.63636363636,1,'INTERNET BPAY TAX OFFICE PAYMENTS 425655644567360\r\n',NULL,'2014-10-15 13:00:00','2014-10-15 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2684,1000,90.909090909091,1,'INTERNET TRANSFER 996115433262\r\n',NULL,'2014-10-15 13:00:00','2014-10-15 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2685,5.5,0.5,1,'V0284 15/10 ARS-PRAN SOR SA ALM ODOVAR 74548984288\r\n',NULL,'2014-10-15 13:00:00','2014-10-15 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2686,5,0.45454545454545,1,'V0284 13/10 OVERSEAS ATM TRANS FEE 74934024286\r\n',NULL,'2014-10-15 13:00:00','2014-10-15 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2687,4.37,0.39727272727273,1,'V0284 13/10 FOREIGN CURRENCY TRAN FEE 74934024286\r\n',NULL,'2014-10-15 13:00:00','2014-10-15 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2688,145.6,13.236363636364,1,'V0284 13/10 Av D Car los I, 45-49 LIS BOA 74934024286\r\n',NULL,'2014-10-14 13:00:00','2014-10-14 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2689,0.88,0.08,1,'V0284 13/10 FOREIGN CURRENCY TRAN FEE 74548984286\r\n',NULL,'2014-10-14 13:00:00','2014-10-14 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2690,0.52,0.047272727272727,1,'V0284 13/10 FOREIGN CURRENCY TRAN FEE 74548984286\r\n',NULL,'2014-10-14 13:00:00','2014-10-14 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2691,50,4.5454545454545,1,'Lisbon EVA MEZEI Grant McCall\r\n',NULL,'2014-10-14 13:00:00','2014-10-14 13:00:00','income',NULL,100,NULL,'banking',0,11,17,0,0),(2692,29.18,2.6527272727273,1,'V0284 13/10 FOOT LOC KER LIS BOA 74548984286\r\n',NULL,'2014-10-13 13:00:00','2014-10-13 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2693,17.23,1.5663636363636,1,'V0284 13/10 THE OLD PHARMACY WINE LIS BOA 74548984286\r\n',NULL,'2014-10-13 13:00:00','2014-10-13 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2694,6.55,0.59545454545455,1,'V0284 10/10 FOREIGN CURRENCY TRAN FEE 74934024283\r\n',NULL,'2014-10-13 13:00:00','2014-10-13 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2695,5,0.45454545454545,1,'V0284 12/10 OVERSEAS ATM TRANS FEE 74934024285\r\n',NULL,'2014-10-13 13:00:00','2014-10-13 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2696,5,0.45454545454545,1,'V0284 10/10 OVERSEAS ATM TRANS FEE 74934024283\r\n',NULL,'2014-10-13 13:00:00','2014-10-13 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2697,4.36,0.39636363636364,1,'V0284 12/10 FOREIGN CURRENCY TRAN FEE 74934024285\r\n',NULL,'2014-10-13 13:00:00','2014-10-13 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2698,218.23,19.839090909091,1,'V0284 10/10 Pc Luis de Camoes,27 LIS BOA 74934024283\r\n',NULL,'2014-10-12 13:00:00','2014-10-12 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2699,145.49,13.226363636364,1,'V0284 12/10 Estacao CP-Cais do Sodr Lis boa 74934024285\r\n',NULL,'2014-10-12 13:00:00','2014-10-12 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2700,1.37,0.12454545454545,1,'V0284 08/10 FOREIGN CURRENCY TRAN FEE 74106264281\r\n',NULL,'2014-10-12 13:00:00','2014-10-12 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2701,0.87,0.079090909090909,1,'V0284 09/10 FOREIGN CURRENCY TRAN FEE 74106264282\r\n',NULL,'2014-10-12 13:00:00','2014-10-12 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2702,0.48,0.043636363636364,1,'V0284 09/10 FOREIGN CURRENCY TRAN FEE 74509464282\r\n',NULL,'2014-10-12 13:00:00','2014-10-12 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2703,1200,109.09090909091,1,'INTERNET BPAY VIRGIN MONEY 4724373520085182\r\n',NULL,'2014-10-09 13:00:00','2014-10-09 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2704,45.59,4.1445454545455,1,'V0284 08/10 ONEILLS ADRIANO SEV ILLA 74106264281\r\n',NULL,'2014-10-09 13:00:00','2014-10-09 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2705,28.95,2.6318181818182,1,'V0284 09/10 RESTAURA NTE PUERTA REAL SEV ILLA 74106264282\r\n',NULL,'2014-10-09 13:00:00','2014-10-09 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2706,16.06,1.46,1,'V0284 09/10 BAR LA P AJARITA SEV ILLA 74509464282\r\n',NULL,'2014-10-09 13:00:00','2014-10-09 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2707,17.89,1.6263636363636,1,'Transaction Fee Refund - VDC\r\n',NULL,'2014-10-09 13:00:00','2014-10-09 13:00:00','income',NULL,100,NULL,'banking',0,11,17,0,0),(2708,10161.27,923.75181818182,1,'Odecee Invoice 025 Odecee Pty Ltd A Grant McCall\r\n',NULL,'2014-10-09 13:00:00','2014-10-09 13:00:00','income',NULL,100,NULL,'banking',0,11,17,0,0),(2709,0.84,0.076363636363636,1,'V0284 06/10 FOREIGN CURRENCY TRAN FEE 74106264279\r\n',NULL,'2014-10-07 13:00:00','2014-10-07 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2710,27.9,2.5363636363636,1,'V0284 06/10 GAVIDIA MARKET SEV ILLA 74106264279\r\n',NULL,'2014-10-06 13:00:00','2014-10-06 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2711,5,0.45454545454545,1,'V0284 02/10 OVERSEAS ATM TRANS FEE 74091024275\r\n',NULL,'2014-10-06 13:00:00','2014-10-06 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2712,4.78,0.43454545454545,1,'V0284 02/10 FOREIGN CURRENCY TRAN FEE 74091024275\r\n',NULL,'2014-10-06 13:00:00','2014-10-06 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2713,159.18,14.470909090909,1,'V0284 02/10 ATM 3004 B. POPULAR 1 SEV ILLA 74091024275\r\n',NULL,'2014-10-05 13:00:00','2014-10-05 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2714,62.84,5.7127272727273,1,'V0284 04/10 la canti na mexicana SEV ILLA 74509464277\r\n',NULL,'2014-10-05 13:00:00','2014-10-05 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2715,5.31,0.48272727272727,1,'52WJ28DA5KJPW PAYPAL AUSTRALIA GRANT MCCALL\r\n',NULL,'2014-10-05 13:00:00','2014-10-05 13:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2716,1500,136.36363636364,1,'INTERNET BPAY VIRGIN MONEY 4724373520085182\r\n',NULL,'2014-10-01 14:00:00','2014-10-01 14:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2717,0.56,0.050909090909091,1,'V0284 29/09 FOREIGN CURRENCY TRAN FEE 74509464272\r\n',NULL,'2014-09-30 14:00:00','2014-09-30 14:00:00','purchase',NULL,100,NULL,'banking',0,11,17,0,0),(2718,3280,298.18181818182,1,'BPAY PAYMENTS\n',NULL,'2014-12-30 13:00:00','2014-12-30 13:00:00','income',NULL,100,NULL,'banking',0,11,18,0,0),(2719,48.5,4.4090909090909,1,'JEGY-E\'S BE\'RLETPE\'NZT   BUDAPEST     HU HUF 9,900.00\n',NULL,'2014-12-27 13:00:00','2014-12-27 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2720,724.63,65.875454545455,1,'Seewirt Zauner           Hallstatt    AT EUR 465.60\n',NULL,'2014-12-25 13:00:00','2014-12-25 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2721,82.48,7.4981818181818,1,'Ibis Budget Wien St. MarxWien         AT EUR 53.00\n',NULL,'2014-12-25 13:00:00','2014-12-25 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2722,321.85,29.259090909091,1,'OEBB REISEBUERO          WIEN         AT EUR 206.80\n',NULL,'2014-12-22 13:00:00','2014-12-22 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2723,15.26,1.3872727272727,1,'GH GITHUB.COM    FRU1    4154486673   US USD 12.00\n',NULL,'2014-12-20 13:00:00','2014-12-20 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2724,49.99,4.5445454545455,1,'ADOBE SYSTEMS SOFTWARE   044-207-3650 IE\n',NULL,'2014-12-20 13:00:00','2014-12-20 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2725,11.99,1.09,1,'Spotify Premium x 1      nr  499475898AU\n',NULL,'2014-12-19 13:00:00','2014-12-19 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2726,64.87,5.8972727272727,1,'OPTUS BILLING AUTOPAY    MACQUARIE PARAU\n',NULL,'2014-12-18 13:00:00','2014-12-18 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2727,76.92,6.9927272727273,1,'ZARA BG                  BEOGRAD      RS RSD 5,990.00\n',NULL,'2014-12-18 13:00:00','2014-12-18 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2728,149.99,13.635454545455,1,'N SPORT PRODAVNICA 57    BEOGRAD      RS RSD 11,680.00\n',NULL,'2014-12-18 13:00:00','2014-12-18 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2729,22.2,2.0181818181818,1,'INTEREST CHARGED            -CASH\n',NULL,'2014-12-18 13:00:00','2014-12-18 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2730,5.38,0.48909090909091,1,'VIRGIN MONEY CREDITSHIELD\n',NULL,'2014-12-18 13:00:00','2014-12-18 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2731,1000,90.909090909091,1,'PAYPAL *PATELDEVANG      4029357733   AU\n',NULL,'2014-12-17 13:00:00','2014-12-17 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2732,888.49,80.771818181818,1,'WesternUnion             1800173833   AU\n',NULL,'2014-12-14 13:00:00','2014-12-14 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2733,12.55,1.1409090909091,1,'FORGE.LARAVEL.COM        4792266733   US USD 10.00\n',NULL,'2014-12-13 13:00:00','2014-12-13 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2734,84.95,7.7227272727273,1,'SONY ENT NETWORK         INTERNET     GB\n',NULL,'2014-12-11 13:00:00','2014-12-11 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2735,25.48,2.3163636363636,1,'ORFELIN NAUCNI DOO       BEOGRAD      RS RSD 1,980.00\n',NULL,'2014-12-11 13:00:00','2014-12-11 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2736,4900,445.45454545455,1,'BPAY PAYMENTS\n',NULL,'2014-12-10 13:00:00','2014-12-10 13:00:00','income',NULL,100,NULL,'banking',0,11,18,0,0),(2737,61.79,5.6172727272727,1,'ELANCE EEC               DUBLIN       IE\n',NULL,'2014-12-10 13:00:00','2014-12-10 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2738,161.79,14.708181818182,1,'FUDEKS                   BEOGRAD      RS RSD 12,650.00\n',NULL,'2014-12-09 13:00:00','2014-12-09 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2739,90,8.1818181818182,1,'PAYPAL *BN EFFECTS       4029357733   AU\n',NULL,'2014-12-08 13:00:00','2014-12-08 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2740,473.72,43.065454545455,1,'PAYPAL *MAGGIEY17        4029357733   AU\n',NULL,'2014-12-07 13:00:00','2014-12-07 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2741,1000,90.909090909091,1,'PAYPAL *PATELDEVANG      4029357733   AU\n',NULL,'2014-12-04 13:00:00','2014-12-04 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2742,25.49,2.3172727272727,1,'TICKETEK PTY LTD WEB     SYDNEY       AU\n',NULL,'2014-12-03 13:00:00','2014-12-03 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2743,5.09,0.46272727272727,1,'Amazon Web Services      aws.amazon.coUS USD 4.16\n',NULL,'2014-12-02 13:00:00','2014-12-02 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2744,20,1.8181818181818,1,'GOOGLE*SVCSAPPSWALLAMBA-CSINGAPORE    SG\n',NULL,'2014-12-02 13:00:00','2014-12-02 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2745,181.27,16.479090909091,1,'SPORT VISION PJ CHAMPION BEOGRAD      RS RSD 14,270.00\n',NULL,'2014-12-02 13:00:00','2014-12-02 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2746,154.58,14.052727272727,1,'DJAK 071                 BEOGRAD      RS RSD 12,170.00\n',NULL,'2014-12-02 13:00:00','2014-12-02 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2747,29,2.6363636363636,1,'MYOB AUSTRALIA           BURWOOD EAST AU\n',NULL,'2014-12-01 13:00:00','2014-12-01 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2748,12.25,1.1136363636364,1,'DIGITALOCEAN.COM         6463978051   US USD 10.00\n',NULL,'2014-11-30 13:00:00','2014-11-30 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2749,364.55,33.140909090909,1,'Hotel Reither            Wien         AT EUR 240.30\n',NULL,'2014-11-29 13:00:00','2014-11-29 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2750,2530,230,1,'WesternUnion             1800173833   AU\n',NULL,'2014-11-28 13:00:00','2014-11-28 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2751,33,3,1,'Stripe                   Sydney NSW 20AU\n',NULL,'2014-11-26 13:00:00','2014-11-26 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2752,9000,818.18181818182,1,'BPAY PAYMENTS\n',NULL,'2014-11-25 13:00:00','2014-11-25 13:00:00','income',NULL,100,NULL,'banking',0,11,18,0,0),(2753,31.95,2.9045454545455,1,'SONY ENT NETWORK         INTERNET     GB\n',NULL,'2014-11-25 13:00:00','2014-11-25 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2754,71.57,6.5063636363636,1,'STK*SHUTTERSTOCK, INC.   866-663-3954 US USD 59.00\n',NULL,'2014-11-24 13:00:00','2014-11-24 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2755,283.2,25.745454545455,1,'FINES VIC - INTERNET     MELBOURNE    AU\n',NULL,'2014-11-24 13:00:00','2014-11-24 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2756,238.66,21.696363636364,1,'PAYPAL *THEMUSICBED      4029357733   US\n',NULL,'2014-11-23 13:00:00','2014-11-23 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2757,72.08,6.5527272727273,1,'STOCKSY.COM              2505907308   CA USD 60.00\n',NULL,'2014-11-23 13:00:00','2014-11-23 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2758,8.39,0.76272727272727,1,'GH *GITHUB.COM    FRU1   4154486673   US USD 7.00\n',NULL,'2014-11-20 13:00:00','2014-11-20 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2759,49.99,4.5445454545455,1,'ADOBE SYSTEMS SOFTWARE   044-207-3650 IE\n',NULL,'2014-11-20 13:00:00','2014-11-20 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2760,1525.11,138.64636363636,1,'BIG BANG                 BEOGRAD      RS RSD 123,030.50\n',NULL,'2014-11-20 13:00:00','2014-11-20 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2761,24.56,2.2327272727273,1,'INTEREST CHARGED PRIOR MTH  -RETAIL\n',NULL,'2014-11-20 13:00:00','2014-11-20 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2762,88.64,8.0581818181818,1,'INTEREST CHARGED            -RETAIL\n',NULL,'2014-11-20 13:00:00','2014-11-20 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2763,20.47,1.8609090909091,1,'INTEREST CHARGED            -CASH\n',NULL,'2014-11-20 13:00:00','2014-11-20 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2764,31.71,2.8827272727273,1,'VIRGIN MONEY CREDITSHIELD\n',NULL,'2014-11-20 13:00:00','2014-11-20 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2765,20.85,1.8954545454545,1,'EBAY INTL AG - AU        888-749-3229 AU\n',NULL,'2014-11-19 13:00:00','2014-11-19 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2766,2100,190.90909090909,1,'BPAY PAYMENTS\n',NULL,'2014-11-19 13:00:00','2014-11-19 13:00:00','income',NULL,100,NULL,'banking',0,11,18,0,0),(2767,11.99,1.09,1,'Spotify Premium x 1      nr  476986160AU\n',NULL,'2014-11-19 13:00:00','2014-11-19 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2768,64.93,5.9027272727273,1,'OPTUS BILLING AUTOPAY    MACQUARIE PARAU\n',NULL,'2014-11-18 13:00:00','2014-11-18 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2769,16,1.4545454545455,1,'SKYPE COMMUNICATIO       LUXEMBOURG   LU\n',NULL,'2014-11-17 13:00:00','2014-11-17 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2770,35.7,3.2454545454545,1,'PAYPAL *TWENTYFOURT      4029357733   AU\n',NULL,'2014-11-16 13:00:00','2014-11-16 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2771,5.96,0.54181818181818,1,'Wunderkinder.com         Berlin       DE USD 4.99\n',NULL,'2014-11-14 13:00:00','2014-11-14 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2772,11.94,1.0854545454545,1,'FORGE.LARAVEL.COM        4792266733   US USD 10.00\n',NULL,'2014-11-13 13:00:00','2014-11-13 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2773,1.99,0.18090909090909,1,'TELSTRA APPLICATIONS     MELBOURNE    AU\n',NULL,'2014-11-13 13:00:00','2014-11-13 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2774,1210.7,110.06363636364,1,'WesternUnion             1800173833   AU\n',NULL,'2014-11-13 13:00:00','2014-11-13 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2775,36.34,3.3036363636364,1,'DEFT PAYMENTS            SYDNEY       AU\n',NULL,'2014-11-12 13:00:00','2014-11-12 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2776,38.91,3.5372727272727,1,'DEM PUB                  69LYON       FR EUR 26.00\n',NULL,'2014-11-07 13:00:00','2014-11-07 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2777,53.88,4.8981818181818,1,'LE JAMES JOYCE           LYON         FR EUR 36.00\n',NULL,'2014-11-07 13:00:00','2014-11-07 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2778,1.99,0.18090909090909,1,'TELSTRA APPLICATIONS     MELBOURNE    AU\n',NULL,'2014-11-06 13:00:00','2014-11-06 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2779,45.34,4.1218181818182,1,'KELLY S PUBS             69LYON       FR EUR 30.30\n',NULL,'2014-11-06 13:00:00','2014-11-06 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2780,270.29,24.571818181818,1,'CELIO           2012307  CELIO00181  /FR EUR 180.58\n',NULL,'2014-11-06 13:00:00','2014-11-06 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2781,250,22.727272727273,1,'BPAY PAYMENTS\n',NULL,'2014-11-05 13:00:00','2014-11-05 13:00:00','income',NULL,100,NULL,'banking',0,11,18,0,0),(2782,10,0.90909090909091,1,'LATE PAYMENT FEE\n',NULL,'2014-11-04 13:00:00','2014-11-04 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2783,137.17,12.47,1,'EASYJET     000END66NN   LUTON        GB USD 113.73\n',NULL,'2014-11-04 13:00:00','2014-11-04 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2784,78.47,7.1336363636364,1,'Manor AG - 209           Geneve 1     CH CHF 62.90\n',NULL,'2014-11-03 13:00:00','2014-11-03 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2785,54.43,4.9481818181818,1,'GENEVE CFF               GENEVE       CH\n',NULL,'2014-11-03 13:00:00','2014-11-03 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2786,5.07,0.46090909090909,1,'Amazon Web Services      aws.amazon.coUS USD 4.27\n',NULL,'2014-11-02 13:00:00','2014-11-02 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2787,1500,136.36363636364,1,'PAYPAL *PATELDEVANG      4029357733   AU\n',NULL,'2014-11-02 13:00:00','2014-11-02 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2788,20,1.8181818181818,1,'GOOGLE*SVCSAPPSWALLAMBA-CSINGAPORE    SG\n',NULL,'2014-11-02 13:00:00','2014-11-02 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2789,29,2.6363636363636,1,'MYOB AUSTRALIA           BURWOOD EAST AU\n',NULL,'2014-11-02 13:00:00','2014-11-02 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2790,11.78,1.0709090909091,1,'DIGITALOCEAN.COM         6463978051   US USD 10.00\n',NULL,'2014-10-31 13:00:00','2014-10-31 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2791,11.96,1.0872727272727,1,'APPLE ITUNES STORE       SYDNEY       AU\n',NULL,'2014-10-31 13:00:00','2014-10-31 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2792,1751.52,159.22909090909,1,'ELANCE EEC               DUBLIN       IE\n',NULL,'2014-10-31 13:00:00','2014-10-31 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2793,1.99,0.18090909090909,1,'TELSTRA APPLICATIONS     MELBOURNE    AU\n',NULL,'2014-10-30 13:00:00','2014-10-30 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2794,219.28,19.934545454545,1,'CUISINE & DEPENDANC      LYON 02      FR EUR 148.26\n',NULL,'2014-10-29 13:00:00','2014-10-29 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2795,33.02,3.0018181818182,1,'PATHE LYON BC   4264463  69LYON 2     FR EUR 22.20\n',NULL,'2014-10-28 13:00:00','2014-10-28 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2796,10.27,0.93363636363636,1,'PATHE LYON BC   4264463  69LYON 2     FR EUR 6.90\n',NULL,'2014-10-28 13:00:00','2014-10-28 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2797,129.11,11.737272727273,1,'ATELIER D\'YVONNE         LYON         FR EUR 86.70\n',NULL,'2014-10-28 13:00:00','2014-10-28 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2798,6.71,0.61,1,'JCDECAUX VELOV  4918017  92NEUILLY S SFR EUR 4.50\n',NULL,'2014-10-27 13:00:00','2014-10-27 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2799,71.04,6.4581818181818,1,'Vimeo Plus               000-000-0000 US USD 59.95\n',NULL,'2014-10-24 13:00:00','2014-10-24 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2800,1.99,0.18090909090909,1,'TELSTRA APPLICATIONS     MELBOURNE    AU\n',NULL,'2014-10-23 13:00:00','2014-10-23 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2801,20,1.8181818181818,1,'AIRBNB                   AUSTRALIA    AU\n',NULL,'2014-10-21 13:00:00','2014-10-21 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2802,8.23,0.74818181818182,1,'GH *GITHUB.COM    FRU1   4154486673   US USD 7.00\n',NULL,'2014-10-20 13:00:00','2014-10-20 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2803,3.99,0.36272727272727,1,'APPLE ITUNES STORE       SYDNEY       AU\n',NULL,'2014-10-20 13:00:00','2014-10-20 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2804,49.99,4.5445454545455,1,'ADOBE SYSTEMS SOFTWARE   044-207-3650 IE\n',NULL,'2014-10-20 13:00:00','2014-10-20 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2805,289,26.272727272727,1,'ANNUAL FEE\n',NULL,'2014-10-20 13:00:00','2014-10-20 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2806,2.67,0.24272727272727,1,'INTEREST CHARGED            -CASH\n',NULL,'2014-10-20 13:00:00','2014-10-20 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2807,13.22,1.2018181818182,1,'VIRGIN MONEY CREDITSHIELD\n',NULL,'2014-10-20 13:00:00','2014-10-20 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2808,22.42,2.0381818181818,1,'BROWSERSTACK.COM         9172677480   US USD 19.00\n',NULL,'2014-10-19 13:00:00','2014-10-19 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2809,11.99,1.09,1,'Spotify Premium x 1      nr  455368000AU\n',NULL,'2014-10-19 13:00:00','2014-10-19 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2810,82.27,7.4790909090909,1,'OPTUS BILLING A/PAY      MACQUARIE PARAU\n',NULL,'2014-10-19 13:00:00','2014-10-19 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2811,105,9.5454545454545,1,'PAYPAL *MAGGIEY17        4029357733   AU\n',NULL,'2014-10-19 13:00:00','2014-10-19 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2812,9.45,0.85909090909091,1,'NETFLIX.COM              NETFLIX.COM  US USD 7.99\n',NULL,'2014-10-17 13:00:00','2014-10-17 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2813,3.99,0.36272727272727,1,'APPLE ITUNES STORE       SYDNEY       AU\n',NULL,'2014-10-17 13:00:00','2014-10-17 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2814,23.68,2.1527272727273,1,'PAYPAL *ENVATO MKPL      4029357733   AU\n',NULL,'2014-10-17 13:00:00','2014-10-17 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2815,1.99,0.18090909090909,1,'TELSTRA APPLICATIONS     MELBOURNE    AU\n',NULL,'2014-10-16 13:00:00','2014-10-16 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2816,928.66,84.423636363636,1,'WesternUnion             1800173833   AU\n',NULL,'2014-10-16 13:00:00','2014-10-16 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2817,7050,640.90909090909,1,'BPAY PAYMENTS\n',NULL,'2014-10-15 13:00:00','2014-10-15 13:00:00','income',NULL,100,NULL,'banking',0,11,18,0,0),(2818,1150,104.54545454545,1,'PAYPAL *PATELDEVANG      4029357733   AU\n',NULL,'2014-10-15 13:00:00','2014-10-15 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2819,117.24,10.658181818182,1,'PAYPAL *BUBBLESTORM      4029357733   AU\n',NULL,'2014-10-15 13:00:00','2014-10-15 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2820,5.92,0.53818181818182,1,'Wunderkinder.com         Berlin       DE USD 4.99\n',NULL,'2014-10-14 13:00:00','2014-10-14 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2821,11.88,1.08,1,'FORGE.LARAVEL.COM        4792266733   US USD 10.00\n',NULL,'2014-10-13 13:00:00','2014-10-13 13:00:00','purchase',NULL,100,NULL,'banking',0,11,18,0,0),(2822,2000,181.82,1,'stuff','','2015-02-05 00:39:09','2015-01-26 13:00:00','purchase',24,100,1,'workbook',0,11,0,0,0),(2823,300,27.27,1,'',NULL,'2015-01-29 13:00:00','2015-01-29 13:00:00','income',NULL,100,NULL,'workbook',107,11,0,0,0),(2824,3000,272.73,1,'Gots me some moneyz','','2015-01-30 11:11:16','2015-01-29 13:00:00','income',0,100,NULL,'workbook',110,11,0,0,0),(2825,2500,227.27,1,'',NULL,'2015-01-30 13:00:00','2015-01-30 13:00:00','income',NULL,100,NULL,'workbook',110,11,0,0,0),(2829,1000,90.91,1,'Here is a description ','','2015-01-31 13:12:18','2015-01-30 13:00:00','income',0,100,NULL,'workbook',0,48,0,0,0),(2830,500,45.45,1,'bla bla','','2015-01-31 13:12:39','2015-01-30 13:00:00','purchase',26,100,1,'workbook',0,48,0,0,0),(2831,5000,454.55,1,'',NULL,'2015-01-30 13:00:00','2015-01-30 13:00:00','income',NULL,100,NULL,'workbook',112,48,0,0,0),(2832,1000,0,0,'Some income','','2015-01-31 14:16:08','2015-01-30 13:00:00','income',0,100,NULL,'workbook',0,49,0,0,0),(2833,1000,0,0,'Test Expense','','2015-02-03 08:21:53','2015-02-02 13:00:00','purchase',54,100,1,'workbook',0,1,0,0,0),(2834,100,0,0,'Test 2','','2015-02-03 08:28:28','2015-02-02 13:00:00','purchase',54,100,1,'workbook',0,1,0,0,0),(2835,3000,272.73,1,'',NULL,'2015-02-04 13:00:00','2015-02-04 13:00:00','income',NULL,100,NULL,'workbook',104,11,0,0,0),(2836,2000,181.81818181818,1,'INTERNET BPAY TAX OFFICE PAYMENTS 425655644567360\r\n',NULL,'2015-02-05 11:14:36','2014-12-30 13:00:00','purchase',23,100,NULL,'workbook',0,11,0,0,2580),(2837,3280,298.18181818182,1,'INTERNET BPAY VIRGIN MONEY 4724373520085182\r\n',NULL,'2015-02-05 11:14:14','2014-12-30 13:00:00','purchase',28,100,NULL,'workbook',0,11,0,0,2579),(2838,5,0.45454545454545,1,'V0284 23/12 OVERSEAS ATM TRANS FEE 74598374357\r\n',NULL,'2015-02-05 11:14:36','2014-12-28 13:00:00','purchase',23,100,NULL,'workbook',0,11,0,0,2586),(2839,7.5,0.68181818181818,1,'INTERNET TRANSFER CASH TRANSFER\r\n',NULL,'2015-02-05 11:14:14','2014-12-28 13:00:00','purchase',28,100,NULL,'workbook',0,11,0,0,2585),(2840,9.07,0.82454545454545,1,'V0284 23/12 FOREIGN CURRENCY TRAN FEE 74598374357\r\n',NULL,'2015-02-05 11:14:14','2014-12-28 13:00:00','purchase',28,100,NULL,'workbook',0,11,0,0,2584),(2841,2000,181.82,1,'','','2015-02-05 11:19:44','2015-02-04 13:00:00','purchase',58,100,1,'workbook',0,16,0,0,0),(2842,116.5,10.590909090909,1,'REAL INSURANCE           SYDNEY       AU\n',NULL,'2014-06-29 14:00:00','2014-06-29 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2843,67.5,6.1363636363636,1,'SUPPER INN CHINESE       MELBOURNE    AU\n',NULL,'2014-06-28 14:00:00','2014-06-28 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2844,110.59,10.053636363636,1,'CALTEX SAFEWAY ELSTE     ELSTERNWICK  AU\n',NULL,'2014-06-28 14:00:00','2014-06-28 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2845,57,5.1818181818182,1,'POP RESTAURANT & BAR     MELBOURNE    AU\n',NULL,'2014-06-27 14:00:00','2014-06-27 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2846,50,4.5454545454545,1,'Bossini International    Melbourne    AU\n',NULL,'2014-06-26 14:00:00','2014-06-26 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2847,1.99,0.18090909090909,1,'TELSTRA APPLICATIONS     MELBOURNE    AU\n',NULL,'2014-06-26 14:00:00','2014-06-26 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2848,39,3.5454545454545,1,'MYER MELBOURNE CITY      MELBOURNE    AU\n',NULL,'2014-06-26 14:00:00','2014-06-26 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2849,149,13.545454545455,1,'GROUPON                  ZURICH       CH\n',NULL,'2014-06-26 14:00:00','2014-06-26 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2850,106.68,9.6981818181818,1,'Hotel Urban St Kilda     St Kilda     AU\n',NULL,'2014-06-25 14:00:00','2014-06-25 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2851,29.4,2.6727272727273,1,'E DUMPLING PL            MELBOURNE    AU\n',NULL,'2014-06-25 14:00:00','2014-06-25 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2852,49.48,4.4981818181818,1,'Pond5.com                Geneve       CH USD 45.00\n',NULL,'2014-06-25 14:00:00','2014-06-25 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2853,491.61,44.691818181818,1,'WesternUnion             1800173833   AU\n',NULL,'2014-06-24 14:00:00','2014-06-24 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2854,20,1.8181818181818,1,'GOFUNDRAISE PTY LTD      RUSHCUTTERS BAU\n',NULL,'2014-06-24 14:00:00','2014-06-24 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2855,115.92,10.538181818182,1,'CORPORATE FITNESS CLUB   MELBOURNE    AU\n',NULL,'2014-06-24 14:00:00','2014-06-24 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2856,220.62,20.056363636364,1,'PAYPAL *GRAPEFEVER       4029357733   AU\n',NULL,'2014-06-23 14:00:00','2014-06-23 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2857,60.94,5.54,1,'INTERNODE PTY LTD        ADELAIDE     AU\n',NULL,'2014-06-22 14:00:00','2014-06-22 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2858,12.12,1.1018181818182,1,'2BuySafe.com             +18772926378 NL USD 11.00\n',NULL,'2014-06-22 14:00:00','2014-06-22 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2859,7.71,0.70090909090909,1,'GH *GITHUB.COM    FRU1   4154486673   US USD 7.00\n',NULL,'2014-06-20 14:00:00','2014-06-20 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2860,49.99,4.5445454545455,1,'ADOBE SYSTEMS SOFTWARE   044-207-3650 IE\n',NULL,'2014-06-20 14:00:00','2014-06-20 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2861,20.92,1.9018181818182,1,'BROWSERSTACK.COM         9172677480   US USD 19.00\n',NULL,'2014-06-19 14:00:00','2014-06-19 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2862,74.75,6.7954545454545,1,'OPTUS BILLING A/PAY      MACQUARIE PARAU\n',NULL,'2014-06-19 14:00:00','2014-06-19 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2863,11.99,1.09,1,'Spotify Premium x 1      nr  381239954AU\n',NULL,'2014-06-19 14:00:00','2014-06-19 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2864,1.99,0.18090909090909,1,'TELSTRA APPLICATIONS     MELBOURNE    AU\n',NULL,'2014-06-19 14:00:00','2014-06-19 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2865,7.84,0.71272727272727,1,'VIRGIN MONEY CREDITSHIELD\n',NULL,'2014-06-19 14:00:00','2014-06-19 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2866,139.65,12.695454545455,1,'STK*SHUTTERSTOCK, INC.   866-663-3954 US USD 126.00\n',NULL,'2014-06-17 14:00:00','2014-06-17 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2867,8.85,0.80454545454545,1,'NETFLIX.COM              NETFLIX.COM  US USD 7.99\n',NULL,'2014-06-17 14:00:00','2014-06-17 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2868,33.32,3.0290909090909,1,'PAYPAL *ENVATO MKPL      4029357733   AU\n',NULL,'2014-06-17 14:00:00','2014-06-17 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2869,79.04,7.1854545454545,1,'WWW.PREDATORNUTRITION.CO BIRSTALL     GB GBP 42.08\n',NULL,'2014-06-16 14:00:00','2014-06-16 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2870,2600,236.36363636364,1,'BPAY PAYMENTS\n',NULL,'2014-06-15 14:00:00','2014-06-15 14:00:00','income',NULL,100,NULL,'banking',0,1,13,0,0),(2871,1081,98.272727272727,1,'PAYPAL *PATELDEVANG      4029357733   AU\n',NULL,'2014-06-15 14:00:00','2014-06-15 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2872,88.29,8.0263636363636,1,'PAYPAL *ENVATO MKPL      4029357733   AU\n',NULL,'2014-06-15 14:00:00','2014-06-15 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2873,5.49,0.49909090909091,1,'Wunderkinder.com         Berlin       DE USD 4.99\n',NULL,'2014-06-14 14:00:00','2014-06-14 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2874,108.18,9.8345454545455,1,'EASYJET     EMT998Z      EASYJET.COM  GB EUR 72.40\n',NULL,'2014-06-14 14:00:00','2014-06-14 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2875,164.58,14.961818181818,1,'EASYJET     EMT99SB      EASYJET.COM  GB EUR 110.14\n',NULL,'2014-06-14 14:00:00','2014-06-14 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2876,1.99,0.18090909090909,1,'TELSTRA APPLICATIONS     MELBOURNE    AU\n',NULL,'2014-06-12 14:00:00','2014-06-12 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2877,115.69,10.517272727273,1,'ORIGIN ENERGY HOLDIN     ADELAIDE     AU\n',NULL,'2014-06-12 14:00:00','2014-06-12 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2878,10,0.90909090909091,1,'LATE PAYMENT FEE\n',NULL,'2014-06-11 14:00:00','2014-06-11 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2879,375.14,34.103636363636,1,'DEFT PAYMENTS            SYDNEY       AU\n',NULL,'2014-06-09 14:00:00','2014-06-09 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2880,22.2,2.0181818181818,1,'PAYPAL *ENVATO MKPL      4029357733   AU\n',NULL,'2014-06-09 14:00:00','2014-06-09 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2881,39.8,3.6181818181818,1,'CRAZY DOMAINS            INTERNET     CY\n',NULL,'2014-06-08 14:00:00','2014-06-08 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2882,1.99,0.18090909090909,1,'TELSTRA APPLICATIONS     MELBOURNE    AU\n',NULL,'2014-06-05 14:00:00','2014-06-05 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2883,10,0.90909090909091,1,'LATE PAYMENT FEE\n',NULL,'2014-06-04 14:00:00','2014-06-04 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2884,400,36.363636363636,1,'Elance                   Dublin       IE\n',NULL,'2014-06-04 14:00:00','2014-06-04 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2885,11.2,1.0181818181818,1,'FTPLOY.COM               441162101656 GB GBP 6.00\n',NULL,'2014-06-03 14:00:00','2014-06-03 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2886,1.99,0.18090909090909,1,'TELSTRA APPLICATIONS     MELBOURNE    AU\n',NULL,'2014-05-29 14:00:00','2014-05-29 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2887,116.5,10.590909090909,1,'REAL INSURANCE           SYDNEY       AU\n',NULL,'2014-05-29 14:00:00','2014-05-29 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2888,223.07,20.279090909091,1,'DELICIOUSBRAINS.COM      9022098751   CA USD 199.00\n',NULL,'2014-05-26 14:00:00','2014-05-26 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2889,251.17,22.833636363636,1,'Elance                   Dublin       IE\n',NULL,'2014-05-25 14:00:00','2014-05-25 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2890,235.44,21.403636363636,1,'ELANCE INC               650-3167500  US USD 210.00\n',NULL,'2014-05-23 14:00:00','2014-05-23 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2891,60.94,5.54,1,'INTERNODE PTY LTD        ADELAIDE     AU\n',NULL,'2014-05-23 14:00:00','2014-05-23 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2892,1.99,0.18090909090909,1,'TELSTRA APPLICATIONS     MELBOURNE    AU\n',NULL,'2014-05-22 14:00:00','2014-05-22 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2893,12.33,1.1209090909091,1,'2BuySafe.com             +18772926378 NL USD 11.00\n',NULL,'2014-05-22 14:00:00','2014-05-22 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2894,22.47,2.0427272727273,1,'PAYPAL *DRIBBBLE         4029357733   AU\n',NULL,'2014-05-22 14:00:00','2014-05-22 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2895,7.85,0.71363636363636,1,'GH *GITHUB.COM    FRU1   4154486673   US USD 7.00\n',NULL,'2014-05-20 14:00:00','2014-05-20 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2896,111.03,10.093636363636,1,'TIERRA VIRTUAL S.L.      VALENCIA     ES USD 99.00\n',NULL,'2014-05-20 14:00:00','2014-05-20 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2897,49.99,4.5445454545455,1,'ADOBE SYSTEMS SOFTWARE   044-207-3650 IE\n',NULL,'2014-05-20 14:00:00','2014-05-20 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2898,1.26,0.11454545454545,1,'VIRGIN MONEY CREDITSHIELD\n',NULL,'2014-05-20 14:00:00','2014-05-20 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2899,21.21,1.9281818181818,1,'BROWSERSTACK.COM         9172677480   US USD 19.00\n',NULL,'2014-05-19 14:00:00','2014-05-19 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2900,11.99,1.09,1,'Spotify Premium x 1      nr  364570009AU\n',NULL,'2014-05-19 14:00:00','2014-05-19 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2901,129.61,11.782727272727,1,'OPTUS BILLING A/PAY      MACQUARIE PARAU\n',NULL,'2014-05-18 14:00:00','2014-05-18 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2902,8500,772.72727272727,1,'BPAY PAYMENTS\n',NULL,'2014-05-18 14:00:00','2014-05-18 14:00:00','income',NULL,100,NULL,'banking',0,1,13,0,0),(2903,86.22,7.8381818181818,1,'PENTACO OIL AUST PTY LTD HAWTHORN     AU\n',NULL,'2014-05-18 14:00:00','2014-05-18 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2904,8.84,0.80363636363636,1,'NETFLIX.COM              NETFLIX.COM  US USD 7.99\n',NULL,'2014-05-17 14:00:00','2014-05-17 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2905,1.99,0.18090909090909,1,'TELSTRA APPLICATIONS     MELBOURNE    AU\n',NULL,'2014-05-15 14:00:00','2014-05-15 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2906,26.1,2.3727272727273,1,'JB HI FI                 MELBOURNE    AU\n',NULL,'2014-05-15 14:00:00','2014-05-15 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2907,123.75,11.25,1,'SOUTH EAST WATER CALL CTRHEATHERTON   AU\n',NULL,'2014-05-14 14:00:00','2014-05-14 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2908,5.51,0.50090909090909,1,'Wunderkinder.com         Berlin       DE USD 4.99\n',NULL,'2014-05-14 14:00:00','2014-05-14 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2909,30.4,2.7636363636364,1,'E DUMPLING PL            MELBOURNE    AU\n',NULL,'2014-05-12 14:00:00','2014-05-12 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2910,46.86,4.26,1,'CRAZY DOMAINS            INTERNET     CY\n',NULL,'2014-05-11 14:00:00','2014-05-11 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2911,20,1.8181818181818,1,'MICHAELS CAMERA  VI      MELBOURNE    AU\n',NULL,'2014-05-10 14:00:00','2014-05-10 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2912,1.99,0.18090909090909,1,'TELSTRA APPLICATIONS     MELBOURNE    AU\n',NULL,'2014-05-08 14:00:00','2014-05-08 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2913,165.47,15.042727272727,1,'Elance                   Dublin       IE\n',NULL,'2014-05-08 14:00:00','2014-05-08 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2914,157,14.272727272727,1,'MICHAELS CAMERA  VI      MELBOURNE    AU\n',NULL,'2014-05-06 14:00:00','2014-05-06 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2915,30,2.7272727272727,1,'UNITED KINGSWAY          SOUTH MELBOURAU\n',NULL,'2014-05-06 14:00:00','2014-05-06 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2916,8.48,0.77090909090909,1,'AUST POST WCC 350748     MELBOURNE    AU\n',NULL,'2014-05-06 14:00:00','2014-05-06 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2917,15.13,1.3754545454545,1,'OFFICEWKS  MELBOURNE CBD VIC          AU\n',NULL,'2014-05-05 14:00:00','2014-05-05 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2918,350,31.818181818182,1,'THE CAMERA RENTAL CENTRE SOUTH MELBOURAU\n',NULL,'2014-05-05 14:00:00','2014-05-05 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2919,44.51,4.0463636363636,1,'Elance                   Dublin       IE\n',NULL,'2014-05-05 14:00:00','2014-05-05 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2920,1800,163.63636363636,1,'BPAY PAYMENTS\n',NULL,'2014-05-04 14:00:00','2014-05-04 14:00:00','income',NULL,100,NULL,'banking',0,1,13,0,0),(2921,115.92,10.538181818182,1,'CORPORATE FITNESS CLUB   MELBOURNE    AU\n',NULL,'2014-05-04 14:00:00','2014-05-04 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2922,220,20,1,'PAYPAL *WHITEDOORPT      4029357733   AU\n',NULL,'2014-05-03 14:00:00','2014-05-03 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2923,115.92,10.538181818182,1,'CORPORATE FITNESS CLUB   MELBOURNE    AU\n',NULL,'2014-05-02 14:00:00','2014-05-02 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2924,220,20,1,'PAYPAL *WHITEDOORPT      4029357733   AU\n',NULL,'2014-05-02 14:00:00','2014-05-02 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2925,75,6.8181818181818,1,'CITYLINK MELBOURNE       MELBOURNE    AU\n',NULL,'2014-05-02 14:00:00','2014-05-02 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2926,133.41,12.128181818182,1,'Elance                   Dublin       IE\n',NULL,'2014-05-01 14:00:00','2014-05-01 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2927,73.5,6.6818181818182,1,'THE DEANERY              MELBOURNE    AU\n',NULL,'2014-04-30 14:00:00','2014-04-30 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2928,22.18,2.0163636363636,1,'Elance                   Dublin       IE\n',NULL,'2014-04-30 14:00:00','2014-04-30 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2929,116.5,10.590909090909,1,'REAL INSURANCE           SYDNEY       AU\n',NULL,'2014-04-29 14:00:00','2014-04-29 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2930,144.4,13.127272727273,1,'BENS CAMERA HIRE PL      FITZROY NORTHAU\n',NULL,'2014-04-29 14:00:00','2014-04-29 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2931,159,14.454545454545,1,'JB HI FI                 MELBOURNE    AU\n',NULL,'2014-04-29 14:00:00','2014-04-29 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2932,120,10.909090909091,1,'JB HI FI                 MELBOURNE    AU\n',NULL,'2014-04-29 14:00:00','2014-04-29 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2933,13.6,1.2363636363636,1,'BENS CAMERA HIRE PL      FITZROY NORTHAU\n',NULL,'2014-04-28 14:00:00','2014-04-28 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2934,84.38,7.6709090909091,1,'COLES EXPR  BIG MERINO G NSW          AU\n',NULL,'2014-04-27 14:00:00','2014-04-27 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2935,600,54.545454545455,1,'BM AUTOWERKS PTY LTD     OAKLEIGH     AU\n',NULL,'2014-04-27 14:00:00','2014-04-27 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2936,106,9.6363636363636,1,'NABIAC SERVICE STATI     NABIAC       AU\n',NULL,'2014-04-23 14:00:00','2014-04-23 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2937,60.94,5.54,1,'INTERNODE PTY LTD        ADELAIDE     AU\n',NULL,'2014-04-22 14:00:00','2014-04-22 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2938,12.28,1.1163636363636,1,'2BuySafe.com             +18772926378 NL USD 11.00\n',NULL,'2014-04-22 14:00:00','2014-04-22 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2939,120.97,10.997272727273,1,'OPTUS BILLING A/PAY      MACQUARIE PARAU\n',NULL,'2014-04-21 14:00:00','2014-04-21 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2940,139,12.636363636364,1,'LEADING EDGE FORSTER     FORSTER      AU\n',NULL,'2014-04-21 14:00:00','2014-04-21 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2941,29.98,2.7254545454545,1,'DICK SMITH 8783          TAREE        AU\n',NULL,'2014-04-20 14:00:00','2014-04-20 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2942,49.99,4.5445454545455,1,'ADOBE SYSTEMS SOFTWARE   044-207-3650 IE\n',NULL,'2014-04-20 14:00:00','2014-04-20 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2943,21.06,1.9145454545455,1,'BROWSERSTACK.COM         9172677480   US USD 19.00\n',NULL,'2014-04-19 14:00:00','2014-04-19 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2944,11.99,1.09,1,'Spotify Premium x 1      nr  350036224AU\n',NULL,'2014-04-19 14:00:00','2014-04-19 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2945,8.85,0.80454545454545,1,'NETFLIX.COM              NETFLIX.COM  US USD 7.99\n',NULL,'2014-04-17 14:00:00','2014-04-17 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2946,81.79,7.4354545454545,1,'COLES EXPR  GOULBURN     NSW          AU\n',NULL,'2014-04-17 14:00:00','2014-04-17 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2947,950,86.363636363636,1,'DRAGON IMAGE PTY LTD     COLLINGWOOD  AU\n',NULL,'2014-04-16 14:00:00','2014-04-16 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2948,35,3.1818181818182,1,'MY MAC AUSTRALIA PTY     MELBOURNE    AU\n',NULL,'2014-04-16 14:00:00','2014-04-16 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2949,403.9,36.718181818182,1,'BM AUTOWERKS PTY LTD     OAKLEIGH     AU\n',NULL,'2014-04-16 14:00:00','2014-04-16 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2950,90.87,8.2609090909091,1,'CALTEX AVENEL            AVENEL       AU\n',NULL,'2014-04-16 14:00:00','2014-04-16 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2951,49.15,4.4681818181818,1,'INTEREST CHARGED PRIOR MTH\n',NULL,'2014-04-16 14:00:00','2014-04-16 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2952,107.17,9.7427272727273,1,'INTEREST CHARGED\n',NULL,'2014-04-16 14:00:00','2014-04-16 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2953,24.74,2.2490909090909,1,'VIRGIN MONEY CREDITSHIELD\n',NULL,'2014-04-16 14:00:00','2014-04-16 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2954,56,5.0909090909091,1,'Meatball & Wine Bar      Melbourne    AU\n',NULL,'2014-04-14 14:00:00','2014-04-14 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2955,5.49,0.49909090909091,1,'Wunderkinder.com         Berlin       DE USD 4.99\n',NULL,'2014-04-14 14:00:00','2014-04-14 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2956,64.99,5.9081818181818,1,'APPLE ITUNES STORE       SYDNEY       AU\n',NULL,'2014-04-14 14:00:00','2014-04-14 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2957,209.38,19.034545454545,1,'ORIGIN ENERGY HOLDIN     ADELAIDE     AU\n',NULL,'2014-04-14 14:00:00','2014-04-14 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2958,82.91,7.5372727272727,1,'ORIGIN ENERGY HOLDIN     ADELAIDE     AU\n',NULL,'2014-04-14 14:00:00','2014-04-14 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2959,84.5,7.6818181818182,1,'WOTIF COM PTY LTD        MILTON       AU\n',NULL,'2014-04-13 14:00:00','2014-04-13 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2960,35.88,3.2618181818182,1,'TICKETEK PTY LTD WEB     SYDNEY       AU\n',NULL,'2014-04-13 14:00:00','2014-04-13 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2961,24.95,2.2681818181818,1,'Jaycar Electronics       Melbourne    AU\n',NULL,'2014-04-11 14:00:00','2014-04-11 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2962,4000,363.63636363636,1,'BPAY PAYMENT\n',NULL,'2014-04-10 14:00:00','2014-04-10 14:00:00','income',NULL,100,NULL,'banking',0,1,13,0,0),(2963,1040,94.545454545455,1,'DRAGON IMAGE PTY LTD     COLLINGWOOD  AU\n',NULL,'2014-04-10 14:00:00','2014-04-10 14:00:00','purchase',NULL,100,NULL,'banking',0,1,13,0,0),(2964,0.78,0.070909090909091,1,'ELANCE INC               650-3167500  US USD 0.71\n',NULL,'2014-04-08 14:00:00','2014-04-08 14:00:00','income',NULL,100,NULL,'banking',0,1,13,0,0),(2965,0.78,0.070909090909091,1,'ELANCE INC               650-3167500  US USD 0.71\n',NULL,'2014-04-08 14:00:00','2014-04-08 14:00:00','income',NULL,100,NULL,'banking',0,1,13,0,0),(2966,2500,227.27,1,'','','2015-02-10 03:56:13','2015-02-09 13:00:00','income',NULL,100,NULL,'workbook',116,11,0,0,0),(2967,100,0,0,'','','2015-02-10 13:00:15','2015-02-09 13:00:00','purchase',63,100,1,'workbook',0,1,0,0,0),(2968,100,0,0,'','','2015-02-10 17:41:18','2015-02-10 13:00:00','purchase',0,100,1,'workbook',0,1,0,0,0),(2969,400,36.36,1,'','','2015-02-11 00:42:22','2015-02-10 13:00:00','purchase',0,100,1,'workbook',0,16,0,0,0),(2970,500,45.45,1,'','','2015-02-11 06:16:53','2015-02-10 13:00:00','purchase',0,100,1,'workbook',0,16,0,0,0),(2971,200,18.18,1,'','','2015-02-11 06:17:21','2015-02-10 13:00:00','purchase',0,100,1,'workbook',0,16,0,0,0),(2972,200,0,0,'It\'s test for uncategories','','2015-02-11 06:19:03','2015-02-10 13:00:00','purchase',0,100,1,'workbook',0,1,0,0,0),(2973,300,27.27,1,'Test for new account ','','2015-02-11 06:21:44','2015-02-10 13:00:00','purchase',0,100,1,'workbook',0,16,0,0,0),(2974,2000,181.82,1,'I m testing for Categories','','2015-02-11 06:23:57','2015-02-10 13:00:00','purchase',0,100,1,'workbook',0,16,0,0,0),(2975,350,31.82,1,'Going for SM MALL','','2015-02-11 06:25:22','2015-02-10 13:00:00','purchase',58,100,1,'workbook',0,16,0,0,0),(2976,150,13.64,1,'Tissue papers','','2015-02-11 06:28:05','2015-02-10 13:00:00','purchase',21,100,1,'workbook',0,16,0,0,0),(2977,1444,131.27,1,'tesst','','2015-02-11 06:29:54','2015-02-10 13:00:00','purchase',58,100,1,'workbook',0,16,0,0,0),(2978,200,18.18,1,'Went for Manila','','2015-02-11 07:20:54','2015-02-12 13:00:00','purchase',58,100,1,'workbook',0,16,0,0,0);
/*!40000 ALTER TABLE `bsr_expenses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bsr_goals`
--

DROP TABLE IF EXISTS `bsr_goals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bsr_goals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `month` double NOT NULL DEFAULT '0',
  `quarter` double NOT NULL DEFAULT '0',
  `financial_year` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bsr_goals`
--

LOCK TABLES `bsr_goals` WRITE;
/*!40000 ALTER TABLE `bsr_goals` DISABLE KEYS */;
INSERT INTO `bsr_goals` VALUES (1,1,900,500000,5000000),(2,46,0,0,10),(3,16,0,0,0),(4,11,14000,50000,200000),(5,47,0,0,0),(6,49,10000,25000,100000);
/*!40000 ALTER TABLE `bsr_goals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bsr_imports`
--

DROP TABLE IF EXISTS `bsr_imports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bsr_imports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transactions` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `imported_from` timestamp NULL DEFAULT NULL,
  `imported_to` timestamp NULL DEFAULT NULL,
  `bank_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bsr_imports`
--

LOCK TABLES `bsr_imports` WRITE;
/*!40000 ALTER TABLE `bsr_imports` DISABLE KEYS */;
INSERT INTO `bsr_imports` VALUES (1,'124','2014-11-14 12:56:03','2014-11-14 12:56:03','2014-04-08 14:00:00','2014-06-29 14:00:00',13),(7,'98','2015-01-22 10:03:12','2015-01-22 10:03:12','2014-10-13 13:00:00','2014-12-30 13:00:00',18),(8,'139','2015-01-22 10:07:42','2015-01-22 10:07:42','2014-09-30 14:00:00','2014-12-30 13:00:00',17),(9,'124','2015-01-23 10:41:05','2015-01-23 10:41:05','2014-04-08 14:00:00','2014-06-29 14:00:00',20),(10,'124','2015-01-23 12:05:28','2015-01-23 12:05:28','2014-04-08 14:00:00','2014-06-29 14:00:00',20),(11,'124','2015-01-23 12:06:23','2015-01-23 12:06:23','2014-04-08 14:00:00','2014-06-29 14:00:00',20),(12,'139','2015-01-26 07:54:00','2015-01-26 07:54:00','2014-09-30 14:00:00','2014-12-30 13:00:00',17),(13,'139','2015-01-26 08:28:40','2015-01-26 08:28:40','2014-09-30 14:00:00','2014-12-30 13:00:00',17),(14,'139','2015-01-26 08:31:35','2015-01-26 08:31:35','2014-09-30 14:00:00','2014-12-30 13:00:00',20),(15,'104','2015-01-26 08:35:09','2015-01-26 08:35:09','2014-10-13 13:00:00','2014-12-30 13:00:00',20),(16,'139','2015-01-26 08:35:34','2015-01-26 08:35:34','2014-09-30 14:00:00','2014-12-30 13:00:00',13),(17,'104','2015-01-26 08:53:12','2015-01-26 08:53:12','2014-10-13 13:00:00','2014-12-30 13:00:00',13),(18,'124','2015-01-26 08:58:18','2015-01-26 08:58:18','2014-04-08 14:00:00','2014-06-29 14:00:00',13),(19,'104','2015-01-26 08:59:04','2015-01-26 08:59:04','2014-10-13 13:00:00','2014-12-30 13:00:00',13),(22,'139','2015-01-26 13:07:21','2015-01-26 13:07:21','2014-09-30 14:00:00','2014-12-30 13:00:00',13),(23,'124','2015-01-26 13:09:54','2015-01-26 13:09:54','2014-04-08 14:00:00','2014-06-29 14:00:00',13),(24,'104','2015-01-26 21:36:23','2015-01-26 21:36:23','2014-10-13 13:00:00','2014-12-30 13:00:00',20),(25,'139','2015-01-27 07:18:25','2015-01-27 07:18:25','2014-09-30 14:00:00','2014-12-30 13:00:00',17),(26,'104','2015-01-27 07:19:24','2015-01-27 07:19:24','2014-10-13 13:00:00','2014-12-30 13:00:00',18),(27,'124','2015-02-08 23:48:32','2015-02-08 23:48:32','2014-04-08 14:00:00','2014-06-29 14:00:00',13);
/*!40000 ALTER TABLE `bsr_imports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bsr_invoice_histories`
--

DROP TABLE IF EXISTS `bsr_invoice_histories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bsr_invoice_histories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `event` varchar(255) DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `invoice_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bsr_invoice_histories`
--

LOCK TABLES `bsr_invoice_histories` WRITE;
/*!40000 ALTER TABLE `bsr_invoice_histories` DISABLE KEYS */;
/*!40000 ALTER TABLE `bsr_invoice_histories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bsr_invoice_payments`
--

DROP TABLE IF EXISTS `bsr_invoice_payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bsr_invoice_payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_date` date DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `note` text,
  `invoice_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bsr_invoice_payments`
--

LOCK TABLES `bsr_invoice_payments` WRITE;
/*!40000 ALTER TABLE `bsr_invoice_payments` DISABLE KEYS */;
INSERT INTO `bsr_invoice_payments` VALUES (3,NULL,1,NULL,2),(13,NULL,300,NULL,12),(15,NULL,500,NULL,21);
/*!40000 ALTER TABLE `bsr_invoice_payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bsr_invoice_prices`
--

DROP TABLE IF EXISTS `bsr_invoice_prices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bsr_invoice_prices` (
  `invoice_id` int(11) DEFAULT NULL,
  `desc` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `inc_gst` tinyint(1) DEFAULT NULL,
  `amount` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bsr_invoice_prices`
--

LOCK TABLES `bsr_invoice_prices` WRITE;
/*!40000 ALTER TABLE `bsr_invoice_prices` DISABLE KEYS */;
INSERT INTO `bsr_invoice_prices` VALUES (33,'dasd',0,0,0,0),(33,'dasdas',0,0,0,0),(34,'dasd',0,0,0,0),(34,'dasdas',0,0,0,0),(62,'',10,100,0,1000),(95,'food delivery',2,250,0,500),(95,'',0,0,0,0),(99,'food',2,200,0,400),(101,'food',1,100,0,100),(102,'food',1,100,0,100),(104,'sdf',5,1000,1,5500),(106,'sdafasdf',2,5000,1,11000),(81,'',1,1000,0,1000),(107,'asdfasdf',4,2000,1,8800),(94,'',11,111,0,1221),(98,'food',2,200,0,400),(97,'food',2,200,0,400),(109,'food',3,500,0,1500),(61,'',10,10,0,100),(110,'sdafasdf',10,500,1,5500),(103,'food ',5,100,0,500),(111,'asdfasdf',12,1000,1,13200),(112,'Burgers',10,1000,1,11000),(113,'Service desc',5,100,0,500),(114,'zxcvzxcv',5,3000,1,16500),(115,'',0,0,0,0),(116,'bla',10,500,1,5500);
/*!40000 ALTER TABLE `bsr_invoice_prices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bsr_invoice_settings`
--

DROP TABLE IF EXISTS `bsr_invoice_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bsr_invoice_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `payment_term` int(3) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `footer` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bsr_invoice_settings`
--

LOCK TABLES `bsr_invoice_settings` WRITE;
/*!40000 ALTER TABLE `bsr_invoice_settings` DISABLE KEYS */;
INSERT INTO `bsr_invoice_settings` VALUES (1,1,0,'/media/invoicing/1/logo_54c6f0d007e69.png','PLEASE MAKE PAYMENTS TO:\nACC NAME: GRANT MCCALL\nBSB: 082856\nACC NUMBER: 581703897'),(2,46,123,'','aaaa'),(3,16,7,'/media/invoicing/16/logo_54cc452ce0d81.png','Please make payments to:<br />Acc Name: Grant McCall<br />BSB: 082856<br />ACC Number: 581703897<br />'),(4,11,7,'/media/invoicing/11/logo_54d980a53b41c.png','Please make payments to:<br />Acc Name: Grant McCall<br />BSB: 082856<br />ACC Number: 581703897 '),(5,48,8,'','');
/*!40000 ALTER TABLE `bsr_invoice_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bsr_invoices`
--

DROP TABLE IF EXISTS `bsr_invoices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bsr_invoices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_number` varchar(255) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `company_legal` varchar(255) DEFAULT NULL,
  `company_address` varchar(255) DEFAULT NULL,
  `company_abn` varchar(255) DEFAULT NULL,
  `client_name` varchar(255) DEFAULT NULL,
  `client_legal` varchar(255) DEFAULT NULL,
  `client_address` varchar(255) DEFAULT NULL,
  `issued_date` date DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `payment_term` int(11) DEFAULT NULL,
  `description` text,
  `sent` tinyint(4) DEFAULT '0',
  `subtotal` double DEFAULT NULL,
  `gst` double DEFAULT NULL,
  `total` double DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `updated_date` date DEFAULT NULL,
  `invoice` varchar(255) DEFAULT '',
  `paid` tinyint(1) NOT NULL DEFAULT '0',
  `order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=117 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bsr_invoices`
--

LOCK TABLES `bsr_invoices` WRITE;
/*!40000 ALTER TABLE `bsr_invoices` DISABLE KEYS */;
INSERT INTO `bsr_invoices` VALUES (33,'ADS-001',8,47,'askdp0','dsad',NULL,'asdas','adsop','okdsapdk','das','2014-12-29','2015-01-05',7,'asda',0,0,0,0,'2015-01-22','2015-01-22','',0,1),(34,'ADS-002',8,47,'askdp0','dsad',NULL,'asdas','adsop','okdsapdk','das','2014-12-29','2015-01-05',7,'asda',0,0,0,0,'2015-01-22','2015-01-22','',0,2),(61,'ACB-001',1,1,'Rounded','Trung Le',NULL,'ABN','ACB','Acb','Hue, Viet Nam','2015-01-25','2015-01-25',0,'',1,100,0,100,'2015-01-25','2015-01-29','/media/invoices/1/invoice_61_ACB_001.pdf',0,1),(62,'CDA-001',2,1,'Rounded','Trung Le',NULL,'ABN','CDA','Trung Le','aaaa','2015-01-25','2015-02-05',11,'sadasdasd',1,1000,0,1000,'2015-01-25','2015-01-26','/media/invoices/1/invoice_62_CDA_001.pdf',0,1),(81,'ACB-002',1,1,'Rounded','Trung Le',NULL,'ABN','ACB','Acb','Hue, Viet Nam','2015-01-26','2015-01-26',0,'',1,1000,0,1000,'2015-01-26','2015-01-27','',0,2),(94,'ACB-003',1,1,'Rounded 1','Trung Le',NULL,'ABN','ACB','Acb','Hue, Viet Nam','2015-01-27','2015-01-27',0,'',1,1221,0,1221,'2015-01-27','2015-01-28','',0,3),(95,'KFC-002',4,16,'Frontlinewebdevelopers','Manesh Bahuguna',NULL,'69797KLM798','KFC','KFC','262 S. Brookside, Wichita, KS 67218','2015-01-27','2015-02-03',7,'',1,500,0,500,'2015-01-27','2015-01-27','',0,2),(97,'KFC-003',4,16,'Frontlinewebdevelopers','Manesh Bahuguna',NULL,'69797KLM798','KFC','KFC','262 S. Brookside, Wichita, KS 67218','2015-01-27','2015-02-03',7,'',1,400,0,400,'2015-01-27','2015-01-28','/media/invoices/16/invoice_97_KFC_003.pdf',0,3),(98,'KFC-004',4,16,'Frontlinewebdevelopers','Manesh Bahuguna',NULL,'69797KLM798','KFC','KFC','262 S. Brookside, Wichita, KS 67218','2015-01-27','2015-02-03',7,'',1,400,0,400,'2015-01-27','2015-01-28','/media/invoices/16/invoice_98_KFC_004.pdf',0,4),(99,'KFC-005',4,16,'Frontlinewebdevelopers','Manesh Bahuguna',NULL,'69797KLM798','KFC','KFC','262 S. Brookside, Wichita, KS 67218','2015-01-27','2015-02-03',7,'',1,400,0,400,'2015-01-27','2015-01-27','/media/invoices/16/invoice_99_KFC_005.pdf',0,5),(101,'KFC-006',4,16,'Frontlinewebdevelopers','Manesh Bahuguna',NULL,'69797KLM798','KFC','KFC','262 S. Brookside, Wichita, KS 67218','2015-01-27','2015-02-03',7,'',1,100,0,100,'2015-01-27','2015-01-27','',0,6),(102,'KFC-007',4,16,'Frontlinewebdevelopers','Manesh Bahuguna',NULL,'69797KLM798','KFC','KFC','262 S. Brookside, Wichita, KS 67218','2015-01-27','2015-02-03',7,'',1,100,0,100,'2015-01-27','2015-01-27','',0,7),(103,'KFC-008',4,16,'Frontlinewebdevelopers','Manesh Bahuguna',NULL,'69797KLM798','KFC','KFC','262 S. Brookside, Wichita, KS 67218','2015-01-27','2015-02-03',7,'',1,500,0,500,'2015-01-27','2015-01-31','/media/invoices/16/invoice_103_KFC_008.pdf',0,8),(104,'MCD-001',5,11,'Wallamba','Grant McCall',NULL,'42565564456','McDonalds','Ronald','7 Smith Street','2015-01-27','2015-02-03',7,'asdfadfasdfasdfadf',1,5000,500,5500,'2015-01-27','2015-01-27','/media/invoices/11/invoice_104_MCD_001.pdf',0,1),(106,'EVA-001',7,11,'Wallamba','Grant McCall',NULL,'42565564456','Eva Mezei','Eva','7 Somewhere Street\nbumbfuckville, 3000','2015-01-27','2015-02-03',7,'asdfasdf',1,10000,1000,11000,'2015-01-27','2015-01-27','/media/invoices/11/invoice_106_EVA_001.pdf',0,1),(107,'EVA-002',7,11,'Wallamba','Grant McCall',NULL,'42565564456','Eva Mezei','Eva','7 Somewhere Street\nbumbfuckville, 3000','2015-01-27','2015-02-03',7,'asdfasdf',1,8000,800,8800,'2015-01-27','2015-01-27','/media/invoices/11/invoice_107_EVA_002.pdf',0,2),(109,'KFC-009',4,16,'Frontlinewebdevelopers','Manesh Bahuguna',NULL,'69797KLM798','KFC','KFC','262 S. Brookside, Wichita, KS 67218','2015-01-28','2015-02-04',7,'',0,1500,0,1500,'2015-01-28','2015-01-28','',0,9),(110,'KFC-001',3,11,'Wallamba','Grant McCall',NULL,'42565564456','KFC','Colonel Sanders','7 Farnell Street\nNabiac, NSW, 2312','2015-01-30','2015-02-06',7,'Burgerz!',1,5000,500,5500,'2015-01-30','2015-01-30','/media/invoices/11/invoice_110_KFC_001.pdf',0,1),(111,'MCD-002',5,11,'Wallamba','Grant McCall',NULL,'42565564456','McDonalds','Ronald','7 Smith Street','2015-01-31','2015-02-07',7,'xzdssdd',1,12000,1200,13200,'2015-01-31','2015-01-31','/media/invoices/11/invoice_111_MCD_002.pdf',0,2),(112,'MCD-001',10,48,'Smith Electrics','Thomas Smith',NULL,'1938729384738','McDonalds','Ronald','asdjklfha s;dlfkj a;sldkfjasdfasdf','2015-01-31','2015-02-08',8,'a;lsdjkf a;lsdkjf ;asldfasdf',1,10000,1000,11000,'2015-01-31','2015-01-31','/media/invoices/48/invoice_112_MCD_001.pdf',0,1),(113,'SOM-001',11,49,'Igor\'s Company','Igor Pantović',NULL,'12345678','Some Client','Somebody','Some address','2015-01-31','1970-01-01',0,'Some services',0,500,0,500,'2015-01-31','2015-01-31','',0,1),(114,'NIC-001',12,11,'Wallamba','Grant McCall',NULL,'42565564456','Nicole','Nicoles','a;lsdkjf;alskdjfasdfasdf','2015-02-06','2015-02-13',7,'zxcvzxcvzxcv',0,15000,1500,16500,'2015-02-06','2015-02-06','',0,1),(115,'AST-001',6,11,'Wallamba','Grant McCall',NULL,'42565564456','Astute Payroll','Nicholas Beames',NULL,'2015-02-09','2015-02-16',7,'',0,0,0,0,'2015-02-09','2015-02-09','',0,1),(116,'DIC-001',16,11,'Wallamba','Grant McCall',NULL,'42565564456','DIck Smith','Dick','45 Fig street\nMelbourne, 3000','2015-02-10','2015-02-17',7,'Stuff',1,5000,500,5500,'2015-02-10','2015-02-10','/media/invoices/11/invoice_116_DIC_001.pdf',0,1);
/*!40000 ALTER TABLE `bsr_invoices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bsr_migrations`
--

DROP TABLE IF EXISTS `bsr_migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bsr_migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bsr_migrations`
--

LOCK TABLES `bsr_migrations` WRITE;
/*!40000 ALTER TABLE `bsr_migrations` DISABLE KEYS */;
INSERT INTO `bsr_migrations` VALUES ('2014_06_11_041038_create_users_table',1),('2013_06_27_143953_create_cronmanager_table',2),('2013_06_27_144035_create_cronjob_table',2);
/*!40000 ALTER TABLE `bsr_migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bsr_recurrings`
--

DROP TABLE IF EXISTS `bsr_recurrings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bsr_recurrings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `expense_id` int(11) DEFAULT NULL,
  `expense_date` datetime DEFAULT NULL,
  `frequency` varchar(255) DEFAULT NULL,
  `until` varchar(10) DEFAULT NULL,
  `until_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bsr_recurrings`
--

LOCK TABLES `bsr_recurrings` WRITE;
/*!40000 ALTER TABLE `bsr_recurrings` DISABLE KEYS */;
/*!40000 ALTER TABLE `bsr_recurrings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bsr_reminders`
--

DROP TABLE IF EXISTS `bsr_reminders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bsr_reminders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `summary` tinyint(1) DEFAULT NULL,
  `invoice_overdue` tinyint(1) DEFAULT NULL,
  `end_quarter` tinyint(1) DEFAULT NULL,
  `bas_overdue` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bsr_reminders`
--

LOCK TABLES `bsr_reminders` WRITE;
/*!40000 ALTER TABLE `bsr_reminders` DISABLE KEYS */;
INSERT INTO `bsr_reminders` VALUES (1,1,1,0,0,1),(2,16,0,0,0,1);
/*!40000 ALTER TABLE `bsr_reminders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bsr_users`
--

DROP TABLE IF EXISTS `bsr_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bsr_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bsr_users`
--

LOCK TABLES `bsr_users` WRITE;
/*!40000 ALTER TABLE `bsr_users` DISABLE KEYS */;
INSERT INTO `bsr_users` VALUES (1,'admin','$2y$10$6V0hPPlq14KQ4U0P13AFkeSj58bBRqcGyBjo018GHajvSj35pBLZa','admin@admin.com','WSNi72JRA5svd78uqmmJgUuBJQI1FD4MIbCrgVR89sGj27BT4KK4L8co9FKn','2014-06-11 08:25:17','2015-02-11 03:22:56'),(2,'jr7vn','$2y$10$q2TFuxXQktY3N4dJ7vf0/e7CTNzzFKxeFo75ySB0PEGgxGCN7D4s2','htle1810@gmail.com',NULL,'2014-06-11 16:03:39','2014-06-12 22:30:27'),(3,'Test1','e10adc3949ba59abbe56e057f20f883e','test1@test.com',NULL,'2014-06-23 05:38:54','0000-00-00 00:00:00'),(4,'Impholo@gmail.com','e10adc3949ba59abbe56e057f20f883e','impholo@gmail.com',NULL,'2014-06-23 17:06:24','0000-00-00 00:00:00'),(6,'qwer','81dc9bdb52d04dc20036dbd8313ed055','a1@a.a',NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(7,'Ffgv','81dc9bdb52d04dc20036dbd8313ed055','a2@a.a',NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(8,'ManeshB','$2y$10$HCQntiQUU3CW2Qkb45tLGubbNk0MzvdqKMXXwMBrGd0/G4Kt9ya1e','manesh.bahuguna@gmail.com','AasrjcdCWT7eHKUC4OxpqTpXZLgtX6m1hr4tBjn7zEo55QGlqsB7BgcCtBhQ','2014-06-28 16:49:19','2014-07-01 15:16:24'),(9,'test','$2y$10$8eXH5kgI7/GJ43ujLB/nre8UAwsWGcYPSKxYniXU5lsTaPgUIBwPq','test@admin.com',NULL,'2014-06-28 16:52:07','2014-06-28 16:52:07'),(11,'grant','$2y$10$./642qi36lzcLHzZABYNe.QL4Cljw76/veFH94b8ZoxFsBVRSLfze','grant@grantmccall.com','C70L0VTh0RFfGLGmjzwO0VUJnivvUL0BEimsnA8hT48APDb1YuT1DO6S5gwd','2014-06-30 13:14:41','2015-02-10 05:21:51'),(12,'trungle','$2y$10$V6OExNd7o/Zl9cxmSd.wHuYE6TLfr/W7NLwJAA1JIYiWIY7C65WJ.','tes1@admin.com',NULL,'2014-06-30 23:46:40','2014-06-30 23:46:40'),(13,'Abc','$2y$10$m.IrGLSzbkhG1a30xS/zhOSRYRq9ulG9NyMsxgNYOx/2dg.9JrxMe','test2@admin.com','xVWqWGfN2GmJKK8Ug8TSvr9OLQhmbB3095zxoZMRGxEIWCmQthHmHi4txPXJ','2014-06-30 23:47:13','2014-07-08 16:32:20'),(15,'test3','$2y$10$hb7jMazdLD/4hSxJfGaj8uKGA2qSh9LkgPJrQp7MHNEEoyzk5Qemq','test3@admin.com',NULL,'2014-07-01 14:44:47','2014-07-01 14:44:47'),(16,'ManeshBahuguna','$2y$10$5WTNPF7x652FMbJTNTwRiO5s96GluQcQUZCiFPrgGazAXo.pudJly','manesh_2660632@yahoo.com','qLj74LM2uqnPGnhQ0VAnVtYr1t7n9EUbuKZtxPHAyZBqPPqhO7hfdnpayPSY','2014-07-01 15:18:10','2015-02-11 03:16:01'),(17,'tester','1234','tester@test.com',NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(18,'Eeeeeee','1234','aaaa@aa.a',NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(19,'tester','1234','tester1@test.com',NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(20,'tester','1234','tester2@test.com',NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(21,'new memeber','1234','mem@mem.com',NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(22,'Sidharth','0009','pagudpudsunset@yahoo.com',NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(23,'trungle2','$2y$10$.1zylDfZRchOr1SwMMobM.2g8n2BERw4V.Dg0fWdTuPigFX2ZLFKG','trungle@admin.com',NULL,'2014-07-06 12:20:16','2014-07-06 12:20:16'),(24,'levTest','$2y$10$rAurnyH08E/0bwir/PC9T.qdrgPeM3cX6DgxIHjHnHfOiY2ae9Vey','levTest@test.com',NULL,'2014-07-06 18:22:52','2014-07-06 18:22:52'),(27,'apitest','$2y$10$XX62vC2NtL42pTFLQjZq8.LUCoZcPx6giYrabKdfAxzk3LMacdEIK','api1@api.com',NULL,'2014-07-07 17:03:45','2014-07-07 17:03:45'),(28,'apitest','$2y$10$kJcQAQf3F1rlleNtXDTvK.RcMQttUGgDhgfZuXpqCfASaEhb8XR0.','api2@api.com',NULL,'2014-07-07 17:06:39','2014-07-07 17:06:39'),(29,'apitest','$2y$10$dxDuwwkRyL2T5H/GUf5qX.aSnjKsblxXVZCB9c7svPrgxAqxt67vu','api3@api.com',NULL,'2014-07-07 17:07:58','2014-07-07 17:07:58'),(30,'apitest','$2y$10$Fp5p3xSQITWtLulrk.zMF.GX2njShGypkortpI9u35GavEJourUXu','api4@api.com',NULL,'2014-07-07 17:09:02','2014-07-07 17:09:02'),(31,'apitest','$2y$10$pTUNgtw0YeKNtG9sDBP9n.S9TuWnzsqAMmTg4gnURnna2Ux7fI8v6','api5@api.com',NULL,'2014-07-07 17:46:33','2014-07-07 17:46:33'),(32,'apitest','$2y$10$ug9bQ.JwKGugrwrrRVNBUu8qSISRLLxsWYHe65YFHSG/k/7lKtKHS','api6@api.com',NULL,'2014-07-07 17:52:53','2014-07-07 17:52:53'),(33,'astutepayroll','$2y$10$zELK.s7NfP3jcqJAkgFrz.HC66zrIO2h4KWqAtDG55d5c/LjpwQUi','grant.mccall@astutepayroll.com','ybf94iFTsla8sWuQQFuSvmBPiCmT0292zjOLlKQSj0OHfdoU1XQoVV3rvc4I','2014-07-07 22:20:16','2014-07-07 22:51:41'),(34,'','$2y$10$UqHB26PuIbpuKBJE7.gnLOG4e2p6.pyjljM.0xqBBopR5SwXqKa5.','test4@admin.com',NULL,'2014-07-08 01:21:03','2014-07-08 01:21:03'),(36,'','$2y$10$TZlRL9Z0dil4yK1p4Xv2J.xO/HGyKrAljmi.Ndkxe78P26IHfNKsm','test1@admin.com','hQ2Zdzb8Q6Nuk0LGHVGRaG6y3llLjlJMPyN9cQvYMyzrSNLLFFvyb9rsFDAT','2014-07-08 16:32:34','2014-07-08 16:32:51'),(38,'api7@api.com','$2y$10$HOWcz/jmT1VAcjEHLC/KXOtLi1KiH5qieDtM3XNSvx7rxGc1ELDKG','api7@api.com',NULL,'2014-07-09 15:40:13','2014-07-09 15:40:13'),(39,'api7@api.com','$2y$10$lk9PsdsbR06.OVFyQU0kxu8fksaGJ8I.Wx0Y2Ul0l6u9QdlbRleaS','api8@api.com',NULL,'2014-07-09 15:43:30','2014-07-09 15:43:30'),(40,'Api9','$2y$10$RUvefSjTmNIgFhPpjaAcXeYMpgHVjGXipiYkRZgAREYByDkKsqSOu','api9@api.com',NULL,'2014-07-09 15:46:26','2014-07-09 15:46:26'),(41,'Api10@api.com','$2y$10$2AbUT5iy7Yq1uLLN8Gz7Xu/0tq5C1TRhWLEVezpzG.taJjpYVHhdu','api10@api.com',NULL,'2014-07-09 15:48:40','2014-07-09 15:48:40'),(42,'','$2y$10$IQbNPQ2t8rtdGLVtufoqf.Mr104vvA1xw.gh7z4uXg9z5LghPuEU2','sloveoflove@yahoo.com','0SqmElE1bdVJOHC0Ij68Mxe3SD9fjvlCZEOQWAlbNzwcK5Z2iDgMgrhVhniA','2014-07-15 21:00:19','2014-07-15 21:00:42'),(43,'','$2y$10$CYF4u.bq4R6bjjeE9Sta4OFY6G1Jmy0Wfuty.HuBxTzXGMgPIbxd6','lethieu88@gmail.com','OySFFYmGtpy12wCH01V28QEFifqAdSM5icf0mIza0nzjDGFnDbnBwMYYiv2s','2014-07-16 03:23:46','2014-07-16 03:28:42'),(44,'','$2y$10$ttWqZABKfoelk7Cw1wzuMetVuVvtZ5Segiu0fMnwqN/k26FzmLw.K','test1@gmail.com','oDhLpBt9FxV6Bq8vZsTc4vNhHoACkA9psNW92ILaSBiGcAPTUklvPVvX7KJr','2014-11-10 13:29:48','2014-11-10 13:30:04'),(45,'','$2y$10$hDUt5CgW301TaJj29X7TzOVtPDPrkxNpf1jBWZkXz5k2qd1RfE3Iu','setting@admin.com',NULL,'2014-12-09 05:34:18','2014-12-09 05:34:18'),(46,'','$2y$10$.Zca5Td/DDT3XVaZgJDYYu73NwCPFlc/G.pmabY8LEIJTY7u7gOyi','trungle@abc.com',NULL,'2015-01-07 10:04:03','2015-01-07 10:04:03'),(47,'','$2y$10$VIP//74caoSn.UZF7FBpwuJ2zSZRDgmBGLzI4YgSfg5kb3T1v2RhG','vldbbc@gmail.com',NULL,'2015-01-22 08:46:12','2015-01-22 08:46:12'),(48,'','$2y$10$2Ujg/iLDkn8wPK2R8a/FB.vvGzHd2u7BLMMblYtMaSXg33rlGPgDa','grant@wallamba.com','nPLBlDiXNiteNtD46Arf5Y9jPaLQFVYj9Zib1eVNo1abf6VR5x5NQnu913yE','2015-01-31 08:12:36','2015-01-31 09:11:05'),(49,'','$2y$10$drLRxi.GFw0nGkd5LuejAeF/gWUG5cZgQBsrzV3vDFd3k8HA5r9aq','php.igor@gmail.com',NULL,'2015-01-31 10:13:56','2015-01-31 10:13:56');
/*!40000 ALTER TABLE `bsr_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'rounded.dev'
--

--
-- Dumping routines for database 'rounded.dev'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-02-12  0:59:41
