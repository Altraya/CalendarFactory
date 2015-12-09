<?php
/*
*	Activity.class.php : Represent an activity / event
*
*	Author : Karakayn
*/
class Activity{

	private $_idActivity;				//activity's id
	private $_title;					//his title
	private $_description;				//his description
	private $_geoPos;					//his geocraphical position
	private $_type;						//his type
	private $_priority;					//his priority
	private $_startDate;				//the starting date
	private $_endDate;					//the ending date
	private $_startHour;				//the starting time
	private $_endHour;					//the ending time
	private $_periodic;					//string who give the periodicity of the event
	private $_nbOccur;					//the number of occurence if this event is periodic
	private $_isInBreak;				//boolean equal true if the current event is in sleep
	private $_isPossibleToSubscribe; 	//boolean equal true if it's possible for someone to subscribe
	private $_isPublic;					//boolean equal true if it's a pubic event
	private $_idAgenda;					//id of the agenda where this activity is
	
	/*Constructeur*/
	public function __construct($donnees){
		$this->hydrate($donnees);
	}

	/***************************
		Accesseur of the class
	****************************/

	public function getIdActivity(){
		return $this->_idActivity;
	}

	public function getTitle(){
		return $this->_title;
	}

	public function getDescription(){
		return $this->_description;
	}

	public function getGeoPos(){
		return $this->_geoPos;
	}

	public function getType(){
		return $this->_type;
	}

	public function getPriority(){
		return $this->_priority;
	}

	public function getStartDate(){
		return $this->_startDate;
	}

	public function getEndDate(){
		return $this->_endDate;
	}

	public function getStartHour(){
		return $this->_startHour;
	}

	public function getEndHour(){
		return $this->_endHour;
	}

	public function getPeriodic(){
		return $this->_periodic;
	}

	public function getNbOccur(){
		return $this->_nbOccur;
	}

	public function getIsInBreak(){
		return $this->_isInBreak;
	}

	public function getIsPossibleToSubscribe(){
		return $this->_isPossibleToSubscribe;
	}

	public function getIsPublic(){
		return $this->_isPublic;
	}

	public function getIdAgenda(){
		return $this->_idAgenda;
	}

	/************************/

	public function setIdActivity($idActivity){
		$this->_idActivity = htmlspecialchars($idActivity);
	}

	public function setTitle($title){
		$this->_title = htmlspecialchars($title);
	}

	public function setDescription($description){
		$this->_idActivity = htmlspecialchars($idActivity);
	}

	public function setGeoPos($geoPos){
		$this->_geoPos = htmlspecialchars($geoPos);
	}

	public function setType($type){
		$this->_type = htmlspecialchars($type);
	}

	public function setPriority($priority){
		$this->_priority = htmlspecialchars($priority);
	}

	public function setStartDate($startDate){
		$this->_startDate = htmlspecialchars($startDate);
	}

	public function setEndDate($endDate){
		$this->_endDate = htmlspecialchars($endDate);
	}

	public function setStartHour($startHour){
		$this->_startHour = htmlspecialchars($startHour);
	}

	public function setEndHour($endHour){
		$this->_endHour = htmlspecialchars($endHour);
	}

	public function setPeriodic($periodic){
		$this->_periodic = htmlspecialchars($periodic);
	}

	public function setNbOccur($nbOccur){
		$this->_nbOccur = htmlspecialchars($nbOccur);
	}

	public function setIsInBreak($isInBreak){
		$this->_isInBreak = htmlspecialchars($isInBreak);
	}

	public function setIsPossibleToSubscribe($isPossibleToSubscribe){
		$this->_isPossibleToSubscribe = htmlspecialchars($isPossibleToSubscribe);
	}

	public function setIsPublic($isPublic){
		$this->_isPublic = htmlspecialchars($isPublic);
	}

	public function getIdAgenda($idAgenda){
		$this->_idAgenda = htmlspecialchars($idAgenda);
	}

	/************************/

	public function hydrate($donnees)
	{
		foreach($donnees as $key => $value)
		{
			// On récupère le nom du setter correspondant à l'attribut.
			$method = 'set'.ucfirst($key);

			// Si le setter correspondant existe.
			if(method_exists($this, $method))
			{
				// On appelle le setter.
				$this->$method($value);
			}
		}
	}
}
?>