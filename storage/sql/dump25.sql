
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
DROP TABLE IF EXISTS `languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `languages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort` tinyint unsigned NOT NULL DEFAULT '1',
  `show` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `languages_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `languages` WRITE;
/*!40000 ALTER TABLE `languages` DISABLE KEYS */;
INSERT INTO `languages` VALUES (1,'UA','ua',1,0,NULL,'2023-01-09 15:20:25'),(2,'EN','en',1,0,'2023-01-09 15:20:44','2023-01-09 15:20:44');
/*!40000 ALTER TABLE `languages` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta` json DEFAULT NULL,
  `main` json DEFAULT NULL,
  `sort` tinyint unsigned NOT NULL DEFAULT '1',
  `show` tinyint(1) NOT NULL DEFAULT '0',
  `category_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pages_slug_unique` (`slug`),
  KEY `pages_category_id_foreign` (`category_id`),
  CONSTRAINT `pages_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` VALUES (1,'Index','/','{\"1\": {\"title\": null, \"keywords\": null, \"description\": null}, \"2\": {\"title\": null, \"keywords\": null, \"description\": null}}',NULL,1,1,1,NULL,'2023-01-15 13:37:43'),(2,'About','/about','{\"1\": {\"title\": null, \"keywords\": null, \"description\": null}, \"2\": {\"title\": null, \"keywords\": null, \"description\": null}}',NULL,2,1,1,'2023-01-09 15:06:33','2023-01-15 11:38:04');
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` json DEFAULT NULL,
  `sort` tinyint unsigned NOT NULL DEFAULT '1',
  `show` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Page','page','{\"1\": {\"title\": \"Page\"}, \"2\": {\"title\": null}}',1,0,NULL,'2023-01-15 13:18:31');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menus` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'header',
  `option` json DEFAULT NULL,
  `sort` tinyint unsigned NOT NULL DEFAULT '1',
  `show` tinyint(1) NOT NULL DEFAULT '0',
  `template_id` bigint unsigned NOT NULL,
  `menu_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menus_template_id_foreign` (`template_id`),
  KEY `menus_menu_id_foreign` (`menu_id`),
  CONSTRAINT `menus_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE,
  CONSTRAINT `menus_template_id_foreign` FOREIGN KEY (`template_id`) REFERENCES `templates` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` VALUES (1,'FMenu','header','{\"1\": {\"view\": \"vvvv\", \"tittle\": \"tttt\"}, \"2\": {\"view\": null, \"tittle\": null}}',1,1,23,NULL,'2023-01-10 16:35:28','2023-01-14 15:22:44'),(2,'SMunu','footer','{\"1\": {\"desc\": null, \"title\": null}, \"2\": {\"desc\": null, \"title\": null}}',0,1,26,NULL,'2023-01-12 13:23:22','2023-01-15 13:18:40'),(5,'FMenu','header','{\"1\": {\"title_2\": \"ttttt222\"}, \"2\": {\"title_2\": null}}',1,0,27,1,NULL,'2023-01-12 18:54:00'),(6,'FMenu','header','{\"1\": {\"title_2\": \"tttt222/1\"}, \"2\": {\"title_2\": null}}',1,0,27,1,NULL,'2023-01-12 18:54:00'),(8,'SMunu','footer','{\"1\": {\"price\": null}, \"2\": {\"price\": null}}',1,0,29,2,NULL,'2023-01-15 13:18:40');
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `templates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `templates` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fields` json DEFAULT NULL,
  `sort` bigint unsigned NOT NULL DEFAULT '1',
  `show` tinyint(1) NOT NULL DEFAULT '0',
  `template_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `templates_slug_unique` (`slug`),
  KEY `templates_template_id_foreign` (`template_id`),
  CONSTRAINT `templates_template_id_foreign` FOREIGN KEY (`template_id`) REFERENCES `templates` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `templates` WRITE;
/*!40000 ALTER TABLE `templates` DISABLE KEYS */;
INSERT INTO `templates` VALUES (21,'Level Two','level-two','page','http://admin-panel/storage/template/level-two.bmp','[{\"name\": \"title-lt\", \"type\": \"input\", \"label\": \"Title LT\"}, {\"name\": \"description-lt\", \"type\": \"textarea\", \"label\": \"Description LT\"}]',1,1,NULL,'2023-01-09 14:53:31','2023-01-13 15:00:54'),(22,NULL,NULL,NULL,NULL,'[{\"name\": \"title\", \"type\": \"input\", \"label\": \"Title\"}, {\"name\": \"description\", \"type\": \"textarea\", \"label\": \"Description\"}, {\"name\": \"price\", \"type\": \"input\", \"label\": \"Price\"}]',1,0,21,'2023-01-09 15:13:07','2023-01-09 15:19:53'),(23,'Template Menu','template-menu','menu','http://admin-panel/storage/template/template-menu.jpg','[{\"name\": \"tittle\", \"type\": \"input\", \"label\": \"Title\"}, {\"name\": \"view\", \"type\": \"input\", \"label\": \"View\"}]',1,1,NULL,'2023-01-10 14:04:48','2023-01-13 16:44:51'),(26,'Template Menu 2','template-menu-2','menu','http://admin-panel/storage/template/template-menu-2.jpg','[{\"name\": \"title\", \"type\": \"input\", \"label\": \"Title\"}, {\"name\": \"desc\", \"type\": \"textarea\", \"label\": \"Desc\"}]',0,1,NULL,'2023-01-12 13:23:02','2023-01-13 16:44:51'),(27,NULL,NULL,NULL,NULL,'[{\"name\": \"title_2\", \"type\": \"input\", \"label\": \"Title level two\"}]',1,0,23,'2023-01-12 17:16:47','2023-01-12 17:17:36'),(28,NULL,NULL,NULL,NULL,'[{\"name\": \"title_3\", \"type\": \"input\", \"label\": \"Title level three\"}]',1,0,27,'2023-01-12 17:17:07','2023-01-12 17:17:36'),(29,NULL,NULL,NULL,NULL,'[{\"name\": \"price\", \"type\": \"input\", \"label\": \"Price\"}]',1,0,26,'2023-01-12 17:41:12','2023-01-12 17:41:26');
/*!40000 ALTER TABLE `templates` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `blocks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `blocks` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `option` json DEFAULT NULL,
  `sort` tinyint unsigned NOT NULL DEFAULT '1',
  `show` tinyint(1) NOT NULL DEFAULT '0',
  `page_id` bigint unsigned DEFAULT NULL,
  `template_id` bigint unsigned NOT NULL,
  `block_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `blocks_page_id_foreign` (`page_id`),
  KEY `blocks_template_id_foreign` (`template_id`),
  KEY `blocks_block_id_foreign` (`block_id`),
  CONSTRAINT `blocks_block_id_foreign` FOREIGN KEY (`block_id`) REFERENCES `blocks` (`id`) ON DELETE CASCADE,
  CONSTRAINT `blocks_page_id_foreign` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE,
  CONSTRAINT `blocks_template_id_foreign` FOREIGN KEY (`template_id`) REFERENCES `templates` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `blocks` WRITE;
/*!40000 ALTER TABLE `blocks` DISABLE KEYS */;
INSERT INTO `blocks` VALUES (6,NULL,'{\"1\": {\"title-lt\": null, \"description-lt\": null}, \"2\": {\"title-lt\": null, \"description-lt\": null}}',0,0,2,21,NULL,'2023-01-12 17:59:14','2023-01-15 11:38:04'),(7,NULL,'{\"1\": {\"title-lt\": null, \"description-lt\": null}, \"2\": {\"title-lt\": null, \"description-lt\": null}}',1,0,1,21,NULL,'2023-01-12 18:00:05','2023-01-15 13:37:43'),(8,NULL,'{\"1\": {\"price\": \"1\", \"title\": \"111\", \"description\": \"111\"}, \"2\": {\"price\": null, \"title\": null, \"description\": null}}',1,0,NULL,22,7,NULL,'2023-01-15 13:37:43'),(9,NULL,'{\"1\": {\"price\": \"2\", \"title\": \"222\", \"description\": \"222\"}, \"2\": {\"price\": null, \"title\": null, \"description\": null}}',1,0,NULL,22,7,NULL,'2023-01-15 13:37:43'),(10,NULL,'{\"1\": {\"price\": \"3\", \"title\": \"333\", \"description\": \"333\"}, \"2\": {\"price\": null, \"title\": null, \"description\": null}}',1,0,NULL,22,7,NULL,'2023-01-15 13:37:43');
/*!40000 ALTER TABLE `blocks` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

