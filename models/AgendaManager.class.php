<?php
/*
*	AgendaManager.class.php : Manage agendas
*
*	
*	Author : Karakayn
*/
require_once('Agenda.class.php');

class AgendaManager{
	
	private $_db;

	public function __construct($db){
		$this->setDb($db);
	}

	public function setDb(PDO $db){
		$this->_db = $db;
	}

	/**
	*	Add agenda in database
	*	@param : Agenda object
	*	@return : false if the insert failed / else true
	*/
	public function add(Agenda $agenda){

		$nom = $agenda->getNom();
		$priorite = $agenda->getPriorite();
		if($lastEdition = $agenda->getLastEdition() == null)
			$lastEdition = "0000-00-00"; 
		$estSuperposable = $agenda->getIsSuperposable();
		$idOwner = $agenda->getOwnerId();

		$sql = "INSERT INTO agenda (nom, priorite, lastEdition, estSuperposable, idUtilisateur)
			VALUES (:nom, :priorite, :lastEdition, :estSuperposable, :idUtilisateur)";
		$req = $this->_db->prepare($sql);                     
		$req->bindParam(':nom', $nom, PDO::PARAM_STR);
		$req->bindParam(':priorite', $priorite, PDO::PARAM_STR);
		$req->bindParam(':lastEdition', $lastEdition, PDO::PARAM_STR);
		$req->bindParam(':estSuperposable', $estSuperposable, PDO::PARAM_INT);
		$req->bindParam(':idUtilisateur', $idOwner, PDO::PARAM_STR);
		$req->execute();
		$nbTupleInsere = $req->rowCount();
		$req->closeCursor();

		//check if insert has failed
		if($nbTupleInsere < 1)
			return false;
		return true;
	}

	/**
	*	Add categorie in database
	*	@param : the name of the categorie
	*	@return : false if the insert failed / else true
	*/
	public function addCategorie($nomCategorie){
		$nom = htmlspecialchars($nomCategorie);
				$sql = "INSERT INTO categorie (nomCategorie)
			VALUES (:nomCategorie)";
		$req = $this->_db->prepare($sql);                     
		$req->bindParam(':nomCategorie', $nom, PDO::PARAM_STR);
		$req->execute();
		$nbTupleInsert = $req->rowCount();
		$req->closeCursor();
		//check if insert has failed
		if($nbTupleInsert < 1)
			return false;
		return true;
	}

	/**
	*	Add categorie_agenda in database / Link between categorie and agenda 
	*	@param idAgenda : id of the agenda
	* 	@param idCategorie : id of the categorie
	*	@return : false if the insert failed / else true
	*/
	public function addCategorieAgenda($idAgenda, $idCategorie){
		$idAgenda = htmlspecialchars($idAgenda);
		$idCategorie = htmlspecialchars($idCategorie);
		$sql = "INSERT INTO categorie_agenda (idAgenda, idCategorie)
			VALUES (:idAgenda, :idCategorie)";
		$req = $this->_db->prepare($sql);                     
		$req->bindParam(':idAgenda', $idAgenda, PDO::PARAM_INT);
		$req->bindParam(':idCategorie', $idCategorie, PDO::PARAM_INT);
		$req->execute();
		$nbTupleInsert = $req->rowCount();
		$req->closeCursor();
		//check if insert has failed
		if($nbTupleInsert < 1)
			return false;
		return true;
	}

}
?>