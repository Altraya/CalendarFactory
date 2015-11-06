<?php
/*
*	User.class.php : Represent the user
*
*	Author : Karakayn
*/
class User{

	private $_idUtilisateur;	//user's id
	private $_login;			//his login
	private $_pwd;				//his password
	private $_nom;				//his name
	private $_prenom;			//his firstname
	private $_adresse;			//his adress
	
	
	/*Constructeur*/
	public function __construct($donnees){
		$this->hydrate($donnees);
	}

	/***************************
		Accesseur of the class
	****************************/

	public function getIdUtilisateur(){
		return $this->_id;
	}

	public function getLogin(){
		return $this->_login;
	}

	public function getPwd(){
		return $this->_pwd;
	}

	public function getNom(){
		return $this->_nom;
	}

	public function getPrenom(){
		return $this->_prenom;
	}

	public function getAdresse(){
		return $this->_adresse;
	}

	/************************/

	public function setIdUtilisateur($id){
		$this->_id = $id;
	}

	public function setLogin($login){
		$this->_login = htmlspecialchars($login);	
	}

	public function setPwd($pwd){
		$this->_pwd = htmlspecialchars($pwd);	
	}

	public function setNom($nom){
		$this->_nom = htmlspecialchars($nom);
	}

	public function setPrenom($prenom){
		$this->_prenom = htmlspecialchars($prenom);
	}

	public function setAdresse($adresse){
		$this->_adresse = htmlspecialchars($adresse);
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