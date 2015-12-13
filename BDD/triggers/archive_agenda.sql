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