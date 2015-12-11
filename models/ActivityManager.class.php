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

		var_dump($activite);
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

}
?>