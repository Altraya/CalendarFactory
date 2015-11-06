<?php
/*
*	Agenda.class.php : Represent the Agenda
*
*	Author : Karakayn
*/
class Agenda{

	private $_id;				//agenda's id
	private $_nom;				//his name
	private $_priorite;			//his priority
	private $_lastEdition;		//the last edition
	private $_isSuperposable;	//boolean to know if it is superposable
	private $_ownerId;			//user id of the owner of this agenda
	
	/*Constructeur*/
	public function __construct($donnees){
		$this->hydrate($donnees);
	}

	/***************************
		Accesseur of the class
	****************************/

	public function getId(){
		return $this->_id;
	}

	public function getNom(){
		return $this->_nom;
	}

	public function getPriorite(){
		return $this->_priorite;
	}

	public function getLastEdition(){
		return $this->_lastEdition;
	}

	public function getIsSuperposable(){
		return $this->_isSuperposable;
	}

	public function getOwnerId(){
		return $this->_ownerId;
	}

	/************************/

	public function setId($id){
		$this->_id = $id;
	}

	public function setNom($nom){
		$this->_nom = htmlspecialchars($nom);
	}

	public function setPriorite($priorite){
		$this->_priorite = htmlspecialchars($priorite);
	}

	public function setLastEdition($lastEdition){
		$this->_lastEdition = htmlspecialchars($lastEdition);
	}

	public function setIsSuperposable($isSuperposable){
		$this->_isSuperposable = htmlspecialchars($isSuperposable);
	}

	public function setOwnerId($ownerId){
		$this->_ownerId = htmlspecialchars($ownerId);
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