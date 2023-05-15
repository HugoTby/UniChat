-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : jeu. 11 mai 2023 à 21:55
-- Version du serveur : 10.5.19-MariaDB-0+deb11u2
-- Version de PHP : 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `unichat`
--

-- --------------------------------------------------------

--
-- Structure de la table `development_tests`
--

CREATE TABLE `development_tests` (
  `id` int(11) NOT NULL,
  `result` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `development_tests`
--

INSERT INTO `development_tests` (`id`, `result`) VALUES
(1, 'La connexion à la base de données est confirmée !');

-- --------------------------------------------------------

--
-- Structure de la table `header`
--

CREATE TABLE `header` (
  `id` int(11) NOT NULL,
  `version` varchar(300) NOT NULL,
  `auteur` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `header`
--

INSERT INTO `header` (`id`, `version`, `auteur`) VALUES
(1, '1.7.4+20230508.1244', 'Hugo TABARY');

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `message` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id`, `pseudo`, `message`) VALUES
(7, 'User 1', 'Hello ! This is a test'),
(8, 'User 2', 'Hallo ! Das ist ein Test'),
(9, 'User 3', 'Bonjour ! Ceci est un test'),
(10, 'User 4', 'Holà ! Es una prueba'),
(11, 'User 5', '좋은 아침이에요! 이것은 시험이다'),
(12, 'User 6', '早上好! 这是一个测试'),
(13, 'User 7', 'Chào buổi sáng ! đó là một bài kiểm tra'),
(14, 'User 8', 'Καλημέρα ! είναι μια δοκιμή'),
(15, 'User 9', 'Доброе утро ! это тест'),
(16, 'User 10', 'おはよう！ それはテストです'),
(21, 'test', 'test'),
(22, 'test2', 'test2'),
(23, 'admin\' OR \'1\'', 'test'),
(24, 'admin\' OR \'1\'', 'tecdcdvdxst'),
(25, 'dvsvdxf', 'vdfxvdwxvdwxdvwx');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `mail` varchar(300) NOT NULL,
  `pseudo` varchar(30) NOT NULL,
  `password` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
