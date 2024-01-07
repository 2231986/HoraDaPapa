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

-- Dumping database structure for horadapapa
CREATE DATABASE IF NOT EXISTS `horadapapa`
/*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */
/*!80016 DEFAULT ENCRYPTION='N' */
;

USE `horadapapa`;

-- Dumping structure for table horadapapa.dinner
CREATE TABLE IF NOT EXISTS `dinner` (
    `id` int NOT NULL AUTO_INCREMENT COMMENT 'id da mesa',
    `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'nome da mesa',
    `isClean` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'estado da mesa',
    `date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'date',
    PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 5 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = 'Mesa que o cliente irá se sentar';

-- Dumping data for table horadapapa.dinner: ~0 rows (approximately)
DELETE FROM
    `dinner`;

/*!40000 ALTER TABLE `dinner` DISABLE KEYS */
;

INSERT INTO
    `dinner` (`id`, `name`, `isClean`, `date_time`)
VALUES
    (1, 'Mesa VIP', 1, '2024-01-07 16:39:38'),
    (2, 'Mesa Esquerda', 0, '2024-01-07 16:39:54'),
    (3, 'Mesa Direita', 1, '2024-01-07 16:40:05'),
    (4, 'Mesa Centro', 1, '2024-01-07 16:40:33');

/*!40000 ALTER TABLE `dinner` ENABLE KEYS */
;

-- Dumping structure for table horadapapa.favorite
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
) ENGINE = InnoDB AUTO_INCREMENT = 4 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = 'Pratos favoritos do Cliente';

-- Dumping data for table horadapapa.favorite: ~0 rows (approximately)
DELETE FROM
    `favorite`;

/*!40000 ALTER TABLE `favorite` DISABLE KEYS */
;

INSERT INTO
    `favorite` (`id`, `plate_id`, `date_time`, `user_id`)
VALUES
    (1, 3, '2024-01-07 17:14:25', 5),
    (2, 1, '2024-01-07 17:15:05', 4),
    (3, 3, '2024-01-07 17:15:14', 4);

/*!40000 ALTER TABLE `favorite` ENABLE KEYS */
;

-- Dumping structure for table horadapapa.help_ticket
CREATE TABLE IF NOT EXISTS `help_ticket` (
    `id` int NOT NULL AUTO_INCREMENT COMMENT 'id do ticket',
    `user_id` int NOT NULL COMMENT 'id utilizador que fez ticket',
    `needHelp` tinyint(1) NOT NULL COMMENT 'estado da ajuda',
    `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'descrição do pedido de ajuda',
    `date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'data',
    PRIMARY KEY (`id`),
    KEY `status` (`needHelp`) USING BTREE,
    KEY `id_user` (`user_id`) USING BTREE,
    CONSTRAINT `FK_help_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 2 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = 'Pedido de ajuda do cliente';

-- Dumping data for table horadapapa.help_ticket: ~0 rows (approximately)
DELETE FROM
    `help_ticket`;

/*!40000 ALTER TABLE `help_ticket` DISABLE KEYS */
;

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

/*!40000 ALTER TABLE `help_ticket` ENABLE KEYS */
;

-- Dumping structure for table horadapapa.plate
CREATE TABLE IF NOT EXISTS `plate` (
    `id` int NOT NULL AUTO_INCREMENT COMMENT 'id do prato',
    `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'descrição do prato',
    `price` decimal(6, 2) NOT NULL COMMENT 'preço do prato',
    `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'titulo do prato',
    `date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'data',
    `image_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'nome da imagem',
    `supplier_id` int NOT NULL COMMENT 'id do fornecedor',
    PRIMARY KEY (`id`),
    KEY `fk_plateID_supplierID` (`supplier_id`),
    CONSTRAINT `fk_plateID_supplierID` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 7 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = 'O objeto Prato';

-- Dumping data for table horadapapa.plate: ~0 rows (approximately)
DELETE FROM
    `plate`;

/*!40000 ALTER TABLE `plate` DISABLE KEYS */
;

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
        6.43,
        'Caralhotas de Almeirim',
        '2024-01-07 16:20:19',
        '46b48124d90c7d0d0558c0160d9e4d74.jpg',
        1
    ),
    (
        2,
        'A designação “Sopa Caramela” remonta aos séc. XVIII/XIX e foi trazida pelas/os trabalhadoras/es rurais, provenientes das áreas da Beira Litoral e do Baixo Mondego, que se deslocavam sazonalmente, para as propriedades agrícolas da região.',
        16.99,
        'Sopa Caramela',
        '2024-01-07 16:22:37',
        '1a4dcf9f8cc13210a4b3d1ef50926367.jpg',
        1
    ),
    (
        3,
        'Aragonez 35% | Alicante Bouschet 35% | Syrah 10% | Trincadeira 10% | Castelão 10%',
        30.00,
        'Chão das Rolas Tinto',
        '2024-01-07 16:28:52',
        '782c5111af1c466c3229e8d8026a8470.jpg',
        2
    ),
    (
        4,
        'Vinho regional dos Produtores locais de vinhas e pomares misturado com uma boa dose de bagaço.',
        7.99,
        'Vinho da Casa',
        '2024-01-07 16:34:23',
        NULL,
        2
    ),
    (
        5,
        'Principal concorrente ao famoso BigMac.',
        4.99,
        'Hamburguer da Casa',
        '2024-01-07 16:36:40',
        '1f3d236935201fdb54599af4aed28ae7.jpg',
        1
    ),
    (
        6,
        'Este prato é composto apenas por Peixes selecionados individualmente, provenientes apenas de rios portugueses.',
        19.99,
        'Mariscada do Continente',
        '2024-01-07 16:38:30',
        'dc5b008559ec15a6e74ae566956d2548.jpg',
        1
    );

/*!40000 ALTER TABLE `plate` ENABLE KEYS */
;

-- Dumping structure for table horadapapa.review
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
) ENGINE = InnoDB AUTO_INCREMENT = 3 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = 'Review de um Prato';

-- Dumping data for table horadapapa.review: ~0 rows (approximately)
DELETE FROM
    `review`;

/*!40000 ALTER TABLE `review` DISABLE KEYS */
;

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

/*!40000 ALTER TABLE `review` ENABLE KEYS */
;

-- Dumping structure for table horadapapa.supplier
CREATE TABLE IF NOT EXISTS `supplier` (
    `id` int NOT NULL AUTO_INCREMENT COMMENT 'id do fornecedor',
    `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'nome do fornecedor',
    `nif` varchar(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'número fiscal da empresa',
    PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = 'Fornecedores de pratos';

-- Dumping data for table horadapapa.supplier: ~0 rows (approximately)
DELETE FROM
    `supplier`;

/*!40000 ALTER TABLE `supplier` DISABLE KEYS */
;

INSERT INTO
    `supplier` (`id`, `name`, `nif`)
VALUES
    (1, 'Pingo Amargo', '765936745'),
    (2, 'Estado Sólido', '143562913');

/*!40000 ALTER TABLE `supplier` ENABLE KEYS */
;

-- Dumping structure for table horadapapa.user
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

-- Dumping data for table horadapapa.user: ~0 rows (approximately)
DELETE FROM
    `user`;

/*!40000 ALTER TABLE `user` DISABLE KEYS */
;

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

/*!40000 ALTER TABLE `user` ENABLE KEYS */
;

-- Dumping structure for table horadapapa.user_info
CREATE TABLE IF NOT EXISTS `user_info` (
    `user_id` int NOT NULL COMMENT 'id do user',
    `nif` varchar(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'número fiscal do cliente',
    `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'nome do cliente',
    `surname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'último nome do cliente',
    PRIMARY KEY (`user_id`),
    CONSTRAINT `fk_user_info` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = 'Armazena informações extra do utilizador';

-- Dumping data for table horadapapa.user_info: ~0 rows (approximately)
DELETE FROM
    `user_info`;

/*!40000 ALTER TABLE `user_info` DISABLE KEYS */
;

INSERT INTO
    `user_info` (`user_id`, `nif`, `name`, `surname`)
VALUES
    (1, '', 'Administrador', ''),
    (2, '', 'Cozinheiro', ''),
    (3, '', 'Garçon', ''),
    (4, '768456987', 'Santa', 'Mônica'),
    (5, '759175849', 'Santa', 'Catarina'),
    (6, '756867192', 'Meu Cliente', 'Cliente Default');

/*!40000 ALTER TABLE `user_info` ENABLE KEYS */
;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */
;

/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */
;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;

/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */
;