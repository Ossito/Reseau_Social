-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  mer. 29 mai 2019 à 14:13
-- Version du serveur :  10.1.31-MariaDB
-- Version de PHP :  7.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `dev_social`
--

-- --------------------------------------------------------

--
-- Structure de la table `auth_tokens`
--

CREATE TABLE `auth_tokens` (
  `id` int(11) NOT NULL,
  `selector` varchar(255) DEFAULT NULL,
  `expires` datetime DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `codes`
--

CREATE TABLE `codes` (
  `id` int(11) NOT NULL,
  `code` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `friends_relationships`
--

CREATE TABLE `friends_relationships` (
  `user_id1` int(11) NOT NULL,
  `user_id2` int(11) NOT NULL,
  `status` enum('0','1','2') DEFAULT '0',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `friends_relationships`
--

INSERT INTO `friends_relationships` (`user_id1`, `user_id2`, `status`, `created_at`) VALUES
(4, 4, '2', '2019-04-02 08:43:36'),
(5, 4, '1', '2019-04-02 08:45:43'),
(5, 5, '2', '2019-04-02 08:44:37');

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `sender` varchar(255) NOT NULL,
  `receiver` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id`, `sender`, `receiver`, `message`, `date`) VALUES
(1, '4', '5', 'Salut Alex !!!', '2019-04-02 09:44:09'),
(2, '4', '5', 'Comment tu vas ?', '2019-04-02 09:58:53'),
(3, '5', '4', 'Oui Zack bien ?', '2019-04-02 09:59:22');

-- --------------------------------------------------------

--
-- Structure de la table `microposts`
--

CREATE TABLE `microposts` (
  `id` int(11) NOT NULL,
  `content` text,
  `user_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `like_count` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `microposts`
--

INSERT INTO `microposts` (`id`, `content`, `user_id`, `created_at`, `like_count`) VALUES
(11, 'Salut', 4, '2019-04-02 08:44:02', 2),
(12, 'C\'est Alex\r\n', 5, '2019-04-02 08:44:54', 2),
(13, 'Nouveau sur le rÃ©seau', 4, '2019-04-02 08:50:15', 2),
(14, 'Top !!!!', 5, '2019-04-02 08:51:54', 2),
(15, 'Et ce matin ??', 4, '2019-04-03 10:07:33', 1);

-- --------------------------------------------------------

--
-- Structure de la table `micropost_like`
--

CREATE TABLE `micropost_like` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `micropost_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `micropost_like`
--

INSERT INTO `micropost_like` (`id`, `user_id`, `micropost_id`, `created_at`) VALUES
(1, 5, 12, '2019-04-02 08:44:58'),
(2, 4, 12, '2019-04-02 08:47:51'),
(3, 4, 11, '2019-04-02 08:47:54'),
(4, 5, 13, '2019-04-02 08:51:35'),
(5, 5, 11, '2019-04-02 08:51:43'),
(6, 5, 14, '2019-04-02 08:52:05'),
(7, 4, 13, '2019-04-03 09:42:47'),
(8, 4, 14, '2019-04-03 09:42:54'),
(9, 4, 15, '2019-04-03 13:03:27');

-- --------------------------------------------------------

--
-- Structure de la table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `seen` enum('0','1') DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `notifications`
--

INSERT INTO `notifications` (`id`, `subject_id`, `name`, `user_id`, `created_at`, `seen`) VALUES
(1, 4, 'friend_request_sent', 5, '2019-04-02 08:45:43', '1'),
(2, 4, 'liked_micropost', 5, '2019-04-02 08:45:43', '1'),
(3, 5, 'friend_request_accepted', 4, '2019-04-02 08:46:35', '1'),
(4, 5, 'friend_request_accepted', 4, '2019-04-26 09:58:03', '0'),
(5, 5, 'friend_request_accepted', 4, '2019-04-26 09:58:11', '0');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `pseudo` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `active` enum('0','1') DEFAULT '0',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `city` varchar(255) DEFAULT NULL,
  `sex` enum('H','F') DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `available_for_hiring` enum('0','1') DEFAULT NULL,
  `bio` text,
  `avatar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `pseudo`, `email`, `password`, `active`, `created_at`, `city`, `sex`, `facebook`, `instagram`, `country`, `available_for_hiring`, `bio`, `avatar`) VALUES
(4, 'Zack', 'zack', 'zack@gmail.com', '$2y$12$hwDfZuZyf9PC7gIiWcmd1OJ8DRSXS.LlVVpACF8S5IMPI/J1syVNm', '0', '2019-04-02 08:43:36', 'Cotonou', 'H', 'zack', 'zacky', 'BENIN', '1', 'Je suis un petit passionnÃ© du dÃ©veloppement mobile    ', '/social/uploads/img4/376448902bf0541c1fef7764000ae544.jpg'),
(5, 'Alex', 'alex', 'alex@gmail.com', '$2y$12$wN03yqMqH/qdt1wPD92l8O.Fi67rlCXYKNEz1Pq4EBt3Kf4ZMFnzu', '0', '2019-04-02 08:44:36', 'Paris', 'H', '', 'alex_bekker', 'FRANCE', '0', '  DEV Python !!!\r\nTravaille en mode freelance  ', '/social/uploads/img5/eae9144a11e73cb8f7b82e8cf6063914.jpg');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `selector` (`selector`);

--
-- Index pour la table `codes`
--
ALTER TABLE `codes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `friends_relationships`
--
ALTER TABLE `friends_relationships`
  ADD PRIMARY KEY (`user_id1`,`user_id2`),
  ADD KEY `friends_relationships_ibfk_2` (`user_id2`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `microposts`
--
ALTER TABLE `microposts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `microposts_ibfk_1` (`user_id`);

--
-- Index pour la table `micropost_like`
--
ALTER TABLE `micropost_like`
  ADD PRIMARY KEY (`id`),
  ADD KEY `micropost_like_ibfk_1` (`user_id`),
  ADD KEY `micropost_like_ibfk_2` (`micropost_id`);

--
-- Index pour la table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_ibfk_1` (`user_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pseudo` (`pseudo`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `codes`
--
ALTER TABLE `codes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `microposts`
--
ALTER TABLE `microposts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `micropost_like`
--
ALTER TABLE `micropost_like`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `friends_relationships`
--
ALTER TABLE `friends_relationships`
  ADD CONSTRAINT `friends_relationships_ibfk_1` FOREIGN KEY (`user_id1`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `friends_relationships_ibfk_2` FOREIGN KEY (`user_id2`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `microposts`
--
ALTER TABLE `microposts`
  ADD CONSTRAINT `microposts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `micropost_like`
--
ALTER TABLE `micropost_like`
  ADD CONSTRAINT `micropost_like_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `micropost_like_ibfk_2` FOREIGN KEY (`micropost_id`) REFERENCES `microposts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
