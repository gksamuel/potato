-- MySQL dump 10.15  Distrib 10.0.21-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: andela
-- ------------------------------------------------------
-- Server version	10.0.21-MariaDB

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
-- Table structure for table `Bicycle`
--

DROP TABLE IF EXISTS `Bicycle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Bicycle` (
  `cycleID` int(11) NOT NULL AUTO_INCREMENT,
  `model` varchar(100) NOT NULL,
  `numberOfGears` int(11) NOT NULL,
  PRIMARY KEY (`cycleID`),
  UNIQUE KEY `model` (`model`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Bicycle`
--

LOCK TABLES `Bicycle` WRITE;
/*!40000 ALTER TABLE `Bicycle` DISABLE KEYS */;
INSERT INTO `Bicycle` VALUES (1,'Volkswagen',10),(2,'Raleigh',29975),(3,'Shimano',10),(5,'Peugeot',10),(6,'BMW 1889',10000),(7,'BMW',10000),(8,'BMW 1876',10000),(9,'BMW 1677',10000),(10,'Raleigh 1521',10000),(13,'Raleigh 1864',10000);
/*!40000 ALTER TABLE `Bicycle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Car`
--

DROP TABLE IF EXISTS `Car`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Car` (
  `carID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `price` double(10,2) NOT NULL,
  PRIMARY KEY (`carID`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Car`
--

LOCK TABLES `Car` WRITE;
/*!40000 ALTER TABLE `Car` DISABLE KEYS */;
INSERT INTO `Car` VALUES (5,'Beetle',10000.00),(6,'BMW 3200 CS',60000.00),(7,'BMW New Class',70000.00),(8,'BMW 2000C and 2000CS',80000.00),(9,'BMW CS',90000.00),(10,'Volkswagen',10000.00),(11,'BMW i8',110000.00),(12,'BMW M1',120000.00),(13,'BMW Z1',130000.00),(14,'BMW Z8',140000.00),(15,'BMW 3 Series',150000.00),(16,'BMW 5 Series',160000.00),(17,'BMW X5',170000.00),(18,'Bugatti Type 18',180000.00),(19,'Bugatti Type 29',190000.00),(20,'Bugatti Type 30',200000.00),(21,'Bugatti Type 32',210000.00),(22,'Bugatti Type 35',220000.00),(23,'Bugatti Type 37',230000.00),(24,'nissan',10000.00),(25,'buggati',27070.00),(83,'BMW 1030',10000.00),(84,'BMW',10000.00),(86,'BMW 1520',10000.00);
/*!40000 ALTER TABLE `Car` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `User`
--

DROP TABLE IF EXISTS `User`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `User` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(20) NOT NULL,
  `lastName` varchar(20) NOT NULL,
  `dateOfBirth` date NOT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `User`
--

LOCK TABLES `User` WRITE;
/*!40000 ALTER TABLE `User` DISABLE KEYS */;
INSERT INTO `User` VALUES (4,'Josephat187','125','1991-06-01'),(5,'Josephat163','LastName 107','1991-06-01'),(6,'Josephat143','LastName 182','1991-06-01'),(7,'Josephat127','LastName 150','1991-06-01'),(23,'Josephat120','LastName 149','1991-06-01'),(25,'Josephat113','LastName 130','1991-06-01');
/*!40000 ALTER TABLE `User` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-03-20  10:19:46
