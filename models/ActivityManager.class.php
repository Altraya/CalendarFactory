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

		$sql = "INSERT INTO activite (titre, description, positionGeographique, type, priorite, dateDebut, dateFin, heureDebut, heureFin, periodicite, nbOccurence, estEnPause, estPossibleDeSinscrire, estPublic, idAgenda)
			VALUES (:titre, :description, :positionGeographique, :type, :priorite, :dateDebut, :dateFin, :heureDebut, :heureFin, :periodicite, :nbOccurence, :estEnPause, :estPossibleDeSinscrire, :estPublic, :idAgenda)";
		$req = $this->_db->prepare($sql);                     
		$req->bindParam(':titre', $activite->getTitle(), PDO::PARAM_STR);
		$req->bindParam(':description', $activite->getDescription(), PDO::PARAM_STR);
		$req->bindParam(':positionGeographique', $activite->getGeoPos(), PDO::PARAM_STR);
		$req->bindParam(':type', $activite->getType(), PDO::PARAM_STR);
		$req->bindParam(':priorite', $activite->getPriority(), PDO::PARAM_STR);
		$req->bindParam(':dateDebut', $activite->getStartDate(), PDO::PARAM_STR);
		$req->bindParam(':dateFin', $activite->getEndDate(), PDO::PARAM_STR);
		$req->bindParam(':heureDebut', $activite->getStartHour(), PDO::PARAM_STR);
		$req->bindParam(':heureFin', $activite->getEndHour(), PDO::PARAM_STR);
		$req->bindParam(':periodicite', $activite->getPeriodic(), PDO::PARAM_STR);
		$req->bindParam(':nbOccurence', $activite->getNbOccur(), PDO::PARAM_STR);
		$req->bindParam(':estEnPause', $activite->getIsInBreak(), PDO::PARAM_STR);
		$req->bindParam(':estPossibleDeSinscrire', $activite->getIsPossibleToSubscribe(), PDO::PARAM_STR);
		$req->bindParam(':estPublic', $activite->getIsPublic(), PDO::PARAM_STR);
		$req->bindParam(':idAgenda', $activite->getIdAgenda(), PDO::PARAM_STR);
		$req->execute();
		$nbTupleInsere = $req->rowCount();
		$req->closeCursor();

		//check if insert has failed
		if($nbTupleInsere < 1)
			return false;
		return true;
	}

}
?>