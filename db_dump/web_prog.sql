-- MySQL dump 10.13  Distrib 5.6.20, for Win32 (x86)
--
-- Host: localhost    Database: web_prog
-- ------------------------------------------------------
-- Server version	5.6.20

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
-- Current Database: `web_prog`
--

/*!40000 DROP DATABASE IF EXISTS `web_prog`*/;

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `web_prog` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `web_prog`;

--
-- Table structure for table `options`
--

DROP TABLE IF EXISTS `options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `options_id` int(11) NOT NULL,
  `lang_code` varchar(2) NOT NULL,
  `name` varchar(100) NOT NULL,
  `opt_values` text NOT NULL,
  `prices` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `options_id_idx` (`options_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `options`
--

LOCK TABLES `options` WRITE;
/*!40000 ALTER TABLE `options` DISABLE KEYS */;
INSERT INTO `options` VALUES (1,1,'de','Kakaoanteil','80%|90%|100%','2|3|4'),(2,2,'de','Aromazusatz','Erdbeer|Orange|Käse','2|4|10'),(3,3,'de','Geschmacksrichtung','Weiss|Schwarz|Milch','0|0|0'),(5,1,'en','cocoa','80%|90%|100%','2|3|4'),(6,2,'en','flavor','Strawberry|Orange|Cheese','2|4|10');
/*!40000 ALTER TABLE `options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prod_opt`
--

DROP TABLE IF EXISTS `prod_opt`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `prod_opt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prod_id` int(11) NOT NULL,
  `option_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `prod_id_idx` (`prod_id`),
  KEY `opt_id_idx` (`option_id`),
  CONSTRAINT `opt_id` FOREIGN KEY (`option_id`) REFERENCES `options` (`options_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `prod_id` FOREIGN KEY (`prod_id`) REFERENCES `products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prod_opt`
--

LOCK TABLES `prod_opt` WRITE;
/*!40000 ALTER TABLE `prod_opt` DISABLE KEYS */;
INSERT INTO `prod_opt` VALUES (1,6,1),(2,6,2),(3,13,3),(4,14,3);
/*!40000 ALTER TABLE `prod_opt` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(30) NOT NULL,
  `price` double NOT NULL DEFAULT '0',
  `img` varchar(100) NOT NULL,
  `options` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'pralines',10,'pralinen.jpg',NULL),(2,'pralines',24.5,'pralinen.jpg',NULL),(3,'pralines',33.1,'pralinen.jpg',NULL),(6,'tafeln',12.5,'dunkleSchokolade.jpg','1,2,3'),(7,'tafeln',13.5,'weisseSchokolade.jpg',NULL),(8,'tafeln',13.5,'milchSchokolade.jpg',NULL),(9,'zutaten',1.5,'zucker.jpg',NULL),(10,'zutaten',5.5,'kakao.png',NULL),(11,'zubehoer',49,'mixer.jpg',NULL),(12,'zubehoer',8.1,'gabel.jpg',NULL),(13,'pralines',9.5,'Eierlikoer.jpg',NULL),(14,'pralines',10.5,'Marzipan.jpg',NULL),(15,'pralines',11,'Baileys.jpg',NULL),(16,'pralines',8,'Amarettini.jpg',NULL),(17,'zubehoer',390,'cow.jpg',NULL);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products_lang`
--

DROP TABLE IF EXISTS `products_lang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products_lang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `lang_code` varchar(2) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`),
  KEY `product_id_idx` (`product_id`),
  CONSTRAINT `product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products_lang`
--

LOCK TABLES `products_lang` WRITE;
/*!40000 ALTER TABLE `products_lang` DISABLE KEYS */;
INSERT INTO `products_lang` VALUES (6,6,'de','Dunkle Schokolade','Feinste dunkle Schokolade in 3 verschiedenen Varianten'),(7,7,'de','Weisse Schokolade','Feinste weisse Schokolade'),(8,8,'de','Milchschokolade','Feinste Milchschokolade'),(9,9,'de','Zucker (1kg)',' Feinkristallzucker 1Kg'),(10,10,'de','Kakaopulvver','Dr. Oetker Kakao zum Backen eignet sich besonders für Ihre Backrezepte. Das vollmundige Aroma und die rötlich dunkle Farbe garantieren ein hervorragendes Backergebnis. Ideal auch für die Zubereitung von köstlichen Desserts und Trinkschokolade.'),(11,11,'de','450 Watt Mixer','(450 Watt, 5 Geschwindigkeitsstufen) weiss'),(12,12,'de','Gabel','Eine Gabel'),(13,13,'de','Eierlikör (12 Stk.)','Feinste Eierlikör Pralinen in 3 verschiedenen Varianten'),(14,14,'de','Marzipan (12 Stk.)','Feinste Marzipan Pralinen in 3 verschiedenen Varianten'),(15,15,'de','Baileys (12 Stk.)','Feinste Baileys Pralinen'),(16,16,'de','Amarettini (12 Stk.)','Feinste Amarettini Pralinen'),(17,17,'de','Eine Kuh','Damit die beste Schokolade entsteht, benötigen Sie frische Milch.'),(18,6,'en','dark chocolate','The finest dark chocolate in 3 different variants');
/*!40000 ALTER TABLE `products_lang` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `pw` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'test','1234');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-01-12 15:49:09
