-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 07-Dez-2023 às 19:00
-- Versão do servidor: 8.0.31
-- versão do PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `horadapapa`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `dinner`
--

DROP TABLE IF EXISTS `dinner`;
CREATE TABLE IF NOT EXISTS `dinner` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'id da mesa',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'nome da mesa',
  `isClean` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'estado da mesa',
  `date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'date',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Mesa que o cliente irá se sentar';

-- --------------------------------------------------------

--
-- Estrutura da tabela `favorite`
--

DROP TABLE IF EXISTS `favorite`;
CREATE TABLE IF NOT EXISTS `favorite` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'id do favorito',
  `plate_id` int NOT NULL COMMENT 'id do prato',
  `date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'data',
  `user_id` int NOT NULL COMMENT 'id do utilizador',
  PRIMARY KEY (`id`),
  KEY `plate_id` (`plate_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Pratos favoritos do Cliente';

-- --------------------------------------------------------

--
-- Estrutura da tabela `help_ticket`
--

DROP TABLE IF EXISTS `help_ticket`;
CREATE TABLE IF NOT EXISTS `help_ticket` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'id do ticket',
  `user_id` int NOT NULL COMMENT 'id utilizador que fez ticket',
  `needHelp` tinyint(1) NOT NULL COMMENT 'estado da ajuda',
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'descrição do pedido de ajuda',
  `date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'data',
  PRIMARY KEY (`id`),
  KEY `status` (`needHelp`) USING BTREE,
  KEY `id_user` (`user_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Pedido de ajuda do cliente';

-- --------------------------------------------------------

--
-- Estrutura da tabela `invoice`
--

DROP TABLE IF EXISTS `invoice`;
CREATE TABLE IF NOT EXISTS `invoice` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'id da fatura',
  `price` decimal(6,2) NOT NULL COMMENT 'preço final',
  `meal_id` int NOT NULL COMMENT 'id da refeição',
  `date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'data',
  `user_id` int DEFAULT NULL COMMENT 'id do utilizador',
  PRIMARY KEY (`id`),
  KEY `meal_id` (`meal_id`),
  KEY `fk_invoice_user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Fatura';

-- --------------------------------------------------------

--
-- Estrutura da tabela `meal`
--

DROP TABLE IF EXISTS `meal`;
CREATE TABLE IF NOT EXISTS `meal` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'id da refeição',
  `dinner_table_id` int NOT NULL COMMENT 'id da mesa',
  `checkout` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'estado do pagamento',
  `date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'data de criação',
  PRIMARY KEY (`id`),
  KEY `dinner_table_id` (`dinner_table_id`),
  KEY `checkout` (`checkout`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='A Meal é quem vai aglomerar todos os Requests feitos durante a refeição';

-- --------------------------------------------------------

--
-- Estrutura da tabela `migration`
--

DROP TABLE IF EXISTS `migration`;
CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `plate`
--

DROP TABLE IF EXISTS `plate`;
CREATE TABLE IF NOT EXISTS `plate` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'id do prato',
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'descrição do prato',
  `price` decimal(6,2) NOT NULL COMMENT 'preço do prato',
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'titulo do prato',
  `date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'data',
  `image_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'nome da imagem',
  `supplier_id` int NOT NULL COMMENT 'id do fornecedor',
  PRIMARY KEY (`id`),
  KEY `fk_plateID_supplierID` (`supplier_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='O objeto Prato';

-- --------------------------------------------------------

--
-- Estrutura da tabela `request`
--

DROP TABLE IF EXISTS `request`;
CREATE TABLE IF NOT EXISTS `request` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'id do pedido',
  `meal_id` int NOT NULL COMMENT 'id da refeição',
  `observation` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'comentários extra',
  `plate_id` int NOT NULL COMMENT 'id do prato',
  `isCooked` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'estado do cozinheiro',
  `isDelivered` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'estado do garçon',
  `user_id` int NOT NULL COMMENT 'id do utilizador',
  `date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'data',
  `price` decimal(6,2) NOT NULL COMMENT 'preço do prato',
  `quantity` int NOT NULL DEFAULT '1' COMMENT 'quantidade de pratos',
  PRIMARY KEY (`id`),
  KEY `meal_id` (`meal_id`),
  KEY `plate_id` (`plate_id`),
  KEY `isCooked` (`isCooked`),
  KEY `isDelivered` (`isDelivered`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Pedido de comida feito pelo cliente';

-- --------------------------------------------------------

--
-- Estrutura da tabela `review`
--

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
  KEY `fk_userID_reviewID` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Review de um Prato';

-- --------------------------------------------------------

--
-- Estrutura da tabela `supplier`
--

DROP TABLE IF EXISTS `supplier`;
CREATE TABLE IF NOT EXISTS `supplier` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'id do fornecedor',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'nome do fornecedor',
  `nif` varchar(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'número fiscal da empresa',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Fornecedores de pratos';

-- --------------------------------------------------------

--
-- Estrutura da tabela `user_info`
--

DROP TABLE IF EXISTS `user_info`;
CREATE TABLE IF NOT EXISTS `user_info` (
  `user_id` int NOT NULL COMMENT 'id do user',
  `nif` varchar(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'número fiscal do cliente',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'nome do cliente',
  `surname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'último nome do cliente',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Armazena informações extra do utilizador';

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `favorite`
--
ALTER TABLE `favorite`
  ADD CONSTRAINT `fk_favorite_plate_id` FOREIGN KEY (`plate_id`) REFERENCES `plate` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_favorite_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Limitadores para a tabela `help_ticket`
--
ALTER TABLE `help_ticket`
  ADD CONSTRAINT `FK_help_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Limitadores para a tabela `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `fk_invoice_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_meal` FOREIGN KEY (`meal_id`) REFERENCES `meal` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Limitadores para a tabela `meal`
--
ALTER TABLE `meal`
  ADD CONSTRAINT `fk_dinner_table` FOREIGN KEY (`dinner_table_id`) REFERENCES `dinner` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Limitadores para a tabela `plate`
--
ALTER TABLE `plate`
  ADD CONSTRAINT `fk_plateID_supplierID` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Limitadores para a tabela `request`
--
ALTER TABLE `request`
  ADD CONSTRAINT `fk_meal_id` FOREIGN KEY (`meal_id`) REFERENCES `meal` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_plate_id` FOREIGN KEY (`plate_id`) REFERENCES `plate` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_request_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Limitadores para a tabela `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `fk_plateID_reviewID` FOREIGN KEY (`plate_id`) REFERENCES `plate` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_userID_reviewID` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Limitadores para a tabela `user_info`
--
ALTER TABLE `user_info`
  ADD CONSTRAINT `fk_user_info` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
