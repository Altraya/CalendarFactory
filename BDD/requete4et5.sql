/*
	L'agenda dont la moyenne des commentaires est le plus haut
    
    -> moyenne du nombre des commentaires de toutes les activités d'un agenda -> moyenne d'un agenda
    -> moyenne de tous les agendas

*/
	create temporary table commande_temp
    as
        SELECT COUNT(DISTINCT idCommentaire), activite.title, agenda.nom FROM commentaire NATURAL JOIN activite INNER JOIN agenda;

	SELECT idAgenda, nom, AVG(idCommentaire);




	SELECT login, utilisateur.nom, prenom, adresse, COUNT(DISTINCT agenda.idAgenda), COUNT(DISTINCT idActivite) from utilisateur, agenda, activite WHERE idUtilisateur = utilisateur.idUtilisateur;