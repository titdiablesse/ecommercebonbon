-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 26 mars 2024 à 20:44
-- Version du serveur : 8.2.0
-- Version de PHP : 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bonbon`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Berlingot'),
(2, 'Boule Magique'),
(3, 'Retro'),
(4, 'Enfance'),
(5, 'Paques'),
(6, 'Noël');

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

DROP TABLE IF EXISTS `commandes`;
CREATE TABLE IF NOT EXISTS `commandes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `methode_paiement` varchar(50) NOT NULL,
  `panier` text NOT NULL,
  `date_commande` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `coupons`
--

DROP TABLE IF EXISTS `coupons`;
CREATE TABLE IF NOT EXISTS `coupons` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` varchar(255) NOT NULL,
  `remise` int NOT NULL,
  `type` varchar(255) NOT NULL,
  `debut` datetime NOT NULL,
  `fin` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `coupons`
--

INSERT INTO `coupons` (`id`, `code`, `remise`, `type`, `debut`, `fin`) VALUES
(1, 'bonbons50', 50, '%', '2023-05-02 16:23:35', '2023-05-26 16:23:35');

-- --------------------------------------------------------

--
-- Structure de la table `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qte` int NOT NULL,
  `image` varchar(255) NOT NULL,
  `category` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category` (`category`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `items`
--

INSERT INTO `items` (`id`, `name`, `description`, `price`, `qte`, `image`, `category`) VALUES
(1, 'berlingo-fruits', 'Ces petits bonbons durs et translucides en forme de pyramide, toujours striés de rayures blanches et de différentes couleurs sont confectionnés à base de sirop de sucre cuit, sachet de 250 grammes', 8.00, 81, 'berlingot-fruits.jpg', 1),
(2, 'berlingot-pyrennes', 'Ces berlingots fruités à souhait sont la friandise incontournable sachet de 250 grammes ', 5.85, 98, 'berlingot-pyrennes.jpg', 1),
(3, 'berlingot-ancien', 'Berlingots à l’ancienne vrac en 250g ', 12.95, 98, 'berlingot-ancien.jpg', 1),
(4, 'berlingot_de-capentras', '3 boites collection contenant,Berlingots de Carpentras assortis de Provence,Bonbons anciens Lavande Rose Coquelicot,Bonbons au miel de Provence,Poids net : 600g', 749.99, 100, 'berlingot_de-capendras.jpg', 1),
(5, 'original-cola', 'Bonbon dur en forme de bille qui change de goût et de couleur, avec un chewing-gum à l\'intérieur, Poids unitaire ,étui de 2 boules :14,63gr , diamètre:2,2cm', 0.50, 1000, 'original-cola.jpeg', 2),
(6, 'sucette-mammouth', 'Une sucette géante de Mammouth avec 5 goûts différents', 1.95, 1030, 'sucette-mammouth.jpg', 2),
(7, 'sucette.magique', 'La BOULE MAGIQUE en sucette aux parfums originaux, boite de 60 piéces', 36.00, 200, 'sucette.magique.jpg', 2),
(8, 'magique-pica', 'Conditionnement : présentoir de 100 sachets de 2 billes, soit 200 billes', 17.90, 150, 'magique-pica.jpg', 2),
(9, 'Tang', 'La boisson en poudre TANG des années 80 fait son retour', 1.95, 2000, 'tang.jpg', 3),
(10, 'tubble-gum', 'Tubble Gum est un chewing-gum incontournable à quiconque souhaite se remémorer des souvenirs sucrés', 1.80, 1500, 'tubble-gum.jpg', 3),
(11, 'nougat', 'Le célèbre nougat blanc en forme de cube,Lot de 5 gros cubes de nougat blanc, environ 130g', 4.95, 2500, 'nougat.jpg', 3),
(12, 'coco-boer', 'BONBON RÉGLISSE COCO BOER', 4.75, 300, 'coco-boer.jpg', 3),
(13, 'fruits-en-sucre', 'Fruits en plastique remplis de poudre légèrement acidulée. Vous avez une envie de fruits', 1.20, 1000, 'fruits-en-sucre.jpg', 4),
(14, 'carensac', 'vendu en sachet de 100 grammes', 1.50, 1500, 'carensac-haribo.jpg', 4),
(15, 'collier de bonbon', 'collier de bonbon DExtrose mix, vendu a l\'unité', 0.45, 2000, 'collier-de-bonbons.jpg', 4),
(16, 'roudoudou', 'Le célèbre bonbon dans un coquillage coloré qui va rappeler de bons souvenirs aux plus grands des gourmands, vendu par 10', 0.45, 2000, 'roudoudou.jpg', 4),
(17, 'oeufs liqueurs', 'Les petits oeufs liqueur multicolores et sans alcool sont des confiseries incontournables des fêtes de Pâque, vendu par sachet de 250G', 9.00, 1000, 'oeufliqueur.jpg', 5),
(18, 'friture', 'Chaque bouchée est une invitation à l\'évasion, avec une coque croquante de chocolat pur origine Équateur, Sachet de 180g', 7.90, 1000, 'friturepaques.jpg', 5),
(19, 'oeufs caramel', 'LOT DE 2 PAQUETS D’ŒUFS DE MOUETTE AU CARAMEL À LA FLEUR DE SEL, poids net 400g', 15.20, 1000, 'oeufscaramel.jpg', 5),
(20, 'meringues jésus', 'Les célèbres meringues de la crêche de Jésus, poids environ 150g', 4.95, 1000, 'meringue-jesus.jpg', 5);

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

DROP TABLE IF EXISTS `panier`;
CREATE TABLE IF NOT EXISTS `panier` (
  `id` int NOT NULL AUTO_INCREMENT,
  `produit_id` int NOT NULL,
  `qte` int NOT NULL,
  `userTemp` varchar(255) NOT NULL,
  `user_id` int DEFAULT NULL,
  `date` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_item` (`produit_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `panier`
--

INSERT INTO `panier` (`id`, `produit_id`, `qte`, `userTemp`, `user_id`, `date`) VALUES
(1, 1, 1, '1711399441', 1, '2024-03-25 19:50:12'),
(2, 1, 1, '1711475895', 2, '2024-03-26 17:26:09'),
(3, 2, 1, '1711475895', 2, '2024-03-26 17:26:12'),
(4, 3, 1, '1711481194', 1, '2024-03-26 19:03:05'),
(5, 2, 1, '1711481194', 1, '2024-03-26 19:03:06');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `mdp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `role` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `nom`, `email`, `mdp`, `role`) VALUES
(1, 'Angelique Coquet', 'coquetangelique@gmail.com', '$2y$10$h5vmC9DfNYv5wD6duSSA5.D2UXigU0R4Z2z/f5UXgKXM3jPS9Yz42', 'admin'),
(2, 'gwen', 'gwencoquet59@gmail.com', '$2y$10$NUBR4ryTWoDaflphWd0yS.L2r51RX2UaOUkbmiP7PInz84Hb/8KrC', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
