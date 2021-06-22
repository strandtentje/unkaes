-- MariaDB dump 10.19  Distrib 10.5.10-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: unkaes
-- ------------------------------------------------------
-- Server version	10.5.10-MariaDB-2

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `gesprek`
--

DROP TABLE IF EXISTS `gesprek`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gesprek` (
  `gesprekid` int(11) NOT NULL AUTO_INCREMENT,
  `persoona` varchar(100) DEFAULT NULL,
  `persoonb` varchar(100) DEFAULT NULL,
  `reflectieaid` int(11) DEFAULT NULL,
  `reflectiebid` int(11) DEFAULT NULL,
  `datum` date DEFAULT NULL,
  PRIMARY KEY (`gesprekid`),
  KEY `reflectieaid` (`reflectieaid`),
  KEY `reflectiebid` (`reflectiebid`),
  KEY `persoona` (`persoona`),
  KEY `persoonb` (`persoonb`),
  CONSTRAINT `gesprek_ibfk_1` FOREIGN KEY (`reflectieaid`) REFERENCES `reflectie` (`reflectieid`),
  CONSTRAINT `gesprek_ibfk_2` FOREIGN KEY (`reflectiebid`) REFERENCES `reflectie` (`reflectieid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `reflectie`
--

DROP TABLE IF EXISTS `reflectie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reflectie` (
  `reflectieid` int(11) NOT NULL AUTO_INCREMENT,
  `naam` varchar(100) DEFAULT NULL,
  `tekst` text DEFAULT NULL,
  `datum` date DEFAULT NULL,
  PRIMARY KEY (`reflectieid`),
  KEY `naam` (`naam`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `verbodenwoord`
--

DROP TABLE IF EXISTS `verbodenwoord`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `verbodenwoord` (
  `verbodenwoordid` int(11) NOT NULL AUTO_INCREMENT,
  `woord` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`verbodenwoordid`),
  KEY `woord` (`woord`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `woord`
--

DROP TABLE IF EXISTS `woord`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `woord` (
  `woordid` int(11) NOT NULL AUTO_INCREMENT,
  `reflectieid` int(11) DEFAULT NULL,
  `woord` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`woordid`),
  KEY `reflectieid` (`reflectieid`),
  KEY `woord` (`woord`),
  CONSTRAINT `woord_ibfk_1` FOREIGN KEY (`reflectieid`) REFERENCES `reflectie` (`reflectieid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-06-17 20:57:28
