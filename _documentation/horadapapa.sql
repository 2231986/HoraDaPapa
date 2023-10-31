-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 31-Out-2023 às 21:16
-- Versão do servidor: 8.0.31
-- versão do PHP: 8.2.0
SET
  SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

START TRANSACTION;

SET
  time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;

/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */
;

/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */
;

/*!40101 SET NAMES utf8mb4 */
;

--
-- Banco de dados: `horadapapa`
--
-- --------------------------------------------------------
--
-- Estrutura da tabela `auth_assignment`
--
DROP TABLE IF EXISTS `auth_assignment`;

CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `user_id` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` int DEFAULT NULL,
  PRIMARY KEY (`item_name`, `user_id`),
  KEY `idx-auth_assignment-user_id` (`user_id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `auth_assignment`
--
INSERT INTO
  `auth_assignment` (`item_name`, `user_id`, `created_at`)
VALUES
  ('admin', '1', 1697275759),
  ('client', '1', 1697488914),
  ('client', '2', 1698258089),
  ('client', '3', 1698258715),
  ('client', '4', 1698258980),
  ('client', '5', 1697306197),
  ('cooker', '2', 1697275759),
  ('waiter', '3', 1697275759);

-- --------------------------------------------------------
--
-- Estrutura da tabela `auth_item`
--
DROP TABLE IF EXISTS `auth_item`;

CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `type` smallint NOT NULL,
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `rule_name` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int DEFAULT NULL,
  `updated_at` int DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `auth_item`
--
INSERT INTO
  `auth_item` (
    `name`,
    `type`,
    `description`,
    `rule_name`,
    `data`,
    `created_at`,
    `updated_at`
  )
VALUES
  (
    'admin',
    1,
    NULL,
    NULL,
    NULL,
    1697275759,
    1697275759
  ),
  (
    'client',
    1,
    NULL,
    NULL,
    NULL,
    1697275759,
    1697275759
  ),
  (
    'cooker',
    1,
    NULL,
    NULL,
    NULL,
    1697275759,
    1697275759
  ),
  (
    'managePlate',
    2,
    'Gere um Prato',
    NULL,
    NULL,
    1697275759,
    1697275759
  ),
  (
    'waiter',
    1,
    NULL,
    NULL,
    NULL,
    1697275759,
    1697275759
  );

-- --------------------------------------------------------
--
-- Estrutura da tabela `auth_item_child`
--
DROP TABLE IF EXISTS `auth_item_child`;

CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `child` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`, `child`),
  KEY `child` (`child`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `auth_item_child`
--
INSERT INTO
  `auth_item_child` (`parent`, `child`)
VALUES
  ('admin', 'managePlate'),
  ('cooker', 'managePlate');

-- --------------------------------------------------------
--
-- Estrutura da tabela `auth_rule`
--
DROP TABLE IF EXISTS `auth_rule`;

CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int DEFAULT NULL,
  `updated_at` int DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- --------------------------------------------------------
--
-- Estrutura da tabela `dinner`
--
DROP TABLE IF EXISTS `dinner`;

CREATE TABLE IF NOT EXISTS `dinner` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'id da mesa',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'nome da mesa',
  `isClean` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'estado da mesa',
  `date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'date',
  PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = 'Mesa que o cliente irá se sentar';

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
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = 'Pratos favoritos do Cliente';

-- --------------------------------------------------------
--
-- Estrutura da tabela `help_ticket`
--
DROP TABLE IF EXISTS `help_ticket`;

CREATE TABLE IF NOT EXISTS `help_ticket` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'id do ticket',
  `id_user` int NOT NULL COMMENT 'id utilizador que fez ticket',
  `needHelp` tinyint(1) NOT NULL COMMENT 'estado da ajuda',
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'descrição do pedido de ajuda',
  `date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'data',
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  KEY `status` (`needHelp`) USING BTREE
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = 'Pedido de ajuda do cliente';

-- --------------------------------------------------------
--
-- Estrutura da tabela `invoice`
--
DROP TABLE IF EXISTS `invoice`;

CREATE TABLE IF NOT EXISTS `invoice` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'id da fatura',
  `price` decimal(6, 2) NOT NULL COMMENT 'preço final',
  `meal_id` int NOT NULL COMMENT 'id da refeição',
  `date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'data',
  `nif` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'número fiscal do cliente',
  PRIMARY KEY (`id`),
  KEY `meal_id` (`meal_id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = 'Fatura';

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
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = 'A Meal é quem vai aglomerar todos os Requests feitos durante a refeição';

-- --------------------------------------------------------
--
-- Estrutura da tabela `migration`
--
DROP TABLE IF EXISTS `migration`;

CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apply_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE = MyISAM DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `migration`
--
INSERT INTO
  `migration` (`version`, `apply_time`)
VALUES
  ('m000000_000000_base', 1696446333),
  ('m130524_201442_init', 1696446341),
  (
    'm190124_110200_add_verification_token_column_to_user_table',
    1696446341
  );

-- --------------------------------------------------------
--
-- Estrutura da tabela `plate`
--
DROP TABLE IF EXISTS `plate`;

CREATE TABLE IF NOT EXISTS `plate` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'id do prato',
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'descrição do prato',
  `price` decimal(6, 2) NOT NULL COMMENT 'preço do prato',
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'titulo do prato',
  `date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'data',
  PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 2 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = 'O objeto Prato';

--
-- Extraindo dados da tabela `plate`
--
INSERT INTO
  `plate` (
    `id`,
    `description`,
    `price`,
    `title`,
    `date_time`
  )
VALUES
  (1, 'arroz', '5.00', '', '2023-10-30 21:26:25');

-- --------------------------------------------------------
--
-- Estrutura da tabela `request`
--
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
  KEY `user_id` (`user_id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = 'Pedido de comida feito pelo cliente';

-- --------------------------------------------------------
--
-- Estrutura da tabela `user`
--
DROP TABLE IF EXISTS `user`;

CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `auth_key` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_hash` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` smallint NOT NULL DEFAULT '10',
  `created_at` int NOT NULL,
  `updated_at` int NOT NULL,
  `verification_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE = InnoDB AUTO_INCREMENT = 5 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `user`
--
INSERT INTO
  `user` (
    `id`,
    `username`,
    `auth_key`,
    `password_hash`,
    `password_reset_token`,
    `email`,
    `status`,
    `created_at`,
    `updated_at`,
    `verification_token`
  )
VALUES
  (
    1,
    'Dinis',
    'UPFEzZ_a0tjVrtelAsjWqVPFHu8lKW3i',
    '$2y$13$92kaCka.Q5lVo9lUcaaoJ.ONjZu4haHFsNLlfCnCDg/SjfoUNl6Ni',
    NULL,
    'dinis@ipl.com',
    10,
    1697488914,
    1697488914,
    'OszSJNjNOTqPmRnwglpt9NOhq2og_GFZ_1697488914'
  ),
  (
    2,
    'Alfredo',
    'B5VJqOc4uPONNcO84lCK0ETjVeCNxwfW',
    '$2y$13$jB3nupyhkZ4Ct3UB4bbEi.Dl//huAF5p/TY1tlTTi7Ow07s26ruQS',
    NULL,
    'alfredo@horapapa.com',
    9,
    1698258089,
    1698258089,
    'PHirunXMv6_UilBrtehRnlvBtBLL6TdW_1698258089'
  ),
  (
    3,
    'Alfredo2',
    'QR68wpUXw_WE76YuCdjHLILn5h9STgM8',
    '$2y$13$460MgIlEebi7GFK3XSve5OrX6.V2t3XffHvMQwxkIFE5QbYcCmX3S',
    NULL,
    'alfredo2@horapapa.com',
    9,
    1698258715,
    1698258715,
    'jyk_jPF9GzwJ-n6gq4r4hJTDebLLwowM_1698258715'
  ),
  (
    4,
    'Alfredo3',
    'u6q_WGjbuAXZq_f7mQF6tpCTW-1a2wcS',
    '$2y$13$2v2zMKkXUESg3ahELv.Y5.iJgqk7IajdBAmufFOJIWK6yKKQ2RrGq',
    NULL,
    'alfredo3@horapapa.com',
    10,
    1698258980,
    1698258980,
    't0DSc0MIVJI3vXFE8B36G4V_rAW0BG4K_1698258980'
  );

-- --------------------------------------------------------
--
-- Estrutura da tabela `user_info`
--
DROP TABLE IF EXISTS `user_info`;

CREATE TABLE IF NOT EXISTS `user_info` (
  `user_id` int NOT NULL COMMENT 'id do user',
  `nif` varchar(9) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'número fiscal do cliente',
  `nome` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'nome do cliente',
  `apelido` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'último nome do cliente',
  PRIMARY KEY (`user_id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = 'Armazena informações extra do utilizador';

--
-- Restrições para despejos de tabelas
--
--
-- Limitadores para a tabela `auth_assignment`
--
ALTER TABLE
  `auth_assignment`
ADD
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `auth_item`
--
ALTER TABLE
  `auth_item`
ADD
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE
SET
  NULL ON UPDATE CASCADE;

--
-- Limitadores para a tabela `auth_item_child`
--
ALTER TABLE
  `auth_item_child`
ADD
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `favorite`
--
ALTER TABLE
  `favorite`
ADD
  CONSTRAINT `fk_favorite_plate_id` FOREIGN KEY (`plate_id`) REFERENCES `plate` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
ADD
  CONSTRAINT `fk_favorite_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Limitadores para a tabela `help_ticket`
--
ALTER TABLE
  `help_ticket`
ADD
  CONSTRAINT `FK_help_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Limitadores para a tabela `invoice`
--
ALTER TABLE
  `invoice`
ADD
  CONSTRAINT `fk_meal` FOREIGN KEY (`meal_id`) REFERENCES `meal` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Limitadores para a tabela `meal`
--
ALTER TABLE
  `meal`
ADD
  CONSTRAINT `fk_dinner_table` FOREIGN KEY (`dinner_table_id`) REFERENCES `dinner` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Limitadores para a tabela `request`
--
ALTER TABLE
  `request`
ADD
  CONSTRAINT `fk_meal_id` FOREIGN KEY (`meal_id`) REFERENCES `meal` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
ADD
  CONSTRAINT `fk_plate_id` FOREIGN KEY (`plate_id`) REFERENCES `plate` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
ADD
  CONSTRAINT `fk_request_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Limitadores para a tabela `user_info`
--
ALTER TABLE
  `user_info`
ADD
  CONSTRAINT `fk_user_info` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;

/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;

/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;