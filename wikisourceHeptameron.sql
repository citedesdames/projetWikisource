-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Client :  sqletud.u-pem.fr
-- Généré le :  Ven 30 Septembre 2022 à 06:03
-- Version du serveur :  5.7.30-log
-- Version de PHP :  7.0.33-0+deb9u7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `wikisource_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `wikisourceHeptameron`
--

CREATE TABLE `wikisourceHeptameron` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `wikisourceHeptameron`
--

INSERT INTO `wikisourceHeptameron` (`id`, `nom`, `ip`, `date`) VALUES
(438, 'GAMBETTE Philippe', '91.165.193.190', '2021-09-29 04:13:26');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `wikisourceHeptameron`
--
ALTER TABLE `wikisourceHeptameron`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
