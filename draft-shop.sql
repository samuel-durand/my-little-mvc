-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 02 fév. 2024 à 14:51
-- Version du serveur : 5.7.36
-- Version de PHP : 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `draft-shop`
--

-- --------------------------------------------------------

--
-- Structure de la table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `total` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `cart`
--

INSERT INTO `cart` (`id`, `total`, `user_id`, `created_at`, `updated_at`) VALUES
(6, 68, 10, '2024-02-01 15:46:45', '2024-02-01 16:44:14'),
(9, 150, 12, '2024-02-02 14:05:42', '2024-02-02 14:15:04');

-- --------------------------------------------------------

--
-- Structure de la table `cart_product`
--

DROP TABLE IF EXISTS `cart_product`;
CREATE TABLE IF NOT EXISTS `cart_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL DEFAULT '0',
  `product_id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `cart_product`
--

INSERT INTO `cart_product` (`id`, `quantity`, `price`, `product_id`, `cart_id`, `created_at`, `updated_at`) VALUES
(5, 4, 17, 1, 6, '2024-02-01 15:46:45', '2024-02-01 16:44:14'),
(6, 1, 25, 2, 6, '2024-02-01 15:39:40', NULL),
(7, 1, 25, 2, 7, '2024-02-02 13:47:28', NULL),
(10, 1, 25, 2, 9, '2024-02-02 14:11:41', NULL),
(11, 1, 100, 21, 9, '2024-02-02 14:15:04', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'vêtement', 'vêtement', '2024-01-08 20:59:47', '2024-01-08 20:59:47');

-- --------------------------------------------------------

--
-- Structure de la table `clothing`
--

DROP TABLE IF EXISTS `clothing`;
CREATE TABLE IF NOT EXISTS `clothing` (
  `product_id` int(11) NOT NULL,
  `size` text NOT NULL,
  `color` text NOT NULL,
  `type` text NOT NULL,
  `material_fee` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `clothing`
--

INSERT INTO `clothing` (`product_id`, `size`, `color`, `type`, `material_fee`) VALUES
(32, 'M', 'Blanc', 'Coton', 1),
(33, 'M', 'Blanc', 'Coton', 1),
(34, 'M', 'Blanc', 'Coton', 1),
(35, 'M', 'Blanc', 'Coton', 1),
(36, 'M', 'Blanc', 'Coton', 2);

-- --------------------------------------------------------

--
-- Structure de la table `electronic`
--

DROP TABLE IF EXISTS `electronic`;
CREATE TABLE IF NOT EXISTS `electronic` (
  `product_id` int(11) NOT NULL,
  `brand` text NOT NULL,
  `waranty_fee` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `electronic`
--

INSERT INTO `electronic` (`product_id`, `brand`, `waranty_fee`) VALUES
(39, 'Apple', 2),
(42, 'Samsung', 2),
(43, 'HP', 4),
(44, 'Asus', 4),
(45, 'Asus', 4);

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `photos` text NOT NULL,
  `price` int(11) NOT NULL,
  `description` text NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `product`
--

INSERT INTO `product` (`id`, `name`, `photos`, `price`, `description`, `quantity`, `created_at`, `updated_at`, `category_id`) VALUES
(1, 'T-shirt', '[\"img1\",\"img2\"]', 17, 'T-shirt Black', 5, '2024-01-08 15:52:38', NULL, NULL),
(2, 'Polo', '[\"img1\",\"img2\"]', 25, 'Polo White', 5, '2024-01-08 15:52:38', NULL, NULL),
(3, 'Patalon', '[\"img1\",\"img2\"]', 50, 'Pantalon', 13, '2024-01-08 16:09:48', NULL, NULL),
(4, 'Veste', '[\"img1\",\"img2\"]', 48, 'Veste à capuche ', 60, '2024-01-08 16:09:48', NULL, NULL),
(5, 'Sac a dos', '[\"img1\",\"img2\"]', 63, 'Sac à dos bleu', 25, '2024-01-08 16:11:40', NULL, NULL),
(6, 'T-shirt', '[\"https://picsum.photos/200/300\"]', 40, 'T-shirt blanc', 46, '2024-01-08 16:11:40', NULL, NULL),
(7, 'Chaussure', '[\"https://picsum.photos/200/300\", \"https://picsum.photos/200/300\"]', 82, 'Chaussure blanche ', 69, '2024-01-08 16:13:53', '2024-01-08 20:56:17', 1),
(8, 'T-shirt', '[\"img1\",\"img2\"]', 23, 'T-shirt rouge', 100, '2024-01-08 16:13:53', NULL, NULL),
(37, 'Ordinateur portable', '[\"https:\\/\\/picsum.photos\\/200\\/300\"]', 1250, 'Ordinateur portable 15 pouces', 10, '2024-01-11 11:08:26', NULL, 2),
(21, 'Polo manche courte', '[\"https:\\/\\/picsum.photos\\/200\\/300\"]', 100, 'T-shirt manche courte blanc cassé', 10, '2021-01-01 00:00:00', NULL, 1),
(18, 'T-shirt manche longue', '[\"https:\\/\\/picsum.photos\\/200\\/300\"]', 150, 'T-shirt manche courte blanc cassé', 10, '2021-01-01 00:00:00', '2023-01-02 00:00:00', 1),
(36, 'Polo manche courte', '[\"https:\\/\\/picsum.photos\\/200\\/300\"]', 100, 'T-shirt manche courte blanc cassé', 10, '2022-01-01 00:00:00', '2024-01-11 10:28:27', 1),
(33, 'Polo manche courte', '[\"https:\\/\\/picsum.photos\\/200\\/300\"]', 100, 'T-shirt manche courte blanc cassé', 10, '2022-01-01 00:00:00', NULL, 1),
(45, 'Ordinateur Portable', '[\"img1\",\"img2\",\"img3\"]', 400, 'Un ordinateur', 100, '2024-01-29 13:37:57', NULL, 2),
(44, 'Ordinateur Portable', '[\"img1\",\"img2\",\"img3\"]', 400, 'Un ordinateur', 100, '2024-01-29 13:37:19', NULL, 2),
(29, 'Polo manche courte', '[\"https:\\/\\/picsum.photos\\/200\\/300\"]', 100, 'T-shirt manche courte blanc cassé', 10, '2022-01-01 00:00:00', NULL, 1),
(38, 'Ordinateur portable', '[\"https:\\/\\/picsum.photos\\/200\\/300\"]', 1250, 'Ordinateur portable 15 pouces', 10, '2024-01-11 11:09:30', NULL, 2),
(39, 'Ordinateur portable', '[\"https:\\/\\/picsum.photos\\/200\\/300\"]', 1250, 'Ordinateur portable 15 pouces', 10, '2024-01-11 11:11:31', NULL, 2),
(40, 'Smartphone', '[\"https:\\/\\/picsum.photos\\/200\\/300\"]', 1000, 'Smartphone 6 pouces', 10, '2024-01-11 14:48:24', NULL, 2),
(41, 'Smartphone', '[\"https:\\/\\/picsum.photos\\/200\\/300\"]', 1000, 'Smartphone 6 pouces', 10, '2024-01-11 14:49:38', NULL, 2),
(42, 'Smartphone', '[\"https:\\/\\/picsum.photos\\/200\\/300\"]', 1000, 'Smartphone 6 pouces', 10, '2024-01-11 14:51:10', NULL, 2),
(43, 'Ordinateur', '[\"img1\",\"img2\"]', 400, 'Un ordinateur', 100, '2024-01-29 08:42:16', NULL, 2);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` text NOT NULL,
  `created_at` datetime NOT NULL,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `fullname`, `email`, `password`, `role`, `created_at`, `update_at`) VALUES
(11, 'Raisin', 'raisin@gmail.com', '$2y$10$zszBpq/EF6sAx6AeaOw4TOfMtEc8HgHAiBOhaDY6TNdGb6lZH4JhC', '[\"ROLE_USER\"]', '2024-02-02 11:09:35', NULL),
(2, 'Mango', 'Mango@gmail.com', '$2y$10$z1m2F/Z9lci4e.rW0k7UPeKXR23iV4iRqOBbanBzz4gI2Hbu1bM1a', '[\"ROLE_USER\"]', '2024-01-29 15:09:35', NULL),
(3, 'mmm', 'john.doe@gmail.com', '$2y$10$e5oBN3ehAciq/JevXn4xpuOgOWlt5VQG/SBzyehjh5d7h5a06FGGi', '[\"ROLE_USER\"]', '2024-01-30 08:56:14', NULL),
(4, 'Groseille', 'Groseille.doe@gmail.com', '$2y$10$WMJAwoCgBGp9C5FzoaFLSu0ZC1acKtcTApc2W54XSyganVBIc3I66', '[\"ROLE_USER\"]', '2024-01-30 08:58:38', NULL),
(5, 'Groseille', 'tomate.peretti@gmail.com', '$2y$10$nPNhLys3Zd1I3w1aR5d1CutxMKVVJDIwmmLmAmLyOlsbRObkDBTIK', '[\"ROLE_USER\"]', '2024-01-30 16:38:35', NULL),
(6, 'Groseille', 'kiwi@gmail.com', '$2y$10$iyYrNdPl5pEexonRpMMBYOM0XrEgA0XkALFdNO1GlOq7uFDtmdyuS', '[\"ROLE_USER\"]', '2024-01-30 16:42:40', NULL),
(7, 'Fraise', 'Fraise@gmail.com', '$2y$10$lEtX37Vgi1/liztx0yBAJ.eRu/n.U0RL0I/k8.MaadRH4CEFl6HKS', '[\"ROLE_USER\"]', '2024-01-30 15:51:15', NULL),
(8, 'fraise', 'alain@gmail.com', '$2y$10$/Kpr.b9UsdJyWJmbneevjeoB2Z55pRyB.mJeNVHQS9pkq/XS0JBm.', '[\"ROLE_USER\"]', '2024-01-30 21:29:19', NULL),
(9, 'Border', 'border@gmail.com', '$2y$10$fgFgv0Kqja1ki6wxhH7IUeaafgFZvvfuovHWwva5OYsgYdItl4RB6', '[\"ROLE_USER\"]', '2024-01-31 13:42:11', NULL),
(10, 'conv', 'conv@gmail.com', '$2y$10$lqtgLjfYyypdgyt9o36qJOdH3UtAvCvPZs.RPYuGJv4RwwpMTk1BS', '[\"ROLE_USER\"]', '2024-01-31 15:26:40', NULL),
(12, 'crea', 'crea@gmail.com', '$2y$10$2a.6b3UriowsceoIs.kCaOPetNlm2jYYgId9BwdofpCBsq77gQGC2', '[\"ROLE_USER\"]', '2024-02-02 12:52:37', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
