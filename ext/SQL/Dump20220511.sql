CREATE DATABASE  IF NOT EXISTS `ultraverse` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `ultraverse`;
-- MySQL dump 10.13  Distrib 8.0.27, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: ultraverse
-- ------------------------------------------------------
-- Server version	5.7.37-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `badges`
--

DROP TABLE IF EXISTS `badges`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `badges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `icon` varchar(45) NOT NULL,
  `title` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `badges`
--

LOCK TABLES `badges` WRITE;
/*!40000 ALTER TABLE `badges` DISABLE KEYS */;
INSERT INTO `badges` VALUES (1,'circular blue code icon','Developer'),(2,'circular legal  icon','Admin');
/*!40000 ALTER TABLE `badges` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `channels`
--

DROP TABLE IF EXISTS `channels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `channels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `channels`
--

LOCK TABLES `channels` WRITE;
/*!40000 ALTER TABLE `channels` DISABLE KEYS */;
INSERT INTO `channels` VALUES (1,'#general');
/*!40000 ALTER TABLE `channels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `messages` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `UID` int(11) NOT NULL,
  `message` varchar(2000) NOT NULL,
  `channel` varchar(45) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `UIDD_idx` (`UID`),
  CONSTRAINT `UIDD` FOREIGN KEY (`UID`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` VALUES (1,4,'Hello world','#general'),(2,5,'venez on fait un chat toxic','#general'),(3,4,'go PTDR LOL','#general'),(4,8,'O_O','#general'),(5,7,'Appétit ','#general'),(6,6,'toxic','#general'),(7,8,'oui','#general'),(8,9,'User Test','#general'),(9,10,'Mod Test','#general'),(10,4,'https://cdn.discordapp.com/attachments/632906378423566346/967475240257085500/unknown.png','#general'),(11,4,'test','#general'),(12,4,'https://google.com','#general'),(13,5,'azer','#general'),(14,8,'https://i.pinimg.com/originals/d9/10/95/d91095e3dc39b80580a7fbd34ecb2cb6.jpg','#general'),(16,6,'https://www.redbubble.com/i/mug/cheems-bonk-by-Eggspud/53285167.9Q0AD','#general'),(17,6,'https://ih1.redbubble.net/image.1454275608.5167/flat,750x,075,f-pad,750x1000,f8f8f8.jpg','#general'),(18,5,'https://www.quma.fr/wp-content/uploads/2019/08/fond-header-couleurs.jpg','#general'),(19,5,'venez on fait un chat toxic','#general'),(20,8,'les noirs....','#general'),(21,5,'aaaah oui ce genre de personne SYMPHATIQUE ','#general'),(22,6,'https://slimber.com/img/images2/44/446405/toxic-cpi-cat.jpg','#general'),(23,5,'https://i.imgflip.com/5vljow.jpg','#general'),(24,5,'https://img-comment-fun.9cache.com/media/aNWG3L0/aWlKXJJR_700w_0.jpg','#general'),(25,11,'bruh','#general'),(26,4,'AAAAAA','#general'),(27,4,'coucou &amp;#039;^&amp;#039;','#general'),(28,11,'bouh','#general'),(29,4,'&amp;lt;b&amp;gt;Test&amp;lt;/b&amp;gt;','#general'),(30,4,'parfait','#general'),(31,12,'https://www.youtube.com/watch?v=LJHZ15s0Tus','#general'),(32,6,'https://miro.medium.com/max/1400/1*jB76MLZjiNhGSQQvxm7LSQ.gif','#general'),(33,5,'zera','#general');
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(64) NOT NULL,
  `message` varchar(4000) NOT NULL,
  `UID` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `post_uid_idx` (`UID`),
  CONSTRAINT `post_uid` FOREIGN KEY (`UID`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `relations`
--

DROP TABLE IF EXISTS `relations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `relations` (
  `fro` int(11) NOT NULL,
  `to` int(11) NOT NULL,
  KEY `ori_idx` (`fro`),
  KEY `fol_idx` (`to`),
  CONSTRAINT `fol` FOREIGN KEY (`to`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ori` FOREIGN KEY (`fro`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `relations`
--

LOCK TABLES `relations` WRITE;
/*!40000 ALTER TABLE `relations` DISABLE KEYS */;
/*!40000 ALTER TABLE `relations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_badge`
--

DROP TABLE IF EXISTS `user_badge`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_badge` (
  `UID` int(11) NOT NULL,
  `BID` int(11) NOT NULL,
  KEY `UIDD_idx` (`UID`),
  KEY `BID_idx` (`BID`),
  CONSTRAINT `BBID` FOREIGN KEY (`BID`) REFERENCES `badges` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `UIDDD` FOREIGN KEY (`UID`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_badge`
--

LOCK TABLES `user_badge` WRITE;
/*!40000 ALTER TABLE `user_badge` DISABLE KEYS */;
INSERT INTO `user_badge` VALUES (4,1),(4,2),(5,1),(5,2),(6,1),(6,2),(7,1),(7,2),(8,1),(8,2);
/*!40000 ALTER TABLE `user_badge` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `username_safe` varchar(32) NOT NULL,
  `pw_hash` char(60) NOT NULL,
  `rank` tinyint(4) NOT NULL DEFAULT '1',
  `last_seen` bigint(20) NOT NULL DEFAULT '0',
  `register` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_safe_UNIQUE` (`username_safe`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (4,'PANIGE','panige','$2y$10$apTqTg3wvrAw4CY/xD/7fO6pHZHbLaGiZnqdsPnCWzFqvBA0JS9Mq',3,1652291460,1652258327),(5,'Melio','melio','$2y$10$2bwX/IC2XzLxffYzQxneHehh5c1d6lWXZc5i/E5UAKt2LGHVmf4vG',3,1652283325,1652258327),(6,'ALLE','alle','$2y$10$bfbPmd5M9ovFkt90rQyRy.t1HuruUVSFZHeCLsEUgSY7jtLvZqv.6',3,1652301572,1652258327),(7,'Lucas','lucas','$2y$10$bMm6EFwyvE/Wp1hkYBGMt.Z/N9kgLwwsjAyAxN4fxKNwAOU8LTCmy',3,1652282627,1652258327),(8,'samuel','samuel','$2y$10$Fed5H9X2oRaAOr/yXAUnduJkvAupXB2thN/gh.H95aELWqrbXAYdO',3,1652301535,1652258327),(9,'DummyUser','dummyuser','$2y$10$apTqTg3wvrAw4CY/xD/7fO6pHZHbLaGiZnqdsPnCWzFqvBA0JS9Md',1,0,1652258327),(10,'DummyMod','dummymod','$2y$10$apTqTg3wvrAw4CY/xD/7fO6pHZHbLaGiZnqdsPnCWzFqvBA0JS9Md',2,0,1652258327),(11,'Dew','dew','$2y$10$DN9SBhUhyu6vxL6sfm.8f.HW1V1IQgQHcAOHDuyriT2uM4FxVy2Yi',1,1652278827,1652276894),(12,'jubs_kan3ki','jubs_kan3ki','$2y$10$tIK1Nl1r009Si/A8NzbDX.cR4L/.DJf3Hs190O43.GSSBCRby1aMG',1,1652301578,1652281088);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `webtokens`
--

DROP TABLE IF EXISTS `webtokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `webtokens` (
  `UID` int(11) NOT NULL,
  `token` char(32) NOT NULL,
  PRIMARY KEY (`token`),
  KEY `uid_idx` (`UID`),
  CONSTRAINT `uid` FOREIGN KEY (`UID`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `webtokens`
--

LOCK TABLES `webtokens` WRITE;
/*!40000 ALTER TABLE `webtokens` DISABLE KEYS */;
INSERT INTO `webtokens` VALUES (4,'3ISZfSnCvtGFziHXG4lPDpKGkAzYHQlC'),(4,'DafolUw3d6q9ga4RU8cx8tHH93L49c5d'),(4,'GNG3zqLFvCRq3k2JeV1sVJ1eVRMSoqQO'),(4,'tW0NIo2ZSeV1T08EvhXNxkdRra8Mn4Qo'),(4,'Ve6AYYWV4y8Fqva1ySMPCzSRUsELUStI'),(4,'zktFDuAbEnT8D6ti6qneVDMu2urCdLm9'),(5,'CZpGXy4Q7ZpfIsE5O2zn4IuhST4Zo7zu'),(5,'NTUNOXMX5w73YrLLMoBR2wvDIA9CdcJZ'),(6,'1fM1G0mhKTmSSijTL0CG7GI2xBlfRN6L'),(6,'wgS7BP8FGyYPggoWSo8zR5Hki5mhDaBY'),(7,'OPyhRi0ziKShp2LFOu8B5NppqwNDsLyR'),(8,'gLZdZZCqK9rKjybhm8AhvDm5HagQAyKT'),(11,'NqXJsdEwSt0lImBPLeH5jWNzN82qJo5h'),(12,'uR8jlNftvvXyolWZdiqESdUfTltzqLPc');
/*!40000 ALTER TABLE `webtokens` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-05-11 22:39:39
