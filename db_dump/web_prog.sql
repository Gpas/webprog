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
  `opt_values` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `options`
--

LOCK TABLES `options` WRITE;
/*!40000 ALTER TABLE `options` DISABLE KEYS */;
INSERT INTO `options` VALUES (1,'80%|90%|100%'),(2,'Erdbeer|Mango|Käse');
/*!40000 ALTER TABLE `options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `options_lang`
--

DROP TABLE IF EXISTS `options_lang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `options_lang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `options_id` int(11) NOT NULL,
  `lang_code` varchar(2) NOT NULL,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `options_id_idx` (`options_id`),
  CONSTRAINT `options_id` FOREIGN KEY (`options_id`) REFERENCES `options` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `options_lang`
--

LOCK TABLES `options_lang` WRITE;
/*!40000 ALTER TABLE `options_lang` DISABLE KEYS */;
INSERT INTO `options_lang` VALUES (1,1,'de','Kakaoanteil'),(2,2,'de','Aromazusatz');
/*!40000 ALTER TABLE `options_lang` ENABLE KEYS */;
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
  CONSTRAINT `opt_id` FOREIGN KEY (`option_id`) REFERENCES `options` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `prod_id` FOREIGN KEY (`prod_id`) REFERENCES `products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prod_opt`
--

LOCK TABLES `prod_opt` WRITE;
/*!40000 ALTER TABLE `prod_opt` DISABLE KEYS */;
INSERT INTO `prod_opt` VALUES (1,6,1),(2,6,2);
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'pralines',10,'pralinen.jpg',NULL),(2,'pralines',24.5,'pralinen.jpg',NULL),(3,'pralines',33.1,'pralinen.jpg',NULL),(6,'tafeln',12.5,'dunkleSchokolade.jpg','1,2,3'),(7,'tafeln',13.5,'weisseSchokolade.jpg',NULL),(8,'tafeln',13.5,'milchSchokolade.jpg',NULL),(9,'zutaten',1.5,'zucker.jpg',NULL),(10,'zutaten',5.5,'kakao.png',NULL),(11,'zubehoer',49,'mixer.jpg',NULL),(12,'zubehoer',8.1,'gabel.jpg',NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products_lang`
--

LOCK TABLES `products_lang` WRITE;
/*!40000 ALTER TABLE `products_lang` DISABLE KEYS */;
INSERT INTO `products_lang` VALUES (1,1,'de','Testprodukt','Testbeschreibung'),(2,2,'de','Testprodukt 2','Testbeschreibung 2'),(3,3,'de','TestProdukt 3','bla bla bla bla'),(6,6,'de','Dunkle Schokolade','Feinste dunkle Schokolade in 3 verschiedenen Varianten'),(7,7,'de','Weisse Schokolade','Feinste weisse Schokolade'),(8,8,'de','Milchschokolade','Feinste Milchschokolade'),(9,9,'de','Zucker (1kg)',' Feinkristallzucker 1Kg'),(10,10,'de','Kakaopulvver','Dr. Oetker Kakao zum Backen eignet sich besonders für Ihre Backrezepte. Das vollmundige Aroma und die rötlich dunkle Farbe garantieren ein hervorragendes Backergebnis. Ideal auch für die Zubereitung von köstlichen Desserts und Trinkschokolade.'),(11,11,'de','450 Watt Mixer','(450 Watt, 5 Geschwindigkeitsstufen) weiss'),(12,12,'de','Gabel','Eine Gabel');
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

-- Dump completed on 2015-01-08 11:46:54
