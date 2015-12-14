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

	//get comments with commentaireParent's Id.
	public function getSonComment($id){
		$infos = array();
		$infosReturn = array();
		$req = $this->_db->query('SELECT * 
								FROM commentaire WHERE idCommentaireParent = \''.$id.'\' ');
		while ($donnees = $req->fetch(PDO::FETCH_ASSOC)){
			$infos['idCommentaire'] = $donnees['idCommentaire'];
			$infos['idCommentaireParent'] = $donnees['idCommentaireParent'];
			$infos['commentaire'] = $donnees['commentaire'];
			$infos['dateCommentaire'] = $donnees['dateCommentaire'];
			$infos['heureCommentaire'] = $donnees['heureCommentaire'];
			$infos['idUtilisateur'] = $donnees['idUtilisateur'];
			$infos['idActivite'] = $donnees['idActivite'];
			$infosReturn[] = new Commentaire($infos);

		}
		$nbTupleObt = $req->rowCount();	
		$req->closeCursor();

		if($nbTupleObt < 1)
			return false;
		return $infosReturn;

	}

	public function getParentCommentOfAgenda($idAgenda){
		$infos = array();
		$infosReturn = array();
		$sql = 'SELECT * FROM commentaire WHERE idActivite IN (SELECT idActivite FROM activite WHERE idAgenda='.$idAgenda.') AND idCommentaireParent IS NULL ';
		$req = $this->_db->query($sql);

		//Querry seems like that : SELECT * FROM commentaire WHERE idActivite IN ( (SELECT idActivite FROM activite WHERE idAgenda=60)) AND idCommentaireParent IS NULL
		while ($donnees = $req->fetch(PDO::FETCH_ASSOC)){
			$infos['idCommentaire'] = $donnees['idCommentaire'];
			$infos['idCommentaireParent'] = $donnees['idCommentaireParent'];
			$infos['commentaire'] = $donnees['commentaire'];
			$infos['dateCommentaire'] = $donnees['dateCommentaire'];
			$infos['heureCommentaire'] = $donnees['heureCommentaire'];
			$infos['idUtilisateur'] = $donnees['idUtilisateur'];
			$infos['idActivite'] = $donnees['idActivite'];
			$infosReturn[] = new Commentaire($infos);

		}
		$nbTupleObt = $req->rowCount();	
		$req->closeCursor();

		if($nbTupleObt < 1)
			return false;
		return $infosReturn;
	}

	public function getParentCommentOfActivity($idActivite){
				$infos = array();
		$infosReturn = array();
		$sql = 'SELECT * FROM commentaire WHERE idActivite = '.$idActivite.' AND idCommentaireParent IS NULL ';
		$req = $this->_db->query($sql);

		//Querry seems like that : SELECT * FROM commentaire WHERE idActivite IN ( (SELECT idActivite FROM activite WHERE idAgenda=60)) AND idCommentaireParent IS NULL
		while ($donnees = $req->fetch(PDO::FETCH_ASSOC)){
			$infos['idCommentaire'] = $donnees['idCommentaire'];
			$infos['idCommentaireParent'] = $donnees['idCommentaireParent'];
			$infos['commentaire'] = $donnees['commentaire'];
			$infos['dateCommentaire'] = $donnees['dateCommentaire'];
			$infos['heureCommentaire'] = $donnees['heureCommentaire'];
			$infos['idUtilisateur'] = $donnees['idUtilisateur'];
			$infos['idActivite'] = $donnees['idActivite'];
			$infosReturn[] = new Commentaire($infos);

		}
		$nbTupleObt = $req->rowCount();	
		$req->closeCursor();

		if($nbTupleObt < 1)
			return false;
		return $infosReturn;
	}

	/**
	*	List all comments
	*	@return : false if the insert failed / else return an array of comment object
	*/
	public function getAllComments(){
		$comment = array();
		$return = array();
		$req = $this->_db->query('SELECT *
									FROM commentaire ');
		while ($donnees = $req->fetch(PDO::FETCH_ASSOC)) {
			$comment['idCommentaire'] = $donnees['idCommentaire'];
			$comment['idCommentaireParent'] = $donnees['idCommentaireParent'];
			$comment['commentaire'] = $donnees['commentaire'];
			$comment['dateCommentaire'] = $donnees['dateCommentaire'];
			$comment['heureCommentaire'] = $donnees['heureCommentaire'];
			$comment['idUtilisateur'] = $donnees['idUtilisateur'];
			$comment['idActivite'] = $donnees['idActivite'];
			$return[] = new Commentaire($comment);
		}

		$nbTupleObt = $req->rowCount();	
		$req->closeCursor();

		if($nbTupleObt < 1)
			return false;
		return $return;
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
			idUtilisateur = :idUtilisateur,
			idActivite = :idActivite
			WHERE idCommentaire = :idCommentaire";

		$comm = $commentaire->getCommentaire();
		$dateCom = $commentaire->getDateCommentaire();
		$heure = $commentaire->getHeureCommentaire();
		$util = $commentaire->getIdUtilisateur();
		$act = $commentaire->getIdActivite();
		$idComm = $commentaire->getIdCommentaire();

		$req = $this->_db->prepare($sql);
		$req->bindParam(':commentaire',$comm , PDO::PARAM_STR);
		$req->bindParam(':dateCommentaire',$dateCom , PDO::PARAM_STR);
		$req->bindParam(':heureCommentaire',$heure , PDO::PARAM_STR);
		$req->bindParam(':idUtilisateur',$util , PDO::PARAM_STR);
		$req->bindParam(':idActivite', $act, PDO::PARAM_STR);
		$req->bindParam(':idCommentaire', $idComm, PDO::PARAM_STR);
		$req->execute();

		$nbTupleObt = $req->rowCount();	
		$req->closeCursor();

		if($nbTupleObt < 1)
			return false;
		return true;
	}
}