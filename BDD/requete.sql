Nombre d’activité des agendas par catégorie et par utilisateur.

SELECT u.nom, t.nomCategorie, count(*) 
FROM agenda a, activite ac, categorie_agenda ca, categorie t, utilisateur u 
WHERE a.idAgenda = ac.idAgenda 
AND t.idCategorie = ca.idCategorie 
AND a.idUtilisateur = u.idUtilisateur 
GROUP BY u.nom, t.nomCategorie;

Nombre de commentaires total pour les utilisateurs actifs (
utilisateurs ayant édité un agenda 
au cours des trois derniers mois).

SELECT commentaire, count(*) 
FROM commentaire c NATURAL JOIN utilisateur 
WHERE DATE_SUB(CURDATE(), INTERVAL 3 MONTH) < (SELECT max(dateCommentaire)
	FROM commentaire WHERE idUtilisateur = c.idUtilisateur) 
GROUP BY idUtilisateur;

Les activités ayant eu au moins cinq évaluations
et dont la note moyenne est inférieure à trois

SELECT titre 
FROM activite a NATURAL JOIN notation n 
WHERE (SELECT count(*) FROM Commentaire 
	WHERE a.idActivite = n.idActivite) > 5 
	AND (SELECT avg(note) 
	FROM notation 
	WHERE a.idActivite=n.idActivite) < 3;

