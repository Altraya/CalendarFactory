<?php

require_once('Commentaire.class.php');

class CommentaireManager{

	private $_db;

	public function __construct($db){
		$this->setDb($db);
	}

	public function setDb(PDO $db){
		$this->_db = $db;
	}

	/**
	*	Add comment in database
	*	@param : commentaire object
	*	@return : false if the insert failed / else true
	*/

	public function add(Commentaire $commentaire){

		$idCommentaire = $commentaire->getIdCommentaire();
		$comment = $commentaire->getCommentaire();
		$dateCommentaire = $commentaire->getDateCommentaire();
		$heureCommentaire = $commentaire->getHeureCommentaire();
		$idCommentaireParent = $commentaire->getIdCommentaireParent();
		$idUtilisateur = $commentaire->getIdUtilisateur();
		$idActivite = $commentaire->getIdActivite();

		$sql = "INSERT INTO commentaire (idCommentaire, commentaire, dateCommentaire, heureCommentaire, idCommentaireParent, idUtilisateur, idActivite)
			VALUES (:idCommentaire, :commentaire, :dateCommentaire, :heureCommentaire, :idCommentaireParent, :idUtilisateur, :idActivite)";
		$req = $this->_db->prepare($sql);           
		$req->bindParam(':idCommentaire', $idCommentaire, PDO::PARAM_STR);
		$req->bindParam(':commentaire', $comment, PDO::PARAM_STR);
		$req->bindParam(':dateCommentaire', $dateCommentaire, PDO::PARAM_STR);
		$req->bindParam(':heureCommentaire', $heureCommentaire, PDO::PARAM_STR);
		$req->bindParam(':idCommentaireParent', $idCommentaireParent, PDO::PARAM_INT);
		$req->bindParam(':idUtilisateur', $idUtilisateur, PDO::PARAM_STR);
		$req->bindParam(':idActivite', $idActivite, PDO::PARAM_STR);
		$req->execute();
		$nbTupleInsere = $req->rowCount();
		$req->closeCursor();

		//check if insert has failed
		if($nbTupleInsere < 1)
			return false;
		return true;
	}

		//Delete  le commentaire donné en paramètre
	public function remove(Commentaire $commentaire){
		$idCommentaire = $commentaire->getIdCommentaire();
		$sql = "DELETE FROM commentaire WHERE idCommentaire = :idCommentaire ";
		$req = $this->_db->prepare($sql);
		$req->bindParam(':idCommentaire', $idCommentaire, PDO::PARAM_INT);
		$req->execute();
		$req->closeCursor();
	}

	/**
	*	Get comment with his ID
	*	@param : id : id of the comment we want to get
	*	@return : false if we have no result / else return an comment object
	*/
	public function getComment($id){
		$commentaire;
		$req = $this->_db->query('SELECT * 
								FROM commentaire WHERE idCommentaire = \''.$id.'\' ');
		while ($donnees = $req->fetch(PDO::FETCH_ASSOC)){
			$commentaire = new Commentaire($donnees);
		}
		$nbTupleObt = $req->rowCount();	
		$req->closeCursor();

		if($nbTupleObt < 1)
			return false;
		return $commentaire;

	}

	/**
	*	List all comments
	*	@return : false if the insert failed / else return an array of comment object
	*/
	public function getCommentsList(){
		$comment = array();
		$query = $this->_db->query('SELECT *
									FROM commentaire GROUP BY idActivite');
		while ($donnees = $query->fetch(PDO::FETCH_ASSOC)) {
			$comment[] = new Commentaire($donnees);
		}

		$nbTupleObt = $req->rowCount();	
		$req->closeCursor();

		if($nbTupleObt < 1)
			return false;
		return $comment;
	}

	/**
	*	Update comment in database
	*	@param : Activity object
	*	@return : false if the update failed / else true
	*/
	public function modify(Commentaire $commentaire){
		$sql = "UPDATE commentaire
			SET commentaire = :commentaire,
			dateCommentaire = :dateCommentaire,
			heureCommentaire = :heureCommentaire,
			idCommentaireParent = :idCommentaireParent,
			idUtilisateur = :idUtilisateur,
			idActivite = :idActivite
			WHERE idCommentaire = :idCommentaire";
		$req = $this->_db->prepare($sql);
		$req->bindParam(':commentaire', $commentaire->getCommentaire(), PDO::PARAM_STR);
		$req->bindParam(':dateCommentaire', $commentaire->getDateCommentaire(), PDO::PARAM_STR);
		$req->bindParam(':heureCommentaire', $commentaire->getHeureCommentaire(), PDO::PARAM_STR);
		$req->bindParam(':idCommentaireParent', $commentaire->getIdCommentaireParent(), PDO::PARAM_STR);
		$req->bindParam(':idUtilisateur', $commentaire->getIdUtilisateur(), PDO::PARAM_STR);
		$req->bindParam(':idActivite', $commentaire->getIdActivite(), PDO::PARAM_STR);
		$req->bindParam(':idCommentaire', $commentaire->getIdCommentaire(), PDO::PARAM_STR);
		$req->execute();

		$nbTupleObt = $req->rowCount();	
		$req->closeCursor();

		if($nbTupleObt < 1)
			return false;
		return true;
	}
}