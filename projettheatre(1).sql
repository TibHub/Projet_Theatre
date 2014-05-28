-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Dim 03 Février 2013 à 14:10
-- Version du serveur: 5.5.24-log
-- Version de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `projettheatre`
--

-- --------------------------------------------------------

--
-- Structure de la table `activite`
--

CREATE TABLE IF NOT EXISTS `activite` (
  `id_activite` int(11) NOT NULL AUTO_INCREMENT,
  `type` text NOT NULL,
  `id_spec` int(11) NOT NULL,
  PRIMARY KEY (`id_activite`),
  KEY `FK_ACTIVITE_SPEC` (`id_spec`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `amis`
--

CREATE TABLE IF NOT EXISTS `amis` (
  `id_utilisateur1` int(11) NOT NULL,
  `id_utilisateur2` int(11) NOT NULL,
  PRIMARY KEY (`id_utilisateur1`,`id_utilisateur2`),
  KEY `FK_AMIS_UTIL2` (`id_utilisateur2`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE IF NOT EXISTS `commentaire` (
  `id_com` int(11) NOT NULL AUTO_INCREMENT,
  `texte` text NOT NULL,
  `note` float NOT NULL,
  `date` datetime NOT NULL,
  `id_spec` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  PRIMARY KEY (`id_com`),
  KEY `id_spec` (`id_spec`),
  KEY `FK_COMM_UTILISATEUR` (`id_utilisateur`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Contenu de la table `commentaire`
--

INSERT INTO `commentaire` (`id_com`, `texte`, `note`, `date`, `id_spec`, `id_utilisateur`) VALUES
(1, 'SUPER, je recommande !', 3, '2013-01-09 10:28:34', 3, 1),
(2, 'J''ai pas compris la fin.', 1.5, '2013-01-01 19:45:45', 1, 2),
(3, 'Mais, vous savez, moi je ne crois pas qu''il y ait de bonne ou de mauvaise situation. Moi, si je devais résumer ma vie aujourd''hui avec vous, je dirais que c''est d''abord des rencontres, des gens qui m''ont tendu la main, peut-être à un moment où je ne pouvais pas, où j''étais seul chez moi. Et c''est assez curieux de se dire que les hasards, les rencontres forgent une destinée... Parce que quand on a le goût de la chose, quand on a le goût de la chose bien faite, le beau geste, parfois on ne trouve pas l''interlocuteur en face, je dirais, le miroir qui vous aide à avancer. Alors ce n''est pas mon cas, comme je le disais là, puisque moi au contraire, j''ai pu ; et je dis merci à la vie, je lui dis merci, je chante la vie, je danse la vie... Je ne suis qu''amour ! Et finalement, quand beaucoup de gens aujourd''hui me disent "Mais comment fais-tu pour avoir cette humanité ?", eh ben je leur réponds très simplement, je leur dis que c''est ce goût de l''amour, ce goût donc qui m''a poussé aujourd''hui à entreprendre une construction mécanique, mais demain, qui sait, peut-être seulement à me mettre au service de la communauté, à faire le don, le don de soi...', 0, '2013-01-12 11:27:18', 1, 1),
(4, 'SUPER', 3, '2013-02-02 16:53:01', 2, 1),
(5, 'Beau spectable !!!!', 4, '2013-02-02 16:53:33', 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `demande_ami`
--

CREATE TABLE IF NOT EXISTS `demande_ami` (
  `id_utilisateur1` int(11) NOT NULL,
  `id_utilisateur2` int(11) NOT NULL,
  PRIMARY KEY (`id_utilisateur1`,`id_utilisateur2`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `genre`
--

CREATE TABLE IF NOT EXISTS `genre` (
  `id_genre` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(30) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  PRIMARY KEY (`id_genre`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `genre`
--

INSERT INTO `genre` (`id_genre`, `libelle`) VALUES
(1, 'Tragédie'),
(2, 'Comédie musicale');

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `id_mess` int(11) NOT NULL AUTO_INCREMENT,
  `texte` text COLLATE latin1_bin NOT NULL,
  `date` datetime NOT NULL,
  `estLu` tinyint(1) NOT NULL,
  `id_exp` int(11) NOT NULL,
  `id_dest` int(11) NOT NULL,
  PRIMARY KEY (`id_mess`),
  KEY `FK_MESS_EXP` (`id_exp`),
  KEY `FK_MESS_DEST` (`id_dest`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_bin AUTO_INCREMENT=6 ;

--
-- Contenu de la table `message`
--

INSERT INTO `message` (`id_mess`, `texte`, `date`, `estLu`, `id_exp`, `id_dest`) VALUES
(1, 'IL\r\nEST\r\n\r\nTEMPS DE FINIR CE PROJET\r\n\r\n;)', '2013-02-21 08:37:00', 1, 3, 1),
(2, 'Ã Ã§Ã¨Ã©', '2013-02-03 09:10:41', 0, 1, 3),
(3, 'RE', '2013-02-03 09:11:32', 0, 1, 3),
(4, 'C est clair', '2013-02-03 14:58:46', 0, 1, 3),
(5, 'c''est clair', '2013-02-03 15:00:43', 0, 1, 3);

-- --------------------------------------------------------

--
-- Structure de la table `note`
--

CREATE TABLE IF NOT EXISTS `note` (
  `id_note` int(11) NOT NULL AUTO_INCREMENT,
  `note` int(11) NOT NULL,
  `id_spec` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  PRIMARY KEY (`id_note`),
  KEY `FK_NOTE_SPEC` (`id_spec`),
  KEY `FK_NOTE_UTIL` (`id_utilisateur`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_bin AUTO_INCREMENT=7 ;

--
-- Contenu de la table `note`
--

INSERT INTO `note` (`id_note`, `note`, `id_spec`, `id_utilisateur`) VALUES
(1, 3, 1, 1),
(2, 2, 2, 1),
(3, 4, 3, 1),
(4, 1, 1, 2),
(5, 5, 2, 2),
(6, 3, 3, 2);

-- --------------------------------------------------------

--
-- Structure de la table `notification`
--

CREATE TABLE IF NOT EXISTS `notification` (
  `id_notif` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `id_exp` int(11) NOT NULL,
  `id_dest` int(11) NOT NULL,
  `id_activite` int(11) NOT NULL,
  PRIMARY KEY (`id_notif`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `place`
--

CREATE TABLE IF NOT EXISTS `place` (
  `refPlace` int(11) NOT NULL AUTO_INCREMENT,
  `num` int(11) NOT NULL,
  `prix` int(11) NOT NULL,
  `id_representation` int(11) NOT NULL,
  `id_utilisateur` int(11) DEFAULT NULL,
  PRIMARY KEY (`refPlace`),
  KEY `FK_PLACE_SPEC` (`id_representation`),
  KEY `FK_PLACE_UTIL` (`id_utilisateur`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_bin AUTO_INCREMENT=5 ;

--
-- Contenu de la table `place`
--

INSERT INTO `place` (`refPlace`, `num`, `prix`, `id_representation`, `id_utilisateur`) VALUES
(2, 2, 23, 1, 1),
(3, 3, 25, 1, 1),
(4, 1, 25, 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `representation`
--

CREATE TABLE IF NOT EXISTS `representation` (
  `id_representation` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `id_spec` int(11) NOT NULL,
  `id_salle` int(11) NOT NULL,
  PRIMARY KEY (`id_representation`),
  KEY `FK_REP_SPEC` (`id_spec`),
  KEY `FK_REP_SALLE` (`id_salle`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_bin AUTO_INCREMENT=3 ;

--
-- Contenu de la table `representation`
--

INSERT INTO `representation` (`id_representation`, `date`, `id_spec`, `id_salle`) VALUES
(1, '2013-01-31 15:00:00', 4, 1),
(2, '2013-02-06 14:30:00', 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `salle`
--

CREATE TABLE IF NOT EXISTS `salle` (
  `id_salle` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(30) NOT NULL,
  `capacite` int(11) NOT NULL,
  PRIMARY KEY (`id_salle`),
  UNIQUE KEY `nom` (`nom`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `salle`
--

INSERT INTO `salle` (`id_salle`, `nom`, `capacite`) VALUES
(1, 'Vulpian', 105);

-- --------------------------------------------------------

--
-- Structure de la table `spectacle`
--

CREATE TABLE IF NOT EXISTS `spectacle` (
  `id_spec` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) COLLATE latin1_bin NOT NULL,
  `distribution` varchar(255) COLLATE latin1_bin NOT NULL,
  `synopsis` text COLLATE latin1_bin NOT NULL,
  `adresseImg` varchar(100) COLLATE latin1_bin NOT NULL,
  `id_genre` int(11) NOT NULL,
  PRIMARY KEY (`id_spec`),
  KEY `FK_SPEC_GENRE` (`id_genre`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_bin AUTO_INCREMENT=5 ;

--
-- Contenu de la table `spectacle`
--

INSERT INTO `spectacle` (`id_spec`, `titre`, `distribution`, `synopsis`, `adresseImg`, `id_genre`) VALUES
(1, 'Romeo et Juliette', 'Universal', 'Romeo meurt et Juliette meurt.', 'vue/ImagesTheatre/romeo_et_juliette.jpg', 1),
(2, 'West Side Story', 'Universal', 'Un mec saute.', 'vue/ImagesTheatre/west_side_story.jpg', 2),
(3, 'Black Swan', 'Universal', '2 heures pendant lesquelles on ne comprend pas grand chose.', 'vue/ImagesTheatre/black_swan.jpg', 1),
(4, 'Sister Act', 'Don''t know', '...', 'vue/ImagesTheatre/sister_act.jpg', 2);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(20) COLLATE latin1_bin NOT NULL,
  `mdp` varchar(20) COLLATE latin1_bin NOT NULL,
  PRIMARY KEY (`id_utilisateur`),
  UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_bin AUTO_INCREMENT=4 ;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_utilisateur`, `login`, `mdp`) VALUES
(1, 'LOSTisaDRUG', '12345'),
(2, 'narutoxXx', 'lol'),
(3, 'david', 'zamani6');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `activite`
--
ALTER TABLE `activite`
  ADD CONSTRAINT `FK_ACTIVITE_SPEC` FOREIGN KEY (`id_spec`) REFERENCES `spectacle` (`id_spec`);

--
-- Contraintes pour la table `amis`
--
ALTER TABLE `amis`
  ADD CONSTRAINT `FK_AMIS_UTIL1` FOREIGN KEY (`id_utilisateur1`) REFERENCES `utilisateur` (`id_utilisateur`),
  ADD CONSTRAINT `FK_AMIS_UTIL2` FOREIGN KEY (`id_utilisateur2`) REFERENCES `utilisateur` (`id_utilisateur`);

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `FK_COMM_SPEC` FOREIGN KEY (`id_spec`) REFERENCES `spectacle` (`id_spec`),
  ADD CONSTRAINT `FK_COMM_UTILISATEUR` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`);

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `FK_MESS_EXP` FOREIGN KEY (`id_exp`) REFERENCES `utilisateur` (`id_utilisateur`),
  ADD CONSTRAINT `FK_MESS_DEST` FOREIGN KEY (`id_dest`) REFERENCES `utilisateur` (`id_utilisateur`);

--
-- Contraintes pour la table `note`
--
ALTER TABLE `note`
  ADD CONSTRAINT `FK_NOTE_SPEC` FOREIGN KEY (`id_spec`) REFERENCES `spectacle` (`id_spec`),
  ADD CONSTRAINT `FK_NOTE_UTIL` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`);

--
-- Contraintes pour la table `place`
--
ALTER TABLE `place`
  ADD CONSTRAINT `FK_PLACE_SPEC` FOREIGN KEY (`id_representation`) REFERENCES `representation` (`id_representation`),
  ADD CONSTRAINT `FK_PLACE_UTIL` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`);

--
-- Contraintes pour la table `representation`
--
ALTER TABLE `representation`
  ADD CONSTRAINT `FK_REP_SALLE` FOREIGN KEY (`id_salle`) REFERENCES `salle` (`id_salle`),
  ADD CONSTRAINT `FK_REP_SPEC` FOREIGN KEY (`id_spec`) REFERENCES `spectacle` (`id_spec`);

--
-- Contraintes pour la table `spectacle`
--
ALTER TABLE `spectacle`
  ADD CONSTRAINT `FK_SPEC_GENRE` FOREIGN KEY (`id_genre`) REFERENCES `genre` (`id_genre`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
