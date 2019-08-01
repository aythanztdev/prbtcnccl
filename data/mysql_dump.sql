-- MySQL dump 10.13  Distrib 8.0.16, for osx10.14 (x86_64)
--
-- Host: localhost    Database: prbtcnccl
-- ------------------------------------------------------
-- Server version	8.0.16

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8mb4 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'Arts & Photography Books','Explore the arts with titles on art history, artists, fashion, photography, and browse our picks for best art and photography books of the year.','2019-08-01 21:27:37','2019-08-01 21:28:07','2019-08-01 21:28:07'),(2,'Cookbooks, Food & Wine','Browse our picks for the best cooking, food, and wine books of the month and the best books of the year so far.','2019-08-01 21:28:32','2019-08-01 21:28:32',NULL),(3,'History','Browse for books about American history, ancient history, military history, or browse our picks for the best history books of the year so far.','2019-08-01 21:31:17','2019-08-01 21:31:17',NULL),(4,'Science Fiction & Fantasy','Find your new favorite book in science fiction or fantasy. Plus, see our picks for the best science fiction and fantasy of the year so far.','2019-08-01 21:32:49','2019-08-01 21:32:49',NULL);
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migration_versions`
--

DROP TABLE IF EXISTS `migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migration_versions`
--

LOCK TABLES `migration_versions` WRITE;
/*!40000 ALTER TABLE `migration_versions` DISABLE KEYS */;
INSERT INTO `migration_versions` VALUES ('20190731191744','2019-08-01 21:26:28');
/*!40000 ALTER TABLE `migration_versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `currency` enum('EUR','USD') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:CurrencyEnum)',
  `featured` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D34A04AD12469DE2` (`category_id`),
  CONSTRAINT `FK_D34A04AD12469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (1,2,'The Whole30',4.97,'USD',0,'2019-08-01 21:29:19','2019-08-01 21:29:19',NULL),(2,2,'The Complete Ketogenic Diet',5.76,'USD',1,'2019-08-01 21:29:49','2019-08-01 21:29:49',NULL),(3,2,'Cook Korean!: A Comic Book',1.99,'EUR',1,'2019-08-01 21:30:15','2019-08-01 21:30:15',NULL),(4,2,'Instant Pot Pressure Cooker',13.00,'EUR',0,'2019-08-01 21:31:01','2019-08-01 21:31:01',NULL),(5,3,'Unfreedom of the Press',13.44,'USD',0,'2019-08-01 21:31:44','2019-08-01 21:31:44',NULL),(6,3,'Elon Musk: Tesla, SpaceX, and the Quest for a Fantastic Future',8.20,'USD',1,'2019-08-01 21:32:04','2019-08-01 21:32:04',NULL),(7,3,'Three Women',13.99,'EUR',1,'2019-08-01 21:32:21','2019-08-01 21:32:21',NULL),(8,3,'Grant',1.99,'EUR',0,'2019-08-01 21:32:35','2019-08-01 21:32:35',NULL),(9,4,'Shrouded Loyalties',12.99,'USD',0,'2019-08-01 21:33:15','2019-08-01 21:33:15',NULL),(10,4,'The Gurkha and the Lord of Tuesday',3.99,'USD',1,'2019-08-01 21:33:28','2019-08-01 21:33:28',NULL),(11,4,'Meet Me in the Future: Stories',10.91,'EUR',1,'2019-08-01 21:33:46','2019-08-01 21:33:46',NULL),(12,4,'Blood of an Exile (Dragons of Terra)',29.99,'EUR',0,'2019-08-01 21:34:01','2019-08-01 21:34:01',NULL);
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-08-01 22:35:21
