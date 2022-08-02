-- MySQL dump 10.13  Distrib 5.7.33, for Linux (x86_64)
--
-- Host: localhost    Database: vnrseed2_reminder_demo
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
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_request`
--

LOCK TABLES `contact_request` WRITE;
/*!40000 ALTER TABLE `contact_request` DISABLE KEYS */;
INSERT INTO `contact_request` (`req_id`, `request_by`, `request_to`, `request_sent`, `request_approve`, `created_at`, `modified_by`, `modified_at`) VALUES (1,2,1,1,1,'2021-10-22 11:13:31',0,'0000-00-00'),(2,1,2,1,1,'2021-10-22 11:13:31',0,'0000-00-00'),(3,1,2,1,1,'2021-10-22 11:20:19',0,'0000-00-00'),(4,2,1,1,1,'2021-10-22 11:20:19',0,'0000-00-00'),(5,1,3,1,1,'2021-10-22 11:24:35',0,'0000-00-00'),(6,3,1,1,1,'2021-10-22 11:25:52',0,'0000-00-00'),(7,3,2,1,1,'2021-10-22 11:27:05',0,'0000-00-00'),(8,2,3,1,1,'2021-10-22 11:27:05',0,'0000-00-00'),(27,2,16,1,1,'2021-10-29 09:39:30',0,'0000-00-00'),(28,16,2,1,1,'2021-10-29 09:40:36',0,'0000-00-00'),(29,2,17,1,1,'2021-11-13 05:44:07',0,'0000-00-00'),(30,17,2,1,1,'2021-11-13 05:50:14',0,'0000-00-00'),(31,17,3,1,0,'2021-11-17 06:32:27',0,'0000-00-00'),(32,17,1,1,1,'2021-12-04 05:29:46',0,'0000-00-00'),(33,17,16,1,0,'2021-11-17 06:32:36',0,'0000-00-00'),(34,17,18,1,1,'2021-11-17 06:33:36',0,'0000-00-00'),(35,3,1,1,1,'2021-11-24 06:46:49',0,'0000-00-00'),(36,3,1,1,1,'2021-11-24 06:49:30',0,'0000-00-00'),(37,1,17,1,1,'2021-12-04 05:29:46',0,'0000-00-00'),(38,2,21,1,1,'2021-12-23 06:08:07',0,'0000-00-00'),(39,3,1,1,1,'2022-02-03 09:09:28',0,'0000-00-00');
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `group_contact`
--

LOCK TABLES `group_contact` WRITE;
/*!40000 ALTER TABLE `group_contact` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `group_table`
--

LOCK TABLES `group_table` WRITE;
/*!40000 ALTER TABLE `group_table` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `my_note`
--

LOCK TABLES `my_note` WRITE;
/*!40000 ALTER TABLE `my_note` DISABLE KEYS */;
INSERT INTO `my_note` (`id`, `title`, `des`, `created_by`, `created_at`, `modified_by`, `modified_at`) VALUES (1,'Diwali Distribution','test',2,'2021-10-22 12:00:00',0,'0000-00-00 00:00:00');
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
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `my_notification`
--

LOCK TABLES `my_notification` WRITE;
/*!40000 ALTER TABLE `my_notification` DISABLE KEYS */;
INSERT INTO `my_notification` (`id`, `userid`, `title`, `date`, `msg`) VALUES (1,2,'Reminder Testing','2021-10-22 18:00:00','map'),(2,1,'registery','2021-10-22 18:10:00','registery'),(3,2,'Remimder','2021-10-22 18:10:00','Reminder'),(4,2,'Test','2021-10-22 18:14:00','fbb');
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rating`
--

LOCK TABLES `rating` WRITE;
/*!40000 ALTER TABLE `rating` DISABLE KEYS */;
INSERT INTO `rating` (`rid`, `rem_id`, `userid`, `rate`) VALUES (3,1,1,5),(4,2,2,5),(5,2,3,5),(6,3,2,5),(7,3,3,5),(8,5,2,5),(9,5,17,5);
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
  `period` varchar(15) NOT NULL,
  `priority` varchar(10) NOT NULL,
  `from_date` datetime NOT NULL,
  `to_date` datetime NOT NULL,
  `Status` varchar(50) NOT NULL,
  `activity` varchar(5) NOT NULL,
  `remark` varchar(1000) NOT NULL,
  `task_img` varchar(50) NOT NULL,
  `created_by` int(2) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_by` int(2) NOT NULL,
  `modified_at` datetime NOT NULL,
  PRIMARY KEY (`rem_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reminder`
--

LOCK TABLES `reminder` WRITE;
/*!40000 ALTER TABLE `reminder` DISABLE KEYS */;
INSERT INTO `reminder` (`rem_id`, `type`, `title`, `description`, `location`, `rem_req`, `start_date`, `period`, `priority`, `from_date`, `to_date`, `Status`, `activity`, `remark`, `task_img`, `created_by`, `created_at`, `modified_by`, `modified_at`) VALUES (1,'Public','Test','Test','Raipur',0,'2021-10-22 12:00:00','12','Medium','2021-08-22 05:08:51','2021-10-23 05:09:28','Done','D','Good job','',2,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00'),(2,'Public','task4','expense payment','raipur',0,'2021-10-22 12:00:00','12','Medium','2021-10-22 05:27:59','2021-10-23 05:28:05','Done','D','excellent job','',1,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00'),(3,'Public','task5','reminder test','raipur',0,'2021-10-22 12:00:00','0','Medium','2021-10-22 05:49:43','2021-10-23 05:49:55','Done','D','great job','',1,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00'),(4,'Public','Reminder','Reminder Testing','Raipur',0,'2021-10-22 12:00:00','12','Medium','2021-10-22 05:46:30','2021-10-23 05:46:34','Done','D','test','',2,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00'),(5,'Public','Task1','Reminder Testing','Raipur',0,'2021-11-13 12:00:00','12','','2021-11-13 11:23:07','2021-11-14 11:23:14','Done','D','ðŸ‘','',17,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00'),(6,'Public','Asset Folder Updation','A','',0,'2021-11-13 12:00:00','12','Medium','2021-11-14 04:48:04','2021-11-15 04:48:11','Pending','A','','',2,'0000-00-00 00:00:00',0,'2021-11-17 12:00:00'),(7,'Public','test','test','',0,'2021-11-13 12:00:00','24','Low','2021-11-14 05:42:16','2021-11-14 05:42:20','Pending','A','','',2,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00'),(11,'Personal','Test title','test desc','Test',0,'2021-11-18 12:18:31','24','Medium','2021-11-11 12:18:34','2021-11-11 12:18:38','Pending','A','','',2,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00'),(12,'Personal','Test','Test','test location',0,'2021-11-30 09:55:07','24','Low','2021-11-30 09:55:07','2021-11-30 09:55:15','Pending','A','','',2,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00'),(13,'Public','Test ab','ghhj','Gh',0,'2021-12-03 05:12:37','24','Low','2021-12-03 05:12:37','2021-12-05 05:12:52','Pending','A','','',2,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00'),(14,'Personal','Reminder Testing','Test0123','Raipur',0,'2021-12-03 05:18:51','24','Low','2021-12-03 05:18:51','2021-12-06 05:19:06','Pending','A','','',2,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00'),(15,'Public','test','jjjjhhj','',0,'2021-12-03 05:21:47','0','Low','2021-12-03 05:21:47','2021-12-03 05:21:56','Pending','A','','',2,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00');
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reminder_old`
--

LOCK TABLES `reminder_old` WRITE;
/*!40000 ALTER TABLE `reminder_old` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reminder_participants`
--

LOCK TABLES `reminder_participants` WRITE;
/*!40000 ALTER TABLE `reminder_participants` DISABLE KEYS */;
INSERT INTO `reminder_participants` (`id`, `rem_id`, `userid`, `farward_userid`, `status`, `reply_img`, `comment`, `created_at`) VALUES (3,1,1,3,1,'','done','2021-10-22 11:46:52'),(4,2,2,0,1,'','Done','2021-10-22 11:52:45'),(5,2,3,0,1,'','done','2021-10-22 11:51:40'),(6,3,2,0,1,'','Done','2021-10-22 12:15:06'),(7,3,3,0,1,'','completed','2021-10-22 12:14:21'),(8,4,1,0,0,'','','2021-10-22 12:17:16'),(9,4,3,0,0,'','','2021-10-22 12:17:16'),(10,5,2,0,1,'','Done','2021-11-13 05:55:59'),(11,5,17,0,1,'','Done','2021-11-13 05:57:01'),(12,6,2,0,0,'','','2021-11-17 11:19:58'),(13,7,17,0,0,'','','2021-11-17 12:13:01'),(17,11,20,0,0,'','','2021-11-18 06:49:23'),(18,12,20,0,0,'','','2021-11-30 04:25:58'),(19,13,17,0,0,'','','2021-12-03 11:43:28'),(20,14,2,0,0,'','','2021-12-03 11:50:12'),(21,15,1,0,0,'','','2021-12-03 11:54:03'),(22,15,2,0,0,'','','2021-12-03 11:54:03');
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
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reminder_participants_chat`
--

LOCK TABLES `reminder_participants_chat` WRITE;
/*!40000 ALTER TABLE `reminder_participants_chat` DISABLE KEYS */;
INSERT INTO `reminder_participants_chat` (`ChatId`, `rem_id`, `chat_rmk`, `chat_date`, `chat_img`, `TeamBy`) VALUES (1,7,'test','2021-11-29 11:39:17','',2),(2,7,'reply','2021-11-30 11:39:17','',17),(3,7,'test 2','2021-12-01 09:39:17','',2),(4,7,'reply 3','2021-12-01 10:39:17','',17),(5,7,'reply - 4','2021-12-01 11:39:17','',17),(6,7,'Hiii','2021-12-01 16:01:36','',2),(7,7,'hiii','2021-12-01 16:02:38','',2),(8,7,'Test','2021-12-01 17:16:04','',2),(9,7,'Hii test','2021-12-01 17:17:36','',2),(10,7,'Hii test','2021-12-01 17:17:46','',2),(11,7,'Hii','2021-12-01 17:19:11','',2),(12,7,'hii','2021-12-01 17:20:22','',2),(13,7,'hii','2021-12-01 17:20:26','',2),(14,7,'hfh','2021-12-01 17:22:38','',2),(15,7,'pop','2021-12-01 17:22:48','',2),(16,7,'hfj','2021-12-01 17:27:30','',2),(17,7,'hii','2021-12-01 17:36:56','',2),(18,7,'test','2021-12-01 17:38:06','',2),(19,7,'test','2021-12-01 17:40:15','',2),(20,7,'yty','2021-12-01 17:45:15','',2),(21,7,'hii','2021-12-02 10:18:20','',2),(22,7,'hii','2021-12-02 10:18:47','',2),(23,7,'test','2021-12-02 10:31:24','',2),(24,7,'test','2021-12-02 10:32:11','',2),(25,7,'hii','2021-12-02 10:32:23','',2),(26,7,'test','2021-12-02 10:33:34','',2),(27,7,'hii','2021-12-02 10:39:16','',2),(28,7,'udg','2021-12-02 10:43:31','',2),(29,7,'ycf','2021-12-02 10:47:38','',2),(30,7,'hiii','2021-12-02 10:55:31','',2),(31,7,'test','2021-12-02 10:58:22','',2),(32,7,'hii','2021-12-02 11:01:47','',2),(33,7,'test','2021-12-02 11:02:49','',2),(34,7,'hiii','2021-12-02 11:22:15','',2),(35,7,'yest','2021-12-02 11:25:03','',2),(36,7,'hii','2021-12-02 11:36:06','',2),(37,7,'jychj','2021-12-02 11:37:16','',2),(38,7,'','2021-12-02 11:37:28','',2),(39,7,'','2021-12-02 11:37:31','',2),(40,7,'','2021-12-02 11:37:38','',2),(41,7,'hii','2021-12-02 11:41:03','',2),(42,7,'test','2021-12-02 11:48:24','',2),(43,7,'hii','2021-12-02 11:50:21','',2),(44,7,'ho','2021-12-02 11:52:16','',2),(45,7,'huh','2021-12-02 11:59:04','',2),(46,7,'test','2021-12-02 12:30:58','',2),(47,7,'hiiii','2021-12-02 12:38:39','',2),(48,7,'','2021-12-02 12:38:59','',2),(49,7,'ububb','2021-12-02 12:39:36','',2),(50,7,'','2021-12-02 12:39:45','',2),(51,7,'jedg','2021-12-02 12:49:03','',2),(52,7,'','2021-12-02 12:49:15','',2),(53,7,'','2021-12-02 12:49:44','',2),(54,7,'','2021-12-02 12:49:49','',2),(55,7,'cyc','2021-12-02 12:53:19','',2),(56,7,'','2021-12-02 12:53:32','',2),(57,7,'hchx','2021-12-02 13:05:14','',2),(58,7,'','2021-12-02 13:05:18','',2),(59,7,'ty','2021-12-02 14:25:21','',2),(60,7,'','2021-12-02 14:25:37','',2),(61,7,'hii','2021-12-02 14:45:53','',2),(62,7,'','2021-12-02 14:46:06','',2),(63,7,'','2021-12-02 14:52:15','',2),(64,7,'hii','2021-12-02 14:52:30','',2),(65,7,'','2021-12-02 14:52:37','',2),(66,7,'ryrt fyrt fyrfg dt','2021-12-02 14:52:57','',2),(67,7,'hiii','2021-12-02 14:59:33','',2),(68,7,'test','2021-12-02 15:08:37','',2),(69,7,'','2021-12-02 15:08:45','',2),(70,7,'','2021-12-02 15:09:46','',2),(71,7,'top','2021-12-02 15:24:59','',2),(72,7,'','2021-12-02 15:25:13','',2),(73,7,'test','2021-12-02 15:26:32','',2),(74,7,'','2021-12-02 15:26:44','',2),(75,7,'hii','2021-12-02 15:37:14','',2),(76,7,'test','2021-12-02 15:37:21','',2),(77,7,'test2','2021-12-02 15:37:29','',2),(78,7,'test','2021-12-02 15:44:40','',2),(79,7,'thgu','2021-12-02 15:44:48','',2),(80,7,'the','2021-12-02 16:07:27','',2),(81,7,'hii','2021-12-02 16:09:04','',2),(83,7,'yoo','2021-12-02 17:05:16','',2),(84,7,'test','2021-12-02 17:53:12','',17),(85,7,'hello','2021-12-03 15:19:38','',17),(86,7,'hiii','2021-12-03 15:20:59','',2),(87,7,'test','2021-12-03 15:24:08','',2),(88,7,'hii','2021-12-03 15:27:01','',2),(89,7,'rtrrgg','2021-12-03 15:49:35','',2),(90,7,'thd','2021-12-03 15:51:19','',2),(91,7,'ttett','2021-12-03 15:52:08','',2),(92,7,'fydtfc gufg','2021-12-03 15:53:10','',2),(93,7,'ftdfh','2021-12-03 16:50:16','',2),(95,7,'???','2021-12-03 17:18:03','',2),(97,15,'Hii','2021-12-03 18:02:11','',2),(98,15,'Hello','2021-12-03 18:06:20','',2),(99,13,'hii','2021-12-03 18:06:46','',2),(100,6,'hiii','2021-12-03 18:10:40','',2);
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reminder_participants_chatuser`
--

LOCK TABLES `reminder_participants_chatuser` WRITE;
/*!40000 ALTER TABLE `reminder_participants_chatuser` DISABLE KEYS */;
INSERT INTO `reminder_participants_chatuser` (`Id`, `UserId`, `Ndate`, `rem_id`) VALUES (9,2,'2021-12-03 18:18:20',7),(10,2,'2021-12-03 18:18:25',6),(11,2,'2021-12-03 18:09:16',15),(12,2,'2021-12-04 17:14:44',13);
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reminder_task`
--

LOCK TABLES `reminder_task` WRITE;
/*!40000 ALTER TABLE `reminder_task` DISABLE KEYS */;
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
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`userid`, `upwd`, `user_varified`, `otp`, `otp_varified`, `utype`, `usts`, `ufname`, `ulname`, `ucontact`, `uemail`, `udob`, `ugender`, `marital_status`, `Anniversary`, `address`, `profile_pic`, `uexecute`, `uadd`, `udelete`, `uview`, `crby`, `crdate`, `modified_by`, `modified_at`, `user_token`) VALUES (1,'39225df22de7b1ab2e5cf03d912900b9','Yes',0,0,'U','A','fagun ','jaiswal','7000390267','fagunjaiswal.vnr@gmail.com','0000-00-00','','','0000-00-00','','','N','Y','N','Y',1,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','dlNhbTC1Kdw:APA91bFgNVbDWiQTs1LA-Jzr_RMJa7m9wK157T70xZACXTpEDqNAH9GmYDoBiI2YTSyXaXq2nmuzWDLbfQwyd1STg0LzOTw0JJv_CKPLvll5s8h5BXGoAguyFH2_vd4tTXCF6-L03dtl'),(2,'57b5280ca4f08841b71b86b4f5203cf0','Yes',0,0,'U','A','Megha','Soni','8878067802','megha.soni72@gmail.com','0000-00-00','','','0000-00-00','','','N','Y','N','Y',2,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','dtDK0TAIVy4:APA91bGYyuel9kQmnWCjmGWVYo4PM7rEsrWGUiFKb_kx1RqGaoZDg8nM3ScYrFghVJJ3pD336FEhJ8fHYNLFnUQlvxg0LV3Oblt8bCiGU_OeahdcEL3kx7q-C381Zrw8Ma8ms3DBJqQh'),(3,'e10adc3949ba59abbe56e057f20f883e','Yes',0,0,'A','A','Ajay sir VNR',' ','8602190312',' ','0000-00-00','','','0000-00-00','','','N','Y','N','Y',1,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','dPNuGbbCuvo:APA91bFqyBIgNIFzl2mZkzUygNXMzo0QIi-U8eJsv6S_hRmaLWMoO5EyBsIpJX2KEyXMnWyYvfL-4UfF_3DXuqsrbfIYFtpTwTQj0EkJKMJeaghx3DYS52EuTVHWNZdovIHgDkOqT_cO'),(18,'b374d856eb3d8f78c56820a5eb29629d','No',0,0,'U','A','Arvind Sir',' ','9329570007',' ','0000-00-00','','','0000-00-00','','','N','Y','N','Y',17,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',''),(19,'0e09236db12dbaeef86cbc2c097883ea','No',0,0,'U','A','Nivedita Paul Office Ab City','','91657 9758','','0000-00-00','','','0000-00-00','','','N','Y','N','Y',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',''),(17,'489b0853dca0e1de83ff0b390124fc9c','Yes',0,0,'U','A','Abhinav','Builders','7509577077','','0000-00-00','','','0000-00-00','','','N','Y','N','Y',2,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','fjjbL9ljoAY:APA91bFVRegT4VuErjzNHDrQed0hV59m1guqP7PUFxMCXYyAQLeNzEf4wYAzIYUuZBQyA5xZbIlaODq4HHA5d2wjVd_YwTbqVCwW5UBHBkfGiC19mlOUPZHVz9DPHaRn9K7UtFy_mFuH'),(16,'2bf0ccdbb4d3ebbcb990af74bd78c658','Yes',0,0,'U','A','Nivedita VNR',' ','9165797588',' ','0000-00-00','','','0000-00-00','','','N','Y','N','Y',2,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','d_fl55I-EBg:APA91bGAdcaTz-dkxyKogqVeeBdaqHSC2g7nEL9ybYe4U6eyHm3Jn3wa0OwZD27sVUMhT6cfZFfihWMPPKRcfF84ghnEGchX_eSdfmC1XSgb8aoGEutP8VtsoKw7yJrFwE_w5ZKt2sj1'),(20,'a8db05365df55c54b909f990fa86e118','Yes',0,0,'U','A','Tarun','Sahu','9907790415','tarunkumarsahu.vspl@gmail.com','0000-00-00','','','0000-00-00','','','N','Y','N','Y',20,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','dWrC4G-4trY:APA91bFHNxY1kVsqP6EFFy6q-cCAoqir9_6DDRAHou8szSfQ7AyC6vJaGMB5oJCKejCOuzdFNNhN3CTVCPlH91yok1rdWSQwB7CI7wMG7EZGfoopjdKf_0NyRKnK3IWRFqPFM7J4L4_Y'),(21,'965bdde95092200459ab4d18f621974b','No',0,0,'U','A','Young Arms','Foundation ','9399747174','yarmsraipir@gmail.com','0000-00-00','','','0000-00-00','','','N','Y','N','Y',2,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',''),(22,'ccf98ac36118703559808ae6e64f22a1','Yes',0,0,'U','A','test','test','1234567890','developerinvnr@gmail.com','0000-00-00','','','0000-00-00','','','N','Y','N','Y',22,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','fONhmYjFxc0:APA91bHpHxXalYlc_Rzcd1RJpFchU9T4sGQm_onbmjdpv7dus_NSjhMpoDq766HW2ZV_sdPrdH2w1gEolfOz6jhRkW1aIektMqlSW9M9H6W00x1oUTu4ecgUCvu-ndRFpdWejTRmQEVG');
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_old`
--

LOCK TABLES `user_old` WRITE;
/*!40000 ALTER TABLE `user_old` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_old` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'vnrseed2_reminder_demo'
--

--
-- Dumping routines for database 'vnrseed2_reminder_demo'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-07-26 11:18:04
