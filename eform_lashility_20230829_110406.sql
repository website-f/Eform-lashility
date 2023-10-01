-- MySQL dump 10.13  Distrib 8.1.0, for Win64 (x86_64)
--
-- Host: localhost    Database: eform_lashility
-- ------------------------------------------------------
-- Server version	8.1.0

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms`
--

DROP TABLE IF EXISTS `forms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `forms` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fields` json NOT NULL,
  `approval` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approveBy` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint unsigned NOT NULL,
  `notify` json DEFAULT NULL,
  `privacy` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `forms_user_id_foreign` (`user_id`),
  CONSTRAINT `forms_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms`
--

LOCK TABLES `forms` WRITE;
/*!40000 ALTER TABLE `forms` DISABLE KEYS */;
INSERT INTO `forms` VALUES (1,'test',NULL,'[{\"type\": \"Heading\", \"label\": \"Heading\", \"fieldID\": \"heading1693207974395\", \"pageNumber\": 1, \"subheading\": \"SubHeading\"}, {\"type\": \"text\", \"label\": \"Name\", \"fieldID\": \"textInputLabel1693207976398\", \"approval\": \"pending\", \"required\": \"no\", \"pageNumber\": 1}, {\"type\": \"textarea\", \"label\": \"Test\", \"fieldID\": \"textarea1693207978393\", \"approval\": \"pending\", \"required\": \"no\", \"pageNumber\": 1}]','No',NULL,1,'[\"superadmin@demo.com\"]',NULL,'2023-08-27 23:33:44','2023-08-28 02:02:34','2023-08-28 02:02:34','test',NULL);
/*!40000 ALTER TABLE `forms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_reset_tokens_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2023_07_25_011330_create_forms_tabel',1),(6,'2023_07_25_011642_create_roles_table',1),(7,'2023_07_25_011752_add_role_id_into_users_table',1),(8,'2023_08_02_075331_create_submitted_table',1),(9,'2023_08_07_091725_add_deleted_column_in_forms_table',1),(10,'2023_08_07_091846_add_deleted_column_in_submitteds__table',1),(11,'2023_08_11_090138_add_phone_column_in_users_table',1),(12,'2023_08_16_020939_add_approve_by_column_in_forms_table',1),(13,'2023_08_16_022922_add_approve_by_column_in_submitteds_table',1),(14,'2023_08_23_091342_add_notify_column_in_forms_table',1),(15,'2023_08_24_041246_add_privacy_column_in_forms_table',1),(16,'2023_08_24_045257_add_usermail_column_in_submitteds_table',1),(17,'2023_08_24_072550_add_notify_column_in_submitteds_table',1),(18,'2023_08_28_074831_add_slug_column_in_forms_table',2),(19,'2023_08_28_074840_add_slug_column_in_submitteds_table',2),(20,'2023_08_28_091341_add_logo_column_in_forms_table',3),(21,'2023_08_29_013120_add_subtitle_column_in_forms_table',3);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `role` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'SuperAdmin','2023-08-25 07:02:31','2023-08-25 07:02:31'),(2,'Admin','2023-08-25 07:02:31','2023-08-25 07:02:31'),(3,'Staff','2023-08-25 07:02:31','2023-08-25 07:02:31');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `submitteds`
--

DROP TABLE IF EXISTS `submitteds`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `submitteds` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fields` json NOT NULL,
  `approval` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approveBy` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `publisher_id` bigint unsigned NOT NULL,
  `usermail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notify` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `submitteds_publisher_id_foreign` (`publisher_id`),
  CONSTRAINT `submitteds_publisher_id_foreign` FOREIGN KEY (`publisher_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `submitteds`
--

LOCK TABLES `submitteds` WRITE;
/*!40000 ALTER TABLE `submitteds` DISABLE KEYS */;
INSERT INTO `submitteds` VALUES (6,'Intake & Consent Form','[{\"label\": \"Your Name\", \"value\": \"charmange\", \"fieldType\": \"text\"}, {\"label\": \"Birth Date\", \"value\": \"23-08-2023\", \"fieldType\": \"date\"}, {\"label\": \"Address\", \"value\": \"B-5-8 Plaza Mont Kiara\", \"fieldType\": \"text\"}, {\"label\": \"Telephone\", \"value\": \"01231879\", \"fieldType\": \"text\"}, {\"label\": \"Email\", \"value\": \"hello@tesrt\", \"fieldType\": \"email\"}, {\"label\": \"How did you hear about us ?\", \"value\": \"Google/Social Media\", \"fieldType\": \"radio\"}, {\"label\": \"Visit Outlet\", \"value\": \"Bangsar Telawi\", \"fieldType\": \"radio\"}, {\"label\": \"Is this your first time you have eyelash extensions/lash lift/brow lamination?\", \"value\": \"Yes\", \"fieldType\": \"radio\"}, {\"label\": \"Do you\", \"value\": \"Perm\", \"fieldType\": \"radio\"}, {\"label\": \"Are you getting your lash extensions. lash lift, or brow lamination applied for\", \"value\": \"a special occasion\", \"fieldType\": \"radio\"}, {\"label\": \"Do you habitually rub or pull your lashes for any reason ?\", \"value\": \"Yes\", \"fieldType\": \"radio\"}, {\"label\": \"Do you have or are you being treated for any eye illness or injury ?\", \"value\": \"Yes\", \"fieldType\": \"radio\"}, {\"label\": \"Do you able to keep your eye\'s closed and lie still for up 2 hours?\", \"value\": \"No\", \"fieldType\": \"radio\"}, {\"label\": \"Please include any of the following options that apply to you\", \"value\": [\"Permanent Eye Make Up\"], \"fieldType\": \"checkbox\"}, {\"label\": \"Lashes\", \"value\": \"asd\", \"fieldType\": \"text\"}, {\"label\": \"Lash Design\", \"value\": \"asd\", \"fieldType\": \"text\"}, {\"label\": \"Lash Length\", \"value\": \"sad\", \"fieldType\": \"text\"}, {\"label\": \"Lash Curl\", \"value\": \"asd\", \"fieldType\": \"text\"}, {\"label\": \"Lash Type\", \"value\": \"asd\", \"fieldType\": \"text\"}, {\"label\": \"Lash Stylist\", \"value\": \"asd\", \"fieldType\": \"text\"}, {\"label\": \"Remarks\", \"value\": \"asd\", \"fieldType\": \"text\"}, {\"label\": \"I AGREE TO THE FOLLOWING.\", \"value\": [\"I agree to terms & conditions\"], \"fieldType\": \"checkbox\"}, {\"label\": \"Date\", \"value\": \"12-03-3123\", \"fieldType\": \"date\"}, {\"label\": \"Signature\", \"value\": \"/signature/1693216669.png\", \"fieldType\": \"Signature\"}]','No',NULL,1,NULL,NULL,'2023-08-28 01:57:49','2023-08-28 01:57:49',NULL,'intake-consent-form');
/*!40000 ALTER TABLE `submitteds` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` bigint unsigned NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `users_role_id_foreign` (`role_id`),
  CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'superadmin','superadmin@demo.com','01234567890',1,NULL,NULL,'$2a$12$LTUNSQxGN9M.K4bITfdBc.C6jnDZLM235LBrIs55O0KNrdwEWucLC',NULL,'2023-08-25 07:02:53','2023-08-25 07:02:53');
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

-- Dump completed on 2023-08-29 11:04:06
