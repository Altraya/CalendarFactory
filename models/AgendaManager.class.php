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
	*	@return : false if the insert failed / else the id of this agenda
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
		$idAgenda = $this->_db->lastInsertId();
		$req->closeCursor();

		//check if insert has failed
		if($nbTupleInsere < 1)
			return false;
		else
			return $idAgenda;
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
		else
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
		else
			return true;
	}

	/**
	*	Get all agenda for a specific user
	*	@param userId : user's id
	*	@return : false if the user don't have any agenda, or an array of Agenda Object
	*/
	public function getAllAgenda($userId){

		$infos = array();
		$infosReturn = array();

		$req = $this->_db->query('SELECT * FROM agenda WHERE idUtilisateur = '.$userId.' ');
		while ($donnees = $req->fetch(PDO::FETCH_ASSOC)){
			$infos['id'] = $donnees['idAgenda'];
			$infos['nom'] = $donnees['nom'];
			$infos['priorite'] = $donnees['priorite'];
			$infos['lastEdition'] = $donnees['lastEdition'];
			$infos['isSuperposable'] = $donnees['estSuperposable'];
			$infos['ownerId'] = $donnees['idUtilisateur'];
			$infosReturn[] = new Agenda($infos);
		}

		$nbTupleObt = $req->rowCount();
		$req->closeCursor();

		if($nbTupleObt < 1)
			return false;
		else
			return $infosReturn;
	}


	/**
	*	Get all agenda of all users
	*	@return : false if we don't get any agenda, or an array of Agenda Object
	*/
	public function getAllAllAgenda(){
		$agenda = array();
		$return = array();
		$req = $this->_db->query('SELECT * FROM agenda');
		while ($donnees = $req->fetch(PDO::FETCH_ASSOC)){
			$agenda['id'] = $donnees['idAgenda'];
			$agenda['nom'] = $donnees['nom'];
			$agenda['priorite'] = $donnees['priorite'];
			$agenda['lastEdition'] = $donnees['lastEdition'];
			$agenda['isSuperposable'] = $donnees['estSuperposable'];
			$agenda['ownerId'] = $donnees['idUtilisateur'];
			$return[] = new Agenda($agenda);
		}
		$nbTupleObt = $req->rowCount();
		$req->closeCursor();

		if($nbTupleObt < 1)
			return false;
		else
			return $return;

	}


	/**
	*	Get one agenda with his id
	* 	@param : $id : agenda's id
	*	@return : Agenda object
	*/
	public function getAgenda($id){

		$agenda;
		$req = $this->_db->query('SELECT *
								FROM agenda WHERE idAgenda = \''.$id.'\' ');
		while ($donnees = $req->fetch(PDO::FETCH_ASSOC)){
			
			$agenda = new Agenda($donnees);
			$agenda->setId($donnees['idAgenda']);
			$agenda->setIsSuperposable($donnees['estSuperposable']);
			$agenda->setOwnerId($donnees['idUtilisateur']);

		}
		$nbTupleObt = $req->rowCount();	
		$req->closeCursor();

		if($nbTupleObt < 1)
			return false;
		return $agenda;

	}

	/**
	*	Remove an Agenda
	*	@param : Agenda we want to remove
	*/
	public function remove(Agenda $agenda){
		$idAgenda = $agenda->getId();
		$sql = "DELETE FROM agenda WHERE idAgenda = :idAgenda ";
		$req = $this->_db->prepare($sql);
		$req->bindParam(':idAgenda', $idAgenda, PDO::PARAM_INT);
		$req->execute();
		$req->closeCursor();
	}

	/**
	*	Update an Agenda
	*	@param : Agenda we want to update
	*	@return : Return true if the update is a success / else
	*/
	public function modify(Agenda $agenda){
		$id = $agenda->getId();
		$nom = $agenda->getNom();
		$priorite = $agenda->getPriorite();
		$last = $agenda->getLastEdition();
		$super = $agenda->getIsSuperposable();

		$sql = "UPDATE agenda
			SET nom = :nom,
			priorite = :priorite,
			lastEdition = :lastEdition,
			estSuperposable = :estSuperposable
			WHERE idAgenda = :idAgenda";
		var_dump($sql);
		$req = $this->_db->prepare($sql);
		$req->bindParam(':idAgenda', $id, PDO::PARAM_STR);
		$req->bindParam(':nom', $nom , PDO::PARAM_STR);
		$req->bindParam(':priorite',$priorite , PDO::PARAM_STR);
		$req->bindParam(':lastEdition', $last, PDO::PARAM_STR);
		$req->bindParam(':estSuperposable',$super , PDO::PARAM_STR);
		$req->execute();

		$nbTupleObt = $req->rowCount();	
		$req->closeCursor();

		if($nbTupleObt < 1)
			return false;
		return true;
	}

	/**
	*	Check if the categorie specified already exist or not
	*	@param : the name of the categorie
	*	@return : false if we don't find a categorie / the categorieId if it exist
	*/
	public function checkCategorieExist($nomCategorie){
		//Add quote on nomCategorie to do request
		$cat = '\'';
		$cat .= $nomCategorie;
		$cat .= '\'';

		$infos = array();

		$req = $this->_db->query('SELECT * FROM categorie WHERE nomCategorie = '.$cat.' ');
		while ($donnees = $req->fetch(PDO::FETCH_ASSOC)){
			$infos = $donnees;
		}

		$nbTupleObt = $req->rowCount();
		$req->closeCursor();

		if($nbTupleObt < 1)
			return false;
		else
			return $infos['idCategorie'];
	}

}
?>