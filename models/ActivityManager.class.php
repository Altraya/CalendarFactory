<?php
/*
*	ActivityManager.class.php : Manage activities
*
*	
*	Author : Karakayn
*/
require_once('Activity.class.php');

class ActivityManager{
	
	private $_db;

	public function __construct($db){
		$this->setDb($db);
	}

	public function setDb(PDO $db){
		$this->_db = $db;
	}

	/**
	*	Add activity in database
	*	@param : Activity object
	*	@return : false if the insert failed / else true
	*/
	public function add(Activity $activite){

		$title = $activite->getTitle();
		$descr = $activite->getDescription();
		$pos = $activite->getGeoPos();
		$type = $activite->getType();
		$priority = $activite->getPriority();
		$sd = $activite->getStartDate();
		$ed = $activite->getEndDate();
		$sh = $activite->getStartHour();
		$eh = $activite->getEndHour();
		$per = $activite->getPeriodic();
		$nbOcc = $activite->getNbOccur();
		$isInBreak = $activite->getIsInBreak();
		$sub =  $activite->getIsPossibleToSubscribe();
		$public = $activite->getIsPublic();
		$idAgenda = $activite->getIdAgenda();

		$sql = "INSERT INTO activite (titre, description, positionGeographique, type, priorite, dateDebut, dateFin, heureDebut, heureFin, periodicite, nbOccurence, estEnPause, estPossibleDeSinscrire, estPublic, idAgenda)
			VALUES (:titre, :description, :positionGeographique, :type, :priorite, :dateDebut, :dateFin, :heureDebut, :heureFin, :periodicite, :nbOccurence, :estEnPause, :estPossibleDeSinscrire, :estPublic, :idAgenda)";
		$req = $this->_db->prepare($sql);           
		$req->bindParam(':titre', $title, PDO::PARAM_STR);
		$req->bindParam(':description', $descr, PDO::PARAM_STR);
		$req->bindParam(':positionGeographique', $pos, PDO::PARAM_STR);
		$req->bindParam(':type', $type, PDO::PARAM_STR);
		$req->bindParam(':priorite', $priority, PDO::PARAM_INT);
		$req->bindParam(':dateDebut', $sd, PDO::PARAM_STR);
		$req->bindParam(':dateFin', $ed, PDO::PARAM_STR);
		$req->bindParam(':heureDebut', $sh, PDO::PARAM_STR);
		$req->bindParam(':heureFin', $eh, PDO::PARAM_STR);
		$req->bindParam(':periodicite', $per, PDO::PARAM_STR);
		$req->bindParam(':nbOccurence', $nbOcc, PDO::PARAM_INT);
		$req->bindParam(':estEnPause', $isInBreak, PDO::PARAM_INT);
		$req->bindParam(':estPossibleDeSinscrire', $sub, PDO::PARAM_INT);
		$req->bindParam(':estPublic', $public, PDO::PARAM_INT);
		$req->bindParam(':idAgenda', $idAgenda, PDO::PARAM_INT);
		$req->execute();
		$nbTupleInsere = $req->rowCount();
		$req->closeCursor();

		//check if insert has failed
		if($nbTupleInsere < 1)
			return false;
		return true;
	}

	//Delete  l'activité donnée en paramètre
	public function remove(Activity $activite){
		$idActivite = $activite->getIdActivity();
		$sql = "DELETE FROM activite WHERE idActivite = :idActivite ";
		$req = $this->_db->prepare($sql);
		$req->bindParam(':idActivite', $idActivite, PDO::PARAM_INT);
		$req->execute();
		$req->closeCursor();
	}

	/**
	*	Get an activity with his ID
	*	@param : id : id of the  activity we want to get
	*	@return : false if we have no result / else return an activity object
	*/
	public function getActivity($id){
		$activity;
		$req = $this->_db->query('SELECT titre, description, type, dateDebut, dateFin, positionGeographique 
								FROM activity WHERE idActivite = \''.$id.'\' ');
		while ($donnees = $req->fetch(PDO::FETCH_ASSOC)){
			$activity = new Activity($donnees);
		}
		$nbTupleObt = $req->rowCount();	
		$req->closeCursor();

		if($nbTupleObt < 1)
			return false;
		return $activity;

	}

	/**
	*	List all activities
	*	@return : false if the insert failed / else return an array of activity object
	*/
	public function getAllActivities(){
		$activity = array();
		$query = $this->_db->query('SELECT *
									FROM activity GROUP BY idAgenda');
		while ($donnees = $query->fetch(PDO::FETCH_ASSOC)) {
			$activity[] = new Activity($donnees);
		}

		$nbTupleObt = $req->rowCount();	
		$req->closeCursor();

		if($nbTupleObt < 1)
			return false;
		return $activity;
	}

	/**
	*	Update activity in database
	*	@param : Activity object
	*	@return : false if the update failed / else true
	*/
	public function modify(Activity $activity){
		$sql = "UPDATE activite
			SET titre = :titre,
			description = :description,
			positionGeographique = :positionGeographique,
			type = :type,
			priorite = :priorite,
			dateDebut = :dateDebut,
			dateFin = :dateFin,
			periodicite = :periodicite,
			nbOccurence = :nbOccurence,
			estEnPause = :estEnPause,
			estPublic = :estPublic
			WHERE idActivite = :idActivite";
		$req = $this->_db->prepare($sql);
		$req->bindParam(':titre', $activity->getTitle(), PDO::PARAM_STR);
		$req->bindParam(':description', $activity->getDescription(), PDO::PARAM_STR);
		$req->bindParam(':positionGeographique', $activity->getGeoPos(), PDO::PARAM_STR);
		$req->bindParam(':type', $activity->getType(), PDO::PARAM_STR);
		$req->bindParam(':priorite', $activity->getPriority(), PDO::PARAM_STR);
		$req->bindParam(':dateDebut', $activity->getStartDate(), PDO::PARAM_STR);
		$req->bindParam(':dateFin', $activity->getEndDate(), PDO::PARAM_STR);
		$req->bindParam(':periodicite', $activity->getPeriodic(), PDO::PARAM_STR);
		$req->bindParam(':nbOccurence', $activity->getNbOccur(), PDO::PARAM_STR);
		$req->bindParam(':estEnPause', $activity->getIsInBreak(), PDO::PARAM_STR);
		$req->bindParam(':estPublic', $activity->getIsPublic(), PDO::PARAM_STR);
		$req->execute();

		$nbTupleObt = $req->rowCount();	
		$req->closeCursor();

		if($nbTupleObt < 1)
			return false;
		return true;
	}



}
?>