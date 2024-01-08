-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 08-Jan-2024 às 20:02
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
  `item_name` varchar(64) COLLATE utf8mb3_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` int DEFAULT NULL,
  PRIMARY KEY (`item_name`, `user_id`),
  KEY `idx-auth_assignment-user_id` (`user_id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb3 COLLATE = utf8mb3_unicode_ci;

--
-- Extraindo dados da tabela `auth_assignment`
--
INSERT INTO
  `auth_assignment` (`item_name`, `user_id`, `created_at`)
VALUES
  ('admin', '1', 1704643081),
  ('client', '4', 1704643081),
  ('client', '5', 1704643606),
  ('client', '6', 1704647777),
  ('cooker', '2', 1704643081),
  ('waiter', '3', 1704643081);

-- --------------------------------------------------------
--
-- Estrutura da tabela `auth_item`
--
DROP TABLE IF EXISTS `auth_item`;

CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` varchar(64) COLLATE utf8mb3_unicode_ci NOT NULL,
  `type` smallint NOT NULL,
  `description` text COLLATE utf8mb3_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int DEFAULT NULL,
  `updated_at` int DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb3 COLLATE = utf8mb3_unicode_ci;

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
    'Administrador',
    NULL,
    NULL,
    1704643081,
    1704643081
  ),
  (
    'client',
    1,
    'Cliente',
    NULL,
    NULL,
    1704643081,
    1704643081
  ),
  (
    'cooker',
    1,
    'Cozinheiro',
    NULL,
    NULL,
    1704643081,
    1704643081
  ),
  (
    'manageDinner',
    2,
    'Mesa que o cliente irá se sentar',
    NULL,
    NULL,
    1704643081,
    1704643081
  ),
  (
    'manageFavorite',
    2,
    'Pratos favoritos do Cliente',
    NULL,
    NULL,
    1704643081,
    1704643081
  ),
  (
    'manageHelpticket',
    2,
    'Pedido de ajuda do cliente',
    NULL,
    NULL,
    1704643081,
    1704643081
  ),
  (
    'manageInvoice',
    2,
    'Gere uma Fatura',
    NULL,
    NULL,
    1704643081,
    1704643081
  ),
  (
    'manageMeal',
    2,
    'Gere as refeições dos clientes',
    NULL,
    NULL,
    1704643081,
    1704643081
  ),
  (
    'managePlate',
    2,
    'Gere um Prato',
    NULL,
    NULL,
    1704643081,
    1704643081
  ),
  (
    'manageRequest',
    2,
    'Gere um Pedido de um Prato',
    NULL,
    NULL,
    1704643081,
    1704643081
  ),
  (
    'manageReview',
    2,
    'Gere todos os fornecedores',
    NULL,
    NULL,
    1704643081,
    1704643081
  ),
  (
    'manageSupplier',
    2,
    'Gere todos os fornecedores',
    NULL,
    NULL,
    1704643081,
    1704643081
  ),
  (
    'manageUser',
    2,
    'Gere todos os utilizadores',
    NULL,
    NULL,
    1704643081,
    1704643081
  ),
  (
    'waiter',
    1,
    'Garçon',
    NULL,
    NULL,
    1704643081,
    1704643081
  );

-- --------------------------------------------------------
--
-- Estrutura da tabela `auth_item_child`
--
DROP TABLE IF EXISTS `auth_item_child`;

CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) COLLATE utf8mb3_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`, `child`),
  KEY `child` (`child`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb3 COLLATE = utf8mb3_unicode_ci;

--
-- Extraindo dados da tabela `auth_item_child`
--
INSERT INTO
  `auth_item_child` (`parent`, `child`)
VALUES
  ('admin', 'manageDinner'),
  ('waiter', 'manageDinner'),
  ('admin', 'manageFavorite'),
  ('client', 'manageFavorite'),
  ('admin', 'manageHelpticket'),
  ('client', 'manageHelpticket'),
  ('waiter', 'manageHelpticket'),
  ('admin', 'manageInvoice'),
  ('client', 'manageInvoice'),
  ('waiter', 'manageInvoice'),
  ('admin', 'manageMeal'),
  ('waiter', 'manageMeal'),
  ('admin', 'managePlate'),
  ('cooker', 'managePlate'),
  ('admin', 'manageRequest'),
  ('client', 'manageRequest'),
  ('cooker', 'manageRequest'),
  ('waiter', 'manageRequest'),
  ('admin', 'manageReview'),
  ('client', 'manageReview'),
  ('admin', 'manageSupplier'),
  ('cooker', 'manageSupplier'),
  ('admin', 'manageUser'),
  ('client', 'manageUser'),
  ('cooker', 'manageUser'),
  ('waiter', 'manageUser');

-- --------------------------------------------------------
--
-- Estrutura da tabela `auth_rule`
--
DROP TABLE IF EXISTS `auth_rule`;

CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) COLLATE utf8mb3_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int DEFAULT NULL,
  `updated_at` int DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb3 COLLATE = utf8mb3_unicode_ci;

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
) ENGINE = InnoDB AUTO_INCREMENT = 5 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = 'Mesa que o cliente irá se sentar';

--
-- Extraindo dados da tabela `dinner`
--
INSERT INTO
  `dinner` (`id`, `name`, `isClean`, `date_time`)
VALUES
  (1, 'Mesa VIP', 0, '2024-01-07 16:39:38'),
  (2, 'Mesa Esquerda', 1, '2024-01-07 16:39:54'),
  (3, 'Mesa Direita', 1, '2024-01-07 16:40:05'),
  (4, 'Mesa Centro', 1, '2024-01-07 16:40:33');

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
) ENGINE = InnoDB AUTO_INCREMENT = 4 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = 'Pratos favoritos do Cliente';

--
-- Extraindo dados da tabela `favorite`
--
INSERT INTO
  `favorite` (`id`, `plate_id`, `date_time`, `user_id`)
VALUES
  (1, 3, '2024-01-07 17:14:25', 5),
  (2, 1, '2024-01-07 17:15:05', 4),
  (3, 3, '2024-01-07 17:15:14', 4);

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
) ENGINE = InnoDB AUTO_INCREMENT = 2 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = 'Pedido de ajuda do cliente';

--
-- Extraindo dados da tabela `help_ticket`
--
INSERT INTO
  `help_ticket` (
    `id`,
    `user_id`,
    `needHelp`,
    `description`,
    `date_time`
  )
VALUES
  (
    1,
    5,
    0,
    'Gostava de saber se aceitam MB Way',
    '2024-01-07 16:17:34'
  );

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
  `user_id` int DEFAULT NULL COMMENT 'id do utilizador',
  PRIMARY KEY (`id`),
  KEY `meal_id` (`meal_id`),
  KEY `fk_invoice_user_id` (`user_id`)
) ENGINE = InnoDB AUTO_INCREMENT = 2 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = 'Fatura';

--
-- Extraindo dados da tabela `invoice`
--
INSERT INTO
  `invoice` (`id`, `price`, `meal_id`, `date_time`, `user_id`)
VALUES
  (1, '11.42', 1, '2024-01-08 19:58:39', NULL);

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
) ENGINE = InnoDB AUTO_INCREMENT = 4 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = 'A Meal é quem vai aglomerar todos os Requests feitos durante a refeição';

--
-- Extraindo dados da tabela `meal`
--
INSERT INTO
  `meal` (`id`, `dinner_table_id`, `checkout`, `date_time`)
VALUES
  (1, 1, 1, '2024-01-08 19:56:27'),
  (2, 2, 0, '2024-01-08 19:59:48'),
  (3, 3, 0, '2024-01-08 20:00:09');

-- --------------------------------------------------------
--
-- Estrutura da tabela `migration`
--
DROP TABLE IF EXISTS `migration`;

CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apply_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `migration`
--
INSERT INTO
  `migration` (`version`, `apply_time`)
VALUES
  ('m140506_102106_rbac_init', 1704643076),
  (
    'm170907_052038_rbac_add_index_on_auth_assignment_user_id',
    1704643076
  ),
  (
    'm180523_151638_rbac_updates_indexes_without_prefix',
    1704643076
  ),
  (
    'm200409_110543_rbac_update_mssql_trigger',
    1704643076
  );

-- --------------------------------------------------------
--
-- Estrutura da tabela `plate`
--
DROP TABLE IF EXISTS `plate`;

CREATE TABLE IF NOT EXISTS `plate` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'id do prato',
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'descrição do prato',
  `price` decimal(6, 2) NOT NULL COMMENT 'preço do prato',
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'titulo do prato',
  `date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'data',
  `image_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'nome da imagem',
  `supplier_id` int NOT NULL COMMENT 'id do fornecedor',
  PRIMARY KEY (`id`),
  KEY `fk_plateID_supplierID` (`supplier_id`)
) ENGINE = InnoDB AUTO_INCREMENT = 7 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = 'O objeto Prato';

--
-- Extraindo dados da tabela `plate`
--
INSERT INTO
  `plate` (
    `id`,
    `description`,
    `price`,
    `title`,
    `date_time`,
    `image_name`,
    `supplier_id`
  )
VALUES
  (
    1,
    'As “Caralhotas de Almeirim” são pequenos pães, com um diâmetro médio de 15 cm, de forma arredondada, côdea quebradiça e estaladiça, de tonalidade acastanhada, e miolo rústico, com olhos pequenos a médios.',
    '6.43',
    'Caralhotas de Almeirim',
    '2024-01-07 16:20:19',
    '46b48124d90c7d0d0558c0160d9e4d74.jpg',
    1
  ),
  (
    2,
    'A designação “Sopa Caramela” remonta aos séc. XVIII/XIX e foi trazida pelas/os trabalhadoras/es rurais, provenientes das áreas da Beira Litoral e do Baixo Mondego, que se deslocavam sazonalmente, para as propriedades agrícolas da região.',
    '16.99',
    'Sopa Caramela',
    '2024-01-07 16:22:37',
    '1a4dcf9f8cc13210a4b3d1ef50926367.jpg',
    1
  ),
  (
    3,
    'Aragonez 35% | Alicante Bouschet 35% | Syrah 10% | Trincadeira 10% | Castelão 10%',
    '30.00',
    'Chão das Rolas Tinto',
    '2024-01-07 16:28:52',
    '782c5111af1c466c3229e8d8026a8470.jpg',
    2
  ),
  (
    4,
    'Vinho regional dos Produtores locais de vinhas e pomares misturado com uma boa dose de bagaço.',
    '7.99',
    'Vinho da Casa',
    '2024-01-07 16:34:23',
    NULL,
    2
  ),
  (
    5,
    'Principal concorrente ao famoso BigMac.',
    '4.99',
    'Hamburguer da Casa',
    '2024-01-07 16:36:40',
    '1f3d236935201fdb54599af4aed28ae7.jpg',
    1
  ),
  (
    6,
    'Este prato é composto apenas por Peixes selecionados individualmente, provenientes apenas de rios portugueses.',
    '19.99',
    'Mariscada do Continente',
    '2024-01-07 16:38:30',
    'dc5b008559ec15a6e74ae566956d2548.jpg',
    1
  );

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
  `price` decimal(6, 2) NOT NULL COMMENT 'preço do prato',
  `quantity` int NOT NULL DEFAULT '1' COMMENT 'quantidade de pratos',
  PRIMARY KEY (`id`),
  KEY `meal_id` (`meal_id`),
  KEY `plate_id` (`plate_id`),
  KEY `isCooked` (`isCooked`),
  KEY `isDelivered` (`isDelivered`),
  KEY `user_id` (`user_id`)
) ENGINE = InnoDB AUTO_INCREMENT = 6 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = 'Pedido de comida feito pelo cliente';

--
-- Extraindo dados da tabela `request`
--
INSERT INTO
  `request` (
    `id`,
    `meal_id`,
    `observation`,
    `plate_id`,
    `isCooked`,
    `isDelivered`,
    `user_id`,
    `date_time`,
    `price`,
    `quantity`
  )
VALUES
  (
    1,
    1,
    '',
    1,
    1,
    1,
    4,
    '2024-01-08 19:57:05',
    '6.43',
    1
  ),
  (
    2,
    1,
    '',
    5,
    1,
    1,
    5,
    '2024-01-08 19:58:18',
    '4.99',
    1
  ),
  (
    3,
    2,
    '',
    6,
    1,
    0,
    4,
    '2024-01-08 20:00:37',
    '19.99',
    1
  ),
  (
    4,
    2,
    '',
    4,
    1,
    1,
    5,
    '2024-01-08 20:01:02',
    '7.99',
    1
  ),
  (
    5,
    3,
    '',
    2,
    0,
    0,
    6,
    '2024-01-08 20:01:29',
    '16.99',
    2
  );

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
) ENGINE = InnoDB AUTO_INCREMENT = 3 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = 'Review de um Prato';

--
-- Extraindo dados da tabela `review`
--
INSERT INTO
  `review` (
    `id`,
    `user_id`,
    `plate_id`,
    `description`,
    `value`,
    `date_time`
  )
VALUES
  (
    1,
    5,
    1,
    'Melhor pão que alguma vez provei.',
    9,
    '2024-01-07 16:53:29'
  ),
  (
    2,
    4,
    1,
    'Achei caro para o produto apresentado.',
    2,
    '2024-01-07 16:55:29'
  );

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
) ENGINE = InnoDB AUTO_INCREMENT = 3 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = 'Fornecedores de pratos';

--
-- Extraindo dados da tabela `supplier`
--
INSERT INTO
  `supplier` (`id`, `name`, `nif`)
VALUES
  (1, 'Pingo Amargo', '765936745'),
  (2, 'Estado Sólido', '143562913');

-- --------------------------------------------------------
--
-- Estrutura da tabela `user`
--
DROP TABLE IF EXISTS `user`;

CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8mb3_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `status` smallint NOT NULL DEFAULT '10',
  `created_at` int NOT NULL,
  `updated_at` int NOT NULL,
  `verification_token` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE = InnoDB AUTO_INCREMENT = 7 DEFAULT CHARSET = utf8mb3 COLLATE = utf8mb3_unicode_ci;

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
    'admin',
    '4uu8kenq0myS44k1YOrW218BvwQb_kCb',
    '$2y$13$6pFi.dv8mCPrcOtZeSEVDerWQICyHyf8EP9PSLxlVWaSg6YrrOluO',
    NULL,
    'admin@horadapapa.com',
    10,
    1704643272,
    1704643272,
    '4EicWO_Ig8NCyPdT1RmMBWTliEd78Iva_1704643272'
  ),
  (
    2,
    'cooker',
    'K7Wy9eV4qlaRYrTnnjgI-DM8AZbcl_-E',
    '$2y$13$ZpOPN8rAiW6Wp8abqWIsU.pnj2.aELIACHkApGJRp6.PuixmFjK8a',
    NULL,
    'cooker@horadapapa.com',
    10,
    1704643322,
    1704643322,
    'XpM8dv_RrSPr11zFO4-vKdvP-TfrCPBD_1704643322'
  ),
  (
    3,
    'waiter',
    '9H6dv7uVQWAE4yF7hOXGI9Og5Y8JeToA',
    '$2y$13$fRYfEA8yp55cWWJjP3Hal.bLBnKN7LIK/WN6RK6tCGtG91qptLJqC',
    NULL,
    'waiter@horadapapa.com',
    10,
    1704643343,
    1704643343,
    'pidiRmhOPM1pJnHauZ3x52sXil9QmZSi_1704643343'
  ),
  (
    4,
    'client1',
    'kNHeIeMoOxsQP0Or32HQzgilSrl_9Qfs',
    '$2y$13$qj1JDESUK/Ce.6kEJmhJ/O1GAvDzwvaTMegxeXwTBIGklGNtoMn.6',
    NULL,
    'client1@horadapapa.com',
    10,
    1704643447,
    1704643447,
    '4aUb8coGoY1LeQwK5I2Vnn49paeCfJZj_1704643447'
  ),
  (
    5,
    'client2',
    'vypXcDJKgEqaAu7opjcBVrhC4OOUf7As',
    '$2y$13$SAxuHoJMyq/mFcvkMgBE7OX6HzFRM6a.npIUrxmfcUZEEPzqRCp2q',
    NULL,
    'client2@horadapapa.com',
    10,
    1704643606,
    1704643606,
    '4nrzTHyPBN4qHB95cEfNEhw2QeeqOKUz_1704643606'
  ),
  (
    6,
    'client',
    '11Vo_M9h6b2BEkStzkK-saD7KtWk-_cX',
    '$2y$13$cKl3Y6DmVBKUOK8qSLSKnesDBcyk0ph5aTdnyEvHdKD3KiSB8BtRW',
    NULL,
    'client@horadapapa.com',
    10,
    1704647777,
    1704647777,
    'uypaV_YqyUT1NO1klAb_EOt69cR4Krm0_1704647777'
  );

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
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = 'Armazena informações extra do utilizador';

--
-- Extraindo dados da tabela `user_info`
--
INSERT INTO
  `user_info` (`user_id`, `nif`, `name`, `surname`)
VALUES
  (1, '', 'Administrador', ''),
  (2, '', 'Cozinheiro', ''),
  (3, '', 'Garçon', ''),
  (4, '768456987', 'Santa', 'Mônica'),
  (5, '759175849', 'Santa', 'Catarina'),
  (6, '756867192', 'Meu Cliente', 'Cliente Default');

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
  CONSTRAINT `FK_help_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Limitadores para a tabela `invoice`
--
ALTER TABLE
  `invoice`
ADD
  CONSTRAINT `fk_invoice_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
ADD
  CONSTRAINT `fk_meal` FOREIGN KEY (`meal_id`) REFERENCES `meal` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Limitadores para a tabela `plate`
--
ALTER TABLE
  `plate`
ADD
  CONSTRAINT `fk_plateID_supplierID` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

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
-- Limitadores para a tabela `review`
--
ALTER TABLE
  `review`
ADD
  CONSTRAINT `fk_plateID_reviewID` FOREIGN KEY (`plate_id`) REFERENCES `plate` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
ADD
  CONSTRAINT `fk_userID_reviewID` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

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