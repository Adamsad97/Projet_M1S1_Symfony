-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : lun. 07 juil. 2025 à 06:47
-- Version du serveur : 5.7.24
-- Version de PHP : 8.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `maboutique`
--

-- --------------------------------------------------------

--
-- Structure de la table `adresse`
--

CREATE TABLE `adresse` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `adresse`
--

INSERT INTO `adresse` (`id`, `user_id`, `firstname`, `lastname`, `adresse`, `postal`, `city`, `country`, `phone`) VALUES
(8, 2, 'Adama', 'DIAWARA', '20 Rue de Cuques', '13100', 'AIX-EN-PROVENCE', 'FR', '0606060606'),
(9, 2, 'Adama', 'DIAWARA', '4 RUE GUSTAVE DESPLACES', '13100', 'AIX-EN-PROVENCE', 'FR', '0606060606'),
(10, 2, 'Adama', 'DIAWARA', '5 AV. DE L\'ABBE ROGER DERRY', '94400', 'Vitry-sur-Seine', 'FR', '0606060606');

-- --------------------------------------------------------

--
-- Structure de la table `carrier`
--

CREATE TABLE `carrier` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `carrier`
--

INSERT INTO `carrier` (`id`, `name`, `description`, `price`) VALUES
(1, 'Colissimo', 'Fiable, rapide et sécurisé\r\nMax : 5 jours\r\nPartout en France', 3.9),
(2, 'Chronopost', 'Fiable, rapide et sécurisé\r\nMax : 2 jours\r\nPartout en France', 4.9),
(3, 'DHL', 'Fiable, rapide et sécurisé\r\nMax : 1 jours\r\nPartout en France', 5.9),
(4, 'GLS', 'Fiable, rapide et sécurisé\r\nMax : 10 jours\r\nPartout en France', 2.5);

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `name`, `slug`) VALUES
(2, 'MacBook', 'macbook'),
(3, 'SmartPhone', 'smartphone'),
(4, 'Montre connectée', 'montre-connectee'),
(5, 'Ordinateur portable', 'ordinateur-portable'),
(6, 'Tablette', 'tablette'),
(7, 'Iphone', 'iphone');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20250706235851', '2025-07-06 23:59:06', 1213);

-- --------------------------------------------------------

--
-- Structure de la table `header`
--

CREATE TABLE `header` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `button_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `button_link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `illustration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `carrier_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `carrier_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `carrier_price` double NOT NULL,
  `delivry` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` int(11) NOT NULL,
  `stripe_session_id` longtext COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `order`
--

INSERT INTO `order` (`id`, `user_id`, `carrier_id`, `created_at`, `carrier_name`, `carrier_price`, `delivry`, `state`, `stripe_session_id`) VALUES
(1, 2, NULL, '2025-07-07 05:21:01', 'Colissimo', 3.9, 'Adama DIAWARA<br/>20 Rue de Cuques<br/>13100, AIX-EN-PROVENCE<br/>FR<br/>0606060606', 2, 'cs_test_b1fVOlJb8pH0p1HDR7jrbl88stCj9Aqdr4Jx2QCByMT1d8gFLLuPtbHGPj'),
(2, 2, NULL, '2025-07-07 05:41:35', 'Colissimo', 3.9, 'Adama DIAWARA<br/>20 Rue de Cuques<br/>13100, AIX-EN-PROVENCE<br/>FR<br/>0606060606', 1, NULL),
(3, 2, NULL, '2025-07-07 05:41:36', 'Colissimo', 3.9, 'Adama DIAWARA<br/>20 Rue de Cuques<br/>13100, AIX-EN-PROVENCE<br/>FR<br/>0606060606', 1, NULL),
(4, 2, NULL, '2025-07-07 05:43:03', 'Colissimo', 3.9, 'Adama DIAWARA<br/>20 Rue de Cuques<br/>13100, AIX-EN-PROVENCE<br/>FR<br/>0606060606', 1, NULL),
(5, 2, NULL, '2025-07-07 05:45:00', 'Colissimo', 3.9, 'Adama DIAWARA<br/>20 Rue de Cuques<br/>13100, AIX-EN-PROVENCE<br/>FR<br/>0606060606', 1, NULL),
(6, 2, NULL, '2025-07-07 05:45:51', 'Colissimo', 3.9, 'Adama DIAWARA<br/>20 Rue de Cuques<br/>13100, AIX-EN-PROVENCE<br/>FR<br/>0606060606', 1, NULL),
(7, 2, NULL, '2025-07-07 05:46:44', 'Colissimo', 3.9, 'Adama DIAWARA<br/>20 Rue de Cuques<br/>13100, AIX-EN-PROVENCE<br/>FR<br/>0606060606', 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(11) NOT NULL,
  `my_order_id` int(11) DEFAULT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_illustration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `product_price` double NOT NULL,
  `product_tva` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `order_detail`
--

INSERT INTO `order_detail` (`id`, `my_order_id`, `product_name`, `product_illustration`, `product_quantity`, `product_price`, `product_tva`) VALUES
(1, 1, 'MacBook', '2025-07-07-43785d559eba125a980fdf9199c2455f2e1fe001.jpg', 1, 1750, 20),
(2, 2, 'MacBook', '2025-07-07-43785d559eba125a980fdf9199c2455f2e1fe001.jpg', 1, 1750, 20),
(3, 3, 'MacBook', '2025-07-07-43785d559eba125a980fdf9199c2455f2e1fe001.jpg', 1, 1750, 20),
(4, 4, 'MacBook', '2025-07-07-43785d559eba125a980fdf9199c2455f2e1fe001.jpg', 1, 1750, 20),
(5, 5, 'MacBook', '2025-07-07-43785d559eba125a980fdf9199c2455f2e1fe001.jpg', 1, 1750, 20),
(6, 6, 'MacBook', '2025-07-07-43785d559eba125a980fdf9199c2455f2e1fe001.jpg', 1, 1750, 20),
(7, 7, 'MacBook', '2025-07-07-43785d559eba125a980fdf9199c2455f2e1fe001.jpg', 1, 1750, 20);

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `illustration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `tva` double NOT NULL,
  `in_homepage` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `product`
--

INSERT INTO `product` (`id`, `category_id`, `product_id`, `name`, `slug`, `description`, `illustration`, `price`, `tva`, `in_homepage`) VALUES
(1, 2, NULL, 'MacBook', 'mackbook', '<div><strong>Écran</strong> : 13,6 pouces Liquid Retina (2560 x 1664)</div><div><strong>Processeur</strong> : Apple M2 (8 cœurs CPU, 8 ou 10 cœurs GPU)</div><div><strong>Mémoire vive (RAM)</strong> : 8 Go (jusqu’à 24 Go)</div><div><strong>Stockage</strong> : SSD de 256 Go (jusqu’à 2 To)</div><div><strong>Autonomie</strong> : Jusqu’à 18 heures<br><br><br></div>', '2025-07-07-43785d559eba125a980fdf9199c2455f2e1fe001.jpg', 1750, 20, 0),
(2, 4, NULL, 'Montre Connectée', 'montre-connectee', '<div>&nbsp;Montre connectée élégante et légère, idéale pour le suivi de votre activité au quotidien.<br>&nbsp;Suivi du rythme cardiaque, notifications en temps réel et autonomie longue durée.<br>&nbsp;Compatible iOS et Android via Bluetooth.&nbsp;</div>', '2025-07-07-5fae4279a43d86b1332e9306abb587cbfcd6b331.jpg', 87.9, 20, 0),
(3, 5, NULL, 'ASUS', 'asus', '<div>&nbsp;PC portable ASUS puissant et polyvalent, idéal pour le travail et le divertissement.<br>&nbsp;Écran Full HD, processeur rapide et grande autonomie pour une productivité optimale.<br>&nbsp;Design fin, léger et robuste, parfait pour une utilisation quotidienne.&nbsp;</div>', '2025-07-07-f5ae64a37316d1e009958e47554580b10f3abb32.jpg', 12000, 20, 0),
(4, 6, NULL, 'Tablette', 'tablette', '<div>&nbsp;Tablette tactile performante, idéale pour le multimédia, la lecture et la navigation web.<br>&nbsp;Écran HD, processeur fluide et grande autonomie pour un usage quotidien.<br>&nbsp;Compatible avec les applications Android ou iOS selon le modèle.&nbsp;</div>', '2025-07-07-644775af6ca898c1513a9f0ed5b422f29f915767.jpg', 500, 20, 0),
(5, 3, NULL, 'Smartphone', 'smartphone', '<div>&nbsp;Smartphone moderne avec écran haute résolution et appareil photo performant.<br>&nbsp;Navigation fluide, grande autonomie et design élégant.<br>&nbsp;Idéal pour un usage quotidien, pro ou multimédia.&nbsp;</div>', '2025-07-07-292708d0cd37abfe5c09c784f1741677e7b5c09f.jpg', 700, 20, 0),
(6, 7, NULL, 'Iphone', 'iphone', '<div>&nbsp;iPhone 16 avec design raffiné, écran Super Retina XDR et puce A18 ultra-performante.<br>&nbsp;Système photo avancé pour des clichés pro de jour comme de nuit.<br>&nbsp;Autonomie améliorée, iOS 18, 5G et sécurité renforcée avec Face ID.&nbsp;</div>', '2025-07-07-721e91680ac15bad8a50b90dd3fcd250bb9e45b0.jpg', 12000, 20, 0);

-- --------------------------------------------------------

--
-- Structure de la table `profile`
--

CREATE TABLE `profile` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bio` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `review`
--

CREATE TABLE `review` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `note` int(11) DEFAULT NULL,
  `commentaire` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `create_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `stock`
--

CREATE TABLE `stock` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token_expire_at` datetime DEFAULT NULL,
  `last_login_at` datetime DEFAULT NULL,
  `is_verified` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `firstname`, `lastname`, `token`, `token_expire_at`, `last_login_at`, `is_verified`) VALUES
(2, 'diawaraad97@gmail.com', '[\"ROLE_USER\", \"ROLE_ADMIN\"]', '$2y$13$ycAdq5yuxf9hIkkePl0pIOLREE3TGKQya8drNFeojaWcv5G1eH9/y', 'Adama', 'DIAWARA', '62e739a4541cb88663e472d364db6544a24e1a7ca83fdc9cb50a8010a6ef9b17', '2025-07-07 05:12:17', '2025-07-07 05:02:35', 1);

-- --------------------------------------------------------

--
-- Structure de la table `user_product`
--

CREATE TABLE `user_product` (
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `adresse`
--
ALTER TABLE `adresse`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_C35F0816A76ED395` (`user_id`);

--
-- Index pour la table `carrier`
--
ALTER TABLE `carrier`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `header`
--
ALTER TABLE `header`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Index pour la table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_F5299398A76ED395` (`user_id`),
  ADD KEY `IDX_F529939821DFC797` (`carrier_id`);

--
-- Index pour la table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_ED896F46BFCDF877` (`my_order_id`);

--
-- Index pour la table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_D34A04AD12469DE2` (`category_id`),
  ADD KEY `IDX_D34A04AD4584665A` (`product_id`);

--
-- Index pour la table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8157AA0FA76ED395` (`user_id`);

--
-- Index pour la table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_794381C6A76ED395` (`user_id`),
  ADD KEY `IDX_794381C64584665A` (`product_id`);

--
-- Index pour la table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_4B3656604584665A` (`product_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`);

--
-- Index pour la table `user_product`
--
ALTER TABLE `user_product`
  ADD PRIMARY KEY (`user_id`,`product_id`),
  ADD KEY `IDX_8B471AA7A76ED395` (`user_id`),
  ADD KEY `IDX_8B471AA74584665A` (`product_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `adresse`
--
ALTER TABLE `adresse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `carrier`
--
ALTER TABLE `carrier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `header`
--
ALTER TABLE `header`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `profile`
--
ALTER TABLE `profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `adresse`
--
ALTER TABLE `adresse`
  ADD CONSTRAINT `FK_C35F0816A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `FK_F529939821DFC797` FOREIGN KEY (`carrier_id`) REFERENCES `carrier` (`id`),
  ADD CONSTRAINT `FK_F5299398A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `FK_ED896F46BFCDF877` FOREIGN KEY (`my_order_id`) REFERENCES `order` (`id`);

--
-- Contraintes pour la table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `FK_D34A04AD12469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `FK_D34A04AD4584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Contraintes pour la table `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `FK_8157AA0FA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `FK_794381C64584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `FK_794381C6A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `FK_4B3656604584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Contraintes pour la table `user_product`
--
ALTER TABLE `user_product`
  ADD CONSTRAINT `FK_8B471AA74584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_8B471AA7A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
