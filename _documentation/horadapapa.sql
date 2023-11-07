-- --------------------------------------------------------
-- Anfitrião:                    127.0.0.1
-- Versão do servidor:           8.0.31 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Versão:              11.2.0.6213
-- --------------------------------------------------------
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;

/*!40101 SET NAMES utf8 */
;

/*!50503 SET NAMES utf8mb4 */
;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */
;

/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */
;

/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */
;

USE `horadapapa`;

-- Data exporting was unselected.
-- Dumping structure for table horadapapa.plate
DROP TABLE IF EXISTS `plate`;

CREATE TABLE IF NOT EXISTS `plate` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'id do prato',
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'descrição do prato',
  `price` decimal(6, 2) NOT NULL COMMENT 'preço do prato',
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'titulo do prato',
  `date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'data',
  `image_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'nome da imagem',
  PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 2 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = 'O objeto Prato';

-- Dumping structure for table horadapapa.dinner
DROP TABLE IF EXISTS `dinner`;

CREATE TABLE IF NOT EXISTS `dinner` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'id da mesa',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'nome da mesa',
  `isClean` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'estado da mesa',
  `date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'date',
  PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 2 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = 'Mesa que o cliente irá se sentar';

-- Data exporting was unselected.
-- Dumping structure for table horadapapa.favorite
DROP TABLE IF EXISTS `favorite`;

CREATE TABLE IF NOT EXISTS `favorite` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'id do favorito',
  `plate_id` int NOT NULL COMMENT 'id do prato',
  `date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'data',
  `user_id` int NOT NULL COMMENT 'id do utilizador',
  PRIMARY KEY (`id`),
  KEY `plate_id` (`plate_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `fk_favorite_plate_id` FOREIGN KEY (`plate_id`) REFERENCES `plate` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_favorite_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = 'Pratos favoritos do Cliente';

-- Data exporting was unselected.
-- Dumping structure for table horadapapa.help_ticket
DROP TABLE IF EXISTS `help_ticket`;

CREATE TABLE IF NOT EXISTS `help_ticket` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'id do ticket',
  `id_user` int NOT NULL COMMENT 'id utilizador que fez ticket',
  `needHelp` tinyint(1) NOT NULL COMMENT 'estado da ajuda',
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'descrição do pedido de ajuda',
  `date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'data',
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  KEY `status` (`needHelp`) USING BTREE,
  CONSTRAINT `FK_help_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 3 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = 'Pedido de ajuda do cliente';

-- Data exporting was unselected.
-- Dumping structure for table horadapapa.meal
DROP TABLE IF EXISTS `meal`;

CREATE TABLE IF NOT EXISTS `meal` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'id da refeição',
  `dinner_table_id` int NOT NULL COMMENT 'id da mesa',
  `checkout` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'estado do pagamento',
  `date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'data de criação',
  PRIMARY KEY (`id`),
  KEY `dinner_table_id` (`dinner_table_id`),
  KEY `checkout` (`checkout`),
  CONSTRAINT `fk_dinner_table` FOREIGN KEY (`dinner_table_id`) REFERENCES `dinner` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = 'A Meal é quem vai aglomerar todos os Requests feitos durante a refeição';

-- Data exporting was unselected.
-- Dumping structure for table horadapapa.invoice
DROP TABLE IF EXISTS `invoice`;

CREATE TABLE IF NOT EXISTS `invoice` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'id da fatura',
  `price` decimal(6, 2) NOT NULL COMMENT 'preço final',
  `meal_id` int NOT NULL COMMENT 'id da refeição',
  `date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'data',
  `nif` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'número fiscal do cliente',
  PRIMARY KEY (`id`),
  KEY `meal_id` (`meal_id`),
  CONSTRAINT `fk_meal` FOREIGN KEY (`meal_id`) REFERENCES `meal` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = 'Fatura';

-- Data exporting was unselected.
-- Dumping structure for table horadapapa.request
DROP TABLE IF EXISTS `request`;

CREATE TABLE IF NOT EXISTS `request` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'id do pedido',
  `meal_id` int NOT NULL COMMENT 'id da refeição',
  `observation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'comentários extra',
  `plate_id` int NOT NULL COMMENT 'id do prato',
  `isCooked` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'estado do cozinheiro',
  `isDelivered` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'estado do garçon',
  `user_id` int NOT NULL COMMENT 'id do utilizador',
  `date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'data',
  `price` decimal(6, 2) NOT NULL COMMENT 'preço do prato',
  PRIMARY KEY (`id`),
  KEY `meal_id` (`meal_id`),
  KEY `plate_id` (`plate_id`),
  KEY `isCooked` (`isCooked`),
  KEY `isDelivered` (`isDelivered`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `fk_meal_id` FOREIGN KEY (`meal_id`) REFERENCES `meal` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_plate_id` FOREIGN KEY (`plate_id`) REFERENCES `plate` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_request_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = 'Pedido de comida feito pelo cliente';

-- Data exporting was unselected.
-- Dumping structure for table horadapapa.review
DROP TABLE IF EXISTS `review`;

CREATE TABLE IF NOT EXISTS `review` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'id da review',
  `user_id` int NOT NULL COMMENT 'id do utilizador',
  `plate_id` int NOT NULL COMMENT 'id do prato',
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'descrição da review',
  `value` int NOT NULL COMMENT 'valor da review',
  `date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'data',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `fk_plateID_reviewID` (`plate_id`),
  KEY `fk_userID_reviewID` (`user_id`),
  CONSTRAINT `fk_plateID_reviewID` FOREIGN KEY (`plate_id`) REFERENCES `plate` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_userID_reviewID` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 2 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = 'Review de um Prato';

-- Data exporting was unselected.
-- Dumping structure for table horadapapa.supplier
DROP TABLE IF EXISTS `supplier`;

CREATE TABLE IF NOT EXISTS `supplier` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'id do fornecedor',
  `plate_id` int NOT NULL COMMENT 'id do prato',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'nome do fornecedor',
  `nif` varchar(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'número fiscal da empresa',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `fk_plateID_supplierID` (`plate_id`),
  CONSTRAINT `fk_plateID_supplierID` FOREIGN KEY (`plate_id`) REFERENCES `plate` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = 'Fornecedores de pratos';

-- Data exporting was unselected.
-- Dumping structure for table horadapapa.user_info
DROP TABLE IF EXISTS `user_info`;

CREATE TABLE IF NOT EXISTS `user_info` (
  `user_id` int NOT NULL COMMENT 'id do user',
  `nif` varchar(9) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'número fiscal do cliente',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'nome do cliente',
  `surname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'último nome do cliente',
  PRIMARY KEY (`user_id`),
  CONSTRAINT `fk_user_info` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = 'Armazena informações extra do utilizador';

-- Data exporting was unselected.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */
;

/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */
;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;

/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */
;