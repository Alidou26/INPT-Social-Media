-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 20 mars 2023 à 04:23
-- Version du serveur : 10.4.24-MariaDB
-- Version de PHP : 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `estd_sm`
--

-- --------------------------------------------------------

--
-- Structure de la table `commentairegroupe`
--

CREATE TABLE `commentairegroupe` (
  `id_commentaireG` int(11) NOT NULL,
  `id_posteG` int(11) NOT NULL,
  `commentaireG` text NOT NULL,
  `dateCommentaire` int(11) NOT NULL DEFAULT current_timestamp(),
  `id_utilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `commentairegroupe`
--

INSERT INTO `commentairegroupe` (`id_commentaireG`, `id_posteG`, `commentaireG`, `dateCommentaire`, `id_utilisateur`) VALUES
(2, 2, 'HI', 2147483647, 2),
(3, 4, 'REIRRUE', 2147483647, 2);

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `id_commentaire` int(11) NOT NULL,
  `id_poste` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `commentaire` text NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id_commentaire`, `id_poste`, `id_utilisateur`, `commentaire`, `date_creation`) VALUES
(1, 63, 1, 'cc', '2023-03-07 22:04:41'),
(8, 71, 8, 'cc', '2023-03-20 02:38:06'),
(9, 81, 4, 'PRAVIE', '2023-03-20 02:40:22');

-- --------------------------------------------------------

--
-- Structure de la table `follow_list`
--

CREATE TABLE `follow_list` (
  `id` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `id_follower` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `follow_list`
--

INSERT INTO `follow_list` (`id`, `id_utilisateur`, `id_follower`) VALUES
(17, 2, 1),
(18, 1, 2),
(21, 4, 2),
(22, 2, 4),
(23, 4, 8),
(24, 8, 4);

-- --------------------------------------------------------

--
-- Structure de la table `groupe`
--

CREATE TABLE `groupe` (
  `id_groupe` int(11) NOT NULL,
  `nom_groupe` text NOT NULL,
  `id_administrateur` int(11) NOT NULL,
  `photo_groupe` text NOT NULL DEFAULT 'images/suggested.png',
  `filiere_admin` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `groupe`
--

INSERT INTO `groupe` (`id_groupe`, `nom_groupe`, `id_administrateur`, `photo_groupe`, `filiere_admin`) VALUES
(1, 'GE-1A', 1, 'groupe/16781322521611600362784.jpeg', 'GI-2A'),
(2, 'GE-2A', 1, 'groupe/1678132457IMAG_poursuites_etudes_dut_geii.jpg', 'GI-2A'),
(3, 'GI-1A', 1, 'groupe/1678132591Langage-de-programmation-informatique-1200x900.jpg', 'GI-2A'),
(4, 'GI-2A', 1, 'groupe/1678132612GI2A.png', 'GI-2A'),
(5, 'TM-1A', 1, 'groupe/1678132394genie-elec.jpg', 'GI-2A'),
(6, 'TM-2A', 1, 'groupe/1678132333TM2.png', 'GI-2A');

-- --------------------------------------------------------

--
-- Structure de la table `invitation`
--

CREATE TABLE `invitation` (
  `id_invitation` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `id_demandeur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `invitation`
--

INSERT INTO `invitation` (`id_invitation`, `id_utilisateur`, `id_demandeur`) VALUES
(56, 5, 2);

-- --------------------------------------------------------

--
-- Structure de la table `likes`
--

CREATE TABLE `likes` (
  `id_like` int(11) NOT NULL,
  `id_poste` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `likes`
--

INSERT INTO `likes` (`id_like`, `id_poste`, `id_utilisateur`) VALUES
(7, 71, 4),
(8, 77, 2),
(9, 79, 2),
(13, 71, 8),
(14, 81, 8),
(15, 81, 4);

-- --------------------------------------------------------

--
-- Structure de la table `likesg`
--

CREATE TABLE `likesg` (
  `id_likesg` int(11) NOT NULL,
  `id_posteG` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `likesg`
--

INSERT INTO `likesg` (`id_likesg`, `id_posteG`, `id_utilisateur`) VALUES
(1, 2, 2),
(2, 4, 2),
(3, 5, 4),
(4, 7, 8);

-- --------------------------------------------------------

--
-- Structure de la table `membregroupe`
--

CREATE TABLE `membregroupe` (
  `id_Membregroupe` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `id_groupe` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `membregroupe`
--

INSERT INTO `membregroupe` (`id_Membregroupe`, `id_utilisateur`, `id_groupe`) VALUES
(1, 1, 1),
(2, 1, 6),
(3, 1, 5),
(4, 1, 2),
(5, 1, 3),
(6, 1, 4),
(11, 2, 4),
(13, 4, 4),
(16, 2, 1),
(17, 2, 6),
(18, 2, 5),
(20, 8, 4),
(21, 8, 2);

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id_message` int(11) NOT NULL,
  `pseudo_envoyeur` varchar(255) NOT NULL,
  `pseudo_recepteur` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `date_envoi` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id_message`, `pseudo_envoyeur`, `pseudo_recepteur`, `message`, `date_envoi`) VALUES
(39, 'Alidou2', 'Admin', 'Hi', '2023-03-07 23:30:40'),
(40, 'Admin', 'Alidou2', 'cc', '2023-03-07 23:30:45'),
(41, 'Alidou2', 'Bawba1', 'salut', '2023-03-09 14:42:40'),
(42, 'Bawba1', 'Alidou2', 'cc', '2023-03-09 14:42:43'),
(43, 'Alidou2', 'Bawba1', 'SALUT', '2023-03-19 21:44:45'),
(44, 'Alassane1', 'Bawba1', 'Salut', '2023-03-20 03:08:54'),
(45, 'Bawba1', 'Alassane1', 'cc', '2023-03-20 03:09:01');

-- --------------------------------------------------------

--
-- Structure de la table `postgroupe`
--

CREATE TABLE `postgroupe` (
  `id_posteG` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `texte` text NOT NULL,
  `photo_poste` text NOT NULL,
  `date_poste` date NOT NULL,
  `id_groupe` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `postgroupe`
--

INSERT INTO `postgroupe` (`id_posteG`, `id_utilisateur`, `texte`, `photo_poste`, `date_poste`, `id_groupe`) VALUES
(2, 2, 'cc', '', '2023-03-07', 23),
(4, 2, 'BONJOUR', 'posteGroupe/16792618292.PNG', '2023-03-19', 6),
(5, 4, 'CC', 'posteGroupe/1679279254logoESTDSM7.PNG', '2023-03-20', 4),
(7, 8, 'TMS', 'posteGroupe/1679280748tmsf.jpg', '2023-03-20', 4);

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

CREATE TABLE `posts` (
  `id_poste` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `poste_image` text NOT NULL,
  `poste_texte` text NOT NULL,
  `date_poste` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `posts`
--

INSERT INTO `posts` (`id_poste`, `id_utilisateur`, `poste_image`, `poste_texte`, `date_poste`) VALUES
(63, 1, 'poste/16781353032304226.png', 'Bonjour a tous', '2023-03-06 20:41:43'),
(71, 4, 'poste/1678739497logoest.jpeg', 'My school', '2023-03-13 20:31:37'),
(77, 2, 'poste/16792611982.PNG', 'OUAGADOUGOU', '2023-03-19 21:26:38'),
(79, 2, 'poste/16792612962.PNG', 'OUAGADOUGOU', '2023-03-19 21:28:16'),
(81, 8, 'poste/167927997927f14c2_1665768159002-000-32le867.jpg', 'PR', '2023-03-20 02:39:39');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id_utilisateur` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `filiere` varchar(255) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'DECONNECTE',
  `derniere_connexion` datetime NOT NULL DEFAULT current_timestamp(),
  `date_inscription` datetime NOT NULL DEFAULT current_timestamp(),
  `sessionID` text NOT NULL,
  `connectionID` varchar(255) NOT NULL,
  `description` text NOT NULL DEFAULT 'Parcours Scolaire (actuel, le baccalauréat intéresse souvent peu le jury sauf s’il s’agit d’un baccalauréat spécial)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id_utilisateur`, `nom`, `prenom`, `filiere`, `pseudo`, `mot_de_passe`, `photo`, `status`, `derniere_connexion`, `date_inscription`, `sessionID`, `connectionID`, `description`) VALUES
(1, 'ADMIN', 'ADMIN', 'GI-2A', 'Admin', '$2y$10$gWXTMk28Gg2QM8t6RDqZbOGP97xWS2BTXcsTUGZMKgjIUJVzPawUm', '../image-utilisateurs/Admin2206368.png', 'DECONNECTE', '2023-03-07 23:53:28', '2023-03-06 20:01:13', '6cduejf76o69dlkthgr7k3up4j', '99', 'Parcours Scolaire (actuel, le baccalauréat intéresse souvent peu le jury sauf s’il s’agit d’un baccalauréat spécial)'),
(2, 'MAHJOUBA', 'MAHMMOUD', 'GI-2A', 'Alidou2', '$2y$10$hJefbC9y9VOviy53I13et.Z.WlxewU3zh3Jr/rWC5jI2gE.oln3Oy', '../image-utilisateurs/Alidou2mg.jpg', 'CONNECTE', '2023-03-20 01:11:28', '2023-03-07 20:52:04', 'gjgeq89rnvp6g3l5pngpone021', '117', 'YUI'),
(4, 'BAWBA', 'EL HAJ', 'GI-2A', 'Bawba1', '$2y$10$u1suPwbbW61bfenS.eHeduOSVtErs6PyQbbfxGl7pD4ySVHyxHV3q', '../image-utilisateurs/Bawba1Alidou123Bouba11bouba.jpg', 'CONNECTE', '2023-03-20 01:11:22', '2023-03-09 14:38:32', '8bfeo8jc83ar8tcdnn8tfv1bqb', '168', 'Parcours Scolaire (actuel, le baccalauréat intéresse souvent peu le jury sauf s’il s’agit d’un baccalauréat spécial)'),
(8, 'KI', 'ALASSANE', 'GI-2A', 'Alassane1', '$2y$10$KPwov/M0O.vJMraNFQIPZOSrtOd.DiORTGhdapWnZNZ4Krr4aYu36', '../image-utilisateurs/Alassane1ts.jpg', 'CONNECTE', '2023-03-20 03:00:06', '2023-03-20 02:22:07', 'u5ihkstag6tae8nnmqffjgn87v', '165', 'Salut,je me nomme Alassane');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `commentairegroupe`
--
ALTER TABLE `commentairegroupe`
  ADD PRIMARY KEY (`id_commentaireG`);

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id_commentaire`),
  ADD KEY `fk_poste` (`id_poste`),
  ADD KEY `fk_utilisateur` (`id_utilisateur`) USING BTREE;

--
-- Index pour la table `follow_list`
--
ALTER TABLE `follow_list`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `groupe`
--
ALTER TABLE `groupe`
  ADD PRIMARY KEY (`id_groupe`);

--
-- Index pour la table `invitation`
--
ALTER TABLE `invitation`
  ADD PRIMARY KEY (`id_invitation`);

--
-- Index pour la table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id_like`),
  ADD KEY `fp_ut` (`id_utilisateur`);

--
-- Index pour la table `likesg`
--
ALTER TABLE `likesg`
  ADD PRIMARY KEY (`id_likesg`);

--
-- Index pour la table `membregroupe`
--
ALTER TABLE `membregroupe`
  ADD PRIMARY KEY (`id_Membregroupe`),
  ADD KEY `fkd` (`id_groupe`),
  ADD KEY `fkutilis` (`id_utilisateur`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id_message`),
  ADD KEY `fkMessageUtilisateurs1` (`pseudo_recepteur`),
  ADD KEY `fkMessagesUtilisateurs` (`pseudo_envoyeur`);

--
-- Index pour la table `postgroupe`
--
ALTER TABLE `postgroupe`
  ADD PRIMARY KEY (`id_posteG`),
  ADD KEY `fkutilisateur` (`id_utilisateur`);

--
-- Index pour la table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id_poste`),
  ADD KEY `fk_us` (`id_utilisateur`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id_utilisateur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `commentairegroupe`
--
ALTER TABLE `commentairegroupe`
  MODIFY `id_commentaireG` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `id_commentaire` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `follow_list`
--
ALTER TABLE `follow_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pour la table `groupe`
--
ALTER TABLE `groupe`
  MODIFY `id_groupe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `invitation`
--
ALTER TABLE `invitation`
  MODIFY `id_invitation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT pour la table `likes`
--
ALTER TABLE `likes`
  MODIFY `id_like` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `likesg`
--
ALTER TABLE `likesg`
  MODIFY `id_likesg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `membregroupe`
--
ALTER TABLE `membregroupe`
  MODIFY `id_Membregroupe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id_message` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT pour la table `postgroupe`
--
ALTER TABLE `postgroupe`
  MODIFY `id_posteG` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `posts`
--
ALTER TABLE `posts`
  MODIFY `id_poste` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `fk_com` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateurs` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_poste` FOREIGN KEY (`id_poste`) REFERENCES `posts` (`id_poste`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `fp_ut` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateurs` (`id_utilisateur`);

--
-- Contraintes pour la table `membregroupe`
--
ALTER TABLE `membregroupe`
  ADD CONSTRAINT `fkd` FOREIGN KEY (`id_groupe`) REFERENCES `groupe` (`id_groupe`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fkutilis` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateurs` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `postgroupe`
--
ALTER TABLE `postgroupe`
  ADD CONSTRAINT `fkutilisateur` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateurs` (`id_utilisateur`);

--
-- Contraintes pour la table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `fk_us` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateurs` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
