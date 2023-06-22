-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : ven. 16 juin 2023 à 17:15
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `project-university`
--

-- --------------------------------------------------------

--
-- Structure de la table `lists`
--

CREATE TABLE `lists` (
  `id` int(11) NOT NULL,
  `user_Id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `lists`
--

INSERT INTO `lists` (`id`, `user_Id`, `name`) VALUES
(1, 1, 'newlist'),
(2, 1, 'hello'),
(3, 1, 'test'),
(4, 1, 'list2'),
(5, 10, 'test 1'),
(6, 10, 'test 2'),
(7, 10, 'list 3'),
(8, 14, 'AZE'),
(9, 14, 'AZEfesf');

-- --------------------------------------------------------

--
-- Structure de la table `steps`
--

CREATE TABLE `steps` (
  `id` int(11) NOT NULL,
  `task_id` int(11) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `done` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `steps`
--

INSERT INTO `steps` (`id`, `task_id`, `name`, `done`) VALUES
(5, 9, 'step2233', 0),
(6, 9, 'step1', 0),
(7, 10, 'step2', 1),
(8, 14, '1', 0),
(11, 15, 'new 4', 0),
(12, 24, 'rtygtdgd', 0),
(13, 24, 'rtygtdgd', 0),
(14, 24, 'rtygtdgd', 0),
(15, 24, 'rtygtdgd', 0),
(16, 24, 'rtygt', 0);

-- --------------------------------------------------------

--
-- Structure de la table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `list_id` int(11) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `note` varchar(200) DEFAULT NULL,
  `deadLine` date DEFAULT NULL,
  `done` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `tasks`
--

INSERT INTO `tasks` (`id`, `user_id`, `list_id`, `name`, `note`, `deadLine`, `done`) VALUES
(9, 10, 5, 'list1', 'tryruiozckdjhkdsjnc', '2023-06-14', 1),
(10, 10, 5, 'list2', 'note1', '2023-07-10', 0),
(14, 10, 7, 'ksjdhkqsj', 'bla bla bla ', '2023-07-02', 0),
(15, 10, 7, 'sdjhk', 'bla  bla', '2023-06-24', 1),
(24, 14, 9, 'sfsqfs', 'dfsdgfdf', '2023-06-27', 0),
(36, 1, 1, 'test', 'test', '2023-06-28', 0);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `verify_token` text DEFAULT NULL,
  `forgot_token` text DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `verify_token`, `forgot_token`, `is_active`) VALUES
(1, 'sigarchian.m@gmail.com', '$2y$10$igNzIc4U8kq/E1AZ2BnswuD1.mJL.WGTZTvowcAQkxImeQjY2kcTO', 'f8b0a35976e8a40efe13d1d67ff741893e50e07270beb8c919532ed9eb7dac5e', 'ea1ef74863676838bb507e8eef27cd612d48f2a8e1f00f7d0632c3c9732d856c', 1),
(5, 'hassan@yahoo.com', '$2y$10$bInQMaSaqCEs2j8NWN2B5uJ7/vFd/dpFI.oclQuaou.ZUaX.2eIGe', 'b4030be79e4a5191e190fe0fc419a2f7d57804dd8205d6201b3b5a2c4103efcc', NULL, 0),
(10, 'lea.megane2023@gmail.com', '$2y$10$y0tJfcIjhJBPmrUWFXZgZOyx8Ngy2c9ZL4t0usTg2Qoy8qcU7729S', '2f84d7003d4a74925f8f127a14895d1206615bb7f4763fdbf79082c95fdcd3b4', '4529901866ee95c805d931c351510c32c8633fb3f1bb8d95710250eb369f6293', 1),
(13, 'testmailer@gmail.com', '$2y$10$.T0pAUfcwCumULJUzCjelOE0pc6ca3EQRnEqddnsCIAkUEUEXTWre', 'd0b47778423f8d3f5f489d6bcab1ee044e730f01092829a6543bb569912c33fa', NULL, 0),
(14, 'testmailer1106@gmail.com', '$2y$10$liGoqKDoYqsaWkDSpbhtyOb7JrHNBfwF2V6rN6on8trv8ovipmoq6', '7f05dbc38efbafb1adec5549a53d94f623b4cd44aa89f82d7831be696b90f3df', '6e4b87ace95713afeeeef8102ddf5ec95242a0ca547782beda778937dea01f28', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `lists`
--
ALTER TABLE `lists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_Id` (`user_Id`);

--
-- Index pour la table `steps`
--
ALTER TABLE `steps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `task_id` (`task_id`);

--
-- Index pour la table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `list_id` (`list_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `lists`
--
ALTER TABLE `lists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `steps`
--
ALTER TABLE `steps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `lists`
--
ALTER TABLE `lists`
  ADD CONSTRAINT `lists_ibfk_1` FOREIGN KEY (`user_Id`) REFERENCES `Users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `steps`
--
ALTER TABLE `steps`
  ADD CONSTRAINT `steps_ibfk_1` FOREIGN KEY (`task_id`) REFERENCES `Tasks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `Users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tasks_ibfk_2` FOREIGN KEY (`list_id`) REFERENCES `Lists` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
