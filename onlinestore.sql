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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `category` */

insert  into `category`(`id`,`category_name`) values (1,'Cameras\r\n'),(2,'WhiteGoods'),(3,'Audio'),(4,'Computers and Tablets');

/*Table structure for table `product` */

DROP TABLE IF EXISTS `product`;

CREATE TABLE `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` varchar(10) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=latin1;

/*Data for the table `product` */

insert  into `product`(`id`,`product_id`,`category_id`,`product_name`,`price`) values (33,'C2',1,'Canon 7D','2999'),(34,'C3',1,'Canon EOS 1100D','418'),(35,'W1',2,'LG Fridge','670'),(36,'W2',2,'Breville Toaster','99'),(37,'A1',3,'Sony Speakers','499'),(38,'A2',3,'Sennheiser Headphones','299'),(39,'A3',3,'Bose QC15 Headphones','329'),(40,'CT1',4,'Apple iPad Air','599'),(41,'CT2',4,'Apple Macbook Pro','1899'),(42,'CT3',4,'Toshiba Laptop','1399'),(43,'CT4',4,'Apple iPad Mini','499'),(44,'CT5',4,'Apple Mac Pro','2999'),(45,'CT6',4,'Samsung Galaxy Tab','699'),(46,'CT7',4,'Asus Sub-notebook','498'),(47,'CT8',4,'Brother Laser Printer','399'),(48,'CT9',4,'Seagate External HDD 1TB','129');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
