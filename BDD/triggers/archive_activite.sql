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