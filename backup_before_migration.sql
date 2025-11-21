-- MariaDB dump 10.19  Distrib 10.4.27-MariaDB, for osx10.10 (x86_64)
--
-- Host: localhost    Database: zhafirah_local
-- ------------------------------------------------------
-- Server version	10.4.27-MariaDB

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
-- Table structure for table `activity_logs`
--

DROP TABLE IF EXISTS `activity_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activity_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `activity` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `idx_created` (`created_at`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activity_logs`
--

LOCK TABLES `activity_logs` WRITE;
/*!40000 ALTER TABLE `activity_logs` DISABLE KEYS */;
INSERT INTO `activity_logs` VALUES (1,1,'register','User registered via email','127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-04 15:14:52'),(2,1,'login','User logged in successfully','127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-04 15:15:39'),(3,1,'logout','User logged out','127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-04 15:19:57'),(4,1,'login','User logged in successfully','127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-04 15:20:02'),(5,1,'logout','User logged out','127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-04 15:20:18'),(6,1,'login','User logged in successfully','127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-04 15:20:49'),(7,1,'logout','User logged out','127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-04 15:21:53'),(8,1,'login','User logged in successfully','127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-04 15:22:06'),(9,1,'logout','User logged out','127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-04 15:23:30'),(10,1,'login','User logged in successfully','127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-04 15:23:36'),(11,1,'logout','User logged out','127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-04 15:24:05'),(12,1,'login','User logged in successfully','127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-04 15:24:10'),(13,2,'register','User registered via email','127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-06 03:20:31'),(14,2,'login','User logged in successfully','127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-06 03:20:38'),(15,2,'login','User logged in successfully','127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-08 02:20:09'),(16,2,'create_booking','Created booking BKZSNJXJ9ECR for package Paket Umroh Ramadhan 2025','127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-08 03:38:32'),(17,2,'create_booking','Created booking BKEDE315N3GA for package Paket Umroh Ramadhan 2025','127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-08 03:45:12'),(18,2,'create_booking','Created booking BKO1YDH1NUU4 for package Paket Haji Reguler 2025','127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-08 03:51:36'),(19,2,'logout','User logged out','127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-08 04:20:49'),(20,2,'login','User logged in successfully','127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-08 04:20:54'),(21,2,'update_profile','User updated profile','127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-08 04:21:02'),(22,2,'logout','User logged out','127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-08 04:22:09'),(23,2,'login','User logged in successfully','127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-08 04:23:34'),(24,2,'login','User logged in successfully','127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-08 04:53:43'),(25,2,'logout','User logged out','127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-08 04:54:18'),(26,2,'logout','User logged out','127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-08 04:58:23'),(27,2,'login','User logged in successfully','127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-08 05:01:06'),(28,2,'logout','User logged out','127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-08 05:02:48'),(29,2,'login','User logged in successfully','127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-08 05:02:57'),(30,3,'register','User registered via whatsapp','127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-08 06:41:08'),(31,3,'login','User logged in successfully','127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-08 06:41:26'),(32,3,'complete_profile','User completed profile information','127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-08 06:42:03'),(33,3,'create_booking','Created booking BKSMM1YRQ7TB for package Paket Haji Reguler 2025','127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-08 06:43:43'),(34,3,'create_booking','Created booking BKZ66PAJT0GC for package Paket Umroh Ramadhan 2025','127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-08 07:34:30'),(35,3,'create_booking','Created booking BKKDF9VK9LAX for package Paket Umroh Ramadhan 2025','127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-08 07:47:42'),(36,3,'create_booking','Created booking BKPL26AN82GG for package Paket Umroh Ekonomis','127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-08 07:49:35'),(37,2,'create_booking','Created booking BKQ1PSF85044 for package Paket Umroh Ramadhan 2025','127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-08 08:09:57'),(38,2,'create_booking','Created booking BK5V4SWEFQQA for package Paket Umroh Ramadhan 2025','127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-08 08:27:42'),(39,2,'create_booking','Created booking BKWQP22XRX5V for package Paket Umroh Ekonomis','127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-08 08:34:57'),(40,2,'create_booking','Created booking BK1L58AT98I7 for package Paket Umroh Ekonomis','127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-08 09:19:30'),(41,2,'create_booking','Created booking BK4LP6ZA4SN9 for package Paket Umroh Ramadhan 2025','127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-08 09:21:02'),(42,3,'login','User logged in successfully','127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-16 03:26:06'),(43,3,'create_booking','Created booking BKB3103W3QZV for package Paket Umroh Ekonomis','127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-16 03:30:18');
/*!40000 ALTER TABLE `activity_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bookings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `booking_code` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `total_amount` decimal(15,2) NOT NULL,
  `status` enum('pending','paid','confirmed','cancelled','expired') DEFAULT 'pending',
  `payment_status` enum('unpaid','pending','paid','failed','expired') DEFAULT 'unpaid',
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `booking_code` (`booking_code`),
  KEY `user_id` (`user_id`),
  KEY `package_id` (`package_id`),
  KEY `idx_status` (`status`),
  KEY `idx_payment_status` (`payment_status`),
  CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bookings`
--

LOCK TABLES `bookings` WRITE;
/*!40000 ALTER TABLE `bookings` DISABLE KEYS */;
INSERT INTO `bookings` VALUES (8,'BKZSNJXJ9ECR',2,1,35000000.00,'pending','pending','zzz','2025-11-08 03:38:31','2025-11-08 03:38:32'),(9,'BKEDE315N3GA',2,1,35000000.00,'pending','pending','bbbb','2025-11-08 03:45:11','2025-11-08 03:45:12'),(10,'BKO1YDH1NUU4',2,3,65000000.00,'confirmed','paid','testing new','2025-11-08 03:51:35','2025-11-08 03:58:28'),(12,'BKSMM1YRQ7TB',3,3,65000000.00,'confirmed','paid','catatan','2025-11-08 06:43:42','2025-11-08 06:44:28'),(14,'BKZ66PAJT0GC',3,1,35000000.00,'confirmed','paid','xxx','2025-11-08 07:34:29','2025-11-08 07:34:45'),(15,'BKKDF9VK9LAX',3,1,35000000.00,'confirmed','paid','lll','2025-11-08 07:47:41','2025-11-08 07:48:47'),(16,'BKPL26AN82GG',3,2,25000000.00,'confirmed','paid','qqq','2025-11-08 07:49:34','2025-11-08 07:49:50'),(17,'BKQ1PSF85044',2,1,35000000.00,'confirmed','paid','aaa','2025-11-08 08:09:56','2025-11-08 08:10:12'),(18,'BK5V4SWEFQQA',2,1,35000000.00,'confirmed','paid','ddd','2025-11-08 08:27:40','2025-11-08 08:27:57'),(19,'BKWQP22XRX5V',2,2,25000000.00,'confirmed','paid','fff','2025-11-08 08:34:55','2025-11-08 08:35:22'),(21,'BK1L58AT98I7',2,2,25000000.00,'confirmed','paid','xx','2025-11-08 09:19:28','2025-11-08 09:19:55'),(22,'BK4LP6ZA4SN9',2,1,35000000.00,'confirmed','paid','nnn','2025-11-08 09:21:01','2025-11-08 09:21:17'),(25,'BKB3103W3QZV',3,2,25000000.00,'confirmed','paid','ff','2025-11-16 03:30:17','2025-11-16 03:30:35');
/*!40000 ALTER TABLE `bookings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoices`
--

DROP TABLE IF EXISTS `invoices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invoices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_number` varchar(100) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `invoice_type` enum('invoice','receipt') DEFAULT 'invoice',
  `file_path` varchar(255) DEFAULT NULL,
  `generated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `invoice_number` (`invoice_number`),
  KEY `booking_id` (`booking_id`),
  CONSTRAINT `invoices_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoices`
--

LOCK TABLES `invoices` WRITE;
/*!40000 ALTER TABLE `invoices` DISABLE KEYS */;
/*!40000 ALTER TABLE `invoices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `type` enum('info','success','warning','error') DEFAULT 'info',
  `is_read` tinyint(1) DEFAULT 0,
  `related_id` int(11) DEFAULT NULL,
  `related_type` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `idx_read` (`is_read`),
  CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` VALUES (2,2,'Selamat Datang!','Terima kasih telah mendaftar di Zhafirah Umroh & Haji. Silakan login untuk melihat paket umroh dan haji kami.','success',1,NULL,NULL,'2025-11-06 03:20:31'),(3,2,'Pemesanan Berhasil','Pemesanan Anda dengan kode BKZSNJXJ9ECR telah dibuat. Silakan lakukan pembayaran sebelum 09 November 2025 10:38 WIB','success',1,8,'booking','2025-11-08 03:38:32'),(4,2,'Pemesanan Berhasil','Pemesanan Anda dengan kode BKEDE315N3GA telah dibuat. Silakan lakukan pembayaran sebelum 09 November 2025 10:45 WIB','success',1,9,'booking','2025-11-08 03:45:12'),(5,2,'Pemesanan Berhasil','Pemesanan Anda dengan kode BKO1YDH1NUU4 telah dibuat. Silakan lakukan pembayaran sebelum 09 November 2025 10:51 WIB','success',1,10,'booking','2025-11-08 03:51:36'),(6,3,'Selamat Datang!','Terima kasih telah mendaftar di Zhafirah Umroh & Haji. Silakan login untuk melihat paket umroh dan haji kami.','success',1,NULL,NULL,'2025-11-08 06:41:08'),(7,3,'Profil Dilengkapi','Profil Anda telah berhasil dilengkapi. Sekarang Anda dapat menerima notifikasi melalui email dan WhatsApp.','success',1,NULL,NULL,'2025-11-08 06:42:03'),(8,3,'Pemesanan Berhasil','Pemesanan Anda dengan kode BKSMM1YRQ7TB telah dibuat. Silakan lakukan pembayaran sebelum 09 November 2025 13:43 WIB','success',0,12,'booking','2025-11-08 06:43:43'),(9,3,'Pemesanan Berhasil','Pemesanan Anda dengan kode BKZ66PAJT0GC telah dibuat. Silakan lakukan pembayaran sebelum 09 November 2025 14:34 WIB','success',0,14,'booking','2025-11-08 07:34:30'),(10,3,'Pemesanan Berhasil','Pemesanan Anda dengan kode BKKDF9VK9LAX telah dibuat. Silakan lakukan pembayaran sebelum 09 November 2025 14:47 WIB','success',0,15,'booking','2025-11-08 07:47:42'),(11,3,'Pemesanan Berhasil','Pemesanan Anda dengan kode BKPL26AN82GG telah dibuat. Silakan lakukan pembayaran sebelum 09 November 2025 14:49 WIB','success',0,16,'booking','2025-11-08 07:49:35'),(12,2,'Pemesanan Berhasil','Pemesanan Anda dengan kode BKQ1PSF85044 telah dibuat. Silakan lakukan pembayaran sebelum 09 November 2025 15:09 WIB','success',0,17,'booking','2025-11-08 08:09:57'),(13,2,'Pemesanan Berhasil','Pemesanan Anda dengan kode BK5V4SWEFQQA telah dibuat. Silakan lakukan pembayaran sebelum 09 November 2025 15:27 WIB','success',0,18,'booking','2025-11-08 08:27:42'),(14,2,'Pemesanan Berhasil','Pemesanan Anda dengan kode BKWQP22XRX5V telah dibuat. Silakan lakukan pembayaran sebelum 09 November 2025 15:34 WIB','success',0,19,'booking','2025-11-08 08:34:57'),(15,2,'Pemesanan Berhasil','Pemesanan Anda dengan kode BK1L58AT98I7 telah dibuat. Silakan lakukan pembayaran sebelum 09 November 2025 16:19 WIB','success',0,21,'booking','2025-11-08 09:19:30'),(16,2,'Pemesanan Berhasil','Pemesanan Anda dengan kode BK4LP6ZA4SN9 telah dibuat. Silakan lakukan pembayaran sebelum 09 November 2025 16:21 WIB','success',0,22,'booking','2025-11-08 09:21:02'),(17,3,'Pemesanan Berhasil','Pemesanan Anda dengan kode BKB3103W3QZV telah dibuat. Silakan lakukan pembayaran sebelum 17 November 2025 10:30 WIB','success',0,25,'booking','2025-11-16 03:30:18');
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `packages`
--

DROP TABLE IF EXISTS `packages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `packages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `package_code` varchar(50) NOT NULL,
  `package_name` varchar(255) NOT NULL,
  `package_type` enum('umroh','haji') NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(15,2) NOT NULL,
  `duration_days` int(11) NOT NULL,
  `departure_date` date DEFAULT NULL,
  `quota` int(11) DEFAULT 45,
  `remaining_quota` int(11) DEFAULT 45,
  `includes` text DEFAULT NULL,
  `excludes` text DEFAULT NULL,
  `itinerary` text DEFAULT NULL,
  `hotel_makkah` varchar(255) DEFAULT NULL,
  `hotel_madinah` varchar(255) DEFAULT NULL,
  `airline` varchar(100) DEFAULT NULL,
  `status` enum('active','inactive','full') DEFAULT 'active',
  `featured` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `package_code` (`package_code`),
  KEY `idx_type` (`package_type`),
  KEY `idx_status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `packages`
--

LOCK TABLES `packages` WRITE;
/*!40000 ALTER TABLE `packages` DISABLE KEYS */;
INSERT INTO `packages` VALUES (1,'UMR-2025-001','Paket Umroh Ramadhan 2025','umroh','Paket Umroh spesial Ramadhan dengan fasilitas lengkap dan hotel bintang 5',35000000.00,12,'2025-03-15',45,38,'Tiket pesawat PP, Hotel bintang 5, Makan 3x sehari, Visa, Perlengkapan umroh, Tour guide berpengalaman, Ziarah kota Makkah & Madinah, Asuransi perjalanan','Keperluan pribadi, Suntik meningitis, Kelebihan bagasi',NULL,'Hotel Swissotel Makkah (200m dari Masjidil Haram)','Hotel Pullman Madinah (100m dari Masjid Nabawi)','Saudia Airlines','active',1,'2025-11-04 04:36:22','2025-11-08 09:21:01'),(2,'UMR-2025-002','Paket Umroh Ekonomis','umroh','Paket Umroh ekonomis dengan fasilitas lengkap',25000000.00,9,'2025-04-01',45,41,'Tiket pesawat PP, Hotel bintang 4, Makan 3x sehari, Visa, Perlengkapan umroh, Tour guide, Ziarah, Asuransi','Keperluan pribadi, Suntik meningitis, Kelebihan bagasi',NULL,'Hotel Hilton Makkah (500m dari Masjidil Haram)','Hotel Millennium Madinah (300m dari Masjid Nabawi)','Garuda Indonesia','active',0,'2025-11-04 04:36:22','2025-11-16 03:30:17'),(3,'HAJI-2025-001','Paket Haji Reguler 2025','haji','Paket Haji Reguler dengan fasilitas standar pemerintah',65000000.00,40,'2025-06-10',45,43,'Tiket pesawat PP, Akomodasi di Makkah & Madinah, Makan 3x sehari, Visa haji, Perlengkapan haji lengkap, Pembimbing ibadah, Handling di Arab Saudi, Asuransi','Keperluan pribadi, Kelebihan bagasi',NULL,'Hotel/Apartemen sesuai ketentuan','Hotel/Apartemen sesuai ketentuan','Saudia Airlines','active',1,'2025-11-04 04:36:22','2025-11-08 06:43:42');
/*!40000 ALTER TABLE `packages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `booking_id` int(11) NOT NULL,
  `invoice_id` varchar(255) NOT NULL,
  `external_id` varchar(255) NOT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `payment_channel` varchar(100) DEFAULT NULL,
  `amount` decimal(15,2) NOT NULL,
  `paid_amount` decimal(15,2) DEFAULT NULL,
  `status` enum('pending','paid','expired','failed') DEFAULT 'pending',
  `xendit_invoice_url` text DEFAULT NULL,
  `paid_at` datetime DEFAULT NULL,
  `expired_at` datetime DEFAULT NULL,
  `xendit_response` text DEFAULT NULL,
  `callback_data` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `invoice_id` (`invoice_id`),
  UNIQUE KEY `external_id` (`external_id`),
  KEY `booking_id` (`booking_id`),
  KEY `idx_status` (`status`),
  CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
INSERT INTO `payments` VALUES (1,8,'690ebb388b4ca8dceb68fe6b','BK-1762573111-2',NULL,NULL,35000000.00,NULL,'pending','https://checkout-staging.xendit.co/web/690ebb388b4ca8dceb68fe6b',NULL,'2025-11-09 03:38:32','{\"id\":\"690ebb388b4ca8dceb68fe6b\",\"external_id\":\"BK-1762573111-2\",\"user_id\":\"69073e799ff58e2a7be2137f\",\"status\":\"PENDING\",\"merchant_name\":\"Zhafirah Umroh\",\"merchant_profile_picture_url\":\"https:\\/\\/du8nwjtfkinx.cloudfront.net\\/xendit.png\",\"amount\":35000000,\"payer_email\":\"marfinohamzah455@gmail.com\",\"description\":\"Pembayaran Paket Umroh Ramadhan 2025 - BKZSNJXJ9ECR\",\"expiry_date\":\"2025-11-09T03:38:32.649Z\",\"invoice_url\":\"https:\\/\\/checkout-staging.xendit.co\\/web\\/690ebb388b4ca8dceb68fe6b\",\"available_banks\":[{\"bank_code\":\"BRI\",\"collection_type\":\"POOL\",\"transfer_amount\":35000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"CIMB\",\"collection_type\":\"POOL\",\"transfer_amount\":35000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"MANDIRI\",\"collection_type\":\"POOL\",\"transfer_amount\":35000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"BSI\",\"collection_type\":\"POOL\",\"transfer_amount\":35000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"MUAMALAT\",\"collection_type\":\"POOL\",\"transfer_amount\":35000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"BNI\",\"collection_type\":\"POOL\",\"transfer_amount\":35000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"SAHABAT_SAMPOERNA\",\"collection_type\":\"POOL\",\"transfer_amount\":35000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"BNC\",\"collection_type\":\"POOL\",\"transfer_amount\":35000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"BCA\",\"collection_type\":\"POOL\",\"transfer_amount\":35000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"PERMATA\",\"collection_type\":\"POOL\",\"transfer_amount\":35000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"BJB\",\"collection_type\":\"POOL\",\"transfer_amount\":35000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0}],\"available_retail_outlets\":[{\"retail_outlet_name\":\"INDOMARET\"},{\"retail_outlet_name\":\"ALFAMART\"}],\"available_ewallets\":[{\"ewallet_type\":\"SHOPEEPAY\"},{\"ewallet_type\":\"ASTRAPAY\"},{\"ewallet_type\":\"JENIUSPAY\"},{\"ewallet_type\":\"DANA\"},{\"ewallet_type\":\"LINKAJA\"},{\"ewallet_type\":\"OVO\"},{\"ewallet_type\":\"NEXCASH\"},{\"ewallet_type\":\"GOPAY\"}],\"available_qr_codes\":[{\"qr_code_type\":\"QRIS\"}],\"available_direct_debits\":[{\"direct_debit_type\":\"DD_BRI\"},{\"direct_debit_type\":\"DD_MANDIRI\"}],\"available_paylaters\":[{\"paylater_type\":\"KREDIVO\"},{\"paylater_type\":\"AKULAKU\"},{\"paylater_type\":\"ATOME\"}],\"should_exclude_credit_card\":false,\"should_send_email\":false,\"success_redirect_url\":\"http:\\/\\/zhafirah_umroh_system.test\\/umroh-system\\/portal\\/booking-success.php?booking_id=8\",\"failure_redirect_url\":\"http:\\/\\/zhafirah_umroh_system.test\\/umroh-system\\/portal\\/booking-detail.php?id=8\",\"created\":\"2025-11-08T03:38:32.786Z\",\"updated\":\"2025-11-08T03:38:32.786Z\",\"currency\":\"IDR\",\"items\":[{\"name\":\"Paket Umroh Ramadhan 2025\",\"quantity\":1,\"price\":35000000,\"category\":\"umroh\"}],\"customer\":{\"given_names\":\"MARFINO HAMZAH\",\"email\":\"marfinohamzah455@gmail.com\"},\"metadata\":null}',NULL,'2025-11-08 03:38:32','2025-11-08 03:38:32'),(2,9,'690ebcc88b4ca8dceb68ff34','BK-1762573511-2',NULL,NULL,35000000.00,NULL,'pending','https://checkout-staging.xendit.co/web/690ebcc88b4ca8dceb68ff34',NULL,'2025-11-09 03:45:12','{\"id\":\"690ebcc88b4ca8dceb68ff34\",\"external_id\":\"BK-1762573511-2\",\"user_id\":\"69073e799ff58e2a7be2137f\",\"status\":\"PENDING\",\"merchant_name\":\"Zhafirah Umroh\",\"merchant_profile_picture_url\":\"https:\\/\\/du8nwjtfkinx.cloudfront.net\\/xendit.png\",\"amount\":35000000,\"payer_email\":\"marfinohamzah455@gmail.com\",\"description\":\"Pembayaran Paket Umroh Ramadhan 2025 - BKEDE315N3GA\",\"expiry_date\":\"2025-11-09T03:45:12.255Z\",\"invoice_url\":\"https:\\/\\/checkout-staging.xendit.co\\/web\\/690ebcc88b4ca8dceb68ff34\",\"available_banks\":[{\"bank_code\":\"BRI\",\"collection_type\":\"POOL\",\"transfer_amount\":35000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"CIMB\",\"collection_type\":\"POOL\",\"transfer_amount\":35000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"MANDIRI\",\"collection_type\":\"POOL\",\"transfer_amount\":35000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"BSI\",\"collection_type\":\"POOL\",\"transfer_amount\":35000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"MUAMALAT\",\"collection_type\":\"POOL\",\"transfer_amount\":35000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"BNI\",\"collection_type\":\"POOL\",\"transfer_amount\":35000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"SAHABAT_SAMPOERNA\",\"collection_type\":\"POOL\",\"transfer_amount\":35000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"BNC\",\"collection_type\":\"POOL\",\"transfer_amount\":35000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"BCA\",\"collection_type\":\"POOL\",\"transfer_amount\":35000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"PERMATA\",\"collection_type\":\"POOL\",\"transfer_amount\":35000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"BJB\",\"collection_type\":\"POOL\",\"transfer_amount\":35000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0}],\"available_retail_outlets\":[{\"retail_outlet_name\":\"INDOMARET\"},{\"retail_outlet_name\":\"ALFAMART\"}],\"available_ewallets\":[{\"ewallet_type\":\"SHOPEEPAY\"},{\"ewallet_type\":\"ASTRAPAY\"},{\"ewallet_type\":\"JENIUSPAY\"},{\"ewallet_type\":\"DANA\"},{\"ewallet_type\":\"LINKAJA\"},{\"ewallet_type\":\"OVO\"},{\"ewallet_type\":\"NEXCASH\"},{\"ewallet_type\":\"GOPAY\"}],\"available_qr_codes\":[{\"qr_code_type\":\"QRIS\"}],\"available_direct_debits\":[{\"direct_debit_type\":\"DD_BRI\"},{\"direct_debit_type\":\"DD_MANDIRI\"}],\"available_paylaters\":[{\"paylater_type\":\"KREDIVO\"},{\"paylater_type\":\"AKULAKU\"},{\"paylater_type\":\"ATOME\"}],\"should_exclude_credit_card\":false,\"should_send_email\":false,\"success_redirect_url\":\"http:\\/\\/zhafirah_umroh_system.test\\/portal\\/booking-success.php?booking_id=9\",\"failure_redirect_url\":\"http:\\/\\/zhafirah_umroh_system.test\\/portal\\/booking-detail.php?id=9\",\"created\":\"2025-11-08T03:45:12.348Z\",\"updated\":\"2025-11-08T03:45:12.348Z\",\"currency\":\"IDR\",\"items\":[{\"name\":\"Paket Umroh Ramadhan 2025\",\"quantity\":1,\"price\":35000000,\"category\":\"umroh\"}],\"customer\":{\"given_names\":\"MARFINO HAMZAH\",\"email\":\"marfinohamzah455@gmail.com\"},\"metadata\":null}',NULL,'2025-11-08 03:45:12','2025-11-08 03:45:12'),(3,10,'690ebe486b8eaa2d555712ca','BK-1762573895-2',NULL,NULL,65000000.00,NULL,'paid','https://checkout-staging.xendit.co/web/690ebe486b8eaa2d555712ca','2025-11-08 10:58:28','2025-11-09 03:51:36','{\"id\":\"690ebe486b8eaa2d555712ca\",\"external_id\":\"BK-1762573895-2\",\"user_id\":\"69073e799ff58e2a7be2137f\",\"status\":\"PENDING\",\"merchant_name\":\"Zhafirah Umroh\",\"merchant_profile_picture_url\":\"https:\\/\\/du8nwjtfkinx.cloudfront.net\\/xendit.png\",\"amount\":65000000,\"payer_email\":\"marfinohamzah455@gmail.com\",\"description\":\"Pembayaran Paket Haji Reguler 2025 - BKO1YDH1NUU4\",\"expiry_date\":\"2025-11-09T03:51:36.443Z\",\"invoice_url\":\"https:\\/\\/checkout-staging.xendit.co\\/web\\/690ebe486b8eaa2d555712ca\",\"available_banks\":[{\"bank_code\":\"CIMB\",\"collection_type\":\"POOL\",\"transfer_amount\":65000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"BNC\",\"collection_type\":\"POOL\",\"transfer_amount\":65000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"SAHABAT_SAMPOERNA\",\"collection_type\":\"POOL\",\"transfer_amount\":65000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"BSI\",\"collection_type\":\"POOL\",\"transfer_amount\":65000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"PERMATA\",\"collection_type\":\"POOL\",\"transfer_amount\":65000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"MANDIRI\",\"collection_type\":\"POOL\",\"transfer_amount\":65000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"BCA\",\"collection_type\":\"POOL\",\"transfer_amount\":65000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"MUAMALAT\",\"collection_type\":\"POOL\",\"transfer_amount\":65000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"BNI\",\"collection_type\":\"POOL\",\"transfer_amount\":65000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"BJB\",\"collection_type\":\"POOL\",\"transfer_amount\":65000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"BRI\",\"collection_type\":\"POOL\",\"transfer_amount\":65000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0}],\"available_retail_outlets\":[{\"retail_outlet_name\":\"INDOMARET\"},{\"retail_outlet_name\":\"ALFAMART\"}],\"available_ewallets\":[{\"ewallet_type\":\"SHOPEEPAY\"},{\"ewallet_type\":\"ASTRAPAY\"},{\"ewallet_type\":\"JENIUSPAY\"},{\"ewallet_type\":\"DANA\"},{\"ewallet_type\":\"LINKAJA\"},{\"ewallet_type\":\"OVO\"},{\"ewallet_type\":\"NEXCASH\"},{\"ewallet_type\":\"GOPAY\"}],\"available_qr_codes\":[{\"qr_code_type\":\"QRIS\"}],\"available_direct_debits\":[{\"direct_debit_type\":\"DD_BRI\"},{\"direct_debit_type\":\"DD_MANDIRI\"}],\"available_paylaters\":[{\"paylater_type\":\"KREDIVO\"},{\"paylater_type\":\"AKULAKU\"},{\"paylater_type\":\"ATOME\"}],\"should_exclude_credit_card\":false,\"should_send_email\":false,\"success_redirect_url\":\"http:\\/\\/zhafirah_umroh_system.test\\/portal\\/booking-success.php?booking_id=10\",\"failure_redirect_url\":\"http:\\/\\/zhafirah_umroh_system.test\\/portal\\/booking-detail.php?id=10\",\"created\":\"2025-11-08T03:51:36.630Z\",\"updated\":\"2025-11-08T03:51:36.630Z\",\"currency\":\"IDR\",\"items\":[{\"name\":\"Paket Haji Reguler 2025\",\"quantity\":1,\"price\":65000000,\"category\":\"haji\"}],\"customer\":{\"given_names\":\"MARFINO HAMZAH\",\"email\":\"marfinohamzah455@gmail.com\"},\"metadata\":null}',NULL,'2025-11-08 03:51:36','2025-11-08 03:58:28'),(4,12,'690ee69f6b8eaa2d5557255b','BK-1762584222-3',NULL,NULL,65000000.00,NULL,'paid','https://checkout-staging.xendit.co/web/690ee69f6b8eaa2d5557255b','2025-11-08 13:44:28','2025-11-09 06:43:43','{\"id\":\"690ee69f6b8eaa2d5557255b\",\"external_id\":\"BK-1762584222-3\",\"user_id\":\"69073e799ff58e2a7be2137f\",\"status\":\"PENDING\",\"merchant_name\":\"Zhafirah Umroh\",\"merchant_profile_picture_url\":\"https:\\/\\/du8nwjtfkinx.cloudfront.net\\/xendit.png\",\"amount\":65000000,\"payer_email\":\"marfino29@gmail.com\",\"description\":\"Pembayaran Paket Haji Reguler 2025 - BKSMM1YRQ7TB\",\"expiry_date\":\"2025-11-09T06:43:43.515Z\",\"invoice_url\":\"https:\\/\\/checkout-staging.xendit.co\\/web\\/690ee69f6b8eaa2d5557255b\",\"available_banks\":[{\"bank_code\":\"BSI\",\"collection_type\":\"POOL\",\"transfer_amount\":65000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"BNC\",\"collection_type\":\"POOL\",\"transfer_amount\":65000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"MANDIRI\",\"collection_type\":\"POOL\",\"transfer_amount\":65000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"CIMB\",\"collection_type\":\"POOL\",\"transfer_amount\":65000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"SAHABAT_SAMPOERNA\",\"collection_type\":\"POOL\",\"transfer_amount\":65000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"BNI\",\"collection_type\":\"POOL\",\"transfer_amount\":65000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"PERMATA\",\"collection_type\":\"POOL\",\"transfer_amount\":65000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"BJB\",\"collection_type\":\"POOL\",\"transfer_amount\":65000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"BCA\",\"collection_type\":\"POOL\",\"transfer_amount\":65000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"BRI\",\"collection_type\":\"POOL\",\"transfer_amount\":65000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"MUAMALAT\",\"collection_type\":\"POOL\",\"transfer_amount\":65000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0}],\"available_retail_outlets\":[{\"retail_outlet_name\":\"INDOMARET\"},{\"retail_outlet_name\":\"ALFAMART\"}],\"available_ewallets\":[{\"ewallet_type\":\"SHOPEEPAY\"},{\"ewallet_type\":\"ASTRAPAY\"},{\"ewallet_type\":\"JENIUSPAY\"},{\"ewallet_type\":\"DANA\"},{\"ewallet_type\":\"LINKAJA\"},{\"ewallet_type\":\"OVO\"},{\"ewallet_type\":\"NEXCASH\"},{\"ewallet_type\":\"GOPAY\"}],\"available_qr_codes\":[{\"qr_code_type\":\"QRIS\"}],\"available_direct_debits\":[{\"direct_debit_type\":\"DD_BRI\"},{\"direct_debit_type\":\"DD_MANDIRI\"}],\"available_paylaters\":[{\"paylater_type\":\"KREDIVO\"},{\"paylater_type\":\"AKULAKU\"},{\"paylater_type\":\"ATOME\"}],\"should_exclude_credit_card\":false,\"should_send_email\":false,\"success_redirect_url\":\"http:\\/\\/zhafirah_umroh_system.test\\/portal\\/booking-success.php?booking_id=12\",\"failure_redirect_url\":\"http:\\/\\/zhafirah_umroh_system.test\\/portal\\/booking-detail.php?id=12\",\"created\":\"2025-11-08T06:43:43.762Z\",\"updated\":\"2025-11-08T06:43:43.762Z\",\"currency\":\"IDR\",\"items\":[{\"name\":\"Paket Haji Reguler 2025\",\"quantity\":1,\"price\":65000000,\"category\":\"haji\"}],\"customer\":{\"given_names\":\"Rio Hakim\",\"email\":\"marfino29@gmail.com\"},\"metadata\":null}',NULL,'2025-11-08 06:43:43','2025-11-08 06:44:28'),(5,14,'690ef2856b8eaa2d55572b7b','BK-1762587269-3',NULL,NULL,35000000.00,NULL,'paid','https://checkout-staging.xendit.co/web/690ef2856b8eaa2d55572b7b','2025-11-08 14:34:45','2025-11-09 07:34:30','{\"id\":\"690ef2856b8eaa2d55572b7b\",\"external_id\":\"BK-1762587269-3\",\"user_id\":\"69073e799ff58e2a7be2137f\",\"status\":\"PENDING\",\"merchant_name\":\"Zhafirah Umroh\",\"merchant_profile_picture_url\":\"https:\\/\\/du8nwjtfkinx.cloudfront.net\\/xendit.png\",\"amount\":35000000,\"payer_email\":\"marfino29@gmail.com\",\"description\":\"Pembayaran Paket Umroh Ramadhan 2025 - BKZ66PAJT0GC\",\"expiry_date\":\"2025-11-09T07:34:30.039Z\",\"invoice_url\":\"https:\\/\\/checkout-staging.xendit.co\\/web\\/690ef2856b8eaa2d55572b7b\",\"available_banks\":[{\"bank_code\":\"BRI\",\"collection_type\":\"POOL\",\"transfer_amount\":35000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"SAHABAT_SAMPOERNA\",\"collection_type\":\"POOL\",\"transfer_amount\":35000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"MUAMALAT\",\"collection_type\":\"POOL\",\"transfer_amount\":35000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"CIMB\",\"collection_type\":\"POOL\",\"transfer_amount\":35000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"MANDIRI\",\"collection_type\":\"POOL\",\"transfer_amount\":35000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"PERMATA\",\"collection_type\":\"POOL\",\"transfer_amount\":35000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"BCA\",\"collection_type\":\"POOL\",\"transfer_amount\":35000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"BNI\",\"collection_type\":\"POOL\",\"transfer_amount\":35000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"BSI\",\"collection_type\":\"POOL\",\"transfer_amount\":35000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"BNC\",\"collection_type\":\"POOL\",\"transfer_amount\":35000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"BJB\",\"collection_type\":\"POOL\",\"transfer_amount\":35000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0}],\"available_retail_outlets\":[{\"retail_outlet_name\":\"INDOMARET\"},{\"retail_outlet_name\":\"ALFAMART\"}],\"available_ewallets\":[{\"ewallet_type\":\"SHOPEEPAY\"},{\"ewallet_type\":\"ASTRAPAY\"},{\"ewallet_type\":\"JENIUSPAY\"},{\"ewallet_type\":\"DANA\"},{\"ewallet_type\":\"LINKAJA\"},{\"ewallet_type\":\"OVO\"},{\"ewallet_type\":\"NEXCASH\"},{\"ewallet_type\":\"GOPAY\"}],\"available_qr_codes\":[{\"qr_code_type\":\"QRIS\"}],\"available_direct_debits\":[{\"direct_debit_type\":\"DD_BRI\"},{\"direct_debit_type\":\"DD_MANDIRI\"}],\"available_paylaters\":[{\"paylater_type\":\"KREDIVO\"},{\"paylater_type\":\"AKULAKU\"},{\"paylater_type\":\"ATOME\"}],\"should_exclude_credit_card\":false,\"should_send_email\":false,\"success_redirect_url\":\"http:\\/\\/zhafirah_umroh_system.test\\/portal\\/booking-success.php?booking_id=14\",\"failure_redirect_url\":\"http:\\/\\/zhafirah_umroh_system.test\\/portal\\/booking-detail.php?id=14\",\"created\":\"2025-11-08T07:34:30.163Z\",\"updated\":\"2025-11-08T07:34:30.163Z\",\"currency\":\"IDR\",\"items\":[{\"name\":\"Paket Umroh Ramadhan 2025\",\"quantity\":1,\"price\":35000000,\"category\":\"umroh\"}],\"customer\":{\"given_names\":\"Rio Hakim\",\"email\":\"marfino29@gmail.com\"},\"metadata\":null}',NULL,'2025-11-08 07:34:30','2025-11-08 07:34:45'),(6,15,'690ef59e6b8eaa2d55572cfb','BK-1762588061-3',NULL,NULL,35000000.00,NULL,'paid','https://checkout-staging.xendit.co/web/690ef59e6b8eaa2d55572cfb','2025-11-08 14:48:47','2025-11-09 07:47:42','{\"id\":\"690ef59e6b8eaa2d55572cfb\",\"external_id\":\"BK-1762588061-3\",\"user_id\":\"69073e799ff58e2a7be2137f\",\"status\":\"PENDING\",\"merchant_name\":\"Zhafirah Umroh\",\"merchant_profile_picture_url\":\"https:\\/\\/du8nwjtfkinx.cloudfront.net\\/xendit.png\",\"amount\":35000000,\"payer_email\":\"marfino29@gmail.com\",\"description\":\"Pembayaran Paket Umroh Ramadhan 2025 - BKKDF9VK9LAX\",\"expiry_date\":\"2025-11-09T07:47:42.463Z\",\"invoice_url\":\"https:\\/\\/checkout-staging.xendit.co\\/web\\/690ef59e6b8eaa2d55572cfb\",\"available_banks\":[{\"bank_code\":\"BRI\",\"collection_type\":\"POOL\",\"transfer_amount\":35000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"SAHABAT_SAMPOERNA\",\"collection_type\":\"POOL\",\"transfer_amount\":35000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"MUAMALAT\",\"collection_type\":\"POOL\",\"transfer_amount\":35000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"CIMB\",\"collection_type\":\"POOL\",\"transfer_amount\":35000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"MANDIRI\",\"collection_type\":\"POOL\",\"transfer_amount\":35000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"PERMATA\",\"collection_type\":\"POOL\",\"transfer_amount\":35000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"BCA\",\"collection_type\":\"POOL\",\"transfer_amount\":35000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"BNI\",\"collection_type\":\"POOL\",\"transfer_amount\":35000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"BSI\",\"collection_type\":\"POOL\",\"transfer_amount\":35000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"BNC\",\"collection_type\":\"POOL\",\"transfer_amount\":35000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"BJB\",\"collection_type\":\"POOL\",\"transfer_amount\":35000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0}],\"available_retail_outlets\":[{\"retail_outlet_name\":\"INDOMARET\"},{\"retail_outlet_name\":\"ALFAMART\"}],\"available_ewallets\":[{\"ewallet_type\":\"SHOPEEPAY\"},{\"ewallet_type\":\"ASTRAPAY\"},{\"ewallet_type\":\"JENIUSPAY\"},{\"ewallet_type\":\"DANA\"},{\"ewallet_type\":\"LINKAJA\"},{\"ewallet_type\":\"OVO\"},{\"ewallet_type\":\"NEXCASH\"},{\"ewallet_type\":\"GOPAY\"}],\"available_qr_codes\":[{\"qr_code_type\":\"QRIS\"}],\"available_direct_debits\":[{\"direct_debit_type\":\"DD_BRI\"},{\"direct_debit_type\":\"DD_MANDIRI\"}],\"available_paylaters\":[{\"paylater_type\":\"KREDIVO\"},{\"paylater_type\":\"AKULAKU\"},{\"paylater_type\":\"ATOME\"}],\"should_exclude_credit_card\":false,\"should_send_email\":false,\"success_redirect_url\":\"http:\\/\\/zhafirah_umroh_system.test\\/portal\\/booking-success.php?booking_id=15\",\"failure_redirect_url\":\"http:\\/\\/zhafirah_umroh_system.test\\/portal\\/booking-detail.php?id=15\",\"created\":\"2025-11-08T07:47:42.611Z\",\"updated\":\"2025-11-08T07:47:42.611Z\",\"currency\":\"IDR\",\"items\":[{\"name\":\"Paket Umroh Ramadhan 2025\",\"quantity\":1,\"price\":35000000,\"category\":\"umroh\"}],\"customer\":{\"given_names\":\"Rio Hakim\",\"email\":\"marfino29@gmail.com\"},\"metadata\":null}',NULL,'2025-11-08 07:47:42','2025-11-08 07:48:47'),(7,16,'690ef60e6b8eaa2d55572d2d','BK-1762588174-3',NULL,NULL,25000000.00,NULL,'paid','https://checkout-staging.xendit.co/web/690ef60e6b8eaa2d55572d2d','2025-11-08 14:49:50','2025-11-09 07:49:34','{\"id\":\"690ef60e6b8eaa2d55572d2d\",\"external_id\":\"BK-1762588174-3\",\"user_id\":\"69073e799ff58e2a7be2137f\",\"status\":\"PENDING\",\"merchant_name\":\"Zhafirah Umroh\",\"merchant_profile_picture_url\":\"https:\\/\\/du8nwjtfkinx.cloudfront.net\\/xendit.png\",\"amount\":25000000,\"payer_email\":\"marfino29@gmail.com\",\"description\":\"Pembayaran Paket Umroh Ekonomis - BKPL26AN82GG\",\"expiry_date\":\"2025-11-09T07:49:34.979Z\",\"invoice_url\":\"https:\\/\\/checkout-staging.xendit.co\\/web\\/690ef60e6b8eaa2d55572d2d\",\"available_banks\":[{\"bank_code\":\"MANDIRI\",\"collection_type\":\"POOL\",\"transfer_amount\":25000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"BCA\",\"collection_type\":\"POOL\",\"transfer_amount\":25000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"BNC\",\"collection_type\":\"POOL\",\"transfer_amount\":25000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"SAHABAT_SAMPOERNA\",\"collection_type\":\"POOL\",\"transfer_amount\":25000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"PERMATA\",\"collection_type\":\"POOL\",\"transfer_amount\":25000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"BNI\",\"collection_type\":\"POOL\",\"transfer_amount\":25000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"CIMB\",\"collection_type\":\"POOL\",\"transfer_amount\":25000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"BSI\",\"collection_type\":\"POOL\",\"transfer_amount\":25000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"MUAMALAT\",\"collection_type\":\"POOL\",\"transfer_amount\":25000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"BRI\",\"collection_type\":\"POOL\",\"transfer_amount\":25000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"BJB\",\"collection_type\":\"POOL\",\"transfer_amount\":25000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0}],\"available_retail_outlets\":[{\"retail_outlet_name\":\"INDOMARET\"},{\"retail_outlet_name\":\"ALFAMART\"}],\"available_ewallets\":[{\"ewallet_type\":\"SHOPEEPAY\"},{\"ewallet_type\":\"ASTRAPAY\"},{\"ewallet_type\":\"JENIUSPAY\"},{\"ewallet_type\":\"DANA\"},{\"ewallet_type\":\"LINKAJA\"},{\"ewallet_type\":\"OVO\"},{\"ewallet_type\":\"NEXCASH\"},{\"ewallet_type\":\"GOPAY\"}],\"available_qr_codes\":[{\"qr_code_type\":\"QRIS\"}],\"available_direct_debits\":[{\"direct_debit_type\":\"DD_BRI\"},{\"direct_debit_type\":\"DD_MANDIRI\"}],\"available_paylaters\":[{\"paylater_type\":\"KREDIVO\"},{\"paylater_type\":\"AKULAKU\"},{\"paylater_type\":\"ATOME\"}],\"should_exclude_credit_card\":false,\"should_send_email\":false,\"success_redirect_url\":\"http:\\/\\/zhafirah_umroh_system.test\\/portal\\/booking-success.php?booking_id=16\",\"failure_redirect_url\":\"http:\\/\\/zhafirah_umroh_system.test\\/portal\\/booking-detail.php?id=16\",\"created\":\"2025-11-08T07:49:35.165Z\",\"updated\":\"2025-11-08T07:49:35.165Z\",\"currency\":\"IDR\",\"items\":[{\"name\":\"Paket Umroh Ekonomis\",\"quantity\":1,\"price\":25000000,\"category\":\"umroh\"}],\"customer\":{\"given_names\":\"Rio Hakim\",\"email\":\"marfino29@gmail.com\"},\"metadata\":null}',NULL,'2025-11-08 07:49:35','2025-11-08 07:49:50'),(8,17,'690efad46b8eaa2d55573014','BK-1762589396-2',NULL,NULL,35000000.00,NULL,'paid','https://checkout-staging.xendit.co/web/690efad46b8eaa2d55573014','2025-11-08 15:10:12','2025-11-09 08:09:56','{\"id\":\"690efad46b8eaa2d55573014\",\"external_id\":\"BK-1762589396-2\",\"user_id\":\"69073e799ff58e2a7be2137f\",\"status\":\"PENDING\",\"merchant_name\":\"Zhafirah Umroh\",\"merchant_profile_picture_url\":\"https:\\/\\/du8nwjtfkinx.cloudfront.net\\/xendit.png\",\"amount\":35000000,\"payer_email\":\"marfinohamzah455@gmail.com\",\"description\":\"Pembayaran Paket Umroh Ramadhan 2025 - BKQ1PSF85044\",\"expiry_date\":\"2025-11-09T08:09:56.666Z\",\"invoice_url\":\"https:\\/\\/checkout-staging.xendit.co\\/web\\/690efad46b8eaa2d55573014\",\"available_banks\":[{\"bank_code\":\"BCA\",\"collection_type\":\"POOL\",\"transfer_amount\":35000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"MUAMALAT\",\"collection_type\":\"POOL\",\"transfer_amount\":35000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"BSI\",\"collection_type\":\"POOL\",\"transfer_amount\":35000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"MANDIRI\",\"collection_type\":\"POOL\",\"transfer_amount\":35000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"CIMB\",\"collection_type\":\"POOL\",\"transfer_amount\":35000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"BNC\",\"collection_type\":\"POOL\",\"transfer_amount\":35000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"PERMATA\",\"collection_type\":\"POOL\",\"transfer_amount\":35000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"SAHABAT_SAMPOERNA\",\"collection_type\":\"POOL\",\"transfer_amount\":35000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"BRI\",\"collection_type\":\"POOL\",\"transfer_amount\":35000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"BNI\",\"collection_type\":\"POOL\",\"transfer_amount\":35000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"BJB\",\"collection_type\":\"POOL\",\"transfer_amount\":35000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0}],\"available_retail_outlets\":[{\"retail_outlet_name\":\"INDOMARET\"},{\"retail_outlet_name\":\"ALFAMART\"}],\"available_ewallets\":[{\"ewallet_type\":\"SHOPEEPAY\"},{\"ewallet_type\":\"ASTRAPAY\"},{\"ewallet_type\":\"JENIUSPAY\"},{\"ewallet_type\":\"DANA\"},{\"ewallet_type\":\"LINKAJA\"},{\"ewallet_type\":\"OVO\"},{\"ewallet_type\":\"NEXCASH\"},{\"ewallet_type\":\"GOPAY\"}],\"available_qr_codes\":[{\"qr_code_type\":\"QRIS\"}],\"available_direct_debits\":[{\"direct_debit_type\":\"DD_BRI\"},{\"direct_debit_type\":\"DD_MANDIRI\"}],\"available_paylaters\":[{\"paylater_type\":\"KREDIVO\"},{\"paylater_type\":\"AKULAKU\"},{\"paylater_type\":\"ATOME\"}],\"should_exclude_credit_card\":false,\"should_send_email\":false,\"success_redirect_url\":\"http:\\/\\/zhafirah_umroh_system.test\\/portal\\/booking-success.php?booking_id=17\",\"failure_redirect_url\":\"http:\\/\\/zhafirah_umroh_system.test\\/portal\\/booking-detail.php?id=17\",\"created\":\"2025-11-08T08:09:56.775Z\",\"updated\":\"2025-11-08T08:09:56.775Z\",\"currency\":\"IDR\",\"items\":[{\"name\":\"Paket Umroh Ramadhan 2025\",\"quantity\":1,\"price\":35000000,\"category\":\"umroh\"}],\"customer\":{\"given_names\":\"MARFINO HAMZAH\",\"email\":\"marfinohamzah455@gmail.com\"},\"metadata\":null}',NULL,'2025-11-08 08:09:57','2025-11-08 08:10:12'),(9,18,'690efefd8b4ca8dceb692227','BK-1762590460-2',NULL,NULL,35000000.00,NULL,'paid','https://checkout-staging.xendit.co/web/690efefd8b4ca8dceb692227','2025-11-08 15:27:57','2025-11-09 08:27:41','{\"id\":\"690efefd8b4ca8dceb692227\",\"external_id\":\"BK-1762590460-2\",\"user_id\":\"69073e799ff58e2a7be2137f\",\"status\":\"PENDING\",\"merchant_name\":\"Zhafirah Umroh\",\"merchant_profile_picture_url\":\"https:\\/\\/du8nwjtfkinx.cloudfront.net\\/xendit.png\",\"amount\":35000000,\"payer_email\":\"marfinohamzah455@gmail.com\",\"description\":\"Pembayaran Paket Umroh Ramadhan 2025 - BK5V4SWEFQQA\",\"expiry_date\":\"2025-11-09T08:27:41.523Z\",\"invoice_url\":\"https:\\/\\/checkout-staging.xendit.co\\/web\\/690efefd8b4ca8dceb692227\",\"available_banks\":[{\"bank_code\":\"BSI\",\"collection_type\":\"POOL\",\"transfer_amount\":35000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"BNC\",\"collection_type\":\"POOL\",\"transfer_amount\":35000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"BRI\",\"collection_type\":\"POOL\",\"transfer_amount\":35000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"MUAMALAT\",\"collection_type\":\"POOL\",\"transfer_amount\":35000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"SAHABAT_SAMPOERNA\",\"collection_type\":\"POOL\",\"transfer_amount\":35000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"MANDIRI\",\"collection_type\":\"POOL\",\"transfer_amount\":35000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"CIMB\",\"collection_type\":\"POOL\",\"transfer_amount\":35000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"BCA\",\"collection_type\":\"POOL\",\"transfer_amount\":35000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"BNI\",\"collection_type\":\"POOL\",\"transfer_amount\":35000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"PERMATA\",\"collection_type\":\"POOL\",\"transfer_amount\":35000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"BJB\",\"collection_type\":\"POOL\",\"transfer_amount\":35000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0}],\"available_retail_outlets\":[{\"retail_outlet_name\":\"INDOMARET\"},{\"retail_outlet_name\":\"ALFAMART\"}],\"available_ewallets\":[{\"ewallet_type\":\"SHOPEEPAY\"},{\"ewallet_type\":\"ASTRAPAY\"},{\"ewallet_type\":\"JENIUSPAY\"},{\"ewallet_type\":\"DANA\"},{\"ewallet_type\":\"LINKAJA\"},{\"ewallet_type\":\"OVO\"},{\"ewallet_type\":\"NEXCASH\"},{\"ewallet_type\":\"GOPAY\"}],\"available_qr_codes\":[{\"qr_code_type\":\"QRIS\"}],\"available_direct_debits\":[{\"direct_debit_type\":\"DD_BRI\"},{\"direct_debit_type\":\"DD_MANDIRI\"}],\"available_paylaters\":[{\"paylater_type\":\"KREDIVO\"},{\"paylater_type\":\"AKULAKU\"},{\"paylater_type\":\"ATOME\"}],\"should_exclude_credit_card\":false,\"should_send_email\":false,\"success_redirect_url\":\"http:\\/\\/zhafirah_umroh_system.test\\/portal\\/booking-success.php?booking_id=18\",\"failure_redirect_url\":\"http:\\/\\/zhafirah_umroh_system.test\\/portal\\/booking-detail.php?id=18\",\"created\":\"2025-11-08T08:27:41.745Z\",\"updated\":\"2025-11-08T08:27:41.745Z\",\"currency\":\"IDR\",\"items\":[{\"name\":\"Paket Umroh Ramadhan 2025\",\"quantity\":1,\"price\":35000000,\"category\":\"umroh\"}],\"customer\":{\"given_names\":\"MARFINO HAMZAH\",\"email\":\"marfinohamzah455@gmail.com\"},\"metadata\":null}',NULL,'2025-11-08 08:27:41','2025-11-08 08:27:57'),(10,19,'690f00b06b8eaa2d55573314','BK-1762590895-2',NULL,NULL,25000000.00,NULL,'paid','https://checkout-staging.xendit.co/web/690f00b06b8eaa2d55573314','2025-11-08 15:35:22','2025-11-09 08:34:56','{\"id\":\"690f00b06b8eaa2d55573314\",\"external_id\":\"BK-1762590895-2\",\"user_id\":\"69073e799ff58e2a7be2137f\",\"status\":\"PENDING\",\"merchant_name\":\"Zhafirah Umroh\",\"merchant_profile_picture_url\":\"https:\\/\\/du8nwjtfkinx.cloudfront.net\\/xendit.png\",\"amount\":25000000,\"payer_email\":\"marfinohamzah455@gmail.com\",\"description\":\"Pembayaran Paket Umroh Ekonomis - BKWQP22XRX5V\",\"expiry_date\":\"2025-11-09T08:34:56.762Z\",\"invoice_url\":\"https:\\/\\/checkout-staging.xendit.co\\/web\\/690f00b06b8eaa2d55573314\",\"available_banks\":[{\"bank_code\":\"BSI\",\"collection_type\":\"POOL\",\"transfer_amount\":25000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"BNC\",\"collection_type\":\"POOL\",\"transfer_amount\":25000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"BRI\",\"collection_type\":\"POOL\",\"transfer_amount\":25000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"MUAMALAT\",\"collection_type\":\"POOL\",\"transfer_amount\":25000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"SAHABAT_SAMPOERNA\",\"collection_type\":\"POOL\",\"transfer_amount\":25000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"MANDIRI\",\"collection_type\":\"POOL\",\"transfer_amount\":25000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"CIMB\",\"collection_type\":\"POOL\",\"transfer_amount\":25000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"BCA\",\"collection_type\":\"POOL\",\"transfer_amount\":25000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"BNI\",\"collection_type\":\"POOL\",\"transfer_amount\":25000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"PERMATA\",\"collection_type\":\"POOL\",\"transfer_amount\":25000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"BJB\",\"collection_type\":\"POOL\",\"transfer_amount\":25000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0}],\"available_retail_outlets\":[{\"retail_outlet_name\":\"INDOMARET\"},{\"retail_outlet_name\":\"ALFAMART\"}],\"available_ewallets\":[{\"ewallet_type\":\"SHOPEEPAY\"},{\"ewallet_type\":\"ASTRAPAY\"},{\"ewallet_type\":\"JENIUSPAY\"},{\"ewallet_type\":\"DANA\"},{\"ewallet_type\":\"LINKAJA\"},{\"ewallet_type\":\"OVO\"},{\"ewallet_type\":\"NEXCASH\"},{\"ewallet_type\":\"GOPAY\"}],\"available_qr_codes\":[{\"qr_code_type\":\"QRIS\"}],\"available_direct_debits\":[{\"direct_debit_type\":\"DD_BRI\"},{\"direct_debit_type\":\"DD_MANDIRI\"}],\"available_paylaters\":[{\"paylater_type\":\"KREDIVO\"},{\"paylater_type\":\"AKULAKU\"},{\"paylater_type\":\"ATOME\"}],\"should_exclude_credit_card\":false,\"should_send_email\":false,\"success_redirect_url\":\"http:\\/\\/zhafirah_umroh_system.test\\/portal\\/booking-success.php?booking_id=19\",\"failure_redirect_url\":\"http:\\/\\/zhafirah_umroh_system.test\\/portal\\/booking-detail.php?id=19\",\"created\":\"2025-11-08T08:34:56.901Z\",\"updated\":\"2025-11-08T08:34:56.901Z\",\"currency\":\"IDR\",\"items\":[{\"name\":\"Paket Umroh Ekonomis\",\"quantity\":1,\"price\":25000000,\"category\":\"umroh\"}],\"customer\":{\"given_names\":\"MARFINO HAMZAH\",\"email\":\"marfinohamzah455@gmail.com\"},\"metadata\":null}',NULL,'2025-11-08 08:34:57','2025-11-08 08:35:22'),(11,21,'690f0b228b4ca8dceb692845','BK-1762593568-2',NULL,NULL,25000000.00,NULL,'paid','https://checkout-staging.xendit.co/web/690f0b228b4ca8dceb692845','2025-11-08 16:19:55','2025-11-09 09:19:30','{\"id\":\"690f0b228b4ca8dceb692845\",\"external_id\":\"BK-1762593568-2\",\"user_id\":\"69073e799ff58e2a7be2137f\",\"status\":\"PENDING\",\"merchant_name\":\"Zhafirah Umroh\",\"merchant_profile_picture_url\":\"https:\\/\\/du8nwjtfkinx.cloudfront.net\\/xendit.png\",\"amount\":25000000,\"payer_email\":\"marfinohamzah455@gmail.com\",\"description\":\"Pembayaran Paket Umroh Ekonomis - BK1L58AT98I7\",\"expiry_date\":\"2025-11-09T09:19:30.493Z\",\"invoice_url\":\"https:\\/\\/checkout-staging.xendit.co\\/web\\/690f0b228b4ca8dceb692845\",\"available_banks\":[{\"bank_code\":\"PERMATA\",\"collection_type\":\"POOL\",\"transfer_amount\":25000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"CIMB\",\"collection_type\":\"POOL\",\"transfer_amount\":25000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"BNC\",\"collection_type\":\"POOL\",\"transfer_amount\":25000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"MANDIRI\",\"collection_type\":\"POOL\",\"transfer_amount\":25000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"BNI\",\"collection_type\":\"POOL\",\"transfer_amount\":25000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"BSI\",\"collection_type\":\"POOL\",\"transfer_amount\":25000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"BCA\",\"collection_type\":\"POOL\",\"transfer_amount\":25000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"BRI\",\"collection_type\":\"POOL\",\"transfer_amount\":25000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"MUAMALAT\",\"collection_type\":\"POOL\",\"transfer_amount\":25000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"SAHABAT_SAMPOERNA\",\"collection_type\":\"POOL\",\"transfer_amount\":25000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"BJB\",\"collection_type\":\"POOL\",\"transfer_amount\":25000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0}],\"available_retail_outlets\":[{\"retail_outlet_name\":\"INDOMARET\"},{\"retail_outlet_name\":\"ALFAMART\"}],\"available_ewallets\":[{\"ewallet_type\":\"SHOPEEPAY\"},{\"ewallet_type\":\"ASTRAPAY\"},{\"ewallet_type\":\"JENIUSPAY\"},{\"ewallet_type\":\"DANA\"},{\"ewallet_type\":\"LINKAJA\"},{\"ewallet_type\":\"OVO\"},{\"ewallet_type\":\"NEXCASH\"},{\"ewallet_type\":\"GOPAY\"}],\"available_qr_codes\":[{\"qr_code_type\":\"QRIS\"}],\"available_direct_debits\":[{\"direct_debit_type\":\"DD_BRI\"},{\"direct_debit_type\":\"DD_MANDIRI\"}],\"available_paylaters\":[{\"paylater_type\":\"KREDIVO\"},{\"paylater_type\":\"AKULAKU\"},{\"paylater_type\":\"ATOME\"}],\"should_exclude_credit_card\":false,\"should_send_email\":false,\"success_redirect_url\":\"http:\\/\\/zhafirah_umroh_system.test\\/portal\\/booking-success.php?booking_id=21\",\"failure_redirect_url\":\"http:\\/\\/zhafirah_umroh_system.test\\/portal\\/booking-detail.php?id=21\",\"created\":\"2025-11-08T09:19:30.629Z\",\"updated\":\"2025-11-08T09:19:30.629Z\",\"currency\":\"IDR\",\"items\":[{\"name\":\"Paket Umroh Ekonomis\",\"quantity\":1,\"price\":25000000,\"category\":\"umroh\"}],\"customer\":{\"given_names\":\"MARFINO HAMZAH\",\"email\":\"marfinohamzah455@gmail.com\"},\"metadata\":null}',NULL,'2025-11-08 09:19:30','2025-11-08 09:19:55'),(12,22,'690f0b7d8b4ca8dceb692876','BK-1762593661-2',NULL,NULL,35000000.00,NULL,'paid','https://checkout-staging.xendit.co/web/690f0b7d8b4ca8dceb692876','2025-11-08 16:21:17','2025-11-09 09:21:01','{\"id\":\"690f0b7d8b4ca8dceb692876\",\"external_id\":\"BK-1762593661-2\",\"user_id\":\"69073e799ff58e2a7be2137f\",\"status\":\"PENDING\",\"merchant_name\":\"Zhafirah Umroh\",\"merchant_profile_picture_url\":\"https:\\/\\/du8nwjtfkinx.cloudfront.net\\/xendit.png\",\"amount\":35000000,\"payer_email\":\"marfinohamzah455@gmail.com\",\"description\":\"Pembayaran Paket Umroh Ramadhan 2025 - BK4LP6ZA4SN9\",\"expiry_date\":\"2025-11-09T09:21:01.826Z\",\"invoice_url\":\"https:\\/\\/checkout-staging.xendit.co\\/web\\/690f0b7d8b4ca8dceb692876\",\"available_banks\":[{\"bank_code\":\"PERMATA\",\"collection_type\":\"POOL\",\"transfer_amount\":35000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"CIMB\",\"collection_type\":\"POOL\",\"transfer_amount\":35000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"BNC\",\"collection_type\":\"POOL\",\"transfer_amount\":35000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"MANDIRI\",\"collection_type\":\"POOL\",\"transfer_amount\":35000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"BNI\",\"collection_type\":\"POOL\",\"transfer_amount\":35000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"BSI\",\"collection_type\":\"POOL\",\"transfer_amount\":35000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"BCA\",\"collection_type\":\"POOL\",\"transfer_amount\":35000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"BRI\",\"collection_type\":\"POOL\",\"transfer_amount\":35000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"MUAMALAT\",\"collection_type\":\"POOL\",\"transfer_amount\":35000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"SAHABAT_SAMPOERNA\",\"collection_type\":\"POOL\",\"transfer_amount\":35000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"BJB\",\"collection_type\":\"POOL\",\"transfer_amount\":35000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0}],\"available_retail_outlets\":[{\"retail_outlet_name\":\"INDOMARET\"},{\"retail_outlet_name\":\"ALFAMART\"}],\"available_ewallets\":[{\"ewallet_type\":\"SHOPEEPAY\"},{\"ewallet_type\":\"ASTRAPAY\"},{\"ewallet_type\":\"JENIUSPAY\"},{\"ewallet_type\":\"DANA\"},{\"ewallet_type\":\"LINKAJA\"},{\"ewallet_type\":\"OVO\"},{\"ewallet_type\":\"NEXCASH\"},{\"ewallet_type\":\"GOPAY\"}],\"available_qr_codes\":[{\"qr_code_type\":\"QRIS\"}],\"available_direct_debits\":[{\"direct_debit_type\":\"DD_BRI\"},{\"direct_debit_type\":\"DD_MANDIRI\"}],\"available_paylaters\":[{\"paylater_type\":\"KREDIVO\"},{\"paylater_type\":\"AKULAKU\"},{\"paylater_type\":\"ATOME\"}],\"should_exclude_credit_card\":false,\"should_send_email\":false,\"success_redirect_url\":\"http:\\/\\/zhafirah_umroh_system.test\\/portal\\/booking-success.php?booking_id=22\",\"failure_redirect_url\":\"http:\\/\\/zhafirah_umroh_system.test\\/portal\\/booking-detail.php?id=22\",\"created\":\"2025-11-08T09:21:02.020Z\",\"updated\":\"2025-11-08T09:21:02.020Z\",\"currency\":\"IDR\",\"items\":[{\"name\":\"Paket Umroh Ramadhan 2025\",\"quantity\":1,\"price\":35000000,\"category\":\"umroh\"}],\"customer\":{\"given_names\":\"MARFINO HAMZAH\",\"email\":\"marfinohamzah455@gmail.com\"},\"metadata\":null}',NULL,'2025-11-08 09:21:02','2025-11-08 09:21:17'),(13,25,'6919454afbcbf149203e48d7','BK-1763263817-3',NULL,NULL,25000000.00,NULL,'paid','https://checkout-staging.xendit.co/web/6919454afbcbf149203e48d7','2025-11-16 10:30:35','2025-11-17 03:30:18','{\"id\":\"6919454afbcbf149203e48d7\",\"external_id\":\"BK-1763263817-3\",\"user_id\":\"69073e799ff58e2a7be2137f\",\"status\":\"PENDING\",\"merchant_name\":\"Zhafirah Umroh\",\"merchant_profile_picture_url\":\"https:\\/\\/xnd-merchant-logos.s3.amazonaws.com\\/business\\/production\\/69073e799ff58e2a7be2137f-1762755503302.png\",\"amount\":25000000,\"payer_email\":\"marfino29@gmail.com\",\"description\":\"Pembayaran Paket Umroh Ekonomis - BKB3103W3QZV\",\"expiry_date\":\"2025-11-17T03:30:18.430Z\",\"invoice_url\":\"https:\\/\\/checkout-staging.xendit.co\\/web\\/6919454afbcbf149203e48d7\",\"available_banks\":[{\"bank_code\":\"BRI\",\"collection_type\":\"POOL\",\"transfer_amount\":25000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"BNC\",\"collection_type\":\"POOL\",\"transfer_amount\":25000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"BSI\",\"collection_type\":\"POOL\",\"transfer_amount\":25000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"MANDIRI\",\"collection_type\":\"POOL\",\"transfer_amount\":25000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"BNI\",\"collection_type\":\"POOL\",\"transfer_amount\":25000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"SAHABAT_SAMPOERNA\",\"collection_type\":\"POOL\",\"transfer_amount\":25000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"BCA\",\"collection_type\":\"POOL\",\"transfer_amount\":25000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"MUAMALAT\",\"collection_type\":\"POOL\",\"transfer_amount\":25000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"CIMB\",\"collection_type\":\"POOL\",\"transfer_amount\":25000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"PERMATA\",\"collection_type\":\"POOL\",\"transfer_amount\":25000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0},{\"bank_code\":\"BJB\",\"collection_type\":\"POOL\",\"transfer_amount\":25000000,\"bank_branch\":\"Virtual Account\",\"account_holder_name\":\"ZHAFIRAH UMROH\",\"identity_amount\":0}],\"available_retail_outlets\":[],\"available_ewallets\":[{\"ewallet_type\":\"SHOPEEPAY\"},{\"ewallet_type\":\"ASTRAPAY\"},{\"ewallet_type\":\"JENIUSPAY\"},{\"ewallet_type\":\"DANA\"},{\"ewallet_type\":\"LINKAJA\"},{\"ewallet_type\":\"OVO\"},{\"ewallet_type\":\"NEXCASH\"},{\"ewallet_type\":\"GOPAY\"}],\"available_qr_codes\":[{\"qr_code_type\":\"QRIS\"}],\"available_direct_debits\":[{\"direct_debit_type\":\"DD_BRI\"},{\"direct_debit_type\":\"DD_MANDIRI\"}],\"available_paylaters\":[{\"paylater_type\":\"KREDIVO\"},{\"paylater_type\":\"AKULAKU\"},{\"paylater_type\":\"ATOME\"}],\"should_exclude_credit_card\":false,\"should_send_email\":false,\"success_redirect_url\":\"http:\\/\\/zhafirah_umroh_system.test\\/portal\\/booking-success.php?booking_id=25\",\"failure_redirect_url\":\"http:\\/\\/zhafirah_umroh_system.test\\/portal\\/booking-detail.php?id=25\",\"created\":\"2025-11-16T03:30:18.750Z\",\"updated\":\"2025-11-16T03:30:18.750Z\",\"currency\":\"IDR\",\"items\":[{\"name\":\"Paket Umroh Ekonomis\",\"quantity\":1,\"price\":25000000,\"category\":\"umroh\"}],\"customer\":{\"given_names\":\"Rio Hakim\",\"email\":\"marfino29@gmail.com\"},\"metadata\":null}',NULL,'2025-11-16 03:30:18','2025-11-16 03:30:35');
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_agent`
--

DROP TABLE IF EXISTS `tbl_agent`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_agent` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_agent` varchar(50) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `nama_agent` varchar(100) NOT NULL,
  `kontak` varchar(20) DEFAULT NULL,
  `jenis_kelamin` enum('Laki-Laki','Perempuan') DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `kota_kabupaten` varchar(100) DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `email` varchar(100) DEFAULT NULL,
  `tempat_lahir` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_agent`
--

LOCK TABLES `tbl_agent` WRITE;
/*!40000 ALTER TABLE `tbl_agent` DISABLE KEYS */;
INSERT INTO `tbl_agent` VALUES (1,'A-00003','727172731237','Muhammad Arsyad Ambo Dalle','0000','Laki-Laki','2025-10-14','Luwu','active','2025-11-19 12:45:59',NULL,NULL,NULL,NULL,NULL),(2,'A-00001','7321111111111111','RAIHAN','0817-1788-8989','Laki-Laki','1991-02-28','MAJAKENGKA','active','2025-11-19 12:45:59',NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `tbl_agent` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_hotel`
--

DROP TABLE IF EXISTS `tbl_hotel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_hotel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_hotel` varchar(50) NOT NULL,
  `nama_hotel` varchar(100) NOT NULL,
  `lokasi_hotel` varchar(100) DEFAULT NULL,
  `kontak_hotel` varchar(20) DEFAULT NULL,
  `email_hotel` varchar(100) DEFAULT NULL,
  `rating_hotel` int(11) DEFAULT NULL,
  `harga_hotel` decimal(15,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_hotel`
--

LOCK TABLES `tbl_hotel` WRITE;
/*!40000 ALTER TABLE `tbl_hotel` DISABLE KEYS */;
INSERT INTO `tbl_hotel` VALUES (1,'HT-00002','Lee Meridien Makkah','Mekkah','021-67783333','yusup.bisnis@gmail.com',5,1800000.00,'2025-11-19 12:46:06'),(2,'HT-00001','Elaf Mashaer','Mekkah','021-67783333','yusup.bisnis@gmail.com',4,1500000.00,'2025-11-19 12:46:06');
/*!40000 ALTER TABLE `tbl_hotel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_karyawan`
--

DROP TABLE IF EXISTS `tbl_karyawan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_karyawan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_karyawan` varchar(50) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `nama_karyawan` varchar(100) NOT NULL,
  `kontak` varchar(20) DEFAULT NULL,
  `jenis_kelamin` enum('Laki-Laki','Perempuan') DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `gaji` decimal(15,2) DEFAULT NULL,
  `kota_kabupaten` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `tempat_lahir` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_karyawan`
--

LOCK TABLES `tbl_karyawan` WRITE;
/*!40000 ALTER TABLE `tbl_karyawan` DISABLE KEYS */;
INSERT INTO `tbl_karyawan` VALUES (1,'K-00001','721100000000000','AHMAD','0817-1788-8989','Laki-Laki','2025-06-23',1200000.00,'MAJALENGKA','2025-11-19 12:45:59',NULL,NULL,NULL);
/*!40000 ALTER TABLE `tbl_karyawan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_kat_menu`
--

DROP TABLE IF EXISTS `tbl_kat_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_kat_menu` (
  `kategori_id` int(11) NOT NULL AUTO_INCREMENT,
  `nm_ka_menu` varchar(100) NOT NULL,
  PRIMARY KEY (`kategori_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_kat_menu`
--

LOCK TABLES `tbl_kat_menu` WRITE;
/*!40000 ALTER TABLE `tbl_kat_menu` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_kat_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_kat_sub_menu`
--

DROP TABLE IF EXISTS `tbl_kat_sub_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_kat_sub_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nm_ka_menu` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_kat_sub_menu`
--

LOCK TABLES `tbl_kat_sub_menu` WRITE;
/*!40000 ALTER TABLE `tbl_kat_sub_menu` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_kat_sub_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_maskapai`
--

DROP TABLE IF EXISTS `tbl_maskapai`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_maskapai` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_maskapai` varchar(20) NOT NULL,
  `nama_maskapai` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `rute_penerbangan` varchar(100) DEFAULT NULL,
  `lama_perjalanan` varchar(50) DEFAULT NULL,
  `harga_tiket` decimal(15,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_maskapai`
--

LOCK TABLES `tbl_maskapai` WRITE;
/*!40000 ALTER TABLE `tbl_maskapai` DISABLE KEYS */;
INSERT INTO `tbl_maskapai` VALUES (1,'QR','Qatar Airways','2025-11-19 12:42:38',NULL,NULL,NULL),(2,'SV','Saudia Airline','2025-11-19 12:42:38',NULL,NULL,NULL),(3,'EY','Etihad Airways','2025-11-19 12:42:38',NULL,NULL,NULL),(4,'GA','Garuda Indonesia','2025-11-19 12:42:38',NULL,NULL,NULL);
/*!40000 ALTER TABLE `tbl_maskapai` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_menu`
--

DROP TABLE IF EXISTS `tbl_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kategori_id` int(11) NOT NULL,
  `kategori_sub_id` int(11) DEFAULT NULL,
  `nama_menu` varchar(100) NOT NULL,
  `link` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `kategori_id` (`kategori_id`),
  CONSTRAINT `tbl_menu_ibfk_1` FOREIGN KEY (`kategori_id`) REFERENCES `tbl_kat_menu` (`kategori_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_menu`
--

LOCK TABLES `tbl_menu` WRITE;
/*!40000 ALTER TABLE `tbl_menu` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_paket`
--

DROP TABLE IF EXISTS `tbl_paket`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_paket` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_paket` varchar(50) NOT NULL,
  `nama_paket` varchar(200) NOT NULL,
  `jenis_paket` enum('umroh','haji') NOT NULL,
  `tanggal_keberangkatan` date NOT NULL,
  `jumlah_hari` int(11) NOT NULL,
  `id_maskapai` int(11) NOT NULL,
  `lokasi_keberangkatan` varchar(100) DEFAULT NULL,
  `harga_paket` decimal(15,2) NOT NULL,
  `kuota_jamaah` int(11) NOT NULL,
  `foto_brosur` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `jenis_paket1` varchar(100) DEFAULT NULL,
  `hotel_mekkah1` int(11) DEFAULT NULL,
  `hotel_madinah1` int(11) DEFAULT NULL,
  `hotel_transit1` int(11) DEFAULT NULL,
  `harga_quad1` decimal(15,2) DEFAULT NULL,
  `harga_triple1` decimal(15,2) DEFAULT NULL,
  `harga_double1` decimal(15,2) DEFAULT NULL,
  `jenis_paket2` varchar(100) DEFAULT NULL,
  `hotel_mekkah2` int(11) DEFAULT NULL,
  `hotel_madinah2` int(11) DEFAULT NULL,
  `hotel_transit2` int(11) DEFAULT NULL,
  `harga_hpp2` decimal(15,2) DEFAULT NULL,
  `harga_quad2` decimal(15,2) DEFAULT NULL,
  `harga_triple2` decimal(15,2) DEFAULT NULL,
  `harga_double2` decimal(15,2) DEFAULT NULL,
  `termasuk` text DEFAULT NULL,
  `tidak_termasuk` text DEFAULT NULL,
  `syarat` text DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_maskapai` (`id_maskapai`),
  CONSTRAINT `tbl_paket_ibfk_1` FOREIGN KEY (`id_maskapai`) REFERENCES `tbl_maskapai` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_paket`
--

LOCK TABLES `tbl_paket` WRITE;
/*!40000 ALTER TABLE `tbl_paket` DISABLE KEYS */;
INSERT INTO `tbl_paket` VALUES (1,'PH-00002','HAJI FURODA 2026 | 1447 H','haji','2026-03-10',25,2,'Jakarta',305000000.00,65,NULL,'active','2025-11-19 12:46:09',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2,'PH-00001','HAJI FAST TRACK 2026 | 1447 H','haji','2026-03-10',22,1,'Jakarta',245000000.00,70,NULL,'active','2025-11-19 12:46:09',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(3,'PU-00004','UMROH 25 DESEMBER 2025','umroh','2025-12-25',12,1,'Jakarta',34500000.00,40,NULL,'active','2025-11-19 12:46:09',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(4,'PU-00001','UMROH 12 DESEMBER 2025','umroh','2025-12-12',10,2,'Jakarta',30500000.00,35,NULL,'active','2025-11-19 12:46:09',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `tbl_paket` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_paket_keberangkatan`
--

DROP TABLE IF EXISTS `tbl_paket_keberangkatan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_paket_keberangkatan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_keberangkatan` varchar(50) NOT NULL,
  `nama_paket` varchar(200) NOT NULL,
  `jenis_paket` enum('umroh','haji') NOT NULL,
  `tanggal_keberangkatan` date NOT NULL,
  `lokasi_keberangkatan` varchar(100) NOT NULL,
  `id_maskapai` int(11) NOT NULL,
  `jumlah_hari` int(11) NOT NULL,
  `harga_paket` decimal(15,2) NOT NULL,
  `kuota_jamaah` int(11) NOT NULL,
  `status_paket` enum('open','closed') DEFAULT 'open',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `rute_penerbangan` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_maskapai` (`id_maskapai`),
  CONSTRAINT `tbl_paket_keberangkatan_ibfk_1` FOREIGN KEY (`id_maskapai`) REFERENCES `tbl_maskapai` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_paket_keberangkatan`
--

LOCK TABLES `tbl_paket_keberangkatan` WRITE;
/*!40000 ALTER TABLE `tbl_paket_keberangkatan` DISABLE KEYS */;
INSERT INTO `tbl_paket_keberangkatan` VALUES (1,'KU-00001','UMROH 25 DESEMBER 2025 (Batch-1)','umroh','2025-12-25','Jakarta',1,12,28500000.00,40,'open','2025-11-19 12:42:38','Transit'),(2,'KU-00003','UMROH 25 DESEMBER 2025 (Batch-2)','umroh','2025-12-25','Jakarta',1,12,28500000.00,40,'open','2025-11-19 12:42:38','Transit'),(3,'KU-00013','UMROH 12 DESEMBER 2025 (Batch-1)','umroh','2025-12-12','Jakarta',2,10,24000000.00,40,'open','2025-11-19 12:42:38','Direct'),(4,'KH-00001','HAJI FAST TRACK 2026 | 1447 H (Batch-1)','haji','2026-03-10','Jakarta',1,22,70000000.00,70,'open','2025-11-19 12:42:38','Direct');
/*!40000 ALTER TABLE `tbl_paket_keberangkatan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_pemasukan_umum`
--

DROP TABLE IF EXISTS `tbl_pemasukan_umum`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_pemasukan_umum` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_pemasukan` varchar(50) NOT NULL,
  `tanggal_pemasukan` date NOT NULL,
  `jenis_pemasukan` enum('penjualan','investasi','lainnya') NOT NULL,
  `nama_pemasukan` varchar(200) NOT NULL,
  `jumlah_pemasukan` decimal(15,2) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_pemasukan_umum`
--

LOCK TABLES `tbl_pemasukan_umum` WRITE;
/*!40000 ALTER TABLE `tbl_pemasukan_umum` DISABLE KEYS */;
INSERT INTO `tbl_pemasukan_umum` VALUES (1,'CR-00002','2025-05-30','lainnya','Beli paket data',350000.00,NULL,'2025-11-19 12:46:09'),(2,'CR-00001','2025-07-31','lainnya','Beli paket data',250000.00,NULL,'2025-11-19 12:46:09');
/*!40000 ALTER TABLE `tbl_pemasukan_umum` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_pembayaran`
--

DROP TABLE IF EXISTS `tbl_pembayaran`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_pembayaran` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_transaksi` varchar(50) NOT NULL,
  `id_pendaftaran` int(11) NOT NULL,
  `tanggal_bayar` date NOT NULL,
  `jumlah_bayar` decimal(15,2) NOT NULL,
  `metode_bayar` varchar(50) DEFAULT NULL,
  `status_pembayaran` enum('check','confirmed') DEFAULT 'check',
  `kode_referensi` varchar(100) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `id_pendaftaran` (`id_pendaftaran`),
  CONSTRAINT `tbl_pembayaran_ibfk_1` FOREIGN KEY (`id_pendaftaran`) REFERENCES `tbl_pendaftaran_jamaah` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_pembayaran`
--

LOCK TABLES `tbl_pembayaran` WRITE;
/*!40000 ALTER TABLE `tbl_pembayaran` DISABLE KEYS */;
INSERT INTO `tbl_pembayaran` VALUES (1,'INV/CRJ-00014/KH-00001/250717',1,'2025-07-17',100000000.00,'transfer','check','',NULL,'2025-11-19 12:45:17'),(2,'INV/CRJ-00009/KH-00001/250713',1,'2025-07-13',5000000.00,'cash','check','',NULL,'2025-11-19 12:45:17'),(3,'INV/CRJ-00009/KH-00001/250712',1,'2025-07-12',50000000.00,'transfer','confirmed','',NULL,'2025-11-19 12:45:17'),(4,'INV/CRJ-00020/KU-00013/251016',2,'2025-10-16',24000000.00,'cash','check','',NULL,'2025-11-19 12:45:17'),(5,'INV/CRJ-00020/KU-00013/251016',2,'2025-10-16',5000000.00,'transfer','check','',NULL,'2025-11-19 12:45:17'),(6,'INV/CRJ-00011/KU-00001/251015',5,'2025-10-15',10000000.00,'transfer','confirmed','',NULL,'2025-11-19 12:45:17');
/*!40000 ALTER TABLE `tbl_pembayaran` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_pendaftaran_jamaah`
--

DROP TABLE IF EXISTS `tbl_pendaftaran_jamaah`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_pendaftaran_jamaah` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_registrasi` varchar(50) NOT NULL,
  `tanggal_registrasi` date NOT NULL,
  `nik` varchar(20) NOT NULL,
  `id_paket_keberangkatan` int(11) NOT NULL,
  `nama_jamaah` varchar(100) NOT NULL,
  `jenis_kelamin` enum('Laki-Laki','Perempuan') NOT NULL,
  `no_identitas` varchar(50) NOT NULL DEFAULT '1',
  `tanggal_lahir` date NOT NULL,
  `alamat` text DEFAULT NULL,
  `kota_kabupaten` varchar(100) DEFAULT NULL,
  `telepon` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `status` enum('active','cancelled') DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `nama_paspor` varchar(100) DEFAULT NULL,
  `nomor_paspor` varchar(50) DEFAULT NULL,
  `habis_paspor` date DEFAULT NULL,
  `tipe_kamar` varchar(50) DEFAULT NULL,
  `jumlah_pax` int(11) DEFAULT NULL,
  `tempat_lahir` varchar(100) DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `kantor_imigrasi` varchar(100) DEFAULT NULL,
  `paspor_aktif` date DEFAULT NULL,
  `foto_ktp` varchar(255) DEFAULT NULL,
  `foto_kk` varchar(255) DEFAULT NULL,
  `foto_paspor1` varchar(255) DEFAULT NULL,
  `foto_paspor2` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_paket_keberangkatan` (`id_paket_keberangkatan`),
  CONSTRAINT `tbl_pendaftaran_jamaah_ibfk_1` FOREIGN KEY (`id_paket_keberangkatan`) REFERENCES `tbl_paket_keberangkatan` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_pendaftaran_jamaah`
--

LOCK TABLES `tbl_pendaftaran_jamaah` WRITE;
/*!40000 ALTER TABLE `tbl_pendaftaran_jamaah` DISABLE KEYS */;
INSERT INTO `tbl_pendaftaran_jamaah` VALUES (1,'RH-00001','2025-07-17','7311055103760007',4,'ABDULLAH RAHMAT','Laki-Laki','1','1991-07-17',NULL,'Surabaya',NULL,NULL,'active','2025-11-19 12:45:17',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2,'RU-00004','2025-10-16','00000',1,'Fulan','Laki-Laki','1','1996-01-31',NULL,'',NULL,NULL,'active','2025-11-19 12:45:17',NULL,NULL,'2025-10-16','Quad',5,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(3,'RU-00003','2025-10-14','98923894798',2,'Nurdin Nanda','Laki-Laki','1','2025-10-14',NULL,'89080',NULL,NULL,'active','2025-11-19 12:45:17',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(4,'RU-00002','2025-07-17','7311055103760008',1,'AISYAH FAUZIAH','Perempuan','1','1993-07-17',NULL,'Bogor',NULL,NULL,'active','2025-11-19 12:45:17',NULL,NULL,'2035-07-17','Quad',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(5,'RU-00001','2025-07-16','7311055103760006',2,'MUHAMMAD HANIF','Laki-Laki','1','1991-07-16',NULL,'Sumedang',NULL,NULL,'active','2025-11-19 12:45:17',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `tbl_pendaftaran_jamaah` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_pengeluaran_haji`
--

DROP TABLE IF EXISTS `tbl_pengeluaran_haji`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_pengeluaran_haji` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_pengeluaran` varchar(50) NOT NULL,
  `id_paket_keberangkatan` int(11) NOT NULL,
  `tanggal_pengeluaran` date NOT NULL,
  `jenis_pengeluaran` enum('paket haji','tiket pesawat','visa','hotel','transport','lainnya') NOT NULL,
  `nama_pengeluaran` varchar(200) NOT NULL,
  `jumlah` decimal(15,2) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `id_paket_keberangkatan` (`id_paket_keberangkatan`),
  CONSTRAINT `tbl_pengeluaran_haji_ibfk_1` FOREIGN KEY (`id_paket_keberangkatan`) REFERENCES `tbl_paket_keberangkatan` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_pengeluaran_haji`
--

LOCK TABLES `tbl_pengeluaran_haji` WRITE;
/*!40000 ALTER TABLE `tbl_pengeluaran_haji` DISABLE KEYS */;
INSERT INTO `tbl_pengeluaran_haji` VALUES (1,'CH-00005',4,'2025-07-25','paket haji','Paket haji armuzna 10 pax',250000000.00,NULL,'2025-11-19 12:45:17');
/*!40000 ALTER TABLE `tbl_pengeluaran_haji` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_pengeluaran_umroh`
--

DROP TABLE IF EXISTS `tbl_pengeluaran_umroh`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_pengeluaran_umroh` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_pengeluaran` varchar(50) NOT NULL,
  `id_paket_keberangkatan` int(11) NOT NULL,
  `tanggal_pengeluaran` date NOT NULL,
  `jenis_pengeluaran` enum('tiket pesawat','visa umroh','hotel','transport','lainnya') NOT NULL,
  `nama_pengeluaran` varchar(200) NOT NULL,
  `jumlah` decimal(15,2) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `id_paket_keberangkatan` (`id_paket_keberangkatan`),
  CONSTRAINT `tbl_pengeluaran_umroh_ibfk_1` FOREIGN KEY (`id_paket_keberangkatan`) REFERENCES `tbl_paket_keberangkatan` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_pengeluaran_umroh`
--

LOCK TABLES `tbl_pengeluaran_umroh` WRITE;
/*!40000 ALTER TABLE `tbl_pengeluaran_umroh` DISABLE KEYS */;
INSERT INTO `tbl_pengeluaran_umroh` VALUES (1,'CU-00004',1,'2025-07-25','tiket pesawat','Bayar tiket pesawat 5 pax',75000000.00,NULL,'2025-11-19 12:42:38'),(2,'CU-00001',3,'2025-07-25','visa umroh','Bayar visa 10 pax',20000000.00,NULL,'2025-11-19 12:42:38');
/*!40000 ALTER TABLE `tbl_pengeluaran_umroh` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_pengeluaran_umum`
--

DROP TABLE IF EXISTS `tbl_pengeluaran_umum`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_pengeluaran_umum` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_pengeluaran` varchar(50) NOT NULL,
  `tanggal_pengeluaran` date NOT NULL,
  `jenis_pengeluaran` enum('operasional','karyawan','transport','lainnya') NOT NULL,
  `nama_pengeluaran` varchar(200) NOT NULL,
  `jumlah_pengeluaran` decimal(15,2) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_pengeluaran_umum`
--

LOCK TABLES `tbl_pengeluaran_umum` WRITE;
/*!40000 ALTER TABLE `tbl_pengeluaran_umum` DISABLE KEYS */;
INSERT INTO `tbl_pengeluaran_umum` VALUES (1,'CG-00007','2025-06-16','operasional','Manasik jamaah umroh 10 pxa',3000000.00,NULL,'2025-11-19 12:42:38'),(2,'CG-00006','2025-07-26','karyawan','Gaji karyawan 3 orang',6000000.00,NULL,'2025-11-19 12:42:38');
/*!40000 ALTER TABLE `tbl_pengeluaran_umum` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_surat_izin_cuti`
--

DROP TABLE IF EXISTS `tbl_surat_izin_cuti`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_surat_izin_cuti` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_jamaah` int(11) NOT NULL,
  `kode_jamaah` varchar(50) DEFAULT NULL,
  `tanggal_dokumen` date NOT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `tanggal_keberangkatan` date DEFAULT NULL,
  `tanggal_kepulangan` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `id_jamaah` (`id_jamaah`),
  CONSTRAINT `tbl_surat_izin_cuti_ibfk_1` FOREIGN KEY (`id_jamaah`) REFERENCES `tbl_pendaftaran_jamaah` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_surat_izin_cuti`
--

LOCK TABLES `tbl_surat_izin_cuti` WRITE;
/*!40000 ALTER TABLE `tbl_surat_izin_cuti` DISABLE KEYS */;
INSERT INTO `tbl_surat_izin_cuti` VALUES (1,1,'J-00009','2025-07-18','1988-10-18','2025-12-25','2025-12-25','2025-11-19 12:46:13');
/*!40000 ALTER TABLE `tbl_surat_izin_cuti` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_surat_rekomendasi`
--

DROP TABLE IF EXISTS `tbl_surat_rekomendasi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_surat_rekomendasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_jamaah` int(11) NOT NULL,
  `kode_jamaah` varchar(50) DEFAULT NULL,
  `tanggal_dokumen` date NOT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `tanggal_kepulangan` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `id_jamaah` (`id_jamaah`),
  CONSTRAINT `tbl_surat_rekomendasi_ibfk_1` FOREIGN KEY (`id_jamaah`) REFERENCES `tbl_pendaftaran_jamaah` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_surat_rekomendasi`
--

LOCK TABLES `tbl_surat_rekomendasi` WRITE;
/*!40000 ALTER TABLE `tbl_surat_rekomendasi` DISABLE KEYS */;
INSERT INTO `tbl_surat_rekomendasi` VALUES (1,1,'J-00001','2025-10-14','1958-10-15','2025-12-25','2025-11-19 12:45:59'),(2,2,'J-00007','2025-10-14','2005-10-16','2025-12-25','2025-11-19 12:45:59'),(3,3,'J-00001','2025-07-17','1958-10-15','2025-12-12','2025-11-19 12:45:59');
/*!40000 ALTER TABLE `tbl_surat_rekomendasi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_tabungan`
--

DROP TABLE IF EXISTS `tbl_tabungan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_tabungan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_jamaah` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah` decimal(15,2) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `id_jamaah` (`id_jamaah`),
  CONSTRAINT `tbl_tabungan_ibfk_1` FOREIGN KEY (`id_jamaah`) REFERENCES `tbl_pendaftaran_jamaah` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_tabungan`
--

LOCK TABLES `tbl_tabungan` WRITE;
/*!40000 ALTER TABLE `tbl_tabungan` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_tabungan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_user`
--

DROP TABLE IF EXISTS `tbl_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_user` (
  `userid` varchar(50) NOT NULL,
  `nama_user` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nip` varchar(50) DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1',
  `force_ganti` enum('1','2') DEFAULT '1',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_user`
--

LOCK TABLES `tbl_user` WRITE;
/*!40000 ALTER TABLE `tbl_user` DISABLE KEYS */;
INSERT INTO `tbl_user` VALUES ('admin','Administrator','marfinohamzah455@gmail.com','$2y$10$KPhc3WL8.Qx0yq6ACNKA0uDS2RApZCJVXZFSPQ7McYsm32M2/kxQS',NULL,'1','1','2025-11-19 12:42:38','2025-11-19 12:49:38');
/*!40000 ALTER TABLE `tbl_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_user_menu`
--

DROP TABLE IF EXISTS `tbl_user_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_user_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` varchar(50) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `hak_akses` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`),
  KEY `menu_id` (`menu_id`),
  CONSTRAINT `tbl_user_menu_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `tbl_user` (`userid`),
  CONSTRAINT `tbl_user_menu_ibfk_2` FOREIGN KEY (`menu_id`) REFERENCES `tbl_menu` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_user_menu`
--

LOCK TABLES `tbl_user_menu` WRITE;
/*!40000 ALTER TABLE `tbl_user_menu` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_user_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `whatsapp` varchar(20) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('jemaah','admin') DEFAULT 'jemaah',
  `status` enum('active','inactive','pending') DEFAULT 'pending',
  `email_verified` tinyint(1) DEFAULT 0,
  `verification_token` varchar(255) DEFAULT NULL,
  `reset_token` varchar(255) DEFAULT NULL,
  `reset_token_expiry` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `whatsapp` (`whatsapp`),
  KEY `idx_email` (`email`),
  KEY `idx_status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (2,'MARFINO HAMZAH','marfinohamzah455@gmail.com','6289669309618','$2y$10$kXuqwKzOYI59cBMlbXqo4.KZn4iLvLWSwfOKRAI1KyScrwq05eRe.','jemaah','active',0,'ce7d56d13c3939dbfabb3e41f2b3fa7612e77ec00c8a0482ff8a290debd28123',NULL,NULL,'2025-11-06 03:20:31','2025-11-08 06:40:59'),(3,'Rio Hakim','marfino29@gmail.com','6289626312680','$2y$10$KPhc3WL8.Qx0yq6ACNKA0uDS2RApZCJVXZFSPQ7McYsm32M2/kxQS','jemaah','active',0,'b07b7fa3fb5bce1c85273e1456f998554a1898a76eccc5fc7ce115d59c41b182',NULL,NULL,'2025-11-08 06:41:08','2025-11-08 06:42:03');
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

-- Dump completed on 2025-11-20 15:18:10
