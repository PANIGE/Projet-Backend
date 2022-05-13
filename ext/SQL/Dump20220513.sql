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
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `is_private` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` VALUES (1,'test',1),(2,'test2',1),(3,'test3',0),(4,'test4',0),(5,'test5',0),(6,'groupe',0);
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
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
  `unix` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  KEY `UIDD_idx` (`UID`),
  CONSTRAINT `UIDD` FOREIGN KEY (`UID`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=238 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` VALUES (1,4,'Hello world','#general',0),(2,5,'venez on fait un chat toxic','#general',0),(3,4,'go PTDR LOL','#general',0),(4,8,'O_O','#general',0),(6,6,'toxic','#general',0),(7,8,'oui','#general',0),(9,10,'Mod Test','#general',0),(10,4,'https://cdn.discordapp.com/attachments/632906378423566346/967475240257085500/unknown.png','#general',0),(11,4,'test','#general',0),(12,4,'https://google.com','#general',0),(13,5,'azer','#general',0),(14,8,'https://i.pinimg.com/originals/d9/10/95/d91095e3dc39b80580a7fbd34ecb2cb6.jpg','#general',0),(16,6,'https://www.redbubble.com/i/mug/cheems-bonk-by-Eggspud/53285167.9Q0AD','#general',0),(17,6,'https://ih1.redbubble.net/image.1454275608.5167/flat,750x,075,f-pad,750x1000,f8f8f8.jpg','#general',0),(18,5,'https://www.quma.fr/wp-content/uploads/2019/08/fond-header-couleurs.jpg','#general',0),(19,5,'venez on fait un chat toxic','#general',0),(20,8,'les noirs....','#general',0),(21,5,'aaaah oui ce genre de personne SYMPHATIQUE ','#general',0),(22,6,'https://slimber.com/img/images2/44/446405/toxic-cpi-cat.jpg','#general',0),(23,5,'https://i.imgflip.com/5vljow.jpg','#general',0),(24,5,'https://img-comment-fun.9cache.com/media/aNWG3L0/aWlKXJJR_700w_0.jpg','#general',0),(25,11,'bruh','#general',0),(26,4,'AAAAAA','#general',0),(27,4,'coucou &amp;#039;^&amp;#039;','#general',0),(28,11,'bouh','#general',0),(29,4,'&amp;lt;b&amp;gt;Test&amp;lt;/b&amp;gt;','#general',0),(30,4,'parfait','#general',0),(31,12,'https://www.youtube.com/watch?v=LJHZ15s0Tus','#general',0),(32,6,'https://miro.medium.com/max/1400/1*jB76MLZjiNhGSQQvxm7LSQ.gif','#general',0),(33,5,'zera','#general',0),(34,5,'bonsoir le chat toxic','#general',0),(35,5,'https://www.memecreator.org/static/images/memes/4032233.jpg','#general',0),(36,5,'https://media.makeameme.org/created/im-dead-ok.jpg','#general',0),(37,13,' I came back','#general',0),(38,5,'https://i.pinimg.com/736x/5f/39/60/5f3960e945c27315ffb006a9d1d44843.jpg','#general',0),(39,13,'abonnez vous je rend','#general',0),(40,4,'test','10',0),(41,10,'test','4',0),(42,4,'a','5',0),(43,5,'parfait','4',0),(44,5,'ceci est un test','8',0),(45,8,'d&amp;#039;accord, I see... ','5',0),(46,8,'https://c.tenor.com/oc7MfKdTd3kAAAAC/batman-i-see.gif','5',0),(48,5,'https://www.meme-arsenal.com/memes/0de419683b4c4e02fb4c8517b781fb85.jpg','8',0),(49,5,'https://c.tenor.com/gR8DKuQxiC0AAAAM/hey-you-guys-hey-you.gif','6',0),(50,11,'love','4',0),(51,11,'love','4',0),(52,11,'love','4',0),(53,11,'love','4',0),(54,4,'love','11',0),(55,4,'lovelove','11',0),(56,4,'ove','11',0),(57,4,'love','11',0),(58,4,'love','11',0),(59,4,'love','11',0),(60,4,'love','11',0),(61,4,'love','11',0),(62,4,'love','11',0),(63,4,'love','11',0),(64,11,'love','4',0),(65,11,'love','4',0),(66,11,'love','4',0),(67,11,'love','4',0),(68,11,'love','4',0),(69,11,'love','4',0),(70,11,'love','4',0),(71,11,'love','4',0),(72,11,'love','4',0),(73,11,'love','4',0),(74,11,'love','4',0),(75,11,'love','4',0),(76,11,'love','4',0),(77,4,'love','11',0),(78,4,'love','11',0),(79,4,'love','11',0),(80,4,'love','11',0),(81,4,'love','11',0),(82,4,'love','11',0),(83,4,'love','11',0),(84,4,'love','11',0),(85,4,'love','11',0),(86,4,'love','11',0),(87,11,'love','4',0),(88,11,'love','4',0),(89,11,'love','4',0),(90,11,'love','4',0),(91,11,'love','4',0),(92,4,'alors, petit bug, tu peux spam ta touche entrer pendant le loading, ca va quand meme envoyer le message en boucle','11',0),(93,11,'love','4',0),(94,11,'love','4',0),(95,11,'love','4',0),(96,11,'love','4',0),(97,11,'love','4',0),(98,11,'love','4',0),(99,11,'love','4',0),(100,11,'love','4',0),(101,11,'love','4',0),(102,11,'love','4',0),(103,11,'love','4',0),(104,11,'love','4',0),(105,11,'love','4',0),(106,11,'love','4',0),(107,11,'love','4',0),(108,11,'love','4',0),(109,11,'love','4',0),(110,11,'WTF','4',0),(111,11,'aaaa','4',0),(112,11,'aaaa','4',0),(113,11,'aaaa','4',0),(114,11,'aaaa','4',0),(115,11,'aaaa','4',0),(116,11,'aaaa','4',0),(117,11,'aaaa','4',0),(118,11,'aaaa','4',0),(119,11,'aaaa','4',0),(120,11,'aaaa','4',0),(121,11,'aaaa','4',0),(122,11,'aaaa','4',0),(123,11,'aaaa','4',0),(124,11,'aaaa','4',0),(125,11,'aaaa','4',0),(126,11,'aaaa','4',0),(127,11,'oups','4',0),(128,11,'oups','4',0),(129,11,'oups','4',0),(130,11,'oups','4',0),(131,11,'oups','4',0),(132,11,'oups','4',0),(133,11,'oups','4',0),(134,11,'oups','4',0),(135,11,'oups','4',0),(136,11,'oups','4',0),(137,11,'oups','4',0),(138,11,'oups','4',0),(139,11,'oups','4',0),(140,11,'oups','4',0),(141,11,'oups','4',0),(142,11,'oups','4',0),(143,4,'xDDD enfaite le loading bloque uniquement le focus entrant, mais si tu es déja dedant, tu as toujours le focus','11',0),(144,11,'loading','4',0),(145,11,'loading','4',0),(146,11,'loading','4',0),(147,11,'loading','4',0),(148,11,'loading','4',0),(149,11,'loading','4',0),(150,11,'loading','4',0),(151,11,'loading','4',0),(152,11,'loading','4',0),(153,11,'loading','4',0),(154,11,'loading','4',0),(155,11,'loading','4',0),(156,11,'loading','4',0),(157,11,'loading','4',0),(158,11,'loading','4',0),(159,11,'loading','4',0),(160,11,'loading','4',0),(161,11,'focus','4',0),(162,11,'focus','4',0),(163,11,'focus','4',0),(164,11,'focus','4',0),(165,11,'focus','4',0),(166,11,'focus','4',0),(167,11,'focus','4',0),(168,11,'focus','4',0),(169,11,'focus','4',0),(170,11,'focus','4',0),(171,11,'focus','4',0),(172,11,'focus','4',0),(173,11,'focus','4',0),(174,11,'focus','4',0),(175,11,'focus','4',0),(176,11,'focus','4',0),(177,11,'rip','4',0),(178,11,'rip','4',0),(179,11,'rip','4',0),(180,11,'rip','4',0),(181,11,'rip','4',0),(182,11,'rip','4',0),(183,11,'rip','4',0),(184,11,'rip','4',0),(185,11,'rip','4',0),(186,11,'rip','4',0),(187,11,'rip','4',0),(188,11,'rip','4',0),(189,11,'rip','4',0),(190,11,'rip','4',0),(191,11,'rip','4',0),(192,11,'rip','4',0),(193,11,'rip','4',0),(194,4,'Xd','11',0),(195,11,'par contre','4',0),(196,11,'uc chiant','4',0),(197,11,'un truc chiant','4',0),(198,11,'le loading est chiant quand tu veux écrire plusieurs messages daffilés','4',0),(199,11,'ensuite','4',0),(200,11,'faudrait une petite balise (j&amp;#039;ai plus le mot en tête) ou indiquer qu&amp;#039;il y a un nouveau message, car la j&amp;#039;étais en train de remonter pour relire ton message et ça m&amp;#039;a viré en bas','4',0),(201,11,'oups','#general',0),(202,11,'oups','#general',0),(203,11,'oups','#general',0),(204,11,'oups','#general',0),(205,11,'oups','#general',0),(218,11,'oups','4',0),(219,11,'oups','4',0),(220,11,'oups','4',0),(221,11,'oups','4',0),(222,11,'oups','4',0),(223,11,'oups','4',0),(224,11,'oups','4',0),(225,11,'oups','4',0),(226,11,'oups','4',0),(227,11,'oups','4',0),(228,11,'oups','4',0),(229,11,'oups','4',0),(230,11,'oups','4',0),(231,11,'oups','4',0),(232,11,'oups','4',0),(233,11,'oups','4',0),(234,11,'oups','4',0),(235,11,'oups','4',0),(236,11,'Bonjour','12',0),(237,4,'test','#general',0);
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
  `unix` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `post_uid_idx` (`UID`),
  CONSTRAINT `post_uid` FOREIGN KEY (`UID`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (3,'HELLO WORLD','Waifu Land',4,1652431061),(4,'BEST champion ever ','the realy broken champs in summoner&#039;s rift',5,1652433560),(5,'truc','bidule',5,1652433623),(6,'Photo de mon chien ','avis ?',13,1652433746),(7,'My Avatar but Full Size','This is moona Hoshinova from Hololive',4,1652437054),(8,'Rescue Anna !!','An existence without her, is not possible.....',8,1652445921),(9,'This is Kermit','Kermit is drinking tea',6,1652446297),(10,'Rem','Just Rem',11,1652447632);
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts_comments`
--

DROP TABLE IF EXISTS `posts_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `posts_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `UID` int(11) NOT NULL,
  `PID` int(11) DEFAULT NULL,
  `CID` int(11) DEFAULT NULL,
  `content` varchar(2000) NOT NULL,
  `unix` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id_comment_idx` (`UID`),
  KEY `post_id_comment_idx` (`PID`),
  KEY `comment_id_comment_idx` (`CID`),
  CONSTRAINT `comment_id_comment` FOREIGN KEY (`CID`) REFERENCES `posts_comments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `post_id_comment` FOREIGN KEY (`PID`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_id_comment` FOREIGN KEY (`UID`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts_comments`
--

LOCK TABLES `posts_comments` WRITE;
/*!40000 ALTER TABLE `posts_comments` DISABLE KEYS */;
INSERT INTO `posts_comments` VALUES (1,4,10,NULL,'Love <3 ',1652474552),(2,4,NULL,1,'T\'es la best <3',1652475237),(6,4,6,NULL,'il fait peur !',1652478276);
/*!40000 ALTER TABLE `posts_comments` ENABLE KEYS */;
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
INSERT INTO `relations` VALUES (5,4),(4,5),(8,5),(13,5),(12,5),(12,4),(5,6),(12,13),(13,6),(12,6),(5,8),(6,5),(6,13),(5,12),(13,4),(6,12),(5,13),(6,4),(6,8),(4,11),(11,4),(4,8),(4,13),(4,6),(8,6),(8,13),(8,4),(12,11),(13,8),(4,10),(11,12),(11,5),(11,6),(11,8),(11,13),(11,10);
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
INSERT INTO `user_badge` VALUES (4,1),(4,2),(5,1),(5,2),(6,1),(6,2),(8,1),(8,2);
/*!40000 ALTER TABLE `user_badge` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_groups`
--

DROP TABLE IF EXISTS `user_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_groups` (
  `UID` int(11) NOT NULL,
  `GID` int(11) NOT NULL,
  `rank` tinyint(3) unsigned NOT NULL,
  KEY `group_user_id_idx` (`UID`),
  KEY `group_g_id_idx` (`GID`),
  CONSTRAINT `group_g_id` FOREIGN KEY (`GID`) REFERENCES `groups` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `group_user_id` FOREIGN KEY (`UID`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_groups`
--

LOCK TABLES `user_groups` WRITE;
/*!40000 ALTER TABLE `user_groups` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_groups` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (4,'PANIGE','panige','$2y$10$apTqTg3wvrAw4CY/xD/7fO6pHZHbLaGiZnqdsPnCWzFqvBA0JS9Mq',3,1652478276,1652258327),(5,'Melio','melio','$2y$10$2bwX/IC2XzLxffYzQxneHehh5c1d6lWXZc5i/E5UAKt2LGHVmf4vG',3,1652468346,1652258327),(6,'ALLE','alle','$2y$10$bfbPmd5M9ovFkt90rQyRy.t1HuruUVSFZHeCLsEUgSY7jtLvZqv.6',3,1652453770,1652258327),(8,'samuel','samuel','$2y$10$Fed5H9X2oRaAOr/yXAUnduJkvAupXB2thN/gh.H95aELWqrbXAYdO',3,1652476968,1652258327),(10,'DummyMod','dummymod','$2y$10$apTqTg3wvrAw4CY/xD/7fO6pHZHbLaGiZnqdsPnCWzFqvBA0JS9Md',2,0,1652258327),(11,'Dew','dew','$2y$10$DN9SBhUhyu6vxL6sfm.8f.HW1V1IQgQHcAOHDuyriT2uM4FxVy2Yi',1,1652456426,1652276894),(12,'jubs_kan3ki','jubs_kan3ki','$2y$10$tIK1Nl1r009Si/A8NzbDX.cR4L/.DJf3Hs190O43.GSSBCRby1aMG',1,1652451573,1652281088),(13,'Lucas','lucas','$2y$10$mkNaIB8AtX435dYIZwCSsehix5vhBqqwQr/uUnD0cwW7m5bly2IKC',1,1652447771,1652431070);
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
  CONSTRAINT `uid` FOREIGN KEY (`UID`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `webtokens`
--

LOCK TABLES `webtokens` WRITE;
/*!40000 ALTER TABLE `webtokens` DISABLE KEYS */;
INSERT INTO `webtokens` VALUES (4,'3ISZfSnCvtGFziHXG4lPDpKGkAzYHQlC'),(4,'83VuciEzXeUwNKDgbIHdtgb5lewQ9Hen'),(4,'DafolUw3d6q9ga4RU8cx8tHH93L49c5d'),(4,'GNG3zqLFvCRq3k2JeV1sVJ1eVRMSoqQO'),(4,'Ve6AYYWV4y8Fqva1ySMPCzSRUsELUStI'),(4,'zktFDuAbEnT8D6ti6qneVDMu2urCdLm9'),(5,'CZpGXy4Q7ZpfIsE5O2zn4IuhST4Zo7zu'),(5,'NTUNOXMX5w73YrLLMoBR2wvDIA9CdcJZ'),(6,'1fM1G0mhKTmSSijTL0CG7GI2xBlfRN6L'),(6,'JusOFg76AhyCuQya99Dj2S3T4T1dAAbR'),(6,'wgS7BP8FGyYPggoWSo8zR5Hki5mhDaBY'),(8,'jno86qU81C4vApOVLfvXNQE3EwOt7Dc6'),(8,'sokRzkei40LAHyKE4CC45MKGz68LFiph'),(8,'tW0NIo2ZSeV1T08EvhXNxkdRra8Mn4Qo'),(11,'beMi3w5idoeIB8r4N370vGpWwgBdLqr6'),(11,'NqXJsdEwSt0lImBPLeH5jWNzN82qJo5h'),(12,'KfKgnMX8CRK2zhcx6f4WjxLho9unZf5M'),(13,'FmX5fKZOpRerk6RPwOs1ffrvLVOrsM7I');
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

-- Dump completed on 2022-05-13 23:45:45
