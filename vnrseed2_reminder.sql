-- MySQL dump 10.13  Distrib 5.7.33, for Linux (x86_64)
--
-- Host: localhost    Database: vnrseed2_reminder
-- ------------------------------------------------------
-- Server version	5.7.33-cll-lve

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
-- Table structure for table `app_version`
--

DROP TABLE IF EXISTS `app_version`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_version` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `appversion` decimal(2,1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_version`
--

LOCK TABLES `app_version` WRITE;
/*!40000 ALTER TABLE `app_version` DISABLE KEYS */;
INSERT INTO `app_version` (`id`, `appversion`) VALUES (1,2.0);
/*!40000 ALTER TABLE `app_version` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact_request`
--

DROP TABLE IF EXISTS `contact_request`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contact_request` (
  `req_id` int(11) NOT NULL AUTO_INCREMENT,
  `request_by` int(11) NOT NULL,
  `request_to` int(11) NOT NULL,
  `request_sent` int(1) NOT NULL,
  `request_approve` int(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by` int(11) NOT NULL,
  `modified_at` date NOT NULL,
  PRIMARY KEY (`req_id`)
) ENGINE=InnoDB AUTO_INCREMENT=123 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_request`
--

LOCK TABLES `contact_request` WRITE;
/*!40000 ALTER TABLE `contact_request` DISABLE KEYS */;
INSERT INTO `contact_request` (`req_id`, `request_by`, `request_to`, `request_sent`, `request_approve`, `created_at`, `modified_by`, `modified_at`) VALUES (27,13,3,1,1,'2019-01-10 11:00:43',0,'0000-00-00'),(28,13,2,1,1,'2019-01-14 10:45:31',0,'0000-00-00'),(32,9,16,1,1,'2019-04-20 07:40:31',0,'0000-00-00'),(33,9,17,1,1,'2019-04-20 07:34:26',0,'0000-00-00'),(34,9,19,1,1,'2019-04-20 07:34:18',0,'0000-00-00'),(35,9,18,1,1,'2019-04-20 07:35:34',0,'0000-00-00'),(36,27,26,1,1,'2019-06-14 05:47:17',0,'0000-00-00'),(37,39,35,1,1,'2019-12-24 04:38:46',0,'0000-00-00'),(38,49,8,1,1,'2022-02-02 10:22:44',0,'0000-00-00'),(39,49,9,1,1,'2020-09-18 12:38:25',0,'0000-00-00'),(40,49,35,1,1,'2020-09-20 15:24:33',0,'0000-00-00'),(41,49,11,1,1,'2020-09-20 15:24:53',0,'0000-00-00'),(42,49,15,1,1,'2020-09-20 15:24:53',0,'0000-00-00'),(43,49,17,1,1,'2020-09-20 15:24:53',0,'0000-00-00'),(44,49,18,1,1,'2020-09-20 15:24:53',0,'0000-00-00'),(45,49,19,1,1,'2020-09-20 15:24:53',0,'0000-00-00'),(46,49,21,1,1,'2020-09-20 15:24:53',0,'0000-00-00'),(47,49,22,1,1,'2020-09-20 15:24:53',0,'0000-00-00'),(48,49,26,1,1,'2020-09-20 15:24:53',0,'0000-00-00'),(49,49,27,1,1,'2020-09-20 15:24:53',0,'0000-00-00'),(50,49,28,1,1,'2020-09-20 15:24:53',0,'0000-00-00'),(51,49,31,1,1,'2020-09-20 15:24:53',0,'0000-00-00'),(52,49,34,1,1,'2020-09-20 15:24:53',0,'0000-00-00'),(53,49,37,1,1,'2020-09-20 15:24:53',0,'0000-00-00'),(54,49,1,1,1,'2020-09-20 15:24:53',0,'0000-00-00'),(55,1,50,1,1,'2020-09-20 15:24:53',0,'0000-00-00'),(56,56,58,1,1,'2020-09-21 11:07:48',0,'0000-00-00'),(57,56,35,1,0,'2020-09-28 16:17:16',0,'0000-00-00'),(58,56,22,1,0,'2020-09-28 16:26:26',0,'0000-00-00'),(59,56,17,1,0,'2020-09-29 11:50:06',0,'0000-00-00'),(60,56,49,1,0,'2020-09-29 12:17:04',0,'0000-00-00'),(61,56,34,1,0,'2020-09-29 12:17:13',0,'0000-00-00'),(62,56,28,1,0,'2020-09-29 12:51:10',0,'0000-00-00'),(63,56,15,1,0,'2020-09-29 12:51:27',0,'0000-00-00'),(64,56,26,1,0,'2020-09-30 08:05:04',0,'0000-00-00'),(65,49,59,1,1,'2020-11-18 07:50:49',0,'0000-00-00'),(66,8,49,1,1,'2022-01-18 16:11:54',0,'0000-00-00'),(67,35,22,1,1,'2022-06-16 11:34:16',0,'0000-00-00'),(68,35,11,1,0,'2020-12-22 09:34:37',0,'0000-00-00'),(69,34,49,1,1,'2022-01-18 16:11:49',0,'0000-00-00'),(70,34,8,1,1,'2022-02-02 10:23:01',0,'0000-00-00'),(71,8,34,1,1,'2022-02-02 10:22:59',0,'0000-00-00'),(72,26,49,1,1,'2021-08-20 11:56:38',0,'0000-00-00'),(73,35,49,1,1,'2021-12-06 10:30:36',0,'0000-00-00'),(74,35,49,1,1,'2021-12-06 11:37:56',0,'0000-00-00'),(75,49,34,1,1,'2022-01-18 16:11:49',0,'0000-00-00'),(76,49,8,1,1,'2022-01-18 16:11:54',0,'0000-00-00'),(77,34,49,1,1,'2022-01-21 05:59:21',0,'0000-00-00'),(78,49,59,1,0,'2022-01-23 05:44:48',0,'0000-00-00'),(79,8,49,1,1,'2022-02-02 07:16:03',0,'0000-00-00'),(80,8,49,1,1,'2022-02-02 10:22:44',0,'0000-00-00'),(81,34,8,1,1,'2022-02-02 10:22:59',0,'0000-00-00'),(82,8,34,1,1,'2022-02-02 10:23:01',0,'0000-00-00'),(83,35,49,1,1,'2022-02-02 11:27:54',0,'0000-00-00'),(84,75,76,1,1,'2022-02-02 11:55:45',0,'0000-00-00'),(85,75,77,1,1,'2022-02-02 11:57:00',0,'0000-00-00'),(86,75,78,1,1,'2022-02-02 11:58:11',0,'0000-00-00'),(87,76,75,1,1,'2022-02-02 12:16:47',0,'0000-00-00'),(88,77,75,1,1,'2022-02-02 12:19:04',0,'0000-00-00'),(89,77,76,1,1,'2022-02-02 12:24:55',0,'0000-00-00'),(90,76,75,1,1,'2022-02-02 12:24:11',0,'0000-00-00'),(91,76,77,1,1,'2022-02-02 12:24:55',0,'0000-00-00'),(92,76,75,1,1,'2022-02-02 12:31:10',0,'0000-00-00'),(93,76,77,1,0,'2022-02-02 12:33:40',0,'0000-00-00'),(94,35,49,1,1,'2022-02-03 04:28:44',0,'0000-00-00'),(95,35,49,1,1,'2022-02-03 04:28:45',0,'0000-00-00'),(96,35,49,1,1,'2022-02-03 09:15:02',0,'0000-00-00'),(97,79,81,1,1,'2022-02-05 06:07:53',0,'0000-00-00'),(98,79,73,1,1,'2022-02-05 06:06:02',0,'0000-00-00'),(99,73,79,1,1,'2022-02-05 06:08:01',0,'0000-00-00'),(100,73,81,1,1,'2022-02-05 06:07:50',0,'0000-00-00'),(101,73,79,1,1,'2022-02-05 06:06:02',0,'0000-00-00'),(102,81,73,1,1,'2022-02-05 06:07:50',0,'0000-00-00'),(103,81,79,1,1,'2022-02-05 06:07:53',0,'0000-00-00'),(104,81,73,1,1,'2022-02-05 06:07:58',0,'0000-00-00'),(105,79,73,1,1,'2022-02-05 06:08:01',0,'0000-00-00'),(106,15,49,1,1,'2022-02-05 06:17:51',0,'0000-00-00'),(107,35,49,1,1,'2022-02-05 07:02:24',0,'0000-00-00'),(108,35,49,1,1,'2022-02-24 07:23:36',0,'0000-00-00'),(109,34,49,1,1,'2022-02-28 09:40:04',0,'0000-00-00'),(110,34,49,1,1,'2022-02-28 10:00:52',0,'0000-00-00'),(111,85,80,1,1,'2022-02-28 10:30:33',0,'0000-00-00'),(112,80,85,1,1,'2022-02-28 10:30:33',0,'0000-00-00'),(113,34,49,1,1,'2022-03-02 11:45:44',0,'0000-00-00'),(114,35,49,1,1,'2022-03-05 10:37:38',0,'0000-00-00'),(115,35,49,1,1,'2022-03-08 09:14:40',0,'0000-00-00'),(116,35,49,1,1,'2022-03-09 09:35:53',0,'0000-00-00'),(117,86,0,1,1,'2022-03-10 11:55:03',0,'0000-00-00'),(118,35,49,1,1,'2022-03-10 12:03:39',0,'0000-00-00'),(119,92,0,1,1,'2022-03-11 07:18:35',0,'0000-00-00'),(120,35,49,1,1,'2022-05-05 05:13:54',0,'0000-00-00'),(121,35,49,1,1,'2022-05-20 10:00:37',0,'0000-00-00'),(122,22,35,1,1,'2022-06-16 11:34:16',0,'0000-00-00');
/*!40000 ALTER TABLE `contact_request` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `contact_name` varchar(50) NOT NULL,
  `contact_number` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contacts`
--

LOCK TABLES `contacts` WRITE;
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forward_rem`
--

DROP TABLE IF EXISTS `forward_rem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forward_rem` (
  `rm_id` int(11) NOT NULL AUTO_INCREMENT,
  `rem_id` int(11) NOT NULL,
  `froward_by` int(11) NOT NULL,
  `forward_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`rm_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forward_rem`
--

LOCK TABLES `forward_rem` WRITE;
/*!40000 ALTER TABLE `forward_rem` DISABLE KEYS */;
/*!40000 ALTER TABLE `forward_rem` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forward_user`
--

DROP TABLE IF EXISTS `forward_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forward_user` (
  `rm_id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  PRIMARY KEY (`rm_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forward_user`
--

LOCK TABLES `forward_user` WRITE;
/*!40000 ALTER TABLE `forward_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `forward_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `group_contact`
--

DROP TABLE IF EXISTS `group_contact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `group_contact` (
  `gcid` int(11) NOT NULL AUTO_INCREMENT,
  `gid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  PRIMARY KEY (`gcid`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `group_contact`
--

LOCK TABLES `group_contact` WRITE;
/*!40000 ALTER TABLE `group_contact` DISABLE KEYS */;
INSERT INTO `group_contact` (`gcid`, `gid`, `userid`) VALUES (1,1,8),(2,1,9),(3,1,7),(7,2,8),(8,2,35),(9,3,13),(10,2,13),(11,4,3),(12,4,2),(13,4,9),(14,4,8),(15,1,16),(16,1,17),(17,1,18),(18,5,8),(19,6,1),(20,7,9),(21,7,35),(22,7,11),(23,7,15),(24,7,17),(25,7,18),(26,7,19),(27,7,21),(28,7,22),(29,7,26),(30,7,27),(31,7,28),(32,7,31),(33,7,34),(34,7,37),(35,7,1),(36,8,1),(37,8,35),(38,9,35),(39,9,1),(40,10,75),(41,10,77),(42,10,78),(43,11,75),(44,11,77),(45,11,78),(46,12,75),(47,12,78);
/*!40000 ALTER TABLE `group_contact` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `group_table`
--

DROP TABLE IF EXISTS `group_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `group_table` (
  `gid` int(11) NOT NULL AUTO_INCREMENT,
  `gname` varchar(50) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by` int(11) NOT NULL,
  `modified_at` datetime NOT NULL,
  PRIMARY KEY (`gid`)
) ENGINE=InnoDB AUTO_INCREMENT=104 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `group_table`
--

LOCK TABLES `group_table` WRITE;
/*!40000 ALTER TABLE `group_table` DISABLE KEYS */;
INSERT INTO `group_table` (`gid`, `gname`, `created_by`, `created_at`, `modified_by`, `modified_at`) VALUES (1,'admin',1,'2019-01-03 08:58:15',0,'0000-00-00 00:00:00'),(2,'IT',35,'2022-03-09 11:50:54',0,'0000-00-00 00:00:00'),(3,'demo',3,'2019-01-11 13:00:53',0,'0000-00-00 00:00:00'),(4,'IT',13,'2019-01-14 10:01:35',0,'0000-00-00 00:00:00'),(5,'Abhinav',1,'2019-06-04 05:45:51',0,'0000-00-00 00:00:00'),(6,'testing group',1,'2020-09-06 14:16:55',0,'0000-00-00 00:00:00'),(7,'My Group',49,'2020-09-20 15:27:37',0,'0000-00-00 00:00:00'),(8,'my grp',53,'2020-09-21 06:35:10',0,'0000-00-00 00:00:00'),(9,'IT',56,'2020-12-02 05:42:51',0,'0000-00-00 00:00:00'),(10,'SCM North South Paddy',75,'2022-02-02 12:05:09',0,'0000-00-00 00:00:00'),(101,'VNR Seeds Pvt Ltd',0,'2022-03-09 11:05:38',0,'0000-00-00 00:00:00'),(102,'VNR Nursery Pvt Ltd',0,'2022-03-09 11:05:38',0,'0000-00-00 00:00:00'),(103,'VNR Farm Pvt Ltd',0,'2022-03-09 11:05:55',0,'0000-00-00 00:00:00');
/*!40000 ALTER TABLE `group_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logbook`
--

DROP TABLE IF EXISTS `logbook`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `logbook` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `action` varchar(80) NOT NULL,
  `device_type` varchar(100) NOT NULL,
  `ip_address` varchar(50) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logbook`
--

LOCK TABLES `logbook` WRITE;
/*!40000 ALTER TABLE `logbook` DISABLE KEYS */;
/*!40000 ALTER TABLE `logbook` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `my_note`
--

DROP TABLE IF EXISTS `my_note`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `my_note` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `des` varchar(100) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `my_note`
--

LOCK TABLES `my_note` WRITE;
/*!40000 ALTER TABLE `my_note` DISABLE KEYS */;
INSERT INTO `my_note` (`id`, `title`, `des`, `created_by`, `created_at`, `modified_by`, `modified_at`) VALUES (1,'test','test',2,'2019-01-04 11:12:46',0,'0000-00-00 00:00:00'),(2,'demo','this is demo. ',12,'2019-01-10 12:58:26',0,'0000-00-00 00:00:00'),(3,'Labour Register in electronic form','Check legality ',1,'2020-08-19 04:31:40',0,'0000-00-00 00:00:00'),(5,'hello','test',1,'2020-09-06 12:00:00',0,'0000-00-00 00:00:00'),(6,'note 1','my note description',53,'2020-09-21 12:00:00',0,'0000-00-00 00:00:00'),(7,'hj','gg',56,'2020-12-10 12:00:00',0,'0000-00-00 00:00:00'),(8,'test','test',35,'2020-12-22 12:00:00',0,'0000-00-00 00:00:00'),(9,'Doj','Sales candidate',80,'2022-02-05 12:00:00',0,'0000-00-00 00:00:00');
/*!40000 ALTER TABLE `my_note` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `my_notification`
--

DROP TABLE IF EXISTS `my_notification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `my_notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `title` text NOT NULL,
  `date` datetime NOT NULL,
  `msg` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `my_notification`
--

LOCK TABLES `my_notification` WRITE;
/*!40000 ALTER TABLE `my_notification` DISABLE KEYS */;
INSERT INTO `my_notification` (`id`, `userid`, `title`, `date`, `msg`) VALUES (11,85,'test','2022-02-28 16:05:00','test');
/*!40000 ALTER TABLE `my_notification` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notification`
--

DROP TABLE IF EXISTS `notification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notification` (
  `nid` int(11) NOT NULL AUTO_INCREMENT,
  `rem_id` int(11) NOT NULL,
  `not_time` datetime NOT NULL,
  `action` tinyint(1) NOT NULL,
  PRIMARY KEY (`nid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notification`
--

LOCK TABLES `notification` WRITE;
/*!40000 ALTER TABLE `notification` DISABLE KEYS */;
/*!40000 ALTER TABLE `notification` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rating`
--

DROP TABLE IF EXISTS `rating`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rating` (
  `rid` int(11) NOT NULL AUTO_INCREMENT,
  `rem_id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `rate` int(11) NOT NULL,
  PRIMARY KEY (`rid`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rating`
--

LOCK TABLES `rating` WRITE;
/*!40000 ALTER TABLE `rating` DISABLE KEYS */;
INSERT INTO `rating` (`rid`, `rem_id`, `userid`, `rate`) VALUES (1,20,9,3),(2,21,9,4),(3,24,9,4),(4,26,9,1),(5,40,9,5),(6,35,9,3),(7,42,17,1),(8,42,22,3),(9,41,28,3),(10,45,11,3),(11,51,27,4),(12,47,28,4),(13,47,27,4),(14,43,8,3),(15,54,28,4),(16,37,9,3),(17,59,27,4),(18,56,22,2),(19,56,21,2),(20,36,9,1),(21,61,28,3),(22,58,28,2),(23,60,28,2),(24,53,9,2);
/*!40000 ALTER TABLE `rating` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reminder`
--

DROP TABLE IF EXISTS `reminder`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reminder` (
  `rem_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(10) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL,
  `location` varchar(50) NOT NULL,
  `rem_req` int(2) NOT NULL,
  `start_date` datetime NOT NULL,
  `period` int(5) NOT NULL,
  `priority` varchar(10) NOT NULL,
  `from_date` datetime NOT NULL,
  `to_date` datetime NOT NULL,
  `Status` varchar(50) NOT NULL,
  `activity` varchar(5) NOT NULL,
  `remark` varchar(1000) NOT NULL,
  `task_img` varchar(50) DEFAULT NULL,
  `created_by` int(2) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_by` int(2) NOT NULL,
  `modified_at` datetime NOT NULL,
  PRIMARY KEY (`rem_id`)
) ENGINE=InnoDB AUTO_INCREMENT=117 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reminder`
--

LOCK TABLES `reminder` WRITE;
/*!40000 ALTER TABLE `reminder` DISABLE KEYS */;
INSERT INTO `reminder` (`rem_id`, `type`, `title`, `description`, `location`, `rem_req`, `start_date`, `period`, `priority`, `from_date`, `to_date`, `Status`, `activity`, `remark`, `task_img`, `created_by`, `created_at`, `modified_by`, `modified_at`) VALUES (19,'Public','Account finalisation - Arvind','.','.',1,'2019-04-09 05:30:00',0,'High','2019-04-09 05:30:00','2019-04-15 05:30:00','Pending','De','','',1,'0000-00-00 00:00:00',1,'2019-04-20 04:50:11'),(20,'Personal','Xml files  of aka group ','Xml files','',1,'2019-05-02 10:00:00',8,'High','2019-05-02 11:43:07','2019-05-04 11:48:07','Done','D','','',9,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00'),(21,'Personal','Photographer','4th may shamrock green ','',1,'2019-05-02 11:00:10',8,'High','2019-05-02 11:49:10','2019-05-04 11:54:10','Done','D','','',9,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00'),(24,'Public','Letters to Ministers','..','',0,'1970-01-01 05:30:00',8,'High','2019-05-31 10:45:48','2019-05-31 10:50:48','Done','D','','',1,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00'),(26,'Public','NRDA Map approval','in contact with Alok and Harsh','',0,'2019-05-31 10:52:00',8,'High','2019-05-31 12:00:00','2019-05-31 03:00:00','Done','D','','',1,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00'),(35,'Public','Agreement NRDA Alok','.','',0,'2019-05-31 04:08:36',8,'High','2019-05-31 04:03:36','2019-06-03 04:08:36','Done','D','','',1,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00'),(36,'Public','NRDA project life cycle','Project preparation, process of implementation, scheduling, Gantt chart, cpm n PERT chart, subsidy p','',0,'2019-05-31 04:09:21',8,'High','2019-05-31 04:04:21','1970-01-01 05:30:00','Pending','D','','',1,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00'),(37,'Public','NRDA Map Approval','still not approved','',0,'2019-06-01 12:04:11',8,'High','2019-06-01 11:59:11','2019-06-05 12:04:11','Done','D','','',1,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00'),(38,'Public','Peak Salary Level','Communication week - individually or in group of same grade team,','',0,'1970-01-01 05:30:00',0,'KMedium','2019-06-03 12:34:00','2019-06-08 12:34:00','Done','D','','',1,'0000-00-00 00:00:00',1,'2019-06-01 12:35:27'),(39,'Public','Guava Accounting','entry of challan, weekly outstanding report, pending bill collection report, - define process and re','',1,'1970-01-01 05:30:00',0,'High','1970-01-01 05:30:00','2020-08-22 17:01:00','Pending','A','','',1,'0000-00-00 00:00:00',1,'1970-01-01 05:30:00'),(40,'Public','Add users in Reminder tool','Bajpai ji, Manish ji, Dushyant, ','',0,'2019-06-04 12:16:38',8,'High','2019-06-04 12:11:38','2019-06-04 05:00:38','Done','D','','',1,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00'),(41,'Public','Inter company transfer','to ensure compliance of provision of GST','',0,'2019-06-04 03:12:02',8,'High','2019-06-04 03:07:02','2019-06-05 03:12:02','Done','D','','',1,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00'),(42,'Public','define SOP for Guava Sale','To ensure weekly report of despatch, outstanding, Pending receipts of bills, etc.','',0,'2019-06-04 04:32:23',8,'High','2019-06-04 04:27:23','2019-06-06 04:32:23','Done','D','','',1,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00'),(43,'Public','Comparison chart ','City ','',0,'2019-06-04 09:07:07',8,'High','2019-06-04 09:02:07','2019-06-05 12:00:07','Done','D','','',1,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00'),(44,'Public','FMS','Robotic system ','',0,'2019-06-04 09:13:16',8,'High','2019-06-04 09:08:16','2019-08-08 11:46:00','Pending','A','','',1,'0000-00-00 00:00:00',0,'2019-06-04 09:13:16'),(45,'Public','Film cover for mobile','front n back','',0,'2019-06-05 10:40:44',8,'High','2019-06-05 10:35:44','2019-06-05 03:00:44','Done','D','','',1,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00'),(46,'Personal','IR activations ','Ir activations fir vimal sir','',0,'2019-06-06 02:11:41',8,'High','2019-07-10 10:00:41','2019-06-13 10:00:41','Pending','A','','',11,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00'),(47,'Public','Monthly meeting/ fortnight meeting ','Plan, define agenda, must have a topic discussion ','',0,'2019-06-09 12:15:05',8,'High','2019-06-10 12:10:05','2019-06-10 01:00:05','Done','D','','',1,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00'),(48,'Public','Carbon Credit of Farms ','exploree','',0,'2019-06-10 02:48:13',8,'High','2019-06-10 02:43:13','2020-09-30 15:02:00','Pending','A','','',1,'0000-00-00 00:00:00',0,'2019-06-10 02:48:13'),(49,'Personal','TDS on Provisons','to confirm','',0,'2019-06-10 02:48:57',8,'High','2019-06-10 02:43:57','2019-06-15 02:48:57','Pending','De','','',1,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00'),(50,'Personal','Directory updation','contacts','',0,'2019-06-10 02:49:36',8,'High','2019-06-10 02:44:36','2019-06-29 02:49:36','Pending','De','','',1,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00'),(51,'Public','TDS on Provision','to confirm','',0,'2019-06-10 02:52:00',8,'High','2019-06-10 02:47:00','2019-06-15 02:52:00','Done','D','','',1,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00'),(52,'Public','Directory updation','Contacts','',0,'2019-06-10 02:53:11',8,'High','2019-06-10 02:48:11','2019-08-16 11:45:00','Pending','De','','',1,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00'),(53,'Public','Letter to authority','Issues to solve','',0,'2019-06-10 03:13:32',8,'High','2019-06-10 03:08:32','2019-06-11 03:13:32','Pending','D','','',1,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00'),(54,'Public','Mail reply','28.05.2019 mail from VC','',0,'2019-06-13 11:59:39',8,'High','2019-06-13 11:54:39','2019-06-13 05:00:39','Done','D','','',1,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00'),(56,'Public','Charge clearance','Check Patwari record whether any charge is still showing online after Axis bank loan clearance. take','',0,'2019-07-05 11:05:34',8,'High','2019-07-05 11:00:34','2019-08-06 11:48:00','Pending','D','','',1,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00'),(57,'Personal','Recruitment module document handover to IT','To submit the document. ','Raipur. ',1,'2019-07-30 10:00:00',24,'KMedium','2019-07-31 09:00:00','2019-07-31 18:00:00','Done','D','','',15,'2019-07-29 12:46:00',0,'0000-00-00 00:00:00'),(58,'Public','RBI permission for Discard','PHI stock','',1,'2019-08-05 11:56:38',8,'High','2019-08-05 11:51:38','2019-08-16 11:56:38','Done','D','','',1,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00'),(59,'Public','Report of Solar system utilisation','Calculate saving chart','',0,'2019-08-05 11:58:38',8,'High','2019-08-05 11:53:38','2019-08-10 11:58:38','Done','D','','',1,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00'),(60,'Public','RBI list HS code coverage','for Export credit limit on subsidised interest rate','',0,'2019-08-30 01:03:18',8,'High','2019-08-30 12:58:18','2019-09-06 01:03:18','Pending','D','','',1,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00'),(61,'Public','Prepaid Card','Jagdalpur AA','',0,'2019-08-30 01:06:47',8,'High','2019-08-30 01:01:47','2019-09-03 01:06:47','Done','D','','',1,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00'),(63,'Public','Darba entry','Labour payment entry to make ','',0,'2020-08-18 06:29:50',8,'Low','2020-08-19 11:00:50','2020-08-19 06:29:50','Pending','A','','',1,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00'),(64,'Public','Rent to Danteshwari','From group cos','',1,'2020-08-18 06:31:06',8,'Low','2020-08-18 06:26:06','2020-08-19 06:31:06','Pending','A','','',1,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00'),(65,'Public','Send bank statement','To ramlal','',0,'2020-08-18 06:56:41',8,'High','2020-08-18 06:51:41','2020-08-19 06:56:41','Pending','A','','',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00'),(66,'Public','Address updation ','Voter ID','',1,'2020-09-19 10:22:16',8,'High','2020-09-19 10:17:16','2020-11-25 18:33:00','Pending','A','','',49,'0000-00-00 00:00:00',0,'2020-09-19 10:22:16'),(67,'Personal','my first Personal task','hhjjkk','NO',0,'1970-01-01 05:30:00',0,'High','2020-09-22 12:05:54','2020-09-24 12:05:58','Done','A','','',53,'0000-00-00 00:00:00',0,'1970-01-01 05:30:00'),(70,'Personal','Prism payment','Payment','NO',0,'1970-01-01 05:30:00',0,'0','2020-10-05 12:43:18','2020-10-05 12:43:40','Pending','A','','',8,'0000-00-00 00:00:00',0,'1970-01-01 05:30:00'),(71,'Personal','Tds payment','payment','NO',0,'1970-01-01 05:30:00',0,'0','2020-10-05 12:44:20','2020-10-05 12:44:32','Pending','A','','',8,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00'),(72,'Personal','salary payment','payment','NO',0,'1970-01-01 05:30:00',0,'0','2020-10-05 02:28:32','2020-10-05 02:28:49','Pending','A','','',8,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00'),(79,'Public','SK Singh','follow up','NO',0,'1970-01-01 05:30:00',0,'0','2020-12-25 10:58:30','2020-12-31 10:58:40','Done','D','ok','',49,'0000-00-00 00:00:00',0,'1970-01-01 05:30:00'),(80,'Personal','Meeting regarding AC farm development','planning for land preparation with Shubham','Gomchi',0,'2021-02-18 12:00:00',0,'High','2021-02-18 02:04:54','2021-02-19 02:05:08','Pending','A','','',12,'0000-00-00 00:00:00',0,'2021-02-18 12:00:00'),(81,'Public','Pay challan','mining','NO',0,'1970-01-01 05:30:00',0,'0','2021-02-19 10:06:58','2021-02-19 10:07:07','Done','D','','',49,'0000-00-00 00:00:00',0,'1970-01-01 05:30:00'),(82,'Public','App','startup','NO',0,'1970-01-01 05:30:00',0,'0','2021-02-20 11:12:11','2021-02-21 11:12:16','Done','D','','',49,'0000-00-00 00:00:00',0,'1970-01-01 05:30:00'),(83,'Personal','fruit plants availability list update','moti','',0,'2021-03-11 12:00:00',0,'High','2021-03-11 05:21:39','2021-03-12 05:21:45','Pending','A','','',12,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00'),(84,'Personal','non performed task to update ?','long pending task handing mAchenism','',0,'2021-05-05 12:00:00',0,'High','2021-05-05 01:24:26','2021-05-05 01:24:39','Done','D','','',49,'0000-00-00 00:00:00',0,'2021-05-05 12:00:00'),(85,'Public','EPCG New Plant','make detailed process with timeline','',0,'2022-01-23 10:49:26',12,'Medium','2022-01-23 10:49:26','2022-01-25 10:50:12','Pending','A','','',49,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00'),(86,'Public','Republic Day Prepration','communication n arrangements  press release  call','',0,'2022-01-23 10:51:28',12,'Medium','2022-01-23 10:51:28','2022-01-27 10:52:24','Done','D','','',49,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00'),(87,'Personal','New Plant Subsidy','timelines','',0,'2022-01-23 10:53:58',24,'Medium','2022-01-23 10:53:58','2022-01-27 10:54:32','Pending','A','','',49,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00'),(88,'Public','first floor remodeling','complete with shifting','CC',0,'2022-01-23 10:56:57',24,'High','2022-03-02 10:55:00','2022-02-20 11:01:23','Done','D','late','',49,'0000-00-00 00:00:00',0,'2022-01-23 10:56:57'),(89,'Public','App Updation','Reminder','CC',0,'2022-01-23 11:28:04',24,'Medium','2022-01-23 11:28:04','2022-02-20 11:28:22','Done','D','','',49,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00'),(90,'Public','Tatibandh Filling','New plot','',0,'2022-01-27 12:02:10',12,'Medium','2022-01-27 12:02:10','2022-01-31 12:02:43','Pending','A','','',49,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00'),(91,'Public','nursery gratuity renewal payment','payment of renewal premium','',0,'2022-01-28 12:00:00',0,'High','2022-01-28 12:23:16','2022-01-28 12:24:25','Pending','A','','',73,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00'),(92,'Personal','labour welfare return','submission of labour welfare return for deorjhal and raipur','NO',0,'1970-01-01 05:30:00',0,'0','2022-01-28 12:47:04','2022-01-31 12:47:13','Done','D','raipur completed return paid','',73,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00'),(93,'Personal','labour welfare fund','return for deorjhal','NO',0,'1970-01-01 05:30:00',0,'0','2022-02-01 11:07:03','2022-02-02 11:07:50','Done','D','completed on due date','',73,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00'),(94,'Personal','conference call','for leaf collection method and cut off date','NO',0,'1970-01-01 05:30:00',24,'High','2022-02-02 20:20:00','2022-02-02 20:28:00','Pending','A','','',75,'0000-00-00 00:00:00',0,'1970-01-01 05:30:00'),(98,'Personal','PF','challan submission','NO',0,'1970-01-01 05:30:00',0,'0','2022-02-05 11:27:03','2022-02-10 11:29:17','Pending','A','','',79,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00'),(99,'Public','SOP','Attendence SOP to be updatef','NO',0,'1970-01-01 05:30:00',0,'0','2022-02-05 11:28:12','2022-02-15 11:28:21','Pending','A','','',73,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00'),(100,'Public','Sop','sop attendance','NO',0,'1970-01-01 05:30:00',0,'0','2022-02-05 11:38:29','2022-02-15 11:39:01','Done','D','completed on time','',73,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00'),(108,'Public','visiting card','need to update visiting card printing details in google docs','',0,'2022-02-05 04:21:15',0,'High','2022-02-05 04:21:15','2022-02-07 04:22:43','Pending','A','','',73,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00'),(109,'Personal','investment proof submission','investment proof submission draft and circular to be released.','',0,'2022-02-07 10:23:15',0,'High','2022-02-07 10:23:15','2022-02-07 10:25:38','Done','D','closed on time','',73,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00'),(113,'Public','Joining in IT','Narayan joining in IT','NO',0,'1970-01-01 05:30:00',0,'0','2022-03-01 04:01:57','2022-03-01 04:02:22','Done','D','','',85,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00'),(114,'Public','Nursery interviews','3 candidates','raipur',0,'2022-03-03 12:00:00',24,'High','2022-03-04 04:07:04','2022-03-04 04:08:38','Pending','A','','',85,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00'),(115,'Public','test','test','test',0,'2022-03-11 01:46:46',0,'High','2022-03-10 01:46:46','2022-03-10 12:47:29','Pending','A','','',35,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00'),(116,'Public','test','test','',0,'2022-06-16 06:02:26',0,'High','2022-06-16 06:02:26','2022-06-17 05:02:37','Pending','A','','',22,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00');
/*!40000 ALTER TABLE `reminder` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reminder_old`
--

DROP TABLE IF EXISTS `reminder_old`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reminder_old` (
  `rem_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(10) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL,
  `location` varchar(50) NOT NULL,
  `rem_req` int(2) NOT NULL,
  `start_date` datetime NOT NULL,
  `period` int(5) NOT NULL,
  `priority` varchar(10) NOT NULL,
  `from_date` datetime NOT NULL,
  `to_date` datetime NOT NULL,
  `Status` varchar(50) NOT NULL,
  `activity` varchar(5) NOT NULL,
  `created_by` int(2) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_by` int(2) NOT NULL,
  `modified_at` datetime NOT NULL,
  PRIMARY KEY (`rem_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reminder_old`
--

LOCK TABLES `reminder_old` WRITE;
/*!40000 ALTER TABLE `reminder_old` DISABLE KEYS */;
INSERT INTO `reminder_old` (`rem_id`, `type`, `title`, `description`, `location`, `rem_req`, `start_date`, `period`, `priority`, `from_date`, `to_date`, `Status`, `activity`, `created_by`, `created_at`, `modified_by`, `modified_at`) VALUES (2,'Public','Yes bank ','Account opening ','.',1,'1970-01-01 05:30:00',0,'High','1970-01-01 05:30:00','1970-01-01 05:30:00','Pending','D',1,'0000-00-00 00:00:00',1,'0000-00-00 00:00:00'),(3,'Public','New Task IT','For Reminder','Raipur',1,'1970-01-01 05:30:00',0,'KMedium','1970-01-01 05:30:00','1970-01-01 05:30:00','Pending','A',2,'0000-00-00 00:00:00',2,'0000-00-00 00:00:00'),(4,'Public','IT penaulty notice reply','Mukta mani case ','.',1,'1970-01-01 05:30:00',0,'High','1970-01-01 05:30:00','1970-01-01 05:30:00','Pending','D',1,'0000-00-00 00:00:00',1,'0000-00-00 00:00:00'),(5,'Public','vdsv','vdsv','sdvdv',1,'2019-01-12 11:53:00',12,'Low','2019-01-13 11:53:00','2019-01-14 11:53:00','Done','A',3,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00'),(6,'Personal','demo','description ','raipur',1,'2019-01-10 01:01:28',24,'High','2019-01-11 02:00:37','2019-01-12 02:00:42','Pending','D',12,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00'),(7,'Public','Test','Zhsshhsshjssvs shshsbss shsjs','Raipur',0,'1970-01-01 05:30:00',0,'KMedium','2019-01-23 08:00:24','2019-01-30 07:00:29','Pending','A',13,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00'),(8,'Personal','Cxj','Xbxj','Xnxj',0,'1970-01-01 05:30:00',0,'KMedium','2019-01-16 12:12:56','2019-01-23 03:00:47','Pending','A',3,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00'),(9,'Public','New assignment','Today task','Raipur',1,'1970-01-01 05:30:00',0,'KMedium','1970-01-01 05:30:00','1970-01-01 05:30:00','Done','A',2,'0000-00-00 00:00:00',2,'0000-00-00 00:00:00'),(10,'Personal','vdsav','asdvsdv','sadvs',0,'1970-01-01 05:30:00',0,'Low','2019-01-15 01:22:32','2019-01-16 01:22:36','Pending','D',1,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00'),(11,'Personal','sasafsasa','fsafas','fsaf',0,'1970-01-01 05:30:00',0,'Low','2019-01-24 03:04:21','2019-01-25 03:04:31','Pending','D',1,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00'),(12,'Personal','safsa','fasf','safsaf',1,'2019-01-13 03:04:59',12,'Low','2019-01-14 03:04:44','2019-01-15 03:04:47','Pending','D',1,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00'),(13,'Personal','Meeting','Arvindji','Raipur. Office',1,'1970-01-01 05:30:00',24,'Low','2019-01-12 03:00:00','2019-01-12 04:00:00','Pending','A',15,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00'),(14,'Public','Reminder app version 2 launch','App update','Raipur ',0,'1970-01-01 05:30:00',0,'High','2019-01-14 12:00:02','2019-01-14 06:00:08','Pending','A',13,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00'),(15,'Public','Expro tool','Complete expro tool this week','Raipur',1,'2019-01-14 05:00:20',12,'High','2019-01-15 04:00:10','2019-01-19 06:00:14','Pending','A',2,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00'),(16,'Public','test','scac','asca',0,'1970-01-01 05:30:00',0,'KMedium','2019-01-17 04:11:08','2019-01-17 04:11:11','Pending','A',3,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00'),(17,'Public','TEST','TEST','TEST',0,'1970-01-01 05:30:00',0,'High','2019-01-31 04:56:05','2019-01-31 04:56:08','Pending','A',1,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00'),(18,'Personal','Account Finalisation - Arvind','.','CC',1,'1970-01-01 05:30:00',12,'','2019-04-09 05:24:00','2019-04-15 05:25:00','Pending','D',1,'0000-00-00 00:00:00',1,'0000-00-00 00:00:00'),(19,'Public','Account finalisation - Arvind','.','.',1,'1970-01-01 05:30:00',0,'High','1970-01-01 05:30:00','1970-01-01 05:30:00','Pending','A',1,'0000-00-00 00:00:00',1,'0000-00-00 00:00:00');
/*!40000 ALTER TABLE `reminder_old` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reminder_participants`
--

DROP TABLE IF EXISTS `reminder_participants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reminder_participants` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rem_id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `farward_userid` int(11) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL,
  `reply_img` varchar(50) NOT NULL,
  `comment` varchar(1000) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=191 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reminder_participants`
--

LOCK TABLES `reminder_participants` WRITE;
/*!40000 ALTER TABLE `reminder_participants` DISABLE KEYS */;
INSERT INTO `reminder_participants` (`id`, `rem_id`, `userid`, `farward_userid`, `status`, `reply_img`, `comment`, `created_at`) VALUES (25,19,9,0,0,'','','2019-04-20 11:20:11'),(26,19,16,0,0,'','','2019-06-01 06:53:09'),(27,19,17,0,0,'','','2019-04-20 11:20:12'),(28,19,18,0,0,'','','2019-04-20 11:20:12'),(29,19,19,0,0,'','','2019-04-20 11:20:13'),(30,20,9,0,1,'','Done','2019-05-31 05:23:52'),(31,21,9,0,1,'','Completed on 4th may itself ','2019-05-31 05:23:13'),(34,24,9,0,1,'','Done ','2019-05-31 11:16:29'),(36,26,9,0,1,'','Acknowlegment copy sent to alok and harsh by whatsapp','2019-06-01 06:58:14'),(47,35,9,0,1,'','Agreement corrected with details  asked for project file amd map to alok  for file preparation. ','2019-06-04 09:30:10'),(48,36,9,0,0,'','','2019-05-31 10:50:36'),(49,37,9,0,1,'','Building approval received on 18th june ','2019-06-28 05:32:15'),(50,38,15,0,1,'','Was on leave from 1st till 8th june... Please reassign task for further dates. ','2019-06-10 10:27:42'),(53,40,9,0,1,'','Reminder app activated ','2019-06-04 09:21:44'),(54,41,28,0,1,'','Bill of supply raised and gst paid/adjusted against ITC.','2019-06-05 08:55:32'),(55,42,17,0,0,'','','2019-06-04 10:59:56'),(56,42,22,0,1,'','send by whatsapp','2019-06-04 11:04:15'),(59,39,17,0,0,'','','2019-06-04 14:23:41'),(60,39,22,0,0,'','','2019-06-04 14:23:41'),(61,43,8,0,1,'','completed the task ','2019-06-12 06:22:16'),(62,44,31,0,0,'','','2019-06-04 15:39:13'),(63,45,11,0,1,'','Done ','2019-06-06 08:36:21'),(64,46,11,0,0,'','','2019-06-06 08:38:29'),(65,47,27,0,1,'','Monthly meeting scheduled on  4th Saturday of every month. ','2019-06-10 05:15:57'),(66,47,28,0,1,'','Planned 4th Saturday of every month.','2019-06-11 05:14:20'),(67,48,28,0,0,'','Still exploring. Few days more required.','2019-06-15 12:09:13'),(68,49,1,0,0,'','','2019-06-10 09:14:35'),(69,50,1,0,0,'','','2019-06-10 09:15:53'),(70,51,27,0,1,'','TDS on provision for expenses is applicable only  if payee is identifiable .','2019-06-11 05:01:15'),(71,52,8,0,0,'','','2019-06-10 09:19:13'),(72,53,9,0,0,'','After building approval letter to be issued ','2019-06-12 11:56:57'),(73,54,28,0,1,'','E mailed the reply.','2019-06-13 07:46:52'),(74,55,34,0,0,'','','2019-06-14 07:12:04'),(75,56,21,0,0,'','','2019-07-05 05:35:25'),(76,56,22,0,0,'','','2019-07-05 05:35:25'),(77,57,15,0,0,'','','2019-07-29 07:16:05'),(78,58,28,0,1,'','Letter obtained from AD Bank. Now the seed can be destroyed.','2019-09-23 11:32:07'),(79,59,27,0,1,'','Handover the calculation chart to Gautam Sharma  and ask to give explanations regarding non saving in electricity bill after installation of solar system. ','2019-08-09 06:54:11'),(80,60,28,0,0,'','','2019-08-30 07:31:46'),(81,61,28,0,1,'','Closed 15 days back and updated. Still showing pending. Bob issuing prepaid catds','2019-09-24 04:55:27'),(82,62,13,0,0,'','','2020-07-09 10:47:05'),(83,62,8,0,0,'','','2020-07-09 10:47:06'),(84,62,9,0,0,'','','2020-07-09 10:47:06'),(85,62,7,0,0,'','','2020-07-09 10:47:07'),(86,62,16,0,0,'','','2020-07-09 10:47:07'),(87,62,17,0,0,'','','2020-07-09 10:47:08'),(88,62,18,0,0,'','','2020-07-09 10:47:08'),(89,62,8,0,0,'','','2020-08-18 11:26:10'),(92,65,31,0,0,'','','2020-08-18 14:03:32'),(95,68,1,0,1,'','ok','2020-09-01 08:54:04'),(96,66,9,0,0,'','Online correction of voter id card at present not available. Contacted choice centre office, they informed corrections will be done only at the time of election. At present tehsil office is also closed .After 15 days asked me to contact again. Will do the same. I have created and login my id in voter card portal only new appliction is open. ','2020-09-19 10:30:47'),(97,67,53,0,1,'','ok','2020-09-21 06:36:32'),(98,68,35,0,0,'','','2020-09-21 06:37:39'),(99,68,1,0,0,'','','2020-09-21 06:37:39'),(100,69,35,0,0,'','','2020-09-21 06:41:46'),(101,69,1,0,1,'','ok. done','2020-09-21 06:44:56'),(102,70,8,0,0,'','','2020-10-04 19:04:03'),(103,71,8,0,0,'','','2020-10-04 19:04:50'),(104,72,8,0,0,'','','2020-10-05 08:49:00'),(105,66,9,0,0,'','','2020-11-08 13:04:00'),(111,75,56,0,0,'','','2020-12-02 05:46:47'),(112,76,35,0,0,'','','2020-12-22 09:30:41'),(113,76,1,0,0,'','','2020-12-22 09:30:41'),(114,77,35,0,0,'','','2020-12-24 11:44:40'),(115,78,35,0,0,'','','2020-12-24 11:46:39'),(116,78,35,0,0,'','','2020-12-24 11:46:40'),(117,79,8,0,0,'','','2020-12-25 05:29:09'),(118,79,49,0,0,'','','2020-12-25 05:29:09'),(119,66,9,0,0,'','','2020-12-25 06:58:16'),(120,66,34,0,0,'','','2020-12-25 06:58:16'),(121,80,1,0,1,'','Test Reply','2021-06-21 11:37:47'),(122,81,1,0,0,'','','2021-01-09 06:52:41'),(123,80,12,0,0,'','','2021-02-18 08:35:43'),(124,81,49,0,0,'','','2021-02-19 04:37:50'),(125,82,31,0,0,'','','2021-02-20 05:42:32'),(126,82,37,0,0,'','','2021-02-20 05:42:32'),(127,83,12,0,0,'','','2021-03-11 11:52:29'),(128,84,49,0,0,'','','2021-05-05 07:55:08'),(129,66,34,0,0,'','','2021-05-05 09:37:18'),(130,39,8,0,0,'','','2021-06-10 06:26:02'),(131,39,9,0,0,'','','2021-06-10 06:26:02'),(132,48,9,0,0,'','','2021-06-21 11:38:47'),(133,48,7,0,0,'','','2021-06-21 11:38:47'),(134,85,28,0,0,'','','2022-01-23 05:20:59'),(135,86,34,0,0,'','','2022-01-23 05:23:37'),(136,87,49,28,0,'','','2022-01-23 05:26:03'),(137,88,34,0,0,'','','2022-01-23 05:33:00'),(138,66,34,0,0,'','','2022-01-23 05:37:03'),(139,88,34,0,0,'','','2022-01-23 05:46:56'),(140,88,59,0,0,'','','2022-01-23 05:46:56'),(141,0,34,0,0,'','','2022-01-23 05:56:07'),(142,0,35,0,0,'','','2022-01-23 05:56:07'),(143,0,34,0,0,'','','2022-01-23 05:56:19'),(144,0,35,0,0,'','','2022-01-23 05:56:19'),(145,0,34,0,0,'','','2022-01-23 05:56:27'),(146,0,35,0,0,'','','2022-01-23 05:56:27'),(147,0,34,0,0,'','','2022-01-23 05:56:38'),(148,0,35,0,0,'','','2022-01-23 05:56:38'),(149,89,34,0,0,'','','2022-01-23 05:59:21'),(150,89,35,1,0,'','','2022-02-17 09:08:00'),(151,90,59,0,0,'','','2022-01-27 06:33:29'),(152,92,73,0,0,'','','2022-01-28 07:17:56'),(153,93,73,0,0,'','','2022-02-01 05:38:42'),(154,94,75,0,0,'','','2022-02-02 11:49:18'),(155,95,35,1,0,'','','2022-02-17 09:00:47'),(156,96,35,0,1,'reply_35_070322175006.jpg','ufufu','2022-03-07 12:20:06'),(157,97,35,0,1,'','test','2022-03-07 12:00:08'),(158,98,79,0,0,'','','2022-02-05 05:59:34'),(171,113,80,0,0,'','','2022-02-28 10:32:44'),(188,115,92,0,0,'','','2022-03-11 07:17:55'),(189,115,93,0,0,'','','2022-03-11 07:17:57'),(190,116,94,0,0,'','','2022-06-16 11:33:15');
/*!40000 ALTER TABLE `reminder_participants` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reminder_participants_chat`
--

DROP TABLE IF EXISTS `reminder_participants_chat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reminder_participants_chat` (
  `ChatId` int(10) NOT NULL AUTO_INCREMENT,
  `rem_id` int(5) DEFAULT NULL,
  `chat_rmk` varchar(200) DEFAULT '',
  `chat_date` datetime DEFAULT NULL,
  `chat_img` varchar(50) NOT NULL,
  `TeamBy` int(5) DEFAULT '0',
  PRIMARY KEY (`ChatId`),
  KEY `ChatId` (`ChatId`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reminder_participants_chat`
--

LOCK TABLES `reminder_participants_chat` WRITE;
/*!40000 ALTER TABLE `reminder_participants_chat` DISABLE KEYS */;
INSERT INTO `reminder_participants_chat` (`ChatId`, `rem_id`, `chat_rmk`, `chat_date`, `chat_img`, `TeamBy`) VALUES (1,104,'','2022-02-24 18:00:27','',35),(2,104,'msg','2022-03-07 15:17:04','',35),(3,104,'msg','2022-03-07 15:17:05','',35),(4,104,'msgg','2022-03-07 15:21:38','',35),(5,104,'msggg','2022-03-07 15:29:00','chat_35_070322152900.jpg',35),(6,104,'test','2022-03-07 15:30:00','chat_35_070322153000.jpg',35),(7,104,'fyychc','2022-03-07 15:31:20','chat_35_070322153120.jpg',35),(8,104,'test','2022-03-07 15:45:11','chat_35_070322154511.jpg',35),(9,104,'test','2022-03-07 15:45:11','chat_35_070322154511.jpg',35),(10,104,'test','2022-03-07 15:46:19','chat_35_070322154619.jpg',35),(11,104,'test2','2022-03-07 15:49:05','chat_35_070322154905.jpg',35),(12,104,'test3','2022-03-07 16:09:40','chat_35_070322160940.jpg',35),(13,104,'tcyyc','2022-03-07 16:12:02','chat_35_070322161202.jpg',35),(14,104,'ocggck','2022-03-07 16:13:32','chat_35_070322161332.jpg',35),(15,104,'test','2022-03-09 10:52:31','chat_35_090322105231.jpg',35),(16,104,'test2','2022-03-09 10:54:55','chat_35_090322105455.jpg',35),(17,104,'test3','2022-03-09 11:02:50','chat_35_090322110250.jpg',35),(18,104,'test4','2022-03-09 11:47:48','chat_35_090322114748.jpg',35),(19,104,'test','2022-03-09 12:32:21','chat_35_090322123221.jpg',35),(20,104,'','2022-03-09 12:37:09','chat_35_090322123709.jpg',35),(21,104,'','2022-03-09 12:39:02','chat_35_090322123902.jpg',35),(22,104,'','2022-03-09 14:17:47','chat_35_090322141747.jpg',35),(23,104,'','2022-03-09 14:21:39','chat_35_090322142139.jpg',35),(24,104,'','2022-03-09 14:22:59','chat_35_090322142259.jpg',35),(25,116,'test','2022-03-09 14:29:22','chat_35_090322142922.jpg',35),(26,115,'','2022-03-09 15:44:52','chat_35_090322154452.jpg',35),(27,115,'','2022-03-09 15:47:07','chat_35_090322154707.jpg',35),(28,115,'test','2022-03-09 15:47:29','chat_35_090322154729.jpg',35);
/*!40000 ALTER TABLE `reminder_participants_chat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reminder_participants_chatuser`
--

DROP TABLE IF EXISTS `reminder_participants_chatuser`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reminder_participants_chatuser` (
  `Id` bigint(10) NOT NULL AUTO_INCREMENT,
  `UserId` int(5) DEFAULT '0',
  `Ndate` datetime DEFAULT '0000-00-00 00:00:00',
  `rem_id` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Id`),
  KEY `Id` (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reminder_participants_chatuser`
--

LOCK TABLES `reminder_participants_chatuser` WRITE;
/*!40000 ALTER TABLE `reminder_participants_chatuser` DISABLE KEYS */;
INSERT INTO `reminder_participants_chatuser` (`Id`, `UserId`, `Ndate`, `rem_id`) VALUES (1,34,'2022-02-02 15:58:29',88),(2,35,'2022-02-24 10:13:06',89),(3,73,'2022-02-15 14:28:25',100),(4,35,'2022-02-24 11:26:17',97),(5,35,'2022-03-09 14:28:47',104),(6,35,'2022-02-25 12:29:17',95),(7,35,'2022-02-24 11:31:00',96),(8,35,'2022-03-09 14:29:23',116),(9,35,'2022-04-07 16:59:09',115),(10,35,'2022-03-09 15:22:56',110),(11,92,'2022-03-11 12:48:53',115);
/*!40000 ALTER TABLE `reminder_participants_chatuser` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reminder_task`
--

DROP TABLE IF EXISTS `reminder_task`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reminder_task` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rem_id` int(11) NOT NULL,
  `task` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reminder_task`
--

LOCK TABLES `reminder_task` WRITE;
/*!40000 ALTER TABLE `reminder_task` DISABLE KEYS */;
INSERT INTO `reminder_task` (`id`, `rem_id`, `task`) VALUES (1,1,'Aa'),(2,2,''),(3,3,'update pages'),(4,3,'update pages 2'),(5,9,'sacsa'),(6,10,'csac'),(7,11,'vdvdsv'),(8,12,'csac'),(9,13,'xaX'),(10,5,'dsvdsv'),(11,5,'vdsv'),(12,6,'tssk1'),(13,7,''),(14,8,'Bdn'),(15,9,''),(16,10,'adva'),(17,11,'saf'),(18,12,'asf'),(19,13,''),(20,14,''),(21,15,''),(22,16,'sac'),(23,17,'sac'),(24,18,'Complete Books of accounts. finalise balance sheet'),(25,19,''),(26,20,''),(27,21,''),(28,22,'test'),(29,23,''),(30,24,''),(31,25,''),(32,26,''),(33,27,''),(34,28,''),(35,29,'vvds'),(36,30,''),(37,31,''),(38,32,''),(39,33,''),(40,34,''),(41,35,''),(42,36,''),(43,37,''),(44,38,''),(45,39,''),(46,40,''),(47,41,''),(48,42,''),(49,43,''),(50,44,''),(51,45,''),(52,46,''),(53,47,''),(54,48,''),(55,49,''),(56,50,''),(57,51,''),(58,52,''),(59,53,''),(60,54,''),(61,55,''),(62,56,''),(63,57,'Debrat to handover the documents '),(64,58,''),(65,59,''),(66,60,''),(67,61,''),(68,62,'Kn ghjk'),(69,62,'Vcbnkk'),(70,66,'');
/*!40000 ALTER TABLE `reminder_task` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `userid` int(5) NOT NULL AUTO_INCREMENT,
  `upwd` varchar(50) NOT NULL,
  `user_varified` varchar(5) NOT NULL DEFAULT 'No',
  `otp` int(11) NOT NULL,
  `otp_varified` int(11) NOT NULL,
  `utype` char(1) NOT NULL COMMENT 'A-admin U-user',
  `usts` char(1) NOT NULL COMMENT 'A-active D-deactive',
  `ufname` varchar(50) NOT NULL,
  `ulname` varchar(50) NOT NULL,
  `ucontact` varchar(10) NOT NULL,
  `uemail` varchar(50) NOT NULL,
  `udob` date NOT NULL,
  `ugender` varchar(20) NOT NULL,
  `marital_status` varchar(10) NOT NULL,
  `Anniversary` date NOT NULL,
  `address` varchar(150) NOT NULL,
  `profile_pic` varchar(30) NOT NULL,
  `uexecute` char(1) NOT NULL DEFAULT 'N' COMMENT 'Y-yes N-No',
  `uadd` char(1) NOT NULL DEFAULT 'Y' COMMENT 'Y-yes N-No',
  `udelete` char(1) NOT NULL DEFAULT 'N' COMMENT 'Y-yes N-No',
  `uview` char(1) NOT NULL DEFAULT 'Y' COMMENT 'Y-yes N-No',
  `crby` int(5) NOT NULL COMMENT 'User',
  `crdate` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_at` datetime NOT NULL,
  `user_token` text NOT NULL,
  PRIMARY KEY (`userid`),
  KEY `userid` (`userid`)
) ENGINE=MyISAM AUTO_INCREMENT=95 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`userid`, `upwd`, `user_varified`, `otp`, `otp_varified`, `utype`, `usts`, `ufname`, `ulname`, `ucontact`, `uemail`, `udob`, `ugender`, `marital_status`, `Anniversary`, `address`, `profile_pic`, `uexecute`, `uadd`, `udelete`, `uview`, `crby`, `crdate`, `modified_by`, `modified_at`, `user_token`) VALUES (1,'21232f297a57a5a743894a0e4a801fc3','Yes',97203,1,'A','A','admin','developer','8109786153','admin@gmail.com','2020-09-01','Male','Unmarried','0000-00-00','corporate center raipur','profile_pics/1.png','Y','Y','N','Y',1,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','fM3rGZmpYAg:APA91bFvIBLIT0MlGqmafxjdMPQcBKnWmzT-awh-TCTn_fofp_C-_yIhpitiAnNIZp5QQOAk9aqxK-qZp9qeknIdERe9IVHtSlh1mePKHS3H1e9xXoB-Hvzj3c8lYulmAzqFOU1d1RQv'),(35,'e10adc3949ba59abbe56e057f20f883e','Yes',88413,1,'U','A','Ajay','Kumar','9754808238','ajaykumar.dewangan@vnrseeds.in','0000-00-00','','','0000-00-00','','','N','Y','N','Y',49,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','dcpBlzGGaMo:APA91bEn0xve_ioeLFazqOEsWtXCkubDoFVI4ULHmVlQRBQvHFFzycx5ArplHTbwB8fvlH90g5u37rW3nr6n4M2Qu5P4t5QbDzfEdDQaLJJXa9PPkAR7IC--Q_YWbbtcsDJ91D9lKtdp'),(8,'a84d77adca68a28b243d80f5018291b7','Yes',17194,1,'U','A','fagun','jaiswal','7000390267','fagunjaiswal0802@gmail.com','1994-02-08','Female','Unmarried','0000-00-00','','','N','Y','N','Y',49,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','caWmZfeyP6I:APA91bHcrCTre6onITXLm6CHO-EaDjChrgY9XIYAL7xG_e182A-nOGPoiAmf4ExPCwjkRnXeQ4Uw4BByjBJEch5CXIPvH1ItjA-qVEG9WqVBPUCXDswYNdDdUE74r4azVSKPqQRtgO-L'),(9,'bc72ac6807ced9dc259112eaf06e29dc','Yes',87972,1,'U','A','Rohini','Narasaiya','9425018823','d.rohini@vnrseeds.com','1969-08-21','Female','Married','1992-06-21','','','N','Y','N','Y',49,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',''),(7,'5d560ea997068115892d2f0bd7cf91c3','Yes',39310,1,'U','A','Aruna','Jaiswal','9589809114','arunajaiswal515@gmail.com','0000-00-00','','','0000-00-00','','','N','Y','N','Y',49,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',''),(12,'1bd1b83e2a1415fced60c56295583a06','Yes',71202,1,'U','A','Randip','Ghosh','8819090075','randip.ghosh@vnrnursery.in','0000-00-00','','','0000-00-00','','','N','Y','N','Y',49,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','eypyUMooTS2YbUpmegWPNS:APA91bHuIs96dHUz2dLZjyzn3psjIrzUDJG8aZ2aZZXhzP9dy2ang15EXwXjpU7NX5zn9GIYA3Jz2UmDrHxRI_epWZEiXFLzqxAP5HNWgiopWFvhTOmaHIuNbQ0CVe2mLVbaJNm3wvR6'),(11,'9b0c6802e2a453c0c5918ec6c270bc0c','Yes',27966,1,'U','A','Harendra ','Kumar','9329040330','gautam.sharma@vnrseeds.com','0000-00-00','','','0000-00-00','','','N','Y','N','Y',49,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',''),(14,'79e769f847b0771cb0537a2dbd71f007','Yes',37114,1,'U','A','Rahul','Palotra','7697711518','rahulpalotra.vspl@gmail.com','0000-00-00','','','0000-00-00','','','N','Y','N','Y',49,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',''),(15,'418703de84a71476c507b0af602334f5','Yes',23169,1,'U','A','Parul','P','9300125137','parul.parmar@vnrseeds.com','0000-00-00','','','0000-00-00','','','N','Y','N','Y',49,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','em9doSeO2Dg:APA91bHbcpfDtztx5No-DB-jiz3frrZ1k2nMURsN35hIZ54YZ6bZ1hkwlLSgIWoZgpzwBc7w2OjTR6gEIZptLBKRM2v-4HFCzURRGsZ7iBs2AhfRk9RgK5_g6ht5OaChpIrEA1t8rSXb'),(16,'012dacbb525612513fd931884a248865','Yes',58281,1,'U','A','Sujit','Singh','8178210787','SUJIT.SINGH@vnrseeds.com','0000-00-00','','','0000-00-00','','','N','Y','N','Y',16,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',''),(17,'f56077fdef1eefdd04b32c6b67de3b5a','Yes',80561,1,'U','A','Gaurav','Rathod','8103730400','gaurav.vspl@gmail.com','0000-00-00','','','0000-00-00','','','N','Y','N','Y',49,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',''),(18,'520e002e793e183e5d806e5a897092e2','Yes',79603,1,'U','A','Vimla','Sahu','9179311318','vimla.sahu8@gmail.com','0000-00-00','','','0000-00-00','','','N','Y','N','Y',49,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','fkSp5PhmRWinyG48Z2z2Ll:APA91bGcPKq2NupVvr5F4XrZcvtASAV77nbwvpopj_1OavcJ5IbmdJQiTaurp88zBRw3Cdwoq80tZZl_rximw0HxgN7Sr32U8-XT_rifV07UzJARbWppTy5WgYixXgBOedXJmzflFgaA'),(19,'d5a514c5a0a5c519ff4c7a9c55e1c31c','Yes',58997,1,'U','A','KIRAN','JOSHI','7415293641','kiran.joshi658@gmail.com','0000-00-00','','','0000-00-00','','','N','Y','N','Y',49,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',''),(21,'88864c3c6137968735bb0dc2c6d3dd01','Yes',0,0,'U','A','Ramlal','Lodhi','8962810301','ramlal215@gmail.com','0000-00-00','','','0000-00-00','','','N','Y','N','Y',49,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',''),(23,'0490a34bd15b117838f10cf77686a74f','No',0,0,'U','A','Manoj','Patel','9425212741','manojpatel1251@gmail.com','0000-00-00','','','0000-00-00','','','N','Y','N','Y',49,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',''),(24,'aca7778d12bb4e39ecd4dc32b8744353','No',0,0,'U','A','Mukta','Agrawal','9827908004','mukta.arvind@gmail.com','0000-00-00','','','0000-00-00','','','N','Y','N','Y',49,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',''),(26,'40c91e0ffbb945e84f3fd2ecbcace146','Yes',0,0,'U','A','Dushyant ','Sahu','9329654281','dushyant.sahu@vnrseeds.com','0000-00-00','','','0000-00-00','','','N','Y','N','Y',49,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',''),(27,'96a1725ac3c066c70d10e9ed6a8b3116','Yes',16389,0,'U','A','Manish ','Karkun','9685436177','manish.karkun@vnrseeds.com','1969-02-08','Male','Married','2001-05-18','B-15/2,Chouhan Green Valley, Bhilai','','N','Y','N','Y',49,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',''),(28,'cbcc962993ea4f16ffef75b93af79287','Yes',0,0,'U','A','Ashish','Bajpai','9301260007','gm.finance@vnrseeds.com','1970-01-01','Male','','1970-01-01','','','N','Y','N','Y',49,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',''),(31,'a064449e2ae9c7a0ef399e635fc1b2c2','Yes',0,0,'U','A','Swapnil','Agrawal','7869944007','swap220999@gmail.com','0000-00-00','','','0000-00-00','','','N','Y','N','Y',49,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',''),(34,'b4c4c2f7aa6a97b35c656dbbd6862c79','Yes',40997,1,'U','A','Megha','Soni','8878067802','megha.soni72@gmail.com','1989-12-18','Female','Unmarried','0000-00-00','','','N','Y','N','Y',49,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','fl4wmvfnK88:APA91bHkRI8OgEki9x50o87fuMpJ_tqFumdcTzm9QWdfwOo26v91fI7hZZIhyrIT5x6FHtzsecUC-3rNlkoCgJMfeEGBsBCgLMZFaFzSOC__XpsT4CgBnlEz2jMKoOIRIM1uvwruSmEe'),(37,'cd1a33e866fa93338c1a299396cc8d53','Yes',50875,1,'U','A','Swapnil','G','9752485859','g.swapnil@vnrseeds.com','0000-00-00','','','0000-00-00','','','N','Y','N','Y',49,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',''),(77,'f978419990e69cf59c34cebb3caf3e36','Yes',0,0,'U','A','Surendra ','Kumar','8959590910','','0000-00-00','','','0000-00-00','','','N','Y','N','Y',75,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','e8UZDIwUIaI:APA91bGDfJhJqHNImmJSQYOyksbFZwdlHTMx-9TkcISoIUPK40qiD2G9cwz_4EXSnx8NkyBr4YwfFAWbkI7bid9BefBzJ-k3O2FQYjVqqV9O7haKUINViQc8c_BBNOvzGDAK5c0H-io8'),(75,'5789f902fdced5e3e9007dd234212113','Yes',0,0,'U','A','Raj Kumar','Kundu','9302840331','rajkumar.kundu@vnrseeds.com','0000-00-00','','','0000-00-00','','','N','Y','N','Y',75,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','dpGv1kCVCzo:APA91bEymFypaS6HER9o8RgPye-uYEVBRFnIT783qq89WrWsyTg_ewP7yEM0EImyD8PuPQaP1-v3px103kRtoTXOhlf4PSdPdSF_ZTr6FuR5g7rOXq75w-EPD-2B9fxUXDjBVFkZSleQ'),(41,'56719','No',51427,0,'U','A','Suneel ','Yadav','9557265636','sunil.yadav623@gmail.com','0000-00-00','','','0000-00-00','','','N','Y','N','Y',41,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',''),(78,'b0b9693fffa8d35ba4d2f4c2f0340fbe','No',0,0,'U','A','SK','Singh','9009129070','','0000-00-00','','','0000-00-00','','','N','Y','N','Y',75,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',''),(43,'95631','No',51609,0,'U','A','Raj','Chauhan ','7973217901','3105raj.chauhan@gmail.com','0000-00-00','','','0000-00-00','','','N','Y','N','Y',43,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',''),(49,'a152e841783914146e4bcd4f39100686','Yes',78787,1,'U','A','Arvind ','Agrawal ','9329570007','fd@vnrseeds.com','0000-00-00','Male','Married','0000-00-00','','','N','Y','N','Y',49,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','eI1_YanIQbC23KRty7Dlla:APA91bE8ISih2wcAhPedh0AxXmGqIbCiJJifO4f0GM5g5KW7xgU2pra--5whuEg2P9J6Etof3a85ff4NJok8sbZbvisiNFswdmc5saoDU4Y8mzXGXFVGeodtw1BP9Kk1wRxY7bVDNLPj'),(72,'41d5440f596e714d7ca33eccabc5fcab','No',0,0,'U','A','Purshottam Bhaiya Jc','',' 96694 811','','0000-00-00','','','0000-00-00','','','N','Y','N','Y',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',''),(73,'2a31c7dd715c2b01477180b8e02435cc','Yes',42461,1,'U','A','Roopam','Johri','9302730007','roopam.johri@vnrseeds.com','0000-00-00','','','0000-00-00','','','N','Y','N','Y',73,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','cSKpdhrEe-Q:APA91bH2UOF_ZV5rdhDpa1vENKFYtXNq-NhGXO8jkw3_VFttDj571iQVJCpUHNeI-ndSKupo05Qqy5dasuXP05v-IfJdgX3BXcUTlZRdl36wqo5CCckcqEjGnePL3_iQfEchEO52-G85'),(53,'0b8becede7a3559aa2deeff99c51d9c6','Yes',18372,0,'U','A','Sandeep','Dewangan','12345','sandeepdewangan2012@gmail.com','2020-09-01','Male','Married','2020-09-21','raipur','','N','Y','N','Y',53,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','dYXKPntORFC8082uBOZu23:APA91bEfbyDxV33jLRD61G8L1YnypFLqMOt4rr39FpAwpCgquIQY5WiJA1bwehMMsGoKb1NMkQmXvjdkKAjx4-LYR0srNYnimkuPWuPY2xxLasyuJ879RvbIEqk-4_iiCkF34VKze_bF'),(76,'1745b3f87170fab69098843e56dfe278','Yes',0,0,'U','A','Vinod Kumar','Rajput','9000350001','','0000-00-00','','','0000-00-00','','','N','Y','N','Y',75,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','cjXvdNmikMk:APA91bEylI0vhOztfc_y89q1vkiPX6F_4JhNpEuEcGUkKlfBK0HrA5UbfL9ZjC-fWVFo_nzmaMVAvZsMFACkY5cgCiW9yCVv08xZcjjbawU7er6_KK_3UepR4KppqGaSecjQOQBvoYC8'),(71,'a1028301bbff33a4443273d3d86a3d99','Yes',0,0,'U','A','Tarun','Sahu','9907790415','tarunkumarsahu.vspl@gmail.com','0000-00-00','','','0000-00-00','','','N','Y','N','Y',71,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','ceN_jo5OQJewBHqiarGSvL:APA91bF6EkiXc7gEd8JMGZ3Hg0dd9VtFlrHJi66D3p9-jT2BF83HazxETgXOX91-wQbrZCLxOy_MIyF18xz_IWb2IEVDeOCGQOtPAg3gvXOXbIrbbSnaUB1gms8Y2mV6GjCZ3UlS_38K'),(59,'f3d801966e7e0d77863c9f8b31d02529','No',0,0,'U','A','Pranjal','Agrawal','9806416985','pranjal914@gmail.com','0000-00-00','','','0000-00-00','','','N','Y','N','Y',49,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',''),(79,'2d3bd33aee1c465d1234e70714324850','Yes',0,0,'U','A','Shreeya','Sharma','8839010483','shreeya.sharma@vnrseeds.com','0000-00-00','','','0000-00-00','','','N','Y','N','Y',79,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','fl4s0WDyzQg:APA91bHI2EDjknTLMcvEE6bU1LIsdegDej5a8dtn5wfEiTRtIGuwwAszLN4Nhx7RtFjyuUwiMy3QcXAj_5QT_arG2nYO0nigjscjOS6RAiHTaqJkQKGeWja60-ZWI9eGFpsSRbPMXwxT'),(62,'39680','No',37080,0,'U','A','Dhrubadeb','Mahata','6296141622','dhrubamahata02@gmail.com','0000-00-00','','','0000-00-00','','','N','Y','N','Y',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',''),(80,'b1bb7dfc8a949da11a7a6d8bbe77c8a7','Yes',71538,1,'U','A','Nabanita','Sarkar','9165432393','nabanita.sarkar@vnrseeds.com','0000-00-00','','','0000-00-00','','','N','Y','N','Y',80,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','ckw9txN523Y:APA91bHXzYkkQ0Pl3pVPKxew2Q_vsY7n3xCzAJYe6qK9_rYHBfzJgkIfguCSCxaGxA6p23I2ejJODPW2gNI9sFRyM7aQc8JnCkndF3fT6iD1gSD_RnKpACuTFeZM0fSe-X1eRXQsd3bR'),(66,'d9a3a622c55fe34bd409a2235f9b675b','No',14930,0,'U','A','prakash','majhi','8847845697','majhi9442@gmail.com','0000-00-00','','','0000-00-00','','','N','Y','N','Y',66,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','fu1Bfjw0TnitgofOn2MpSb:APA91bG4cOMLQnI-QJoUwWYJU6Btf0ZpMfKzkkB8DKe-IH4trlazQidHwbydICzCjzFcJxllsiXS-o3L8THGfv3Qe4YQ4aOnk3liRkY_n5xkpEl58uIUGiQ-kieXmQ5As1wqe2EdqgMU'),(74,'cfb9e62deeccf228a063481f280f205c','No',0,0,'U','A','Vnr Krishna Dahariya','','062608 010','','0000-00-00','','','0000-00-00','','','N','Y','N','Y',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',''),(69,'72ab967f8559ce300b06bf5d54789c00','No',0,0,'U','A','Suresh','Prasad','9771570012','krishaksewakendranawada@gmail.com','0000-00-00','','','0000-00-00','','','N','Y','N','Y',69,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','dMb_RKTlQjqS1WJJ7H_aPk:APA91bHEJvoE6wzl2oayzLP8DzJd9-oTighmOnZLyNLVwcuOcaJt-vvGibOF107loDQePDsv5ibX_PY1K89fgf2ohrhl6GGOdVbO3WTGAPETwN952SC5bUnxkk6dlu5akF2UF93FH_ez'),(70,'99cc0385e7170c6ee7a2cf202d3bbe42','No',0,0,'U','A','Nivedita ','Paul','9165797588','nivedita03.paul@gmail.com','0000-00-00','','','0000-00-00','','','N','Y','N','Y',70,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','fg4FluwsRueEbt_fliDjeZ:APA91bGOfCEnvYF64CBtt86vM3SzMyGE6ZqidIYhdzUz5_aqvPfL71LNrFjza0f4-n92PTYkYVb5B6GB9oUSxQ-OnxiZPYah1cysYL3BbyV-43qK83vmmUobZg5B91_6YRvBFEEvMevr'),(81,'cbd3de5cb26d714be8c306541e7f3509','Yes',0,0,'U','A','Srishti','Taunk','8770747214','srishti.taunk@vnrseeds.com','0000-00-00','','','0000-00-00','','','N','Y','N','Y',81,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','d4H4_MUEUwQ:APA91bHmiT6bhM-XCakY6IG3DXUJ_AvA5Yh8F0vaot3KwNqa8HuXerbbDmFeLX2D_9Zq-J4ahN2CsjNvaZLsStfFDMGLVrA8TwBn6Z961AaMMEeC48lr1cvUgCTzJHaG9IcBL7FizAEq'),(82,'15869308eb7795a355e6ef565a2c6d53','No',0,0,'U','A','Vnr Shreeya','',' 88390 104','','0000-00-00','','','0000-00-00','','','N','Y','N','Y',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',''),(83,'dd2384b0a3772d8ccb964af2da871ef1','No',0,0,'U','A','Vnr Vipin Sharma','',' 93017 317','','0000-00-00','','','0000-00-00','','','N','Y','N','Y',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',''),(84,'147aabaf03fd52d5bfe02df5834af329','Yes',0,0,'U','A','Krishna','Dahariya','6260801069','krishna.dahariya@vnrseeds.com','0000-00-00','','','0000-00-00','','','N','Y','N','Y',84,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','doXVyS70VyI:APA91bFHkrtsK1YLoNf9kmbdZqI9nbO1RVeeDkvk6fIuN26Z-xYAp8SqBjjfrvW3Frrw-uTH72RnAIV-j8qXa22_7l3DBG0tHxdkSAzKWkJCVJRKV92MqqbSnblioUTo9T-iaxmHaHpo'),(85,'af3d7d7326af3305fe331fd0441d1c20','Yes',0,0,'U','A','Debrat','Roy','9300456007','Debrat.roy@vnrseeds.com','0000-00-00','Male','Married','0000-00-00','Raipur','','N','Y','N','Y',85,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','dsJfSjq37JM:APA91bE5OD_LDZI47uNCn3-TnzEMK4Fq-QFuf7Bd8K6gR5mYnpVaM5FLY5ko3yS8o1kmTUWNa7rtEBLvhb9UuwJC0iEkfxdj6NZffgbyzFYsVBL2jhuftdUO1Cvyk8CcjA29AY9Xfs1W'),(94,'3fd9eca42ee930039e7236c0c1d736ba','No',0,0,'U','A','Jio-General Helpline','','199','','0000-00-00','','','0000-00-00','','','N','Y','N','Y',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',''),(92,'14663816a87ff1539e548004e8c4c7be','Yes',0,0,'U','A','RAHUL  SINHA','','9770866241','','0000-00-00','','','0000-00-00','','','N','Y','N','Y',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','fI2U3GKmhQ8:APA91bEzjZ77ZOWl5ZBqx61lrU2if5JJOc0uXO-CV2Y1kfVHl0g7Rvb_ZG73fdbUN9Lf6LBnJg009eDaVqrlpUrWsz4MdxsTSer-IkoiDVASkDrFWu7RnrS8vlvJx2pRGasH074MhqmJ'),(93,'c7f64fa9cdea5fa8a459780281d05761','No',79620,0,'U','A','SANDEEP KUMAR DEWANGAN','','9755691658','','0000-00-00','','','0000-00-00','','','N','Y','N','Y',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_notification`
--

DROP TABLE IF EXISTS `user_notification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_notification` (
  `nid` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(150) NOT NULL,
  `description` varchar(200) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by` int(11) NOT NULL,
  `modified_at` date NOT NULL,
  PRIMARY KEY (`nid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_notification`
--

LOCK TABLES `user_notification` WRITE;
/*!40000 ALTER TABLE `user_notification` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_notification` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_notification_user`
--

DROP TABLE IF EXISTS `user_notification_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_notification_user` (
  `usu_id` int(11) NOT NULL AUTO_INCREMENT,
  `nid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  PRIMARY KEY (`usu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_notification_user`
--

LOCK TABLES `user_notification_user` WRITE;
/*!40000 ALTER TABLE `user_notification_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_notification_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_old`
--

DROP TABLE IF EXISTS `user_old`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_old` (
  `userid` int(5) NOT NULL AUTO_INCREMENT,
  `upwd` varchar(20) NOT NULL,
  `user_varified` varchar(5) NOT NULL DEFAULT 'No',
  `otp` int(11) NOT NULL,
  `otp_varified` int(11) NOT NULL,
  `utype` char(1) NOT NULL COMMENT 'A-admin U-user',
  `usts` char(1) NOT NULL COMMENT 'A-active D-deactive',
  `ufname` varchar(50) NOT NULL,
  `ulname` varchar(50) NOT NULL,
  `ucontact` varchar(10) NOT NULL,
  `uemail` varchar(50) NOT NULL,
  `udob` date NOT NULL,
  `ugender` varchar(20) NOT NULL,
  `marital_status` varchar(10) NOT NULL,
  `Anniversary` date NOT NULL,
  `address` varchar(150) NOT NULL,
  `profile_pic` varchar(30) NOT NULL,
  `uexecute` char(1) NOT NULL DEFAULT 'N' COMMENT 'Y-yes N-No',
  `uadd` char(1) NOT NULL DEFAULT 'Y' COMMENT 'Y-yes N-No',
  `udelete` char(1) NOT NULL DEFAULT 'N' COMMENT 'Y-yes N-No',
  `uview` char(1) NOT NULL DEFAULT 'Y' COMMENT 'Y-yes N-No',
  `crby` int(5) NOT NULL COMMENT 'User',
  `crdate` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_at` datetime NOT NULL,
  PRIMARY KEY (`userid`),
  KEY `userid` (`userid`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_old`
--

LOCK TABLES `user_old` WRITE;
/*!40000 ALTER TABLE `user_old` DISABLE KEYS */;
INSERT INTO `user_old` (`userid`, `upwd`, `user_varified`, `otp`, `otp_varified`, `utype`, `usts`, `ufname`, `ulname`, `ucontact`, `uemail`, `udob`, `ugender`, `marital_status`, `Anniversary`, `address`, `profile_pic`, `uexecute`, `uadd`, `udelete`, `uview`, `crby`, `crdate`, `modified_by`, `modified_at`) VALUES (1,'admin','Yes',97203,1,'A','A','admin','','','admin@gmail.com','0000-00-00','Male','Unmarried','0000-00-00','','profile_pics/1.png','Y','Y','N','Y',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00'),(2,'123456','Yes',17980,1,'U','A','Ajay','Kumar','9754808238','dewangan.ajay7@gmail.com','1999-12-31','Male','Married','2012-04-30','Kumhari','','N','Y','N','Y',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00'),(3,'password','Yes',55028,1,'U','A','amit','chandrakar','8839826466','amitchandrakar028@gmail.com','0000-00-00','','','0000-00-00','','','N','Y','N','Y',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00'),(8,'fagun1602','Yes',70619,1,'U','A','fagun','jaiswal','7000390267','fagunjaiswal0802@gmail.com','1994-02-08','Female','Unmarried','0000-00-00','','','N','Y','N','Y',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00'),(9,'diksha@95','Yes',26983,1,'U','A','Rohini','Narasaiya','9525018823','d.rohini@vnrseeds.com','1969-08-21','Female','Married','1992-06-21','','','N','Y','N','Y',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00'),(7,'70593','Yes',39310,1,'U','A','Aruna','Jaiswal','9589809114','arunajaiswal515@gmail.com','0000-00-00','','','0000-00-00','','','N','Y','N','Y',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00'),(12,'KILLIKULAM','Yes',71202,1,'U','A','Randip','Ghosh','8819090075','randip.ghosh@vnrnursery.in','0000-00-00','','','0000-00-00','','','N','Y','N','Y',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00'),(11,'paddy#2355','Yes',27966,1,'U','A','Harendra ','Kumar','9329040330','gautam.sharma@vnrseeds.com','0000-00-00','','','0000-00-00','','','N','Y','N','Y',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00'),(13,'bala','Yes',75081,1,'U','A','Bala','krishna','8109877958','balakrishna8524@gmail.com','0000-00-00','','','0000-00-00','','','N','Y','N','Y',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00');
/*!40000 ALTER TABLE `user_old` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'vnrseed2_reminder'
--

--
-- Dumping routines for database 'vnrseed2_reminder'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-07-26 11:18:00
