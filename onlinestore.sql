/*
SQLyog Ultimate v11.33 (64 bit)
MySQL - 5.6.16 : Database - onlinestore
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `category` */

DROP TABLE IF EXISTS `category`;

CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) DEFAULT NULL,
  `slug` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

/*Data for the table `category` */

insert  into `category`(`id`,`category_name`,`slug`) values (11,'Cameras','cameras'),(12,'WhiteGoods','whitegoods'),(13,'Audio','audio'),(14,'Computers and Tablets','computers_and_tablets');

/*Table structure for table `product` */

DROP TABLE IF EXISTS `product`;

CREATE TABLE `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` varchar(10) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `slug` varchar(50) DEFAULT NULL,
  `deleted` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=latin1;

/*Data for the table `product` */

insert  into `product`(`id`,`product_id`,`category_id`,`product_name`,`price`,`slug`,`deleted`) values (65,'C2',11,'Canon 7D','2999','canon_7d',0),(66,'C3',11,'Canon EOS 1100D','418','canon_eos_1100d',0),(67,'W1',12,'LG Fridge','670','lg_fridge',0),(68,'W2',12,'Breville Toaster','99','breville_toaster',0),(69,'A1',13,'Sony Speakers','499','sony_speakers',0),(70,'A2',13,'Sennheiser Headphones','299','sennheiser_headphones',0),(71,'A3',13,'Bose QC15 Headphones','329','bose_qc15_headphones',0),(72,'CT1',14,'Apple iPad Air','599','apple_ipad_air',0),(73,'CT2',14,'Apple Macbook Pro','1899','apple_macbook_pro',0),(74,'CT3',14,'Toshiba Laptop','1399','toshiba_laptop',0),(75,'CT4',14,'Apple iPad Mini','499','apple_ipad_mini',0),(76,'CT5',14,'Apple Mac Pro','2999','apple_mac_pro',0),(77,'CT6',14,'Samsung Galaxy Tab','699','samsung_galaxy_tab',0),(78,'CT7',14,'Asus Sub-notebook','498','asus_sub_notebook',0),(79,'CT8',14,'Brother Laser Printer','399','brother_laser_printer',0),(80,'CT9',14,'Seagate External HDD 1TB','129','seagate_external_hdd_1tb',0);

/*Table structure for table `product_import_temp` */

DROP TABLE IF EXISTS `product_import_temp`;

CREATE TABLE `product_import_temp` (
  `product_id` varchar(10) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `price` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `product_import_temp` */

insert  into `product_import_temp`(`product_id`,`category`,`product_name`,`price`) values ('C2','Cameras','Canon 7D','2999'),('C3','Cameras','Canon EOS 1100D','418'),('W1','WhiteGoods','LG Fridge','670'),('W2','WhiteGoods','Breville Toaster','99'),('A1','Audio','Sony Speakers','499'),('A2','Audio','Sennheiser Headphones','299'),('A3','Audio','Bose QC15 Headphones','329'),('CT1','Computers and Tablets','Apple iPad Air','599'),('CT2','Computers and Tablets','Apple Macbook Pro','1899'),('CT3','Computers and Tablets','Toshiba Laptop','1399'),('CT4','Computers and Tablets','Apple iPad Mini','499'),('CT5','Computers and Tablets','Apple Mac Pro','2999'),('CT6','Computers and Tablets','Samsung Galaxy Tab','699'),('CT7','Computers and Tablets','Asus Sub-notebook','498'),('CT8','Computers and Tablets','Brother Laser Printer','399'),('CT9','Computers and Tablets','Seagate External HDD 1TB','129');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
