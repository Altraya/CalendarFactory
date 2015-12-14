-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 14 Décembre 2015 à 09:37
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `calendarfactory`
--

-- --------------------------------------------------------

--
-- Structure de la table `activite`
--

CREATE TABLE IF NOT EXISTS `activite` (
  `idActivite` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(45) NOT NULL,
  `description` text,
  `positionGeographique` varchar(45) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  `priorite` varchar(45) DEFAULT '0' COMMENT 'Priorité sous forme dINT 0 correspondant a la priorite la plus faible',
  `dateDebut` date NOT NULL COMMENT 'Date de debut de lactivite. Soit dateDebut - dateFin et periodicite sont remplis soit dateDebut et nbOccurence',
  `dateFin` date DEFAULT NULL,
  `heureDebut` time DEFAULT NULL COMMENT 'Si aucun horraire de début ni de fin n est specifie levenement aura lieu sur toute la journee',
  `heureFin` time DEFAULT NULL COMMENT 'Si aucun horraire de début ni de fin n est specifie levenement aura lieu sur toute la journee',
  `periodicite` varchar(45) DEFAULT NULL COMMENT 'Exemple : 2 semaines',
  `nbOccurence` int(11) DEFAULT NULL,
  `estEnPause` tinyint(1) DEFAULT '0' COMMENT 'Permet de savoir si lactivite est en pause cest a dire quen cas de periodicite on ne va pas compter les occurences / DEFAUT FALSE',
  `estPossibleDeSinscrire` tinyint(1) DEFAULT '0' COMMENT 'Permet de savoir si on autorise les utilisateurs a sincrire pour cette activite / Defaut FALSE',
  `estPublic` tinyint(1) DEFAULT '0' COMMENT 'Permet de savoir si l activite autorise les commentaires pour tous les utilisateurs ou seulement pour les utilisateurs inscrits a cette activite. FALSE represente prive / TRUE public / Par defaut en prive',
  `idAgenda` int(11) DEFAULT NULL COMMENT 'id de l agenda auquel l activite appartient',
  PRIMARY KEY (`idActivite`),
  KEY `fk_ACTIVITE_agenda` (`idAgenda`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Déclencheurs `activite`
--
DROP TRIGGER IF EXISTS `archive_activite`;
DELIMITER //
CREATE TRIGGER `archive_activite` BEFORE DELETE ON `activite`
 FOR EACH ROW begin
	insert into activite_archive
		(
			idActiviteArchive,
            titre,
            description,
            positionGeographique,
            type,
            priorite,
            dateDebut,
            dateFin,
            heureDebut,
            heureFin,
            periodicite,
            nbOccurence,
            estEnPause,
            estPossibleDeSinscrire,
            estPublic,
            idAgendaArchive) 
		values
		(
			old.idActivite,
            old.titre,
            old.description,
            old.positionGeographique,
            old.type,
            old.priorite,
            old.dateDebut,
            old.dateFin,
            old.heureDebut,
            old.heureFin,
            old.periodicite,
            old.nbOccurence,
            old.estEnPause,
            old.estPossibleDeSinscrire,
            old.estPublic,
            old.idAgenda
			);
end
//
DELIMITER ;
DROP TRIGGER IF EXISTS `lessThan50`;
DELIMITER //
CREATE TRIGGER `lessThan50` BEFORE INSERT ON `activite`
 FOR EACH ROW BEGIN
	declare i integer;
    declare c_v integer;
    declare c cursor for 
    select idActivite from activite
    where new.idAgenda = idAgenda 
    and DateDebut between new.DateDebut and new.DateDebut+ interval 7 day; 
	
    open c;
    set i = 0;
    get_activite : loop
	fetch c into c_v;
    set i=i+1;
    end loop get_activite;
    
    if(i>50) then 
    	CALL raise_application_error(3001, 'no update');
    end if;
   
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `activite_archive`
--

CREATE TABLE IF NOT EXISTS `activite_archive` (
  `idActiviteArchive` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(45) NOT NULL,
  `description` text,
  `positionGeographique` varchar(45) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  `priorite` varchar(45) DEFAULT '0' COMMENT 'Priorité sous forme dINT 0 correspondant a la priorite la plus faible',
  `dateDebut` date NOT NULL COMMENT 'Date de debut de lactivite. Soit dateDebut - dateFin et periodicite sont remplis soit dateDebut et nbOccurence',
  `dateFin` date DEFAULT NULL,
  `heureDebut` time DEFAULT NULL COMMENT 'Si aucun horraire de début ni de fin n est specifie levenement aura lieu sur toute la journee',
  `heureFin` time DEFAULT NULL COMMENT 'Si aucun horraire de début ni de fin n est specifie levenement aura lieu sur toute la journee',
  `periodicite` varchar(45) DEFAULT NULL COMMENT 'Exemple : 2 semaines',
  `nbOccurence` int(11) DEFAULT NULL,
  `estEnPause` tinyint(1) DEFAULT '0' COMMENT 'Permet de savoir si lactivite est en pause cest a dire quen cas de periodicite on ne va pas compter les occurences / DEFAUT FALSE',
  `estPossibleDeSinscrire` tinyint(1) DEFAULT '0' COMMENT 'Permet de savoir si on autorise les utilisateurs a sincrire pour cette activite / Defaut FALSE',
  `estPublic` tinyint(1) DEFAULT '0' COMMENT 'Permet de savoir si l activite autorise les commentaires pour tous les utilisateurs ou seulement pour les utilisateurs inscrits a cette activite. FALSE represente prive / TRUE public / Par defaut en prive',
  `idAgendaArchive` int(11) DEFAULT NULL COMMENT 'id de l agenda auquel l activite appartient',
  PRIMARY KEY (`idActiviteArchive`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `activite_archive`
--

INSERT INTO `activite_archive` (`idActiviteArchive`, `titre`, `description`, `positionGeographique`, `type`, `priorite`, `dateDebut`, `dateFin`, `heureDebut`, `heureFin`, `periodicite`, `nbOccurence`, `estEnPause`, `estPossibleDeSinscrire`, `estPublic`, `idAgendaArchive`) VALUES
(1, 'testact', 'aezgehrt', 'Lyon', 'typique o/', NULL, '2015-12-11', '2015-12-12', '03:00:00', '04:00:00', NULL, 5, NULL, NULL, NULL, 9),
(2, 'Projet BDD', NULL, 'Strasbourg', 'Travail', '9000', '2015-12-12', '2015-12-14', '00:00:00', '00:00:00', NULL, 1, 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `agenda`
--

CREATE TABLE IF NOT EXISTS `agenda` (
  `idAgenda` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) NOT NULL COMMENT 'nom de l''agenda',
  `priorite` int(11) DEFAULT '0' COMMENT 'Priorité sous forme dINT 0 correspondant a la priorite la plus faible',
  `lastEdition` date DEFAULT NULL COMMENT 'Date de la dernière édition de lagenda',
  `estSuperposable` tinyint(1) NOT NULL COMMENT 'Permet de savoir si on peut superposer cet agenda avec un autre agenda qui est defini comme superposable',
  `idUtilisateur` int(11) DEFAULT NULL COMMENT 'Id de l utilisateur qui a cree l agenda',
  PRIMARY KEY (`idAgenda`),
  KEY `fk_AGENDA_utilisateur` (`idUtilisateur`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

--
-- Déclencheurs `agenda`
--
DROP TRIGGER IF EXISTS `archive_agenda`;
DELIMITER //
CREATE TRIGGER `archive_agenda` BEFORE DELETE ON `agenda`
 FOR EACH ROW begin
	insert into agenda_archive
		(
			idAgendaArchive,
            nom,
            priorite,
            lastEdition,
            estSuperposable,
            idUtilisateur) 
		values
		(
			old.idAgenda,
			old.nom,
			old.priorite,
			old.lastEdition,
            old.estSuperposable,
            old.idUtilisateur
			);
end
//
DELIMITER ;

INSERT INTO `calendarfactory`.`agenda` (`idAgenda`, `nom`, `priorite`, `lastEdition`, `estSuperposable`, `idUtilisateur`) VALUES (NULL, 'Mes cours', '1', NULL, '1', '1');
INSERT INTO `calendarfactory`.`agenda` (`idAgenda`, `nom`, `priorite`, `lastEdition`, `estSuperposable`, `idUtilisateur`) VALUES (NULL, 'Elise agenda', '1', NULL, '1', '2');
INSERT INTO `calendarfactory`.`agenda` (`idAgenda`, `nom`, `priorite`, `lastEdition`, `estSuperposable`, `idUtilisateur`) VALUES (NULL, 'Loisirs', '1', NULL, '1', '1');


-- --------------------------------------------------------

--
-- Structure de la table `agenda_archive`
--

CREATE TABLE IF NOT EXISTS `agenda_archive` (
  `idAgendaArchive` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) NOT NULL COMMENT 'nom de l''agenda',
  `priorite` int(11) DEFAULT NULL,
  `lastEdition` date DEFAULT NULL,
  `estSuperposable` tinyint(1) DEFAULT NULL COMMENT 'Permet de savoir si on peut superposer cet agenda avec un autre agenda qui est defini comme superposable',
  `idUtilisateur` int(11) DEFAULT NULL COMMENT 'Id de l utilisateur qui a cree l agenda',
  PRIMARY KEY (`idAgendaArchive`),
  KEY `fk_AGENDA_ARCHIVE_utilisateur` (`idUtilisateur`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Contenu de la table `agenda_archive`
--

INSERT INTO `agenda_archive` (`idAgendaArchive`, `nom`, `priorite`, `lastEdition`, `estSuperposable`, `idUtilisateur`) VALUES
(1, 'Mes cours', 42, '0000-00-00', 1, 1),
(3, 'test', 2, '0000-00-00', 0, 1),
(4, 'test', 2, '0000-00-00', 0, 1),
(5, 'test', 2, '0000-00-00', 0, 1),
(6, 'test', 2, '0000-00-00', 0, 1),
(7, 'test', 2, '0000-00-00', 0, 1),
(8, 'test', 2, '0000-00-00', 0, 1),
(9, 'test', 2, '0000-00-00', 0, 1),
(10, 'lol', 4, '0000-00-00', 0, 1),
(11, 'lol', 4, '0000-00-00', 0, 1),
(12, 'lol', 4, '0000-00-00', 0, 1),
(13, 'lol', 4, '0000-00-00', 0, 1),
(14, 'lol', 4, '0000-00-00', 0, 1),
(15, 'lol', 4, '0000-00-00', 0, 1),
(16, 'Mes cours', 1, '0000-00-00', 0, 1),
(17, 'Mes cours', 1, '0000-00-00', 0, 1),
(18, 'Poney', 5, '0000-00-00', 0, 1),
(19, 'coucou', 1, '0000-00-00', 0, 2),
(20, 'coucou', 5, '0000-00-00', 0, 2),
(21, 'coucou', 5, '0000-00-00', 0, 2),
(22, 'Mes cours', 1, '0000-00-00', 0, 2),
(24, 'Mon agenda', 5, NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `agenda_possede_par_utilisateur`
--

CREATE TABLE IF NOT EXISTS `agenda_possede_par_utilisateur` (
  `idAgenda` int(11) NOT NULL DEFAULT '0',
  `idUtilisateur` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idAgenda`,`idUtilisateur`),
  KEY `fk_AGENDA_POSSEDE_PAR_UTILISATEUR_utilisateur` (`idUtilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE IF NOT EXISTS `categorie` (
  `idCategorie` int(11) NOT NULL AUTO_INCREMENT,
  `nomCategorie` varchar(45) NOT NULL,
  PRIMARY KEY (`idCategorie`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Structure de la table `categorie_agenda`
--

CREATE TABLE IF NOT EXISTS `categorie_agenda` (
  `idAgenda` int(11) NOT NULL DEFAULT '0',
  `idCategorie` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idAgenda`,`idCategorie`),
  KEY `fk_CATEGORIE_AGENDA_categorie` (`idCategorie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE IF NOT EXISTS `commentaire` (
  `idCommentaire` int(11) NOT NULL AUTO_INCREMENT,
  `commentaire` text,
  `dateCommentaire` date DEFAULT NULL,
  `heureCommentaire` time DEFAULT NULL,
  `idCommentaireParent` int(11) DEFAULT NULL COMMENT 'Id du commentaire parent dans le cas d une reponse, est null si ce nest pas une reponse',
  `idUtilisateur` int(11) DEFAULT NULL COMMENT 'Id de lutilisateur qui a poste le commentaire',
  `idActivite` int(11) DEFAULT NULL COMMENT 'id de lactivite auquel le commentaire est associe',
  PRIMARY KEY (`idCommentaire`),
  KEY `fk_COMMENTAIRE_commentaireParent` (`idCommentaireParent`),
  KEY `fk_COMMENTAIRE_utilisateur` (`idUtilisateur`),
  KEY `fk_COMMENTAIRE_activite` (`idActivite`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Structure de la table `inscription`
--

CREATE TABLE IF NOT EXISTS `inscription` (
  `idUtilisateur` int(11) NOT NULL DEFAULT '0' COMMENT 'id de l utilisateur qui s inscrit a l activite',
  `idActivite` int(11) NOT NULL DEFAULT '0' COMMENT 'id de l activite a laquelle il s est inscrite',
  PRIMARY KEY (`idUtilisateur`,`idActivite`),
  KEY `fk_INSCRIPTION_activite` (`idActivite`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `invitation_activite`
--

CREATE TABLE IF NOT EXISTS `invitation_activite` (
  `idUtilisateurHote` int(11) NOT NULL DEFAULT '0' COMMENT 'id de l utilisateur qui nous invite a l activite',
  `idActivite` int(11) NOT NULL DEFAULT '0' COMMENT 'id de l activite auquel l hote nous invite',
  `idUtilisateurInvite` int(11) NOT NULL DEFAULT '0' COMMENT 'id de l utilisateur qui sest fait inviter a l activite',
  PRIMARY KEY (`idUtilisateurHote`,`idActivite`,`idUtilisateurInvite`),
  KEY `fk_INVITATION_ACTIVITE_activite` (`idActivite`),
  KEY `fk_INVITATION_ACTIVITE_invite` (`idUtilisateurInvite`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `liker`
--

CREATE TABLE IF NOT EXISTS `liker` (
  `idUtilisateur` int(11) NOT NULL DEFAULT '0',
  `idCommentaire` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idUtilisateur`,`idCommentaire`),
  KEY `fk_LIKER_commentaire` (`idCommentaire`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `notation`
--

CREATE TABLE IF NOT EXISTS `notation` (
  `idUtilisateur` int(11) NOT NULL DEFAULT '0' COMMENT 'id de l utilisateur qui va noter l activite',
  `idActivite` int(11) NOT NULL DEFAULT '0' COMMENT 'id de lactivite que l on note',
  `note` int(11) DEFAULT NULL COMMENT 'note donnee de 1 a 5',
  PRIMARY KEY (`idUtilisateur`,`idActivite`),
  KEY `fk_NOTATION_activite` (`idActivite`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `sabonner`
--

CREATE TABLE IF NOT EXISTS `sabonner` (
  `idUtilisateur` int(11) NOT NULL DEFAULT '0',
  `idAgenda` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idUtilisateur`,`idAgenda`),
  KEY `fk_SABONNER_agenda` (`idAgenda`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE IF NOT EXISTS `utilisateur` (
  `idUtilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(45) NOT NULL,
  `pwd` varchar(45) NOT NULL,
  `nom` varchar(45) NOT NULL,
  `prenom` varchar(45) NOT NULL,
  `adresse` varchar(45) NOT NULL,
  PRIMARY KEY (`idUtilisateur`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`idUtilisateur`, `login`, `pwd`, `nom`, `prenom`, `adresse`) VALUES
(1, 'LaTueuseDeDragon', 'a0d3e0799432fe1898df11e5f9dbd086635306f5', 'salut', 'test', 'test'),
(2, 'Elise', '9cf95dacd226dcf43da376cdb6cbba7035218921', 'Elise', 'Moebs', '6 rue de Rome 67000 Strasbourg');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `activite`
--
ALTER TABLE `activite`
  ADD CONSTRAINT `fk_ACTIVITE_agenda` FOREIGN KEY (`idAgenda`) REFERENCES `agenda` (`idAgenda`) ON DELETE CASCADE;

--
-- Contraintes pour la table `agenda`
--
ALTER TABLE `agenda`
  ADD CONSTRAINT `fk_AGENDA_utilisateur` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateur` (`idUtilisateur`) ON DELETE CASCADE;

--
-- Contraintes pour la table `agenda_archive`
--
ALTER TABLE `agenda_archive`
  ADD CONSTRAINT `fk_AGENDA_ARCHIVE_utilisateur` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateur` (`idUtilisateur`);

--
-- Contraintes pour la table `agenda_possede_par_utilisateur`
--
ALTER TABLE `agenda_possede_par_utilisateur`
  ADD CONSTRAINT `fk_AGENDA_POSSEDE_PAR_UTILISATEUR_utilisateur` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateur` (`idUtilisateur`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_AGENDA_POSSEDE_PAR_UTILISATEUR_agenda` FOREIGN KEY (`idAgenda`) REFERENCES `agenda` (`idAgenda`) ON DELETE CASCADE;

--
-- Contraintes pour la table `categorie_agenda`
--
ALTER TABLE `categorie_agenda`
  ADD CONSTRAINT `fk_CATEGORIE_AGENDA_categorie` FOREIGN KEY (`idCategorie`) REFERENCES `categorie` (`idCategorie`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_CATEGORIE_AGENDA_agenda` FOREIGN KEY (`idAgenda`) REFERENCES `agenda` (`idAgenda`) ON DELETE CASCADE;

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `fk_COMMENTAIRE_activite` FOREIGN KEY (`idActivite`) REFERENCES `activite` (`idActivite`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_COMMENTAIRE_commentaireParent` FOREIGN KEY (`idCommentaireParent`) REFERENCES `commentaire` (`idCommentaire`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_COMMENTAIRE_utilisateur` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateur` (`idUtilisateur`) ON DELETE CASCADE;

--
-- Contraintes pour la table `inscription`
--
ALTER TABLE `inscription`
  ADD CONSTRAINT `fk_INSCRIPTION_activite` FOREIGN KEY (`idActivite`) REFERENCES `activite` (`idActivite`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_INSCRIPTION_utilisateur` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateur` (`idUtilisateur`) ON DELETE CASCADE;

--
-- Contraintes pour la table `invitation_activite`
--
ALTER TABLE `invitation_activite`
  ADD CONSTRAINT `fk_INVITATION_ACTIVITE_invite` FOREIGN KEY (`idUtilisateurInvite`) REFERENCES `utilisateur` (`idUtilisateur`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_INVITATION_ACTIVITE_activite` FOREIGN KEY (`idActivite`) REFERENCES `activite` (`idActivite`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_INVITATION_ACTIVITE_hote` FOREIGN KEY (`idUtilisateurHote`) REFERENCES `utilisateur` (`idUtilisateur`) ON DELETE CASCADE;

--
-- Contraintes pour la table `liker`
--
ALTER TABLE `liker`
  ADD CONSTRAINT `fk_LIKER_commentaire` FOREIGN KEY (`idCommentaire`) REFERENCES `commentaire` (`idCommentaire`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_LIKER_utilisateur` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateur` (`idUtilisateur`) ON DELETE CASCADE;

--
-- Contraintes pour la table `notation`
--
ALTER TABLE `notation`
  ADD CONSTRAINT `fk_NOTATION_activite` FOREIGN KEY (`idActivite`) REFERENCES `activite` (`idActivite`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_NOTATION_utilisateur` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateur` (`idUtilisateur`) ON DELETE CASCADE;

--
-- Contraintes pour la table `sabonner`
--
ALTER TABLE `sabonner`
  ADD CONSTRAINT `fk_SABONNER_agenda` FOREIGN KEY (`idAgenda`) REFERENCES `agenda` (`idAgenda`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_SABONNER_utilisateur` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateur` (`idUtilisateur`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
